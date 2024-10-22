<?php declare(strict_types=1);

namespace Modules\FSM\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use BI\manager\MTPManager;
use BI\manager\OrgManager;
use entities\AgendatypesQuery;
use entities\Base\GradeMasterQuery;
use entities\BeatsQuery;
use entities\DesignationsQuery;
use entities\EmployeeQuery;
use entities\GeoTownsQuery;
use entities\GradeMaster;
use entities\MtpDayQuery;
use entities\MtpQuery;
use entities\OutletOrgDataQuery;
use entities\OutletsQuery;
use entities\OutletViewQuery;
use entities\PositionsQuery;
use entities\TourplansQuery;
use entities\TerritoriesQuery;
use entities\TerritoryTowns;
use entities\TerritoryTownsQuery;
use entities\Tourplans;
use Exception;
use Modules\FSM\Runtime\FSMHelper;
use Propel\Runtime\ActiveQuery\Criteria;

class MTP extends \App\Core\BaseController
{
    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }


    function mtp()
    {

        //$manager = new MTPManager();

        $roles = $this->app->Auth()->getUser()->getRoles()->getRoleName();
        $positionId = $this->app->Auth()->getUser()->getEmployee()->getPositionId();
        $data = OrgManager::getUnderPositions($positionId);
        if ($this->app->Auth()->checkPerm("all_emp_perm") == true) {
            $employees = \entities\EmployeeQuery::create()
                 ->filterByStatus(1)
                ->findByCompanyId($this->app->Auth()->CompanyId());
        } else {
            $totalPositions = PositionsQuery::create()
                ->select(['CavPositionsDown'])
                ->filterByPositionId($this->app->Auth()->getUser()->getEmployee()->getPositionId())
                ->find()->toArray();
            $employees = "";
            if ($totalPositions != "")
                $tot = explode(',', $totalPositions[0]);
            $employees = \entities\EmployeeQuery::create()
                ->filterByPositionId($tot)
                ->filterByStatus(1)
                ->filterByCompanyId($this->app->Auth()->CompanyId())->find();
        }

        /*if ($roles=="DivisionHead" && $roles=="ClusterHead"){
            if ($data==null){
                $employees = "";
            } else {
                $employees = \entities\EmployeeQuery::create()
                    ->filterByPositionId($data)
                    ->findByCompanyId($this->app->Auth()->CompanyId());
            }
        } else {
            $employees = \entities\EmployeeQuery::create()
                ->findByCompanyId($this->app->Auth()->CompanyId());
        }*/


        $res = [];
        foreach ($employees as $emp) {
            $res[$emp->getPrimaryKey()] = $emp->getFirstName() . " " . $emp->getLastName() . " | " . $emp->getEmployeeCode();
        }
        $this->data['valKeys'] = ["EmployeeId" => $res];

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);
        if ($this->app->Auth()->checkPerm("all_emp_perm") != true) {

            $this->data['disableAdd'] = true;
        }
        $this->data['canEditIf'] = ["col" => "Status", "val" => "1"];

        switch ($action) :
            case "":
                $this->data['title'] = "MTP";
                $this->data['form_name'] = "MTP";
                $this->data['cols'] = [
                    "Positions" => "Positions",
                    "Employee" => "Employee",
                    "Month" => "Month",
                    "Status" => "Status",
                ];
                $this->data['defaultOrderIdx'] = 2;
                $this->data['pk'] = "MtpId";
                
                $this->data['rowButtons'] = ["fsm_mtpDates" => "zmdi zmdi-layers", "fsm_mtpActions" => "ajaxModal zmdi zmdi-eye"];
                
                if ($this->app->Auth()->checkPerm("all_emp_perm") == true) {
                    $this->data['listFilters'] = [
                        "Month" => MTPManager::getMonths(-2, 4),
                        "OrgUnit" => \entities\OrgUnitQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Orgunitid", "UnitName"),
                        "Grade" => GradeMasterQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Gradeid", "GradeName"),
                        "Designations" => DesignationsQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("DesignationId", "Designation")
                    ];
                } else {
                    $orgUnit = $this->app->Auth()->getUser()->getEmployee()->getOrgUnitId();
                    $orgUnitData = \entities\OrgUnitQuery::create()->filterByOrgunitid($orgUnit)->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Orgunitid", "UnitName");
                    $cavPositions = PositionsQuery::create()
                        ->select(['CavPositionsDown'])
                        ->filterByPositionId($this->app->Auth()->getUser()->getEmployee()->getPositionId())
                        ->find()->toArray();
                    $employee = "";
                    if (count($cavPositions) > 0) {
                        $cav = explode(',', $cavPositions[0]);
                        $employee = \entities\EmployeeQuery::create()
                            ->select('DesignationId')
                            ->filterByPositionId($cav)
                            ->filterByStatus(1)
                            ->find()->toArray();
                    }
                    $designationData = \entities\DesignationsQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("DesignationId", "Designation");
                    if ($employee != "") {
                        $designation = array_unique($employee);
                        $designationData = \entities\DesignationsQuery::create()->filterByDesignationId($designation)->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("DesignationId", "Designation");
                    }
                    $gradeData = \entities\GradeMasterQuery::create()
                                ->findByCompanyId($this->app->Auth()->CompanyId())
                                ->toKeyValue("Gradeid", "GradeName");

                    $this->data['listFilters'] = [
                        "Month" => MTPManager::getMonths(-2, 4),
                        "OrgUnit" => $orgUnitData,
                        "Designations" => $designationData,
                        "Grade" => $gradeData
                    ];
                }


                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":

                $month = $this->app->Request()->getParameter("Month");
                $OrgUnit = $this->app->Request()->getParameter("OrgUnit");
                $Designations = $this->app->Request()->getParameter("Designations");
                $grades = $this->app->Request()->getParameter("Grade");

                $positions = EmployeeQuery::create()
                    ->select(["PositionId"])
                    ->filterByOrgUnitId($OrgUnit)
                    ->filterByDesignationId($Designations)
                    ->filterByGradeId($grades)
                    ->filterByStatus(1)
                    ->find()->toArray();

                if ($this->app->Auth()->checkPerm("all_emp_perm") == true) {
                    $positions = EmployeeQuery::create()
                        ->select(["PositionId"])
                        ->filterByOrgUnitId($OrgUnit)
                        ->filterByDesignationId($Designations)
                        ->filterByGradeId($grades)
                        ->filterByStatus(1)
                        ->find()->toArray();
                } else {
                    $totalPositions = PositionsQuery::create()
                        ->select(['CavPositionsDown'])
                        ->filterByPositionId($this->app->Auth()->getUser()->getEmployee()->getPositionId())
                        ->find()->toArray();

                    if (count($totalPositions) > 0) {
                        $employeee = explode(',', $totalPositions[0]);
                        $positions = EmployeeQuery::create()
                            ->select(["PositionId"])
                            ->filterByOrgUnitId($OrgUnit)
                            ->filterByDesignationId($Designations)
                            ->filterByPositionId($employeee)
                            ->filterByGradeId($grades)
                            ->filterByStatus(1)
                            ->find()->toArray();
                    }
                }

                $empList = EmployeeQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->filterByPositionId(0, Criteria::GREATER_THAN)
                    ->filterByStatus(1)
                    ->find()->toKeyIndex("PositionId");

                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\MtpQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId())->filterByPositionId($positions)->filterByMonth($month, Criteria::EQUAL);
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query = $query->usePositionsQuery()
                                        ->filterByPositionName($search,Criteria::LIKE)
                                    ->endUse()
                                    ->_or()
                                        ->useEmployeeQuery()
                                        ->filterByFirstName($search,Criteria::LIKE)
                                    ->endUse()
                                    ->_or()
                                        ->filterByMonth($search,Criteria::LIKE)
                                    ->_or()
                                    ->filterByMtpStatus($search,Criteria::LIKE);
                }
                
                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $mtp = $query->joinWithPositions()->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find();

                $res = [];
                foreach ($mtp as $m) {
                    $res[] = [
                        "MtpId" => $m->getPrimaryKey(),
                        "Positions" => $m->getPositions()->getPositionName(),
                        "Employee" => $empList[$m->getPositionId()]->getFirstName() . " " . $empList[$m->getPositionId()]->getLastName() . " | " . $empList[$m->getPositionId()]->getDesignations()->getDesignation(),
                        "Month" => $m->getMonth(),
                        "Status" => $m->getMtpStatus(),
                    ];
                }

                $response['data'] = $res;
                $this->json($response);
                break;
            case "form":


                $f = FormMgr::formHorizontal();
                $f->add([

                    'EmployeeId' => FormMgr::text()->label('Employee')
                        ->datatoggle('CommonAutoComplete')
                        ->href($this->app->Router()->getPath("hr_employeeSearch")),
                    'Month' => FormMgr::select()->options(MTPManager::getMonths(0, 2))->label('Month'),

                ]);


                $this->data['form_name'] = "Add MTP";

                if ($this->app->isPost() && $f->validate()) {
                    try {
                        $mgr = new MTPManager();
                        $moye = explode("-", $_POST['Month']);

                        $mgr->createMTP($_POST["EmployeeId"], $moye[0], $moye[1]);

                        $this->runModalScript("loadGrid()");
                        return;
                    } catch (Exception $e) {
                        $this->app->Session()->setFlash("error", $e->getMessage());
                    }
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;

    }

    function mtpActions($id)
    {

        $mtp = MtpQuery::create()->findPk($id);

        $mgr = new MTPManager();

        $f = FormMgr::formHorizontal();


        if ($mtp->getMtpStatus() != "approved") {

            $f->add([
                'MtpStatus' => FormMgr::select()->options($this->getConfig("FSM", "MtpStatus"))->label('Status'),
                'ReGenrate' => FormMgr::hidden()->val("Y"),
            ]);
        } else {

            $f->add([
                'MtpStatus' => FormMgr::select()->options($this->getConfig("FSM", "MtpStatus"))->label('Status'),
                'ReGenrate' => FormMgr::select()->options(["Y" => "Yes", "N" => "NO"])->label('Generate DayPlan'),
            ]);
        }

        $this->data['form_name'] = "MTP Action";

        $f->val($mtp->toArray());

        if ($this->app->isPost() && $f->validate()) {
            try {
                $mtp->fromArray($_POST);
                if ($_POST["MtpStatus"] == "approved") {
                    $mtp->setMtpApprovedBy($this->app->Auth()->getUser()->getEmployeeId());
                    $mtp->setApprovedDate(date("Y-M-d"));

                }
                $mtp->save();

                if ($_POST["MtpStatus"] == "approved" && $this->app->Request()->getParameter("ReGenrate", "N") == "Y") {
                    $mgr->genrateDayPlan($id);
                }
                $this->closeModal();
                return;
            } catch (Exception $e) {
                $this->app->Session()->setFlash("error", $e->getMessage());
            }
        }
        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);


    }

    function mtpDates($id)
    {

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);
        $this->data['defaultOrderIdx'] = 01;
        switch ($action) :
            case "":
                $mtp = MtpQuery::create()->findPk($id);
                $this->data['title'] = "MTP Days : " . $mtp->getPositions()->getPositionName() . " > " . $mtp->getMonth() . " > " . $mtp->getMtpStatus() . "  >  " . "TotalVisits:" . $mtp->getTotalVisits() . "  >  " . "OutletCovered:" . $mtp->getOutletsCovered();

                $this->data['disableAdd'] = true;

                if ($this->app->Auth()->checkPerm("all_emp_perm") != true) {
                    $this->data['disableEdit'] = true;
                }

                $this->data['rowButtons'] = ["fsm_mtpTourplan" => "zmdi zmdi-layers"];

                $this->data['form_name'] = "MTPDates";
                $this->data['cols'] = [
                    
                    "MtpDayDate" => "MtpDayDate",
                    "Role" => "Role",
                    "Week Days" => "MtpdayRemark",
                    //"Ishalfday" => "Ishalfday",
                    "Calls" => "Calls",
                    "Working" => "Working",
                    "Customer" => "Customer",
                    "Dr" => "Dr",
                    "Chem"=>"Chem",
                    "Stockist"=>"Stockist"
                ];

                $this->data['pk'] = "MtpDayId";

                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "list":

                $mtp = MtpQuery::create()->findPk($id);
                    $employees = \entities\EmployeeQuery::create()
                    ->JoinWithDesignations()
                    ->filterByPositionId($mtp->getPositions()->getPositionId())
                    ->filterByStatus(1)
                    ->filterByCompanyId($this->app->Auth()->CompanyId())->find();
                    
                $desgName='';
                foreach ($employees as $emp)
                {    
                    $desg = DesignationsQuery::create()->filterByDesignationId($emp->getDesignationId())->findOne();
                    $desgName= $desg->getDesignation();
                }

                $mtpDates = \entities\MtpDayQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->joinWithTourplans(Criteria::LEFT_JOIN)
                    ->filterByMtpId($id)
                    ->find()->toArray();
                    
                foreach ($mtpDates as &$date) {
                    $date["Calls"] = count($date["Tourplanss"]);
                    $working = [];
                    $date["Working"] = "";
                    $outlet=[];
                    $commaSeparatedValues='';
                    foreach ($date["Tourplanss"] as $tp) {

                        $commaSeparatedValues .= $tp["OutletOrgDataId"] . ',';
                        $working[] = $tp["Agendacontroltype"]; 

                    }
                       
                    $commaSeparatedValues = rtrim($commaSeparatedValues, ',');
                    $outletIds = explode(',', $commaSeparatedValues);
                    $filteredArray = array_filter($outletIds);
                    $filteredArray = array_values($filteredArray);
                    $outletname='';$a='';$chCount=0;$drCount=0;$stCount=0;   

                    $customers = \entities\Base\OutletViewQuery::create()
                     ->filterByOutletOrgId($filteredArray, Criteria::IN)                    
                     ->find()->toArray();     
                                    
                     foreach ($customers as $ot) {                      
                       $outletname .= $ot['OutletName'] . ',';                       
                       if(($ot['OutlettypeName']) == 'Pharmacy'){
                        $chCount += 1; 
                       }
                       if(($ot['OutlettypeName']) == 'Doctor'){
                        $drCount += 1; 
                       }
                       if(($ot['OutlettypeName']) == 'Stockist'){
                        $stCount += 1; 
                       }
                      
                     }
                    
                     
                    $date["Role"] =  $desgName; 
                    $date["Customer"] =  rtrim($outletname, ','); 
                    $date["Dr"] =  $drCount; 
                    $date["Chem"] =  $chCount; 
                    $date["Stockist"] =  $stCount;
                    $date["Working"] = implode(",", array_unique($working));
                }

                $this->json(["data" => $mtpDates]);
                break;
            case "form":

                $f = FormMgr::formHorizontal();
                $f->add([
                    'Ishalfday' => FormMgr::checkbox()->label('ishalfday')->id("Ishalfday"),

                ]);

                if ($pk > 0) {
                    $mtpDay = \entities\MtpDayQuery::create()->findPk($pk);
                    $f->val($mtpDay->toArray());
                    $this->data['form_name'] = "Edit ";

                }
                if ($this->app->isPost() && $f->validate()) {

                    if (!empty($_POST['Ishalfday'])) {
                        $Ishalfday = 1;
                    } else {
                        $Ishalfday = 0;
                    }

                    $mtpDay->fromArray($_POST);
                    $mtpDay->setIshalfday($Ishalfday);
                    $mtpDay->save();

                    $this->runModalScript("loadGrid()");
                    return;
                }
                $form = $f->html();
                $this->data['form'] = $form;
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;

        endswitch;

    }

    function mtpTourplan($id)
    {   
        ini_set('memory_limit', '-1');
        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);
        $datachange = $this->app->Request()->getParameter("datachange", "");

        $mgr = new MTPManager();
        $mtpDay = MtpDayQuery::create()->findPk($id);
        $mtp = $mtpDay->getMtp();

        if ($datachange == "selectAgendacontroltype") {
            $Agendacontroltype = $this->app->Request()->getParameter("Agendacontroltype");
            $agenda = AgendatypesQuery::create()->findByAgendacontroltype($Agendacontroltype)->toKeyValue("Agendaid", "Agendname");

            $html = FormMgr::select()->options($agenda)->label('Sub Agenda')->datachange('selectAgenda')->html();

            $this->json(["subType" => $html]);

            return;

        }
        if ($datachange == "selectTerritory") {
            $Agendacontroltype = $this->app->Request()->getParameter("Agendacontroltype");
            $Territory = $this->app->Request()->getParameter("Territory");

            $beatInput = FormMgr::select()->options($mgr->getBeats($Territory, $Agendacontroltype))->label('Patch')->datachange('selectBeat')->html();
            $townInput = FormMgr::select()->options($mgr->getTowns($Territory))->label('Town')->datachange('selectAgenda')->html();

            $this->json(["Patch" => $beatInput, "Town" => $townInput]);

            return;

        }
        if ($datachange == "selectBeat") {
            $BeatId = $this->app->Request()->getParameter("BeatId");
            $Territory = $this->app->Request()->getParameter("Territory");


            if ($BeatId > 0) {
                $customers = $mgr->getCustomersByBeat($BeatId);
            } else {
                $customers = $mgr->getCustomerForJW($mtpDay->getMtpDayDate(), $Territory);
            }


            $Customers = FormMgr::select()->options($customers)->label('Customers')->id("Customers")->html();
            $this->json(["Customers" => $Customers]);

            return;
        }

        if ($this->app->Auth()->checkPerm("all_emp_perm") != true) {
            $this->data['disableAdd'] = true;
            $this->data['disableEdit'] = true;
        }


        switch ($action) :
            case "":

                $this->data['title'] = "MTP Day : " . $mtp->getPositions()->getPositionName() . " > " . $mtp->getMonth() . " > " . $mtpDay->getMtpDayDate() . " " . $mtpDay->getMtpdayRemark() . " > " . $mtp->getMtpStatus();


                $this->data['form_name'] = "MTPDates";
                $this->data['cols'] = [
                    "Type" => "Agendacontroltype",
                    "Agenda" => "Agendatypes.Agendname",
                    //"Town" => "Towns",
                    "Beats / Town" => "Beatname",
                    "Customer" => "OutletName",
                    "Tags" => "Tags",
                    "VFq" => "VisitFq",
                    "BrandFocus" => "BrandFocus",
                    "JW"=>"JW"

                ];

                $this->data['pk'] = "TpId";

                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "list":

                $customerIds = \entities\TourplansQuery::create()->select(["OutletOrgDataId"])->filterByMtpDayId($id)->find()->toArray();

                $customers = OutletViewQuery::create()->filterByOutletOrgId($customerIds)->find()->toKeyValue("OutletOrgId", "OutletName");
                
                $tpList = \entities\TourplansQuery::create()
                    ->leftJoinWithAgendatypes()
                    ->leftJoinWithGeoTowns()
                    ->leftJoinWithBeats()
                    ->leftJoinWithOutletOrgData()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->filterByMtpDayId($id)
                    ->find()->toArray();
//                var_dump($tpList);exit;
                foreach ($tpList as &$tp) {
                    
                    $tp["Beatname"] = "";
                    $tp["Towns"] = "";
                    $tp["OutletName"] = "";
                    $tp["Tags"] = "";
                    $tp["VisitFq"] = "";
                    $tp["BrandFocus"] = "";
                    $tp["JW"] = "";
                    if ($tp["OutletOrgDataId"] != null && $tp["OutletOrgDataId"] > 0 && isset($customers[$tp["OutletOrgDataId"]])) {
                        $tp["OutletName"] = $customers[$tp["OutletOrgDataId"]];
                    }
                    if($tp["Isjw"] == true){
                        $positions = \entities\Base\OutletViewQuery::create()
                        ->filterByOutletOrgId($tp["OutletOrgDataId"])
                        ->findOne();
                        $employee = \entities\EmployeeQuery::create()
                        ->filterByPositionId(strval($positions->getPositionId()))
                        ->filterByStatus(1)
                        ->filterByCompanyId($this->app->Auth()->CompanyId())->findOne();
                        
                        $tp["JW"] = $employee->getFirstName() . ' ' . $employee->getLastName();
                        
                    }

                    if (isset($tp["Beats"])) {
                        $beats = BeatsQuery::create()->filterByBeatId($tp['BeatId'])->findOne();
                        $tp["Beatname"] = $beats->getBeatName();
                    }
                    if ($tp['Itownid'] != null) {
                        $towns = GeoTownsQuery::create()->filterByItownid($tp['Itownid'])->findOne();
                        $tp["Beatname"] = $towns->getStownname();
                    }
                    if (isset($tp["Beats"]) && $tp['Itownid'] != null) {
                        $beats = BeatsQuery::create()->filterByBeatId($tp['BeatId'])->findOne();
                        $towns = GeoTownsQuery::create()->filterByItownid($tp['Itownid'])->findOne();
                        $tp["Beatname"] = $beats->getBeatName().' / '.$towns->getStownname();
                    }
                    if (isset($tp["OutletOrgData"])) {
                        $outletOrgData = OutletOrgDataQuery::create()->filterByOutletOrgId($tp['OutletOrgDataId'])->findOne();
                        $tp["Tags"] = $outletOrgData->getTags();
                        $tp["VisitFq"] = $outletOrgData->getVisitFq();
                        $tp["BrandFocus"] = $outletOrgData->getBrandFocus();

                    }

                }

                $this->json(["data" => $tpList]);
                break;
            case "form":

                $territory = $mgr->getTerritoriesList($mtp->getPositionId(), true);


                $controlType = $this->getConfig("System", "AgendaControlType");
                $beats = [];
                $towns = [];
                $customers = [];
                if (count($territory) > 0) {
                    $towns = $mgr->getTowns(array_key_first($territory));
                    $beats = $mgr->getBeats(array_key_first($territory), array_key_first($controlType));
                    $customers = $mgr->getCustomersByBeat(array_key_first($beats));

                }


                $this->data['form_name'] = "Add TourPlan";
                $f = FormMgr::formHorizontal();
                $f->add([
                    'Agendacontroltype' => FormMgr::select()->options($controlType)->label('Agenda')->datachange('selectAgendacontroltype')->id("AgendaControlType"),
                    'AgendaId' => FormMgr::select()->options([])->label('Sub Agenda')->datachange('selectAgenda'),
                    'Territory' => FormMgr::select()->options($territory)->label('Territory')->datachange('selectTerritory')->id("Territory"),
                    'Itownid' => FormMgr::select()->options($towns)->label('Town')->id("Town"),
                    'BeatId' => FormMgr::select()->options($beats)->label('Patch')->id("Patch")->datachange('selectBeat'),
                    'OutletOrgDataId' => FormMgr::select()->options($customers)->label('Customers')->id("Customers"),


                ]);
                $tourplan = new Tourplans();
                if ($pk > 0) {
                    $tourplan = \entities\TourplansQuery::create()->findPk($pk);
                    $f->val($tourplan->toArray());
                    $this->data['form_name'] = "Edit ";

                }
                if ($this->app->isPost() && $f->validate()) {

                    if ($_POST["Agendacontroltype"] == "FW") {
                        $ifExists = TourplansQuery::create()
                            ->filterByMtpDayId($mtpDay->getPrimaryKey())
                            ->filterByOutletOrgDataId($_POST["OutletOrgDataId"])
                            ->filterByPositionId($mtp->getPositionId())
                            ->find()->count();

                        if ($ifExists > 0) {
                            $this->app->Session()->setFlash("error", "OUTLET ALREADY EXISTS");
                            $form = $f->html();
                            $this->data['form'] = $form;
                            $this->app->Renderer()->render("fsm/tourplan.twig", $this->data);
                            return;
                        }
                    }


                    $tourplan->fromArray($_POST);

                    $tourplan->setMtpDayId($mtpDay->getPrimaryKey());
                    $tourplan->setMtpId($mtp->getPrimaryKey());
                    $tourplan->setTpDate($mtpDay->getMtpDayDate());
                    $tourplan->setPositionId($mtp->getPositionId());
                    $tourplan->setWeekday($mtpDay->getWeekday());
                    $tourplan->setWeeknumber($mtpDay->getWeeknumber());
                    $tourplan->setCompanyId($this->app->Auth()->CompanyId());
                    $tourplan->setIsjw(false);

                    if ($_POST["Agendacontroltype"] == "JW") {
                        $tourplan->setIsjw(true);
                        $outlet = OutletViewQuery::create()->findPk($_POST["OutletOrgDataId"]);
                        $tourplan->setItownid($outlet->getItownid());
                        $tourplan->setBeatId($outlet->getBeatId());
                    } else if ($_POST["Agendacontroltype"] == "FW") {
                        $Itownid = BeatsQuery::create()->findPk($_POST["BeatId"])->getItownid();
                        $tourplan->setItownid($Itownid);
                    } else {
                        $tourplan->setOutletOrgDataId(NULL);
                        $tourplan->setBeatId(NULL);
                    }

                    $tourplan->save();

                    $mgr->updateMTPStats($mtp->getPrimaryKey());

                    $this->runModalScript("loadGrid()");
                    return;
                }
                $form = $f->html();
                $this->data['form'] = $form;
                $this->app->Renderer()->render("fsm/tourplan.twig", $this->data);
                break;

        endswitch;

    }
   
}
