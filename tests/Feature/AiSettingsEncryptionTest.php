<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Settings\ErrorChannelSettings;
use Illuminate\Support\Facades\DB;

it('persists ai_api_key as ciphertext in the settings payload column', function () {
    $plain = 'sk-ant-api03-this-is-a-fake-key';

    $settings = app(ErrorChannelSettings::class);
    $settings->ai_api_key = $plain;
    $settings->save();

    $rawPayload = DB::table('settings')
        ->where('group', 'fin-sentinel')
        ->where('name', 'ai_api_key')
        ->value('payload');

    $cipher = json_decode($rawPayload, true);

    expect($cipher)->toBeString();
    expect($cipher)->not->toBe($plain);
    expect(decrypt($cipher))->toBe($plain);
});

it('decrypts ai_api_key transparently on the read path', function () {
    $plain = 'sk-ant-api03-this-is-a-fake-key';

    $settings = app(ErrorChannelSettings::class);
    $settings->ai_api_key = $plain;
    $settings->save();

    app()->forgetInstance(ErrorChannelSettings::class);

    expect(app(ErrorChannelSettings::class)->ai_api_key)->toBe($plain);
});

it('preserves null ai_api_key without encrypting null', function () {
    $settings = app(ErrorChannelSettings::class);
    $settings->ai_api_key = null;
    $settings->save();

    $rawPayload = DB::table('settings')
        ->where('group', 'fin-sentinel')
        ->where('name', 'ai_api_key')
        ->value('payload');

    expect(json_decode($rawPayload, true))->toBeNull();
});

it('does not encrypt non-attributed ai_provider property', function () {
    $settings = app(ErrorChannelSettings::class);
    $settings->ai_provider = 'openai';
    $settings->save();

    $rawPayload = DB::table('settings')
        ->where('group', 'fin-sentinel')
        ->where('name', 'ai_provider')
        ->value('payload');

    expect(json_decode($rawPayload, true))->toBe('openai');
});
