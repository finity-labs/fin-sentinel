<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Support\Ai;

use FinityLabs\FinSentinel\Support\ScrubbedErrorPayload;

final class AiPromptBuilder
{
    public function build(ScrubbedErrorPayload $payload, string $template): AiPromptInput
    {
        $block = $this->buildDelimitedBlock($payload);

        // limit=1 caps substitution at the first {{error}}; addcslashes neutralises
        // any $1 / \1 sequences in the trace from being read as PCRE backreferences.
        $result = preg_replace(
            '/\{\{error\}\}/',
            addcslashes($block, '\\$'),
            $template,
            1,
        );

        return new AiPromptInput(user: $result ?? $template);
    }

    private function buildDelimitedBlock(ScrubbedErrorPayload $payload): string
    {
        $parts = [
            '<error_context>',
            sprintf('Class: %s', $payload->exceptionClass),
            sprintf('Message: %s', $payload->message),
            sprintf('Location: %s:%d', $payload->file, $payload->line),
            '</error_context>',
        ];

        if ($payload->trace !== null) {
            $parts[] = '<stack_trace>';
            $parts[] = $payload->trace;
            $parts[] = '</stack_trace>';
        }

        return implode("\n", $parts);
    }
}
