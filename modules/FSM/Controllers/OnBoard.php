<?php

declare(strict_types=1);

namespace Modules\FSM\Controllers;

use App\System\App;
use App\Utils\FormMgr;
use BI\manager\OnBoardManager;
use BI\manager\OrgManager;
use \entities\OnBoardRequest;
use \entities\OnBoardRequestQuery;
use \entities\OnBoardRequestAddress;
use \entities\OnBoardRequestAddressQuery;
use \entities\OnBoardRequestOutletMapping;
use \entities\OnBoardRequestOutletMappingQuery;
use \entities\OnBoardRequestLog;
use \entities\OnBoardRequestLogQuery;
use \entities\ClassificationQuery;
use \entities\BrandsQuery;
use \entities\MediaFilesQuery;
use App\Core\MediaManager;
use Exception;
use Propel\Runtime\ActiveQuery\Criteria;

class OnBoard extends \App\Core\BaseController
{
    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function getOrgUnitList()
    {
        $action = $this->app->Request()->getParameter("action", "");
        switch ($action):
            case "";
                $this->app->Renderer()->render("fsm/orgunitonboard.twig", $this->data);
                break;
            case "list":
                $orgUnitIds = \entities\OnBoardRequestAddressQuery::create()
                    ->select('OrgUnitId')
                    ->groupByOrgUnitId()
                    ->find()->toArray();

                $orgUnits = \entities\OrgUnitQuery::create()
                    ->filterByOrgunitid($orgUnitIds)
                    ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
                    ->find()->toArray();
                $this->json(["data" => $orgUnits]);
                break;
        endswitch;
    }

    public function onBoardRequest($orgunit)
    {
        //ini_set('memory_limit', '-1');
        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        $this->data['disableAdd'] = true;
        $this->data['disableEdit'] = true;
        switch ($action):
            case "":
                $this->data['title'] = "OnBoardRequests";
                $this->data['form_name'] = "OnBoardRequests";
                $this->data['cols'] = [
                    "OutletName" => "FirstName",
                    "OutletType" => "OutlettypeName",
                    "Email" => "Email",
                    "Mobile" => "Mobile",
                    "Territory" => "TerritoryName",
                    "Position" => "CreatedBy",
                    "CreatedAt" => "CreatedAt",
                    "ApprovedAt" => "ApprovedAt",
                    "Status" => "Status",
                    "Operations" => "Operations"
                ];
                $this->data['pk'] = "OnBoardRequestId";

                $this->data['rowButtons'] = ["fsm_onBoardRequestDetails" => "zmdi zmdi-eye"];

                $status = $this->getConfig("Outlets", "OnBoardStatus");

                unset($status[1]);
                unset($status[3]);
                unset($status[8]);

                $territories = OnBoardRequestQuery::create()
                    ->select(['Territory'])
                    ->filterByStatus([2, 4, 5, 7, 6])
                    ->groupByTerritory()
                    ->find()->toArray();

                $this->data['valKeys'] = ["Status" => $status];

                $territoriesArray = \entities\TerritoriesQuery::create()
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->filterByTerritoryId($territories)
                    ->filterByOrgunitid($orgunit)
                    ->find()->toKeyValue("TerritoryId", "TerritoryName");

                $terrArray = [0 => "All"];
                foreach ($territoriesArray as $ta => $tv) {
                    $terrArray[$ta] = $tv;
                }

                $this->data['listFilters'] = [
                    "OnBoardingStatus" => $status,
                    "Address" => $this->getConfig("Outlets", "OnBoardAddressStatus"),
                    "OutletType" => \entities\OutletTypeQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->filterByOnboardEnabled(true)
                        ->find()->toKeyValue("OutlettypeId", "OutlettypeName"),
                    "Territory" => $terrArray,
                    //"State" => $states,
                ];
                $this->app->Renderer()->render("fsm/onboardlist.twig", $this->data);
                break;
            case "list":
                $OutletType = $this->app->Request()->getParameter("OutletType");
                $Territory = $this->app->Request()->getParameter("Territory");
                $Address = $this->app->Request()->getParameter("Address");
                $OnBoardingStatus = $this->app->Request()->getParameter("OnBoardingStatus");
                $employee = $this->app->Auth()->getUser()->getEmployee();
                $positions = OrgManager::getUnderPositions($employee->getPositionId());

                $query = \entities\OnboardingRequestViewQuery::create()
                    ->filterByOperations($Address)
                    ->filterByStatus($OnBoardingStatus)
                    ->filterByOutletTypeId($OutletType)
                    ->filterByOrgunitid($orgunit);

                if ($Territory > 0) {
                    $query->filterByTerritory($Territory);
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                extract($this->DTFilters($_GET));
                $requests = \entities\OnboardingRequestViewQuery::create()
                    ->where('OnboardingRequestView.Operations LIKE ?', '%' . $Address . '%')
                    ->filterByOutletTypeId($OutletType)
                    ->filterByStatus($OnBoardingStatus)
                    ->filterByOrgunitid($orgunit)
                    ->offset($offset)
                    ->limit($limit)
                    ->orderBy($sortColumn, $sortOrder);

                if ($Territory > 0) {
                    $requests->filterByTerritory($Territory);
                }

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query = $requests->filterByOutletName($search, Criteria::LIKE);
                }


                $response['data'] = $requests->find()->toArray();
                $this->json($response);
                break;
            case "bulk":
                $moveStatus = (int)$this->app->Request()->getParameter("moveStatus");
                $onBoardRequestId = $this->app->Request()->getParameter("OnBoardRequestId", []);

                $item = array_slice($onBoardRequestId, 0, 1, true);
                if ($item[0] == 'on') {
                    $requestIds = array_shift($onBoardRequestId);
                }

                $req = \entities\OnBoardRequestQuery::create()
                    ->filterByOnBoardRequestId($onBoardRequestId)
                    ->update(array('Status' => $moveStatus));

                $this->json(["status" => 1]);
                break;
        endswitch;
    }

    public function onBoardRequestDetails($id)
    {
        $action = $this->app->Request()->getParameter("action");
        switch ($action):
            case "":
                $this->data['OnBoardRequest'] = OnBoardRequestQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->leftJoinWithPositionsRelatedByPosition()
                    ->leftJoinWithTerritories()
                    ->leftJoinWithOutletType()
                    ->filterByOnBoardRequestId($id)
                    ->find()->toArray();
                $this->data['OnBoardRequestCreateBy'] = \entities\EmployeeQuery::create()
                    ->filterByEmployeeId($this->data['OnBoardRequest'][0]["CreatedByEmployeeId"])
                    ->findOne();
                $this->data['OnBoardRequestApproveBy'] = \entities\EmployeeQuery::create()
                    ->filterByEmployeeId($this->data['OnBoardRequest'][0]["ApprovedByEmployeeId"])
                    ->findOne();
                $this->data['OnBoardRequestAddress'] = OnBoardRequestAddressQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->leftJoinWithGeoTowns()
                    ->leftJoinWithGeoCity()
                    ->leftJoinWithGeoState()
                    ->leftJoinWithBeats()
                    ->leftJoinWithOutletType()
                    ->filterByOnBoardRequestId($id)
                    ->find()->toArray();
                    $documents = [];
                    if(isset($this->data['OnBoardRequestAddress'])){
                        foreach($this->data['OnBoardRequestAddress'] as $address){
                            if(!empty($address) && isset($address['SpportDocuments'])){
                                $exp = explode(',',$address['SpportDocuments']);
                                if(!empty($exp)){
                                    foreach($exp as $document){
                                        array_push($documents,$document);
                                    }
                                }
                            }
                        }
                    }

                    $addressMedias = \entities\MediaFilesQuery::create()
                        ->select(['MediaData'])
                        ->filterByIss3file(true)
                        ->filterByMediaId($documents)
                        ->find()->toArray();

                    $results = [];
                    foreach($addressMedias as $addressMedia){
                        $url = $url = $_ENV['STACKHERO_MINIO_HOST'] . '/' . $_ENV['STACKHERO_MINIO_AWS_BUCKET'] . '/' . $addressMedia;
                        array_push($results,$url);
                    }
                $this->data['OnBoardRequestLog'] = OnBoardRequestLogQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->leftJoinWithOnBoardRequest()
                    ->leftJoinWithEmployee()
                    ->leftJoinWithPositions()
                    ->filterByOnBoardRequestId($id)
                    ->orderByOnBoardRequestLogId()
                    ->find()->toArray();
                $OnBoardRequestOutletMapping = OnBoardRequestOutletMappingQuery::create()
                    ->filterByOnBoardRequestId($id)
                    ->find()->toArray();
                if (count($OnBoardRequestOutletMapping) > 0) {
                    $mapping = array();
                    $outletIds = array();
                    foreach ($OnBoardRequestOutletMapping as $OnBoardRequestOutletMap) {
                        if (!empty($OnBoardRequestOutletMap['PrimaryOutletId'])) {
                            array_push($outletIds, $OnBoardRequestOutletMap['PrimaryOutletId']);
                        }
                        if (!empty($OnBoardRequestOutletMap['SecondaryOutletId'])) {
                            array_push($outletIds, $OnBoardRequestOutletMap['SecondaryOutletId']);
                        }
                    }
                    $outlets = \entities\OutletViewQuery::create()
                        ->select(['OutlettypeName', 'OutletCode', 'OutletName'])
                        ->filterByOutlet_Id($outletIds)
                        ->groupByOutlet_Id()
                        ->find()->toArray();
                    if (count($outlets) > 0) {
                        foreach ($outlets as $outlet) {
                            $data = [
                                'RequestId' => $OnBoardRequestOutletMap['OnBoardRequestOutletMappingId'],
                                'OutletType' => $outlet['OutlettypeName'],
                                'OutletCode' => $outlet['OutletCode'],
                                'OutletName' => $outlet['OutletName'],
                                //'OutletBeat' => $outlet['BeatName'],
                            ];
                            array_push($mapping, $data);
                        }
                    }
                } else {
                    $mapping = array();
                }

                if ($this->data['OnBoardRequest'][0]["ProfilePic"] != null && $this->data['OnBoardRequest'][0]["ProfilePic"] != '') {
                    $media = \entities\MediaFilesQuery::create()
                        ->filterByIss3file(true)
                        ->filterByMediaId($this->data['OnBoardRequest'][0]["ProfilePic"])
                        ->findOne();
                } else {
                    $media = null;
                }
                if ($media != null && $media->getMediaData() != null) {
                    if (is_numeric($media->getMediaData())) {
                        $profilePic = $media->getMediaData();
                    } else {
                        $profilePic = null;
                    }
                } else {
                    $profilePic = null;
                }
                
                $this->data['Mapping'] = $mapping;
                $this->data['RequestId'] = $this->data['OnBoardRequest'][0]['OnBoardRequestId'];
                $this->data['Status'] = $this->data['OnBoardRequest'][0]['Status'];
                $this->data['Profile'] = $profilePic;
                $this->data['AddressMedias'] = $results; 
                $this->app->Renderer()->render("fsm/onboardingdetails.twig", $this->data);
                break;
            case "View":
                $mediaManager = new MediaManager($this->app);
                //$this->data['mediaCol'] = "SpportDocuments";
                $addressId = $this->app->Request()->getParameter("address_id");
                $pk = $addressId;
                $this->data['form_name'] = "Update Address Details";
                $OnBoardRequestAddress = OnBoardRequestAddressQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->filterByOnBoardRequestAddressId($addressId)
                    ->findOne();

                $request = \entities\OnBoardRequestQuery::create()
                    ->filterByOnBoardRequestId($OnBoardRequestAddress["OnBoardRequestId"])
                    ->findOne();
                // $Onspecility = ClassificationQuery::create()
                //     ->filterById($OnBoardRequestAddress[0]["Speciality"])
                //     ->find()->toArray();
                // $Brands = BrandsQuery::create()
                //     ->filterByBrandId($OnBoardRequestAddress[0]["FocusBrand"])
                //     ->find()->toArray();
                $outletTypes = \entities\OutletTypeQuery::create()
                    ->find()->toKeyValue('OutletTypeId', 'OutletTypeName');
                $geoTowns = \entities\GeoTownsQuery::create()
                    ->find()->toKeyValue('Itownid', 'Stownname');
                $geoCities = \entities\GeoCityQuery::create()
                    ->find()->toKeyValue('Icityid', 'Scityname');
                $geoStates = \entities\GeoStateQuery::create()
                    ->find()->toKeyValue('Istateid', 'Sstatename');
                $orgunits = \entities\OrgUnitQuery::create()
                    ->find()->toKeyValue('Orgunitid', 'UnitName');
                $speciality = \entities\ClassificationQuery::create()
                    ->find()->toKeyValue('Id', 'Classification');
                $tags = \entities\OutletTagsQuery::create()
                    ->find()->toKeyValue('OutletTagId', 'TagName');
                $brands = \entities\BrandsQuery::create()
                    ->find()->toKeyValue('BrandId', 'BrandName');
                $beats = \entities\BeatsQuery::create()
                    ->filterByOrgUnitId($OnBoardRequestAddress["OrgUnitId"])
                    ->filterByTerritoryId($request->getTerritory())
                    ->find()->toKeyValue('BeatId', 'BeatName');


                $f = FormMgr::formHorizontal();
                $f->add([
                    'OutletSubTypeId' => FormMgr::select()->options($outletTypes)->label('Outlet Type')->id("OutletType"),
                    'OutletOrgCode' => FormMgr::text()->label('P-Code'),
                    'Address' => FormMgr::text()->label('Address'),
                    'Landmark' => FormMgr::text()->label('Landmark'),
                    'Itownid' => FormMgr::select()->options($geoTowns)->label('Town')->id("TownId"),
                    'Icityid' => FormMgr::select()->options($geoCities)->label('City')->id("CityId"),
                    'Istateid' => FormMgr::select()->options($geoStates)->label('State')->id("StateId"),
                    'Pincode' => FormMgr::text()->label('Pincode'),
                    'Speciality' => FormMgr::select()->options($speciality)->label('Speciality')->id("SpecialityId"),
                    'Potential' => FormMgr::text()->label('Potential'),
                    'VisitFrequency' => FormMgr::text()->label('Visit Frequency'),
                    'Tags' => FormMgr::select()->options($tags)->label('Tags')->id("TagsId"),
                    'FocusBrand' => FormMgr::select()->options($brands)->label('FocusBrand')->id("FocusBrandId"),
                    'BeatId' => FormMgr::select()->options($beats)->label('Beat')->id("BeatId"),
                    'OrgUnitId' => FormMgr::select()->options($orgunits)->label('OrgUnit')->id("OrgUnitId"),
                    //'SpportDocuments' => FormMgr::text()->label('Spport Documents')->value(),
                ]);
                if ($pk > 0) {
                    $OnBoardRequestAddress = OnBoardRequestAddressQuery::create()->findPk($pk);
                    $f->val($OnBoardRequestAddress->toArray());
                    if (isset($OnBoardRequestAddress) && $OnBoardRequestAddress->getOutletType() != null && $OnBoardRequestAddress->getOutletType()->getOutlettypeName() != null) {
                        $f['OutletSubTypeId']->sudovalue($OnBoardRequestAddress->getOutletType()->getOutlettypeName());
                    }
                    if (isset($OnBoardRequestAddress) && $OnBoardRequestAddress->getGeoTowns() != null && $OnBoardRequestAddress->getGeoTowns()->getStownname() != null) {
                        $f['Itownid']->sudovalue($OnBoardRequestAddress->getGeoTowns()->getStownname());
                    }
                    if (isset($OnBoardRequestAddress) && $OnBoardRequestAddress->getGeoCity() != null && $OnBoardRequestAddress->getGeoCity()->getScityname() != null) {
                        $f['Icityid']->sudovalue($OnBoardRequestAddress->getGeoCity()->getScityname());
                    }
                    if (isset($OnBoardRequestAddress) && $OnBoardRequestAddress->getGeoState() != null && $OnBoardRequestAddress->getGeoState()->getSstatename() != null) {
                        $f['Istateid']->sudovalue($OnBoardRequestAddress->getGeoState()->getSstatename());
                    }
                    if (isset($OnBoardRequestAddress) && $OnBoardRequestAddress->getClassification() != null && $OnBoardRequestAddress->getClassification()->getClassification() != null) {
                        $f['Speciality']->sudovalue($OnBoardRequestAddress->getClassification()->getClassification());
                    }
                    if (isset($OnBoardRequestAddress) && $OnBoardRequestAddress->getOutletTags() != null && $OnBoardRequestAddress->getOutletTags()->getTagName() != null) {
                        $f['Tags']->sudovalue($OnBoardRequestAddress->getOutletTags()->getTagName());
                    }
                    if (isset($OnBoardRequestAddress) && $OnBoardRequestAddress->getBrands() != null && $OnBoardRequestAddress->getBrands()->getBrandName() != null) {
                        $f['FocusBrand']->sudovalue($OnBoardRequestAddress->getBrands()->getBrandName());
                    }
                    if (isset($OnBoardRequestAddress) && $OnBoardRequestAddress->getBeats() != null && $OnBoardRequestAddress->getBeats()->getBeatName() != null) {
                        $f['BeatId']->sudovalue($OnBoardRequestAddress->getBeats()->getBeatName());
                    }
                    if (isset($OnBoardRequestAddress) && $OnBoardRequestAddress->getOrgUnit() != null && $OnBoardRequestAddress->getOrgUnit()->getUnitName() != null) {
                        $f['OrgUnitId']->sudovalue($OnBoardRequestAddress->getOrgUnit()->getUnitName());
                    }
                    $this->data['form_name'] = "Update Address Details";
                }
                if ($this->app->isPost() && $f->validate()) {
                    $OnBoardRequestAddress->fromArray($_POST);
                    $OnBoardRequestAddress->setCompanyId($this->app->Auth()->getUser()->getCompanyId());
                    $OnBoardRequestAddress->save();
                    $this->runModalScript("reloadGrid()");
                    return;
                }
                $form = $f->html();
                //$mediaInput = $mediaManager->FormInput("SpportDocuments", "Media", [$OnBoardRequestAddress->getSpportDocuments()], 5);
                $this->data['form'] = $form;
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
            case "Approve":
                $requestId = $this->app->Request()->getParameter("request_id");
                $employee = $this->app->Auth()->getUser()->getEmployee();
                $this->data['form_name'] = "Request Approve";
                $f = FormMgr::formHorizontal();
                $f->add([
                    'Description' => FormMgr::text()->label('Remark'),
                    'LegacyCode' => FormMgr::text()->label('Legacy Code'),
                ]);
                if ($this->app->isPost() && $f->validate()) {
                    $request = \entities\OnBoardRequestQuery::create()
                        ->filterByOnBoardRequestId($requestId)
                        ->findOne();
                    $request->setDescriptioin($_POST['Description']);
                    $request->setOutletCode($_POST['LegacyCode']);
                    $request->setStatus(6);
                    $request->save();
                    $oBM = new \BI\manager\OnBoardManager();
                    $oBM->createLog($requestId, 6, $employee->getEmployeeId(), $employee->getPositionId(), "Request final approved successfully!");
                    $position = \entities\PositionsQuery::create()
                        ->filterByPositionId($employee->getPositionId())
                        ->findOne();
                    if ($position != null) {
                        $positionId = $request->getPosition();
                        $title = 'Request Approve';
                        $message = 'Request approved successfully!';
                        \BI\manager\NotificationManager::sendNotificationToPosition($positionId, $title, $message, $data = []);
                    }
                    $this->runModalScript("reloadGrid()");
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
            case "Reject":
                $requestId = $this->app->Request()->getParameter("request_id");
                $employee = $this->app->Auth()->getUser()->getEmployee();
                $og = $employee->getOrgUnitId();
                $url = $this->app->Router()->getPath("fsm_onBoardRequest", ["orgunit" => $og]);
                $this->data['form_name'] = "Request Reject";
                $f = FormMgr::formHorizontal();
                $f->add([
                    'Description' => FormMgr::text()->label('Remark'),
                ]);
                if ($this->app->isPost() && $f->validate()) {
                    $request = \entities\OnBoardRequestQuery::create()
                        ->filterByOnBoardRequestId($requestId)
                        ->findOne();
                    $request->setDescriptioin($_POST['Description']);
                    $request->setStatus(1);
                    $request->save();
                    $oBM = new \BI\manager\OnBoardManager();
                    $oBM->createLog($requestId, 5, $employee->getEmployeeId(), $employee->getPositionId(), "Request rejected successfully!");
                    $oBM->createLog($requestId, 1, $employee->getEmployeeId(), $employee->getPositionId(), "Request created successfully!");
                    $position = \entities\PositionsQuery::create()
                        ->filterByPositionId($employee->getPositionId())
                        ->findOne();
                    if ($position != null) {
                        $positionId = $request->getPosition();
                        $title = 'Request Reject';
                        $message = 'Request rejected successfully!';
                        \BI\manager\NotificationManager::sendNotificationToPosition($positionId, $title, $message, $data = []);
                    }
                    $this->runModalRedirect($url);
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
            case "Delete":
                $requestId = $this->app->Request()->getParameter("request_id");
                $employee = $this->app->Auth()->getUser()->getEmployee();
                $this->data['form_name'] = "Request Delete";
                $f = FormMgr::formHorizontal();
                $f->add([
                    'Description' => FormMgr::text()->label('Remark'),
                ]);
                if ($this->app->isPost() && $f->validate()) {
                    $request = \entities\OnBoardRequestQuery::create()
                        ->filterByOnBoardRequestId($requestId)
                        ->findOne();
                    $request->setDescriptioin($_POST['Description']);
                    $request->setStatus(8);
                    $request->save();
                    $oBM = new \BI\manager\OnBoardManager();
                    $oBM->createLog($requestId, 8, $employee->getEmployeeId(), $employee->getPositionId(), "Request deleted successfully!");
                    $position = \entities\PositionsQuery::create()
                        ->filterByPositionId($employee->getPositionId())
                        ->findOne();
                    if ($position != null) {
                        $positionId = $request->getPosition();
                        $title = 'Request Delete';
                        $message = 'Request deleted successfully!';
                        \BI\manager\NotificationManager::sendNotificationToPosition($positionId, $title, $message, $data = []);
                    }
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
            case "Edit":
                $mediaManager = new MediaManager($this->app);
                $this->data['mediaCol'] = "ProfilePic";
                $pk = $id;
                $requestId = $this->app->Request()->getParameter("request_id");
                $url = $this->app->Router()->getPath("fsm_onBoardRequestDetails", ["id" => $requestId]);
                $this->data['form_name'] = "Update EDM Details";
                $outletTypes = \entities\OutletTypeQuery::create()
                    ->find()->toKeyValue('OutletTypeId', 'OutletTypeName');
                $territories = \entities\TerritoriesQuery::create()
                    ->find()->toKeyValue('TerritoryId', 'TerritoryName');
                $positions = \entities\PositionsQuery::create()
                    ->find()->toKeyValue('PositionId', 'PositionName');
                $statuses = $this->getConfig("Outlets", "OnBoardStatus");
                $f = FormMgr::formHorizontal();
                $f->add([
                    'Salutation' => FormMgr::text()->label('Salutation'),
                    'OutletTypeId' => FormMgr::select()->options($outletTypes)->label('Outlet Type')->id("OutletTypeId"),
                    'OutletCode' => FormMgr::text()->label('OutletCode'),
                    'FirstName' => FormMgr::text()->label('Full Name'),
                    'Email' => FormMgr::text()->label('Email'),
                    'Mobile' => FormMgr::text()->label('Mobile'),
                    'Gender' => FormMgr::text()->label('Gender'),
                    'DateOfBirth' => FormMgr::date()->label('Date Of Birth'),
                    'MaritalStatus' => FormMgr::text()->label('Marital Status'),
                    'DateOfAnniversary' => FormMgr::date()->label('Date Of Anniversary'),
                    'Qualification' => FormMgr::text()->label('Qualification'),
                    'RegistrationNo' => FormMgr::text()->label('Registration No.'),
                    'Territory' => FormMgr::select()->options($territories)->label('Territory')->id("TerritoryId"),
                    'Position' => FormMgr::select()->options($positions)->label('Position')->id("PositionId"),
                    'Status' => FormMgr::select()->options($statuses)->label('Status')->id("StatusId"),
                    'Descriptioin' => FormMgr::text()->label('Descriptioin'),
                ]);
                if ($pk > 0) {
                    $onboardRequest = OnBoardRequestQuery::create()->findPk($pk);
                    $f->val($onboardRequest->toArray());
                    $f['Territory']->sudovalue($onboardRequest->getTerritories()->getTerritoryName());
                    $f['Position']->sudovalue($onboardRequest->getPositionsRelatedByPosition()->getPositionName());
                    $f['OutletTypeId']->sudovalue($onboardRequest->getOutletType()->getOutlettypeName());
                    $f['Status']->sudovalue($this->getConfig("Outlets", "OnBoardStatus"));
                    $this->data['form_name'] = "Edit EDM Details";
                }
                if ($this->app->isPost() && $f->validate()) {
                    $onboardRequest->fromArray($_POST);
                    $onboardRequest->setCompanyId($this->app->Auth()->CompanyId());
                    $onboardRequest->save();
                    $this->runModalRedirect($url);
                    return;
                }
                $form = $f->html();
                $mediaInput = $mediaManager->FormInput("ProfilePic", "ProfilePic", [$onboardRequest->getProfilePic()], 1);
                $this->data['form'] = $form . $mediaInput;
                $this->app->Renderer()->render("modalCommonForm.twig", $this->data);
                break;
        endswitch;
    }

    public function onBoardRequiredFields()
    {
        $this->data['title'] = "RequiredFields";
        $this->data['form_name'] = "RequiredFields";
        $this->data['cols'] = [
            "OrgUnit" => "OrgUnit.UnitName",
            "Outlet Type" => "OutletType.OutlettypeName",
            "Mode" => "StatusTypeId",
            "Required Fields" => "RequiredFields",
        ];


        $this->data['pk'] = "OnBoardRequiredFieldsId";

        $this->data['valKeys'] = ["StatusTypeId" => $this->getConfig("FSM", "OnBoardingStatus")];

        $action = $this->app->Request()->getParameter("action");
        $pk = $this->app->Request()->getParameter("pk", 0);

        switch ($action):
            case "":
                $this->app->Renderer()->render("dataTableServerSideTemplate.twig", $this->data);
                break;
            case "list":


                extract($this->DTFilters($_GET));
                $response = [];
                $query = \entities\OnBoardRequiredFieldsQuery::create()->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')->filterByCompanyId($this->app->Auth()->CompanyId());
                $count = $query->count();
                $response["recordsTotal"] = $count;

                if (!empty($search)) {
                    $search = '%' . $search . '%';
                    $query = $query
                        /*->_or()
                        ->filterByRequiredFields($search, Criteria::LIKE)*/
                        ->useOrgUnitQuery()
                        ->filterByUnitName($search, Criteria::LIKE)
                        ->endUse()
                        ->_or()
                        ->useOutletTypeQuery()
                        ->filterByOutlettypeName($search, Criteria::LIKE)
                        ->endUse();
                }

                $count = $query->count();
                $response["recordsFiltered"] = $count;
                $response['data'] = $query->leftJoinWithOrgUnit()->leftJoinWithOutletType()->offset($offset)->limit($limit)->orderBy($sortColumn, $sortOrder)->find()->toArray();
                $this->json($response);
                break;
            case "form":

                $OrgUnitId = \entities\OrgUnitQuery::create()
                    ->findByCompanyId($this->app->Auth()->CompanyId())
                    ->toKeyValue("Orgunitid", "UnitName");

                $outletTypes = \entities\OutletTypeQuery::create()
                    ->findByCompanyId($this->app->Auth()->CompanyId())
                    ->toKeyValue("OutlettypeId", "OutlettypeName");

                $requiredFieStatusType = $this->getConfig("FSM", "OnBoardingStatusType");

                $requiredFie = $this->getConfig("FSM", "RequiredFields");

                $onBoardRequiredFields = new \entities\OnBoardRequiredFields();
                $this->data['form_name'] = "Add OnBoardRequiredFields";


                $f = FormMgr::formHorizontal();
                $f->add([
                    'OrgUnitId' => FormMgr::select()->options($OrgUnitId)->label('OrgUnit'),
                    'OutletTypeId' => FormMgr::select()->options($outletTypes)->label('Outlet Types'),
                    'StatusTypeId' => FormMgr::select()->options($requiredFieStatusType)->label('Status Type'),
                    'RequiredFields' => FormMgr::select()->options($requiredFie)->label('Required Fields')->class("multi-select")->multiple("multiple")->required(),
                ]);

                if ($pk > 0) {
                    $onBoardRequiredFields = \entities\OnBoardRequiredFieldsQuery::create()->findPk($pk);

                    $f->val($onBoardRequiredFields->toArray());

                    $this->data['form_name'] = "Edit OnBoardRequiredFields";
                }

                if ($this->app->isPost() && $f->validate()) {
                    if ($pk == 0) {
                        $onboardReqFields = \entities\OnBoardRequiredFieldsQuery::create()
                            ->filterByOrgUnitId($_POST['OrgUnitId'])
                            ->filterByOutletTypeId($_POST['OutletTypeId'])
                            ->filterByStatusTypeId($_POST['StatusTypeId'])
                            ->find()->count();
                        if ($onboardReqFields > 0) {
                            $this->app->Session()->setFlash("error", "This value is already in the list.!!");
                            $f->val($_POST);
                            $this->data['form'] = $f->html();
                            $this->app->Renderer()->render("fsm/territories.twig", $this->data);
                            return;
                        }
                    }
                    $onBoardRequiredFields->fromArray($_POST);
                    $onBoardRequiredFields->setCompanyId($this->app->Auth()->CompanyId());
                    $onBoardRequiredFields->save();
                    $this->runModalScript("loadGrid()");
                    return;
                }
                $this->data['form'] = $f->html();
                $this->app->Renderer()->render("fsm/territories.twig", $this->data);
                break;
        endswitch;
    }
}
