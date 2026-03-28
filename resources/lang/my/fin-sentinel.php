<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'ဆက်တင်များ',
        'error_channel' => 'အမှား ချန်နယ်',
        'error_channel_title' => 'အမှား ချန်နယ် ဆက်တင်များ',
        'debug_channel' => 'Debug ချန်နယ်',
        'debug_channel_title' => 'Debug ချန်နယ် ဆက်တင်များ',
        'system_logs' => 'စနစ် မှတ်တမ်းများ',
        'log_files' => 'မှတ်တမ်း ဖိုင်များ',
        'log_entries' => 'မှတ်တမ်း ရေးသွင်းမှုများ',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'အရေးပေါ်',
            'ALERT' => 'သတိပေးချက်',
            'CRITICAL' => 'အရေးကြီး',
            'ERROR' => 'အမှား',
            'WARNING' => 'သတိပေး',
            'NOTICE' => 'အသိပေးချက်',
            'INFO' => 'အချက်အလက်',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'အမှား အကြောင်းကြားချက်',
            'debug' => 'Debug',
            'log_file' => 'မှတ်တမ်း ဖိုင်',
        ],
        'footer' => 'Fin-Sentinel မှ ပေးပို့သည်',

        'label' => [
            'error_message' => 'အမှား မက်ဆေ့ချ်',
            'class' => 'အတန်း',
            'file' => 'ဖိုင်',
            'context' => 'အကြောင်းအရာ',
            'command' => 'ကွန်မန်း',
            'url' => 'URL',
            'method' => 'မက်သပ်',
            'ip' => 'IP',
            'params' => 'ပါရာမီတာများ',
            'headers' => 'ခေါင်းစီးများ',
            'name' => 'အမည်',
            'email' => 'အီးမေးလ်',
            'id' => 'ID',
            'user' => 'အသုံးပြုသူ',
            'environment' => 'ပတ်ဝန်းကျင်',
            'debug_mode' => 'Debug မုဒ်',
            'php_version' => 'PHP ဗားရှင်း',
            'laravel_version' => 'Laravel ဗားရှင်း',
            'laravel' => 'Laravel',
            'peak_memory' => 'အမြင့်ဆုံး မမ်မိုရီ',
            'enabled' => 'ဖွင့်ထား',
            'disabled' => 'ပိတ်ထား',
            'relation' => 'ဆက်စပ်မှု: :name',
            'bindings' => 'ဘိုင်းဒင်းများ:',
            'trace_number' => '#',
            'trace_location' => 'တည်နေရာ',
            'trace_call' => 'ခေါ်ဆိုမှု',
        ],

        'collection' => [
            'count' => ':count ခု|:count ခု',
            'more' => '... နှင့် နောက်ထပ် :count ခု',
        ],

        'error' => [
            'subject' => ':app - အမှားတစ်ခု ဖြစ်ပေါ်ခဲ့သည်',
            'guest' => 'ဧည့်သည်',
            'console' => 'ကွန်ဆိုး',
            'section_exception' => 'ချွင်းချက် အသေးစိတ်',
            'section_trace' => 'စတက် ထရိတ်စ်',
            'section_request' => 'တောင်းဆိုမှု အကြောင်းအရာ',
            'section_user' => 'အတည်ပြုထားသော အသုံးပြုသူ',
            'section_environment' => 'ပတ်ဝန်းကျင်',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'ဧည့်သည်',
            'console' => 'ကွန်ဆိုး',
            'section_data' => 'Debug ဒေတာ',
            'section_call_site' => 'ခေါ်ဆိုမှု နေရာ',
            'section_request' => 'တောင်းဆိုမှု အကြောင်းအရာ',
            'section_environment' => 'ပတ်ဝန်းကျင်',
        ],

        'log_file' => [
            'subject' => ':app - မှတ်တမ်း ဖိုင်: :file',
            'bulk_subject' => ':app - မှတ်တမ်း ဖိုင် :count ခု ပူးတွဲပါ',
            'body' => ':app မှ မှတ်တမ်း ဖိုင် <strong>:file</strong> ပူးတွဲပါသည်။',
            'body_text' => ':app မှ မှတ်တမ်း ဖိုင် :file ပူးတွဲပါသည်။',
        ],
    ],

    'settings' => [
        'recipients' => 'လက်ခံသူများ',
        'throttling' => 'ထရော့တ်လင်း',
        'email_address' => 'အီးမေးလ် လိပ်စာ',
        'add_recipient' => 'လက်ခံသူ ထည့်ရန်',
        'no_recipients_warning' => 'လက်ခံသူ သတ်မှတ်မထားပါ — အီးမေးလ် အနည်းဆုံး တစ်ခု ထည့်မှသာ အကြောင်းကြားချက်များ ပေးပို့မည်။',
        'throttle_rate' => 'ထရော့တ် နှုန်း',
        'minutes_suffix' => 'မိနစ်',

        'error' => [
            'enabled' => 'အမှား အကြောင်းကြားချက်များ ဖွင့်ရန်',
            'enabled_helper' => 'ပိတ်ထားပါက အမှား အီးမေးလ်များ ပေးပို့မည် မဟုတ်ပါ။',
            'recipients_helper' => 'အမှား အကြောင်းကြားချက်များ လက်ခံမည့် အီးမေးလ် လိပ်စာများ ထည့်ပါ။',
            'throttle_helper' => 'ထပ်တူ အမှား အီးမေးလ်များ ကြားရှိ အနည်းဆုံး မိနစ်။',
            'throttle_exceptions' => 'ချွင်းချက် ထရော့တ်လင်း',
            'throttle_exceptions_helper' => 'ဖွင့်ထားပါက တူညီသော file:line ရှိ ထပ်တူ ချွင်းချက်များသည် ထရော့တ် ဝင်းဒိုးအတွင်း အီးမေးလ် ပေးပို့မည် မဟုတ်ပါ။',
            'throttle_log_messages' => 'မှတ်တမ်း မက်ဆေ့ချ် ထရော့တ်လင်း',
            'throttle_log_messages_helper' => 'ဖွင့်ထားပါက တူညီသော အမှား မှတ်တမ်း မက်ဆေ့ချ်များသည် ထရော့တ် ဝင်းဒိုးအတွင်း အီးမေးလ် ပေးပို့မည် မဟုတ်ပါ။',
            'ignored_exceptions' => 'လျစ်လျူရှုထားသော ချွင်းချက်များ',
            'ignored_exceptions_description' => 'ဤစာရင်းရှိ ချွင်းချက်များသည် အီးမေးလ် အကြောင်းကြားချက်များ ပေးပို့မည် မဟုတ်ပါ။',
            'ignored_exceptions_label' => 'လျစ်လျူရှုထားသော ချွင်းချက်များ',
            'other_custom' => 'အခြား (စိတ်ကြိုက်)',
            'exception_class' => 'ချွင်းချက် အတန်း (FQCN)',
            'class_not_exist' => 'ဤအတန်း မရှိပါ။',
            'custom_exception' => 'စိတ်ကြိုက် ချွင်းချက်',
            'select_exception' => 'ချွင်းချက် ရွေးပါ',
            'add_exception' => 'ခြွင်းချက် ထည့်ရန်',
        ],

        'debug' => [
            'enabled' => 'Debug ချန်နယ် ဖွင့်ရန်',
            'enabled_helper' => 'ပိတ်ထားပါက Sentinel::debug() ခေါ်ဆိုမှုများကို တိတ်ဆိတ်စွာ လျစ်လျူရှုမည်။',
            'recipients_helper' => 'Debug အကြောင်းကြားချက်များ လက်ခံမည့် အီးမေးလ် လိပ်စာများ ထည့်ပါ။',
            'throttle_enabled' => 'ထရော့တ်လင်း ဖွင့်ရန်',
            'throttle_enabled_helper' => 'ပိတ်ထားပါက Debug ခေါ်ဆိုမှု တိုင်း အီးမေးလ် ပေးပို့မည်။ ဖွင့်ထားပါက ထပ်တူ ခေါ်ဆိုမှုများကို ထရော့တ် လုပ်မည်။',
            'throttle_helper' => 'ထပ်တူ Debug အီးမေးလ်များ ကြားရှိ အနည်းဆုံး မိနစ်။',
        ],

        'test_email' => [
            'send' => 'စမ်းသပ် အီးမေးလ် ပေးပို့ရန်',
            'sent' => 'လက်ခံသူ :count ဦးထံ စမ်းသပ် အီးမေးလ် ပေးပို့ပြီး',
            'no_recipients' => 'လက်ခံသူ သတ်မှတ်မထားပါ။ အီးမေးလ် လိပ်စာ အနည်းဆုံး တစ်ခု အရင် ထည့်ပါ။',
            'failed' => 'စမ်းသပ် အီးမေးလ် ပေးပို့ မအောင်မြင်ပါ',
            'channel_disabled' => 'ဤချန်နယ်ကို လက်ရှိ ပိတ်ထားပါသည်။ စမ်းသပ် အီးမေးလ်ကို ပေးပို့ဆဲ ဖြစ်ပါမည်။',
        ],
    ],

    'logs' => [
        'title' => 'စနစ် မှတ်တမ်းများ',
        'heading' => 'မှတ်တမ်း ဖိုင်များ',
        'entries_title' => 'မှတ်တမ်း ရေးသွင်းမှုများ',
        'back_to_list' => 'မှတ်တမ်း ဖိုင်များသို့ ပြန်သွားရန်',
        'no_entries' => 'မှတ်တမ်း ရေးသွင်းမှု မတွေ့ပါ',
        'unsupported_format' => 'ဤဖိုင်သည် စံ Laravel မှတ်တမ်း ပုံစံကို အသုံးပြုထားပုံ မရပါ',
        'search_placeholder' => 'မှတ်တမ်း ရေးသွင်းမှုများ ရှာရန်...',
        'level_filter' => 'မှတ်တမ်း အဆင့်',
        'email_recipient' => 'လက်ခံသူ အီးမေးလ်',
        'email_description' => 'ဤမှတ်တမ်း ဖိုင်ကို သတ်မှတ်ထားသော လက်ခံသူထံ အီးမေးလ် ပူးတွဲဖိုင်အဖြစ် ပေးပို့ပါ။',
        'bulk_email_description' => 'ရွေးချယ်ထားသော မှတ်တမ်း ဖိုင်များကို သတ်မှတ်ထားသော လက်ခံသူထံ သီးခြား အီးမေးလ် ပူးတွဲဖိုင်များအဖြစ် ပေးပို့ပါ။',
        'bulk_email_files' => 'ရွေးချယ်ထားသော ဖိုင်များ',

        'filter' => [
            'date_from' => 'မှ',
            'date_to' => 'ထိ',
        ],

        'column' => [
            'filename' => 'ဖိုင်အမည်',
            'size' => 'အရွယ်အစား',
            'modified' => 'နောက်ဆုံး ပြင်ဆင်ချိန်',
            'subfolder' => 'ဖိုင်တွဲခွဲ',
            'level' => 'အဆင့်',
            'timestamp' => 'အချိန်',
            'message' => 'မက်ဆေ့ချ်',
        ],

        'action' => [
            'refresh' => 'ပြန်လည်ဖတ်ရန်',
            'view' => 'ကြည့်ရန်',
            'delete' => 'ဖျက်ရန်',
            'download' => 'ဒေါင်းလုဒ်',
            'email' => 'အီးမေးလ် ပို့ရန်',
            'email_send' => 'ပို့ရန်',
            'email_sent' => 'မှတ်တမ်း ဖိုင် အောင်မြင်စွာ အီးမေးလ် ပေးပို့ပြီး',
            'bulk_email_sent' => 'မှတ်တမ်း ဖိုင် :count ခု အောင်မြင်စွာ အီးမေးလ် ပေးပို့ပြီး',
            'deleted' => 'မှတ်တမ်း ဖိုင် ဖျက်ပြီး',
            'bulk_deleted' => 'မှတ်တမ်း ဖိုင် :count ခု ဖျက်ပြီး',
        ],

        'confirm' => [
            'delete' => 'ဤမှတ်တမ်း ဖိုင်ကို ဖျက်လိုသည်မှာ သေချာပါသလား? ဤလုပ်ဆောင်ချက်ကို ပြန်ဖျက် မရပါ။',
            'bulk_delete' => 'ရွေးချယ်ထားသော မှတ်တမ်း ဖိုင်များကို ဖျက်လိုသည်မှာ သေချာပါသလား? ဤလုပ်ဆောင်ချက်ကို ပြန်ဖျက် မရပါ။',
        ],

        'entry' => [
            'detail' => 'ရေးသွင်းမှု အသေးစိတ်',
            'line' => 'စာကြောင်း',
            'trace_frames' => ':count ဖရိမ်|:count ဖရိမ်',
            'copy_trace' => 'စတက် ထရိတ်စ် ကူးရန်',
            'copy_entry' => 'ရေးသွင်းမှု အပြည့်အစုံ ကူးရန်',
            'copied' => 'ကူးပြီး!',
        ],
    ],

];
