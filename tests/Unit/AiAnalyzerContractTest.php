<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Contracts\AiErrorAnalyzerContract;
use FinityLabs\FinSentinel\Services\Ai\AiErrorAnalyzer;
use FinityLabs\FinSentinel\Services\Ai\NullAiErrorAnalyzer;
use FinityLabs\FinSentinel\Services\DataScrubber;
use FinityLabs\FinSentinel\Settings\ErrorChannelSettings;
use FinityLabs\FinSentinel\Support\Ai\AiOutputValidator;
use FinityLabs\FinSentinel\Support\Ai\AiPromptBuilder;
use FinityLabs\FinSentinel\Support\AiSuggestionState;
use FinityLabs\FinSentinel\Support\ScrubbedErrorPayload;

function makePayload(): ScrubbedErrorPayload
{
    return ScrubbedErrorPayload::fromException(
        new RuntimeException('synthetic failure'),
        app(DataScrubber::class),
    );
}

function seedAiPromptTemplate(): void
{
    $settings = app(ErrorChannelSettings::class);
    $settings->ai_prompt_template = 'Analyze: {{error}}';
    $settings->save();
}

it('contract analyze() accepts only ScrubbedErrorPayload', function () {
    $method = new ReflectionMethod(AiErrorAnalyzerContract::class, 'analyze');
    $params = $method->getParameters();

    expect($params)->toHaveCount(1);

    $type = $params[0]->getType();
    expect($type)->not->toBeNull();
    expect($type->getName())->toBe(ScrubbedErrorPayload::class);
});

it('NullAiErrorAnalyzer always returns DISABLED', function () {
    $analyzer = new NullAiErrorAnalyzer;

    $result = $analyzer->analyze(makePayload());

    expect($result->state)->toBe(AiSuggestionState::DISABLED);
    expect($result->suggestion)->toBeNull();
    expect($result->reason)->toBeNull();
});

it('binds AiErrorAnalyzer with constructor-injected builder + validator when SDK is present', function () {
    app()->forgetInstance('fin-sentinel.ai-available');
    app()->instance('fin-sentinel.ai-available', true);
    app()->forgetInstance(AiErrorAnalyzerContract::class);

    $analyzer = app(AiErrorAnalyzerContract::class);

    expect($analyzer)->toBeInstanceOf(AiErrorAnalyzer::class);

    $reflection = new ReflectionClass($analyzer);

    $builderProp = $reflection->getProperty('builder');
    expect($builderProp->getValue($analyzer))->toBeInstanceOf(AiPromptBuilder::class);

    $validatorProp = $reflection->getProperty('validator');
    expect($validatorProp->getValue($analyzer))->toBeInstanceOf(AiOutputValidator::class);
});

it('returns FAILED with safe reason when SDK call cannot complete (INF-04 backstop)', function () {
    app()->forgetInstance('fin-sentinel.ai-available');
    app()->instance('fin-sentinel.ai-available', true);
    app()->forgetInstance(AiErrorAnalyzerContract::class);

    seedAiPromptTemplate();

    $result = app(AiErrorAnalyzerContract::class)->analyze(makePayload());

    expect($result->state)->toBe(AiSuggestionState::FAILED);
    expect($result->reason)->toBe('unknown error');
    expect($result->suggestion)->toBeNull();
});

it('falls back to NullAiErrorAnalyzer when the SDK is absent', function () {
    app()->forgetInstance('fin-sentinel.ai-available');
    app()->instance('fin-sentinel.ai-available', false);
    app()->forgetInstance(AiErrorAnalyzerContract::class);

    $analyzer = app(AiErrorAnalyzerContract::class);

    expect($analyzer)->toBeInstanceOf(NullAiErrorAnalyzer::class);

    $result = $analyzer->analyze(makePayload());
    expect($result->state)->toBe(AiSuggestionState::DISABLED);
});

it('also auto-resolves AiErrorAnalyzer directly via the container', function () {
    seedAiPromptTemplate();

    $analyzer = app(AiErrorAnalyzer::class);

    $reflection = new ReflectionClass($analyzer);
    expect($reflection->getProperty('builder')->getValue($analyzer))->toBeInstanceOf(AiPromptBuilder::class);
    expect($reflection->getProperty('validator')->getValue($analyzer))->toBeInstanceOf(AiOutputValidator::class);

    $result = $analyzer->analyze(makePayload());
    expect($result->state)->toBe(AiSuggestionState::FAILED);
    expect($result->reason)->toBe('unknown error');
});
