<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Parametrlər',
        'error_channel' => 'Xəta Kanalı',
        'error_channel_title' => 'Xəta Kanalı Parametrləri',
        'debug_channel' => 'Debug Kanalı',
        'debug_channel_title' => 'Debug Kanalı Parametrləri',
        'system_logs' => 'Sistem Qeydləri',
        'log_files' => 'Qeyd Faylları',
        'log_entries' => 'Qeyd Yazıları',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Təcili',
            'ALERT' => 'Xəbərdarlıq',
            'CRITICAL' => 'Kritik',
            'ERROR' => 'Xəta',
            'WARNING' => 'Diqqət',
            'NOTICE' => 'Bildiriş',
            'INFO' => 'Məlumat',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Xəta Bildirişi',
            'debug' => 'Debug',
            'log_file' => 'Qeyd Faylı',
        ],
        'footer' => 'Fin-Sentinel tərəfindən göndərildi',

        'label' => [
            'error_message' => 'Xəta Mesajı',
            'class' => 'Sinif',
            'file' => 'Fayl',
            'context' => 'Kontekst',
            'command' => 'Əmr',
            'url' => 'URL',
            'method' => 'Metod',
            'ip' => 'IP',
            'params' => 'Parametrlər',
            'headers' => 'Başlıqlar',
            'name' => 'Ad',
            'email' => 'E-poçt',
            'id' => 'ID',
            'user' => 'İstifadəçi',
            'environment' => 'Mühit',
            'debug_mode' => 'Debug Rejimi',
            'php_version' => 'PHP Versiyası',
            'laravel_version' => 'Laravel Versiyası',
            'laravel' => 'Laravel',
            'peak_memory' => 'Ən Yüksək Yaddaş',
            'enabled' => 'Aktiv',
            'disabled' => 'Deaktiv',
            'relation' => 'Əlaqə: :name',
            'bindings' => 'Bağlamalar:',
            'trace_number' => '#',
            'trace_location' => 'Mövqe',
            'trace_call' => 'Çağırış',
        ],

        'collection' => [
            'count' => ':count element|:count element',
            'more' => '... və :count element daha',
        ],

        'error' => [
            'subject' => ':app - Xəta baş verdi',
            'guest' => 'Qonaq',
            'console' => 'Konsol',
            'section_exception' => 'İstisna Təfərrüatları',
            'section_trace' => 'Stek İzi',
            'section_request' => 'Sorğu Konteksti',
            'section_user' => 'Autentifikasiya Olunmuş İstifadəçi',
            'section_environment' => 'Mühit',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Qonaq',
            'console' => 'Konsol',
            'section_data' => 'Debug Məlumatları',
            'section_call_site' => 'Çağırış Nöqtəsi',
            'section_request' => 'Sorğu Konteksti',
            'section_environment' => 'Mühit',
        ],

        'log_file' => [
            'subject' => ':app - Qeyd faylı: :file',
            'bulk_subject' => ':app - :count qeyd faylı əlavə edildi',
            'body' => '<strong>:file</strong> qeyd faylı :app tətbiqindən əlavə olunub.',
            'body_text' => ':file qeyd faylı :app tətbiqindən əlavə olunub.',
        ],
    ],

    'settings' => [
        'recipients' => 'Alıcılar',
        'throttling' => 'Sürət Məhdudiyyəti',
        'email_address' => 'E-poçt ünvanı',
        'add_recipient' => 'Alıcı əlavə et',
        'no_recipients_warning' => 'Alıcı təyin edilməyib — ən azı bir e-poçt ünvanı əlavə edilənə qədər bildirişlər göndərilməyəcək.',
        'throttle_rate' => 'Məhdudiyyət dərəcəsi',
        'minutes_suffix' => 'dəqiqə',

        'error' => [
            'enabled' => 'Xəta bildirişlərini aktivləşdir',
            'enabled_helper' => 'Deaktiv olduqda, xəta e-poçtları göndərilməyəcək.',
            'recipients_helper' => 'Xəta bildirişləri alacaq e-poçt ünvanlarını əlavə edin.',
            'throttle_helper' => 'Təkrar xəta e-poçtları arasında minimum dəqiqə.',
            'throttle_exceptions' => 'İstisna məhdudiyyəti',
            'throttle_exceptions_helper' => 'Aktiv olduqda, eyni fayl:sətirdəki təkrar istisnalar məhdudiyyət pəncərəsində e-poçt göndərməyəcək.',
            'throttle_log_messages' => 'Qeyd mesajları məhdudiyyəti',
            'throttle_log_messages_helper' => 'Aktiv olduqda, eyni xəta qeyd mesajları məhdudiyyət pəncərəsində e-poçt göndərməyəcək.',
            'ignored_exceptions' => 'Nəzərə Alınmayan İstisnalar',
            'ignored_exceptions_description' => 'Bu siyahıdakı istisnalar e-poçt bildirişi göndərməyəcək.',
            'ignored_exceptions_label' => 'Nəzərə alınmayan istisnalar',
            'other_custom' => 'Digər (xüsusi)',
            'exception_class' => 'İstisna sinifi (FQCN)',
            'class_not_exist' => 'Bu sinif mövcud deyil.',
            'custom_exception' => 'Xüsusi istisna',
            'select_exception' => 'İstisna seçin',
            'add_exception' => 'İstisna əlavə et',
        ],

        'debug' => [
            'enabled' => 'Debug kanalını aktivləşdir',
            'enabled_helper' => 'Deaktiv olduqda, Sentinel::debug() çağırışları səssizcə nəzərə alınmayacaq.',
            'recipients_helper' => 'Debug bildirişləri alacaq e-poçt ünvanlarını əlavə edin.',
            'throttle_enabled' => 'Məhdudiyyəti aktivləşdir',
            'throttle_enabled_helper' => 'Deaktiv olduqda, hər debug çağırışı e-poçt göndərir. Aktiv olduqda, təkrar çağırışlar məhdudlaşdırılır.',
            'throttle_helper' => 'Təkrar debug e-poçtları arasında minimum dəqiqə.',
        ],

        'test_email' => [
            'send' => 'Test E-poçtu Göndər',
            'sent' => ':count alıcıya test e-poçtu göndərildi',
            'no_recipients' => 'Alıcı təyin edilməyib. Əvvəlcə ən azı bir e-poçt ünvanı əlavə edin.',
            'failed' => 'Test e-poçtu göndərilə bilmədi',
            'channel_disabled' => 'Bu kanal hal-hazırda deaktivdir. Test e-poçtu yenə də göndəriləcək.',
        ],
    ],

    'logs' => [
        'title' => 'Sistem Qeydləri',
        'heading' => 'Qeyd Faylları',
        'entries_title' => 'Qeyd Yazıları',
        'back_to_list' => 'Qeyd Fayllarına Qayıt',
        'no_entries' => 'Heç bir qeyd yazısı tapılmadı',
        'unsupported_format' => 'Bu fayl standart Laravel qeyd formatını istifadə etmir kimi görünür',
        'search_placeholder' => 'Qeyd yazılarında axtar...',
        'level_filter' => 'Qeyd Səviyyəsi',
        'email_recipient' => 'Alıcı E-poçtu',
        'email_description' => 'Bu qeyd faylını göstərilən alıcıya e-poçt əlavəsi olaraq göndərin.',
        'bulk_email_description' => 'Seçilmiş qeyd fayllarını göstərilən alıcıya ayrı e-poçt əlavələri olaraq göndərin.',
        'bulk_email_files' => 'Seçilmiş Fayllar',

        'filter' => [
            'date_from' => 'Başlanğıc',
            'date_to' => 'Son',
        ],

        'column' => [
            'filename' => 'Fayl Adı',
            'size' => 'Ölçü',
            'modified' => 'Son Dəyişiklik',
            'subfolder' => 'Alt Qovluq',
            'level' => 'Səviyyə',
            'timestamp' => 'Vaxt Damğası',
            'message' => 'Mesaj',
        ],

        'action' => [
            'refresh' => 'Yenilə',
            'view' => 'Bax',
            'delete' => 'Sil',
            'download' => 'Yüklə',
            'email' => 'E-poçt Göndər',
            'email_send' => 'Göndər',
            'email_sent' => 'Qeyd faylı uğurla e-poçtla göndərildi',
            'bulk_email_sent' => ':count qeyd faylı uğurla e-poçtla göndərildi',
            'deleted' => 'Qeyd faylı silindi',
            'bulk_deleted' => ':count qeyd faylı silindi',
        ],

        'confirm' => [
            'delete' => 'Bu qeyd faylını silmək istədiyinizə əminsiniz? Bu əməliyyat geri qaytarıla bilməz.',
            'bulk_delete' => 'Seçilmiş qeyd fayllarını silmək istədiyinizə əminsiniz? Bu əməliyyat geri qaytarıla bilməz.',
        ],

        'entry' => [
            'detail' => 'Yazı Təfərrüatı',
            'line' => 'Sətir',
            'trace_frames' => ':count çərçivə|:count çərçivə',
            'copy_trace' => 'Stek İzini Kopyala',
            'copy_entry' => 'Tam Yazını Kopyala',
            'copied' => 'Kopyalandı!',
        ],
    ],

];
