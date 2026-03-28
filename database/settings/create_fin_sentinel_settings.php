<?php

declare(strict_types=1);

use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Spatie\LaravelSettings\Migrations\SettingsMigration;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return new class extends SettingsMigration
{
    public function up(): void
    {
        // Error channel
        $this->migrator->add('fin-sentinel.error_recipients', []);
        $this->migrator->add('fin-sentinel.error_enabled', true);
        $this->migrator->add('fin-sentinel.error_throttle_minutes', 15);
        $this->migrator->add('fin-sentinel.error_throttle_exceptions', true);
        $this->migrator->add('fin-sentinel.error_throttle_log_messages', true);
        $this->migrator->add('fin-sentinel.ignored_exceptions', [
            NotFoundHttpException::class,
            ValidationException::class,
            AuthenticationException::class,
        ]);

        // Debug channel
        $this->migrator->add('fin-sentinel.debug_recipients', []);
        $this->migrator->add('fin-sentinel.debug_enabled', false);
        $this->migrator->add('fin-sentinel.debug_throttle_minutes', 15);
        $this->migrator->add('fin-sentinel.debug_throttle_enabled', false);
    }

    public function down(): void
    {
        $this->migrator->delete('fin-sentinel.error_recipients');
        $this->migrator->delete('fin-sentinel.error_enabled');
        $this->migrator->delete('fin-sentinel.error_throttle_minutes');
        $this->migrator->delete('fin-sentinel.error_throttle_exceptions');
        $this->migrator->delete('fin-sentinel.error_throttle_log_messages');
        $this->migrator->delete('fin-sentinel.ignored_exceptions');

        $this->migrator->delete('fin-sentinel.debug_recipients');
        $this->migrator->delete('fin-sentinel.debug_enabled');
        $this->migrator->delete('fin-sentinel.debug_throttle_minutes');
        $this->migrator->delete('fin-sentinel.debug_throttle_enabled');
    }
};
