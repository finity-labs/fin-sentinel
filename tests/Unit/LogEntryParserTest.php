<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Services\LogEntryParser;

beforeEach(function () {
    $this->tempDir = sys_get_temp_dir() . '/fin-sentinel-parser-' . uniqid();
    mkdir($this->tempDir, 0755, true);
});

afterEach(function () {
    // Recursively delete temp directory
    if (is_dir($this->tempDir)) {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($this->tempDir, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );
        foreach ($iterator as $file) {
            if ($file->isDir()) {
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }
        rmdir($this->tempDir);
    }
});

it('parses standard log entries', function () {
    file_put_contents($this->tempDir . '/test.log', implode("\n", [
        '[2026-01-15 10:30:00] production.ERROR: Something broke',
        '[2026-01-15 10:31:00] production.INFO: User logged in',
        '[2026-01-15 10:32:00] production.WARNING: Deprecated function called',
    ]));

    $parser = new LogEntryParser($this->tempDir);
    $result = $parser->getEntries('test.log', sortDirection: 'asc');

    expect($result->total())->toBe(3);

    $items = array_values($result->items());
    expect($items[0]['timestamp'])->toBe('2026-01-15 10:30:00');
    expect($items[0]['level'])->toBe('ERROR');
    expect($items[0]['message'])->toBe('Something broke');
});

it('handles multi-line entries with stack traces', function () {
    $logContent = <<<'LOG'
[2026-01-15 10:30:00] production.ERROR: Something broke {"exception":"RuntimeException"}
#0 /app/Http/Controller.php(42): App\Http\Controller->handle()
#1 /vendor/laravel/framework/src/Illuminate/Routing/Router.php(100): dispatch()
[2026-01-15 10:31:00] production.INFO: User logged in
LOG;

    file_put_contents($this->tempDir . '/test.log', $logContent);

    $parser = new LogEntryParser($this->tempDir);
    $result = $parser->getEntries('test.log', sortDirection: 'asc');

    expect($result->total())->toBe(2);

    $items = array_values($result->items());
    expect($items[0]['has_stack_trace'])->toBeTrue();
    expect($items[0]['stack_trace'])->toContain('#0 /app/Http/Controller.php');
    expect($items[1]['has_stack_trace'])->toBeFalse();
});

it('paginates results', function () {
    $lines = [];
    for ($i = 0; $i < 10; $i++) {
        $lines[] = sprintf('[2026-01-15 10:%02d:00] production.INFO: Entry %d', $i, $i);
    }
    file_put_contents($this->tempDir . '/test.log', implode("\n", $lines));

    $parser = new LogEntryParser($this->tempDir);
    $result = $parser->getEntries('test.log', page: 1, perPage: 3);

    expect(count($result->items()))->toBe(3);
    expect($result->total())->toBe(10);
});

it('sorts desc by default', function () {
    file_put_contents($this->tempDir . '/test.log', implode("\n", [
        '[2026-01-15 10:00:00] production.INFO: First entry',
        '[2026-01-15 10:01:00] production.INFO: Second entry',
        '[2026-01-15 10:02:00] production.INFO: Third entry',
    ]));

    $parser = new LogEntryParser($this->tempDir);
    $result = $parser->getEntries('test.log', sortDirection: 'desc');

    $items = array_values($result->items());
    expect($items[0]['timestamp'])->toBe('2026-01-15 10:02:00');
    expect($items[0]['message'])->toBe('Third entry');
});

it('sorts asc when requested', function () {
    file_put_contents($this->tempDir . '/test.log', implode("\n", [
        '[2026-01-15 10:00:00] production.INFO: First entry',
        '[2026-01-15 10:01:00] production.INFO: Second entry',
        '[2026-01-15 10:02:00] production.INFO: Third entry',
    ]));

    $parser = new LogEntryParser($this->tempDir);
    $result = $parser->getEntries('test.log', sortDirection: 'asc');

    $items = array_values($result->items());
    expect($items[0]['timestamp'])->toBe('2026-01-15 10:00:00');
    expect($items[0]['message'])->toBe('First entry');
});

it('filters by level', function () {
    file_put_contents($this->tempDir . '/test.log', implode("\n", [
        '[2026-01-15 10:00:00] production.ERROR: Error one',
        '[2026-01-15 10:01:00] production.INFO: Info entry',
        '[2026-01-15 10:02:00] production.ERROR: Error two',
        '[2026-01-15 10:03:00] production.WARNING: Warning entry',
    ]));

    $parser = new LogEntryParser($this->tempDir);
    $result = $parser->getEntries('test.log', levelFilter: ['ERROR']);

    expect($result->total())->toBe(2);

    $items = array_values($result->items());
    foreach ($items as $item) {
        expect($item['level'])->toBe('ERROR');
    }
});

it('searches by text', function () {
    file_put_contents($this->tempDir . '/test.log', implode("\n", [
        '[2026-01-15 10:00:00] production.INFO: Payment processed successfully',
        '[2026-01-15 10:01:00] production.INFO: User logged in',
        '[2026-01-15 10:02:00] production.ERROR: Payment gateway timeout',
    ]));

    $parser = new LogEntryParser($this->tempDir);
    $result = $parser->getEntries('test.log', search: 'Payment');

    expect($result->total())->toBe(2);

    $items = array_values($result->items());
    foreach ($items as $item) {
        expect(strtolower($item['message']))->toContain('payment');
    }
});

it('returns empty paginator for nonexistent file', function () {
    $parser = new LogEntryParser($this->tempDir);
    $result = $parser->getEntries('nonexistent.log');

    expect($result->total())->toBe(0);
    expect($result->items())->toBeEmpty();
});

it('rejects path traversal attempts', function () {
    $parser = new LogEntryParser($this->tempDir);
    $result = $parser->getEntries('../../../etc/passwd');

    expect($result->total())->toBe(0);
    expect($result->items())->toBeEmpty();
});
