<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Setări',
        'error_channel' => 'Canal de erori',
        'error_channel_title' => 'Setări canal de erori',
        'debug_channel' => 'Canal Debug',
        'debug_channel_title' => 'Setări canal Debug',
        'system_logs' => 'Jurnale de sistem',
        'log_files' => 'Fișiere jurnal',
        'log_entries' => 'Intrări jurnal',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Urgență',
            'ALERT' => 'Alertă',
            'CRITICAL' => 'Critic',
            'ERROR' => 'Eroare',
            'WARNING' => 'Avertisment',
            'NOTICE' => 'Notificare',
            'INFO' => 'Informație',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Notificare de eroare',
            'debug' => 'Debug',
            'log_file' => 'Fișier jurnal',
        ],
        'footer' => 'Trimis de Fin-Sentinel',

        'label' => [
            'error_message' => 'Mesaj de eroare',
            'class' => 'Clasă',
            'file' => 'Fișier',
            'context' => 'Context',
            'command' => 'Comandă',
            'url' => 'URL',
            'method' => 'Metodă',
            'ip' => 'IP',
            'params' => 'Parametri',
            'headers' => 'Anteturi',
            'name' => 'Nume',
            'email' => 'Email',
            'id' => 'ID',
            'user' => 'Utilizator',
            'environment' => 'Mediu',
            'debug_mode' => 'Mod Debug',
            'php_version' => 'Versiune PHP',
            'laravel_version' => 'Versiune Laravel',
            'laravel' => 'Laravel',
            'peak_memory' => 'Memorie de vârf',
            'enabled' => 'Activat',
            'disabled' => 'Dezactivat',
            'relation' => 'Relație: :name',
            'bindings' => 'Legări:',
            'trace_number' => '#',
            'trace_location' => 'Locație',
            'trace_call' => 'Apel',
        ],

        'collection' => [
            'count' => ':count element|:count elemente',
            'more' => '... și încă :count elemente',
        ],

        'error' => [
            'subject' => ':app - A apărut o eroare',
            'guest' => 'Vizitator',
            'console' => 'Consolă',
            'section_exception' => 'Detalii excepție',
            'section_trace' => 'Urmărire stivă',
            'section_request' => 'Context cerere',
            'section_user' => 'Utilizator autentificat',
            'section_environment' => 'Mediu',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Vizitator',
            'console' => 'Consolă',
            'section_data' => 'Date Debug',
            'section_call_site' => 'Locul apelului',
            'section_request' => 'Context cerere',
            'section_environment' => 'Mediu',
        ],

        'log_file' => [
            'subject' => ':app - Fișier jurnal: :file',
            'bulk_subject' => ':app - :count fișiere jurnal atașate',
            'body' => 'Fișierul jurnal <strong>:file</strong> din :app este atașat.',
            'body_text' => 'Fișierul jurnal :file din :app este atașat.',
        ],
    ],

    'settings' => [
        'recipients' => 'Destinatari',
        'throttling' => 'Limitare',
        'email_address' => 'Adresă de email',
        'add_recipient' => 'Adaugă destinatar',
        'no_recipients_warning' => 'Nu sunt configurați destinatari — notificările nu vor fi trimise până când nu este adăugată cel puțin o adresă de email.',
        'throttle_rate' => 'Rata de limitare',
        'minutes_suffix' => 'minute',

        'error' => [
            'enabled' => 'Activare notificări de erori',
            'enabled_helper' => 'Când este dezactivat, nu vor fi trimise email-uri de eroare.',
            'recipients_helper' => 'Adăugați adresele de email care vor primi notificări de erori.',
            'throttle_helper' => 'Minute minime între email-urile de eroare duplicate.',
            'throttle_exceptions' => 'Limitare excepții',
            'throttle_exceptions_helper' => 'Când este activat, excepțiile duplicate la același fișier:linie nu vor trimite email-uri în fereastra de limitare.',
            'throttle_log_messages' => 'Limitare mesaje jurnal',
            'throttle_log_messages_helper' => 'Când este activat, mesajele identice de eroare din jurnal nu vor trimite email-uri în fereastra de limitare.',
            'ignored_exceptions' => 'Excepții ignorate',
            'ignored_exceptions_description' => 'Excepțiile din această listă nu vor declanșa notificări prin email.',
            'ignored_exceptions_label' => 'Excepții ignorate',
            'other_custom' => 'Altul (personalizat)',
            'exception_class' => 'Clasă excepție (FQCN)',
            'class_not_exist' => 'Această clasă nu există.',
            'custom_exception' => 'Excepție personalizată',
            'select_exception' => 'Selectați excepția',
            'add_exception' => 'Adaugă excepție',
        ],

        'debug' => [
            'enabled' => 'Activare canal Debug',
            'enabled_helper' => 'Când este dezactivat, apelurile Sentinel::debug() vor fi ignorate silențios.',
            'recipients_helper' => 'Adăugați adresele de email care vor primi notificări Debug.',
            'throttle_enabled' => 'Activare limitare',
            'throttle_enabled_helper' => 'Când este dezactivat, fiecare apel debug trimite un email. Când este activat, apelurile duplicate sunt limitate.',
            'throttle_helper' => 'Minute minime între email-urile Debug duplicate.',
        ],

        'test_email' => [
            'send' => 'Trimite email de test',
            'sent' => 'Email de test trimis la :count destinatar(i)',
            'no_recipients' => 'Nu sunt configurați destinatari. Adăugați mai întâi cel puțin o adresă de email.',
            'failed' => 'Trimiterea email-ului de test a eșuat',
            'channel_disabled' => 'Acest canal este momentan dezactivat. Email-ul de test va fi trimis oricum.',
        ],
    ],

    'logs' => [
        'title' => 'Jurnale de sistem',
        'heading' => 'Fișiere jurnal',
        'entries_title' => 'Intrări jurnal',
        'back_to_list' => 'Înapoi la fișierele jurnal',
        'no_entries' => 'Nu au fost găsite intrări în jurnal',
        'unsupported_format' => 'Acest fișier nu pare să utilizeze formatul standard de jurnal Laravel',
        'search_placeholder' => 'Căutare în jurnale...',
        'level_filter' => 'Nivel jurnal',
        'email_recipient' => 'Email destinatar',
        'email_description' => 'Trimiteți acest fișier jurnal ca atașament email destinatarului specificat.',
        'bulk_email_description' => 'Trimiteți fișierele jurnal selectate ca atașamente email individuale destinatarului specificat.',
        'bulk_email_files' => 'Fișiere selectate',

        'filter' => [
            'date_from' => 'De la',
            'date_to' => 'Până la',
        ],

        'column' => [
            'filename' => 'Nume fișier',
            'size' => 'Dimensiune',
            'modified' => 'Ultima modificare',
            'subfolder' => 'Subdosar',
            'level' => 'Nivel',
            'timestamp' => 'Marcaj temporal',
            'message' => 'Mesaj',
        ],

        'action' => [
            'refresh' => 'Reîmprospătare',
            'view' => 'Vizualizare',
            'delete' => 'Ștergere',
            'download' => 'Descărcare',
            'email' => 'Trimite prin email',
            'email_send' => 'Trimite',
            'email_sent' => 'Fișier jurnal trimis cu succes prin email',
            'bulk_email_sent' => ':count fișier(e) jurnal trimise cu succes prin email',
            'deleted' => 'Fișier jurnal șters',
            'bulk_deleted' => ':count fișier(e) jurnal șterse',
        ],

        'confirm' => [
            'delete' => 'Sigur doriți să ștergeți acest fișier jurnal? Această acțiune nu poate fi anulată.',
            'bulk_delete' => 'Sigur doriți să ștergeți fișierele jurnal selectate? Această acțiune nu poate fi anulată.',
        ],

        'entry' => [
            'detail' => 'Detalii intrare',
            'line' => 'Linie',
            'trace_frames' => ':count cadru|:count cadre',
            'copy_trace' => 'Copiază urmărirea stivei',
            'copy_entry' => 'Copiază intrarea completă',
            'copied' => 'Copiat!',
        ],
    ],

];
