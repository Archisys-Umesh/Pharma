<?php declare(strict_types=1);

namespace Modules\HR\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use entities\AttendanceQuery;
use entities\DailycallsQuery;
use entities\DailycallsSgpioutQuery;
use entities\DarView;
use entities\DarViewQuery;
use entities\DesignationsQuery;
use entities\EmployeeQuery;
use entities\SgpiTransQuery;
use Propel\Runtime\ActiveQuery\Criteria;

class DailyCalls extends \App\Core\BaseController
{
    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function dailyCallsbyattendance($id = 0)
    {
        $attendance = AttendanceQuery::create()->findPk($id);

        $action = $this->app->Request()->getParameter("action", "");
        switch ($action):

            case "":
                $this->data["expense"] = $attendance->getExpenses();
                $this->data["emp"] = $attendance->getEmployee();
                $this->data["attendance"] = $attendance;
                $count =0;
                if($attendance->getEmployeeId() != '' && $attendance->getAttendanceDate() !=''){
                    $dcrDate = $attendance->getAttendanceDate()->format('Y-m-d');
                    $count =  DarViewQuery::create()
                            ->filterByDcrDate($dcrDate)
                            ->filterByEmployeeId($attendance->getEmployeeId())
                            ->count();
                }
                $this->data["VisitCount"] = $count;
                $this->data['id_fields'] = ["Managers"];
                $this->data['user_role'] = $this->app->Auth()->getUser()->getRoles()->getRoleName();
                $this->app->Renderer()->render("hr/dailyCalls.twig", $this->data);
                break;
            case "list":
                $dcrDate = $attendance->getAttendanceDate()->format('Y-m-d');
                // $this->json(["data" => DarViewQuery::create()
                //     ->filterByDcrDate($dcrDate)
                //     ->filterByEmployeeId($attendance->getEmployeeId())
                //     ->find()->toArray()
                // ]);

                extract($this->DTFilters($_GET));
                $response = [];
                $query = DarViewQuery::create()->filterByDcrDate($dcrDate)->filterByEmployeeId($attendance->getEmployeeId());
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query = $query->filterByPricebookName($search, Criteria::LIKE);
                }

                $count = $query->count();

                $response["recordsFiltered"] = $count;

                $dailyCalls = $query->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $dailyCallArr = [];
                foreach ($dailyCalls as $dailyCall){
                    $designation = null;
//                    $dailyCall['Managers'] = "487,4576";
                    if ($dailyCall['Managers']!=null){
                        $managerData = explode(",", $dailyCall['Managers']);
                        $employee = EmployeeQuery::create()->select(['DesignationId'])->filterByEmployeeId($managerData)->find()->toArray();
                        if (count($employee)>0){
                         $designationData = DesignationsQuery::create()->select(['Designation'])->filterByDesignationId($employee)->find()->toArray();
                            $designation = implode(',',$designationData);
                        }
                    }
                    $dailyCall['ManagerDesignation'] = $designation;
                    $dailyCallArr[] = $dailyCall;
                }
                $response['data'] = $dailyCallArr;
                $this->json($response);
                break;
               
            case "form":
                $pk = $this->app->Request()->getParameter("pk", 0);
                $dailyCallSgpiOut = DailycallsSgpioutQuery::create()->filterByDailycallId($pk)->find()->toArray();

                foreach ($dailyCallSgpiOut as $daily) {
                    SgpiTransQuery::create()
                        ->filterBySgpiId($daily['SgpiId'])
                        ->filterByQty($daily['SgpiQty'])
                        ->filterByVoucherNo($daily['SgpiVoucherId'])
                        ->filterByCd('D')
                        ->delete();
                }

                DailycallsSgpioutQuery::create()->filterByDailycallId($pk)->delete();
                DailycallsQuery::create()->findByDcrId($pk)->delete();

                echo "Daily calls Data deleted Succssfully and id is:" . $pk;

                $this->data["expense"] = $attendance->getExpenses();
                $this->data["emp"] = $attendance->getEmployee();
                $this->data["attendance"] = $attendance;
                $this->data['id_fields'] = ["Managers"];
                $this->app->Renderer()->render("hr/dailyCalls.twig", $this->data);

                break;
        endswitch;


    }

    public function deleteCalls($id)
    {
        $dailyCalls = DailycallsQuery::create()->filterByDcrId($id)->findOne();
        $dailyCalls->delete();
        return;
    }

}