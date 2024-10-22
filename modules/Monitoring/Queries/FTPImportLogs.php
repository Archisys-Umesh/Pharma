<?php declare(strict_types = 1);

namespace Modules\Monitoring\Queries;

use entities\FtpImportLogsQuery;
use Modules\Monitoring\Interfaces\MonitoringQueriesInterface;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 * Description of FTPImportLogs - Queries
 *
 * @author Chirag Patel
 */
class FTPImportLogs implements MonitoringQueriesInterface {

    public function getTableColumns() {
        return [
            'Date', 'TotolRecords', 'SuccessfulRecords', 'FailedRecords', 'Percentage'
        ];
    }

    public function getData() {
        return FtpImportLogsQuery::create()
                    ->select(['Date', 'TotolRecords', 'SuccessfulRecords', 'FailedRecords'])
                    ->withColumn('DATE(ftp_import_logs.created_at)', 'Date')
                    ->withColumn('sum(ftp_import_logs.no_total_records)', 'TotolRecords')
                    ->withColumn('sum(ftp_import_logs.no_successful_records)', 'SuccessfulRecords')
                    ->withColumn('sum(ftp_import_logs.no_failed_records)', 'FailedRecords')
                    ->withColumn('sum(no_successful_records)::decimal / sum(no_total_records)::decimal * 100', 'Percentage')
                    ->addGroupByColumn('DATE(created_at)')
                    ->orderBy('Date', Criteria::DESC)
                    ->limit(10)
                    ->find();
    }

    public function getLabel() {
        return 'FTP Import Logs';
    }

    public function getUniqueKey() {
        return 'FTPImportLogs';
    }

    // Deactivate the controller 
    public function canRun()
    {
        return true;
    }
}