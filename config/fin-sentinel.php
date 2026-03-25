<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Sensitive Data Scrubbing
    |--------------------------------------------------------------------------
    |
    | Values matching these keys are redacted with [REDACTED] in error emails.
    | Each category targets a different data source. Keys are matched
    | case-insensitively.
    |
    */
    /*
    |--------------------------------------------------------------------------
    | Email Layout
    |--------------------------------------------------------------------------
    |
    | Maximum width for error and debug notification emails. These emails
    | contain stack traces and data tables that benefit from extra space.
    | The log file attachment email uses Laravel's default 600px width.
    |
    */
    'email_max_width' => '90%',

    'scrub' => [
        'params' => [
            'password',
            'password_confirmation',
            'token',
            'secret',
            '_token',
            'credit_card',
            'card_number',
            'cvv',
            'ssn',
        ],

        'headers' => [
            'authorization',
            'cookie',
            'x-api-key',
        ],

        'env' => [
            'DB_PASSWORD',
            'APP_KEY',
            'MAIL_PASSWORD',
            'AWS_SECRET_ACCESS_KEY',
        ],

        'trace_args' => [
            'password',
            'secret',
            'token',
        ],
    ],
];
