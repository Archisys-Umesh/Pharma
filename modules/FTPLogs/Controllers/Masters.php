<?php declare(strict_types=1);

namespace Modules\FTPLogs\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use entities\FtpExportLogsQuery;
use entities\FtpImportLogsQuery;
use Modules\Monitoring\Queries\FTPImportLogs;
use Propel\Runtime\ActiveQuery\Criteria;

class Masters extends \App\Core\BaseController
{
    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }


    public function dashboard()
    {
        $action = $this->app->Request()->getParameter("action");
        switch ($action) :
            case "":
                $ftpLogs = FtpImportLogsQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->filterByIsFileProcessed(0)
                    ->orderByFtpImportLogId()
                    ->find()
                    ->toArray();

                $ftpExportLogs = FtpExportLogsQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->filterByIsFileProcessed(0)
                    ->orderByFtpExportLogId()
                    ->find()
                    ->toArray();

                $this->data['title'] = "FTP Logs";
                $this->data['ftpLogs'] = $ftpLogs;
                $this->data['ftpExportLogs'] = $ftpExportLogs;
                $this->app->Renderer()->render("ftpLogs/dashboard.twig", $this->data);
                break;
        endswitch;
    }

    public function logs()
    {
        $action = $this->app->Request()->getParameter("action");
        $this->data['title'] = "FTP File Log";
        $this->data['form_name'] = "FileLog";
        $this->data['disableAdd'] = true;
        $this->data['disableEdit'] = true;
        $this->data['cols'] = [
            "Sr" => "FtpImportLogId",
            "Date" => "CreatedAt",
            "File Path" => "FilePath",
            "Total Records" => "NoTotalRecords",
            "Processed Records" => "NoProcessedRecords",
            "Successful Records" => "NoSuccessfulRecords",
            "Failed Records" => "NoFailedRecords",
            "Start Time" => "StartTime",
            "End Time" => "EndTime",
            "Processing Time" => "ProcessedTime"
        ];

        $this->data['pk'] = "FtpImportLogId";

        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":
                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\FtpImportLogsQuery::create()->filterByIsFileProcessed(1)
                    ->filterByCompanyId($this->app->Auth()->CompanyId());
                $count = $query->count();
                $response["recordsTotal"] = $count;
                if (!empty($search)) {
                    // Strip % symbols from the search term
                    $cleanSearch = str_replace('%', '', $search);

                    // Check if the cleaned search term is numeric
                    if (is_numeric($cleanSearch)) {
                        // If numeric, perform direct numeric comparison
                        $query->filterByFtpImportLogId($cleanSearch)->_or()->filterByNoTotalRecords($cleanSearch)
                            ->_or()
                            ->filterByNoProcessedRecords($cleanSearch)
                            ->_or()
                            ->filterByNoSuccessfulRecords($cleanSearch)
                            ->_or()
                            ->filterByNoFailedRecords($cleanSearch);
                    } else {
                        // If not numeric, perform string-based search with LIKE
                        $query->filterByFtpImportLogId($cleanSearch)->_or()->filterByNoTotalRecords($search, Criteria::LIKE)
                            ->_or()
                            ->filterByNoProcessedRecords($search, Criteria::LIKE)
                            ->_or()
                            ->filterByNoSuccessfulRecords($search, Criteria::LIKE)
                            ->_or()
                            ->filterByNoFailedRecords($search, Criteria::LIKE);

                    }
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $data = $query->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $result = [];
                foreach ($data as $row) {
                    $processingTime = '';

                    if (!empty($row['EndTime']) && !empty($row['StartTime'])) {
                        $diffInsecs = strtotime($row['EndTime']) - strtotime($row['StartTime']);
                        if (($diffInsecs / 3600) > 1) {
                            $processingTime .= floor($diffInsecs / 3600) . ' hours ';
                        }

                        if ((($diffInsecs / 60) % 60) > 1) {
                            $processingTime .= floor(($diffInsecs / 60) % 60) . ' mins ';
                        }

                        if (($diffInsecs % 60) > 0) {
                            $processingTime .= floor($diffInsecs % 60) . ' secs ';
                        }
                    }

                    $temp = $row;
                    $temp['StartTime'] = !empty($row['StartTime']) ? date('d-m-Y h:i A', strtotime($row['StartTime'])) : '';
                    $temp['EndTime'] = $row['EndTime'] ? date('d-m-Y h:i A', strtotime($row['EndTime'])) : '';
                    $temp['CreatedAt'] = date('d-m-Y', strtotime($row['CreatedAt']));
                    $temp['ProcessedTime'] = $processingTime;
                    $result[] = $temp;
                }

                $response['data'] = $result;
                $this->json($response);
                break;
        endswitch;
    }

    public function resetLogFile($log_id)
    {
        $f = FormMgr::formHorizontal();
        $f->add([
            'Remark' => FormMgr::text()->label('Remark'),
        ]);
        $this->data['form_name'] = "Are you sure you want to reset this file";

        if ($this->app->isPost() && $f->validate()) {
            $remark = $this->app->Request()->getParameter("Remark", "");
            $importLog = FtpImportLogsQuery::create()
                ->findOneByFtpImportLogId($log_id);
            if (!empty($importLog)) {
                $importLog->setIsFileProcessing(false);
                $importLog->save();
            }

            return true;
        }

        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
    }

    public function exportLogs()
    {
        $action = $this->app->Request()->getParameter("action");
        $this->data['title'] = "FTP Export File Log";
        $this->data['form_name'] = "FileExportLog";
        $this->data['disableAdd'] = true;
        $this->data['disableEdit'] = true;
        $this->data['cols'] = [
            "Sr" => "FtpExportLogId",
            "Date" => "CreatedAt",
            "File Path" => "FilePath",
            "Total Records" => "NoProcessedRecords",
            "Start Time" => "StartTime",
            "End Time" => "EndTime",
            "Processing Time" => "ProcessedTime"
        ];
        $this->data['rowButtons'] = ["ftp_export_status_change" => "ajaxFTPExportModal zmdi zmdi-layers"];

        $this->data['pk'] = "FtpExportLogId";

        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":
                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\FtpExportLogsQuery::create()->filterByIsFileProcessed(1)->filterByCompanyId($this->app->Auth()->CompanyId());
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    // Strip % symbols from the search term
                    $cleanSearch = str_replace('%', '', $search);

                    // Check if the cleaned search term is numeric
                    if (is_numeric($cleanSearch)) {
                        // If numeric, perform direct numeric comparison
                        $query->filterByFtpExportLogId($cleanSearch)->_or()->filterByCreatedAt($cleanSearch)
                            ->_or()
                            ->filterByFilePath($cleanSearch)
                            ->_or()
                            ->filterByNoProcessedRecords($cleanSearch)->_or()
                            ->filterByStartTime($cleanSearch)->_or()
                            ->filterByEndTime($cleanSearch);
                    } else {
                        // If not numeric, perform string-based search with LIKE
                        $query->filterByFtpExportLogId($cleanSearch)->_or()->filterByCreatedAt($search, Criteria::LIKE)
                            ->_or()
                            ->filterByFilePath($search, Criteria::LIKE)
                            ->_or()
                            ->filterByNoProcessedRecords($search, Criteria::LIKE)->_or()
                            ->filterByStartTime($search,Criteria::LIKE)->_or()
                            ->filterByEndTime($search,Criteria::LIKE);

                    }
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $data = $query->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $result = [];
                foreach ($data as $row) {
                    $processingTime = '';

                    if (!empty($row['EndTime']) && !empty($row['StartTime'])) {
                        $diffInsecs = strtotime($row['EndTime']) - strtotime($row['StartTime']);
                        if (($diffInsecs / 3600) > 1) {
                            $processingTime .= floor($diffInsecs / 3600) . ' hours ';
                        }

                        if ((($diffInsecs / 60) % 60) > 1) {
                            $processingTime .= floor(($diffInsecs / 60) % 60) . ' mins ';
                        }

                        if (($diffInsecs % 60) > 0) {
                            $processingTime .= floor($diffInsecs % 60) . ' secs ';
                        }
                    }

                    $temp = $row;
                    $temp['StartTime'] = !empty($row['StartTime']) ? date('d-m-Y h:i A', strtotime($row['StartTime'])) : '';
                    $temp['EndTime'] = $row['EndTime'] ? date('d-m-Y h:i A', strtotime($row['EndTime'])) : '';
                    $temp['CreatedAt'] = date('d-m-Y', strtotime($row['CreatedAt']));
                    $temp['ProcessedTime'] = $processingTime;
                    $result[] = $temp;
                }

                $response['data'] = $result;
                $this->json($response);
                break;
        endswitch;
    }

    public function resetExportLogFile($log_id)
    {
        $exportLog = FtpExportLogsQuery::create()->findOneByFtpExportLogId($log_id);

        $f = FormMgr::formHorizontal();
        $f->add([
            'Remark' => FormMgr::text()->label('Remark'),
        ]);
        $this->data['form_name'] = "Are you sure you want to reset this file";

        if ($this->app->isPost() && $f->validate()) {
            if (empty($exportLog->getExportStartDate()) || empty($exportLog->getExportEndDate())) {
                return false;
            }

            $remark = $this->app->Request()->getParameter("Remark", "");
            if (!empty($exportLog)) {
                $exportLog->setIsFileProcessed(0);
                $exportLog->setIsFileProcessing(false);
                $exportLog->save();
            }

            return true;
        }

        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
    }
}