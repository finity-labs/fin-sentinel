<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Services\DataScrubber;

beforeEach(function () {
    $this->scrubber = new DataScrubber();
});

it('redacts matching keys in params', function () {
    $result = $this->scrubber->scrubParams([
        'username' => 'john',
        'password' => 'secret123',
        'token' => 'abc-xyz',
    ]);

    expect($result)->toBe([
        'username' => 'john',
        'password' => '[REDACTED]',
        'token' => '[REDACTED]',
    ]);
});

it('scrubs params case-insensitively', function () {
    $result = $this->scrubber->scrubParams([
        'PASSWORD' => 'secret1',
        'Password' => 'secret2',
        'password' => 'secret3',
    ]);

    expect($result['PASSWORD'])->toBe('[REDACTED]');
    expect($result['Password'])->toBe('[REDACTED]');
    expect($result['password'])->toBe('[REDACTED]');
});

it('scrubs params recursively in nested arrays', function () {
    $result = $this->scrubber->scrubParams([
        'user' => [
            'name' => 'john',
            'password' => 'nested-secret',
            'details' => [
                'token' => 'deep-secret',
                'email' => 'john@example.com',
            ],
        ],
    ]);

    expect($result['user']['name'])->toBe('john');
    expect($result['user']['password'])->toBe('[REDACTED]');
    expect($result['user']['details']['token'])->toBe('[REDACTED]');
    expect($result['user']['details']['email'])->toBe('john@example.com');
});

it('leaves non-matching keys untouched', function () {
    $result = $this->scrubber->scrubParams([
        'name' => 'john',
        'email' => 'john@example.com',
    ]);

    expect($result)->toBe([
        'name' => 'john',
        'email' => 'john@example.com',
    ]);
});

it('redacts authorization header', function () {
    $result = $this->scrubber->scrubHeaders([
        'content-type' => 'application/json',
        'authorization' => 'Bearer abc123',
    ]);

    expect($result['content-type'])->toBe('application/json');
    expect($result['authorization'])->toBe('[REDACTED]');
});

it('redacts DB_PASSWORD from env', function () {
    $result = $this->scrubber->scrubEnv([
        'APP_NAME' => 'MyApp',
        'DB_PASSWORD' => 'super-secret',
    ]);

    expect($result['APP_NAME'])->toBe('MyApp');
    expect($result['DB_PASSWORD'])->toBe('[REDACTED]');
});

it('redacts password in trace args', function () {
    $result = $this->scrubber->scrubTraceArgs([
        'password' => 'trace-secret',
        'file' => '/app/index.php',
    ]);

    expect($result['password'])->toBe('[REDACTED]');
    expect($result['file'])->toBe('/app/index.php');
});

it('returns unmodified data when config keys are empty', function () {
    config()->set('fin-sentinel.scrub.params', []);

    $data = ['password' => 'should-stay', 'name' => 'john'];
    $result = $this->scrubber->scrubParams($data);

    expect($result)->toBe($data);
});
