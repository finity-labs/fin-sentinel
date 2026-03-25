<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Listeners;

use FinityLabs\FinSentinel\FinSentinelServiceProvider;
use FinityLabs\FinSentinel\Mail\ErrorMail;
use FinityLabs\FinSentinel\Settings\ErrorChannelSettings;
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
            Mail::to($this->settings->error_recipients)
                ->send(new ErrorMail($event->message, $exception));
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
            ? 'fin-sentinel:throttle:' . md5($exception::class . $exception->getMessage() . $exception->getFile() . ':' . $exception->getLine())
            : 'fin-sentinel:throttle:' . md5('log_error' . $event->message);

        if (Cache::has($key)) {
            return true;
        }

        Cache::put($key, true, now()->addMinutes($this->settings->error_throttle_minutes));

        return false;
    }
}
