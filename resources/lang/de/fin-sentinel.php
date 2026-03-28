<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Einstellungen',
        'error_channel' => 'Fehlerkanal',
        'error_channel_title' => 'Fehlerkanal-Einstellungen',
        'debug_channel' => 'Debug-Kanal',
        'debug_channel_title' => 'Debug-Kanal-Einstellungen',
        'system_logs' => 'Systemprotokolle',
        'log_files' => 'Protokolldateien',
        'log_entries' => 'Protokolleinträge',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Notfall',
            'ALERT' => 'Alarm',
            'CRITICAL' => 'Kritisch',
            'ERROR' => 'Fehler',
            'WARNING' => 'Warnung',
            'NOTICE' => 'Hinweis',
            'INFO' => 'Info',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Fehlerbenachrichtigung',
            'debug' => 'Debug',
            'log_file' => 'Protokolldatei',
        ],
        'footer' => 'Gesendet von Fin-Sentinel',

        'label' => [
            'error_message' => 'Fehlermeldung',
            'class' => 'Klasse',
            'file' => 'Datei',
            'context' => 'Kontext',
            'command' => 'Befehl',
            'url' => 'URL',
            'method' => 'Methode',
            'ip' => 'IP',
            'params' => 'Parameter',
            'headers' => 'Header',
            'name' => 'Name',
            'email' => 'E-Mail',
            'id' => 'ID',
            'user' => 'Benutzer',
            'environment' => 'Umgebung',
            'debug_mode' => 'Debug-Modus',
            'php_version' => 'PHP-Version',
            'laravel_version' => 'Laravel-Version',
            'laravel' => 'Laravel',
            'peak_memory' => 'Spitzenspeicher',
            'enabled' => 'Aktiviert',
            'disabled' => 'Deaktiviert',
            'relation' => 'Beziehung: :name',
            'bindings' => 'Bindungen:',
            'trace_number' => '#',
            'trace_location' => 'Ort',
            'trace_call' => 'Aufruf',
        ],

        'collection' => [
            'count' => ':count Element|:count Elemente',
            'more' => '... und :count weitere Elemente',
        ],

        'error' => [
            'subject' => ':app - Ein Fehler ist aufgetreten',
            'guest' => 'Gast',
            'console' => 'Konsole',
            'section_exception' => 'Ausnahmedetails',
            'section_trace' => 'Stack-Trace',
            'section_request' => 'Anfragekontext',
            'section_user' => 'Authentifizierter Benutzer',
            'section_environment' => 'Umgebung',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Gast',
            'console' => 'Konsole',
            'section_data' => 'Debug-Daten',
            'section_call_site' => 'Aufrufstelle',
            'section_request' => 'Anfragekontext',
            'section_environment' => 'Umgebung',
        ],

        'log_file' => [
            'subject' => ':app - Protokolldatei: :file',
            'bulk_subject' => ':app - :count Protokolldateien angehängt',
            'body' => 'Die Protokolldatei <strong>:file</strong> von :app ist angehängt.',
            'body_text' => 'Die Protokolldatei :file von :app ist angehängt.',
        ],
    ],

    'settings' => [
        'recipients' => 'Empfänger',
        'throttling' => 'Drosselung',
        'email_address' => 'E-Mail-Adresse',
        'add_recipient' => 'Empfänger hinzufügen',
        'no_recipients_warning' => 'Keine Empfänger konfiguriert — Benachrichtigungen werden erst gesendet, wenn mindestens eine E-Mail-Adresse hinzugefügt wurde.',
        'throttle_rate' => 'Drosselungsrate',
        'minutes_suffix' => 'Minuten',

        'error' => [
            'enabled' => 'Fehlerbenachrichtigungen aktivieren',
            'enabled_helper' => 'Wenn deaktiviert, werden keine Fehler-E-Mails gesendet.',
            'recipients_helper' => 'E-Mail-Adressen hinzufügen, die Fehlerbenachrichtigungen erhalten sollen.',
            'throttle_helper' => 'Mindestanzahl Minuten zwischen doppelten Fehler-E-Mails.',
            'throttle_exceptions' => 'Ausnahmen drosseln',
            'throttle_exceptions_helper' => 'Wenn aktiviert, lösen doppelte Ausnahmen an derselben Datei:Zeile innerhalb des Drosselungsfensters keine E-Mails aus.',
            'throttle_log_messages' => 'Protokollmeldungen drosseln',
            'throttle_log_messages_helper' => 'Wenn aktiviert, lösen identische Fehlerprotokollmeldungen innerhalb des Drosselungsfensters keine E-Mails aus.',
            'ignored_exceptions' => 'Ignorierte Ausnahmen',
            'ignored_exceptions_description' => 'Ausnahmen in dieser Liste lösen keine E-Mail-Benachrichtigungen aus.',
            'ignored_exceptions_label' => 'Ignorierte Ausnahmen',
            'other_custom' => 'Andere (benutzerdefiniert)',
            'exception_class' => 'Ausnahmeklasse (FQCN)',
            'class_not_exist' => 'Diese Klasse existiert nicht.',
            'custom_exception' => 'Benutzerdefinierte Ausnahme',
            'select_exception' => 'Ausnahme auswählen',
            'add_exception' => 'Ausnahme hinzufügen',
        ],

        'debug' => [
            'enabled' => 'Debug-Kanal aktivieren',
            'enabled_helper' => 'Wenn deaktiviert, werden Sentinel::debug()-Aufrufe stillschweigend ignoriert.',
            'recipients_helper' => 'E-Mail-Adressen hinzufügen, die Debug-Benachrichtigungen erhalten sollen.',
            'throttle_enabled' => 'Drosselung aktivieren',
            'throttle_enabled_helper' => 'Wenn deaktiviert, sendet jeder Debug-Aufruf eine E-Mail. Wenn aktiviert, werden doppelte Aufrufe gedrosselt.',
            'throttle_helper' => 'Mindestanzahl Minuten zwischen doppelten Debug-E-Mails.',
        ],

        'test_email' => [
            'send' => 'Test-E-Mail senden',
            'sent' => 'Test-E-Mail an :count Empfänger gesendet',
            'no_recipients' => 'Keine Empfänger konfiguriert. Fügen Sie zuerst mindestens eine E-Mail-Adresse hinzu.',
            'failed' => 'Test-E-Mail konnte nicht gesendet werden',
            'channel_disabled' => 'Dieser Kanal ist derzeit deaktiviert. Die Test-E-Mail wird trotzdem gesendet.',
        ],
    ],

    'logs' => [
        'title' => 'Systemprotokolle',
        'heading' => 'Protokolldateien',
        'entries_title' => 'Protokolleinträge',
        'back_to_list' => 'Zurück zu Protokolldateien',
        'no_entries' => 'Keine Protokolleinträge gefunden',
        'unsupported_format' => 'Diese Datei scheint nicht das Standard-Laravel-Protokollformat zu verwenden',
        'search_placeholder' => 'Protokolleinträge durchsuchen...',
        'level_filter' => 'Protokollebene',
        'email_recipient' => 'Empfänger-E-Mail',
        'email_description' => 'Diese Protokolldatei als E-Mail-Anhang an den angegebenen Empfänger senden.',
        'bulk_email_description' => 'Die ausgewählten Protokolldateien als einzelne E-Mail-Anhänge an den angegebenen Empfänger senden.',
        'bulk_email_files' => 'Ausgewählte Dateien',

        'filter' => [
            'date_from' => 'Von',
            'date_to' => 'Bis',
        ],

        'column' => [
            'filename' => 'Dateiname',
            'size' => 'Größe',
            'modified' => 'Zuletzt geändert',
            'subfolder' => 'Unterordner',
            'level' => 'Ebene',
            'timestamp' => 'Zeitstempel',
            'message' => 'Nachricht',
        ],

        'action' => [
            'refresh' => 'Aktualisieren',
            'view' => 'Anzeigen',
            'delete' => 'Löschen',
            'download' => 'Herunterladen',
            'email' => 'Per E-Mail senden an',
            'email_send' => 'Senden',
            'email_sent' => 'Protokolldatei erfolgreich per E-Mail gesendet',
            'bulk_email_sent' => ':count Protokolldatei(en) erfolgreich per E-Mail gesendet',
            'deleted' => 'Protokolldatei gelöscht',
            'bulk_deleted' => ':count Protokolldatei(en) gelöscht',
        ],

        'confirm' => [
            'delete' => 'Möchten Sie diese Protokolldatei wirklich löschen? Diese Aktion kann nicht rückgängig gemacht werden.',
            'bulk_delete' => 'Möchten Sie die ausgewählten Protokolldateien wirklich löschen? Diese Aktion kann nicht rückgängig gemacht werden.',
        ],

        'entry' => [
            'detail' => 'Eintragsdetail',
            'line' => 'Zeile',
            'trace_frames' => ':count Frame|:count Frames',
            'copy_trace' => 'Stack-Trace kopieren',
            'copy_entry' => 'Vollständigen Eintrag kopieren',
            'copied' => 'Kopiert!',
        ],
    ],

];
