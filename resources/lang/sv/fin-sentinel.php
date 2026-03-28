<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Inställningar',
        'error_channel' => 'Felkanal',
        'error_channel_title' => 'Inställningar för felkanal',
        'debug_channel' => 'Debug-kanal',
        'debug_channel_title' => 'Inställningar för Debug-kanal',
        'system_logs' => 'Systemloggar',
        'log_files' => 'Loggfiler',
        'log_entries' => 'Loggposter',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Nödläge',
            'ALERT' => 'Larm',
            'CRITICAL' => 'Kritisk',
            'ERROR' => 'Fel',
            'WARNING' => 'Varning',
            'NOTICE' => 'Notering',
            'INFO' => 'Info',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Felnotifiering',
            'debug' => 'Debug',
            'log_file' => 'Loggfil',
        ],
        'footer' => 'Skickat av Fin-Sentinel',

        'label' => [
            'error_message' => 'Felmeddelande',
            'class' => 'Klass',
            'file' => 'Fil',
            'context' => 'Kontext',
            'command' => 'Kommando',
            'url' => 'URL',
            'method' => 'Metod',
            'ip' => 'IP',
            'params' => 'Parametrar',
            'headers' => 'Rubriker',
            'name' => 'Namn',
            'email' => 'E-post',
            'id' => 'ID',
            'user' => 'Användare',
            'environment' => 'Miljö',
            'debug_mode' => 'Debug-läge',
            'php_version' => 'PHP-version',
            'laravel_version' => 'Laravel-version',
            'laravel' => 'Laravel',
            'peak_memory' => 'Toppminne',
            'enabled' => 'Aktiverad',
            'disabled' => 'Inaktiverad',
            'relation' => 'Relation: :name',
            'bindings' => 'Bindningar:',
            'trace_number' => '#',
            'trace_location' => 'Plats',
            'trace_call' => 'Anrop',
        ],

        'collection' => [
            'count' => ':count objekt|:count objekt',
            'more' => '... och :count objekt till',
        ],

        'error' => [
            'subject' => ':app - Ett fel har inträffat',
            'guest' => 'Gäst',
            'console' => 'Konsol',
            'section_exception' => 'Undantagsdetaljer',
            'section_trace' => 'Stack Trace',
            'section_request' => 'Förfrågningskontext',
            'section_user' => 'Autentiserad användare',
            'section_environment' => 'Miljö',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Gäst',
            'console' => 'Konsol',
            'section_data' => 'Debug-data',
            'section_call_site' => 'Anropsplats',
            'section_request' => 'Förfrågningskontext',
            'section_environment' => 'Miljö',
        ],

        'log_file' => [
            'subject' => ':app - Loggfil: :file',
            'bulk_subject' => ':app - :count loggfiler bifogade',
            'body' => 'Loggfilen <strong>:file</strong> från :app är bifogad.',
            'body_text' => 'Loggfilen :file från :app är bifogad.',
        ],
    ],

    'settings' => [
        'recipients' => 'Mottagare',
        'throttling' => 'Begränsning',
        'email_address' => 'E-postadress',
        'add_recipient' => 'Lägg till mottagare',
        'no_recipients_warning' => 'Inga mottagare konfigurerade — notifieringar skickas inte förrän minst en e-postadress har lagts till.',
        'throttle_rate' => 'Begränsningsfrekvens',
        'minutes_suffix' => 'minuter',

        'error' => [
            'enabled' => 'Aktivera felnotifieringar',
            'enabled_helper' => 'När inaktiverad skickas inga fel-e-postmeddelanden.',
            'recipients_helper' => 'Lägg till e-postadresser som ska ta emot felnotifieringar.',
            'throttle_helper' => 'Minsta antal minuter mellan duplicerade fel-e-postmeddelanden.',
            'throttle_exceptions' => 'Begränsa undantag',
            'throttle_exceptions_helper' => 'När aktiverad kommer duplicerade undantag på samma fil:rad inte att utlösa e-post inom begränsningsfönstret.',
            'throttle_log_messages' => 'Begränsa loggmeddelanden',
            'throttle_log_messages_helper' => 'När aktiverad kommer identiska felloggmeddelanden inte att utlösa e-post inom begränsningsfönstret.',
            'ignored_exceptions' => 'Ignorerade undantag',
            'ignored_exceptions_description' => 'Undantag i denna lista kommer inte att utlösa e-postnotifieringar.',
            'ignored_exceptions_label' => 'Ignorerade undantag',
            'other_custom' => 'Annan (anpassad)',
            'exception_class' => 'Undantagsklass (FQCN)',
            'class_not_exist' => 'Denna klass finns inte.',
            'custom_exception' => 'Anpassat undantag',
            'select_exception' => 'Välj undantag',
            'add_exception' => 'Lägg till undantag',
        ],

        'debug' => [
            'enabled' => 'Aktivera Debug-kanal',
            'enabled_helper' => 'När inaktiverad ignoreras Sentinel::debug()-anrop tyst.',
            'recipients_helper' => 'Lägg till e-postadresser som ska ta emot Debug-notifieringar.',
            'throttle_enabled' => 'Aktivera begränsning',
            'throttle_enabled_helper' => 'När inaktiverad skickar varje Debug-anrop ett e-postmeddelande. När aktiverad begränsas duplicerade anrop.',
            'throttle_helper' => 'Minsta antal minuter mellan duplicerade Debug-e-postmeddelanden.',
        ],

        'test_email' => [
            'send' => 'Skicka test-e-post',
            'sent' => 'Test-e-post skickat till :count mottagare',
            'no_recipients' => 'Inga mottagare konfigurerade. Lägg till minst en e-postadress först.',
            'failed' => 'Kunde inte skicka test-e-post',
            'channel_disabled' => 'Denna kanal är för närvarande inaktiverad. Test-e-posten skickas ändå.',
        ],
    ],

    'logs' => [
        'title' => 'Systemloggar',
        'heading' => 'Loggfiler',
        'entries_title' => 'Loggposter',
        'back_to_list' => 'Tillbaka till loggfiler',
        'no_entries' => 'Inga loggposter hittades',
        'unsupported_format' => 'Denna fil verkar inte använda standard Laravel-loggformatet',
        'search_placeholder' => 'Sök i loggposter...',
        'level_filter' => 'Loggnivå',
        'email_recipient' => 'Mottagarens e-post',
        'email_description' => 'Skicka denna loggfil som e-postbilaga till den angivna mottagaren.',
        'bulk_email_description' => 'Skicka de valda loggfilerna som enskilda e-postbilagor till den angivna mottagaren.',
        'bulk_email_files' => 'Valda filer',

        'filter' => [
            'date_from' => 'Från',
            'date_to' => 'Till',
        ],

        'column' => [
            'filename' => 'Filnamn',
            'size' => 'Storlek',
            'modified' => 'Senast ändrad',
            'subfolder' => 'Undermapp',
            'level' => 'Nivå',
            'timestamp' => 'Tidsstämpel',
            'message' => 'Meddelande',
        ],

        'action' => [
            'refresh' => 'Uppdatera',
            'view' => 'Visa',
            'delete' => 'Radera',
            'download' => 'Ladda ner',
            'email' => 'Skicka e-post till',
            'email_send' => 'Skicka',
            'email_sent' => 'Loggfil skickad via e-post',
            'bulk_email_sent' => ':count loggfil(er) skickade via e-post',
            'deleted' => 'Loggfil raderad',
            'bulk_deleted' => ':count loggfil(er) raderade',
        ],

        'confirm' => [
            'delete' => 'Är du säker på att du vill radera denna loggfil? Denna åtgärd kan inte ångras.',
            'bulk_delete' => 'Är du säker på att du vill radera de valda loggfilerna? Denna åtgärd kan inte ångras.',
        ],

        'entry' => [
            'detail' => 'Postdetalj',
            'line' => 'Rad',
            'trace_frames' => ':count frame|:count frames',
            'copy_trace' => 'Kopiera Stack Trace',
            'copy_entry' => 'Kopiera hela posten',
            'copied' => 'Kopierat!',
        ],
    ],

];
