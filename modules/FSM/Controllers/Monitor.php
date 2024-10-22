<?php declare(strict_types = 1);

namespace Modules\FSM\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use entities\AttendanceQuery;
use entities\Base\OutletCheckinQuery;
use entities\EmployeeQuery;
use entities\TerritoriesQuery;

class Monitor extends \App\Core\BaseController
{
    protected $app;
    
    public function __construct(App $app)
    {
            $this->app = $app;               
    }

    public function TeamView()
    {
        $action = $this->app->Request()->getParameter("action");
        $date = $this->app->Request()->getParameter("date",date("Y-m-d"));

        switch($action) : 
            case "":
                $emp = EmployeeQuery::create()                    
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->filterByStatus(1)                                        
                    ->find();                    
                
                $Territories = TerritoriesQuery::create()
                                ->filterByCompanyId($this->app->Auth()->CompanyId())
                                ->find()->toKeyValue("TerritoryId","TerritoryName");
                
                $attendance = AttendanceQuery::create()
                            ->filterByCompanyId($this->app->Auth()->CompanyId())
                            ->filterByAttendanceDate($date)
                            ->find()->toKeyIndex("EmployeeId");
                                
                $this->data['empData'] = $emp;
                $this->data['attendance'] = $attendance;
                $this->data['territories'] = $Territories;

                $this->data['date'] = $date;
                $this->data['next_date'] = date('Y-m-d', strtotime($date. ' + 1 day'));
                $this->data['prev_date'] = date('Y-m-d', strtotime($date. ' - 1 day'));

                $this->app->Renderer()->render("fsm/teamList.twig",$this->data);
                break;
            case "punchData":
                break;
            endswitch;
        
    }

    function mapView()
    {               
        $id = $this->app->Request()->getParameter("id");
        $date = $this->app->Request()->getParameter("date",date("Y-m-d"));

        $emp = EmployeeQuery::create()->findPk($id);                           

        $pins = [];

        $attendance = AttendanceQuery::create()
                            ->filterByCompanyId($this->app->Auth()->CompanyId())
                            ->filterByAttendanceDate($date)
                            ->filterByEmployeeId($id)
                            ->orderByStartTime()
                            ->find();
        $homeLocation = "";
        foreach($attendance as $at)
        {
            $homeLocation = explode(",",$at->getStartLatlng());
            if(strlen($at->getStartLatlng()) > 5) {
            array_push($pins,[
                    "Type" => "PunchIn",
                    "Location" => explode(",",$at->getStartLatlng()),
                    "Time" => $at->getStartTime(),                    
                    "Caption" => str_replace('\"', '', $at->getStartAddress())
            ]);
            }
            if($at->getEndLatlng() != null && strlen($at->getEndLatlng()) > 5) {
                array_push($pins,[
                    "Type" => "PunchOut",
                    "Location" => explode(",",$at->getEndLatlng()),
                    "Time" => $at->getEndTime(),
                    "Caption" => str_replace('\"', '', $at->getEndAddress())
                ]);
            }
        }

        $outletCheckings = OutletCheckinQuery::create()                    
                    ->filterByCheckinDate($date)
                    ->filterByEmpId($id)
                    ->find();

        foreach($outletCheckings as $oc)                
        {
            if(strlen($oc->getCheckinLocation()) > 5)
            {
                array_push($pins,[
                    "Type" => "CheckIn",
                    "Location" => explode(",",$oc->getCheckinLocation()),
                    "Time" => $oc->getCheckinTime(),                    
                    "Caption" => $oc->getOutlets()->getOutletName()
                ]);   

                array_push($pins,[
                    "Type" => "Outlets",
                    "Location" => explode(",",$oc->getOutlets()->getOutletGps()),
                    "Time" => $oc->getCheckinTime(),                    
                    "Caption" => $oc->getOutlets()->getOutletName()
                ]);   
            }
        }
        $this->data['emp'] = $emp;
        $this->data['date'] = $date;

        $this->data['homeLocation'] = $homeLocation;
        $this->data['pins'] = $pins;

        $this->app->Renderer()->render("fsm/mapViewEmp.twig",$this->data);
    }

}