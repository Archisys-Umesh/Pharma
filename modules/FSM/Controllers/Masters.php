<?php

declare(strict_types=1);

namespace Modules\FSM\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use App\Core\MediaManager;
use BI\manager\OrgManager;
use entities\PositionsQuery;
use entities\TerritoriesQuery;
use entities\TerritoryTownsQuery;
use Propel\Runtime\ActiveQuery\Criteria;

class Masters extends \App\Core\BaseController
{

    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    function territories()
    {

        $this->data['title'] = "Territories";
        $this->data['form_name'] = "Territory";
        $this->data['cols'] = [
            "Name" => "TerritoryName",
            "OrgUnit" => "OrgUnit.UnitName",
            "Position" => "Positions.PositionName",
            "OnBoardingStatus" => "OnBoardingStatus",
            "StartDate" => "StartDate",
            "EndDate" => "EndDate",
        ];

        $this->data['pk'] = "TerritoryId";
        $this->data['valKeys'] = ["OnBoardingStatus" => $this->getConfig("FSM", "OnBoardingStatus")];

        $this->data['moreButtons'] = ["Create OnBoard Window" => ["fsm_onBoardWindow", "ajaxModal"]];
        $this->data['rowButtons'] = ["fsm_territoryTowns" => "zmdi zmdi-layers"];

        $this->data['listFilters'] = [
            "OrgUnit" => \entities\OrgUnitQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Orgunitid", "UnitName")
        ];
        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        $datachange = $this->app->Request()->getParameter("datachange", "");

        if ($datachange == "OrgUnitChange") {
            $Orgunit = $this->app->Request()->getParameter("Orgunitid");

            $positions = $this->findFreePositionsTerr($Orgunit, $pk);

            $this->json([
                "positions" => FormMgr::select()->options($positions)->html(),
            ]);
            return;
        }

        switch ($action):
            case "":
                $this->app->Renderer()->render("fsm/territorylist.twig", $this->data);
                break;
            case "list":
                $OrgUnit = $this->app->Request()->getParameter("OrgUnit");

                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\TerritoriesQuery::create()->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')->filterByOrgunitid($OrgUnit)->filterByCompanyId($this->app->Auth()->CompanyId());
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . strtolower($search) . '%';
                    $query = $query->where('LOWER(Territories.TerritoryName) LIKE ?', $search);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->joinWithOrgUnit()->joinWithPositions()->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);
                break;
            case "form":

                $OrgUnitId = \entities\OrgUnitQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Orgunitid", "UnitName");

                $territory = new \entities\Territories();
                $this->data['form_name'] = "Add Territory";

                if ($pk == 0) {
                    $positions = $this->findFreePositionsTerr(array_key_first($OrgUnitId), $pk);
                } else {
                    $territory = \entities\TerritoriesQuery::create()->findPk($pk);
                    $positions = $this->findFreePositionsTerr($territory->getOrgunitid(), $pk);
                    $this->data['form_name'] = "Edit Territory";
                }

                $f = FormMgr::formHorizontal();
                $f->add([
                    'TerritoryName' => FormMgr::text()->label('Name *')->required()->minlength(5)->pattern(__NOSPACE_PATERN),
                    'Orgunitid' => FormMgr::select()->options($OrgUnitId)->label('OrgUnit')->datachange('OrgUnitChange'),
                    'PositionId' => FormMgr::select()->options($positions)->label('Position'),
                ]);

                if ($pk > 0) {
                    $f->val($territory->toArray());
                }


                if ($this->app->isPost() && $f->validate()) {
                    $territory->fromArray($_POST);
                    $territory->setCompanyId($this->app->Auth()->CompanyId());
                    $territory->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("fsm/territories.twig", $this->data);
                break;
        endswitch;
    }

    public function territoryTowns($id)
    {
        $territory = TerritoriesQuery::create()->findPk($id);

        $this->data['title'] = $territory->getTerritoryName() . " " . $territory->getTerritoryCode() . " | Towns";
        $this->data['form_name'] = "TerritoryTowns";
        $this->data['cols'] = [
            "Town" => "GeoTowns.Stownname",
            "TownCode" => "GeoTowns.Stowncode",
            "AssignTo TripType" => "AssignToTripType",
            "Others TripType" => "OthersTripType",
            "OnlyNca" => "OnlyNca",
        ];

        $this->data['pk'] = "TerritoryTownsId";

        $datachange = $this->app->Request()->getParameter("datachange", "");
        if ($datachange == "townSelected") {
            $Itownid = $this->app->Request()->getParameter("Itownid", 0);
            return;
        }

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action):
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":
                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\TerritoryTownsQuery::create()->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')->filterByCompanyId($this->app->Auth()->CompanyId())->filterByTerritoryId($id);
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query = $query->useGeoTownsQuery()->filterByStownname($search, Criteria::LIKE)->_or()->filterByStowncode($search, Criteria::LIKE)->endUse();
                    // $query = $query->filterByTerritoryName($search, Criteria::LIKE);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->joinWithGeoTowns()->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);
                break;
            case "form":



                $towns = new \entities\TerritoryTowns();

                $f = FormMgr::formHorizontal();
                $f->add([
                    'Itownid' => FormMgr::text()->label('Town *')->datatoggle("locationAutoComplete")->required()->datachange('townSelected'),
                    'AssignToTripType' => FormMgr::select()->options($this->getConfig("ESS", "tripTypes"))->label('Assign To Trip Type'),
                    'OthersTripType' => FormMgr::select()->options($this->getConfig("ESS", "tripTypes"))->label('Others Trip Type'),
                    'OnlyNca' => FormMgr::checkbox()->label('Only Nca'),
                ]);

                if ($pk > 0) {
                    $towns = \entities\TerritoryTownsQuery::create()->findPk($pk);
                    $f->val($towns->toArray());
                    $this->data['form_name'] = "Edit Towns";
                }


                if ($this->app->isPost() && $f->validate()) {
                    if (!empty($_POST['OnlyNca'])) {
                        $OnlyNca = true;
                    } else {
                        $OnlyNca = false;
                    }
                    $towns->fromArray($_POST);
                    $towns->setCompanyId($this->app->Auth()->CompanyId());
                    $towns->setOnlyNca($OnlyNca);
                    $towns->setTerritoryId($id);
                    $towns->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }


    function findFreePositionsTerr($Orgunit, $terr_id)
    {
        $positions = PositionsQuery::create()->filterByOrgUnitId($Orgunit)->find()->toKeyValue("PositionId", "PositionName");

        $nonPositions = TerritoriesQuery::create()
            ->filterByOrgunitid($Orgunit)
            ->filterByTerritoryId($terr_id, Criteria::NOT_EQUAL)
            ->select(["PositionId"])
            ->find()->toArray();
        foreach ($nonPositions as $pos) {
            if (isset($positions[$pos])) {
                unset($positions[$pos]);
            }
        }

        return $positions;
    }

    function onBoardWindow()
    {
        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        $datachange = $this->app->Request()->getParameter("datachange", "");

        $OrgUnits = \entities\OrgUnitQuery::create()
            ->findByCompanyId($this->app->Auth()->CompanyId())
            ->toKeyValue("Orgunitid", "UnitName");

        $territories = [];
        if ($datachange == "OrgUnitChange") {
            $Orgunit = $this->app->Request()->getParameter("OrgUnit");
            $territories = \entities\TerritoriesQuery::create()->filterByOrgunitid($Orgunit)->find()->toKeyValue("TerritoryId", "TerritoryName");
            $this->json([
                "Territory" => FormMgr::select()->options($territories)->html(),
            ]);
            return;
        }

        $states = \entities\GeoStateQuery::create()->find()->toKeyValue("Istateid", "Sstatename");

        $status = $this->getConfig("FSM", "OnBoardingStatus");


        $territory = new \entities\Territories();
        $this->data['form_name'] = "Add OnBoardWindow";

        if ($pk == 0) {
            $positions = $this->findFreePositionsTerr(array_key_first($OrgUnits), $pk);
        } else {
            $territory = \entities\TerritoriesQuery::create()->findPk($pk);
            $positions = $this->findFreePositionsTerr($territory->getOrgunitid(), $pk);
            $this->data['form_name'] = "Edit OnBoardWindow";
        }

        $f = FormMgr::formHorizontal();
        $f->add([
            'OnBoardingStatus' => FormMgr::select()->options($status)->label('On Boarding Status')->id('statusOn'),
            'StartDate' => FormMgr::text()->label('Start Date')->direction("range")->class('datepicker')->dmin("0D")->autocomplete("off")->readonly("readonly")->required(),
            'EndDate' => FormMgr::text()->label('End Date')->direction("range")->class('datepicker')->dmin("0D")->autocomplete("off")->readonly("readonly")->required(),
            'TerritoryId' => FormMgr::hidden()->id('TerritoryArrayAppend')->class('TerritoryTest'),
        ]);

        if ($pk > 0) {
            $f->val($territory->toArray());
        }

        if ($this->app->isPost() && $f->validate()) {
            $onBoardingStatus = $_POST["formData"];
            $onBoardingStatusValue = explode("=", $onBoardingStatus)[1];

            $terEplode = array();
            if($_POST["TerritoryId"] != null && $_POST["TerritoryId"] != ''){
                $terEplode = explode(',',$_POST["TerritoryId"]);
            }
            if(count($terEplode) > 0){
                foreach($terEplode as $terEplod){
                    if($terEplod != 'on'){
                        $ter = \entities\TerritoriesQuery::create()
                            ->filterByTerritoryId($terEplod)
                            ->findOne();
                        if($ter != null && $ter != '')
                        {
                            if($onBoardingStatusValue != 1)
                            {

                                if (empty($_POST["StartDate"]) || empty($_POST["EndDate"])) {
                                    $this->app->Session()->setFlash("error", "Please select start and end date.!!");
                                    $f->val($_POST);
                                    $this->data['form'] = $f->html();
                                    $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                                    return;
                                }
                                $startExplode = explode('/',$_POST["StartDate"]);
                                $startDate = date('Y-m-d',strtotime($startExplode[2].'-'.$startExplode[1].'-'.$startExplode[0]));
                                $endExplode = explode('/',$_POST["EndDate"]);
                                $endDate = date('Y-m-d',strtotime($endExplode[2].'-'.$endExplode[1].'-'.$endExplode[0]));
                                //$startDateTimestamp  = strtotime($_POST["StartDate"]);
                                //$endDateTimestamp  = strtotime($_POST["EndDate"]);
                                //if ($startDateTimestamp  > $endDateTimestamp ) {
                                if ($startExplode[2] == $endExplode[2] && $startExplode[1] == $endExplode[1] && $startExplode[0] > $endExplode[0] ) {
                                    $this->app->Session()->setFlash("error", "Start date needs to be earlier");
                                    $f->val($_POST);
                                    $this->data['form'] = $f->html();
                                    $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                                    return;
                                }


                            }
                            $ter->setOnBoardingStatus($onBoardingStatusValue);
                            $ter->setStartDate(isset($startDate) ? $startDate : null);
                            $ter->setEndDate(isset($endDate) ? $endDate : null);
                            $ter->save();
                        }else{
                            continue;
                        }
                    }
                }
            }else{
                $this->app->Session()->setFlash("error", "Please select any one territory.!!");
                $f->val($_POST);
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                return;
            }
            $this->runModalScript("loadGrid()");
            return;
        }
        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
    }

    public function getOrgTerritories(){
        $orgUnit = $this->app->Request()->getParameter("orgIds", "");

        $terr = \entities\TerritoriesQuery::create()
            ->filterByOrgunitid($orgUnit)
            ->find()->toArray();

        return $this->json($terr);
    }

    public function getSelectedTerritories(){
        $terArray = $this->app->Request()->getParameter("selectedTerritories", "");
        //return $this->json(explode(',',$terArray));
        return $this->json($terArray);
    }
}
