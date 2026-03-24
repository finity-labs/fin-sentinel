<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Tests;

use FinityLabs\FinSentinel\FinSentinelServiceProvider;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\LaravelSettings\LaravelSettingsServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::create('settings', function (Blueprint $table): void {
            $table->id();
            $table->string('group');
            $table->string('name');
            $table->boolean('locked')->default(false);
            $table->json('payload');
            $table->timestamps();
            $table->unique(['group', 'name']);
        });

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
