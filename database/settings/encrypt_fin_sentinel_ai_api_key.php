<?php

declare(strict_types=1);

use Illuminate\Contracts\Encryption\DecryptException;
use Spatie\LaravelSettings\Migrations\SettingsMigration;
use Spatie\LaravelSettings\Support\Crypto;
use Spatie\LaravelSettings\Support\SettingsCacheFactory;

/**
 * Encrypts an AI key that an earlier release wrote in plain text.
 *
 * fin-sentinel 1.2.1 and earlier accepted spatie/laravel-settings below
 * 3.7.2, which does not know the ShouldBeEncrypted attribute, so a key
 * saved through ErrorChannelSettings on such a version landed in
 * settings.payload as it was typed. A payload that decrypts is left byte
 * for byte as it is, which makes the migration safe on every install and
 * safe to run more than once; a payload that does not decrypt is taken to
 * be that plain-text key and encrypted in place. The settings cache is
 * cleared afterwards: a cached copy of the old row would fail to decrypt
 * on the next read.
 */
return new class extends SettingsMigration
{
    private const PROPERTY = 'fin-sentinel.ai_api_key';

    public function up(): void
    {
        if (! $this->migrator->exists(self::PROPERTY)) {
            return;
        }

        $this->migrator->update(self::PROPERTY, static function (mixed $payload): mixed {
            if (! is_string($payload) || $payload === '') {
                return $payload;
            }

            try {
                Crypto::decrypt($payload);

                return $payload;
            } catch (DecryptException) {
                return Crypto::encrypt($payload);
            }
        });

        app(SettingsCacheFactory::class)->build()->clear();
    }

    /**
     * Nothing to undo: a key is never written back in plain text.
     */
    public function down(): void {}
};
