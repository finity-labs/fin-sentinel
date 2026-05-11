<?php

declare(strict_types=1);

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use FinityLabs\FinSentinel\Clusters\FinSentinelSettings\Pages\ManageErrorChannelSettings;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Cache;

beforeEach(function () {
    app()->forgetInstance('fin-sentinel.ai-available');
    app()->forgetInstance('fin-sentinel.manager');
    app()->instance('fin-sentinel.ai-available', true);

    Cache::forget('fin-sentinel:ai:tokens:last');
    Cache::forget('fin-sentinel:ai:tokens:'.now()->format('Y-m'));
});

afterEach(function () {
    Cache::forget('fin-sentinel:ai:tokens:last');
    Cache::forget('fin-sentinel:ai:tokens:'.now()->format('Y-m'));
});

function tokenBuildSchema(ManageErrorChannelSettings $page): Schema
{
    return $page->form(Schema::make($page)->statePath('data'));
}

/**
 * @return array<int, mixed>
 */
function tokenFlattenSchema(Schema $schema): array
{
    $out = [];
    $walk = function ($comp) use (&$walk, &$out): void {
        $out[] = $comp;
        if (method_exists($comp, 'getChildSchema')) {
            $childSchema = $comp->getChildSchema();
            if ($childSchema !== null) {
                foreach ($childSchema->getComponents(withHidden: true) as $child) {
                    $walk($child);
                }
            }
        }
    };
    foreach ($schema->getComponents(withHidden: true) as $c) {
        $walk($c);
    }

    return $out;
}

function tokenFindTextEntry(Schema $schema, string $name): ?TextEntry
{
    foreach (tokenFlattenSchema($schema) as $comp) {
        if ($comp instanceof TextEntry
            && method_exists($comp, 'getName')
            && $comp->getName() === $name
        ) {
            return $comp;
        }
    }

    return null;
}

function tokenFindSection(Schema $schema, string $heading): ?Section
{
    foreach (tokenFlattenSchema($schema) as $comp) {
        if ($comp instanceof Section && $comp->getHeading() === $heading) {
            return $comp;
        }
    }

    return null;
}

function tokenTextEntryState(TextEntry $entry): string
{
    $state = $entry->getState();

    if (is_string($state)) {
        return $state;
    }

    if ($state instanceof Htmlable) {
        return $state->toHtml();
    }

    return (string) $state;
}

it('shows em-dash for both rows when caches are empty', function () {
    $page = new ManageErrorChannelSettings;
    $schema = tokenBuildSchema($page);

    $last = tokenFindTextEntry($schema, 'ai_usage_last_call');
    $month = tokenFindTextEntry($schema, 'ai_usage_month');

    expect($last)->not->toBeNull();
    expect($month)->not->toBeNull();
    expect(tokenTextEntryState($last))->toBe('—');
    expect(tokenTextEntryState($month))->toBe('—');
});

it('formats last-call snapshot with thousand separators and state badge', function () {
    Cache::put('fin-sentinel:ai:tokens:last', json_encode([
        'prompt' => 1234,
        'completion' => 567,
        'state' => 'success',
        'model' => 'claude-haiku-4-5',
        'timestamp' => time(),
    ]), 30 * 86400);

    $page = new ManageErrorChannelSettings;
    $last = tokenFindTextEntry(tokenBuildSchema($page), 'ai_usage_last_call');

    expect($last)->not->toBeNull();
    expect(tokenTextEntryState($last))
        ->toBe('1,234 prompt + 567 completion = 1,801 tokens [success]');
});

it('formats monthly cumulative with thousand separators and tokens suffix', function () {
    $monthKey = 'fin-sentinel:ai:tokens:'.now()->format('Y-m');
    Cache::add($monthKey, 0, 62 * 86400);
    Cache::increment($monthKey, 12345);

    $page = new ManageErrorChannelSettings;
    $month = tokenFindTextEntry(tokenBuildSchema($page), 'ai_usage_month');

    expect($month)->not->toBeNull();
    expect(tokenTextEntryState($month))->toBe('12,345 tokens');
});

it('renders cached snapshot with [cached] badge and zero tokens', function () {
    Cache::put('fin-sentinel:ai:tokens:last', json_encode([
        'prompt' => 0,
        'completion' => 0,
        'state' => 'cached',
        'model' => 'claude-haiku-4-5',
        'timestamp' => time(),
    ]), 30 * 86400);

    $page = new ManageErrorChannelSettings;
    $last = tokenFindTextEntry(tokenBuildSchema($page), 'ai_usage_last_call');

    expect($last)->not->toBeNull();
    expect(tokenTextEntryState($last))
        ->toBe('0 prompt + 0 completion = 0 tokens [cached]');
});

it('places the Usage Section as the last block of the AI Section', function () {
    $page = new ManageErrorChannelSettings;
    $schema = tokenBuildSchema($page);

    $aiSection = tokenFindSection($schema, 'AI Analysis');
    expect($aiSection)->not->toBeNull();

    $children = $aiSection->getChildSchema()->getComponents(withHidden: true);
    $last = end($children);

    expect($last)->toBeInstanceOf(Section::class);
    expect($last->getHeading())->toBe('Usage');
});

it('hides the entire AI Section (including Usage) when SDK is unavailable', function () {
    app()->instance('fin-sentinel.ai-available', false);
    app()->forgetInstance('fin-sentinel.manager');

    $page = new ManageErrorChannelSettings;
    $aiSection = tokenFindSection(tokenBuildSchema($page), 'AI Analysis');

    expect($aiSection)->not->toBeNull();
    expect($aiSection->isHidden())->toBeTrue();
});
