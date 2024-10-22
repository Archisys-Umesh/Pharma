<?php

declare(strict_types=1);

namespace Modules\Catalogue\Controllers;

use DateTime;
use DatePeriod;
use DateInterval;
use Http\Request;
use App\System\App;
use App\Utils\FormMgr;
use BI\manager\OrgManager;
use entities\DarViewQuery;
use entities\OutletsQuery;
use entities\EmployeeQuery;
use entities\VisitPlanQuery;
use entities\DailycallsQuery;
use entities\OutletTypeQuery;
use entities\OutletViewQuery;
use entities\BrandCampiagnQuery;
use entities\BrandCampiagnVisit;
use entities\BrandCampiagnVisits;
use entities\ClassificationQuery;
use entities\BrandCampiagnDoctors;
use entities\BrandCampiagnVisitPlan;
use entities\BrandCampiagnVisitQuery;
use entities\BrandCampiagnVisitsQuery;
use Respect\Validation\Validator as v;
use entities\BrandCampiagnDoctorsQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use entities\BrandCampiagnVisitPlanQuery;
use Modules\OfflineSync\Models\BrandCampiagn;
use Modules\OfflineSync\Models\BrandCampiagnVisit as ModelsBrandCampiagnVisit;

class API extends \App\Core\BaseController
{

    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
        //$this->app->logger()->info($this->app->Request()->getUri(),["Param" => $this->app->Request()->getParameters(),"Header" => $this->app->Request()->getBodyParameters()]);
    }

    /**
     * @OA\Get(
     *     path="/api/getCategories",
     *     tags={"Catalogue API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get all category successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function getCategories()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $categories = \entities\CategoriesQuery::create()
                    ->findByCompanyId($this->app->Auth()->CompanyId())
                    ->toArray();
                if (count($categories) > 0) {
                    $this->apiResponse($categories, 200, "Get all category successfully!");
                } else {
                    $this->apiResponse([], 404, "Category not found!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getUnits",
     *     tags={"Catalogue API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get all unit successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function getUnits()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $units = \entities\Base\UnitmasterQuery::create()->find()->toArray();
                if (count($units) > 0) {
                    $this->apiResponse($units, 200, "Get all unit successfully!");
                } else {
                    $this->apiResponse([], 404, "Unit not found!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getBeatDump",
     *     tags={"Beats"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="beatId",
     *         in="query",
     *         description="Beat ID",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Beat Dump for Local Storage!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function getBeatDump()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $this->Validate(v::number()->notEmpty()->validate($this->app->Request()->getParameter("beatId")), "Please enter the beat id", "beatId");
                $beatId = $this->app->Request()->getParameter("beatId");
                if ($beatId != null) {
                    $fmshelper = new \Modules\FSM\Runtime\FSMHelper($this->app);
                    $result = $fmshelper->getBeatDump($beatId);
                    if (count($result) > 0) {
                        $this->apiResponse($result, 200, "Beat Dump for Local Storage!");
                    } else {
                        $this->apiResponse([], 404, "Beat Dump not found for Local Storage!");
                    }
                } else {
                    $this->apiResponse([], 404, "Please enter beat id!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getBeatOutlets",
     *     tags={"Beats"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="beatId",
     *         in="query",
     *         description="Beat ID",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Beat outlets!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function getBeatOutlets()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $this->Validate(v::number()->notEmpty()->validate($this->app->Request()->getParameter("beatId")), "Please enter the beat id", "beatId");
                $beatId = $this->app->Request()->getParameter("beatId");
                if ($beatId != null) {
                    $beatOutlets = \entities\BeatOutletsQuery::create()
                        ->select('OutletId')
                        ->filterByBeatId($beatId)
                        ->find()->toArray();
                    $beatOutletCount = count($beatOutlets);
                    $OutletCheckInOutDump = array();
                    if (count($beatOutlets) > 0) {
                        foreach ($beatOutlets as $beatOutlet) {
                            $checkInOut = \entities\OutletCheckinQuery::create()
                                ->filterByOutletId($beatOutlet)
                                ->filterByCheckinDate(date("Y-m-d"))
                                ->find()->toArray("OutletId");
                            if (count($checkInOut) > 0) {
                                array_push($OutletCheckInOutDump, $checkInOut);
                            }
                        }
                        $attendence = \entities\AttendanceQuery::create()
                            ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())
                            ->filterByCompanyId($this->app->Auth()->CompanyId())
                            ->filterByAttendanceDate(date("Y-m-d"))
                            ->filterByStatus(0, \Propel\Runtime\ActiveQuery\Criteria::EQUAL)
                            ->orderBy("Status", \Propel\Runtime\ActiveQuery\Criteria::DESC)
                            ->findOne();
                        if (isset($attendence) && $attendence->getOutletCount() != null) {
                            $totalBeatOutletCount = $attendence->getOutletCount() + $beatOutletCount;
                            $attendence->setOutletCount($totalBeatOutletCount);
                            $attendence->save();
                        }
                        $this->apiResponse(['OutletIds' => $beatOutlets, 'OutletCheckInDump' => $OutletCheckInOutDump], 200, "Beat outlets!");
                    } else {
                        $this->apiResponse([], 404, "Beat outlets not found!");
                    }
                } else {
                    $this->apiResponse([], 404, "Please enter beat id!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getOutletDump",
     *     tags={"Outlet API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Outlet Dump for Local Storage!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function getOutletDump()
    {
        ini_set('max_execution_time', '3000');
        ini_set('memory_limit', '4096M');
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $fmshelper = new \Modules\FSM\Runtime\FSMHelper($this->app);
                $result = $fmshelper->getAllOutletDump($this->app->Auth()->getUser()->getEmployeeId());
                if (count($result) > 0) {
                    $this->apiResponse($result, 200, "Beat Dump for Local Storage!");
                } else {
                    $this->apiResponse([], 404, "Beat Dump not found for Local Storage!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/brand_campiagn",
     *     tags={"Brand Campiagn"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="start_date",
     *         in="query",
     *         description="Start Date",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="end_date",
     *         in="query",
     *         description="End Date",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Status (Draft / Publish / Started / Closed / All)",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="ResponseObj",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */

    public function brandCampiagn()
    {
        $startDate = $this->app->Request()->getParameter("start_date");
        $endDate = $this->app->Request()->getParameter("end_date");
        $status = $this->app->Request()->getParameter("status");

        $brandCampiagn = BrandCampiagnQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByStartDate($startDate, Criteria::GREATER_EQUAL)
            ->_or()
            ->filterByEndDate($endDate, Criteria::LESS_THAN)
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->filterByIsSuspended(false)
            ->filterByOrgUnitId($this->app->Auth()->getUser()->getEmployee()->getOrgUnitId())
            ->where("array[" . $this->app->Auth()->getUser()->getEmployee()->getPositionId() . "] && (string_to_array(position, ',')::integer[])");
            if($status == 'All'){
                $brandCampiagn->filterByStatus(['Published', 'Started', 'Closed']);
            }else{
                $brandCampiagn->filterByStatus($status);
            }
        $brandCampiagn = $brandCampiagn->find()->toArray();

        $campiagnArr = [];
        $totalArr = [];
        $date = date('Y-m-d');

        $pos = OrgManager::getUnderPositions($this->app->Auth()->getUser()->getEmployee()->getPositionId());
        $data = array_merge($pos,[$this->app->Auth()->getUser()->getEmployee()->getPositionId()]); 

        foreach ($brandCampiagn as $campiagn) {
            $doctor = BrandCampiagnDoctorsQuery::create()
                        ->select(['OutletOrgDataId'])
                        ->filterByBrandCampiagnId($campiagn['BrandCampiagnId'])
                        ->filterByPositionId($data)
                        ->filterByOutletOrgDataId(null,Criteria::NOT_EQUAL)
                        ->filterByOutletId(null,Criteria::NOT_EQUAL)
                        ->filterBySelected(true)
                        ->find()->toArray();

            $visitePlan = BrandCampiagnVisitsQuery::create()
                        ->filterByBrandCampiagnId($campiagn['BrandCampiagnId'])
                        ->filterByOutletOrgDataId($doctor)
                        ->find()->count();
            $visiteDone = BrandCampiagnVisitsQuery::create()
                        ->filterByBrandCampiagnId($campiagn['BrandCampiagnId'])
                        ->filterByOutletOrgDataId($doctor)
                        ->filterByIsVisited(true)
                        ->filterByDcrId(null,Criteria::NOT_EQUAL)
                        ->find()->count();

            $status = $campiagn['Status'];
            $campiagnArr['BrandCampiagnId'] = $campiagn['BrandCampiagnId'];
            $campiagnArr['CampiagnName'] = $campiagn['CampiagnName'];
            $campiagnArr['StartDate'] = $campiagn['StartDate'];
            $campiagnArr['EndDate'] = $campiagn['EndDate'];
            $campiagnArr['LockingDate'] = $campiagn['LockingDate'];
            $campiagnArr['Status'] = $status;
            $campiagnArr['DoctorCount'] = count($doctor);
            $campiagnArr['Done'] = $visiteDone;
            $campiagnArr['Plan'] = $visitePlan;
            $campiagnArr['DistributedPlan'] = 0;
            $campiagnArr['Distributed'] = 0;
             if(isset($campiagn['FocusBrands']) && $campiagn['FocusBrands'] != '' && $campiagn['FocusBrands'] != 0){
                $campiagnArr['FocusBrands'] = \entities\BrandsQuery::create()->select(['BrandName'])->filterByBrandId(explode(',', $campiagn['FocusBrands']))->find()->toArray();
             }else{
                $campiagnArr['FocusBrands'] = null;
             }
            
            $totalArr[] = $campiagnArr;
        }
        $this->apiResponse($totalArr, 200, "Campiagn Data Retrieved Successfully");
    }

    /**
     * @OA\Get(
     *     path="/api/campiagn_details",
     *     tags={"Brand Campiagn"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="campiagn_id",
     *         in="query",
     *         description="Campiagn Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="ResponseObj",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */

    public function campiagnDetails()
    {
        $campiagnId = $this->app->Request()->getParameter("campiagn_id");
        $campiagn = BrandCampiagnQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->joinWithOutletType()
            ->filterByBrandCampiagnId($campiagnId)
            ->filterByIsSuspended(false)
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->findOne();
            $campaignClassification = \entities\BrandCampiagnClassificationQuery::create()
                                            ->select(['Classification.Classification'])
                                            ->leftJoinWithClassification()
                                            ->filterByBrandCampiagnId($campiagnId)
                                            ->find()->toArray();
            if(count($campaignClassification) > 0){
                $class = implode(',',$campaignClassification);
            }else{
                $class = null;
            }
        
        $campiagnArr = [];
        $totalvisitPlanArr = [];

        if (!empty($campiagn)) {
            $campiagnArr['BrandCampiagnId'] = $campiagn['BrandCampiagnId'];
            $campiagnArr['CampiagnName'] = $campiagn['CampiagnName'];
            $campiagnArr['StartDate'] = $campiagn['StartDate'];
            $campiagnArr['EndDate'] = $campiagn['EndDate'];
            $campiagnArr['LockingDate'] = $campiagn['LockingDate'];
            $status = $campiagn['Status'];
            $campiagnArr['CampianStatus'] = $status;
            $campiagnArr['Media'] = $campiagn['Media'];
            $campiagnArr['Material'] = $campiagn['Material'];
            $campiagnArr['CampiagnType'] = $campiagn['CampiagnType'];
            $campiagnArr['Description'] = $campiagn['Description'];
            if(isset($campiagn['FocusBrands'])){
                $campiagnArr['FocusBrands'] = \entities\BrandsQuery::create()->select(['BrandName'])->filterByBrandId(explode(',', $campiagn['FocusBrands']))->find()->toArray();
            }else{
                $campiagnArr['FocusBrands'] = null;
            }
            
            $campiagnArr['OutletType'] = $campiagn['OutletType']['OutlettypeName'];
            $campiagnArr['Classifications'] = $class;
            $campiagnArr['MinimumPerTerritory'] = $campiagn['MinimumPerTerritory'];
            $campiagnArr['MaximumPerTerritory'] = $campiagn['MaximumPerTerritory'];
            $campiagnArr['MinimumForCampiagn'] = $campiagn['MinimumForCampiagn'];
            $campiagnArr['MaximumForCampiagn'] = $campiagn['MaximumForCampiagn'];

            $visitPlan = BrandCampiagnVisitPlanQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->filterByBrandCampiagnId($campiagnId)
                ->find()->toArray();

            foreach ($visitPlan as $visit) {
                $visitPlanArr = [];
                $visitPlanArr['StepLevel'] = isset($visit['StepLevel']) ? $visit['StepLevel'] : null;
                $visitPlanArr['StepName'] = isset($visit['StepName']) ? $visit['StepName'] : null;
                $visitPlanArr['Description'] = isset($visit['Description']) ? $visit['Description'] : null;
                $visitPlanArr['SgpiStatus'] = isset($visit['SgpiStatus']) ? $visit['SgpiStatus'] : null;
                $visitPlanArr['Qty'] = isset($visit['Qty']) ? $visit['Qty'] : null;
                $visitPlanArr['Moye'] = isset($visit['Moye']) ? $visit['Moye'] : null;
                $visitPlanArr['SgpiId'] = isset($visit['SgpiId']) ? $visit['SgpiId'] : null;
                $visitPlanArr['Input'] = isset($visit['SgpiMaster']['SgpiName']) ? $visit['SgpiMaster']['SgpiName'] : null;
                $visitPlanArr['AgendaType'] = isset($visit['AgendaType']) ? $visit['AgendaType'] : null;
                $totalvisitPlanArr[] = $visitPlanArr;
            }
        }

        $totalArr = [];
        $totalArr['campiagn'] = $campiagnArr;
        $totalArr['visit_plan'] = $totalvisitPlanArr;

        $this->apiResponse($totalArr, 200, "Campiagn Data Retrieved Successfully");


    }

    /**
     * @OA\Get(
     *     path="/api/doctor_details",
     *     tags={"Brand Campiagn"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="campiagn_id",
     *         in="query",
     *         description="Campiagn Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="ResponseObj",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */

    public function doctorDetails()
    {
        $campiagnId = $this->app->Request()->getParameter("campiagn_id");
        // $brandCampiagn = BrandCampiagnQuery::create()
        //                     ->joinWithOutletType()
        //                     ->filterByBrandCampiagnId($campiagnId)
        //                     ->filterByIsSuspended(false)
        //                     ->filterByCompanyId($this->app->Auth()->CompanyId())
        //                     ->filterByOrgUnitId($this->app->Auth()->getUser()->getEmployee()->getOrgUnitId())
        //                     ->findOne();
        
        $doctors = BrandCampiagnDoctorsQuery::create()
                        ->select('OutletOrgDataId')
                        ->filterByBrandCampiagnId($campiagnId)
                        ->find()->toArray();
        
        $totalArr = OutletViewQuery::create()
                        ->filterByOutletOrgId($doctors)
                        ->find()
                        ->toArray();

        // foreach ($doctors as $doctor) {

        //     $lastVisit = DarViewQuery::create()
        //         ->filterByOutletId($doctor['OutletId'])
        //         ->orderByDcrDate(Criteria::DESC)
        //         ->findOne();

        //     if ($lastVisit != null) {
        //         $visit = $lastVisit->getDcrDate();
        //     } else {
        //         $visit = null;
        //     }

        //     $outletType = OutletTypeQuery::create()
        //         ->filterByOutlettypeId($doctor['Outlets']['OutlettypeId'])
        //         ->findOne();
        //     $doctorArr['Name'] = $doctor['Outlets']['OutletName'];
        //     $doctorArr['OutletTypeId'] = $outletType->getOutlettypeId();
        //     $doctorArr['OutletTypeName'] = $outletType->getOutlettypeName();
        //     $doctorArr['ContactName'] = $doctor['Outlets']['OutletContactName'];
        //     $doctorArr['Salutation'] = $doctor['Outlets']['OutletSalutation'];
        //     $doctorArr['ContactNumber'] = $doctor['Outlets']['OutletContactNo'];
        //     $doctorArr['MediaId'] = $doctor['Outlets']['OutletMediaId'];
        //     $doctorArr['Classification'] = $classification->getClassification();
        //     $doctorArr['ClassificationId'] = $classification->getId();
        //     $doctorArr['LastVisit'] = $visit;
        //     $totalArr[] = $doctorArr;
        // }
        $this->apiResponse($totalArr, 200, "Doctor Data Retrieved Successfully");
    }

    /**
     * @OA\Get(
     *     path="/api/doctor_list",
     *     tags={"Brand Campiagn"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="campiagn_id",
     *         in="query",
     *         description="Campiagn Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="selected",
     *         in="query",
     *         description="Selected",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Response(
     *         response="200",
     *         description="ResponseObj",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function doctorList()
    {
        $campiagnId = $this->app->Request()->getParameter("campiagn_id");
        $selected = $this->app->Request()->getParameter("selected");

        $campiagn = BrandCampiagnQuery::create()
                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                        ->filterByBrandCampiagnId($campiagnId)
                        ->filterByIsSuspended(false)
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->findOne();
        
        if(empty($campiagn)) {
            $this->apiResponse([], 400, "Campaign not found with the requested id.");
        }
    
        if ($campiagn['Status'] != 'Draft') {
            $this->apiResponse([], 412, "You can not add doctors to the campaign");
        }

        if ($campiagn['Position'] != null && $campiagn['Position'] != "") {
            $positions = $this->app->Auth()->getUser()->getEmployee()->getPositionId();
            $pos = OrgManager::getUnderPositions($positions); 

            $positionIds = array_merge($pos,[$positions]);
        }else{
            $positionIds = OrgManager::getUnderPositions($this->app->Auth()->getUser()->getEmployee()->getPositionId());
        }
        
        $camOutlets = BrandCampiagnDoctorsQuery::create()
                            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                            ->leftJoinWithOutlets()
                            ->leftJoinWith('Outlets.Classification')
                            ->filterByBrandCampiagnId($campiagnId)
                            ->filterBySelected($selected)
                            ->filterByPositionId($positionIds)
                            ->filterByClassificationId(null,Criteria::NOT_EQUAL)
                            ->find()->toArray();

        $result = array();
        if(count($camOutlets) > 0){
            foreach($camOutlets as $camOutlet){
                //var_dump($camOutlet["Outlets"]["Classification"]["Classification"]);exit;
                $brClassi = \entities\BrandCampiagnClassificationQuery::create()
                                    ->leftJoinWithClassification()
                                    ->filterByBrandCampiagnId((int)$campiagnId)
                                    ->filterByClassificationId($camOutlet['ClassificationId'])
                                    ->findOne();
                if (!array_key_exists($camOutlet['ClassificationId'], $result)) {
                    if($brClassi != null && $brClassi->getClassification() != null && $brClassi->getClassification()->getClassification() != null){
                        $classification = $brClassi->getClassification()->getClassification();
                    }else{
                        if(!empty($camOutlet) && isset($camOutlet["Outlets"]) && isset($camOutlet["Outlets"]["Classification"])){
                            $classification = $camOutlet["Outlets"]["Classification"]["Classification"];
                        }
                        //$outlet = \entities\OutletViewQuery::create()->filterByOutlet_Id($camOutlet['OutletId'])->findOne();
                    }
                    if($brClassi != null && $brClassi->getMinimum() != null ){
                        $minimum = $brClassi->getMinimum();
                    }else{
                        $minimum = 0;
                    }
                    if($brClassi != null && $brClassi->getMaximum()){
                        $maximum = $brClassi->getMaximum();
                    }else{
                        $maximum = 0;
                    }
                    $result[$camOutlet['ClassificationId']] = [
                        'ClassificationId' => $camOutlet['ClassificationId'],
                        'Name' => $classification,
                        'Minimum' => $minimum,
                        'Maximum' => $maximum,
                    ];
                    $result[$camOutlet['ClassificationId']]['Outlets'] = [];
                }
            }

            $outletOrgData = BrandCampiagnDoctorsQuery::create()
                            ->select(['OutletOrgDataId'])
                            ->filterByBrandCampiagnId($campiagnId)
                            ->filterBySelected($selected)
                            ->filterByPositionId($positionIds)
                            ->filterByClassificationId(null,Criteria::NOT_EQUAL)
                            ->find()->toArray();
                           
            $dcr = \entities\DailycallsQuery::create()
                                ->filterByOutletOrgDataId($outletOrgData)
                                ->orderByDcrId(Criteria::DESC)
                                ->find()->toKeyIndex();

            foreach($camOutlets as $camOutlet){
                if (array_key_exists($camOutlet['ClassificationId'], $result)) {

                    $dailycalls = null;
                    if (isset($dcr[$camOutlet['OutletOrgDataId']])) {
                        $dailycalls = $dcr;
                    }
                    //var_dump($dailycalls);exit;
                    // $dcr = \entities\DailycallsQuery::create()
                    //             ->filterByOutletOrgDataId($camOutlet['OutletOrgDataId'])
                    //             ->orderByDcrId(Criteria::DESC)
                    //             ->findOne();
                    if($dailycalls != null && $dailycalls->getDcrDate() != null){
                        $visited = $dailycalls->getDcrDate();
                    }else{
                        $visited = null;
                    }
                    $data =[
                                'BrandCampaignId' => $camOutlet['BrandCampiagnId'],
                                'OutletId' => $camOutlet['OutletId'],
                                'OutletOrgDataId' => $camOutlet['OutletOrgDataId'],
                                'Position' => $camOutlet['PositionId'],
                                'Classification' => $camOutlet['ClassificationId'],
                                'Selected' => $camOutlet['Selected'],
                                'OutletTypeId' => $campiagn['OutlettypeId'],
                                'Visited' => $visited,
                            ];
                    array_push($result[$camOutlet['ClassificationId']]['Outlets'],$data);
                }
            }
        }
                    
        $this->apiResponse($result, 200, "Doctor Data Retrieved Successfully");
    }

    /**
     * @OA\Post(
     *     path="/api/add_doctor",
     *     tags={"Brand Campiagn"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="campiagn_id",
     *         in="query",
     *         description="Campiagn Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_org_ids",
     *         in="query",
     *         description="Comma Seperated Outlet Org Ids",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="selected",
     *         in="query",
     *         description="Selected",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Response(
     *         response="200",
     *         description="ResponseObj",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function addDoctor()
    {
        $campiagnId = $this->app->Request()->getParameter("campiagn_id");
        $OutletOrgIds = $this->app->Request()->getParameter("outlet_org_ids");
        $selected = $this->app->Request()->getParameter("selected");
        $outletOrgDataIds = explode(',', $OutletOrgIds);
       
        $campiagn = BrandCampiagnQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByBrandCampiagnId($campiagnId)
            ->filterByIsSuspended(false)
            ->findOne();
            
        if(empty($campiagn)) {
            $this->apiResponse([], 400, "Campaign not found with the requested id.");
        }

        if ($campiagn['Status'] != 'Draft') {
            $this->apiResponse([], 412, "You can not add doctors to the campaign");
        }
        
        if(count($outletOrgDataIds) > 0){
            foreach($outletOrgDataIds as $outletOrgDataId){
                if($selected == "true"){
                    $brandCampiagnOut = \entities\BrandCampiagnDoctorsQuery::create()
                                            ->filterByBrandCampiagnId($campiagnId)
                                            ->filterByOutletOrgDataId($outletOrgDataId)
                                            ->findOne();
                    $outletClassification = $brandCampiagnOut->getClassificationId();

                    $campaignClassification = \entities\BrandCampiagnClassificationQuery::create()
                                            ->filterByBrandCampiagnId($campiagnId)
                                            ->filterByClassificationId($outletClassification)
                                            ->findOne();

                    $brandCampiagnOutCount = \entities\BrandCampiagnDoctorsQuery::create()
                                            ->filterByBrandCampiagnId($campiagnId)
                                            ->filterByClassificationId($outletClassification)
                                            ->filterByOutletId(null,Criteria::NOT_EQUAL)
                                            ->filterByOutletOrgDataId(null,Criteria::NOT_EQUAL)
                                            ->filterBySelected(true)
                                            ->find()->count();

                    if($campaignClassification != null && $campaignClassification->getMaximum() < $brandCampiagnOutCount){
                        return $this->apiResponse([], 400, "Maximum limit for outlet classification reached!");
                    }
                }else{
                    $brandCampiagnOut = \entities\BrandCampiagnDoctorsQuery::create()
                                            ->filterByBrandCampiagnId($campiagnId)
                                            ->filterByOutletOrgDataId($outletOrgDataId)
                                            ->findOne();
                }
                

                $brandCampiagnOut->setSelected($selected);
                $brandCampiagnOut->save();

                if($brandCampiagnOut->getSelected() == true){
                    
                    $visits = BrandCampiagnVisitPlanQuery::create()
                                ->filterByBrandCampiagnId($campiagnId)
                                ->find()->toArray();
                    foreach ($visits as $visit) {
                        $brandCampiagnVisit = BrandCampiagnVisitsQuery::create()
                                    ->filterByBrandCampiagnId($campiagnId)
                                    ->filterByBrandCampiagnVisitPlanId($visit['BrandCampiagnVisitPlanId'])
                                    ->filterByOutletId($brandCampiagnOut->getOutletId())
                                    ->filterByOutletOrgDataId($brandCampiagnOut->getOutletOrgDataId())
                                    ->findOne();
                        if($brandCampiagnVisit == null){
                            $brandCampiagnVisit = new BrandCampiagnVisits();
                        }
                        $brandCampiagnVisit->setBrandCampiagnId($campiagnId);
                        $brandCampiagnVisit->setBrandCampiagnVisitPlanId($visit['BrandCampiagnVisitPlanId']);
                        $brandCampiagnVisit->setOutletId($brandCampiagnOut->getOutletId());
                        $brandCampiagnVisit->setOutletOrgDataId($brandCampiagnOut->getOutletOrgDataId());
                        $brandCampiagnVisit->setIsVisited(false);
                        $brandCampiagnVisit->save();
                    }
                        
                }
                if($brandCampiagnOut->getSelected() == false && count($outletOrgDataIds) > 0){
                    foreach($outletOrgDataIds as $outletOrgDataId){
                        $brandCampiagnVisit = BrandCampiagnVisitsQuery::create()
                                    ->filterByBrandCampiagnId($campiagnId)
                                    ->filterByOutletOrgDataId($brandCampiagnOut->getOutletOrgDataId())
                                    ->find();
                        $brandCampiagnVisit->delete();
                    }
                }
            }
            
            if($selected == 'true'){
                $this->apiResponse([], 200, "Doctor added successfully");
            }else{
                $this->apiResponse([], 200, "Doctor removed successfully");
            }
        }else{
            $this->apiResponse([], 400, "OutletOrgData ids not found!");
        }
        
        
        // $alreadyAdded = BrandCampiagnDoctorsQuery::create()
        //                     ->select('OutletOrgDataId')
        //                     ->filterByBrandCampiagnId($campiagnId)
        //                     ->find()->toArray();

        // $outletViews = OutletViewQuery::create()
        //                     ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
        //                     ->filterByCompanyId($this->app->Auth()->CompanyId())
        //                     ->filterByOutletOrgId($outlets, Criteria::IN)
        //                     ->filterByOutlettypeId($campiagn['OutlettypeId'])
        //                     ->filterByOutletClassification(explode(',', $campiagn['Classifications']))
        //                     ->filterByOrgUnitId($this->app->Auth()->getUser()->getEmployee()->getOrgUnitId())
        //                     ->filterByOutletOrgId($alreadyAdded, Criteria::NOT_IN)
        //                     ->find();

        // foreach ($outletViews as $outlet) {
        //     $doctor = new BrandCampiagnDoctors;
        //     $doctor->setBrandCampiagnId($campiagn['BrandCampiagnId']);
        //     $doctor->setOutletId($outlet['Outlet_Id']);
        //     $doctor->setCompanyId($campiagn['CompanyId']);
        //     $doctor->setOutletOrgDataId($outlet['OutletOrgId']);
        //     $doctor->save();


        //     // $doctor = new \entities\DoctorVisit();
        //     // $doctor->setBrandCampiagnId($campiagnId);
        //     // $doctor->setOutletId($outlet);
        //     // $doctor->save();

        //     $visits = BrandCampiagnVisitPlanQuery::create()->filterByBrandCampiagnId($campiagnId)->find()->toArray();

        //     foreach ($visits as $visit) {
        //         $brandCampiagnVisit = BrandCampiagnVisitsQuery::create()
        //                                     ->filterByBrandCampiagnId($campiagnId)
        //                                     ->filterByBrandCampiagnVisitPlanId($visit['BrandCampiagnVisitPlanId'])
        //                                     ->filterByOutletId($outlet['Outlet_Id'])
        //                                     ->filterByOutletOrgDataId($outlet['OutletOrgId'])
        //                                     ->findOne();

        //         if (empty($brandCampiagnVisit)) {
        //             $brandCampiagnVisit = new BrandCampiagnVisits();
        //             $brandCampiagnVisit->setBrandCampiagnId(intval($campiagnId));
        //             $brandCampiagnVisit->setBrandCampiagnVisitPlanId($visit['BrandCampiagnVisitPlanId']);
        //             $brandCampiagnVisit->setOutletId(intval($outlet['Outlet_Id']));
        //             $brandCampiagnVisit->setOutletOrgDataId(intval($outlet['OutletOrgId']));
        //             $brandCampiagnVisit->setIsVisited(false);
        //             $brandCampiagnVisit->save();
        //         }
        //     }

        // }

        
    }

    /**
     * @OA\Post(
     *     path="/api/doctor_campiagn",
     *     tags={"Brand Campiagn"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="date",
     *         in="query",
     *         description="Date",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_org_id",
     *         in="query",
     *         description="Outlet Org Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="ResponseObj",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function doctorCampiagn()
    {
        $date = $this->app->Request()->getParameter("date");
        $outletOrgId = $this->app->Request()->getParameter("outlet_org_id");

        $campiagns = BrandCampiagnQuery::create()
            ->select(['BrandCampiagnId'])
            ->filterByStartDate($date, Criteria::LESS_EQUAL)
            ->filterByEndDate($date, Criteria::GREATER_EQUAL)
            ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
            ->find()->toArray();

        $doctors = BrandCampiagnDoctorsQuery::create()
            ->select(['BrandCampiagnId'])
            ->filterByBrandCampiagnId($campiagns)
            ->filterByOutletOrgDataId($outletOrgId)
            ->findOne();
            
        $status = false;
        if ($doctors != null) {
            $status = true;
        }


        $this->apiResponse(['campiagn_id' => $doctors, 'status' => $status], 200, "Campiagn Retrieved Successfully");
    }

    /**
     * @OA\Get(
     *     path="/api/brand_campiagn_view",
     *     tags={"Brand Campiagn"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="start_date",
     *         in="query",
     *         required=true,
     *         description="Start Date",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="end_date",
     *         in="query",
     *         description="End Date",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Status (Planned / Started / Closed / All)",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="ResponseObj",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function brandCampaignView() {
        $startDate = $this->app->Request()->getParameter("start_date");
        $endDate = $this->app->Request()->getParameter("end_date");
        $status = $this->app->Request()->getParameter("status");

        $brandCampiagn = BrandCampiagnQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByStartDate($startDate, Criteria::GREATER_EQUAL)
            ->filterByStartDate($endDate, Criteria::LESS_THAN)
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->joinWithOutletType()
            ->filterByOrgUnitId($this->app->Auth()->getUser()->getEmployee()->getOrgUnitId());
        
        if (in_array($status, ['Planned', 'Started', 'Closed', 'Draft'])) {
            $brandCampiagn->filterByStatus($status);
        }
            
        $brandCampiagn = $brandCampiagn->find()->toArray();
        $data = [];

        foreach ($brandCampiagn as $campiagn) {
            $campiagnArr['BrandCampiagnId'] = $campiagn['BrandCampiagnId'];
            $campiagnArr['CampiagnName'] = $campiagn['CampiagnName'];
            $campiagnArr['StartDate'] = $campiagn['StartDate'];
            $campiagnArr['EndDate'] = $campiagn['EndDate'];
            $campiagnArr['LockingDate'] = $campiagn['LockingDate'];
            $status = $campiagn['Status'];

            $campiagnArr['CampianStatus'] = $status;
            $campiagnArr['Media'] = $campiagn['Media'];
            $campiagnArr['Material'] = $campiagn['MaterialUrl'];
            $campiagnArr['CampiagnType'] = $campiagn['CampiagnType'];
            $campiagnArr['Description'] = $campiagn['Description'];
            $campiagnArr['FocusBrands'] = \entities\BrandsQuery::create()->select(['BrandName'])->filterByBrandId(explode(',', $campiagn['FocusBrands']))->find()->toArray();
            $campiagnArr['Classifications'] = \entities\ClassificationQuery::create()->select(['Classification'])->filterById(explode(',', $campiagn['Classifications']))->find()->toArray();
            $campiagnArr['Tags'] = \entities\OutletTagsQuery::create()->select(['TagName'])->filterByOutletTagId(explode(',', $campiagn['Tags']))->find()->toArray();
            $campiagnArr['OutletType'] = $campiagn['OutletType']['OutlettypeName'];
            $campiagnArr['MinimumPerTerritory'] = $campiagn['MinimumPerTerritory'];
            $campiagnArr['MaximumPerTerritory'] = $campiagn['MaximumPerTerritory'];
            $campiagnArr['MinimumForCampiagn'] = $campiagn['MinimumForCampiagn'];
            $campiagnArr['MaximumForCampiagn'] = $campiagn['MaximumForCampiagn'];

            $visitPlan = BrandCampiagnVisitPlanQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->filterByBrandCampiagnId($campiagn['BrandCampiagnId'])
                ->joinWithSgpiMaster()
                ->find()->toArray();
            $visitPlans = [];

            foreach ($visitPlan as $visit) {
                $visitPlanArr = [];
                $visitPlanArr['StepLevel'] = $visit['StepLevel'];
                $visitPlanArr['StepName'] = $visit['StepName'];
                $visitPlanArr['Description'] = $visit['Description'];
                $visitPlanArr['SgpiStatus'] = $visit['SgpiStatus'];
                $visitPlanArr['Qty'] = $visit['Qty'];
                $visitPlanArr['Moye'] = $visit['Moye'];
                $visitPlanArr['SgpiId'] = $visit['SgpiId'];
                $visitPlanArr['Input'] = $visit['SgpiMaster']['SgpiName'];
                $visitPlans[] = $visitPlanArr;
            }

            $doctors = BrandCampiagnDoctorsQuery::create()
                        ->select('OutletOrgDataId')
                        ->filterByBrandCampiagnId($campiagn['BrandCampiagnId'])
                        ->find()->toArray();
        
            $doctorArr = OutletViewQuery::create()
                            ->filterByOutletOrgId($doctors)
                            ->find()
                            ->toArray();

            $campiagnArr['visitPlans'] = $visitPlans;
            $campiagnArr['doctors'] = $doctorArr;

            $data[] = $campiagnArr;
        }

        $this->apiResponse($data, 200, "Brand Campaign List Retrieved Successfully");
    }

    /**
     * @OA\Post(
     *     path="/api/remove_doctor",
     *     tags={"Brand Campiagn"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="campiagn_id",
     *         in="query",
     *         required=true,
     *         description="Campiagn Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_org_id",
     *         in="query",
     *         description="Outlet Org Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="ResponseObj",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function removeDoctor()
    {
        $campiagnId = $this->app->Request()->getParameter("campiagn_id");
        // $outletId = $this->app->Request()->getParameter("outlet_id");
        $outletOrgId = $this->app->Request()->getParameter("outlet_org_id");
        
        $campiagn = BrandCampiagnQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByBrandCampiagnId($campiagnId)
            ->filterByIsSuspended(false)
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->findOne();
        
        if(empty($campiagn)) {
            $this->apiResponse([], 400, "Campaign not found with the requested id.");
        }
    
        if ($campiagn['Status'] != 'Draft') {
            $this->apiResponse([], 412, "You can not remove doctors to the campaign");
        }
        
        $doctor = BrandCampiagnDoctorsQuery::create()
                            ->filterByOutletOrgDataId($outletOrgId)
                            ->filterByBrandCampiagnId($campiagnId)
                            ->findOne();

        if (!empty($doctor)) {
            $doctor->delete();
            $this->apiResponse([], 200, "Doctor Removed Successfully");
            
        } else {
            $this->apiResponse([], 412, "Doctor not found into the campaign");
        }
    }

    /**
     * @OA\Get(
     *     path="/api/brand_campiagn_execution_report",
     *     tags={"Brand Campiagn"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="start_date",
     *         in="query",
     *         description="Start Date",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="end_date",
     *         in="query",
     *         description="End Date",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="tag_id",
     *         in="query",
     *         description="Tag ID",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="brand_id",
     *         in="query",
     *         description="Brand ID",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="ResponseObj",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
     public function campaignExecutionReport()
     {
         $startDate = $this->app->Request()->getParameter("start_date");
         $endDate = $this->app->Request()->getParameter("end_date");
         $tagId = $this->app->Request()->getParameter("tag_id");
         $brandId = $this->app->Request()->getParameter("brand_id");
 
         $brandCampiagn = BrandCampiagnQuery::create()
             ->select('BrandCampiagnId')
             ->filterByStartDate($startDate, Criteria::GREATER_EQUAL)
             ->filterByStartDate($endDate, Criteria::LESS_THAN)
             ->filterByCompanyId($this->app->Auth()->CompanyId())
             ->filterByOrgUnitId($this->app->Auth()->getUser()->getEmployee()->getOrgUnitId());
         
        if (!empty($tagId)) {
            $brandCampiagn->where("string_to_array(brand_campiagn.tags, ',') && array[".$tagId."]");
        }

        if (!empty($brandId)) {
            $brandCampiagn->where("(string_to_array(brand_campiagn.focus_brands, ',')::integer[]) && array[".$brandId."]");
        }
             
        $brandCampiagn = $brandCampiagn->find()->toArray();
 
        $start = new DateTime($startDate);
        $start->modify('first day of this month');
        $end = new DateTime($endDate);
        $end->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 month');
        $period = new DatePeriod($start, $interval, $end);
        $data = [];
        
        foreach ($period as $dt) {
            $month = $dt->format("m-Y");
            $planned = BrandCampiagnVisitsQuery::create()
                        ->filterByBrandCampiagnId($brandCampiagn)
                        ->useBrandCampiagnVisitPlanQuery()
                            ->filterByMoye($month)
                        ->endUse()
                        ->count();
            
            $visited = BrandCampiagnVisitsQuery::create()
                        ->filterByBrandCampiagnId($brandCampiagn)
                        ->filterByIsVisited(true)
                        ->useBrandCampiagnVisitPlanQuery()
                            ->filterByMoye($month)
                        ->endUse()
                        ->count();

            $data[] = ['month' => $month, 'planned' => $planned, 'visited' => $visited];
        }
        
        $this->apiResponse($data, 200, "Campiagn Execution Data Retrieved Successfully");
     }



     /**
     * @OA\Get(
     *     path="/api/getCampaignStatus",
     *     tags={"Brand Campiagn"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get campaign status successfully!!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */


    public function getCampaignStatus()
    {
        $status = $this->getConfig("Catalogue", "BrandCampiagnStatus");
        
        $this->apiResponse($status, 200, "Get campaign status successfully!!");
    }

    /**
     * @OA\GET(
     *     path="/api/getCampaignVisitByOutletId",
     *     tags={"Brand Campiagn"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="moye",
     *         in="query",
     *         description="Month and Year",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_org_id",
     *         in="query",
     *         description="Outlet Org Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="ResponseObj",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function getCampaignVisitByOutletId()
    {
        $moye = $this->app->Request()->getParameter("moye");
        $outletOrgId = $this->app->Request()->getParameter("outlet_org_id");
        $moExp = explode('-',$moye);
        $startDate = date('Y-m-01',strtotime($moExp[1].'-'.$moExp[0]));
        $endDate = date('Y-m-t',strtotime($moExp[1].'-'.$moExp[0]));

        $brandCampaigns = \entities\BrandCampiagnQuery::create()
                                        ->filterByStartDate($startDate,Criteria::GREATER_EQUAL)
                                        ->filterByEndDate($endDate,Criteria::LESS_EQUAL)
                                        ->find()->toArray();
                                        
        if(count($brandCampaigns) > 0){
            $data = [];
            $camIds = [];
            foreach($brandCampaigns as $brandCampaign){
                $positionExp = explode(',',$brandCampaign['Position']);
                $empPosition = $this->app->Auth()->getUser()->getEmployee()->getPositionId();

                if(in_array($empPosition,$positionExp)){
                    array_push($data,$empPosition);
                }
                array_push($camIds,$brandCampaign['BrandCampiagnId']);
            }

            $outletVisits = \entities\BrandCampiagnVisitsQuery::create()
                            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                            ->joinWithBrandCampiagnVisitPlan()
                            ->joinWithBrandCampiagn()
                            ->filterByBrandCampiagnId($camIds)
                            ->filterByPositionId($data)
                            ->filterByOutletOrgDataId($outletOrgId)
                            ->find()->toArray();

            $this->apiResponse($outletVisits, 200, "Campiagn Retrieved Successfully!");
        }else{
            $this->apiResponse([], 200, "No data found!");
        }
    }
}