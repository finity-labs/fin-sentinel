<?php

declare(strict_types=1);

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('fin-sentinel.ignored_log_levels', [
            'debug',
            'info',
            'notice',
            'warning',
        ]);
    }
};
