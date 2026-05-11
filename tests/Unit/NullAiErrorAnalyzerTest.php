<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Contracts\AiErrorAnalyzerContract;
use FinityLabs\FinSentinel\Services\Ai\NullAiErrorAnalyzer;
use FinityLabs\FinSentinel\Services\DataScrubber;
use FinityLabs\FinSentinel\Support\AiSuggestionState;
use FinityLabs\FinSentinel\Support\ScrubbedErrorPayload;
use Illuminate\Support\Facades\Cache;

beforeEach(function () {
    Cache::forget('fin-sentinel:ai:tokens:last');
    Cache::forget('fin-sentinel:ai:tokens:'.now()->format('Y-m'));
    Cache::forget('fin-sentinel:ai:cap:'.now()->format('Y-m-d:H'));
    Cache::forget('fin-sentinel:ai:breaker:state');
    Cache::forget('fin-sentinel:ai:breaker:fails');
});

afterEach(function () {
    Cache::forget('fin-sentinel:ai:tokens:last');
    Cache::forget('fin-sentinel:ai:tokens:'.now()->format('Y-m'));
    Cache::forget('fin-sentinel:ai:cap:'.now()->format('Y-m-d:H'));
    Cache::forget('fin-sentinel:ai:breaker:state');
    Cache::forget('fin-sentinel:ai:breaker:fails');
});

it('returns DISABLED for any payload with all token fields null', function () {
    $analyzer = new NullAiErrorAnalyzer;
    $payload = ScrubbedErrorPayload::fromException(
        new RuntimeException('anything'),
        app(DataScrubber::class),
    );

    $result = $analyzer->analyze($payload);

    expect($result->state)->toBe(AiSuggestionState::DISABLED);
    expect($result->suggestion)->toBeNull();
    expect($result->reason)->toBeNull();
    expect($result->promptTokens)->toBeNull();
    expect($result->completionTokens)->toBeNull();
});

it('never writes any cache key across repeated calls', function () {
    $analyzer = new NullAiErrorAnalyzer;
    $payload = ScrubbedErrorPayload::fromException(
        new RuntimeException('repeated'),
        app(DataScrubber::class),
    );

    for ($i = 0; $i < 5; $i++) {
        $analyzer->analyze($payload);
    }

    expect(Cache::has('fin-sentinel:ai:tokens:last'))->toBeFalse();
    expect(Cache::has('fin-sentinel:ai:tokens:'.now()->format('Y-m')))->toBeFalse();
    expect(Cache::has('fin-sentinel:ai:cap:'.now()->format('Y-m-d:H')))->toBeFalse();
    expect(Cache::has('fin-sentinel:ai:breaker:state'))->toBeFalse();
    expect(Cache::has('fin-sentinel:ai:breaker:fails'))->toBeFalse();
});

it('implements AiErrorAnalyzerContract', function () {
    expect(new NullAiErrorAnalyzer)->toBeInstanceOf(AiErrorAnalyzerContract::class);
});
