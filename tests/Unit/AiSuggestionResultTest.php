<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Support\AiSuggestionResult;
use FinityLabs\FinSentinel\Support\AiSuggestionState;

it('forbids direct construction of AiSuggestionResult', function () {
    $constructor = (new ReflectionClass(AiSuggestionResult::class))->getConstructor();

    expect($constructor)->not->toBeNull();
    expect($constructor->isPrivate())->toBeTrue();
});

it('builds a SUCCESS result via success() factory', function () {
    $result = AiSuggestionResult::success('do the thing');

    expect($result->state)->toBe(AiSuggestionState::SUCCESS);
    expect($result->suggestion)->toBe('do the thing');
    expect($result->reason)->toBeNull();
});

it('builds a FAILED result via failed() factory', function () {
    $result = AiSuggestionResult::failed('timeout after 3s');

    expect($result->state)->toBe(AiSuggestionState::FAILED);
    expect($result->suggestion)->toBeNull();
    expect($result->reason)->toBe('timeout after 3s');
});

it('builds a DISABLED result via disabled() factory', function () {
    $result = AiSuggestionResult::disabled();

    expect($result->state)->toBe(AiSuggestionState::DISABLED);
    expect($result->suggestion)->toBeNull();
    expect($result->reason)->toBeNull();
});

it('builds a SKIPPED result via skipped() factory', function () {
    $result = AiSuggestionResult::skipped('hourly cap reached');

    expect($result->state)->toBe(AiSuggestionState::SKIPPED);
    expect($result->suggestion)->toBeNull();
    expect($result->reason)->toBe('hourly cap reached');
});

it('builds a CACHED result via cached() factory', function () {
    $result = AiSuggestionResult::cached('cached suggestion body');

    expect($result->state)->toBe(AiSuggestionState::CACHED);
    expect($result->suggestion)->toBe('cached suggestion body');
    expect($result->reason)->toBeNull();
});

it('exposes exactly five AiSuggestionState cases', function () {
    expect(AiSuggestionState::cases())->toHaveCount(5);
});
