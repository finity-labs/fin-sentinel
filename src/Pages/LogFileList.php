<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Text;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use FinityLabs\FinSentinel\FinSentinelPlugin;
use FinityLabs\FinSentinel\Mail\LogFileMail;
use FinityLabs\FinSentinel\Services\LogFileScanner;
use FinityLabs\FinSentinel\Traits\HasPageShieldSupport;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

class LogFileList extends Page implements HasTable
{
    use HasPageShieldSupport;
    use InteractsWithTable;

    protected static string | \BackedEnum | null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $slug = 'sentinel/logs';

    protected string $view = 'fin-sentinel::log-viewer.file-list';

    public static function getNavigationGroup(): string|\UnitEnum|null
    {
        return FinSentinelPlugin::get()->getNavigationGroup();
    }

    public static function getNavigationSort(): ?int
    {
        return FinSentinelPlugin::get()->getNavigationSort();
    }

    public function getTitle(): string
    {
        return __('fin-sentinel::fin-sentinel.log_viewer_title');
    }

    public static function getNavigationLabel(): string
    {
        return __('fin-sentinel::fin-sentinel.log_viewer_title');
    }

    public function getHeading(): string
    {
        return __('fin-sentinel::fin-sentinel.log_viewer_heading');
    }

    public function table(Table $table): Table
    {
        return $table
            ->records(function (?string $search, ?string $sortColumn, ?string $sortDirection, int|string $page, int|string $recordsPerPage): LengthAwarePaginator {
                $files = app(LogFileScanner::class)->scan($search);

                $sortColumn ??= 'last_modified';
                $sortDirection ??= 'desc';

                $files = $files->sortBy($sortColumn, SORT_REGULAR, $sortDirection === 'desc')->values();

                $page = (int) $page;
                $recordsPerPage = (int) $recordsPerPage;
                $paginated = $files->forPage($page, $recordsPerPage);

                return new LengthAwarePaginator(
                    $paginated,
                    $files->count(),
                    $recordsPerPage,
                    $page,
                );
            })
            ->defaultSort('last_modified', 'desc')
            ->columns([
                TextColumn::make('filename')
                    ->label(__('fin-sentinel::fin-sentinel.log_column_filename'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('size_human')
                    ->label(__('fin-sentinel::fin-sentinel.log_column_size'))
                    ->sortable(query: fn () => null),
                TextColumn::make('last_modified')
                    ->label(__('fin-sentinel::fin-sentinel.log_column_modified'))
                    ->sortable()
                    ->dateTime(),
                TextColumn::make('subfolder')
                    ->label(__('fin-sentinel::fin-sentinel.log_column_subfolder'))
                    ->placeholder('-'),
            ])
            ->recordActions([
                Action::make('view')
                    ->label(__('fin-sentinel::fin-sentinel.log_action_view'))
                    ->icon(Heroicon::OutlinedEye)
                    ->action(fn (array $record) => $this->redirect(LogFileViewer::getUrl(['file' => base64_encode($record['path'])]))),
                Action::make('download')
                    ->label(__('fin-sentinel::fin-sentinel.log_action_download'))
                    ->icon(Heroicon::OutlinedArrowDownTray)
                    ->action(function (array $record): mixed {
                        $fullPath = $this->resolveLogPath($record['path']);

                        if ($fullPath === null) {
                            return null;
                        }

                        return response()->streamDownload(function () use ($fullPath): void {
                            $file = new \SplFileObject($fullPath, 'r');

                            while (! $file->eof()) {
                                echo $file->fgets();
                            }
                        }, $record['filename'], ['Content-Type' => 'text/plain']);
                    }),
                Action::make('email')
                    ->label(__('fin-sentinel::fin-sentinel.log_action_email'))
                    ->icon(Heroicon::OutlinedEnvelope)
                    ->modalSubmitActionLabel(__('fin-sentinel::fin-sentinel.log_action_email_send'))
                    ->fillForm(fn (array $record): array => [
                        'filename' => $record['filename'],
                        'email' => auth()->user()?->email,
                    ])
                    ->schema([
                        Text::make(__('fin-sentinel::fin-sentinel.log_email_description')),
                        TextEntry::make('filename')
                            ->label(__('fin-sentinel::fin-sentinel.log_column_filename')),
                        TextInput::make('email')
                            ->label(__('fin-sentinel::fin-sentinel.log_email_recipient'))
                            ->email()
                            ->required(),
                    ])
                    ->action(function (array $record, array $data): void {
                        $fullPath = $this->resolveLogPath($record['path']);

                        if ($fullPath === null) {
                            return;
                        }

                        Mail::to($data['email'])->send(new LogFileMail($fullPath, $record['filename']));

                        Notification::make()
                            ->title(__('fin-sentinel::fin-sentinel.log_action_email_sent'))
                            ->success()
                            ->send();
                    }),
                Action::make('delete')
                    ->label(__('fin-sentinel::fin-sentinel.log_action_delete'))
                    ->icon(Heroicon::OutlinedTrash)
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalDescription(__('fin-sentinel::fin-sentinel.log_confirm_delete'))
                    ->action(function (array $record): void {
                        $fullPath = $this->resolveLogPath($record['path']);

                        if ($fullPath === null) {
                            return;
                        }

                        unlink($fullPath);
                        $this->flushCachedTableRecords();

                        Notification::make()
                            ->title(__('fin-sentinel::fin-sentinel.log_action_deleted'))
                            ->success()
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('email')
                        ->label(__('fin-sentinel::fin-sentinel.log_action_email'))
                        ->icon(Heroicon::OutlinedEnvelope)
                        ->modalSubmitActionLabel(__('fin-sentinel::fin-sentinel.log_action_email_send'))
                        // ->fillForm(fn (Collection $records): array => [
                        //     'filenames' => $records->pluck('filename')->toArray(),
                        //     'email' => auth()->user()?->email,
                        // ])
                        ->fillForm(fn (Collection $records): array => [
                            'email' => auth()->user()?->email,
                        ])
                        ->schema(fn (Collection $records): array => [
                            Text::make(__('fin-sentinel::fin-sentinel.log_bulk_email_description')),
                            TextEntry::make('filenames')
                                ->label(__('fin-sentinel::fin-sentinel.log_bulk_email_files'))
                                ->state($records->pluck('filename')->toArray())
                                ->bulleted(),
                            TextInput::make('email')
                                ->label(__('fin-sentinel::fin-sentinel.log_email_recipient'))
                                ->email()
                                ->required(),
                        ])
                        ->action(function (Collection $records, array $data): void {
                            $files = [];

                            foreach ($records as $record) {
                                $fullPath = $this->resolveLogPath($record['path']);

                                if ($fullPath === null) {
                                    continue;
                                }

                                $files[] = ['path' => $fullPath, 'name' => $record['filename']];
                            }

                            if (empty($files)) {
                                return;
                            }

                            Mail::to($data['email'])->send(new LogFileMail($files));

                            Notification::make()
                                ->title(__('fin-sentinel::fin-sentinel.log_bulk_email_sent', ['count' => count($files)]))
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),
                    BulkAction::make('delete')
                        ->label(__('fin-sentinel::fin-sentinel.log_action_delete'))
                        ->icon(Heroicon::OutlinedTrash)
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalDescription(__('fin-sentinel::fin-sentinel.log_confirm_bulk_delete'))
                        ->action(function (Collection $records): void {
                            $count = 0;

                            foreach ($records as $record) {
                                $fullPath = $this->resolveLogPath($record['path']);

                                if ($fullPath === null) {
                                    continue;
                                }

                                unlink($fullPath);
                                $count++;
                            }

                            $this->flushCachedTableRecords();

                            Notification::make()
                                ->title(__('fin-sentinel::fin-sentinel.log_action_bulk_deleted', ['count' => $count]))
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),
                ]),
            ]);
    }

    /**
     * Resolve and validate a relative log path to a full filesystem path.
     */
    private function resolveLogPath(string $relativePath): ?string
    {
        $logsPath = realpath(storage_path('logs'));

        if ($logsPath === false) {
            return null;
        }

        $fullPath = realpath($logsPath . DIRECTORY_SEPARATOR . $relativePath);

        if ($fullPath === false || ! str_starts_with($fullPath, $logsPath)) {
            return null;
        }

        if (! is_file($fullPath)) {
            return null;
        }

        return $fullPath;
    }
}
