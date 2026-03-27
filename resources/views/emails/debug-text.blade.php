{{ config('app.name', 'Laravel') }} - {{ __('fin-sentinel::fin-sentinel.email.header.debug') }}
============================================

{{ __('fin-sentinel::fin-sentinel.email.debug.section_data') }}
----------
@if($formattedData['type'] === 'model')
Type: Model ({{ $formattedData['class'] }})

@foreach($formattedData['attributes'] as $key => $value)
  {{ $key }}: {{ is_array($value) || is_object($value) ? json_encode($value, JSON_UNESCAPED_SLASHES) : $value }}
@endforeach
@if(!empty($formattedData['relations']))

@foreach($formattedData['relations'] as $relationName => $relationData)
  {{ __('fin-sentinel::fin-sentinel.email.label.relation', ['name' => $relationName]) }}: {{ json_encode($relationData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}
@endforeach
@endif
@elseif($formattedData['type'] === 'collection')
{{ trans_choice('fin-sentinel::fin-sentinel.email.collection.count', $formattedData['count'], ['count' => $formattedData['count']]) }}

@foreach(array_slice($formattedData['items'], 0, 20) as $index => $item)
#{{ $index }} ({{ $item['type'] }})
@if($item['type'] === 'model')
  {{ __('fin-sentinel::fin-sentinel.email.label.class') }}: {{ $item['class'] }}
  {{ json_encode($item['attributes'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}
@elseif($item['type'] === 'scalar')
  {{ $item['value'] }}
@else
  {{ json_encode($item['data'] ?? $item, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}
@endif

@endforeach
@if($formattedData['count'] > 20)
{{ __('fin-sentinel::fin-sentinel.email.collection.more', ['count' => $formattedData['count'] - 20]) }}
@endif
@elseif($formattedData['type'] === 'query')
Type: Query

SQL: {{ $formattedData['sql'] }}
@if(!empty($formattedData['bindings']))
{{ __('fin-sentinel::fin-sentinel.email.label.bindings') }} {{ json_encode($formattedData['bindings'], JSON_UNESCAPED_SLASHES) }}
@endif
@elseif($formattedData['type'] === 'array')
Type: Array

{{ json_encode($formattedData['data'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}
@elseif($formattedData['type'] === 'scalar')
Type: Scalar

{{ $formattedData['value'] }}
@endif

{{ __('fin-sentinel::fin-sentinel.email.debug.section_call_site') }}
---------
{{ $callSite['file'] ?? '' }}:{{ $callSite['line'] ?? '' }}

{{ __('fin-sentinel::fin-sentinel.email.debug.section_request') }}
---------------
@if(isset($requestContext['context']))
{{ __('fin-sentinel::fin-sentinel.email.label.context') }}: {{ $requestContext['context'] }}
{{ __('fin-sentinel::fin-sentinel.email.label.command') }}: {{ $requestContext['command'] }}
@else
{{ __('fin-sentinel::fin-sentinel.email.label.url') }}:    {{ $requestContext['url'] ?? '' }}
{{ __('fin-sentinel::fin-sentinel.email.label.method') }}: {{ $requestContext['method'] ?? '' }}
{{ __('fin-sentinel::fin-sentinel.email.label.user') }}:   {{ $requestContext['user'] ?? '' }}
@endif

{{ __('fin-sentinel::fin-sentinel.email.debug.section_environment') }}
-----------
{{ __('fin-sentinel::fin-sentinel.email.label.environment') }}:    {{ $environmentContext['app_env'] ?? '' }}
{{ __('fin-sentinel::fin-sentinel.email.label.php_version') }}:    {{ $environmentContext['php_version'] ?? '' }}
{{ __('fin-sentinel::fin-sentinel.email.label.laravel') }}:        {{ $environmentContext['laravel_version'] ?? '' }}

---
{{ __('fin-sentinel::fin-sentinel.email.footer') }} | {{ $environmentContext['timestamp'] ?? '' }}
