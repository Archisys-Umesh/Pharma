<?php declare(strict_types = 1);

namespace Modules\System\Processes;

use Exception;
use entities\FtpExportLogs;
use entities\FtpConfigsQuery;
use entities\FtpExportLogsQuery;
use entities\FtpImportLogsQuery;
use entities\FtpExportBatchesQuery;
use entities\NotificationsQuery;
use Modules\System\Processes\ExportData;
use Propel\Runtime\ActiveQuery\Criteria;

class FTPExportRunner
{
    private $ftpClinet, $company_id;
    
    public function __construct() {

    }

    public function addWatcher()
	{
		// set_time_limit(0);
        // while (true) {
            echo "Check For FTP Connections... " . PHP_EOL;

            $getFtpConnections = $this->getFTPConnections();
            foreach($getFtpConnections as $ftpConfig) {
                $this->company_id = $ftpConfig['CompanyId'];
                if($ftpConfig['Port'] == 22) {
                    $this->ftpClinet = new \App\Utils\SFTPClient($ftpConfig['Host'], $ftpConfig['Username'], $ftpConfig['Password']);    
                } else {
                    $this->ftpClinet = new \App\Utils\FTPClient($ftpConfig['Host'], $ftpConfig['Username'], $ftpConfig['Password']);    
                }
                
                echo "Connecting to FTP for the company id : " . $this->company_id . " | Host : " . $ftpConfig['Host'] . PHP_EOL;
                $this->ftpClinet->connect();

                if($this->ftpClinet->isConnected) {
                    echo "Connected to FTP for the company id : " . $this->company_id . PHP_EOL;
                    $exportBatches = $this->getActiveBatches();
                    foreach($exportBatches as $exportBatch) {
                        try {
                            echo "Batch check : " . $exportBatch->getFtpPath() . PHP_EOL;
                            $exportBatch->setIsFileProcessing(true);
                            $exportBatch->save();
                            
                            $this->checkForExport($exportBatch);
                            
                            $exportBatch->setIsFileProcessing(false);
                            $exportBatch->save();
                            sleep(5);
                        }
                        catch(Exception $e)
                        {
                            var_dump($e);
                        }
                    }

                    echo "Closing FTP Connection  For the company id : " . $this->company_id . PHP_EOL;
                    $this->ftpClinet->closeConnection();
                }
            }
        //     sleep(5);
        // }
	}

    public function addLogWatcher()
	{
		// set_time_limit(0);
        // while (true) {
            echo "Check For FTP Connections... " . PHP_EOL;

            $getFtpConnections = $this->getFTPConnections();
            foreach($getFtpConnections as $ftpConfig) {
                $this->company_id = $ftpConfig['CompanyId'];
                if($ftpConfig['Port'] == 22) {
                    $this->ftpClinet = new \App\Utils\SFTPClient($ftpConfig['Host'], $ftpConfig['Username'], $ftpConfig['Password']);    
                } else {
                    $this->ftpClinet = new \App\Utils\FTPClient($ftpConfig['Host'], $ftpConfig['Username'], $ftpConfig['Password']);    
                }
                
                echo "Connecting to FTP for the company id : " . $this->company_id . " | Host : " . $ftpConfig['Host'] . PHP_EOL;
                $this->ftpClinet->connect();

                if($this->ftpClinet->isConnected) {
                    echo "Connected to FTP for the company id : " . $this->company_id . PHP_EOL;
                    sleep(rand(1,10));
                    $exportLog = $this->getActiveLog();

                    if (!empty($exportLog)) {
                        $this->exportFile($exportLog);
                    }

                    echo "Closing FTP Connection  For the company id : " . $this->company_id . PHP_EOL;
                    $this->ftpClinet->closeConnection();
                }
            }
        //     sleep(5);
        // }
	}

    private function checkForExport($exportBatch)
    {
        $filePath = $exportBatch->getFtpPath();
        $exportFunction = $exportBatch->getAttachedFunction();
        $hasFile = $this->checkIfAlredayProcessed($exportBatch);
        
        if (!$hasFile) {
            $nameFormat = $exportBatch->getFileNameFormat();
            $fileName = str_replace(['DD', 'dd'], date('d'), $nameFormat);
            $intervalType = $exportBatch->getIntervalType();
            if($intervalType == 'monthly'){
                $fileName = str_replace(['MM', 'mm'], date('m', strtotime('-1 month')), $fileName);
            }else{
                $fileName = str_replace(['MM', 'mm'], date('m'), $fileName);
            }
            $fileName = str_replace(['YYYY', 'yyyy'], date('Y'), $fileName);

            $filePath = $filePath . '/' . $fileName;
            echo "File Add Log | File Path : " . $filePath . PHP_EOL;

            $dates = $this->calculateBatchDates($exportBatch);
            $startDate = $dates['startDate'];
            $endDate = $dates['endDate'];
            $response = ['hasError' => 0, 'errorMessage' => null, 'startDate' => $startDate, 'endDate' => $endDate];
            $this->addFileLog($exportBatch, $filePath, $response);

            // $response = $this->exportData($exportFunction, $startDate, $endDate);
            // if(!empty($response)) {
            //     echo "File Exported | File Path : " . $filePath . PHP_EOL;

            //     $this->processExportResponse($response, $filePath);
            //     $this->addFileLog($exportBatch, $filePath, $response);
            // }
        }
    }

    private function exportFile($exportLog) {
        $exportBatch = $exportLog->getFtpExportBatches();
        $filePath = $exportLog->getFilePath();
        $exportFunction = $exportBatch->getAttachedFunction();
        $startDate = $exportLog->getExportStartDate()->format('Y-m-d');
        $endDate = $exportLog->getExportEndDate()->format('Y-m-d');

        $exportLog->setIsFileProcessing(true);
        $exportLog->setStartTime(date('Y-m-d H:i:s'));
        $exportLog->save();

        echo "File Exporting | File Path : " . $filePath . PHP_EOL;

        $response = $this->exportData($exportFunction, $startDate, $endDate);
        if(!empty($response)) {
            $exportLog->setEndTime(date('Y-m-d H:i:s'));
            $exportLog->setIsFileProcessed(1);
            $exportLog->setIsFileProcessing(false);
            $exportLog->setNoProcessedRecords($response['totalCount']);
            $exportLog->save();

            echo "File Exported | File Path : " . $filePath . PHP_EOL;
            $this->processExportResponse($response, $filePath);
        }
    }

    private function addFileLog($exportBatch, $filePath, $response)
    {
        $record = new FtpExportLogs();
        $record->setFtpExportBatchId($exportBatch->getPrimaryKey());
        $record->setCompanyId($this->company_id);
        $record->setFilePath($filePath);
        $record->setHasError(($response['hasError'] ? 1 : 0));
        $record->setErrorMessage($response['errorMessage']);
        $record->setExportStartDate($response['startDate']);
        $record->setExportEndDate($response['endDate']);
        $record->setIsFileProcessing(false);
        $record->setNoProcessedRecords(0);
        $record->setIsFileProcessed(0);
        $record->setCreatedAt(date('Y-m-d H:i:s'));
        $record->save();

        $nextDate = $this->getNextIntervalDate($exportBatch);
        $exportBatch->setNextDate($nextDate);
        $exportBatch->setStartDate(date('Y-m-d'));
        $exportBatch->setEndDate($nextDate);
        $exportBatch->save();

        return $record;
    }

    public function checkIfAlredayProcessed($exportBatch)
    {
        $count = FtpExportLogsQuery::create()->filterByCompanyId($this->company_id)
                    ->filterByFtpExportBatchId($exportBatch->getPrimaryKey())
                    ->filterByHasError(0)
                    ->where('DATE(ftp_export_logs.created_at) = ?', date('Y-m-d'))
                    ->count();
        return $count ? true : false;
    }

    private function exportData($exportFunction, $startDate, $endDate)
    {
        try {
            echo "Start Date : " . $startDate . PHP_EOL;
            echo "End Date : " .  $endDate . PHP_EOL;

            $obj = new ExportData($this->company_id);
            $response = $obj->exportCSVContent($exportFunction, $startDate, $endDate);
            return $response;
        } catch(\Exception $e) {
            $previous = $e->getPrevious();
            if(!empty($previous))
                echo "Failed to export data : " . $e->getPrevious()->getMessage() . PHP_EOL;
            else
                echo "Failed to export data : " . $e->getMessage() . PHP_EOL;
            return [];
        }
    }

    public function processExportResponse($response, $filePath)
    {
        if(isset($response['exportContent'])) {
            if ($this->ftpClinet->isConnected) {
                $this->ftpClinet->closeConnection();
            }
            $this->ftpClinet->connect();
            $this->ftpClinet->setFileContent($filePath, $response['exportContent']); 
        }

        return true;
    }

    private function getFTPConnections()
    {
        return FtpConfigsQuery::create()
                    ->filterByIsenabled(1)
                    ->find()
                    ->toArray();
    }

    private function getActiveBatches()
    {
        return FtpExportBatchesQuery::create()
                    ->filterByCompanyId($this->company_id)
                    ->filterByIsenabled(1)
                    ->filterByIsFileProcessing(false)
                    ->where('DATE(ftp_export_batches.next_date) = ?', date('Y-m-d'))
                    ->orderByFtpOrder()
                    ->find();
    }

    private function getActiveLog()
    {
        return FtpExportLogsQuery::create()
                    ->filterByCompanyId($this->company_id)
                    ->filterByIsFileProcessing(false)
                    ->filterByIsFileProcessed(0)
                    ->orderByFtpExportLogId()
                    ->findOne();
    }

    private function calculateBatchDates($exportBatch)
    {
        return ['startDate' => $exportBatch->getStartDate()->format('Y-m-d'), 'endDate' => $exportBatch->getEndDate()->format('Y-m-d')];

        $endDate = $exportBatch->getNextDate();
        $intervalType = $exportBatch->getIntervalType();

        if (empty($endDate)) {
            $endDate = date('Y-m-d');
        } else {
            $endDate = $endDate->format('Y-m-d');
        }

        if($intervalType == 'monthly') {
            $startDate = date('Y-m-d', strtotime($endDate . ' - ' . $exportBatch->getIntervalDays() . ' months'));
            $startDate = date('Y-m-01', strtotime($startDate));
            $endDate = date('Y-m-01', strtotime($endDate));
        } else {
            $startDate = date('Y-m-d', strtotime($endDate . ' - ' . $exportBatch->getIntervalDays() . ' days'));
        }

        return ['startDate' => $startDate, 'endDate' => $endDate];
    }

    private function getNextIntervalDate($exportBatch)
    {
        $intervalType = $exportBatch->getIntervalType();
        if($intervalType == 'monthly') {
            $nextDate = date('Y-m-d', strtotime('+' . $exportBatch->getIntervalDays() . ' months'));
        }  else {
            $nextDate = date('Y-m-d', strtotime('+' . $exportBatch->getIntervalDays() . ' days'));
        }

        return $nextDate;
    }
}