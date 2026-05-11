<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Clusters\FinSentinelSettings\Pages\ManageErrorChannelSettings;
use FinityLabs\FinSentinel\Support\Ai\AiProviderLabels;

beforeEach(function () {
    app()->forgetInstance('fin-sentinel.ai-available');
    app()->forgetInstance('fin-sentinel.manager');
});

it('returns an empty array from all() when the SDK is unavailable', function () {
    app()->instance('fin-sentinel.ai-available', false);
    app()->forgetInstance('fin-sentinel.manager');

    expect(AiProviderLabels::all())->toBe([]);
});

it('returns the 9 text-capable provider keys when the SDK is available', function () {
    app()->instance('fin-sentinel.ai-available', true);
    app()->forgetInstance('fin-sentinel.manager');

    $labels = AiProviderLabels::all();

    expect($labels)->toBeArray()->not->toBeEmpty();
    expect(array_keys($labels))->toEqualCanonicalizing([
        'anthropic',
        'azure',
        'deepseek',
        'gemini',
        'groq',
        'mistral',
        'ollama',
        'openai',
        'xai',
    ]);
})->skip(fn (): bool => ! class_exists('Laravel\\Ai\\Enums\\Lab'), 'requires laravel/ai');

it('returns the Lab case name from pretty() for a known provider key', function () {
    app()->instance('fin-sentinel.ai-available', true);
    app()->forgetInstance('fin-sentinel.manager');

    expect(AiProviderLabels::pretty('anthropic'))->toBe('Anthropic');
})->skip(fn (): bool => ! class_exists('Laravel\\Ai\\Enums\\Lab'), 'requires laravel/ai');

it('returns an empty string from pretty() for null or empty input', function () {
    expect(AiProviderLabels::pretty(null))->toBe('');
    expect(AiProviderLabels::pretty(''))->toBe('');
});

it('falls back to ucfirst() from pretty() for unknown provider keys', function () {
    expect(AiProviderLabels::pretty('unknown_provider'))->toBe('Unknown_provider');
});

it('produces the same map as the page-level aiProviderOptions() helper', function () {
    app()->instance('fin-sentinel.ai-available', true);
    app()->forgetInstance('fin-sentinel.manager');

    $page = new ManageErrorChannelSettings;
    $method = new ReflectionMethod($page, 'aiProviderOptions');

    expect($method->invoke($page))->toBe(AiProviderLabels::all());
})->skip(fn (): bool => ! class_exists('Laravel\\Ai\\Enums\\Lab'), 'requires laravel/ai');
