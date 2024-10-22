<?php

declare(strict_types=1);

namespace Modules\Catalogue\Controllers;

use App\System\App;
use entities\BrandCampiagnVisit;
use entities\BrandCampiagnVisitQuery;
use entities\EmployeeQuery;
use entities\NotificationConfiguration;
use entities\NotificationConfigurationQuery;
use entities\Outlets;
use App\Utils\FormMgr;
use entities\BrandsQuery;
use App\Core\MediaManager;
use BI\manager\MTPManager;
use entities\Base\DesignationsQuery;
use entities\Base\Positions;
use entities\OrgUnitQuery;
use entities\OutletsQuery;
use entities\ProductsQuery;
use entities\OutletTagsQuery;
use entities\SgpiMasterQuery;
use entities\BrandCampiagnQuery;
use entities\OutletMappingQuery;
use entities\BrandCompetitionQuery;
use entities\OutletTypeQuery;
use entities\PositionsQuery;
use entities\SurveyQuestion;
use entities\SurveyQuestionQuery;
use entities\VisitPlanQuery;
use BI\manager\OrgManager;
use DateTime;
use Propel\Runtime\ActiveQuery\Criteria;

class Masters extends \App\Core\BaseController
{
    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    function categories()
    {


        $mediaManager = new MediaManager($this->app);

        $OrgUnitId = \entities\OrgUnitQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Orgunitid", "UnitName");

        $this->data['title'] = "Categories";
        $this->data['form_name'] = "Category";
        $this->data['cols'] = [
            "Media" => "CategoryMedia",
            "OrgunitId" => "OrgunitId",
            "Name" => "CategoryName",
            "Type" => "CategoryType",
            "Description" => "CategoryDescription",
            "DisplayOrder" => "CategoryDisplayOrder",
            "Parent" => "CategoryParentId",
        ];

        $this->data['pk'] = "Id";

        $this->data['mediaCol'] = "CategoryMedia";

        $firstCategories = \entities\CategoriesQuery::create()
            ->filterByCategoryParentId(0)
            ->findByCompanyId($this->app->Auth()->CompanyId());

        $res = [0 => '-TopLevel-'];
        foreach ($firstCategories as $cat) {
            $res[$cat->getPrimaryKey()] = $cat->getCategoryName();
        }

        $this->data['valKeys'] = ["CategoryParentId" => $res, "OrgunitId" => $OrgUnitId];

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action):
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":
                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\CategoriesQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId());
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query = $query->useOrgUnitQuery()
                        ->filterByUnitName($search, Criteria::LIKE)
                        ->endUse()
                        ->_or()
                        ->filterByCategoryType($search, Criteria::LIKE)
                        ->_or()
                        ->filterByCategoryDescription($search, Criteria::LIKE)
                        ->_or()
                        ->filterByCategoryName($search, Criteria::LIKE);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);
                break;
            case "form":

                $types = $this->getConfig("Catalogue", "CategoryTypes");

                $f = FormMgr::formHorizontal();

                $f->add([
                    'OrgunitId' => FormMgr::select()->options($OrgUnitId)->label('Org Unit')->required(),
                    'CategoryName' => FormMgr::text()->label('Name *')->required(),
                    'CategoryType' => FormMgr::select()->options($types)->label('Category Type')->required(),
                    'CategoryDescription' => FormMgr::text()->label('Description *')->required(),
                    'CategoryDisplayOrder' => FormMgr::number()->label('Order *')->required(),
                    'CategoryParentId' => FormMgr::select()->options($res)->label('Parent'),
                    //'CategoryMedia' => FormMgr::text()->class("mediaInput")->label('Icon'),

                ]);
                var_dump($f);exit;
                $categories = new \entities\Categories();
                $this->data['form_name'] = "Add Category";
                if ($pk > 0) {
                    $categories = \entities\CategoriesQuery::create()
                        ->findPk($pk);
                    $f->val($categories->toArray());
                    $this->data['form_name'] = "Edit Category";
                    $this->data['canDelete'] = true;
                }
                if ($this->app->isPost() && $f->validate()) {
                    $action = $this->app->Request()->getParameter("buttonValue");
                    if ($action == "delete") {
                        $categories->delete();
                    } else {
                        if ($_POST['CategoryMedia'] != null) {
                            $mediaId = explode(',', $_POST['CategoryMedia']);
                            $media = $mediaId[0];
                        } else {
                            $media = null;
                        }
                    }

                    $categories->fromArray($_POST);
                    $categories->setCompanyId($this->app->Auth()->CompanyId());
                    $categories->setCategoryMedia($media);
                    $categories->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $form = $f->html();
                $mediaInput = $mediaManager->FormInput("CategoryMedia", "Media", [$categories->getCategoryMedia()], 1);
                $this->data['form'] = $form . $mediaInput;
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    function products()
    {



        $mediaManager = new MediaManager($this->app);

        $this->data['title'] = "Products";
        $this->data['form_name'] = "Product";
        $this->data['cols'] = [
            "Image" => "ProductImages",
            "OrgunitId" => "OrgunitId",
            "Brand" => "BrandId",
            "Category" => "CategoryId",
            "Product Name" => "ProductName",
            "Product Summary" => "ProductSummary",
            "Sku" => "ProductSku",
            "Unit" => "UnitD",
            "Packed As" => "PackingDesc",
            "Price" => "BasePrice"
        ];

        $this->data['pk'] = "Id";
        $this->data['mediaCol'] = "ProductImages";

        $this->data['rowButtons'] = ["brand_competit" => "zmdi zmdi-layers"];

        $Categories = \entities\CategoriesQuery::create()->findByCompanyId($this->app->Auth()->CompanyId());

        $resCat = ["null" => "-"];
        foreach ($Categories as $cat) {
            $resCat[$cat->getPrimaryKey()] = $cat->getCategoryName() . " | " . $cat->getOrgUnit()->getUnitName();
        }

        $brands = \entities\BrandsQuery::create()->findByCompanyId($this->app->Auth()->CompanyId());

        $resBrand = ["null" => "-"];
        foreach ($brands as $b) {
            $orgUnit = $b->getOrgUnit();
            $brandName = $b->getBrandName();
            $primaryKey = $b->getPrimaryKey();
            $resBrand[$primaryKey] = $orgUnit ? $brandName . " | " . $orgUnit->getUnitName() : $brandName;
        }

        $unitskeyvals = \entities\Base\UnitmasterQuery::create()->select(['UnitId', 'UnitCode'])->find();

        $units = ["null" => "-"];
        foreach ($unitskeyvals as $unitskeyval) {
            $units[$unitskeyval['UnitId']] = $unitskeyval['UnitCode'];
        }

        $OrgUnitIds = \entities\OrgUnitQuery::create()->select(['Orgunitid', 'UnitName'])->findByCompanyId($this->app->Auth()->CompanyId());

        $OrgUnitId = ["null" => "-"];
        foreach ($OrgUnitIds as $OrgUnits) {
            $OrgUnitId[$OrgUnits['Orgunitid']] = $OrgUnits['UnitName'];
        }

        $tags = \entities\Base\TagsQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Id", "TagName");

        $this->data['valKeys'] = ["CategoryId" => $resCat, "UnitD" => $units, "OrgunitId" => $OrgUnitId, "BrandId" => $resBrand];

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action):
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":
                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\ProductsQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId());
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query = $query->filterByProductName($search, Criteria::LIKE);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);
                break;
            case "form":

                $f = FormMgr::formHorizontal();
                $f->add([
                    'OrgunitId' => FormMgr::select()->options($OrgUnitId)->label('Org Unit')->required(),
                    'BrandId' => FormMgr::select()->options($resBrand)->label('Brand'),
                    'CategoryId' => FormMgr::select()->options($resCat)->label('Category'),
                    'ProductName' => FormMgr::text()->label('Name *')->required(),
                    'ProductSummary' => FormMgr::text()->label('Summary *')->required(),
                    'UnitD' => FormMgr::select()->options($units)->label('Packing Type'),
                    'TagId' => FormMgr::select()->options($tags)->label('Tag'),
                    'PackingQty' => FormMgr::text()->label('Packed Qty *')->required(),
                    'PackingDesc' => FormMgr::text()->label('Packing Note *')->required(),
                    'ProductSku' => FormMgr::text()->label('SKU *')->required(),
                    'ProductDescription' => FormMgr::textarea()->label('Description *')->required(),
                    'BasePrice' => FormMgr::text()->label('Base Price *')->required(),


                ]);
                $product = new \entities\Products();
                $this->data['form_name'] = "Add Product";
                if ($pk > 0) {
                    $product = \entities\ProductsQuery::create()
                        ->findPk($pk);
                    $f->val($product->toArray());

                    $this->data['form_name'] = "Edit Product";
                }
                if ($this->app->isPost() && $f->validate()) {

                    $action = $this->app->Request()->getParameter("action");
                    if ($action == "delete") {
                        $product->delete();
                    } else {
                        if ($_POST['ProductImages'] != null) {
                            $mediaId = explode(',', $_POST['ProductImages']);
                            $media = $mediaId[0];
                        } else {
                            $media = null;
                        }
                    }

                    $product->fromArray($_POST);
                    $product->setCompanyId($this->app->Auth()->CompanyId());
                    $product->setProductImages($media);
                    $product->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $form = $f->html();
                $mediaInput = $mediaManager->FormInput("ProductImages", "Images", [$product->getProductImages()], 4);
                $this->data['form'] = $form . $mediaInput;
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    function priceBooks()
    {

        $currency = \entities\CurrenciesQuery::create()->find()->toKeyValue("CurrencyId", "Name");

        $this->data['title'] = "Price Books";
        $this->data['form_name'] = "PriceBooks";
        $this->data['cols'] = [
            "Pricebook Name" => "PricebookName",
            "Description" => "PricebookDescription",
            "OrgId" => "OrgId",
        ];

        $this->data['pk'] = "PricebookId";
        $this->data['rowButtons'] = ["cat_priceBookLines" => "zmdi zmdi-layers"];

        $Orgs = \entities\OrgUnitQuery::create()
            ->findByCompanyId($this->app->Auth()->CompanyId());

        $res = ["null" => "-"];
        foreach ($Orgs as $org) {
            $res[$org->getPrimaryKey()] = $org->getUnitName() . ' | ' . $org->getCurrencies()->getName();
        }

        $this->data['valKeys'] = ["OrgId" => $res];

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action):
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":
                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\PricebooksQuery::create()
                    //->filterByOrgId(null,Criteria::NOT_EQUAL)
                    ->filterByCompanyId($this->app->Auth()->CompanyId());
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query = $query->filterByPricebookName($search, Criteria::LIKE);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);
                break;
            case "form":

                $f = FormMgr::formHorizontal();
                $f->add([

                    'PricebookName' => FormMgr::text()->label('Name *')->required(),
                    'OrgId' => FormMgr::select()->options($res)->label('Org Unit')->required(),
                    'PricebookDescription' => FormMgr::text()->label('Description *')->required(),
                ]);
                $pricebook = new \entities\Pricebooks();
                $this->data['form_name'] = "Add Price Books";
                if ($pk > 0) {
                    $pricebook = \entities\PricebooksQuery::create()
                        ->findPk($pk);
                    $f->val($pricebook->toArray());

                    $this->data['form_name'] = "Edit Price Book";
                }
                if ($this->app->isPost() && $f->validate()) {
                    $pricebook->fromArray($_POST);
                    $pricebook->setCompanyId($this->app->Auth()->CompanyId());
                    $pricebook->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    function priceBookLines($id)
    {
        if ($this->isAjax()) {
            $action = $this->app->Request()->getParameter("action");

            switch ($action):
                case "list":
                    $keys = \entities\ProductsQuery::create()->findByCompanyId($this->app->Auth()->CompanyId());
                    $lines = \entities\PricebooklinesQuery::create()->findByPricebookId($id)->toKeyIndex("ProductId");

                    $data = [];

                    foreach ($keys as $k) {

                        $val = [
                            "ProductId" => $k->getPrimaryKey(),
                            "ProductName" => $k->getProductName() . " | " . $k->getProductSku() . " | " . $k->getPackingDesc(),
                            "Category" => $k->getCategories()->getCategoryName() . " (" . $k->getCategories()->getCategoryType() . ")",
                            "Enabled" => 0,
                            "MaxRetailPrice" => 0,
                            "SellingPrice" => 0
                        ];

                        if (isset($lines[$k->getPrimaryKey()])) {
                            $val["Enabled"] = 1;
                            $val["MaxRetailPrice"] = $lines[$k->getPrimaryKey()]->getMaxRetailPrice();
                            $val["SellingPrice"] = $lines[$k->getPrimaryKey()]->getSellingPrice();
                            $val["Enabled"] = $lines[$k->getPrimaryKey()]->getIsenabled();
                            $val["LineId"] = $lines[$k->getPrimaryKey()]->getPrimaryKey();
                        }
                        array_push($data, $val);
                    }
                    $this->json(["data" => $data]);
                    break;
                case "save":

                    $data = $this->app->Request()->getParameter("data");

                    $collection = new \Propel\Runtime\Collection\ObjectCollection();
                    $collection->setModel(\entities\Pricebooklines::class);

                    foreach ($data as $d) {
                        $pbl = new \entities\Pricebooklines;
                        $pbl->setProductId($d['ProductId']);
                        $pbl->setMaxRetailPrice($d['MaxRetailPrice']);
                        $pbl->setSellingPrice($d['SellingPrice']);
                        $pbl->setPricebookId($id);
                        $pbl->setCompanyId($this->app->Auth()->getUser()->getCompanyId());
                        $pbl->setIsenabled(0);

                        if ($d['Enabled'] == "true") {
                            $pbl->setIsenabled(1);
                        }

                        $collection->append($pbl);
                    }

                    \entities\PricebooklinesQuery::create()
                        ->findByPricebookId($id)->delete();

                    $collection->save();

                    $this->json(["status" => "okay"]);

                    break;
            endswitch;
        } else {
            $this->data['pbl'] = \entities\PricebooksQuery::create()
                ->joinOrgUnit()
                ->findPk($id);
            $this->app->Renderer()->render("Catalogue/PriceBookLines.twig", $this->data);
        }
    }

    public function tags()
    {
        $this->data['title'] = "Tags";
        $this->data['form_name'] = "Tags";
        $this->data['cols'] = [
            "TagName" => "TagName",
        ];

        $this->data['pk'] = "Id";

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);
        switch ($action):
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":
                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\TagsQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId());
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
                $tag = new \entities\Tags();
                $this->data['form_name'] = "Add Tag";
                if ($pk > 0) {
                    $tag = \entities\TagsQuery::create()
                        ->findPk($pk);
                    $f->val($tag->toArray());
                    $this->data['form_name'] = "Edit Tag";
                }
                if ($this->app->isPost() && $f->validate()) {
                    $tag->fromArray($_POST);
                    $tag->setCompanyId($this->app->Auth()->CompanyId());
                    $tag->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    public function brandMaster()
    {


        $this->data['title'] = "Brands";
        $this->data['form_name'] = "Brands";
        $this->data['cols'] = [
            "Brand Name" => "BrandName",
            "Brand Code" => "BrandCode",
            "Brand Rate" => "BrandRate",
            "Org Unit" => "OrgUnit.UnitName",
            "MinValue" => "MinValue",
        ];

        $this->data['pk'] = "BrandId";
        //$this->data['rowButtons'] = ["brand_competit" => "zmdi zmdi-layers", "brandrcpa" => "zmdi zmdi-book"];

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);


        switch ($action):
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":
                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\BrandsQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId());
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query = $query->filterByBrandName($search, Criteria::LIKE);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->joinWithOrgUnit()->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);
                break;

            case "form":
                $orgUnit = OrgUnitQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("Orgunitid", "UnitName");
                $f = FormMgr::formHorizontal();
                $f->add([
                    'BrandName' => FormMgr::text()->label('Brand Name *')->required(),
                    'BrandCode' => FormMgr::text()->label('Brand Code *')->required(),
                    'BrandRate' => FormMgr::number()->label('Brand Rate *')->required(),
                    'MinValue' => FormMgr::number()->label('Min Value *')->required(),
                    'Orgunitid' => FormMgr::select()->options($orgUnit)->label('Org Unit Id *')->required(),

                ]);
                $brandCompetitior = new \entities\Brands();
                $this->data['form_name'] = "Add Brand";
                if ($pk > 0) {
                    $brandCompetitior = \entities\BrandsQuery::create()
                        ->findPk($pk);
                    $f->val($brandCompetitior->toArray());
                    $this->data['form_name'] = "Edit Brand";
                    $this->data['canDelete'] = true;
                }
                if ($this->app->isPost() && $f->validate()) {
                    $action = $this->app->Request()->getParameter("buttonValue");
                    if ($action == "delete") {
                        $brandCompetitior->delete();
                    } else {
                        $brandCompetitior->fromArray($_POST);
                        $brandCompetitior->setCompanyId($this->app->Auth()->CompanyId());
                        $brandCompetitior->save();
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

    public function brandCompetition($id)
    {
        $product = ProductsQuery::create()->findPk($id);

        $this->data['title'] = "Competitions for : " . $product->getProductName() . " | " . $product->getProductSku();
        $this->data['form_name'] = "BrandCompetition";
        $this->data['cols'] = [
            "Competitor Name" => "CompetitorName",
            "Brand" => "Brands.BrandName",
            "Org Unit" => "OrgUnit.UnitName",
            "Istateids" => "Istateids",
            "Drate" => "Drate",
        ];
        $this->data['id_fields'] = [
            "Istateids"
        ];

        $this->data['pk'] = "CompetitorId";

        //$brand = BrandsQuery::create()->findPk($id);

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);


        switch ($action):
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":
                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\BrandCompetitionQuery::create()->filterByProductId($id)->filterByCompanyId($this->app->Auth()->CompanyId());
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->joinWithOrgUnit()->joinWithBrands()->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);
                break;
            case "form":
                $state = \entities\GeoStateQuery::create()->find()->toKeyValue("Istateid", "Sstatename");

                $f = FormMgr::formHorizontal();
                $f->add([
                    'CompetitorName' => FormMgr::text()->label('Competitor Name *')->required(),
                    'Drate' => FormMgr::text()->label('Drate *')->required(),

                    'Istateid' => FormMgr::select()->options($state)->label('States')->class("multi-select")->multiple("multiple")->required()
                ]);
                $brandCompetitior = new \entities\BrandCompetition();
                $this->data['form_name'] = "Add Brand Competition";
                if ($pk > 0) {
                    $brandComp = \entities\BrandCompetitionQuery::create()->findPk($pk);


                    $f->val($brandComp->toArray());
                    $f["Istateid"]->val(explode(",", $brandComp->getIstateids()));


                    $brandCompetitior = \entities\BrandCompetitionQuery::create()
                        ->findPk($pk);
                    $f->val($brandCompetitior->toArray());
                    $this->data['form_name'] = "Edit Brand Competition";
                    $this->data['canDelete'] = true;
                }
                if ($this->app->isPost() && $f->validate()) {

                    $state = implode(",", $_POST['Istateid']);
                    unset($_POST['Istateid']);
                    $brandCompetitior->fromArray($_POST);
                    $brandCompetitior->setCompanyId($this->app->Auth()->CompanyId());
                    $brandCompetitior->setProductId($id);
                    $brandCompetitior->setCompetitorBrandId($product->getBrandId());
                    $brandCompetitior->setProductId($id);
                    $brandCompetitior->setOrgunitid($product->getOrgunitId());
                    $brandCompetitior->setIstateids($state);
                    $action = $this->app->Request()->getParameter("buttonValue");
                    if ($action == "delete") {
                        $brandCompetitior->delete();
                    } else {
                        $brandCompetitior->fromArray($_POST);
                        $brandCompetitior->setCompanyId($this->app->Auth()->CompanyId());
                        $brandCompetitior->save();
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

    public function brandRCPA($id)
    {

        $brand = BrandsQuery::create()->findPk($id);

        $competition = BrandCompetitionQuery::create()->findByCompetitorBrandId($id)->toKeyValue("CompetitorId", "CompetitorName");
        $competition[0] = "OWN";

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        $datachange = $this->app->Request()->getParameter("datachange", 0);

        if ($datachange == "selectedOutlet") {
            $outletid = $this->app->Request()->getParameter("OutletId", 0);
            $retail = $this->findLinkedOutlets($outletid);

            $html = FormMgr::select()->options($retail)->label('Retail')->required()->html();
            $this->json(["retail" => $html]);
            return;
        }


        switch ($action):
            case "":

                $this->data['title'] = "Brands RCPA";
                $this->data['form_name'] = "BrandsRCPA";
                $this->data['cols'] = [
                    "Month" => "RcpaMoye",
                    "OutletId" => "OutletId",
                    "RetailOutletId" => "RetailOutletId",
                    "CompetitorId" => "CompetitorId",
                    "RcpaValue" => "RcpaValue",

                ];
                $this->data['disableAdd'] = true;

                $this->data['id_fields'] = [
                    "OutletId",
                    "RetailOutletId",
                    // "CompetitorId"
                ];

                $this->data['pk'] = "BrcpaId";
                $this->data['valKeys'] = ["CompetitorId" => $competition];

                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":
                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\BrandRcpaQuery::create()->filterByBrandId($id);
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    // $query = $query->filterByCategoryName($search, Criteria::LIKE);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->joinWithOutlets()->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);
                break;
            case "form":
                $months = MTPManager::getMonths(-1, 2);

                $outlets = OutletsQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->find()->toKeyValue("Id", "OutletName");
                if ($pk > 0) {
                    $rcpa = \entities\BrandRcpaQuery::create()->findPk($pk);
                    $retail = $this->findLinkedOutlets($rcpa->getOutletId());
                } else {
                    $brandCompetitior = new \entities\Brands();
                }
                $f = FormMgr::formHorizontal();
                $f->add([
                    'OutletId' => FormMgr::select()->options($outlets)->label('Customer')->required()->datachange("selectedOutlet")->id("OutletId"),
                    //'RetailOutletId' => FormMgr::select()->options([])->label('Retail')->required(),     
                    'RcpaMoye' => FormMgr::select()->options($months)->label('Month')->required(),
                    'CompetitorId' => FormMgr::select()->options($competition)->label('Competitor')->required(),
                    'RcpaValue' => FormMgr::text()->label('RcpaValue *')->required(),

                ]);
                $rcpa = new \entities\BrandRcpa();
                $this->data['form_name'] = "Add RCPA";
                if ($pk > 0) {

                    $f->val($rcpa->toArray());
                    $this->data['form_name'] = "Edit RCPA";
                }
                if ($this->app->isPost() && $f->validate()) {
                    $action = $this->app->Request()->getParameter("buttonValue");
                    if ($action == "delete") {
                        $rcpa->delete();
                    } else {
                        $rcpa->fromArray($_POST);

                        $rcpa->setBrandId($id);
                        $rcpa->setEmployeeId($this->app->Auth()->getUser()->getEmployeeId());
                        $rcpa->setCompanyId($this->app->Auth()->CompanyId());
                        $rcpa->save();
                    }
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $form = $f->html();
                $this->data['form'] = $form;
                $this->app->Renderer()->render("Catalogue/addRCPA.twig", $this->data);
                break;

        endswitch;
    }


    function findLinkedOutlets($outletid)
    {
        $retail = [];
        $linked = OutletMappingQuery::create()
            ->joinWithOutlets()
            ->filterBySecondaryOutletId($outletid)->find();
        foreach ($linked as $link) {
            $retail[$link->getPrimaryOutletId()] = $link->getOutlets()->getOutletName();
        }

        return $retail;
    }

    public function brandCampiagn()
    {
        // $mediaManager = new MediaManager($this->app);

        // $this->data['title'] = "BrandCampiagn";
        // $this->data['form_name'] = "BrandCampiagn";
        // $this->data['cols'] = [
        //     "Campiagn Name" => "CampiagnName",
        //     "StartDate" => "StartDate",
        //     "EndDate" => "EndDate",
        //     "LockingDate" => "LockingDate",
        //     "Type" => "CampiagnType",
        // ];
        // $this->data['pk'] = "BrandCampiagnId";
        //$this->data['mediaCol'] = "Media";
        //$this->data['rowButtons'] = ["visit_plan" => "zmdi zmdi-layers", "doctor_visit" => "zmdi zmdi-eye"];


        $action = $this->app->Request()->getParameter("action");
        //$pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action):
            case "":
                $this->app->Renderer()->render("brandcampiagn/brandcampiagnlist.twig", $this->data);
                break;
            case "list":

                //$OrgId = $this->app->Auth()->getUser()->getEmployee()->getOrgUnitId();
                //extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\BrandCampiagnQuery::create()
                    ->leftJoinWithOrgUnit()
                    //->filterByOrgUnitId($OrgId)    // comment by navkar
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->find()->toArray();
                $response['data'] = $query;
                $this->json($response);

                // $count = $query->count();
                // $response["recordsTotal"] = $count;

                // if (!empty($search)) {
                //     $search = '%' . $search . '%';
                //     $query = $query->filterByDescription($search, Criteria::LIKE);
                // }

                // $count = $query->count();
                // $response["recordsFiltered"] = $count;

                //$this->json(["list"=>$expenses]);
                break;
            case "form":
                // $empId = $this->app->Auth()->getUser()->getEmployeeId();


                // $brands = \entities\BrandsQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("BrandId", "BrandName");

                // $classification = \entities\ClassificationQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId())->find()->toKeyValue("Id", "Classification");
                // $tags = OutletTagsQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId())->find()->toKeyValue("OutletTagId", "TagName");
                // $orgUnits = OrgUnitQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId())->find()->toKeyValue("Orgunitid", "UnitName");
                // $outletTypes = OutletTypeQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId())->find()->toKeyValue("OutlettypeId", "OutlettypeName");
                // $types = $this->getConfig("Catalogue", "Types");
                // $statuses = $this->getConfig("Catalogue","BrandCampiagnStatus");


                // $f = FormMgr::formHorizontal();
                // $f->add([
                //     'CampiagnName' => FormMgr::text()->label('Campiagn Name *')->required()->minlength(5)->pattern(__NOSPACE_PATERN),
                //     'StartDate' => FormMgr::date()->label('Start Date *')->required(),
                //     'EndDate' => FormMgr::date()->label('End Date *')->required(),
                //     'MaterialUrl' => FormMgr::url()->label('Material Url'),
                //     'LockingDate' => FormMgr::date()->label('Locking Date'),
                //     'FocusBrands' => FormMgr::select()->options($brands)->class("multi-select")->multiple("multiple")->label('Focus Brands')->required(),
                //     'OrgUnitId' => FormMgr::select()->options($orgUnits)->label('Org Unit')->required(),
                //     'OutlettypeId' => FormMgr::select()->options($outletTypes)->label('Outlet Type')->required(),
                //     'Classifications' => FormMgr::select()->options($classification)->class("multi-select")->multiple("multiple")->label('Classifications')->required(),
                //     'Description' => FormMgr::textarea()->label('Description *')->required()->minlength(5)->pattern(__NOSPACE_PATERN),
                //     'CampiagnType' => FormMgr::select()->options($types)->label('Campiagn Type')->required(),
                //     'Tags' => FormMgr::select()->options($tags)->label('Tags')->class("multi-select")->multiple("multiple")->required(),
                //     'MinimumPerTerritory' => FormMgr::number()->label('Minimum Per Territory *')->required()->pattern(__NOSPACE_PATERN),
                //     'MaximumPerTerritory' => FormMgr::number()->label('Maximum Per Territory *')->required()->pattern(__NOSPACE_PATERN),
                //     'MinimumForCampiagn' => FormMgr::number()->label('Minimum For Campiagn *')->required()->pattern(__NOSPACE_PATERN),
                //     'MaximumForCampiagn' => FormMgr::number()->label('Maximum For Campiagn *')->required()->pattern(__NOSPACE_PATERN),
                //     'IsSuspended' => FormMgr::checkbox()->label('Is Suspended *'),
                //     'Status' => FormMgr::select()->options($statuses)->label('Status')->required(),
                // ]);
                // $campiagn = new \entities\BrandCampiagn();
                // $this->data['form_name'] = "Add Brand Campiagn";
                // if ($pk > 0) {
                //     $campiagn = \entities\BrandCampiagnQuery::create()
                //         ->findPk($pk);
                //     $f->val($campiagn->toArray());
                //     if ($campiagn->getTags() != null) {
                //         $f["Tags"]->val(explode(",", $campiagn->getTags()));
                //     }
                //     if ($campiagn->getClassifications() != null) {
                //         $f["Classifications"]->val(explode(",", $campiagn->getClassifications()));
                //     }
                //     if ($campiagn->getFocusBrands() != null) {
                //         $f["FocusBrands"]->val(explode(",", $campiagn->getFocusBrands()));
                //     }
                //     $this->data['form_name'] = "Edit Brand Campiagn";
                // }
                //                 if ($this->app->isPost() && $f->validate()) {
                //                     if ($_POST['Tags'] != null) {
                //                         $tags = implode(",", $_POST['Tags']);
                //                     } else {
                //                         $tags = null;
                //                     }

                //                     if ($_POST['Classifications'] != null) {
                //                         $classifications = implode(",", $_POST['Classifications']);
                //                     } else {
                //                         $classifications = null;
                //                     }

                //                     if ($_POST['FocusBrands'] != null) {
                //                         $focusBrands = implode(",", $_POST['FocusBrands']);
                //                     } else {
                //                         $focusBrands = null;
                //                     }

                //                     unset($_POST['Tags']);
                //                     unset($_POST['Classifications']);
                //                     unset($_POST['FocusBrands']);
                // //                    $tags = implode(",", $_POST['OutletTags']);
                //                     $campiagn->fromArray($_POST);
                //                     $campiagn->setTags($tags);
                //                     $campiagn->setClassifications($classifications);
                //                     $campiagn->setFocusBrands($focusBrands);
                //                     $campiagn->setCompanyId($this->app->Auth()->CompanyId());
                //                     $campiagn->save();

                //                     $campiagn->setBrandCampiagnCode($campiagn->getCampiagnName() . "_" . $campiagn->getBrandCampiagnId());
                //                     $campiagn->save();
                //                     // $title = "Brand Campiagn";
                //                     // $message = "We have create brand campiagn so please add your doctor in this campiagn And The campiagn name is " . $_POST['CampiagnName'];

                //                     // $employees = EmployeeQuery::create()
                //                     //     ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
                //                     //     ->filterByOrgUnitId($_POST['OrgUnitId'])
                //                     //     ->find()
                //                     //     ->toArray();
                //                     // foreach ($employees as $emp) {
                //                     //     $notification = \BI\manager\NotificationManager::sendNotificationToEmployee($emp['EmployeeId'], $title, $message);
                //                     // }
                //                     $this->runModalScript("loadGrid()");
                //                     return;
                //                 }
                //$form = $f->html();
                // $mediaInput = $mediaManager->FormInput("Media", "Media", [$campiagn->getMedia()], 1);
                // $this->data['form'] = $form . $mediaInput;
                $this->app->Renderer()->render("brandcampiagn/brandcampiagnlist.twig", $this->data);
                break;
        endswitch;
    }

    public function brandCampiagnForm($id = 0)
    {

        $pk = $this->app->Request()->getParameter("pk", 0);


        $this->data['campiagntypes'] = $this->getConfig("Catalogue", "Types");
        $this->data['statues'] = $this->getConfig("Catalogue", "BrandCampiagnStatus");

        $this->data['outletTypes'] = OutletTypeQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find()->toKeyValue("OutlettypeId", "OutlettypeName");
        $this->data['orgUnits'] = OrgUnitQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find()->toKeyValue("Orgunitid", "UnitName");
        $this->data['brands'] = \entities\BrandsQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find()->toKeyValue("BrandId", "BrandName");
        $this->data['tags'] = OutletTagsQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find()->toKeyValue("OutletTagId", "TagName");
        $this->data['classifications'] = \entities\ClassificationQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find()->toKeyValue("Id", "Classification");

        if ($this->app->isPost()) {

            $focusBrand = null;
            if (!empty($_POST['focusbrand'])) {
                $focusBrand = implode(',', $_POST['focusbrand']);
            }

            $sgpiBrand = null;
            if (!empty($_POST['sgpibrand'])) {
                $sgpiBrand = implode(',', $_POST['sgpibrand']);
            }

            $positions = null;
            if (!empty($_POST['position'])) {
                $positions = implode(",", $_POST['position']);
            }

            if (isset($_FILES)) {
                $errors = array();
                $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
                $media_id = [];
                foreach ($_FILES as $file) {
                    for ($i = 0; $i <= count($file); $i++) {
                        if (isset($file['tmp_name'][$i]) && isset($file['name'][$i]) && $file['tmp_name'][$i] != '') {
                            $file_tmp = $file['tmp_name'][$i];
                            $file_name = $file['name'][$i];
                            $file_size = $file['size'][$i];
                            $type = $file['type'][$i];
                            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                            $data = file_get_contents($file_tmp);
                            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                            if (in_array($file_ext, $allowed_ext) === false) {
                                $errors[] = $file_name . ' Extension not allowed';
                            }
                            if ($file_size > 5242880) {
                                $errors[] = $file_name . 'File size must be under 2mb';
                            }
                            if (empty($errors)) {
                                $media = new \entities\MediaFiles();
                                $media->setFolderId(1);
                                $media->setMediaName($file_name);
                                $media->setMediaMime($type);
                                $media->setMediaData($base64);
                                $media->setCompanyId($this->app->Auth()->CompanyId());
                                $media->save();
                                $media_id[] = $media->getPrimaryKey();
                            }
                        }
                    }
                }
            }

            $mediaIds = null;
            if (count($media_id) > 0) {
                $mediaIds = implode(',', $media_id);
            }

            if (isset($_POST['start_date'])) {
                $startDate = DateTime::createFromFormat('d/m/Y',  $_POST['start_date']);
                $newStartDate =  $startDate->format('Y-m-d');
            }
            if (isset($_POST['end_date'])) {
                $endDate = DateTime::createFromFormat('d/m/Y',  $_POST['end_date']);
                $newEndDate =  $endDate->format('Y-m-d');
            }
            if (isset($_POST['locking_date'])) {
                $lockingDate = DateTime::createFromFormat('d/m/Y',  $_POST['locking_date']);
                $newLockingDate =  $lockingDate->format('Y-m-d');
            }

            if ($newStartDate == $newLockingDate) {
                $this->data['errorMsg'] = "The locking date must not be the same as the start date.";
                $this->app->Renderer()->render("brandcampiagn/addbrandcampiagn.twig", $this->data);
                return;
            }

            if ($newStartDate == $newEndDate) {
                $this->data['errorMsg'] = "The end date must not be the same as the start date.";
                $this->app->Renderer()->render("brandcampiagn/addbrandcampiagn.twig", $this->data);
                return;
            }

            if ($newStartDate < $newLockingDate) {
                $this->data['errorMsg'] = "Locking date can't be grater than start date.";
                $this->app->Renderer()->render("brandcampiagn/addbrandcampiagn.twig", $this->data);
                return;
            }

            if ($newStartDate > $newEndDate) {
                $this->data['errorMsg'] = "End date can't be older than begin date.";
                $this->app->Renderer()->render("brandcampiagn/addbrandcampiagn.twig", $this->data);
                return;
            }

            $brandCampiagn = new \entities\BrandCampiagn();
            $brandCampiagn->setCampiagnName($_POST['campiagn_name']);
            $brandCampiagn->setBrandCampiagnCode($_POST['campiagn_code']);
            $brandCampiagn->setDescription($_POST['description']);
            $brandCampiagn->setCampiagnType($_POST['campiagn_type']);
            $brandCampiagn->setOutlettypeId($_POST['outlet_type']);
            $brandCampiagn->setStartDate($newStartDate);
            $brandCampiagn->setEndDate($newEndDate);
            $brandCampiagn->setLockingDate($newLockingDate);
            $brandCampiagn->setOrgUnitId($_POST['org_unit']);
            $brandCampiagn->setDesignation($_POST['designation']);
            $brandCampiagn->setMaterial($_POST['material_url']);
            $brandCampiagn->setFocusBrands($focusBrand);
            $brandCampiagn->setSgpiBrands($sgpiBrand);
            $brandCampiagn->setIsSuspended($_POST['is_suspended']);
            $brandCampiagn->setStatus('Draft');
            $brandCampiagn->setMedia($mediaIds);
            $brandCampiagn->setPosition($positions);
            $brandCampiagn->setCompanyId($this->app->Auth()->CompanyId());
            $brandCampiagn->save();
            // if($brandCampiagn->getBrandCampiagnId() != null && !empty($_POST['classification'])){
            //     for($i=0; $i < count($_POST['classification']); $i++){
            //         if(isset($_POST['classification'][$i]) && $_POST['maximum'][$i] !== null && $_POST['minimum'][$i] !== null){
            //             $brandCampiagnClass = new \entities\BrandCampiagnClassification();
            //             $brandCampiagnClass->setBrandCampiagnId($brandCampiagn->getBrandCampiagnId());
            //             $brandCampiagnClass->setClassificationId($_POST['classification'][$i]);
            //             $brandCampiagnClass->setMinimum($_POST['minimum'][$i]);
            //             $brandCampiagnClass->setMaximum($_POST['maximum'][$i]);
            //             //$brandCampiagnClass->save();
            //         }
            //         else{
            //             if($_POST['classification'][0] == 'all'){                                            
            //                 $classificatioid =  \entities\ClassificationQuery::create()
            //                            ->select(['Id'])
            //                            ->filterByCompanyId($this->app->Auth()->CompanyId())
            //                            ->filterByOrgunitid($_POST['org_unit'])
            //                            ->find()->toArray();
            //                           foreach($classificatioid as $key => $value){
            //                             $brandCampiagnClass = new \entities\BrandCampiagnClassification();
            //                             $brandCampiagnClass->setBrandCampiagnId($brandCampiagn->getBrandCampiagnId());
            //                             $brandCampiagnClass->setClassificationId($value);
            //                             $brandCampiagnClass->setMinimum($_POST['minimum'][0]);
            //                             $brandCampiagnClass->setMaximum($_POST['maximum'][0]);
            //                             print_r($brandCampiagnClass);die;
            //                             //$brandCampiagnClass->save();
            //                           }

            //                }
            //         }                   

            //     }
            //     $url = $this->app->Router()->getPath("brandCampiagn");
            //     $this->app->Response()->redirect($url);
            //     return;
            // }
            if ($brandCampiagn->getBrandCampiagnId() !== null && !empty($_POST['classification'])) {
                $brandCampiagnId = $brandCampiagn->getBrandCampiagnId();
                $classification = $_POST['classification'];
                $minValues = $_POST['minimum'];
                $maxValues = $_POST['maximum'];

                if ($classification[0] === 'all') {
                    $classificationIds = \entities\ClassificationQuery::create()
                        ->select(['Id'])
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->filterByOrgunitid($_POST['org_unit'])
                        ->find()
                        ->toArray();

                    foreach ($classificationIds as $classificationId) {
                        $this->createBrandCampiagnClass($brandCampiagnId, $classificationId, $minValues[0], $maxValues[0]);
                    }
                } else {
                    foreach ($classification as $i => $classId) {
                        if (isset($classId) && $minValues[$i] !== null && $maxValues[$i] !== null) {
                            $this->createBrandCampiagnClass($brandCampiagnId, $classId, $minValues[$i], $maxValues[$i]);
                        }
                    }
                }

                $url = $this->app->Router()->getPath("brandCampiagn");
                $this->app->Response()->redirect($url);
            }
        }
        $this->app->Renderer()->render("brandcampiagn/addbrandcampiagn.twig", $this->data);
    }

    private function createBrandCampiagnClass($brandCampiagnId, $classificationId, $min, $max)
    {
        $brandCampiagnClass = new \entities\BrandCampiagnClassification();
        $brandCampiagnClass->setBrandCampiagnId($brandCampiagnId);
        $brandCampiagnClass->setClassificationId($classificationId);
        $brandCampiagnClass->setMinimum($min);
        $brandCampiagnClass->setMaximum($max);
        $brandCampiagnClass->save();
    }

    public function brandCampiagnEdit($id)
    {
        $this->data['campiagntypes'] = $this->getConfig("Catalogue", "Types");
        $this->data['statues'] = $this->getConfig("Catalogue", "BrandCampiagnStatus");

        $this->data['outletTypes'] = OutletTypeQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find()->toKeyValue("OutlettypeId", "OutlettypeName");
        $this->data['orgUnits'] = OrgUnitQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find()->toKeyValue("Orgunitid", "UnitName");
        $this->data['brands'] = \entities\BrandsQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find()->toKeyValue("BrandId", "BrandName");
        $this->data['tags'] = OutletTagsQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find()->toKeyValue("OutletTagId", "TagName");
        $this->data['classifications'] = \entities\ClassificationQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find()->toKeyValue("Id", "Classification");

        $this->data['BrandCampaignData'] = \entities\BrandCampiagnQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->leftJoinWithBrandCampiagnClassification()
            ->filterByBrandCampiagnId($id)
            ->find()->toArray();

        $this->data['BrandCampaignClassification'] = \entities\BrandCampiagnClassificationQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->leftJoinWithClassification()
            ->filterByBrandCampiagnId($id)
            ->find()->toArray();


        $this->data['Media'] = \entities\MediaFilesQuery::create()
            ->filterByMediaId($this->data['BrandCampaignData'][0]['Media'])
            ->find()->toArray();
        if (isset($this->data['Media'][0]['MediaData'])) {
            $this->data['image'] = $this->data['Media'][0]['MediaData'];
        } else {
            $this->data['image'] = null;
        }


        if ($this->app->isPost()) {

            // if($_POST['start_date'] < $_POST['locking_date']){
            //     $this->data['errorMsg'] = "Locking date can't be grater than start date."; 
            //     $this->app->Renderer()->render("brandcampiagn/addbrandcampiagn.twig", $this->data);
            //     return;
            // }

            // if($_POST['start_date'] > $_POST['end_date']){
            //     $this->data['errorMsg'] = "End date can't be older than begin date."; 
            //     $this->app->Renderer()->render("brandcampiagn/addbrandcampiagn.twig", $this->data);
            //     return;
            // }

            $focusBrand = null;
            if (!empty($_POST['focusbrand'])) {
                $focusBrand = implode(',', $_POST['focusbrand']);
            }

            $sgpiBrand = null;
            if (!empty($_POST['sgpibrand'])) {
                $sgpiBrand = implode(',', $_POST['sgpibrand']);
            }

            $positions = null;
            if (!empty($_POST['position'])) {
                $positions = implode(",", $_POST['position']);
            }

            if (isset($_FILES)) {
                $errors = array();
                $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
                $media_id = [];
                foreach ($_FILES as $file) {
                    for ($i = 0; $i <= count($file); $i++) {
                        if (isset($file['tmp_name'][$i]) && isset($file['name'][$i]) && $file['tmp_name'][$i] != '') {
                            $file_tmp = $file['tmp_name'][$i];
                            $file_name = $file['name'][$i];
                            $file_size = $file['size'][$i];
                            $type = $file['type'][$i];
                            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                            $data = file_get_contents($file_tmp);
                            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                            if (in_array($file_ext, $allowed_ext) === false) {
                                $errors[] = $file_name . ' Extension not allowed';
                            }
                            if ($file_size > 5242880) {
                                $errors[] = $file_name . 'File size must be under 2mb';
                            }
                            if (empty($errors)) {
                                $media = new \entities\MediaFiles();
                                $media->setFolderId(1);
                                $media->setMediaName($file_name);
                                $media->setMediaMime($type);
                                $media->setMediaData($base64);
                                $media->setCompanyId($this->app->Auth()->CompanyId());
                                $media->save();
                                $media_id[] = $media->getPrimaryKey();
                            }
                        }
                    }
                }
            }

            $mediaIds = null;
            if (count($media_id) > 0) {
                $mediaIds = implode(',', $media_id);
            }
            $brandCampiagn = \entities\BrandCampiagnQuery::create()
                ->filterByBrandCampiagnId($id)
                ->findOne();
            if ($mediaIds == null) {
                $mediaIds = $brandCampiagn->getMedia();
            } else {
                $media = \entities\MediaFilesQuery::create()
                    ->filterByMediaId($brandCampiagn->getMedia())
                    ->delete();
            }

            if (isset($_POST['start_date'])) {
                $startDate = DateTime::createFromFormat('d/m/Y',  $_POST['start_date']);
                $newStartDate =  $startDate->format('Y-m-d');
            }
            if (isset($_POST['end_date'])) {
                $endDate = DateTime::createFromFormat('d/m/Y',  $_POST['end_date']);
                $newEndDate =  $endDate->format('Y-m-d');
            }
            if (isset($_POST['locking_date'])) {
                $lockingDate = DateTime::createFromFormat('d/m/Y',  $_POST['locking_date']);
                $newLockingDate =  $lockingDate->format('Y-m-d');
            }

            if ($newStartDate < $newLockingDate) {
                $this->data['errorMsg'] = "Locking date can't be grater than start date.";
                $this->app->Renderer()->render("brandcampiagn/addbrandcampiagn.twig", $this->data);
                return;
            }

            if ($newStartDate > $newEndDate) {
                $this->data['errorMsg'] = "End date can't be older than begin date.";
                $this->app->Renderer()->render("brandcampiagn/addbrandcampiagn.twig", $this->data);
                return;
            }

            $brandCampiagn->setCampiagnName($_POST['campiagn_name']);
            $brandCampiagn->setBrandCampiagnCode($_POST['campiagn_code']);
            $brandCampiagn->setDescription($_POST['description']);
            $brandCampiagn->setCampiagnType($_POST['campiagn_type']);
            $brandCampiagn->setOutlettypeId($_POST['outlet_type']);
            $brandCampiagn->setStartDate($newStartDate);
            $brandCampiagn->setEndDate($newEndDate);
            $brandCampiagn->setLockingDate($newLockingDate);
            if (isset($_POST['org_unit'])) {
                $brandCampiagn->setOrgUnitId($_POST['org_unit']);
            }
            if (isset($_POST['designation'])) {
                $brandCampiagn->setDesignation($_POST['designation']);
            }
            $brandCampiagn->setMaterial($_POST['material_url']);
            $brandCampiagn->setFocusBrands($focusBrand);
            if (isset($sgpiBrand) && $sgpiBrand != null) {
                $brandCampiagn->setSgpiBrands($sgpiBrand);
            }
            $brandCampiagn->setIsSuspended($_POST['is_suspended']);
            $brandCampiagn->setMedia($mediaIds);
            if (isset($positions) && $positions != null) {
                $brandCampiagn->setPosition($positions);
            }
            $brandCampiagn->setCompanyId($this->app->Auth()->CompanyId());
            $brandCampiagn->save();
            if ($brandCampiagn->getBrandCampiagnId() != null && !empty($_POST['classification'])) {
                for ($i = 0; $i <= count($_POST['classification']); $i++) {
                    if (isset($_POST['classification'][$i]) && $_POST['maximum'][$i] != null && $_POST['minimum'][$i] != null) {
                        $brandCampiagnClass = \entities\BrandCampiagnClassificationQuery::create()
                            ->filterByBrandCampiagnId($brandCampiagn->getBrandCampiagnId())
                            ->filterByClassificationId($_POST['classification'][$i])
                            ->findOne();
                        if ($brandCampiagnClass == null) {
                            $brandCampiagnClass = new \entities\BrandCampiagnClassification();
                        }
                        $brandCampiagnClass->setBrandCampiagnId($brandCampiagn->getBrandCampiagnId());
                        $brandCampiagnClass->setClassificationId($_POST['classification'][$i]);
                        $brandCampiagnClass->setMinimum($_POST['minimum'][$i]);
                        $brandCampiagnClass->setMaximum($_POST['maximum'][$i]);
                        $brandCampiagnClass->save();
                    }
                }
                $url = $this->app->Router()->getPath("brandCampiagn");
                $this->app->Response()->redirect($url);
                return;
            }
        }

        $this->app->Renderer()->render("brandcampiagn/editbrandcampiagn.twig", $this->data);
    }

    public function brandCampiagnView($id)
    {
        $this->data['campiagntypes'] = $this->getConfig("Catalogue", "Types");
        $this->data['statues'] = $this->getConfig("Catalogue", "BrandCampiagnStatus");

        $this->data['outletTypes'] = OutletTypeQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find()->toKeyValue("OutlettypeId", "OutlettypeName");
        $this->data['orgUnits'] = OrgUnitQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find()->toKeyValue("Orgunitid", "UnitName");
        $this->data['brands'] = \entities\BrandsQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find()->toKeyValue("BrandId", "BrandName");
        $this->data['tags'] = OutletTagsQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find()->toKeyValue("OutletTagId", "TagName");
        $this->data['classifications'] = \entities\ClassificationQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find()->toKeyValue("Id", "Classification");

        $this->data['BrandCampaignData'] = \entities\BrandCampiagnQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->leftJoinWithBrandCampiagnClassification()
            ->filterByBrandCampiagnId($id)
            ->find()->toArray();

        $this->data['BrandCampaignClassification'] = \entities\BrandCampiagnClassificationQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->leftJoinWithClassification()
            ->filterByBrandCampiagnId($id)
            ->find()->toArray();


        $this->data['Media'] = \entities\MediaFilesQuery::create()
            ->filterByMediaId($this->data['BrandCampaignData'][0]['Media'])
            ->find()->toArray();
        if (isset($this->data['Media'][0]['MediaData'])) {
            $this->data['image'] = $this->data['Media'][0]['MediaData'];
        } else {
            $this->data['image'] = null;
        }


        if ($this->app->isPost()) {

            if ($_POST['locking_date'] > $_POST['end_date']) {
                $this->app->Session()->setFlash("message", "End date can't be older than begin date.");
                $this->data['post'] = $_POST;
                $this->app->Renderer()->render("brandcampiagn/addbrandcampiagn.twig", $this->data);
                return;
            }

            if ($_POST['end_date'] < $_POST['start_date']) {
                $this->app->Session()->setFlash("message", "End date can't be older than begin date.");
                $this->data['post'] = $_POST;
                $this->app->Renderer()->render("brandcampiagn/addbrandcampiagn.twig", $this->data);
                return;
            }

            $focusBrand = null;
            if (!empty($_POST['focusbrand'])) {
                $focusBrand = implode(',', $_POST['focusbrand']);
            }

            $sgpiBrand = null;
            if (!empty($_POST['sgpibrand'])) {
                $sgpiBrand = implode(',', $_POST['sgpibrand']);
            }

            $positions = null;
            if (!empty($_POST['position'])) {
                $positions = implode(",", $_POST['position']);
            }

            if (isset($_FILES)) {
                $errors = array();
                $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
                $media_id = [];
                foreach ($_FILES as $file) {
                    for ($i = 0; $i <= count($file); $i++) {
                        if (isset($file['tmp_name'][$i]) && isset($file['name'][$i]) && $file['tmp_name'][$i] != '') {
                            $file_tmp = $file['tmp_name'][$i];
                            $file_name = $file['name'][$i];
                            $file_size = $file['size'][$i];
                            $type = $file['type'][$i];
                            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                            $data = file_get_contents($file_tmp);
                            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                            if (in_array($file_ext, $allowed_ext) === false) {
                                $errors[] = $file_name . ' Extension not allowed';
                            }
                            if ($file_size > 5242880) {
                                $errors[] = $file_name . 'File size must be under 2mb';
                            }
                            if (empty($errors)) {
                                $media = new \entities\MediaFiles();
                                $media->setFolderId(1);
                                $media->setMediaName($file_name);
                                $media->setMediaMime($type);
                                $media->setMediaData($base64);
                                $media->setCompanyId($this->app->Auth()->CompanyId());
                                $media->save();
                                $media_id[] = $media->getPrimaryKey();
                            }
                        }
                    }
                }
            }

            $mediaIds = null;
            if (count($media_id) > 0) {
                $mediaIds = implode(',', $media_id);
            }
            $brandCampiagn = \entities\BrandCampiagnQuery::create()
                ->filterByBrandCampiagnId($id)
                ->findOne();
            if ($mediaIds == null) {
                $mediaIds = $brandCampiagn->getMedia();
            } else {
                $media = \entities\MediaFilesQuery::create()
                    ->filterByMediaId($brandCampiagn->getMedia())
                    ->delete();
            }
            $brandCampiagn->setCampiagnName($_POST['campiagn_name']);
            $brandCampiagn->setBrandCampiagnCode($_POST['campiagn_code']);
            $brandCampiagn->setDescription($_POST['description']);
            $brandCampiagn->setCampiagnType($_POST['campiagn_type']);
            $brandCampiagn->setOutlettypeId($_POST['outlet_type']);
            $brandCampiagn->setStartDate($_POST['start_date']);
            $brandCampiagn->setEndDate($_POST['end_date']);
            $brandCampiagn->setLockingDate($_POST['locking_date']);
            $brandCampiagn->setOrgUnitId($_POST['org_unit']);
            $brandCampiagn->setDesignation($_POST['designation']);
            $brandCampiagn->setMaterial($_POST['material_url']);
            $brandCampiagn->setFocusBrands($focusBrand);
            $brandCampiagn->setSgpiBrands($sgpiBrand);
            $brandCampiagn->setIsSuspended($_POST['is_suspended']);
            $brandCampiagn->setMedia($mediaIds);
            $brandCampiagn->setPosition($positions);
            $brandCampiagn->setCompanyId($this->app->Auth()->CompanyId());
            $brandCampiagn->save();
            if ($brandCampiagn->getBrandCampiagnId() != null && !empty($_POST['classification'])) {
                for ($i = 0; $i <= count($_POST['classification']); $i++) {
                    if (isset($_POST['classification'][$i])) {
                        $brandCampiagnClass = \entities\BrandCampiagnClassificationQuery::create()
                            ->filterByBrandCampiagnId($brandCampiagn->getBrandCampiagnId())
                            ->filterByClassificationId($_POST['classification'][$i])
                            ->findOne();
                        if ($brandCampiagnClass == null) {
                            $brandCampiagnClass = new \entities\BrandCampiagnClassification();
                        }
                        $brandCampiagnClass->setBrandCampiagnId($brandCampiagn->getBrandCampiagnId());
                        $brandCampiagnClass->setClassificationId($_POST['classification'][$i]);
                        $brandCampiagnClass->setMinimum($_POST['minimum'][$i]);
                        $brandCampiagnClass->setMaximum($_POST['maximum'][$i]);
                        $brandCampiagnClass->save();
                    }
                }
                $url = $this->app->Router()->getPath("brandCampiagn");
                $this->app->Response()->redirect($url);
                return;
            }
        }

        $this->app->Renderer()->render("brandcampiagn/viewbrandcampiagn.twig", $this->data);
    }

    public function deleteClassification()
    {
        $brandCampaignClassificationId = $this->app->Request()->getParameter("brandCampaignClassificationId", 0);

        $bccDelete = \entities\BrandCampiagnClassificationQuery::create()
            ->filterByBrandCampiagnClassificationId($brandCampaignClassificationId)
            ->delete();

        return $this->json(['status' => 1]);
    }

    public function getOrgUnitDesignation()
    {
        $orgUnitId = $this->app->Request()->getParameter("orgUnitId", 0);
        $employeeDesignationIds = \entities\EmployeeQuery::create()
            ->select('DesignationId')
            ->filterByOrgUnitId($orgUnitId)
            ->groupByDesignationId()
            ->find()->toArray();
        $designations = DesignationsQuery::create()
            ->filterByDesignationId($employeeDesignationIds)
            ->find()->toKeyValue("DesignationId", "Designation");
        return $this->json($designations);
    }

    public function getDesignationPosition()
    {
        $designationId = $this->app->Request()->getParameter("designationId", 0);
        $orgUnitId = $this->app->Request()->getParameter("orgUnitId", 0);
        $employeePositionIds = \entities\EmployeeQuery::create()
            ->select('PositionId')
            ->filterByDesignationId($designationId)
            ->filterByOrgUnitId($orgUnitId)
            ->groupByPositionId()
            ->find()->toArray();
        $positions = PositionsQuery::create()
            ->filterByPositionId($employeePositionIds)
            ->find()->toKeyValue("PositionId", "PositionName");
        return $this->json($positions);
    }

    public function getClassification()
    {
        $orgUnitId = $this->app->Request()->getParameter("orgUnitId", 0);

        $classifications = \entities\ClassificationQuery::create()
            ->filterByOrgunitid($orgUnitId)
            ->_or()
            ->filterByOrgunitid(null)
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find()->toKeyValue("Id", "Classification");
        return $this->json($classifications);
    }

    public function getOrgUnitFocusBrand()
    {
        $orgUnitId = $this->app->Request()->getParameter("orgUnitId", 0);


        $focusBrands = \entities\BrandsQuery::create()
            ->filterByOrgunitid($orgUnitId)
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find()->toKeyValue("BrandId", "BrandName");
        return $this->json($focusBrands);
    }

    public function getOrgUnitSgpiBrand()
    {
        $orgUnitId = $this->app->Request()->getParameter("orgUnitId", 0);

        $sgpiBrands = \entities\BrandsQuery::create()
            ->filterByOrgunitid($orgUnitId)
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find()->toKeyValue("BrandId", "BrandName");

        return $this->json($sgpiBrands);
    }

    public function brandCampiagnStatusChange($id)
    {
        $status = $this->app->Request()->getParameter("status", '');

        $brandCampiagnStatus = \entities\BrandCampiagnQuery::create()
            ->filterByBrandCampiagnId($id)
            ->update(array('Status' => $status));

        $url = $this->app->Router()->getPath("brandCampiagn");
        $this->app->Response()->redirect($url);
        return;
    }

    public function getCampaignOutlets($id)
    {

        $action = $this->app->Request()->getParameter("action");

        switch ($action):
            case "":
                $this->app->Renderer()->render("brandcampiagn/brandcampiagnoutletlist.twig", $this->data);
                break;
            case "list":

                $response = [];
                $response['data'] = \entities\BrandCampiagnDoctorsQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->joinWithBrandCampiagn()
                    ->joinWithOutlets()
                    ->joinWithOutletOrgData()
                    ->joinWithPositions()
                    ->leftJoinWithClassification()
                    ->filterByBrandCampiagnId($id)
                    ->find()->toArray();
                $this->json($response);
                break;
            case "bulk":
                $doctorVisitIdArray = $this->app->Request()->getParameter("DoctorVisitId", []);

                $item = array_slice($doctorVisitIdArray, 0, 1, true);
                if ($item[0] == 'on') {
                    $requestIds = array_shift($doctorVisitIdArray);
                }


                if (count($doctorVisitIdArray) > 0) {
                    $res = str_replace(array('\'', '"', ',', ';', '<', '>'), ' ', $id);
                    $req = \entities\BrandCampiagnDoctorsQuery::create()
                        ->filterByBrandCampiagnId($id)
                        ->update(array('Selected' => false));

                    foreach ($doctorVisitIdArray as $doctorVisitId) {
                        $campaignOutlet = \entities\BrandCampiagnDoctorsQuery::create()
                            ->filterByDoctorVisitId($doctorVisitId)
                            ->findOne();

                        $outletClassification = $campaignOutlet->getClassificationId();

                        $campaignClassification = \entities\BrandCampiagnClassificationQuery::create()
                            ->filterByBrandCampiagnId($campaignOutlet->getBrandCampiagnId())
                            ->filterByClassificationId($outletClassification)
                            ->findOne();

                        $brandCampiagnOutCount = \entities\BrandCampiagnDoctorsQuery::create()
                            ->filterByBrandCampiagnId($campaignOutlet->getBrandCampiagnId())
                            ->filterByClassificationId($outletClassification)
                            ->filterByOutletId(null, Criteria::NOT_EQUAL)
                            ->filterByOutletOrgDataId(null, Criteria::NOT_EQUAL)
                            ->filterBySelected(true)
                            ->find()->count();

                        if ($campaignClassification != null && $campaignClassification->getMaximum() < $brandCampiagnOutCount) {
                            return $this->json(["status" => 0]);
                        } else {
                            $campaignOutlet->setSelected(true);
                            $campaignOutlet->save();
                        }
                    }
                }
                $this->json(["status" => 1]);
                break;
                $this->app->Renderer()->render("brandcampiagn/brandcampiagnoutletlist.twig", $this->data);
                break;
        endswitch;
    }

    public function brandCampaignTerritories($id)
    {

        $action = $this->app->Request()->getParameter("action");

        switch ($action):
            case "":
                $this->app->Renderer()->render("brandcampiagn/addcampiagnpositions.twig", $this->data);
                break;
            case "list":
                $brandCamp = \entities\BrandCampiagnQuery::create()
                    ->filterByBrandCampiagnId($id)
                    ->findOne();

                extract($this->DTFilters($_GET));
                $response = [];

                $empls = \entities\EmployeeQuery::create()
                    ->select(['PositionId'])
                    ->filterByDesignationId($brandCamp->getDesignation())
                    ->filterByOrgUnitId($brandCamp->getOrgUnitId())
                    ->find()->toArray();

                $empUnderPositions = OrgManager::getUnderPositions($empls);
                if (count($empUnderPositions) == 0) {
                    $empUnderPositions = $empls;
                }

                $response['data'] = \entities\EmployeeQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->filterByOrgUnitId($brandCamp->getOrgUnitId())
                    ->filterByPositionId($empUnderPositions)
                    ->filterByStatus(1)
                    ->leftJoinWithPositionsRelatedByPositionId()
                    ->leftJoinWith("PositionsRelatedByReportingTo Reporting")
                    ->find()->toArray();
                $response['Positions'] =  $brandCamp->getPosition();
                $this->json($response);
                break;
            case "bulk":
                $campiagnId = $this->app->Request()->getParameter("CampiagnId", 0);
                $positioniIdArray = $this->app->Request()->getParameter("PositionId", []);

                $positionArrFilter = array_search("on", $positioniIdArray);
                if ($positionArrFilter) {
                    $positioniIds = array_shift($positioniIdArray);
                }

                if (!empty($positioniIdArray)) {
                    $positionImp = implode(',', $positioniIdArray);
                } else {
                    $positionImp = null;
                }

                $req = \entities\BrandCampiagnQuery::create()
                    ->filterByBrandCampiagnId($campiagnId)
                    ->update(array('Position' => $positionImp));
                $this->json(["status" => 1]);
                // if($req == 1){
                //     $url = $this->app->Router()->getPath("brandCampiagn");
                //     $this->app->Response()->redirect($url);
                // } 
                break;
        endswitch;
    }

    public function brandCampaignPositionOutlet($id)
    {

        $action = $this->app->Request()->getParameter("action");
        $campiagnId = $this->app->Request()->getParameter("campaignId", 0);
        $positionId = $id;

        switch ($action):
            case "":
                $this->app->Renderer()->render("brandcampiagn/addcampiagnpositionoutlet.twig", $this->data);
                break;
            case "list":
                $campiagnId = $this->app->Request()->getParameter("campaignId", 0);
                $positions = OrgManager::getUnderPositions($positionId);
                if (count($positions) == 0) {
                    $positions = $positionId;
                }

                $brandCampaign = \entities\BrandCampiagnQuery::create()
                    ->filterByBrandCampiagnId((int)$campiagnId)
                    ->leftJoinWithOutletType()
                    ->find()->toArray();

                if (count($brandCampaign) > 0) {
                    $classification = \entities\BrandCampiagnClassificationQuery::create()
                        ->select(['ClassificationId'])
                        ->filterByBrandCampiagnId($brandCampaign[0]["BrandCampiagnId"])
                        ->find()->toArray();

                    $territories = \entities\TerritoriesQuery::create()
                        ->select(['TerritoryId'])
                        ->filterByPositionId($positions)
                        ->find()->toArray();

                    if (isset($brandCampaign[0]["OutletType"]) && $brandCampaign[0]["OutletType"]["OutlettypeId"] != null) {
                        $outletTypeId = $brandCampaign[0]["OutletType"]["OutlettypeId"];
                    } else {
                        $outletTypeId = 194;
                    }

                    $response['data'] = \entities\OutletViewQuery::create()
                        ->filterByOrgUnitId($brandCampaign[0]["OrgUnitId"])
                        ->filterByTerritoryId($territories)
                        ->filterByOutletClassification($classification)
                        ->filterByOutlettypeId($outletTypeId)
                        ->where("array[" . $brandCampaign[0]["SgpiBrands"] . "] && (string_to_array(sgpi_brand_id_map, ',')::integer[])")
                        ->find()->toArray();

                    $this->json($response);
                }
                break;
            case "bulk":
                $campiagnId = $this->app->Request()->getParameter("CampiagnId", 0);
                $outletOrgIdArray = $this->app->Request()->getParameter("OutletOrgId", []);

                $outletOrgIdArrayArrFilter = array_search("on", $outletOrgIdArray);
                if ($outletOrgIdArrayArrFilter) {
                    $positioniIds = array_shift($outletOrgIdArray);
                }

                $brandCampaign = \entities\BrandCampiagnQuery::create()
                    ->filterByBrandCampiagnId((int)$campiagnId)
                    ->findOne();

                $outletView = \entities\OutletViewQuery::create()
                    ->filterByOutletOrgId($outletOrgIdArray)
                    ->groupByOutletOrgId()
                    ->find()->toArray();

                if (count($outletView) > 0) {
                    foreach ($outletView as $outlet) {
                        $campaignOutlet = \entities\BrandCampiagnDoctorsQuery::create()
                            ->filterByBrandCampiagnId($campiagnId)
                            ->filterByOutletOrgDataId($outlet["OutletOrgId"])
                            ->findOne();
                        if ($campaignOutlet == null) {
                            $campaignOutlet = new \entities\BrandCampiagnDoctors();
                        }
                        $campaignOutlet->setBrandCampiagnId($campiagnId);
                        $campaignOutlet->setOutletId($outlet["Outlet_Id"]);
                        $campaignOutlet->setOutletOrgDataId($outlet["OutletOrgId"]);
                        $campaignOutlet->setCompanyId($brandCampaign->getCompanyId());
                        $campaignOutlet->setClassificationId($outlet['OutletClassification']);
                        $campaignOutlet->save();
                    }
                }
                $this->json(["status" => 1]);
                // $url = $this->app->Router()->getPath("brandCampiagn");
                // $this->app->Response()->redirect($url);
                break;
        endswitch;
    }

    public function visitPlan($id)
    {
        $this->data['form_name'] = "Steps";
        $this->data['cols'] = [
            "AgendaType" => "AgendaType",
            "Name" => "StepName",
            "Level" => "StepLevel",
            "moye" => "Moye",
        ];

        $brandCamppiagn = \entities\BrandCampiagnQuery::create()->findPk($id);

        if($brandCamppiagn->getStatus() == 'Draft' || $brandCamppiagn->getStatus() == 'Published'){
            $this->data['disableAdd'] = false;
        }else{
            $this->data['disableAdd'] = true;
        }

        $this->data['title'] = "BrandCampiagn | " . $brandCamppiagn->getCampiagnName();
        $this->data['pk'] = "BrandCampiagnVisitPlanId";
        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        $datachange = $this->app->Request()->getParameter("datachange", 0);

        $agendaSubType = \entities\AgendatypesQuery::create()
            ->filterByOrgunitid($brandCamppiagn->getOrgUnitId())
            ->filterByIsPrivate(true)
            ->find()->toKeyValue('Agendaid','Agendname');

        if ($datachange == "agendacontrolType") {
            $agenda = $this->app->Request()->getParameter("AgendaType", '');

            $agendaSubType = \entities\AgendatypesQuery::create()
                ->filterByAgendacontroltype($agenda)
                ->filterByOrgunitid($brandCamppiagn->getOrgUnitId())
                ->filterByIsPrivate(true)
                ->find()->toKeyValue('Agendaid','Agendname');

            $html = FormMgr::select()->options(['Select Agenda'] + $agendaSubType)->label('Agenda Sub Type')->html();
            $this->json(["subtype" => $html]);
            return;

        }


        switch ($action) :
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "list":
                $this->json(["data" => \entities\BrandCampiagnVisitPlanQuery::create()
                    ->joinWithBrandCampiagn()
                    ->filterByBrandCampiagnId($id)
                    ->findByCompanyId($this->app->Auth()->CompanyId())->toArray()]);
                break;
            case "form":
                $sgpi = SgpiMasterQuery::create()
                    ->filterByOrgUnitId($brandCamppiagn->getOrgUnitId())
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->find()->toArray();
                $sgpiArr = array();
                if(count($sgpi) > 0){
                    foreach($sgpi as $sg){
                        $sgpiArr[$sg['SgpiId']] = $sg['SgpiName'].' | '.$sg['SgpiCode'];
                    }
                }

                $moye_list = [];
                $date = date('Y-m-d');
                for ($i=1; $i < 6; $i++) {
                    $monthYear = date('m-Y', strtotime($date));
                    $moye_list[$monthYear] = $monthYear;
                    $date = date('Y-m-d', strtotime($date . ' +1 month'));
                }

                $campiagnSteps = $this->getConfig("Catalogue", "Steps");

                $agendas = $this->getConfig("Catalogue", "AgendaControlType");


                $f = FormMgr::formHorizontal();
                $f->add([
                    'AgendaType' => FormMgr::select()->options(['select Agenda Control Type'] + $agendas)->label('Agenda Control Type')->required()->datachange("agendacontrolType")->id("AgendaType"),
                    'AgendaSubTypeId' => FormMgr::select()->options(['select Agenda'] + $agendaSubType)->label('Agenda Sub Type')->id("AgendaSubType")->required(),
                    'StepLevel' => FormMgr::select()->options($campiagnSteps)->label('Step')->required(),
                    'StepName' => FormMgr::text()->label('Name *')->required(),
                    'Description' => FormMgr::textarea()->label('Description'),
                    'SgpiStatus' => FormMgr::checkbox()->label('No Input Required')->id('SgpiStatus'),
                    'moye' => FormMgr::select()->options($moye_list)->label('Month / Year')->required()->id('MonthYear'),
                    'SgpiId' => FormMgr::select()->options($sgpiArr)->label('Inputs')->class("multi-select")->multiple("multiple")->id('Inputs'),
                    'CreateSurvey' => FormMgr::checkbox()->label('Create Survey')->id('CreateSurvey'),
                ]);
                $visitPlan = new \entities\BrandCampiagnVisitPlan();
                $this->data['form_name'] = "Add Steps";
                if ($pk > 0) {
                    $visitPlan = \entities\BrandCampiagnVisitPlanQuery::create()
                        ->findPk($pk);
                    $f->val($visitPlan->toArray());
                    if($visitPlan->getSgpiId() != null && $visitPlan->getSgpiId() != ''){
                        $f["SgpiId"]->val(explode(",", $visitPlan->getSgpiId()));
                    }
                    if($visitPlan->getAgendaType() != null && $visitPlan->getAgendaType() != ''){
                        $f["AgendaType"]->val($visitPlan->getAgendaType());
                    }
                    if($visitPlan->getAgendaSubTypeId() != null && $visitPlan->getAgendaSubTypeId() != ''){
                        $f["AgendaSubTypeId"]->val($visitPlan->getAgendaSubTypeId());
                    }
                    $this->data['form_name'] = "Edit Steps";
                    $this->data['canDelete'] = true;
                }
                if ($this->app->isPost() && $f->validate()) {

                    $action = $this->app->Request()->getParameter("buttonValue");
                    if ($action == "delete") {
                        $campaignVisit = \entities\BrandCampiagnVisitsQuery::create()
                            ->filterByBrandCampiagnId($id)
                            ->delete();
                        $visitPlan->delete();
                    } else {

                        if ($pk == "0" || $pk == 0){
                            $campaignStep = \entities\BrandCampiagnVisitPlanQuery::create()
                                ->filterByBrandCampiagnId($id)
                                ->filterByStepLevel((int)$_POST['StepLevel'])
                                ->findOne();

                            if ($campaignStep != null) {
                                $this->app->Session()->setFlash("error", "A brand campaign step already exists for this campaign!");
                                $f->val($_POST);
                                $this->data['form'] = $f->html();
                                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                                return;
                            }
                        }

                        if(isset($_POST['CreateSurvey'])){
                            $createSurvey= true;
                        }else{
                            $createSurvey= false;
                        }
                        if ($_POST['AgendaSubTypeId']=="0"){
                            $agendaSubType = null;
                        } else {
                            $agendaSubType = $_POST['AgendaSubTypeId'];
                        }


                        $visitPlan->setBrandCampiagnId($id);
                        $visitPlan->setStepName($_POST['StepName']);
                        $visitPlan->setAgendaSubTypeId($agendaSubType);
                        $visitPlan->setVisitPlanOrder((int)$_POST['StepLevel']);
                        $visitPlan->setStepLevel((int)$_POST['StepLevel']);
                        $visitPlan->setDescription($_POST['Description']);
                        $visitPlan->setSgpiStatus(false);
                        $visitPlan->setAgendaType($_POST['AgendaType']);
                        $visitPlan->setCreateSurvey($createSurvey);
                        if(isset($_POST['SgpiId'])){
                            $sgpiImp = implode(',',$_POST['SgpiId']);
                            $visitPlan->setSgpiId($sgpiImp);
                        }else{
                            $visitPlan->setSgpiId(null);
                        }
                        if(isset($_POST['Qty'])){
                            $visitPlan->setQty((int)$_POST['Qty']);
                        }else{
                            $visitPlan->setQty(null);
                        }
                        if(isset($_POST['moye'])){
                            $visitPlan->setMoye($_POST['moye']);
                        }else{
                            $visitPlan->setMoye(null);
                        }
                        $visitPlan->setCompanyId($this->app->Auth()->getUser()->getCompanyId());
                        $visitPlan->save();


                        if($visitPlan != null && $visitPlan->getCreateSurvey() == true){
                            $month = explode('-',$_POST['moye']);
                            $startDate = date("Y-m-01", strtotime($month[1].'-'.$month[0]));
                            $endDate = date("Y-m-t", strtotime($month[1].'-'.$month[0]));

                            if($visitPlan->getSurveyId() == null){
                                $survey = new \entities\Survey();
                            }else{
                                $survey = \entities\SurveyQuery::create()
                                    ->filterBySurveyId($visitPlan->getSurveyId())
                                    ->findOne();
                            }

                            $survey->setSurveyName($brandCamppiagn->getCampiagnName().'-'.$_POST['StepLevel']);
                            $survey->setStartDate($startDate);
                            $survey->setEndDate($endDate);
                            $survey->setOrgunitid($brandCamppiagn->getOrgUnitId());
                            $survey->setOutletTypeId($brandCamppiagn->getOutlettypeId());
                            $survey->setCompanyId($brandCamppiagn->getCompanyId());
                            $survey->setMediaId(null);
                            $survey->setIsMultiple(false);
                            $survey->setSurveyCatid(null);
                            $survey->setStatus('Active');
                            $survey->save();

                            $visitPlan->setSurveyId($survey->getSurveyId());
                            $visitPlan->save();

                            if($survey != null) {
                                $surveyQuestions = [
                                    [
                                        "Question" => 'Patient Count',
                                        "Type" => 'Numeric',
                                        "Status" => 'Active',
                                    ],
                                    [
                                        "Question" => 'Prescription Count',
                                        "Type" => 'Numeric',
                                        "Status" => 'Active',
                                    ],
                                    // Add more questions as needed
                                ];
                                foreach ($surveyQuestions as $surveyQuestion){
                                    $surveyQues = SurveyQuestionQuery::create()->filterByQuestion($surveyQuestion['Question'])->findOne();
                                    if($surveyQues==null){
                                        $surveyQues = new SurveyQuestion();
                                    }
                                    $surveyQues->setQuestion($surveyQuestion['Question']);
                                    $surveyQues->setSurveyquestype($surveyQuestion['Type']);
                                    $surveyQues->setSurveyId($survey->getSurveyId());
                                    $surveyQues->setCompanyId($this->app->Auth()->getUser()->getCompanyId());
                                    $surveyQues->setStatus('Active');
                                    $surveyQues->save();
                                }
                                $url = $this->app->Router()->getPath("survey_question", ["id"=>$survey->getSurveyId()]);
                                $this->runModalRedirect($url);
                                return;
                            }
                        }
                    }

                    $this->runModalScript("loadGrid()");
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    public function doctorVisit($id)
    {
        $this->data['form_name'] = "DoctorVisit";
        $this->data['cols'] = [
            "Outlets" => "Outlets.OutletName",
            "Outlets" => "Outlets.OutletName",
        ];

        $brandCamppiagn = \entities\BrandCampiagnQuery::create()->findPk($id);


        $this->data['title'] = "BrandCampiagn | " . $brandCamppiagn->getCampiagnName();
        $this->data['pk'] = "DoctorVisitId";
        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action):
            case "":
                $this->app->Renderer()->render("dataTableTemplate.twig", $this->data);
                break;
            case "list":
                $this->json(["data" => \entities\BrandCampiagnDoctorsQuery::create()
                    ->joinWithBrandCampiagn()
                    ->joinWithOutlets()
                    ->filterByBrandCampiagnId($id)
                    ->findByCompanyId($this->app->Auth()->CompanyId())->toArray()]);
                break;
            case "form":
                //$campiagn = BrandCampiagnQuery::create()->filterByBrandCampiagnId($id)->findOne();
                $outlets = OutletsQuery::create()
                    ->filterByOutlettypeId()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->find()->toKeyValue("Id", "OutletName");


                $outletOrgData = \entities\OutletOrgDataQuery::create()
                    ->filterByOrgUnitId($brandCamppiagn->get)
                    ->find()->toArray();

                $f = FormMgr::formHorizontal();
                $f->add([
                    'OutletId' => FormMgr::select()->options($outlets)->label('Add Doctor')->required(),
                ]);
                $doctorVisit = new \entities\DoctorVisit();
                $this->data['form_name'] = "Add Doctor";
                if ($pk > 0) {
                    $doctorVisit = \entities\DoctorVisitQuery::create()
                        ->findPk($pk);
                    $f->val($doctorVisit->toArray());
                    $this->data['form_name'] = "Edit Doctor Visit";
                }
                if ($this->app->isPost() && $f->validate()) {
                    $doctorVisit->setBrandCampiagnId($id);
                    $doctorVisit->setOutletId($_POST['OutletId']);
                    $doctorVisit->setCompanyId($this->app->Auth()->CompanyId());
                    $doctorVisit->save();

                    $visits = VisitPlanQuery::create()->filterByBrandCampiagnId($id)->find()->toArray();

                    foreach ($visits as $visit) {
                        $brandCamppiagnVisit = BrandCampiagnVisitQuery::create()
                            ->filterByBrandCampiagnId($id)
                            ->filterByVisitPlanId($visit['VisitPlanId'])
                            ->filterByOutletId($_POST['OutletId'])
                            ->findOne();

                        if ($brandCamppiagnVisit == null) {
                            $brandCamppiagnVisit = new BrandCampiagnVisit();
                        }

                        $brandCamppiagnVisit->setBrandCampiagnId(intval($id));
                        $brandCamppiagnVisit->setVisitPlanId($visit['VisitPlanId']);
                        $brandCamppiagnVisit->setOutletId(intval($_POST['OutletId']));
                        //                        $brandCamppiagnVisit->setIsVisit(false);
                        $brandCamppiagnVisit->save();
                    }


                    $this->runModalScript("loadGrid()");
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    function notificationConfiguration(){
        $this->data['title'] = "Notification Configuration";
        $this->data['form_name'] = "NotificationConfiguration";
        $this->data['cols'] = [

            "Notification Type" => "NotificationType",
            "Notification Time" => "NotificationTime",
            "Notification Subject" => "NotificationSubject",
            "Notification Message" => "NotificationMessage",
            "Redirect Screen" => "RedirectScreen",
        ];

        $this->data['pk'] = "NotificationConfigurationId";

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk",0);

        switch($action) :
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig",$this->data);
                break;
            case "list":
                extract($this->DTFilters($_GET));
                $response = [];
                $query = NotificationConfigurationQuery::create()->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')->filterByCompanyId($this->app->Auth()->CompanyId());
                $count = $query->count();
                $response["recordsTotal"] = $count;



                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->offset($offset)->limit($limit)->orderBy($sortColumn,$sortOrder)->find()->toArray();
                $this->json($response);
                break;
            case "form":
                $types = $this->getConfig("Catalogue", "Enabled");
                $languages = DesignationsQuery::create()->findByCompanyId($this->app->Auth()->getUser()->getCompanyId())->toKeyValue("DesignationId", "Designation");

                $f = FormMgr::formHorizontal();
                $f->add([
                    'NotificationType' => FormMgr::text()->label('Notification Type'),
                    'IsEnabled' => FormMgr::select()->options($types)->label('Is Enabled'),
                    'NotificationTime' => FormMgr::text()->label('Notification Time'),
                    'NotificationSubject' => FormMgr::text()->label('Notification Subject'),
                    'NotificationMessage' => FormMgr::textarea()->label('Notification Message'),
                    'RedirectScreen' => FormMgr::text()->label('Redirect Screen'),
                    'Designation' => FormMgr::select()->options($languages)->label('Designation')->class("multi-select")->multiple("multiple"),
                ]);
                $ticket = new NotificationConfiguration();
                $this->data['form_name'] = "Add Notification Configuration";
                if ($pk > 0) {
                    $ticket = NotificationConfigurationQuery::create()->findPk($pk);

                    // If the Designation is stored as a string in the DB, convert it to an array
                    $ticketData = $ticket->toArray();
                    if (!empty($ticketData['Designation'])) {
                        $ticketData['Designation'] = explode(",", $ticketData['Designation']); // Split string into array
                    }

                    $f->val($ticketData);
                    $this->data['form_name'] = "Edit Notification Configuration";
                }

                if ($this->app->isPost() && $f->validate()) {
                    $designation = implode(',',$_POST['Designation']);
//                    $ticket->fromArray($_POST);
                    $ticket->setNotificationType($_POST['NotificationType']);
                    $ticket->setIsEnabled($_POST['IsEnabled']);
                    $ticket->setNotificationTime($_POST['NotificationTime']);
                    $ticket->setNotificationSubject($_POST['NotificationSubject']);
                    $ticket->setNotificationMessage($_POST['NotificationMessage']);
                    $ticket->setRedirectScreen($_POST['RedirectScreen']);
                    $ticket->setRedirectScreen($_POST['RedirectScreen']);
                    $ticket->setDesignation($designation);

                    // Handle Designation field as an array


                    $ticket->setCompanyId($this->app->Auth()->CompanyId());
                    $ticket->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }

                $form = $f->html();


                $this->data['form'] = $form;
                $this->app->Renderer()->render("modalCommonForm.twig",$this->data);
                break;
        endswitch;
    }
}
