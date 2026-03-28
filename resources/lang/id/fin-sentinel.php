<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Pengaturan',
        'error_channel' => 'Saluran Error',
        'error_channel_title' => 'Pengaturan Saluran Error',
        'debug_channel' => 'Saluran Debug',
        'debug_channel_title' => 'Pengaturan Saluran Debug',
        'system_logs' => 'Log Sistem',
        'log_files' => 'File Log',
        'log_entries' => 'Entri Log',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Darurat',
            'ALERT' => 'Peringatan Tinggi',
            'CRITICAL' => 'Kritis',
            'ERROR' => 'Error',
            'WARNING' => 'Peringatan',
            'NOTICE' => 'Pemberitahuan',
            'INFO' => 'Informasi',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Notifikasi Error',
            'debug' => 'Debug',
            'log_file' => 'File Log',
        ],
        'footer' => 'Dikirim oleh Fin-Sentinel',

        'label' => [
            'error_message' => 'Pesan Error',
            'class' => 'Kelas',
            'file' => 'File',
            'context' => 'Konteks',
            'command' => 'Perintah',
            'url' => 'URL',
            'method' => 'Metode',
            'ip' => 'IP',
            'params' => 'Parameter',
            'headers' => 'Header',
            'name' => 'Nama',
            'email' => 'Email',
            'id' => 'ID',
            'user' => 'Pengguna',
            'environment' => 'Lingkungan',
            'debug_mode' => 'Mode Debug',
            'php_version' => 'Versi PHP',
            'laravel_version' => 'Versi Laravel',
            'laravel' => 'Laravel',
            'peak_memory' => 'Memori Puncak',
            'enabled' => 'Aktif',
            'disabled' => 'Nonaktif',
            'relation' => 'Relasi: :name',
            'bindings' => 'Binding:',
            'trace_number' => '#',
            'trace_location' => 'Lokasi',
            'trace_call' => 'Panggilan',
        ],

        'collection' => [
            'count' => ':count item',
            'more' => '... dan :count item lainnya',
        ],

        'error' => [
            'subject' => ':app - Terjadi error',
            'guest' => 'Tamu',
            'console' => 'Console',
            'section_exception' => 'Detail Exception',
            'section_trace' => 'Stack Trace',
            'section_request' => 'Konteks Request',
            'section_user' => 'Pengguna Terautentikasi',
            'section_environment' => 'Lingkungan',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Tamu',
            'console' => 'Console',
            'section_data' => 'Data Debug',
            'section_call_site' => 'Lokasi Panggilan',
            'section_request' => 'Konteks Request',
            'section_environment' => 'Lingkungan',
        ],

        'log_file' => [
            'subject' => ':app - File log: :file',
            'bulk_subject' => ':app - :count file log terlampir',
            'body' => 'File log <strong>:file</strong> dari :app telah dilampirkan.',
            'body_text' => 'File log :file dari :app telah dilampirkan.',
        ],
    ],

    'settings' => [
        'recipients' => 'Penerima',
        'throttling' => 'Pembatasan Frekuensi',
        'email_address' => 'Alamat email',
        'add_recipient' => 'Tambah penerima',
        'no_recipients_warning' => 'Belum ada penerima yang dikonfigurasi - notifikasi tidak akan dikirim sampai setidaknya satu alamat email ditambahkan.',
        'throttle_rate' => 'Tingkat pembatasan',
        'minutes_suffix' => 'menit',

        'error' => [
            'enabled' => 'Aktifkan notifikasi error',
            'enabled_helper' => 'Jika dinonaktifkan, tidak ada email error yang akan dikirim.',
            'recipients_helper' => 'Tambahkan alamat email yang akan menerima notifikasi error.',
            'throttle_helper' => 'Jumlah menit minimum antara email error yang duplikat.',
            'throttle_exceptions' => 'Pembatasan exception',
            'throttle_exceptions_helper' => 'Jika diaktifkan, exception duplikat pada file:baris yang sama tidak akan mengirim email dalam jangka waktu pembatasan.',
            'throttle_log_messages' => 'Pembatasan pesan log',
            'throttle_log_messages_helper' => 'Jika diaktifkan, pesan log error yang identik tidak akan mengirim email dalam jangka waktu pembatasan.',
            'ignored_exceptions' => 'Exception yang Diabaikan',
            'ignored_exceptions_description' => 'Exception dalam daftar ini tidak akan mengirim notifikasi email.',
            'ignored_exceptions_label' => 'Exception yang diabaikan',
            'other_custom' => 'Lainnya (kustom)',
            'exception_class' => 'Kelas exception (FQCN)',
            'class_not_exist' => 'Kelas ini tidak ada.',
            'custom_exception' => 'Exception kustom',
            'select_exception' => 'Pilih exception',
            'add_exception' => 'Tambah pengecualian',
        ],

        'debug' => [
            'enabled' => 'Aktifkan saluran Debug',
            'enabled_helper' => 'Jika dinonaktifkan, panggilan Sentinel::debug() akan diabaikan.',
            'recipients_helper' => 'Tambahkan alamat email yang akan menerima notifikasi Debug.',
            'throttle_enabled' => 'Aktifkan pembatasan',
            'throttle_enabled_helper' => 'Jika dinonaktifkan, setiap panggilan Debug akan mengirim email. Jika diaktifkan, panggilan duplikat akan dibatasi.',
            'throttle_helper' => 'Jumlah menit minimum antara email Debug yang duplikat.',
        ],

        'test_email' => [
            'send' => 'Kirim Email Percobaan',
            'sent' => 'Email percobaan terkirim ke :count penerima',
            'no_recipients' => 'Belum ada penerima yang dikonfigurasi. Tambahkan setidaknya satu alamat email terlebih dahulu.',
            'failed' => 'Gagal mengirim email percobaan',
            'channel_disabled' => 'Saluran ini sedang nonaktif. Email percobaan tetap akan dikirim.',
        ],
    ],

    'logs' => [
        'title' => 'Log Sistem',
        'heading' => 'File Log',
        'entries_title' => 'Entri Log',
        'back_to_list' => 'Kembali ke Daftar File Log',
        'no_entries' => 'Tidak ada entri log yang ditemukan',
        'unsupported_format' => 'File ini tampaknya tidak menggunakan format log standar Laravel',
        'search_placeholder' => 'Cari entri log...',
        'level_filter' => 'Level Log',
        'email_recipient' => 'Email Penerima',
        'email_description' => 'Kirim file log ini sebagai lampiran email ke penerima yang ditentukan.',
        'bulk_email_description' => 'Kirim file log yang dipilih sebagai lampiran email terpisah ke penerima yang ditentukan.',
        'bulk_email_files' => 'File Terpilih',

        'filter' => [
            'date_from' => 'Dari',
            'date_to' => 'Sampai',
        ],

        'column' => [
            'filename' => 'Nama File',
            'size' => 'Ukuran',
            'modified' => 'Terakhir Diubah',
            'subfolder' => 'Subfolder',
            'level' => 'Level',
            'timestamp' => 'Waktu',
            'message' => 'Pesan',
        ],

        'action' => [
            'refresh' => 'Segarkan',
            'view' => 'Lihat',
            'delete' => 'Hapus',
            'download' => 'Unduh',
            'email' => 'Kirim Email',
            'email_send' => 'Kirim',
            'email_sent' => 'File log berhasil dikirim melalui email',
            'bulk_email_sent' => ':count file log berhasil dikirim melalui email',
            'deleted' => 'File log dihapus',
            'bulk_deleted' => ':count file log dihapus',
        ],

        'confirm' => [
            'delete' => 'Apakah Anda yakin ingin menghapus file log ini? Tindakan ini tidak dapat dibatalkan.',
            'bulk_delete' => 'Apakah Anda yakin ingin menghapus file log yang dipilih? Tindakan ini tidak dapat dibatalkan.',
        ],

        'entry' => [
            'detail' => 'Detail Entri',
            'line' => 'Baris',
            'trace_frames' => ':count frame',
            'copy_trace' => 'Salin Stack Trace',
            'copy_entry' => 'Salin Entri Lengkap',
            'copied' => 'Tersalin!',
        ],
    ],

];
