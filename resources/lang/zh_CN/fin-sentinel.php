<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => '设置',
        'error_channel' => '错误通道',
        'error_channel_title' => '错误通道设置',
        'debug_channel' => 'Debug 通道',
        'debug_channel_title' => 'Debug 通道设置',
        'system_logs' => '系统日志',
        'log_files' => '日志文件',
        'log_entries' => '日志条目',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => '紧急',
            'ALERT' => '警报',
            'CRITICAL' => '严重',
            'ERROR' => '错误',
            'WARNING' => '警告',
            'NOTICE' => '通知',
            'INFO' => '信息',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => '错误通知',
            'debug' => 'Debug',
            'log_file' => '日志文件',
        ],
        'footer' => '由 Fin-Sentinel 发送',

        'label' => [
            'error_message' => '错误信息',
            'class' => '类',
            'file' => '文件',
            'context' => '上下文',
            'command' => '命令',
            'url' => 'URL',
            'method' => '方法',
            'ip' => 'IP',
            'params' => '参数',
            'headers' => '请求头',
            'name' => '名称',
            'email' => '邮箱',
            'id' => 'ID',
            'user' => '用户',
            'environment' => '环境',
            'debug_mode' => 'Debug 模式',
            'php_version' => 'PHP 版本',
            'laravel_version' => 'Laravel 版本',
            'laravel' => 'Laravel',
            'peak_memory' => '峰值内存',
            'enabled' => '已启用',
            'disabled' => '已禁用',
            'relation' => '关联: :name',
            'bindings' => '绑定:',
            'trace_number' => '#',
            'trace_location' => '位置',
            'trace_call' => '调用',
        ],

        'collection' => [
            'count' => ':count 项',
            'more' => '... 还有 :count 项',
        ],

        'error' => [
            'subject' => ':app - 发生了一个错误',
            'guest' => '访客',
            'console' => '控制台',
            'section_exception' => '异常详情',
            'section_trace' => '堆栈跟踪',
            'section_request' => '请求上下文',
            'section_user' => '已认证用户',
            'section_environment' => '环境',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => '访客',
            'console' => '控制台',
            'section_data' => 'Debug 数据',
            'section_call_site' => '调用位置',
            'section_request' => '请求上下文',
            'section_environment' => '环境',
        ],

        'log_file' => [
            'subject' => ':app - 日志文件: :file',
            'bulk_subject' => ':app - 附带 :count 个日志文件',
            'body' => '来自 :app 的日志文件 <strong>:file</strong> 已附在邮件中。',
            'body_text' => '来自 :app 的日志文件 :file 已附在邮件中。',
        ],
    ],

    'settings' => [
        'recipients' => '收件人',
        'throttling' => '频率限制',
        'email_address' => '邮箱地址',
        'add_recipient' => '添加收件人',
        'no_recipients_warning' => '尚未配置收件人 - 在添加至少一个邮箱地址之前，通知将不会发送。',
        'throttle_rate' => '限制频率',
        'minutes_suffix' => '分钟',

        'error' => [
            'enabled' => '启用错误通知',
            'enabled_helper' => '禁用后，将不会发送任何错误邮件。',
            'recipients_helper' => '添加将接收错误通知的邮箱地址。',
            'throttle_helper' => '重复错误邮件之间的最小间隔分钟数。',
            'throttle_exceptions' => '异常频率限制',
            'throttle_exceptions_helper' => '启用后，在限制时间窗口内，同一文件:行的重复异常不会触发邮件。',
            'throttle_log_messages' => '日志消息频率限制',
            'throttle_log_messages_helper' => '启用后，在限制时间窗口内，相同的错误日志消息不会触发邮件。',
            'ignored_exceptions' => '忽略的异常',
            'ignored_exceptions_description' => '此列表中的异常不会触发邮件通知。',
            'ignored_exceptions_label' => '忽略的异常',
            'other_custom' => '其他（自定义）',
            'exception_class' => '异常类 (FQCN)',
            'class_not_exist' => '此类不存在。',
            'custom_exception' => '自定义异常',
            'select_exception' => '选择异常',
            'add_exception' => '添加例外',
        ],

        'debug' => [
            'enabled' => '启用 Debug 通道',
            'enabled_helper' => '禁用后，Sentinel::debug() 调用将被静默忽略。',
            'recipients_helper' => '添加将接收 Debug 通知的邮箱地址。',
            'throttle_enabled' => '启用频率限制',
            'throttle_enabled_helper' => '禁用后，每次 Debug 调用都会发送邮件。启用后，重复调用将受到频率限制。',
            'throttle_helper' => '重复 Debug 邮件之间的最小间隔分钟数。',
        ],

        'test_email' => [
            'send' => '发送测试邮件',
            'sent' => '测试邮件已发送给 :count 位收件人',
            'no_recipients' => '尚未配置收件人。请先添加至少一个邮箱地址。',
            'failed' => '测试邮件发送失败',
            'channel_disabled' => '此通道当前已禁用。测试邮件仍会发送。',
        ],
    ],

    'logs' => [
        'title' => '系统日志',
        'heading' => '日志文件',
        'entries_title' => '日志条目',
        'back_to_list' => '返回日志文件列表',
        'no_entries' => '未找到日志条目',
        'unsupported_format' => '此文件似乎未使用标准 Laravel 日志格式',
        'search_placeholder' => '搜索日志条目...',
        'level_filter' => '日志级别',
        'email_recipient' => '收件人邮箱',
        'email_description' => '将此日志文件作为邮件附件发送给指定收件人。',
        'bulk_email_description' => '将选中的日志文件作为单独的邮件附件发送给指定收件人。',
        'bulk_email_files' => '已选文件',

        'filter' => [
            'date_from' => '从',
            'date_to' => '至',
        ],

        'column' => [
            'filename' => '文件名',
            'size' => '大小',
            'modified' => '最后修改',
            'subfolder' => '子文件夹',
            'level' => '级别',
            'timestamp' => '时间戳',
            'message' => '消息',
        ],

        'action' => [
            'refresh' => '刷新',
            'view' => '查看',
            'delete' => '删除',
            'download' => '下载',
            'email' => '邮件发送',
            'email_send' => '发送',
            'email_sent' => '日志文件已通过邮件发送',
            'bulk_email_sent' => ':count 个日志文件已通过邮件发送',
            'deleted' => '日志文件已删除',
            'bulk_deleted' => ':count 个日志文件已删除',
        ],

        'confirm' => [
            'delete' => '确定要删除此日志文件吗？此操作无法撤销。',
            'bulk_delete' => '确定要删除选中的日志文件吗？此操作无法撤销。',
        ],

        'entry' => [
            'detail' => '条目详情',
            'line' => '行',
            'trace_frames' => ':count 帧',
            'copy_trace' => '复制堆栈跟踪',
            'copy_entry' => '复制完整条目',
            'copied' => '已复制！',
        ],
    ],

];
