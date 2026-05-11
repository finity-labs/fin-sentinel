<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Contracts\AiErrorAnalyzerContract;
use FinityLabs\FinSentinel\Services\DataScrubber;
use FinityLabs\FinSentinel\Settings\ErrorChannelSettings;
use FinityLabs\FinSentinel\Support\AiSuggestionState;
use FinityLabs\FinSentinel\Support\ScrubbedErrorPayload;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Cache;
use Laravel\Ai\Responses\Data\Meta;
use Laravel\Ai\Responses\Data\Usage;
use Laravel\Ai\Responses\TextResponse;

beforeEach(function () {
    if (! class_exists('Laravel\\Ai\\AnonymousAgent')) {
        $this->markTestSkipped('laravel/ai not installed (without-SDK CI row)');
    }

    app()->forgetInstance('fin-sentinel.ai-available');
    app()->forgetInstance('fin-sentinel.manager');
    app()->forgetInstance(AiErrorAnalyzerContract::class);
    app()->instance('fin-sentinel.ai-available', true);

    Cache::forget('fin-sentinel:ai:tokens:last');
    Cache::forget('fin-sentinel:ai:tokens:'.now()->format('Y-m'));
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
    Cache::forget('fin-sentinel:ai:tokens:last');
    Cache::forget('fin-sentinel:ai:tokens:'.now()->format('Y-m'));
    Cache::forget('fin-sentinel:ai:breaker:state');
    Cache::forget('fin-sentinel:ai:breaker:fails');
    Cache::forget('fin-sentinel:ai:cap:'.now()->format('Y-m-d:H'));
});

it('captures token usage on SUCCESS and writes both display caches', function () {
    $aiFacade = 'Laravel\\Ai\\Ai';
    $anonAgentClass = 'Laravel\\Ai\\AnonymousAgent';

    $aiFacade::fakeAgent($anonAgentClass, function ($prompt, $attachments, $provider, $model) {
        return new TextResponse(
            text: 'Likely cause: example. Fix: try X.',
            usage: new Usage(promptTokens: 1234, completionTokens: 567),
            meta: new Meta($provider->name(), $model),
        );
    });

    $analyzer = app(AiErrorAnalyzerContract::class);
    $payload = ScrubbedErrorPayload::fromException(
        new RuntimeException('success path probe'),
        app(DataScrubber::class),
    );

    $result = $analyzer->analyze($payload);

    expect($result->state)->toBe(AiSuggestionState::SUCCESS);
    expect($result->promptTokens)->toBe(1234);
    expect($result->completionTokens)->toBe(567);

    $snapshotJson = Cache::get('fin-sentinel:ai:tokens:last');
    expect($snapshotJson)->toBeString();

    /** @var array<string, mixed> $snapshot */
    $snapshot = json_decode((string) $snapshotJson, true);
    expect($snapshot['prompt'])->toBe(1234);
    expect($snapshot['completion'])->toBe(567);
    expect($snapshot['state'])->toBe('success');
    expect($snapshot['model'])->toBe('claude-haiku-4-5-20251001');
    expect($snapshot['timestamp'])->toBeInt();

    $monthKey = 'fin-sentinel:ai:tokens:'.now()->format('Y-m');
    expect((int) Cache::get($monthKey))->toBe(1801);
});

it('does not increment the monthly counter on a CACHED hit', function () {
    $aiFacade = 'Laravel\\Ai\\Ai';
    $anonAgentClass = 'Laravel\\Ai\\AnonymousAgent';

    $aiFacade::fakeAgent($anonAgentClass, function ($prompt, $attachments, $provider, $model) {
        return new TextResponse(
            text: 'Likely cause: example. Fix: try X.',
            usage: new Usage(promptTokens: 1234, completionTokens: 567),
            meta: new Meta($provider->name(), $model),
        );
    });

    $analyzer = app(AiErrorAnalyzerContract::class);
    $payload = ScrubbedErrorPayload::fromException(
        new RuntimeException('cache idempotency probe'),
        app(DataScrubber::class),
    );

    $first = $analyzer->analyze($payload);
    expect($first->state)->toBe(AiSuggestionState::SUCCESS);

    $monthKey = 'fin-sentinel:ai:tokens:'.now()->format('Y-m');
    expect((int) Cache::get($monthKey))->toBe(1801);

    $second = $analyzer->analyze($payload);
    expect($second->state)->toBe(AiSuggestionState::CACHED);

    expect((int) Cache::get($monthKey))->toBe(1801);

    /** @var array<string, mixed> $snapshot */
    $snapshot = json_decode((string) Cache::get('fin-sentinel:ai:tokens:last'), true);
    expect($snapshot['state'])->toBe('cached');
    expect($snapshot['prompt'])->toBe(0);
    expect($snapshot['completion'])->toBe(0);
});

it('writes a snapshot with state=failed when the SDK throws', function () {
    $aiFacade = 'Laravel\\Ai\\Ai';
    $anonAgentClass = 'Laravel\\Ai\\AnonymousAgent';

    $aiFacade::fakeAgent($anonAgentClass, function () {
        throw new ConnectionException('cURL error 28: Operation timed out');
    });

    $analyzer = app(AiErrorAnalyzerContract::class);
    $payload = ScrubbedErrorPayload::fromException(
        new RuntimeException('failed path probe'),
        app(DataScrubber::class),
    );

    $result = $analyzer->analyze($payload);

    expect($result->state)->toBe(AiSuggestionState::FAILED);
    expect($result->reason)->toBe('timeout');

    /** @var array<string, mixed> $snapshot */
    $snapshot = json_decode((string) Cache::get('fin-sentinel:ai:tokens:last'), true);
    expect($snapshot['state'])->toBe('failed');
    expect($snapshot['prompt'])->toBe(0);
    expect($snapshot['completion'])->toBe(0);
});

it('writes a snapshot with state=skipped when the hourly cap is reached', function () {
    $bucketKey = 'fin-sentinel:ai:cap:'.now()->format('Y-m-d:H');
    Cache::put($bucketKey, 50, 3600);

    $analyzer = app(AiErrorAnalyzerContract::class);
    $payload = ScrubbedErrorPayload::fromException(
        new RuntimeException('cap probe'),
        app(DataScrubber::class),
    );

    $result = $analyzer->analyze($payload);

    expect($result->state)->toBe(AiSuggestionState::SKIPPED);
    expect($result->reason)->toBe('hourly cap reached');

    /** @var array<string, mixed> $snapshot */
    $snapshot = json_decode((string) Cache::get('fin-sentinel:ai:tokens:last'), true);
    expect($snapshot['state'])->toBe('skipped');
    expect($snapshot['prompt'])->toBe(0);
    expect($snapshot['completion'])->toBe(0);

    $monthKey = 'fin-sentinel:ai:tokens:'.now()->format('Y-m');
    expect(Cache::has($monthKey))->toBeFalse();
});

it('writes a snapshot with state=skipped when the breaker is open', function () {
    Cache::put('fin-sentinel:ai:breaker:state', true, 300);

    $analyzer = app(AiErrorAnalyzerContract::class);
    $payload = ScrubbedErrorPayload::fromException(
        new RuntimeException('breaker probe'),
        app(DataScrubber::class),
    );

    $result = $analyzer->analyze($payload);

    expect($result->state)->toBe(AiSuggestionState::SKIPPED);
    expect($result->reason)->toBe('circuit open');

    /** @var array<string, mixed> $snapshot */
    $snapshot = json_decode((string) Cache::get('fin-sentinel:ai:tokens:last'), true);
    expect($snapshot['state'])->toBe('skipped');

    $monthKey = 'fin-sentinel:ai:tokens:'.now()->format('Y-m');
    expect(Cache::has($monthKey))->toBeFalse();
});
