<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Clusters\FinSentinelSettings;

use BackedEnum;
use Filament\Clusters\Cluster;
use Filament\Pages\Enums\SubNavigationPosition;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class FinSentinelSettings extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $slug = 'sentinel-settings';

    protected static ?SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Start;

    public static function getNavigationSort(): ?int
    {
        /** @var \FinityLabs\FinSentinel\FinSentinelPlugin $plugin */
        $plugin = filament('fin-sentinel');

        return $plugin->getNavigationSort();
    }

    public static function getNavigationGroup(): string|UnitEnum|null
    {
        /** @var \FinityLabs\FinSentinel\FinSentinelPlugin $plugin */
        $plugin = filament('fin-sentinel');

        return $plugin->getNavigationGroup();
    }

    public static function getNavigationLabel(): string
    {
        return 'Settings';
    }

    public static function getClusterBreadcrumb(): ?string
    {
        return 'Settings';
    }
}
