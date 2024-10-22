<?php
return [

    "userStatus" => [
        1 => "Active",
        0 => "Inactive",
    ],


    "status" => [
        1 => "Yes",
        0 => "No"
    ],

    "exposed" => [
        0 => "No",
        1 => "Yes"

    ],

    "Type" => [
        "Skip" => "Skip",
        "Reschedule" => "Reschedule",
    ],

    "globalStatus" => [
        1 => "Active",
        0 => "Inactive",
    ],
    "PolicyGroups" =>
        [
            "Daily" => "Daily",
            "Projects" => "Projects",
            "OnSite" => "OnSite",
            "Branch" => "Branch",
            "Others" => "Others"
        ],
    "expReminderStatus" =>
        [
            0 => 'Disable',
            1 => 'After 2 Days',
            2 => 'After 5 Days'
        ],
    "designationColor" =>
        [
            '#383ef8b8' => 'Blue',
            '#38f873b8' => 'Green',
            '#f5a52dc4' => 'Orange',
            '#f8cf38b8' => 'Red'
        ],
    "AgendaControlType" =>
        [
            "FW" => "FieldWork", // Beat will Start
            "NCA" => "NCA", // Working without Beat
            "JW" => "JW", // Working without Beat
        ],
    "ftpConfig" =>
        [
            "server" => "164.52.195.173",
            "user" => "root",
            "password" => "Vikram123!@#$%",
            "isPassive" => true,
            "basePath" => "/home/campussh/public_html/alembic/"
        ],
    "minimumExpCount" => 2,
    "superAdminEmail" => 'chintan@archisys.in',
    "supportEmail" => 'support@archisys.in',
    "EscalationDays" => "+7 day",
    "adminposition" => 636,

];
