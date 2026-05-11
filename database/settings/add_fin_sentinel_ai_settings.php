<?php

declare(strict_types=1);

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $defaultPrompt = <<<'PROMPT'
            You are a senior Laravel engineer. Analyze the following error and suggest a likely cause and fix in 2-3 sentences. Be concrete and actionable. Do not repeat the error verbatim.

            {{error}}
            PROMPT;

        $defaults = [
            'fin-sentinel.ai_enabled' => false,
            'fin-sentinel.ai_provider' => null,
            'fin-sentinel.ai_model' => null,
            'fin-sentinel.ai_api_key' => null,
            'fin-sentinel.ai_timeout' => 3,
            'fin-sentinel.ai_max_tokens' => 250,
            'fin-sentinel.ai_strict_scrubbing' => false,
            'fin-sentinel.ai_hourly_cap' => 50,
            'fin-sentinel.ai_prompt_template' => $defaultPrompt,
            'fin-sentinel.ai_cache_ttl_minutes' => 60,
        ];

        foreach ($defaults as $key => $value) {
            if (! $this->migrator->exists($key)) {
                $this->migrator->add($key, $value);
            }
        }
    }

    public function down(): void
    {
        $keys = [
            'fin-sentinel.ai_enabled',
            'fin-sentinel.ai_provider',
            'fin-sentinel.ai_model',
            'fin-sentinel.ai_api_key',
            'fin-sentinel.ai_timeout',
            'fin-sentinel.ai_max_tokens',
            'fin-sentinel.ai_strict_scrubbing',
            'fin-sentinel.ai_hourly_cap',
            'fin-sentinel.ai_prompt_template',
            'fin-sentinel.ai_cache_ttl_minutes',
        ];

        foreach ($keys as $key) {
            $this->migrator->deleteIfExists($key);
        }
    }
};
