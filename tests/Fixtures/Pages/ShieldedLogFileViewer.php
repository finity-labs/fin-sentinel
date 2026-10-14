<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Tests\Fixtures\Pages;

use FinityLabs\FinSentinel\Pages\LogFileViewer;
use FinityLabs\FinSentinel\Tests\Fixtures\ShieldStub;

/**
 * The viewer as it behaves on a host that HAS Shield; see ShieldedLogFileList
 * for the shape. The {file} parameter, mount()'s path check and the table are
 * the real page's.
 */
class ShieldedLogFileViewer extends LogFileViewer
{
    protected static ?string $slug = 'shielded/logs/{file}';

    protected static function isShieldAvailable(): bool
    {
        return true;
    }

    protected static function getPagePermission(): ?string
    {
        $page = ShieldStub::getPages()[static::class] ?? null;

        return $page ? array_key_first($page['permissions']) : null;
    }
}
