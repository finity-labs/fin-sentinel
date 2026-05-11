<?php

declare(strict_types=1);

use Illuminate\Http\Client\StrayRequestException;
use Illuminate\Support\Facades\Http;

it('throws StrayRequestException on unmocked HTTP call', function () {
    expect(fn () => Http::get('https://example.com/should-not-fire'))
        ->toThrow(StrayRequestException::class);
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
        ->toThrow(StrayRequestException::class);
});
