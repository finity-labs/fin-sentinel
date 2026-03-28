<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Siamṭhatna',
        'error_channel' => 'Dikthleng Channel',
        'error_channel_title' => 'Dikthleng Channel Siamṭhatna',
        'debug_channel' => 'Debug Channel',
        'debug_channel_title' => 'Debug Channel Siamṭhatna',
        'system_logs' => 'System Rawn Ziak',
        'log_files' => 'Log File-te',
        'log_entries' => 'Log Ziakluh-te',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Ṭhahnemngai',
            'ALERT' => 'Vaikhâm',
            'CRITICAL' => 'Pawi Tak',
            'ERROR' => 'Dikthleng',
            'WARNING' => 'Fimkhur',
            'NOTICE' => 'Hriatṭhiahna',
            'INFO' => 'Thildang',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Dikthleng Hriatṭhiahna',
            'debug' => 'Debug',
            'log_file' => 'Log File',
        ],
        'footer' => 'Fin-Sentinel hian a thawn',

        'label' => [
            'error_message' => 'Dikthleng Thu',
            'class' => 'Class',
            'file' => 'File',
            'context' => 'Thufing',
            'command' => 'Command',
            'url' => 'URL',
            'method' => 'Dan',
            'ip' => 'IP',
            'params' => 'Params',
            'headers' => 'Luhlutu',
            'name' => 'Hming',
            'email' => 'Email',
            'id' => 'ID',
            'user' => 'Hmangtu',
            'environment' => 'Chhuahsan ṭan',
            'debug_mode' => 'Debug Mode',
            'php_version' => 'PHP Version',
            'laravel_version' => 'Laravel Version',
            'laravel' => 'Laravel',
            'peak_memory' => 'Memory Sang Ber',
            'enabled' => 'On',
            'disabled' => 'Off',
            'relation' => 'Inlaichinna: :name',
            'bindings' => 'Bindings:',
            'trace_number' => '#',
            'trace_location' => 'Hmun',
            'trace_call' => 'Koh',
        ],

        'collection' => [
            'count' => ':count thil|:count thilte',
            'more' => '... leh :count dang',
        ],

        'error' => [
            'subject' => ':app - Dikthleng a awm',
            'guest' => 'Lengzual',
            'console' => 'Console',
            'section_exception' => 'Exception Chiang Zawk',
            'section_trace' => 'Stack Trace',
            'section_request' => 'Request Thufing',
            'section_user' => 'Hmangtu Pahnih',
            'section_environment' => 'Chhuahsan Ṭan',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Lengzual',
            'console' => 'Console',
            'section_data' => 'Debug Data',
            'section_call_site' => 'Koh Hmun',
            'section_request' => 'Request Thufing',
            'section_environment' => 'Chhuahsan Ṭan',
        ],

        'log_file' => [
            'subject' => ':app - Log file: :file',
            'bulk_subject' => ':app - Log file :count a tel',
            'body' => ':app aṭangin log file <strong>:file</strong> a tel a ni.',
            'body_text' => ':app aṭangin log file :file a tel a ni.',
        ],
    ],

    'settings' => [
        'recipients' => 'Dawngtu',
        'throttling' => 'Throttling',
        'email_address' => 'Email address',
        'add_recipient' => 'Recipient dah belh',
        'no_recipients_warning' => 'Dawngtu siamṭhat a ni lo — email pakhat tal a siam phawt loh chuan hriatṭhiahna thawn a ni lovang.',
        'throttle_rate' => 'Throttle sang zat',
        'minutes_suffix' => 'minit',

        'error' => [
            'enabled' => 'Dikthleng hriatṭhiahna on rawh',
            'enabled_helper' => 'Off a nih chuan dikthleng email thawn a ni lovang.',
            'recipients_helper' => 'Dikthleng hriatṭhiahna dawn tur email address te hi bun rawh.',
            'throttle_helper' => 'Dikthleng email bangbang inkar minit tlem ber.',
            'throttle_exceptions' => 'Exception throttling',
            'throttle_exceptions_helper' => 'On a nih chuan, file:line khat ah exception bangbang hian throttle window chhunga email a thawn lovang.',
            'throttle_log_messages' => 'Log thu throttling',
            'throttle_log_messages_helper' => 'On a nih chuan, dikthleng log thu bangbang hian throttle window chhunga email a thawn lovang.',
            'ignored_exceptions' => 'Exception Ngaihtuah Loh',
            'ignored_exceptions_description' => 'He list-a exception te hian email hriatṭhiahna a thawn lovang.',
            'ignored_exceptions_label' => 'Exception ngaihtuah loh',
            'other_custom' => 'Dang (custom)',
            'exception_class' => 'Exception class (FQCN)',
            'class_not_exist' => 'He class hi a awm lo.',
            'custom_exception' => 'Custom exception',
            'select_exception' => 'Exception thlang rawh',
            'add_exception' => 'Exception dah belh',
        ],

        'debug' => [
            'enabled' => 'Debug channel on rawh',
            'enabled_helper' => 'Off a nih chuan Sentinel::debug() kohna te hi ngaihdamchhuah a ni ang.',
            'recipients_helper' => 'Debug hriatṭhiahna dawn tur email address te hi bun rawh.',
            'throttle_enabled' => 'Throttling on rawh',
            'throttle_enabled_helper' => 'Off a nih chuan Debug kohna tin hian email a thawn ang. On a nih chuan kohna bangbang te hi throttle a ni ang.',
            'throttle_helper' => 'Debug email bangbang inkar minit tlem ber.',
        ],

        'test_email' => [
            'send' => 'Test Email Thawn Rawh',
            'sent' => 'Dawngtu :count hnena test email thawn a ni',
            'no_recipients' => 'Dawngtu siamṭhat a ni lo. Email address pakhat tal bun hmasa rawh.',
            'failed' => 'Test email thawn theih a ni lo',
            'channel_disabled' => 'He channel hi tun ah off a ni. Test email thawn a ni ngei ang.',
        ],
    ],

    'logs' => [
        'title' => 'System Rawn Ziak',
        'heading' => 'Log File-te',
        'entries_title' => 'Log Ziakluh-te',
        'back_to_list' => 'Log File-te ah kir leh rawh',
        'no_entries' => 'Log ziakluh hmuh a ni lo',
        'unsupported_format' => 'He file hian Laravel log format pangngai a hman lo niin a lang',
        'search_placeholder' => 'Log ziakluh-te zawng rawh...',
        'level_filter' => 'Log Level',
        'email_recipient' => 'Dawngtu Email',
        'email_description' => 'He log file hi dawngtu sawh hnena email attachment a thawn rawh.',
        'bulk_email_description' => 'Log file thlang te hi dawngtu sawh hnena email attachment hrang hrangin thawn rawh.',
        'bulk_email_files' => 'File Thlang Te',

        'filter' => [
            'date_from' => 'Aṭang',
            'date_to' => 'Thleng',
        ],

        'column' => [
            'filename' => 'File Hming',
            'size' => 'Pui Zat',
            'modified' => 'Thlak Hnuhnung Ber',
            'subfolder' => 'Subfolder',
            'level' => 'Level',
            'timestamp' => 'Hun',
            'message' => 'Thu',
        ],

        'action' => [
            'refresh' => 'Thar Thlak',
            'view' => 'En Rawh',
            'delete' => 'Paih Rawh',
            'download' => 'Download',
            'email' => 'Email Thawn Rawh',
            'email_send' => 'Thawn Rawh',
            'email_sent' => 'Log file email a thawn zo',
            'bulk_email_sent' => 'Log file :count email a thawn zo',
            'deleted' => 'Log file paih a ni',
            'bulk_deleted' => 'Log file :count paih a ni',
        ],

        'confirm' => [
            'delete' => 'He log file hi paih i duh em? He thil tih hi thlak leh theih a ni lo.',
            'bulk_delete' => 'Log file thlang te hi paih i duh em? He thil tih hi thlak leh theih a ni lo.',
        ],

        'entry' => [
            'detail' => 'Ziakluh Chiang Zawk',
            'line' => 'Line',
            'trace_frames' => 'frame :count|frame :count',
            'copy_trace' => 'Stack Trace Dawr Rawh',
            'copy_entry' => 'Ziakluh Pum Dawr Rawh',
            'copied' => 'Dawr zo!',
        ],
    ],

];
