<?php declare(strict_types = 1);

namespace Modules\System\Processes;

use entities\FtpImportLogsQuery;
use entities\FtpConfigsQuery;
use entities\FtpImportBatchesQuery;
use Modules\Monitoring\Queries\FTPImportLogs;

class FTPRunner
{
    private $ftpClinet, $company_id, $is_processed_one_file;
    
    public function __construct() {
        $this->is_processed_one_file = false;
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
                    $importBatches = $this->getActiveBatches();
                    $this->is_processed_one_file = false;
                    // print_r($importBatches->toArray());
                    foreach($importBatches as $importBatch) {
                        echo "Batch check : " . $importBatch->getFtpPath() . PHP_EOL;
                        // $importBatch->setIsFileProcessing(true);
                        // $importBatch->save();
                        $this->checkForFile($importBatch);
                        // sleep(5);
                        // $importBatch->setIsFileProcessing(false);
                        // $importBatch->save();

                        if ($this->is_processed_one_file) {
                            break;
                        }
                    }

                    echo "Closing FTP Connection  For the company id : " . $this->company_id . PHP_EOL;
                    if ($this->ftpClinet->isConnected) {
                        $this->ftpClinet->closeConnection();
                    }
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
                    $importLog = $this->getImportLogObject();

                    if (!empty($importLog)) {
                        $this->importFile($importLog);
                    }

                    echo "Closing FTP Connection  For the company id : " . $this->company_id . PHP_EOL;
                    if ($this->ftpClinet->isConnected) {
                        $this->ftpClinet->closeConnection();
                    }
                }
            }
        //     sleep(5);
        // }
	}

    private function checkForFile($importBatch)
    {
        $filePath = $importBatch->getFtpPath();
        $batch = $importBatch->getNextBatch();
        $importFunction = $importBatch->getAttachedFunction();

        $fullFilePath = $filePath . '/' . $batch . '.csv';
        echo "File check : " . $fullFilePath . PHP_EOL;
        $hasFile = $this->ftpClinet->getFile($fullFilePath);
        
        if(!$hasFile) {
            $fullFilePath = $filePath . '\\' . $batch . '.csv';
            echo "File check : " . $fullFilePath . PHP_EOL;
            $hasFile = $this->ftpClinet->getFile($fullFilePath);
        }
        
        if ($hasFile) {
            echo "Get New File | File Path : " . $fullFilePath . PHP_EOL;
            $fileContent = $this->ftpClinet->getFileContent($fullFilePath);
            if(!empty($fileContent)) {
                $dataCount = count(str_getcsv($fileContent, "\n"));
                $response['totalRecords'] = $dataCount - 1;
                $this->addFileLog($importBatch, $fullFilePath, $response);
            }
        }
    }

    private function getImportLogObject() {
        return FtpImportLogsQuery::create()
                    ->filterByCompanyId($this->company_id)
                    ->filterByIsFileProcessing(false)
                    ->filterByIsFileProcessed(0)
                    ->orderByFtpImportLogId()
                    ->findOne();
    }

    private function importFile($importLog) {
        $fullFilePath = $importLog->getFilePath();
        $importBatch = $importLog->getFtpImportBatches();
        $filePath = $importBatch->getFtpPath();
        $importFunction = $importBatch->getAttachedFunction();
        $removeBackSlash = str_replace('\\', '/', $fullFilePath);
        $batch = str_replace('.' . pathinfo($removeBackSlash, PATHINFO_EXTENSION),'',basename($removeBackSlash));
        
        echo "File check : " . $fullFilePath . PHP_EOL;
        $hasFile = $this->ftpClinet->getFile($fullFilePath);
        
        if ($hasFile) {
            $importLog->setIsFileProcessing(true);
            $importLog->save();

            $fileContent = $this->ftpClinet->getFileContent($fullFilePath);
            if(!empty($fileContent)) {
                echo "File Importing | File Path : " . $fullFilePath . PHP_EOL;
                $response = $this->importData($fileContent, $importFunction, $importLog);
                if(!empty($response)) {
                    echo "File Imported | File Path : " . $fullFilePath . PHP_EOL;
                    $print_response = $response;

                    unset($print_response['successContent']);
                    unset($print_response['errorContent']);
                    print_r($print_response) . PHP_EOL;

                    $this->processImportResponse($response, $filePath, $batch);
                    $this->updateFileLog($importLog, $response);
                    $this->is_processed_one_file = true;
                }
            }
        }
    }

    private function addFileLog($importBatch, $filePath, $response)
    {
        $record = new \entities\FtpImportLogs();
        $record->setFtpImportBatchId($importBatch->getPrimaryKey());
        $record->setCompanyId($this->company_id);
        $record->setFilePath($filePath);
        $record->setNoTotalRecords($response['totalRecords']);
        $record->setNoSuccessfulRecords(0);
        $record->setNoFailedRecords(0);
        $record->setIsFileProcessing(false);
        $record->setNoProcessedRecords(0);
        $record->setIsFileProcessed(0);
        $record->setCreatedAt(date('Y-m-d H:i:s'));
        $record->setUpdatedAt(date('Y-m-d H:i:s'));
        $record->save();

        $importBatch->setNextBatch($importBatch->getNextBatch()+1);
        $importBatch->save();

        return $record;
    }

    private function updateFileLog($importLog, $response)
    {
        $importLog->setNoTotalRecords(($response['successfulRecords'] + $response['failedRecords']));
        $importLog->setNoSuccessfulRecords($response['successfulRecords']);
        $importLog->setNoFailedRecords($response['failedRecords']);
        $importLog->setIsFileProcessing(false);
        $importLog->setIsFileProcessed(1);
        $importLog->save();
    }

    private function importData($content, $importFunction, $importLog)
    {
        try {
            $obj = new ImportFromContent($this->company_id);
            $response = $obj->importCSVContent($content, $importFunction, $importLog);
            return $response;
        } catch(\Exception $e) {
            echo "Failed to import data : " . $e->getMessage() . PHP_EOL;
            return [];
        }
    }

    public function processImportResponse($response, $filePath, $batch)
    {
        if(isset($response['successContent'])) {
            if ($this->ftpClinet->isConnected) {
                $this->ftpClinet->closeConnection();
            }
            $this->ftpClinet->connect();
            $fullFilePath = $filePath . '/' . $batch . '.success';  
            $this->ftpClinet->setFileContent($fullFilePath, $response['successContent']); 
        }

        if(isset($response['errorContent'])) {
            if ($this->ftpClinet->isConnected) {
                $this->ftpClinet->closeConnection();
            }
            $this->ftpClinet->connect();
            $fullFilePath = $filePath . '/' . $batch . '.err';  
            $this->ftpClinet->setFileContent($fullFilePath, $response['errorContent']);
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
        return FtpImportBatchesQuery::create()
                    ->filterByCompanyId($this->company_id)
                    ->filterByIsenabled(1)
                    ->filterByIsFileProcessing(false)
                    ->orderByFtpOrder()
                    ->find();
    }

}