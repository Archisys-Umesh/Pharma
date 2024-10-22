<?php declare(strict_types = 1);

namespace Modules\HR\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use Modules\System\Processes\WorkflowManager;

class Reports extends \App\Core\BaseController
{	               
    protected $app;
        
    public function __construct(App $app)
    {
            $this->app = $app;		
    }
    
    public function expenseReport()
    {
        $action = $this->app->Request()->getParameter("action","");
        $units = \Modules\HR\Runtime\HrHelper::getAllowedUnits($this->app->Auth()->getUser()->getEmployee());
        $dataCurrency = FormMgr::select()
                    ->options(\entities\Base\CurrenciesQuery::create()->find()->toKeyValue("CurrencyId","Name"));
        $s = FormMgr::select()->options(array("10"=>"Proceed for Payment","9"=>"Hold/Resign"));
        
        switch ($action) :
            case "":
                $this->data['monthList'] = FormMgr::select()
                    ->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths(10))
                    ->html();           
                $this->data['currency'] = $dataCurrency->html();
                $this->data['statusddl'] = $s->html();                    
                
                $this->app->Renderer()->render("hr/reports/expenseReport.twig",$this->data);
                
                break;
            case "load":
                    //$reportType = $this->app->Request()->getParameter("reportType","");
                    $monthData = $this->app->Request()->getParameter("month");
                    $month = explode("|",$this->app->Request()->getParameter("month","|"));
                    
                    $status = explode(",",$this->app->Request()->getParameter("status"));
                    $expenses = \entities\ExpensesQuery::create()                                                            
                    ->filterByExpenseStatus($status)
                    //->filterByTripCurrency(1)
                    ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->filterByOrgunitId($units)
                    ->limit(10000)
                    ->orderByExpenseDate(\Propel\Runtime\ActiveQuery\Criteria::DESC)
                    ->find();
                    $reportData = [];
                    foreach($expenses as $ex)
                    {
                         $list = $ex->getExpenseLists();
                            foreach($list as $l)
                            {
                                if(!isset($reportData[$l->getEmployeeId()])) {
                                    $reportData[$l->getEmployeeId()]['cmpcard'] = 0;
                                    $reportData[$l->getEmployeeId()]['expAmount'] = 0;
                                    $reportData[$l->getEmployeeId()]['add'] = 0;
                                    $reportData[$l->getEmployeeId()]['tax'] = 0;
                                    $reportData[$l->getEmployeeId()]['expApproved'] = 0;
                                    $reportData[$l->getEmployeeId()]['expAudited'] = 0;
                                    $reportData[$l->getEmployeeId()]['paybleAmount'] = 0;
                                    $reportData[$l->getEmployeeId()]['cmpcard'] = 0;
                                    $reportData[$ex->getEmployeeId()]["Additional"] = 0;                                
                                    $reportData[$ex->getEmployeeId()]["Tax"] = 0;
                                    $reportData[$ex->getEmployeeId()]["NonReimbursable"] = 0;
                                }
                                if (array_key_exists($l->getEmployeeId(),$reportData))
                                {
                                    $reportData[$l->getEmployeeId()]['expAmount'] += $l->getExpIlAmount();
                                    $reportData[$l->getEmployeeId()]['add'] += $l->getExpReqAmount();
                                    //$reportData[$l->getEmployeeId()]['tax'] += $l->getExpTaxAmount();
                                    $reportData[$l->getEmployeeId()]['tax'] += $l->getExpClaimedTax();
                                    $reportData[$l->getEmployeeId()]['expApproved'] += $l->getExpAprAmount();
                                    
                                    $setData = $l->getExpAprAmount()-$l->getExpAuditAmount();
                                    $reportData[$l->getEmployeeId()]['expAudited'] += $setData;

                                    $reportData[$l->getEmployeeId()]['paybleAmount'] += $l->getExpFinalAmount();

                                    if($l->getCmpCard() == 1){
                                        $reportData[$l->getEmployeeId()]['cmpcard'] += $l->getExpFinalAmount();
                                    }
                                }else{
                                    $reportData[$l->getEmployeeId()]['expAmount'] = $l->getExpIlAmount();
                                    $reportData[$l->getEmployeeId()]['add'] = $l->getExpReqAmount();
                                    //$reportData[$l->getEmployeeId()]['tax'] = $l->getExpTaxAmount();
                                    $reportData[$l->getEmployeeId()]['tax'] = $l->getExpClaimedTax();
                                    $reportData[$l->getEmployeeId()]['expApproved'] = $l->getExpAprAmount();
                                    
                                    $setData = $l->getExpAprAmount()-$l->getExpAuditAmount();
                                    $reportData[$l->getEmployeeId()]['expAudited'] = $setData;

                                    $reportData[$l->getEmployeeId()]['paybleAmount'] += $l->getExpFinalAmount();

                                    if($l->getCmpCard() == 1){
                                        $reportData[$l->getEmployeeId()]['cmpcard'] += $l->getExpFinalAmount();
                                    }
                                }
                                $reportData[$l->getEmployeeId()]['expId'] = $l->getExpId();
                                $reportData[$l->getEmployeeId()]['expDate'] = $l->getExpDate()->format('d-m-Y');
                                
                            }
                            $emp = $ex->getEmployee();
                            if(isset($l))
                            {
                                $reportData[$l->getEmployeeId()]['Name'] = $emp->getFirstName()." ".$emp->getLastName()." | ".$emp->getEmployeeCode();
                                $reportData[$l->getEmployeeId()]['ID'] = $emp->getEmployeeId();
                                $reportData[$l->getEmployeeId()]['Designation'] = $emp->getDesignations()->getDesignation();
                                $reportData[$l->getEmployeeId()]['Branch'] = $emp->getBranch()->getBranchname();
                                $reportData[$l->getEmployeeId()]['Unit'] = $emp->getOrgUnit()->getUnitName();
                                $reportData[$l->getEmployeeId()]['Currency'] = $ex->getCurrencies()->getShortcode();
                                $reportData[$l->getEmployeeId()]['CurrencyId'] = $ex->getTripCurrency();
                                $reportData[$l->getEmployeeId()]['month'] = $monthData;
                                if($emp->getHrUserAccounts()->count() > 0)
                                {
                                    $reportData[$l->getEmployeeId()]['Bank'] = $emp->getHrUserAccounts()[0]->getPersonalBank();
                                    $reportData[$l->getEmployeeId()]['AC'] = $emp->getHrUserAccounts()[0]->getPersonalAccountNumber();
                                }
                                
                            }
                            //$reportData[$ex->getEmployeeId()]["Payable"] += $ex->getExpenseFinalAmt();
                            
                            $listExp = $ex->getExpenseLists();
                            foreach($listExp as $lex)
                            {  
                                if($lex->getExpenseMaster()->getNonreimbursable() == 1)
                                {                                
                                    $reportData[$lex->getEmployeeId()]["NonReimbursable"] += $lex->getExpFinalAmount();
                                }
                                
                                $reportData[$lex->getEmployeeId()]["Additional"] += $lex->getExpReqAmount();                                
                                //$reportData[$lex->getEmployeeId()]["Tax"] += $lex->getExpTaxAmount();
                                $reportData[$lex->getEmployeeId()]["Tax"] += $lex->getExpClaimedTax();
                            }                                                    
                        
                    }
                    $this->data['data'] = $reportData;
                    
                    $f = FormMgr::select()->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths(10));
                    $f->val($this->app->Request()->getParameter("month"));
                    
                    
                    $s->val($this->app->Request()->getParameter("status"));
                                        
                    
                    //$dataCurrency->val($currency);
                    $this->data['currency'] = $dataCurrency->html();                    
                    $this->data['statusddl'] = $s->html();                    
                    $this->data['monthList'] = $f->html();                               
                    $this->data['status'] = $this->app->Request()->getParameter("status");
                    
                    $this->data['month'] = $this->app->Request()->getParameter("month","|");
                    $this->app->Renderer()->render("hr/reports/expenseReport.twig",$this->data);
                    
                    
                break;
        endswitch;
    }
        
    public function empExpReport()
    {        
        $month = explode("|",$this->app->Request()->getParameter("month","|"));
        $empid = $this->app->Request()->getParameter("emp");
        $curId = $this->app->Request()->getParameter("curId");
        $status = $this->app->Request()->getParameter("status");
        $taxArray = [];
        
        $ApprovalTotal = 0;
        $cmpcardAmount = 0;
        $taxTotal = 0;
        $PaybleAmountfinal = 0;
        
        $expenses = \entities\ExpensesQuery::create()
        //->filterByExpenseStatus(8)                                        
        ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
        ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
        ->filterByExpenseStatus($status)        
        ->filterByEmployeeId($empid)
        ->filterByTripCurrency($curId)
        ->find();
        
        if($expenses){
            
            foreach($expenses as $e){
                
                $list = $e->getExpenseLists();
                foreach($list as $l)
                {
                    if(!isset($taxArray[$e->getBudgetId()])) {
                        $l->taxArray[$e->getBudgetId()]['cmpcard'] = 0;
                        $taxArray[$e->getBudgetId()]['expAmount'] = 0;
                        $taxArray[$e->getBudgetId()]['add'] = 0;
                        $taxArray[$e->getBudgetId()]['tax'] = 0;
                        $taxArray[$e->getBudgetId()]['expApproved'] = 0;
                        $taxArray[$e->getBudgetId()]['expAudited'] = 0;
                        $taxArray[$e->getBudgetId()]['paybleAmount'] = 0;
                        $taxArray[$e->getBudgetId()]['cmpcard'] = 0;
                        $taxArray[$e->getBudgetId()]['payTax'] = 0;
                        
                    }
                    if (array_key_exists($e->getBudgetId(),$taxArray))
                    {
                        $taxArray[$e->getBudgetId()]['expAmount'] += $l->getExpIlAmount();
                        $taxArray[$e->getBudgetId()]['add'] += $l->getExpReqAmount();
                        
                        $taxArray[$e->getBudgetId()]['expApproved'] += $l->getExpAprAmount();
                        $setData = $l->getExpAprAmount()-$l->getExpAuditAmount();
                        $taxArray[$e->getBudgetId()]['expAudited'] += $setData;
                        //$taxArray[$e->getBudgetId()]['tax'] += $l->getExpTaxAmount();
                        $taxArray[$e->getBudgetId()]['tax'] += $l->getExpClaimedTax();
                        
                        $taxArray[$e->getBudgetId()]['paybleAmount'] += $l->getExpFinalAmount();    
                        
                        if($l->getCmpCard() == 1){
                            $taxArray[$e->getBudgetId()]['cmpcard'] += $l->getExpFinalAmount();
                        }
                        else 
                        {
                            $taxArray[$e->getBudgetId()]['payTax'] += $l->getExpTaxAmount();
                            
                        }
                    }else{
                        $taxArray[$e->getBudgetId()]['expAmount'] = $l->getExpIlAmount();
                        $taxArray[$e->getBudgetId()]['add'] = $l->getExpReqAmount();
                        
                        $taxArray[$e->getBudgetId()]['expApproved'] = $l->getExpAprAmount();
                        $setData = $l->getExpAprAmount()-$l->getExpAuditAmount();
                        $taxArray[$e->getBudgetId()]['expAudited'] = $setData;
                        
                        $taxArray[$e->getBudgetId()]['paybleAmount'] += $l->getExpFinalAmount();
                        //$taxArray[$e->getBudgetId()]['tax'] = $l->getExpTaxAmount();
                        $taxArray[$e->getBudgetId()]['tax'] = $l->getExpClaimedTax();
                        
                        if($l->getCmpCard() == 1){
                            $taxArray[$e->getBudgetId()]['cmpcard'] += $l->getExpFinalAmount();
                        }
                        else 
                        {
                            
                            //$taxArray[$e->getBudgetId()]['payTax'] = $l->getExpTaxAmount();
                            $taxArray[$e->getBudgetId()]['payTax'] = $l->getExpClaimedTax();
                        }
                    }
                    $taxArray[$e->getBudgetId()]['expId'] = $l->getExpId();
                    $taxArray[$e->getBudgetId()]['expDate'] = $l->getExpDate()->format('d-m-Y');
                    $ApprovalTotal += $l->getExpAprAmount();
                    if($l->getCmpCard() == 0){
                        $PaybleAmountfinal += $l->getExpFinalAmount();
                    }
                    if($l->getCmpCard() == 1){
                        $cmpcardAmount += $l->getExpFinalAmount();
                    }
                    //$taxTotal += $l->getExpTaxAmount();
                    $taxTotal += $l->getExpClaimedTax();
                    
                }
                $taxArray[$e->getBudgetId()]['Budget'] = $e->getBudgetGroup()->getGroupcode(); 
                $taxArray[$e->getBudgetId()]['exphead'] = $e->getBudgetGroup()->getGroupName();
                
            }
            
        } 
        
        $this->data['ApprovalTotal'] = $ApprovalTotal;
        $this->data['cmpcardAmount'] = $cmpcardAmount;
        $this->data['taxFinal'] = $taxTotal;
        $this->data['finalpayable'] = $PaybleAmountfinal;
        
        $emp = \entities\EmployeeQuery::create()->findPk($empid);        
                
        $this->data["Name"] = $emp->getFirstName()." ".$emp->getLastName();
        $this->data["empcode"] = $emp->getEmployeeCode();
        $this->data['Designation'] = $emp->getDesignations()->getDesignation();
        $this->data['Location'] = $emp->getBranch()->getBranchname()." | ".$emp->getBranch()->getOrgUnit()->getUnitName();
        $this->data['State'] = $emp->getBranch()->getOrgUnit()->getUnitName();
        $this->data['costnumber'] = $emp->getcostNumber();
        $this->data["data"] = $taxArray;  
        $this->data['reportname'] = date("F Y", strtotime($month[0]));
        //var_dump($expenses); exit;
        $this->app->Renderer()->render("hr/reports/empExpReport.twig",$this->data);
    }
    public function empExpReport_new()
    {        
        $month = explode("|",$this->app->Request()->getParameter("month","|"));
        $empid = $this->app->Request()->getParameter("emp");
        $curId = $this->app->Request()->getParameter("curId");
        $taxArray = [];
        
        $expenses = \entities\ExpensesQuery::create()
        ->filterByExpenseStatus(8)                                        
        ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
        ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
        ->filterByEmployeeId($empid)
        ->filterByTripCurrency($curId)
        ->find();
        $expAmount = 0;
        $ApprovalTotal = 0;
        $ExpenseTotal = 0;
        $AuditorTotal = 0;
        $PaybleAmountfinal = 0;
        $cmpcardAmount = 0;
        $auditorFinal = 0;
        $paybleAmount = 0;
        $addTotal = 0;
        $taxTotal = 0;
        if($expenses){
            foreach($expenses as $e)
            {
                $list = $e->getExpenseLists();
                foreach($list as $l)                                
                {
                    if(!isset($taxArray[$l->getExpMasterId()])) {
                        $taxArray[$l->getExpMasterId()]['paybleAmount'] = 0;
                        $taxArray[$l->getExpMasterId()]['expAmount'] = 0;
                        $taxArray[$l->getExpMasterId()]['appAmount'] = 0;
                        $taxArray[$l->getExpMasterId()]['auditDudAmount'] = 0;
                        $taxArray[$l->getExpMasterId()]['cmpcard'] = 0;
                        $taxArray[$l->getExpMasterId()]['add'] = 0;
                        $taxArray[$l->getExpMasterId()]['tax'] = 0;
                    }

                    if (array_key_exists($l->getExpMasterId(),$taxArray))
                    {
                        $taxArray[$l->getExpMasterId()]['expAmount'] += $l->getExpIlAmount();
                        $taxArray[$l->getExpMasterId()]['appAmount'] += $l->getExpAprAmount();
                        $taxArray[$l->getExpMasterId()]['auditDudAmount'] += $l->getExpAuditAmount();
                        if($l->getCmpCard() == 0){
                            $taxArray[$l->getExpMasterId()]['paybleAmount'] += $l->getExpFinalAmount();
                        }
                        if($l->getCmpCard() == 1){
                            $taxArray[$l->getExpMasterId()]['cmpcard'] += $l->getExpFinalAmount();
                        }
                        $taxArray[$l->getExpMasterId()]['tax'] += $l->getExpTaxAmount();
                        $taxArray[$l->getExpMasterId()]['add'] += $l->getExpReqAmount();
                    }
                    else
                    {
                        $taxArray[$l->getExpMasterId()]['expAmount'] = $l->getExpIlAmount();
                        $taxArray[$l->getExpMasterId()]['appAmount'] = $l->getExpAprAmount();
                        $taxArray[$l->getExpMasterId()]['auditDudAmount'] = $l->getExpAuditAmount();
                        $taxArray[$l->getExpMasterId()]['tax'] = $l->getExpTaxAmount();
                        $taxArray[$l->getExpMasterId()]['add'] = $l->getExpReqAmount();
                        if($l->getCmpCard() == 0){
                            $taxArray[$l->getExpMasterId()]['paybleAmount'] = $l->getExpFinalAmount();
                        }
                        if($l->getCmpCard() == 1){
                            $taxArray[$l->getExpMasterId()]['cmpcard'] = $l->getExpFinalAmount();
                        }
                        $taxArray[$l->getExpMasterId()]['Expid'] = $l->getExpId();
                        $taxArray[$l->getExpMasterId()]['Budget'] = "";
                    }
                    $taxArray[$l->getExpMasterId()]['Expid'] = $l->getExpId();
                    $taxArray[$l->getExpMasterId()]['Budget'] = "";
                    $taxArray[$l->getExpMasterId()]['expDate'] = $l->getExpDate()->format('d-m-Y');
                    $ExpenseTotal += $l->getExpIlAmount();
                    $ApprovalTotal += $l->getExpAprAmount();
                    if($l->getCmpCard() == 0){
                        $PaybleAmountfinal += $l->getExpFinalAmount();
                    }
                    if($l->getCmpCard() == 1){
                        $cmpcardAmount += $l->getExpFinalAmount();
                    }
                    $setAmount = $l->getExpAprAmount()-$l->getExpFinalAmount();
                    $taxArray[$l->getExpMasterId()]['finalauditDudAmount'] = $setAmount;
                    $auditorFinal += $setAmount;
                    $taxTotal += $l->getExpTaxAmount();
                    $addTotal += $l->getExpReqAmount();
                }

            }
            //var_dump($taxArray); exit;
        } 
        $emp = \entities\EmployeeQuery::create()->findPk($empid);        
                
        $this->data["Name"] = $emp->getFirstName()." ".$emp->getLastName()." | ".$emp->getEmployeeCode();
        $this->data["data"] = $taxArray;   
        //var_dump($expenses); exit;
        $this->app->Renderer()->render("hr/reports/empExpReport.twig",$this->data);
    }
    public function empSummary() {
        $action = $this->app->Request()->getParameter("action","");
        $units = \Modules\HR\Runtime\HrHelper::getAllowedUnits($this->app->Auth()->getUser()->getEmployee());
        $currencyArray = \entities\Base\CurrenciesQuery::create()->find()->toKeyValue("CurrencyId","Name");

        $dataCurrency = FormMgr::select()
                    ->options(\entities\Base\CurrenciesQuery::create()->find()->toKeyValue("CurrencyId","Name"));
        
        
        switch ($action) :
            case "":
                $month = explode("|",date("Y-m-1")."|".date("Y-m-31"));
                $this->data['monthList'] = FormMgr::select()
                    ->options(array_merge(array("0"=>"Select Month"),\Modules\ESS\Runtime\EssHelper::getAllowedMonths(10)))
                    ->html();           
                $this->data['currency'] = $dataCurrency->html();
                $this->data['reportname'] = date("F Y");
                $expenses = \entities\ExpensesQuery::create()
                            ->select(["EmployeeId"])
                            ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                            ->groupByEmployeeId()
                            ->find();
                
                $this->app->Renderer()->render("hr/reports/empSummaryReports.twig",$this->data);
                break;
            case "getemp":
                $month = explode("|",$this->app->Request()->getParameter("month","|"));
                $status = $this->app->Request()->getParameter("status","");
                $expenses = \entities\ExpensesQuery::create()
                            //->select(["EmployeeId"])
                            ->filterByExpenseStatus($status)                        
                            ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                            //->groupByEmployeeId()
                            ->find();
                $data = [];
                if($expenses){
                    foreach ($expenses as $e){
                        if($e->getExpenseReqAmt() > 0){
                            $data[] = array("empid"=>$e->getEmployeeId(),"empName"=>$e->getEmployee()->getFirstName()." ".$e->getEmployee()->getLastName()." | ".$e->getEmployee()->getEmployeeCode());
                        }
                        //array_push($data, $e->getEmployeeId());
                    }
                }
                //echo json_encode($data);
                $this->json($data);
                
                
                break;
            case "load":
                    
        
                    $month = explode("|",$this->app->Request()->getParameter("month","|"));
                    $employees = $this->app->Request()->getParameter("empSelect");
                    $currency = 1;$this->app->Request()->getParameter("currency");
                    $status = $this->app->Request()->getParameter("status");
                    //var_dump($month); exit;
                    $expenses = \entities\ExpensesQuery::create()
                            ->joinWithBudgetGroup()
                            ->filterByExpenseStatus($status)
                            ->filterByTripCurrency($currency)
                            ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)                    
                            ->filterByEmployeeId($employees);
                    $expenses->find();
                    
                    $expense = \entities\ExpensesQuery::create()
                            ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                            //->groupByEmployeeId()
                            ->find();
                    $data = [];
                    if($expense){
                        foreach ($expense as $ee){
                            $data[$ee->getEmployeeId()] = $ee->getEmployee()->getFirstName()." ".$ee->getEmployee()->getLastName()." | ".$ee->getEmployee()->getEmployeeCode();
                            
                        }
                    }
                    $emplist = FormMgr::select()->options($data);
                    
                    $reportData = [];
                    $taxArray = [];
                    $claimedAmount = 0;
                    $add = 0;
                    $gst = 0;
                    $didbyapprover = 0;
                    $audididAmount = 0;
                    $finalAmount = 0;
                    $cmpcardAmount = 0;
                    $dedAuditorAmount = 0;
                    $addAuditorAmount = 0;
                    $temp = 0;
                    if($expenses->find()){
                        foreach($expenses as $e)
                        {
                            $list = $e->getExpenseLists();
                            foreach($list as $l)                                
                            {
                                
                                if(!isset($taxArray[$l->getExpMasterId()])) {
                                    $taxArray[$l->getExpMasterId()]['claimedAmount'] = 0;
                                    $taxArray[$l->getExpMasterId()]['cmpcardAmount'] = 0;
                                    $taxArray[$l->getExpMasterId()]['add'] = 0;
                                    $taxArray[$l->getExpMasterId()]['gst'] = 0;
                                    $taxArray[$l->getExpMasterId()]['didbyapprover'] = 0;
                                    $taxArray[$l->getExpMasterId()]['audididAmount'] = 0;
                                    $taxArray[$l->getExpMasterId()]['finalAmount'] = 0;
                                }
                                
                                if (array_key_exists($l->getExpMasterId(),$taxArray))
                                {
                                    $taxArray[$l->getExpMasterId()]['particulars'] = $l->getExpenseMaster()->getExpenseName();
                                    
                                    $taxArray[$l->getExpMasterId()]['claimedAmount'] += $l->getExpIlAmount();
                                    $taxArray[$l->getExpMasterId()]['add'] += $l->getExpReqAmount();
                                    $taxArray[$l->getExpMasterId()]['gst'] += $l->getExpTaxAmount();
                                    $taxArray[$l->getExpMasterId()]['didbyapprover'] += $l->getExpAprAmount();
                                    $taxArray[$l->getExpMasterId()]['audididAmount'] += $l->getExpAuditAmount();
                                    $taxArray[$l->getExpMasterId()]['finalAmount'] += $l->getExpFinalAmount();
                                    if($l->getCmpCard() == 1){
                                        $taxArray[$l->getExpMasterId()]['cmpcardAmount'] += $l->getExpFinalAmount();
                                    }
                                }
                                else
                                {
                                    $taxArray[$l->getExpMasterId()]['particulars'] = $l->getExpenseMaster()->getExpenseName();
                                    
                                    $taxArray[$l->getExpMasterId()]['claimedAmount'] = $l->getExpIlAmount();
                                    $taxArray[$l->getExpMasterId()]['add'] = $l->getExpReqAmount();
                                    $taxArray[$l->getExpMasterId()]['gst'] = $l->getExpTaxAmount();
                                    $taxArray[$l->getExpMasterId()]['didbyapprover'] = $l->getExpAprAmount();
                                    $taxArray[$l->getExpMasterId()]['audididAmount'] = $l->getExpAuditAmount();
                                    $taxArray[$l->getExpMasterId()]['finalAmount'] = $l->getExpFinalAmount();
                                    if($l->getCmpCard() == 1){
                                        $taxArray[$l->getExpMasterId()]['cmpcardAmount'] = $l->getExpFinalAmount();
                                    }
                                }
                                
                                $claimedAmount += $l->getExpIlAmount();
                                $add += $l->getExpReqAmount();
                                $gst += $l->getExpTaxAmount();
                                $didbyapprover += $l->getExpAprAmount();
                                
                                $temp = $l->getExpAprAmount() - $l->getExpAuditAmount();
                                if($temp > 0 && $l->getExpAuditAmount() != 0) {
                                    $dedAuditorAmount += $temp;
                                } else if ($l->getExpAuditAmount() != 0) {
                                    $addAuditorAmount += $temp;
                                }
                                                                
                                $audididAmount += $l->getExpAuditAmount();
                                $finalAmount += $l->getExpFinalAmount();
                                if($l->getCmpCard() == 1){
                                    $cmpcardAmount += $l->getExpFinalAmount();
                                }
                            }
                            
                        }
//                        exit;
                        //var_dump($expenses->count()); exit;
                    }
                    $emp = \entities\EmployeeQuery::create()->findPk($employees);
                    if($emp){
                        $this->data['Name'] = $emp->getFirstName()." ".$emp->getLastName();
                        $this->data['empcode'] = $emp->getEmployeeCode();
                        $this->data['costnumber'] = $emp->getCostNumber();
                        $this->data['Designation'] = $emp->getDesignations()->getDesignation();
                        $this->data['Location'] = $emp->getBranch()->getBranchname()." | ".$emp->getBranch()->getGeoState()->getSstatename();
                        $this->data['State'] = $emp->getBranch()->getGeoState()->getSstatename();
                    }
                    $this->data['status'] = $status;
                    $this->data['heads'] = $taxArray;
                    $this->data['claimedAmount'] = $claimedAmount;
                    $this->data['add'] = $add;
                    $this->data['gst'] = $gst;
                    $this->data['didbyapprover'] = $didbyapprover; 
                    $this->data['audididAmount'] = $audididAmount; 
                    $this->data['finalAmount'] = $finalAmount; 
                    $this->data['addAuditorAmount'] = $addAuditorAmount;
                    $this->data['dedAuditorAmount'] = $dedAuditorAmount;
                    $this->data['cmpcardAmount'] = $cmpcardAmount;
                    $monthSelection = FormMgr::select()->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths(10));
                    
                    $monthSelection->val($this->app->Request()->getParameter("month"));                    
                    $this->data['monthList'] = $monthSelection->html();                               
                    $this->data['month'] = $this->app->Request()->getParameter("month","|");
                    $this->data['reportname'] = date("F Y", strtotime($month[0]));
                    $dataCurrency->val($currency);                  
                    $this->data['currency'] = $dataCurrency->html();
                    $emplist->val($employees);                  
                    $this->data['empList'] = $emplist->html();
                    $this->data['empcount'] = count($data);
                    $this->data['currSelected'] = $currencyArray[$currency];
                    //var_dump($this->data['empcount']);exit;
                    $this->app->Renderer()->render("hr/reports/empSummaryReports.twig",$this->data);
                    
                break;
                
        endswitch;
    }
    public function empTrip() {
        $action = $this->app->Request()->getParameter("action","");
        $units = \Modules\HR\Runtime\HrHelper::getAllowedUnits($this->app->Auth()->getUser()->getEmployee());
        $dataCurrency = FormMgr::select()
                    ->options(\entities\Base\CurrenciesQuery::create()->find()->toKeyValue("CurrencyId","Name"));
        $dataStatus = FormMgr::select()->options(WorkflowManager::getStatusList("Trips"));
        $status = 8;
        
        switch ($action) :
            case "":
                $month = explode("|",date("Y-m-1")."|".date("Y-m-31"));
                $this->data['monthList'] = FormMgr::select()
                    ->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths(10))
                    ->html();
                $this->data['status'] = $dataStatus->html();
//                $this->data['one'] = \Modules\ESS\Runtime\EssHelper::getAllowedMonths(10);
//                var_dump($this->data['one']);
//                var_dump($this->data['status']); exit;
                $this->data['currency'] = $dataCurrency->html();
                $this->data['reportname'] = date("F Y");
                
                
                $this->app->Renderer()->render("hr/reports/emptripList.twig",$this->data);
                break;
            case "getemp":
                $month = explode("|",$this->app->Request()->getParameter("month","|"));
                $expenses = \entities\TripsQuery::create()
                            ->filterByTripStartDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByTripEndDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                            ->groupByEmployeeId()
                            ->find();
                $data = [];
                if($expenses){
                    foreach ($expenses as $e){
                        $data[] = array("empid"=>$e->getEmployeeId(),"empName"=>$e->getEmployee()->getFirstName()." ".$e->getEmployee()->getLastName()." | ".$e->getEmployee()->getEmployeeCode());
                        //array_push($data, $e->getEmployeeId());
                    }
                }
                //echo json_encode($data);
                $this->json($data);
                
                
                break;
            case "load":
                    
                    //$month = explode("|",$this->app->Request()->getParameter("month","|"));
                    $fromdate = $this->app->Request()->getParameter("fromdate");
                    $todate = $this->app->Request()->getParameter("todate");
                    $status = $this->app->Request()->getParameter("status");
                    $currency = 1;$this->app->Request()->getParameter("currency");
                    
                    $TripStartDate =  \DateTime::createFromFormat("d/m/Y", $fromdate);
                    $TripEndDate = \DateTime::createFromFormat("d/m/Y", $todate);
                    
                    $tripdata = array();
                    $trip = \entities\TripsQuery::create()
                            ->filterByTripCurrency($currency)
                            ->filterByTripStartDate($TripStartDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByTripEndDate($TripEndDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)                    
                            ->filterByTripStatus($status)
//                            ->filterByEmployeeId($employees)
                            ->find();
                    if($trip){
                        foreach ($trip as $t){
                            if($t->getTripType() == 1){
                                $type = "Ex-HQ";
                            }else{
                                $type = "Out-Station";
                            }
                            if($t->getTripStatus() == 1){
                                $setstatus = "Raised";
                            }elseif ($t->getTripStatus() == 2) {
                                $setstatus = "Approved";
                            }elseif ($t->getTripStatus() == 3) {
                                $setstatus = "Rejected";
                            }elseif ($t->getTripStatus() == 4) {
                                $setstatus = "Cancelled";
                            }else{
                                $setstatus = "Closed";
                            }
                            array_push($tripdata, array(
                                "startDate"=>$t->getTripStartDate()->format("d-m-Y"),
                                "enddate"=>$t->getTripEndDate()->format("d-m-Y"),
                                "firstname"=>$t->getEmployee()->getFirstName(),
                                "lastname"=>$t->getEmployee()->getLastName(),
                                "empCode"=>$t->getEmployee()->getEmployeeCode(),
                                "type"=>$type,
                                "origin"=>$t->getTripOriginName(),
                                "destination"=>$t->getTripDestinationName(),
                                "reason"=>$t->getTripReason(),
                                "tripStatus"=>$setstatus,
                                "currency"=>$t->getCurrencies()->getName(),
                            ));
                        }
                    }
                    $this->data['trip'] = $tripdata;
                    
//                    $emp = \entities\EmployeeQuery::create()->findPk($employees);
//                    if($emp){
//                        $this->data['Name'] = $emp->getFirstName()." ".$emp->getLastName();
//                        $this->data['empcode'] = $emp->getEmployeeCode();
//                        $this->data['costnumber'] = $emp->getCostNumber();
//                        $this->data['Designation'] = $emp->getDesignations()->getDesignation();
//                        $this->data['Location'] = $emp->getBranch()->getBranchname()." | ".$emp->getBranch()->getOrgUnit()->getUnitName();
//                        $this->data['State'] = $emp->getBranch()->getOrgUnit()->getUnitName();
//                    }
                    
//                    $expense = \entities\TripsQuery::create()
//                            ->filterByTripStartDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
//                            ->filterByTripStartDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
//                            ->groupByEmployeeId()
//                            ->find();
//                    $data = [];
//                    if($expense){
//                        foreach ($expense as $ee){
//                            $data[$ee->getEmployeeId()] = $ee->getEmployee()->getFirstName()." ".$ee->getEmployee()->getLastName()." | ".$ee->getEmployee()->getEmployeeCode();
//                            
//                        }
//                    }
//                    $emp = \entities\EmployeeQuery::create()->findPk($employees);
//                    
//                    
//                    $emplist = FormMgr::select()->options($data);
                    $this->data['status'] = $status;
                    $monthSelection = FormMgr::select()->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths(10));
                    $monthSelection->val($this->app->Request()->getParameter("month"));                    
                    $this->data['monthList'] = $monthSelection->html();                               
                    $this->data['month'] = $this->app->Request()->getParameter("month","|");
                    
                    //$this->data['reportname'] = date("F Y", strtotime($fromdate));
                    
                    $dataCurrency->val($currency);                  
                    $this->data['currency'] = $dataCurrency->html();
                    $dataStatus->val($status);
                    $this->data['status'] = $dataStatus->html();
                    
//                    $emplist->val($employees);                  
//                    $this->data['empList'] = $emplist->html();
//                    $this->data['empcount'] = count($data);
                    
                    $this->data['fromdate'] = $fromdate;
                    $this->data['todate'] = $todate;
                    $this->app->Renderer()->render("hr/reports/emptripList.twig",$this->data);
                    
                break;
                
        endswitch;   
    }
    public function adminReports() {
        $action = $this->app->Request()->getParameter("action","");
        
        
        
        switch ($action) :
            case "":
                $month = explode("|",date("Y-m-1")."|".date("Y-m-31"));
                $orgUnitId = $this->app->Request()->getParameter("orgunit");

                $this->data['monthList'] = FormMgr::select()
                    ->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths(10))
                    ->html(); 
                $orgUnit = \entities\OrgUnitQuery::create()
                                ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
                                ->find()->toKeyValue("Orgunitid","UnitName");

                $this->data['orgUnit'] = FormMgr::select()
                    ->options([0=>"Select Division"] + $orgUnit)
                    ->html(); 
                $this->data['reportname'] = date("F Y");
                
                
                $this->app->Renderer()->render("hr/reports/adminReports.twig",$this->data);
                break;
            
            case "load":
                    $month = explode("|",$this->app->Request()->getParameter("month","|"));
                    $orgUnitId = $this->app->Request()->getParameter("orgunit");
                    
                    $expensedata = array();
                    $employee = \entities\ExpensesQuery::create()
                            ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                            ->filterByOrgunitId($orgUnitId)
                            ->groupByEmployeeId()
                            ->find();
                            
                    
                    if($employee){
                        foreach ($employee as $e){
                        $trip = 0;
                        $Created = 0;
                        $Submited = 0;
                        $Approved = 0;
                        $Rejected = 0;
                        $Audited = 0;
                            $expenses = \entities\ExpensesQuery::create()
                                ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                                ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                                ->filterByOrgunitId($orgUnitId)
                                ->filterByEmployeeId($e->getEmployeeId())
                                ->find();
                            if($expenses){
                                foreach ($expenses as $ex){
                                    if($ex->getExpenseReqAmt() > 0){
                                        if($ex->getExpenseStatus() == 1){
                                            $Created++;
                                        }
                                        if($ex->getExpenseStatus() == 2){
                                            $Submited++;
                                        }
                                        if($ex->getExpenseStatus() == 3){
                                            $Approved++;
                                        }
                                        if($ex->getExpenseStatus() == 4){
                                            $Rejected++;
                                        }
                                        if($ex->getExpenseStatus() == 10){
                                            $Audited++;
                                        }
                                    }
                                    
                                }
                            }
                            array_push($expensedata, array(
                                "empId"=>$e->getEmployeeId(),
                                "empName"=>$e->getEmployee()->getFirstName()." ".$e->getEmployee()->getLastName()." [".$e->getEmployee()->getEmployeeCode()."]",
                                "designation"=>$e->getEmployee()->getDesignations()->getDesignation(),
                                "branch"=>$e->getEmployee()->getBranch()->getBranchname()." | ".$e->getEmployee()->getBranch()->getGeoState()->getSstatename(),
                                "expenses"=>$expenses->count(),
                                "Created"=>$Created,
                                "Submited"=>$Submited,
                                "Approved"=>$Approved,
                                "Rejected"=>$Rejected,
                                "Audited"=>$Audited,
                                "currency"=>$e->getCurrencies()->getCurrencyId()
                            ));
                        }
                    }
                    
                    $this->data['expensedata'] = $expensedata;
                    $monthSelection = FormMgr::select()->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths(10));
                    $monthSelection->val($this->app->Request()->getParameter("month"));                    
                    $this->data['monthList'] = $monthSelection->html();
                    
                    $orgUnit = \entities\OrgUnitQuery::create()
                                ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
                                ->find()->toKeyValue("Orgunitid","UnitName");

                    $orgunitSelection = FormMgr::select()->options($orgUnit);
                    $orgunitSelection->val($this->app->Request()->getParameter("orgunit"));                    
                    $this->data['orgUnit'] = $orgunitSelection->html();

                    $this->data['month'] = $this->app->Request()->getParameter("month","|");
                    $this->data['orgunit'] = $this->app->Request()->getParameter("orgunit");
                    
                    $this->app->Renderer()->render("hr/reports/adminReports.twig",$this->data);
                    
                break;
        endswitch;   
    }
    public function adminEmpData() {
        $dataCurrency = FormMgr::select()
                    ->options(\entities\Base\CurrenciesQuery::create()->find()->toKeyValue("CurrencyId","Name"));
                    
        
                    $month = explode("|",$this->app->Request()->getParameter("month","|"));
                    $employees = $this->app->Request()->getParameter("empSelect");
                    $currency = $this->app->Request()->getParameter("currency");
                    $status = $this->app->Request()->getParameter("status");
                    //var_dump($month); exit;
                    $expenses = \entities\ExpensesQuery::create()
                            ->joinWithBudgetGroup()
                            ->filterByExpenseStatus($status)
                            ->filterByTripCurrency($currency)
                            ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)                    
                            ->filterByEmployeeId($employees);
                    $expenses->find();
                    
                    $expense = \entities\ExpensesQuery::create()
                            ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                            ->groupByEmployeeId()
                            ->find();
                    $data = [];
                    if($expense){
                        foreach ($expense as $ee){
                            $data[$ee->getEmployeeId()] = $ee->getEmployee()->getFirstName()." ".$ee->getEmployee()->getLastName()." | ".$ee->getEmployee()->getEmployeeCode();
                            
                        }
                    }
                    $emplist = FormMgr::select()->options($data);
                    
                    $reportData = [];
                    $taxArray = [];
                    $claimedAmount = 0;
                    $add = 0;
                    $gst = 0;
                    $didbyapprover = 0;
                    $audididAmount = 0;
                    $finalAmount = 0;
                    $cmpcardAmount = 0;
                    $dedAuditorAmount = 0;
                    $addAuditorAmount = 0;
                    $temp = 0;
                    if($expenses->find()){
                        foreach($expenses as $e)
                        {
                            $list = $e->getExpenseLists();
                            foreach($list as $l)                                
                            {
                                
                                if(!isset($taxArray[$l->getExpMasterId()])) {
                                    $taxArray[$l->getExpMasterId()]['claimedAmount'] = 0;
                                    $taxArray[$l->getExpMasterId()]['cmpcardAmount'] = 0;
                                    $taxArray[$l->getExpMasterId()]['add'] = 0;
                                    $taxArray[$l->getExpMasterId()]['gst'] = 0;
                                    $taxArray[$l->getExpMasterId()]['didbyapprover'] = 0;
                                    $taxArray[$l->getExpMasterId()]['audididAmount'] = 0;
                                    $taxArray[$l->getExpMasterId()]['finalAmount'] = 0;
                                }
                                
                                if (array_key_exists($l->getExpMasterId(),$taxArray))
                                {
                                    $taxArray[$l->getExpMasterId()]['particulars'] = $l->getExpenseMaster()->getExpenseName();
                                    
                                    $taxArray[$l->getExpMasterId()]['claimedAmount'] += $l->getExpIlAmount();
                                    $taxArray[$l->getExpMasterId()]['add'] += $l->getExpReqAmount();
                                    $taxArray[$l->getExpMasterId()]['gst'] += $l->getExpTaxAmount();
                                    $taxArray[$l->getExpMasterId()]['didbyapprover'] += $l->getExpAprAmount();
                                    $taxArray[$l->getExpMasterId()]['audididAmount'] += $l->getExpAuditAmount();
                                    $taxArray[$l->getExpMasterId()]['finalAmount'] += $l->getExpFinalAmount();
                                    if($l->getCmpCard() == 1){
                                        $taxArray[$l->getExpMasterId()]['cmpcardAmount'] += $l->getExpFinalAmount();
                                    }
                                }
                                else
                                {
                                    $taxArray[$l->getExpMasterId()]['particulars'] = $l->getExpenseMaster()->getExpenseName();
                                    
                                    $taxArray[$l->getExpMasterId()]['claimedAmount'] = $l->getExpIlAmount();
                                    $taxArray[$l->getExpMasterId()]['add'] = $l->getExpReqAmount();
                                    $taxArray[$l->getExpMasterId()]['gst'] = $l->getExpTaxAmount();
                                    $taxArray[$l->getExpMasterId()]['didbyapprover'] = $l->getExpAprAmount();
                                    $taxArray[$l->getExpMasterId()]['audididAmount'] = $l->getExpAuditAmount();
                                    $taxArray[$l->getExpMasterId()]['finalAmount'] = $l->getExpFinalAmount();
                                    if($l->getCmpCard() == 1){
                                        $taxArray[$l->getExpMasterId()]['cmpcardAmount'] = $l->getExpFinalAmount();
                                    }
                                }
                                
                                $claimedAmount += $l->getExpIlAmount();
                                $add += $l->getExpReqAmount();
                                $gst += $l->getExpTaxAmount();
                                $didbyapprover += $l->getExpAprAmount();
                                
                                $temp = $l->getExpAprAmount() - $l->getExpAuditAmount();
                                if($temp > 0 && $l->getExpAuditAmount() != 0) {
                                    $dedAuditorAmount += $temp;
                                } else if ($l->getExpAuditAmount() != 0) {
                                    $addAuditorAmount += $temp;
                                }
                                                                
                                $audididAmount += $l->getExpAuditAmount();
                                $finalAmount += $l->getExpFinalAmount();
                                if($l->getCmpCard() == 1){
                                    $cmpcardAmount += $l->getExpFinalAmount();
                                }
                            }
                            
                        }
//                        exit;
                        //var_dump($expenses->count()); exit;
                    }
                    $emp = \entities\EmployeeQuery::create()->findPk($employees);
                    if($emp){
                        $this->data['Name'] = $emp->getFirstName()." ".$emp->getLastName();
                        $this->data['empcode'] = $emp->getEmployeeCode();
                        $this->data['costnumber'] = $emp->getCostNumber();
                        $this->data['Designation'] = $emp->getDesignations()->getDesignation();
                        $this->data['Location'] = $emp->getBranch()->getBranchname()." | ".$emp->getBranch()->getGeoState()->getSstatename();
                        $this->data['State'] = $emp->getBranch()->getGeoState()->getSstatename();
                    }
                    $this->data['status'] = $status;
                    $this->data['heads'] = $taxArray;
                    $this->data['claimedAmount'] = $claimedAmount;
                    $this->data['add'] = $add;
                    $this->data['gst'] = $gst;
                    $this->data['didbyapprover'] = $didbyapprover; 
                    $this->data['audididAmount'] = $audididAmount; 
                    $this->data['finalAmount'] = $finalAmount; 
                    $this->data['addAuditorAmount'] = $addAuditorAmount;
                    $this->data['dedAuditorAmount'] = $dedAuditorAmount;
                    $this->data['cmpcardAmount'] = $cmpcardAmount;
                    $monthSelection = FormMgr::select()->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths(10));
                    
                    $monthSelection->val($this->app->Request()->getParameter("month"));                    
                    $this->data['monthList'] = $monthSelection->html();                               
                    $this->data['month'] = $this->app->Request()->getParameter("month","|");
                    $this->data['reportname'] = date("F Y", strtotime($month[0]));
                    $dataCurrency->val($currency);                  
                    $this->data['currency'] = $dataCurrency->html();
                    $emplist->val($employees);                  
                    $this->data['empList'] = $emplist->html();
                    $this->data['empcount'] = count($data);
                    //var_dump($this->data['empcount']);exit;
                    $this->app->Renderer()->render("hr/reports/empSummaryReports.twig",$this->data);
                    
                
    }
    public function payoutReport() {
        
        
        $months = \Modules\ESS\Runtime\EssHelper::getAllowedMonths(1);
        
        if($this->app->Request()->getParameter("month") == 'lastmonth')
        {
            $months = \Modules\ESS\Runtime\EssHelper::getAllowedMonths(2);
        }
        
        foreach($months as $key => $val){
            $month = explode('|', $key);
        }
        
        $CompanyId = $this->app->Auth()->getUser()->getCompanyId();
        $i = 0;
        
        
                
        $reportstatus = $this->app->Request()->getParameter("reportstatus",1);                
        $fromdate = $this->app->Request()->getParameter("fromdate", \DateTime::createFromFormat('Y-m-d', $month[0])->format('d/m/Y'));
        $todate = $this->app->Request()->getParameter("todate",\DateTime::createFromFormat('Y-m-d', $month[1])->format('d/m/Y'));
                   
            
        
        
                    $StartDate =  \DateTime::createFromFormat("d/m/Y", $fromdate);
                    $EndDate = \DateTime::createFromFormat("d/m/Y", $todate);
                    $Requestetotal = 0;
                    $Apprrovedtotal = 0;
                    $Auditedtotal = 0;
                    
                    $payoutdata = array();
                    $employeeid = 0;
                    if($this->app->Auth()->checkPerm("ess_org_admin")){
                        
                        $employeeid = \Modules\HR\Runtime\HrHelper::getESSOrgAdminEmployee($this->app->Auth()->CompanyId());
                    }
                    
                    if($this->app->Auth()->checkPerm("ess_branch_admin")){
                        
                        $employeeid = \Modules\HR\Runtime\HrHelper::getESSBranchAdminEmployee($this->app->Auth()->getUser()->getEmployee()->getBranchId());
                    }
                    
                    $entity = \entities\ExpensesQuery::create()
                            ->filterByEmployeeId($employeeid)
                            ->filterByExpenseDate($StartDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByExpenseDate($EndDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                            ->find();
                    
                    if($entity){
                        foreach ($entity as $e){
                            if($reportstatus == 1){
                                $data = $e->getEmployee()->getBranchId();
                            }else{
                                $data = $e->getEmployee()->getDesignationId();
                            }
                            if(!isset($payoutdata[$data])) {
                                $payoutdata[$data]['name'] = 0;
                                $payoutdata[$data]['Requested'] = 0;
                                $payoutdata[$data]['Apprroved'] = 0;
                                $payoutdata[$data]['Audited'] = 0;
                            }
                            if(array_key_exists($data, $payoutdata)){
                                if($reportstatus == 1){
                                    $payoutdata[$data]['name'] = $e->getEmployee()->getBranch()->getBranchname()."-".$e->getEmployee()->getBranch()->getOrgUnit()->getUnitName();
                                    $payoutdata[$data]['id'] = $data;
                                }else{
                                    $payoutdata[$data]['name'] = $e->getEmployee()->getDesignations()->getDesignation();
                                }
                                $payoutdata[$data]['Requested'] += $e->getExpenseReqAmt();
                                $payoutdata[$data]['Apprroved'] += $e->getExpenseApprovedAmt();
                                $payoutdata[$data]['Audited'] += $e->getExpenseFinalAmt();
                                
                            } else {
                                $payoutdata[$data]['Requested'] = $e->getExpenseReqAmt();
                                $payoutdata[$data]['Apprroved'] = $e->getExpenseApprovedAmt();
                                $payoutdata[$data]['Audited'] = $e->getExpenseFinalAmt();
                                
                            }
                            $Requestetotal += $e->getExpenseReqAmt();
                            $Apprrovedtotal += $e->getExpenseApprovedAmt();
                            $Auditedtotal += $e->getExpenseFinalAmt();
                        }
                        
                    }
                    
                    $this->data['Requestetotal'] = $Requestetotal;
                    $this->data['Apprrovedtotal'] = $Apprrovedtotal;
                    $this->data['Auditedtotal'] = $Auditedtotal;
                    $this->data['data'] = $payoutdata;
                    $this->data['reportstatus'] = $reportstatus;
                    $this->data['fromdate'] = $fromdate;
                    $this->data['todate'] = $todate;
                    
                    $this->app->Renderer()->render("hr/reports/payoutReport.twig",$this->data);
        
    }
    
    
    public function employeePayoutReport($branchId) {
        
        
        $months = \Modules\ESS\Runtime\EssHelper::getAllowedMonths(1);
        
        if($this->app->Request()->getParameter("month") == 'lastmonth')
        {
            $months = \Modules\ESS\Runtime\EssHelper::getAllowedMonths(2);
        }
        
        foreach($months as $key => $val){
            $month = explode('|', $key);
        }
        
        $CompanyId = $this->app->Auth()->getUser()->getCompanyId();
        $i = 0;
        
        
                
        $reportstatus = $this->app->Request()->getParameter("reportstatus",1);                
        $fromdate = $this->app->Request()->getParameter("fromdate", \DateTime::createFromFormat('Y-m-d', $month[0])->format('d/m/Y'));
        $todate = $this->app->Request()->getParameter("todate",\DateTime::createFromFormat('Y-m-d', $month[1])->format('d/m/Y'));
                   
            
        
        
                    $StartDate =  \DateTime::createFromFormat("d/m/Y", $fromdate);
                    $EndDate = \DateTime::createFromFormat("d/m/Y", $todate);
                    $Requestetotal = 0;
                    $Apprrovedtotal = 0;
                    $Auditedtotal = 0;
                    
                    $payoutdata = array();
                    $employeeid = 0;
                    if($this->app->Auth()->checkPerm("ess_org_admin")){
                        
                        $employeeid = \Modules\HR\Runtime\HrHelper::getESSOrgAdminEmployee($this->app->Auth()->CompanyId());
                    }
                    $entity = \entities\ExpensesQuery::create()
                            ->filterByEmployeeId($employeeid)
                            ->filterByExpenseDate($StartDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByExpenseDate($EndDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                            ->find();
                    
                    if($entity){
                        foreach ($entity as $e){
                            if($reportstatus == 1){
                                $data = $e->getEmployee()->getBranchId();
                            }else{
                                $data = $e->getEmployee()->getDesignationId();
                            }
                            if(!isset($payoutdata[$data])) {
                                $payoutdata[$data]['name'] = 0;
                                $payoutdata[$data]['Requested'] = 0;
                                $payoutdata[$data]['Apprroved'] = 0;
                                $payoutdata[$data]['Audited'] = 0;
                            }
                            if(array_key_exists($data, $payoutdata)){
                                if($reportstatus == 1){
                                    $payoutdata[$data]['name'] = $e->getEmployee()->getBranch()->getBranchname()."-".$e->getEmployee()->getBranch()->getOrgUnit()->getUnitName();
                                }else{
                                    $payoutdata[$data]['name'] = $e->getEmployee()->getDesignations()->getDesignation();
                                }
                                $payoutdata[$data]['Requested'] += $e->getExpenseReqAmt();
                                $payoutdata[$data]['Apprroved'] += $e->getExpenseApprovedAmt();
                                $payoutdata[$data]['Audited'] += $e->getExpenseFinalAmt();
                                
                            } else {
                                $payoutdata[$data]['Requested'] = $e->getExpenseReqAmt();
                                $payoutdata[$data]['Apprroved'] = $e->getExpenseApprovedAmt();
                                $payoutdata[$data]['Audited'] = $e->getExpenseFinalAmt();
                                
                            }
                            $Requestetotal += $e->getExpenseReqAmt();
                            $Apprrovedtotal += $e->getExpenseApprovedAmt();
                            $Auditedtotal += $e->getExpenseFinalAmt();
                        }
                        
                    }
                    
                    $this->data['Requestetotal'] = $Requestetotal;
                    $this->data['Apprrovedtotal'] = $Apprrovedtotal;
                    $this->data['Auditedtotal'] = $Auditedtotal;
                    $this->data['data'] = $payoutdata;
                    $this->data['reportstatus'] = $reportstatus;
                    $this->data['fromdate'] = $fromdate;
                    $this->data['todate'] = $todate;
                    
                    $this->app->Renderer()->render("hr/reports/payoutReport.twig",$this->data);
        
    }
    
    public function budgetReport() {
        $months = \Modules\ESS\Runtime\EssHelper::getAllowedMonths(1);
        
        if($this->app->Request()->getParameter("month") == 'lastmonth')
        {
            $months = \Modules\ESS\Runtime\EssHelper::getAllowedMonths(2);
        }
        
        foreach($months as $key => $val){
            $month = explode('|', $key);
        }
        
        $CompanyId = $this->app->Auth()->getUser()->getCompanyId();
        $i = 0;
        
        
                
        $reportstatus = $this->app->Request()->getParameter("reportstatus",1);                
        $fromdate = $this->app->Request()->getParameter("fromdate", \DateTime::createFromFormat('Y-m-d', $month[0])->format('d/m/Y'));
        $todate = $this->app->Request()->getParameter("todate",\DateTime::createFromFormat('Y-m-d', $month[1])->format('d/m/Y'));
                  
        $StartDate =  \DateTime::createFromFormat("d/m/Y", $fromdate);
        $EndDate = \DateTime::createFromFormat("d/m/Y", $todate);
                    $Requestetotal = 0;
                    $Apprrovedtotal = 0;
                    $Auditedtotal = 0;
                    
                    $payoutdata = array();
                    $employeeid = 0;
                    if($this->app->Auth()->checkPerm("ess_org_admin")){
                        
                        $employeeid = \Modules\HR\Runtime\HrHelper::getESSOrgAdminEmployee($this->app->Auth()->CompanyId());
                    }
                    $entity = \entities\ExpensesQuery::create()
                            ->filterByEmployeeId($employeeid)
                            ->filterByExpenseDate($StartDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByExpenseDate($EndDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                            ->find();
                    if($entity){
                        foreach ($entity as $e){
                            
                            $data = $e->getBudgetId();
                            if(!isset($payoutdata[$data])) {
                                $payoutdata[$data]['name'] = 0;
                                $payoutdata[$data]['id'] = 0;
                                $payoutdata[$data]['Requested'] = 0;
                                $payoutdata[$data]['Apprroved'] = 0;
                                $payoutdata[$data]['Audited'] = 0;
                            }
                            if(array_key_exists($data, $payoutdata)){
                                
                                $payoutdata[$data]['name'] = $e->getBudgetGroup()->getGroupName()." | ".$e->getBudgetGroup()->getGroupcode();
                                $payoutdata[$data]['id'] = $e->getBudgetId();
                                $payoutdata[$data]['Requested'] += $e->getExpenseReqAmt();
                                $payoutdata[$data]['Apprroved'] += $e->getExpenseApprovedAmt();
                                $payoutdata[$data]['Audited'] += $e->getExpenseFinalAmt();
                                
                            } else {
                                $payoutdata[$data]['Requested'] = $e->getExpenseReqAmt();
                                $payoutdata[$data]['Apprroved'] = $e->getExpenseApprovedAmt();
                                $payoutdata[$data]['Audited'] = $e->getExpenseFinalAmt();
                                
                            }
                            $Requestetotal += $e->getExpenseReqAmt();
                            $Apprrovedtotal += $e->getExpenseApprovedAmt();
                            $Auditedtotal += $e->getExpenseFinalAmt();
                        }
                        
                    }
                    
                    $this->data['Requestetotal'] = $Requestetotal;
                    $this->data['Apprrovedtotal'] = $Apprrovedtotal;
                    $this->data['Auditedtotal'] = $Auditedtotal;
                    $this->data['data'] = $payoutdata;
                    $this->data['reportstatus'] = $reportstatus;
                    $this->data['fromdate'] = $fromdate;
                    $this->data['todate'] = $todate;
                    $this->app->Renderer()->render("hr/reports/budgetReport.twig",$this->data);
                    
                
    }
    public function singleio($budgetId) {
        $action = $this->app->Request()->getParameter("action","");
        
        switch ($action) :
            case "":
                $this->app->Renderer()->render("hr/reports/singleioReport.twig",$this->data);
                break;
            
            case "load":
                    $reportstatus = $this->app->Request()->getParameter("reportstatus");
                    $fromdate = $this->app->Request()->getParameter("fromdate");
                    $todate = $this->app->Request()->getParameter("todate");
                    $StartDate =  \DateTime::createFromFormat("d/m/Y", $fromdate);
                    $EndDate = \DateTime::createFromFormat("d/m/Y", $todate);
                    $Requestetotal = 0;
                    $Apprrovedtotal = 0;
                    $Auditedtotal = 0;
                    
                    $payoutdata = array();
                    $employeeid = 0;
                    if($this->app->Auth()->checkPerm("ess_org_admin")){
                        
                        $employeeid = \Modules\HR\Runtime\HrHelper::getESSOrgAdminEmployee($this->app->Auth()->CompanyId());
                    }
                    $entity = \entities\ExpensesQuery::create()
                            ->filterByBudgetId($budgetId)
                            ->filterByEmployeeId($employeeid)
                            ->filterByExpenseDate($StartDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByExpenseDate($EndDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                            ->find();
                    if($entity){
                        foreach ($entity as $e){
                            
                            $data = $e->getEmployee()->getBranchId();
                            if(!isset($payoutdata[$data])) {
                                $payoutdata[$data]['branchName'] = 0;
                                $payoutdata[$data]['Requested'] = 0;
                                $payoutdata[$data]['Apprroved'] = 0;
                                $payoutdata[$data]['Audited'] = 0;
                            }
                            if(array_key_exists($data, $payoutdata)){
                                
                                $payoutdata[$data]['branchName'] = $e->getEmployee()->getBranch()->getBranchname()."-".$e->getEmployee()->getBranch()->getOrgUnit()->getUnitName();
                                $payoutdata[$data]['Requested'] += $e->getExpenseReqAmt();
                                $payoutdata[$data]['Apprroved'] += $e->getExpenseApprovedAmt();
                                $payoutdata[$data]['Audited'] += $e->getExpenseFinalAmt();
                                
                            } else {
                                $payoutdata[$data]['Requested'] = $e->getExpenseReqAmt();
                                $payoutdata[$data]['Apprroved'] = $e->getExpenseApprovedAmt();
                                $payoutdata[$data]['Audited'] = $e->getExpenseFinalAmt();
                                
                            }
                            $Requestetotal += $e->getExpenseReqAmt();
                            $Apprrovedtotal += $e->getExpenseApprovedAmt();
                            $Auditedtotal += $e->getExpenseFinalAmt();
                        }
                        
                    }
                    
                    $this->data['Requestetotal'] = $Requestetotal;
                    $this->data['Apprrovedtotal'] = $Apprrovedtotal;
                    $this->data['Auditedtotal'] = $Auditedtotal;
                    $this->data['data'] = $payoutdata;
                    $this->data['fromdate'] = $fromdate;
                    $this->data['todate'] = $todate;
                    $this->app->Renderer()->render("hr/reports/singleioReport.twig",$this->data);
                    
                break;
                
        endswitch;
    }
    public function companyCardReports() {
        $action = $this->app->Request()->getParameter("action","");
        $units = \Modules\HR\Runtime\HrHelper::getAllowedUnits($this->app->Auth()->getUser()->getEmployee());
        $dataCurrency = FormMgr::select()
                    ->options(\entities\Base\CurrenciesQuery::create()->find()->toKeyValue("CurrencyId","Name"));
        $dataStatus = FormMgr::select()->options(WorkflowManager::getStatusList("Trips"));
        $status = 8;
        
        switch ($action) :
            case "":
                $month = explode("|",date("Y-m-1")."|".date("Y-m-31"));
                $this->data['monthList'] = FormMgr::select()
                    ->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths(10))
                    ->html();
                $this->data['status'] = $dataStatus->html();
                $this->data['currency'] = $dataCurrency->html();
                $this->data['reportname'] = date("F Y");
                
                
                $this->app->Renderer()->render("hr/reports/empccReports.twig",$this->data);
                break;
            case "load":
                    
                    
                    $fromdate = $this->app->Request()->getParameter("fromdate");
                    $todate = $this->app->Request()->getParameter("todate");
                    $status = $this->app->Request()->getParameter("status");
                    $currency = $this->app->Request()->getParameter("currency");
                    
                    $StartDate =  \DateTime::createFromFormat("d/m/Y", $this->app->Request()->getParameter("fromdate"));
                    $EndDate = \DateTime::createFromFormat("d/m/Y", $this->app->Request()->getParameter("todate"));
                    
                    $payoutdata = array();
                    $expenses = \entities\ExpensesQuery::create()
                            ->filterByExpenseDate($StartDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByExpenseDate($EndDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                            ->filterByExpenseStatus(10)
                            ->find();
                    if($expenses){
                        foreach ($expenses as $e){
                            $company = $e->getExpenseLists();
                            foreach ($company as $c){
                                $requested = 0;
                                $approved = 0;
                                $final = 0;
                                if($c->getCmpCard() == 1){
                                    $requested = $c->getExpIlAmount()+$c->getExpTaxAmount()+$c->getExpReqAmount();
                                    $approved = $c->getExpAprAmount();
                                    $final = $c->getExpFinalAmount();
                                    array_push($payoutdata, array(
                                        "date"=>$c->getExpDate()->format('d-m-Y'),
                                        "empFirstName"=>$c->getExpenses()->getEmployee()->getFirstName(),
                                        "empLastName"=>$c->getExpenses()->getEmployee()->getLastName(),
                                        "empCode"=>$c->getExpenses()->getEmployee()->getEmployeeCode(),
                                        "Designation"=>$c->getExpenses()->getEmployee()->getDesignations()->getDesignation(),
                                        "hq"=>$c->getExpenses()->getEmployee()->getBranch()->getBranchname()." | ".$c->getExpenses()->getEmployee()->getBranch()->getOrgUnit()->getUnitName(),
                                        "exphead"=>$c->getExpenseMaster()->getExpenseName(),
                                        "requested"=>$requested,
                                        "approved"=>$approved,
                                        "final"=>$final,
                                        "note"=>$c->getExpRemark(),
                                    ));
                                }
                            }
                        }
                    }
                    $this->data['data'] = $payoutdata;
                    $this->data['fromdate'] = $fromdate;
                    $this->data['todate'] = $todate;
                    $this->app->Renderer()->render("hr/reports/empccReports.twig",$this->data);
                    
                break;
                
        endswitch; 
    }
    public function empPayoutReport($branchid) {
        $action = $this->app->Request()->getParameter("action","");
        
        switch ($action) :
            case "":
                $this->app->Renderer()->render("hr/reports/empPayoutReport.twig",$this->data);
                break;
            
            case "load":
                    $reportstatus = $this->app->Request()->getParameter("reportstatus");
                
                    $fromdate = \DateTime::createFromFormat("d/m/Y", $this->app->Request()->getParameter("fromdate"));
                    $todate = \DateTime::createFromFormat("d/m/Y", $this->app->Request()->getParameter("todate"));
                    $Requestetotal = 0;
                    $Apprrovedtotal = 0;
                    $Auditedtotal = 0;
                    
                    $payoutdata = array();
                    $employeeid = 0;
                    
                    if($this->app->Auth()->checkPerm("ess_org_admin")){
                        //$orgUnitId = $this->app->Auth()->getUser()->getEmployee()->getOrgUnitId();
                        $employeeid = \Modules\HR\Runtime\HrHelper::getESSOrgAdminEmployee($this->app->Auth()->CompanyId());
                    }
                    
                    if($this->app->Auth()->checkPerm("ess_branch_admin")){                        
                        $employeeid = \Modules\HR\Runtime\HrHelper::getESSBranchAdminEmployee($branchid);
                    }


                    $entity = \entities\ExpensesQuery::create()
                            ->filterByEmployeeId($employeeid)
                            ->filterByExpenseDate($fromdate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByExpenseDate($todate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                            ->find();
                    
                    if($entity){
                        foreach ($entity as $e){
                            
                            $data = $e->getEmployeeId();
                            if(!isset($payoutdata[$data])) {
                                $payoutdata[$data]['name'] = "";
                                $payoutdata[$data]['id'] = "";
                                $payoutdata[$data]['Requested'] = 0;
                                $payoutdata[$data]['Apprroved'] = 0;
                                $payoutdata[$data]['Audited'] = 0;
                            }
                            if(array_key_exists($data, $payoutdata)){
                                $payoutdata[$data]['name'] = $e->getEmployee()->getFirstName()." ".$e->getEmployee()->getLastName();
                                $payoutdata[$data]['employeeid'] = $e->getEmployeeId();
                                
                                $payoutdata[$data]['Requested'] += $e->getExpenseReqAmt();
                                $payoutdata[$data]['Apprroved'] += $e->getExpenseApprovedAmt();
                                $payoutdata[$data]['Audited'] += $e->getExpenseFinalAmt();
                                
                            } else {
                                
                                $payoutdata[$data]['Requested'] += $e->getExpenseReqAmt();
                                $payoutdata[$data]['Apprroved'] += $e->getExpenseApprovedAmt();
                                $payoutdata[$data]['Audited'] += $e->getExpenseFinalAmt();
                            }
                            
                            $Requestetotal += $e->getExpenseReqAmt();
                            $Apprrovedtotal += $e->getExpenseApprovedAmt();
                            $Auditedtotal += $e->getExpenseFinalAmt();
                            
                        }
                        
                    }
                    
                    $this->data['Requestetotal'] = $Requestetotal;
                    $this->data['Apprrovedtotal'] = $Apprrovedtotal;
                    $this->data['Auditedtotal'] = $Auditedtotal;
                    $this->data['data'] = $payoutdata;
                    $this->data['reportstatus'] = $reportstatus;
                    $this->data['fromdate'] = $this->app->Request()->getParameter("fromdate");
                    $this->data['todate'] = $this->app->Request()->getParameter("todate");
                    $this->app->Renderer()->render("hr/reports/empPayoutReport.twig",$this->data);
                    
                break;
                
        endswitch;
    }
}    