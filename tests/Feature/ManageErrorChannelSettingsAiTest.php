<?php

declare(strict_types=1);

use Composer\InstalledVersions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use FinityLabs\FinSentinel\Clusters\FinSentinelSettings\Pages\ManageErrorChannelSettings;
use FinityLabs\FinSentinel\Settings\ErrorChannelSettings;

beforeEach(function () {
    app()->forgetInstance('fin-sentinel.ai-available');
    app()->forgetInstance('fin-sentinel.manager');
    app()->forgetInstance(ErrorChannelSettings::class);
});

/**
 * Build the page's form schema bound to the given page instance.
 */
function aiBuildSchema(ManageErrorChannelSettings $page): Schema
{
    return $page->form(Schema::make($page)->statePath('data'));
}

/**
 * Walk the schema (including hidden) and return the first Section matching the heading.
 */
function aiFindSection(Schema $schema, string $heading): ?Section
{
    $found = null;

    $walk = function ($comp) use (&$walk, &$found, $heading) {
        if ($found !== null) {
            return;
        }
        if ($comp instanceof Section && $comp->getHeading() === $heading) {
            $found = $comp;

            return;
        }
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

    return $found;
}

/**
 * Walk the schema (including hidden) and return the first input/toggle/select matching the field name.
 */
function aiFindField(Schema $schema, string $name): mixed
{
    $found = null;

    $walk = function ($comp) use (&$walk, &$found, $name) {
        if ($found !== null) {
            return;
        }
        if (($comp instanceof TextInput || $comp instanceof Select || $comp instanceof Toggle)
            && method_exists($comp, 'getName')
            && $comp->getName() === $name
        ) {
            $found = $comp;

            return;
        }
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

    return $found;
}

it('hides the AI Section entirely when the SDK is unavailable', function () {
    app()->instance('fin-sentinel.ai-available', false);
    app()->forgetInstance('fin-sentinel.manager');

    $page = new ManageErrorChannelSettings;
    $section = aiFindSection(aiBuildSchema($page), 'AI Analysis');

    expect($section)->not->toBeNull();
    expect($section->isHidden())->toBeTrue();
    expect($section->isVisible())->toBeFalse();
});

it('shows the AI Section when the SDK is available', function () {
    app()->instance('fin-sentinel.ai-available', true);
    app()->forgetInstance('fin-sentinel.manager');

    $page = new ManageErrorChannelSettings;
    $section = aiFindSection(aiBuildSchema($page), 'AI Analysis');

    expect($section)->not->toBeNull();
    expect($section->isVisible())->toBeTrue();
});

it('never exposes the plaintext API key in the form data after fill', function () {
    app()->instance('fin-sentinel.ai-available', true);
    app()->forgetInstance('fin-sentinel.manager');

    $secret = 'sk-secret-plaintext-12345';
    $settings = app(ErrorChannelSettings::class);
    $settings->ai_api_key = $secret;
    $settings->save();

    $raw = $settings->toArray();
    expect($raw['ai_api_key'])->toBe($secret);

    $page = new ManageErrorChannelSettings;
    $method = new ReflectionMethod($page, 'mutateFormDataBeforeFill');

    $stripped = $method->invoke($page, $raw);

    expect($stripped['ai_api_key'])->toBe('');
    expect(serialize($stripped))->not->toContain($secret);
});

it('preserves the existing API key when the form field is left blank', function () {
    app()->instance('fin-sentinel.ai-available', true);
    app()->forgetInstance('fin-sentinel.manager');

    $settings = app(ErrorChannelSettings::class);
    $settings->ai_api_key = 'original-key-abc';
    $settings->save();

    app()->forgetInstance(ErrorChannelSettings::class);

    $page = new ManageErrorChannelSettings;
    $method = new ReflectionMethod($page, 'mutateFormDataBeforeSave');

    $result = $method->invoke($page, ['ai_api_key' => '', 'ignored_exceptions' => []]);

    expect($result['ai_api_key'])->toBe('original-key-abc');

    $fresh = app(ErrorChannelSettings::class);
    $fresh->ai_api_key = $result['ai_api_key'];
    $fresh->save();

    app()->forgetInstance(ErrorChannelSettings::class);

    expect(app(ErrorChannelSettings::class)->ai_api_key)->toBe('original-key-abc');
});

it('overwrites the API key when a new value is submitted', function () {
    app()->instance('fin-sentinel.ai-available', true);
    app()->forgetInstance('fin-sentinel.manager');

    $settings = app(ErrorChannelSettings::class);
    $settings->ai_api_key = 'original-key-abc';
    $settings->save();

    app()->forgetInstance(ErrorChannelSettings::class);

    $page = new ManageErrorChannelSettings;
    $method = new ReflectionMethod($page, 'mutateFormDataBeforeSave');

    $result = $method->invoke($page, ['ai_api_key' => 'new-key-xyz', 'ignored_exceptions' => []]);

    expect($result['ai_api_key'])->toBe('new-key-xyz');

    $fresh = app(ErrorChannelSettings::class);
    $fresh->ai_api_key = $result['ai_api_key'];
    $fresh->save();

    app()->forgetInstance(ErrorChannelSettings::class);

    expect(app(ErrorChannelSettings::class)->ai_api_key)->toBe('new-key-xyz');
});

it('rejects ai_timeout above the documented maximum', function () {
    app()->instance('fin-sentinel.ai-available', true);
    app()->forgetInstance('fin-sentinel.manager');

    $page = new ManageErrorChannelSettings;
    $field = aiFindField(aiBuildSchema($page), 'ai_timeout');

    expect($field)->not->toBeNull();
    expect($field->getMaxValue())->toBe(10);
});

it('rejects ai_timeout below the documented minimum', function () {
    app()->instance('fin-sentinel.ai-available', true);
    app()->forgetInstance('fin-sentinel.manager');

    $page = new ManageErrorChannelSettings;
    $field = aiFindField(aiBuildSchema($page), 'ai_timeout');

    expect($field)->not->toBeNull();
    expect($field->getMinValue())->toBe(1);
});

it('rejects ai_max_tokens below 1', function () {
    app()->instance('fin-sentinel.ai-available', true);
    app()->forgetInstance('fin-sentinel.manager');

    $page = new ManageErrorChannelSettings;
    $field = aiFindField(aiBuildSchema($page), 'ai_max_tokens');

    expect($field)->not->toBeNull();
    expect($field->getMinValue())->toBe(1);
});

it('accepts ai_hourly_cap of 0 but rejects negative values', function () {
    app()->instance('fin-sentinel.ai-available', true);
    app()->forgetInstance('fin-sentinel.manager');

    $page = new ManageErrorChannelSettings;
    $field = aiFindField(aiBuildSchema($page), 'ai_hourly_cap');

    expect($field)->not->toBeNull();
    expect($field->getMinValue())->toBe(0);
});

it('marks ai_provider required only when ai_enabled is true', function () {
    app()->instance('fin-sentinel.ai-available', true);
    app()->forgetInstance('fin-sentinel.manager');

    $pageOff = new ManageErrorChannelSettings;
    $pageOff->data = ['ai_enabled' => false];
    $providerOff = aiFindField(aiBuildSchema($pageOff), 'ai_provider');
    expect($providerOff)->not->toBeNull();
    expect($providerOff->isRequired())->toBeFalse();

    $pageOn = new ManageErrorChannelSettings;
    $pageOn->data = ['ai_enabled' => true];
    $providerOn = aiFindField(aiBuildSchema($pageOn), 'ai_provider');
    expect($providerOn)->not->toBeNull();
    expect($providerOn->isRequired())->toBeTrue();

    $modelOn = aiFindField(aiBuildSchema($pageOn), 'ai_model');
    expect($modelOn->isRequired())->toBeTrue();
});

it('enumerates text-capable providers from Lab::cases()', function () {
    app()->instance('fin-sentinel.ai-available', true);
    app()->forgetInstance('fin-sentinel.manager');

    $page = new ManageErrorChannelSettings;
    $method = new ReflectionMethod($page, 'aiProviderOptions');
    $options = $method->invoke($page);

    expect($options)->toBeArray()->not->toBeEmpty()
        ->and($options)->toHaveKeys(['anthropic', 'openai', 'gemini'])
        ->and($options)->not->toHaveKey('bedrock')
        ->and($options)->not->toHaveKey('cohere')
        ->and($options)->not->toHaveKey('eleven')
        ->and($options)->not->toHaveKey('jina')
        ->and($options)->not->toHaveKey('voyageai')
        ->and($options)->not->toHaveKey('openrouter');
})->skip(fn (): bool => ! InstalledVersions::isInstalled('laravel/ai'), 'requires laravel/ai');

it('returns the model triplet for a chosen provider and an empty array for blank', function () {
    app()->instance('fin-sentinel.ai-available', true);
    app()->forgetInstance('fin-sentinel.manager');

    $page = new ManageErrorChannelSettings;
    $method = new ReflectionMethod($page, 'aiModelOptionsFor');

    $options = $method->invoke($page, 'anthropic');
    expect($options)->toBeArray()->not->toBeEmpty();
    expect(count($options))->toBeLessThanOrEqual(3);

    expect($method->invoke($page, ''))->toBe([]);
})->skip(fn (): bool => ! InstalledVersions::isInstalled('laravel/ai'), 'requires laravel/ai');

/**
 * Walk schema (with hidden) DFS and collect all components.
 *
 * @return array<int, mixed>
 */
function aiFlattenSchema(Schema $schema): array
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

function aiFindTextarea(Schema $schema, string $name): ?Textarea
{
    foreach (aiFlattenSchema($schema) as $comp) {
        if ($comp instanceof Textarea
            && method_exists($comp, 'getName')
            && $comp->getName() === $name
        ) {
            return $comp;
        }
    }

    return null;
}

it('places the ai_prompt_template Textarea between ai_model and ai_api_key', function () {
    app()->instance('fin-sentinel.ai-available', true);
    app()->forgetInstance('fin-sentinel.manager');

    $page = new ManageErrorChannelSettings;
    $schema = aiBuildSchema($page);

    $aiSection = aiFindSection($schema, 'AI Analysis');
    expect($aiSection)->not->toBeNull();

    $children = $aiSection->getChildSchema()->getComponents(withHidden: true);
    $names = array_values(array_filter(array_map(
        fn ($c) => method_exists($c, 'getName') ? $c->getName() : null,
        $children,
    )));

    $modelIndex = array_search('ai_model', $names, true);
    $templateIndex = array_search('ai_prompt_template', $names, true);
    $apiKeyIndex = array_search('ai_api_key', $names, true);

    expect($modelIndex)->not->toBeFalse();
    expect($templateIndex)->not->toBeFalse();
    expect($apiKeyIndex)->not->toBeFalse();

    expect($templateIndex)->toBeGreaterThan($modelIndex);
    expect($templateIndex)->toBeLessThan($apiKeyIndex);

    expect(aiFindTextarea($schema, 'ai_prompt_template'))->not->toBeNull();
});

it('rejects a prompt template missing the {{error}} placeholder via the custom rule', function () {
    app()->instance('fin-sentinel.ai-available', true);
    app()->forgetInstance('fin-sentinel.manager');

    $page = new ManageErrorChannelSettings;
    $field = aiFindTextarea(aiBuildSchema($page), 'ai_prompt_template');
    expect($field)->not->toBeNull();

    $rules = $field->getValidationRules();
    expect($rules)->toBeArray()->not->toBeEmpty();

    $closureRule = null;
    foreach ($rules as $rule) {
        if ($rule instanceof Closure) {
            $closureRule = $rule;
            break;
        }
    }
    expect($closureRule)->not->toBeNull();

    $failed = false;
    $failedMessage = null;
    $closureRule('ai_prompt_template', 'no token here', function (string $msg) use (&$failed, &$failedMessage): void {
        $failed = true;
        $failedMessage = $msg;
    });

    expect($failed)->toBeTrue();
    expect($failedMessage)->toContain('{{error}}');
});

it('accepts a prompt template containing {{error}} via the custom rule', function () {
    app()->instance('fin-sentinel.ai-available', true);
    app()->forgetInstance('fin-sentinel.manager');

    $page = new ManageErrorChannelSettings;
    $field = aiFindTextarea(aiBuildSchema($page), 'ai_prompt_template');
    expect($field)->not->toBeNull();

    $rules = $field->getValidationRules();
    $closureRule = null;
    foreach ($rules as $rule) {
        if ($rule instanceof Closure) {
            $closureRule = $rule;
            break;
        }
    }
    expect($closureRule)->not->toBeNull();

    $failed = false;
    $closureRule('ai_prompt_template', 'Analyze this: {{error}}', function () use (&$failed): void {
        $failed = true;
    });

    expect($failed)->toBeFalse();
});

it('marks ai_prompt_template required only when ai_enabled is true', function () {
    app()->instance('fin-sentinel.ai-available', true);
    app()->forgetInstance('fin-sentinel.manager');

    $pageOff = new ManageErrorChannelSettings;
    $pageOff->data = ['ai_enabled' => false];
    $fieldOff = aiFindTextarea(aiBuildSchema($pageOff), 'ai_prompt_template');
    expect($fieldOff)->not->toBeNull();
    expect($fieldOff->isRequired())->toBeFalse();

    $pageOn = new ManageErrorChannelSettings;
    $pageOn->data = ['ai_enabled' => true];
    $fieldOn = aiFindTextarea(aiBuildSchema($pageOn), 'ai_prompt_template');
    expect($fieldOn)->not->toBeNull();
    expect($fieldOn->isRequired())->toBeTrue();
});

it('defines all five new English translation keys for the prompt template field', function () {
    $keys = [
        'fin-sentinel::fin-sentinel.settings.ai.prompt_template',
        'fin-sentinel::fin-sentinel.settings.ai.prompt_template_helper',
        'fin-sentinel::fin-sentinel.settings.ai.prompt_template_placeholder',
        'fin-sentinel::fin-sentinel.settings.ai.template_missing_token',
        'fin-sentinel::fin-sentinel.settings.ai.prompt_template_default',
    ];

    foreach ($keys as $key) {
        $value = trans($key);
        expect($value)->not->toBe($key)
            ->and($value)->toBeString()
            ->and(trim((string) $value))->not->toBe('');
    }
});

it('preserves a custom saved ai_prompt_template across reload', function () {
    app()->forgetInstance(ErrorChannelSettings::class);

    $custom = 'My team prompt template — analyze this: {{error}}';

    $settings = app(ErrorChannelSettings::class);
    $settings->ai_prompt_template = $custom;
    $settings->save();

    app()->forgetInstance(ErrorChannelSettings::class);

    expect(app(ErrorChannelSettings::class)->ai_prompt_template)->toBe($custom);
});

it('positions ai_cache_ttl_minutes between ai_hourly_cap and ai_strict_scrubbing', function () {
    app()->instance('fin-sentinel.ai-available', true);
    app()->forgetInstance('fin-sentinel.manager');

    $page = new ManageErrorChannelSettings;
    $schema = aiBuildSchema($page);

    $aiSection = aiFindSection($schema, 'AI Analysis');
    expect($aiSection)->not->toBeNull();

    $children = $aiSection->getChildSchema()->getComponents(withHidden: true);
    $names = array_values(array_filter(array_map(
        fn ($c) => method_exists($c, 'getName') ? $c->getName() : null,
        $children,
    )));

    $hourlyCapIndex = array_search('ai_hourly_cap', $names, true);
    $cacheTtlIndex = array_search('ai_cache_ttl_minutes', $names, true);
    $strictScrubbingIndex = array_search('ai_strict_scrubbing', $names, true);

    expect($hourlyCapIndex)->not->toBeFalse();
    expect($cacheTtlIndex)->not->toBeFalse();
    expect($strictScrubbingIndex)->not->toBeFalse();

    expect($cacheTtlIndex)->toBe($hourlyCapIndex + 1);
    expect($strictScrubbingIndex)->toBe($cacheTtlIndex + 1);
});

it('declares ai_cache_ttl_minutes with numeric, 5-1440 range and minutes suffix', function () {
    app()->instance('fin-sentinel.ai-available', true);
    app()->forgetInstance('fin-sentinel.manager');

    $page = new ManageErrorChannelSettings;
    $field = aiFindField(aiBuildSchema($page), 'ai_cache_ttl_minutes');

    expect($field)->not->toBeNull();
    expect($field)->toBeInstanceOf(TextInput::class);
    expect($field->isNumeric())->toBeTrue();
    expect($field->getMinValue())->toBe(5);
    expect($field->getMaxValue())->toBe(1440);
    expect($field->getSuffixLabel())->toBe('minutes');
});

it('marks ai_cache_ttl_minutes required only when ai_enabled is true', function () {
    app()->instance('fin-sentinel.ai-available', true);
    app()->forgetInstance('fin-sentinel.manager');

    $pageOff = new ManageErrorChannelSettings;
    $pageOff->data = ['ai_enabled' => false];
    $fieldOff = aiFindField(aiBuildSchema($pageOff), 'ai_cache_ttl_minutes');
    expect($fieldOff)->not->toBeNull();
    expect($fieldOff->isRequired())->toBeFalse();

    $pageOn = new ManageErrorChannelSettings;
    $pageOn->data = ['ai_enabled' => true];
    $fieldOn = aiFindField(aiBuildSchema($pageOn), 'ai_cache_ttl_minutes');
    expect($fieldOn)->not->toBeNull();
    expect($fieldOn->isRequired())->toBeTrue();
});

it('defines both new English translation keys for the cache TTL field', function () {
    $keys = [
        'fin-sentinel::fin-sentinel.settings.ai.cache_ttl',
        'fin-sentinel::fin-sentinel.settings.ai.cache_ttl_helper',
    ];

    foreach ($keys as $key) {
        $value = trans($key);
        expect($value)->not->toBe($key)
            ->and($value)->toBeString()
            ->and(trim((string) $value))->not->toBe('');
    }
});

it('preserves a custom saved ai_cache_ttl_minutes across reload', function () {
    app()->forgetInstance(ErrorChannelSettings::class);

    $settings = app(ErrorChannelSettings::class);
    $settings->ai_cache_ttl_minutes = 120;
    $settings->save();

    app()->forgetInstance(ErrorChannelSettings::class);

    expect(app(ErrorChannelSettings::class)->ai_cache_ttl_minutes)->toBe(120);
});
