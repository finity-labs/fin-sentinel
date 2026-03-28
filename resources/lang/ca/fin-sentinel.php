<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Configuració',
        'error_channel' => 'Canal d\'errors',
        'error_channel_title' => 'Configuració del canal d\'errors',
        'debug_channel' => 'Canal de Debug',
        'debug_channel_title' => 'Configuració del canal de Debug',
        'system_logs' => 'Registres del sistema',
        'log_files' => 'Fitxers de registre',
        'log_entries' => 'Entrades de registre',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Emergència',
            'ALERT' => 'Alerta',
            'CRITICAL' => 'Crític',
            'ERROR' => 'Error',
            'WARNING' => 'Advertència',
            'NOTICE' => 'Avís',
            'INFO' => 'Informació',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Notificació d\'error',
            'debug' => 'Debug',
            'log_file' => 'Fitxer de registre',
        ],
        'footer' => 'Enviat per Fin-Sentinel',

        'label' => [
            'error_message' => 'Missatge d\'error',
            'class' => 'Classe',
            'file' => 'Fitxer',
            'context' => 'Context',
            'command' => 'Comanda',
            'url' => 'URL',
            'method' => 'Mètode',
            'ip' => 'IP',
            'params' => 'Paràmetres',
            'headers' => 'Capçaleres',
            'name' => 'Nom',
            'email' => 'Correu electrònic',
            'id' => 'ID',
            'user' => 'Usuari',
            'environment' => 'Entorn',
            'debug_mode' => 'Mode Debug',
            'php_version' => 'Versió de PHP',
            'laravel_version' => 'Versió de Laravel',
            'laravel' => 'Laravel',
            'peak_memory' => 'Memòria màxima',
            'enabled' => 'Activat',
            'disabled' => 'Desactivat',
            'relation' => 'Relació: :name',
            'bindings' => 'Vinculacions:',
            'trace_number' => '#',
            'trace_location' => 'Ubicació',
            'trace_call' => 'Crida',
        ],

        'collection' => [
            'count' => ':count element|:count elements',
            'more' => '... i :count elements més',
        ],

        'error' => [
            'subject' => ':app - S\'ha produït un error',
            'guest' => 'Convidat',
            'console' => 'Consola',
            'section_exception' => 'Detalls de l\'excepció',
            'section_trace' => 'Traça de pila',
            'section_request' => 'Context de la sol·licitud',
            'section_user' => 'Usuari autenticat',
            'section_environment' => 'Entorn',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Convidat',
            'console' => 'Consola',
            'section_data' => 'Dades de Debug',
            'section_call_site' => 'Lloc de crida',
            'section_request' => 'Context de la sol·licitud',
            'section_environment' => 'Entorn',
        ],

        'log_file' => [
            'subject' => ':app - Fitxer de registre: :file',
            'bulk_subject' => ':app - :count fitxers de registre adjunts',
            'body' => 'El fitxer de registre <strong>:file</strong> de :app està adjunt.',
            'body_text' => 'El fitxer de registre :file de :app està adjunt.',
        ],
    ],

    'settings' => [
        'recipients' => 'Destinataris',
        'throttling' => 'Limitació',
        'email_address' => 'Adreça de correu electrònic',
        'add_recipient' => 'Afegir destinatari',
        'no_recipients_warning' => 'No s\'han configurat destinataris — les notificacions no s\'enviaran fins que s\'afegeixi almenys un correu electrònic.',
        'throttle_rate' => 'Taxa de limitació',
        'minutes_suffix' => 'minuts',

        'error' => [
            'enabled' => 'Activar notificacions d\'error',
            'enabled_helper' => 'Quan estigui desactivat, no s\'enviaran correus d\'error.',
            'recipients_helper' => 'Afegiu adreces de correu electrònic que rebran notificacions d\'error.',
            'throttle_helper' => 'Minuts mínims entre correus d\'error duplicats.',
            'throttle_exceptions' => 'Limitació d\'excepcions',
            'throttle_exceptions_helper' => 'Quan estigui activat, les excepcions duplicades al mateix file:line no provocaran correus dins de la finestra de limitació.',
            'throttle_log_messages' => 'Limitació de missatges de registre',
            'throttle_log_messages_helper' => 'Quan estigui activat, els missatges de registre d\'error idèntics no provocaran correus dins de la finestra de limitació.',
            'ignored_exceptions' => 'Excepcions ignorades',
            'ignored_exceptions_description' => 'Les excepcions d\'aquesta llista no provocaran notificacions per correu electrònic.',
            'ignored_exceptions_label' => 'Excepcions ignorades',
            'other_custom' => 'Altre (personalitzat)',
            'exception_class' => 'Classe d\'excepció (FQCN)',
            'class_not_exist' => 'Aquesta classe no existeix.',
            'custom_exception' => 'Excepció personalitzada',
            'select_exception' => 'Seleccionar excepció',
            'add_exception' => 'Afegir excepció',
        ],

        'debug' => [
            'enabled' => 'Activar canal de Debug',
            'enabled_helper' => 'Quan estigui desactivat, les crides a Sentinel::debug() s\'ignoraran silenciosament.',
            'recipients_helper' => 'Afegiu adreces de correu electrònic que rebran notificacions de Debug.',
            'throttle_enabled' => 'Activar limitació',
            'throttle_enabled_helper' => 'Quan estigui desactivat, cada crida de Debug enviarà un correu. Quan estigui activat, les crides duplicades es limitaran.',
            'throttle_helper' => 'Minuts mínims entre correus de Debug duplicats.',
        ],

        'test_email' => [
            'send' => 'Enviar correu de prova',
            'sent' => 'Correu de prova enviat a :count destinatari(s)',
            'no_recipients' => 'No s\'han configurat destinataris. Afegiu almenys una adreça de correu electrònic primer.',
            'failed' => 'No s\'ha pogut enviar el correu de prova',
            'channel_disabled' => 'Aquest canal està desactivat. El correu de prova s\'enviarà igualment.',
        ],
    ],

    'logs' => [
        'title' => 'Registres del sistema',
        'heading' => 'Fitxers de registre',
        'entries_title' => 'Entrades de registre',
        'back_to_list' => 'Tornar als fitxers de registre',
        'no_entries' => 'No s\'han trobat entrades de registre',
        'unsupported_format' => 'Sembla que aquest fitxer no utilitza el format de registre estàndard de Laravel',
        'search_placeholder' => 'Cercar entrades de registre...',
        'level_filter' => 'Nivell de registre',
        'email_recipient' => 'Correu del destinatari',
        'email_description' => 'Envia aquest fitxer de registre com a adjunt de correu electrònic al destinatari especificat.',
        'bulk_email_description' => 'Envia els fitxers de registre seleccionats com a adjunts individuals de correu electrònic al destinatari especificat.',
        'bulk_email_files' => 'Fitxers seleccionats',

        'filter' => [
            'date_from' => 'Des de',
            'date_to' => 'Fins a',
        ],

        'column' => [
            'filename' => 'Nom del fitxer',
            'size' => 'Mida',
            'modified' => 'Última modificació',
            'subfolder' => 'Subcarpeta',
            'level' => 'Nivell',
            'timestamp' => 'Marca de temps',
            'message' => 'Missatge',
        ],

        'action' => [
            'refresh' => 'Actualitzar',
            'view' => 'Veure',
            'delete' => 'Eliminar',
            'download' => 'Descarregar',
            'email' => 'Enviar per correu',
            'email_send' => 'Enviar',
            'email_sent' => 'Fitxer de registre enviat per correu correctament',
            'bulk_email_sent' => ':count fitxer(s) de registre enviat(s) per correu correctament',
            'deleted' => 'Fitxer de registre eliminat',
            'bulk_deleted' => ':count fitxer(s) de registre eliminat(s)',
        ],

        'confirm' => [
            'delete' => 'Esteu segur que voleu eliminar aquest fitxer de registre? Aquesta acció no es pot desfer.',
            'bulk_delete' => 'Esteu segur que voleu eliminar els fitxers de registre seleccionats? Aquesta acció no es pot desfer.',
        ],

        'entry' => [
            'detail' => 'Detall de l\'entrada',
            'line' => 'Línia',
            'trace_frames' => ':count marc|:count marcs',
            'copy_trace' => 'Copiar traça de pila',
            'copy_entry' => 'Copiar entrada completa',
            'copied' => 'Copiat!',
        ],
    ],

];
