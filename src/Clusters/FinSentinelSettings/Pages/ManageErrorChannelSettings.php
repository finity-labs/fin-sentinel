<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Clusters\FinSentinelSettings\Pages;

use BackedEnum;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use FinityLabs\FinSentinel\Clusters\FinSentinelSettings\FinSentinelSettings;
use FinityLabs\FinSentinel\Settings\ErrorChannelSettings;
use FinityLabs\FinSentinel\Traits\HasPageShieldSupport;

class ManageErrorChannelSettings extends SettingsPage
{
    use HasPageShieldSupport;

    protected static ?string $cluster = FinSentinelSettings::class;

    protected static string $settings = ErrorChannelSettings::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedExclamationTriangle;

    protected static ?int $navigationSort = 1;

    public const KNOWN_EXCEPTIONS = [
        'Symfony\Component\HttpKernel\Exception\NotFoundHttpException' => 'NotFoundHttpException',
        'Illuminate\Validation\ValidationException' => 'ValidationException',
        'Illuminate\Auth\AuthenticationException' => 'AuthenticationException',
        'Illuminate\Database\Eloquent\ModelNotFoundException' => 'ModelNotFoundException',
        'Illuminate\Session\TokenMismatchException' => 'TokenMismatchException',
        'Illuminate\Http\Exceptions\ThrottleRequestsException' => 'ThrottleRequestsException',
    ];

    public static function getNavigationLabel(): string
    {
        return 'Error Channel';
    }

    public function getTitle(): string
    {
        return 'Error Channel Settings';
    }

    public function form(Schema $schema): Schema
    {
        return $schema->schema([
            Toggle::make('error_enabled')
                ->label('Enable error notifications')
                ->helperText('When disabled, no error emails will be sent.')
                ->live(),

            Placeholder::make('disabled_warning')
                ->label('')
                ->content('This channel is currently disabled.')
                ->extraAttributes(['class' => 'text-warning-600 dark:text-warning-400 font-medium'])
                ->visible(fn (callable $get): bool => ! $get('error_enabled')),

            Placeholder::make('no_recipients_warning')
                ->label('')
                ->content('No recipients configured -- notifications won\'t be sent until at least one email is added.')
                ->extraAttributes(['class' => 'text-warning-600 dark:text-warning-400 font-medium'])
                ->visible(fn (callable $get): bool => empty($get('error_recipients'))),

            Section::make('Recipients')
                ->schema([
                    Repeater::make('error_recipients')
                        ->label('')
                        ->helperText('Add email addresses that will receive error notifications.')
                        ->schema([
                            TextInput::make('email')
                                ->label('Email address')
                                ->email()
                                ->required()
                                ->maxLength(255),
                        ])
                        ->defaultItems(0)
                        ->collapsible()
                        ->itemLabel(fn (array $state): string => $state['email'] ?? 'New recipient'),
                ]),

            Section::make('Throttling')
                ->schema([
                    TextInput::make('error_throttle_minutes')
                        ->label('Throttle rate')
                        ->helperText('Minimum minutes between duplicate error emails.')
                        ->numeric()
                        ->required()
                        ->minValue(1)
                        ->maxValue(1440)
                        ->suffix('minutes'),
                ]),

            Section::make('Ignored Exceptions')
                ->description('Exceptions in this list will not trigger email notifications.')
                ->schema([
                    Repeater::make('ignored_exceptions')
                        ->label('')
                        ->schema([
                            Select::make('exception')
                                ->options(array_merge(
                                    static::KNOWN_EXCEPTIONS,
                                    ['other' => 'Other (custom)']
                                ))
                                ->required()
                                ->live(),
                            TextInput::make('custom_class')
                                ->label('Exception class (FQCN)')
                                ->visible(fn (callable $get): bool => $get('exception') === 'other')
                                ->required(fn (callable $get): bool => $get('exception') === 'other')
                                ->rules([
                                    fn () => function (string $attribute, $value, $fail) {
                                        if ($value && ! class_exists($value)) {
                                            $fail('This class does not exist.');
                                        }
                                    },
                                ]),
                        ])
                        ->defaultItems(0)
                        ->collapsible()
                        ->itemLabel(fn (array $state): string => $state['exception'] === 'other'
                            ? ($state['custom_class'] ?? 'Custom exception')
                            : (class_basename($state['exception'] ?? '') ?: 'Select exception')),
                ]),
        ]);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['error_recipients'] = array_map(
            fn (string $email): array => ['email' => $email],
            $data['error_recipients'] ?? []
        );

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
        $data['error_recipients'] = array_values(array_filter(
            array_map(
                fn (array $row): ?string => $row['email'] ?? null,
                $data['error_recipients'] ?? []
            )
        ));

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
