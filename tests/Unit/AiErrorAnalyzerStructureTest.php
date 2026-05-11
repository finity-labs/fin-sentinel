<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Services\Ai\AiErrorAnalyzer;
use FinityLabs\FinSentinel\Support\Ai\AiOutputValidator;
use FinityLabs\FinSentinel\Support\Ai\AiPromptBuilder;
use FinityLabs\FinSentinel\Support\AiSuggestionResult;
use FinityLabs\FinSentinel\Support\ScrubbedErrorPayload;

it('PLUMB-06 invariant: no `use Laravel\\Ai\\…` anywhere in src/', function () {
    $srcPath = realpath(__DIR__.'/../../src');
    expect($srcPath)->toBeString();

    $process = proc_open(
        ['grep', '-rn', '-e', 'use Laravel\\\\Ai', $srcPath],
        [1 => ['pipe', 'w'], 2 => ['pipe', 'w']],
        $pipes,
    );

    expect($process)->not->toBeFalse();

    /** @var array<int, resource> $pipes */
    $stdout = stream_get_contents($pipes[1]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    $exitCode = proc_close($process);

    // grep exit 1 = no match (success). grep exit 0 = match found (PLUMB-06 violation).
    expect($exitCode)->toBe(1, "PLUMB-06 violation found:\n".(string) $stdout);
});

it('AiErrorAnalyzer has all documented private helpers', function () {
    $expected = ['aiCacheKey', 'callSdkResponse', 'mapException', 'isBreakerOpen', 'recordSuccess', 'recordFailure', 'recordTokenUsage', 'extractUsage'];

    foreach ($expected as $method) {
        expect(method_exists(AiErrorAnalyzer::class, $method))
            ->toBeTrue("Expected private method {$method} on AiErrorAnalyzer.");

        $r = new ReflectionMethod(AiErrorAnalyzer::class, $method);
        expect($r->isPrivate())->toBeTrue("Method {$method} must be private.");
    }
});

it('AiErrorAnalyzer has 3 named constants with documented values', function () {
    $r = new ReflectionClass(AiErrorAnalyzer::class);
    $constants = $r->getConstants();

    expect($constants['BREAKER_THRESHOLD'])->toBe(3);
    expect($constants['BREAKER_OPEN_SECONDS'])->toBe(300);
    expect($constants['HOUR_BUCKET_SECONDS'])->toBe(3600);
});

it('AiErrorAnalyzer constructor accepts AiPromptBuilder + AiOutputValidator', function () {
    $r = new ReflectionMethod(AiErrorAnalyzer::class, '__construct');
    $params = $r->getParameters();

    expect($params)->toHaveCount(2);

    $first = $params[0]->getType();
    $second = $params[1]->getType();
    expect($first)->toBeInstanceOf(ReflectionNamedType::class);
    expect($second)->toBeInstanceOf(ReflectionNamedType::class);

    /** @var ReflectionNamedType $first */
    /** @var ReflectionNamedType $second */
    expect($first->getName())->toBe(AiPromptBuilder::class);
    expect($second->getName())->toBe(AiOutputValidator::class);
});

it('AiErrorAnalyzer::analyze accepts ScrubbedErrorPayload and returns AiSuggestionResult', function () {
    $r = new ReflectionMethod(AiErrorAnalyzer::class, 'analyze');
    $params = $r->getParameters();

    expect($params)->toHaveCount(1);

    $paramType = $params[0]->getType();
    $returnType = $r->getReturnType();
    expect($paramType)->toBeInstanceOf(ReflectionNamedType::class);
    expect($returnType)->toBeInstanceOf(ReflectionNamedType::class);

    /** @var ReflectionNamedType $paramType */
    /** @var ReflectionNamedType $returnType */
    expect($paramType->getName())->toBe(ScrubbedErrorPayload::class);
    expect($returnType->getName())->toBe(AiSuggestionResult::class);
});
