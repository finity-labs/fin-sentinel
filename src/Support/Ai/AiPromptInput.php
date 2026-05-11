<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Support\Ai;

final readonly class AiPromptInput
{
    public function __construct(
        public string $user,
    ) {}
}
