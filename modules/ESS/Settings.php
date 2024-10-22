<?php

return [
    [
        'dependent_config_key' => 'enable_leave_module',
        'dependent_config_key_value' => 'yes',
        'module_name' => 'leave',
        'config_key' => 'leaveTranMod',
        'description' => 'Leave transaction modes',
        'data_type' => 'multi_select',
        'config_options' => 'Accuration,Opening,Reward',
        'config_default' => 'Accuration,Opening,Reward',
        'config_scope' => 'bu_level',
        'is_app' => false
    ]
];