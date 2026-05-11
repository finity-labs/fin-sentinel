<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Contracts;

use FinityLabs\FinSentinel\Support\AiSuggestionResult;
use FinityLabs\FinSentinel\Support\ScrubbedErrorPayload;

/**
 * @internal
 */
interface AiErrorAnalyzerContract
{
    public function analyze(ScrubbedErrorPayload $payload): AiSuggestionResult;
}
