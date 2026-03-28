<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'ការកំណត់',
        'error_channel' => 'ឆានែលកំហុស',
        'error_channel_title' => 'ការកំណត់ឆានែលកំហុស',
        'debug_channel' => 'ឆានែល Debug',
        'debug_channel_title' => 'ការកំណត់ឆានែល Debug',
        'system_logs' => 'កំណត់ត្រាប្រព័ន្ធ',
        'log_files' => 'ឯកសារកំណត់ត្រា',
        'log_entries' => 'ធាតុកំណត់ត្រា',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'បន្ទាន់',
            'ALERT' => 'ការជូនដំណឹង',
            'CRITICAL' => 'ធ្ងន់ធ្ងរ',
            'ERROR' => 'កំហុស',
            'WARNING' => 'ការព្រមាន',
            'NOTICE' => 'សេចក្តីជូនដំណឹង',
            'INFO' => 'ព័ត៌មាន',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'ការជូនដំណឹងកំហុស',
            'debug' => 'Debug',
            'log_file' => 'ឯកសារកំណត់ត្រា',
        ],
        'footer' => 'ផ្ញើដោយ Fin-Sentinel',

        'label' => [
            'error_message' => 'សារកំហុស',
            'class' => 'ថ្នាក់',
            'file' => 'ឯកសារ',
            'context' => 'បរិបទ',
            'command' => 'ពាក្យបញ្ជា',
            'url' => 'URL',
            'method' => 'វិធីសាស្ត្រ',
            'ip' => 'IP',
            'params' => 'ប៉ារ៉ាម៉ែត្រ',
            'headers' => 'បឋមកថា',
            'name' => 'ឈ្មោះ',
            'email' => 'អ៊ីមែល',
            'id' => 'ID',
            'user' => 'អ្នកប្រើប្រាស់',
            'environment' => 'បរិស្ថាន',
            'debug_mode' => 'របៀប Debug',
            'php_version' => 'កំណែ PHP',
            'laravel_version' => 'កំណែ Laravel',
            'laravel' => 'Laravel',
            'peak_memory' => 'អង្គចងចាំអតិបរមា',
            'enabled' => 'បើក',
            'disabled' => 'បិទ',
            'relation' => 'ទំនាក់ទំនង: :name',
            'bindings' => 'ការចង:',
            'trace_number' => '#',
            'trace_location' => 'ទីតាំង',
            'trace_call' => 'ការហៅ',
        ],

        'collection' => [
            'count' => ':count ធាតុ',
            'more' => '... និង :count ធាតុទៀត',
        ],

        'error' => [
            'subject' => ':app - មានកំហុសកើតឡើង',
            'guest' => 'ភ្ញៀវ',
            'console' => 'Console',
            'section_exception' => 'ព័ត៌មានលម្អិតអំពីករណីលើកលែង',
            'section_trace' => 'Stack Trace',
            'section_request' => 'បរិបទសំណើ',
            'section_user' => 'អ្នកប្រើប្រាស់ដែលបានផ្ទៀងផ្ទាត់',
            'section_environment' => 'បរិស្ថាន',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'ភ្ញៀវ',
            'console' => 'Console',
            'section_data' => 'ទិន្នន័យ Debug',
            'section_call_site' => 'ទីតាំងហៅ',
            'section_request' => 'បរិបទសំណើ',
            'section_environment' => 'បរិស្ថាន',
        ],

        'log_file' => [
            'subject' => ':app - ឯកសារកំណត់ត្រា: :file',
            'bulk_subject' => ':app - ភ្ជាប់ឯកសារកំណត់ត្រា :count ឯកសារ',
            'body' => 'ឯកសារកំណត់ត្រា <strong>:file</strong> ពី :app ត្រូវបានភ្ជាប់មកជាមួយ។',
            'body_text' => 'ឯកសារកំណត់ត្រា :file ពី :app ត្រូវបានភ្ជាប់មកជាមួយ។',
        ],
    ],

    'settings' => [
        'recipients' => 'អ្នកទទួល',
        'throttling' => 'ការកំណត់ប្រេកង់',
        'email_address' => 'អាសយដ្ឋានអ៊ីមែល',
        'add_recipient' => 'បន្ថែមអ្នកទទួល',
        'no_recipients_warning' => 'មិនទាន់មានអ្នកទទួលទេ - ការជូនដំណឹងនឹងមិនត្រូវបានផ្ញើរហូតដល់បន្ថែមអ៊ីមែលយ៉ាងហោចណាស់មួយ។',
        'throttle_rate' => 'អត្រាកំណត់',
        'minutes_suffix' => 'នាទី',

        'error' => [
            'enabled' => 'បើកការជូនដំណឹងកំហុស',
            'enabled_helper' => 'នៅពេលបិទ អ៊ីមែលកំហុសនឹងមិនត្រូវបានផ្ញើទេ។',
            'recipients_helper' => 'បន្ថែមអាសយដ្ឋានអ៊ីមែលដែលនឹងទទួលការជូនដំណឹងកំហុស។',
            'throttle_helper' => 'រយៈពេលនាទីអប្បបរមារវាងអ៊ីមែលកំហុសដែលស្ទួន។',
            'throttle_exceptions' => 'ការកំណត់ករណីលើកលែង',
            'throttle_exceptions_helper' => 'នៅពេលបើក ករណីលើកលែងស្ទួនក្នុងឯកសារ:បន្ទាត់ដូចគ្នានឹងមិនផ្ញើអ៊ីមែលក្នុងរយៈពេលកំណត់ទេ។',
            'throttle_log_messages' => 'ការកំណត់សារកំណត់ត្រា',
            'throttle_log_messages_helper' => 'នៅពេលបើក សារកំណត់ត្រាកំហុសដូចគ្នានឹងមិនផ្ញើអ៊ីមែលក្នុងរយៈពេលកំណត់ទេ។',
            'ignored_exceptions' => 'ករណីលើកលែងដែលមិនអើពើ',
            'ignored_exceptions_description' => 'ករណីលើកលែងក្នុងបញ្ជីនេះនឹងមិនផ្ញើការជូនដំណឹងអ៊ីមែលទេ។',
            'ignored_exceptions_label' => 'ករណីលើកលែងដែលមិនអើពើ',
            'other_custom' => 'ផ្សេងទៀត (ផ្ទាល់ខ្លួន)',
            'exception_class' => 'ថ្នាក់ករណីលើកលែង (FQCN)',
            'class_not_exist' => 'ថ្នាក់នេះមិនមានទេ។',
            'custom_exception' => 'ករណីលើកលែងផ្ទាល់ខ្លួន',
            'select_exception' => 'ជ្រើសរើសករណីលើកលែង',
            'add_exception' => 'បន្ថែមការលើកលែង',
        ],

        'debug' => [
            'enabled' => 'បើកឆានែល Debug',
            'enabled_helper' => 'នៅពេលបិទ ការហៅ Sentinel::debug() នឹងត្រូវបានមិនអើពើ។',
            'recipients_helper' => 'បន្ថែមអាសយដ្ឋានអ៊ីមែលដែលនឹងទទួលការជូនដំណឹង Debug។',
            'throttle_enabled' => 'បើកការកំណត់ប្រេកង់',
            'throttle_enabled_helper' => 'នៅពេលបិទ ការហៅ Debug នីមួយៗនឹងផ្ញើអ៊ីមែល។ នៅពេលបើក ការហៅស្ទួននឹងត្រូវបានកំណត់។',
            'throttle_helper' => 'រយៈពេលនាទីអប្បបរមារវាងអ៊ីមែល Debug ដែលស្ទួន។',
        ],

        'test_email' => [
            'send' => 'ផ្ញើអ៊ីមែលសាកល្បង',
            'sent' => 'អ៊ីមែលសាកល្បងត្រូវបានផ្ញើទៅអ្នកទទួល :count នាក់',
            'no_recipients' => 'មិនទាន់មានអ្នកទទួលទេ។ សូមបន្ថែមអាសយដ្ឋានអ៊ីមែលយ៉ាងហោចណាស់មួយជាមុនសិន។',
            'failed' => 'បរាជ័យក្នុងការផ្ញើអ៊ីមែលសាកល្បង',
            'channel_disabled' => 'ឆានែលនេះបច្ចុប្បន្នត្រូវបានបិទ។ អ៊ីមែលសាកល្បងនឹងនៅតែត្រូវបានផ្ញើ។',
        ],
    ],

    'logs' => [
        'title' => 'កំណត់ត្រាប្រព័ន្ធ',
        'heading' => 'ឯកសារកំណត់ត្រា',
        'entries_title' => 'ធាតុកំណត់ត្រា',
        'back_to_list' => 'ត្រឡប់ទៅបញ្ជីឯកសារកំណត់ត្រា',
        'no_entries' => 'រកមិនឃើញធាតុកំណត់ត្រាទេ',
        'unsupported_format' => 'ឯកសារនេះហាក់ដូចជាមិនប្រើទម្រង់កំណត់ត្រាស្តង់ដាររបស់ Laravel ទេ',
        'search_placeholder' => 'ស្វែងរកធាតុកំណត់ត្រា...',
        'level_filter' => 'កម្រិតកំណត់ត្រា',
        'email_recipient' => 'អ៊ីមែលអ្នកទទួល',
        'email_description' => 'ផ្ញើឯកសារកំណត់ត្រានេះជាឯកសារភ្ជាប់អ៊ីមែលទៅអ្នកទទួលដែលបានបញ្ជាក់។',
        'bulk_email_description' => 'ផ្ញើឯកសារកំណត់ត្រាដែលបានជ្រើសរើសជាឯកសារភ្ជាប់អ៊ីមែលដោយឡែកទៅអ្នកទទួលដែលបានបញ្ជាក់។',
        'bulk_email_files' => 'ឯកសារដែលបានជ្រើសរើស',

        'filter' => [
            'date_from' => 'ពី',
            'date_to' => 'ដល់',
        ],

        'column' => [
            'filename' => 'ឈ្មោះឯកសារ',
            'size' => 'ទំហំ',
            'modified' => 'កែប្រែចុងក្រោយ',
            'subfolder' => 'ថតរង',
            'level' => 'កម្រិត',
            'timestamp' => 'ពេលវេលា',
            'message' => 'សារ',
        ],

        'action' => [
            'refresh' => 'ផ្ទុកឡើងវិញ',
            'view' => 'មើល',
            'delete' => 'លុប',
            'download' => 'ទាញយក',
            'email' => 'ផ្ញើអ៊ីមែល',
            'email_send' => 'ផ្ញើ',
            'email_sent' => 'ឯកសារកំណត់ត្រាត្រូវបានផ្ញើតាមអ៊ីមែលដោយជោគជ័យ',
            'bulk_email_sent' => 'ឯកសារកំណត់ត្រា :count ត្រូវបានផ្ញើតាមអ៊ីមែលដោយជោគជ័យ',
            'deleted' => 'ឯកសារកំណត់ត្រាត្រូវបានលុប',
            'bulk_deleted' => 'ឯកសារកំណត់ត្រា :count ត្រូវបានលុប',
        ],

        'confirm' => [
            'delete' => 'តើអ្នកប្រាកដថាចង់លុបឯកសារកំណត់ត្រានេះមែនទេ? សកម្មភាពនេះមិនអាចត្រឡប់វិញបានទេ។',
            'bulk_delete' => 'តើអ្នកប្រាកដថាចង់លុបឯកសារកំណត់ត្រាដែលបានជ្រើសរើសមែនទេ? សកម្មភាពនេះមិនអាចត្រឡប់វិញបានទេ។',
        ],

        'entry' => [
            'detail' => 'ព័ត៌មានលម្អិតធាតុ',
            'line' => 'បន្ទាត់',
            'trace_frames' => ':count ស៊ុម',
            'copy_trace' => 'ចម្លង Stack Trace',
            'copy_entry' => 'ចម្លងធាតុទាំងមូល',
            'copied' => 'បានចម្លង!',
        ],
    ],

];
