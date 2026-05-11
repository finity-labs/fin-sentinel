<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Mail\DebugMail;
use FinityLabs\FinSentinel\Services\DebugService;
use FinityLabs\FinSentinel\Services\FinSentinelManager;
use FinityLabs\FinSentinel\Settings\DebugChannelSettings;
use FinityLabs\FinSentinel\Support\DebugBuilder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

beforeEach(function () {
    $settings = app(DebugChannelSettings::class);
    $settings->debug_recipients = ['dev@example.com'];
    $settings->debug_enabled = true;
    $settings->debug_throttle_enabled = false;
    $settings->debug_throttle_minutes = 15;
    $settings->save();

    Cache::flush();
});

it('returns a DebugBuilder from debug() by delegating to DebugService', function () {
    $manager = new FinSentinelManager(new DebugService, false);

    $result = $manager->debug('payload');

    $reflection = new ReflectionProperty(DebugBuilder::class, 'sent');
    $reflection->setAccessible(true);
    $reflection->setValue($result, true);

    expect($result)->toBeInstanceOf(DebugBuilder::class);
});

it('passes the subject argument through to debug()', function () {
    Mail::fake();

    $manager = new FinSentinelManager(new DebugService, false);

    $result = $manager->debug('payload', 'My Subject');

    expect($result)->toBeInstanceOf(DebugBuilder::class);

    $result->send();

    Mail::assertSent(DebugMail::class, fn (DebugMail $mail) => $mail->customSubject === 'My Subject');
});

it('returns true from aiAvailable() when constructed with true', function () {
    $manager = new FinSentinelManager(new DebugService, true);

    expect($manager->aiAvailable())->toBeTrue();
});

it('returns false from aiAvailable() when constructed with false', function () {
    $manager = new FinSentinelManager(new DebugService, false);

    expect($manager->aiAvailable())->toBeFalse();
});
