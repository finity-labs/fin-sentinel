<?php

declare(strict_types=1);

use Composer\InstalledVersions;
use FinityLabs\FinSentinel\Commands\InstallCommand;
use FinityLabs\FinSentinel\Settings\ErrorChannelSettings;
use FinityLabs\FinSentinel\Support\Ai\AiProviderLabels;
use Illuminate\Http\Client\ConnectionException;

beforeEach(function () {
    app()->forgetInstance('fin-sentinel.ai-available');
    app()->forgetInstance('fin-sentinel.manager');
    app()->forgetInstance(ErrorChannelSettings::class);

    $settings = app(ErrorChannelSettings::class);
    $settings->ai_enabled = false;
    $settings->ai_provider = null;
    $settings->ai_model = null;
    $settings->ai_api_key = null;
    $settings->save();
});

function makeInstallCommandWithMockedComposer(bool $composerSucceeds = true): InstallCommand
{
    return new class($composerSucceeds) extends InstallCommand
    {
        public function __construct(private bool $composerSucceeds)
        {
            parent::__construct();
        }

        protected function runComposerRequire(string $package): bool
        {
            $this->components->info("(mocked) composer require {$package}");

            return $this->composerSucceeds;
        }
    };
}

function bindMockedInstallCommand(bool $composerSucceeds): void
{
    app()->instance(InstallCommand::class, makeInstallCommandWithMockedComposer($composerSucceeds));
}

it('shows the toggle prompt on bare install and respects no answer', function () {
    if (PHP_VERSION_ID < 80300) {
        $this->markTestSkipped('AI toggle prompt is hidden on PHP < 8.3.');
    }

    $this->artisan('fin-sentinel:install')
        ->expectsConfirmation('Publish configuration file?', 'no')
        ->expectsConfirmation('Run migrations now?', 'no')
        ->expectsConfirmation('Enable AI error analysis?', 'no')
        ->assertExitCode(0);

    $settings = app(ErrorChannelSettings::class);
    expect($settings->ai_enabled)->toBeFalse();
});

it('warns and skips AI install when PHP version is below 8.3', function () {
    if (PHP_VERSION_ID >= 80300) {
        $this->markTestSkipped('Cannot simulate PHP < 8.3 on this runtime.');
    }

    $this->artisan('fin-sentinel:install --ai-only')
        ->expectsOutputToContain('AI requires PHP 8.3+ and Laravel 12+.')
        ->assertExitCode(0);
});

it('with --ai flag and SDK absent, runs composer require and instructs re-run', function () {
    if (PHP_VERSION_ID < 80300) {
        $this->markTestSkipped('AI install flow requires PHP 8.3+.');
    }

    if (InstalledVersions::isInstalled('laravel/ai')) {
        $this->markTestSkipped('Test requires laravel/ai to be ABSENT (without-SDK CI row).');
    }

    bindMockedInstallCommand(composerSucceeds: true);

    // No expectsConfirmation('Enable AI error analysis?', ...) — --ai is implicit yes.
    $this->artisan('fin-sentinel:install --ai-only --ai')
        ->expectsOutputToContain('AI SDK installed.')
        ->expectsOutputToContain('php artisan fin-sentinel:install --ai-only')
        ->assertExitCode(0);

    $settings = app(ErrorChannelSettings::class);
    expect($settings->ai_enabled)->toBeFalse();
});

it('reports composer require failure and exits cleanly', function () {
    if (PHP_VERSION_ID < 80300) {
        $this->markTestSkipped('AI install flow requires PHP 8.3+.');
    }

    if (InstalledVersions::isInstalled('laravel/ai')) {
        $this->markTestSkipped('Test requires laravel/ai to be ABSENT (without-SDK CI row).');
    }

    bindMockedInstallCommand(composerSucceeds: false);

    $this->artisan('fin-sentinel:install --ai-only --ai')
        ->doesntExpectOutputToContain('AI SDK installed.')
        ->assertExitCode(0);

    $settings = app(ErrorChannelSettings::class);
    expect($settings->ai_enabled)->toBeFalse();
});

it('with --ai-only and SDK installed, prompts for credentials and saves on success', function () {
    if (! class_exists('Laravel\\Ai\\AnonymousAgent')) {
        $this->markTestSkipped('laravel/ai not installed (without-SDK CI row).');
    }

    config([
        'ai.default' => 'anthropic',
        'ai.providers.anthropic.driver' => 'anthropic',
    ]);

    $aiFacade = 'Laravel\\Ai\\Ai';
    $anonAgentClass = 'Laravel\\Ai\\AnonymousAgent';
    $aiFacade::fakeAgent($anonAgentClass, fn ($prompt) => 'OK');

    // No expectsConfirmation('Enable AI error analysis?', ...) — --ai-only is implicit yes.
    $this->artisan('fin-sentinel:install --ai-only')
        ->expectsChoice('Choose AI provider:', 'anthropic', AiProviderLabels::all())
        ->expectsChoice('Choose model tier:', 'default', ['default' => 'Default', 'cheapest' => 'Cheapest', 'smartest' => 'Smartest'])
        ->expectsQuestion('Enter API key for anthropic:', 'sk-ant-test-key')
        ->expectsOutputToContain('AI validated and configured.')
        ->assertExitCode(0);

    $settings = app(ErrorChannelSettings::class);
    expect($settings->ai_enabled)->toBeTrue();
    expect($settings->ai_provider)->toBe('anthropic');
    expect($settings->ai_api_key)->toBe('sk-ant-test-key');
});

it('with --ai-only and test call failure, does NOT save credentials', function () {
    if (! class_exists('Laravel\\Ai\\AnonymousAgent')) {
        $this->markTestSkipped('laravel/ai not installed (without-SDK CI row).');
    }

    config([
        'ai.default' => 'anthropic',
        'ai.providers.anthropic.driver' => 'anthropic',
    ]);

    $aiFacade = 'Laravel\\Ai\\Ai';
    $anonAgentClass = 'Laravel\\Ai\\AnonymousAgent';
    $aiFacade::fakeAgent($anonAgentClass, function ($prompt) {
        throw new ConnectionException('cURL error 28');
    });

    // No expectsConfirmation('Enable AI error analysis?', ...) — --ai-only is implicit yes.
    $this->artisan('fin-sentinel:install --ai-only')
        ->expectsChoice('Choose AI provider:', 'anthropic', AiProviderLabels::all())
        ->expectsChoice('Choose model tier:', 'default', ['default' => 'Default', 'cheapest' => 'Cheapest', 'smartest' => 'Smartest'])
        ->expectsQuestion('Enter API key for anthropic:', 'sk-ant-bad-key')
        ->expectsOutputToContain('AI validation failed.')
        ->expectsOutputToContain('cURL error 28')
        ->assertExitCode(0);

    $settings = app(ErrorChannelSettings::class);
    expect($settings->ai_enabled)->toBeFalse();
    expect($settings->ai_api_key)->toBeNull();
});

it('PLUMB-06 invariant: InstallCommand has no top-of-file Laravel\\Ai imports', function () {
    $target = realpath(__DIR__.'/../../src/Commands/InstallCommand.php');
    expect($target)->toBeString();

    $proc = proc_open(
        ['grep', '-n', '-e', 'use Laravel\\\\Ai', $target],
        [1 => ['pipe', 'w'], 2 => ['pipe', 'w']],
        $pipes,
    );

    expect($proc)->not->toBeFalse();

    /** @var array<int, resource> $pipes */
    $stdout = stream_get_contents($pipes[1]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    $exitCode = proc_close($proc);

    expect($exitCode)->toBe(1, "PLUMB-06 violation found:\n".(string) $stdout);
    expect($stdout)->toBe('');
});
