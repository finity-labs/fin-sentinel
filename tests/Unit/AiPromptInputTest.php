<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Support\Ai\AiPromptInput;

it('exposes the user prompt via the public string property', function () {
    $input = new AiPromptInput(user: 'hello');

    expect($input->user)->toBe('hello');
});

it('is a final readonly value object with a single public string $user property', function () {
    $reflection = new ReflectionClass(AiPromptInput::class);

    expect($reflection->isFinal())->toBeTrue();
    expect($reflection->isReadOnly())->toBeTrue();

    $property = $reflection->getProperty('user');

    expect($property->isPublic())->toBeTrue();
    expect($property->isReadOnly())->toBeTrue();
    expect((string) $property->getType())->toBe('string');
});
