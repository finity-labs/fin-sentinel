# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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
