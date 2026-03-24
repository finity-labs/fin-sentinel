<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Mail;

use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class LogFileMail extends Mailable
{
    public function __construct(
        private readonly string $filePath,
        private readonly string $fileName,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('fin-sentinel::fin-sentinel.log_email_subject', [
                'app' => config('app.name', 'Laravel'),
                'file' => $this->fileName,
            ]),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'fin-sentinel::emails.log-file',
            text: 'fin-sentinel::emails.log-file-text',
            with: [
                'fileName' => $this->fileName,
                'appName' => config('app.name', 'Laravel'),
            ],
        );
    }

    /**
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->filePath)
                ->as($this->fileName)
                ->withMime('text/plain'),
        ];
    }
}
