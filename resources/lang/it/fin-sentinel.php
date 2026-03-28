<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Impostazioni',
        'error_channel' => 'Canale errori',
        'error_channel_title' => 'Impostazioni canale errori',
        'debug_channel' => 'Canale Debug',
        'debug_channel_title' => 'Impostazioni canale Debug',
        'system_logs' => 'Log di sistema',
        'log_files' => 'File di log',
        'log_entries' => 'Voci di log',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Emergenza',
            'ALERT' => 'Allerta',
            'CRITICAL' => 'Critico',
            'ERROR' => 'Errore',
            'WARNING' => 'Avviso',
            'NOTICE' => 'Nota',
            'INFO' => 'Info',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Notifica di errore',
            'debug' => 'Debug',
            'log_file' => 'File di log',
        ],
        'footer' => 'Inviato da Fin-Sentinel',

        'label' => [
            'error_message' => 'Messaggio di errore',
            'class' => 'Classe',
            'file' => 'File',
            'context' => 'Contesto',
            'command' => 'Comando',
            'url' => 'URL',
            'method' => 'Metodo',
            'ip' => 'IP',
            'params' => 'Parametri',
            'headers' => 'Intestazioni',
            'name' => 'Nome',
            'email' => 'E-mail',
            'id' => 'ID',
            'user' => 'Utente',
            'environment' => 'Ambiente',
            'debug_mode' => 'Modalità Debug',
            'php_version' => 'Versione PHP',
            'laravel_version' => 'Versione Laravel',
            'laravel' => 'Laravel',
            'peak_memory' => 'Memoria massima',
            'enabled' => 'Abilitato',
            'disabled' => 'Disabilitato',
            'relation' => 'Relazione: :name',
            'bindings' => 'Binding:',
            'trace_number' => '#',
            'trace_location' => 'Posizione',
            'trace_call' => 'Chiamata',
        ],

        'collection' => [
            'count' => ':count elemento|:count elementi',
            'more' => '... e altri :count elementi',
        ],

        'error' => [
            'subject' => ':app - Si è verificato un errore',
            'guest' => 'Ospite',
            'console' => 'Console',
            'section_exception' => 'Dettagli dell\'eccezione',
            'section_trace' => 'Stack Trace',
            'section_request' => 'Contesto della richiesta',
            'section_user' => 'Utente autenticato',
            'section_environment' => 'Ambiente',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Ospite',
            'console' => 'Console',
            'section_data' => 'Dati Debug',
            'section_call_site' => 'Sito di chiamata',
            'section_request' => 'Contesto della richiesta',
            'section_environment' => 'Ambiente',
        ],

        'log_file' => [
            'subject' => ':app - File di log: :file',
            'bulk_subject' => ':app - :count file di log allegati',
            'body' => 'Il file di log <strong>:file</strong> di :app è in allegato.',
            'body_text' => 'Il file di log :file di :app è in allegato.',
        ],
    ],

    'settings' => [
        'recipients' => 'Destinatari',
        'throttling' => 'Limitazione',
        'email_address' => 'Indirizzo e-mail',
        'add_recipient' => 'Aggiungi destinatario',
        'no_recipients_warning' => 'Nessun destinatario configurato — le notifiche non verranno inviate finché non verrà aggiunto almeno un indirizzo e-mail.',
        'throttle_rate' => 'Frequenza di limitazione',
        'minutes_suffix' => 'minuti',

        'error' => [
            'enabled' => 'Abilita notifiche di errore',
            'enabled_helper' => 'Quando disabilitato, non verranno inviate e-mail di errore.',
            'recipients_helper' => 'Aggiungi gli indirizzi e-mail che riceveranno le notifiche di errore.',
            'throttle_helper' => 'Minuti minimi tra e-mail di errore duplicate.',
            'throttle_exceptions' => 'Limita le eccezioni',
            'throttle_exceptions_helper' => 'Quando abilitato, le eccezioni duplicate nello stesso file:riga non genereranno e-mail nella finestra di limitazione.',
            'throttle_log_messages' => 'Limita i messaggi di log',
            'throttle_log_messages_helper' => 'Quando abilitato, i messaggi di errore identici non genereranno e-mail nella finestra di limitazione.',
            'ignored_exceptions' => 'Eccezioni ignorate',
            'ignored_exceptions_description' => 'Le eccezioni in questo elenco non genereranno notifiche e-mail.',
            'ignored_exceptions_label' => 'Eccezioni ignorate',
            'other_custom' => 'Altro (personalizzato)',
            'exception_class' => 'Classe di eccezione (FQCN)',
            'class_not_exist' => 'Questa classe non esiste.',
            'custom_exception' => 'Eccezione personalizzata',
            'select_exception' => 'Seleziona eccezione',
            'add_exception' => 'Aggiungi eccezione',
        ],

        'debug' => [
            'enabled' => 'Abilita canale Debug',
            'enabled_helper' => 'Quando disabilitato, le chiamate a Sentinel::debug() verranno silenziosamente ignorate.',
            'recipients_helper' => 'Aggiungi gli indirizzi e-mail che riceveranno le notifiche Debug.',
            'throttle_enabled' => 'Abilita limitazione',
            'throttle_enabled_helper' => 'Quando disabilitato, ogni chiamata Debug invia un\'e-mail. Quando abilitato, le chiamate duplicate vengono limitate.',
            'throttle_helper' => 'Minuti minimi tra e-mail Debug duplicate.',
        ],

        'test_email' => [
            'send' => 'Invia e-mail di test',
            'sent' => 'E-mail di test inviata a :count destinatario/i',
            'no_recipients' => 'Nessun destinatario configurato. Aggiungi prima almeno un indirizzo e-mail.',
            'failed' => 'Invio dell\'e-mail di test non riuscito',
            'channel_disabled' => 'Questo canale è attualmente disabilitato. L\'e-mail di test verrà comunque inviata.',
        ],
    ],

    'logs' => [
        'title' => 'Log di sistema',
        'heading' => 'File di log',
        'entries_title' => 'Voci di log',
        'back_to_list' => 'Torna ai file di log',
        'no_entries' => 'Nessuna voce di log trovata',
        'unsupported_format' => 'Questo file non sembra utilizzare il formato di log standard di Laravel',
        'search_placeholder' => 'Cerca nelle voci di log...',
        'level_filter' => 'Livello di log',
        'email_recipient' => 'E-mail del destinatario',
        'email_description' => 'Invia questo file di log come allegato e-mail al destinatario specificato.',
        'bulk_email_description' => 'Invia i file di log selezionati come allegati e-mail individuali al destinatario specificato.',
        'bulk_email_files' => 'File selezionati',

        'filter' => [
            'date_from' => 'Da',
            'date_to' => 'A',
        ],

        'column' => [
            'filename' => 'Nome file',
            'size' => 'Dimensione',
            'modified' => 'Ultima modifica',
            'subfolder' => 'Sottocartella',
            'level' => 'Livello',
            'timestamp' => 'Data e ora',
            'message' => 'Messaggio',
        ],

        'action' => [
            'refresh' => 'Aggiorna',
            'view' => 'Visualizza',
            'delete' => 'Elimina',
            'download' => 'Scarica',
            'email' => 'Invia per e-mail a',
            'email_send' => 'Invia',
            'email_sent' => 'File di log inviato per e-mail con successo',
            'bulk_email_sent' => ':count file di log inviato/i per e-mail con successo',
            'deleted' => 'File di log eliminato',
            'bulk_deleted' => ':count file di log eliminato/i',
        ],

        'confirm' => [
            'delete' => 'Sei sicuro di voler eliminare questo file di log? Questa azione non può essere annullata.',
            'bulk_delete' => 'Sei sicuro di voler eliminare i file di log selezionati? Questa azione non può essere annullata.',
        ],

        'entry' => [
            'detail' => 'Dettaglio della voce',
            'line' => 'Riga',
            'trace_frames' => ':count frame|:count frame',
            'copy_trace' => 'Copia Stack Trace',
            'copy_entry' => 'Copia voce completa',
            'copied' => 'Copiato!',
        ],
    ],

];
