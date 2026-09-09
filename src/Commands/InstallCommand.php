<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Commands;

use Composer\InstalledVersions;
use FinityLabs\FinSentinel\Clusters\FinSentinelSettings\Pages\ManageDebugChannelSettings;
use FinityLabs\FinSentinel\Clusters\FinSentinelSettings\Pages\ManageErrorChannelSettings;
use FinityLabs\FinSentinel\FinSentinelPlugin;
use FinityLabs\FinSentinel\Pages\LogFileList;
use FinityLabs\FinSentinel\Pages\LogFileViewer;
use FinityLabs\FinSentinel\Settings\ErrorChannelSettings;
use FinityLabs\FinSentinel\Support\Ai\AiProviderLabels;
use FinityLabs\FinSupport\Console\Concerns\DiscoversPanelProviders;
use FinityLabs\FinSupport\Console\Concerns\EditsPanelProviders;
use FinityLabs\FinSupport\Console\Concerns\EditsShieldConfig;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\multiselect;
use function Laravel\Prompts\password;
use function Laravel\Prompts\select;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Process\Process;

#[AsCommand(name: 'fin-sentinel:install', description: 'Install the FinSentinel plugin')]
class InstallCommand extends Command
{
    use DiscoversPanelProviders;
    use EditsPanelProviders;
    use EditsShieldConfig;

    /**
     * What Shield's config gets: the pages and their abilities.
     *
     * @var array<class-string, list<string>>
     */
    private const SHIELD_PAGES = [
        LogFileList::class => ['viewAny', 'view', 'delete'],
        LogFileViewer::class => ['view'],
        ManageErrorChannelSettings::class => ['view', 'update'],
        ManageDebugChannelSettings::class => ['view', 'update'],
    ];

    protected ?string $selectedPanelId = null;

    protected bool $shieldConfigured = false;

    protected $signature = 'fin-sentinel:install {panels?*} {--force : Overwrite existing config file} {--ai : Skip the AI prompt and proceed with AI install} {--ai-only : Run only the AI install step (skips config publish, migrations, panels, Shield)}';

    protected $description = 'Install the FinSentinel plugin.';

    public function handle(): int
    {
        if ($this->option('ai-only')) {
            return $this->runAiInstall();
        }

        $this->info('Installing FinSentinel plugin...');
        $this->newLine();

        // 1. Publish config (optional)
        if ($this->confirm('Publish configuration file?', false)) {
            $this->comment('Publishing configuration...');
            $this->callSilently('vendor:publish', [
                '--tag' => 'fin-sentinel-config',
                '--force' => $this->option('force'),
            ]);
            $this->info('  Config published to config/fin-sentinel.php');
        }

        // 2. Run settings migrations
        $this->ensureSettingsTableExists();

        $this->comment('Publishing migrations...');
        $this->callSilently('vendor:publish', [
            '--tag' => 'fin-sentinel-migrations',
        ]);
        $this->info('  Migrations published');

        if ($this->confirm('Run migrations now?', true)) {
            $this->comment('Running migrations...');
            $this->call('migrate');
            $this->info('  Migrations complete');
        }

        // 3. Panel selection + registration
        $this->registerInPanels();

        // 4. Shield integration
        $this->configureShield();

        $this->newLine();
        $this->info('FinSentinel plugin installed successfully!');
        $this->newLine();

        $nextSteps = [
            ['Configure settings', 'Visit the Sentinel settings page in Filament admin'],
            ['Add recipients', 'Add error/debug notification recipients in Settings'],
        ];

        if ($this->shieldConfigured) {
            $nextSteps[] = ['Assign permissions', 'Assign FinSentinel Shield permissions to roles'];
        }

        $this->table(['Next Steps', 'Details'], $nextSteps);

        $this->runAiInstall();

        return self::SUCCESS;
    }

    protected function runAiInstall(): int
    {
        $this->newLine();
        $this->info('AI Setup');

        if (! $this->checkAiVersionRequirements()) {
            return self::SUCCESS;
        }

        // explicit AI invocation (--ai or --ai-only) is implicit yes; bare install still asks.
        $shouldEnable = $this->option('ai')
            || $this->option('ai-only')
            || confirm(label: 'Enable AI error analysis?', default: false);

        if (! $shouldEnable) {
            return self::SUCCESS;
        }

        $sdkAlreadyInstalled = InstalledVersions::isInstalled('laravel/ai');

        if (! $sdkAlreadyInstalled) {
            if (! $this->runComposerRequire('laravel/ai:^0.6')) {
                return self::SUCCESS;
            }

            // Parent process autoloader can't see the freshly-installed SDK; defer the test call
            // to the next process invocation via the documented --ai-only retry.
            $this->components->info('AI SDK installed.');
            $this->line('  Re-run `php artisan fin-sentinel:install --ai-only` to provide credentials and validate.');

            return self::SUCCESS;
        }

        $this->promptAndValidateAiCredentials();

        return self::SUCCESS;
    }

    protected function checkAiVersionRequirements(): bool
    {
        $phpOk = PHP_VERSION_ID >= 80300;
        $laravelMajor = (int) explode('.', app()->version())[0];
        $laravelOk = $laravelMajor >= 12;

        if ($phpOk && $laravelOk) {
            return true;
        }

        $this->components->warn(sprintf(
            "AI requires PHP 8.3+ and Laravel 12+. You're on PHP %s / Laravel %s.",
            PHP_VERSION,
            app()->version(),
        ));
        $this->line('  Skipping AI install. The plugin will work without AI features.');
        $this->line('  To enable AI later: upgrade PHP/Laravel and re-run `php artisan fin-sentinel:install --ai-only`.');

        return false;
    }

    protected function runComposerRequire(string $package): bool
    {
        $args = ['composer', 'require', $package, '--no-interaction', '--ansi'];
        $process = new Process($args, base_path());
        $process->setTimeout(120);

        $process->run(function ($type, $buffer): void {
            $this->output->write($buffer);
        });

        if (! $process->isSuccessful()) {
            $stderr = $process->getErrorOutput();
            $firstLine = strtok($stderr, "\n") ?: 'unknown error';
            $this->components->error("Composer require failed: {$firstLine}");
            $this->line("  Re-run after fixing: composer require {$package}");

            return false;
        }

        return true;
    }

    protected function promptAndValidateAiCredentials(): void
    {
        $providerOptions = AiProviderLabels::all();

        if (empty($providerOptions)) {
            $this->components->error('No AI providers detected from the SDK.');
            $this->line('  This usually means laravel/ai is installed but the Lab enum is unavailable.');

            return;
        }

        $provider = (string) select(
            label: 'Choose AI provider:',
            options: $providerOptions,
            default: array_key_first($providerOptions),
        );

        $tier = (string) select(
            label: 'Choose model tier:',
            options: ['default' => 'Default', 'cheapest' => 'Cheapest', 'smartest' => 'Smartest'],
            default: 'default',
        );

        $model = $this->resolveModelForTier($provider, $tier);

        $apiKey = password(
            label: "Enter API key for {$provider}:",
            required: true,
        );

        $this->testAndSaveAiConnection($provider, $model, $apiKey);
    }

    protected function resolveModelForTier(string $provider, string $tier): string
    {
        $aiFacadeClass = '\\Laravel\\Ai\\Ai';
        $instance = $aiFacadeClass::textProvider($provider);

        return match ($tier) {
            'cheapest' => $instance->cheapestTextModel(),
            'smartest' => $instance->smartestTextModel(),
            default => $instance->defaultTextModel(),
        };
    }

    protected function testAndSaveAiConnection(string $provider, string $model, string $apiKey): void
    {
        $names = $this->sdkNames();
        $agentFn = $names['agent'];
        $labFqcn = $names['lab'];

        try {
            $providerEnum = $labFqcn::from($provider);

            $response = $this->withProviderKey(
                $provider,
                $apiKey,
                fn () => $agentFn('', [], [])->prompt(
                    'Reply with the single word OK.',
                    provider: $providerEnum,
                    model: $model,
                    timeout: 10,
                ),
            );

            (string) $response;

            $settings = app(ErrorChannelSettings::class);
            $settings->ai_provider = $provider;
            $settings->ai_model = $model;
            $settings->ai_api_key = $apiKey;
            $settings->ai_enabled = true;
            $settings->save();

            $this->components->info('AI validated and configured.');
        } catch (\Throwable $e) {
            $this->components->error('AI validation failed.');
            $this->line('  Provider error: '.$e->getMessage());
            $this->newLine();
            $this->line('  Re-run with `php artisan fin-sentinel:install --ai-only` to retry,');
            $this->line('  or configure manually in the Filament settings page.');
        }
    }

    /**
     * Inject the DB-stored API key into the SDK config for one call, then restore.
     * `Ai::forgetInstance()` invalidates the cached provider so it re-reads config.
     */
    protected function withProviderKey(string $provider, string $apiKey, callable $fn): mixed
    {
        $configKey = "ai.providers.{$provider}.key";
        $previousKey = config($configKey);
        $aiFacade = '\\Laravel\\Ai\\Ai';

        config([$configKey => $apiKey]);
        $aiFacade::forgetInstance($provider);

        try {
            return $fn();
        } finally {
            config([$configKey => $previousKey]);
            $aiFacade::forgetInstance($provider);
        }
    }

    /**
     * @return array{agent: string, lab: string}
     */
    protected function sdkNames(): array
    {
        $ns = trim('\Laravel\Ai', '\\');

        return [
            'agent' => $ns.'\\agent',
            'lab' => $ns.'\\Enums\\Lab',
        ];
    }

    protected function ensureSettingsTableExists(): void
    {
        if (Schema::hasTable('settings')) {
            return;
        }

        $this->comment('Publishing spatie/laravel-settings migration...');
        $this->callSilently('vendor:publish', [
            '--provider' => 'Spatie\LaravelSettings\LaravelSettingsServiceProvider',
            '--tag' => 'migrations',
        ]);
        $this->info('  Settings migration published');

        $this->comment('Running settings migration...');
        $this->call('migrate');
        $this->info('  Settings table created');
    }

    protected function registerInPanels(): void
    {
        $panelProviders = $this->discoverPanelProviders();

        if (empty($panelProviders)) {
            $this->components->warn('No panel providers found in app/Providers/Filament/. Register FinSentinelPlugin::make() manually.');

            return;
        }

        $panelIds = array_keys($panelProviders);
        $requestedPanels = $this->argument('panels');

        if (! empty($requestedPanels)) {
            $selectedPanels = $requestedPanels;
        } elseif ($this->input->isInteractive()) {
            $selectedPanels = multiselect(
                label: 'Which panels should FinSentinel be registered in?',
                options: array_combine($panelIds, $panelIds),
                default: $panelIds,
                required: true,
            );
        } else {
            $selectedPanels = $panelIds;
        }

        $registered = [];

        foreach ($selectedPanels as $panelId) {
            if (! isset($panelProviders[$panelId])) {
                $this->components->warn("Panel provider not found for: {$panelId}");

                continue;
            }

            $this->comment("Registering FinSentinelPlugin in {$panelId} panel...");
            $this->registerPlugin($panelProviders[$panelId], FinSentinelPlugin::class);
            $registered[] = $panelId;
        }

        if (! empty($registered)) {
            $this->selectedPanelId = $registered[0];
            $this->info('  Registered in panels: '.implode(', ', $registered));
        }
    }

    protected function configureShield(): void
    {
        if (! $this->hasShieldConfig()) {
            return;
        }

        if (! $this->confirm('Register FinSentinel pages in Filament Shield config?', true)) {
            return;
        }

        if (! $this->registerShieldResources(self::SHIELD_PAGES, 'FinityLabs\\FinSentinel')) {
            return;
        }

        $this->info('  FinSentinel pages registered in Shield config');

        $this->generateShieldPermissions();
    }

    protected function generateShieldPermissions(): void
    {
        $this->comment('Generating Shield permissions and policies for FinSentinel pages...');

        $args = [
            PHP_BINARY, 'artisan', 'shield:generate',
            '--page=ManageErrorChannelSettings,ManageDebugChannelSettings,LogFileList,LogFileViewer',
            '--option=policies_and_permissions',
            '--ignore-existing-policies',
            '--no-interaction',
        ];

        if ($this->selectedPanelId !== null) {
            $args[] = "--panel={$this->selectedPanelId}";
        }

        $process = new Process($args, base_path());
        $process->setTimeout(60);
        $process->run();

        if ($process->isSuccessful()) {
            $this->shieldConfigured = true;
            $this->info('  Shield permissions and policies generated');
        } else {
            $this->components->warn('Could not generate Shield permissions automatically. Run manually:');
            $panelFlag = $this->selectedPanelId !== null ? " --panel={$this->selectedPanelId}" : '';
            $this->line("  php artisan shield:generate{$panelFlag} --option=policies_and_permissions --ignore-existing-policies");
        }
    }
}
