<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'הגדרות',
        'error_channel' => 'ערוץ שגיאות',
        'error_channel_title' => 'הגדרות ערוץ שגיאות',
        'debug_channel' => 'ערוץ Debug',
        'debug_channel_title' => 'הגדרות ערוץ Debug',
        'system_logs' => 'יומני מערכת',
        'log_files' => 'קבצי יומן',
        'log_entries' => 'רשומות יומן',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'חירום',
            'ALERT' => 'התראה',
            'CRITICAL' => 'קריטי',
            'ERROR' => 'שגיאה',
            'WARNING' => 'אזהרה',
            'NOTICE' => 'הודעה',
            'INFO' => 'מידע',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'התראת שגיאה',
            'debug' => 'Debug',
            'log_file' => 'קובץ יומן',
        ],
        'footer' => 'נשלח על ידי Fin-Sentinel',

        'label' => [
            'error_message' => 'הודעת שגיאה',
            'class' => 'מחלקה',
            'file' => 'קובץ',
            'context' => 'הקשר',
            'command' => 'פקודה',
            'url' => 'URL',
            'method' => 'שיטה',
            'ip' => 'IP',
            'params' => 'פרמטרים',
            'headers' => 'כותרות',
            'name' => 'שם',
            'email' => 'דוא"ל',
            'id' => 'ID',
            'user' => 'משתמש',
            'environment' => 'סביבה',
            'debug_mode' => 'מצב Debug',
            'php_version' => 'גרסת PHP',
            'laravel_version' => 'גרסת Laravel',
            'laravel' => 'Laravel',
            'peak_memory' => 'שיא זיכרון',
            'enabled' => 'מופעל',
            'disabled' => 'מושבת',
            'relation' => 'קשר: :name',
            'bindings' => 'קישורים:',
            'trace_number' => '#',
            'trace_location' => 'מיקום',
            'trace_call' => 'קריאה',
        ],

        'collection' => [
            'count' => ':count פריט|:count פריטים',
            'more' => '... ועוד :count פריטים',
        ],

        'error' => [
            'subject' => ':app - אירעה שגיאה',
            'guest' => 'אורח',
            'console' => 'קונסול',
            'section_exception' => 'פרטי חריגה',
            'section_trace' => 'מעקב מחסנית',
            'section_request' => 'הקשר בקשה',
            'section_user' => 'משתמש מאומת',
            'section_environment' => 'סביבה',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'אורח',
            'console' => 'קונסול',
            'section_data' => 'נתוני Debug',
            'section_call_site' => 'מקום הקריאה',
            'section_request' => 'הקשר בקשה',
            'section_environment' => 'סביבה',
        ],

        'log_file' => [
            'subject' => ':app - קובץ יומן: :file',
            'bulk_subject' => ':app - :count קבצי יומן מצורפים',
            'body' => 'קובץ היומן <strong>:file</strong> מ-:app מצורף.',
            'body_text' => 'קובץ היומן :file מ-:app מצורף.',
        ],
    ],

    'settings' => [
        'recipients' => 'נמענים',
        'throttling' => 'הגבלת קצב',
        'email_address' => 'כתובת דוא"ל',
        'add_recipient' => 'הוסף נמען',
        'no_recipients_warning' => 'לא הוגדרו נמענים — לא יישלחו התראות עד שתתווסף לפחות כתובת דוא"ל אחת.',
        'throttle_rate' => 'קצב הגבלה',
        'minutes_suffix' => 'דקות',

        'error' => [
            'enabled' => 'הפעלת התראות שגיאה',
            'enabled_helper' => 'כאשר מושבת, לא יישלחו הודעות שגיאה בדוא"ל.',
            'recipients_helper' => 'הוסף כתובות דוא"ל שיקבלו התראות שגיאה.',
            'throttle_helper' => 'מספר דקות מינימלי בין הודעות שגיאה כפולות.',
            'throttle_exceptions' => 'הגבלת חריגות',
            'throttle_exceptions_helper' => 'כאשר מופעל, חריגות כפולות באותו קובץ:שורה לא יפעילו הודעות בחלון ההגבלה.',
            'throttle_log_messages' => 'הגבלת הודעות יומן',
            'throttle_log_messages_helper' => 'כאשר מופעל, הודעות יומן שגיאה זהות לא יפעילו הודעות בחלון ההגבלה.',
            'ignored_exceptions' => 'חריגות מתעלמות',
            'ignored_exceptions_description' => 'חריגות ברשימה זו לא יפעילו התראות דוא"ל.',
            'ignored_exceptions_label' => 'חריגות מתעלמות',
            'other_custom' => 'אחר (מותאם אישית)',
            'exception_class' => 'מחלקת חריגה (FQCN)',
            'class_not_exist' => 'מחלקה זו אינה קיימת.',
            'custom_exception' => 'חריגה מותאמת אישית',
            'select_exception' => 'בחר חריגה',
            'add_exception' => 'הוסף חריגה',
        ],

        'debug' => [
            'enabled' => 'הפעלת ערוץ Debug',
            'enabled_helper' => 'כאשר מושבת, קריאות Sentinel::debug() יתעלמו בשקט.',
            'recipients_helper' => 'הוסף כתובות דוא"ל שיקבלו התראות Debug.',
            'throttle_enabled' => 'הפעלת הגבלת קצב',
            'throttle_enabled_helper' => 'כאשר מושבת, כל קריאת debug שולחת הודעה. כאשר מופעל, קריאות כפולות מוגבלות.',
            'throttle_helper' => 'מספר דקות מינימלי בין הודעות debug כפולות.',
        ],

        'test_email' => [
            'send' => 'שלח דוא"ל בדיקה',
            'sent' => 'דוא"ל בדיקה נשלח ל-:count נמען(ים)',
            'no_recipients' => 'לא הוגדרו נמענים. הוסף לפחות כתובת דוא"ל אחת תחילה.',
            'failed' => 'שליחת דוא"ל הבדיקה נכשלה',
            'channel_disabled' => 'ערוץ זה מושבת כעת. דוא"ל הבדיקה יישלח בכל זאת.',
        ],
    ],

    'logs' => [
        'title' => 'יומני מערכת',
        'heading' => 'קבצי יומן',
        'entries_title' => 'רשומות יומן',
        'back_to_list' => 'חזרה לקבצי יומן',
        'no_entries' => 'לא נמצאו רשומות יומן',
        'unsupported_format' => 'נראה שקובץ זה אינו משתמש בפורמט היומן הסטנדרטי של Laravel',
        'search_placeholder' => 'חיפוש ברשומות יומן...',
        'level_filter' => 'רמת יומן',
        'email_recipient' => 'דוא"ל נמען',
        'email_description' => 'שלח קובץ יומן זה כקובץ מצורף בדוא"ל לנמען המצוין.',
        'bulk_email_description' => 'שלח את קבצי היומן שנבחרו כקבצים מצורפים נפרדים בדוא"ל לנמען המצוין.',
        'bulk_email_files' => 'קבצים נבחרים',

        'filter' => [
            'date_from' => 'מ',
            'date_to' => 'עד',
        ],

        'column' => [
            'filename' => 'שם קובץ',
            'size' => 'גודל',
            'modified' => 'שונה לאחרונה',
            'subfolder' => 'תת-תיקייה',
            'level' => 'רמה',
            'timestamp' => 'חותמת זמן',
            'message' => 'הודעה',
        ],

        'action' => [
            'refresh' => 'רענן',
            'view' => 'הצג',
            'delete' => 'מחק',
            'download' => 'הורד',
            'email' => 'שלח אל',
            'email_send' => 'שלח',
            'email_sent' => 'קובץ היומן נשלח בהצלחה',
            'bulk_email_sent' => ':count קבצי יומן נשלחו בהצלחה',
            'deleted' => 'קובץ היומן נמחק',
            'bulk_deleted' => ':count קבצי יומן נמחקו',
        ],

        'confirm' => [
            'delete' => 'האם אתה בטוח שברצונך למחוק קובץ יומן זה? לא ניתן לבטל פעולה זו.',
            'bulk_delete' => 'האם אתה בטוח שברצונך למחוק את קבצי היומן שנבחרו? לא ניתן לבטל פעולה זו.',
        ],

        'entry' => [
            'detail' => 'פרטי רשומה',
            'line' => 'שורה',
            'trace_frames' => ':count מסגרת|:count מסגרות',
            'copy_trace' => 'העתק מעקב מחסנית',
            'copy_entry' => 'העתק רשומה מלאה',
            'copied' => 'הועתק!',
        ],
    ],

];
