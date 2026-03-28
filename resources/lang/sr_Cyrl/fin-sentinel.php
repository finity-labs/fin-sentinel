<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Подешавања',
        'error_channel' => 'Канал грешака',
        'error_channel_title' => 'Подешавања канала грешака',
        'debug_channel' => 'Канал за отклањање грешака',
        'debug_channel_title' => 'Подешавања канала за отклањање грешака',
        'system_logs' => 'Системски логови',
        'log_files' => 'Лог фајлови',
        'log_entries' => 'Записи у логу',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Хитно',
            'ALERT' => 'Узбуна',
            'CRITICAL' => 'Критично',
            'ERROR' => 'Грешка',
            'WARNING' => 'Упозорење',
            'NOTICE' => 'Обавештење',
            'INFO' => 'Информација',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Обавештење о грешци',
            'debug' => 'Debug',
            'log_file' => 'Лог фајл',
        ],
        'footer' => 'Послато од стране Fin-Sentinel',

        'label' => [
            'error_message' => 'Порука о грешци',
            'class' => 'Класа',
            'file' => 'Фајл',
            'context' => 'Контекст',
            'command' => 'Команда',
            'url' => 'URL',
            'method' => 'Метод',
            'ip' => 'IP',
            'params' => 'Параметри',
            'headers' => 'Заглавља',
            'name' => 'Име',
            'email' => 'Email',
            'id' => 'ID',
            'user' => 'Корисник',
            'environment' => 'Окружење',
            'debug_mode' => 'Debug режим',
            'php_version' => 'PHP верзија',
            'laravel_version' => 'Laravel верзија',
            'laravel' => 'Laravel',
            'peak_memory' => 'Максимална меморија',
            'enabled' => 'Укључено',
            'disabled' => 'Искључено',
            'relation' => 'Релација: :name',
            'bindings' => 'Везивања:',
            'trace_number' => '#',
            'trace_location' => 'Локација',
            'trace_call' => 'Позив',
        ],

        'collection' => [
            'count' => ':count ставка|:count ставки',
            'more' => '... и још :count ставки',
        ],

        'error' => [
            'subject' => ':app — Дошло је до грешке',
            'guest' => 'Гост',
            'console' => 'Конзола',
            'section_exception' => 'Детаљи изузетка',
            'section_trace' => 'Стек позива',
            'section_request' => 'Контекст захтева',
            'section_user' => 'Аутентификовани корисник',
            'section_environment' => 'Окружење',
        ],

        'debug' => [
            'subject' => ':app — Debug: :subject',
            'guest' => 'Гост',
            'console' => 'Конзола',
            'section_data' => 'Debug подаци',
            'section_call_site' => 'Место позива',
            'section_request' => 'Контекст захтева',
            'section_environment' => 'Окружење',
        ],

        'log_file' => [
            'subject' => ':app — Лог фајл: :file',
            'bulk_subject' => ':app — :count лог фајлова у прилогу',
            'body' => 'Лог фајл <strong>:file</strong> из :app је у прилогу.',
            'body_text' => 'Лог фајл :file из :app је у прилогу.',
        ],
    ],

    'settings' => [
        'recipients' => 'Примаоци',
        'throttling' => 'Ограничавање учесталости',
        'email_address' => 'Email адреса',
        'add_recipient' => 'Додај примаоца',
        'no_recipients_warning' => 'Примаоци нису подешени — обавештења неће бити слата док се не дода бар једна email адреса.',
        'throttle_rate' => 'Стопа ограничавања',
        'minutes_suffix' => 'минута',

        'error' => [
            'enabled' => 'Укључи обавештења о грешкама',
            'enabled_helper' => 'Ако је искључено, email-ови о грешкама неће бити слати.',
            'recipients_helper' => 'Додајте email адресе које ће примати обавештења о грешкама.',
            'throttle_helper' => 'Минимални интервал у минутима између поновљених email-ова о истим грешкама.',
            'throttle_exceptions' => 'Ограничавање изузетака',
            'throttle_exceptions_helper' => 'Ако је укључено, поновљени изузеци на истом фајл:линија неће покретати слање email-ова у оквиру прозора ограничавања.',
            'throttle_log_messages' => 'Ограничавање порука логова',
            'throttle_log_messages_helper' => 'Ако је укључено, идентичне поруке о грешкама у логовима неће покретати слање email-ова у оквиру прозора ограничавања.',
            'ignored_exceptions' => 'Игнорисани изузеци',
            'ignored_exceptions_description' => 'Изузеци са ове листе неће покретати слање email обавештења.',
            'ignored_exceptions_label' => 'Игнорисани изузеци',
            'other_custom' => 'Друго (произвољно)',
            'exception_class' => 'Класа изузетка (FQCN)',
            'class_not_exist' => 'Ова класа не постоји.',
            'custom_exception' => 'Произвољни изузетак',
            'select_exception' => 'Изаберите изузетак',
            'add_exception' => 'Додај изузетак',
        ],

        'debug' => [
            'enabled' => 'Укључи канал за отклањање грешака',
            'enabled_helper' => 'Ако је искључено, позиви Sentinel::debug() ће бити игнорисани.',
            'recipients_helper' => 'Додајте email адресе које ће примати обавештења о отклањању грешака.',
            'throttle_enabled' => 'Укључи ограничавање учесталости',
            'throttle_enabled_helper' => 'Ако је искључено, сваки debug позив шаље email. Ако је укључено, поновљени позиви се ограничавају.',
            'throttle_helper' => 'Минимални интервал у минутима између поновљених debug email-ова.',
        ],

        'test_email' => [
            'send' => 'Пошаљи тест email',
            'sent' => 'Тест email послат на :count примаоца',
            'no_recipients' => 'Примаоци нису подешени. Прво додајте бар једну email адресу.',
            'failed' => 'Слање тест email-а није успело',
            'channel_disabled' => 'Овај канал је тренутно искључен. Тест email ће ипак бити послат.',
        ],
    ],

    'logs' => [
        'title' => 'Системски логови',
        'heading' => 'Лог фајлови',
        'entries_title' => 'Записи у логу',
        'back_to_list' => 'Назад на лог фајлове',
        'no_entries' => 'Записи у логу нису пронађени',
        'unsupported_format' => 'Овај фајл не користи стандардни Laravel формат логова',
        'search_placeholder' => 'Претрага записа у логу...',
        'level_filter' => 'Ниво лога',
        'email_recipient' => 'Email примаоца',
        'email_description' => 'Пошаљите овај лог фајл као прилог на наведену email адресу.',
        'bulk_email_description' => 'Пошаљите изабране лог фајлове као појединачне прилоге на наведену email адресу.',
        'bulk_email_files' => 'Изабрани фајлови',

        'filter' => [
            'date_from' => 'Од',
            'date_to' => 'До',
        ],

        'column' => [
            'filename' => 'Назив фајла',
            'size' => 'Величина',
            'modified' => 'Последња измена',
            'subfolder' => 'Подфолдер',
            'level' => 'Ниво',
            'timestamp' => 'Време',
            'message' => 'Порука',
        ],

        'action' => [
            'refresh' => 'Освежи',
            'view' => 'Прегледај',
            'delete' => 'Обриши',
            'download' => 'Преузми',
            'email' => 'Пошаљи на',
            'email_send' => 'Пошаљи',
            'email_sent' => 'Лог фајл успешно послат',
            'bulk_email_sent' => ':count лог фајл(ова) успешно послато',
            'deleted' => 'Лог фајл обрисан',
            'bulk_deleted' => ':count лог фајл(ова) обрисано',
        ],

        'confirm' => [
            'delete' => 'Да ли сте сигурни да желите да обришете овај лог фајл? Ова радња се не може поништити.',
            'bulk_delete' => 'Да ли сте сигурни да желите да обришете изабране лог фајлове? Ова радња се не може поништити.',
        ],

        'entry' => [
            'detail' => 'Детаљи записа',
            'line' => 'Линија',
            'trace_frames' => ':count фрејм|:count фрејмова',
            'copy_trace' => 'Копирај стек позива',
            'copy_entry' => 'Копирај цео запис',
            'copied' => 'Копирано!',
        ],
    ],

];
