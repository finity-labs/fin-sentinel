<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => '設定',
        'error_channel' => 'エラーチャンネル',
        'error_channel_title' => 'エラーチャンネル設定',
        'debug_channel' => 'Debug チャンネル',
        'debug_channel_title' => 'Debug チャンネル設定',
        'system_logs' => 'システムログ',
        'log_files' => 'ログファイル',
        'log_entries' => 'ログエントリー',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => '緊急',
            'ALERT' => 'アラート',
            'CRITICAL' => '重大',
            'ERROR' => 'エラー',
            'WARNING' => '警告',
            'NOTICE' => '通知',
            'INFO' => '情報',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'エラー通知',
            'debug' => 'Debug',
            'log_file' => 'ログファイル',
        ],
        'footer' => 'Fin-Sentinel から送信',

        'label' => [
            'error_message' => 'エラーメッセージ',
            'class' => 'クラス',
            'file' => 'ファイル',
            'context' => 'コンテキスト',
            'command' => 'コマンド',
            'url' => 'URL',
            'method' => 'メソッド',
            'ip' => 'IP',
            'params' => 'パラメータ',
            'headers' => 'ヘッダー',
            'name' => '名前',
            'email' => 'メール',
            'id' => 'ID',
            'user' => 'ユーザー',
            'environment' => '環境',
            'debug_mode' => 'Debug モード',
            'php_version' => 'PHP バージョン',
            'laravel_version' => 'Laravel バージョン',
            'laravel' => 'Laravel',
            'peak_memory' => 'ピークメモリ',
            'enabled' => '有効',
            'disabled' => '無効',
            'relation' => 'リレーション: :name',
            'bindings' => 'バインディング:',
            'trace_number' => '#',
            'trace_location' => '場所',
            'trace_call' => '呼び出し',
        ],

        'collection' => [
            'count' => ':count 件',
            'more' => '... 他 :count 件',
        ],

        'error' => [
            'subject' => ':app - エラーが発生しました',
            'guest' => 'ゲスト',
            'console' => 'コンソール',
            'section_exception' => '例外の詳細',
            'section_trace' => 'スタックトレース',
            'section_request' => 'リクエストコンテキスト',
            'section_user' => '認証済みユーザー',
            'section_environment' => '環境',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'ゲスト',
            'console' => 'コンソール',
            'section_data' => 'Debug データ',
            'section_call_site' => '呼び出し元',
            'section_request' => 'リクエストコンテキスト',
            'section_environment' => '環境',
        ],

        'log_file' => [
            'subject' => ':app - ログファイル: :file',
            'bulk_subject' => ':app - :count 件のログファイルを添付',
            'body' => ':app のログファイル <strong>:file</strong> を添付しています。',
            'body_text' => ':app のログファイル :file を添付しています。',
        ],
    ],

    'settings' => [
        'recipients' => '受信者',
        'throttling' => '送信制限',
        'email_address' => 'メールアドレス',
        'add_recipient' => '受信者を追加',
        'no_recipients_warning' => '受信者が設定されていません - メールアドレスを少なくとも1つ追加するまで、通知は送信されません。',
        'throttle_rate' => '制限頻度',
        'minutes_suffix' => '分',

        'error' => [
            'enabled' => 'エラー通知を有効にする',
            'enabled_helper' => '無効にすると、エラーメールは送信されません。',
            'recipients_helper' => 'エラー通知を受け取るメールアドレスを追加してください。',
            'throttle_helper' => '重複するエラーメール間の最小間隔（分）。',
            'throttle_exceptions' => '例外の送信制限',
            'throttle_exceptions_helper' => '有効にすると、制限時間内に同じファイル:行で発生した重複例外はメールを送信しません。',
            'throttle_log_messages' => 'ログメッセージの送信制限',
            'throttle_log_messages_helper' => '有効にすると、制限時間内に同一のエラーログメッセージはメールを送信しません。',
            'ignored_exceptions' => '無視する例外',
            'ignored_exceptions_description' => 'このリストの例外はメール通知を送信しません。',
            'ignored_exceptions_label' => '無視する例外',
            'other_custom' => 'その他（カスタム）',
            'exception_class' => '例外クラス (FQCN)',
            'class_not_exist' => 'このクラスは存在しません。',
            'custom_exception' => 'カスタム例外',
            'select_exception' => '例外を選択',
            'add_exception' => '例外を追加',
        ],

        'debug' => [
            'enabled' => 'Debug チャンネルを有効にする',
            'enabled_helper' => '無効にすると、Sentinel::debug() の呼び出しは無視されます。',
            'recipients_helper' => 'Debug 通知を受け取るメールアドレスを追加してください。',
            'throttle_enabled' => '送信制限を有効にする',
            'throttle_enabled_helper' => '無効にすると、Debug の呼び出しごとにメールが送信されます。有効にすると、重複する呼び出しは制限されます。',
            'throttle_helper' => '重複する Debug メール間の最小間隔（分）。',
        ],

        'test_email' => [
            'send' => 'テストメールを送信',
            'sent' => ':count 件の受信者にテストメールを送信しました',
            'no_recipients' => '受信者が設定されていません。先にメールアドレスを少なくとも1つ追加してください。',
            'failed' => 'テストメールの送信に失敗しました',
            'channel_disabled' => 'このチャンネルは現在無効です。テストメールは送信されます。',
        ],
    ],

    'logs' => [
        'title' => 'システムログ',
        'heading' => 'ログファイル',
        'entries_title' => 'ログエントリー',
        'back_to_list' => 'ログファイル一覧に戻る',
        'no_entries' => 'ログエントリーが見つかりません',
        'unsupported_format' => 'このファイルは標準の Laravel ログ形式を使用していないようです',
        'search_placeholder' => 'ログエントリーを検索...',
        'level_filter' => 'ログレベル',
        'email_recipient' => '受信者メールアドレス',
        'email_description' => 'このログファイルをメールの添付ファイルとして指定の受信者に送信します。',
        'bulk_email_description' => '選択したログファイルを個別のメール添付ファイルとして指定の受信者に送信します。',
        'bulk_email_files' => '選択されたファイル',

        'filter' => [
            'date_from' => '開始日',
            'date_to' => '終了日',
        ],

        'column' => [
            'filename' => 'ファイル名',
            'size' => 'サイズ',
            'modified' => '最終更新',
            'subfolder' => 'サブフォルダ',
            'level' => 'レベル',
            'timestamp' => 'タイムスタンプ',
            'message' => 'メッセージ',
        ],

        'action' => [
            'refresh' => '更新',
            'view' => '表示',
            'delete' => '削除',
            'download' => 'ダウンロード',
            'email' => 'メール送信',
            'email_send' => '送信',
            'email_sent' => 'ログファイルをメールで送信しました',
            'bulk_email_sent' => ':count 件のログファイルをメールで送信しました',
            'deleted' => 'ログファイルを削除しました',
            'bulk_deleted' => ':count 件のログファイルを削除しました',
        ],

        'confirm' => [
            'delete' => 'このログファイルを削除してよろしいですか？この操作は取り消せません。',
            'bulk_delete' => '選択したログファイルを削除してよろしいですか？この操作は取り消せません。',
        ],

        'entry' => [
            'detail' => 'エントリー詳細',
            'line' => '行',
            'trace_frames' => ':count フレーム',
            'copy_trace' => 'スタックトレースをコピー',
            'copy_entry' => 'エントリー全体をコピー',
            'copied' => 'コピーしました！',
        ],
    ],

];
