<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Nastavenia',
        'error_channel' => 'Kanál chýb',
        'error_channel_title' => 'Nastavenia kanálu chýb',
        'debug_channel' => 'Debug kanál',
        'debug_channel_title' => 'Nastavenia Debug kanálu',
        'system_logs' => 'Systémové logy',
        'log_files' => 'Súbory logov',
        'log_entries' => 'Záznamy logov',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Núdzový stav',
            'ALERT' => 'Výstraha',
            'CRITICAL' => 'Kritický',
            'ERROR' => 'Chyba',
            'WARNING' => 'Varovanie',
            'NOTICE' => 'Upozornenie',
            'INFO' => 'Informácia',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Oznámenie o chybe',
            'debug' => 'Debug',
            'log_file' => 'Súbor logu',
        ],
        'footer' => 'Odoslané pomocou Fin-Sentinel',

        'label' => [
            'error_message' => 'Chybová správa',
            'class' => 'Trieda',
            'file' => 'Súbor',
            'context' => 'Kontext',
            'command' => 'Príkaz',
            'url' => 'URL',
            'method' => 'Metóda',
            'ip' => 'IP',
            'params' => 'Parametre',
            'headers' => 'Hlavičky',
            'name' => 'Meno',
            'email' => 'Email',
            'id' => 'ID',
            'user' => 'Používateľ',
            'environment' => 'Prostredie',
            'debug_mode' => 'Debug režim',
            'php_version' => 'Verzia PHP',
            'laravel_version' => 'Verzia Laravel',
            'laravel' => 'Laravel',
            'peak_memory' => 'Špičková pamäť',
            'enabled' => 'Zapnuté',
            'disabled' => 'Vypnuté',
            'relation' => 'Relácia: :name',
            'bindings' => 'Väzby:',
            'trace_number' => '#',
            'trace_location' => 'Umiestnenie',
            'trace_call' => 'Volanie',
        ],

        'collection' => [
            'count' => ':count položka|:count položiek',
            'more' => '... a ďalších :count položiek',
        ],

        'error' => [
            'subject' => ':app - Vyskytla sa chyba',
            'guest' => 'Hosť',
            'console' => 'Konzola',
            'section_exception' => 'Podrobnosti výnimky',
            'section_trace' => 'Zásobník volaní',
            'section_request' => 'Kontext požiadavky',
            'section_user' => 'Prihlásený používateľ',
            'section_environment' => 'Prostredie',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Hosť',
            'console' => 'Konzola',
            'section_data' => 'Debug dáta',
            'section_call_site' => 'Miesto volania',
            'section_request' => 'Kontext požiadavky',
            'section_environment' => 'Prostredie',
        ],

        'log_file' => [
            'subject' => ':app - Súbor logu: :file',
            'bulk_subject' => ':app - :count súborov logov v prílohe',
            'body' => 'Súbor logu <strong>:file</strong> z :app je v prílohe.',
            'body_text' => 'Súbor logu :file z :app je v prílohe.',
        ],
    ],

    'settings' => [
        'recipients' => 'Príjemcovia',
        'throttling' => 'Obmedzovanie',
        'email_address' => 'Emailová adresa',
        'add_recipient' => 'Pridať príjemcu',
        'no_recipients_warning' => 'Nie sú nastavení žiadni príjemcovia — oznámenia nebudú odosielané, kým nebude pridaná aspoň jedna emailová adresa.',
        'throttle_rate' => 'Frekvencia obmedzenia',
        'minutes_suffix' => 'minút',

        'error' => [
            'enabled' => 'Zapnúť oznámenia o chybách',
            'enabled_helper' => 'Pri vypnutí nebudú odosielané žiadne chybové e-maily.',
            'recipients_helper' => 'Pridajte emailové adresy, ktoré budú prijímať oznámenia o chybách.',
            'throttle_helper' => 'Minimálny čas v minútach medzi duplicitnými chybovými e-mailmi.',
            'throttle_exceptions' => 'Obmedziť výnimky',
            'throttle_exceptions_helper' => 'Pri zapnutí duplicitné výnimky na tom istom súbore:riadku nebudú odosielať e-maily v rámci okna obmedzenia.',
            'throttle_log_messages' => 'Obmedziť správy logov',
            'throttle_log_messages_helper' => 'Pri zapnutí identické chybové správy logov nebudú odosielať e-maily v rámci okna obmedzenia.',
            'ignored_exceptions' => 'Ignorované výnimky',
            'ignored_exceptions_description' => 'Výnimky v tomto zozname nebudú spúšťať emailové oznámenia.',
            'ignored_exceptions_label' => 'Ignorované výnimky',
            'other_custom' => 'Iný (vlastný)',
            'exception_class' => 'Trieda výnimky (FQCN)',
            'class_not_exist' => 'Táto trieda neexistuje.',
            'custom_exception' => 'Vlastná výnimka',
            'select_exception' => 'Vyberte výnimku',
            'add_exception' => 'Pridať výnimku',
        ],

        'debug' => [
            'enabled' => 'Zapnúť Debug kanál',
            'enabled_helper' => 'Pri vypnutí budú volania Sentinel::debug() ticho ignorované.',
            'recipients_helper' => 'Pridajte emailové adresy, ktoré budú prijímať Debug oznámenia.',
            'throttle_enabled' => 'Zapnúť obmedzovanie',
            'throttle_enabled_helper' => 'Pri vypnutí každé debug volanie odošle e-mail. Pri zapnutí sú duplicitné volania obmedzené.',
            'throttle_helper' => 'Minimálny čas v minútach medzi duplicitnými Debug e-mailmi.',
        ],

        'test_email' => [
            'send' => 'Odoslať testovací e-mail',
            'sent' => 'Testovací e-mail odoslaný :count príjemcom',
            'no_recipients' => 'Nie sú nastavení žiadni príjemcovia. Najprv pridajte aspoň jednu emailovú adresu.',
            'failed' => 'Odoslanie testovacieho e-mailu zlyhalo',
            'channel_disabled' => 'Tento kanál je momentálne vypnutý. Testovací e-mail bude napriek tomu odoslaný.',
        ],
    ],

    'logs' => [
        'title' => 'Systémové logy',
        'heading' => 'Súbory logov',
        'entries_title' => 'Záznamy logov',
        'back_to_list' => 'Späť na súbory logov',
        'no_entries' => 'Nenašli sa žiadne záznamy logov',
        'unsupported_format' => 'Tento súbor zrejme nepoužíva štandardný formát logov Laravel',
        'search_placeholder' => 'Hľadať v záznamoch logov...',
        'level_filter' => 'Úroveň logu',
        'email_recipient' => 'Email príjemcu',
        'email_description' => 'Odoslať tento súbor logu ako prílohu e-mailu určenému príjemcovi.',
        'bulk_email_description' => 'Odoslať vybrané súbory logov ako jednotlivé prílohy e-mailu určenému príjemcovi.',
        'bulk_email_files' => 'Vybrané súbory',

        'filter' => [
            'date_from' => 'Od',
            'date_to' => 'Do',
        ],

        'column' => [
            'filename' => 'Názov súboru',
            'size' => 'Veľkosť',
            'modified' => 'Posledná úprava',
            'subfolder' => 'Podpriečinok',
            'level' => 'Úroveň',
            'timestamp' => 'Časová pečiatka',
            'message' => 'Správa',
        ],

        'action' => [
            'refresh' => 'Obnoviť',
            'view' => 'Zobraziť',
            'delete' => 'Zmazať',
            'download' => 'Stiahnuť',
            'email' => 'Odoslať e-mailom',
            'email_send' => 'Odoslať',
            'email_sent' => 'Súbor logu úspešne odoslaný e-mailom',
            'bulk_email_sent' => ':count súborov logov úspešne odoslaných e-mailom',
            'deleted' => 'Súbor logu zmazaný',
            'bulk_deleted' => ':count súborov logov zmazaných',
        ],

        'confirm' => [
            'delete' => 'Naozaj chcete zmazať tento súbor logu? Túto akciu nie je možné vrátiť späť.',
            'bulk_delete' => 'Naozaj chcete zmazať vybrané súbory logov? Túto akciu nie je možné vrátiť späť.',
        ],

        'entry' => [
            'detail' => 'Detail záznamu',
            'line' => 'Riadok',
            'trace_frames' => ':count rámec|:count rámcov',
            'copy_trace' => 'Kopírovať zásobník volaní',
            'copy_entry' => 'Kopírovať celý záznam',
            'copied' => 'Skopírované!',
        ],
    ],

];
