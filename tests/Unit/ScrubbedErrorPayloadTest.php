<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Services\DataScrubber;
use FinityLabs\FinSentinel\Support\ScrubbedErrorPayload;

it('forbids direct construction of ScrubbedErrorPayload', function () {
    $constructor = (new ReflectionClass(ScrubbedErrorPayload::class))->getConstructor();

    expect($constructor)->not->toBeNull();
    expect($constructor->isPrivate())->toBeTrue();
});

it('builds payload from a multi-line exception message and keeps only the first line', function () {
    $exception = new RuntimeException("boom\nsecond line\nthird line");

    $payload = ScrubbedErrorPayload::fromException($exception, app(DataScrubber::class));

    expect($payload->message)->toBe('boom');
    expect($payload->exceptionClass)->toBe(RuntimeException::class);
    expect($payload->file)->not->toBe('');
    expect($payload->line)->toBeGreaterThan(0);
    expect($payload->trace)->toBeString();
    expect($payload->trace)->not->toBe('');
});

it('handles empty exception messages without choking', function () {
    $exception = new RuntimeException('');

    $payload = ScrubbedErrorPayload::fromException($exception, app(DataScrubber::class));

    expect($payload->message)->toBe('');
    expect($payload->exceptionClass)->toBe(RuntimeException::class);
});

it('defaults to non-strict mode and returns a string trace', function () {
    $exception = new RuntimeException('non-strict default');

    $payload = ScrubbedErrorPayload::fromException($exception, app(DataScrubber::class));

    expect($payload->trace)->toBeString();
    expect($payload->trace)->not->toBeNull();
});

it('drops the trace entirely when called with strict: true', function () {
    $exception = new RuntimeException('strict mode message');

    $strict = ScrubbedErrorPayload::fromException($exception, app(DataScrubber::class), strict: true);
    $loose = ScrubbedErrorPayload::fromException($exception, app(DataScrubber::class));

    expect($strict->trace)->toBeNull();

    expect($strict->exceptionClass)->toBe($loose->exceptionClass);
    expect($strict->message)->toBe($loose->message);
    expect($strict->file)->toBe($loose->file);
    expect($strict->line)->toBe($loose->line);
});

it('scrubs PII out of the message field', function () {
    $exception = new RuntimeException('Bad email user@example.com triggered the failure');

    $payload = ScrubbedErrorPayload::fromException($exception, app(DataScrubber::class));

    expect($payload->message)->not->toContain('user@example.com');
    expect($payload->message)->toContain('[EMAIL_REDACTED]');
});

it('scrubs filesystem paths out of a real trace in non-strict mode', function () {
    $exception = throwHere();

    $payload = ScrubbedErrorPayload::fromException($exception, app(DataScrubber::class));

    expect($payload->trace)->not->toBeNull();
    expect($payload->trace)->toContain('[PATH_REDACTED]');
    expect($payload->trace)->not->toContain(__FILE__);
});

it('omits the trace entirely in strict mode regardless of contents', function () {
    $exception = throwHere();

    $payload = ScrubbedErrorPayload::fromException($exception, app(DataScrubber::class), strict: true);

    expect($payload->trace)->toBeNull();
});

function throwHere(): RuntimeException
{
    try {
        throw new RuntimeException('boom');
    } catch (RuntimeException $e) {
        return $e;
    }
}
