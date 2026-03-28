<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => '설정',
        'error_channel' => '오류 채널',
        'error_channel_title' => '오류 채널 설정',
        'debug_channel' => 'Debug 채널',
        'debug_channel_title' => 'Debug 채널 설정',
        'system_logs' => '시스템 로그',
        'log_files' => '로그 파일',
        'log_entries' => '로그 항목',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => '긴급',
            'ALERT' => '경보',
            'CRITICAL' => '심각',
            'ERROR' => '오류',
            'WARNING' => '경고',
            'NOTICE' => '알림',
            'INFO' => '정보',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => '오류 알림',
            'debug' => 'Debug',
            'log_file' => '로그 파일',
        ],
        'footer' => 'Fin-Sentinel 에서 발송',

        'label' => [
            'error_message' => '오류 메시지',
            'class' => '클래스',
            'file' => '파일',
            'context' => '컨텍스트',
            'command' => '명령',
            'url' => 'URL',
            'method' => '메서드',
            'ip' => 'IP',
            'params' => '매개변수',
            'headers' => '헤더',
            'name' => '이름',
            'email' => '이메일',
            'id' => 'ID',
            'user' => '사용자',
            'environment' => '환경',
            'debug_mode' => 'Debug 모드',
            'php_version' => 'PHP 버전',
            'laravel_version' => 'Laravel 버전',
            'laravel' => 'Laravel',
            'peak_memory' => '최대 메모리',
            'enabled' => '활성화됨',
            'disabled' => '비활성화됨',
            'relation' => '관계: :name',
            'bindings' => '바인딩:',
            'trace_number' => '#',
            'trace_location' => '위치',
            'trace_call' => '호출',
        ],

        'collection' => [
            'count' => ':count 개',
            'more' => '... 외 :count 개',
        ],

        'error' => [
            'subject' => ':app - 오류가 발생했습니다',
            'guest' => '게스트',
            'console' => '콘솔',
            'section_exception' => '예외 상세',
            'section_trace' => '스택 트레이스',
            'section_request' => '요청 컨텍스트',
            'section_user' => '인증된 사용자',
            'section_environment' => '환경',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => '게스트',
            'console' => '콘솔',
            'section_data' => 'Debug 데이터',
            'section_call_site' => '호출 위치',
            'section_request' => '요청 컨텍스트',
            'section_environment' => '환경',
        ],

        'log_file' => [
            'subject' => ':app - 로그 파일: :file',
            'bulk_subject' => ':app - :count 개의 로그 파일 첨부',
            'body' => ':app 의 로그 파일 <strong>:file</strong> 이 첨부되어 있습니다.',
            'body_text' => ':app 의 로그 파일 :file 이 첨부되어 있습니다.',
        ],
    ],

    'settings' => [
        'recipients' => '수신자',
        'throttling' => '발송 제한',
        'email_address' => '이메일 주소',
        'add_recipient' => '수신자 추가',
        'no_recipients_warning' => '수신자가 설정되지 않았습니다 - 이메일 주소를 하나 이상 추가해야 알림이 발송됩니다.',
        'throttle_rate' => '제한 빈도',
        'minutes_suffix' => '분',

        'error' => [
            'enabled' => '오류 알림 활성화',
            'enabled_helper' => '비활성화하면 오류 이메일이 발송되지 않습니다.',
            'recipients_helper' => '오류 알림을 받을 이메일 주소를 추가하세요.',
            'throttle_helper' => '중복 오류 이메일 간 최소 간격(분).',
            'throttle_exceptions' => '예외 발송 제한',
            'throttle_exceptions_helper' => '활성화하면 제한 시간 내에 동일한 파일:줄의 중복 예외는 이메일을 발송하지 않습니다.',
            'throttle_log_messages' => '로그 메시지 발송 제한',
            'throttle_log_messages_helper' => '활성화하면 제한 시간 내에 동일한 오류 로그 메시지는 이메일을 발송하지 않습니다.',
            'ignored_exceptions' => '무시할 예외',
            'ignored_exceptions_description' => '이 목록의 예외는 이메일 알림을 발송하지 않습니다.',
            'ignored_exceptions_label' => '무시할 예외',
            'other_custom' => '기타 (사용자 정의)',
            'exception_class' => '예외 클래스 (FQCN)',
            'class_not_exist' => '이 클래스가 존재하지 않습니다.',
            'custom_exception' => '사용자 정의 예외',
            'select_exception' => '예외 선택',
            'add_exception' => '예외 추가',
        ],

        'debug' => [
            'enabled' => 'Debug 채널 활성화',
            'enabled_helper' => '비활성화하면 Sentinel::debug() 호출이 무시됩니다.',
            'recipients_helper' => 'Debug 알림을 받을 이메일 주소를 추가하세요.',
            'throttle_enabled' => '발송 제한 활성화',
            'throttle_enabled_helper' => '비활성화하면 모든 Debug 호출마다 이메일이 발송됩니다. 활성화하면 중복 호출이 제한됩니다.',
            'throttle_helper' => '중복 Debug 이메일 간 최소 간격(분).',
        ],

        'test_email' => [
            'send' => '테스트 이메일 발송',
            'sent' => ':count 명의 수신자에게 테스트 이메일을 발송했습니다',
            'no_recipients' => '수신자가 설정되지 않았습니다. 먼저 이메일 주소를 하나 이상 추가하세요.',
            'failed' => '테스트 이메일 발송에 실패했습니다',
            'channel_disabled' => '이 채널은 현재 비활성화되어 있습니다. 테스트 이메일은 발송됩니다.',
        ],
    ],

    'logs' => [
        'title' => '시스템 로그',
        'heading' => '로그 파일',
        'entries_title' => '로그 항목',
        'back_to_list' => '로그 파일 목록으로 돌아가기',
        'no_entries' => '로그 항목을 찾을 수 없습니다',
        'unsupported_format' => '이 파일은 표준 Laravel 로그 형식을 사용하지 않는 것 같습니다',
        'search_placeholder' => '로그 항목 검색...',
        'level_filter' => '로그 레벨',
        'email_recipient' => '수신자 이메일',
        'email_description' => '이 로그 파일을 이메일 첨부 파일로 지정된 수신자에게 발송합니다.',
        'bulk_email_description' => '선택한 로그 파일을 개별 이메일 첨부 파일로 지정된 수신자에게 발송합니다.',
        'bulk_email_files' => '선택된 파일',

        'filter' => [
            'date_from' => '시작일',
            'date_to' => '종료일',
        ],

        'column' => [
            'filename' => '파일명',
            'size' => '크기',
            'modified' => '최종 수정',
            'subfolder' => '하위 폴더',
            'level' => '레벨',
            'timestamp' => '타임스탬프',
            'message' => '메시지',
        ],

        'action' => [
            'refresh' => '새로고침',
            'view' => '보기',
            'delete' => '삭제',
            'download' => '다운로드',
            'email' => '이메일 발송',
            'email_send' => '발송',
            'email_sent' => '로그 파일을 이메일로 발송했습니다',
            'bulk_email_sent' => ':count 개의 로그 파일을 이메일로 발송했습니다',
            'deleted' => '로그 파일이 삭제되었습니다',
            'bulk_deleted' => ':count 개의 로그 파일이 삭제되었습니다',
        ],

        'confirm' => [
            'delete' => '이 로그 파일을 삭제하시겠습니까? 이 작업은 되돌릴 수 없습니다.',
            'bulk_delete' => '선택한 로그 파일을 삭제하시겠습니까? 이 작업은 되돌릴 수 없습니다.',
        ],

        'entry' => [
            'detail' => '항목 상세',
            'line' => '줄',
            'trace_frames' => ':count 프레임',
            'copy_trace' => '스택 트레이스 복사',
            'copy_entry' => '전체 항목 복사',
            'copied' => '복사되었습니다!',
        ],
    ],

];
