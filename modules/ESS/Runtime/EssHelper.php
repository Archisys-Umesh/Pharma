<?php declare(strict_types = 1);

namespace Modules\ESS\Runtime;

use App\Utils\FormMgr;
use DateTime;
use Modules\System\Runtime\PolicyRequest;
use Modules\System\Processes\WorkflowManager;
use App\System\App;
use Modules\ESS\Exceptions\InvalidArgumentException;
use Propel\Runtime\ActiveQuery\Criteria;

class EssHelper
{
    protected $app;
        
    public  function __construct(App $app)
    {
        $this->app = $app;
            
    }
    
    static function getMonths($allowedMonths)
    {        
        $monthList = [];
        for($i = 0;$i < $allowedMonths; $i++ )
        {
            $time = strtotime(date( 'Y-m-01' )."-$i month");
            $month_start = date('Y-M',$time);
            
            $monthList[$month_start] = date('M-Y', $time);  
        }
        
        return $monthList;
    }
    
    static function getAllowedMonths($allowedMonths)
    {        
        $monthList = [];
        for($i = 0;$i < $allowedMonths; $i++ )
        {
            $time = strtotime(date( 'Y-m-01' )."-$i month");
            $month_start = date('Y-m-01',$time);
            $month_end = date('Y-m-t',$time);
            
            $monthList[$month_start."|".$month_end] = date('M-Y', $time);
        }
        
        return $monthList;
    }

    static function getUpcomingAndPreviousMonth($allowedMonths){
        $result = [];
        $currentYear = date('Y'); // Get the current year

// Loop through all 12 months
        for ($month = 1; $month <= 12; $month++) {
            $monthName = date('M', strtotime("$currentYear-$month-01")); // Get month name
            $formattedMonth = str_pad((string)$month, 2, '0', STR_PAD_LEFT); // Format month with 2 digits
            $formattedDate = ucfirst($monthName) . "-$currentYear"; // Format month-year
            $result["$currentYear-$formattedMonth-01|$currentYear-$formattedMonth-31"] = $formattedDate;
        }

        return $result;
    }
    
    static function getRangeAllowedMonth($allowedMonths)
    {
        $month_end = "";
        $month_start = "";
        for($i = 0;$i < $allowedMonths; $i++ )
        {
            $time = strtotime("-$i month");
            $month_start = date('Y-m-01',$time);
            
            if($month_end == "") {
                $month_end = date('Y-m-t',$time);
            }                        
        }
        
        return [$month_start,$month_end];
    }
    static function getRangeTime()
    {
        $timeList = [];
        for($hours=0; $hours<24; $hours++){
            
            $flag = "am";
            if($hours == 12) {
                
                $flag = "pm";
                $timeList[($hours). ":00 ".$flag] = ($hours). ":00 ".$flag;
                $timeList[($hours). ":15 ".$flag] = ($hours). ":15 ".$flag;
                $timeList[($hours). ":30 ".$flag] = ($hours). ":30 ".$flag;
                $timeList[($hours). ":45 ".$flag] = ($hours). ":45 ".$flag;
            }
            elseif($hours > 11) {
                $flag = "pm";
                $timeList[($hours-12). ":00 ".$flag] = ($hours-12). ":00 ".$flag;
                $timeList[($hours-12). ":15 ".$flag] = ($hours-12). ":15 ".$flag;
                $timeList[($hours-12). ":30 ".$flag] = ($hours-12). ":30 ".$flag;
                $timeList[($hours-12). ":45 ".$flag] = ($hours-12). ":45 ".$flag;
            
            }
            else 
            {
                if($hours == 0)
                {
                    $timeList[($hours). ":00 ".$flag] = ("12"). ":00 ".$flag;
                    $timeList[($hours). ":15 ".$flag] = ("12"). ":15 ".$flag;
                    $timeList[($hours). ":30 ".$flag] = ("12"). ":30 ".$flag;
                    $timeList[($hours). ":45 ".$flag] = ("12"). ":45 ".$flag;
                }else{
                $timeList[($hours). ":00 ".$flag] = ($hours). ":00 ".$flag;
                $timeList[($hours). ":15 ".$flag] = ($hours). ":15 ".$flag;
                $timeList[($hours). ":30 ".$flag] = ($hours). ":30 ".$flag;
                $timeList[($hours). ":45 ".$flag] = ($hours). ":45 ".$flag;
                }
            }
            
        } 
        
        return $timeList;
    }
    static function reCalculate($expId)
    {
        $exps = \entities\Base\ExpenseListQuery::create()
            ->filterByExpId($expId)
            ->find();
        $total = 0;
        $req = 0;
        $approved = 0;
        $tax = 0;
        $claime = 0;
        foreach($exps as $e)
        {
            $total = $total + $e->getExpFinalAmount();
            $approved = $approved + $e->getExpAprAmount();
            $req = $req + $e->getExpIlAmount() + $e->getExpTaxAmount() + $e->getExpReqAmount();
            $tax = $tax + $e->getExpTaxAmount();
            $claime = $claime + $e->getExpClaimedTax();
        }
        
        $entity = \entities\ExpensesQuery::create()
                ->findPk($expId);
        $entity->setExpenseApprovedAmt($approved);
        $entity->setExpenseFinalAmt($total);
        $entity->setExpenseReqAmt($req);        
        $entity->setExpenseTaxAmt($tax);
        $entity->save();
    }
    static function gstToClaimedTax($expId)
    {
        $exps = \entities\Base\ExpenseListQuery::create()
            ->filterByExpId($expId)
            ->find();
        if($exps){
            foreach($exps as $e){            
                $gst = $e->getExpTaxAmount();
                $e->setExpClaimedTax($gst);
                $e->save();
            }
        }
    }
    
    static function getExpenses($status,$employee,$month,$pendingAction = "")
    {
        $bc = new \App\Core\BaseController();
        $ClaimAmount = $bc->getConfig("ESS", "ClaimAmount");
        
        if($status == "P") {
            $expenses = \entities\ExpensesQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->joinWithEmployee()
                ->joinWithBudgetGroup()                
                ->filterByEmployeeId($employee)
               ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                ->filterByPrimaryKeys($pendingAction)
                ->filterByExpenseReqAmt($ClaimAmount, \Propel\Runtime\ActiveQuery\Criteria::GREATER_THAN)
                ->orderByExpenseDate(Criteria::ASC)
                ->find()->toArray();
	    }
        else if($status == "PA") {
            $expenses = \entities\ExpensesQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->joinWithEmployee()
                ->joinWithBudgetGroup()
                ->filterByEmployeeId($employee)
                ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                ->filterByExpenseStatus(2)
                ->filterByExpenseReqAmt($ClaimAmount, \Propel\Runtime\ActiveQuery\Criteria::GREATER_THAN)
                ->orderByExpenseDate(Criteria::ASC)
                ->find()->toArray();
		}
        else if($status == "A") {                
            $expenses = \entities\ExpensesQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->joinWithEmployee()
                ->joinWithBudgetGroup()
                ->filterByEmployeeId($employee)                                        
                ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                ->filterByExpenseReqAmt($ClaimAmount, \Propel\Runtime\ActiveQuery\Criteria::GREATER_THAN)
                ->orderByExpenseDate(Criteria::ASC)
                ->find()->toArray();
        }
        else if($status == null && $status == '') {                
            $expenses = \entities\ExpensesQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->joinWithEmployee()
                ->joinWithBudgetGroup()
                ->filterByEmployeeId($employee)                                        
                ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                ->filterByExpenseReqAmt($ClaimAmount, \Propel\Runtime\ActiveQuery\Criteria::GREATER_THAN)
                ->orderByExpenseDate(Criteria::ASC)
                ->find()->toArray();
        }
        else 
        {   
            $expenses = \entities\ExpensesQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->joinWithEmployee()
                ->joinWithBudgetGroup()                    
                ->filterByEmployeeId($employee)                    
                ->filterByExpenseStatus($status)
                ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                ->filterByExpenseReqAmt($ClaimAmount, \Propel\Runtime\ActiveQuery\Criteria::GREATER_THAN)
                ->orderByExpenseDate(Criteria::ASC)
                ->find()->toArray();
        }
        return $expenses;
    }
			   
    static function getAllExpenses($status,$OrgUnitId,$month,$pendingAction = "") 
    {  
        $expenses = \entities\ExpensesQuery::create('E')
        ->select(['ExpenseReqAmt','ExpenseApprovedAmt','ExpenseFinalAmt','ExpenseStatus','EmployeeId','FirstName','LastName','EmployeeCode','Designation','TownName','OrgUnitId','Remark'])
        ->withColumn('sum(E.ExpenseReqAmt)', 'ExpenseReqAmt')
        ->withColumn('sum(E.ExpenseApprovedAmt)', 'ExpenseApprovedAmt')
        ->withColumn('sum(E.ExpenseFinalAmt)', 'ExpenseFinalAmt')
        ->join('E.Employee')
        ->join('Employee.Designations')
        ->join('Employee.GeoTowns')
        ->withColumn('Employee.EmployeeId', 'EmployeeId')
        ->withColumn('Employee.FirstName', 'FirstName')
        ->withColumn('Employee.LastName', 'LastName')
        ->withColumn('Employee.EmployeeCode', 'EmployeeCode')
        ->withColumn('Employee.Remark', 'Remark')
        ->withColumn('Designations.Designation', 'Designation')
        ->withColumn('GeoTowns.Stownname', 'TownName')
        ->withColumn('Employee.OrgUnitId', 'OrgUnitId')
        ->withColumn('Employee.Status', 'Status')
        ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
        ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
        ->groupByEmployeeId();
        
        if($status !='A' && $OrgUnitId > 0)
        {
           $expenses->filterByExpenseStatus($status);
           $expenses->filterByOrgunitId($OrgUnitId);
        }elseif( $status !='A' && $OrgUnitId == 0){
            $expenses->filterByExpenseStatus($status);
        }
        elseif( $status =='A' && $OrgUnitId > 0)
        {
           $expenses->filterByOrgunitId($OrgUnitId);
        }
        else{
          
        }
        $results =   $expenses->find()->toArray();
        return $results;
    }    
    static function getExpensesmonthwise($status,$employee,$months,$pendingAction = "") {
        $data = [];
        foreach ($months as $key=>$m){
            $month = explode("|", $key);
            
            if($status == "P") {

                    $expenses = \entities\ExpensesQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->joinWithEmployee()
                    ->joinWithBudgetGroup()
                    ->filterByEmployeeId($employee)
                    ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->filterByPrimaryKeys($pendingAction)
                    ->filterByExpenseReqAmt(0, \Propel\Runtime\ActiveQuery\Criteria::GREATER_THAN)
                    ->orderByExpenseDate(Criteria::ASC)
                    ->find()->toArray();

            }
            else if($status == "A") {                
                $expenses = \entities\ExpensesQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->joinWithEmployee()
                ->joinWithBudgetGroup()
                ->filterByEmployeeId($employee)                                        
                ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                ->filterByExpenseReqAmt(0, \Propel\Runtime\ActiveQuery\Criteria::GREATER_THAN)
                ->orderByExpenseDate(Criteria::ASC)
                ->find()->toArray();
            }
            else 
            {
                $expenses = \entities\ExpensesQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->joinWithEmployee()
                ->joinWithBudgetGroup()                    
                ->filterByEmployeeId($employee)                    
                ->filterByExpenseStatus($status)
                ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                ->filterByExpenseReqAmt(0, \Propel\Runtime\ActiveQuery\Criteria::GREATER_THAN)
                ->orderByExpenseDate(Criteria::ASC)
                ->find()->toArray();

            }
            array_push($data, array("Month"=>array("MonthName"=>$m,"Monthid"=>$key),"Employee"=>$expenses));
        }
        return $data;
    }
    
    static function getExpensesLazyLoad($status,$employee,$month,$pendingAction = "",$pageNo = 0,$perPage = 0) {
      
            if($status == "P") {

                    $expenses = \entities\ExpensesQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->joinWithEmployee()
                    ->joinWithBudgetGroup()
                    ->filterByEmployeeId($employee)
                    ->filterByExpenseDate($month['SMstartDate'], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByExpenseDate($month['EMendDate'], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->filterByPrimaryKeys($pendingAction)
                    //->filterByExpenseReqAmt(0, \Propel\Runtime\ActiveQuery\Criteria::GREATER_THAN)
                    ->orderByExpenseDate(Criteria::ASC)                    
                    ->setOffset($pageNo)
                    ->setLimit($perPage)
                    ->find()->toArray();

            }
            else if($status == "A") {      
                
                $expenses = \entities\ExpensesQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->joinWithEmployee()
                ->joinWithBudgetGroup()
                ->filterByEmployeeId($employee)                                        
                ->filterByExpenseDate($month['SMstartDate'], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                ->filterByExpenseDate($month['EMendDate'], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                //->filterByExpenseReqAmt(0, \Propel\Runtime\ActiveQuery\Criteria::GREATER_THAN)
                ->orderByExpenseDate(Criteria::ASC)
                ->setOffset($pageNo)
                ->setLimit($perPage)
                ->find()->toArray();
            }
            else 
            {
                
                $expenses = \entities\ExpensesQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->joinWithEmployee()
                ->joinWithBudgetGroup() 
                ->filterByEmployeeId($employee)                    
                ->filterByExpenseStatus($status)
                ->filterByExpenseDate($month['SMstartDate'], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                ->filterByExpenseDate($month['EMendDate'], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                //->filterByExpenseReqAmt(0, \Propel\Runtime\ActiveQuery\Criteria::GREATER_THAN)
                ->orderByExpenseDate(Criteria::ASC)
                ->setOffset($pageNo)
                ->setLimit($perPage)
                ->find()->toArray();
                
            }
            
        return $expenses;
    }
    
    static function addExpenses($pk,$postdata, $expTripType, \entities\Employee $employee,$OrgUnitId,$status) {
        
        $entity = new \entities\Expenses();
        if($pk > 0)
        {
            $entity = \entities\ExpensesQuery::create()->findPk($pk);
            $entity->toArray();
            //$f->val($entity->toArray());
        }                
        
        
        switch ($status):
            case "case1":
                if($pk == 0)
                { 
                    $hasClaim = \entities\ExpensesQuery::create()
                            ->filterByExpenseDate($postdata['ExpenseDate'])
                            ->filterByBudgetId($postdata['BudgetId'])
                            ->filterByEmployee($employee)
                            ->findOne();
                    return $hasClaim;
                }
            break;    
            case "case2":
                $heads = self::getExpenseList(\entities\BudgetExpQuery::create()->findByBgid($postdata['BudgetId']),$expTripType,true,$postdata['ExpenseDate'],$employee->getEmployeeId());                
                return $heads;
            break;
            case "case3":
                $entity->fromArray($_POST);                                                       
                $entity->setEmployee($employee);            
                $entity->setExpenseStatus(1);
                $entity->setExpenseReqAmt(0);
                $entity->setExpenseApprovedAmt(0);
                $entity->setOrgunitId($OrgUnitId);
                $entity->setCompanyId($employee->getCompanyId());                
                $entity->setExpenseNote(" ");                
                $entity->setTripType($expTripType);                
                $entity->save();
                return $entity->getPrimaryKey();
            break;
            
        endswitch;
        
    }
    static function addExpensesList($pk,$heads,$postdata,$policyEngine,$Branchlocation){
        
        $entity = \entities\ExpensesQuery::create()->findPk($pk);
        
        foreach($heads as $h)
            {
                
                $expenseRow = new \entities\ExpenseList();
                if($h->getIsPrefilled() == 1){
                    $pr = $policyEngine->process(new PolicyRequest(self::findPolicyKey($h->getPrimaryKey(),$entity,$entity->getEmployeeId(),$Branchlocation),1));
                    $ExpIlAmount = $pr->getLimit1();
                    $expenseRow->setExpIlAmount($ExpIlAmount);
                    $expenseRow->setExpFinalAmount($ExpIlAmount);
                    $expenseRow->setIsReadonly($pr->getIsReadonly());
                    $expenseRow->setExpPolicyKey($pr->getPolicyKey());    
                }else{
                    $pr = $policyEngine->process(new PolicyRequest(self::findPolicyKey($h->getPrimaryKey(),$entity,$entity->getEmployeeId(),$Branchlocation),1));
                    $expenseRow->setExpFinalAmount(0);
                    $expenseRow->setExpIlAmount(0);
                    $expenseRow->setExpPolicyKey($pr->getPolicyKey());
                }
                $expenseRow->setExpMasterId($h->getPrimaryKey());
                $expenseRow->setExpReqAmount(0);
                $expenseRow->setExpAprAmount(0);
                $expenseRow->setExpId($entity->getPrimaryKey());
                $expenseRow->setExpLimit1(0);
                //$expenseRow->setExpPolicyKey("");
                $expenseRow->setEmployeeId($entity->getEmployeeId());
                $expenseRow->setExpDate($entity->getExpenseDate());
                $expenseRow->setCompanyId($entity->getCompanyId());
                if(isset($postdata['ReadOnly'])){
                    $expenseRow->setIsReadonly(TRUE);
                }
                $expenseRow->save();
            }
            
        self::reCalculate($pk);
        self::repelExpenses($postdata['ExpenseDate'], $entity->getEmployee());
    }

    //common
    static function getExpenseList($budget,$expType,$onlyDaily = true,$date = null,$employeeId = 0)
    {
        $exps = [];        
        $s = strtotime($date);
        $start = date('Y-m-01',$s);
        $end = date('Y-m-t',$s);
        
        /*$exp_ids = \entities\ExpenseListQuery::create()
                ->select(["ExpMasterId","ExpDate"])
                ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())
                ->filterByExpDate($start, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                ->filterByExpDate($end, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                ->find()->toKeyValue("ExpMasterId","ExpDate");
        */
        $Todaysexps = \entities\ExpenseListQuery::create()               
               ->filterByExpDate($date)
               ->filterByEmployeeId($employeeId)               
               ->find()->toKeyIndex("ExpMasterId");               
        
        foreach($budget as $b)
        {
            $head = $b->getExpenseMaster();            
            $showExp = false;                        
            
            if($head->getTrips() == 0){$showExp = true;} // Any 
            if($head->getTrips() == 1 && ($expType == "OS" || $expType == "EX-HQ") ){$showExp = true;} // Only Trip
            
            if($head->getTrips() == 2 && $expType == "HQ"){$showExp = true;} // Only HQ            
            if($head->getTrips() == 3 && $expType == "EX-HQ"){$showExp = true;} // Only Ex-HQ
            if($head->getTrips() == 4 && $expType == "OS"){$showExp = true;} // Only OS
            if($head->getTrips() == 5 && $expType == "LOS"){$showExp = true;} // Only LOS
            if($head->getTrips() == 6 && $expType == "In-Transit"){$showExp = true;} // Only In-Transit
             
            if($head->getPermonth() == 1) {
                // Expense Exists this month
                if(isset($exp_ids[$head->getPrimaryKey()]))
                {
                    $showExp = false;
                }
            }

            //if($onlyDaily) {
            //    if($head->getIsdaily() != 1) {$showExp = false;}
            //}
            
            if(isset($Todaysexps[$head->getPrimaryKey()])) // Already Claimed once
            {
                $showExp = false;
            }
            
            if($head->getIsMandatory() == null || $head->getIsMandatory() == 0){$showExp = false;} // Only Mandatory Expenses
            
             if($showExp)
             {
                 array_push($exps, $head);
             }
            //array_push($exps, $head);
        }
        
       
        return $exps;
    }
    
    static function parseFloat($string)
    {     
       $string = (string) $string;
       return floatval(preg_replace("/[^-0-9\.]/","",$string));   
    }
    
    static function updateHeadValue($id,$policyEngine,$expentry, $ilentry, $taxentry,$ExpRateQty,$ExpRemark,$ExpRateMode,$CmpCard,$remarks,$Branchlocation){
        
        $total = 0;
        $additional = 0;
        $exp = \entities\ExpensesQuery::create()->joinWithOrgUnit()->findPk($id);
        
        $employeeId = $exp->getEmployeeId();
        
        $returndata  = array();
        $doVerify = array();        
        foreach($ilentry as $e => $v)
        {
            $v = self::parseFloat($v);
            
            if($v >= 0) {
                $expenseRow = \entities\ExpenseListQuery::create()->filterByExpMasterId($e)->findByExpId($id)->getFirst();                    
                if(!$expenseRow) {
                    $expenseRow = new \entities\ExpenseList();
                }                                                 
                
                $emp = \entities\EmployeeQuery::create()->findPk($employeeId);
                // if($emp->getCompany()->getAutoCalculatedTa() != $e && $expenseRow->getExpenseMaster()->getIsMandatory() == 0){
                //     array_push($doVerify,$e);
                // }
                
                //$expentry[$e] = self::parseFloat($expentry[$e]);
                //$taxentry[$e] = self::parseFloat($taxentry[$e]);
               
                
                $pr = $policyEngine->process(new PolicyRequest(self::findPolicyKey($e,$exp,$employeeId,$Branchlocation),$v));

                if($pr->getValidated()) {
                    
                    $total = $total + $v; // + $expentry[$e] + $taxentry[$e];
                    //$additional = $additional + $expentry[$e];

                    //$sub_total = $v + $expentry[$e] + $taxentry[$e];  

                    $expenseRow->setExpMasterId($e);
                    $expenseRow->setExpIlAmount($v);
                    
                    //$expenseRow->setExpTaxAmount($taxentry[$e]);                    
                    //$expenseRow->setExpReqAmount($expentry[$e]);
                    $expenseRow->setExpAprAmount($v);
                    $expenseRow->setExpFinalAmount($v);
                    if(isset($ExpRateMode[$e]))
                    {
                        $expenseRow->setExpRateMode($ExpRateMode[$e]);
                    }
                    if(isset($ExpRateQty[$e])) {
                        
                        $ExpRateQty[$e] = self::parseFloat($ExpRateQty[$e]);
                        $expenseRow->setExpRateQty($ExpRateQty[$e]);
                        
                    }
                    if(isset($ExpRemark[$e])) {
                        $expenseRow->setExpRemark($ExpRemark[$e]);
                    }
                    $expenseRow->setExpId($id);
                    $expenseRow->setExpLimit1($pr->getLimit1());
                    $expenseRow->setExpPolicyKey($pr->getPolicyKey());
                    //$expenseRow->setIsReadonly($pr->getIsReadonly());
                    if(isset($CmpCard[$e])) {
                        $expenseRow->setCmpCard(1);
                    }else{
                        $expenseRow->setCmpCard(0);
                    }
                    $expenseRow->save();

                    if(isset($ExpRemark[$e])) {
                        WorkflowManager::createLog("Expenses", $exp, $emp, 0, $ExpRemark[$e], 0);
                    }
                    array_push($doVerify,$e);
                    array_push($returndata,["id" => $e, "status" => $pr->toArray()]);
                }else{
                    array_push($returndata,["id" => $e, "status" => $pr->toArray()]);
                    
                }

            }
        }
        if(count($doVerify) > 0){
            $exp->setDoVerify(true);    
        }
        $exp->setExpenseReqAmt($total);
        $exp->save();
        
        self::repelExpenses($exp->getExpenseDate(),$exp->getEmployee());
        return $returndata;
    }
    
    static function updateHeadValueNew($id,$policyEngine,$expentry, $ilentry, $taxentry,$ExpRateQty,$ExpRemark,$ExpRateMode,$CmpCard,$remarks,$Branchlocation){
        $total = 0;
        $additional = 0;
        $exp = \entities\ExpensesQuery::create()->joinWithOrgUnit()->findPk($id);
        $employeeId = $exp->getEmployeeId();
        $returndata  = array();     
        
        foreach($ilentry as $key => $v)
        {
            $ev = explode('|',$key);
            $e = $ev[0];
            $v = self::parseFloat($v);
            
            if($v >= 0) {
                
                $expenseRow = \entities\ExpenseListQuery::create()
                        ->filterByExpListId($ev[1])
                        ->filterByExpMasterId($e)
                        ->findByExpId($id)
                        ->getFirst();      
                if(!$expenseRow) { 
                    $expenseRow = new \entities\ExpenseList();
                }
                $pr = $policyEngine->process(new PolicyRequest(self::findPolicyKey($e,$exp,$employeeId,$Branchlocation),$v));
                
                if($pr->getValidated()) {
                    $total = $total + $v; // + $expentry[$e] + $taxentry[$e];
                    $expenseRow->setExpMasterId($e);
                    $expenseRow->setExpIlAmount($v);
                    $expenseRow->setExpAprAmount($v);
                    $expenseRow->setExpFinalAmount($v);
                    if(isset($ExpRateMode[$e]))
                    {
                        $expenseRow->setExpRateMode($ExpRateMode[$e]);
                    }
                    if(isset($ExpRateQty[$e])) {
                        $ExpRateQty[$e] = self::parseFloat($ExpRateQty[$e]);
                        $expenseRow->setExpRateQty($ExpRateQty[$e]);
                    }
                    if(isset($ExpRemark[$e])) {
                        $expenseRow->setExpRemark($remarks);
                    }
                    $expenseRow->setExpId($id);
                    if($pr->getLimit1() != null){
                        $expenseRow->setExpLimit1($pr->getLimit1());
                    }else{
                        $expenseRow->setExpLimit1(0);
                    }
                    
                    $expenseRow->setExpPolicyKey($pr->getPolicyKey());
                    if(isset($CmpCard[$e])) {
                        $expenseRow->setCmpCard(1);
                    }else{
                        $expenseRow->setCmpCard(0);
                    }
                    
                    $expenseRow->save();
                    array_push($returndata,["id" => $e, "status" => $pr->toArray()]);
                }else{
                    array_push($returndata,["id" => $e, "status" => $pr->toArray()]);
                    
                }

            }
        }
        $exp->setExpenseReqAmt($total);
        $exp->save();
        

        // Repell 
        //self::repelExpenses($exp->getExpenseDate(),$exp->getEmployee());
        return $returndata;
    }
    
//    static function forgotpassword($username,$status) {
//        
//        $user = \entities\UsersQuery::create()->findByUsername($username)->getFirst();
//        
//        if($user){            
//            $defaultConfig = $user->getCompany()->getConfigurations()->getFirst();
//            $companyId = $user->getCompany()->getCompanyId();
//            $name = $user->getName();            
//            
//            $text = "Password Reset Request Received for<br/> Username : $name ";
//            \App\Utils\Emails::sendEmail($defaultConfig->getAdminEmail(), "Password Reset Request : $name" , $text,$companyId);
//            return $defaultConfig->getAdminEmail();
//        }else{
//            return FALSE;
//        }
//    }
    
     static function forgotpassword($username,$status,$app) {
        
        $user = \entities\UsersQuery::create()->findByUsername($username)->getFirst();
        
        if($user){                        
            
            $event = new \Modules\System\Runtime\userEvents($app);
            $event->resetPasswordEvent($user);            
            
            $isDefaultUser = $user->getDefaultUser();
            
            if($isDefaultUser){
                $bc = new \App\Core\BaseController();
                $to = $bc->getConfig("System", "supportEmail");
            }else{
                $to = $user->getCompany()->getConfigurations()->getFirst()->getAdminEmail();     
            }
            
            return $to;
            
        }else{
            return FALSE;
        }
    }
    
    static function repelExpenses($date, \entities\Employee $emp)
    {
       $exps = \entities\ExpenseListQuery::create()               
               ->filterByExpDate($date)
               ->filterByEmployeeId($emp->getPrimaryKey())               
               ->find()->toKeyIndex("ExpMasterId");               
       
       $repellents = \entities\ExpenseRepellentQuery::create()->find();
       
       foreach($repellents as $r){
       
           if(isset($exps[$r->getExpenseId()]))
           {
               if(isset($exps[$r->getExpenseRepId()])) {
                   
                $exp_id = $exps[$r->getExpenseId()]->getExpId();
                
                self::delExpenses($exp_id, $exps[$r->getExpenseId()]->getExpListId());                
                //$exps[$r->getExpenseId()]->delete();                
                
                unset($exps[$r->getExpenseId()]);
                self::reCalculate($exp_id);    
                
               }
           }
       }
       
    }
    static function findPolicyKey($expId, \entities\Expenses $exp, $employeeId,$Branchlocation)
    {
        $expense = \entities\ExpenseMasterQuery::create()->findPk($expId);
        
        if(!$expense) // Expense master not found.
        {
            throw new \Exception("Expense not found with key $expId", 500);
        }
        if($expense->getCheckcity() == 1) {
            $employee = \entities\EmployeeQuery::create()
                            ->findPk($employeeId);

            $location = $Branchlocation;
            
            $loc = \entities\CitycategoryQuery::create()
                    ->filterByGradeId($employee->getGradeId())
                    ->findByItownid($location)->getFirst();            
            
            $ifScope = \entities\CitycategoryQuery::create()
                    ->filterByScope(1)
                    ->filterByIdentityKey($employeeId)
                    ->findByItownid($location)->getFirst();
            
            if($ifScope)
            {
                $loc = $ifScope;
            }
            if(!$loc)
            {
                return $expense->getDefaultPolicykey();
            }
            else if($loc->getCategory() == "A")
            {
                return $expense->getPolicykeya();
            }
            else if($loc->getCategory() == "B")
            {
                return $expense->getPolicykeyb();
            }
            else 
            {
                return $expense->getPolicykeyc();
            }
        }        
        else {        
            return $expense->getDefaultPolicykey();
        }
    }
    
    static function validateExp($expId,$value,$policyEngine,$exp,$Branchlocation,$employeeId) {
        $currentExp = \entities\Base\ExpenseMasterQuery::create()->findPk($expId);
        $isPermonth = $currentExp->getPermonth();
        $subTotal = 0;
        $employeeId = $exp->getEmployeeId();
        if($isPermonth == 1)
        {
            $start_date = $exp->getExpenseDate()->format("Y-m-01");
            $end_date = $exp->getExpenseDate()->format("Y-m-t");
            $allExps = \entities\ExpenseListQuery::create()
                    ->filterByExpMasterId($expId)
                    ->filterByExpDate($start_date, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByExpDate($end_date, \Propel\Runtime\ActiveQuery\Criteria::LESS_THAN)
                    ->filterByExpId($exp->getPrimaryKey(), \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                    ->filterByEmployeeId($employeeId)
                    ->find();                
            if($allExps)
            {
                foreach($allExps as $interExp)
                {
                    $subTotal = $subTotal + $interExp->getExpIlAmount();
                }
            }                
        }
        $pr = $policyEngine->process( new PolicyRequest(self::findPolicyKey($expId,$exp,$employeeId,$Branchlocation), $subTotal + $value), $isPermonth == 1 );            
        if(!$pr->getValidated() && $subTotal > 0)
        {
            $pr->setMessage($pr->getMessage(). " ,Current Submited : ".$subTotal);
        }
        return $pr;
    }
    static function editApprovel($post,$expId,$action,$employee){
        
            $entity = \entities\ExpenseListQuery::create()->findPk($expId);

            $backupVal = $entity->getExpFinalAmount();
            $backupTax = $entity->getExpTaxAmount();
            $entity->fromArray($post);    
            if($action == "auth") { 
                $entity->setExpFinalAmount($post['ExpAprAmount']); 
                
            }else {
                $entity->setExpFinalAmount($post['ExpAuditAmount']);
            }
            $entity->save();
            
            if($entity != null && $entity->getExpId() != null){
                $expenseLists = \entities\ExpenseListQuery::create()
                            ->filterByExpId($entity->getExpId())
                            ->find()->toArray();
                foreach($expenseLists as $expenseList){
                        $expenseLi = \entities\ExpenseListQuery::create()
                                        ->filterByExpListId($expenseList['ExpListId'])
                                        ->filterByExpAprAmount(NULL)
                                        ->_or()
                                        ->filterByExpAprAmount(0)
                                        ->findOne();
                        if($expenseLi != null){
                            $expenseLi->setExpAprAmount((float)$expenseList['ExpFinalAmount']);
                            $expenseLi->save();
                        }
                }
                $expense = \entities\ExpensesQuery::create()
                                ->filterByExpId($entity->getExpId())
                                ->findOne();
                $expense->setDoVerify(true);
                $expense->save();
            }
            
            self::reCalculate($entity->getExpId());
            
            if($backupTax != $entity->getExpTaxAmount()){
                $taxComment = "Tax has been Changed for ".$entity->getExpenseMaster()->getExpenseName().": From ".$backupVal. " To ".$entity->getExpFinalAmount()." Note : ".$entity->getExpNote();                    
                WorkflowManager::createLog("Expenses", $entity->getExpenses(), $employee, 0, $taxComment, 0);
            }   
            if($action == "auth")
            {
                //$comment = $entity->getExpenseMaster()->getExpenseName().": From ".$backupVal. " To ".$entity->getExpFinalAmount()." Note : ".$post['ExpRemark'];                    
                $comment = $entity->getExpenseMaster()->getExpenseName().": From ".$backupVal. " To ".$entity->getExpFinalAmount()." Note : ".$post['ExpNote'];                    
            }
            else 
            {
                $comment = $entity->getExpenseMaster()->getExpenseName().": From ".$backupVal. " To ".$entity->getExpFinalAmount()." Note : ".$entity->getExpAuditRemark() ;                    
            }
            WorkflowManager::createLog("Expenses", $entity->getExpenses(), $employee, 0, $comment, 0);
    }
    static function getStartEndMonth(){
        $bc = new \App\Core\BaseController();
        $month = \Modules\ESS\Runtime\EssHelper::getAllowedMonths($bc->getConfig("ESS", "allowedMonths"));
        $monthKays = array_keys($month);
        $start = end($monthKays);
        $end = reset($monthKays);
        $startMonth = explode("|", $start);
        $endMonth = explode("|", $end);
        return array("month"=>$month,"startDate"=>$start,"endDate"=>$end,"SMstartDate"=>$startMonth[0],"SMendDate"=>$startMonth[1],"EMendStartDate"=>$endMonth[0],"EMendDate"=>$endMonth[1]);
    }

    static function addMoreExpenses($id,$employeeid,$exp,$expTripType) {
        $rows = \entities\ExpenseListQuery::create()->findByExpId($id)->toKeyIndex("ExpMasterId");
        $allowedExp = self::getMoreExpenseList(\entities\BudgetExpQuery::create()->findByBgid($exp->getBudgetId()),$expTripType,false,$exp->getExpenseDate()->format("Y-m-d"),$employeeid);
        return $allowedExp;
    }

    static function getMoreExpenseList($budget,$expType,$onlyDaily = true,$date = null,$employeeid = 0)
    {
        $exps = [];        
        $s = strtotime($date);
        $start = date('Y-m-01',$s);
        $end = date('Y-m-t',$s);
              
        $Todaysexps = \entities\ExpenseListQuery::create()               
               ->filterByExpDate($date)
               ->filterByEmployeeId($employeeid)               
               ->find()->toKeyIndex("ExpMasterId");               
        
        foreach($budget as $b)
        {
            $head = $b->getExpenseMaster();            
            $showExp = false;
            if($head->getTrips() == 0){$showExp = true;} // Any
            if($head->getTrips() == 1 && ($expType == "OS" || $expType == "EX-HQ") ){$showExp = true;} // Only Trip
            if($head->getTrips() == 2 && $expType == "HQ"){$showExp = true;} // Only HQ 
            if($head->getTrips() == 3 && $expType == "EX-HQ"){$showExp = true;} // Only Ex-HQ
            if($head->getTrips() == 4 && $expType == "OS"){$showExp = true;} // Only OS
            if($head->getTrips() == 5 && $expType == "LOS"){$showExp = true;} // Only LOS
            if($head->getTrips() == 6 && $expType == "In-Transit"){$showExp = true;} // Only In-Transit
            if($head->getPermonth() == 1) {
                $exp_ids = \entities\ExpenseListQuery::create()
                        ->filterByEmployeeId($employeeid)
                        ->filterByExpDate($start, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                        ->filterByExpDate($end, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                        ->find()->toKeyValue("ExpMasterId","ExpDate");
                if(isset($exp_ids[$head->getPrimaryKey()]))
                {
                    $showExp = false;
                }
            }
            if(isset($Todaysexps[$head->getPrimaryKey()]))
            {
                $showExp = false;
            }
            if($showExp)
            {
                array_push($exps, $head);
            }
        }
        return $exps;
    }
    static function delExpenses($expid,$explistid){
        
        $data = \entities\ExpenseListQuery::create()
                    ->filterByExpListId($explistid)
                    ->filterByExpId($expid)
                    ->find();
        if($data) {
            foreach ($data as $expenseDetailList){
            $expenseDetailList->getExpenseListDetailss()->delete();
            }
            $data->delete();
        }
        return true;
    }
    
    static function delExpensesList($explistid){
        
        $data = \entities\ExpenseListQuery::create()
                    ->filterByExpListId($explistid)
                    ->find();
        if($data) {
            foreach ($data as $detailList){
                $detailList->getExpenseListDetailss()->delete();
            }
            $data->delete();
        }
        return true;
    }
    
    
    static function getAllowedCurrency($empid,$month){
        $currency = \entities\ExpensesQuery::create()
                            ->joinWithBudgetGroup()                                                        
                            ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)                    
                            ->filterByEmployeeId($empid)
                            ->find()
                            ->toArray();
                
        $currencyArray = \entities\Base\CurrenciesQuery::create()
                ->filterByCurrencyId($currency)
                ->find()->toKeyValue("CurrencyId","Name");
    }
    
    static function isEmployeeTopLevel(\entities\Employee $emp)
    {
        if($emp->getPositionId() == $emp->getReportingTo())
        {
          return true;  
        }
        else 
        {
            return false;
        }
    }
    
    static function isManager(\entities\Employee $emp)
    {
        if($emp->getPositionId() == $emp->getReportingTo())
        {
          return true;  
        }
        else 
        {
            return false;
        }
    } 
    
    static function getEmptoUser($empid){
        $data = \entities\UsersQuery::create()->filterByEmployeeId($empid)->findOne();
        return $data;
    }

    
    static function getExpPendingApprovals($entity,$pendingAction){
        
        if($entity == "Expenses"){
            $expenses = \entities\ExpensesQuery::create()
                    ->filterByExpId($pendingAction)
                    ->find()
                    ->toArray();
            
            return $expenses;
        }
    }
    static function getLastLocation($userId){
        
        $data = \entities\EmployeeLogQuery::create()                
                ->filterByUserId($userId)                
                //->limit(1)
                ->orderByLogId(\Propel\Runtime\ActiveQuery\Criteria::DESC)
                ->findOne();
        if($data){
            return $data->toArray();
        }else{
            return new \stdClass();
        }
    }
    static function getLastLogin($userName){
        $data = \entities\UserLoginLogQuery::create()
                ->filterByUserName($userName)
                ->orderByLogId(\Propel\Runtime\ActiveQuery\Criteria::DESC)
                ->findOne();
        if($data){
            return $data;
        }else{
            return [];
        }
    }
    static function getExpensesChartMonthly($empId){
        $data = [];
        $month = self::getStartEndMonth();
        $month_exp = \entities\ExpensesQuery::create()
                ->filterByEmployeeId($empId)
                ->filterByExpenseDate($month['SMstartDate'], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                ->filterByExpenseDate($month['EMendDate'], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)                        
                ->find();

        $monthExp = array();
        foreach($month_exp as $exp){                    
            if(!isset($monthExp[$exp->getExpenseDate()->format('F')] )){
                $monthExp[$exp->getExpenseDate()->format('F')]  = 0;
            }
            $monthExp[$exp->getExpenseDate()->format('F')] += $exp->getExpenseFinalAmt();
        }


        $data['labels'] = array_keys($monthExp);
        $data['data'] = array_values($monthExp);
        return $data;
    }
    static function getCategoryExpenses($empId){
        $data = [];
        $month = self::getStartEndMonth();
        $expData_id = \entities\ExpensesQuery::create()
                ->select('ExpId')
                ->filterByEmployeeId($empId)
                ->filterByExpenseDate($month['SMstartDate'], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                ->filterByExpenseDate($month['EMendDate'], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)                        
                ->find()->toArray();

        $expense = \entities\ExpenseListQuery::create()
                ->filterByExpId($expData_id)
                ->find();

        $category = \entities\Base\ExpenseMasterQuery::create()->find()->toKeyValue("expenseId","expenseName");

        $categoryExp = array();
        foreach($expense as $exp){                    
            if(!isset($categoryExp[$category[$exp->getExpMasterId()]])){
                $categoryExp[$category[$exp->getExpMasterId()]]  = 0;
            }
            $categoryExp[$category[$exp->getExpMasterId()]] += $exp->getExpFinalAmount();
        }


        foreach($categoryExp as $row){
            $data['categoryExp']['color'][] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        }


        $data['labels'] = array_keys($categoryExp);

        $data['data'] = array_values($categoryExp);
        return $data;
    }
    
    static function AUExpenseDetail($Description,$Amount,$file,$ExpListId,$ExpDetId=0) {
                
        if($ExpDetId == 0) {
            $expDetails = new \entities\ExpenseListDetails();
            $expDetails->setExpListId($ExpListId);
        }
        else
        {
            $expDetails = \entities\ExpenseListDetailsQuery::create()->findPk($ExpDetId);
        }
        if($expDetails) {
            if($file != "")
            {
                $expDetails->setImage($file);
            }

            $expDetails->setDescription($Description);
            $expDetails->setAmount($Amount);

            $expDetails->save();

            return $expDetails;
        }
        else 
        {
            throw new \Exception("ExpenseListDetails Records could not be found for $ExpDetId",400);
        }
        
        
    }
    
    static function getMultipleExpenseDetails($expense_list_id){
        $getExpDetails = \entities\ExpenseListDetailsQuery::create()
                        ->filterByExpListId($expense_list_id)
                        ->find();
        
        return $getExpDetails;
    }
    static function deleteExpenses($expListDetId){
        $delete = \entities\ExpenseListDetailsQuery::create()
                    ->filterByExpDetId($expListDetId)
                    ->delete();
        
        return $delete;
    }
    
    static function editmultipleExpense($Description,$Amount,$file,$exId){
        $single = \entities\ExpenseListDetailsQuery::create()
                    ->findPk($exId);
            
        if($single){
        
        $single->setImage($file);
        $single->setDescription($Description);
        $single->setAmount($Amount);
        
        $single->save();
        }
        return $single;
    }
    
    static function workLogDelete($workLogId){
        $delete = \entities\EmployeeWorkLogQuery::create()
                    ->filterByWorkLogId($workLogId)
                    ->delete();
        return $delete;
    }
    
     static function getStandardEmployeeRecord(\entities\Base\Employee $employee,$companyid)
   {
       
        $profilePic = 'uploads/'."default-profile.png";
        if($employee->getProfilePicture()){$profilePic = 'uploads/'.$companyid.'/'.$employee->getProfilePicture();}
        $record = [
            "profilePic" => $profilePic,            
            "EmployeeId" => $employee->getEmployeeId(),
            "FirstName" => $employee->getFirstName(),
            "LastName" => $employee->getLastName(),
            "Branchname" => $employee->getBranch()->getBranchname(),
            "Email" => $employee->getEmail(),
            "Designation" => $employee->getDesignations()->getDesignation()
        ];
        
        return $record;
    
   }
   
   public static function deleteExpense(\entities\Expenses $exp)
    {
       
        $wf = new WorkflowManager();
        $wf->deleteEntity("Expenses", $exp);
        
        foreach ($exp->getExpenseLists() as $expId){
            $expId->getExpenseListDetailss()->delete();
        }
        
        $exp->getExpenseLists()->delete();
        $exp->getExpenseFiless()->delete();        
        //$exp->getEmployeeWorkLogs()->delete();   
        $exp->delete();
    }

    public static function deleteExpenseWithAttendance(\entities\Expenses $exp)
    {
       
        $wf = new WorkflowManager();
        $wf->deleteEntity("Expenses", $exp);
        
        foreach ($exp->getExpenseLists() as $expId){
            $expId->getExpenseListDetailss()->delete();
        }
        
        $exp->getExpenseLists()->delete();
        $exp->getExpenseFiless()->delete();        
        //$exp->getEmployeeWorkLogs()->delete();                                                                                                                                                                                                                                              p->getEmployeeWorkLogs()->delete();
    }
    
    

    static function date_range($first, $last, $step = '+1 day', $output_format = 'Y-m-d' ) {

        $dates = array();
        $current = strtotime($first);
        $last = strtotime($last);
    
        while( $current <= $last ) {
    
            $dates[] = date($output_format, $current);
            $current = strtotime($step, $current);
        }
    
        return $dates;
    }

    static function getDatesMoye($moye)
    {
        $moye = explode("-",$moye);

        $month = $moye[0];
        $year = $moye[1];

        $dates = [];                
        
        $dates[] = date( $year.'-'.$month.'-01' ); // Start date
        $dates[] = date( $year.'-'.$month.'-t' ); // End Date

        return $dates;

    }

    public static function getWorkingDays($employeeId,$month){

        $moye = explode("-",$month);

        $month = $moye[0];
        $year = $moye[1];

        $dates = [];                
        
        $dates[] = date( $year.'-'.$month.'-01' ); // Start date
        $dates[] = date( $year.'-'.$month.'-t' ); // End Date

        // Get employee
        $employee = \entities\EmployeeQuery::create()
                        ->filterByEmployeeId($employeeId)
                        ->findOne();

        // Get all holidays
        $holidays = \entities\HolidaysQuery::create()
                        ->select(['HolidayDate'])
                        ->filterByCompanyId($employee->getCompanyId())
                        ->filterByIstateid($employee->getBranch()->getIstateid())
                        ->filterByHolidayDate()
                        ->find()->toArray();
    }

    public static function getFreeMonthDates($month,$employee){

        $employee = \entities\EmployeeQuery::create()
                        ->filterByEmployeeId($employee)
                        ->findOne();

        $date = explode('-',$month[0]);

        $data = array();
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, (int)$date[1], (int)$date[0]);
        for ($i = 0; $i < $daysInMonth; $i++) {
            $day = date("Y-m-d", strtotime("+$i day", strtotime($month[0])));
            $currentDate = DateTime::createFromFormat("Y-m-d", $day);

            $data[$currentDate->format('Y-m-d')] = [
                "Date" => $currentDate->format('Y-m-d'),
                "Day" =>  'No Data!!',
                "Type" => 'NoData',
            ];

            $attendance = \entities\AttendanceQuery::create()
                                ->filterByAttendanceDate($currentDate->format('Y-m-d'))
                                ->filterByEmployeeId($employee->getEmployeeId())
                                ->findOne();

            if ($currentDate->format("N") == 7 && $attendance == null) // Sunday
            {
                $data[$currentDate->format('Y-m-d')] = [
                    "Date" => $currentDate->format('Y-m-d'),
                    "Day" => $currentDate->format("l"),
                    "Type" => 'WeekOff',
                ];
            }
        }

        // Employee Month Holidays
        $holidays = \entities\HolidaysQuery::create()
                        ->select(['HolidayDate', 'HolidayName'])
                        ->filterByHolidayDate($month[0],Criteria::GREATER_EQUAL)
                        ->filterByHolidayDate($month[1],Criteria::LESS_EQUAL)
                        ->filterByIstateid($employee->getBranch()->getIstateid())
                        ->find()->toArray();
        foreach($holidays as $holiday){
            $attendance = \entities\AttendanceQuery::create()
                                ->filterByAttendanceDate($holiday['HolidayDate'])
                                ->filterByEmployeeId($employee->getEmployeeId())
                                ->findOne();

            if ($attendance == null && array_key_exists($holiday['HolidayDate'],$data)) {
                
                    $data[$holiday['HolidayDate']] = [
                        "Date" => $holiday['HolidayDate'],
                        "Day" => $holiday['HolidayName'],
                        "Type" => 'Holiday',
                    ];
               
            }
        }

        // Employee Month Leaves
        $leaveRequests = \entities\LeaveRequestQuery::create()
                            ->select(['LeaveReqId'])
                            ->filterByLeaveStatus([2])
                            ->filterByLeaveFrom($month[0],Criteria::GREATER_EQUAL)
                            ->_or()
                            ->filterByLeaveTo($month[1],Criteria::LESS_EQUAL)
                            ->filterByEmployeeId($employee->getEmployeeId())
                            ->find()->toArray();
        $leaves = \entities\LeavesQuery::create()
                    ->select(['LeaveDate', 'LeaveType'])
                    ->filterByLeaveRequestId($leaveRequests)
                    ->find()->toArray();
        foreach($leaves as $leave){
            // $attendance = \entities\AttendanceQuery::create()
            //                     ->filterByAttendanceDate($leave['LeaveDate'])
            //                     ->filterByEmployeeId($employee->getEmployeeId())
            //                     ->findOne();

            if (array_key_exists($leave['LeaveDate'],$data)) {
                $data[$leave['LeaveDate']] = [
                    "Date" => $leave['LeaveDate'],
                    "Day" => $leave['LeaveType'],
                    "Type" => 'Leave',
                ];
            }
        }

        return $data;
    }

    static function getMonthWeekOffs($month){
        $date = explode('-',$month[0]);
        $data = array();
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, (int)$date[1], (int)$date[0]);
        for ($i = 0; $i < $daysInMonth; $i++) {
            $day = date("Y-m-d", strtotime("+$i day", strtotime($month[0])));
            $currentDate = DateTime::createFromFormat("Y-m-d", $day);

            if ($currentDate->format("N") == 7) // Sunday
            {
                $data[] = $currentDate->format('Y-m-d');
            }
        }
        return $data;
    }

    static function getMonthLeaves($month,$employee){
        $leaveRequests = \entities\LeaveRequestQuery::create()
                            ->select(['LeaveReqId'])
                            ->filterByLeaveFrom($month[0],Criteria::GREATER_EQUAL)
                            ->filterByLeaveTo($month[1],Criteria::LESS_EQUAL)
                            ->filterByEmployeeId((int)$employee)
                            ->find()->toArray();
        $data = \entities\LeavesQuery::create()
                    ->select(['LeaveDate'])
                    ->filterByLeaveRequestId($leaveRequests)
                    ->find()->toArray();
        return $data;
    }

}
