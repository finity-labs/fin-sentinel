<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Mail;

use FinityLabs\FinSentinel\Services\DataScrubber;
use FinityLabs\FinSentinel\Settings\ErrorChannelSettings;
use FinityLabs\FinSentinel\Support\Ai\AiProviderLabels;
use FinityLabs\FinSentinel\Support\AiSuggestionResult;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ErrorMail extends Mailable
{
    public string $errorMessage;

    public ?string $exceptionClass;

    public ?string $exceptionFile;

    public ?int $exceptionLine;

    public ?array $stackTrace;

    public array $requestContext;

    public array $userContext;

    public array $environmentContext;

    public ?AiSuggestionResult $aiSuggestion;

    public function __construct(
        string $errorMessage,
        ?\Throwable $exception = null,
        ?AiSuggestionResult $aiSuggestion = null,
    ) {
        $scrubber = app(DataScrubber::class);

        $this->errorMessage = $errorMessage;
        $this->exceptionClass = $exception ? $exception::class : null;
        $this->exceptionFile = $exception?->getFile();
        $this->exceptionLine = $exception?->getLine();
        $this->stackTrace = $exception ? $this->processStackTrace($exception, $scrubber) : null;
        $this->requestContext = $this->buildRequestContext($scrubber);
        $this->userContext = $this->buildUserContext();
        $this->environmentContext = $this->buildEnvironmentContext();
        $this->aiSuggestion = $aiSuggestion;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('fin-sentinel::fin-sentinel.email.error.subject', ['app' => config('app.name', 'Laravel')]),
        );
    }

    public function content(): Content
    {
        $aiProvider = '';
        $aiModel = '';

        if ($this->aiSuggestion !== null) {
            try {
                $settings = app(ErrorChannelSettings::class);
                $aiProvider = AiProviderLabels::pretty($settings->ai_provider);
                $aiModel = $settings->ai_model ?? '';
            } catch (\Throwable) {
                // Settings unavailable; footnote falls back to blanks.
            }
        }

        return new Content(
            view: 'fin-sentinel::emails.error',
            text: 'fin-sentinel::emails.error-text',
            with: [
                'errorMessage' => $this->errorMessage,
                'exceptionClass' => $this->exceptionClass,
                'exceptionFile' => $this->exceptionFile,
                'exceptionLine' => $this->exceptionLine,
                'stackTrace' => $this->stackTrace,
                'requestContext' => $this->requestContext,
                'userContext' => $this->userContext,
                'environmentContext' => $this->environmentContext,
                'aiSuggestion' => $this->aiSuggestion,
                'aiProvider' => $aiProvider,
                'aiModel' => $aiModel,
            ],
        );
    }

    /**
     * Process the exception stack trace, scrubbing sensitive argument data.
     *
     * @return array<int, array<string, mixed>>
     */
    private function processStackTrace(\Throwable $exception, DataScrubber $scrubber): array
    {
        $frames = [];

        foreach ($exception->getTrace() as $frame) {
            $frames[] = [
                'file' => $frame['file'] ?? null,
                'line' => $frame['line'] ?? null,
                'class' => $frame['class'] ?? null,
                'function' => $frame['function'] ?? null,
                'args' => $scrubber->scrubTraceArgs($frame['args'] ?? []),
            ];
        }

        return $frames;
    }

    /**
     * Build request context data with sensitive parameters scrubbed.
     *
     * @return array<string, mixed>
     */
    private function buildRequestContext(DataScrubber $scrubber): array
    {
        if (app()->runningInConsole()) {
            return [
                'context' => __('fin-sentinel::fin-sentinel.email.error.console'),
                'command' => implode(' ', $_SERVER['argv'] ?? []),
            ];
        }

        $headers = collect(request()->headers->all())
            ->map(fn (array $values): string => implode(', ', $values))
            ->all();

        return [
            'url' => request()->fullUrl(),
            'method' => request()->method(),
            'ip' => request()->ip(),
            'params' => $scrubber->scrubParams(request()->all()),
            'headers' => $scrubber->scrubHeaders($headers),
        ];
    }

    /**
     * Build authenticated user context.
     *
     * @return array<string, mixed>
     */
    private function buildUserContext(): array
    {
        if (auth()->check()) {
            return [
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'id' => auth()->user()->getKey(),
            ];
        }

        return [
            'name' => __('fin-sentinel::fin-sentinel.email.error.guest'),
        ];
    }

    /**
     * Build environment context data.
     *
     * @return array<string, mixed>
     */
    private function buildEnvironmentContext(): array
    {
        return [
            'app_env' => config('app.env'),
            'app_debug' => config('app.debug'),
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
            'memory_peak' => round(memory_get_peak_usage(true) / 1024 / 1024, 2).' MB',
            'timestamp' => now()->toDateTimeString().' ('.config('app.timezone', 'UTC').')',
        ];
    }
}
