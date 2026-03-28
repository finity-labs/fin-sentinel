<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Mipangilio',
        'error_channel' => 'Kituo cha Hitilafu',
        'error_channel_title' => 'Mipangilio ya Kituo cha Hitilafu',
        'debug_channel' => 'Kituo cha Debug',
        'debug_channel_title' => 'Mipangilio ya Kituo cha Debug',
        'system_logs' => 'Kumbukumbu za Mfumo',
        'log_files' => 'Faili za Kumbukumbu',
        'log_entries' => 'Maingizo ya Kumbukumbu',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Dharura',
            'ALERT' => 'Tahadhari',
            'CRITICAL' => 'Hatari',
            'ERROR' => 'Hitilafu',
            'WARNING' => 'Onyo',
            'NOTICE' => 'Taarifa',
            'INFO' => 'Maelezo',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Arifa ya Hitilafu',
            'debug' => 'Debug',
            'log_file' => 'Faili ya Kumbukumbu',
        ],
        'footer' => 'Imetumwa na Fin-Sentinel',

        'label' => [
            'error_message' => 'Ujumbe wa Hitilafu',
            'class' => 'Darasa',
            'file' => 'Faili',
            'context' => 'Muktadha',
            'command' => 'Amri',
            'url' => 'URL',
            'method' => 'Njia',
            'ip' => 'IP',
            'params' => 'Vigezo',
            'headers' => 'Vichwa',
            'name' => 'Jina',
            'email' => 'Barua pepe',
            'id' => 'ID',
            'user' => 'Mtumiaji',
            'environment' => 'Mazingira',
            'debug_mode' => 'Hali ya Debug',
            'php_version' => 'Toleo la PHP',
            'laravel_version' => 'Toleo la Laravel',
            'laravel' => 'Laravel',
            'peak_memory' => 'Kumbukumbu ya Juu',
            'enabled' => 'Imewashwa',
            'disabled' => 'Imezimwa',
            'relation' => 'Uhusiano: :name',
            'bindings' => 'Vifungo:',
            'trace_number' => '#',
            'trace_location' => 'Eneo',
            'trace_call' => 'Wito',
        ],

        'collection' => [
            'count' => 'kipengee :count|vipengee :count',
            'more' => '... na vipengee :count zaidi',
        ],

        'error' => [
            'subject' => ':app - Hitilafu imetokea',
            'guest' => 'Mgeni',
            'console' => 'Konsoli',
            'section_exception' => 'Maelezo ya Ubaguzi',
            'section_trace' => 'Ufuatiliaji wa Steki',
            'section_request' => 'Muktadha wa Ombi',
            'section_user' => 'Mtumiaji Aliyethibitishwa',
            'section_environment' => 'Mazingira',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Mgeni',
            'console' => 'Konsoli',
            'section_data' => 'Data ya Debug',
            'section_call_site' => 'Eneo la Wito',
            'section_request' => 'Muktadha wa Ombi',
            'section_environment' => 'Mazingira',
        ],

        'log_file' => [
            'subject' => ':app - Faili ya kumbukumbu: :file',
            'bulk_subject' => ':app - Faili :count za kumbukumbu zimeambatishwa',
            'body' => 'Faili ya kumbukumbu <strong>:file</strong> kutoka :app imeambatishwa.',
            'body_text' => 'Faili ya kumbukumbu :file kutoka :app imeambatishwa.',
        ],
    ],

    'settings' => [
        'recipients' => 'Wapokeaji',
        'throttling' => 'Udhibiti wa Kasi',
        'email_address' => 'Anwani ya barua pepe',
        'add_recipient' => 'Ongeza mpokeaji',
        'no_recipients_warning' => 'Hakuna wapokeaji waliowekwa — arifa hazitatumwa hadi barua pepe angalau moja iongezwe.',
        'throttle_rate' => 'Kiwango cha udhibiti',
        'minutes_suffix' => 'dakika',

        'error' => [
            'enabled' => 'Wezesha arifa za hitilafu',
            'enabled_helper' => 'Ikizimwa, hakuna barua pepe za hitilafu zitatumwa.',
            'recipients_helper' => 'Ongeza anwani za barua pepe zitakazopokea arifa za hitilafu.',
            'throttle_helper' => 'Dakika za chini kati ya barua pepe za hitilafu zinazofanana.',
            'throttle_exceptions' => 'Udhibiti wa ubaguzi',
            'throttle_exceptions_helper' => 'Ikiwashwa, ubaguzi unaofanana kwenye file:line sawa hautasababisha barua pepe ndani ya dirisha la udhibiti.',
            'throttle_log_messages' => 'Udhibiti wa ujumbe wa kumbukumbu',
            'throttle_log_messages_helper' => 'Ikiwashwa, ujumbe wa kumbukumbu wa hitilafu unaofanana hautasababisha barua pepe ndani ya dirisha la udhibiti.',
            'ignored_exceptions' => 'Ubaguzi Uliopuuzwa',
            'ignored_exceptions_description' => 'Ubaguzi katika orodha hii hautasababisha arifa za barua pepe.',
            'ignored_exceptions_label' => 'Ubaguzi uliopuuzwa',
            'other_custom' => 'Nyingine (maalum)',
            'exception_class' => 'Darasa la ubaguzi (FQCN)',
            'class_not_exist' => 'Darasa hili halipo.',
            'custom_exception' => 'Ubaguzi maalum',
            'select_exception' => 'Chagua ubaguzi',
            'add_exception' => 'Ongeza ubaguzi',
        ],

        'debug' => [
            'enabled' => 'Wezesha kituo cha Debug',
            'enabled_helper' => 'Ikizimwa, wito wa Sentinel::debug() utapuuzwa kimya.',
            'recipients_helper' => 'Ongeza anwani za barua pepe zitakazopokea arifa za Debug.',
            'throttle_enabled' => 'Wezesha udhibiti wa kasi',
            'throttle_enabled_helper' => 'Ikizimwa, kila wito wa Debug utatuma barua pepe. Ikiwashwa, wito zinazofanana zitadhibitiwa.',
            'throttle_helper' => 'Dakika za chini kati ya barua pepe za Debug zinazofanana.',
        ],

        'test_email' => [
            'send' => 'Tuma Barua Pepe ya Majaribio',
            'sent' => 'Barua pepe ya majaribio imetumwa kwa wapokeaji :count',
            'no_recipients' => 'Hakuna wapokeaji waliowekwa. Ongeza angalau anwani moja ya barua pepe kwanza.',
            'failed' => 'Imeshindwa kutuma barua pepe ya majaribio',
            'channel_disabled' => 'Kituo hiki kimezimwa kwa sasa. Barua pepe ya majaribio bado itatumwa.',
        ],
    ],

    'logs' => [
        'title' => 'Kumbukumbu za Mfumo',
        'heading' => 'Faili za Kumbukumbu',
        'entries_title' => 'Maingizo ya Kumbukumbu',
        'back_to_list' => 'Rudi kwenye Faili za Kumbukumbu',
        'no_entries' => 'Hakuna maingizo ya kumbukumbu yaliyopatikana',
        'unsupported_format' => 'Faili hii haionekani kutumia muundo wa kawaida wa kumbukumbu wa Laravel',
        'search_placeholder' => 'Tafuta maingizo ya kumbukumbu...',
        'level_filter' => 'Kiwango cha Kumbukumbu',
        'email_recipient' => 'Barua Pepe ya Mpokeaji',
        'email_description' => 'Tuma faili hii ya kumbukumbu kama kiambatisho cha barua pepe kwa mpokeaji aliyeainishwa.',
        'bulk_email_description' => 'Tuma faili zilizochaguliwa za kumbukumbu kama viambatisho vya barua pepe kwa mpokeaji aliyeainishwa.',
        'bulk_email_files' => 'Faili Zilizochaguliwa',

        'filter' => [
            'date_from' => 'Kuanzia',
            'date_to' => 'Hadi',
        ],

        'column' => [
            'filename' => 'Jina la Faili',
            'size' => 'Ukubwa',
            'modified' => 'Ilibadilishwa Mwisho',
            'subfolder' => 'Folda Ndogo',
            'level' => 'Kiwango',
            'timestamp' => 'Muda',
            'message' => 'Ujumbe',
        ],

        'action' => [
            'refresh' => 'Onyesha upya',
            'view' => 'Tazama',
            'delete' => 'Futa',
            'download' => 'Pakua',
            'email' => 'Tuma kwa Barua Pepe',
            'email_send' => 'Tuma',
            'email_sent' => 'Faili ya kumbukumbu imetumwa kwa barua pepe',
            'bulk_email_sent' => 'Faili :count za kumbukumbu zimetumwa kwa barua pepe',
            'deleted' => 'Faili ya kumbukumbu imefutwa',
            'bulk_deleted' => 'Faili :count za kumbukumbu zimefutwa',
        ],

        'confirm' => [
            'delete' => 'Una uhakika unataka kufuta faili hii ya kumbukumbu? Kitendo hiki hakiwezi kutenduliwa.',
            'bulk_delete' => 'Una uhakika unataka kufuta faili zilizochaguliwa za kumbukumbu? Kitendo hiki hakiwezi kutenduliwa.',
        ],

        'entry' => [
            'detail' => 'Maelezo ya Ingizo',
            'line' => 'Mstari',
            'trace_frames' => 'fremu :count|fremu :count',
            'copy_trace' => 'Nakili Ufuatiliaji wa Steki',
            'copy_entry' => 'Nakili Ingizo Kamili',
            'copied' => 'Imenakiliwa!',
        ],
    ],

];
