<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Commands;

use FinityLabs\FinSentinel\Commands\Concerns\CanRegisterPlugin;
use FinityLabs\FinSentinel\Commands\Concerns\DiscoversPanelProviders;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Process\Process;

use function Laravel\Prompts\multiselect;

#[AsCommand(name: 'fin-sentinel:install', description: 'Install the FinSentinel plugin')]
class InstallCommand extends Command
{
    use CanRegisterPlugin;
    use DiscoversPanelProviders;

    protected ?string $selectedPanelId = null;

    protected bool $shieldConfigured = false;

    protected $signature = 'fin-sentinel:install {panels?*} {--force : Overwrite existing config file}';

    protected $description = 'Install the FinSentinel plugin.';

    public function handle(): int
    {
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

        return self::SUCCESS;
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
            $this->registerPlugin($panelProviders[$panelId]);
            $registered[] = $panelId;
        }

        if (! empty($registered)) {
            $this->selectedPanelId = $registered[0];
            $this->info('  Registered in panels: '.implode(', ', $registered));
        }
    }

    protected function configureShield(): void
    {
        $configPath = config_path('filament-shield.php');

        if (! file_exists($configPath)) {
            return;
        }

        if (! $this->confirm('Register FinSentinel pages in Filament Shield config?', true)) {
            return;
        }

        $content = file_get_contents($configPath);

        if ($content === false) {
            $this->components->warn('Could not read Shield config file.');

            return;
        }

        if (str_contains($content, 'FinityLabs\\FinSentinel')) {
            $this->components->warn('FinSentinel pages are already registered in Shield config.');

            return;
        }

        $entries = ''
            ."            \\FinityLabs\\FinSentinel\\Pages\\LogFileList::class => [\n"
            ."                'viewAny',\n"
            ."                'view',\n"
            ."                'delete',\n"
            ."            ],\n"
            ."            \\FinityLabs\\FinSentinel\\Pages\\LogFileViewer::class => [\n"
            ."                'view',\n"
            ."            ],\n"
            ."            \\FinityLabs\\FinSentinel\\Clusters\\FinSentinelSettings\\Pages\\ManageErrorChannelSettings::class => [\n"
            ."                'view',\n"
            ."                'update',\n"
            ."            ],\n"
            ."            \\FinityLabs\\FinSentinel\\Clusters\\FinSentinelSettings\\Pages\\ManageDebugChannelSettings::class => [\n"
            ."                'view',\n"
            ."                'update',\n"
            ."            ],\n";

        $managePos = strpos($content, "'manage' => [");

        if ($managePos === false) {
            $this->components->warn('Could not find the manage array in Shield config. Add FinSentinel pages manually.');

            return;
        }

        $openBracket = strpos($content, '[', $managePos + strlen("'manage' => "));

        if ($openBracket === false) {
            $this->components->warn('Could not parse Shield config. Add FinSentinel pages manually.');

            return;
        }

        $depth = 1;
        $pos = $openBracket + 1;
        $len = strlen($content);

        while ($pos < $len && $depth > 0) {
            if ($content[$pos] === '[') {
                $depth++;
            } elseif ($content[$pos] === ']') {
                $depth--;
            }

            if ($depth > 0) {
                $pos++;
            }
        }

        $insertPos = strrpos(substr($content, 0, $pos), "\n");

        if ($insertPos === false) {
            $this->components->warn('Could not parse Shield config. Add FinSentinel pages manually.');

            return;
        }

        $insertPos++;

        $content = substr($content, 0, $insertPos).$entries.substr($content, $insertPos);

        file_put_contents($configPath, $content);
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
