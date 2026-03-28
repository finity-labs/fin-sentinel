<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Настройки',
        'error_channel' => 'Канал за грешки',
        'error_channel_title' => 'Настройки на канала за грешки',
        'debug_channel' => 'Debug канал',
        'debug_channel_title' => 'Настройки на Debug канала',
        'system_logs' => 'Системни журнали',
        'log_files' => 'Журнални файлове',
        'log_entries' => 'Журнални записи',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Авариен',
            'ALERT' => 'Тревога',
            'CRITICAL' => 'Критичен',
            'ERROR' => 'Грешка',
            'WARNING' => 'Предупреждение',
            'NOTICE' => 'Известие',
            'INFO' => 'Информация',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Известие за грешка',
            'debug' => 'Debug',
            'log_file' => 'Журнален файл',
        ],
        'footer' => 'Изпратено от Fin-Sentinel',

        'label' => [
            'error_message' => 'Съобщение за грешка',
            'class' => 'Клас',
            'file' => 'Файл',
            'context' => 'Контекст',
            'command' => 'Команда',
            'url' => 'URL',
            'method' => 'Метод',
            'ip' => 'IP',
            'params' => 'Параметри',
            'headers' => 'Заглавия',
            'name' => 'Име',
            'email' => 'Имейл',
            'id' => 'ID',
            'user' => 'Потребител',
            'environment' => 'Среда',
            'debug_mode' => 'Debug режим',
            'php_version' => 'PHP версия',
            'laravel_version' => 'Laravel версия',
            'laravel' => 'Laravel',
            'peak_memory' => 'Пикова памет',
            'enabled' => 'Включено',
            'disabled' => 'Изключено',
            'relation' => 'Релация: :name',
            'bindings' => 'Връзки:',
            'trace_number' => '#',
            'trace_location' => 'Местоположение',
            'trace_call' => 'Извикване',
        ],

        'collection' => [
            'count' => ':count елемент|:count елемента',
            'more' => '... и още :count елемента',
        ],

        'error' => [
            'subject' => ':app - Възникна грешка',
            'guest' => 'Гост',
            'console' => 'Конзола',
            'section_exception' => 'Детайли на изключението',
            'section_trace' => 'Стеков проследяване',
            'section_request' => 'Контекст на заявката',
            'section_user' => 'Удостоверен потребител',
            'section_environment' => 'Среда',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Гост',
            'console' => 'Конзола',
            'section_data' => 'Debug данни',
            'section_call_site' => 'Място на извикване',
            'section_request' => 'Контекст на заявката',
            'section_environment' => 'Среда',
        ],

        'log_file' => [
            'subject' => ':app - Журнален файл: :file',
            'bulk_subject' => ':app - :count журнални файла прикачени',
            'body' => 'Журналният файл <strong>:file</strong> от :app е прикачен.',
            'body_text' => 'Журналният файл :file от :app е прикачен.',
        ],
    ],

    'settings' => [
        'recipients' => 'Получатели',
        'throttling' => 'Ограничаване',
        'email_address' => 'Имейл адрес',
        'add_recipient' => 'Добавяне на получател',
        'no_recipients_warning' => 'Няма конфигурирани получатели — известията няма да бъдат изпращани, докато не бъде добавен поне един имейл адрес.',
        'throttle_rate' => 'Честота на ограничаване',
        'minutes_suffix' => 'минути',

        'error' => [
            'enabled' => 'Включване на известия за грешки',
            'enabled_helper' => 'При изключване няма да бъдат изпращани имейли за грешки.',
            'recipients_helper' => 'Добавете имейл адреси, които ще получават известия за грешки.',
            'throttle_helper' => 'Минимални минути между дублиращи се имейли за грешки.',
            'throttle_exceptions' => 'Ограничаване на изключения',
            'throttle_exceptions_helper' => 'При включване дублиращите се изключения на същия файл:ред няма да изпращат имейли в рамките на прозореца за ограничаване.',
            'throttle_log_messages' => 'Ограничаване на журнални съобщения',
            'throttle_log_messages_helper' => 'При включване идентичните журнални съобщения за грешки няма да изпращат имейли в рамките на прозореца за ограничаване.',
            'ignored_exceptions' => 'Игнорирани изключения',
            'ignored_exceptions_description' => 'Изключенията в този списък няма да задействат имейл известия.',
            'ignored_exceptions_label' => 'Игнорирани изключения',
            'other_custom' => 'Друго (персонализирано)',
            'exception_class' => 'Клас на изключение (FQCN)',
            'class_not_exist' => 'Този клас не съществува.',
            'custom_exception' => 'Персонализирано изключение',
            'select_exception' => 'Изберете изключение',
            'add_exception' => 'Добавяне на изключение',
        ],

        'debug' => [
            'enabled' => 'Включване на Debug канала',
            'enabled_helper' => 'При изключване извикванията на Sentinel::debug() ще бъдат тихо игнорирани.',
            'recipients_helper' => 'Добавете имейл адреси, които ще получават Debug известия.',
            'throttle_enabled' => 'Включване на ограничаване',
            'throttle_enabled_helper' => 'При изключване всяко debug извикване изпраща имейл. При включване дублиращите се извиквания се ограничават.',
            'throttle_helper' => 'Минимални минути между дублиращи се Debug имейли.',
        ],

        'test_email' => [
            'send' => 'Изпращане на тестов имейл',
            'sent' => 'Тестовият имейл е изпратен до :count получател(и)',
            'no_recipients' => 'Няма конфигурирани получатели. Първо добавете поне един имейл адрес.',
            'failed' => 'Неуспешно изпращане на тестов имейл',
            'channel_disabled' => 'Този канал в момента е изключен. Тестовият имейл все пак ще бъде изпратен.',
        ],
    ],

    'logs' => [
        'title' => 'Системни журнали',
        'heading' => 'Журнални файлове',
        'entries_title' => 'Журнални записи',
        'back_to_list' => 'Обратно към журналните файлове',
        'no_entries' => 'Не са намерени журнални записи',
        'unsupported_format' => 'Този файл изглежда не използва стандартния формат на журнали на Laravel',
        'search_placeholder' => 'Търсене в журналните записи...',
        'level_filter' => 'Ниво на журнала',
        'email_recipient' => 'Имейл на получателя',
        'email_description' => 'Изпращане на този журнален файл като прикачен файл по имейл до посочения получател.',
        'bulk_email_description' => 'Изпращане на избраните журнални файлове като отделни прикачени файлове по имейл до посочения получател.',
        'bulk_email_files' => 'Избрани файлове',

        'filter' => [
            'date_from' => 'От',
            'date_to' => 'До',
        ],

        'column' => [
            'filename' => 'Име на файл',
            'size' => 'Размер',
            'modified' => 'Последна промяна',
            'subfolder' => 'Подпапка',
            'level' => 'Ниво',
            'timestamp' => 'Времеви отпечатък',
            'message' => 'Съобщение',
        ],

        'action' => [
            'refresh' => 'Обновяване',
            'view' => 'Преглед',
            'delete' => 'Изтриване',
            'download' => 'Изтегляне',
            'email' => 'Изпращане по имейл',
            'email_send' => 'Изпращане',
            'email_sent' => 'Журналният файл е изпратен успешно по имейл',
            'bulk_email_sent' => ':count журнален(ни) файл(а) изпратени успешно по имейл',
            'deleted' => 'Журналният файл е изтрит',
            'bulk_deleted' => ':count журнален(ни) файл(а) изтрити',
        ],

        'confirm' => [
            'delete' => 'Сигурни ли сте, че искате да изтриете този журнален файл? Това действие не може да бъде отменено.',
            'bulk_delete' => 'Сигурни ли сте, че искате да изтриете избраните журнални файлове? Това действие не може да бъде отменено.',
        ],

        'entry' => [
            'detail' => 'Детайли на записа',
            'line' => 'Ред',
            'trace_frames' => ':count кадър|:count кадъра',
            'copy_trace' => 'Копиране на стековото проследяване',
            'copy_entry' => 'Копиране на пълния запис',
            'copied' => 'Копирано!',
        ],
    ],

];
