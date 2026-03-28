<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Ayarlar',
        'error_channel' => 'Hata Kanalı',
        'error_channel_title' => 'Hata Kanalı Ayarları',
        'debug_channel' => 'Debug Kanalı',
        'debug_channel_title' => 'Debug Kanalı Ayarları',
        'system_logs' => 'Sistem Günlükleri',
        'log_files' => 'Günlük Dosyaları',
        'log_entries' => 'Günlük Kayıtları',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Acil',
            'ALERT' => 'Uyarı',
            'CRITICAL' => 'Kritik',
            'ERROR' => 'Hata',
            'WARNING' => 'İkaz',
            'NOTICE' => 'Bildirim',
            'INFO' => 'Bilgi',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Hata Bildirimi',
            'debug' => 'Debug',
            'log_file' => 'Günlük Dosyası',
        ],
        'footer' => 'Fin-Sentinel tarafından gönderildi',

        'label' => [
            'error_message' => 'Hata Mesajı',
            'class' => 'Sınıf',
            'file' => 'Dosya',
            'context' => 'Bağlam',
            'command' => 'Komut',
            'url' => 'URL',
            'method' => 'Metot',
            'ip' => 'IP',
            'params' => 'Parametreler',
            'headers' => 'Başlıklar',
            'name' => 'Ad',
            'email' => 'E-posta',
            'id' => 'ID',
            'user' => 'Kullanıcı',
            'environment' => 'Ortam',
            'debug_mode' => 'Debug Modu',
            'php_version' => 'PHP Sürümü',
            'laravel_version' => 'Laravel Sürümü',
            'laravel' => 'Laravel',
            'peak_memory' => 'En Yüksek Bellek',
            'enabled' => 'Etkin',
            'disabled' => 'Devre Dışı',
            'relation' => 'İlişki: :name',
            'bindings' => 'Bağlamalar:',
            'trace_number' => '#',
            'trace_location' => 'Konum',
            'trace_call' => 'Çağrı',
        ],

        'collection' => [
            'count' => ':count öğe|:count öğe',
            'more' => '... ve :count öğe daha',
        ],

        'error' => [
            'subject' => ':app - Bir hata oluştu',
            'guest' => 'Misafir',
            'console' => 'Konsol',
            'section_exception' => 'İstisna Detayları',
            'section_trace' => 'Yığın İzi',
            'section_request' => 'İstek Bağlamı',
            'section_user' => 'Oturum Açmış Kullanıcı',
            'section_environment' => 'Ortam',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Misafir',
            'console' => 'Konsol',
            'section_data' => 'Debug Verileri',
            'section_call_site' => 'Çağrı Noktası',
            'section_request' => 'İstek Bağlamı',
            'section_environment' => 'Ortam',
        ],

        'log_file' => [
            'subject' => ':app - Günlük dosyası: :file',
            'bulk_subject' => ':app - :count günlük dosyası eklendi',
            'body' => '<strong>:file</strong> günlük dosyası :app uygulamasından ekte gönderilmiştir.',
            'body_text' => ':file günlük dosyası :app uygulamasından ekte gönderilmiştir.',
        ],
    ],

    'settings' => [
        'recipients' => 'Alıcılar',
        'throttling' => 'Hız Sınırlama',
        'email_address' => 'E-posta adresi',
        'no_recipients_warning' => 'Alıcı yapılandırılmadı — en az bir e-posta adresi eklenene kadar bildirimler gönderilmeyecektir.',
        'throttle_rate' => 'Hız sınırı',
        'minutes_suffix' => 'dakika',

        'error' => [
            'enabled' => 'Hata bildirimlerini etkinleştir',
            'enabled_helper' => 'Devre dışı bırakıldığında hata e-postaları gönderilmez.',
            'recipients_helper' => 'Hata bildirimlerini alacak e-posta adreslerini ekleyin.',
            'throttle_helper' => 'Aynı hata e-postaları arasındaki minimum dakika.',
            'throttle_exceptions' => 'İstisna hız sınırlama',
            'throttle_exceptions_helper' => 'Etkinleştirildiğinde, aynı dosya:satırdaki tekrarlanan istisnalar hız sınırlama penceresi içinde e-posta tetiklemez.',
            'throttle_log_messages' => 'Günlük mesajları hız sınırlama',
            'throttle_log_messages_helper' => 'Etkinleştirildiğinde, aynı hata günlük mesajları hız sınırlama penceresi içinde e-posta tetiklemez.',
            'ignored_exceptions' => 'Yoksayılan İstisnalar',
            'ignored_exceptions_description' => 'Bu listedeki istisnalar e-posta bildirimi tetiklemeyecektir.',
            'ignored_exceptions_label' => 'Yoksayılan istisnalar',
            'other_custom' => 'Diğer (özel)',
            'exception_class' => 'İstisna sınıfı (FQCN)',
            'class_not_exist' => 'Bu sınıf mevcut değil.',
            'custom_exception' => 'Özel istisna',
            'select_exception' => 'İstisna seçin',
        ],

        'debug' => [
            'enabled' => 'Debug kanalını etkinleştir',
            'enabled_helper' => 'Devre dışı bırakıldığında Sentinel::debug() çağrıları sessizce yoksayılır.',
            'recipients_helper' => 'Debug bildirimlerini alacak e-posta adreslerini ekleyin.',
            'throttle_enabled' => 'Hız sınırlamayı etkinleştir',
            'throttle_enabled_helper' => 'Devre dışıyken her debug çağrısı e-posta gönderir. Etkinken tekrarlanan çağrılar sınırlanır.',
            'throttle_helper' => 'Aynı debug e-postaları arasındaki minimum dakika.',
        ],

        'test_email' => [
            'send' => 'Test E-postası Gönder',
            'sent' => ':count alıcıya test e-postası gönderildi',
            'no_recipients' => 'Alıcı yapılandırılmadı. Önce en az bir e-posta adresi ekleyin.',
            'failed' => 'Test e-postası gönderilemedi',
            'channel_disabled' => 'Bu kanal şu anda devre dışı. Test e-postası yine de gönderilecektir.',
        ],
    ],

    'logs' => [
        'title' => 'Sistem Günlükleri',
        'heading' => 'Günlük Dosyaları',
        'entries_title' => 'Günlük Kayıtları',
        'back_to_list' => 'Günlük Dosyalarına Dön',
        'no_entries' => 'Günlük kaydı bulunamadı',
        'unsupported_format' => 'Bu dosya standart Laravel günlük formatını kullanmıyor gibi görünüyor',
        'search_placeholder' => 'Günlük kayıtlarında ara...',
        'level_filter' => 'Günlük Seviyesi',
        'email_recipient' => 'Alıcı E-postası',
        'email_description' => 'Bu günlük dosyasını belirtilen alıcıya e-posta eki olarak gönderin.',
        'bulk_email_description' => 'Seçilen günlük dosyalarını belirtilen alıcıya ayrı e-posta ekleri olarak gönderin.',
        'bulk_email_files' => 'Seçilen Dosyalar',

        'filter' => [
            'date_from' => 'Başlangıç',
            'date_to' => 'Bitiş',
        ],

        'column' => [
            'filename' => 'Dosya Adı',
            'size' => 'Boyut',
            'modified' => 'Son Değişiklik',
            'subfolder' => 'Alt Klasör',
            'level' => 'Seviye',
            'timestamp' => 'Zaman Damgası',
            'message' => 'Mesaj',
        ],

        'action' => [
            'refresh' => 'Yenile',
            'view' => 'Görüntüle',
            'delete' => 'Sil',
            'download' => 'İndir',
            'email' => 'E-posta Gönder',
            'email_send' => 'Gönder',
            'email_sent' => 'Günlük dosyası başarıyla e-postalandı',
            'bulk_email_sent' => ':count günlük dosyası başarıyla e-postalandı',
            'deleted' => 'Günlük dosyası silindi',
            'bulk_deleted' => ':count günlük dosyası silindi',
        ],

        'confirm' => [
            'delete' => 'Bu günlük dosyasını silmek istediğinizden emin misiniz? Bu işlem geri alınamaz.',
            'bulk_delete' => 'Seçilen günlük dosyalarını silmek istediğinizden emin misiniz? Bu işlem geri alınamaz.',
        ],

        'entry' => [
            'detail' => 'Kayıt Detayı',
            'line' => 'Satır',
            'trace_frames' => ':count çerçeve|:count çerçeve',
            'copy_trace' => 'Yığın İzini Kopyala',
            'copy_entry' => 'Tam Kaydı Kopyala',
            'copied' => 'Kopyalandı!',
        ],
    ],

];
