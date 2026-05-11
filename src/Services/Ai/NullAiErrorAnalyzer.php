<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Services\Ai;

use FinityLabs\FinSentinel\Contracts\AiErrorAnalyzerContract;
use FinityLabs\FinSentinel\Support\AiSuggestionResult;
use FinityLabs\FinSentinel\Support\ScrubbedErrorPayload;

/**
 * @internal
 */
class NullAiErrorAnalyzer implements AiErrorAnalyzerContract
{
    public function analyze(ScrubbedErrorPayload $payload): AiSuggestionResult
    {
        return AiSuggestionResult::disabled();
    }
}
