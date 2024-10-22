<?php

declare(strict_types=1);

namespace Modules\System\Processes;

use DateTime;
use Exception;
use entities\Tags;
use entities\Beats;
use entities\Roles;
use entities\Users;
use entities\Branch;
use entities\Brands;
use entities\Leaves;
use entities\GeoCity;
use entities\Outlets;
use entities\Employee;
use entities\GeoState;
use entities\GeoTowns;
use entities\Holidays;
use entities\Products;
use entities\Positions;
use entities\SgpiTrans;
use entities\TagsQuery;
use entities\BeatsQuery;
use entities\Categories;
use entities\GeoCountry;
use entities\OutletType;
use entities\OutletView;
use entities\Pricebooks;
use entities\RolesQuery;
use entities\SgpiMaster;
use entities\Unitmaster;
use entities\UsersQuery;
use entities\BeatOutlets;
use entities\BranchQuery;
use entities\BrandsQuery;
use entities\GeoDistance;
use entities\GradeMaster;
use entities\HrUserDates;
use entities\Territories;
use entities\Citycategory;
use entities\Designations;
use entities\GeoCityQuery;
use entities\OrgUnitQuery;
use entities\OutletsQuery;
use entities\SgpiAccounts;
use BI\manager\SGPIManager;
use entities\BrandCampiagn;
use entities\EmployeeQuery;
use entities\GeoStateQuery;
use entities\GeoTownsQuery;
use entities\HolidaysQuery;
use entities\OutletAddress;
use entities\OutletMapping;
use entities\OutletOrgData;
use entities\ProductsQuery;
use entities\BrandRcpaQuery;
use entities\Classification;
use entities\PositionsQuery;
use entities\Pricebooklines;
use entities\SgpiTransQuery;
use entities\TerritoryTowns;
use entities\AttendanceQuery;
use entities\CurrenciesQuery;
use entities\DailycallsQuery;
use entities\GeoCountryQuery;
use entities\OutletTypeQuery;
use entities\OutletViewQuery;
use entities\PricebooksQuery;
use entities\SgpiMasterQuery;
use entities\UnitmasterQuery;
use entities\BeatOutletsQuery;
use entities\BrandCompetition;
use entities\GeoDistanceQuery;
use entities\GradeMasterQuery;
use entities\HrUserDatesQuery;
use entities\TerritoriesQuery;
use entities\CitycategoryQuery;
use entities\DailycallsSgpiout;
use entities\DesignationsQuery;
use entities\SgpiAccountsQuery;
use entities\BrandCampiagnQuery;
use entities\DataChangeRequests;
use entities\OutletAddressQuery;
use entities\OutletBrandSgpiMap;
use entities\OutletMappingQuery;
use entities\OutletOrgDataQuery;
use BI\manager\DailyCallsManager;
use entities\ClassificationQuery;
use entities\PricebooklinesQuery;
use entities\TerritoryTownsQuery;
use entities\Base\CategoriesQuery;
use entities\BrandCompetitionQuery;
use BI\requests\SGPITransferRequest;
use entities\DailycallsSgpioutQuery;
use entities\OutletBrandSgpiMapQuery;
use entities\SgpiEmployeeBalanceQuery;
use Modules\HR\Controllers\DailyCalls;
use Propel\Runtime\ActiveQuery\Criteria;
use entities\BrandCampiagnClassificationQuery;
use entities\BrandCampiagnDoctorsQuery;
use entities\DayplanQuery;
use entities\ExpensePayments;
use entities\ExpensePaymentsQuery;
use entities\OutletOrgDataKeysQuery;
use entities\SalaryAttendanceBackdateTrackLog;
use entities\SalaryAttendanceBackdateTrackLogQuery;
use entities\TourplansQuery;

class ImportFromContent extends \App\Core\Process
{
    private $company_id, $successFile, $errorFile, $isFileProcessed, $errorMessage, $totalRecords, $successfulRecords, $failedRecords, $collection;
    private $townListArray, $isSetTownList;
    private $OutletlistArray, $isSetOutletList;
    private $OutletViewlistArray, $isSetOutletViewList;
    private $OutletTypelistArray, $isSetOutletTypeList;
    private $OutletOrgDataArray, $isSetOutletOrgDataList;
    private $OutletOrglistArray, $isSetOutletOrgList;
    private $territoryListArray, $isSetTerritoryList;
    private $orgUnitListArray, $isSetOrgUnitList;
    private $positionListArray, $isSetPositionList;
    private $employeeListArray, $isSetEmployeeList;
    private $roleListArray, $isSetRoleList;
    private $branchListArray, $isSetBranchList;
    private $gradeListArray, $isSetGradeList;
    private $designationListArray, $isSetDesignationList;
    private $cityListArray, $isSetCityList;
    public $importLog;
    private $peoductUpdateData;

    public function __construct($company_id)
    {
        $this->successFile = fopen('php://temp', 'r+');
        $this->errorFile = fopen('php://temp', 'r+');
        $this->isFileProcessed = false;
        $this->errorMessage = '';
        $this->totalRecords = 0;
        $this->successfulRecords = 0;
        $this->failedRecords = 0;
        $this->company_id = $company_id;
        $this->collection = new \Propel\Runtime\Collection\ObjectCollection();
        $this->townListArray = [];
        $this->OutletlistArray = [];
        $this->OutletOrglistArray = [];
        $this->territoryListArray = [];
        $this->orgUnitListArray = [];
        $this->positionListArray = [];
        $this->employeeListArray = [];
        $this->roleListArray = [];
        $this->branchListArray = [];
        $this->gradeListArray = [];
        $this->designationListArray = [];
        $this->cityListArray = [];
        $this->OutletViewlistArray = [];
        $this->peoductUpdateData = [];
        $this->isSetTownList = false;
        $this->isSetOutletList = false;
        $this->isSetOutletOrgList = false;
        $this->isSetTerritoryList = false;
        $this->isSetOrgUnitList = false;
        $this->isSetPositionList = false;
        $this->isSetEmployeeList = false;
        $this->isSetRoleList = false;
        $this->isSetBranchList = false;
        $this->isSetGradeList = false;
        $this->isSetDesignationList = false;
        $this->isSetCityList = false;
        $this->isSetOutletViewList = false;
        $this->importLog = null;
    }

    private function addDataToSuccessFile($data)
    {
        $this->successfulRecords++;
        fputcsv($this->successFile, $data);
    }

    private function addDataToErrorFile($data)
    {
        $this->failedRecords++;
        fputcsv($this->errorFile, $data);
    }

    private function returnResponse()
    {
        rewind($this->successFile);
        rewind($this->errorFile);
        $successContent = stream_get_contents($this->successFile);
        $errorContent = stream_get_contents($this->errorFile);

        fclose($this->successFile);
        fclose($this->errorFile);

        return [
            'successContent'    => $successContent,
            'errorContent'      => $errorContent,
            'isFileProcessed'   => $this->isFileProcessed,
            'errorMessage'      => $this->errorMessage,
            'totalRecords'      => ($this->totalRecords - 1),
            'successfulRecords' => ($this->successfulRecords - 1),
            'failedRecords'     => ($this->failedRecords - 1)
        ];
    }

    public function importCSVContent($content, $importFunction, $importLog)
    {  
        $data = str_getcsv($content, "\n");
        $firstRow = true;
        $this->importLog = $importLog;

        if (!empty($importFunction) && method_exists($this, $importFunction)) {
            $this->isFileProcessed = true;

            $importLog->setStartTime(date('Y-m-d H:i:s'));
            $importLog->save();

            foreach ($data as $row) {
                $this->totalRecords++;

                $rowData = str_getcsv($row);
                $this->$importFunction($rowData, $firstRow);

                if ($this->totalRecords % 500 == 0) {
                    echo $this->totalRecords . " Processed...." . PHP_EOL;
                    $importLog->setNoProcessedRecords($this->totalRecords);
                    $importLog->save();
                }
            }

            $importLog->setNoProcessedRecords($this->totalRecords - 1);
            $importLog->setEndTime(date('Y-m-d H:i:s'));
            $importLog->save();

            if ($this->collection->count() > 0) {
                try {
                    $this->collection->save();
                    echo "final saving collection" . PHP_EOL;
                } catch (\Exception $e) {
                    $previous = $e->getPrevious();
                    if (!empty($previous))
                        echo "Failed to collection save : " . $e->getPrevious()->getMessage() . PHP_EOL;
                    else
                        echo "Failed to collection save : " . $e->getMessage() . PHP_EOL;
                }
                $this->collection->clear();
            }

            //check for productMasterData
            if (count($this->peoductUpdateData) > 0) {
                $this->inactivateTheRemaningProducts($this->peoductUpdateData);
            }
            
            if( $importFunction == 'importPrescibertallydata')
            {
                $serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
                $serviceContainer->getConnection()->exec("call do_insert_prescriber_data()");
                $serviceContainer->closeConnections();
            }
        } else {
            $this->errorMessage = "Import method not found!";
        }

        return $this->returnResponse();
    }

    /* Not in use - will remove */
    private function getPositionRecordById($id)
    {
        return PositionsQuery::create()->filterByCompanyId($this->company_id)->filterByPositionId($id)->findOne();
    }

    private function getPositionRecordByCode($code)
    {
        return PositionsQuery::create()->filterByCompanyId($this->company_id)->filterByPositionCode($code)->findOne();
    }

    private function getPositionRecordByCodeFromArray($code)
    {
        return array_search($code, $this->getPositionsArray());
    }

    private function getPositionsArray()
    {
        if (!$this->isSetPositionList) {
            echo "Start to get positions array" . PHP_EOL;
            $positionlist = PositionsQuery::create()
                ->select(["PositionId", "PositionCode"])
                ->filterByCompanyId($this->company_id)
                ->find()->toArray();

            foreach ($positionlist as $position) {
                $this->positionListArray[$position['PositionId']] = $position['PositionCode'];
                unset($position);
            }
            unset($positionlist);
            $this->isSetPositionList = true;
            echo "End to get positions array : " . count($this->positionListArray) . PHP_EOL;
        }

        return $this->positionListArray;
    }

    private function getOrgUnitRecordById($id)
    {
        return OrgUnitQuery::create()->filterByCompanyId($this->company_id)->filterByOrgunitid($id)->findOne();
    }

    private function getOrgUnitRecordByIdFromArray($id)
    {
        $orgUnits = $this->getOrgUnitsArray();
        return isset($orgUnits[$id]) ? $id : null;
    }

    private function getOrgUnitRecordByNameFromArray($name)
    {
        return array_search(strtolower($name), $this->getOrgUnitsArray());
    }
    private function getOrgUnitRecordtrimByNameFromArray($name)
    {   
        return array_search(strtolower($name), $this->getOrgUnitsTArray());
    }

    private function getOrgUnitRecordByOrgCodeFromArray($code)
    {
        return array_search($code, $this->getOrgUnitCodeArray());
    }

    private function getOrgUnitsArray()
    {
        if (!$this->isSetOrgUnitList) {
            echo "Start to get org unit array" . PHP_EOL;
            $orgUnitlist = OrgUnitQuery::create()
                ->select(["Orgunitid", "UnitName"])
                ->filterByCompanyId($this->company_id)
                ->find()->toArray();

            foreach ($orgUnitlist as $orgUnit) {
                $this->orgUnitListArray[$orgUnit['Orgunitid']] = strtolower($orgUnit['UnitName']);
                unset($orgUnit);
            }
            unset($orgUnitlist);
            $this->isSetOrgUnitList = true;
            echo "End to get org unit array : " . count($this->orgUnitListArray) . PHP_EOL;
        }


        return $this->orgUnitListArray;
    }
    private function getOrgUnitsTArray()
    {
        if (!$this->isSetOrgUnitList) {
            echo "Start to get org unit array" . PHP_EOL;
            $orgUnitlist = OrgUnitQuery::create()
                ->select(["Orgunitid", "UnitName"])
                ->filterByCompanyId($this->company_id)
                ->find()->toArray();

            foreach ($orgUnitlist as $orgUnit) {
                $this->orgUnitListArray[$orgUnit['Orgunitid']] = str_replace(' ', '',strtolower(trim($orgUnit['UnitName'])));
                unset($orgUnit);
            }
            unset($orgUnitlist);
            $this->isSetOrgUnitList = true;
            echo "End to get org unit array : " . count($this->orgUnitListArray) . PHP_EOL;
        }


        return $this->orgUnitListArray;
    }

    private function getOrgUnitCodeArray()
    {
        if (!$this->isSetOrgUnitList) {
            echo "Start to get org unit array" . PHP_EOL;
            $orgUnitlist = OrgUnitQuery::create()
                ->select(["Orgunitid", "OrgUnitCode"])
                ->filterByCompanyId($this->company_id)
                ->find()->toArray();

            foreach ($orgUnitlist as $orgUnit) {
                $this->orgUnitListArray[$orgUnit['Orgunitid']] = $orgUnit['OrgUnitCode'];
                unset($orgUnit);
            }
            unset($orgUnitlist);
            $this->isSetOrgUnitList = true;
            echo "End to get org unit array : " . count($this->orgUnitListArray) . PHP_EOL;
        }

        return $this->orgUnitListArray;
    }

    /* Not in use - will remove */
    private function getTerritoryRecordByCode($code)
    {
        return TerritoriesQuery::create()->filterByCompanyId($this->company_id)->filterByTerritoryCode($code)->findOne();
    }

    private function getTerritoryRecordByCodeFromArray($code, $orgUnitId)
    {
        $code = $code . '|' . $orgUnitId;
        return array_search($code, $this->getTerritoriesArray());
    }

    private function getTerritoriesArray()
    {
        if (!$this->isSetTerritoryList) {
            echo "Start to get territories array" . PHP_EOL;
            $getExcludedTerritories = $this->getExculdedTerritories();
            $territorylist = TerritoriesQuery::create()
                ->select(["TerritoryId", "TerritoryCode", "Orgunitid"])
                ->filterByCompanyId($this->company_id)
                ->where('position_id is not null')
                ->find()->toArray();

            foreach ($territorylist as $territory) {
                if (in_array($territory['TerritoryId'], $getExcludedTerritories)) {
                    continue;
                }

                $this->territoryListArray[$territory['TerritoryId']] = $territory['TerritoryCode'] . '|' . $territory['Orgunitid'];
                unset($territory);
            }
            unset($territorylist);
            $this->isSetTerritoryList = true;
            echo "End to get territories array : " . count($this->territoryListArray) . PHP_EOL;
        }

        return $this->territoryListArray;
    }

    private function getExculdedTerritories()
    {
        return [
            5284,
            5287,
            5289,
            5290,
            1133,
            5291,
            5294,
            1157,
            5295,
            1168,
            5298,
            1173,
            5305,
            1189,
            1197,
            5310,
            1205,
            5312,
            1209,
            5313,
            1214,
            5315,
            1219,
            5318,
            1224,
            5321,
            5322,
            1236,
            1240,
            1245,
            5324,
            5327,
            1255,
            5328,
            1260,
            5332,
            5333,
            5334,
            5337,
            5340,
            1276,
            5343,
            5346,
            5347,
            1282,
            5349,
            5350,
            5351,
            5352,
            5353,
            5354,
            5357,
            5358,
            1298,
            5361,
            5363,
            5365,
            1310,
            5366,
            5367,
            5369,
            1320,
            5370,
            5371,
            1328,
            5374,
            1332,
            5377,
            1336,
            5378,
            5379,
            1341,
            5381,
            1347,
            5382,
            1365,
            5385,
            5386,
            1385,
            1400,
            5391,
            5392,
            1408,
            5393,
            5394,
            5395,
            1422,
            5396,
            5397,
            5398,
            1431,
            5399,
            1439,
            5401,
            5402,
            5403,
            5404,
            5405,
            1452,
            5406,
            5409,
            5410,
            5411,
            5412,
            5413,
            1474,
            5416,
            5418,
            5419,
            5420,
            5422,
            5424,
            5425,
            1503,
            5426,
            5427,
            1508,
            5428,
            5429,
            5430,
            5432,
            5433,
            5434,
            5435,
            5436,
            5437,
            5441,
            5442,
            5443,
            5444,
            5445,
            5446,
            5447,
            5448,
            5449,
            5450,
            5452,
            5453,
            5454,
            5458,
            5460,
            5461,
            5462,
            5463,
            5465,
            5466,
            5468,
            5469,
            5470,
            5472,
            5473,
            5475,
            5476,
            5477,
            5481,
            5482,
            5483,
            5484,
            5485,
            5486,
            5487,
            1641,
            5488,
            5490,
            5491,
            5492,
            5493,
            5494,
            5495,
            5497,
            5498,
            5499,
            5500,
            5501,
            5502,
            5503,
            5505,
            5506,
            5507,
            5508,
            5509,
            5510,
            5511,
            5514,
            5515,
            5516,
            5517,
            5519,
            1694,
            5520,
            1703,
            5525,
            5532,
            5541,
            5545,
            5555,
            5558,
            5567,
            5568,
            1788,
            5569,
            5570,
            5572,
            1798,
            5576,
            5577,
            5578,
            5579,
            1820,
            5590,
            5601,
            5602,
            5603,
            5604,
            5606,
            5608,
            5614,
            5617,
            5619,
            5625,
            5626,
            5628,
            5629,
            5631,
            5632,
            5634,
            5636,
            5637,
            5639,
            5648,
            5649,
            5650,
            5651,
            5653,
            5657,
            5659,
            5660,
            5665,
            5667,
            5669,
            5670,
            5671,
            5673,
            2001,
            5674,
            5675,
            5682,
            5696,
            5697,
            5699,
            2068,
            5701,
            5707,
            5711,
            5713,
            5718,
            5719,
            5721,
            2106,
            5726,
            5727,
            5728,
            5729,
            2126,
            2134,
            5737,
            2139,
            5738,
            5740,
            5741,
            5743,
            2146,
            5746,
            2155,
            2160,
            5753,
            2166,
            2167,
            2168,
            2169,
            5755,
            5758,
            5761,
            5762,
            5766,
            5767,
            5768,
            5769,
            5772,
            5776,
            2271,
            5781,
            5782,
            5783,
            5785,
            5787,
            5789,
            5790,
            5791,
            5792,
            5793,
            5794,
            2311,
            2337,
            2342,
            5802,
            5804,
            2360,
            5810,
            5813,
            5818,
            5821,
            5835,
            2445,
            2447,
            2448,
            2449,
            2450,
            2451,
            2452,
            2453,
            2454,
            2455,
            2456,
            2457,
            2458,
            2463,
            2464,
            2465,
            2466,
            2467,
            2468,
            2469,
            2470,
            2471,
            2472,
            2473,
            5843,
            2475,
            2476,
            2479,
            2480,
            2481,
            2482,
            2483,
            2484,
            2485,
            2486,
            2487,
            2488,
            2489,
            2490,
            2491,
            2492,
            2493,
            2494,
            2495,
            2496,
            2497,
            2498,
            2499,
            2500,
            2501,
            2502,
            2503,
            2504,
            2505,
            2506,
            2507,
            2508,
            2509,
            2510,
            2513,
            2516,
            2520,
            2521,
            2523,
            2524,
            2525,
            2527,
            2528,
            2530,
            2533,
            5849,
            5850,
            2539,
            2540,
            2544,
            2545,
            2546,
            2548,
            2550,
            5851,
            2554,
            5854,
            2557,
            2559,
            2561,
            2563,
            2564,
            2567,
            5855,
            2569,
            2571,
            2573,
            2574,
            5858,
            2578,
            5859,
            2581,
            5861,
            5862,
            2585,
            2586,
            2587,
            2588,
            2589,
            5864,
            2593,
            2596,
            2598,
            2599,
            2600,
            2603,
            5865,
            2607,
            2608,
            2612,
            2616,
            2620,
            2624,
            2625,
            2629,
            2632,
            2633,
            2636,
            2637,
            2638,
            5871,
            2641,
            5872,
            5873,
            2644,
            2647,
            2649,
            2650,
            2654,
            2655,
            5874,
            2658,
            5876,
            2662,
            2664,
            2665,
            2667,
            2669,
            2671,
            2674,
            2675,
            2676,
            5878,
            5879,
            2680,
            2681,
            5880,
            5882,
            5883,
            5884,
            2691,
            2692,
            2696,
            2700,
            2704,
            5888,
            5889,
            2709,
            2714,
            2715,
            5892,
            5894,
            5895,
            5896,
            2730,
            2731,
            2732,
            5897,
            2735,
            2736,
            5898,
            5899,
            2739,
            2742,
            2743,
            2744,
            5900,
            2748,
            2750,
            2751,
            2752,
            2754,
            2760,
            2761,
            2762,
            5901,
            5902,
            2768,
            5904,
            2772,
            2773,
            2774,
            5905,
            5907,
            5909,
            2784,
            5910,
            2788,
            2791,
            2792,
            5911,
            5912,
            5916,
            2805,
            2806,
            5918,
            2810,
            2814,
            2817,
            5920,
            2820,
            2821,
            2822,
            5921,
            5922,
            2826,
            2828,
            2831,
            2832,
            2834,
            5926,
            5927,
            5930,
            2845,
            5934,
            2849,
            2853,
            2854,
            2855,
            2856,
            5938,
            5939,
            5940,
            5941,
            5942,
            2867,
            2868,
            5946,
            2872,
            5948,
            2876,
            2878,
            2879,
            5949,
            2884,
            2886,
            5951,
            2890,
            5956,
            2895,
            2897,
            2898,
            2899,
            2901,
            2902,
            2903,
            2904,
            5957,
            5958,
            2907,
            5959,
            5960,
            2910,
            2911,
            2914,
            2915,
            2916,
            2917,
            2921,
            2922,
            2923,
            2924,
            2927,
            2928,
            2931,
            5972,
            2940,
            2943,
            2947,
            2949,
            2950,
            2951,
            2952,
            2956,
            2960,
            5982,
            5983,
            2964,
            2968,
            2969,
            5987,
            2972,
            2974,
            5990,
            2978,
            2983,
            2984,
            2985,
            5991,
            5993,
            5995,
            2993,
            2994,
            5998,
            5999,
            2999,
            3003,
            3005,
            3006,
            3010,
            3013,
            3017,
            3021,
            3022,
            3023,
            6005,
            3026,
            3028,
            6009,
            3033,
            3035,
            3036,
            6011,
            6012,
            6013,
            3047,
            3049,
            3050,
            3055,
            6017,
            3058,
            3062,
            3063,
            3064,
            6019,
            6020,
            6021,
            6022,
            3070,
            6024,
            6028,
            6029,
            3078,
            6035,
            6036,
            3087,
            6037,
            6038,
            6040,
            6041,
            3097,
            6046,
            3102,
            6048,
            3108,
            3109,
            6049,
            3114,
            3117,
            6051,
            6052,
            3123,
            6055,
            3129,
            3130,
            3131,
            6057,
            3136,
            6061,
            3140,
            3146,
            6065,
            3153,
            3154,
            3161,
            6071,
            6072,
            3164,
            3168,
            3171,
            3175,
            3176,
            3180,
            6080,
            3184,
            3189,
            6086,
            6090,
            3199,
            3200,
            6092,
            6099,
            3214,
            3215,
            6100,
            6101,
            3218,
            6107,
            6108,
            3229,
            3230,
            3232,
            6109,
            6112,
            3238,
            3239,
            3242,
            3245,
            3246,
            3247,
            6114,
            6117,
            6121,
            6125,
            6127,
            3271,
            3272,
            3277,
            6131,
            6132,
            3282,
            3285,
            3291,
            3292,
            6143,
            6145,
            6147,
            6149,
            3311,
            3312,
            3316,
            6153,
            3319,
            3322,
            3326,
            6155,
            3332,
            3333,
            3334,
            6157,
            3339,
            3344,
            3349,
            3354,
            3355,
            6166,
            3359,
            6167,
            6168,
            3363,
            3367,
            3368,
            3369,
            6171,
            6172,
            6173,
            3374,
            3376,
            6175,
            3380,
            3381,
            3386,
            3391,
            3392,
            3393,
            3396,
            3400,
            3403,
            3406,
            3410,
            3411,
            3415,
            3418,
            3421,
            6187,
            6188,
            3425,
            3426,
            3427,
            3428,
            6190,
            6195,
            3438,
            6198,
            6202,
            6203,
            3447,
            3453,
            6206,
            6208,
            3459,
            6210,
            6211,
            6216,
            3469,
            3472,
            3477,
            3478,
            3479,
            3485,
            6222,
            6223,
            6224,
            3491,
            3494,
            3495,
            6225,
            6226,
            3500,
            6228,
            6229,
            3506,
            3509,
            3512,
            3513,
            6231,
            6233,
            3518,
            3522,
            6236,
            3526,
            3530,
            3533,
            3534,
            3535,
            3541,
            3546,
            3550,
            3556,
            3560,
            3561,
            6240,
            3568,
            6242,
            3573,
            6243,
            6244,
            3579,
            3580,
            6245,
            6246,
            6249,
            6250,
            6251,
            6252,
            3589,
            3590,
            3591,
            3592,
            3596,
            3599,
            6255,
            6256,
            3604,
            3608,
            3609,
            6257,
            6258,
            6260,
            6261,
            6262,
            3622,
            3623,
            6264,
            3628,
            6266,
            3633,
            3638,
            3639,
            6267,
            6268,
            3645,
            6269,
            6270,
            3651,
            6271,
            3657,
            3658,
            6273,
            6274,
            6275,
            3664,
            3670,
            6277,
            3674,
            3675,
            6278,
            6279,
            6280,
            6282,
            3681,
            6284,
            3685,
            3689,
            3690,
            6287,
            6288,
            6290,
            3705,
            3706,
            6294,
            6295,
            3711,
            3717,
            3718,
            6296,
            6297,
            6299,
            6300,
            3730,
            3731,
            3732,
            6302,
            6303,
            6304,
            3737,
            6305,
            6306,
            6307,
            3742,
            3747,
            3748,
            3753,
            3757,
            3761,
            3766,
            3767,
            3768,
            3775,
            3782,
            3789,
            3790,
            3795,
            3803,
            3804,
            3809,
            3814,
            3819,
            3820,
            3821,
            3827,
            3830,
            3834,
            3835,
            3838,
            3842,
            3847,
            3848,
            3851,
            3856,
            3860,
            3861,
            3874,
            3880,
            3885,
            3886,
            3887,
            3903,
            3904,
            3910,
            3914,
            3915,
            3919,
            3924,
            3925,
            3929,
            3934,
            3938,
            3939,
            3944,
            3948,
            3953,
            3954,
            3960,
            3964,
            3965,
            3971,
            3975,
            3981,
            3985,
            3986,
            3987,
            4002,
            4007,
            4008,
            4013,
            4019,
            4024,
            4025,
            4030,
            4036,
            4041,
            4042,
            4043,
            4060,
            4066,
            4067,
            4082,
            4087,
            4088,
            4093,
            4096,
            4097,
            4098,
            4104,
            4110,
            4115,
            4116,
            4135,
            4136,
            4137,
            4145,
            4146,
            4147,
            4153,
            4158,
            4159,
            4162,
            4166,
            4172,
            4177,
            4183,
            4184,
            4185,
            4190,
            4195,
            4200,
            4205,
            4206,
            4211,
            4216,
            4221,
            4222,
            4223,
            4228,
            4233,
            4239,
            4240,
            4243,
            4246,
            4251,
            4252,
            4256,
            4259,
            4260,
            4267,
            4273,
            4274,
            4275,
            4279,
            4281,
            4286,
            4287,
            4293,
            4302,
            4304,
            4312,
            4326,
            4330,
            4331,
            4339,
            4344,
            4345,
            4348,
            4354,
            4360,
            4361,
            4362,
            4368,
            4374,
            4376,
            4380,
            4385,
            4389,
            4390,
            4395,
            4400,
            4404,
            4409,
            4410,
            4415,
            4420,
            4424,
            4425,
            4426,
            4429,
            4436,
            4437,
            4442,
            4448,
            4453,
            4454,
            4460,
            4465,
            4471,
            4476,
            4479,
            4482,
            4483,
            4486,
            4492,
            4496,
            4498,
            4502,
            4503,
            4504,
            4510,
            4516,
            4521,
            4525,
            4526,
            4528,
            4529,
            4532,
            4534,
            4537,
            4540,
            4541,
            4546,
            4553,
            4558,
            4559,
            4560,
            4566,
            4572,
            4580,
            4581,
            4585,
            4591,
            4592,
            4597,
            4602,
            4603,
            4604,
            4607,
            4612,
            4613,
            4614,
            4619,
            4620,
            4625,
            4630,
            4631,
            4632,
            4638,
            4644,
            4649,
            4650,
            4654,
            4658,
            4659,
            4664,
            4668,
            4669,
            4673,
            4677,
            4678,
            4680,
            4683,
            4686,
            4687,
            4688,
            4691,
            4695,
            4705,
            4713,
            4714,
            4718,
            4722,
            4726,
            4730,
            4731,
            4732,
            4738,
            4742,
            4747,
            4748,
            4753,
            4758,
            4764,
            4765,
            4771,
            4775,
            4779,
            4784,
            4785,
            4786,
            4791,
            4796,
            4797,
            4801,
            4806,
            4810,
            4811,
            4814,
            4820,
            4826,
            4827,
            4831,
            4836,
            4841,
            4845,
            4849,
            4850,
            4856,
            4862,
            4863,
            4879,
            4880,
            4887,
            4892,
            4897,
            4898,
            4903,
            4908,
            4909,
            4915,
            4920,
            4921,
            4924,
            4928,
            4929,
            4934,
            4939,
            4944,
            4945,
            4946,
            4954,
            4958,
            4964,
            4965,
            4969,
            4974,
            4978,
            4982,
            4983,
            4984,
            4988,
            4992,
            4994,
            4995,
            5007,
            5027,
            5028,
            5029,
            5043,
            5044,
            5049,
            5054,
            5055,
            5059,
            5064,
            5065,
            5066,
            5070,
            5074,
            5079,
            5083,
            5084,
            5088,
            5094,
            5095,
            5108,
            5109,
            5121,
            5122,
            5126,
            5128,
            5132,
            5133,
            5137,
            5141,
            5145,
            5146,
            5150,
            5153,
            5157,
            5163,
            5172,
            5175,
            5176,
            5177,
            5181,
            5188,
            5192,
            5200,
            5203,
            5204,
            5208,
            5216,
            5217,
            5222,
            5227,
            5231,
            5235,
            5236,
            5237,
            5240,
            5244,
            5246,
            5247,
            5252,
            5257,
            5258,
            5263,
            5267,
            5271,
            5272,
            5277,
            5281,
            5282,
            5283,
            1119,
            1151,
            1288,
            1414,
            1957,
            2073,
            2085,
            2193,
            2331,
            2440,
            2460,
            2477,
            2683,
            2721,
            2777,
            2796,
            2839,
            2861,
            2934,
            2989,
            3040,
            3067,
            3073,
            3203,
            3221,
            3253,
            3297,
            3442,
            3455,
            3464,
            3587,
            3695,
            3734,
            3867,
            3993,
            4049,
            4072,
            4121,
            4140,
            4224,
            4308,
            4446,
            4549,
            4710,
            4883,
            4950,
            5001,
            5012,
            5034,
            5099,
            5113,
            1124,
            1156,
            1186,
            1292,
            1421,
            1950,
            2170,
            2441,
            2459,
            2478,
            2685,
            2726,
            2779,
            2799,
            2844,
            2864,
            2937,
            2990,
            3044,
            3069,
            3081,
            3092,
            3193,
            3206,
            3226,
            3259,
            3302,
            3429,
            3436,
            3458,
            3467,
            3700,
            3736,
            3780,
            3800,
            3873,
            3897,
            3998,
            4055,
            4077,
            4126,
            4143,
            4171,
            4226,
            4298,
            4303,
            4311,
            4318,
            4700,
            4868,
            4884,
            5006,
            5017,
            5039,
            5103,
            5117,
            5162,
            5183,
            5196,
            1128,
            1297,
            2179,
            2462,
            2688,
            2942,
            2991,
            3198,
            3209,
            3264,
            3305,
            3431,
            4130,
            4227,
            4314,
            4873,
            4886,
            5022,
            5107,
            5187,
            4317,
            4878
        ];
    }

    /* Using in geo distance and city categories - will remove once done with changes */
    private function getTownRecordByCode($code)
    {
        return GeoTownsQuery::create()->filterBySstatus(1)->findOneByStowncode($code);
    }

    private function getTownRecordByCodeFromArray($code)
    {
        return array_search($code, $this->getTownsArray());
    }

    private function getTownRecordByIdFromArray($id)
    {
        $towns = $this->getTownsArray();
        return isset($towns[$id]) ? $id : null;
    }

    private function getTownsArray()
    {
        if (!$this->isSetTownList) {
            echo "Start to get town array" . PHP_EOL;
            $townlist = GeoTownsQuery::create()
                ->select(["Itownid", "Stowncode"])
                ->filterBySstatus(1)
                ->find()->toArray();

            foreach ($townlist as $town) {
                $this->townListArray[$town['Itownid']] = $town['Stowncode'];
                unset($town);
            }
            unset($townlist);
            $this->isSetTownList = true;
            echo "End to get town array : " . count($this->townListArray) . PHP_EOL;
        }

        return $this->townListArray;
    }

    public function getOutletRecordByCodeFromArray($code)
    {
        $outletsArr = $this->getOutletsArray();
        $record_id = array_key_exists($code, $outletsArr) ? $outletsArr[$code] : '';

        if (!empty($record_id)) {
            return $record_id;
        } else {
            $outletRecord = OutletsQuery::create()
                ->filterByOutletCode($code)
                ->filterByCompanyId($this->company_id)
                ->findOne();

            if (!empty($outletRecord)) {
                return $outletRecord->getPrimaryKey();
            }
        }

        return null;
    }

    public function getOutletOrgRecordByCodeFromArray($code)
    {
        return array_search($code, $this->getOutletOrgsArray());
    }

    private function getOutletOrgsArray()
    {
        if (!$this->isSetOutletOrgList) {
            echo "Start to get outlet array" . PHP_EOL;
            $Outletlist = OutletsQuery::create()
                ->select(["Id", "OutletCode"])
                ->filterByCompanyId($this->company_id)
                ->filterByOutletStatus(['active', 'Active'])
                ->find()->toArray();

            foreach ($Outletlist as $outs) {
                $this->OutletOrglistArray[$outs['Id']] = $outs['OutletCode'];
                unset($outs);
            }
            unset($Outletlist);
            $this->isSetOutletOrgList = true;
            echo "End to get outlet array : " . count($this->OutletOrglistArray) . PHP_EOL;
        }
        return $this->OutletOrglistArray;
    }

    private function getOutletsArray()
    {
        if (!$this->isSetOutletList) {
            echo "Start to get outlet array" . PHP_EOL;
            $Outletlist = OutletOrgDataQuery::create()
                ->select(["OutletId", "OutletOrgCode"])
                ->filterByCompanyId($this->company_id)
                ->find()->toArray();

            foreach ($Outletlist as $outs) {
                $this->OutletlistArray[$outs['OutletOrgCode']] = $outs['OutletId'];
                unset($outs);
            }
            unset($Outletlist);
            $this->isSetOutletList = true;
            echo "End to get outlet array : " . count($this->OutletlistArray) . PHP_EOL;
        }


        return $this->OutletlistArray;
    }

    private function getOutletOrgDataRecordByCodeFromArray($code)
    {
        $OutletOrgId = array_search($code, $this->getOutletViewArray());
        if (empty($OutletOrgId)) {
            $OutletOrgId = array_search($code, $this->getOutletOrgDataArray());
        }

        return $OutletOrgId;
    }

    private function getOutletViewArray()
    {
        if (!$this->isSetOutletViewList) {
            echo "Start to get outlet view array" . PHP_EOL;
            $Outletlist = OutletViewQuery::create()
                ->select(["OutletOrgId", "OutletCode"])
                ->filterByCompanyId($this->company_id)
                ->filterByOutletStatus('active')
                ->find()->toArray();

            foreach ($Outletlist as $outs) {
                $this->OutletViewlistArray[$outs['OutletOrgId']] = $outs['OutletCode'];
                unset($outs);
            }
            unset($Outletlist);
            $this->isSetOutletViewList = true;
            echo "End to get outlet view array : " . count($this->OutletViewlistArray) . PHP_EOL;
        }


        return $this->OutletViewlistArray;
    }

    private function getOutletOrgDataArray()
    {
        if (!$this->isSetOutletOrgDataList) {
            echo "Start to get outlet org data array" . PHP_EOL;
            $Outletlist = OutletOrgDataQuery::create()
                ->select(["OutletOrgId", "OutletOrgCode"])
                ->filterByCompanyId($this->company_id)
                ->find()->toArray();

            foreach ($Outletlist as $outs) {
                $this->OutletOrgDataArray[$outs['OutletOrgId']] = $outs['OutletOrgCode'];
                unset($outs);
            }
            unset($Outletlist);
            $this->isSetOutletOrgDataList = true;
            echo "End to get outlet org data array : " . count($this->OutletOrgDataArray) . PHP_EOL;
        }


        return $this->OutletOrgDataArray;
    }

    private function getOutletTypeRecordByNameFromArray($name)
    {
        return array_search($name, $this->getOutletTypesArray());
    }

    private function getOutletTypesArray()
    {
        if (!$this->isSetOutletTypeList) {
            echo "Start to get outlet types array" . PHP_EOL;

            $outletTypes = OutletTypeQuery::create()
                ->select(["OutlettypeId", "OutlettypeName"])
                ->find()->toArray();

            foreach ($outletTypes as $type) {
                $this->OutletTypelistArray[$type['OutlettypeId']] = $type['OutlettypeName'];
                unset($type);
            }

            unset($outletTypes);
            $this->isSetOutletTypeList = true;
            echo "End to get outlet types array : " . count($this->OutletTypelistArray) . PHP_EOL;
        }

        return $this->OutletTypelistArray;
    }

    private function getEmployeeRecordByCodeFromArray($code)
    {
        return array_search($code, $this->getEmployeesArray());
    }

    private function getEmployeesArray()
    {
        if (!$this->isSetEmployeeList) {
            echo "Start to get employee array" . PHP_EOL;
            $employeeList = EmployeeQuery::create()
                ->select(["EmployeeId", "EmployeeCode"])
                ->filterByCompanyId($this->company_id)
                ->find()->toArray();

            foreach ($employeeList as $employee) {
                $this->employeeListArray[$employee['EmployeeId']] = $employee['EmployeeCode'];
                unset($employee);
            }

            unset($employeeList);
            $this->isSetEmployeeList = true;
            echo "End to get employee array : " . count($this->employeeListArray) . PHP_EOL;
        }

        return $this->employeeListArray;
    }

    private function getRoleRecordByCodeFromArray($name)
    {
        return array_search($name, $this->getRolesArray());
    }

    private function getRolesArray()
    {
        if (!$this->isSetRoleList) {
            echo "Start to get roles array" . PHP_EOL;

            $roleList = RolesQuery::create()
                ->select(["RoleId", "RoleName"])
                ->find()->toArray();

            foreach ($roleList as $role) {
                $this->roleListArray[$role['RoleId']] = $role['RoleName'];
                unset($role);
            }

            unset($roleList);
            $this->isSetRoleList = true;
            echo "End to get roles array : " . count($this->roleListArray) . PHP_EOL;
        }

        return $this->roleListArray;
    }

    private function getBranchRecordByCodeFromArray($code)
    {
        return array_search($code, $this->getBranchesArray());
    }

    private function getBranchesArray()
    {
        if (!$this->isSetBranchList) {
            echo "Start to get branches array" . PHP_EOL;
            $branchList = BranchQuery::create()
                ->select(["BranchId", "Branchcode"])
                ->filterByCompanyId($this->company_id)
                ->find()->toArray();

            foreach ($branchList as $branch) {
                $this->branchListArray[$branch['BranchId']] = $branch['Branchcode'];
                unset($branch);
            }

            unset($branchList);
            $this->isSetBranchList = true;
            echo "End to get branches array : " . count($this->branchListArray) . PHP_EOL;
        }

        return $this->branchListArray;
    }

    private function getGradeRecordByCodeFromArray($name)
    {
        return array_search($name, $this->getGradesArray());
    }

    private function getGradesArray()
    {
        if (!$this->isSetGradeList) {
            echo "Start to get grades array" . PHP_EOL;
            $gradeList = GradeMasterQuery::create()
                ->select(["Gradeid", "GradeName"])
                ->filterByCompanyId($this->company_id)
                ->find()->toArray();

            foreach ($gradeList as $grade) {
                $this->gradeListArray[$grade['Gradeid']] = $grade['GradeName'];
                unset($grade);
            }

            unset($gradeList);
            $this->isSetGradeList = true;
            echo "End to get grades array : " . count($this->gradeListArray) . PHP_EOL;
        }

        return $this->gradeListArray;
    }

    private function getDesignationRecordByCodeFromArray($name)
    {
        return array_search($name, $this->getDesignationsArray());
    }

    private function getDesignationsArray()
    {
        if (!$this->isSetDesignationList) {
            echo "Start to get designation array" . PHP_EOL;
            $designationList = DesignationsQuery::create()
                ->select(["DesignationId", "Designation"])
                ->filterByCompanyId($this->company_id)
                ->find()->toArray();

            foreach ($designationList as $designation) {
                $this->designationListArray[$designation['DesignationId']] = $designation['Designation'];
                unset($designation);
            }

            unset($designationList);
            $this->isSetDesignationList = true;
            echo "End to get designations array : " . count($this->designationListArray) . PHP_EOL;
        }

        return $this->designationListArray;
    }

    /* Not in use - will remove */
    private function getBeatRecordByCode($code)
    {
        return BeatsQuery::create()->filterByCompanyId($this->company_id)->filterByBeatCode($code)->findOne();
    }

    /* Not in use - will remove */
    private function getOutletOrgRecordById($id)
    {
        return OutletOrgDataQuery::create()->filterByCompanyId($this->company_id)->filterByOutletOrgId($id)->findOne();
    }

    private function getCurrencyRecordByCode($code)
    {
        return CurrenciesQuery::create()->findOneByShortcode($code);
    }

    private function getCountryRecordByCode($code)
    {
        return GeoCountryQuery::create()->findOneByCode($code);
    }

    private function getStateRecordByCode($code)
    {
        return GeoStateQuery::create()->findOneBySstatecode($code);
    }

    private function getCityRecordByCode($code)
    {
        return GeoCityQuery::create()->findOneByScitycode($code);
    }

    private function getBrandRecordByCode($code, $orgUnitId)
    {
        return BrandsQuery::create()->filterByCompanyId($this->company_id)->filterByBrandCode($code)->filterByOrgunitid($orgUnitId)->findOne();
    }

    private function getTownByCityRecordByCode($townCode, $cityCode)
    {
        $code = $townCode . '|' . $cityCode;
        return array_search($code, $this->getTownsByCityArray());
    }

    private function getTownsByCityArray()
    {
        if (!$this->isSetTownList) {
            echo "Start to get town array" . PHP_EOL;
            $townlist = GeoTownsQuery::create()
                ->select(["Itownid", "Stowncode", "Icityid"])
                ->find()->toArray();

            foreach ($townlist as $town) {
                $this->townListArray[$town['Itownid']] = $town['Stowncode'] . '|' . $town['Icityid'];
                unset($town);
            }
            unset($townlist);
            $this->isSetTownList = true;
            echo "End to get town array : " . count($this->townListArray) . PHP_EOL;
        }

        return $this->townListArray;
    }

    private function getCityRecordByCodeFromArray($code)
    {
        return array_search($code, $this->getCitiesArray());
    }

    private function getCitiesArray()
    {
        if (!$this->isSetCityList) {
            echo "Start to get cities array" . PHP_EOL;
            $citylist = GeoCityQuery::create()
                ->select(["icityid", "Scitycode"])
                ->find()->toArray();

            foreach ($citylist as $city) {
                $this->cityListArray[$city['icityid']] = $city['Scitycode'];
                unset($city);
            }
            unset($citylist);
            $this->isSetCityList = true;
            echo "End to get cities array : " . count($this->cityListArray) . PHP_EOL;
        }

        return $this->cityListArray;
    }

    private function getConfig($module,$key) {
        $config = [];
        $file = __DIR__.'/../../'.$module.'/Config.php';
        if(file_exists($file)) {
            $config = include($file);
            $config = isset($config[$key]) ? $config[$key] : [];
        }
        return $config;
    }

    private function validateDate($date, $format = 'd-m-Y')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    /* Not in use - will remove */
    private function getSecondaryOutletCodes($rowData, $startIndex)
    {
        $outletCodes = [];
        for ($i = $startIndex; $i < count($rowData); $i++) {
            if (!empty($rowData[$i])) {
                $outletCodes[] = $rowData[$i];
            }
        }

        return $outletCodes;
    }

    public function addFirstRowLog($rowData, $name, $second = '')
    {
        $rowData[] = 'Plus91Labs ' . $name . ' ID';

        if (!empty($second)) {
            $rowData[] = $second;
        }
        $this->addDataToSuccessFile($rowData);

        $rowData[] = "Error Message";
        $this->addDataToErrorFile($rowData);

        $firstRow = false;
        return true;
    }

    private function importBranches($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Branch');
            $firstRow = false;
            return true;
        }

        try {
            // Get Data
            $branchCode = $rowData[0];
            $branchName = $rowData[1];
            $branchStatus = $rowData[2];
            $brancIstateid = $rowData[3];

            // check if category name exists or not
            $record = BranchQuery::create()
                ->filterByBranchname($branchName)
                ->filterByCompanyId($this->company_id)
                ->findOne();

            if (!empty($record)) {
                $record_id = $record->getPrimaryKey();

                $rowData[] = $record_id;
                $rowData[] = "Branch already exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $record = new Branch();
            $record->setBranchname($branchName);
            $record->setCompanyId($this->company_id);
            $record->setStatus($branchStatus);
            $record->setBranchcode($branchCode);
            $record->save();

            $record_id = $record->getPrimaryKey();

            $rowData[] = $record_id;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }

        return true;
    }

    private function importPositions($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Position');
            $firstRow = false;
            return true;
        }

        try {
            // Get Data
            $positionId = $rowData[0];
            $positionName = $rowData[1];
            $positionCode = $rowData[2];
            $reportingTo = $rowData[3];
            $orgUnitId = $rowData[4];
            $mtpType = !empty($rowData[5]) ? $rowData[5] : '';
            $reportingToID = 0;
            $mtpTypes = $this->getConfig("FSM", "MtpType");

            // check if reporting to position id exists or not
            if (!empty($reportingTo)) {
                $record = $this->getPositionRecordByCode($reportingTo);
                if (empty($record)) {
                    $rowData[] = 0;
                    $rowData[] = "Report to position not exsists!";
                    $this->addDataToErrorFile($rowData);

                    return true;
                }

                $reportingToID = $record->getPrimaryKey();
            }

            // check if org unit id exists or not
            // $record = $this->getOrgUnitRecordById($orgUnitId);
            // if(empty($record))
            // {
            //     $rowData[] = 0;
            //     $rowData[] = "Org unit not exsists!";
            //     $this->addDataToErrorFile($rowData);

            //     return true;
            // }

            // check if org unit id exists or not
            $orgUnitId = $this->getOrgUnitRecordByIdFromArray($orgUnitId);
            if (empty($orgUnitId)) {
                $rowData[] = 0;
                $rowData[] = "Org unit not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!empty($mtpType) && !isset($mtpTypes[$mtpType])) {
                $rowData[] = 0;
                $rowData[] = "MTP type should be : " . implode(', ', array_keys($mtpTypes)) . " !";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if position name exists or not
            $record = PositionsQuery::create()
                ->filterByPositionCode($positionCode)
                ->filterByCompanyId($this->company_id)
                // ->filterByOrgUnitId($orgUnitId)
                ->findOne();

            if (!empty($record)) {
                if ($record->getOrgUnitId() != $orgUnitId) {
                    $rowData[] = $record->getPrimaryKey();
                    $rowData[] = "Position code already exists!";
                    $this->addDataToErrorFile($rowData);
                    return true;
                }
                // $record_id = $record->getPrimaryKey();

                // $rowData[] = $record_id;
                $rowData[] = "Record updated!";
                // $this->addDataToErrorFile($rowData);

                // return true;
            } else {
                $record = new Positions();
                $record->setCompanyId($this->company_id);
                // $record->setPositionId($positionId);
                $record->setPositionCode($positionCode);
                $record->setOrgUnitId($orgUnitId);

                $rowData[] = "Record created!";
            }

            $record->setPositionName($positionName);
            $record->setReportingTo($reportingToID);

            if(!empty($mtpType)) {
                $record->setMtpType($mtpType);
            }

            $record->save();

            $record_id = $record->getPrimaryKey();

            $rowData[] = $record_id;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }

        return true;
    }

    private function importTerritories($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Territory');
            $firstRow = false;
            return true;
        }

        try {
            // Get Data
            $territoryCode = $rowData[0];
            $territoryName = $rowData[1];
            $orgUnitId = $rowData[2];
            $positionCode = $rowData[3];

            // check if position code exists or not
            $position = $this->getPositionRecordByCode($positionCode);
            if (empty($position)) {
                $rowData[] = 0;
                $rowData[] = "Position not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if territory name exists or not
            $record = TerritoriesQuery::create()
                ->filterByTerritoryCode($territoryCode)
                ->filterByPositionId($position->getPrimaryKey())
                ->filterByOrgunitid($orgUnitId)
                ->filterByCompanyId($this->company_id)
                ->findOne();

            if (!empty($record)) {
                $record_id = $record->getPrimaryKey();

                $rowData[] = $record_id;
                $rowData[] = "Territory already exsists";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $record = new Territories();
            $record->setTerritoryName($territoryName);
            $record->setCompanyId($this->company_id);
            $record->setTerritoryCode($territoryCode);
            $record->setOrgUnitId($orgUnitId);
            $record->setPositionId($position->getPrimaryKey());
            $record->save();

            $record_id = $record->getPrimaryKey();

            $rowData[] = $record_id;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }

        return true;
    }

    private function importTerritoryTowns($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Territory Town');
            $firstRow = false;
            return true;
        }

        try {
            // Get Data
            $territoryCode = $rowData[0];
            $townCode = $rowData[1];
            $orgUnitId = $rowData[2];
            $mrTripType = strtolower($rowData[3]);
            $otherTripType = strtolower($rowData[4]);

            $tripTypesArr = ["HQ" => "hq", "Ex-HQ" => "ex-hq", "OS" => "os"];

            if (!empty($mrTripType) && !in_array($mrTripType, $tripTypesArr)) {
                $rowData[] = 0;
                $rowData[] = "MR Trip type should be HQ / Ex-HQ / OS!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!empty($otherTripType) && !in_array($otherTripType, $tripTypesArr)) {
                $rowData[] = 0;
                $rowData[] = "Other Trip type should be HQ / Ex-HQ / OS!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if territory code exists or not
            // $territory = $this->getTerritoryRecordByCode($territoryCode);
            $territory = $this->getTerritoryRecordByCodeFromArray($territoryCode, $orgUnitId);
            if (empty($territory)) {
                $rowData[] = 0;
                $rowData[] = "Territory not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            } else {
                $territoryId = $territory;
            }

            // check if town code exists or not
            // $town = $this->getTownRecordByCode($townCode);
            $town = $this->getTownRecordByCodeFromArray($townCode);
            if (empty($town)) {
                $rowData[] = 0;
                $rowData[] = "Town not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            } else {
                $townId = $town;
            }

            // check if territory town record exists or not
            $record = TerritoryTownsQuery::create()
                ->filterByTerritoryId($territoryId)
                ->filterByItownid($townId)
                ->filterByCompanyId($this->company_id)
                ->findOne();

            if (empty($record)) {
                $record = new TerritoryTowns();
                $record->setCompanyId($this->company_id);
                $record->setTerritoryId($territoryId);
                $record->setItownid($townId);
            }

            if (!empty($mrTripType)) {
                $record->setAssignToTripType(array_search($mrTripType, $tripTypesArr));
            }

            if (!empty($otherTripType)) {
                $record->setOthersTripType(array_search($otherTripType, $tripTypesArr));
            }
            $record->save();

            $record_id = $record->getPrimaryKey();

            $rowData[] = $record_id;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }

        return true;
    }

    private function importBrands($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Brand');
            $firstRow = false;
            return true;
        }

        try {
            // Get Data
            $brandName = $rowData[0];
            $orgUnitId = $rowData[1];
            $brandCode = $rowData[2];
            $brandRate = $rowData[3];
            $minValue = $rowData[4];

            // check if org unit id exists or not
            $record = $this->getOrgUnitRecordById($orgUnitId);
            if (empty($record)) {
                $rowData[] = 0;
                $rowData[] = "Org unit not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if position name exists or not
            $record = BrandsQuery::create()
                ->filterByBrandCode($brandCode)
                ->filterByOrgunitid($orgUnitId)
                ->filterByCompanyId($this->company_id)
                ->findOne();

            // if(!empty($record))
            // {
            //     $record_id = $record->getPrimaryKey();

            //     $record->setBrandRate($brandRate);
            //     $record->save();

            //     $rowData[] = $record_id;
            //     $this->addDataToSuccessFile($rowData);

            //     $rowData[] = $record_id;
            //     $rowData[] = "Brand already exsists";
            //     $this->addDataToErrorFile($rowData);

            //     return true;
            // }

            if (empty($record)) {
                $record = new Brands();
                $record->setBrandCode($brandCode);
                $record->setCompanyId($this->company_id);
                $record->setOrgunitid($orgUnitId);
            } else {
                $rowData[] = "Record updated!";
            }

            // $record = new Brands();
            $record->setBrandName($brandName);
            // $record->setBrandCode($brandCode);
            // $record->setCompanyId($this->company_id);
            // $record->setOrgunitid($orgUnitId);
            if (!empty($brandRate)) {
                $record->setBrandRate($brandRate);
            }

            if (!empty($minValue)) {
                $record->setMinValue($minValue);
            }
            $record->save();

            $record_id = $record->getPrimaryKey();

            $rowData[] = $record_id;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }

        return true;
    }

    private function importBeats($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Patch');
            $firstRow = false;
            return true;
        }

        try {
            // Get Data
            $beatName = $rowData[0];
            $beatRemark = $rowData[1];
            $beatCode = $rowData[2];
            $territoryCode = $rowData[3];
            $townCode = $rowData[4];
            $townId = $rowData[5];
            $orgUnitId = $rowData[6];

            // check if territory code exists or not
            // $territory = $this->getTerritoryRecordByCode($territoryCode);
            $territory = TerritoriesQuery::create()
                ->filterByCompanyId($this->company_id)
                ->filterByTerritoryCode($territoryCode)
                ->filterByOrgunitid($orgUnitId)
                ->filterByPositionId(null, Criteria::NOT_EQUAL)
                ->findOne();
            if (empty($territory)) {
                $rowData[] = 0;
                $rowData[] = "Territory not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if town code exists or not
            if (!empty($townId)) {
                $town = $this->getTownRecordByIdFromArray($townId);
            } else {
                $town = $this->getTownRecordByCodeFromArray($townCode);
            }

            if (empty($town)) {
                $rowData[] = 0;
                $rowData[] = "Town not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if org unit id exists or not
            $record = $this->getOrgUnitRecordById($orgUnitId);
            if (empty($record)) {
                $rowData[] = 0;
                $rowData[] = "Org unit not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if position name exists or not
            $record = BeatsQuery::create()
                ->filterByBeatCode($beatCode)
                ->filterByTerritoryId($territory->getPrimaryKey())
                ->filterByOrgUnitId($orgUnitId)
                ->filterByCompanyId($this->company_id)
                ->findOne();

            if (!empty($record)) {
                $record_id = $record->getPrimaryKey();

                $rowData[] = $record_id;
                $rowData[] = "Patch already exsists";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $record = new Beats();
            $record->setBeatName($beatName);
            $record->setBeatRemark($beatRemark);
            $record->setBeatCode($beatCode);
            $record->setTerritoryId($territory->getPrimaryKey());
            $record->setCompanyId($this->company_id);
            $record->setItownid($town);
            $record->setOrgunitid($orgUnitId);
            $record->save();

            $record_id = $record->getPrimaryKey();

            $rowData[] = $record_id;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }

        return true;
    }

    private function importBeatMapping($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Patch');
            $firstRow = false;
            return true;
        }

        try {
            // Get Data
            $beatCode = $rowData[0];
            $outletOrgCode = $rowData[1];

            // check if beat code exists or not
            $beat = $this->getBeatRecordByCode($beatCode);
            if (empty($beat)) {
                $rowData[] = 0;
                $rowData[] = "Beat not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if outlet org record exists or not
            $outletOrg = $this->getOutletOrgRecordById($outletOrgCode);
            if (empty($outletOrg)) {
                $rowData[] = 0;
                $rowData[] = "Outlet Org record not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if beat outlet record exists or not
            $record = BeatOutletsQuery::create()
                ->filterByBeatId($beat->getPrimaryKey())
                ->filterByBeatOrgOutlet($outletOrg->getPrimaryKey())
                ->filterByCompanyId($this->company_id)
                ->findOne();

            if (!empty($record)) {
                $record_id = $record->getPrimaryKey();

                $rowData[] = $record_id;
                $rowData[] = "Record already exsists";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $record = new BeatOutlets();
            $record->setBeatId($beat->getPrimaryKey());
            $record->setBeatOrgOutlet($outletOrg->getPrimaryKey());
            $record->setCompanyId($this->company_id);
            $record->save();

            $record_id = $record->getPrimaryKey();

            $rowData[] = $record_id;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }

        return true;
    }

    private function importGeos($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Geo');
            $firstRow = false;
            return true;
        }

        $type = $rowData[0];

        switch ($type) {
            case 'Country':
                $this->importCountry($rowData, $firstRow, true);
                break;

            case 'State':
                $this->importState($rowData, $firstRow, true);
                break;

            case 'Region':
                $this->importCity($rowData, $firstRow, true);
                break;

            case 'Town':
                $this->importTown($rowData, $firstRow, true);
                break;

            default:
                break;
        }

        return true;
    }

    private function importCountry($rowData, &$firstRow, $fromGeo = false)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Country');
            $firstRow = false;
            return true;
        }

        try {
            // Get Data
            if ($fromGeo) {
                $countryName = $rowData[1];
                $countryCode = $rowData[2];
                $currencyCode = $rowData[3];
            } else {
                $countryName = $rowData[0];
                $countryCode = $rowData[1];
                $currencyCode = $rowData[2];
            }

            // check if currency exists or not
            $currency = $this->getCurrencyRecordByCode($currencyCode);
            if (empty($currency)) {
                $rowData[] = 0;
                $rowData[] = "Currency not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if beat outlet record exists or not
            $record = GeoCountryQuery::create()
                ->filterByCode($countryCode)
                ->findOne();

            if (!empty($record)) {
                $record_id = $record->getPrimaryKey();

                $rowData[] = $record_id;
                $rowData[] = "Record already exsists";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $record = new GeoCountry();
            $record->setScountry($countryName);
            $record->setScurrency($currency->getPrimaryKey());
            $record->setCode($countryCode);
            $record->save();

            $record_id = $record->getPrimaryKey();

            $rowData[] = $record_id;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }

        return true;
    }

    private function importState($rowData, &$firstRow, $fromGeo = false)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'State');
            $firstRow = false;
            return true;
        }

        try {
            // Get Data
            if ($fromGeo) {
                $stateName = $rowData[1];
                $stateCode = $rowData[2];
                $countryCode = $rowData[3];
            } else {
                $stateName = $rowData[0];
                $stateCode = $rowData[1];
                $countryCode = $rowData[2];
            }

            // check if currency exists or not
            $country = $this->getCountryRecordByCode($countryCode);
            if (empty($country)) {
                $rowData[] = 0;
                $rowData[] = "Country not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if beat outlet record exists or not
            $record = GeoStateQuery::create()
                ->filterBySstatecode($stateCode)
                ->findOne();

            if (!empty($record)) {
                $record_id = $record->getPrimaryKey();

                $rowData[] = $record_id;
                $rowData[] = "Record already exsists";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $record = new GeoState();
            $record->setSstatename($stateName);
            $record->setCountryId($country->getPrimaryKey());
            $record->setSstatecode($stateCode);
            $record->save();

            $record_id = $record->getPrimaryKey();

            $rowData[] = $record_id;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }

        return true;
    }

    private function importCity($rowData, &$firstRow, $fromGeo = false)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'City');
            $firstRow = false;
            return true;
        }

        try {
            // Get Data
            if ($fromGeo) {
                $cityName = $rowData[1];
                $cityCode = $rowData[2];
                $stateCode = $rowData[3];
            } else {
                $cityName = $rowData[0];
                $cityCode = $rowData[1];
                $stateCode = $rowData[2];
            }

            // check if currency exists or not
            $state = $this->getStateRecordByCode($stateCode);
            if (empty($state)) {
                $rowData[] = 0;
                $rowData[] = "State not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if beat outlet record exists or not
            $record = GeoCityQuery::create()
                ->filterByScitycode($cityCode)
                ->findOne();

            if (!empty($record)) {
                $record_id = $record->getPrimaryKey();

                $rowData[] = $record_id;
                $rowData[] = "Record already exsists";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $record = new GeoCity();
            $record->setScityname($cityName);
            $record->setIstateid($state->getPrimaryKey());
            $record->setIcountryid($state->getCountryId());
            $record->setScitycode($cityCode);
            $record->save();

            $record_id = $record->getPrimaryKey();

            $rowData[] = $record_id;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }

        return true;
    }

    private function importTown($rowData, &$firstRow, $fromGeo = false)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Town');
            $firstRow = false;
            // $this->collection->setModel(GeoTowns::class);
            return true;
        }

        try {
            // Get Data
            if ($fromGeo) {
                $townName = $rowData[1];
                $townCode = $rowData[2];
                $cityCode = $rowData[3];
            } else {
                $townName = $rowData[0];
                $townCode = $rowData[1];
                $cityCode = $rowData[2];
            }

            // check if currency exists or not
            $city = $this->getCityRecordByCode($cityCode);
            if (empty($city)) {
                $rowData[] = 0;
                $rowData[] = "City not exsists!";
                $this->addDataToErrorFile($rowData);
                return true;
            }

            // check if beat outlet record exists or not
            $record = GeoTownsQuery::create()
                ->filterByStowncode($townCode)
                ->filterByIcityid($city->getPrimaryKey())
                ->findOne();

            if (!empty($record)) {
                $record_id = $record->getPrimaryKey();

                $rowData[] = $record_id;
                $rowData[] = "Record already exsists";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $record = new GeoTowns();
            $record->setStownname($townName);
            $record->setIcityid($city->getPrimaryKey());
            $record->setStowncode($townCode);
            $record->setSstatus(1);
            $record->save();

            $record_id = $record->getPrimaryKey();
            // $this->collection->append($record);

            // if ($this->collection->count() >= 500) {
            //     $this->collection->save();
            //     $this->collection->clear();
            //     echo 'Imported : ' . 500 . PHP_EOL;
            // }

            $rowData[] = $record_id;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }

        return true;
    }

    private function importClassification($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Classification');
            $firstRow = false;
            return true;
        }

        try {
            // Get Data
            $classificationName = $rowData[0];
            $orgUnitId = $rowData[1];

            // check if org unit id exists or not
            $record = $this->getOrgUnitRecordById($orgUnitId);
            if (empty($record)) {
                $rowData[] = 0;
                $rowData[] = "Org unit not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if classification name exists or not
            $record = ClassificationQuery::create()
                ->filterByClassification($classificationName)
                ->filterByOrgunitid($orgUnitId)
                ->filterByCompanyId($this->company_id)
                ->findOne();

            if (!empty($record)) {
                $record_id = $record->getPrimaryKey();

                $rowData[] = $record_id;
                $rowData[] = "Classification already exsists";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $record = new Classification();
            $record->setClassification($classificationName);
            $record->setCompanyId($this->company_id);
            $record->setOrgunitid($orgUnitId);
            $record->save();

            $record_id = $record->getPrimaryKey();

            $rowData[] = $record_id;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }

        return true;
    }

    private function importOutlets($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Outlets');
            $firstRow = false;
            // $this->collection->setModel(Outlets::class);
            return true;
        }

        try {
            // Get Data
            $salutation = !empty($rowData[0]) ? $rowData[0] : null;
            $customerName = !empty($rowData[1]) ? $rowData[1] : null;
            $customerCode = !empty($rowData[2]) ? $rowData[2] : null;
            $outletTypeName = !empty($rowData[3]) ? $rowData[3] : null;
            $classificationName = !empty($rowData[4]) ? $rowData[4] : null;
            $classificationCode = !empty($rowData[5]) ? $rowData[5] : null;
            $contactName = !empty($rowData[6]) ? $rowData[6] : null;
            $openingDate = !empty($rowData[7]) ? $rowData[7] : null;
            $contactNumber = !empty($rowData[8]) ? $rowData[8] : null;
            $landlineNumber = !empty($rowData[9]) ? $rowData[9] : null;
            $email = !empty($rowData[10]) ? $rowData[10] : null;
            $townName = !empty($rowData[11]) ? $rowData[11] : null;
            $towncode = !empty($rowData[12]) ? $rowData[12] : null;
            $birthdate = !empty($rowData[13]) ? $rowData[13] : null;
            $anniversary = !empty($rowData[14]) ? $rowData[14] : null;
            $status = !empty($rowData[15]) ? $rowData[15] : 'active';
            $potentialMonthlyBill = !empty($rowData[16]) ? $rowData[16] : null;
            $registrationNo = !empty($rowData[17]) ? $rowData[17] : null;
            $qualification = !empty($rowData[18]) ? $rowData[18] : null;
            $maritalStatus = !empty($rowData[19]) ? $rowData[19] : null;

            // check if customer code is 0 or null
            if (empty($customerCode)) {
                $rowData[] = 0;
                $rowData[] = "Customer code not provided!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if outlet code exists or not
            // $outletRecords = OutletsQuery::create()
            //             ->filterByOutletCode($customerCode)
            //             ->filterByCompanyId($this->company_id)
            //             ->find();
            $record = $this->getOutletRecordByCodeFromArray($customerCode);

            if (!empty($record)) {
                // $record_id = $record->getPrimaryKey();
                // $record_id = $record;

                // $rowData[] = $record_id;
                // $rowData[] = "Outlet already exsists";
                // $this->addDataToErrorFile($rowData);

                // return true;
                $outletRecords = OutletsQuery::create()
                    ->filterById($record)
                    ->filterByCompanyId($this->company_id)
                    ->find();
            } else {
                $outletRecords = null;
            }

            // check if outlet email exists or not
            if (empty($outletRecords) && !empty($email)) {
                $record = OutletsQuery::create()
                    ->filterByOutletEmail($email)
                    ->findOne();

                if (!empty($record)) {
                    $record_id = $record->getPrimaryKey();

                    $rowData[] = $record_id;
                    $rowData[] = "Outlet email already exsists";
                    $this->addDataToErrorFile($rowData);

                    return true;
                }
            }

            // check if outlet reg no exists or not
            if (empty($outletRecords) && !empty($registrationNo)) {
                $record = OutletsQuery::create()
                    ->filterByOutletRegno($registrationNo)
                    ->findOne();

                if (!empty($record)) {
                    $record_id = $record->getPrimaryKey();

                    $rowData[] = $record_id;
                    $rowData[] = "Outlet registration no already exsists";
                    $this->addDataToErrorFile($rowData);

                    return true;
                }
            }

            if (!empty($towncode)) {
                // $town = GeoTownsQuery::create()
                //         ->filterByStowncode($towncode)
                //         ->findOne();
                $town = $this->getTownRecordByCodeFromArray($towncode);

                if (empty($town)) {
                    $rowData[] = 0;
                    $rowData[] = "Town not exsists!";
                    $this->addDataToErrorFile($rowData);

                    return true;
                }

                // $town_id = $town->getPrimaryKey();
                $town_id = $town;
            } else {
                $town_id = NULL;
            }

            if (!empty($classificationName)) {
                // check if classification name exists or not
                $classification = ClassificationQuery::create()
                    ->filterByClassification($classificationName)
                    ->filterByCompanyId($this->company_id)
                    ->findOne();

                if (!empty($classification)) {
                    $classification_id = $classification->getPrimaryKey();
                } else {
                    $classification = new Classification();
                    $classification->setClassification($classificationName);
                    $classification->setCompanyId($this->company_id);
                    $classification->save();

                    $classification_id = $classification->getPrimaryKey();
                }
            } else {
                $classification_id = NULL;
            }

            if (!empty($outletTypeName)) {
                $typeArray = [194 => 'Doctor', 195 => 'Pharmacy', 196 => 'Stockist'];
                $outletType_id = array_search($outletTypeName, $typeArray);
                // check if outlet type name exists or not
                // $outletType = OutletTypeQuery::create()
                //                     ->filterByOutlettypeName($outletTypeName)
                //                     ->filterByCompanyId($this->company_id)
                //                     ->findOne();

                // if(!empty($outletType)) {
                //     $outletType_id = $outletType->getPrimaryKey();
                // } else {
                //     $outletType = new OutletType();
                //     $outletType->setOutlettypeName($outletTypeName);
                //     $outletType->setCompanyId($this->company_id);
                //     $outletType->save();

                //     $outletType_id = $outletType->getPrimaryKey();
                // }
            } else {
                $rowData[] = 0;
                $rowData[] = "Type not found!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!empty($outletRecords) && $outletRecords->count()) {
                foreach ($outletRecords as $record) {
                    $record->setOutletSalutation($salutation);
                    $record->setOutletName($customerName);
                    $record->setOutlettypeId($outletType_id);
                    $record->setOutletClassification($classification_id);
                    $record->setOutletContactName($contactName);
                    $record->setOutletOpeningDate($openingDate);
                    $record->setOutletContactNo($contactNumber);
                    $record->setOutletLandlineno($landlineNumber);
                    $record->setItownid($town_id);
                    $record->setOutletContactBday($birthdate);
                    $record->setOutletContactAnniversary($anniversary);
                    $record->setOutletStatus($status);
                    $record->setOutletPotential($potentialMonthlyBill);
                    $record->setOutletQualification($qualification);
                    $record->setOutletMaritalStatus($maritalStatus);
                    $record->save();

                    $record_id = $record->getPrimaryKey();
                }
                $rowData[] = "Record updated!";
            } else {
                $record = new Outlets();
                $record->setOutletSalutation($salutation);
                $record->setOutletName($customerName);
                $record->setOutletCode($customerCode);
                $record->setOutlettypeId($outletType_id);
                $record->setOutletClassification($classification_id);
                $record->setOutletContactName($contactName);
                $record->setOutletOpeningDate($openingDate);
                $record->setOutletContactNo($contactNumber);
                $record->setOutletLandlineno($landlineNumber);
                $record->setOutletEmail($email);
                $record->setItownid($town_id);
                $record->setOutletContactBday($birthdate);
                $record->setOutletContactAnniversary($anniversary);
                $record->setOutletStatus($status);
                $record->setOutletPotential($potentialMonthlyBill);
                $record->setOutletRegno($registrationNo);
                $record->setOutletQualification($qualification);
                $record->setOutletMaritalStatus($maritalStatus);
                $record->setCompanyId($this->company_id);
                $record->save();
                $rowData[] = "New Record created!";
                $record_id = $record->getPrimaryKey();
            }

            // $this->collection->append($record);

            // if ($this->collection->count() >= 500) {
            //     try {
            //         $this->collection->save();
            //     } catch(\Exception $e) {
            //         $previous = $e->getPrevious();
            //         if(!empty($previous))
            //             echo "Failed to collection save : " . $e->getPrevious()->getMessage() . PHP_EOL;
            //         else
            //             echo "Failed to collection save : " . $e->getMessage() . PHP_EOL;
            //     }
            //     $this->collection->clear();
            // }

            $rowData[] = $record_id ?? 0;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }

        return true;
    }

    private function importOutletMappingOld($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Outlet Mapptings');
            $firstRow = false;
            return true;
        }

        try {
            // Get Data
            $outletTypeName = !empty($rowData[0]) ? $rowData[0] : null;
            $parentOutletCode = $rowData[2];
            $pricebookId = 211;
            $secondaryOutletCodes = $this->getSecondaryOutletCodes($rowData, 3);

            // check if outlet type exists
            if (!empty($outletTypeName)) {
                // check if outlet type name exists or not
                $outletType = OutletTypeQuery::create()
                    ->filterByOutlettypeName($outletTypeName)
                    ->filterByCompanyId($this->company_id)
                    ->findOne();

                if (!empty($outletType)) {
                    $outletType_id = $outletType->getPrimaryKey();
                } else {
                    $rowData[] = 0;
                    $rowData[] = "Type not found!";
                    $this->addDataToErrorFile($rowData);

                    return true;
                }
            } else {
                $rowData[] = 0;
                $rowData[] = "Type not found!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if parent outlet exists
            $patentOutlet = OutletsQuery::create()
                ->filterByOutletCode($parentOutletCode)
                ->filterByOutlettypeId($outletType_id)
                ->filterByCompanyId($this->company_id)
                ->findOne();

            if (empty($patentOutlet)) {
                $rowData[] = 0;
                $rowData[] = $parentOutletCode . " outlet not found!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $secondaryOutletNotFound = $secondaryOutletAlreadyExists = $secondaryOutletSuccessful = $record_ids = [];
            foreach ($secondaryOutletCodes as $secondaryOutletCode) {
                $secondaryOutlet = OutletsQuery::create()
                    ->filterByOutletCode($secondaryOutletCode)
                    ->filterByCompanyId($this->company_id)
                    ->findOne();

                if (empty($secondaryOutlet)) {
                    $secondaryOutletNotFound[] = $secondaryOutletCode;
                    continue;
                }

                $record = OutletMappingQuery::create()
                    ->filterByPrimaryOutletId($patentOutlet->getPrimaryKey())
                    ->filterBySecondaryOutletId($secondaryOutlet->getPrimaryKey())
                    ->find();

                if (!empty($record)) {
                    $secondaryOutletAlreadyExists[] = $secondaryOutletCode;
                    continue;
                }

                $record = new OutletMapping();
                $record->setPrimaryOutletId($patentOutlet->getPrimaryKey());
                $record->setSecondaryOutletId($secondaryOutlet->getPrimaryKey());
                $record->setPricebookId($pricebookId);
                $record->setCategoryType("Regular");
                $record->setIsdefault(0);
                $record->save();

                $secondaryOutletSuccessful[] = $secondaryOutletCode;
                $record_ids[] = $record->getPrimaryKey();
            }

            if (count($secondaryOutletAlreadyExists) || count($secondaryOutletNotFound)) {
                $errorMessage = '';

                if (count($secondaryOutletNotFound)) {
                    $errorMessage .= implode(', ', $secondaryOutletNotFound) . " outlet not found! ";
                }

                if (count($secondaryOutletAlreadyExists)) {
                    $errorMessage .= implode(', ', $secondaryOutletAlreadyExists) . " outlet already mapped! ";
                }

                if (count($secondaryOutletSuccessful)) {
                    $errorMessage .= implode(', ', $secondaryOutletSuccessful) . " outlet mapped! ";
                }

                $rowData[] = 0;
                $rowData[] = $errorMessage;
                $this->addDataToErrorFile($rowData);
            } else {
                $rowData[] = implode(', ', $record_ids);
                $this->addDataToSuccessFile($rowData);
            }
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
    }

    private function importOutletMapping($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Outlet Mapptings');
            $firstRow = false;
            return true;
        }

        try {
            // Get Data
            $parentOutletCode = !empty($rowData[0]) ? $rowData[0] : null;
            $secondaryOutletCode = !empty($rowData[1]) ? $rowData[1] : null;
            $pricebookId = !empty($rowData[2]) ? $rowData[2] : null;
            $orgUnitId = !empty($rowData[3]) ? $rowData[3] : null;
            $inputType = !empty($rowData[4]) ? strtolower($rowData[4]) : 'default';

            // $pricebookArr = [247 => 34, 248 => 43, 249 => 35, 250 => 55, 251 => 38, 252 => 37, 253 => 39, 254 => 47, 255 => 50, 256 => 59];
            // $pricebookId = array_search($orgUnitId, $pricebookArr);

            // pricebook
            $pricebook = PricebooksQuery::create()
                ->filterByOrgId($orgUnitId)
                ->filterByCompanyId($this->company_id)
                ->findOne();

            if (empty($pricebook)) {
                $pricebook = new Pricebooks();
                $pricebook->setPricebookName($orgUnitId . ' Book');
                $pricebook->setPricebookDescription($orgUnitId . ' Book');
                $pricebook->setCompanyId($this->company_id);
                $pricebook->setOrgId($orgUnitId);
                $pricebook->save();

                $pricebookId = $pricebook->getPrimaryKey();
            } else {
                $pricebookId = $pricebook->getPrimaryKey();
            }

            if (empty($pricebookId)) {
                $rowData[] = 0;
                $rowData[] = "Pricebook not found!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if parent outlet exists
            // $patentOutlet = OutletsQuery::create()
            //                 ->filterByOutletCode($parentOutletCode)
            //                 ->filterByCompanyId($this->company_id)
            //                 ->findOne();
            $patentOutlet = $this->getOutletRecordByCodeFromArray($parentOutletCode);

            if (empty($patentOutlet)) {
                $rowData[] = 0;
                $rowData[] = "parent : " . $parentOutletCode . " outlet not found!";
                $this->addDataToErrorFile($rowData);

                return true;
            } else {
                $patentOutletId = $patentOutlet;
            }

            // $secondaryOutlet = OutletsQuery::create()
            //                 ->filterByOutletCode($secondaryOutletCode)
            //                 ->filterByCompanyId($this->company_id)
            //                 ->findOne();
            $secondOutlet = $this->getOutletRecordByCodeFromArray($secondaryOutletCode);
            if (empty($secondOutlet)) {
                $rowData[] = 0;
                $rowData[] = "secondary : " . $secondaryOutletCode . " outlet not found!";
                $this->addDataToErrorFile($rowData);

                return true;
            } else {
                $secondOutletId = $secondOutlet;
            }

            // $record = OutletMappingQuery::create()
            //                 ->filterByPrimaryOutletId($patentOutlet->getPrimaryKey())
            //                 ->filterBySecondaryOutletId($secondaryOutlet->getPrimaryKey())
            //                 ->findOne();

            // if(!empty($record)) {
            //     $rowData[] = 0;
            //     $rowData[] = "outlet already mapped!";
            //     $this->addDataToErrorFile($rowData);

            //     return true;
            // }

            try {

                if ($inputType == 'reset') {
                    OutletMappingQuery::create()
                        ->filterBySecondaryOutletId($secondOutletId)
                        ->filterByPricebookId($pricebookId)
                        ->delete();

                    $rowData[] = 'All records removed';
                } elseif ($inputType == 'remove') {
                    OutletMappingQuery::create()
                        ->filterByPrimaryOutletId($patentOutletId)
                        ->filterBySecondaryOutletId($secondOutletId)
                        ->filterByPricebookId($pricebookId)
                        ->delete();

                    $rowData[] = 'Record removed';
                } else {
                    $record = new OutletMapping();
                    $record->setPrimaryOutletId($patentOutletId);
                    $record->setSecondaryOutletId($secondOutletId);
                    $record->setPricebookId($pricebookId);
                    $record->setCategoryType("Regular");
                    $record->setIsdefault(0);
                    $record->save();

                    $rowData[] = $record->getPrimaryKey();
                }

                $this->addDataToSuccessFile($rowData);
            } catch (\Exception $e) {
                // $previous = $e->getPrevious();
                // if(!empty($previous))
                //     echo "Failed to collection save : " . $e->getPrevious()->getMessage() . PHP_EOL;
                // else
                //     echo "Failed to collection save : " . $e->getMessage() . PHP_EOL;
                $rowData[] = 0;
                $rowData[] = "outlet already mapped!";
                $this->addDataToErrorFile($rowData);

                return true;
            }
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
    }

    private function importHoliday($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Holiday');
            $firstRow = false;
            return true;
        }

        try {
            // Get Data
            $holidayName = $rowData[0];
            $holidayDate = $rowData[1];
            $stateCode = $rowData[2];

            // check if state exists or not
            $state = $this->getStateRecordByCode($stateCode);
            if (empty($state)) {
                $rowData[] = 0;
                $rowData[] = "State not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if holiday record exists or not
            $record = HolidaysQuery::create()
                ->filterByHolidayDate($holidayDate)
                ->filterByIstateid($state->getPrimaryKey())
                ->filterByCompanyId($this->company_id)
                ->findOne();

            if (!empty($record)) {
                $record_id = $record->getPrimaryKey();

                $rowData[] = $record_id;
                $rowData[] = "Record already exsists";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $record = new Holidays();
            $record->setHolidayName($holidayName);
            $record->setHolidayDate($holidayDate);
            $record->setIstateid($state->getPrimaryKey());
            $record->setCompanyId($this->company_id);
            $record->save();

            $record_id = $record->getPrimaryKey();

            $rowData[] = $record_id;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
    }

    private function importSGPIBrand($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'SGPI');
            $firstRow = false;
            return true;
        }

        try {
            // Get Data
            $sgpiName = !empty($rowData[0]) ? $rowData[0] : null;
            $sgpiCode = !empty($rowData[1]) ? $rowData[1] : null;
            // $sgpiStatus = $rowData[2];
            // $sgpiMedia = $rowData[3];
            // $materialSku = $rowData[4];
            $useStartDate = !empty($rowData[2]) ? $rowData[2] : null;
            $useEndDate = !empty($rowData[3]) ? $rowData[3] : null;
            $sgpiType = !empty($rowData[4]) ? strtolower($rowData[4]) : null;
            $orgUnitId = !empty($rowData[5]) ? $rowData[5] : null;
            $brandCode = !empty($rowData[6]) ? strtolower($rowData[6]) : null;
            $outletTypeName = !empty($rowData[7]) ? strtolower($rowData[7]) : null;
            $isStrategic = !empty($rowData[8]) ? strtolower($rowData[8]) : null;
            $brandId = null;

            // check for SGPI Type
            if (!in_array($sgpiType, ['samples', 'gifts', 'promo'])) {
                $rowData[] = 0;
                $rowData[] = "SGPI type should be samples, gifts or promo!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check for SGPI Type
            if (!in_array($outletTypeName, ['d', 'c', 's'])) {
                $rowData[] = 0;
                $rowData[] = "Outlet type should be Doctor, Pharmacy or Stockist!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $typeArray = [194 => 'd', 195 => 'c', 196 => 's'];
            $outletType_id = array_search($outletTypeName, $typeArray);

            // check if org unit id exists or not
            $record = $this->getOrgUnitRecordById($orgUnitId);
            if (empty($record)) {
                $rowData[] = 0;
                $rowData[] = "Org unit not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!in_array($isStrategic, ['y', 'n'])) {
                $rowData[] = 0;
                $rowData[] = "SGPI Status should be 'Y' or  'N'!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!empty($brandCode)) {
                $record = $this->getBrandRecordByCode($brandCode, $orgUnitId);

                if (!empty($record)) {
                    $brandId = $record->getPrimaryKey();
                } else {
                    $rowData[] = 0;
                    $rowData[] = "Brand not found!";
                    $this->addDataToErrorFile($rowData);

                    return true;
                }
            }

            // check if SGPI record exists or not
            $record = SgpiMasterQuery::create()
                ->filterBySgpiCode($sgpiCode)
                ->filterByOrgUnitId($orgUnitId)
                ->filterByCompanyId($this->company_id)
                ->findOne();

            if (empty($record)) {
                $record = new SgpiMaster();
                $record->setOrgUnitId($orgUnitId);
                $record->setCompanyId($this->company_id);
                $record->setSgpiStatus('Active');
            }

            $record->setSgpiName($sgpiName);
            $record->setSgpiCode($sgpiCode);
            // $record->setSgpiMedia($sgpiMedia);
            // $record->setMaterialSku($materialSku);
            $record->setSgpiType($sgpiType);
            $record->setUseStartDate($useStartDate);
            $record->setUseEndDate($useEndDate);
            $record->setBrandId($brandId);
            $record->setOutlettypeId($outletType_id);
            $record->setIsStrategic(($isStrategic == 'y' ? true : false));
            $record->save();

            $record_id = $record->getPrimaryKey();

            $rowData[] = $record_id;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
    }

    private function importEmployee($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Employee');
            $firstRow = false;
            return true;
        }

        try {
            // Get Data
            $firstName = !empty($rowData[0]) ? $rowData[0] : null;
            $lastName = !empty($rowData[1]) ? $rowData[1] : null;
            $empCode = !empty($rowData[2]) ? $rowData[2] : null;
            $email = !empty($rowData[3]) ? $rowData[3] : null;
            $phone = !empty($rowData[4]) ? $rowData[4] : null;
            $designationName = !empty($rowData[5]) ? $rowData[5] : null;
            $designationCode = !empty($rowData[6]) ? $rowData[6] : null;
            $positionName = !empty($rowData[7]) ? $rowData[7] : null;
            $positionCode = !empty($rowData[8]) ? $rowData[8] : null;
            $reportingTo = !empty($rowData[9]) ? $rowData[9] : null;
            $townName = !empty($rowData[10]) ? $rowData[10] : null;
            $townCode = !empty($rowData[11]) ? $rowData[11] : null;
            $baseMonthlyTarget = !empty($rowData[12]) ? $rowData[12] : null;
            $branchName = !empty($rowData[13]) ? $rowData[13] : null;
            $branchCode = !empty($rowData[14]) ? $rowData[14] : null;
            $roleName = !empty($rowData[15]) ? $rowData[15] : null;
            $orgUnitId = !empty($rowData[16]) ? $rowData[16] : null;
            $gradeName = !empty($rowData[17]) ? $rowData[17] : null;
            $ressiAddress = !empty($rowData[18]) ? $rowData[18] : null;
            $joinDate = !empty($rowData[19]) ? $rowData[19] : null;
            $probationDate = !empty($rowData[20]) ? $rowData[20] : null;
            $confirmationDate = !empty($rowData[21]) ? $rowData[21] : null;
            $trainingStartDate = !empty($rowData[22]) ? $rowData[22] : null;
            $trainingEndDate = !empty($rowData[23]) ? $rowData[23] : null;
            $resignDate = !empty($rowData[24]) ? $rowData[24] : null;
            $empStatus = !empty($rowData[25]) ? $rowData[25] : null;
            $reportingToPositionId = $townId = $branchId = $designationId = null;

            // check emp status
            $empStatus = strtolower($empStatus) == 'active' ? 1 : 0;

            // check for email
            if (empty($email)) {
                $rowData[] = 0;
                $rowData[] = "Email required!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check for phone
            if (empty($phone)) {
                $rowData[] = 0;
                $rowData[] = "Phone required!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check for role
            $role = RolesQuery::create()
                ->filterByRoleName($roleName)
                ->findOne();
            if (empty($role)) {
                $rowData[] = 0;
                $rowData[] = "Role not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if position code exists or not
            $position = $this->getPositionRecordByCode($positionCode);
            if (empty($position)) {
                $rowData[] = 0;
                $rowData[] = "Position not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if org unit id exists or not
            $record = $this->getOrgUnitRecordById($orgUnitId);
            if (empty($record)) {
                $rowData[] = 0;
                $rowData[] = "Org unit not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if reporting to position id exists or not
            if (!empty($reportingTo)) {
                $record = $this->getPositionRecordByCode($reportingTo);
                if (empty($record)) {
                    $rowData[] = 0;
                    $rowData[] = "Report to position not exsists!";
                    $this->addDataToErrorFile($rowData);

                    return true;
                }

                $reportingToPositionId = $record->getPrimaryKey();
            }

            if (!empty($townCode)) {
                $record = GeoTownsQuery::create()
                    ->filterByStowncode($townCode)
                    ->findOne();

                if (empty($record)) {
                    $rowData[] = 0;
                    $rowData[] = "Town not exsists!";
                    $this->addDataToErrorFile($rowData);

                    return true;
                }

                $townId = $record->getPrimaryKey();
            }

            $branchId = $this->getBranchRecordByCodeFromArray($branchCode);
            if (empty($branchId)) {
                $rowData[] = 0;
                $rowData[] = "Branch not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $grade = GradeMasterQuery::create()
                ->filterByGradeName($gradeName)
                ->findOne();
            if (empty($grade)) {
                $grade = new GradeMaster;
                $grade->setGradeName($gradeName);
                $grade->setCompanyId($this->company_id);
                $grade->save();
            }

            if (!empty($designationName)) {
                $record = DesignationsQuery::create()
                    ->filterByDesignation($designationName)
                    ->findOne();

                if (empty($record)) {
                    $record = new Designations();
                    $record->setCompanyId($this->company_id);
                    $record->setDesignation($designationName);
                    $record->save();
                }

                $designationId = $record->getPrimaryKey();
            }

            // check if Employee record exists or not
            $record = EmployeeQuery::create()
                ->filterByEmployeeCode($empCode)
                ->filterByCompanyId($this->company_id)
                ->findOne();

            if (!empty($record)) {
                $record_id = $record->getPrimaryKey();

                $rowData[] = $record_id;
                $rowData[] = "Record already exsists";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $record = new Employee();
            $record->setCompanyId($this->company_id);
            $record->setPositionId($position->getPrimaryKey());
            $record->setReportingTo($reportingToPositionId);
            $record->setDesignationId($designationId);
            $record->setBranchId($branchId);
            $record->setEmployeeCode($empCode);
            $record->setFirstName($firstName);
            $record->setLastName($lastName);
            $record->setEmail($email);
            $record->setPhone($phone);
            $record->setBaseMtarget($baseMonthlyTarget);
            $record->setItownid($townId);
            $record->setGradeId($grade->getPrimaryKey());
            $record->setOrgUnitId($orgUnitId);
            $record->setResiAddress($ressiAddress);
            $record->setStatus($empStatus);
            $record->setIslocked(0);
            $record->setIseodcheckenabled(0);
            $record->save();

            $record_id = $record->getPrimaryKey();

            $userExists = UsersQuery::create()
                ->filterByCompanyId($this->company_id)
                ->filterByPhone($phone)
                ->find();

            if ($userExists->count() < 1) {
                $user = new Users();
                $user->setCompanyId($this->company_id);
                $user->setName($firstName . " " . $lastName);
                $user->setUsername($email);
                $user->setEmail($email);
                $user->setPhone($phone);
                $user->setOtp(9999);
                $user->setPassword(md5("12345678"));
                $user->setRoleId($role->getPrimaryKey());
                $user->setEmployeeId($record_id);
                $user->setStatus($empStatus);
                $user->setDefaultUser(0);
                $user->save();
            }

            $hrUserDateRecord = HrUserDatesQuery::create()
                ->filterByEmployeeId($record->getPrimaryKey())
                ->findOne();
            if (empty($hrUserDateRecord)) {
                $hrUserDateRecord = new HrUserDates;
                $hrUserDateRecord->setEmployeeId($record->getPrimaryKey());
            }
            $hrUserDateRecord->setJoinDate($joinDate);
            $hrUserDateRecord->setProbationDate($probationDate);
            $hrUserDateRecord->setConfirmationDate($confirmationDate);
            $hrUserDateRecord->setTrainingStartDate($trainingStartDate);
            $hrUserDateRecord->setTrainingEndDate($trainingEndDate);
            $hrUserDateRecord->setResignDate($resignDate);
            $hrUserDateRecord->save();

            $rowData[] = $record_id;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
    }

    private function importEmployeeTownMapping($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Employee');
            $firstRow = false;
            return true;
        }

        try {
            // Get Data
            $employeeCode = !empty($rowData[0]) ? $rowData[0] : null;
            $positionCode = !empty($rowData[1]) ? $rowData[1] : null;

            // check if position code exists or not
            $position = $this->getPositionRecordByCode($positionCode);
            if (empty($position)) {
                $rowData[] = 0;
                $rowData[] = "Position not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if town code exists or not
            // $town = $this->getTownRecordByCode($townCode);
            // if(empty($town))
            // {
            //     $rowData[] = 0;
            //     $rowData[] = "Town not exsists!";
            //     $this->addDataToErrorFile($rowData);

            //     return true;
            // }

            // check if Employee record exists or not
            $record = EmployeeQuery::create()
                ->filterByEmployeeCode($employeeCode)
                ->filterByCompanyId($this->company_id)
                ->findOne();

            if (empty($record)) {
                $rowData[] = 0;
                $rowData[] = "Record not found!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // $record->setPositionId($position->getPrimaryKey());
            $record->setReportingTo($position->getPrimaryKey());
            // $record->setItownid($town->getPrimaryKey());
            $record->save();

            $record_id = $record->getPrimaryKey();

            $rowData[] = $record_id;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
    }

    private function importOutletClassificationMapping($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Outelet');
            $firstRow = false;
            return true;
        }

        try {
            // Get Data
            $customerCode = !empty($rowData[0]) ? $rowData[0] : null;
            $classificationName = !empty($rowData[1]) ? $rowData[1] : null;

            // check if classification name exists or not
            $classification = ClassificationQuery::create()
                ->filterByClassification($classificationName)
                ->filterByCompanyId($this->company_id)
                ->findOne();

            if (!empty($classification)) {
                $classification_id = $classification->getPrimaryKey();
            } else {
                $classification = new Classification();
                $classification->setClassification($classificationName);
                $classification->setCompanyId($this->company_id);
                $classification->save();

                $classification_id = $classification->getPrimaryKey();
            }

            // check if outlet code exists or not
            $record = OutletsQuery::create()
                ->filterByOutletCode($customerCode)
                ->filterByCompanyId($this->company_id)
                ->findOne();

            if (empty($record)) {
                $rowData[] = 0;
                $rowData[] = "Record not found!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $record->setOutletClassification($classification_id);
            $record->save();

            $record_id = $record->getPrimaryKey();

            $rowData[] = $record_id;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
    }

    private function importOutletAddresses($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Outelet Address');
            $firstRow = false;
            // $this->collection->setModel(OutletAddress::class);
            return true;
        }

        try {
            // Get Data
            $customerCode = !empty($rowData[0]) ? $rowData[0] : null;
            $addressType = !empty($rowData[1]) ? $rowData[1] : null;
            $address = !empty($rowData[2]) ? $rowData[2] : null;
            $street = !empty($rowData[3]) ? $rowData[3] : null;
            $city = !empty($rowData[4]) ? $rowData[4] : null;
            $townName = !empty($rowData[5]) ? $rowData[5] : null;
            $townCode = !empty($rowData[6]) ? $rowData[6] : null;
            $state = !empty($rowData[7]) ? $rowData[7] : null;
            $pincode = !empty($rowData[8]) ? $rowData[8] : null;
            $addressUniqueCode = !empty($rowData[9]) ? $rowData[9] : null;

            // check if town code exists or not
            // $town = $this->getTownRecordByCode($townCode);
            $town = $this->getTownRecordByCodeFromArray($townCode);
            if (empty($town)) {
                $rowData[] = 0;
                $rowData[] = "Town not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            } else {
                // $townId = $town->getPrimaryKey();
                $townId = $town;
            }

            // check if town code exists or not
            // $outlet = OutletsQuery::create()
            //             ->filterByOutletCode($customerCode)
            //             ->filterByCompanyId($this->company_id)
            //             ->findOne();
            $outlet = $this->getOutletRecordByCodeFromArray($customerCode);
            if (empty($outlet)) {
                $rowData[] = 0;
                $rowData[] = "Outlet not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            } else {
                // $outletId = $outlet->getPrimaryKey();
                $outletId = $outlet;
            }

            // check if outlet code exists or not
            $record = OutletAddressQuery::create()
                ->filterByOutletId($outletId)
                // ->filterByOutletCity($city)
                ->filterByItownid($townId)
                ->filterByCompanyId($this->company_id)
                ->findOne();

            if (empty($record)) {
                // $rowData[] = 0;
                // $rowData[] = "Record already exsists!";
                // $this->addDataToErrorFile($rowData);

                // return true;
                $record = new OutletAddress;
                $record->setOutletId($outletId);
                $record->setItownid($townId);
                $record->setCompanyId($this->company_id);
            }

            $record->setOutletAddress($address);
            $record->setOutletStreetName($street);
            $record->setOutletCity($city);
            $record->setOutletState($state);
            $record->setOutletPincode($pincode);
            $record->setAddressName($addressType);
            $record->save();

            // $this->collection->append($record);

            // if ($this->collection->count() >= 500) {
            //     $this->collection->save();
            //     $this->collection->clear();

            //     echo 'Added 500 outlet address....' . PHP_EOL;
            // }

            $record_id = $record->getPrimaryKey();

            $rowData[] = $record_id;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
    }

    private function importOutletOrgData($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Outelet Org', 'Outlet Code');

            $firstRow = false;
            // $this->collection->setModel(OutletOrgData::class);
            return true;
        }

        try {
            // Get Data
            $orgUnitId = !empty($rowData[0]) ? $rowData[0] : null;
            $customerCode = !empty($rowData[1]) ? $rowData[1] : null;
            $frequency = !empty($rowData[2]) ? $rowData[2] : null;
            $potential = !empty($rowData[3]) ? $rowData[3] : null;
            $brandName = !empty($rowData[4]) ? $rowData[4] : null;
            $customerFrequency = !empty($rowData[5]) ? $rowData[5] : null;
            $tags = !empty($rowData[6]) ? $rowData[6] : null;
            $city = !empty($rowData[7]) ? $rowData[7] : null;
            $townName = !empty($rowData[8]) ? $rowData[8] : null;
            $townCode = !empty($rowData[9]) ? $rowData[9] : null;
            $outletOrgCode = !empty($rowData[10]) ? $rowData[10] : null;
            $outletOrgData = null;

            // $excludeOrgIds = [44, 41, 45, 40];
            // if(in_array($orgUnitId, $excludeOrgIds)) {
            //     $rowData[] = 0;
            //     $rowData[] = "Need to ignore org id!";
            //     $this->addDataToErrorFile($rowData);

            //     return true;
            // }

            // check if town code exists or not
            // $town = $this->getTownRecordByCode($townCode);
            $town = $this->getTownRecordByCodeFromArray($townCode);
            if (empty($town)) {
                $rowData[] = 0;
                $rowData[] = "Town not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            } else {
                // $townId = $town->getPrimaryKey();
                $townId = $town;
            }

            // check if org unit id exists or not
            $record = $this->getOrgUnitRecordById($orgUnitId);
            if (empty($record)) {
                $rowData[] = 0;
                $rowData[] = "Org unit not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!empty($customerCode) && !empty($outletOrgCode)) {
                $outletOrgDataId = OutletViewQuery::create()
                    ->select(['OutletOrgId'])
                    ->filterByOutletCode($customerCode)
                    ->filterByOutletOrgCode($outletOrgCode)
                    ->filterByOrgUnitId($orgUnitId)
                    ->filterByOutletStatus('active')
                    ->filterByCompanyId($this->company_id)
                    ->findOne();

                $outletOrgData = OutletOrgDataQuery::create()
                    ->filterByOutletOrgId($outletOrgDataId)
                    ->findOne();
            }

            if (empty($outletOrgData)) {
                // check if outlet code exists or not
                // $outlet = OutletsQuery::create()
                //             ->filterByOutletCode($customerCode)
                //             ->filterByCompanyId($this->company_id)
                //             ->findOne();
                // $outlet = $this->getOutletRecordByCodeFromArray($customerCode);
                $outlet = $this->getOutletOrgRecordByCodeFromArray($outletOrgCode);
                if (empty($outlet)) {
                    $rowData[] = 0;
                    $rowData[] = "Outlet not exsists!";
                    $this->addDataToErrorFile($rowData);

                    return true;
                } else {
                    // $outletId = $outlet->getPrimaryKey();
                    $outletId = $outlet;
                }

                // check if outlet code exists or not
                $outletAddress = OutletAddressQuery::create()
                    ->filterByOutletId($outletId)
                    ->filterByItownid($townId)
                    ->filterByCompanyId($this->company_id)
                    ->findOne();

                if (empty($outletAddress)) {
                    $rowData[] = 0;
                    $rowData[] = "Customer address not exsists!";
                    $this->addDataToErrorFile($rowData);

                    return true;
                } else {
                    $outletAddressId = $outletAddress->getPrimaryKey();
                }

                // check if outlet code exists or not
                $outletOrgData = OutletOrgDataQuery::create()
                    ->filterByOutletId($outletId)
                    ->filterByOrgUnitId($orgUnitId)
                    ->filterByItownid($townId)
                    ->filterByDefaultAddress($outletAddressId)
                    ->filterByCompanyId($this->company_id)
                    ->findOne();
            }

            if (empty($customerCode) && !empty($outletOrgData)) {
                $rowData[] = 0;
                $rowData[] = "OutletCode already exsists! : " . $outletOrgData->getOutletOrgCode();
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!empty($outletOrgData) && !empty($customerCode) && $outletOrgData->getOutletOrgCode() != $customerCode) {
                $rowData[] = 0;
                $rowData[] = "OutletCode mismatched! : " . $outletOrgData->getOutletOrgCode();
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (empty($outletOrgData)) {
                // $rowData[] = 0;
                // $rowData[] = "Out org data already exsists!";
                // $this->addDataToErrorFile($rowData);

                // return true;
                $record = new OutletOrgData;
                $record->setOutletId($outletId);
                $record->setOrgUnitId($orgUnitId);
                $record->setItownid($townId);
                $record->setDefaultAddress($outletAddressId);
                $record->setCompanyId($this->company_id);

                if (!empty($customerCode)) {
                    $record->setOutletOrgCode($customerCode);
                } else {
                    $pcode = (new \BI\manager\OnBoardManager)->generatePCode($this->company_id);
                    $record->setOutletOrgCode($pcode);
                }
            } else {
                $record = $outletOrgData;
            }

            $record->setTags($tags);
            $record->setVisitFq($frequency);
            $record->setOrgPotential($potential);
            $record->setBrandFocus($brandName);
            $record->setCustomerFq($customerFrequency);
            $record->save();

            // $this->collection->append($record);

            // if ($this->collection->count() >= 500) {
            //     $this->collection->save();
            //     $this->collection->clear();

            //     echo 'Added 500 outlet outlet org data....' . PHP_EOL;
            // }


            $record_id = $record->getPrimaryKey();

            $rowData[] = $record_id;
            $rowData[] = $record->getOutletOrgCode();
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
    }

    private function importBeatMappingAlembic($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Patch');
            $firstRow = false;
            // $this->collection->setModel(BeatOutlets::class);
            return true;
        }

        try {
            // Get Data
            $territoryCode = $rowData[0];
            $beatCode = $rowData[1];
            $customerCode = $rowData[2];
            $city = $rowData[3];
            $townCode = $rowData[4];
            $orgUnitId = $rowData[5];

            // $excludeOrgIds = [44, 41, 45, 40];
            // if(in_array($orgUnitId, $excludeOrgIds)) {
            //     $rowData[] = 0;
            //     $rowData[] = "Need to ignore org id!";
            //     $this->addDataToErrorFile($rowData);

            //     return true;
            // }

            // check if town code exists or not
            // $town = $this->getTownRecordByCode($townCode);
            $town = $this->getTownRecordByCodeFromArray($townCode);
            if (empty($town)) {
                $rowData[] = 0;
                $rowData[] = "Town not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            } else {
                // $townId = $town->getPrimaryKey();
                $townId = $town;
            }

            // check if territory code exists or not
            // $territory = $this->getTerritoryRecordByCode($territoryCode);
            $territory = $this->getTerritoryRecordByCodeFromArray($territoryCode, $orgUnitId);
            if (empty($territory)) {
                $rowData[] = 0;
                $rowData[] = "Territory not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            } else {
                // $territoryId = $territory->getPrimaryKey();
                $territoryId = $territory;
            }

            // check if beat code exists or not
            // $beat = BeatsQuery::create()
            //             ->filterByBeatCode($beatCode)
            //             ->filterByTerritoryId($territory->getPrimaryKey())
            //             ->filterByCompanyId($this->company_id)
            //             ->findOne();
            $beat = BeatsQuery::create()
                ->filterByBeatCode($beatCode)
                ->filterByTerritoryId($territoryId)
                ->filterByItownid($townId)
                ->filterByCompanyId($this->company_id)
                ->filterByOrgUnitId($orgUnitId)
                ->findOne();
            if (empty($beat)) {
                $beat = new Beats();
                $beat->setBeatName(ucwords($beatCode));
                $beat->setBeatRemark('');
                $beat->setBeatCode($beatCode);
                $beat->setTerritoryId($territoryId);
                $beat->setCompanyId($this->company_id);
                $beat->setItownid($townId);
                $beat->setOrgunitid($orgUnitId);
                $beat->save();

                // $rowData[] = 0;
                // $rowData[] = "Beat not exsists!";
                // $this->addDataToErrorFile($rowData);

                // return true;
            }

            // check if org unit id exists or not
            // $record = $this->getOrgUnitRecordById($orgUnitId);
            // if(empty($record))
            // {
            //     $rowData[] = 0;
            //     $rowData[] = "Org unit not exsists!";
            //     $this->addDataToErrorFile($rowData);

            //     return true;
            // }

            // check if outlet code exists or not
            // $outlet = OutletsQuery::create()
            //             ->filterByOutletCode($customerCode)
            //             ->filterByCompanyId($this->company_id)
            //             ->findOne();
            $outlet = $this->getOutletRecordByCodeFromArray($customerCode);
            if (empty($outlet)) {
                $rowData[] = 0;
                $rowData[] = "Outlet not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            } else {
                // $outletId = $outlet->getPrimaryKey();
                $outletId = $outlet;
            }

            // check if outlet org record exists or not
            $outletOrg = OutletOrgDataQuery::create()
                ->filterByOutletId($outletId)
                ->filterByOrgUnitId($orgUnitId)
                //->filterByItownid($townId)
                ->filterByCompanyId($this->company_id)
                ->findOne();

            if (empty($outletOrg)) {
                $rowData[] = 0;
                $rowData[] = "Outlet Org record not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // get old beat id
            // $oldbeat = $this->getBeatRecordByCode($beatCode);

            // check if beat outlet record exists or not
            $record = BeatOutletsQuery::create()
                ->filterByBeatId($beat->getPrimaryKey())
                ->filterByBeatOrgOutlet($outletOrg->getPrimaryKey())
                ->filterByCompanyId($this->company_id)
                ->findOne();

            if (!empty($record)) {
                $rowData[] = $record->getPrimaryKey();
                $rowData[] = "Mapping already exsists!";
                $this->addDataToErrorFile($rowData);

                return true;

                // if($beat->getPrimaryKey() != $record->getBeatId())
                // {
                //     $record->setBeatId($beat->getPrimaryKey());
                //     $record->save();
                //     $rowData[] = "Record updated!";                    
                // }
                // else 
                // {
                //     $rowData[] = "Record already exists !";
                // }

                // $rowData[] = $record_id;
                // $this->addDataToSuccessFile($rowData);
                // return true;
            } else {
                $data = [];
                $data['OutletOrgId'] = $outletOrg->getPrimaryKey();
                $data['territoryId'] = $territoryId;
                $response = $this->removeBeatMappingforOutletOrgData($data);
                if ($response['status'] == 'failed') {
                    $rowData[] = $response['errorMessage'];
                    $this->addDataToErrorFile($rowData);
                    return true;
                } else {
                    $successIds = ['removed_ids' => $response['transactionId']];

                    $record = new BeatOutlets();
                    $record->setBeatId($beat->getPrimaryKey());
                    $record->setBeatOrgOutlet($outletOrg->getPrimaryKey());
                    $record->setActiveDate(date('Y-m-d H:i:s'));
                    $record->setCompanyId($this->company_id);
                    $record->save();

                    $record_id = $record->getPrimaryKey();
                    $successIds = ['added_ids' => $record_id];

                    $rowData[] = json_encode($successIds);
                    $this->addDataToSuccessFile($rowData);
                    return true;
                }
            }

            // $this->collection->append($record);

            // if ($this->collection->count() >= 500) {
            //     $this->collection->save();
            //     $this->collection->clear();

            //     echo 'Added 500 beat mapping....' . PHP_EOL;
            // }


        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }

        return true;
    }

    public function importBrandCompititors($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Brand Compititors ID');
            $firstRow = false;
            // $this->collection->setModel(BrandCompetition::class);
            return true;
        }

        try {
            // Get Data
            $brandCode = $rowData[0];
            $competitorName = $rowData[1];
            $dRate = $rowData[2];
            $stateCode = $rowData[3];
            $orgUnitId = $rowData[4];
            $skuCode = $rowData[5];
            $productId = null;

            // check if brand code exists or not
            $brand = $this->getBrandRecordByCode($brandCode, $orgUnitId);
            if (empty($brand)) {
                $rowData[] = 0;
                $rowData[] = "Brand not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if org unit id exists or not
            $record = $this->getOrgUnitRecordByIdFromArray($orgUnitId);
            if (empty($record)) {
                $rowData[] = 0;
                $rowData[] = "Org unit not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if state exists or not
            $state = $this->getStateRecordByCode($stateCode);
            if (empty($state)) {
                $rowData[] = 0;
                $rowData[] = "State not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check for SKU
            if (!empty($skuCode)) {
                $product = ProductsQuery::create()
                    ->where("lower(products.product_sku) = '" . strtolower($skuCode) . "'")
                    ->filterByBrandId($brand->getPrimaryKey())
                    ->filterByOrgunitId($orgUnitId)
                    ->filterByCompanyId($this->company_id)
                    ->findOne();

                if (!empty($product)) {
                    $productId = $product->getPrimaryKey();
                }
            }

            if (empty($productId)) {
                $rowData[] = 0;
                $rowData[] = "SKU not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if beat outlet record exists or not
            $record = BrandCompetitionQuery::create()
                ->filterByCompetitorBrandId($brand->getPrimaryKey())
                ->filterByCompetitorName($competitorName)
                ->filterByOrgunitid($orgUnitId)
                ->filterByCompanyId($this->company_id)
                ->filterByProductId($productId)
                ->findOne();

            if (!empty($record)) {
                $states = $record->getIstateids();
                if (!empty($states)) {
                    $states = $states . ',' . $state->getPrimaryKey();
                } else {
                    $states = $state->getPrimaryKey();
                }
            } else {
                $record = new BrandCompetition();
                $record->setCompetitorName($competitorName);
                $record->setCompetitorBrandId($brand->getPrimaryKey());
                $record->setOrgunitid($orgUnitId);
                $record->setCompanyId($this->company_id);
                $record->setProductId($productId);
                $states = $state->getPrimaryKey();
            }

            $record->setDrate($dRate);
            $record->setIstateids($states);
            $record->save();

            // $this->collection->append($record);

            // if ($this->collection->count() >= 500) {
            //     $this->collection->save();
            //     $this->collection->clear();
            // }

            $record_id = $record->getPrimaryKey();

            $rowData[] = $record_id;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }

        return true;
    }

    public function importSGPITransactions($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Brand Compititors ID');
            $firstRow = false;
            return true;
        }

        try {
            // Get Data
            $empCode = $rowData[0];
            $sgpiCode = $rowData[1];
            $transactionType = strtolower($rowData[2]);
            $qty = $rowData[3];
            $voucherNo = !empty($rowData[4]) ? $rowData[4] . time() : time();
            $remark = $rowData[5];

            $transactionTypeConfig = ["credit" => "C", "debit" => "D"];

            if (!in_array($transactionType, array_keys($transactionTypeConfig))) {
                $rowData[] = 0;
                $rowData[] = "Transaction type should be credit or debit!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if town code exists or not
            $employee = EmployeeQuery::create()
                ->filterByEmployeeCode($empCode)
                ->filterByCompanyId($this->company_id)
                ->findOne();
            if (empty($employee)) {
                $rowData[] = 0;
                $rowData[] = "Employee not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if SGPI record exists or not
            $sgpiMaster = SgpiMasterQuery::create()
                ->filterBySgpiCode($sgpiCode)
                ->filterByCompanyId($this->company_id)
                ->findOne();

            if (empty($sgpiMaster)) {
                $rowData[] = 0;
                $rowData[] = "SGPI Name not exsists";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $sgpiAccount = SgpiAccountsQuery::create()
                ->filterByCompanyId($this->company_id)
                ->filterByEmployeeId($employee->getPrimaryKey())
                ->findOne();

            if (empty($sgpiAccount)) {
                $sgpiAccount = new SgpiAccounts();
                $sgpiAccount->setCompanyId($this->company_id);
                $sgpiAccount->setAccountName($employee->getFirstName() . ' ' . $employee->getLastName());
                $sgpiAccount->setEmployeeId($employee->getPrimaryKey());
                $sgpiAccount->save();
            }

            // $sgpitransRecord = SgpiTransQuery::create()
            //                     ->filterBySgpiId($sgpiMaster->getPrimaryKey())
            //                     ->filterBySgpiAccountId($sgpiAccount->getPrimaryKey())
            //                     ->filterByCd($transactionTypeConfig[$transactionType])
            //                     ->filterByQty($qty)
            //                     ->findOne();

            // if (!empty($sgpitransRecord)) {
            //     $rowData[] = 0;
            //     $rowData[] = "SGPI Transaction already exists!";
            //     $this->addDataToErrorFile($rowData);

            //     return true;
            // }

            $record = new SgpiTrans();
            $record->setSgpiId($sgpiMaster->getPrimaryKey());
            $record->setSgpiAccountId($sgpiAccount->getPrimaryKey());
            $record->setCd($transactionTypeConfig[$transactionType]);
            $record->setQty($qty);
            $record->setVoucherNo($voucherNo);
            $record->setRemark($remark);
            $record->setCompanyId($this->company_id);
            $record->save();

            $record_id = $record->getPrimaryKey();

            $rowData[] = $record_id;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }

        return true;
    }

    public function importGeoDistancesOld($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Brand Compititors ID');
            $firstRow = false;
            $this->collection->setModel(GeoDistance::class);
            return true;
        }

        try {
            // Get Data
            $from_town_code = $rowData[0];
            $to_town_code = $rowData[1];
            $distance_km = $rowData[2];

            // check if from town code exists or not
            $formTown = $this->getTownRecordByCode($from_town_code);
            if (empty($formTown)) {
                $rowData[] = 0;
                $rowData[] = "From town not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if to town code exists or not
            $toTown = $this->getTownRecordByCode($to_town_code);
            if (empty($toTown)) {
                $rowData[] = 0;
                $rowData[] = "To town not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if geo distancce record exists or not
            $record = GeoDistanceQuery::create()
                ->filterByFromTownId($formTown->getPrimaryKey())
                ->filterByToTownId($toTown->getPrimaryKey())
                ->findOne();

            if (empty($record)) {
                $record = new GeoDistance();
                $record->setFromTownId($formTown->getPrimaryKey());
                $record->setToTownId($toTown->getPrimaryKey());
            }

            $record->setDistanceKm($distance_km);
            // $record->save();

            $this->collection->append($record);

            if ($this->collection->count() >= 500) {
                $this->collection->save();
                $this->collection->clear();
            }

            // $record_id = $record->getPrimaryKey();
            $rowData[] = 0;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }

        return true;
    }

    public function importCityCategories($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Brand Compititors ID');
            $firstRow = false;
            // $this->collection->setModel(Citycategory::class);
            return true;
        }

        try {
            // Get Data
            $town = $rowData[0];
            $townCode = $rowData[1];
            $category = strtolower($rowData[2]);
            $scope = strtolower($rowData[3]);
            $employeeCode = $rowData[4];
            $gradeName = $rowData[5];

            $categories = ["A" => "a class", "B" => "b class", "C" => "c class"];
            $scopes = ['0' => 'global', '1' => 'employee'];

            if (!in_array($category, $categories)) {
                $rowData[] = 0;
                $rowData[] = "Category should be A Class / B Class / C Class !";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!in_array($scope, $scopes)) {
                $rowData[] = 0;
                $rowData[] = "Scope should be Global / Employee !";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if Employee record exists or not
            if ($employeeCode) {
                $employee = EmployeeQuery::create()
                    ->filterByEmployeeCode($employeeCode)
                    ->filterByCompanyId($this->company_id)
                    ->findOne();

                if (empty($employee)) {
                    $rowData[] = 0;
                    $rowData[] = "Employee not exsists!";
                    $this->addDataToErrorFile($rowData);

                    return true;
                }
            }

            $grade = GradeMasterQuery::create()
                ->filterByGradeName($gradeName)
                ->findOne();
            if (empty($grade)) {
                $grade = new GradeMaster;
                $grade->setGradeName($gradeName);
                $grade->setCompanyId($this->company_id);
                $grade->save();
            }

            $requestedCategory = array_search($category, $categories);
            $requestedScope = array_search($scope, $scopes);

            // check if from town code exists or not
            $towns = GeoTownsQuery::create()
                ->filterByStowncode($townCode)
                ->find();
            if (empty($towns)) {
                $rowData[] = 0;
                $rowData[] = "Town not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            foreach ($towns as $town) {
                $cityName = $town->getStownname() . " | " . $town->getGeoCity()->getScityname() . " | " . $town->getGeoCity()->getGeoState()->getSstatename();

                $record = CitycategoryQuery::create()
                    ->filterByItownid($town->getPrimaryKey())
                    ->filterByCategory($category)
                    ->filterByScope($requestedScope)
                    ->filterByGradeId($grade->getPrimaryKey())
                    ->filterByCompanyId($this->company_id);

                if ($scope == 'employee') {
                    $record->filterByIdentityKey($employee->getPrimaryKey());
                }

                $record = $record->findOne();

                if (!empty($record)) {
                    // $rowData[] = 0;
                    // $rowData[] = "Record already exists!";
                    // $this->addDataToErrorFile($rowData);

                    // return true;
                    $record_id = $record->getPrimaryKey();
                } else {
                    $record = new Citycategory;
                    $record->setItownid($town->getPrimaryKey());
                    $record->setCategory($category);
                    $record->setScope($requestedScope);
                    $record->setCityname($cityName);
                    $record->setCompanyId($this->company_id);
                    $record->setGradeId($grade->getPrimaryKey());

                    if ($scope == 'employee') {
                        $record->setIdentityKey($employee->getPrimaryKey());
                    }

                    $record->save();

                    $record_id = $record->getPrimaryKey();
                }
            }

            // $this->collection->append($record);

            // if ($this->collection->count() >= 500) {
            //     $this->collection->save();
            //     $this->collection->clear();
            // }

            // $record_id = $record->getPrimaryKey();
            $rowData[] = $record_id ?? 0;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }

        return true;
    }

    public function importLeaves($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Leave ID');
            $firstRow = false;
            // $this->collection->setModel(Leaves::class);
            return true;
        }

        try {
            // Get Data
            $empCode = $rowData[0];
            $leaveType = $rowData[1];
            $leaveDate = $rowData[2];
            $leaveRemark = $rowData[3];
            $leavePoints = $rowData[4];
            $transactionType = strtolower($rowData[5]);

            $transactionTypeConfig = ["credit", "debit"];
            $leaveTypeConfig = ["CL" => "CL", "PL" => "PL", "SL" => "SL", "ParentalLeave" => "ParentalLeave", "EL" => "EL"];

            if (!in_array($transactionType, $transactionTypeConfig)) {
                $rowData[] = 0;
                $rowData[] = "Transaction type should be credit or debit!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!in_array($leaveType, array_keys($leaveTypeConfig))) {
                $rowData[] = 0;
                $rowData[] = "Leave type should be CL / PL / SL / ParentalLeave / EL!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if town code exists or not
            $employee = EmployeeQuery::create()
                ->filterByEmployeeCode($empCode)
                ->filterByCompanyId($this->company_id)
                ->findOne();
            if (empty($employee)) {
                $rowData[] = 0;
                $rowData[] = "Employee not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (strtolower($transactionType) == 'debit') {
                $leavePoints = $leavePoints * -1;
            }


            $record = new Leaves();
            $record->setEmployeeId($employee->getPrimaryKey());
            $record->setLeaveDate($leaveDate);
            $record->setLeaveType($leaveTypeConfig[$leaveType]);
            $record->setLeaveRemark($leaveRemark);
            $record->setLeavePoints($leavePoints);
            $record->setCompanyId($this->company_id);

            if (strtolower($transactionType) == 'credit') {
                $record->setLeaveTranMode('Opening');
            }

            $record->save();
            // $this->collection->append($record);

            // if ($this->collection->count() >= 500) {
            //     $this->collection->save();
            //     $this->collection->clear();
            // }

            $record_id = $record->getPrimaryKey();
            $rowData[] = 0;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }

        return true;
    }

    private function importOutletOrgDataUpdateTags($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Outelet Org');
            $firstRow = false;
            $this->collection->setModel(OutletOrgData::class);
            return true;
        }

        try {
            // Get Data
            $customerCode = !empty($rowData[0]) ? $rowData[0] : null;
            $brandFocus = !empty($rowData[1]) ? $rowData[1] : null;
            $orgUnitId = !empty($rowData[2]) ? $rowData[2] : null;
            $tags = !empty($rowData[3]) ? $rowData[3] : null;

            // $excludeOrgIds = [44, 41, 45, 40];
            // if(in_array($orgUnitId, $excludeOrgIds)) {
            //     $rowData[] = 0;
            //     $rowData[] = "Need to ignore org id!";
            //     $this->addDataToErrorFile($rowData);

            //     return true;
            // }

            // check if outlet code exists or not
            // $outlet = OutletsQuery::create()
            //             ->filterByOutletCode($customerCode)
            //             ->filterByCompanyId($this->company_id)
            //             ->findOne();
            // $outlet = $this->getOutletRecordByCodeFromArray($customerCode);
            // if(empty($outlet))
            // {
            //     $rowData[] = 0;
            //     $rowData[] = "Outlet not exsists!";
            //     $this->addDataToErrorFile($rowData);

            //     return true;
            // } else {
            // $outletId = $outlet->getPrimaryKey();
            //     $outletId = $outlet;
            // }

            $outletOrgDataId = OutletViewQuery::create()
                ->select(['OutletOrgId'])
                ->filterByOutletCode($customerCode)
                ->filterByOrgUnitId($orgUnitId)
                ->filterByOutletStatus('active')
                ->filterByCompanyId($this->company_id)
                ->findOne();

            $outletOrgData = OutletOrgDataQuery::create()
                ->filterByOutletOrgId($outletOrgDataId)
                ->find();

            // check if outlet code exists or not
            // $outletOrgData = OutletOrgDataQuery::create()
            //             ->filterByOutletId($outletId)
            //             ->filterByOrgUnitId($orgUnitId)
            //             ->filterByCompanyId($this->company_id)
            //             ->find();

            if (!empty($outletOrgData) && ($outletOrgData->count() > 0)) {
                foreach ($outletOrgData as $record) {
                    if (!empty($brandFocus)) {
                        $record->setBrandFocus($brandFocus);
                    }
                    $record->setTags($tags);
                    $record->save();
                }

                $rowData[] = 0;
                $this->addDataToSuccessFile($rowData);
            } else {
                $rowData[] = 0;
                $rowData[] = "No record not found!";
                $this->addDataToErrorFile($rowData);

                return true;
            }
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
    }

    private function importEmployeeUpdate($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Employee');
            $firstRow = false;
            return true;
        }

        try {
            // Get Data
            $oldEmpCode = !empty($rowData[0]) ? $rowData[0] : null;
            $empCode = !empty($rowData[1]) ? $rowData[1] : null;
            $firstName = !empty($rowData[2]) ? $rowData[2] : null;
            $lastName = !empty($rowData[3]) ? $rowData[3] : null;
            $email = !empty($rowData[4]) ? $rowData[4] : null;
            $designationName = !empty($rowData[5]) ? $rowData[5] : null;
            $positionCode = !empty($rowData[6]) ? $rowData[6] : null;
            $reportingTo = !empty($rowData[7]) ? $rowData[7] : null;
            $townCode = !empty($rowData[8]) ? $rowData[8] : null;
            $baseMonthlyTarget = !empty($rowData[9]) ? $rowData[9] : null;
            $branchCode = !empty($rowData[10]) ? $rowData[10] : null;
            $roleName = !empty($rowData[11]) ? $rowData[11] : null;
            $orgUnitId = !empty($rowData[12]) ? $rowData[12] : null;
            $gradeName = !empty($rowData[13]) ? $rowData[13] : null;
            $ressiAddress = !empty($rowData[14]) ? $rowData[14] : null;
            $joinDate = !empty($rowData[15]) ? $rowData[15] : null;
            $probationDate = !empty($rowData[16]) ? $rowData[16] : null;
            $confirmationDate = !empty($rowData[17]) ? $rowData[17] : null;
            $trainingStartDate = !empty($rowData[18]) ? $rowData[18] : null;
            $trainingEndDate = !empty($rowData[19]) ? $rowData[19] : null;
            $resignDate = !empty($rowData[20]) ? $rowData[20] : null;
            $transferDate = !empty($rowData[21]) ? $rowData[21] : null;
            $empStatus = !empty($rowData[22]) ? $rowData[22] : null;
            $remark = !empty($rowData[23]) ? $rowData[23] : null;
            $reportingToPositionId = $townId = $branchId = $gradeId = $roleId = $designationId = null;

            // check emp status
            $empStatus = strtolower($empStatus) == 'active' ? 1 : 0;

            // check if old employee code exists or not
            $oldEmployee = $this->getEmployeeRecordByCodeFromArray($oldEmpCode);
            if (empty($oldEmployee)) {
                $rowData[] = 0;
                $rowData[] = "Employee not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if new employee code exists or not
            $newEmployee = $this->getEmployeeRecordByCodeFromArray($empCode);
            if (!empty($newEmployee) && ($oldEmpCode != $empCode)) {
                $rowData[] = 0;
                $rowData[] = "Employee found with new employee code!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check for role
            $roleId = $this->getRoleRecordByCodeFromArray($roleName);
            if (empty($roleId)) {
                $rowData[] = 0;
                $rowData[] = "Role not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if position code exists or not
            $positionId = $this->getPositionRecordByCodeFromArray($positionCode);
            if (empty($positionId)) {
                $rowData[] = 0;
                $rowData[] = "Position not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if org unit id exists or not
            $orgUnitId = $this->getOrgUnitRecordByIdFromArray($orgUnitId);
            if (empty($orgUnitId)) {
                $rowData[] = 0;
                $rowData[] = "Org unit not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $branchId = $this->getBranchRecordByCodeFromArray($branchCode);
            if (empty($branchId)) {
                $rowData[] = 0;
                $rowData[] = "Branch not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if reporting to position id exists or not
            if (!empty($reportingTo)) {
                $reportingToPositionId = $this->getPositionRecordByCodeFromArray($reportingTo);
                if (empty($reportingToPositionId)) {
                    $rowData[] = 0;
                    $rowData[] = "Report to position not exsists!";
                    $this->addDataToErrorFile($rowData);

                    return true;
                }
            }

            if (!empty($townCode)) {
                $townId = $this->getTownRecordByCodeFromArray($townCode);
                if (empty($townId)) {
                    $rowData[] = 0;
                    $rowData[] = "Town not exsists!";
                    $this->addDataToErrorFile($rowData);

                    return true;
                }
            }

            $gradeId = $this->getGradeRecordByCodeFromArray($gradeName);
            if (empty($gradeId)) {
                $grade = new GradeMaster;
                $grade->setGradeName($gradeName);
                $grade->setCompanyId($this->company_id);
                $grade->save();

                $gradeId = $grade->getPrimaryKey();
            }

            if (!empty($designationName)) {
                $designationId = $this->getDesignationRecordByCodeFromArray($designationName);
                if (empty($designationId)) {
                    $designation = new Designations();
                    $designation->setCompanyId($this->company_id);
                    $designation->setDesignation($designationName);
                    $designation->save();

                    $designationId = $designation->getPrimaryKey();
                }
            }

            $record = EmployeeQuery::create()
                ->filterByEmployeeCode($oldEmpCode)
                ->filterByCompanyId($this->company_id)
                ->findOne();

            if (!empty($transferDate) || ($record->getPositionId() != $positionId)) {
                if (!empty($transferDate))
                    $transferDate = date('Y-m-d', strtotime($transferDate));
                else
                    $transferDate = date('Y-m-d');

                $attendanceCheck = AttendanceQuery::create()
                    ->filterByEmployeeId($record->getPrimaryKey())
                    ->filterByAttendanceDate($transferDate, Criteria::LESS_THAN)
                    ->filterByStatus(0)
                    ->findOne();

                if (!empty($attendanceCheck)) {
                    $rowData[] = 0;
                    $rowData[] = "Cannot transfer | Attendance status - Punch in for " . $attendanceCheck->getAttendanceDate('d-m-Y') . "!";
                    $this->addDataToErrorFile($rowData);

                    return true;
                }
            }

            $record->setEmail($email);
            $record->setPositionId($positionId);
            $record->setReportingTo($reportingToPositionId);
            $record->setDesignationId($designationId);
            $record->setBranchId($branchId);
            $record->setEmployeeCode($empCode);
            $record->setFirstName($firstName);
            $record->setLastName($lastName);
            $record->setBaseMtarget($baseMonthlyTarget);
            $record->setItownid($townId);
            $record->setGradeId($gradeId);
            $record->setOrgUnitId($orgUnitId);
            $record->setResiAddress($ressiAddress);
            $record->setStatus($empStatus);
            if (isset($remark) && $remark != null) {
                $record->setRemark($remark);
            }

            $record->save();

            $user = UsersQuery::create()
                ->filterByCompanyId($this->company_id)
                ->filterByEmployeeId($record->getPrimaryKey())
                ->findOne();

            $user->setName($firstName . " " . $lastName);
            $user->setRoleId($roleId);
            $user->setStatus($empStatus);
            $user->save();

            if ($record->getStatus() == 0) {
                $empId = $user->getEmployeeId();

                $expenses = \entities\ExpensesQuery::create()
                    ->select('ExpId')
                    ->filterByEmployeeId($empId)
                    ->filterByExpenseStatus(1)
                    ->find()->toArray();

                $updateExp = \entities\ExpensesQuery::create()
                    ->filterByExpId($expenses)
                    ->update(array('ExpenseStatus' => 3));
            }

            $hrUserDateRecord = HrUserDatesQuery::create()
                ->filterByEmployeeId($record->getPrimaryKey())
                ->findOne();
            if (empty($hrUserDateRecord)) {
                $hrUserDateRecord = new HrUserDates;
                $hrUserDateRecord->setEmployeeId($record->getPrimaryKey());
            }
            $hrUserDateRecord->setJoinDate($joinDate);
            $hrUserDateRecord->setProbationDate($probationDate);
            $hrUserDateRecord->setConfirmationDate($confirmationDate);
            $hrUserDateRecord->setTrainingStartDate($trainingStartDate);
            $hrUserDateRecord->setTrainingEndDate($trainingEndDate);
            $hrUserDateRecord->setResignDate($resignDate);
            $hrUserDateRecord->setTransferDate($transferDate);
            $hrUserDateRecord->save();

            $record_id = $record->getPrimaryKey();
            $rowData[] = $record_id;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
    }

    private function importOutletBrandSgpiMapping($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Outlet Brand SGPI Mapping');
            $firstRow = false;

            // $this->collection->setModel(OutletBrandSgpiMap::class);
            return true;
        }

        try {
            $customerCode = !empty($rowData[0]) ? $rowData[0] : null;
            $brandCode = !empty($rowData[1]) ? $rowData[1] : null;
            $orgUnitId = !empty($rowData[2]) ? $rowData[2] : null;
            $sgpi_status = !empty($rowData[3]) ? strtolower($rowData[3]) : null;
            $outletOrgDataId = null;

            if (!in_array($sgpi_status, ['y', 'n'])) {
                $rowData[] = 0;
                $rowData[] = "SGPI Status should be 'Y' or  'N'!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if brand code exists or not
            $brand = $this->getBrandRecordByCode($brandCode, $orgUnitId);
            if (empty($brand)) {
                $rowData[] = 0;
                $rowData[] = "Brand not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            } else {
                $brandId = $brand->getPrimaryKey();
            }

            if (!empty($customerCode) && !empty($orgUnitId)) {
                $outletOrgDataId = OutletViewQuery::create()
                    ->select(['OutletOrgId'])
                    ->filterByOutletCode($customerCode)
                    ->filterByOrgUnitId($orgUnitId)
                    ->filterByOutletStatus('active')
                    ->filterByCompanyId($this->company_id)
                    ->findOne();
            }

            if (empty($outletOrgDataId)) {
                $outlet = $this->getOutletRecordByCodeFromArray($customerCode);
                if (empty($outlet)) {
                    $rowData[] = 0;
                    $rowData[] = "Outlet not exsists!";
                    $this->addDataToErrorFile($rowData);

                    return true;
                } else {
                    // $outletId = $outlet->getPrimaryKey();
                    $outletId = $outlet;
                }

                // check if outlet code exists or not
                $outletOrgData = OutletOrgDataQuery::create()
                    ->filterByOutletId($outletId)
                    ->filterByOrgUnitId($orgUnitId)
                    ->filterByCompanyId($this->company_id)
                    ->orderByOutletOrgId(Criteria::DESC)
                    ->findOne();
                if (empty($outletOrgData)) {
                    $rowData[] = 0;
                    $rowData[] = "Outlet org data not exsists!";
                    $this->addDataToErrorFile($rowData);

                    return true;
                } else {
                    // $outletId = $outlet->getPrimaryKey();
                    $outletOrgDataId = $outletOrgData->getPrimaryKey();
                }
            }

            $outletBrandSGPIMapRecord = OutletBrandSgpiMapQuery::create()
                ->filterByOrgDataId($outletOrgDataId)
                ->filterByBrandId($brandId)
                ->findOne();

            if (empty($outletBrandSGPIMapRecord)) {
                $outletBrandSGPIMapRecord = new OutletBrandSgpiMap();
                $outletBrandSGPIMapRecord->setOrgDataId($outletOrgDataId);
                $outletBrandSGPIMapRecord->setBrandId($brandId);
                $outletBrandSGPIMapRecord->setCompanyId($this->company_id);
            }

            $outletBrandSGPIMapRecord->setSgpiStatus(($sgpi_status == 'y' ? true : false));
            $outletBrandSGPIMapRecord->save();

            // $this->collection->append($outletBrandSGPIMapRecord);

            // if ($this->collection->count() >= 500) {
            //     $this->collection->save();
            //     $this->collection->clear();
            //     echo 'Imported : ' . 500 . PHP_EOL;
            // }

            $record_id = $outletBrandSGPIMapRecord->getPrimaryKey();
            $rowData[] = $record_id;
            $rowData[] = 0;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
    }

    private function importBeatMappingAlembicForDummyStockies($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Patch');
            $firstRow = false;
            return true;
        }

        try {
            // Get Data
            $territoryCode = $rowData[0];
            $beatCode = $rowData[1];
            $customerCode = $rowData[2];
            $city = $rowData[3];
            $townCode = $rowData[4];
            $orgUnitId = $rowData[5];
            $oodID = $rowData[6] ?? 0;

            // check if territory code exists or not
            // $territory = $this->getTerritoryRecordByCode($territoryCode);
            $territory = $this->getTerritoryRecordByCodeFromArray($territoryCode, $orgUnitId);
            if (empty($territory)) {
                $rowData[] = 0;
                $rowData[] = "Territory not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            } else {
                // $territoryId = $territory->getPrimaryKey();
                $territoryId = $territory;
            }

            $beat = BeatsQuery::create()
                ->filterByBeatCode($beatCode)
                ->filterByTerritoryId($territoryId)
                ->filterByItownid(136)
                ->filterByCompanyId($this->company_id)
                ->filterByOrgUnitId($orgUnitId)
                ->findOne();
            if (empty($beat)) {
                $beat = new Beats();
                $beat->setBeatName(ucwords($beatCode));
                $beat->setBeatRemark('');
                $beat->setBeatCode($beatCode);
                $beat->setTerritoryId($territoryId);
                $beat->setCompanyId($this->company_id);
                $beat->setItownid(136);
                $beat->setOrgunitid($orgUnitId);
                $beat->save();

                // $rowData[] = 0;
                // $rowData[] = "Beat not exsists!";
                // $this->addDataToErrorFile($rowData);

                // return true;
            }

            // check if outlet org record exists or not
            if (!empty($oodID)) {
                $record = OutletOrgDataQuery::create()
                    ->filterByOutletOrgId($oodID)
                    ->findOne();
                if (empty($record)) {
                    $rowData[] = 0;
                    $rowData[] = "Outlet org data not exsists!";
                    $this->addDataToErrorFile($rowData);

                    return true;
                } else {
                    $outletOrg = $record->getPrimaryKey();
                }
            } else {
                $record = new OutletOrgData;
                $record->setOutletId(1500419);
                $record->setOrgUnitId($orgUnitId);
                $record->setVisitFq(2);
                $record->setOrgPotential(50000);
                $record->setCustomerFq(3);
                $record->setCompanyId($this->company_id);
                $record->setItownid(136);
                $record->setDefaultAddress(1082640);
                $record->save();
                $outletOrg = $record->getPrimaryKey();
            }

            $record = new BeatOutlets();
            $record->setBeatId($beat->getPrimaryKey());
            $record->setBeatOrgOutlet($outletOrg);
            $record->setCompanyId($this->company_id);
            $record->save();

            $record_id = $record->getPrimaryKey();

            $rowData[] = $record_id;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }

        return true;
    }

    private function importCategories($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Categories');
            $firstRow = false;
            return true;
        }

        try {
            // Get Data
            $categoryName = $rowData[0];
            $categoryCode = $rowData[1];
            $categoryParentCode = $rowData[2];
            $categoryType = $rowData[3];
            $categoryDescription = $rowData[4];
            $orgUnitId = $rowData[5];
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }

        return true;
    }

    private function importGeoDistancesOld2($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Geo ID');
            $firstRow = false;
            // $this->collection->setModel(GeoDistance::class);
            return true;
        }

        try {
            // Get Data
            $beltName = !empty($rowData[0]) ? $rowData[0] : null;;
            $fromStateCode = !empty($rowData[1]) ? $rowData[1] : null;
            $fromTownCode = !empty($rowData[2]) ? $rowData[2] : null;
            $toStateCode = !empty($rowData[3]) ? $rowData[3] : null;
            $toTownCode = !empty($rowData[4]) ? $rowData[4] : null;
            $distanceKm = !empty($rowData[5]) ? $rowData[5] : 0;
            $distanceType = !empty($rowData[6]) ? $rowData[6] : null;
            $fixedamount = !empty($rowData[7]) ? $rowData[7] : 0;
            $remark = !empty($rowData[8]) ? $rowData[8] : null;
            $slab1Rate = !empty($rowData[9]) ? $rowData[9] : 0;
            $slab2Rate = !empty($rowData[10]) ? $rowData[10] : 0;
            $slab3Rate = !empty($rowData[11]) ? $rowData[11] : 0;

            $amount = $this->calculateExpenseAmount($distanceType, $distanceKm, $fixedamount, $slab1Rate, $slab2Rate, $slab3Rate);

            $fromStateId = $this->getCityRecordByCodeFromArray($fromStateCode);
            if (empty($fromStateId)) {
                $rowData[] = 0;
                $rowData[] = "From state not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $toStateId = $this->getCityRecordByCodeFromArray($toStateCode);
            if (empty($toStateId)) {
                $rowData[] = 0;
                $rowData[] = "To state not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // $fromTownId = $this->getTownByCityRecordByCode($fromTownCode, $fromStateId);
            // if(empty($fromTownId))
            // {
            //     $rowData[] = 0;
            //     $rowData[] = "From town not exsists!";
            //     $this->addDataToErrorFile($rowData);

            //     return true;
            // }

            // $toTownId = $this->getTownByCityRecordByCode($toTownCode, $toStateId);
            // if(empty($toTownId))
            // {
            //     $rowData[] = 0;
            //     $rowData[] = "To town not exsists!";
            //     $this->addDataToErrorFile($rowData);

            //     return true;
            // }

            $fromTownId = $this->getTownRecordByCodeFromArray($fromTownCode);
            if (empty($fromTownId)) {
                $rowData[] = 0;
                $rowData[] = "From town not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $toTownId = $this->getTownRecordByCodeFromArray($toTownCode);
            if (empty($toTownId)) {
                $rowData[] = 0;
                $rowData[] = "To town not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $fromStateId = GeoCityQuery::create()
                ->filterByIcityid($fromStateId)
                ->findOne();
            $fromStateId = $fromStateId->getIstateid();

            $toStateId = GeoCityQuery::create()
                ->filterByIcityid($toStateId)
                ->findOne();
            $toStateId = $toStateId->getIstateid();

            $calculationType = strtolower($distanceType) == 'f' ? 'F' : 'K';

            $record = GeoDistanceQuery::create()
                ->filterByFromTownId($fromTownId)
                ->filterByToTownId($toTownId)
                ->filterByCalculationType($calculationType)
                ->findOne();

            if (empty($record)) {
                $record = new GeoDistance();
                $record->setFromTownId($fromTownId);
                $record->setToTownId($toTownId);
                $record->setCalculationType($calculationType);
            } else {
                $rowData[] = "Record updated!";
            }

            $record->setDistanceKm($distanceKm);
            $record->setBeltName($beltName);
            $record->setFromStateId($fromStateId);
            $record->setToStateId($toStateId);
            $record->setAmount($amount);
            $record->setRemark($remark);
            $record->save();

            // $this->collection->append($record);

            // if ($this->collection->count() >= 500) {
            //     $this->collection->save();
            //     $this->collection->clear();
            // }

            $record_id = $record->getPrimaryKey();
            $rowData[] = $record_id;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }

        return true;
    }

    private function importGeoDistances($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Geo ID');
            $firstRow = false;
            return true;
        }

        try {
            // Get Data
            $beltName = !empty($rowData[0]) ? $rowData[0] : null;;
            $fromStateCode = !empty($rowData[1]) ? $rowData[1] : null;
            $fromTownCode = !empty($rowData[2]) ? $rowData[2] : null;
            $toStateCode = !empty($rowData[3]) ? $rowData[3] : null;
            $toTownCode = !empty($rowData[4]) ? $rowData[4] : null;
            $distanceKm = !empty($rowData[5]) ? $rowData[5] : 0;
            $distanceType = !empty($rowData[6]) ? $rowData[6] : null;
            $fixedamount = !empty($rowData[7]) ? $rowData[7] : 0;
            $remark = !empty($rowData[8]) ? $rowData[8] : null;
            $slab1Rate = !empty($rowData[9]) ? $rowData[9] : 0;
            $slab2Rate = !empty($rowData[10]) ? $rowData[10] : 0;
            $slab3Rate = !empty($rowData[11]) ? $rowData[11] : 0;

            $amount = $this->calculateExpenseAmount($distanceType, $distanceKm, $fixedamount, $slab1Rate, $slab2Rate, $slab3Rate);

            $calculationType = strtolower($distanceType) == 'f' ? 'F' : 'K';

            $fromState = GeoStateQuery::create()
                ->filterBySstatecode($fromStateCode)
                ->filterBySstatus(1)
                ->findOne();
            if ($fromState == null) {
                $rowData[] = 0;
                $rowData[] = "From state not exsists!";
                $this->addDataToErrorFile($rowData);
                return true;
            } else {
                $fromStateId = $fromState->getPrimaryKey();
            }

            $toState = GeoStateQuery::create()
                ->filterBySstatecode($toStateCode)
                ->filterBySstatus(1)
                ->findOne();
            if ($toState == null) {
                $rowData[] = 0;
                $rowData[] = "To state not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            } else {
                $toStateId = $toState->getPrimaryKey();
            }

            $fromTowns = GeoTownsQuery::create()
                ->filterByStowncode($fromTownCode)
                ->filterBySstatus(1)
                ->find();
            if (count($fromTowns) == 0) {
                $rowData[] = 0;
                $rowData[] = "From town not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $toTowns = GeoTownsQuery::create()
                ->filterByStowncode($toTownCode)
                ->filterBySstatus(1)
                ->find();
            if (count($toTowns) == 0) {
                $rowData[] = 0;
                $rowData[] = "To town not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }
            $update = 0;
            $fromStateMismatch = "";
            $toStateMismatch = "";
            foreach ($fromTowns as $fromTown) {

                $fromTownId = $fromTown->getItownid();

                if ($fromStateId != $fromTown->getGeoCity()->getGeoState()->getIstateid()) {
                    $fromStateMismatch = $fromStateMismatch . trim($fromTown->getGeoCity()->getGeoState()->getSstatecode()) . ",";
                    continue;
                }

                foreach ($toTowns as $toTown) {

                    $toTownId = $toTown->getItownid();

                    if ($toStateId != $toTown->getGeoCity()->getGeoState()->getIstateid()) {
                        $toStateMismatch = $toStateMismatch . trim($toTown->getGeoCity()->getGeoState()->getSstatecode()) . ",";
                        continue;
                    }

                    $record = GeoDistanceQuery::create()
                        ->filterByFromTownId($fromTownId)
                        ->filterByToTownId($toTownId)
                        ->filterByFromStateId($fromStateId)
                        ->filterByToStateId($toStateId)
                        ->filterByCalculationType($calculationType)
                        ->filterByBeltName($beltName)
                        ->findOne();

                    if (empty($record)) {
                        $record = new GeoDistance();
                        $record->setFromTownId($fromTownId);
                        $record->setToTownId($toTownId);
                        $record->setCalculationType($calculationType);
                        $record->setFromStateId($fromStateId);
                        $record->setToStateId($toStateId);
                        $record->setBeltName($beltName);
                    }

                    $record->setDistanceKm($distanceKm);
                    $record->setAmount($amount);
                    $record->setRemark($remark);
                    $record->save();
                    $update = $update + 1;
                }
            }

            if ($update > 0) {
                $rowData[] = $update . 'Record updated/created , Statemismatch F/T:' . $fromStateMismatch . '/' . $toStateMismatch;
                $this->addDataToSuccessFile($rowData);
            } else {
                $rowData[] = $update . 'Failed : Statemismatch F/T:' . trim($fromStateMismatch) . '/' . trim($toStateMismatch) . '|' . $fromTownId . '|' . $toTownId;
                $this->addDataToErrorFile($rowData);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }

        return true;
    }

    private function calculateExpenseAmount($type, $km = 0, $fixedamount = 0, $slab1Rate = 0, $slab2Rate = 0, $slab3Rate = 0)
    {
        if (strtolower($type) == 'f') {
            return $fixedamount;
        }

        return $this->calculatePerKmExpenseAmount($km, $slab1Rate, $slab2Rate, $slab3Rate);
    }

    private function calculatePerKmExpenseAmount($km, $slab1Rate = 0, $slab2Rate = 0, $slab3Rate = 0)
    {
        $remainingKm = $km;
        $amount = 0;

        if ($km > 100) {
            $amount = 100 * $slab1Rate;
            $remainingKm = $remainingKm - 100;
        } else {
            $amount = $remainingKm * $slab1Rate;
            $remainingKm = 0;
        }

        if ($km > 151) {
            $amount = $amount + (50 * $slab2Rate);
            $remainingKm = $remainingKm - 50;
        } else {
            $amount = $amount + ($remainingKm * $slab2Rate);
            $remainingKm = 0;
        }

        if ($remainingKm > 0) {
            $amount = $amount + ($remainingKm * $slab3Rate);
            $remainingKm = 0;
        }

        return $amount;
    }

    private function removeDuplicateDCR($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'DCR ID');
            $firstRow = false;
            return true;
        }

        try {
            $outletOrgDataId = !empty($rowData[0]) ? $rowData[0] : null;;
            $dcrDate = !empty($rowData[1]) ? $rowData[1] : null;
            $positionId = !empty($rowData[2]) ? $rowData[2] : null;
            $employeeId = !empty($rowData[3]) ? $rowData[3] : null;
            $count = !empty($rowData[4]) ? $rowData[4] : null;
            $minDCRId = !empty($rowData[5]) ? $rowData[5] : 0;
            $dayPlanId = !empty($rowData[6]) ? $rowData[6] : null;
            $itownid = !empty($rowData[7]) ? $rowData[7] : 0;
            $duplicateDCRIds = !empty($rowData[8]) ? $rowData[8] : null;

            $duplicateDCRIds = explode(', ', $duplicateDCRIds);

            // Get SGPI out DCR ID
            $dailyCallSgpiOut = DailycallsSgpioutQuery::create()
                ->filterByDailycallId($duplicateDCRIds)
                ->where('dailycalls_sgpiout.sgpi_id is not null')
                ->findOne();

            if (!empty($dailyCallSgpiOut)) {
                $dcr_id = $dailyCallSgpiOut->getDailycallId();
            } else {
                $dcr_id = $minDCRId;
            }

            $getDCRRecords = DailycallsQuery::create()
                ->filterByDcrId($duplicateDCRIds)
                ->filterByDcrId($dcr_id, Criteria::NOT_EQUAL)
                ->find();

            foreach ($getDCRRecords as $dcrRecord) {
                $dailyCallSgpiOut = DailycallsSgpioutQuery::create()
                    ->filterByDailycallId($dcrRecord->getDcrId())
                    ->find();

                foreach ($dailyCallSgpiOut as $sgpiout) {
                    // delete sgpi voucher
                    $sgpiRecord = SgpiTransQuery::create()
                        ->filterBySgpiId($sgpiout->getSgpiId())
                        ->filterByQty($sgpiout->getSgpiQty())
                        ->filterByVoucherNo($sgpiout->getSgpiVoucherId())
                        ->filterByCd('D')
                        ->findOne();

                    $newrecord = $rowData;
                    $newrecord[] = 'sgpi_trans_record_remove';
                    $newrecord[] = json_encode($sgpiRecord->toArray());
                    $this->addDataToSuccessFile($newrecord);

                    $sgpiRecord->delete();

                    // delete dailycall sgpiout record
                    $newrecord = $rowData;
                    $newrecord[] = 'dailycall_sgpiout_record_remove';
                    $newrecord[] = json_encode($sgpiout->toArray());
                    $this->addDataToSuccessFile($newrecord);

                    $sgpiout->delete();
                }

                //delete DCR record
                $newrecord = $rowData;
                $newrecord[] = 'dcr_record_remove';
                $newrecord[] = json_encode($dcrRecord->toArray());
                $this->addDataToSuccessFile($newrecord);

                $dcrRecord->delete();
            }

            //update DCR Record
            if ((!empty($dayPlanId) && strtolower($dayPlanId) != 'null') || (!empty($itownid) && strtolower($itownid) != 'null')) {
                $dcrRecord = DailycallsQuery::create()
                    ->filterByDcrId($dcr_id)
                    ->findOne();
                if (!empty($dayPlanId) && strtolower($dayPlanId) != 'null') {
                    $dcrRecord->setDayPlanId($dayPlanId);
                }

                if (!empty($itownid) && strtolower($itownid) != 'null') {
                    $dcrRecord->setItownid($itownid);
                }

                $dcrRecord->save();
            }

            $newrecord = $rowData;
            $newrecord[] = 'dcr_record_updated';
            $newrecord[] = json_encode($dcrRecord->toArray());
            $this->addDataToSuccessFile($newrecord);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
        return true;
    }

    private function removeBrandRcpa($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'DCR ID');
            $firstRow = false;
            return true;
        }

        try {
            $outletId = !empty($rowData[0]) ? $rowData[0] : null;;
            $retailerOutletId = !empty($rowData[1]) ? $rowData[1] : null;
            $employeeId = !empty($rowData[2]) ? $rowData[2] : null;
            $rcpaMoye = !empty($rowData[3]) ? $rowData[3] : null;
            $competitorId = !empty($rowData[4]) ? $rowData[4] : null;
            $count = !empty($rowData[5]) ? $rowData[5] : 0;
            $maxID = !empty($rowData[6]) ? $rowData[6] : null;
            $duplicateIds = !empty($rowData[7]) ? $rowData[7] : null;

            $duplicateIds = explode(', ', $duplicateIds);

            $records = BrandRcpaQuery::create()
                ->filterByBrcpaId($duplicateIds)
                ->filterByBrcpaId($maxID, Criteria::NOT_EQUAL)
                ->find();

            foreach ($records as $record) {
                //delete DCR record
                $newrecord = $rowData;
                $newrecord[] = 'recpa_record_removed';
                $newrecord[] = json_encode($record->toArray());
                $this->addDataToSuccessFile($newrecord);

                $record->delete();
            }
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
        return true;
    }

    private function importProducts($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Products');
            $firstRow = false;
            return true;
        }

        try {
            // Get Data
            $brandCode = !empty($rowData[0]) ? $rowData[0] : null;
            $productName = !empty($rowData[1]) ? $rowData[1] : null;
            $productSummary = !empty($rowData[2]) ? $rowData[2] : null;
            $productDescription = !empty($rowData[3]) ? $rowData[3] : null;
            $productSKU = !empty($rowData[4]) ? $rowData[4] : null;
            $productUnit = !empty($rowData[5]) ? $rowData[5] : null;
            $packingDesc = !empty($rowData[6]) ? $rowData[6] : 'Handle with care';
            $packingQty = !empty($rowData[7]) ? $rowData[7] : null;
            $tag = !empty($rowData[8]) ? $rowData[8] : 'Most Recommended';
            $categoryCode = !empty($rowData[9]) ? $rowData[9] : null;
            $orgUnitId = !empty($rowData[10]) ? $rowData[10] : null;
            $basePrice = !empty($rowData[11]) ? $rowData[11] : null;
            $mrp = !empty($rowData[12]) ? $rowData[12] : 0;
            $sellingPrice = !empty($rowData[13]) ? $rowData[13] : 0;
            $categoryId = $brandId = $unitId = $tagId = null;

            $orgUnitId = $this->getOrgUnitRecordByIdFromArray($orgUnitId);
            if (empty($orgUnitId)) {
                $rowData[] = 0;
                $rowData[] = "Org unit not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check if brand name exists or not
            $brand = BrandsQuery::create()
                ->filterByBrandCode($brandCode)
                ->filterByOrgunitid($orgUnitId)
                ->filterByCompanyId($this->company_id)
                ->findOne();
            if (empty($brand)) {
                $rowData[] = 0;
                $rowData[] = "Brand not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            } else {
                $brandId = $brand->getPrimaryKey();
            }

            $category = CategoriesQuery::create()
                ->filterByCategoryCode($categoryCode)
                ->filterByOrgunitid($orgUnitId)
                ->filterByCompanyId($this->company_id)
                ->findOne();
            if (empty($category)) {
                $category = new Categories();
                $category->setCategoryCode($categoryCode);
                $category->setCategoryName(ucwords($categoryCode));
                $category->setCategoryDescription(ucwords($categoryCode));
                $category->setCategoryType('Regular');
                $category->setCategoryMedia(211);
                $category->setCategoryDisplayOrder(1);
                $category->setCategoryParentId(0);
                $category->setCompanyId($this->company_id);
                $category->setOrgunitId($orgUnitId);
                $category->save();

                $categoryId = $category->getPrimaryKey();
            } else {
                $categoryId = $category->getPrimaryKey();
            }

            $unitRecord = UnitmasterQuery::create()
                ->filterByUnitCode($productUnit)
                ->findOne();
            if (empty($unitRecord)) {
                $unitRecord = new Unitmaster();
                $unitRecord->setUnitCode($productUnit);
                $unitRecord->setUnitDescription($productUnit);
                $unitRecord->save();

                $unitId = $unitRecord->getPrimaryKey();
            } else {
                $unitId = $unitRecord->getPrimaryKey();
            }

            $tagRecord = TagsQuery::create()
                ->filterByTagName($tag)
                ->filterByCompanyId($this->company_id)
                ->findOne();
            if (empty($tagRecord)) {
                $tagRecord = new Tags();
                $tagRecord->setTagName($tag);
                $tagRecord->setCompanyId($this->company_id);
                $tagRecord->save();

                $tagId = $tagRecord->getPrimaryKey();
            } else {
                $tagId = $tagRecord->getPrimaryKey();
            }

            $product = ProductsQuery::create()
                ->where("lower(products.product_sku) = '" . strtolower($productSKU) . "'")
                ->filterByBrandId($brandId)
                ->filterByOrgunitId($orgUnitId)
                ->filterByCompanyId($this->company_id)
                ->findOne();

            if (empty($product)) {
                $product = new Products();
                $product->setProductSku($productSKU);
                $product->setBrandId($brandId);
                $product->setOrgunitId($orgUnitId);
                $product->setCompanyId($this->company_id);
                $product->setProductImages(211);
            }

            $product->setProductName($productName);
            $product->setProductSummary($productSummary);
            $product->setProductDescription($productDescription);
            $product->setPackingDesc($packingDesc);
            $product->setPackingQty($packingQty);
            $product->setCategoryId($categoryId);
            $product->setTagId($tagId);
            $product->setUnitD($unitId);
            $product->setBasePrice($basePrice);
            $product->save();

            $productId = $product->getPrimaryKey();

            if ($mrp > 0 || $sellingPrice > 0) {
                // pricebook
                $pricebook = PricebooksQuery::create()
                    ->filterByOrgId($orgUnitId)
                    ->filterByCompanyId($this->company_id)
                    ->findOne();
                if (empty($pricebook)) {
                    $pricebook = new Pricebooks();
                    $pricebook->setPricebookName($orgUnitId . ' Book');
                    $pricebook->setPricebookDescription($orgUnitId . ' Book');
                    $pricebook->setCompanyId($this->company_id);
                    $pricebook->setOrgId($orgUnitId);
                    $pricebook->save();

                    $pricebookId = $pricebook->getPrimaryKey();
                } else {
                    $pricebookId = $pricebook->getPrimaryKey();
                }

                $pricebookline = PricebooklinesQuery::create()
                    ->filterByPricebookId($pricebookId)
                    ->filterByProductId($productId)
                    ->filterByCompanyId($this->company_id)
                    ->findOne();
                if (empty($pricebookline)) {
                    $pricebookline = new Pricebooklines();
                    $pricebookline->setPricebookId($pricebookId);
                    $pricebookline->setProductId($productId);
                    $pricebookline->setCompanyId($this->company_id);
                }

                $pricebookline->setMaxRetailPrice($mrp);
                $pricebookline->setSellingPrice($sellingPrice);
                $pricebookline->setIsenabled(1);
                $pricebookline->save();
            }

            $rowData[] = $productId;
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }

        return true;
    }

    private function importSGPIDetails($rowData, &$firstRow)
    {
        if ($firstRow) {
            $rowData[] = 'Message';
            $rowData[] = 'Qty';
            $this->addFirstRowLog($rowData, 'DCR Sgpiout ID');
            $firstRow = false;
            return true;
        }

        try {
            $bu_name = !empty($rowData[0]) ? $rowData[0] : null;
            $position_code = !empty($rowData[4]) ? $rowData[4] : null;
            $employee_code = !empty($rowData[6]) ? $rowData[6] : null;
            $customer_code = !empty($rowData[8]) ? $rowData[8] : null;
            $visit_date = !empty($rowData[10]) ? $rowData[10] : null;
            $sgpi_code = !empty($rowData[11]) ? $rowData[11] : null;
            $sgpi_qty = !empty($rowData[14]) ? $rowData[14] : null;
            $orgUnitId = null;

            // Get orgUnit
            $orgUnitArr = [38 => 'Osteofit', 34 => 'Eye Care', 37 => 'Maxis', 35 => 'Megacare', 39 => 'Zenovi', 43 => 'Elena'];
            $orgUnitId = array_search($bu_name, $orgUnitArr);

            if (empty($orgUnitId)) {
                $rowData[] = "BU not exsists!";
                $rowData[] = 0;
                $rowData[] = 0;
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // Get position
            $position = PositionsQuery::create()
                ->filterByPositionCode($position_code)
                ->filterByOrgUnitId($orgUnitId)
                ->findOne();

            if (empty($position)) {
                $rowData[] = "Position not exsists!";
                $rowData[] = 0;
                $rowData[] = 0;
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // Get employee
            $employee = EmployeeQuery::create()
                ->filterByEmployeeCode($employee_code)
                ->filterByOrgUnitId($orgUnitId)
                ->findOne();

            if (empty($employee)) {
                $rowData[] = "Employee not exsists!";
                $rowData[] = 0;
                $rowData[] = 0;
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $sgpi = SgpiMasterQuery::create()
                ->filterBySgpiCode($sgpi_code)
                ->filterByOrgUnitId($orgUnitId)
                ->findOne();
            if (empty($sgpi)) {
                $rowData[] = "Sgpi not exsists!";
                $rowData[] = 0;
                $rowData[] = 0;
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $sgpiAccount = SgpiAccountsQuery::create()->findOneByEmployeeId($employee->getPrimaryKey());
            if (empty($sgpiAccount)) {
                $rowData[] = "SGPI account not exsists!";
                $rowData[] = 0;
                $rowData[] = 0;
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // Get customer
            $outletView = OutletViewQuery::create()
                ->filterByOutletCode($customer_code)
                ->filterByOrgUnitId($orgUnitId)
                ->filterByOutletStatus('active')
                ->findOne();
            if (empty($outletView)) {
                $rowData[] = "Outlet not exsists!";
                $rowData[] = 0;
                $rowData[] = 0;
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // DCR call
            $dailyCall = DailycallsQuery::create()
                ->filterByPositionId($position->getPrimaryKey())
                ->filterByEmployeeId($employee->getPrimaryKey())
                ->filterByOutletOrgDataId($outletView->getOutletOrgId())
                ->filterByDcrDate($visit_date)
                ->findOne();
            if (empty($dailyCall)) {
                $rowData[] = "DCR record not exsists!";
                $rowData[] = 0;
                $rowData[] = 0;
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // Check Has sgpi or not
            $dailycallsgpiOut = DailycallsSgpioutQuery::create()
                ->filterByDailycallId($dailyCall->getPrimaryKey())
                ->filterBySgpiId($sgpi->getPrimaryKey())
                ->findOne();
            if (!empty($dailycallsgpiOut)) {
                $rowData[] = "Already Exists!";
                $rowData[] = $dailycallsgpiOut->getSgpiQty();
                $rowData[] = $dailycallsgpiOut->getPrimaryKey();
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // Check SGPI Balance
            $sgpiBalance = SgpiEmployeeBalanceQuery::create()
                ->filterByEmployeeId($employee->getPrimaryKey())
                ->filterBySgpiId($sgpi->getPrimaryKey())
                ->filterBySgpiAccountId($sgpiAccount->getSgpiAccountId())
                ->findOne();
            if (empty($sgpiBalance)) {
                $rowData[] = "SGPI Balance not available! Available Balance : 0";
                $rowData[] = 0;
                $rowData[] = 0;
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if ($sgpiBalance->getBalance() < $sgpi_qty) {
                $rowData[] = "SGPI Balance not available! Available Balance : " . $sgpiBalance->getBalance();
                $rowData[] = 0;
                $rowData[] = 0;
                $this->addDataToErrorFile($rowData);

                return true;
            }

            //Add new record if not exists
            $sgpiRequest = new SGPITransferRequest();
            $sgpiRequest->setFrom_sgpi_account_id($sgpiAccount->getSgpiAccountId());
            $sgpiRequest->setTo_sgpi_account_id(0);
            $sgpiRequest->setSgpi_id($sgpi->getPrimaryKey());
            $sgpiRequest->setQty($sgpi_qty);
            $sgpiRequest->setRemark("By DCR : " . $dailyCall->getPrimaryKey());
            $sgpiRequest->setCompany_id($dailyCall->getCompanyId());

            $sgpiManager = new SGPIManager();
            $sgpiManager->doTransfer($sgpiRequest);

            $dcSgpiOut = new DailycallsSgpiout();
            $dcSgpiOut->setDailycallId($dailyCall->getPrimaryKey());
            $dcSgpiOut->setSgpiId($sgpi->getPrimaryKey());
            $dcSgpiOut->setSgpiQty($sgpi_qty);
            $dcSgpiOut->setSgpiVoucherId($sgpiRequest->getVoucherId());
            $dcSgpiOut->setCompanyId($dailyCall->getCompanyId());
            $dcSgpiOut->setEmployeeId($dailyCall->getEmployeeId());
            $dcSgpiOut->setOutletId($outletView->getOutlet_Id());
            $dcSgpiOut->setOutletOrgdataId($dailyCall->getOutletOrgDataId());
            $dcSgpiOut->save();

            // update SGPI count into DCR
            $sgpiCountForDC = ($dailyCall->getHasSgpi() ?? 0) + 1;
            $dailyCall->setHasSgpi($sgpiCountForDC);
            $dailyCall->save();

            $rowData[] = 'New record created!';
            $rowData[] = $sgpi_qty;
            $rowData[] = $dcSgpiOut->getPrimaryKey();
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $record_id ?? 0;
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
        return true;
    }

    private function importPendingDCRs($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Message');
            $firstRow = false;
            return true;
        }

        try {
            $employeeCode = !empty($rowData[0]) ? $rowData[0] : null;
            $date = !empty($rowData[1]) ? $rowData[1] : null;

            // Get employee
            $employee = EmployeeQuery::create()
                ->filterByEmployeeCode($employeeCode)
                ->findOne();

            if (empty($employee)) {
                $rowData[] = "Employee not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $manager = new DailyCallsManager();
            $manager->addPendingDCRRecord($employee, $date);

            $rowData[] = 'Record Processed!';
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
        return true;
    }

    private function importDCRSGPICorrection($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Message');
            $firstRow = false;
            return true;
        }

        try {
            $buName = !empty($rowData[0]) ? $rowData[0] : null;
            $employeeCode = !empty($rowData[1]) ? $rowData[1] : null;
            $customerCode = !empty($rowData[2]) ? $rowData[2] : null;
            $sgpiCode = !empty($rowData[5]) ? $rowData[5] : null;
            $sgpiQty = !empty($rowData[6]) ? $rowData[6] : null;
            $updatedSgpiQty = !empty($rowData[7]) ? $rowData[7] : null;
            $dcrId = !empty($rowData[8]) ? $rowData[8] : null;
            $dcrDate = !empty($rowData[9]) ? $rowData[9] : null;

            // Get orgUnit
            $orgUnitArr = [38 => 'Osteofit', 34 => 'Eye Care', 37 => 'Maxis', 35 => 'Megacare', 39 => 'Zenovi', 43 => 'Elena'];
            $orgUnitId = array_search($buName, $orgUnitArr);

            if (empty($orgUnitId)) {
                $rowData[] = "BU not exsists!";
                $rowData[] = 0;
                $rowData[] = 0;
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // Get employee
            $employee = EmployeeQuery::create()
                ->filterByEmployeeCode($employeeCode)
                ->filterByOrgUnitId($orgUnitId)
                ->findOne();

            if (empty($employee)) {
                $rowData[] = "Employee not exsists!";
                $rowData[] = 0;
                $rowData[] = 0;
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $sgpi = SgpiMasterQuery::create()
                ->filterBySgpiCode($sgpiCode)
                ->filterByOrgUnitId($orgUnitId)
                ->findOne();
            if (empty($sgpi)) {
                $rowData[] = "Sgpi not exsists!";
                $rowData[] = 0;
                $rowData[] = 0;
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // Get customer
            $outletView = OutletViewQuery::create()
                ->filterByOutletCode($customerCode)
                ->filterByOrgUnitId($orgUnitId)
                ->filterByOutletStatus('active')
                ->findOne();
            if (empty($outletView)) {
                $rowData[] = "Outlet not exsists!";
                $rowData[] = 0;
                $rowData[] = 0;
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // Check Has sgpi or not
            $dailycallsgpiOut = DailycallsSgpioutQuery::create()
                ->filterByDailycallId($dcrId)
                ->filterBySgpiId($sgpi->getPrimaryKey())
                ->filterByOutletId($outletView->getOutlet_Id())
                ->filterByOutletOrgdataId($outletView->getOutletOrgId())
                ->filterByEmployeeId($employee->getEmployeeId())
                ->findOne();

            if (empty($dailycallsgpiOut)) {
                $rowData[] = "Dailycall Sgpi Record not found!";
                $rowData[] = 0;
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if ($dailycallsgpiOut->getSgpiQty() != $sgpiQty) {
                $rowData[] = "Qty not matching";
                $rowData[] = 0;
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if ($updatedSgpiQty == 0) {
                // delete Sgpiout record and Sgpi trans record

                $sgpiTransRecord = SgpiTransQuery::create()
                    ->filterBySgpiId($dailycallsgpiOut->getSgpiId())
                    ->filterByQty($dailycallsgpiOut->getSgpiQty())
                    ->filterByVoucherNo($dailycallsgpiOut->getSgpiVoucherId())
                    ->filterByCd('D')
                    ->findOne();
                $newrecord = $rowData;
                $newrecord[] = 'sgpi_trans_record_remove';
                $newrecord[] = json_encode($sgpiTransRecord->toArray());
                $this->addDataToSuccessFile($newrecord);

                // delete sgpi voucher
                $sgpiTransRecord->delete();

                $newrecord = $rowData;
                $newrecord[] = 'dailycall_sgpiout_record_remove';
                $newrecord[] = json_encode($dailycallsgpiOut->toArray());
                $this->addDataToSuccessFile($newrecord);

                // delete dailycall sgpiout record
                $dailycallsgpiOut->delete();
            } else {
                // update Sgpiout record and Sgpi trans record

                $sgpiTransRecord = SgpiTransQuery::create()
                    ->filterBySgpiId($dailycallsgpiOut->getSgpiId())
                    ->filterByQty($dailycallsgpiOut->getSgpiQty())
                    ->filterByVoucherNo($dailycallsgpiOut->getSgpiVoucherId())
                    ->filterByCd('D')
                    ->findOne();

                // update Sgpi trans records
                $sgpiTransRecord->setQty($updatedSgpiQty);
                $sgpiTransRecord->save();

                $newrecord = $rowData;
                $newrecord[] = 'sgpi_trans_record_updated';
                $newrecord[] = json_encode($sgpiTransRecord->toArray());
                $this->addDataToSuccessFile($newrecord);

                // update dailycall sgpiout record
                $dailycallsgpiOut->setSgpiQty($updatedSgpiQty);
                $dailycallsgpiOut->save();

                $newrecord = $rowData;
                $newrecord[] = 'dailycall_sgpiout_record_updated';
                $newrecord[] = json_encode($dailycallsgpiOut->toArray());
                $this->addDataToSuccessFile($newrecord);
            }


            $rowData[] = 'Record Processed!';
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
        return true;
    }

    private function importCustomerDeletion($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Message');
            $firstRow = false;
            return true;
        }

        try {
            $orgUnitId = !empty($rowData[0]) ? $rowData[0] : null;
            $customerCode = !empty($rowData[1]) ? $rowData[1] : null;

            $outletOrgDataId = OutletViewQuery::create()
                ->select(['OutletOrgId'])
                ->filterByOutletCode($customerCode)
                ->filterByOrgUnitId($orgUnitId)
                ->filterByOutletStatus('active')
                ->filterByCompanyId($this->company_id)
                ->findOne();

            if (!empty($outletOrgDataId)) {
                $mapping = BeatOutletsQuery::create()
                    ->filterByBeatOrgOutlet($outletOrgDataId)
                    ->filterByStatus('active')
                    ->orderByActiveDate()
                    ->findOne();

                if (!empty($mapping)) {
                    $mapping->setStatus('inactive');
                    $mapping->setInactiveDate(date('Y-m-d H:i:s'));
                    $mapping->save();

                    $newrecord = $rowData;
                    $newrecord[] = 'patch_mapping_removed';
                    $newrecord[] = json_encode($mapping->toArray());
                    $this->addDataToSuccessFile($newrecord);
                } else {
                    $rowData[] = 0;
                    $rowData[] = "No active mapping found!";
                    $this->addDataToErrorFile($rowData);

                    return true;
                }

                // foreach($patchMappings as $record) {
                //     $newrecord = $rowData;
                //     $newrecord[] = 'patch_mapping_removed';
                //     $newrecord[] = json_encode($record->toArray());
                //     $this->addDataToSuccessFile($newrecord);

                //     $record->delete();
                // }
            } else {
                $rowData[] = 0;
                $rowData[] = "Outlet org data not found!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // $outlet = $this->getOutletRecordByCodeFromArray($customerCode);
            // if(empty($outlet))
            // {
            //     $rowData[] = 0;
            //     $rowData[] = "Outlet not exsists!";
            //     $this->addDataToErrorFile($rowData);

            //     return true;
            // } else {
            //     // $outletId = $outlet->getPrimaryKey();
            //     $outletId = $outlet;
            // }

            // $outletOrgData = OutletOrgDataQuery::create()
            //             ->filterByOutletId($outletId)
            //             ->filterByOrgUnitId($orgUnitId)
            //             ->filterByCompanyId($this->company_id)
            //             ->find();

            // if(!empty($outletOrgData)) {
            //     $patchMappings = BeatOutletsQuery::create()
            //                         ->filterByOutletOrgData($outletOrgData)
            //                         ->find();

            //     foreach($patchMappings as $record) {
            //         $newrecord = $rowData;
            //         $newrecord[] = 'patch_mapping_removed';
            //         $newrecord[] = json_encode($record->toArray());
            //         $this->addDataToSuccessFile($newrecord);

            //         $record->delete();
            //     }
            // } else {
            //     $rowData[] = 0;
            //     $rowData[] = "Outlet org data not found!";
            //     $this->addDataToErrorFile($rowData);

            //     return true;
            // }

        } catch (\Exception $e) {
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
        return true;
    }

    private function importSalaryBackDateTrackLog($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'ID');
            $firstRow = false;
            return true;
        }

        try {
            $employeeCode = !empty($rowData[0]) ? $rowData[0] : null;
            $employeeId = !empty($rowData[1]) ? $rowData[1] : null;
            $previousFromDate = !empty($rowData[2]) ? $rowData[2] : null;
            $previousToDate = !empty($rowData[3]) ? $rowData[3] : null;
            $previousToPreviousFromDate = !empty($rowData[4]) ? $rowData[4] : null;
            $previousToPreviousToDate = !empty($rowData[5]) ? $rowData[5] : null;
            $backdatePreviousDeductionDay = !empty($rowData[6]) ? $rowData[6] : null;
            $backdatePreviousDeductionDate = !empty($rowData[7]) ? $rowData[7] : null;
            $backdatePreviousToPreviousDay = !empty($rowData[8]) ? $rowData[8] : null;
            $backdatePreviousToPreviousDate = !empty($rowData[9]) ? $rowData[9] : null;
            $paidAmount = !empty($rowData[10]) ? $rowData[10] : null;

            // check if Employee record exists or not
            $employee = EmployeeQuery::create()
                ->filterByEmployeeId($employeeId)
                // ->filterByEmployeeCode($employeeCode)
                ->filterByCompanyId($this->company_id)
                ->findOne();

            if (empty($employee)) {
                $rowData[] = 0;
                $rowData[] = "Employee not found!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $record = SalaryAttendanceBackdateTrackLogQuery::create()
                ->filterByEmployeeId($employee->getPrimaryKey())
                ->filterByPreviousFromDate($previousFromDate)
                ->filterByPreviousToDate($previousToDate)
                ->filterByPreviousToPreviousFromDate($previousToPreviousFromDate)
                ->filterByPreviousToPreviousToDate($previousToPreviousToDate)
                ->findOne();

            if (empty($record)) {
                $record = new SalaryAttendanceBackdateTrackLog;
                $record->setEmployeeId($employee->getPrimaryKey());
                $record->setPreviousFromDate($previousFromDate);
                $record->setPreviousToDate($previousToDate);
                $record->setPreviousToPreviousFromDate($previousToPreviousFromDate);
                $record->setPreviousToPreviousToDate($previousToPreviousToDate);
            }

            $record->setBackdatePreviousDeductionDay($backdatePreviousDeductionDay);
            $record->setBackdatePreviousDeductionDate($backdatePreviousDeductionDate);
            $record->setBackdatePreviousToPreviousDay($backdatePreviousToPreviousDay);
            $record->setBackdatePreviousToPreviousDate($backdatePreviousToPreviousDate);
            $record->setPaidAmount($paidAmount);
            $record->save();

            $rowData[] = $record->getPrimaryKey();
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
        return true;
    }

    private function importOrganogramData($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Request ID');
            $firstRow = false;
            return true;
        }

        try {
            $positionCode = !empty($rowData[0]) ? $this->trimData($rowData[0]) : null;
            $positionName = !empty($rowData[1]) ? $this->trimData($rowData[1]) : null;
            $employeeCode = !empty($rowData[2]) ? $this->trimData($rowData[2]) : null;
            $employeeStatus = !empty($rowData[3]) ? $this->trimData(strtolower($rowData[3])) : null;
            $reportingToPositionCode = !empty($rowData[4]) ? $this->trimData($rowData[4]) : null;
            $positionIsVacant = !empty($rowData[5]) ? $this->trimData(strtolower($rowData[5])) : 'no';
            $positionActiveStatus = !empty($rowData[6]) ? $this->trimData(strtolower($rowData[6])) : null;
            $employeeDesignation = !empty($rowData[7]) ? $this->trimData($rowData[7], true) : null;
            $positionOrgunitName = !empty($rowData[8]) ? $this->trimData($rowData[8], true) : null;
            $employeeSubBuName = !empty($rowData[9]) ? $this->trimData($rowData[9]) : null;
            $employeeTown = !empty($rowData[10]) ? $this->trimData($rowData[10], true) : null;
            $positionBu = !empty($rowData[11]) ? $this->trimData($rowData[11]) : null;
            $positionFieldNonField = !empty($rowData[12]) ? $this->trimData($rowData[12]) : null;
            $employeeRole = !empty($rowData[13]) ? $this->trimData($rowData[13], true) : null;
            $employeeJobManager = !empty($rowData[14]) ? $this->trimData($rowData[14]) : null;
            $employeeZone = !empty($rowData[15]) ? $this->trimData($rowData[15]) : null;
            $positionLastModifiedBy = !empty($rowData[16]) ? $this->trimData($rowData[16]) : null;
            $positionLastModifiedDate = !empty($rowData[17]) ? $this->trimData($rowData[17]) : null;
            $employeeFirstName = !empty($rowData[18]) ? $this->trimData($rowData[18]) : null;
            $employeeLastName = !empty($rowData[19]) ? $this->trimData($rowData[19]) : null;
            $employeeDateOfJoining = !empty($rowData[20]) ? $this->trimData($rowData[20]) : null;
            $employeeBirthDate = !empty($rowData[21]) ? $this->trimData($rowData[21]) : null;
            $employeePhoneNumber = !empty($rowData[22]) ? $this->trimData($rowData[22]) : null;
            $employeeMobileNo = !empty($rowData[23]) ? $this->trimData($rowData[23]) : null;
            $employeeEmail = !empty($rowData[24]) ? $this->trimData($rowData[24]) : null;
            $employeeAddress1 = !empty($rowData[25]) ? $this->trimData($rowData[25]) : '';
            $employeeAddress2 = !empty($rowData[26]) ? $this->trimData($rowData[26]) : '';
            $employeeAddress3 = !empty($rowData[27]) ? $this->trimData($rowData[27]) : '';
            $employeeCity = !empty($rowData[28]) ? $this->trimData($rowData[28]) : '';
            $employeeState = !empty($rowData[29]) ? $this->trimData($rowData[29]) : '';
            $employeeZipcode = !empty($rowData[30]) ? $this->trimData($rowData[30]) : '';
            $parentPositionLocation = !empty($rowData[31]) ? $this->trimData($rowData[31]) : null;
            $offerCode = !empty($rowData[32]) ? $this->trimData($rowData[32]) : null;
            $employeeExpectedDateOfJoining = !empty($rowData[33]) ? $this->trimData($rowData[33]) : null;
            $employeeConfirmationDate = !empty($rowData[34]) ? $this->trimData($rowData[34]) : null;
            $employeeTransferDate = !empty($rowData[35]) ? $this->trimData($rowData[35]) : null;
            $employeeTransferLatterno = !empty($rowData[36]) ? $this->trimData($rowData[36]) : null;
            $employeeResignDate = !empty($rowData[37]) ? $this->trimData($rowData[37]) : null;
            $eventReason = !empty($rowData[38]) ? $this->trimData($rowData[38]) : 'New Hire';

            if (empty($positionName)) {
                $positionName = $employeeTown;
            }

            if (empty($positionCode) || empty($positionName) || empty($positionOrgunitName) || empty($positionIsVacant) || empty($eventReason)) {
                $rowData[] = 0;
                $rowData[] = "Please check required fields: postion_code, position_name, position_orgunitid, position_is_vacant and event_reason!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $eventReasonsArr = ['Confirmation Approval', 'Employee Data Change', 'Approval', 'New Hire', 'Transfer -Site', 'Promotion', 'Demotion', 'Probation Discountinue', 'Resignation', 'Sent Back from HRO', 'Absconding', 'Trainee Discontinue', 'Dismisal', 'Retirement', 'New Employee Code Creation', 'Position Code Change'];
            if (!in_array($eventReason, $eventReasonsArr)) {
                $rowData[] = 0;
                $rowData[] = "event_reason should be " . implode(',', $eventReasonsArr) . "!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!in_array($positionIsVacant, ['yes', 'no'])) {
                $rowData[] = 0;
                $rowData[] = "position_is_vacant should be yes or no!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $employeeBranch = strtolower($employeeState);
            $employeeGrade = $this->getGradeFromPositionCode($positionCode);
            $employeeRole = $this->getRoleFromPositionCode($positionCode);
            $employeeBaseMonthlyTarget = null;
            $employeeProbationDate = null;
            $employeeTrainingStartDate = null;
            $employeeTrainingEndDate = null;
            // $employeeBranch = !empty($rowData[15]) ? $rowData[15] : null;
            // $employeeGrade = !empty($rowData[16]) ? $rowData[16] : null;
            // $employeeResiAddress = !empty($rowData[17]) ? $rowData[17] : null;

            $reportingToID = $orgUnitId = $empBranchId = $empGradeId = $empDesignationId = $empRoleId = $empTownId = 0;

            if (strtolower($positionOrgunitName) == 'pharma') {
                $positionOrgunitName = 'Alembic Pharma';
            }

            $transactionType = $this->getTransactionTypeFromEventReason($eventReason);

            if (!in_array($transactionType, ['new_position_with_employee', 'new_position_without_employee', 'update_position', 'update_employee_details', 'employee_confirmed', 'employee_resigned', 'employee_position_change', 'employee_code_change', 'position_code_change'])) {
                $rowData[] = 0;
                $rowData[] = "transaction_type should be new_position_with_employee, new_position_without_employee, update_position, update_employee_details, employee_confirmed, employee_resigned, employee_position_change, employee_code_change, position_code_change!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if ($positionIsVacant == 'no' && (empty($employeeCode) || empty($employeeStatus) || empty($employeeFirstName) || empty($employeeMobileNo) || empty($employeeEmail) || empty($employeeDesignation) || empty($employeeRole) || empty($employeeBranch) || empty($employeeGrade))) {
                $rowData[] = 0;
                $rowData[] = "Please check required fields when position is not vacant: employee_code, employee_status, employee_first_name, employee_mobile_no, employee_email, employee_designation, employee_role, employee_branch, employee_grade";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!empty($employeeMobileNo) && !preg_match('/^[0-9]{10}+$/', $employeeMobileNo)) {
                $rowData[] = 0;
                $rowData[] = "Please enter valid mobile number format!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if ($transactionType == 'employee_confirmed' && empty($employeeConfirmationDate)) {
                $rowData[] = 0;
                $rowData[] = "Confirmation date required when employee confirmed!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if ($transactionType == 'employee_resigned' && empty($employeeResignDate)) {
                $rowData[] = 0;
                $rowData[] = "Resign date required when employee resigned!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if ($transactionType == 'employee_position_change' && empty($employeeTransferDate)) {
                $rowData[] = 0;
                $rowData[] = "Transfer date required when position change";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!empty($reportingToPositionCode)) {
                $reportingTo = $this->getPositionRecordByCodeFromArray($reportingToPositionCode);
                if (empty($reportingTo)) {
                    $rowData[] = 0;
                    $rowData[] = "Report to position not exsists!";
                    $this->addDataToErrorFile($rowData);

                    return true;
                }

                $reportingToID = $reportingTo;
            }

            if (in_array($transactionType, ['new_position_with_employee', 'new_position_without_employee'])) {
                $positionId = $this->getPositionRecordByCodeFromArray($positionCode);
                if (empty($positionId)) {
                    $rowData[] = 0;
                    $rowData[] = "Position not found to get base town!";
                    $this->addDataToErrorFile($rowData);

                    return true;
                }

                if (!in_array($employeeStatus, ['active', 'terminated'])) {
                    $employeeStatus = 'active';
                }

                // check if already have employee
                $checkEmployee = EmployeeQuery::create()
                    ->filterByPhone($employeeMobileNo)
                    ->filterByPositionId($positionId)
                    ->filterByCompanyId($this->company_id)
                    ->findOne();
                if (!empty($checkEmployee)) {
                    $transactionType = 'employee_code_change';
                }

                // $this->positionListArray[$positionCode] = $positionCode;
            }

            // $orgUnitId = $this->getOrgUnitRecordByIdFromArray($positionOrgunitid);
            $orgUnitId = $this->getOrgUnitRecordByNameFromArray($positionOrgunitName);
            if (empty($orgUnitId)) {
                $rowData[] = 0;
                $rowData[] = "Org unit not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!empty($employeeStatus) && !in_array($employeeStatus, ['active', 'terminated'])) {
                $rowData[] = 0;
                $rowData[] = "Employee statuis should be active / terminated!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!empty($employeeMobileNo) && !in_array($transactionType, ['employee_code_change'])) { // TSPC-881
                $check = EmployeeQuery::create()
                    ->filterByPhone($employeeMobileNo)
                    ->filterByEmployeeCode($employeeCode, Criteria::NOT_EQUAL)
                    ->findOne();

                if (!empty($check)) {
                    $rowData[] = 0;
                    $rowData[] = "Employee with the same mobile number exsists!";
                    $this->addDataToErrorFile($rowData);

                    return true;
                }
            }

            if (!empty($employeeBranch)) {
                $empBranchId = $this->getBranchRecordByCodeFromArray($employeeBranch);
                if (empty($empBranchId)) {
                    $rowData[] = 0;
                    $rowData[] = "Branch not exsists!";
                    $this->addDataToErrorFile($rowData);

                    return true;
                }
            }

            if (!empty($employeeGrade)) {
                $grade = GradeMasterQuery::create()
                    ->filterByGradeName($employeeGrade)
                    ->findOne();

                if (!empty($grade)) {
                    $empGradeId = $grade->getPrimaryKey();
                } else {
                    $rowData[] = 0;
                    $rowData[] = "Grade not exsists!";
                    $this->addDataToErrorFile($rowData);

                    return true;
                }
            }

            if (!empty($employeeRole)) {
                $role = RolesQuery::create()
                    ->filterByRoleName($employeeRole)
                    ->findOne();

                if (!empty($role)) {
                    $empRoleId = $role->getPrimaryKey();
                } else {
                    $rowData[] = 0;
                    $rowData[] = "Role not exsists!";
                    $this->addDataToErrorFile($rowData);

                    return true;
                }
            }

            if (!empty($employeeDesignation)) {
                $designation = DesignationsQuery::create()
                    ->filterByDesignation($employeeDesignation)
                    ->findOne();

                if (!empty($designation)) {
                    $empDesignationId = $designation->getPrimaryKey();
                } else {
                    $rowData[] = 0;
                    $rowData[] = "Designation not exsists!";
                    $this->addDataToErrorFile($rowData);
                    return true;

                    // $designation = new Designations();
                    // $designation->setCompanyId($this->company_id);
                    // $designation->setDesignation($employeeDesignation);
                    // $designation->save();
                    // $empDesignationId = $designation->getPrimaryKey();
                }
            }

            // Update - Will get town from the positions
            // if(!empty($employeeTown)) {
            //     $townId = $this->getTownRecordByCodeFromArray($employeeTown);
            //     if(empty($townId)) {
            //         $rowData[] = 0;
            //         $rowData[] = "Town not exsists!";
            //         $this->addDataToErrorFile($rowData);

            //         return true;
            //     } else {
            //         $empTownId = $townId;
            //     }
            // }

            if (!empty($employeeBirthDate) && !$this->validateDate($employeeBirthDate)) {
                $rowData[] = 0;
                $rowData[] = "Enter valid birth date : format: dd-mm-yyyy!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!empty($employeeDateOfJoining) && !$this->validateDate($employeeDateOfJoining)) {
                $rowData[] = 0;
                $rowData[] = "Enter valid date of joining : format: dd-mm-yyyy!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!empty($employeeProbationDate) && !$this->validateDate($employeeProbationDate)) {
                $rowData[] = 0;
                $rowData[] = "Enter valid probation date : format: dd-mm-yyyy!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!empty($employeeTrainingStartDate) && !$this->validateDate($employeeTrainingStartDate)) {
                $rowData[] = 0;
                $rowData[] = "Enter valid training start date : format: dd-mm-yyyy!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!empty($employeeTrainingEndDate) && !$this->validateDate($employeeTrainingEndDate)) {
                $rowData[] = 0;
                $rowData[] = "Enter valid training end date : format: dd-mm-yyyy!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!empty($employeeConfirmationDate) && !$this->validateDate($employeeConfirmationDate)) {
                $rowData[] = 0;
                $rowData[] = "Enter valid confirmation date : format: dd-mm-yyyy!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!empty($employeeTransferDate) && !$this->validateDate($employeeTransferDate)) {
                $rowData[] = 0;
                $rowData[] = "Enter valid transfer date : format: dd-mm-yyyy!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!empty($employeeResignDate) && !$this->validateDate($employeeResignDate)) {
                $rowData[] = 0;
                $rowData[] = "Enter valid resign date : format: dd-mm-yyyy!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!empty($employeeExpectedDateOfJoining) && !$this->validateDate($employeeExpectedDateOfJoining)) {
                $rowData[] = 0;
                $rowData[] = "Enter valid expected date of joining : format: dd-mm-yyyy!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // if (!empty($employeeResignDate) && date('Y-m-d', strtotime($employeeResignDate)) <= date('Y-m-d')) {
            //     $rowData[] = 0;
            //     $rowData[] = "The resign date should be future date!";
            //     $this->addDataToErrorFile($rowData);

            //     return true;
            // }

            $employeeResiAddress = (!empty($employeeAddress1) ? $employeeAddress1 . ',' : '') . (!empty($employeeAddress2) ? $employeeAddress2 . ',' : '') . (!empty($employeeAddress3) ? $employeeAddress3 . ',' : '') . (!empty($employeeCity) ? $employeeCity . ',' : '') . (!empty($employeeState) ? $employeeState . ',' : '') . $employeeZipcode;

            $data = [
                'positionCode'                  => $positionCode,
                'positionName'                  => $positionName,
                'reportingToPositionCode'       => $reportingToPositionCode,
                'positionOrgunitid'             => $orgUnitId,
                'positionIsVacant'              => $positionIsVacant,
                'employeeCode'                  => $employeeCode,
                'employeeStatus'                => $employeeStatus,
                'employeeFirstName'             => $employeeFirstName,
                'employeeLastName'              => $employeeLastName,
                'employeeEmail'                 => $employeeEmail,
                'employeeMobileNo'              => $employeeMobileNo,
                'employeeDesignation'           => $employeeDesignation,
                'employeeRole'                  => $employeeRole,
                'employeeBaseMonthlyTarget'     => $employeeBaseMonthlyTarget,
                'employeeTown'                  => $employeeTown,
                'employeeBranch'                => $employeeBranch,
                'employeeGrade'                 => $employeeGrade,
                'employeeResiAddress'           => $employeeResiAddress,
                'employeeBirthDate'             => $employeeBirthDate,
                'employeeDateOfJoining'         => $employeeDateOfJoining,
                'employeeProbationDate'         => $employeeProbationDate,
                'employeeTrainingStartDate'     => $employeeTrainingStartDate,
                'employeeTrainingEndDate'       => $employeeTrainingEndDate,
                'employeeConfirmationDate'      => $employeeConfirmationDate,
                'employeeTransferDate'          => $employeeTransferDate,
                'employeeTransferLatterno'      => $employeeTransferLatterno,
                'employeeResignDate'            => $employeeResignDate,
                'transactionType'               => $transactionType,
                'positionActiveStatus'          => $positionActiveStatus,
                'positionIsVacant'              => $positionIsVacant,
                'positionFieldNonField'         => $positionFieldNonField,
                'positionLastModifiedBy'        => $positionLastModifiedBy,
                'positionLastModifiedDate'      => $positionLastModifiedDate,
                'offerCode'                     => $offerCode,
                'employeeExpectedDateOfJoining' => $employeeExpectedDateOfJoining,
                'companyId'                     => $this->company_id
            ];

            if ($transactionType == 'employee_position_change') {
                $scheduleDate = !empty($employeeTransferDate) ? date('Y-m-d', strtotime($employeeTransferDate)) : date('Y-m-d');
            } elseif ($transactionType == 'employee_resigned') {
                $scheduleDate = !empty($employeeResignDate) ? date('Y-m-d', strtotime($employeeResignDate)) : date('Y-m-d');;
            } else {
                $scheduleDate = date('Y-m-d');
            }

            $newRequest = new DataChangeRequests;
            $newRequest->setImportTemplate('Organogram');
            $newRequest->setImportFilePath($this->importLog->getFilePath());
            $newRequest->setImportFileLogId($this->importLog->getFtpImportLogId());
            $newRequest->setRequestedData(json_encode($data));
            $newRequest->setActionType($transactionType);
            $newRequest->setScheduleDate($scheduleDate);
            $newRequest->setStatus('pending');
            $newRequest->save();

            $rowData[] = $newRequest->getPrimaryKey();
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
        return true;
    }

    private function getTransactionTypeFromEventReason($eventReason)
    {
        if (in_array($eventReason, ['Confirmation Approval'])) {
            return 'employee_confirmed';
        } elseif (in_array($eventReason, ['Employee Data Change', 'Approval'])) {
            return 'update_employee_details';
        } elseif (in_array($eventReason, ['New Hire'])) {
            return 'new_position_with_employee';
        } elseif (in_array($eventReason, ['Transfer -Site', 'Promotion', 'Demotion'])) {
            return 'employee_position_change';
        } elseif (in_array($eventReason, ['Probation Discountinue', 'Resignation', 'Sent Back from HRO', 'Absconding', 'Trainee Discontinue', 'Dismisal', 'Retirement'])) {
            return 'employee_resigned';
        } elseif (in_array($eventReason, ['New Employee Code Creation'])) {
            return 'employee_code_change';
        } elseif (in_array($eventReason, ['Position Code Change'])) {
            return 'position_code_change';
        }
    }

    private function trimData($data, $isWithId = false)
    {
        if ($isWithId && stripos($data, " (") !== false) {
            $data = str_replace(substr($data, stripos($data, " (")), '', $data);
        }
        $data = trim($data);
        $data = preg_replace('/[^a-zA-Z0-9_ %\[\].()%&\-,]/s', '', $data);
        return $data;
    }

    private function getRoleFromPositionCode($positionCode)
    {
        if (str_starts_with($positionCode, '1')) {
            return 'MR';
        } elseif (str_starts_with($positionCode, '2')) {
            return 'ASM';
        } elseif (str_starts_with($positionCode, '3') || str_starts_with($positionCode, '4')) {
            return 'RSM';
        } elseif (str_starts_with($positionCode, '5')) {
            return 'NSM';
        }

        return '';
    }

    private function getGradeFromPositionCode($positionCode)
    {
        if (str_starts_with($positionCode, '1')) {
            return 'MR';
        } elseif (str_starts_with($positionCode, '2')) {
            return 'AM';
        } elseif (str_starts_with($positionCode, '3')) {
            return 'RM';
        } elseif (str_starts_with($positionCode, '4')) {
            return 'ZM';
        }

        return '';
    }

    private function importBrandCampaignOutlets($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'brandCampaignOutlet ID');
            $firstRow = false;
            return true;
        }

        try {
            $brandCampaignCode = !empty($rowData[0]) ? $rowData[0] : null;
            $outletOrgCode = !empty($rowData[1]) ? $rowData[1] : null;
            $isSelected = !empty($rowData[2]) ? strtolower($rowData[2]) : null;
            $campaignPositions = $campaignTerritoryIds = [];

            //Check for selected value
            if (!in_array($isSelected, ['y', 'n'])) {
                $rowData[] = 0;
                $rowData[] = "Selected value should be y or n!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            //Get Brand Campaign Details
            $campaign = BrandCampiagnQuery::create()
                ->filterByBrandCampiagnCode($brandCampaignCode)
                ->filterByCompanyId($this->company_id)
                ->findOne();

            if (empty($campaign)) {
                $rowData[] = 0;
                $rowData[] = "Brand Campaign not found!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            //Get Outlet details
            $outlet = OutletViewQuery::create()
                ->filterByOutletCode($outletOrgCode)
                ->filterByCompanyId($this->company_id)
                ->filterByOutletStatus('active')
                ->findOne();
            if (empty($outlet)) {
                $rowData[] = 0;
                $rowData[] = "Outlet not found!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // Check Campaign type
            if ($campaign->getCampiagnType() == 'Open') {
                $rowData[] = 0;
                $rowData[] = "Campaign type is Open, can not add outlet!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // Check Campaign Status
            if (!in_array($campaign->getStatus(), ['Published', 'Draft'])) {
                $rowData[] = 0;
                $rowData[] = "Campaign status should be draft or published!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // Check if BU matched
            if ($outlet->getOrgUnitId() != $campaign->getOrgUnitId()) {
                $rowData[] = 0;
                $rowData[] = "outlet org unit not allowed for this brand campaign!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // Check if outlet type matched
            if ($outlet->getOutlettypeId() != $campaign->getOutlettypeId()) {
                $rowData[] = 0;
                $rowData[] = "Outlet type is not allowed for this brand campiagn!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // Check if outlet is under allowed positions
            if ($campaign->getPosition() != null && $campaign->getPosition() != "") {
                $campaignPositions = explode(',', $campaign->getPosition());
            }

            if ($campaignPositions != null && count($campaignPositions) > 0) {
                $campaignTerritoryIds = TerritoriesQuery::create()
                    ->select(['TerritoryId'])
                    ->filterByPositionId($campaignPositions)
                    ->find()->toArray();
            } else {
                $rowData[] = 0;
                $rowData[] = "Brand campaign position not found!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!in_array($outlet->getTerritoryId(), $campaignTerritoryIds)) {
                $rowData[] = 0;
                $rowData[] = "Outlet not in brand campaing territories!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // Check if outlet classification is allowed
            $campaignClassifications = BrandCampiagnClassificationQuery::create()
                ->select(['ClassificationId'])
                ->filterByBrandCampiagnId($campaign->getPrimaryKey())
                ->find()->toArray();

            if ($campaignClassifications != null && count($campaignClassifications) > 0 && !in_array($outlet->getOutletClassification(), $campaignClassifications)) {
                $rowData[] = 0;
                $rowData[] = "Outlet claasification not allowed for this brand campaign!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // check SGPI Tagged
            $campaignSgpiBrands = $campaign->getSgpiBrands();

            if (!empty($campaignSgpiBrands)) {
                $passSgpiCheck = false;
                $campaignSgpiBrands = explode(',', $campaignSgpiBrands);

                if (array_search("0", $campaignSgpiBrands) && empty($outlet->getSgpiBrandIdMap())) {
                    $passSgpiCheck = true;
                } else {
                    if (!empty($outlet->getSgpiBrandIdMap())) {
                        $outletSgpiBrands = explode(',', $outlet->getSgpiBrandIdMap());
                        $result = array_intersect($campaignSgpiBrands, $outletSgpiBrands);
                        if (count($result) > 0) {
                            $passSgpiCheck = true;
                        }
                    }
                }
            } else {
                $passSgpiCheck = true;
            }

            if (!$passSgpiCheck) {
                $rowData[] = 0;
                $rowData[] = "Outlet sgpi brands not allowed for this brand campaign!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $brandCampaignOutlet = \entities\BrandCampiagnDoctorsQuery::create()
                ->filterByBrandCampiagnId($campaign->getPrimaryKey())
                ->filterByOutletOrgDataId($outlet->getOutletOrgId())
                ->filterByCompanyId($outlet->getCompanyId())
                ->findOne();
            if (!empty($brandCampaignOutlet)) {
                // $rowData[] = 0;
                // $rowData[] = "Record already exists!";
                // $this->addDataToErrorFile($rowData);

                // return true;
                $brandCampaignOutlet = new \entities\BrandCampiagnDoctors();
                $brandCampaignOutlet->setBrandCampiagnId($campaign->getPrimaryKey());
                $brandCampaignOutlet->setOutletId($outlet->getOutlet_Id());
                $brandCampaignOutlet->setOutletOrgDataId($outlet->getOutletOrgId());
                $brandCampaignOutlet->setCompanyId($outlet->getCompanyId());
                $brandCampaignOutlet->setPositionId($outlet->getPositionId());
                $brandCampaignOutlet->setClassificationId($outlet->getOutletClassification());
            }

            $brandCampaignOutlet->setSelected(($isSelected == 'y' ? true : false));
            $brandCampaignOutlet->save();

            $rowData[] = $brandCampaignOutlet->getPrimaryKey();
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
        return true;
    }

    private function importCustomerMasterData($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'DataChangeRequest ID');
            $firstRow = false;
            return true;
        }

        try {
            $outletCode = !empty($rowData[0]) ? $this->trimData($rowData[0]) : null;
            $outletOrgCode = !empty($rowData[1]) ? $this->trimData($rowData[1]) : null;
            $orgUnitId = !empty($rowData[2]) ? $this->trimData($rowData[2]) : null;
            $salutation = !empty($rowData[3]) ? strtoupper($this->trimData($rowData[3])) : null;
            $customerName = !empty($rowData[4]) ? $this->trimData($rowData[4]) : null;
            $customerType = !empty($rowData[5]) ? $this->trimData($rowData[5]) : null;
            $classification = !empty($rowData[6]) ? $this->trimData($rowData[6]) : null;
            $contactName = !empty($rowData[7]) ? $this->trimData($rowData[7]) : null;
            $openingDate = !empty($rowData[8]) ? $this->trimData($rowData[8]) : null;
            $contactNumber = !empty($rowData[9]) ? $this->trimData($rowData[9]) : null;
            $landlineNumber = !empty($rowData[10]) ? $this->trimData($rowData[10]) : null;
            $customerEmail = !empty($rowData[11]) ? $this->trimData($rowData[11]) : null;
            $townCode = !empty($rowData[12]) ? $this->trimData($rowData[12]) : null;
            $birthdate = !empty($rowData[13]) ? $this->trimData($rowData[13]) : null;
            $anniversary = !empty($rowData[14]) ? $this->trimData($rowData[14]) : null;
            $potentialMonthlyBill = !empty($rowData[15]) ? $this->trimData($rowData[15]) : null;
            $registrationNo = !empty($rowData[16]) ? $this->trimData($rowData[16]) : null;
            $qualification = !empty($rowData[17]) ? $this->trimData($rowData[17]) : null;
            $maritalStatus = !empty($rowData[18]) ? strtolower($this->trimData($rowData[18])) : null;
            $addressType = !empty($rowData[19]) ? $this->trimData($rowData[19]) : null;
            $address = !empty($rowData[20]) ? $this->trimData($rowData[20]) : null;
            $street = !empty($rowData[21]) ? $this->trimData($rowData[21]) : null;
            $city = !empty($rowData[22]) ? $this->trimData($rowData[22]) : null;
            $state = !empty($rowData[23]) ? $this->trimData($rowData[23]) : null;
            $pincode = !empty($rowData[24]) ? $this->trimData($rowData[24]) : null;
            $visitFrequency = !empty($rowData[25]) ? $this->trimData($rowData[25]) : null;
            $potential = !empty($rowData[26]) ? $this->trimData($rowData[26]) : null;
            $brandFocus = !empty($rowData[27]) ? $this->trimData($rowData[27]) : null;
            $customerFrequency = !empty($rowData[28]) ? $this->trimData($rowData[28]) : null;
            $tags = !empty($rowData[29]) ? $this->trimData($rowData[29]) : null;
            $territoryCode = !empty($rowData[30]) ? strtolower($this->trimData($rowData[30])) : null;
            $beatCode = !empty($rowData[31]) ? strtolower($this->trimData($rowData[31])) : null;
            $action = !empty($rowData[32]) ? $this->trimData($rowData[32]) : null;
            $OutletOrgId = $territoryId = $townId = $outletTypeId = $classificationId = $outletId = $addressId = null;

            //Check for selected value
            if (!in_array($action, ['new_record', 'update_customer_details', 'update_address_details', 'update_customer_bu_details', 'patch_territory_transfer', 'update_all_details', 'update_all_details_and_transfer'])) {
                $rowData[] = 0;
                $rowData[] = "Action should be new_record, update_customer_details, update_address_details, update_customer_bu_details, patch_territory_transfer, 'update_all_details', 'update_all_details_and_transfer'!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (in_array($action, ['new_record', 'update_all_details', 'update_all_details_and_transfer']) && (empty($orgUnitId) || empty($customerName) || empty($customerType) || empty($classification) || empty($contactName) || empty($townCode) || empty($addressType) || empty($address) || empty($city) || empty($state) || empty($pincode) || empty($territoryCode) || empty($beatCode))) {
                $rowData[] = 0;
                $rowData[] = "Please check required field for new_record : org_unit_id, customerName, customerType, classification, contactName, townCode, addressType, address, city, state, pincode, territoryCode, beatCode!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (in_array($action, ['update_customer_details', 'update_all_details', 'update_all_details_and_transfer']) && (empty($outletCode) || empty($outletOrgCode) || empty($orgUnitId) || empty($salutation) || empty($customerName) || empty($customerType) || empty($classification) || empty($contactName) || empty($townCode))) {
                $rowData[] = 0;
                $rowData[] = "Please check required field for update_customer_details : customerCode, legacyCode, org_unit_id, salutation, customerName, customerType, classification, contactName, townCode!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (in_array($action, ['new_record', 'update_customer_details'])) {
                if (empty($contactNumber)) {
                    $rowData[] = 0;
                    $rowData[] = "Please check required field : contactNumber";
                    $this->addDataToErrorFile($rowData);

                    return true;
                } else if (strlen($contactNumber) != 10) {
                    $rowData[] = 0;
                    $rowData[] = "Contact Number should be of 10 digits";
                    $this->addDataToErrorFile($rowData);

                    return true;
                } else {
                    $record = OutletsQuery::create()
                                ->filterByOutletContactNo($contactNumber)
                                ->filterByOutletCode($outletCode, Criteria::NOT_EQUAL)
                                ->findOne();

                    if (!empty($record)) {
                        $record_id = $record->getPrimaryKey();

                        $rowData[] = $record_id;
                        $rowData[] = "Outlet contact no already exsists";
                        $this->addDataToErrorFile($rowData);

                        return true;
                    }
                }
            }

            if (in_array($action, ['update_address_details', 'update_all_details', 'update_all_details_and_transfer']) && (empty($outletCode) || empty($outletOrgCode) || empty($orgUnitId) || empty($addressType) || empty($address) || empty($city) || empty($state) || empty($pincode))) {
                $rowData[] = 0;
                $rowData[] = "Please check required field for update_address_details : customerCode, legacyCode, org_unit_id, addressType, address, city, state, pincode!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (in_array($action, ['update_customer_bu_details', 'update_all_details', 'update_all_details_and_transfer']) && (empty($outletCode) || empty($outletOrgCode) || empty($orgUnitId))) {
                $rowData[] = 0;
                $rowData[] = "Please check required field for update_customer_bu_details : customerCode, legacyCode, org_unit_id!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (in_array($action, ['patch_territory_transfer', 'update_all_details_and_transfer']) && (empty($outletCode) || empty($outletOrgCode) || empty($orgUnitId) || empty($territoryCode) || empty($beatCode))) {
                $rowData[] = 0;
                $rowData[] = "Please check required field for patch_territory_transfer : customerCode, legacyCode, org_unit_id, territoryCode, beatCode!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            // commeted because on onboarding it's not mandatory
            // if (!empty($salutation) && !in_array($salutation, ['MR', 'MRS', 'DR'])) {
            //     $rowData[] = 0;
            //     $rowData[] = "Salutation should be MR, MRS, DR!";
            //     $this->addDataToErrorFile($rowData);

            //     return true;
            // }

            // if (!empty($customerType) && !in_array($customerType, ['Doctor', 'Pharmacy', 'Stockist'])) {
            //     $rowData[] = 0;
            //     $rowData[] = "Customer type should be Doctor, Pharmacy, Stockist!";
            //     $this->addDataToErrorFile($rowData);

            //     return true;
            // }

            if (!empty($maritalStatus) && !in_array($maritalStatus, ['married', 'single', 'divorsed'])) {
                $rowData[] = 0;
                $rowData[] = "Marital status should be Married, Single, Divorsed!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!empty($addressType) && !in_array($addressType, ['Clinic', 'Hospital', 'Residential', 'Commercial'])) {
                $rowData[] = 0;
                $rowData[] = "Address type should be Clinic, Hospital, Residential, Commercial!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!empty($action) && $action != 'new_record') {
                $OutletOrgId = $this->getOutletOrgDataRecordByCodeFromArray($outletOrgCode);

                if (empty($OutletOrgId)) {
                    $rowData[] = 0;
                    $rowData[] = "No record found with customer code!";
                    $this->addDataToErrorFile($rowData);

                    return true;
                }

                $oodRecord = OutletOrgDataQuery::create()
                    ->filterByOutletOrgId($OutletOrgId)
                    ->findOne();

                if (!empty($oodRecord)) {
                    $outletId = $oodRecord->getOutletId();
                    $addressId = $oodRecord->getDefaultAddress();

                    $legacyCode = $oodRecord->getOutlets()->getOutletCode();

                    if ($legacyCode != $outletCode) {
                        $rowData[] = 0;
                        $rowData[] = "Legacy code not match with customer code!";
                        $this->addDataToErrorFile($rowData);

                        return true;
                    }
                } else {
                    $rowData[] = 0;
                    $rowData[] = "No record found with customer code!";
                    $this->addDataToErrorFile($rowData);

                    return true;
                }
            }

            $orgUnitId = $this->getOrgUnitRecordByIdFromArray($orgUnitId);
            if (empty($orgUnitId)) {
                $rowData[] = 0;
                $rowData[] = "BU not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $territoryId = $this->getTerritoryRecordByCodeFromArray($territoryCode, $orgUnitId);
            if (empty($territoryId)) {
                $rowData[] = 0;
                $rowData[] = "Territory not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $townId = $this->getTownRecordByCodeFromArray($townCode);
            if (empty($townId)) {
                $rowData[] = 0;
                $rowData[] = "Town not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $OutlettypeId = $this->getOutletTypeRecordByNameFromArray($customerType);
            if (empty($OutlettypeId)) {
                $rowData[] = 0;
                $rowData[] = "Customer type not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!empty($openingDate) && !$this->validateDate($openingDate)) {
                $rowData[] = 0;
                $rowData[] = "Enter valid opening date : format: dd-mm-yyyy!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!empty($birthdate) && !$this->validateDate($birthdate)) {
                $rowData[] = 0;
                $rowData[] = "Enter valid opening date : format: dd-mm-yyyy!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!empty($anniversary) && !$this->validateDate($anniversary)) {
                $rowData[] = 0;
                $rowData[] = "Enter valid opening date : format: dd-mm-yyyy!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!empty($classification)) {
                // check if classification name exists or not
                $classificationRecord = ClassificationQuery::create()
                    ->filterByClassification($classification)
                    ->filterByOrgunitid($orgUnitId)
                    ->filterByCompanyId($this->company_id)
                    ->findOne();

                if (!empty($classificationRecord)) {
                    $classificationId = $classificationRecord->getPrimaryKey();
                } else {
                    $classificationRecord = new Classification();
                    $classificationRecord->setClassification($classification);
                    $classificationRecord->setOrgunitid($orgUnitId);
                    $classificationRecord->setCompanyId($this->company_id);
                    $classificationRecord->save();

                    $classificationId = $classificationRecord->getPrimaryKey();
                }
            }

            if (!empty($customerEmail)) {
                $record = OutletsQuery::create()
                    ->filterByOutletEmail($customerEmail)
                    ->filterByOutletCode($outletCode, Criteria::NOT_EQUAL)
                    ->findOne();

                if (!empty($record)) {
                    $record_id = $record->getPrimaryKey();

                    $rowData[] = $record_id;
                    $rowData[] = "Outlet email already exsists";
                    $this->addDataToErrorFile($rowData);

                    return true;
                }
            }

            if (!empty($registrationNo)) {
                $record = OutletsQuery::create()
                    ->filterByOutletRegno($registrationNo)
                    ->filterByOutletCode($outletCode, Criteria::NOT_EQUAL)
                    ->findOne();

                if (!empty($record)) {
                    $record_id = $record->getPrimaryKey();

                    $rowData[] = $record_id;
                    $rowData[] = "Outlet registration no already exsists";
                    $this->addDataToErrorFile($rowData);

                    return true;
                }
            }

            $data = [
                'outletCode'           => $outletCode,
                'outletOrgCode'        => $outletOrgCode,
                'orgUnitId'            => $orgUnitId,
                'salutation'           => $salutation,
                'customerName'         => $customerName,
                'customerType'         => $customerType,
                'classification'       => $classification,
                'contactName'          => $contactName,
                'openingDate'          => $openingDate,
                'contactNumber'        => $contactNumber,
                'landlineNumber'       => $landlineNumber,
                'customerEmail'        => $customerEmail,
                'townCode'             => $townCode,
                'birthdate'            => $birthdate,
                'anniversary'          => $anniversary,
                'potentialMonthlyBill' => $potentialMonthlyBill,
                'registrationNo'       => $registrationNo,
                'qualification'        => $qualification,
                'maritalStatus'        => !empty($maritalStatus) ? strtoupper(substr($maritalStatus, 0, 1)) : null,
                'addressType'          => $addressType,
                'address'              => $address,
                'street'               => $street,
                'city'                 => $city,
                'state'                => $state,
                'pincode'              => $pincode,
                'visitFrequency'       => $visitFrequency,
                'potential'            => $potential,
                'brandFocus'           => $brandFocus,
                'customerFrequency'    => $customerFrequency,
                'tags'                 => $tags,
                'territoryCode'        => $territoryCode,
                'beatCode'             => $beatCode,
                'action'               => $action,
                'OutletOrgId'          => $OutletOrgId,
                'territoryId'          => $territoryId,
                'townId'               => $townId,
                'outletTypeId'         => $OutlettypeId,
                'classificationId'     => $classificationId,
                'companyId'            => $this->company_id,
                'outletId'             => $outletId,
                'addressId'            => $addressId
            ];

            switch ($action) {
                case 'new_record':
                    $response = $this->newCustomerMasterRecordAction($data);
                    break;

                case 'update_customer_details':
                    if (empty($data['outletId'])) {
                        $response = ['status' => 'failed', 'hasError' => 1, 'errorMessage' => 'Outlet record not found!', 'transactionId' => ''];
                    } else {
                        $response = $this->addOrUpdateOutletsData($data);
                    }
                    break;

                case 'update_address_details':
                    if (empty($data['addressId'])) {
                        $response = ['status' => 'failed', 'hasError' => 1, 'errorMessage' => 'Address record not found!', 'transactionId' => ''];
                    } else {
                        $response = $this->addOrUpdateOutletAddressData($data);
                    }
                    break;

                case 'update_customer_bu_details':
                    if (empty($data['OutletOrgId'])) {
                        $response = ['status' => 'failed', 'hasError' => 1, 'errorMessage' => 'Outlet org data record not found!', 'transactionId' => ''];
                    } else {
                        $response = $this->addOrUpdateOutletOrgData($data);
                    }
                    break;

                case 'patch_territory_transfer':
                    if ($this->isActivePatchMappingExists($data)) {
                        $response = ['status' => 'failed', 'hasError' => 1, 'errorMessage' => 'Mapping already exists!', 'transactionId' => ''];
                    } else {
                        $response = $this->removeBeatMappingforOutletOrgData($data);
                        if ($response['status'] == 'failed') {
                            // $rowData[] = $response['errorMessage'];
                            // $this->addDataToErrorFile($rowData);
                        } else {
                            $successIds = ['removed_ids' => $response['transactionId']];
                            $response = $this->addBeatMappingforOutletOrgData($data);
                            $successIds = ['added_ids' => $response['transactionId']];
                            $response['transactionId'] = $successIds;
                        }
                    }
                    break;

                case 'update_all_details':
                    if (empty($data['outletId'])) {
                        $response = ['status' => 'failed', 'hasError' => 1, 'errorMessage' => 'Outlet record not found!', 'transactionId' => ''];
                    } else {
                        $response = $this->addOrUpdateOutletsData($data);
                        if ($response['status'] == 'failed' || empty($response['transactionId'])) {
                            // will be return from here
                        } else {
                            if (empty($data['addressId'])) {
                                $response = ['status' => 'failed', 'hasError' => 1, 'errorMessage' => 'Address record not found!', 'transactionId' => ''];
                            } else {
                                $response = $this->addOrUpdateOutletAddressData($data);
                                if ($response['status'] == 'failed' || empty($response['transactionId'])) {
                                    // will be return from here
                                } else {
                                    if (empty($data['OutletOrgId'])) {
                                        $response = ['status' => 'failed', 'hasError' => 1, 'errorMessage' => 'Outlet org data record not found!', 'transactionId' => ''];
                                    } else {
                                        $response = $this->addOrUpdateOutletOrgData($data);
                                    }
                                }
                            }
                        }
                    }
                    break;

                case 'update_all_details_and_transfer':
                    if (empty($data['outletId'])) {
                        $response = ['status' => 'failed', 'hasError' => 1, 'errorMessage' => 'Outlet record not found!', 'transactionId' => ''];
                    } else {
                        $response = $this->addOrUpdateOutletsData($data);
                        if ($response['status'] == 'failed' || empty($response['transactionId'])) {
                            // will be return from here
                        } else {
                            if (empty($data['addressId'])) {
                                $response = ['status' => 'failed', 'hasError' => 1, 'errorMessage' => 'Address record not found!', 'transactionId' => ''];
                            } else {
                                $response = $this->addOrUpdateOutletAddressData($data);
                                if ($response['status'] == 'failed' || empty($response['transactionId'])) {
                                    // will be return from here
                                } else {
                                    if (empty($data['OutletOrgId'])) {
                                        $response = ['status' => 'failed', 'hasError' => 1, 'errorMessage' => 'Outlet org data record not found!', 'transactionId' => ''];
                                    } else {
                                        $response = $this->addOrUpdateOutletOrgData($data);
                                        if ($response['status'] == 'failed' || empty($response['transactionId'])) {
                                            // will be return from here
                                        } else {
                                            if ($this->isActivePatchMappingExists($data)) {
                                                $response = ['status' => 'failed', 'hasError' => 1, 'errorMessage' => 'Mapping already exists!', 'transactionId' => ''];
                                            } else {
                                                $response = $this->removeBeatMappingforOutletOrgData($data);
                                                if ($response['status'] == 'failed') {
                                                    // $rowData[] = $response['errorMessage'];
                                                    // $this->addDataToErrorFile($rowData);
                                                } else {
                                                    $successIds = ['removed_ids' => $response['transactionId']];
                                                    $response = $this->addBeatMappingforOutletOrgData($data);
                                                    $successIds = ['added_ids' => $response['transactionId']];
                                                    $response['transactionId'] = $successIds;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    break;

                default:
                    $response = ['status' => 'failed', 'hasError' => 1, 'errorMessage' => 'Something went wrong!', 'transactionId' => ''];
                    break;
            }

            if ($response['status'] == 'failed' || empty($response['transactionId'])) {
                $rowData[] = $response['errorMessage'];
                $this->addDataToErrorFile($rowData);
            } else {
                $successIds = is_array($response['transactionId']) ? $response['transactionId'] : ['transactionId' => $response['transactionId']];
                $rowData[] = json_encode($successIds);
                $this->addDataToSuccessFile($rowData);
            }
        } catch (\Exception $e) {
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
        return true;
    }

    private function newCustomerMasterRecordAction($data)
    {
        $successIds = [];

        $response = $this->addOrUpdateOutletsData($data);
        if ($response['status'] == 'failed' || empty($response['transactionId'])) {
            return $response;
        }
        $data['outletId'] = $response['transactionId'];
        $successIds['outletId'] = $response['transactionId'];

        $response = $this->addOrUpdateOutletAddressData($data);
        if ($response['status'] == 'failed' || empty($response['transactionId'])) {
            return $response;
        }
        $data['addressId'] = $response['transactionId'];
        $successIds['addressId'] = $response['transactionId'];

        $response = $this->addOrUpdateOutletOrgData($data);
        if ($response['status'] == 'failed' || empty($response['transactionId'])) {
            return $response;
        }
        $data['OutletOrgId'] = $response['transactionId'];
        $successIds['OutletOrgId'] = $response['transactionId'];

        $response = $this->addBeatMappingforOutletOrgData($data);
        if ($response['status'] == 'failed' || empty($response['transactionId'])) {
            return $response;
        }
        $data['mappingId'] = $response['transactionId'];
        $successIds['mappingId'] = $response['transactionId'];

        return ['status' => 'success', 'hasError' => 0, 'errorMessage' => '', 'transactionId' => $successIds];
    }

    private function addOrUpdateOutletsData($data)
    {
        $response = ['status' => 'failed', 'hasError' => 1, 'errorMessage' => 'Something went wrong!', 'transactionId' => ''];

        if (!empty($data['outletId'])) {
            $outlet = OutletsQuery::create()
                ->filterById($data['outletId'])
                ->findOne();

            if (empty($outlet)) {
                $response['errorMessage'] = 'Outlet record not found!';
                return $response;
            }
        } else {
            $outlet = null;
            if (!empty($data['outletCode'])) {
                $outlet = OutletsQuery::create()
                    ->filterByOutletCode($data['outletCode'])
                    ->findOne();

                // Can be - legacy code can use into multiple org data
                // if (!empty($outlet)) {
                //     $response['errorMessage'] = 'Outlet already exists with outlet code!';
                //     return $response;
                // }
            }

            if (empty($outlet)) {
                if (empty($data['outletCode'])) {
                    $legacyData = ['OutletTypeId' => $data['outletTypeId'], 'CreatedByEmployeeId' => null, 'CompanyId' => $data['companyId']];
                    $data['outletCode'] = (new \BI\manager\OnBoardManager)->generateLagacyCode($legacyData);
                }

                $outlet = new Outlets;
                $outlet->setOutletCode($data['outletCode']);
                $outlet->setCompanyId($data['companyId']);
                $outlet->setOutletStatus('active');
            }
        }

        $outlet->setOutletSalutation($data['salutation']);
        $outlet->setOutletName($data['customerName']);
        $outlet->setOutlettypeId($data['outletTypeId']);
        $outlet->setOutletClassification($data['classificationId']);
        $outlet->setOutletContactName($data['contactName']);
        $outlet->setOutletOpeningDate($data['openingDate']);
        $outlet->setOutletContactNo($data['contactNumber']);
        $outlet->setOutletLandlineno($data['landlineNumber']);
        $outlet->setOutletEmail($data['customerEmail']);
        $outlet->setItownid($data['townId']);
        $outlet->setOutletContactBday($data['birthdate']);
        $outlet->setOutletContactAnniversary($data['anniversary']);
        $outlet->setOutletStatus('active');
        $outlet->setOutletPotential($data['potentialMonthlyBill']);
        $outlet->setOutletRegno($data['registrationNo']);
        $outlet->setOutletQualification($data['qualification']);
        $outlet->setOutletMaritalStatus($data['maritalStatus']);
        $outlet->save();

        return ['status' => 'success', 'hasError' => 0, 'errorMessage' => '', 'transactionId' => $outlet->getPrimaryKey()];
    }

    private function addOrUpdateOutletAddressData($data)
    {
        $response = ['status' => 'failed', 'hasError' => 1, 'errorMessage' => 'Something went wrong!', 'transactionId' => ''];

        if (!empty($data['addressId'])) {
            $address = OutletAddressQuery::create()
                ->filterByOutletAddressId($data['addressId'])
                ->findOne();

            if (empty($address)) {
                $response['errorMessage'] = 'address record not found!';
                return $response;
            }
        } else {
            if (empty($data['outletId']) || empty($data['townId'])) {
                $response['errorMessage'] = 'OutletId or TownId not found!';
                return $response;
            }

            $address = OutletAddressQuery::create()
                ->filterByOutletId($data['outletId'])
                ->filterByItownid($data['townId'])
                ->findOne();

            if (empty($address)) {
                $address = new OutletAddress;
                $address->setOutletId($data['outletId']);
                $address->setItownid($data['townId']);
                $address->setCompanyId($data['companyId']);
            }
        }

        $address->setOutletAddress($data['address']);
        $address->setOutletStreetName($data['street']);
        $address->setOutletCity($data['city']);
        $address->setOutletState($data['state']);
        $address->setOutletPincode($data['pincode']);
        $address->setAddressName($data['addressType']);
        $address->save();

        return ['status' => 'success', 'hasError' => 0, 'errorMessage' => '', 'transactionId' => $address->getPrimaryKey()];
    }

    private function addOrUpdateOutletOrgData($data)
    {
        $response = ['status' => 'failed', 'hasError' => 1, 'errorMessage' => 'Something went wrong!', 'transactionId' => ''];

        if (!empty($data['OutletOrgId'])) {
            $oodRecord = OutletOrgDataQuery::create()
                ->filterByOutletOrgId($data['OutletOrgId'])
                ->findOne();

            if (empty($oodRecord)) {
                $response['errorMessage'] = 'OodRecord not found!';
                return $response;
            }
        } else {
            if (empty($data['outletId']) || empty($data['orgUnitId'])) {
                $response['errorMessage'] = 'OutletId or OrgUnitId not found!';
                return $response;
            }

            if (!empty($data['outletOrgCode'])) {
                $outlet = OutletOrgDataQuery::create()
                    ->filterByOutletOrgCode($data['outletOrgCode'])
                    ->findOne();

                if (!empty($outlet)) {
                    $response['errorMessage'] = 'Outlet already exists with outlet code!';
                    return $response;
                }
            }

            $oodRecord = OutletOrgDataQuery::create()
                ->filterByOutletId($data['outletId'])
                ->filterByOrgUnitId($data['orgUnitId'])
                ->findOne();

            if (empty($oodRecord)) {
                if (empty($data['outletOrgCode'])) {
                    $data['outletOrgCode'] = (new \BI\manager\OnBoardManager)->generatePCode($data['companyId']);
                }

                $oodRecord = new OutletOrgData;
                $oodRecord->setOutletId($data['outletId']);
                $oodRecord->setOrgUnitId($data['orgUnitId']);
                $oodRecord->setOutletOrgCode($data['outletOrgCode']);
                $oodRecord->setCompanyId($data['companyId']);
            } else {
                if (empty($data['outletOrgCode'])) {
                    $response['errorMessage'] = 'Outlet already found with this org unit! Outlet Org Code - ' . $oodRecord->getOutletOrgCode();
                    return $response;
                }
            }
        }

        if (!empty($data['townId'])) {
            $oodRecord->setItownid($data['townId']);
        }

        if (!empty($data['addressId'])) {
            $oodRecord->setDefaultAddress($data['addressId']);
        }

        if (!empty($data['tags'])) {
            $oodRecord->setTags($data['tags']);
        }

        if (!empty($data['visitFrequency'])) {
            $oodRecord->setVisitFq($data['visitFrequency']);
        }

        if (!empty($data['potential'])) {
            $oodRecord->setOrgPotential($data['potential']);
        }

        if (!empty($data['brandFocus'])) {
            $oodRecord->setBrandFocus($data['brandFocus']);
        }

        if (!empty($data['customerFrequency'])) {
            $oodRecord->setCustomerFq($data['customerFrequency']);
        }

        $oodRecord->save();

        return ['status' => 'success', 'hasError' => 0, 'errorMessage' => '', 'transactionId' => $oodRecord->getPrimaryKey()];
    }

    private function addBeatMappingforOutletOrgData($data)
    {
        $response = ['status' => 'failed', 'hasError' => 1, 'errorMessage' => 'Something went wrong!', 'transactionId' => ''];
        if (empty($data['OutletOrgId'])) {
            $response['errorMessage'] = 'OutletOrgId not found!';
            return $response;
        }

        $beatMapping = BeatOutletsQuery::create()
            ->filterByBeatOrgOutlet($data['OutletOrgId'])
            ->filterByStatus('active')
            ->filterByCompanyId($this->company_id)
            ->findOne();
        if (!empty($beatMapping)) {
            $response['errorMessage'] = 'Already mapping found! Mapping Id - ' . $beatMapping->getPrimaryKey();
            return $response;
        }

        $beat = BeatsQuery::create()
            ->filterByBeatCode($data['beatCode'])
            ->filterByTerritoryId($data['territoryId'])
            ->filterByItownid($data['townId'])
            ->filterByCompanyId($data['companyId'])
            ->filterByOrgUnitId($data['orgUnitId'])
            ->findOne();

        if (empty($beat)) {
            $beat = new Beats();
            $beat->setBeatName(ucwords($data['beatCode']));
            $beat->setBeatRemark('');
            $beat->setBeatCode($data['beatCode']);
            $beat->setTerritoryId($data['territoryId']);
            $beat->setCompanyId($data['companyId']);
            $beat->setItownid($data['townId']);
            $beat->setOrgunitid($data['orgUnitId']);
            $beat->save();
        }

        $beatMapping = new BeatOutlets();
        $beatMapping->setBeatId($beat->getPrimaryKey());
        $beatMapping->setBeatOrgOutlet($data['OutletOrgId']);
        $beatMapping->setCompanyId($this->company_id);
        $beatMapping->setActiveDate(date('Y-m-d H:i:s'));
        $beatMapping->save();

        return ['status' => 'success', 'hasError' => 0, 'errorMessage' => '', 'transactionId' => $beatMapping->getPrimaryKey()];
    }

    private function removeBeatMappingforOutletOrgData($data)
    {
        $response = ['status' => 'failed', 'hasError' => 1, 'errorMessage' => 'Something went wrong!', 'transactionId' => []];
        if (empty($data['OutletOrgId'])) {
            $response['errorMessage'] = 'OutletOrgId not found!';
            return $response;
        }
        if (empty($data['territoryId'])) {
            $response['errorMessage'] = 'Territory id not found!';
            return $response;
        }

        $beatMappings = BeatOutletsQuery::create()
            ->filterByBeatOrgOutlet($data['OutletOrgId'])
            ->filterByStatus('active')
            ->filterByCompanyId($this->company_id)
            ->find();

        $successIds = [];
        foreach ($beatMappings as $mapping) {
            $removeTerritoryId = $mapping->getBeats()->getTerritoryId();
            if ($removeTerritoryId == $data['territoryId']) {
                $reportEndDate = date('Y-m-d');
            } else {
                $reportEndDate = date('Y-m-01', strtotime('+1 month'));
                $this->removeCustomersFromDayplan($mapping->getBeatId(), $mapping->getBeatOrgOutlet());
                $this->removeCustomerFromBrandCampaign($removeTerritoryId, $mapping->getBeatOrgOutlet());
            }

            $mapping->setStatus('inactive');
            $mapping->setInactiveDate(date('Y-m-d H:i:s'));
            $mapping->setReportEndDate($reportEndDate);
            $mapping->save();

            $successIds[] = $mapping->getPrimaryKey();
        }

        return ['status' => 'success', 'hasError' => 0, 'errorMessage' => '', 'transactionId' => $successIds];
    }

    private function isActivePatchMappingExists($data)
    {
        $response = false;
        if (empty($data['OutletOrgId']) || empty($data['beatCode']) || empty($data['territoryId']) || empty($data['townId']) || empty($data['companyId']) || empty($data['orgUnitId'])) {
            $response = false;
        }

        $beat = BeatsQuery::create()
            ->filterByBeatCode($data['beatCode'])
            ->filterByTerritoryId($data['territoryId'])
            ->filterByItownid($data['townId'])
            ->filterByCompanyId($data['companyId'])
            ->filterByOrgUnitId($data['orgUnitId'])
            ->findOne();

        if (empty($beat)) {
            $response = false;
        } else {
            $beatMappings = BeatOutletsQuery::create()
                ->filterByBeatOrgOutlet($data['OutletOrgId'])
                ->filterByStatus('active')
                ->filterByBeatId($beat->getBeatId())
                ->filterByCompanyId($data['companyId'])
                ->findOne();
        }

        if (!empty($beatMappings)) {
            $response = true;
        } else {
            $response = false;
        }

        return $response;
    }

    private function removeCustomersFromDayplan($beatId, $OutletOrgId)
    {
        DayplanQuery::create()
            ->filterByBeatId($beatId)
            ->filterByOutletOrgDataId($OutletOrgId)
            ->filterByStatus('pending')
            ->delete();

        TourplansQuery::create()
            ->filterByBeatId($beatId)
            ->filterByOutletOrgDataId($OutletOrgId)
            ->delete();
    }

    private function removeCustomerFromBrandCampaign($territoryId, $OutletOrgId)
    {
        $territory = TerritoriesQuery::create()
            ->filterByTerritoryId($territoryId)
            ->findOne();

        $brandCampaignIds = BrandCampiagnQuery::create()
                                ->select(['BrandCampiagnId'])
                                ->filterByStatus(['Draft', 'Published'])
                                ->find()
                                ->toArray();

        BrandCampiagnDoctorsQuery::create()
            ->filterByOutletOrgDataId($OutletOrgId)
            ->filterByPositionId($territory->getPositionId())
            ->filterByBrandCampiagnId($brandCampaignIds)
            ->delete();
    }

    private function importPrescibertallysummary($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'prescriberSummary ID');
            $firstRow = false;
            return true;
        }
        try {
            $OrgUnit = !empty($rowData[0]) ? $this->trimData($rowData[0]) : null;
            $positionCode = !empty($rowData[1]) ? $this->trimData($rowData[1]) : null;
            $brandId = !empty($rowData[3]) ? $this->trimData($rowData[3]) : null;
            $moye = !empty($rowData[4]) ? strtoupper($this->trimData($rowData[4])) : null;
            $Visit = !empty($rowData[5]) ? $this->trimData($rowData[5]) : null;
            $Rcpa = !empty($rowData[6]) ? $this->trimData($rowData[6]) : null;
            $taggedDrs = !empty($rowData[7]) ? $this->trimData($rowData[7]) : null;
            $lm_rxbers = !empty($rowData[8]) ? $this->trimData($rowData[8]) : null;
            $cm_Rxbers = !empty($rowData[9]) ? $this->trimData($rowData[9]) : null;
            $gain = !empty($rowData[10]) ? $this->trimData($rowData[10]) : null;
            $loss = !empty($rowData[11]) ? $this->trimData($rowData[11]) : null;
            $two_Month_Rxber = !empty($rowData[12]) ? $this->trimData($rowData[12]) : null;
            $NonRxber = !empty($rowData[13]) ? $this->trimData($rowData[13]) : null;

            $date = DateTime::createFromFormat('Ym', $moye);
            $formattedDate = $date->format('m-Y');

            $positions = PositionsQuery::create()
                ->filterByPositionCode($positionCode)
                ->filterByCompanyId($this->company_id)
                ->findOne();

            if (!empty($positions)) {
                $positionId = $positions->getPositionId();
                $terr = $positions->getCavTerritories();
            } else {
                $rowData[] = 0;
                $rowData[] = "position not exsists!";
                $this->addDataToErrorFile($rowData);
                return true;
            }
            $OrgId = $this->getOrgUnitRecordtrimByNameFromArray($OrgUnit);
            if (empty($OrgId )) {
                $rowData[] = 0;
                $rowData[] = "Org unit not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if ($OrgId != null && $positionId != null && $terr != null && $brandId != null && $Rcpa != null && $Visit != null) {
                $prescribesummary = \entities\PrescriberTallySummaryQuery::create()
                    ->filterByOrgunitId($OrgId)
                    ->filterByPositionId($positionId)
                    ->filterByTerritoryId($terr)
                    ->filterByBrandId($brandId)
                    ->filterByMoye($formattedDate)
                    ->filterByCmRcpa($Rcpa)
                    ->filterByCmVisit($Visit)
                    ->findOne();

                if (!empty($prescribesummary)) {
                    $prescribesummary->setMoye($formattedDate);
                    $prescribesummary->setTaggedDrs($taggedDrs);
                    $prescribesummary->setLmRxbers($lm_rxbers);
                    $prescribesummary->setCmRxbers($cm_Rxbers);
                    $prescribesummary->setGain($gain);
                    $prescribesummary->setLoss($loss);
                    $prescribesummary->setTwoMonthRxber($two_Month_Rxber);
                    $prescribesummary->setNonrxber($NonRxber);
                    $prescribesummary->setCmRcpa($Rcpa);
                    $prescribesummary->setCmVisit($Visit);
                    $prescribesummary->save();

                    $presummaryid = $prescribesummary->getPrimaryKey();
                    $rowData[] = $presummaryid . " Prescriber summary data  updated!";
                    $this->addDataToSuccessFile($rowData);
                } else {

                    $prescribesummary = new \entities\PrescriberTallySummary();
                    $prescribesummary->setOrgunitId($OrgId);
                    $prescribesummary->setPositionId($positionId);
                    $prescribesummary->setTerritoryId($terr);
                    $prescribesummary->setBrandId($brandId);
                    $prescribesummary->setMoye($formattedDate);
                    $prescribesummary->setTaggedDrs($taggedDrs);
                    $prescribesummary->setLmRxbers($lm_rxbers);
                    $prescribesummary->setCmRxbers($cm_Rxbers);
                    $prescribesummary->setGain($gain);
                    $prescribesummary->setLoss($loss);
                    $prescribesummary->setTwoMonthRxber($two_Month_Rxber);
                    $prescribesummary->setNonrxber($NonRxber);
                    $prescribesummary->setCmRcpa($Rcpa);
                    $prescribesummary->setCmVisit($Visit);
                    $prescribesummary->save();

                    $presummaryid = $prescribesummary->getPrimaryKey();

                    $rowData[] = $presummaryid;
                    $this->addDataToSuccessFile($rowData);
                }
            } else {
                $rowData[] = "please check required fields";
                $this->addDataToErrorFile($rowData);
                return;
            }
        } catch (\Exception $e) {
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
        return true;
    }

    private function importProductMasterData($rowData, &$firstRow)
    {
        $rowData = explode('|', $rowData[0]);

        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'DataChangeRequest ID');
            $firstRow = false;
            return true;
        }

        try {
            $materialNumber = !empty($rowData[0]) ? $this->trimData($rowData[0]) : null;
            $fiscalYear = !empty($rowData[1]) ? $this->trimData($rowData[1]) : null;
            $materialDescription = !empty($rowData[2]) ? $this->trimData($rowData[2]) : null;
            $division = !empty($rowData[3]) ? $this->trimData($rowData[3]) : null;
            $tempDivision = !empty($rowData[4]) ? $this->trimData($rowData[4]) : null;
            $productStatus = !empty($rowData[5]) ? strtolower($this->trimData($rowData[5])) : null;
            $productCommonCode = !empty($rowData[6]) ? $this->trimData($rowData[6]) : null;
            $productCommonCodeDes = !empty($rowData[7]) ? $this->trimData($rowData[7]) : null;
            $productGroup1 = !empty($rowData[8]) ? $this->trimData($rowData[8]) : null;
            $productGroup2 = !empty($rowData[9]) ? $this->trimData($rowData[9]) : null;
            $productGroup3 = !empty($rowData[10]) ? $this->trimData($rowData[10]) : null;
            $productGroup4 = !empty($rowData[11]) ? $this->trimData($rowData[11]) : null;
            $categoryCode = !empty($rowData[12]) ? strtolower($this->trimData($rowData[12])) : null;
            $country = !empty($rowData[13]) ? $this->trimData($rowData[13]) : null;
            $canDoRcpa = !empty($rowData[14]) ? strtolower($this->trimData($rowData[14])) : null;
            $altrackCode = !empty($rowData[15]) ? $this->trimData($rowData[15]) : null;
            $altrackCodeDesc = !empty($rowData[16]) ? $this->trimData($rowData[16]) : null;
            $matBillDate = !empty($rowData[17]) ? $this->trimData($rowData[17]) : null;
            $userName = !empty($rowData[18]) ? $this->trimData($rowData[18]) : null;
            $date = !empty($rowData[19]) ? $this->trimData($rowData[19]) : null;
            $time = !empty($rowData[20]) ? $this->trimData($rowData[20]) : null;
            $updatedBy = !empty($rowData[21]) ? $this->trimData($rowData[21]) : null;
            $updatedDate = !empty($rowData[22]) ? $this->trimData($rowData[22]) : null;
            $brandName = !empty($rowData[23]) ? $this->trimData($rowData[23]) : null;

            if (empty($brandName) || empty($productCommonCode) || empty($productCommonCodeDes) || empty($tempDivision) || empty($categoryCode)) {
                $rowData[] = 0;
                $rowData[] = "Please check required field : Product Group, Product Common Code, Product Common Code des., Temp Division, PHYZII_DISHA!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!in_array($productStatus, ['y', 'n'])) {
                $rowData[] = 0;
                $rowData[] = "Product Status should be Y or N!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!in_array($canDoRcpa, ['y', 'n'])) {
                $rowData[] = 0;
                $rowData[] = "Rcpa status should be Y or N!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $productStatus = ($productStatus == 'y' ? 'active' : 'inactive');
            $canDoRcpa = ($canDoRcpa == 'y' ? 'yes' : 'no');

            if ($productStatus != 'active') {
                $rowData[] = "No need to update as product not active!";
                $this->addDataToSuccessFile($rowData);
                return true;
            }

            $orgUnitId = $this->getOrgUnitRecordByOrgCodeFromArray($tempDivision);
            if (empty($orgUnitId)) {
                $rowData[] = 0;
                $rowData[] = "Org unit not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $this->peoductUpdateData[] = $productCommonCode . '|' . $orgUnitId;

            // check if brand name exists or not
            $brand = BrandsQuery::create()
                ->where('lower(brands.brand_name) = ?', strtolower($brandName))
                ->filterByOrgunitid($orgUnitId)
                ->filterByCompanyId($this->company_id)
                ->findOne();
            if (empty($brand)) {
                // $rowData[] = 0;
                // $rowData[] = "Brand not exsists!";
                // $this->addDataToErrorFile($rowData);

                // return true;
                $brand = new Brands;
                $brand->setBrandName(ucwords(strtolower($brandName)));
                $brand->setOrgunitid($orgUnitId);
                $brand->setCompanyId($this->company_id);
                $brand->setBrandCode(strtolower($brandName));
                $brand->save();

                $brandId = $brand->getPrimaryKey();
            } else {
                $brandId = $brand->getPrimaryKey();
            }

            $category = CategoriesQuery::create()
                ->filterByCategoryCode($categoryCode)
                ->filterByOrgunitid($orgUnitId)
                ->filterByCompanyId($this->company_id)
                ->findOne();
            if (empty($category)) {
                $category = new Categories();
                $category->setCategoryCode($categoryCode);
                $category->setCategoryName(ucwords($categoryCode));
                $category->setCategoryDescription(ucwords($categoryCode));
                $category->setCategoryType('Regular');
                // $category->setCategoryMedia(211);
                $category->setCategoryDisplayOrder(1);
                $category->setCategoryParentId(0);
                $category->setCompanyId($this->company_id);
                $category->setOrgunitId($orgUnitId);
                $category->save();

                $categoryId = $category->getPrimaryKey();
            } else {
                $categoryId = $category->getPrimaryKey();
            }

            $product = ProductsQuery::create()
                ->filterByProductSku($productCommonCode)
                ->filterByOrgunitId($orgUnitId)
                ->findOne();
            if (empty($product)) {
                $product = new Products;
                $product->setProductSku($productCommonCode);
                $product->setOrgunitId($orgUnitId);
                $product->setCompanyId($this->company_id);
            }

            if ($product->getProductName() != $productCommonCodeDes) {
                $product->setProductName($productCommonCodeDes);
                $product->setProductSummary($productCommonCodeDes);
                $product->setProductDescription($productCommonCodeDes);
            }

            if ($product->getCategoryId() != $categoryId) {
                $product->setCategoryId($categoryId);
            }

            if ($product->getBrandId() != $brandId) {
                $product->setBrandId($brandId);
            }

            if ($product->getStatus() != $productStatus) {
                $product->setStatus($productStatus);
            }

            if ($product->getCanDoRcpa() != $canDoRcpa) {
                $product->setCanDoRcpa($canDoRcpa);
            }

            $materialNos = $product->getIntegrationId();
            if (!empty($materialNos)) {
                $materialNos = explode(',', $materialNos);
            } else {
                $materialNos = [];
            }
            $materialNos[] = $materialNumber;
            $materialNos = array_unique($materialNos);
            sort($materialNos);
            $materialNos = implode(',', $materialNos);

            if ($product->getIntegrationId() != $materialNos) {
                $product->setIntegrationId($materialNos);
            }
            $product->save();

            $rowData[] = $product->getPrimaryKey();
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
        return true;
    }

    private function inactivateTheRemaningProducts($productData)
    {
        $productData = array_map(function ($value) {
            return "'" . $value . "'";
        }, $productData);
        // print_r($productData);
        // exit;
        ProductsQuery::create()
            ->filterByCompanyId($this->company_id)
            ->where("concat(products.product_sku,'|',products.orgunit_id) not in (" . implode(',', $productData) . ")")
            ->update(['Status' => 'inactive', 'CanDoRcpa' => 'no']);
    }

    private function importProductPriceMasterData($rowData, &$firstRow)
    {
        $rowData = explode('|', $rowData[0]);
        
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'DataChangeRequest ID');
            $firstRow = false;
            return true;
        }

        try {
            $salesOrganization = !empty($rowData[0]) ? $this->trimData($rowData[0]) : null;
            $materialType = !empty($rowData[1]) ? $this->trimData($rowData[1]) : null;
            $material = !empty($rowData[2]) ? $this->trimData($rowData[2]) : null;
            $baseUnit = !empty($rowData[3]) ? $this->trimData($rowData[3]) : null;
            $materialDescription = !empty($rowData[4]) ? $this->trimData($rowData[4]) : null;
            $division = !empty($rowData[5]) ? $this->trimData($rowData[5]) : null;
            $wbr = !empty($rowData[6]) ? $this->trimData($rowData[6]) : null;
            $ptr = !empty($rowData[7]) ? $this->trimData($rowData[7]) : null;
            $mrp = !empty($rowData[8]) ? $this->trimData($rowData[8]) : null;

            if (empty($wbr) || $wbr <= 0) {
                $rowData[] = 0;
                $rowData[] = "The wbr price shoould be greater than 0!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (empty($ptr) || $ptr <= 0) {
                $rowData[] = 0;
                $rowData[] = "The selling price shoould be greater than 0!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (empty($mrp) || $mrp <= 0) {
                $rowData[] = 0;
                $rowData[] = "The max retail price shoould be greater than 0!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (empty($material) || empty($division) || empty($wbr)) {
                $rowData[] = 0;
                $rowData[] = "Please check required field : Material, Division, WBR!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $orgUnitId = $this->getOrgUnitRecordByOrgCodeFromArray($division);
            if (empty($orgUnitId)) {
                $rowData[] = 0;
                $rowData[] = "Org unit not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $product = ProductsQuery::create()
                ->where("'" . $material . "' = ANY(string_to_array(products.integration_id, ','))",)
                // ->filterByProductSku($material)
                ->filterByOrgunitId($orgUnitId)
                ->findOne();

            if (empty($product)) {
                $rowData[] = 0;
                $rowData[] = "Product sku not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $unitRecord = UnitmasterQuery::create()
                ->filterByUnitCode($baseUnit)
                ->findOne();

            if (empty($unitRecord)) {
                $unitRecord = new Unitmaster();
                $unitRecord->setUnitCode($baseUnit);
                $unitRecord->setUnitDescription($baseUnit);
                $unitRecord->save();

                $unitId = $unitRecord->getPrimaryKey();
            } else {
                $unitId = $unitRecord->getPrimaryKey();
            }

            if ($product->getUnitD() != $unitId) {
                $product->setUnitD($unitId);
            }

            if ($product->getBasePrice() != $wbr) {
                $product->setBasePrice($wbr);
            }

            $product->save();
            $productId = $product->getPrimaryKey();
            $successIds = ['productId' => $productId];

            if ($mrp > 0 || $ptr > 0) {
                // pricebook
                $pricebook = PricebooksQuery::create()
                    ->filterByOrgId($orgUnitId)
                    ->filterByCompanyId($this->company_id)
                    ->findOne();
                if (empty($pricebook)) {
                    $pricebook = new Pricebooks();
                    $pricebook->setPricebookName($orgUnitId . ' Book');
                    $pricebook->setPricebookDescription($orgUnitId . ' Book');
                    $pricebook->setCompanyId($this->company_id);
                    $pricebook->setOrgId($orgUnitId);
                    $pricebook->save();

                    $pricebookId = $pricebook->getPrimaryKey();
                } else {
                    $pricebookId = $pricebook->getPrimaryKey();
                }

                $pricebookline = PricebooklinesQuery::create()
                    ->filterByPricebookId($pricebookId)
                    ->filterByProductId($productId)
                    ->filterByCompanyId($this->company_id)
                    ->findOne();
                if (empty($pricebookline)) {
                    $pricebookline = new Pricebooklines();
                    $pricebookline->setPricebookId($pricebookId);
                    $pricebookline->setProductId($productId);
                    $pricebookline->setCompanyId($this->company_id);
                }

                if ($pricebookline->getMaxRetailPrice() != $mrp) {
                    $pricebookline->setMaxRetailPrice($mrp);
                }

                if ($pricebookline->getSellingPrice() != $ptr) {
                    $pricebookline->setSellingPrice($ptr);
                }

                if ($pricebookline->getIsenabled() != 1) {
                    $pricebookline->setIsenabled(1);
                }

                $pricebookline->save();
                $successIds['pricebooklineId'] = $pricebookline->getPrimaryKey();
            }

            $rowData[] = json_encode($successIds);
            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
        return true;
    }
    
    public function importPrescibertallydata($rowData, &$firstRow)
   {
    if ($firstRow) {
        $this->addFirstRowLog($rowData, 'prescriber data');
        $firstRow = false;
        // Clear previous data if needed
            \entities\TempPrescriberAllDataQuery::create()->deleteAll();
        return true;
    }
    try {
            // Trim and validate input data
            $OrgUnit = !empty($rowData[0]) ? $this->trimData($rowData[0]) : null;
            $DoctorCode = !empty($rowData[1]) ? $this->trimData($rowData[1]) : null;
            $brandId = !empty($rowData[2]) ? $this->trimData($rowData[2]) : null;
            $moye = !empty($rowData[4]) ? strtoupper($this->trimData($rowData[4])) : null;
            $cutoff = !empty($rowData[3]) ? $this->trimData($rowData[3]) : null;
            $lm_rcpa_value = !empty($rowData[5]) ? $this->trimData($rowData[5]) : null;
            $cm_rcpa_value = !empty($rowData[6]) ? $this->trimData($rowData[6]) : null;
            $lm_visit = !empty($rowData[7]) ? $this->trimData($rowData[7]) : null;
            $cm_visit = !empty($rowData[8]) ? $this->trimData($rowData[8]) : null;
            $lm_rcpa = !empty($rowData[9]) ? $this->trimData($rowData[9]) : null;
            $cm_rcpa = !empty($rowData[10]) ? $this->trimData($rowData[10]) : null;
            $cm_rxber_cat = !empty($rowData[11]) ? $this->trimData($rowData[11]) : null;
            $compute_date = !empty($rowData[12]) ? $this->trimData($rowData[12]) : null;

            // Date conversion
            if ($moye) {
                $date = DateTime::createFromFormat('Ym', $moye);
                if ($date) {
                    $formattedDate = $date->format('m-Y');
                } else {
                    throw new \Exception("Invalid date format in moye: $moye");
                }
            } else {
                $formattedDate = null;
            }

            // Insert data
            $prescribeData = new \entities\TempPrescriberAllData();
            $prescribeData->setOrgunit($OrgUnit);
            $prescribeData->setDoctorcode($DoctorCode);
            $prescribeData->setBrandid($brandId);
            $prescribeData->setCutoff($cutoff);
            $prescribeData->setMonYear($formattedDate);
            $prescribeData->setLmRcpaValue($lm_rcpa_value);
            $prescribeData->setCmRcpaValue($cm_rcpa_value);
            $prescribeData->setLmVisit($lm_visit);
            $prescribeData->setCmVisit($cm_visit);
            $prescribeData->setLmRcpa($lm_rcpa);
            $prescribeData->setCmRcpa($cm_rcpa);
            $prescribeData->setCmRxberCat($cm_rxber_cat);
            $prescribeData->setComputeDate($compute_date);
            $prescribeData->save();
            // Add to collection
            $this->collection->append($prescribeData);

            // Batch save
            if ($this->collection->count() >= 5000) {
                $this->collection->save();
                $this->collection->clear();
                echo 'Imported : ' . 5000 . PHP_EOL;
            }

            $this->addDataToSuccessFile($rowData);
        } catch (\Exception $e) {
            error_log("Error inserting data: " . $e->getMessage());
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
        return true;
    }


    public function importOrgOutletDataKeys($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'OutletOrgDataKeys ID');
            $firstRow = false;
            return true;
        }
        try {
            $outeltOrgCode = !empty($rowData[0]) ? $rowData[0] : null;
            $key = !empty($rowData[1]) ? $rowData[1] : null;
            $value = !empty($rowData[2]) ? $rowData[2] : null;

            $outletOrgData = \entities\OutletOrgDataQuery::create()
                ->filterByOutletOrgCode($outeltOrgCode)
                ->filterByCompanyId($this->company_id)
                ->findOne();
            if (!empty($outletOrgData)) {
                $outletOrgDataId = $outletOrgData->getOutletOrgId();
            } else {
                $rowData[] = 0;
                $rowData[] = "OutletOrg data not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $orgDataKey =  \entities\OutletOrgDataKeysQuery::create()
                ->filterByOutletOrgDataId($outletOrgDataId)
                ->filterByKey($key)
                ->filterByCompanyId($this->company_id)
                ->findOne();

            if ($orgDataKey != null) {
                $orgDataKey->setValue($value);
                $orgDataKey->save();

                $orgDataKeyid = $orgDataKey->getPrimaryKey();
                $rowData[] = $orgDataKeyid;
                $rowData[] = "OutletOrgDataKey data  updated!";
                $this->addDataToSuccessFile($rowData);

                return true;
            } else {

                $orgDataKey  = new \entities\OutletOrgDataKeys();
                $orgDataKey->setOutletOrgDataId($outletOrgDataId);
                $orgDataKey->setKey($key);
                $orgDataKey->setCompanyId($this->company_id);
                $orgDataKey->setValue($value);

                $orgDataKey->save();

                $orgDataKeyid = $orgDataKey->getPrimaryKey();

                $rowData[] = $orgDataKeyid;
                $this->addDataToSuccessFile($rowData);
            }
        } catch (\Exception $e) {
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
        return true;
    }

    public function importOutletOrgDataClosingStock($rowData, &$firstRow)
    {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'OutletClosingStock ID');
            $firstRow = false;
            return true;
        }
        try {
            $outeltOrgCode = !empty($rowData[0]) ? $rowData[0] : null;
            $brandCode = !empty($rowData[1]) ? $rowData[1] : null;
            $productSku = !empty($rowData[2]) ? $rowData[2] : null;
            $closingQty = !empty($rowData[3]) ? $rowData[3] : null;
            $competitor = !empty($rowData[4]) ? $rowData[4] : null;

            $outletOrgData = \entities\OutletOrgDataQuery::create()
                ->filterByOutletOrgCode($outeltOrgCode)
                ->filterByCompanyId($this->company_id)
                ->findOne();
            if (!empty($outletOrgData)) {
                $outletOrgDataId = $outletOrgData->getOutletOrgId();
                $outletId = $outletOrgData->getOutletId();
                $orgUnitId = $outletOrgData->getOrgUnitId();
            } else {
                $rowData[] = 0;
                $rowData[] = "OutletOrg data not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $brand =  BrandsQuery::create()
                ->filterByBrandCode($brandCode)
                ->filterByCompanyId($this->company_id)
                ->findOne();
            if (!empty($brand)) {
                $brandId = $brand->getBrandId();
            } else {
                $rowData[] = 0;
                $rowData[] = "Brand not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $product =  ProductsQuery::create()
                ->filterByBrandId($brandId)
                ->filterByProductSku($productSku)
                ->filterByCompanyId($this->company_id)
                ->findOne();
            if (!empty($product)) {
                $productId = $product->getId();
            } else {
                $rowData[] = 0;
                $rowData[] = "Product not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $brandCompetitor =  BrandCompetitionQuery::create()
                ->filterByCompetitorBrandId($brandId)
                ->filterByProductId($productId)
                ->filterByCompetitorName($competitor)
                ->filterByCompanyId($this->company_id)
                ->findOne();
            if (!empty($brandCompetitor)) {
                $competitorId = $brandCompetitor->getId();
            } else {
                $rowData[] = 0;
                $rowData[] = "Competitor not exsists!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $outletClosignStock =  \entities\OutletStockQuery::create()
                ->filterByOutletOrgId($outletOrgDataId)
                ->filterByBrandId($brandId)
                ->filterByProductId($productId);
                if($competitorId != null || $competitorId != ''){
                    $outletClosignStock->filterByCompetitorId($competitorId);
                }
                $outletClosignStock->filterByCompanyId($this->company_id)
                ->findOne();

            if ($outletClosignStock != null) {
                $outletClosignStock->setClosingQty($closingQty);
                $outletClosignStock->save();

                $orgDataKeyid = $outletClosignStock->getPrimaryKey();
                $rowData[] = $orgDataKeyid;
                $rowData[] = "Outlet closing stock updated!";
                $this->addDataToSuccessFile($rowData);

                return true;
            } else {

                $outletClosignStock  = new \entities\OutletStock();
                $outletClosignStock->setOutletId($outletId);
                $outletClosignStock->setOutletOrgId($outletOrgDataId);
                $outletClosignStock->setProductId($productId);
                $outletClosignStock->setBrandId($brandId);
                if($competitorId != null || $competitorId != ''){
                    $outletClosignStock->setCompetitorId($competitorId);
                }
                $outletClosignStock->setOrgunitid($orgUnitId);
                $outletClosignStock->setCompanyId($this->company_id);
                $outletClosignStock->setClosingQty($closingQty);
                $outletClosignStock->save();

                $orgDataKeyid = $outletClosignStock->getPrimaryKey();

                $rowData[] = $orgDataKeyid;
                $this->addDataToSuccessFile($rowData);
            }
        } catch (\Exception $e) {
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
        return true;
    }

    public function importExpensePayments($rowData, &$firstRow) {
        if ($firstRow) {
            $this->addFirstRowLog($rowData, 'Expense Unique ID');
            $firstRow = false;
            return true;
        }

        try {
            $employeeCode = !empty($rowData[0]) ? $this->trimData($rowData[0]) : null;
            $expenseMonth = !empty($rowData[1]) ? $this->trimData($rowData[1]) : null;
            $paidStatus = !empty($rowData[2]) ? $this->trimData(strtolower($rowData[2])) : null;
            $lotNo = !empty($rowData[3]) ? $this->trimData($rowData[3]) : null;
            $transactionId = !empty($rowData[4]) ? $this->trimData($rowData[4]) : null;
            $amount = !empty($rowData[5]) ? $this->trimData($rowData[5]) : null;
            $remark = !empty($rowData[6]) ? $this->trimData($rowData[6]) : null;

            if (empty($employeeCode) || empty($expenseMonth) || empty($paidStatus) || empty($lotNo)) {
                $rowData[] = 0;
                $rowData[] = "Please check required fields: employee_code, expense_month, paid_status, lot_no!";
                $this->addDataToErrorFile($rowData);
            }

            // check if new employee code exists or not
            $employeeId = $this->getEmployeeRecordByCodeFromArray($employeeCode);
            if (empty($employeeId)) {
                $rowData[] = 0;
                $rowData[] = "Employee not found with employee code!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            if (!in_array($paidStatus, ['yes', 'no'])) {
                $rowData[] = 0;
                $rowData[] = "Paid status should be Yes or No!";
                $this->addDataToErrorFile($rowData);

                return true;
            }

            $date = DateTime::createFromFormat('Ym', $expenseMonth);
            $formattedDate = $date->format('m-Y');

            $payment = ExpensePaymentsQuery::create()
                        ->filterByEmployeeId($employeeId)
                        ->filterByExpenseMonth($formattedDate)
                        ->findOne();
            if (!empty($payment)) {
                $rowData[] = 0;
                $rowData[] = "Record already found!";
                $this->addDataToErrorFile($rowData);

                return true;
            }
            
            $payment = new ExpensePayments;
            $payment->setEmployeeId($employeeId);
            $payment->setExpenseMonth($formattedDate);
            $payment->setPaidStatus($paidStatus);
            $payment->setLotNo($lotNo);
            $payment->setTransactionId($transactionId);
            $payment->setPaidAmount($amount);
            $payment->setRemark($remark);
            $payment->setCompanyId($this->company_id);
            $payment->save();

            $paymentId = $payment->getPrimaryKey();

            $rowData[] = $paymentId;
            $this->addDataToSuccessFile($rowData);
            
        } catch (\Exception $e) {
            $rowData[] = $e->getMessage();
            $this->addDataToErrorFile($rowData);
        }
        return true;
    }
}
