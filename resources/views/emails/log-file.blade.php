<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $appName }} - {{ __('fin-sentinel::fin-sentinel.email.header.log_file') }}</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f7; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #333333; font-size: 14px; line-height: 1.6;">

<table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f4f7; padding: 24px 0;">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 6px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">

                {{-- Header --}}
                <tr>
                    <td style="background-color: #0d6efd; padding: 20px 24px; color: #ffffff; font-size: 18px; font-weight: bold;">
                        {{ $appName }} &mdash; {{ __('fin-sentinel::fin-sentinel.email.header.log_file') }}
                    </td>
                </tr>

                {{-- Content --}}
                <tr>
                    <td style="padding: 20px 24px;">
                        <p>{!! __('fin-sentinel::fin-sentinel.email.log_file.body', ['file' => $fileName, 'app' => $appName]) !!}</p>
                    </td>
                </tr>

                {{-- Footer --}}
                <tr>
                    <td style="padding: 16px 24px; background-color: #f8f9fa; font-size: 12px; color: #999999; text-align: center;">
                        {{ now()->toDateTimeString() }} ({{ config('app.timezone', 'UTC') }})
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>

</body>
</html>
