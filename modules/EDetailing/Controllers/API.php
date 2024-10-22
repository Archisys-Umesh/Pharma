<?php

declare(strict_types=1);

namespace Modules\EDetailing\Controllers;

use App\System\App;
use entities\Base\TicketTypeQuery;
use entities\BrandsQuery;
use entities\EdStatsQuery;
use entities\MediaFiles;
use App\Utils\ImageUploader;
use BI\manager\OrgManager;
use entities\Base\EmployeeQuery;
use entities\OutletViewQuery;
use entities\Survey;
use entities\SurveySubmited;
use entities\SurveySubmitedAnswer;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 * Description of API
 *
 * @author Plus91Labs-01
 */
class API extends \App\Core\BaseController
{

    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    /**
     * @OA\Get(
     *     path="/api/getHolidayList",
     *     tags={"Holiday API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Holiday List successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getHolidayList()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET" :

                $holidays = \entities\HolidaysQuery::create()
                    ->findByCompanyId($this->app->Auth()->CompanyId());
                $holidaydate = [];
                $stateId = $this->app->Auth()->getUser()->getEmployee()->getBranch()->getIstateid();
//
                foreach ($holidays as $holiday) {
                    $holidayState = $holiday->getIstateid();

                    if ($stateId == $holidayState) {
                        $holidaydate[] = $holiday->toArray();
                    }

                }


                $this->apiResponse($holidaydate, 200, "Get Holidays successfully!");
                break;
        endswitch;
    }

    public function presenting()
    {

    }

    /**
     * @OA\Get(
     *     path="/api/detailingHeatMap",
     *     tags={"E-Detailing API's"},
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
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="end_date",
     *         in="query",
     *         description="End Date",
     *         @OA\Schema(type="string")
     *     ),
     *       @OA\Parameter(
     *         name="classification",
     *         in="query",
     *         description="Classification Id",
     *         @OA\Schema(type="String")
     *     ),
     *      @OA\Parameter(
     *         name="emp_id",
     *         in="query",
     *         description="Employee Id",
     *         @OA\Schema(type="string")
     *     ),
        *  @OA\Parameter(
        *         name="position_id",
        *         in="query",
        *         description="Position Id",
        *         @OA\Schema(type="string")
        *  ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Data successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */

    public function detailingHeatMap()
    {
        $needtoStopApi = isset($_ENV['STOP_REPORT_API']) ? $_ENV['STOP_REPORT_API'] : false;
        if ($needtoStopApi) {
            return $this->apiResponse([], 200, "Data Retrieved Successfully.");
        }
        
        $startDate = $this->app->Request()->getParameter("start_date");
        $endDate = $this->app->Request()->getParameter("end_date");
        $classification = $this->app->Request()->getParameter("classification", "All");
        $emp_id = $this->app->Request()->getParameter("emp_id", null);
        $position_id = $this->app->Request()->getParameter("position_id", null);
        
        if ($emp_id == null) {
            $emp_id = $this->app->Auth()->getUser()->getEmployeeId();
        }

        $employee = EmployeeQuery::create()->findPk(intval($emp_id));
      
        if($position_id != null)
        {
            $employee = \entities\EmployeeQuery::create()
                        ->filterByPositionId($position_id)
                        ->filterByStatus(1)
                        ->findOne();
        }
        
        $outlets = OutletViewQuery::create()->select(['OutletOrgId'])->filterByTerritoryId(OrgManager::getMyTerritories($employee));

        if ($classification != "All") {
            $outlets->filterByOutletClassification($classification);
        }
        $outlets = $outlets->find()->toArray();


        $edStats = EdStatsQuery::create()
            ->select(['BrandId', "SessionId"])
            ->groupByBrandId()
            ->groupBySessionId()
            ->filterByEdDate($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
            ->filterByEdDate($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
            ->withColumn('SUM(duration)', 'totalSec')
            ->withColumn('MIN(ed_order)', 'EOrder')
            ->orderBySessionId()
            ->orderBy("EOrder")
            ->filterByOutletOrgId($outlets)
            ->find()
            ->toArray();

        // ED_ORDER NORMALISATION.
        $sessionId = "";
        $indexEd = 0;
        foreach ($edStats as &$edStat) {
            if ($sessionId != $edStat['SessionId']) {
                $sessionId = $edStat['SessionId'];
                $indexEd = 0;
            }
//            $indexEd = $edStat['EOrder'] + 1;
            $indexEd = $indexEd + 1;
            $edStat['indexEd'] = $indexEd;
        }
       /* var_dump($edStats);
        exit;*/


        $resp = [];

        foreach ($edStats as &$edStat) {
            if ($edStat['indexEd'] > 4) {
                continue;
            }
            else 
            {

                if (!isset($resp[$edStat['BrandId']])) {
                    $resp[$edStat['BrandId']] = [
                        "1" => 0,
                        "1_total" => 0,
                        "2" => 0,
                        "2_total" => 0,
                        "3" => 0,
                        "3_total" => 0,
                        "4" => 0,
                        "4_total" => 0,
                    ];
                }
                if ($edStat['BrandId'] != null) {  
                                        
                    $resp[$edStat['BrandId']][$edStat['indexEd']] += $edStat['totalSec'];
                    $resp[$edStat['BrandId']][$edStat['indexEd'] . "_total"] += 1;
                }
        }

        }


        $resArr = [];
        $totalArray = [];
        foreach ($resp as $key => $res) {
            if ($key == null) {
                continue;
            }
            $brand = BrandsQuery::create()
                ->filterByBrandId($key)
                ->findOne();
            $resArr['brand'] = "";
            if ($brand != null) {
                $resArr['brand'] = $brand->getBrandName();
            }
            $resArr['brand'] = $brand->getBrandName();
            if ($res[1] == 0) {
                $resArr['p1'] = 0.00;
                $resArr['p1_totalSession'] = 0;
            } else {
                $resArr['p1'] = number_format($res['1'] / 60, 2);
                $resArr['p1_totalSession'] = $res['1_total'];
            }

            if ($res[2] == 0) {
                $resArr['p2'] = 0.00;
                $resArr['p2_totalSession'] = 0;
            } else {
                $resArr['p2'] = number_format($res['2'] / 60, 2);
                $resArr['p2_totalSession'] = $res['2_total'];
            }

            if ($res[3] == 0) {
                $resArr['p3'] = 0.00;
                $resArr['p3_totalSession'] = 0;
            } else {
                $resArr['p3'] = number_format($res['3'] / 60, 2);
                $resArr['p3_totalSession'] = $res['3_total'];
            }

            if ($res[4] == 0) {
                $resArr['p4'] = 0.00;
                $resArr['p4_totalSession'] = 0;
            } else {
                $resArr['p4'] = number_format($res['4'] / 60, 2);
                $resArr['p4_totalSession'] = $res['4_total'];
            }


            $totalArray[] = $resArr;


        }

        $this->apiResponse($totalArray, 200, "Data Retrieved Successfully.");


    }

    /**
     * @OA\Get(
     *     path="/api/lastDoctorDetail",
     *     tags={"E-Detailing API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="org_id",
     *         in="query",
     *         description="Doctor Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Data successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */

    public function lastDoctorDetail()
    {
        $orgId = $this->app->Request()->getParameter("org_id");
//        var_dump($this->app->Auth()->getUser()->getEmployeeId());exit;
        $eStats = EdStatsQuery::create()
            ->filterByOutletOrgId(intval($orgId))
            ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())
            ->orderByEdStatsId('desc')
            ->findOne();
//        var_dump($eStats);exit;
        if ($eStats != null) {
            $eStats = $eStats->toArray();
        } else {
            $this->apiResponse([], 200, "No Data");
            return;
        }

        $sessionData = EdStatsQuery::create()
            ->select("BrandId")
            ->filterBySessionId($eStats['SessionId'])
            ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())
            ->groupByBrandId()
            ->find()
            ->toArray();


        $arr = [];
        $rec = [];
        foreach ($sessionData as $ses) {

            $data = EdStatsQuery::create()
                ->filterByOutletOrgId($orgId)
                ->filterByBrandId($ses)
                ->filterBySessionId($eStats['SessionId'])
                ->find()
                ->toArray();

            $sec = 0;

            foreach ($data as $d) {

                $sec += $d['Duration'];
            }

            $brand = BrandsQuery::create()
                ->filterByBrandId($ses)
                ->findOne();

            if ($brand != null) {
                $rec['brand'] = $brand->getBrandName();
            } else {
                $rec['brand'] = "";
            }


            $rec['secs'] = $sec;


            $arr[] = $rec;


        }
        $brandD = [];
        foreach ($sessionData as $dt) {
            $brandData = BrandsQuery::create()
                ->filterByBrandId($dt)
                ->findOne();
            if ($brandData != null) {

                $brandD[] = $brandData->getBrandName();
            }
        }
        $totalArr['data'] = $arr;
        $totalArr['last_visit'] = $eStats['DeviceStartTime'];
        $totalArr['brand'] = implode(',', $brandD);
//        var_dump($totalArr);exit;
        $this->apiResponse($totalArr, 200, "Data Retrieved Successfully.");

    }

    /**
     * @OA\Get(
     *     path="/api/eDetailingBackup",
     *     tags={"E-Detailing API's"},
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
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="end_date",
     *         in="query",
     *         description="End Date",
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="org_id",
     *         in="query",
     *         description="Doctor Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Data successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */

    public function eDetailingBackup()
    {
        $startDate = $this->app->Request()->getParameter("start_date");
        $endDate = $this->app->Request()->getParameter("end_date");
        $orgId = $this->app->Request()->getParameter("org_id");
        $empId = $this->app->Auth()->getUser()->getEmployeeId();


        $edStats = EdStatsQuery::create()
            ->select(['BrandId', "SessionId"])
            ->groupByBrandId()
            ->groupBySessionId()
            ->filterByCreatedAt($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
            ->filterByEmployeeId($empId)
            ->filterByOutletOrgId($orgId)
            ->withColumn('SUM(duration)', 'totalSec')
            ->withColumn('MIN(ed_order)', 'EOrder')
            ->find()
            ->toArray();


        $sessionId = "";
        $indexEd = 0;
        foreach ($edStats as &$edStat) {
            if ($sessionId != $edStat['SessionId']) {
                $indexEd = 0;
            }
            $setIndex = $edStat['EOrder'] + 1;
            $edStat['indexEd'] = $setIndex;
        }


        $resp = [];

        foreach ($edStats as &$edStat) {
            if (!isset($resp[$edStat['BrandId']])) {
                $resp[$edStat['BrandId']] = [
                    "1" => 0,
                    "2" => 0,
                    "3" => 0,
                    "4" => 0,

                ];
            }
            $resp[$edStat['BrandId']][$edStat['indexEd']] += $edStat['totalSec'];
//            $resp[$edStat['BrandId']][$edStat['indexEd'] . "_total"] = +1;

        }


        $totalArray = [];

        foreach ($resp as $key => $res) {
            $brand = BrandsQuery::create()
                ->filterByBrandId($key)
                ->findOne();
            $resArr = [];
            foreach ($res as $kr => $r) {
                $resArr['order'] = $kr;
                $resArr['brand'] = $brand->getBrandName();
                $resArr['total_time_spent'] = $r;
                $totalArray[] = $resArr;
            }

        }
        $this->apiResponse($totalArray, 200, "Data Retrieved Successfully.");


    }


}
