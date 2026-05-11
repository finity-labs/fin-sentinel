<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Settings\ErrorChannelSettings;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Spatie\LaravelSettings\Attributes\ShouldBeEncrypted;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

it('defaults ai_enabled to false on a fresh instance', function () {
    $settings = new ErrorChannelSettings;

    expect($settings->ai_enabled)->toBeFalse();
});

it('defaults ai_provider, ai_model and ai_api_key to null on a fresh instance', function () {
    $settings = new ErrorChannelSettings;

    expect($settings->ai_provider)->toBeNull();
    expect($settings->ai_model)->toBeNull();
    expect($settings->ai_api_key)->toBeNull();
});

it('defaults numeric ai_* fields to documented values on a fresh instance', function () {
    $settings = new ErrorChannelSettings;

    expect($settings->ai_timeout)->toBe(3);
    expect($settings->ai_max_tokens)->toBe(250);
    expect($settings->ai_hourly_cap)->toBe(50);
});

it('defaults ai_strict_scrubbing to false on a fresh instance', function () {
    $settings = new ErrorChannelSettings;

    expect($settings->ai_strict_scrubbing)->toBeFalse();
});

it('carries the ShouldBeEncrypted attribute on ai_api_key', function () {
    $property = new ReflectionProperty(ErrorChannelSettings::class, 'ai_api_key');
    $attributes = $property->getAttributes(ShouldBeEncrypted::class);

    expect($attributes)->toHaveCount(1);
});

it('preserves v1.0 property defaults', function () {
    $settings = new ErrorChannelSettings;

    expect($settings->error_recipients)->toBe([]);
    expect($settings->error_enabled)->toBeTrue();
    expect($settings->error_throttle_minutes)->toBe(15);
    expect($settings->error_throttle_exceptions)->toBeTrue();
    expect($settings->error_throttle_log_messages)->toBeTrue();
    expect($settings->ignored_exceptions)->toBe([
        NotFoundHttpException::class,
        ValidationException::class,
        AuthenticationException::class,
    ]);
});

it('keeps the fin-sentinel Spatie group identifier', function () {
    expect(ErrorChannelSettings::group())->toBe('fin-sentinel');
});

it('declares ai_cache_ttl_minutes with the documented default at the property level', function () {
    $property = new ReflectionProperty(ErrorChannelSettings::class, 'ai_cache_ttl_minutes');

    expect($property->hasDefaultValue())->toBeTrue();
    expect($property->getDefaultValue())->toBe(60);
});

it('declares ai_cache_ttl_minutes as a public int property', function () {
    $property = new ReflectionProperty(ErrorChannelSettings::class, 'ai_cache_ttl_minutes');

    expect($property->isPublic())->toBeTrue();
    expect($property->isStatic())->toBeFalse();

    $type = $property->getType();
    expect($type)->toBeInstanceOf(ReflectionNamedType::class);
    /** @var ReflectionNamedType $type */
    expect($type->getName())->toBe('int');
    expect($type->allowsNull())->toBeFalse();
});
