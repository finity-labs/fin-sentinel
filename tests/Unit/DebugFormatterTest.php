<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Services\DebugFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

beforeEach(function () {
    $this->formatter = new DebugFormatter();
});

it('formats a model with type, class, and attributes', function () {
    $model = new class extends Model
    {
        protected $guarded = [];
        protected $table = 'test_models';
    };

    $model->forceFill(['name' => 'John', 'email' => 'john@example.com']);

    $result = $this->formatter->format($model);

    expect($result['type'])->toBe('model');
    expect($result['class'])->toContain('anonymous');
    expect($result['attributes'])->toBe(['name' => 'John', 'email' => 'john@example.com']);
    expect($result)->not->toHaveKey('relations');
});

it('formats a model with loaded relations', function () {
    $related = new class extends Model
    {
        protected $guarded = [];
        protected $table = 'related';
    };
    $related->forceFill(['id' => 1, 'title' => 'Post']);

    $model = new class extends Model
    {
        protected $guarded = [];
        protected $table = 'test_models';
    };
    $model->forceFill(['name' => 'John']);
    $model->setRelation('posts', collect([$related]));

    $result = $this->formatter->format($model);

    expect($result['type'])->toBe('model');
    expect($result)->toHaveKey('relations');
    expect($result['relations']['posts'])->toHaveCount(1);
    expect($result['relations']['posts'][0])->toBe(['id' => 1, 'title' => 'Post']);
});

it('formats a collection with count and recursively formatted items', function () {
    $collection = collect(['hello', 'world']);

    $result = $this->formatter->format($collection);

    expect($result['type'])->toBe('collection');
    expect($result['count'])->toBe(2);
    expect($result['items'])->toHaveCount(2);
    expect($result['items'][0])->toBe(['type' => 'scalar', 'value' => 'hello']);
    expect($result['items'][1])->toBe(['type' => 'scalar', 'value' => 'world']);
});

it('formats an array with type and data', function () {
    $data = ['key' => 'value', 'nested' => [1, 2, 3]];

    $result = $this->formatter->format($data);

    expect($result)->toBe([
        'type' => 'array',
        'data' => $data,
    ]);
});

it('formats a string as scalar', function () {
    $result = $this->formatter->format('hello world');

    expect($result)->toBe([
        'type' => 'scalar',
        'value' => 'hello world',
    ]);
});

it('formats an integer as scalar with string value', function () {
    $result = $this->formatter->format(42);

    expect($result)->toBe([
        'type' => 'scalar',
        'value' => '42',
    ]);
});

it('formats a collection of models with recursive model formatting', function () {
    $model = new class extends Model
    {
        protected $guarded = [];
        protected $table = 'test_models';
    };
    $model->forceFill(['id' => 1, 'name' => 'First']);

    $model2 = new class extends Model
    {
        protected $guarded = [];
        protected $table = 'test_models';
    };
    $model2->forceFill(['id' => 2, 'name' => 'Second']);

    $result = $this->formatter->format(collect([$model, $model2]));

    expect($result['type'])->toBe('collection');
    expect($result['count'])->toBe(2);
    expect($result['items'][0]['type'])->toBe('model');
    expect($result['items'][0]['attributes'])->toBe(['id' => 1, 'name' => 'First']);
    expect($result['items'][1]['type'])->toBe('model');
    expect($result['items'][1]['attributes'])->toBe(['id' => 2, 'name' => 'Second']);
});
