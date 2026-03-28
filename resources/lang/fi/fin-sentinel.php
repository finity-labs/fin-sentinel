<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Asetukset',
        'error_channel' => 'Virheilmoitukset',
        'error_channel_title' => 'Virheilmoitusten asetukset',
        'debug_channel' => 'Debug-kanava',
        'debug_channel_title' => 'Debug-kanavan asetukset',
        'system_logs' => 'Järjestelmälokit',
        'log_files' => 'Lokitiedostot',
        'log_entries' => 'Lokimerkinnät',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Hätätilanne',
            'ALERT' => 'Hälytys',
            'CRITICAL' => 'Kriittinen',
            'ERROR' => 'Virhe',
            'WARNING' => 'Varoitus',
            'NOTICE' => 'Huomautus',
            'INFO' => 'Tiedote',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Virheilmoitus',
            'debug' => 'Debug',
            'log_file' => 'Lokitiedosto',
        ],
        'footer' => 'Lähettäjä Fin-Sentinel',

        'label' => [
            'error_message' => 'Virheilmoitus',
            'class' => 'Luokka',
            'file' => 'Tiedosto',
            'context' => 'Konteksti',
            'command' => 'Komento',
            'url' => 'URL',
            'method' => 'Metodi',
            'ip' => 'IP',
            'params' => 'Parametrit',
            'headers' => 'Otsikot',
            'name' => 'Nimi',
            'email' => 'Sähköposti',
            'id' => 'ID',
            'user' => 'Käyttäjä',
            'environment' => 'Ympäristö',
            'debug_mode' => 'Debug-tila',
            'php_version' => 'PHP-versio',
            'laravel_version' => 'Laravel-versio',
            'laravel' => 'Laravel',
            'peak_memory' => 'Muistin huippu',
            'enabled' => 'Käytössä',
            'disabled' => 'Pois käytöstä',
            'relation' => 'Relaatio: :name',
            'bindings' => 'Sidokset:',
            'trace_number' => '#',
            'trace_location' => 'Sijainti',
            'trace_call' => 'Kutsu',
        ],

        'collection' => [
            'count' => ':count kohde|:count kohdetta',
            'more' => '... ja :count kohdetta lisää',
        ],

        'error' => [
            'subject' => ':app - Virhe havaittu',
            'guest' => 'Vieras',
            'console' => 'Konsoli',
            'section_exception' => 'Poikkeuksen tiedot',
            'section_trace' => 'Kutsupino',
            'section_request' => 'Pyyntökonteksti',
            'section_user' => 'Kirjautunut käyttäjä',
            'section_environment' => 'Ympäristö',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Vieras',
            'console' => 'Konsoli',
            'section_data' => 'Debug-tiedot',
            'section_call_site' => 'Kutsukohta',
            'section_request' => 'Pyyntökonteksti',
            'section_environment' => 'Ympäristö',
        ],

        'log_file' => [
            'subject' => ':app - Lokitiedosto: :file',
            'bulk_subject' => ':app - :count lokitiedostoa liitteenä',
            'body' => 'Lokitiedosto <strong>:file</strong> sovelluksesta :app on liitteenä.',
            'body_text' => 'Lokitiedosto :file sovelluksesta :app on liitteenä.',
        ],
    ],

    'settings' => [
        'recipients' => 'Vastaanottajat',
        'throttling' => 'Rajoitus',
        'email_address' => 'Sähköpostiosoite',
        'add_recipient' => 'Lisää vastaanottaja',
        'no_recipients_warning' => 'Vastaanottajia ei ole määritetty — ilmoituksia ei lähetetä ennen kuin vähintään yksi sähköpostiosoite on lisätty.',
        'throttle_rate' => 'Rajoitusnopeus',
        'minutes_suffix' => 'minuuttia',

        'error' => [
            'enabled' => 'Ota virheilmoitukset käyttöön',
            'enabled_helper' => 'Kun pois käytöstä, virhesähköposteja ei lähetetä.',
            'recipients_helper' => 'Lisää sähköpostiosoitteet, jotka vastaanottavat virheilmoituksia.',
            'throttle_helper' => 'Vähimmäisaika minuutteina samojen virhesähköpostien välillä.',
            'throttle_exceptions' => 'Rajoita poikkeuksia',
            'throttle_exceptions_helper' => 'Kun käytössä, samat poikkeukset samassa tiedostossa:rivillä eivät lähetä sähköpostia rajoitusikkunan aikana.',
            'throttle_log_messages' => 'Rajoita lokiviestejä',
            'throttle_log_messages_helper' => 'Kun käytössä, identtiset virhelokiviestit eivät lähetä sähköpostia rajoitusikkunan aikana.',
            'ignored_exceptions' => 'Ohitetut poikkeukset',
            'ignored_exceptions_description' => 'Tämän listan poikkeukset eivät käynnistä sähköposti-ilmoituksia.',
            'ignored_exceptions_label' => 'Ohitetut poikkeukset',
            'other_custom' => 'Muu (mukautettu)',
            'exception_class' => 'Poikkeusluokka (FQCN)',
            'class_not_exist' => 'Tätä luokkaa ei ole olemassa.',
            'custom_exception' => 'Mukautettu poikkeus',
            'select_exception' => 'Valitse poikkeus',
            'add_exception' => 'Lisää poikkeus',
        ],

        'debug' => [
            'enabled' => 'Ota debug-kanava käyttöön',
            'enabled_helper' => 'Kun pois käytöstä, Sentinel::debug()-kutsut ohitetaan hiljaisesti.',
            'recipients_helper' => 'Lisää sähköpostiosoitteet, jotka vastaanottavat debug-ilmoituksia.',
            'throttle_enabled' => 'Ota rajoitus käyttöön',
            'throttle_enabled_helper' => 'Kun pois käytöstä, jokainen debug-kutsu lähettää sähköpostin. Kun käytössä, toistuvat kutsut rajoitetaan.',
            'throttle_helper' => 'Vähimmäisaika minuutteina samojen debug-sähköpostien välillä.',
        ],

        'test_email' => [
            'send' => 'Lähetä testisähköposti',
            'sent' => 'Testisähköposti lähetetty :count vastaanottajalle',
            'no_recipients' => 'Vastaanottajia ei ole määritetty. Lisää ensin vähintään yksi sähköpostiosoite.',
            'failed' => 'Testisähköpostin lähetys epäonnistui',
            'channel_disabled' => 'Tämä kanava on tällä hetkellä pois käytöstä. Testisähköposti lähetetään silti.',
        ],
    ],

    'logs' => [
        'title' => 'Järjestelmälokit',
        'heading' => 'Lokitiedostot',
        'entries_title' => 'Lokimerkinnät',
        'back_to_list' => 'Takaisin lokitiedostoihin',
        'no_entries' => 'Lokimerkintöjä ei löytynyt',
        'unsupported_format' => 'Tämä tiedosto ei näytä käyttävän Laravel-vakiolokimuotoa',
        'search_placeholder' => 'Hae lokimerkinnöistä...',
        'level_filter' => 'Lokitaso',
        'email_recipient' => 'Vastaanottajan sähköposti',
        'email_description' => 'Lähetä tämä lokitiedosto sähköpostin liitteenä määritetylle vastaanottajalle.',
        'bulk_email_description' => 'Lähetä valitut lokitiedostot yksittäisinä sähköpostiliitteinä määritetylle vastaanottajalle.',
        'bulk_email_files' => 'Valitut tiedostot',

        'filter' => [
            'date_from' => 'Alkaen',
            'date_to' => 'Päättyen',
        ],

        'column' => [
            'filename' => 'Tiedostonimi',
            'size' => 'Koko',
            'modified' => 'Viimeksi muokattu',
            'subfolder' => 'Alikansio',
            'level' => 'Taso',
            'timestamp' => 'Aikaleima',
            'message' => 'Viesti',
        ],

        'action' => [
            'refresh' => 'Päivitä',
            'view' => 'Näytä',
            'delete' => 'Poista',
            'download' => 'Lataa',
            'email' => 'Lähetä sähköpostilla',
            'email_send' => 'Lähetä',
            'email_sent' => 'Lokitiedosto lähetetty sähköpostilla',
            'bulk_email_sent' => ':count lokitiedostoa lähetetty sähköpostilla',
            'deleted' => 'Lokitiedosto poistettu',
            'bulk_deleted' => ':count lokitiedostoa poistettu',
        ],

        'confirm' => [
            'delete' => 'Haluatko varmasti poistaa tämän lokitiedoston? Tätä toimintoa ei voi perua.',
            'bulk_delete' => 'Haluatko varmasti poistaa valitut lokitiedostot? Tätä toimintoa ei voi perua.',
        ],

        'entry' => [
            'detail' => 'Merkinnän tiedot',
            'line' => 'Rivi',
            'trace_frames' => ':count kehys|:count kehystä',
            'copy_trace' => 'Kopioi kutsupino',
            'copy_entry' => 'Kopioi koko merkintä',
            'copied' => 'Kopioitu!',
        ],
    ],

];
