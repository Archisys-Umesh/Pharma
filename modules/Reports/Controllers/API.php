<?php

declare(strict_types=1);

namespace Modules\Reports\Controllers;

use Exception;
use App\System\App;
use BI\manager\OrgManager;
use entities\DailycallsQuery;
use entities\EmployeeQuery;
use entities\RcpaSummaryQuery;
use entities\ItemSalesViewQuery;
use entities\OutletMappingViewQuery;
use entities\OutletStockOtherSummaryQuery;
use entities\OutletStockSummaryQuery;
use entities\OutletViewQuery;
use entities\OutletVisitsViewQuery;
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
     *     path="/api/getTopOutlets",
     *     tags={"Reports"},
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
     *         description="MOYE - Default current month",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="territory_id",
     *         in="query",
     *         description="Territory Id , default is session",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Top Doctors",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getTopOutlets()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET" :


                $emp = $this->app->Auth()->getUser()->getEmployee();
                $terr = $this->app->Request()->getParameter("territory_id", null);

                if ($terr == null) {
                    $terr = OrgManager::getMyTerritories($emp);
                }

                $moye = $this->app->Request()->getParameter("moye", date("m-Y"));


                $rcpa = RcpaSummaryQuery::create()
                    ->filterByTerritoryId($terr)
                    ->filterByRcpaMoye($moye)
                    //->filterByOwn(0, Criteria::GREATER_THAN)
                    //->filterByOrgunitid($emp->getOrgUnitId())
                    ->find();
                $resp = [];

                foreach ($rcpa as $rc) {
                    if (!isset($resp[$rc->getOutletOrgId()])) {
                        $resp[$rc->getOutletOrgId()] = [
                            "Name" => $rc->getOutletName(),
                            "OutletOrgId" => $rc->getOutletOrgId(),
                            "Own" => 0,
                            "Potential" => 0,
                            "Brands" => [],
                            "Tags" => $rc->getTags(),
                            "VisitFq" => $rc->getVisitFq()
                        ];
                    }

                    $resp[$rc->getOutletOrgId()]["Own"] += $rc->getOwn();
                    $resp[$rc->getOutletOrgId()]["Potential"] += $rc->getPotential();


                    if (!in_array($rc->getBrandName(), $resp[$rc->getOutletOrgId()]["Brands"])) {
                        if ($rc->getOwn() > $rc->getMinValue()) {
                            $resp[$rc->getOutletOrgId()]["Brands"][] = $rc->getBrandName();
                        }
                    }

                }
                usort($resp, fn($a, $b) => $b['Own'] <=> $a['Own']);

                $resArr = [];
                $totalArr = [];
                  foreach ($resp as $res) {
                      $resArr['Name'] = $res['Name'];
                      $resArr['OutletOrgId'] = $res['OutletOrgId'];
                      $resArr['Own'] = round($res['Own']);
                      $resArr['Potential'] = round($res['Potential']);
                      $resArr['Brands'] = $res['Brands'];
                      $resArr['Tags'] = $res['Tags'];
                      $resArr['VisitFq'] = $res['VisitFq'];
                      $totalArr[] = $resArr;
                  }
                $this->apiResponse($totalArr, 200, "Get Top Outlets by RCPA!");
                break;
        endswitch;
    }


    /**
     * @OA\Get(
     *     path="/api/getMissedOutlets",
     *     tags={"Reports"},
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
     *         description="Territory Id , default is session",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Top Doctors",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getMissedOutlets()
    {

        $emp = $this->app->Auth()->getUser()->getEmployee();
        $territoryid = $this->app->Request()->getParameter("territory_id", null);

        if ($territoryid == null) {
            $territoryid = OrgManager::getMyTerritories($emp);
        }


        $outlets = OutletViewQuery::create()
            ->filterByTerritoryId($territoryid)
            ->filterByOutlettypeName('Doctor')
            ->find()->toKeyValue("OutletOrgId", "OutletName");

        $d1 = date('m-Y', strtotime("-1 month"));
        $d2 = date('m-Y', strtotime("-2 month"));
        $d3 = date('m-Y', strtotime("-3 month"));

        // $dcr1 = OutletVisitsViewQuery::create()->select(['OutletOrgDataId'])->filterByOutlettypeName("Doctor")->filterByTerritoryId($territoryid)->filterByMoye($d1)->find()->toArray();
        // $dcr2 = OutletVisitsViewQuery::create()->select(['OutletOrgDataId'])->filterByOutlettypeName("Doctor")->filterByPositionId($territoryid)->filterByMoye($d2)->find()->toArray();
        // $dcr3 = OutletVisitsViewQuery::create()->select(['OutletOrgDataId'])->filterByOutlettypeName("Doctor")->filterByPositionId($territoryid)->filterByMoye($d3)->find()->toArray();

        $dcrs = OutletVisitsViewQuery::create()
                    ->select(['OutletOrgDataIds', 'Moye'])
                    ->withColumn("string_agg(outlet_org_data_id::text, ',')", "OutletOrgDataIds")
                    ->filterByOutlettypeName("Doctor")
                    ->filterByTerritoryId($territoryid)
                    ->filterByMoye([$d1, $d2, $d3])
                    ->groupByMoye()
                    ->find()->toArray();

        $dcr1 = $dcr2 = $dcr3 = [];

        foreach ($dcrs as $dcr) {
            $visitedOutlets = explode(',', $dcr['OutletOrgDataIds']);
            if ($dcr['Moye'] == $d1) {
                $dcr1 = $visitedOutlets;
            } elseif ($dcr['Moye'] == $d2) {
                $dcr2 = $visitedOutlets;
            } elseif ($dcr['Moye'] == $d3) {
                $dcr3 = $visitedOutlets;
            }
        }

        $res = [];
        $orderArray = [];
        foreach ($outlets as $outletID => $name) {
            $sort = 0;
            $check1 = in_array($outletID, $dcr1);
            $check2 = in_array($outletID, $dcr2);
            $check3 = in_array($outletID, $dcr3);

            if ($check1 & $check2 & $check3) {
                continue;
            } else {

                if (!$check1) {
                    $sort = $sort + 1;
                }
                if (!$check2) {
                    $sort = $sort + 1;
                }
                if (!$check3) {
                    $sort = $sort + 1;
                }

                $orderArray[$outletID] = $sort;

                $res[$outletID] =
                    [
                        "Name" => $name,
                        "Moye1" => $d1,
                        "Visited1" => $check1,
                        "Moye2" => $d2,
                        "Visited2" => $check2,
                        "Moye3" => $d3,
                        "Visited3" => $check3,
                    ];
            }

        }

        arsort($orderArray);
        $tmp = [];
        foreach ($orderArray as $o => $k) {
            $tmp[$o . " "] = $res[$o];
        }

        $this->apiResponse($tmp, 200, "Missed Docs");

    }

    /**
     * @OA\Get(
     *     path="/api/getLiquidationReport",
     *     tags={"Reports"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="product_id",
     *         in="query",
     *         description="Product Id",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="brand_id",
     *         in="query",
     *         description="Brand Id",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="outlet_org_id",
     *         in="query",
     *         description="Outlet Org Id",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Liquidation report",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getLiquidationReport()
    {
        $emp = $this->app->Auth()->getUser()->getEmployee();
        $productId = $this->app->Request()->getParameter("product_id", null);
        $brandId = $this->app->Request()->getParameter("brand_id", null);
        $outletOrgId = $this->app->Request()->getParameter("outlet_org_id", null);
        $terr = OrgManager::getMyTerritories($emp);

        $d1 = date('m-Y');
        $d2 = date('m-Y', strtotime("-1 month"));
        $d3 = date('m-Y', strtotime("-2 month"));
        $d4 = date('m-Y', strtotime("-3 month"));
        $d5 = date('m-Y', strtotime("-4 month"));
        $d6 = date('m-Y', strtotime("-5 month"));
        $filterMonths = [$d1, $d2, $d3, $d4, $d5, $d6];

        if (!empty($outletOrgId)) {
            $outlet = OutletViewQuery::create()
                        ->select(['TerritoryId', 'Outlet_Id', 'OutlettypeName', 'OrgUnitId'])
                        ->filterByOutletOrgId($outletOrgId)
                        ->findOne();

            $outletOrgIds = OutletMappingViewQuery::create()
                        ->select(['OutletOrgId'])
                        ->filterByPrimaryOutletId($outlet['Outlet_Id'])
                        ->filterByOutlettypeName($outlet['OutlettypeName'])
                        ->filterByOrgUnitId($outlet['OrgUnitId'])
                        ->filterByTerritoryId($outlet['TerritoryId'])
                        ->find()
                        ->toArray();

            $outletOrgIds[] = $outletOrgId;
        } else {
            $outletOrgIds = [];
        }

        $outletStockSummary = OutletStockSummaryQuery::create()
                                ->select(['moye', 'sumClosingQty'])
                                ->withColumn('sum(outlet_stock_summary.closing_qty)', 'sumClosingQty')
                                ->filterByMoye($filterMonths)
                                ->filterByCompanyId($emp->getCompanyId())
                                ->filterByOrgunitid($emp->getOrgUnitId())
                                ->addjoin('outlet_stock_summary.outlet_org_id', 'outlet_view.outlet_org_id', Criteria::INNER_JOIN)
                                ->where('outlet_view.territory_id in (' . implode(',', $terr). ')');

        if (!empty($brandId)) {
            $outletStockSummary->filterByBrandId($brandId);
        }

        if (!empty($productId)) {
            $outletStockSummary->filterByProductId($productId);
        }

        if (!empty($outletOrgIds)) {
            $outletStockSummary->filterByOutletOrgId($outletOrgIds);
        }

        $outletStockSummary = $outletStockSummary->groupByMoye()->find()->toArray();

        $outletStockOtherSummary = OutletStockOtherSummaryQuery::create()
                                ->select(['moye', 'sumSaleQty', 'sumReturnQty'])
                                ->withColumn('sum(outlet_stock_other_summary.sale_qty)', 'sumSaleQty')
                                ->withColumn('sum(outlet_stock_other_summary.return_qty)', 'sumReturnQty')
                                ->filterByMoye($filterMonths)
                                ->filterByCompanyId($emp->getCompanyId())
                                ->filterByOrgunitid($emp->getOrgUnitId())
                                ->addjoin('outlet_stock_other_summary.outlet_org_id', 'outlet_view.outlet_org_id', Criteria::INNER_JOIN)
                                ->where('outlet_view.territory_id in (' . implode(',', $terr). ')');

        if (!empty($brandId)) {
            $outletStockOtherSummary->filterByBrandId($brandId);
        }

        if (!empty($productId)) {
            $outletStockOtherSummary->filterByProductId($productId);
        }

        if (!empty($outletOrgId)) {
            $outletStockOtherSummary->filterByOutletOrgId($outletOrgId);
        }

        $outletStockOtherSummary = $outletStockOtherSummary->groupByMoye()->find()->toArray();

        $reportData = [];
        foreach($outletStockSummary as $summary) {
            if(!isset($reportData[$summary['moye']])) {
                $reportData[$summary['moye']] = ['closingQty' => 0, 'salesQty' => 0, 'returnQty' => 0];
            }
            $reportData[$summary['moye']]['closingQty'] = $summary['sumClosingQty'];
        }

        foreach($outletStockOtherSummary as $summary) {
            if(!isset($reportData[$summary['moye']])) {
                $reportData[$summary['moye']] = ['closingQty' => 0, 'salesQty' => 0, 'returnQty' => 0];
            }
            $reportData[$summary['moye']]['salesQty'] = $summary['sumSaleQty'];
            $reportData[$summary['moye']]['returnQty'] = $summary['sumReturnQty'];
        }

        $data = [];
        foreach($filterMonths as $month) {
            if(!isset($reportData[$month])) {
                $data[$month] = ['closingQty' => 0, 'salesQty' => 0, 'returnQty' => 0];
            } else {
                $data[$month] = $reportData[$month];
            }
        }

        $this->apiResponse($data, 200, "Liquidation Report");

    }
}

