<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Tests;

use FinityLabs\FinSentinel\FinSentinelServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\LaravelSettings\LaravelSettingsServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/../database/settings');
    }

    protected function getPackageProviders($app): array
    {
        return [
            LaravelSettingsServiceProvider::class,
            FinSentinelServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $app['config']->set('mail.default', 'array');

        $app['config']->set('fin-sentinel.scrub.params', ['password', 'secret', 'token']);
        $app['config']->set('fin-sentinel.scrub.headers', ['authorization']);
        $app['config']->set('fin-sentinel.scrub.env', ['DB_PASSWORD']);
        $app['config']->set('fin-sentinel.scrub.trace_args', ['password']);
    }
}
