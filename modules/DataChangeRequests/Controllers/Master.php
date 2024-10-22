<?php declare(strict_types = 1);

namespace Modules\DataChangeRequests\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use App\Core\MediaManager;
use entities\DataChangeRequestsQuery;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 * Description of Masters
 *
 * @author Plus91Labs-01
 */
class Master extends \App\Core\BaseController{
   
    protected $app;
    
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function OrganogramLogs() {
        $action = $this->app->Request()->getParameter("action");
        switch ($action) :
            case "":
                $this->data['title'] = "Organogram Log";
                $this->app->Renderer()->render("dataChangeRequests/dashboard.twig", $this->data);
                break;


            case "list":
                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\DataChangeRequestsQuery::create()->filterByImportTemplate('Organogram');

                // if (!empty($search)) {
                //     $search = '%' . $search . '%';
                //     $query = $query->condition('cond1', 'LOWER(data_change_requests.import_file_path) LIKE ?', $search)
                //                     ->condition('cond2', 'LOWER(data_change_requests.requested_data::text) LIKE ?', $search)
                //                     ->where(['cond1', 'cond2'], 'or');
                // }

                if (!empty($_GET['status'])) {
                    $query->filterByStatus($_GET['status']);
                }

                if (!empty($_GET['transaction_type'])) {
                    $query->filterByActionType($_GET['transaction_type']);
                }

                if (!empty($_GET['file_path'])) {
                    $query->filterByImportFilePath('%' . $_GET['file_path'] . '%', Criteria::LIKE);
                }

                if (!empty($_GET['requested_data'])) {
                    $query->where("data_change_requests.requested_data::text like '%" . $_GET['requested_data'] . "%'");
                }

                $count = (clone $query)->count();
                $response["recordsTotal"] = $count;
                $response["recordsFiltered"] = $count;

                $data = $query->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $result = [];

                foreach($data as $row) {
                    $row['RequestedData'] = http_build_query($row['RequestedData'],'',', ');
                    if ($row['Status'] == 'failed') {
                        $row['Action'] = '<a onclick="return loadModalURL(this)" title="Reset" class="btn btn-info" action="javascript:;" remote="/organogram/logs/reset/log/'.$row['DataChangeRequestId'].'">Reset</a>';
                    } else {
                        $row['Action'] = '';
                    }
                    $result[] = $row;
                    unset($row);
                }

                $response['data'] = $result;
                $this->json($response);
        endswitch;

        
        // $this->data['form_name'] = "Organogram";
        // $this->data['disableAdd'] = true;
        // $this->data['disableEdit'] = true;
        // $this->data['cols'] = [
        //     "File Path" => "ImportFilePath",
        //     "Data" => "RequestedData",
        //     "Action Tyoe" => "ActionType",
        //     "Date" => "ScheduleDate",
        //     "Status" => "Status",
        //     "Error?" => "HasError",
        //     "Error Message" => "ErrorMessage"
        // ];

        // $this->data['pk'] = "DataChangeRequestId";

        // switch ($action) :
        //     case "":
        //         $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
        //         break;
        //     case "list":
        //         extract($this->DTFilters($_GET));
        //         $response = [];
        //         $query = \entities\DataChangeRequestsQuery::create()->filterByImportTemplate('Organogram');
        //         $count = $query->count();
        //         $response["recordsTotal"] = $count;
        //         $response["recordsFiltered"] = $count;

        //         $data = $query->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
        //         $result = [];

        //         foreach($data as $row) {
        //             // print_r($row['RequestedData']);
        //             // exit;
        //             $row['RequestedData'] = http_build_query($row['RequestedData'],'',', ');
        //             $result[] = $row;
        //         }

        //         $response['data'] = $result;
        //         $this->json($response);
        //         break;
        // endswitch;
    }

    public function resetDataChangeLog($logId) {
        $f = FormMgr::formHorizontal();            
        $f->add([                                                            
            'Remark' => FormMgr::text()->label('Remark'),
        ]);
        $this->data['form_name'] = "Are you sure you want to reset this log";

        if($this->app->isPost() && $f->validate()){
            $remark = $this->app->Request()->getParameter("Remark","");
            $changeLog = DataChangeRequestsQuery::create()->findOneByDataChangeRequestId($logId);
            if (!empty($changeLog)) {
                if ($changeLog->getStatus() == 'failed') {
                    $changeLog->setStatus('pending');
                    $changeLog->setHasError(false);
                    $changeLog->setErrorMessage('');
                    $changeLog->save();
                    return true;
                }
            }
            return false;
        }

        $this->data['form'] = $f->html();                
        $this->app->Renderer()->render("modalCommonForm.twig",$this->data);
    }
}