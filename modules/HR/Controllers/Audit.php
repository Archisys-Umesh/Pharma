<?php declare(strict_types = 1);

namespace Modules\HR\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use Modules\System\Processes\WorkflowManager;
use Modules\System\Runtime\PolicyRequest;
use Modules\System\Processes\PolicyChecker;
use Propel\Runtime\ActiveQuery\Criteria;

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
        ini_set('memory_limit', '-1');
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
                    $this->json(["data"=>$orgUnits]);
                break;
        endswitch;
    }
    
    public function moveToAudit($orgunit)
    {
        ini_set('memory_limit', '-1');
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
                $empStatus = $this->app->Request()->getParameter("empStatus","");

                
                $curdata = 1;
                $month = explode("|",$this->app->Request()->getParameter("month","|"));
                $getmonth = $this->app->Request()->getParameter("month");
                $units = $orgunit;
                $month = explode("|", $getmonth);

                $expenses = \entities\ExpensesQuery::create('E')
                                ->select(['ExpenseReqAmt','ExpenseApprovedAmt','ExpenseFinalAmt','EmployeeId','FirstName','LastName','EmployeeCode','Designation','TownName','OrgUnitId'])
                                ->withColumn('sum(E.ExpenseReqAmt)', 'ExpenseReqAmt')
                                ->withColumn('sum(E.ExpenseApprovedAmt)', 'ExpenseApprovedAmt')
                                ->withColumn('sum(E.ExpenseFinalAmt)', 'ExpenseFinalAmt')
                                ->join('E.Employee')
                                ->join('Employee.Designations')
                                ->join('Employee.GeoTowns')
                                ->withColumn('Employee.EmployeeId', 'EmployeeId')
                                ->withColumn('Employee.FirstName', 'FirstName')
                                ->withColumn('Employee.Remark', 'Remark')
                                ->withColumn('Employee.LastName', 'LastName')
                                ->withColumn('Employee.EmployeeCode', 'EmployeeCode')
                                ->withColumn('Designations.Designation', 'Designation')
                                ->withColumn('GeoTowns.Stownname', 'TownName')
                                ->withColumn('Employee.OrgUnitId', 'OrgUnitId')
                                ->withColumn('Employee.Status', 'Status')
                                ->filterByExpenseStatus((int)$status)
                                ->filterByTripCurrency(1)
                                ->filterByEmployee($this->app->Auth()->getUser()->getEmployee(), \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                                ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                                ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                                ->filterByOrgunitId($units)
                                ->useEmployeeQuery()
                                    ->filterByStatus($empStatus)
                                ->endUse()
                                ->groupByEmployeeId()
                                ->find()->toArray();
                
                $counts = 0;                
                $dataArr = array();
                foreach($expenses as $expense){
                    $expCount = \entities\ExpensesQuery::create()
                                ->filterByEmployeeId($expense['EmployeeId'])
                                ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                                ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                                ->find()->count();
                    $expApprovedCount = \entities\ExpensesQuery::create()
                                ->filterByExpenseStatus(3, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                                ->filterByEmployeeId($expense['EmployeeId'])
                                ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                                ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                                ->find()->count();                                                          
               
                    if($expCount == $expApprovedCount){                    
                        array_push($dataArr,$expense);
                    }
                }
                $this->json(["data"=>$dataArr, "count"=>$counts]);
                break;
            case "move":
                    $ExpId = $this->app->Request()->getParameter("EmpId",[]);
                    $moveStatus = $this->app->Request()->getParameter("moveStatus");
                 
                    //$wfManager = new \Modules\System\Processes\WorkflowManager();            
                    $month = explode("|",$this->app->Request()->getParameter("month","|"));
                    $wf = new WorkflowManager();
                    
                        $entity = \entities\ExpensesQuery::create()
                                ->filterByExpenseStatus([3,6,8,10,9])
                                ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                                ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                                ->filterByEmployeeId($ExpId)
                                ->find();
                                  
                        if($entity){        
                            foreach($entity as $en){
                                $en->setExpenseStatus($moveStatus);
                                $en->save();
                                $wfLog = \entities\WfLogQuery::create()
                                            ->filterByWfDocPk($en->getExpId())
                                            ->orderByWfLogId('DESC')
                                            ->findOne();
                                $wfStatus = \entities\WfStatusQuery::create()
                                                ->filterByWfStatusId($moveStatus)
                                                ->findOne();
                                $wf->createLog($this->WfDoc, $en, $this->app->Auth()->getUser()->getEmployee(), "", $wfStatus->getWfStatusName(), $wfLog->getWfRequestId());
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
        ini_set('memory_limit', '-1');
        $month = explode("|", $getmonth);
        if($case == "case1"){
            $expenses = \entities\ExpensesQuery::create()
                ->joinWithCurrencies()
                ->filterByExpenseStatus((int)$status)
                ->filterByTripCurrency((int)$curdata)
                ->filterByEmployee($this->app->Auth()->getUser()->getEmployee(), \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                ->filterByOrgunitId($units)
                ->find();
        
        }else{
            $expenses = \entities\ExpensesQuery::create()
                ->select(['EmployeeId'])
                ->joinWithCurrencies()
                ->filterByExpenseStatus((int)$status)
                ->filterByTripCurrency((int)$curdata)
                ->filterByEmployee($this->app->Auth()->getUser()->getEmployee(), \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                ->filterByOrgunitId($units)
                ->groupByEmployeeId()
                ->find();
        }
        return $expenses;
    }

    public function auditV2(){

        $action = $this->app->Request()->getParameter("action","");
        $units = \Modules\HR\Runtime\HrHelper::getAllowedUnits($this->app->Auth()->getUser()->getEmployee());

        switch ($action) :
            case "":
                $this->data['monthList'] = FormMgr::select()
                    ->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths($this->getConfig("HR", "allowedMonths")))
                    ->html();
                $this->app->Renderer()->render("hr/auditscreenv2.twig",$this->data);
            break;
            case "filters":
                $month = explode("|",$this->app->Request()->getParameter("month","|"));
                $expenses = \entities\ExpensesQuery::create()                                                            
                                ->filterByExpenseStatus(5)                                        
                                ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                                ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                                ->filterByOrgunitId($units)
                                ->orderByExpenseDate(\Propel\Runtime\ActiveQuery\Criteria::ASC)
                                ->find();
            break;
            case "load":
                $status = $this->app->Request()->getParameter("status");
                $month = explode("|",$this->app->Request()->getParameter("month","|"));                 
                $employee = $this->app->Request()->getParameter("employee",""); 
                
                $expenses = \entities\ExpensesQuery::create()
                        ->filterByExpenseStatus($status) //3,5 change to 6
                        ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                        ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)                    
                        ->filterByEmployeeId($employee)
                        ->orderByExpenseDate(\Propel\Runtime\ActiveQuery\Criteria::ASC)
                        ->find();

                $expid = \entities\ExpensesQuery::create()
                    ->select(['ExpId'])
                    ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->filterByEmployeeId($employee)
                    ->find()->toArray();

                $LastSubmittedDate = \entities\WfLogQuery::create()
                    ->select('LastSubmittedDate')
                    ->filterByWfDocId(1)
                    ->filterBywfDocPk($expid)
                    ->filterByWfStatusId(2)
                    ->addAsColumn('LastSubmittedDate', 'MAX(created_at)')
                    ->findOne();

                $LastApprovedDate = \entities\WfLogQuery::create()
                    ->select('LastApprovedDate')
                    ->filterByWfDocId(1)
                    ->filterBywfDocPk($expid)
                    ->filterByWfStatusId(3)
                    ->addAsColumn('LastApprovedDate', 'MIN(created_at)')
                    ->findOne();

                $LastAuditedDate = \entities\WfLogQuery::create()
                    ->select('LastAuditedDate')
                    ->filterByWfDocId(1)
                    ->filterBywfDocPk($expid)
                    ->filterByWfStatusId(10)
                    ->addAsColumn('LastAuditedDate', 'MAX(created_at)')
                    ->findOne();

                $this->data['LastSubmittedDate'] = $LastSubmittedDate;
                $this->data['LastApprovedDate'] = $LastApprovedDate;
                $this->data['LastAuditedDate'] = $LastAuditedDate;

                if($expenses){
                    
                }

                $this->app->Renderer()->render("hr/auditscreenv2.twig",$this->data);
            break;
            case "process":
            break;
            case "validate":
            break;
        endswitch;

    }

    public function audit()
    {
        ini_set('memory_limit', '-1');
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
                    $expid = \entities\ExpensesQuery::create()
                        ->select(['ExpId'])
                        ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                        ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                        ->filterByEmployeeId($employee)
                        ->find()->toArray();

                    $LastSubmittedDate = \entities\WfLogQuery::create()
                        ->select('LastSubmittedDate')
                        ->filterByWfDocId(1)
                        ->filterBywfDocPk($expid)
                        ->filterByWfStatusId(2)
                        ->addAsColumn('LastSubmittedDate', 'MAX(created_at)')
                        ->findOne();

                    $LastApprovedDate = \entities\WfLogQuery::create()
                        ->select('LastApprovedDate')
                        ->filterByWfDocId(1)
                        ->filterBywfDocPk($expid)
                        ->filterByWfStatusId(3)
                        ->addAsColumn('LastApprovedDate', 'MIN(created_at)')
                        ->findOne();

                    $LastAuditedDate = \entities\WfLogQuery::create()
                        ->select('LastAuditedDate')
                        ->filterByWfDocId(1)
                        ->filterBywfDocPk($expid)
                        ->filterByWfStatusId(10)
                        ->addAsColumn('LastAuditedDate', 'MAX(created_at)')
                        ->findOne();

                        $this->data['LastSubmittedDate'] = $LastSubmittedDate;
                        $this->data['LastApprovedDate'] = $LastApprovedDate;
                        $this->data['LastAuditedDate'] = $LastAuditedDate;
                
                $heads = [];
                $heads_total = [];
                $sortOrders = [];
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
                $noofHQ = 0;
                $noofExHQ = 0;
                $noofOS = 0;
                $noofLOS = 0;
                //$carCount = \entities\EmployeeQuery::create()->findPk($employee)->getDesignations()->getCarcount();
                $carCount = 0;
                $expenseDate = \Modules\ESS\Runtime\EssHelper::getFreeMonthDates($month,$employee);
                $monthWeekOffDates = \Modules\ESS\Runtime\EssHelper::getMonthWeekOffs($month);
                $leaveDates = \Modules\ESS\Runtime\EssHelper::getMonthLeaves($month,$employee);
                
                if($expenses){
                    foreach($expenses as $key=>$e)
                    {
                        switch ($e->getTripType()) {
                            case 'HQ':
                                $noofHQ++;
                                break;
                            case 'EX-HQ':
                                $noofExHQ++;
                                break;
                            case 'OS':
                                $noofOS++;
                                break;
                            case 'LOS':
                                $noofLOS++;
                                break;
                      }

                        if(array_key_exists($e->getExpenseDate()->format("Y-m-d"),$expenseDate)){
                            $list = $e->getExpenseLists();
                            $expListNote = array();
                            $expAuditorNote = array();
                            $expListRemark = array();

                            $positionId = $e->getEmployee()->getPositionId();
                            
                            $dailyCalls = \entities\DailycallsQuery::create()
                                                ->filterByDcrDate($e->getExpenseDate())
                                                ->filterByEmployeeId($e->getEmployeeId())
                                                ->find()->toArray();

                            $dayTypeArray = array();
                            $fw = 0;
                            $nca = 0;
                            foreach($dailyCalls as $dailyCall){
                                array_push($dayTypeArray,$dailyCall['Agendacontroltype']);
                                if($dailyCall['Agendacontroltype'] == 'FW'){
                                    $fw += 1;
                                }
                                if($dailyCall['Agendacontroltype'] == 'NCA'){
                                    $nca += 0.5;
                                }
                            }

                            $dayTypeArrayImp = implode(',',array_unique($dayTypeArray));

                            $callCount = count($dailyCalls);

                            $attendance = \entities\AttendanceQuery::create()
                                                ->filterByExpenseId($e->getExpId())
                                                ->findOne();
                            $media = [];
                           if(count($list) > 0)
                           { 
                                foreach($list as $l)
                                {
                                    if(!isset($heads[$l->getExpMasterId()]))
                                    {
                                        $heads[$l->getExpMasterId()] = $l->getExpenseMaster()->getExpenseName();
                                        $heads_total[$l->getExpMasterId()] = 0;
                                    }
                                    $heads_total[$l->getExpMasterId()] += $l->getExpFinalAmount();
                                    $sortOrders[$l->getExpMasterId()] = $l->getExpenseMaster()->getSortOrder();
                                    
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

                                    if($l->getExpRemark() != null){
                                        array_push($expListRemark,$l->getExpRemark());
                                    }

                                    if($l->getExpAuditRemark() != null){
                                        array_push($expAuditorNote,$l->getExpAuditRemark());
                                    }

                                    $listDetauils = \entities\ExpenseListDetailsQuery::create()
                                                        ->select(['Image'])
                                                        ->filterByExpListId($l->getExpListId())
                                                        ->find()
                                                        ->toArray();

                                    // $images = \entities\MediaFilesQuery::create()
                                    //                 ->select(['MediaData'])
                                    //                 ->filterByMediaId($listDetauils)
                                    //                 ->find()
                                    //                 ->toArray();
                                    // array_push($media,$images);

                                    $tempImgs = [];
                                    foreach($listDetauils as $fileId) {
                                        //$tempImgs[] = $this->app->Router()->baseUrl() . "media?id=".$fileId;
                                        $image1 = \entities\MediaFilesQuery::create()->filterByIss3file(true)->findPk($fileId);
                                        $tempImgs[] = $_ENV['STACKHERO_MINIO_HOST'] . '/' . $_ENV['STACKHERO_MINIO_AWS_BUCKET'] . '/' . rawurlencode($image1->getMediaData());
                                        
                                    }

                                    if (count($tempImgs)) {
                                        array_push($media,$tempImgs);
                                    }
                                }
                           }
                           else{
                                $km[$e->getPrimaryKey()]='0';
                                $kmMode[$e->getPrimaryKey()]='';
                                $kmModeLimit[$e->getPrimaryKey()]='';   
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
                               $downloadMedi = [];
                            if(count($media) > 0){
                                foreach($media as $medi){
                                    foreach($medi as $med){
                                        array_push($downloadMedi,$med);
                                    }
                                }
                            }
                            $holiday = false;
                            $holi = \entities\HolidaysQuery::create()
                                        ->filterByHolidayDate($e->getExpenseDate()->format("Y-m-d"))
                                        ->filterByIstateid($e->getEmployee()->getBranch()->getIstateid())
                                        ->findOne();
                            if($holi != null && $holi != ''){
                                $holiday = true;
                            }

                            $weekOff = false;
                            if(in_array ($e->getExpenseDate()->format("Y-m-d"),$monthWeekOffDates)){
                                $weekOff = true;
                            }

                            $leave = false;
                            if(in_array ($e->getExpenseDate()->format("Y-m-d"),$leaveDates)){
                                $leave = true;
                            }
                       
                            $expenseDate[$e->getExpenseDate()->format("Y-m-d")] = [
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
                                'NCA' => $nca,
                                'ExpListNote' => $expListNote,
                                'ExpAuditorNote' => $expAuditorNote,
                                'ExpRemark' => $expListRemark,
                                'DoVerify' => $e->getDoVerify(),
                                "image" => $media,
                                "DownloadImage" => strval(implode(',',$downloadMedi)),
                                "AttendanceId" => $attendance->getAttendanceId(),
                                "EmployeeId" => $e->getEmployeeId(),
                                "Holiday" => $holiday,
                                "WeekOff" => $weekOff,
                                "Leave" => $leave,
                                "Employee" => $e->getEmployee()->getFirstName()." ".$e->getEmployee()->getLastName()." | ".$e->getEmployee()->getEmployeeCode(),
                            ];
                            
                            //array_push($rows, $r);
                            $totalkm += $km[$e->getPrimaryKey()];
                            $requested += $e->getExpenseReqAmt();
                            $approved += $e->getExpenseApprovedAmt();
                            $final += $e->getExpenseFinalAmt(); 
                            $Additional += $e->getExpenseAdditionalAmt();

                            if($e->getEmployee() != null && $e->getEmployee()->getGeoTowns() != null && $e->getEmployee()->getGeoTowns()->getStownname() != null && $e->getEmployee()->getGeoTowns()->getStownname() != ''){
                                $hqTownName = $e->getEmployee()->getGeoTowns()->getStownname();
                            }else{
                                $hqTownName = ' - ';
                            }

                            $this->data['title'] = $e->getEmployee()->getFirstName()." ".$e->getEmployee()->getLastName()." | ".$e->getEmployee()->getEmployeeCode()." | ".$hqTownName." | ".$e->getEmployee()->getDesignations()->getDesignation();
                        }
                        
                    } 
                
                }
                
                ksort($expenseDate);
                //sort($heads);
                //sort($heads_total);




                uasort($sortOrders, function ($a, $b) {
                    if ($a === null && $b === null) {
                        return 0;
                    }
                    if ($a === null) {
                        return 1;
                    }
                    if ($b === null) {
                        return -1;
                    }
                    return $a <=> $b;
                });



                $sortedHeads = [];
                $sortedHeadsValue = [];
                foreach ($sortOrders as $key => $value) {
                    if (isset($heads[$key])) {
                        $sortedHeads[$key] = $heads[$key];
                    }
                    if (isset($heads_total[$key])){
                        $sortedHeadsValue[$key] = $heads_total[$key];
                    }
                }



// Create a new sorte);exit;
                
                //var_dump($expenseDate);exit;
                $this->data['ExpenseReqAmt'] = $requested;
                $this->data['ExpenseApprovedAmt'] = $approved;
                $this->data['ExpenseFinalAmt'] = $final;                
                $this->data['employee'] = $employee;
                $this->data['heads'] = $sortedHeads;
                $this->data['rows'] = $expenseDate;
                $this->data['totalkm'] = $totalkm;
                $this->data['Additional'] = $Additional;
                $this->data['headcount'] = round(14 + count($heads));
                $this->data['headcountSecond'] = round((14 + count($heads))/3);
                $this->data['headTotals'] = $sortedHeadsValue;
                $this->data['noofHQ'] = $noofHQ;
                $this->data['noofExHQ'] = $noofExHQ;
                $this->data['noofOS'] = $noofOS;
                $this->data['noofLOS'] = $noofLOS;
                
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
                        $wf->createLog($this->WfDoc, $e, $this->app->Auth()->getUser()->getEmployee(), "", $e->getExpenseNote(), 0);
                        
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
            $amount = 0;
            
            $employee = $this->app->Auth()->getUser()->getEmployee();
            
            $remark = strlen($_POST['ExpAuditRemark']) - substr_count($_POST['ExpAuditRemark'], ' ');
            if ($remark <= 2) {
                $this->app->Session()->setFlash("error", "The note must be at least 2 or more characters long.");
                $f->val($_POST);
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("hr/auditorFrom.twig", $this->data);
                return;
            }

            $expEmployee = $entity->getExpenses()->getEmployee();
            $expEmployeeGradePolicy = $expEmployee->getGradeMaster()->getGradePolicies()->toArray();
            $empPolicyId = $expEmployeeGradePolicy[0]["PolicyId"];
            $expPolicyKey = $entity->getExpPolicyKey();

            if($empPolicyId != null && $expPolicyKey != null){
                $policyRow = \entities\PolicyRowsQuery::create()
                                    ->filterByPolicyId($empPolicyId)
                                    ->filterByPolicykey($expPolicyKey)
                                    ->findOne();
                if ($_POST['ExpAuditAmount'] > $policyRow->getLimit2()) {
                    $this->app->Session()->setFlash("error", "You have reached your maximum limit.");
                    $f->val($_POST);
                    $this->data['form'] = $f->html();
                    $this->app->Renderer()->render("hr/auditorFrom.twig", $this->data);
                    return;
                }
            }

            $result = \Modules\ESS\Runtime\EssHelper::editApprovel($_POST,$expListId,"changeExp",$employee);
            

            $startDate = $entity->getExpDate()->format('Y-m-01');
            $endDate = $entity->getExpDate()->format('Y-m-t');
            
            $expList = \entities\ExpenseListQuery::create()
                            ->select(['FinalAmount'])
                            ->withColumn('SUM(exp_final_amount)', 'FinalAmount')
                            ->filterByExpMasterId($entity->getExpMasterId())
                            ->filterByEmployeeId($expEmployee->getEmployeeId())
                            ->filterByExpDate($startDate,Criteria::GREATER_EQUAL)
                            ->filterByExpDate($endDate,Criteria::LESS_EQUAL)
                            ->find()->toArray();

            $expRemarks = \entities\ExpenseListQuery::create()
                            ->select(['ExpAuditRemark','ExpenseMaster.ExpenseName'])
                            ->joinWithExpenseMaster()
                            ->filterByExpId($entity->getExpId())
                            ->find()->toArray();
            $resultRe = [];
            foreach($expRemarks as $expRemark){
                if($expRemark["ExpAuditRemark"] != null || $expRemark["ExpAuditRemark"] != ''){
                    $data = $expRemark["ExpenseMaster.ExpenseName"].' - '.$expRemark["ExpAuditRemark"];
                    array_push($resultRe,$data);
                }
            }
            $resRemImp = implode(',',$resultRe);
            
            $expId = $entity->getExpId().''.$id;
            $expMasterId = $entity->getExpMasterId();
            $amount = $_POST['ExpAuditAmount'];
            $headAmount = $expList[0];
            $expenseId = $entity->getExpId();
            $remark = $_POST['ExpAuditRemark'];
            
            $amt = $this->reCalculateExp($entity->getExpId());
            $expenseId = $amt->getExpId();
            $reqAmount = $amt->getExpenseReqAmt();
            $aprAmount = $amt->getExpenseApprovedAmt();
            $finAmount = $amt->getExpenseFinalAmt();
            $expFinalAmount = \entities\ExpensesQuery::create()
                            ->select(['ExpFinalAmount'])
                            ->withColumn('SUM(expense_final_amt)', 'ExpFinalAmount')
                            ->filterByEmployeeId($expEmployee->getEmployeeId())
                            ->filterByExpenseDate($startDate,Criteria::GREATER_EQUAL)
                            ->filterByExpenseDate($endDate,Criteria::LESS_EQUAL)
                            ->find()->toArray();
            $expFinAmt = $expFinalAmount[0];

            //$this->closeModalWithToast("Changes has been saved.");
            $this->closeModalWithToast("Changes has been saved.", "reloadAuditGrid($expId,$amount,$expMasterId,$headAmount,$expenseId,$reqAmount,$aprAmount,$finAmount,$expFinAmt,"."'$resRemImp'".")");
            //$this->closeModalWithToast("Details Updated Successful.", "quickExpView($expense_list_id)");
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

    public function expRemarkLog($id){

        $wfLogs = \entities\WfLogQuery::create()
                        ->joinWithEmployee()
                        ->filterByWfDocPk($id)
                        ->orderByWfLogId('ASC')
                        ->find()->toArray();
        $exp = \entities\ExpensesQuery::create()
                    ->filterByExpId($id)
                    ->findOne();
                        
        $this->data['expLogs'] = $wfLogs;
        $this->data['form_name'] = $exp->getExpenseDate()->format('d-m-Y');
        
        $this->app->Renderer()->render("hr/expLogs.twig",$this->data);

    }

    public function reCalculateExp($expId)
    {
        $exps = \entities\Base\ExpenseListQuery::create()
            ->filterByExpId($expId)
            ->find();
        $total = 0;
        $req = 0;
        $approved = 0;
        $tax = 0;
        foreach ($exps as $e) {
            $total = $total + $e->getExpFinalAmount();
            $approved = $approved + $e->getExpAprAmount();
            $req = $req + $e->getExpIlAmount() + $e->getExpTaxAmount() + $e->getExpReqAmount();
            $tax = $tax + $e->getExpTaxAmount();
        }
        $entity = \entities\ExpensesQuery::create()
            ->findPk($expId);
        $entity->setExpenseApprovedAmt($approved);
        $entity->setExpenseFinalAmt($total);
        $entity->setExpenseReqAmt($req);
        $entity->setExpenseTaxAmt($tax);
        $entity->save();

        return $entity;
    }
    
}
    
