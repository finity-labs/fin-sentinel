<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Support\AiSuggestionResult;

it('success() defaults promptTokens and completionTokens to null when not provided', function () {
    $result = AiSuggestionResult::success('msg');

    expect($result->promptTokens)->toBeNull();
    expect($result->completionTokens)->toBeNull();
});

it('success() exposes the supplied prompt and completion token counts', function () {
    $result = AiSuggestionResult::success('msg', 100, 50);

    expect($result->promptTokens)->toBe(100);
    expect($result->completionTokens)->toBe(50);
});

it('failed() exposes the supplied prompt and completion token counts', function () {
    $result = AiSuggestionResult::failed('reason', 10, 20);

    expect($result->promptTokens)->toBe(10);
    expect($result->completionTokens)->toBe(20);
});

it('cached() leaves promptTokens and completionTokens null', function () {
    $result = AiSuggestionResult::cached('msg');

    expect($result->promptTokens)->toBeNull();
    expect($result->completionTokens)->toBeNull();
});

it('disabled() leaves promptTokens and completionTokens null', function () {
    $result = AiSuggestionResult::disabled();

    expect($result->promptTokens)->toBeNull();
    expect($result->completionTokens)->toBeNull();
});
