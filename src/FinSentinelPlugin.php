<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel;

use Closure;
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

    protected string $policyNamespace = 'App\\Policies';

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
        $panel->discoverClusters(
            in: __DIR__.'/Clusters',
            for: 'FinityLabs\\FinSentinel\\Clusters'
        );
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

    public function policyNamespace(string $namespace): static
    {
        $this->policyNamespace = $namespace;

        return $this;
    }

    public function getNavigationGroup(): ?string
    {
        $group = $this->evaluate($this->navigationGroup);

        if ($group instanceof UnitEnum) {
            return $group->value ?? $group->name;
        }

        return $group;
    }

    public function getNavigationSort(): ?int
    {
        return $this->navigationSort;
    }

    public function getPolicyNamespace(): string
    {
        return $this->policyNamespace;
    }
}
