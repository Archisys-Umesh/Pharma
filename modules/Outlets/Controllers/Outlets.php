<?php

declare(strict_types=1);

namespace Modules\Outlets\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use entities\Base\OutletOrgDataQuery as BaseOutletOrgDataQuery;
use BI\manager\OrgManager;
use entities\OrgUnitQuery;
use entities\GeoTownsQuery;
use entities\DarViewQuery;
use entities\OutletAddressQuery;
use entities\OutletOrgDataQuery;
use entities\OutletsQuery;
use entities\OutletTagsQuery;
use entities\OutletTypeQuery;
use entities\OutletViewQuery;
use entities\RcpaSummaryQuery;
use entities\SgpiOutSummaryQuery;
use entities\TerritoriesQuery;
use entities\BeatsQuery;
use entities\PositionsQuery;
use entities\TerritoryTownsQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use DateTime;

class Outlets extends \App\Core\BaseController
{

    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function addeditOutlet($pk)
    {
        $outletType = \entities\Base\OutletTypeQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->filterByIsenabled(1)
            ->find()
            ->toKeyValue("OutlettypeId", "OutlettypeName");


        $classification = \entities\Base\ClassificationQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find()
            ->toKeyValue("Id", "Classification");

        $f = FormMgr::formHorizontal();
        $f->add([
            'OutlettypeId' => FormMgr::select()->options($outletType)->label('Type'),
            'OutletClassification' => FormMgr::select()->options($classification)->label('Classification'),
            'OutletName' => FormMgr::text()->label('Name *')->required(),
            'OutletCode' => FormMgr::text()->label('Cust Code *')->required(),
            'OutletSalutation' => FormMgr::select()->options($this->getConfig("Outlets", "salutation"))->label('Salutation'),
            'OutletContactName' => FormMgr::text()->label('Contact Name *')->required(),
            'OutletOpeningDate' => FormMgr::date()->label('Opening Date *')->required(),
            'OutletIsdCode' => FormMgr::text()->label('Isd Code'),
            'OutletContactNo' => FormMgr::text()->label('Contact No *')->required(),
            'OutletLandlineno' => FormMgr::text()->label('Landline No'),
            'OutletEmail' => FormMgr::email()->label('Email *')->required(),
            'Itownid' => FormMgr::text()->label('Town *')->datatoggle("locationAutoComplete")->required(),
            'OutletContactBday' => FormMgr::date()->label('Birthdate *')->required(),
            'OutletContactAnniversary' => FormMgr::date()->label('Anniversary '),
            'OutletStatus' => FormMgr::select()->options($this->getConfig("Outlets", "OutletStatus"))->label('Status'),
            'OutletPotential' => FormMgr::number()->label('Potential Monthly Sales*')->required(),
            'OutletQualification' => FormMgr::text()->label('Qualification *')->required(),
            'OutletRegno' => FormMgr::text()->label('Regno *')->required(),
            'OutletMaritalStatus' => FormMgr::select()->options($this->getConfig("Outlets", "MaritalStatus"))->label('MaritalStatus'),

        ]);

        $outlet = new \entities\Outlets();

        $this->data['form_name'] = "Add Outlet";
        if ($pk > 0) {
            $outlet = \entities\OutletsQuery::create()
                ->findPk($pk);
            $f->val($outlet->toArray());
            $itown = $outlet->getGeoTowns();
            $f["Itownid"]->sudoValue($itown->getStownname() . " | " . $itown->getGeoCity()->getScityname());
            $this->data['form_name'] = "Edit Outlet";
        }
        if ($this->app->isPost() && $f->validate()) {
            $outlet->fromArray($_POST);
            $outlet->setCompanyId($this->app->Auth()->CompanyId());
            $outlet->save();
            $this->runModalScript("reloadGrid()");
            return;
        }
        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
    }

    public function outletList()
    {
        ini_set('memory_limit', '-1');
        if (!$this->isAjax()) {

            $this->data["outletType"] = \entities\Base\OutletTypeQuery::create()
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->filterByIsenabled(1)
                ->find()
                ->toKeyValue("OutlettypeId", "OutlettypeName");

            $this->data["orgUnit"] = OrgUnitQuery::create()
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->find()
                ->toKeyValue("Orgunitid", "UnitName");

            $this->data["outletStatus"] = $this->getConfig("Outlets", "OutletStatus");


            $this->data["Classification"] = \entities\ClassificationQuery::create()
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->find()
                ->toKeyValue("Id", "Classification");

            $this->data["Classification"]["all"] = "all";

            $this->app->Renderer()->render("outlets/outletsList.twig", $this->data);
        } else {
            /*echo '<pre>';
            var_dump($_GET);exit;*/
            if (isset($_GET['page'])) {
                $page = (int)$_GET['page'];
            } else {
                $page = 1;
            }
            $outletSearchText = $this->app->Request()->getParameter("outletSearchText", "");
            $outletType = $this->app->Request()->getParameter("outletType", -1);
            $outletStatus = $this->app->Request()->getParameter("outletStatus", "all");

            $Classification = $this->app->Request()->getParameter("Classification", "all");
            $division = $this->app->Request()->getParameter("division", "all");

//            $outlets = $this->findOutlets($outletSearchText, $outletType, $outletStatus, $Classification);

            $outlets = OutletViewQuery::create()
                ->filterByCompanyId($this->app->Auth()->CompanyId());

            // $outlets->filterByOutletName("%" . $outletSearchText . "%", Criteria::LIKE);
            /* if (!empty($outletSearchText)) {
                 $outlets->filterById($outletSearchText);
             }*/

            if (!empty($outletSearchText)) {
                $outlets->filterByOutlet_Id($outletSearchText)->_or()->filterByOutletName("%" . $outletSearchText . "%", \Propel\Runtime\ActiveQuery\Criteria::LIKE)->_or()->filterByOutletCode("%" . $outletSearchText . "%", \Propel\Runtime\ActiveQuery\Criteria::LIKE);
            }

            /*if (!empty($outletSearchText)) {
                $outlets->filterByOutletName("%" . $outletSearchText . "%", \Propel\Runtime\ActiveQuery\Criteria::LIKE);
            }*/


            if ($outletType > 0) {
                $outlets->filterByOutlettypeId($outletType);
            }
            if ($outletStatus != "all") {
                $outlets->filterByOutletStatus($outletStatus);
            }
            if ($Classification != "all") {
                $outlets->filterByOutletClassification($Classification);
            }

            if ($division != "all") {
                $outlets->filterByOrgUnitId($division);
            }

            $outlets->findByCompanyId($this->app->Auth()->CompanyId());
            $pager = $outlets->paginate($page, 10);
            $links = $pager->getLinks();
            $pageLinks = [];

            if (count($links) > 6) {
                $pageLinks = array_slice($links, 0, 3);
                $pageLinks[] = '...';
                $pageLinks = array_slice($links, -3, 3, true);
            } else {
                $pageLinks = $links;

            }
            $paginateItems = [
                'records' => $pager->getResults()->toArray(),
                'pagination' => [
                    'total_records' => $pager->getNbResults(),
                    'needsPagination' => $pager->haveToPaginate(),
                    'currentPage' => $page,
                    'links' => $pageLinks,
                    'isFirstPage' => $pager->isFirstPage(),
                    'isLastPage' => $pager->isLastPage(),
                ]
            ];
            $this->json($paginateItems);
        }
    }

    public function findOutlets($outletSearchText, $outletType, $status = "all", $Classification = "all"): \Propel\Runtime\Collection\ObjectCollection
    {

        $outlets = \entities\Base\OutletsQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId());

        // $outlets->filterByOutletName("%" . $outletSearchText . "%", Criteria::LIKE);
        if (!empty($outletSearchText)) {
            $outlets->filterById($outletSearchText);
        }

        if ($outletType > 0) {
            $outlets->filterByOutlettypeId($outletType);
        }
        if ($status != "all") {
            $outlets->filterByOutletStatus($status);
        }
        if ($Classification != "all") {
            $outlets->filterByOutletClassification($Classification);
        }

        return $outlets->find();
    }

    public function outletsingle($pk)
    {

        $action = $this->app->Request()->getParameter("action", "");

        switch ($action) :
            case "":
                $outlet = \entities\OutletsQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->filterByPrimaryKey($pk)
                    ->findOne();


                $this->data["outlet"] = $outlet;
                $this->app->Renderer()->render("outlets/outletSingle.twig", $this->data);
                break;
            case "orgdata":
                $this->json(["data" => OutletOrgDataQuery::create()
                    ->joinWithOrgUnit()
                    ->joinWithGeoTowns()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->filterByOutletId($pk)->find()->toArray()]);
                break;
            case "outletAddress":
                $this->json(["data" => OutletAddressQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->filterByOutletId($pk)->find()->toArray()]);
                break;
        endswitch;

    }

    public function getOutletByOutletCode($outletCode) {
        $outlet = \entities\OutletsQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->filterByOutletCode($outletCode)
            ->findOne();

        $this->data["outlet"] = $outlet;
        $this->app->Renderer()->render("outlets/outletSingle.twig", $this->data);
    }

    public function outletAccount($id = 0)
    {

        $outletAccounts = \entities\OutletAccountDetailsQuery::create()->findByOutletId($id)->getFirst();

        $pricebooks = \entities\PricebooksQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find()
            ->toKeyValue("PricebookId", "PricebookName");
        $types = $this->getConfig("Catalogue", "CategoryTypes");

        $f = FormMgr::formHorizontal();

        $f->add([
            'OutletBankName' => FormMgr::text()->label('Bank Name')->id('PersonalBank'),
            'OutletAccountNo' => FormMgr::text()->label('Account Number')->id('PersonalAccountNumber'),
            'OutletPan' => FormMgr::text()->label('PanNo')->id('OutletPan'),
            'OutletGst' => FormMgr::text()->label('GST Number')->id('OutletGst'),
            'OutletCompanyName' => FormMgr::text()->label('Billing Name')->id('OutletCompanyName'),
            'OutletIntegrationCode' => FormMgr::text()->label('SAP Code')->id('OutletIntegrationCode'),
            'OutletDefaultPricebook' => FormMgr::select()->options($pricebooks)->label('Default Sale PriceBook'),
            'OutletDefaultCategory' => FormMgr::select()->options($types)->label('Default Product Category'),
        ]);

        if ($outletAccounts == null) {
            $outletAccounts = new \entities\OutletAccountDetails();
        } else {
            $vals = $outletAccounts->toArray();
            $f->val($vals);
        }

        if ($this->app->isPost()) {

            if ($f->validate()) {

                $outletAccounts->fromArray($_POST);
                $outletAccounts->setOutletId($id);
                $outletAccounts->save();
                $f->val($outletAccounts->toArray());
            }
        }
        $this->data['form'] = $f->html();

        $this->data["formName"] = "Account Details";
        $this->app->Renderer()->render("widgetForm.twig", $this->data);
    }

    public function OutletMapping($id)
    {
        $action = $this->app->Request()->getParameter("action");
        $mappingid = $this->app->Request()->getParameter("mappingid", 0);

        switch ($action) :
            case "list":
                $this->json(["data" => \entities\OutletMappingQuery::create()
                    ->joinWithPricebooks()
                    ->joinWithOutlets()
                    ->findBySecondaryOutletId($id)->toArray()]);
                break;
            case "form":

                $outlet = \entities\OutletsQuery::create()->findPk($id);

                $OutletparentID = $outlet->getOutletType()->getOutletparent();

                $parents = \entities\OutletsQuery::create()
                    ->filterByOutlettypeId($outlet->getOutletType()->getOutletparent())
                    ->filterByOutletStatus('active')
                    //->filterByTerritoryId($outlet->getTerritoryId())
                    ->find()
                    ->toKeyValue("Id", "OutletName");

                $pricebooks = \entities\PricebooksQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->find()
                    ->toKeyValue("PricebookId", "PricebookName");
                $types = $this->getConfig("Catalogue", "CategoryTypes");

                $f = FormMgr::formHorizontal();
                $f->add([
                    'PrimaryOutletId' => FormMgr::select()->options($parents)->label('Primary')->required(),
                    'PricebookId' => FormMgr::select()->options($pricebooks)->label('PriceBook')->required(),
                    'CategoryType' => FormMgr::select()->options($types)->label('Category Types')->required(),
                    'Isdefault' => FormMgr::checkbox()->label('Default')->id("Isdefault"),
                ]);

                $outletMapping = new \entities\OutletMapping();
                $this->data['form_name'] = "Add Primary Outlet";

                if ($mappingid > 0) {
                    $outletMapping = \entities\OutletMappingQuery::create()->findPk($mappingid);

                    $f->val($outletMapping->toArray());

                    if ($outletMapping->getIsdefault() == 1) {
                        $f['Isdefault']->checked();
                    }

                    $this->data['form_name'] = "Edit Primary Outlet";
                }
                if ($this->app->isPost() && $f->validate()) {

                    $outletMapping->fromArray($_POST);
                    $outletMapping->setSecondaryOutletId($id);

                    if (!empty($_POST['Isdefault'])) {

                        $outletMapping->setIsdefault(1);
                        \entities\OutletMappingQuery::create()->filterBySecondaryOutletId($id)->update(["Isdefault" => 0]);

                    } else {
                        $outletMapping->setIsdefault(0);
                    }
                    $outletMapping->save();
                    $this->runModalScript("reloadMapping()");
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    function outletStock($id)
    {
        if ($this->isAjax()) {
            $action = $this->app->Request()->getParameter("action");

            switch ($action) :
                case "list":
                    $keys = \entities\ProductsQuery::create()->findByCompanyId($this->app->Auth()->CompanyId());
                    $lines = \entities\OutletStockQuery::create()->findByOutletId($id)->toKeyIndex("ProductId");

                    $data = [];

                    foreach ($keys as $k) {

                        $val = [
                            "ProductId" => $k->getPrimaryKey(),
                            "ProductName" => $k->getProductName() . " | " . $k->getProductSku() . " | " . $k->getPackingDesc(),
                            "Category" => $k->getCategories()->getCategoryName(),
                            "LineId" => 0,
                            "FreeQty" => 0,
                            "ReservedQty" => 0,
                            "BsdQty" => 0,
                        ];

                        if (isset($lines[$k->getPrimaryKey()])) {

                            $val["FreeQty"] = $lines[$k->getPrimaryKey()]->getFreeQty();
                            $val["ReservedQty"] = $lines[$k->getPrimaryKey()]->getReservedQty();
                            $val["BsdQty"] = $lines[$k->getPrimaryKey()]->getBsdQty();
                            $val["LineId"] = $lines[$k->getPrimaryKey()]->getPrimaryKey();
                        }
                        array_push($data, $val);
                    }
                    $this->json(["data" => $data]);
                    break;
                case "save":

                    $data = $this->app->Request()->getParameter("data");

                    $collection = new \Propel\Runtime\Collection\ObjectCollection();
                    $collection->setModel(\entities\OutletStock::class);

                    //$keys = [];
                    foreach ($data as $d) {

                        if ($d['LineId'] > 0) {
                            $pbl = \entities\OutletStockQuery::create()->findPk($d['LineId']);
                        } else {
                            $pbl = new \entities\OutletStock;
                            $pbl->setProductId($d['ProductId']);
                            $pbl->setCompanyId($this->app->Auth()->getUser()->getCompanyId());
                            $pbl->setOutletId($id);
                        }


                        $pbl->setFreeQty($d['FreeQty']);
                        $pbl->setReservedQty($d['ReservedQty']);
                        $pbl->setBsdQty($d['BsdQty']);

                        $collection->append($pbl);
                    }

                    $collection->save();

                    $this->json(["status" => "okay"]);

                    break;
            endswitch;
        } else {
            $this->data['os'] = \entities\OutletsQuery::create()
                ->findPk($id);
            $this->app->Renderer()->render("outlets/outletStocks.twig", $this->data);
        }
    }

    function AddEditoutletOrgData($id)
    {
        $pk = $this->app->Request()->getParameter("OutletOrgId");
        $f = FormMgr::formHorizontal();
        if ($pk == 0) {
            $orgUnitThatExists = OutletOrgDataQuery::create()
                ->select(["OrgUnitId"])
                ->filterByOutletId($id)
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->find()->toArray();
            $ogunit = OrgUnitQuery::create()
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->filterByOrgunitid($orgUnitThatExists, Criteria::NOT_IN)
                ->find()->toKeyValue("Orgunitid", "UnitName");
            $f->add([
                'OrgUnitId' => FormMgr::select()->options($ogunit)->label('Org Unit')
            ]);
        }
        $tags = OutletTagsQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find()->toKeyValue("TagName", "TagName");
        $address = OutletAddressQuery::create()->findByOutletId($id);
        $addressArray = [];
        foreach ($address as $add) {
            $addressArray[$add->getPrimaryKey()] = $add->getAddressName() . " | " . $add->getOutletAddress() . " " . $add->getOutletStreetName();
        }

        $f->add([
            'Tags' => FormMgr::select()->options($tags)->label('Tags')->class("multi-select")->multiple("multiple"),
            'DefaultAddress' => FormMgr::select()->options($addressArray)->label('DefaultAddress'),
            'VisitFq' => FormMgr::select()->options($this->getConfig("Outlets", "VisitFq"))->label('VisitFq'),
            'Comments' => FormMgr::text()->label('Comments')->required(),
            'OrgPotential' => FormMgr::text()->label('Potential')->required(),
            'BrandFocus' => FormMgr::text()->label('BrandFocus')->required(),
            'CustomerFq' => FormMgr::text()->label('CustomerFq')->required(),
            'InvestedAmount' => FormMgr::text()->label('Invested Amount'),
        ]);

        $OutletOrgData = new \entities\OutletOrgData();

        $this->data['form_name'] = "Add OutletOrg";
        if ($pk > 0) {
            $OutletOrgData = \entities\OutletOrgDataQuery::create()->findPk($pk);
            $f->val($OutletOrgData->toArray());

            if ($OutletOrgData->getTags() != null) {
                $f["Tags"]->val(explode(",", $OutletOrgData->getTags()));
            }

            $this->data['form_name'] = "Edit OutletOrg";
        }
        if ($this->app->isPost() && $f->validate()) {

            $outlet = OutletsQuery::create()->findPk($id);
            $address = OutletAddressQuery::create()->findPk($_POST["DefaultAddress"]);

            $_POST["Tags"] = implode(",", $_POST["Tags"]);
            $OutletOrgData->fromArray($_POST);
            $OutletOrgData->setOutletId($id);
            $OutletOrgData->setItownid($address->getItownid());
            $OutletOrgData->setCompanyId($this->app->Auth()->CompanyId());
            $OutletOrgData->save();
            $this->runModalScript("reloadorgData()");
            return;
        }
        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
    }

    function AddEditoutletAddress($id)
    {
        $pk = $this->app->Request()->getParameter("OutletAddressId");
        $f = FormMgr::formHorizontal();
        $f->add([
            'AddressName' => FormMgr::select()->options($this->getConfig("Outlets", "AddressName"))->label('AddressName'),
            'OutletAddress' => FormMgr::text()->label('Address')->required(),
            'OutletStreetName' => FormMgr::text()->label('StreetName')->required(),
            'OutletCity' => FormMgr::text()->label('City')->required(),
            'Itownid' => FormMgr::text()->label('Town *')->datatoggle("locationAutoComplete")->required(),
            'OutletState' => FormMgr::text()->label('State')->required(),
            'OutletPincode' => FormMgr::text()->label('Pincode')->required(),
        ]);

        $OutletAddress = new \entities\OutletAddress();

        $this->data['form_name'] = "Add Address";
        if ($pk > 0) {
            $OutletAddress = \entities\OutletAddressQuery::create()->findPk($pk);
            $f->val($OutletAddress->toArray());

            $itown = $OutletAddress->getGeoTowns();
            $f["Itownid"]->sudoValue($itown->getStownname() . " | " . $itown->getGeoCity()->getScityname());

            $this->data['form_name'] = "Edit Address";
        }
        if ($this->app->isPost() && $f->validate()) {

            $OutletAddress->fromArray($_POST);
            $OutletAddress->setOutletId($id);
            $OutletAddress->setCompanyId($this->app->Auth()->CompanyId());
            $OutletAddress->save();
            $this->runModalScript("reloadAddress()");
            return;
        }
        $this->data['form'] = $f->html();
        $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
    }

    public function outletAutoComplete()
    {
        $q = $this->app->Request()->getParameter("term");
        $t = $this->app->Request()->getParameter("type");
//        var_dump($q);exit;
        $res = [];

        $outlets = \entities\OutletsQuery::create()
            ->condition('cond1', 'LOWER(Outlets.OutletName) like ?', strtolower($q) . "%")
            ->condition('cond2', 'Outlets.OutletCode like ?', "%" . $q . "%")
            ->where(array('cond1', 'cond2'), 'or')
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->limit(100)
            ->find();
//        var_dump($outlets);exit;
        foreach ($outlets as $outlet) {

            if ($t == "from" && $outlet->getOutletType()->getIsoutletendcustomer() == 1) {
                continue;
            }

            $res[] = ["label" => $outlet->getOutletName() . " | " . $outlet->getOutletCode() . " | " . $outlet->getOutletType()->getOutlettypeName()
                , "value" => $outlet->toArray()
                , "id" => $outlet->getPrimaryKey()];

        }

        $this->json($res);
    }

    public function outletOrgDataAutoComplete()
    {
        $q = $this->app->Request()->getParameter("term");
        $res = [];

        $outlets = \entities\OutletViewQuery::create()
            ->condition('cond1', 'OutletView.OutletName like ?', $q . "%")
            ->condition('cond2', 'OutletView.OutletCode like ?', "%" . $q . "%")
            ->where(array('cond1', 'cond2'), 'or')
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->limit(100)
            ->find();

        foreach ($outlets as $outlet) {

            $res[] = ["label" => $outlet->getOutletName() . " | " . $outlet->getOutletCode() . " | " . $outlet->getOutlettypeName()
                , "value" => $outlet->toArray()
                , "id" => $outlet->getPrimaryKey()];

        }

        $this->json($res);
    }

    public function outletOutComes()
    {
        $this->data['title'] = "OutletOutcomes";
        $this->data['form_name'] = "OutletOutcomes";
        $this->data['cols'] = [
            "Type" => "Type",
            "Reason" => "Reason",
        ];
        $this->data['pk'] = "OutletOutcomeId";
        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);
        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "list":
                $this->json(["data" => \entities\OutletOutcomesQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toArray()]);
                break;
            case "form":
                $f = FormMgr::formHorizontal();
                $types = $this->getConfig("System", "Type");
                $outlets = \entities\OutletTypeQuery::create()->filterByCompanyId($this->app->Auth()->companyId())->find()->toKeyValue("OutlettypeId", "OutlettypeName");
                $f->add([
                    'Type' => FormMgr::select()->options($types)->label('Type'),
                    'Reason' => FormMgr::text()->label('Reason'),
                    'OutletTypeId' => FormMgr::select()->options($outlets)->label('Outlet Type'),
                ]);
                $checkinoutOutcomes = new \entities\OutletOutcomes();
                $this->data['form_name'] = "Add OutletOutcome";
                if ($pk > 0) {
                    $checkinoutOutcomes = \entities\OutletOutcomesQuery::create()
                        ->findPk($pk);
                    $f->val($checkinoutOutcomes->toArray());
                    $this->data['form_name'] = "Edit OutletOutcome";
                }
                if ($this->app->isPost() && $f->validate()) {
//                    var_dump($_POST,$this->app->Auth()->getUser()->getCompanyId());exit;
                    $checkinoutOutcomes->fromArray($_POST);
                    $checkinoutOutcomes->setCompanyId($this->app->Auth()->getUser()->getCompanyId());
                    $checkinoutOutcomes->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    /*function outletOutComes() {
        $this->data['title'] = "Outcomes";
        $this->data['form_name'] = "Outcome";
        $this->data['cols'] = [
            "Outcome" => "OutcomeName",
            "Factor" => "OutcomeFactor",
        ];
        $this->data['pk'] = "Id";
        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);
        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "list":
                $this->json(["data" => \entities\CheckinoutOutcomesQuery::create()
                            ->findByCompanyId($this->app->Auth()->CompanyId())->toArray()]);
                break;
            case "form":
                $f = FormMgr::formHorizontal();
                $f->add([
                    'OutcomeName' => FormMgr::text()->label('Name *')->required(),
                    'OutcomeFactor' => FormMgr::checkbox()->label('Factor'),
                ]);
                $checkinoutOutcomes = new \entities\CheckinoutOutcomes();
                $this->data['form_name'] = "Add Outcome";
                if ($pk > 0) {
                    $checkinoutOutcomes = \entities\CheckinoutOutcomesQuery::create()
                            ->findPk($pk);
                    $f->val($checkinoutOutcomes->toArray());
                    $this->data['form_name'] = "Edit Outcome";
                }
                if ($this->app->isPost() && $f->validate()) {
                    $checkinoutOutcomes->fromArray($_POST);
                    $checkinoutOutcomes->setCompanyId($this->app->Auth()->CompanyId());
                    $checkinoutOutcomes->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }*/

    public function classification()
    {
        $this->data['title'] = "Classifications";
        $this->data['form_name'] = "Classifications";
        $this->data['cols'] = [
            "Classification" => "Classification",
        ];
        $this->data['pk'] = "Id";
        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);
        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":
                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\ClassificationQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId());
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query = $query->filterByClassification($search, Criteria::LIKE);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);
                break;
            case "form":
                $f = FormMgr::formHorizontal();
                $f->add([
                    'Classification' => FormMgr::text()->label('Classification *')->required(),
                ]);
                $classification = new \entities\Classification();
                $this->data['form_name'] = "Add Classification";
                if ($pk > 0) {
                    $classification = \entities\ClassificationQuery::create()
                        ->findPk($pk);
                    $f->val($classification->toArray());
                    $this->data['form_name'] = "Edit Classification";
                }
                if ($this->app->isPost() && $f->validate()) {
                    $classification->fromArray($_POST);
                    $classification->setCompanyId($this->app->Auth()->CompanyId());
                    $classification->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    public function tags()
    {

        $this->data['title'] = "Tags";
        $this->data['form_name'] = "Tags";
        $this->data['cols'] = [
            "TagName" => "TagName",
        ];

        $this->data['pk'] = "OutletTagId";

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);
        switch ($action):
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":
                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\OutletTagsQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId())->orderByCreatedAt('desc');
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query = $query->filterByTagName($search, Criteria::LIKE);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);
                break;
            case "form":
                $f = FormMgr::formHorizontal();
                $f->add([
                    'TagName' => FormMgr::text()->label('Tag Name *')->required(),
                ]);
                $tag = new \entities\OutletTags();
                $this->data['form_name'] = "Add Tag";
                if ($pk > 0) {
                    $tag = \entities\OutletTagsQuery::create()
                        ->findPk($pk);
                    $f->val($tag->toArray());
                    $this->data['form_name'] = "Edit Tag";
                }
                if ($this->app->isPost() && $f->validate()) {
                    $tagName = $_POST['TagName'];
                    $tagCheck = \entities\OutletTagsQuery::create()->findOneByTagName($tagName);
                    if ($tagCheck && $tagCheck->getPrimaryKey() != $pk) {
                        $this->app->Session()->setFlash("error", "Tag Name Already Exists");
                    } else {
                        $tag->fromArray($_POST);
                        $tag->setCompanyId($this->app->Auth()->CompanyId());
                        $tag->save();
                        $this->runModalScript("loadGrid()");
                        return;
                    }
                }

                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    public function internalNotes($id)
    {

        $this->data['form_name'] = "OutletOrgNotes";
        $this->data['cols'] = [
            "NoteDate" => "NoteDate",
            "Title" => "NoteTitle",
            "Note" => "Note",
            "Orgunitid" => "Orgunitid",
        ];

        $pk = $this->app->Request()->getParameter("pk", 0);

        $this->data['title'] = "OutletOrgNotes";
        $this->data['pk'] = "OutletOrgNoteId";
        $action = $this->app->Request()->getParameter("action");


        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "list":
                $this->json(["data" => \entities\OutletOrgNotesQuery::create()
                    ->filterByOutletOrgDataId($id)
                    ->findByCompanyId($this->app->Auth()->CompanyId())->toArray()]);
                break;
            case "form":


                $f = FormMgr::formHorizontal();
                $f->add([

                    'NoteDate' => FormMgr::date()->label('Note Date *')->required(),
                    'NoteTitle' => FormMgr::text()->label('Title  *')->required(),
                    'Note' => FormMgr::text()->label('Note  *')->required(),

                ]);
                $outletNotes = new \entities\OutletOrgNotes();
                $this->data['form_name'] = "Add Internal Notes";
                if ($pk > 0) {
                    $outletNotes = \entities\OutletOrgNotesQuery::create()->findPk($pk);
                    $f->val($outletNotes->toArray());
                    $this->data['form_name'] = "Edit Internal Notes";
                }
                if ($this->app->isPost() && $f->validate()) {

                    $outorgData = OutletOrgDataQuery::create()->findPk($id);

                    $outletNotes->fromArray($_POST);
                    $outletNotes->setOutletOrgDataId($id);
                    $outletNotes->setOrgunitid($outorgData->getOutletOrgId());
                    $outletNotes->setCompanyId($this->app->Auth()->CompanyId());
                    $outletNotes->setEmployeeId($this->app->Auth()->getUser()->getEmployeeId());
                    $outletNotes->save();

                    $this->runModalScript("reloadorgData()");
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    public function outletOrg($id)
    {

        $action = $this->app->Request()->getParameter("action", "");
        $this->data['monthList'] = FormMgr::select()
            ->options(\Modules\ESS\Runtime\EssHelper::getMonths(12))
            ->html();
        switch ($action) :
            case "":

                $outlet = OutletViewQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->filterByPrimaryKey($id)
                    ->findOne();

                $orgUnit = OrgUnitQuery::create()
                    ->filterByOrgunitid($outlet->getOrgUnitId())
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->findOne();

                $town = GeoTownsQuery::create()
                    ->filterByItownid($outlet->getItownid())
                    ->findOne();

                $this->data['outlet'] = $outlet;
                $this->data['orgUnit'] = $orgUnit;
                $this->data['town'] = $town;

                $this->data["outletOrg"] = OutletOrgDataQuery::create()->findPk($id);

                $this->data['id_fields'] = [
                    "Managers",
                    "TerritoryId",
                    "OutletClassification",
                    "Orgunitid"
                ];

                $this->app->Renderer()->render("outlets/outletOrg.twig", $this->data);
                break;
            case "outletDarView":
                extract($this->DTFilters($_GET));
                $response = [];

                $dailyCalls = \entities\DailycallsQuery::create()
                    ->select(['DcrDate','DcrStatus','OutletOrgDataId','Managers','BrandsDetailed',])
                    ->innerJoinWithOutletOrgData()
                    ->innerJoinWith('OutletOrgData.Outlets')
                    ->withColumn('Outlets.OutletCode', 'OutletCode')
                    ->withColumn('Outlets.OutletName', 'OutletName')
                    ->innerJoinWithAgendatypes()
                    ->withColumn('Agendatypes.Agendname', 'Agendname')
                    ->leftJoinWithGeoTowns()
                    ->withColumn('GeoTowns.Stownname', 'Stownname')
                    ->withColumn("(SELECT STRING_AGG(((Sm.Sgpi_name || ' (' || Ds.Sgpi_qty) || ')'), ',') FROM dailycalls_sgpiout Ds JOIN sgpi_master Sm ON Sm.Sgpi_id = Ds.Sgpi_id WHERE Ds.Dailycall_id = Dailycalls.Dcr_id)", 'SgpiOut')
                    ->withColumn("(select first_name  from employee  e where e.employee_id = Dailycalls.EmployeeId)", 'FirstName')
                    ->withColumn("CASE WHEN Dailycalls.DayPlanId = 0 THEN 'No' ELSE 'Yes' END", 'Planned')
                    ->withColumn('COALESCE(Dailycalls.EdDuration, 0)', 'EdDuration')
                    ->withColumn('0.0','PobTotal')
                    ->filterByOutletOrgDataId($id);

                $count = (clone $dailyCalls)->count();
                $response["recordsTotal"] = $count;
                $response["recordsFiltered"] = $count;
                $response['data'] = $dailyCalls->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)
                    ->find()->toArray();

                $this->json($response);
                break;
            case "sgpiOut":
                $month = $this->app->Request()->getParameter("month", "|");
                $mon = date('m-Y', strtotime($month));
                extract($this->DTFilters($_GET));
                $response = [];
                $query = SgpiOutSummaryQuery::create()->filterByOutletOrgdataId($id)->filterByMoye($mon);
                $count = (clone $query)->count();
                $response["recordsTotal"] = $count;
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)
                    ->find()->toArray();
                $this->json($response);

                // $this->json(["data" => SgpiOutSummaryQuery::create()
                // ->find()->toArray()]);
                break;
            case "rcpaSummary":

                $month = $this->app->Request()->getParameter("month", "|");
                $mon = date('m-Y', strtotime($month));
                extract($this->DTFilters($_GET));
                $response = [];
                $query = RcpaSummaryQuery::create()->filterByOutletOrgId($id)->filterByRcpaMoye($mon);
                $count = (clone $query)->count();
                $response["recordsTotal"] = $count;
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)
                    ->find()->toArray();
                $this->json($response);

                // $this->json(["data" => RcpaSummaryQuery::create()
                // ->find()->toArray()]);
                break;
            case "internalNotes":

                $this->json(["data" => \entities\OutletOrgNotesQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->filterByOutletOrgDataId($id)
                    ->find()->toArray()]);
                /*$notes = \entities\OutletOrgNotesQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->filterByOutletOrgDataId($id)
                    ->find();*/


                /* $this->data["internal_notes"] = $notes;
                 $this->app->Renderer()->render("outlets/outletOrg.twig", $this->data);*/
                break;

        endswitch;
    }

    public function leads()
    {


        $action = $this->app->Request()->getParameter("action");


        switch ($action) :
            case "":
                $f = FormMgr::form();
                $f->add([
                    "startdate" => FormMgr::date()->label("Start date")->required(),
                    "enddate" => FormMgr::date()->label("End date")->required(),
                ]);
                $this->data['filters'] = $f->html();

                $this->data['cols'] = [
                    "FirstName" => "FirstName",
                    "LastName" => "LastName",
                    "Email" => "Email",
                    "Mobile" => "Mobile",
                    "Gender" => "Gender",
                    "Dob" => "Dob",
                    "MaritalStatus" => "MaritalStatus",
                ];

                $this->data['Download'] = true;

                $this->app->Renderer()->render("reports/reportServerSideViewer.twig", $this->data);
//                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "init":
                $response = [];
                $response["recordsTotal"] = 0;
                $response["recordsFiltered"] = 0;
                $response["data"] = [];

                $this->json($response);
                break;
            case "result":

                $startDate = $this->app->Request()->getParameter("startdate");
                $enddate = $this->app->Request()->getParameter("enddate");

                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\LeadsQuery::create()
                    ->filterByCreatedAt($startDate, Criteria::GREATER_THAN)
                    ->filterByCreatedAt($enddate, Criteria::LESS_THAN)
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->orderByLeadId(\Propel\Runtime\ActiveQuery\ModelCriteria::DESC);
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query = $query->filterByClassification($search, Criteria::LIKE);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $data = $query->offset($offset)->limit($limit)->find()->toArray();

                $result = [];
                foreach ($data as $d) {

                    $result[$d['LeadId']] = [
                        "FirstName" => $d['FirstName'],
                        "LastName" => $d['LastName'],
                        "Email" => $d['Email'],
                        "Mobile" => $d['Mobile'],
                        "Gender" => $d['Gender'],
                        "Dob" => $d['Dob'],
                        "MaritalStatus" => $d['MaritalStatus'],
                    ];

                }

                $response['data'] = array_values($result);
                $this->json($response);

                break;
            default:
                $this->json(["aaData" => []]);
                break;

        endswitch;
    }

    function getTerritoryTowns($TerritoryId)
    {
        $towns = TerritoryTownsQuery::create()
            ->joinWithGeoTowns()
            ->filterByTerritoryId($TerritoryId)
            ->find();

        $townArray = [];
        foreach ($towns as $t) {
            $townArray[$t->getItownid()] = $t->getGeoTowns()->getStownname();
        }

        return $townArray;
    }


    function getTerrId($id)
    {
        $this->json(["data" => \entities\BeatsQuery::create()
            ->filterByTerritoryId($id)
            ->filterByCompanyId($this->app->Auth()->companyId())
            ->find()->toKeyValue("BeatId", "BeatName")]);
        return;
    }

    public function contact()
    {
        $action = $this->app->Request()->getParameter("action");
        switch ($action) :
            case "":
                $orgUnitId = OrgUnitQuery::create()
                    ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
                    ->find()->toArray();
                $orgArr = [];

                foreach ($orgUnitId as $org) {
                    $orgArr[] = $org['Orgunitid'];
                }
                $emp = $this->app->Auth()->getUser()->getEmployee();

                $territories = OrgManager::getMyTerritories($emp);
                if ($this->app->Auth()->getUser()->getRoles()->getRoleName() == "Admin") {
                    // $terr = TerritoriesQuery::create()
                    //     ->filterByTerritoryId($territories)
                    //     ->filterByCompanyId($this->app->Auth()->CompanyId())
                    //     ->find()->toKeyValue("TerritoryId", "TerritoryName");

                    $orgUnit = OrgUnitQuery::create()
                        ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
                        ->find()->toKeyValue('Orgunitid', 'UnitName');

                    $outletType = OutletTypeQuery::create()
                        ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
                        ->find()->toKeyValue('OutlettypeId', 'OutlettypeName');

                    $position = PositionsQuery::create()
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->find()->toKeyValue('PositionId', 'PositionName');

                } else {

                    $pos=$this->app->Auth()->getUser()->getEmployee()->getPositionId();
                    $position = PositionsQuery::create()->findPk($pos);
                    $team = explode(",",$position->getCavPositionsDown());

                    // $terr = TerritoriesQuery::create()
                    //     ->filterByTerritoryId($territories)
                    //     ->filterByOrgunitid($orgArr)
                    //     ->filterByCompanyId($this->app->Auth()->CompanyId())
                    //     ->find()->toKeyValue("TerritoryId", "TerritoryName");

                    $orgUnit = OrgUnitQuery::create()
                        ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
                        ->find()->toKeyValue('Orgunitid', 'UnitName');

                    $outletType = OutletTypeQuery::create()
                        ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
                        ->find()->toKeyValue('OutlettypeId', 'OutlettypeName');

                    // $beats = PositionsQuery::create()
                    //     ->filterByTerritoryId($territories)
                    //     ->filterByOrgUnitId($orgArr)
                    //     ->filterByCompanyId($this->app->Auth()->CompanyId())
                    //     ->find()->toKeyValue('BeatId', 'BeatName');

                    $position = PositionsQuery::create()
                        ->filterByPositionId($team,\Propel\Runtime\ActiveQuery\Criteria::IN)
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->find()->toKeyValue('PositionId', 'PositionName');

                }


                $f = FormMgr::formHorizontal();
                $f->add([
                    // 'TerritoryId' => FormMgr::select()->options([0 => '--- All ---'] + $terr)->id('TerritoryId')->label('Territory'),
                    'OrgUnitId' => FormMgr::select()->options([0 => '--- All ---'] + $orgUnit)->label('OrgUnit')->id('BeatId'),
                    'PositionId' => FormMgr::select()->options([0 => '--- All ---'] + $position)->label('Position')->id('BeatId'),
                    'OutletTypeId' => FormMgr::select()->options([0 => '--- All ---'] + $outletType)->label('Outlet Type')->id('BeatId'),

                ]);
                $this->data['filters'] = $f->html();

                $this->data['cols'] = [
                    "Employee" =>"Employee",
                    "OutletName" => "OutletName",
                    "OutletCode" => "OutletCode",
                    "OutletEmail" => "OutletEmail",
                    "OutletSalutation" => "OutletSalutation",
                    "Classification" => "Classification",
                    "OutletOpeningDate" => "OutletOpening_date",
                    "OutletContactName" => "OutletContactName",
                    "OutletContactNo" => "OutletContactNo",
                    "OutletStatus" => "OutletStatus",
                    "OutlettypeName" => "OutlettypeName",
                    "OutletAddress" => "OutletAddress",
                    "OutletStreetName" => "OutletStreetName",
                    "OutletCity" => "OutletCity",
                    "OutletState" => "OutletState",
                    "OutletCountry" => "OutletCountry",
                    "OrgUnitId" => "OrgUnitId",
                    "TerritoryName" => "TerritoryName",
                    "BeatName" => "BeatName",
                    "PositionName" => "PositionName",
                    "Tags" => "Tags",
                    "Sgpi tagging" =>"SgpiBrandMap"
                ];

                $this->data['title'] = "Orgunit Contact List";
                $this->data['Rowid'] = "OutletOrgId";
                $this->data['RowClick'] = true;
                $this->data['Download'] = false;

                $this->app->Renderer()->render("reports/reportViewer.twig", $this->data);
                break;
            case "init":
                $response = [];
                $response["recordsTotal"] = 0;
                $response["recordsFiltered"] = 0;
                $response["data"] = [];

                $this->json($response);
                break;
            case "result":
                // $territoryId = $this->app->Request()->getParameter("TerritoryId");
                // $beatId = $this->app->Request()->getParameter("BeatId");
                $PositionId = $this->app->Request()->getParameter("PositionId");
                $orgUnitID = $this->app->Request()->getParameter("OrgUnitId");
                $OutletTypeId = $this->app->Request()->getParameter("OutletTypeId");

                extract($this->DTFilters($_GET));
                $outletView = OutletViewQuery::create()
                    ->withColumn("(select first_name from employee where employee_id = OutletView.last_visit_employee)",'Employee');
                $count = $outletView->count();
                $response["recordsTotal"] = $count;
                if ($this->app->Auth()->getUser()->getRoles()->getRoleName() != "Admin")
                {
                    $pos=$this->app->Auth()->getUser()->getEmployee()->getPositionId();
                    $position = PositionsQuery::create()->findPk($pos);
                    $team = explode(",",$position->getCavPositionsDown());
                    $outletView->filterByPositionId($team,\Propel\Runtime\ActiveQuery\Criteria::IN);
                }
//                var_dump($this->app->Auth()->getUser()->getRoles()->getRoleName(),$PositionId,$orgUnitID,$OutletTypeId);exit;


                if ($PositionId != "0") {
                    $outletView->filterByPositionId($PositionId);
                }

                if ($orgUnitID != "0") {
                    $outletView->filterByOrgUnitId($orgUnitID);
                }

                if ($OutletTypeId != "0") {
                    $outletView->filterByOutlettypeId($OutletTypeId);
                }

                if (!empty($search)) {
                    // Strip unwanted symbols from the search term
                    $cleanSearch = str_replace('%', '', $search);

                    // Check if the cleaned search term is numeric
                    if (is_numeric($cleanSearch)) {
                        // If numeric, perform direct numeric comparison
                        $outletView->filterByOutletName($cleanSearch)
                            ->_or()->filterByOutletCode($cleanSearch)
                            ->_or()->filterByOutletEmail($cleanSearch)
                            ->_or()->filterByOutletSalutation($cleanSearch)
                            ->_or()->filterByClassification($cleanSearch)
                            ->_or()->filterByOutletOpening_date($cleanSearch)
                            ->_or()->filterByOutletContactName($cleanSearch)
                            ->_or()->filterByOutletContactNo($cleanSearch)
                            ->_or()->filterByOutletStatus($cleanSearch)
                            ->_or()->filterByOutlettypeName($cleanSearch)
                            ->_or()->filterByOutletAddress($cleanSearch)
                            ->_or()->filterByOutletStreetName($cleanSearch);
                    } else {
                        // If not numeric, perform string-based search with LIKE
                        $search = '%' . $cleanSearch . '%'; // Add % wildcards for LIKE queries

                        $outletView->filterByOutletName($search, Criteria::LIKE)
                            ->_or()->filterByOutletCode($search, Criteria::LIKE)
                            ->_or()->filterByOutletEmail($search, Criteria::LIKE)
                            ->_or()->filterByOutletSalutation($search, Criteria::LIKE)
                            ->_or()->filterByClassification($search, Criteria::LIKE)
                            ->_or()->filterByOutletOpening_date($search, Criteria::LIKE)
                            ->_or()->filterByOutletContactName($search, Criteria::LIKE)
                            ->_or()->filterByOutletContactNo($search, Criteria::LIKE)
                            ->_or()->filterByOutletStatus($search, Criteria::LIKE)
                            ->_or()->filterByOutlettypeName($search, Criteria::LIKE)
                            ->_or()->filterByOutletAddress($search, Criteria::LIKE)
                            ->_or()->filterByOutletStreetName($search, Criteria::LIKE);
//                            ->_or()->filterByBeatName($search, Criteria::LIKE);

                    }
                }

                $count = $outletView->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $outletView->offset($offset)->limit($limit)->orderBy($sortColumn,$sortOrder)->find()->toArray();
                $this->json($response);

                break;
            case "RowClick" :
                // $orgUnit = $this->app->Auth()->getUser()->getEmployee()->getOrgUnitId();

                $orgUnit = $this->app->Request()->getParameter("RowId");
                $this->app->Response()->redirect($this->app->Router()->getPath("outletorg", ["id" => $orgUnit]));

                break;

        endswitch;
    }

}
