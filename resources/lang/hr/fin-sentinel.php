<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Postavke',
        'error_channel' => 'Kanal grešaka',
        'error_channel_title' => 'Postavke kanala grešaka',
        'debug_channel' => 'Debug kanal',
        'debug_channel_title' => 'Postavke Debug kanala',
        'system_logs' => 'Sistemski dnevnici',
        'log_files' => 'Datoteke dnevnika',
        'log_entries' => 'Unosi dnevnika',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Hitno',
            'ALERT' => 'Uzbuna',
            'CRITICAL' => 'Kritično',
            'ERROR' => 'Greška',
            'WARNING' => 'Upozorenje',
            'NOTICE' => 'Obavijest',
            'INFO' => 'Informacija',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Obavijest o grešci',
            'debug' => 'Debug',
            'log_file' => 'Datoteka dnevnika',
        ],
        'footer' => 'Poslano putem Fin-Sentinel',

        'label' => [
            'error_message' => 'Poruka greške',
            'class' => 'Klasa',
            'file' => 'Datoteka',
            'context' => 'Kontekst',
            'command' => 'Naredba',
            'url' => 'URL',
            'method' => 'Metoda',
            'ip' => 'IP',
            'params' => 'Parametri',
            'headers' => 'Zaglavlja',
            'name' => 'Ime',
            'email' => 'Email',
            'id' => 'ID',
            'user' => 'Korisnik',
            'environment' => 'Okruženje',
            'debug_mode' => 'Debug način',
            'php_version' => 'PHP verzija',
            'laravel_version' => 'Laravel verzija',
            'laravel' => 'Laravel',
            'peak_memory' => 'Vršna memorija',
            'enabled' => 'Uključeno',
            'disabled' => 'Isključeno',
            'relation' => 'Relacija: :name',
            'bindings' => 'Vezanja:',
            'trace_number' => '#',
            'trace_location' => 'Lokacija',
            'trace_call' => 'Poziv',
        ],

        'collection' => [
            'count' => ':count stavka|:count stavki',
            'more' => '... i još :count stavki',
        ],

        'error' => [
            'subject' => ':app - Došlo je do greške',
            'guest' => 'Gost',
            'console' => 'Konzola',
            'section_exception' => 'Detalji iznimke',
            'section_trace' => 'Praćenje stoga',
            'section_request' => 'Kontekst zahtjeva',
            'section_user' => 'Prijavljeni korisnik',
            'section_environment' => 'Okruženje',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Gost',
            'console' => 'Konzola',
            'section_data' => 'Debug podaci',
            'section_call_site' => 'Mjesto poziva',
            'section_request' => 'Kontekst zahtjeva',
            'section_environment' => 'Okruženje',
        ],

        'log_file' => [
            'subject' => ':app - Datoteka dnevnika: :file',
            'bulk_subject' => ':app - :count datoteka dnevnika u privitku',
            'body' => 'Datoteka dnevnika <strong>:file</strong> iz :app je u privitku.',
            'body_text' => 'Datoteka dnevnika :file iz :app je u privitku.',
        ],
    ],

    'settings' => [
        'recipients' => 'Primatelji',
        'throttling' => 'Ograničavanje',
        'email_address' => 'Email adresa',
        'add_recipient' => 'Dodaj primatelja',
        'no_recipients_warning' => 'Nema konfiguriranih primatelja — obavijesti neće biti slane dok ne bude dodana barem jedna email adresa.',
        'throttle_rate' => 'Učestalost ograničavanja',
        'minutes_suffix' => 'minuta',

        'error' => [
            'enabled' => 'Uključi obavijesti o greškama',
            'enabled_helper' => 'Kad je isključeno, neće se slati email obavijesti o greškama.',
            'recipients_helper' => 'Dodajte email adrese koje će primati obavijesti o greškama.',
            'throttle_helper' => 'Minimalni broj minuta između dupliciranih email poruka o greškama.',
            'throttle_exceptions' => 'Ograniči iznimke',
            'throttle_exceptions_helper' => 'Kad je uključeno, duplicirane iznimke na istoj datoteci:retku neće slati email unutar prozora ograničavanja.',
            'throttle_log_messages' => 'Ograniči poruke dnevnika',
            'throttle_log_messages_helper' => 'Kad je uključeno, identične poruke grešaka u dnevniku neće slati email unutar prozora ograničavanja.',
            'ignored_exceptions' => 'Zanemarene iznimke',
            'ignored_exceptions_description' => 'Iznimke na ovom popisu neće pokretati email obavijesti.',
            'ignored_exceptions_label' => 'Zanemarene iznimke',
            'other_custom' => 'Drugo (prilagođeno)',
            'exception_class' => 'Klasa iznimke (FQCN)',
            'class_not_exist' => 'Ova klasa ne postoji.',
            'custom_exception' => 'Prilagođena iznimka',
            'select_exception' => 'Odaberite iznimku',
            'add_exception' => 'Dodaj iznimku',
        ],

        'debug' => [
            'enabled' => 'Uključi Debug kanal',
            'enabled_helper' => 'Kad je isključeno, pozivi Sentinel::debug() će biti tiho zanemareni.',
            'recipients_helper' => 'Dodajte email adrese koje će primati Debug obavijesti.',
            'throttle_enabled' => 'Uključi ograničavanje',
            'throttle_enabled_helper' => 'Kad je isključeno, svaki debug poziv šalje email. Kad je uključeno, duplicirani pozivi su ograničeni.',
            'throttle_helper' => 'Minimalni broj minuta između dupliciranih Debug email poruka.',
        ],

        'test_email' => [
            'send' => 'Pošalji testni email',
            'sent' => 'Testni email poslan na :count primatelja',
            'no_recipients' => 'Nema konfiguriranih primatelja. Prvo dodajte barem jednu email adresu.',
            'failed' => 'Slanje testnog emaila nije uspjelo',
            'channel_disabled' => 'Ovaj kanal je trenutno isključen. Testni email će ipak biti poslan.',
        ],
    ],

    'logs' => [
        'title' => 'Sistemski dnevnici',
        'heading' => 'Datoteke dnevnika',
        'entries_title' => 'Unosi dnevnika',
        'back_to_list' => 'Natrag na datoteke dnevnika',
        'no_entries' => 'Nisu pronađeni unosi dnevnika',
        'unsupported_format' => 'Ova datoteka ne koristi standardni Laravel format dnevnika',
        'search_placeholder' => 'Pretraži unose dnevnika...',
        'level_filter' => 'Razina dnevnika',
        'email_recipient' => 'Email primatelja',
        'email_description' => 'Pošaljite ovu datoteku dnevnika kao privitak emaila navedenom primatelju.',
        'bulk_email_description' => 'Pošaljite odabrane datoteke dnevnika kao pojedinačne privitke emaila navedenom primatelju.',
        'bulk_email_files' => 'Odabrane datoteke',

        'filter' => [
            'date_from' => 'Od',
            'date_to' => 'Do',
        ],

        'column' => [
            'filename' => 'Naziv datoteke',
            'size' => 'Veličina',
            'modified' => 'Zadnja izmjena',
            'subfolder' => 'Podmapa',
            'level' => 'Razina',
            'timestamp' => 'Vremenski žig',
            'message' => 'Poruka',
        ],

        'action' => [
            'refresh' => 'Osvježi',
            'view' => 'Pregledaj',
            'delete' => 'Obriši',
            'download' => 'Preuzmi',
            'email' => 'Pošalji emailom',
            'email_send' => 'Pošalji',
            'email_sent' => 'Datoteka dnevnika uspješno poslana emailom',
            'bulk_email_sent' => ':count datoteka dnevnika uspješno poslano emailom',
            'deleted' => 'Datoteka dnevnika obrisana',
            'bulk_deleted' => ':count datoteka dnevnika obrisano',
        ],

        'confirm' => [
            'delete' => 'Jeste li sigurni da želite obrisati ovu datoteku dnevnika? Ova radnja se ne može poništiti.',
            'bulk_delete' => 'Jeste li sigurni da želite obrisati odabrane datoteke dnevnika? Ova radnja se ne može poništiti.',
        ],

        'entry' => [
            'detail' => 'Detalji unosa',
            'line' => 'Redak',
            'trace_frames' => ':count okvir|:count okvira',
            'copy_trace' => 'Kopiraj praćenje stoga',
            'copy_entry' => 'Kopiraj cijeli unos',
            'copied' => 'Kopirano!',
        ],
    ],

];
