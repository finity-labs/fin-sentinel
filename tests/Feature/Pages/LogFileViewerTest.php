<?php

declare(strict_types=1);

use Filament\Facades\Filament;
use FinityLabs\FinSentinel\FinSentinelPlugin;
use FinityLabs\FinSentinel\Pages\LogFileList;
use FinityLabs\FinSentinel\Pages\LogFileViewer;
use FinityLabs\FinSentinel\Tests\Fixtures\Pages\ShieldedLogFileList;
use FinityLabs\FinSentinel\Tests\Fixtures\Pages\ShieldedLogFileViewer;
use FinityLabs\FinSentinel\Tests\Fixtures\ShieldStub;
use FinityLabs\FinSentinel\Tests\Fixtures\User;
use Illuminate\Support\Facades\Gate;

/*
 * Access to the log file viewer (sentinel/logs/{file}). Until 1.2.3 its only
 * guard was the path check in mount(), so any signed-in panel user who could
 * guess a file name read the log. It now carries HasPageShieldSupport like
 * the list page, and these rows pin the three answers the trait gives:
 *
 *   - Shield present: View:LogFileViewer, the permission shield:generate has
 *     written for the page all along;
 *   - no Shield: the page_LogFileViewer Gate ability when the host defines it;
 *   - otherwise the plugin's canAccess() closure.
 *
 * The Shield branch runs on fixture subclasses (tests/Fixtures/Pages) that
 * override the trait's two protected seams and sit in the same panel under
 * their own slugs, NOT on a stubbed BezhanSalleh\* class: class_exists() is
 * process-global, so a real stub would flip the real pages onto the Shield
 * branch for every later test in the process.
 */

beforeEach(function (): void {
    // Both pages read storage_path('logs'); the parser is bound per
    // resolution, so it follows the swap as the scanner does.
    $this->storagePath = sys_get_temp_dir().'/fin-sentinel-viewer-'.uniqid();
    mkdir($this->storagePath.'/logs', 0755, true);
    app()->useStoragePath($this->storagePath);
});

afterEach(function (): void {
    foreach ([...(glob($this->storagePath.'/logs/*') ?: []), $this->storagePath.'/.env'] as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }

    rmdir($this->storagePath.'/logs');
    rmdir($this->storagePath);
});

/** A panel user with no permission and no role: the limited admin of the report. */
function finSentinelLimitedUser(): User
{
    return User::create(['name' => 'Limited admin', 'email' => 'limited@example.com']);
}

/** One readable log file under the app's logs directory, by the relative path the pages take. */
function finSentinelLogFile(string $name = 'laravel.log'): string
{
    file_put_contents(storage_path('logs/'.$name), "[2026-10-14 09:30:00] testing.ERROR: Payment gateway timed out\n");

    return $name;
}

/** The viewer URL for a relative log path, encoded the way the list page's View action encodes it. */
function finSentinelViewerUrl(string $file, string $page = LogFileViewer::class): string
{
    return $page::getUrl(['file' => base64_encode($file)]);
}

/** The plugin instance the admin panel serves, whose options a test may change before its request. */
function finSentinelPlugin(): FinSentinelPlugin
{
    return Filament::getPanel('admin')->getPlugin('fin-sentinel');
}

/*
 * -----------------------------------------------------------------------
 * Shield present: the key comes from Shield, the answer from the user.
 * -----------------------------------------------------------------------
 */

it('forbids the viewer to a panel user without shield\'s permission', function (): void {
    $file = finSentinelLogFile();

    $this->actingAs(finSentinelLimitedUser())
        ->get(finSentinelViewerUrl($file, ShieldedLogFileViewer::class))
        ->assertForbidden();
});

it('forbids the viewer to a user who holds the list permission only', function (): void {
    $file = finSentinelLogFile();
    $user = finSentinelLimitedUser();
    Gate::define(ShieldStub::LIST_PERMISSION, fn (): bool => true);

    $this->actingAs($user)->get(ShieldedLogFileList::getUrl())->assertSee($file);
    $this->actingAs($user)->get(finSentinelViewerUrl($file, ShieldedLogFileViewer::class))->assertForbidden();
});

it('renders the log to a user with shield\'s permission', function (): void {
    $file = finSentinelLogFile();
    Gate::define(ShieldStub::VIEWER_PERMISSION, fn (): bool => true);

    $this->actingAs(finSentinelLimitedUser())
        ->get(finSentinelViewerUrl($file, ShieldedLogFileViewer::class))
        ->assertSee('Payment gateway timed out');
});

it('asks shield for the viewer permission rather than building the name', function (): void {
    $permission = (new ReflectionMethod(ShieldedLogFileViewer::class, 'getPagePermission'))->invoke(null);

    // Shield 4's shape, the row a host's shield:generate has already written.
    expect($permission)->toBe(ShieldStub::VIEWER_PERMISSION)->toBe('View:LogFileViewer');
});

/*
 * -----------------------------------------------------------------------
 * No Shield: the plugin's closure, then a Gate ability named after the page.
 * -----------------------------------------------------------------------
 */

it('renders the log when nothing gates the viewer', function (): void {
    $file = finSentinelLogFile();

    $this->actingAs(finSentinelLimitedUser())
        ->get(finSentinelViewerUrl($file))
        ->assertSee('Payment gateway timed out');
});

it('forbids both log pages when the plugin\'s canAccess closure says no', function (): void {
    $file = finSentinelLogFile();
    $user = finSentinelLimitedUser();
    finSentinelPlugin()->canAccess(fn (): bool => false);

    $this->actingAs($user)->get(LogFileList::getUrl())->assertForbidden();
    $this->actingAs($user)->get(finSentinelViewerUrl($file))->assertForbidden();
});

it('follows a page_LogFileViewer gate ability and leaves the list to its own', function (): void {
    $file = finSentinelLogFile();
    $user = finSentinelLimitedUser();
    Gate::define('page_LogFileViewer', fn (): bool => false);

    $this->actingAs($user)->get(finSentinelViewerUrl($file))->assertForbidden();
    $this->actingAs($user)->get(LogFileList::getUrl())->assertSee($file);
});

/*
 * -----------------------------------------------------------------------
 * What the trait must not change.
 * -----------------------------------------------------------------------
 */

it('keeps the viewer out of navigation even when it is reachable', function (): void {
    $this->usesPanel('admin', finSentinelLimitedUser());

    expect(LogFileViewer::canAccess())->toBeTrue()
        ->and(LogFileViewer::shouldRegisterNavigation())->toBeFalse();
    // The list is the control: navigation is still being registered.
    expect(LogFileList::shouldRegisterNavigation())->toBeTrue();
});

it('still sends a path outside the logs directory back to the list', function (): void {
    file_put_contents($this->storagePath.'/.env', 'APP_KEY=not-for-the-viewer');

    $this->actingAs(finSentinelLimitedUser())
        ->get(finSentinelViewerUrl('../.env'))
        ->assertRedirect(LogFileList::getUrl());
});

it('defines no shield class anywhere in the suite', function (): void {
    // Plain strings, never ::class: the point of the fixture design is that
    // no BezhanSalleh class is ever loaded, so the real pages sit on the Gate
    // branch whatever ran before this.
    expect(class_exists('BezhanSalleh\FilamentShield\FilamentShieldPlugin', false))->toBeFalse()
        ->and((new ReflectionMethod(LogFileViewer::class, 'isShieldAvailable'))->invoke(null))->toBeFalse();
});
