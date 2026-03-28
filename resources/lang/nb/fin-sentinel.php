<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Innstillinger',
        'error_channel' => 'Feilkanal',
        'error_channel_title' => 'Innstillinger for feilkanal',
        'debug_channel' => 'Debug-kanal',
        'debug_channel_title' => 'Innstillinger for Debug-kanal',
        'system_logs' => 'Systemlogger',
        'log_files' => 'Loggfiler',
        'log_entries' => 'Loggoppføringer',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Nødsituasjon',
            'ALERT' => 'Alarm',
            'CRITICAL' => 'Kritisk',
            'ERROR' => 'Feil',
            'WARNING' => 'Advarsel',
            'NOTICE' => 'Merknad',
            'INFO' => 'Info',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Feilvarsel',
            'debug' => 'Debug',
            'log_file' => 'Loggfil',
        ],
        'footer' => 'Sendt av Fin-Sentinel',

        'label' => [
            'error_message' => 'Feilmelding',
            'class' => 'Klasse',
            'file' => 'Fil',
            'context' => 'Kontekst',
            'command' => 'Kommando',
            'url' => 'URL',
            'method' => 'Metode',
            'ip' => 'IP',
            'params' => 'Parametere',
            'headers' => 'Overskrifter',
            'name' => 'Navn',
            'email' => 'E-post',
            'id' => 'ID',
            'user' => 'Bruker',
            'environment' => 'Miljø',
            'debug_mode' => 'Debug-modus',
            'php_version' => 'PHP-versjon',
            'laravel_version' => 'Laravel-versjon',
            'laravel' => 'Laravel',
            'peak_memory' => 'Toppminne',
            'enabled' => 'Aktivert',
            'disabled' => 'Deaktivert',
            'relation' => 'Relasjon: :name',
            'bindings' => 'Bindinger:',
            'trace_number' => '#',
            'trace_location' => 'Plassering',
            'trace_call' => 'Kall',
        ],

        'collection' => [
            'count' => ':count element|:count elementer',
            'more' => '... og :count elementer til',
        ],

        'error' => [
            'subject' => ':app - Det har oppstått en feil',
            'guest' => 'Gjest',
            'console' => 'Konsoll',
            'section_exception' => 'Unntaksdetaljer',
            'section_trace' => 'Stack Trace',
            'section_request' => 'Forespørselskontekst',
            'section_user' => 'Autentisert bruker',
            'section_environment' => 'Miljø',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Gjest',
            'console' => 'Konsoll',
            'section_data' => 'Debug-data',
            'section_call_site' => 'Kallsted',
            'section_request' => 'Forespørselskontekst',
            'section_environment' => 'Miljø',
        ],

        'log_file' => [
            'subject' => ':app - Loggfil: :file',
            'bulk_subject' => ':app - :count loggfiler vedlagt',
            'body' => 'Loggfilen <strong>:file</strong> fra :app er vedlagt.',
            'body_text' => 'Loggfilen :file fra :app er vedlagt.',
        ],
    ],

    'settings' => [
        'recipients' => 'Mottakere',
        'throttling' => 'Begrensning',
        'email_address' => 'E-postadresse',
        'add_recipient' => 'Legg til mottaker',
        'no_recipients_warning' => 'Ingen mottakere konfigurert — varsler sendes ikke før minst én e-postadresse er lagt til.',
        'throttle_rate' => 'Begrensningsfrekvens',
        'minutes_suffix' => 'minutter',

        'error' => [
            'enabled' => 'Aktiver feilvarsler',
            'enabled_helper' => 'Når deaktivert, sendes ingen feil-e-poster.',
            'recipients_helper' => 'Legg til e-postadresser som skal motta feilvarsler.',
            'throttle_helper' => 'Minimum antall minutter mellom dupliserte feil-e-poster.',
            'throttle_exceptions' => 'Begrens unntak',
            'throttle_exceptions_helper' => 'Når aktivert, vil dupliserte unntak på samme fil:linje ikke utløse e-poster innenfor begrensningsvinduet.',
            'throttle_log_messages' => 'Begrens loggmeldinger',
            'throttle_log_messages_helper' => 'Når aktivert, vil identiske feilloggmeldinger ikke utløse e-poster innenfor begrensningsvinduet.',
            'ignored_exceptions' => 'Ignorerte unntak',
            'ignored_exceptions_description' => 'Unntak i denne listen vil ikke utløse e-postvarsler.',
            'ignored_exceptions_label' => 'Ignorerte unntak',
            'other_custom' => 'Annet (tilpasset)',
            'exception_class' => 'Unntaksklasse (FQCN)',
            'class_not_exist' => 'Denne klassen finnes ikke.',
            'custom_exception' => 'Tilpasset unntak',
            'select_exception' => 'Velg unntak',
            'add_exception' => 'Legg til unntak',
        ],

        'debug' => [
            'enabled' => 'Aktiver Debug-kanal',
            'enabled_helper' => 'Når deaktivert, ignoreres Sentinel::debug()-kall stille.',
            'recipients_helper' => 'Legg til e-postadresser som skal motta Debug-varsler.',
            'throttle_enabled' => 'Aktiver begrensning',
            'throttle_enabled_helper' => 'Når deaktivert, sender hvert Debug-kall en e-post. Når aktivert, begrenses dupliserte kall.',
            'throttle_helper' => 'Minimum antall minutter mellom dupliserte Debug-e-poster.',
        ],

        'test_email' => [
            'send' => 'Send test-e-post',
            'sent' => 'Test-e-post sendt til :count mottaker(e)',
            'no_recipients' => 'Ingen mottakere konfigurert. Legg til minst én e-postadresse først.',
            'failed' => 'Kunne ikke sende test-e-post',
            'channel_disabled' => 'Denne kanalen er for øyeblikket deaktivert. Test-e-posten sendes likevel.',
        ],
    ],

    'logs' => [
        'title' => 'Systemlogger',
        'heading' => 'Loggfiler',
        'entries_title' => 'Loggoppføringer',
        'back_to_list' => 'Tilbake til loggfiler',
        'no_entries' => 'Ingen loggoppføringer funnet',
        'unsupported_format' => 'Denne filen ser ikke ut til å bruke standard Laravel-loggformatet',
        'search_placeholder' => 'Søk i loggoppføringer...',
        'level_filter' => 'Loggnivå',
        'email_recipient' => 'Mottakers e-post',
        'email_description' => 'Send denne loggfilen som e-postvedlegg til den angitte mottakeren.',
        'bulk_email_description' => 'Send de valgte loggfilene som individuelle e-postvedlegg til den angitte mottakeren.',
        'bulk_email_files' => 'Valgte filer',

        'filter' => [
            'date_from' => 'Fra',
            'date_to' => 'Til',
        ],

        'column' => [
            'filename' => 'Filnavn',
            'size' => 'Størrelse',
            'modified' => 'Sist endret',
            'subfolder' => 'Undermappe',
            'level' => 'Nivå',
            'timestamp' => 'Tidsstempel',
            'message' => 'Melding',
        ],

        'action' => [
            'refresh' => 'Oppdater',
            'view' => 'Vis',
            'delete' => 'Slett',
            'download' => 'Last ned',
            'email' => 'Send e-post til',
            'email_send' => 'Send',
            'email_sent' => 'Loggfil sendt via e-post',
            'bulk_email_sent' => ':count loggfil(er) sendt via e-post',
            'deleted' => 'Loggfil slettet',
            'bulk_deleted' => ':count loggfil(er) slettet',
        ],

        'confirm' => [
            'delete' => 'Er du sikker på at du vil slette denne loggfilen? Denne handlingen kan ikke angres.',
            'bulk_delete' => 'Er du sikker på at du vil slette de valgte loggfilene? Denne handlingen kan ikke angres.',
        ],

        'entry' => [
            'detail' => 'Oppføringsdetalj',
            'line' => 'Linje',
            'trace_frames' => ':count frame|:count frames',
            'copy_trace' => 'Kopier Stack Trace',
            'copy_entry' => 'Kopier hele oppføringen',
            'copied' => 'Kopiert!',
        ],
    ],

];
