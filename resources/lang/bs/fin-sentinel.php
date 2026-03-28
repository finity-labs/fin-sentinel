<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Postavke',
        'error_channel' => 'Kanal grešaka',
        'error_channel_title' => 'Postavke kanala grešaka',
        'debug_channel' => 'Kanal za otklanjanje grešaka',
        'debug_channel_title' => 'Postavke kanala za otklanjanje grešaka',
        'system_logs' => 'Sistemski logovi',
        'log_files' => 'Log datoteke',
        'log_entries' => 'Zapisi u logu',
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
            'NOTICE' => 'Obavještenje',
            'INFO' => 'Informacija',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Obavještenje o grešci',
            'debug' => 'Debug',
            'log_file' => 'Log datoteka',
        ],
        'footer' => 'Poslano od Fin-Sentinel',

        'label' => [
            'error_message' => 'Poruka o grešci',
            'class' => 'Klasa',
            'file' => 'Datoteka',
            'context' => 'Kontekst',
            'command' => 'Komanda',
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
            'debug_mode' => 'Debug režim',
            'php_version' => 'PHP verzija',
            'laravel_version' => 'Laravel verzija',
            'laravel' => 'Laravel',
            'peak_memory' => 'Maksimalna memorija',
            'enabled' => 'Uključeno',
            'disabled' => 'Isključeno',
            'relation' => 'Relacija: :name',
            'bindings' => 'Vezivanja:',
            'trace_number' => '#',
            'trace_location' => 'Lokacija',
            'trace_call' => 'Poziv',
        ],

        'collection' => [
            'count' => ':count stavka|:count stavki',
            'more' => '... i još :count stavki',
        ],

        'error' => [
            'subject' => ':app — Došlo je do greške',
            'guest' => 'Gost',
            'console' => 'Konzola',
            'section_exception' => 'Detalji izuzetka',
            'section_trace' => 'Stek poziva',
            'section_request' => 'Kontekst zahtjeva',
            'section_user' => 'Autentificirani korisnik',
            'section_environment' => 'Okruženje',
        ],

        'debug' => [
            'subject' => ':app — Debug: :subject',
            'guest' => 'Gost',
            'console' => 'Konzola',
            'section_data' => 'Debug podaci',
            'section_call_site' => 'Mjesto poziva',
            'section_request' => 'Kontekst zahtjeva',
            'section_environment' => 'Okruženje',
        ],

        'log_file' => [
            'subject' => ':app — Log datoteka: :file',
            'bulk_subject' => ':app — :count log datoteka u prilogu',
            'body' => 'Log datoteka <strong>:file</strong> iz :app je u prilogu.',
            'body_text' => 'Log datoteka :file iz :app je u prilogu.',
        ],
    ],

    'settings' => [
        'recipients' => 'Primaoci',
        'throttling' => 'Ograničavanje učestalosti',
        'email_address' => 'Email adresa',
        'add_recipient' => 'Dodaj primaoca',
        'no_recipients_warning' => 'Primaoci nisu podešeni — obavještenja neće biti slana dok se ne doda barem jedna email adresa.',
        'throttle_rate' => 'Stopa ograničavanja',
        'minutes_suffix' => 'minuta',

        'error' => [
            'enabled' => 'Uključi obavještenja o greškama',
            'enabled_helper' => 'Ako je isključeno, email-ovi o greškama neće biti slani.',
            'recipients_helper' => 'Dodajte email adrese koje će primati obavještenja o greškama.',
            'throttle_helper' => 'Minimalni interval u minutama između ponovljenih email-ova o istim greškama.',
            'throttle_exceptions' => 'Ograničavanje izuzetaka',
            'throttle_exceptions_helper' => 'Ako je uključeno, ponovljeni izuzeci na istom datoteka:linija neće pokretati slanje email-ova u okviru prozora ograničavanja.',
            'throttle_log_messages' => 'Ograničavanje poruka logova',
            'throttle_log_messages_helper' => 'Ako je uključeno, identične poruke o greškama u logovima neće pokretati slanje email-ova u okviru prozora ograničavanja.',
            'ignored_exceptions' => 'Ignorisani izuzeci',
            'ignored_exceptions_description' => 'Izuzeci sa ove liste neće pokretati slanje email obavještenja.',
            'ignored_exceptions_label' => 'Ignorisani izuzeci',
            'other_custom' => 'Drugo (proizvoljno)',
            'exception_class' => 'Klasa izuzetka (FQCN)',
            'class_not_exist' => 'Ova klasa ne postoji.',
            'custom_exception' => 'Proizvoljni izuzetak',
            'select_exception' => 'Izaberite izuzetak',
            'add_exception' => 'Dodaj izuzetak',
        ],

        'debug' => [
            'enabled' => 'Uključi kanal za otklanjanje grešaka',
            'enabled_helper' => 'Ako je isključeno, pozivi Sentinel::debug() će biti ignorisani.',
            'recipients_helper' => 'Dodajte email adrese koje će primati obavještenja o otklanjanju grešaka.',
            'throttle_enabled' => 'Uključi ograničavanje učestalosti',
            'throttle_enabled_helper' => 'Ako je isključeno, svaki debug poziv šalje email. Ako je uključeno, ponovljeni pozivi se ograničavaju.',
            'throttle_helper' => 'Minimalni interval u minutama između ponovljenih debug email-ova.',
        ],

        'test_email' => [
            'send' => 'Pošalji test email',
            'sent' => 'Test email poslan na :count primaoca',
            'no_recipients' => 'Primaoci nisu podešeni. Prvo dodajte barem jednu email adresu.',
            'failed' => 'Slanje test email-a nije uspjelo',
            'channel_disabled' => 'Ovaj kanal je trenutno isključen. Test email će ipak biti poslan.',
        ],
    ],

    'logs' => [
        'title' => 'Sistemski logovi',
        'heading' => 'Log datoteke',
        'entries_title' => 'Zapisi u logu',
        'back_to_list' => 'Nazad na log datoteke',
        'no_entries' => 'Zapisi u logu nisu pronađeni',
        'unsupported_format' => 'Ova datoteka ne koristi standardni Laravel format logova',
        'search_placeholder' => 'Pretraga zapisa u logu...',
        'level_filter' => 'Nivo loga',
        'email_recipient' => 'Email primaoca',
        'email_description' => 'Pošaljite ovu log datoteku kao prilog na navedenu email adresu.',
        'bulk_email_description' => 'Pošaljite izabrane log datoteke kao pojedinačne priloge na navedenu email adresu.',
        'bulk_email_files' => 'Izabrane datoteke',

        'filter' => [
            'date_from' => 'Od',
            'date_to' => 'Do',
        ],

        'column' => [
            'filename' => 'Naziv datoteke',
            'size' => 'Veličina',
            'modified' => 'Posljednja izmjena',
            'subfolder' => 'Podfolder',
            'level' => 'Nivo',
            'timestamp' => 'Vrijeme',
            'message' => 'Poruka',
        ],

        'action' => [
            'refresh' => 'Osvježi',
            'view' => 'Pregledaj',
            'delete' => 'Obriši',
            'download' => 'Preuzmi',
            'email' => 'Pošalji na',
            'email_send' => 'Pošalji',
            'email_sent' => 'Log datoteka uspješno poslana',
            'bulk_email_sent' => ':count log datoteka(e) uspješno poslano',
            'deleted' => 'Log datoteka obrisana',
            'bulk_deleted' => ':count log datoteka(e) obrisano',
        ],

        'confirm' => [
            'delete' => 'Jeste li sigurni da želite obrisati ovu log datoteku? Ova radnja se ne može poništiti.',
            'bulk_delete' => 'Jeste li sigurni da želite obrisati izabrane log datoteke? Ova radnja se ne može poništiti.',
        ],

        'entry' => [
            'detail' => 'Detalji zapisa',
            'line' => 'Linija',
            'trace_frames' => ':count okvir|:count okvira',
            'copy_trace' => 'Kopiraj stek poziva',
            'copy_entry' => 'Kopiraj cijeli zapis',
            'copied' => 'Kopirano!',
        ],
    ],

];
