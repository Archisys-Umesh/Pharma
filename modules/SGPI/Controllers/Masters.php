<?php

declare(strict_types=1);

namespace Modules\SGPI\Controllers;

use App\System\App;
use App\Utils\FormMgr;

use entities\SgpiTrans;
use App\Core\MediaManager;
use BI\manager\OrgManager;
use entities\OutletTypeQuery;
use entities\SgpiMasterQuery;
use entities\SgpiAccountsQuery;
use entities\SgpiEmployeeBalanceQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Exception;

/**
 * Description of Masters
 *
 * @author Plus91Labs-01
 */
class Masters extends \App\Core\BaseController
{

    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    function SGPIMaster()
    {

        $mediaManager = new MediaManager($this->app);

        $this->data['title'] = "SGPI Category";
        $this->data['form_name'] = "SGPIMaster";
        $this->data['cols'] = [
            "SgpiMedia" => "SgpiMedia",
            "Name" => "SgpiName",
            "SgpiType" => "SgpiType",
            "SgpiStatus" => "SgpiStatus",
            "UseStartDate" => "UseStartDate",
            "UseEndDate" => "UseEndDate",
            "OrgUnitId" => "OrgUnit.UnitName",
            "Brand" => "Brands.BrandName",
            "OutletType" => "OutletType.OutlettypeName",
            "IsStrategic" => "IsStrategic"
        ];

        $this->data['pk'] = "SgpiId";

        $this->data['mediaCol'] = "SgpiMedia";

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);


        switch ($action):
            case "":

                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":
                ini_set('memory_limit', '-1');
                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\SgpiMasterQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId());
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    // Strip unwanted symbols from the search term
                    $cleanSearch = str_replace('%', '', $search);

                    // Check if the cleaned search term is numeric
                    if (is_numeric($cleanSearch)) {
                        // If numeric, perform direct numeric comparison
                        $query->filterBySgpiName($cleanSearch)
                            ->_or()->filterBySgpiType($cleanSearch)
                            ->_or()->filterBySgpiStatus($cleanSearch)
                            ->_or()->useOrgUnitQuery()->filterByUnitName($cleanSearch)->endUse()
                            ->_or()->useBrandsQuery()->filterByBrandName($cleanSearch)->endUse()
                            ->_or()->useOutletTypeQuery()->filterByOutlettypeName($cleanSearch)->endUse();
                    } else {
                        // If not numeric, perform string-based search with LIKE
                        $search = '%' . $cleanSearch . '%'; // Add % wildcards for LIKE queries

                        $query->filterBySgpiName($search, Criteria::LIKE)
                            ->_or()->filterBySgpiType($search, Criteria::LIKE)
                            ->_or()->filterBySgpiStatus($search, Criteria::LIKE)
                            ->_or()->useOrgUnitQuery()->filterByUnitName($search, Criteria::LIKE)->endUse()
                            ->_or()->useBrandsQuery()->filterByBrandName($search, Criteria::LIKE)->endUse()
                            ->_or()->useOutletTypeQuery()->filterByOutlettypeName($search, Criteria::LIKE)->endUse();
                    }
                }


                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->joinWithOrgUnit()->leftJoinWithBrands()->leftJoinWithOutletType()->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);
                break;
                break;
            case "form":

                $OrgUnitId = \entities\OrgUnitQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Orgunitid", "UnitName");
                $brandList = \entities\BrandsQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("BrandId", "BrandName");
                $outletType = \entities\Base\OutletTypeQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId())->filterByIsenabled(1)->find()->toKeyValue("OutlettypeId", "OutlettypeName");

                $f = FormMgr::formHorizontal();
                $f->add([
                    'SgpiName' => FormMgr::text()->label('Name *')->required()->minlength(5)->pattern('^[A-Za-z]+$'),
                    'SgpiCode' => FormMgr::text()->label('Code *')->required(),
                    'MaterialSku' => FormMgr::text()->label('SKU *')->required(),
                    'SgpiType' => FormMgr::select()->options($this->getConfig("SGPI", "SgpiType"))->label('Type'),
                    'SgpiStatus' => FormMgr::select()->options($this->getConfig("SGPI", "Status"))->label('Status'),
                    'UseStartDate' => FormMgr::date()->label('Use Start Date *')->required(),
                    'UseEndDate' => FormMgr::date()->label('Use End Date *')->required(),
                    'OrgUnitId' => FormMgr::select()->options($OrgUnitId)->label('OrgUnit'),
                    'BrandId' => FormMgr::select()->options($brandList)->label('Brand'),
                    'OutlettypeId' => FormMgr::select()->options($outletType)->label('Outlet Type'),
                    'IsStrategic' => FormMgr::checkbox()->label('Is Strategic?'),
                ]);
                $sgpiRec = new \entities\SgpiMaster();
                $this->data['form_name'] = "Add SGPI Master";
                if ($pk > 0) {
                    $sgpiRec = \entities\SgpiMasterQuery::create()
                        ->findPk($pk);
                    $f->val($sgpiRec->toArray());
                    $this->data['form_name'] = "Edit SGPI Maste";
                    $this->data['canDelete'] = true;
                }
                if ($this->app->isPost() && $f->validate()) {
                    $action = $this->app->Request()->getParameter("buttonValue");
                    if ($action == "delete") {
                        try {
                            $sgpiRec->delete();
                        } catch (Exception $e) {
                            $this->app->Session()->setFlash("error", "You are not able to delete because of child record created!!");
                            $this->data['form'] = $f->html();
                            $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                            return;
                        }
                    } else {
                        $data = $_POST;
                        $data['IsStrategic'] = (isset($_POST['IsStrategic']) ? true : false);
                        $sgpiRec->fromArray($data);
                        $sgpiRec->setCompanyId($this->app->Auth()->CompanyId());
                        $sgpiRec->save();
                    }
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $form = $f->html();

                $sgpi_val = [];
                if ($sgpiRec->getSgpiMedia() > 0) {
                    $sgpi_val = [$sgpiRec->getSgpiMedia()];
                }


                $mediaInput = $mediaManager->FormInput("SgpiMedia", "Media", $sgpi_val, 1);
                $this->data['form'] = $form . $mediaInput;
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;

        endswitch;
    }


    public function SGPITransactions()
    {


        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action):
            case "":

                $this->data['title'] = "Transactions";
                $this->data['form_name'] = "Transactions";
                $this->data['cols'] = [
                    "SgpiTranId" => "SgpiTranId",
                    "SgpiName" => "SgpiMaster.SgpiName",
                    "AccountName" => "SgpiAccounts.AccountName",
                    "Cd" => "Cd",
                    "Qty" => "Qty",
                    "VoucherNo" => "VoucherNo",
                    "Remark" => "Remark",
                    "CreatedAt" => "CreatedAt",
                ];

                $this->data['pk'] = "SgpiTranId";

                $this->data['valKeys'] = ["Cd" => $this->getConfig("SGPI", "CD")];
                //$this->data['rowButtons'] = ["survey_question" => "zmdi zmdi-layers"];

                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "list":
                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\SgpiTransQuery::create()->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')->filterByCompanyId($this->app->Auth()->CompanyId());
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query = $query->filterBySgpiName($search, Criteria::LIKE);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->joinWithSgpiMaster()->joinWithSgpiAccounts()->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);
                break;
            case "form":

                $CD = $this->getConfig("SGPI", "CD");
                $sgpis = SgpiMasterQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->find()->toKeyValue("SgpiId", "SgpiName");

                $accounts = SgpiAccountsQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->find()->toKeyValue("SgpiAccountId", "AccountName");

                $f = FormMgr::formHorizontal();
                $f->add([
                    'SgpiId' => FormMgr::select()->options($sgpis)->label('SGPI')->required(),
                    'SgpiAccountId' => FormMgr::select()->options($accounts)->label('Account *')->required(),
                    'Cd' => FormMgr::select()->options($CD)->label('Credit/Debit *')->required(),
                    'Qty' => FormMgr::number()->label('Qty *')->required(),
                    'VoucherNo' => FormMgr::text()->label('VoucherNo *')->required(),
                    'Remark' => FormMgr::text()->label('Remark *')->required(),

                ]);

                $tran = new SgpiTrans();
                $this->data['form_name'] = "Add Trans";
                if ($pk > 0) {
                    $tran = \entities\SgpiTransQuery::create()
                        ->findPk($pk);
                    $f->val($tran->toArray());
                    $this->data['form_name'] = "Edit Trans";
                    $this->data['canDelete'] = true;
                }
                if ($this->app->isPost() && $f->validate()) {
                    $action = $this->app->Request()->getParameter("buttonValue");
                    if ($action == "delete") {
                        $tran->delete();
                    } else {
                        $tran->fromArray($_POST);
                        $tran->setCompanyId($this->app->Auth()->CompanyId());
                        $tran->save();
                    }
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $form = $f->html();
                $this->data['form'] = $form;
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    public function SGPIBalance()
    {

        $action = $this->app->Request()->getParameter("action");
        switch ($action):
            case "":
                $roles = $this->app->Auth()->getUser()->getRoles()->getRoleName();
                $positionId = $this->app->Auth()->getUser()->getEmployee()->getPositionId();

                $data = OrgManager::getUnderPositions($positionId);
                if ($roles == "DivisionHead" && $roles == "ClusterHead") {

                    if ($data == null) {
                        $employeeId = "";
                    } else {
                        $employeeId = \entities\EmployeeQuery::create()
                            ->filterByPositionId($data)
                            ->filterByCompanyId($this->app->Auth()->CompanyId())
                            ->filterByStatus(1)
                            ->orderByFirstName()
                            ->find()->toKeyValue("EmployeeId", "FirstName");
                    }
                } else {
                    $employeeId = \entities\EmployeeQuery::create()
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->filterByStatus(1)
                        ->orderByFirstName()
                        ->find()->toKeyValue("EmployeeId", "FirstName");
                }
                $employeeId = array_merge(array('0' => 'All Employee'), $employeeId);
                $f = FormMgr::form();
                $f->add([
                    "Employee" => FormMgr::select()->label("Select Employee : ")->options($employeeId)->id('emplistwidth150'),
                ]);
                $this->data['filters'] = $f->html();
                $this->data['cols'] = [
                    "EmployeeId" => "EmployeeId",
                    "SgpiAccountId" => "SgpiAccountId",
                    "SgpiId" => "SgpiId",
                    "SgpiName" => "SgpiName",
                    "SgpiType" => "SgpiType",
                    "UseStartDate" => "UseStartDate",
                    "UseEndDate" => "UseEndDate",
                    "Balance" => "Balance",

                ];

                $this->data['reportname'] = "SGPIBalance";
                $this->data['title'] = "SGPI Balance Report";
                $this->data['Rowid'] = "Uniquecode";
                $this->data['RowClick'] = false;
                $this->data['Download'] = true;
                $this->app->Renderer()->render("reports/reportViewer.twig", $this->data);
                break;
            case "result":

                $empId = $this->app->Request()->getParameter("Employee");

                $balance = SgpiEmployeeBalanceQuery::create()
                    ->filterByEmployeeId($empId)->find()->toArray();

                if ($this->app->Request()->getParameter("download", false)) {
                    $this->download_array_csv($balance, "balance_.csv");
                    exit;
                }
                $this->json(["aaData" => array_values($balance)]);
                break;
            case "RowClick":
                //$orderId = $this->app->Request()->getParameter("RowId");
                //$this->app->Response()->redirect($this->app->Router()->getPath("order",["id"=>$orderId]));
                break;
            default:
                $this->json(["aaData" => []]);
                break;
        endswitch;
    }

    function sgpiTransactionView()
    {

        $this->data['title'] = "Transactions View";
        $this->data['form_name'] = "TransactionsView";
        $this->data['cols'] = [
            "EmployeeCode" => "EmployeeCode",
            "OutletName" => "OutletName",
            "OutlettypeName" => "OutlettypeName",
            "BeatName" => "BeatName",
            "DcrDate" => "DcrDate",
            "SgpiName" => "SgpiName",
            "Cd" => "Cd",
            "Qty" => "Qty",
            "Credits" => "Credits",
            "Debits" => "Debits",
            "Remark" => "Remark",
            "UseStartDate" => "UseStartDate",
            "UseEndDate" => "UseEndDate",
        ];
        $this->data['disableAdd'] = true;
        $this->data['pk'] = "EmployeeCode";
        // $this->data['mediaCol'] = "MediaId";

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action):
            case "":

                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":

                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\SgpiTransactionViewQuery::create();
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query = $query->filterByEmployeeCode($search, Criteria::LIKE)
                        ->_or()
                        ->filterByOutletName($search, Criteria::LIKE)
                        ->_or()
                        ->filterByOutlettypeName($search, Criteria::LIKE)
                        ->_or()
                        ->filterByBeatName($search, Criteria::LIKE)
                        ->_or()
                        ->filterByDcrDate($search, Criteria::LIKE)
                        ->_or()
                        ->filterBySgpiName($search, Criteria::LIKE)
                        ->_or()
                        ->filterByCd($search, Criteria::LIKE)
                        ->_or()
                        ->filterByCredits($search, Criteria::LIKE)
                        ->_or()
                        ->filterByDebits($search, Criteria::LIKE)
                        ->_or()
                        ->filterByRemark($search, Criteria::LIKE)
                        ->_or()
                        ->filterByUseStartDate($search, Criteria::LIKE)
                        ->_or()
                        ->filterByUseEndDate($search, Criteria::LIKE);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);
                break;
            case "download":
                $employeeId = $this->app->Request()->getParameter("employee_id");
                $sgpiId = $this->app->Request()->getParameter("sgpi_id");

                $sgpiTransaction = \entities\SgpiTransactionViewQuery::create()
                    ->filterByEmployeeId($employeeId)
                    ->filterBySgpiId($sgpiId)
                    ->find()->toArray();

                $this->download_array_csv($sgpiTransaction, "SgpiTransaction_.csv");
                exit;
                break;
        endswitch;
    }
}
