<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Clusters\FinSentinelSettings\Pages;

use BackedEnum;
use Closure;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Components\Callout;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use FinityLabs\FinSentinel\Contracts\AiErrorAnalyzerContract;
use FinityLabs\FinSentinel\Facades\FinSentinel;
use FinityLabs\FinSentinel\FinSentinelPlugin;
use FinityLabs\FinSentinel\Mail\ErrorMail;
use FinityLabs\FinSentinel\Services\DataScrubber;
use FinityLabs\FinSentinel\Settings\ErrorChannelSettings;
use FinityLabs\FinSentinel\Support\Ai\AiProviderLabels;
use FinityLabs\FinSentinel\Support\AiSuggestionState;
use FinityLabs\FinSentinel\Support\ScrubbedErrorPayload;
use FinityLabs\FinSentinel\Traits\HasPageShieldSupport;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Cache;
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

    /**
     * @var array<string, string>|null
     */
    private ?array $aiProviderOptionsCache = null;

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

                        $aiSuggestion = null;
                        if ($settings->ai_enabled && FinSentinel::aiAvailable()) {
                            try {
                                $payload = ScrubbedErrorPayload::fromException(
                                    $exception,
                                    app(DataScrubber::class),
                                    strict: $settings->ai_strict_scrubbing,
                                );
                                $aiSuggestion = app(AiErrorAnalyzerContract::class)->analyze($payload);
                            } catch (\Throwable) {
                                $aiSuggestion = null;
                            }
                        }

                        $testMail = new ErrorMail('[TEST] Test error notification', $exception, $aiSuggestion);
                        $testMail->subject('[TEST] '.__('fin-sentinel::fin-sentinel.email.error.subject', ['app' => config('app.name')]));

                        Mail::to($settings->error_recipients)->send($testMail);

                        $aiSuffix = match ($aiSuggestion?->state) {
                            AiSuggestionState::SUCCESS => __('fin-sentinel::fin-sentinel.settings.ai.test_email.ai_success'),
                            AiSuggestionState::CACHED => __('fin-sentinel::fin-sentinel.settings.ai.test_email.ai_cached'),
                            AiSuggestionState::FAILED => __('fin-sentinel::fin-sentinel.settings.ai.test_email.ai_failed', ['reason' => $aiSuggestion->reason ?? '']),
                            AiSuggestionState::SKIPPED => __('fin-sentinel::fin-sentinel.settings.ai.test_email.ai_skipped', ['reason' => $aiSuggestion->reason ?? '']),
                            default => null,
                        };

                        $title = __('fin-sentinel::fin-sentinel.settings.test_email.sent', [
                            'count' => count($settings->error_recipients),
                        ]);
                        if ($aiSuffix !== null) {
                            $title .= ' '.$aiSuffix;
                        }

                        Notification::make()
                            ->title($title)
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
                            ->addActionLabel(__('fin-sentinel::fin-sentinel.settings.add_recipient'))
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

                Section::make(__('fin-sentinel::fin-sentinel.settings.error.ignored_exceptions'))
                    ->description(__('fin-sentinel::fin-sentinel.settings.error.ignored_exceptions_description'))
                    ->schema([
                        Repeater::make('ignored_exceptions')
                            ->hiddenLabel()
                            ->addActionLabel(__('fin-sentinel::fin-sentinel.settings.error.add_exception'))
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

            Group::make([
                Section::make(__('fin-sentinel::fin-sentinel.settings.ai.section'))
                    ->description(__('fin-sentinel::fin-sentinel.settings.ai.section_helper'))
                    ->icon(Heroicon::OutlinedSparkles)
                    ->visible(fn (): bool => FinSentinel::aiAvailable())
                    ->columns(['lg' => 2])
                    ->schema([
                        Callout::make()
                            ->heading(__('fin-sentinel::fin-sentinel.settings.ai.no_providers'))
                            ->color('warning')
                            ->visible(fn (): bool => empty($this->aiProviderOptions()))
                            ->columnSpanFull(),

                        Toggle::make('ai_enabled')
                            ->label(__('fin-sentinel::fin-sentinel.settings.ai.enabled'))
                            ->helperText(__('fin-sentinel::fin-sentinel.settings.ai.enabled_helper'))
                            ->columnSpanFull(),

                        Select::make('ai_provider')
                            ->label(__('fin-sentinel::fin-sentinel.settings.ai.provider'))
                            ->options(fn (): array => $this->aiProviderOptions())
                            ->disabled(fn (): bool => empty($this->aiProviderOptions()))
                            ->live()
                            ->required(fn (callable $get): bool => (bool) $get('ai_enabled'))
                            ->searchable()
                            ->native(false),

                        Select::make('ai_model')
                            ->label(__('fin-sentinel::fin-sentinel.settings.ai.model'))
                            ->options(fn (callable $get): array => $this->aiModelOptionsFor((string) ($get('ai_provider') ?? '')))
                            ->disabled(fn (callable $get): bool => blank($get('ai_provider')))
                            ->placeholder(__('fin-sentinel::fin-sentinel.settings.ai.model_placeholder'))
                            ->required(fn (callable $get): bool => (bool) $get('ai_enabled'))
                            ->searchable()
                            ->native(false),

                        Textarea::make('ai_prompt_template')
                            ->label(__('fin-sentinel::fin-sentinel.settings.ai.prompt_template'))
                            ->helperText(__('fin-sentinel::fin-sentinel.settings.ai.prompt_template_helper'))
                            ->placeholder(__('fin-sentinel::fin-sentinel.settings.ai.prompt_template_placeholder'))
                            ->rows(8)
                            ->maxLength(10000)
                            ->required(fn (callable $get): bool => (bool) $get('ai_enabled'))
                            ->rules([
                                fn () => function (string $attribute, mixed $value, Closure $fail): void {
                                    if (! str_contains((string) $value, '{{error}}')) {
                                        $fail(__('fin-sentinel::fin-sentinel.settings.ai.template_missing_token'));
                                    }
                                },
                            ])
                            ->columnSpanFull(),

                        TextInput::make('ai_api_key')
                            ->label(__('fin-sentinel::fin-sentinel.settings.ai.api_key'))
                            ->password()
                            ->revealable()
                            ->placeholder(fn (): string => filled(app(ErrorChannelSettings::class)->ai_api_key)
                                ? __('fin-sentinel::fin-sentinel.settings.ai.api_key_set')
                                : __('fin-sentinel::fin-sentinel.settings.ai.api_key_enter'))
                            ->required(fn (callable $get): bool => (bool) $get('ai_enabled') && blank(app(ErrorChannelSettings::class)->ai_api_key))
                            ->suffixAction($this->testAiConnectionAction())
                            ->columnSpanFull(),

                        TextInput::make('ai_timeout')
                            ->label(__('fin-sentinel::fin-sentinel.settings.ai.timeout'))
                            ->helperText(__('fin-sentinel::fin-sentinel.settings.ai.timeout_helper'))
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(10)
                            ->required()
                            ->suffix(__('fin-sentinel::fin-sentinel.settings.seconds_suffix')),

                        TextInput::make('ai_max_tokens')
                            ->label(__('fin-sentinel::fin-sentinel.settings.ai.max_tokens'))
                            ->numeric()
                            ->minValue(1)
                            ->required(),

                        TextInput::make('ai_hourly_cap')
                            ->label(__('fin-sentinel::fin-sentinel.settings.ai.hourly_cap'))
                            ->helperText(__('fin-sentinel::fin-sentinel.settings.ai.hourly_cap_helper'))
                            ->numeric()
                            ->minValue(0)
                            ->required(),

                        TextInput::make('ai_cache_ttl_minutes')
                            ->label(__('fin-sentinel::fin-sentinel.settings.ai.cache_ttl'))
                            ->helperText(__('fin-sentinel::fin-sentinel.settings.ai.cache_ttl_helper'))
                            ->numeric()
                            ->minValue(5)
                            ->maxValue(1440)
                            ->required(fn (callable $get): bool => (bool) $get('ai_enabled'))
                            ->suffix(__('fin-sentinel::fin-sentinel.settings.minutes_suffix')),

                        Toggle::make('ai_strict_scrubbing')
                            ->label(__('fin-sentinel::fin-sentinel.settings.ai.strict_scrubbing'))
                            ->helperText(__('fin-sentinel::fin-sentinel.settings.ai.strict_scrubbing_helper'))
                            ->columnSpanFull(),

                        Section::make(__('fin-sentinel::fin-sentinel.settings.ai.usage_section'))
                            ->columnSpanFull()
                            ->schema([
                                TextEntry::make('ai_usage_last_call')
                                    ->label(__('fin-sentinel::fin-sentinel.settings.ai.usage_last_call_label'))
                                    ->state(function (): string {
                                        $raw = Cache::get('fin-sentinel:ai:tokens:last');
                                        if ($raw === null) {
                                            return __('fin-sentinel::fin-sentinel.settings.ai.usage_empty_marker');
                                        }
                                        $data = json_decode((string) $raw, true);
                                        if (! is_array($data) || ! isset($data['prompt'])) {
                                            return __('fin-sentinel::fin-sentinel.settings.ai.usage_empty_marker');
                                        }
                                        $prompt = (int) $data['prompt'];
                                        $completion = (int) ($data['completion'] ?? 0);
                                        $state = (string) ($data['state'] ?? 'unknown');

                                        return sprintf(
                                            '%s prompt + %s completion = %s tokens [%s]',
                                            number_format($prompt),
                                            number_format($completion),
                                            number_format($prompt + $completion),
                                            $state,
                                        );
                                    }),

                                TextEntry::make('ai_usage_month')
                                    ->label(__('fin-sentinel::fin-sentinel.settings.ai.usage_month_label'))
                                    ->state(function (): string {
                                        $monthKey = 'fin-sentinel:ai:tokens:'.now()->format('Y-m');
                                        $total = Cache::get($monthKey);
                                        if ($total === null) {
                                            return __('fin-sentinel::fin-sentinel.settings.ai.usage_empty_marker');
                                        }

                                        return number_format((int) $total).' '.__('fin-sentinel::fin-sentinel.settings.ai.usage_tokens_suffix');
                                    }),
                            ]),
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

        // Spatie returns decrypted values; never expose the API key to form HTML.
        $data['ai_api_key'] = '';

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

        if (blank($data['ai_api_key'] ?? null)) {
            $data['ai_api_key'] = app(ErrorChannelSettings::class)->ai_api_key;
        }

        return $data;
    }

    /**
     * @return array<string, string>
     */
    private function aiProviderOptions(): array
    {
        if ($this->aiProviderOptionsCache !== null) {
            return $this->aiProviderOptionsCache;
        }

        return $this->aiProviderOptionsCache = AiProviderLabels::all();
    }

    /**
     * @return array<string, string>
     */
    private function aiModelOptionsFor(string $provider): array
    {
        if (blank($provider) || ! FinSentinel::aiAvailable()) {
            return [];
        }

        $aiManager = 'Laravel\\Ai\\AiManager';

        try {
            $manager = app($aiManager);
            $instance = $manager->textProvider($provider);

            $default = $instance->defaultTextModel();
            $cheapest = $instance->cheapestTextModel();
            $smartest = $instance->smartestTextModel();

            $options = [];
            $options[$default] = sprintf('%s (default)', $default);
            if ($cheapest !== $default) {
                $options[$cheapest] = sprintf('%s (cheapest)', $cheapest);
            }
            if ($smartest !== $default && $smartest !== $cheapest) {
                $options[$smartest] = sprintf('%s (smartest)', $smartest);
            }

            return $options;
        } catch (\Throwable) {
            return [];
        }
    }

    private function testAiConnectionAction(): Action
    {
        return Action::make('testAiConnection')
            ->label(__('fin-sentinel::fin-sentinel.settings.ai.test_connection'))
            ->icon(Heroicon::OutlinedSignal)
            ->action(function (callable $get): void {
                $provider = (string) ($get('ai_provider') ?? '');
                $model = (string) ($get('ai_model') ?? '');
                $apiKey = (string) ($get('ai_api_key') ?? '');

                if (blank($apiKey)) {
                    $apiKey = (string) (app(ErrorChannelSettings::class)->ai_api_key ?? '');
                }

                if (blank($provider) || blank($model) || blank($apiKey)) {
                    Notification::make()
                        ->title(__('fin-sentinel::fin-sentinel.settings.ai.test_connection_missing'))
                        ->warning()
                        ->send();

                    return;
                }

                if (! FinSentinel::aiAvailable()) {
                    Notification::make()
                        ->title(__('fin-sentinel::fin-sentinel.settings.ai.test_connection_no_sdk'))
                        ->danger()
                        ->send();

                    return;
                }

                $names = $this->sdkNames();
                $agentFn = $names['agent'];
                $labFqcn = $names['lab'];

                try {
                    $providerEnum = $labFqcn::from($provider);

                    $response = $this->withProviderKey(
                        $provider,
                        $apiKey,
                        fn () => $agentFn('', [], [])->prompt(
                            'Reply with the single word OK.',
                            provider: $providerEnum,
                            model: $model,
                            timeout: 10,
                        ),
                    );

                    (string) $response;

                    Notification::make()
                        ->title(__('fin-sentinel::fin-sentinel.settings.ai.test_connection_success'))
                        ->success()
                        ->send();
                } catch (\Throwable $e) {
                    Notification::make()
                        ->title(__('fin-sentinel::fin-sentinel.settings.ai.test_connection_failed'))
                        ->body($e->getMessage())
                        ->danger()
                        ->send();
                }
            });
    }

    private function withProviderKey(string $provider, string $apiKey, callable $fn): mixed
    {
        $configKey = "ai.providers.{$provider}.key";
        $previousKey = config($configKey);
        $aiFacade = '\\Laravel\\Ai\\Ai';

        config([$configKey => $apiKey]);
        $aiFacade::forgetInstance($provider);

        try {
            return $fn();
        } finally {
            config([$configKey => $previousKey]);
            $aiFacade::forgetInstance($provider);
        }
    }

    /**
     * @return array{agent: string, lab: string}
     */
    private function sdkNames(): array
    {
        $ns = trim('\Laravel\Ai', '\\');

        return [
            'agent' => $ns.'\\agent',
            'lab' => $ns.'\\Enums\\Lab',
        ];
    }
}
