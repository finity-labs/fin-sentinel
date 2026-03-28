<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Nustatymai',
        'error_channel' => 'Klaidų kanalas',
        'error_channel_title' => 'Klaidų kanalo nustatymai',
        'debug_channel' => 'Derinimo kanalas',
        'debug_channel_title' => 'Derinimo kanalo nustatymai',
        'system_logs' => 'Sistemos žurnalai',
        'log_files' => 'Žurnalo failai',
        'log_entries' => 'Žurnalo įrašai',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Avarinis',
            'ALERT' => 'Pavojus',
            'CRITICAL' => 'Kritinis',
            'ERROR' => 'Klaida',
            'WARNING' => 'Įspėjimas',
            'NOTICE' => 'Pastaba',
            'INFO' => 'Informacija',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Pranešimas apie klaidą',
            'debug' => 'Debug',
            'log_file' => 'Žurnalo failas',
        ],
        'footer' => 'Išsiųsta Fin-Sentinel',

        'label' => [
            'error_message' => 'Klaidos pranešimas',
            'class' => 'Klasė',
            'file' => 'Failas',
            'context' => 'Kontekstas',
            'command' => 'Komanda',
            'url' => 'URL',
            'method' => 'Metodas',
            'ip' => 'IP',
            'params' => 'Parametrai',
            'headers' => 'Antraštės',
            'name' => 'Vardas',
            'email' => 'Email',
            'id' => 'ID',
            'user' => 'Naudotojas',
            'environment' => 'Aplinka',
            'debug_mode' => 'Debug režimas',
            'php_version' => 'PHP versija',
            'laravel_version' => 'Laravel versija',
            'laravel' => 'Laravel',
            'peak_memory' => 'Didžiausia atmintis',
            'enabled' => 'Įjungta',
            'disabled' => 'Išjungta',
            'relation' => 'Ryšys: :name',
            'bindings' => 'Susiejimai:',
            'trace_number' => '#',
            'trace_location' => 'Vieta',
            'trace_call' => 'Kvietimas',
        ],

        'collection' => [
            'count' => ':count elementas|:count elementų',
            'more' => '... ir dar :count elementų',
        ],

        'error' => [
            'subject' => ':app — Įvyko klaida',
            'guest' => 'Svečias',
            'console' => 'Konsolė',
            'section_exception' => 'Išimties informacija',
            'section_trace' => 'Kvietimų dėklas',
            'section_request' => 'Užklausos kontekstas',
            'section_user' => 'Autentifikuotas naudotojas',
            'section_environment' => 'Aplinka',
        ],

        'debug' => [
            'subject' => ':app — Debug: :subject',
            'guest' => 'Svečias',
            'console' => 'Konsolė',
            'section_data' => 'Debug duomenys',
            'section_call_site' => 'Kvietimo vieta',
            'section_request' => 'Užklausos kontekstas',
            'section_environment' => 'Aplinka',
        ],

        'log_file' => [
            'subject' => ':app — Žurnalo failas: :file',
            'bulk_subject' => ':app — :count žurnalo failų prisegta',
            'body' => 'Žurnalo failas <strong>:file</strong> iš :app yra prisegtas.',
            'body_text' => 'Žurnalo failas :file iš :app yra prisegtas.',
        ],
    ],

    'settings' => [
        'recipients' => 'Gavėjai',
        'throttling' => 'Dažnio ribojimas',
        'email_address' => 'Email adresas',
        'add_recipient' => 'Pridėti gavėją',
        'no_recipients_warning' => 'Gavėjai nesukonfigūruoti — pranešimai nebus siunčiami, kol nebus pridėtas bent vienas email adresas.',
        'throttle_rate' => 'Ribojimo dažnis',
        'minutes_suffix' => 'minučių',

        'error' => [
            'enabled' => 'Įjungti klaidų pranešimus',
            'enabled_helper' => 'Kai išjungta, klaidų email-ai nebus siunčiami.',
            'recipients_helper' => 'Pridėkite email adresus, kurie gaus klaidų pranešimus.',
            'throttle_helper' => 'Minimalus intervalas minutėmis tarp pasikartojančių klaidų email-ų.',
            'throttle_exceptions' => 'Išimčių ribojimas',
            'throttle_exceptions_helper' => 'Kai įjungta, pasikartojančios išimtys tame pačiame faile:eilutėje nesukels email-ų siuntimo ribojimo lange.',
            'throttle_log_messages' => 'Žurnalo pranešimų ribojimas',
            'throttle_log_messages_helper' => 'Kai įjungta, identiški klaidų pranešimai žurnaluose nesukels email-ų siuntimo ribojimo lange.',
            'ignored_exceptions' => 'Ignoruojamos išimtys',
            'ignored_exceptions_description' => 'Šiame sąraše esančios išimtys nesukels email pranešimų siuntimo.',
            'ignored_exceptions_label' => 'Ignoruojamos išimtys',
            'other_custom' => 'Kita (pasirinktinė)',
            'exception_class' => 'Išimties klasė (FQCN)',
            'class_not_exist' => 'Ši klasė neegzistuoja.',
            'custom_exception' => 'Pasirinktinė išimtis',
            'select_exception' => 'Pasirinkite išimtį',
            'add_exception' => 'Pridėti išimtį',
        ],

        'debug' => [
            'enabled' => 'Įjungti derinimo kanalą',
            'enabled_helper' => 'Kai išjungta, Sentinel::debug() kvietimai bus ignoruojami.',
            'recipients_helper' => 'Pridėkite email adresus, kurie gaus derinimo pranešimus.',
            'throttle_enabled' => 'Įjungti dažnio ribojimą',
            'throttle_enabled_helper' => 'Kai išjungta, kiekvienas debug kvietimas siunčia email. Kai įjungta, pasikartojantys kvietimai yra ribojami.',
            'throttle_helper' => 'Minimalus intervalas minutėmis tarp pasikartojančių debug email-ų.',
        ],

        'test_email' => [
            'send' => 'Siųsti bandomąjį email',
            'sent' => 'Bandomasis email išsiųstas :count gavėjui(-ams)',
            'no_recipients' => 'Gavėjai nesukonfigūruoti. Pirmiausia pridėkite bent vieną email adresą.',
            'failed' => 'Nepavyko išsiųsti bandomojo email',
            'channel_disabled' => 'Šis kanalas šiuo metu išjungtas. Bandomasis email vis tiek bus išsiųstas.',
        ],
    ],

    'logs' => [
        'title' => 'Sistemos žurnalai',
        'heading' => 'Žurnalo failai',
        'entries_title' => 'Žurnalo įrašai',
        'back_to_list' => 'Atgal į žurnalo failus',
        'no_entries' => 'Žurnalo įrašų nerasta',
        'unsupported_format' => 'Šis failas nenaudoja standartinio Laravel žurnalo formato',
        'search_placeholder' => 'Ieškoti žurnalo įrašų...',
        'level_filter' => 'Žurnalo lygis',
        'email_recipient' => 'Gavėjo email',
        'email_description' => 'Siųsti šį žurnalo failą kaip priedą nurodytu adresu.',
        'bulk_email_description' => 'Siųsti pasirinktus žurnalo failus kaip atskirus priedus nurodytu adresu.',
        'bulk_email_files' => 'Pasirinkti failai',

        'filter' => [
            'date_from' => 'Nuo',
            'date_to' => 'Iki',
        ],

        'column' => [
            'filename' => 'Failo pavadinimas',
            'size' => 'Dydis',
            'modified' => 'Paskutinis pakeitimas',
            'subfolder' => 'Poaplankis',
            'level' => 'Lygis',
            'timestamp' => 'Laikas',
            'message' => 'Pranešimas',
        ],

        'action' => [
            'refresh' => 'Atnaujinti',
            'view' => 'Peržiūrėti',
            'delete' => 'Ištrinti',
            'download' => 'Atsisiųsti',
            'email' => 'Siųsti kam',
            'email_send' => 'Siųsti',
            'email_sent' => 'Žurnalo failas sėkmingai išsiųstas',
            'bulk_email_sent' => ':count žurnalo failas(-ai) sėkmingai išsiųstas(-i)',
            'deleted' => 'Žurnalo failas ištrintas',
            'bulk_deleted' => ':count žurnalo failas(-ai) ištrintas(-i)',
        ],

        'confirm' => [
            'delete' => 'Ar tikrai norite ištrinti šį žurnalo failą? Šio veiksmo negalima atšaukti.',
            'bulk_delete' => 'Ar tikrai norite ištrinti pasirinktus žurnalo failus? Šio veiksmo negalima atšaukti.',
        ],

        'entry' => [
            'detail' => 'Įrašo informacija',
            'line' => 'Eilutė',
            'trace_frames' => ':count kadras|:count kadrų',
            'copy_trace' => 'Kopijuoti kvietimų dėklą',
            'copy_entry' => 'Kopijuoti visą įrašą',
            'copied' => 'Nukopijuota!',
        ],
    ],

];
