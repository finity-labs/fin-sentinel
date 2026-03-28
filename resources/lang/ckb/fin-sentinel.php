<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'ڕێکخستنەکان',
        'error_channel' => 'کەناڵی هەڵە',
        'error_channel_title' => 'ڕێکخستنەکانی کەناڵی هەڵە',
        'debug_channel' => 'کەناڵی Debug',
        'debug_channel_title' => 'ڕێکخستنەکانی کەناڵی Debug',
        'system_logs' => 'تۆمارەکانی سیستەم',
        'log_files' => 'فایلەکانی تۆمار',
        'log_entries' => 'تۆمارەکان',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'لەناکاو',
            'ALERT' => 'ئاگاداری',
            'CRITICAL' => 'بەپەلە',
            'ERROR' => 'هەڵە',
            'WARNING' => 'ئاگادارکردنەوە',
            'NOTICE' => 'تێبینی',
            'INFO' => 'زانیاری',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'ئاگادارکردنەوەی هەڵە',
            'debug' => 'Debug',
            'log_file' => 'فایلی تۆمار',
        ],
        'footer' => 'نێردراوە لەلایەن Fin-Sentinel',

        'label' => [
            'error_message' => 'پەیامی هەڵە',
            'class' => 'کلاس',
            'file' => 'فایل',
            'context' => 'چوارچێوە',
            'command' => 'فەرمان',
            'url' => 'URL',
            'method' => 'ڕێگا',
            'ip' => 'IP',
            'params' => 'پارامیتەرەکان',
            'headers' => 'سەرپەڕەکان',
            'name' => 'ناو',
            'email' => 'ئیمەیڵ',
            'id' => 'ID',
            'user' => 'بەکارهێنەر',
            'environment' => 'ژینگە',
            'debug_mode' => 'دۆخی Debug',
            'php_version' => 'وەشانی PHP',
            'laravel_version' => 'وەشانی Laravel',
            'laravel' => 'Laravel',
            'peak_memory' => 'بەرزترین بیرگە',
            'enabled' => 'چالاک',
            'disabled' => 'ناچالاک',
            'relation' => 'پەیوەندی: :name',
            'bindings' => 'بەستنەکان:',
            'trace_number' => '#',
            'trace_location' => 'شوێن',
            'trace_call' => 'بانگکردن',
        ],

        'collection' => [
            'count' => ':count دانە|:count دانە',
            'more' => '... و :count دانەی دیکە',
        ],

        'error' => [
            'subject' => ':app - هەڵەیەک ڕوویدا',
            'guest' => 'میوان',
            'console' => 'کۆنسۆڵ',
            'section_exception' => 'وردەکاری تەواوەکە',
            'section_trace' => 'شوێنپێی ستاک',
            'section_request' => 'چوارچێوەی داواکاری',
            'section_user' => 'بەکارهێنەری پشتڕاستکراوە',
            'section_environment' => 'ژینگە',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'میوان',
            'console' => 'کۆنسۆڵ',
            'section_data' => 'داتای Debug',
            'section_call_site' => 'شوێنی بانگکردن',
            'section_request' => 'چوارچێوەی داواکاری',
            'section_environment' => 'ژینگە',
        ],

        'log_file' => [
            'subject' => ':app - فایلی تۆمار: :file',
            'bulk_subject' => ':app - :count فایلی تۆمار هاوپێچکراو',
            'body' => 'فایلی تۆمار <strong>:file</strong> لە :app هاوپێچکراوە.',
            'body_text' => 'فایلی تۆمار :file لە :app هاوپێچکراوە.',
        ],
    ],

    'settings' => [
        'recipients' => 'وەرگرەکان',
        'throttling' => 'کۆنترۆڵی خێرایی',
        'email_address' => 'ناونیشانی ئیمەیڵ',
        'add_recipient' => 'زیادکردنی وەرگر',
        'no_recipients_warning' => 'هیچ وەرگرێک دیاری نەکراوە — ئاگادارکردنەوەکان نانێردرێن تا کەمی یەک ئیمەیڵ زیاد بکرێت.',
        'throttle_rate' => 'ڕێژەی سنوور',
        'minutes_suffix' => 'خولەک',

        'error' => [
            'enabled' => 'چالاککردنی ئاگادارکردنەوەکانی هەڵە',
            'enabled_helper' => 'کاتێک ناچالاکە، هیچ ئیمەیڵێکی هەڵە نانێردرێت.',
            'recipients_helper' => 'ئەو ناونیشانە ئیمەیڵانە زیاد بکە کە ئاگادارکردنەوەکانی هەڵە وەردەگرن.',
            'throttle_helper' => 'کەمترین خولەک لەنێوان ئیمەیڵە هەڵە دووبارەکان.',
            'throttle_exceptions' => 'سنووری تەواوەکان',
            'throttle_exceptions_helper' => 'کاتێک چالاکە، تەواوە دووبارەکان لە هەمان فایل:هێڵ لە ماوەی سنووردا ئیمەیڵ نانێرن.',
            'throttle_log_messages' => 'سنووری پەیامەکانی تۆمار',
            'throttle_log_messages_helper' => 'کاتێک چالاکە، پەیامە تۆمارییە یەکسانەکان لە ماوەی سنووردا ئیمەیڵ نانێرن.',
            'ignored_exceptions' => 'تەواوەکانی پشتگوێخراو',
            'ignored_exceptions_description' => 'تەواوەکانی ئەم لیستە ئاگادارکردنەوەی ئیمەیڵ نانێرن.',
            'ignored_exceptions_label' => 'تەواوەکانی پشتگوێخراو',
            'other_custom' => 'هیتر (تایبەت)',
            'exception_class' => 'کلاسی تەواوە (FQCN)',
            'class_not_exist' => 'ئەم کلاسە بوونی نییە.',
            'custom_exception' => 'تەواوەی تایبەت',
            'select_exception' => 'تەواوە هەڵبژێرە',
            'add_exception' => 'زیادکردنی جیاوازی',
        ],

        'debug' => [
            'enabled' => 'چالاککردنی کەناڵی Debug',
            'enabled_helper' => 'کاتێک ناچالاکە، بانگکردنەکانی Sentinel::debug() بێدەنگانە پشتگوێ دەخرێن.',
            'recipients_helper' => 'ئەو ناونیشانە ئیمەیڵانە زیاد بکە کە ئاگادارکردنەوەکانی Debug وەردەگرن.',
            'throttle_enabled' => 'چالاککردنی سنوور',
            'throttle_enabled_helper' => 'کاتێک ناچالاکە، هەر بانگکردنێکی debug ئیمەیڵ دەنێرێت. کاتێک چالاکە، بانگکردنە دووبارەکان سنوور دەکرێن.',
            'throttle_helper' => 'کەمترین خولەک لەنێوان ئیمەیڵە debug دووبارەکان.',
        ],

        'test_email' => [
            'send' => 'ئیمەیڵی تاقیکاری بنێرە',
            'sent' => 'ئیمەیڵی تاقیکاری نێردرا بۆ :count وەرگر',
            'no_recipients' => 'هیچ وەرگرێک دیاری نەکراوە. سەرەتا کەمی یەک ناونیشانی ئیمەیڵ زیاد بکە.',
            'failed' => 'نەتوانرا ئیمەیڵی تاقیکاری بنێردرێت',
            'channel_disabled' => 'ئەم کەناڵە لە ئێستادا ناچالاکە. ئیمەیڵی تاقیکاری بەهەر حاڵ دەنێردرێت.',
        ],
    ],

    'logs' => [
        'title' => 'تۆمارەکانی سیستەم',
        'heading' => 'فایلەکانی تۆمار',
        'entries_title' => 'تۆمارەکان',
        'back_to_list' => 'گەڕانەوە بۆ فایلەکانی تۆمار',
        'no_entries' => 'هیچ تۆمارێک نەدۆزرایەوە',
        'unsupported_format' => 'وادیارە ئەم فایلە فۆرماتی ستانداردی تۆماری Laravel بەکارناهێنێت',
        'search_placeholder' => 'گەڕان لە تۆمارەکان...',
        'level_filter' => 'ئاستی تۆمار',
        'email_recipient' => 'ئیمەیڵی وەرگر',
        'email_description' => 'ئەم فایلی تۆمارە وەک هاوپێچی ئیمەیڵ بۆ وەرگری دیاریکراو بنێرە.',
        'bulk_email_description' => 'فایلەکانی تۆماری هەڵبژێردراو وەک هاوپێچی ئیمەیڵی جیاجیا بۆ وەرگری دیاریکراو بنێرە.',
        'bulk_email_files' => 'فایلە هەڵبژێردراوەکان',

        'filter' => [
            'date_from' => 'لە',
            'date_to' => 'بۆ',
        ],

        'column' => [
            'filename' => 'ناوی فایل',
            'size' => 'قەبارە',
            'modified' => 'دوایین گۆڕانکاری',
            'subfolder' => 'بوخچەی ژێر',
            'level' => 'ئاست',
            'timestamp' => 'کاتنیشانە',
            'message' => 'پەیام',
        ],

        'action' => [
            'refresh' => 'نوێکردنەوە',
            'view' => 'بینین',
            'delete' => 'سڕینەوە',
            'download' => 'داگرتن',
            'email' => 'ئیمەیڵ بۆ',
            'email_send' => 'ناردن',
            'email_sent' => 'فایلی تۆمار بە سەرکەوتوویی ئیمەیڵ کرا',
            'bulk_email_sent' => ':count فایلی تۆمار بە سەرکەوتوویی ئیمەیڵ کران',
            'deleted' => 'فایلی تۆمار سڕایەوە',
            'bulk_deleted' => ':count فایلی تۆمار سڕانەوە',
        ],

        'confirm' => [
            'delete' => 'دڵنیایت لە سڕینەوەی ئەم فایلی تۆمارە؟ ئەم کارە ناگەڕێتەوە.',
            'bulk_delete' => 'دڵنیایت لە سڕینەوەی فایلە تۆمارییە هەڵبژێردراوەکان؟ ئەم کارە ناگەڕێتەوە.',
        ],

        'entry' => [
            'detail' => 'وردەکاری تۆمار',
            'line' => 'هێڵ',
            'trace_frames' => ':count فرەیم|:count فرەیم',
            'copy_trace' => 'کۆپیکردنی شوێنپێی ستاک',
            'copy_entry' => 'کۆپیکردنی تۆماری تەواو',
            'copied' => 'کۆپی کرا!',
        ],
    ],

];
