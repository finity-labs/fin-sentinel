<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Mail\ErrorMail;
use FinityLabs\FinSentinel\Settings\ErrorChannelSettings;
use FinityLabs\FinSentinel\Support\Ai\AiProviderLabels;
use FinityLabs\FinSentinel\Support\AiSuggestionResult;
use Illuminate\Support\Facades\App;

dataset('all_locales', function () {
    $dir = __DIR__.'/../../resources/lang';

    return collect(scandir($dir))
        ->reject(fn ($d) => str_starts_with($d, '.'))
        ->filter(fn ($d) => is_dir("{$dir}/{$d}"))
        ->values()
        ->all();
});

function renderLocaleBoth(string $locale, AiSuggestionResult $aiSuggestion): array
{
    App::setLocale($locale);

    $mail = new ErrorMail('test message', new RuntimeException('boom'), $aiSuggestion);
    $html = (string) $mail->render();

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

    try {
        $settings = app(ErrorChannelSettings::class);
        $data['aiProvider'] = AiProviderLabels::pretty($settings->ai_provider);
        $data['aiModel'] = $settings->ai_model ?? '';
    } catch (Throwable) {
        // leave blanks
    }

    $text = view('fin-sentinel::emails.error-text', $data)->render();

    return ['html' => $html, 'text' => $text];
}

it('renders the FAILED prefix and translated timeout reason in the HTML email for each locale', function (string $locale) {
    $rendered = renderLocaleBoth($locale, AiSuggestionResult::failed('timeout'));

    $expectedPrefix = e(__('fin-sentinel::fin-sentinel.email.ai.failed_prefix', [], $locale));
    $expectedReason = e(__('fin-sentinel::fin-sentinel.email.ai.reason.timeout', [], $locale));

    expect($rendered['html'])->toContain("{$expectedPrefix}: {$expectedReason}");
})->with('all_locales');

it('renders the FAILED prefix and translated timeout reason in the text email for each locale', function (string $locale) {
    $rendered = renderLocaleBoth($locale, AiSuggestionResult::failed('timeout'));

    $expectedPrefix = e(__('fin-sentinel::fin-sentinel.email.ai.failed_prefix', [], $locale));
    $expectedReason = e(__('fin-sentinel::fin-sentinel.email.ai.reason.timeout', [], $locale));

    expect($rendered['text'])->toContain("{$expectedPrefix}: {$expectedReason}");
})->with('all_locales');

it('declares the email.ai keys natively (no silent fallback to en) for each locale', function (string $locale) {
    $file = __DIR__."/../../resources/lang/{$locale}/fin-sentinel.php";
    $array = require $file;

    expect($array)
        ->toHaveKey('email.ai.heading')
        ->toHaveKey('email.ai.footnote_prefix')
        ->toHaveKey('email.ai.disclaimer')
        ->toHaveKey('email.ai.cached_badge')
        ->toHaveKey('email.ai.failed_prefix')
        ->toHaveKey('email.ai.skipped_prefix')
        ->toHaveKey('email.ai.reason.timeout')
        ->toHaveKey('email.ai.reason.authentication_failed')
        ->toHaveKey('email.ai.reason.rate_limited')
        ->toHaveKey('email.ai.reason.quota_exceeded')
        ->toHaveKey('email.ai.reason.unknown_error')
        ->toHaveKey('email.ai.reason.output_rejected_matched_injection_marker')
        ->toHaveKey('email.ai.reason.hourly_cap_reached')
        ->toHaveKey('email.ai.reason.circuit_open');
})->with('all_locales');
