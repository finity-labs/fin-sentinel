{{ $appName }} - {{ __('fin-sentinel::fin-sentinel.email_header_log_file') }}
========================

{{ __('fin-sentinel::fin-sentinel.email_log_file_body_text', ['file' => $fileName, 'app' => $appName]) }}

---
{{ now()->toDateTimeString() }} ({{ config('app.timezone', 'UTC') }})
