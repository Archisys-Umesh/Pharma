<?php declare(strict_types = 1);

return [
    [['GET','POST'], '/organogram/logs', ['Modules\DataChangeRequests\Controllers\Master', 'OrganogramLogs'],['organogram_logs','ftp_logs']],
    [['GET','POST'], '/organogram/logs/reset/log/{logId}', ['Modules\DataChangeRequests\Controllers\Master', 'resetDataChangeLog'],['organogram_log_reset','ftp_logs']],
];