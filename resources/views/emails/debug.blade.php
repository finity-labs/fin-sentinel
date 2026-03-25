<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} - {{ __('fin-sentinel::fin-sentinel.email_header_debug') }}</title>
</head>
<body style="margin: 0; padding: 0; background-color: #eef2f7; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #333333; font-size: 14px; line-height: 1.6;">

<table width="100%" cellpadding="0" cellspacing="0" style="background-color: #eef2f7; padding: 24px 0;">
    <tr>
        <td align="center">
            <table width="100%" cellpadding="0" cellspacing="0" style="max-width: {{ config('fin-sentinel.email_max_width', '90%') }}; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">

                {{-- Header --}}
                <tr>
                    <td style="background: linear-gradient(135deg, #4f46e5, #6366f1); background-color: #4f46e5; padding: 20px 24px; color: #ffffff; font-size: 18px; font-weight: bold;">
                        {{ config('app.name', 'Laravel') }} &mdash; {{ __('fin-sentinel::fin-sentinel.email_header_debug') }}
                    </td>
                </tr>

                {{-- Formatted Data --}}
                <tr>
                    <td style="padding: 20px 24px; border-bottom: 1px solid #e5e7eb;">
                        <div style="font-size: 15px; font-weight: 600; margin-bottom: 10px; color: #4f46e5;">{{ __('fin-sentinel::fin-sentinel.debug_section_data') }}</div>

                        @if($formattedData['type'] === 'model')
                            <div style="font-size: 12px; color: #6b7280; margin-bottom: 6px; font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace;">{{ $formattedData['class'] }}</div>
                            <table width="100%" cellpadding="6" cellspacing="0" style="font-size: 13px; border: 1px solid #e5e7eb; border-radius: 4px; border-collapse: collapse;">
                                @foreach($formattedData['attributes'] as $key => $value)
                                <tr style="border-bottom: 1px solid #f3f4f6;">
                                    <td style="width: 140px; font-weight: 600; vertical-align: top; color: #4b5563; background-color: #f9fafb; padding: 6px 10px;">{{ $key }}</td>
                                    <td style="font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace; word-break: break-word; padding: 6px 10px;">{{ is_array($value) || is_object($value) ? json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : $value }}</td>
                                </tr>
                                @endforeach
                            </table>
                            @if(!empty($formattedData['relations']))
                                @foreach($formattedData['relations'] as $relationName => $relationData)
                                <div style="margin-top: 12px; font-size: 12px; font-weight: 600; color: #6b7280;">{{ __('fin-sentinel::fin-sentinel.email_label_relation', ['name' => $relationName]) }}</div>
                                <div style="background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 4px; padding: 10px; margin-top: 4px; font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace; font-size: 12px; white-space: pre-wrap; word-break: break-word;">{{ json_encode($relationData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</div>
                                @endforeach
                            @endif

                        @elseif($formattedData['type'] === 'collection')
                            <div style="display: inline-block; background-color: #eef2ff; color: #4f46e5; font-size: 12px; font-weight: 600; padding: 2px 10px; border-radius: 12px; margin-bottom: 8px;">{{ trans_choice('fin-sentinel::fin-sentinel.email_collection_count', $formattedData['count'], ['count' => $formattedData['count']]) }}</div>
                            @foreach(array_slice($formattedData['items'], 0, 20) as $index => $item)
                                <div style="margin-top: 8px; padding: 10px; background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 4px;">
                                    <div style="font-size: 11px; color: #9ca3af; margin-bottom: 4px;">#{{ $index }} ({{ $item['type'] }})</div>
                                    @if($item['type'] === 'model')
                                        <div style="font-size: 12px; color: #6b7280; font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace;">{{ $item['class'] }}</div>
                                        <div style="font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace; font-size: 12px; white-space: pre-wrap; word-break: break-word; margin-top: 4px;">{{ json_encode($item['attributes'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</div>
                                    @elseif($item['type'] === 'scalar')
                                        <div style="font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace; font-size: 13px;">{{ $item['value'] }}</div>
                                    @else
                                        <div style="font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace; font-size: 12px; white-space: pre-wrap; word-break: break-word;">{{ json_encode($item['data'] ?? $item, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</div>
                                    @endif
                                </div>
                            @endforeach
                            @if($formattedData['count'] > 20)
                                <div style="margin-top: 8px; font-size: 13px; color: #9ca3af; font-style: italic;">{{ __('fin-sentinel::fin-sentinel.email_collection_more', ['count' => $formattedData['count'] - 20]) }}</div>
                            @endif

                        @elseif($formattedData['type'] === 'query')
                            <div style="background-color: #1e1b4b; color: #c7d2fe; border-radius: 4px; padding: 14px; font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace; font-size: 13px; white-space: pre-wrap; word-break: break-word;">{{ $formattedData['sql'] }}</div>
                            @if(!empty($formattedData['bindings']))
                                <div style="margin-top: 8px; font-size: 12px; color: #6b7280;">{{ __('fin-sentinel::fin-sentinel.email_label_bindings') }}</div>
                                <div style="background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 4px; padding: 8px 12px; font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace; font-size: 12px;">{{ json_encode($formattedData['bindings'], JSON_UNESCAPED_SLASHES) }}</div>
                            @endif

                        @elseif($formattedData['type'] === 'array')
                            <div style="background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 4px; padding: 14px; font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace; font-size: 12px; white-space: pre-wrap; word-break: break-word;">{{ json_encode($formattedData['data'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</div>

                        @elseif($formattedData['type'] === 'scalar')
                            <div style="background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 4px; padding: 14px; font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace; font-size: 14px;">{{ $formattedData['value'] }}</div>
                        @endif
                    </td>
                </tr>

                {{-- Call Site --}}
                <tr>
                    <td style="padding: 12px 24px; background-color: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                        <div style="font-size: 12px; color: #6b7280;">
                            <span style="font-weight: 600;">{{ __('fin-sentinel::fin-sentinel.debug_section_call_site') }}:</span>
                            <span style="font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace;">{{ $callSite['file'] ?? '' }}:{{ $callSite['line'] ?? '' }}</span>
                        </div>
                    </td>
                </tr>

                {{-- Request Context --}}
                <tr>
                    <td style="padding: 16px 24px; border-bottom: 1px solid #e5e7eb;">
                        <div style="font-size: 13px; font-weight: 600; margin-bottom: 6px; color: #6b7280;">{{ __('fin-sentinel::fin-sentinel.debug_section_request') }}</div>
                        <table width="100%" cellpadding="4" cellspacing="0" style="font-size: 13px;">
                            @if(isset($requestContext['context']))
                                <tr>
                                    <td style="width: 70px; font-weight: 600; color: #6b7280;">{{ __('fin-sentinel::fin-sentinel.email_label_context') }}</td>
                                    <td>{{ $requestContext['context'] }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 70px; font-weight: 600; color: #6b7280;">{{ __('fin-sentinel::fin-sentinel.email_label_command') }}</td>
                                    <td style="font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace;">{{ $requestContext['command'] }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td style="width: 70px; font-weight: 600; color: #6b7280;">{{ __('fin-sentinel::fin-sentinel.email_label_url') }}</td>
                                    <td style="word-break: break-all;">{{ $requestContext['url'] ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 70px; font-weight: 600; color: #6b7280;">{{ __('fin-sentinel::fin-sentinel.email_label_method') }}</td>
                                    <td>{{ $requestContext['method'] ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 70px; font-weight: 600; color: #6b7280;">{{ __('fin-sentinel::fin-sentinel.email_label_user') }}</td>
                                    <td>{{ $requestContext['user'] ?? '' }}</td>
                                </tr>
                            @endif
                        </table>
                    </td>
                </tr>

                {{-- Environment --}}
                <tr>
                    <td style="padding: 16px 24px; border-bottom: 1px solid #e5e7eb;">
                        <div style="font-size: 13px; font-weight: 600; margin-bottom: 6px; color: #6b7280;">{{ __('fin-sentinel::fin-sentinel.debug_section_environment') }}</div>
                        <table width="100%" cellpadding="4" cellspacing="0" style="font-size: 13px;">
                            <tr>
                                <td style="width: 110px; font-weight: 600; color: #6b7280;">{{ __('fin-sentinel::fin-sentinel.email_label_environment') }}</td>
                                <td>{{ $environmentContext['app_env'] ?? '' }}</td>
                            </tr>
                            <tr>
                                <td style="width: 110px; font-weight: 600; color: #6b7280;">{{ __('fin-sentinel::fin-sentinel.email_label_php_version') }}</td>
                                <td>{{ $environmentContext['php_version'] ?? '' }}</td>
                            </tr>
                            <tr>
                                <td style="width: 110px; font-weight: 600; color: #6b7280;">{{ __('fin-sentinel::fin-sentinel.email_label_laravel') }}</td>
                                <td>{{ $environmentContext['laravel_version'] ?? '' }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                {{-- Footer --}}
                <tr>
                    <td style="padding: 14px 24px; background-color: #f3f4f6; font-size: 12px; color: #9ca3af; text-align: center;">
                        {{ __('fin-sentinel::fin-sentinel.email_footer') }} &middot; {{ $environmentContext['timestamp'] ?? '' }}
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>

</body>
</html>
