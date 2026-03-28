<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Nastavitve',
        'error_channel' => 'Kanal napak',
        'error_channel_title' => 'Nastavitve kanala napak',
        'debug_channel' => 'Debug kanal',
        'debug_channel_title' => 'Nastavitve Debug kanala',
        'system_logs' => 'Sistemski dnevniki',
        'log_files' => 'Dnevniške datoteke',
        'log_entries' => 'Dnevniški zapisi',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Nujno',
            'ALERT' => 'Alarm',
            'CRITICAL' => 'Kritično',
            'ERROR' => 'Napaka',
            'WARNING' => 'Opozorilo',
            'NOTICE' => 'Obvestilo',
            'INFO' => 'Informacija',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Obvestilo o napaki',
            'debug' => 'Debug',
            'log_file' => 'Dnevniška datoteka',
        ],
        'footer' => 'Poslano prek Fin-Sentinel',

        'label' => [
            'error_message' => 'Sporočilo o napaki',
            'class' => 'Razred',
            'file' => 'Datoteka',
            'context' => 'Kontekst',
            'command' => 'Ukaz',
            'url' => 'URL',
            'method' => 'Metoda',
            'ip' => 'IP',
            'params' => 'Parametri',
            'headers' => 'Glave',
            'name' => 'Ime',
            'email' => 'E-pošta',
            'id' => 'ID',
            'user' => 'Uporabnik',
            'environment' => 'Okolje',
            'debug_mode' => 'Debug način',
            'php_version' => 'PHP različica',
            'laravel_version' => 'Laravel različica',
            'laravel' => 'Laravel',
            'peak_memory' => 'Najvišja poraba pomnilnika',
            'enabled' => 'Vključeno',
            'disabled' => 'Izključeno',
            'relation' => 'Relacija: :name',
            'bindings' => 'Vezave:',
            'trace_number' => '#',
            'trace_location' => 'Lokacija',
            'trace_call' => 'Klic',
        ],

        'collection' => [
            'count' => ':count element|:count elementov',
            'more' => '... in še :count elementov',
        ],

        'error' => [
            'subject' => ':app - Prišlo je do napake',
            'guest' => 'Gost',
            'console' => 'Konzola',
            'section_exception' => 'Podrobnosti izjeme',
            'section_trace' => 'Sled sklada',
            'section_request' => 'Kontekst zahteve',
            'section_user' => 'Prijavljen uporabnik',
            'section_environment' => 'Okolje',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Gost',
            'console' => 'Konzola',
            'section_data' => 'Debug podatki',
            'section_call_site' => 'Mesto klica',
            'section_request' => 'Kontekst zahteve',
            'section_environment' => 'Okolje',
        ],

        'log_file' => [
            'subject' => ':app - Dnevniška datoteka: :file',
            'bulk_subject' => ':app - :count dnevniških datotek v priponki',
            'body' => 'Dnevniška datoteka <strong>:file</strong> iz :app je v priponki.',
            'body_text' => 'Dnevniška datoteka :file iz :app je v priponki.',
        ],
    ],

    'settings' => [
        'recipients' => 'Prejemniki',
        'throttling' => 'Omejevanje',
        'email_address' => 'E-poštni naslov',
        'add_recipient' => 'Dodaj prejemnika',
        'no_recipients_warning' => 'Ni nastavljenih prejemnikov — obvestila ne bodo poslana, dokler ni dodan vsaj en e-poštni naslov.',
        'throttle_rate' => 'Pogostost omejevanja',
        'minutes_suffix' => 'minut',

        'error' => [
            'enabled' => 'Vključi obvestila o napakah',
            'enabled_helper' => 'Ko je izključeno, e-poštna sporočila o napakah ne bodo poslana.',
            'recipients_helper' => 'Dodajte e-poštne naslove, ki bodo prejemali obvestila o napakah.',
            'throttle_helper' => 'Najmanjše število minut med podvojenimi e-poštnimi sporočili o napakah.',
            'throttle_exceptions' => 'Omeji izjeme',
            'throttle_exceptions_helper' => 'Ko je vključeno, podvojene izjeme na isti datoteki:vrstici ne bodo pošiljale e-pošte znotraj okna omejevanja.',
            'throttle_log_messages' => 'Omeji dnevniška sporočila',
            'throttle_log_messages_helper' => 'Ko je vključeno, identična dnevniška sporočila o napakah ne bodo pošiljala e-pošte znotraj okna omejevanja.',
            'ignored_exceptions' => 'Prezrte izjeme',
            'ignored_exceptions_description' => 'Izjeme na tem seznamu ne bodo sprožile e-poštnih obvestil.',
            'ignored_exceptions_label' => 'Prezrte izjeme',
            'other_custom' => 'Drugo (po meri)',
            'exception_class' => 'Razred izjeme (FQCN)',
            'class_not_exist' => 'Ta razred ne obstaja.',
            'custom_exception' => 'Izjema po meri',
            'select_exception' => 'Izberite izjemo',
            'add_exception' => 'Dodaj izjemo',
        ],

        'debug' => [
            'enabled' => 'Vključi Debug kanal',
            'enabled_helper' => 'Ko je izključeno, bodo klici Sentinel::debug() tiho prezrti.',
            'recipients_helper' => 'Dodajte e-poštne naslove, ki bodo prejemali Debug obvestila.',
            'throttle_enabled' => 'Vključi omejevanje',
            'throttle_enabled_helper' => 'Ko je izključeno, vsak debug klic pošlje e-pošto. Ko je vključeno, so podvojeni klici omejeni.',
            'throttle_helper' => 'Najmanjše število minut med podvojenimi Debug e-poštnimi sporočili.',
        ],

        'test_email' => [
            'send' => 'Pošlji testno e-pošto',
            'sent' => 'Testna e-pošta poslana :count prejemniku(-om)',
            'no_recipients' => 'Ni nastavljenih prejemnikov. Najprej dodajte vsaj en e-poštni naslov.',
            'failed' => 'Pošiljanje testne e-pošte ni uspelo',
            'channel_disabled' => 'Ta kanal je trenutno izključen. Testna e-pošta bo kljub temu poslana.',
        ],
    ],

    'logs' => [
        'title' => 'Sistemski dnevniki',
        'heading' => 'Dnevniške datoteke',
        'entries_title' => 'Dnevniški zapisi',
        'back_to_list' => 'Nazaj na dnevniške datoteke',
        'no_entries' => 'Dnevniških zapisov ni mogoče najti',
        'unsupported_format' => 'Ta datoteka ne uporablja standardne oblike dnevnika Laravel',
        'search_placeholder' => 'Iskanje po dnevniških zapisih...',
        'level_filter' => 'Raven dnevnika',
        'email_recipient' => 'E-pošta prejemnika',
        'email_description' => 'Pošljite to dnevniško datoteko kot priponko e-pošte navedenemu prejemniku.',
        'bulk_email_description' => 'Pošljite izbrane dnevniške datoteke kot posamezne priponke e-pošte navedenemu prejemniku.',
        'bulk_email_files' => 'Izbrane datoteke',

        'filter' => [
            'date_from' => 'Od',
            'date_to' => 'Do',
        ],

        'column' => [
            'filename' => 'Ime datoteke',
            'size' => 'Velikost',
            'modified' => 'Zadnja sprememba',
            'subfolder' => 'Podmapa',
            'level' => 'Raven',
            'timestamp' => 'Časovni žig',
            'message' => 'Sporočilo',
        ],

        'action' => [
            'refresh' => 'Osveži',
            'view' => 'Ogled',
            'delete' => 'Izbriši',
            'download' => 'Prenesi',
            'email' => 'Pošlji po e-pošti',
            'email_send' => 'Pošlji',
            'email_sent' => 'Dnevniška datoteka uspešno poslana po e-pošti',
            'bulk_email_sent' => ':count dnevniških datotek uspešno poslanih po e-pošti',
            'deleted' => 'Dnevniška datoteka izbrisana',
            'bulk_deleted' => ':count dnevniških datotek izbrisanih',
        ],

        'confirm' => [
            'delete' => 'Ali ste prepričani, da želite izbrisati to dnevniško datoteko? Tega dejanja ni mogoče razveljaviti.',
            'bulk_delete' => 'Ali ste prepričani, da želite izbrisati izbrane dnevniške datoteke? Tega dejanja ni mogoče razveljaviti.',
        ],

        'entry' => [
            'detail' => 'Podrobnosti zapisa',
            'line' => 'Vrstica',
            'trace_frames' => ':count okvir|:count okvirov',
            'copy_trace' => 'Kopiraj sled sklada',
            'copy_entry' => 'Kopiraj celoten zapis',
            'copied' => 'Kopirano!',
        ],
    ],

];
