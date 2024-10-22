<?php

declare(strict_types=1);

namespace Modules\EDetailing\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use entities\BrandsQuery;
use App\Core\MediaManager;
use entities\EdPlaylistTypes;
use entities\EdPlaylistTypesQuery;
use Propel\Runtime\ActiveQuery\Criteria;


/**
 * Description of Masters
 *
 * @author Plus91Labs-01
 */
class Master extends \App\Core\BaseController
{

    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    function curlRemoteFilesize($url, $formatSize = true)
    {
        $ch = curl_init();
        $timeout = 5; // 5 seconds
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        $tempCURLVar = curl_exec($ch);
        // Check if curl_exec() failed
        if ($tempCURLVar === false) {
            // Get the cURL error message and handle it
            $error = curl_error($ch);
            curl_close($ch);
            return 'Error: ' . $error; // Return error message or handle it as needed

        }
        $webPageContent = $tempCURLVar;
        curl_close($ch);

        // Ensure we are working with a string before calling mb_strlen()

        $result = mb_strlen($webPageContent);

        if (!$formatSize) {
            return $result; // Return size in bytes
        }
        // Format size as human-readable string
        $clen = $result;
        $size = $result;

        switch ($clen) {
            case $clen < 1024:
                $size = $clen . ' B';
                break;
            case $clen < 1048576:
                $size = round($clen / 1024, 2) . ' KB';
                break;
            case $clen < 1073741824:
                $size = round($clen / 1048576, 2) . ' MB';
                break;
            case $clen < 1099511627776:
                $size = round($clen / 1073741824, 2) . ' GB';
                break;
        }

        return $size;
    }

    function Presentation()
    {
        ini_set('memory_limit', '-1');
        $mediaManager = new MediaManager($this->app);

        $this->data['title'] = "EdPresentations";
        $this->data['form_name'] = "EdPresentations";
        $this->data['cols'] = [
            "BrandId" => "Brands.BrandName",
            "PresentationTypeName" => "PresentationTypeName",
            "PresentationName" => "PresentationName",
            "PresentationZipUrl" => "PresentationZipUrl",
            "MediaUrl" => "mediaUrl",
            "PresentationVersionId" => "PresentationVersionId",
            //           "OrgunitId"=>"OrgUnit.UnitName",
        ];
        //       $this->data['canEditIf'] = ["col" => "Status","val" => "Open"];
        $this->data['pk'] = "PresentationId";
        $this->data['mediaCol'] = "PresentationMedia";


        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action):
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":
                $roles = $this->app->Auth()->getUser()->getRoles()->getRoleName();
                $positionId = $this->app->Auth()->getUser()->getEmployee()->getPositionId();

                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\EdPresentationsQuery::create()->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->withColumn('COALESCE(media_url, \'\')', 'mediaUrl')
                    ->joinWithBrands();
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if ($roles == "DivisionHead" && $roles == "ClusterHead") {
                    $query = $query->filterByOrgunitId($this->app->Auth()->getUser()->getEmployee()->getOrgUnitId());
                }

                if (!empty($search)) {
                    $search = '%' . strtolower($search) . '%';
                    $query = $query->condition('cond1', 'LOWER(ed_presentations.presentation_name) LIKE ?', $search)
                        ->condition('cond2', 'LOWER(brands.brand_name) LIKE ?', $search)
                        ->where(['cond1', 'cond2'], 'or');
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);
                break;
            case "form":
                $brands = \entities\BrandsQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("BrandId", "BrandName");
                $orgunit = \entities\OrgUnitQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId())->find()->toKeyValue("Orgunitid", "UnitName");
                $languages = \entities\LanguageQuery::create()->find()->toKeyValue("LanguageId", "LanguageName");
                $preType = \entities\EdPresentationTypeQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("EdtypeId", "PresentationtypeName");

                $f = FormMgr::formHorizontal();
                $f->add([
                    'BrandId' => FormMgr::select()->options($brands)->label('Brands'),
                    'presentationType' => FormMgr::select()->options($preType)->label('presentationType'),
                    //                        'OrgunitId' => FormMgr::select()->options($orgunit)->label('Org Unit'),
                    'PresentationName' => FormMgr::text()->label('Presentation Name *')->required(),
                    'PresentationZipUrl' => FormMgr::text()->label('Presentation Url *')->required(),
                    'PresentationVersionId' => FormMgr::text()->label('Presentation Version *')->required(),
                    'PageCount' => FormMgr::number()->label('Page Count *')->required(),
                    'PresentationReleaseDate' => FormMgr::date()->label('Presentation Release Date *')->required(),
                    'MediaUrl' => FormMgr::text()->label('Media Url'),
                    'PresentationLanguageId' => FormMgr::select()->options($languages)->label('Language'),
                ]);
                $presentation = new \entities\EdPresentations();
                $this->data['form_name'] = "Add Presentation";
                if ($pk > 0) {
                    $presentation = \entities\EdPresentationsQuery::create()
                        ->findPk($pk);
                    $f->val($presentation->toArray());
                    $this->data['form_name'] = "Edit Presentation";
                }
                if ($this->app->isPost() && $f->validate()) {
                    $data = $this->curlRemoteFilesize($_POST['PresentationZipUrl']);

                    $presentation->fromArray($_POST);
                    $presentation->setCompanyId($this->app->Auth()->CompanyId());
                    $presentation->setFileSize($data);
                    $brandData = BrandsQuery::create()
                        ->filterByBrandId($_POST['BrandId'])
                        ->findOne();
                    $presentationType = \entities\EdPresentationTypeQuery::create()
                        ->filterByEdtypeId($_POST['presentationType'])
                        ->findOne();
                    // var_dump($brandData->getOrgunitid());exit;
                    $presentation->setPresentationTypeName(!empty($presentationType) ? $presentationType->getPresentationtypeName() : null);

                    $presentation->setMediaUrl($_POST['MediaUrl']);
                    $presentation->setOrgunitId(!empty($brandData) ? $brandData->getOrgunitid() : null);
                    $presentation->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $form = $f->html();
                $mediaInput = $mediaManager->FormInput("PresentationMedia", "Media", [$presentation->getPresentationMedia()], 1);
                $this->data['form'] = $form . $mediaInput;
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    function get_remote_file_info($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_NOBODY, TRUE);
        $data = curl_exec($ch);
        $fileSize = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
        $httpResponseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return [
            'fileExists' => (int) $httpResponseCode == 200,
            'fileSize' => (int) $fileSize
        ];
    }

    function getPresentation($OrgUnitId)
    {

        $presentations = \entities\EdPresentationsQuery::create()
            ->filterByOrgUnitId($OrgUnitId)
            ->filterByCompanyId($this->app->Auth()->CompanyId())->find()->toKeyValue('PresentationId', 'PresentationName');

        return $presentations;
    }

    function Playlist()
    {


        $datachange = $this->app->Request()->getParameter("datachange", "");

        if ($datachange == "OrgUnitIdChange") {
            $OrgUnitId = $this->app->Request()->getParameter("OrgunitId");
            $pr = $this->getPresentation($OrgUnitId);

            $f = FormMgr::formHorizontal();

            $f["Presentations"]->val(explode(",", $pr));
            //$this->json(["Presentations" => $Presentations]);
            return;
        }
        $mediaManager = new MediaManager($this->app);

        $this->data['title'] = "EdPlaylist";
        $this->data['form_name'] = "EdPlaylist";
        $this->data['cols'] = [
            "OrgUnit" => "OrgUnit.UnitName",
            "PlaylistName" => "PlaylistName",
            "PlaylistTypeId" => "PlaylistTypeId",
            "Presentations" => "Presentations",
            "PlaylistVersionId" => "PlaylistVersionId",
            "OutletTags" => "OutletTags",
        ];


        //       $this->data['canEditIf'] = ["col" => "Status","val" => "Open"];
        $this->data['pk'] = "PlaylistId";
        $this->data['mediaCol'] = "PlaylistMedia";

        $PlaylistTypeId = EdPlaylistTypesQuery::create()->findByCompanyId($this->app->Auth()->CompanyId())->toKeyValue("EdPlaylistTypeId", "PlaylistTypeName");

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action):
            case "":
                $PlaylistTypeId["null"] = '';
                $this->data['valKeys'] = ["PlaylistTypeId" => $PlaylistTypeId];

                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":
                $roles = $this->app->Auth()->getUser()->getRoles()->getRoleName();
                $positionId = $this->app->Auth()->getUser()->getEmployee()->getPositionId();

                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\EdPlaylistQuery::create()->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')->filterByIscustom(false)->filterByCompanyId($this->app->Auth()->CompanyId());
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if ($roles == "DivisionHead" && $roles == "ClusterHead") {
                    $query = $query->filterByOrgunitId($this->app->Auth()->getUser()->getEmployee()->getOrgUnitId());
                }

                if (!empty($search)) {
                    $search = '%' . strtolower($search) . '%';
                    $query = $query->where('LOWER(ed_playlist.playlist_name) LIKE ?', $search);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->joinWithOrgUnit()->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);
                break;
            case "form":
                $playlist = new \entities\EdPlaylist();
                if ($pk > 0) {
                    $playlist = \entities\EdPlaylistQuery::create()
                        ->findPk($pk);
                    $selectedPresentatation = explode(",", $playlist->getPresentations());
                } else {
                    $selectedPresentatation = [];
                }
                $Presentation_list = \entities\EdPresentationsQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->where('ed_presentations.presentation_name IS NOT NULL')
                    ->find();

                $Presentation = [];
                foreach ($Presentation_list as $pres) {
                    $Presentation[$pres->getPrimaryKey()] = $pres->getPresentationName() . " | " . ($pres->getOrgUnit() ? $pres->getOrgUnit()->getUnitName() : '');
                }
                $status = $this->getConfig("EDetailing", "status");
                $outletTags = \entities\OutletTagsQuery::create()->find()->toKeyValue("TagName", "TagName");
                $orgunit = \entities\OrgUnitQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId())->find()->toKeyValue("Orgunitid", "UnitName");

                if (!empty($selectedPresentatation)) {
                    $orderedPresentation = [];
                    foreach ($selectedPresentatation as $presentationId) {
                        $orderedPresentation[$presentationId] = $Presentation[$presentationId];
                        unset($Presentation[$presentationId]);
                    }
                    $Presentation = $orderedPresentation + $Presentation;
                }

                $f = FormMgr::formHorizontal();
                $f->add([
                    'PlaylistName' => FormMgr::text()->label('Playlist Name *')->required(),
                    'PlaylistTypeId' => FormMgr::select()->options($PlaylistTypeId)->label('Type')->required(),
                    'OrgunitId' => FormMgr::select()->options([0 => '--- Select Org Unit ---'] + $orgunit)->id('org_unit')->label('Org Unit'),
                    'Presentations' => FormMgr::select()->options($Presentation)->label('Presentations *')->class("multi-select")->multiple("multiple")->required(),
                    'PlaylistVersionId' => FormMgr::text()->label('PlaylistVersionId *')->required(),
                    'OutletTags' => FormMgr::select()->options($outletTags)->label('Outlet Tags')->class("multi-select")->multiple("multiple"),


                ]);

                $this->data['form_name'] = "Add Playlist";
                if ($pk > 0) {
                    $f->val($playlist->toArray());

                    if ($playlist->getPresentations() != null) {
                        $f["Presentations"]->val(explode(",", $playlist->getPresentations()));
                    }

                    if ($playlist->getOutletTags() != "") {
                        $f["OutletTags"]->val(explode(",", $playlist->getOutletTags()));
                    }

                    $this->data['form_name'] = "Edit Playlist";
                }
                if ($this->app->isPost() && $f->validate()) {
                    if (isset($_POST['Presentations']) && $_POST['Presentations'] != null) {
                        $state = implode(",", $_POST['Presentations']);
                    } else {
                        $state = null;
                    }
                    if (isset($_POST['OutletTags']) && $_POST['OutletTags'] != null) {
                        $tags = implode(",", $_POST['OutletTags']);
                    } else {
                        $tags = null;
                    }

                    unset($_POST['Presentations']);
                    //                    $tags = implode(",", $_POST['OutletTags']);
                    unset($_POST['OutletTags']);
                    $playlist->fromArray($_POST);
                    $playlist->setIscustom(false);
                    $playlist->setPresentations($state);
                    $playlist->setOutletTags($tags);
                    $playlist->setCompanyId($this->app->Auth()->CompanyId());
                    $playlist->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $form = $f->html();
                $mediaInput = $mediaManager->FormInput("PlaylistMedia", "Media", [$playlist->getPlaylistMedia()], 5);
                $this->data['form'] = $form . $mediaInput;
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    public function reports()
    {
        $mediaManager = new MediaManager($this->app);

        $this->data['title'] = "EdStats";
        $this->data['form_name'] = "Edstats";
        $this->data['disableAdd'] = true;
        $this->data['disableEdit'] = true;
        $this->data['cols'] = [
            "OutletOrgId" => "OutletOrgData.Tags",
            "BrandId" => "Brands.BrandName",
            "Order" => "Order",
            "Orgunitid" => "OrgUnit.UnitName",
            "EmployeeId" => "EmployeeId",
            "PositionId" => "PositionId",
        ];
        //       $this->data['canEditIf'] = ["col" => "Status","val" => "Open"];
        $this->data['pk'] = "PlaylistId";
        $this->data['mediaCol'] = "PlaylistMedia";
        // $this->data['id_fields'] = [
        // "EmployeeId",
        // "PositionId",
        // "CompetitorId"
        // ];

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action):
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":
                $roles = $this->app->Auth()->getUser()->getRoles()->getRoleName();
                $positionId = $this->app->Auth()->getUser()->getEmployee()->getPositionId();

                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\EdStatsQuery::create()->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')->filterByCompanyId($this->app->Auth()->CompanyId());
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if ($roles == "DivisionHead" && $roles == "ClusterHead") {
                    $query = $query->filterByOrgunitId($this->app->Auth()->getUser()->getEmployee()->getOrgUnitId());
                }

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query = $query->filterByPlaylistName($search, Criteria::LIKE);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->joinWithBrands()->joinWithOrgUnit()->joinWithOutletOrgData()->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);
                break;

        endswitch;
    }

    function playlistType()
    {
        $this->data['title'] = "Playlist Types";
        $this->data['form_name'] = "PlaylistType";
        $this->data['cols'] = [
            "Types" => "PlaylistTypeName",

        ];
        $this->data['pk'] = "EdPlaylistTypeId";

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action):
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":
                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\EdPlaylistTypesQuery::create();
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query = $query->filterByPlaylistTypeName($search, Criteria::LIKE);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->filterByCompanyId($this->app->Auth()->CompanyId())->find()->toArray();
                $this->json($response);

                break;
            case "form":

                $f = FormMgr::formHorizontal();
                $f->add([
                    'PlaylistTypeName' => FormMgr::text()->label('Type *')->required(),
                ]);

                $this->data['form_name'] = "Add Playlist Type";
                $playlistType = new EdPlaylistTypes();
                if ($pk > 0) {
                    $playlistType = \entities\EdPlaylistTypesQuery::create()->findPk($pk);
                    $f->val($playlistType->toArray());
                    $this->data['form_name'] = "Edit Playlist Type";
                }

                if ($this->app->isPost() && $f->validate()) {

                    $playlistType->fromArray($_POST);
                    $playlistType->setCompanyId($this->app->Auth()->CompanyId());
                    $playlistType->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }
}
