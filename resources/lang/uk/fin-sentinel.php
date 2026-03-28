<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Налаштування',
        'error_channel' => 'Канал помилок',
        'error_channel_title' => 'Налаштування каналу помилок',
        'debug_channel' => 'Канал відлагодження',
        'debug_channel_title' => 'Налаштування каналу відлагодження',
        'system_logs' => 'Системні логи',
        'log_files' => 'Файли логів',
        'log_entries' => 'Записи логів',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Аварійна',
            'ALERT' => 'Тривога',
            'CRITICAL' => 'Критична',
            'ERROR' => 'Помилка',
            'WARNING' => 'Попередження',
            'NOTICE' => 'Сповіщення',
            'INFO' => 'Інформація',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Сповіщення про помилку',
            'debug' => 'Debug',
            'log_file' => 'Файл логу',
        ],
        'footer' => 'Надіслано Fin-Sentinel',

        'label' => [
            'error_message' => 'Повідомлення про помилку',
            'class' => 'Клас',
            'file' => 'Файл',
            'context' => 'Контекст',
            'command' => 'Команда',
            'url' => 'URL',
            'method' => 'Метод',
            'ip' => 'IP',
            'params' => 'Параметри',
            'headers' => 'Заголовки',
            'name' => 'Ім\'я',
            'email' => 'Email',
            'id' => 'ID',
            'user' => 'Користувач',
            'environment' => 'Середовище',
            'debug_mode' => 'Режим Debug',
            'php_version' => 'Версія PHP',
            'laravel_version' => 'Версія Laravel',
            'laravel' => 'Laravel',
            'peak_memory' => 'Пікова пам\'ять',
            'enabled' => 'Увімкнено',
            'disabled' => 'Вимкнено',
            'relation' => 'Зв\'язок: :name',
            'bindings' => 'Прив\'язки:',
            'trace_number' => '#',
            'trace_location' => 'Розташування',
            'trace_call' => 'Виклик',
        ],

        'collection' => [
            'count' => ':count елемент|:count елементів',
            'more' => '... та ще :count елементів',
        ],

        'error' => [
            'subject' => ':app — Сталася помилка',
            'guest' => 'Гість',
            'console' => 'Консоль',
            'section_exception' => 'Деталі винятку',
            'section_trace' => 'Стек викликів',
            'section_request' => 'Контекст запиту',
            'section_user' => 'Автентифікований користувач',
            'section_environment' => 'Середовище',
        ],

        'debug' => [
            'subject' => ':app — Debug: :subject',
            'guest' => 'Гість',
            'console' => 'Консоль',
            'section_data' => 'Дані Debug',
            'section_call_site' => 'Місце виклику',
            'section_request' => 'Контекст запиту',
            'section_environment' => 'Середовище',
        ],

        'log_file' => [
            'subject' => ':app — Файл логу: :file',
            'bulk_subject' => ':app — :count файлів логів у вкладенні',
            'body' => 'Файл логу <strong>:file</strong> з :app у вкладенні.',
            'body_text' => 'Файл логу :file з :app у вкладенні.',
        ],
    ],

    'settings' => [
        'recipients' => 'Отримувачі',
        'throttling' => 'Обмеження частоти',
        'email_address' => 'Адреса електронної пошти',
        'add_recipient' => 'Додати одержувача',
        'no_recipients_warning' => 'Отримувачів не налаштовано — сповіщення не надсилатимуться, поки не буде додано принаймні одну адресу.',
        'throttle_rate' => 'Частота обмеження',
        'minutes_suffix' => 'хвилин',

        'error' => [
            'enabled' => 'Увімкнути сповіщення про помилки',
            'enabled_helper' => 'Якщо вимкнено, листи про помилки не надсилатимуться.',
            'recipients_helper' => 'Додайте адреси електронної пошти для отримання сповіщень про помилки.',
            'throttle_helper' => 'Мінімальний інтервал у хвилинах між повторними листами про однакові помилки.',
            'throttle_exceptions' => 'Обмеження винятків',
            'throttle_exceptions_helper' => 'Якщо увімкнено, повторні винятки в одному файлі:рядку не спричинятимуть надсилання листів у межах вікна обмеження.',
            'throttle_log_messages' => 'Обмеження повідомлень логів',
            'throttle_log_messages_helper' => 'Якщо увімкнено, ідентичні повідомлення про помилки в логах не спричинятимуть надсилання листів у межах вікна обмеження.',
            'ignored_exceptions' => 'Ігноровані винятки',
            'ignored_exceptions_description' => 'Винятки з цього списку не спричинятимуть надсилання сповіщень електронною поштою.',
            'ignored_exceptions_label' => 'Ігноровані винятки',
            'other_custom' => 'Інше (довільне)',
            'exception_class' => 'Клас винятку (FQCN)',
            'class_not_exist' => 'Цей клас не існує.',
            'custom_exception' => 'Довільний виняток',
            'select_exception' => 'Оберіть виняток',
            'add_exception' => 'Додати виняток',
        ],

        'debug' => [
            'enabled' => 'Увімкнути канал відлагодження',
            'enabled_helper' => 'Якщо вимкнено, виклики Sentinel::debug() будуть ігноруватися.',
            'recipients_helper' => 'Додайте адреси електронної пошти для отримання сповіщень відлагодження.',
            'throttle_enabled' => 'Увімкнути обмеження частоти',
            'throttle_enabled_helper' => 'Якщо вимкнено, кожен виклик відлагодження надсилає лист. Якщо увімкнено, повторні виклики обмежуються.',
            'throttle_helper' => 'Мінімальний інтервал у хвилинах між повторними листами відлагодження.',
        ],

        'test_email' => [
            'send' => 'Надіслати тестовий лист',
            'sent' => 'Тестовий лист надіслано :count отримувачу(ам)',
            'no_recipients' => 'Отримувачів не налаштовано. Спочатку додайте принаймні одну адресу електронної пошти.',
            'failed' => 'Не вдалося надіслати тестовий лист',
            'channel_disabled' => 'Цей канал зараз вимкнено. Тестовий лист все одно буде надіслано.',
        ],
    ],

    'logs' => [
        'title' => 'Системні логи',
        'heading' => 'Файли логів',
        'entries_title' => 'Записи логів',
        'back_to_list' => 'Назад до файлів логів',
        'no_entries' => 'Записи логів не знайдено',
        'unsupported_format' => 'Цей файл не використовує стандартний формат логів Laravel',
        'search_placeholder' => 'Пошук по записах логів...',
        'level_filter' => 'Рівень логу',
        'email_recipient' => 'Email отримувача',
        'email_description' => 'Надіслати цей файл логу як вкладення на вказану адресу.',
        'bulk_email_description' => 'Надіслати обрані файли логів як окремі вкладення на вказану адресу.',
        'bulk_email_files' => 'Обрані файли',

        'filter' => [
            'date_from' => 'З',
            'date_to' => 'По',
        ],

        'column' => [
            'filename' => 'Ім\'я файлу',
            'size' => 'Розмір',
            'modified' => 'Остання зміна',
            'subfolder' => 'Підтека',
            'level' => 'Рівень',
            'timestamp' => 'Час',
            'message' => 'Повідомлення',
        ],

        'action' => [
            'refresh' => 'Оновити',
            'view' => 'Переглянути',
            'delete' => 'Видалити',
            'download' => 'Завантажити',
            'email' => 'Надіслати на',
            'email_send' => 'Надіслати',
            'email_sent' => 'Файл логу успішно надіслано',
            'bulk_email_sent' => ':count файл(ів) логів успішно надіслано',
            'deleted' => 'Файл логу видалено',
            'bulk_deleted' => ':count файл(ів) логів видалено',
        ],

        'confirm' => [
            'delete' => 'Ви впевнені, що хочете видалити цей файл логу? Цю дію неможливо скасувати.',
            'bulk_delete' => 'Ви впевнені, що хочете видалити обрані файли логів? Цю дію неможливо скасувати.',
        ],

        'entry' => [
            'detail' => 'Деталі запису',
            'line' => 'Рядок',
            'trace_frames' => ':count фрейм|:count фреймів',
            'copy_trace' => 'Копіювати стек викликів',
            'copy_entry' => 'Копіювати весь запис',
            'copied' => 'Скопійовано!',
        ],
    ],

];
