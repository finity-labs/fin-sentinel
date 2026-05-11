<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Settings;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Spatie\LaravelSettings\Attributes\ShouldBeEncrypted;
use Spatie\LaravelSettings\Settings;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ErrorChannelSettings extends Settings
{
    public array $error_recipients = [];

    public bool $error_enabled = true;

    public int $error_throttle_minutes = 15;

    public bool $error_throttle_exceptions = true;

    public bool $error_throttle_log_messages = true;

    public array $ignored_exceptions = [
        NotFoundHttpException::class,
        ValidationException::class,
        AuthenticationException::class,
    ];

    public bool $ai_enabled = false;

    public ?string $ai_provider = null;

    public ?string $ai_model = null;

    #[ShouldBeEncrypted]
    public ?string $ai_api_key = null;

    public int $ai_timeout = 3;

    public int $ai_max_tokens = 250;

    public bool $ai_strict_scrubbing = false;

    public int $ai_hourly_cap = 50;

    public string $ai_prompt_template = '';

    public int $ai_cache_ttl_minutes = 60;

    public static function group(): string
    {
        return 'fin-sentinel';
    }
}
