<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Services;

use FinityLabs\FinSentinel\Support\DebugBuilder;

class FinSentinelManager
{
    public function __construct(
        private DebugService $debug,
        private bool $aiAvailable,
    ) {}

    public function debug(mixed $data, ?string $subject = null): DebugBuilder
    {
        return $this->debug->debug($data, $subject);
    }

    public function aiAvailable(): bool
    {
        return $this->aiAvailable;
    }
}
