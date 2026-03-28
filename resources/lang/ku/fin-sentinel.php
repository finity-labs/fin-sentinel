<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Mîheng',
        'error_channel' => 'Kanala Çewtiyê',
        'error_channel_title' => 'Mîhengên Kanala Çewtiyê',
        'debug_channel' => 'Kanala Debug',
        'debug_channel_title' => 'Mîhengên Kanala Debug',
        'system_logs' => 'Tomarên Sîstemê',
        'log_files' => 'Pelên Tomaran',
        'log_entries' => 'Tomarên Têketinê',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Acîl',
            'ALERT' => 'Hişyarî',
            'CRITICAL' => 'Krîtîk',
            'ERROR' => 'Çewtî',
            'WARNING' => 'Hişyarkirin',
            'NOTICE' => 'Agahdarî',
            'INFO' => 'Agahî',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Agahdariya Çewtiyê',
            'debug' => 'Debug',
            'log_file' => 'Pelê Tomarê',
        ],
        'footer' => 'Ji aliyê Fin-Sentinel ve hatiye şandin',

        'label' => [
            'error_message' => 'Peyama Çewtiyê',
            'class' => 'Çîn',
            'file' => 'Pel',
            'context' => 'Çarçove',
            'command' => 'Ferman',
            'url' => 'URL',
            'method' => 'Rêbaz',
            'ip' => 'IP',
            'params' => 'Parametre',
            'headers' => 'Sernav',
            'name' => 'Nav',
            'email' => 'E-peyam',
            'id' => 'ID',
            'user' => 'Bikarhêner',
            'environment' => 'Jîngehê',
            'debug_mode' => 'Moda Debug',
            'php_version' => 'Guhertoya PHP',
            'laravel_version' => 'Guhertoya Laravel',
            'laravel' => 'Laravel',
            'peak_memory' => 'Lûtkeya Bîranînê',
            'enabled' => 'Çalak',
            'disabled' => 'Neçalak',
            'relation' => 'Têkilî: :name',
            'bindings' => 'Girêdan:',
            'trace_number' => '#',
            'trace_location' => 'Cih',
            'trace_call' => 'Bang',
        ],

        'collection' => [
            'count' => ':count hêman|:count hêman',
            'more' => '... û :count hêmanên din',
        ],

        'error' => [
            'subject' => ':app - Çewtiyekê çêbû',
            'guest' => 'Mêvan',
            'console' => 'Konsol',
            'section_exception' => 'Hûrguliyên Vegotinê',
            'section_trace' => 'Şopê Stakê',
            'section_request' => 'Çarçoveya Daxwazê',
            'section_user' => 'Bikarhênerê Pejirandî',
            'section_environment' => 'Jîngehê',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Mêvan',
            'console' => 'Konsol',
            'section_data' => 'Daneyên Debug',
            'section_call_site' => 'Cihê Bangê',
            'section_request' => 'Çarçoveya Daxwazê',
            'section_environment' => 'Jîngehê',
        ],

        'log_file' => [
            'subject' => ':app - Pelê tomarê: :file',
            'bulk_subject' => ':app - :count pelên tomarê hatine pêvekirin',
            'body' => 'Pelê tomarê <strong>:file</strong> ji :app hatiye pêvekirin.',
            'body_text' => 'Pelê tomarê :file ji :app hatiye pêvekirin.',
        ],
    ],

    'settings' => [
        'recipients' => 'Wergir',
        'throttling' => 'Kontrola Rêjeyê',
        'email_address' => 'Navnîşana e-peyamê',
        'add_recipient' => 'Wergir lê zêde bike',
        'no_recipients_warning' => 'Tu wergir nehatiye diyarkirin — agahdarî nayên şandin heta ku herî kêm yek e-peyam were zêdekirin.',
        'throttle_rate' => 'Rêjeya sînor',
        'minutes_suffix' => 'deqîqe',

        'error' => [
            'enabled' => 'Agahdariyên çewtiyê çalak bike',
            'enabled_helper' => 'Dema neçalak be, e-peyamên çewtiyê nayên şandin.',
            'recipients_helper' => 'Navnîşanên e-peyamê yên ku agahdariyên çewtiyê werdigirin zêde bike.',
            'throttle_helper' => 'Herî kêm deqîqe di navbera e-peyamên çewtiyên dubare de.',
            'throttle_exceptions' => 'Sînorkirina vegotin',
            'throttle_exceptions_helper' => 'Dema çalak be, vegotinên dubare li heman pel:rêz di pencereya sînorê de e-peyam nayên şandin.',
            'throttle_log_messages' => 'Sînorkirina peyamên tomarê',
            'throttle_log_messages_helper' => 'Dema çalak be, peyamên tomarê yên çewtiyê yên hevşik di pencereya sînorê de e-peyam nayên şandin.',
            'ignored_exceptions' => 'Vegotinên Paşguhkirî',
            'ignored_exceptions_description' => 'Vegotinên di vê lîsteyê de agahdariyên e-peyamê nakin.',
            'ignored_exceptions_label' => 'Vegotinên paşguhkirî',
            'other_custom' => 'Yên din (taybet)',
            'exception_class' => 'Çîna vegotinê (FQCN)',
            'class_not_exist' => 'Ev çîn tune ye.',
            'custom_exception' => 'Vegotina taybet',
            'select_exception' => 'Vegotinê hilbijêre',
            'add_exception' => 'Awarte lê zêde bike',
        ],

        'debug' => [
            'enabled' => 'Kanala Debug çalak bike',
            'enabled_helper' => 'Dema neçalak be, bangên Sentinel::debug() bêdeng tên paşguhkirin.',
            'recipients_helper' => 'Navnîşanên e-peyamê yên ku agahdariyên Debug werdigirin zêde bike.',
            'throttle_enabled' => 'Sînorkirin çalak bike',
            'throttle_enabled_helper' => 'Dema neçalak be, her banga debug e-peyamek dişîne. Dema çalak be, bangên dubare tên sînorkirin.',
            'throttle_helper' => 'Herî kêm deqîqe di navbera e-peyamên debug ên dubare de.',
        ],

        'test_email' => [
            'send' => 'E-peyama ceribandinê bişîne',
            'sent' => 'E-peyama ceribandinê ji :count wergir re hat şandin',
            'no_recipients' => 'Tu wergir nehatiye diyarkirin. Berî her tiştî herî kêm yek navnîşana e-peyamê zêde bike.',
            'failed' => 'Şandina e-peyama ceribandinê têk çû',
            'channel_disabled' => 'Ev kanal niha neçalak e. E-peyama ceribandinê dê bê guman bê şandin.',
        ],
    ],

    'logs' => [
        'title' => 'Tomarên Sîstemê',
        'heading' => 'Pelên Tomaran',
        'entries_title' => 'Tomarên Têketinê',
        'back_to_list' => 'Vegere Pelên Tomaran',
        'no_entries' => 'Tu tomarek nehat dîtin',
        'unsupported_format' => 'Ev pel formata tomara standard a Laravel bi kar nayîne',
        'search_placeholder' => 'Di tomaran de bigere...',
        'level_filter' => 'Asta Tomarê',
        'email_recipient' => 'E-peyama Wergir',
        'email_description' => 'Vê pelê tomarê wekî pêveka e-peyamê ji wergirê diyarkirî re bişîne.',
        'bulk_email_description' => 'Pelên tomarê yên bijartî wekî pêvekên e-peyamê yên cuda ji wergirê diyarkirî re bişîne.',
        'bulk_email_files' => 'Pelên Bijartî',

        'filter' => [
            'date_from' => 'Ji',
            'date_to' => 'Heta',
        ],

        'column' => [
            'filename' => 'Navê Pelê',
            'size' => 'Mezinahî',
            'modified' => 'Guhertina Dawîn',
            'subfolder' => 'Binpeldank',
            'level' => 'Ast',
            'timestamp' => 'Demnîşan',
            'message' => 'Peyam',
        ],

        'action' => [
            'refresh' => 'Nûkirin',
            'view' => 'Bibîne',
            'delete' => 'Jêbibe',
            'download' => 'Daxîne',
            'email' => 'E-peyam Bişîne',
            'email_send' => 'Bişîne',
            'email_sent' => 'Pelê tomarê bi serkeftî hat e-peyman kirin',
            'bulk_email_sent' => ':count pelê tomarê bi serkeftî hatin e-peyman kirin',
            'deleted' => 'Pelê tomarê hat jêbirin',
            'bulk_deleted' => ':count pelê tomarê hatin jêbirin',
        ],

        'confirm' => [
            'delete' => 'Tu bawer î ku dixwazî vê pelê tomarê jê bibî? Ev kirinê naşê veger.',
            'bulk_delete' => 'Tu bawer î ku dixwazî pelên tomarê yên bijartî jê bibî? Ev kirinê naşê veger.',
        ],

        'entry' => [
            'detail' => 'Hûrguliyên Tomarê',
            'line' => 'Rêz',
            'trace_frames' => ':count çarçove|:count çarçove',
            'copy_trace' => 'Şopê Stakê kopî bike',
            'copy_entry' => 'Tomara Tevahî kopî bike',
            'copied' => 'Hat kopîkirin!',
        ],
    ],

];
