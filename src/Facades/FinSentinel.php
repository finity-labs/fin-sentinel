<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Facades;

use FinityLabs\FinSentinel\Services\FinSentinelManager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \FinityLabs\FinSentinel\Support\DebugBuilder debug(mixed $data, ?string $subject = null)
 * @method static bool aiAvailable()
 *
 * @see FinSentinelManager
 */
class FinSentinel extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'fin-sentinel.manager';
    }
}
