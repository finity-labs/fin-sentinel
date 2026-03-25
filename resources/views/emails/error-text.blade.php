{{ config('app.name', 'Laravel') }} - {{ __('fin-sentinel::fin-sentinel.email_header_error') }}
========================================================

{{ __('fin-sentinel::fin-sentinel.email_label_error_message') }}
-------------
{{ $errorMessage }}

@if($exceptionClass)
{{ __('fin-sentinel::fin-sentinel.error_section_exception') }}
---------------------
{{ __('fin-sentinel::fin-sentinel.email_label_class') }}: {{ $exceptionClass }}
{{ __('fin-sentinel::fin-sentinel.email_label_file') }}:  {{ $exceptionFile }}:{{ $exceptionLine }}

@endif
@if($stackTrace)
{{ __('fin-sentinel::fin-sentinel.error_section_trace') }}
-----------
@foreach($stackTrace as $index => $frame)
#{{ $index }} {{ $frame['file'] ?? '?' }}:{{ $frame['line'] ?? '?' }} {{ $frame['class'] ?? '' }}{{ $frame['class'] ? '::' : '' }}{{ $frame['function'] ?? '' }}()
@endforeach

@endif
{{ __('fin-sentinel::fin-sentinel.error_section_request') }}
---------------
@if(isset($requestContext['context']))
{{ __('fin-sentinel::fin-sentinel.email_label_context') }}: {{ $requestContext['context'] }}
{{ __('fin-sentinel::fin-sentinel.email_label_command') }}: {{ $requestContext['command'] }}
@else
{{ __('fin-sentinel::fin-sentinel.email_label_url') }}:    {{ $requestContext['url'] ?? '' }}
{{ __('fin-sentinel::fin-sentinel.email_label_method') }}: {{ $requestContext['method'] ?? '' }}
{{ __('fin-sentinel::fin-sentinel.email_label_ip') }}:     {{ $requestContext['ip'] ?? '' }}
@if(!empty($requestContext['params']))
{{ __('fin-sentinel::fin-sentinel.email_label_params') }}: {{ json_encode($requestContext['params'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}
@endif
@if(!empty($requestContext['headers']))
{{ __('fin-sentinel::fin-sentinel.email_label_headers') }}: {{ json_encode($requestContext['headers'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}
@endif
@endif

{{ __('fin-sentinel::fin-sentinel.error_section_user') }}
------------------
{{ __('fin-sentinel::fin-sentinel.email_label_name') }}: {{ $userContext['name'] ?? '' }}
@if(isset($userContext['email']))
{{ __('fin-sentinel::fin-sentinel.email_label_email') }}: {{ $userContext['email'] }}
@endif
@if(isset($userContext['id']))
{{ __('fin-sentinel::fin-sentinel.email_label_id') }}: {{ $userContext['id'] }}
@endif

{{ __('fin-sentinel::fin-sentinel.error_section_environment') }}
-----------
{{ __('fin-sentinel::fin-sentinel.email_label_environment') }}:    {{ $environmentContext['app_env'] ?? '' }}
{{ __('fin-sentinel::fin-sentinel.email_label_debug_mode') }}:     {{ $environmentContext['app_debug'] ? __('fin-sentinel::fin-sentinel.email_label_enabled') : __('fin-sentinel::fin-sentinel.email_label_disabled') }}
{{ __('fin-sentinel::fin-sentinel.email_label_php_version') }}:    {{ $environmentContext['php_version'] ?? '' }}
{{ __('fin-sentinel::fin-sentinel.email_label_laravel_version') }}: {{ $environmentContext['laravel_version'] ?? '' }}
{{ __('fin-sentinel::fin-sentinel.email_label_peak_memory') }}:    {{ $environmentContext['memory_peak'] ?? '' }}

---
{{ $environmentContext['timestamp'] ?? '' }}
