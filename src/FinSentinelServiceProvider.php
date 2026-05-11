<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel;

use Composer\InstalledVersions;
use FinityLabs\FinSentinel\Contracts\AiErrorAnalyzerContract;
use FinityLabs\FinSentinel\Events\SentinelDebug;
use FinityLabs\FinSentinel\Listeners\MessageLoggedListener;
use FinityLabs\FinSentinel\Listeners\SentinelDebugListener;
use FinityLabs\FinSentinel\Services\Ai\AiErrorAnalyzer;
use FinityLabs\FinSentinel\Services\Ai\NullAiErrorAnalyzer;
use FinityLabs\FinSentinel\Services\DebugService;
use FinityLabs\FinSentinel\Services\FinSentinelManager;
use FinityLabs\FinSentinel\Settings\DebugChannelSettings;
use FinityLabs\FinSentinel\Settings\ErrorChannelSettings;
use Illuminate\Log\Events\MessageLogged;
use Illuminate\Support\Facades\Event;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FinSentinelServiceProvider extends PackageServiceProvider
{
    public static string $name = 'fin-sentinel';

    private static bool $handling = false;

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasConfigFile()
            ->hasViews('fin-sentinel')
            ->hasTranslations()
            ->hasMigrations([
                '../settings/create_fin_sentinel_settings',
                '../settings/add_fin_sentinel_ai_settings',
            ])
            ->hasCommands([
                Commands\InstallCommand::class,
                Commands\UninstallCommand::class,
            ]);
    }

    public function register(): void
    {
        parent::register();

        $this->app->singleton('fin-sentinel.debug', fn () => new DebugService);

        $this->app->bind(Services\LogEntryParser::class, fn () => new Services\LogEntryParser(storage_path('logs')));

        $this->app->singleton('fin-sentinel.ai-available', function (): bool {
            return InstalledVersions::isInstalled('laravel/ai');
        });

        $this->app->bind(
            AiErrorAnalyzerContract::class,
            function ($app) {
                return $app->make('fin-sentinel.ai-available')
                    ? $app->make(AiErrorAnalyzer::class)
                    : new NullAiErrorAnalyzer;
            }
        );

        $this->app->singleton('fin-sentinel.manager', function ($app) {
            return new FinSentinelManager(
                $app->make('fin-sentinel.debug'),
                $app->make('fin-sentinel.ai-available'),
            );
        });
    }

    public function packageBooted(): void
    {
        $this->bootExceptionLoopGuard();
        $this->bootSettingsSafe();
    }

    /**
     * Check whether the exception loop guard is currently active.
     */
    public static function isHandling(): bool
    {
        return static::$handling;
    }

    /**
     * Execute a callback within the exception loop guard.
     *
     * Prevents recursive re-entry when the callback itself triggers an exception
     * (e.g., sending an error notification email that fails). The static boolean
     * is always reset in the finally block, even if the callback throws.
     */
    public static function guardedHandle(callable $callback): void
    {
        if (static::$handling) {
            return;
        }

        static::$handling = true;

        try {
            $callback();
        } finally {
            static::$handling = false;
        }
    }

    /**
     * Boot the recursive exception loop guard mechanism.
     *
     * Phase 1: Makes the guard available as static methods. Phase 3 will
     * wire this to the actual exception event listener.
     */
    private function bootExceptionLoopGuard(): void
    {
        // Guard mechanism is available via static methods:
        // FinSentinelServiceProvider::isHandling()
        // FinSentinelServiceProvider::guardedHandle(callable $callback)
    }

    /**
     * Boot settings-dependent logic with crash protection.
     *
     * Wraps all settings access in try/catch so the app doesn't crash
     * before migrations have run (e.g., right after composer require).
     */
    private function bootSettingsSafe(): void
    {
        try {
            $settings = app(ErrorChannelSettings::class);

            if ($settings->error_enabled && ! empty($settings->error_recipients)) {
                Event::listen(MessageLogged::class, MessageLoggedListener::class);
            }

            $debugSettings = app(DebugChannelSettings::class);

            if ($debugSettings->debug_enabled && ! empty($debugSettings->debug_recipients)) {
                Event::listen(SentinelDebug::class, SentinelDebugListener::class);
            }
        } catch (\Throwable) {
            // logger()->debug('fin-sentinel: settings table not available yet, skipping settings boot.');
        }
    }
}
