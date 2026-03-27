<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} - {{ __('fin-sentinel::fin-sentinel.email.header.error') }}</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f7; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #333333; font-size: 14px; line-height: 1.6;">

<table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f4f7; padding: 24px 0;">
    <tr>
        <td align="center">
            <table width="100%" cellpadding="0" cellspacing="0" style="max-width: {{ config('fin-sentinel.email_max_width', '90%') }}; background-color: #ffffff; border-radius: 6px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">

                {{-- Header --}}
                <tr>
                    <td style="background-color: #dc3545; padding: 20px 24px; color: #ffffff; font-size: 18px; font-weight: bold;">
                        {{ config('app.name', 'Laravel') }} &mdash; {{ __('fin-sentinel::fin-sentinel.email.header.error') }}
                    </td>
                </tr>

                {{-- Error Message --}}
                <tr>
                    <td style="padding: 20px 24px; border-bottom: 1px solid #e9ecef;">
                        <div style="font-size: 15px; font-weight: 600; margin-bottom: 8px; color: #555555;">{{ __('fin-sentinel::fin-sentinel.email.label.error_message') }}</div>
                        <div style="background-color: #fff3cd; border-left: 4px solid #ffc107; padding: 12px 16px; font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace; font-size: 13px; word-break: break-word;">
                            {{ $errorMessage }}
                        </div>
                    </td>
                </tr>

                {{-- Exception Details --}}
                @if($exceptionClass)
                <tr>
                    <td style="padding: 20px 24px; border-bottom: 1px solid #e9ecef;">
                        <div style="font-size: 15px; font-weight: 600; margin-bottom: 8px; color: #555555;">{{ __('fin-sentinel::fin-sentinel.email.error.section_exception') }}</div>
                        <table width="100%" cellpadding="6" cellspacing="0" style="font-size: 13px;">
                            <tr>
                                <td style="width: 80px; font-weight: 600; vertical-align: top; color: #666666;">{{ __('fin-sentinel::fin-sentinel.email.label.class') }}</td>
                                <td style="font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace; word-break: break-all;">{{ $exceptionClass }}</td>
                            </tr>
                            <tr>
                                <td style="width: 80px; font-weight: 600; vertical-align: top; color: #666666;">{{ __('fin-sentinel::fin-sentinel.email.label.file') }}</td>
                                <td style="font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace; word-break: break-all;">{{ $exceptionFile }}:{{ $exceptionLine }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                @endif

                {{-- Stack Trace --}}
                @if($stackTrace)
                <tr>
                    <td style="padding: 20px 24px; border-bottom: 1px solid #e9ecef;">
                        <div style="font-size: 15px; font-weight: 600; margin-bottom: 8px; color: #555555;">{{ __('fin-sentinel::fin-sentinel.email.error.section_trace') }}</div>
                        <div style="max-height: 400px; overflow: auto; background-color: #f8f9fa; border-radius: 4px; padding: 12px;">
                            <table width="100%" cellpadding="4" cellspacing="0" style="font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace; font-size: 11px; border-collapse: collapse;">
                                <tr style="background-color: #e9ecef; font-weight: 600;">
                                    <td style="padding: 4px 8px;">{{ __('fin-sentinel::fin-sentinel.email.label.trace_number') }}</td>
                                    <td style="padding: 4px 8px;">{{ __('fin-sentinel::fin-sentinel.email.label.trace_location') }}</td>
                                    <td style="padding: 4px 8px;">{{ __('fin-sentinel::fin-sentinel.email.label.trace_call') }}</td>
                                </tr>
                                @foreach($stackTrace as $index => $frame)
                                <tr style="border-bottom: 1px solid #e9ecef;">
                                    <td style="padding: 4px 8px; vertical-align: top; color: #999999;">{{ $index }}</td>
                                    <td style="padding: 4px 8px; vertical-align: top; word-break: break-all;">{{ $frame['file'] ?? '?' }}:{{ $frame['line'] ?? '?' }}</td>
                                    <td style="padding: 4px 8px; vertical-align: top; word-break: break-all;">{{ $frame['class'] ?? '' }}{{ $frame['class'] ? '::' : '' }}{{ $frame['function'] ?? '' }}()</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </td>
                </tr>
                @endif

                {{-- Request Context --}}
                <tr>
                    <td style="padding: 20px 24px; border-bottom: 1px solid #e9ecef;">
                        <div style="font-size: 15px; font-weight: 600; margin-bottom: 8px; color: #555555;">{{ __('fin-sentinel::fin-sentinel.email.error.section_request') }}</div>
                        <table width="100%" cellpadding="6" cellspacing="0" style="font-size: 13px;">
                            @if(isset($requestContext['context']))
                                <tr>
                                    <td style="width: 80px; font-weight: 600; vertical-align: top; color: #666666;">{{ __('fin-sentinel::fin-sentinel.email.label.context') }}</td>
                                    <td>{{ $requestContext['context'] }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 80px; font-weight: 600; vertical-align: top; color: #666666;">{{ __('fin-sentinel::fin-sentinel.email.label.command') }}</td>
                                    <td style="font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace;">{{ $requestContext['command'] }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td style="width: 80px; font-weight: 600; vertical-align: top; color: #666666;">{{ __('fin-sentinel::fin-sentinel.email.label.url') }}</td>
                                    <td style="word-break: break-all;">{{ $requestContext['url'] ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 80px; font-weight: 600; vertical-align: top; color: #666666;">{{ __('fin-sentinel::fin-sentinel.email.label.method') }}</td>
                                    <td>{{ $requestContext['method'] ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 80px; font-weight: 600; vertical-align: top; color: #666666;">{{ __('fin-sentinel::fin-sentinel.email.label.ip') }}</td>
                                    <td>{{ $requestContext['ip'] ?? '' }}</td>
                                </tr>
                                @if(!empty($requestContext['params']))
                                <tr>
                                    <td style="width: 80px; font-weight: 600; vertical-align: top; color: #666666;">{{ __('fin-sentinel::fin-sentinel.email.label.params') }}</td>
                                    <td style="font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace; font-size: 12px;">
                                        <pre style="margin: 0; white-space: pre-wrap; word-break: break-word;">{{ json_encode($requestContext['params'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                                    </td>
                                </tr>
                                @endif
                                @if(!empty($requestContext['headers']))
                                <tr>
                                    <td style="width: 80px; font-weight: 600; vertical-align: top; color: #666666;">{{ __('fin-sentinel::fin-sentinel.email.label.headers') }}</td>
                                    <td style="font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace; font-size: 12px;">
                                        <pre style="margin: 0; white-space: pre-wrap; word-break: break-word;">{{ json_encode($requestContext['headers'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                                    </td>
                                </tr>
                                @endif
                            @endif
                        </table>
                    </td>
                </tr>

                {{-- Authenticated User --}}
                <tr>
                    <td style="padding: 20px 24px; border-bottom: 1px solid #e9ecef;">
                        <div style="font-size: 15px; font-weight: 600; margin-bottom: 8px; color: #555555;">{{ __('fin-sentinel::fin-sentinel.email.error.section_user') }}</div>
                        <table width="100%" cellpadding="6" cellspacing="0" style="font-size: 13px;">
                            <tr>
                                <td style="width: 80px; font-weight: 600; vertical-align: top; color: #666666;">{{ __('fin-sentinel::fin-sentinel.email.label.name') }}</td>
                                <td>{{ $userContext['name'] ?? '' }}</td>
                            </tr>
                            @if(isset($userContext['email']))
                            <tr>
                                <td style="width: 80px; font-weight: 600; vertical-align: top; color: #666666;">{{ __('fin-sentinel::fin-sentinel.email.label.email') }}</td>
                                <td>{{ $userContext['email'] }}</td>
                            </tr>
                            @endif
                            @if(isset($userContext['id']))
                            <tr>
                                <td style="width: 80px; font-weight: 600; vertical-align: top; color: #666666;">{{ __('fin-sentinel::fin-sentinel.email.label.id') }}</td>
                                <td>{{ $userContext['id'] }}</td>
                            </tr>
                            @endif
                        </table>
                    </td>
                </tr>

                {{-- Environment --}}
                <tr>
                    <td style="padding: 20px 24px; border-bottom: 1px solid #e9ecef;">
                        <div style="font-size: 15px; font-weight: 600; margin-bottom: 8px; color: #555555;">{{ __('fin-sentinel::fin-sentinel.email.error.section_environment') }}</div>
                        <table width="100%" cellpadding="6" cellspacing="0" style="font-size: 13px;">
                            <tr>
                                <td style="width: 120px; font-weight: 600; vertical-align: top; color: #666666;">{{ __('fin-sentinel::fin-sentinel.email.label.environment') }}</td>
                                <td>{{ $environmentContext['app_env'] ?? '' }}</td>
                            </tr>
                            <tr>
                                <td style="width: 120px; font-weight: 600; vertical-align: top; color: #666666;">{{ __('fin-sentinel::fin-sentinel.email.label.debug_mode') }}</td>
                                <td>{{ $environmentContext['app_debug'] ? __('fin-sentinel::fin-sentinel.email.label.enabled') : __('fin-sentinel::fin-sentinel.email.label.disabled') }}</td>
                            </tr>
                            <tr>
                                <td style="width: 120px; font-weight: 600; vertical-align: top; color: #666666;">{{ __('fin-sentinel::fin-sentinel.email.label.php_version') }}</td>
                                <td>{{ $environmentContext['php_version'] ?? '' }}</td>
                            </tr>
                            <tr>
                                <td style="width: 120px; font-weight: 600; vertical-align: top; color: #666666;">{{ __('fin-sentinel::fin-sentinel.email.label.laravel_version') }}</td>
                                <td>{{ $environmentContext['laravel_version'] ?? '' }}</td>
                            </tr>
                            <tr>
                                <td style="width: 120px; font-weight: 600; vertical-align: top; color: #666666;">{{ __('fin-sentinel::fin-sentinel.email.label.peak_memory') }}</td>
                                <td>{{ $environmentContext['memory_peak'] ?? '' }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                {{-- Footer --}}
                <tr>
                    <td style="padding: 16px 24px; background-color: #f8f9fa; font-size: 12px; color: #999999; text-align: center;">
                        {{ $environmentContext['timestamp'] ?? '' }}
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>

</body>
</html>
