<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Configuración',
        'error_channel' => 'Canal de errores',
        'error_channel_title' => 'Configuración del canal de errores',
        'debug_channel' => 'Canal Debug',
        'debug_channel_title' => 'Configuración del canal Debug',
        'system_logs' => 'Registros del sistema',
        'log_files' => 'Archivos de registro',
        'log_entries' => 'Entradas de registro',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Emergencia',
            'ALERT' => 'Alerta',
            'CRITICAL' => 'Crítico',
            'ERROR' => 'Error',
            'WARNING' => 'Advertencia',
            'NOTICE' => 'Aviso',
            'INFO' => 'Info',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Notificación de error',
            'debug' => 'Debug',
            'log_file' => 'Archivo de registro',
        ],
        'footer' => 'Enviado por Fin-Sentinel',

        'label' => [
            'error_message' => 'Mensaje de error',
            'class' => 'Clase',
            'file' => 'Archivo',
            'context' => 'Contexto',
            'command' => 'Comando',
            'url' => 'URL',
            'method' => 'Método',
            'ip' => 'IP',
            'params' => 'Parámetros',
            'headers' => 'Encabezados',
            'name' => 'Nombre',
            'email' => 'Correo electrónico',
            'id' => 'ID',
            'user' => 'Usuario',
            'environment' => 'Entorno',
            'debug_mode' => 'Modo Debug',
            'php_version' => 'Versión de PHP',
            'laravel_version' => 'Versión de Laravel',
            'laravel' => 'Laravel',
            'peak_memory' => 'Memoria máxima',
            'enabled' => 'Activado',
            'disabled' => 'Desactivado',
            'relation' => 'Relación: :name',
            'bindings' => 'Vinculaciones:',
            'trace_number' => '#',
            'trace_location' => 'Ubicación',
            'trace_call' => 'Llamada',
        ],

        'collection' => [
            'count' => ':count elemento|:count elementos',
            'more' => '... y :count elementos más',
        ],

        'error' => [
            'subject' => ':app - Ha ocurrido un error',
            'guest' => 'Invitado',
            'console' => 'Consola',
            'section_exception' => 'Detalles de la excepción',
            'section_trace' => 'Stack Trace',
            'section_request' => 'Contexto de la solicitud',
            'section_user' => 'Usuario autenticado',
            'section_environment' => 'Entorno',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Invitado',
            'console' => 'Consola',
            'section_data' => 'Datos de Debug',
            'section_call_site' => 'Sitio de llamada',
            'section_request' => 'Contexto de la solicitud',
            'section_environment' => 'Entorno',
        ],

        'log_file' => [
            'subject' => ':app - Archivo de registro: :file',
            'bulk_subject' => ':app - :count archivos de registro adjuntos',
            'body' => 'El archivo de registro <strong>:file</strong> de :app está adjunto.',
            'body_text' => 'El archivo de registro :file de :app está adjunto.',
        ],
    ],

    'settings' => [
        'recipients' => 'Destinatarios',
        'throttling' => 'Limitación',
        'email_address' => 'Dirección de correo electrónico',
        'add_recipient' => 'Añadir destinatario',
        'no_recipients_warning' => 'No hay destinatarios configurados — las notificaciones no se enviarán hasta que se agregue al menos una dirección de correo electrónico.',
        'throttle_rate' => 'Tasa de limitación',
        'minutes_suffix' => 'minutos',

        'error' => [
            'enabled' => 'Activar notificaciones de error',
            'enabled_helper' => 'Cuando está desactivado, no se enviarán correos de error.',
            'recipients_helper' => 'Agregue las direcciones de correo electrónico que recibirán las notificaciones de error.',
            'throttle_helper' => 'Minutos mínimos entre correos de error duplicados.',
            'throttle_exceptions' => 'Limitar excepciones',
            'throttle_exceptions_helper' => 'Cuando está activado, las excepciones duplicadas en el mismo archivo:línea no generarán correos dentro de la ventana de limitación.',
            'throttle_log_messages' => 'Limitar mensajes de registro',
            'throttle_log_messages_helper' => 'Cuando está activado, los mensajes de error idénticos no generarán correos dentro de la ventana de limitación.',
            'ignored_exceptions' => 'Excepciones ignoradas',
            'ignored_exceptions_description' => 'Las excepciones en esta lista no generarán notificaciones por correo electrónico.',
            'ignored_exceptions_label' => 'Excepciones ignoradas',
            'other_custom' => 'Otro (personalizado)',
            'exception_class' => 'Clase de excepción (FQCN)',
            'class_not_exist' => 'Esta clase no existe.',
            'custom_exception' => 'Excepción personalizada',
            'select_exception' => 'Seleccionar excepción',
            'add_exception' => 'Añadir excepción',
        ],

        'debug' => [
            'enabled' => 'Activar canal Debug',
            'enabled_helper' => 'Cuando está desactivado, las llamadas a Sentinel::debug() se ignorarán silenciosamente.',
            'recipients_helper' => 'Agregue las direcciones de correo electrónico que recibirán las notificaciones Debug.',
            'throttle_enabled' => 'Activar limitación',
            'throttle_enabled_helper' => 'Cuando está desactivado, cada llamada Debug envía un correo. Cuando está activado, las llamadas duplicadas se limitan.',
            'throttle_helper' => 'Minutos mínimos entre correos Debug duplicados.',
        ],

        'test_email' => [
            'send' => 'Enviar correo de prueba',
            'sent' => 'Correo de prueba enviado a :count destinatario(s)',
            'no_recipients' => 'No hay destinatarios configurados. Agregue al menos una dirección de correo electrónico primero.',
            'failed' => 'Error al enviar el correo de prueba',
            'channel_disabled' => 'Este canal está actualmente desactivado. El correo de prueba se enviará de todas formas.',
        ],
    ],

    'logs' => [
        'title' => 'Registros del sistema',
        'heading' => 'Archivos de registro',
        'entries_title' => 'Entradas de registro',
        'back_to_list' => 'Volver a archivos de registro',
        'no_entries' => 'No se encontraron entradas de registro',
        'unsupported_format' => 'Este archivo no parece usar el formato de registro estándar de Laravel',
        'search_placeholder' => 'Buscar entradas de registro...',
        'level_filter' => 'Nivel de registro',
        'email_recipient' => 'Correo del destinatario',
        'email_description' => 'Enviar este archivo de registro como adjunto al destinatario especificado.',
        'bulk_email_description' => 'Enviar los archivos de registro seleccionados como adjuntos individuales al destinatario especificado.',
        'bulk_email_files' => 'Archivos seleccionados',

        'filter' => [
            'date_from' => 'Desde',
            'date_to' => 'Hasta',
        ],

        'column' => [
            'filename' => 'Nombre de archivo',
            'size' => 'Tamaño',
            'modified' => 'Última modificación',
            'subfolder' => 'Subcarpeta',
            'level' => 'Nivel',
            'timestamp' => 'Marca de tiempo',
            'message' => 'Mensaje',
        ],

        'action' => [
            'refresh' => 'Actualizar',
            'view' => 'Ver',
            'delete' => 'Eliminar',
            'download' => 'Descargar',
            'email' => 'Enviar por correo a',
            'email_send' => 'Enviar',
            'email_sent' => 'Archivo de registro enviado por correo con éxito',
            'bulk_email_sent' => ':count archivo(s) de registro enviado(s) por correo con éxito',
            'deleted' => 'Archivo de registro eliminado',
            'bulk_deleted' => ':count archivo(s) de registro eliminado(s)',
        ],

        'confirm' => [
            'delete' => '¿Está seguro de que desea eliminar este archivo de registro? Esta acción no se puede deshacer.',
            'bulk_delete' => '¿Está seguro de que desea eliminar los archivos de registro seleccionados? Esta acción no se puede deshacer.',
        ],

        'entry' => [
            'detail' => 'Detalle de la entrada',
            'line' => 'Línea',
            'trace_frames' => ':count frame|:count frames',
            'copy_trace' => 'Copiar Stack Trace',
            'copy_entry' => 'Copiar entrada completa',
            'copied' => '¡Copiado!',
        ],
    ],

];
