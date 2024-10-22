<?php

declare(strict_types=1);

namespace Modules\Outlets\Controllers;

use App\System\App;
use App\Utils\OTPGenerator;
use App\Utils\SendSms;
use BI\manager\OrgManager;
use entities\AttendanceQuery;
use entities\BrandCampiagnVisitQuery;
use entities\DailycallsQuery;
use entities\DarViewQuery;
use entities\EmployeeQuery;
use entities\LeavesQuery;
use entities\OutletAccountDetailsQuery;
use entities\OutletCheckinMedia;
use entities\OutletsQuery;
use entities\OutletTypeQuery;
use entities\OutletViewQuery;
use entities\OutletVisitsViewQuery;
use entities\VisitPlanQuery;
use Exception;
use Modules\ESS\Runtime\EssHelper;
use Propel\Runtime\ActiveQuery\Criteria;
use Respect\Validation\Validator as v;

class API extends \App\Core\BaseController
{

    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
        //$this->app->logger()->info($this->app->Request()->getUri(),["Param" => $this->app->Request()->getParameters(),"Header" => $this->app->Request()->getBodyParameters()]);
    }

    /**
     * @OA\Get(
     *     path="/api/getOutletTypes",
     *     tags={"Outlet API's"},
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
    public function getOutletTypes()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $orgUniId = $this->app->Auth()->getUser()->getEmployee()->getOrgUnitId();

                $outletTypes = OutletTypeQuery::create()->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())->find()->toArray();
                $totalIds = [];
                foreach ($outletTypes as $outletType){
                    $orgUnitIds = $outletType['OrgUnitId'];
                    if ($orgUnitIds === null) {
                        continue;
                    }
                    $totalOrgUnitIds = explode(",",$orgUnitIds);

                    foreach ($totalOrgUnitIds as $org){
                        if ($org==$orgUniId){
                            $totalIds[] = $outletType['OutlettypeId'];
                        }
                    }
                }
                $categories = OutletTypeQuery::create()
                    ->filterByOutlettypeId($totalIds)
                    ->findByCompanyId($this->app->Auth()->CompanyId())
                    ->toArray();
                $this->apiResponse($categories, 200, "Get all outlet types successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getAllOutlet",
     *     tags={"Outlet API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get all outlet successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getAllOutlet()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $emp = $this->app->Auth()->getUser()->getEmployee();
                $companyId = $this->app->Auth()->CompanyId();

                $outlets = \entities\OutletsQuery::create()
                    ->joinWithClassification()
                    ->filterByTerritoryId($emp->getTerritoryId())
                    ->filterByCompanyId($companyId)
                    ->find()->toArray();

                $this->apiResponse($outlets, 200, "Get all outlet successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getParentOutlets",
     *     tags={"Outlet API's"},
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
     *         description="Territory Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_type_id",
     *         in="query",
     *         description="Outlet Type Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get parent outlets successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getParentOutlets()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $territoryId = (int)$this->app->Request()->getParameter("territory_id");
                $outletTypeId = (int)$this->app->Request()->getParameter("outlet_type_id");

                $outlettype = \entities\OutletTypeQuery::create()
                    ->filterByOutletTypeId($outletTypeId)
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->findOne();

                $outlets = \entities\OutletsQuery::create()
                    ->joinWithClassification()
                    ->filterByTerritoryId($territoryId)
                    ->filterByOutlettypeId($outlettype->getOutletParent())
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->orderByOutletName(\Propel\Runtime\ActiveQuery\ModelCriteria::ASC)
                    ->find()->toArray();

                $this->apiResponse($outlets, 200, "Get parent outlets successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getDefaultParentOutlets",
     *     tags={"Outlet API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_id",
     *         in="query",
     *         description="Outlet Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get default parent outlets successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getDefaultParentOutlets()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $outletId = (int)$this->app->Request()->getParameter("outlet_id");
                $mapping = \entities\OutletMappingQuery::create()
                    ->filterBySecondaryOutletId($outletId)
                    ->filterByIsdefault(1)
                    ->findOne();
                if ($mapping != null) {
                    $outlets = \entities\OutletsQuery::create()
                        ->joinWithClassification()
                        ->filterById($mapping->getPrimaryOutletId())
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->find()->toArray();
                    if (count($outlets) > 0) {
                        $this->apiResponse($outlets, 200, "Get default parent outlets successfully!");
                    } else {
                        $this->apiResponse([], 400, "Get default parent outlets successfully!");
                    }
                } else {
                    $this->apiResponse([], 400, "Outlets mapping not found!");
                }

                break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/createOutlet",
     *     tags={"Outlet API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *          required=true,
     *          description="Create Outlet",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="outlet_name",
     *                  type="string",
     *                  format="string",
     *                  example="Archisys"
     *              ),
     *              @OA\Property(
     *                  property="outlet_code",
     *                  type="string",
     *                  format="string",
     *                  example="VG#000001"
     *              ),
     *              @OA\Property(
     *                  property="outlet_salutation",
     *                  type="string",
     *                  format="string",
     *                  example="MR."
     *              ),
     *              @OA\Property(
     *                  property="outlet_opening_date",
     *                  type="string",
     *                  format="string",
     *                  example="2022-05-09"
     *              ),
     *              @OA\Property(
     *                  property="outlet_contact_name",
     *                  type="string",
     *                  format="string",
     *                  example="Chintan"
     *              ),
     *              @OA\Property(
     *                  property="outlet_classification_id",
     *                  type="string",
     *                  format="string",
     *                  example="A+"
     *              ),
     *              @OA\Property(
     *                  property="outlet_contact_no",
     *                  type="string",
     *                  format="string",
     *                  example="9874563210"
     *              ),
     *              @OA\Property(
     *                  property="outlet_landlineno",
     *                  type="string",
     *                  format="string",
     *                  example="079235636"
     *              ),
     *              @OA\Property(
     *                  property="outlet_alt_contact_no",
     *                  type="string",
     *                  format="string",
     *                  example="9874563210"
     *              ),
     *               @OA\Property(
     *                  property="outlet_alt_landlineno",
     *                  type="string",
     *                  format="string",
     *                  example="079235636"
     *              ),
     *              @OA\Property(
     *                  property="outlet_address",
     *                  type="text",
     *                  format="text",
     *                  example="101-Shitalnath, Vikas gruhghar road, Pladi, 380007, Ahmedabad"
     *              ),
     *              @OA\Property(
     *                  property="outlet_street_name",
     *                  type="string",
     *                  format="string",
     *                  example="101-Shitalnath, Vikas gruhghar road, Pladi, 380007, Ahmedabad"
     *              ),
     *              @OA\Property(
     *                  property="outlet_city",
     *                  type="string",
     *                  format="string",
     *                  example="Ahmedabad"
     *              ),
     *              @OA\Property(
     *                  property="outlet_state",
     *                  type="string",
     *                  format="string",
     *                  example="Gujarat"
     *              ),
     *              @OA\Property(
     *                  property="outlet_country",
     *                  type="string",
     *                  format="string",
     *                  example="India"
     *              ),
     *              @OA\Property(
     *                  property="outlet_pincode",
     *                  type="string",
     *                  format="string",
     *                  example="380007"
     *              ),
     *              @OA\Property(
     *                  property="outlet_email",
     *                  type="string",
     *                  format="string",
     *                  example="archisys@archisys.in"
     *              ),
     *              @OA\Property(
     *                  property="outlet_contact_bday",
     *                  type="string",
     *                  format="string",
     *                  example="1996-05-02"
     *              ),
     *              @OA\Property(
     *                  property="outlet_contact_anniversary",
     *                  type="string",
     *                  format="string",
     *                  example="2019-03-26"
     *              ),
     *              @OA\Property(
     *                  property="outlet_gps",
     *                  type="string",
     *                  format="string",
     *                  example="23.013054,72.562515"
     *              ),
     *              @OA\Property(
     *                  property="territory_id",
     *                  type="number",
     *                  format="number",
     *                  example="1"
     *              ),
     *              @OA\Property(
     *                  property="outlet_type_id",
     *                  type="number",
     *                  format="number",
     *                  example="2"
     *              ),
     *              @OA\Property(
     *                  property="parent_outlet_id",
     *                  type="number",
     *                  format="number",
     *                  example="6"
     *              ),
     *              @OA\Property(
     *                  property="beats_id",
     *                  type="string",
     *                  format="string",
     *                  example="3,4,5"
     *              ),
     *              @OA\Property(
     *                  property="otp_request_id",
     *                  type="string",
     *                  format="string",
     *                  example="1"
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="ResponseObj",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function createOutlet()
    {
        switch ($this->app->Request()->getMethod()):
            case "POST":
                $outletName = $this->app->Request()->getParameter("outlet_name");
                $outletCode = $this->app->Request()->getParameter("outlet_code");
                $outletSalutation = $this->app->Request()->getParameter("outlet_salutation");
                $outletOpeningDate = $this->app->Request()->getParameter("outlet_opening_date");
                $outletContactName = $this->app->Request()->getParameter("outlet_contact_name");
                $outletClassification = $this->app->Request()->getParameter("outlet_classification_id");
                $outletContactNo = $this->app->Request()->getParameter("outlet_contact_no");
                $outletLandlineno = $this->app->Request()->getParameter("outlet_landlineno");
                $outletAltContactNo = $this->app->Request()->getParameter("outlet_alt_contact_no");
                $outletAltLandlineno = $this->app->Request()->getParameter("outlet_alt_landlineno");
                $outletAddress = $this->app->Request()->getParameter("outlet_address");
                $outletStreetName = $this->app->Request()->getParameter("outlet_street_name");
                $outletCity = $this->app->Request()->getParameter("outlet_city");
                $outletState = $this->app->Request()->getParameter("outlet_state");
                $outletCountry = $this->app->Request()->getParameter("outlet_country");
                $outletPincode = $this->app->Request()->getParameter("outlet_pincode");
                $outletEmail = $this->app->Request()->getParameter("outlet_email");
                $outletContactBday = $this->app->Request()->getParameter("outlet_contact_bday");
                $outletContactAnniversary = $this->app->Request()->getParameter("outlet_contact_anniversary");
                $outletGps = $this->app->Request()->getParameter("outlet_gps");
                $territoryId = $this->app->Request()->getParameter("territory_id");
                $outlettypeId = $this->app->Request()->getParameter("outlet_type_id");
                $parentOutletId = $this->app->Request()->getParameter("parent_outlet_id");
                $beatsId = $this->app->Request()->getParameter("beats_id");
                $OtpRequestId = $this->app->Request()->getParameter("otp_request_id");
                $employee = $this->app->Auth()->getUser()->getEmployee();

                if ($outletCode == '' && $outletCode == null) {
                    $outletCode = substr(str_shuffle("0123456789"), 0, 6);
                } else {
                    $outletCode = $outletCode;
                }
                try {
                    if ($OtpRequestId != null || $OtpRequestId != '') {
                        $outlet = new \entities\Outlets();
                        $outlet->setOutletName($outletName);
                        $outlet->setOutletCode($outletCode);
                        $outlet->setOutletSalutation($outletSalutation);
                        $outlet->setOutletOpeningDate($outletOpeningDate);
                        $outlet->setOutletContactName($outletContactName);
                        $outlet->setOutletClassification($outletClassification);
                        $outlet->setOutletContactNo($outletContactNo);
                        $outlet->setOutletLandlineno($outletLandlineno);
                        $outlet->setOutletAltContactNo($outletAltContactNo);
                        $outlet->setOutletAltLandlineno($outletAltLandlineno);
                        $outlet->setOutletAddress($outletAddress);
                        $outlet->setOutletStreetName($outletStreetName);
                        $outlet->setOutletCity($outletCity);
                        $outlet->setOutletState($outletState);
                        $outlet->setOutletCountry($outletCountry);
                        $outlet->setOutletPincode($outletPincode);
                        $outlet->setOutletEmail($outletEmail);
                        $outlet->setOutletContactBday($outletContactBday);
                        $outlet->setOutletContactAnniversary($outletContactAnniversary);
                        $outlet->setOutletGps($outletGps);
                        $outlet->setTerritoryId($territoryId);
                        $outlet->setOutlettypeId($outlettypeId);
                        $outlet->setCompanyId($employee->getCompanyId());
                        $outlet->setOutletCreatedBy($employee->getEmployeeId());
                        $outlet->setOutletStatus('inactive');
                        if ($OtpRequestId != null && $OtpRequestId != '') {
                            $otpRequest = \entities\OtpRequestsQuery::create()
                                ->filterByOtpreqid($OtpRequestId)
                                ->findOne();
                            if ($otpRequest->getOtpVerified() == 1) {
                                $outlet->setOutletOtp($OtpRequestId);
                                $outlet->setOutletVerified(true);
                                $outlet->save();
                            } else {
                                $this->apiResponse([], 400, "OTP request not verified!");
                            }
                        } else {
                            $this->apiResponse([], 400, "OTP request id not found!");
                        }
                        if ($outlet) {

                            $parentOutletAccount = OutletAccountDetailsQuery::create()->findByOutletId($parentOutletId)->getFirst();

                            $outletmapping = new \entities\OutletMapping();
                            $outletmapping->setPrimaryOutletId($parentOutletId);
                            $outletmapping->setSecondaryOutletId($outlet->getId());
                            $outletmapping->setIsdefault(1);
                            if ($parentOutletAccount) {
                                $outletmapping->setPricebookId($parentOutletAccount->getOutletDefaultPricebook());
                                $outletmapping->setCategoryType($parentOutletAccount->getOutletDefaultCategory());
                            }

                            $outletmapping->save();

                            $beats = explode(',', $beatsId);
                            if (!empty($beats)) {
                                foreach ($beats as $beat) {
                                    $id = (int)$beat;
                                    $addoutlet = new \entities\BeatOutlets();
                                    $addoutlet->setBeatId($id);
                                    $addoutlet->setOutletId($outlet->getId());
                                    $addoutlet->setCompanyId($this->app->Auth()->CompanyId());
                                    $addoutlet->save();
                                }
                            }
                            if ($outlet->getOutletOtp()) {
                                $otpRequest = \entities\OtpRequestsQuery::create()
                                    ->filterByOtpReqId($OtpRequestId)
                                    ->findOne();
                                $otpRequest->setOtpDocId($outlet->getId());
                                $otpRequest->save();
                            } else {
                                $this->apiResponse([], 400, "OTP request not found!");
                            }
                            $data['Outlet'] = $outlet->toArray();
                            $data['OutletClassification'] = \entities\ClassificationQuery::create()
                                ->filterById($outlet->getId())
                                ->find()->toArray();

                            $this->apiResponse($data, 200, "Outlet created successfully.");
                        } else {
                            $this->apiResponse([], 400, "Outlet not found!");
                        }
                    } else {
                        $this->apiResponse([], 400, "OTP request id not found!");
                    }
                } catch (Exception $ex) {
                    $this->apiResponse([], 400, $ex->getMessage());
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getEmployeeBeats",
     *     tags={"Outlet API's"},
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
     *     @OA\Response(
     *         response="200",
     *         description="Get employee beats successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getEmployeeBeats()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $empId = $this->app->Request()->getParameter("employee_id");
                $outletBeats = \entities\BeatsQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->joinWithBeatOutlets()
                    ->filterByEmployeeId($empId)
                    ->find()->toArray();
                $this->apiResponse($outletBeats, 200, "Get employee beats successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getOutletMediaType",
     *     tags={"Outlet API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get employee outlets successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getOutletMediaType()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $outletMediaType['OutletMediaType'] = $this->getConfig("Outlets", "MediaReason");
                $this->apiResponse($outletMediaType, 200, "Get employee outlets successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getEmpOutlets",
     *     tags={"Outlet Verification API's"},
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
     *         description="Employee Id (optional)",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get employee outlets successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getEmpOutlets()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $empID = $this->app->Request()->getParameter("employee_id", $this->app->Auth()->getUser()->getEmployeeId());
                $outletAssignment = \entities\OutletAssignmentQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->filterByEmpId($empID)
                    ->joinWithOutlets()
                    ->joinWithShiftTypes()
                    ->findByCompanyId($this->app->Auth()->CompanyId())->toArray();
                $this->apiResponse($outletAssignment, 200, "Get employee outlets successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getOutletById",
     *     tags={"Outlet API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_id",
     *         in="query",
     *         description="Outlet Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get outlet successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getOutletById()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $OutletId = $this->app->Request()->getParameter("outlet_id");
                $outletCheckInOutHelper = new \Modules\Outlets\Runtime\OutletCheckInOutHelper($this->app);
                try {
                    $resp = $outletCheckInOutHelper->outletDetails($OutletId);
                    $this->apiResponse($resp, 200, "Get outlet successfully!");
                } catch (Exception $ex) {
                    $this->apiResponse([], 400, $ex->getMessage());
                }

                break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/checkin",
     *     tags={"Outlet Verification API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_id",
     *         in="query",
     *         description="Outlet Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="checkin_location",
     *         in="query",
     *         description="Checkin Location Lat Lng",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="checkin_address",
     *         in="query",
     *         description="Location Name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="checkin_time",
     *         in="query",
     *         description="Checkin Time",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="beat_id",
     *         in="query",
     *         description="Beat Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="ResponseObj",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function checkin()
    {
        switch ($this->app->Request()->getMethod()):
            case "POST":
                $empID = $this->app->Auth()->getUser()->getEmployeeId();
                $outletId = $this->app->Request()->getParameter("outlet_id");
                $companyID = $this->app->Auth()->getUser()->getCompanyId();
                $checkin_location = $this->app->Request()->getParameter("checkin_location");
                $checkin_address = $this->app->Request()->getParameter("checkin_address");
                $checkinTime = $this->app->Request()->getParameter("checkin_time");
                $beat_id = $this->app->Request()->getParameter("beat_id");

                $outletCheckInOutHelper = new \Modules\Outlets\Runtime\CheckInHelper($this->app);

                try {
                    $resp = $outletCheckInOutHelper->Check_in($empID, $outletId, $companyID, $checkin_location, $checkin_address, $checkinTime, $beat_id);
                    $this->apiResponse($resp, 200, "Check in Successfully.");
                } catch (\Exception $e) {
                    $this->apiResponse([], 400, $e->getMessage());
                }


                break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/checkout",
     *     tags={"Outlet Verification API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_id",
     *         in="query",
     *         description="Outlet Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="checkout_location",
     *         in="query",
     *         description="Checkin Location Lat Lng",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="checkout_address",
     *         in="query",
     *         description="Location Name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="checkin_out_time",
     *         in="query",
     *         description="Checkin Out Time",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="checkout_outcome_id",
     *         in="query",
     *         description="Checkout Outcome Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="checkout_remark",
     *         in="query",
     *         description="Checkout Remark",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="checkout_media",
     *         in="query",
     *         description="Checkout Media",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="ResponseObj",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function checkout()
    {
        switch ($this->app->Request()->getMethod()):
            case "POST":
                $empID = $this->app->Auth()->getUser()->getEmployeeId();
                $outletId = $this->app->Request()->getParameter("outlet_id");
                $companyID = $this->app->Auth()->getUser()->getCompanyId();
                $checkout_location = $this->app->Request()->getParameter("checkout_location");
                $checkout_address = $this->app->Request()->getParameter("checkout_address");
                $checkinOutTime = $this->app->Request()->getParameter("checkin_out_time");
                $checkout_outcome_id = $this->app->Request()->getParameter("checkout_outcome_id");
                $checkout_remark = $this->app->Request()->getParameter("checkout_remark");
                $checkout_media = $this->app->Request()->getParameter("checkout_media");

                $outletCheckInOutHelper = new \Modules\Outlets\Runtime\CheckInHelper($this->app);

                try {
                    $resp = $outletCheckInOutHelper->Check_out($empID, $outletId, $companyID, $checkout_location, $checkout_address, $checkinOutTime, $checkout_outcome_id, $checkout_remark, $checkout_media);
                    $this->apiResponse($resp, 200, "Check out Successfully.");
                } catch (\Exception $e) {
                    $this->apiResponse([], 400, $e->getMessage());
                }


                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/checkInOutStatus",
     *     tags={"Outlet Verification API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="ResponseObj",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function checkInOutStatus()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":

                $empID = $this->app->Auth()->getUser()->getEmployeeId();
                $outletCheckInOutHelper = new \Modules\Outlets\Runtime\CheckInHelper($this->app);

                $resp = $outletCheckInOutHelper->CheckStatusForToday($empID);

                if ($resp->CheckInRec->getCheckInId() != null) {
                    $outletCheckinMedia = \entities\CheckInMediaQuery::create()
                        ->filterByEntityPk($resp->CheckInRec->getCheckInId())
                        ->find()->toArray();
                    $response = ['data' => $resp->toArray(), 'attechment' => $outletCheckinMedia];
                    $this->apiResponse($response, 200, "CheckInOut Status.");
                } else {
                    $this->apiResponse([], 400, "CheckInId not found!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/outletCheckinMedia",
     *     tags={"Outlet Verification API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="checkin_id",
     *         in="query",
     *         description="Outlet Checkin Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="checkin_media_reason",
     *         in="query",
     *         description="Checkin Media Reason",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="checkin_media_id",
     *         in="query",
     *         description="Outlet Media Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="gps_location",
     *         in="query",
     *         description="Cuurent GPS Location",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="ResponseObj",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function outletCheckinMedia()
    {
        switch ($this->app->Request()->getMethod()):
            case "POST":
                $empID = $this->app->Auth()->getUser()->getEmployeeId();
                $checkinId = $this->app->Request()->getParameter("checkin_id");
                $companyID = $this->app->Auth()->getUser()->getCompanyId();
                $checkinMediaReason = $this->app->Request()->getParameter("checkin_media_reason");
                $checkinGpsLocation = $this->app->Request()->getParameter("gps_location");
                $checkinMediaId = $this->app->Request()->getParameter("checkin_media_id");
                try {
                    $checkInMedia = new OutletCheckinMedia();
                    $checkInMedia->setCheckinId($checkinId);
                    $checkInMedia->setMediaReason($checkinMediaReason);
                    $checkInMedia->setMediaId($checkinMediaId);
                    $checkInMedia->setDate(date("Y-m-d"));
                    $checkInMedia->setGpsLocation($checkinGpsLocation);
                    $checkInMedia->setCompanyId($companyID);
                    $checkInMedia->save();
                    $this->apiResponse($checkInMedia->toArray(), 200, "Check in media upload successfully.");
                } catch (\Exception $e) {
                    $this->apiResponse([], 400, $e->getMessage());
                }


                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/search",
     *     tags={"Outlet API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search String",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get search result successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function search()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $employee = $this->app->Auth()->getUser()->getEmployee();
                $employeeId = $this->app->Auth()->getUser()->getEmployeeId();
                $companyId = $this->app->Auth()->getUser()->getCompanyId();

                $search = $this->app->Request()->getParameter("search");
                if ($search != null && $search != '') {
                    if (strlen($search) > 1) {
                        $outlets = \entities\OutletsQuery::create()
                            ->filterByCompanyId($companyId)
                            ->filterByTerritoryId($employee->getTerritoryId())
                            ->filterByOutletName($search . "%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)
                            ->limit(100)
                            ->find()->toArray();
                        // $trips = \entities\TripsQuery::create()
                        //     ->filterByTripOriginName($search . "%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)
                        //     ->_or()
                        //     ->filterByTripDestination($search . "%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)
                        //     ->filterByCompanyId($companyId)
                        //     ->filterByEmployeeId($employeeId)
                        //     ->limit(100)
                        //     ->find()->toArray();
                        $expenses = \entities\ExpensesQuery::create()
                            ->filterByExpensePlacewrk($search . "%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)
                            ->filterByCompanyId($companyId)
                            ->filterByEmployeeId($employeeId)
                            ->limit(100)
                            ->find()->toArray();
                        $products = \entities\ProductsQuery::create()
                            ->filterByProductName($search . "%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)
                            ->filterByCompanyId($companyId)
                            ->limit(100)
                            ->find()->toArray();
                        $tickets = \entities\TicketsQuery::create()
                            ->filterByDescription($search . "%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)
                            ->filterByCompanyId($companyId)
                            ->filterByEmployeeId($employeeId)
                            ->limit(100)
                            ->find()->toArray();
                        $searchMasterResponse = array(
                            "Outlets" => $outlets,
                            //"Trips" => $trips,
                            "Expenses" => $expenses,
                            "Tickets" => $tickets,
                            "Products" => $products
                        );
                        $this->apiResponse($searchMasterResponse, 200, "Get search result successfully!");
                    } else {
                        $this->apiResponse([], 400, "Please Enter Minimum 3 Characters");
                    }
                } else {
                    $this->apiResponse([], 400, "Search not found!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/outletHistory",
     *     tags={"Outlet API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_id",
     *         in="query",
     *         description="Outlet Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get outlet history successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function outletHistory()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $employee = $this->app->Auth()->getUser()->getEmployee();
                $employeeId = $this->app->Auth()->getUser()->getEmployeeId();
                $companyId = $this->app->Auth()->getUser()->getCompanyId();

                $outletId = $this->app->Request()->getParameter("outlet_id");
                if ($outletId != null && $outletId != '') {
                    $history = \entities\OutletCheckinQuery::create()
                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                        ->joinWithEmployeeRelatedByEmpId()
                        ->filterByOutletId($outletId)
                        ->orderByCheckinDate(\Propel\Runtime\ActiveQuery\ModelCriteria::DESC)
                        ->find()
                        ->toArray();
                    if (count($history) > 0) {
                        $this->apiResponse($history, 200, "Get outlet history successfully!");
                    } else {
                        $this->apiResponse([], 400, "Outlet history not found!");
                    }
                } else {
                    $this->apiResponse([], 400, "Outlet not found!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/outletFilter",
     *     tags={"Outlet API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="short_by",
     *         in="query",
     *         description="Short By (1=>A to Z, 2=>Z to A, 3=>Newley Added)",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="classification",
     *         in="query",
     *         description="classification",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get outlet filter successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function outletFilter()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $empID = $this->app->Auth()->getUser()->getEmployeeId();
                $companyId = $this->app->Auth()->CompanyId();
                $shortBy = $this->app->Request()->getParameter("short_by");
                $classification = $this->app->Request()->getParameter("classification");
                if ($shortBy != null) {
                    switch ($shortBy):
                        case "1":
                            $outletAssignment = \entities\OutletAssignmentQuery::create()
                                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                                ->filterByEmpId($empID)
                                ->joinWithOutlets()
                                ->joinWithShiftTypes()
                                ->orderBy('Outlets.OutletName', 'asc')
                                ->findByCompanyId($companyId)->toArray();
                            break;
                        case "2":
                            $outletAssignment = \entities\OutletAssignmentQuery::create()
                                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                                ->filterByEmpId($empID)
                                ->joinWithOutlets()
                                ->joinWithShiftTypes()
                                ->orderBy('Outlets.OutletName', 'desc')
                                ->findByCompanyId($companyId)->toArray();
                            break;
                        case "3":
                            $outletAssignment = \entities\OutletAssignmentQuery::create()
                                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                                ->filterByEmpId($empID)
                                ->joinWithOutlets()
                                ->joinWithShiftTypes()
                                ->orderBy('Outlets.Id', 'desc')
                                ->setLimit(10)
                                ->findByCompanyId($companyId)->toArray();
                            break;
                    endswitch;
                    if (count($outletAssignment) > 0) {
                        $this->apiResponse($outletAssignment, 200, "Get outlet filter successfully!");
                    } else {
                        $this->apiResponse([], 400, "Filter outlet not found!");
                    }
                } else {
                    $outletAssignment = \entities\OutletAssignmentQuery::create()
                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                        ->filterByEmpId($empID)
                        ->joinWithOutlets()
                        ->joinWithShiftTypes()
                        ->useOutletsQuery('O')
                        ->filterBy('OutletClassification', $classification)
                        ->endUse()
                        ->findByCompanyId($companyId)->toArray();
                    if (count($outletAssignment) > 0) {
                        $this->apiResponse($outletAssignment, 200, "Get outlet filter successfully!");
                    } else {
                        $this->apiResponse([], 400, "Filter outlet not found!");
                    }
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getAllOutletOrders",
     *     tags={"Outlet API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_id",
     *         in="query",
     *         description="Outlet Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_type",
     *         in="query",
     *         description="Outlet Type",
     *         @OA\Schema(type="boolean")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get outlet orders successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getAllOutletOrders()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $this->Validate(v::stringVal()->notEmpty()->validate($this->app->Request()->getParameter("outlet_id")), "Please enter the outlet id.", "outlet_id");
                $OutletId = $this->app->Request()->getParameter("outlet_id");
                $OutletType = $this->app->Request()->getParameter("outlet_type");
                $companyId = $this->app->Auth()->CompanyId();

                if ($OutletType === "true") {
                    $orders['Purchase'] = \entities\OrdersQuery::create()
                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                        ->joinWithOutletsRelatedByOutletFrom()
                        ->filterByOutletFrom($OutletId)
                        ->filterByCompanyId($companyId)
                        ->orderByOrderId(Criteria::DESC)
                        ->find()->toArray();
                } else {
                    $orders['Sales'] = \entities\OrdersQuery::create()
                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                        ->joinWithOutletsRelatedByOutletTo()
                        ->filterByOutletTo($OutletId)
                        ->filterByCompanyId($companyId)
                        ->filterByOrderStatus('Completed')
                        ->orderByOrderId(Criteria::DESC)
                        ->find()->toArray();
                }

                if (count($orders) > 0) {
                    $this->apiResponse($orders, 200, "Get outlet orders successfully!");
                } else {
                    $this->apiResponse([], 400, "Outlet order not found!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getOutletOrderFilter",
     *     tags={"Outlet API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_id",
     *         in="query",
     *         description="Outlet Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="order_status",
     *         in="query",
     *         description="Order Status",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_type",
     *         in="query",
     *         description="Outlet Type",
     *         @OA\Schema(type="boolean")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Orders filtered successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getOutletOrderFilter()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $this->Validate(v::stringVal()->notEmpty()->validate($this->app->Request()->getParameter("outlet_id")), "Please enter the outlet id.", "outlet_id");
                $this->Validate(v::stringVal()->notEmpty()->validate($this->app->Request()->getParameter("order_status")), "Please enter the order status.", "order_status");
                $outletId = $this->app->Request()->getParameter("outlet_id");
                $orderStatus = $this->app->Request()->getParameter("order_status");
                $companyId = $this->app->Auth()->CompanyId();
                $OutletType = $this->app->Request()->getParameter("outlet_type");

                if ($OutletType === "true") {
                    $orders['Purchase'] = \entities\OrdersQuery::create()
                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                        ->joinWithOutletsRelatedByOutletFrom()
                        ->filterByOrderStatus($orderStatus)
                        ->filterByOutletFrom($outletId)
                        ->filterByCompanyId($companyId)
                        ->find()->toArray();
                } else {
                    $orders['Sales'] = \entities\OrdersQuery::create()
                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                        ->joinWithOutletsRelatedByOutletTo()
                        ->filterByOrderStatus($orderStatus)
                        ->filterByOutletTo($outletId)
                        ->filterByCompanyId($companyId)
                        ->find()->toArray();
                }


                if (count($orders) > 0) {
                    $this->apiResponse($orders, 200, "Orders filtered successfully!");
                } else {
                    $this->apiResponse([], 400, "Filtered order not found!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getOutletRecentOrders",
     *     tags={"Outlet API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
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
     *         description="Get outlet recent orders successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getOutletRecentOrders()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $this->Validate(v::stringVal()->notEmpty()->validate($this->app->Request()->getParameter("outlet_id")), "Please enter the outlet id.", "outlet_id");
                $outletId = $this->app->Request()->getParameter("outlet_id");
                $companyId = $this->app->Auth()->CompanyId();
                $EmpId = $this->app->Auth()->getUser()->getEmployee()->getEmployeeId();
                
                $orders = \entities\OrdersQuery::create()
                    ->filterByOutletFrom($outletId)
                    ->filterByOrderType('PO')
                    ->filterByCompanyId($companyId)
                    ->filterByEmployeeId($EmpId)
                    ->orderBy('OrderId', 'desc')
                    ->setLimit(5)
                    ->find()->toArray();
                if (count($orders) > 0) {
                    $this->apiResponse($orders, 200, "Get outlet recent orders successfully!");
                } else {
                    $this->apiResponse([], 400, "Recent order not found!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getOrderById",
     *     tags={"Order Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="order_id",
     *         in="query",
     *         description="Order Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get order detail successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getOrderById()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $this->Validate(v::stringVal()->notEmpty()->validate($this->app->Request()->getParameter("order_id")), "Please enter the order id.", "order_id");
                $orderId = $this->app->Request()->getParameter("order_id");
                $companyId = $this->app->Auth()->CompanyId();

                $orders = \entities\OrdersQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->joinWithOutletsRelatedByOutletTo()
                    ->joinWithOrderlines()
                    ->useOrderlinesQuery()
                    ->joinWithProducts()
                    ->endUse()
                    ->filterByOrderId($orderId)
                    ->filterByCompanyId($companyId)
                    ->find()->toArray();
                if (count($orders) > 0) {
                    $this->apiResponse($orders, 200, "Get order detail successfully!");
                } else {
                    $this->apiResponse([], 400, "Order not found!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getOrderByIdNew",
     *     tags={"Order Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="order_id",
     *         in="query",
     *         description="Order Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get order detail successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getOrderByIdNew()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $this->Validate(v::stringVal()->notEmpty()->validate($this->app->Request()->getParameter("order_id")), "Please enter the order id.", "order_id");
                $orderId = $this->app->Request()->getParameter("order_id");
                $companyId = $this->app->Auth()->CompanyId();

                $orders = \entities\OrdersQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    //->joinWithOutletsRelatedByOutletTo()
                    ->joinWithOrderlines()
                    ->useOrderlinesQuery()
                        ->joinWithProducts()
                    ->endUse()
                    ->filterByOrderId($orderId)
                    ->filterByCompanyId($companyId)
                    ->find()->getFirst();

                $outletTo = OutletsQuery::create()
                                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                                ->leftJoinWithGeoTowns()
                                ->filterById($orders['OutletTo'])
                                ->find()->toArray();
                $outletFrom = OutletsQuery::create()
                                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                                ->joinWithGeoTowns()
                                ->filterById($orders['OutletFrom'])
                                ->find()->toArray();
                $employee = EmployeeQuery::create()
                                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                                ->filterByEmployeeId($orders['EmployeeId'])
                                ->find()->toArray();


                $res =
                    [
                        "order" => $orders,
                        "outletTo" => $outletTo,
                        "outletFrom" => $outletFrom,
                        "employee" => $employee

                    ];
                $this->apiResponse($res, 200, "Get order detail successfully!");

                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getDailyMtdSales",
     *     tags={"Outlet API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
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
     *         description="Get daily MTD sales successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getDailyMtdSales()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $this->Validate(v::stringVal()->notEmpty()->validate($this->app->Request()->getParameter("outlet_id")), "Please enter the outlet id.", "outlet_id");
                $outletId = $this->app->Request()->getParameter("outlet_id");
                $companyId = $this->app->Auth()->CompanyId();

                $startDate = date('Y-m-01');
                $endDate = date('Y-m-d');

                $orders = \entities\OrdersQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->filterByOrderDate($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByOrderDate($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->filterByOutletFrom($outletId)
                    ->filterByCompanyId($companyId)
                    ->filterByOrderType('PO')
                    ->joinWithOrderlines()
                    ->find()->toArray();
                if (count($orders) > 0) {
                    $orderTotal = 0;
                    $orderTotalQty = 0;
                    $tls = 0;
                    $orderLineItemArray = array();
                    foreach ($orders as $order) {
                        if ($order['OrderTotal'] != null) {
                            $orderTotal += $order['OrderTotal'];
                            $orderTotalQty += $order['OrderQty'];
                            foreach ($order['Orderliness'] as $orderline) {
                                $productIds = $orderline['ProductId'];
                                array_push($orderLineItemArray, $productIds);
                            }
                        }
                    }
                    $tls = count(array_unique($orderLineItemArray));
                    $data = array(
                        'TotalOrderValue' => $orderTotal,
                        'TotalOrderQty' => $orderTotalQty,
                        'TLS' => $tls,
                    );
                    $this->apiResponse($data, 200, "Get daily MTD sales successfully!");
                } else {
                    $this->apiResponse([], 400, "Order not found!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getLastThreeMonthOrder",
     *     tags={"Outlet API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
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
     *         description="Get daily MTD sales successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getLastThreeMonthOrder()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $this->Validate(v::stringVal()->notEmpty()->validate($this->app->Request()->getParameter("outlet_id")), "Please enter the outlet id.", "outlet_id");
                $outletId = $this->app->Request()->getParameter("outlet_id");
                $companyId = $this->app->Auth()->CompanyId();

                $startDate = date('Y-m-d');
                $endDate = date('Y-m-d', strtotime('-3 month'));

                $orders = \entities\OrdersQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->filterByOrderDate($endDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByOrderDate($startDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->filterByOutletFrom($outletId)
                    ->filterByCompanyId($companyId)
                    ->filterByOrderType('PO')
                    ->joinWithOrderlines()
                    ->find()->toArray();
                if (count($orders) > 0) {
                    $orderTotal = 0;
                    $orderTotalQty = 0;
                    $tls = 0;
                    $orderLineItemArray = array();
                    foreach ($orders as $order) {
                        if ($order['OrderTotal'] != null) {
                            $orderTotal += $order['OrderTotal'];
                            $orderTotalQty += $order['OrderQty'];
                            foreach ($order['Orderliness'] as $orderline) {
                                $productIds = $orderline['ProductId'];
                                array_push($orderLineItemArray, $productIds);
                            }
                        }
                    }
                    $tls = count(array_unique($orderLineItemArray));
                    $data = array(
                        'TotalOrderValue' => round($orderTotal / 3, 2),
                        'TotalOrderQty' => round($orderTotalQty / 3, 2),
                        'TLS' => round($tls / 3, 2),
                    );
                    $this->apiResponse($data, 200, "Get daily MTD sales successfully!");
                } else {
                    $this->apiResponse([], 400, "Order not found!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getCompetitors",
     *     tags={"Catalogue API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get all competitor successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function getCompetitors()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $competitors = \entities\CompetitorQuery::create()
                    ->findByCompanyId($this->app->Auth()->CompanyId())
                    ->toArray();
                if (count($competitors) > 0) {
                    $this->apiResponse($competitors, 200, "Get all competitor successfully!");
                } else {
                    $this->apiResponse([], 404, "Competitors not found!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getOutletOutcomes",
     *     tags={"Outlet API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get all outlet outcomes successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getOutletOutcomes()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $outcomes = \entities\CheckinoutOutcomesQuery::create()
                    ->findByCompanyId($this->app->Auth()->CompanyId())
                    ->toArray();
                $this->apiResponse($outcomes, 200, "Get all outlet outcomes successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getClassifications",
     *     tags={"Outlet API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get all outlet classification successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getClassifications()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $orgUnitId = $this->app->Auth()->getUser()->getEmployee()->getOrgUnitId();
                $classifications = \entities\ClassificationQuery::create()
                    ->filterByOrgunitid($orgUnitId)
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->find()
                    ->toArray();
                $this->apiResponse($classifications, 200, "Get all outlet classification successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getLastLocation",
     *     tags={"Outlet API's"},
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
     *     @OA\Response(
     *         response="200",
     *         description="Get all outlet classification successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getLastLocation()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $employeeId = $this->app->Request()->getParameter("employee_id");

                $outletCheckInOut = \entities\OutletCheckinQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->joinWithOutlets()
                    ->filterByEmpId($employeeId)
                    ->orderByCheckinDate(\Propel\Runtime\ActiveQuery\Criteria::DESC)
                    ->limit(1)
                    ->find()->toArray();

                $this->apiResponse($outletCheckInOut, 200, "Get all outlet classification successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getActivityKpis",
     *     tags={"Outlet API's"},
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
     *         description="Position Id / Optional",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="type",
     *         in="query",
     *         description="1 = Normal - Default, 2 = Vacant, 3 - New Joinee",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="rollup",
     *         in="query",
     *         description="0 = No - Default, 1 = Yes",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="moye",
     *         in="query",
     *         description="Month-Year / Optional",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="tag",
     *         in="query",
     *         description="Tag",
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Response(
     *         response="200",
     *         description="Get all outlet classification successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getActivityKpis()
    {

        switch ($this->app->Request()->getMethod()):
            case "GET":
                $positionid = $this->app->Request()->getParameter("position_id", null);
                $rollup = $this->app->Request()->getParameter("rollup", 0);
                $type = $this->app->Request()->getParameter("type", "1");
                $tag = $this->app->Request()->getParameter("tag", "");

                if ($positionid == null) {
                    $positionid = $this->app->Auth()->getUser()->getEmployee()->getPositionId();
                }

                $emp = EmployeeQuery::create()->filterByPositionId($positionid)->filterByStatus(1)->findOne();

                if ($emp == null) {
                    $this->apiResponse([], 400, "Employee not found");
                    return;
                }

                $moye = $this->app->Request()->getParameter("moye", date("m-Y"));

                $terr = [];

                switch ($type):
                    case "1":
                        $terr = OrgManager::getMyTerritoriesByPosition($positionid);
                        break;
                    case "2":
                        $terr = OrgManager::getMyTerritoriesByPositionVacant($positionid);
                        break;
                    case "3":
                        $terr = OrgManager::getMyTerritoriesByPositionNewJoines($positionid);
                        break;
                endswitch;

                if($tag != null || $tag != ''){
                    $outlets = OutletViewQuery::create()
                    ->withColumn('SUM(visit_fq)', 'VisitFq')
                    ->withColumn('COUNT(*)', 'Count')
                    ->select(["Count", "VisitFq"])->filterByTerritoryId($terr)
                    ->filterByOutlettypeName("Doctor")
                    ->filterByTags($tag, Criteria::LIKE)
                    ->find()->toArray();
                }else{
                    $outlets = OutletViewQuery::create()
                    ->withColumn('SUM(visit_fq)', 'VisitFq')
                    ->withColumn('COUNT(*)', 'Count')
                    ->select(["Count", "VisitFq"])->filterByTerritoryId($terr)
                    ->filterByOutlettypeName("Doctor")
                    ->find()->toArray();
                }


                $totalOutlets = 0;
                $totalVfq = 0;
                if (count($outlets) > 0) {

                    $totalOutlets = $outlets[0]['Count'];
                    $totalVfq = $outlets[0]['VisitFq'];
                }
                //$imp = array(implode(',', $terr));

                $visitQuery = OutletVisitsViewQuery::create()
                    ->filterByTerritoryId($terr)
                    ->filterByOutlettypeName("Doctor")
                    ->filterByMoye($moye);
                if ($rollup == 0) {
                    $visitQuery->filterByPositionId($positionid)->filterByEmployeeId($emp->getEmployeeId()); // Only me
                } else {
                    $visitQuery->filterByIncharge(1); // Direct incharges only
                }
                $visits = $visitQuery->find();

                //$dates = EssHelper::getDatesMoye($moye);
                list($month, $year) = explode('-', $moye);

                $startDay = 1;
                $endDay = date('t', strtotime("$year-$month-$startDay")); // Get the last day of the month

                $dateArray = [];

                for ($day = $startDay; $day <= $endDay; $day++) {
                    $dateArray[] = sprintf('%04d-%02d-%02d', $year, $month, $day);
                }


                $month = explode('-', $moye);
                $startDate = $month[1] . '-' . $month[0] . '-' . '01';
                $endDate = date($month[1] . '-' . $month[0] . '-' . 't');


                $nca = 0;
                $fw = 0;

                $holidaydate = [];
                $holidays = \entities\HolidaysQuery::create()
                    ->filterByIstateid($this->app->Auth()->getUser()->getEmployee()->getBranch()->getIstateid())
                    ->filterByHolidayDate($startDate, Criteria::GREATER_EQUAL)
                    ->filterByHolidayDate($endDate, Criteria::LESS_EQUAL)
                    ->findByCompanyId($this->app->Auth()->CompanyId());
                foreach ($holidays as $holiday) {
                    $holidaydate[] = $holiday->getHolidayDate()->format('Y-m-d');
                }


                // 1 day = 24 hours
                // 24 * 60 * 60 = 86400 seconds


                // $myCalls = DarViewQuery::create()
                // ->select(['count'])
                // ->withColumn('Count(*)', 'count')
                // ->filterByPositionId($positionid)
                // ->filterByDcrDate($dateArray)
                // ->filterByAgendacontroltype("FW")                
                // ->filterByOutlettypeName('Doctor')
                // ->findOne();

                foreach ($dateArray as $date) {
                    $employeeLeave = LeavesQuery::create()
                        ->filterByEmployeeId($emp->getEmployeeId())
                        ->filterByLeaveDate($date)
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->find();

                    if (count($employeeLeave) > 0) {
                        continue;
                    }

                    if (in_array($date, $holidaydate)) {
                        continue;
                    }
                    $dayOfWeek = date('N', strtotime($date));

                    if ($dayOfWeek == 7) {
                        continue;
                    }
                    $fwdailyCalls = DailycallsQuery::create()
                        ->select(['agendacontroltype'])
                        ->withColumn('Count(*)', 'count')
                        ->filterByPositionId($positionid)
                        ->filterByDcrDate($date)
                        ->filterByAgendacontroltype("FW")
                        ->groupByAgendacontroltype()
                        ->findOne();

                    $NCAdailyCalls = DailycallsQuery::create()
                        ->select(['agendacontroltype'])
                        ->withColumn('Count(*)', 'count')
                        ->filterByPositionId($positionid)
                        ->filterByDcrDate($date)
                        ->filterByAgendacontroltype("NCA")
                        ->groupByAgendacontroltype()
                        ->findOne();


                    if ($fwdailyCalls != null && $NCAdailyCalls != null) {
                        $fw += 0.5;
                        $nca += 0.5;
                    } 
                    elseif ($fwdailyCalls != null && $NCAdailyCalls == null) {
                        $fw += 1;
                    } 
                    elseif ($fwdailyCalls == null && $NCAdailyCalls != null) {
                        $nca += 1;
                    }

                    //            var_dump($i);


                }

                // $attendanceDays = AttendanceQuery::create()
                //     ->filterByEmployeeId($emp->getPrimaryKey())
                //     ->filterByAttendanceDate($dates[0], Criteria::GREATER_EQUAL)
                //     ->filterByAttendanceDate($dates[1], Criteria::LESS_EQUAL)
                //     ->filterByStatus(1)
                //     ->find()->count();

                $vfVisits = 0;
                $rcpaDone = 0;
                $totalVisits = 0;
                $totalCals = 0;

                foreach ($visits as $v) {
                    $totalVisits = $totalVisits + 1;
                    $totalCals = $totalCals + $v->getVisits();
                    $vfVisits = $vfVisits + $v->getVfcovered();
                    if ($v->getRcpaDone() > 0) {
                        $rcpaDone = $rcpaDone + 1;
                    }

                    unset($v);
                }
                unset($visits);

                $resp = [
                    "TotalOutlets" => $totalOutlets,
                    "OutletsCovered" => $totalVisits,
                    "TotalVfq" => $totalVfq,
                    "VfCoverage" => $vfVisits,
                    "RcpaDone" => $rcpaDone,
                    "TotalCalls" => $totalCals,
                    "AttendanceDays" => $fw,
                    "Territories" => $terr
                ];

                $this->apiResponse($resp, 200, "Get all outlet classification successfully!");
                break;
        endswitch;
    }



    /**
     * @OA\Get(
     *     path="/api/getTopBrands",
     *     tags={"Outlet API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_org_id",
     *         in="query",
     *         description="Outlet Org Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get all outlet classification successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getTopBrands()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $outlet_org_id = $this->app->Request()->getParameter("outlet_org_id");

                $from_date = date('Y-m-d', strtotime("-90 days"));
                $currentMonth = date('m-Y');
                $pastMonth1 = date('m-Y', strtotime('-1 month'));
                $pastMonth2 = date('m-Y', strtotime('-2 months'));
                $months[] = $currentMonth;
                $months[] = $pastMonth1;
                $months[] = $pastMonth2;


                $topBrands = \entities\RcpaSummaryQuery::create()
                    ->withColumn("sum(Own)", "Total")
                    ->select(["BrandName", "RcpaMoye", "Total"])
                    ->filterByOutletOrgId($outlet_org_id)
                    ->filterByRcpaMoye($months)
                    //->filterByOrgunitid($orgunit)
                    ->groupByBrandName()
                    ->groupByRcpaMoye()
                    ->orderBy("Total", Criteria::DESC)
                    ->limit(25)
                    ->find()->toArray();



                $response = [];

                foreach ($topBrands as $tb) {
                    $brandName = $tb['BrandName'];
                    if (!isset($response[$brandName])) {
                        $response[$brandName] = [];
                    }
                }


                foreach ($topBrands as $tb) {
                    $brandName = $tb['BrandName'];
                    $month = $tb['RcpaMoye'];
                    $total = round(intval($tb['Total']));

                    // Check if brand name exists in the response array (initialized above)
                    if (isset($response[$brandName])) {
                        $entry = [
                            $month => $total
                        ];
                        $response[$brandName][] = $entry;
                    }
                }



                // Fill in missing months with default values

                foreach ($response as &$brandData) {
                    foreach ($months as $month) {
                        $found = false;
                        foreach ($brandData as $entry) {
                            if (isset($entry[$month])) {
                                $found = true;
                                break;
                            }
                        }
                        if (!$found) {
                            $brandData[] = [
                                $month => 0
                            ];
                        }
                    }
                    //                    var_dump($brandData);

                    // Sort the data by month
                    usort($brandData, function ($a, $b) {
                        return key($b) <=> key($a);
                    });
                }



                if (count($response) > 0) {
                    $this->apiResponse($response, 200, "Get top brands successfully!");
                } else {
                    $this->apiResponse([], 400, "Get top brands not found!");
                }


                /*if ($topBrands != null) {
                    $response = [];
                    foreach ($topBrands as $tb) {

                        $total = round(intval($tb['Total']));
                        if (!isset($response[$tb['BrandName']])) {
                            $response[$tb['BrandName']] = [];
                        }
                        if (!isset($tb['BrandName'][$tb['RcpaMoye']])) {
                            array_push($response[$tb['BrandName']], [$tb['RcpaMoye'] => round($total)]);
                        }


                    }


                    $this->apiResponse($response, 200, "Get top brands successfully!");
                } else {
                    $this->apiResponse([], 400, "Get top brands not found!");
                }*/

                break;
        endswitch;
    }


    /**
     * @OA\Get(
     *     path="/api/getManagerActivityKpis",
     *     tags={"Outlet API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get all outlet classification successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getManagerActivityKpis()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $positionid = $this->app->Request()->getParameter("position_id", null);

                if ($positionid == null) {
                    $positionid = $this->app->Auth()->getUser()->getEmployee()->getPositionId();
                }

                $moye0 = date("m-Y");
                $moye1 = date('Y-m-d', strtotime("-30 days"));
                $moye2 = date('Y-m-d', strtotime("-60 days"));
                $moye3 = date('Y-m-d', strtotime("-90 days"));

                // 4 MONTHS OF DATES
                $moye = [$moye0, $moye1, $moye2, $moye3];

                $terr = OrgManager::getMyTerritoriesByPosition($positionid);

                $outlets = OutletViewQuery::create()
                    ->withColumn('SUM(visit_fq)', 'VisitFq')
                    ->withColumn('COUNT(*)', 'Count')
                    ->select(["Count", "VisitFq"])->filterByTerritoryId($terr)
                    ->find()->toArray();

                $totalOutlets = 0;
                $totalVfq = 0;
                if (count($outlets) > 0) {

                    $totalOutlets = $outlets[0]['Count'];
                    $totalVfq = $outlets[0]['VisitFq'];
                }
                $visits = OutletVisitsViewQuery::create()
                    ->filterByTerritoryId($terr)
                    ->filterByMoye($moye)
                    ->find();
                $vfVisits = 0;
                $rcpaDone = 0;
                $totalVisits = 0;

                foreach ($visits as $v) {
                    $totalVisits = $totalVisits + 1;
                    $vfVisits = $vfVisits + $v->getVfcovered();
                    $rcpaDone = $rcpaDone + $v->getRcpaDone();
                    unset($v);
                }
                unset($visits);

                $resp = [
                    "TotalOutlets" => $totalOutlets,
                    "OutletsCovered" => $totalVisits / 4,
                    "TotalVfq" => $totalVfq / 4,
                    "VfCoverage" => $vfVisits / 4,
                    "RcpaDone" => $rcpaDone / 4,
                    "Territories" => $terr
                ];

                $this->apiResponse($resp, 200, "Get all managet kpis 4 Month Duration !");
                break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/validateOutlet",
     *     tags={"Outlet API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="firstname",
     *         in="query",
     *         description="First Name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="lastname",
     *         in="query",
     *         description="Last Name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="phoneNo",
     *         in="query",
     *         description="Phone No",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="Email Address",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="regNo",
     *         in="query",
     *         description="Medical License Address",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Outlet found!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Outelet not found!",
     *     ),
     * )
     */
    public function validateOutlet()
    {
        switch ($this->app->Request()->getMethod()):
            case "POST":
                $firstname = $this->app->Request()->getParameter("firstname", null);
                $lastname = $this->app->Request()->getParameter("lastname", null);
                $phoneNo = $this->app->Request()->getParameter("phoneNo", null);
                $email = $this->app->Request()->getParameter("email", null);
                $regNo = $this->app->Request()->getParameter("regNo", null);

                $name = $firstname . ' ' . $lastname;
                $conditions = ['cond1', 'cond2'];

                $outelet = OutletsQuery::create()
                    ->condition('cond1', 'LOWER(Outlets.OutletName) like ?', strtolower($name) . "%")
                    ->condition('cond2', 'Outlets.OutletContactNo = ?', $phoneNo);

                if (!empty($email)) {
                    $outelet->condition('cond3', 'LOWER(Outlets.OutletEmail) = ?', strtolower($email));
                    $conditions[] = 'cond3';
                }
                if (!empty($regNo)) {
                    $outelet->condition('cond4', 'Outlets.OutletRegno = ?', $regNo);
                    $conditions[] = 'cond4';
                }

                $outelet = $outelet->where($conditions, 'or')
                    ->findByCompanyId($this->app->Auth()->CompanyId())
                    ->toArray();

                if (count($outelet) > 0) {
                    $this->apiResponse(['isOutletExists' => true], 200, "Outlet found!");
                } else {
                    $this->apiResponse(['isOutletExists' => false], 404, "Outelet not found!");
                }
                break;

        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getAllBrand",
     *     tags={"Outlet API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get all brand successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getAllBrand()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $orgUnitId = $this->app->Auth()->getUser()->getEmployee()->getOrgUnitId();
                $brands = \entities\BrandsQuery::create()
                    ->filterByOrgunitid($orgUnitId)
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->find()
                    ->toArray();
                $this->apiResponse($brands, 200, "Get all brand successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getVisitFrequency",
     *     tags={"Outlet API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Visit Frequency successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getVisitFrequency()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $visitFrequency = $this->getConfig("Outlets", "VisitFrequency");
                $this->apiResponse($visitFrequency, 200, "Get Visit Frequency successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getOutletSubType",
     *     tags={"Outlet API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="outlet_type_parent_id",
     *         in="query",
     *         description="Outlet parent id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get outlet sub type successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getOutletSubType()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $parentId = $this->app->Request()->getParameter("outlet_type_parent_id", null);
                $brands = \entities\OutletTypeQuery::create()
                    ->filterByOutletparent($parentId)
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->find()
                    ->toArray();
                $this->apiResponse($brands, 200, "Get outlet sub type successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/onBoardOutlets",
     *     tags={"OnBoard API's"},
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
     *     @OA\Parameter(
     *         name="outlet_type_id",
     *         in="query",
     *         description="Outlet Type Id",
     *         @OA\Schema(type="string")
     *     ),    
     *     @OA\Response(
     *         response="200",
     *         description="Get onBoard request successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function onBoardOutlets()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $employee = $this->app->Auth()->getUser()->getEmployee();
                $status = $this->app->Request()->getParameter("status");
                $outlet_type_id = $this->app->Request()->getParameter("outlet_type_id");

                if ($employee != null) {
                    $positions = OrgManager::getUnderPositions($employee->getPositionId());
                    $positionIds = array_merge($positions, [$employee->getPositionId()]);

                    $oBM = new \BI\manager\OnBoardManager();
                    $result = $oBM->getOnBoardRequestList($positionIds, $status, $outlet_type_id);

                    $this->apiResponse($result, 200, "Get onBoard request successfully!!");
                } else {
                    $this->apiResponse([], 400, "Employee not found!!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/searchExistsOutlet",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="legacy_code",
     *         in="query",
     *         description="Legacy Code",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="phone_no",
     *         in="query",
     *         description="Phone no",
     *         @OA\Schema(type="string")
     *     ),     
     *     @OA\Response(
     *         response="200",
     *         description="Get result successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function searchExistsOutlet()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $legacy_code = $this->app->Request()->getParameter("legacy_code");
                $phone_no = $this->app->Request()->getParameter("phone_no");

                $employee = $this->app->Auth()->getUser()->getEmployee();

                if ($employee != null) {
                    if ($phone_no != null && $phone_no != '' || $legacy_code != '' && $legacy_code != null) {
                        $oBM = new \BI\manager\OnBoardManager();
                        $result = $oBM->checkOutletExists($legacy_code, $phone_no); 

                        
 
                        if (count($result) > 0) {
                            $this->apiResponse($result, 200, "Get result successfully!");
                        } else {
                            $onboardReq = \entities\OnBoardRequestQuery::create()
                                            ->filterByMobile($phone_no)
                                            ->filterByStatus(2,Criteria::LESS_EQUAL)
                                            ->findOne();
                                            
                            if ($onboardReq != null && $onboardReq != '' ) {
                                return $this->apiResponse([], 400, "Already contact number exists!");
                            }else{
                                return $this->apiResponse([], 204, "Result not found!!");
                            }
                        }
                    } else {
                        $this->apiResponse([], 400, "At least one field must be filled out!!");
                    }
                } else {
                    $this->apiResponse([], 400, "Employee not found!!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/searchOutlets",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="legacy_code",
     *         in="query",
     *         description="Legacy Code",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="phone_no",
     *         in="query",
     *         description="Phone no",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="registration_no",
     *         in="query",
     *         description="Registration no",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="Email Address",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="territory_id",
     *         in="query",
     *         description="Territory Id",
     *         @OA\Schema(type="string")
     *     ),       
     *     @OA\Response(
     *         response="200",
     *         description="Get result successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function searchOutlets()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $legacy_code = $this->app->Request()->getParameter("legacy_code");
                $phone_no = $this->app->Request()->getParameter("phone_no");
                $registration_no = $this->app->Request()->getParameter("registration_no");
                $email = $this->app->Request()->getParameter("email");
                $territoryId = $this->app->Request()->getParameter("territory_id");
                $OutletTypeId = $this->app->Request()->getParameter("outlet_type_id");

                $employee = $this->app->Auth()->getUser()->getEmployee();

                if ($employee != null) {
                    if ($phone_no != null && $phone_no != '' || $registration_no != null && $registration_no != '' || $email != null && $email != '' || $legacy_code != '' && $legacy_code != null) {
                        $oBM = new \BI\manager\OnBoardManager();
                        $result = $oBM->checkOutletExists($legacy_code, $phone_no, $email, $registration_no,$OutletTypeId); 
 
                        if (count($result) > 0) {
                            if($territoryId == null && $territoryId == ''){
                                $territory = \entities\TerritoriesQuery::create()
                                            ->filterByPositionId($employee->getPositionId())
                                            ->findOne();
                                if($territory != null and $territory != ''){
                                    $terId = $territory->getTerritoryId();
                                }else{
                                    $terId = null;
                                }
                            }else{
                                $terId = $territoryId;
                            }

                            // Phone validation add
                            $onboardReq = \entities\OnBoardRequestQuery::create()
                                            ->filterByMobile($result[0]['OutletContactNo'])
                                            ->filterByStatus(2,Criteria::LESS_EQUAL)
                                            ->findOne();
                                            
                            if ($onboardReq != null && $onboardReq != '' ) {
                                return $this->apiResponse([], 400, "Already contact number exists!");
                            }
                            
                            if(isset($result[0]['Outlet_Id']) && $result[0]['Outlet_Id'] != null){
                                $reque = \entities\OnBoardRequestQuery::create()
                                            ->filterByOutletId($result[0]['Outlet_Id'])
                                            ->filterByStatus(1)
                                            ->findOne();
                                if($reque == null){
                                    $onBoardReque = new \entities\OnBoardRequest();
                                    $onBoardReque->setOutletId($result[0]['Outlet_Id']);
                                    $onBoardReque->setSalutation($result[0]['OutletSalutation']);
                                    $onBoardReque->setFirstName($result[0]['OutletContactName']);
                                    $onBoardReque->setEmail($result[0]['OutletEmail']);
                                    $onBoardReque->setMobile($result[0]['OutletContactNo']);
                                    $onBoardReque->setDateOfBirth($result[0]['OutletContactBday']);
                                    $onBoardReque->setMaritalStatus($result[0]['OutletMaritalStatus']);
                                    $onBoardReque->setDateOfAnniversary($result[0]['OutletContactAnniversary']);
                                    $onBoardReque->setQualification($result[0]['OutletQualification']);
                                    $onBoardReque->setRegistrationNo($result[0]['OutletRegno']);
                                    $onBoardReque->setProfilePic($result[0]['OutletMediaId']);
                                    $onBoardReque->setStatus(1);
                                    $onBoardReque->setTerritory($terId);
                                    $onBoardReque->setPosition($employee->getPositionId());
                                    $onBoardReque->setCreatedByEmployeeId($employee->getEmployeeId());
                                    $onBoardReque->setCreatedByPositionId($employee->getPositionId());
                                    $onBoardReque->setCompanyId($employee->getCompanyId());
                                    $onBoardReque->setOutletTypeId($result[0]['OutlettypeId']);
                                    $onBoardReque->setOutletName($result[0]['OutletName']);
                                    $onBoardReque->save();

                                    $outletOrgData = \entities\OutletOrgDataQuery::create()
                                                        ->filterByOutletId($result[0]['Outlet_Id'])
                                                        ->filterByOrgUnitId($employee->getOrgUnitId(),Criteria::NOT_EQUAL)
                                                        ->find()->toArray();
                                    if(count($outletOrgData) > 0){
                                        foreach($outletOrgData as $outletAddress){
                                            if(isset($outletAddress['DefaultAddress']) && $outletAddress['DefaultAddress'] != null && $outletAddress['DefaultAddress'] != ''){
                                                $orgDataAddress = \entities\OutletAddressQuery::create()
                                                                ->filterByOutletAddressId($outletAddress['DefaultAddress'])
                                                                ->findOne();
                                            }else{
                                                return $this->apiResponse([], 400, "Address not found.!!");
                                            }
                                            if($orgDataAddress != null && $orgDataAddress != ''){
                                                $outletType = \entities\OutletTypeQuery::create()
                                                        ->filterByOutlettypeName($orgDataAddress->getAddressName())
                                                        ->findOne();
                                            }else{
                                                return $this->apiResponse([], 400, "Address outlet type not found.!!");
                                            }
                                            if($outletAddress['Tags'] != null && $outletAddress['Tags'] != ''){
                                                $tagEx = explode(',',$outletAddress['Tags']);
                                                if(isset($tagEx[0])){
                                                    $tag = \entities\OutletTagsQuery::create()
                                                                ->select(['OutletTagId'])
                                                                ->filterByTagName($tagEx[0])
                                                                ->findOne();
                                                }else{
                                                    $tag = null;
                                                }
                                            }
                                            if($outletAddress['BrandFocus'] != null && $outletAddress['BrandFocus'] != ''){
                                                $brandEx = explode(',',$outletAddress['BrandFocus']);
                                                if(isset($brandEx[0])){
                                                    $brand = \entities\BrandsQuery::create()
                                                                ->select(['BrandId'])
                                                                ->filterByBrandName($brandEx[0])
                                                                ->findOne();
                                                }else{
                                                    $brand = null;
                                                }
                                            }
                                            if(isset($outletAddress['OutletOrgId'])){
                                                $beatOutlet = \entities\BeatOutletsQuery::create()
                                                                ->filterByBeatOrgOutlet($outletAddress['OutletOrgId'])
                                                                ->findOne();
                                            }else{
                                                $beatOutlet = null;
                                            }
                                            
                                            if($beatOutlet != null && $beatOutlet->getBeatId() != null){
                                                $beatId = $beatOutlet->getBeatId();
                                            }else{
                                                $beatId = null;
                                            }
                                            if($orgDataAddress != null && $orgDataAddress->getItownid() != null){
                                                $itownId = $orgDataAddress->getItownid();
                                            }else{
                                                $itownId = null;
                                            }
                                            if($outletType != null && $outletType->getOutlettypeId() != null){
                                                $outletTypeId = $outletType->getOutlettypeId();
                                            }else{
                                                $outletTypeId = null;
                                            }
                                            $requestAddress = new \entities\OnBoardRequestAddress();
                                            $requestAddress->setOutletSubTypeId($outletTypeId);
                                            $requestAddress->setAddress($orgDataAddress->getOutletAddress());
                                            $requestAddress->setLandmark($orgDataAddress->getOutletStreetName());
                                            $requestAddress->setPincode($orgDataAddress->getOutletPincode());
                                            $requestAddress->setPotential($outletAddress['OrgPotential']);
                                            $requestAddress->setVisitFrequency($outletAddress['VisitFq']);
                                            $requestAddress->setOrgUnitId($employee->getOrgUnitId());
                                            $requestAddress->setOnBoardRequestId($onBoardReque->getOnBoardRequestId());
                                            $requestAddress->setCompanyId($employee->getCompanyId());
                                            $requestAddress->setStatus('NewAdded');
                                            $requestAddress->save();
                                        }
                                    }
                                    $this->apiResponse(['OnBoardRequestId' =>$onBoardReque->getOnBoardRequestId()], 200, "Get result successfully!!");
                                }else{
                                    $this->apiResponse(['OnBoardRequestId' =>$reque->getOnBoardRequestId()], 200, "Get result successfully!!");
                                }
                            }else{
                                $this->apiResponse([], 204, "Outlet not found!!");
                            } 
                        } else {
                            $this->apiResponse([], 204, "Result not found!!");
                        }
                    } else {
                        $this->apiResponse([], 400, "At least one field must be filled out!!");
                    }
                } else {
                    $this->apiResponse([], 400, "Employee not found!!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getOutletDetails",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
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
     *         description="Get outlet details successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getOutletDetails()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $outletId = $this->app->Request()->getParameter("outlet_id");

                if ($outletId != null && $outletId != '') {

                    $oBM = new \BI\manager\OnBoardManager();
                    $result = $oBM->getOutletById($outletId);

                    if (count($result) > 0) {
                        $this->apiResponse($result, 200, "Get result successfully!!");
                    } else {
                        $this->apiResponse([], 400, "Result not found!!");
                    }
                } else {
                    $this->apiResponse([], 400, "At least one field must be filled out!!");
                }
                break;
        endswitch;
    }


    /**
     * @OA\Post(
     *     path="/api/addOutletRequest",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="outlet_id",
     *         in="query",
     *         description="Outlet Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_type_id",
     *         in="query",
     *         description="Outlet Type Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="territory_id",
     *         in="query",
     *         description="Territory Id",
     *         @OA\Schema(type="string")
     *     ),   
     *     @OA\Parameter(
     *         name="profile_pic",
     *         in="query",
     *         description="Profile Pic",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="salutation",
     *         in="query",
     *         description="Salutation",
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="first_name",
     *         in="query",
     *         description="First Name",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="last_name",
     *         in="query",
     *         description="Last Name",
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="outlet_name",
     *         in="query",
     *         description="Outlet Name",
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="Email",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="phone_no",
     *         in="query",
     *         description="Contact No.",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="gender",
     *         in="query",
     *         description="Gender",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="date_of_birth",
     *         in="query",
     *         description="Date Of Birth",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="date_of_anniversary",
     *         in="query",
     *         description="Date Of Anniversary",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="registration_no",
     *         in="query",
     *         description="Registration No",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="marital_status",
     *         in="query",
     *         description="Marital Status",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="qualification",
     *         in="query",
     *         description="Qualification",
     *         @OA\Schema(type="string")
     *     ),             
     *     @OA\Response(
     *         response="200",
     *         description="Outlet found!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Outelet not found!",
     *     ),
     * )
     */
    public function addOutletRequest()
    {
        switch ($this->app->Request()->getMethod()):
            case "POST":
                $outlet_id = $this->app->Request()->getParameter("outlet_id");
                $profile_pic = $this->app->Request()->getParameter("profile_pic");
                $salutation = $this->app->Request()->getParameter("salutation");
                $first_name = $this->app->Request()->getParameter("first_name");
                $last_name = $this->app->Request()->getParameter("last_name");
                $outlet_name = $this->app->Request()->getParameter("outlet_name");
                $email = $this->app->Request()->getParameter("email");
                $phone_no = $this->app->Request()->getParameter("phone_no");
                $gender = $this->app->Request()->getParameter("gender");
                $date_of_birth = $this->app->Request()->getParameter("date_of_birth");
                $date_of_anniversary = $this->app->Request()->getParameter("date_of_anniversary");
                $registration_no = $this->app->Request()->getParameter("registration_no");
                $marital_status = $this->app->Request()->getParameter("marital_status");
                $qualification = $this->app->Request()->getParameter("qualification");
                $outlet_type_id = $this->app->Request()->getParameter("outlet_type_id");
                $territoryId = $this->app->Request()->getParameter("territory_id");

                

                $requests = \entities\OnBoardRequestQuery::create()
                                ->filterByMobile($phone_no)
                                ->filterByStatus(1)
                                ->find()->count();
                                
                if($requests > 0){
                    return $this->apiResponse([], 400, "Request contact number already exsist!");
                }

                $employee = $this->app->Auth()->getUser()->getEmployee();
                if($territoryId == null && $territoryId == ''){
                    $territory = \entities\TerritoriesQuery::create()
                                ->filterByPositionId($employee->getPositionId())
                                ->findOne();
                    if($territory != null and $territory != ''){
                        $terId = $territory->getTerritoryId();
                    }else{
                        $terId = null;
                    }
                }else{
                    $terId = $territoryId;
                }
                

                $onBoardRequest = new \BI\requests\OnBoardRequest();
                $onBoardRequest->setOutletId($outlet_id);
                $onBoardRequest->setSalutation($salutation);
                $onBoardRequest->setFirstName($first_name);
                $onBoardRequest->setLastName($last_name);
                $onBoardRequest->setEmail($email);
                $onBoardRequest->setMobile($phone_no);
                $onBoardRequest->setGender($gender);
                $onBoardRequest->setDateOfBirth($date_of_birth);
                $onBoardRequest->setMaritalStatus($marital_status);
                $onBoardRequest->setDateOfAnniversary($date_of_anniversary);
                $onBoardRequest->setQualification($qualification);
                $onBoardRequest->setRegistrationNo($registration_no);
                $onBoardRequest->setProfilePic($profile_pic);
                $onBoardRequest->setStatus(1);
                $onBoardRequest->setTerritory($terId);
                $onBoardRequest->setPosition($employee->getPositionId());
                $onBoardRequest->setCreatedByEmployeeId($employee->getEmployeeId());
                $onBoardRequest->setCreatedByPositionId($employee->getPositionId());
                $onBoardRequest->setCompanyId($employee->getCompanyId());
                $onBoardRequest->setOutletTypeId($outlet_type_id);
                if($outlet_name == '' or $outlet_name==null)
                {
                 $onBoardRequest->setOutletName($first_name);
                }else{
                 $onBoardRequest->setOutletName($outlet_name);
                }
                $oBM = new \BI\manager\OnBoardManager();
                $result = $oBM->createRequest($onBoardRequest);

                $this->apiResponse($result->toArray(), 200, "Request created successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getOutletOrgData",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_id",
     *         in="query",
     *         description="Outlet Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="onboard_request_id",
     *         in="query",
     *         description="OnBoard Request Id",
     *         @OA\Schema(type="string")
     *     ),       
     *     @OA\Response(
     *         response="200",
     *         description="Get outlet org data successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getOutletOrgData()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $outlet_id = $this->app->Request()->getParameter("outlet_id");
                $onboard_request_id = $this->app->Request()->getParameter("onboard_request_id");

                if ($outlet_id != null || $outlet_id != '' || $onboard_request_id != null || $onboard_request_id != '') {

                    $oBM = new \BI\manager\OnBoardManager();
                    if ($outlet_id != null && $outlet_id != '') {
                        $result = $oBM->getOutletOrgDataByOutletId($outlet_id);
                    } else {
                        $result = $oBM->getOnBoardRequestAddress($onboard_request_id);
                    }

                    if (count($result) > 0) {
                        $this->apiResponse($result, 200, "Get outlet organization data successfully!");
                    } else {
                        $this->apiResponse([], 400, "Result not found!!");
                    }
                } else {
                    $this->apiResponse([], 400, "At least one field must be filled out!!");
                }
                break;
        endswitch;
    }


    /**
     * @OA\Get(
     *     path="/api/searchAddress",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="town_id",
     *         in="query",
     *         description="Town Id",
     *         @OA\Schema(type="string")
     *     ),      
     *     @OA\Response(
     *         response="200",
     *         description="Get address successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function searchAddress()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $town = strtolower($this->app->Request()->getParameter("town_id"));
                $search = '%' . strtolower($town) . '%';

                if ($search != null && $search != '') {
                    $address = \entities\GeoCityQuery::create()
                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                        ->leftJoinWithGeoTowns()
                        ->leftJoinWithGeoState()
                        ->leftJoinWithGeoCountry()
                        ->useGeoTownsQuery()
                            ->filterByItownid($town)
                        ->endUse();

                    $result = $address->find()->toArray();

                    if (count($result) > 0) {
                        $this->apiResponse($result, 200, "Get address successfully!");
                    } else {
                        $this->apiResponse([], 400, "Result not found!!");
                    }
                } else {
                    $this->apiResponse([], 400, "At least one field must be filled out!!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getAddressBeats",
     *     tags={"OnBoard API's"},
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
     *         description="Territory Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="town_id",
     *         in="query",
     *         description="Town Id",
     *         @OA\Schema(type="string")
     *     ),       
     *     @OA\Response(
     *         response="200",
     *         description="Get address beats successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getAddressBeats()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $territory_id = $this->app->Request()->getParameter("territory_id");
                $town_id = $this->app->Request()->getParameter("town_id");

                $orgUnit = $this->app->Auth()->getUser()->getEmployee()->getOrgUnitId();

                $empUnderPositions = OrgManager::getUnderPositions($this->app->Auth()->getUser()->getEmployee()->getPositionId());
                if(count($empUnderPositions) == 0){
                    $empUnderPositions = $this->app->Auth()->getUser()->getEmployee()->getPositionId();
                }
                $territories = \entities\TerritoriesQuery::create()
                                ->select(['TerritoryId'])
                                ->filterByPositionId($empUnderPositions)
                                ->find()->toArray(); // changes for vishwash.

                // if($territory_id == null){
                //     if($position->getTerritoryId() != null && $position->getTerritoryId() != ''){
                //         $terId = $position->getTerritoryId();
                //     }else{
                //         $terTown = \entities\TerritoryTownsQuery::create()
                //                         ->filterByItownid($town_id)
                //                         ->findOne();
                //         $terId = $terTown->getTerritoryId();
                //     }
                // }else{
                //     $terId = $territory_id;
                // }

                $beats = \entities\BeatsQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->filterByTerritoryId($territories)
                    ->filterByBeatRemark('deleted',Criteria::NOT_LIKE);
                    if ($town_id != null && $town_id != '') {
                        $beats->filterByItownid($town_id);
                    }
                $beats->filterByOrgUnitId($orgUnit)
                        ->leftJoinWithTerritories()
                        ->leftJoinWithGeoTowns()
                        ->find()->toArray();
                
                if (!empty($beats)) {
                    $data = [];
                    foreach ($beats as $beat) {
                        if (isset($beat['Territories']['TerritoryName'])) {
                            $data[$beat['BeatId']] = [
                                'Beat' => $beat['BeatName'] . ' - ' . $beat['Territories']['TerritoryName'],
                            ];
                        } else {
                            $data[$beat['BeatId']] = [
                                'Beat' => $beat['BeatName'],
                            ];
                        }
                    }
                    if (count($data) > 0) {
                        return $this->apiResponse($data, 200, "Get beats successfully!");
                    } else {
                        return $this->apiResponse([], 400, "Beats not found!!");
                    }
                } else {
                    return $this->apiResponse([], 400, "Beats not found!!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/onBoardStatus",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),      
     *     @OA\Response(
     *         response="200",
     *         description="Get onBoardStatus successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function onBoardStatus()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $status = $this->getConfig("Outlets", "OnBoardStatus");
                $this->apiResponse($status, 200, "Get onBoardStatus successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/addOutletOrgDataRequest",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="on_board_request_id",
     *         in="query",
     *         description="OnBoardRequest Id",
     *         required=true, 
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_sub_type_id",
     *         in="query",
     *         description="Outlet Address Type",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="address",
     *         in="query",
     *         description="Address",
     *         @OA\Schema(type="string")
     *     ),  
     *     @OA\Parameter(
     *         name="landmark",
     *         in="query",
     *         description="Landmark",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="pincode",
     *         in="query",
     *         description="Pincode",
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="town_id",
     *         in="query",
     *         description="Town Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="city_id",
     *         in="query",
     *         description="City Id",
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="state_id",
     *         in="query",
     *         description="State Id",
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="beat_id",
     *         in="query",
     *         description="Beat Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="speciality",
     *         in="query",
     *         description="Speciality",
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="visit_frequency",
     *         in="query",
     *         description="Visit Frequency",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="potential",
     *         in="query",
     *         description="Potential",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="tags",
     *         in="query",
     *         description="Tags",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="focus_brand",
     *         in="query",
     *         description="Focus Brand",
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="supporting_documents",
     *         in="query",
     *         description="Supporting Documents",
     *         @OA\Schema(type="string")
     *     ),            
     *     @OA\Response(
     *         response="200",
     *         description="Outlet found!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Outelet not found!",
     *     ),
     * )
     */
    public function addOutletOrgDataRequest()
    {
        switch ($this->app->Request()->getMethod()):
            case "POST":
                $on_board_request_id = $this->app->Request()->getParameter("on_board_request_id");
                $outlet_sub_type_id = $this->app->Request()->getParameter("outlet_sub_type_id");
                $address = $this->app->Request()->getParameter("address");
                $landmark = $this->app->Request()->getParameter("landmark");
                $pincode = $this->app->Request()->getParameter("pincode");
                $town_id = $this->app->Request()->getParameter("town_id");
                $city_id = $this->app->Request()->getParameter("city_id");
                $state_id = $this->app->Request()->getParameter("state_id");
                $beat_id = $this->app->Request()->getParameter("beat_id");
                $speciality = $this->app->Request()->getParameter("speciality");
                $visit_frequency = $this->app->Request()->getParameter("visit_frequency");
                $potential = $this->app->Request()->getParameter("potential");
                $tags = $this->app->Request()->getParameter("tags");
                $focus_brand = $this->app->Request()->getParameter("focus_brand");
                $supporting_documents = $this->app->Request()->getParameter("supporting_documents");
                $address_id = $this->app->Request()->getParameter("address_id");
                $outlet_org_data_id = $this->app->Request()->getParameter("outlet_org_data_id");
                $employee = $this->app->Auth()->getUser()->getEmployee();

                if($address == null && $address == ''){$address = null;}
                if($landmark == null && $landmark == ''){$landmark = null;}
                if($city_id == null && $city_id == ''){$city_id = null;}
                if($town_id == null && $town_id == ''){$town_id = null;}
                if($state_id == null && $state_id == ''){$state_id = null;}
                if($pincode == null && $pincode == ''){$pincode = null;}
                if($outlet_org_data_id == null && $outlet_org_data_id == ''){$outlet_org_data_id = null;}
                if($speciality == null && $speciality == ''){$speciality = null;}
                if($potential == null && $potential == ''){$potential = null;}
                if($visit_frequency == null && $visit_frequency == ''){$visit_frequency = null;}
                if($tags == null && $tags == ''){$tags = null;}
                if($focus_brand == null && $focus_brand == ''){$focus_brand = null;}
                if($supporting_documents == null && $supporting_documents == ''){$supporting_documents = null;}
                if($address_id == null && $address_id == ''){$address_id = null;}
                if($beat_id == null && $beat_id == ''){$beat_id = null;}

                $onBoardRequestAddress = new \entities\OnBoardRequestAddress();
                $onBoardRequestAddress->setOutletSubTypeId($outlet_sub_type_id);
                $onBoardRequestAddress->setAddress($address);
                $onBoardRequestAddress->setLandmark($landmark);
                $onBoardRequestAddress->setIcityid($city_id);
                $onBoardRequestAddress->setItownid($town_id);
                $onBoardRequestAddress->setIstateid($state_id);
                $onBoardRequestAddress->setPincode($pincode);
                $onBoardRequestAddress->setOutletOrgDataId($outlet_org_data_id);
                $onBoardRequestAddress->setSpeciality($speciality);
                $onBoardRequestAddress->setPotential($potential);
                $onBoardRequestAddress->setVisitFrequency($visit_frequency);
                $onBoardRequestAddress->setTags($tags);
                $onBoardRequestAddress->setFocusBrand($focus_brand);
                $onBoardRequestAddress->setSpportDocuments($supporting_documents);
                $onBoardRequestAddress->setAddressId($address_id);
                $onBoardRequestAddress->setOrgUnitId($employee->getOrgUnitId());
                $onBoardRequestAddress->setCompanyId($employee->getCompanyId());
                $onBoardRequestAddress->setBeatId($beat_id);
                $onBoardRequestAddress->setOnBoardRequestId($on_board_request_id);
                $onBoardRequestAddress->setStatus('NewAdded');
                $onBoardRequestAddress->save();

                $oBM = new \BI\manager\OnBoardManager();
                $oBM->createLog($on_board_request_id, 1, $employee->getEmployeeId(), $employee->getPositionId(), "Request organization data created successfully!");

                $this->apiResponse($onBoardRequestAddress->toArray(), 200, "Create outelt organization data successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getOnBoardRequest",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="request_id",
     *         in="query",
     *         description="OnBoard Request Id",
     *         @OA\Schema(type="string")
     *     ),      
     *     @OA\Response(
     *         response="200",
     *         description="Get request details successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getOnBoardRequest()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $requestId = $this->app->Request()->getParameter("request_id");

                if ($requestId != null && $requestId != '') {
                    $oBM = new \BI\manager\OnBoardManager();
                    $result = $oBM->getRequestById($requestId);

                    if (count($result) > 0) {
                        $this->apiResponse($result, 200, "Get result successfully!!");
                    } else {
                        $this->apiResponse([], 400, "Result not found!!");
                    }
                } else {
                    $this->apiResponse([], 400, "At least one field must be filled out!!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getOutletMapping",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="on_board_request_id",
     *         in="query",
     *         description="OnBoard Request Id",
     *         @OA\Schema(type="string")
     *     ),       
     *     @OA\Response(
     *         response="200",
     *         description="Get mapping successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getOutletMapping()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $onBoardRequestId = $this->app->Request()->getParameter("on_board_request_id");

                if ($onBoardRequestId != null && $onBoardRequestId != '') {
                    
                    $oBM = new \BI\manager\OnBoardManager();
                    $data = $oBM->getOnBoardMapping($onBoardRequestId);
                    
                    $primaryOutletArray = array();
                    $secondaryOutletArray = array();
                    if(count($data) > 0){
                        foreach($data as $outlet){
                            if(isset($outlet["PrimaryOutletId"]) && $outlet["PrimaryOutletId"] != null){
                                $primaryOutlet = \entities\OutletsQuery::create()
                                                    ->filterById($outlet["PrimaryOutletId"])
                                                    ->find()->toArray();
                                if(count($primaryOutlet) == 0){
                                    $primaryOutlet = \entities\OnBoardRequestQuery::create()
                                                    ->filterByOnBoardRequestId($outlet["PrimaryOutletId"])
                                                    ->find()->toArray();
                                }
                                $primaryOutletMaaping = [
                                    'OnBoardRequestOutletMappingId' => $outlet["OnBoardRequestOutletMappingId"],
                                    'OnBoardRequestId' => $outlet["OnBoardRequestId"],
                                    'PrimaryOutletId' => $outlet["PrimaryOutletId"],
                                    'PricebookId' => $outlet["PricebookId"],
                                    'Category' => $outlet["Category"],
                                    'CreatedAt' => $outlet["CreatedAt"],
                                    'UpdatedAt' => $outlet["UpdatedAt"],
                                    'SecondaryOutletId' => $outlet["SecondaryOutletId"],
                                    'PrimaryOutlet' => $primaryOutlet,
                                    'SecondaryOutlet' => [],
                                ];
                                array_push($primaryOutletArray,$primaryOutletMaaping);

                            }
                            if(isset($outlet["SecondaryOutletId"]) && $outlet["SecondaryOutletId"] != null){
                                $secondaryOutlet = \entities\OutletsQuery::create()
                                                    ->filterById($outlet["SecondaryOutletId"])
                                                    ->find()->toArray();
                                if(count($primaryOutlet) == 0){
                                    $secondaryOutlet = \entities\OnBoardRequestQuery::create()
                                                    ->filterByOnBoardRequestId($outlet["SecondaryOutletId"])
                                                    ->find()->toArray();
                                }
                                $secondaryOutletMaaping = [
                                    'OnBoardRequestOutletMappingId' => $outlet["OnBoardRequestOutletMappingId"],
                                    'OnBoardRequestId' => $outlet["OnBoardRequestId"],
                                    'PrimaryOutletId' => $outlet["PrimaryOutletId"],
                                    'PricebookId' => $outlet["PricebookId"],
                                    'Category' => $outlet["Category"],
                                    'CreatedAt' => $outlet["CreatedAt"],
                                    'UpdatedAt' => $outlet["UpdatedAt"],
                                    'SecondaryOutletId' => $outlet["SecondaryOutletId"],
                                    'PrimaryOutlet' => [],
                                    'SecondaryOutlet' => $secondaryOutlet,
                                ];
                                array_push($secondaryOutletArray,$secondaryOutletMaaping);
                            }

                            // var_dump($onBoardRequestId.' - '.$outlet["PrimaryOutletId"].' - '.$outlet["SecondaryOutletId"]);exit;
                            // $primaryOutlet = [];
                            // if(isset($outlet["PrimaryOutletId"])){
                            //     $primaryOutlet = \entities\OutletsQuery::create()
                            //                         ->filterById($outlet["PrimaryOutletId"])
                            //                         ->find()->toArray();
                            //     if(count($primaryOutlet) == 0){
                            //         $primaryOutlet = \entities\OnBoardRequestQuery::create()
                            //                         ->filterByOnBoardRequestId($outlet["PrimaryOutletId"])
                            //                         ->find()->toArray();
                            //     }
                            // }
                            // $secondaryOutlet = [];
                            // if(isset($outlet["SecondaryOutletId"])){
                            //     $secondaryOutlet = \entities\OutletsQuery::create()
                            //                         ->filterById($outlet["SecondaryOutletId"])
                            //                         ->find()->toArray();
                            //     if(count($primaryOutlet) == 0){
                            //         $secondaryOutlet = \entities\OnBoardRequestQuery::create()
                            //                         ->filterByOnBoardRequestId($outlet["SecondaryOutletId"])
                            //                         ->find()->toArray();
                            //     }
                            // }
                            
                        }
                        $results = ['Primary' => $primaryOutletArray, 'Secondary' => $secondaryOutletArray];
                        $this->apiResponse($results, 200, "Get result successfully!!");
                    }else{
                        $this->apiResponse([], 400, "Result not found!!");
                    }
                } else {
                    $this->apiResponse([], 400, "At least one field must be filled out!!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/addOutletMappingRequest",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="on_board_request_id",
     *         in="query",
     *         description="OnBoard Request Id",
     *         @OA\Schema(type="string")
     *     ),  
     *     @OA\Parameter(
     *         name="primary_outlet_id",
     *         in="query",
     *         description="Primary Outlet Id",
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="secondary_outlet_id",
     *         in="query",
     *         description="Secondary Outlet Id",
     *         @OA\Schema(type="string")
     *     ),            
     *     @OA\Response(
     *         response="200",
     *         description="Outlet found!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Outelet not found!",
     *     ),
     * )
     */
    public function addOutletMappingRequest()
    {
        switch ($this->app->Request()->getMethod()):
            case "POST":
                $on_board_request_id = $this->app->Request()->getParameter("on_board_request_id");
                $primary_outlet_id = $this->app->Request()->getParameter("primary_outlet_id");
                $secondary_outlet_id = $this->app->Request()->getParameter("secondary_outlet_id");

                $employee = $this->app->Auth()->getUser()->getEmployee();

                $pricebook = \entities\PricebooksQuery::create()
                    ->filterByOrgId($employee->getOrgUnitId())
                    ->findOne();

                $primaryExplode = explode(',',$primary_outlet_id);
                $secondaryExplode = explode(',',$secondary_outlet_id);
                

                if(count($primaryExplode) == count($secondaryExplode)){
                    for($i=0 ; $i < count($primaryExplode); $i++){
                        if(isset($primaryExplode[$i])){
                            $onBoardRequestOutletMapping = \entities\OnBoardRequestOutletMappingQuery::create()
                                                            ->filterByOnBoardRequestId($on_board_request_id)
                                                            ->filterByPrimaryOutletId($primaryExplode[$i])
                                                            ->filterBySecondaryOutletId($secondaryExplode[$i])
                                                            ->findOne();

                            if ($onBoardRequestOutletMapping == null) {
                                $onBoardRequestOutletMapping = new \entities\OnBoardRequestOutletMapping();
                            }
            
                            $onBoardRequestOutletMapping->setOnBoardRequestId($on_board_request_id);
                            $onBoardRequestOutletMapping->setPrimaryOutletId($primaryExplode[$i]);
                            $onBoardRequestOutletMapping->setSecondaryOutletId($secondaryExplode[$i]);
                            $onBoardRequestOutletMapping->setPricebookId($pricebook->getPricebookId());
                            $onBoardRequestOutletMapping->setCategory('Regular');
                            $onBoardRequestOutletMapping->save();
                        }
                    }
                    $oBM = new \BI\manager\OnBoardManager();
                    $oBM->createLog($on_board_request_id, 1, $employee->getEmployeeId(), $employee->getPositionId(), "Request outlet mapping created successfully!");

                    $this->apiResponse($onBoardRequestOutletMapping->toArray(), 200, "Create outlet mapping successfully!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/changeRequestStatus",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="on_board_request_id",
     *         in="query",
     *         description="OnBoardRequest Id",
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
     *         description="Outlet found!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Outelet not found!",
     *     ),
     * )
     */
    public function changeRequestStatus()
    {
        switch ($this->app->Request()->getMethod()):
            case "POST":
                $on_board_request_id = $this->app->Request()->getParameter("on_board_request_id");
                $status = $this->app->Request()->getParameter("status");

                $employee = $this->app->Auth()->getUser()->getEmployee();

                $onBoardRequest = \entities\OnBoardRequestQuery::create()
                    ->filterByOnBoardRequestId($on_board_request_id)
                    ->findOne();

                $oBM = new \BI\manager\OnBoardManager();
                $onBoardRequest = $oBM->changeStatus($on_board_request_id, $status, $employee, $description = null);

                $this->apiResponse($onBoardRequest->toArray(), 200, "Request status updated successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getRequestLog",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="on_board_request_id",
     *         in="query",
     *         description="OnBoard Request Id",
     *         @OA\Schema(type="string")
     *     ),     
     *     @OA\Response(
     *         response="200",
     *         description="Get mapping successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getRequestLog()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $onBoardRequestId = $this->app->Request()->getParameter("on_board_request_id");

                if ($onBoardRequestId != null && $onBoardRequestId != '') {
                    $data = \entities\OnBoardRequestLogQuery::create()
                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                        ->leftJoinWithEmployee()
                        ->leftJoinWith('Employee.Designations')
                        ->leftJoinWithPositions()
                        ->leftJoinWithOnBoardRequest()
                        ->withColumn("CASE WHEN OnBoardRequest.Descriptioin != '' THEN OnBoardRequest.Descriptioin ELSE OnBoardRequestLog.Description END", 'Description')
                        ->filterByOnBoardRequestId($onBoardRequestId)
                        ->orderByOnBoardRequestLogId()
                        ->find()->toArray();

                    if (count($data) > 0) {
                        $this->apiResponse($data, 200, "Get result successfully!!");
                    } else {
                        $this->apiResponse([], 400, "Result not found!!");
                    }
                } else {
                    $this->apiResponse([], 400, "At least one field must be filled out!!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/submitRequest",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="on_board_request_id",
     *         in="query",
     *         description="OnBoardRequest Id",
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
     *         description="Outlet found!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Outelet not found!",
     *     ),
     * )
     */
    public function submitRequest()
    {
        switch ($this->app->Request()->getMethod()):
            case "POST":
                $on_board_request_id = $this->app->Request()->getParameter("on_board_request_id");
                $status = $this->app->Request()->getParameter("status");

                $employee = $this->app->Auth()->getUser()->getEmployee();

                $onBoardRequest = \entities\OnBoardRequestQuery::create()
                    ->filterByOnBoardRequestId($on_board_request_id)
                    ->findOne()->toArray();

                $onBoardReqAdd = \entities\OnBoardRequestAddressQuery::create()
                        ->filterByOnBoardRequestId($on_board_request_id)
                        ->find()->toArray();

                if(count($onBoardReqAdd) > 0){
                    $beatArray = array();
                    $townArray = array();
                    foreach($onBoardReqAdd as $onBoardAdd){
                        if($onBoardAdd["BeatId"] != null && $onBoardAdd["BeatId"] != ''){
                            array_push($beatArray,$onBoardAdd["BeatId"]);
                        }
                        if($onBoardAdd["Itownid"] != null && $onBoardAdd["Itownid"] != ''){
                            array_push($townArray,$onBoardAdd["Itownid"]);
                        }
                    }
                    if(count($onBoardReqAdd) != count($beatArray) || count($onBoardReqAdd) != count($townArray)){
                        return $this->apiResponse([], 400, "Please fill the correct address details!");
                    }
                }else{
                    return $this->apiResponse([], 400, "Onboard request address not found!");
                }
                    
                if($onBoardRequest['Mobile'] != null && $onBoardRequest['Mobile'] != ''){
                    if($onBoardRequest["OutletId"] == null){
                        $outlet = \entities\OutletsQuery::create()
                                ->filterByOutletContactNo($onBoardRequest['Mobile'])
                                ->filterByOutlettypeId($onBoardRequest['OutletTypeId'])
                                ->findOne();
                        if ($outlet != null && $outlet != '') {
                            return $this->apiResponse([], 400, "Already contact number exists!");
                        }
                    }
                }

                $oBM = new \BI\manager\OnBoardManager();
                $onBoardRequest = $oBM->changeStatus($on_board_request_id, $status, $employee, $description = null);

                $this->apiResponse($onBoardRequest->toArray(), 200, "Request submited successfully!");

                    
                // if(isset($onBoardRequest["OutletTypeId"]) && $onBoardRequest["OutletTypeId"] != null)
                // {
                //    if($onBoardRequest["OutletId"] == null)
                //    {
                //         $reqField = \entities\OnBoardRequiredFieldsQuery::create()
                //                     ->filterByOrgUnitId($employee->getOrgUnit()->getOrgunitid())
                //                     ->filterByOutletTypeId($onBoardRequest["OutletTypeId"])
                //                     ->findOne();

                //         $errorArray = array();
                //         if($reqField != null && $reqField->getRequiredFields() != null){
                //             foreach($reqField->getRequiredFields() as $field){
                //                 if(array_key_exists($field,$onBoardRequest)){
                //                     if($onBoardRequest[$field] == null && $onBoardRequest[$field] == ''){
                //                         $errorArray[$field] = [
                //                             'ErrorMsg' => $field.' is required!',
                //                         ];
                //                     }else{
                //                         continue;
                //                     }
                //                 }
                //             }
                //         }
                //         if(count($errorArray) > 0){
                //             return $this->apiResponse(['Error' => $errorArray], 400, "Some required fields are missing, Please check and try again!");
                //         }else{
                //             if($onBoardRequest['Mobile'] != null && $onBoardRequest['Mobile'] != ''){
                //                 $outlet = \entities\OutletsQuery::create()
                //                             ->filterByOutletContactNo($onBoardRequest['Mobile'])
                //                             ->findOne();
                //                 if ($outlet != null && $outlet != '') {
                //                     return $this->apiResponse([], 400, "Already contact number exists!");
                //                 }
                //             }
        
                //             $oBM = new \BI\manager\OnBoardManager();
                //             $onBoardRequest = $oBM->changeStatus($on_board_request_id, $status, $employee, $description = null);
        
                //             $this->apiResponse($onBoardRequest->toArray(), 200, "Request submited successfully!");
                //         }
                //     }else{
                //         // $onboardReq = \entities\OnBoardRequestQuery::create()
                //         //                     ->filterByMobile($onBoardRequest['Mobile'])
                //         //                     ->findOne();
                //         // if ($onboardReq != null && $onboardReq != '' ) {
                //         //     return $this->apiResponse([], 400, "Already contact number exists!");
                //         // }
                //         $oBM = new \BI\manager\OnBoardManager();
                //         $onBoardRequest = $oBM->changeStatus($on_board_request_id, $status, $employee, $description = null);
    
                //         $this->apiResponse($onBoardRequest->toArray(), 200, "Request submited successfully!");
                //     }
                   
                // }
                break;
        endswitch;
    }


    /**
     * @OA\Get(
     *     path="/api/getPendindApprovalRequest",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),     
     *     @OA\Response(
     *         response="200",
     *         description="Get mapping successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getPendindApprovalRequest()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $employee = $this->app->Auth()->getUser()->getEmployee();
                if ($employee != null && $employee != '') {

                    $positions = OrgManager::getUnderPositions($employee->getPositionId());
                    $positionIds = array_merge($positions, [$employee->getPositionId()]);

                    $oBM = new \BI\manager\OnBoardManager();
                    $result = $oBM->getPendingRequest($positionIds, $territoryId = null, $positionId = null, $employeeId = null);

                    $this->apiResponse($result, 200, "Get pending approval request successfully!!");
                } else {
                    $this->apiResponse([], 400, "Employee not found!!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/approveRequest",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="on_board_request_id",
     *         in="query",
     *         description="OnBoardRequest Id",
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
     *         description="Outlet found!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Outelet not found!",
     *     ),
     * )
     */
    public function approveRequest()
    {
        switch ($this->app->Request()->getMethod()):
            case "POST":
                $on_board_request_id = $this->app->Request()->getParameter("on_board_request_id");
                $status = $this->app->Request()->getParameter("status");
                $employee = $this->app->Auth()->getUser()->getEmployee();
                if ($employee != null && $employee != '') {

                    $oBM = new \BI\manager\OnBoardManager();
                    $result = $oBM->changeStatus($on_board_request_id, $status, $employee, $description = null);

                    $this->apiResponse($result->toArray(), 200, "Request approved!!");
                } else {
                    $this->apiResponse([], 400, "Employee not found!!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/rejectRequest",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="on_board_request_id",
     *         in="query",
     *         description="OnBoardRequest Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Status",
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="remark",
     *         in="query",
     *         description="Remark",
     *         @OA\Schema(type="string")
     *     ),            
     *     @OA\Response(
     *         response="200",
     *         description="Outlet found!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Outelet not found!",
     *     ),
     * )
     */
    public function rejectRequest()
    {
        switch ($this->app->Request()->getMethod()):
            case "POST":
                $on_board_request_id = $this->app->Request()->getParameter("on_board_request_id");
                $status = $this->app->Request()->getParameter("status");
                $remark = $this->app->Request()->getParameter("remark");
                $employee = $this->app->Auth()->getUser()->getEmployee();
                if ($employee != null && $employee != '') {

                    $oBM = new \BI\manager\OnBoardManager();
                    $result = $oBM->changeStatus($on_board_request_id, $status, $employee, $remark);

                    $this->apiResponse($result->toArray(), 200, "Request rejected!!");
                } else {
                    $this->apiResponse([], 400, "Employee not found!!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getFilterRequest",
     *     tags={"OnBoard API's"},
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
     *         description="Territory Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="position_id",
     *         in="query",
     *         description="Position Id",
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
     *         description="Get mapping successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getFilterRequest()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $territoryId = $this->app->Request()->getParameter("territory_id");
                $employeeId = $this->app->Auth()->getUser()->getEmployee()->getEmployeeId();

                $employee = $this->app->Auth()->getUser()->getEmployee();
                $positionIds = OrgManager::getUnderPositions($employee->getPositionId());
                
                //unset($positionIds[$employee->getPositionId()]);

                $positionId = $employee->getPositionId();

                $oBM = new \BI\manager\OnBoardManager();
                $result = $oBM->getPendingRequest($positionIds, $territoryId, $positionId, $employeeId);

                $this->apiResponse($result, 200, "get result successfully!!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getOnBoardRequestAddressById",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="request_address_id",
     *         in="query",
     *         description="Request Address Id",
     *         @OA\Schema(type="string")
     *     ),       
     *     @OA\Response(
     *         response="200",
     *         description="Get mapping successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getOnBoardRequestAddressById()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $requestAddressId = $this->app->Request()->getParameter("request_address_id");
                $onBoardAddresses = \entities\OnBoardRequestAddressQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->filterByOnBoardRequestAddressId($requestAddressId)
                    ->leftJoinWithGeoTowns()
                    ->leftJoinWithGeoCity()
                    ->leftJoinWithGeoState()
                    ->leftJoinWithBeats()
                    ->find()->toArray();
                $result = array();
                if (count($onBoardAddresses) > 0) {
                    foreach ($onBoardAddresses as $onBoardAddress) {
                        $specialityArray = array();
                        if (isset($onBoardAddress["Speciality"]) && !empty($onBoardAddress["Speciality"])) {
                            $specialityArray = \entities\ClassificationQuery::create()
                                ->filterById($onBoardAddress["Speciality"])
                                ->find()->toArray();
                        }
                        $tagArray = array();
                        if (isset($onBoardAddress["Tags"]) && !empty($onBoardAddress["Tags"])) {
                            $tagArray = \entities\OutletTagsQuery::create()
                                ->filterByOutletTagId($onBoardAddress["Tags"])
                                ->find()->toArray();
                        }
                        $brandArray = array();
                        if (isset($onBoardAddress["FocusBrand"]) && !empty($onBoardAddress["FocusBrand"])) {
                            $brandArray = \entities\BrandsQuery::create()
                                ->filterByBrandId($onBoardAddress["FocusBrand"])
                                ->find()->toArray();
                        }
                        $data = [
                            'OnBoardRequestAddressId' => $onBoardAddress["OnBoardRequestAddressId"],
                            'OutletSubTypeId' => $onBoardAddress["OutletSubTypeId"],
                            'Address' => $onBoardAddress["Address"],
                            'Landmark' => $onBoardAddress["Landmark"],
                            'Icityid' => $onBoardAddress["Icityid"],
                            'Itownid' => $onBoardAddress["Itownid"],
                            'Istateid' => $onBoardAddress["Istateid"],
                            'Pincode' => $onBoardAddress["Pincode"],
                            'OutletOrgDataId' => $onBoardAddress["OutletOrgDataId"],
                            'Speciality' => $specialityArray,
                            'Potential' => $onBoardAddress["Potential"],
                            'VisitFrequency' => $onBoardAddress["VisitFrequency"],
                            'Tags' => $tagArray,
                            'FocusBrand' => $brandArray,
                            'SpportDocuments' => $onBoardAddress["SpportDocuments"],
                            'OrgUnitId' => $onBoardAddress["OrgUnitId"],
                            'CreatedAt' => $onBoardAddress["CreatedAt"],
                            'UpdatedAt' => $onBoardAddress["UpdatedAt"],
                            'AddressId' => $onBoardAddress["AddressId"],
                            'CompanyId' => $onBoardAddress["CompanyId"],
                            'BeatId' => $onBoardAddress["BeatId"],
                            'OnBoardRequestId' => $onBoardAddress["OnBoardRequestId"],
                            'Status' => $onBoardAddress["Status"],
                            'InvestedAmount' => $onBoardAddress["InvestedAmount"],
                            'GeoTowns' => [
                                'Itownid' => isset($onBoardAddress['GeoTowns']["Itownid"]) ? $onBoardAddress['GeoTowns']["Itownid"] : null,
                                'Stownname' => isset($onBoardAddress['GeoTowns']["Stownname"]) ? $onBoardAddress['GeoTowns']["Stownname"] : null,
                                'Icityid' => isset($onBoardAddress['GeoTowns']["Icityid"]) ? $onBoardAddress['GeoTowns']["Icityid"] : null,
                                'Stowncode' => isset($onBoardAddress['GeoTowns']["Stowncode"]) ? $onBoardAddress['GeoTowns']["Stowncode"] : null,
                                'Dcreateddate' => isset($onBoardAddress['GeoTowns']["Dcreateddate"]) ? $onBoardAddress['GeoTowns']["Dcreateddate"] : null,
                                'Dmodifydate' => isset($onBoardAddress['GeoTowns']["Dmodifydate"]) ? $onBoardAddress['GeoTowns']["Dmodifydate"] : null,
                                'Sstatus' => isset($onBoardAddress['GeoTowns']["Sstatus"]) ? $onBoardAddress['GeoTowns']["Sstatus"] : null,
                                'Pincode' => isset($onBoardAddress['GeoTowns']["Pincode"]) ? $onBoardAddress['GeoTowns']["Pincode"] : null,
                            ],
                            'GeoCity' => [
                                'Icityid' => isset($onBoardAddress['GeoCity']["Icityid"]) ? $onBoardAddress['GeoCity']["Icityid"] : null,
                                'Scityname' => isset($onBoardAddress['GeoCity']["Scityname"]) ? $onBoardAddress['GeoCity']["Scityname"] : null,
                                'Scitycode' => isset($onBoardAddress['GeoCity']["Scitycode"]) ? $onBoardAddress['GeoCity']["Scitycode"] : null,
                                'Istateid' => isset($onBoardAddress['GeoCity']["Istateid"]) ? $onBoardAddress['GeoCity']["Istateid"] : null,
                                'Icountryid' => isset($onBoardAddress['GeoCity']["Icountryid"]) ? $onBoardAddress['GeoCity']["Icountryid"] : null,
                                'Dcreateddate' => isset($onBoardAddress['GeoCity']["Dcreateddate"]) ? $onBoardAddress['GeoCity']["Dcreateddate"] : null,
                                'Dmodifydate' => isset($onBoardAddress['GeoCity']["Dmodifydate"]) ? $onBoardAddress['GeoCity']["Dmodifydate"] : null,
                                'Sstatus' => isset($onBoardAddress['GeoCity']["Sstatus"]) ? $onBoardAddress['GeoCity']["Sstatus"] : null,
                                'Longitude' => isset($onBoardAddress['GeoCity']["Longitude"]) ? $onBoardAddress['GeoCity']["Longitude"] : null,
                                'Latitude' => isset($onBoardAddress['GeoCity']["Latitude"]) ? $onBoardAddress['GeoCity']["Latitude"] : null,
                            ],
                            'GeoState' => [
                                'Istateid' => isset($onBoardAddress['GeoState']["Istateid"]) ? $onBoardAddress['GeoState']["Istateid"] : null,
                                'Sstatename' => isset($onBoardAddress['GeoState']["Sstatename"]) ? $onBoardAddress['GeoState']["Sstatename"] : null,
                                'Sstatecode' => isset($onBoardAddress['GeoState']["Sstatecode"]) ? $onBoardAddress['GeoState']["Sstatecode"] : null,
                                'Dcreateddate' => isset($onBoardAddress['GeoState']["Dcreateddate"]) ? $onBoardAddress['GeoState']["Dcreateddate"] : null,
                                'Dmodifydate' => isset($onBoardAddress['GeoState']["Dmodifydate"]) ? $onBoardAddress['GeoState']["Dmodifydate"] : null,
                                'CountryId' => isset($onBoardAddress['GeoState']["CountryId"]) ? $onBoardAddress['GeoState']["CountryId"] : null,
                                'Sstatus' => isset($onBoardAddress['GeoState']["Sstatus"]) ? $onBoardAddress['GeoState']["Sstatus"] : null,
                            ],
                            'Beats' => [
                                'BeatId' => isset($onBoardAddress['Beats']["BeatId"]) ? $onBoardAddress['Beats']["BeatId"] : null,
                                'BeatName' => isset($onBoardAddress['Beats']["BeatName"]) ? $onBoardAddress['Beats']["BeatName"] : null,
                                'BeatRemark' => isset($onBoardAddress['Beats']["BeatRemark"]) ? $onBoardAddress['Beats']["BeatRemark"] : null,
                                'BeatCode' => isset($onBoardAddress['Beats']["BeatCode"]) ? $onBoardAddress['Beats']["BeatCode"] : null,
                                'TerritoryId' => isset($onBoardAddress['Beats']["TerritoryId"]) ? $onBoardAddress['Beats']["TerritoryId"] : null,
                                'CompanyId' => isset($onBoardAddress['Beats']["CompanyId"]) ? $onBoardAddress['Beats']["CompanyId"] : null,
                                'Itownid' => isset($onBoardAddress['Beats']["Itownid"]) ? $onBoardAddress['Beats']["Itownid"] : null,
                                'CreatedAt' => isset($onBoardAddress['Beats']["CreatedAt"]) ? $onBoardAddress['Beats']["CreatedAt"] : null,
                                'UpdatedAt' => isset($onBoardAddress['Beats']["UpdatedAt"]) ? $onBoardAddress['Beats']["UpdatedAt"] : null,
                                'OrgUnitId' => isset($onBoardAddress['Beats']["OrgUnitId"]) ? $onBoardAddress['Beats']["OrgUnitId"] : null,
                            ],
                        ];
                        array_push($result, $data);
                    }
                }

                $this->apiResponse($result, 200, "Get address successfully!!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/deleteOnBoardRequestAddress",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="request_address_id",
     *         in="query",
     *         description="Request Address Id",
     *         @OA\Schema(type="string")
     *     ),       
     *     @OA\Response(
     *         response="200",
     *         description="Get mapping successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function deleteOnBoardRequestAddress()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $requestAddressId = $this->app->Request()->getParameter("request_address_id");
                $employee = $this->app->Auth()->getUser()->getEmployee();

                $onBoardAddress = \entities\OnBoardRequestAddressQuery::create()
                    ->filterByOnBoardRequestAddressId($requestAddressId)
                    ->findOne();

                $oBM = new \BI\manager\OnBoardManager();
                $oBM->createLog($onBoardAddress->getOnBoardRequestId(), 7, $employee->getEmployeeId(), $employee->getPositionId(), "Request address deleted successfully!");
                
                $onBoardAddress->setStatus('Delete');
                $onBoardAddress->save();

                $position = \entities\PositionsQuery::create()
                        ->filterByPositionId($employee->getPositionId())
                        ->findOne();
                if($onBoardAddress != null){
                    $employeeId = $employee->getEmployeeId();
                    $title = 'Request Delete';
                    $message = 'Delete request created successfully!';
                    
                    \BI\manager\NotificationManager::sendNotificationToEmployee($employeeId,$title, $message,$data=[]);
                }

                $this->apiResponse([], 200, "Address deleted successfully!!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getRequiredFields",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_type_id",
     *         in="query",
     *         description="Outlet Type",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="status_type_id",
     *         in="query",
     *         description="Status Type Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),          
     *     @OA\Response(
     *         response="200",
     *         description="Get mapping successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getRequiredFields()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $outletTypeId = $this->app->Request()->getParameter("outlet_type_id");
                $statusTypeId = $this->app->Request()->getParameter("status_type_id");
                $employee = $this->app->Auth()->getUser()->getEmployee();
                if ($employee != null && $outletTypeId != null && $outletTypeId != '') {
                    $reqFields = \entities\OnBoardRequiredFieldsQuery::create()
                                    ->filterByOrgUnitId($employee->getOrgUnitId())
                                    ->filterByOutletTypeId($outletTypeId)
                                    ->filterByStatusTypeId($statusTypeId)
                                    ->find()->toArray(); 
                    $this->apiResponse($reqFields, 200, "Result get Successfully!!");
                } else {
                    $this->apiResponse([], 400, "Employee not found!!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getOnBoardWindow",
     *     tags={"OnBoard API's"},
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
     *         description="Get mapping successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getOnBoardWindow()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $positionId = $this->app->Request()->getParameter("position_id", $this->app->Auth()->getUser()->getEmployee()->getPositionId());
                if ($positionId != null) {
                    $positions = OrgManager::getUnderPositions($positionId);
                    $positionIds = array_merge($positions, [$positionId]);

                    $territory = \entities\TerritoriesQuery::create()
                        ->filterByPositionId($positionIds)
                        ->find()->toArray();
                    $this->apiResponse($territory, 200, "Result get Successfully!!");
                } else {
                    $this->apiResponse([], 400, "Position not found!!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getOutletsByTerritory",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_type_id",
     *         in="query",
     *         description="Outlet Type Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="territory_id",
     *         in="query",
     *         description="Territory Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="onboard_request_id",
     *         in="query",
     *         description="OnBoard Request Id",
     *         @OA\Schema(type="string")
     *     ),      
     *     @OA\Response(
     *         response="200",
     *         description="Get mapping successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getOutletsByTerritory()
    {
        
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $position = $this->app->Auth()->getUser()->getEmployee()->getPositionId();
                $outletTypeId = $this->app->Request()->getParameter("outlet_type_id");
                $territoryId = $this->app->Request()->getParameter("territory_id");
                $onboardRequestId = $this->app->Request()->getParameter("onboard_request_id");
                    if ($outletTypeId != null && $outletTypeId != '') {
                        if($territoryId != null && $territoryId != ''){
                            $territory = \entities\TerritoriesQuery::create()
                                        ->filterByTerritoryId($territoryId)
                                        ->findOne();
                        }else{
                            $territory = \entities\TerritoriesQuery::create()
                                        ->filterByPositionId($position)
                                        ->findOne();
                        }
                        if ($territory != null && $territory != '') {
                            $outletType = \entities\OutletTypeQuery::create()
                                ->filterByOutlettypeId($outletTypeId)
                                ->findOne();
                            $onBoardReqAddress = \entities\OnBoardRequestAddressQuery::create()
                                                    ->select(['BeatId'])
                                                    ->filterByOnBoardRequestId($onboardRequestId)
                                                    ->find()->toArray();
                            $outletTypeParent = \entities\OutletTypeQuery::create()
                                                    ->filterByOutlettypeId($outletType->getOutletparent())
                                                    ->findOne();
                            if ($outletTypeParent->getOutletparent() != 0 && $outletTypeParent->getOutletparent() != null) {
                                $outletsParent = \entities\OutletViewQuery::create()
                                    ->filterByTerritoryId($territory->getTerritoryId())
                                    ->filterByOutlettypeId($outletType->getOutletparent())
                                    ->filterByBeatId($onBoardReqAddress)
                                    ->find()->toArray();
                            } else {
                                $outletsParent = \entities\OutletViewQuery::create()
                                    ->filterByTerritoryId($territory->getTerritoryId())
                                    ->filterByOutlettypeId($outletType->getOutletparent())
                                    ->find()->toArray();
                            }
                            $outletTypeSecond = \entities\OutletTypeQuery::create()
                                ->select('OutlettypeId')
                                ->filterByOutletparent($outletTypeId)
                                ->find()->toArray();
                            if (!empty($outletTypeSecond)) {
                                $outletsChild = \entities\OutletViewQuery::create()
                                    ->filterByTerritoryId($territory->getTerritoryId())
                                    ->filterByOutlettypeId($outletTypeSecond)
                                    ->filterByBeatId($onBoardReqAddress)
                                    ->find()->toArray();
                            } else {
                                $outletsChild = [];
                            }
                            $outlets = ['ParentOutlets' => $outletsParent, 'ChildOutlet' => $outletsChild];
                            return $this->apiResponse($outlets, 200, "Get all territory outlets!!");
                        } else {
                            return $this->apiResponse([], 400, "Territory not found!!");
                        }
                    } else {
                        return $this->apiResponse([], 400, "Result not found!!");
                    }
                break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/updateOutletRequest",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="onboard_request_id",
     *         in="query",
     *         description="OnBoard Request Id",
     *         required=true, 
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="outlet_id",
     *         in="query",
     *         description="Outlet Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_type_id",
     *         in="query",
     *         description="Outlet Type Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="territory_id",
     *         in="query",
     *         description="Territory Id",
     *         @OA\Schema(type="string")
     *     ),       
     *     @OA\Parameter(
     *         name="profile_pic",
     *         in="query",
     *         description="Profile Pic",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="salutation",
     *         in="query",
     *         description="Salutation",
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="first_name",
     *         in="query",
     *         description="First Name",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="last_name",
     *         in="query",
     *         description="Last Name",
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="outlet_name",
     *         in="query",
     *         description="Outlet Name",
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="Email",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="phone_no",
     *         in="query",
     *         description="Contact No.",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="gender",
     *         in="query",
     *         description="Gender",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="date_of_birth",
     *         in="query",
     *         description="Date Of Birth",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="date_of_anniversary",
     *         in="query",
     *         description="Date Of Anniversary",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="registration_no",
     *         in="query",
     *         description="Registration No",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="marital_status",
     *         in="query",
     *         description="Marital Status",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="qualification",
     *         in="query",
     *         description="Qualification",
     *         @OA\Schema(type="string")
     *     ),             
     *     @OA\Response(
     *         response="200",
     *         description="Outlet found!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Outelet not found!",
     *     ),
     * )
     */
    public function updateOutletRequest()
    {
        switch ($this->app->Request()->getMethod()):
            case "POST":
                $onboard_request_id = $this->app->Request()->getParameter("onboard_request_id");
                $outlet_id = $this->app->Request()->getParameter("outlet_id");
                $profile_pic = $this->app->Request()->getParameter("profile_pic");
                $salutation = $this->app->Request()->getParameter("salutation");
                $first_name = $this->app->Request()->getParameter("first_name");
                $last_name = $this->app->Request()->getParameter("last_name");
                $outlet_name = $this->app->Request()->getParameter("outlet_name");
                $email = $this->app->Request()->getParameter("email");
                $phone_no = $this->app->Request()->getParameter("phone_no");
                $gender = $this->app->Request()->getParameter("gender");
                $date_of_birth = $this->app->Request()->getParameter("date_of_birth");
                $date_of_anniversary = $this->app->Request()->getParameter("date_of_anniversary");
                $registration_no = $this->app->Request()->getParameter("registration_no");
                $marital_status = $this->app->Request()->getParameter("marital_status");
                $qualification = $this->app->Request()->getParameter("qualification");
                $outlet_type_id = $this->app->Request()->getParameter("outlet_type_id");
                $territoryId = $this->app->Request()->getParameter("territory_id");

                $employee = $this->app->Auth()->getUser()->getEmployee();
                if($territoryId == null && $territoryId == ''){
                    $territory = \entities\TerritoriesQuery::create()
                                ->filterByPositionId($employee->getPositionId())
                                ->findOne();
                    if($territory != null and $territory != ''){
                        $terId = $territory->getTerritoryId();
                    }else{
                        $terId = null;
                    }
                }else{
                    $terId = $territoryId;
                }
                if ($employee->getPositionId() != null && $employee->getPositionId() != '') {
                    $positionId = $employee->getPositionId();
                } else {
                    $positionId = null;
                }

                $onBoardRequest = new \BI\requests\OnBoardRequest();
                $onBoardRequest->setOnBoardRequestId($onboard_request_id);
                $onBoardRequest->setOutletId($outlet_id);
                $onBoardRequest->setSalutation($salutation);
                $onBoardRequest->setFirstName($first_name);
                $onBoardRequest->setLastName($last_name);
                $onBoardRequest->setEmail($email);
                $onBoardRequest->setMobile($phone_no);
                $onBoardRequest->setGender($gender);
                $onBoardRequest->setDateOfBirth($date_of_birth);
                $onBoardRequest->setMaritalStatus($marital_status);
                $onBoardRequest->setDateOfAnniversary($date_of_anniversary);
                $onBoardRequest->setQualification($qualification);
                $onBoardRequest->setRegistrationNo($registration_no);
                $onBoardRequest->setProfilePic($profile_pic);
                $onBoardRequest->setTerritory($terId);
                $onBoardRequest->setPosition($positionId);
                $onBoardRequest->setUpdatedByEmployeeId($employee->getEmployeeId());
                $onBoardRequest->setUpdatedByPositionId($positionId);
                $onBoardRequest->setCompanyId($employee->getCompanyId());
                $onBoardRequest->setOutletTypeId($outlet_type_id);
                $onBoardRequest->setOutletName($outlet_name);

                $oBM = new \BI\manager\OnBoardManager();
                $result = $oBM->updateRequest($onBoardRequest);

                $this->apiResponse($result->toArray(), 200, "Request created successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/updateOutletOrgDataRequest",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="on_board_request_id",
     *         in="query",
     *         description="OnBoardRequest Id",
     *         required=true, 
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="on_board_request_address_id",
     *         in="query",
     *         description="OnBoardRequest Address Id",
     *         required=true, 
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="outlet_sub_type_id",
     *         in="query",
     *         description="Outlet Address Type",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="address",
     *         in="query",
     *         description="Address",
     *         @OA\Schema(type="string")
     *     ),  
     *     @OA\Parameter(
     *         name="landmark",
     *         in="query",
     *         description="Landmark",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="pincode",
     *         in="query",
     *         description="Pincode",
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="town_id",
     *         in="query",
     *         description="Town Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="city_id",
     *         in="query",
     *         description="City Id",
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="state_id",
     *         in="query",
     *         description="State Id",
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="beat_id",
     *         in="query",
     *         description="Beat Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="speciality",
     *         in="query",
     *         description="Speciality",
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="visit_frequency",
     *         in="query",
     *         description="Visit Frequency",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="potential",
     *         in="query",
     *         description="Potential",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="tags",
     *         in="query",
     *         description="Tags",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="focus_brand",
     *         in="query",
     *         description="Focus Brand",
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="supporting_documents",
     *         in="query",
     *         description="Supporting Documents",
     *         @OA\Schema(type="string")
     *     ),            
     *     @OA\Response(
     *         response="200",
     *         description="Outlet found!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Outelet not found!",
     *     ),
     * )
     */
    public function updateOutletOrgDataRequest()
    {
        switch ($this->app->Request()->getMethod()):
            case "POST":
                $onBoardRequestAddressId = $this->app->Request()->getParameter("on_board_request_address_id");
                $on_board_request_id = $this->app->Request()->getParameter("on_board_request_id");
                $outlet_sub_type_id = $this->app->Request()->getParameter("outlet_sub_type_id");
                $address = $this->app->Request()->getParameter("address");
                $landmark = $this->app->Request()->getParameter("landmark");
                $pincode = $this->app->Request()->getParameter("pincode");
                $town_id = $this->app->Request()->getParameter("town_id");
                $city_id = $this->app->Request()->getParameter("city_id");
                $state_id = $this->app->Request()->getParameter("state_id");
                $beat_id = $this->app->Request()->getParameter("beat_id");
                $speciality = $this->app->Request()->getParameter("speciality");
                $visit_frequency = $this->app->Request()->getParameter("visit_frequency");
                $potential = $this->app->Request()->getParameter("potential");
                $tags = $this->app->Request()->getParameter("tags");
                $focus_brand = $this->app->Request()->getParameter("focus_brand");
                $supporting_documents = $this->app->Request()->getParameter("supporting_documents");
                $address_id = $this->app->Request()->getParameter("address_id");
                $outlet_org_data_id = $this->app->Request()->getParameter("outlet_org_data_id");
                $employee = $this->app->Auth()->getUser()->getEmployee();

                $onBoardRequestAddress = \entities\OnBoardRequestAddressQuery::create()
                    ->filterByOnBoardRequestAddressId($onBoardRequestAddressId)
                    ->findOne();
                if($address == null && $address == ''){$address = null;}
                if($landmark == null && $landmark == ''){$landmark = null;}
                if($city_id == null && $city_id == ''){$city_id = null;}
                if($town_id == null && $town_id == ''){$town_id = null;}
                if($state_id == null && $state_id == ''){$state_id = null;}
                if($pincode == null && $pincode == ''){$pincode = null;}
                if($outlet_org_data_id == null && $outlet_org_data_id == ''){$outlet_org_data_id = null;}
                if($speciality == null && $speciality == ''){$speciality = null;}
                if($potential == null && $potential == ''){$potential = null;}
                if($visit_frequency == null && $visit_frequency == ''){$visit_frequency = null;}
                if($tags == null && $tags == ''){$tags = null;}
                if($focus_brand == null && $focus_brand == ''){$focus_brand = null;}
                if($supporting_documents == null && $supporting_documents == ''){$supporting_documents = null;}
                if($address_id == null && $address_id == ''){$address_id = null;}
                if($beat_id == null && $beat_id == ''){$beat_id = null;}

                if($onBoardRequestAddress != null && $onBoardRequestAddress != ''){
                    $onBoardRequestAddress->setOutletSubTypeId($outlet_sub_type_id);
                    $onBoardRequestAddress->setAddress($address);
                    $onBoardRequestAddress->setLandmark($landmark);
                    $onBoardRequestAddress->setIcityid($city_id);
                    $onBoardRequestAddress->setItownid($town_id);
                    $onBoardRequestAddress->setIstateid($state_id);
                    $onBoardRequestAddress->setPincode($pincode);
                    $onBoardRequestAddress->setOutletOrgDataId($outlet_org_data_id);
                    $onBoardRequestAddress->setSpeciality($speciality);
                    $onBoardRequestAddress->setPotential($potential);
                    $onBoardRequestAddress->setVisitFrequency($visit_frequency);
                    $onBoardRequestAddress->setTags($tags);
                    $onBoardRequestAddress->setFocusBrand($focus_brand);
                    $onBoardRequestAddress->setSpportDocuments($supporting_documents);
                    $onBoardRequestAddress->setAddressId($address_id);
                    $onBoardRequestAddress->setOrgUnitId($employee->getOrgUnitId());
                    $onBoardRequestAddress->setCompanyId($employee->getCompanyId());
                    $onBoardRequestAddress->setBeatId($beat_id);
                    $onBoardRequestAddress->setOnBoardRequestId($on_board_request_id);
                    $onBoardRequestAddress->setStatus('Update');
                    $onBoardRequestAddress->save();

                    $oBM = new \BI\manager\OnBoardManager();
                    $oBM->createLog($on_board_request_id, 1, $employee->getEmployeeId(), $employee->getPositionId(), "Request organization data updated successfully!");

                    $this->apiResponse($onBoardRequestAddress->toArray(), 200, "Request organization data successfully!");
                }else{
                    $this->apiResponse([], 400, "Request organization data not found.!");
                }
                
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getOnBoardRequestByStatus",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="onboard_request_id",
     *         in="query",
     *         description="OnBoard Request Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get onBoard request status successfully!",
     *         @OA\JsonContent()
     *     ), 
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getOnBoardRequestByStatus()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $onboardRequestId = $this->app->Request()->getParameter("onboard_request_id");
                $onboardReqStatus = \entities\OnBoardRequestQuery::create()
                    ->select(["Status"])
                    ->filterByOnBoardRequestId($onboardRequestId)
                    ->find()->toArray();
                return $this->apiResponse($onboardReqStatus, 200, "Get onBoard request status successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getOutletTags",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getOutletTags()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $outletTgas = \entities\OutletTagsQuery::create()
                    ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
                    ->find()->toArray();
                return $this->apiResponse($outletTgas, 200, "Get all territory outlets!!");
                break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/deleteOnBoardRequest",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="on_board_request_id",
     *         in="query",
     *         description="OnBoardRequest Id",
     *         required=true, 
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="Description",
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
     *         description="Outlet found!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Outelet not found!",
     *     ),
     * )
     */
    public function deleteOnBoardRequest()
    {
        switch ($this->app->Request()->getMethod()):
            case "POST":
                $onBoardRequestId = $this->app->Request()->getParameter("on_board_request_id");
                $status = $this->app->Request()->getParameter("status");
                $description = $this->app->Request()->getParameter("description");

                $employee = $this->app->Auth()->getUser()->getEmployee();

                $onBoardRequest = \entities\OnBoardRequestQuery::create()
                                            ->filterByOnBoardRequestId($onBoardRequestId)
                                            ->findOne();

                $onBoardRequest->setStatus($status);
                $onBoardRequest->setDescriptioin($description);
                $onBoardRequest->setIsDeleted(true);
                $onBoardRequest->save();

                $oBM = new \BI\manager\OnBoardManager();
                $oBM->createLog($onBoardRequestId, 8, $employee->getEmployeeId(), $employee->getPositionId(), "Request deleted successfully!");

                $this->apiResponse($onBoardRequest->toArray(), 200, "Request deleted successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getOnBoardAddressStatus",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getOnBoardAddressStatus()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $onBoardAddressStatus = $this->getConfig("Outlets", "OnBoardAddressStatus");

                return $this->apiResponse([$onBoardAddressStatus], 200, "Get onBoard Address Status!!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getOutletIdByRequest",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_id",
     *         in="query",
     *         description="Outlet Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getOutletIdByRequest()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $outletId = $this->app->Request()->getParameter("outlet_id");
                $employee = $this->app->Auth()->getUser()->getEmployee();

                $outeltView = \entities\OutletViewQuery::create()
                                    ->filterByOutlet_Id($outletId)
                                    ->findOne();
                
                if($outeltView != null && $outeltView->getOutletCode() != null){
                    $oBM = new \BI\manager\OnBoardManager();
                    $result = $oBM->checkOutletExists($outeltView->getOutletCode(), $phone_no=null, $email=null, $registration_no=null,$OutletTypeId=null);

                    if (count($result) > 0) {
                            
                        $territory = \entities\TerritoriesQuery::create()
                                        ->filterByPositionId($employee->getPositionId())
                                        ->findOne();
                        if($territory != null and $territory != ''){
                            $terId = $territory->getTerritoryId();
                        }else{
                            $terId = null;
                        }
                        if(count($result) > 0){
                            $onBoardReque = \entities\OnBoardRequestQuery::create()
                                ->filterByOutletId($outletId)
                                ->filterByStatus(1)
                                ->findOne();
                                
                            if($onBoardReque == null){
                                $onBoardReque = new \entities\OnBoardRequest();
                                $onBoardReque->setOutletId($result[0]['Outlet_Id']);
                                $onBoardReque->setSalutation($result[0]['OutletSalutation']);
                                $onBoardReque->setFirstName($result[0]['OutletContactName']);
                                $onBoardReque->setEmail($result[0]['OutletEmail']);
                                $onBoardReque->setMobile($result[0]['OutletContactNo']);
                                $onBoardReque->setDateOfBirth($result[0]['OutletContactBday']);
                                $onBoardReque->setMaritalStatus($result[0]['OutletMaritalStatus']);
                                $onBoardReque->setDateOfAnniversary($result[0]['OutletContactAnniversary']);
                                $onBoardReque->setQualification($result[0]['OutletQualification']);
                                $onBoardReque->setRegistrationNo($result[0]['OutletRegno']);
                                $onBoardReque->setProfilePic($result[0]['OutletMediaId']);
                                $onBoardReque->setStatus(1);
                                $onBoardReque->setTerritory($terId);
                                $onBoardReque->setPosition($employee->getPositionId());
                                $onBoardReque->setCreatedByEmployeeId($employee->getEmployeeId());
                                $onBoardReque->setCreatedByPositionId($employee->getPositionId());
                                $onBoardReque->setCompanyId($employee->getCompanyId());
                                $onBoardReque->setOutletTypeId($result[0]['OutlettypeId']);
                                $onBoardReque->setOutletName($result[0]['OutletName']);
                                $onBoardReque->save();
                                $outletOrgData = \entities\OutletOrgDataQuery::create()
                                                            ->filterByOutletId($outletId)
                                                            ->find()->toArray();
                                if(count($outletOrgData) > 0){
                                    foreach($outletOrgData as $outletAddress){
                                        if(!isset($outletAddress['DefaultAddress']) && $outletAddress['DefaultAddress'] == null){
                                            $this->apiResponse([], 400, "Address not found.!!");
                                        }
                                        $orgDataAddress = \entities\OutletAddressQuery::create()
                                                            ->filterByOutletAddressId($outletAddress['DefaultAddress'])
                                                            ->findOne();
                                        if($orgDataAddress == null){
                                            $this->apiResponse([], 400, "Address types not found.!!");
                                        }
                                        $outletType = \entities\OutletTypeQuery::create()
                                                        ->filterByOutlettypeName($orgDataAddress->getAddressName())
                                                        ->findOne();
                                        if($outletAddress['Tags'] != null && $outletAddress['Tags'] != ''){
                                            $tagArray = array();
                                            $tagEx = explode(',',$outletAddress['Tags']);
                                            if(isset($tagEx[0])){
                                                $tag = \entities\OutletTagsQuery::create()
                                                            ->select(['OutletTagId'])
                                                            ->filterByTagName($tagEx[0])
                                                            ->findOne();
                                            }else{
                                                $tag = null;
                                            }
                                        }
                                        if($outletAddress['BrandFocus'] != null && $outletAddress['BrandFocus'] != ''){
                                            $brandArray = array();
                                            $brandEx = explode(',',$outletAddress['BrandFocus']);
                                            if(isset($brandEx[0])){
                                                $brand = \entities\BrandsQuery::create()
                                                            ->select(['BrandId'])
                                                            ->filterByBrandName($brandEx[0])
                                                            ->findOne();
                                            }else{
                                                $brand = null;
                                            }
                                        }
                                        $beatOutlet = \entities\BeatOutletsQuery::create()
                                                            ->filterByBeatOrgOutlet($outletAddress['OutletOrgId'])
                                                            ->findOne();
                                        if($beatOutlet != null && $beatOutlet->getBeatId() != null){
                                            $beatId = $beatOutlet->getBeatId();
                                        }else{
                                            $beatId = null;
                                        }
                                        if($orgDataAddress != null && $orgDataAddress->getItownid() != null){
                                            $itownId = $orgDataAddress->getItownid();
                                        }else{
                                            $itownId = null;
                                        }

                                        $requestAddress = \entities\OnBoardRequestAddressQuery::create()
                                                            ->filterByItownid($itownId)
                                                            ->filterByOutletOrgDataId($outletAddress['OutletOrgId'])
                                                            ->filterByOrgUnitId($employee->getOrgUnitId())
                                                            ->filterByStatus('NewAdded')
                                                            ->findOne();
                                        if($requestAddress == null){
                                            $requestAddress = new \entities\OnBoardRequestAddress();
                                        }
                                        $requestAddress->setOutletSubTypeId($outletType->getOutlettypeId());
                                        $requestAddress->setAddress($orgDataAddress->getOutletAddress());
                                        $requestAddress->setLandmark($orgDataAddress->getOutletStreetName());
                                        $requestAddress->setItownid($itownId);
                                        $requestAddress->setPincode($orgDataAddress->getOutletPincode());
                                        $requestAddress->setOutletOrgDataId(isset($outletAddress['OutletOrgId']) ? $outletAddress['OutletOrgId'] : null);
                                        $requestAddress->setPotential($outletAddress['OrgPotential']);
                                        $requestAddress->setVisitFrequency($outletAddress['VisitFq']);
                                        $requestAddress->setTags(isset($tag) ? $tag : null);
                                        $requestAddress->setFocusBrand(isset($brand) ? $brand : null);
                                        $requestAddress->setOrgUnitId($employee->getOrgUnitId());
                                        $requestAddress->setBeatId($beatId);
                                        $requestAddress->setOnBoardRequestId($onBoardReque->getOnBoardRequestId());
                                        $requestAddress->setCompanyId($employee->getCompanyId());
                                        $requestAddress->setStatus('NewAdded');
                                        $requestAddress->save();
                                    }
                                }
                            }
                            
                            $this->apiResponse(['OnBoardRequestId' =>$onBoardReque->getOnBoardRequestId()], 200, "Get result successfully!!");
                        }
                    } else {
                        $this->apiResponse([], 204, "Result not found!!");
                    }
                }else{
                    $this->apiResponse([], 400, "Outlet not found!!");
                }     
                break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/deleteMedia",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="media_id",
     *         in="query",
     *         description="Media Id",
     *         @OA\Schema(type="string")
     *     ),            
     *     @OA\Response(
     *         response="200",
     *         description="Outlet found!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Outelet not found!",
     *     ),
     * )
     */
    public function deleteMedia()
    {
        switch ($this->app->Request()->getMethod()):
            case "POST":
                $mediaId = $this->app->Request()->getParameter("media_id");

                $mediaFile = \entities\MediaFilesQuery::create()
                            ->findPk($mediaId);

                if (!empty($mediaFile)) {
                    if ($mediaFile->getIss3file()) {
                        (new \BI\manager\FileManager())->removeFileFromS3($_ENV['STACKHERO_MINIO_AWS_BUCKET'], $mediaFile->getMediaData());
                    }
                    $mediaFile->delete();
                }
                
                $mediaFile = \entities\MediaFilesQuery::create()
                                ->filterByMediaId($mediaId)
                                ->delete();

                $this->apiResponse([], 200, "Media deleted successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getAddressMedia",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="request_address_id",
     *         in="query",
     *         description="Request Address Id",
     *         @OA\Schema(type="string")
     *     ),            
     *     @OA\Response(
     *         response="200",
     *         description="Outlet found!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Outelet not found!",
     *     ),
     * )
     */
    public function getAddressMedia()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $requestAddressId = $this->app->Request()->getParameter("request_address_id");

                $reqAddress = \entities\OnBoardRequestAddressQuery::create()
                                    ->filterByOnBoardRequestAddressId($requestAddressId)
                                    ->findOne();
                
                if($reqAddress != null && $reqAddress->getSpportDocuments() != null){
                    $mediaFiles = [$reqAddress->getSpportDocuments()];
                }else{
                    $mediaFiles = [];
                }

                $this->apiResponse($mediaFiles, 200, "Request address media get successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/deleteAddressMedia",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="request_address_id",
     *         in="query",
     *         description="Request Address Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="media_id",
     *         in="query",
     *         description="Media Id",
     *         @OA\Schema(type="string")
     *     ),             
     *     @OA\Response(
     *         response="200",
     *         description="Outlet found!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Outelet not found!",
     *     ),
     * )
     */
    public function deleteAddressMedia()
    {
        switch ($this->app->Request()->getMethod()):
            case "POST":
                $requestAddressId = $this->app->Request()->getParameter("request_address_id");
                $mediaId = $this->app->Request()->getParameter("media_id");

                $reqAddress = \entities\OnBoardRequestAddressQuery::create()
                                    ->filterByOnBoardRequestAddressId($requestAddressId)
                                    ->findOne();
                
                if($reqAddress != null && $reqAddress->getSpportDocuments() != null){
                    $reqAddresMmediaFiles = explode(',',$reqAddress->getSpportDocuments());

                    $supportDoc = $reqAddresMmediaFiles;
                    if (($key = array_search($mediaId, $supportDoc)) !== FALSE) {
                    unset($supportDoc[$key]);
                    }
                    $supportImplode = implode(',',$supportDoc);
                    $reqAddress->setSpportDocuments($supportImplode);
                    $reqAddress->save();
                    
                    $mediaFile = \entities\MediaFilesQuery::create()
                                ->filterByMediaId((int)$mediaId)
                                ->delete();
                    $this->apiResponse($reqAddress->toArray(), 200, "Request address media get successfully!");
                }else{
                    $this->apiResponse([], 400, "Request address document not found!");
                }
                break;
        endswitch;
    }


    /**
     * @OA\Get(
     *     path="/api/getOnBoardWindowByTerritory",
     *     tags={"OnBoard API's"},
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
     *         description="Territory Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),      
     *     @OA\Response(
     *         response="200",
     *         description="Get mapping successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getOnBoardWindowByTerritory()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $territoryId = $this->app->Request()->getParameter("territory_id");
                if($territoryId != null){
                    $territory = \entities\TerritoriesQuery::create()
                                ->filterByTerritoryId($territoryId)
                                ->findOne();
                    $this->apiResponse($territory->toArray(), 200, "Get onBoard window successfully!");
                }else{
                    $this->apiResponse([], 400, "Territory not found!");
                }
                
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/deleteRequestMapping",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="request_id",
     *         in="query",
     *         description="Request Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="primary_id",
     *         in="query",
     *         description="Primary Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="secondary_id",
     *         in="query",
     *         description="Secondary Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),        
     *     @OA\Response(
     *         response="200",
     *         description="Get mapping successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function deleteRequestMapping()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $requestId = $this->app->Request()->getParameter("request_id");
                $primaryId = $this->app->Request()->getParameter("primary_id");
                $secondaryId = $this->app->Request()->getParameter("secondary_id");

                if($requestId != null && $primaryId != null && $secondaryId != null){
                    $onBoardRequestMapping = \entities\OnBoardRequestOutletMappingQuery::create()
                                                ->filterByOnBoardRequestId($requestId)
                                                ->filterByPrimaryOutletId($primaryId)
                                                ->filterBySecondaryOutletId($secondaryId)
                                                ->delete();
                    $this->apiResponse([], 200, "Maaping deleted successfully!");
                }else{
                    $this->apiResponse([], 400, "Territory not found!");
                }
                
                break;
        endswitch;
    }
    
    /**
     * @OA\Post(
     *     path="/api/updateOutletOrgDataMedia",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="on_board_request_id",
     *         in="query",
     *         description="OnBoardRequest Id",
     *         required=true, 
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="on_board_request_address_id",
     *         in="query",
     *         description="OnBoardRequest Address Id",
     *         required=true, 
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="supporting_documents",
     *         in="query",
     *         description="Supporting Documents",
     *         @OA\Schema(type="string")
     *     ),            
     *     @OA\Response(
     *         response="200",
     *         description="Outlet found!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Outelet not found!",
     *     ),
     * )
     */
    public function updateOutletOrgDataMedia()
    {
        switch ($this->app->Request()->getMethod()):
            case "POST":
                $onBoardRequestAddressId = $this->app->Request()->getParameter("on_board_request_address_id");
                $on_board_request_id = $this->app->Request()->getParameter("on_board_request_id");
                $supporting_documents = $this->app->Request()->getParameter("supporting_documents");
                $employee = $this->app->Auth()->getUser()->getEmployee();

                $onBoardRequestAddress = \entities\OnBoardRequestAddressQuery::create()
                    ->filterByOnBoardRequestAddressId($onBoardRequestAddressId)
                    ->findOne();
                $onBoardRequestAddress->setSpportDocuments($supporting_documents);
                $onBoardRequestAddress->setOrgUnitId($employee->getOrgUnitId());
                $onBoardRequestAddress->setCompanyId($employee->getCompanyId());
                $onBoardRequestAddress->setOnBoardRequestId($on_board_request_id ? $on_board_request_id : null);
                $onBoardRequestAddress->save();

                $this->apiResponse($onBoardRequestAddress->toArray(), 200, "Request organization data successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getOutletRcpaSgpi",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="onboard_request_address_id",
     *         in="query",
     *         description="Onboard Request Address Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),      
     *     @OA\Response(
     *         response="200",
     *         description="Get records successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getOutletRcpaSgpi()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $requestAddressId = $this->app->Request()->getParameter("onboard_request_address_id");
                $employee = $this->app->Auth()->getUser()->getEmployee();

                $month3 = date("m-Y",strtotime("-2 month"));
                $month2 = date("m-Y",strtotime("-1 month"));
                $month1 = date("m-Y");
                $monthArray = [$month3,$month2,$month1];

                $onBoardReqAddId = \entities\OnBoardRequestAddressQuery::create()
                                        ->filterByOnBoardRequestAddressId($requestAddressId)
                                        ->findOne();
                if($onBoardReqAddId != null){
                    $brandRcpaSummary = \entities\RcpaSummaryQuery::create()
                                            ->select(['BrandId','BrandName','RcpaMoye','RcpaValue','OwnValue'])
                                            ->withColumn('SUM(rcpa_value)', 'RcpaValue')
                                            ->withColumn('SUM(own)', 'OwnValue')
                                            ->filterByOutletOrgId($onBoardReqAddId->getOutletOrgDataId())
                                            ->filterByRcpaMoye($monthArray)
                                            ->groupByBrandId()
                                            ->groupByRcpaMoye()
                                            ->find()->toArray();
                    
                    $sgpiSummary = \entities\SgpiOutSummaryQuery::create()
                                        ->select(['OutletOrgdataId','SgpiType','Moye','Qty'])
                                        ->withColumn('SUM(qty)', 'Qty')
                                        ->filterByOutletOrgdataId($onBoardReqAddId->getOutletOrgDataId())
                                        ->filterByMoye($monthArray)
                                        ->groupBySgpiType()
                                        ->groupByMoye()
                                        ->find()->toArray();

                    $outletOrgData = \entities\OutletOrgDataQuery::create()
                                        ->filterByOutletOrgId($onBoardReqAddId->getOutletOrgDataId())
                                        ->findOne()->toArray();

                    $data = ['BrandRcpaSummary' => $brandRcpaSummary, 'SgpiSummary' => $sgpiSummary, 'OutletOrgData' => $outletOrgData];

                    $this->apiResponse($data, 200, "OutletOrgData records successfully!");
                }else{
                    $this->apiResponse([], 400, "OutletOrgData records not found!");
                }
                
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getOnBoardNotifications",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get employee notification successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getOnBoardNotifications()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $onBoardRequest = \entities\OnBoardRequestLogQuery::create()
                                        ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())
                                        ->find()->toArray();
                if (count($onBoardRequest) > 0) 
                {
                    $this->apiResponse($onBoardRequest, 200, "Get Notifications ");
                }else{
                    $this->apiResponse([], 200, "Get Notifications ");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/createRequestToOutlet",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),     
     *     @OA\Response(
     *         response="200",
     *         description="Get mapping successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function createRequestToOutlet()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $obm = new \BI\manager\OnBoardManager();
                $obm->createCustomerFromRequest();
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getPositionTreeView",
     *     tags={"Lost Prescriber"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),     
     *     @OA\Response(
     *         response="200",
     *         description="Get position successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getPositionTreeView()
    {  
        switch ($this->app->Request()->getMethod()) {
            case "GET":
                $epos = $this->app->Auth()->getUser()->getEmployee()->getPositionId();
                $data = $this->getPositionData($epos);

                $this->apiResponse($data, 200, "Get Positions Successfully!");
                 
            break;
        }
    }

    private function getPositionData($positionId)
    {  
        $position = \entities\PositionsQuery::create()
            ->select(['position_id', 'position_code', 'position_name', 'cav_positions_down','reporting_to'])
            ->filterByPositionId($positionId)
            ->findOne();
        
        if (!$position) {
            return null;
        }
        $pos = \entities\EmployeeQuery::create()->filterByPositionId($position['position_id'])->findOne();
        $name = trim($pos->getFirstName().' '.$pos->getLastName());

        $positionData = [
            'position_id' => $position['position_id'],
            'position_code' => $position['position_code'],
            'position_name' => $position['position_name'],
            'EmployeeName' => $name,
            'children' => []
        ];
        $currentDate =date('Y-m-d');
        $empl = \entities\EmployeeQuery::create()
                ->useHrUserDatesQuery()
                   ->filterByJoinDate($currentDate,Criteria::LESS_EQUAL)
                ->endUse()
                ->filterByReportingTo($position['position_id'])
                ->filterByStatus(1)
                ->find()->toArray();
        
        if (!empty($empl)) 
        {
            foreach ($empl as $childPositionId) 
            {   
                $childPositionId = $childPositionId['PositionId'];
                if (!empty($childPositionId)) {
                    $childPositionData = $this->getPositionData($childPositionId);
                    if ($childPositionData) {

                        $positionData['children'][] = $childPositionData;
                    }
                }
            }
        }
        return $positionData;
    }
    /**
     * @OA\Get(
     *     path="/api/getpresciberStatus",
     *     tags={"Lost Prescriber"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get Prescriber Status successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getpresciberStatus()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $prescriberStatus = $this->getConfig("Outlets", "PrescriberStatus");
                $this->apiResponse($prescriberStatus, 200, "Get Prescriber Status successfully!");
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getprescriberTallyWidget",
     *     tags={"Lost Prescriber"},
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
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Status",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="rcpa",
     *         in="query",
     *         description="Rcpa",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="visits",
     *         in="query",
     *         description="Visits",
     *         @OA\Schema(type="string")
     *     ),    
     *     @OA\Response(
     *         response="200",
     *         description="Get position successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getprescriberTallyWidget()
    {  
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $positionId = $this->app->Request()->getParameter("position_id");
                $status = $this->app->Request()->getParameter("status");
                $rcpa = $this->app->Request()->getParameter("rcpa");
                $visits = $this->app->Request()->getParameter("visits");
                $presMOye = \entities\PrescriberTallySummaryQuery::create()
                                    ->orderByMoye('desc')->findOne();///for getting current moye
                
                $presMOye = !empty($presMOye) ? $presMOye->getMoye() : date('m-Y');
                $presTallySummary = \entities\PrescriberTallySummaryQuery::create()
                ->select(['OrgunitId','BrandId','CmRxbers','LmRxbers','Targets','Moye'])
                ->withColumn('SUM(tagged_drs)','Targets')
                ->withColumn('SUM(cm_rxbers)','CmRxbers')
                ->withColumn('SUM(lm_rxbers)','LmRxbers')
                ->filterByMoye($presMOye);
    
                if($positionId  != null )
                {
                    $positions = OrgManager::getUnderPositions($positionId);
                    $positionIds = array_merge($positions, [$positionId]);
                    $presTallySummary->filterByPositionId($positionIds);
                } 
                if($status != null)
                {  
                    if($status == 'Gain')
                    {
                      $presTallySummary->filterByGain(1,\Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                      ->withColumn('SUM(gain)','COUNT');
                    }
                    if($status == 'Loss'){
                        $presTallySummary->filterByLoss(1,\Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                        ->withColumn('SUM(loss)','COUNT'); 
                    }
                    if($status == '2_Months_Rxer'){
                        $presTallySummary->filterByTwoMonthRxber(1,\Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                        ->withColumn('SUM(two_Month_Rxber)','COUNT');
                    }
                    if($status == 'Non_Rxer'){
                        $presTallySummary->filterByNonrxber(1,\Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                        ->withColumn('SUM(NonRxber)','COUNT'); 
                    }
                   
                }
                if($rcpa != null && $rcpa !='All')
                {  
                    $presTallySummary->filterByCmRcpa($rcpa);
                }
                if($visits != null &&  $visits !='All')
                {
                    $presTallySummary->filterByCmVisit($visits);
                }
                // Include join with the brand table
                $presTallySummary->useBrandsQuery()
                                 ->withColumn('brand_name')
                                 ->withColumn('min_value')
                                 ->endUse();
                $results = $presTallySummary->groupBy('BrandId')->find()->toArray();
                //print_r($results);die;
                $count = $presTallySummary->count();
               
                if ($count > 0) 
                {
                    $this->apiResponse($results, 200, "Get prescriber tally data");
                }else{
                    $this->apiResponse([], 200, "Get prescriber tally data");
                }
                break;
        endswitch;
    }


    /**
     * @OA\Get(
     *     path="/api/getLanguages",
     *     tags={"OnBoard API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get languages successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getLanguages()
    {
        switch ($this->app->Request()->getMethod()):
            case "GET":
                $languages = \entities\LanguageQuery::create()->find()->toArray();
                $this->apiResponse($languages, 200, "Get languages successfully!");
                break;
        endswitch;
    }

}
