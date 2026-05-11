<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Services\Ai\AiErrorAnalyzer;
use FinityLabs\FinSentinel\Support\Ai\AiOutputValidator;
use FinityLabs\FinSentinel\Support\Ai\AiPromptBuilder;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;

function callMapException(Throwable $e): string
{
    $analyzer = new AiErrorAnalyzer(new AiPromptBuilder, new AiOutputValidator);
    $reflection = new ReflectionMethod($analyzer, 'mapException');

    return (string) $reflection->invoke($analyzer, $e);
}

function buildResponseWithStatus(int $status): Response
{
    $psrResponse = new GuzzleHttp\Psr7\Response($status, [], '{}');

    return new Response($psrResponse);
}

function buildRequestExceptionWithoutResponse(): RequestException
{
    $e = new RequestException(buildResponseWithStatus(500));

    $reflection = new ReflectionProperty($e, 'response');
    $reflection->setValue($e, null);

    return $e;
}

it('maps ConnectionException to timeout', function () {
    expect(callMapException(new ConnectionException('cURL error 28: Operation timed out')))->toBe('timeout');
});

it('maps RateLimitedException to rate limited', function () {
    $cls = 'Laravel\\Ai\\Exceptions\\RateLimitedException';

    if (! class_exists($cls)) {
        $this->markTestSkipped('laravel/ai not installed (without-SDK CI row)');
    }

    $e = new $cls('rate limited');
    expect(callMapException($e))->toBe('rate limited');
});

it('maps InsufficientCreditsException to quota exceeded', function () {
    $cls = 'Laravel\\Ai\\Exceptions\\InsufficientCreditsException';

    if (! class_exists($cls)) {
        $this->markTestSkipped('laravel/ai not installed (without-SDK CI row)');
    }

    $e = new $cls('quota exceeded');
    expect(callMapException($e))->toBe('quota exceeded');
});

it('maps ProviderOverloadedException to unknown error (5xx, retryable)', function () {
    $cls = 'Laravel\\Ai\\Exceptions\\ProviderOverloadedException';

    if (! class_exists($cls)) {
        $this->markTestSkipped('laravel/ai not installed (without-SDK CI row)');
    }

    $e = new $cls('overloaded');
    expect(callMapException($e))->toBe('unknown error');
});

it('maps RequestException with status 401 to authentication failed', function () {
    $e = new RequestException(buildResponseWithStatus(401));
    expect(callMapException($e))->toBe('authentication failed');
});

it('maps RequestException with status 403 to authentication failed', function () {
    $e = new RequestException(buildResponseWithStatus(403));
    expect(callMapException($e))->toBe('authentication failed');
});

it('maps RequestException with status 500 to unknown error (no auth match)', function () {
    $e = new RequestException(buildResponseWithStatus(500));
    expect(callMapException($e))->toBe('unknown error');
});

it('maps RequestException with no response to unknown error (defensive)', function () {
    $e = buildRequestExceptionWithoutResponse();
    expect(callMapException($e))->toBe('unknown error');
});

it('maps a plain RuntimeException to unknown error (default fallback)', function () {
    expect(callMapException(new RuntimeException('arbitrary')))->toBe('unknown error');
});
