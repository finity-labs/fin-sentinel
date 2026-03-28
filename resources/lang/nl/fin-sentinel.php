<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Instellingen',
        'error_channel' => 'Foutenkanaal',
        'error_channel_title' => 'Instellingen foutenkanaal',
        'debug_channel' => 'Debug-kanaal',
        'debug_channel_title' => 'Instellingen Debug-kanaal',
        'system_logs' => 'Systeemlogboeken',
        'log_files' => 'Logbestanden',
        'log_entries' => 'Logvermeldingen',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Noodgeval',
            'ALERT' => 'Alarm',
            'CRITICAL' => 'Kritiek',
            'ERROR' => 'Fout',
            'WARNING' => 'Waarschuwing',
            'NOTICE' => 'Melding',
            'INFO' => 'Info',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Foutmelding',
            'debug' => 'Debug',
            'log_file' => 'Logbestand',
        ],
        'footer' => 'Verzonden door Fin-Sentinel',

        'label' => [
            'error_message' => 'Foutmelding',
            'class' => 'Klasse',
            'file' => 'Bestand',
            'context' => 'Context',
            'command' => 'Commando',
            'url' => 'URL',
            'method' => 'Methode',
            'ip' => 'IP',
            'params' => 'Parameters',
            'headers' => 'Headers',
            'name' => 'Naam',
            'email' => 'E-mail',
            'id' => 'ID',
            'user' => 'Gebruiker',
            'environment' => 'Omgeving',
            'debug_mode' => 'Debug-modus',
            'php_version' => 'PHP-versie',
            'laravel_version' => 'Laravel-versie',
            'laravel' => 'Laravel',
            'peak_memory' => 'Piekgeheugen',
            'enabled' => 'Ingeschakeld',
            'disabled' => 'Uitgeschakeld',
            'relation' => 'Relatie: :name',
            'bindings' => 'Bindingen:',
            'trace_number' => '#',
            'trace_location' => 'Locatie',
            'trace_call' => 'Aanroep',
        ],

        'collection' => [
            'count' => ':count item|:count items',
            'more' => '... en nog :count items',
        ],

        'error' => [
            'subject' => ':app - Er is een fout opgetreden',
            'guest' => 'Gast',
            'console' => 'Console',
            'section_exception' => 'Uitzonderingsdetails',
            'section_trace' => 'Stack Trace',
            'section_request' => 'Verzoekcontext',
            'section_user' => 'Ingelogde gebruiker',
            'section_environment' => 'Omgeving',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Gast',
            'console' => 'Console',
            'section_data' => 'Debug-gegevens',
            'section_call_site' => 'Aanroeplocatie',
            'section_request' => 'Verzoekcontext',
            'section_environment' => 'Omgeving',
        ],

        'log_file' => [
            'subject' => ':app - Logbestand: :file',
            'bulk_subject' => ':app - :count logbestanden bijgevoegd',
            'body' => 'Het logbestand <strong>:file</strong> van :app is bijgevoegd.',
            'body_text' => 'Het logbestand :file van :app is bijgevoegd.',
        ],
    ],

    'settings' => [
        'recipients' => 'Ontvangers',
        'throttling' => 'Beperking',
        'email_address' => 'E-mailadres',
        'add_recipient' => 'Ontvanger toevoegen',
        'no_recipients_warning' => 'Geen ontvangers geconfigureerd — meldingen worden pas verzonden als er minstens één e-mailadres is toegevoegd.',
        'throttle_rate' => 'Beperkingsfrequentie',
        'minutes_suffix' => 'minuten',

        'error' => [
            'enabled' => 'Foutmeldingen inschakelen',
            'enabled_helper' => 'Wanneer uitgeschakeld, worden er geen fout-e-mails verzonden.',
            'recipients_helper' => 'Voeg e-mailadressen toe die foutmeldingen zullen ontvangen.',
            'throttle_helper' => 'Minimaal aantal minuten tussen dubbele fout-e-mails.',
            'throttle_exceptions' => 'Uitzonderingen beperken',
            'throttle_exceptions_helper' => 'Wanneer ingeschakeld, zullen dubbele uitzonderingen op hetzelfde bestand:regel geen e-mails versturen binnen het beperkingsvenster.',
            'throttle_log_messages' => 'Logberichten beperken',
            'throttle_log_messages_helper' => 'Wanneer ingeschakeld, zullen identieke foutlogberichten geen e-mails versturen binnen het beperkingsvenster.',
            'ignored_exceptions' => 'Genegeerde uitzonderingen',
            'ignored_exceptions_description' => 'Uitzonderingen in deze lijst zullen geen e-mailmeldingen versturen.',
            'ignored_exceptions_label' => 'Genegeerde uitzonderingen',
            'other_custom' => 'Overig (aangepast)',
            'exception_class' => 'Uitzonderingsklasse (FQCN)',
            'class_not_exist' => 'Deze klasse bestaat niet.',
            'custom_exception' => 'Aangepaste uitzondering',
            'select_exception' => 'Uitzondering selecteren',
            'add_exception' => 'Uitzondering toevoegen',
        ],

        'debug' => [
            'enabled' => 'Debug-kanaal inschakelen',
            'enabled_helper' => 'Wanneer uitgeschakeld, worden Sentinel::debug()-aanroepen stilzwijgend genegeerd.',
            'recipients_helper' => 'Voeg e-mailadressen toe die Debug-meldingen zullen ontvangen.',
            'throttle_enabled' => 'Beperking inschakelen',
            'throttle_enabled_helper' => 'Wanneer uitgeschakeld, verstuurt elke Debug-aanroep een e-mail. Wanneer ingeschakeld, worden dubbele aanroepen beperkt.',
            'throttle_helper' => 'Minimaal aantal minuten tussen dubbele Debug-e-mails.',
        ],

        'test_email' => [
            'send' => 'Test-e-mail versturen',
            'sent' => 'Test-e-mail verzonden naar :count ontvanger(s)',
            'no_recipients' => 'Geen ontvangers geconfigureerd. Voeg eerst minstens één e-mailadres toe.',
            'failed' => 'Verzenden van test-e-mail mislukt',
            'channel_disabled' => 'Dit kanaal is momenteel uitgeschakeld. De test-e-mail wordt alsnog verzonden.',
        ],
    ],

    'logs' => [
        'title' => 'Systeemlogboeken',
        'heading' => 'Logbestanden',
        'entries_title' => 'Logvermeldingen',
        'back_to_list' => 'Terug naar logbestanden',
        'no_entries' => 'Geen logvermeldingen gevonden',
        'unsupported_format' => 'Dit bestand lijkt niet het standaard Laravel-logformaat te gebruiken',
        'search_placeholder' => 'Logvermeldingen doorzoeken...',
        'level_filter' => 'Logniveau',
        'email_recipient' => 'E-mail ontvanger',
        'email_description' => 'Dit logbestand als e-mailbijlage naar de opgegeven ontvanger sturen.',
        'bulk_email_description' => 'De geselecteerde logbestanden als afzonderlijke e-mailbijlagen naar de opgegeven ontvanger sturen.',
        'bulk_email_files' => 'Geselecteerde bestanden',

        'filter' => [
            'date_from' => 'Van',
            'date_to' => 'Tot',
        ],

        'column' => [
            'filename' => 'Bestandsnaam',
            'size' => 'Grootte',
            'modified' => 'Laatst gewijzigd',
            'subfolder' => 'Submap',
            'level' => 'Niveau',
            'timestamp' => 'Tijdstempel',
            'message' => 'Bericht',
        ],

        'action' => [
            'refresh' => 'Vernieuwen',
            'view' => 'Bekijken',
            'delete' => 'Verwijderen',
            'download' => 'Downloaden',
            'email' => 'E-mailen naar',
            'email_send' => 'Versturen',
            'email_sent' => 'Logbestand succesvol gemaild',
            'bulk_email_sent' => ':count logbestand(en) succesvol gemaild',
            'deleted' => 'Logbestand verwijderd',
            'bulk_deleted' => ':count logbestand(en) verwijderd',
        ],

        'confirm' => [
            'delete' => 'Weet u zeker dat u dit logbestand wilt verwijderen? Deze actie kan niet ongedaan worden gemaakt.',
            'bulk_delete' => 'Weet u zeker dat u de geselecteerde logbestanden wilt verwijderen? Deze actie kan niet ongedaan worden gemaakt.',
        ],

        'entry' => [
            'detail' => 'Vermeldingsdetail',
            'line' => 'Regel',
            'trace_frames' => ':count frame|:count frames',
            'copy_trace' => 'Stack Trace kopiëren',
            'copy_entry' => 'Volledige vermelding kopiëren',
            'copied' => 'Gekopieerd!',
        ],
    ],

];
