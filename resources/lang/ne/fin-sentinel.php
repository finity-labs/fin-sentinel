<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'सेटिङ्स',
        'error_channel' => 'त्रुटि च्यानल',
        'error_channel_title' => 'त्रुटि च्यानल सेटिङ्स',
        'debug_channel' => 'Debug च्यानल',
        'debug_channel_title' => 'Debug च्यानल सेटिङ्स',
        'system_logs' => 'सिस्टम लग',
        'log_files' => 'लग फाइलहरू',
        'log_entries' => 'लग प्रविष्टिहरू',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'आपतकालीन',
            'ALERT' => 'सतर्कता',
            'CRITICAL' => 'गम्भीर',
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
            'log_file' => 'लग फाइल',
        ],
        'footer' => 'Fin-Sentinel द्वारा पठाइएको',

        'label' => [
            'error_message' => 'त्रुटि सन्देश',
            'class' => 'क्लास',
            'file' => 'फाइल',
            'context' => 'सन्दर्भ',
            'command' => 'कमाण्ड',
            'url' => 'URL',
            'method' => 'मेथड',
            'ip' => 'IP',
            'params' => 'प्यारामिटर',
            'headers' => 'हेडर्स',
            'name' => 'नाम',
            'email' => 'इमेल',
            'id' => 'ID',
            'user' => 'प्रयोगकर्ता',
            'environment' => 'वातावरण',
            'debug_mode' => 'Debug मोड',
            'php_version' => 'PHP संस्करण',
            'laravel_version' => 'Laravel संस्करण',
            'laravel' => 'Laravel',
            'peak_memory' => 'पिक मेमोरी',
            'enabled' => 'सक्रिय',
            'disabled' => 'निष्क्रिय',
            'relation' => 'रिलेशन: :name',
            'bindings' => 'बाइन्डिङ्स:',
            'trace_number' => '#',
            'trace_location' => 'स्थान',
            'trace_call' => 'कल',
        ],

        'collection' => [
            'count' => ':count वस्तु|:count वस्तुहरू',
            'more' => '... र :count थप वस्तुहरू',
        ],

        'error' => [
            'subject' => ':app - एक त्रुटि भएको छ',
            'guest' => 'अतिथि',
            'console' => 'कन्सोल',
            'section_exception' => 'अपवाद विवरण',
            'section_trace' => 'स्ट्याक ट्रेस',
            'section_request' => 'अनुरोध सन्दर्भ',
            'section_user' => 'प्रमाणीकृत प्रयोगकर्ता',
            'section_environment' => 'वातावरण',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'अतिथि',
            'console' => 'कन्सोल',
            'section_data' => 'Debug डेटा',
            'section_call_site' => 'कल साइट',
            'section_request' => 'अनुरोध सन्दर्भ',
            'section_environment' => 'वातावरण',
        ],

        'log_file' => [
            'subject' => ':app - लग फाइल: :file',
            'bulk_subject' => ':app - :count लग फाइलहरू संलग्न',
            'body' => ':app बाट लग फाइल <strong>:file</strong> संलग्न छ।',
            'body_text' => ':app बाट लग फाइल :file संलग्न छ।',
        ],
    ],

    'settings' => [
        'recipients' => 'प्राप्तकर्ता',
        'throttling' => 'थ्रटलिङ',
        'email_address' => 'इमेल ठेगाना',
        'add_recipient' => 'प्राप्तकर्ता थप्नुहोस्',
        'no_recipients_warning' => 'कुनै प्राप्तकर्ता कन्फिगर गरिएको छैन — कम्तीमा एउटा इमेल नथपेसम्म सूचनाहरू पठाइने छैन।',
        'throttle_rate' => 'थ्रटल दर',
        'minutes_suffix' => 'मिनेट',

        'error' => [
            'enabled' => 'त्रुटि सूचनाहरू सक्रिय गर्नुहोस्',
            'enabled_helper' => 'निष्क्रिय हुँदा, कुनै त्रुटि इमेल पठाइने छैन।',
            'recipients_helper' => 'त्रुटि सूचनाहरू प्राप्त गर्ने इमेल ठेगानाहरू थप्नुहोस्।',
            'throttle_helper' => 'डुप्लिकेट त्रुटि इमेलहरू बीचको न्यूनतम मिनेट।',
            'throttle_exceptions' => 'अपवाद थ्रटलिङ',
            'throttle_exceptions_helper' => 'सक्रिय हुँदा, उही file:line मा डुप्लिकेट अपवादहरूले थ्रटल विन्डोमा इमेल ट्रिगर गर्ने छैनन्।',
            'throttle_log_messages' => 'लग सन्देश थ्रटलिङ',
            'throttle_log_messages_helper' => 'सक्रिय हुँदा, उस्तै त्रुटि लग सन्देशहरूले थ्रटल विन्डोमा इमेल ट्रिगर गर्ने छैनन्।',
            'ignored_exceptions' => 'बेवास्ता गरिएका अपवादहरू',
            'ignored_exceptions_description' => 'यो सूचीका अपवादहरूले इमेल सूचनाहरू ट्रिगर गर्ने छैनन्।',
            'ignored_exceptions_label' => 'बेवास्ता गरिएका अपवादहरू',
            'other_custom' => 'अन्य (कस्टम)',
            'exception_class' => 'अपवाद क्लास (FQCN)',
            'class_not_exist' => 'यो क्लास अवस्थित छैन।',
            'custom_exception' => 'कस्टम अपवाद',
            'select_exception' => 'अपवाद छान्नुहोस्',
            'add_exception' => 'अपवाद थप्नुहोस्',
        ],

        'debug' => [
            'enabled' => 'Debug च्यानल सक्रिय गर्नुहोस्',
            'enabled_helper' => 'निष्क्रिय हुँदा, Sentinel::debug() कलहरू चुपचाप बेवास्ता गरिनेछन्।',
            'recipients_helper' => 'Debug सूचनाहरू प्राप्त गर्ने इमेल ठेगानाहरू थप्नुहोस्।',
            'throttle_enabled' => 'थ्रटलिङ सक्रिय गर्नुहोस्',
            'throttle_enabled_helper' => 'निष्क्रिय हुँदा, हरेक Debug कलले इमेल पठाउँछ। सक्रिय हुँदा, डुप्लिकेट कलहरू थ्रटल गरिन्छन्।',
            'throttle_helper' => 'डुप्लिकेट Debug इमेलहरू बीचको न्यूनतम मिनेट।',
        ],

        'test_email' => [
            'send' => 'टेस्ट इमेल पठाउनुहोस्',
            'sent' => ':count प्राप्तकर्ता(हरू)लाई टेस्ट इमेल पठाइयो',
            'no_recipients' => 'कुनै प्राप्तकर्ता कन्फिगर गरिएको छैन। पहिले कम्तीमा एउटा इमेल ठेगाना थप्नुहोस्।',
            'failed' => 'टेस्ट इमेल पठाउन असफल',
            'channel_disabled' => 'यो च्यानल हाल निष्क्रिय छ। टेस्ट इमेल फेरि पनि पठाइनेछ।',
        ],
    ],

    'logs' => [
        'title' => 'सिस्टम लग',
        'heading' => 'लग फाइलहरू',
        'entries_title' => 'लग प्रविष्टिहरू',
        'back_to_list' => 'लग फाइलहरूमा फर्कनुहोस्',
        'no_entries' => 'कुनै लग प्रविष्टि भेटिएन',
        'unsupported_format' => 'यो फाइल मानक Laravel लग ढाँचामा नभएको जस्तो देखिन्छ',
        'search_placeholder' => 'लग प्रविष्टिहरू खोज्नुहोस्...',
        'level_filter' => 'लग स्तर',
        'email_recipient' => 'प्राप्तकर्ता इमेल',
        'email_description' => 'यो लग फाइल निर्दिष्ट प्राप्तकर्तालाई इमेल संलग्नकको रूपमा पठाउनुहोस्।',
        'bulk_email_description' => 'चयन गरिएका लग फाइलहरू निर्दिष्ट प्राप्तकर्तालाई अलग-अलग इमेल संलग्नकको रूपमा पठाउनुहोस्।',
        'bulk_email_files' => 'चयन गरिएका फाइलहरू',

        'filter' => [
            'date_from' => 'देखि',
            'date_to' => 'सम्म',
        ],

        'column' => [
            'filename' => 'फाइल नाम',
            'size' => 'आकार',
            'modified' => 'अन्तिम परिमार्जित',
            'subfolder' => 'सबफोल्डर',
            'level' => 'स्तर',
            'timestamp' => 'समय',
            'message' => 'सन्देश',
        ],

        'action' => [
            'refresh' => 'रिफ्रेस',
            'view' => 'हेर्नुहोस्',
            'delete' => 'मेट्नुहोस्',
            'download' => 'डाउनलोड',
            'email' => 'इमेल गर्नुहोस्',
            'email_send' => 'पठाउनुहोस्',
            'email_sent' => 'लग फाइल सफलतापूर्वक इमेल गरियो',
            'bulk_email_sent' => ':count लग फाइल(हरू) सफलतापूर्वक इमेल गरियो',
            'deleted' => 'लग फाइल मेटियो',
            'bulk_deleted' => ':count लग फाइल(हरू) मेटियो',
        ],

        'confirm' => [
            'delete' => 'के तपाईं यो लग फाइल मेट्न निश्चित हुनुहुन्छ? यो कार्य पूर्ववत गर्न सकिँदैन।',
            'bulk_delete' => 'के तपाईं चयन गरिएका लग फाइलहरू मेट्न निश्चित हुनुहुन्छ? यो कार्य पूर्ववत गर्न सकिँदैन।',
        ],

        'entry' => [
            'detail' => 'प्रविष्टि विवरण',
            'line' => 'लाइन',
            'trace_frames' => ':count फ्रेम|:count फ्रेमहरू',
            'copy_trace' => 'स्ट्याक ट्रेस कपी गर्नुहोस्',
            'copy_entry' => 'पूर्ण प्रविष्टि कपी गर्नुहोस्',
            'copied' => 'कपी भयो!',
        ],
    ],

];
