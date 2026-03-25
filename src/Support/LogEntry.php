<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Support;

use FinityLabs\FinSentinel\Enums\LogLevel;

final readonly class LogEntry
{
    public function __construct(
        public string $timestamp,
        public string $environment,
        public LogLevel $level,
        public string $message,
        public ?string $stackTrace,
        public int $startLine,
    ) {}

    /**
     * Return the first N lines of the message.
     */
    public function preview(int $lines = 3): string
    {
        $allLines = explode("\n", $this->message);

        return implode("\n", array_slice($allLines, 0, $lines));
    }

    public function hasStackTrace(): bool
    {
        return $this->stackTrace !== null && $this->stackTrace !== '';
    }

    /**
     * Full entry text for search matching.
     */
    public function fullText(): string
    {
        $text = $this->message;

        if ($this->hasStackTrace()) {
            $text .= "\n" . $this->stackTrace;
        }

        return $text;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'timestamp' => $this->timestamp,
            'environment' => $this->environment,
            'level' => $this->level->value,
            'level_color' => $this->level->getColor(),
            'level_icon' => $this->level->getIcon(),
            'message' => $this->message,
            'stack_trace' => $this->stackTrace,
            'preview' => $this->preview(),
            'has_stack_trace' => $this->hasStackTrace(),
            'start_line' => $this->startLine,
        ];
    }
}
