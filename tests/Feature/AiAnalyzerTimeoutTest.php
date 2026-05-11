<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Contracts\AiErrorAnalyzerContract;
use FinityLabs\FinSentinel\Services\DataScrubber;
use FinityLabs\FinSentinel\Settings\ErrorChannelSettings;
use FinityLabs\FinSentinel\Support\AiSuggestionState;
use FinityLabs\FinSentinel\Support\ScrubbedErrorPayload;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Cache;

beforeEach(function () {
    if (! class_exists('Laravel\\Ai\\AnonymousAgent')) {
        $this->markTestSkipped('laravel/ai not installed (without-SDK CI row)');
    }

    app()->forgetInstance('fin-sentinel.ai-available');
    app()->forgetInstance('fin-sentinel.manager');
    app()->forgetInstance(AiErrorAnalyzerContract::class);
    app()->instance('fin-sentinel.ai-available', true);

    Cache::forget('fin-sentinel:ai:breaker:state');
    Cache::forget('fin-sentinel:ai:breaker:fails');
    Cache::forget('fin-sentinel:ai:cap:'.now()->format('Y-m-d:H'));

    config([
        'ai.default' => 'anthropic',
        'ai.providers.anthropic.driver' => 'anthropic',
        'ai.providers.anthropic.key' => 'sk-ant-fake-test-key',
    ]);

    $settings = app(ErrorChannelSettings::class);
    $settings->ai_enabled = true;
    $settings->ai_provider = 'anthropic';
    $settings->ai_model = 'claude-haiku-4-5-20251001';
    $settings->ai_api_key = 'sk-ant-fake-test-key';
    $settings->ai_timeout = 3;
    $settings->ai_hourly_cap = 50;
    $settings->ai_cache_ttl_minutes = 60;
    $settings->ai_prompt_template = 'Analyze: {{error}}';
    $settings->save();
});

afterEach(function () {
    Cache::forget('fin-sentinel:ai:breaker:state');
    Cache::forget('fin-sentinel:ai:breaker:fails');
    Cache::forget('fin-sentinel:ai:cap:'.now()->format('Y-m-d:H'));
});

it('returns FAILED with timeout reason when SDK throws ConnectionException, with no retry and no real wait', function () {
    $gateway = fakeAnthropicGateway(throws: new ConnectionException(
        'cURL error 28: Operation timed out after 3000 milliseconds'
    ));
    bindFakeAnthropicProvider($gateway);

    $analyzer = app(AiErrorAnalyzerContract::class);
    $payload = ScrubbedErrorPayload::fromException(
        new RuntimeException('timeout-trigger payload'),
        app(DataScrubber::class),
    );

    $start = microtime(true);
    $result = $analyzer->analyze($payload);
    $elapsed = microtime(true) - $start;

    expect($result->state)->toBe(AiSuggestionState::FAILED);
    expect($result->reason)->toBe('timeout');
    expect($elapsed)->toBeLessThan(0.5);
    expect($gateway->calls)->toBe(1);
});

it('threads the configured ai_timeout into the SDK prompt() call', function () {
    $gateway = fakeAnthropicGateway();
    bindFakeAnthropicProvider($gateway);

    $settings = app(ErrorChannelSettings::class);
    $settings->ai_timeout = 7;
    $settings->save();

    $analyzer = app(AiErrorAnalyzerContract::class);
    $payload = ScrubbedErrorPayload::fromException(
        new RuntimeException('timeout-arg-wiring payload'),
        app(DataScrubber::class),
    );

    $analyzer->analyze($payload);

    expect($gateway->capturedTimeout)->toBe(7);
});
