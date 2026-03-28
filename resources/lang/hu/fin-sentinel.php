<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Beállítások',
        'error_channel' => 'Hibacsatorna',
        'error_channel_title' => 'Hibacsatorna beállításai',
        'debug_channel' => 'Debug csatorna',
        'debug_channel_title' => 'Debug csatorna beállításai',
        'system_logs' => 'Rendszernaplók',
        'log_files' => 'Naplófájlok',
        'log_entries' => 'Naplóbejegyzések',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Vészhelyzet',
            'ALERT' => 'Riasztás',
            'CRITICAL' => 'Kritikus',
            'ERROR' => 'Hiba',
            'WARNING' => 'Figyelmeztetés',
            'NOTICE' => 'Értesítés',
            'INFO' => 'Információ',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Hibaértesítés',
            'debug' => 'Debug',
            'log_file' => 'Naplófájl',
        ],
        'footer' => 'Küldte a Fin-Sentinel',

        'label' => [
            'error_message' => 'Hibaüzenet',
            'class' => 'Osztály',
            'file' => 'Fájl',
            'context' => 'Kontextus',
            'command' => 'Parancs',
            'url' => 'URL',
            'method' => 'Metódus',
            'ip' => 'IP',
            'params' => 'Paraméterek',
            'headers' => 'Fejlécek',
            'name' => 'Név',
            'email' => 'Email',
            'id' => 'ID',
            'user' => 'Felhasználó',
            'environment' => 'Környezet',
            'debug_mode' => 'Debug mód',
            'php_version' => 'PHP verzió',
            'laravel_version' => 'Laravel verzió',
            'laravel' => 'Laravel',
            'peak_memory' => 'Csúcs memóriahasználat',
            'enabled' => 'Bekapcsolva',
            'disabled' => 'Kikapcsolva',
            'relation' => 'Reláció: :name',
            'bindings' => 'Kötések:',
            'trace_number' => '#',
            'trace_location' => 'Hely',
            'trace_call' => 'Hívás',
        ],

        'collection' => [
            'count' => ':count elem|:count elem',
            'more' => '... és még :count elem',
        ],

        'error' => [
            'subject' => ':app - Hiba történt',
            'guest' => 'Vendég',
            'console' => 'Konzol',
            'section_exception' => 'Kivétel részletei',
            'section_trace' => 'Hívási verem',
            'section_request' => 'Kérés kontextusa',
            'section_user' => 'Bejelentkezett felhasználó',
            'section_environment' => 'Környezet',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Vendég',
            'console' => 'Konzol',
            'section_data' => 'Debug adatok',
            'section_call_site' => 'Hívás helye',
            'section_request' => 'Kérés kontextusa',
            'section_environment' => 'Környezet',
        ],

        'log_file' => [
            'subject' => ':app - Naplófájl: :file',
            'bulk_subject' => ':app - :count naplófájl csatolva',
            'body' => 'A(z) :app alkalmazás <strong>:file</strong> naplófájlja csatolva van.',
            'body_text' => 'A(z) :app alkalmazás :file naplófájlja csatolva van.',
        ],
    ],

    'settings' => [
        'recipients' => 'Címzettek',
        'throttling' => 'Korlátozás',
        'email_address' => 'Email cím',
        'add_recipient' => 'Címzett hozzáadása',
        'no_recipients_warning' => 'Nincsenek beállított címzettek — az értesítések nem lesznek elküldve, amíg legalább egy email cím nincs megadva.',
        'throttle_rate' => 'Korlátozási arány',
        'minutes_suffix' => 'perc',

        'error' => [
            'enabled' => 'Hibaértesítések bekapcsolása',
            'enabled_helper' => 'Kikapcsolt állapotban nem lesznek hibaüzenetek elküldve.',
            'recipients_helper' => 'Adja meg az email címeket, amelyek hibaértesítéseket kapnak.',
            'throttle_helper' => 'Minimális percek száma az ismétlődő hibaüzenetek között.',
            'throttle_exceptions' => 'Kivételek korlátozása',
            'throttle_exceptions_helper' => 'Bekapcsolt állapotban az azonos fájl:sor helyen lévő ismétlődő kivételek nem küldenek emailt a korlátozási időszakon belül.',
            'throttle_log_messages' => 'Naplóüzenetek korlátozása',
            'throttle_log_messages_helper' => 'Bekapcsolt állapotban az azonos hibanaplóüzenetek nem küldenek emailt a korlátozási időszakon belül.',
            'ignored_exceptions' => 'Figyelmen kívül hagyott kivételek',
            'ignored_exceptions_description' => 'A listán szereplő kivételek nem váltanak ki email értesítést.',
            'ignored_exceptions_label' => 'Figyelmen kívül hagyott kivételek',
            'other_custom' => 'Egyéb (egyedi)',
            'exception_class' => 'Kivétel osztály (FQCN)',
            'class_not_exist' => 'Ez az osztály nem létezik.',
            'custom_exception' => 'Egyedi kivétel',
            'select_exception' => 'Kivétel kiválasztása',
            'add_exception' => 'Kivétel hozzáadása',
        ],

        'debug' => [
            'enabled' => 'Debug csatorna bekapcsolása',
            'enabled_helper' => 'Kikapcsolt állapotban a Sentinel::debug() hívások csendben figyelmen kívül lesznek hagyva.',
            'recipients_helper' => 'Adja meg az email címeket, amelyek Debug értesítéseket kapnak.',
            'throttle_enabled' => 'Korlátozás bekapcsolása',
            'throttle_enabled_helper' => 'Kikapcsolt állapotban minden debug hívás emailt küld. Bekapcsolt állapotban az ismétlődő hívások korlátozva vannak.',
            'throttle_helper' => 'Minimális percek száma az ismétlődő Debug emailek között.',
        ],

        'test_email' => [
            'send' => 'Teszt email küldése',
            'sent' => 'Teszt email elküldve :count címzettnek',
            'no_recipients' => 'Nincsenek beállított címzettek. Először adjon meg legalább egy email címet.',
            'failed' => 'A teszt email küldése sikertelen',
            'channel_disabled' => 'Ez a csatorna jelenleg ki van kapcsolva. A teszt email ennek ellenére el lesz küldve.',
        ],
    ],

    'logs' => [
        'title' => 'Rendszernaplók',
        'heading' => 'Naplófájlok',
        'entries_title' => 'Naplóbejegyzések',
        'back_to_list' => 'Vissza a naplófájlokhoz',
        'no_entries' => 'Nem találhatók naplóbejegyzések',
        'unsupported_format' => 'Ez a fájl nem a Laravel szabványos naplóformátumát használja',
        'search_placeholder' => 'Keresés a naplóbejegyzésekben...',
        'level_filter' => 'Naplószint',
        'email_recipient' => 'Címzett email',
        'email_description' => 'Naplófájl küldése email mellékletként a megadott címzettnek.',
        'bulk_email_description' => 'A kiválasztott naplófájlok küldése egyedi email mellékletekként a megadott címzettnek.',
        'bulk_email_files' => 'Kiválasztott fájlok',

        'filter' => [
            'date_from' => 'Ettől',
            'date_to' => 'Eddig',
        ],

        'column' => [
            'filename' => 'Fájlnév',
            'size' => 'Méret',
            'modified' => 'Utoljára módosítva',
            'subfolder' => 'Almappa',
            'level' => 'Szint',
            'timestamp' => 'Időbélyeg',
            'message' => 'Üzenet',
        ],

        'action' => [
            'refresh' => 'Frissítés',
            'view' => 'Megtekintés',
            'delete' => 'Törlés',
            'download' => 'Letöltés',
            'email' => 'Küldés emailben',
            'email_send' => 'Küldés',
            'email_sent' => 'Naplófájl sikeresen elküldve emailben',
            'bulk_email_sent' => ':count naplófájl sikeresen elküldve emailben',
            'deleted' => 'Naplófájl törölve',
            'bulk_deleted' => ':count naplófájl törölve',
        ],

        'confirm' => [
            'delete' => 'Biztosan törölni szeretné ezt a naplófájlt? Ez a művelet nem vonható vissza.',
            'bulk_delete' => 'Biztosan törölni szeretné a kiválasztott naplófájlokat? Ez a művelet nem vonható vissza.',
        ],

        'entry' => [
            'detail' => 'Bejegyzés részletei',
            'line' => 'Sor',
            'trace_frames' => ':count keret|:count keret',
            'copy_trace' => 'Hívási verem másolása',
            'copy_entry' => 'Teljes bejegyzés másolása',
            'copied' => 'Másolva!',
        ],
    ],

];
