<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Podešavanja',
        'error_channel' => 'Kanal grešaka',
        'error_channel_title' => 'Podešavanja kanala grešaka',
        'debug_channel' => 'Kanal za otklanjanje grešaka',
        'debug_channel_title' => 'Podešavanja kanala za otklanjanje grešaka',
        'system_logs' => 'Sistemski logovi',
        'log_files' => 'Log fajlovi',
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
            'NOTICE' => 'Obaveštenje',
            'INFO' => 'Informacija',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Obaveštenje o grešci',
            'debug' => 'Debug',
            'log_file' => 'Log fajl',
        ],
        'footer' => 'Poslato od strane Fin-Sentinel',

        'label' => [
            'error_message' => 'Poruka o grešci',
            'class' => 'Klasa',
            'file' => 'Fajl',
            'context' => 'Kontekst',
            'command' => 'Komanda',
            'url' => 'URL',
            'method' => 'Metod',
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
            'section_request' => 'Kontekst zahteva',
            'section_user' => 'Autentifikovani korisnik',
            'section_environment' => 'Okruženje',
        ],

        'debug' => [
            'subject' => ':app — Debug: :subject',
            'guest' => 'Gost',
            'console' => 'Konzola',
            'section_data' => 'Debug podaci',
            'section_call_site' => 'Mesto poziva',
            'section_request' => 'Kontekst zahteva',
            'section_environment' => 'Okruženje',
        ],

        'log_file' => [
            'subject' => ':app — Log fajl: :file',
            'bulk_subject' => ':app — :count log fajlova u prilogu',
            'body' => 'Log fajl <strong>:file</strong> iz :app je u prilogu.',
            'body_text' => 'Log fajl :file iz :app je u prilogu.',
        ],
    ],

    'settings' => [
        'recipients' => 'Primaoci',
        'throttling' => 'Ograničavanje učestalosti',
        'email_address' => 'Email adresa',
        'add_recipient' => 'Dodaj primaoca',
        'no_recipients_warning' => 'Primaoci nisu podešeni — obaveštenja neće biti slata dok se ne doda bar jedna email adresa.',
        'throttle_rate' => 'Stopa ograničavanja',
        'minutes_suffix' => 'minuta',

        'error' => [
            'enabled' => 'Uključi obaveštenja o greškama',
            'enabled_helper' => 'Ako je isključeno, email-ovi o greškama neće biti slati.',
            'recipients_helper' => 'Dodajte email adrese koje će primati obaveštenja o greškama.',
            'throttle_helper' => 'Minimalni interval u minutima između ponovljenih email-ova o istim greškama.',
            'throttle_exceptions' => 'Ograničavanje izuzetaka',
            'throttle_exceptions_helper' => 'Ako je uključeno, ponovljeni izuzeci na istom fajl:linija neće pokretati slanje email-ova u okviru prozora ograničavanja.',
            'throttle_log_messages' => 'Ograničavanje poruka logova',
            'throttle_log_messages_helper' => 'Ako je uključeno, identične poruke o greškama u logovima neće pokretati slanje email-ova u okviru prozora ograničavanja.',
            'ignored_exceptions' => 'Ignorisani izuzeci',
            'ignored_exceptions_description' => 'Izuzeci sa ove liste neće pokretati slanje email obaveštenja.',
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
            'recipients_helper' => 'Dodajte email adrese koje će primati obaveštenja o otklanjanju grešaka.',
            'throttle_enabled' => 'Uključi ograničavanje učestalosti',
            'throttle_enabled_helper' => 'Ako je isključeno, svaki debug poziv šalje email. Ako je uključeno, ponovljeni pozivi se ograničavaju.',
            'throttle_helper' => 'Minimalni interval u minutima između ponovljenih debug email-ova.',
        ],

        'test_email' => [
            'send' => 'Pošalji test email',
            'sent' => 'Test email poslat na :count primaoca',
            'no_recipients' => 'Primaoci nisu podešeni. Prvo dodajte bar jednu email adresu.',
            'failed' => 'Slanje test email-a nije uspelo',
            'channel_disabled' => 'Ovaj kanal je trenutno isključen. Test email će ipak biti poslat.',
        ],
    ],

    'logs' => [
        'title' => 'Sistemski logovi',
        'heading' => 'Log fajlovi',
        'entries_title' => 'Zapisi u logu',
        'back_to_list' => 'Nazad na log fajlove',
        'no_entries' => 'Zapisi u logu nisu pronađeni',
        'unsupported_format' => 'Ovaj fajl ne koristi standardni Laravel format logova',
        'search_placeholder' => 'Pretraga zapisa u logu...',
        'level_filter' => 'Nivo loga',
        'email_recipient' => 'Email primaoca',
        'email_description' => 'Pošaljite ovaj log fajl kao prilog na navedenu email adresu.',
        'bulk_email_description' => 'Pošaljite izabrane log fajlove kao pojedinačne priloge na navedenu email adresu.',
        'bulk_email_files' => 'Izabrani fajlovi',

        'filter' => [
            'date_from' => 'Od',
            'date_to' => 'Do',
        ],

        'column' => [
            'filename' => 'Naziv fajla',
            'size' => 'Veličina',
            'modified' => 'Poslednja izmena',
            'subfolder' => 'Podfolder',
            'level' => 'Nivo',
            'timestamp' => 'Vreme',
            'message' => 'Poruka',
        ],

        'action' => [
            'refresh' => 'Osveži',
            'view' => 'Pregledaj',
            'delete' => 'Obriši',
            'download' => 'Preuzmi',
            'email' => 'Pošalji na',
            'email_send' => 'Pošalji',
            'email_sent' => 'Log fajl uspešno poslat',
            'bulk_email_sent' => ':count log fajl(ova) uspešno poslato',
            'deleted' => 'Log fajl obrisan',
            'bulk_deleted' => ':count log fajl(ova) obrisano',
        ],

        'confirm' => [
            'delete' => 'Da li ste sigurni da želite da obrišete ovaj log fajl? Ova radnja se ne može poništiti.',
            'bulk_delete' => 'Da li ste sigurni da želite da obrišete izabrane log fajlove? Ova radnja se ne može poništiti.',
        ],

        'entry' => [
            'detail' => 'Detalji zapisa',
            'line' => 'Linija',
            'trace_frames' => ':count frejm|:count frejmova',
            'copy_trace' => 'Kopiraj stek poziva',
            'copy_entry' => 'Kopiraj ceo zapis',
            'copied' => 'Kopirano!',
        ],
    ],

];
