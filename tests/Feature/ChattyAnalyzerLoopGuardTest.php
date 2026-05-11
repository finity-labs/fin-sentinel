<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Contracts\AiErrorAnalyzerContract;
use FinityLabs\FinSentinel\FinSentinelServiceProvider;
use FinityLabs\FinSentinel\Listeners\MessageLoggedListener;
use FinityLabs\FinSentinel\Mail\ErrorMail;
use FinityLabs\FinSentinel\Settings\ErrorChannelSettings;
use FinityLabs\FinSentinel\Support\AiSuggestionResult;
use FinityLabs\FinSentinel\Support\ScrubbedErrorPayload;
use Illuminate\Log\Events\MessageLogged;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

beforeEach(function () {
    $reflection = new ReflectionProperty(FinSentinelServiceProvider::class, 'handling');
    $reflection->setAccessible(true);
    $reflection->setValue(null, false);

    app()->forgetInstance('fin-sentinel.ai-available');
    app()->forgetInstance('fin-sentinel.manager');
    app()->forgetInstance(AiErrorAnalyzerContract::class);
    app()->instance('fin-sentinel.ai-available', true);

    $settings = app(ErrorChannelSettings::class);
    $settings->error_recipients = ['test@example.com'];
    $settings->error_enabled = true;
    $settings->error_throttle_minutes = 15;
    $settings->error_throttle_exceptions = true;
    $settings->error_throttle_log_messages = true;
    $settings->save();

    Cache::flush();

    Event::listen(MessageLogged::class, MessageLoggedListener::class);
});

it('handles a chatty AI analyzer without recursion or a stuck handling flag', function () {
    Mail::fake();

    $chatty = new class implements AiErrorAnalyzerContract
    {
        public function analyze(ScrubbedErrorPayload $payload): AiSuggestionResult
        {
            Log::error('synthetic AI noise from chatty analyzer');

            return AiSuggestionResult::success('fake suggestion body');
        }
    };

    app()->instance(AiErrorAnalyzerContract::class, $chatty);

    $listener = app(MessageLoggedListener::class);
    $event = new MessageLogged('error', 'real exception triggered', [
        'exception' => new RuntimeException('real exception body'),
    ]);

    $listener->handle($event);

    Mail::assertSentTimes(ErrorMail::class, 1);

    $reflection = new ReflectionProperty(FinSentinelServiceProvider::class, 'handling');
    $reflection->setAccessible(true);
    expect($reflection->getValue())->toBeFalse();
});
