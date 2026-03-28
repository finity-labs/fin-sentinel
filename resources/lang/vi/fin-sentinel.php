<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'Cài đặt',
        'error_channel' => 'Kênh lỗi',
        'error_channel_title' => 'Cài đặt kênh lỗi',
        'debug_channel' => 'Kênh Debug',
        'debug_channel_title' => 'Cài đặt kênh Debug',
        'system_logs' => 'Nhật ký hệ thống',
        'log_files' => 'Tệp nhật ký',
        'log_entries' => 'Mục nhật ký',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'Khẩn cấp',
            'ALERT' => 'Cảnh báo cao',
            'CRITICAL' => 'Nghiêm trọng',
            'ERROR' => 'Lỗi',
            'WARNING' => 'Cảnh báo',
            'NOTICE' => 'Lưu ý',
            'INFO' => 'Thông tin',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'Thông báo lỗi',
            'debug' => 'Debug',
            'log_file' => 'Tệp nhật ký',
        ],
        'footer' => 'Gửi bởi Fin-Sentinel',

        'label' => [
            'error_message' => 'Thông báo lỗi',
            'class' => 'Lớp',
            'file' => 'Tệp',
            'context' => 'Ngữ cảnh',
            'command' => 'Lệnh',
            'url' => 'URL',
            'method' => 'Phương thức',
            'ip' => 'IP',
            'params' => 'Tham số',
            'headers' => 'Tiêu đề',
            'name' => 'Tên',
            'email' => 'Email',
            'id' => 'ID',
            'user' => 'Người dùng',
            'environment' => 'Môi trường',
            'debug_mode' => 'Chế độ Debug',
            'php_version' => 'Phiên bản PHP',
            'laravel_version' => 'Phiên bản Laravel',
            'laravel' => 'Laravel',
            'peak_memory' => 'Bộ nhớ đỉnh',
            'enabled' => 'Đã bật',
            'disabled' => 'Đã tắt',
            'relation' => 'Quan hệ: :name',
            'bindings' => 'Ràng buộc:',
            'trace_number' => '#',
            'trace_location' => 'Vị trí',
            'trace_call' => 'Lời gọi',
        ],

        'collection' => [
            'count' => ':count mục',
            'more' => '... và :count mục nữa',
        ],

        'error' => [
            'subject' => ':app - Đã xảy ra lỗi',
            'guest' => 'Khách',
            'console' => 'Console',
            'section_exception' => 'Chi tiết ngoại lệ',
            'section_trace' => 'Stack Trace',
            'section_request' => 'Ngữ cảnh yêu cầu',
            'section_user' => 'Người dùng đã xác thực',
            'section_environment' => 'Môi trường',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'Khách',
            'console' => 'Console',
            'section_data' => 'Dữ liệu Debug',
            'section_call_site' => 'Vị trí gọi',
            'section_request' => 'Ngữ cảnh yêu cầu',
            'section_environment' => 'Môi trường',
        ],

        'log_file' => [
            'subject' => ':app - Tệp nhật ký: :file',
            'bulk_subject' => ':app - Đính kèm :count tệp nhật ký',
            'body' => 'Tệp nhật ký <strong>:file</strong> từ :app đã được đính kèm.',
            'body_text' => 'Tệp nhật ký :file từ :app đã được đính kèm.',
        ],
    ],

    'settings' => [
        'recipients' => 'Người nhận',
        'throttling' => 'Giới hạn tần suất',
        'email_address' => 'Địa chỉ email',
        'add_recipient' => 'Thêm người nhận',
        'no_recipients_warning' => 'Chưa cấu hình người nhận - thông báo sẽ không được gửi cho đến khi thêm ít nhất một địa chỉ email.',
        'throttle_rate' => 'Tần suất giới hạn',
        'minutes_suffix' => 'phút',

        'error' => [
            'enabled' => 'Bật thông báo lỗi',
            'enabled_helper' => 'Khi tắt, sẽ không gửi email lỗi nào.',
            'recipients_helper' => 'Thêm địa chỉ email sẽ nhận thông báo lỗi.',
            'throttle_helper' => 'Số phút tối thiểu giữa các email lỗi trùng lặp.',
            'throttle_exceptions' => 'Giới hạn ngoại lệ',
            'throttle_exceptions_helper' => 'Khi bật, các ngoại lệ trùng lặp tại cùng tệp:dòng sẽ không gửi email trong khoảng thời gian giới hạn.',
            'throttle_log_messages' => 'Giới hạn thông điệp nhật ký',
            'throttle_log_messages_helper' => 'Khi bật, các thông điệp nhật ký lỗi giống nhau sẽ không gửi email trong khoảng thời gian giới hạn.',
            'ignored_exceptions' => 'Ngoại lệ bị bỏ qua',
            'ignored_exceptions_description' => 'Các ngoại lệ trong danh sách này sẽ không gửi thông báo email.',
            'ignored_exceptions_label' => 'Ngoại lệ bị bỏ qua',
            'other_custom' => 'Khác (tùy chỉnh)',
            'exception_class' => 'Lớp ngoại lệ (FQCN)',
            'class_not_exist' => 'Lớp này không tồn tại.',
            'custom_exception' => 'Ngoại lệ tùy chỉnh',
            'select_exception' => 'Chọn ngoại lệ',
            'add_exception' => 'Thêm ngoại lệ',
        ],

        'debug' => [
            'enabled' => 'Bật kênh Debug',
            'enabled_helper' => 'Khi tắt, các lời gọi Sentinel::debug() sẽ bị bỏ qua.',
            'recipients_helper' => 'Thêm địa chỉ email sẽ nhận thông báo Debug.',
            'throttle_enabled' => 'Bật giới hạn tần suất',
            'throttle_enabled_helper' => 'Khi tắt, mỗi lời gọi Debug đều gửi email. Khi bật, các lời gọi trùng lặp sẽ bị giới hạn.',
            'throttle_helper' => 'Số phút tối thiểu giữa các email Debug trùng lặp.',
        ],

        'test_email' => [
            'send' => 'Gửi email thử nghiệm',
            'sent' => 'Đã gửi email thử nghiệm đến :count người nhận',
            'no_recipients' => 'Chưa cấu hình người nhận. Vui lòng thêm ít nhất một địa chỉ email trước.',
            'failed' => 'Gửi email thử nghiệm thất bại',
            'channel_disabled' => 'Kênh này hiện đang tắt. Email thử nghiệm vẫn sẽ được gửi.',
        ],
    ],

    'logs' => [
        'title' => 'Nhật ký hệ thống',
        'heading' => 'Tệp nhật ký',
        'entries_title' => 'Mục nhật ký',
        'back_to_list' => 'Quay lại danh sách tệp nhật ký',
        'no_entries' => 'Không tìm thấy mục nhật ký',
        'unsupported_format' => 'Tệp này dường như không sử dụng định dạng nhật ký chuẩn của Laravel',
        'search_placeholder' => 'Tìm kiếm mục nhật ký...',
        'level_filter' => 'Mức nhật ký',
        'email_recipient' => 'Email người nhận',
        'email_description' => 'Gửi tệp nhật ký này dưới dạng tệp đính kèm email đến người nhận được chỉ định.',
        'bulk_email_description' => 'Gửi các tệp nhật ký đã chọn dưới dạng tệp đính kèm email riêng lẻ đến người nhận được chỉ định.',
        'bulk_email_files' => 'Tệp đã chọn',

        'filter' => [
            'date_from' => 'Từ',
            'date_to' => 'Đến',
        ],

        'column' => [
            'filename' => 'Tên tệp',
            'size' => 'Kích thước',
            'modified' => 'Sửa đổi lần cuối',
            'subfolder' => 'Thư mục con',
            'level' => 'Mức',
            'timestamp' => 'Thời gian',
            'message' => 'Thông điệp',
        ],

        'action' => [
            'refresh' => 'Làm mới',
            'view' => 'Xem',
            'delete' => 'Xóa',
            'download' => 'Tải xuống',
            'email' => 'Gửi email',
            'email_send' => 'Gửi',
            'email_sent' => 'Đã gửi tệp nhật ký qua email thành công',
            'bulk_email_sent' => 'Đã gửi :count tệp nhật ký qua email thành công',
            'deleted' => 'Đã xóa tệp nhật ký',
            'bulk_deleted' => 'Đã xóa :count tệp nhật ký',
        ],

        'confirm' => [
            'delete' => 'Bạn có chắc chắn muốn xóa tệp nhật ký này? Hành động này không thể hoàn tác.',
            'bulk_delete' => 'Bạn có chắc chắn muốn xóa các tệp nhật ký đã chọn? Hành động này không thể hoàn tác.',
        ],

        'entry' => [
            'detail' => 'Chi tiết mục',
            'line' => 'Dòng',
            'trace_frames' => ':count khung',
            'copy_trace' => 'Sao chép Stack Trace',
            'copy_entry' => 'Sao chép toàn bộ mục',
            'copied' => 'Đã sao chép!',
        ],
    ],

];
