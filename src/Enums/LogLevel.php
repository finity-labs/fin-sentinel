<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Enums;

use BackedEnum;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Icons\Heroicon;

enum LogLevel: string implements HasColor, HasIcon, HasLabel
{
    case Emergency = 'EMERGENCY';
    case Alert = 'ALERT';
    case Critical = 'CRITICAL';
    case Error = 'ERROR';
    case Warning = 'WARNING';
    case Notice = 'NOTICE';
    case Info = 'INFO';
    case Debug = 'DEBUG';

    public function getLabel(): string
    {
        return (string) __('fin-sentinel::fin-sentinel.enums.log_level.'.$this->value);
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Emergency, self::Alert, self::Critical, self::Error => 'danger',
            self::Warning => 'warning',
            self::Notice => 'info',
            self::Info => 'success',
            self::Debug => 'gray',
        };
    }

    public function getIcon(): BackedEnum
    {
        return match ($this) {
            self::Emergency => Heroicon::OutlinedFire,
            self::Alert => Heroicon::OutlinedBellAlert,
            self::Critical => Heroicon::OutlinedXCircle,
            self::Error => Heroicon::OutlinedExclamationCircle,
            self::Warning => Heroicon::OutlinedExclamationTriangle,
            self::Notice => Heroicon::OutlinedMegaphone,
            self::Info => Heroicon::OutlinedInformationCircle,
            self::Debug => Heroicon::OutlinedBugAnt,
        };
    }
}
