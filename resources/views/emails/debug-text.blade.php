{{ config('app.name', 'Laravel') }} - Debug
============================================

{{ __('fin-sentinel::fin-sentinel.debug_section_data') }}
----------
@if($formattedData['type'] === 'model')
Type: Model ({{ $formattedData['class'] }})

Attributes:
@foreach($formattedData['attributes'] as $key => $value)
  {{ $key }}: {{ is_array($value) || is_object($value) ? json_encode($value, JSON_UNESCAPED_SLASHES) : $value }}
@endforeach
@if(!empty($formattedData['relations']))

Relations:
@foreach($formattedData['relations'] as $relationName => $relationData)
  {{ $relationName }}: {{ json_encode($relationData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}
@endforeach
@endif
@elseif($formattedData['type'] === 'collection')
Type: Collection ({{ $formattedData['count'] }} {{ $formattedData['count'] === 1 ? 'item' : 'items' }})

@foreach(array_slice($formattedData['items'], 0, 20) as $index => $item)
#{{ $index }} ({{ $item['type'] }})
@if($item['type'] === 'model')
  Class: {{ $item['class'] }}
  {{ json_encode($item['attributes'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}
@elseif($item['type'] === 'scalar')
  {{ $item['value'] }}
@else
  {{ json_encode($item['data'] ?? $item, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}
@endif

@endforeach
@if($formattedData['count'] > 20)
... and {{ $formattedData['count'] - 20 }} more items
@endif
@elseif($formattedData['type'] === 'query')
Type: Query

SQL: {{ $formattedData['sql'] }}
@if(!empty($formattedData['bindings']))
Bindings: {{ json_encode($formattedData['bindings'], JSON_UNESCAPED_SLASHES) }}
@endif
@elseif($formattedData['type'] === 'array')
Type: Array

{{ json_encode($formattedData['data'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}
@elseif($formattedData['type'] === 'scalar')
Type: Scalar

{{ $formattedData['value'] }}
@endif

{{ __('fin-sentinel::fin-sentinel.debug_section_call_site') }}
---------
{{ $callSite['file'] ?? '' }}:{{ $callSite['line'] ?? '' }}

{{ __('fin-sentinel::fin-sentinel.debug_section_request') }}
---------------
@if(isset($requestContext['context']))
Context: {{ $requestContext['context'] }}
Command: {{ $requestContext['command'] }}
@else
URL:    {{ $requestContext['url'] ?? '' }}
Method: {{ $requestContext['method'] ?? '' }}
User:   {{ $requestContext['user'] ?? '' }}
@endif

{{ __('fin-sentinel::fin-sentinel.debug_section_environment') }}
-----------
Environment:    {{ $environmentContext['app_env'] ?? '' }}
PHP Version:    {{ $environmentContext['php_version'] ?? '' }}
Laravel:        {{ $environmentContext['laravel_version'] ?? '' }}

---
Sent by Fin-Sentinel | {{ $environmentContext['timestamp'] ?? '' }}
