<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;

/*
 * Laravel 11.28 throws a bare RuntimeException for a stray request; later
 * releases throw StrayRequestException, which extends it. Asserting the
 * parent class and the message covers every supported version.
 */

it('throws on an unmocked HTTP call', function () {
    expect(fn () => Http::get('https://example.com/should-not-fire'))
        ->toThrow(RuntimeException::class, 'without a matching fake');
});

it('allows specifically faked URLs through the per-test override', function () {
    Http::fake([
        'https://example.com/*' => Http::response(['ok' => true], 200),
    ]);

    $response = Http::get('https://example.com/api');

    expect($response->successful())->toBeTrue()
        ->and($response->json('ok'))->toBeTrue();
});

it('re-applies the global gate between tests (per-test override does not bleed)', function () {
    expect(fn () => Http::get('https://other.test/abc'))
        ->toThrow(RuntimeException::class, 'without a matching fake');
});
