<?php

declare(strict_types=1);

return [

    'navigation' => [
        'settings' => 'সেটিংস',
        'error_channel' => 'ত্রুটি চ্যানেল',
        'error_channel_title' => 'ত্রুটি চ্যানেল সেটিংস',
        'debug_channel' => 'Debug চ্যানেল',
        'debug_channel_title' => 'Debug চ্যানেল সেটিংস',
        'system_logs' => 'সিস্টেম লগ',
        'log_files' => 'লগ ফাইল',
        'log_entries' => 'লগ এন্ট্রি',
    ],

    'enums' => [
        'navigation_group' => [
            'sentinel' => 'Sentinel',
        ],
        'log_level' => [
            'EMERGENCY' => 'জরুরি',
            'ALERT' => 'সতর্কতা',
            'CRITICAL' => 'গুরুতর',
            'ERROR' => 'ত্রুটি',
            'WARNING' => 'সতর্কবার্তা',
            'NOTICE' => 'বিজ্ঞপ্তি',
            'INFO' => 'তথ্য',
            'DEBUG' => 'Debug',
        ],
    ],

    'email' => [
        'header' => [
            'error' => 'ত্রুটি বিজ্ঞপ্তি',
            'debug' => 'Debug',
            'log_file' => 'লগ ফাইল',
        ],
        'footer' => 'Fin-Sentinel দ্বারা প্রেরিত',

        'label' => [
            'error_message' => 'ত্রুটি বার্তা',
            'class' => 'ক্লাস',
            'file' => 'ফাইল',
            'context' => 'প্রসঙ্গ',
            'command' => 'কমান্ড',
            'url' => 'URL',
            'method' => 'মেথড',
            'ip' => 'IP',
            'params' => 'প্যারামিটার',
            'headers' => 'হেডার',
            'name' => 'নাম',
            'email' => 'ইমেইল',
            'id' => 'ID',
            'user' => 'ব্যবহারকারী',
            'environment' => 'এনভায়রনমেন্ট',
            'debug_mode' => 'Debug মোড',
            'php_version' => 'PHP সংস্করণ',
            'laravel_version' => 'Laravel সংস্করণ',
            'laravel' => 'Laravel',
            'peak_memory' => 'পিক মেমোরি',
            'enabled' => 'সক্রিয়',
            'disabled' => 'নিষ্ক্রিয়',
            'relation' => 'রিলেশন: :name',
            'bindings' => 'বাইন্ডিংস:',
            'trace_number' => '#',
            'trace_location' => 'অবস্থান',
            'trace_call' => 'কল',
        ],

        'collection' => [
            'count' => ':count আইটেম|:count আইটেম',
            'more' => '... এবং আরও :count আইটেম',
        ],

        'error' => [
            'subject' => ':app - একটি ত্রুটি ঘটেছে',
            'guest' => 'অতিথি',
            'console' => 'কনসোল',
            'section_exception' => 'ব্যতিক্রম বিবরণ',
            'section_trace' => 'স্ট্যাক ট্রেস',
            'section_request' => 'রিকুয়েস্ট প্রসঙ্গ',
            'section_user' => 'প্রমাণীকৃত ব্যবহারকারী',
            'section_environment' => 'এনভায়রনমেন্ট',
        ],

        'debug' => [
            'subject' => ':app - Debug: :subject',
            'guest' => 'অতিথি',
            'console' => 'কনসোল',
            'section_data' => 'Debug ডেটা',
            'section_call_site' => 'কল সাইট',
            'section_request' => 'রিকুয়েস্ট প্রসঙ্গ',
            'section_environment' => 'এনভায়রনমেন্ট',
        ],

        'log_file' => [
            'subject' => ':app - লগ ফাইল: :file',
            'bulk_subject' => ':app - :count লগ ফাইল সংযুক্ত',
            'body' => ':app থেকে লগ ফাইল <strong>:file</strong> সংযুক্ত আছে।',
            'body_text' => ':app থেকে লগ ফাইল :file সংযুক্ত আছে।',
        ],
    ],

    'settings' => [
        'recipients' => 'প্রাপক',
        'throttling' => 'থ্রটলিং',
        'email_address' => 'ইমেইল ঠিকানা',
        'add_recipient' => 'প্রাপক যোগ করুন',
        'no_recipients_warning' => 'কোনো প্রাপক কনফিগার করা হয়নি — কমপক্ষে একটি ইমেইল যোগ না করা পর্যন্ত বিজ্ঞপ্তি পাঠানো হবে না।',
        'throttle_rate' => 'থ্রটল হার',
        'minutes_suffix' => 'মিনিট',

        'error' => [
            'enabled' => 'ত্রুটি বিজ্ঞপ্তি সক্রিয় করুন',
            'enabled_helper' => 'নিষ্ক্রিয় থাকলে, কোনো ত্রুটি ইমেইল পাঠানো হবে না।',
            'recipients_helper' => 'যেসব ইমেইল ঠিকানা ত্রুটি বিজ্ঞপ্তি পাবে সেগুলো যোগ করুন।',
            'throttle_helper' => 'ডুপ্লিকেট ত্রুটি ইমেইলের মধ্যে সর্বনিম্ন মিনিট।',
            'throttle_exceptions' => 'ব্যতিক্রম থ্রটলিং',
            'throttle_exceptions_helper' => 'সক্রিয় থাকলে, একই file:line-এ ডুপ্লিকেট ব্যতিক্রম থ্রটল উইন্ডোতে ইমেইল ট্রিগার করবে না।',
            'throttle_log_messages' => 'লগ বার্তা থ্রটলিং',
            'throttle_log_messages_helper' => 'সক্রিয় থাকলে, একই ত্রুটি লগ বার্তা থ্রটল উইন্ডোতে ইমেইল ট্রিগার করবে না।',
            'ignored_exceptions' => 'উপেক্ষিত ব্যতিক্রম',
            'ignored_exceptions_description' => 'এই তালিকার ব্যতিক্রমগুলো ইমেইল বিজ্ঞপ্তি ট্রিগার করবে না।',
            'ignored_exceptions_label' => 'উপেক্ষিত ব্যতিক্রম',
            'other_custom' => 'অন্যান্য (কাস্টম)',
            'exception_class' => 'ব্যতিক্রম ক্লাস (FQCN)',
            'class_not_exist' => 'এই ক্লাসটি বিদ্যমান নেই।',
            'custom_exception' => 'কাস্টম ব্যতিক্রম',
            'select_exception' => 'ব্যতিক্রম নির্বাচন করুন',
            'add_exception' => 'ব্যতিক্রম যোগ করুন',
        ],

        'debug' => [
            'enabled' => 'Debug চ্যানেল সক্রিয় করুন',
            'enabled_helper' => 'নিষ্ক্রিয় থাকলে, Sentinel::debug() কলগুলো নীরবে উপেক্ষা করা হবে।',
            'recipients_helper' => 'যেসব ইমেইল ঠিকানা Debug বিজ্ঞপ্তি পাবে সেগুলো যোগ করুন।',
            'throttle_enabled' => 'থ্রটলিং সক্রিয় করুন',
            'throttle_enabled_helper' => 'নিষ্ক্রিয় থাকলে, প্রতিটি Debug কল একটি ইমেইল পাঠাবে। সক্রিয় থাকলে, ডুপ্লিকেট কল থ্রটল করা হবে।',
            'throttle_helper' => 'ডুপ্লিকেট Debug ইমেইলের মধ্যে সর্বনিম্ন মিনিট।',
        ],

        'test_email' => [
            'send' => 'টেস্ট ইমেইল পাঠান',
            'sent' => ':count প্রাপককে টেস্ট ইমেইল পাঠানো হয়েছে',
            'no_recipients' => 'কোনো প্রাপক কনফিগার করা হয়নি। প্রথমে কমপক্ষে একটি ইমেইল ঠিকানা যোগ করুন।',
            'failed' => 'টেস্ট ইমেইল পাঠাতে ব্যর্থ',
            'channel_disabled' => 'এই চ্যানেলটি বর্তমানে নিষ্ক্রিয়। তবুও টেস্ট ইমেইল পাঠানো হবে।',
        ],
    ],

    'logs' => [
        'title' => 'সিস্টেম লগ',
        'heading' => 'লগ ফাইল',
        'entries_title' => 'লগ এন্ট্রি',
        'back_to_list' => 'লগ ফাইলে ফিরে যান',
        'no_entries' => 'কোনো লগ এন্ট্রি পাওয়া যায়নি',
        'unsupported_format' => 'এই ফাইলটি মানক Laravel লগ ফরম্যাটে নেই বলে মনে হচ্ছে',
        'search_placeholder' => 'লগ এন্ট্রি খুঁজুন...',
        'level_filter' => 'লগ স্তর',
        'email_recipient' => 'প্রাপকের ইমেইল',
        'email_description' => 'নির্দিষ্ট প্রাপককে এই লগ ফাইলটি ইমেইল অ্যাটাচমেন্ট হিসেবে পাঠান।',
        'bulk_email_description' => 'নির্বাচিত লগ ফাইলগুলো নির্দিষ্ট প্রাপককে পৃথক ইমেইল অ্যাটাচমেন্ট হিসেবে পাঠান।',
        'bulk_email_files' => 'নির্বাচিত ফাইল',

        'filter' => [
            'date_from' => 'থেকে',
            'date_to' => 'পর্যন্ত',
        ],

        'column' => [
            'filename' => 'ফাইলের নাম',
            'size' => 'আকার',
            'modified' => 'সর্বশেষ পরিবর্তিত',
            'subfolder' => 'সাবফোল্ডার',
            'level' => 'স্তর',
            'timestamp' => 'সময়',
            'message' => 'বার্তা',
        ],

        'action' => [
            'refresh' => 'রিফ্রেশ',
            'view' => 'দেখুন',
            'delete' => 'মুছুন',
            'download' => 'ডাউনলোড',
            'email' => 'ইমেইল করুন',
            'email_send' => 'পাঠান',
            'email_sent' => 'লগ ফাইল সফলভাবে ইমেইল করা হয়েছে',
            'bulk_email_sent' => ':count লগ ফাইল সফলভাবে ইমেইল করা হয়েছে',
            'deleted' => 'লগ ফাইল মুছে ফেলা হয়েছে',
            'bulk_deleted' => ':count লগ ফাইল মুছে ফেলা হয়েছে',
        ],

        'confirm' => [
            'delete' => 'আপনি কি এই লগ ফাইলটি মুছে ফেলতে চান? এই কাজটি পূর্বাবস্থায় ফেরানো যাবে না।',
            'bulk_delete' => 'আপনি কি নির্বাচিত লগ ফাইলগুলো মুছে ফেলতে চান? এই কাজটি পূর্বাবস্থায় ফেরানো যাবে না।',
        ],

        'entry' => [
            'detail' => 'এন্ট্রি বিবরণ',
            'line' => 'লাইন',
            'trace_frames' => ':count ফ্রেম|:count ফ্রেম',
            'copy_trace' => 'স্ট্যাক ট্রেস কপি করুন',
            'copy_entry' => 'পূর্ণ এন্ট্রি কপি করুন',
            'copied' => 'কপি হয়েছে!',
        ],
    ],

];
