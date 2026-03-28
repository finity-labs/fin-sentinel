<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Cilësimet',
        'error_channel' => 'Kanali i gabimeve',
        'error_channel_title' => 'Cilësimet e kanalit të gabimeve',
        'debug_channel' => 'Kanali Debug',
        'debug_channel_title' => 'Cilësimet e kanalit Debug',
        'system_logs' => 'Regjistrat e sistemit',
        'log_files' => 'Skedarët e regjistrit',
        'log_entries' => 'Hyrjet e regjistrit',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Emergjencë',
            'ALERT' => 'Alarm',
            'CRITICAL' => 'Kritik',
            'ERROR' => 'Gabim',
            'WARNING' => 'Paralajmërim',
            'NOTICE' => 'Njoftim',
            'INFO' => 'Informacion',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Njoftim gabimi',
            'debug' => 'Debug',
            'log_file' => 'Skedar regjistri',
        ],
        'footer' => 'Dërguar nga Fin-Sentinel',

        'label' => [
            'error_message' => 'Mesazhi i gabimit',
            'class' => 'Klasë',
            'file' => 'Skedar',
            'context' => 'Kontekst',
            'command' => 'Komandë',
            'url' => 'URL',
            'method' => 'Metodë',
            'ip' => 'IP',
            'params' => 'Parametra',
            'headers' => 'Koka',
            'name' => 'Emri',
            'email' => 'Email',
            'id' => 'ID',
            'user' => 'Përdoruesi',
            'environment' => 'Mjedisi',
            'debug_mode' => 'Modaliteti Debug',
            'php_version' => 'Versioni PHP',
            'laravel_version' => 'Versioni Laravel',
            'laravel' => 'Laravel',
            'peak_memory' => 'Memoria maksimale',
            'enabled' => 'Aktivizuar',
            'disabled' => 'Çaktivizuar',
            'relation' => 'Lidhja: :name',
            'bindings' => 'Lidhjet:',
            'trace_number' => '#',
            'trace_location' => 'Vendndodhja',
            'trace_call' => 'Thirrja',
        ],

        'collection' => [
            'count' => ':count element|:count elemente',
            'more' => '... dhe :count elemente të tjera',
        ],

        'error' => [
            'subject' => ':app - Ndodhi një gabim',
            'guest' => 'Vizitor',
            'console' => 'Konzolë',
            'section_exception' => 'Detajet e përjashtimit',
            'section_trace' => 'Gjurmimi i stivës',
            'section_request' => 'Konteksti i kërkesës',
            'section_user' => 'Përdoruesi i identifikuar',
            'section_environment' => 'Mjedisi',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Vizitor',
            'console' => 'Konzolë',
            'section_data' => 'Të dhënat Debug',
            'section_call_site' => 'Vendi i thirrjes',
            'section_request' => 'Konteksti i kërkesës',
            'section_environment' => 'Mjedisi',
        ],

        'log_file' => [
            'subject' => ':app - Skedar regjistri: :file',
            'bulk_subject' => ':app - :count skedarë regjistri të bashkangjitur',
            'body' => 'Skedari i regjistrit <strong>:file</strong> nga :app është i bashkangjitur.',
            'body_text' => 'Skedari i regjistrit :file nga :app është i bashkangjitur.',
        ],
    ],

    'settings' => [
        'recipients' => 'Marrësit',
        'throttling' => 'Kufizimi',
        'email_address' => 'Adresa email',
        'add_recipient' => 'Shto marrës',
        'no_recipients_warning' => 'Nuk ka marrës të konfiguruar — njoftimet nuk do të dërgohen derisa të shtohet të paktën një adresë email.',
        'throttle_rate' => 'Shkalla e kufizimit',
        'minutes_suffix' => 'minuta',

        'error' => [
            'enabled' => 'Aktivizo njoftimet e gabimeve',
            'enabled_helper' => 'Kur është çaktivizuar, nuk do të dërgohen email-e gabimesh.',
            'recipients_helper' => 'Shtoni adresat email që do të marrin njoftimet e gabimeve.',
            'throttle_helper' => 'Minutat minimale midis email-eve të dyfishta të gabimeve.',
            'throttle_exceptions' => 'Kufizimet e përjashtimeve',
            'throttle_exceptions_helper' => 'Kur është aktivizuar, përjashtimet e dyfishta në të njëjtin skedar:rresht nuk do të dërgojnë email brenda dritares së kufizimit.',
            'throttle_log_messages' => 'Kufizo mesazhet e regjistrit',
            'throttle_log_messages_helper' => 'Kur është aktivizuar, mesazhet identike të gabimeve në regjistër nuk do të dërgojnë email brenda dritares së kufizimit.',
            'ignored_exceptions' => 'Përjashtimet e shpërfillura',
            'ignored_exceptions_description' => 'Përjashtimet në këtë listë nuk do të aktivizojnë njoftime me email.',
            'ignored_exceptions_label' => 'Përjashtimet e shpërfillura',
            'other_custom' => 'Tjetër (i personalizuar)',
            'exception_class' => 'Klasa e përjashtimit (FQCN)',
            'class_not_exist' => 'Kjo klasë nuk ekziston.',
            'custom_exception' => 'Përjashtim i personalizuar',
            'select_exception' => 'Zgjidhni përjashtimin',
            'add_exception' => 'Shto përjashtim',
        ],

        'debug' => [
            'enabled' => 'Aktivizo kanalin Debug',
            'enabled_helper' => 'Kur është çaktivizuar, thirrjet Sentinel::debug() do të shpërfillen në heshtje.',
            'recipients_helper' => 'Shtoni adresat email që do të marrin njoftimet Debug.',
            'throttle_enabled' => 'Aktivizo kufizimin',
            'throttle_enabled_helper' => 'Kur është çaktivizuar, çdo thirrje debug dërgon një email. Kur është aktivizuar, thirrjet e dyfishta kufizohen.',
            'throttle_helper' => 'Minutat minimale midis email-eve të dyfishta Debug.',
        ],

        'test_email' => [
            'send' => 'Dërgo email provë',
            'sent' => 'Email-i provë u dërgua te :count marrës',
            'no_recipients' => 'Nuk ka marrës të konfiguruar. Shtoni fillimisht të paktën një adresë email.',
            'failed' => 'Dërgimi i email-it provë dështoi',
            'channel_disabled' => 'Ky kanal është aktualisht i çaktivizuar. Email-i provë do të dërgohet gjithsesi.',
        ],
    ],

    'logs' => [
        'title' => 'Regjistrat e sistemit',
        'heading' => 'Skedarët e regjistrit',
        'entries_title' => 'Hyrjet e regjistrit',
        'back_to_list' => 'Kthehu te skedarët e regjistrit',
        'no_entries' => 'Nuk u gjetën hyrje regjistri',
        'unsupported_format' => 'Ky skedar nuk duket se përdor formatin standard të regjistrit Laravel',
        'search_placeholder' => 'Kërko në hyrjet e regjistrit...',
        'level_filter' => 'Niveli i regjistrit',
        'email_recipient' => 'Email-i i marrësit',
        'email_description' => 'Dërgoni këtë skedar regjistri si bashkëngjitje email-i te marrësi i specifikuar.',
        'bulk_email_description' => 'Dërgoni skedarët e zgjedhur të regjistrit si bashkëngjitje individuale email-i te marrësi i specifikuar.',
        'bulk_email_files' => 'Skedarët e zgjedhur',

        'filter' => [
            'date_from' => 'Nga',
            'date_to' => 'Deri',
        ],

        'column' => [
            'filename' => 'Emri i skedarit',
            'size' => 'Madhësia',
            'modified' => 'Ndryshuar së fundi',
            'subfolder' => 'Nëndosje',
            'level' => 'Niveli',
            'timestamp' => 'Vula kohore',
            'message' => 'Mesazhi',
        ],

        'action' => [
            'refresh' => 'Rifresko',
            'view' => 'Shiko',
            'delete' => 'Fshi',
            'download' => 'Shkarko',
            'email' => 'Dërgo me email',
            'email_send' => 'Dërgo',
            'email_sent' => 'Skedari i regjistrit u dërgua me sukses me email',
            'bulk_email_sent' => ':count skedar(ë) regjistri u dërguan me sukses me email',
            'deleted' => 'Skedari i regjistrit u fshi',
            'bulk_deleted' => ':count skedar(ë) regjistri u fshinë',
        ],

        'confirm' => [
            'delete' => 'Jeni i sigurt që dëshironi të fshini këtë skedar regjistri? Ky veprim nuk mund të zhbëhet.',
            'bulk_delete' => 'Jeni i sigurt që dëshironi të fshini skedarët e zgjedhur të regjistrit? Ky veprim nuk mund të zhbëhet.',
        ],

        'entry' => [
            'detail' => 'Detajet e hyrjes',
            'line' => 'Rreshti',
            'trace_frames' => ':count kornizë|:count korniza',
            'copy_trace' => 'Kopjo gjurmimin e stivës',
            'copy_entry' => 'Kopjo hyrjen e plotë',
            'copied' => 'Kopjuar!',
        ],
    ],

];
