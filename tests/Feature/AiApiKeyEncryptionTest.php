<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Settings\ErrorChannelSettings;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

/*
 * The AI key is the one secret this package stores. These tests pin that it
 * never reaches the database readable, whatever spatie/laravel-settings
 * version is installed, and that the migration which repairs rows written
 * by earlier releases is safe to run anywhere.
 */

function finSentinelEncryptApiKeyMigration(): SettingsMigration
{
    return include dirname(__DIR__, 2).'/database/settings/encrypt_fin_sentinel_ai_api_key.php';
}

function finSentinelStoredApiKeyPayload(): mixed
{
    return DB::table('settings')->where('group', 'fin-sentinel')->where('name', 'ai_api_key')->value('payload');
}

function finSentinelFreshSettings(): ErrorChannelSettings
{
    app()->forgetInstance(ErrorChannelSettings::class);

    return app(ErrorChannelSettings::class);
}

it('declares the API key encrypted by method as well as by attribute', function (): void {
    expect(ErrorChannelSettings::encrypted())->toBe(['ai_api_key']);
});

it('stores the key encrypted and reads it back', function (): void {
    $settings = app(ErrorChannelSettings::class);
    $settings->ai_api_key = 'sk-sentinel-plain';
    $settings->save();

    expect(finSentinelStoredApiKeyPayload())->toBeString()
        ->not->toContain('sk-sentinel-plain')
        ->and(finSentinelFreshSettings()->ai_api_key)->toBe('sk-sentinel-plain');
});

describe('encrypt_fin_sentinel_ai_api_key migration', function (): void {
    it('encrypts a key an earlier release wrote in plain text and keeps it readable', function (): void {
        DB::table('settings')->where('group', 'fin-sentinel')->where('name', 'ai_api_key')->update(['payload' => json_encode('sk-legacy-plain')]);

        finSentinelEncryptApiKeyMigration()->up();

        expect(finSentinelStoredApiKeyPayload())->toBeString()
            ->not->toContain('sk-legacy-plain')
            ->and(finSentinelFreshSettings()->ai_api_key)->toBe('sk-legacy-plain');
    });

    it('leaves an encrypted key byte for byte as it is, so it is safe on every install and more than once', function (): void {
        $settings = app(ErrorChannelSettings::class);
        $settings->ai_api_key = 'sk-already-encrypted';
        $settings->save();

        $before = finSentinelStoredApiKeyPayload();

        finSentinelEncryptApiKeyMigration()->up();
        finSentinelEncryptApiKeyMigration()->up();

        expect(finSentinelStoredApiKeyPayload())->toBe($before)
            ->and(finSentinelFreshSettings()->ai_api_key)->toBe('sk-already-encrypted');
    });

    it('leaves a null key alone and does nothing when the row does not exist', function (): void {
        finSentinelEncryptApiKeyMigration()->up();

        expect(finSentinelFreshSettings()->ai_api_key)->toBeNull();

        DB::table('settings')->where('group', 'fin-sentinel')->where('name', 'ai_api_key')->delete();
        finSentinelEncryptApiKeyMigration()->up();

        expect(DB::table('settings')->where('group', 'fin-sentinel')->where('name', 'ai_api_key')->exists())->toBeFalse();
    });
});
