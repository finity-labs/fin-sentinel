<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Support;

enum AiSuggestionState: string
{
    case SUCCESS = 'success';
    case FAILED = 'failed';
    case DISABLED = 'disabled';
    case SKIPPED = 'skipped';
    case CACHED = 'cached';
}
