<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'تنظیمات',
        'error_channel' => 'کانال خطا',
        'error_channel_title' => 'تنظیمات کانال خطا',
        'debug_channel' => 'کانال Debug',
        'debug_channel_title' => 'تنظیمات کانال Debug',
        'system_logs' => 'گزارش‌های سیستم',
        'log_files' => 'فایل‌های گزارش',
        'log_entries' => 'رکوردهای گزارش',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'اضطراری',
            'ALERT' => 'هشدار فوری',
            'CRITICAL' => 'بحرانی',
            'ERROR' => 'خطا',
            'WARNING' => 'هشدار',
            'NOTICE' => 'اطلاعیه',
            'INFO' => 'اطلاعات',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'اعلان خطا',
            'debug' => 'Debug',
            'log_file' => 'فایل گزارش',
        ],
        'footer' => 'ارسال شده توسط Fin-Sentinel',

        'label' => [
            'error_message' => 'پیام خطا',
            'class' => 'کلاس',
            'file' => 'فایل',
            'context' => 'زمینه',
            'command' => 'دستور',
            'url' => 'URL',
            'method' => 'روش',
            'ip' => 'IP',
            'params' => 'پارامترها',
            'headers' => 'سرآیندها',
            'name' => 'نام',
            'email' => 'ایمیل',
            'id' => 'ID',
            'user' => 'کاربر',
            'environment' => 'محیط',
            'debug_mode' => 'حالت Debug',
            'php_version' => 'نسخه PHP',
            'laravel_version' => 'نسخه Laravel',
            'laravel' => 'Laravel',
            'peak_memory' => 'اوج حافظه',
            'enabled' => 'فعال',
            'disabled' => 'غیرفعال',
            'relation' => 'رابطه: :name',
            'bindings' => 'اتصالات:',
            'trace_number' => '#',
            'trace_location' => 'موقعیت',
            'trace_call' => 'فراخوانی',
        ],

        'collection' => [
            'count' => ':count مورد|:count مورد',
            'more' => '... و :count مورد دیگر',
        ],

        'error' => [
            'subject' => ':app - خطایی رخ داده است',
            'guest' => 'مهمان',
            'console' => 'کنسول',
            'section_exception' => 'جزئیات استثنا',
            'section_trace' => 'ردیابی پشته',
            'section_request' => 'زمینه درخواست',
            'section_user' => 'کاربر احراز هویت شده',
            'section_environment' => 'محیط',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'مهمان',
            'console' => 'کنسول',
            'section_data' => 'داده‌های Debug',
            'section_call_site' => 'محل فراخوانی',
            'section_request' => 'زمینه درخواست',
            'section_environment' => 'محیط',
        ],

        'log_file' => [
            'subject' => ':app - فایل گزارش: :file',
            'bulk_subject' => ':app - :count فایل گزارش پیوست شده',
            'body' => 'فایل گزارش <strong>:file</strong> از :app پیوست شده است.',
            'body_text' => 'فایل گزارش :file از :app پیوست شده است.',
        ],
    ],

    'settings' => [
        'recipients' => 'گیرندگان',
        'throttling' => 'کنترل نرخ',
        'email_address' => 'آدرس ایمیل',
        'add_recipient' => 'افزودن گیرنده',
        'no_recipients_warning' => 'گیرنده‌ای تنظیم نشده — تا زمانی که حداقل یک آدرس ایمیل اضافه نشود، اعلان‌ها ارسال نخواهند شد.',
        'throttle_rate' => 'نرخ محدودیت',
        'minutes_suffix' => 'دقیقه',

        'error' => [
            'enabled' => 'فعال‌سازی اعلان‌های خطا',
            'enabled_helper' => 'در صورت غیرفعال بودن، ایمیل خطا ارسال نخواهد شد.',
            'recipients_helper' => 'آدرس‌های ایمیلی که اعلان‌های خطا را دریافت می‌کنند اضافه کنید.',
            'throttle_helper' => 'حداقل دقیقه بین ایمیل‌های خطای تکراری.',
            'throttle_exceptions' => 'محدودسازی استثناها',
            'throttle_exceptions_helper' => 'در صورت فعال بودن، استثناهای تکراری در همان فایل:خط در بازه محدودسازی ایمیل ارسال نمی‌کنند.',
            'throttle_log_messages' => 'محدودسازی پیام‌های گزارش',
            'throttle_log_messages_helper' => 'در صورت فعال بودن، پیام‌های گزارش خطای یکسان در بازه محدودسازی ایمیل ارسال نمی‌کنند.',
            'ignored_exceptions' => 'استثناهای نادیده گرفته شده',
            'ignored_exceptions_description' => 'استثناهای موجود در این لیست اعلان ایمیلی ارسال نخواهند کرد.',
            'ignored_exceptions_label' => 'استثناهای نادیده گرفته شده',
            'other_custom' => 'سایر (سفارشی)',
            'exception_class' => 'کلاس استثنا (FQCN)',
            'class_not_exist' => 'این کلاس وجود ندارد.',
            'custom_exception' => 'استثنای سفارشی',
            'select_exception' => 'انتخاب استثنا',
            'add_exception' => 'افزودن استثنا',
        ],

        'debug' => [
            'enabled' => 'فعال‌سازی کانال Debug',
            'enabled_helper' => 'در صورت غیرفعال بودن، فراخوانی‌های Sentinel::debug() بی‌صدا نادیده گرفته می‌شوند.',
            'recipients_helper' => 'آدرس‌های ایمیلی که اعلان‌های Debug را دریافت می‌کنند اضافه کنید.',
            'throttle_enabled' => 'فعال‌سازی کنترل نرخ',
            'throttle_enabled_helper' => 'در صورت غیرفعال بودن، هر فراخوانی debug یک ایمیل ارسال می‌کند. در صورت فعال بودن، فراخوانی‌های تکراری محدود می‌شوند.',
            'throttle_helper' => 'حداقل دقیقه بین ایمیل‌های debug تکراری.',
        ],

        'test_email' => [
            'send' => 'ارسال ایمیل آزمایشی',
            'sent' => 'ایمیل آزمایشی به :count گیرنده ارسال شد',
            'no_recipients' => 'گیرنده‌ای تنظیم نشده. ابتدا حداقل یک آدرس ایمیل اضافه کنید.',
            'failed' => 'ارسال ایمیل آزمایشی ناموفق بود',
            'channel_disabled' => 'این کانال در حال حاضر غیرفعال است. ایمیل آزمایشی همچنان ارسال خواهد شد.',
        ],
    ],

    'logs' => [
        'title' => 'گزارش‌های سیستم',
        'heading' => 'فایل‌های گزارش',
        'entries_title' => 'رکوردهای گزارش',
        'back_to_list' => 'بازگشت به فایل‌های گزارش',
        'no_entries' => 'رکورد گزارشی یافت نشد',
        'unsupported_format' => 'به نظر نمی‌رسد این فایل از قالب استاندارد گزارش Laravel استفاده کند',
        'search_placeholder' => 'جستجو در رکوردهای گزارش...',
        'level_filter' => 'سطح گزارش',
        'email_recipient' => 'ایمیل گیرنده',
        'email_description' => 'این فایل گزارش را به عنوان پیوست ایمیل به گیرنده مشخص شده ارسال کنید.',
        'bulk_email_description' => 'فایل‌های گزارش انتخاب شده را به عنوان پیوست‌های ایمیل جداگانه به گیرنده مشخص شده ارسال کنید.',
        'bulk_email_files' => 'فایل‌های انتخاب شده',

        'filter' => [
            'date_from' => 'از',
            'date_to' => 'تا',
        ],

        'column' => [
            'filename' => 'نام فایل',
            'size' => 'حجم',
            'modified' => 'آخرین تغییر',
            'subfolder' => 'زیرپوشه',
            'level' => 'سطح',
            'timestamp' => 'برچسب زمانی',
            'message' => 'پیام',
        ],

        'action' => [
            'refresh' => 'بازنشانی',
            'view' => 'مشاهده',
            'delete' => 'حذف',
            'download' => 'دانلود',
            'email' => 'ارسال به',
            'email_send' => 'ارسال',
            'email_sent' => 'فایل گزارش با موفقیت ایمیل شد',
            'bulk_email_sent' => ':count فایل گزارش با موفقیت ایمیل شد',
            'deleted' => 'فایل گزارش حذف شد',
            'bulk_deleted' => ':count فایل گزارش حذف شد',
        ],

        'confirm' => [
            'delete' => 'آیا از حذف این فایل گزارش اطمینان دارید؟ این عمل قابل بازگشت نیست.',
            'bulk_delete' => 'آیا از حذف فایل‌های گزارش انتخاب شده اطمینان دارید؟ این عمل قابل بازگشت نیست.',
        ],

        'entry' => [
            'detail' => 'جزئیات رکورد',
            'line' => 'خط',
            'trace_frames' => ':count فریم|:count فریم',
            'copy_trace' => 'کپی ردیابی پشته',
            'copy_entry' => 'کپی کامل رکورد',
            'copied' => 'کپی شد!',
        ],
    ],

];
