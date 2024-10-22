<?php

namespace App\Traits;

use entities\ConfigurationQuery;
use entities\EmailNotifications;
use entities\EmailNotificationsQuery;
use entities\FtpExportLogsQuery;
use Propel\Runtime\ActiveQuery\Criteria;

trait AdminNotifications {

    protected $teamEmails = 'chirag@plus91labs.com,singh@plus91labs.com,chintan@plus91labs.com';

    public function checkForAdminScheduleNotification() {
        echo "Checking for admin scheduled notifications... : Start" . PHP_EOL;
        $this->sendExportLogEmail();
        echo "Checking for admin scheduled notifications... : Done" . PHP_EOL;
    }

    private function sendExportLogEmail() {
        if (!$this->IsNotificationAlreadySent('export_report_log', date('Y-m-d'))) {
            $companyId = null;
            $ftpFiles = [
                'DCR' => [
                    ['name' => 'DCR_daily_DD-MM-YYYY.csv', 'isSent' => 'Pending', 'records' => 0, 'executionTime' => '']
                ],
                'POB' => [
                    ['name' => 'POB_daily_DD-MM-YYYY.csv', 'isSent' => 'Pending', 'records' => 0, 'executionTime' => '']
                ],
                'SGPI' => [
                    ['name' => 'Sgpi_out_daily_DD-MM-YYYY.csv', 'isSent' => 'Pending', 'records' => 0, 'executionTime' => '']
                ],
                'RCPA' => [
                    ['name' => 'Rcpa_daily_DD-MM-YYYY.csv', 'isSent' => 'Pending', 'records' => 0, 'executionTime' => '']
                ],
                'RCPA SKU Wise' => [
                    ['name' => 'RcpaSku_daily_DD-MM-YYYY.csv', 'isSent' => 'Pending', 'records' => 0, 'executionTime' => '']
                ],
                'E-Detailing' => [
                    ['name' => 'Edetailing_daily_DD-MM-YYYY.csv', 'isSent' => 'Pending', 'records' => 0, 'executionTime' => '']
                ],
                'DVP' => [
                    ['name' => 'DVP_daily_reports_DD-MM-YYYY.csv', 'isSent' => 'Pending', 'records' => 0, 'executionTime' => '']
                ],
                'DAR' => [
                    ['name' => 'DAR_daily_reports_DD-MM-YYYY.csv', 'isSent' => 'Pending', 'records' => 0, 'executionTime' => '']
                ],
                'MAS' => [
                    ['name' => 'MAS_daily_reports_DD-MM-YYYY.csv', 'isSent' => 'Pending', 'records' => 0, 'executionTime' => '']
                ],
                'SGPI Brand Distribution' => [
                    ['name' => 'SGPI_brand_distribution_eyecare_daily_reports_DD-MM-YYYY.csv', 'isSent' => 'Pending', 'records' => 0, 'executionTime' => ''],
                    ['name' => 'SGPI_brand_distribution_megacare_daily_reports_DD-MM-YYYY.csv', 'isSent' => 'Pending', 'records' => 0, 'executionTime' => ''],
                    ['name' => 'SGPI_brand_distribution_maxis_daily_reports_DD-MM-YYYY.csv', 'isSent' => 'Pending', 'records' => 0, 'executionTime' => ''],
                    ['name' => 'SGPI_brand_distribution_elena_daily_reports_DD-MM-YYYY.csv', 'isSent' => 'Pending', 'records' => 0, 'executionTime' => ''],
                    ['name' => 'SGPI_brand_distribution_zenovi_daily_reports_DD-MM-YYYY.csv', 'isSent' => 'Pending', 'records' => 0, 'executionTime' => ''],
                    ['name' => 'SGPI_brand_distribution_osteofit_daily_reports_DD-MM-YYYY.csv', 'isSent' => 'Pending', 'records' => 0, 'executionTime' => ''],
                    ['name' => 'SGPI_brand_distribution_enteron_daily_reports_DD-MM-YYYY.csv', 'isSent' => 'Pending', 'records' => 0, 'executionTime' => ''],
                    ['name' => 'SGPI_brand_distribution_alcare_daily_reports_DD-MM-YYYY.csv', 'isSent' => 'Pending', 'records' => 0, 'executionTime' => ''],
                    ['name' => 'SGPI_brand_distribution_pharma_daily_reports_DD-MM-YYYY.csv', 'isSent' => 'Pending', 'records' => 0, 'executionTime' => '']
                ]
                
            ];

            $resultArray = [];
            $generatedCount = $totalCount = 0;
            foreach ($ftpFiles as $type => $files) {
                foreach($files as $file) {
                    $totalCount++;
                    $fileName = str_replace(['DD', 'MM', 'YYYY'], [date('d'), date('m'), date('Y')], $file['name']);
    
                    $log = FtpExportLogsQuery::create()
                                ->select(['FtpExportLogId', 'IsFileProcessed', 'NoProcessedRecords', 'StartTime', 'EndTime'])
                                ->filterByFilePath("%" . $fileName . "%", Criteria::LIKE)
                                ->findOne();
                    
                    $file['name'] = $fileName;
                    if (isset($log['FtpExportLogId'])) {
                        echo $file['name'] . " : File found into DB" . PHP_EOL;

                        $startTime = $log['IsFileProcessed'] && !empty($log['StartTime']) ? $log['StartTime'] : '';
                        $endTime = $log['IsFileProcessed'] && !empty($log['EndTime']) ? $log['EndTime'] : '';
                        $file['isSent'] = $log['IsFileProcessed'] ? 'Generated' : 'Pending';
                        $file['records'] = $log['NoProcessedRecords'];
                        $file['executionTime'] = $log['IsFileProcessed'] ? $startTime . ' - ' . $endTime . ' (' . round((strtotime($endTime) - strtotime($startTime)) / 60) . ' mins)' : '';
                        if ($log['IsFileProcessed']) {
                            $generatedCount++;
                        }
                    } else {
                        echo "Log Data for the file : " . $file['name'] . PHP_EOL;
                        print_r($log);
                        echo "Log Data end" . PHP_EOL;
                    }

                    if (isset($log['CompanyId']) && !empty($log['CompanyId']) && empty($companyId)) {
                        $companyId = $log['CompanyId'];
                    }

                    $resultArray[$type][] = $file;
                }
            }

            if ($totalCount == $generatedCount || date('H:i') > '05:00') {
                $emailData = ['ftpFiles' => $resultArray, 'reportDate' => date('d-m-Y', strtotime('-1 day')), 'appName' => $_ENV['APP_NAME']];

                $configuration = ConfigurationQuery::create()
                                    ->findOne();

                if (!empty($configuration) && empty($companyId)) {
                    $companyId = $configuration->getCompanyId();
                }
                
                $emails = '';
                if (!empty($configuration)) {
                    $clientEmails = $configuration->getDailyReportEmails();
                    $teamEmails = $configuration->getTeamEmails();
                    
                    if (!empty($clientEmails)) {
                        $emails =  !empty($emails) ? $emails . ',' . $clientEmails : $clientEmails;
                    }

                    if (!empty($teamEmails)) {
                        $emails =  !empty($emails) ? $emails . ',' . $teamEmails : $teamEmails;
                    }
                }
                
                if (empty($emails)) {
                    $emails = $this->teamEmails;
                }

                $notification = new EmailNotifications;
                $notification->setToEmails($emails);
                $notification->setCcEmails(null);
                $notification->setEmailSubject($_ENV['APP_NAME'] . ' - Daily Export Report');
                $notification->setEmailBody('email\dailyExportReportLog.twig');
                $notification->setScheduleAt(date('Y-m-d H:i:s'));
                $notification->setEmailSentStatus(false);
                $notification->setEmailConstants(json_encode($emailData));
                $notification->setEmailType('export_report_log');
                $notification->setEmailSentAttempts(0);
                $notification->setCompanyId($companyId);
                $notification->save();
            }
        }
    }

    private function IsNotificationAlreadySent($type, $date) {
        $notificationCount = EmailNotificationsQuery::create()
                                ->filterByEmailType($type)
                                ->where('DATE(email_notifications.schedule_at) = ?', $date)
                                ->count();
        return $notificationCount > 0 ? true : false;
    }

}