<?php declare(strict_types = 1);

namespace Modules\HR\Widgets;

use App\System\App;

class employeeOntrip implements \Modules\System\Interfaces\Widget 
{	               
    
    protected $app;
    protected $data = [];
    protected $widgetName = "expensesApproval";
    protected $param = [];
    public function __construct(\App\System\App $app)
    {
            $this->app = $app;	
            
    }

    public function allowedKeys(): array {
        return ["ess_branch_admin","ess_org_admin"];        
    }

    public function getWidgetDesc() {
        return "Add Claims";
    }

    public function getWidgetName() {
        return $this->widgetName;
    }

    public function render() {
        $employeeid = 0;
        if($this->app->Auth()->checkPerm("ess_org_admin")){
            //$orgUnitId = $this->app->Auth()->getUser()->getEmployee()->getOrgUnitId();
            $employeeid = \Modules\HR\Runtime\HrHelper::getESSOrgAdminEmployee($this->app->Auth()->CompanyId());
        }
        else if($this->app->Auth()->checkPerm("ess_branch_admin")){
            $branch = $this->app->Auth()->getUser()->getEmployee()->getBranchId();
            $employeeid = \Modules\HR\Runtime\HrHelper::getESSBranchAdminEmployee($branch);
        }
        
        $trip = \entities\TripsQuery::create()
                ->filterByEmployeeId($employeeid)
                ->filterByTripStartDate(date('Y-m-d'))
                ->filterByTripStatus([1,2])
                ->find();
        $tripArray = [];
        
        $wfManager = new \Modules\System\Processes\WorkflowManager(); 
        $trip_status = $wfManager->getStatusList('Trips');
        
        if($trip){
            foreach ($trip as $t){
                $type = "Ex-HQ";
                if($t->getTripType() == 2){
                    $type = "Out-Station";
                }
                array_push($tripArray, array(
                    "profilePic"=>$t->getEmployee()->getProfilePicture(),
                    "empName"=>$t->getEmployee()->getFirstName()." ".$t->getEmployee()->getLastName(),
                    "type"=>$type,
                    "origin"=>$t->getTripOriginName(),
                    "destination"=>$t->getTripDestinationName(),
                    "tripstartdate"=>$t->getTripStartDate()->format('d-m-Y'),
                    "tripenddate"=>$t->getTripEndDate()->format('d-m-Y'),
                    "tripstatus"=>$trip_status[$t->getTripStatus()],
                    "reason"=>$t->getTripReason(),
                    "TripId"=>$t->getTripId()
                ));
            }
        }
        
        
        if(count($tripArray) > 0) {
            $this->data['TripData'] = $tripArray;
            //var_dump($this->param);
            return $this->app->Renderer()->render("hr/homeWidget/employeeOntrip.twig",$this->data,FALSE);
        }
        else 
        {
            return "";
        }
    }

    public function parameters($params) {
     $this->param = $params;   
    }

}    