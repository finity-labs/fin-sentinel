<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Services;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Number;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

class LogFileScanner
{
    /**
     * Scan the logs directory for .log files and return metadata.
     *
     * @param  array<string, mixed>  $filters
     * @return Collection<int, array<string, mixed>>
     */
    public function scan(?string $search = null, array $filters = []): Collection
    {
        $logsPath = $this->getLogsPath();

        if (! is_dir($logsPath)) {
            return collect();
        }

        $files = collect();

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($logsPath, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        /** @var SplFileInfo $file */
        foreach ($iterator as $file) {
            if ($file->getExtension() !== 'log') {
                continue;
            }

            $realPath = $file->getRealPath();

            if ($realPath === false || ! $this->validatePath($realPath)) {
                continue;
            }

            if ($file->isLink()) {
                continue;
            }

            $relativePath = ltrim(str_replace($logsPath, '', $realPath), DIRECTORY_SEPARATOR);
            $subfolder = dirname($relativePath);
            $subfolder = $subfolder === '.' ? null : $subfolder;

            $files->push([
                'filename' => $file->getBasename(),
                'path' => $relativePath,
                'size' => $file->getSize(),
                'size_human' => Number::fileSize($file->getSize()),
                'last_modified' => Carbon::createFromTimestamp($file->getMTime()),
                'subfolder' => $subfolder,
            ]);
        }

        if ($search !== null && $search !== '') {
            $files = $files->filter(
                fn (array $file): bool => mb_stripos($file['filename'], $search) !== false
            );
        }

        if (isset($filters['subfolder'])) {
            $files = $files->filter(
                fn (array $file): bool => $file['subfolder'] === $filters['subfolder']
            );
        }

        return $files->sortByDesc('last_modified')->values();
    }

    private function getLogsPath(): string
    {
        return storage_path('logs');
    }

    private function validatePath(string $path): bool
    {
        $realPath = realpath($path);
        $logsPath = realpath($this->getLogsPath());

        if ($realPath === false || $logsPath === false) {
            return false;
        }

        return str_starts_with($realPath, $logsPath);
    }
}
