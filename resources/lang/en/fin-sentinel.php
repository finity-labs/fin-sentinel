<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Settings',
        'error_channel' => 'Error Channel',
        'error_channel_title' => 'Error Channel Settings',
        'debug_channel' => 'Debug Channel',
        'debug_channel_title' => 'Debug Channel Settings',
        'system_logs' => 'System Logs',
        'log_files' => 'Log Files',
        'log_entries' => 'Log Entries',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Emergency',
            'ALERT' => 'Alert',
            'CRITICAL' => 'Critical',
            'ERROR' => 'Error',
            'WARNING' => 'Warning',
            'NOTICE' => 'Notice',
            'INFO' => 'Info',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Error Notification',
            'debug' => 'Debug',
            'log_file' => 'Log File',
        ],
        'footer' => 'Sent by Fin-Sentinel',

        'label' => [
            'error_message' => 'Error Message',
            'class' => 'Class',
            'file' => 'File',
            'context' => 'Context',
            'command' => 'Command',
            'url' => 'URL',
            'method' => 'Method',
            'ip' => 'IP',
            'params' => 'Params',
            'headers' => 'Headers',
            'name' => 'Name',
            'email' => 'Email',
            'id' => 'ID',
            'user' => 'User',
            'environment' => 'Environment',
            'debug_mode' => 'Debug Mode',
            'php_version' => 'PHP Version',
            'laravel_version' => 'Laravel Version',
            'laravel' => 'Laravel',
            'peak_memory' => 'Peak Memory',
            'enabled' => 'Enabled',
            'disabled' => 'Disabled',
            'relation' => 'Relation: :name',
            'bindings' => 'Bindings:',
            'trace_number' => '#',
            'trace_location' => 'Location',
            'trace_call' => 'Call',
        ],

        'collection' => [
            'count' => ':count item|:count items',
            'more' => '... and :count more items',
        ],

        'error' => [
            'subject' => ':app - An error has occurred',
            'guest' => 'Guest',
            'console' => 'Console',
            'section_exception' => 'Exception Details',
            'section_trace' => 'Stack Trace',
            'section_request' => 'Request Context',
            'section_user' => 'Authenticated User',
            'section_environment' => 'Environment',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Guest',
            'console' => 'Console',
            'section_data' => 'Debug Data',
            'section_call_site' => 'Call Site',
            'section_request' => 'Request Context',
            'section_environment' => 'Environment',
        ],

        'log_file' => [
            'subject' => ':app - Log file: :file',
            'bulk_subject' => ':app - :count log files attached',
            'body' => 'Log file <strong>:file</strong> from :app is attached.',
            'body_text' => 'Log file :file from :app is attached.',
        ],
    ],

    'settings' => [
        'recipients' => 'Recipients',
        'throttling' => 'Throttling',
        'email_address' => 'Email address',
        'add_recipient' => 'Add recipient',
        'no_recipients_warning' => 'No recipients configured — notifications won\'t be sent until at least one email is added.',
        'throttle_rate' => 'Throttle rate',
        'minutes_suffix' => 'minutes',

        'error' => [
            'enabled' => 'Enable error notifications',
            'enabled_helper' => 'When disabled, no error emails will be sent.',
            'recipients_helper' => 'Add email addresses that will receive error notifications.',
            'throttle_helper' => 'Minimum minutes between duplicate error emails.',
            'throttle_exceptions' => 'Throttle exceptions',
            'throttle_exceptions_helper' => 'When enabled, duplicate exceptions at the same file:line won\'t trigger emails within the throttle window.',
            'throttle_log_messages' => 'Throttle log messages',
            'throttle_log_messages_helper' => 'When enabled, identical error log messages won\'t trigger emails within the throttle window.',
            'ignored_exceptions' => 'Ignored Exceptions',
            'ignored_exceptions_description' => 'Exceptions in this list will not trigger email notifications.',
            'ignored_exceptions_label' => 'Ignored exceptions',
            'other_custom' => 'Other (custom)',
            'exception_class' => 'Exception class (FQCN)',
            'class_not_exist' => 'This class does not exist.',
            'custom_exception' => 'Custom exception',
            'select_exception' => 'Select exception',
            'add_exception' => 'Add exception',
        ],

        'debug' => [
            'enabled' => 'Enable debug channel',
            'enabled_helper' => 'When disabled, Sentinel::debug() calls will be silently ignored.',
            'recipients_helper' => 'Add email addresses that will receive debug notifications.',
            'throttle_enabled' => 'Enable throttling',
            'throttle_enabled_helper' => 'When disabled, every debug call sends an email. When enabled, duplicate calls are throttled.',
            'throttle_helper' => 'Minimum minutes between duplicate debug emails.',
        ],

        'test_email' => [
            'send' => 'Send Test Email',
            'sent' => 'Test email sent to :count recipient(s)',
            'no_recipients' => 'No recipients configured. Add at least one email address first.',
            'failed' => 'Failed to send test email',
            'channel_disabled' => 'This channel is currently disabled. The test email will still be sent.',
        ],
    ],

    'logs' => [
        'title' => 'System Logs',
        'heading' => 'Log Files',
        'entries_title' => 'Log Entries',
        'back_to_list' => 'Back to Log Files',
        'no_entries' => 'No log entries found',
        'unsupported_format' => 'This file does not appear to use the standard Laravel log format',
        'search_placeholder' => 'Search log entries...',
        'level_filter' => 'Log Level',
        'email_recipient' => 'Recipient Email',
        'email_description' => 'Send this log file as an email attachment to the specified recipient.',
        'bulk_email_description' => 'Send the selected log files as individual email attachments to the specified recipient.',
        'bulk_email_files' => 'Selected Files',

        'filter' => [
            'date_from' => 'From',
            'date_to' => 'To',
        ],

        'column' => [
            'filename' => 'Filename',
            'size' => 'Size',
            'modified' => 'Last Modified',
            'subfolder' => 'Subfolder',
            'level' => 'Level',
            'timestamp' => 'Timestamp',
            'message' => 'Message',
        ],

        'action' => [
            'refresh' => 'Refresh',
            'view' => 'View',
            'delete' => 'Delete',
            'download' => 'Download',
            'email' => 'Email To',
            'email_send' => 'Send',
            'email_sent' => 'Log file emailed successfully',
            'bulk_email_sent' => ':count log file(s) emailed successfully',
            'deleted' => 'Log file deleted',
            'bulk_deleted' => ':count log file(s) deleted',
        ],

        'confirm' => [
            'delete' => 'Are you sure you want to delete this log file? This action cannot be undone.',
            'bulk_delete' => 'Are you sure you want to delete the selected log files? This action cannot be undone.',
        ],

        'entry' => [
            'detail' => 'Entry Detail',
            'line' => 'Line',
            'trace_frames' => ':count frame|:count frames',
            'copy_trace' => 'Copy Stack Trace',
            'copy_entry' => 'Copy Full Entry',
            'copied' => 'Copied!',
        ],
    ],

];
