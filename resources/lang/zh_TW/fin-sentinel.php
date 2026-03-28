<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => '設定',
        'error_channel' => '錯誤頻道',
        'error_channel_title' => '錯誤頻道設定',
        'debug_channel' => 'Debug 頻道',
        'debug_channel_title' => 'Debug 頻道設定',
        'system_logs' => '系統日誌',
        'log_files' => '日誌檔案',
        'log_entries' => '日誌條目',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => '緊急',
            'ALERT' => '警報',
            'CRITICAL' => '嚴重',
            'ERROR' => '錯誤',
            'WARNING' => '警告',
            'NOTICE' => '通知',
            'INFO' => '資訊',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => '錯誤通知',
            'debug' => 'Debug',
            'log_file' => '日誌檔案',
        ],
        'footer' => '由 Fin-Sentinel 發送',

        'label' => [
            'error_message' => '錯誤訊息',
            'class' => '類別',
            'file' => '檔案',
            'context' => '上下文',
            'command' => '命令',
            'url' => 'URL',
            'method' => '方法',
            'ip' => 'IP',
            'params' => '參數',
            'headers' => '標頭',
            'name' => '名稱',
            'email' => '電子郵件',
            'id' => 'ID',
            'user' => '使用者',
            'environment' => '環境',
            'debug_mode' => 'Debug 模式',
            'php_version' => 'PHP 版本',
            'laravel_version' => 'Laravel 版本',
            'laravel' => 'Laravel',
            'peak_memory' => '峰值記憶體',
            'enabled' => '已啟用',
            'disabled' => '已停用',
            'relation' => '關聯: :name',
            'bindings' => '繫結:',
            'trace_number' => '#',
            'trace_location' => '位置',
            'trace_call' => '呼叫',
        ],

        'collection' => [
            'count' => ':count 項',
            'more' => '... 還有 :count 項',
        ],

        'error' => [
            'subject' => ':app - 發生了一個錯誤',
            'guest' => '訪客',
            'console' => '主控台',
            'section_exception' => '例外詳情',
            'section_trace' => '堆疊追蹤',
            'section_request' => '請求上下文',
            'section_user' => '已驗證使用者',
            'section_environment' => '環境',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => '訪客',
            'console' => '主控台',
            'section_data' => 'Debug 資料',
            'section_call_site' => '呼叫位置',
            'section_request' => '請求上下文',
            'section_environment' => '環境',
        ],

        'log_file' => [
            'subject' => ':app - 日誌檔案: :file',
            'bulk_subject' => ':app - 附帶 :count 個日誌檔案',
            'body' => '來自 :app 的日誌檔案 <strong>:file</strong> 已附在郵件中。',
            'body_text' => '來自 :app 的日誌檔案 :file 已附在郵件中。',
        ],
    ],

    'settings' => [
        'recipients' => '收件人',
        'throttling' => '頻率限制',
        'email_address' => '電子郵件地址',
        'add_recipient' => '新增收件人',
        'no_recipients_warning' => '尚未設定收件人 - 在新增至少一個電子郵件地址之前，通知將不會發送。',
        'throttle_rate' => '限制頻率',
        'minutes_suffix' => '分鐘',

        'error' => [
            'enabled' => '啟用錯誤通知',
            'enabled_helper' => '停用後，將不會發送任何錯誤郵件。',
            'recipients_helper' => '新增將接收錯誤通知的電子郵件地址。',
            'throttle_helper' => '重複錯誤郵件之間的最小間隔分鐘數。',
            'throttle_exceptions' => '例外頻率限制',
            'throttle_exceptions_helper' => '啟用後，在限制時間窗口內，同一檔案:行的重複例外不會觸發郵件。',
            'throttle_log_messages' => '日誌訊息頻率限制',
            'throttle_log_messages_helper' => '啟用後，在限制時間窗口內，相同的錯誤日誌訊息不會觸發郵件。',
            'ignored_exceptions' => '忽略的例外',
            'ignored_exceptions_description' => '此清單中的例外不會觸發郵件通知。',
            'ignored_exceptions_label' => '忽略的例外',
            'other_custom' => '其他（自訂）',
            'exception_class' => '例外類別 (FQCN)',
            'class_not_exist' => '此類別不存在。',
            'custom_exception' => '自訂例外',
            'select_exception' => '選擇例外',
            'add_exception' => '新增例外',
        ],

        'debug' => [
            'enabled' => '啟用 Debug 頻道',
            'enabled_helper' => '停用後，Sentinel::debug() 呼叫將被靜默忽略。',
            'recipients_helper' => '新增將接收 Debug 通知的電子郵件地址。',
            'throttle_enabled' => '啟用頻率限制',
            'throttle_enabled_helper' => '停用後，每次 Debug 呼叫都會發送郵件。啟用後，重複呼叫將受到頻率限制。',
            'throttle_helper' => '重複 Debug 郵件之間的最小間隔分鐘數。',
        ],

        'test_email' => [
            'send' => '發送測試郵件',
            'sent' => '測試郵件已發送給 :count 位收件人',
            'no_recipients' => '尚未設定收件人。請先新增至少一個電子郵件地址。',
            'failed' => '測試郵件發送失敗',
            'channel_disabled' => '此頻道目前已停用。測試郵件仍會發送。',
        ],
    ],

    'logs' => [
        'title' => '系統日誌',
        'heading' => '日誌檔案',
        'entries_title' => '日誌條目',
        'back_to_list' => '返回日誌檔案列表',
        'no_entries' => '未找到日誌條目',
        'unsupported_format' => '此檔案似乎未使用標準 Laravel 日誌格式',
        'search_placeholder' => '搜尋日誌條目...',
        'level_filter' => '日誌級別',
        'email_recipient' => '收件人電子郵件',
        'email_description' => '將此日誌檔案作為郵件附件發送給指定收件人。',
        'bulk_email_description' => '將選取的日誌檔案作為個別郵件附件發送給指定收件人。',
        'bulk_email_files' => '已選檔案',

        'filter' => [
            'date_from' => '從',
            'date_to' => '至',
        ],

        'column' => [
            'filename' => '檔案名稱',
            'size' => '大小',
            'modified' => '最後修改',
            'subfolder' => '子資料夾',
            'level' => '級別',
            'timestamp' => '時間戳記',
            'message' => '訊息',
        ],

        'action' => [
            'refresh' => '重新整理',
            'view' => '檢視',
            'delete' => '刪除',
            'download' => '下載',
            'email' => '郵件發送',
            'email_send' => '發送',
            'email_sent' => '日誌檔案已透過郵件發送',
            'bulk_email_sent' => ':count 個日誌檔案已透過郵件發送',
            'deleted' => '日誌檔案已刪除',
            'bulk_deleted' => ':count 個日誌檔案已刪除',
        ],

        'confirm' => [
            'delete' => '確定要刪除此日誌檔案嗎？此操作無法復原。',
            'bulk_delete' => '確定要刪除選取的日誌檔案嗎？此操作無法復原。',
        ],

        'entry' => [
            'detail' => '條目詳情',
            'line' => '行',
            'trace_frames' => ':count 幀',
            'copy_trace' => '複製堆疊追蹤',
            'copy_entry' => '複製完整條目',
            'copied' => '已複製！',
        ],
    ],

];
