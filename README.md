# FinSentinel for Filament

<!-- ![finity-labs-fin-sentinel](banner-placeholder) -->

[![FILAMENT 4.x](https://img.shields.io/badge/FILAMENT-4.x-EBB304?style=flat-square)](https://filamentphp.com/docs/4.x/panels/installation)
[![FILAMENT 5.x](https://img.shields.io/badge/FILAMENT-5.x-EBB304?style=flat-square)](https://filamentphp.com/docs/5.x/panels/installation)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/finity-labs/fin-sentinel.svg?style=flat-square)](https://packagist.org/packages/finity-labs/fin-sentinel)
[![Tests](https://github.com/finity-labs/fin-sentinel/actions/workflows/tests.yml/badge.svg)](https://github.com/finity-labs/fin-sentinel/actions/workflows/tests.yml)
[![Code Style](https://github.com/finity-labs/fin-sentinel/actions/workflows/style.yml/badge.svg)](https://github.com/finity-labs/fin-sentinel/actions/workflows/style.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/finity-labs/fin-sentinel.svg?style=flat-square)](https://packagist.org/packages/finity-labs/fin-sentinel)
[![License](https://img.shields.io/packagist/l/finity-labs/fin-sentinel.svg?style=flat-square)](https://packagist.org/packages/finity-labs/fin-sentinel)

A Filament plugin that catches exceptions and emails them to your team, gives you a one-liner debug mail channel, and lets you browse log files from the admin panel -- no SSH required.

## Features

- **Automatic error emails** -- Stack traces, request context, and environment info delivered straight to your inbox when something breaks
- **Configurable ignore list** -- Skip exceptions you don't care about (like 404s and token mismatches)
- **Per-exception throttling** -- Same error won't flood your inbox; configurable cooldown period
- **Recursive loop guard** -- If the error email itself fails, it won't trigger more error emails
- **Sensitive data scrubbing** -- Passwords, tokens, API keys, and secrets are redacted automatically
- **Debug mail via Facade** -- `FinSentinel::debug($data)` sends whatever you're inspecting as a formatted email
- **Fluent builder** -- Chain `->subject()`, `->to()`, and `->send()` for full control over debug emails
- **Smart formatting** -- Arrays, Eloquent models, collections, and query builders are formatted into readable HTML
- **Event-based debug** -- Fire `SentinelDebug::dispatch($data)` from anywhere, including queued jobs
- **Log file browser** -- List, search, and filter your Laravel log files from the admin panel
- **File actions** -- View, download, email, or delete log files without touching the server
- **Memory-safe parsing** -- Handles 100MB+ log files using indexed two-pass pagination
- **Admin settings pages** -- Configure both channels (error and debug) from the UI
- **Shield integration** -- Optional page-level permissions via Filament Shield

## Requirements

- PHP 8.2+
- Laravel 11+
- Filament 5

## Installation

```bash
composer require finity-labs/fin-sentinel
```

```bash
php artisan fin-sentinel:install
```

The install command will:
- Publish the config file and settings migrations
- Run migrations to create the settings tables
- Register the plugin in your selected Filament panel(s)

#### Non-interactive install

Pass panel IDs as arguments to skip the interactive prompt:

```bash
php artisan fin-sentinel:install admin
```

In non-interactive mode (e.g., CI), the command registers the plugin in all discovered panels automatically.

### Register the plugin

If you skipped the automatic registration during install, add it to your panel provider manually:

```php
use FinityLabs\FinSentinel\FinSentinelPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            FinSentinelPlugin::make(),
        ]);
}
```

### Plugin options

```php
FinSentinelPlugin::make()
    ->navigationGroup('Monitoring')      // string, UnitEnum, Closure, or null
    ->navigationSort(10)                 // ?int
    ->canAccess(fn () => auth()->user()?->is_admin)  // restrict access without Shield
    ->settingsCluster(MySettingsCluster::class)       // move settings to a custom cluster
```

The `canAccess` closure controls who can see all Sentinel pages. When omitted, every authenticated panel user has access. When [Filament Shield](#filament-shield-integration) is installed, its page-level permissions take priority.

The `settingsCluster` option lets you move the Error Channel and Debug Channel settings pages into a different cluster (e.g., a shared "Settings" cluster in your app). By default, they live in the built-in FinSentinelSettings cluster.

## Usage

### Error Notifications

Once installed, the error channel works automatically -- there's no code to write. When an exception or message is logged at `error`, `critical`, `alert`, or `emergency` level, FinSentinel catches it, formats the stack trace and request context, scrubs sensitive data, and emails it to your configured recipients. Lower-severity log events (`debug`, `info`, `notice`, `warning`) are always ignored -- use the debug channel for ad-hoc inspection instead.

To get started, open the **Error Channel Settings** page in your admin panel and:
1. Toggle the channel on
2. Add one or more recipient email addresses
3. Save

That's it. Errors will start arriving in your inbox.

You can also configure:
- **Ignored exceptions** -- Common exceptions like `NotFoundHttpException` and `TokenMismatchException` are ignored by default. Add or remove classes from the settings page.
- **Throttle** -- Enable per-exception throttling to avoid duplicate emails within a configurable time window.

To customize the error email template, publish the views:

```bash
php artisan vendor:publish --tag=fin-sentinel-views
```

### Debug Channel

The debug channel gives you a quick way to email yourself any variable, model, or collection for inspection. It's like `dd()` but it lands in your inbox instead of killing the request. Every `FinSentinel::debug()` call also writes a `Log::debug()` entry, so you always have a log trail regardless of whether the email is enabled.

#### Using the Facade

```php
use FinityLabs\FinSentinel\Facades\FinSentinel;

// Quick one-liner -- sends to the configured recipients
FinSentinel::debug($user);

// With a custom subject
FinSentinel::debug($order, 'Order inspection');

// Fluent builder for full control
FinSentinel::debug($cart)
    ->subject('Cart contents')
    ->to('dev@example.com')
    ->send();
```

When you call `->send()`, the email goes out synchronously. If you don't call `->send()`, the builder queues the email automatically when it's garbage collected -- so you won't accidentally forget to send it.

#### Using the Event

If you prefer events (useful in queued jobs or when you don't want to import the Facade):

```php
use FinityLabs\FinSentinel\Events\SentinelDebug;

SentinelDebug::dispatch($data, 'Optional subject');
```

The event listener always queues the email.

**Note:** The debug channel must be enabled in the admin settings before emails will be sent. The Facade and event both check the `debug_enabled` setting.

### Log Viewer

The log viewer lets you browse your Laravel log files from the admin panel. You'll find two pages under the Sentinel navigation group:

**Log File List** -- Shows all `.log` files in your `storage/logs` directory with file size and last modified date. From here you can:
- **View** -- Opens the log entry viewer with paginated entries
- **Download** -- Streams the file to your browser
- **Email** -- Sends the log file as an attachment to any address
- **Delete** -- Removes the file from disk (with confirmation)

**Log Entry Viewer** -- Displays individual log entries with:
- **Level filtering** -- Show only errors, warnings, or any combination of log levels
- **Text search** -- Filter entries by keyword
- **Stack trace modal** -- Click an entry to see the full stack trace with vendor frame detection
- **Copy buttons** -- Copy the message or full stack trace to your clipboard

The parser uses a two-pass approach (index first, then parse) so it can handle large log files without running out of memory.

### Settings

FinSentinel has two settings pages, both accessible from the admin panel:

- **Error Channel Settings** -- Toggle the error channel on/off, manage recipients, configure ignored exceptions, and set throttle rules.
- **Debug Channel Settings** -- Toggle the debug channel, set recipients, and configure throttle behavior.

## Configuration

Publish the config file:

```bash
php artisan vendor:publish --tag=fin-sentinel-config
```

The config file (`config/fin-sentinel.php`) contains:

**Email layout** -- Controls the max-width of error and debug notification emails. Stack traces and data tables benefit from extra space, so the default is wider than standard emails:

```php
'email_max_width' => '90%',
```

The log file attachment email uses Laravel's default 600px width since it's a simple message.

**Sensitive data scrubbing** -- Values matching these keys are replaced with `[REDACTED]` in error and debug emails:

```php
'scrub' => [
    'params'     => ['password', 'token', 'secret', '_token', 'credit_card', ...],
    'headers'    => ['authorization', 'cookie', 'x-api-key'],
    'env'        => ['DB_PASSWORD', 'APP_KEY', 'MAIL_PASSWORD', 'AWS_SECRET_ACCESS_KEY'],
    'trace_args' => ['password', 'secret', 'token'],
],
```

Each category targets a different data source. Keys are matched case-insensitively. Add your own keys to any category as needed.

## Customization

| Tag | What it publishes |
|-----|-------------------|
| `fin-sentinel-config` | Configuration file |
| `fin-sentinel-migrations` | Settings migrations |
| `fin-sentinel-views` | Email templates (error and debug) |
| `fin-sentinel-translations` | Translation files |

```bash
php artisan vendor:publish --tag=fin-sentinel-views
php artisan vendor:publish --tag=fin-sentinel-translations
```

## Filament Shield Integration

FinSentinel pages use the `HasPageShieldSupport` trait, which integrates with [Filament Shield](https://github.com/bezhanSalleh/filament-shield) for page-level permissions. Shield is entirely optional -- without it, all pages are accessible to any authenticated user.

If you use Shield, generate the permissions:

```bash
php artisan shield:generate --panel=admin --option=policies_and_permissions
```

## Uninstalling

Run the uninstall command **before** removing the package:

```bash
php artisan fin-sentinel:uninstall
composer remove finity-labs/fin-sentinel
```

The uninstall command will:
- Remove `FinSentinelPlugin::make()` from your panel provider(s)
- Delete the published config file
- Optionally roll back settings migrations and clean up database entries

Use `--force` to skip confirmation prompts.

## Testing

```bash
composer test
```

## License

MIT
