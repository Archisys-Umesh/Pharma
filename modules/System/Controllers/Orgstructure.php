<?php declare(strict_types = 1);
namespace Modules\System\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use App\Core\MediaManager;
use BI\manager\OrgManager;

class Orgstructure extends \App\Core\BaseController
{	               
    protected $app;

    public function __construct(App $app)
    {
            $this->app = $app;	
           
    }

    public function getPositions($OrgUnitId)
    {
        $positionarray = [];

            if($OrgUnitId == 0) {

                $reortingTo = FormMgr::select()->options([])->label('Reporting To')->html();
                $this->json(["reortingTo" => $reortingTo]);
                return;
            }

            $positions = \entities\PositionsQuery::create()
                            ->filterByOrgUnitId($OrgUnitId)
                            ->filterByCompanyId($this->app->Auth()->CompanyId())->find();
            if($positions){

                $positionarray = [0 => " -- Top Level --"];

                foreach ($positions as $p){                
                    $positionarray[$p->getPrimaryKey()] = $p->getPositionName()." | ".$p->getPositionCode()." > ".$p->getOrgUnit()->getUnitName();
                }

            }
        return $positionarray;
    }
    public function postionForm($id = 0)
    {
        $datachange = $this->app->Request()->getParameter("datachange","");
        
        if($datachange == "OrgUnitIdChange")
        {
            $OrgUnitId = $this->app->Request()->getParameter("OrgUnitId",0);
            
            $reortingTo = FormMgr::select()->options($this->getPositions($OrgUnitId))->label('Reporting To')->html();
            $this->json(["reortingTo" => $reortingTo]);
            return;

        }

        
        $OrgUnitId[0] = "-- Select OrgUnit -- ";
        $OrgUnitlist = \entities\OrgUnitQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Orgunitid","UnitName");
        foreach($OrgUnitlist as $key => $val)
        {
            $OrgUnitId[$key] = $val;
        }
        
        $positionarray = [];
        if($id > 0)
        {
            $position = \entities\PositionsQuery::create()->findPk($id);
            $positionarray = $this->getPositions($position->getOrgUnitId());
        }
        $f = FormMgr::formHorizontal();

        $mtpTypes = $this->getConfig('FSM', 'MtpType');
                
        $f->add([
            'OrgUnitId' => FormMgr::select()->options($OrgUnitId)->label('Org Unit')->datachange("OrgUnitIdChange"),
            'ReportingTo' => FormMgr::select()->options($positionarray)->label('Reporting To'),
            'PositionName' => FormMgr::text()->label('Name *')->required()->class('text-uppercase')->minlength(5)->pattern(__NOSPACE_PATERN),            
            'PositionCode' => FormMgr::text()->label('Code *')->required()->class('text-uppercase'),
            'MtpType' => FormMgr::select()->options($mtpTypes)->label('MtpType')
        
        ]);
                
        $position = new \entities\Positions();
        $this->data['form_name'] = "Add Position";
        if($id > 0)
        {
            $position = \entities\PositionsQuery::create()->findPk($id);
            $vals = $position->toArray();                        
            $f->val($vals);
            $this->data['canDelete'] = true;
            $this->data['form_name'] = "End Position";
        }
        
        if($this->app->isPost()){
            $otherRows = \entities\PositionsQuery::create()
                    ->filterByPositionName($_POST['PositionName'])
                    ->filterByPositionId($id, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                    ->findByCompanyId($this->app->Auth()->CompanyId())->count();
    
            if($otherRows > 0)
            {
                $this->app->Session()->setFlash("error", "Sorry Position Name already exists !!!");                            
                $f->val($_POST);                                                        
                
            }else{    
                if($f->validate())
                {
                    if($_POST['buttonValue'] == "delete")
                    {
                        
                        \entities\EmployeeQuery::create()->filterByPositionId($position->getPrimaryKey())->update(['PositionId'=>0]);                        
                        $position->delete();
                    }
                    else {
                        $_POST['PositionName'] = strtoupper($_POST['PositionName']);
                        $_POST['PositionCode'] = strtoupper($_POST['PositionCode']);

                        $position->fromArray($_POST);                
                        $position->setCompanyId($this->app->Auth()->CompanyId());
                        $position->save();
                    }
                    $this->runModalScript("reloadTree()");
                    return;
                }
                else {
                    $f->val($_POST);
                }
            }
        }
        $this->data['form_name'] = "Add Position";
        
        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("system/addPosition.twig",$this->data);
    }

    public function orgStructure()
    {
        $companyId = $this->app->Auth()->CompanyId();

        if($this->isAjax()) {
            
            if($_GET['action'] == "tree") {
                $OrgUnitId = $this->app->Request()->getParameter("OrgUnitId");
                $position = \entities\PositionsQuery::create()
                                ->orderByReportingTo()
                                ->filterByOrgUnitId($OrgUnitId)
                                ->filterByCompanyId($companyId)
                                ->find();        
                $arrayCategories = [];
                $pk = $this->app->Request()->getParameter("pk",0);

                foreach($position as $p)
                {                        
                    $parent = $p->getReportingTo();
                    $currentEmp = [];
                    $emps = $p->getEmployeesRelatedByPositionId();
                    if($emps->count() > 0)
                    {
                        foreach ($emps as $e)
                        {                            
                            if($e->getStatus() == 1) {
                                array_push($currentEmp, $e->getFirstName()." ".$e->getLastName().'- '.$e->getEmployeeCode());
                            }
                        }
                    }
                    else {
                        $currentEmp = [" - Vacant - "];
                    }
                    if($parent == 0) {$parent = "#"; }                
                    $arrayCategories[] = array("id" => $p->getPositionId(),"parent" => $parent, "text" => $p->getPositionName() ." | ". $p->getPositionCode().' - '.implode(",", $currentEmp),"icon" => "fa fa-folder");               
                }

                $this->json($arrayCategories);
            }
                        
        }
        else {   
            $OrgUnitId = \entities\OrgUnitQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Orgunitid","UnitName");         
            $f = FormMgr::formInline();
                
            $f->add([
                'OrgUnitId' => FormMgr::select()->options($OrgUnitId)->label('Org Unit')->id("OrgUnitId"),                
            ]);

            $this->data['org_form'] = $f->html();           

            $this->app->Renderer()->render("system/positions.twig",$this->data);
        }
    }

    public function doCAV($id)
    {
        $mgr = new OrgManager();
        $mgr->updateCAV($this->app->Auth()->CompanyId(),$id);
        exit;
    }
}