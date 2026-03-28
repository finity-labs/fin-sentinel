<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Тохиргоо',
        'error_channel' => 'Алдааны суваг',
        'error_channel_title' => 'Алдааны сувгийн тохиргоо',
        'debug_channel' => 'Debug суваг',
        'debug_channel_title' => 'Debug сувгийн тохиргоо',
        'system_logs' => 'Системийн лог',
        'log_files' => 'Лог файлууд',
        'log_entries' => 'Лог бичилтүүд',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Яаралтай',
            'ALERT' => 'Анхааруулга',
            'CRITICAL' => 'Ноцтой',
            'ERROR' => 'Алдаа',
            'WARNING' => 'Сэрэмжлүүлэг',
            'NOTICE' => 'Мэдэгдэл',
            'INFO' => 'Мэдээлэл',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Алдааны мэдэгдэл',
            'debug' => 'Debug',
            'log_file' => 'Лог файл',
        ],
        'footer' => 'Fin-Sentinel-ээс илгээсэн',

        'label' => [
            'error_message' => 'Алдааны мэдэгдэл',
            'class' => 'Класс',
            'file' => 'Файл',
            'context' => 'Контекст',
            'command' => 'Команд',
            'url' => 'URL',
            'method' => 'Метод',
            'ip' => 'IP',
            'params' => 'Параметрүүд',
            'headers' => 'Толгой хэсгүүд',
            'name' => 'Нэр',
            'email' => 'Имэйл',
            'id' => 'ID',
            'user' => 'Хэрэглэгч',
            'environment' => 'Орчин',
            'debug_mode' => 'Debug горим',
            'php_version' => 'PHP хувилбар',
            'laravel_version' => 'Laravel хувилбар',
            'laravel' => 'Laravel',
            'peak_memory' => 'Дээд санах ой',
            'enabled' => 'Идэвхтэй',
            'disabled' => 'Идэвхгүй',
            'relation' => 'Холбоо: :name',
            'bindings' => 'Холболтууд:',
            'trace_number' => '#',
            'trace_location' => 'Байршил',
            'trace_call' => 'Дуудлага',
        ],

        'collection' => [
            'count' => ':count зүйл|:count зүйл',
            'more' => '... ба нэмж :count зүйл',
        ],

        'error' => [
            'subject' => ':app - Алдаа гарлаа',
            'guest' => 'Зочин',
            'console' => 'Консол',
            'section_exception' => 'Онцгой тохиолдлын дэлгэрэнгүй',
            'section_trace' => 'Стек трэйс',
            'section_request' => 'Хүсэлтийн контекст',
            'section_user' => 'Нэвтэрсэн хэрэглэгч',
            'section_environment' => 'Орчин',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Зочин',
            'console' => 'Консол',
            'section_data' => 'Debug өгөгдөл',
            'section_call_site' => 'Дуудлагын байршил',
            'section_request' => 'Хүсэлтийн контекст',
            'section_environment' => 'Орчин',
        ],

        'log_file' => [
            'subject' => ':app - Лог файл: :file',
            'bulk_subject' => ':app - :count лог файл хавсаргасан',
            'body' => ':app-ын лог файл <strong>:file</strong> хавсаргасан байна.',
            'body_text' => ':app-ын лог файл :file хавсаргасан байна.',
        ],
    ],

    'settings' => [
        'recipients' => 'Хүлээн авагчид',
        'throttling' => 'Хязгаарлалт',
        'email_address' => 'Имэйл хаяг',
        'add_recipient' => 'Хүлээн авагч нэмэх',
        'no_recipients_warning' => 'Хүлээн авагч тохируулаагүй байна — хамгийн багадаа нэг имэйл нэмэх хүртэл мэдэгдэл илгээгдэхгүй.',
        'throttle_rate' => 'Хязгаарлах хурд',
        'minutes_suffix' => 'минут',

        'error' => [
            'enabled' => 'Алдааны мэдэгдэл идэвхжүүлэх',
            'enabled_helper' => 'Идэвхгүй үед алдааны имэйл илгээгдэхгүй.',
            'recipients_helper' => 'Алдааны мэдэгдэл хүлээн авах имэйл хаягуудыг нэмнэ үү.',
            'throttle_helper' => 'Давхардсан алдааны имэйлүүдийн хоорондох хамгийн бага минут.',
            'throttle_exceptions' => 'Онцгой тохиолдлын хязгаарлалт',
            'throttle_exceptions_helper' => 'Идэвхтэй үед ижил file:line дахь давхардсан онцгой тохиолдлууд хязгаарлалтын цонхонд имэйл илгээхгүй.',
            'throttle_log_messages' => 'Лог мэдэгдлийн хязгаарлалт',
            'throttle_log_messages_helper' => 'Идэвхтэй үед ижил алдааны лог мэдэгдлүүд хязгаарлалтын цонхонд имэйл илгээхгүй.',
            'ignored_exceptions' => 'Үл тоомсорлох онцгой тохиолдлууд',
            'ignored_exceptions_description' => 'Энэ жагсаалтад байгаа онцгой тохиолдлууд имэйл мэдэгдэл илгээхгүй.',
            'ignored_exceptions_label' => 'Үл тоомсорлох онцгой тохиолдлууд',
            'other_custom' => 'Бусад (тусгай)',
            'exception_class' => 'Онцгой тохиолдлын класс (FQCN)',
            'class_not_exist' => 'Энэ класс байхгүй байна.',
            'custom_exception' => 'Тусгай онцгой тохиолдол',
            'select_exception' => 'Онцгой тохиолдол сонгох',
            'add_exception' => 'Үл хамаарах зүйл нэмэх',
        ],

        'debug' => [
            'enabled' => 'Debug суваг идэвхжүүлэх',
            'enabled_helper' => 'Идэвхгүй үед Sentinel::debug() дуудлагууд чимээгүй үл тоомсорлогдоно.',
            'recipients_helper' => 'Debug мэдэгдэл хүлээн авах имэйл хаягуудыг нэмнэ үү.',
            'throttle_enabled' => 'Хязгаарлалт идэвхжүүлэх',
            'throttle_enabled_helper' => 'Идэвхгүй үед Debug дуудлага бүр имэйл илгээнэ. Идэвхтэй үед давхардсан дуудлагуудыг хязгаарлана.',
            'throttle_helper' => 'Давхардсан Debug имэйлүүдийн хоорондох хамгийн бага минут.',
        ],

        'test_email' => [
            'send' => 'Туршилтын имэйл илгээх',
            'sent' => ':count хүлээн авагчид туршилтын имэйл илгээсэн',
            'no_recipients' => 'Хүлээн авагч тохируулаагүй байна. Эхлээд хамгийн багадаа нэг имэйл хаяг нэмнэ үү.',
            'failed' => 'Туршилтын имэйл илгээж чадсангүй',
            'channel_disabled' => 'Энэ суваг одоогоор идэвхгүй байна. Туршилтын имэйл илгээгдэх болно.',
        ],
    ],

    'logs' => [
        'title' => 'Системийн лог',
        'heading' => 'Лог файлууд',
        'entries_title' => 'Лог бичилтүүд',
        'back_to_list' => 'Лог файлууд руу буцах',
        'no_entries' => 'Лог бичилт олдсонгүй',
        'unsupported_format' => 'Энэ файл стандарт Laravel лог формат ашиглаагүй бололтой',
        'search_placeholder' => 'Лог бичилтүүд хайх...',
        'level_filter' => 'Лог түвшин',
        'email_recipient' => 'Хүлээн авагчийн имэйл',
        'email_description' => 'Энэ лог файлыг заасан хүлээн авагчид имэйл хавсралт болгон илгээх.',
        'bulk_email_description' => 'Сонгосон лог файлуудыг заасан хүлээн авагчид тус тусад нь имэйл хавсралт болгон илгээх.',
        'bulk_email_files' => 'Сонгосон файлууд',

        'filter' => [
            'date_from' => 'Эхлэх',
            'date_to' => 'Дуусах',
        ],

        'column' => [
            'filename' => 'Файлын нэр',
            'size' => 'Хэмжээ',
            'modified' => 'Сүүлд өөрчлөгдсөн',
            'subfolder' => 'Дэд хавтас',
            'level' => 'Түвшин',
            'timestamp' => 'Цагийн тэмдэг',
            'message' => 'Мэдэгдэл',
        ],

        'action' => [
            'refresh' => 'Шинэчлэх',
            'view' => 'Харах',
            'delete' => 'Устгах',
            'download' => 'Татах',
            'email' => 'Имэйл илгээх',
            'email_send' => 'Илгээх',
            'email_sent' => 'Лог файл амжилттай имэйлээр илгээгдсэн',
            'bulk_email_sent' => ':count лог файл амжилттай имэйлээр илгээгдсэн',
            'deleted' => 'Лог файл устгагдсан',
            'bulk_deleted' => ':count лог файл устгагдсан',
        ],

        'confirm' => [
            'delete' => 'Энэ лог файлыг устгахдаа итгэлтэй байна уу? Энэ үйлдлийг буцаах боломжгүй.',
            'bulk_delete' => 'Сонгосон лог файлуудыг устгахдаа итгэлтэй байна уу? Энэ үйлдлийг буцаах боломжгүй.',
        ],

        'entry' => [
            'detail' => 'Бичилтийн дэлгэрэнгүй',
            'line' => 'Мөр',
            'trace_frames' => ':count фрэйм|:count фрэйм',
            'copy_trace' => 'Стек трэйс хуулах',
            'copy_entry' => 'Бүтэн бичилт хуулах',
            'copied' => 'Хуулагдсан!',
        ],
    ],

];
