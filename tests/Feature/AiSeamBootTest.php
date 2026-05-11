<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Clusters\FinSentinelSettings\FinSentinelSettings;
use FinityLabs\FinSentinel\Contracts\AiErrorAnalyzerContract;
use FinityLabs\FinSentinel\Facades\FinSentinel;
use FinityLabs\FinSentinel\FinSentinelServiceProvider;
use FinityLabs\FinSentinel\Services\Ai\AiErrorAnalyzer;
use FinityLabs\FinSentinel\Services\Ai\NullAiErrorAnalyzer;
use Illuminate\Support\Facades\Log;

beforeEach(function () {
    $reflection = new ReflectionProperty(FinSentinelServiceProvider::class, 'handling');
    $reflection->setAccessible(true);
    $reflection->setValue(null, false);
});

it('registers the service provider and resolves the AI bindings', function () {
    expect(app()->getProviders(FinSentinelServiceProvider::class))->not->toBeEmpty();

    expect(app('fin-sentinel.ai-available'))->toBeBool();

    $analyzer = app(AiErrorAnalyzerContract::class);
    expect($analyzer)->toBeInstanceOf(AiErrorAnalyzerContract::class);
});

it('boots cleanly without the AI SDK installed', function () {
    Log::spy();

    app()->forgetInstance('fin-sentinel.ai-available');
    app()->forgetInstance('fin-sentinel.manager');

    expect(FinSentinel::aiAvailable())->toBeFalse();

    $analyzer = app(AiErrorAnalyzerContract::class);
    expect($analyzer)->toBeInstanceOf(NullAiErrorAnalyzer::class);
    expect($analyzer)->not->toBeInstanceOf(AiErrorAnalyzer::class);

    Log::shouldNotHaveReceived('warning');
    Log::shouldNotHaveReceived('error');
    Log::shouldNotHaveReceived('critical');
})->skip(
    fn () => FinSentinel::aiAvailable(),
    'AI SDK is installed in this environment'
);

it('keeps the Filament settings cluster loadable', function () {
    expect(class_exists(FinSentinelSettings::class))->toBeTrue();
});

it('binds the real analyzer when the AI SDK is installed', function () {
    app()->forgetInstance('fin-sentinel.ai-available');
    app()->forgetInstance('fin-sentinel.manager');

    expect(FinSentinel::aiAvailable())->toBeTrue();

    $analyzer = app(AiErrorAnalyzerContract::class);
    expect($analyzer)->toBeInstanceOf(AiErrorAnalyzer::class);
})->skip(
    fn () => ! FinSentinel::aiAvailable(),
    'AI SDK is not installed in this environment'
);
