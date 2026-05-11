<?php

declare(strict_types=1);

use Filament\Actions\Action;
use FinityLabs\FinSentinel\Clusters\FinSentinelSettings\Pages\ManageErrorChannelSettings;
use FinityLabs\FinSentinel\Contracts\AiErrorAnalyzerContract;
use FinityLabs\FinSentinel\Mail\ErrorMail;
use FinityLabs\FinSentinel\Settings\ErrorChannelSettings;
use FinityLabs\FinSentinel\Support\AiSuggestionState;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

beforeEach(function () {
    Cache::forget('fin-sentinel:ai:tokens:last');
    Cache::forget('fin-sentinel:ai:tokens:'.now()->format('Y-m'));
    Cache::forget('fin-sentinel:ai:cap:'.now()->format('Y-m-d:H'));
    Cache::forget('fin-sentinel:ai:breaker:state');
    Cache::forget('fin-sentinel:ai:breaker:fails');

    app()->forgetInstance('fin-sentinel.ai-available');
    app()->forgetInstance('fin-sentinel.manager');
    app()->forgetInstance(AiErrorAnalyzerContract::class);

    Mail::fake();

    $settings = app(ErrorChannelSettings::class);
    $settings->error_enabled = true;
    $settings->error_recipients = ['ops@example.test'];
    $settings->ai_enabled = false;
    $settings->ai_provider = 'anthropic';
    $settings->ai_model = 'claude-haiku-4-5-20251001';
    $settings->ai_api_key = 'sk-ant-fake-test-key';
    $settings->ai_timeout = 3;
    $settings->ai_max_tokens = 250;
    $settings->ai_hourly_cap = 50;
    $settings->ai_cache_ttl_minutes = 60;
    $settings->ai_strict_scrubbing = false;
    $settings->ai_prompt_template = 'Analyze: {{error}}';
    $settings->save();

    config([
        'ai.default' => 'anthropic',
        'ai.providers.anthropic.driver' => 'anthropic',
        'ai.providers.anthropic.key' => 'sk-ant-fake-test-key',
    ]);
});

afterEach(function () {
    Cache::forget('fin-sentinel:ai:tokens:last');
    Cache::forget('fin-sentinel:ai:tokens:'.now()->format('Y-m'));
    Cache::forget('fin-sentinel:ai:cap:'.now()->format('Y-m-d:H'));
    Cache::forget('fin-sentinel:ai:breaker:state');
    Cache::forget('fin-sentinel:ai:breaker:fails');
});

/**
 * Pull the sendTestEmail Action's closure and invoke it directly, bypassing
 * Filament's Livewire harness which requires a registered panel.
 */
function invokeSendTestEmailAction(): void
{
    $page = new ManageErrorChannelSettings;
    $method = new ReflectionMethod($page, 'getHeaderActions');
    $method->setAccessible(true);
    /** @var array<int, Action> $actions */
    $actions = $method->invoke($page);

    $action = null;
    foreach ($actions as $candidate) {
        if ($candidate->getName() === 'sendTestEmail') {
            $action = $candidate;
            break;
        }
    }

    expect($action)->not->toBeNull();
    $closure = $action->getActionFunction();
    expect($closure)->not->toBeNull();

    $closure();
}

it('sends test email without AI when ai_enabled is false', function () {
    app()->instance('fin-sentinel.ai-available', true);

    invokeSendTestEmailAction();

    Mail::assertSent(ErrorMail::class, fn (ErrorMail $mail) => $mail->aiSuggestion === null);

    $bucketKey = 'fin-sentinel:ai:cap:'.now()->format('Y-m-d:H');
    expect(Cache::has($bucketKey))->toBeFalse();
});

it('sends test email without AI when SDK is absent', function () {
    app()->instance('fin-sentinel.ai-available', false);

    $settings = app(ErrorChannelSettings::class);
    $settings->ai_enabled = true;
    $settings->save();

    invokeSendTestEmailAction();

    Mail::assertSent(ErrorMail::class, fn (ErrorMail $mail) => $mail->aiSuggestion === null);

    $bucketKey = 'fin-sentinel:ai:cap:'.now()->format('Y-m-d:H');
    expect(Cache::has($bucketKey))->toBeFalse();
});

it('invokes analyzer and surfaces SUCCESS when AI enabled', function () {
    if (! class_exists('Laravel\\Ai\\AnonymousAgent')) {
        $this->markTestSkipped('laravel/ai not installed (without-SDK CI row)');
    }

    app()->instance('fin-sentinel.ai-available', true);

    $settings = app(ErrorChannelSettings::class);
    $settings->ai_enabled = true;
    $settings->save();

    $aiFacade = 'Laravel\\Ai\\Ai';
    $anonAgentClass = 'Laravel\\Ai\\AnonymousAgent';
    $textResponse = 'Laravel\\Ai\\Responses\\TextResponse';
    $usage = 'Laravel\\Ai\\Responses\\Data\\Usage';
    $meta = 'Laravel\\Ai\\Responses\\Data\\Meta';

    $aiFacade::fakeAgent($anonAgentClass, function ($prompt, $attachments, $provider, $model) use ($textResponse, $usage, $meta) {
        return new $textResponse(
            text: 'Try restarting the queue worker.',
            usage: new $usage(promptTokens: 100, completionTokens: 50),
            meta: new $meta($provider->name(), $model),
        );
    });

    invokeSendTestEmailAction();

    Mail::assertSent(ErrorMail::class, function (ErrorMail $mail): bool {
        return $mail->aiSuggestion !== null
            && $mail->aiSuggestion->state === AiSuggestionState::SUCCESS
            && $mail->aiSuggestion->suggestion === 'Try restarting the queue worker.'
            && $mail->aiSuggestion->promptTokens === 100
            && $mail->aiSuggestion->completionTokens === 50;
    });

    $bucketKey = 'fin-sentinel:ai:cap:'.now()->format('Y-m-d:H');
    expect((int) Cache::get($bucketKey))->toBe(1);

    $monthKey = 'fin-sentinel:ai:tokens:'.now()->format('Y-m');
    expect((int) Cache::get($monthKey))->toBe(150);
});

it('surfaces CACHED when analyzer hits cache on second call', function () {
    if (! class_exists('Laravel\\Ai\\AnonymousAgent')) {
        $this->markTestSkipped('laravel/ai not installed (without-SDK CI row)');
    }

    app()->instance('fin-sentinel.ai-available', true);

    $settings = app(ErrorChannelSettings::class);
    $settings->ai_enabled = true;
    $settings->save();

    $aiFacade = 'Laravel\\Ai\\Ai';
    $anonAgentClass = 'Laravel\\Ai\\AnonymousAgent';
    $textResponse = 'Laravel\\Ai\\Responses\\TextResponse';
    $usage = 'Laravel\\Ai\\Responses\\Data\\Usage';
    $meta = 'Laravel\\Ai\\Responses\\Data\\Meta';

    $aiFacade::fakeAgent($anonAgentClass, function ($prompt, $attachments, $provider, $model) use ($textResponse, $usage, $meta) {
        return new $textResponse(
            text: 'Cached suggestion body.',
            usage: new $usage(promptTokens: 100, completionTokens: 50),
            meta: new $meta($provider->name(), $model),
        );
    });

    // First invocation seeds the cache via the analyzer's normal SUCCESS path.
    invokeSendTestEmailAction();
    // Second invocation hits the cache (same synthetic exception → same fingerprint).
    invokeSendTestEmailAction();

    $cached = Mail::sent(ErrorMail::class)->last();
    expect($cached)->not->toBeNull();
    expect($cached->aiSuggestion)->not->toBeNull();
    expect($cached->aiSuggestion->state)->toBe(AiSuggestionState::CACHED);
    expect($cached->aiSuggestion->suggestion)->toBe('Cached suggestion body.');
});

it('surfaces FAILED with reason when SDK throws', function () {
    if (! class_exists('Laravel\\Ai\\AnonymousAgent')) {
        $this->markTestSkipped('laravel/ai not installed (without-SDK CI row)');
    }

    app()->instance('fin-sentinel.ai-available', true);

    $settings = app(ErrorChannelSettings::class);
    $settings->ai_enabled = true;
    $settings->save();

    $aiFacade = 'Laravel\\Ai\\Ai';
    $anonAgentClass = 'Laravel\\Ai\\AnonymousAgent';

    $aiFacade::fakeAgent($anonAgentClass, function () {
        throw new ConnectionException('cURL error 28: Operation timed out');
    });

    invokeSendTestEmailAction();

    Mail::assertSent(ErrorMail::class, function (ErrorMail $mail): bool {
        return $mail->aiSuggestion !== null
            && $mail->aiSuggestion->state === AiSuggestionState::FAILED
            && $mail->aiSuggestion->reason === 'timeout';
    });
});
