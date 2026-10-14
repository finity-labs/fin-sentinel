<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Tests;

use BladeUI\Heroicons\BladeHeroiconsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Filament\Actions\ActionsServiceProvider;
use Filament\Facades\Filament;
use Filament\FilamentServiceProvider;
use Filament\Forms\FormsServiceProvider;
use Filament\Infolists\InfolistsServiceProvider;
use Filament\Notifications\NotificationsServiceProvider;
use Filament\Panel;
use Filament\Schemas\SchemasServiceProvider;
use Filament\SpatieLaravelSettingsPluginServiceProvider;
use Filament\Support\SupportServiceProvider;
use Filament\Tables\TablesServiceProvider;
use Filament\Widgets\WidgetsServiceProvider;
use FinityLabs\FinSentinel\Tests\Fixtures\AdminPanelProvider;
use FinityLabs\FinSentinel\Tests\Fixtures\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Livewire\Features\SupportDisablingBackButtonCache\SupportDisablingBackButtonCache;
use Livewire\LivewireServiceProvider;

/**
 * The package harness plus one real Filament panel (admin, default, web
 * guard) carrying FinSentinelPlugin, over an in-memory users table, for the
 * tests that request the plugin's pages over HTTP. Filament's providers come
 * before Livewire's, as in every fin-* harness: Filament rebinds Livewire's
 * DataStore, so Livewire's own registration must be the last word.
 */
class PanelTestCase extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // A component that redirects (the viewer's mount() does) sets this
        // process-global flag, and Livewire then brands every later response
        // in the process with no-store headers; cleared per app boot.
        if (class_exists(SupportDisablingBackButtonCache::class)) {
            SupportDisablingBackButtonCache::$disableBackButtonCache = false;
        }

        Schema::create('users', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    protected function getPackageProviders($app): array
    {
        return [
            BladeIconsServiceProvider::class,
            BladeHeroiconsServiceProvider::class,
            SupportServiceProvider::class,
            ActionsServiceProvider::class,
            SchemasServiceProvider::class,
            InfolistsServiceProvider::class,
            TablesServiceProvider::class,
            FilamentServiceProvider::class,
            FormsServiceProvider::class,
            NotificationsServiceProvider::class,
            WidgetsServiceProvider::class,
            LivewireServiceProvider::class,
            ...parent::getPackageProviders($app),
            SpatieLaravelSettingsPluginServiceProvider::class,
            AdminPanelProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        parent::getEnvironmentSetUp($app);

        $app['config']->set('auth.providers.users.model', User::class);
    }

    /**
     * Make $id the current, serving panel and sign $user in on its guard,
     * for the rows that ask a page class directly rather than over HTTP.
     */
    protected function usesPanel(string $id, ?Authenticatable $user = null): Panel
    {
        $panel = Filament::getPanel($id);

        Filament::setCurrentPanel($panel);
        Filament::setServingStatus();
        Filament::bootCurrentPanel();

        if ($user !== null) {
            $this->actingAs($user, $panel->getAuthGuard());
        }

        return $panel;
    }
}
