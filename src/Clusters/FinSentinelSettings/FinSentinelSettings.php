<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Clusters\FinSentinelSettings;

use BackedEnum;
use Filament\Clusters\Cluster;
use Filament\Pages\Enums\SubNavigationPosition;
use Filament\Support\Icons\Heroicon;
use FinityLabs\FinSentinel\FinSentinelPlugin;
use UnitEnum;

class FinSentinelSettings extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $slug = 'sentinel-settings';

    protected static ?SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Start;

    public static function canAccess(): bool
    {
        return FinSentinelPlugin::get()->userCanAccess();
    }

    public static function getNavigationSort(): ?int
    {
        return (FinSentinelPlugin::get()->getNavigationSort() ?? 0) + 10;
    }

    public static function getNavigationGroup(): string|UnitEnum|null
    {
        /** @var FinSentinelPlugin $plugin */
        $plugin = filament('fin-sentinel');

        return $plugin->getNavigationGroup();
    }

    public static function getNavigationLabel(): string
    {
        return __('fin-sentinel::fin-sentinel.navigation.settings');
    }

    public static function getClusterBreadcrumb(): ?string
    {
        return __('fin-sentinel::fin-sentinel.navigation.settings');
    }
}
