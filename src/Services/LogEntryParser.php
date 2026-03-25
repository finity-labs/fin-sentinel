<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Services;

use FinityLabs\FinSentinel\Enums\LogLevel;
use FinityLabs\FinSentinel\Support\LogEntry;
use Illuminate\Pagination\LengthAwarePaginator;
use SplFileObject;

class LogEntryParser
{
    private const ENTRY_PATTERN = '/^\[(\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2})\]\s(\w+)\.(\w+):\s(.*)/s';

    public function __construct(
        private readonly string $logsPath,
    ) {}

    /**
     * Parse log entries from a file with pagination, filtering, and search.
     *
     * @param  string[]  $levelFilter
     */
    public function getEntries(
        string $relativePath,
        int $page = 1,
        int $perPage = 50,
        string $sortDirection = 'desc',
        array $levelFilter = [],
        ?string $search = null,
    ): LengthAwarePaginator {
        $fullPath = $this->resolveAndValidatePath($relativePath);

        if ($fullPath === null) {
            return new LengthAwarePaginator([], 0, $perPage, $page);
        }

        $file = new SplFileObject($fullPath, 'r');
        $ascIndex = $this->buildEntryIndex($file);

        if (empty($ascIndex)) {
            return new LengthAwarePaginator([], 0, $perPage, $page);
        }

        // Build a map from start line -> next start line (ascending order) for boundary detection
        $boundaryMap = $this->buildBoundaryMap($ascIndex);

        $displayIndex = $sortDirection === 'desc' ? array_reverse($ascIndex) : $ascIndex;

        // When filters are active, we need to parse all entries to get correct total count
        $hasFilters = ! empty($levelFilter) || ($search !== null && $search !== '');

        if ($hasFilters) {
            return $this->getFilteredEntries($file, $displayIndex, $boundaryMap, $page, $perPage, $levelFilter, $search);
        }

        // No filters: we can paginate directly from the index
        $total = count($displayIndex);
        $offset = ($page - 1) * $perPage;
        $pageIndex = array_slice($displayIndex, $offset, $perPage);

        $entries = [];
        foreach ($pageIndex as $startLine) {
            $entry = $this->parseEntryAt($file, $startLine, $boundaryMap[$startLine] ?? null);

            if ($entry !== null) {
                $entries[$startLine] = $entry->toArray();
            }
        }

        return new LengthAwarePaginator($entries, $total, $perPage, $page);
    }

    /**
     * Build an index of line numbers where log entries start.
     *
     * @return int[]
     */
    private function buildEntryIndex(SplFileObject $file): array
    {
        $index = [];

        $file->rewind();

        while (! $file->eof()) {
            $lineNumber = $file->key();
            $line = $file->current();

            if (is_string($line) && preg_match(self::ENTRY_PATTERN, $line)) {
                $index[] = $lineNumber;
            }

            $file->next();
        }

        return $index;
    }

    private function parseEntryAt(SplFileObject $file, int $startLine, ?int $nextStartLine): ?LogEntry
    {
        $file->seek($startLine);
        $firstLine = $file->current();

        if (! is_string($firstLine) || ! preg_match(self::ENTRY_PATTERN, trim($firstLine), $matches)) {
            return null;
        }

        $timestamp = $matches[1];
        $environment = $matches[2];
        $levelString = strtoupper($matches[3]);
        $messageLine = $matches[4];

        $level = LogLevel::tryFrom($levelString);

        if ($level === null) {
            return null;
        }

        // Read remaining lines of this entry
        $bodyLines = [];
        $file->next();

        while (! $file->eof()) {
            if ($nextStartLine !== null && $file->key() >= $nextStartLine) {
                break;
            }

            $line = $file->current();

            if (is_string($line)) {
                $bodyLines[] = rtrim($line, "\r\n");
            }

            $file->next();
        }

        $message = trim($messageLine);
        $stackTrace = null;

        if (! empty($bodyLines)) {
            $body = implode("\n", $bodyLines);
            $trimmedBody = trim($body);

            if ($trimmedBody !== '') {
                $stackTrace = $trimmedBody;
            }
        }

        return new LogEntry(
            timestamp: $timestamp,
            environment: $environment,
            level: $level,
            message: $message,
            stackTrace: $stackTrace,
            startLine: $startLine,
        );
    }

    /**
     * Build a map from each entry's start line to the next entry's start line (ascending order).
     *
     * @param  int[]  $ascIndex
     * @return array<int, int|null>
     */
    private function buildBoundaryMap(array $ascIndex): array
    {
        $map = [];
        $count = count($ascIndex);

        for ($i = 0; $i < $count; $i++) {
            $map[$ascIndex[$i]] = ($i + 1 < $count) ? $ascIndex[$i + 1] : null;
        }

        return $map;
    }

    /**
     * Handle filtered/searched entries -- must scan all to get correct totals.
     *
     * @param  int[]  $displayIndex
     * @param  array<int, int|null>  $boundaryMap
     * @param  string[]  $levelFilter
     */
    private function getFilteredEntries(
        SplFileObject $file,
        array $displayIndex,
        array $boundaryMap,
        int $page,
        int $perPage,
        array $levelFilter,
        ?string $search,
    ): LengthAwarePaginator {
        $matchingEntries = [];

        foreach ($displayIndex as $startLine) {
            $entry = $this->parseEntryAt($file, $startLine, $boundaryMap[$startLine] ?? null);

            if ($entry === null) {
                continue;
            }

            // Level filter
            if (! empty($levelFilter) && ! in_array($entry->level->value, $levelFilter, true)) {
                continue;
            }

            // Text search
            if ($search !== null && $search !== '' && mb_stripos($entry->fullText(), $search) === false) {
                continue;
            }

            $matchingEntries[$startLine] = $entry->toArray();
        }

        $total = count($matchingEntries);
        $offset = ($page - 1) * $perPage;
        $pageItems = array_slice($matchingEntries, $offset, $perPage, true);

        return new LengthAwarePaginator($pageItems, $total, $perPage, $page);
    }

    private function resolveAndValidatePath(string $relativePath): ?string
    {
        $fullPath = $this->logsPath . DIRECTORY_SEPARATOR . $relativePath;
        $realPath = realpath($fullPath);

        if ($realPath === false) {
            return null;
        }

        $realLogsPath = realpath($this->logsPath);

        if ($realLogsPath === false || ! str_starts_with($realPath, $realLogsPath)) {
            return null;
        }

        return $realPath;
    }
}
