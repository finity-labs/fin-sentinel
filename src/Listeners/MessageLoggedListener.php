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
    private static bool $resolving = false;

    public function handle(MessageLogged $event): void
    {
        // Prevent recursion: resolving settings triggers DB queries which can fire MessageLogged
        if (self::$resolving || FinSentinelServiceProvider::isHandling()) {
            return;
        }

        self::$resolving = true;

        try {
            $settings = app(ErrorChannelSettings::class);
        } catch (\Throwable) {
            return;
        } finally {
            self::$resolving = false;
        }

        if (! $settings->error_enabled || empty($settings->error_recipients)) {
            return;
        }

        if (in_array($event->level, $settings->ignored_log_levels ?? [], true)) {
            return;
        }

        $exception = $event->context['exception'] ?? null;

        if ($exception instanceof \Throwable && $this->isIgnored($settings, $exception)) {
            return;
        }

        if ($this->isThrottled($settings, $event, $exception)) {
            return;
        }

        FinSentinelServiceProvider::guardedHandle(function () use ($settings, $event, $exception) {
            Mail::to($settings->error_recipients)
                ->send(new ErrorMail($event->message, $exception));
        });
    }

    private function isIgnored(ErrorChannelSettings $settings, \Throwable $exception): bool
    {
        foreach ($settings->ignored_exceptions as $fqcn) {
            if (is_a($exception, $fqcn)) {
                return true;
            }
        }

        return false;
    }

    private function isThrottled(ErrorChannelSettings $settings, MessageLogged $event, ?\Throwable $exception): bool
    {
        if ($exception instanceof \Throwable && ! $settings->error_throttle_exceptions) {
            return false;
        }

        if (! $exception instanceof \Throwable && ! $settings->error_throttle_log_messages) {
            return false;
        }

        $key = $exception instanceof \Throwable
            ? 'fin-sentinel:throttle:' . md5($exception::class . $exception->getMessage() . $exception->getFile() . ':' . $exception->getLine())
            : 'fin-sentinel:throttle:' . md5('log_error' . $event->message);

        if (Cache::has($key)) {
            return true;
        }

        Cache::put($key, true, now()->addMinutes($settings->error_throttle_minutes));

        return false;
    }
}
