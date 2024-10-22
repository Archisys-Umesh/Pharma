<?php declare(strict_types = 1);

namespace Modules\HR\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use Modules\System\Processes\WorkflowManager;
use Modules\System\Runtime\PolicyRequest;
use Modules\System\Processes\PolicyChecker;

class Audit extends \App\Core\BaseController
{	               
    protected $app;
    private $WfDoc = "Expenses";
        
    public function __construct(App $app)
    {
            $this->app = $app;		
    }
    
    public function index()
    {
        $action = $this->app->Request()->getParameter("action","");
        
        $this->data['start'] = date('m/01/Y',strtotime('this month'));
        $this->data['end'] = date('m/t/Y',strtotime('this month'));
                
        switch ($action) :
            case "":                
                $this->app->Renderer()->render("hr/expenseAudit",$this->data);
                break;
            case "list" :
                
                $status = $this->app->Request()->getParameter("status",1);
                
                $dr = $this->app->Request()->getParameter("dr",$this->data['start']." - ".$this->data['end']);        
                $daterange = explode(" - ", $dr);
                
                $expenses = \entities\ExpensesQuery::create()
                     ->joinWithEmployee()
                     ->joinWithBudgetGroup()                     
                     ->filterByEmployee($this->app->Auth()->getUser()->getEmployee()) //,\Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL
                     ->filterByExpenseStatus($status)
                     ->filterByExpenseDate($daterange[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                     ->filterByExpenseDate($daterange[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                     ->orderByExpenseDate(\Propel\Runtime\ActiveQuery\Criteria::ASC)
                     ->find()->toArray();
                
                $this->json(["data" => $expenses]);
                break;            
                
        endswitch;
        
    }
    
   public function moveClaims($flag)
    {
        $this->data['form_name'] = "Are you Sure ?";
        $f = FormMgr::formHorizontal();        
        $f->add([        
            'Note' => FormMgr::text()->label('Notes'),                        
            'ExpId' => FormMgr::hidden()->id("expidmove")
        ]);
        if($this->app->isPost() && $f->validate()){
            $exp = $this->app->Request()->getParameter("ExpId","");
            $note = $this->app->Request()->getParameter("Note","");
            $expenses = \entities\Base\ExpensesQuery::create()
                      ->findPks($exp);            
            $wf = new WorkflowManager();            
            if($expenses) {
                
                foreach($expenses as $e)
                {
                    if($flag == 1){
                        $e->setExpenseStatus(5); // Move to In Audit
                    }
                    if($flag == 2){
                        $e->setExpenseStatus(6); // Processed
                    }
                    if($flag == 3){
                        $e->setExpenseStatus(7); // Cancelled
                    }
                    $e->save();
                    $wf->createLog($this->WfDoc, $e, $this->app->Auth()->getUser()->getEmployee(), "", $note, 0);
                    
                }
            }
            $this->runModalScript("getExpenses()");
            return;
        }
        
        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("hr/moveClaims",$this->data);
    }

    public function divisionExpenseAudit(){
        $action = $this->app->Request()->getParameter("action","");
        switch ($action) :
            case "";
                    $this->app->Renderer()->render("hr/divisionAuditView.twig",$this->data);
                break;
            case "list":
                    $orgUnits = \entities\OrgUnitQuery::create()
                                    ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
                                    ->find()->toArray();
                                    //var_dump($orgUnits);exit;
                    $this->json(["data"=>$orgUnits]);
                break;
        endswitch;
    }
    
    public function moveToAudit($orgunit)
    {
        
        $action = $this->app->Request()->getParameter("action","");
        //$units = $this->app->Request()->getParameter("orgunit");
        $data = [];
        switch ($action) :
            case "";
                $this->data['monthList'] = FormMgr::select()
                        ->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths($this->getConfig("HR", "allowedMonths")))
                        ->html();
                /* Start btnview */
                $this->data['monthLists'] = \Modules\ESS\Runtime\EssHelper::getAllowedMonths($this->app->Auth()->getUser()->getCompany()->getExpenseMonths());
                $pendingAction = WorkflowManager::getPendingRequestPks($this->WfDoc, $this->app);
                $months = \Modules\ESS\Runtime\EssHelper::getStartEndMonth();
                $this->data['setcurrntmonth'] = $months['endDate'];  
                /* end btnview */
                
                $curdata = [];
                $currency = \entities\ExpensesQuery::create()
                        ->filterByExpenseStatus(array(3,6,8)) //3,5 change to 6
                        ->orderByExpenseDate(\Propel\Runtime\ActiveQuery\Criteria::ASC)
                        ->find();
                        
                if(count($currency) > 0){
                    foreach ($currency as $c){
                        $curdata[$c->getTripCurrency()] = $c->getCurrencies()->getName();
                    }
                    if(count($curdata) == 1){
                        $curdata = [];
                    }
                }    
                $stage = 0;
                
                if(isset($_GET['stage'])){
                    $stage = $_GET['stage'];
                }
                
                $this->data['stage'] = $stage;

                // $orgUnits = \entities\OrgUnitQuery::create()
                //                 ->filterByCompanyId($this->app->Auth()->getUser()->getEmployee()->getCompanyId())
                //                 ->find()->toKeyValue('Orgunitid','UnitName');

                //$this->data['orgUnitList'] = FormMgr::select()->options($orgUnits)->html();
                //$this->data['tripCurrency'] = FormMgr::select()->options([0 => " All Currency "]+$curdata)->html();
                //$this->app->Renderer()->render("hr/moveToAudit",$this->data);
                $this->app->Renderer()->render("hr/moveToAuditbtnView.twig",$this->data);
                break;
                
            case "list":
                    $status = $this->app->Request()->getParameter("expStatus","");
                    //$curdata = $this->app->Request()->getParameter("currency");
                    $curdata = 1;
                    $month = explode("|",$this->app->Request()->getParameter("month","|"));
                    $getmonth = $this->app->Request()->getParameter("month");
                    //$units = \Modules\HR\Runtime\HrHelper::getAllowedUnits($this->app->Auth()->getUser()->getEmployee());

                    
                    $allowedMonths = \Modules\ESS\Runtime\EssHelper::getAllowedMonths($this->app->Auth()->getUser()->getCompany()->getExpenseMonths());                
                    $counts = [];
                    foreach($allowedMonths as $a => $b)
                    {
                        $counts[$b] = 0;                    
                    }                
                    
                    //$monthSelected = $allowedMonths[$this->app->Request()->getParameter("month","|")]; // Backup
                    //unset($allowedMonths[$this->app->Request()->getParameter("month","|")]); // Remove month Selected  

                    $units = $orgunit;
                    
                    $expenses = $this->movetoAuditQuery($status, $curdata, $getmonth, $units, "case1");
                    
                    $countsCurrency = [];
                    foreach($expenses as $tripCurr){
                        array_push($countsCurrency, $tripCurr->getTripCurrency());
                    }
                    
                    // foreach($allowedMonths as $mn => $mns) // Getting count for other months than not selected
                    // {                        
                    //   $d = $this->movetoAuditQuery($status, $curdata, $mn, $units, "case2");
                    //   $counts[$mns] =  count($d->toArray());
                    // }
                    $summary = [];
                    $i=0;
                    
                    foreach($expenses as $e)
                    {
                        
                        
                        $expensesReq = array($e->getExpenseReqAmt()); 
                        $expensesCur = $e->getTripCurrency();
                        
                        $configure = \entities\CurrenciesQuery::create()->filterByCurrencyId($expensesCur)->find();
                        $curreName = [];
                        
                        foreach ($configure as $c){
                            array_push($curreName, $c->getShortcode());
                        
                        }
                        
                        $cureeArray = array_combine($expensesReq,$curreName);
                        $reCalculate = \Modules\ESS\Runtime\EssHelper::reCalculate($e->getExpId());
                        
                        if(!isset($summary[$e->getEmployeeId()]))
                        {
                            $i++;
                            $readflag = 0;
                            if($e->getReadflag() == 1){
                                $readflag = 1;
                            }

                            $expPending = \entities\ExpensesQuery::create()
                                            ->filterByExpenseStatus([1,2])
                                            ->filterByEmployeeId($e->getEmployeeId())
                                            ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                                            ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                                            ->find()->count();
                            $expTotal = \entities\ExpensesQuery::create()
                                            ->filterByEmployeeId($e->getEmployeeId())
                                            ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                                            ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                                            ->find()->count();
                        
                            if($expPending == 0){
                                $summary[$e->getEmployeeId()] = 
                                    [
                                        "id" => $e->getEmployeeId(),
                                        "Emp" => $e->getEmployee()->toArray(),
                                        "Town" => $e->getEmployee()->getGeoTowns()->toArray(),
                                        "Designation" => $e->getEmployee()->getDesignations()->toArray(),
                                        "TotalReq" => $e->getExpenseReqAmt(),
                                        "TotalApr" => $e->getExpenseApprovedAmt(),
                                        "TotalAud" => $e->getExpenseFinalAmt(),
                                        "Claims" => 1,
                                        "month"=>$month[0]."|".$month[1],
                                        "empId"=>$e->getExpId(),
                                        "cur" => $e->getTripCurrency(),
                                        "srno"=>$i,
                                        "readflag"=>$readflag,
                                        "totalExp"=>$expTotal,
                                        "expPending"=>$expPending
                                    ];
                            }
                            // $summary[$e->getEmployeeId()] = 
                            //         [
                            //             "id" => $e->getEmployeeId(),
                            //             "Emp" => $e->getEmployee()->toArray(),
                            //             "Designation" => $e->getEmployee()->getDesignations()->toArray(),
                            //             "TotalReq" => $e->getExpenseReqAmt(),
                            //             "TotalApr" => $e->getExpenseApprovedAmt(),
                            //             "TotalAud" => $e->getExpenseFinalAmt(),
                            //             "Claims" => 1,
                            //             "month"=>$month[0]."|".$month[1],
                            //             "empId"=>$e->getExpId(),
                            //             "cur" => $e->getTripCurrency(),
                            //             "srno"=>$i,
                            //             "readflag"=>$readflag,
                            //             "totalExp"=>$expTotal,
                            //             "expPending"=>$expPending
                            //         ];
                        }
                        else 
                        {   
                            $summary[$e->getEmployeeId()]["TotalReq"] += $e->getExpenseReqAmt();
                            $summary[$e->getEmployeeId()]["TotalApr"] += $e->getExpenseApprovedAmt();
                            $summary[$e->getEmployeeId()]["TotalAud"] += $e->getExpenseFinalAmt();
                            $summary[$e->getEmployeeId()]["Claims"] += 1;
                        }
                    }  
                    
                    $this->json(["data"=>array_values($summary),"count"=>$counts]);
                      
                   
                break;
            case "move":
                    $ExpId = $this->app->Request()->getParameter("EmpId",[]);
                    $moveStatus = $this->app->Request()->getParameter("moveStatus");
                
                    //$wfManager = new \Modules\System\Processes\WorkflowManager();            
                    $month = explode("|",$this->app->Request()->getParameter("month","|"));
                    
                        $entity = \entities\ExpensesQuery::create()
                                ->filterByExpenseStatus([3,6,8])
                                ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                                ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                                ->filterByEmployeeId($ExpId)
                                ->find();
                                
                        if($entity){        
                            foreach($entity as $en){
                                $en->setExpenseStatus($moveStatus);
                                $en->save();
                            }                            
                        }
                        if($moveStatus == 10) { // If Send to Accounts.. 
                            
                            foreach($ExpId as $empId) {
                                $emp = \entities\EmployeeQuery::create()->findPk($empId);
                                if($emp){
                                    //$this->sendAuditCompleteEmail($emp,$emp->getEmail());   
                                }
                                
                            }
                            //$this->sendEmailtoAccountAfterAudit($month);
                            
                        }
                        $this->json(["status" => "1"]);
                        //$wfManager->process($this->WfDoc, $entity,"");
                    
                break;
                case "validate":
                    $empid = $this->app->Request()->getParameter("empid");      
                    $readflag = $this->app->Request()->getParameter("readflag");      
                    $status = $this->app->Request()->getParameter("status");      
                    $month = explode("|", $this->app->Request()->getParameter("date"));      
                    
                    $validateExp = \entities\ExpensesQuery::create()
                            ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                            ->filterByExpenseStatus($status)
                            ->filterByEmployeeId($empid)
                            ->find();
                    if($validateExp){
                        foreach($validateExp as $v){
                            $v->setReadflag($readflag);
                            $v->save();
                        }
                        $this->json(["status" => 1]);
                    }else{
                        $this->json(["status" => 0]);
                    }
                break;
        endswitch;
    }
    
    function movetoAuditQuery($status,$curdata,$getmonth,$units,$case){
       
        extract($this->DTFilters($_GET));
        $response = [];

        $month = explode("|", $getmonth);
        if($case == "case1"){
            $query = \entities\ExpensesQuery::create()
                ->joinWithCurrencies()
                ->filterByExpenseStatus((int)$status)
                ->filterByTripCurrency((int)$curdata)
                ->filterByEmployee($this->app->Auth()->getUser()->getEmployee(), \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                ->filterByOrgunitId($units);

            $count = $query->count();
            $response["recordsTotal"] = $count;

            if (!empty($search)) {
                $search = '%' . $search . '%';
                $query = $query->filterByCategoryName($search, \Propel\Runtime\ActiveQuery\Criteria::LIKE);
            }

            $count = $query->count();
            $response["recordsFiltered"] = $count;
            $query->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
            
        
        }else{
            $query = \entities\ExpensesQuery::create()
                ->select(['EmployeeId'])
                ->joinWithCurrencies()
                ->filterByExpenseStatus((int)$status)
                ->filterByTripCurrency((int)$curdata)
                ->filterByEmployee($this->app->Auth()->getUser()->getEmployee(), \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                ->filterByOrgunitId($units);

                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query = $query->filterByCategoryName($search, \Propel\Runtime\ActiveQuery\Criteria::LIKE);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $query->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
        }
        return $query;
    }
    public function audit()
    {
        $action = $this->app->Request()->getParameter("action","");
        $units = \Modules\HR\Runtime\HrHelper::getAllowedUnits($this->app->Auth()->getUser()->getEmployee());
        $data = [];
        switch ($action) :
            case "":
                $this->data['monthList'] = FormMgr::select()
                    ->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths($this->getConfig("HR", "allowedMonths")))
                    ->html();
                
                
                $this->app->Renderer()->render("hr/auditscreen.twig",$this->data);
                break;
            case "filters":
                $key = $this->app->Request()->getParameter("key","");
                $currences = $this->app->Request()->getParameter("currency",0);
                
                $month = explode("|",$this->app->Request()->getParameter("month","|"));
                $expenses = \entities\ExpensesQuery::create()                                                            
                    ->filterByExpenseStatus(5)                                        
                    ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->filterByOrgunitId($units);
                    if($currences > 0){
                        $expenses->filterByTripCurrency($currences);
                    }
                    $expenses->orderByExpenseDate(\Propel\Runtime\ActiveQuery\Criteria::ASC);
                    $expenses->find();
                if($key == "designation")
                {
                    $designations = [];                    
                    foreach($expenses as $e)
                    {
                        if(!isset($designations[$e->getEmployee()->getDesignationId()]))
                        {
                            $designations[$e->getEmployee()->getDesignationId()] = $e->getEmployee()->getDesignations()->getDesignation();
                        }
                    }
                                                  
                    $this->json(["ddl"=> FormMgr::select()->options($designations)->html()]);
                }
                if($key == "employee")
                {
                    $designation = $this->app->Request()->getParameter("designation","");                    
                    $emp = [];
                    foreach($expenses as $e) {
                        if($e->getEmployee()->getDesignationId() == $designation)
                        {
                            if(!isset($emp[$e->getEmployee()->getEmployeeId()]))
                            {
                                $emp[$e->getEmployee()->getEmployeeId()] = $e->getEmployee()->getFirstName()." ".$e->getEmployee()->getLastName()." | ".$e->getEmployee()->getEmployeeCode();
                            }
                        }
                    }
                   
                    $this->json(["ddl"=> FormMgr::select()->options($emp)->html()]);
                }
                
                break;
            case "load":
               
                $data = [];
                if(isset($_POST['currency'])){
                    $currencesid = $this->app->Request()->getParameter("currency");
                }else{
                    $currencesid = $this->app->Request()->getParameter("cur");
                    $currencesid = 0;
                }
              
                $status = $this->app->Request()->getParameter("status");
                $this->data['expStatus'] = $status;
                $month = explode("|",$this->app->Request()->getParameter("month","|"));
                $designation = $this->app->Request()->getParameter("designation","");                    
                $employee = $this->app->Request()->getParameter("employee",""); 
                
                $currency = \entities\ExpensesQuery::create()
                        ->filterByExpenseStatus($status) //3,5 change to 6
                        ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                        ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)                    
                        ->filterByEmployeeId($employee)
                        ->orderByExpenseDate(\Propel\Runtime\ActiveQuery\Criteria::ASC)
                        ->find();
                
                if(count($currency) > 0){
                    foreach ($currency as $c){
                        $data[$c->getTripCurrency()] = $c->getCurrencies()->getName();
                    }
                    if(count($data) == 1){
                        $data = [];
                    }
                }    
                $this->data['tripCurrency'] = FormMgr::select()->options([0=>'All Currency']+$data)->html();
                
                $expenses = \entities\ExpensesQuery::create()
                    ->filterByExpenseStatus($status) //3,5 change to 6
                    ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)                    
                    ->filterByEmployeeId($employee)
                    ->orderByExpenseDate(\Propel\Runtime\ActiveQuery\Criteria::ASC)
                    ->find();
                    // if ($currencesid > 0){
                    //     $expenses->filterByTripCurrency($currencesid);
                    // }
                    // $expenses->orderByExpenseDate(\Propel\Runtime\ActiveQuery\Criteria::ASC)
                    // ->find();
                
                $heads = [];
                $heads_total = [];
                $rows = [];
                $km = [];
                $kmMode = [];                
                $Cru = [];                
                $kmModeLimit = [];
                $requested = 0;
                $approved = 0;
                $final = 0;
                $totalkm = 0;
                $Additional = 0;
                
                //$carCount = \entities\EmployeeQuery::create()->findPk($employee)->getDesignations()->getCarcount();
                $carCount = 0;
                
                if($expenses){
                    foreach($expenses as $key=>$e)
                    {

                        $list = $e->getExpenseLists();
                        $expListNote = array();
                        $expAuditorNote = array();

                        $positionId = $e->getEmployee()->getPositionId();
                         
                        $dailyCalls = \entities\DailycallsQuery::create()
                                            ->filterByDcrDate($e->getExpenseDate())
                                            ->filterByPositionId($positionId)
                                            ->find()->toArray();
                        $dayTypeArray = array();
                        foreach($dailyCalls as $dailyCall){
                            array_push($dayTypeArray,$dailyCall['Agendacontroltype']);
                        }

                        $dayTypeArrayImp = implode(',',array_unique($dayTypeArray));

                        $callCount = count($dailyCalls);
                        $media = [];
                        foreach($list as $l)
                        {
                            if(!isset($heads[$l->getExpMasterId()]))
                            {
                                $heads[$l->getExpMasterId()] = $l->getExpenseMaster()->getExpenseName();
                                $heads_total[$l->getExpMasterId()] = 0;
                            }
                            $heads_total[$l->getExpMasterId()] += $l->getExpFinalAmount(); 
                            
                            if($l->getExpRateMode() == "Car")
                            {
                              $carCount = $carCount - 1;  
                              $kmModeLimit[$l->getExpId()] = $carCount;
                            }
                            else 
                            {
                                $kmModeLimit[$l->getExpId()] = 0;
                            }
                            if(isset($kmMode[$l->getExpId()]))
                            {
                                if($kmMode[$l->getExpId()] == "")
                                {
                                    $kmMode[$l->getExpId()] = $l->getExpRateMode();
                                }
                                else 
                                {
                                    $kmMode[$l->getExpId()] = $kmMode[$l->getExpId()] .",". $l->getExpRateMode();
                                }
                            }
                            else
                            {
                                $kmMode[$l->getExpId()] = $l->getExpRateMode();
                            }
                            
                            if(!isset($km[$l->getExpId()]))
                            {
                                $km[$l->getExpId()] = $l->getExpRateQty();                                                                                                
                                
                            }else{
                                                                
                                $km[$l->getExpId()] += $l->getExpRateQty();                                                                
                                
                            }

                            if($l->getExpNote() != null){
                                array_push($expListNote,$l->getExpNote());
                            }

                            if($l->getExpAuditRemark() != null){
                                array_push($expAuditorNote,$l->getExpAuditRemark());
                            }

                            $listDetauils = \entities\ExpenseListDetailsQuery::create()
                                                ->select(['Image'])
                                                ->filterByExpListId($l->getExpListId())
                                                ->find()
                                                ->toArray();

                            $media[] = \entities\MediaFilesQuery::create()
                                            ->select(['MediaData'])
                                            ->filterByMediaId($listDetauils)
                                            ->find()
                                            ->toArray();
                            
                        }
                        
                        $isWeekend = false;
                        $w = $e->getExpenseDate()->format("w");
                        if($w == 0)
                        {
                            $isWeekend = true;
                        }
                        $origin = "";
                        $destination = "";
                        $currency = "";

                    //     if($e->getExpenseTrip() > 0){
                    //         $trips = \entities\TripsQuery::create()
                    //         ->filterByTripId($e->getExpenseTrip())
                    //         ->findOne();
                    //    if($trips){
                    //         $origin = $trips->getTripOriginName();
                    //         $destination = $trips->getTripDestinationName();
                    //         $currency = $trips->getCurrencies()->getName();
                    //     }
                    //     }
                        $rows[$e->getExpenseDate()->format("d-m-Y")] = [
                            "Expid" => $e->getPrimaryKey(),
                            "Readflag" => $e->getReadflag(),
                            "Date" => $e->getExpenseDate()->format("d-m-Y"),
                            "IO" => $e->getBudgetGroup()->getGroupcode(),                        
                            "Requested" => $e->getExpenseReqAmt(),
                            "Approved" => $e->getExpenseApprovedAmt(),
                            "Additional" => $e->getExpenseAdditionalAmt(),
                            "Final" => $e->getExpenseFinalAmt(),
                            "Exp" => $e->getExpenseLists()->toKeyIndex("ExpMasterId"),
                            "isWeekend" => $isWeekend,
                            "Days"=>$e->getExpenseDate()->format("D"),
                            "origincity"=>$origin,
                            "destinationcity"=>$destination,
                            "working"=>$e->getExpensePlacewrk(),
                            "km"=>$km[$e->getPrimaryKey()],
                            "kmMode" => $kmMode[$e->getPrimaryKey()],
                            "Cru" => $e->getCurrencies(),
                            "remark" => $e->getExpenseNote(),
                            "Currency" =>$currency,
                            "carCount" => $kmModeLimit[$e->getPrimaryKey()],
                            'TripType' => $e->getTripType(),
                            'DayType' => $dayTypeArrayImp,
                            'CallCount' => $callCount,
                            'ExpListNote' => $expListNote,
                            'ExpAuditorNote' => $expAuditorNote,
                            'DoVerify' => $e->getDoVerify(),
                            "image" => $media,
                        ];
                        
                        //array_push($rows, $r);
                        $totalkm += $km[$e->getPrimaryKey()];
                        $requested += $e->getExpenseReqAmt();
                        $approved += $e->getExpenseApprovedAmt();
                        $final += $e->getExpenseFinalAmt(); 
                        $Additional += $e->getExpenseAdditionalAmt();

                        $this->data['title'] = $e->getEmployee()->getFirstName()." ".$e->getEmployee()->getLastName()." | ".$e->getEmployee()->getEmployeeCode()." | ".$e->getEmployee()->getBranch()->getBranchname()." | ".$e->getEmployee()->getDesignations()->getDesignation();
                    } 
                
                }
                
                ksort($rows);

                $this->data['ExpenseReqAmt'] = $requested;
                $this->data['ExpenseApprovedAmt'] = $approved;
                $this->data['ExpenseFinalAmt'] = $final;                
                $this->data['employee'] = $employee;
                $this->data['heads'] = $heads;
                $this->data['rows'] = $rows;
                $this->data['totalkm'] = $totalkm;
                $this->data['Additional'] = $Additional;
                $this->data['headcount'] = round(14 + count($heads));
                $this->data['headcountSecond'] = round((14 + count($heads))/3);
                $this->data['headTotals'] = $heads_total;
                if(isset($_POST['currency'])){
                    $currencySelection = FormMgr::select()->options([0=>'All Currency']+$data);    
                    $currencySelection->val($currencesid);                    
                    $this->data['tripCurrency'] = $currencySelection->html();
                }
//                $this->data['monthList'] = FormMgr::select()
//                    ->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths($this->getConfig("HR", "allowedMonths")))
//                    ->html();
                
                
                $this->app->Renderer()->render("hr/auditscreen.twig",$this->data);
                break;
            case "process":
                
                $ExpId = $this->app->Request()->getParameter("ExpId",[]);      
                $flag = $this->app->Request()->getParameter("flag","P");      
                $status = $this->app->Request()->getParameter("status");      
                $wf = new WorkflowManager();
                
                $subject = "Expenses Approved !!";
                
                
                $notification = new \App\Utils\Notifications(\App\Abstracts\NotificationType::OnlyShow,"",[]);
                $expenses = \entities\Base\ExpensesQuery::create()
                    ->findPks($ExpId);
                if($expenses) {
                
                    foreach($expenses as $e)
                    {
                   
//                        if($flag == "P"){
//                            $e->setExpenseStatus($$status); // Processed
//                        }
//                        if($flag == "C"){
//                            $e->setExpenseStatus(7); // Cancelled
//                        }
                        $e->setExpenseStatus($status); 
                        $e->save();
                        $wf->createLog($this->WfDoc, $e, $this->app->Auth()->getUser()->getEmployee(), "", "", 0);
                        
                        /*$data = [
                            "Month"=>"Your ".$e->getExpenseDate('M')." Month Expenses Approved"
                        ];
                        $body = $this->app->Renderer()->render("system\EmailExpensesApproval",$data,false);
                        \App\Utils\Emails::sendEmail($e->getEmployee()->getEmail(), $subject, $body);
                        */
                        /*if($e->getEmployee()->getUserss()->getFirst()->getFcmToken()){
                            $notification->setMessage("Your ".$e->getExpenseDate('M')." Month Expenses Approved");
                            $notification->setFCMToken($e->getEmployee()->getUserss()->getFcmToken());
                            $notification->sendFCMNotification();
                        }*/
                    }
                    $this->data['toster_info'] = "Audit Succssfully moved";
                }
                $this->json(["status" => 0]);
                
                break;
                case "validate":
                    $ExpId = $this->app->Request()->getParameter("expid");      
                    $readflag = $this->app->Request()->getParameter("readflag");      
                    
                    $validateExp = \entities\ExpensesQuery::create()->findPk($ExpId);
                    if($validateExp){
                        $validateExp->setReadflag($readflag);
                        $validateExp->save();
                        $this->json(["status" => 1]);
                    }else{
                        $this->json(["status" => 0]);
                    }
                break;
        endswitch;
    }
    public function auditorFrom($id) {
        $expListId = $id;
        $action = $this->app->Request()->getParameter("action");
        $f = FormMgr::formHorizontal();
        $entity = \entities\ExpenseListQuery::create()->joinWithExpenseMaster()->findPk($expListId);
        
        $netpayble = $entity->getExpIlAmount()+$entity->getExpTaxAmount();
        $totalExp = $netpayble+$entity->getExpReqAmount()-$entity->getExpClaimedTax();
        if($entity->getExpenseMaster()->getAdditionalText() == 1){
            $f->add([
                "ExpAuditAmount" => FormMgr::text()->label('Net Payable Amt (with GST)')->value($entity->getExpAuditAmount())->readonly()->id('ExpAuditAmount'),
                "ExpTestAmount" => FormMgr::text()->label('Req Amt + Add Amt')->value($entity->getExpAuditAmount()-$entity->getExpClaimedTax())->class("changeAmount")->id("ExpTestAmount"),
                "ExpClaimedTax" => FormMgr::text()->label('Claimed GST')->value($entity->getExpClaimedTax())->class("changeAmount")->id("ExpClaimedTax"),
                "ExpAuditRemark" => FormMgr::text()->label('Note *')->required()

            ]); 
        }else{
            $f->add([
                "ExpAuditAmount" => FormMgr::text()->label('Final')->value($entity->getExpAuditAmount()),
                "ExpAuditRemark" => FormMgr::text()->label('Note *')->required()
            ]); 
        }     

        
        $f["ExpAuditRemark"]->val($entity->getExpAuditRemark());
        
        $requested = $entity->getExpIlAmount();
        $gst = $entity->getExpTaxAmount();
        $Additional = $entity->getExpReqAmount();
        $TotalRequested = $requested+$gst+$Additional;
        $Approved = $entity->getExpAprAmount();
        
        $this->data['requested'] = $requested;
        $this->data['gst'] = $gst;
        $this->data['Additional'] = $Additional;
        $this->data['TotalRequested'] = $TotalRequested;
        $this->data['Approved'] = $Approved;
        
        $this->data['form_name'] = $entity->getExpenseMaster()->getExpenseName()." | ".$entity->getExpDate('d-m-Y');
        
        if($this->app->isPost() && $f->validate()){
            $employee = $this->app->Auth()->getUser()->getEmployee();
            $data = \Modules\ESS\Runtime\EssHelper::editApprovel($_POST,$expListId,"changeExp",$employee);
            
            $this->closeModalWithToast("Changes has been saved.");
            return; 
        }
        
        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("hr/auditorFrom.twig",$this->data);
    }
    public function expRemark($id) {
        $action = $this->app->Request()->getParameter("action");
        
        $entity = \entities\ExpenseListQuery::create()->joinWithExpenseMaster()->findPk($id);                
        $this->data['expNote'] = $entity->getExpNote();
        $this->data['expRemark'] = $entity->getExpRemark();
        $this->data['expAuditRemark'] = $entity->getExpAuditRemark();
        $this->data['form_name'] = $entity->getExpenseMaster()->getExpenseName()." | ".$entity->getExpDate('d-m-Y');
        
        $this->app->Renderer()->render("hr/expNote.twig",$this->data);
    }
    public function sendAuditCompleteEmail(\entities\Employee $user,$email)
    {        
        $subject = "Expenses Have been Audited";
        $data = [
            "empDetails"=>$user->getFirstName()." ".$user->getLastName()." | ".$user->getEmployeeCode()." | ".$user->getDesignations()->getDesignation(),
            "message" => "Your expenses have been Audited",
            "url" => $this->app->Router()->baseUrl(),
            "linkTitle" => "Sign in"
                ];
        $body = $this->app->Renderer()->render("system\EmailMessages.twig",$data,false);
        //$configure = \entities\ConfigurationQuery::create()->find()->getFirst();
        
        //$emailId = $configure->toArray()['AdminCc'];
        
        \App\Utils\Emails::sendEmail(explode(",",$email), $subject, $body, $user->getCompanyId());
    }
    
    public function sendEmailtoAccountAfterAudit($month){   
        
        
        //$configure = \entities\ConfigurationQuery::create()->find()->getFirst();
        //$AccountEmails = $configure->toArray()['AccountEmails'];
        
        $configure = \entities\ConfigurationQuery::create()->findOne();
        $AccountEmails = $configure->getAccountEmails();
        
        $months = implode($month, "|");
        $newmonth = date("M-Y", strtotime($month[0]));
       
        $subject = $newmonth." Reports";
        $data = [
            "empDetails"=> $newmonth." All Employee Details",
            "message" => "This Employee Process to Payment",
            "url" => $this->app->Router()->baseUrl()."monthlyReportsforEmployee?month=".$months,
            "linkTitle" => "Download Reports"
                ];
        $body = $this->app->Renderer()->render("system\EmailMessages.twig",$data,false);
        
        \App\Utils\Emails::sendEmail(explode(",",$AccountEmails), $subject, $body, $configure->getCompanyId());
    }
    
}
    
