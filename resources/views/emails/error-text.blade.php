{{ config('app.name', 'Laravel') }} - {{ __('fin-sentinel::fin-sentinel.email.header.error') }}
========================================================

{{ __('fin-sentinel::fin-sentinel.email.label.error_message') }}
-------------
{{ $errorMessage }}

@if($exceptionClass)
{{ __('fin-sentinel::fin-sentinel.email.error.section_exception') }}
---------------------
{{ __('fin-sentinel::fin-sentinel.email.label.class') }}: {{ $exceptionClass }}
{{ __('fin-sentinel::fin-sentinel.email.label.file') }}:  {{ $exceptionFile }}:{{ $exceptionLine }}

@endif
@if($stackTrace)
{{ __('fin-sentinel::fin-sentinel.email.error.section_trace') }}
-----------
@foreach($stackTrace as $index => $frame)
#{{ $index }} {{ $frame['file'] ?? '?' }}:{{ $frame['line'] ?? '?' }} {{ $frame['class'] ?? '' }}{{ $frame['class'] ? '::' : '' }}{{ $frame['function'] ?? '' }}()
@endforeach

@endif
{{ __('fin-sentinel::fin-sentinel.email.error.section_request') }}
---------------
@if(isset($requestContext['context']))
{{ __('fin-sentinel::fin-sentinel.email.label.context') }}: {{ $requestContext['context'] }}
{{ __('fin-sentinel::fin-sentinel.email.label.command') }}: {{ $requestContext['command'] }}
@else
{{ __('fin-sentinel::fin-sentinel.email.label.url') }}:    {{ $requestContext['url'] ?? '' }}
{{ __('fin-sentinel::fin-sentinel.email.label.method') }}: {{ $requestContext['method'] ?? '' }}
{{ __('fin-sentinel::fin-sentinel.email.label.ip') }}:     {{ $requestContext['ip'] ?? '' }}
@if(!empty($requestContext['params']))
{{ __('fin-sentinel::fin-sentinel.email.label.params') }}: {{ json_encode($requestContext['params'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}
@endif
@if(!empty($requestContext['headers']))
{{ __('fin-sentinel::fin-sentinel.email.label.headers') }}: {{ json_encode($requestContext['headers'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}
@endif
@endif

{{ __('fin-sentinel::fin-sentinel.email.error.section_user') }}
------------------
{{ __('fin-sentinel::fin-sentinel.email.label.name') }}: {{ $userContext['name'] ?? '' }}
@if(isset($userContext['email']))
{{ __('fin-sentinel::fin-sentinel.email.label.email') }}: {{ $userContext['email'] }}
@endif
@if(isset($userContext['id']))
{{ __('fin-sentinel::fin-sentinel.email.label.id') }}: {{ $userContext['id'] }}
@endif

{{ __('fin-sentinel::fin-sentinel.email.error.section_environment') }}
-----------
{{ __('fin-sentinel::fin-sentinel.email.label.environment') }}:    {{ $environmentContext['app_env'] ?? '' }}
{{ __('fin-sentinel::fin-sentinel.email.label.debug_mode') }}:     {{ $environmentContext['app_debug'] ? __('fin-sentinel::fin-sentinel.email.label.enabled') : __('fin-sentinel::fin-sentinel.email.label.disabled') }}
{{ __('fin-sentinel::fin-sentinel.email.label.php_version') }}:    {{ $environmentContext['php_version'] ?? '' }}
{{ __('fin-sentinel::fin-sentinel.email.label.laravel_version') }}: {{ $environmentContext['laravel_version'] ?? '' }}
{{ __('fin-sentinel::fin-sentinel.email.label.peak_memory') }}:    {{ $environmentContext['memory_peak'] ?? '' }}

---
{{ $environmentContext['timestamp'] ?? '' }}
