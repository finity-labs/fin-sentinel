<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Support;

use FinityLabs\FinSentinel\Services\DataScrubber;
use Throwable;

final readonly class ScrubbedErrorPayload
{
    private function __construct(
        public string $exceptionClass,
        public string $message,
        public string $file,
        public int $line,
        public ?string $trace,
    ) {}

    public static function fromException(Throwable $e, DataScrubber $scrubber, bool $strict = false): self
    {
        $firstLine = strtok($e->getMessage(), "\n");
        $messageLine = $firstLine === false ? '' : $firstLine;

        return new self(
            exceptionClass: $e::class,
            message: $scrubber->scrubString($messageLine),
            file: $e->getFile(),
            line: $e->getLine(),
            trace: $strict ? null : $scrubber->scrubString($e->getTraceAsString()),
        );
    }
}
