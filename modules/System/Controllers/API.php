<?php

declare(strict_types = 1);

namespace Modules\System\Controllers;

use Http\Request;
use App\System\App;
use App\Utils\SendSms;
use entities\MtpQuery;
use entities\OtpRequests;
use BI\manager\OrgManager;
use App\Utils\OlaMaps;
use App\Utils\OTPGenerator;
use entities\EmployeeQuery;
use entities\WfDocumentsQuery;
use Modules\System\Processes\WorkflowManager;
use Propel\Runtime\ActiveQuery\Criteria;

class API extends \App\Core\BaseController {

    protected $app;

    public function __construct(App $app) {
        $this->app = $app;
    }

    /**
     * @OA\Post(
     *     path="/api/createOtpRequest",
     *     tags={"System API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="isd_code",
     *         in="query",
     *         description="ISD Code",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="contact_number",
     *         in="query",
     *         description="Contact Number",
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
     *     @OA\Parameter(
     *         name="otp_request_reason",
     *         in="query",
     *         description="Reason For OTP Request.",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="OTP request created successfully.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function createOtpRequest() {
        switch ($this->app->Request()->getMethod()):
            case "POST" :
                $IsdCode = $this->app->Request()->getParameter("isd_code");
                $ContactNumber = $this->app->Request()->getParameter("contact_number");
                $EmployeeId = $this->app->Request()->getParameter("employee_id");
                $OtpRequestReason = $this->app->Request()->getParameter("otp_request_reason");
                try {
                    //$otp = OTPGenerator::generateOTP();
                    //$sendOtp = SendSms::sendOtpMessage($otp, $ContactNumber, $IsdCode);
                    $otp = '9999';
                    if ($otp) {
                        $otpRequest = new OtpRequests();
                        $otpRequest->setOtpReqMobile($ContactNumber);
                        $otpRequest->setOtpReqCountrycode($IsdCode);
                        $otpRequest->setOtpRequestEmployee($EmployeeId);
                        $otpRequest->setOtpRequestReason($OtpRequestReason);
                        $otpRequest->setOtp($otp);
                        $otpRequest->setCompanyId($this->app->Auth()->CompanyId());
                        $otpRequest->setOtpReqCreatedDate(date('Y-m-d H:i:s'));
                        $otpRequest->save();
                        if ($otpRequest) {
                            $this->apiResponse(['OtpRequestId' => $otpRequest->getOtpreqid()], 200, "OTP request created successfully.");
                        } else {
                            $this->apiResponse([], 400, $e->getMessage());
                        }
                    } else {
                        $this->apiResponse([], 400, $e->getMessage());
                    }
                } catch (Exception $ex) {
                    $this->apiResponse([], 400, $e->getMessage());
                }
                break;
        endswitch;
    }
    
    /**
     * @OA\Post(
     *     path="/api/verifyOtpRequest",
     *     tags={"System API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="otp_request_id",
     *         in="query",
     *         description="OTP Request Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="contact_number",
     *         in="query",
     *         description="Contact Number",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="otp",
     *         in="query",
     *         description="Request OTP",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="OTP verify successfully.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function verifyOtpRequest() {
        switch ($this->app->Request()->getMethod()):
            case "POST" :
                $OtpRequestId = $this->app->Request()->getParameter("otp_request_id");
                $ContactNumber = $this->app->Request()->getParameter("contact_number");
                $Otp = $this->app->Request()->getParameter("otp");
                try {
                    $otpRequest = \entities\OtpRequestsQuery::create()
                                        ->filterByOtpReqId($OtpRequestId)
                                        ->filterByOtpReqMobile($ContactNumber)
                                        ->filterByOtp($Otp)
                                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                                        ->findOne();
                    if ($otpRequest) {
                        $otpRequest->setOtpVerified(1);
                        $otpRequest->setOtpVerifiedDate(date('Y-m-d H:i:s'));
                        $otpRequest->save();
                        
                        $this->apiResponse(['OtpRequestId' => $otpRequest->getOtpreqid()], 200, "OTP verify successfully.");
                        
                    } else {
                        $this->apiResponse([], 400, "Please enter valid OTP!");
                    }
                } catch (Exception $ex) {
                    $this->apiResponse([], 400, $ex->getMessage());
                }
                break;
        endswitch;
    }
    
    /**
     * @OA\Get(
     *     path="/api/getAgendas",
     *     tags={"System API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="role_id",
     *         in="query",
     *         description="Role Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Response(
     *         response="200",
     *         description="Get all agenda successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function getAgendas() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $roleId = $this->app->Request()->getParameter("role_id");
                if ($roleId != null && $roleId != '') {
                    $data['Agenda'] = \entities\AgendatypesQuery::create()
                            ->filterByRoleId($roleId)
                            ->findByCompanyId($this->app->Auth()->CompanyId())
                            ->toArray();
                    if (count($data['Agenda']) > 0) {
                        $data['Event'] = \entities\TourplansQuery::create()
                                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                                        ->joinWithBeats()
                                        ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployeeId())
                                        ->filterByTpDate(date('Y-m-d'))
                                        ->find()->toArray();
                        $this->apiResponse($data, 200, "Get all agenda successfully!");
                    } else {
                        $this->apiResponse([], 404, "Agenda not found!");
                    }
                } else {
                    $this->apiResponse([], 400, "Role not found!");
                }
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getMtpAgendas",
     *     tags={"System API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="agenda_type",
     *         in="query",
     *         description="Agenda Type",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="date",
     *         in="query",
     *         description="Date",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),  
     *     @OA\Response(
     *         response="200",
     *         description="Get all mtp agenda successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function getMtpAgendas() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $orgUnitId = $this->app->Auth()->getUser()->getEmployee()->getOrgUnitId();
                $agendaType = $this->app->Request()->getParameter("agenda_type");
                $date = $this->app->Request()->getParameter("date");

                $firstDate = date("Y-m-01", strtotime($date));
                $lastDate = date("Y-m-t", strtotime($date));

                $brandCampaigns = \entities\BrandCampiagnQuery::create()
                                        ->filterByStartDate($firstDate,Criteria::GREATER_EQUAL)
                                        ->filterByEndDate($lastDate,Criteria::LESS_EQUAL)
                                        ->filterByStatus(['Published','Started'])
                                        ->find()->toArray();
                if(count($brandCampaigns) > 0){
                    $data = [];
                    foreach($brandCampaigns as $brandCampaign){
                        $positionExp = explode(',',$brandCampaign['Position']);
                        $empPosition = $this->app->Auth()->getUser()->getEmployee()->getPositionId();
                        $dateExplode = explode('-',$date);
                        $month = $dateExplode[1].'-'.$dateExplode[0];

                        $tpdate = strtotime($date);
                        $endDate = strtotime($brandCampaign['EndDate']);
                        
                        if(in_array($empPosition,$positionExp) && $endDate >= $tpdate){
                            $campaignSteps = \entities\BrandCampiagnVisitPlanQuery::create()
                                                ->leftJoinWithAgendatypes()
                                                ->joinWithBrandCampiagn()
                                                ->filterByBrandCampiagnId($brandCampaign['BrandCampiagnId'])
                                                ->filterByAgendaType($agendaType)
                                                ->filterByMoye($month)
                                                ->find()->toArray();
                            if(count($campaignSteps) > 0){
                                foreach($campaignSteps as $campaignStep){
                                    if(isset($campaignStep['Agendatypes'])){
                                        $agendaName = $campaignStep['Agendatypes']['Agendname'];
                                    }else{
                                        $agendaName = null;
                                    }
                                    $campaignData = [
                                        'Agendaid' => $campaignStep['AgendaSubTypeId'],
                                        'Agendname' => $agendaName,
                                        'Agendacontroltype' => $campaignStep['AgendaType'],
                                        'BrandCampiagnVisitPlanId' => $campaignStep['BrandCampiagnVisitPlanId'],
                                        'StepName' => $campaignStep['StepName'],
                                        'BrandCampaginName' => $campaignStep['BrandCampiagn']['CampiagnName'],
                                    ];
                                    array_push($data,$campaignData);
                                }
                            }
                        }
                    }

                    $agendaTypes = \entities\AgendatypesQuery::create()
                                        ->filterByAgendacontroltype($agendaType)
                                        ->filterByOrgunitid($orgUnitId)
                                        ->filterByIsPrivate(false)
                                        ->find()->toArray();
                    $response = ['AgendaTypes' => $agendaTypes, 'BrandCampaignAgenda' => $data];
                    
                }else{
                    $agendaTypes = \entities\AgendatypesQuery::create()
                                        ->filterByAgendacontroltype($agendaType)
                                        ->filterByOrgunitid($orgUnitId)
                                        ->filterByIsPrivate(false)
                                        ->find()->toArray();
                    $response = ['AgendaTypes' => $agendaTypes, 'BrandCampaignAgenda' => []];
                }
                
                $this->apiResponse($response, 200, "Get all mtp agenda successfully!");
                    
                break;
        endswitch;
    }
    
    /**
     * @OA\Get(
     *     path="/api/getRoles",
     *     tags={"System API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get all agenda successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function getRoles() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $roles = \entities\RolesQuery::create()
                                ->select(['RoleId','RoleName','RoleDesc'])
                                ->filterByRolePrivate(0)
                                ->find()->toArray();
                if (count($roles) > 0) {
                    $this->apiResponse($roles, 200, "Get all role successfully!");
                } else {
                    $this->apiResponse([], 404, "Role not found!");
                }
                break;
        endswitch;
    }

     /**
     * @OA\Get(
     *     path="/api/getPendingActions",
     *     tags={"System API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get all agenda successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function getPendingActions() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :

                $pendingActions = \entities\WfRequestsQuery::create()
                    ->withColumn("count(*)","Count")
                    ->select(["WfDocId","Count"])                    
                    ->filterByEmployee($this->app->Auth()->getUser()->getEmployee())
                    ->filterByWfReqStatus(0)                    
                    ->groupByWfDocId()
                    ->find()->toArray();

                $documents = WfDocumentsQuery::create()->find()->toKeyValue("WfDocId","WfDocName");

                $res = [];

                foreach($pendingActions as $pen)
                {
                    if(isset($documents[$pen['WfDocId']]))
                    {
                        $res[$documents[$pen['WfDocId']]] = $pen['Count'];
                    }                    
                }

                //$org = new Orgstructure($this->app);                                
                $myPositions = OrgManager::getUnderPositions($this->app->Auth()->getUser()->getEmployee()->getPositionId());
                $mtpPending = MtpQuery::create()
                                ->filterByMtpStatus("requested")
                                ->filterByPositionId($myPositions)
                                ->find()->count();

                $res["PendingMtpCount"] = $mtpPending;
                
                $this->apiResponse($res, 200, "Get all pending actions successfully!");
                
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/appFirstStart",
     *     tags={"System API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get all required configurations!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function appFirstStart() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $res = [];

                $res["SgpiType"] = $this->getConfig("SGPI","SgpiType");
                
                $this->apiResponse($res, 200, "");
                
                break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/lockEmployee",
     *     tags={"System API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="emp_code",
     *         in="query",
     *         description="Employee Code",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="reason",
     *         in="query",
     *         description="Reason",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Response(
     *         response="200",
     *         description="Get all required configurations!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function lockEmployee() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :

                $emp_code = $this->app->Request()->getParameter("emp_code");                
                $reason = $this->app->Request()->getParameter("reason");

                $emp = EmployeeQuery::create()
                            ->filterByEmployeeCode($emp_code)
                            ->filterByCompanyId($this->app->Auth()->CompanyId())
                            ->filterByStatus(1)->findOne();
                if($emp)
                {
                    $emp->setIslocked(1);
                    $emp->setLockedreason($reason);
                }
                else 
                {
                    $this->apiResponse([], 400, "Employee does not exists or is deactivated !!");
                }                
                
                
                break;
        endswitch;
    }


    public function PostgreSQLConnection(){
        try {
            $serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
            $connectionCount = $serviceContainer->getConnection()->exec("SELECT count(*) FROM pg_stat_activity WHERE state = 'active'");
            if ($connectionCount > 150) {
                $serviceContainer->getConnection()->exec("SELECT pg_terminate_backend(pid) FROM pg_stat_activity WHERE state = 'active'");
                echo "All active PostgreSQL sessions killed.";
            } else {
                echo "Connection count is not greater than 150. No action taken.";
            }
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    /**
     * @OA\Get(
     *     path="/api/getAddressFromReverseGeocode",
     *     tags={"System API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="latitude",
     *         in="query",
     *         description="Latitude",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Parameter(
     *         name="longitude",
     *         in="query",
     *         description="Longitude",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ), 
     *     @OA\Response(
     *         response="200",
     *         description="Get all agenda successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function getAddressFromReverseGeocode() {
        switch ($this->app->Request()->getMethod()):
            case "GET" :
                $latitude = $this->app->Request()->getParameter("latitude");
                $longitude = $this->app->Request()->getParameter("longitude");

                if ($latitude != null || $latitude != '' && $longitude != null || $longitude != '') {
                    $reverseGeocode = new OlaMaps();
                    $result = $reverseGeocode->ReverseGeocoding($latitude,$longitude);

                    if(!empty($result["data"])){
                        $dataDecode = json_decode($result["data"]);
                        if(!empty($dataDecode->results) && isset($dataDecode->results[0])){
                            $formattedAddress = $dataDecode->results[0]->formatted_address;
                        }
                    }
                } else {
                    $this->apiResponse([], 400, "Lat Long not found!");
                }
                break;
        endswitch;
    }

}
