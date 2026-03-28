<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'ترتیبات',
        'error_channel' => 'خرابی کا چینل',
        'error_channel_title' => 'خرابی کے چینل کی ترتیبات',
        'debug_channel' => 'Debug چینل',
        'debug_channel_title' => 'Debug چینل کی ترتیبات',
        'system_logs' => 'سسٹم لاگز',
        'log_files' => 'لاگ فائلیں',
        'log_entries' => 'لاگ اندراجات',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'ایمرجنسی',
            'ALERT' => 'الرٹ',
            'CRITICAL' => 'تشویشناک',
            'ERROR' => 'خرابی',
            'WARNING' => 'انتباہ',
            'NOTICE' => 'نوٹس',
            'INFO' => 'معلومات',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'خرابی کی اطلاع',
            'debug' => 'Debug',
            'log_file' => 'لاگ فائل',
        ],
        'footer' => 'Fin-Sentinel کی طرف سے بھیجا گیا',

        'label' => [
            'error_message' => 'خرابی کا پیغام',
            'class' => 'کلاس',
            'file' => 'فائل',
            'context' => 'سیاق و سباق',
            'command' => 'کمانڈ',
            'url' => 'URL',
            'method' => 'طریقہ',
            'ip' => 'IP',
            'params' => 'پیرامیٹرز',
            'headers' => 'ہیڈرز',
            'name' => 'نام',
            'email' => 'ای میل',
            'id' => 'ID',
            'user' => 'صارف',
            'environment' => 'ماحول',
            'debug_mode' => 'Debug موڈ',
            'php_version' => 'PHP ورژن',
            'laravel_version' => 'Laravel ورژن',
            'laravel' => 'Laravel',
            'peak_memory' => 'زیادہ سے زیادہ میموری',
            'enabled' => 'فعال',
            'disabled' => 'غیر فعال',
            'relation' => 'تعلق: :name',
            'bindings' => 'بائنڈنگز:',
            'trace_number' => '#',
            'trace_location' => 'مقام',
            'trace_call' => 'کال',
        ],

        'collection' => [
            'count' => ':count آئٹم|:count آئٹمز',
            'more' => '... اور :count مزید آئٹمز',
        ],

        'error' => [
            'subject' => ':app - ایک خرابی واقع ہوئی',
            'guest' => 'مہمان',
            'console' => 'کنسول',
            'section_exception' => 'استثناء کی تفصیلات',
            'section_trace' => 'اسٹیک ٹریس',
            'section_request' => 'درخواست کا سیاق',
            'section_user' => 'تصدیق شدہ صارف',
            'section_environment' => 'ماحول',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'مہمان',
            'console' => 'کنسول',
            'section_data' => 'Debug ڈیٹا',
            'section_call_site' => 'کال سائٹ',
            'section_request' => 'درخواست کا سیاق',
            'section_environment' => 'ماحول',
        ],

        'log_file' => [
            'subject' => ':app - لاگ فائل: :file',
            'bulk_subject' => ':app - :count لاگ فائلیں منسلک',
            'body' => 'لاگ فائل <strong>:file</strong> بذریعہ :app منسلک ہے۔',
            'body_text' => 'لاگ فائل :file بذریعہ :app منسلک ہے۔',
        ],
    ],

    'settings' => [
        'recipients' => 'وصول کنندگان',
        'throttling' => 'شرح کی حد بندی',
        'email_address' => 'ای میل ایڈریس',
        'add_recipient' => 'وصول کنندہ شامل کریں',
        'no_recipients_warning' => 'کوئی وصول کنندہ مقرر نہیں — جب تک کم از کم ایک ای میل ایڈریس شامل نہ کیا جائے، اطلاعات نہیں بھیجی جائیں گی۔',
        'throttle_rate' => 'حد بندی کی شرح',
        'minutes_suffix' => 'منٹ',

        'error' => [
            'enabled' => 'خرابی کی اطلاعات فعال کریں',
            'enabled_helper' => 'غیر فعال ہونے پر، خرابی کی ای میلز نہیں بھیجی جائیں گی۔',
            'recipients_helper' => 'خرابی کی اطلاعات وصول کرنے والے ای میل ایڈریس شامل کریں۔',
            'throttle_helper' => 'ایک جیسی خرابی ای میلز کے درمیان کم از کم منٹ۔',
            'throttle_exceptions' => 'استثناء کی حد بندی',
            'throttle_exceptions_helper' => 'فعال ہونے پر، ایک ہی فائل:لائن پر دہرائے جانے والے استثناء حد بندی کی مدت میں ای میل نہیں بھیجیں گے۔',
            'throttle_log_messages' => 'لاگ پیغامات کی حد بندی',
            'throttle_log_messages_helper' => 'فعال ہونے پر، ایک جیسے خرابی لاگ پیغامات حد بندی کی مدت میں ای میل نہیں بھیجیں گے۔',
            'ignored_exceptions' => 'نظرانداز شدہ استثناءات',
            'ignored_exceptions_description' => 'اس فہرست میں موجود استثناءات ای میل اطلاعات نہیں بھیجیں گے۔',
            'ignored_exceptions_label' => 'نظرانداز شدہ استثناءات',
            'other_custom' => 'دیگر (حسب ضرورت)',
            'exception_class' => 'استثناء کلاس (FQCN)',
            'class_not_exist' => 'یہ کلاس موجود نہیں ہے۔',
            'custom_exception' => 'حسب ضرورت استثناء',
            'select_exception' => 'استثناء منتخب کریں',
            'add_exception' => 'استثناء شامل کریں',
        ],

        'debug' => [
            'enabled' => 'Debug چینل فعال کریں',
            'enabled_helper' => 'غیر فعال ہونے پر، Sentinel::debug() کالز خاموشی سے نظرانداز کر دی جائیں گی۔',
            'recipients_helper' => 'Debug اطلاعات وصول کرنے والے ای میل ایڈریس شامل کریں۔',
            'throttle_enabled' => 'حد بندی فعال کریں',
            'throttle_enabled_helper' => 'غیر فعال ہونے پر، ہر debug کال ای میل بھیجتی ہے۔ فعال ہونے پر، دہرائی جانے والی کالز محدود ہوتی ہیں۔',
            'throttle_helper' => 'ایک جیسی debug ای میلز کے درمیان کم از کم منٹ۔',
        ],

        'test_email' => [
            'send' => 'ٹیسٹ ای میل بھیجیں',
            'sent' => ':count وصول کنندہ(وں) کو ٹیسٹ ای میل بھیجی گئی',
            'no_recipients' => 'کوئی وصول کنندہ مقرر نہیں۔ پہلے کم از کم ایک ای میل ایڈریس شامل کریں۔',
            'failed' => 'ٹیسٹ ای میل بھیجنے میں ناکامی',
            'channel_disabled' => 'یہ چینل فی الحال غیر فعال ہے۔ ٹیسٹ ای میل پھر بھی بھیجی جائے گی۔',
        ],
    ],

    'logs' => [
        'title' => 'سسٹم لاگز',
        'heading' => 'لاگ فائلیں',
        'entries_title' => 'لاگ اندراجات',
        'back_to_list' => 'لاگ فائلوں کی فہرست پر واپس',
        'no_entries' => 'کوئی لاگ اندراج نہیں ملا',
        'unsupported_format' => 'ایسا لگتا ہے کہ یہ فائل معیاری Laravel لاگ فارمیٹ استعمال نہیں کرتی',
        'search_placeholder' => 'لاگ اندراجات میں تلاش کریں...',
        'level_filter' => 'لاگ لیول',
        'email_recipient' => 'وصول کنندہ کا ای میل',
        'email_description' => 'یہ لاگ فائل مخصوص وصول کنندہ کو ای میل منسلکہ کے طور پر بھیجیں۔',
        'bulk_email_description' => 'منتخب لاگ فائلیں مخصوص وصول کنندہ کو الگ الگ ای میل منسلکات کے طور پر بھیجیں۔',
        'bulk_email_files' => 'منتخب فائلیں',

        'filter' => [
            'date_from' => 'سے',
            'date_to' => 'تک',
        ],

        'column' => [
            'filename' => 'فائل کا نام',
            'size' => 'سائز',
            'modified' => 'آخری ترمیم',
            'subfolder' => 'ذیلی فولڈر',
            'level' => 'لیول',
            'timestamp' => 'ٹائم اسٹیمپ',
            'message' => 'پیغام',
        ],

        'action' => [
            'refresh' => 'ریفریش',
            'view' => 'دیکھیں',
            'delete' => 'حذف کریں',
            'download' => 'ڈاؤن لوڈ',
            'email' => 'ای میل کریں',
            'email_send' => 'بھیجیں',
            'email_sent' => 'لاگ فائل کامیابی سے ای میل کی گئی',
            'bulk_email_sent' => ':count لاگ فائل(یں) کامیابی سے ای میل کی گئیں',
            'deleted' => 'لاگ فائل حذف ہو گئی',
            'bulk_deleted' => ':count لاگ فائل(یں) حذف ہو گئیں',
        ],

        'confirm' => [
            'delete' => 'کیا آپ واقعی یہ لاگ فائل حذف کرنا چاہتے ہیں؟ یہ عمل واپس نہیں ہو سکتا۔',
            'bulk_delete' => 'کیا آپ واقعی منتخب لاگ فائلیں حذف کرنا چاہتے ہیں؟ یہ عمل واپس نہیں ہو سکتا۔',
        ],

        'entry' => [
            'detail' => 'اندراج کی تفصیل',
            'line' => 'لائن',
            'trace_frames' => ':count فریم|:count فریمز',
            'copy_trace' => 'اسٹیک ٹریس کاپی کریں',
            'copy_entry' => 'مکمل اندراج کاپی کریں',
            'copied' => 'کاپی ہو گیا!',
        ],
    ],

];
