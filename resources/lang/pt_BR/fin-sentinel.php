<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Configurações',
        'error_channel' => 'Canal de erros',
        'error_channel_title' => 'Configurações do canal de erros',
        'debug_channel' => 'Canal Debug',
        'debug_channel_title' => 'Configurações do canal Debug',
        'system_logs' => 'Logs do sistema',
        'log_files' => 'Arquivos de log',
        'log_entries' => 'Entradas de log',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Emergência',
            'ALERT' => 'Alerta',
            'CRITICAL' => 'Crítico',
            'ERROR' => 'Erro',
            'WARNING' => 'Aviso',
            'NOTICE' => 'Nota',
            'INFO' => 'Info',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Notificação de erro',
            'debug' => 'Debug',
            'log_file' => 'Arquivo de log',
        ],
        'footer' => 'Enviado por Fin-Sentinel',

        'label' => [
            'error_message' => 'Mensagem de erro',
            'class' => 'Classe',
            'file' => 'Arquivo',
            'context' => 'Contexto',
            'command' => 'Comando',
            'url' => 'URL',
            'method' => 'Método',
            'ip' => 'IP',
            'params' => 'Parâmetros',
            'headers' => 'Cabeçalhos',
            'name' => 'Nome',
            'email' => 'E-mail',
            'id' => 'ID',
            'user' => 'Usuário',
            'environment' => 'Ambiente',
            'debug_mode' => 'Modo Debug',
            'php_version' => 'Versão PHP',
            'laravel_version' => 'Versão Laravel',
            'laravel' => 'Laravel',
            'peak_memory' => 'Memória máxima',
            'enabled' => 'Ativado',
            'disabled' => 'Desativado',
            'relation' => 'Relação: :name',
            'bindings' => 'Bindings:',
            'trace_number' => '#',
            'trace_location' => 'Localização',
            'trace_call' => 'Chamada',
        ],

        'collection' => [
            'count' => ':count item|:count itens',
            'more' => '... e mais :count itens',
        ],

        'error' => [
            'subject' => ':app - Ocorreu um erro',
            'guest' => 'Visitante',
            'console' => 'Console',
            'section_exception' => 'Detalhes da exceção',
            'section_trace' => 'Stack Trace',
            'section_request' => 'Contexto da requisição',
            'section_user' => 'Usuário autenticado',
            'section_environment' => 'Ambiente',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Visitante',
            'console' => 'Console',
            'section_data' => 'Dados de Debug',
            'section_call_site' => 'Local da chamada',
            'section_request' => 'Contexto da requisição',
            'section_environment' => 'Ambiente',
        ],

        'log_file' => [
            'subject' => ':app - Arquivo de log: :file',
            'bulk_subject' => ':app - :count arquivos de log anexados',
            'body' => 'O arquivo de log <strong>:file</strong> do :app está em anexo.',
            'body_text' => 'O arquivo de log :file do :app está em anexo.',
        ],
    ],

    'settings' => [
        'recipients' => 'Destinatários',
        'throttling' => 'Limitação',
        'email_address' => 'Endereço de e-mail',
        'add_recipient' => 'Adicionar destinatário',
        'no_recipients_warning' => 'Nenhum destinatário configurado — as notificações não serão enviadas até que pelo menos um endereço de e-mail seja adicionado.',
        'throttle_rate' => 'Taxa de limitação',
        'minutes_suffix' => 'minutos',

        'error' => [
            'enabled' => 'Ativar notificações de erro',
            'enabled_helper' => 'Quando desativado, nenhum e-mail de erro será enviado.',
            'recipients_helper' => 'Adicione os endereços de e-mail que receberão as notificações de erro.',
            'throttle_helper' => 'Minutos mínimos entre e-mails de erro duplicados.',
            'throttle_exceptions' => 'Limitar exceções',
            'throttle_exceptions_helper' => 'Quando ativado, exceções duplicadas no mesmo arquivo:linha não irão disparar e-mails dentro da janela de limitação.',
            'throttle_log_messages' => 'Limitar mensagens de log',
            'throttle_log_messages_helper' => 'Quando ativado, mensagens de erro idênticas não irão disparar e-mails dentro da janela de limitação.',
            'ignored_exceptions' => 'Exceções ignoradas',
            'ignored_exceptions_description' => 'As exceções nesta lista não irão disparar notificações por e-mail.',
            'ignored_exceptions_label' => 'Exceções ignoradas',
            'other_custom' => 'Outro (personalizado)',
            'exception_class' => 'Classe de exceção (FQCN)',
            'class_not_exist' => 'Esta classe não existe.',
            'custom_exception' => 'Exceção personalizada',
            'select_exception' => 'Selecionar exceção',
            'add_exception' => 'Adicionar exceção',
        ],

        'debug' => [
            'enabled' => 'Ativar canal Debug',
            'enabled_helper' => 'Quando desativado, as chamadas a Sentinel::debug() serão silenciosamente ignoradas.',
            'recipients_helper' => 'Adicione os endereços de e-mail que receberão as notificações Debug.',
            'throttle_enabled' => 'Ativar limitação',
            'throttle_enabled_helper' => 'Quando desativado, cada chamada Debug envia um e-mail. Quando ativado, chamadas duplicadas são limitadas.',
            'throttle_helper' => 'Minutos mínimos entre e-mails Debug duplicados.',
        ],

        'test_email' => [
            'send' => 'Enviar e-mail de teste',
            'sent' => 'E-mail de teste enviado para :count destinatário(s)',
            'no_recipients' => 'Nenhum destinatário configurado. Adicione pelo menos um endereço de e-mail primeiro.',
            'failed' => 'Falha ao enviar e-mail de teste',
            'channel_disabled' => 'Este canal está atualmente desativado. O e-mail de teste será enviado mesmo assim.',
        ],
    ],

    'logs' => [
        'title' => 'Logs do sistema',
        'heading' => 'Arquivos de log',
        'entries_title' => 'Entradas de log',
        'back_to_list' => 'Voltar para arquivos de log',
        'no_entries' => 'Nenhuma entrada de log encontrada',
        'unsupported_format' => 'Este arquivo não parece usar o formato de log padrão do Laravel',
        'search_placeholder' => 'Pesquisar entradas de log...',
        'level_filter' => 'Nível de log',
        'email_recipient' => 'E-mail do destinatário',
        'email_description' => 'Enviar este arquivo de log como anexo de e-mail para o destinatário especificado.',
        'bulk_email_description' => 'Enviar os arquivos de log selecionados como anexos individuais para o destinatário especificado.',
        'bulk_email_files' => 'Arquivos selecionados',

        'filter' => [
            'date_from' => 'De',
            'date_to' => 'Até',
        ],

        'column' => [
            'filename' => 'Nome do arquivo',
            'size' => 'Tamanho',
            'modified' => 'Última modificação',
            'subfolder' => 'Subpasta',
            'level' => 'Nível',
            'timestamp' => 'Data e hora',
            'message' => 'Mensagem',
        ],

        'action' => [
            'refresh' => 'Atualizar',
            'view' => 'Visualizar',
            'delete' => 'Excluir',
            'download' => 'Baixar',
            'email' => 'Enviar por e-mail para',
            'email_send' => 'Enviar',
            'email_sent' => 'Arquivo de log enviado por e-mail com sucesso',
            'bulk_email_sent' => ':count arquivo(s) de log enviado(s) por e-mail com sucesso',
            'deleted' => 'Arquivo de log excluído',
            'bulk_deleted' => ':count arquivo(s) de log excluído(s)',
        ],

        'confirm' => [
            'delete' => 'Tem certeza de que deseja excluir este arquivo de log? Esta ação não pode ser desfeita.',
            'bulk_delete' => 'Tem certeza de que deseja excluir os arquivos de log selecionados? Esta ação não pode ser desfeita.',
        ],

        'entry' => [
            'detail' => 'Detalhe da entrada',
            'line' => 'Linha',
            'trace_frames' => ':count frame|:count frames',
            'copy_trace' => 'Copiar Stack Trace',
            'copy_entry' => 'Copiar entrada completa',
            'copied' => 'Copiado!',
        ],
    ],

];
