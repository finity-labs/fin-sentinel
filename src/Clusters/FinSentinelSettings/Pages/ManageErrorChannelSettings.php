<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Clusters\FinSentinelSettings\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Components\Callout;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use FinityLabs\FinSentinel\FinSentinelPlugin;
use FinityLabs\FinSentinel\Mail\ErrorMail;
use FinityLabs\FinSentinel\Settings\ErrorChannelSettings;
use FinityLabs\FinSentinel\Traits\HasPageShieldSupport;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ManageErrorChannelSettings extends SettingsPage
{
    use HasPageShieldSupport;

    public static function getCluster(): ?string
    {
        return FinSentinelPlugin::getSettingsCluster();
    }

    protected static string $settings = ErrorChannelSettings::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedExclamationTriangle;

    public static function getNavigationSort(): ?int
    {
        return FinSentinelPlugin::get()->getSettingsNavigationSort(1);
    }

    public const KNOWN_EXCEPTIONS = [
        NotFoundHttpException::class => 'NotFoundHttpException',
        ValidationException::class => 'ValidationException',
        AuthenticationException::class => 'AuthenticationException',
        ModelNotFoundException::class => 'ModelNotFoundException',
        TokenMismatchException::class => 'TokenMismatchException',
        ThrottleRequestsException::class => 'ThrottleRequestsException',
    ];

    public static function getNavigationLabel(): string
    {
        return __('fin-sentinel::fin-sentinel.navigation.error_channel');
    }

    public function getTitle(): string
    {
        return __('fin-sentinel::fin-sentinel.navigation.error_channel_title');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('sendTestEmail')
                ->label(__('fin-sentinel::fin-sentinel.settings.test_email.send'))
                ->icon(Heroicon::OutlinedPaperAirplane)
                ->color('primary')
                ->action(function (): void {
                    $settings = app(ErrorChannelSettings::class);

                    if (empty($settings->error_recipients)) {
                        Notification::make()
                            ->title(__('fin-sentinel::fin-sentinel.settings.test_email.no_recipients'))
                            ->danger()
                            ->send();

                        return;
                    }

                    if (! $settings->error_enabled) {
                        Notification::make()
                            ->title(__('fin-sentinel::fin-sentinel.settings.test_email.channel_disabled'))
                            ->warning()
                            ->send();
                    }

                    try {
                        $exception = new \RuntimeException('[TEST] This is a test error notification from FinSentinel');
                        $testMail = new ErrorMail('[TEST] Test error notification', $exception);
                        $testMail->subject('[TEST] '.__('fin-sentinel::fin-sentinel.email.error.subject', ['app' => config('app.name')]));

                        Mail::to($settings->error_recipients)->send($testMail);

                        Notification::make()
                            ->title(__('fin-sentinel::fin-sentinel.settings.test_email.sent', [
                                'count' => count($settings->error_recipients),
                            ]))
                            ->success()
                            ->send();
                    } catch (\Throwable $e) {
                        Notification::make()
                            ->title(__('fin-sentinel::fin-sentinel.settings.test_email.failed'))
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }

    public function form(Schema $schema): Schema
    {
        return $schema->schema([
            Toggle::make('error_enabled')
                ->label(__('fin-sentinel::fin-sentinel.settings.error.enabled'))
                ->helperText(__('fin-sentinel::fin-sentinel.settings.error.enabled_helper'))
                ->columnSpanFull(),

            Group::make([
                Section::make(__('fin-sentinel::fin-sentinel.settings.recipients'))
                    ->description(__('fin-sentinel::fin-sentinel.settings.error.recipients_helper'))
                    ->schema([
                        Callout::make()
                            ->heading(__('fin-sentinel::fin-sentinel.settings.no_recipients_warning'))
                            ->color('warning')
                            ->visible(fn (callable $get): bool => empty(array_filter((array) $get('error_recipients')))),

                        Repeater::make('error_recipients')
                            ->hiddenLabel()
                            ->simple(
                                TextInput::make('email')
                                    ->label(__('fin-sentinel::fin-sentinel.settings.email_address'))
                                    ->email()
                                    ->required()
                                    ->maxLength(255),
                            )
                            ->defaultItems(0)
                            ->live(),
                    ]),

                Section::make(__('fin-sentinel::fin-sentinel.settings.throttling'))
                    ->columns(['lg' => 2])
                    ->schema([
                        TextInput::make('error_throttle_minutes')
                            ->label(__('fin-sentinel::fin-sentinel.settings.throttle_rate'))
                            ->helperText(__('fin-sentinel::fin-sentinel.settings.error.throttle_helper'))
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->maxValue(1440)
                            ->suffix(__('fin-sentinel::fin-sentinel.settings.minutes_suffix')),
                        Toggle::make('error_throttle_exceptions')
                            ->label(__('fin-sentinel::fin-sentinel.settings.error.throttle_exceptions'))
                            ->helperText(__('fin-sentinel::fin-sentinel.settings.error.throttle_exceptions_helper'))
                            ->columnSpanFull(),
                        Toggle::make('error_throttle_log_messages')
                            ->label(__('fin-sentinel::fin-sentinel.settings.error.throttle_log_messages'))
                            ->helperText(__('fin-sentinel::fin-sentinel.settings.error.throttle_log_messages_helper'))
                            ->columnSpanFull(),
                    ]),
            ]),

            Group::make([
                Section::make(__('fin-sentinel::fin-sentinel.settings.error.ignored_exceptions'))
                    ->description(__('fin-sentinel::fin-sentinel.settings.error.ignored_exceptions_description'))
                    ->schema([
                        Repeater::make('ignored_exceptions')
                            ->label(__('fin-sentinel::fin-sentinel.settings.error.ignored_exceptions_label'))
                            ->label('')
                            ->schema([
                                Select::make('exception')
                                    ->options(array_merge(
                                        static::KNOWN_EXCEPTIONS,
                                        ['other' => __('fin-sentinel::fin-sentinel.settings.error.other_custom')]
                                    ))
                                    ->required()
                                    ->live(),
                                TextInput::make('custom_class')
                                    ->label(__('fin-sentinel::fin-sentinel.settings.error.exception_class'))
                                    ->visible(fn (callable $get): bool => $get('exception') === 'other')
                                    ->required(fn (callable $get): bool => $get('exception') === 'other')
                                    ->rules([
                                        fn () => function (string $attribute, $value, $fail) {
                                            if ($value && ! class_exists($value)) {
                                                $fail(__('fin-sentinel::fin-sentinel.settings.error.class_not_exist'));
                                            }
                                        },
                                    ]),
                            ])
                            ->defaultItems(0)
                            ->collapsible()
                            ->itemLabel(fn (array $state): string => $state['exception'] === 'other'
                                ? ($state['custom_class'] ?? __('fin-sentinel::fin-sentinel.settings.error.custom_exception'))
                                : (class_basename($state['exception'] ?? '') ?: __('fin-sentinel::fin-sentinel.settings.error.select_exception'))),
                    ]),
            ]),
        ]);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $knownFqcns = array_keys(static::KNOWN_EXCEPTIONS);

        $data['ignored_exceptions'] = array_map(
            fn (string $fqcn): array => [
                'exception' => in_array($fqcn, $knownFqcns, true) ? $fqcn : 'other',
                'custom_class' => in_array($fqcn, $knownFqcns, true) ? null : $fqcn,
            ],
            $data['ignored_exceptions'] ?? []
        );

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['ignored_exceptions'] = array_values(array_filter(
            array_map(
                fn (array $row): ?string => $row['exception'] === 'other'
                    ? ($row['custom_class'] ?? null)
                    : ($row['exception'] ?? null),
                $data['ignored_exceptions'] ?? []
            )
        ));

        return $data;
    }
}
