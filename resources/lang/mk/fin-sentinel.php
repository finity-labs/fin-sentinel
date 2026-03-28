<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Поставки',
        'error_channel' => 'Канал за грешки',
        'error_channel_title' => 'Поставки за каналот за грешки',
        'debug_channel' => 'Канал за дебагирање',
        'debug_channel_title' => 'Поставки за каналот за дебагирање',
        'system_logs' => 'Системски логови',
        'log_files' => 'Лог датотеки',
        'log_entries' => 'Записи во логот',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Итно',
            'ALERT' => 'Тревога',
            'CRITICAL' => 'Критично',
            'ERROR' => 'Грешка',
            'WARNING' => 'Предупредување',
            'NOTICE' => 'Известување',
            'INFO' => 'Информација',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Известување за грешка',
            'debug' => 'Debug',
            'log_file' => 'Лог датотека',
        ],
        'footer' => 'Испратено од Fin-Sentinel',

        'label' => [
            'error_message' => 'Порака за грешка',
            'class' => 'Класа',
            'file' => 'Датотека',
            'context' => 'Контекст',
            'command' => 'Команда',
            'url' => 'URL',
            'method' => 'Метод',
            'ip' => 'IP',
            'params' => 'Параметри',
            'headers' => 'Заглавија',
            'name' => 'Име',
            'email' => 'Email',
            'id' => 'ID',
            'user' => 'Корисник',
            'environment' => 'Околина',
            'debug_mode' => 'Debug режим',
            'php_version' => 'PHP верзија',
            'laravel_version' => 'Laravel верзија',
            'laravel' => 'Laravel',
            'peak_memory' => 'Максимална меморија',
            'enabled' => 'Вклучено',
            'disabled' => 'Исклучено',
            'relation' => 'Релација: :name',
            'bindings' => 'Врзувања:',
            'trace_number' => '#',
            'trace_location' => 'Локација',
            'trace_call' => 'Повик',
        ],

        'collection' => [
            'count' => ':count ставка|:count ставки',
            'more' => '... и уште :count ставки',
        ],

        'error' => [
            'subject' => ':app — Настана грешка',
            'guest' => 'Гостин',
            'console' => 'Конзола',
            'section_exception' => 'Детали за исклучокот',
            'section_trace' => 'Стек на повици',
            'section_request' => 'Контекст на барањето',
            'section_user' => 'Автентициран корисник',
            'section_environment' => 'Околина',
        ],

        'debug' => [
            'subject' => ':app — Debug: :subject',
            'guest' => 'Гостин',
            'console' => 'Конзола',
            'section_data' => 'Debug податоци',
            'section_call_site' => 'Место на повикот',
            'section_request' => 'Контекст на барањето',
            'section_environment' => 'Околина',
        ],

        'log_file' => [
            'subject' => ':app — Лог датотека: :file',
            'bulk_subject' => ':app — :count лог датотеки во прилог',
            'body' => 'Лог датотеката <strong>:file</strong> од :app е во прилог.',
            'body_text' => 'Лог датотеката :file од :app е во прилог.',
        ],
    ],

    'settings' => [
        'recipients' => 'Приматели',
        'throttling' => 'Ограничување на честотата',
        'email_address' => 'Email адреса',
        'add_recipient' => 'Додади примач',
        'no_recipients_warning' => 'Нема поставени приматели — известувањата нема да се испраќаат додека не се додаде барем една email адреса.',
        'throttle_rate' => 'Стапка на ограничување',
        'minutes_suffix' => 'минути',

        'error' => [
            'enabled' => 'Вклучи известувања за грешки',
            'enabled_helper' => 'Кога е исклучено, email-ови за грешки нема да се испраќаат.',
            'recipients_helper' => 'Додајте email адреси кои ќе примаат известувања за грешки.',
            'throttle_helper' => 'Минимален интервал во минути помеѓу повторени email-ови за исти грешки.',
            'throttle_exceptions' => 'Ограничување на исклучоци',
            'throttle_exceptions_helper' => 'Кога е вклучено, повторените исклучоци на истата датотека:линија нема да предизвикуваат испраќање email-ови во рамките на прозорецот за ограничување.',
            'throttle_log_messages' => 'Ограничување на пораки од логот',
            'throttle_log_messages_helper' => 'Кога е вклучено, идентичните пораки за грешки во логовите нема да предизвикуваат испраќање email-ови во рамките на прозорецот за ограничување.',
            'ignored_exceptions' => 'Игнорирани исклучоци',
            'ignored_exceptions_description' => 'Исклучоците од оваа листа нема да предизвикуваат испраќање email известувања.',
            'ignored_exceptions_label' => 'Игнорирани исклучоци',
            'other_custom' => 'Друго (произволно)',
            'exception_class' => 'Класа на исклучок (FQCN)',
            'class_not_exist' => 'Оваа класа не постои.',
            'custom_exception' => 'Произволен исклучок',
            'select_exception' => 'Изберете исклучок',
            'add_exception' => 'Додади исклучок',
        ],

        'debug' => [
            'enabled' => 'Вклучи канал за дебагирање',
            'enabled_helper' => 'Кога е исклучено, повиците на Sentinel::debug() ќе бидат игнорирани.',
            'recipients_helper' => 'Додајте email адреси кои ќе примаат известувања за дебагирање.',
            'throttle_enabled' => 'Вклучи ограничување на честотата',
            'throttle_enabled_helper' => 'Кога е исклучено, секој debug повик испраќа email. Кога е вклучено, повторените повици се ограничуваат.',
            'throttle_helper' => 'Минимален интервал во минути помеѓу повторени debug email-ови.',
        ],

        'test_email' => [
            'send' => 'Испрати тест email',
            'sent' => 'Тест email испратен до :count примател(и)',
            'no_recipients' => 'Нема поставени приматели. Прво додајте барем една email адреса.',
            'failed' => 'Испраќањето на тест email-от не успеа',
            'channel_disabled' => 'Овој канал е моментално исклучен. Тест email-от сепак ќе биде испратен.',
        ],
    ],

    'logs' => [
        'title' => 'Системски логови',
        'heading' => 'Лог датотеки',
        'entries_title' => 'Записи во логот',
        'back_to_list' => 'Назад кон лог датотеките',
        'no_entries' => 'Не се пронајдени записи во логот',
        'unsupported_format' => 'Оваа датотека не го користи стандардниот Laravel формат на логови',
        'search_placeholder' => 'Пребарување на записи во логот...',
        'level_filter' => 'Ниво на логот',
        'email_recipient' => 'Email на примателот',
        'email_description' => 'Испратете ја оваа лог датотека како прилог до наведената email адреса.',
        'bulk_email_description' => 'Испратете ги избраните лог датотеки како поединечни прилози до наведената email адреса.',
        'bulk_email_files' => 'Избрани датотеки',

        'filter' => [
            'date_from' => 'Од',
            'date_to' => 'До',
        ],

        'column' => [
            'filename' => 'Име на датотека',
            'size' => 'Големина',
            'modified' => 'Последна промена',
            'subfolder' => 'Подпапка',
            'level' => 'Ниво',
            'timestamp' => 'Време',
            'message' => 'Порака',
        ],

        'action' => [
            'refresh' => 'Освежи',
            'view' => 'Прегледај',
            'delete' => 'Избриши',
            'download' => 'Преземи',
            'email' => 'Испрати до',
            'email_send' => 'Испрати',
            'email_sent' => 'Лог датотеката е успешно испратена',
            'bulk_email_sent' => ':count лог датотека(и) успешно испратени',
            'deleted' => 'Лог датотеката е избришана',
            'bulk_deleted' => ':count лог датотека(и) избришани',
        ],

        'confirm' => [
            'delete' => 'Дали сте сигурни дека сакате да ја избришете оваа лог датотека? Ова дејство не може да се поништи.',
            'bulk_delete' => 'Дали сте сигурни дека сакате да ги избришете избраните лог датотеки? Ова дејство не може да се поништи.',
        ],

        'entry' => [
            'detail' => 'Детали за записот',
            'line' => 'Линија',
            'trace_frames' => ':count фрејм|:count фрејмови',
            'copy_trace' => 'Копирај стек на повици',
            'copy_entry' => 'Копирај цел запис',
            'copied' => 'Копирано!',
        ],
    ],

];
