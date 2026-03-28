<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Nastavení',
        'error_channel' => 'Kanál chyb',
        'error_channel_title' => 'Nastavení kanálu chyb',
        'debug_channel' => 'Debug kanál',
        'debug_channel_title' => 'Nastavení Debug kanálu',
        'system_logs' => 'Systémové logy',
        'log_files' => 'Soubory logů',
        'log_entries' => 'Záznamy logů',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Nouzový stav',
            'ALERT' => 'Výstraha',
            'CRITICAL' => 'Kritický',
            'ERROR' => 'Chyba',
            'WARNING' => 'Varování',
            'NOTICE' => 'Upozornění',
            'INFO' => 'Informace',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Oznámení o chybě',
            'debug' => 'Debug',
            'log_file' => 'Soubor logu',
        ],
        'footer' => 'Odesláno pomocí Fin-Sentinel',

        'label' => [
            'error_message' => 'Chybová zpráva',
            'class' => 'Třída',
            'file' => 'Soubor',
            'context' => 'Kontext',
            'command' => 'Příkaz',
            'url' => 'URL',
            'method' => 'Metoda',
            'ip' => 'IP',
            'params' => 'Parametry',
            'headers' => 'Hlavičky',
            'name' => 'Jméno',
            'email' => 'Email',
            'id' => 'ID',
            'user' => 'Uživatel',
            'environment' => 'Prostředí',
            'debug_mode' => 'Debug režim',
            'php_version' => 'Verze PHP',
            'laravel_version' => 'Verze Laravel',
            'laravel' => 'Laravel',
            'peak_memory' => 'Špičková paměť',
            'enabled' => 'Zapnuto',
            'disabled' => 'Vypnuto',
            'relation' => 'Relace: :name',
            'bindings' => 'Vazby:',
            'trace_number' => '#',
            'trace_location' => 'Umístění',
            'trace_call' => 'Volání',
        ],

        'collection' => [
            'count' => ':count položka|:count položek',
            'more' => '... a dalších :count položek',
        ],

        'error' => [
            'subject' => ':app - Došlo k chybě',
            'guest' => 'Host',
            'console' => 'Konzole',
            'section_exception' => 'Detaily výjimky',
            'section_trace' => 'Zásobník volání',
            'section_request' => 'Kontext požadavku',
            'section_user' => 'Přihlášený uživatel',
            'section_environment' => 'Prostředí',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Host',
            'console' => 'Konzole',
            'section_data' => 'Debug data',
            'section_call_site' => 'Místo volání',
            'section_request' => 'Kontext požadavku',
            'section_environment' => 'Prostředí',
        ],

        'log_file' => [
            'subject' => ':app - Soubor logu: :file',
            'bulk_subject' => ':app - :count souborů logů v příloze',
            'body' => 'Soubor logu <strong>:file</strong> z :app je v příloze.',
            'body_text' => 'Soubor logu :file z :app je v příloze.',
        ],
    ],

    'settings' => [
        'recipients' => 'Příjemci',
        'throttling' => 'Omezování',
        'email_address' => 'Emailová adresa',
        'add_recipient' => 'Přidat příjemce',
        'no_recipients_warning' => 'Nejsou nastaveni žádní příjemci — oznámení nebudou odesílána, dokud nebude přidána alespoň jedna emailová adresa.',
        'throttle_rate' => 'Frekvence omezení',
        'minutes_suffix' => 'minut',

        'error' => [
            'enabled' => 'Zapnout oznámení o chybách',
            'enabled_helper' => 'Při vypnutí nebudou odesílány žádné chybové e-maily.',
            'recipients_helper' => 'Přidejte emailové adresy, které budou přijímat oznámení o chybách.',
            'throttle_helper' => 'Minimální doba v minutách mezi duplicitními chybovými e-maily.',
            'throttle_exceptions' => 'Omezit výjimky',
            'throttle_exceptions_helper' => 'Při zapnutí duplicitní výjimky na stejném souboru:řádku nebudou odesílat e-maily v rámci okna omezení.',
            'throttle_log_messages' => 'Omezit zprávy logů',
            'throttle_log_messages_helper' => 'Při zapnutí identické chybové zprávy logů nebudou odesílat e-maily v rámci okna omezení.',
            'ignored_exceptions' => 'Ignorované výjimky',
            'ignored_exceptions_description' => 'Výjimky v tomto seznamu nebudou vyvolávat emailová oznámení.',
            'ignored_exceptions_label' => 'Ignorované výjimky',
            'other_custom' => 'Jiný (vlastní)',
            'exception_class' => 'Třída výjimky (FQCN)',
            'class_not_exist' => 'Tato třída neexistuje.',
            'custom_exception' => 'Vlastní výjimka',
            'select_exception' => 'Vyberte výjimku',
            'add_exception' => 'Přidat výjimku',
        ],

        'debug' => [
            'enabled' => 'Zapnout Debug kanál',
            'enabled_helper' => 'Při vypnutí budou volání Sentinel::debug() tiše ignorována.',
            'recipients_helper' => 'Přidejte emailové adresy, které budou přijímat Debug oznámení.',
            'throttle_enabled' => 'Zapnout omezování',
            'throttle_enabled_helper' => 'Při vypnutí každé debug volání odešle e-mail. Při zapnutí jsou duplicitní volání omezena.',
            'throttle_helper' => 'Minimální doba v minutách mezi duplicitními Debug e-maily.',
        ],

        'test_email' => [
            'send' => 'Odeslat testovací e-mail',
            'sent' => 'Testovací e-mail odeslán :count příjemcům',
            'no_recipients' => 'Nejsou nastaveni žádní příjemci. Nejprve přidejte alespoň jednu emailovou adresu.',
            'failed' => 'Odeslání testovacího e-mailu se nezdařilo',
            'channel_disabled' => 'Tento kanál je momentálně vypnutý. Testovací e-mail bude přesto odeslán.',
        ],
    ],

    'logs' => [
        'title' => 'Systémové logy',
        'heading' => 'Soubory logů',
        'entries_title' => 'Záznamy logů',
        'back_to_list' => 'Zpět na soubory logů',
        'no_entries' => 'Nebyly nalezeny žádné záznamy logů',
        'unsupported_format' => 'Tento soubor zřejmě nepoužívá standardní formát logů Laravel',
        'search_placeholder' => 'Hledat v záznamech logů...',
        'level_filter' => 'Úroveň logu',
        'email_recipient' => 'Email příjemce',
        'email_description' => 'Odeslat tento soubor logu jako přílohu e-mailu určenému příjemci.',
        'bulk_email_description' => 'Odeslat vybrané soubory logů jako jednotlivé přílohy e-mailu určenému příjemci.',
        'bulk_email_files' => 'Vybrané soubory',

        'filter' => [
            'date_from' => 'Od',
            'date_to' => 'Do',
        ],

        'column' => [
            'filename' => 'Název souboru',
            'size' => 'Velikost',
            'modified' => 'Poslední úprava',
            'subfolder' => 'Podsložka',
            'level' => 'Úroveň',
            'timestamp' => 'Časové razítko',
            'message' => 'Zpráva',
        ],

        'action' => [
            'refresh' => 'Obnovit',
            'view' => 'Zobrazit',
            'delete' => 'Smazat',
            'download' => 'Stáhnout',
            'email' => 'Odeslat e-mailem',
            'email_send' => 'Odeslat',
            'email_sent' => 'Soubor logu úspěšně odeslán e-mailem',
            'bulk_email_sent' => ':count souborů logů úspěšně odesláno e-mailem',
            'deleted' => 'Soubor logu smazán',
            'bulk_deleted' => ':count souborů logů smazáno',
        ],

        'confirm' => [
            'delete' => 'Opravdu chcete smazat tento soubor logu? Tuto akci nelze vrátit zpět.',
            'bulk_delete' => 'Opravdu chcete smazat vybrané soubory logů? Tuto akci nelze vrátit zpět.',
        ],

        'entry' => [
            'detail' => 'Detail záznamu',
            'line' => 'Řádek',
            'trace_frames' => ':count rámec|:count rámců',
            'copy_trace' => 'Kopírovat zásobník volání',
            'copy_entry' => 'Kopírovat celý záznam',
            'copied' => 'Zkopírováno!',
        ],
    ],

];
