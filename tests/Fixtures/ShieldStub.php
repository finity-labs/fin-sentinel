<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Tests\Fixtures;

use FinityLabs\FinSentinel\Tests\Fixtures\Pages\ShieldedLogFileList;
use FinityLabs\FinSentinel\Tests\Fixtures\Pages\ShieldedLogFileViewer;

/**
 * What FilamentShield::getPages() answers for the two log pages, in Shield
 * 4's shape and default naming: the keys shield:generate writes for the real
 * LogFileList and LogFileViewer on a host, which is why the fixture pages
 * answer to the real pages' names and not their own.
 *
 * A plain class, deliberately not named BezhanSalleh\*: class_exists() is
 * process-global, so defining a real Shield class would flip every later
 * test's real pages onto the Shield branch. The fixture pages override the
 * trait's two seams instead.
 */
final class ShieldStub
{
    public const LIST_PERMISSION = 'View:LogFileList';

    public const VIEWER_PERMISSION = 'View:LogFileViewer';

    /**
     * @return array<class-string, array{pageFqcn: class-string, permissions: array<string, string>}>
     */
    public static function getPages(): array
    {
        return [
            ShieldedLogFileList::class => [
                'pageFqcn' => ShieldedLogFileList::class,
                'permissions' => [self::LIST_PERMISSION => 'View'],
            ],
            ShieldedLogFileViewer::class => [
                'pageFqcn' => ShieldedLogFileViewer::class,
                'permissions' => [self::VIEWER_PERMISSION => 'View'],
            ],
        ];
    }
}
