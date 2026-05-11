<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Contracts\AiErrorAnalyzerContract;
use FinityLabs\FinSentinel\Services\Ai\AiErrorAnalyzer;
use FinityLabs\FinSentinel\Services\DataScrubber;
use FinityLabs\FinSentinel\Settings\ErrorChannelSettings;
use FinityLabs\FinSentinel\Support\AiSuggestionState;
use FinityLabs\FinSentinel\Support\ScrubbedErrorPayload;
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

    $anonAgentClass = 'Laravel\\Ai\\AnonymousAgent';
    $aiFacade = 'Laravel\\Ai\\Ai';
    $aiFacade::fakeAgent($anonAgentClass, fn ($prompt) => 'Likely cause: example. Fix: try X.');
});

afterEach(function () {
    Cache::forget('fin-sentinel:ai:breaker:state');
    Cache::forget('fin-sentinel:ai:breaker:fails');
    Cache::forget('fin-sentinel:ai:cap:'.now()->format('Y-m-d:H'));
});

it('returns CACHED on a second call with id-normalized fingerprint', function () {
    $analyzer = app(AiErrorAnalyzerContract::class);
    $scrubber = app(DataScrubber::class);

    $makeException = fn (string $msg) => new RuntimeException($msg);
    $payload1 = ScrubbedErrorPayload::fromException($makeException('User 42 not found'), $scrubber);
    $payload2 = ScrubbedErrorPayload::fromException($makeException('User 43 not found'), $scrubber);

    $result1 = $analyzer->analyze($payload1);
    $result2 = $analyzer->analyze($payload2);

    expect($result1->state)->toBe(AiSuggestionState::SUCCESS);
    expect($result2->state)->toBe(AiSuggestionState::CACHED);
    expect($result2->suggestion)->toBe($result1->suggestion);
});

it('does not increment the hourly cap counter on a cache hit', function () {
    $bucketKey = 'fin-sentinel:ai:cap:'.now()->format('Y-m-d:H');

    $analyzer = app(AiErrorAnalyzerContract::class);
    $scrubber = app(DataScrubber::class);

    $payload = ScrubbedErrorPayload::fromException(
        new RuntimeException('User 100 not found'),
        $scrubber,
    );

    $analyzer->analyze($payload);
    $capAfterFirst = (int) Cache::get($bucketKey, 0);

    $analyzer->analyze($payload);
    $capAfterSecond = (int) Cache::get($bucketKey, 0);

    expect($capAfterFirst)->toBe(1);
    expect($capAfterSecond)->toBe(1);
});

it('resets the breaker fail counter on a cache hit', function () {
    $analyzer = app(AiErrorAnalyzerContract::class);
    $scrubber = app(DataScrubber::class);

    $payload = ScrubbedErrorPayload::fromException(
        new RuntimeException('Test 200 fail'),
        $scrubber,
    );

    Cache::put('fin-sentinel:ai:breaker:fails', 2);

    $analyzer->analyze($payload);
    expect(Cache::has('fin-sentinel:ai:breaker:fails'))->toBeFalse();

    Cache::put('fin-sentinel:ai:breaker:fails', 2);

    $analyzer->analyze($payload);
    expect(Cache::has('fin-sentinel:ai:breaker:fails'))->toBeFalse();
});

it('writes the cached suggestion under the fin-sentinel:ai: prefix', function () {
    $analyzer = app(AiErrorAnalyzerContract::class);
    $scrubber = app(DataScrubber::class);

    $payload = ScrubbedErrorPayload::fromException(
        new RuntimeException('Cache prefix test 999'),
        $scrubber,
    );

    $analyzer->analyze($payload);

    $reflection = new ReflectionMethod(AiErrorAnalyzer::class, 'aiCacheKey');
    $key = (string) $reflection->invoke($analyzer, $payload);

    expect($key)->toStartWith('fin-sentinel:ai:');
    expect(Cache::has($key))->toBeTrue();
    expect(Cache::get($key))->toBe('Likely cause: example. Fix: try X.');
});
