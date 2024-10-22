<?php

return [
    [
        'module_name' => 'Leave',
        'config_key' => 'enable_leave_module',
        'description' => 'Enable or disable leave module',
        'data_type' => 'single_select',
        'config_options' => 'yes,no',
        'config_default' => 'no',
        'config_scope' => 'company_level',
        'is_app' => 'false'
    ],
    [
        'module_name' => 'STP',
        'config_key' => 'enable_stp_module',
        'description' => 'Enable or disable stp module',
        'data_type' => 'single_select',
        'config_options' => 'yes,no',
        'config_default' => 'no',
        'config_scope' => 'company_level',
        'is_app' => 'true'
    ],
    [
        'module_name' => 'Offers & Schemes',
        'config_key' => 'enable_offers_and_schemes_module',
        'description' => 'Enable or disable Offers & Schemes module',
        'data_type' => 'single_select',
        'config_options' => 'yes,no',
        'config_default' => 'no',
        'config_scope' => 'company_level',
        'is_app' => 'true'
    ],
    [
        'module_name' => 'E-Detailing',
        'config_key' => 'e_detailing',
        'description' => 'E-Detailing',
        'data_type' => 'single_select',
        'config_options' => 'yes,no',
        'config_default' => 'no',
        'config_scope' => 'company_level',
        'is_app' => 'true'
    ],
    [
        'module_name' => 'RCPA',
        'config_key' => 'rcpa',
        'description' => 'RCPA',
        'data_type' => 'single_select',
        'config_options' => 'yes,no',
        'config_default' => 'no',
        'config_scope' => 'company_level',
        'is_app' => 'true'
    ],
    [
        'module_name' => 'Attendance',
        'config_key' => 'attendance_weekoff',
        'description' => 'Attendance',
        'data_type' => 'number',
        'config_options' => '30',
        'config_default' => '30',
        'config_value' => '30',
        'config_scope' => 'company_level',
        'is_app' => 'false'
    ],
    [
        'module_name' => 'Attendance',
        'config_key' => 'attendance_holiday',
        'description' => 'Attendance',
        'data_type' => 'number',
        'config_options' => '30',
        'config_default' => '30',
        'config_value' => '30',
        'config_scope' => 'company_level',
        'is_app' => 'false'
    ]
];