<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Indstillinger',
        'error_channel' => 'Fejlkanal',
        'error_channel_title' => 'Indstillinger for fejlkanal',
        'debug_channel' => 'Debug-kanal',
        'debug_channel_title' => 'Indstillinger for Debug-kanal',
        'system_logs' => 'Systemlogfiler',
        'log_files' => 'Logfiler',
        'log_entries' => 'Logposter',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Nødsituation',
            'ALERT' => 'Alarm',
            'CRITICAL' => 'Kritisk',
            'ERROR' => 'Fejl',
            'WARNING' => 'Advarsel',
            'NOTICE' => 'Bemærkning',
            'INFO' => 'Info',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Fejlnotifikation',
            'debug' => 'Debug',
            'log_file' => 'Logfil',
        ],
        'footer' => 'Sendt af Fin-Sentinel',

        'label' => [
            'error_message' => 'Fejlmeddelelse',
            'class' => 'Klasse',
            'file' => 'Fil',
            'context' => 'Kontekst',
            'command' => 'Kommando',
            'url' => 'URL',
            'method' => 'Metode',
            'ip' => 'IP',
            'params' => 'Parametre',
            'headers' => 'Headers',
            'name' => 'Navn',
            'email' => 'E-mail',
            'id' => 'ID',
            'user' => 'Bruger',
            'environment' => 'Miljø',
            'debug_mode' => 'Debug-tilstand',
            'php_version' => 'PHP-version',
            'laravel_version' => 'Laravel-version',
            'laravel' => 'Laravel',
            'peak_memory' => 'Spidshukommelse',
            'enabled' => 'Aktiveret',
            'disabled' => 'Deaktiveret',
            'relation' => 'Relation: :name',
            'bindings' => 'Bindinger:',
            'trace_number' => '#',
            'trace_location' => 'Placering',
            'trace_call' => 'Kald',
        ],

        'collection' => [
            'count' => ':count element|:count elementer',
            'more' => '... og :count elementer mere',
        ],

        'error' => [
            'subject' => ':app - Der er opstået en fejl',
            'guest' => 'Gæst',
            'console' => 'Konsol',
            'section_exception' => 'Undtagelsesdetaljer',
            'section_trace' => 'Stack Trace',
            'section_request' => 'Forespørgselskontekst',
            'section_user' => 'Godkendt bruger',
            'section_environment' => 'Miljø',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Gæst',
            'console' => 'Konsol',
            'section_data' => 'Debug-data',
            'section_call_site' => 'Kaldssted',
            'section_request' => 'Forespørgselskontekst',
            'section_environment' => 'Miljø',
        ],

        'log_file' => [
            'subject' => ':app - Logfil: :file',
            'bulk_subject' => ':app - :count logfiler vedhæftet',
            'body' => 'Logfilen <strong>:file</strong> fra :app er vedhæftet.',
            'body_text' => 'Logfilen :file fra :app er vedhæftet.',
        ],
    ],

    'settings' => [
        'recipients' => 'Modtagere',
        'throttling' => 'Begrænsning',
        'email_address' => 'E-mailadresse',
        'add_recipient' => 'Tilføj modtager',
        'no_recipients_warning' => 'Ingen modtagere konfigureret — notifikationer sendes ikke, før der er tilføjet mindst én e-mailadresse.',
        'throttle_rate' => 'Begrænsningsfrekvens',
        'minutes_suffix' => 'minutter',

        'error' => [
            'enabled' => 'Aktivér fejlnotifikationer',
            'enabled_helper' => 'Når deaktiveret, sendes der ingen fejl-e-mails.',
            'recipients_helper' => 'Tilføj e-mailadresser, der skal modtage fejlnotifikationer.',
            'throttle_helper' => 'Minimum antal minutter mellem duplikerede fejl-e-mails.',
            'throttle_exceptions' => 'Begræns undtagelser',
            'throttle_exceptions_helper' => 'Når aktiveret, vil duplikerede undtagelser på samme fil:linje ikke udløse e-mails inden for begrænsningsvinduet.',
            'throttle_log_messages' => 'Begræns logmeddelelser',
            'throttle_log_messages_helper' => 'Når aktiveret, vil identiske fejllogmeddelelser ikke udløse e-mails inden for begrænsningsvinduet.',
            'ignored_exceptions' => 'Ignorerede undtagelser',
            'ignored_exceptions_description' => 'Undtagelser på denne liste vil ikke udløse e-mailnotifikationer.',
            'ignored_exceptions_label' => 'Ignorerede undtagelser',
            'other_custom' => 'Anden (tilpasset)',
            'exception_class' => 'Undtagelsesklasse (FQCN)',
            'class_not_exist' => 'Denne klasse eksisterer ikke.',
            'custom_exception' => 'Tilpasset undtagelse',
            'select_exception' => 'Vælg undtagelse',
            'add_exception' => 'Tilføj undtagelse',
        ],

        'debug' => [
            'enabled' => 'Aktivér Debug-kanal',
            'enabled_helper' => 'Når deaktiveret, ignoreres Sentinel::debug()-kald lydløst.',
            'recipients_helper' => 'Tilføj e-mailadresser, der skal modtage Debug-notifikationer.',
            'throttle_enabled' => 'Aktivér begrænsning',
            'throttle_enabled_helper' => 'Når deaktiveret, sender hvert Debug-kald en e-mail. Når aktiveret, begrænses duplikerede kald.',
            'throttle_helper' => 'Minimum antal minutter mellem duplikerede Debug-e-mails.',
        ],

        'test_email' => [
            'send' => 'Send test-e-mail',
            'sent' => 'Test-e-mail sendt til :count modtager(e)',
            'no_recipients' => 'Ingen modtagere konfigureret. Tilføj mindst én e-mailadresse først.',
            'failed' => 'Kunne ikke sende test-e-mail',
            'channel_disabled' => 'Denne kanal er i øjeblikket deaktiveret. Test-e-mailen sendes alligevel.',
        ],
    ],

    'logs' => [
        'title' => 'Systemlogfiler',
        'heading' => 'Logfiler',
        'entries_title' => 'Logposter',
        'back_to_list' => 'Tilbage til logfiler',
        'no_entries' => 'Ingen logposter fundet',
        'unsupported_format' => 'Denne fil ser ikke ud til at bruge standard Laravel-logformatet',
        'search_placeholder' => 'Søg i logposter...',
        'level_filter' => 'Logniveau',
        'email_recipient' => 'Modtager-e-mail',
        'email_description' => 'Send denne logfil som e-mailvedhæftning til den angivne modtager.',
        'bulk_email_description' => 'Send de valgte logfiler som individuelle e-mailvedhæftninger til den angivne modtager.',
        'bulk_email_files' => 'Valgte filer',

        'filter' => [
            'date_from' => 'Fra',
            'date_to' => 'Til',
        ],

        'column' => [
            'filename' => 'Filnavn',
            'size' => 'Størrelse',
            'modified' => 'Sidst ændret',
            'subfolder' => 'Undermappe',
            'level' => 'Niveau',
            'timestamp' => 'Tidsstempel',
            'message' => 'Meddelelse',
        ],

        'action' => [
            'refresh' => 'Opdater',
            'view' => 'Vis',
            'delete' => 'Slet',
            'download' => 'Download',
            'email' => 'Send e-mail til',
            'email_send' => 'Send',
            'email_sent' => 'Logfil sendt via e-mail',
            'bulk_email_sent' => ':count logfil(er) sendt via e-mail',
            'deleted' => 'Logfil slettet',
            'bulk_deleted' => ':count logfil(er) slettet',
        ],

        'confirm' => [
            'delete' => 'Er du sikker på, at du vil slette denne logfil? Denne handling kan ikke fortrydes.',
            'bulk_delete' => 'Er du sikker på, at du vil slette de valgte logfiler? Denne handling kan ikke fortrydes.',
        ],

        'entry' => [
            'detail' => 'Postdetalje',
            'line' => 'Linje',
            'trace_frames' => ':count frame|:count frames',
            'copy_trace' => 'Kopiér Stack Trace',
            'copy_entry' => 'Kopiér fuld post',
            'copied' => 'Kopieret!',
        ],
    ],

];
