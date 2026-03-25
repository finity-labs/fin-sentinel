<?php

declare(strict_types=1);

namespace FinityLabs\FinSentinel\Mail;

use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class LogFileMail extends Mailable
{
    /** @var array<int, array{path: string, name: string}> */
    private readonly array $files;

    /**
     * @param  string|array<int, array{path: string, name: string}>  $filePath
     */
    public function __construct(
        string|array $filePath,
        private readonly ?string $fileName = null,
    ) {
        if (is_string($filePath)) {
            $this->files = [['path' => $filePath, 'name' => $this->fileName ?? basename($filePath)]];
        } else {
            $this->files = $filePath;
        }
    }

    public function envelope(): Envelope
    {
        $fileNames = array_column($this->files, 'name');

        $subject = count($this->files) === 1
            ? __('fin-sentinel::fin-sentinel.log_email_subject', [
                'app' => config('app.name', 'Laravel'),
                'file' => $fileNames[0],
            ])
            : __('fin-sentinel::fin-sentinel.log_bulk_email_subject', [
                'app' => config('app.name', 'Laravel'),
                'count' => count($this->files),
            ]);

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        $fileNames = array_column($this->files, 'name');

        return new Content(
            view: 'fin-sentinel::emails.log-file',
            text: 'fin-sentinel::emails.log-file-text',
            with: [
                'fileName' => implode(', ', $fileNames),
                'appName' => config('app.name', 'Laravel'),
            ],
        );
    }

    /**
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return array_map(
            fn (array $file) => Attachment::fromPath($file['path'])
                ->as($file['name'])
                ->withMime('text/plain'),
            $this->files,
        );
    }
}
