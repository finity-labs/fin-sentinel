<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Collection;

class DebugFormatter
{
    /**
     * Format debug data into a type-aware structured array.
     *
     * @return array<string, mixed>
     */
    public function format(mixed $data): array
    {
        return match (true) {
            $data instanceof Model => $this->formatModel($data),
            $data instanceof Collection => $this->formatCollection($data),
            $data instanceof EloquentBuilder, $data instanceof QueryBuilder => $this->formatQuery($data),
            is_array($data) => ['type' => 'array', 'data' => $data],
            default => ['type' => 'scalar', 'value' => (string) $data],
        };
    }

    /**
     * Format an Eloquent Model into a structured array.
     *
     * @return array<string, mixed>
     */
    private function formatModel(Model $model): array
    {
        $result = [
            'type' => 'model',
            'class' => $model::class,
            'attributes' => $model->attributesToArray(),
        ];

        $relations = $model->getRelations();

        if (! empty($relations)) {
            $result['relations'] = array_map(
                fn (mixed $relation): mixed => match (true) {
                    $relation instanceof Model => $relation->attributesToArray(),
                    $relation instanceof Collection => $relation->map(
                        fn (mixed $item): mixed => $item instanceof Model ? $item->attributesToArray() : $item
                    )->all(),
                    default => $relation,
                },
                $relations
            );
        }

        return $result;
    }

    /**
     * Format a Collection into a structured array.
     *
     * @return array<string, mixed>
     */
    private function formatCollection(Collection $collection): array
    {
        return [
            'type' => 'collection',
            'count' => $collection->count(),
            'items' => $collection->map(fn (mixed $item): array => $this->format($item))->all(),
        ];
    }

    /**
     * Format a Query Builder into a structured array.
     *
     * @return array<string, mixed>
     */
    private function formatQuery(EloquentBuilder|QueryBuilder $builder): array
    {
        return [
            'type' => 'query',
            'sql' => $builder->toSql(),
            'bindings' => $builder->getBindings(),
        ];
    }
}
