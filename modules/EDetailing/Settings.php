<?php

return [
    [
        'dependent_config_key' => '',
        'dependent_config_key_value' => '',
        'module_name' => 'CaptureGeoLocation',
        'config_key' => 'capture_geo_location',
        'description' => 'Capture Geo Location',
        'data_type' => 'single_select',
        'config_options' => 'yes,no',
        'config_default' => 'no',
        'config_scope' => 'bu_level',
        'is_app' => 'true'
    ],
    [
        'dependent_config_key' => '',
        'dependent_config_key_value' => '',
        'module_name' => 'E-Detailing',
        'config_key' => 'e_detailing',
        'description' => 'E-Detailing',
        'data_type' => 'single_select',
        'config_options' => 'yes,no',
        'config_default' => 'no',
        'config_scope' => 'bu_level',
        'is_app' => 'true'
    ],
    [
        'dependent_config_key' => 'capture_geo_location',
        'dependent_config_key_value' => 'yes',
        'module_name' => 'Attendance',
        'config_key' => 'geo_location_capture_on_attendance',
        'description' => 'Geo Location Capture On Attendance',
        'data_type' => 'single_select',
        'config_options' => 'yes,no',
        'config_default' => 'no',
        'config_scope' => 'bu_level',
        'is_app' => 'true'
    ],
    [
        'dependent_config_key' => 'capture_geo_location',
        'dependent_config_key_value' => 'yes',
        'module_name' => 'DCR',
        'config_key' => 'geo_location_capture_on_dcr',
        'description' => 'Geo Location Capture On DCR',
        'data_type' => 'single_select',
        'config_options' => 'yes,no',
        'config_default' => 'no',
        'config_scope' => 'bu_level',
        'is_app' => 'true'
    ],
    [
        'dependent_config_key' => 'capture_geo_location',
        'dependent_config_key_value' => 'yes',
        'module_name' => 'Brand RCPA',
        'config_key' => 'geo_location_capture_on_rcpa',
        'description' => 'Geo Location Capture On RCPA',
        'data_type' => 'single_select',
        'config_options' => 'yes,no',
        'config_default' => 'no',
        'config_scope' => 'bu_level',
        'is_app' => 'true'
    ]
];