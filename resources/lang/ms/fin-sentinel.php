<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Tetapan',
        'error_channel' => 'Saluran Ralat',
        'error_channel_title' => 'Tetapan Saluran Ralat',
        'debug_channel' => 'Saluran Debug',
        'debug_channel_title' => 'Tetapan Saluran Debug',
        'system_logs' => 'Log Sistem',
        'log_files' => 'Fail Log',
        'log_entries' => 'Entri Log',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Kecemasan',
            'ALERT' => 'Amaran Tinggi',
            'CRITICAL' => 'Kritikal',
            'ERROR' => 'Ralat',
            'WARNING' => 'Amaran',
            'NOTICE' => 'Notis',
            'INFO' => 'Maklumat',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Pemberitahuan Ralat',
            'debug' => 'Debug',
            'log_file' => 'Fail Log',
        ],
        'footer' => 'Dihantar oleh Fin-Sentinel',

        'label' => [
            'error_message' => 'Mesej Ralat',
            'class' => 'Kelas',
            'file' => 'Fail',
            'context' => 'Konteks',
            'command' => 'Arahan',
            'url' => 'URL',
            'method' => 'Kaedah',
            'ip' => 'IP',
            'params' => 'Parameter',
            'headers' => 'Pengepala',
            'name' => 'Nama',
            'email' => 'Emel',
            'id' => 'ID',
            'user' => 'Pengguna',
            'environment' => 'Persekitaran',
            'debug_mode' => 'Mod Debug',
            'php_version' => 'Versi PHP',
            'laravel_version' => 'Versi Laravel',
            'laravel' => 'Laravel',
            'peak_memory' => 'Memori Puncak',
            'enabled' => 'Aktif',
            'disabled' => 'Tidak Aktif',
            'relation' => 'Hubungan: :name',
            'bindings' => 'Ikatan:',
            'trace_number' => '#',
            'trace_location' => 'Lokasi',
            'trace_call' => 'Panggilan',
        ],

        'collection' => [
            'count' => ':count item',
            'more' => '... dan :count item lagi',
        ],

        'error' => [
            'subject' => ':app - Ralat telah berlaku',
            'guest' => 'Tetamu',
            'console' => 'Console',
            'section_exception' => 'Butiran Exception',
            'section_trace' => 'Stack Trace',
            'section_request' => 'Konteks Permintaan',
            'section_user' => 'Pengguna Disahkan',
            'section_environment' => 'Persekitaran',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Tetamu',
            'console' => 'Console',
            'section_data' => 'Data Debug',
            'section_call_site' => 'Lokasi Panggilan',
            'section_request' => 'Konteks Permintaan',
            'section_environment' => 'Persekitaran',
        ],

        'log_file' => [
            'subject' => ':app - Fail log: :file',
            'bulk_subject' => ':app - :count fail log dilampirkan',
            'body' => 'Fail log <strong>:file</strong> daripada :app telah dilampirkan.',
            'body_text' => 'Fail log :file daripada :app telah dilampirkan.',
        ],
    ],

    'settings' => [
        'recipients' => 'Penerima',
        'throttling' => 'Had Frekuensi',
        'email_address' => 'Alamat emel',
        'add_recipient' => 'Tambah penerima',
        'no_recipients_warning' => 'Tiada penerima dikonfigurasi - pemberitahuan tidak akan dihantar sehingga sekurang-kurangnya satu alamat emel ditambah.',
        'throttle_rate' => 'Kadar had',
        'minutes_suffix' => 'minit',

        'error' => [
            'enabled' => 'Aktifkan pemberitahuan ralat',
            'enabled_helper' => 'Jika dinyahaktifkan, tiada emel ralat akan dihantar.',
            'recipients_helper' => 'Tambah alamat emel yang akan menerima pemberitahuan ralat.',
            'throttle_helper' => 'Jumlah minit minimum antara emel ralat yang berulang.',
            'throttle_exceptions' => 'Had exception',
            'throttle_exceptions_helper' => 'Jika diaktifkan, exception berulang pada fail:baris yang sama tidak akan menghantar emel dalam tempoh had.',
            'throttle_log_messages' => 'Had mesej log',
            'throttle_log_messages_helper' => 'Jika diaktifkan, mesej log ralat yang sama tidak akan menghantar emel dalam tempoh had.',
            'ignored_exceptions' => 'Exception yang Diabaikan',
            'ignored_exceptions_description' => 'Exception dalam senarai ini tidak akan menghantar pemberitahuan emel.',
            'ignored_exceptions_label' => 'Exception yang diabaikan',
            'other_custom' => 'Lain-lain (tersuai)',
            'exception_class' => 'Kelas exception (FQCN)',
            'class_not_exist' => 'Kelas ini tidak wujud.',
            'custom_exception' => 'Exception tersuai',
            'select_exception' => 'Pilih exception',
            'add_exception' => 'Tambah pengecualian',
        ],

        'debug' => [
            'enabled' => 'Aktifkan saluran Debug',
            'enabled_helper' => 'Jika dinyahaktifkan, panggilan Sentinel::debug() akan diabaikan.',
            'recipients_helper' => 'Tambah alamat emel yang akan menerima pemberitahuan Debug.',
            'throttle_enabled' => 'Aktifkan had',
            'throttle_enabled_helper' => 'Jika dinyahaktifkan, setiap panggilan Debug akan menghantar emel. Jika diaktifkan, panggilan berulang akan dihadkan.',
            'throttle_helper' => 'Jumlah minit minimum antara emel Debug yang berulang.',
        ],

        'test_email' => [
            'send' => 'Hantar Emel Ujian',
            'sent' => 'Emel ujian dihantar kepada :count penerima',
            'no_recipients' => 'Tiada penerima dikonfigurasi. Tambah sekurang-kurangnya satu alamat emel terlebih dahulu.',
            'failed' => 'Gagal menghantar emel ujian',
            'channel_disabled' => 'Saluran ini sedang dinyahaktifkan. Emel ujian tetap akan dihantar.',
        ],
    ],

    'logs' => [
        'title' => 'Log Sistem',
        'heading' => 'Fail Log',
        'entries_title' => 'Entri Log',
        'back_to_list' => 'Kembali ke Senarai Fail Log',
        'no_entries' => 'Tiada entri log ditemui',
        'unsupported_format' => 'Fail ini nampaknya tidak menggunakan format log standard Laravel',
        'search_placeholder' => 'Cari entri log...',
        'level_filter' => 'Tahap Log',
        'email_recipient' => 'Emel Penerima',
        'email_description' => 'Hantar fail log ini sebagai lampiran emel kepada penerima yang ditetapkan.',
        'bulk_email_description' => 'Hantar fail log yang dipilih sebagai lampiran emel berasingan kepada penerima yang ditetapkan.',
        'bulk_email_files' => 'Fail Terpilih',

        'filter' => [
            'date_from' => 'Dari',
            'date_to' => 'Hingga',
        ],

        'column' => [
            'filename' => 'Nama Fail',
            'size' => 'Saiz',
            'modified' => 'Terakhir Diubah',
            'subfolder' => 'Subfolder',
            'level' => 'Tahap',
            'timestamp' => 'Cap Masa',
            'message' => 'Mesej',
        ],

        'action' => [
            'refresh' => 'Muat Semula',
            'view' => 'Lihat',
            'delete' => 'Padam',
            'download' => 'Muat Turun',
            'email' => 'Hantar Emel',
            'email_send' => 'Hantar',
            'email_sent' => 'Fail log berjaya dihantar melalui emel',
            'bulk_email_sent' => ':count fail log berjaya dihantar melalui emel',
            'deleted' => 'Fail log dipadam',
            'bulk_deleted' => ':count fail log dipadam',
        ],

        'confirm' => [
            'delete' => 'Adakah anda pasti mahu memadamkan fail log ini? Tindakan ini tidak boleh dibatalkan.',
            'bulk_delete' => 'Adakah anda pasti mahu memadamkan fail log yang dipilih? Tindakan ini tidak boleh dibatalkan.',
        ],

        'entry' => [
            'detail' => 'Butiran Entri',
            'line' => 'Baris',
            'trace_frames' => ':count bingkai',
            'copy_trace' => 'Salin Stack Trace',
            'copy_entry' => 'Salin Entri Penuh',
            'copied' => 'Disalin!',
        ],
    ],

];
