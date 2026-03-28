<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Настройки',
        'error_channel' => 'Канал ошибок',
        'error_channel_title' => 'Настройки канала ошибок',
        'debug_channel' => 'Канал отладки',
        'debug_channel_title' => 'Настройки канала отладки',
        'system_logs' => 'Системные логи',
        'log_files' => 'Файлы логов',
        'log_entries' => 'Записи логов',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Аварийная',
            'ALERT' => 'Тревога',
            'CRITICAL' => 'Критическая',
            'ERROR' => 'Ошибка',
            'WARNING' => 'Предупреждение',
            'NOTICE' => 'Уведомление',
            'INFO' => 'Информация',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Уведомление об ошибке',
            'debug' => 'Debug',
            'log_file' => 'Файл лога',
        ],
        'footer' => 'Отправлено Fin-Sentinel',

        'label' => [
            'error_message' => 'Сообщение об ошибке',
            'class' => 'Класс',
            'file' => 'Файл',
            'context' => 'Контекст',
            'command' => 'Команда',
            'url' => 'URL',
            'method' => 'Метод',
            'ip' => 'IP',
            'params' => 'Параметры',
            'headers' => 'Заголовки',
            'name' => 'Имя',
            'email' => 'Email',
            'id' => 'ID',
            'user' => 'Пользователь',
            'environment' => 'Окружение',
            'debug_mode' => 'Режим Debug',
            'php_version' => 'Версия PHP',
            'laravel_version' => 'Версия Laravel',
            'laravel' => 'Laravel',
            'peak_memory' => 'Пиковая память',
            'enabled' => 'Включено',
            'disabled' => 'Отключено',
            'relation' => 'Связь: :name',
            'bindings' => 'Привязки:',
            'trace_number' => '#',
            'trace_location' => 'Расположение',
            'trace_call' => 'Вызов',
        ],

        'collection' => [
            'count' => ':count элемент|:count элементов',
            'more' => '... и ещё :count элементов',
        ],

        'error' => [
            'subject' => ':app — Произошла ошибка',
            'guest' => 'Гость',
            'console' => 'Консоль',
            'section_exception' => 'Детали исключения',
            'section_trace' => 'Стек вызовов',
            'section_request' => 'Контекст запроса',
            'section_user' => 'Авторизованный пользователь',
            'section_environment' => 'Окружение',
        ],

        'debug' => [
            'subject' => ':app — Debug: :subject',
            'guest' => 'Гость',
            'console' => 'Консоль',
            'section_data' => 'Данные Debug',
            'section_call_site' => 'Место вызова',
            'section_request' => 'Контекст запроса',
            'section_environment' => 'Окружение',
        ],

        'log_file' => [
            'subject' => ':app — Файл лога: :file',
            'bulk_subject' => ':app — :count файлов логов во вложении',
            'body' => 'Файл лога <strong>:file</strong> из :app во вложении.',
            'body_text' => 'Файл лога :file из :app во вложении.',
        ],
    ],

    'settings' => [
        'recipients' => 'Получатели',
        'throttling' => 'Ограничение частоты',
        'email_address' => 'Адрес электронной почты',
        'add_recipient' => 'Добавить получателя',
        'no_recipients_warning' => 'Получатели не настроены — уведомления не будут отправляться, пока не будет добавлен хотя бы один адрес.',
        'throttle_rate' => 'Частота ограничения',
        'minutes_suffix' => 'минут',

        'error' => [
            'enabled' => 'Включить уведомления об ошибках',
            'enabled_helper' => 'Если отключено, письма об ошибках отправляться не будут.',
            'recipients_helper' => 'Добавьте адреса электронной почты для получения уведомлений об ошибках.',
            'throttle_helper' => 'Минимальный интервал в минутах между повторными письмами об одинаковых ошибках.',
            'throttle_exceptions' => 'Ограничение исключений',
            'throttle_exceptions_helper' => 'Если включено, повторные исключения в одном и том же файле:строке не будут вызывать отправку писем в пределах окна ограничения.',
            'throttle_log_messages' => 'Ограничение сообщений логов',
            'throttle_log_messages_helper' => 'Если включено, идентичные сообщения об ошибках в логах не будут вызывать отправку писем в пределах окна ограничения.',
            'ignored_exceptions' => 'Игнорируемые исключения',
            'ignored_exceptions_description' => 'Исключения из этого списка не будут вызывать отправку уведомлений по электронной почте.',
            'ignored_exceptions_label' => 'Игнорируемые исключения',
            'other_custom' => 'Другое (произвольное)',
            'exception_class' => 'Класс исключения (FQCN)',
            'class_not_exist' => 'Этот класс не существует.',
            'custom_exception' => 'Произвольное исключение',
            'select_exception' => 'Выберите исключение',
            'add_exception' => 'Добавить исключение',
        ],

        'debug' => [
            'enabled' => 'Включить канал отладки',
            'enabled_helper' => 'Если отключено, вызовы Sentinel::debug() будут игнорироваться.',
            'recipients_helper' => 'Добавьте адреса электронной почты для получения отладочных уведомлений.',
            'throttle_enabled' => 'Включить ограничение частоты',
            'throttle_enabled_helper' => 'Если отключено, каждый вызов отладки отправляет письмо. Если включено, повторные вызовы ограничиваются.',
            'throttle_helper' => 'Минимальный интервал в минутах между повторными отладочными письмами.',
        ],

        'test_email' => [
            'send' => 'Отправить тестовое письмо',
            'sent' => 'Тестовое письмо отправлено :count получателю(ям)',
            'no_recipients' => 'Получатели не настроены. Сначала добавьте хотя бы один адрес электронной почты.',
            'failed' => 'Не удалось отправить тестовое письмо',
            'channel_disabled' => 'Этот канал сейчас отключен. Тестовое письмо всё равно будет отправлено.',
        ],
    ],

    'logs' => [
        'title' => 'Системные логи',
        'heading' => 'Файлы логов',
        'entries_title' => 'Записи логов',
        'back_to_list' => 'Назад к файлам логов',
        'no_entries' => 'Записи логов не найдены',
        'unsupported_format' => 'Этот файл не использует стандартный формат логов Laravel',
        'search_placeholder' => 'Поиск по записям логов...',
        'level_filter' => 'Уровень лога',
        'email_recipient' => 'Email получателя',
        'email_description' => 'Отправить этот файл лога как вложение на указанный адрес.',
        'bulk_email_description' => 'Отправить выбранные файлы логов как отдельные вложения на указанный адрес.',
        'bulk_email_files' => 'Выбранные файлы',

        'filter' => [
            'date_from' => 'С',
            'date_to' => 'По',
        ],

        'column' => [
            'filename' => 'Имя файла',
            'size' => 'Размер',
            'modified' => 'Последнее изменение',
            'subfolder' => 'Подпапка',
            'level' => 'Уровень',
            'timestamp' => 'Время',
            'message' => 'Сообщение',
        ],

        'action' => [
            'refresh' => 'Обновить',
            'view' => 'Просмотр',
            'delete' => 'Удалить',
            'download' => 'Скачать',
            'email' => 'Отправить на',
            'email_send' => 'Отправить',
            'email_sent' => 'Файл лога успешно отправлен',
            'bulk_email_sent' => ':count файл(ов) логов успешно отправлено',
            'deleted' => 'Файл лога удалён',
            'bulk_deleted' => ':count файл(ов) логов удалено',
        ],

        'confirm' => [
            'delete' => 'Вы уверены, что хотите удалить этот файл лога? Это действие необратимо.',
            'bulk_delete' => 'Вы уверены, что хотите удалить выбранные файлы логов? Это действие необратимо.',
        ],

        'entry' => [
            'detail' => 'Детали записи',
            'line' => 'Строка',
            'trace_frames' => ':count фрейм|:count фреймов',
            'copy_trace' => 'Копировать стек вызовов',
            'copy_entry' => 'Копировать всю запись',
            'copied' => 'Скопировано!',
        ],
    ],

];
