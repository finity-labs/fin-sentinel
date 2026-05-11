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

it('opens the breaker after 3 consecutive failures and short-circuits the next call', function () {
    bindFakeAnthropicProvider(fakeAnthropicGateway(throws: new ConnectionException('cURL error 28')));

    $analyzer = app(AiErrorAnalyzerContract::class);
    $scrubber = app(DataScrubber::class);

    for ($i = 1; $i <= 3; $i++) {
        $payload = ScrubbedErrorPayload::fromException(
            new RuntimeException("breaker fail {$i}"),
            $scrubber,
        );
        $result = $analyzer->analyze($payload);
        expect($result->state)->toBe(AiSuggestionState::FAILED);
        expect($result->reason)->toBe('timeout');
    }

    expect(Cache::has('fin-sentinel:ai:breaker:state'))->toBeTrue();

    $payload = ScrubbedErrorPayload::fromException(
        new RuntimeException('breaker test 4'),
        $scrubber,
    );
    $result = $analyzer->analyze($payload);

    expect($result->state)->toBe(AiSuggestionState::SKIPPED);
    expect($result->reason)->toBe('circuit open');
});

it('returns SKIPPED circuit open while the breaker state key is set, without invoking the SDK', function () {
    Cache::put('fin-sentinel:ai:breaker:state', true, 300);
    Cache::put('fin-sentinel:ai:breaker:fails', 5);

    $counter = new stdClass;
    $counter->calls = 0;

    $anonAgentClass = 'Laravel\\Ai\\AnonymousAgent';
    $aiFacade = 'Laravel\\Ai\\Ai';
    $aiFacade::fakeAgent($anonAgentClass, function ($prompt) use ($counter) {
        $counter->calls++;

        return 'should not be called';
    });

    $analyzer = app(AiErrorAnalyzerContract::class);
    $payload = ScrubbedErrorPayload::fromException(
        new RuntimeException('breaker open probe'),
        app(DataScrubber::class),
    );

    $result = $analyzer->analyze($payload);

    expect($result->state)->toBe(AiSuggestionState::SKIPPED);
    expect($result->reason)->toBe('circuit open');
    expect($counter->calls)->toBe(0);
});

it('allows the next call after breaker state expires; SUCCESS resets the fail counter', function () {
    Cache::put('fin-sentinel:ai:breaker:state', true, 300);
    Cache::put('fin-sentinel:ai:breaker:fails', 3);

    Cache::forget('fin-sentinel:ai:breaker:state');

    $anonAgentClass = 'Laravel\\Ai\\AnonymousAgent';
    $aiFacade = 'Laravel\\Ai\\Ai';
    $aiFacade::fakeAgent($anonAgentClass, fn ($prompt) => 'recovered suggestion');

    $analyzer = app(AiErrorAnalyzerContract::class);
    $payload = ScrubbedErrorPayload::fromException(
        new RuntimeException('half-open probe'),
        app(DataScrubber::class),
    );
    $result = $analyzer->analyze($payload);

    expect($result->state)->toBe(AiSuggestionState::SUCCESS);
    expect($result->suggestion)->toBe('recovered suggestion');
    expect(Cache::has('fin-sentinel:ai:breaker:fails'))->toBeFalse();
});

it('does not reset the breaker fail counter when the result is SKIPPED', function () {
    Cache::put('fin-sentinel:ai:breaker:fails', 2);

    $settings = app(ErrorChannelSettings::class);
    $settings->ai_hourly_cap = 2;
    $settings->save();

    $bucketKey = 'fin-sentinel:ai:cap:'.now()->format('Y-m-d:H');
    Cache::put($bucketKey, 2, 3600);

    $analyzer = app(AiErrorAnalyzerContract::class);
    $payload = ScrubbedErrorPayload::fromException(
        new RuntimeException('skipped via cap'),
        app(DataScrubber::class),
    );
    $result = $analyzer->analyze($payload);

    expect($result->state)->toBe(AiSuggestionState::SKIPPED);
    expect((int) Cache::get('fin-sentinel:ai:breaker:fails'))->toBe(2);
});
