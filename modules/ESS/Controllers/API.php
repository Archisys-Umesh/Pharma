<?php

declare (strict_types = 1);

namespace Modules\ESS\Controllers;

use App\System\App;
use App\Utils\SendSms;
use BI\manager\DailyCallsManager;
use BI\manager\ExpenseManager;
use BI\manager\LeaveManager;
use BI\manager\NotificationManager;
use BI\manager\OrgManager;
use DateInterval;
use DatePeriod;
use DateTime;
use entities\ApiKeysQuery;
use entities\AttendanceQuery;
use entities\Base\BrandCompetitionQuery;
use entities\Base\BrandsQuery;
use entities\BrandRcpaQuery;
use entities\ClassificationQuery;
use entities\DailycallsQuery;
use entities\DayplanQuery;
use entities\EmployeeLeaveBalanceQuery;
use entities\EmployeeQuery;
use entities\GeoTownsQuery;
use entities\HrUserDatesQuery;
use entities\IntegrationApiLogs;
use entities\MtpQuery;
use entities\OutletViewQuery;
use entities\RcpaSummaryQuery;
use entities\SgpiEmployeeBalanceQuery;
use entities\SurveyQuery;
use entities\SurveySubmited;
use entities\SurveySubmitedQuery;
use Exception;
use function Illuminate\Support\dd;
use Http\Request;
use Modules\ESS\Runtime\EssHelper;
use Modules\System\Processes\PolicyChecker;
use Modules\System\Processes\WorkflowManager;
use Propel\Runtime\ActiveQuery\Criteria;
use Respect\Validation\Validator as v;

class API extends \App\Core\BaseController

{

    protected $app;
    private $WfDoc = "Expenses";

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    /**
     * @OA\Get(
     *     path="/api/checkDatabaseURL",
     *     @OA\Response(response="200", description="An example resource")
     * )
     */
    public function checkDatabaseURL()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $data['logo'] = $this->app->Router()->baseUrl() . "media?id=" . $_ENV['defaultLogoMediaId'];
        $data['introductionScreenLogo'] = $this->app->Router()->baseUrl() . "media?id=" . $_ENV['defaultIntroductionScreenMediaId'];
        $data['migrtation'] = $_ENV['migrtation'];
        $data['app_customer_name'] = $_ENV['APP_CUSTOMER_NAME'] ?? '';
        if ($_ENV['migrtation'] == 'true') {
                $data['change_url'] = $_ENV['doMigrateUrl'];
        }
        $this->apiResponse($data, 200, "ok");
        break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/SendSms",
     *     tags={"Sms"},
     *     @OA\Response(
     *         response="200",
     *         description="OTP send successfully.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function SendSms()
    {
        $sendOTP = SendSms::sendRmlOtpMessage();
        $this->apiResponse(["data" => "OTP send successfully."], 200, "OTP send successfully.");
    }

    /**
     * @OA\Post(
     *     path="/api/loginwithmobile",
     *     tags={"User Management"},
     *     @OA\Parameter(
     *         name="isd_code",
     *         in="query",
     *         description="Country ISD Code",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="phone",
     *         in="query",
     *         description="Mobile Number",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="OTP send successfully.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function loginwithmobile()
    {
        if ($this->app->isPost()) {
            $this->Validate(v::stringVal()->notEmpty()->validate($this->app->Request()->getParameter("isd_code")), "Please enter the isd code", "isd_code");
            $this->Validate(v::phone()->notEmpty()->length(10, 15)->validate($this->app->Request()->getParameter("phone")), "Please enter valid phone number", "phone");
            $isdCode = $this->app->Request()->getParameter("isd_code");
            $phoneNumber = $this->app->Request()->getParameter("phone");
            $date = date('Y-m-d');
            $user = \entities\UsersQuery::create()
                ->filterByIsdCode($isdCode)
                ->filterByPhone($phoneNumber)
                ->findOne();

            if($user==null){
                return $this->apiResponse([], 400, "User Not Found.");
            }

            if($user->getStatus() == 0){
                return $this->apiResponse([], 400, "Your account is not yet activated.");
            }else{
                $employee = \entities\EmployeeQuery::create()
                            ->useHrUserDatesQuery()
                               ->filterByJoinDate($date, Criteria::GREATER_THAN)
                            ->endUse()
                            ->findPk($user->getEmployeeId());
                if($employee){
                    return $this->apiResponse([], 400, "You cannot login before your joining date.");
                }
            }

            if ($user != null) {
                $environment = $_ENV['environment'];
                if ($environment != "development") {
                    $otp = substr(str_shuffle("123456789"), 0, 6);
                    //$otp = 152535;
                    $user->setOtp($otp);
                    $user->save();
                    $sendOTP = SendSms::sendRmlOtpMessage($user->getOtp(), $phoneNumber);
                }
                return $this->apiResponse(["data" => "OTP send successfully."], 200, "OTP send successfully.");
            } else {
                return $this->apiResponse([], 400, "Please enter correct mobile number or contact admin. Mobile number unregistered");
            }
        }
    }

    /**
     * @OA\Post(
     *     path="/api/reSentOTP",
     *     tags={"User Management"},
     *     @OA\Parameter(
     *         name="isd_code",
     *         in="query",
     *         description="Country ISD Code",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="phone",
     *         in="query",
     *         description="Mobile Number",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="OTP send successfully.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function reSentOTP()
    {
        if ($this->app->isPost()) {
            $this->Validate(v::stringVal()->notEmpty()->validate($this->app->Request()->getParameter("isd_code")), "Please enter the isd code", "isd_code");
            $this->Validate(v::phone()->notEmpty()->length(10, 15)->validate($this->app->Request()->getParameter("phone")), "Please enter valid phone number", "phone");
            $isdCode = $this->app->Request()->getParameter("isd_code");
            $phoneNumber = $this->app->Request()->getParameter("phone");
            $user = \entities\UsersQuery::create()
                ->filterByIsdCode($isdCode)
                ->filterByPhone($phoneNumber)
                ->findOne();
            if ($user != null) {
                $environment = $_ENV['environment'];
                if ($environment != "development") {
                    $otp = substr(str_shuffle("123456789"), 0, 6);
                    //$otp = 152535;
                    $user->setOtp($otp);
                    $user->save();
                    $sendOTP = SendSms::sendRmlOtpMessage($user->getOtp(), $phoneNumber);
                }
                $this->apiResponse(["data" => "OTP send successfully."], 200, "OTP send successfully.");
            } else {
                $this->apiResponse([], 400, "Please enter correct mobile number or contact admin. Mobile number unregistered");
            }
        }
    }

    /**
     * @OA\Post(
     *     path="/api/verifyOtp",
     *     tags={"User Management"},
     *     @OA\Parameter(
     *         name="otp",
     *         in="query",
     *         description="OTP",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Parameter(
     *         name="phone",
     *         in="query",
     *         description="Phone Number",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="FcmToken",
     *         in="query",
     *         description="Fcm Token",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="DeviceName",
     *         in="query",
     *         description="Device Name",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="Device",
     *         in="query",
     *         description="Device Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="AppVersion",
     *         in="query",
     *         description="App Version",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="User login successfully",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function verifyOtp()
    {

        $this->Validate(v::number()->notEmpty()->length(6)->validate($this->app->Request()->getParameter("otp")), "Please enter the valid OTP", "otp");
        $this->Validate(v::phone()->notEmpty()->length(10, 15)->validate($this->app->Request()->getParameter("phone")), "Please enter valid phone number", "phone");
        $otp = $this->app->Request()->getParameter("otp");
        $phoneNumber = $this->app->Request()->getParameter("phone");
        $user = \entities\UsersQuery::create()
            ->filterByPhone($phoneNumber)
            ->findOne();
        if ($user == null) {
            $this->apiResponse(["login" => false, "data" => "User not found"], 400, "User not found");
            return;
        }

        if ($user->getOtp() == $otp || $otp == $_ENV['USER_DEFAULT_OTP']) {
            if ($this->app->Auth()->AuthoriseWithPhone($user, true)) {
                $u = $this->app->Auth()->getUser();
                $fcmtoken = $this->app->Request()->getParameter("FcmToken", "");
                $DeviceName = $this->app->Request()->getParameter("DeviceName", "");
                $Device = $this->app->Request()->getParameter("Device", "");
                $AppVersion = $this->app->Request()->getParameter("AppVersion", "");
                $u->setOtp("");
                $u->save();

                $us = \entities\UserSessionsQuery::create()
                    ->filterBySessionToken($u->getAppToken())
                    ->findOne();
                if (!$us == null && $fcmtoken != "") {

                    $us->setFcmToken($fcmtoken);
                    $us->setDeviceName($DeviceName);
                    $us->setDevice($Device);
                    $us->setAppVersion($AppVersion);
                    $us->save();
                }

                $data = \entities\UsersQuery::create()->findPk($u->getUserId());
                $employee = \entities\EmployeeQuery::create()->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->joinWithBranch()->joinWithOrgUnit()->joinWithDesignations()->joinWithGradeMaster()->filterByEmployeeId($data->getEmployeeId())->find()->toArray();
                $isEmployeeTopLevel = [];
                if ($this->app->Auth()->getUser()->getEmployeeId() != null) {
                    $isEmployeeTopLevel = \Modules\ESS\Runtime\EssHelper::isEmployeeTopLevel($this->app->Auth()->getUser()->getEmployee());
                } else {
                    $this->apiResponse(["login" => false], 400, "Employee Not Found");
                }
                $rcpa = [
                    'can_conduct_rcpa',
                ];
                $company = \entities\CompanyQuery::create()->select('Googlemapkey')->filterByCompanyId($this->app->Auth()->CompanyId())->findOne();
                $this->apiResponse([
                    "login" => true,
                    "AppToken" => $u->getAppToken(),
                    "data" => $data->toArray(),
                    "employee" => $employee,
                    "scope" => $this->app->Auth()->getPerms(),
                    "scope_new" => $rcpa,
                    "GoogleMapApiKey" => $company,
                    "isEmployeeTopLevel" => $isEmployeeTopLevel,
                ], 200, "Login OK !!");
            } else {
                $this->apiResponse(["login" => false, "data" => $this->app->Auth()->getError()], 100, "OTP or Mobile number is incorrect");
            }
        } else {
            $this->apiResponse([], 400, "OTP Invalid !!");
        }
    }

    /**
     * @OA\Get(
     *     path="/api/getUserCliams",
     *     tags={"User Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get user cliams successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function getUserCliams()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $user = $this->app->Auth()->getUser();
        if ($user) {
                $permission = $this->app->Auth()->getPerms();
                if (count($permission) >= 0) {
                    $this->apiResponse(["cliams" => $permission], 200, "Get user cliams successfully!");
                } else {
                    $this->apiResponse([], 404, "User cliams not found!");
                }
        } else {
            $this->apiResponse([], 404, "User not found!");
        }
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/logout",
     *     tags={"User Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Use logged out successfully",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function logout()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":

        try {
            $apptoken = $_SERVER['HTTP_APPTOKEN'];
            $attendencehelper = new \Modules\ESS\Runtime\AttendanceHelper($this->app);
            $attendencehelper->userSessionActivityLog("Logout",$apptoken);
                $this->app->Auth()->logout();
        } catch (Exception $e) {
        }
        $this->apiResponse([], 200, "Logout Successfully.");

        //$userSessionToken = $_SERVER['HTTP_APPTOKEN'];
        //if ($userSessionToken != null && $userSessionToken != '') {
        //$query = \entities\UserSessionsQuery::create()->filterBySessionToken($userSessionToken)->delete();

        //} else {
        //  $this->apiResponse([], 404, "User not found!");
        //}
        break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/punchin",
     *     tags={"User Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="punchin_date",
     *         in="query",
     *         description="Punch In Date",
     *         @OA\Schema(type="string")
     *     ),
     *          @OA\Parameter(
     *         name="punchin_time",
     *         in="query",
     *         description="Punch In Time",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="latlnt",
     *         in="query",
     *         description="Lat Lng",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="location",
     *         in="query",
     *         description="Location Name",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="start_itownid",
     *         in="query",
     *         description="Town Id",
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
    public function punchin()
    {
        switch ($this->app->Request()->getMethod()):
    case "POST":
        if ($this->app->Auth()->getUser()->getEmployee()->getIslocked()) {
                $this->apiResponse([], 400, "Reason : " . $this->app->Auth()->getUser()->getEmployee()->getLockedreason());
                return;
        }
        //$this->Validate(v::stringVal()->notEmpty()->validate($this->app->Request()->getParameter("latlnt")), "Please enter the LatLnt", "latlnt");
        $this->Validate(v::stringVal()->notEmpty()->validate($this->app->Request()->getParameter("location")), "Please enter the Location", "location");
        $empID = $this->app->Auth()->getUser()->getEmployeeId();
        $location_pin = $this->app->Request()->getParameter("latlnt");
        $location_name = $this->app->Request()->getParameter("location");
        $punchin_date = $this->app->Request()->getParameter("punchin_date");
        $punchin_time = $this->app->Request()->getParameter("punchin_time");
        $startItownId = $this->app->Request()->getParameter("start_itownid", null);

        $apptoken = $_SERVER['HTTP_APPTOKEN'];
        $attendencehelper = new \Modules\ESS\Runtime\AttendanceHelper($this->app);
        try {
            $resp = $attendencehelper->Punch_in($empID, $location_pin, $location_name, $punchin_date, $punchin_time, $startItownId, $apptoken);
            $this->apiResponse($resp, 200, "Punch in Successfully.");
        } catch (Exception $e) {
            $this->apiResponse([], 400, $e->getMessage());
        }
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/attendance_report",
     *     tags={"Attendance Report"},
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
     *         description="Moye",
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="position_id",
     *         in="query",
     *         description="Position Id",
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

    public function attendanceReport()
    {
        $moye = $this->app->Request()->getParameter("moye");
        $empId = $this->app->Request()->getParameter("position_id");
        if ($empId == null) {
            $employeeId = $this->app->Auth()->getUser()->getEmployeeId();
            $positionId = $this->app->Auth()->getUser()->getEmployee()->getPositionId();
        } else {
            $employee = EmployeeQuery::create()->filterByPositionId($empId)->filterByStatus(1)->findOne();
            $employeeId = $employee->getEmployeeId();
            $positionId = $empId;
        }

        if ($moye == null) {
            $moye = date('m-Y');
        }
        //list($month, $year) = explode('-', $moye);

        //$startDay = 1;
        //$endDay = date('t', strtotime("$year-$month-$startDay")); // Get the last day of the month

        $dateArray = [];

        // for ($day = $startDay; $day <= $endDay; $day++) {
        //     $dateArray[] = sprintf('%04d-%02d-%02d', $year, $month, $day);
        // }

        $month = explode('-', $moye);
        $startDate = $month[1] . '-' . $month[0] . '-' . '01';
        $endDate = date($month[1] . '-' . $month[0] . '-' . 't');

        $dateArray = AttendanceQuery::create()
            ->select(['AttendanceDate'])
            ->filterByAttendanceDate($startDate, Criteria::GREATER_EQUAL)
            ->filterByAttendanceDate($endDate, Criteria::LESS_EQUAL)
            ->filterByEmployeeId($employeeId)
            ->filterByStatus(1)
            ->find()->toArray();

        $nca = 0;
        $fw = 0;

        $holidaydate = [];
        $holidays = \entities\HolidaysQuery::create()
            ->filterByIstateid($this->app->Auth()->getUser()->getEmployee()->getBranch()->getIstateid())
            ->findByCompanyId($this->app->Auth()->CompanyId());
        foreach ($holidays as $holiday) {
            $holidaydate[] = $holiday->getHolidayDate()->format('Y-m-d');
        }

        // 1 day = 24 hours
        // 24 * 60 * 60 = 86400 seconds

        $leaveDates = \entities\LeavesQuery::create()
            ->select(['LeaveDate'])
            ->filterByLeaveDate($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
            ->filterByLeaveDate($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
            ->filterByLeavePoints(0, \Propel\Runtime\ActiveQuery\Criteria::GREATER_THAN)
            ->filterByEmployeeId($employeeId)
            ->filterBYLeaveRequestId(null, Criteria::NOT_EQUAL)
            ->find()->toArray();

        foreach ($dateArray as $date) {

            if (in_array($date, $leaveDates)) {
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
                ->filterByPositionId($positionId)
                ->filterByDcrDate($date)
                ->filterByAgendacontroltype("FW")
                ->groupByAgendacontroltype()
                ->findOne();

            $NCAdailyCalls = DailycallsQuery::create()
                ->select(['agendacontroltype'])
                ->withColumn('Count(*)', 'count')
                ->filterByPositionId($positionId)
                ->filterByDcrDate($date)
                ->filterByAgendacontroltype("NCA")
                ->groupByAgendacontroltype()
                ->findOne();

            if ($fwdailyCalls != null && $NCAdailyCalls != null) {
                $fw += 0.5;
                $nca += 0.5;
            } elseif ($fwdailyCalls != null && $NCAdailyCalls == null) {
                $fw += 1;
            } elseif ($fwdailyCalls == null && $NCAdailyCalls != null) {
                $nca += 1;
            }
        }

        //        $data['working_days'] = $totalDays;
        $data['leave'] = count($leaveDates);
        $data['fw'] = $fw;
        $data['NCA'] = $nca;
        $this->apiResponse($data, 200, "Attendance Report Retrieved Successfully.");
    }

    /**
     * @OA\Get(
     *     path="/api/rcpa_report",
     *     tags={"RCPA Report"},
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
     *         description="Moye",
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
     *         description="ResponseObj",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */

    public function repaReport()
    {
        $moye = $this->app->Request()->getParameter("moye");
        $empId = $this->app->Request()->getParameter("employee_id");
        if ($empId == null) {
            $employeeId = $this->app->Auth()->getUser()->getEmployeeId();
        } else {
            $employeeId = $empId;
        }

        $emp = EmployeeQuery::create()
            ->findPk($employeeId);
        //        var_dump($emp);exit;

        $ter = OrgManager::getMyTerritories($emp);
        //        var_dump($ter);exit;

        $rcpas = RcpaSummaryQuery::create()
            ->filterByRcpaMoye($moye)
            ->filterByTerritoryId($ter)
        //            ->filterByCompetition(0)
            ->filterByOwn(0, Criteria::GREATER_THAN)
            ->find()->toArray();
        $value = 0;
        $prescibers = 0;
        $rcpArr = [];
        $resultArray = [];
        foreach ($rcpas as $rcpa) {

            $value += $rcpa['Own'];

            if ($rcpa['Own'] >= $rcpa['MinValue']) {
                $rcpArr[] = $rcpa;
            }
        }
        foreach ($rcpArr as $item) {
            $outletId = $item['OutletId'];

            // If the outlet_id is already in the result array, increment the count
            if (isset($resultArray[$outletId])) {
                $resultArray[$outletId]['count'] += 1;
            } else {
                // If outlet_id is not in the result array, create a new entry
                $resultArray[$outletId] = [
                    'outlet_id' => $outletId,
                    'count' => 1,
                ];
            }
        }
        $data['total_rcpa_value'] = number_format($value, 2, '.', '');
        $data['total_prescribers'] = count($resultArray);
        $this->apiResponse($data, 200, "RCPA Report Retrieved Successfully.");
    }

    /**
     * @OA\Get(
     *     path="/api/get_dates",
     *     tags={"Pie Chart"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="start_date",
     *         in="query",
     *         description="Start Date",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="end_date",
     *         in="query",
     *         description="End Date",
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

    public function getDates()
    {
        $startDate = $this->app->Request()->getParameter("start_date");
        $endDate = $this->app->Request()->getParameter("end_date");

        $array = array();

        // Variable that store the date interval
        // of period 1 day
        $interval = new DateInterval('P1D');
        $format = 'Y-m-d';

        $realEnd = new DateTime($endDate);
        $realEnd->add($interval);

        $period = new DatePeriod(new DateTime($startDate), $interval, $realEnd);

        // Use loop to store date into array
        foreach ($period as $date) {
            $array[] = $date->format($format);
        }
        $this->apiResponse($array, 200, "Dates Retrieved Successfully");
    }

    /**
     * @OA\Get(
     *     path="/api/rcpa_bifurcation",
     *     tags={"RCPA Report"},
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
     *         description="Moye",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="classification",
     *         in="query",
     *         description="Classification",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="brand_id",
     *         in="query",
     *         description="Brand Id",
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="ter_id",
     *         in="query",
     *         description="Territory Id",
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

    public function rcpabifurcation()
    {
        $moye = $this->app->Request()->getParameter("moye");
        $classificaion = $this->app->Request()->getParameter("classification");
        $brandId = $this->app->Request()->getParameter("brand_id", "All");
        if ($moye == null) {
            $moye = date('m-Y');
        }
        $terId = $this->app->Request()->getParameter("ter_id");
        if ($terId == null) {
            $terId = OrgManager::getMyTerritories($this->app->Auth()->getUser()->getEmployee());
        }

        if ($classificaion == null) {
            $rcpas = RcpaSummaryQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            //                ->select(['Own', 'OutletClassification'])
                ->filterByTerritoryId($terId)
                ->filterByRcpaMoye($moye)
            //                ->filterByCompetition(0)
                ->filterByOwn(0, Criteria::GREATER_THAN);
            if ($brandId != "All") {
                $rcpas->filterByBrandId($brandId);
            }
            $rcpas = $rcpas->find()->toArray();

            /*var_dump($rcpas);
            exit;*/
            $arr = [];
            foreach ($rcpas as $rcpa) {
                if (!in_array($rcpa['OutletClassification'], $arr)) {
                    $arr[] = $rcpa['OutletClassification'];
                }
            }
            $value = 0;
            $totalScribers = 0;
            $rcpArr = [];
            $resultArray = [];
            foreach ($rcpas as $rcpa) {

                $value += $rcpa['Own'];

                if ($rcpa['Own'] >= $rcpa['MinValue']) {
                    $totalScribers += 1;
                    $rcpArr[] = $rcpa;
                }
            }
            foreach ($rcpArr as $item) {
                $outletId = $item['OutletId'];

                if ($rcpa['Own'] >= $rcpa['MinValue']) {

                    // If the outlet_id is already in the result array, increment the count
                    if (isset($resultArray[$outletId])) {
                        $resultArray[$outletId]['count'] += 1;
                    } else {
                        // If outlet_id is not in the result array, create a new entry
                        $resultArray[$outletId] = [
                            'outlet_id' => $outletId,
                            'count' => 1,
                        ];
                    }

                }

            }

            $array = [];
            $data = [];
            $scribers = [];
            $scriberArr = [];

            foreach ($arr as $ar) {
                $classification = ClassificationQuery::create()
                    ->filterById($ar)
                    ->findOne();
                $classRcpa = RcpaSummaryQuery::create()
                    ->filterByTerritoryId($terId)
                    ->filterByRcpaMoye($moye)
                //                    ->filterByCompetition(0)
                    ->filterByOwn(0, Criteria::GREATER_THAN)
                    ->filterByOutletClassification($ar);

                if ($brandId != "All") {
                    $classRcpa->filterByBrandId($brandId);
                }
                $classRcpa = $classRcpa->find()->toArray();

                $clVal = 0;
                foreach ($classRcpa as $cl) {

                    $clVal += $cl['Own'];

                    if ($cl['Own'] >= $cl['MinValue']) {

                    }
                }

                $array['name'] = $classification->getClassification();
                $array['percentage'] = 0;
                if ($clVal > 0 && $value > 0) {

                    $array['percentage'] = number_format($clVal * 100 / $value, 2);
                }
                $data[] = $array;
            }
            //            var_dump($arr);exit;

            foreach ($arr as $ad) {
                $name = ClassificationQuery::create()
                    ->filterById($ad)
                    ->findOne();
                $d = RcpaSummaryQuery::create()
                    ->filterByTerritoryId($terId)
                    ->filterByRcpaMoye($moye)
                    ->filterByOwn(0, Criteria::GREATER_THAN)
                    ->filterByOutletClassification($ad);
                if ($brandId != "All") {
                    $d->filterByBrandId($brandId);
                }
                $d = $d->find()->toArray();

                $clScribers = 0;
                foreach ($d as $ds) {
                    if ($ds['Own'] >= $ds['MinValue']) {
                        $clScribers += 1;
                    }
                }

                $scribers['name'] = $name->getClassification();
                $scribers['percentage'] = 0;
                if ($clScribers > 0 && $totalScribers > 0) {

                    $scribers['percentage'] = number_format($clScribers * 100 / $totalScribers, 2);
                }
                $scriberArr[] = $scribers;
            }
            $totalRcpa['rcpa_total'] = $value;
            $totalRcpa['rcpa_classification'] = $data;
            $totalRcpa['rcpa_prescribers_classification'] = $scriberArr;
            $totalRcpa['total_prescribers'] = count($resultArray);
        } else {
            $rcpas = RcpaSummaryQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->filterByTerritoryId($terId)
                ->filterByRcpaMoye($moye)
            //                ->filterByCompetition(0)
                ->filterByOwn(0, Criteria::GREATER_THAN)
                ->filterByOutletClassification($classificaion);

            if ($brandId != "All") {
                $rcpas->filterByBrandId($brandId);
            }
            $rcpas = $rcpas->find()->toArray();
            $value = 0;
            $scr = 0;
            $rcpArr = [];
            $resultArray = [];

            foreach ($rcpas as $rcpa) {

                $value += $rcpa['Own'];
                if ($rcpa['Own'] >= $rcpa['MinValue']) {
                    $rcpArr[] = $rcpa;
                }
            }

            foreach ($rcpArr as $item) {

                $outletId = $item['OutletId'];
                if ($rcpa['Own'] >= $rcpa['MinValue']) {
                    // If the outlet_id is already in the result array, increment the count
                    if (isset($resultArray[$outletId])) {
                        $resultArray[$outletId]['count'] += 1;
                    } else {
                        // If outlet_id is not in the result array, create a new entry
                        $resultArray[$outletId] = [
                            'outlet_id' => $outletId,
                            'count' => 1,
                        ];
                    }
                }
            }
            $classific = ClassificationQuery::create()
                ->filterById($classificaion)
                ->findOne()->toArray();
            $class = [];
            if (count($rcpas) > 0) {
                $class = [
                    "name" => $classific['Classification'],
                    "percentage" => "100",
                ];
            }
            $totalRcpa['rcpa_total'] = number_format($value, 2);
            $totalRcpa['rcpa_classification'] = $class;
            $totalRcpa['rcpa_prescribers_classification'] = $class;
            $totalRcpa['total_prescribers'] = count($resultArray);
        }
        $this->apiResponse($totalRcpa, 200, "RCPA Report Retrieved Successfully.");
    }

    /*public function rcpabifurcation()
    {
    $startDate = $this->app->Request()->getParameter("start_date");
    $endDate = $this->app->Request()->getParameter("end_date");
    $empId = $this->app->Request()->getParameter("employee_id");
    if ($empId == null) {
    $employeeId = $this->app->Auth()->getUser()->getEmployeeId();
    } else {
    $employeeId = $empId;
    }
    $terID = OrgManager::getMyTerritories($employeeId);

    $tag = $this->app->Request()->getParameter("tag");
    if ($tag == null) {

    $rcpas = RcpaSummaryQuery::create()
    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
    ->joinWith('BrandRcpa.Outlets')
    ->joinWith('Outlets.Classification')
    ->filterByTerritoryId($terID)
    ->filterByCreatedAt($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
    ->filterByCreatedAt($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
    ->filterByCompetitorId(0)
    ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
    ->find()->toArray();

    $arr = [];
    $count = 0;
    $prescribersCount = 0;
    $scribers = [];
    foreach ($rcpas as $rcpa) {
    if (isset($rcpa['Outlets']['Classification']) && !in_array([$rcpa['Outlets']['Classification']["Classification"]], $arr)) {
    $scribers[$rcpa['Outlets']['Classification']["Classification"]] = $prescribersCount;
    }
    }
    foreach ($rcpas as $rcpa) {
    if (isset($rcpa['Outlets']['Classification']) && !in_array([$rcpa['Outlets']['Classification']["Classification"]], $arr)) {
    $arr[$rcpa['Outlets']['Classification']["Classification"]] = $count;
    }
    }
    foreach ($rcpas as $rcpa) {
    if (isset($rcpa['Outlets']['Classification']) && array_key_exists($rcpa['Outlets']['Classification']["Classification"], $arr)) {
    $arr[$rcpa['Outlets']['Classification']["Classification"]] += $rcpa['own'];
    }
    }
    foreach ($rcpas as $rcpa) {
    if (isset($rcpa['Outlets']['Classification']) && array_key_exists($rcpa['Outlets']['Classification']["Classification"], $scribers)) {
    $scribers[$rcpa['Outlets']['Classification']["Classification"]] += 1;
    }
    }
    $scrbersData = [];
    $data = [];
    $array = [];
    $value = 0;
    foreach ($rcpas as $rcpa) {
    $value += $rcpa['RcpaValue'];
    }
    foreach ($arr as $key => $ar) {
    $array["name"] = $key;
    $array["percentage"] = round($ar * 100 / $value, 2);
    $data[] = $array;

    }

    foreach ($scribers as $key => $sr) {
    $array["name"] = $key;
    $array["percentage"] = round($sr * 100 / count($rcpas), 2);
    $scrbersData[] = $array;

    }
    $totalRcpa['rcpa_total'] = $value;
    $totalRcpa['rcpa_classification'] = $scrbersData;
    $totalRcpa['rcpa_prescribers_classification'] = $data;
    $prescribers = BrandRcpaQuery::create()
    ->filterByEmployeeId($employeeId)
    ->filterByCreatedAt($startDate, Criteria::GREATER_EQUAL)
    ->filterByCreatedAt($endDate, Criteria::LESS_EQUAL)
    ->filterByCompetitorId(0)
    ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
    ->find();
    $value = 0;
    foreach ($rcpas as $rcpa) {
    $value += $rcpa['RcpaValue'];
    }
    $totalRcpa['total_prescribers'] = count($prescribers);

    } else {
    $rcpaArray = BrandRcpaQuery::create()
    //            ->select(["BrandRcpa.Outlet"])
    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
    ->joinWith('BrandRcpa.Outlets')
    ->joinWith('Outlets.Classification')
    ->filterByEmployeeId($employeeId)
    ->filterByCreatedAt($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
    ->filterByCreatedAt($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
    ->filterByCompetitorId(0)
    ->filterByCompanyId($this->app->Auth()->CompanyId())
    ->find()->toArray();
    $rcpas = [];
    foreach ($rcpaArray as $rcpa) {
    if ($tag == $rcpa['Outlets']['Classification']['Id']) {
    $rcpas[] = $rcpa;
    }
    }
    $value = 0;
    foreach ($rcpas as $rc) {
    $value += $rc['RcpaValue'];
    }
    $classific = ClassificationQuery::create()
    ->filterById($tag)
    ->findOne()->toArray();
    $classification = [];
    if (count($rcpas) > 0) {
    $classification = [
    "name" => $classific['Classification'],
    "percentage" => "100",
    ];
    }
    $totalRcpa['rcpa_total'] = $value;
    $totalRcpa['rcpa_classification'] = $classification;
    $totalRcpa['rcpa_prescribers_classification'] = $classification;
    $totalRcpa['total_prescribers'] = count($rcpas);
    }
    $this->apiResponse($totalRcpa, 200, "RCPA Report Retrieved Successfully.");
    }*/

    /**
     * @OA\Get(
     *     path="/api/rcpa_chemist_prescription_audit",
     *     tags={"RCPA Report"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="start_date",
     *         in="query",
     *         description="Start Date",
     *          required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="end_date",
     *         in="query",
     *         description="End Date",
     *          required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="employee_id",
     *         in="query",
     *         description="Employee Id",
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="brand_id",
     *         in="query",
     *         description="Brand Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_tag_id",
     *         in="query",
     *         description="Outlet Tag",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="classification",
     *         in="query",
     *         description="Classificaation",
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

    public function retailChemistPrescriptionAudit()
    {
        $startDate = $this->app->Request()->getParameter("start_date");
        $endDate = $this->app->Request()->getParameter("end_date");
        $brand_id = $this->app->Request()->getParameter("brand_id", "All");
        $classification = $this->app->Request()->getParameter("classification", "All");
        $employeeId = $this->app->Request()->getParameter("employee_id", $this->app->Auth()->getUser()->getEmployeeId());
        $outletTag = $this->app->Request()->getParameter("outlet_tag_id", "All");
        $emp = EmployeeQuery::create()
            ->findPk($employeeId);
        //        var_dump($emp);exit;

        $ter = OrgManager::getMyTerritories($emp);
        //        var_dump($ter);exit;

        $outletView = [];
        if ($outletTag != "All") {
            $outletView = OutletViewQuery::create()
                ->select(['Outlet_Id'])
                ->filterByTags($outletTag . "%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)
                ->find()->toArray();
        }

        $arr = [];
        $start = new DateTime($startDate);
        $start->modify('first day of this month');
        $end = new DateTime($endDate);
        $end->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 month');
        $period = new DatePeriod($start, $interval, $end);

        foreach ($period as $dt) {
            $arr[] = $dt->format("m-Y");
        }

        $rcpaArray = [];
        $totalArray = [];
        foreach ($arr as $ar) {
            /* $start = date('Y-' . $ar . '-' . '01');
            $end = date('Y-' . $ar . '-' . '30');
            $month = date('M,Y', strtotime($start));*/

            /*$ownArray = BrandRcpaQuery::create()
            ->filterByEmployeeId($employeeId)
            ->filterByCreatedAt($start, Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($end, Criteria::LESS_EQUAL)
            ->filterByCompetitorId(0)
            ->filterByCompanyId($this->app->Auth()->CompanyId());*/

            $ownArray = RcpaSummaryQuery::create()->filterByTerritoryId($ter)->filterByRcpaMoye($ar)->filterByOwn(0, Criteria::GREATER_THAN);

            if ($brand_id != "All") {
                $ownArray->filterByBrandId($brand_id);
            }

            if ($outletTag != "All") {
                $ownArray->filterByOutletId($outletView);
            }

            if ($classification != "All") {
                $ownArray->filterByOutletClassification($classification);
            }
            $ownArray = $ownArray->find()->toArray();

            $classificationArray = RcpaSummaryQuery::create()->filterByTerritoryId($ter)->filterByRcpaMoye($ar)->filterByCompetition(0, Criteria::GREATER_THAN);

            if ($brand_id != "All") {
                $classificationArray->filterByBrandId($brand_id);
            }

            if ($outletTag != "All") {
                $classificationArray->filterByOutletId($outletView);
            }

            if ($classification != "All") {
                $classificationArray->filterByOutletClassification($classification);
            }
            $classificationArray = $classificationArray->find()->toArray();

            $ownValue = 0;
            $pres = 0;
            $rcpArr = [];
            $resultArray = [];
            foreach ($ownArray as $oVal) {
                $ownValue += $oVal['Own'];
                if ($oVal['Own'] >= $oVal['MinValue']) {
                    $rcpArr[] = $oVal;
                }
            }
            foreach ($rcpArr as $item) {
                $outletId = $item['OutletId'];

                // If the outlet_id is already in the result array, increment the count
                if (isset($resultArray[$outletId])) {
                    $resultArray[$outletId]['count'] += 1;
                } else {
                    // If outlet_id is not in the result array, create a new entry
                    $resultArray[$outletId] = [
                        'outlet_id' => $outletId,
                        'count' => 1,
                    ];
                }
            }
            //            var_dump(count($resultArray));exit;
            $comValue = 0;
            foreach ($classificationArray as $cVal) {

                $comValue += $cVal['Competition'];
            }

            $rcpaArray['own'] = $ownValue;
            $rcpaArray['competitiors'] = $comValue;
            $rcpaArray['prescribers'] = count($resultArray);
            $totalArray[$ar] = $rcpaArray;
        }
        $ownComArr = [];
        $totalOwnArr = [];
        foreach ($totalArray as $key => $tot) {
            $ownComArr['month'] = $key;
            $formattedOwn = number_format(intval($tot['own']), 2);
            $ownComArr['own'] = str_replace(['"', ','], '', $formattedOwn);
            $totalOwnArr[] = $ownComArr;
        }
        $comOwnArr = [];
        $comComArr = [];
        foreach ($totalArray as $key => $tot) {
            $comOwnArr['month'] = $key;
            $formattedCompetitors = number_format(intval($tot['competitiors']), 2);
            $comOwnArr['competitiors'] = str_replace(['"', ','], '', $formattedCompetitors);
            $comComArr[] = $comOwnArr;
        }
        $preArr = [];
        $prepreArr = [];
        foreach ($totalArray as $key => $tot) {
            $preArr['month'] = $key;
            $formattedPrescibers = number_format(intval($tot['prescribers']), 2);
            $preArr['prescribers'] = str_replace(['"', ','], '', $formattedPrescibers);
            $prepreArr[] = $preArr;
        }
        $data['own'] = $totalOwnArr;
        $data['competitiors'] = $comComArr;
        $data['prescribers'] = $prepreArr;
        $this->apiResponse($data, 200, "Data Retrieved Successfully.");
    }

    /**
     * @OA\Get(
     *     path="/api/rcpa_own_vs_competitior",
     *     tags={"RCPA Report"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="start_date",
     *         in="query",
     *         description="Start Date",
     *          required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="end_date",
     *         in="query",
     *         description="End Date",
     *          required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="employee_id",
     *         in="query",
     *         description="Employee Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="brand_id",
     *         in="query",
     *         description="Brand Id",
     *          required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="classification",
     *         in="query",
     *         description="Classificaation",
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
    public function rcpavsownCompetitior()
    {
        $startDate = $this->app->Request()->getParameter("start_date");
        $endDate = $this->app->Request()->getParameter("end_date");
        $brand_id = $this->app->Request()->getParameter("brand_id");
        $classification = $this->app->Request()->getParameter("classification");
        $employeeId = (int) $this->app->Request()->getParameter("employee_id", $this->app->Auth()->getUser()->getEmployeeId());
        if ($classification == null) {
            $rcpa = \entities\BrandRcpaQuery::create()
                ->joinWith('BrandRcpa.Outlets')
                ->joinWith('Outlets.Classification')
                ->filterByEmployeeId($employeeId)
                ->filterByCreatedAt($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_THAN)
                ->filterByCreatedAt($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_THAN)
                ->filterByBrandId($brand_id)
                ->filterByCompetitorId(0, \Propel\Runtime\ActiveQuery\Criteria::GREATER_THAN)
                ->find()->toArray();
        } else {
            $rcpa = \entities\BrandRcpaQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->joinWith('BrandRcpa.Outlets')
                ->joinWith('Outlets.Classification')
                ->filterByEmployeeId($employeeId)
                ->filterByCreatedAt($startDate, Criteria::GREATER_THAN)
                ->filterByCreatedAt($endDate, Criteria::LESS_THAN)
                ->filterByBrandId($brand_id)
                ->useOutletsQuery()
                ->useClassificationQuery()
                ->filterById($classification)
                ->endUse()
                ->endUse()
                ->filterByCompetitorId(0, Criteria::GREATER_THAN)
                ->find()->toArray();
        }
        $totalRacpas = BrandRcpaQuery::create()
            ->filterByBrandId($brand_id)
            ->filterByEmployeeId($employeeId)
            ->filterByCreatedAt($startDate, Criteria::GREATER_EQUAL)
            ->filterByCreatedAt($endDate, Criteria::LESS_EQUAL)
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find()->toArray();
        $value = 0;
        foreach ($totalRacpas as $rcpat) {
            $value += $rcpat['RcpaValue'];
        }
        $comValue = 0;
        foreach ($rcpa as $arr) {
            $comValue += $arr['RcpaValue'];
        }
        $comRcpaValue = [];
        $totalComArr = [];
        foreach ($rcpa as $total) {
            $competitor = BrandCompetitionQuery::create()
                ->filterByCompetitorId($total['CompetitorId'])
                ->findOne()
                ->toArray();
            $comRcpaValue['rcpaValue'] = $total['RcpaValue'];
            $comRcpaValue['rcpa_percentage'] = round($total['RcpaValue'] * 100 / $comValue, 2);
            $comRcpaValue['competitor_name'] = $competitor['CompetitorName'];
            $totalComArr[] = $comRcpaValue;
        }

        if ($classification == null) {
            $own = BrandRcpaQuery::create()
                ->joinWithBrands()
                ->joinWith('BrandRcpa.Outlets')
                ->joinWith('Outlets.Classification')
                ->filterByEmployeeId($employeeId)
                ->filterByBrandId($brand_id)
                ->filterByCreatedAt($startDate, Criteria::GREATER_EQUAL)
                ->filterByCreatedAt($endDate, Criteria::LESS_EQUAL)
                ->filterByCompetitorId(0)
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->find()->toArray();
        } else {
            $own = BrandRcpaQuery::create()
                ->joinWithBrands()
                ->joinWith('BrandRcpa.Outlets')
                ->joinWith('Outlets.Classification')
                ->filterByEmployeeId($employeeId)
                ->filterByCreatedAt($startDate, Criteria::GREATER_EQUAL)
                ->filterByCreatedAt($endDate, Criteria::LESS_EQUAL)
                ->filterByBrandId($brand_id)
                ->useOutletsQuery()
                ->useClassificationQuery()
                ->filterById($classification)
                ->endUse()
                ->endUse()
                ->filterByCompetitorId(0)
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->find()->toArray();
        }
        $ownVal = 0;
        foreach ($own as $val) {
            $ownVal += $val['RcpaValue'];
        }
        $brand = \entities\BrandsQuery::create()
            ->filterByBrandId($brand_id)
            ->findOne()->toArray();

        if ($comValue == 0 || $value == 0) {
            $per = 0;
        } else {
            $per = $comValue * 100 / $value;
        }

        if ($ownVal == 0 || $value == 0) {
            $ownPer = 0;
        } else {
            $ownPer = $ownVal * 100 / $value;
        }

        $data['competitor_data'] = $totalComArr;
        $data['competitor_value'] = $comValue;
        $data['competitor_percentage'] = round($per, 2);
        $data['brand_name'] = $brand['BrandName'];
        $data['own_value'] = $ownVal;
        $data['percentage'] = round($ownPer, 2);
        $this->apiResponse($data, 200, "Data Retrieved Successfully.");
    }

    /**
     * @OA\Get(
     *     path="/api/prescriber_ladder",
     *     tags={"RCPA Report"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="classification",
     *         in="query",
     *         description="Classificaation",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="outlet_tag_id",
     *         in="query",
     *         description="Outlet Tag",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="territory_id",
     *         in="query",
     *         description="Territory Id Add",
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
    public function prescriberLadder()
    {
        ini_set('memory_limit', '-1');
        
        $classification = $this->app->Request()->getParameter("classification", "All");
        $outletTag = $this->app->Request()->getParameter("outlet_tag_id", "All");
        $ter = $this->app->Request()->getParameter("territory_id");
        if ($ter != null) {
            $terId = $ter;
        } else {
            $orgManger = OrgManager::getMyTerritories($this->app->Auth()->getUser()->getEmployee());
            $terId = $orgManger;
        }

        //getting outlet_id for territory

        $date = date('m-Y');
        $outletView = [];
        if ($outletTag != "All") {
            $outletView = OutletViewQuery::create()
                ->select(['Outlet_Id'])
                ->filterByTags($outletTag . "%", \Propel\Runtime\ActiveQuery\ModelCriteria::LIKE)
                ->find()->toArray();
        }
        //        var_dump($outletView);exit;

        // getting raxers outlet
        if ($classification == "All") {

            $rcpaData = RcpaSummaryQuery::create()
                ->select(['outlet_id', 'min_value', 'own', 'RcpaMoye', 'OutletClassification'])
                ->withColumn('COUNT(*)', 'count')
                ->filterByTerritoryId($terId)
                ->filterByRcpaMoye($date)
                ->filterByOwn(0, Criteria::GREATER_THAN)
                ->groupByOutletId()
                ->orderBy('count');

            if ($outletTag != "All") {
                $rcpaData->filterByOutletId($outletView);
            }
            $rcpaData = $rcpaData->find()
                ->toArray();
        } else {
            $rcpaData = RcpaSummaryQuery::create()
                ->select(['outlet_id', 'min_value', 'own'])
                ->withColumn('COUNT(*)', 'count')
                ->filterByTerritoryId($terId)
                ->filterByRcpaMoye($date)
                ->filterByOutletClassification($classification)
                ->filterByOwn(0, Criteria::GREATER_THAN)
            //                ->filterByOwn(null, Criteria::NOT_EQUAL)
            //                ->filterByCompetition(0)
                ->groupByOutletId()
                ->orderBy('count');

            if ($outletTag != "All") {
                $rcpaData->filterByOutletId($outletView);
            }
            $rcpaData = $rcpaData->find()
                ->toArray();
        }

        $rcpas = [];
        foreach ($rcpaData as $rc) {
            if ($rc['own'] >= $rc['min_value']) {
                $rcpas[] = $rc;
            }
        }
        //        var_dump(count($rcpas));exit;

        // Initialize an empty result array
        $resultArray = [];

        // Loop through the input array
        foreach ($rcpas as $item) {
            $outletId = $item['outlet_id'];

            // If the outlet_id is already in the result array, increment the count
            if (isset($resultArray[$outletId])) {
                $resultArray[$outletId]['count'] += 1;
            } else {
                // If outlet_id is not in the result array, create a new entry
                $resultArray[$outletId] = [
                    'outlet_id' => $outletId,
                    'count' => 1,
                ];
            }
        }

        $outlets = OutletViewQuery::create()
            ->filterByTerritoryId($terId)->filterByOutlettypeName("Doctor");

        if ($classification != "All") {
            $outlets->filterByOutletClassification($classification);
        }

        if ($outletTag != "All") {
            $outlets->filterByOutlet_Id($outletView);
        }
        $outlets = $outlets->find()
            ->toArray();
        $months = [];
        for ($i = 0; $i <= 2; $i++) {
            $months[] = date("m-Y", strtotime(date('Y-m-01') . " -$i months"));
        }

        $orgUnitId = $this->app->Auth()->getUser()->getEmployee()->getOrgUnitId();
        $brands = BrandsQuery::create()
            ->select('BrandId')
            ->filterByOrgunitid($orgUnitId)
            ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
            ->find()->toArray();

        $arr = [];
        $raxers = [];
        $nonRaxers = [];
        $order = [];
        foreach ($brands as $key => $br) {
            $brandData = BrandsQuery::create()
                ->filterByBrandId($br)
                ->findOne()->toArray();
            $minVal = $brandData['MinValue'];
            $array = [];
            foreach ($months as $mon) {
                $raxers = RcpaSummaryQuery::create()
                    ->filterByBrandId($br)
                    ->filterByRcpaMoye($mon)
                //                    ->filterByMinValue($minVal, Criteria::GREATER_EQUAL)
                    ->filterByOwn(0, Criteria::GREATER_THAN)
                    ->filterByTerritoryId($terId);

                if ($classification != "All") {
                    $raxers->filterByOutletClassification($classification);
                }

                if ($outletTag != "All") {
                    $raxers->filterByOutletId($outletView);
                }

                $raxers = $raxers->find()
                    ->toArray();

                $raxerData = [];

                foreach ($raxers as $rx) {
                    if ($rx['Own'] >= $minVal) {
                        $raxerData[] = $rx;
                    }
                }

                /*$nonRaxers = RcpaSummaryQuery::create()
                ->filterByBrandId($br)
                ->filterByRcpaMoye($mon)
                ->filterByCompetition(0, Criteria::GREATER_THAN)
                ->filterByMinValue($minVal, Criteria::GREATER_EQUAL)
                ->filterByTerritoryId($terId);

                if (count($outletView) > 0) {
                $nonRaxers->filterByOutletId($outletView);
                }
                if ($classification != "All") {
                $nonRaxers->filterByOutletClassification($classification);
                }
                $nonRaxers = $nonRaxers->find()
                ->toArray();*/
                $array[$brandData['BrandName']][$mon]['BrandId']=$brandData['BrandId'];
                $array[$brandData['BrandName']][$mon]['month']=$mon;
                $array[$brandData['BrandName']][$mon]['raxers'] = count($raxerData);
                $array[$brandData['BrandName']][$mon]['non_raxers'] = count($outlets) - count($raxerData);
                if ($mon == date('m-Y')) {

                    $order[$brandData['BrandName']] = count($raxerData);
                }
            }

            $arr[$brandData['BrandName']] = $array;
        }

        arsort($order);
        $tmp = [];
        foreach ($order as $o => $i) {
            $tmp[] = $arr[$o];
        }
        $arr = $tmp;
        unset($tmp);

        $oneBrand = 0;
        $twoBrand = 0;
        $threeBrand = 0;
        $moreThanThreeBrand = 0;

        foreach ($resultArray as $d) {
            if ($d['count'] == 1) {
                $oneBrand += 1;
            }
            if ($d['count'] == 2) {
                $twoBrand += 1;
            }
            if ($d['count'] == 3) {
                $threeBrand += 1;
            }
            if ($d['count'] > 3) {
                $moreThanThreeBrand += 1;
            }
        }
        $totRaxers = $oneBrand + $twoBrand + $threeBrand + $moreThanThreeBrand;

        $atRaxers = count($outlets) - $totRaxers;

        $data1['total'] = count($outlets);
        $data1['one_brand'] = $oneBrand;
        $data1['two_brand'] = $twoBrand;
        $data1['three_brand'] = $threeBrand;
        $data1['more_three_brand'] = $moreThanThreeBrand;
        $data1['no_raxers'] = $atRaxers;
        $data1['months'] = $months;
        $data1['data'] = $arr;
        $this->apiResponse($data1, 200, "Data Retrieved Successfully.");
    }

    /**
     * @OA\Get(
     *     path="/api/top10Doctors",
     *     tags={"RCPA Report"},
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

    public function top10Doctors()
    {
        $br = \entities\Base\BrandRcpaQuery::create()
            ->groupByBrandId()
            ->find()->toArray();
        /*$brandRcpa = BrandRcpaQuery::create()
        ->groupBy("BrandId")
        ->find();*/

        var_dump($br);
        exit;
    }

    public function topDoctors()
    {
        $brandRcpa = BrandRcpaQuery::create()
            ->groupByOutletId();

        $brandRcpa->find()->toArray();
        var_dump($brandRcpa);
        exit;
    }

    /**
     * @OA\Get(
     *     path="/api/rcpa_trend_report",
     *     tags={"RCPA Report"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="start_date",
     *         in="query",
     *         description="Start Date",
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="end_date",
     *         in="query",
     *         description="End Date",
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="brand_id",
     *         in="query",
     *         description="Brand Id",
     *     required=true,
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
     *         description="ResponseObj",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     * @throws Exception
     */
    public function rcpaTrendReport()
    {

        $brandId = $this->app->Request()->getParameter("brand_id");
        $startDate = $this->app->Request()->getParameter("start_date");
        $endDate = $this->app->Request()->getParameter("end_date");
        $positionId = $this->app->Request()->getParameter("position_id");
        if ($positionId == null) {
            $employyeId = $this->app->Auth()->getUser()->getEmployee()->getPositionId();
        } else {
            $employyeId = $positionId;
        }
        $employee = EmployeeQuery::create()
            ->filterByPositionId($employyeId)
            ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
            ->find()
            ->toArray();
        $emapArr = [];

        foreach ($employee as $emp) {
            $emapArr[] = $emp['EmployeeId'];
        }
        $start = new DateTime($startDate);
        $start->modify('first day of this month');
        $end = new DateTime($endDate);
        $end->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 month');
        $period = new DatePeriod($start, $interval, $end);
        $months = [];
        foreach ($period as $dt) {

            $months[] = $dt->format("m-Y");
        }

        $contribution = [];
        $raxers = [];
        foreach ($months as $mon) {
            $rcpas = BrandRcpaQuery::create()
                ->filterByBrandId($brandId)
                ->filterByCompetitorId(0)
                ->filterByEmployeeId($emapArr)
                ->filterByRcpaMoye($mon)
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->find()->toArray();

            $contribution[$mon] = count($rcpas);

            $total = 0;

            foreach ($rcpas as $cpa) {
                $total += $cpa['RcpaValue'];
            }

            $raxers[$mon] = $total;
        }

        $data['contribution'] = $contribution;
        $data['raxers'] = $raxers;
        $this->apiResponse($data, 200, "Data Retrieved Successfully.");
    }



    /**
     * @OA\Post(
     *     path="/api/punchout",
     *     tags={"User Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="punchout_date",
     *         in="query",
     *         description="Punchout Date",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="punchout_time",
     *         in="query",
     *         description="Punchout Time",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="latlnt",
     *         in="query",
     *         description="Lat Lng",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="location",
     *         in="query",
     *         description="Location Name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="remark",
     *         in="query",
     *         description="Remark",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="end_itownid",
     *         in="query",
     *         description="Town Id",
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
    public function punchout()
    {
        switch ($this->app->Request()->getMethod()):
    case "POST":
        if ($this->app->Auth()->getUser()->getEmployee()->getIslocked()) {
                $this->apiResponse([], 400, "Reason : " . $this->app->Auth()->getUser()->getEmployee()->getLockedreason());
                return;
        }
        $empID = $this->app->Auth()->getUser()->getEmployeeId();
        $position = $this->app->Auth()->getUser()->getEmployee()->getPositionId();
        $this->Validate(v::stringVal()->notEmpty()->validate($this->app->Request()->getParameter("latlnt")), "Please enter the LatLnt", "latlnt");
        $this->Validate(v::stringVal()->notEmpty()->validate($this->app->Request()->getParameter("location")), "Please enter the Location", "location");
        $location_pin = $this->app->Request()->getParameter("latlnt");
        $location_name = $this->app->Request()->getParameter("location");
        $remark = $this->app->Request()->getParameter("remark");
        $punchoutdate = $this->app->Request()->getParameter("punchout_date");
        $punchouttime = $this->app->Request()->getParameter("punchout_time");
        $endItownId = $this->app->Request()->getParameter("end_itownid", null);
        $attendencehelper = new \Modules\ESS\Runtime\AttendanceHelper($this->app);
        $empID = $this->app->Auth()->getUser()->getEmployeeId();
        $punchoutdate = $this->app->Request()->getParameter("punchout_date");








        $empstatus = DayplanQuery::create()
            ->filterByTpDate($punchoutdate)
            ->filterByPositionId($position)
            ->filterByStatus(['pending', 'AwatingFeedback'])
            ->findOne();


        // $apptoken = $_SERVER['HTTP_APPTOKEN'];
        // try {
        //     $resp = $attendencehelper->Punch_out($empID, $location_pin, $location_name, $remark, $punchouttime, $punchoutdate, $endItownId, $apptoken);
        //     $this->apiResponse($resp, 200, "Punch out Successfully.");
        // } catch (Exception $e) {
        //     $this->apiResponse([], 400, $e->getMessage());
        // }

        if ($empstatus != null && false) { // TSPC-1033 - remove validation
            //$this->apiResponse([], 400, "Can't Punch out , some calls are pending");
            $this->apiResponse([], 400, "Please attend all planned calls");
        } else {
            $apptoken = $_SERVER['HTTP_APPTOKEN'];
            try {
                $resp = $attendencehelper->Punch_out($empID, $location_pin, $location_name, $remark, $punchouttime, $punchoutdate, $endItownId, $apptoken);

                $previousDates = [];
                $date = new DateTime($punchoutdate);
                for ($i = 1; $i <= 3; $i++) {
                    $prevDate = (clone $date)->modify("-$i day");
                    $previousDates[] = $prevDate->format('Y-m-d');
                }
                $data = OrgManager::getUnderPositions($this->app->Auth()->getUser()->getEmployee()->getPositionId());
                if (count($data) > 0) {
                    $currentEmployeeId = $this->app->Auth()->getUser()->getEmployee()->getEmployeeId();
                    $previousDates = [];
                    $date = new DateTime($punchoutdate);

                    // Get the previous 3 days
                    for ($i = 1; $i <= 3; $i++) {
                        $prevDate = (clone $date)->modify("-$i day");
                        $previousDates[] = $prevDate->format('Y-m-d');
                    }

                    // Iterate over each position id in the under positions
                    foreach ($data as $positionId) {
                        // Get employee ID for this position ID
                        $employees = EmployeeQuery::create()->filterByPositionId($positionId)->find();


                        foreach ($employees as $employee) {
                            $empID = $employee->getEmployeeId();

                            // Query to check if current employee ID appears in managers continuously for the past 3 days
                            $dailyCalls = DailyCallsQuery::create()
                                ->filterByEmployeeId($empID)
                                ->filterByDcrDate($previousDates, Criteria::IN) // Check last 3 days
                                ->find();


                            $managersByDay = [];

                            foreach ($dailyCalls as $call) {
                                if ($call->getManagers() != null) {
                                    $managersList = explode(',', $call->getManagers()); // Split comma-separated managers
                                    if (in_array($currentEmployeeId, $managersList)) {
                                        $managersByDay[] = $managersList; // Add to the list if the current employee ID is in managers
                                    }
                                }
                            }

                            // If the employee ID is present in all 3 days (continuous presence in the past 3 days)
                            if (count($managersByDay) == 3) {

                                // Check for the survey and create a record in survey_submited table
                                $orgUnitId = $employee->getOrgUnitId();
                                $survey = SurveyQuery::create()
                                    ->filterByOrgunitid($orgUnitId)
                                    ->filterByShortCode('JW_Survey')
                                    ->filterByAudienceType('Employee')
                                    ->findOne();

                                if ($survey) {
                                    $surveySubmited = SurveySubmitedQuery::create()
                                        ->filterBySurveyId($survey->getSurveyId())
                                        ->filterByEmployeeId($currentEmployeeId)
                                        ->filterByAudienceType("Employee")
                                        ->filterByShortCode("JW_Survey")
                                        ->filterByForEmployeeId($empID)
                                        ->filterByCreatedAt(date('Y-m-01', strtotime("first day of this month")), Criteria::GREATER_EQUAL)
                                        ->filterByCreatedAt(date('Y-m-t', strtotime("last day of this month")), Criteria::LESS_EQUAL)
                                        ->findOne();

                                    if ($surveySubmited == null) {
                                        // Create a new survey record
                                        $surveySubmited = new SurveySubmited();
                                        $surveySubmited->setEmployeeId($currentEmployeeId);
                                        $surveySubmited->setForEmployeeId($empID);
                                        $surveySubmited->setCompanyId($this->app->Auth()->getUser()->getCompanyId());
                                        $surveySubmited->setSurveyId($survey->getSurveyId());
                                        $surveySubmited->setAudienceType("Employee");
                                        $surveySubmited->setShortCode("JW_Survey");
                                        $surveySubmited->setStatus("draft");
                                        $surveySubmited->save();
                                    }
                                }
                            }
                        }
                    }
                }
                $this->apiResponse($resp, 200, "Punch out Successfully.");
            } catch (Exception $e) {
                $this->apiResponse([], 400, $e->getMessage());
            }
        }
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/punchStatus",
     *     tags={"User Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="day_type",
     *         in="query",
     *         description="Day Types (R = Working, W = WeekOff, H = Holidays)",
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
    public function punchStatus()
    {
        switch ($this->app->Request()->getMethod()):
        case "GET":
            if ($this->app->Auth()->getUser()->getEmployee()->getIslocked()) {
                    $this->apiResponse([], 400, "Reason : " . $this->app->Auth()->getUser()->getEmployee()->getLockedreason());
                    return;
            }
            $dayTypes = $this->app->Request()->getParameter("day_type");

            $empID = $this->app->Auth()->getUser()->getEmployeeId();
            $attendencehelper = new \Modules\ESS\Runtime\AttendanceHelper($this->app);
            $data = $attendencehelper->getFreeDates($empID,$dayTypes);
            $this->apiResponse($data, 200, "Free Dates available for Punchin.");
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/punchStatusByDate",
     *     tags={"User Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="date",
     *         in="query",
     *         description="Date",
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
    public function punchStatusByDate()
    {
        switch ($this->app->Request()->getMethod()):
        case "GET":
            // if ($this->app->Auth()->getUser()->getEmployee()->getIslocked()) {
            //         $this->apiResponse([], 400, "Reason : " . $this->app->Auth()->getUser()->getEmployee()->getLockedreason());
            //         return;
            // }
            $date = $this->app->Request()->getParameter("date");

            $empID = $this->app->Auth()->getUser()->getEmployeeId();
            $attendance = \entities\AttendanceQuery::create()
                                ->filterByEmployeeId($empID)
                                ->filterByAttendanceDate($date)
                                ->findOne();
            $punchIn = null;
            if($attendance != null && $attendance->getStartTime() != null){
                $punchIn = $attendance->getStartTime()->format('Y-m-d H:i:s');
            }
            $punchOut = null;
            if($attendance != null && $attendance->getEndTime() != null){
                $punchIn = $attendance->getEndTime()->format('Y-m-d H:i:s');
            }
            $msg = "";
            if($attendance != null){
                
                if ($attendance->getStatus() == 0){
                    
                    $msg = "Punched in - Out is pending";
                }
                else if ($attendance->getStatus() == 1){
                    $msg = "Punched Out";
                }
                else if ($attendance->getStatus() == 3){
                    $msg = "Locked";
                }
                else if ($attendance->getStatus() == 4){
                    $msg = "Punch Leave";
                }else{
                    $msg = "No Attendance";
                }
            }else{
                $msg = "No Attendance";
            }
            $result = [];
            if($attendance != null){
                $result = [
                    'date' => $attendance->getAttendanceDate()->format('Y-m-d'),
                    'punchStatus' => $attendance->getStatus(),
                    'punchinTime' => $punchIn,
                    'punchoutTime' => $punchOut,
                    'Note' => $msg
                ];
            }

            $this->apiResponse($result, 200, "Free Dates available for Punchin.");
        break;
        endswitch;
    }

    public function login()
    {
        if ($this->app->Auth()->isLogin()) {
            $this->json(["error" => "already login"]);
            return;
        }

        if ($this->app->isPost()) {
            $user = $this->app->Request()->getParameter("username");
            $pass = $this->app->Request()->getParameter("password");
            $permission = $this->app->Request()->getParameter("permission", array("ess"));
            $permission_status = true;

            if ($this->app->Auth()->Authorise($user, $pass, true)) {
                $u = $this->app->Auth()->getUser();
                $fcmtoken = $this->app->Request()->getParameter("FcmToken", "");
                $DeviceName = $this->app->Request()->getParameter("DeviceName", "");
                /* Fcm token not null */
                // if ($fcmtoken != "" && $u->getFcmToken() != $fcmtoken) {
                //     $u->setDeviceName($DeviceName);
                //     $u->setFcmToken($fcmtoken);
                //     $u->save();
                // }
                $data = \entities\UsersQuery::create()
                //->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                //->joinWithEmployee()
                //->joinWithRoles()
                //->filterByUserId($u->getUserId())
                    ->findPk($u->getUserId());
                $employee = \entities\EmployeeQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->joinWithBranch()
                    ->joinWithOrgUnit()
                    ->joinWithDesignations()
                    ->joinWithGradeMaster()
                    ->filterByEmployeeId($data->getEmployeeId())
                    ->find()
                    ->toArray();

                foreach ($permission as $per) {
                    if (!in_array($per, $this->app->Auth()->getPerms())) {
                        $permission_status = false;
                    }
                }
                $isEmployeeTopLevel = \Modules\ESS\Runtime\EssHelper::isEmployeeTopLevel($this->app->Auth()->getUser()->getEmployee());

                if ($permission_status) {
                    $this->apiResponse([
                        "login" => true,
                        "AppToken" => $u->getAppToken(),
                        "data" => $data->toArray(),
                        "employee" => $employee,
                        "scope" => $this->app->Auth()->getPerms(),
                        "isEmployeeTopLevel" => $isEmployeeTopLevel,
                    ], 200, "Login OK !!");
                } else {
                    $this->apiResponse(["login" => false, "data" => "You are not authorised to login in this app"], 100, "You are not authorised to login in this app");
                }
            } else {
                $this->apiResponse(["login" => false, "data" => $this->app->Auth()->getError()], 100, "Email id or Password is incorrect");
            }
        }
    }

    public function forgotPwd()
    {
        switch ($this->app->Request()->getMethod()):
    case "POST":
        $username = $this->app->Request()->getParameter("username");
        $defaultConfig = \Modules\ESS\Runtime\EssHelper::forgotpassword($username, "system", $this->app);
        if ($defaultConfig) {
                $this->apiResponse(["error" => "Your request has been sent to " . $defaultConfig], 200, "Your request for Reset the password has been sent.");
        } else {
            $this->apiResponse(["error" => "User Not Fount"], 100, "");
        }
        break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/dashboard",
     *     tags={"Dashboard"},
     *     @OA\Response(
     *         response="200",
     *         description="MultipleObjects",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function dashboard()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $ExpReqs = WorkflowManager::getPendingRequestPks("Expenses", $this->app);
        $employeeId = $this->app->Auth()->getUser()->getEmployeeId();
        $empId = $this->app->Auth()->getUser()->getEmployeeId();
        $data['company'] = $this->app->Auth()->getUser()->getCompany()->toArray();
        $data['config'] = $this->app->Auth()->getUser()->getCompany()->getConfigurations()->toArray();
        $data['isEmployeeTopLevel'] = \Modules\ESS\Runtime\EssHelper::isEmployeeTopLevel($this->app->Auth()->getUser()->getEmployee());
        $data['isUserManager'] = $this->app->Auth()->checkPerm("user_system");
        $data['allowedMonths'] = $this->app->Auth()->getUser()->getCompany()->getExpenseMonths();
        $data['MonthsRage'] = \Modules\ESS\Runtime\EssHelper::getRangeAllowedMonth($this->app->Auth()->getUser()->getCompany()->getExpenseMonths());
        $this->apiResponse([$data], 200, "get Records");
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getMyTeam",
     *     tags={"Dashboard"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="filter",
     *         in="query",
     *         description="Team Filter (0=>all team,1=>AtoZ,2=>ZtoA,3=>Newly Added)",
     *         @OA\Schema(type="number")
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
    public function getMyTeam()
    {
            $filter = $this->app->Request()->getParameter("filter");
            $empids = \Modules\HR\Runtime\HrHelper::findEmpsUnder($this->app->Auth()->getUser()->getEmployee()->getPositionId());
            //        $empids = 236;
            switch ($filter):
        case "0":
            $emps = \entities\EmployeeQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->JoinWithDesignations()
                ->JoinPositionsRelatedByReportingTo();
            $emps->filterByPrimaryKeys($empids);
            $emps->filterByStatus(1);
            break;
        case "1":
            $emps = \entities\EmployeeQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->JoinWithDesignations()
                ->JoinPositionsRelatedByReportingTo();
            $emps->filterByPrimaryKeys($empids);
            $emps->filterByStatus(1);
            $emps->orderByFirstName(\Propel\Runtime\ActiveQuery\Criteria::ASC);
            break;
        case "2":
            $emps = \entities\EmployeeQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->JoinWithDesignations()
                ->JoinPositionsRelatedByReportingTo();
            $emps->filterByPrimaryKeys($empids);
            $emps->filterByStatus(1);
            $emps->orderByFirstName(\Propel\Runtime\ActiveQuery\Criteria::DESC);
            break;
        case "3":
            $emps = \entities\EmployeeQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->JoinWithDesignations()
                ->JoinPositionsRelatedByReportingTo();
            $emps->filterByPrimaryKeys($empids);
            $emps->filterByStatus(1);
            $emps->orderByEmployeeId(\Propel\Runtime\ActiveQuery\Criteria::DESC);
            break;
        default:
            $emps = \entities\EmployeeQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->JoinWithDesignations()
                ->JoinPositionsRelatedByReportingTo();
            $emps->filterByPrimaryKeys($empids);
            $emps->filterByStatus(1);
            break;
            endswitch;
            $team = $emps->findByCompanyId($this->app->Auth()->CompanyId())->toArray();

            $teamArray = [];
            $totalArray = [];
            foreach ($team as $t) {
                    $teamArray['EmployeeId'] = $t['EmployeeId'];
                    $teamArray['CompanyId'] = $t['CompanyId'];
                    $teamArray['PositionId'] = $t['PositionId'];
                    $teamArray['ReportingTo'] = $t['ReportingTo'];
                    $teamArray['DesignationId'] = $t['DesignationId'];
                    $teamArray['BranchId'] = $t['BranchId'];
                    $teamArray['GradeId'] = $t['GradeId'];
                    $teamArray['OrgUnitId'] = $t['OrgUnitId'];
                    $teamArray['EmployeeCode'] = $t['EmployeeCode'];
                    $teamArray['FirstName'] = $t['FirstName'];
                    $teamArray['LastName'] = $t['LastName'];
                    $teamArray['Status'] = $t['Status'];
                    $teamArray['IpAddress'] = $t['IpAddress'];
                    $teamArray['ProfilePicture'] = $t['ProfilePicture'];
                    $teamArray['Email'] = $t['Email'];
                    $teamArray['LastLogin'] = $t['LastLogin'];
                    $teamArray['Phone'] = $t['Phone'];
                    $teamArray['Address'] = $t['Address'];
                    $teamArray['Costnumber'] = $t['Costnumber'];
                    $teamArray['CreatedAt'] = $t['CreatedAt'];
                    $teamArray['UpdatedAt'] = $t['UpdatedAt'];
                    $teamArray['BaseMtarget'] = $t['BaseMtarget'];
                    $teamArray['IntegrationId'] = $t['IntegrationId'];
                    $teamArray['Itownid'] = $t['Itownid'];
                    $teamArray['Islocked'] = $t['Islocked'];
                    $teamArray['Lockedreason'] = $t['Lockedreason'];
                    $teamArray['Lockeddate'] = $t['Lockeddate'];
                    $teamArray['Iseodcheckenabled'] = $t['Iseodcheckenabled'];
                    $teamArray['EmployeeMedia'] = $t['EmployeeMedia'];
                    $teamArray['Designations'] = $t['Designations'];
                    $teamArray['PositionsRelatedByReportingTo'] = isset($t['PositionsRelatedByReportingTo']) ? $t['PositionsRelatedByReportingTo'] : null;
                    $attendence = AttendanceQuery::create()
                        ->orderBy('AttendanceId', Criteria::DESC)
                        ->filterByAttendanceDate(date("Y-m-d"))
                        ->filterByEmployeeId($t['EmployeeId'])
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->findOne();

                    if ($attendence != null) {
                        $teamArray['StartTime'] = $attendence->getStartTime();
                        $teamArray['EndTime'] = $attendence->getEndTime();
                    } else {
                        $teamArray['StartTime'] = null;
                        $teamArray['EndTime'] = null;
                    }

                    $reportingTo = AttendanceQuery::create()
                        ->orderBy('AttendanceId', Criteria::DESC)
                        ->filterByEndTime(null, Criteria::NOT_EQUAL)
                        ->filterByEmployeeId($t['EmployeeId'])
                        ->filterByCompanyId($this->app->Auth()->CompanyId())
                        ->findOne();

                    if ($reportingTo == null) {
                        $lastReportingTo = null;
                    } else {
                        $lastReportingTo = $reportingTo->getEndTime();
                    }
                    $teamArray['LastReportingTo'] = $lastReportingTo;
                    $totalArray[] = $teamArray;
            }
            $attendenceData = AttendanceQuery::create()
            //                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->orderBy('AttendanceId', Criteria::DESC)
                ->filterByAttendanceDate(date("Y-m-d"))
                ->filterByEmployeeId($empids)
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->findOne();

            $this->apiResponse(["team" => $totalArray, "attendance" => $attendenceData], 200, "Team Under");
    }

    /**
     * @OA\Get(
     *     path="/api/getProfile",
     *     tags={"Dashboard"},
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
    public function getProfile()
    {
        //$id = $this->app->Auth()->getUser()->getEmployeeId();
        $id = $this->app->Request()->getParameter("employee_id", $this->app->Auth()->getUser()->getEmployeeId());

        $employee = \entities\EmployeeQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->joinWithUsers()
            ->joinWithDesignations()
            ->joinWithOrgUnit()
            ->leftJoinWithGeoTowns()
            ->leftJoinWithHrUserDates()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->findPk($id);
        if (isset($employee)) {
            $position = \entities\PositionsQuery::create()
                ->filterByPositionId($employee['PositionId'])
                ->findOne();
            if ($position->getCavPositionsUp() != null) {
                $reportingPositionIds = explode(',', $position->getCavPositionsUp());
                $date = date('Y-m-d');
                $managers = \entities\EmployeeQuery::create()
                            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                            ->filterByPositionId($reportingPositionIds)
                            ->filterByStatus(1)
                            ->useHrUserDatesQuery()
                                ->filterByJoinDate($date, Criteria::LESS_EQUAL)
                            ->endUse()
                            ->joinWithDesignations()
                            ->find();
                if ($managers->count() > 0) {
                    $employee['Reporting'] = $managers->toArray();
                } else {
                    $employee['Reporting'] = [];
                }
            }
            if (isset($employee["HrUserDatess"])) {
                if (isset($employee["HrUserDatess"][0]['JoinDate'])) {
                    $start_date = strtotime($employee["HrUserDatess"][0]['JoinDate']);
                    $end_date = strtotime(date("Y-m-d"));
                    $diff = ($end_date - $start_date);
                    $years = floor($diff / (365 * 60 * 60 * 24));
                    $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                    $employee['Tenure'] = $years . " Years - " . $months . " Months";
                }
            }
            $this->apiResponse($employee, 200, "Employee Profile.");
        } else {
            $this->apiResponse([], 400, "Employee not found!");
        }
    }

    /**
     * @OA\Get(
     *     path="/api/getTeam",
     *     tags={"Dashboard"},
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
    public function getTeam()
    {
        $employee = $this->app->Auth()->getUser()->getEmployee();
        $position = $employee->getPositionId();
        $companyId = $this->app->Auth()->CompanyId();

        $employee = \entities\EmployeeQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->joinWithUsers()
            ->joinWithDesignations()
            ->filterByReportingTo($position)
            ->filterByCompanyId($companyId)
            ->find()->toArray();

        $this->apiResponse($employee, 200, "Get team successfully!");
    }

    /**
     * @OA\Get(
     *     path="/api/getBirthdayReminders",
     *     tags={"Dashboard"},
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
    public function getBirthdayReminders()
    {
        $employee = $this->app->Auth()->getUser()->getEmployee();
        $companyId = $this->app->Auth()->CompanyId();
        $outlets = \entities\OutletsQuery::create()
            ->where('Outlets.TerritoryId = ?', $employee->getTerritoryId())
            ->where('Outlets.CompanyId = ?', $companyId)
            ->where('Outlets.OutletStatus = ?', 'active')
            ->find()->toArray();
        if (count($outlets) > 0) {
            $outletArray = array();
            foreach ($outlets as $outlet) {
                if ($outlet["OutletContactBday"] != null && $outlet["OutletContactBday"] != '' || $outlet["OutletContactAnniversary"] != null && $outlet["OutletContactAnniversary"] != '') {
                    $birthDate = $outlet["OutletContactBday"];
                    $anniversaryDate = $outlet["OutletContactAnniversary"];
                    $birthDateTime = strtotime($birthDate);
                    if ($anniversaryDate != null && $anniversaryDate != '') {
                        $anniversaryDateTime = strtotime($anniversaryDate);
                    }
                    if (date('m-d') == date('m-d', $birthDateTime) || date('m-d') == date('m-d', $anniversaryDateTime)) {
                        array_push($outletArray, $outlet);
                    }
                }
            }
            $this->apiResponse($outletArray, 200, "Get birthday and anniversary successfully!");
        } else {
            $this->apiResponse([], 400, "Birthday and Anniversary not found!");
        }
    }

    /**
     * @OA\Get(
     *     path="/api/getStatus",
     *     tags={"Expenses"},
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
    public function getStatus()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $tripstatus = [];
        $data['Expenses'] = WorkflowManager::getStatusList($this->WfDoc);
        //$trips = WorkflowManager::getStatusList("Trips");
        //                foreach ($trips as $id => $t) {
        //
        //                    if ($id == 1) {
        //                        $color = "#959699";
        //                    } else if ($id == 3 || $id == 4 || $id == 5) {
        //                        $color = "#ef9292";
        //                    } else {
        //                        $color = "#9dddea";
        //                    }
        //
        //                    if ($id == 1) {
        //                        $btndata = array("desc" => "Pending Approval", "Button" => [["id" => 4, "btnText" => "Cancel"]],
        //                            "AlterButton" => [
        //                                ["id" => 2, "btnText" => "Approve"],
        //                                ["id" => 3, "btnText" => "Reject", "reason" => true],
        //                                ["id" => 4, "btnText" => "Cancel"]
        //                        ]);
        //                    } else if ($id == 2) {
        //                        $btndata = array("desc" => "Approved", "Button" => [["id" => 4, "btnText" => "Cancel", "reason" => true]]);
        //                    } else if ($id == 3) {
        //                        $btndata = array("desc" => "Rejected", "Button" => [["id" => 1, "btnText" => "Re Submit"]]);
        //                    } else if ($id == 4) {
        //                        $btndata = array("desc" => "Closed/Cancelled");
        //                    } else if ($id == 5) {
        //                        $btndata = array("desc" => "Closed/Cancelled");
        //                    } else {
        //                        $btndata = array("desc" => "Approval Requested", "Approval" => true,
        //                            "Button" => [
        //                                ["id" => 2, "btnText" => "Approve"],
        //                                ["id" => 3, "btnText" => "Reject", "reason" => true],
        //                                ["id" => 4, "btnText" => "Cancel"]
        //                        ]);
        //                    }
        //                    array_push($tripstatus, array("id" => $id, "status" => $t, "color" => $color, "data" => $btndata));
        //                }

        //$data['Trips'] = $trips;
        //$data['statusTrips'] = $tripstatus;
        $data['ExpenseFilters'] = [
            //["id" => "1","desc" => "Created","Button"=>[["id"=>2,"btnText"=>"Submit"],["id"=>7,"btnText"=>"Cancel"]]],
            ["id" => "1", "desc" => "Created", "Button" => [["id" => 2, "btnText" => "Submit"]]],
            ["id" => "2", "desc" => "Submited", "AlterButton" => [["id" => 3, "btnText" => "Approve"], ["id" => 4, "btnText" => "Reject", "reason" => true]]],
            ["id" => "3", "desc" => "Approved"],
            //["id" => "4","desc" => "Rejected","Button"=>[["id"=>1,"btnText"=>"Re-Open"],["id"=>2,"btnText"=>"Submit"]],"AlterButton"=>[["id"=>1,"btnText"=>"Re-Open"],["id"=>2,"btnText"=>"Submit"]]],
            ["id" => "4", "desc" => "Rejected", "Button" => [["id" => 1, "btnText" => "Re-Open"], ["id" => 2, "btnText" => "Submit"]]],
            ["id" => "7", "desc" => "Cancelled"],
            ["id" => "P", "desc" => "Approval Pending", "Approval" => true, "Button" => [["id" => 3, "btnText" => "Approve"], ["id" => 4, "btnText" => "Reject", "reason" => true]]],
        ];

        //                $data['TripFilters'] = [
        //                        ["id" => "1","desc" => "My Approved","Button"=>[["id"=>4,"btnText"=>"Cancel"]]],
        //                        ["id" => "2","desc" => "Pending Approval","Button"=>[["id"=>4,"btnText"=>"Cancel","reason"=>true]]],
        //                        ["id" => "3","desc" => "Rejected","Button"=>[["id"=>1,"btnText"=>"Re open"]] ],
        //                        ["id" => "4","desc" => "Closed/Cancelled"],
        //                        ["id" => "P","desc" => "Approval Requested","Approval" => true,"Button"=>[["id"=>2,"btnText"=>"Approve"],["id"=>3,"btnText"=>"Reject","reason"=>true],["id"=>4,"btnText"=>"Cancel"]]]
        //                    ];
        // $data['TripFiltersNew'] = [
        //     ["id" => "A", "desc" => "My Trips"],
        //     ["id" => "P", "desc" => "Team Trips"]
        // ];
        $data['notificationColor'] = ["Trips" => "#fff8df", "Expenses" => "#e3fefa"];
        $data['dateFilter'] = \Modules\ESS\Runtime\EssHelper::getStartEndMonth();
        //$data['essConfig'] = $this->getConfig("ESS");
        $this->apiResponse([$data], 200, "get Status");
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getAllowedMonths",
     *     tags={"Expenses"},
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
    public function getAllowedMonths()
    {
            switch ($this->app->Request()->getMethod()):
        case "GET":
            $data = \Modules\ESS\Runtime\EssHelper::getAllowedMonths($this->app->Auth()->getUser()->getCompany()->getExpenseMonths());
            $this->apiResponse([$data], 200, "get Status");
            break;
            endswitch;
    }

    public function getAllowedMonthsNew()
    {
            switch ($this->app->Request()->getMethod()):
        case "GET":
            $allowedMonthsData = [];
            $allowedMonths = \Modules\ESS\Runtime\EssHelper::getAllowedMonths($this->app->Auth()->getUser()->getCompany()->getExpenseMonths());
            foreach ($allowedMonths as $all => $month) {
                    array_push($allowedMonthsData, array("id" => $all, "value" => $month));
            }
            $this->apiResponse($allowedMonthsData, 200, "get allowedMonths");
            break;
            endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/getExpensesNew",
     *     tags={"Expenses"},
     *     description="This is to get expense list",
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
     *         @OA\Schema(type="String")
     *     ),
     *     @OA\Parameter(
     *         name="month",
     *         in="query",
     *         description="Month",
     *         @OA\Schema(type="String")
     *     ),
     *     @OA\Parameter(
     *         name="employee",
     *         in="query",
     *         description="Employee",
     *         @OA\Schema(type="String")
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
    public function getExpensesNew()
    {
        switch ($this->app->Request()->getMethod()):
    case "POST":
        $this->Validate(v::stringVal()->notEmpty()->validate($this->app->Request()->getParameter("month")), "Please enter the month", "month");

        $status = $this->app->Request()->getParameter("status");
        $employee = $this->app->Request()->getParameter("employee", $this->app->Auth()->getUser()->getEmployeeId());
        $month = explode("|", $this->app->Request()->getParameter("month", "|"));

        $pendingAction = WorkflowManager::getPendingRequestPks($this->WfDoc, $this->app);

        if ($status != "P") {
                $expenses = \Modules\ESS\Runtime\EssHelper::getExpenses($status, $employee, $month, $pendingAction);
        } else {
            if ($this->app->Request()->getParameter("employee", "") != "") {
                $expenses = \Modules\ESS\Runtime\EssHelper::getExpenses($status, $employee, $month, $pendingAction);
            } else {
                $expenses = [];
            }
        }
        $dataArray = array();
        $expenseDate = \Modules\ESS\Runtime\EssHelper::getFreeMonthDates($month, $employee);
        $monthWeekOffDates = \Modules\ESS\Runtime\EssHelper::getMonthWeekOffs($month);
        $leaveDates = \Modules\ESS\Runtime\EssHelper::getMonthLeaves($month,$employee);
        $leaveDatesAssoc = array_flip($leaveDates);
        // Use array_diff_key to remove leave dates from $expenseDate
        $filteredDatesArray = array_diff_key($expenseDate, $leaveDatesAssoc);
        $countExpense=0;

        if (count($expenses) > 0) {
            foreach ($expenses as $expense) {
                if (array_key_exists($expense["ExpenseDate"], $filteredDatesArray)) {
                    $countExpense++;
                    $expense = self::singleExpenses($expense["ExpId"]);
                    $designations = \entities\EmployeeQuery::create()
                        ->findPk($expense["ExpId"]);
                    $expensesList = \entities\ExpenseListQuery::create()
                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                        ->joinWithExpenseMaster()
                        ->filterByExpId($expense["ExpId"])
                        ->find();
                    $dayTypeArray = array();
                    if (isset($designations) && $designations->getPositionId() != null) {
                        $tourPlan = \entities\TourplansQuery::create()
                            ->filterByTpDate($expense["ExpenseDate"])
                            ->filterByPositionId($designations->getPositionId())
                            ->find()->toArray();
                        foreach ($tourPlan as $tourPl) {
                            array_push($dayTypeArray, $tourPl["Agendacontroltype"]);
                        }
                        $designation = $designations->getDesignations()->getDesignation();
                    } else {
                        $tourPlan = [];
                    }

                    $fw = 0;
                    $nca = 0;

                    $dailyCalls = \entities\DailycallsQuery::create()
                        ->filterByDcrDate($expense["ExpenseDate"])
                        ->filterByEmployeeId($expense["EmployeeId"])
                        ->filterByDcrStatus('completed')
                        ->_or()
                        ->filterByDcrStatus('Reported')
                        ->find()->toArray();
                    if (count($dailyCalls) > 0) {
                        foreach ($dailyCalls as $dailyCall) {
                            if ($dailyCall["Agendacontroltype"] == 'FW') {
                                $fw += 1;
                            } else {
                                $nca += 1;
                            }
                        }
                    }

                    $dayTypeArrayUnique = array_unique($dayTypeArray);

                    $holiday = false;
                    if($designations != null && $designations->getBranch() != null && $designations->getBranch()->getIstateid()){
                        $holi = \entities\HolidaysQuery::create()
                                ->filterByHolidayDate($expense["ExpenseDate"])
                                ->filterByIstateid($designations->getBranch()->getIstateid())
                                ->findOne();
                        if($holi != null && $holi != ''){
                            $holiday = true;
                        }
                    }

                    $weekOff = false;
                    if(in_array ($expense["ExpenseDate"],$monthWeekOffDates)){
                        $weekOff = true;
                    }

                    $leave = false;
                    if(in_array ($expense["ExpenseDate"],$leaveDates)){
                        $leave = true;
                    }

                    $expenseDate[$expense["ExpenseDate"]] = [
                        'designations' => isset($designation) ? $designation : null,
                        'expenses' => $expense,
                        'expenseLine' => $expensesList->toArray(),
                        'TourPlan' => $tourPlan,
                        'DayType' => $dayTypeArrayUnique,
                        'TotalCalls' => $fw + $nca,
                        'FW' => $fw,
                        'NCA' => $nca,
                        'WeekOff' => $weekOff,
                        'Holiday' => $holiday,
                        'Leave' => $leave,
                    ];
                }
            }
        }
        //asort($dataArray);
        if (count($expenseDate) > 0) {
            $this->apiResponse(["expensecount" => $countExpense, "data" => $expenseDate], 200, "");
        } else {
            $this->apiResponse([], 400, "Expenses Not Found !!");
        }
        break;
        endswitch;
        // switch ($this->app->Request()->getMethod()):
        //     case "POST":
        //         $this->Validate(v::stringVal()->notEmpty()->validate($this->app->Request()->getParameter("month")), "Please enter the month", "month");
        //         $status = $this->app->Request()->getParameter("status");
        //         $employee = $this->app->Request()->getParameter("employee", $this->app->Auth()->getUser()->getEmployeeId());
        //         $month = explode("|", $this->app->Request()->getParameter("month", "|"));
        //         $pendingAction = WorkflowManager::getPendingRequestPks($this->WfDoc, $this->app);
        //         if ($status != "P") {
        //             $expenses = \Modules\ESS\Runtime\EssHelper::getExpenses($status, $employee, $month, $pendingAction);
        //         } else {
        //             if ($this->app->Request()->getParameter("employee", "") != "") {
        //                 $expenses = \Modules\ESS\Runtime\EssHelper::getExpenses($status, $employee, $month, $pendingAction);
        //             } else {
        //                 $expenses = [];
        //             }
        //         }
        //         $dataArray = array();

        //         if (count($expenses) > 0) {
        //             foreach ($expenses as $expense) {

        //                 $expense = self::singleExpenses($expense["ExpId"]);
        //                 $designations = \entities\EmployeeQuery::create()
        //                     ->findPk($expense["ExpId"]);
        //                 $expensesList = \entities\ExpenseListQuery::create()
        //                     ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
        //                     ->joinWithExpenseMaster()
        //                     ->filterByExpId($expense["ExpId"])
        //                     ->find();
        //                 $dayTypeArray = array();
        //                 if (isset($designations) && $designations->getPositionId() != null) {
        //                     $tourPlan = \entities\TourplansQuery::create()
        //                         ->filterByTpDate($expense["ExpenseDate"])
        //                         ->filterByPositionId($designations->getPositionId())
        //                         ->find()->toArray();
        //                     foreach ($tourPlan as $tourPl) {
        //                         array_push($dayTypeArray, $tourPl["Agendacontroltype"]);
        //                     }
        //                     $designation = $designations->getDesignations()->getDesignation();
        //                 } else {
        //                     $tourPlan = [];
        //                 }

        //                 $fw = 0;
        //                 $nca = 0;

        //                 $dailyCalls = \entities\DailycallsQuery::create()
        //                     ->filterByDcrDate($expense["ExpenseDate"])
        //                     ->filterByEmployeeId($expense["EmployeeId"])
        //                     ->filterByDcrStatus('completed')
        //                     ->_or()
        //                     ->filterByDcrStatus('Reported')
        //                     ->find()->toArray();
        //                 if (count($dailyCalls) > 0) {
        //                     foreach ($dailyCalls as $dailyCall) {
        //                         if ($dailyCall["Agendacontroltype"] == 'FW') {
        //                             $fw += 1;
        //                         } else {
        //                             $nca += 1;
        //                         }
        //                     }
        //                 }

        //                 $dayTypeArrayUnique = array_unique($dayTypeArray);
        //                 $data['designations'] = isset($designation) ? $designation : null;
        //                 $data['expenses'] = $expense;
        //                 $data['expenseLine'] = $expensesList->toArray();
        //                 $data['TourPlan'] = $tourPlan;
        //                 $data['DayType'] = $dayTypeArrayUnique;
        //                 $data['TotalCalls'] = $fw + $nca;
        //                 $data['FW'] = $fw;
        //                 $data['NCA'] = $nca;

        //                 //$dataArray[$expense["ExpenseDate"]] = $data;

        //                 array_push($dataArray, $data);
        //             }
        //         }
        //         //asort($dataArray);
        //         if (count($dataArray) > 0) {
        //             $this->apiResponse(["expensecount" => count($dataArray), "data" => $dataArray], 200, "");
        //         } else {
        //             $this->apiResponse([], 400, "Expenses Not Found !!");
        //         }
        //         break;
        // endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/getExpenses",
     *     tags={"Expenses"},
     *     description="This is to get expense list",
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
     *         @OA\Schema(type="String")
     *     ),
     *     @OA\Parameter(
     *         name="month",
     *         in="query",
     *         description="Month",
     *         @OA\Schema(type="String")
     *     ),
     *     @OA\Parameter(
     *         name="employee",
     *         in="query",
     *         description="Employee",
     *         @OA\Schema(type="String")
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
    public function getExpenses()
    {
        switch ($this->app->Request()->getMethod()):
    case "POST":
        $this->Validate(v::stringVal()->notEmpty()->validate($this->app->Request()->getParameter("month")), "Please enter the month", "month");
        $status = $this->app->Request()->getParameter("status");
        $employee = $this->app->Request()->getParameter("employee", $this->app->Auth()->getUser()->getEmployeeId());
        $month = explode("|", $this->app->Request()->getParameter("month", "|"));
        $pendingAction = WorkflowManager::getPendingRequestPks($this->WfDoc, $this->app);
        if ($status != "P") {
                $expenses = \Modules\ESS\Runtime\EssHelper::getExpenses($status, $employee, $month, $pendingAction);
        } else {
            if ($this->app->Request()->getParameter("employee", "") != "") {
                $expenses = \Modules\ESS\Runtime\EssHelper::getExpenses($status, $employee, $month, $pendingAction);
            } else {
                $expenses = [];
            }
        }
        $dataArray = array();

        if (count($expenses) > 0) {
            foreach ($expenses as $expense) {

                $expense = self::singleExpenses($expense["ExpId"]);
                $designations = \entities\EmployeeQuery::create()
                    ->findPk($expense["ExpId"]);
                $expensesList = \entities\ExpenseListQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->joinWithExpenseMaster()
                    ->filterByExpId($expense["ExpId"])
                    ->find();
                $dayTypeArray = array();
                if (isset($designations) && $designations->getPositionId() != null) {
                    $tourPlan = \entities\TourplansQuery::create()
                        ->filterByTpDate($expense["ExpenseDate"])
                        ->filterByPositionId($designations->getPositionId())
                        ->find()->toArray();
                    foreach ($tourPlan as $tourPl) {
                        array_push($dayTypeArray, $tourPl["Agendacontroltype"]);
                    }
                    $designation = $designations->getDesignations()->getDesignation();
                } else {
                    $tourPlan = [];
                }

                $fw = 0;
                $nca = 0;

                $dailyCalls = \entities\DailycallsQuery::create()
                    ->filterByDcrDate($expense["ExpenseDate"])
                    ->filterByEmployeeId($expense["EmployeeId"])
                    ->filterByDcrStatus('completed')
                    ->_or()
                    ->filterByDcrStatus('Reported')
                    ->find()->toArray();
                if (count($dailyCalls) > 0) {
                    foreach ($dailyCalls as $dailyCall) {
                        if ($dailyCall["Agendacontroltype"] == 'FW') {
                            $fw += 1;
                        } else {
                            $nca += 1;
                        }
                    }
                }

                $dayTypeArrayUnique = array_unique($dayTypeArray);
                $data['designations'] = isset($designation) ? $designation : null;
                $data['expenses'] = $expense;
                $data['expenseLine'] = $expensesList->toArray();
                $data['TourPlan'] = $tourPlan;
                $data['DayType'] = $dayTypeArrayUnique;
                $data['TotalCalls'] = $fw + $nca;
                $data['FW'] = $fw;
                $data['NCA'] = $nca;

                //$dataArray[$expense["ExpenseDate"]] = $data;

                array_push($dataArray, $data);
            }
        }
        //asort($dataArray);
        if (count($dataArray) > 0) {
            $this->apiResponse(["expensecount" => count($dataArray), "data" => $dataArray], 200, "");
        } else {
            $this->apiResponse([], 400, "Expenses Not Found !!");
        }
        break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/getExpensesMonthwise",
     *     tags={"Expenses"},
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
     *         @OA\Schema(type="String")
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
    public function getExpensesMonthwise()
    {
        switch ($this->app->Request()->getMethod()):
    case "POST":
        $status = $this->app->Request()->getParameter("status");
        $employee = $this->app->Auth()->getUser()->getEmployeeId();
        $pendingAction = WorkflowManager::getPendingRequestPks($this->WfDoc, $this->app);
        $getmonth = \Modules\ESS\Runtime\EssHelper::getStartEndMonth();
        $expenses = \Modules\ESS\Runtime\EssHelper::getExpensesmonthwise($status, $employee, $getmonth['month'], $pendingAction);
        if (count($expenses) > 0) {
                $this->apiResponse(["expensecount" => count($expenses), "data" => $expenses], 200, "");
        } else {
            $this->apiResponse([], 400, "Expenses Not Found !!");
        }
        break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/getExpensesLazyLoad",
     *     tags={"Expenses"},
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
     *         @OA\Schema(type="String")
     *     ),
     *     @OA\Parameter(
     *         name="pageNo",
     *         in="query",
     *         description="Page No",
     *         @OA\Schema(type="String")
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
    public function getExpensesLazyLoad()
    {
        $perPage = 10;
        switch ($this->app->Request()->getMethod()):
    case "POST":
        $this->Validate(v::stringVal()->notEmpty()->validate($this->app->Request()->getParameter("status")), "Please enter the status", "status");
        $status = $this->app->Request()->getParameter("status");
        $pageNo = $this->app->Request()->getParameter("pageNo");
        $employee = $this->app->Auth()->getUser()->getEmployeeId();
        $pendingAction = WorkflowManager::getPendingRequestPks($this->WfDoc, $this->app);
        $getmonth = \Modules\ESS\Runtime\EssHelper::getStartEndMonth();
        $expenses = \Modules\ESS\Runtime\EssHelper::getExpensesLazyLoad($status, $employee, $getmonth, $pendingAction, $pageNo * $perPage, $perPage);
        if (count($expenses) > 0) {
                $this->apiResponse(["expensecount" => count($expenses), "data" => $expenses], 200, "");
        } else {
            $this->apiResponse([], 400, "Expenses Not Found !!");
        }
        break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/getSingleExpenses",
     *     tags={"Expenses"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="ExpId",
     *         in="query",
     *         description="Expense Id",
     *         @OA\Schema(type="String")
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
    public function getSingleExpenses()
    {
        switch ($this->app->Request()->getMethod()):
    case "POST":
        $this->Validate(v::stringVal()->notEmpty()->validate($this->app->Request()->getParameter("ExpId")), "Please enter the expense id", "ExpId");
        $ExpId = $this->app->Request()->getParameter("ExpId");
        //$reCalculate = \Modules\ESS\Runtime\EssHelper::reCalculate($ExpId);
        $expenses = self::singleExpenses($ExpId);
        if ($expenses == null && $expenses == '') {
                $this->apiResponse([], 400, "Expense not found!");
        }
        $designations = \entities\EmployeeQuery::create()
            ->findPk($expenses['EmployeeId']);
        $expensesList = \entities\ExpenseListQuery::create()
            ->joinWithExpenseMaster()
            ->filterByExpId($ExpId)
            ->find();
        $budget = \entities\BudgetGroupQuery::create()
            ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
            ->find()->toKeyValue('Bgid', 'GroupName');
        $individualCount = [];
        foreach ($expensesList as $l) {
            array_push($individualCount, ["ExpListId" => $l->getPrimaryKey(), "Count" => $l->getExpenseListDetailss()->count()]);
        }
        // $tourPlans = \entities\TourplansQuery::create()
        //     ->filterByTpDate($expenses["ExpenseDate"])
        //     ->filterByPositionId($designations->getPositionId())
        //     ->find()->toArray();
        // $dayTypeArray = array();
        // foreach ($tourPlans as $tourPlan) {
        //     array_push($dayTypeArray, $tourPlan["Agendacontroltype"]);
        // }
        // $dayTypeArrayUnique = array_unique($dayTypeArray);

        $tourPlan = \entities\DailycallsQuery::create()
            ->filterByDcrDate($expenses["ExpenseDate"])
            ->filterByPositionId($designations->getPositionId())
            ->find()->toArray();

        $dayTypeArray = array();
        foreach ($tourPlan as $tourPl) {
            array_push($dayTypeArray, $tourPl["Agendacontroltype"]);
        }
        $dayTypeArrayUnique = array_unique($dayTypeArray);

        $darview = \entities\DarViewQuery::create()
            ->filterByDcrDate($expenses["ExpenseDate"])
            ->filterByEmployeeId($expenses['EmployeeId'])
            ->find();
        $beatArray = array();
        foreach ($darview as $dar) {
            if (array_key_exists($dar->getBeatName(), $beatArray)) {
                if ($dar->getOutlettypeName() == 'Doctor') {
                    $beatArray[$dar->getBeatName()]['Doctor'] += 1;
                } else if ($dar->getOutlettypeName() == 'Pharmacy') {
                    $beatArray[$dar->getBeatName()]['Pharmacy'] += 1;
                }
            } else {
                if ($dar->getOutlettypeName() == 'Doctor') {
                    $beatArray[$dar->getBeatName()]['Doctor'] = 1;
                } else {
                    $beatArray[$dar->getBeatName()]['Doctor'] = 0;
                }
                if ($dar->getOutlettypeName() == 'Pharmacy') {
                    $beatArray[$dar->getBeatName()]['Pharmacy'] = 1;
                } else {
                    $beatArray[$dar->getBeatName()]['Pharmacy'] = 0;
                }
            }
        }
        $data['budget'] = $budget;
        $data['level'] = WorkflowManager::getCurrentLevel($this->WfDoc, $ExpId, $expenses['ExpenseStatus'], $this->app);
        $data['designations'] = $designations->getDesignations()->getDesignation();
        $data['headcount'] = $expensesList->count();
        $data['expenses'] = $expenses;
        $data['expenseType'] = $expenses['TripType'];
        $data['data'] = $expensesList->toArray();
        $data['IndividualExp_Count'] = $individualCount;
        $data['attachment'] = \entities\ExpenseFilesQuery::create()->filterByExpId($ExpId)->find()->toArray();
        $data['TourPlan'] = $tourPlan;
        $data['DayType'] = $dayTypeArrayUnique;
        $data['DayActivities'] = $beatArray;
        $this->apiResponse($data, 200, "get All Expenses");
        break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/getExpensesMaster",
     *     tags={"Expenses"},
     *     description="This will get table under single expense",
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="ExpId",
     *         in="query",
     *         description="Expense Id",
     *         @OA\Schema(type="String")
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
    public function getExpensesMaster()
    {
        switch ($this->app->Request()->getMethod()):
    case "POST":
        $this->Validate(v::stringVal()->notEmpty()->validate($this->app->Request()->getParameter("ExpId")), "Please enter the expense id", "ExpId");
        $ExpId = $this->app->Request()->getParameter("ExpId");
        $reCalculate = \Modules\ESS\Runtime\EssHelper::reCalculate($ExpId);
        $expenses = self::singleExpenses($ExpId);
        $designations = \entities\EmployeeQuery::create()
            ->findPk($expenses['EmployeeId']);
        $expensesList = \entities\ExpenseListQuery::create()
            ->joinWithExpenseMaster()
            ->filterByExpId($ExpId)
            ->find();
        $budget = \entities\BudgetGroupQuery::create()
            ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
            ->find()->toKeyValue('Bgid', 'GroupName');
        $individualCount = [];
        foreach ($expensesList as $l) {
                array_push($individualCount, ["ExpListId" => $l->getPrimaryKey(), "Count" => $l->getExpenseListDetailss()->count()]);
        }
        // $tourPlan = \entities\TourplansQuery::create()
        //     ->filterByTpDate($expenses["ExpenseDate"])
        //     ->filterByPositionId($designations->getPositionId())
        //     ->find()->toArray();

        $tourPlan = \entities\DailycallsQuery::create()
            ->filterByDcrDate($expenses["ExpenseDate"])
            ->filterByPositionId($designations->getPositionId())
            ->find()->toArray();

        $dayTypeArray = array();
        foreach ($tourPlan as $tourPl) {
            array_push($dayTypeArray, $tourPl["Agendacontroltype"]);
        }
        $dayTypeArrayUnique = array_unique($dayTypeArray);
        $darview = \entities\DarViewQuery::create()
            ->filterByDcrDate($expenses["ExpenseDate"])
            ->filterByEmployeeId($expenses['EmployeeId'])
            ->find();
        $beatArray = array();
        foreach ($darview as $dar) {
            if (array_key_exists($dar->getBeatName(), $beatArray)) {
                if ($dar->getOutlettypeName() == 'Doctor') {
                    $beatArray[$dar->getBeatName()]['Doctor'] += 1;
                } else if ($dar->getOutlettypeName() == 'Pharmacy') {
                    $beatArray[$dar->getBeatName()]['Pharmacy'] += 1;
                }
            } else {
                if ($dar->getOutlettypeName() == 'Doctor') {
                    $beatArray[$dar->getBeatName()]['Doctor'] = 1;
                } else {
                    $beatArray[$dar->getBeatName()]['Doctor'] = 0;
                }
                if ($dar->getOutlettypeName() == 'Pharmacy') {
                    $beatArray[$dar->getBeatName()]['Pharmacy'] = 1;
                } else {
                    $beatArray[$dar->getBeatName()]['Pharmacy'] = 0;
                }
            }
        }
        $data['budget'] = $budget;
        $data['level'] = WorkflowManager::getCurrentLevel($this->WfDoc, $ExpId, $expenses['ExpenseStatus'], $this->app);
        $data['designations'] = $designations->getDesignations()->getDesignation();
        $data['headcount'] = $expensesList->count();
        $data['expenses'] = $expenses;
        $data['expenseType'] = $expenses['TripType'];
        $data['data'] = $expensesList->toArray();
        $data['IndividualExp_Count'] = $individualCount;
        $data['attachment'] = \entities\ExpenseFilesQuery::create()->filterByExpId($ExpId)->find()->toArray();
        $data['TourPlan'] = $tourPlan;
        $data['DayType'] = $dayTypeArrayUnique;
        $data['DayActivities'] = $beatArray;
        $log = WorkflowManager::getLogData("Expenses", $ExpId);
        $logArray = [];
        foreach ($log as $l) {
            $rec = [
                "WfTitle" => $l->getWfTitle(),
                "WfNote" => $l->getWfNote(),
                "Employee" => \Modules\ESS\Runtime\EssHelper::getStandardEmployeeRecord($l->getEmployee(), $this->app->Auth()->CompanyId()),
                "WfStatusId" => $l->getWfStatusId(),
                "CreatedAt" => $l->getCreatedAt(),
            ];
            array_push($logArray, $rec);
        }
        $data['log'] = $logArray;
        $this->apiResponse($data, 200, "get All Expenses");
        break;
        endswitch;
    }

    public function createExpenses($pk = 0)
    {
        switch ($this->app->Request()->getMethod()):
    case "POST":
        $this->Validate(v::stringVal()->notEmpty()->validate($this->app->Request()->getParameter("ExpenseDate")), "Please enter the expense date", "ExpenseDate");
        $this->Validate(v::stringVal()->notEmpty()->validate($this->app->Request()->getParameter("BudgetId")), "Please enter the budget id", "BudgetId");
        $this->Validate(v::stringVal()->notEmpty()->validate($this->app->Request()->getParameter("ExpensePlacewrk")), "Please enter the place of work", "ExpensePlacewrk");
        $cnvDate = explode("/", ($this->app->Request()->getParameter("ExpenseDate")));
        $_POST['ExpenseDate'] = $cnvDate[2] . "-" . $cnvDate[1] . "-" . $cnvDate[0];
        $_POST['BudgetId'] = $this->app->Request()->getParameter("BudgetId");
        $_POST['ExpensePlacewrk'] = $this->app->Request()->getParameter("ExpensePlacewrk");
        $employee = $this->app->Auth()->getUser()->getEmployee();
        $OrgUnitId = $this->app->Auth()->getUser()->getEmployee()->getOrgUnitId();
        $hasClaim = \Modules\ESS\Runtime\EssHelper::addExpenses($pk, $_POST, $employee, $OrgUnitId, 'case1');
        if ($hasClaim) {
                $data = self::getExpenseshead($hasClaim->getPrimaryKey());
                $this->apiResponse(["expid" => $hasClaim->getPrimaryKey()], 200, "Expenses already Created");
                return;
        }
        $heads = \Modules\ESS\Runtime\EssHelper::addExpenses($pk, $_POST, $employee, $OrgUnitId, 'case2');
        if (count($heads) > 0) {
            $expId = \Modules\ESS\Runtime\EssHelper::addExpenses($pk, $_POST, $employee, $OrgUnitId, 'case3');
        } else {
            $this->apiResponse([], 400, "Sorry Cannot add Expenses, No Heads !!");
            return;
        }
        if ($expId > 0) {
            $default_currency = $this->app->Auth()->getUser()->getEmployee()->getOrgUnit()->getCurrencyId();
            $entity = \entities\ExpensesQuery::create()->findPk($expId);
            if (isset($_POST['Pin'])) {
                $entity->setPin($this->app->Request()->getParameter("Pin"));
                $entity->setDeviceName($this->app->Request()->getParameter("DeviceName"));
                $entity->setDeviceBattery($this->app->Request()->getParameter("DeviceBattery"));
                $entity->setDeviceTime($this->app->Request()->getParameter("DeviceTime"));
                $entity->save();
            }
            $policyEngine = new PolicyChecker($employee, $_POST['ExpenseDate'], $default_currency);
            $Branchlocation = $this->app->Auth()->getUser()->getEmployee()->getBranch()->getOrgUnit()->getUnitName();
            $expenseslist = \Modules\ESS\Runtime\EssHelper::addExpensesList($expId, $heads, $_POST, $policyEngine, $Branchlocation);
            $entity = \entities\ExpensesQuery::create()->findPk($expId);
            $data = \entities\ExpenseListQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->filterByExpId($expId)
                ->joinWithExpenseMaster()
                ->find()->toArray();
            if ($pk == 0) {
                $wfManager = new \Modules\System\Processes\WorkflowManager();
                $wfManager->process($this->WfDoc, $entity, "");
            }
            $this->apiResponse(["expid" => $expId], 200, "Expenses Created.");
        }
        break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/createExpenseListDetailss",
     *     tags={"Expenses"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="expense_list_id",
     *         in="query",
     *         description="Expense List Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="image",
     *         in="query",
     *         description="Attechment Ids",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="Description",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="amount",
     *         in="query",
     *         description="Expense Amount",
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
    public function createExpenseListDetailss()
    {
        switch ($this->app->Request()->getMethod()):
    case "POST":
        $expListId = $this->app->Request()->getParameter("expense_list_id");
        $images = $this->app->Request()->getParameter("image");
        $description = $this->app->Request()->getParameter("description");
        $amount = $this->app->Request()->getParameter("amount");
        $employee = $this->app->Auth()->getUser()->getEmployee();
        $OrgUnitId = $this->app->Auth()->getUser()->getEmployee()->getOrgUnitId();
        if ($expListId != null) {
                $expList = new \entities\ExpenseListDetails();
                $expList->setExpListId($expListId);
                $expList->setImage($images);
                $expList->setDescription($description);
                $expList->setAmount($amount);
                $expList->save();
                $this->apiResponse($expList->toArray(), 200, "Expenses list detail created!");
        } else {
            $this->apiResponse([], 400, "Expenses list not found!");
        }
        break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/expensesSubmit/{id}",
     *     tags={"Expenses"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Expense id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="ExpLineId",
     *         in="query",
     *         description="Expense Line Master id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="ExpQty",
     *         in="query",
     *         description="Expense Qty",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="ILQty",
     *         in="query",
     *         description="Expense ILQty",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="ExpRateQty",
     *         in="query",
     *         description="Expense RateQty",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="ExpRateMode",
     *         in="query",
     *         description="Expense Rate Mode",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="CmpCard",
     *         in="query",
     *         description="Expense Cmp Card",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="exp_remark",
     *         in="query",
     *         description="Expense Remarks",
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
    public function expensesSubmit($id)
    {
        switch ($this->app->Request()->getMethod()):
    case "POST":
        $exp = \entities\ExpensesQuery::create()->joinWithOrgUnit()->findPk($id);
        if ($exp != null) {
                $empId = $exp->getEmployeeId();

                if ($exp->getExpenseDate() != null) {
                    $month = $exp->getExpenseDate()->format('m-Y');

                    if ($month == date('m-Y')) {
                        $this->apiResponse([], 400, "Only previous month expenses submit. !!");
                    }

                    if ($empId != null && $month != null) {
                        $employee = \entities\EmployeeQuery::create()
                            ->filterByEmployeeId($empId)
                            ->findOne();

                        $monthNumber = explode('-', $month);

                        $dt = \DateTime::createFromFormat('m', $monthNumber[0]);
                        $startDate = $dt->format('Y-m-1');
                        $endDate = $dt->format('Y-m-t');

                        $date = date((int) $monthNumber[1] . '-' . (int) $monthNumber[0] . '-01');
                        $daysinMonth = cal_days_in_month(CAL_GREGORIAN, (int) $monthNumber[0], (int) $monthNumber[1]);
                        $sunday = 0;
                        for ($i = 0; $i < $daysinMonth; $i++) {
                            $day = date("Y-m-d", strtotime("+$i day", strtotime($date)));
                            $currentDate = DateTime::createFromFormat("Y-m-d", $day);
                            if ($currentDate->format("N") == 7) // Sunday
                            {
                                $sunday += 1;
                            }
                        }

                        $holidays = \entities\HolidaysQuery::create()
                            ->select(['HolidayDate'])
                            ->filterByIstateid($employee->getBranch()->getIstateid())
                            ->filterByHolidayDate($startDate, Criteria::GREATER_EQUAL)
                            ->filterByHolidayDate($endDate, Criteria::LESS_EQUAL)
                            ->find()->count();

                        $leaves = \entities\LeaveRequestQuery::create()
                            ->filterByLeaveFrom($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                            ->filterByLeaveTo($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByEmployeeId($employee->getEmployeeId())
                            ->filterByLeaveStatus(2)
                            ->find()->count();

                        $workingDays = $daysinMonth - ($sunday + $holidays + $leaves);

                        $startDate = date("Y-m-01", strtotime($exp->getExpenseDate()->format('Y-m-d')));
                        $endDate = date("Y-m-t", strtotime($exp->getExpenseDate()->format('Y-m-d')));

                        $attendanceExpDays = \entities\AttendanceQuery::create()
                            ->filterByEmployeeId($employee->getEmployeeId())
                            ->filterByAttendanceDate($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByAttendanceDate($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                            ->filterByExpenseGenerated(true)
                            ->find()->count();
                        if ($workingDays != $attendanceExpDays) {
                            $this->apiResponse([], 400, "Some dates are pending for attendance, Kindly check mark attendance window. !!");
                        }
                    }
                }
        }

        $ExpId = $this->app->Request()->getParameter("ExpLineId");
        $expentry[$ExpId] = $this->app->Request()->getParameter("ExpQty", 0);
        $ilentry[$ExpId] = $this->app->Request()->getParameter("ILQty", 0);
        $taxentry[$ExpId] = $this->app->Request()->getParameter("TaxQty", 0);
        $ExpRateQty[$ExpId] = $this->app->Request()->getParameter("ExpRateQty", 0);
        $ExpRemark[$ExpId] = $this->app->Request()->getParameter("exp_remark");
        $ExpRateMode[$ExpId] = $this->app->Request()->getParameter("ExpRateMode", null);
        $CmpCard[$ExpId] = $this->app->Request()->getParameter("CmpCard", null);
        $remarks = $this->app->Request()->getParameter("remarks", "");
        if (!is_numeric($expentry[$ExpId])) {
            return $this->apiResponse([], 400, 'ExpQty Must be Numeric');
        }
        if (!is_numeric($ilentry[$ExpId])) {
            return $this->apiResponse([], 400, 'ILQty Must be Numeric');
        }
        if ($ExpRateMode[$ExpId] == null) {
            $ExpRateMode = [];
        }
        if ($ExpRateQty[$ExpId] == null) {
            $ExpRateQty = [];
        }
        if ($ExpRemark[$ExpId] == null) {
            $ExpRemark = [];
        }
        if ($CmpCard[$ExpId] == null) {
            $CmpCard = [];
        }

        $emp = $exp->getEmployee();
        $default_currency = $this->app->Auth()->getUser()->getEmployee()->getOrgUnit()->getCurrencyId();
        $Branchlocation = $this->app->Auth()->getUser()->getEmployee()->getBranch()->getGeoState()->getSstatename();
        $policyEngine = new PolicyChecker($emp, $exp->getExpenseDate()->format("Y-m-d"), $default_currency);

        $head = \Modules\ESS\Runtime\EssHelper::updateHeadValue($id, $policyEngine, $expentry, $ilentry, $taxentry, $ExpRateQty, $ExpRemark, $ExpRateMode, $CmpCard, $remarks, $Branchlocation);
        $reCalculate = \Modules\ESS\Runtime\EssHelper::reCalculate($id);
        $msg = "Saved";
        $statuscode = 200;
        foreach ($head as $h) {
            if (!$h['status']['Validated']) {
                $msg = "Expense Could not be saved";
                $statuscode = 100;
            }
        }
        $this->apiResponse($head, $statuscode, $msg);
        break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/validateExpense",
     *     tags={"Expenses"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="ExpMasterId",
     *         in="query",
     *         description="Expense Master Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="val",
     *         in="query",
     *         description="Expense Value",
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
    public function validateExpense($id)
    {
        switch ($this->app->Request()->getMethod()):
    case "POST":
        $expId = $this->app->Request()->getParameter("ExpMasterId", "");
        $value = $this->app->Request()->getParameter("val", 0);
        $default_currency = $this->app->Auth()->getUser()->getEmployee()->getOrgUnit()->getCurrencyId();
        $Branchlocation = $this->app->Auth()->getUser()->getEmployee()->getBranch()->getOrgUnit()->getUnitName();
        $employeeId = $this->app->Auth()->getUser()->getEmployeeId();
        $exp = \entities\ExpensesQuery::create()->joinWithOrgUnit()->findPk($id);
        if ($exp) {
                $emp = $exp->getEmployee();
                $policyEngine = new PolicyChecker($emp, $exp->getExpenseDate()->format("Y-m-d"), $default_currency);
                $pr = \Modules\ESS\Runtime\EssHelper::validateExp($expId, $value, $policyEngine, $exp, $Branchlocation, $employeeId);
                $this->apiResponse([$pr->toArray()], 200, "Expenses Validate");
        } else {
            $this->apiResponse([], 400, "Expenses not found !!");
        }
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/expDeleteNew",
     *     tags={"Expenses"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="pk",
     *         in="query",
     *         description="Expenses Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get expense delete successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function expDeleteNew()
    {
        $id = $this->app->Request()->getParameter("pk");
        $expenses = \entities\Base\ExpensesQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->findPk($id);
        if ($expenses) {
            \Modules\ESS\Runtime\EssHelper::deleteExpense($expenses);
            $this->apiResponse(["status" => 1], 200, "Expense deleted !");
        } else {
            $this->apiResponse(["status" => 0], 400, "could not find expense!");
        }
    }

    /**
     * @OA\Get(
     *     path="/api/expDelete",
     *     tags={"Expenses"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="pk",
     *         in="path",
     *         description="Expenses Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get expense delete successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function expDelete($pk)
    {
        $expenses = \entities\Base\ExpensesQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->findPk($pk);
        if ($expenses) {
            \Modules\ESS\Runtime\EssHelper::deleteExpense($expenses);
            $this->apiResponse(["status" => 1], 200, "Expense deleted !");
        } else {
            $this->apiResponse(["status" => 0], 400, "could not find expense!");
        }
    }

    public function dateRange($first, $last, $step = '+1 day', $format = 'd/m/Y')
    {
        $dates = array();
        $current = strtotime($first);
        $last = strtotime($last);
        while ($current <= $last) {
            $dates[] = date($format, $current);
            $current = strtotime($step, $current);
        }
        return $dates;
    }

    /**
     * @OA\Get(
     *     path="/api/getNotification",
     *     tags={"Dashboard"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="sort_by",
     *         in="query",
     *         description="Sort By (0=>All,1=>AtoZ,2=>ZtoA,3=>Recently)",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="filter_by",
     *         in="query",
     *         description="Module (Expenses)",
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
    public function getNotifications()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $sortBy = $this->app->Request()->getParameter("sort_by");
        $filterBy = $this->app->Request()->getParameter("filter_by");
        $pendingActions = \Modules\System\Processes\WorkflowManager::getNotifications($this->app->Auth()->getUser()->getEmployee(), $sortBy, $filterBy);
        $actions = [];
        $emps = [];
        if ($pendingActions) {
                foreach ($pendingActions['actions'] as $pa) {
                    $actions['actions'][] = $pa->toArray();
                }
                foreach ($pendingActions['emps'] as $pe) {
                    $actions['emps'][] = $pe->toArray();
                }
                $this->apiResponse(["Actions" => $actions, "Employees" => $emps], 200, "Get Notifications ");
        }
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getawatingApprovalExpenses",
     *     tags={"Expenses"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="from_date",
     *         in="query",
     *         description="From Date",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="to_date",
     *         in="query",
     *         description="To Date",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get employee event successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getawatingApprovalExpenses()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $data = [];
        $empData = [];
        $empId = $this->app->Auth()->getUser()->getEmployeeId();
        $reqs = WorkflowManager::getPendingRequestPks("Expenses", $this->app);
        $fromDate = $this->app->Request()->getParameter("from_date");
        $toDate = $this->app->Request()->getParameter("to_date");
        $emp = \entities\ExpensesQuery::create()
            ->filterByExpenseDate($fromDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
            ->filterByExpenseDate($toDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
            ->filterByEmployeeId($empId, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
            ->filterByExpId($reqs)
            ->find();
        if ($emp) {
                foreach ($emp as $e) {
                    if (!isset($data[$e->getEmployeeId()])) {
                        $employee = $e->getEmployee();
                        $data[$e->getEmployeeId()] = array();
                        $data[$e->getEmployeeId()]['Amount'] = 0;
                        $data[$e->getEmployeeId()]['employee'] = $e->getEmployee()->getFirstName() . " " . $e->getEmployee()->getLastName() . " | " . $e->getEmployee()->getEmployeeCode();
                        $data[$e->getEmployeeId()]['emprec'] = $employee->toArray();
                        $data[$e->getEmployeeId()]['empDesignations'] = $employee->getDesignations()->toArray();
                        $data[$e->getEmployeeId()]['empBranch'] = $employee->getBranch()->toArray();
                    }
                    $data[$e->getEmployeeId()]['Amount'] += $e->getExpenseFinalAmt();
                }
                if (count($data) > 0) {
                    foreach ($data as $id => $value) {
                        array_push($empData, array(
                            "EmployeeId" => $id,
                            "Amount" => $value['Amount'],
                            "employeeName" => $value['employee'],
                            "emprec" => $value['emprec'],
                            "empDesignations" => $value['empDesignations'],
                            "empBranch" => $value['empBranch'],
                        ));
                    }
                }
                $this->apiResponse($empData, 200, "Get Expenses ");
        }
        break;
    case "POST":
        $emp = explode(",", (string) $this->app->Request()->getParameter("EmpId"));
        $status = $this->app->Request()->getParameter("status");
        $reason = $this->app->Request()->getParameter("reason", "");
        $month = explode("|", $this->app->Request()->getParameter("month", "|"));
        $Approve = \entities\ExpensesQuery::create()
            ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
            ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
            ->filterByEmployeeId($emp)
            ->find();
        if ($Approve) {
            foreach ($Approve as $a) {
                $a->setExpenseStatus($status);
                $a->save();
                $wfManager = new \Modules\System\Processes\WorkflowManager();
                $wfManager->process($this->WfDoc, $a, $reason);
            }
            $msg = self::statusMsg(2, $status);
            $this->apiResponse([], 200, $msg);
        } else {
            $this->apiResponse([], 400, "Approved Data Error");
        }
        break;
        endswitch;
    }

    public function getawatingApprovalExpensesMonthwise()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $data = [];
        $empData = [];
        $taxArray = [];
        $empId = $this->app->Auth()->getUser()->getEmployeeId();
        $reqs = WorkflowManager::getPendingRequestPks("Expenses", $this->app);
        $getmonth = \Modules\ESS\Runtime\EssHelper::getStartEndMonth();
        if ($getmonth['month']) {
                foreach ($getmonth['month'] as $key => $m) {
                    $month = explode("|", $key);
                    $emp = \entities\ExpensesQuery::create()
                        ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                        ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                        ->filterByEmployeeId($empId, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                        ->filterByExpId($reqs)
                        ->find();
                    if ($emp) {
                        foreach ($emp as $e) {
                            if ($e->getExpenseFinalAmt() > 0) {
                                if (!isset($data[$e->getEmployeeId()])) {
                                    $employee = $e->getEmployee();
                                    $data[$e->getEmployeeId()] = array();
                                    $data[$e->getEmployeeId()]['Amount'] = 0;
                                    $data[$e->getEmployeeId()]['employee'] = $e->getEmployee()->getFirstName() . " " . $e->getEmployee()->getLastName() . " | " . $e->getEmployee()->getEmployeeCode();
                                    $data[$e->getEmployeeId()]['emprec'] = $employee->toArray();
                                    $data[$e->getEmployeeId()]['empDesignations'] = $employee->getDesignations()->toArray();
                                    $data[$e->getEmployeeId()]['empBranch'] = $employee->getBranch()->toArray();
                                }
                                $data[$e->getEmployeeId()]['Amount'] += $e->getExpenseFinalAmt();
                            }
                        }
                        if (count($data) > 0) {
                            foreach ($data as $id => $value) {
                                array_push($empData, array(
                                    "EmployeeId" => $id,
                                    "Amount" => $value['Amount'],
                                    "employeeName" => $value['employee'],
                                    "emprec" => $value['emprec'],
                                    "empDesignations" => $value['empDesignations'],
                                    "empBranch" => $value['empBranch'],
                                ));
                            }
                        }
                        array_push($taxArray, array("Month" => array("MonthName" => $m, "Monthid" => $key), "Employee" => $empData));
                    }
                    $empData = [];
                    $data = [];
                }
                $this->apiResponse($taxArray, 200, "Get Expenses ");
        }
        break;
    case "POST":
        $emp = explode(",", (string) $this->app->Request()->getParameter("EmpId"));
        $status = $this->app->Request()->getParameter("status");
        $reason = $this->app->Request()->getParameter("reason", "");
        $month = explode("|", $this->app->Request()->getParameter("month", "|"));
        $Approve = \entities\ExpensesQuery::create()
            ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
            ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
            ->filterByEmployeeId($emp)
            ->find();
        $errormsg = array();
        $error = true;
        if ($Approve) {
            foreach ($Approve as $a) {
                if ($status == 2) {
                    if ($a->getExpenseDate()->format('Y-m') != date('Y-m')) {
                        $a->setExpenseStatus($status);
                        $a->save();
                        $msg = self::statusMsg(2, $status);
                        array_push($errormsg, array($a->getExpId() => $msg));
                    } else {
                        $error = false;
                        $msg = self::statusMsg(2, "error");
                        array_push($errormsg, array($a->getExpId() => $msg));
                    }
                } else {
                    $a->setExpenseStatus($status);
                    $a->save();
                }
                if (!$error) {
                    $msg = self::statusMsg(2, "error");
                } else {
                    $msg = self::statusMsg(2, $status);
                }
                $wfManager = new \Modules\System\Processes\WorkflowManager();
                $wfManager->process($this->WfDoc, $a, $reason);
            }
            $this->apiResponse($errormsg, 200, $msg);
        } else {
            $msg = self::statusMsg(2, 'experror');
            $this->apiResponse([], 400, $msg);
        }
        break;
        endswitch;
    }

    public function getawatingApprovalExpensesMonthwiseNew()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $data = [];
        $empData = [];
        $taxArray = [];
        $empId = $this->app->Auth()->getUser()->getEmployeeId();
        $reqs = WorkflowManager::getPendingRequestPks("Expenses", $this->app);
        $getmonth = \Modules\ESS\Runtime\EssHelper::getStartEndMonth();
        $emp = \entities\ExpensesQuery::create()
            ->filterByExpenseDate($getmonth['SMstartDate'], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
            ->filterByExpenseDate($getmonth['EMendDate'], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
            ->filterByEmployeeId($empId, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
            ->filterByExpId($reqs)
            ->find();
        if ($emp) {
                foreach ($emp as $e) {
                    if ($e->getExpenseFinalAmt() > 0) {
                        if (!isset($data[$e->getEmployeeId()])) {
                            $employee = $e->getEmployee();
                            $data[$e->getEmployeeId()] = array();
                            $data[$e->getEmployeeId()]['Amount'] = 0;
                            $data[$e->getEmployeeId()]['TotalExp'] = 0;
                            $data[$e->getEmployeeId()]['employee'] = $e->getEmployee()->getFirstName() . " " . $e->getEmployee()->getLastName() . " | " . $e->getEmployee()->getEmployeeCode();
                            $data[$e->getEmployeeId()]['emprec'] = $employee->toArray();
                            $data[$e->getEmployeeId()]['empDesignations'] = $employee->getDesignations()->toArray();
                            $data[$e->getEmployeeId()]['empBranch'] = $employee->getBranch()->toArray();
                        }
                        $data[$e->getEmployeeId()]['TotalExp'] += 1;
                        $data[$e->getEmployeeId()]['Amount'] += $e->getExpenseFinalAmt();
                    }
                }
                if (count($data) > 0) {
                    foreach ($data as $id => $value) {
                        array_push($empData, array(
                            "EmployeeId" => $id,
                            "Amount" => $value['Amount'],
                            "TotalExp" => $value['TotalExp'],
                            "employeeName" => $value['employee'],
                            "emprec" => $value['emprec'],
                            "empDesignations" => $value['empDesignations'],
                            "empBranch" => $value['empBranch'],
                        ));
                    }
                }
                array_push($taxArray, array("Employee" => $empData));
        }
        $empData = [];
        $data = [];
        $this->apiResponse($taxArray, 200, "Get Expenses ");
        break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/getEmployeetoExpenses",
     *     description="Get Expenses for Single Employee for Approval",
     *     tags={"Expenses"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="EmpId",
     *         in="query",
     *         description="Employee ID",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),   *
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
    public function getEmployeetoExpenses()
    {
        switch ($this->app->Request()->getMethod()):
    case "POST":
        $empid = $this->app->Request()->getParameter("EmpId");
        $month = $this->app->Request()->getParameter("month", "");
        if ($month == '') {
                $getmonth = \Modules\ESS\Runtime\EssHelper::getStartEndMonth();
                $month = array();
                array_push($month, $getmonth['SMstartDate']);
                array_push($month, $getmonth['EMendDate']);
        } else {
            $month = explode("|", $month);
        }
        $pendingAction = WorkflowManager::getPendingRequestPks($this->WfDoc, $this->app);
        $expenses = \entities\ExpensesQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->joinWithEmployee()
            ->joinWithBudgetGroup()
            ->filterByEmployeeId($empid)
            ->filterByExpenseDate($month[0], \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
            ->filterByExpenseDate($month[1], \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
            ->filterByPrimaryKeys($pendingAction)
            ->filterByExpenseReqAmt(0, \Propel\Runtime\ActiveQuery\Criteria::GREATER_THAN)
            ->find()->toArray();
        $this->apiResponse($expenses, 200, "Get Expenses for Single Employee ");
        break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/expensesApproved",
     *     tags={"Expenses"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="EmpId",
     *         in="path",
     *         description="Employee Id",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="ExpId",
     *         in="query",
     *         description="Expense Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Status",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="note",
     *         in="query",
     *         description="Note",
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
    public function expensesApproved($EmpId = 0)
    {
        switch ($this->app->Request()->getMethod()):
    case "POST":
        $ExpId = explode(",", (string) $this->app->Request()->getParameter("ExpId", ","));
        $status = $this->app->Request()->getParameter("status");
        $note = $this->app->Request()->getParameter("note");
        $Approve = \entities\ExpensesQuery::create()
            ->filterByExpId($ExpId)
            ->find();

        $errormsg = [];
        $error = true;
        if ($Approve->count() > 0) {
                foreach ($Approve as $a) {
                    if ($status == 2) {
                        $a->setExpenseStatus((int) $status);
                        $a->setExpenseNote($note);
                        $a->save();
                        $msg = self::statusMsg(2, $status);
                        array_push($errormsg, array($a->getExpId() => $msg));
                    } else if ($status == 3) {
                        if ($a->getExpId() != null) {
                            $expenseLists = \entities\ExpenseListQuery::create()
                                ->filterByExpId($a->getExpId())
                                ->find()->toArray();
                            foreach ($expenseLists as $expenseList) {
                                $expenseLi = \entities\ExpenseListQuery::create()
                                    ->filterByExpListId($expenseList['ExpListId'])
                                    ->filterByExpAprAmount(0)
                                    ->_or()
                                    ->filterByExpAprAmount(null, \Propel\Runtime\ActiveQuery\Criteria::EQUAL)
                                    ->findOne();
                                if ($expenseLi != null) {
                                    $expenseLi->setExpAprAmount((float) $expenseList['ExpFinalAmount']);
                                    $expenseLi->save();
                                }
                            }
                        }
                        EssHelper::reCalculate($a->getExpId());
                        $a->setExpenseStatus($status);
                        $a->setExpenseNote($note);
                        $a->save();
                    } else {
                        $a->setExpenseStatus($status);
                        $a->setExpenseNote($note);
                        $a->save();
                    }
                    if (count($errormsg) == 0) {
                        if (!$error) {
                            $msg = self::statusMsg(2, "error");
                        } else {
                            $msg = self::statusMsg(2, $status);
                        }
                    }
                    $wfManager = new \Modules\System\Processes\WorkflowManager();
                    $process = $wfManager->process($this->WfDoc, $a, $note);

                }
                $this->apiResponse($errormsg, 200, $msg);
        } else {
            $this->apiResponse([], 400, "Expenses not found!!");
        }
        break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/employeeLog",
     *     tags={"User Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="UserId",
     *         in="query",
     *         description="UserId",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="Pin",
     *         in="query",
     *         description="Pin (lat,lng)",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="DeviceName",
     *         in="query",
     *         description="DeviceName",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="DeviceBattery",
     *         in="query",
     *         description="DeviceBattery",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="DeviceTime",
     *         in="query",
     *         description="DeviceTime",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get employee event successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function employeeLog()
    {
        switch ($this->app->Request()->getMethod()):
    case "POST":
        $data = new \entities\EmployeeLog();
        $data->fromArray($_POST);
        $data->save();
        $this->apiResponse([$data->getPrimaryKey()], 200, "Log Create Successfully");
        break;
        endswitch;
    }

    public function appLogout()
    {
            switch ($this->app->Request()->getMethod()):
        case "GET":
            $userId = $this->app->Auth()->getUser()->getUserId();
            $query = \entities\UsersQuery::create()->findPk($userId);
            $query->setAppToken("");
            $query->setFcmToken("");
            $query->save();
            $this->app->Auth()->logout();
            $Apptoken = $this->app->Auth()->getUser()->getAppToken();
            $this->apiResponse([], 200, "Logout Successfully.");
            break;
            endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/editApprovelExpenses/{expId}",
     *     tags={"Expenses"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="expId",
     *         in="path",
     *         description="Expense line id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="action",
     *         in="query",
     *         description="action default value is : auth",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="ExpAprAmount",
     *         in="query",
     *         description="Expense Aproved Amount",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="exp_remark",
     *         in="query",
     *         description="Expense Remark",
     *         @OA\Schema(type="string")
     *     ),
     *
     *     @OA\Response(
     *         response="200",
     *         description="Get employee event successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function editApprovelExpenses($expId)
    {

            switch ($this->app->Request()->getMethod()):
        case "POST":
            $action = $this->app->Request()->getParameter("action");
            $employee = $this->app->Auth()->getUser()->getEmployee();
            $_POST['ExpAprAmount'] = $this->app->Request()->getParameter("ExpAprAmount");
            $_POST['ExpRemark'] = $this->app->Request()->getParameter("exp_remark");
            //$_POST['ExpNote'] = $this->app->Request()->getParameter("ExpNote", "");
            $data = \Modules\ESS\Runtime\EssHelper::editApprovel($_POST, $expId, $action, $employee);
            $this->apiResponse([], 200, "Amount Edited");
            break;
            endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/userLog",
     *     tags={"User Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="UserName",
     *         in="query",
     *         description="User Name (cp@gmail.com)",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="Ip",
     *         in="query",
     *         description="Ip (103.249.234.107)",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="Browser",
     *         in="query",
     *         description="Browser (Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36)",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="Status",
     *         in="query",
     *         description="Status (Password is Incorrect, Logged In, User not found, Mobile number is incorrect!)",
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="Timestamp",
     *         in="query",
     *         description="Timestamp (1602662991)",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get employee event successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function userLog()
    {
            switch ($this->app->Request()->getMethod()):
        case "POST":
            $UserName = $this->app->Request()->getParameter("UserName");
            $Ip = $this->app->Request()->getParameter("Ip");
            $Browser = $this->app->Request()->getParameter("Browser");
            $Status = $this->app->Request()->getParameter("Status");
            $Timestamp = $this->app->Request()->getParameter("Timestamp");
            if ($UserName != null && $UserName != '') {
                    $userLoginLog = new \entities\UserLoginLog();
                    $userLoginLog->setUserName($UserName);
                    $userLoginLog->setIp($Ip);
                    $userLoginLog->setBrowser($Browser);
                    $userLoginLog->setStatus($Status);
                    $userLoginLog->setTimestamp($Timestamp);
                    $userLoginLog->save();
                    $this->apiResponse([$userLoginLog->getPrimaryKey()], 200, "Userlog creacted");
            } else {
                $entity = new \entities\EmployeeLog();
                $entity->fromArray($_POST);
                $entity->save();
                $this->apiResponse([$entity->getPrimaryKey()], 200, "Userlog creacted");
            }
            break;
            endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/addMoreExp/{id}",
     *     tags={"Expenses"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Expense Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get more expense successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function addMoreExp($id)
    {
        $exp = \entities\ExpensesQuery::create()
            ->filterByExpId((int) $id)
            ->findOne();

        switch ($this->app->Request()->getMethod()):
    case "GET":
        $expTripType = $exp->getTripType();

        $expArray = array();
        $allowedExp = \Modules\ESS\Runtime\EssHelper::addMoreExpenses($id, $this->app->Auth()->getUser()->getEmployeeId(), $exp, $expTripType);
        if (count($allowedExp) > 0) {
                foreach ($allowedExp as $e) {
                    $pk = $e->getPrimaryKey();
                    if (!isset($rows[$pk])) {
                        array_push($expArray, array(
                            "label" => $e->getExpenseName(),
                            "value" => $pk,
                        ));
                    }
                    $this->apiResponse($expArray, 200, "get Expenses");
                }
        } else {
            $this->apiResponse([], 100, "No more expenses to add");
        }
        break;
    case "POST":
        $ExpMasterId = $this->app->Request()->getParameter("ExpMasterId", []);
        $pkArray = array();
        $expArray = array();
        $string = "No more expenses saved";

        foreach ($ExpMasterId as $e) {
            $chkhead = \entities\ExpenseListQuery::create()
                ->filterByExpId($id)
                ->filterByExpMasterId($e)
                ->findOne();
            if (!$chkhead) {

                $expenseRow = new \entities\ExpenseList();
                $expenseRow->setExpId((int) $id);
                $expenseRow->setExpMasterId((int) $e);
                $expenseRow->setExpDate($exp->getExpenseDate()->format('Y-m-d'));
                $expenseRow->setEmployeeId((int) $exp->getEmployeeId());
                $expenseRow->setCompanyId($this->app->Auth()->CompanyId());
                $expenseRow->setExpReqAmount(0);
                $expenseRow->setExpAprAmount(0);
                $expenseRow->setExpFinalAmount(0);
                $expenseRow->setExpLimit1(0);
                $expenseRow->setExpPolicyKey("");
                $expenseRow->setCmpCard(0);
                $expenseRow->setIsReadonly(false);
                $expenseRow->save();
                array_push($pkArray, $expenseRow->getExpenseMaster()->getExpenseName());
                $string = "Add new Expenses :" . implode(",", $pkArray);
            } else {
                array_push($expArray, "Expenses allready add : " . $chkhead->getExpenseMaster()->getExpenseName());
            }
        }
        $this->apiResponse($expArray, 200, $string);
        break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/addMoreExpPost/{id}",
     *     tags={"Expenses"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Expense Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *          name="ExpMasterId[]",
     *          in="query",
     *          required=true,
     *          description="Expense Masters",
     *          @OA\Schema(
     *           type="array",
     *           @OA\Items(type="integer")
     *          )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get add more expense successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function addMoreExpPost($id)
    {
        $this->addMoreExp($id);
    }

    /**
     * @OA\Get(
     *     path="/api/deleteMoreExp/{id}",
     *     tags={"Expenses"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Expense List Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Expenses list deleted successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function deleteMoreExp($id)
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $data = \Modules\ESS\Runtime\EssHelper::delExpensesList($id);
        $this->apiResponse([], 200, "Expenses has been deleted");
        break;
        endswitch;
    }

    public static function getExpenseshead($ExpId)
    {
            $data = \entities\ExpenseListQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->filterByExpId($ExpId)
                ->joinWithExpenseMaster()
                ->find()->toArray();
            return $data;
    }

    public static function singleExpenses($ExpId)
    {
        $expenses = \entities\ExpensesQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->joinWithBudgetGroup()
            ->joinWithCurrencies()
            ->joinWithEmployee()
            ->filterByExpId($ExpId)
            ->findOne();
        return $expenses;
    }

    public static function statusMsg($type, $status)
    {
        if ($type == 2) {
            switch ($status):
        case "1":
            return "Expense created successfully";
            break;
        case "2":
            return "Expense submitted successfully";
            break;
        case "3":
            return "Expense approved successfully";
            break;
        case "4":
            return "Expense has been rejected";
            break;
        case "5":
            return "Expense is in audit now";
            break;
        case "6":
            return "Expense processed successfully";
            break;
        case "7":
            return "Expense has been cancelled";
            break;
        case "8":
            return "Expense audited successfully";
            break;
        case "9":
            return "Expense has been put on hold";
            break;
        case "error":
            return "Current month expenses not allowed to submit.";
            break;
        case "experror":
            return "This month expenses does't found.";
            break;
            endswitch;
        }
    }

    public function workLog($ExpId)
    {
            switch ($this->app->Request()->getMethod()):
        case "GET":
            $exp = \entities\ExpensesQuery::create()
                ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
                ->findPk($ExpId);
            $data = $exp->getEmployeeWorkLogs()->toArray();
            $this->apiResponse($data, 200, 'Got log successfully');
            break;
        case "PUT":
            $Description = $this->app->Request()->getParameter("description");
            $Pin = $this->app->Request()->getParameter("pin", "");
            $StartTime = $this->app->Request()->getParameter("start_time", "");
            $Minutes = $this->app->Request()->getParameter("minutes", "");
            $Location = $this->app->Request()->getParameter("location", "");
            $WorkLogId = $this->app->Request()->getParameter("worklogid", "");
            if ($Description == '' || $WorkLogId == '') {
                    $this->apiResponse($_POST, 100, 'Error in data');
                    return;
            }
            $data = \entities\EmployeeWorkLogQuery::create()
                ->filterByWorkLogId($WorkLogId)
                ->findOne();
            $data->setDescription($Description)
                ->setExpId($ExpId)
                ->setStartTime($StartTime)
                ->setMinutes($Minutes)
                ->setLocation($Location)
                ->setPin($Pin);
            $data->save();
            $this->apiResponse($_POST, 200, 'Updated successfully');
            break;
        case "POST":
            $Description = $this->app->Request()->getParameter("description");
            $Pin = $this->app->Request()->getParameter("pin", "");
            $StartTime = $this->app->Request()->getParameter("start_time", "");
            $Minutes = $this->app->Request()->getParameter("minutes", "");
            $Location = $this->app->Request()->getParameter("location", "");
            $WorkLogId = $this->app->Request()->getParameter("WorkLogId", "");
            if ($Description == '') {
                $this->apiResponse($_POST, 100, 'Error in data');
                return;
            }
            $data = new \entities\EmployeeWorkLog();
            $data->setDescription($Description)
                ->setExpId($ExpId)
                ->setStartTime($StartTime)
                ->setMinutes($Minutes)
                ->setLocation($Location)
                ->setPin($Pin);
            $data->save();
            $this->apiResponse($_POST, 200, 'Added successfully');
            break;
            endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getEmployeeRoleWise",
     *     tags={"User Management"},
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
     *         description="Search",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Expenses list deleted successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getEmployeeRoleWise()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $advanceManager = new \Modules\HR\Runtime\AdvanceHelper($this->app);
        $cmpid = $this->app->Auth()->getUser()->getCompanyId();
        $searchText = strtolower($this->app->Request()->getParameter("search", ""));
        $type = $this->app->Request()->getParameter("type", ""); // A , R
        if ($this->app->Auth()->checkPerm("ess_org_admin")) {
                $employeeid = \Modules\HR\Runtime\HrHelper::getESSOrgAdminEmployee($cmpid);
        } else if ($this->app->Auth()->checkPerm("ess_branch_admin")) {
            $BranchId = $this->app->Auth()->getUser()->getEmployee()->getBranchId();
            $employeeid = \Modules\HR\Runtime\HrHelper::getEmployesForManager($cmpid, $BranchId);
        } else {
            $employeeid = [];
        }
        $expQuery = \entities\EmployeeQuery::create()->filterByEmployeeId($employeeid);
        if ($type == "A") {
            $expQuery->filterByPositionId(0, \Propel\Runtime\ActiveQuery\Criteria::GREATER_THAN);
        }
        $employees = $expQuery->find();
        $emp = array();
        if ($employees->count() > 0) {
            foreach ($employees as $emps) {
                if ($type == "R" && $emps->getPositionId() > 0) {
                    continue;
                }
                if ($searchText != "") {
                    $found = strpos(strtolower(
                        implode(" ", [
                            $emps->getEmployeeCode(),
                            $emps->getFirstName(),
                            $emps->getLastName(),
                            $emps->getEmail(),
                            $emps->getPhone(),
                        ])
                    ), $searchText);
                    if ($found == "" || !$found) {
                        continue;
                    }
                }
                if ($emps->getProfilePicture()) {
                    $profilePic = 'uploads/' . $cmpid . '/' . $emps->getProfilePicture();
                } else {
                    $profilePic = 'uploads/' . "default-profile.png";
                }
                $balance = $advanceManager->getBalance($emps->getPrimaryKey());
                $position = "-";
                if ($emps->getPositionId() > 0) {
                    $position = $emps->getPositionsRelatedByPositionId()->getPositionName();
                }
                $reportingTo = " None ";
                if ($emps->getReportingTo() > 0) {
                    $Reporting_position = \entities\PositionsQuery::create()
                        ->findPk($emps->getReportingTo());
                    if ($Reporting_position) {
                        $reportingTo = $Reporting_position->getPositionName();
                    }
                    $employeeRep = \entities\EmployeeQuery::create()
                        ->filterByStatus(1)
                        ->filterByPositionId($emps->getReportingTo())->findOne();
                    if ($employeeRep) {
                        $reportingTo = $reportingTo . " | " . $employeeRep->getFirstName() . " " . $employeeRep->getLastName();
                    } else {
                        $reportingTo = $reportingTo . " | [OPEN]";
                    }
                }
                $emp_data = array(
                    'EmployeeId' => $emps->getEmployeeId(),
                    'Status' => $emps->getStatus(),
                    'EmployeeName' => $emps->getFirstName() . ' ' . $emps->getLastName(),
                    'FirstName' => $emps->getFirstName(),
                    'LastName' => $emps->getLastName(),
                    'CompanyName' => $emps->getCompany()->getCompanyName(),
                    'Position' => $position,
                    'PositionId' => $emps->getPositionId(),
                    'ReportingTo' => $reportingTo,
                    'Designation' => $emps->getDesignations()->getDesignation(),
                    'Branch' => $emps->getBranch()->getBranchname(),
                    'Grade' => $emps->getGradeMaster()->getGradeName(),
                    'OrgUnit' => $emps->getOrgUnit()->getUnitName(),
                    'Email' => $emps->getEmail(),
                    'Phone' => $emps->getPhone(),
                    'EmployeeCode' => $emps->getEmployeeCode(),
                    'profilePicture' => $profilePic,
                    'balance' => $balance,
                );
                array_push($emp, $emp_data);
            }
        }
        $this->apiResponse($emp, 200, 'Got log successfully');
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getEmployeeDetails/{employeeid}",
     *     tags={"User Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="employeeid",
     *         in="path",
     *         description="Employee Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Expenses list deleted successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getEmployeeDetails($employeeid)
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $cmpid = $this->app->Auth()->getUser()->getCompanyId();
        $checkBal = new \Modules\HR\Runtime\AdvanceHelper($this->app);
        $getuserData = \Modules\ESS\Runtime\EssHelper::getEmptoUser($employeeid);
        $data = [];
        $employeeDetails = \entities\EmployeeQuery::create()
            ->findpk($employeeid);
        $position = "-";
        if ($employeeDetails->getPositionId() > 0) {
                $position = $employeeDetails->getPositionsRelatedByPositionId()->getPositionName();
        }
        $employeeReportingTo = " None ";
        if ($employeeDetails->getReportingTo() > 0) {
            $Reporting_position_employee = \entities\PositionsQuery::create()
                ->findPk($employeeDetails->getReportingTo());
            if ($Reporting_position_employee) {
                $employeeReportingTo = $Reporting_position_employee->getPositionName();
            }
            $employeeDetailsRep = \entities\EmployeeQuery::create()
                ->filterByStatus(1)
                ->filterByPositionId($employeeDetails->getReportingTo())->findOne();
            if ($employeeDetailsRep) {
                $employeeReportingTo = $employeeReportingTo . " | " . $employeeDetailsRep->getFirstName() . " " . $employeeDetailsRep->getLastName();
            } else {
                $employeeReportingTo = $employeeReportingTo . " | [OPEN]";
            }
        }
        $emp_data = array(
            'EmployeeId' => $employeeDetails->getEmployeeId(),
            'Status' => $employeeDetails->getStatus(),
            'EmployeeName' => $employeeDetails->getFirstName() . ' ' . $employeeDetails->getLastName(),
            'FirstName' => $employeeDetails->getFirstName(),
            'LastName' => $employeeDetails->getLastName(),
            'CompanyName' => $employeeDetails->getCompany()->getCompanyName(),
            'Position' => $position,
            'ReportingTo' => $employeeReportingTo,
            'Designation' => $employeeDetails->getDesignations()->getDesignation(),
            'Branch' => $employeeDetails->getBranch()->getBranchname(),
            'Grade' => $employeeDetails->getGradeMaster()->getGradeName(),
            'OrgUnit' => $employeeDetails->getOrgUnit()->getUnitName(),
            'Email' => $employeeDetails->getEmail(),
            'Phone' => $employeeDetails->getPhone(),
            'EmployeeCode' => $employeeDetails->getEmployeeCode(),
        );
        if ($employeeDetails->getProfilePicture()) {
            $profilePic = 'uploads/' . $cmpid . '/' . $employeeDetails->getProfilePicture();
        } else {
            $profilePic = 'uploads/' . "default-profile.png";
        }
        $pendingRequestedExpArray = [];
        $pendingRequestedExp = \entities\ExpensesQuery::create()
            ->filterByEmployeeId($employeeid)
            ->filterByExpenseStatus(2)
            ->find()->toArray();
        $pendingApprovalExpArray = [];
        $pendingApprovalExp = \entities\ExpensesQuery::create()
            ->filterByEmployeeId($employeeid)
            ->filterByExpenseStatus(3)
            ->find()->toArray();
        $lastLoginData = \Modules\ESS\Runtime\EssHelper::getLastLogin($getuserData->getUsername());
        $lastLoginTime = "Never";
        if ($lastLoginData) {
            $lastLoginTime = date("Y-m-d H:i:s", (int) $lastLoginData->getTimestamp());
        }
        $data['employeeDetails'] = $emp_data;
        $data['profilePicture'] = $profilePic;
        $data['currentBalance'] = $checkBal->getBalance($employeeid);
        $data['pendingRequestedExpenses'] = $pendingRequestedExpArray;
        $data['pendingApprovalsExpenses'] = $pendingApprovalExpArray;
        $data['lastGPSLocation'] = \Modules\ESS\Runtime\EssHelper::getLastLocation($getuserData->getUserId());
        $data['lasTLoginTime'] = $lastLoginTime;
        $data['monthlyExpense'] = \Modules\ESS\Runtime\EssHelper::getExpensesChartMonthly($employeeid);
        $data['categoryExpense'] = \Modules\ESS\Runtime\EssHelper::getCategoryExpenses($employeeid);
        $this->apiResponse($data, 200, 'Got log successfully');
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/GetOrgUsers",
     *     tags={"User Management"},
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
     *         description="Position ID",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get employee event successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function GetOrgUsers()
    {
        $position_id = $this->app->Request()->getParameter("position_id", 0);
        $data = [];
        if ($position_id == 0) {
            $position_id = $this->app->Auth()->getUser()->getEmployee()->getPositionId();
        }
        if ($position_id == 0) { // Does not hold a position
            $position_id = $this->app->Auth()->getUser()->getEmployee()->getReportingTo();
        }
        $position = \entities\Base\PositionsQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->findPk($position_id);
        if (!$position) {
            $this->apiResponse($data, 400, 'Opps position does not exist, check your org');
            return;
        }
        $position_employees = \entities\EmployeeQuery::create()->filterByPositionId($position_id)
            ->filterByStatus(1)
            ->find();
        $data["header"] = [
            "position" => $position->toArray(),
            "position_employee" => $position_employees->toArray(),
        ];
        $employeeResult = \entities\EmployeeQuery::create()
            ->filterByReportingTo($position_id)
            ->find();
        $employees = [
            "approvers" => [],
            "reporters" => [],
        ];
        if ($employeeResult->count() > 0) {
            foreach ($employeeResult as $e) {
                if ($e->getProfilePicture()) {
                    $profilePic = 'uploads/' . $this->app->Auth()->CompanyId() . '/' . $e->getProfilePicture();
                } else {
                    $profilePic = 'uploads/' . "default-profile.png";
                }
                $position = "-";
                if ($e->getPositionId() > 0) {
                    $position = $e->getPositionsRelatedByPositionId()->getPositionName();
                }
                if ($e->getPositionId() == $position_id) { // Level top same reporting
                    continue;
                }
                $emp_data = array(
                    'EmployeeId' => $e->getEmployeeId(),
                    'Status' => $e->getStatus(),
                    'EmployeeName' => $e->getFirstName() . ' ' . $e->getLastName(),
                    'FirstName' => $e->getFirstName(),
                    'LastName' => $e->getLastName(),
                    'CompanyName' => $e->getCompany()->getCompanyName(),
                    'Position' => $position,
                    'PositionId' => $e->getPositionId(),
                    'ReportingTo' => $e->getPositionsRelatedByReportingTo()->getPositionName(),
                    'Designation' => $e->getDesignations()->getDesignation(),
                    'Branch' => $e->getBranch()->getBranchname(),
                    'Grade' => $e->getGradeMaster()->getGradeName(),
                    'OrgUnit' => $e->getOrgUnit()->getUnitName(),
                    'Email' => $e->getEmail(),
                    'Phone' => $e->getPhone(),
                    'EmployeeCode' => $e->getEmployeeCode(),
                    'profilePicture' => $profilePic,
                );
                if ($e->getPositionId() > 0) {
                    array_push($employees['approvers'], $emp_data);
                } else {
                    array_push($employees['reporters'], $emp_data);
                }
            }
        }
        $data["employees"] = $employees;
        $this->apiResponse($data, 200, 'data for employees');
    }

    public function addEmployees()
    {
        $users = $this->app->Request()->getParameter("users", []);
        $reportingto = $this->app->Request()->getParameter("reportingto");
        $position = \entities\Base\PositionsQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->findPk($reportingto);
        if (!$position) {
            $this->apiResponse([], 500, 'Opps position does not exist, check your org');
            return;
        }
        $response = [];
        $role = 3;
        $designation = \entities\DesignationsQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId())
            ->orderByDesignationId(\Propel\Runtime\ActiveQuery\Criteria::DESC)
            ->findOne();
        $grade = \entities\GradeMasterQuery::create()->filterByCompanyId($this->app->Auth()->CompanyId())->findOne();
        $responseCode = 200;
        foreach ($users as $u) {
            $name = $u->name;
            $email = $u->email;
            $mobile = $u->mobile;
            $me = $this->app->Auth()->getUser()->getEmployee();
            $emp = \entities\UsersQuery::create()->findByUsername($email);
            if ($emp->count() > 0) {
                array_push($response, ["record" => $u, "StatusCode" => 400, "desc" => "Email already exists"]);
                $responseCode = 202;
                continue;
            }
            $employee = new \entities\Employee();
            $employee->setCompanyId($this->app->Auth()->CompanyId());
            $employee->setFirstName($name);
            $employee->setLastName("");
            $employee->setEmail($email);
            $employee->setPhone($mobile);
            $employee->setDesignations($designation);
            $employee->setGradeMaster($grade);
            $employee->setOrgUnit($me->getOrgUnit());
            $employee->setBranch($me->getBranch());
            $employee->setReportingTo($position->getPrimaryKey());
            $employee->setStatus(1);
            $employee->save();
            $tk = new \App\Utils\TokenGenerator();
            $randomPassword = $tk->generateToken(8);
            \Modules\HR\Runtime\HrHelper::createUser($employee, $role, $randomPassword, $this->app);
            array_push($response, ["record" => $u, "StatusCode" => 200, "desc" => "Invite Sent"]);
        }
        $this->apiResponse($response, $responseCode, count($users) . ' Invites Sent');
    }

    public function employeeActions($employeeId)
    {
        $action = strtolower($this->app->Request()->getParameter("action", ""));
        $employee = \entities\Base\EmployeeQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->findPk($employeeId);
        if (!$employee) {
            $this->apiResponse([], 400, "could not find employee");
            return;
        }
        switch ($action):
    case "makeapprover":
        $title = $this->app->Request()->getParameter("title");
        $reporting_to = $this->app->Request()->getParameter("reportingto");
        $position_exists = \entities\Base\PositionsQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->filterByPositionName($title)
            ->find();
        if ($position_exists->count() > 0) {
                $this->apiResponse([], 400, "position already exists with $title ");
                return;
        }
        $position = \entities\Base\PositionsQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->findPk($reporting_to);
        if (!$position) {
            $this->apiResponse([], 400, 'Opps position does not exist, check your org');
            return;
        }
        $newPosition = new \entities\Positions();
        $newPosition->setCompanyId($this->app->Auth()->CompanyId());
        $newPosition->setPositionName($title);
        $newPosition->setReportingTo($position->getPrimaryKey());
        $newPosition->save();
        $employee->setPositionId($newPosition->getPrimaryKey());
        $employee->setReportingTo($reporting_to);
        $employee->save();
        $this->apiResponse($employee->toArray(), 200, 'done');
        break;
    case "swapapprover":
        $with_emp_id = $this->app->Request()->getParameter("with_emp_id", 0);
        $newemployee = \entities\EmployeeQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->findPk($with_emp_id);
        if ($newemployee) {
            $newemployee->setPositionId($employee->getPositionId());
            $newemployee->setReportingTo($employee->getReportingTo());
            $newemployee->save();
        }
        $employee->setPositionId(null);
        $employee->save();
        $this->apiResponse($employee->toArray(), 200, 'done');
        break;
    case "changereporting":
        $reporting_to = $this->app->Request()->getParameter("reportingto");
        $position = \entities\Base\PositionsQuery::create()
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->findPk($reporting_to);
        if ($position == null) {
            $this->apiResponse([], 400, 'Opps position does not exist, check your org');
            return;
        }
        $employee->setReportingTo($reporting_to)->save();
        $this->apiResponse($employee->toArray(), 200, 'done');
        break;
    case "vacationmode":
        $enable = $this->app->Request()->getParameter("enable");
        $employee->setStatus($enable);
        $employee->save();
        $this->apiResponse($employee->toArray(), 200, 'done');
        break;
    default:
        $this->apiResponse([], 400, 'nothing selected, choose from makeapprover,swapapprover,changereporting,vacationmode');
        break;
        endswitch;
    }

    public function newCompanySignup()
    {
        $OwnerEmail = $this->app->Request()->getParameter("OwnerEmail");
        $exists = \entities\UsersQuery::create()
            ->findByUsername($OwnerEmail)->count();
        if ($exists > 0) {
            $this->apiResponse([], 400, 'Sorry, this email id already exists in the system!!!');
        } else {
            $company = new \entities\Company();
            $CompanyName = $this->app->Request()->getParameter("CompanyName");
            $OwnerEmail = $this->app->Request()->getParameter("OwnerEmail");
            $OwnerName = $this->app->Request()->getParameter("OwnerName");
            $Password = $this->app->Request()->getParameter("Password");
            $Currency = $this->app->Request()->getParameter("Currency");
            $CompanyContactNumber = $this->app->Request()->getParameter("CompanyContactNumber");
            $CountryId = $this->app->Request()->getParameter("CountryName");
            $CountryCurrency = \entities\GeoCountryQuery::create()->filterByIcountryid($CountryId)->findOne();
            $company->setOwnerName($OwnerName)
                ->setCompanyName($CompanyName)
                ->setOwnerEmail($OwnerEmail);
            if ($Currency) {
                $company->setCompanyDefaultCurrency($CountryCurrency->getScurrency());
            } else {
                $company->setCompanyDefaultCurrency(1);
            }
            $company->setCompanyContactNumber($CompanyContactNumber)
                ->save();
            \Modules\HR\Runtime\HrHelper::firstDataSetup($company->getPrimaryKey(), $Password, $this->app, $CountryId);
            $this->apiResponse([], 200, "Company has been created user the username : $OwnerEmail and Password : $Password in login api to continue");
        }
    }

    public function transaction()
    {
        switch ($this->app->Request()->getMethod()):
    case "POST":
        $advanceManager = new \Modules\HR\Runtime\AdvanceHelper($this->app);
        $employeeId = $this->app->Request()->getParameter("empid");
        $description = $this->app->Request()->getParameter("description");
        $date = \DateTime::createFromFormat("d/m/Y", $this->app->Request()->getParameter("date"))->format('Y-m-d');
        $amount = $this->app->Request()->getParameter("amount");
        $tran = $advanceManager->addAdvance($employeeId, $description, $date, $amount);
        $this->apiResponse($tran->toArray(), 200, 'Transaction added');
        break;
    case "GET":
        $advanceManager = new \Modules\HR\Runtime\AdvanceHelper($this->app);
        $employeeId = $this->app->Request()->getParameter("empid");
        $balance = $advanceManager->getBalance($employeeId);
        $trans = $advanceManager->getTransactions($employeeId);
        $this->apiResponse(["balance" => $balance, "transactions" => $trans->toArray()], 200, 'List');
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/balance",
     *     tags={"Expenses"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get expense list detail successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function balance()
    {
            $advanceManager = new \Modules\HR\Runtime\AdvanceHelper($this->app);
            switch ($this->app->Request()->getMethod()):
        case "GET":
            $employeeId = $this->app->Auth()->getUser()->getEmployeeId();
            $balance = $advanceManager->getBalance($employeeId);
            $trans = $advanceManager->getTransactions($employeeId);
            $this->apiResponse(["balance" => $balance, "transactions" => $trans], 200, 'List');
            break;
            endswitch;
    }

    public function employeeWorkLogDelete($workLogId)
    {
            try {
                $workLogDet = \Modules\ESS\Runtime\EssHelper::workLogDelete($workLogId);
                if ($workLogDet) {
                    $this->apiResponse(["status" => true], 200, "Delete Successfully.");
                } else {
                    $this->apiResponse(["status" => false], 400, "Cloud not find work log.");
                }
            } catch (\Exception $e) {
                $this->apiResponse([], 400, $e->getMessage());
            }
    }

    /**
     * @OA\Get(
     *     path="/api/getCountryList",
     *     tags={"Expenses"},
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
    public function getCountryList()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $getCountryList = \entities\GeoCountryQuery::create()->find()->toArray();
        if ($getCountryList > 0) {
                $this->apiResponse($getCountryList, 200, "get Records");
        } else {
            $this->apiResponse([], 400, "Country List Not Found");
        }
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/verifyMediaOutletCheckin",
     *     tags={"Attached Media API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="entity_pk",
     *         in="query",
     *         description="Entity Primary Key",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="purpose",
     *         in="query",
     *         description="Purpose",
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
    public function verifyMediaOutletCheckin()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $entityPk = $this->app->Request()->getParameter("entity_pk");
        $purpose = $this->app->Request()->getParameter("purpose");
        if ($entityPk != null && $entityPk != '') {
                if ($purpose != null && $purpose != '') {
                    $attachment = \entities\CheckInMediaQuery::create()
                        ->filterByEntityPk($entityPk)
                        ->filterByEntityName('OutletCheckin')
                        ->filterByPurpose($purpose)
                        ->find()->toArray();
                    if (count($attachment) > 0) {
                        $this->apiResponse($attachment, 200, "Get attachment successfully!");
                    } else {
                        $this->apiResponse([], 400, 'Attachment not found!');
                    }
                } else {
                    $this->apiResponse([], 400, 'Upload media pupose not found!');
                }
        } else {
            $this->apiResponse([], 400, 'Primary key not found!');
        }
        break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/attachMediaOutletCheckin",
     *     tags={"Attached Media API's"},
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
     *     @OA\Parameter(
     *         name="entity_pk",
     *         in="query",
     *         description="Entity Primary Key",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="purpose",
     *         in="query",
     *         description="Purpose",
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
    public function attachMediaOutletCheckin()
    {
        switch ($this->app->Request()->getMethod()):
    case "POST":
        $empID = $this->app->Auth()->getUser()->getEmployeeId();
        $companyID = $this->app->Auth()->getUser()->getCompanyId();
        $mediaId = $this->app->Request()->getParameter("media_id");
        $entityPk = $this->app->Request()->getParameter("entity_pk");
        $purpose = $this->app->Request()->getParameter("purpose");
        $gpsLocation = $this->app->Request()->getParameter("gps_location");
        if ($mediaId != null && $mediaId != '') {
                $outletCheckIn = \entities\OutletCheckinQuery::create()
                    ->filterByCheckInId($entityPk)
                    ->findOne();
                if ($outletCheckIn != null && $outletCheckIn != '') {
                    if ($purpose != null && $purpose != '') {
                        try {
                            $checkInMedia = new \entities\CheckInMedia();
                            $checkInMedia->setMediaId($mediaId);
                            $checkInMedia->setEntityPk($entityPk);
                            $checkInMedia->setEntityName('OutletCheckin');
                            $checkInMedia->setPurpose($purpose);
                            $checkInMedia->setGpsLocation($gpsLocation);
                            $checkInMedia->save();
                            $this->apiResponse($checkInMedia->toArray(), 200, "Outlet check in media insert successfully.");
                        } catch (\Exception $e) {
                            $this->apiResponse([], 400, $e->getMessage());
                        }
                    } else {
                        $this->apiResponse([], 400, 'Upload media purpose not found!');
                    }
                } else {
                    $this->apiResponse([], 400, 'Primary key not found!');
                }
        } else {
            $this->apiResponse([], 400, 'Media not found!');
        }
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/verifyMediaAttendance",
     *     tags={"Attached Media API's"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="entity_pk",
     *         in="query",
     *         description="Entity Primary Key",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="purpose",
     *         in="query",
     *         description="Purpose",
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
    public function verifyMediaAttendance()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $entityPk = $this->app->Request()->getParameter("entity_pk");
        $purpose = $this->app->Request()->getParameter("purpose");
        if ($entityPk != null && $entityPk != '') {
                if ($purpose != null && $purpose != '') {
                    $attachment = \entities\CheckInMediaQuery::create()
                        ->filterByEntityPk($entityPk)
                        ->filterByEntityName('Attendance')
                        ->filterByPurpose($purpose)
                        ->find()->toArray();
                    if (count($attachment) > 0) {
                        $this->apiResponse($attachment, 200, "Get attachment successfully!");
                    } else {
                        $this->apiResponse([], 400, 'Attachment not found!');
                    }
                } else {
                    $this->apiResponse([], 400, 'Upload media pupose not found!');
                }
        } else {
            $this->apiResponse([], 400, 'Primary key not found!');
        }
        break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/attachMediaAttendance",
     *     tags={"Attached Media API's"},
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
     *     @OA\Parameter(
     *         name="entity_pk",
     *         in="query",
     *         description="Entity Primary Key",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="purpose",
     *         in="query",
     *         description="Purpose",
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
    public function attachMediaAttendance()
    {
        switch ($this->app->Request()->getMethod()):
    case "POST":
        $empID = $this->app->Auth()->getUser()->getEmployeeId();
        $companyID = $this->app->Auth()->getUser()->getCompanyId();
        $mediaId = $this->app->Request()->getParameter("media_id");
        $entityPk = $this->app->Request()->getParameter("entity_pk");
        $purpose = $this->app->Request()->getParameter("purpose");
        $gpsLocation = $this->app->Request()->getParameter("gps_location");
        if ($mediaId != null && $mediaId != '') {
                $outletCheckIn = \entities\AttendanceQuery::create()
                    ->filterByAttendanceId($entityPk)
                    ->findOne();
                if ($outletCheckIn != null && $outletCheckIn != '') {
                    if ($purpose != null && $purpose != '') {
                        try {
                            $checkInMedia = new \entities\CheckInMedia();
                            $checkInMedia->setMediaId($mediaId);
                            $checkInMedia->setEntityPk($entityPk);
                            $checkInMedia->setEntityName('Attendance');
                            $checkInMedia->setPurpose($purpose);
                            $checkInMedia->setGpsLocation($gpsLocation);
                            $checkInMedia->save();
                            $this->apiResponse($checkInMedia->toArray(), 200, "Attendance media insert successfully.");
                        } catch (\Exception $e) {
                            $this->apiResponse([], 400, $e->getMessage());
                        }
                    } else {
                        $this->apiResponse([], 400, 'Upload media pupose not found!');
                    }
                } else {
                    $this->apiResponse([], 400, 'Primary key not found!');
                }
        } else {
            $this->apiResponse([], 400, 'Media not found!');
        }
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getAllExpenseStat",
     *     tags={"Expenses"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="month",
     *         in="query",
     *         description="Month",
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
     *         description="ResponseObj",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function getAllExpenseStat()
    {
        ini_set('memory_limit', '-1');
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $employeeID = $this->app->Request()->getParameter("employee_id");
        $companyID = $this->app->Auth()->getUser()->getCompanyId();
        $month = explode("|", $this->app->Request()->getParameter("month", "|"));

        $Start = date($month[0] . "00:00:01");
        $End = date($month[1] . '23:59:59');
        $myExpCount = [
            "Created" => 0, // 1
            "Submitted" => 0, // 2
            "Approved" => 0, // 3
            "Rejected" => 0, // 4
            "InAudit" => 0, // 5
            "Audited" => 0, // 6
            "Cancelled" => 0, // 7
            "Validated" => 0, // 8
            "Hold" => 0, // 9
            "ProceedforPayment" => 0, // 10
            //"Total" => 0,
        ];
        $myExp = \entities\ExpensesQuery::create()
            ->filterByExpenseDate($Start, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
            ->filterByExpenseDate($End, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
            ->filterByEmployeeId($employeeID)
            ->filterByCompanyId($companyID)
            ->find();
        foreach ($myExp as $mye) {
                if ($mye->getExpenseStatus() == 1) {
                    $myExpCount["Created"] = $myExpCount["Created"] + 1;
                } else if ($mye->getExpenseStatus() == 2) {
                    $myExpCount["Submitted"] = $myExpCount["Submitted"] + 1;
                } else if ($mye->getExpenseStatus() == 3) {
                    $myExpCount["Approved"] = $myExpCount["Approved"] + 1;
                } else if ($mye->getExpenseStatus() == 4) {
                    $myExpCount["Rejected"] = $myExpCount["Rejected"] + 1;
                } else if ($mye->getExpenseStatus() == 5) {
                    $myExpCount["InAudit"] = $myExpCount["InAudit"] + 1;
                } else if ($mye->getExpenseStatus() == 6) {
                    $myExpCount["Audited"] = $myExpCount["Audited"] + 1;
                } else if ($mye->getExpenseStatus() == 7) {
                    $myExpCount["Cancelled"] = $myExpCount["Cancelled"] + 1;
                } else if ($mye->getExpenseStatus() == 8) {
                    $myExpCount["Validated"] = $myExpCount["Validated"] + 1;
                } else if ($mye->getExpenseStatus() == 9) {
                    $myExpCount["Hold"] = $myExpCount["Hold"] + 1;
                } else if ($mye->getExpenseStatus() == 10) {
                    $myExpCount["ProceedforPayment"] = $myExpCount["ProceedforPayment"] + 1;
                }
                //$myExpCount["Total"] = $myExpCount["Total"] + 1;
        }
        $data['myExpenseStatus'] = $myExpCount;
        $this->apiResponse($data, 200, "Get all expense stat!");
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getEmployeeExpenses",
     *     tags={"Expenses"},
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
     *         description="Get employee expense list successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getEmployeeExpenses()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $employeeId = $this->app->Request()->getParameter("employee_id", $this->app->Auth()->getUser()->getEmployee()->getEmployeeId());
        try {
                $records = [];
                $records['Expense'] = \entities\ExpensesQuery::create()
                    ->filterByEmployeeId($employeeId)
                    ->find()->toArray();
                foreach ($records['Expense'] as &$row) {
                    $row['exp'] = \entities\ExpensesQuery::create()
                        ->filterByExpId($row['ExpId'])
                        ->findOne();
                    $row['month'] = date('F Y', strtotime($row['ExpenseDate']));
                }
                $grouped_array = array();
                foreach ($records as $element) {
                    foreach ($element as $elem) {
                        $grouped_array[$elem['month']][] = $elem;
                    }
                }
                $this->apiResponse($grouped_array, 200, "Get employee expense list successfully!");
        } catch (Exception $ex) {
            $this->apiResponse([], 400, $ex->getMessage());
        }
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getPlaceOfWork",
     *     tags={"Expenses"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get place of work successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getPlaceOfWork()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        try {
                $Branch = \entities\EmployeeQuery::create()
                    ->filterByEmployeeId($this->app->Auth()->getUser()->getEmployee()->getEmployeeId())
                    ->findOne();
                $placeofWork = $Branch->getBranch()->getBranchname() . " | " . $Branch->getBranch()->getGeoState()->getSstatename();
                $this->apiResponse([$placeofWork], 200, "Get place of work successfully!");
        } catch (Exception $ex) {
            $this->apiResponse([], 400, $ex->getMessage());
        }
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getExpenseListDetailsById",
     *     tags={"Expenses"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="list_detail_id",
     *         in="query",
     *         description="Expense list detail id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get expense list detail successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getExpenseListDetailsById()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $listDetailId = $this->app->Request()->getParameter("list_detail_id");
        try {
                $listDetail = \entities\ExpenseListDetailsQuery::create()
                    ->filterByExpDetId($listDetailId)
                    ->findOne()->toArray();
                $this->apiResponse($listDetail, 200, "Get expense list detail successfully!");
        } catch (Exception $ex) {
            $this->apiResponse([], 400, $ex->getMessage());
        }
        break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/updateExpenseListDetails",
     *     tags={"Expenses"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="expense_list_detail_id",
     *         in="query",
     *         description="Expense List Detail Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="image",
     *         in="query",
     *         description="Image",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="Description",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="amount",
     *         in="query",
     *         description="Amount",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Expense list detail update successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function updateExpenseListDetails()
    {
        switch ($this->app->Request()->getMethod()):
    case "POST":
        $employee = $this->app->Auth()->getUser()->getEmployee();
        $companyId = $this->app->Auth()->CompanyId();
        $expense_list_detail_id = $this->app->Request()->getParameter("expense_list_detail_id");
        $image = $this->app->Request()->getParameter("image");
        $description = $this->app->Request()->getParameter("description");
        $amount = $this->app->Request()->getParameter("amount");
        try {
                $expenseListDetail = \entities\ExpenseListDetailsQuery::create()
                    ->filterByExpDetId($expense_list_detail_id)
                    ->findOne();
                if ($expenseListDetail) {
                    if ($image != null && $image != '') {
                        $expenseListDetail->setImage($image);
                    }
                    $expenseListDetail->setDescription($description);
                    $expenseListDetail->setAmount($amount);
                    $expenseListDetail->save();
                    $this->apiResponse($expenseListDetail->toArray(), 200, "Expense list detail update successfully!");
                } else {
                    $this->apiResponse([], 400, "Expense details not found!");
                }
        } catch (Exception $ex) {
            $this->apiResponse([], 400, $ex->getMessage());
        }
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/deleteExpenseListDetails",
     *     tags={"Expenses"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="list_detail_id",
     *         in="query",
     *         description="Expense list detail id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Eexpense list detail deleted successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function deleteExpenseListDetails()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $listDetailId = $this->app->Request()->getParameter("list_detail_id");
        try {
                $listDetail = \entities\ExpenseListDetailsQuery::create()
                    ->filterByExpDetId($listDetailId)
                    ->find()->delete();
                $this->apiResponse([], 200, "Expense list detail deleted successfully!");
        } catch (Exception $ex) {
            $this->apiResponse([], 400, $ex->getMessage());
        }
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getExpenseListDetails",
     *     tags={"Expenses"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="exp_list_id",
     *         in="query",
     *         description="Expense list id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get expense list detail successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getExpenseListDetails()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $expListId = $this->app->Request()->getParameter("exp_list_id");
        try {
                $expListDetail = \entities\ExpenseListDetailsQuery::create()
                    ->filterByExpListId($expListId)
                    ->find()->toArray();
                $this->apiResponse($expListDetail, 200, "Get expense list detail successfully!");
        } catch (Exception $ex) {
            $this->apiResponse([], 400, $ex->getMessage());
        }
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/sendTestMail",
     *     tags={"Test"},
     *     @OA\Response(
     *         response="200",
     *         description="Send mail testing successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function sendTestMail()
    {
        $to = ['vishal.developments@gmail.com'];
        $subject = 'Test mail';
        $data = [
            "Title" => "TrueSales",
            "username" => "uday",
            "password" => "123456789",
            "ioslink" => "dfsdfdsfsd",
            "androidlink" => "dfsdfdsfsd",
            "baseurl" => "dfsdfdsfsd",
        ];
        //$body = $this->app->Renderer()->render("email\welcomeMail.twig", $data, false);

        $body = "Your ticket created susscessfully!";
        \App\Utils\SendMail::smtpSendMail($to, $subject, $body);
    }

    /**
     * @OA\Get(
     *     path="/api/getLeaveTypes",
     *     tags={"Leave Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get all leave type successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getLeaveTypes()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        try {
            $leaveTypes = \entities\LeaveTypeQuery::create()
                        ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
                        ->find()->toKeyValue("ShortCode","LeaveType");

                //$leaveTypes = $this->getConfig("ESS", "leaveType");
                $this->apiResponse($leaveTypes, 200, "Get all leave type successfully!");
        } catch (Exception $ex) {
            $this->apiResponse([], 400, $ex->getMessage());
        }
        break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/createLeave",
     *     tags={"Leave Management"},
     *      @OA\Parameter(
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
     *     @OA\Parameter(
     *         name="leave_type",
     *         in="query",
     *         description="Leave Type",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="from_date",
     *         in="query",
     *         description="From Date",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="to_date",
     *         in="query",
     *         description="To Date",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="remark",
     *         in="query",
     *         description="Enter Remark",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Leave created successfully.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function createLeave()
    {
        switch ($this->app->Request()->getMethod()):
    case "POST":
        $pk = 0;
        $employeeId = (int) $this->app->Request()->getParameter("employee_id");
        $leaveType = $this->app->Request()->getParameter("leave_type");
        $fromDate = $this->app->Request()->getParameter("from_date");
        $toDate = $this->app->Request()->getParameter("to_date");
        $remark = $this->app->Request()->getParameter("remark");
        $currentY = date('Y');
        $Sdate = DateTime::createFromFormat("Y-m-d", $fromDate)->format("Y");
        $Tdate = DateTime::createFromFormat("Y-m-d", $toDate)->format("Y");

        if ($Sdate > $currentY || $Tdate > $currentY) {
                $this->apiResponse([], 400, "You can not apply leave for next year.");
                return;
        }

        $employee = \entities\EmployeeQuery::create()
            ->filterByEmployeeId($employeeId)
            ->findOne();
        try {
            if ($fromDate > $toDate) {
                $this->apiResponse([], 400, "Start date needs to be earlier!");
            }
            if (LeaveManager::leaveRequestExists($employeeId, $fromDate, $toDate)) {
                $this->apiResponse([], 400, "There is a Leave that coincide with these dates");
                return;
            }
            $date1 = strtotime($fromDate);
            $date2 = strtotime($toDate);
            $diff = $date2 - $date1;
            $leaveReqDays = floor($diff / (60 * 60 * 24));

            $leaveReqTotalDays = $leaveReqDays + 1;

            $leavesCount = \entities\LeavesQuery::create()
                ->select(['LeavesCount'])
                ->withColumn('SUM(leave_points)', 'LeavesCount')
                ->filterByEmployeeId($employee->getPrimaryKey())
                ->filterByLeaveType($leaveType)
                ->filterByLeavePoints(-1, Criteria::NOT_EQUAL)
                ->find()->toArray();

            $leaveApproved = \entities\LeavesQuery::create()
                ->select(['LeavesCount'])
                ->withColumn('count(leave_points)', 'LeavesCount')
                ->filterByEmployeeId($employee->getPrimaryKey())
                ->filterByLeaveType($leaveType)
                ->filterByLeavePoints(-1, Criteria::EQUAL)
                ->find()->toArray();

            if (isset($leavesCount[0]) && $leavesCount[0] >= $leaveApproved[0]) {
                $pendingLeaveCount = $leavesCount[0] - $leaveApproved[0];
            } else {
                $pendingLeaveCount = 0;
            }

            if ($leaveType == 'LWP') {
                $entity = new \entities\LeaveRequest();
                $entity->setEmployeeId($employeeId);
                $entity->setLeaveType($leaveType);
                $entity->setLeaveFrom($fromDate);
                $entity->setLeaveTo($toDate);
                $entity->setLeaveStatus(1);
                $entity->setCompanyId($employee->getCompanyId());
                $entity->setLeaveReason($remark);
                $entity->save();
                if ($entity->getLeaveReqId() != null) {
                    $dates = EssHelper::date_range($fromDate, $toDate);
                    $clearDates = [];

                    // Holidays Check
                    $holidays = \entities\HolidaysQuery::create()->findByCompanyId($employee->getCompanyId());
                    $holidaydate = [];
                    $stateId = $employee->getBranch()->getIstateid();
                    foreach ($holidays as $holiday) {
                        if ($holiday->getIstateid() != null) {
                            $holidayState = explode(",", (string) $holiday->getIstateid());
                            if (in_array($stateId, $holidayState)) {
                                $holidaydate[] = $holiday->getHolidayDate()->format('Y-m-d');
                            }
                        }
                    }

                    //Sunday Check
                    foreach ($dates as $date) {
                        $day = $date;
                        $currentDate = DateTime::createFromFormat("Y-m-d", $day);
                        if ($currentDate->format("N") == 7) { // Sunday
                            continue;
                        }
                        if (in_array($currentDate->format("Y-m-d"), $holidaydate)) {
                            continue;
                        }
                        $clearDates[] = $day;
                    }

                    for ($i = 0; $i < $leaveReqTotalDays; $i++) {
                        if (isset($clearDates[$i])) {
                            $leaveEntity = new \entities\Leaves();
                            $leaveEntity->setEmployeeId($entity->getEmployeeId());
                            $leaveEntity->setLeaveRequestId($entity->getLeaveReqId());
                            $leaveEntity->setLeaveDate($clearDates[$i]);
                            $leaveEntity->setLeaveType($entity->getLeaveType());
                            $leaveEntity->setLeaveRemark($entity->getLeaveReason());
                            $leaveEntity->setLeavePoints(-1);
                            $leaveEntity->setCreatedAt(date('Y-m-d H:i:s'));
                            $leaveEntity->setCompanyId($employee->getCompanyId());
                            if ($leaveEntity->save()) {
                                // $title = "Leave Approved";
                                // $message = "Your leave approved!";
                                // $notification = NotificationManager::sendNotificationToEmployee($entity->getEmployeeId(), $title, $message);

                                $positionId = $entity->getEmployee()->getPositionId();
                                $mtpBlock = \entities\MtpDayQuery::create()
                                    ->filterByMtpDayDate($clearDates[$i])
                                    ->findOne();
                                if ($mtpBlock != null) {
                                    // if mtp is nto appoved
                                    $mtp = \entities\MtpQuery::create()
                                        ->filterByMtpId($mtpBlock->getMtpId())
                                        ->filterByPositionId($positionId)
                                        ->filterByMtpStatus('approved', \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                                        ->findOne();
                                    if ($mtp != null) {
                                        // Delete all Tourplan for that mtpday
                                        $tourPlanDelete = \entities\TourplansQuery::create()
                                            ->filterByTpDate($clearDates[$i])
                                            ->filterByPositionId($positionId)
                                            ->filterByMtpDayId($mtpBlock->getMtpDayId())
                                            ->delete();
                                        // Delete mtp day
                                        $mtpDay = \entities\MtpDayQuery::create()
                                            ->filterByMtpDayId($mtpBlock->getMtpDayId())
                                            ->delete();
                                        // run AGAIN Summary
                                        $manager = new \BI\manager\MTPManager();
                                        $mtp = $manager->getMTPById($mtp->getMtpId());
                                    }
                                    //MTP is approved
                                    // chintan needs to ask sachin.
                                }
                            }
                        }
                    }
                    if ($entity) {
                        $wfManager = new \Modules\System\Processes\WorkflowManager();
                        $wfManager->createLog("LeaveRequest", $entity, $employee, 0, "Leave Request Created", 0);
                        $wfManager->process("LeaveRequest", $entity, "");

                        return $this->apiResponse($entity->toArray(), 200, "Leave created successfully.");
                    }
                }
            } else {
                if ($pendingLeaveCount >= $leaveReqTotalDays) {
                    $entity = new \entities\LeaveRequest();
                    $entity->setEmployeeId($employeeId);
                    $entity->setLeaveType($leaveType);
                    $entity->setLeaveFrom($fromDate);
                    $entity->setLeaveTo($toDate);
                    $entity->setLeaveStatus(1);
                    $entity->setCompanyId($employee->getCompanyId());
                    $entity->setLeaveReason($remark);
                    $entity->save();
                    if ($entity->getLeaveReqId() != null) {
                        $dates = EssHelper::date_range($fromDate, $toDate);
                        $clearDates = [];

                        // Holidays Check
                        $holidays = \entities\HolidaysQuery::create()->findByCompanyId($employee->getCompanyId());
                        $holidaydate = [];
                        $stateId = $employee->getBranch()->getIstateid();
                        foreach ($holidays as $holiday) {
                            if ($holiday->getIstateid() != null) {
                                $holidayState = explode(",", (string) $holiday->getIstateid());
                                if (in_array($stateId, $holidayState)) {
                                    $holidaydate[] = $holiday->getHolidayDate()->format('Y-m-d');
                                }
                            }
                        }

                        //Sunday Check
                        foreach ($dates as $date) {
                            $day = $date;
                            $currentDate = DateTime::createFromFormat("Y-m-d", $day);
                            if ($currentDate->format("N") == 7) { // Sunday
                                continue;
                            }
                            if (in_array($currentDate->format("Y-m-d"), $holidaydate)) {
                                continue;
                            }
                            $clearDates[] = $day;
                        }

                        for ($i = 0; $i < $leaveReqTotalDays; $i++) {
                            if (isset($clearDates[$i])) {
                                $leaveEntity = new \entities\Leaves();
                                $leaveEntity->setEmployeeId($entity->getEmployeeId());
                                $leaveEntity->setLeaveRequestId($entity->getLeaveReqId());
                                $leaveEntity->setLeaveDate($clearDates[$i]);
                                $leaveEntity->setLeaveType($entity->getLeaveType());
                                $leaveEntity->setLeaveRemark($entity->getLeaveReason());
                                $leaveEntity->setLeavePoints(-1);
                                $leaveEntity->setCompanyId($employee->getCompanyId());
                                if ($leaveEntity->save()) {
                                    // $title = "Leave Approved";
                                    // $message = "Your leave approved!";
                                    // $notification = NotificationManager::sendNotificationToEmployee($entity->getEmployeeId(), $title, $message);

                                    $positionId = $entity->getEmployee()->getPositionId();
                                    $mtpBlock = \entities\MtpDayQuery::create()
                                        ->filterByMtpDayDate($clearDates[$i])
                                        ->findOne();
                                    if ($mtpBlock != null) {
                                        // if mtp is nto appoved
                                        $mtp = \entities\MtpQuery::create()
                                            ->filterByMtpId($mtpBlock->getMtpId())
                                            ->filterByPositionId($positionId)
                                            ->filterByMtpStatus('approved', \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                                            ->findOne();
                                        if ($mtp != null) {
                                            // Delete all Tourplan for that mtpday
                                            $tourPlanDelete = \entities\TourplansQuery::create()
                                                ->filterByTpDate($clearDates[$i])
                                                ->filterByPositionId($positionId)
                                                ->filterByMtpDayId($mtpBlock->getMtpDayId())
                                                ->delete();
                                            // Delete mtp day
                                            $mtpDay = \entities\MtpDayQuery::create()
                                                ->filterByMtpDayId($mtpBlock->getMtpDayId())
                                                ->delete();
                                            // run AGAIN Summary
                                            $manager = new \BI\manager\MTPManager();
                                            $mtp = $manager->getMTPById($mtp->getMtpId());
                                        }
                                        //MTP is approved
                                        // chintan needs to ask sachin.
                                    }
                                }
                            }
                        }
                        if ($entity) {
                            $wfManager = new \Modules\System\Processes\WorkflowManager();
                            $wfManager->createLog("LeaveRequest", $entity, $employee, 0, "Leave Request Created", 0);
                            $wfManager->process("LeaveRequest", $entity, "");

                            return $this->apiResponse($entity->toArray(), 200, "Leave created successfully.");
                        }
                    }

                } else {
                    return $this->apiResponse([], 400, "There is not enough leave balance for " . $leaveType . ".");
                }
            }
        } catch (Exception $ex) {
            $this->apiResponse([], 400, $ex->getMessage());
        }
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getEmployeeLeave",
     *     tags={"Leave Management"},
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
     *     @OA\Parameter(
     *         name="from_date",
     *         in="query",
     *         description="From Date",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="to_date",
     *         in="query",
     *         description="To Date",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get all leave successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getEmployeeLeave()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $employeeId = $this->app->Request()->getParameter("employee_id");
        $fromDate = $this->app->Request()->getParameter("from_date");
        $toDate = $this->app->Request()->getParameter("to_date");
        ///diff
        $fromDateObj = new \DateTime($fromDate);
        $toDateObj = new \DateTime($toDate);
        $dateInterval = date_diff($fromDateObj, $toDateObj);
        $dateDifferenceInDays = $dateInterval->days;

        try {
                $leaveRequests = \entities\LeaveRequestQuery::create()
                    ->filterByEmployeeId((int) $employeeId)
                    ->filterByLeaveFrom($fromDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByLeaveTo($toDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->find()->toArray();

                $approvedLeaveRequests = \entities\LeaveRequestQuery::create()
                    ->filterByEmployeeId((int) $employeeId)
                    ->filterByLeaveFrom($fromDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByLeaveTo($toDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->filterByLeaveStatus(2)
                    ->find()->toArray();

                $leaveDates = array();
                foreach ($approvedLeaveRequests as $approvedLeaveRequest) {
                    if (isset($approvedLeaveRequest['LeaveFrom']) && isset($approvedLeaveRequest['LeaveTo'])) {
                        $dates = EssHelper::date_range($approvedLeaveRequest['LeaveFrom'], $approvedLeaveRequest['LeaveTo']);
                        foreach ($dates as $date) {
                            array_push($leaveDates, $date);
                        }
                    }
                }

                $employee = \entities\EmployeeQuery::create()->findPk((int) $employeeId);
                $stateId = $employee->getBranch()->getIstateid();

                $holidaydate = [];
                $holidays = \entities\HolidaysQuery::create()
                    ->filterByHolidayDate($fromDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByHolidayDate($toDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->findByCompanyId($this->app->Auth()->CompanyId());
                foreach ($holidays as $holiday) {
                    if ($holiday->getIstateid() != null) {
                        $holidayState = explode(",", (string) $holiday->getIstateid());
                        if (in_array($stateId, $holidayState)) {
                            $holidaydate[] = $holiday->getHolidayDate()->format('Y-m-d');
                        }
                    }
                }

                $weekoff = [];
                $dates = EssHelper::date_range($fromDate, $toDate);
                foreach ($dates as $date) {
                    $currentDate = DateTime::createFromFormat("Y-m-d", $date);
                    if ($currentDate->format("N") == 7) { // Sunday
                        $weekoff[] = $date;
                    }
                }
                $totalCount = ($dateDifferenceInDays - (count($weekoff) + count($holidaydate)));
                $data = array(
                    "LeaveRequest" => $leaveRequests,
                    "ApprovedLeave" => array_unique($leaveDates),
                    "Holiday" => $holidaydate,
                    "WeekOff" => $weekoff,
                    "TotalLeaveCount" => $totalCount,
                );

                if (count($data) > 0) {
                    $this->apiResponse($data, 200, "Get all leave successfully!");
                } else {
                    $this->apiResponse([], 400, "Leave requests not found!");
                }
        } catch (Exception $ex) {
            $this->apiResponse([], 400, $ex->getMessage());
        }
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getEmployeePendingLeave",
     *     tags={"Leave Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="from_date",
     *         in="query",
     *         description="From Date",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="to_date",
     *         in="query",
     *         description="To Date",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get all leave successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getEmployeePendingLeave()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $fromDate = $this->app->Request()->getParameter("from_date");
        $toDate = $this->app->Request()->getParameter("to_date");
        try {
                $reqs = WorkflowManager::getPendingRequestPks("LeaveRequest", $this->app);
                $leaveReq = \entities\LeaveRequestQuery::create()
                    ->filterByLeaveReqId($reqs)
                    ->filterByLeaveFrom($fromDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByLeaveTo($toDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->find()->toArray();
                if (count($leaveReq) > 0) {
                    $this->apiResponse($leaveReq, 200, "Get all leave successfully!");
                } else {
                    $this->apiResponse([], 400, "Leave requests not found!");
                }
        } catch (Exception $ex) {
            $this->apiResponse([], 400, $ex->getMessage());
        }
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getLeaveById",
     *     tags={"Leave Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="leave_id",
     *         in="query",
     *         description="Leave request id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get leave detail successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getLeaveById()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $leaveId = $this->app->Request()->getParameter("leave_id");
        try {
                $leaveRequests = \entities\LeaveRequestQuery::create()
                    ->filterByLeaveReqId($leaveId)
                    ->find()->toArray();
                $this->apiResponse($leaveRequests, 200, "Get leave detail successfully!");
        } catch (Exception $ex) {
            $this->apiResponse([], 400, $ex->getMessage());
        }
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getEmployeeLeaveBalance",
     *     tags={"Leave Management"},
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
     *     @OA\Parameter(
     *         name="year",
     *         in="query",
     *         description="Year",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get all leave successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getEmployeeLeaveBalance()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $employeeId = $this->app->Request()->getParameter("employee_id");
        $year = $this->app->Request()->getParameter("year");

        try {
                $empLeaveBalance = \entities\EmployeeLeaveBalanceQuery::create()
                    ->filterByEmployeeId((int) $employeeId)
                    ->filterByLeaveYear($year)
                    ->find()->toArray();

                $yearStartDate = date('Y-m-d', mktime(0, 0, 0, 1, 1, (int) $year));
                $yearEndDate = date('Y-m-d', mktime(0, 0, 0, 1, 0, (int) $year + 1));
                $data = array();
                $dataKeys = array();
                foreach ($empLeaveBalance as $empLeaveBal) {
                    $leaveType = $empLeaveBal["LeaveType"];
                    $inProgress = \entities\Base\LeaveRequestQuery::create()
                        ->filterByLeaveFrom($yearStartDate, Criteria::GREATER_EQUAL)
                        ->filterByLeaveTo($yearEndDate, Criteria::LESS_EQUAL)
                        ->filterByEmployeeId($empLeaveBal["EmployeeId"])
                        ->filterByLeaveStatus(1)
                        ->filterByLeaveType($empLeaveBal["LeaveType"])
                        ->find()->count();
                    if (!array_key_exists($leaveType, $data)) {
                        $data[$leaveType] = array(
                            'EmployeeId' => $empLeaveBal["EmployeeId"],
                            'LeaveYear' => $empLeaveBal["LeaveYear"],
                            'LeaveType' => $empLeaveBal["LeaveType"],
                            'Accuration' => $empLeaveBal["Accuration"],
                            'Opening' => $empLeaveBal["Opening"],
                            'Reward' => $empLeaveBal["Reward"],
                            'Consumed' => $empLeaveBal["Consumed"],
                            'Balance' => $empLeaveBal["Balance"],
                            'InProgress' => $inProgress,
                        );
                    }
                    $dataKeys[$leaveType] = $leaveType;
                }
                $leaveTy = \entities\LeaveTypeQuery::create()
                        ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
                        ->find()->toKeyValue("ShortCode","LeaveType");
                //$leaveTy = $this->getConfig("ESS", "leaveType");
                $results = array_diff_key($leaveTy, $dataKeys);
                if (count($results) > 0) {
                    foreach ($results as $key => $value) {
                        $data[$key] = array(
                            'EmployeeId' => $employeeId,
                            'LeaveYear' => $year,
                            'LeaveType' => $key,
                            'Accuration' => 0,
                            'Opening' => 0,
                            'Reward' => 0,
                            'Consumed' => 0,
                            'Balance' => 0,
                            'InProgress' => 0,
                        );
                    }
                }
                $this->apiResponse($data, 200, "Get employee leave successfully!");
        } catch (Exception $ex) {
            $this->apiResponse([], 400, $ex->getMessage());
        }
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getLeaveStatus",
     *     tags={"Leave Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get all leave status successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function getLeaveStatus()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        try {
                $leaveStatus = $this->getConfig("ESS", "leaveStatus");
                $this->apiResponse($leaveStatus, 200, "Get all leave status successfully!");
        } catch (Exception $ex) {
            $this->apiResponse([], 400, $ex->getMessage());
        }
        break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/leaveApprove",
     *     tags={"Leave Management"},
     *      @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="leave__request_id",
     *         in="query",
     *         description="Leave request Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Leave Approved successfully.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function leaveApprove()
    {
        switch ($this->app->Request()->getMethod()):
    case "POST":
        $leaveId = (int) $this->app->Request()->getParameter("leave__request_id");
        $employee = $this->app->Auth()->getUser()->getEmployee();
        $remark = null;
        try {
                $entity = \entities\LeaveRequestQuery::create()->findPk($leaveId);

                $FromDate = $entity->getLeaveFrom();
                $ToDate = $entity->getLeaveTo();
                $pos_diff = $FromDate->diff($ToDate)->format("%r%a");
                $dates = \Modules\ESS\Runtime\EssHelper::date_range($FromDate->format('Y-m-d'), $ToDate->format('Y-m-d'));
                $leaveType = $entity->getLeaveType();

                $leaveClearDates = [];

                // Holidays Check
                $holidays = \entities\HolidaysQuery::create()->findByCompanyId($employee->getCompanyId());
                $holidaydate = [];
                $stateId = $employee->getBranch()->getIstateid();
                foreach ($holidays as $holiday) {
                    if ($holiday->getIstateid() != null) {
                        $holidayState = explode(",", (string) $holiday->getIstateid());
                        if (in_array($stateId, $holidayState)) {
                            $holidaydate[] = $holiday->getHolidayDate()->format('Y-m-d');
                        }
                    }
                }

                //Sunday Check
                foreach ($dates as $date) {
                    $day = $date;
                    $currentDate = DateTime::createFromFormat("Y-m-d", $day);
                    if ($currentDate->format("N") == 7) { // Sunday
                        continue;
                    }
                    if (in_array($currentDate->format("Y-m-d"), $holidaydate)) {
                        continue;
                    }
                    $leaveClearDates[] = $day;
                }

                $clearDatesCount = count($leaveClearDates);

                $daysTotal = $pos_diff + 1;

                $leavesPoint = \entities\LeavesQuery::create()
                    ->select(['Leaves'])
                    ->withColumn('SUM(leave_points)', 'Leaves')
                    ->filterByEmployeeId($entity->getEmployeeId())
                    ->filterByLeaveType($entity->getLeaveType())
                    ->filterByLeavePoints(-1, Criteria::NOT_EQUAL)
                    ->find()->toArray();
                $leaves = \entities\LeavesQuery::create()
                    ->filterByEmployeeId($entity->getEmployeeId())
                    ->filterByLeaveType($entity->getLeaveType())
                    ->filterByLeavePoints(-1, Criteria::EQUAL)
                    ->find()->count();
                if (isset($leavesPoint[0]) && $leavesPoint[0] > $leaves) {
                    $pendingLeave = $leavesPoint[0] - $leaves;
                } else {
                    $pendingLeave = 0;
                }

                if ($entity) {
                    $leaveExsist = \entities\LeavesQuery::create()
                        ->select(['leave_date'])
                        ->filterByLeaveDate($entity->getLeaveFrom(), Criteria::GREATER_EQUAL)
                        ->filterByLeaveDate($entity->getLeaveTo(), Criteria::LESS_EQUAL)
                        ->filterByEmployeeId($entity->getEmployeeId())
                        ->filterByLeaveRequestId($entity->getLeaveReqId())
                        ->filterByLeaveType($entity->getLeaveType())
                        ->find()->toArray();//->count();
    
                    if (empty($leaveExsist)) {
                        if ($entity->getLeaveType() == 'LWP') {
                            $lrRequest = new \entities\LeaveRequest();
                            $lrRequest->setEmployeeId($entity->getEmployeeId());
                            $lrRequest->setLeaveType($entity->getLeaveType());
                            $lrRequest->setLeaveFrom($FromDate);
                            $lrRequest->setLeaveTo($ToDate);
                            $lrRequest->setLeaveStatus(1);
                            $lrRequest->setCompanyId($employee->getCompanyId());
                            $lrRequest->setLeaveReason($remark);
                            $lrRequest->save();
                            if ($lrRequest->getLeaveReqId() != null) {
                                $dates = EssHelper::date_range($FromDate->format('Y-m-d'), $ToDate->format('Y-m-d'));
                                $clearDates = [];

                                // Holidays Check
                                $holidays = \entities\HolidaysQuery::create()->findByCompanyId($employee->getCompanyId());
                                $holidaydate = [];
                                $stateId = $employee->getBranch()->getIstateid();
                                foreach ($holidays as $holiday) {
                                    if ($holiday->getIstateid() != null) {
                                        $holidayState = explode(",", (string) $holiday->getIstateid());
                                        if (in_array($stateId, $holidayState)) {
                                            $holidaydate[] = $holiday->getHolidayDate()->format('Y-m-d');
                                        }
                                    }
                                }

                                //Sunday Check
                                foreach ($dates as $date) {
                                    $day = $date;
                                    $currentDate = DateTime::createFromFormat("Y-m-d", $day);
                                    if ($currentDate->format("N") == 7) { // Sunday
                                        continue;
                                    }
                                    if (in_array($currentDate->format("Y-m-d"), $holidaydate)) {
                                        continue;
                                    }
                                    $clearDates[] = $day;
                                }

                                for ($i = 0; $i < $daysTotal; $i++) {
                                    if (isset($clearDates[$i])) {
                                        $leaveEntity = new \entities\Leaves();
                                        $leaveEntity->setEmployeeId($entity->getEmployeeId());
                                        $leaveEntity->setLeaveRequestId($entity->getLeaveReqId());
                                        $leaveEntity->setLeaveDate($clearDates[$i]);
                                        $leaveEntity->setLeaveType($entity->getLeaveType());
                                        $leaveEntity->setLeaveRemark($entity->getLeaveReason());
                                        $leaveEntity->setLeavePoints(-1);
                                        $leaveEntity->setCompanyId($employee->getCompanyId());
                                        if ($leaveEntity->save()) {
                                            // $title = "Leave Approved";
                                            // $message = "Your leave approved!";
                                            // $notification = NotificationManager::sendNotificationToEmployee($entity->getEmployeeId(), $title, $message);

                                            $positionId = $entity->getEmployee()->getPositionId();
                                            $mtpBlock = \entities\MtpDayQuery::create()
                                                ->filterByMtpDayDate($clearDates[$i])
                                                ->findOne();
                                            if ($mtpBlock != null) {
                                                // if mtp is nto appoved
                                                $mtp = \entities\MtpQuery::create()
                                                    ->filterByMtpId($mtpBlock->getMtpId())
                                                    ->filterByPositionId($positionId)
                                                    ->filterByMtpStatus('approved', \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                                                    ->findOne();
                                                if ($mtp != null) {
                                                    // Delete all Tourplan for that mtpday
                                                    $tourPlanDelete = \entities\TourplansQuery::create()
                                                        ->filterByTpDate($clearDates[$i])
                                                        ->filterByPositionId($positionId)
                                                        ->filterByMtpDayId($mtpBlock->getMtpDayId())
                                                        ->delete();
                                                    // Delete mtp day
                                                    $mtpDay = \entities\MtpDayQuery::create()
                                                        ->filterByMtpDayId($mtpBlock->getMtpDayId())
                                                        ->delete();
                                                    // run AGAIN Summary
                                                    $manager = new \BI\manager\MTPManager();
                                                    $mtp = $manager->getMTPById($mtp->getMtpId());
                                                }
                                                //MTP is approved
                                                // chintan needs to ask sachin.
                                            }
                                        }
                                    }
                                }
                            }
                        } else {
                            // if ($clearDatesCount > $pendingLeave){
                            //     return $this->apiResponse([], 400, "You have only" . ' ' . $pendingLeave . ' ' . "leaves !");
                            // }

                            // $empl = \entities\EmployeeQuery::create()->findPk($entity->getEmployeeId());
                            // $clearDates = [];
                            // $holidays = \entities\HolidaysQuery::create()
                            //     ->findByCompanyId($this->app->Auth()->CompanyId());
                            // $holidaydate = [];
                            // $stateId = $empl->getBranch()->getIstateid();
                            // foreach ($holidays as $holiday) {
                            //     if ($holiday->getIstateid() != null) {
                            //         $holidayState = explode(",", (string)$holiday->getIstateid());
                            //         if (in_array($stateId, $holidayState)) {
                            //             $holidaydate[] = $holiday->getHolidayDate()->format('Y-m-d');
                            //         }
                            //     }
                            // }
                            // foreach ($dates as $date) {
                            //     $day = $date;
                            //     $currentDate = DateTime::createFromFormat("Y-m-d", $day);
                            //     if ($currentDate->format("N") == 7) // Sunday
                            //     {
                            //         continue;
                            //     }
                            //     if (in_array($currentDate->format("Y-m-d"), $holidaydate)) {
                            //         continue;
                            //     }
                            //     $clearDates[] = $day;
                            // }
                            
                            $entity->setLeaveStatus(2);
                            $entity->save();

                            // for ($i = 0; $i <= $pos_diff; $i++) {
                            //     if(isset($clearDates[$i])){
                            //         $leaveEntity = new \entities\Leaves();
                            //         $leaveEntity->setEmployeeId($entity->getEmployeeId());
                            //         $leaveEntity->setLeaveRequestId($entity->getLeaveReqId());
                            //         $leaveEntity->setLeaveDate($clearDates[$i]);
                            //         $leaveEntity->setLeaveType($entity->getLeaveType());
                            //         $leaveEntity->setLeaveRemark($entity->getLeaveReason());
                            //         $leaveEntity->setLeavePoints(-1);
                            //         $leaveEntity->setCompanyId($this->app->Auth()->CompanyId());
                            //         if ($leaveEntity->save()) {
                            //             $positionId = $entity->getEmployee()->getPositionId();
                            //             $mtpBlock = \entities\MtpDayQuery::create()
                            //                 ->filterByMtpDayDate($clearDates[$i])
                            //                 ->findOne();
                            //             if ($mtpBlock != null) {
                            //                 $mtp = \entities\MtpQuery::create()
                            //                     ->filterByMtpId($mtpBlock->getMtpId())
                            //                     ->filterByPositionId($positionId)
                            //                     ->filterByMtpStatus('approved', Criteria::NOT_EQUAL)
                            //                     ->findOne();
                            //                 if ($mtp != null) {
                            //                     $tourPlanDelete = \entities\TourplansQuery::create()
                            //                         ->filterByTpDate($clearDates[$i])
                            //                         ->filterByPositionId($positionId)
                            //                         ->filterByMtpDayId($mtpBlock->getMtpDayId())
                            //                         ->delete();
                            //                     $mtpDay = \entities\MtpDayQuery::create()
                            //                         ->filterByMtpDayId($mtpBlock->getMtpDayId())
                            //                         ->delete();
                            //                     $manager = new \BI\manager\MTPManager();
                            //                     $mtp = $manager->getMTPById($mtp->getMtpId());
                            //                 }
                            //                 //MTP is approved
                            //                 // chintan needs to ask sachin.
                            //             }
                            //         }
                            //     }
                            // }
                        }

                        $wfManager = new \Modules\System\Processes\WorkflowManager();
                        $wfManager->createLog("LeaveRequest", $entity, $employee, 0, "Leave Approved", 0);
                        $wfManager->process("LeaveRequest", $entity, "");
                        $title = "Leave Approved";
                        $message = "Your leave approved!";
                        $notification = NotificationManager::sendNotificationToEmployee($entity->getEmployeeId(), $title, $message);
                        $this->apiResponse($entity->toArray(), 200, "Leave Approved successfully.");
                    } else {
                        // if($entity->getLeaveType() != 'LWP'){
                        //     if ($clearDatesCount > $pendingLeave){
                        //         return $this->apiResponse([], 400, "You have only" . ' ' . $pendingLeave . ' ' . "leaves !");
                        //     }
                        // }
                        $attenadances = \entities\AttendanceQuery::create()
                                        ->filterByEmployeeId($entity->getEmployeeId()) // Chintan : Changed from Employee to Entity
                                       ->filterByAttendanceDate($leaveExsist,Criteria::IN)
                                       ->find()->toArray();          
                        if($attenadances){
                            foreach($attenadances as $att)
                            {  
                                if($att['Status'] == 0 || $att['Status'] == -1)
                                {
                                    $attenadance = \entities\AttendanceQuery::create()->findPk($att['AttendanceId']);
                                    $attenadance->setStatus(4);
                                    $attenadance->setEndTime('00:00:00');
                                    $attenadance->setRemark('Punch Leave - R7289');
                                    $attenadance->save();  
                                }
                                if($att['Status'] == 1)
                                {
                                    $attenadance = \entities\AttendanceQuery::create()->findPk($att['AttendanceId']);
                                    $attenadance->setStatus(4);
                                    $attenadance->setRemark('Punch Leave - R7289');
                                    $attenadance->setExpenseId(null);
                                    $attenadance->save(); 

                                    $exp = \entities\ExpensesQuery::create()
                                            ->filterByEmployeeId($att['EmployeeId'])
                                            ->filterByExpenseDate($att['AttendanceDate'])
                                            ->findOne();
                                            if ($exp) {
                                                $explist = \entities\ExpenseListQuery::create()
                                                    ->filterByExpId($exp->getExpId())
                                                    ->find();
                                                if (!$explist->isEmpty()) 
                                                {
                                                 foreach ($explist as $expenseItem) {
                                                    $expenseDetails = \entities\ExpenseListDetailsQuery::create()
                                                        ->filterByExpListId($expenseItem->getExpListId())
                                                        ->find();
                                                    if (!$expenseDetails->isEmpty()) {    
                                                        foreach ($expenseDetails as $detail) {
                                                         $detail->delete();
                                                        }
                                                    }
                                                    // Delete the current ExpenseList record
                                                    $expenseItem->delete();
                                                  }
                                                }
                                                // Finally, delete the Expense record
                                                $exp->delete();
                                            }
                                } 
                            }
                        }
                
                        $entity->setLeaveStatus(2);
                        $entity->save();

                        $wfManager = new \Modules\System\Processes\WorkflowManager();
                        $wfManager->createLog("LeaveRequest", $entity, $employee, 0, "Leave Approved", 0);
                        $wfManager->process("LeaveRequest", $entity, "");
                        $title = "Leave Approved";
                        $message = "Your leave approved!";
                        $notification = NotificationManager::sendNotificationToEmployee($entity->getEmployeeId(), $title, $message);

                        $this->apiResponse($entity->toArray(), 200, "Leave Approved successfully.");
                    }
                }
        } catch (Exception $ex) {
            $this->apiResponse([], 400, $ex->getMessage());
        }
        break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/leaveReject",
     *     tags={"Leave Management"},
     *      @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="leave__request_id",
     *         in="query",
     *         description="Leave request Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="leave_reject_remark",
     *         in="query",
     *         description="Leave reject remark",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Leave Rejected.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function leaveReject()
    {
        switch ($this->app->Request()->getMethod()):
    case "POST":
        $leaveId = (int) $this->app->Request()->getParameter("leave__request_id");
        $employee = $this->app->Auth()->getUser()->getEmployee();
        $leaveRemark = $this->app->Request()->getParameter("leave_reject_remark");
        try {
                $entity = \entities\LeaveRequestQuery::create()
                    ->filterByLeaveReqId($leaveId)
                    ->findOne();
                if ($entity != null) {
                    $entity->setLeaveRejectRemark($leaveRemark);
                    $entity->setLeaveStatus(3);
                    $entity->save();
                    if ($entity->getLeaveReqId() != null) {
                        // $pendingLeaveCount = \entities\EmployeeLeaveBalanceQuery::create()
                        //     ->filterByEmployeeId($entity->getEmployeeId())
                        //     ->filterByLeaveType($entity->getLeaveType())
                        //     ->findOne();
                        $leaves = \entities\LeavesQuery::create()
                            ->filterByLeaveRequestId($entity->getLeaveReqId())
                            ->filterByLeavePoints(-1)
                            ->filterByLeaveType($entity->getLeaveType())
                            ->find();

                        // $othersLeaves = \entities\LeavesQuery::create()
                        //     ->select(['LeaveBalanceSum'])
                        //     ->withColumn('sum(leave_points)','LeaveBalanceSum')
                        //     ->filterByLeaveRequestId($entity->getLeaveReqId())
                        //     ->filterByLeavePoints(-1,Criteria::NOT_EQUAL)
                        //     ->filterByLeaveTranMode('Opening',Criteria::NOT_EQUAL)
                        //     ->filterByLeaveType($entity->getLeaveType())
                        //     ->find()->toArray();

                        if ($leaves != null) {
                            //$leavBalance = $leaves->count() - $othersLeaves[0];

                            // $leaveIncre = new \entities\Leaves();
                            // $leaveIncre->setEmployeeId($entity->getEmployeeId());
                            // $leaveIncre->setLeaveRequestId($entity->getLeaveReqId());
                            // $leaveIncre->setLeaveDate(date('Y-m-d'));
                            // $leaveIncre->setLeaveType($entity->getLeaveType());
                            // $leaveIncre->setLeavePoints($leaves->count());
                            // $leaveIncre->save();

                            // $leaveIncre = \entities\LeavesQuery::create()
                            //     ->filterByEmployeeId($entity->getEmployeeId())
                            //     ->filterByLeaveType($entity->getLeaveType())
                            //     ->filterByLeaveTranMode('Opening')
                            //     ->findOne();
                            // if ($leaveIncre != null) {
                            //     if(isset($othersLeaves[0])){
                            //         if($othersLeaves[0] > $leaves->count()){
                            //             $leavBalance = $othersLeaves[0] - $leaves->count();
                            //         }else{
                            //             $leavBalance = $leaves->count() - $othersLeaves[0];
                            //         }
                            //         $leavePo = $pendingLeaveCount->getBalance() + $leavBalance;
                            //     }else{
                            //         $leavePo = $pendingLeaveCount->getBalance() + $leaves->count();
                            //     }

                            //     $leaveIncre->setLeavePoints($leavePo);
                            //     $leaveIncre->save();
                            // }
                        }
                        $leaves->delete();

                        $wfManager = new \Modules\System\Processes\WorkflowManager();
                        $wfManager->createLog("LeaveRequest", $entity, $employee, 0, "Leave Rejected", 0);
                        $wfManager->process("LeaveRequest", $entity, "");

                        $title = "Leave Rejected";
                        $message = "Your leave reject!";
                        $notification = NotificationManager::sendNotificationToEmployee($entity->getEmployeeId(), $title, $message);

                        $this->apiResponse($entity->toArray(), 200, "Leave Rejected.");
                    }
                } else {
                    $this->apiResponse([], 400, "Leave request not found!");
                }
        } catch (Exception $ex) {
            $this->apiResponse([], 400, $ex->getMessage());
        }
        break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/leaveCancelled",
     *     tags={"Leave Management"},
     *      @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="leave_request_id",
     *         in="query",
     *         description="Leave Request Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="leave_cancel_remark",
     *         in="query",
     *         description="Leave cancel remark",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Leave Rejected.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function leaveCancelled()
    {
        switch ($this->app->Request()->getMethod()):
    case "POST":
        $leaveId = (int) $this->app->Request()->getParameter("leave_request_id");
        $employee = $this->app->Auth()->getUser()->getEmployee();
        $leaveCancelRemark = $this->app->Request()->getParameter("leave_cancel_remark");
        try {
                $leaveRequest = \entities\LeaveRequestQuery::create()->findPk($leaveId);
                $leaveRequest->setLeaveStatus(4);
                $leaveRequest->save();
                if ($leaveRequest->getLeaveReqId() != null) {
                    // $pendingLeaveCount = \entities\EmployeeLeaveBalanceQuery::create()
                    //     ->filterByEmployeeId($leaveRequest->getEmployeeId())
                    //     ->filterByLeaveType($leaveRequest->getLeaveType())
                    //     ->findOne();
                    $leaves = \entities\LeavesQuery::create()
                        ->filterByLeaveRequestId($leaveRequest->getLeaveReqId())
                        ->filterByLeavePoints(-1)
                        ->filterByLeaveType($leaveRequest->getLeaveType())
                        ->find();

                    // $othersLeaves = \entities\LeavesQuery::create()
                    //     ->select(['LeaveBalanceSum'])
                    //     ->withColumn('sum(leave_points)','LeaveBalanceSum')
                    //     ->filterByLeaveRequestId($leaveRequest->getLeaveReqId())
                    //     ->filterByLeavePoints(-1,Criteria::NOT_EQUAL)
                    //     ->filterByLeaveType($leaveRequest->getLeaveType())
                    //     ->find()->toArray();
                    if ($leaves != null) {
                        // $leaveIncre = \entities\LeavesQuery::create()
                        //     ->filterByEmployeeId($leaveRequest->getEmployeeId())
                        //     ->filterByLeaveType($leaveRequest->getLeaveType())
                        //     ->filterByLeaveTranMode('Opening')
                        //     ->findOne();
                        // if ($leaveIncre != null) {
                        //     if(isset($othersLeaves[0])){
                        //         if($othersLeaves[0] > $leaves->count()){
                        //             $leavBalance = $othersLeaves[0] - $leaves->count();
                        //         }else{
                        //             $leavBalance = $leaves->count() - $othersLeaves[0];
                        //         }
                        //         $leavePo = $pendingLeaveCount->getBalance() + $leavBalance;
                        //     }else{
                        //         $leavePo = $pendingLeaveCount->getBalance() + $leaves->count();
                        //     }
                        //     $leaveIncre->setLeavePoints($leavePo);
                        //     $leaveIncre->save();
                        // }
                    }
                    $leaves->delete();

                    $title = "Leave Cancelled";
                    $message = "Your leave cancell!";
                    $notification = NotificationManager::sendNotificationToEmployee($leaveRequest->getEmployeeId(), $title, $message);

                    $this->apiResponse($leaveRequest->toArray(), 200, "Leave Cancelled.");
                }
        } catch (Exception $ex) {
            $this->apiResponse([], 400, $ex->getMessage());
        }
        break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/punchLeave",
     *     tags={"Leave Management"},
     *      @OA\Parameter(
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
     *     @OA\Parameter(
     *         name="date",
     *         in="query",
     *         description="Date",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="remark",
     *         in="query",
     *         description="Enter Remark",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Punch leave successfully.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function punchLeave()
    {
        switch ($this->app->Request()->getMethod()):
    case "POST":
        $pk = 0;
        $employeeId = (int) $this->app->Request()->getParameter("employee_id");
        $remark = 'Note - ' . $this->app->Request()->getParameter("remark");
        $date = $this->app->Request()->getParameter("date");
        $employee = \entities\EmployeeQuery::create()
            ->filterByEmployeeId($employeeId)
            ->findOne();
        try {
                // TSPC - 897 changes
                $attendance = AttendanceQuery::create()
                            ->filterByEmployeeId($employeeId)
                            ->filterByAttendanceDate($date)
                            ->findOne();

                if (empty($attenadance)) {
                    $attendance = new \entities\Attendance();
                    $attendance->setEmployeeId($employeeId);
                    $attendance->setAttendanceDate($date);
                    $attendance->setCompanyId($employee->getCompanyId());
                    $attendance->setShiftMins(0);
                }
                
                $attendance->setRemark($remark);
                $attendance->setStatus(4); // Punch Leave
                $attendance->save();

                $this->apiResponse($attendance->toArray(), 200, "Punch leave successfully..");
        } catch (Exception $ex) {
            $this->apiResponse([], 400, $ex->getMessage());
        }
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/pendingLeaveCount",
     *     tags={"Leave Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get user cliams successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function pendingLeaveCount()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $empids = \Modules\HR\Runtime\HrHelper::findEmpsUnder($this->app->Auth()->getUser()->getEmployee()->getPositionId());
        if ($empids) {
                $reqs = WorkflowManager::getPendingRequestPks("LeaveRequest", $this->app);
                $leaveReqs = \entities\LeaveRequestQuery::create()
                    ->filterByLeaveReqId($reqs)
                    ->filterByEmployeeId($empids)
                    ->find()->toArray();
                $this->apiResponse(['PendingLeaveCount' => count($leaveReqs)], 200, "Get all leave successfully!");
        } else {
            $this->apiResponse([], 404, "User not found!");
        }
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/pendingLeaveCountList",
     *     tags={"Leave Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get user cliams successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function pendingLeaveCountList()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $empids = \Modules\HR\Runtime\HrHelper::findEmpsUnder($this->app->Auth()->getUser()->getEmployee()->getPositionId());
        if ($empids) {
                $reqs = WorkflowManager::getPendingRequestPks("LeaveRequest", $this->app);
                $leaveReqs = \entities\LeaveRequestQuery::create()
                    ->filterByLeaveReqId($reqs)
                    ->find()->toArray();
                $dataArray = array();
                for ($i = 0; $i < count($empids); $i++) {
                    $dataArray[$empids[$i]] = EmployeeQuery::create()
                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                        ->leftJoinWithDesignations()
                        ->filterByEmployeeId($empids[$i])
                        ->findOne();
                    $dataArray[$empids[$i]]['TotalLeaveCount'] = \entities\LeaveRequestQuery::create()
                        ->filterByEmployeeId($empids[$i])
                        ->filterByLeaveReqId($reqs)
                        ->find()->count();
                }
                if (count($dataArray) > 0) {
                    $this->apiResponse($dataArray, 200, "Get all leave successfully!");
                } else {
                    $this->apiResponse([], 400, "Leave requests not found!");
                }
        } else {
            $this->apiResponse([], 404, "User not found!");
        }
        break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/UnlockDays",
     *     tags={"User Management"},
     *      @OA\Parameter(
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
     *     @OA\Parameter(
     *         name="remark",
     *         in="query",
     *         description="Remark",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Punch leave successfully.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function UnlockDays()
    {
        switch ($this->app->Request()->getMethod()):
    case "POST":
        $employeeId = (int) $this->app->Request()->getParameter("employee_id");
        $emp = EmployeeQuery::create()
            ->filterByEmployeeId($employeeId)
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->findOne();
        if ($emp == null) {
                $this->apiResponse([], 404, "Employee not found!");
                return;
        }
        if ($emp->getIslocked() == 1) {
            $this->apiResponse([], 400, "Employee is System Locked, Cannot Unlock Days, Contact HQ");
            return;
        }

        AttendanceQuery::create()
            ->filterByEmployeeId($employeeId)
            ->filterByStatus(-1)
            ->update([
                "Status" => 0,
                "Remark" => $this->app->Request()->getParameter("Remark"),
            ]);
        $this->apiResponse([], 200, "Days Unlocked");
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/deleteExpenseList",
     *     tags={"Expenses"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="exp_list_id",
     *         in="query",
     *         description="Expenses List Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Expense list delete successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied",
     *     ),
     * )
     */
    public function deleteExpenseList()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $expListId = $this->app->Request()->getParameter("exp_list_id");
        if ($expListId != null && $expListId != '') {

                $expListDetails = \entities\ExpenseListDetailsQuery::create()
                    ->filterByExpListId($expListId)
                    ->find();
                foreach ($expListDetails as $expListDetail) {
                    $expListDetailsAttechment = \entities\MediaFilesQuery::create()
                        ->filterByMediaId($expListDetail->getImage())
                        ->delete();
                    $expListDetail->delete();
                }
                $expList = \entities\ExpenseListQuery::create()
                    ->filterByExpListId($expListId)
                    ->delete();
                $this->apiResponse([], 200, "Expense list deleted !");
        } else {
            $this->apiResponse([], 400, "Could not find expense list!");
        }
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/generateExpense",
     *     tags={"Expenses"},
     *      @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="employee_code",
     *         in="query",
     *         description="Employee Code",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get today expense calculation successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function generateExpense()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $employeeCode = $this->app->Request()->getParameter("employee_code");

        if ($employeeCode != null && $employeeCode != '') {
                $employeeId = \entities\EmployeeQuery::create()
                    ->select(['EmployeeId'])
                    ->filterByEmployeeCode($employeeCode)
                    ->find()->toArray();
        } else {
            $employeeId = null;
        }
        $expManager = new ExpenseManager();
        $generate = $expManager->autoExpenseGenerate($employeeId);
        $this->apiResponse([], 200, "Expense generated successfully!");
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/processDailyCallTowns",
     *     tags={"Catalogue API's"},
     *      @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Get today expense calculation successfully!",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function processDailyCallTowns()
    {
        $attendance = \entities\AttendanceQuery::create()
            ->filterByEndItownid(null, Criteria::NOT_EQUAL)
            ->filterByStatus(1)
            ->filterByExpenseGenerated(false)
            ->find();
        if (count($attendance) > 0) {
            foreach ($attendance as $atte) {
                $dailyCalls = \entities\DailycallsQuery::create()
                    ->select(['Agendacontroltype', 'Itownid'])
                    ->filterByDcrDate($atte->getAttendanceDate()->format('Y-m-d'))
                    ->filterByEmployeeId($atte->getEmployeeId())
                    ->find();
                $towns = [];
                if (count($dailyCalls) > 0) {
                    foreach ($dailyCalls as $dc) {
                        $towns[] = $dc["Itownid"];
                    }
                    $totalTowns = implode(",", array_unique($towns));
                    $atte->setOutletCount(count($dailyCalls));
                    $atte->setVisitedItownid($totalTowns);
                    $atte->save();
                    $this->apiResponse([], 200, "Daily call town successfully inserted!");
                } else {
                    $this->apiResponse([], 400, "Daily call not found!");
                }
            }
        } else {
            $this->apiResponse([], 400, "Attendance not found!");
        }
    }

    /**
     * @OA\Get(
     *     path="/api/getStartTown",
     *     tags={"User Management"},
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="punchin_date",
     *         in="query",
     *         description="Punch In Date",
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
    public function getStartTown()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        if ($this->app->Auth()->getUser()->getEmployee()->getIslocked()) {
                $this->apiResponse([], 400, "Reason : " . $this->app->Auth()->getUser()->getEmployee()->getLockedreason());
                //return;
        }
        $empID = $this->app->Auth()->getUser()->getEmployeeId();
        $punchin_date = $this->app->Request()->getParameter("punchin_date");

        $prevDate = date('Y-m-d', strtotime('-1 day', strtotime($punchin_date)));
        $currentDate = DateTime::createFromFormat("Y-m-d", $prevDate);

        if ($currentDate->format("N") == 7) // Sunday
        {
            $prevDate = date('Y-m-d', strtotime('-2 day', strtotime($punchin_date)));
        }
        $holidaydate = [];
        $holidays = \entities\HolidaysQuery::create()
            ->filterByIstateid($this->app->Auth()->getUser()->getEmployee()->getBranch()->getIstateid())
            ->findByCompanyId($this->app->Auth()->CompanyId());
        foreach ($holidays as $holiday) {
            $holidaydate[] = $holiday->getHolidayDate()->format('Y-m-d');
        }

        if(!in_array($prevDate, $holidaydate)){
            $prevDate = date('Y-m-d', strtotime('-1 day', strtotime($prevDate)));
        }

        if (in_array($currentDate->format("Y-m-d"), $holidaydate)) {
            $prevDate = date('Y-m-d', strtotime('-2 day', strtotime($punchin_date)));
        }

        $attendencehelper = new \Modules\ESS\Runtime\AttendanceHelper($this->app);

        $attendance = $attendencehelper->CheckStatusForToday($empID, $prevDate);

        $empAtn = \entities\AttendanceQuery::create()
                        ->filterByEmployeeId($empID)
                        ->find()->count();
        $data = [];
        if($empAtn == 0){
            $data[-1] = " ";
        }else{
            if ($attendance->AttendenceCode != 2) {

                $data[-1] = "Previous Day " . $prevDate . " Punchout Pending";
            } else if ($attendance->AttendenceRec->getStatus() == -1) {
                $data[-1] = "Previous Day - Locked " . $prevDate . " Punchout Pending";
            } else {
                $endTown = $attendance->AttendenceRec->getEndItownid();
                $geoTown = GeoTownsQuery::create()->findOneByItownid($endTown)->toArray();
    
                $data[$endTown] = $geoTown;
            }
        }
        

        $this->apiResponse($data, 200, "Last End Town");
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/attendanceSummaryReport",
     *     tags={"User Management"},
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
     *         description="Month and Year",
     *              required=true,
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
     *         description="ResponseObj",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function attendanceSummaryReport()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $moye = explode('-', $this->app->Request()->getParameter("moye"));
        $startDate = date('Y-m-1', strtotime($moye[1] . '-' . $moye[0]));
        $endDate = date('Y-m-t', strtotime($moye[1] . '-' . $moye[0]));

        $employeeId = $this->app->Request()->getParameter("employee_id", $this->app->Auth()->getUser()->getEmployeeId());

        if ($startDate != null && $endDate != null) {
                $employee = \entities\EmployeeQuery::create()
                    ->filterByEmployeeId($employeeId)
                    ->filterByStatus(1)
                    ->findOne();
                if ($employee == null) {
                    return [];
                }

                $holidays = \entities\HolidaysQuery::create()
                    ->select(['HolidayDate', 'HolidayName'])
                    ->filterByIstateid($employee->getBranch()->getIstateid())
                    ->filterByHolidayDate($startDate, Criteria::GREATER_EQUAL)
                    ->filterByHolidayDate($endDate, Criteria::LESS_EQUAL)
                    ->find()->toArray();

                $leaves = \entities\LeavesQuery::create()
                    ->select(['LeaveDate', 'LeaveType', 'LeaveRemark'])
                    ->filterByEmployeeId($employeeId)
                    ->filterByLeaveDate($startDate, Criteria::GREATER_EQUAL)
                    ->filterByLeaveDate($endDate, Criteria::LESS_EQUAL)
                    ->filterByLeavePoints(0, Criteria::LESS_THAN)
                    ->find()->toArray();

                $attendance = \entities\AttendanceQuery::create()
                    ->select(['AttendanceDate', 'StartTime', 'StartTownName', 'EndTime', 'EndTownName', 'ShiftMins', 'Status', 'Remark', 'ExpenseId', 'ExpenseGenerated', 'ExpenseRemark', 'Expenses.ExpenseFinalAmt', 'Expenses.TripType', 'canDoVerify'])
                    ->withColumn('Expenses.DoVerify', 'canDoVerify')
                    ->leftJoinWithExpenses()
                    ->leftJoinGeoTownsRelatedByStartItownid('StartItownid')
                    ->addAsColumn('StartTownName', "StartItownid.Stownname")
                    ->leftJoinGeoTownsRelatedByEndItownid('EndItownid')
                    ->addAsColumn('EndTownName', "EndItownid.Stownname")
                    ->filterByAttendanceDate($startDate, Criteria::GREATER_EQUAL)
                    ->filterByAttendanceDate($endDate, Criteria::LESS_EQUAL)
                    ->filterByEmployeeId($employeeId)
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->orderByAttendanceDate()
                    ->find()->toArray();

                $date = date((int) $moye[1] . '-' . (int) $moye[0] . '-01'); //Current Month Year
                $daysinMonth = cal_days_in_month(CAL_GREGORIAN, (int) $moye[0], (int) $moye[1]);
                $data = array();
                for ($i = 0; $i < $daysinMonth; $i++) {
                    $day = date("Y-m-d", strtotime("+$i day", strtotime($date)));
                    $currentDate = DateTime::createFromFormat("Y-m-d", $day);

                    if (!array_key_exists($currentDate->format('Y-m-d'), $data)) {
                        $data[$currentDate->format('Y-m-d')] = [
                            "AttendanceDate" => $currentDate->format('Y-m-d'),
                            "StartTime" => '',
                            "StartTownName" => '',
                            "EndTime" => '',
                            "EndTownName" => '',
                            "ShiftMins" => '',
                            "Status" => '',
                            "Remark" => 'No data Found!',
                            "ExpenseId" => '',
                            "ExpenseGenerated" => '',
                            "ExpenseRemark" => '',
                            "Expenses.ExpenseFinalAmt" => '',
                            "Expenses.TripType" => '',
                            "canDoVerify" => false,
                        ];
                    }
                    if (isset($attendance[$i]["AttendanceDate"])) {
                        $data[$attendance[$i]["AttendanceDate"]] = [
                            "AttendanceDate" => $attendance[$i]["AttendanceDate"],
                            "StartTime" => $attendance[$i]["StartTime"],
                            "StartTownName" => $attendance[$i]["StartTownName"],
                            "EndTime" => $attendance[$i]["EndTime"],
                            "EndTownName" => $attendance[$i]["EndTownName"],
                            "ShiftMins" => $attendance[$i]["ShiftMins"],
                            "Status" => $attendance[$i]["Status"],
                            "Remark" => $attendance[$i]["Remark"],
                            "ExpenseId" => $attendance[$i]["ExpenseId"],
                            "ExpenseGenerated" => $attendance[$i]["ExpenseGenerated"],
                            "ExpenseRemark" => $attendance[$i]["ExpenseRemark"],
                            "Expenses.ExpenseFinalAmt" => $attendance[$i]["Expenses.ExpenseFinalAmt"],
                            "Expenses.TripType" => $attendance[$i]["Expenses.TripType"],
                            "canDoVerify" => $attendance[$i]["canDoVerify"],
                        ];
                    }
                    if ($currentDate->format("N") == 7) // Sunday
                    {
                        $data[$currentDate->format('Y-m-d')] = [
                            "AttendanceDate" => $currentDate->format('Y-m-d'),
                            "StartTime" => '',
                            "StartTownName" => '',
                            "EndTime" => '',
                            "EndTownName" => '',
                            "ShiftMins" => '',
                            "Status" => '',
                            "Remark" => 'Sunday',
                            "ExpenseId" => '',
                            "ExpenseGenerated" => '',
                            "ExpenseRemark" => '',
                            "Expenses.ExpenseFinalAmt" => '',
                            "Expenses.TripType" => '',
                            "canDoVerify" => false,
                        ];
                    }
                    foreach ($holidays as $holiday) {
                        if ($currentDate->format('Y-m-d') == $holiday['HolidayDate']) {
                            $data[$currentDate->format('Y-m-d')] = [
                                "AttendanceDate" => $holiday['HolidayDate'],
                                "StartTime" => '',
                                "StartTownName" => '',
                                "EndTime" => '',
                                "EndTownName" => '',
                                "ShiftMins" => '',
                                "Status" => '',
                                "Remark" => $holiday['HolidayName'],
                                "ExpenseId" => '',
                                "ExpenseGenerated" => '',
                                "ExpenseRemark" => '',
                                "Expenses.ExpenseFinalAmt" => '',
                                "Expenses.TripType" => '',
                                "canDoVerify" => false,
                            ];
                        }
                    }
                    foreach ($leaves as $leave) {
                        if ($currentDate->format('Y-m-d') == $leave['LeaveDate']) {
                            $data[$currentDate->format('Y-m-d')] = [
                                "AttendanceDate" => $leave['LeaveDate'],
                                "StartTime" => '',
                                "StartTownName" => '',
                                "EndTime" => '',
                                "EndTownName" => '',
                                "ShiftMins" => '',
                                "Status" => '',
                                "Remark" => $leave['LeaveType'],
                                "ExpenseId" => '',
                                "ExpenseGenerated" => '',
                                "ExpenseRemark" => '',
                                "Expenses.ExpenseFinalAmt" => '',
                                "Expenses.TripType" => '',
                                "canDoVerify" => false,
                            ];
                        }
                    }
                }
                sort($data);
                $result = array();
                foreach ($data as $sort) {
                    $result[$sort['AttendanceDate']] = [
                        "AttendanceDate" => $sort['AttendanceDate'],
                        "StartTime" => $sort['StartTime'],
                        "StartTownName" => $sort['StartTownName'],
                        "EndTime" => $sort['EndTime'],
                        "EndTownName" => $sort['EndTownName'],
                        "ShiftMins" => $sort['ShiftMins'],
                        "Status" => $sort['Status'],
                        "Remark" => $sort['Remark'],
                        "ExpenseId" => $sort['ExpenseId'],
                        "ExpenseGenerated" => $sort['ExpenseGenerated'],
                        "ExpenseRemark" => $sort['ExpenseRemark'],
                        "Expenses.ExpenseFinalAmt" => $sort['Expenses.ExpenseFinalAmt'],
                        "Expenses.TripType" => $sort['Expenses.TripType'],
                        "canDoVerify" => $sort['canDoVerify'],
                    ];
                }
                if (!empty($result)) {
                    $this->apiResponse($result, 200, "Get employee attendance summary!");
                } else {
                    $this->apiResponse([], 400, "Attendance not found!");
                }
        } else {
            $this->apiResponse([], 400, "Start and End not found!");
        }
        break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/employeeLeaveApproval",
     *     tags={"Extra"},
     *     description="Direct leave approval",
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="leave__request_id",
     *         in="query",
     *         description="Leave request Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="employee_id",
     *         in="query",
     *         description="Employee Id",
     *         @OA\Schema(type="String")
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function employeeLeaveApproval()
    {
        switch ($this->app->Request()->getMethod()):
    case "POST":
        $leaveId = (int) $this->app->Request()->getParameter("leave__request_id");
        $empId = (int) $this->app->Request()->getParameter("employee_id");
        //$employee = $this->app->Auth()->getUser()->getEmployee();
        $employee = \entities\EmployeeQuery::create()
            ->findPk($empId);
        try {
                $entity = \entities\LeaveRequestQuery::create()->findPk($leaveId);
                if ($entity) {
                    $FromDate = $entity->getLeaveFrom();
                    $ToDate = $entity->getLeaveTo();
                    $pos_diff = $FromDate->diff($ToDate)->format("%r%a");
                    $dates = \Modules\ESS\Runtime\EssHelper::date_range($FromDate->format('Y-m-d'), $ToDate->format('Y-m-d'));
                    if (LeaveManager::leaveRequestExists($entity->getEmployeeId(), $FromDate, $ToDate)) {
                        $this->apiResponse([], 400, "There is a Leave that coincide with these dates");
                    }
                    $empl = \entities\EmployeeQuery::create()->findPk($entity->getEmployeeId());
                    $clearDates = [];
                    $holidays = \entities\HolidaysQuery::create()
                        ->findByCompanyId($this->app->Auth()->CompanyId());
                    $holidaydate = [];
                    $stateId = $empl->getBranch()->getIstateid();
                    foreach ($holidays as $holiday) {
                        if ($holiday->getIstateid() != null) {
                            $holidayState = explode(",", (string) $holiday->getIstateid());
                            if (in_array($stateId, $holidayState)) {
                                $holidaydate[] = $holiday->getHolidayDate()->format('Y-m-d');
                            }
                        }
                    }
                    foreach ($dates as $date) {
                        $day = $date;
                        $currentDate = DateTime::createFromFormat("Y-m-d", $day);
                        if ($currentDate->format("N") == 7) // Sunday
                        {
                            continue;
                        }
                        if (in_array($currentDate->format("Y-m-d"), $holidaydate)) {
                            continue;
                        }
                        $clearDates[] = $day;
                    }
                    $entity->setLeaveStatus(2);
                    $entity->save();
                    for ($i = 0; $i <= $pos_diff; $i++) {

                        $leaveEntity = new \entities\Leaves();
                        $leaveEntity->setEmployeeId($entity->getEmployeeId());
                        $leaveEntity->setLeaveRequestId($entity->getLeaveReqId());
                        $leaveEntity->setLeaveDate($clearDates[$i]);
                        $leaveEntity->setLeaveType($entity->getLeaveType());
                        $leaveEntity->setLeaveRemark($entity->getLeaveReason());
                        $leaveEntity->setLeavePoints(-1);
                        $leaveEntity->setCompanyId(9);
                        if ($leaveEntity->save()) {
                            $positionId = $entity->getEmployee()->getPositionId();
                            $mtpBlock = \entities\MtpDayQuery::create()
                                ->filterByMtpDayDate($clearDates[$i])
                                ->findOne();
                            if ($mtpBlock != null) {
                                $mtp = \entities\MtpQuery::create()
                                    ->filterByMtpId($mtpBlock->getMtpId())
                                    ->filterByPositionId($positionId)
                                    ->filterByMtpStatus('approved', Criteria::NOT_EQUAL)
                                    ->findOne();
                                if ($mtp != null) {
                                    $tourPlanDelete = \entities\TourplansQuery::create()
                                        ->filterByTpDate($clearDates[$i])
                                        ->filterByPositionId($positionId)
                                        ->filterByMtpDayId($mtpBlock->getMtpDayId())
                                        ->delete();
                                    $mtpDay = \entities\MtpDayQuery::create()
                                        ->filterByMtpDayId($mtpBlock->getMtpDayId())
                                        ->delete();
                                    $manager = new \BI\manager\MTPManager();
                                    $mtp = $manager->getMTPById($mtp->getMtpId());
                                }
                                //MTP is approved
                                // chintan needs to ask sachin.
                            }
                        }
                    }
                    $wfManager = new \Modules\System\Processes\WorkflowManager();
                    $wfManager->createLog("LeaveRequest", $entity, $employee, 0, "Leave Approved", 0);
                    $wfManager->process("LeaveRequest", $entity, "");
                    $title = "Leave Approved";
                    $message = "Your leave approved!";
                    $notification = NotificationManager::sendNotificationToEmployee($entity->getEmployeeId(), $title, $message);
                    $this->apiResponse($entity->toArray(), 200, "Leave Approved successfully.");
                }
        } catch (Exception $ex) {
            $this->apiResponse([], 400, $ex->getMessage());
        }
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/visitedTownCorrection",
     *     tags={"Extra"},
     *     description="Visited town correction",
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
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
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function visitedTownCorrection()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $date = $this->app->Request()->getParameter("date");
        try {
                $attendance = \entities\AttendanceQuery::create()
                //->filterByVisitedItownid(null, Criteria::NOT_EQUAL)
                    ->filterByAttendanceDate($date)
                    ->find();
                if (!empty($attendance)) {
                    foreach ($attendance as $attend) {

                        $towns = DailycallsQuery::create()
                            ->select(['Itownid'])
                            ->filterByDcrDate($attend->getAttendanceDate())
                            ->filterByEmployeeId($attend->getEmployeeId())
                            ->find()->toArray();

                        $totalTowns = implode(",", array_unique($towns));

                        $attend->setOutletCount(count($towns));
                        $attend->setVisitedItownid($totalTowns);
                        $attend->save();
                    }
                }
        } catch (Exception $ex) {
            $this->apiResponse([], 400, $ex->getMessage());
        }
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/getWorkingDays",
     *     tags={"Extra"},
     *     description="Visited town correction",
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
     *     @OA\Parameter(
     *         name="month",
     *         in="query",
     *         description="Month",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function getWorkingDays()
    {
        switch ($this->app->Request()->getMethod()):
    case "GET":
        $employeeId = $this->app->Request()->getParameter("employee_id");
        $month = $this->app->Request()->getParameter("month");

        $employee = \entities\EmployeeQuery::create()
            ->filterByEmployeeId($employeeId)
            ->findOne();

        $monthNumber = explode('-', $month);

        $dt = \DateTime::createFromFormat('m', $monthNumber[0]);
        $startDate = $dt->format($monthNumber[1].'-m-1');
        $endDate = $dt->format($monthNumber[1].'-m-t');

        // $startDate = date((int) $monthNumber[1] . '-' . (int) $monthNumber[0] . '-01');
        // $endDate = date((int) $monthNumber[1] . '-' . (int) $monthNumber[0] . '-t');

        $date = date((int) $monthNumber[1] . '-' . (int) $monthNumber[0] . '-01');
        $daysinMonth = cal_days_in_month(CAL_GREGORIAN, (int) $monthNumber[0], (int) $monthNumber[1]);
        $sunday = 0;
        for ($i = 0; $i < $daysinMonth; $i++) {
                $day = date("Y-m-d", strtotime("+$i day", strtotime($date)));
                $currentDate = DateTime::createFromFormat("Y-m-d", $day);
                if ($currentDate->format("N") == 7) // Sunday
                {
                    $sunday += 1;
                }
        }

        $holidays = \entities\HolidaysQuery::create()
            ->select(['HolidayDate'])
            ->filterByIstateid($employee->getBranch()->getIstateid())
            ->filterByHolidayDate($startDate, Criteria::GREATER_EQUAL)
            ->filterByHolidayDate($endDate, Criteria::LESS_EQUAL)
            ->find()->count();

        $leaves = \entities\LeaveRequestQuery::create()
            ->filterByLeaveFrom($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
            ->filterByLeaveTo($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
            ->filterByEmployeeId($employee->getEmployeeId())
            ->filterByLeaveStatus(2)
            ->find()->count();

        // if($employee->getOrgUnitId() == 37){
        //     $attendace = \entities\AttendanceQuery::create()
        //                     ->filterByEmployeeId($employeeId)
        //                     ->filterByAttendanceDate($startDate, Criteria::GREATER_EQUAL)
        //                     ->filterByAttendanceDate($endDate, Criteria::LESS_EQUAL)
        //                     ->filterByExpenseGenerated(true)
        //                     ->filterByExpenseId(null, Criteria::NOT_EQUAL)
        //                     ->find()->count();
        //     $workingDays = $attendace;
        // }else{
        //     $workingDays = $daysinMonth - ($sunday + $holidays + $leaves);
        // }

        $attendace = \entities\AttendanceQuery::create()
            ->filterByEmployeeId($employeeId)
            ->filterByAttendanceDate($startDate, Criteria::GREATER_EQUAL)
            ->filterByAttendanceDate($endDate, Criteria::LESS_EQUAL)
            ->filterByStatus([0, 1])
            ->find()->count();

        //$workingDays = $daysinMonth - ($sunday + $holidays + $leaves);

        $this->apiResponse(['WorkingDays' => $attendace], 200, "Month working days.");
        break;
        endswitch;
    }

    /**
     * @OA\Get(
     *     path="/api/deleteAttendance",
     *     tags={"Extra"},
     *     description="Delete attendance for leaves",
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="org_unit_id",
     *         in="query",
     *         description="Org Unit Id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="month",
     *         in="query",
     *         description="Month",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    // public function deleteAttendance()
    // {
    //     switch ($this->app->Request()->getMethod()):
    //         case "GET":
    //             $orgUnitId = $this->app->Request()->getParameter("org_unit_id");
    //             $month = $this->app->Request()->getParameter("month");

    //             $employeeIds = \entities\EmployeeQuery::create()
    //                 ->select(['EmployeeId'])
    //                 ->filterByOrgUnit($orgUnitId)
    //                 ->find()->toArray();

    //             $monthNumber = explode('-', $month);

    //             $dt = \DateTime::createFromFormat('m', $monthNumber[0]);
    //             $startDate = $dt->format('Y-m-1');
    //             $endDate = $dt->format('Y-m-t');

    //             $leaves = \entities\LeaveRequestQuery::create()
    //                 ->filterByLeaveFrom($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
    //                 ->filterByLeaveTo($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
    //                 ->filterByEmployeeId($employeeIds)
    //                 ->filterByLeaveStatus(2)
    //                 ->find()->toArray();
    //             if(count($leaves) > 0){
    //                 foreach($leaves as $leave){

    //                 }
    //             }else{

    //             }

    //             $this->apiResponse(['WorkingDays' => $workingDays], 200, "Month working days.");
    //             break;
    //     endswitch;

    // }

    /**
     * @OA\Post(
     *     path="/api/addPendingDCRRecords",
     *     tags={"Extra"},
     *     description="Delete attendance for leaves",
     *     @OA\Parameter(
     *         name="apptoken",
     *         in="header",
     *         description="App Token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="employee_code",
     *         in="query",
     *         description="Employee code",
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
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function addPendingDCRRecords()
    {
        switch ($this->app->Request()->getMethod()):
    case "POST":
        $employeeCode = $this->app->Request()->getParameter("employee_code");
        $date = $this->app->Request()->getParameter("date");

        // Get employee
        $employee = EmployeeQuery::create()
            ->filterByEmployeeCode($employeeCode)
            ->findOne();
        if (empty($employee)) {
                $this->apiResponse([], 400, "Employee not found");
        } else {
            $manager = new DailyCallsManager();
            $manager->addPendingDCRRecord($employee, $date);

            $this->apiResponse([], 200, "DCR Created!.");
        }
        break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/attendance/add/end-town",
     *     tags={"Extra"},
     *     description="Add end town to the attendances",
     *     @OA\Parameter(
     *         name="start_date",
     *         in="query",
     *         description="Start Date",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="end_date",
     *         in="query",
     *         description="End Date",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function addEndTownToAttendances()
    {
        $start_date = $this->app->Request()->getParameter("start_date");
        $end_date = $this->app->Request()->getParameter("end_date");

        $attendances = AttendanceQuery::create()
            ->filterByStatus([0, 1])
            ->filterByAttendanceDate($start_date, Criteria::GREATER_EQUAL)
            ->filterByAttendanceDate($end_date, Criteria::LESS_EQUAL)
            ->filterByStartItownid(null, Criteria::ISNULL)
            ->find();

        foreach ($attendances as $attendance) {
            $previousDay = AttendanceQuery::create()
                ->filterByStatus([0, 1])
                ->filterByAttendanceDate(date('Y-m-d', strtotime('-1 day', strtotime($attendance->getAttendanceDate()->format('Y-m-d')))))
                ->filterByEmployeeId($attendance->getEmployeeId())
                ->findOne();

            if (!empty($previousDay) && !empty($previousDay->getEndItownid())) {
                $attendance->setStartItownid($previousDay->getEndItownid());
                $attendance->save();
            } else {
                $employeeITown = $attendance->getEmployee()->getItownid();
                if (!empty($employeeITown)) {
                    $attendance->setStartItownid($employeeITown);
                    $attendance->save();
                }
            }
        }

        $this->apiResponse([], 200, "Attendances Ureated!.");
    }

    /**
     * @OA\Post(
     *     path="/api/getLeaveDeduction",
     *     tags={"Extra"},
     *     description="Add end town to the attendances",
     *     @OA\Parameter(
     *         name="start_date",
     *         in="query",
     *         description="Start Date",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="end_date",
     *         in="query",
     *         description="End Date",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function getLeaveDeduction()
    {

        $leave = new \BI\manager\LeaveManager();
        $leave->autoLeaveCreate();

        $this->apiResponse([], 200, "Attendances Ureated!.");
    }

    /**
     * @OA\Get(
     *     path="/api/getExpenseLastDates",
     *     tags={"Expenses"},
     *     description="Expense approved date",
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
     *     @OA\Parameter(
     *         name="month",
     *         in="query",
     *         description="Month",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function getExpenseLastDates()
    {

        switch ($this->app->Request()->getMethod()):
    case "GET":
        $months = $this->app->Request()->getParameter("month");
        $employeeId = $this->app->Request()->getParameter("employee_id");

        $month = explode("|", $months);
        $monthStartDate = $month[0] . " 00:00:01";
        $monthEndDate = $month[1] . " 23:59:59";

        $expenses = \entities\ExpensesQuery::create()
            ->select(['ExpId'])
            ->filterByExpenseDate($monthStartDate, Criteria::GREATER_EQUAL)
            ->filterByExpenseDate($monthEndDate, Criteria::LESS_EQUAL)
            ->filterByEmployeeId($employeeId)
            ->find()->toArray();

        $LastSubmittedDate = \entities\WfLogQuery::create()
            ->select('LastSubmittedDate')
            ->filterByWfDocId(1)
            ->filterBywfDocPk($expenses)
            ->filterByWfStatusId(2)
            ->addAsColumn('LastSubmittedDate', 'MAX(created_at)')
            ->findOne();

        $LastApprovedDate = \entities\WfLogQuery::create()
            ->select('LastApprovedDate')
            ->filterByWfDocId(1)
            ->filterBywfDocPk($expenses)
            ->filterByWfStatusId(3)
            ->addAsColumn('LastApprovedDate', 'MAX(created_at)')
            ->findOne();

        $LastAuditedDate = \entities\WfLogQuery::create()
            ->select('LastAuditedDate')
            ->filterByWfDocId(1)
            ->filterBywfDocPk($expenses)
            ->filterByWfStatusId(10)
            ->addAsColumn('LastAuditedDate', 'MAX(created_at)')
            ->findOne();

        $data = [
            'LastSubmittedDate' => $LastSubmittedDate,
            'LastApprovedDate' => $LastApprovedDate,
            'LastAuditedDate' => $LastAuditedDate,
        ];
        $this->apiResponse($data, 200, "Get expense last dates!.");

        break;
        endswitch;
    }

    /**
     * @OA\Post(
     *     path="/api/createLeaveWithoutAnyValidation",
     *     tags={"Extra"},
     *     description="Add end town to the attendances",
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
     *     @OA\Parameter(
     *         name="leave_type",
     *         in="query",
     *         description="Leave Type",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="from_date",
     *         in="query",
     *         description="From Date",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="to_date",
     *         in="query",
     *         description="To Date",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="remark",
     *         in="query",
     *         description="Enter Remark",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Leave created successfully.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function createLeaveWithoutAnyValidation()
    {
        switch ($this->app->Request()->getMethod()):
            case "POST":
                $employeeId = (int) $this->app->Request()->getParameter("employee_id");
                $leaveType = $this->app->Request()->getParameter("leave_type");
                $fromDate = $this->app->Request()->getParameter("from_date");
                $toDate = $this->app->Request()->getParameter("to_date");
                $remark = $this->app->Request()->getParameter("remark");

                $employee = \entities\EmployeeQuery::create()
                    ->filterByEmployeeId($employeeId)
                    ->findOne();
                try {
                        $date1 = strtotime($fromDate);
                        $date2 = strtotime($toDate);
                        $diff = $date2 - $date1;
                        $leaveReqDays = floor($diff / (60 * 60 * 24));
                        $leaveReqTotalDays = $leaveReqDays + 1;

                        $entity = new \entities\LeaveRequest();
                        $entity->setEmployeeId($employeeId);
                        $entity->setLeaveType($leaveType);
                        $entity->setLeaveFrom($fromDate);
                        $entity->setLeaveTo($toDate);
                        $entity->setLeaveStatus(1);
                        $entity->setCompanyId($employee->getCompanyId());
                        $entity->setLeaveReason($remark);
                        $entity->save();
                        if ($entity->getLeaveReqId() != null) {
                            $dates = EssHelper::date_range($fromDate, $toDate);
                            for ($i = 0; $i < $leaveReqTotalDays; $i++) {
                                if (isset($dates[$i])) {
                                    $leaveEntity = new \entities\Leaves();
                                    $leaveEntity->setEmployeeId($entity->getEmployeeId());
                                    $leaveEntity->setLeaveRequestId($entity->getLeaveReqId());
                                    $leaveEntity->setLeaveDate($dates[$i]);
                                    $leaveEntity->setLeaveType($entity->getLeaveType());
                                    $leaveEntity->setLeaveRemark($entity->getLeaveReason());
                                    $leaveEntity->setLeavePoints(-1);
                                    $leaveEntity->setCompanyId($employee->getCompanyId());
                                    $leaveEntity->save();
                                }
                            }
                            if ($entity) {
                                $wfManager = new \Modules\System\Processes\WorkflowManager();
                                $wfManager->createLog("LeaveRequest", $entity, $employee, 0, "Leave Request Created", 0);
                                $wfManager->process("LeaveRequest", $entity, "");

                                return $this->apiResponse($entity->toArray(), 200, "Leave created successfully.");
                            }
                        }
                } catch (Exception $ex) {
                    $this->apiResponse([], 400, $ex->getMessage());
                }
            break;
        endswitch;
    }
}
