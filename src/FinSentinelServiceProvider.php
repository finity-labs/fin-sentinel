<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel;

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
            ->hasMigrations([
                '../settings/create_error_channel_settings',
                '../settings/create_debug_channel_settings',
            ])
            ->hasCommands([
                Commands\InstallCommand::class,
                Commands\UninstallCommand::class,
            ]);
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
            // Phase 2+ will add settings-dependent boot logic here.
            // No settings are read during boot in Phase 1.
        } catch (\Throwable) {
            logger()->debug('fin-sentinel: settings table not available yet, skipping settings boot.');
        }
    }
}
