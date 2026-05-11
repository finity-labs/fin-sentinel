<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Support;

final readonly class AiSuggestionResult
{
    private function __construct(
        public AiSuggestionState $state,
        public ?string $suggestion,
        public ?string $reason,
        public ?int $promptTokens = null,
        public ?int $completionTokens = null,
    ) {}

    public static function success(string $suggestion, ?int $promptTokens = null, ?int $completionTokens = null): self
    {
        return new self(AiSuggestionState::SUCCESS, $suggestion, null, $promptTokens, $completionTokens);
    }

    public static function failed(string $reason, ?int $promptTokens = null, ?int $completionTokens = null): self
    {
        return new self(AiSuggestionState::FAILED, null, $reason, $promptTokens, $completionTokens);
    }

    public static function disabled(): self
    {
        return new self(AiSuggestionState::DISABLED, null, null);
    }

    public static function skipped(string $reason): self
    {
        return new self(AiSuggestionState::SKIPPED, null, $reason);
    }

    public static function cached(string $suggestion): self
    {
        return new self(AiSuggestionState::CACHED, $suggestion, null);
    }
}
