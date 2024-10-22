<?php
return [
    "ExpenseTripOptions" => [
        0 => "Any",
        1 => "Only on Trip (Ex-HQ,OS)",
        2 => "Only off Trip (HQ)",
        3 => "Ex-HQ only",
        4 => "Only on Trip (OS)",
        5 => "Last OS Day",
        6 => "InTransit"
    ],
    "allowedMonths" => 3,
    "ReminderTypes" => [
        1 => "Monthly"
    ],
    "CityCategories" => ["A" =>"A Class","B" => "B Class","C" => "C Class"],
    "dashboardExpenseWidgetCount" => 2,
    "EventStatus" => [
            0 => "Pending",
            1 => "Approved",
            2 => "Rejected"
    ],
    "EODCheckStatus" => [
        1 => "Enabled",
        0 => "Disabled"
    ],
    "AttendanceStatus" => [
        0 => "Punch-in",
        1 => "Punch-out",
        2 => "Forced Loggout",
        -1 => "Day Locked",
        4 => "Punch Leave",
    ],
];