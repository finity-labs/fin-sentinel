<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Services\Ai;

use FinityLabs\FinSentinel\Contracts\AiErrorAnalyzerContract;
use FinityLabs\FinSentinel\Listeners\MessageLoggedListener;
use FinityLabs\FinSentinel\Settings\ErrorChannelSettings;
use FinityLabs\FinSentinel\Support\Ai\AiOutputValidator;
use FinityLabs\FinSentinel\Support\Ai\AiPromptBuilder;
use FinityLabs\FinSentinel\Support\AiSuggestionResult;
use FinityLabs\FinSentinel\Support\ScrubbedErrorPayload;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Cache;
use Throwable;

/**
 * @internal
 */
class AiErrorAnalyzer implements AiErrorAnalyzerContract
{
    private const BREAKER_THRESHOLD = 3;

    private const BREAKER_OPEN_SECONDS = 300;

    private const HOUR_BUCKET_SECONDS = 3600;

    public function __construct(
        private AiPromptBuilder $builder,
        private AiOutputValidator $validator,
    ) {}

    public function analyze(ScrubbedErrorPayload $payload): AiSuggestionResult
    {
        try {
            $settings = app(ErrorChannelSettings::class);

            $cacheKey = $this->aiCacheKey($payload);
            $cached = Cache::get($cacheKey);
            if (is_string($cached)) {
                $this->recordTokenUsage(0, 0, 'cached', $settings->ai_model);
                $this->recordSuccess();

                return AiSuggestionResult::cached($cached);
            }

            if ($this->isBreakerOpen()) {
                $this->recordTokenUsage(0, 0, 'skipped', $settings->ai_model);

                return AiSuggestionResult::skipped('circuit open');
            }

            $bucketKey = 'fin-sentinel:ai:cap:'.now()->format('Y-m-d:H');
            // increment alone on a missing key skips TTL on Array/File stores
            Cache::add($bucketKey, 0, self::HOUR_BUCKET_SECONDS);
            if ((int) Cache::get($bucketKey, 0) >= $settings->ai_hourly_cap) {
                $this->recordTokenUsage(0, 0, 'skipped', $settings->ai_model);

                return AiSuggestionResult::skipped('hourly cap reached');
            }

            $template = $settings->ai_prompt_template ?: '{{error}}';
            $promptInput = $this->builder->build($payload, $template);

            $response = null;
            $maxAttempts = 2;
            for ($attempt = 0; $attempt < $maxAttempts; $attempt++) {
                Cache::increment($bucketKey);

                try {
                    $response = $this->callSdkResponse($promptInput->user, $settings);
                    break;
                } catch (Throwable $e) {
                    $reason = $this->mapException($e);
                    // timeouts don't retry: budget math forces single-attempt
                    $retryable = $reason === 'unknown error';
                    if (! $retryable || $attempt + 1 >= $maxAttempts) {
                        $this->recordTokenUsage(0, 0, 'failed', $settings->ai_model);
                        $this->recordFailure();

                        return AiSuggestionResult::failed($reason);
                    }
                }
            }

            $aiResponse = (string) $response;

            if (! $this->validator->validate($aiResponse)) {
                $this->recordTokenUsage(0, 0, 'failed', $settings->ai_model);
                $this->recordFailure();

                return AiSuggestionResult::failed('output rejected: matched injection marker');
            }

            [$promptTokens, $completionTokens] = $this->extractUsage($response);

            Cache::put($cacheKey, $aiResponse, $settings->ai_cache_ttl_minutes * 60);
            $this->recordTokenUsage($promptTokens, $completionTokens, 'success', $settings->ai_model);
            $this->recordSuccess();

            return AiSuggestionResult::success($aiResponse, $promptTokens, $completionTokens);
        } catch (Throwable) {
            try {
                $this->recordTokenUsage(0, 0, 'failed', null);
            } catch (Throwable) {
            }
            $this->recordFailure();

            return AiSuggestionResult::failed('unknown error');
        }
    }

    private function aiCacheKey(ScrubbedErrorPayload $payload): string
    {
        $normalizedMessage = preg_replace('/\d+/', '<N>', $payload->message) ?? $payload->message;

        return 'fin-sentinel:ai:'.MessageLoggedListener::hashExceptionParts(
            $payload->exceptionClass,
            $normalizedMessage,
            $payload->file,
            $payload->line,
        );
    }

    private function callSdkResponse(string $promptText, ErrorChannelSettings $settings): object
    {
        $names = $this->sdkNames();
        $agentFn = $names['agent'];
        $labFqcn = $names['lab'];

        $providerEnum = $settings->ai_provider !== null
            ? $labFqcn::from($settings->ai_provider)
            : null;

        return $this->withProviderKey(
            $settings->ai_provider,
            $settings->ai_api_key,
            fn () => $agentFn('', [], [])->prompt(
                $promptText,
                provider: $providerEnum,
                model: $settings->ai_model,
                timeout: $settings->ai_timeout,
            ),
        );
    }

    /**
     * Inject the DB-stored API key into the SDK config for one call, then restore.
     * `Ai::forgetInstance()` invalidates the cached provider so it re-reads config.
     */
    private function withProviderKey(?string $provider, ?string $apiKey, callable $fn): mixed
    {
        if ($provider === null || $apiKey === null || $apiKey === '') {
            return $fn();
        }

        $configKey = "ai.providers.{$provider}.key";
        $previousKey = config($configKey);
        $aiFacade = '\\Laravel\\Ai\\Ai';

        config([$configKey => $apiKey]);
        $aiFacade::forgetInstance($provider);

        try {
            return $fn();
        } finally {
            config([$configKey => $previousKey]);
            $aiFacade::forgetInstance($provider);
        }
    }

    /**
     * @return array{agent: string, lab: string}
     */
    private function sdkNames(): array
    {
        $ns = trim('\Laravel\Ai', '\\');

        return [
            'agent' => $ns.'\\agent',
            'lab' => $ns.'\\Enums\\Lab',
        ];
    }

    private function mapException(Throwable $e): string
    {
        if ($e instanceof ConnectionException) {
            return 'timeout';
        }

        $rateLimitFqcn = '\\Laravel\\Ai\\Exceptions\\RateLimitedException';
        $quotaFqcn = '\\Laravel\\Ai\\Exceptions\\InsufficientCreditsException';
        $overloadFqcn = '\\Laravel\\Ai\\Exceptions\\ProviderOverloadedException';

        if ($e instanceof $rateLimitFqcn) {
            return 'rate limited';
        }
        if ($e instanceof $quotaFqcn) {
            return 'quota exceeded';
        }
        if ($e instanceof $overloadFqcn) {
            return 'unknown error';
        }

        if ($e instanceof RequestException) {
            $status = $this->safeRequestStatus($e);
            if ($status === 401 || $status === 403) {
                return 'authentication failed';
            }
        }

        return 'unknown error';
    }

    private function safeRequestStatus(RequestException $e): ?int
    {
        $vars = get_object_vars($e);
        $response = $vars['response'] ?? null;

        if (! is_object($response) || ! method_exists($response, 'status')) {
            return null;
        }

        /** @var mixed $status */
        $status = $response->status();

        return is_int($status) ? $status : null;
    }

    private function isBreakerOpen(): bool
    {
        return Cache::has('fin-sentinel:ai:breaker:state');
    }

    private function recordSuccess(): void
    {
        Cache::forget('fin-sentinel:ai:breaker:fails');
    }

    private function recordFailure(): void
    {
        Cache::add('fin-sentinel:ai:breaker:fails', 0);
        $count = (int) Cache::increment('fin-sentinel:ai:breaker:fails');

        if ($count >= self::BREAKER_THRESHOLD) {
            Cache::put('fin-sentinel:ai:breaker:state', true, self::BREAKER_OPEN_SECONDS);
        }
    }

    /**
     * @return array{0: int, 1: int}
     */
    private function extractUsage(?object $response): array
    {
        if ($response === null) {
            return [0, 0];
        }

        $vars = get_object_vars($response);
        $usage = $vars['usage'] ?? null;

        if (! is_object($usage)) {
            return [0, 0];
        }

        $usageVars = get_object_vars($usage);

        return [
            (int) ($usageVars['promptTokens'] ?? 0),
            (int) ($usageVars['completionTokens'] ?? 0),
        ];
    }

    private function recordTokenUsage(int $promptTokens, int $completionTokens, string $state, ?string $model): void
    {
        $snapshot = [
            'prompt' => $promptTokens,
            'completion' => $completionTokens,
            'state' => $state,
            'model' => $model,
            'timestamp' => time(),
        ];
        Cache::put('fin-sentinel:ai:tokens:last', json_encode($snapshot), 30 * 86400);

        if ($state === 'success' || $state === 'failed') {
            $monthKey = 'fin-sentinel:ai:tokens:'.now()->format('Y-m');
            Cache::add($monthKey, 0, 62 * 86400);
            Cache::increment($monthKey, $promptTokens + $completionTokens);
        }
    }
}
