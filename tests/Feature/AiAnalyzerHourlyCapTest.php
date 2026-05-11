<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Contracts\AiErrorAnalyzerContract;
use FinityLabs\FinSentinel\Services\DataScrubber;
use FinityLabs\FinSentinel\Settings\ErrorChannelSettings;
use FinityLabs\FinSentinel\Support\AiSuggestionState;
use FinityLabs\FinSentinel\Support\ScrubbedErrorPayload;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Cache;
use Laravel\Ai\Contracts\Gateway\TextGateway;
use Laravel\Ai\Responses\TextResponse;

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
    $settings->ai_hourly_cap = 2;
    $settings->ai_cache_ttl_minutes = 60;
    $settings->ai_prompt_template = 'Analyze: {{error}}';
    $settings->save();
});

afterEach(function () {
    Cache::forget('fin-sentinel:ai:breaker:state');
    Cache::forget('fin-sentinel:ai:breaker:fails');
    Cache::forget('fin-sentinel:ai:cap:'.now()->format('Y-m-d:H'));
});

it('returns SKIPPED with reason "hourly cap reached" when cap is exhausted', function () {
    $bucketKey = 'fin-sentinel:ai:cap:'.now()->format('Y-m-d:H');
    Cache::put($bucketKey, 2, 3600);

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
        new RuntimeException('over cap 1'),
        app(DataScrubber::class),
    );

    $result = $analyzer->analyze($payload);

    expect($result->state)->toBe(AiSuggestionState::SKIPPED);
    expect($result->reason)->toBe('hourly cap reached');
    expect($counter->calls)->toBe(0);
});

it('counts attempts not results — increments cap before SDK call even when SDK fails', function () {
    $settings = app(ErrorChannelSettings::class);
    $settings->ai_hourly_cap = 5;
    $settings->save();

    $throwingGateway = new class implements TextGateway
    {
        public function generateText($provider, $model, $instructions, $messages = [], $tools = [], $schema = null, $options = null, $timeout = null): TextResponse
        {
            throw new ConnectionException('cURL error 28');
        }

        public function streamText(string $invocationId, $provider, $model, $instructions, $messages = [], $tools = [], $schema = null, $options = null, $timeout = null): Generator
        {
            yield from [];
        }

        public function onToolInvocation(Closure $invoking, Closure $invoked): self
        {
            return $this;
        }
    };

    $aiManagerClass = 'Laravel\\Ai\\AiManager';
    app()->resolving($aiManagerClass, function ($manager) use ($throwingGateway) {
        $manager->textProvider('anthropic')->useTextGateway($throwingGateway);
    });

    $bucketKey = 'fin-sentinel:ai:cap:'.now()->format('Y-m-d:H');
    $capBefore = (int) Cache::get($bucketKey, 0);

    $analyzer = app(AiErrorAnalyzerContract::class);
    $payload = ScrubbedErrorPayload::fromException(
        new RuntimeException('cap counts attempts'),
        app(DataScrubber::class),
    );
    $result = $analyzer->analyze($payload);

    $capAfter = (int) Cache::get($bucketKey, 0);

    expect($result->state)->toBe(AiSuggestionState::FAILED);
    expect($result->reason)->toBe('timeout');
    expect($capAfter)->toBe($capBefore + 1);
});

it('does not increment the cap counter when the result comes from cache', function () {
    $bucketKey = 'fin-sentinel:ai:cap:'.now()->format('Y-m-d:H');

    $anonAgentClass = 'Laravel\\Ai\\AnonymousAgent';
    $aiFacade = 'Laravel\\Ai\\Ai';
    $aiFacade::fakeAgent($anonAgentClass, fn ($prompt) => 'cached suggestion');

    $analyzer = app(AiErrorAnalyzerContract::class);
    $payload = ScrubbedErrorPayload::fromException(
        new RuntimeException('cap exemption test 1'),
        app(DataScrubber::class),
    );

    $analyzer->analyze($payload);
    $capAfterFirst = (int) Cache::get($bucketKey, 0);

    $analyzer->analyze($payload);
    $capAfterSecond = (int) Cache::get($bucketKey, 0);

    expect($capAfterFirst)->toBe(1);
    expect($capAfterSecond)->toBe(1);
});
