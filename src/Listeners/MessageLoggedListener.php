<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Listeners;

use FinityLabs\FinSentinel\Contracts\AiErrorAnalyzerContract;
use FinityLabs\FinSentinel\Facades\FinSentinel;
use FinityLabs\FinSentinel\FinSentinelServiceProvider;
use FinityLabs\FinSentinel\Mail\ErrorMail;
use FinityLabs\FinSentinel\Services\DataScrubber;
use FinityLabs\FinSentinel\Settings\ErrorChannelSettings;
use FinityLabs\FinSentinel\Support\Ai\AiOutputValidator;
use FinityLabs\FinSentinel\Support\AiSuggestionResult;
use FinityLabs\FinSentinel\Support\AiSuggestionState;
use FinityLabs\FinSentinel\Support\ScrubbedErrorPayload;
use Illuminate\Log\Events\MessageLogged;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class MessageLoggedListener
{
    private const ACTIONABLE_LEVELS = ['error', 'critical', 'alert', 'emergency'];

    public function __construct(private ErrorChannelSettings $settings) {}

    public function handle(MessageLogged $event): void
    {
        if (! in_array($event->level, self::ACTIONABLE_LEVELS, true)) {
            return;
        }

        if (FinSentinelServiceProvider::isHandling()) {
            return;
        }

        $exception = $event->context['exception'] ?? null;

        if ($exception instanceof \Throwable && $this->isIgnored($exception)) {
            return;
        }

        if ($this->isThrottled($event, $exception)) {
            return;
        }

        FinSentinelServiceProvider::guardedHandle(function () use ($event, $exception) {
            $aiSuggestion = null;

            if (FinSentinel::aiAvailable() && $exception instanceof \Throwable) {
                try {
                    $payload = ScrubbedErrorPayload::fromException(
                        $exception,
                        app(DataScrubber::class),
                        strict: $this->settings->ai_strict_scrubbing,
                    );
                    $aiSuggestion = app(AiErrorAnalyzerContract::class)->analyze($payload);

                    if (
                        $aiSuggestion->state === AiSuggestionState::SUCCESS
                        && $aiSuggestion->suggestion !== null
                        && ! app(AiOutputValidator::class)->validate($aiSuggestion->suggestion)
                    ) {
                        $aiSuggestion = AiSuggestionResult::failed('output rejected: matched injection marker');
                    }
                } catch (\Throwable) {
                    $aiSuggestion = null;
                }
            }

            Mail::to($this->settings->error_recipients)
                ->send(new ErrorMail($event->message, $exception, $aiSuggestion));
        });
    }

    /**
     * Check if the exception is on the ignore list.
     */
    private function isIgnored(\Throwable $exception): bool
    {
        foreach ($this->settings->ignored_exceptions as $fqcn) {
            if (is_a($exception, $fqcn)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if this error has been seen within the throttle window.
     */
    private function isThrottled(MessageLogged $event, ?\Throwable $exception): bool
    {
        if ($exception instanceof \Throwable && ! $this->settings->error_throttle_exceptions) {
            return false;
        }

        if (! $exception instanceof \Throwable && ! $this->settings->error_throttle_log_messages) {
            return false;
        }

        $key = $exception instanceof \Throwable
            ? 'fin-sentinel:throttle:'.self::hashException($exception)
            : 'fin-sentinel:throttle:'.md5('log_error'.$event->message);

        if (Cache::has($key)) {
            return true;
        }

        Cache::put($key, true, now()->addMinutes($this->settings->error_throttle_minutes));

        return false;
    }

    public static function hashException(\Throwable $exception): string
    {
        return self::hashExceptionParts(
            $exception::class,
            $exception->getMessage(),
            $exception->getFile(),
            $exception->getLine(),
        );
    }

    public static function hashExceptionParts(string $class, string $message, string $file, int $line): string
    {
        return md5($class.$message.$file.':'.$line);
    }
}
