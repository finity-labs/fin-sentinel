<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'الإعدادات',
        'error_channel' => 'قناة الأخطاء',
        'error_channel_title' => 'إعدادات قناة الأخطاء',
        'debug_channel' => 'قناة Debug',
        'debug_channel_title' => 'إعدادات قناة Debug',
        'system_logs' => 'سجلات النظام',
        'log_files' => 'ملفات السجلات',
        'log_entries' => 'سجلات الأحداث',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'طوارئ',
            'ALERT' => 'تنبيه',
            'CRITICAL' => 'حرج',
            'ERROR' => 'خطأ',
            'WARNING' => 'تحذير',
            'NOTICE' => 'ملاحظة',
            'INFO' => 'معلومات',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'إشعار بخطأ',
            'debug' => 'Debug',
            'log_file' => 'ملف السجل',
        ],
        'footer' => 'أُرسل بواسطة Fin-Sentinel',

        'label' => [
            'error_message' => 'رسالة الخطأ',
            'class' => 'الفئة',
            'file' => 'الملف',
            'context' => 'السياق',
            'command' => 'الأمر',
            'url' => 'URL',
            'method' => 'الطريقة',
            'ip' => 'IP',
            'params' => 'المعلمات',
            'headers' => 'الرؤوس',
            'name' => 'الاسم',
            'email' => 'البريد الإلكتروني',
            'id' => 'ID',
            'user' => 'المستخدم',
            'environment' => 'البيئة',
            'debug_mode' => 'وضع Debug',
            'php_version' => 'إصدار PHP',
            'laravel_version' => 'إصدار Laravel',
            'laravel' => 'Laravel',
            'peak_memory' => 'ذروة الذاكرة',
            'enabled' => 'مُفعّل',
            'disabled' => 'مُعطّل',
            'relation' => 'العلاقة: :name',
            'bindings' => 'الربط:',
            'trace_number' => '#',
            'trace_location' => 'الموقع',
            'trace_call' => 'الاستدعاء',
        ],

        'collection' => [
            'count' => ':count عنصر|:count عناصر',
            'more' => '... و :count عناصر أخرى',
        ],

        'error' => [
            'subject' => ':app - حدث خطأ',
            'guest' => 'زائر',
            'console' => 'وحدة التحكم',
            'section_exception' => 'تفاصيل الاستثناء',
            'section_trace' => 'تتبع المكدس',
            'section_request' => 'سياق الطلب',
            'section_user' => 'المستخدم المُصادق',
            'section_environment' => 'البيئة',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'زائر',
            'console' => 'وحدة التحكم',
            'section_data' => 'بيانات Debug',
            'section_call_site' => 'موقع الاستدعاء',
            'section_request' => 'سياق الطلب',
            'section_environment' => 'البيئة',
        ],

        'log_file' => [
            'subject' => ':app - ملف سجل: :file',
            'bulk_subject' => ':app - :count ملفات سجل مرفقة',
            'body' => 'ملف السجل <strong>:file</strong> من :app مرفق طيّه.',
            'body_text' => 'ملف السجل :file من :app مرفق طيّه.',
        ],
    ],

    'settings' => [
        'recipients' => 'المستلمون',
        'throttling' => 'التحكم بالمعدل',
        'email_address' => 'عنوان البريد الإلكتروني',
        'add_recipient' => 'إضافة مستلم',
        'no_recipients_warning' => 'لم يتم تحديد مستلمين — لن يتم إرسال الإشعارات حتى تتم إضافة عنوان بريد إلكتروني واحد على الأقل.',
        'throttle_rate' => 'معدل التحكم',
        'minutes_suffix' => 'دقائق',

        'error' => [
            'enabled' => 'تفعيل إشعارات الأخطاء',
            'enabled_helper' => 'عند التعطيل، لن يتم إرسال رسائل الخطأ عبر البريد.',
            'recipients_helper' => 'أضف عناوين البريد الإلكتروني التي ستستلم إشعارات الأخطاء.',
            'throttle_helper' => 'الحد الأدنى من الدقائق بين رسائل الخطأ المكررة.',
            'throttle_exceptions' => 'تحكم بمعدل الاستثناءات',
            'throttle_exceptions_helper' => 'عند التفعيل، لن تُرسل رسائل للاستثناءات المكررة في نفس الملف:السطر خلال نافذة التحكم.',
            'throttle_log_messages' => 'تحكم بمعدل رسائل السجل',
            'throttle_log_messages_helper' => 'عند التفعيل، لن تُرسل رسائل لرسائل السجل المتطابقة خلال نافذة التحكم.',
            'ignored_exceptions' => 'الاستثناءات المتجاهلة',
            'ignored_exceptions_description' => 'لن تُطلق الاستثناءات في هذه القائمة إشعارات بريد إلكتروني.',
            'ignored_exceptions_label' => 'الاستثناءات المتجاهلة',
            'other_custom' => 'أخرى (مخصص)',
            'exception_class' => 'فئة الاستثناء (FQCN)',
            'class_not_exist' => 'هذه الفئة غير موجودة.',
            'custom_exception' => 'استثناء مخصص',
            'select_exception' => 'اختر استثناء',
            'add_exception' => 'إضافة استثناء',
        ],

        'debug' => [
            'enabled' => 'تفعيل قناة Debug',
            'enabled_helper' => 'عند التعطيل، سيتم تجاهل استدعاءات Sentinel::debug() بصمت.',
            'recipients_helper' => 'أضف عناوين البريد الإلكتروني التي ستستلم إشعارات Debug.',
            'throttle_enabled' => 'تفعيل التحكم بالمعدل',
            'throttle_enabled_helper' => 'عند التعطيل، كل استدعاء debug يرسل بريداً. عند التفعيل، يتم تحديد معدل الاستدعاءات المكررة.',
            'throttle_helper' => 'الحد الأدنى من الدقائق بين رسائل debug المكررة.',
        ],

        'test_email' => [
            'send' => 'إرسال بريد تجريبي',
            'sent' => 'تم إرسال بريد تجريبي إلى :count مستلم(ين)',
            'no_recipients' => 'لم يتم تحديد مستلمين. أضف عنوان بريد إلكتروني واحد على الأقل أولاً.',
            'failed' => 'فشل إرسال البريد التجريبي',
            'channel_disabled' => 'هذه القناة معطلة حالياً. سيتم إرسال البريد التجريبي رغم ذلك.',
        ],
    ],

    'logs' => [
        'title' => 'سجلات النظام',
        'heading' => 'ملفات السجلات',
        'entries_title' => 'سجلات الأحداث',
        'back_to_list' => 'العودة إلى ملفات السجلات',
        'no_entries' => 'لم يتم العثور على سجلات',
        'unsupported_format' => 'لا يبدو أن هذا الملف يستخدم تنسيق سجلات Laravel القياسي',
        'search_placeholder' => 'ابحث في السجلات...',
        'level_filter' => 'مستوى السجل',
        'email_recipient' => 'بريد المستلم',
        'email_description' => 'أرسل ملف السجل هذا كمرفق بريد إلكتروني إلى المستلم المحدد.',
        'bulk_email_description' => 'أرسل ملفات السجل المختارة كمرفقات بريد إلكتروني منفصلة إلى المستلم المحدد.',
        'bulk_email_files' => 'الملفات المختارة',

        'filter' => [
            'date_from' => 'من',
            'date_to' => 'إلى',
        ],

        'column' => [
            'filename' => 'اسم الملف',
            'size' => 'الحجم',
            'modified' => 'آخر تعديل',
            'subfolder' => 'مجلد فرعي',
            'level' => 'المستوى',
            'timestamp' => 'الطابع الزمني',
            'message' => 'الرسالة',
        ],

        'action' => [
            'refresh' => 'تحديث',
            'view' => 'عرض',
            'delete' => 'حذف',
            'download' => 'تنزيل',
            'email' => 'إرسال إلى',
            'email_send' => 'إرسال',
            'email_sent' => 'تم إرسال ملف السجل بنجاح',
            'bulk_email_sent' => 'تم إرسال :count ملف(ات) سجل بنجاح',
            'deleted' => 'تم حذف ملف السجل',
            'bulk_deleted' => 'تم حذف :count ملف(ات) سجل',
        ],

        'confirm' => [
            'delete' => 'هل أنت متأكد من حذف ملف السجل هذا؟ لا يمكن التراجع عن هذا الإجراء.',
            'bulk_delete' => 'هل أنت متأكد من حذف ملفات السجل المختارة؟ لا يمكن التراجع عن هذا الإجراء.',
        ],

        'entry' => [
            'detail' => 'تفاصيل السجل',
            'line' => 'سطر',
            'trace_frames' => ':count إطار|:count إطارات',
            'copy_trace' => 'نسخ تتبع المكدس',
            'copy_entry' => 'نسخ السجل الكامل',
            'copied' => 'تم النسخ!',
        ],
    ],

];
