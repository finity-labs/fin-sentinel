<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel;

use Closure;
use Filament\Clusters\Cluster;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use FinityLabs\FinSentinel\Enums\NavigationGroup;
use UnitEnum;

class FinSentinelPlugin implements Plugin
{
    use EvaluatesClosures;

    protected string|UnitEnum|Closure|null $navigationGroup = NavigationGroup::Sentinel;

    protected ?int $navigationSort = null;

    protected ?Closure $canAccessUsing = null;

    protected static ?string $resolvedSettingsCluster = null;

    protected ?int $settingsNavigationSort = null;

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        return filament(app(static::class)->getId());
    }

    public function getId(): string
    {
        return 'fin-sentinel';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->discoverClusters(
                in: __DIR__.'/Clusters',
                for: 'FinityLabs\\FinSentinel\\Clusters'
            )
            ->pages([
                Pages\LogFileList::class,
                Pages\LogFileViewer::class,
            ]);
    }

    public function boot(Panel $panel): void {}

    public function navigationGroup(string|UnitEnum|Closure|null $group): static
    {
        $this->navigationGroup = $group;

        return $this;
    }

    public function navigationSort(?int $sort): static
    {
        $this->navigationSort = $sort;

        return $this;
    }

    public function canAccess(?Closure $callback): static
    {
        $this->canAccessUsing = $callback;

        return $this;
    }

    /**
     * @param  class-string<Cluster>|null  $cluster
     */
    public function settingsCluster(?string $cluster): static
    {
        static::$resolvedSettingsCluster = $cluster;

        return $this;
    }

    /**
     * @return class-string<Cluster>
     */
    public static function getSettingsCluster(): string
    {
        return static::$resolvedSettingsCluster ?? Clusters\FinSentinelSettings\FinSentinelSettings::class;
    }

    public function settingsNavigationSort(?int $sort): static
    {
        $this->settingsNavigationSort = $sort;

        return $this;
    }

    public function getSettingsNavigationSort(int $default = 1): int
    {
        return $this->settingsNavigationSort ?? $default;
    }

    public function getNavigationGroup(): string|UnitEnum|null
    {
        return $this->evaluate($this->navigationGroup);
    }

    public function getNavigationSort(): ?int
    {
        return $this->navigationSort;
    }

    public function userCanAccess(): bool
    {
        if ($this->canAccessUsing === null) {
            return true;
        }

        return (bool) $this->evaluate($this->canAccessUsing);
    }
}
