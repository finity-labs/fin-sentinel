<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Pages;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Text;
use Filament\Support\Enums\FontFamily;
use Filament\Support\Enums\TextSize;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use FinityLabs\FinSentinel\Mail\LogFileMail;
use Illuminate\Support\Facades\Mail;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use FinityLabs\FinSentinel\Enums\LogLevel;
use FinityLabs\FinSentinel\Services\LogEntryParser;
use Illuminate\Pagination\LengthAwarePaginator;

class LogFileViewer extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $slug = 'sentinel/logs/{file}';

    protected static bool $shouldRegisterNavigation = false;

    protected string $view = 'fin-sentinel::log-viewer.viewer';

    public ?string $file = null;

    public function mount(string $file): void
    {
        $this->file = base64_decode(strtr($file, '-_', '+/'));

        $logsPath = storage_path('logs');
        $fullPath = $logsPath . DIRECTORY_SEPARATOR . $this->file;
        $realPath = realpath($fullPath);
        $realLogsPath = realpath($logsPath);

        if (
            $realPath === false
            || $realLogsPath === false
            || ! str_starts_with($realPath, $realLogsPath)
            || ! is_file($realPath)
        ) {
            $this->redirect(LogFileList::getUrl());

            return;
        }
    }

    public function getTitle(): string
    {
        return basename((string) $this->file);
    }

    public function getHeading(): string
    {
        return basename((string) $this->file);
    }

    public function getBreadcrumbs(): array
    {
        return [
            LogFileList::getUrl() => __('fin-sentinel::fin-sentinel.log_viewer_heading'),
            '' => basename((string) $this->file),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('refresh')
                ->label(__('fin-sentinel::fin-sentinel.log_action_refresh'))
                ->icon(Heroicon::OutlinedArrowPath)
                ->color('gray')
                ->action(fn () => $this->flushCachedTableRecords()),
            Action::make('email')
                ->label(__('fin-sentinel::fin-sentinel.log_action_email'))
                ->icon(Heroicon::OutlinedEnvelope)
                ->modalSubmitActionLabel(__('fin-sentinel::fin-sentinel.log_action_email_send'))
                ->fillForm(fn (): array => [
                    'email' => auth()->user()?->email,
                ])
                ->schema([
                    Text::make(__('fin-sentinel::fin-sentinel.log_email_description')),
                    TextInput::make('email')
                        ->label(__('fin-sentinel::fin-sentinel.log_email_recipient'))
                        ->email()
                        ->required(),
                ])
                ->action(function (array $data): void {
                    $fullPath = $this->resolveLogPath((string) $this->file);

                    if ($fullPath === null) {
                        return;
                    }

                    Mail::to($data['email'])->send(new LogFileMail($fullPath, basename((string) $this->file)));

                    Notification::make()
                        ->title(__('fin-sentinel::fin-sentinel.log_action_email_sent'))
                        ->success()
                        ->send();
                }),
            Action::make('download')
                ->label(__('fin-sentinel::fin-sentinel.log_action_download'))
                ->icon(Heroicon::OutlinedArrowDownTray)
                ->color('gray')
                ->action(function (): mixed {
                    $fullPath = $this->resolveLogPath((string) $this->file);

                    if ($fullPath === null) {
                        return null;
                    }

                    $filename = basename((string) $this->file);

                    return response()->streamDownload(function () use ($fullPath): void {
                        $file = new \SplFileObject($fullPath, 'r');

                        while (! $file->eof()) {
                            echo $file->fgets();
                        }
                    }, $filename, ['Content-Type' => 'text/plain']);
                }),
            Action::make('delete')
                ->label(__('fin-sentinel::fin-sentinel.log_action_delete'))
                ->icon(Heroicon::OutlinedTrash)
                ->color('danger')
                ->requiresConfirmation()
                ->modalDescription(__('fin-sentinel::fin-sentinel.log_confirm_delete'))
                ->action(function (): void {
                    $fullPath = $this->resolveLogPath((string) $this->file);

                    if ($fullPath === null) {
                        return;
                    }

                    unlink($fullPath);

                    Notification::make()
                        ->title(__('fin-sentinel::fin-sentinel.log_action_deleted'))
                        ->success()
                        ->send();

                    $this->redirect(LogFileList::getUrl());
                }),
        ];
    }

    private function resolveLogPath(string $relativePath): ?string
    {
        $logsPath = realpath(storage_path('logs'));

        if ($logsPath === false) {
            return null;
        }

        $fullPath = realpath($logsPath . DIRECTORY_SEPARATOR . $relativePath);

        if ($fullPath === false || ! str_starts_with($fullPath, $logsPath) || ! is_file($fullPath)) {
            return null;
        }

        return $fullPath;
    }

    public function table(Table $table): Table
    {
        return $table
            ->records(function (
                int $page,
                int $recordsPerPage,
                ?string $sortColumn,
                ?string $sortDirection,
                ?string $search,
                array $filters,
            ): LengthAwarePaginator {
                $levelFilter = $filters['level']['values'] ?? [];

                return app(LogEntryParser::class)->getEntries(
                    relativePath: (string) $this->file,
                    page: $page,
                    perPage: $recordsPerPage,
                    sortDirection: $sortDirection ?? 'desc',
                    levelFilter: $levelFilter,
                    search: $search,
                );
            })
            ->defaultPaginationPageOption(50)
            ->defaultSort('start_line', 'desc')
            ->columns([
                TextColumn::make('level')
                    ->label(__('fin-sentinel::fin-sentinel.log_column_level'))
                    ->badge()
                    ->color(fn (string $state): string => LogLevel::from($state)->getColor())
                    ->sortable(false),

                TextColumn::make('timestamp')
                    ->label(__('fin-sentinel::fin-sentinel.log_column_timestamp'))
                    ->sortable(false),

                TextColumn::make('preview')
                    ->label(__('fin-sentinel::fin-sentinel.log_column_message'))
                    ->wrap()
                    ->lineClamp(3)
                    ->sortable(false),
            ])
            ->filters([
                SelectFilter::make('level')
                    ->label(__('fin-sentinel::fin-sentinel.log_level_filter'))
                    ->multiple()
                    ->options(
                        collect(LogLevel::cases())
                            ->mapWithKeys(fn (LogLevel $level) => [$level->value => $level->getLabel()])
                            ->all()
                    ),
            ])
            ->searchable()
            ->recordActions([
                Action::make('viewEntry')
                    ->label('')
                    ->icon(Heroicon::OutlinedEye)
                    ->modalHeading(fn (array $record): string => $record['level'] . ' - ' . $record['timestamp'])
                    ->modalWidth(Width::SevenExtraLarge)
                    ->slideOver()
                    ->modalSubmitAction(false)
                    ->schema(fn (array $record): array => [
                        Section::make(__('fin-sentinel::fin-sentinel.log_column_message'))
                            ->schema([
                                TextEntry::make('message')
                                    ->hiddenLabel()
                                    ->state(new \Illuminate\Support\HtmlString(nl2br(e($record['message']))))
                                    ->html()
                                    ->fontFamily(FontFamily::Mono)
                                    ->size(TextSize::Small)
                                    ->copyable()
                                    ->copyableState($record['message']),
                            ]),
                        ...($record['has_stack_trace'] ? [
                            Section::make(__('fin-sentinel::fin-sentinel.error_section_trace'))
                                ->schema([
                                    TextEntry::make('stack_trace')
                                        ->hiddenLabel()
                                        ->state(new \Illuminate\Support\HtmlString(nl2br(e($record['stack_trace']))))
                                        ->html()
                                        ->fontFamily(FontFamily::Mono)
                                        ->size(TextSize::ExtraSmall)
                                        ->copyable()
                                        ->copyableState($record['stack_trace']),
                                ])
                                ->collapsible(),
                        ] : []),
                    ]),
            ]);
    }
}
