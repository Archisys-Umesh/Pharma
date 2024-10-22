<?php declare(strict_types = 1);

namespace Modules\FSM\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use BI\manager\MTPManager;
use entities\DesignationsQuery;
use entities\EmployeeQuery;
use entities\MtpQuery;
use entities\OutletOrgDataQuery;
use entities\OutletTypeQuery;
use entities\OutletViewQuery;
use entities\TourplansQuery;
use entities\TerritoriesQuery;
use entities\TerritoryTowns;
use entities\TerritoryTownsQuery;
use Modules\FSM\Runtime\FSMHelper;
use Propel\Runtime\ActiveQuery\Criteria;

class Beats extends \App\Core\BaseController
{
    protected $app;
    
    public function __construct(App $app)
    {
            $this->app = $app;               
    }

    function getTerritoryTowns($TerritoryId = null)
    {
        $towns = TerritoryTownsQuery::create()
        ->joinWithGeoTowns()
        ->filterByTerritoryId($TerritoryId)
        ->find();

        $townArray = [];
        foreach($towns as $t)
        {
            $townArray[$t->getItownid()] = $t->getGeoTowns()->getStownname();
        }

        return $townArray;
    }
    function beats(){
     
             
       $action = $this->app->Request()->getParameter("action");
       $pk = $this->app->Request()->getParameter("pk",0);

       $datachange = $this->app->Request()->getParameter("datachange");

       if($datachange == "changeOrgUnitId")       
       {
            $OrgUnitId = $this->app->Request()->getParameter("OrgUnitId");
            $territory = \entities\TerritoriesQuery::create()
                            ->filterByOrgunitid($OrgUnitId)
                            ->findByCompanyId($this->app->Auth()->CompanyId())
                            ->toKeyValue("TerritoryId","TerritoryName");

            $html = FormMgr::select()->options($territory)->label('TerritoryId')->id("TerritoryId")->datachange("changeTerritoryId")->html();
            $this->json(["terr"=>$html]);
            return;
       }
       if($datachange == "changeTerritoryId")       
       {
            $TerritoryId = $this->app->Request()->getParameter("TerritoryId");
            
            $townArray = $this->getTerritoryTowns($TerritoryId);
            
            $html = FormMgr::select()->options($townArray)->label('Itownid')->id("Itownid")->html();
            $this->json(["towns"=>$html]);
            return;
       }
       
       switch($action) : 
           case "":

            $this->data['title'] = "Beats";
            $this->data['form_name'] = "Beats";
            $this->data['cols'] = [
                "Name" => "BeatName",           
                "Code" => "BeatCode",
                "Territory"=>"Territories.TerritoryName",
                "Town"=>"GeoTowns.Stownname"           
            ];
       
            $this->data['pk'] = "BeatId";       
            $this->data['rowButtons'] = ["fsm_beatoutlets" => "zmdi zmdi-layers"];

            $this->data['listFilters'] = 
                ["OrgUnit" => \entities\OrgUnitQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Orgunitid","UnitName"),];

               $this->app->Renderer()->render("dataTableServerSideTemplate.twig",$this->data);
               break;
           case "list":
               $orgUnit = $this->app->Request()->getParameter("OrgUnit",0);
               
               $terrArray = TerritoriesQuery::create()->select(["TerritoryId"])
                                ->filterbyOrgunitid($orgUnit)->find()->toArray();

                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\BeatsQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId())->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')->filterByTerritoryId($terrArray);
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query = $query->filterByBeatName($search, Criteria::LIKE);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->joinWithTerritories()->joinWithGeoTowns()->offset($offset)->limit($limit)->orderBy($sortColumn,$sortOrder)->find()->toArray();
                $this->json($response);
                break;                
           case "form":
               
                    
                    $OrgUnitId = \entities\OrgUnitQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Orgunitid","UnitName");
                    $territory = [];
                    $townArray = [];
                    $beat = new \entities\Beats();
                    $this->data['form_name'] = "Add Beat";

                    if($pk > 0)
                    {
                        $beat = \entities\BeatsQuery::create()->findPk($pk);

                        $territory = \entities\TerritoriesQuery::create()
                            ->filterByOrgunitid($beat->getOrgUnitId())
                            ->findByCompanyId($this->app->Auth()->CompanyId())
                            ->toKeyValue("TerritoryId","TerritoryName");

                        $townArray = $this->getTerritoryTowns($beat->getTerritoryId());
                    } else {
                        $territory = \entities\TerritoriesQuery::create()
                            ->findByCompanyId($this->app->Auth()->CompanyId())
                            ->toKeyValue("TerritoryId","TerritoryName");

                        $townArray = $this->getTerritoryTowns();
                    }

                    $f = FormMgr::formHorizontal();
                    $f->add([                                                
                        
                        'BeatName' => FormMgr::text()->label('Name *')->required(),
                        'BeatRemark' => FormMgr::text()->label('Remark *'),
                        'BeatCode' => FormMgr::text()->label('Code *')->required(),                        
                        'OrgUnitId' => FormMgr::select()->options($OrgUnitId)->label('OrgUnitId')->id("OrgUnitId")->datachange("changeOrgUnitId"),                    
                        'TerritoryId' => FormMgr::select()->options($territory)->label('TerritoryId')->id("TerritoryId")->datachange("changeTerritoryId"),                    
                        'Itownid' => FormMgr::select()->options($townArray)->label('Itownid')->id("Itownid"),                    
                        

                                                                                      
                    ]);
                    
                    
                    
                    if($pk > 0)
                    {                        
                        $f->val($beat->toArray());
                        $f['TerritoryId']->sudovalue($beat->getTerritories()->getTerritoryName());
                        $f['Itownid']->sudovalue($beat->getGeoTowns()->getStownname());
                        
                        $this->data['form_name'] = "Edit Beat";
                    }
                    if($this->app->isPost() && $f->validate()){
                        $beat->fromArray($_POST);                                                        
                        $beat->setCompanyId($this->app->Auth()->CompanyId());
                        $beat->save();                        
                        $this->runModalScript("loadGrid()");
                        return; 
                    }                                        
                    $this->data['form'] = $f->html();
                    $this->app->Renderer()->render("fsm/addBeat.twig",$this->data);
               break;
       endswitch;
        
    }
    
    function beatoutlets($id)
    {
      $beatid = $id;
      $beat = \entities\BeatsQuery::create()->findPk($beatid);
      
      if($this->isAjax())
       {
        $action = $this->app->Request()->getParameter("action");
        
        switch ($action) :
            case "list":
                
                $keys = OutletOrgDataQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())                                        
                    ->filterByItownid($beat->getItownid())                    
                    ->filterByOrgUnitId($beat->getTerritories()->getOrgunitid())
                    ->joinWithOutlets()
                    ->joinWithBeatOutlets(Criteria::LEFT_JOIN)
                    ->find();
                $outletTypes = OutletTypeQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("OutlettypeId","OutlettypeName");
                $lines = \entities\BeatOutletsQuery::create()->findByBeatId($beatid)->toKeyIndex("BeatOrgOutlet");

                $data = [];

                foreach($keys as $k)
                {
                 
                    $outlet = $k->getOutlets();
                    $val = [
                            "OutletId" => $k->getPrimaryKey(),                            
                            "Type" => $outletTypes[$outlet->getOutlettypeId()],
                            "OutletName" => $outlet->getOutletName()." | ".$outlet->getOutletCode(),
                            "Contact" => $outlet->getOutletContactName(),
                            "Class" => $outlet->getClassification()->getClassification(),
                            "VFq" => $k->getCustomerFq(),                            
                            "Tags" => $k->getTags(),                            
                            "Qualification" => $outlet->getOutletQualification()
                            ];
                    $monitor = $k->getBeatOutletss();     
                    if(count($k->getBeatOutletss()) > 0)
                    {
                        $val["Enabled"] = 2;
                        $val["Remark"] = "Conflict";
                    }
                    if(isset($lines[$k->getPrimaryKey()]))
                     {                
                         $val["Enabled"] = 1;                         
                         $val["LineId"] = $lines[$k->getPrimaryKey()]->getPrimaryKey();
                     }
                     array_push($data, $val);
                }
                $this->json(["data" => $data]);
            break;
            case "save":
                
                $data = $this->app->Request()->getParameter("data");
                
                $collection = new \Propel\Runtime\Collection\ObjectCollection();
                $collection->setModel(\entities\BeatOutlets::class);
                //$keys = [];
                if (!empty($data) && is_array($data)) {
                    foreach($data as $d)
                    {
                        $obm = new \entities\BeatOutlets();
                        $obm->setBeatId($beatid);
                        $obm->setBeatOrgOutlet($d['OutletId']);                                        
                        $obm->setCompanyId($this->app->Auth()->getUser()->getCompanyId());                                  
                        
                        $collection->append($obm);
                    }
                }
                
                // \entities\BeatOutletsQuery::create()                        
                //         ->findByBeatId($beatid)->delete();
                
                $collection->save();
                
                $this->json(["status" => "okay"]);
                
            break;
        endswitch;
                
       }
       else {       
        $this->data['beat'] = $beat;
        
        $this->app->Renderer()->render("fsm/BeatOutletMap.twig",$this->data);
       }
    }
    
    function tourplanList()
    {
       $action = $this->app->Request()->getParameter("action");
       switch($action) : 
           case "":
               $this->data["orgUnit"] = \entities\OrgUnitQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Orgunitid","UnitName");
               $this->data["designation"] = \entities\DesignationsQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("DesignationId","Designation");
               $this->data["monthList"] = \Modules\ESS\Runtime\EssHelper::getAllowedMonths($this->getConfig("FSM", "allowedMonths"));
               $this->app->Renderer()->render("beats/TourPlanList.twig",$this->data);
               break;
           case "empList":
               $orgUnit = $this->app->Request()->getParameter("orgUnit");
               $designation = $this->app->Request()->getParameter("designation");
               $month = $this->app->Request()->getParameter("monthList");
               
               $employeelist = \entities\EmployeeQuery::create()
                       ->filterByCompanyId($this->app->Auth()->CompanyId())
                       ->filterByOrgUnitId($orgUnit)
                       ->filterByDesignationId($designation)
                       ->find();
                                             
               $this->data["month"] = $month;               
               $this->data["employeelist"] = $employeelist;              
               $this->app->Renderer()->render("beats/TourPlanList.twig",$this->data);                              
           break;
       endswitch;  
        
    }
    
    



    function getPlanActivity()
    {
       $action = $this->app->Request()->getParameter("action");
       switch($action) : 
           case "blank":
               $this->json(["data" =>[]]);
               break;
           case "list":
               
               $empId = $this->app->Request()->getParameter("id");
               $Startdate = new \DateTime($this->app->Request()->getParameter("Startdate"));
               $EndDate = new \DateTime($this->app->Request()->getParameter("EndDate"));
               
               $masterResponse = [];
               
               for($i = $Startdate; $i <= $EndDate; $i->modify('+1 day')){
                     //echo $i->format("Y-m-d")."\n";
                   
                   $masterResponse[$i->format("Y-m-d")] = [
                       "TpDate" =>  $i->format("Y-m-d"),
                       "TpState" => "UnPlanned",
                       "TpSelection" => "",
                       "TpId" => 0,
                       "TpStatus" => -1
                   ];
                   
                 }
               
               $tourplan = \entities\Base\TourplansQuery::create()
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->filterByEmployeeId($empId)
                        ->filterByTpDate($this->app->Request()->getParameter("Startdate"),\Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                        ->filterByTpDate($this->app->Request()->getParameter("EndDate"), \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)                        
                        ->find();
               
               foreach($tourplan as $tp)
               {
                   $tpdate = $tp->getTpDate()->format("Y-m-d");
                   $masterResponse[$tpdate]["TpState"] = $tp->getTpState();
                   $masterResponse[$tpdate]["TpId"] = $tp->getTpId();
                   $masterResponse[$tpdate]["TpStatus"] = $tp->getTpStatus();
                   if($tp->getBeatId() > 0)
                   {
                       $masterResponse[$tpdate]["TpSelection"] = $tp->getBeats()->getBeatName();
                   }
                   else 
                   {
                       $masterResponse[$tpdate]["TpSelection"] = $tp->getTpRemark();
                   }
                   
               }
               $this->json(["data" =>array_values($masterResponse)]);
               break;
           case "form":
               
               $empId = $this->app->Request()->getParameter("emp");
               $pk = $this->app->Request()->getParameter("TpId");
               $TpDate = $this->app->Request()->getParameter("TpDate");
               
	       
	       $employee = \entities\EmployeeQuery::create()->findPk($empId);
	       
               $f = FormMgr::formHorizontal();
        
               $TPStates = $this->getConfig("FSM","TPStates");
               $beats = \entities\BeatsQuery::create()
                       ->filterByCompanyId($this->app->Auth()->CompanyId())
                       ->filterByEmployeeId($empId)
                       ->find()->toKeyValue("BeatId","BeatName");                    
	       
	       $outletsArray = \entities\OutletsQuery::create()->filterByTerritoryId($employee->getTerritoryId())->find()->toKeyValue("Id","OutletName");
	       
               $f->add([
                   'TpState' => FormMgr::select()->options($TPStates)->label('Activity')->id("TpState"),
                   'TpRemark' => FormMgr::text()->label('Remark *')->id("TpRemark"),            
                   'BeatId' => FormMgr::select()->options($beats)->label('Beats')->id("BeatId"),                    
		   'OutletIds' => FormMgr::select()->options($outletsArray)->label('Outlets')->id("OutletIds")->class("multi-select")->multiple("multiple"),                    
                ]);
               
               $entity = new \entities\Tourplans();
               $this->data['form_name'] = "Add plan for ".$TpDate;
               if($pk > 0)
               {
                   $entity = \entities\Base\TourplansQuery::create()
                           ->findPk($pk);
                   $f->val($entity->toArray());
		   if($entity->getOutletIds() != null && $entity->getOutletIds() != ''){
                       $f['OutletIds']->val(explode(",", $entity->getOutletIds()));
                   }
                   $this->data['form_name'] = "Edit plan for ".$TpDate;
               }
               
               if($this->app->isPost() && $f->validate()){
                   
		   $remark = "";
		   if(isset($_POST['OutletIds']))
		   {
			$outlets = $_POST['OutletIds'];
			$_POST['OutletIds'] = implode(",", $outlets);			
			
			foreach ($outlets as $o)
			{
				
				$remark = $remark. $outletsArray[$o].",";
			}					
		   }
                   $entity->fromArray($_POST);
                   $entity->setCompanyId($this->app->Auth()->CompanyId());
                   $entity->setTpDate($TpDate);
                   $entity->setEmployeeId($empId);		   
		   
                   if(!isset($_POST['BeatId']))
                   {
                       $entity->setBeatId(null);
                   }		   
		   if($remark != "") { 
                       $entity->setTpRemark($remark);
                   }
		   
                   $entity->save();
                   $this->runModalScript("reloadActivities()");
                   return; 
               }
               
               $this->data['form'] = $f->html();
               $this->app->Renderer()->render("beats/TourPlanForm.twig",$this->data);
               break;
            case "approve";

                    $empId = $this->app->Request()->getParameter("id");
                    $Startdate = new \DateTime($this->app->Request()->getParameter("Startdate"));
                    $EndDate = new \DateTime($this->app->Request()->getParameter("EndDate"));

                    $rec = TourplansQuery::create()
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->filterByEmployeeId($empId)
                        ->filterByTpDate($this->app->Request()->getParameter("Startdate"),\Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                        ->filterByTpDate($this->app->Request()->getParameter("EndDate"), \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)->find();
                        
                    foreach($rec as $r)
                    {
                        $r->setTpStatus(1);
                        $r->save();
                    }
                    $this->json(["data" =>["Okay"]]);
                break;
           break;
       endswitch;  
    }

    function territorySearch()
    {
        $q = $this->app->Request()->getParameter("term");
               
        $territories = TerritoriesQuery::create()
                ->filterByTerritoryName($q."%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)
                ->joinOrgUnit()
                ->joinPositions()
                //->filterByLastName($q."%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)
                ->limit(100)
                ->findByCompanyId($this->app->Auth()->CompanyId());
        
        $res = [];
        
        foreach($territories as $terr)
        {                  
         $res[] = ["label" => $terr->getOrgUnit()->getUnitName()." > ".$terr->getTerritoryName()." | ".$terr->getPositions()->getPositionName(),"value" => [],"id" => $terr->getPrimaryKey()];
        }
        
        $this->json($res);
    }

}