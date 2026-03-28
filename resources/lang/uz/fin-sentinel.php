<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Sozlamalar',
        'error_channel' => 'Xatolik kanali',
        'error_channel_title' => 'Xatolik kanali sozlamalari',
        'debug_channel' => 'Debug kanali',
        'debug_channel_title' => 'Debug kanali sozlamalari',
        'system_logs' => 'Tizim jurnallari',
        'log_files' => 'Jurnal fayllari',
        'log_entries' => 'Jurnal yozuvlari',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Favqulodda',
            'ALERT' => 'Ogohlantirish',
            'CRITICAL' => 'Jiddiy',
            'ERROR' => 'Xatolik',
            'WARNING' => 'Ogohlantirish',
            'NOTICE' => 'Eslatma',
            'INFO' => 'Ma\'lumot',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Xatolik xabarnomasi',
            'debug' => 'Debug',
            'log_file' => 'Jurnal fayli',
        ],
        'footer' => 'Fin-Sentinel tomonidan yuborilgan',

        'label' => [
            'error_message' => 'Xatolik xabari',
            'class' => 'Klass',
            'file' => 'Fayl',
            'context' => 'Kontekst',
            'command' => 'Buyruq',
            'url' => 'URL',
            'method' => 'Usul',
            'ip' => 'IP',
            'params' => 'Parametrlar',
            'headers' => 'Sarlavhalar',
            'name' => 'Ism',
            'email' => 'Elektron pochta',
            'id' => 'ID',
            'user' => 'Foydalanuvchi',
            'environment' => 'Muhit',
            'debug_mode' => 'Debug rejimi',
            'php_version' => 'PHP versiyasi',
            'laravel_version' => 'Laravel versiyasi',
            'laravel' => 'Laravel',
            'peak_memory' => 'Eng yuqori xotira',
            'enabled' => 'Yoqilgan',
            'disabled' => 'O\'chirilgan',
            'relation' => 'Bog\'lanish: :name',
            'bindings' => 'Bog\'lanishlar:',
            'trace_number' => '#',
            'trace_location' => 'Joylashuv',
            'trace_call' => 'Chaqiruv',
        ],

        'collection' => [
            'count' => ':count element|:count elementlar',
            'more' => '... va yana :count element',
        ],

        'error' => [
            'subject' => ':app - Xatolik yuz berdi',
            'guest' => 'Mehmon',
            'console' => 'Konsol',
            'section_exception' => 'Istisno tafsilotlari',
            'section_trace' => 'Stek izi',
            'section_request' => 'So\'rov konteksti',
            'section_user' => 'Tasdiqlangan foydalanuvchi',
            'section_environment' => 'Muhit',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Mehmon',
            'console' => 'Konsol',
            'section_data' => 'Debug ma\'lumotlari',
            'section_call_site' => 'Chaqiruv joyi',
            'section_request' => 'So\'rov konteksti',
            'section_environment' => 'Muhit',
        ],

        'log_file' => [
            'subject' => ':app - Jurnal fayli: :file',
            'bulk_subject' => ':app - :count jurnal fayli biriktirilgan',
            'body' => ':app dan jurnal fayli <strong>:file</strong> biriktirilgan.',
            'body_text' => ':app dan jurnal fayli :file biriktirilgan.',
        ],
    ],

    'settings' => [
        'recipients' => 'Qabul qiluvchilar',
        'throttling' => 'Cheklash',
        'email_address' => 'Elektron pochta manzili',
        'add_recipient' => 'Qabul qiluvchi qo\'shish',
        'no_recipients_warning' => 'Qabul qiluvchilar sozlanmagan — kamida bitta elektron pochta qo\'shilmaguncha xabarnomalar yuborilmaydi.',
        'throttle_rate' => 'Cheklash tezligi',
        'minutes_suffix' => 'daqiqa',

        'error' => [
            'enabled' => 'Xatolik xabarnomalarini yoqish',
            'enabled_helper' => 'O\'chirilganda, xatolik elektron pochtalari yuborilmaydi.',
            'recipients_helper' => 'Xatolik xabarnomalarini qabul qiladigan elektron pochta manzillarini qo\'shing.',
            'throttle_helper' => 'Takroriy xatolik elektron pochtalari orasidagi minimal daqiqalar.',
            'throttle_exceptions' => 'Istisno cheklash',
            'throttle_exceptions_helper' => 'Yoqilganda, bir xil file:line dagi takroriy istisnolar cheklash oynasida elektron pochta yuborilmaydi.',
            'throttle_log_messages' => 'Jurnal xabarlari cheklash',
            'throttle_log_messages_helper' => 'Yoqilganda, bir xil xatolik jurnal xabarlari cheklash oynasida elektron pochta yuborilmaydi.',
            'ignored_exceptions' => 'E\'tiborsiz qoldirilgan istisnolar',
            'ignored_exceptions_description' => 'Bu ro\'yxatdagi istisnolar elektron pochta xabarnomalarini ishga tushirmaydi.',
            'ignored_exceptions_label' => 'E\'tiborsiz qoldirilgan istisnolar',
            'other_custom' => 'Boshqa (maxsus)',
            'exception_class' => 'Istisno klassi (FQCN)',
            'class_not_exist' => 'Bu klass mavjud emas.',
            'custom_exception' => 'Maxsus istisno',
            'select_exception' => 'Istisno tanlang',
            'add_exception' => 'Istisno qo\'shish',
        ],

        'debug' => [
            'enabled' => 'Debug kanalini yoqish',
            'enabled_helper' => 'O\'chirilganda, Sentinel::debug() chaqiruvlari jimgina e\'tiborsiz qoldiriladi.',
            'recipients_helper' => 'Debug xabarnomalarini qabul qiladigan elektron pochta manzillarini qo\'shing.',
            'throttle_enabled' => 'Cheklashni yoqish',
            'throttle_enabled_helper' => 'O\'chirilganda, har bir Debug chaqiruv elektron pochta yuboradi. Yoqilganda, takroriy chaqiruvlar cheklanadi.',
            'throttle_helper' => 'Takroriy Debug elektron pochtalari orasidagi minimal daqiqalar.',
        ],

        'test_email' => [
            'send' => 'Sinov elektron pochta yuborish',
            'sent' => ':count qabul qiluvchiga sinov elektron pochta yuborildi',
            'no_recipients' => 'Qabul qiluvchilar sozlanmagan. Avval kamida bitta elektron pochta manzilini qo\'shing.',
            'failed' => 'Sinov elektron pochtani yuborib bo\'lmadi',
            'channel_disabled' => 'Bu kanal hozirda o\'chirilgan. Sinov elektron pochta baribir yuboriladi.',
        ],
    ],

    'logs' => [
        'title' => 'Tizim jurnallari',
        'heading' => 'Jurnal fayllari',
        'entries_title' => 'Jurnal yozuvlari',
        'back_to_list' => 'Jurnal fayllariga qaytish',
        'no_entries' => 'Jurnal yozuvlari topilmadi',
        'unsupported_format' => 'Bu fayl standart Laravel jurnal formatidan foydalanmayotganga o\'xshaydi',
        'search_placeholder' => 'Jurnal yozuvlarini qidirish...',
        'level_filter' => 'Jurnal darajasi',
        'email_recipient' => 'Qabul qiluvchi elektron pochtasi',
        'email_description' => 'Ushbu jurnal faylini belgilangan qabul qiluvchiga elektron pochta birikma sifatida yuboring.',
        'bulk_email_description' => 'Tanlangan jurnal fayllarini belgilangan qabul qiluvchiga alohida elektron pochta birikmalari sifatida yuboring.',
        'bulk_email_files' => 'Tanlangan fayllar',

        'filter' => [
            'date_from' => 'Dan',
            'date_to' => 'Gacha',
        ],

        'column' => [
            'filename' => 'Fayl nomi',
            'size' => 'Hajmi',
            'modified' => 'Oxirgi o\'zgartirilgan',
            'subfolder' => 'Pastki papka',
            'level' => 'Daraja',
            'timestamp' => 'Vaqt belgisi',
            'message' => 'Xabar',
        ],

        'action' => [
            'refresh' => 'Yangilash',
            'view' => 'Ko\'rish',
            'delete' => 'O\'chirish',
            'download' => 'Yuklab olish',
            'email' => 'Elektron pochta yuborish',
            'email_send' => 'Yuborish',
            'email_sent' => 'Jurnal fayli muvaffaqiyatli yuborildi',
            'bulk_email_sent' => ':count jurnal fayl(lar)i muvaffaqiyatli yuborildi',
            'deleted' => 'Jurnal fayli o\'chirildi',
            'bulk_deleted' => ':count jurnal fayl(lar)i o\'chirildi',
        ],

        'confirm' => [
            'delete' => 'Bu jurnal faylini o\'chirishga ishonchingiz komilmi? Bu amalni qaytarib bo\'lmaydi.',
            'bulk_delete' => 'Tanlangan jurnal fayllarini o\'chirishga ishonchingiz komilmi? Bu amalni qaytarib bo\'lmaydi.',
        ],

        'entry' => [
            'detail' => 'Yozuv tafsilotlari',
            'line' => 'Qator',
            'trace_frames' => ':count freym|:count freymlar',
            'copy_trace' => 'Stek izini nusxalash',
            'copy_entry' => 'To\'liq yozuvni nusxalash',
            'copied' => 'Nusxalandi!',
        ],
    ],

];
