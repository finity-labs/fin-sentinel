<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Tests\Fixtures;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use FinityLabs\FinSentinel\FinSentinelPlugin;
use FinityLabs\FinSentinel\Tests\Fixtures\Pages\ShieldedLogFileList;
use FinityLabs\FinSentinel\Tests\Fixtures\Pages\ShieldedLogFileViewer;

/**
 * The admin panel as a host registers it, FinSentinelPlugin with every
 * default, plus the two Shield-branch fixture pages under their own slugs so
 * the real pages and their shielded twins answer side by side.
 */
final class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->pages([Dashboard::class, ShieldedLogFileList::class, ShieldedLogFileViewer::class])
            ->plugin(FinSentinelPlugin::make())
            ->middleware(['web', DisableBladeIconComponents::class, DispatchServingFilamentEvent::class])
            ->authMiddleware([Authenticate::class]);
    }
}
