<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Services\LogFileScanner;

beforeEach(function () {
    $this->tempDir = sys_get_temp_dir() . '/fin-sentinel-scanner-' . uniqid();
    mkdir($this->tempDir, 0755, true);

    // Override storage path so scanner reads from temp dir
    app()->useStoragePath($this->tempDir);
    mkdir($this->tempDir . '/logs', 0755, true);

    $this->logsDir = $this->tempDir . '/logs';
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

it('discovers log files', function () {
    file_put_contents($this->logsDir . '/laravel.log', 'test content');
    file_put_contents($this->logsDir . '/worker.log', 'test content');

    $scanner = new LogFileScanner;
    $results = $scanner->scan();

    expect($results)->toHaveCount(2);

    $filenames = $results->pluck('filename')->toArray();
    expect($filenames)->toContain('laravel.log');
    expect($filenames)->toContain('worker.log');
});

it('returns metadata with required keys', function () {
    file_put_contents($this->logsDir . '/laravel.log', 'some log content here');

    $scanner = new LogFileScanner;
    $results = $scanner->scan();

    expect($results)->toHaveCount(1);

    $item = $results->first();
    expect($item)->toHaveKeys(['filename', 'path', 'size', 'size_human', 'last_modified', 'subfolder']);
    expect($item['filename'])->toBe('laravel.log');
    expect($item['size'])->toBeGreaterThan(0);
    expect($item['subfolder'])->toBeNull();
});

it('discovers files in subdirectories with subfolder set', function () {
    mkdir($this->logsDir . '/daily', 0755, true);
    file_put_contents($this->logsDir . '/daily/laravel-2026-01-15.log', 'daily log');

    $scanner = new LogFileScanner;
    $results = $scanner->scan();

    expect($results)->toHaveCount(1);
    expect($results->first()['subfolder'])->toBe('daily');
    expect($results->first()['filename'])->toBe('laravel-2026-01-15.log');
});

it('filters by search term', function () {
    file_put_contents($this->logsDir . '/laravel.log', 'content');
    file_put_contents($this->logsDir . '/worker.log', 'content');

    $scanner = new LogFileScanner;
    $results = $scanner->scan(search: 'worker');

    expect($results)->toHaveCount(1);
    expect($results->first()['filename'])->toBe('worker.log');
});

it('filters by subfolder', function () {
    file_put_contents($this->logsDir . '/laravel.log', 'root log');
    mkdir($this->logsDir . '/daily', 0755, true);
    file_put_contents($this->logsDir . '/daily/laravel-2026-01-15.log', 'daily log');

    $scanner = new LogFileScanner;
    $results = $scanner->scan(filters: ['subfolder' => 'daily']);

    expect($results)->toHaveCount(1);
    expect($results->first()['subfolder'])->toBe('daily');
});

it('skips non-log files', function () {
    file_put_contents($this->logsDir . '/notes.txt', 'not a log');
    file_put_contents($this->logsDir . '/laravel.log', 'a real log');

    $scanner = new LogFileScanner;
    $results = $scanner->scan();

    expect($results)->toHaveCount(1);
    expect($results->first()['filename'])->toBe('laravel.log');
});

it('returns empty collection for missing directory', function () {
    $nonexistent = sys_get_temp_dir() . '/fin-sentinel-nonexistent-' . uniqid();
    app()->useStoragePath($nonexistent);

    $scanner = new LogFileScanner;
    $results = $scanner->scan();

    expect($results)->toBeEmpty();
});

it('sorts by last_modified descending', function () {
    file_put_contents($this->logsDir . '/old.log', 'old content');
    touch($this->logsDir . '/old.log', time() - 3600);

    file_put_contents($this->logsDir . '/new.log', 'new content');
    touch($this->logsDir . '/new.log', time());

    $scanner = new LogFileScanner;
    $results = $scanner->scan();

    expect($results)->toHaveCount(2);
    expect($results->first()['filename'])->toBe('new.log');
    expect($results->last()['filename'])->toBe('old.log');
});
