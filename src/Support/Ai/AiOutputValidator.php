<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Support\Ai;

final class AiOutputValidator
{
    /**
     * @var list<string>
     */
    private const CANARIES = [
        'PWNED',
        'ignore previous instructions',
        'ignore prior instructions',
        'disregard previous instructions',
        'disregard prior instructions',
        '<|im_start|>',
        '<|im_end|>',
        '<|system|>',
        '<|user|>',
        '<|assistant|>',
        '[INST]',
        '[/INST]',
    ];

    public function validate(string $aiResponse): bool
    {
        /** @var array<int, mixed> $extra */
        $extra = (array) config('fin-sentinel.ai.output_canaries', []);

        $markers = array_merge(self::CANARIES, $extra);

        foreach ($markers as $marker) {
            $marker = (string) $marker;

            if ($marker === '') {
                continue;
            }

            if (stripos($aiResponse, $marker) !== false) {
                return false;
            }
        }

        return true;
    }
}
