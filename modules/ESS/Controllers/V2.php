<?php declare(strict_types = 1);

namespace Modules\ESS\Controllers;

use App\System\App;
use Http\Request;
use App\Utils\FormMgr;
use Modules\System\Processes\WorkflowManager;
use Modules\System\Runtime\PolicyRequest;
use Modules\System\Processes\PolicyChecker;

class V2 extends \App\Core\BaseController 
{	               
    protected $app;
    
    public function __construct(App $app)
    {
        $this->app = $app;
        //$this->app->logger()->addInfo($this->app->Request()->getUri(),["Param" => $this->app->Request()->getParameters(),"Header" => $this->app->Request()->getBodyParameters()]);                    
    }
    
    public function getPendingActions()
    {
        // Get Pending Approvals
        $TripsReqs = WorkflowManager::getPendingRequestPks("Trips",$this->app);
        $ExpReqs = WorkflowManager::getPendingRequestPks("Expenses",$this->app);
        
        $dateRange = \Modules\ESS\Runtime\EssHelper::getRangeAllowedMonth($this->app->Auth()->getUser()->getCompany()->getExpenseMonths());
        
        // Me 
        $employeeId = $this->app->Auth()->getUser()->getEmployeeId();
        
        $trips = \entities\TripsQuery::create()
                   ->filterByEmployeeId($employeeId, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                   ->filterByPrimaryKeys($TripsReqs)                   
                   ->find();
                        
        $expenses = \entities\ExpensesQuery::create()                      
                        ->filterByEmployeeId($employeeId, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                        ->filterByExpenseDate($dateRange[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                        ->filterByExpenseDate($dateRange[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                        ->filterByPrimaryKeys($ExpReqs)                                                
                        ->find();
                
        $responseArray = [];
        if($trips){
            foreach($trips as $t)
            {
                $employee = $t->getEmployee();            
                if(!$employee)
                {
                    // Should we delete the tip if employee is deleted ?? 
                    continue;
                }
                $profilePic = 'uploads/'."default-profile.png";
                if($employee->getProfilePicture()){
                    $profilePic = 'uploads/'.$this->app->Auth()->CompanyId().'/'.$employee->getProfilePicture();
                }
                $record = [
                    "profilePic" => $profilePic,
                    "type" => "Trip",
                    "tripDetail" => $t->toArray(),
                    "EmployeeId" => $employee->getEmployeeId(),
                    "FirstName" => $employee->getFirstName(),
                    "LastName" => $employee->getLastName(),
                    "Branchname" => $employee->getBranch()->getBranchname(),
                    "Email" => $employee->getEmail(),
                    "Designation" => $employee->getDesignations()->getDesignation()
                ];
                array_push($responseArray, $record);
            }
        }
        $expenseResponse = [];        
        if($expenses){
            foreach($expenses as $e){
                $employee = $e->getEmployee();            
                $profilePic = 'uploads/'."default-profile.png";
                if($employee->getProfilePicture()){
                    $profilePic = 'uploads/'.$this->app->Auth()->CompanyId().'/'.$employee->getProfilePicture();
                }

                $key = $employee->getPrimaryKey().'|'.$e->getExpenseTrip();
                /* Expense response in set key */
                if(!isset($expenseResponse[$key])) {

                    $tripDetail = ["TripReason" => "HQ"];
                    /* Check get expense trip */
                    if($e->getExpenseTrip() > 0)
                    {
                        $trip = \entities\TripsQuery::create()->findPk($e->getExpenseTrip());
                        /* Check Trip */
                        if($trip) { $tripDetail = $trip->toArray();}                    
                    }

                    $expenseResponse[$key] = 
                    $record = [
                        "profilePic" => $profilePic,
                        "type" => "Expense",
                        "hasTrip" => ($e->getExpenseTrip() > 0),
                        "tripDetail" => $tripDetail,
                        "expenseCount" => 0,
                        "requestedAmount" => $e->getExpenseReqAmt(),
                        "EmployeeId" => $employee->getEmployeeId(),
                        "FirstName" => $employee->getFirstName(),
                        "LastName" => $employee->getLastName(),
                        "Branchname" => $employee->getBranch()->getBranchname(),
                        "Email" => $employee->getEmail(),
                        "Designation" => $employee->getDesignations()->getDesignation()
                    ];

                }
                else 
                {
                    $expenseResponse[$key]["expenseCount"] ++;
                    $expenseResponse[$key]["requestedAmount"] = $expenseResponse[$key]["requestedAmount"] + $e->getExpenseReqAmt();
                }
                
            }
        }
        
        $responseArray = array_merge($responseArray,array_values($expenseResponse));
        
        $this->apiResponse($responseArray, 200, 'Pending Action for Dashboard');       
    }
    
    public function getTrips()
    {
        
        //$today = date('d/m/Y h:i a');       
        $today = new \DateTime();
        //$today = $today->format('d/m/Y h:i a');

        $trips = \entities\TripsQuery::create()
                ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())
                ->filterByTripEndDate($today, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                ->orderByTripStartDate(\Propel\Runtime\ActiveQuery\Criteria::ASC)
                ->find();
                
        $responseArray = ["current" => [],"later" => []]; 
        
        foreach ($trips as $trip)
        {
            
            if($trip->getTripStartDate() <= $today)
            {
                
                $budget = \entities\BudgetGroupQuery::create()->findPk($trip->getBudgetId());
                $exp = \entities\ExpensesQuery::create()->filterByExpenseTrip($trip->getPrimaryKey())->find();
                
                $finalTotal = 0;
                $reqAmount = 0;
                $approvedAmount = 0;
                /* Expense filter by trip */
                foreach ($exp as $e)
                {
                    $finalTotal = $finalTotal + $e->getExpenseFinalAmt();
                    $reqAmount = $reqAmount + $e->getExpenseReqAmt();
                    $approvedAmount = $approvedAmount + $e->getExpenseApprovedAmt();
                }
                $tripRow = [
                    "Entity" => $trip->toArray(),
                    "BudgetName" => $budget->toArray(),
                    "Expenses" => $exp->toArray(),
                    "FinalAmt" => $finalTotal,
                    "RequestedAmt" => $reqAmount,
                    "ApprovedAmt" => $approvedAmount
                ];
                array_push($responseArray["current"], $tripRow);
            }
            else
            {
                array_push($responseArray["later"], $trip->toArray());
            }
        }
     
        $this->apiResponse($responseArray, 200, 'Trip Data for Dashbaord');       
        
    }
    
     public function getExpenseMultiple()
   {        
        switch ($this->app->Request()->getMethod()):
            case "POST" :
                $expListId = $this->app->Request()->getParameter("Explistid");
                $description = $this->app->Request()->getParameter("Description");
                $ExpDetId = $this->app->Request()->getParameter("ExpDetId",0);
                $hasFile = $this->app->Request()->getFile("Image", null);
                $fileImagePath = "";
                /* Check image not null*/
                if($hasFile != null) {
                    $file = new \Upload\File('Image', $this->app->Storage());
                    /*Check get file not null*/
                        if ($file->getFilename() != "") {
                            $new_filename = uniqid();
                            $file->setName($new_filename);
                            $fileImagePath = "uploads/".$this->app->Auth()->CompanyId()."/".$file->getNameWithExtension();
                            $allowed_types = array('jpg', 'png', 'jpeg');
                            $ext = $file->getExtension();
                            /*Check file extension*/
                            if (in_array($ext, $allowed_types)) {
                            $file->upload();
                            }
                        }
                    }
                else
                {
                    $file = "";
                }
                
                $amount = $this->app->Request()->getParameter("Amount");                                
                $tran = \Modules\ESS\Runtime\EssHelper::AUExpenseDetail($description, $amount, $fileImagePath, $expListId,$ExpDetId); 
                if($tran){
                    $this->apiResponse($tran->toArray(), 200, 'Expense added');       
                }else{
                    $this->apiResponse([], 400, 'Expense detail record not found');       
                }
                break;
            case "GET" :
                $employeeId = $this->app->Auth()->getUser()->getEmployeeId();
                $explistdetails = $this->app->Request()->getParameter("Explistid");
                $explist = \Modules\ESS\Runtime\EssHelper::getMultipleExpenseDetails($explistdetails);
                if($explist){
                    $this->apiResponse(["expDetailList" => $explist->toArray()], 200, 'List');
                }else{
                    $this->apiResponse([], 400, 'Expense detail record not found');
                }
                break;
        endswitch;
   }
   
   public function deleteExpenseDetailRecord()
   {
       $ExpDetId = $this->app->Request()->getParameter("ExpDetId",0);
       if(\Modules\ESS\Runtime\EssHelper::deleteExpenses($ExpDetId)){
       
       $this->apiResponse([], 200, 'Expense Detail Record Deleted'); 
       }else{
           $this->apiResponse([], 400, 'Expense detail record not found'); 
       }
   }
   
   public function getDocLog()
   {
       $ExpId = $this->app->Request()->getParameter("ExpId",0);
       $log = WorkflowManager::getLogData("Expenses", $ExpId);
       $logArray = [];
       foreach($log as $l)
       {
           $rec = [
               "WfTitle" => $l->getWfTitle(),
               "WfNote" => $l->getWfNote(),
               "Employee" => \Modules\ESS\Runtime\EssHelper::getStandardEmployeeRecord($l->getEmployee(),$this->app->Auth()->CompanyId()),
               "WfStatusId" => $l->getWfStatusId(),
               "CreatedAt" => $l->getCreatedAt()
           ];
           array_push($logArray, $rec);
       }
       $this->apiResponse($logArray, 200, 'Expense Detail Record Deleted');       
       
   }
   
  
}
