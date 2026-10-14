<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Tests\Fixtures\Pages;

use FinityLabs\FinSentinel\Pages\LogFileList;
use FinityLabs\FinSentinel\Tests\Fixtures\ShieldStub;

/**
 * The list page as it behaves on a host that HAS Shield: only the trait's
 * two seams are overridden, "is Shield here?" and "what does Shield call
 * this page's permission?". Everything the tests exercise is the shipped
 * trait's code on the shipped page. Its own slug keeps it off the real
 * page's route, and it stays out of navigation so the sidebar lists the
 * real pages only. The permission is not memoised into the trait's static
 * property, which the real page would share.
 */
class ShieldedLogFileList extends LogFileList
{
    protected static ?string $slug = 'shielded/logs';

    protected static bool $shouldRegisterNavigation = false;

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
