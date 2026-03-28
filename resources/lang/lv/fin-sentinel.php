<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Iestatījumi',
        'error_channel' => 'Kļūdu kanāls',
        'error_channel_title' => 'Kļūdu kanāla iestatījumi',
        'debug_channel' => 'Atkļūdošanas kanāls',
        'debug_channel_title' => 'Atkļūdošanas kanāla iestatījumi',
        'system_logs' => 'Sistēmas žurnāli',
        'log_files' => 'Žurnāla faili',
        'log_entries' => 'Žurnāla ieraksti',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Avārijas',
            'ALERT' => 'Trauksme',
            'CRITICAL' => 'Kritisks',
            'ERROR' => 'Kļūda',
            'WARNING' => 'Brīdinājums',
            'NOTICE' => 'Paziņojums',
            'INFO' => 'Informācija',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Kļūdas paziņojums',
            'debug' => 'Debug',
            'log_file' => 'Žurnāla fails',
        ],
        'footer' => 'Nosūtīts ar Fin-Sentinel',

        'label' => [
            'error_message' => 'Kļūdas ziņojums',
            'class' => 'Klase',
            'file' => 'Fails',
            'context' => 'Konteksts',
            'command' => 'Komanda',
            'url' => 'URL',
            'method' => 'Metode',
            'ip' => 'IP',
            'params' => 'Parametri',
            'headers' => 'Galvenes',
            'name' => 'Vārds',
            'email' => 'Email',
            'id' => 'ID',
            'user' => 'Lietotājs',
            'environment' => 'Vide',
            'debug_mode' => 'Debug režīms',
            'php_version' => 'PHP versija',
            'laravel_version' => 'Laravel versija',
            'laravel' => 'Laravel',
            'peak_memory' => 'Maksimālā atmiņa',
            'enabled' => 'Ieslēgts',
            'disabled' => 'Izslēgts',
            'relation' => 'Relācija: :name',
            'bindings' => 'Saistījumi:',
            'trace_number' => '#',
            'trace_location' => 'Atrašanās vieta',
            'trace_call' => 'Izsaukums',
        ],

        'collection' => [
            'count' => ':count elements|:count elementi',
            'more' => '... un vēl :count elementi',
        ],

        'error' => [
            'subject' => ':app — Radās kļūda',
            'guest' => 'Viesis',
            'console' => 'Konsole',
            'section_exception' => 'Izņēmuma detaļas',
            'section_trace' => 'Izsaukumu steks',
            'section_request' => 'Pieprasījuma konteksts',
            'section_user' => 'Autentificēts lietotājs',
            'section_environment' => 'Vide',
        ],

        'debug' => [
            'subject' => ':app — Debug: :subject',
            'guest' => 'Viesis',
            'console' => 'Konsole',
            'section_data' => 'Debug dati',
            'section_call_site' => 'Izsaukuma vieta',
            'section_request' => 'Pieprasījuma konteksts',
            'section_environment' => 'Vide',
        ],

        'log_file' => [
            'subject' => ':app — Žurnāla fails: :file',
            'bulk_subject' => ':app — :count žurnāla faili pievienoti',
            'body' => 'Žurnāla fails <strong>:file</strong> no :app ir pievienots.',
            'body_text' => 'Žurnāla fails :file no :app ir pievienots.',
        ],
    ],

    'settings' => [
        'recipients' => 'Saņēmēji',
        'throttling' => 'Biežuma ierobežošana',
        'email_address' => 'Email adrese',
        'add_recipient' => 'Pievienot saņēmēju',
        'no_recipients_warning' => 'Nav konfigurēti saņēmēji — paziņojumi netiks sūtīti, kamēr nebūs pievienota vismaz viena email adrese.',
        'throttle_rate' => 'Ierobežošanas biežums',
        'minutes_suffix' => 'minūtes',

        'error' => [
            'enabled' => 'Ieslēgt kļūdu paziņojumus',
            'enabled_helper' => 'Kad izslēgts, kļūdu email-i netiks sūtīti.',
            'recipients_helper' => 'Pievienojiet email adreses, kas saņems kļūdu paziņojumus.',
            'throttle_helper' => 'Minimālais intervāls minūtēs starp atkārtotiem kļūdu email-iem.',
            'throttle_exceptions' => 'Izņēmumu ierobežošana',
            'throttle_exceptions_helper' => 'Kad ieslēgts, atkārtoti izņēmumi tajā pašā failā:rindā neizraisīs email-u sūtīšanu ierobežošanas logā.',
            'throttle_log_messages' => 'Žurnāla ziņojumu ierobežošana',
            'throttle_log_messages_helper' => 'Kad ieslēgts, identiski kļūdu ziņojumi žurnālos neizraisīs email-u sūtīšanu ierobežošanas logā.',
            'ignored_exceptions' => 'Ignorēti izņēmumi',
            'ignored_exceptions_description' => 'Izņēmumi šajā sarakstā neizraisīs email paziņojumu sūtīšanu.',
            'ignored_exceptions_label' => 'Ignorēti izņēmumi',
            'other_custom' => 'Cits (pielāgots)',
            'exception_class' => 'Izņēmuma klase (FQCN)',
            'class_not_exist' => 'Šī klase neeksistē.',
            'custom_exception' => 'Pielāgots izņēmums',
            'select_exception' => 'Izvēlieties izņēmumu',
            'add_exception' => 'Pievienot izņēmumu',
        ],

        'debug' => [
            'enabled' => 'Ieslēgt atkļūdošanas kanālu',
            'enabled_helper' => 'Kad izslēgts, Sentinel::debug() izsaukumi tiks ignorēti.',
            'recipients_helper' => 'Pievienojiet email adreses, kas saņems atkļūdošanas paziņojumus.',
            'throttle_enabled' => 'Ieslēgt biežuma ierobežošanu',
            'throttle_enabled_helper' => 'Kad izslēgts, katrs debug izsaukums sūta email. Kad ieslēgts, atkārtoti izsaukumi tiek ierobežoti.',
            'throttle_helper' => 'Minimālais intervāls minūtēs starp atkārtotiem debug email-iem.',
        ],

        'test_email' => [
            'send' => 'Nosūtīt testa email',
            'sent' => 'Testa email nosūtīts :count saņēmējam(-iem)',
            'no_recipients' => 'Nav konfigurēti saņēmēji. Vispirms pievienojiet vismaz vienu email adresi.',
            'failed' => 'Neizdevās nosūtīt testa email',
            'channel_disabled' => 'Šis kanāls pašlaik ir izslēgts. Testa email tik un tā tiks nosūtīts.',
        ],
    ],

    'logs' => [
        'title' => 'Sistēmas žurnāli',
        'heading' => 'Žurnāla faili',
        'entries_title' => 'Žurnāla ieraksti',
        'back_to_list' => 'Atpakaļ pie žurnāla failiem',
        'no_entries' => 'Žurnāla ieraksti nav atrasti',
        'unsupported_format' => 'Šis fails neizmanto standarta Laravel žurnāla formātu',
        'search_placeholder' => 'Meklēt žurnāla ierakstos...',
        'level_filter' => 'Žurnāla līmenis',
        'email_recipient' => 'Saņēmēja email',
        'email_description' => 'Nosūtīt šo žurnāla failu kā pielikumu uz norādīto adresi.',
        'bulk_email_description' => 'Nosūtīt izvēlētos žurnāla failus kā atsevišķus pielikumus uz norādīto adresi.',
        'bulk_email_files' => 'Izvēlētie faili',

        'filter' => [
            'date_from' => 'No',
            'date_to' => 'Līdz',
        ],

        'column' => [
            'filename' => 'Faila nosaukums',
            'size' => 'Izmērs',
            'modified' => 'Pēdējā izmaiņa',
            'subfolder' => 'Apakšmape',
            'level' => 'Līmenis',
            'timestamp' => 'Laiks',
            'message' => 'Ziņojums',
        ],

        'action' => [
            'refresh' => 'Atsvaidzināt',
            'view' => 'Skatīt',
            'delete' => 'Dzēst',
            'download' => 'Lejupielādēt',
            'email' => 'Sūtīt uz',
            'email_send' => 'Sūtīt',
            'email_sent' => 'Žurnāla fails veiksmīgi nosūtīts',
            'bulk_email_sent' => ':count žurnāla fails(-i) veiksmīgi nosūtīts(-i)',
            'deleted' => 'Žurnāla fails dzēsts',
            'bulk_deleted' => ':count žurnāla fails(-i) dzēsts(-i)',
        ],

        'confirm' => [
            'delete' => 'Vai tiešām vēlaties dzēst šo žurnāla failu? Šo darbību nevar atsaukt.',
            'bulk_delete' => 'Vai tiešām vēlaties dzēst izvēlētos žurnāla failus? Šo darbību nevar atsaukt.',
        ],

        'entry' => [
            'detail' => 'Ieraksta detaļas',
            'line' => 'Rinda',
            'trace_frames' => ':count ietvars|:count ietvari',
            'copy_trace' => 'Kopēt izsaukumu steku',
            'copy_entry' => 'Kopēt visu ierakstu',
            'copied' => 'Nokopēts!',
        ],
    ],

];
