<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\FinSentinelServiceProvider;
use FinityLabs\FinSentinel\Settings\ErrorChannelSettings;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelPackageTools\Package;

it('reads back ai_enabled=false after migrating', function () {
    $settings = app(ErrorChannelSettings::class);

    expect($settings->ai_enabled)->toBeFalse();
});

it('reads back null ai_provider, ai_model and ai_api_key after migrating', function () {
    $settings = app(ErrorChannelSettings::class);

    expect($settings->ai_provider)->toBeNull();
    expect($settings->ai_model)->toBeNull();
    expect($settings->ai_api_key)->toBeNull();
});

it('reads back numeric ai_* defaults after migrating', function () {
    $settings = app(ErrorChannelSettings::class);

    expect($settings->ai_timeout)->toBe(3);
    expect($settings->ai_max_tokens)->toBe(250);
    expect($settings->ai_hourly_cap)->toBe(50);
    expect($settings->ai_strict_scrubbing)->toBeFalse();
});

it('inserts all 8 ai_* rows into the settings table', function () {
    $names = DB::table('settings')
        ->where('group', 'fin-sentinel')
        ->whereIn('name', [
            'ai_enabled',
            'ai_provider',
            'ai_model',
            'ai_api_key',
            'ai_timeout',
            'ai_max_tokens',
            'ai_strict_scrubbing',
            'ai_hourly_cap',
        ])
        ->pluck('name')
        ->all();

    expect($names)->toHaveCount(8);
});

it('keeps existing v1.0 keys intact alongside the additive migration', function () {
    $exists = DB::table('settings')
        ->where('group', 'fin-sentinel')
        ->where('name', 'error_enabled')
        ->exists();

    expect($exists)->toBeTrue();
});

it('registers the additive migration as the second hasMigrations entry', function () {
    $provider = new FinSentinelServiceProvider(app());
    $package = new Package;
    $package->name('fin-sentinel');

    $provider->configurePackage($package);

    expect($package->migrationFileNames)->toContain('../settings/create_fin_sentinel_settings');
    expect($package->migrationFileNames)->toContain('../settings/add_fin_sentinel_ai_settings');

    $createIndex = array_search('../settings/create_fin_sentinel_settings', $package->migrationFileNames, true);
    $addIndex = array_search('../settings/add_fin_sentinel_ai_settings', $package->migrationFileNames, true);

    expect($addIndex)->toBeGreaterThan($createIndex);
});
