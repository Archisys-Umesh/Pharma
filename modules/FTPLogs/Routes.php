<?php declare(strict_types = 1);

return [
    [['GET','POST','PUT','DELETE'], '/ftp-logs/dashboard', ['Modules\FTPLogs\Controllers\Masters', 'dashboard'],['ftp_logs_dashboard','ftp_logs']],
    [['GET','POST','PUT','DELETE'], '/ftp-logs/all', ['Modules\FTPLogs\Controllers\Masters', 'logs'],['ftp_logs_all','ftp_logs']],
    [['GET','POST'], '/ftp-logs/reset/file/{log_id}', ['Modules\FTPLogs\Controllers\Masters', 'resetLogFile'],['order_changeStatus','ftp_logs']],
    [['GET','POST','PUT','DELETE'], '/ftp-export-logs/all', ['Modules\FTPLogs\Controllers\Masters', 'exportLogs'],['ftp_export_logs_all','ftp_logs']],
    [['GET','POST'], '/ftp-export-logs/reset/file/{log_id}', ['Modules\FTPLogs\Controllers\Masters', 'resetExportLogFile'],['ftp_export_status_change','ftp_logs']],
];