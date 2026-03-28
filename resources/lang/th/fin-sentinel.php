<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'การตั้งค่า',
        'error_channel' => 'ช่องทางข้อผิดพลาด',
        'error_channel_title' => 'การตั้งค่าช่องทางข้อผิดพลาด',
        'debug_channel' => 'ช่องทาง Debug',
        'debug_channel_title' => 'การตั้งค่าช่องทาง Debug',
        'system_logs' => 'บันทึกระบบ',
        'log_files' => 'ไฟล์บันทึก',
        'log_entries' => 'รายการบันทึก',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'ฉุกเฉิน',
            'ALERT' => 'แจ้งเตือน',
            'CRITICAL' => 'วิกฤต',
            'ERROR' => 'ข้อผิดพลาด',
            'WARNING' => 'คำเตือน',
            'NOTICE' => 'แจ้งให้ทราบ',
            'INFO' => 'ข้อมูล',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'การแจ้งเตือนข้อผิดพลาด',
            'debug' => 'Debug',
            'log_file' => 'ไฟล์บันทึก',
        ],
        'footer' => 'ส่งโดย Fin-Sentinel',

        'label' => [
            'error_message' => 'ข้อความผิดพลาด',
            'class' => 'คลาส',
            'file' => 'ไฟล์',
            'context' => 'บริบท',
            'command' => 'คำสั่ง',
            'url' => 'URL',
            'method' => 'เมธอด',
            'ip' => 'IP',
            'params' => 'พารามิเตอร์',
            'headers' => 'ส่วนหัว',
            'name' => 'ชื่อ',
            'email' => 'อีเมล',
            'id' => 'ID',
            'user' => 'ผู้ใช้',
            'environment' => 'สภาพแวดล้อม',
            'debug_mode' => 'โหมด Debug',
            'php_version' => 'เวอร์ชัน PHP',
            'laravel_version' => 'เวอร์ชัน Laravel',
            'laravel' => 'Laravel',
            'peak_memory' => 'หน่วยความจำสูงสุด',
            'enabled' => 'เปิดใช้งาน',
            'disabled' => 'ปิดใช้งาน',
            'relation' => 'ความสัมพันธ์: :name',
            'bindings' => 'การผูกค่า:',
            'trace_number' => '#',
            'trace_location' => 'ตำแหน่ง',
            'trace_call' => 'การเรียก',
        ],

        'collection' => [
            'count' => ':count รายการ',
            'more' => '... และอีก :count รายการ',
        ],

        'error' => [
            'subject' => ':app - เกิดข้อผิดพลาดขึ้น',
            'guest' => 'ผู้เยี่ยมชม',
            'console' => 'คอนโซล',
            'section_exception' => 'รายละเอียดข้อยกเว้น',
            'section_trace' => 'สแตกเทรซ',
            'section_request' => 'บริบทคำขอ',
            'section_user' => 'ผู้ใช้ที่ยืนยันตัวตน',
            'section_environment' => 'สภาพแวดล้อม',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'ผู้เยี่ยมชม',
            'console' => 'คอนโซล',
            'section_data' => 'ข้อมูล Debug',
            'section_call_site' => 'ตำแหน่งที่เรียก',
            'section_request' => 'บริบทคำขอ',
            'section_environment' => 'สภาพแวดล้อม',
        ],

        'log_file' => [
            'subject' => ':app - ไฟล์บันทึก: :file',
            'bulk_subject' => ':app - แนบไฟล์บันทึก :count ไฟล์',
            'body' => 'ไฟล์บันทึก <strong>:file</strong> จาก :app ได้แนบมาในอีเมลนี้แล้ว',
            'body_text' => 'ไฟล์บันทึก :file จาก :app ได้แนบมาในอีเมลนี้แล้ว',
        ],
    ],

    'settings' => [
        'recipients' => 'ผู้รับ',
        'throttling' => 'การจำกัดความถี่',
        'email_address' => 'ที่อยู่อีเมล',
        'add_recipient' => 'เพิ่มผู้รับ',
        'no_recipients_warning' => 'ยังไม่ได้ตั้งค่าผู้รับ - การแจ้งเตือนจะไม่ถูกส่งจนกว่าจะเพิ่มอีเมลอย่างน้อยหนึ่งรายการ',
        'throttle_rate' => 'อัตราการจำกัด',
        'minutes_suffix' => 'นาที',

        'error' => [
            'enabled' => 'เปิดใช้งานการแจ้งเตือนข้อผิดพลาด',
            'enabled_helper' => 'เมื่อปิดใช้งาน จะไม่มีการส่งอีเมลข้อผิดพลาด',
            'recipients_helper' => 'เพิ่มที่อยู่อีเมลที่จะรับการแจ้งเตือนข้อผิดพลาด',
            'throttle_helper' => 'จำนวนนาทีขั้นต่ำระหว่างอีเมลข้อผิดพลาดที่ซ้ำกัน',
            'throttle_exceptions' => 'การจำกัดข้อยกเว้น',
            'throttle_exceptions_helper' => 'เมื่อเปิดใช้งาน ข้อยกเว้นที่ซ้ำกันในไฟล์:บรรทัดเดียวกันจะไม่ส่งอีเมลภายในช่วงเวลาที่จำกัด',
            'throttle_log_messages' => 'การจำกัดข้อความบันทึก',
            'throttle_log_messages_helper' => 'เมื่อเปิดใช้งาน ข้อความบันทึกข้อผิดพลาดที่เหมือนกันจะไม่ส่งอีเมลภายในช่วงเวลาที่จำกัด',
            'ignored_exceptions' => 'ข้อยกเว้นที่ถูกเพิกเฉย',
            'ignored_exceptions_description' => 'ข้อยกเว้นในรายการนี้จะไม่ส่งการแจ้งเตือนทางอีเมล',
            'ignored_exceptions_label' => 'ข้อยกเว้นที่ถูกเพิกเฉย',
            'other_custom' => 'อื่นๆ (กำหนดเอง)',
            'exception_class' => 'คลาสข้อยกเว้น (FQCN)',
            'class_not_exist' => 'คลาสนี้ไม่มีอยู่',
            'custom_exception' => 'ข้อยกเว้นที่กำหนดเอง',
            'select_exception' => 'เลือกข้อยกเว้น',
            'add_exception' => 'เพิ่มข้อยกเว้น',
        ],

        'debug' => [
            'enabled' => 'เปิดใช้งานช่องทาง Debug',
            'enabled_helper' => 'เมื่อปิดใช้งาน การเรียก Sentinel::debug() จะถูกเพิกเฉย',
            'recipients_helper' => 'เพิ่มที่อยู่อีเมลที่จะรับการแจ้งเตือน Debug',
            'throttle_enabled' => 'เปิดใช้งานการจำกัดความถี่',
            'throttle_enabled_helper' => 'เมื่อปิดใช้งาน ทุกการเรียก Debug จะส่งอีเมล เมื่อเปิดใช้งาน การเรียกที่ซ้ำกันจะถูกจำกัด',
            'throttle_helper' => 'จำนวนนาทีขั้นต่ำระหว่างอีเมล Debug ที่ซ้ำกัน',
        ],

        'test_email' => [
            'send' => 'ส่งอีเมลทดสอบ',
            'sent' => 'ส่งอีเมลทดสอบไปยังผู้รับ :count ราย',
            'no_recipients' => 'ยังไม่ได้ตั้งค่าผู้รับ กรุณาเพิ่มที่อยู่อีเมลอย่างน้อยหนึ่งรายการก่อน',
            'failed' => 'ส่งอีเมลทดสอบไม่สำเร็จ',
            'channel_disabled' => 'ช่องทางนี้ถูกปิดใช้งานอยู่ อีเมลทดสอบจะยังคงถูกส่งออกไป',
        ],
    ],

    'logs' => [
        'title' => 'บันทึกระบบ',
        'heading' => 'ไฟล์บันทึก',
        'entries_title' => 'รายการบันทึก',
        'back_to_list' => 'กลับไปยังรายการไฟล์บันทึก',
        'no_entries' => 'ไม่พบรายการบันทึก',
        'unsupported_format' => 'ไฟล์นี้ดูเหมือนจะไม่ใช้รูปแบบบันทึกมาตรฐานของ Laravel',
        'search_placeholder' => 'ค้นหารายการบันทึก...',
        'level_filter' => 'ระดับบันทึก',
        'email_recipient' => 'อีเมลผู้รับ',
        'email_description' => 'ส่งไฟล์บันทึกนี้เป็นไฟล์แนบอีเมลไปยังผู้รับที่ระบุ',
        'bulk_email_description' => 'ส่งไฟล์บันทึกที่เลือกเป็นไฟล์แนบอีเมลแยกรายการไปยังผู้รับที่ระบุ',
        'bulk_email_files' => 'ไฟล์ที่เลือก',

        'filter' => [
            'date_from' => 'ตั้งแต่',
            'date_to' => 'ถึง',
        ],

        'column' => [
            'filename' => 'ชื่อไฟล์',
            'size' => 'ขนาด',
            'modified' => 'แก้ไขล่าสุด',
            'subfolder' => 'โฟลเดอร์ย่อย',
            'level' => 'ระดับ',
            'timestamp' => 'เวลา',
            'message' => 'ข้อความ',
        ],

        'action' => [
            'refresh' => 'รีเฟรช',
            'view' => 'ดู',
            'delete' => 'ลบ',
            'download' => 'ดาวน์โหลด',
            'email' => 'ส่งอีเมล',
            'email_send' => 'ส่ง',
            'email_sent' => 'ส่งไฟล์บันทึกทางอีเมลเรียบร้อยแล้ว',
            'bulk_email_sent' => 'ส่งไฟล์บันทึก :count ไฟล์ทางอีเมลเรียบร้อยแล้ว',
            'deleted' => 'ลบไฟล์บันทึกแล้ว',
            'bulk_deleted' => 'ลบไฟล์บันทึก :count ไฟล์แล้ว',
        ],

        'confirm' => [
            'delete' => 'คุณแน่ใจหรือไม่ว่าต้องการลบไฟล์บันทึกนี้? การดำเนินการนี้ไม่สามารถยกเลิกได้',
            'bulk_delete' => 'คุณแน่ใจหรือไม่ว่าต้องการลบไฟล์บันทึกที่เลือก? การดำเนินการนี้ไม่สามารถยกเลิกได้',
        ],

        'entry' => [
            'detail' => 'รายละเอียดรายการ',
            'line' => 'บรรทัด',
            'trace_frames' => ':count เฟรม',
            'copy_trace' => 'คัดลอกสแตกเทรซ',
            'copy_entry' => 'คัดลอกรายการทั้งหมด',
            'copied' => 'คัดลอกแล้ว!',
        ],
    ],

];
