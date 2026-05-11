<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Mail\ErrorMail;
use FinityLabs\FinSentinel\Support\AiSuggestionResult;
use FinityLabs\FinSentinel\Support\AiSuggestionState;

it('has the correct envelope subject containing app name', function () {
    $mail = new ErrorMail('Test error');
    $envelope = $mail->envelope();

    expect($envelope->subject)->toContain(config('app.name'));
});

it('uses the correct content view', function () {
    $mail = new ErrorMail('Test error');
    $content = $mail->content();

    expect($content->view)->toBe('fin-sentinel::emails.error');
});

it('extracts exception class, file, and line from Throwable', function () {
    $exception = new RuntimeException('test exception');
    $mail = new ErrorMail('test exception', $exception);

    expect($mail->exceptionClass)->toBe(RuntimeException::class);
    expect($mail->exceptionFile)->toBe(__FILE__);
    expect($mail->exceptionLine)->toBeInt();
    expect($mail->stackTrace)->toBeArray()->not->toBeEmpty();
});

it('handles null exception gracefully', function () {
    $mail = new ErrorMail('plain error message');

    expect($mail->exceptionClass)->toBeNull();
    expect($mail->exceptionFile)->toBeNull();
    expect($mail->exceptionLine)->toBeNull();
    expect($mail->stackTrace)->toBeNull();
});

it('includes expected keys in environmentContext', function () {
    $mail = new ErrorMail('Test error');

    expect($mail->environmentContext)->toHaveKeys([
        'app_env',
        'app_debug',
        'php_version',
        'laravel_version',
        'memory_peak',
        'timestamp',
    ]);

    expect($mail->environmentContext['php_version'])->toBe(PHP_VERSION);
});

it('defaults aiSuggestion to null when not provided', function () {
    $mail = new ErrorMail('msg');

    expect($mail->aiSuggestion)->toBeNull();
});

it('stores the explicit aiSuggestion when provided', function () {
    $mail = new ErrorMail('msg', new RuntimeException('x'), AiSuggestionResult::success('body'));

    expect($mail->aiSuggestion)->not->toBeNull();
    expect($mail->aiSuggestion->state)->toBe(AiSuggestionState::SUCCESS);
    expect($mail->aiSuggestion->suggestion)->toBe('body');
});

it('renders the HTML view without AI markers when aiSuggestion is null', function () {
    $rendered = (new ErrorMail('msg'))->render();

    expect($rendered)->not->toContain('AI Suggestion');
    expect($rendered)->not->toContain('would appear here');
});

it('renders the HTML view without AI markers when aiSuggestion is DISABLED', function () {
    $rendered = (new ErrorMail('msg', null, AiSuggestionResult::disabled()))->render();

    expect($rendered)->not->toContain('AI Suggestion');
});

it('renders the HTML view with the suggestion body when aiSuggestion is SUCCESS', function () {
    $rendered = (new ErrorMail('msg', new RuntimeException('x'), AiSuggestionResult::success('body')))->render();

    expect($rendered)->toContain('AI Suggestion');
    expect($rendered)->toContain('body');
});

it('renders the FAILED prefix in the HTML view', function () {
    $rendered = (new ErrorMail('msg', new RuntimeException('x'), AiSuggestionResult::failed('timeout')))->render();

    expect($rendered)->toContain('AI analysis failed:');
    expect($rendered)->toContain('timeout');
});

it('renders the text view with parity for null and SUCCESS aiSuggestion', function () {
    $mail = new ErrorMail('msg');
    $data = [
        'errorMessage' => $mail->errorMessage,
        'exceptionClass' => $mail->exceptionClass,
        'exceptionFile' => $mail->exceptionFile,
        'exceptionLine' => $mail->exceptionLine,
        'stackTrace' => $mail->stackTrace,
        'requestContext' => $mail->requestContext,
        'userContext' => $mail->userContext,
        'environmentContext' => $mail->environmentContext,
        'aiSuggestion' => $mail->aiSuggestion,
        'aiProvider' => '',
        'aiModel' => '',
    ];

    $textNull = view('fin-sentinel::emails.error-text', $data)->render();
    expect($textNull)->not->toContain('AI Suggestion');

    $data['aiSuggestion'] = AiSuggestionResult::success('body');
    $textSuccess = view('fin-sentinel::emails.error-text', $data)->render();
    expect($textSuccess)->toContain('AI Suggestion');
    expect($textSuccess)->toContain('body');
});
