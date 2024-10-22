<?php declare(strict_types=1);

namespace Modules\HR\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use App\Core\MediaManager;
use BI\manager\ExpManager;
use BI\manager\OrgManager;
use entities\AnnouncementsQuery;
use entities\Base\DailycallsSgpioutQuery;
use entities\Base\OrgUnitQuery;
use entities\BranchQuery;
use entities\DailycallsQuery;
use entities\DesignationsQuery;
use entities\EmployeeLeaveBalanceQuery;
use entities\EmployeeQuery;
use entities\AttendanceQuery;
use entities\GeoTownsQuery;
use entities\PositionsQuery;
use entities\SgpiEmployeeBalanceQuery;
use entities\SgpiMasterQuery;
use entities\SgpiTransactionView;
use entities\SgpiTransactionViewQuery;
use entities\SgpiTransQuery;
use entities\StpQuery;
use entities\UsersQuery;
use entities\UserSessionsQuery;
use Modules\HR\Runtime\HrHelper;
use BI\manager\NotificationManager;
use entities\Base\UsersQuery as BaseUsersQuery;
use Modules\ESS\Runtime\EssHelper;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\System\Controllers\Orgstructure;
use function Symfony\Component\Config\Definition\Builder\find;


class Masters extends \App\Core\BaseController
{
    protected $app;


    public function __construct(App $app)
    {
        $this->app = $app;
    }


    public function employeeList($id = 0)
    {  
        $roles = $this->app->Auth()->getUser()->getRoles()->getRoleName();
        if ($this->isAjax()) {
           
            $positionId = $this->app->Auth()->getUser()->getEmployee()->getPositionId();
            if (isset($_GET['page'])) {
                $page = (int)$_GET['page'];
            } else {
                $page = 1;
            }

            $data = OrgManager::getUnderPositions($positionId); 
            if($this->app->Auth()->checkPerm("all_emp_perm") == true){ 
                $emps = \entities\EmployeeQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->leftjoinWithDesignations()
                    ->leftJoinWith("PositionsRelatedByReportingTo Reporting")
                    ->leftJoinWithPositionsRelatedByPositionId()
                    ->orderByEmployeeId(\Propel\Runtime\ActiveQuery\Criteria::DESC);
                    
            } else {

                $totalPositions = PositionsQuery::create()
                    ->select(['CavPositionsDown'])
                    ->filterByPositionId($this->app->Auth()->getUser()->getEmployee()->getPositionId())
                    ->find()->toArray();
                $emps = "";
                if (count($totalPositions) > 0) {
                    $cav = explode(',', $totalPositions[0]);
                    $emps = \entities\EmployeeQuery::create()
                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                        ->leftjoinWithDesignations()
                        ->leftJoinWithPositionsRelatedByPositionId()
                        ->leftJoinWith("PositionsRelatedByReportingTo Reporting")
                        ->filterByPositionId($cav)
                        ->orderByEmployeeId(\Propel\Runtime\ActiveQuery\Criteria::DESC);
                }
            }
            
            /*if ($roles == "DivisionHead" && $roles == "ClusterHead") {

                if ($data == null) {
                    $emps = "";
                } else {
                    $emps = \entities\EmployeeQuery::create()
                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                        ->leftjoinWithDesignations()
                        ->leftjoinWithPositionsRelatedByReportingTo()
                        ->filterByPositionId($data)
                        ->orderByEmployeeId(\Propel\Runtime\ActiveQuery\Criteria::DESC);

                }

            } else {
                $emps = \entities\EmployeeQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->leftjoinWithDesignations()
                    ->leftjoinWithPositionsRelatedByReportingTo()
                    ->orderByEmployeeId(\Propel\Runtime\ActiveQuery\Criteria::DESC);

            }*/

            if (isset($_GET['status'])) {

                $emps->filterByStatus((int)$_GET['status']);
            }

            if (isset($_GET['designation']) && $_GET['designation'] > 0) {

                $emps->filterByDesignationId($_GET['designation']);
            }
            if (isset($_GET['grade']) && $_GET['grade'] > 0) {
                $emps->filterByGradeId($_GET['grade']);
            }

            if (isset($_GET['orgUnit']) && $_GET['orgUnit'] > 0) {

                $emps->filterByOrgUnitId($_GET['orgUnit']);
            }

            if (!$this->app->Auth()->checkPerm("user_system")) {

                $orgManager = new OrgManager();
                $positions = $orgManager->getUnderPositions($this->app->Auth()->getUser()->getEmployee()->getPositionId());
                $emps->filterByPositionId($positions);
            }

            if ($id == "locked") {
                $emps->filterByEmployeeId(HrHelper::getDayLockedEmployees($this->app->Auth()->CompanyId()));
                $emps->filterByIslocked(false);
            }
            if ($id == "freezed") {
                $emps->filterByIslocked(true);
            }
            
            if (isset($_GET['search']) && !empty($_GET['search'])) {

                $search = strtolower('%' . $_GET['search'] . '%');

                // $emps->condition('cond1', 'LOWER(employee.first_name) LIKE ?', $search)
                //     ->condition('cond2', 'LOWER(employee.last_name) LIKE ?', $search)
                //     ->condition('cond3', 'employee.employee_code LIKE ?', $search)
                //     ->where(['cond1', 'cond2', 'cond3'], 'or');
                
                $fullNameSearch = '%' . strtolower($search) . '%';
                $emps->condition('cond1', 'LOWER(employee.first_name || \' \' || employee.last_name) LIKE ?', $fullNameSearch)
                    ->condition('cond2', 'LOWER(employee.first_name) LIKE ?', $fullNameSearch)
                    ->condition('cond3', 'LOWER(employee.last_name) LIKE ?', $fullNameSearch)               
                    ->condition('cond4', 'employee.employee_code LIKE ?', $fullNameSearch)
                    ->condition('cond5', 'employee.phone LIKE ?', $fullNameSearch)
                    ->where(['cond1', 'cond2', 'cond3', 'cond4', 'cond5'], 'or');

            }

            $emps->findByCompanyId($this->app->Auth()->CompanyId());
            $pager = $emps->paginate($page, 10);
            $links = $pager->getLinks();
            $pageLinks = [];
           
            if (count($links) > 6) {
                $pageLinks = array_slice($links, 0, 3);
                $pageLinks[] = '...';
                $pageLinks = array_slice($links, -3, 3, true);
            } else {
                $pageLinks = $links;
                
            }
           
            $paginateItems = [
                'records' => $pager->getResults()->toArray(),
                'permis' =>$roles,
                'pagination' => [
                    'total_records' => $pager->getNbResults(),
                    'needsPagination' => $pager->haveToPaginate(),
                    'currentPage' => $page,
                    'links' => $pageLinks,
                    'isFirstPage' => $pager->isFirstPage(),
                    'isLastPage' => $pager->isLastPage(),
                ]
            ];
           //print_r($paginateItems);die;
            $this->json($paginateItems);
            // $this->json($emps->toArray());
        } else {
            $this->data['canAdd'] = $this->app->Auth()->checkPerm("user_system");
            
           //print_r($this->data['acclocked']);die;
            if ($id <> 0) {
                $this->data['canAdd'] = false;
            }

            $this->data['firstEmployee'] = \Modules\System\Runtime\UserTriggers::checkOnce("firstEmployee", $this->app->Auth()->getUser()->getUserId());
            if($this->app->Auth()->checkPerm("all_emp_perm") == true){
                $this->data['orgUnit'] = \entities\OrgUnitQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Orgunitid", "UnitName");
                $this->data['grade'] = \entities\GradeMasterQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Gradeid", "GradeName");
                $this->data['designation'] = \entities\DesignationsQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("DesignationId", "Designation");
            } else {
                $orgUnit = $this->app->Auth()->getUser()->getEmployee()->getOrgUnitId();
                $this->data['orgUnit'] = \entities\OrgUnitQuery::create()->filterByOrgunitid($orgUnit)->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Orgunitid", "UnitName");

                $cavPositions = PositionsQuery::create()
//                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->select(['CavPositionsDown'])
                    ->filterByPositionId($this->app->Auth()->getUser()->getEmployee()->getPositionId())
                    ->find()->toArray();
                $employee = "";
                if (count($cavPositions)>0) {

                    $cav = explode(',', $cavPositions[0]);
                    $employee = \entities\EmployeeQuery::create()
                        ->select('DesignationId')
//                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                        ->filterByPositionId($cav)
                        ->filterByStatus(1)
                        ->find()->toArray();
                }
                $this->data['designation'] = \entities\DesignationsQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("DesignationId", "Designation");
                if ($employee != "") {
                    $designation = array_unique($employee);
                    $this->data['designation'] = \entities\DesignationsQuery::create()->filterByDesignationId($designation)->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("DesignationId", "Designation");
                }
                $this->data['grade'] = \entities\GradeMasterQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Gradeid", "GradeName");

            }
            
            $this->app->Renderer()->render("hr/employeeList.twig", $this->data);
        }


    }

    public function EmployeeLeaveBalance()
    {
        $action = $this->app->Request()->getParameter("action");
        $this->data['reportname'] = "EmployeeLeaveBalance";
        $this->data['title'] = "EmployeeLeaveBalance";
       
        switch ($action) :
            case "":
               
                
                if ($this->app->Auth()->checkPerm("all_emp_perm") == true) {

                    $employee = EmployeeQuery::create()->withColumn("CONCAT(CONCAT(first_name, ' ', last_name),'(',employee_code,')')", 'FullName')->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue('EmployeeId','FullName');

                } else { 
                    $cavPositions = PositionsQuery::create()
                        ->select(['CavPositionsDown'])
                        ->filterByPositionId($this->app->Auth()->getUser()->getEmployee()->getPositionId())
                        ->find()->toArray();
                   
                    if (count($cavPositions) > 0) {
                        $cav = explode(',', $cavPositions[0]);
                        $employee = EmployeeQuery::create()->filterByPositionId($cav)->withColumn("CONCAT(CONCAT(first_name, ' ', last_name),'(',employee_code,')')", 'FullName')->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue('EmployeeId','FullName');
                    }
                }
                $f = FormMgr::form();
                $f->add([
                    "employee" => FormMgr::select()->options([0 => '-------Select Employee-------'] + $employee)->label("Employee"),
                ]);


                $this->data['filters'] = $f->html();


                $this->data['cols'] = [
                    "EmployeeId" => "EmployeeId",
                    "LeaveYear" => "LeaveYear",
                    "LeaveType" => "LeaveType",
                    "Accuration" => "Accuration",
                    "Opening" => "Opening",
                    "Reward" => "Reward",
                    "Consumed" => "Consumed",
                    "Balance" => "Balance",
                ];


                $this->data['Download'] = true;
//                $this->data['rowButtons'] = ["survey_question" => "zmdi zmdi-layers", "survey_options" => "zmdi zmdi-eye"];

                $this->app->Renderer()->render("reports/reportViewer.twig", $this->data);
                break;
            case "result":
                extract($this->DTFilters($_GET));
                $darview = EmployeeLeaveBalanceQuery::create()->setFormatter('Propel\Runtime\Formatter\ArrayFormatter');
                $employees = $this->app->Request()->getParameter("employee");

                if ($employees != null) {
                    $darview->filterByEmployeeId($employees);
                }
                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $darview = $darview->filterByEmployeeId($search, Criteria::LIKE)
                            ->_or()
                        ->filterByEmployeeId($search, Criteria::LIKE)
                        ->_or()
                        ->filterByLeaveYear($search, Criteria::LIKE)
                        ->_or()
                        ->filterByLeaveType($search, Criteria::LIKE)
                        ->_or()
                        ->filterByAccuration($search, Criteria::LIKE)
                        ->_or()
                        ->filterByOpening($search, Criteria::LIKE)
                        ->_or()
                        ->filterByReward($search, Criteria::LIKE)
                        ->_or()
                        ->filterByConsumed($search, Criteria::LIKE)
                        ->_or()
                        ->filterByBalance($search, Criteria::LIKE);
                }

                $count = $darview->count();
                $response["recordsTotal"] = $count;



                $count = $darview->count();
                $response["recordsFiltered"] = $count;


                $response["data"] = $darview->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);

                /*extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\SurveySubmitedAnswerQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->joinWith('SurveySubmitedAnswer.SurveyQuestion')
                    ->joinWith('SurveySubmitedAnswer.SurveySubmited')
                    ->joinWith('SurveyQuestion.Survey')
                    ->joinWith('Survey.SurveyCategory')
                    ->joinWith('Survey.OutletType')
                    ->filterByCompanyId($this->app->Auth()->CompanyId());

                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query = $query->filterBySurveyAnswer($search, \Propel\Runtime\ActiveQuery\Criteria::LIKE);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);*/


                // $this->json(["aaData" => $darview]);
                break;
            default:
                $this->json(["aaData" => []]);
                break;
        endswitch;


    }

    public function employeeForm($id = 0)
    {
        $mediaManager = new MediaManager($this->app);
        $this->data['form_name'] = "Employee";
        if (isset($_GET['position_id'])) {
            $pos_id = $this->app->Request()->getParameter("position_id");
            $report_id = \entities\PositionsQuery::create()->findPk($pos_id)->getReportingTo();
            return $this->json(["report_to" => $report_id]);
        }

        $positions["0"] = " -Does not Approve- ";
        $reporting_to = [];

        $datachange = $this->app->Request()->getParameter("datachange");


        $position = \entities\PositionsQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId());
        if ($datachange == "orgSelected") {
            $OrgUnitId = $this->app->Request()->getParameter("OrgUnitId");
            $position = $position->filterByOrgUnitId($OrgUnitId)->find();
        } else if ($id > 0) {
            $emp = EmployeeQuery::create()->findPk($id);
            $position = $position->filterByOrgUnitId($emp->getOrgUnitId())->find();
        } else {
            $position = $position->find();
        }

        foreach ($position as $p) {
            $emps = $p->getEmployeesRelatedByPositionId();
            $employeesOnPosition = [];
            if ($emps->count() > 0) {
                foreach ($emps as $e) {
                    if ($e->getStatus() == 1) {
                        array_push($employeesOnPosition, $e->getFirstName() . " " . $e->getLastName() . "-" . $e->getEmployeeCode());
                    }
                }

            }
            $isVacant = false;
            if (count($employeesOnPosition) == 0) {
                array_push($employeesOnPosition, " Vacant ");
                $isVacant = true;
            }
            if ($id > 0) {
                $positions[$p->getPrimaryKey()] = $p->getPositionName() . ' [' . implode(",", $employeesOnPosition) . "]";
            } else if ($isVacant) {
                $positions[$p->getPrimaryKey()] = $p->getPositionName() . ' [' . implode(",", $employeesOnPosition) . "]";
            }

            $reporting_to[$p->getPrimaryKey()] = implode(",", $employeesOnPosition) . '-' . $p->getPositionName();


            //$reporting_to[$p->getPrimaryKey()] = $p->getPositionName().' ['.implode(",", $employeesOnPosition)."]";
        }

        if ($datachange == "orgSelected") {
            $pos = FormMgr::select()->options($positions)->label('Position')->id("position")->html();
            $reportingTo = FormMgr::select()->options($reporting_to)->label('Reporting To')->id("reportTo")->html();
            $this->json([
                "pos" => $pos,
                "rep" => $reportingTo
            ]);
            return;
        }
        $branchs = \entities\BranchQuery::create()->findByCompanyId($this->app->Auth()->CompanyId());
        $branch = [];
        foreach ($branchs as $b) {
            $branch[$b->getPrimaryKey()] = $b->getBranchname();
        }

        //$reporting_to = \entities\PositionsQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("PositionId","PositionName");
        $designation = \entities\DesignationsQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("DesignationId", "Designation");
        //$departments = \entities\DepartmentsQuery::create()->find()->toKeyValue("DepartmentId","DepartmentName");
        $grade = \entities\GradeMasterQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Gradeid", "GradeName");
        $OrgUnitId = \entities\OrgUnitQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Orgunitid", "UnitName");
        $languages = \entities\LanguageQuery::create()->find()->toKeyValue("LanguageId", "LanguageName");
        //$ZoneId = \entities\ZonesQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("ZoneId","ZoneName");
        //$TerritoryId = \entities\TerritoriesQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("TerritoryId","TerritoryName");
        /*
        $fileUpload = FormMgr::loader([
            'loader' => FormMgr::file()->label('Profile'),
            'field' => FormMgr::hidden() //this hidden input stores the old value
        ]);
        */
        $f = FormMgr::formHorizontal();

        if (count($OrgUnitId) == 1) {
            $f['OrgUnitId'] = FormMgr::hidden()->value(array_keys($OrgUnitId)[0]);
        } else {
            $f['OrgUnitId'] = FormMgr::select()->options($OrgUnitId)->label('Org.Unit')->dataChange('orgSelected');
        }

        $towns = GeoTownsQuery::create()
            ->find()
            ->toKeyValue("Itownid", "Stownname");

        $f->add([

            'FirstName' => FormMgr::text()->label('First Name *')->class("text-uppercase")->required()->minlength(2)->pattern(__NOSPACE_PATERN),
            'LastName' => FormMgr::text()->label('Last Name *')->class("text-uppercase")->required()->minlength(3)->pattern(__NOSPACE_PATERN),
            'EmployeeCode' => FormMgr::text()->label('Employee Code *')->class("text-uppercase")->required(),
            'Email' => FormMgr::email()->label('Email *')->required(),
            'Phone' => FormMgr::tel()->label('Phone')->minlength(10),
            'ResiAddress' => FormMgr::text()->label('Address'),
            'DesignationId' => FormMgr::select()->options($designation)->label('Designation')->id("designation"),
            'PositionId' => FormMgr::select()->options($positions)->label('Position')->id("position"),
            'ReportingTo' => FormMgr::select()->options($reporting_to)->label('Reporting To')->id("reportTo"),
            'GradeId' => FormMgr::select()->options($grade)->label('Grade')->id("grade"),
//            'Itownid' => FormMgr::text()->label('Town *')->id("location")->datatoggle("locationAutoComplete")->required(),
            'Itownid' => FormMgr::text()->label('Town *')->id("location")->datatoggle("locationAutoComplete"),
            'BaseMtarget' => FormMgr::number()->label('Base Monthly Target '),
            'Iseodcheckenabled' => FormMgr::select()->options($this->getConfig("HR", "EODCheckStatus"))->label('EOD Check')->id("eodEnabled"),
            'CanFullSync' => FormMgr::select()->options($this->getConfig("HR", "EODCheckStatus"))->label('CanFullSync')->id("CanFullSync"),
            'EmployeeSpokenLanguage' => FormMgr::select()->options($languages)->label('Spoken Languages')->class("multi-select")->multiple("multiple"),
            'Remark' => FormMgr::textarea()->label('Remark'),

        ]);

        if (count($grade) == 1) {
            $f['GradeId'] = FormMgr::hidden()->value(array_keys($grade)[0]);
        }


        if (count($branch) == 1) {
            $f['BranchId'] = FormMgr::hidden()->value(array_keys($branch)[0]);
        } else {
            $f['BranchId'] = FormMgr::select()->options($branch)->label('HQ');
        }


        $employee = new \entities\Employee();
        $this->data['form_name'] = "Add Employee";
        if ($id > 0) {
            $employee = \entities\EmployeeQuery::create()->findPk($id);
            $vals = $employee->toArray();
            $f->val($vals);
            $this->data['form_name'] = "Edit Employee";
            if ($employee->getPositionId() == "" || $employee->getPositionId() == null) {
                $f["PositionId"]->val("0");
            }
            if ($employee->getItownid() != null && $employee->getItownid() > 0) {
                $f["Itownid"]->sudoValue($employee->getGeoTowns()->getStownname() . " | " . $employee->getGeoTowns()->getGeoCity()->getScityname());
            }

        } else {
            $role = \entities\RolesQuery::create()->findByRolePrivate(0)->toKeyValue("RoleId", "RoleName");

            $f->add([
                'Role' => FormMgr::select()->options($role)->label('Role'),
                'Password' => FormMgr::password()->label('Password *')->required()->minlength(5)->pattern(__PASSWORD_PATERN),
            ]);
        }

        if ($this->app->isPost()) {
            $lan = implode(',',$_POST['EmployeeSpokenLanguage']);
            if ($f->validate()) {

                // var_dump($_POST);exit;

                // $employee->fromArray($_POST);

                $email = $_POST['Email'];

                $emp = \entities\EmployeeQuery::create()->findByEmail($email);

                if ($emp->count() == 0 OR $id > 0) {

                    if ($_POST['PositionId'] == "0") // No Position
                    {
                        $employee->setPositionId(NULL);
                    }


                    try {
                        if ((int)$id == 0) {
                            $employee->setStatus(1);
                            $employee->setIslocked(0);
                        }
                        $employee->setFirstName(strtoupper($_POST['FirstName']));
                        $employee->setLastName(strtoupper($_POST['LastName']));
                        $employee->setPhone($_POST['Phone']);
                        $employee->setEmail($_POST['Email']);
                        $employee->setEmployeeCode($_POST['EmployeeCode']);
                        $employee->setReportingTo((int)$_POST['ReportingTo']);
                        $employee->setOrgUnitId((int)$_POST['OrgUnitId']);
                        $employee->setDesignationId((int)$_POST['DesignationId']);
                        $employee->setPositionId((int)$_POST['PositionId']);
                        $employee->setGradeId((int)$_POST['GradeId']);
                        if (!empty($_POST['Itownid'])) {
                            $employee->setItownid((int)$_POST['Itownid']);
                        }
                        if (!empty($_POST['EmployeeMedia'])) {
                            $employee->setEmployeeMedia((int)$_POST['EmployeeMedia']);
                        }
                        
                        $employee->setBranchId((int)$_POST['BranchId']);
                        $employee->setCompany($this->app->Auth()->getUser()->getCompany());
                        $employee->setEmployeeSpokenLanguage($lan);
                        $employee->setRemark($_POST['Remark']);
                        $employee->save();

                        $user = \entities\UsersQuery::create()->findOneByEmployeeId($employee->getPrimaryKey());
                        // $user->setPhone($employee->getPhone());
                        // $user->setEmail($employee->getEmail());
                        // $user->save();
                        if ($user) {
                            $user->setPhone($employee->getPhone())
                                 ->setEmail($employee->getEmail())
                                 ->save(); 
                        }

                        $serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
                        $serviceContainer->getConnection()->exec("call genrate_sgpi_accounts()");

                        if ((int)$id == 0) {
                            \Modules\HR\Runtime\HrHelper::createUser($employee, $_POST['Role'], $_POST['Password'], $this->app);
                        }
                        $this->runModalScript("reloadGrid()");
                        return;
                    } catch (\Exception $e) {
                        $this->app->Session()->setFlash("error", $e->getMessage());
                    }
                } else {
                    $this->app->Session()->setFlash("error", "Sorry user already exists with this email id !");
                    $f->val($_POST);
                }
            } else {
                $f->val($_POST);
            }

        }


        $mediaInput = $mediaManager->FormInput("EmployeeMedia", "Profile", [$employee->getEmployeeMedia()], 1);
        $form = $f->html();
        $this->data['form'] = $form . $mediaInput;
        $this->app->Renderer()->render("hr/employeeForm.twig", $this->data);
    }

    public function sgpiHistory($id = 0)
    {
        $sgpiHistories = DailycallsSgpioutQuery::create()->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')->joinWithOutlets()->filterBySgpiId($id)->find()->toArray();

        $sgpi = SgpiMasterQuery::create()->filterBySgpiId($id)->findOne();
        $objPHPExcel = new Spreadsheet();
        $objPHPExcel->getActiveSheet();

        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'DebitBalance');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'DcrDate');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'DoctorName');

        $rowCount = 2;
        foreach ($sgpiHistories as $data) {
            $dailyCalls = DailycallsQuery::create()->filterByDcrId($data['DailycallId'])->findOne();
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $data["SgpiQty"]);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $dailyCalls->getDcrDate());
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $data['Outlets']['OutletName']);


        }
        $fileName = 'sgpi_debit' . '.xls';
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($objPHPExcel); //new Xls($objPHPExcel);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName);
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    public function creditSgpiHistory($id = 0, $empId = 0)
    {
        $sgpiHistories = SgpiTransactionViewQuery::create()
                            ->filterBySgpiId($id)
                            ->filterByEmployeeId($empId)
                            ->find()->toArray();
        
        // $sgpi = SgpiTransactionViewQuery::create()->filterBySgpiId($id)->filterByEmployeeId($empId)->findOne();
        $objPHPExcel = new Spreadsheet();
        $objPHPExcel->getActiveSheet();

        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'SgpiName');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'CD(Credit OR Debits)');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Qty');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Credits');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Debits');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'EmployeeId');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'VoucherNo');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Remark');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'OutletName');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'DcrDate');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'OutlettypeName');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'BeatName');
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'UseStartDate');
        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'UseEndDate');
        $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'SgpiId');
        $objPHPExcel->getActiveSheet()->SetCellValue('P1', 'EmployeeCode');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'Date');

        $rowCount = 2;
        foreach ($sgpiHistories as $key => $data) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $data["SgpiName"]);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $data['Cd']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $data['Qty']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $data['Credits']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $data['Debits']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $data['EmployeeId']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $data['VoucherNo']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $data['Remark']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $data['OutletName']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $data['DcrDate']);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $data['OutlettypeName']);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $data['BeatName']);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $data['UseStartDate']);
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $data['UseEndDate']);
            $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $data["SgpiId"]);
            $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $data['EmployeeCode']);
            $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $data['CreatedTa']);
            $rowCount++;
        }

        $fileName = 'sgpi_credit_debit' . '.xlsx';
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($objPHPExcel); //new Xls($objPHPExcel);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName);
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    public function profileForm($id = 0)
    { 
        $this->data['monthList'] = FormMgr::select()
            ->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths(36))
            ->html();

        $employee = \entities\EmployeeQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->findPk($id);


        if (!$this->app->Auth()->checkPerm("user_system")) {
            $this->data["isUserManager"] = true;
        }
        if ($this->app->Auth()->checkPerm("all_emp_perm")) {
            $this->data["editpermis"] = true;
        }
        if ($employee) {
            $action = $this->app->Request()->getParameter("action");
            $stp = StpQuery::create()->filterByStpStatus('submitted')->_or()->filterByStpStatus('approved')->filterByPositionId($employee->getPositionId())->findOne();
            if ($this->isAjax() OR $action == 'advanceForm') {
                $hrDates = $employee->getHrUserDatess()->getFirst();
                switch ($action):
                   
                    case "empRec":
                        $employee->fromArray([$this->app->Request()->getParameter("name") => $this->app->Request()->getParameter("value")]);
                        $employee->setLastUpdatedByUserId($this->app->Auth()->getUser()->getUserId());
                        $employee->save();
                        $user = \entities\UsersQuery::create()->filterByEmployeeId($id)->findOne();
                        $user->setStatus($employee->getStatus());
                        $user->save();
                        $this->json(["status" => "okay"]);
                        break;
                    case "hrDates" :
                        $hrDates->fromArray([$this->app->Request()->getParameter("name") => $this->app->Request()->getParameter("value")]);
                        $hrDates->save();
                        $this->json(["status" => "okay"]);
                        break;
                    case "updatePic" :
                        $file = new \Upload\File('profilePic_0', $this->app->Storage());
                        $new_filename = uniqid();
                        $file->setName($new_filename);
                        $file->upload();
                        $employee->setProfilePicture($file->getNameWithExtension());
                        $employee->save();
                        break;
                    case "hrExp" :
                        $exp = \entities\HrUserExperiencesQuery::create()->orderByFromDate()->findByEmployeeId($id);
                        $this->json($exp->toArray());
                        break;
                    case "hrEdu" :
                        $exp = \entities\HrUserQualificationQuery::create()->orderByYear()->findByEmployeeId($id);
                        $this->json($exp->toArray());
                        break;
                    case "hrRef" :
                        $exp = \entities\HrUserReferencesQuery::create()->findByEmployeeId($id);
                        $this->json($exp->toArray());
                        break;
                    case "hrDoc" :
                        $exp = \entities\HrUserDocumentsQuery::create()->findByEmployeeId($id);
                        $this->json($exp->toArray());
                        break;
                    case "employeeAdvance" :
                        $advance = new \Modules\HR\Runtime\AdvanceHelper($this->app);
                        $response = array('data' => $advance->getTransactions($id)->toArray());
                        $this->json($response);
                        break;

                    case "transactions":
                        $transactions = SgpiEmployeeBalanceQuery::create()
                            ->filterByEmployeeId($id)
                            ->find();

                        $totArr = [];

                        foreach ($transactions as $transaction) {
                            $sgpi = SgpiMasterQuery::create()
                                ->select('SgpiCode')  // Select only the field you need
                                ->filterBySgpiId($transaction->getSgpiId())  // Use getter for correct access
                                ->findOne();

                            $transactionArr = $transaction->toArray();  // Convert to array

                            $transactionArr['SgpiCode'] = $sgpi ? $sgpi : null;  // Use ternary operator

                            $totArr[] = $transactionArr;  // Add modified transaction to array
                        }

                        $response = ['data' => $totArr];
                        $this->json($response);
                        break;
                    case  "leaves" :
                        $leaves = \entities\LeaveRequestQuery::create()->filterByEmployeeId($id)->find();
                        $response = array('data' => $leaves->toArray());
                        $this->json($response);
                        break;
                    case "advanceForm" :

                        //$advance = new \entities\Transactions();
                        //$pk = $this->app->Request()->getParameter("pk",0);
                        $f = FormMgr::formHorizontal();
                        $f->add([
                            'Date' => FormMgr::text()->class('datepicker')->label('Date *')->required(),
                            'Balance' => FormMgr::text()->label('Amount *')->required(),
                            'BalanceType' => FormMgr::select()->options(["1" => "Credit", "-1" => "Debit"])->label('CR/DR *')->required(),
                            'Description' => FormMgr::text()->label('Description *')->required(),
                        ]);

                        $this->data['form_name'] = "Balance";

                        /*
                        $this->data['expense_master'] = "Expense Master";
                        if($pk > 0)
                        {
                            $entity = \entities\ExpenseMasterQuery::create()->findPk($pk);

                            $val = \entities\BudgetExpQuery::create()->select("Bgid")->findByExpenseId($pk)->toArray();
                            $f['Budgets']->val($val);

                            $f->val($entity->toArray());
                            $this->data['form_name'] = "Edit Expense";

                        }
                       */

                        if ($this->app->isPost() && $f->validate()) {


                            $date = \DateTime::createFromFormat("d/m/Y", $this->app->Request()->getParameter("Date"))->format('Y-m-d');
                            $balance = $_POST['Balance'] = $_POST['Balance'] * $_POST['BalanceType'];

                            $advanceManager = new \Modules\HR\Runtime\AdvanceHelper($this->app);
                            $advanceManager->addAdvance($id,
                                $this->app->Request()->getParameter("Description", ""),
                                $date,
                                $balance);

                            /*
                            $_POST['Date'] = \DateTime::createFromFormat("d/m/Y", $this->app->Request()->getParameter("Date"))->format('Y-m-d');
                            $advance->fromArray($_POST);

                            $advance->setEmployeeId($id);
                            $advance->setCreatedBy($this->app->Auth()->getUser()->getEmployeeId());
                            $advance->setCompanyId($this->app->Auth()->CompanyId());
                            $advance->save();
                            if($employee->getUserss()->getFirst()->getFcmToken() != ""){

                                if($balance > 0){
                                    $note = "Amount $balance has been added to your account.";
                                }else{
                                    $note = "Amount abs($balance) has been debited from your account.";
                                }

                                $notification = new \App\Utils\Notifications(\App\Abstracts\NotificationType::URLRedirect,"",[]);
                                $notification->setMessage($note);
                                $notification->setFCMToken($employee->getUserss()->getFirst()->getFcmToken());
                                $a = $notification->sendFCMNotification();
                                $this->logger->addInfo($a,$notification->toArray());
                            }*/

                            if ($balance > 0) {
                                $this->closeModalWithToast("Balance credited successfully.", "reloadAdvanceGrid()");
                            } else {
                                $this->closeModalWithToast("Balance debited successfully.", "reloadAdvanceGrid()");
                            }

                            return;
                        }

                        $this->data['form'] = $f->html();
                        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                        break;
                        case "daylock":
                            
                            if($this->app->isPost()) {
                                $AttId = $this->app->Request()->getParameter("AttId", []);
                                foreach($AttId  as $attid)
                                {
                                    // AttendanceQuery::create()
                                    // ->filterByAttendanceId((int)$attid,\Propel\Runtime\ActiveQuery\Criteria::IN)
                                    // //->filterByAttendanceId((int)$attid)
                                    // ->filterByStatus(-1)
                                    // ->update([
                                    //     "Status" => 0,
                                    //     "Remark" => 'Unlock'
                                    // ]);
                                    $attendance = \entities\AttendanceQuery::create()
                                    ->filterByAttendanceId((int)$attid,\Propel\Runtime\ActiveQuery\Criteria::IN)
                                    ->filterByStatus(-1)
                                    ->find();
                                    
                                    if(count($attendance) > 0)
                                    {
                                        foreach($attendance as $attend)
                                        {
                                        $attDate = $attend->getAttendanceDate()->format('Y-m-d');
                                        $startTime = $attend->getStartTime();
                                        $startTown = $attend->getStartItownid();
                                        $emp_id = $attend->getEmployeeId();
                                        
                                        $leavereq = \entities\LeaveRequestQuery::create()
                                                    ->filterByLeaveFrom($attDate, Criteria::LESS_EQUAL)
                                                    ->filterByLeaveTo($attDate, Criteria::GREATER_EQUAL) 
                                                    ->filterByEmployeeId($emp_id) 
                                                    ->filterByLeaveStatus(2)
                                                    ->find()
                                                    ->toArray();
                                                    
                                        if( $startTime == null  and count($leavereq) == 0)
                                        {
                                            $dailyCalls = \entities\DailycallsQuery::create()
                                                        ->filterByEmployeeId((int)$emp_id)
                                                        ->filterByDcrDate($attend->getAttendanceDate())
                                                        ->find()->count();
                                            if($dailyCalls == 0){
                                                $attend->delete();
                                            }
                                        }
                                        if($startTime != null   and count($leavereq) == 0)
                                        {  
                                            AttendanceQuery::create()
                                                ->filterByEmployeeId((int)$emp_id)
                                                ->filterByStatus(-1)
                                                ->update([
                                                    "Status" => 0,
                                                    "Remark" => $this->app->Request()->getParameter("Remark")
                                                ]);
                                        }
                                        if($startTime != null  and  count($leavereq) > 0)
                                        {
                                            $dailyCalls = \entities\AttendanceQuery::create()
                                            ->filterByEmployeeId((int)$emp_id)
                                            ->filterByAttendanceDate($attend->getAttendanceDate())
                                            ->find()->count();
                                            if($dailyCalls > 0){
                                                $attend->delete();
                                            }
                                        }
                                        if($startTime == null  and  count($leavereq) > 0)
                                        {
                                            $dailyCalls = \entities\AttendanceQuery::create()
                                            ->filterByEmployeeId((int)$emp_id)
                                            ->filterByAttendanceDate($attend->getAttendanceDate())
                                            ->find()->count();
                                            if($dailyCalls > 0){
                                                $attend->delete();
                                            }
                                        }
                                        
                                        }
                                    }
                                    else{
                                        return;
                                    }

                                }
                            $this->closeModal();
                            return;
                            }
                            $dailycalls = \entities\AttendanceQuery::create()
                                          ->filterByEmployeeId($id)
                                          ->filterByStatus(-1)
                                          ->orderByAttendanceDate(\Propel\Runtime\ActiveQuery\Criteria::DESC)
                                          ->find()->toArray();

                                          //print_r($dailycalls);die;
                            $perm = FormMgr::group();
                            $f = FormMgr::formHorizontal();
                            $all=array();
                            if(count($dailycalls)> 0)
                            {
                                foreach($dailycalls as $dc)
                                {
                                    $pk = $dc['AttendanceId'];
                                    $all[] .=$dc['AttendanceId'];
                                    if(!isset($rows[$pk])) {
                                        
                                        $perm->add([
                                            //$all =>FormMgr::checkbox()->label('All')->value('all'),
                                            $pk => FormMgr::checkbox()->attr("data-toggle", "modal")->label($dc['AttendanceDate'])->value($pk)->class('attday')]);
                                    }
                                } 
                                $Alldays = implode(', ', $all); 
                            
                                $f->add(['all'=>FormMgr::checkbox()->label('Dates')->value($Alldays)->id('Alldays'),]);
                            }
                            if(count($perm) > 0) {
                                $f["AttId"] = $perm;
                            } else {
                                $this->app->Session()->setFlash("error", "No date are locked for this user.");
                            }    

                            $this->data['form_name'] = "Day Unlock";
                            $this->data['form'] = $f->html();
                            $this->app->Renderer()->render("hr/daylockunlock.twig", $this->data);                       
                            
                        break;
                endswitch;


            } else {

                $this->data["emp"] = $employee;
                $this->data["empDates"] = $employee->getHrUserDatess()->getFirst();

                if ($this->data["empDates"] == null) {
                    $hrDates = new \entities\HrUserDates();
                    $hrDates->setEmployee($employee);
                    $hrDates->save();
                    $this->data["empDates"] = $hrDates;
                }


                $this->data["recentExpenses"] = \entities\ExpensesQuery::create()
                    ->filterByEmployeeId($employee->getEmployeeId())
                    ->orderByExpId(\Propel\Runtime\ActiveQuery\Criteria::DESC)
                    ->limit(5)
                    ->find();


                $wfManager = new \Modules\System\Processes\WorkflowManager();
                $this->data['valKeys'] = [
                    "ExpStatus" => $wfManager->getStatusList('Expenses')
                ];

                $user = \entities\UsersQuery::create()->findByEmployeeId($employee->getEmployeeId())
                    ->getFirst();
                if ($user) {
                    $this->data["user"] = $user;
                } else {
                    $this->data["user"] = "";
                }
                $this->data["getEmployeeId"] = $employee->getEmployeeId();


                $advance = new \Modules\HR\Runtime\AdvanceHelper($this->app);

                $this->data["advanceBalance"] = $advance->getBalance($id);
                $this->data["stp"] = $stp;

                $this->app->Renderer()->render("hr/empProfileForm.twig", $this->data);
            }
        } else {
            $this->app->Response()->redirect($this->app->Router()->getPath("hr_empList"));

        }
    }

    function getUserSession($id)
    {
        $this->data['title'] = "User Session";
        $this->data['form_name'] = "";
        $this->data['cols'] = [
            "sessionId" => "SessionId",
            "UserId" => "Users.Name",
            "Device" => "Device",
            "DeviceName" => "DeviceName",
            "IpAddress" => "IpAddress",
            "CreatedAt" => "CreatedAt",
        ];

        $this->data['pk'] = "SessionId";
        $this->data['disableAdd'] = true;
        $this->data['disableEdit'] = true;
        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "list":

              $userSessions =  UserSessionsQuery::create()
                    ->joinWithUsers()
                    ->filterByUserId($id)
                    ->find()
                    ->toArray();

            foreach ($userSessions as &$session) {
                // Assuming you want to set a link on the 'columnName' column
                $session['IpAddress'] = '<a href="https://www.whatismyip.com/ip/'. $session["IpAddress"] .'" target="_blank">' . $session['IpAddress'] . '</a>';
            }
                    
                $this->json(["data" => $userSessions]);
                break;

        endswitch;

    }

    public function userHrAccount($id = 0)
    {
        $hrAccount = \entities\HrUserAccountQuery::create()->findByEmployeeId($id)->getFirst();
        $f = FormMgr::formHorizontal();
        $f->add([
            'PersonalBank' => FormMgr::text()->label('Bank Name')->id('PersonalBank'),
            'PersonalAccountNumber' => FormMgr::text()->label('Account Number')->id('PersonalAccountNumber'),
            //'PfEsicContribution' => FormMgr::text()->label('PF ESIC Contribution')->id('PfEsicContribution'),            
            //'PfNumber' => FormMgr::text()->label('PF Number')->id('PfNumber'),
            //'EsciNumber' => FormMgr::text()->label('ESIC Number')->id('EsciNumber'),
            //'GrossSalary' => FormMgr::text()->label('Gross Salary')->id('GrossSalary'),
            'PaymentMode' => FormMgr::select()->options([1 => "ECS", 2 => "By Cheque", 3 => "By Cash"])->label('Payment Method')->id('PaymentMode'),
            //'SalaryBank' => FormMgr::text()->label('Salary Bank Name')->id('SalaryBank'),            
            //'SalaryAccountNumber' => FormMgr::text()->label('Salary Bank Account')->id('SalaryAccountNumber'),            
            //'TdsStatus' => FormMgr::checkbox()->attr("data-toggle","modal")->label("Deduct TDS")->value(1)->id('TdsStatus')
        ]);

        if ($hrAccount == null) {
            $hrAccount = new \entities\HrUserAccount();
        } else {
            $vals = $hrAccount->toArray();
            $f->val($vals);
        }

        if ($this->app->isPost()) {

            if ($f->validate()) {

                $hrAccount->fromArray($_POST);

                $hrAccount->setTdsStatus($this->app->Request()->getParameter("TdsStatus", 0)); // Checkbox settings

                $hrAccount->setEmployeeId($id);
                $hrAccount->save();
                $f->val($hrAccount->toArray());
            }
        }
        $this->data['form'] = $f->html();

        $this->data["formName"] = "Account Details";
        $this->app->Renderer()->render("widgetForm.twig", $this->data);
    }

    public function employeeExp($id = 0)
    {

        $f = FormMgr::formHorizontal();

        $f->add([
            'NameOfCompany' => FormMgr::text()->label('Company Name *')->required(),
            'Designation' => FormMgr::text()->label('Designation *')->required(),
            'FromDate' => FormMgr::text()->label('FromDate *')->required()->class('datepicker'),
            'ToDate' => FormMgr::text()->label('ToDate *')->required()->class('datepicker'),
            'Job' => FormMgr::text()->label('Job'),
            'StartSalary' => FormMgr::number()->label('StartSalary'),
            'EndSalary' => FormMgr::number()->label('EndSalary'),
            'ReasonForDepart' => FormMgr::text()->label('ReasonForDepart'),
            'EmployeeId' => FormMgr::hidden()->value($_GET["empId"]),

        ]);


        $hruserExp = new \entities\HrUserExperiences();

        if ($id > 0) {
            $hruserExp = \entities\HrUserExperiencesQuery::create()->findPk($id);
            $vals = $hruserExp->toArray();
            $f->val($vals);
            $f["FromDate"]->val($hruserExp->getFromDate()->format("Y-m-d"));
            $f["ToDate"]->val($hruserExp->getToDate()->format("Y-m-d"));
        }

        if ($this->app->isPost()) {
            if ($f->validate()) {
                $_POST['FromDate'] = \DateTime::createFromFormat("d/m/Y", $this->app->Request()->getParameter("FromDate"));
                $_POST['ToDate'] = \DateTime::createFromFormat("d/m/Y", $this->app->Request()->getParameter("ToDate"));

                $hruserExp->fromArray($_POST);
                //$hruserExp->setEmployeeId();
                $hruserExp->save();
                $this->runModalScript("loadExp()");
                return;

            } else {
                $f->val($_POST);
            }

        }

        $this->data['form_name'] = "Employee Expirence";
        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
    }

    public function employeeEdu($id = 0)
    {

        $f = FormMgr::formHorizontal();

        $f->add([
            'Degree' => FormMgr::text()->label('Degree *')->required(),
            'Year' => FormMgr::text()->label('Year *')->required(),
            'ResultClass' => FormMgr::text()->label('Result Class *')->required(),
            'Institute' => FormMgr::text()->label('Institute *')->required(),
            'EmployeeId' => FormMgr::hidden()->value($_GET["empId"]),
        ]);


        $hruserEdu = new \entities\HrUserQualification();

        if ($id > 0) {
            $hruserEdu = \entities\HrUserQualificationQuery::create()->findPk($id);
            $vals = $hruserEdu->toArray();
            $f->val($vals);
        }

        if ($this->app->isPost()) {
            if ($f->validate()) {

                $hruserEdu->fromArray($_POST);
                $hruserEdu->save();
                $this->runModalScript("loadEdu()");
                return;

            } else {
                $f->val($_POST);
            }

        }

        $this->data['form_name'] = "Employee Qualification";
        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
    }

    public function employeeRef($id = 0)
    {

        $f = FormMgr::formHorizontal();

        $f->add([
            'Name' => FormMgr::text()->label('Name *')->required(),
            'Company' => FormMgr::text()->label('Company *')->required(),
            'ConactInformation' => FormMgr::text()->label('Contact *')->required(),
            'Relation' => FormMgr::text()->label('Relation *')->required(),
            'EmployeeId' => FormMgr::hidden()->value($_GET["empId"]),
        ]);


        $hruserRef = new \entities\HrUserReferences();

        if ($id > 0) {
            $hruserRef = \entities\HrUserReferencesQuery::create()->findPk($id);
            $vals = $hruserRef->toArray();
            $f->val($vals);
        }

        if ($this->app->isPost()) {
            if ($f->validate()) {

                $hruserRef->fromArray($_POST);
                $hruserRef->save();
                $this->runModalScript("loadRef()");
                return;

            } else {
                $f->val($_POST);
            }

        }

        $this->data['form_name'] = "Employee Refrence";
        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
    }

    public function employeeDoc($id = 0)
    {

        $f = FormMgr::formHorizontal();

        $f->add([
            'DocumentId' => FormMgr::text()->label('Document Name *')->required(),
            'remark' => FormMgr::text()->label('remark'),
        ]);


        $hruserDoc = \entities\HrUserDocumentsQuery::create()->findPk($id);

        if ($hruserDoc == null) {
            exit;
        }

        $vals = $hruserDoc->toArray();
        $f->val($vals);

        if ($this->app->isPost()) {
            if ($f->validate()) {

                $hruserDoc->fromArray($_POST);
                $hruserDoc->save();
                $this->runModalScript("loadDoc()");
                return;

            } else {
                $f->val($_POST);
            }

        }

        $this->data['form_name'] = "Documents";
        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
    }

    public function postNewEmpDoc($id = 0)
    {
        $file = new \Upload\File('empDoc_0', $this->app->Storage());
        $new_filename = uniqid();
        $file->setName($new_filename);

        try {

            $doc = new \entities\HrUserDocuments();
            $doc->setDocumentId($new_filename);
            $doc->setScannedFileName($file->getNameWithExtension());
            $doc->setMime($file->getMimetype());
            $doc->setFileSize($file->getSize());
            $doc->setEmployeeId($id);
            $doc->save();
            $file->upload();
            $this->json(["status" => 1]);
        } catch (\Exception $e) {

            $errors = $file->getErrors();
            $this->json(["error" => $errors, "ex" => $e->getMessage()]);

        }

    }


    public function cityCategory()
    {
        ini_set('memory_limit', '256M');
        if ($this->isAjax()) {
            $action = $this->app->Request()->getParameter("action");
            switch ($action):
                case "list":
                    //old code
                    // $this->json(["data" => \entities\CitycategoryQuery::create()
                    //     ->leftJoinWithGradeMaster()
                    //     ->findByCompanyId($this->app->Auth()->CompanyId())->toArray()]);

                    // new code
                    $start = (int)$this->app->Request()->getParameter("start", 0);
                    $length = (int)$this->app->Request()->getParameter("length", 1000000);
                    // Get total count of records
                    $totalRecords = \entities\CitycategoryQuery::create()
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->count();
                    // Fetch paged data
                    $cityCategories = \entities\CitycategoryQuery::create()
                        ->leftJoinWithGradeMaster()
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->offset($start)
                        ->limit($length)
                        ->find()
                        ->toArray();

                    $response = [
                        "draw" => $this->app->Request()->getParameter("draw"),
                        "recordsTotal" => $totalRecords,
                        "recordsFiltered" => $totalRecords,
                        "data" => $cityCategories,
                    ];

                    $this->json($response);
                    break;
            endswitch;
        } else {
            $this->app->Renderer()->render("hr/cityCategory.twig", $this->data);
        }
        ini_set('memory_limit', '-1');
    }

    public function cityCategoryForm($id = 0)
    {
        $this->data['form_name'] = "City Category";
        $data = [];
        $emp = \entities\EmployeeQuery::create()->findByCompanyId($this->app->Auth()->CompanyId());
        foreach ($emp as $e) {
            $data[$e->getPrimaryKey()] = $e->getFirstName() . " " . $e->getLastName() . " | " . $e->getEmployeeCode();
        }

        $grades = \entities\GradeMasterQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId())->find()->toKeyValue("Gradeid", "GradeName");

        $f = FormMgr::formHorizontal();
        $option = $this->getConfig("HR", "CityCategories");
        $f->add([
            'Itownid' => FormMgr::text()->label('City *')->id("location")->datatoggle("locationAutoComplete")->required(),
            'Category' => FormMgr::select()->options($option)->label('Category'),
            'GradeId' => FormMgr::select()->options($grades)->label('Grade'),
            //'Scope' => FormMgr::select()->options(["0" => "Global", "1" => "Employee"])->label('Scope')->id("scope"),
            //'IdentityKey' => FormMgr::select()->options($data)->label('Key')->id("idkey"),
        ]);

        $cityCat = new \entities\Citycategory();
        $this->data['form_name'] = "Add City-Category";
        if ($id > 0) {
            $cityCat = \entities\CitycategoryQuery::create()->findPk($id);
            $vals = $cityCat->toArray();

            $f->val($vals);
            $this->data['form_name'] = "Edit City-Category";
            $f["Itownid"]->sudoValue($cityCat->getGeoTowns()->getStownname());

            $this->data['canDelete'] = true;
        }

        if ($this->app->isPost()) {
            // if ($_POST['Scope'] == 0) {
            //     $otherRows = \entities\Base\CitycategoryQuery::create()
            //         ->filterByItownid($_POST['Itownid'])
            //         ->filterByScope($_POST['Scope'])
            //         ->filterByCitycategoryid($id, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
            //         ->findByCompanyId($this->app->Auth()->CompanyId())->count();
            //     $error = "Sorry City Name already exists !!";
            // } else {
            //     $otherRows = \entities\Base\CitycategoryQuery::create()
            //         ->filterByItownid($_POST['Itownid'])
            //         ->filterByIdentityKey($_POST['IdentityKey'])
            //         ->filterByCitycategoryid($id, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
            //         ->findByCompanyId($this->app->Auth()->CompanyId())->count();
            //     $error = "Sorry City Name already exists from This Employee!!";
            // }

            // if ($otherRows > 0) {
            //     $this->app->Session()->setFlash("error", $error);
            //     $f->val($_POST);
            // } else {
            //     if ($f->validate()) {
            //         $action = $this->app->Request()->getParameter("buttonValue");
            //         if ($action == "delete") {
            //             $cityCat->delete();
            //         } else {
            //             $cityCat->setCompanyId($this->app->Auth()->CompanyId());
            //             $cityCat->setItownid((int)$_POST['Itownid']);
            //             $cityCat->setCityname($_POST['LocationAutoComplete_Itownid']);
            //             $cityCat->setCategory($_POST['Category']);
            //             $cityCat->setGradeId($_POST['GradeId']);
            //             $cityCat->save();
            //         }
            //         $this->runModalScript("loadGrid()");
            //         return;
            //     } else {
            //         $f->val($_POST);
            //     }
            // }
            if ($f->validate()) {
                $action = $this->app->Request()->getParameter("buttonValue");
                if ($action == "delete") {
                    $cityCat->delete();
                } else {
                    $cityCat->setCompanyId($this->app->Auth()->CompanyId());
                    $cityCat->setItownid((int)$_POST['Itownid']);
                    $cityCat->setCityname($_POST['LocationAutoComplete_Itownid']);
                    $cityCat->setScope(0);
                    $cityCat->setIdentityKey(0);
                    $cityCat->setCategory($_POST['Category']);
                    $cityCat->setGradeId($_POST['GradeId']);
                    $cityCat->save();
                }
                $this->runModalScript("loadGrid()");
                return;
            } else {
                $f->val($_POST);
            }

        }


        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("hr/cityCategoryForm.twig", $this->data);
    }

    function expenseMaster($pk = 0)
    {
        $this->data['title'] = "Expense Master";
        $this->data['form_name'] = "Expense";
        $this->data['cols'] = [
            "ExpenseName" => "ExpenseName",
            "Policy" => "DefaultPolicykey",
            "Trips" => "Trips",
            "Mandatory" => "IsMandatory"
        ];

        $this->data['pk'] = "ExpenseId";
        $this->data['valKeys'] = ["Trips" => $this->getConfig("HR", "ExpenseTripOptions"), "IsMandatory" => ["1" => "Yes", "0" => "No", "null" => "No"], "Status" => [0 => "InActive", 1 => "Active"]];

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        $this->data['rowButtons'] = [
            "hr_expenseRepellents" => "zmdi zmdi-layers ajaxModal"
        ];
        $this->data['firstExpenseMaster'] = true;
        $totalExpHead = \entities\ExpenseMasterQuery::create()
            ->findByCompanyId($this->app->Auth()->CompanyId())->count();

        if ($totalExpHead > 0) {
            $this->data['firstExpenseMaster'] = \Modules\System\Runtime\UserTriggers::checkOnce("firstExpenseMaster", $this->app->Auth()->getUser()->getUserId());
        }
        //$this->data['moreButtons'] = ["Add Via Templates" => ["hr_addExpenseViaTemplate","ajaxModal"]];


        switch ($action) :
            case "":
                $this->app->Renderer()->render("hr/expenseManagement.twig", $this->data);
                break;
            case "list":
                $this->json(["data" => \entities\ExpenseMasterQuery::create()
                    ->findByCompanyId($this->app->Auth()->CompanyId())->toArray()]);
                break;
            case "form":

                $keys = \entities\PolicykeysQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Pkeys", "Pkeys");
                $budgets = \entities\BudgetGroupQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Bgid", "GroupName");
                $led = FormMgr::select()->options($budgets)->label('Purpose')->class("multi-select")->multiple("multiple");

                $f = FormMgr::formHorizontal();
                $f->add([
                    'ExpenseName' => FormMgr::text()->label('Title *')->required(),
                    'SortOrder' => FormMgr::number()->label('Sort Order *')->required(),
                    'DefaultPolicykey' => FormMgr::select()->options($keys)->label('PolicyKey')->id("policykey"),
                    'Checkcity' => FormMgr::checkbox()->label('Check City')->id("checkCity"),
                    'Policykeya' => FormMgr::select()->options($keys)->label('Metro(Class A)')->id("policyA"),
                    'Policykeyb' => FormMgr::select()->options($keys)->label('Non Metro(Class B)')->id("policyB"),
                    'Policykeyc' => FormMgr::select()->options($keys)->label('Other')->id("policyC"),
                    'Trips' => FormMgr::select()->options($this->getConfig("HR", "ExpenseTripOptions"))->label('Trips'),
                    'Budgets' => $led,
                    'IsMandatory' => FormMgr::checkbox()->label('Mandatory')->id("IsMandatory"),
                    //'CanRepeat' => FormMgr::checkbox()->label('Can Repeat')->id("CanRepeat"),
                    'IsPrefilled' => FormMgr::checkbox()->label('Is Prefilled')->id("IsPrefilled"),
                    'Israteapplied' => FormMgr::checkbox()->label('Is Rate Applied')->id("Israteapplied"),
                    'Rate' => FormMgr::number()->label('Rate')->id("Rate")->step("0.01"),
                    'Permonth' => FormMgr::checkbox()->label('Once Per Month')->id("Permonth"),
                    'Isdaily' => FormMgr::checkbox()->label('Has Options')->id("Isdaily"),
                    'Mode' => FormMgr::text()->label('Options')->id("Mode")->datarole("tagsinput"),
                    'Nonreimbursable' => FormMgr::checkbox()->label('Paid by Company')->id("Nonreimbursable"),
                    //'Rate' => FormMgr::select()->options($keys)->label('Rate')->id("Rate"),
                    'Commentreq' => FormMgr::checkbox()->label('Expense Remark Required')->id("Commentreq"),
                    //'AdditionalText' => FormMgr::checkbox()->label('GST')->id("AdditionalText"),
                    //'IsEditable' => FormMgr::checkbox()->label('Is Editable')->id("IsEditable"),
                    'AttachmentRequired' => FormMgr::checkbox()->label('Attachment Required')->id("AttachmentRequired"),

                ]);
                $entity = new \entities\ExpenseMaster();
                $this->data['form_name'] = "Add Expense Heads";
                $this->data['expense_master'] = "Expense Master";
                if ($pk > 0) {
                    $entity = \entities\ExpenseMasterQuery::create()->findPk($pk);
                    $val = \entities\BudgetExpQuery::create()->select("Bgid")->findByExpenseId($pk)->toArray();
                    $f['Budgets']->val($val);
                    $f->val($entity->toArray());
                    $this->data['form_name'] = "Edit Expense";
                } else {
                    $f['IsMandatory']->checked();
                }

                if ($this->app->isPost() && $f->validate()) {

                    $entity->setExpenseName($_POST['ExpenseName']);
                    $entity->setSortOrder($_POST['SortOrder']);
                    $entity->setDefaultPolicykey($_POST['DefaultPolicykey']);


                    if (!empty($_POST['Checkcity'])) {
                        $checkcity = 1;
                    } else {
                        $checkcity = 0;
                    }

                    $entity->setCheckcity($checkcity);
                    $entity->setPolicykeya($_POST['Policykeya']);
                    $entity->setPolicykeyb($_POST['Policykeyb']);
                    $entity->setPolicykeyc($_POST['Policykeyc']);
                    $entity->setTrips($_POST['Trips']);
                    if (!empty($_POST['IsMandatory'])) {
                        $isMandatory = 1;
                    } else {
                        $isMandatory = 0;
                    }
                    $entity->setIsMandatory($isMandatory);
                    if (!empty($_POST['IsPrefilled'])) {
                        $isPrefilled = 1;
                    } else {
                        $isPrefilled = 0;
                    }
                    $entity->setIsPrefilled($isPrefilled);
                    if (!empty($_POST['Israteapplied'])) {
                        $israteapplied = 1;
                    } else {
                        $israteapplied = 0;
                    }
                    $entity->setIsrateapplied($israteapplied);
                    $entity->setRate($_POST['Rate']);
                    if (!empty($_POST['Isdaily'])) {
                        $isdaily = 1;
                    } else {
                        $isdaily = 0;
                    }
                    $entity->setIsdaily($isdaily);
                    $entity->setMode($_POST['Mode']);
                    if (!empty($_POST['Nonreimbursable'])) {
                        $nonreimbursable = 1;
                    } else {
                        $nonreimbursable = 0;
                    }
                    if (isset($_POST['IsEditable']) && !empty($_POST['IsEditable'])) {
                        $iseditable = true;
                    } else {
                        $iseditable = false;
                    }
                    if (!empty($_POST['Permonth'])) {
                        $permonth = true;
                    } else {
                        $permonth = false;
                    }
                    if (!empty($_POST['Commentreq'])) {
                        $commentreq = true;
                    } else {
                        $commentreq = false;
                    }
                    if (!empty($_POST['AttachmentRequired'])) {
                        $attRequired = true;
                    } else {
                        $attRequired = false;
                    }
                    $entity->setNonreimbursable($nonreimbursable);
                    $entity->setIsEditable($iseditable);
                    $entity->setPermonth($permonth);
                    $entity->setCommentreq($commentreq);
                    $entity->setAttachmentRequired($attRequired);
                    $entity->setCompanyId($this->app->Auth()->CompanyId());
                    $entity->save();

                    if (isset($_POST['Budgets'])) {
                        $Bgids = $_POST['Budgets'];
                        \entities\BudgetExpQuery::create()->findByExpenseId($entity->getPrimaryKey())->delete();
                        foreach ($Bgids as $bg) {
                            $map = new \entities\BudgetExp();
                            $map->setBgid($bg);
                            $map->setExpenseId($entity->getPrimaryKey());
                            $map->save();
                        }
                    }

                    $this->runModalScript("loadExpenseGrid()");
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("hr/expenseMasterForm.twig", $this->data);
                break;
        endswitch;
    }

    function addExpenseViaTemplate()
    {
        $budgets = \entities\BudgetGroupQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Bgid", "GroupName");

        $f = FormMgr::formHorizontal();
        $f->add([
            'Budgets' => FormMgr::select()->options($budgets)->label('Budgets')->class("multi-select")->multiple("multiple"),
        ]);
        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("hr/addExpenseViaTemplate.twig", $this->data);
    }

    function budgetGroups()
    {
        $this->data['title'] = "Purpose Groups";
        $this->data['form_name'] = "purpose";
        $this->data['cols'] = [
            "Purpose" => "GroupName",
            "Purpose Code" => "Groupcode",
            "Notes" => "Notes",
            "Status" => "Status",
            "Limit" => "Maxlimit",
        ];

        $this->data['pk'] = "Bgid";

        $this->data['rowButtons'] = [
            "hr_manageBudget" => "zmdi zmdi-layers ajaxModal"
        ];

        $this->data['valKeys'] = ["Status" => [0 => "InActive", 1 => "Active"]];

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "list":
                $this->json(["data" => \entities\BudgetGroupQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toArray()]);
                break;
            case "form":

                $expenses = \entities\ExpenseMasterQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("ExpenseId", "ExpenseName");
                $led = FormMgr::select()->options($expenses)->label('Expenses')->class("multi-select")->multiple("multiple");
                $f = FormMgr::formHorizontal();
                $f->add([

                    'GroupName' => FormMgr::text()->label('Title *')->required(),
                    'Maxlimit' => FormMgr::number()->label('Budget *')->required(),
                    'Notes' => FormMgr::text()->label('Notes'),
                    'Expenses' => $led,
                    'Status' => FormMgr::select()->options([0 => "Inactive", 1 => "Active"])->label('Status'),
                    'IsDefault' => FormMgr::checkbox()->label('Is Default'),
                ]);
                $groups = new \entities\BudgetGroup();
                $this->data['form_name'] = "Add Purpose";
                if ($pk > 0) {
                    $groups = \entities\BudgetGroupQuery::create()->findPk($pk);
                    $val = \entities\BudgetExpQuery::create()->select("ExpenseId")->findByBgid($pk)->toArray();
                    $f['Expenses']->val($val);
                    $f->val($groups->toArray());
                    $this->data['form_name'] = "Edit Purpose";
                }
                if ($this->app->isPost() && $f->validate()) {
                    if (!empty($_POST['IsDefault'])) {
                        $IsDefault = true;
                    } else {
                        $IsDefault = false;
                    }
                    $groups->fromArray($_POST);
                    //$groups->setGroupName($iosRecs[$groups->getGroupcode()]->getPurpose());
                    $groups->setCompanyId($this->app->Auth()->CompanyId());
                    $groups->setIsDefault($IsDefault);
                    $groups->save();
                    if (isset($_POST['Expenses'])) {
                        $expids = $_POST['Expenses'];
                        \entities\BudgetExpQuery::create()->findByBgid($groups->getPrimaryKey())->delete();
                        foreach ($expids as $exp) {
                            $map = new \entities\BudgetExp();
                            $map->setBgid($groups->getPrimaryKey());
                            $map->setExpenseId($exp);
                            $map->save();
                        }
                    }
                    $this->runModalScript("loadBudgetGrid()");
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    public function manageBudget()
    {

        $this->data['form_name'] = "Purpose Grade Mapping";
        $id = $this->app->Request()->getParameter("pk");
        if ($this->app->isPost()) {
            if (isset($_POST['GradeId'])) {
                $gids = $_POST['GradeId'];
                \entities\BudgetGradesQuery::create()->findByBgid($id)->delete();
                foreach ($gids as $gid) {
                    $map = new \entities\BudgetGrades();
                    $map->setBgid($id);
                    $map->setGradeId($gid);
                    $map->save();
                }
            }
            $this->runModalScript("loadGrid()");
            return;
        }
        $grades = \entities\GradeMasterQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Gradeid", "GradeName");

        $f = FormMgr::formHorizontal();
        $f->add([
            'GradeId' => FormMgr::select()->options($grades)->label('Grade')->class("multi-select")->multiple("multiple")
        ]);
        $this->data['form_name'] = "Manage Purpose Grade Mapping";
        $val = \entities\BudgetGradesQuery::create()->select("GradeId")->findByBgid($id)->toArray();
        $f['GradeId']->val($val);

        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);

    }

    /*
    function ioMaster()
    {
        $this->data['title'] = "IO Master";
        $this->data['form_name'] = "IO";
        $this->data['cols'] = [
            "Purpose" => "Purpose",
            "IO" => "Io",
        ];

        $this->data['pk'] = "Ioid";

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk",0);

        switch($action) :
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig",$this->data);
                break;
            case "list":
                $this->json( ["data" => \entities\IoMasterQuery::create()->find()->toArray()]);
                break;
            case "form":

                     $f = FormMgr::formHorizontal();
                     $f->add([
                         'Io' => FormMgr::text()->label('IO *')->required()->focus(),
                         'Purpose' => FormMgr::text()->label('Purpose *')->required(),
                     ]);
                     $this->data['form_name'] = "Add IO";
                     if($pk > 0)
                     {
                         $entity = \entities\IoMasterQuery::create()->findPk($pk);
                         $f->val($entity->toArray());
                         $this->data['form_name'] = "Edit IO";
                     }
                     else
                     {
                         $entity = new \entities\IoMaster();
                     }

                     if($this->app->isPost() && $f->validate()){
                         try{
                             //duplicate IO validation remove
                             $entity->fromArray($_POST);
                             $entity->save();
                             $this->runModalScript("loadGrid()");
                             return;


                         }
                         catch(\Exception $e)
                         {
                             $this->app->Session()->setFlash("error", $e->getMessage());
                         }
                     }
                     $this->data['form'] = $f->html();
                     $this->app->Renderer()->render("modalCommonForm.twig",$this->data);
                break;
        endswitch;
    }
    */
    /*
    function auditUnitMap()
    {

        $this->data['title'] = "Audit Unit Map";
        $this->data['form_name'] = "Audit";
        $this->data['cols'] = [
            "FirstName" => "Employee.FirstName",
            "LastName" => "Employee.LastName",
            "EmployeeCode" => "Employee.EmployeeCode",
            "Unit" => "OrgUnit.UnitName",
        ];

        $this->data['pk'] = "AuditUnitId";

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk",0);

        switch($action) :
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig",$this->data);
                break;
            case "list":
                $this->json( ["data" => \entities\AuditEmpUnitsQuery::create()
                        ->joinWithEmployee()
                        ->joinWithOrgUnit()
                        ->find()->toArray()]);
                break;
            case "form":
                     $units = \entities\OrgUnitQuery::create()->find()->toKeyValue("Orgunitid","UnitName");
                     $f = FormMgr::formHorizontal();
                     $f->add([
                         'EmployeeId' => FormMgr::text()->label('Employee *')
                             ->required()
                             ->datatoggle('CommonAutoComplete')
                             ->href($this->app->Router()->getPath("hr_employeeSearch")),
                         'OrgUnitId' => FormMgr::select()->options($units)->label('Unit *')->required(),
                     ]);
                     $this->data['form_name'] = "Add Audit";
                     if($pk > 0)
                     {
                         $entity = \entities\AuditEmpUnitsQuery::create()->findPk($pk);
                         $f->val($entity->toArray());
                         $this->data['form_name'] = "Edit Audit";

                         $emp = $entity->getEmployee();
                         $f["EmployeeId"]->sudoValue($emp->getFirstName()." ".$emp->getLastName()." | ".$emp->getEmployeeCode());

                         $this->data['canDelete'] = true;
                     }
                     else
                     {
                         $entity = new \entities\AuditEmpUnits();
                     }

                     if($this->app->isPost() && $f->validate()){

                         $button = $this->app->Request()->getParameter("buttonValue");

                         try{
                             if($button == "delete")
                             {
                                 $entity->delete();
                             }
                             else {
                                 $entity->fromArray($_POST);
                                 $entity->save();
                             }
                             $this->runModalScript("loadGrid()");
                             return;
                         }
                         catch(\Exception $e)
                         {
                             $this->app->Session()->setFlash("error", $e->getMessage());
                         }
                     }
                     $this->data['form'] = $f->html();
                     $this->app->Renderer()->render("modalCommonForm.twig",$this->data);
                break;
        endswitch;
    }
  */

    function employeeSearch()
    {
        $q = $this->app->Request()->getParameter("term");

        $employees = \entities\EmployeeQuery::create()
            ->filterByFirstName($q . "%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)
            //->filterByLastName($q."%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)
            ->filterByStatus(1)
            ->limit(100)
            ->findByCompanyId($this->app->Auth()->CompanyId());

        $res = [];

        foreach ($employees as $emp) {
            $res[] = ["label" => $emp->getFirstName() . " " . $emp->getLastName() . " | " . $emp->getEmployeeCode(), "value" => [], "id" => $emp->getPrimaryKey()];
        }

        $this->json($res);
    }

    /*
    function hrReminders()
    {
        $this->data['title'] = "Hr Reminders";
        $this->data['form_name'] = "Reminder";
        $this->data['cols'] = [
            "ReminderType" => "ReminderType",
            "ReminderAt" => "ReminderAt",
            "ReminderMsg" => "ReminderMsg"
        ];

         $days = [];
         $nf = new \NumberFormatter("en_US", \NumberFormatter::ORDINAL);
         for($i =1; $i < 31;$i++)
         {
             $days[$i] = $nf->format($i)." Day of the month";
         }

        $this->data['valKeys'] = ["ReminderType" => $this->getConfig("HR", "ReminderTypes"),"ReminderAt"=>$days];

        $this->data['pk'] = "ReminderId";

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk",0);

        switch($action) :
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig",$this->data);
                break;
            case "list":
                $this->json( ["data" => \entities\HrRemindersQuery::create()->find()->toArray()]);
                break;
            case "form":

                     $designation = \entities\DesignationsQuery::create()->find()->toKeyValue("DesignationId","Designation");

                     $f = FormMgr::formHorizontal();

                     $f->add([
                         'ReminderType' => FormMgr::select()->options($this->getConfig("HR", "ReminderTypes"))->label('Reminder Type'),
                         'ReminderAt' => FormMgr::select()->options($days)->label('Reminder Day'),
                         'ReminderTime' => FormMgr::text()->label('Reminder Time')->class('timepicker'),
                         'ReminderMsg' => FormMgr::text()->label('Message'),
                         'Designation' => FormMgr::select()->options($designation)->label('Grade')->class("multi-select")->multiple("multiple")
                     ]);
                     $entities = new \entities\HrReminders();
                     if($pk > 0)
                     {
                         $entities = \entities\HrRemindersQuery::create()->findPk($pk);
                         $val = \entities\HrReminderDesignationsQuery::create()->select("DesignationId")->findByReminderId($pk)->toArray();
                         $f['Designation']->val($val);
                         $f->val($entities->toArray());
                         $f['ReminderTime']->val($entities->getReminderTime()->format("H:i a"));

                     }
                     if($this->app->isPost() && $f->validate()){

                         $entities->fromArray($_POST);
                         $entities->save();

                         if(isset($_POST['Designation'])) {

                             $desig = $_POST['Designation'];

                             \entities\HrReminderDesignationsQuery::create()->findByReminderId($entities->getPrimaryKey())->delete();

                             foreach($desig as $desid)
                             {
                                 $map = new \entities\HrReminderDesignations();
                                 $map->setReminderId($entities->getPrimaryKey());
                                 $map->setDesignationId($desid);
                                 $map->save();
                             }
                         }
                         $this->runModalScript("loadGrid()");
                         return;
                     }
                     $this->data['form'] = $f->html();
                     $this->app->Renderer()->render("modalCommonForm.twig",$this->data);
                break;
        endswitch;
    }
    */

    function pushNotification()
    {
        $this->data['form_name'] = "Push Notification";
        $id = $this->app->Request()->getParameter("pk");
        $announcementData = AnnouncementsQuery::create()
            ->filterByAnnouncementId($id)
            ->findOne()
            ->toArray();

        if ($this->app->isPost()) {
            $announcements = AnnouncementsQuery::create()
                ->filterByAnnouncementId($id)
                ->findOne()
                ->toArray();
            $branches = explode(',', $announcements['Branches']);
            $orgUnits = explode(',', $announcements['OrgUnits']);
            $designations = explode(',', $announcements['Designations']);
            foreach ($branches as $branch) {
                $b = BranchQuery::create()
                    ->filterByBranchId($branch)
                    ->findOne();
                $title = $_POST['Title'];
                $message = $_POST['Message'];

                $employees = EmployeeQuery::create()
                    ->filterByBranchId($b->getBranchId())
                    ->filterByStatus(1)
                    ->find()
                    ->toArray();
                foreach ($employees as $emp) {
                    $notification = \BI\manager\NotificationManager::sendNotificationToEmployee($emp['EmployeeId'], $title, $message);
                }

            }
            foreach ($orgUnits as $orgUnit) {
                $or = OrgUnitQuery::create()
                    ->filterByOrgunitid($orgUnit)
                    ->findOne();
                $title = $_POST['Title'];
                $message = $_POST['Message'];
                $employees = EmployeeQuery::create()
                    ->filterByOrgUnitId($or->getOrgunitid())
                    ->filterByStatus(1)
                    ->find()
                    ->toArray();
                foreach ($employees as $emp) {
                    $notification = \BI\manager\NotificationManager::sendNotificationToEmployee($emp['EmployeeId'], $title, $message);
                }

            }
            foreach ($designations as $designation) {
                $de = DesignationsQuery::create()
                    ->filterByDesignationId($designation)
                    ->findOne();
                $title = $_POST['Title'];
                $message = $_POST['Message'];
                $employees = EmployeeQuery::create()
                    ->filterByOrgUnitId($de->getDesignationId())
                    ->filterByStatus(1)
                    ->find()
                    ->toArray();
                foreach ($employees as $emp) {
                    $notification = \BI\manager\NotificationManager::sendNotificationToEmployee($emp['EmployeeId'], $title, $message);
                }

            }


            $this->runModalScript("loadGrid()");
            return;
        }


        $f = FormMgr::formHorizontal();
        $f->add([
            /* 'AnnouncementTitle' => FormMgr::text()->label('Announcement Title')->required()->value($announcementData['AnnouncementTitle'])->disabled(),
             'AnnouncementMessage' => FormMgr::text()->label('Announcement Message')->required()->value($announcementData['AnnouncementMessage'])->disabled(),*/
            'Title' => FormMgr::text()->label('Title')->required()->value($announcementData['AnnouncementTitle']),
            'Message' => FormMgr::textarea()->label('Message')->required()->val($announcementData['AnnouncementMessage']),
        ]);


//       $val = \entities\ExpenseRepellentQuery::create()->select("ExpenseRepId")->findByExpenseId($id)->toArray();
//       $f['ExpenseRepId']->val($val);

        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
    }

    function expenseRepellents()
    {
        $this->data['form_name'] = "Expense Repellents";
        $id = $this->app->Request()->getParameter("pk");
        if ($this->app->isPost()) {
            \entities\ExpenseRepellentQuery::create()->findByExpenseId($id)->delete();
            if (isset($_POST['ExpenseRepId'])) {
                $gids = $_POST['ExpenseRepId'];
                foreach ($gids as $gid) {
                    $map = new \entities\ExpenseRepellent();
                    $map->setExpenseId($id);
                    $map->setExpenseRepId($gid);
                    $map->save();
                }
            }
            $this->runModalScript("loadGrid()");
            return;
        }
        $expenses = \entities\ExpenseMasterQuery::create()
            ->filterByExpenseId($id, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
            ->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("ExpenseId", "ExpenseName");

        $f = FormMgr::formHorizontal();
        $f->add([
            'ExpenseRepId' => FormMgr::select()->options($expenses)->label('Repellents')->class("multi-select")->multiple("multiple")
        ]);

        $val = \entities\ExpenseRepellentQuery::create()->select("ExpenseRepId")->findByExpenseId($id)->toArray();
        $f['ExpenseRepId']->val($val);

        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);

    }

    function attendance()
    {

        $action = $this->app->Request()->getParameter("action");
        $id = $this->app->Request()->getParameter("id");
        $month = explode("|", $this->app->Request()->getParameter("month", "|"));
        $geoTowns='';
        $itownIds='';

        switch ($action) :
            case "":
                //$this->app->Renderer()->render("dataTableTemplate.twig",$this->data);
                break;
            case "list":
                $attendances = \entities\Base\AttendanceQuery::create()
                    ->filterByEmployeeId($id)
                    ->leftJoinGeoTownsRelatedByStartItownid('StartTown')
                    ->addAsColumn( 'StartTownName', "StartTown.Stownname" )
                    ->leftJoinGeoTownsRelatedByEndItownid('EndTown')
                    ->addAsColumn( 'EndTownName', "EndTown.Stownname" )
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->filterByAttendanceDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByAttendanceDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->find()->toArray();

                $list = \Modules\ESS\Runtime\EssHelper::getFreeMonthDates($month,$id);
                foreach($attendances as $attendance)
                {   
                    if($attendance['VisitedItownid'] != null || $attendance['VisitedItownid'] != '')
                    {   
                      $itownIds = explode(',', $attendance['VisitedItownid']);
                      $itownIds = array_filter($itownIds, function($value) {
                        return is_numeric($value) && $value > 0; 
                    });
                    $itownIds = array_map('intval', $itownIds);
                      $geoTowns = GeoTownsQuery::create()
                      ->filterByItownid($itownIds, Criteria::IN)
                      ->withColumn("string_agg(Stownname, ',')", 'Stownname')
                      ->select(['Stownname'])//->toString();
                      ->findOne();///////////////////visitedTownName
                      //print_r($geoTowns);die;
                    }  

                    $dailyCalls = \entities\DarViewQuery::create()
                                ->filterByEmployeeId($attendance['EmployeeId'])
                                ->filterByDcrDate($attendance['AttendanceDate'])
                                ->find()->count();

                    $expenseStatus = null;
                    if(isset($attendance['ExpenseId']) && $attendance['ExpenseId'] != null){
                        $expense = \entities\ExpensesQuery::create()
                                        ->filterByExpId($attendance['ExpenseId'])
                                        ->findOne();
                        $expenseStatus = $expense->getExpenseStatus();
                    }

                    $list[$attendance['AttendanceDate']] = [
                        "Date" => $attendance['AttendanceDate'],
                        "StartTime" => $attendance['StartTime'],
                        "punchindate" => $attendance['CreatedAt'],
                        "StartTownName" => $attendance['StartTownName'],
                        "EndTime" => $attendance['EndTime'],                        
                        "punchoutdate" => $attendance['UpdatedAt'],                        
                        "EndTownName" => $attendance['EndTownName'],
                        "VisitedTownName" =>  $geoTowns,
                        "TotalCalls" =>  $dailyCalls,
                        //"ShiftMins" => $attendance['ShiftMins'],
                        "Remark" => $attendance['Remark'],
                        "Status" => $attendance['Status'],
                        "ExpenseRemark" => $attendance['ExpenseRemark'],
                        "AttendanceId" => $attendance['AttendanceId'],
                        "ExpenseStatus" => $expenseStatus,
                    ];
                }

                $this->json(["data" => array_values($list)]);
                break;
        endswitch;


    }

    function editAttendance($id = 0)
    {
        $emp_id = $this->app->Request()->getParameter("emp");
        $status = $this->getConfig("HR", "AttendanceStatus");

        if($emp_id != null){
            $emploee = \entities\EmployeeQuery::create()
                            ->filterByEmployeeId($emp_id)
                            ->findOne();

            if($emploee->getPositionId() != null){
                $emp_position_ids = \BI\manager\OrgManager::getMyPositions($emploee);
                $positionArray = array_merge($emp_position_ids, [$emploee->getPositionId()]);

                $territory = \entities\TerritoriesQuery::create()
                            ->select(['TerritoryId'])
                            ->filterByPositionId($positionArray)
                            ->find()->toArray();
                            
                if($territory != null){
                    $territoryTowns = \entities\TerritoryTownsQuery::create()
                                    ->select(['Itownid'])
                                    ->filterByTerritoryId($territory)
                                    ->find()->toArray();
                    $geoTowns = \entities\GeoTownsQuery::create()
                                ->filterByItownid($territoryTowns)
                                ->find()->toKeyValue('Itownid','Stownname');
                }else{
                    $geoTowns = [];
                }
            }else{
                $geoTowns = [];
            }
        }else{
            $geoTowns = [];
        }

        $f = FormMgr::formHorizontal();
        $f->add([
            'AttendanceDate' => FormMgr::date()->label('Attendance Date'),
            'StartTime' => FormMgr::time()->label('Start Time')->class('timepicker'),
            'StartItownid' => FormMgr::select()->options($geoTowns)->label('Start Town')->id('AttStrTw'),
            'EndTime' => FormMgr::time()->label('End Time')->class('timepicker'),
            'EndItownid' => FormMgr::select()->options($geoTowns)->label('End Town')->id('AttEndTw'),
            'ShiftMins' => FormMgr::number()->label('Duration(Mins)'),
            'Remark' => FormMgr::text()->label('Remark'),
            'Status' => FormMgr::select()->options($status)->label('Reminder Type'),
            'ExpenseGenerated' => FormMgr::checkbox()->label('Expense Generated')->id('AttExpCheck'),
        ]);
        $entities = new \entities\Attendance();
        if ($id > 0) {
            $entities = \entities\AttendanceQuery::create()->findPk($id);
            $f->val($entities->toArray());
            
            if($f['ExpenseGenerated'] == true && $f['ExpenseId'] != null){
                $exp = \entities\ExpensesQuery::create()
                            ->filterByExpId($f['ExpenseId'])
                            ->filterByExpenseStatus(3,Criteria::GREATER_EQUAL)
                            ->findOne();
            }else{
                $exp = null;
            }

            if ($entities->getExpenseGenerated() == true) {
                $f['ExpenseGenerated']->val(true);
            } else {
                $f['ExpenseGenerated']->val(false);
            }
            if ($entities->getStartTime() != null) {
                $f['StartTime']->val($entities->getStartTime()->format("H:i"));
            }
            if ($entities->getEndTime() != null) {
                $f['EndTime']->val($entities->getEndTime()->format("H:i"));
            }
            if ($entities->getStartItownid() != null) {
                $f['StartItownid']->val($entities->getStartItownid());
            }
            if ($entities->getEndItownid() != null) {
                $f['EndItownid']->val($entities->getEndItownid());
            }

            //$f['ReminderTime']->val($entities->getReminderTime()->format("H:i a"));

        }
        if ($this->app->isPost() && $f->validate()) {

            // $expId = $entities->getExpenseId();
            // if (isset($_POST['ExpenseGenerated'])) {
            //     $expGenerated = $_POST['ExpenseGenerated'];
            // } else {
            //     $expGenerated = false;
            // }
                
            if($_POST['Status'] == 0 && $_POST['StartItownid'] == null){
                $this->app->Session()->setFlash("error", "Sorry start town is required !");
            }

            if($_POST['Status'] == 1 && $_POST['StartItownid'] == null && $_POST['EndItownid'] == null){
                $this->app->Session()->setFlash("error", "Sorry starttown and endtown is required !");
            }
            
            $entities->fromArray($_POST);
            $entities->setExpenseGenerated(false);
            $entities->setCompanyId($this->app->Auth()->CompanyId());
            $entities->setEmployeeId($emp_id);
            $entities->save();
            $this->runModalScript("reloadAttendance()");
            return;
        }
        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);

    }

    public function unlockEmp()
    {
        $emp_id = $this->app->Request()->getParameter("emp");
       
        if ($this->app->isPost()) {
            $emp = EmployeeQuery::create()
                ->filterByEmployeeId($emp_id)
                ->findOne();
            $emp->setIslocked(false);
            $emp->setLockedreason($this->app->Request()->getParameter("Lockedreason"));
            $emp->save();

            $title = "Account Unlock";
            $message = "Your Account lock release!";
            $notification = NotificationManager::sendNotificationToEmployee($emp_id, $title, $message);

            $this->closeModal();
            return;
        }
      
        $emp = EmployeeQuery::create()
                ->filterByEmployeeId($emp_id)
                ->filterByIslocked(true)
                ->find();
        $f = FormMgr::formHorizontal();
        If(count($emp) > 0)
        {
            $this->data['form_name'] = "Release Account Lock";
            $f->add([
                'Lockedreason' => FormMgr::text()->label('Enter Remark')->required(),
            ]);
        }else{
            $this->app->Session()->setFlash("error", "No Account locked for this user.");
        }
        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
    }

    public function unlockSTP()
    {
        $stp_id = $this->app->Request()->getParameter("stp_id");
        $status = $this->app->Request()->getParameter("status");

        $stp = StpQuery::create()->filterByStpId($stp_id)->findOne();
        if ($stp){
            if ($status=="approved"){
                $stp->setStpStatus($status);
                $stp->setStpApprovedBy($this->app->Auth()->getUser()->getEmployeeId());
            } else {
                $stp->setStpStatus($status);
            }
            $stp->save();

            $this->closeModal();
            $this->app->Session()->setFlash("success", "STP ".$status." "."Successfully");
            return;


        } else {
            $this->app->Session()->setFlash("error", "STP Not Found.");
            return;
        }
    }

    public function releaseDayLock()
    {
        $emp_id = $this->app->Request()->getParameter("emp");
        
        if ($this->app->isPost()) {

            $attendance = \entities\AttendanceQuery::create()
                            ->filterByEmployeeId((int)$emp_id)
                            ->filterByStatus(-1)
                            ->find();
            
            if(count($attendance) > 0)
            {
                foreach($attendance as $attend)
                {
                 $attDate = $attend->getAttendanceDate()->format('Y-m-d');
                 $startTime = $attend->getStartTime();
                 $startTown = $attend->getStartItownid();
                 
                 $leavereq = \entities\LeaveRequestQuery::create()
                            ->filterByLeaveFrom($attDate, Criteria::LESS_EQUAL)
                            ->filterByLeaveTo($attDate, Criteria::GREATER_EQUAL) 
                            ->filterByEmployeeId($emp_id) 
                            ->filterByLeaveStatus(2)
                            ->find()
                            ->toArray();

                 if( $startTime == null  and count($leavereq) == 0)
                 {
                    $dailyCalls = \entities\DailycallsQuery::create()
                                ->filterByEmployeeId((int)$emp_id)
                                ->filterByDcrDate($attend->getAttendanceDate())
                                ->find()->count();
                    if($dailyCalls == 0){
                        $attend->delete();
                    }
                 }
                 if($startTime != null   and count($leavereq) == 0)
                 {  
                    AttendanceQuery::create()
                        ->filterByEmployeeId((int)$emp_id)
                        ->filterByStatus(-1)
                        ->update([
                            "Status" => 0,
                            "Remark" => $this->app->Request()->getParameter("Remark")
                        ]);
                 }
                 if($startTime != null  and  count($leavereq) > 0)
                 {
                    $dailyCalls = \entities\AttendanceQuery::create()
                    ->filterByEmployeeId((int)$emp_id)
                    ->filterByAttendanceDate($attend->getAttendanceDate())
                    ->find()->count();
                    if($dailyCalls > 0){
                        $attend->delete();
                    }
                 }
                 if($startTime == null  and  count($leavereq) > 0)
                 {
                    $dailyCalls = \entities\AttendanceQuery::create()
                    ->filterByEmployeeId((int)$emp_id)
                    ->filterByAttendanceDate($attend->getAttendanceDate())
                    ->find()->count();
                    if($dailyCalls > 0){
                        $attend->delete();
                    }
                 }
                
                }
            }
            else{
                return;
            }

            $title = "Release Day Lock";
            $message = "Day Lock release! Please complete attendance";
            $notification = NotificationManager::sendNotificationToEmployee((int)$emp_id, $title, $message);

            $this->runModalScript("reloadAttendance()");
            return;
        }


        $this->data['form_name'] = "Release Day Lock";

        $f = FormMgr::formHorizontal();

        $f->add([
            'Remark' => FormMgr::text()->label('Enter Remark')->required(),

        ]);
        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
    }

    public function employeePunchLoc()
    {

        $current_pin = $this->app->Request()->getParameter("pin", "");
        $this->data['form_name'] = "";

        if ($current_pin != "") {
            $pin = explode(",", $current_pin);
        }
        $this->data['lat'] = $pin[0];
        $this->data['lng'] = $pin[1];
        $this->data['loginDevice'] = "";
        $this->data['deviceBattery'] = 0;
        $this->data["noSave"] = true;
        $this->app->Renderer()->render("system/employeeLastLoc.twig", $this->data);

    }

    function eventList()
    {
        $action = $this->app->Request()->getParameter("action");
        $id = $this->app->Request()->getParameter("id");
        $month = explode("|", $this->app->Request()->getParameter("month", "|"));


        switch ($action) :
            case "":
                //$this->app->Renderer()->render("dataTableTemplate.twig",$this->data);
                break;
            case "list":
                $list = \entities\Base\EventsQuery::create()
                    ->filterByEmployeeId($id)
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->joinWithEventTypes()
                    ->leftJoinWithEmployeeRelatedByApproverEmpId()
                    ->filterByEventDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByEventDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->find()->toArray();

                $this->json(["data" => $list]);
                break;
        endswitch;
    }

    function event($id)
    {
        $emp_id = $this->app->Request()->getParameter("emp");
        $status = $this->getConfig("HR", "EventStatus");

        $eventTypes = \entities\EventTypesQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("EventTypeId", "EventTypeName");
        $f = FormMgr::formHorizontal();

        $f->add([
            'EventDate' => FormMgr::date()->label('Event Date'),
            'EventTypeId' => FormMgr::select()->options($eventTypes)->label('Event Type'),
            'EventRemark' => FormMgr::text()->label('Remark'),
            'EventStatus' => FormMgr::select()->options($status)->label('Status'),
        ]);
        $entities = new \entities\Events();
        if ($id > 0) {
            $entities = \entities\EventsQuery::create()->findPk($id);
            $f->val($entities->toArray());

        }
        if ($this->app->isPost() && $f->validate()) {

            $entities->fromArray($_POST);
            $entities->setCompanyId($this->app->Auth()->CompanyId());
            $entities->setEmployeeId($emp_id);
            if ($id > 0) {
                $entities->setApproverEmpId($this->app->Auth()->getUser()->getEmployeeId());
            }
            $entities->save();

            $this->runModalScript("reloadEvents()");
            return;
        }
        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
    }


    function holidays()
    {
        $mediaManager = new MediaManager($this->app);
        $this->data['title'] = "Holidays";
        $this->data['form_name'] = "Holidays";
        $this->data['cols'] = [

            "HolidayName" => "HolidayName",
            "HolidayDate" => "HolidayDate",
            "State" => "GeoState.Sstatename",
        ];

        $this->data['pk'] = "HolidayId";

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "list":

                $this->json(["data" => \entities\HolidaysQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->joinWithGeoState()
                    ->orderByHolidayId(\Propel\Runtime\ActiveQuery\ModelCriteria::ASC)
                    ->findByCompanyId($this->app->Auth()->CompanyId())->toArray()]);

                break;
            case "form":
                $state = \entities\GeoStateQuery::create()->find()->toKeyValue("Istateid", "Sstatename");

                $f = FormMgr::formHorizontal();
                $f->add([
                    'HolidayName' => FormMgr::text()->label('Holiday name *')->required()->minlength(5)->pattern(__NOSPACE_PATERN),
                    'HolidayDate' => FormMgr::date()->label('Holiday Date')->required(),
                    'Istateid' => FormMgr::select()->options($state)->label('States')
                ]);
                $holiday = new \entities\Holidays();
                $this->data['form_name'] = "Add Holiday";
                if ($pk > 0) {
                    $holiday = \entities\HolidaysQuery::create()->findPk($pk);

                    $f->val($holiday->toArray());
                    //$f["Istateid"]->val(explode(",", $holiday->getIstateid()));

                    $this->data['form_name'] = "Edit Holiday";
                }
                if ($this->app->isPost() && $f->validate()) {

                    //$state = implode(",", $_POST['Istateid']);
                    //unset($_POST['Istateid']);
                    $holiday->fromArray($_POST);
                    //$holiday->setIstateid($state);

                    $holiday->setCompanyId($this->app->Auth()->CompanyId());
                    $holiday->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $form = $f->html();

//                $mediaInput = $mediaManager->FormInput("MediaId", "Media", $mediaId, 1);
                $this->data['form'] = $form;
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    function announcements()
    {
        $mediaManager = new MediaManager($this->app);
        $this->data['title'] = "Announcements";
        $this->data['form_name'] = "Announcements";
        $this->data['cols'] = [

            "AnnouncementMessage" => "AnnouncementMessage",
            "AnnouncementTitle" => "AnnouncementTitle",
            "AnnouncementStdate" => "AnnouncementStdate",
            "AnnouncementEdate" => "AnnouncementEdate",
            "AnnouncementsUrl" => "AnnouncementsUrl"
        ];


        $this->data['pk'] = "AnnouncementId";

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);
        $this->data['rowButtons'] = [
            "hr_push_notification" => "zmdi zmdi-layers ajaxModal"
        ];


        switch ($action) :
            case "":
                $this->app->Renderer()->render("hr/AnnouncementMasterForm.twig", $this->data);
                break;
            case "list":

                $this->json(["data" => \entities\AnnouncementsQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->orderByAnnouncementId(\Propel\Runtime\ActiveQuery\ModelCriteria::ASC)
                    ->findByCompanyId($this->app->Auth()->CompanyId())->toArray()]);

                break;
            case "form":
                $branches = \entities\BranchQuery::create()->find()->toKeyValue("BranchId", "Branchcode");
                $designations = \entities\DesignationsQuery::create()->find()->toKeyValue("DesignationId", "Designation");
                $orgUnits = \entities\OrgUnitQuery::create()->find()->toKeyValue("Orgunitid", "UnitName");
                $geades = \entities\GradeMasterQuery::create()->find()->toKeyValue("Gradeid", "GradeName");
                $status = ["Active" => "Active", "Inactive" => "Inactive"];
                $f = FormMgr::formHorizontal();
                $f->add([
                    'AnnouncementMessage' => FormMgr::textarea()->label('Announcement Message *')->required()->minlength(5)->pattern(__NOSPACE_PATERN),
                    'AnnouncementTitle' => FormMgr::text()->label('Announcement Title *')->required()->minlength(5)->pattern(__NOSPACE_PATERN),
                    'AnnouncementStdate' => FormMgr::date()->label('Announcement Start Date *')->required(),
                    'AnnouncementEdate' => FormMgr::date()->label('Announcement End Date *')->required(),
                    'AnnouncementsUrl' => FormMgr::text()->label('Announcement Url '),
                    'MultipleSelectAllBranch' => FormMgr::checkbox()->label('Select All Branch')->id("MultipleSelectBranchCode"),
                    'MultipleDeSelectAllBranch' => FormMgr::checkbox()->label('Deselect All Branch')->id("MultipleDeSelectBranchCode"),
                    'Branches' => FormMgr::select()->options($branches)->label('Branch Code')->class("multi-select")->multiple("multiple")->required()->id('BranchCode'),
                    'MultipleSelectAllDesignation' => FormMgr::checkbox()->label('Select All Grade')->id("MultipleSelectDesignation"),
                    'MultipleDeSelectAllDesignation' => FormMgr::checkbox()->label('Deselect All Grade')->id("MultipleDeSelectDesignation"),
                    'Designations' => FormMgr::select()->options($geades)->label('Grade')->class("multi-select")->multiple("multiple")->required()->id('Designation'),
                    'MultipleSelectAllOrgUnits' => FormMgr::checkbox()->label('Select All OrgUnit')->id("MultipleSelectOrgUnit"),
                    'MultipleDeSelectAllOrgUnits' => FormMgr::checkbox()->label('Deselect All OrgUnits')->id("MultipleDeSelectOrgUnit"),
                    'OrgUnits' => FormMgr::select()->options($orgUnits)->label('Org Units')->class("multi-select")->multiple("multiple")->required()->id('OrgUnits'),
                    'AnnouncementStatus' => FormMgr::select()->options($status)->label('Status')->required(),
                ]);
                $announcement = new \entities\Announcements();
                $this->data['form_name'] = "Add Announcement";
                if ($pk > 0) {
                    $announcement = \entities\AnnouncementsQuery::create()->findPk($pk);

                    $f->val($announcement->toArray());
                    $f["Branches"]->val(explode(",", $announcement->getBranches()));
                    $f["Designations"]->val(explode(",", $announcement->getDesignations()));
                    $f["OrgUnits"]->val(explode(",", $announcement->getOrgUnits()));

                    $this->data['form_name'] = "Edit Announcement";
                }
                if ($this->app->isPost() && $f->validate()) {
                    $branch = implode(",", $_POST['Branches']);
                    unset($_POST['Branches']);
                    $designations = implode(",", $_POST['Designations']);
                    unset($_POST['Designations']);
                    $orgUnits = implode(",", $_POST['OrgUnits']);
                    unset($_POST['OrgUnits']);
                    $announcement->fromArray($_POST);
                    $announcement->setBranches($branch);
                    $announcement->setDesignations($designations);
                    $announcement->setOrgUnits($orgUnits);
                    $announcement->setCompanyId($this->app->Auth()->CompanyId());
                    $announcement->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $form = $f->html();
                $this->data['form'] = $form;
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    function getSingleExpense($id)
    {

        $expSingle = \entities\AttendanceQuery::create()
            ->joinWithExpenses()
            ->filterByExpenseId($id)
            ->find()->toArray();
        if (!empty($expSingle)) {
            $this->json(["data" => $expSingle]);
        } else {
            $this->json(["data" => []]);
        }
    }

    function wdbsyncLog()
    {

        $this->data['title'] = "WdbSyncLog";
        $this->data['form_name'] = "WdbSyncLog";
        $this->data['cols'] = [

            "SysTable" => "SysTable",
            "SysOperation" => "SysOperation",
            "SysBody" => "SysBody",
            "UserId" => "Users.Name",
            "TokenId" => "TokenId",
            "DeviceInfo" => "DeviceInfo",
        ];


        $this->data['pk'] = "WdbId";

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);


        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":

                $this->json(["data" => \entities\WdbSyncLogQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->joinWithUsers()
                    ->findByCompanyId($this->app->Auth()->CompanyId())->toArray()]);

                break;

        endswitch;
    }

    function expenseRecal($id)
    {
        $mgr = new ExpManager();
        $mgr->getBestRoute($id);
    }

    public function regenerateExpense(){
        $empId = $this->app->Request()->getParameter("empId");
        $month = $this->app->Request()->getParameter("month");

        $expMonth = explode('|',$month);
        $startDate = $expMonth[0];
        $endDate = $expMonth[1];

        $attedance = \entities\AttendanceQuery::create()
                        ->filterByEmployeeId((int)$empId)
                        ->filterByAttendanceDate($startDate, Criteria::GREATER_EQUAL)
                        ->filterByAttendanceDate($endDate, Criteria::LESS_EQUAL)
                        ->update(array('ExpenseGenerated' => false));

        return $attedance;
    }
}
