<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Ustawienia',
        'error_channel' => 'Kanał błędów',
        'error_channel_title' => 'Ustawienia kanału błędów',
        'debug_channel' => 'Kanał Debug',
        'debug_channel_title' => 'Ustawienia kanału Debug',
        'system_logs' => 'Logi systemowe',
        'log_files' => 'Pliki logów',
        'log_entries' => 'Wpisy logów',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Awaria',
            'ALERT' => 'Alert',
            'CRITICAL' => 'Krytyczny',
            'ERROR' => 'Błąd',
            'WARNING' => 'Ostrzeżenie',
            'NOTICE' => 'Uwaga',
            'INFO' => 'Informacja',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Powiadomienie o błędzie',
            'debug' => 'Debug',
            'log_file' => 'Plik logu',
        ],
        'footer' => 'Wysłano przez Fin-Sentinel',

        'label' => [
            'error_message' => 'Komunikat błędu',
            'class' => 'Klasa',
            'file' => 'Plik',
            'context' => 'Kontekst',
            'command' => 'Polecenie',
            'url' => 'URL',
            'method' => 'Metoda',
            'ip' => 'IP',
            'params' => 'Parametry',
            'headers' => 'Nagłówki',
            'name' => 'Nazwa',
            'email' => 'Email',
            'id' => 'ID',
            'user' => 'Użytkownik',
            'environment' => 'Środowisko',
            'debug_mode' => 'Tryb Debug',
            'php_version' => 'Wersja PHP',
            'laravel_version' => 'Wersja Laravel',
            'laravel' => 'Laravel',
            'peak_memory' => 'Szczytowe zużycie pamięci',
            'enabled' => 'Włączony',
            'disabled' => 'Wyłączony',
            'relation' => 'Relacja: :name',
            'bindings' => 'Powiązania:',
            'trace_number' => '#',
            'trace_location' => 'Lokalizacja',
            'trace_call' => 'Wywołanie',
        ],

        'collection' => [
            'count' => ':count element|:count elementów',
            'more' => '... i :count więcej elementów',
        ],

        'error' => [
            'subject' => ':app - Wystąpił błąd',
            'guest' => 'Gość',
            'console' => 'Konsola',
            'section_exception' => 'Szczegóły wyjątku',
            'section_trace' => 'Ślad stosu',
            'section_request' => 'Kontekst żądania',
            'section_user' => 'Zalogowany użytkownik',
            'section_environment' => 'Środowisko',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Gość',
            'console' => 'Konsola',
            'section_data' => 'Dane Debug',
            'section_call_site' => 'Miejsce wywołania',
            'section_request' => 'Kontekst żądania',
            'section_environment' => 'Środowisko',
        ],

        'log_file' => [
            'subject' => ':app - Plik logu: :file',
            'bulk_subject' => ':app - :count plików logów w załączniku',
            'body' => 'Plik logu <strong>:file</strong> z :app znajduje się w załączniku.',
            'body_text' => 'Plik logu :file z :app znajduje się w załączniku.',
        ],
    ],

    'settings' => [
        'recipients' => 'Odbiorcy',
        'throttling' => 'Ograniczanie',
        'email_address' => 'Adres email',
        'add_recipient' => 'Dodaj odbiorcę',
        'no_recipients_warning' => 'Brak skonfigurowanych odbiorców — powiadomienia nie będą wysyłane, dopóki nie zostanie dodany przynajmniej jeden adres email.',
        'throttle_rate' => 'Częstotliwość ograniczania',
        'minutes_suffix' => 'minut',

        'error' => [
            'enabled' => 'Włącz powiadomienia o błędach',
            'enabled_helper' => 'Po wyłączeniu żadne e-maile o błędach nie będą wysyłane.',
            'recipients_helper' => 'Dodaj adresy email, które będą otrzymywać powiadomienia o błędach.',
            'throttle_helper' => 'Minimalny czas w minutach między duplikatami e-maili o błędach.',
            'throttle_exceptions' => 'Ograniczaj wyjątki',
            'throttle_exceptions_helper' => 'Po włączeniu zduplikowane wyjątki w tym samym pliku:linii nie będą wysyłać e-maili w oknie ograniczania.',
            'throttle_log_messages' => 'Ograniczaj komunikaty logów',
            'throttle_log_messages_helper' => 'Po włączeniu identyczne komunikaty logów błędów nie będą wysyłać e-maili w oknie ograniczania.',
            'ignored_exceptions' => 'Ignorowane wyjątki',
            'ignored_exceptions_description' => 'Wyjątki z tej listy nie będą wywoływać powiadomień email.',
            'ignored_exceptions_label' => 'Ignorowane wyjątki',
            'other_custom' => 'Inny (niestandardowy)',
            'exception_class' => 'Klasa wyjątku (FQCN)',
            'class_not_exist' => 'Ta klasa nie istnieje.',
            'custom_exception' => 'Niestandardowy wyjątek',
            'select_exception' => 'Wybierz wyjątek',
            'add_exception' => 'Dodaj wyjątek',
        ],

        'debug' => [
            'enabled' => 'Włącz kanał Debug',
            'enabled_helper' => 'Po wyłączeniu wywołania Sentinel::debug() będą cicho ignorowane.',
            'recipients_helper' => 'Dodaj adresy email, które będą otrzymywać powiadomienia Debug.',
            'throttle_enabled' => 'Włącz ograniczanie',
            'throttle_enabled_helper' => 'Po wyłączeniu każde wywołanie debug wysyła e-mail. Po włączeniu zduplikowane wywołania są ograniczane.',
            'throttle_helper' => 'Minimalny czas w minutach między duplikatami e-maili Debug.',
        ],

        'test_email' => [
            'send' => 'Wyślij testowy e-mail',
            'sent' => 'Testowy e-mail wysłany do :count odbiorców',
            'no_recipients' => 'Brak skonfigurowanych odbiorców. Najpierw dodaj przynajmniej jeden adres email.',
            'failed' => 'Nie udało się wysłać testowego e-maila',
            'channel_disabled' => 'Ten kanał jest obecnie wyłączony. Testowy e-mail zostanie mimo to wysłany.',
        ],
    ],

    'logs' => [
        'title' => 'Logi systemowe',
        'heading' => 'Pliki logów',
        'entries_title' => 'Wpisy logów',
        'back_to_list' => 'Powrót do plików logów',
        'no_entries' => 'Nie znaleziono wpisów logów',
        'unsupported_format' => 'Ten plik nie wydaje się używać standardowego formatu logów Laravel',
        'search_placeholder' => 'Szukaj w logach...',
        'level_filter' => 'Poziom logu',
        'email_recipient' => 'Adres email odbiorcy',
        'email_description' => 'Wyślij ten plik logu jako załącznik e-mail do wskazanego odbiorcy.',
        'bulk_email_description' => 'Wyślij wybrane pliki logów jako indywidualne załączniki e-mail do wskazanego odbiorcy.',
        'bulk_email_files' => 'Wybrane pliki',

        'filter' => [
            'date_from' => 'Od',
            'date_to' => 'Do',
        ],

        'column' => [
            'filename' => 'Nazwa pliku',
            'size' => 'Rozmiar',
            'modified' => 'Ostatnia modyfikacja',
            'subfolder' => 'Podfolder',
            'level' => 'Poziom',
            'timestamp' => 'Znacznik czasu',
            'message' => 'Wiadomość',
        ],

        'action' => [
            'refresh' => 'Odśwież',
            'view' => 'Podgląd',
            'delete' => 'Usuń',
            'download' => 'Pobierz',
            'email' => 'Wyślij e-mailem',
            'email_send' => 'Wyślij',
            'email_sent' => 'Plik logu wysłany e-mailem',
            'bulk_email_sent' => ':count plików logów wysłanych e-mailem',
            'deleted' => 'Plik logu usunięty',
            'bulk_deleted' => ':count plików logów usunięte',
        ],

        'confirm' => [
            'delete' => 'Czy na pewno chcesz usunąć ten plik logu? Tej operacji nie można cofnąć.',
            'bulk_delete' => 'Czy na pewno chcesz usunąć wybrane pliki logów? Tej operacji nie można cofnąć.',
        ],

        'entry' => [
            'detail' => 'Szczegóły wpisu',
            'line' => 'Linia',
            'trace_frames' => ':count ramka|:count ramek',
            'copy_trace' => 'Kopiuj ślad stosu',
            'copy_entry' => 'Kopiuj cały wpis',
            'copied' => 'Skopiowano!',
        ],
    ],

];
