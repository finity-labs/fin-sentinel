{{ $appName }} - {{ __('fin-sentinel::fin-sentinel.email.header.log_file') }}
========================

{{ __('fin-sentinel::fin-sentinel.email.log_file.body_text', ['file' => $fileName, 'app' => $appName]) }}

---
{{ now()->toDateTimeString() }} ({{ config('app.timezone', 'UTC') }})
