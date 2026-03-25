<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Support;

use FinityLabs\FinSentinel\FinSentinelServiceProvider;
use FinityLabs\FinSentinel\Mail\DebugMail;
use FinityLabs\FinSentinel\Services\DataScrubber;
use FinityLabs\FinSentinel\Services\DebugFormatter;
use FinityLabs\FinSentinel\Settings\DebugChannelSettings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DebugBuilder
{
    private ?string $subject;

    /** @var string[]|null */
    private ?array $recipients = null;

    private bool $sent = false;

    /** @var array{file: string, line: int} */
    private array $callSite;

    public function __construct(
        private mixed $data,
        ?string $subject = null,
    ) {
        $this->subject = $subject;
        $this->callSite = $this->resolveCallSite();
    }

    public function subject(string $subject): static
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @param  string|string[]  $recipients
     */
    public function to(string|array $recipients): static
    {
        $this->recipients = is_string($recipients) ? [$recipients] : $recipients;

        return $this;
    }

    /**
     * Send the debug email synchronously.
     */
    public function send(): void
    {
        if ($this->sent) {
            return;
        }

        $this->sent = true;

        $this->writeLogEntry();

        $settings = app(DebugChannelSettings::class);

        if (! $settings->debug_enabled) {
            return;
        }

        $recipients = $this->recipients ?? $settings->debug_recipients;

        if (empty($recipients)) {
            return;
        }

        if ($settings->debug_throttle_enabled && $this->isThrottled($settings->debug_throttle_minutes)) {
            return;
        }

        $formatted = $this->scrubFormattedData(
            app(DebugFormatter::class)->format($this->data)
        );

        $debugMail = new DebugMail(
            formattedData: $formatted,
            callSite: $this->callSite,
            requestContext: DebugMail::buildRequestContext(),
            environmentContext: DebugMail::buildEnvironmentContext(),
            customSubject: $this->subject,
        );

        FinSentinelServiceProvider::guardedHandle(function () use ($recipients, $debugMail) {
            Mail::to($recipients)->send($debugMail);
        });
    }

    /**
     * Auto-queue if send() was never called explicitly.
     */
    public function __destruct()
    {
        if ($this->sent) {
            return;
        }

        try {
            $this->sent = true;

            $this->writeLogEntry();

            $settings = app(DebugChannelSettings::class);

            if (! $settings->debug_enabled) {
                return;
            }

            $recipients = $this->recipients ?? $settings->debug_recipients;

            if (empty($recipients)) {
                return;
            }

            if ($settings->debug_throttle_enabled && $this->isThrottled($settings->debug_throttle_minutes)) {
                return;
            }

            $formatted = $this->scrubFormattedData(
                app(DebugFormatter::class)->format($this->data)
            );

            $debugMail = new DebugMail(
                formattedData: $formatted,
                callSite: $this->callSite,
                requestContext: DebugMail::buildRequestContext(),
                environmentContext: DebugMail::buildEnvironmentContext(),
                customSubject: $this->subject,
            );

            FinSentinelServiceProvider::guardedHandle(function () use ($recipients, $debugMail) {
                Mail::to($recipients)->queue($debugMail);
            });
        } catch (\Throwable) {
            // Exceptions in __destruct are fatal in PHP 8 -- swallow silently.
        }
    }

    /**
     * Always write a log entry for the debug call.
     */
    private function writeLogEntry(): void
    {
        $context = [
            'sentinel_debug' => true,
            'call_site' => $this->callSite['file'] . ':' . $this->callSite['line'],
        ];

        if ($this->data instanceof Model) {
            $context['model'] = $this->data::class . ':' . $this->data->getKey();
        } elseif ($this->data instanceof Collection) {
            $context['collection_count'] = $this->data->count();
        }

        Log::debug(
            'Sentinel debug: ' . ($this->subject ?? class_basename($this->data ?? 'mixed')),
            $context,
        );
    }

    /**
     * Resolve the first call site outside the fin-sentinel package.
     *
     * @return array{file: string, line: int}
     */
    private function resolveCallSite(): array
    {
        $frames = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10);

        foreach ($frames as $frame) {
            $file = $frame['file'] ?? '';

            if ($file !== '' && ! str_contains($file, 'fin-sentinel/src/')) {
                return ['file' => $file, 'line' => $frame['line'] ?? 0];
            }
        }

        return ['file' => 'unknown', 'line' => 0];
    }

    /**
     * Build a throttle cache key based on data content and subject.
     */
    private function buildThrottleKey(): string
    {
        $dataHash = match (true) {
            $this->data instanceof Model => $this->data::class . $this->data->getKey() . md5(json_encode($this->data->getAttributes())),
            $this->data instanceof Collection => 'collection:' . $this->data->count() . md5($this->data->take(5)->toJson()),
            is_array($this->data) => md5(json_encode($this->data, JSON_PARTIAL_OUTPUT_ON_ERROR)),
            default => md5((string) $this->data),
        };

        return 'fin-sentinel:debug-throttle:' . md5(($this->subject ?? '') . $dataHash);
    }

    /**
     * Check if this debug message is within the throttle window.
     */
    private function isThrottled(int $minutes): bool
    {
        $key = $this->buildThrottleKey();

        if (Cache::has($key)) {
            return true;
        }

        Cache::put($key, true, now()->addMinutes($minutes));

        return false;
    }

    /**
     * Scrub sensitive values from the formatted data array.
     *
     * @param  array<string, mixed>  $formatted
     * @return array<string, mixed>
     */
    private function scrubFormattedData(array $formatted): array
    {
        $scrubber = app(DataScrubber::class);
        $type = $formatted['type'] ?? '';

        return match ($type) {
            'model' => array_merge($formatted, [
                'attributes' => $scrubber->scrubParams($formatted['attributes'] ?? []),
            ]),
            'collection' => array_merge($formatted, [
                'items' => array_map(
                    fn (array $item): array => $this->scrubFormattedData($item),
                    $formatted['items'] ?? []
                ),
            ]),
            'query' => array_merge($formatted, [
                'bindings' => $scrubber->scrubParams(
                    array_combine(
                        array_map('strval', array_keys($formatted['bindings'] ?? [])),
                        array_values($formatted['bindings'] ?? [])
                    )
                ),
            ]),
            'array' => array_merge($formatted, [
                'data' => $scrubber->scrubParams($formatted['data'] ?? []),
            ]),
            default => $formatted,
        };
    }
}
