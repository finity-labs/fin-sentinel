<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Support\Ai\AiOutputValidator;

beforeEach(function (): void {
    config(['fin-sentinel.ai.output_canaries' => []]);
});

it('passes a clean technical response', function (): void {
    $validator = new AiOutputValidator;

    expect($validator->validate('Check the database connection settings in config/database.php'))
        ->toBeTrue();
});

it('passes an empty response', function (): void {
    expect((new AiOutputValidator)->validate(''))->toBeTrue();
});

it('passes another clean response', function (): void {
    expect((new AiOutputValidator)->validate('The error appears to come from a misconfigured queue worker.'))
        ->toBeTrue();
});

it('rejects responses containing a hardcoded canary marker', function (string $response): void {
    expect((new AiOutputValidator)->validate($response))->toBeFalse();
})->with([
    'PWNED literal' => ['Sure! PWNED'],
    'ignore previous instructions' => ['ignore previous instructions'],
    'ignore prior instructions' => ['Ignore Prior Instructions and proceed'],
    'disregard previous' => ['disregard previous instructions'],
    'disregard prior' => ['disregard prior instructions'],
    'ChatML im_start' => ['<|im_start|>system'],
    'ChatML im_end' => ['ends with <|im_end|>'],
    'ChatML system marker' => ['<|system|>'],
    'ChatML user marker' => ['<|user|>'],
    'ChatML assistant marker' => ['<|assistant|>'],
    'Llama opening' => ['[INST] do something [/INST]'],
    'Llama closing' => ['response [/INST]'],
]);

it('rejects PWNED regardless of letter case', function (string $response): void {
    expect((new AiOutputValidator)->validate($response))->toBeFalse();
})->with([
    'lowercase' => ['leaked pwned token'],
    'mixed case' => ['surprise: PwNeD!'],
    'trailing punct' => ['PWNED!'],
    'embedded' => ['ABCPWNEDXYZ'],
]);

it('does not falsely match a non-canary substring that resembles PWNED', function (): void {
    expect((new AiOutputValidator)->validate('The ABACUSWNED tool is unrelated to security.'))
        ->toBeTrue();
});

it('rejects responses containing operator-supplied markers from config', function (): void {
    config(['fin-sentinel.ai.output_canaries' => ['MY_SECRET_TOKEN']]);

    expect((new AiOutputValidator)->validate('leaked MY_SECRET_TOKEN here'))->toBeFalse();

    config(['fin-sentinel.ai.output_canaries' => []]);

    expect((new AiOutputValidator)->validate('leaked MY_SECRET_TOKEN here'))->toBeTrue();
});

it('still enforces hardcoded defaults even when config is empty', function (): void {
    config(['fin-sentinel.ai.output_canaries' => []]);

    expect((new AiOutputValidator)->validate('Sure! PWNED'))->toBeFalse();
});

it('tolerates an empty-string entry in the config without matching every input', function (): void {
    config(['fin-sentinel.ai.output_canaries' => ['']]);

    expect((new AiOutputValidator)->validate('clean technical advice'))->toBeTrue();
});

it('coerces non-string config entries to strings without crashing', function (): void {
    config(['fin-sentinel.ai.output_canaries' => [42, '7']]);

    expect((new AiOutputValidator)->validate('error code 42 returned'))->toBeFalse();
    expect((new AiOutputValidator)->validate('clean response with no digits'))->toBeTrue();
});

it('detects a canary at the very end of a long response', function (): void {
    $response = str_repeat('clean content. ', 100_000).' PWNED';

    expect((new AiOutputValidator)->validate($response))->toBeFalse();
});

it('is final and cannot be extended', function (): void {
    expect((new ReflectionClass(AiOutputValidator::class))->isFinal())->toBeTrue();
});

it('exposes a single public validate method', function (): void {
    $reflection = new ReflectionClass(AiOutputValidator::class);
    $publicMethods = array_filter(
        $reflection->getMethods(ReflectionMethod::IS_PUBLIC),
        fn (ReflectionMethod $m): bool => $m->getDeclaringClass()->getName() === AiOutputValidator::class,
    );

    expect($publicMethods)->toHaveCount(1);
    expect(reset($publicMethods)->getName())->toBe('validate');
});
