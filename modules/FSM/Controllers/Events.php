<?php declare(strict_types = 1);

namespace Modules\FSM\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use Modules\System\Processes\WorkflowManager;

class Events extends \App\Core\BaseController implements \Modules\System\Interfaces\Document 
{	               
    protected $app;
    protected $WfDoc = "Events";


    public function __construct(App $app)
    {
            $this->app = $app;		
    }

    public function initForm($pk = 0) {
        
        $datachange = $this->app->Request()->getParameter("datachange","");                
        
        $EventType = \entities\EventTypesQuery::create()
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->find()->toKeyValue("EventTypeId","EventTypeName");
                                                
        $this->data['form_name'] = "Event";
        $f = FormMgr::formHorizontal();
        $f->add([
            'EventTypeId' => FormMgr::select()->options($EventType)->label('Type *')->required(),
            'EventDate' => FormMgr::date()->label('Event Date *')->required(),
            'EventRemark' => FormMgr::text()->label('Reason *')->required(),                        
        ]);
        
                        
        $entity = new \entities\Events();
        $this->data['form_name'] = "Add Event";        
        
        if($pk > 0)
        {
            $entity = \entities\EventsQuery::create()->findPk($pk);            
                        
            $f->val($entity->toArray());
            $this->data['form_name'] = "Edit Event";
            
            //$f['EventDate']->val($entity->getEventDate("d/m/Y"));
                        
        }
        if($this->app->isPost() && $f->validate()){
           
            
            
            if($pk == 0) 
            {
                $eventSamedate = \entities\EventsQuery::create()
                        ->filterByEventDate($_POST['EventDate'])
                        ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())
                        ->find();
                if($eventSamedate->count() > 0)
                {
                    $this->app->Session()->setFlash("error", $_POST['EventDate']." Event already exists");                
                    $f->val($_POST);              
                    $this->data['form'] = $f->html();
                    $this->app->Renderer()->render("modalCommonForm.twig",$this->data);
                    return;
                }
                                                
                
            }
            
            $empId = $this->app->Auth()->getUser()->getEmployeeId();
            $employee = $this->app->Auth()->getUser()->getEmployee();                        
            
            $entity->fromArray($_POST);
            if($pk == 0) 
            {
                $entity->setEventStatus(1);
                $entity->setEmployeeId($empId);
                $entity->setCompanyId($this->app->Auth()->CompanyId());
            }
            
            $entity->save();
            
            $wfManager = new \Modules\System\Processes\WorkflowManager();
            $wfManager->createLog("Events", $entity, $employee, 0, "Event Request Created", 0);
            $wfManager->process("Events", $entity);
            
            // if ($employee->getUserss()->getFirst()->getFcmToken() != "") {
            //     $notification = new \App\Utils\Notifications(\App\Abstracts\NotificationType::URLRedirect, "", []);
            //     $notification->setMessage("Event Request Created");
            //     $notification->setFCMToken($employee->getUserss()->getFirst()->getFcmToken());
            //     $a = $notification->sendFCMNotification();
            // }

            $tosat = self::statusMsg(1,1);
            $this->runModalScript("loadGrid('".$tosat."')");
            return; 
        }                 
        
        $this->data['form'] = $f->html();
            $this->app->Renderer()->render("modalCommonForm.twig",$this->data);
        
    }
           
    public function getList($emp = 0) {
        
        if($this->app->Request()->getParameter("page","") == 'P'){
            \Modules\System\Runtime\UserTriggers::checkOnce("firstTimeApproval", $this->app->Auth()->getUser()->getUserId());
        }
        
        $eventActionId = $this->app->Request()->getParameter("id",-1);
        if($eventActionId > 0)
        {
            $this->app->Response()->redirect($this->app->Router()->getPath("fsm_EventSingle",["id"=>$eventActionId]));
        }
        
        $this->data['title'] = "Events";
        $this->data['form_name'] = "Event";
        $this->data['cols'] = [
            "Date" => "EventDate",
            "Type" => "EventTypeId",
            "First Name" => "EmployeeRelatedByEmployeeId.FirstName",            
            "Last Name" => "EmployeeRelatedByEmployeeId.LastName",            
            "EventRemark" => "EventRemark",            
            "Event Status" => "EventStatus",            
            
        ];
        
        $eventTypes = \entities\EventTypesQuery::create()
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->find()->toKeyValue("EventTypeId","EventTypeName");
        
        $this->data['colorRows'] = [
            1 => "#ffffff",
            2 => "#e7edbe",
            3 => "#c9f5ce",
            4 => "#ef9292",
            5 => "#ef9292",
        ];
        $this->data['dateFields'] = ['TripStartDate','TripEndDate'];
        
        $this->data['pk'] = "EventId";
        $this->data['actionFunc'] = "fsm_EventForm";
        //$this->data['singleFunc'] = "fsm_EventSingle";
        //$this->data['rowButtons'] = ["fsm_EventSingle" => "zmdi zmdi-eye"];
        $this->data['canEditIf'] = ["col" => "EventStatus","val" => "1"];
        $this->data['valKeys'] = [
            "EventTypeId" => $eventTypes,
            "EventStatus" => WorkflowManager::getStatusList($this->WfDoc)];
        //$this->data['listFilters'] = $this->getConfig("ESS", "tripFilters");
       
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            if(isset($_GET['id'])){
                $eventEmpId = \entities\EventsQuery::create()->findPk($_GET['id']);
                if($eventEmpId){
                    if($eventEmpId->getEmployeeId() == $this->app->Auth()->getUser()->getEmployeeId()){
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
            $eventdatearray = \Modules\FSM\Runtime\FSMHelper::eventStartEndDate($page,$reqs,$this->app->Auth()->getUser()->getEmployeeId());
        }else{
            $eventdatearray =\Modules\FSM\Runtime\FSMHelper::eventStartEndDate('A',$emp,$emp);
        }
        
        $this->data['eventFilterDate'] = $eventdatearray;
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
               
               $this->app->Renderer()->render('fsm/eventlist.twig',$this->data);
               break;
            case "list":
               $filter = $this->app->Request()->getParameter("filter");
               $filterdate = $this->app->Request()->getParameter("filterdate");
               
               $pks = WorkflowManager::getPendingRequestPks($this->WfDoc,$this->app);
               
               if($emp == 0){
                    $emp = $this->app->Auth()->getUser()->getEmployee()->getPrimaryKey();
               }else{
                   //$emp = \entities\EmployeeQuery::create()->findPk($emp);
                   $filter = 'A';   
               }
               
               $records = \Modules\FSM\Runtime\FSMHelper::getallEventListnew($filter,$filterdate,$pks,$emp);
               
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
                    $eventdatearray = \Modules\FSM\Runtime\FSMHelper::eventStartEndDate($filter,$reqs,$this->app->Auth()->getUser()->getEmployeeId());
                }
                $this->json($eventdatearray);
               break;
            case "quickView":
                $this->quickEventView($this->app->Request()->getParameter("eventId"));
                break;
            case "deleteEvent":                
                \Modules\FSM\Runtime\FSMHelper::deleteEvent($this->app->Request()->getParameter("eventId"),$this->app->Auth()->CompanyId());                
                $this->json(["status"=>0]);
                break;
       endswitch;
       
    }

    public function setNextAction($id,$stepid) {
        
        $entity = \entities\EventsQuery::create()->findPk($id);   
        
        $employee = \entities\EmployeeQuery::create()->findPk($entity->getEmployeeId());
                                
        $f = FormMgr::formHorizontal();
        $step = \entities\WfStepsQuery::create()->findPk($stepid);                
                
        
        $allowedStatus = WorkflowManager::getStatusList($this->WfDoc,$step->getWfOutStatus());                
        
        $f->add(['EventStatus' => FormMgr::select()->options($allowedStatus)->label('Status'),
            'note' => FormMgr::text()->label('Note'), ]);        
                
        $f->val($entity->toArray());
                        
         if($this->app->isPost() && $f->validate()){
                         
            $entity->fromArray($_POST);                                            
            $entity->save();
            
            $wfManager = new \Modules\System\Processes\WorkflowManager();            
            $wfManager->process($this->WfDoc, $entity,$this->app->Request()->getParameter("note",""));
            
            // if ($employee->getUserss()->getFirst()->getFcmToken() != "") {
            //     $notification = new \App\Utils\Notifications(\App\Abstracts\NotificationType::URLRedirect, "", []);
            //     $notification->setMessage($_POST['EventStatus']);
            //     $notification->setFCMToken($employee->getUserss()->getFirst()->getFcmToken());
            //     $a = $notification->sendFCMNotification();
            // }
            
            if($entity->getEventStatus() == 2) // Approved
            {
                \Modules\FSM\Runtime\FSMHelper::BlockTourPlan($entity);
            }
            $this->closeModalWithToast(self::statusMsg(1,$_POST['EventStatus']));
            return; 
            
        }  
        
        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig",$this->data);
        
    }

    public function single($id) {
        $emp = 0;
        if($this->app->Request()->getParameter("page","") == 'P'){
            \Modules\System\Runtime\UserTriggers::checkOnce("firstTimeApproval", $this->app->Auth()->getUser()->getUserId());
        }
        
        $eventActionId = $this->app->Request()->getParameter("id",-1);
        if($eventActionId > 0)
        {
            $this->app->Response()->redirect($this->app->Router()->getPath("fsm_EventSingle",["id"=>$eventActionId]));
        }
        
        $this->data['title'] = "Events";
        $this->data['form_name'] = "Event";
        $this->data['cols'] = [
            "Date" => "EventDate",
            "Type" => "EventTypeId",
            "First Name" => "EmployeeRelatedByEmployeeId.FirstName",            
            "Last Name" => "EmployeeRelatedByEmployeeId.LastName",            
            "EventRemark" => "EventRemark",            
            "Event Status" => "EventStatus",            
            
        ];
        
        $eventTypes = \entities\EventTypesQuery::create()
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->find()->toKeyValue("EventTypeId","EventTypeName");
        
        $this->data['colorRows'] = [
            1 => "#ffffff",
            2 => "#e7edbe",
            3 => "#c9f5ce",
            4 => "#ef9292",
            5 => "#ef9292",
        ];
        $this->data['dateFields'] = ['TripStartDate','TripEndDate'];
        
        $this->data['pk'] = "EventId";
        $this->data['actionFunc'] = "fsm_EventForm";
        //$this->data['singleFunc'] = "fsm_EventSingle";
        //$this->data['rowButtons'] = ["fsm_EventSingle" => "zmdi zmdi-eye"];
        $this->data['canEditIf'] = ["col" => "EventStatus","val" => "1"];
        $this->data['valKeys'] = [
            "EventTypeId" => $eventTypes,
            "EventStatus" => WorkflowManager::getStatusList($this->WfDoc)];
        //$this->data['listFilters'] = $this->getConfig("ESS", "tripFilters");
       
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            if(isset($_GET['id'])){
                $eventEmpId = \entities\EventsQuery::create()->findPk($_GET['id']);
                if($eventEmpId){
                    if($eventEmpId->getEmployeeId() == $this->app->Auth()->getUser()->getEmployeeId()){
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
            $eventdatearray = \Modules\FSM\Runtime\FSMHelper::eventStartEndDate($page,$reqs,$this->app->Auth()->getUser()->getEmployeeId());
        }else{
            $eventdatearray =\Modules\FSM\Runtime\FSMHelper::eventStartEndDate('A',$emp,$emp);
        }
        
        $this->data['eventFilterDate'] = $eventdatearray;
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
               
               $this->app->Renderer()->render('fsm/eventlist.twig',$this->data);
               break;
            case "list":
               $filter = $this->app->Request()->getParameter("filter");
               $filterdate = $this->app->Request()->getParameter("filterdate");
               
               $pks = WorkflowManager::getPendingRequestPks($this->WfDoc,$this->app);
               
               if($emp == 0){
                    $emp = $this->app->Auth()->getUser()->getEmployee()->getPrimaryKey();
               }else{
                   //$emp = \entities\EmployeeQuery::create()->findPk($emp);
                   $filter = 'A';   
               }
               
               $records = \Modules\FSM\Runtime\FSMHelper::getallEventListnew($filter,$filterdate,$pks,$emp);
               
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
                    $eventdatearray = \Modules\FSM\Runtime\FSMHelper::eventStartEndDate($filter,$reqs,$this->app->Auth()->getUser()->getEmployeeId());
                }
                $this->json($eventdatearray);
               break;
            case "quickView":
                $this->quickEventView($this->app->Request()->getParameter("eventId"));
                break;
            case "deleteEvent":                
                \Modules\FSM\Runtime\FSMHelper::deleteEvent($this->app->Request()->getParameter("eventId"),$this->app->Auth()->CompanyId());                
                $this->json(["status"=>0]);
                break;
       endswitch;
       
    }
    
    static function statusMsg($type,$status){
        if($type == 1){
            switch ($status):
                case "1" :
                    return "Event Created successfully";
                break;                
                case "2" :
                    return "Event Approved successfully";
                break;
                case "3" :
                    return "Event Rejected successfully";
                break;                
            endswitch;
        }
    }
    
    public function quickEventView($pk)
    {
        $event = \entities\EventsQuery::create()
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->findPk($pk);
        $this->data['event'] = $event;        
        
        if(in_array($event->getEventStatus(),[1,2]) && $event->getEmployeeId() == $this->app->Auth()->getUser()->getEmployeeId()){
            $this->data['getEventStatus'] = $event->getEventStatus();
        }
        $this->data['event_actions'] = \Modules\System\Processes\WorkflowManager::getActions($this->WfDoc,$pk ,$event->getEventStatus() , $this->app,2);
        $this->app->Renderer()->render("fsm/eventQuickView.twig",$this->data);
    }
    
    
}
