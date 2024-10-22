<?php

declare(strict_types=1);

namespace Modules\SGPI\Controllers;

use App\System\App;
use BI\manager\OrgManager;
use BI\manager\SGPIManager;
use BI\requests\SGPITransferRequest;
use entities\EmployeeQuery;
use entities\OutletBrandSgpiMapQuery;
use entities\OutletSgpiCompliant;
use entities\OutletSgpiCompliantQuery;
use entities\OutletSgpiCompliantViewQuery;
use entities\OutletViewQuery;
use entities\OutletVisitsViewQuery;
use entities\SgpiAccountsQuery;
use entities\SgpiEmployeeBalance;
use entities\SgpiEmployeeBalanceQuery;
use entities\SgpiMasterQuery;
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
     *     path="/api/getSGPIBalance",
     *     tags={"SGPI API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="employee_id",
     *         in="query",
     *         description="Employee Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="brand_id",
     *         in="query",
     *         description="Brand Id",
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="outlettype_id",
     *         in="query",
     *         description="Outlet Type Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get all outlet types successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getSGPIBalance()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $employee_id = $this->app->Request()->getParameter("employee_id", 0);
                $brandId = $this->app->Request()->getParameter("brand_id", 0);
                $outlettypeId = $this->app->Request()->getParameter("outlettype_id", 0);
                
                $sgpi = SgpiEmployeeBalanceQuery::create()->filterByEmployeeId($employee_id);

                if(!empty($brandId)){
                    $sgpi->filterByBrandId($brandId);
                }

                if(!empty($outlettypeId)) {
                    $sgpi->filterByOutlettypeId($outlettypeId);
                }
                
                $sgpi = $sgpi->find()->toArray();

                $sgpiAccount = SgpiAccountsQuery::create()->findByEmployeeId($employee_id)->toArray();

                $this->apiResponse(["account" => $sgpiAccount, "balance" => $sgpi], 200, "Get SGPI Balance");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getSGPIAccounts",
     *     tags={"SGPI API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get all outlet types successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getSGPIAccounts()
    {
        $empRec = $this->app->Auth()->getUser()->getEmployee();
        $empids = \Modules\HR\Runtime\HrHelper::findEmpsUnder($empRec->getPositionId());

        $finalEmps = array_merge([$empRec->getEmployeeId()], $empids);

        $sgpiAccounts = SgpiAccountsQuery::create()->filterByEmployeeId($finalEmps)->find()->toArray();
        $ledgers = SgpiAccountsQuery::create()->filterBySgpiAccountId(0, Criteria::LESS_THAN)->find()->toArray();

        $this->apiResponse(array_merge($sgpiAccounts, $ledgers), 200, "Get SGPI Balance");

    }

    /**
     * @OA\Post(
     *     path="/api/transferSGPI",
     *     tags={"SGPI API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     * @OA\RequestBody(
     *          required=true,
     *          description="Transfer Request",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="from_sgpi_account",
     *                  type="string",
     *                  format="string",
     *                  example="1"
     *              ),
     *              @OA\Property(
     *                  property="to_sgpi_account",
     *                  type="string",
     *                  format="string",
     *                  example="1"
     *              ),
     *              @OA\Property(
     *                  property="remark",
     *                  type="string",
     *                  format="string",
     *                  example="1"
     *              ),
     *              @OA\Property(
     *                  property="lines",
     *                  type="array",
     *                  collectionFormat="multi",
     *                  @OA\Items(
     *                      type="string",
     *                      example={
     *                          {
     *                              "sgpi_id":"1",
     *                              "qty":"3"
     *                          },
     *                          {
     *                              "sgpi_id":"2",
     *                              "qty":"5"
     *                          },
     *                      },
     *                  )
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="SGPI Transfered successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function transferSGPI()
    {
        switch ($this->app->Request()->getMethod()):
            case "POST" :
                $from_sgpi_account = $this->app->Request()->getParameter("from_sgpi_account", 0);
                $to_sgpi_account = $this->app->Request()->getParameter("to_sgpi_account", 0);
                $remark = $this->app->Request()->getParameter("remark", "");
                $lines = $this->app->Request()->getParameter("lines");

                $manager = new SGPIManager();

                $messages = [];
                foreach ($lines as $line) {
                    $trf = new SGPITransferRequest();
                    $trf->setFrom_sgpi_account_id($from_sgpi_account);
                    $trf->setTo_sgpi_account_id($to_sgpi_account);
                    $trf->setSgpi_id($line->sgpi_id);
                    $trf->setQty($line->qty);
                    $trf->setRemark($remark);
                    $trf->setCompany_id($this->app->Auth()->CompanyId());
                    $trf = $manager->doTransfer($trf);
                    $messages[$line->sgpi_id] = $trf->getMessage();
                }

                $this->apiResponse($messages, 200, "Get SGPI Balance");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getSGPIConsitency",
     *     tags={"SGPI API's"},
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
     *         description="Month-Year",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="position_id",
     *         in="query",
     *         description="position_id (optional)",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="classification_id",
     *         in="query",
     *         description="classification_id (optional)",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get all outlet types successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getSGPIConsitency()
    {
        $moye = $this->app->Request()->getParameter("moye", date("m-Y"));
        $classification_id = $this->app->Request()->getParameter("classification_id", false);
        $positionid = $this->app->Request()->getParameter("position_id", null);
        if ($positionid == null) {
            $positionid = $this->app->Auth()->getUser()->getEmployee()->getPositionId();
        }


        $visits = OutletVisitsViewQuery::create()->filterByPositionId($positionid)->filterByMoye($moye);

        if ($classification_id) {
            $visits->filterByOutletClassification($classification_id);
        }

        $visits = $visits->find()->count();


        $sgpi_done = OutletVisitsViewQuery::create()
            ->filterByPositionId($positionid)
            ->filterByMoye($moye)
            ->filterBySgpiDone(0, Criteria::GREATER_THAN);

        if ($classification_id) {
            $sgpi_done->filterByOutletClassification($classification_id);
        }

        $sgpi_done = $sgpi_done->find()->count();

        $percent = 0;
        if ($sgpi_done > 0 && $visits > 0) {
            $percent = ($sgpi_done / $visits) * 100;
        }
        $this->apiResponse(["visits" => $visits, "sgpi_done" => $sgpi_done, "percent" => $percent], 200, "Get SGPI Balance");

    }

    /**
     * @OA\Get(
     *     path="/api/getSgpiType",
     *     tags={"SGPI API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get all outlet types successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */

    public function getSgpiType()
    {
        $orgUnit = $this->app->Auth()->getUser()->getEmployee()->getOrgUnitId();
        $types = SgpiMasterQuery::create()
            ->select(['SgpiType'])
            ->filterByOrgUnitId($orgUnit)
            ->groupBySgpiType()
            ->orderBySgpiType()
            ->find()
            ->toArray();
        $this->apiResponse($types, 200, "Get SGPI Balance");
    }

    /**
     * @OA\Get(
     *     path="/api/getSgpiDistribution",
     *     tags={"SGPI API's"},
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
     *         description="Month-Year",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="sgpi_type",
     *         in="query",
     *         description="Sgpi_Type",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="position_id",
     *         in="query",
     *         description="position_id",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="brand_id",
     *         in="query",
     *         description="brand_id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get all outlet types successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */

    public function getSgpiDistribution()
    {
        $moye = $this->app->Request()->getParameter("moye", date("m-Y"));
        $sgpiType = $this->app->Request()->getParameter("sgpi_type", null);
        $brandId = $this->app->Request()->getParameter("brand_id", null);
        $positionId = $this->app->Request()->getParameter("position_id", $this->app->Auth()->getUser()->getEmployee()->getPositionId());

        if (!empty($brandId) && strtolower($brandId) == 'all') {
            $brandId = null;
        }

        $positions = OrgManager::getUnderPositions($positionId);
        $positionIds = array_merge($positions, [$positionId]);
        $monthYear = explode('-', $moye)[1] . '-' . explode('-', $moye)[0];
        $startDate = date('Y-m-01', strtotime($monthYear));

        $noOfOutlets = $noOfDrMet = $percent = $leakSgpis = 0;

        // $noOfOutlets = OutletBrandSgpiMapQuery::create()
        //                 ->select('total_count')
        //                 ->withColumn("count(distinct CONCAT(outlet_brand_sgpi_map.org_data_id, '|', outlet_brand_sgpi_map.brand_id))", 'total_count')
        //                 ->addjoin('outlet_brand_sgpi_map.org_data_id', 'outlet_view.outlet_org_id', Criteria::INNER_JOIN)
        //                 ->addjoin('outlet_brand_sgpi_map.brand_id', 'sgpi_master.brand_id', Criteria::INNER_JOIN)
        //                 ->where('outlet_view.position_id in (' . implode(',', $positionIds) . ')')
        //                 ->where("sgpi_master.use_start_date >= '" . $startDate . "'")
        //                 ->filterBySgpiStatus(true);

        $noOfOutlets = OutletSgpiCompliantViewQuery::create()
                        ->select('total_count')
                        ->withColumn("count(distinct CONCAT(outlet_sgpi_compliant_view.org_data_id, '|', outlet_sgpi_compliant_view.brand_id))", 'total_count')
                        ->addjoin('outlet_sgpi_compliant_view.sgpi_id', 'sgpi_master.sgpi_id', Criteria::INNER_JOIN)
                        ->filterByPositionId($positionIds)
                        ->filterBySgpiStatus(true)
                        ->where("date_trunc('month', sgpi_master.use_start_date)::date <= '" . $startDate . "'")
                        ->filterByMoye($moye);

        $noOfDrMet = OutletSgpiCompliantViewQuery::create()
                        ->select('total_count')
                        ->withColumn("count(distinct CONCAT(outlet_sgpi_compliant_view.org_data_id, '|', outlet_sgpi_compliant_view.brand_id))", 'total_count')
                        ->addjoin('outlet_sgpi_compliant_view.sgpi_id', 'sgpi_master.sgpi_id', Criteria::INNER_JOIN)
                        ->filterByCompliant('Yes')
                        ->filterByPositionId($positionIds)
                        ->filterBySgpiStatus(true)
                        ->where("date_trunc('month', sgpi_master.use_start_date)::date <= '" . $startDate . "'")
                        ->filterByMoye($moye);

        $leakSgpis = OutletSgpiCompliantViewQuery::create()
                        ->select('total_count')
                        ->withColumn("count(distinct CONCAT(outlet_sgpi_compliant_view.org_data_id, '|', outlet_sgpi_compliant_view.brand_id))", 'total_count')
                        ->addjoin('outlet_sgpi_compliant_view.sgpi_id', 'sgpi_master.sgpi_id', Criteria::INNER_JOIN)
                        ->filterByCompliant('Yes')
                        ->filterByPositionId($positionIds)
                        ->filterBySgpiStatus(false)
                        ->where("date_trunc('month', sgpi_master.use_start_date)::date <= '" . $startDate . "'")
                        ->filterByMoye($moye);

        if (!empty($sgpiType)) {
            // $noOfOutlets->where("sgpi_master.sgpi_type = '" . $sgpiType. "'");
            $noOfOutlets->filterBySgpiType($sgpiType);
            $noOfDrMet->filterBySgpiType($sgpiType);
            $leakSgpis->filterBySgpiType($sgpiType);
        }

        if (!empty($brandId)) {
            $noOfOutlets->filterByBrandId($brandId);
            $noOfDrMet->filterByBrandId($brandId);
            $leakSgpis->filterByBrandId($brandId);
        }
                        
        $noOfOutlets = $noOfOutlets->findOne();
        $noOfDrMet = $noOfDrMet->findOne();
        $leakSgpis = $leakSgpis->findOne();

        if ($noOfOutlets > 0) {
            $percent = $noOfDrMet / $noOfOutlets * 100;
        }

        $this->apiResponse(["Balance" => ($noOfOutlets - $noOfDrMet), "Credit" => $noOfOutlets, "Debit" => $noOfDrMet, "Percentage" => number_format($percent, 2), 'Leaks' => $leakSgpis], 200, "MTP");
    }

    public function getSgpiDistributionOld()
    {
        $moye = $this->app->Request()->getParameter("moye", date("m-Y"));
        $sgpiType = $this->app->Request()->getParameter("sgpi_type", null);
        $brandId = $this->app->Request()->getParameter("brand_id", "All");
        $positionId = $this->app->Request()->getParameter("position_id", $this->app->Auth()->getUser()->getEmployee()->getPositionId());
        $expDate = explode('-', $moye);
        $date = $expDate[1] . '-' . $expDate[0] . '-' . '01';
        $edate = $expDate[1] . '-' . $expDate[0] . '-' . '31';

        $employee = EmployeeQuery::create()
            ->select(['EmployeeId'])
            ->filterByPositionId($positionId)
            ->find()->toArray();

        $sgpiMaster = SgpiMasterQuery::create()->select(['SgpiId'])->filterByUseStartDate($date, Criteria::GREATER_EQUAL)->filterByUseStartDate($edate, Criteria::LESS_EQUAL);

        if ($brandId != "All") {
            $sgpiMaster->filterByBrandId($brandId);
        }

        if ($sgpiType != null) {

            $sgpiMaster->filterBySgpiType($sgpiType);
        }


        $sgpiMaster = $sgpiMaster->find()->toArray();


        $sgpi = SgpiEmployeeBalanceQuery::create()
            ->filterBySgpiId($sgpiMaster)
            ->filterByEmployeeId($employee)
            ->find()->toArray();
        $balance = 0;
        $credit = 0;
        $debit = 0;
        foreach ($sgpi as $s) {
            $balance += $s['Balance'];
            $credit += $s['Credits'];
            $debit += $s['Debits'];
        }
        $per = 0;
        if ($debit > 0 && $credit > 0) {

            $per = $debit / $credit * 100;
        }

        $this->apiResponse(["Balance" => $balance, "Credit" => $credit, "Debit" => $debit, "Percentage" => number_format($per, 2)], 200, "MTP");


    }

    /**
     * @OA\Get(
     *     path="/api/getSgpiTrend",
     *     tags={"SGPI API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="employee_id",
     *         in="query",
     *         description="employee_id (optional)",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="start_date",
     *         in="query",
     *         description="Start Date",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="end_date",
     *         in="query",
     *         description="End Date",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_tag_id",
     *         in="query",
     *         description="Outlet Tag",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get all outlet types successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getSgpiTrend()
    {
        $employee_id = $this->app->Request()->getParameter("employee_id", null);
        $outletTag = $this->app->Request()->getParameter("outlet_tag_id", "All");
        $startDate = $this->app->Request()->getParameter("start_date",date('Y-m-01'));
        $endDate = $this->app->Request()->getParameter("end_date",date('Y-m-t'));
        $moye = $this->app->Request()->getParameter("moye", date('m-y'));
        if ($employee_id == null) {
            $employee_id = $this->app->Auth()->getUser()->getEmployeeId();
        }

        $empRec = EmployeeQuery::create()->findPk($employee_id);
        $positionId = $empRec->getPositionId();

        $outletView = [];

        $sgpiMaster = [];
        if ($outletTag != "All") {

            $sgpiMaster = SgpiMasterQuery::create()->select(['SgpiId'])->filterByOrgUnitId($empRec->getOrgUnitId())->find()->toArray();
        }

//        var_dump($sgpiMaster);exit;

        $trendArr = [];
        $tArr = [];        
        $startMonthNumber = date('m', strtotime($startDate));
        $endMonthNumber = date('m', strtotime($endDate));

        $startYear = date('Y', strtotime($startDate));

        $monthsTogether = [];

        for ($monthNumber = $startMonthNumber; $monthNumber <= $endMonthNumber; $monthNumber++) {
            $formattedMonth = sprintf('%02d-%d', $monthNumber, $startYear);
            $monthsTogether[] = $formattedMonth;
        }

        foreach ($monthsTogether as $months) {

            $trend = SgpiEmployeeBalanceQuery::create()
                ->withColumn("sum(Credits)", "Credits")
                ->withColumn("sum(Debits)", "Debits")
                ->filterByEmployeeId($employee_id)
                ->filterByMoye($months)
                ->select(["Credits", "Debits"]);

            if ($outletTag != "All") {
                $trend->filterBySgpiId($sgpiMaster);
            }
            $trend = $trend->find()->toArray();
            if ($trend[0]['Credits'] != null) {
                $tArr['Credits'] = intval($trend[0]['Credits'] * 1);
            } else {
                $tArr['Credits'] = 0;
            }

            if ($trend[0]['Debits'] != null) {

                $tArr['Debits'] = intval($trend[0]['Debits'] * 1);
            } else {
                $tArr['Debits'] = 0;
            }
            $tArr['Moye'] = $months;
            $trendArr[] = $tArr;
        }


        $this->apiResponse($trendArr, 200, "Get SGPI Trend");
    }

    /**
     * @OA\Get(
     *     path="/api/getSgpiTransactionView",
     *     tags={"SGPI API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="sgpi_id",
     *         in="query",
     *         description="Sgpi Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="employee_id",
     *         in="query",
     *         description="Employee Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Sgpi transaction successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getSgpiTransactionView()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $sgpiId = $this->app->Request()->getParameter("sgpi_id");
                $employeeId = $this->app->Request()->getParameter("employee_id");

                if($employeeId != null && $employeeId != ''){
                    $sgpiTransactions = \entities\SgpiTransactionViewQuery::create()
                                        ->filterBySgpiId((int)$sgpiId)
                                        ->filterByEmployeeId((int)$employeeId)
                                        ->find()->toArray();
                }else{
                    $sgpiTransactions = \entities\SgpiTransactionViewQuery::create()
                                        ->filterBySgpiId((int)$sgpiId)->find()->toArray();
                }
                    
                $this->apiResponse($sgpiTransactions, 200, "Get Sgpi transaction successfully");
                break;
        endswitch;
    }

}
