<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Support\Ai;

use FinityLabs\FinSentinel\Facades\FinSentinel;

final class AiProviderLabels
{
    /**
     * @return array<string, string>
     */
    public static function all(): array
    {
        if (! FinSentinel::aiAvailable()) {
            return [];
        }

        $labEnum = 'Laravel\\Ai\\Enums\\Lab';
        $textCapable = ['anthropic', 'azure', 'deepseek', 'gemini', 'groq', 'mistral', 'ollama', 'openai', 'xai'];

        try {
            $options = [];
            foreach ($labEnum::cases() as $case) {
                if (! in_array($case->value, $textCapable, true)) {
                    continue;
                }
                $options[$case->value] = $case->name;
            }

            return $options;
        } catch (\Throwable) {
            return [];
        }
    }

    public static function pretty(?string $providerKey): string
    {
        if ($providerKey === null || $providerKey === '') {
            return '';
        }

        return self::all()[$providerKey] ?? ucfirst($providerKey);
    }
}
