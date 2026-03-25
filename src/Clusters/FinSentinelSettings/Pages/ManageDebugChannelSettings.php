<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Clusters\FinSentinelSettings\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Schemas\Components\Callout;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use FinityLabs\FinSentinel\Clusters\FinSentinelSettings\FinSentinelSettings;
use FinityLabs\FinSentinel\Mail\DebugMail;
use FinityLabs\FinSentinel\Settings\DebugChannelSettings;
use FinityLabs\FinSentinel\Traits\HasPageShieldSupport;
use Illuminate\Support\Facades\Mail;

class ManageDebugChannelSettings extends SettingsPage
{
    use HasPageShieldSupport;

    protected static ?string $cluster = FinSentinelSettings::class;

    protected static string $settings = DebugChannelSettings::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBugAnt;

    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('fin-sentinel::fin-sentinel.debug_channel_nav_label');
    }

    public function getTitle(): string
    {
        return __('fin-sentinel::fin-sentinel.debug_channel_title');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('sendTestEmail')
                ->label(__('fin-sentinel::fin-sentinel.test_email_send'))
                ->icon(Heroicon::OutlinedPaperAirplane)
                ->color('primary')
                ->action(function (): void {
                    $settings = app(DebugChannelSettings::class);

                    if (empty($settings->debug_recipients)) {
                        Notification::make()
                            ->title(__('fin-sentinel::fin-sentinel.test_email_no_recipients'))
                            ->danger()
                            ->send();

                        return;
                    }

                    if (! $settings->debug_enabled) {
                        Notification::make()
                            ->title(__('fin-sentinel::fin-sentinel.test_email_channel_disabled'))
                            ->warning()
                            ->send();
                    }

                    try {
                        $testMail = new DebugMail(
                            formattedData: [
                                'type' => 'array',
                                'data' => [
                                    'message' => 'This is a test debug email from FinSentinel',
                                    'timestamp' => now()->toDateTimeString(),
                                    'status' => 'working',
                                ],
                            ],
                            callSite: ['file' => 'FinSentinel Settings Page', 'line' => 0],
                            requestContext: DebugMail::buildRequestContext(),
                            environmentContext: DebugMail::buildEnvironmentContext(),
                            customSubject: '[TEST] Test Debug Notification',
                        );

                        Mail::to($settings->debug_recipients)->send($testMail);

                        Notification::make()
                            ->title(__('fin-sentinel::fin-sentinel.test_email_sent', [
                                'count' => count($settings->debug_recipients),
                            ]))
                            ->success()
                            ->send();
                    } catch (\Throwable $e) {
                        Notification::make()
                            ->title(__('fin-sentinel::fin-sentinel.test_email_failed'))
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
            Toggle::make('debug_enabled')
                ->label(__('fin-sentinel::fin-sentinel.debug_enabled_label'))
                ->helperText(__('fin-sentinel::fin-sentinel.debug_enabled_helper'))
                ->columnSpanFull(),

            Section::make(__('fin-sentinel::fin-sentinel.section_recipients'))
                ->schema([
                    Callout::make()
                        ->heading(__('fin-sentinel::fin-sentinel.no_recipients_warning'))
                        ->color('warning')
                        ->visible(fn (callable $get): bool => empty(array_filter((array) $get('debug_recipients')))),

                    Repeater::make('debug_recipients')
                        ->hiddenLabel()
                        ->helperText(__('fin-sentinel::fin-sentinel.debug_recipients_helper'))
                        ->simple(
                            TextInput::make('email')
                                ->label(__('fin-sentinel::fin-sentinel.email_address_label'))
                                ->email()
                                ->required()
                                ->maxLength(255),
                        )
                        ->defaultItems(0)
                        ->live(),
                ]),

            Section::make(__('fin-sentinel::fin-sentinel.section_throttling'))
                ->columns(['lg' => 2])
                ->schema([
                    Toggle::make('debug_throttle_enabled')
                        ->label(__('fin-sentinel::fin-sentinel.debug_throttle_enabled_label'))
                        ->helperText(__('fin-sentinel::fin-sentinel.debug_throttle_enabled_helper'))
                        ->live()
                        ->columnSpanFull(),

                    TextInput::make('debug_throttle_minutes')
                        ->label(__('fin-sentinel::fin-sentinel.throttle_rate_label'))
                        ->helperText(__('fin-sentinel::fin-sentinel.debug_throttle_helper'))
                        ->numeric()
                        ->required()
                        ->minValue(1)
                        ->maxValue(1440)
                        ->suffix(__('fin-sentinel::fin-sentinel.minutes_suffix'))
                        ->visible(fn (callable $get): bool => (bool) $get('debug_throttle_enabled'))
                ]),
        ]);
    }

}
