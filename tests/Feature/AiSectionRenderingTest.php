<?php

declare(strict_types=1);

use FinityLabs\FinSentinel\Mail\ErrorMail;
use FinityLabs\FinSentinel\Settings\ErrorChannelSettings;
use FinityLabs\FinSentinel\Support\Ai\AiProviderLabels;
use FinityLabs\FinSentinel\Support\AiSuggestionResult;

function rendersBoth(?AiSuggestionResult $aiSuggestion): array
{
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

    if ($aiSuggestion !== null) {
        try {
            $settings = app(ErrorChannelSettings::class);
            $data['aiProvider'] = AiProviderLabels::pretty($settings->ai_provider);
            $data['aiModel'] = $settings->ai_model ?? '';
        } catch (Throwable) {
            // leave blanks
        }
    }

    $text = view('fin-sentinel::emails.error-text', $data)->render();

    return ['html' => $html, 'text' => $text];
}

describe('SUCCESS state with provider settings seeded', function () {
    beforeEach(function () {
        $settings = app(ErrorChannelSettings::class);
        $settings->ai_provider = 'anthropic';
        $settings->ai_model = 'claude-3-5-sonnet-20240620';
        $settings->save();
    });

    it('renders the heading in the HTML view', function () {
        $r = rendersBoth(AiSuggestionResult::success('My fake suggestion text'));

        expect($r['html'])->toContain('AI Suggestion');
    });

    it('renders the suggestion body in the HTML view', function () {
        $r = rendersBoth(AiSuggestionResult::success('My fake suggestion text'));

        expect($r['html'])->toContain('My fake suggestion text');
    });

    it('renders the disclaimer in the HTML view', function () {
        $r = rendersBoth(AiSuggestionResult::success('body'));

        expect($r['html'])->toContain('AI-generated. Verify before acting.');
    });

    it('renders the footnote with pretty provider name and model in the HTML view', function () {
        $r = rendersBoth(AiSuggestionResult::success('body'));

        expect($r['html'])->toContain('via');
        expect($r['html'])->toContain('Anthropic');
        expect($r['html'])->toContain('claude-3-5-sonnet-20240620');
    });

    it('renders the heading + suggestion + disclaimer in the text view', function () {
        $r = rendersBoth(AiSuggestionResult::success('My fake suggestion text'));

        expect($r['text'])->toContain('AI Suggestion');
        expect($r['text'])->toContain('My fake suggestion text');
        expect($r['text'])->toContain('AI-generated. Verify before acting.');
    });

    it('renders the footnote in the text view', function () {
        $r = rendersBoth(AiSuggestionResult::success('body'));

        expect($r['text'])->toContain('via Anthropic');
        expect($r['text'])->toContain('claude-3-5-sonnet-20240620');
    });
});

describe('SUCCESS state without provider settings', function () {
    it('omits the footnote in the HTML view when provider and model are blank', function () {
        $r = rendersBoth(AiSuggestionResult::success('body without footnote'));

        expect($r['html'])->toContain('body without footnote');
        expect($r['html'])->toContain('AI-generated. Verify before acting.');
        expect($r['html'])->not->toMatch('/>\s*via\s+&mdash;\s*</');
    });

    it('omits the footnote in the text view when provider and model are blank', function () {
        $r = rendersBoth(AiSuggestionResult::success('body without footnote'));

        expect($r['text'])->toContain('body without footnote');
        expect($r['text'])->not->toContain('via --');
    });
});

describe('CACHED state', function () {
    beforeEach(function () {
        $settings = app(ErrorChannelSettings::class);
        $settings->ai_provider = 'anthropic';
        $settings->ai_model = 'claude-3-5-sonnet-20240620';
        $settings->save();
    });

    it('renders the heading + cached badge in the HTML view', function () {
        $r = rendersBoth(AiSuggestionResult::cached('Cached fake suggestion'));

        expect($r['html'])->toContain('AI Suggestion');
        expect($r['html'])->toContain('cached');
    });

    it('renders the cached suggestion body in the HTML view', function () {
        $r = rendersBoth(AiSuggestionResult::cached('Cached fake suggestion'));

        expect($r['html'])->toContain('Cached fake suggestion');
    });

    it('renders the disclaimer for CACHED state in the HTML view', function () {
        $r = rendersBoth(AiSuggestionResult::cached('body'));

        expect($r['html'])->toContain('AI-generated. Verify before acting.');
    });

    it('renders the cached badge bracketed in the text view', function () {
        $r = rendersBoth(AiSuggestionResult::cached('Cached fake suggestion'));

        expect($r['text'])->toContain('AI Suggestion');
        expect($r['text'])->toContain('[cached]');
        expect($r['text'])->toContain('Cached fake suggestion');
    });
});

describe('FAILED state', function () {
    it('renders the failed prefix with colon in the HTML view', function () {
        $r = rendersBoth(AiSuggestionResult::failed('timeout'));

        expect($r['html'])->toContain('AI analysis failed:');
    });

    it('omits the disclaimer for FAILED state in the HTML view', function () {
        $r = rendersBoth(AiSuggestionResult::failed('timeout'));

        expect($r['html'])->not->toContain('AI-generated. Verify before acting.');
    });

    it('renders the translated reason for timeout in the HTML view', function () {
        $r = rendersBoth(AiSuggestionResult::failed('timeout'));

        expect($r['html'])->toMatch('/AI analysis failed:\s*timeout/');
    });

    it('renders the translated reason for output rejected with colon and spaces in the HTML view', function () {
        $r = rendersBoth(AiSuggestionResult::failed('output rejected: matched injection marker'));

        expect($r['html'])->toContain('output rejected: matched injection marker');
    });

    it('renders the failed prefix and reason in the text view', function () {
        $r = rendersBoth(AiSuggestionResult::failed('timeout'));

        expect($r['text'])->toContain('AI analysis failed:');
        expect($r['text'])->toMatch('/AI analysis failed:\s*timeout/');
    });
});

describe('SKIPPED state', function () {
    it('renders the skipped prefix with colon in the HTML view', function () {
        $r = rendersBoth(AiSuggestionResult::skipped('hourly cap reached'));

        expect($r['html'])->toContain('AI analysis skipped:');
    });

    it('renders the translated reason in the HTML view', function () {
        $r = rendersBoth(AiSuggestionResult::skipped('hourly cap reached'));

        expect($r['html'])->toContain('hourly cap reached');
    });

    it('keeps the SKIPPED section visible (does not hide like DISABLED)', function () {
        $r = rendersBoth(AiSuggestionResult::skipped('circuit open'));

        expect($r['html'])->toContain('AI Suggestion');
        expect($r['html'])->toContain('AI analysis skipped:');
        expect($r['html'])->toContain('circuit open');
    });

    it('renders the skipped prefix and reason in the text view', function () {
        $r = rendersBoth(AiSuggestionResult::skipped('hourly cap reached'));

        expect($r['text'])->toContain('AI analysis skipped:');
        expect($r['text'])->toContain('hourly cap reached');
    });
});

describe('DISABLED state', function () {
    it('hides the AI section heading in the HTML view', function () {
        $r = rendersBoth(AiSuggestionResult::disabled());

        expect($r['html'])->not->toContain('AI Suggestion');
    });

    it('hides the failed and skipped prefixes in the HTML view', function () {
        $r = rendersBoth(AiSuggestionResult::disabled());

        expect($r['html'])->not->toContain('AI analysis failed');
        expect($r['html'])->not->toContain('AI analysis skipped');
    });

    it('hides the AI section heading in the text view', function () {
        $r = rendersBoth(AiSuggestionResult::disabled());

        expect($r['text'])->not->toContain('AI Suggestion');
    });
});

describe('null aiSuggestion', function () {
    it('hides the AI section heading in the HTML view', function () {
        $r = rendersBoth(null);

        expect($r['html'])->not->toContain('AI Suggestion');
    });

    it('hides the AI section heading in the text view', function () {
        $r = rendersBoth(null);

        expect($r['text'])->not->toContain('AI Suggestion');
    });
});
