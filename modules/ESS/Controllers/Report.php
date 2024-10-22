<?php declare(strict_types = 1);

namespace Modules\ESS\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use entities\GeoCityQuery;
use entities\GeoStateQuery;
use entities\GeoTownsQuery;

class Report extends \App\Core\BaseController 
{	               
    protected $app;
    
    public function __construct(App $app)
    {
            $this->app = $app;		
    }
    public function claimReport()
    {
        $action = $this->app->Request()->getParameter("action","");
        $units = \Modules\HR\Runtime\HrHelper::getAllowedUnits($this->app->Auth()->getUser()->getEmployee());
        $currencyArray = \entities\Base\CurrenciesQuery::create()->find()->toKeyValue("CurrencyId","Name");
        $dataCurrency = FormMgr::select()->options($currencyArray);
        
        $empid = $this->app->Request()->getParameter("empid",$this->app->Auth()->getUser()->getEmployee()->getEmployeeId());
              
        $status = array(10,11);
        $emp = \entities\EmployeeQuery::create()->findPk($empid);

        if ($emp->getItownid() != null) {
            $statename = GeoTownsQuery::create()
                ->select(['GeoState.Sstatename'])
                ->joinWith('GeoCity')
                ->joinWith('GeoState')
                ->filterByItownid($emp->getItownid())
                ->findOne();
        } else {
            $statename = '';
        }
       

        $this->data['Name'] = $emp->getFirstName()." ".$emp->getLastName();
        $this->data['empcode'] = $emp->getEmployeeCode();
        $this->data['costnumber'] = $emp->getCostNumber();
        $this->data['Designation'] = $emp->getDesignations()->getDesignation();
        //$this->data['Location'] = $emp->getBranch()->getBranchname()." | ".$emp->getBranch()->getGeoState()->getSstatename();
        $this->data['Location'] = $emp->getBranch()->getBranchname()." | ". $statename;
       // $this->data['State'] = $emp->getBranch()->getGeoState()->getSstatename();
        $this->data['State'] = $statename;
        $this->data['status'] = $status;
        switch ($action) :
            case "":
                $this->data['monthList'] = FormMgr::select()
                    ->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths(10))
                    ->html();           
                //$this->data['currency'] = $dataCurrency->html();
                $this->data['reportname'] = date("F Y");
                $this->app->Renderer()->render("ess/reports/summaryReport.twig",$this->data);
                break;
            case "loadCurrency":
                
                $month = explode("|",$this->app->Request()->getParameter("month","|"));
                $dataCurrency = FormMgr::select()->options(\Modules\ESS\Runtime\EssHelper::getAllowedCurrency($empid,$month));
                $this->data['currency'] = $dataCurrency->html();
                $this->json( ["data" => $this->data]);
                
                break;
            case "load":
                    $month = explode("|",$this->app->Request()->getParameter("month","|"));
                    
                    $currency = 1;$this->app->Request()->getParameter("currency");
                    //$status = $this->app->Request()->getParameter("status");
                    
                    $expenses = \entities\ExpensesQuery::create()
                            ->joinWithBudgetGroup()                            
                            ->filterByExpenseStatus($status)
                            ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)                    
                            ->filterByEmployeeId($empid);
                    
                    // if($currency != ''){
                    //     $expenses->filterByTripCurrency($currency);
                    // }
                    $val = $expenses->find();
                    $reportData = [];
                    $taxArray = [];
                    $claimedAmount = 0;                    
                    $didbyapprover = 0;
                    $audididAmount = 0;
                    $finalAmount = 0;
                    $cmpcardAmount = 0;
                    $dedAuditorAmount = 0;
                    $addAuditorAmount = 0;
                    $temp = 0;
                    $ExpDetailsArray = [];
                    $ExpListArray = [];
                    if($expenses->find()){
                        foreach($expenses as $e)
                        {
                            
                            $list = $e->getExpenseLists();
                            
                            foreach($list as $l)                                
                            {  
                                
                                //$ExpListArray = [$l->getExpListId()];
                                
                                $expDetails = \entities\ExpenseListDetailsQuery::create()
                                                ->filterByExpListId([$l->getExpListId()])
                                                ->find()->toArray();
                                if($expDetails){
//                                    $expDetails['ExpId'] = $l->getExpId();
//                                    $expDetails['ExpDate'] = $l->getExpDate();
//                                    $expDetails[$l->getExpMasterId()]['ExpHead'] = $l->getExpenseMaster()->getExpenseName();
                                    array_push($ExpDetailsArray, $expDetails);
                                }
                                
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
                                    $taxArray[$l->getExpMasterId()]['explistid'] = $l->getExpListId();
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
                        
                        //var_dump($taxArray); exit;
                    }
                    $emp = \entities\EmployeeQuery::create()->findPk($empid);
                    
                    $exp_id = \entities\ExpensesQuery::create()
                        ->select('ExpId')
                        ->filterByEmployeeId($empid)                            
                        ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                        ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)                    
                        ->find()->toArray();
        
                    $tripWorklog = \entities\EmployeeWorkLogQuery::create()
                                    ->filterByExpId($exp_id)
                                    ->find();
                    
                    
                    
                    
                    
                    $this->data['status'] = $status;
                    $this->data['heads'] = $taxArray;
                    $this->data['claimedAmount'] = $claimedAmount;                    
                    $this->data['didbyapprover'] = $didbyapprover; 
                    $this->data['audididAmount'] = $audididAmount; 
                    $this->data['finalAmount'] = $finalAmount; 
                    $this->data['addAuditorAmount'] = $addAuditorAmount;
                    $this->data['dedAuditorAmount'] = $dedAuditorAmount;
                    $this->data['cmpcardAmount'] = $cmpcardAmount;
                    $this->data['currSelected'] = $currencyArray[$currency];
                    $this->data['tripWorklog'] = $tripWorklog;
                   
                    $this->data['expenseDetails'] = $ExpDetailsArray;
                    
                    $monthSelection = FormMgr::select()->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths(10));
                    
                
                    $monthSelection->val($this->app->Request()->getParameter("month"));                    
                    $this->data['monthList'] = $monthSelection->html();                               
                    $this->data['month'] = $this->app->Request()->getParameter("month","|");
                    $this->data['reportname'] = date("F Y", strtotime($month[0]));
                    $dataCurrency->val($currency);                  
                    $this->data['currency'] = $dataCurrency->html();
                    
                    
                    
                    //var_dump($this->data['reportname']);exit;
                    $this->app->Renderer()->render("ess/reports/summaryReport.twig",$this->data);
                    
                break;
        endswitch;
    }
    public function expensesReport(){
        $action = $this->app->Request()->getParameter("action","");
        $units = \Modules\HR\Runtime\HrHelper::getAllowedUnits($this->app->Auth()->getUser()->getEmployee());
        $heads = [];
        $heads_total = [];
        $rows = [];
        $km = [];
        $requested = 0;
        $approved = 0;
        $final = 0;
        $totalkm = 0;
        $Additional = 0;
        switch ($action) :
            case "":
                $this->data['monthList'] = FormMgr::select()
                    ->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths(10))
                    ->html();           
                $this->app->Renderer()->render("ess/reports/expensesReport.twig",$this->data);
                break;
            case "load":
                    $month = explode("|",$this->app->Request()->getParameter("month","|"));
                    
                    $expenses = \entities\ExpensesQuery::create()
                    ->filterByExpenseStatus(8) // Only Validated
                    ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)                    
                    ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployee()->getEmployeeId())
                    ->find();
                
                
                    if($expenses){
                        foreach($expenses as $e)
                        {
                            $list = $e->getExpenseLists();
                            foreach($list as $l)
                            {
                                if(!isset($heads[$l->getExpMasterId()]))
                                {
                                    $heads[$l->getExpMasterId()] = $l->getExpenseMaster()->getExpenseName();
                                    $heads_total[$l->getExpMasterId()] = 0;

                                }
                                $heads_total[$l->getExpMasterId()] += $l->getExpFinalAmount(); 

                                if(!isset($km[$l->getExpId()]))
                                {
                                    $km[$l->getExpId()] = $l->getExpRateQty();
                                }else{
                                    $km[$l->getExpId()] += $l->getExpRateQty();
                                }
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
                            // if($e->getExpenseTrip() > 0){
                            //     $trips = \entities\TripsQuery::create()
                            //     ->filterByTripId($e->getExpenseTrip())
                            //     ->findOne();
                            //     $origin = $trips->getTripOriginName();
                            //     $destination = $trips->getTripDestinationName();
                            //     $currency = $trips->getCurrencies()->getName();
                            // }

                            $r = [
                                "Expid" => $e->getPrimaryKey(),
                                "Date" => $e->getExpenseDate()->format("d-m-Y"),
                                "IO" => $e->getBudgetGroup()->getGroupName()." | ".$e->getBudgetGroup()->getGroupcode(),                        
                                "Final" => $e->getExpenseFinalAmt(),
                                "Tax" => $e->getExpenseTaxAmt(),
                                "Exp" => $e->getExpenseLists()->toKeyIndex("ExpMasterId"),
                                "isWeekend" => $isWeekend,
                                "Days"=>$e->getExpenseDate()->format("D"),
                                "origincity"=>$origin,
                                "destinationcity"=>$destination,
                                "working"=>$e->getExpensePlacewrk(),
                                "km"=>$km[$e->getPrimaryKey()],
                                "Currency" =>$currency,
                            ];

                            array_push($rows, $r);
                            $final += $e->getExpenseFinalAmt(); 
                            
                            $this->data['title'] = $e->getEmployee()->getFirstName()." ".$e->getEmployee()->getLastName()." | ".$e->getEmployee()->getEmployeeCode()." | ".$e->getEmployee()->getBranch()->getBranchname()." | ".$e->getEmployee()->getDesignations()->getDesignation();
                        } 

                    }

                    $this->data['ExpenseFinalAmt'] = $final;                
                    $this->data['heads'] = $heads;
                    $this->data['rows'] = $rows;
                    $this->data['headcount'] = count($heads);
                    
                    $monthSelection = FormMgr::select()->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths(10));
                    
                    $monthSelection->val($_POST['month']);                    
                    $this->data['monthList'] = $monthSelection->html();                               
                    $this->data['month'] = $this->app->Request()->getParameter("month","|");
                    $this->app->Renderer()->render("ess/reports/expensesReport.twig",$this->data);
                    
                break;
        endswitch;
    }
    public function expensesReports(){
        $action = $this->app->Request()->getParameter("action","");
        $units = \Modules\HR\Runtime\HrHelper::getAllowedUnits($this->app->Auth()->getUser()->getEmployee());
        $currencyArray = \entities\Base\CurrenciesQuery::create()->find()->toKeyValue("CurrencyId","Name");
        $dataCurrency = FormMgr::select()->options($currencyArray);
        
        $empid = $this->app->Request()->getParameter("empid",$this->app->Auth()->getUser()->getEmployee()->getEmployeeId());
        
        $emp = \entities\EmployeeQuery::create()->findPk($empid);

        if ($emp->getItownid() != null) {
                        $statename = GeoTownsQuery::create()
                           ->select(['GeoState.Sstatename'])
                           ->joinWith('GeoCity')
                           ->joinWith('GeoState')
                           ->filterByItownid($emp->getItownid())
                           ->findOne();
                    } else {
                        $statename = '';
                   }

        $this->data['Name'] = $emp->getFirstName()." ".$emp->getLastName();
        $this->data['empcode'] = $emp->getEmployeeCode();
        $this->data['costnumber'] = $emp->getCostNumber();
        $this->data['Designation'] = $emp->getDesignations()->getDesignation();
        // $this->data['Location'] = $emp->getBranch()->getBranchname()." | ".$emp->getBranch()->getGeoState()->getSstatename();
        // $this->data['State'] = $emp->getBranch()->getGeoState()->getSstatename();
        $this->data['Location'] = $emp->getBranch()->getBranchname()." | ". $statename;
        $this->data['State'] = $statename;
        
        switch ($action) :
            case "":
                $this->data['monthList'] = FormMgr::select()
                    ->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths(10))
                    ->html();           
                
                $this->data['currency'] = $dataCurrency->html();
                $this->data['reportname'] = date("F Y");
                $this->app->Renderer()->render("ess/reports/expensesReports.twig",$this->data);
                break;
            case "load":
                    $month = explode("|",$this->app->Request()->getParameter("month","|"));
                    
                    $currency = $this->app->Request()->getParameter("currency");
                    //$status = $this->app->Request()->getParameter("status");
                    $status = 8;
                    $expenses = \entities\ExpensesQuery::create()
                            ->joinWithBudgetGroup()
                            ->filterByTripCurrency(1)
                            ->filterByExpenseStatus(array(2,3,4))
                            ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)                    
                            ->filterByEmployeeId($empid);
                    $expenses->find();
                    
                    
                    $taxArray = [];
                    $basicAmount = 0;
                    $addTotal = 0;
                    $gstTotal = 0;
                    $basicaddgst = 0;
                    $diductionbyapproval = 0;
                    
                    $cmpcardAmount = 0;
                    
                    $totalBasic = 0;
                    $totaltAdd = 0;
                    $totaltTax = 0;
                    $totalAmount = 0;
                    $totalDidbyapp = 0;
                    $totalPaybleAmount = 0;
                    $totalCmpCard = 0;
                    $netpayableamount = 0;
                    $finaldidAmount = 0;
                    $cmpcard = 0;
                    if($expenses){
            
                        foreach($expenses as $e){
                            
                            $list = $e->getExpenseLists();

                                $dates = $e->getBudgetId();
                                if(!isset($taxArray[$dates])) {
                                    //$l->taxArray[$dates]['cmpcard'] = 0;
                                    $taxArray[$dates]['basicAmount'] = 0;
                                    $taxArray[$dates]['addTotal'] = 0;
                                    $taxArray[$dates]['gstTotal'] = 0;
                                    $taxArray[$dates]['basicaddgst'] = 0;
                                    $taxArray[$dates]['diductionbyapproval'] = 0;
                                    $taxArray[$dates]['netpayableamount'] = 0;
                                    $taxArray[$dates]['cmpcardAmount'] = 0;
                                    $taxArray[$dates]['finaldidAmount'] = 0;
                                    

                                }
                                foreach($list as $l){
                                    
                                    if (array_key_exists($dates,$taxArray))
                                    {
                                        
                                        $taxArray[$dates]['basicAmount'] += $l->getExpIlAmount();
                                        $taxArray[$dates]['addTotal'] += $l->getExpReqAmount();
                                        $taxArray[$dates]['gstTotal'] += $l->getExpTaxAmount();
                                        $taxArray[$dates]['basicaddgst'] +=  $l->getExpIlAmount() + $l->getExpReqAmount() + $l->getExpTaxAmount();
                                        $taxArray[$dates]['netpayableamount'] += $l->getExpFinalAmount();
                                        $taxArray[$dates]['diductionbyapproval'] += $l->getExpAprAmount();
                                        if($l->getCmpCard() == 1){
                                            $taxArray[$dates]['cmpcardAmount'] += $l->getExpFinalAmount();
                                        }

                                    }else{
                                        
                                        $taxArray[$dates]['basicAmount'] = $l->getExpIlAmount();
                                        $taxArray[$dates]['addTotal'] = $l->getExpReqAmount();
                                        $taxArray[$dates]['gstTotal'] = $l->getExpTaxAmount();
                                        $taxArray[$dates]['basicaddgst'] =  $l->getExpIlAmount() + $l->getExpReqAmount() + $l->getExpTaxAmount();
                                        $taxArray[$dates]['netpayableamount'] = $l->getExpFinalAmount();
                                        $taxArray[$dates]['diductionbyapproval'] = $l->getExpAprAmount();
                                        if($l->getCmpCard() == 1){
                                            $taxArray[$dates]['cmpcardAmount'] += $l->getExpFinalAmount();
                                        }
                                    }
                                
                                    if($l->getCmpCard() == 1){
                                        $cmpcard += $l->getExpFinalAmount();
                                    }
                                    
                                    $netpayableamount += $l->getExpFinalAmount();
                                    $finaldidAmount += ($l->getExpAprAmount() - $l->getExpFinalAmount());
                                    $totalBasic += $l->getExpIlAmount();
                                    $totalAmount += $l->getExpIlAmount() + $l->getExpTaxAmount() + $l->getExpReqAmount();
                                    $abc = $l->getExpIlAmount() + $l->getExpTaxAmount() + $l->getExpReqAmount();
                                    $totalDidbyapp += $abc - $l->getExpAprAmount();
                                }
                            
                            if($e->getexpenseTrip() > 0){ $working = "On Trip"; }else{ $working = "HQ"; }
                            $taxArray[$dates]['Budget'] = $e->getBudgetGroup()->getGroupcode(); 
                            $taxArray[$dates]['exphead'] = rtrim($e->getBudgetGroup()->getGroupName(),"-");
                            
                            //$taxArray[$dates]['expdate'] = $e->getexpenseDate()->format('d');
                            //$taxArray[$dates]['expday'] = $e->getexpenseDate()->format('D');
                            //$taxArray[$dates]['working'] = $working;
                            
                            
                            $totaltAdd += $e->getExpenseAdditionalAmt();
                            $totaltTax += $e->getExpenseTaxAmt();
                            
                            
                            
                            
                            $totalPaybleAmount += $e->getExpenseReqAmt() + $e->getExpenseAdditionalAmt() + $e->getExpenseTaxAmt() - ($e->getExpenseReqAmt()-$e->getExpenseApprovedAmt());
                        }
                        

                    }
                    //var_dump($taxArray[50]['expdate']); exit;
                    
                    $this->data['heads'] = $taxArray;
                    $this->data['totalBasic'] = $totalBasic;
                    $this->data['totaltAdd'] = $totaltAdd;
                    $this->data['totaltTax'] = $totaltTax;
                    $this->data['currSelected'] = $currencyArray[1];
                    $this->data['totalAmount'] = $totalAmount;
                    $this->data['totalDidbyapp'] = $totalDidbyapp;
                    $this->data['totalPaybleAmount'] = $totalPaybleAmount;
                    $this->data['totalCmpCard'] = $cmpcard;
                    $this->data['netpayableamount'] = $netpayableamount;
                    
                    $monthSelection = FormMgr::select()->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths(10));
                    
                    $monthSelection->val($this->app->Request()->getParameter("month"));                    
                    $this->data['monthList'] = $monthSelection->html();                               
                    $this->data['month'] = $this->app->Request()->getParameter("month","|");
                    $this->data['reportname'] = date("F Y", strtotime($month[0]));
                    $dataCurrency->val($currency);                  
                    $this->data['currency'] = $dataCurrency->html();
                    
                    $this->app->Renderer()->render("ess/reports/expensesReports.twig",$this->data);
                    
                break;
        endswitch;
    }

    public function dailyreports(){
        $action = $this->app->Request()->getParameter("action","");
        $units = \Modules\HR\Runtime\HrHelper::getAllowedUnits($this->app->Auth()->getUser()->getEmployee());
        $currencyArray = \entities\Base\CurrenciesQuery::create()->find()->toKeyValue("CurrencyId","Name");
        $dataCurrency = FormMgr::select()->options([0=>'All Currency']+$currencyArray);
        
        $empid = $this->app->Request()->getParameter("empid",$this->app->Auth()->getUser()->getEmployee()->getEmployeeId());
        
        $emp = \entities\EmployeeQuery::create()->findPk($empid);
        $this->data['Name'] = $emp->getFirstName()." ".$emp->getLastName();
        $this->data['empcode'] = $emp->getEmployeeCode();
        $this->data['costnumber'] = $emp->getCostNumber();
        $this->data['Designation'] = $emp->getDesignations()->getDesignation();
        //  var_dump($emp->getBranch()->getGeoState() == NULL);
        //  die;
        $this->data['State'] = '';
        if($emp->getBranch()->getGeoState() == NULL){
            $this->data['Location'] = $emp->getBranch()->getbranchname();
        }else{
            $this->data['Location'] = $emp->getBranch()->getbranchname()." | ".$emp->getBranch()->getGeoState()->getSstatename();
            $this->data['State'] = $emp->getBranch()->getGeoState()->getSstatename();
        }

        
        
        switch ($action) :
            case "":
                $this->data['monthList'] = FormMgr::select()
                    ->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths(10))
                    ->html();           
                
                $this->data['currency'] = $dataCurrency->html();
                $this->data['reportname'] = date("F Y");
                $this->app->Renderer()->render("ess/reports/dailyReports.twig",$this->data);
                break;
            case "load":
                    $month = explode("|",$this->app->Request()->getParameter("month","|"));
                    
                    $currency = $this->app->Request()->getParameter("currency");
                    //$status = $this->app->Request()->getParameter("status");
                    $status = 8;
                    $expenses = \entities\ExpensesQuery::create()
                            ->joinWithBudgetGroup()
                            ->joinWithCurrencies();
                            if($currency > 0){
                            $expenses->filterByTripCurrency($currency);
                            }
                            $expenses->filterByExpenseStatus(1,\Propel\Runtime\ActiveQuery\Criteria::GREATER_THAN)
                            ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)                    
                            ->filterByEmployeeId($empid)
                            ->orderByExpenseDate(\Propel\Runtime\ActiveQuery\Criteria::ASC);
                    $expenses->find();
                    
                    
                    $taxArray = [];
                    $basicAmount = 0;
                    $addTotal = 0;
                    $gstTotal = 0;
                    $basicaddgst = 0;
                    $diductionbyapproval = 0;
                    $cmpcardAmount = 0;
                    $totalBasic = 0;
                    $totaltAdd = 0;
                    $totaltTax = 0;
                    $totalAmount = 0;
                    $totalDidbyapp = 0;
                    $totalPaybleAmount = 0;
                    $totalCmpCard = 0;
                    $netpayableamount = 0;
                    $finaldidAmount = 0;
                    $cmpcard = 0;
                    $TripCurrencyArray = [];
                    $ExpenseFinalAmopuntArray = [];
                    $tempArray = [];

                    if($expenses){
            
                        foreach($expenses as $e){
                            
                            array_push($TripCurrencyArray, $e->getTripCurrency());
                            
//                            array_push($ExpenseFinalAmopuntArray, $e->getExpenseFinalAmt());
//                            $test = array_combine($ExpenseFinalAmopuntArray, $TripCurrencyArray);
                            
                            $list = $e->getExpenseLists();
                                $dates = $e->getExpenseDate()->format('d-m-Y');
                                if(!isset($taxArray[$dates])) {
                                    //$l->taxArray[$dates]['cmpcard'] = 0;
                                    $taxArray[$dates]['basicAmount'] = 0;
                                    $taxArray[$dates]['addTotal'] = 0;
                                    $taxArray[$dates]['gstTotal'] = 0;
                                    $taxArray[$dates]['basicaddgst'] = 0;
                                    $taxArray[$dates]['diductionbyapproval'] = 0;
                                    $taxArray[$dates]['netpayableamount'] = 0;
                                    $taxArray[$dates]['cmpcardAmount'] = 0;
                                    $taxArray[$dates]['finaldidAmount'] = 0;

                                }
                                
                                  $currencyId = $e->getTripCurrency();
                                if(!isset($tempArray[$currencyId])) {
                                    $tempArray[$currencyId] = $e->getCurrencies()->getName();
                                     $tempArray_total[$currencyId] = 0;
                                }
                                
                                foreach($list as $l){
                                    if (array_key_exists($dates,$taxArray))
                                    {
                                        
                                        $taxArray[$dates]['basicAmount'] += $l->getExpIlAmount();
                                        $taxArray[$dates]['addTotal'] += $l->getExpReqAmount();
                                        $taxArray[$dates]['gstTotal'] += $l->getExpTaxAmount();
                                        $taxArray[$dates]['basicaddgst'] +=  $l->getExpIlAmount() + $l->getExpReqAmount() + $l->getExpTaxAmount();
                                        $taxArray[$dates]['netpayableamount'] += $l->getExpFinalAmount();
                                        $taxArray[$dates]['diductionbyapproval'] += $l->getExpAprAmount();
                                        if($l->getCmpCard() == 1){
                                            $taxArray[$dates]['cmpcardAmount'] += $l->getExpFinalAmount();
                                        }

                                    }else{
                                        
                                        $taxArray[$dates]['basicAmount'] = $l->getExpIlAmount();
                                        $taxArray[$dates]['addTotal'] = $l->getExpReqAmount();
                                        $taxArray[$dates]['gstTotal'] = $l->getExpTaxAmount();
                                        $taxArray[$dates]['basicaddgst'] =  $l->getExpIlAmount() + $l->getExpReqAmount() + $l->getExpTaxAmount();
                                        $taxArray[$dates]['netpayableamount'] = $l->getExpFinalAmount();
                                        $taxArray[$dates]['diductionbyapproval'] = $l->getExpAprAmount();
                                        if($l->getCmpCard() == 1){
                                            $taxArray[$dates]['cmpcardAmount'] += $l->getExpFinalAmount();
                                        }
                                    }
                                
                                    if($l->getCmpCard() == 1){
                                        $cmpcard += $l->getExpFinalAmount();
                                    }
                                     if(array_key_exists($currencyId,$tempArray_total)){ 
                                        $tempArray_total[$currencyId] += $l->getExpFinalAmount();
                                        
                                    }else{
                                        $tempArray_total[$currencyId] = $l->getExpFinalAmount();
                                    }
                                    $netpayableamount += $l->getExpFinalAmount();
                                    
                                    $finaldidAmount += ($l->getExpAprAmount() - $l->getExpFinalAmount());
                                    $totalBasic += $l->getExpIlAmount();
                                    $totalAmount += $l->getExpIlAmount() + $l->getExpTaxAmount() + $l->getExpReqAmount();
                                    $abc = $l->getExpIlAmount() + $l->getExpTaxAmount() + $l->getExpReqAmount();
                                    $totalDidbyapp += $abc - $l->getExpAprAmount();
                                }
                            
                            if($e->getexpenseTrip() > 0){ $working = "On Trip"; }else{ $working = "HQ"; }
                            $taxArray[$dates]['Budget'] = $e->getBudgetGroup()->getGroupcode(); 
                            $taxArray[$dates]['exphead'] = rtrim($e->getBudgetGroup()->getGroupName(),"-");
                            
                            //$taxArray[$dates]['expdate'] = $e->getexpenseDate()->format('d');
                            //$taxArray[$dates]['expday'] = $e->getexpenseDate()->format('D');
                            $taxArray[$dates]['date'] = $dates;
                            $taxArray[$dates]['working'] = $working;

                            
                            $totaltAdd += $e->getExpenseAdditionalAmt();
                            $totaltTax += $e->getExpenseTaxAmt();
                            
                            
                            
                            
                            $totalPaybleAmount += $e->getExpenseReqAmt() + $e->getExpenseAdditionalAmt() + $e->getExpenseTaxAmt() - ($e->getExpenseReqAmt()-$e->getExpenseApprovedAmt());
                        }
                        
                        

                    }
                    //var_dump($taxArray[50]['expdate']); exit;
                       $aaa = 0;
                    if(!empty($tempArray_total)){
                    $aaa = array_combine($tempArray, $tempArray_total);
                    }
                    
                    $this->data['heads'] = $taxArray;
                    $this->data['totalBasic'] = $totalBasic;
                    $this->data['totaltAdd'] = $totaltAdd;
                    $this->data['totaltTax'] = $totaltTax;
                    //$this->data['currSelected'] = $currencyArray[$currency];
                    $this->data['totalAmount'] = $totalAmount;
                    $this->data['totalDidbyapp'] = $totalDidbyapp;
                    $this->data['totalPaybleAmount'] = $totalPaybleAmount;
                    $this->data['totalCmpCard'] = $cmpcard;
                    $this->data['netpayableamount'] = $netpayableamount;
                    $this->data['currSelected'] = $aaa;
                    $this->data['CurrList'] = $tempArray;

//                    
//                    if($currency == 0){
//                        $TripCurrencyName = [];
//                        $cur = \entities\CurrenciesQuery::create()
//                                ->filterByCurrencyId($TripCurrencyArray)
//                                ->find();
//                        foreach ($cur as $Curr){
//                            array_push($TripCurrencyName, $Curr->getName());
//                        }
//                        
//                        $this->data['currSelected'] = $tempArray;
//                        
//                         
//                    }else{
//                        $curName = \entities\CurrenciesQuery::create()
//                                ->filterByCurrencyId($currency)
//                                ->findOne();
//                        
//                        if(empty($finalAmountArray)){
//                            
//                            $this->data['currSelected'] = $curName->getName();
//                        }else{
//                            $this->data['currSelected'] = $tempArray;
//                        }
//                     
//                    }
                    
                    $monthSelection = FormMgr::select()->options(\Modules\ESS\Runtime\EssHelper::getAllowedMonths(10));
                    
                    $monthSelection->val($this->app->Request()->getParameter("month"));                    
                    $this->data['monthList'] = $monthSelection->html();                               
                    $this->data['month'] = $this->app->Request()->getParameter("month","|");
                    $this->data['reportname'] = date("F Y", strtotime($month[0]));
                    $dataCurrency->val($currency);                  
                    $this->data['currency'] = $dataCurrency->html();
                    
                    $this->app->Renderer()->render("ess/reports/dailyReports.twig",$this->data);
                    
                break;
        endswitch;
    }
    
}       