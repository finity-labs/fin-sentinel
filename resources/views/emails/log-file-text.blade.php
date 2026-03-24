{{ $appName }} - Log File
========================

Log file {{ $fileName }} from {{ $appName }} is attached.

---
{{ now()->toDateTimeString() }} ({{ config('app.timezone', 'UTC') }})
