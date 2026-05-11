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
    $counter = new stdClass;
    $counter->calls = 0;

    // Throw immediately to simulate timeout: Ai::fakeAgent bypasses Http::timeout(),
    // so a real sleep would never trip the timeout layer under it.
    $throwingGateway = new class($counter) implements TextGateway
    {
        public function __construct(private stdClass $counter) {}

        public function generateText($provider, $model, $instructions, $messages = [], $tools = [], $schema = null, $options = null, $timeout = null): TextResponse
        {
            $this->counter->calls++;
            $effective = $timeout ?? 60;

            throw new ConnectionException(
                "cURL error 28: Operation timed out after {$effective}000 milliseconds"
            );
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
    expect($counter->calls)->toBe(1);
});

it('threads the configured ai_timeout into the SDK prompt() call', function () {
    $captured = new stdClass;
    $captured->timeout = null;

    $anonAgentClass = 'Laravel\\Ai\\AnonymousAgent';
    $aiFacade = 'Laravel\\Ai\\Ai';

    $aiFacade::fakeAgent($anonAgentClass, function ($prompt) use ($captured) {
        $captured->timeout = $prompt->timeout ?? null;

        return 'fake suggestion';
    });

    $settings = app(ErrorChannelSettings::class);
    $settings->ai_timeout = 7;
    $settings->save();

    $analyzer = app(AiErrorAnalyzerContract::class);
    $payload = ScrubbedErrorPayload::fromException(
        new RuntimeException('timeout-arg-wiring payload'),
        app(DataScrubber::class),
    );

    $analyzer->analyze($payload);

    expect($captured->timeout)->toBe(7);
});
