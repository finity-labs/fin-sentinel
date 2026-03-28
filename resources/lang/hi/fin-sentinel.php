<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'सेटिंग्स',
        'error_channel' => 'त्रुटि चैनल',
        'error_channel_title' => 'त्रुटि चैनल सेटिंग्स',
        'debug_channel' => 'Debug चैनल',
        'debug_channel_title' => 'Debug चैनल सेटिंग्स',
        'system_logs' => 'सिस्टम लॉग',
        'log_files' => 'लॉग फ़ाइलें',
        'log_entries' => 'लॉग प्रविष्टियाँ',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'आपातकालीन',
            'ALERT' => 'अलर्ट',
            'CRITICAL' => 'गंभीर',
            'ERROR' => 'त्रुटि',
            'WARNING' => 'चेतावनी',
            'NOTICE' => 'सूचना',
            'INFO' => 'जानकारी',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'त्रुटि सूचना',
            'debug' => 'Debug',
            'log_file' => 'लॉग फ़ाइल',
        ],
        'footer' => 'Fin-Sentinel द्वारा भेजा गया',

        'label' => [
            'error_message' => 'त्रुटि संदेश',
            'class' => 'क्लास',
            'file' => 'फ़ाइल',
            'context' => 'संदर्भ',
            'command' => 'कमांड',
            'url' => 'URL',
            'method' => 'मेथड',
            'ip' => 'IP',
            'params' => 'पैरामीटर',
            'headers' => 'हेडर्स',
            'name' => 'नाम',
            'email' => 'ईमेल',
            'id' => 'ID',
            'user' => 'उपयोगकर्ता',
            'environment' => 'एनवायरनमेंट',
            'debug_mode' => 'Debug मोड',
            'php_version' => 'PHP संस्करण',
            'laravel_version' => 'Laravel संस्करण',
            'laravel' => 'Laravel',
            'peak_memory' => 'पीक मेमोरी',
            'enabled' => 'सक्रिय',
            'disabled' => 'निष्क्रिय',
            'relation' => 'रिलेशन: :name',
            'bindings' => 'बाइंडिंग्स:',
            'trace_number' => '#',
            'trace_location' => 'स्थान',
            'trace_call' => 'कॉल',
        ],

        'collection' => [
            'count' => ':count आइटम|:count आइटम',
            'more' => '... और :count अन्य आइटम',
        ],

        'error' => [
            'subject' => ':app - एक त्रुटि हुई है',
            'guest' => 'अतिथि',
            'console' => 'कंसोल',
            'section_exception' => 'अपवाद विवरण',
            'section_trace' => 'स्टैक ट्रेस',
            'section_request' => 'रिक्वेस्ट संदर्भ',
            'section_user' => 'प्रमाणित उपयोगकर्ता',
            'section_environment' => 'एनवायरनमेंट',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'अतिथि',
            'console' => 'कंसोल',
            'section_data' => 'Debug डेटा',
            'section_call_site' => 'कॉल साइट',
            'section_request' => 'रिक्वेस्ट संदर्भ',
            'section_environment' => 'एनवायरनमेंट',
        ],

        'log_file' => [
            'subject' => ':app - लॉग फ़ाइल: :file',
            'bulk_subject' => ':app - :count लॉग फ़ाइलें संलग्न',
            'body' => ':app से लॉग फ़ाइल <strong>:file</strong> संलग्न है।',
            'body_text' => ':app से लॉग फ़ाइल :file संलग्न है।',
        ],
    ],

    'settings' => [
        'recipients' => 'प्राप्तकर्ता',
        'throttling' => 'थ्रॉटलिंग',
        'email_address' => 'ईमेल पता',
        'add_recipient' => 'प्राप्तकर्ता जोड़ें',
        'no_recipients_warning' => 'कोई प्राप्तकर्ता कॉन्फ़िगर नहीं किया गया है — जब तक कम से कम एक ईमेल नहीं जोड़ा जाता, सूचनाएँ नहीं भेजी जाएँगी।',
        'throttle_rate' => 'थ्रॉटल दर',
        'minutes_suffix' => 'मिनट',

        'error' => [
            'enabled' => 'त्रुटि सूचनाएँ सक्रिय करें',
            'enabled_helper' => 'निष्क्रिय होने पर, कोई त्रुटि ईमेल नहीं भेजा जाएगा।',
            'recipients_helper' => 'ऐसे ईमेल पते जोड़ें जिन्हें त्रुटि सूचनाएँ प्राप्त होंगी।',
            'throttle_helper' => 'डुप्लिकेट त्रुटि ईमेल के बीच न्यूनतम मिनट।',
            'throttle_exceptions' => 'अपवाद थ्रॉटलिंग',
            'throttle_exceptions_helper' => 'सक्रिय होने पर, एक ही file:line पर डुप्लिकेट अपवाद थ्रॉटल विंडो में ईमेल ट्रिगर नहीं करेंगे।',
            'throttle_log_messages' => 'लॉग संदेश थ्रॉटलिंग',
            'throttle_log_messages_helper' => 'सक्रिय होने पर, समान त्रुटि लॉग संदेश थ्रॉटल विंडो में ईमेल ट्रिगर नहीं करेंगे।',
            'ignored_exceptions' => 'नज़रअंदाज़ किए गए अपवाद',
            'ignored_exceptions_description' => 'इस सूची में अपवाद ईमेल सूचनाएँ ट्रिगर नहीं करेंगे।',
            'ignored_exceptions_label' => 'नज़रअंदाज़ किए गए अपवाद',
            'other_custom' => 'अन्य (कस्टम)',
            'exception_class' => 'अपवाद क्लास (FQCN)',
            'class_not_exist' => 'यह क्लास मौजूद नहीं है।',
            'custom_exception' => 'कस्टम अपवाद',
            'select_exception' => 'अपवाद चुनें',
            'add_exception' => 'अपवाद जोड़ें',
        ],

        'debug' => [
            'enabled' => 'Debug चैनल सक्रिय करें',
            'enabled_helper' => 'निष्क्रिय होने पर, Sentinel::debug() कॉल चुपचाप अनदेखी कर दिए जाएँगे।',
            'recipients_helper' => 'ऐसे ईमेल पते जोड़ें जिन्हें Debug सूचनाएँ प्राप्त होंगी।',
            'throttle_enabled' => 'थ्रॉटलिंग सक्रिय करें',
            'throttle_enabled_helper' => 'निष्क्रिय होने पर, हर Debug कॉल एक ईमेल भेजेगा। सक्रिय होने पर, डुप्लिकेट कॉल थ्रॉटल किए जाएँगे।',
            'throttle_helper' => 'डुप्लिकेट Debug ईमेल के बीच न्यूनतम मिनट।',
        ],

        'test_email' => [
            'send' => 'टेस्ट ईमेल भेजें',
            'sent' => ':count प्राप्तकर्ता(ओं) को टेस्ट ईमेल भेजा गया',
            'no_recipients' => 'कोई प्राप्तकर्ता कॉन्फ़िगर नहीं है। पहले कम से कम एक ईमेल पता जोड़ें।',
            'failed' => 'टेस्ट ईमेल भेजने में विफल',
            'channel_disabled' => 'यह चैनल वर्तमान में निष्क्रिय है। टेस्ट ईमेल फिर भी भेजा जाएगा।',
        ],
    ],

    'logs' => [
        'title' => 'सिस्टम लॉग',
        'heading' => 'लॉग फ़ाइलें',
        'entries_title' => 'लॉग प्रविष्टियाँ',
        'back_to_list' => 'लॉग फ़ाइलों पर वापस जाएँ',
        'no_entries' => 'कोई लॉग प्रविष्टि नहीं मिली',
        'unsupported_format' => 'यह फ़ाइल मानक Laravel लॉग प्रारूप में नहीं लगती',
        'search_placeholder' => 'लॉग प्रविष्टियाँ खोजें...',
        'level_filter' => 'लॉग स्तर',
        'email_recipient' => 'प्राप्तकर्ता ईमेल',
        'email_description' => 'यह लॉग फ़ाइल निर्दिष्ट प्राप्तकर्ता को ईमेल अटैचमेंट के रूप में भेजें।',
        'bulk_email_description' => 'चयनित लॉग फ़ाइलें निर्दिष्ट प्राप्तकर्ता को अलग-अलग ईमेल अटैचमेंट के रूप में भेजें।',
        'bulk_email_files' => 'चयनित फ़ाइलें',

        'filter' => [
            'date_from' => 'से',
            'date_to' => 'तक',
        ],

        'column' => [
            'filename' => 'फ़ाइल का नाम',
            'size' => 'आकार',
            'modified' => 'अंतिम संशोधित',
            'subfolder' => 'सबफ़ोल्डर',
            'level' => 'स्तर',
            'timestamp' => 'समय',
            'message' => 'संदेश',
        ],

        'action' => [
            'refresh' => 'रिफ़्रेश',
            'view' => 'देखें',
            'delete' => 'हटाएँ',
            'download' => 'डाउनलोड',
            'email' => 'ईमेल करें',
            'email_send' => 'भेजें',
            'email_sent' => 'लॉग फ़ाइल सफलतापूर्वक ईमेल की गई',
            'bulk_email_sent' => ':count लॉग फ़ाइल(लें) सफलतापूर्वक ईमेल की गईं',
            'deleted' => 'लॉग फ़ाइल हटा दी गई',
            'bulk_deleted' => ':count लॉग फ़ाइल(लें) हटा दी गईं',
        ],

        'confirm' => [
            'delete' => 'क्या आप वाकई इस लॉग फ़ाइल को हटाना चाहते हैं? यह क्रिया पूर्ववत नहीं की जा सकती।',
            'bulk_delete' => 'क्या आप वाकई चयनित लॉग फ़ाइलों को हटाना चाहते हैं? यह क्रिया पूर्ववत नहीं की जा सकती।',
        ],

        'entry' => [
            'detail' => 'प्रविष्टि विवरण',
            'line' => 'पंक्ति',
            'trace_frames' => ':count फ़्रेम|:count फ़्रेम',
            'copy_trace' => 'स्टैक ट्रेस कॉपी करें',
            'copy_entry' => 'पूरी प्रविष्टि कॉपी करें',
            'copied' => 'कॉपी हो गया!',
        ],
    ],

];
