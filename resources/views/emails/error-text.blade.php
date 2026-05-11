{{ config('app.name', 'Laravel') }} - {{ __('fin-sentinel::fin-sentinel.email.header.error') }}
========================================================

{{ __('fin-sentinel::fin-sentinel.email.label.error_message') }}
-------------
{{ $errorMessage }}

@if($aiSuggestion && $aiSuggestion->state !== \FinityLabs\FinSentinel\Support\AiSuggestionState::DISABLED)
{{ __('fin-sentinel::fin-sentinel.email.ai.heading') }}@if($aiSuggestion->state === \FinityLabs\FinSentinel\Support\AiSuggestionState::CACHED) [{{ __('fin-sentinel::fin-sentinel.email.ai.cached_badge') }}]@endif
-------------
@if($aiSuggestion->state === \FinityLabs\FinSentinel\Support\AiSuggestionState::SUCCESS || $aiSuggestion->state === \FinityLabs\FinSentinel\Support\AiSuggestionState::CACHED)
{{ $aiSuggestion->suggestion }}
@if($aiProvider !== '' || $aiModel !== '')

{{ __('fin-sentinel::fin-sentinel.email.ai.footnote_prefix') }} {{ $aiProvider }}@if($aiProvider !== '' && $aiModel !== '') -- @endif{{ $aiModel }}
@endif

{{ __('fin-sentinel::fin-sentinel.email.ai.disclaimer') }}
@elseif($aiSuggestion->state === \FinityLabs\FinSentinel\Support\AiSuggestionState::FAILED)
{{ __('fin-sentinel::fin-sentinel.email.ai.failed_prefix') }}: @lang('fin-sentinel::fin-sentinel.email.ai.reason.' . str_replace([' ', ':'], ['_', ''], $aiSuggestion->reason ?? 'unknown_error'))
@elseif($aiSuggestion->state === \FinityLabs\FinSentinel\Support\AiSuggestionState::SKIPPED)
{{ __('fin-sentinel::fin-sentinel.email.ai.skipped_prefix') }}: @lang('fin-sentinel::fin-sentinel.email.ai.reason.' . str_replace([' ', ':'], ['_', ''], $aiSuggestion->reason ?? 'unknown_error'))
@endif

@endif
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
