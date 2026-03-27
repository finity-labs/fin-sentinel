<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class DebugMail extends Mailable
{
    /**
     * @param  array<string, mixed>  $formattedData  Output from DebugFormatter::format()
     * @param  array<string, mixed>  $callSite  ['file' => string, 'line' => int]
     * @param  array<string, mixed>  $requestContext  Request or console context
     * @param  array<string, mixed>  $environmentContext  Environment metadata
     * @param  string|null  $customSubject  Optional custom subject line
     */
    public function __construct(
        public array $formattedData,
        public array $callSite,
        public array $requestContext,
        public array $environmentContext,
        public ?string $customSubject = null,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('fin-sentinel::fin-sentinel.email.debug.subject', [
                'app' => config('app.name', 'Laravel'),
                'subject' => $this->customSubject ?? 'Debug',
            ]),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'fin-sentinel::emails.debug',
            text: 'fin-sentinel::emails.debug-text',
            with: [
                'formattedData' => $this->formattedData,
                'callSite' => $this->callSite,
                'requestContext' => $this->requestContext,
                'environmentContext' => $this->environmentContext,
            ],
        );
    }

    /**
     * Build request context data for debug emails.
     *
     * @return array<string, mixed>
     */
    public static function buildRequestContext(): array
    {
        if (app()->runningInConsole()) {
            return [
                'context' => __('fin-sentinel::fin-sentinel.email.debug.console'),
                'command' => implode(' ', $_SERVER['argv'] ?? []),
            ];
        }

        $user = auth()->check()
            ? auth()->user()->name.' (#'.auth()->user()->getKey().')'
            : __('fin-sentinel::fin-sentinel.email.debug.guest');

        return [
            'url' => request()->fullUrl(),
            'method' => request()->method(),
            'user' => $user,
        ];
    }

    /**
     * Build environment context data for debug emails.
     *
     * @return array<string, mixed>
     */
    public static function buildEnvironmentContext(): array
    {
        return [
            'app_env' => config('app.env'),
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
            'timestamp' => now()->toDateTimeString().' ('.config('app.timezone', 'UTC').')',
        ];
    }
}
