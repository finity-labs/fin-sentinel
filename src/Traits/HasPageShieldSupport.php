<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Traits;

use FinityLabs\FinSentinel\FinSentinelPlugin;
use FinityLabs\FinSupport\Pages\Concerns\HasPageShieldSupport as SupportsPageShield;

/**
 * fin-support's page access — Shield's permission when Shield is installed,
 * an opt-in page_{ClassBasename} Gate ability when it is not — with the
 * plugin's canAccessUsing() closure as the last word, the way FinSentinel
 * pages have always answered.
 */
trait HasPageShieldSupport
{
    use SupportsPageShield;

    protected static function canAccessFallback(): bool
    {
        return FinSentinelPlugin::get()->userCanAccess();
    }
}
