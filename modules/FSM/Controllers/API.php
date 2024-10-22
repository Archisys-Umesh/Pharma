<?php

declare(strict_types=1);

namespace Modules\FSM\Controllers;

use DateTime;
use entities\BranchQuery;
use entities\EmployeeQuery;
use entities\GeoTownsQuery;
use entities\HolidaysQuery;
use entities\LeavesQuery;
use entities\OrgUnitQuery;
use entities\OutletOrgDataQuery;
use entities\OutletTypeQuery;
use entities\Stp;
use entities\StpQuery;
use entities\StpWeek;
use entities\StpWeekQuery;
use entities\TerritoriesQuery;
use Exception;
use DatePeriod;
use DateInterval;
use Http\Request;
use App\System\App;
use entities\Events;
use App\Utils\FormMgr;
use entities\MtpQuery;
use entities\Tourplans;
use entities\BeatsQuery;
use entities\MtpDayQuery;
use BI\manager\MTPManager;
use BI\manager\OrgManager;
use entities\OutletsQuery;
use entities\TourplansQuery;
use entities\OutletViewQuery;
use BI\requests\TourPlanRequest;
use BI\manager\NotificationManager;
use function Illuminate\Support\dd;
use Respect\Validation\Validator as v;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\System\Processes\WorkflowManager;

class API extends \App\Core\BaseController
{

    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    /**
     * @OA\Get(
     *     path="/api/getTerritories",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Territories successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getTerritories()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $terrIds = OrgManager::getMyTerritoriesByPosition($this->app->Auth()->getUser()->getEmployee()->getPositionId(), true);

                $territories = \entities\TerritoriesQuery::create()->findByTerritoryId($terrIds)->toArray();

                $this->apiResponse($territories, 200, "Get Territories successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getTerritoriesArray",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *
     *     @OA\Parameter(
     *         name="show_vacant",
     *         in="query",
     *         description="show_vacant (0 = false, 1= true)",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Territories successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getTerritoriesArray()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $manager = new MTPManager();
                $show_vacant = $this->app->Request()->getParameter("show_vacant", 1);
                if ($show_vacant == 0) {
                    $list = $manager->getTerritoriesList($this->app->Auth()->getUser()->getEmployee()->getPositionId(), false);
                } else {
                    $list = $manager->getTerritoriesList($this->app->Auth()->getUser()->getEmployee()->getPositionId(), true);
                }

                $this->apiResponse($list, 200, "Get Territories successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getMtpTerritoriesList",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *
     *     @OA\Parameter(
     *         name="month",
     *         in="query",
     *         description="Month",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Territories successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getMtpTerritoriesList()
    {
        $month = $this->app->Request()->getParameter("month", date('m-Y'));
        $terrIds = OrgManager::getMyTerritoriesByPosition($this->app->Auth()->getUser()->getEmployee()->getPositionId(), true);
        $positions = TerritoriesQuery::create()->select(['PositionId'])->filterByTerritoryId($terrIds)->find()->toArray();

        $mtp = MtpQuery::create()->filterByMonth($month)->filterByPositionId($positions)->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())->filterByMtpStatus('approved')->find()->toArray();
        $terArr = [];
        foreach ($mtp as $ter) {

            $employee = EmployeeQuery::create()->filterByPositionId($ter['PositionId'])->filterByStatus(1)->findOne();
            $territory = TerritoriesQuery::create()->filterByPositionId($ter['PositionId'])->findOne();

            $terArr[$territory->getTerritoryId()] = $territory->getTerritoryName() . " | " . $employee->getFirstName() . " " . $employee->getLastName();
        }
        if (count($terArr) > 0) {
            $this->apiResponse($terArr, 200, "Get Territories successfully!");
        } else {
            $this->apiResponse([], 400, "Please Ask Your Team member to Submit MTP For '.$month.' Month");
        }
    }

    /**
     * @OA\Get(
     *     path="/api/getBeats",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="territory_id",
     *         in="query",
     *         description="territory_id",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Territories successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getBeats()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $territory_id = $this->app->Request()->getParameter("territory_id", 0);
                $beats = \entities\BeatsQuery::create()
                    ->filterByTerritoryId($territory_id)
                    ->findByCompanyId($this->app->Auth()->CompanyId())->toArray();
                $this->apiResponse($beats, 200, "Get Beats successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getBeatById",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="beat_id",
     *         in="query",
     *         description="beat_id",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Territories successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getBeatById()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $beat_id = $this->app->Request()->getParameter("beat_id", 0);
                $territories = \entities\BeatsQuery::create()
                    ->joinWithBeatOutlets()
                    ->filterByBeatId($beat_id)
                    ->findByCompanyId($this->app->Auth()->CompanyId())->toArray();
                $this->apiResponse($territories, 200, "Get Territories successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getCustomersByBeat",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="beat_id",
     *         in="query",
     *         description="beat_id",
     *         @OA\Schema(type="number")
     *     ),
     *      @OA\Parameter(
     *         name="tp_date",
     *         in="query",
     *         description="tp_date",
     *           required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get OutletList successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getCustomersByBeat()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $beatId = $this->app->Request()->getParameter("beat_id", 0);
                $tpDate = $this->app->Request()->getParameter("tp_date", 0);

                $customerList = OutletViewQuery::create()->findByBeatId($beatId);
                $custarray = array();
                $datetime = DateTime::createFromFormat('Y-m-d', $tpDate); // Parse the date string
                $formatted_date = $datetime->format('m-Y'); // Format the date as "07-2024"
                $mtp = MtpQuery::create()->filterByMonth($formatted_date)->filterByPositionId($this->app->Auth()->getUser()->getEmployee()->getPositionId())->findOne();
                foreach ($customerList as $customer) {
                    $startDate = date("Y-m-1", strtotime($tpDate));
                    $endDate = date("Y-m-t", strtotime($tpDate));

                    $tourPalns = TourplansQuery::create();
                    if ($startDate != null && $endDate != null) {
                        $doneVFQ = $tourPalns->filterByTpDate($startDate, Criteria::GREATER_EQUAL)
                            ->filterByTpDate($endDate, Criteria::LESS_EQUAL)
                            ->filterByOutletOrgDataId($customer->getOutletOrgId())
                            ->filterByMtpId($mtp->getMtpId())
                            ->filterByBeatId($beatId)
                            ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
                            ->find()->count();
                    } else {
                        $doneVFQ = 0;
                    }
                    // if ($customer->getOutletOrgId() != null) {
                    //     $hospicares = $tourPalns->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    //         ->joinWithOutletOrgData()
                    //         ->filterByOutletOrgDataId($customer->getOutletOrgId(), Criteria::NOT_EQUAL)
                    //         ->filterByTpDate($tpDate)
                    //         ->filterByCompanyId($this->app->Auth()->CompanyId())
                    //         ->find();
                    //     $hospicareName = array();
                    //     foreach ($hospicares as $hospicare) {
                    //         if ($hospicare->getOutletOrgData()->getOrgUnit()->getIsExposed() != null || $hospicare->getOutletOrgData()->getOrgUnit()->getIsExposed() != "0") {
                    //             if ($customer->getOutletId() == $hospicare->getOutletOrgData()->getOutletId()) {
                    //                 $employee = EmployeeQuery::create()
                    //                     ->filterByPositionId($hospicare->getPositionId())
                    //                     ->findOne();
                    //                 $hospicareaData['division'] = $hospicare->getOutletOrgData()->getOrgUnit()->getUnitName();
                    //                 $hospicareaData['name'] = $employee->getFirstName();
                    //                 array_push($hospicareName, $hospicareaData);
                    //             }
                    //         }
                    //     }
                    // }
                    $flag = 0;
                    if ($tpDate != null) {
                        $tour = $tourPalns->filterByTpDate($tpDate)
                            ->filterByOutletOrgDataId($customer->getOutletOrgId())
                            ->filterByCompanyId($this->app->Auth()->CompanyId())
                            ->findOne();
                        if ($tour == null) {
                            $flag = 1;
                        }
                    }
                    if ($customer->getItownid() != null) {
                        $town = GeoTownsQuery::create()->filterByItownid($customer->getItownid())->findOne();
                    } else {
                        $town = null;
                    }

                    if ($town != null) {
                        $townName = $town->getStownname();
                    } else {
                        $townName = "";
                    }
                    $data = array(
                        'Id' => $customer->getPrimaryKey(),
                        'outlet_name' => $customer->getOutletName(),
                        'town' => $townName,
                        'done_VFQ' => $doneVFQ,
                        'VFQ' => $customer->getVisitFq(),
                        'Tags' => $customer->getTags(),
                        'BeatName' => $customer->getBeatName(),
                        'Flag' => $flag,
                        'outlet_contact_name' => $customer->getOutletContactName(),
                        'classification' => $customer->getClassification(),
                        'outlet_type_name' => $customer->getOutlettypeName(),
                        'OutlettypeId' => $customer->getOutlettypeId(),
                        'Hospicare' => [],
                    );
                    array_push($custarray, $data);
                }
                $this->apiResponse($custarray, 200, "Get Territories successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getCustomerForJW",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="territory_id",
     *         in="query",
     *         description="territory_id",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Parameter(
     *         name="tp_date",
     *         in="query",
     *         description="tp_date",
     *         @OA\Schema(type="date")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get OutletList successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getCustomerForJW()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $territory_id = $this->app->Request()->getParameter("territory_id", 0);
                $tp_date = $this->app->Request()->getParameter("tp_date", date("Y-M-d"));
                $mgr = new MTPManager();
                $customers = $mgr->getCustomerForJW($tp_date, $territory_id);
                $time = strtotime($tp_date);
                $month = date("m", $time);
                $year = date("Y", $time);
                $startDate = $year . '-' . $month . '-' . '01';
                $endDate = $year . '-' . $month . '-' . '30';


                $positionId = $this->app->Auth()->getUser()->getEmployee()->getPositionId();
                $totTour = TourplansQuery::create()
                    ->filterByTpDate($startDate, Criteria::GREATER_EQUAL)
                    ->filterByTpDate($endDate, Criteria::LESS_EQUAL)
                    ->filterByPositionId($positionId)
                    ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
                    ->find()->toArray();
                $moYe = date('m-Y', strtotime($tp_date));

                $ter = \entities\TerritoriesQuery::create()
                    ->filterByTerritoryId($territory_id)
                    ->findOne();
                $mtp = \entities\MtpQuery::create()
                    ->filterByPositionId($ter->getPositionId())
                    ->filterByMonth($moYe)
                    ->findOne();
                if ($mtp != null && $mtp != '' && $mtp->getMtpStatus() != null) {
                    if ($mtp->getMtpStatus() == 'draft') {
                        return $this->apiResponse([], 400, "Please submit this month MTP.");
                    } else if ($mtp->getMtpStatus() == 'requested') {
                        return $this->apiResponse([], 400, "First please Approved this month MTP.");
                    }
                } else {
                    return $this->apiResponse([], 400, "No activities are planned for this day.");
                }

                $totalArr = [];

                foreach ($customers as $cust) {


                    /*
                      $hospicareName = [];
                      $hospicareaData = [];



                      $hospicares = TourplansQuery::create()
                          ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                          ->joinWithOutletOrgData()
                          ->filterByOutletOrgDataId($orgId, Criteria::NOT_EQUAL)
                          ->filterByTpDate($tp_date)
                          ->filterByCompanyId(7)
                          ->find()->toArray();


                      foreach ($hospicares as $hospicare) {


                          $orgUnit = OrgUnitQuery::create()
                              ->filterByOrgunitid($hospicare['OutletOrgData']['OrgUnitId'])
                              ->findOne();


                          if ($orgUnit->getIsExposed() != null || $orgUnit->getIsExposed() != "0") {

                              if ($ct['Outlet_Id'] == $hospicare['OutletOrgData']['OutletId']) {
                                  $employee = EmployeeQuery::create()
                                      ->filterByPositionId($hospicare['PositionId'])
                                      ->findOne();

                                  $hospicareaData['division'] = $orgUnit->getUnitName();
                                  $hospicareaData['name'] = $employee->getFirstName();


                                  $hospicareName[] = $hospicareaData;
                              }
                          }


                      }*/


                    /*$tourPlans = TourplansQuery::create()
                        ->filterByTpDate($tp_date)
                        ->filterByOutletOrgDataId($orgId)
                        ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
                        ->findOne();

                    if ($tourPlans == null) {
                        $flag = 1;
                    } else {
                        $flag = 0;
                    }*/


                    $town = GeoTownsQuery::create()
                        ->filterByItownid($cust->getItownid())
                        ->findOne();
                    $townName = "";
                    if ($town != null) {
                        $townName = $town->getStownname();
                    }

                    $Custarray['Id'] = $cust->getPrimaryKey();
                    $Custarray['outlet_name'] = $cust->getOutletName();
                    $Custarray['town'] = $townName;
                    $Custarray['done_VFQ'] = count($totTour);
                    $Custarray['VFQ'] = $cust->getVisitFq();
                    $Custarray['Tags'] = $cust->getTags();
                    $Custarray['BeatName'] = $cust->getBeatName();
                    $Custarray['Flag'] = 0;
                    $Custarray['outlet_contact_name'] = $cust->getOutletContactName();
                    $Custarray['classification'] = $cust->getClassification();
                    $Custarray['outlet_type_name'] = $cust->getOutlettypeName();
                    $Custarray['OutlettypeId'] = $cust->getOutlettypeId();
                    $Custarray['Hospicare'] = "";
                    $totalArr[] = $Custarray;
                }
                $position = TerritoriesQuery::create()->filterByTerritoryId($territory_id)->findOne();
                $employee = EmployeeQuery::create()->filterByPositionId($position->getPositionId())->findOne();

                $leave = \entities\LeaveRequestQuery::create()
                    ->filterByLeaveFrom($tp_date, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->filterByLeaveTo($tp_date, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByEmployeeId($employee->getEmployeeId())
                    ->filterByLeaveStatus(2)
                    ->find();
                $tourPla = \entities\TourplansQuery::create()
                    ->filterByTpDate($tp_date)
                    ->filterByPositionId($employee->getPositionId())
                    ->filterByAgendacontroltype('FW')
                    ->find()->count();

                if ($tourPla === 0) {
                    return $this->apiResponse([], 400, "MR will nca On this day");
                }
                if (count($leave) > 0) {
                    $this->apiResponse([], 400, "MR will leave On this day");
                } else {
                    $this->apiResponse($totalArr, 200, "Get Territories successfully!");
                }
                break;
        endswitch;
    }


    /**
     * @OA\Get(
     *     path="/api/getTPStates",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Tourplans successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getTPStates()
    {
        $this->apiResponse($this->getConfig("FSM", "MtpStatus"), 200, "TP States");
    }

    /**
     * @OA\POST(
     *     path="/api/createMTP",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="month",
     *         in="query",
     *         description="month",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Parameter(
     *         name="year",
     *         in="query",
     *         description="year",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="MTP created successfully!",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="mtp", type="array", @OA\Items())
     *         )
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function createMTP()
    {
        try {
            $month = $this->app->Request()->getParameter("month", "");
            $year = $this->app->Request()->getParameter("year", "");
            $emp = $this->app->Auth()->getUser()->getEmployeeId();

            $manager = new MTPManager();
            $mtp = $manager->createMTP($emp, $month, $year);

            $this->apiResponse(["mtp" => $mtp->toArray()], 200, "Start your Planning now");
        } catch (Exception $e) {
            $this->apiResponse(["error_message" => $e->getMessage()], 400, $e->getMessage());
        }
    }

    /**
     * @OA\POST(
     *     path="/api/resetMTP",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="mtp_id",
     *         in="query",
     *         description="mtp_id",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="MTP reset successfully!",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="mtp", type="array", @OA\Items())
     *         )
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function resetMTP()
    {
        try {
            $emp = $this->app->Auth()->getUser()->getEmployeeId();
            $mtp_id = $this->app->Request()->getParameter("mtp_id", "");

            $manager = new MTPManager();
            $mtp = $manager->resetMTP($mtp_id, $emp);

            $this->apiResponse(["mtp" => $mtp->toArray()], 200, "MTP Reset");
        } catch (Exception $e) {
            $this->apiResponse(["error_message" => $e->getMessage()], 400, $e->getMessage());
        }
    }



    /**
     * @OA\GET(
     *     path="/api/getRemainingDoctor",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="mtp_id",
     *         in="query",
     *         description="mtp_id",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Tourplans successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */

    public function getRemainingDoctor()
    {
        $mtp_id = $this->app->Request()->getParameter("mtp_id", "");
        $doctorData = TourplansQuery::create()
            ->filterByMtpId($mtp_id)
            ->joinWith('Tourplans.OutletOrgData')
            ->useOutletOrgDataQuery()
            ->joinWith('OutletOrgData.Outlets')
            ->useOutletsQuery()
            ->joinWith('Outlets.OutletType')
            ->useOutletTypeQuery()
            ->filterByOutlettypeName('Doctor')
            ->endUse()
            ->endUse()
            ->endUse()
            ->withColumn('COUNT(Outlets.id)', 'Count')
            ->withColumn('Outlets.id', 'OutletId')
            ->withColumn('Outlets.OutletName', 'OutletName')
            ->withColumn('OutletOrgData.visit_fq', 'VisitFq')
            ->groupBy('Outlets.id')
            ->groupBy('Outlets.id')
            ->select(array('Count', 'VisitFq', 'OutletName', 'OutletId'))
            ->find()
            ->toArray();

        $docArr = [];
        $totArr = [];
        foreach ($doctorData as $doc) {

            $docArr[] = $doc['OutletId'];
            $totArr[$doc['OutletId']] = $doc['Count'];


        }
        $employee = EmployeeQuery::create()->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())->findOne();
        $positionId = $employee->getPositionId();
        $outletView = OutletViewQuery::create()->select(['Id', 'VisitFq', 'BeatName', 'OutletName'])->filterByPositionId($positionId)->filterByOutlettypeName('Doctor')->find()->toArray();
        $remeiningDoctor = 0;
        $remeiningDoctorList = [];
        $totalDoctorList = [];
        foreach ($outletView as $view) {

            if (in_array($view['Id'], $docArr)) {
                if ($totArr[$view['Id']] < $view['VisitFq']) {

                    $remeiningDoctorList['OutletName'] = $view['OutletName'];
                    $remeiningDoctorList['Count'] = $totArr[$view['Id']];
                    $remeiningDoctorList['VisitFq'] = $view['VisitFq'];
                    $remeiningDoctorList['beat'] = $view['BeatName'];
                    $totalDoctorList[] = $remeiningDoctorList;
                }
            } else {
                $remeiningDoctorList['OutletName'] = $view['OutletName'];
                $remeiningDoctorList['Count'] = 0;
                $remeiningDoctorList['VisitFq'] = $view['VisitFq'];
                $remeiningDoctorList['beat'] = $view['BeatName'];
                $totalDoctorList[] = $remeiningDoctorList;
            }
        }


        return $this->apiResponse($totalDoctorList, 200, 'Data Get Successfully');
    }

    /**
     * @OA\GET(
     *     path="/api/getMTPList",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Tourplans successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getMTPList()
    {
        try {

            $emp = $this->app->Auth()->getUser()->getEmployeeId();

            $manager = new MTPManager();
            $mtp = $manager->getMTPList($emp);
            $mtps = $mtp->toArray();
            $mtpArray = [];
            $totalArray = [];

            foreach ($mtps as $mt) {
                $leaves = $manager->getLeavesCount($emp, $mt['Month']);
                $totalVisits = $this->totalVisits($mt);
                $mtpArray['MtpId'] = $mt['MtpId'];
                $mtpArray['PositionId'] = $mt['PositionId'];
                $mtpArray['CompanyId'] = $mt['CompanyId'];
                $mtpArray['Month'] = $mt['Month'];
                $mtpArray['MtpStatus'] = $mt['MtpStatus'];
                $mtpArray['MtpApprovedBy'] = $mt['MtpApprovedBy'];
                $mtpArray['ApprovedDate'] = $mt['ApprovedDate'];
                $mtpArray['CreatedAt'] = $mt['CreatedAt'];
                $mtpArray['UpdatedAt'] = $mt['UpdatedAt'];
                $mtpArray['OutletsCovered'] = $mt['OutletsCovered'];
                $mtpArray['MonthDays'] = $mt['MonthDays'];
                $mtpArray['WorkingDays'] = $mt['WorkingDays'];
                $mtpArray['TotalLeaves'] = $leaves;
                $data = [];

                if ($mt['AgendaDays'] == null) {
                    $days = [
                        [
                            "count" => 0,
                            "Agendacontroltype" => "NCA"
                        ],
                        [
                            "count" => 0,
                            "Agendacontroltype" => "FW"
                        ],
                    ];
                } else {


                    $days = $mt['AgendaDays'];
                    $arr = [];
                    foreach ($days as $d) {
                        $arr[] = $d['Agendacontroltype'];
                    }

                    if (!in_array('FW', $arr)) {
                        $data = [
                            "count" => 0,
                            "Agendacontroltype" => "FW"
                        ];
                    }
                    if (!in_array('NCA', $arr)) {
                        $data = [
                            "count" => 0,
                            "Agendacontroltype" => "NCA"
                        ];
                    }
                }
                //                var_dump($data);exit;
                $mtpArray['AgendaDays'] = $days;
                if (count($data) > 0) {

                    $mtpArray['AgendaDays'][] = $data;
                }
                if ($mt['TotalOutlets'] == null) {
                    $outlets = [
                        [
                            "count" => 0,
                            "OutlettypeName" => "Doctor"
                        ],
                        [
                            "count" => 0,
                            "OutlettypeName" => "Stockist"
                        ],
                        [
                            "count" => 0,
                            "OutlettypeName" => "Pharmacy"
                        ],
                    ];
                } else {
                    $outlets = $mt['TotalOutlets'];
                }
                $mtpArray['TotalOutlets'] = $outlets;
                $mtpArray['DoctorCoverage'] = $totalVisits['Doctor'];
                $mtpArray['ChemistCoverage'] = $totalVisits['Chemist'];
                $mtpArray['StockistCoverage'] = $totalVisits['Stockist'];
                $mtpArray['RemainingDoctor'] = $totalVisits['Remaining'];
                $mtpArray['TotalVisits'] = $mt['TotalVisits'];
                $mtpArray['VisitsFq'] = $mt['VisitsFq'];
                $totalArray[] = $mtpArray;
            }


            $this->apiResponse(["mtp" => $totalArray], 200, "List Of MTP");
        } catch (Exception $e) {
            $this->apiResponse(["error_message" => $e->getMessage()], 400, "ERROR");
        }
    }

    /**
     * @OA\GET(
     *     path="/api/getMTPListV2",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Tourplans successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getMTPListV2()
    {
        try {

            $emp = $this->app->Auth()->getUser()->getEmployeeId();

            $manager = new MTPManager();
            $mtp = $manager->getMTPList($emp);
            $mtps = $mtp->toArray();
            $mtpArray = [];
            $totalArray = [];
            $orgUnitId = $this->app->Auth()->getUser()->getEmployee()->getOrgUnitId();
            $outletTypes = OutletTypeQuery::create()
                ->select(array('OutlettypeName'))
                ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
                ->filterByOrgUnitId($orgUnitId)
                ->find()
                ->toArray();
            $labels = implode(',', $outletTypes);

            foreach ($mtps as $mt) {
                $leaves = $manager->getLeavesCount($emp, $mt['Month']);
                $totalVisits = $this->totalVisitsV2($mt);
                $mtpArray['MtpId'] = $mt['MtpId'];
                $mtpArray['PositionId'] = $mt['PositionId'];
                $mtpArray['CompanyId'] = $mt['CompanyId'];
                $mtpArray['Month'] = $mt['Month'];
                $mtpArray['MtpStatus'] = $mt['MtpStatus'];
                $mtpArray['MtpApprovedBy'] = $mt['MtpApprovedBy'];
                $mtpArray['ApprovedDate'] = $mt['ApprovedDate'];
                $mtpArray['CreatedAt'] = $mt['CreatedAt'];
                $mtpArray['UpdatedAt'] = $mt['UpdatedAt'];
                $mtpArray['OutletsCovered'] = $mt['OutletsCovered'];
                $mtpArray['MonthDays'] = $mt['MonthDays'];
                $mtpArray['WorkingDays'] = $mt['WorkingDays'];
                $mtpArray['TotalLeaves'] = $leaves;
                $mtpArray['labels'] = $labels;
                $data = [];

                if ($mt['AgendaDays'] == null) {
                    $days = [
                        [
                            "count" => 0,
                            "Agendacontroltype" => "NCA"
                        ],
                        [
                            "count" => 0,
                            "Agendacontroltype" => "FW"
                        ],
                    ];
                } else {


                    $days = $mt['AgendaDays'];
                    $arr = [];
                    foreach ($days as $d) {
                        $arr[] = $d['Agendacontroltype'];
                    }

                    if (!in_array('FW', $arr)) {
                        $data = [
                            "count" => 0,
                            "Agendacontroltype" => "FW"
                        ];
                    }
                    if (!in_array('NCA', $arr)) {
                        $data = [
                            "count" => 0,
                            "Agendacontroltype" => "NCA"
                        ];
                    }
                }
                //                var_dump($data);exit;
                $mtpArray['AgendaDays'] = $days;
                if (count($data) > 0) {

                    $mtpArray['AgendaDays'][] = $data;
                }
                if ($mt['TotalOutlets'] == null) {
                    $outlets = [
                        [
                            "count" => 0,
                            "OutlettypeName" => "Doctor"
                        ],
                        [
                            "count" => 0,
                            "OutlettypeName" => "Stockist"
                        ],
                        [
                            "count" => 0,
                            "OutlettypeName" => "Pharmacy"
                        ],
                    ];
                } else {
                    $outlets = $mt['TotalOutlets'];
                }
                foreach ($outlets as &$outlet) {
                    $outletType = $outlet['OutlettypeName'];
                    $coverage = 0;

                    foreach ($totalVisits as $visit) {
                        if ($visit['outlettypename'] === $outletType) {
                            $coverage = $visit['count'];
                            break;
                        }
                    }

                    $outlet['Coverage'] = $coverage;
                }
                $mtpArray['TotalOutlets'] = $outlets;
//                $mtpArray['Coverage'] = $totalVisits;
                $mtpArray['RemainingDoctor'] = 0;
                $mtpArray['TotalVisits'] = $mt['TotalVisits'];
                $mtpArray['VisitsFq'] = $mt['VisitsFq'];
                $totalArray[] = $mtpArray;
            }


            $this->apiResponse(["mtp" => $totalArray], 200, "List Of MTP");
        } catch (Exception $e) {
            $this->apiResponse(["error_message" => $e->getMessage()], 400, "ERROR");
        }
    }


    /**
     * @OA\GET(
     *     path="/api/getMTPListNew",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Tourplans successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getMTPListNew()
    {
        try {

            $emp = $this->app->Auth()->getUser()->getEmployeeId();

            $manager = new MTPManager();
            $mtp = $manager->getMTPList($emp);
            $mtps = $mtp->toArray();
            $mtpArray = [];
            $totalArray = [];

            foreach ($mtps as $mt) {
                $leaves = $manager->getLeavesCount($emp, $mt['Month']);
                $totalVisits = $this->totalVisits($mt);
                $mtpArray['MtpId'] = $mt['MtpId'];
                $mtpArray['PositionId'] = $mt['PositionId'];
                $mtpArray['CompanyId'] = $mt['CompanyId'];
                $mtpArray['Month'] = $mt['Month'];
                $mtpArray['MtpStatus'] = $mt['MtpStatus'];
                $mtpArray['MtpApprovedBy'] = $mt['MtpApprovedBy'];
                $mtpArray['ApprovedDate'] = $mt['ApprovedDate'];
                $mtpArray['CreatedAt'] = $mt['CreatedAt'];
                $mtpArray['UpdatedAt'] = $mt['UpdatedAt'];
                $mtpArray['OutletsCovered'] = $mt['OutletsCovered'];
                $mtpArray['MonthDays'] = $mt['MonthDays'];
                $mtpArray['WorkingDays'] = $mt['WorkingDays'];
                $mtpArray['TotalLeaves'] = $leaves;
                $data = [];

                if ($mt['AgendaDays'] == null) {
                    $days = [
                        [
                            "count" => 0,
                            "Agendacontroltype" => "NCA"
                        ],
                        [
                            "count" => 0,
                            "Agendacontroltype" => "FW"
                        ],
                    ];
                } else {


                    $days = $mt['AgendaDays'];
                    $arr = [];
                    foreach ($days as $d) {
                        $arr[] = $d['Agendacontroltype'];
                    }

                    if (!in_array('FW', $arr)) {
                        $data = [
                            "count" => 0,
                            "Agendacontroltype" => "FW"
                        ];
                    }
                    if (!in_array('NCA', $arr)) {
                        $data = [
                            "count" => 0,
                            "Agendacontroltype" => "NCA"
                        ];
                    }
                }
                //                var_dump($data);exit;
                $mtpArray['AgendaDays'] = $days;
                if (count($data) > 0) {

                    $mtpArray['AgendaDays'][] = $data;
                }
                if ($mt['TotalOutlets'] == null) {
                    $outlets = [
                        [
                            "count" => 0,
                            "OutlettypeName" => "Doctor"
                        ],
                        [
                            "count" => 0,
                            "OutlettypeName" => "Stockist"
                        ],
                        [
                            "count" => 0,
                            "OutlettypeName" => "Pharmacy"
                        ],
                    ];
                } else {
                    $outlets = $mt['TotalOutlets'];
                }
                $mtpArray['TotalOutlets'] = $outlets;
                $mtpArray['DoctorCoverage'] = $totalVisits['Doctor'];
                $mtpArray['ChemistCoverage'] = $totalVisits['Chemist'];
                $mtpArray['StockistCoverage'] = $totalVisits['Stockist'];
                $mtpArray['RemainingDoctor'] = $totalVisits['Remaining'];
                $mtpArray['TotalVisits'] = $mt['TotalVisits'];
                $mtpArray['VisitsFq'] = $mt['VisitsFq'];
                $totalArray[] = $mtpArray;
            }


            $this->apiResponse(["mtp" => $totalArray], 200, "List Of MTP");
        } catch (Exception $e) {
            $this->apiResponse(["error_message" => $e->getMessage()], 400, "ERROR");
        }
    }

    public function totalOrganizationWiseVisit($mt, $mtpId)
    {
        $doctorData = TourplansQuery::create()
            ->filterByTpDate($mt)
            ->filterByMtpId($mtpId)
            ->joinWith('Tourplans.OutletOrgData')
            ->useOutletOrgDataQuery()
            ->joinWith('OutletOrgData.Outlets')
            ->useOutletsQuery()
            ->joinWith('Outlets.OutletType')
            ->useOutletTypeQuery()
            ->filterByOutlettypeName('Doctor')
            ->_or()
            ->filterByOutlettypeName('Stockist')
            ->_or()
            ->filterByOutlettypeName('Pharmacy')
            ->endUse()
            ->endUse()
            ->endUse()
            ->withColumn('COUNT(Outlets.id)', 'Count')
            ->withColumn('Outlets.id', 'OutletId')
            ->withColumn('OutletType.OutlettypeName', 'OutlettypeName')
            ->groupBy('Outlets.id')
            ->select(array('Count', 'OutlettypeName'))
            ->find()
            ->toArray();


        $doctorCoverage = 0;
        $chemistCoverage = 0;
        $stokistCoverage = 0;
        foreach ($doctorData as $doctor) {

            if ($doctor['OutlettypeName'] == "Doctor") {
                $doctorCoverage += 1;

            } elseif ($doctor['OutlettypeName'] == "Pharmacy") {
                $chemistCoverage += 1;
            } elseif ($doctor['OutlettypeName'] == "Stockist") {
                $stokistCoverage += 1;

            }

        }
        $total['Doctor'] = $doctorCoverage;
        $total['Chemist'] = $chemistCoverage;
        $total['Stockist'] = $stokistCoverage;

        return $total;
    }

    public function totalOrganizationWiseVisitV2($mt, $mtpId)
    {
        $orgUniId = $this->app->Auth()->getUser()->getEmployee()->getOrgUnitId();

        $outletTypes = OutletTypeQuery::create()->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())->find()->toArray();
        $totalIds = [];
        foreach ($outletTypes as $outletType) {
            $orgUnitIds = $outletType['OrgUnitId'];
            if ($orgUnitIds === null) {
                continue;
            }
            $totalOrgUnitIds = explode(",", $orgUnitIds);

            foreach ($totalOrgUnitIds as $org) {
                if ($org == $orgUniId) {
                    $totalIds[] = $outletType['OutlettypeId'];
                }
            }
        }
        // Step 1: Retrieve all possible outlet types
        $outletTypes = OutletTypeQuery::create()
            ->select(array('OutlettypeName'))
            ->filterByOutlettypeId($totalIds)
            ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
            ->find()
            ->toArray();

        // Step 2: Initialize the coverageData array with all outlet types and set their count to 0
        $coverageData = [];
        foreach ($outletTypes as $type) {
            $coverageData[$type] = [
                'outlettypename' => $type,
                'count' => 0,
            ];
        }

        // Step 3: Get doctorData and update the count for matching outlet types
        $doctorData = TourplansQuery::create()
            ->filterByTpDate($mt)
            ->filterByMtpId($mtpId)
            ->joinWith('Tourplans.OutletOrgData')
            ->joinWith('OutletOrgData.Outlets')
            ->joinWith('Outlets.OutletType')
            ->withColumn('COUNT(Outlets.id)', 'Count')
            ->withColumn('OutletType.OutlettypeName', 'OutlettypeName')
            ->groupBy('OutlettypeName')// Group by outlet type name only
            ->select(array('Count', 'OutlettypeName'))
            ->find()
            ->toArray();

        foreach ($doctorData as $data) {
            $outletType = $data['OutlettypeName'];
            if (isset($coverageData[$outletType])) {
                $coverageData[$outletType]['count'] = $data['Count']; // Directly use the calculated count from the query
            }
        }

        // Step 4: Reindex the array to get a numeric array
        $coverageData = array_values($coverageData);

        return $coverageData;
    }


    public function totalMtpVisit($mtp)
    {
        $visits = TourplansQuery::create()
            ->select(['Count', 'VisitFq', 'OutlettypeId', 'OutletId'])
            ->joinWith('Tourplans.OutletOrgData')
            ->joinWith('OutletOrgData.Outlets')
            ->withColumn('COUNT(Outlets.id)', 'Count')
            ->withColumn('Outlets.id', 'OutletId')
            ->withColumn('OutletOrgData.visit_fq', 'VisitFq')
            ->withColumn('Outlets.OutlettypeId', 'OutlettypeId')
            ->filterByMtpId($mtp['MtpId'])
            ->groupBy('Outlets.id', 'OutletOrgData.visit_fq')
            ->find()->toArray();

        $doctorArr = [];
        $totalArr = [];
        foreach ($visits as $doctor) {
            if ($doctor['OutlettypeId'] == 194) {
                $doctorArr[] = $doctor['OutletId'];
                $totalArr[$doctor['OutletId']] = $doctor['Count'];
            }
        }

        $outletView = OutletViewQuery::create()
            ->select(['Id', 'VisitFq'])
            ->filterByPositionId($mtp['PositionId'])
            ->filterByOutlettypeId(194)
            ->find()->toArray();
        $remeiningDoctor = 0;
        foreach ($outletView as $view) {
            if (in_array($view['Id'], $doctorArr)) {
                if ($totalArr[$view['Id']] < $view['VisitFq']) {
                    $remeiningDoctor += 1;
                }
            } else {
                $remeiningDoctor += 1;
            }
        }

        $doctorCoverage = 0;
        $chemistCoverage = 0;
        $stokistCoverage = 0;
        $mtpList = [];
        foreach ($visits as $doctor) {
            if ($doctor['OutlettypeId'] == 194) {
                $doctorCoverage += 1;
            } elseif ($doctor['OutlettypeId'] == 195) {
                $chemistCoverage += 1;
            } elseif ($doctor['OutlettypeId'] == 196) {
                $stokistCoverage += 1;

            }
        }
        $total['Doctor'] = $doctorCoverage;
        $total['Chemist'] = $chemistCoverage;
        $total['Stockist'] = $stokistCoverage;
        $total['Remaining'] = $remeiningDoctor;

        return $total;
    }

    public function totalVisitsV2($mt)
    {
        $orgUniId = $this->app->Auth()->getUser()->getEmployee()->getOrgUnitId();

        // Get all outlet types for the company
        $outletTypes = OutletTypeQuery::create()
            ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
            ->find()
            ->toArray();

        $totalIds = [];

        // Collect all outlet type IDs associated with the current user's org unit
        foreach ($outletTypes as $outletType) {
            $orgUnitIds = $outletType['OrgUnitId'];
            if ($orgUnitIds === null) {
                continue;
            }
            $totalOrgUnitIds = explode(",", $orgUnitIds);

            foreach ($totalOrgUnitIds as $org) {
                if ($org == $orgUniId) {
                    $totalIds[] = $outletType['OutlettypeId'];
                }
            }
        }

        // Query tour plan data with the filtered outlet type IDs
        $doctorData = TourplansQuery::create()
            ->filterByMtpId($mt['MtpId'])
            ->useOutletOrgDataQuery() // Joining OutletOrgData
            ->useOutletsQuery() // Joining Outlets
            ->useOutletTypeQuery() // Joining OutletType
            ->filterByOutlettypeId($totalIds, Criteria::IN) // Filtering by outlet type IDs
            ->endUse()
            ->endUse()
            ->endUse()
            ->withColumn('COUNT(Outlets.id)', 'Count')
            ->withColumn('Outlets.id', 'OutletId')
            ->withColumn('OutletType.OutlettypeName', 'OutlettypeName')
            ->withColumn('OutletOrgData.visit_fq', 'VisitFq')
            ->groupBy('Outlets.id')
            ->groupBy('OutletOrgData.visit_fq')
            ->groupBy('OutletType.OutlettypeName')
            ->select(['Count', 'VisitFq', 'OutlettypeName'])
            ->find()
            ->toArray();

        // Organize coverage data
        $coverageData = [];
        foreach ($doctorData as $data) {
            $outletType = $data['OutlettypeName'];

            // Check if the outlet type already exists in the coverageData array
            $found = false;
            foreach ($coverageData as &$coverageItem) {
                if ($coverageItem['outlettypename'] === $outletType) {
                    $coverageItem['count'] += 1;
                    $found = true;
                    break;
                }
            }

            // If the outlet type does not exist, add it to the array with a count of 1
            if (!$found) {
                $coverageData[] = [
                    'outlettypename' => $outletType,
                    'count' => 1,
                ];
            }
        }

        // Sort the coverage data by outlet type name
        usort($coverageData, function ($a, $b) {
            return strcmp($a['outlettypename'], $b['outlettypename']);
        });

        return $coverageData;
    }



    public function totalVisits($mt)
    {
        $doctorData = TourplansQuery::create()
            ->filterByMtpId($mt['MtpId'])
            ->joinWith('Tourplans.OutletOrgData')
            ->useOutletOrgDataQuery()
            ->joinWith('OutletOrgData.Outlets')
            ->useOutletsQuery()
            ->joinWith('Outlets.OutletType')
            ->useOutletTypeQuery()
            ->filterByOutlettypeName('Doctor')
            ->_or()
            ->filterByOutlettypeName('Stockist')
            ->_or()
            ->filterByOutlettypeName('Pharmacy')
            ->endUse()
            ->endUse()
            ->endUse()
            ->withColumn('COUNT(Outlets.id)', 'Count')
            ->withColumn('Outlets.id', 'OutletId')
            ->withColumn('OutletType.OutlettypeName', 'OutlettypeName')
            ->withColumn('OutletOrgData.visit_fq', 'VisitFq')
            ->groupBy('Outlets.id')
            ->groupBy('OutletOrgData.visit_fq')
            ->select(array('Count', 'VisitFq', 'OutlettypeName'))
            ->find()
            ->toArray();
        $docArr = [];
        $totArr = [];
        foreach ($doctorData as $doc) {
            if ($doc['OutlettypeName'] == "Doctor") {
                $docArr[] = $doc['OutletId'];
                $totArr[$doc['OutletId']] = $doc['Count'];
            }

        }

        $outletView = OutletViewQuery::create()->select(['Id', 'VisitFq'])->filterByPositionId($mt['PositionId'])->filterByOutlettypeName('Doctor')->find()->toArray();
        $remeiningDoctor = 0;
        foreach ($outletView as $view) {

            if (in_array($view['Id'], $docArr)) {
                if ($totArr[$view['Id']] < $view['VisitFq']) {

                    $remeiningDoctor += 1;
                }
            } else {
                $remeiningDoctor += 1;
            }
        }
        $doctorCoverage = 0;
        $chemistCoverage = 0;
        $stokistCoverage = 0;
        $mtpList = [];
        foreach ($doctorData as $doctor) {

            if ($doctor['OutlettypeName'] == "Doctor") {
                $doctorCoverage += 1;

            } elseif ($doctor['OutlettypeName'] == "Pharmacy") {
                $chemistCoverage += 1;
            } elseif ($doctor['OutlettypeName'] == "Stockist") {
                $stokistCoverage += 1;

            }

        }
        $total['Doctor'] = $doctorCoverage;
        $total['Chemist'] = $chemistCoverage;
        $total['Stockist'] = $stokistCoverage;
        $total['Remaining'] = $remeiningDoctor;

        return $total;
    }

    /**
     * @OA\GET(
     *     path="/api/getMtpById",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="mtp_id",
     *         in="query",
     *         description="mtp_id",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Parameter(
     *         name="last_log_id",
     *         in="query",
     *         description="last log id",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Tourplans successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getMtpById()
    {
        $mtp_id = $this->app->Request()->getParameter("mtp_id", "");
        $last_log_id = $this->app->Request()->getParameter("last_log_id", 0);

        $manager = new MTPManager();

        $mtp = $manager->getMTPById($mtp_id);
        $mt = $mtp->toArray();

        if($mt['MtpStatus'] == 'processing') {
            $logs = $manager->getMTPLogByMTPId($mtp_id, $last_log_id)->toArray();
            return $this->apiResponse(["logs" => $logs], 207, "MTP Logs");
        }

        $emp = EmployeeQuery::create()->filterByPositionId($mt['PositionId'])->filterByStatus(1)->findOne();
        $leaves = $manager->getLeavesCount($emp->getEmployeeId(), $mt['Month']);
        $totalVisits = $this->totalVisits($mt);

        $mtpArray['MtpId'] = $mt['MtpId'];
        $mtpArray['PositionId'] = $mt['PositionId'];
        $mtpArray['CompanyId'] = $mt['CompanyId'];
        $mtpArray['Month'] = $mt['Month'];
        $mtpArray['MtpStatus'] = $mt['MtpStatus'];
        $mtpArray['MtpApprovedBy'] = $mt['MtpApprovedBy'];
        $mtpArray['ApprovedDate'] = $mt['ApprovedDate'];
        $mtpArray['CreatedAt'] = $mt['CreatedAt'];
        $mtpArray['UpdatedAt'] = $mt['UpdatedAt'];
        $mtpArray['OutletsCovered'] = $mt['OutletsCovered'];
        $mtpArray['MonthDays'] = $mt['MonthDays'];
        $mtpArray['WorkingDays'] = $mt['WorkingDays'];
        $mtpArray['TotalLeaves'] = $leaves;
        $data = [];

        if ($mt['AgendaDays'] == null) {
            $days = [
                [
                    "count" => 0,
                    "Agendacontroltype" => "NCA"
                ],
                [
                    "count" => 0,
                    "Agendacontroltype" => "FW"
                ],
            ];
        } else {


            $days = $mt['AgendaDays'];
            $arr = [];
            foreach ($days as $d) {
                $arr[] = $d['Agendacontroltype'];
            }

            if (!in_array('FW', $arr)) {
                $data = [
                    "count" => 0,
                    "Agendacontroltype" => "FW"
                ];
            }
            if (!in_array('NCA', $arr)) {
                $data = [
                    "count" => 0,
                    "Agendacontroltype" => "NCA"
                ];
            }
        }

        $mtpArray['AgendaDays'] = $days;
        if (count($data) > 0) {

            $mtpArray['AgendaDays'][] = $data;
        }
        if ($mt['TotalOutlets'] == null) {
            $outlets = [
                [
                    "count" => 0,
                    "OutlettypeName" => "Doctor"
                ],
                [
                    "count" => 0,
                    "OutlettypeName" => "Stockist"
                ],
                [
                    "count" => 0,
                    "OutlettypeName" => "Pharmacy"
                ],
            ];
        } else {
            $outlets = $mt['TotalOutlets'];
        }
        $mtpArray['TotalOutlets'] = $outlets;
        $mtpArray['DoctorCoverage'] = $totalVisits['Doctor'];
        $mtpArray['ChemistCoverage'] = $totalVisits['Chemist'];
        $mtpArray['StockistCoverage'] = $totalVisits['Stockist'];
        $mtpArray['RemainingDoctor'] = $totalVisits['Remaining'];
        $mtpArray['TotalVisits'] = $mt['TotalVisits'];
        $mtpArray['VisitsFq'] = $mt['VisitsFq'];


        $d = new DateTime("01-" . $mtp->getMonth());
        // $ds = new DateTime("30-" . $mtp->getMonth());

        $startDate = $d->format('Y-m-d');
        $endDate = $d->format('Y-m-t');
        $sundays = array();

        $newStart = new DateTime($startDate);
        $newEnd = new DateTime($endDate);

        while ($newStart <= $newEnd) {
            if ($newStart->format('w') == 0) {
                $sundays[] = $newStart->format('Y-m-d');
            }

            $newStart->modify('+1 day');
        }
        $employeeBranch = EmployeeQuery::create()->select(['BranchId'])->filterByPositionId($mt['PositionId'])->find()->toArray();
        $state = BranchQuery::create()->select(['Istateid'])->filterByBranchId($employeeBranch)->find()->toArray();
        $empId = EmployeeQuery::create()->select(['EmployeeId'])->filterByPositionId($mt['PositionId'])->filterByStatus(1)->find()->toArray();


        $holidays = HolidaysQuery::create()
            ->select(['HolidayDate', 'HolidayName'])
            ->filterByIstateid($state)
            ->filterByHolidayDate($startDate, Criteria::GREATER_EQUAL)
            ->filterByHolidayDate($endDate, Criteria::LESS_EQUAL)
            ->find()->toArray();
        $leaves = LeavesQuery::create()
            ->select(['LeaveDate', 'LeaveType', 'LeaveRemark'])
            ->filterByEmployeeId($empId)
            ->filterByLeaveDate($startDate, Criteria::GREATER_EQUAL)
            ->filterByLeaveDate($endDate, Criteria::LESS_EQUAL)
            ->filterByLeavePoints(0, Criteria::LESS_THAN)
            ->find()->toArray();


        $holi = [];

        foreach ($holidays as $holiday) {
            $holi[] = $holiday['HolidayDate'];
        }
        $leaveDate = [];
        foreach ($leaves as $leave) {
            $leaveDate[] = $leave['LeaveDate'];
        }


        if ($mtp != null) {

            $days = MtpDayQuery::create()->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')->findByMtpId($mtp_id)->toArray();

            $dayArray = [];
            $totalArray = [];

            foreach ($days as $day) {
                if (in_array($day['MtpDayDate'], $holi)) {
                    continue;
                }

                if (in_array($day['MtpDayDate'], $sundays)) {
                    continue;
                }

                if (in_array($day['MtpDayDate'], $leaveDate)) {
                    continue;
                }
                $tourPlans = TourplansQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->joinWithAgendatypes()
                    ->filterByMtpId($mtp->getMtpId())
                    ->filterByMtpDayId($day['MtpDayId'])
                    ->find()->toArray();
                $agendaArray = "";

                foreach ($tourPlans as $agent) {

                    if ($agent['Agendacontroltype'] == "NCA") {
                        $agendaArray = $agent['Agendatypes']['Agendname'];
                    }
                }
                $agenda = "";
                if ($agendaArray != "") {
                    $agenda = $agendaArray;
                }


                $beat = TourplansQuery::create()
                    //                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->select(['BeatId'])
                    ->groupByBeatId()
                    ->filterByMtpId($mtp->getMtpId())
                    ->filterByMtpDayId($day['MtpDayId'])
                    ->find()
                    ->toArray();
                //                var_dump($beat);exit;


                $beatArray = BeatsQuery::create()
                    ->select(['BeatName'])
                    ->filterByBeatId($beat)
                    ->find()->toArray();


                $tourBeat = "";
                if (count($beatArray) > 0) {

                    $tourBeat = implode(',', $beatArray);
                }

                $town = TourplansQuery::create()
                    ->select('Itownid')
                    ->groupByItownid()
                    ->filterByMtpId($mtp->getMtpId())
                    ->filterByMtpDayId($day['MtpDayId'])
                    ->find()
                    ->toArray();

                $townArray = GeoTownsQuery::create()
                    ->select(["Stownname"])
                    ->filterByItownid($town)
                    ->find()->toArray();


                $tourTown = "";
                if (count($townArray) > 0) {

                    $tourTown = implode(',', $townArray);
                }
                $oneTour = TourplansQuery::create()
                    ->select('MtpId')
                    ->filterByMtpId($mtp->getMtpId())
                    ->filterByMtpDayId($day['MtpDayId'])
                    ->findOne();
                $isFlag = 0;
                if ($oneTour != null) {
                    $isFlag = 1;
                }

                $outlets = TourplansQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->filterByAgendacontroltype("FW")
                    ->filterByMtpId($mtp->getMtpId())
                    ->filterByMtpDayId($day['MtpDayId'])
                    ->find()->toArray();

                $nca = TourplansQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->filterByAgendacontroltype("NCA")
                    ->filterByMtpId($mtp->getMtpId())
                    ->filterByMtpDayId($day['MtpDayId'])
                    ->find()->toArray();

                $organization = $this->totalOrganizationWiseVisit($day['MtpDayDate'], $day['MtpId']);

                $dayArray['MtpDayId'] = $day['MtpDayId'];
                $dayArray['MtpDayDate'] = $day['MtpDayDate'];
                $dayArray['Weekday'] = $day['Weekday'];
                $dayArray['Weeknumber'] = $day['Weeknumber'];
                $dayArray['MtpId'] = $day['MtpId'];
                $dayArray['CompanyId'] = $day['CompanyId'];
                $dayArray['MtpdayRemark'] = $day['MtpdayRemark'];
                $dayArray['Ishalfday'] = $day['Ishalfday'];
                $dayArray['CreatedAt'] = $day['CreatedAt'];
                $dayArray['UpdatedAt'] = $day['UpdatedAt'];
                $dayArray['is_flag'] = $isFlag;
                $dayArray['outlet_count'] = count($outlets);
                $dayArray['Doctor'] = $organization['Doctor'];
                $dayArray['Chemist'] = $organization['Chemist'];
                $dayArray['Stockist'] = $organization['Stockist'];
                $dayArray['NCA'] = count($nca);
                $dayArray['beat'] = $tourBeat;
                $dayArray['town'] = $tourTown;
                $dayArray['agenda'] = $agenda;
                $totalArray[] = $dayArray;
            }

            $this->apiResponse(["mtp" => $mtpArray, "days" => $totalArray, "holiday" => $holidays, "leaves" => $leaves, 'weekOff' => $sundays], 200, "MTP");
        } else {
            $this->apiResponse(["error" => "MTP NOT FOUND"], 400, "MTP");
        }
    }

    /**
     * @OA\GET(
     *     path="/api/getMtpLogById",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="log_id",
     *         in="query",
     *         description="log_id",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get MTP Logs successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getMtpLogById()
    {
        $log_id = $this->app->Request()->getParameter("log_id", "");

        $manager = new MTPManager();
        $log = $manager->getMtpLogById($log_id);

        return $this->apiResponse(["log" => $log], 200, "MTP Logs");
    }

    /**
     * @OA\GET(
     *     path="/api/getMtpByIdV2",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="mtp_id",
     *         in="query",
     *         description="mtp_id",
     *         required=true,
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Parameter(
     *         name="last_log_id",
     *         in="query",
     *         description="last log id",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Tourplans successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getMtpByIdV2()
    {
        $mtp_id = $this->app->Request()->getParameter("mtp_id", "");
        $last_log_id = $this->app->Request()->getParameter("last_log_id", 0);

        $orgUnitId = $this->app->Auth()->getUser()->getEmployee()->getOrgUnitId();

        $manager = new MTPManager();
        $mtp = $manager->getMTPById($mtp_id);
        $mt = $mtp->toArray();

        if($mt['MtpStatus'] == 'processing') {
            $logs = $manager->getMTPLogByMTPId($mtp_id, $last_log_id)->toArray();
            return $this->apiResponse(["logs" => $logs], 207, "MTP Logs");
        }
        
        $outletTypes = OutletTypeQuery::create()
            ->select(array('OutlettypeName'))
            ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
            ->filterByOrgUnitId($orgUnitId)
            ->find()
            ->toArray();
        $labels = implode(',', $outletTypes);

        $emp = EmployeeQuery::create()->filterByPositionId($mt['PositionId'])->filterByStatus(1)->findOne();
        $leaves = $manager->getLeavesCount($emp->getEmployeeId(), $mt['Month']);
        $totalVisits = $this->totalVisitsV2($mt);

        $mtpArray['MtpId'] = $mt['MtpId'];
        $mtpArray['PositionId'] = $mt['PositionId'];
        $mtpArray['CompanyId'] = $mt['CompanyId'];
        $mtpArray['Month'] = $mt['Month'];
        $mtpArray['MtpStatus'] = $mt['MtpStatus'];
        $mtpArray['MtpApprovedBy'] = $mt['MtpApprovedBy'];
        $mtpArray['ApprovedDate'] = $mt['ApprovedDate'];
        $mtpArray['CreatedAt'] = $mt['CreatedAt'];
        $mtpArray['UpdatedAt'] = $mt['UpdatedAt'];
        $mtpArray['OutletsCovered'] = $mt['OutletsCovered'];
        $mtpArray['MonthDays'] = $mt['MonthDays'];
        $mtpArray['WorkingDays'] = $mt['WorkingDays'];
        $mtpArray['TotalLeaves'] = $leaves;
        $mtpArray['Labels'] = $labels;
        $data = [];

        if ($mt['AgendaDays'] == null) {
            $days = [
                [
                    "count" => 0,
                    "Agendacontroltype" => "NCA"
                ],
                [
                    "count" => 0,
                    "Agendacontroltype" => "FW"
                ],
            ];
        } else {


            $days = $mt['AgendaDays'];
            $arr = [];
            foreach ($days as $d) {
                $arr[] = $d['Agendacontroltype'];
            }

            if (!in_array('FW', $arr)) {
                $data = [
                    "count" => 0,
                    "Agendacontroltype" => "FW"
                ];
            }
            if (!in_array('NCA', $arr)) {
                $data = [
                    "count" => 0,
                    "Agendacontroltype" => "NCA"
                ];
            }
        }

        $mtpArray['AgendaDays'] = $days;
        if (count($data) > 0) {

            $mtpArray['AgendaDays'][] = $data;
        }
        if ($mt['TotalOutlets'] == null) {
            $outlets = [
                [
                    "count" => 0,
                    "OutlettypeName" => "Distributor"
                ],
                [
                    "count" => 0,
                    "OutlettypeName" => "Retailer"
                ],
                [
                    "count" => 0,
                    "OutlettypeName" => "Dealer"
                ],
            ];
        } else {
            $outlets = $mt['TotalOutlets'];
        }
        foreach ($outlets as &$outlet) {
            $outletType = $outlet['OutlettypeName'];
            $coverage = 0;

            foreach ($totalVisits as $visit) {
                if ($visit['outlettypename'] === $outletType) {
                    $coverage = $visit['count'];
                    break;
                }
            }

            $outlet['Coverage'] = $coverage;
        }
        $mtpArray['TotalOutlets'] = $outlets;
//        $mtpArray['Coverage'] = $totalVisits;
        $mtpArray['RemainingDoctor'] = 0;
        $mtpArray['TotalVisits'] = $mt['TotalVisits'];
        $mtpArray['VisitsFq'] = $mt['VisitsFq'];


        $d = new DateTime("01-" . $mtp->getMonth());
        // $ds = new DateTime("30-" . $mtp->getMonth());

        $startDate = $d->format('Y-m-d');
        $endDate = $d->format('Y-m-t');
        $sundays = array();

        $newStart = new DateTime($startDate);
        $newEnd = new DateTime($endDate);

        while ($newStart <= $newEnd) {
            if ($newStart->format('w') == 0) {
                $sundays[] = $newStart->format('Y-m-d');
            }

            $newStart->modify('+1 day');
        }
        $employeeBranch = EmployeeQuery::create()->select(['BranchId'])->filterByPositionId($mt['PositionId'])->find()->toArray();
        $state = BranchQuery::create()->select(['Istateid'])->filterByBranchId($employeeBranch)->find()->toArray();
        $empId = EmployeeQuery::create()->select(['EmployeeId'])->filterByPositionId($mt['PositionId'])->filterByStatus(1)->find()->toArray();


        $holidays = HolidaysQuery::create()
            ->select(['HolidayDate', 'HolidayName'])
            ->filterByIstateid($state)
            ->filterByHolidayDate($startDate, Criteria::GREATER_EQUAL)
            ->filterByHolidayDate($endDate, Criteria::LESS_EQUAL)
            ->find()->toArray();
        $leaves = LeavesQuery::create()
            ->select(['LeaveDate', 'LeaveType', 'LeaveRemark'])
            ->filterByEmployeeId($empId)
            ->filterByLeaveDate($startDate, Criteria::GREATER_EQUAL)
            ->filterByLeaveDate($endDate, Criteria::LESS_EQUAL)
            ->filterByLeavePoints(0, Criteria::LESS_THAN)
            ->find()->toArray();


        $holi = [];

        foreach ($holidays as $holiday) {
            $holi[] = $holiday['HolidayDate'];
        }
        $leaveDate = [];
        foreach ($leaves as $leave) {
            $leaveDate[] = $leave['LeaveDate'];
        }


        if ($mtp != null) {

            $days = MtpDayQuery::create()->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')->findByMtpId($mtp_id)->toArray();

            $dayArray = [];
            $totalArray = [];

            foreach ($days as $day) {
                if (in_array($day['MtpDayDate'], $holi)) {
                    continue;
                }

                if (in_array($day['MtpDayDate'], $sundays)) {
                    continue;
                }

                if (in_array($day['MtpDayDate'], $leaveDate)) {
                    continue;
                }
                $tourPlans = TourplansQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->joinWithAgendatypes()
                    ->filterByMtpId($mtp->getMtpId())
                    ->filterByMtpDayId($day['MtpDayId'])
                    ->find()->toArray();
                $agendaArray = "";

                foreach ($tourPlans as $agent) {

                    if ($agent['Agendacontroltype'] == "NCA") {
                        $agendaArray = $agent['Agendatypes']['Agendname'];
                    }
                }
                $agenda = "";
                if ($agendaArray != "") {
                    $agenda = $agendaArray;
                }


                $beat = TourplansQuery::create()
                    //                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->select(['BeatId'])
                    ->groupByBeatId()
                    ->filterByMtpId($mtp->getMtpId())
                    ->filterByMtpDayId($day['MtpDayId'])
                    ->find()
                    ->toArray();
                //                var_dump($beat);exit;


                $beatArray = BeatsQuery::create()
                    ->select(['BeatName'])
                    ->filterByBeatId($beat)
                    ->find()->toArray();


                $tourBeat = "";
                if (count($beatArray) > 0) {

                    $tourBeat = implode(',', $beatArray);
                }

                $town = TourplansQuery::create()
                    ->select('Itownid')
                    ->groupByItownid()
                    ->filterByMtpId($mtp->getMtpId())
                    ->filterByMtpDayId($day['MtpDayId'])
                    ->find()
                    ->toArray();

                $townArray = GeoTownsQuery::create()
                    ->select(["Stownname"])
                    ->filterByItownid($town)
                    ->find()->toArray();


                $tourTown = "";
                if (count($townArray) > 0) {

                    $tourTown = implode(',', $townArray);
                }
                $oneTour = TourplansQuery::create()
                    ->select('MtpId')
                    ->filterByMtpId($mtp->getMtpId())
                    ->filterByMtpDayId($day['MtpDayId'])
                    ->findOne();
                $isFlag = 0;
                if ($oneTour != null) {
                    $isFlag = 1;
                }

                $outlets = TourplansQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->filterByAgendacontroltype("FW")
                    ->filterByMtpId($mtp->getMtpId())
                    ->filterByMtpDayId($day['MtpDayId'])
                    ->find()->toArray();

                $nca = TourplansQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->filterByAgendacontroltype("NCA")
                    ->filterByMtpId($mtp->getMtpId())
                    ->filterByMtpDayId($day['MtpDayId'])
                    ->find()->toArray();

                $organization = $this->totalOrganizationWiseVisitV2($day['MtpDayDate'], $day['MtpId']);

                $dayArray['MtpDayId'] = $day['MtpDayId'];
                $dayArray['MtpDayDate'] = $day['MtpDayDate'];
                $dayArray['Weekday'] = $day['Weekday'];
                $dayArray['Weeknumber'] = $day['Weeknumber'];
                $dayArray['MtpId'] = $day['MtpId'];
                $dayArray['CompanyId'] = $day['CompanyId'];
                $dayArray['MtpdayRemark'] = $day['MtpdayRemark'];
                $dayArray['Ishalfday'] = $day['Ishalfday'];
                $dayArray['CreatedAt'] = $day['CreatedAt'];
                $dayArray['UpdatedAt'] = $day['UpdatedAt'];
                $dayArray['is_flag'] = $isFlag;
                $dayArray['outlet_count'] = count($outlets);
                $dayArray['Coverage'] = $organization;
                $dayArray['NCA'] = count($nca);
                $dayArray['beat'] = $tourBeat;
                $dayArray['town'] = $tourTown;
                $dayArray['agenda'] = $agenda;
                $totalArray[] = $dayArray;
            }

            $this->apiResponse(["mtp" => $mtpArray, "days" => $totalArray, "holiday" => $holidays, "leaves" => $leaves, 'weekOff' => $sundays], 200, "MTP");
        } else {
            $this->apiResponse(["error" => "MTP NOT FOUND"], 400, "MTP");
        }
    }

    /**
     * @OA\GET(
     *     path="/api/submitMTP",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="mtp_id",
     *         in="query",
     *         description="mtp_id",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Submit MTP for Approval",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function submitMTP()
    {
        $empId = $this->app->Auth()->getUser()->getEmployeeId();
        $employee = EmployeeQuery::create()->filterByEmployeeId($empId)->findOne();
//        $managers = OrgManager::getManagerPositions($employee->getPositionId());
        $mtp_id = $this->app->Request()->getParameter("mtp_id", "");


        // foreach ($doctorData as $doctor) {
        //     if ($doctor['VisitFq'] == null) {
        //         continue;
        //     }

        //     if ($doctor['Count'] < $doctor['VisitFq']) {
        //         return $this->apiResponse([], 400, 'Please Cover the Doctor as their frequency');
        //     }

        // }


//        $team = OrgManager::getUnderPositions($this->app->Auth()->getUser()->getEmployee()->getPositionId());
//        $mt = MtpQuery::create()->filterByMtpId($mtp_id)->findOne();
//        if (count($team)==0){
//            $totalVisit = $this->totalVisits($mt->toArray());
//            if($totalVisit['Remaining']>0){
//                return $this->apiResponse([], 400, "Please Plan All Doctors As per their VF");
//            }
//
//
//        }


        $managerWithStatus1Found = false;

        /*foreach ($managers as $managerPositionId) {
            // Check if the manager's status is 1
            $manager = EmployeeQuery::create()->filterByPositionId($managerPositionId)->findOne();

            if ($manager && $manager->getStatus() == 1) {
                // If a manager with status 1 is found, set the flag and break the loop
                $managerWithStatus1Found = true;
                break;
            }
        }*/

        // if ($managerWithStatus1Found == false) {
        //     return $this->apiResponse([], 400, "Manager Not Found");
        // }


        $mtp_id = $this->app->Request()->getParameter("mtp_id", "");

        $manager = new MTPManager();

        $mtp = $manager->getMTPById($mtp_id);

        if ($mtp != null) {
            $mtps = MtpDayQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->filterByMtpId($mtp_id)
                ->find()
                ->toArray();

            foreach ($mtps as $mts) {

                $mtpDays = MtpDayQuery::create()
                    ->filterByMtpDayDate($mts['MtpDayDate'])
                    ->filterByMtpId($mts['MtpId'])
                    ->find()->toArray();

                if (count($mtpDays) > 1) {
                    foreach ($mtpDays as $mtpDay) {
                        $tourplan = TourplansQuery::create()
                            ->filterByMtpDayId($mtpDay['MtpDayId'])
                            ->filterByMtpId($mtpDay['MtpId'])
                            ->findOne();

                        if ($tourplan == null) {
                            $mtpDayDelete = MtpDayQuery::create()
                                ->findPK($mtpDay['MtpDayId']);
                            $mtpDayDelete->delete();
                        }
                    }
                }

                $date = MtpDayQuery::create()
                    ->select(['MtpDayDate'])
                    ->filterByMtpDayId($mts['MtpDayId'])
                    ->findOne();
                /*$weekDay = date('w', strtotime($date));
                var_dump($weekDay);
                exit;*/
                if ($date != null) {
                    $dt1 = strtotime($date);
                    $dt2 = date("l", $dt1);
                    $dt3 = strtolower($dt2);
                    if ($dt3 == "sunday") {
                        continue;
                    }

                    $leave = LeavesQuery::create()
                        ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())
                        ->filterByLeaveDate($date)
                        ->findOne();

                    if ($leave != null) {
                        continue;
                    }
                }

                $holidays = HolidaysQuery::create()
                    ->select(['HolidayDate'])
                    ->filterByIstateid($employee->getBranch()->getIstateid())
                    ->filterByHolidayDate($date)
                    ->findOne();

                if ($holidays != null) {
                    continue;
                }

                $tours = TourplansQuery::create()
                    ->filterByMtpDayId($mts['MtpDayId'])
                    ->filterByMtpId($mts['MtpId'])
                    ->find()
                    ->toArray();
                if (count($tours) == 0) {
                    return $this->apiResponse([], 400, "Please plan all working days!");
                }

            }


            foreach ($mtps as $mts) {

                $date = MtpDayQuery::create()
                    ->select(['MtpDayDate'])
                    ->filterByMtpDayId($mts['MtpDayId'])
                    ->findOne();
                /*$weekDay = date('w', strtotime($date));
                var_dump($weekDay);
                exit;*/
                if ($date != null) {
                    $dt1 = strtotime($date);
                    $dt2 = date("l", $dt1);
                    $dt3 = strtolower($dt2);
                    if ($dt3 == "sunday") {
                        continue;
                    }

                    $leave = LeavesQuery::create()
                        ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())
                        ->filterByLeaveDate($date)
                        ->findOne();

                    if ($leave != null) {
                        continue;
                    }
                }

                $holidays = HolidaysQuery::create()
                    ->select(['HolidayDate'])
                    ->filterByIstateid($employee->getBranch()->getIstateid())
                    ->filterByHolidayDate($date)
                    ->findOne();

                if ($holidays != null) {
                    continue;
                }


                $nca = TourplansQuery::create()
                    ->filterByMtpDayId($mts['MtpDayId'])
                    ->filterByMtpId($mts['MtpId'])
                    ->filterByAgendacontroltype("NCA")
                    ->find()->count();

                $fw = TourplansQuery::create()
                    ->filterByMtpDayId($mts['MtpDayId'])
                    ->filterByMtpId($mts['MtpId'])
                    ->filterByAgendacontroltype("FW")
                    ->find()->count();


                if ($fw < 4 && $nca == 0) {
                    return $this->apiResponse([], 400, "Your Fieldwork must be greater than 4 or 1 NCA on each date!.");
                }

                /*if ($nca < 1 && $fw < 2) {
                    return $this->apiResponse([], 400, "Submission Denied: Check MTP Guidelines.");
                }

                if ($fw == 0) {
                    if ($nca < 2) {
                        return $this->apiResponse([], 400, "Submission Denied: Check MTP Guidelines.");
                    }
                }*/


                // if ($tours == null) {
                //     $fwTours = TourplansQuery::create()
                //         ->filterByMtpDayId($mts['MtpDayId'])
                //         ->filterByMtpId($mts['MtpId'])
                //         ->filterByAgendacontroltype("FW")
                //         ->find()
                //         ->toArray();
                //     if (count($fwTours) < 4 && count($tours) <= 0) {
                //         return $this->apiResponse([], 400, "Your Field Work Must Be Grater Than 4");
                //     }
                // }
            }


            //             $tourPlan = TourplansQuery::create()
            //                 ->filterByMtpId($mtp->getMtpId())
            //                 ->find()
            //                 ->toArray();
            // //            var_dump(count($tourPlan));exit;

            //             if (count($tourPlan) < $visitFq) {
            //                 return $this->apiResponse([], 400, "Your Visit Frequency is not 100%");
            //             }


            //        $outlet = OutletsQuery::
            $mtp->setMtpStatus("requested");
            $mtp->setMtpApprovedBy($this->app->Auth()->getUser()->getEmployeeId());
            $mtp->setApprovedDate(date("Y-M-d"));
            $mtp->save();

            try {
                $emp = $this->app->Auth()->getUser()->getEmployee();
                $myManager = $emp->getReportingTo();
                $notiManager = new NotificationManager();
                $notiManager->sendNotificationToPosition(
                    $myManager,
                    "New MTP for approval",
                    $emp->getFirstName() . " Submited MTP FOR :" . $mtp->getMonth(),
                    $mtp->toArray()
                );
            } catch (Exception $e) {
            }


            $this->apiResponse(["mtp" => $mtp->toArray()], 200, "MTP Submited for Approval");
        } else {
            $this->apiResponse(["error" => "MTP NOT FOUND"], 400, "MTP");
        }
    }

    /**
     * @OA\GET(
     *     path="/api/getMtpDayById",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="mtp_day_id",
     *         in="query",
     *         description="mtp_day_id",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Tourplans successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getMtpDayById()
    {
        $mtpDayId = $this->app->Request()->getParameter("mtp_day_id", "");
        $data = TourplansQuery::create()->findByMtpDayId($mtpDayId);
        //$data = TourplansQuery::create()->filterByMtpDayId($mtpDayId)->find()->toArray();


        $custArr = array();
        foreach ($data as $d) {

            // $hospicares = TourplansQuery::create()
            //     ->filterByOutletOrgDataId($d->getOutletOrgDataId(), Criteria::NOT_EQUAL)
            //     ->filterByTpDate($d->getTpDate())
            //     ->filterByCompanyId($this->app->Auth()->CompanyId())
            //     ->find();
            // $hospicareName = array();
            // foreach ($hospicares as $hospicare) {
            //     if ($hospicare->getOutletOrgData()->getOrgUnit()->getIsExposed() != null || $hospicare->getOutletOrgData()->getOrgUnit()->getIsExposed() != "0") {
            //         $employee = EmployeeQuery::create()
            //             ->filterByPositionId($hospicare->getPositionId())
            //             ->findOne();
            //         array_push($hospicareName, $employee->getFirstName());
            //     }
            // }
            // unset($hospicares);
            if ($d->getUpdatedAt() != null) {
                $updatedAt = $d->getUpdatedAt()->format('Y-m-d H:i:s');
            } else {
                $updatedAt = null;
            }
            $dataArr = array(
                'TpId' => $d->getTpId(),
                'TpDate' => $d->getTpDate()->format('Y-m-d'),
                'CompanyId' => $d->getCompanyId(),
                'TpRemark' => $d->getTpRemark(),
                'PositionId' => $d->getPositionId(),
                'Agendacontroltype' => $d->getAgendacontroltype(),
                'BeatId' => $d->getBeatId(),
                'Itownid' => $d->getItownid(),
                'Weekday' => $d->getWeekday(),
                'Weeknumber' => $d->getWeeknumber(),
                'AgendaId' => $d->getAgendaId(),
                'Isjw' => $d->getIsjw(),
                'OutletOrgDataId' => $d->getOutletOrgDataId(),
                'MtpId' => $d->getMtpId(),
                'CreatedAt' => $d->getCreatedAt()->format('Y-m-d H:i:s'),
                'UpdatedAt' => $updatedAt,
                'MtpDayId' => $d->getMtpDayId(),
                'Hospicare' => "",
            );
            array_push($custArr, $dataArr);
        }
        $this->apiResponse(["MtpDay" => $custArr], 200, "MTP");
    }

    /**
     * @OA\GET(
     *     path="/api/addTourPlan",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="mtp_id",
     *         in="query",
     *         description="mtp_id",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Parameter(
     *         name="mtp_day_id",
     *         in="query",
     *         description="mtp_day_id",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Parameter(
     *         name="agendacontroltype",
     *         in="query",
     *         description="agendacontroltype",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="beat_id",
     *         in="query",
     *         description="beat_id",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Parameter(
     *         name="itownid",
     *         in="query",
     *         description="itownid",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Parameter(
     *         name="agenda_id",
     *         in="query",
     *         description="agenda_id",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_org_data_id",
     *         in="query",
     *         description="outlet_org_data_id",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Parameter(
     *         name="campaign_visit_plan_id",
     *         in="query",
     *         description="Brand campaign visit plan id",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Tourplans successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function addTourPlan()
    {
        $mtp_id = $this->app->Request()->getParameter("mtp_id", "");
        $mtp_day_id = $this->app->Request()->getParameter("mtp_day_id", "");
        $agendacontroltype = $this->app->Request()->getParameter("agendacontroltype", "");
        $beat_id = $this->app->Request()->getParameter("beat_id", "");
        $itownid = $this->app->Request()->getParameter("itownid", "");
        $agenda_id = $this->app->Request()->getParameter("agenda_id", "");
        $outlet_org_data_id = $this->app->Request()->getParameter("outlet_org_data_id", "");
        $campaign_visit_plan_id = $this->app->Request()->getParameter("campaign_visit_plan_id", "");

        $positionId = $this->app->Auth()->getUser()->getEmployee()->getPositionId();

        if ($agendacontroltype == "NCA") {
            if ($itownid != null) {
                $day = TourplansQuery::create()
                    ->filterByMtpId($mtp_id)
                    ->filterByMtpDayId($mtp_day_id)
                    ->filterByAgendacontroltype($agendacontroltype)
                    ->filterByAgendaId($agenda_id)
                    ->filterByItownid($itownid)
                    ->findOne();

                if ($day != null) {
                    return $this->apiResponse([], 400, "You cannot plan one more NCA with same NCA type and same town twice.");
                }
            }
        }

        if ($campaign_visit_plan_id != null && $campaign_visit_plan_id != '') {
            $campaigntourPlanOutlet = TourplansQuery::create()
                ->filterByMtpId($mtp_id)
                ->filterByCampaignVisitPlanId($campaign_visit_plan_id)
                ->findOne();

            if ($campaigntourPlanOutlet != null || $campaigntourPlanOutlet != '') {
                return $this->apiResponse([], 400, "Brand campaign plan for this month already exists!");
            }
        }

        if ($outlet_org_data_id != null) {
            $mtpDay = MtpDayQuery::create()
                ->filterByMtpDayId($mtp_day_id)
                ->findOne();

            if ($mtpDay == null) {
                return $this->apiResponse([], 400, "This Day is not Define in Mtp Day!");
            }
            // $mtpdate = date('Y-m-d', strtotime($mtpDay->getMtpDayDate() . ' - 3 days'));
            // $tourPlan = TourplansQuery::create()
            //     ->filterByTpDate($mtpdate, Criteria::GREATER_THAN)
            //     ->filterByTpDate($mtpDay->getMtpDayDate(), Criteria::LESS_THAN)
            //     ->filterByOutletOrgDataId($outlet_org_data_id)
            //     ->filterByPositionId($positionId)
            //     ->find()
            //     ->toArray();

            // if (count($tourPlan) > 0) {
            //     return $this->apiResponse([], 520, "You can meet doctor after 5 days after first meet");
            // }


            $tourPlanOutlet = TourplansQuery::create()
                ->filterByTpDate($mtpDay->getMtpDayDate())
                ->filterByOutletOrgDataId($outlet_org_data_id)
                ->filterByPositionId($positionId)
                ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
                ->findOne();
            if ($tourPlanOutlet != null) {
                return $this->apiResponse([], 520, "The doctor already exists for this date!");
            }
        }

        $tpr = new TourPlanRequest();
        if ($mtp_id != null && $mtp_id != '') {
            $tpr->setMtp_id($mtp_id);
        }
        if ($mtp_day_id != null && $mtp_day_id != '') {
            $tpr->setMtp_day_id($mtp_day_id);
        }
        if ($agendacontroltype != null && $agendacontroltype != '') {
            $tpr->setAgendacontroltype($agendacontroltype);
        }
        if ($beat_id != null && $beat_id != '') {
            $tpr->setBeat_id($beat_id);
        }
        if ($itownid != null && $itownid != '') {
            $tpr->setItownid($itownid);
        }
        if ($agenda_id != null && $agenda_id != '') {
            $tpr->setAgenda_id($agenda_id);
        }
        if ($outlet_org_data_id != null && $outlet_org_data_id != '') {
            $tpr->setOutlet_org_data_id($outlet_org_data_id);
        }
        if ($campaign_visit_plan_id != null && $campaign_visit_plan_id != '') {
            $tpr->setCampaignVisitPlanId($campaign_visit_plan_id);
        }

        $manager = new MTPManager();
        $mtp = $manager->addDayPlan($tpr);

        $this->apiResponse(["mtp" => $mtp->toArray()], 200, "Outlet is added");
    }


    /**
     * @OA\GET(
     *     path="/api/deleteTourPlan",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="TpId",
     *         in="query",
     *         description="TpId",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Tourplans successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function deleteTourPlan()
    {
        $TpId = $this->app->Request()->getParameter("TpId", 0);
        if ($TpId > 0) {
            TourplansQuery::create()
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->filterByTpId($TpId)
                ->delete();
        }

        $this->apiResponse(["status" => "Deleted"], 200, "MTP");
    }


    /**
     * @OA\GET(
     *     path="/api/approveMTP",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="mtp_id",
     *         in="query",
     *         description="mtp_id",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Tourplans successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function approveMTP()
    {
        $mtp_id = $this->app->Request()->getParameter("mtp_id", 0);
        $mgr = new MTPManager();
        if ($mtp_id > 0) {
            $mtp = MtpQuery::create()
                ->filterByMtpStatus("approved", Criteria::NOT_EQUAL)
                ->findPk($mtp_id);
            if ($mtp) {
                $mtp->setMtpStatus("approved");
                $mtp->setMtpApprovedBy($this->app->Auth()->getUser()->getEmployeeId());
                $mtp->setApprovedDate(date("Y-M-d"));
                $mtp->save();
                //$mgr->genrateDayPlan($mtp->getPrimaryKey());

                try {
                    $notiManager = new NotificationManager();
                    $notiManager->sendNotificationToPosition(
                        $mtp->getPositionId(),
                        "MTP Approved for " . $mtp->getMonth(),
                        $emp->getFirstName() . " Approved MTP FOR :" . $mtp->getMonth(),
                        $mtp->toArray()
                    );
                } catch (Exception $e) {
                }

                $this->apiResponse(["status" => "Plan Approved", "mtp" => $mtp->toArray()], 200, "MTP");
            } else {
                $this->apiResponse(["status" => "MTP Status incorrect or not found"], 500, "MTP");
            }
        }
    }

    /**
     * @OA\GET(
     *     path="/api/rejectMTP",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="mtp_id",
     *         in="query",
     *         description="mtp_id",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Tourplans successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function rejectMTP()
    {
        $mtp_id = $this->app->Request()->getParameter("mtp_id", 0);
        $mgr = new MTPManager();
        if ($mtp_id > 0) {
            $mtp = MtpQuery::create()
                ->filterByMtpStatus("reject", Criteria::NOT_EQUAL)
                ->findPk($mtp_id);
            if ($mtp) {
                $mtp->setMtpStatus("reject");
                $mtp->setMtpApprovedBy($this->app->Auth()->getUser()->getEmployeeId());
                $mtp->setApprovedDate(date("Y-M-d"));
                $mtp->save();
                //$mgr->genrateDayPlan($mtp->getPrimaryKey());

                try {
                    $notiManager = new NotificationManager();
                    $notiManager->sendNotificationToPosition(
                        $mtp->getPositionId(),
                        "MTP Rejected for " . $mtp->getMonth(),
                        $emp->getFirstName() . " Rejected MTP FOR :" . $mtp->getMonth(),
                        $mtp->toArray()
                    );
                } catch (Exception $e) {
                }


                $this->apiResponse(["status" => "Plan Rejected", "mtp" => $mtp->toArray()], 200, "MTP");
            } else {
                $this->apiResponse(["status" => "MTP Status incorrect or not found"], 500, "MTP");
            }
        }
    }


    /**
     * @OA\Get(
     *     path="/api/getRequestedMTPByPosition",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *
     *     @OA\Parameter(
     *         name="month",
     *         in="query",
     *         description="Month",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get MTP By Position_id!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getRequestedMTPByPosition()
    {

        switch ($this->app->Request()->getMethod()):
            case "GET":
                $month = $this->app->Request()->getParameter("month", 0);
                $manager = OrgManager::getUnderPositions($this->app->Auth()->getUser()->getEmployee()->getPositionId());
                $currentDate = date('Y-m-d');
                if ($manager) {
                    $cmanager = $emps = \entities\EmployeeQuery::create()
                        ->select(["PositionId"])
                        ->useHrUserDatesQuery()
                        ->filterByJoinDate($currentDate, Criteria::LESS_EQUAL)
                        ->endUse()
                        ->filterByStatus(1)
                        ->findByPositionId($manager)
                        ->toArray();
                }
                $cmanager[] = $this->app->Auth()->getUser()->getEmployee()->getPositionId();
                $mtpManager = new MTPManager();

                $mtps = MtpQuery::create()
                    ->filterByMonth($month)
                    ->filterByPositionId($cmanager)
                    ->find()->toArray();

                $mtpArr = [];
                $totalArr = [];

                foreach ($mtps as $mtp) {
                    if (!in_array($mtp['PositionId'], $cmanager)) {
                        continue;
                    }

                    $employee = EmployeeQuery::create()
                        ->filterByPositionId($mtp['PositionId'])
                        ->filterByStatus(1)
                        ->findOne();

                    if ($this->app->Auth()->getUser()->getEmployee()->getPositionId() == $mtp['PositionId']) {
                        $name = "My Self";
                    } else {
                        $name = "";
                        if ($employee != null) {

                            $name = $employee->getFirstName() . ' ' . $employee->getLastName();
                        }
                    }

                    if (!empty($employee)) {
                        $leaves = $mtpManager->getLeavesCount($employee->getEmployeeId(), $mtp['Month']);
                    } else {
                        $leaves = 0;
                    }

                    $mtpArr['MtpId'] = $mtp['MtpId'];
                    $mtpArr['PositionId'] = $mtp['PositionId'];
                    $mtpArr['CompanyId'] = $mtp['CompanyId'];
                    $mtpArr['Month'] = $mtp['Month'];
                    $mtpArr['MtpStatus'] = $mtp['MtpStatus'];
                    $mtpArr['MtpApprovedBy'] = $mtp['MtpApprovedBy'];
                    $mtpArr['ApprovedDate'] = $mtp['ApprovedDate'];
                    $mtpArr['CreatedAt'] = $mtp['CreatedAt'];
                    $mtpArr['UpdatedAt'] = $mtp['UpdatedAt'];
                    $mtpArr['OutletsCovered'] = $mtp['OutletsCovered'];
                    $mtpArr['MonthDays'] = $mtp['MonthDays'];
                    $mtpArr['WorkingDays'] = $mtp['WorkingDays'];
                    $mtpArr['TotalLeaves'] = $leaves;
                    $data = [];

                    if ($mtp['AgendaDays'] == null) {
                        $days = [
                            [
                                "count" => 0,
                                "Agendacontroltype" => "NCA"
                            ],
                            [
                                "count" => 0,
                                "Agendacontroltype" => "FW"
                            ],
                        ];
                    } else {


                        $days = $mtp['AgendaDays'];
                        $arr = [];
                        foreach ($days as $d) {
                            $arr[] = $d['Agendacontroltype'];
                        }

                        if (!in_array('FW', $arr)) {
                            $data = [
                                "count" => 0,
                                "Agendacontroltype" => "FW"
                            ];
                        }
                        if (!in_array('NCA', $arr)) {
                            $data = [
                                "count" => 0,
                                "Agendacontroltype" => "NCA"
                            ];
                        }
                    }
                    //                var_dump($data);exit;
                    $mtpArr['AgendaDays'] = $days;
                    if (count($data) > 0) {

                        $mtpArr['AgendaDays'][] = $data;
                    }
                    if ($mtp['TotalOutlets'] == null) {
                        $outlets = [
                            [
                                "count" => 0,
                                "OutlettypeName" => "Doctor"
                            ],
                            [
                                "count" => 0,
                                "OutlettypeName" => "Stockist"
                            ],
                            [
                                "count" => 0,
                                "OutlettypeName" => "Pharmacy"
                            ],
                        ];
                    } else {
                        $outlets = $mtp['TotalOutlets'];
                        usort($outlets, [$this, 'customSort']);
                    }
                    $mtpArr['TotalOutlets'] = $outlets;
                    $totalVisits = $this->totalVisits($mtp);

                    $mtpArr['DoctorCoverage'] = $totalVisits['Doctor'];
                    $mtpArr['ChemistCoverage'] = $totalVisits['Chemist'];
                    $mtpArr['StockistCoverage'] = $totalVisits['Stockist'];
                    $mtpArr['RemainingDoctor'] = $totalVisits['Remaining'];
                    $mtpArr['TotalVisits'] = $mtp['TotalVisits'];
                    $mtpArr['VisitsFq'] = $mtp['VisitsFq'];
                    $mtpArr['employee'] = $name;

                    // Old working logic
                    //$totalArr[] = $mtpArr;

                    // Condition approval pending from alembic team.
                    // changes by umesh chhatrala
                    if ($name != null && $name != '') {
                        $totalArr[] = $mtpArr;
                    }

                }

                $this->apiResponse($totalArr, 200, "Get MTP By Position_id!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getRequestedMTPByPositionV2",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *
     *     @OA\Parameter(
     *         name="month",
     *         in="query",
     *         description="Month",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get MTP By Position_id!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getRequestedMTPByPositionV2()
    {

        switch ($this->app->Request()->getMethod()):
            case "GET":
                $month = $this->app->Request()->getParameter("month", 0);
                $manager = OrgManager::getUnderPositions($this->app->Auth()->getUser()->getEmployee()->getPositionId());
                $currentDate = date('Y-m-d');
                if ($manager) {
                    $cmanager = $emps = \entities\EmployeeQuery::create()
                        ->select(["PositionId"])
                        ->useHrUserDatesQuery()
                        ->filterByJoinDate($currentDate, Criteria::LESS_EQUAL)
                        ->endUse()
                        ->filterByStatus(1)
                        ->findByPositionId($manager)
                        ->toArray();
                }
                $cmanager[] = $this->app->Auth()->getUser()->getEmployee()->getPositionId();
                $mtpManager = new MTPManager();

                $mtps = MtpQuery::create()
                    ->filterByMonth($month)
                    ->filterByPositionId($cmanager)
                    ->find()->toArray();

                $mtpArr = [];
                $totalArr = [];
                $orgUnitId = $this->app->Auth()->getUser()->getEmployee()->getOrgUnitId();
                $outletTypes = OutletTypeQuery::create()
                    ->select(array('OutlettypeName'))
                    ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
                    ->filterByOrgUnitId($orgUnitId)
                    ->find()
                    ->toArray();
                $labels = implode(',', $outletTypes);

                foreach ($mtps as $mtp) {
                    if (!in_array($mtp['PositionId'], $cmanager)) {
                        continue;
                    }

                    $employee = EmployeeQuery::create()
                        ->filterByPositionId($mtp['PositionId'])
                        ->filterByStatus(1)
                        ->findOne();

                    if ($this->app->Auth()->getUser()->getEmployee()->getPositionId() == $mtp['PositionId']) {
                        $name = "My Self";
                    } else {
                        $name = "";
                        if ($employee != null) {

                            $name = $employee->getFirstName() . ' ' . $employee->getLastName();
                        }
                    }

                    if (!empty($employee)) {
                        $leaves = $mtpManager->getLeavesCount($employee->getEmployeeId(), $mtp['Month']);
                    } else {
                        $leaves = 0;
                    }

                    $mtpArr['MtpId'] = $mtp['MtpId'];
                    $mtpArr['PositionId'] = $mtp['PositionId'];
                    $mtpArr['CompanyId'] = $mtp['CompanyId'];
                    $mtpArr['Month'] = $mtp['Month'];
                    $mtpArr['MtpStatus'] = $mtp['MtpStatus'];
                    $mtpArr['MtpApprovedBy'] = $mtp['MtpApprovedBy'];
                    $mtpArr['ApprovedDate'] = $mtp['ApprovedDate'];
                    $mtpArr['CreatedAt'] = $mtp['CreatedAt'];
                    $mtpArr['UpdatedAt'] = $mtp['UpdatedAt'];
                    $mtpArr['OutletsCovered'] = $mtp['OutletsCovered'];
                    $mtpArr['MonthDays'] = $mtp['MonthDays'];
                    $mtpArr['WorkingDays'] = $mtp['WorkingDays'];
                    $mtpArr['TotalLeaves'] = $leaves;
                    $mtpArr['labels'] = $labels;
                    $data = [];

                    if ($mtp['AgendaDays'] == null) {
                        $days = [
                            [
                                "count" => 0,
                                "Agendacontroltype" => "NCA"
                            ],
                            [
                                "count" => 0,
                                "Agendacontroltype" => "FW"
                            ],
                        ];
                    } else {


                        $days = $mtp['AgendaDays'];
                        $arr = [];
                        foreach ($days as $d) {
                            $arr[] = $d['Agendacontroltype'];
                        }

                        if (!in_array('FW', $arr)) {
                            $data = [
                                "count" => 0,
                                "Agendacontroltype" => "FW"
                            ];
                        }
                        if (!in_array('NCA', $arr)) {
                            $data = [
                                "count" => 0,
                                "Agendacontroltype" => "NCA"
                            ];
                        }
                    }
                    //                var_dump($data);exit;
                    $mtpArr['AgendaDays'] = $days;
                    if (count($data) > 0) {

                        $mtpArr['AgendaDays'][] = $data;
                    }
                    if ($mtp['TotalOutlets'] == null) {
                        $outlets = [
                            [
                                "count" => 0,
                                "OutlettypeName" => "Doctor"
                            ],
                            [
                                "count" => 0,
                                "OutlettypeName" => "Stockist"
                            ],
                            [
                                "count" => 0,
                                "OutlettypeName" => "Pharmacy"
                            ],
                        ];
                    } else {
                        $outlets = $mtp['TotalOutlets'];
//                        usort($outlets, [$this, 'customSort']);
                    }
                    $totalVisits = $this->totalVisitsV2($mtp);
                    foreach ($outlets as &$outlet) {
                        $outletType = $outlet['OutlettypeName'];
                        $coverage = 0;

                        foreach ($totalVisits as $visit) {
                            if ($visit['outlettypename'] === $outletType) {
                                $coverage = $visit['count'];
                                break;
                            }
                        }

                        $outlet['Coverage'] = $coverage;
                    }
                    $mtpArr['TotalOutlets'] = $outlets;


                    $mtpArr['Coverage'] = $totalVisits;
                    $mtpArr['RemainingDoctor'] = 0;
                    $mtpArr['TotalVisits'] = $mtp['TotalVisits'];
                    $mtpArr['VisitsFq'] = $mtp['VisitsFq'];
                    $mtpArr['employee'] = $name;

                    // Old working logic
                    //$totalArr[] = $mtpArr;

                    // Condition approval pending from alembic team.
                    // changes by umesh chhatrala
                    if ($name != null && $name != '') {
                        $totalArr[] = $mtpArr;
                    }

                }


                $this->apiResponse($totalArr, 200, "Get MTP By Position_id!");
                break;
        endswitch;
    }

    function customSort($a, $b)
    {
        // Define the custom order
        $order = [
            "DOCTOR" => 1,
            "Doctor" => 2,
            "Stockist" => 3,
            "STOCKIST" => 4,
            "Pharmacy" => 5,
            "PHARMACY" => 6,
            "Hospital" => 7,
            "HOSPITAL" => 8,
            "Dealer" => 9,
            "Company" => 10,
        ];
        // Get the order value for each OutlettypeName
        $orderA = $order[$a['OutlettypeName']];
        $orderB = $order[$b['OutlettypeName']];

        // Compare the order values
        return $orderA - $orderB;
    }


    /**
     * @OA\Get(
     *     path="/api/doctor360hospicare",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *
     *     @OA\Parameter(
     *         name="outlet_org_id",
     *         in="query",
     *         description="Outlet Org Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_id",
     *         in="query",
     *         description="Outlet Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get MTP By Position_id!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function doctor360Hospicare()
    {
        $outletOrgId = $this->app->Request()->getParameter("outlet_org_id");
        $outletId = $this->app->Request()->getParameter("outlet_id");
        $date = date('Y-m-d');


        $hospicares = TourplansQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->joinWithOutletOrgData()
            ->filterByOutletOrgDataId($outletOrgId, Criteria::NOT_EQUAL)
            ->filterByTpDate($date, Criteria::GREATER_THAN)
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find()->toArray();

        //        var_dump($hospicares);exit;


        $hospicareName = [];
        foreach ($hospicares as $hospicare) {

            $orgUnit = OrgUnitQuery::create()
                ->filterByOrgunitid($hospicare['OutletOrgData']['OrgUnitId'])
                ->findOne();

            if ($orgUnit->getIsExposed() != null || $orgUnit->getIsExposed() != "0") {
                if ($outletId == $hospicare['OutletOrgData']['OutletId']) {
                    $employee = EmployeeQuery::create()
                        ->filterByPositionId($hospicare['PositionId'])
                        ->findOne();

                    $hospicareaData['division'] = $orgUnit->getUnitName();
                    $hospicareaData['name'] = $employee->getFirstName();
                    $hospicareaData['phone_number'] = $employee->getPhone();
                    $hospicareaData['visiting_date'] = $hospicare['TpDate'];
                    $hospicareName[] = $hospicareaData;
                }
            }
        }
        $this->apiResponse($hospicareName, 200, "Get Territories successfully!");
    }

    /**
     * @OA\Get(
     *     path="/api/mtpDaysDelete",
     *     tags={"FSM API's"},
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
     *         description="Leave Start Date",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="end_date",
     *         in="query",
     *         description="Leave End Date",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="month",
     *         in="query",
     *         description="MTP Month",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Mtp days deleted successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function mtpDaysDelete()
    {
        $startDate = $this->app->Request()->getParameter("start_date");
        $endDate = $this->app->Request()->getParameter("end_date");
        $month = $this->app->Request()->getParameter("month");

        $deleteMtpDays = new MTPManager();
        $deleteMtpDays->leaveMtpDaysDelete($startDate, $endDate, $month);

        $this->apiResponse([], 200, "Mtp days deleted successfully!");
    }

    /**
     * @OA\Get(
     *     path="/api/getSTP",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="position_id",
     *         in="query",
     *         description="Position Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="STP days Created successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getSTP()
    {
        $positionId = $this->app->Request()->getParameter("position_id");

        $stp = StpQuery::create()->filterByPositionId($positionId)->findOne();

        if (empty($stp)) {
            $stp = new Stp();
            $stp->setPositionId($positionId);
            $stp->setCompanyId($this->app->Auth()->getUser()->getCompanyId());
            $stp->setStpStatus('draft');
            $stp->save();
        }

        $stpId = $stp->getStpId();
        $stpWeekArr = [];
        $weekArr = [];
        for ($week = 1; $week <= 4; $week++) {
            for ($day = 1; $day <= 7; $day++) {
                $stpWeek = StpWeekQuery::create()
                    ->filterByStpId($stpId)// Ensure the correct stp_id is used
                    ->filterByWeek($week)
                    ->filterByDay($day)
                    ->findOne();

                if ($stpWeek == null) {
                    $stpWeek = new StpWeek();
                    $stpWeek->setStpId($stpId);
                    $stpWeek->setWeek($week);
                    $stpWeek->setDay($day);
                    $stpWeek->setCompanyId($this->app->Auth()->getUser()->getCompanyId());
                    $stpWeek->save();
                }
                $stpWeekArr['StpWeekId'] = $stpWeek->getStpWeekId();
                $stpWeekArr['StpId'] = $stpWeek->getStpId();
                $stpWeekArr['Week'] = $stpWeek->getWeek();
                $stpWeekArr['Day'] = $stpWeek->getDay();
                $stpWeekArr['BeatId'] = $stpWeek->getBeatId();
                $stpWeekArr['TerritoryId'] = $stpWeek->getTerritoryId();
                if ($stpWeek->getTerritoryId() != null) {
                    $territory = TerritoriesQuery::create()->filterByTerritoryId($stpWeek->getTerritoryId())->findOne();
                    if ($territory != null) {
                        $stpWeekArr['TerritoryName'] = $territory->getTerritoryName();
                    } else {
                        $stpWeekArr['TerritoryName'] = null;
                    }
                } else {
                    $stpWeekArr['TerritoryName'] = null;
                }

                if ($stpWeek->getBeatId() != null) {
                    $beat = BeatsQuery::create()->filterByBeatId($stpWeek->getBeatId())->findOne();
                    if ($beat != null) {
                        $stpWeekArr['BeatName'] = $beat->getBeatName();
                    } else {
                        $stpWeekArr['BeatName'] = null;
                    }
                } else {
                    $stpWeekArr['BeatName'] = null;
                }
                $weekArr[] = $stpWeekArr;
            }
        }
//        var_dump($weekArr);exit;
        $this->apiResponse(["stp" => $stp->toArray(), 'stpWeek' => $weekArr], 200, "Get STP Successfully");
    }


    /**
     * @OA\Post(
     *     path="/api/createSTP",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="stp_id",
     *         in="query",
     *         description="STP Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Create STP Week",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="stp_week",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="week", type="string", example="1"),
     *                     @OA\Property(property="day", type="string", example="1"),
     *                     @OA\Property(property="beat_id", type="string", example="18"),
     *                     @OA\Property(property="territory_id", type="string", example="19")
     *                 )
     *             )
     *         ),
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */


    public function createSTP()
    {
        $weeks = $this->app->Request()->getParameter("stp_week");

        $stpId = $this->app->Request()->getParameter("stp_id");
        $stpWeekArr = [];
        foreach ($weeks as $data) {
            $stpWeek = StpWeekQuery::create()->filterByStpId($stpId)->filterByWeek($data->week)->filterByDay($data->day)->findOne();
            if ($stpWeek != null) {
                $stpWeek->setBeatId($data->beat_id);
                $stpWeek->setTerritoryId($data->territory_id);
                $stpWeek->save();
                $stpWeekArr[] = $stpWeek->toArray();
            }


        }
        $stp = StpQuery::create()->filterByStpId($stpId)->findOne();

        if ($stp != null) {
            $stp->setStpStatus('submitted');
            $stp->setApprovedDate(date("Y-M-d"));
            $stp->save();
        }

        $this->apiResponse(['stp' => $stp->toArray(), 'stp_week' => $stpWeekArr], 200, "STP Created Successfully!");
    }

    /**
     * @OA\GET(
     *     path="/api/approveSTP",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="stp_id",
     *         in="query",
     *         description="mtp_id",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="STP Approved successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function approveSTP()
    {
        $stp_id = $this->app->Request()->getParameter("stp_id", 0);

        if ($stp_id > 0) {
            $stp = StpQuery::create()
                ->filterByStpStatus("approved", Criteria::NOT_EQUAL)
                ->findPk($stp_id);
            if ($stp) {
                $stp->setStpStatus("approved");
                $stp->setStpApprovedBy($this->app->Auth()->getUser()->getEmployeeId());
                $stp->setApprovedDate(date("Y-M-d"));
                $stp->save();
            }
            $this->apiResponse(["status" => "STP Approved", "mtp" => $stp->toArray()], 200, "STP Approved Successfully");
        } else {
            $this->apiResponse(["status" => "STP Status incorrect or not found"], 500, "STP Not Found.");
        }
    }

    /**
     * @OA\Get(
     *     path="/api/rejectStp",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="stp_id",
     *         in="query",
     *         description="STP Id",
     *         @OA\Schema(type="string")
     *     ),
     *
     *          @OA\Parameter(
     *          name="rejected_reason",
     *          in="query",
     *          description="Rejected Reason",
     *          @OA\Schema(type="string")
     *      ),
     *     @OA\Response(
     *         response="200",
     *         description="STP days Created successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function rejectStp()
    {
        $stp_id = $this->app->Request()->getParameter("stp_id");

        $rejectedReason = $this->app->Request()->getParameter("rejected_reason");

        $stp = StpQuery::create()->filterByStpId($stp_id)->findOne();
        if ($stp) {
            $stp->setStpStatus("rejected");
            $stp->setRejectedReason($rejectedReason);
            $stp->setApprovedDate(date("Y-M-d"));
            $stp->save();
        }
        $this->apiResponse(['stp' => $stp], 200, "STP Rejected Successfully!!");
    }

    /**
     * @OA\Get(
     *     path="/api/getStpList",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Status",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="STP days Created successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getStpList()
    {
        $emp = $this->app->Auth()->getUser()->getEmployee();
        $status = $this->app->Request()->getParameter("status");
        $positions = OrgManager::getUnderPositions($emp->getPositionId());


        $stps = StpQuery::create()->filterByStpStatus($status)->filterByPositionId($positions)->find()->toArray();
        $stpArr = [];
        $totalArr = [];
        foreach ($stps as $stp) {
            $employee = EmployeeQuery::create()->joinWithDesignations()->filterByPositionId($stp['PositionId'])->findOne();
            $stpArr['StpId'] = $stp['StpId'];
            $stpArr['name'] = $employee->getFirstName() . ' ' . $employee->getLastName();
            $stpArr['phone'] = $employee->getPhone();
            $stpArr['Date'] = $stp['ApprovedDate'];
            $stpArr['Designation'] = $employee->getDesignations()->getDesignation();
            $totalArr[] = $stpArr;
        }
        $this->apiResponse($totalArr, 200, "STP Fetched Successfully!!");

    }

    /**
     * @OA\GET(
     *     path="/api/getStpById",
     *     tags={"FSM API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="stp_id",
     *         in="query",
     *         description="stp_id",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="STP Approved successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    /*public function getStpById()
    {
        $stpId = $this->app->Request()->getParameter("stp_id");

        // Fetch all data from stp_week with the corresponding beat name
        $stpWeeks = StpWeekQuery::create()
            ->filterByStpId($stpId)
            ->joinWithBeats()// Join with the Beat table
            ->orderByDay() // Order by day to group days together
            ->orderByWeek() // Order by week to ensure weeks are in correct order
            ->find();

// Initialize an array to hold the response
        $response = [];

// Loop through the fetched records
        foreach ($stpWeeks as $stpWeek) {
            $day = $stpWeek->getDay(); // e.g., 'day1', 'day2', etc.
            $week = $stpWeek->getWeek();
            $beatName = $stpWeek->getBeats()->getBeatName();

            // Prepare the week and beat name data
            $weekData = [
                'week' => $week,
                'beat_name' => $beatName
            ];

            // Append the week data to the corresponding day in the response
            if (!isset($response[$day])) {
                $response[$day] = [];
            }


            $response[$day][] = $weekData;
        }
        $this->apiResponse($response, 200, "STP!!");

    }*/

    public function getStpById()
    {
        $stpId = $this->app->Request()->getParameter("stp_id");
        $stpArr = [];
        $totalArr = [];
        for ($day = 1; $day <= 7; $day++) {
            for ($week = 1; $week <= 4; $week++) {

            $stp = StpWeekQuery::create()->joinWithBeats()->filterByDay($day)->filterByWeek($week)->filterByStpId($stpId)->findOne();
            if ($stp!=null){
                $stpArr[$day][] = [
                    'week' => $stp->getWeek(),
                    'beat_name' => $stp->getBeats()->getBeatName(),
                ];
//                $totalArr[] = $stpArr;
            } else {
                $stpArr[$day][] = [
                    'week' => $week,
                    'beat_name' => null,
                ];
//                $totalArr[] = $stpArr;
            }
            }
        }
        $this->apiResponse($stpArr, 200, "STP!!");
    }
}


