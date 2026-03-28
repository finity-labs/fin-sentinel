<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'ቅንብሮች',
        'error_channel' => 'የስህተት ቻናል',
        'error_channel_title' => 'የስህተት ቻናል ቅንብሮች',
        'debug_channel' => 'Debug ቻናል',
        'debug_channel_title' => 'Debug ቻናል ቅንብሮች',
        'system_logs' => 'የስርዓት ሎጎች',
        'log_files' => 'የሎግ ፋይሎች',
        'log_entries' => 'የሎግ ግቤቶች',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'አስቸኳይ',
            'ALERT' => 'ማንቂያ',
            'CRITICAL' => 'ወሳኝ',
            'ERROR' => 'ስህተት',
            'WARNING' => 'ማስጠንቀቂያ',
            'NOTICE' => 'ማሳሰቢያ',
            'INFO' => 'መረጃ',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'የስህተት ማሳወቂያ',
            'debug' => 'Debug',
            'log_file' => 'የሎግ ፋይል',
        ],
        'footer' => 'በ Fin-Sentinel የተላከ',

        'label' => [
            'error_message' => 'የስህተት መልእክት',
            'class' => 'ክላስ',
            'file' => 'ፋይል',
            'context' => 'ዐውድ',
            'command' => 'ትዕዛዝ',
            'url' => 'URL',
            'method' => 'ዘዴ',
            'ip' => 'IP',
            'params' => 'ፓራሜትሮች',
            'headers' => 'ራስጌዎች',
            'name' => 'ስም',
            'email' => 'ኢሜይል',
            'id' => 'ID',
            'user' => 'ተጠቃሚ',
            'environment' => 'አካባቢ',
            'debug_mode' => 'Debug ሁነታ',
            'php_version' => 'PHP ስሪት',
            'laravel_version' => 'Laravel ስሪት',
            'laravel' => 'Laravel',
            'peak_memory' => 'ከፍተኛ ማህደረ ትውስታ',
            'enabled' => 'ነቅቷል',
            'disabled' => 'ተሰናክሏል',
            'relation' => 'ግንኙነት: :name',
            'bindings' => 'ማሰሪያዎች:',
            'trace_number' => '#',
            'trace_location' => 'ቦታ',
            'trace_call' => 'ጥሪ',
        ],

        'collection' => [
            'count' => ':count ንጥል|:count ንጥሎች',
            'more' => '... እና :count ተጨማሪ ንጥሎች',
        ],

        'error' => [
            'subject' => ':app - ስህተት ተከስቷል',
            'guest' => 'እንግዳ',
            'console' => 'ኮንሶል',
            'section_exception' => 'የልዩ ሁኔታ ዝርዝሮች',
            'section_trace' => 'ስታክ ትሬስ',
            'section_request' => 'የጥያቄ ዐውድ',
            'section_user' => 'የተረጋገጠ ተጠቃሚ',
            'section_environment' => 'አካባቢ',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'እንግዳ',
            'console' => 'ኮንሶል',
            'section_data' => 'Debug ውሂብ',
            'section_call_site' => 'የጥሪ ቦታ',
            'section_request' => 'የጥያቄ ዐውድ',
            'section_environment' => 'አካባቢ',
        ],

        'log_file' => [
            'subject' => ':app - የሎግ ፋይል: :file',
            'bulk_subject' => ':app - :count የሎግ ፋይሎች ተያይዘዋል',
            'body' => 'የሎግ ፋይል <strong>:file</strong> ከ :app ተያይዟል።',
            'body_text' => 'የሎግ ፋይል :file ከ :app ተያይዟል።',
        ],
    ],

    'settings' => [
        'recipients' => 'ተቀባዮች',
        'throttling' => 'ገደብ መጣል',
        'email_address' => 'የኢሜይል አድራሻ',
        'add_recipient' => 'ተቀባይ ያክሉ',
        'no_recipients_warning' => 'ምንም ተቀባዮች አልተዋቀሩም — ቢያንስ አንድ ኢሜይል እስኪጨመር ማሳወቂያዎች አይላኩም።',
        'throttle_rate' => 'የገደብ መጠን',
        'minutes_suffix' => 'ደቂቃዎች',

        'error' => [
            'enabled' => 'የስህተት ማሳወቂያዎችን አንቃ',
            'enabled_helper' => 'ሲሰናከል፣ ምንም የስህተት ኢሜይሎች አይላኩም።',
            'recipients_helper' => 'የስህተት ማሳወቂያዎችን የሚቀበሉ የኢሜይል አድራሻዎችን ያክሉ።',
            'throttle_helper' => 'በተደጋጋሚ የስህተት ኢሜይሎች መካከል ዝቅተኛ ደቂቃዎች።',
            'throttle_exceptions' => 'ልዩ ሁኔታዎችን ገድብ',
            'throttle_exceptions_helper' => 'ሲነቃ፣ በተመሳሳይ ፋይል:መስመር ላይ ተደጋጋሚ ልዩ ሁኔታዎች በገደብ መስኮት ውስጥ ኢሜይሎችን አያስነሱም።',
            'throttle_log_messages' => 'የሎግ መልእክቶችን ገድብ',
            'throttle_log_messages_helper' => 'ሲነቃ፣ ተመሳሳይ የስህተት ሎግ መልእክቶች በገደብ መስኮት ውስጥ ኢሜይሎችን አያስነሱም።',
            'ignored_exceptions' => 'የተተዉ ልዩ ሁኔታዎች',
            'ignored_exceptions_description' => 'በዚህ ዝርዝር ውስጥ ያሉ ልዩ ሁኔታዎች የኢሜይል ማሳወቂያዎችን አያስነሱም።',
            'ignored_exceptions_label' => 'የተተዉ ልዩ ሁኔታዎች',
            'other_custom' => 'ሌላ (ብጁ)',
            'exception_class' => 'የልዩ ሁኔታ ክላስ (FQCN)',
            'class_not_exist' => 'ይህ ክላስ የለም።',
            'custom_exception' => 'ብጁ ልዩ ሁኔታ',
            'select_exception' => 'ልዩ ሁኔታ ይምረጡ',
            'add_exception' => 'ልዩ ሁኔታ ያክሉ',
        ],

        'debug' => [
            'enabled' => 'Debug ቻናልን አንቃ',
            'enabled_helper' => 'ሲሰናከል፣ Sentinel::debug() ጥሪዎች በጸጥታ ይተዋሉ።',
            'recipients_helper' => 'Debug ማሳወቂያዎችን የሚቀበሉ የኢሜይል አድራሻዎችን ያክሉ።',
            'throttle_enabled' => 'ገደብ መጣልን አንቃ',
            'throttle_enabled_helper' => 'ሲሰናከል፣ እያንዳንዱ debug ጥሪ ኢሜይል ይልካል። ሲነቃ፣ ተደጋጋሚ ጥሪዎች ይገደባሉ።',
            'throttle_helper' => 'በተደጋጋሚ debug ኢሜይሎች መካከል ዝቅተኛ ደቂቃዎች።',
        ],

        'test_email' => [
            'send' => 'የሙከራ ኢሜይል ላክ',
            'sent' => 'የሙከራ ኢሜይል ለ :count ተቀባይ(ዎች) ተልኳል',
            'no_recipients' => 'ምንም ተቀባዮች አልተዋቀሩም። መጀመሪያ ቢያንስ አንድ የኢሜይል አድራሻ ያክሉ።',
            'failed' => 'የሙከራ ኢሜይል መላክ አልተሳካም',
            'channel_disabled' => 'ይህ ቻናል በአሁኑ ጊዜ ተሰናክሏል። የሙከራ ኢሜይሉ አሁንም ይላካል።',
        ],
    ],

    'logs' => [
        'title' => 'የስርዓት ሎጎች',
        'heading' => 'የሎግ ፋይሎች',
        'entries_title' => 'የሎግ ግቤቶች',
        'back_to_list' => 'ወደ ሎግ ፋይሎች ተመለስ',
        'no_entries' => 'ምንም የሎግ ግቤቶች አልተገኙም',
        'unsupported_format' => 'ይህ ፋይል መደበኛውን የ Laravel ሎግ ቅርጸት የሚጠቀም አይመስልም',
        'search_placeholder' => 'የሎግ ግቤቶችን ይፈልጉ...',
        'level_filter' => 'የሎግ ደረጃ',
        'email_recipient' => 'የተቀባይ ኢሜይል',
        'email_description' => 'ይህን የሎግ ፋይል ለተጠቀሰው ተቀባይ እንደ ኢሜይል አባሪ ይላኩ።',
        'bulk_email_description' => 'የተመረጡትን የሎግ ፋይሎች ለተጠቀሰው ተቀባይ እንደ ነጠላ ኢሜይል አባሪዎች ይላኩ።',
        'bulk_email_files' => 'የተመረጡ ፋይሎች',

        'filter' => [
            'date_from' => 'ከ',
            'date_to' => 'እስከ',
        ],

        'column' => [
            'filename' => 'የፋይል ስም',
            'size' => 'መጠን',
            'modified' => 'መጨረሻ የተሻሻለ',
            'subfolder' => 'ንዑስ አቃፊ',
            'level' => 'ደረጃ',
            'timestamp' => 'የጊዜ ማህተም',
            'message' => 'መልእክት',
        ],

        'action' => [
            'refresh' => 'አድስ',
            'view' => 'ይመልከቱ',
            'delete' => 'ሰርዝ',
            'download' => 'አውርድ',
            'email' => 'ኢሜይል ወደ',
            'email_send' => 'ላክ',
            'email_sent' => 'የሎግ ፋይል በኢሜይል በተሳካ ሁኔታ ተልኳል',
            'bulk_email_sent' => ':count የሎግ ፋይል(ዎች) በኢሜይል በተሳካ ሁኔታ ተልከዋል',
            'deleted' => 'የሎግ ፋይል ተሰርዟል',
            'bulk_deleted' => ':count የሎግ ፋይል(ዎች) ተሰርዘዋል',
        ],

        'confirm' => [
            'delete' => 'ይህን የሎግ ፋይል መሰረዝ እንደሚፈልጉ እርግጠኛ ነዎት? ይህ ድርጊት ሊቀለበስ አይችልም።',
            'bulk_delete' => 'የተመረጡትን የሎግ ፋይሎች መሰረዝ እንደሚፈልጉ እርግጠኛ ነዎት? ይህ ድርጊት ሊቀለበስ አይችልም።',
        ],

        'entry' => [
            'detail' => 'የግቤት ዝርዝር',
            'line' => 'መስመር',
            'trace_frames' => ':count ፍሬም|:count ፍሬሞች',
            'copy_trace' => 'ስታክ ትሬስ ቅዳ',
            'copy_entry' => 'ሙሉ ግቤትን ቅዳ',
            'copied' => 'ተቀድቷል!',
        ],
    ],

];
