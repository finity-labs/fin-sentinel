<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Commands;

use FinityLabs\FinSentinel\Commands\Concerns\CanDeregisterPlugin;
use FinityLabs\FinSentinel\Commands\Concerns\DiscoversPanelProviders;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'fin-sentinel:uninstall', description: 'Uninstall the Fin Sentinel plugin')]
class UninstallCommand extends Command
{
    use CanDeregisterPlugin;
    use DiscoversPanelProviders;

    private const SETTINGS_MIGRATION_FILES = [
        'create_fin_sentinel_settings.php',
        // Legacy migration files (pre-consolidation)
        'create_error_channel_settings.php',
        'create_debug_channel_settings.php',
        'add_throttle_toggles_to_error_channel_settings.php',
        'add_throttle_enabled_to_debug_channel_settings.php',
    ];

    protected $signature = 'fin-sentinel:uninstall {--force : Skip confirmation prompt}';

    protected $description = 'Uninstall the Fin Sentinel plugin.';

    public function handle(): int
    {
        // 1. Confirmation
        if (! $this->option('force')) {
            if (! $this->confirm('This will remove fin-sentinel from all panels and delete published config. Continue?')) {
                $this->info('Uninstall cancelled.');

                return self::SUCCESS;
            }
        }

        $this->info('Uninstalling Fin Sentinel plugin...');
        $this->newLine();

        // 2. Deregister from all panels
        $this->deregisterFromPanels();

        // 3. Delete published config
        $this->cleanupPublishedConfig();

        // 4. Optional settings rollback
        if (! $this->option('force')) {
            if ($this->confirm('Roll back settings migrations?', false)) {
                $this->rollbackSettingsMigrations();
            }
        }

        $this->newLine();
        $this->info('Fin Sentinel plugin uninstalled. You can now run: composer remove finity-labs/fin-sentinel');

        return self::SUCCESS;
    }

    protected function deregisterFromPanels(): void
    {
        $panelProviders = $this->discoverPanelProviders();

        if (empty($panelProviders)) {
            $this->components->warn('No panel providers found. If you registered FinSentinelPlugin manually, remove it before running composer remove.');

            return;
        }

        foreach ($panelProviders as $panelId => $path) {
            $content = file_get_contents($path);

            if ($content !== false && str_contains($content, 'FinSentinelPlugin')) {
                $this->comment("Removing FinSentinelPlugin from {$panelId} panel...");
                $this->deregisterPlugin($path);
            }
        }
    }

    protected function cleanupPublishedConfig(): void
    {
        $configPath = config_path('fin-sentinel.php');

        if (File::exists($configPath)) {
            File::delete($configPath);
            $this->info('  Deleted: config/fin-sentinel.php');
        } else {
            $this->info('  Config file not found (already removed or never published).');
        }
    }

    protected function rollbackSettingsMigrations(): void
    {
        $this->comment('Rolling back settings migrations...');

        $settingsPath = database_path('settings');

        if (! is_dir($settingsPath)) {
            $this->components->warn('No settings migrations directory found.');

            return;
        }

        $found = [];

        foreach (self::SETTINGS_MIGRATION_FILES as $filename) {
            $pattern = $settingsPath.'/*'.$filename;
            $matches = glob($pattern);

            if ($matches !== false) {
                $found = [...$found, ...$matches];
            }
        }

        if (empty($found)) {
            $this->components->warn('No fin-sentinel settings migration files found.');

            return;
        }

        // Clean up settings entries from the settings table
        if (Schema::hasTable('settings')) {
            $deleted = DB::table('settings')
                ->where('group', 'like', 'fin-sentinel%')
                ->delete();

            if ($deleted > 0) {
                $this->info("  Removed {$deleted} settings entries");
            }
        }

        // Remove the migration files
        foreach ($found as $file) {
            unlink($file);
            $this->info('  Deleted: '.basename($file));
        }

        // Clean up migrations table entries
        if (Schema::hasTable('migrations')) {
            $migrationNames = array_map(
                fn (string $file) => pathinfo($file, PATHINFO_FILENAME),
                self::SETTINGS_MIGRATION_FILES,
            );

            DB::table('migrations')
                ->where(function ($query) use ($migrationNames): void {
                    foreach ($migrationNames as $name) {
                        $query->orWhere('migration', 'like', "%{$name}");
                    }
                })
                ->delete();
        }

        $this->info('  Settings migrations rolled back');
    }
}
