<?php declare(strict_types = 1);

namespace Modules\ESS\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use Modules\System\Processes\WorkflowManager;

class Trips extends \App\Core\BaseController implements \Modules\System\Interfaces\Document 
{	               
    protected $app;
    protected $WfDoc = "Trips";


    public function __construct(App $app)
    {
            $this->app = $app;		
    }

    public function initForm($id = 0) {
        $pk = $id;
        $datachange = $this->app->Request()->getParameter("datachange","");                
        $default_currency = $this->app->Auth()->getUser()->getEmployee()->getOrgUnit()->getCurrencyId();
        $currency = \entities\CurrenciesQuery::create()
                ->filterByCurrencyId($default_currency)
                ->find()->toKeyValue("CurrencyId","Name");
        
        $budget = \entities\BudgetGroupQuery::create()
                        ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
                        ->find()->toKeyValue('Bgid','GroupName');
        
        if($datachange == "updateCurrency")
        {
            
            $TripOrigin = $this->app->Request()->getParameter("TripOrigin",0);
            $TripDestination = $this->app->Request()->getParameter("TripDestination",0);
            
            $currency = \Modules\ESS\Runtime\EssHelper::getTripCurrency($default_currency,$TripOrigin,$TripDestination);
            
            $opt = FormMgr::select()->options($currency)->html();            
            $this->json(["TripCurrency" => $opt]);
            
            return;
        }
        
        
        $this->data['form_name'] = "Trip";
        $f = FormMgr::formHorizontal();
        $f->add([
            'TripType' => FormMgr::select()->options($this->getConfig("ESS", "tripType"))->label('Type *')->required(),
            'TripOrigin' => FormMgr::text()->label('Origin *')->datatoggle("locationAutoComplete")->required()->datachange('updateCurrency'),
            'TripDestination' => FormMgr::text()->label('Destination *')->datatoggle("locationAutoComplete")->required()->datachange('updateCurrency'),
            'TripReason' => FormMgr::text()->label('Reason *')->required(),
            'StartDate' => FormMgr::text()->label('Start Date *')->required()->class('datepicker'),
            'StartTime' => FormMgr::select()->label('Start Time *')->required()->options(\Modules\ESS\Runtime\EssHelper::getRangeTime()),
            'EndDate' => FormMgr::text()->label('End Date *')->required()->class('datepicker'),
            'EndTime' => FormMgr::select()->label('End Time *')->required()->options(\Modules\ESS\Runtime\EssHelper::getRangeTime()),
            'BudgetId' => FormMgr::select()->label('Budget *')->required()->options($budget),
            'TripCurrency' => FormMgr::select()->options($currency)->label('Currency')->id("TripCurrency"),
            
        ]);
        
        
        
        
        $entity = new \entities\Trips();
        $this->data['form_name'] = "Add Trip";
        $f['TripCurrency']->val($this->app->Auth()->getUser()->getEmployee()->getOrgUnit()->getCurrencyId());
        
        if($pk > 0)
        {
            $entity = \entities\TripsQuery::create()->findPk($pk);            
            
            $currency = \entities\CurrenciesQuery::create()
                    ->filterByPrimaryKeys([$default_currency,$entity->getTripCurrency()])
                    ->find()->toKeyValue("CurrencyId","Name");            
            $f['TripCurrency'] = FormMgr::select()->options($currency)->label('Currency')->id("TripCurrency");
            
            
            $f->val($entity->toArray());
            $this->data['form_name'] = "Edit Trip";
            $f['StartDate']->val($entity->getTripStartDate("d/m/Y"));
            $f['EndDate']->val($entity->getTripEndDate("d/m/Y"));
            $f['StartTime']->val($entity->getTripStartDate("g:i a"));
            $f['EndTime']->val($entity->getTripEndDate("g:i a"));
            $f['BudgetId']->val($entity->getBudgetId());
            
            $f['TripOrigin']->sudoValue($entity->getTripOriginName())->datachange('updateCurrency');
            $f['TripDestination']->sudoValue($entity->getTripDestinationName())->datachange('updateCurrency');
            
            
        }
        if($this->app->isPost() && $f->validate()){
            
            $TripStartDate =  \DateTime::createFromFormat("d/m/Y h:i a", $_POST['StartDate']." ".$_POST['StartTime']);
            $TripEndDate = \DateTime::createFromFormat("d/m/Y h:i a", $_POST['EndDate']." ".$_POST['EndTime']);
            
        if($TripStartDate >= $TripEndDate) 
            {
                
                $this->app->Session()->setFlash("error", "Start time needs to be earlier");                
                $f->val($_POST);              
                $f['TripOrigin']->sudoValue($_POST['LocationAutoComplete_TripOrigin'])->datachange('updateCurrency');
                $f['TripDestination']->sudoValue($_POST['LocationAutoComplete_TripDestination'])->datachange('updateCurrency');
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig",$this->data);
                return;
            }
            
            $empId = $this->app->Auth()->getUser()->getEmployeeId();
            $employee = $this->app->Auth()->getUser()->getEmployee();
            
            $trip = \Modules\ESS\Runtime\EssHelper::createTrip($pk, $empId, $employee,$_POST,"case1");
            
            $f['TripOrigin']->sudoValue($_POST['LocationAutoComplete_TripOrigin']);
            $f['TripDestination']->sudoValue($_POST['LocationAutoComplete_TripDestination']);
            


            
            if($trip->count() > 0)
            {
                                
                $this->app->Session()->setFlash("error", "There is a trip that coincide with these dates");                
                $f->val($_POST);                
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig",$this->data);
                return;
            }
            if($TripStartDate > $TripEndDate) 
            {
                $this->app->Session()->setFlash("error", "Start time needs to be earlier");                
                $f->val($_POST);
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig",$this->data);
                return;
            }
            if($_POST['TripType'] == 2 && $_POST['TripOrigin'] == $_POST['TripDestination'])
            {
                $this->app->Session()->setFlash("error", "Origin or Destination are same, please change");                
                $f->val($_POST);
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig",$this->data);
                return;
                
            }
            $entity = \Modules\ESS\Runtime\EssHelper::createTrip($pk, $empId, $employee,$_POST,"case2");
            $tripStatus = 0;
            if(isset($_POST['TripStatus'])){
                $tripStatus = $_POST['TripStatus'];
            }
            $tosat = self::statusMsg(1,$tripStatus);
            $this->runModalScript("loadGrid('".$tosat."')");
            return; 
        }                 
        
        $this->data['form'] = $f->html();
            $this->app->Renderer()->render("ess/addTrip.twig",$this->data);
        
    }

    
    public function getTripReort($trip_id){
        
        $images = array();
        $totalExp = 0;
        
        $trip = \entities\TripsQuery::create()
                            ->filterByTripId($trip_id)->findOne();
        
        $exp_id = \entities\ExpensesQuery::create()
                        ->select('ExpId')
                        ->filterByExpenseTrip($trip_id)
                        ->find()->toArray();
        
        
        
        $tripWorklog = \entities\EmployeeWorkLogQuery::create()
                        ->filterByExpId($exp_id)
                        ->find();
        
        
        
        $expense = \entities\ExpenseListQuery::create()
                ->filterByExpId($exp_id)
                ->find();
        
        
        $attachement = \entities\ExpenseFilesQuery::create()
                ->filterByExpId($exp_id)
                ->find();
        
        
        foreach($expense as $exp){
            if($exp->getExpenses()->getExpenseStatus() == 6){
                $totalExp += $exp->getExpAprAmount();
            }            
        }
        
        $this->data['tripUser'] = \entities\EmployeeQuery::create()
                                    ->filterByEmployeeId($trip->getEmployeeId())
                                    ->findOne();
        $this->data['tripEexpense'] = $expense;
        $this->data['tripWorklog'] = $tripWorklog;
        $this->data['trip'] = $trip;
        $this->data['expCategory'] = \entities\Base\ExpenseMasterQuery::create()->find()->toKeyValue("expenseId","expenseName");
        
        $mpdf = new \Mpdf\Mpdf(['format' => 'A4-L','setAutoTopMargin' => '400']);
        
        $path = __DIR__.'/../../../'._UPLOADS."/".$this->app->Auth()->getUser()->getCompanyId()."/"; 
        foreach ($attachement as $a){
            array_push($images, $path.$a->getExpFullName());
        }
        define('ROOT_DIR', __DIR__.'/../../../public/images/');
        
        $this->data['company_logo'] = ROOT_DIR.'logo.png';
        $this->data['barcode_logo'] = ROOT_DIR.'barcode.png';
        $this->data['voucher_img'] = ROOT_DIR;
        $this->data['arrow_logo'] = ROOT_DIR.'arrow.png';
        $this->data['images'] = $images;
        $this->data['totalExp'] = $totalExp;
            
         $html = $this->app->Renderer()->render("ess/reports/tripReport.twig",$this->data,false);
            $mpdf->SetTitle('Report');
            $mpdf->SetAuthor("Xpensys");            
            $mpdf->SetDisplayMode('fullpage');

            $mpdf->WriteHTML($html); 

            $mpdf->Output();
            exit;
    }
    
    public function getList($id = 0) {
        $emp = $id;
        if($this->app->Request()->getParameter("page","") == 'P'){
            \Modules\System\Runtime\UserTriggers::checkOnce("firstTimeApproval", $this->app->Auth()->getUser()->getUserId());
        }
        
        $tripActionId = $this->app->Request()->getParameter("id",-1);
        if($tripActionId > 0)
        {
            $this->app->Response()->redirect($this->app->Router()->getPath("ess_tripSingle",["id"=>$tripActionId]));
        }
        
        $this->data['title'] = "Trips";
        $this->data['form_name'] = "Trip";
        $this->data['cols'] = [
            "Start Date" => "TripStartDate",
            "End Date" => "TripEndDate",
            "Name" => "Employee.FirstName",
            //"Last Name" => "",
            "Type" => "TripType",
            "Origin" => "TripOriginName",
            "Destination" => "TripDestinationName",
            //"Reason" => "TripReason",
            "Trip Status" => "TripStatus",
            //"Currency" => "Currencies.Name",
            "Total Cost" => "expTotal"
        ];
        $this->data['colorRows'] = [
            1 => "#ffffff",
            2 => "#9dddea",
            3 => "#ef9292",
            4 => "#ef9292",
            5 => "#ef9292",
        ];
        $this->data['dateFields'] = ['TripStartDate','TripEndDate'];
        
        $this->data['pk'] = "TripId";
        $this->data['actionFunc'] = "ess_tripForm";
        //$this->data['singleFunc'] = "ess_tripSingle";
        $this->data['rowButtons'] = ["ess_tripSingle" => "zmdi zmdi-eye"];
        $this->data['canEditIf'] = ["col" => "TripStatus","val" => "1"];
        $this->data['valKeys'] = [
            "TripType" => $this->getConfig("ESS", "tripType"),
            "TripStatus" => WorkflowManager::getStatusList($this->WfDoc)];
        //$this->data['listFilters'] = $this->getConfig("ESS", "tripFilters");
       
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            if(isset($_GET['id'])){
                $tripEmpId = \entities\TripsQuery::create()->findPk($_GET['id']);
                if($tripEmpId){
                    if($tripEmpId->getEmployeeId() == $this->app->Auth()->getUser()->getEmployeeId()){
                        $page = "A";
                    }else{
                        $page = "P";
                    } 
                }else {
                    $page = "P";
                }
            } else {
                $page = "A";
            }
            
        }
        $istop = \Modules\ESS\Runtime\EssHelper::isEmployeeTopLevel($this->app->Auth()->getUser()->getEmployee());
        if($istop)
        {
            $page = "P";
        }
        $this->data['isNotTop'] = !$istop;
        $this->data['page'] = $page;
                
        if($emp == 0){
            if($page == "P"){
                $reqs = WorkflowManager::getPendingRequestPks($this->WfDoc,$this->app);
            }else{
                $reqs = $this->app->Auth()->getUser()->getEmployeeId();
            }
            $tripdatearray = \Modules\ESS\Runtime\EssHelper::tripStartEndDate($page,$reqs,$this->app->Auth()->getUser()->getEmployeeId());
        }else{
            $tripdatearray = \Modules\ESS\Runtime\EssHelper::tripStartEndDate('A',$emp,$emp);
        }
        
        $this->data['tripFilterDate'] = $tripdatearray;
        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk",0);
       
       switch($action) : 
            case "":
                
               $this->data['defaultOrderIdx'] = 0;
                if($emp == 0){
                    $this->data['showStatus'] = 1;
               }else{
                   $this->data['showStatus'] = 0;
               }
               
               $this->app->Renderer()->render('ess/triplist.twig',$this->data);
               break;
            case "list":
               $filter = $this->app->Request()->getParameter("filter");
               $filterdate = $this->app->Request()->getParameter("filterdate");
               
               $pks = WorkflowManager::getPendingRequestPks($this->WfDoc,$this->app);
               if($emp == 0){
                    $emp = $this->app->Auth()->getUser()->getEmployee();
               }else{
                   $emp = \entities\EmployeeQuery::create()->findPk($emp);
                   $filter = 'A';   
               }
               $records = \Modules\ESS\Runtime\EssHelper::getallTripListnew($filter,$filterdate,$pks,$emp);
               
               $this->json( ["data" => $records]);
               
               break;                      
            case "datefilter":
                $filter = $this->app->Request()->getParameter("filter");                
                $reqs = [];
                if($filter == "P"){
                    $reqs = WorkflowManager::getPendingRequestPks($this->WfDoc,$this->app);
                }else{
                    array_push($reqs,$this->app->Auth()->getUser()->getEmployeeId());
                }
                if(count($reqs) > 0 ) {
                    $tripdatearray = \Modules\ESS\Runtime\EssHelper::tripStartEndDate($filter,$reqs,$this->app->Auth()->getUser()->getEmployeeId());
                }
                $this->json($tripdatearray);
               break;
            case "quickView":
                $this->quickTripView($this->app->Request()->getParameter("tripid"));
                break;
            case "deleteTrip":                
                \Modules\ESS\Runtime\EssHelper::deleteTrip($this->app->Request()->getParameter("tripid"),$this->app->Auth()->CompanyId());                
                $this->json(["status"=>0]);
                break;
       endswitch;
       
    }

    public function setNextAction($id,$stepid) {
        
        $entity = \entities\TripsQuery::create()->findPk($id);        
        $f = FormMgr::formHorizontal();
        $step = \entities\WfStepsQuery::create()->findPk($stepid);                
        
        switch ($step->getWfStepLevel()) :
            case 0 :
                $f->add([
                    'TripType' => FormMgr::select()->options($this->getConfig("ESS", "tripType"))->label('Type'),
                    'TripReason' => FormMgr::text()->label('Reason'),
                    'StartDate' => FormMgr::text()->label('Start Date *')->required()->class('datepicker')->readonly(),
                    'StartTime' => FormMgr::select()->label('Start Time *')->required()->options(\Modules\ESS\Runtime\EssHelper::getRangeTime()),
                    'EndDate' => FormMgr::text()->label('End Date *')->required()->class('datepicker')->readonly(),
                    'EndTime' => FormMgr::select()->label('End Time *')->required()->options(\Modules\ESS\Runtime\EssHelper::getRangeTime()),   
                ]);
                                
            break;
        
        endswitch;
        
        $allowedStatus = WorkflowManager::getStatusList($this->WfDoc,$step->getWfOutStatus());                
        $f->add(['TripStatus' => FormMgr::select()->options($allowedStatus)->label('Status'),
            'note' => FormMgr::text()->label('Note'), ]);        
                
        $f->val($entity->toArray());
        
        if($step->getWfStepLevel() == 0) {
            $f['StartDate']->val($entity->getTripStartDate("d/m/Y"));
            $f['EndDate']->val($entity->getTripEndDate("d/m/Y"));
            $f['StartTime']->val($entity->getTripStartDate("g:i a"));
            $f['EndTime']->val($entity->getTripEndDate("g:i a"));
        }
        
         if($this->app->isPost() && $f->validate()){
             
            if($step->getWfStepLevel() == 0) {
                 
                $TripStartDate =  \DateTime::createFromFormat("d/m/Y H:i a", $_POST['StartDate']." ".$_POST['StartTime']);
                $TripEndDate = \DateTime::createFromFormat("d/m/Y H:i a", $_POST['EndDate']." ".$_POST['EndTime']);
                
                $entity->setTripStartDate($TripStartDate);
                $entity->setTripEndDate($TripEndDate);
                unset($_POST['StartDate']);
                unset($_POST['StartTime']);
                unset($_POST['EndDate']);
                unset($_POST['EndTime']);
                
             }            
              $entity->fromArray($_POST);                                
            
            
            
            
            $entity->save();
            
            $wfManager = new \Modules\System\Processes\WorkflowManager();            
            $wfManager->process($this->WfDoc, $entity,$this->app->Request()->getParameter("note",""));
            
            $this->closeModalWithToast(self::statusMsg(1,$_POST['TripStatus']));
            return; 
            
        }  
        
        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig",$this->data);
        
    }

    public function single($id) {
        
        $this->data['pk']  = $id;
        $trip = \entities\TripsQuery::create()
                //->filterByCompanyId($this->app->Auth()->CompanyId())
                ->findPk($id);
        
        $action = $this->app->Request()->getParameter("action","");
        $this->data['trip'] = $trip;
        
        if(in_array($trip->getTripStatus(),[1,2]) && $trip->getEmployeeId() == $this->app->Auth()->getUser()->getEmployeeId()){
            $this->data['getTripStatus'] = $trip->getTripStatus();
        }
        
        
        $expenses = \entities\ExpensesQuery::create()           
           ->joinWithBudgetGroup()
           ->filterByExpenseTrip($id)           
           ->filterByCompanyId($this->app->Auth()->CompanyId())
           ->find();
        $this->data['expenses'] = $expenses;
        $this->data['expensesStatus'] = WorkflowManager::getStatusList("Expenses");
        
        $this->data['trip_log'] = \Modules\System\Processes\WorkflowManager::getLog($this->WfDoc, $id, $trip->getTripStatus(), $this->app);
        $this->data['trip_actions'] = \Modules\System\Processes\WorkflowManager::getActions($this->WfDoc,$id ,$trip->getTripStatus() , $this->app,2);
        
        $this->data['tripType'] = $this->getConfig("ESS", "tripType");
        
        $totalExpense = ["Req" => 0 , "Final" => 0];
        foreach ($expenses as $exp)
        {
            if(!in_array($exp->getExpenseStatus(), [4,9])) // Not in Hold or Rejected
            {
                $totalExpense["Req"] = $totalExpense["Req"] + $exp->getExpenseReqAmt();
            }
            if(in_array($exp->getExpenseStatus(), [3,10]))
            {
                $totalExpense["Final"] = $totalExpense["Final"] + $exp->getExpenseFinalAmt();
            }
        }
        $this->data["totals"] = $totalExpense;
        
        $this->data['firstTripSingleIntro'] = \Modules\System\Runtime\UserTriggers::checkOnce("firstTripSingleIntro", $this->app->Auth()->getUser()->getUserId());
        
        $this->app->Renderer()->render("ess/tripSingle.twig",$this->data);
        
        
        if($action == "cancelTripUrl"){
            
            $TripId = $this->app->Request()->getParameter("TripId",0);
            
            $employee = $this->app->Auth()->getUser()->getEmployee();
            $entity = \entities\TripsQuery::create()->findPk($TripId);
             //$delete->setExpenseStatus(7);
            $entity->setTripStatus(4);
            $entity->save();
            if($entity){
//                $wfManager = new \Modules\System\Processes\WorkflowManager();
//                $wfManager->createLog("Trips", $delete, $employee, 0, "Creacted Trip Canceled", 0);
//                $wfManager->process("Trips", $delete);
                $wfManager = new \Modules\System\Processes\WorkflowManager();
                $wfManager->createLog("Trips", $entity, $employee, 0, "Creacted Trip Canceled", 0);
                $wfManager->process("Trips", $entity);
                $this->json(["status"=>1]);
                return;
            }else{
                $this->json(["status"=>0]);
                return;
            }
        }elseif($action == "deleteTrip" && $trip->getEmployeeId() == $this->app->Auth()->getUser()->getEmployeeId()){
            
            $TripId = $this->app->Request()->getParameter("TripId",0);
            
            \Modules\ESS\Runtime\EssHelper::deleteTrip($TripId, 0);
            
            $this->json(["status"=>1]);
            return;
        } 
        
        
        
        
    }
    static function statusMsg($type,$status){
        if($type == 1){
            switch ($status):
                case "0" :
                    return "Trip Submitted successfully";
                break;
                case "1" :
                    return "Trip raised successfully";
                break;
                case "2" :
                    return "Trip approved successfully";
                break;
                case "3" :
                    return "Trip rejected successfully";
                break;
                case "4" :
                    return "Trip cancelled successfully";
                break;
                case "5" :
                    return "Trip closed successfully";
                break;
            endswitch;
        }
    }
    
    public function quickTripView($pk)
    {
        $trip = \entities\TripsQuery::create()
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->findPk($pk);
        $this->data['trip'] = $trip;
        if(in_array($trip->getTripStatus(),[1,2]) && $trip->getEmployeeId() == $this->app->Auth()->getUser()->getEmployeeId()){
            $this->data['getTripStatus'] = $trip->getTripStatus();
        }
        $this->data['trip_actions'] = \Modules\System\Processes\WorkflowManager::getActions($this->WfDoc,$pk ,$trip->getTripStatus() , $this->app,2);
        $this->app->Renderer()->render("ess/tripQuickView.twig",$this->data);
    }
    
    
}
