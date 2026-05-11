# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.1.3] - 2026-05-11

### Fixed

- **`+sdk` test rows on the mirror** -- All five `+sdk` matrix jobs reported 21 binding failures (`Unresolvable dependency resolving [Parameter #0 [ <required> $app ]] in class Illuminate\Support\MultipleInstanceManager`). Cause: `tests/TestCase::getPackageProviders()` did not register `Laravel\Ai\AiServiceProvider` when `laravel/ai` was installed, so Testbench never bound `AiManager`. Now conditionally appended when the class exists.
- **`AiAnalyzerCircuitBreakerTest`, `AiAnalyzerHourlyCapTest`, `AiAnalyzerTimeoutTest`** -- The gateway-swap mocks in these files used `app()->resolving(AiManager::class, fn ($m) => $m->textProvider('anthropic')->useTextGateway($spy))`, which set the spy on the cached anthropic provider. `AiErrorAnalyzer::withProviderKey()` then called `Ai::forgetInstance('anthropic')` to make the DB-stored API key take effect, which wiped the cached provider — and the next resolution rebuilt a fresh provider without the spy. The real HTTP call then fired and `Http::preventStrayRequests()` threw a `StrayRequestException` that the analyzer's outer catch swallowed as `'unknown error'`. The `AiAnalyzerTimeoutTest > threads the configured ai_timeout` test was separately broken: `Ai::fakeAgent` passes a `string` to its closure, not an `AgentPrompt`, so `$prompt->timeout` was always null. Both tests rewritten to use `AiManager::extend('anthropic', fn () => $provider->useTextGateway($spy))`, which re-runs on every resolution and survives `forgetInstance`. Helpers extracted to `tests/AiTestHelpers.php` for reuse.
- **L13 dependency resolution** -- `composer.json` widened to allow `illuminate/contracts ^13.0` and `orchestra/testbench ^11.0` (the testbench line that supports Laravel 13). Tests workflow updated to constrain `illuminate/contracts` (matching fin-mail's idiom) and remove `pest-plugin-laravel` on the L13 row, where the plugin has no compatible version yet.
- **L11 matrix row** -- The Filament ^4 row pinned `laravel: ^11.0`, but the test suite uses `Mail::assertSentTimes` and the L12-shape `StrayRequestException`, which are L12+ APIs. The row now omits the Laravel pin so composer picks the latest compatible version (L12 under Filament ^4), matching fin-mail's idiom. Job name template adjusted to omit the Laravel segment when unpinned.

## [1.1.2] - 2026-05-11

### Fixed

- **Mirror Tests workflow** -- The `step-security/harden-runner@v2` pre-step engaged on every matrix row regardless of the step `if:` gate, which blocked `setup-php` from downloading composer and failed all five jobs. Split the workflow into two jobs: a `tests` matrix with no network restrictions, and a dedicated `tests-network-blocked` job that uses plain `iptables` to block outbound traffic *after* composer install but before `pest` runs.

### Notes

- **v1.1.1** -- Tagged but functionally identical to v1.1.0. The intended workflow fix did not land on the mirror because the split action botched the commit message escaping (an apostrophe broke its shell-quoted `git commit --message` invocation). v1.1.2 carries the actual fix.

## [1.1.0] - 2026-05-10

### Added

- **AI error analysis (opt-in)** -- When `laravel/ai` is installed and the operator opts in, error emails carry a provider-generated suggestion section rendered at the top of the body, in the operator's locale.
- **Optional dependency, zero-config upgrade** -- `laravel/ai` lives in `suggest`; v1.0 installs upgrade to v1.1 with no behavior change until AI is explicitly enabled.
- **Operator-editable prompt template** -- Filament Textarea on the Error Channel settings page; supports a `{{error}}` placeholder that the builder replaces with delimiter-wrapped, scrubbed exception context. Form rejects save if the placeholder is removed.
- **9 text-capable providers** -- Anthropic, Azure OpenAI, DeepSeek, Gemini, Groq, Mistral, Ollama, OpenAI, xAI. Provider/model dropdowns are reactive and pulled from the SDK at form-render time.
- **Encrypted API key at rest** -- `ai_api_key` is stored encrypted via Spatie's `#[ShouldBeEncrypted]`. Key is injected into the SDK config per-call (never written to `.env`).
- **Test Connection action** -- One-click button next to the API key field validates the in-form credentials against the provider with a one-shot SDK call; surfaces specific provider errors in a Filament Notification.
- **Cost protection** -- Per-hour cap (default 50), three-strike circuit breaker (5-minute open window with half-open probe), retry-once policy on transient `ProviderOverloadedException` only.
- **Cache-first lookup** -- Successful suggestions are cached by normalized exception fingerprint; numeric ID variants collapse into a single cache entry.
- **Token usage display** -- Last call (prompt + completion + total + state badge) and current-month cumulative on the settings page; raw with thousand separators.
- **PII regex scrubbing** -- New `scrubString()` on `DataScrubber` strips JWT, AWS keys, Stripe keys, emails, IPv4 addresses, and file paths from the AI input. Per-category replacement labels.
- **Strict scrubbing mode** -- Operator toggle that drops the stack trace from the AI input; payload reduces to exception class + first-line message + file:line.
- **Prompt-injection canary defense** -- `AiOutputValidator` rejects responses containing 12 hardcoded canary markers (PWNED, ChatML markers, "ignore previous instructions" variants, etc.). Operator-extensible via config.
- **Send Test Email runs the full pipeline** -- The existing button now exercises the AI flow end-to-end when AI is enabled and surfaces the result in the success notification.
- **Install command AI integration** -- `php artisan fin-sentinel:install --ai` runs the AI install at the end of the existing flow. New `--ai-only` flag re-runs just the AI step (autoload-aware for cases where the SDK was just installed).
- **Translated AI section** -- Heading, disclaimer, and 8 reason strings translated across all 58 supported locales.
- **Network-blocked CI matrix row** -- `step-security/harden-runner@v2` confirms the test suite makes zero outbound HTTP calls.
- **Test infrastructure** -- `Http::fake([])` + `Http::preventStrayRequests()` registered globally in `tests/TestCase` so any unmocked HTTP throws `StrayRequestException`.

### Changed

- **CI matrix** -- Replaced 5+1-row PHP×Filament matrix with explicit 4-row spec: PHP 8.2/L11/F^4/no-SDK + PHP 8.3/L12/F^5/no-SDK + PHP 8.3/L12/F^5/with-SDK + PHP 8.4/L13/F^5/with-SDK + 1 dedicated network-blocked row.
- **`MessageLoggedListener::hashException()`** -- v1.0's inline `md5(...)` extracted to public static methods (`hashException` + `hashExceptionParts`) so the AI cache layer can reuse the fingerprint with numeric-ID normalization. v1.0 throttle path is byte-identical.

## [1.0.1] - 2026-03-28

### Added

- Translations for all 58 Filament-supported languages
- Explicit `addActionLabel` on repeater buttons to prevent mixed-language labels

## [1.0.0] - 2026-03-28

### Added

- **Error Notifications** -- Automatic email alerts for exceptions and error-level log messages with stack traces, request context, and environment info
- **Configurable Ignore List** -- Skip exceptions you don't care about (404s, token mismatches, etc.)
- **Per-exception Throttling** -- Same error won't flood your inbox; configurable cooldown period
- **Recursive Loop Guard** -- If the error email itself fails, it won't trigger more error emails
- **Sensitive Data Scrubbing** -- Passwords, tokens, API keys, and secrets are redacted automatically
- **Debug Mail Channel** -- `FinSentinel::debug($data)` sends whatever you're inspecting as a formatted email and writes a log entry
- **Fluent Builder** -- Chain `->subject()`, `->to()`, and `->send()` for full control over debug emails
- **Smart Formatting** -- Arrays, Eloquent models, collections, and query builders are formatted into readable HTML
- **Event-based Debug** -- Fire `SentinelDebug::dispatch($data)` from anywhere, including queued jobs
- **Log File Browser** -- List, search, and filter Laravel log files from the admin panel
- **File Actions** -- View, download, email, or delete log files without touching the server
- **Memory-safe Parsing** -- Handles 100MB+ log files using indexed two-pass pagination
- **Admin Settings Pages** -- Configure both channels (error and debug) from the UI
- **Shield Integration** -- Optional page-level permissions via Filament Shield
- **Install & Uninstall Commands** -- Interactive setup and teardown with panel registration and Shield config
