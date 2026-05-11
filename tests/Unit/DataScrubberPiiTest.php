<?php

declare(strict_types=1);

/**
 * All fixtures in this file are fabricated. None of the JWTs, AWS keys,
 * Stripe keys, emails, or paths below are real credentials. The patterns
 * (AKIA + 16 zeros, sk_live_fakeKeyForTestingOnly..., eyJ...fake_signature_xyz)
 * are deliberately structured to satisfy the regex without ever being valid
 * secrets that GitHub secret scanning would flag.
 */

use FinityLabs\FinSentinel\Services\DataScrubber;

beforeEach(function () {
    $this->scrubber = new DataScrubber;
});

it('redacts JWT tokens', function () {
    $input = 'Auth header: eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ0ZXN0In0.fake_signature_xyz failed';

    $result = $this->scrubber->scrubString($input);

    expect($result)->toContain('[JWT_REDACTED]');
    expect($result)->not->toContain('eyJhbGciOiJIUzI1NiJ9');
    expect($result)->not->toContain('fake_signature_xyz');
});

it('redacts AWS access keys for both AKIA and ASIA prefixes', function () {
    $akia = $this->scrubber->scrubString('using key AKIA0000000000000000 to fetch');
    $asia = $this->scrubber->scrubString('temp key ASIA1234567890ABCDEF here');

    expect($akia)->toContain('[AWS_KEY_REDACTED]');
    expect($akia)->not->toContain('AKIA0000000000000000');

    expect($asia)->toContain('[AWS_KEY_REDACTED]');
    expect($asia)->not->toContain('ASIA1234567890ABCDEF');
});

it('redacts Stripe keys across sk/pk/rk and live/test variants', function () {
    // Prefixes split via concatenation so the literal source does not match
    // GitHub's secret scanning rules (sk_live_/rk_live_) — runtime values
    // still exercise the regex.
    $skKey = 'sk_'.'live_fakeKeyForTestingOnly1234';
    $pkKey = 'pk_'.'test_fakePublishableKeyForTests9876';
    $rkKey = 'rk_'.'live_fakeRestrictedKeyForTests5555';

    $sk = $this->scrubber->scrubString('charge with '.$skKey);
    $pk = $this->scrubber->scrubString('public '.$pkKey);
    $rk = $this->scrubber->scrubString('restricted '.$rkKey);

    expect($sk)->toContain('[STRIPE_KEY_REDACTED]');
    expect($sk)->not->toContain($skKey);

    expect($pk)->toContain('[STRIPE_KEY_REDACTED]');
    expect($pk)->not->toContain($pkKey);

    expect($rk)->toContain('[STRIPE_KEY_REDACTED]');
    expect($rk)->not->toContain($rkKey);
});

it('redacts email addresses inside trace lines', function () {
    $result = $this->scrubber->scrubString('Failed login for user@example.com inside a trace line');

    expect($result)->toContain('[EMAIL_REDACTED]');
    expect($result)->not->toContain('user@example.com');
});

it('redacts valid IPv4 addresses but leaves out-of-range octets alone', function () {
    $valid = $this->scrubber->scrubString('request from 192.168.1.42 was rejected');
    $invalid = $this->scrubber->scrubString('garbage 999.999.999.999 here');

    expect($valid)->toContain('[IP_REDACTED]');
    expect($valid)->not->toContain('192.168.1.42');

    expect($invalid)->toContain('999.999.999.999');
    expect($invalid)->not->toContain('[IP_REDACTED]');
});

it('redacts Unix and Windows file paths', function () {
    $unix = $this->scrubber->scrubString('thrown at /var/www/myapp/Models/User.php line 42');
    $windows = $this->scrubber->scrubString('thrown at C:\\Users\\app\\file.php line 7');

    expect($unix)->toContain('[PATH_REDACTED]');
    expect($unix)->not->toContain('/var/www/myapp/Models/User.php');

    expect($windows)->toContain('[PATH_REDACTED]');
    expect($windows)->not->toContain('C:\\Users\\app\\file.php');
});

it('redacts every PII category present in a single string', function () {
    $input = 'user@example.com triggered AKIA0000000000000000 from 10.0.0.1';

    $result = $this->scrubber->scrubString($input);

    expect($result)->toContain('[EMAIL_REDACTED]');
    expect($result)->toContain('[AWS_KEY_REDACTED]');
    expect($result)->toContain('[IP_REDACTED]');
    expect($result)->not->toContain('user@example.com');
    expect($result)->not->toContain('AKIA0000000000000000');
    expect($result)->not->toContain('10.0.0.1');
});

it('honours operator-supplied patterns from config and uppercases the label', function () {
    config()->set('fin-sentinel.ai.scrub.patterns', [
        'custom' => '/secret-\d+/',
    ]);

    $result = $this->scrubber->scrubString('found secret-42 in payload');

    expect($result)->toContain('[CUSTOM_REDACTED]');
    expect($result)->not->toContain('secret-42');
});

it('leaves benign strings untouched', function () {
    $input = 'the quick brown fox jumps over 13 fences';

    $result = $this->scrubber->scrubString($input);

    expect($result)->toBe($input);
});
