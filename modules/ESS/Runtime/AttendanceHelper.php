<?php

declare(strict_types=1);

namespace Modules\ESS\Runtime;

use DateTime;
use DateInterval;
use DatePeriod;
use entities\Attendance;
use entities\AttendanceQuery;
use entities\CompanyQuery;
use Exception;
use App\System\App;
use App\Utils\FormMgr;
use BI\manager\LeaveManager;
use entities\HrUserDatesQuery;
use BI\manager\DailyCallsManager;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\ESS\Exceptions\InvalidArgumentException;

class AttendanceResponse
{

    public $AttendenceStatus;
    public $AttendenceCode;
    public $AttendenceRec;

    public function toArray()
    {
        return [
            "AttendenceStatus" => $this->AttendenceStatus,
            "AttendenceCode"   => $this->AttendenceCode,
            "AttendenceRec"    => $this->AttendenceRec->toArray()
        ];
    }
}

class AttendanceHelper
{

    //put your code here
    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function Punch_in($emp_id, $location_pin, $location_name, $punchin_date, $punchin_time, $startItownId, $apptoken)
    {
        $attendenceRecord = $this->getPunchInOrLockedAttendanceRecord($emp_id, $punchin_date);
        if (!empty($attendenceRecord)) {
            $status = $attendenceRecord->getStatus();
            if ($status == 0) {
                throw new \ErrorException("Already Punched in", -1);
            }
            if ($status == -1) {
                throw new \ErrorException("Attendace Locked", -1);
            }
        }

        if ($this->CheckStatusForToday($emp_id, $punchin_date)->AttendenceCode == 0 || $this->CheckStatusForToday($emp_id, $punchin_date)->AttendenceCode == 2 || !$isUserAlreadyPunchinOrLocked) {
            $attendence = new \entities\Attendance();
            $attendence->setAttendanceDate($punchin_date);
            $attendence->setEmployeeId($emp_id);
            $attendence->setCompanyId($this->app->Auth()->CompanyId());
            $attendence->setStartTime($punchin_time);
            $attendence->setStartLatlng($location_pin);
            $attendence->setStartAddress($location_name);
            $attendence->setStartItownid($startItownId);
            $attendence->save();
            $this->userSessionActivityLog("PunchIn", $apptoken);

            return $attendence->toArray();
        } else {
            throw new \ErrorException("Already Punched in", -1);
        }
    }

    public function Punch_out($emp_id, $location_pin, $location_name, $remark, $punchouttime, $punchoutdate, $endItownId, $apptoken)
    {
        // $attendencePreviousDay = \entities\AttendanceQuery::create()
        //                             ->filterByEmployeeId($emp_id)
        //                             ->filterByCompanyId($this->app->Auth()->CompanyId())
        //                             ->filterByAttendanceDate($punchoutdate , \Propel\Runtime\ActiveQuery\Criteria::LESS_THAN)
        //                             ->filterByEndItownid(null, \Propel\Runtime\ActiveQuery\Criteria::EQUAL)
        //                             ->filterByStatus([-1,0])
        //                             ->find()->toArray();
        // if(count($attendencePreviousDay) > 0){
        //     throw new \ErrorException("Previous day punch out pending!");
        // }

        $attendenceResp = $this->CheckStatusForToday($emp_id, $punchoutdate);
        if ($attendenceResp->AttendenceCode == 1) {
            $attendence = $attendenceResp->AttendenceRec;

            // if ($attendence->getStartTime() == null) {
            //     $startTime = strtotime(date("09:00"));
            // } else {
            //     $startTime = strtotime($attendence->getStartTime()->format("H:i"));
            // }

            if ($attendence->getStartTime() != null) {
                $startTime = strtotime($attendence->getStartTime()->format("H:i"));
            } else {
                throw new \ErrorException("Sorry PunchIn not found", -1);
            }

            $dayplansUpdate = \entities\DailycallsQuery::create()
                ->filterByEmployeeId($emp_id)
                ->filterByDcrDate($punchoutdate)
                ->find()->toArray();
            foreach ($dayplansUpdate as $dayplan) {
                $dailycal = \entities\DayplanQuery::create()
                    ->filterByPositionId($dayplan['PositionId'])
                    ->filterByOutletOrgDataId($dayplan['OutletOrgDataId'])
                    ->filterByTpDate($dayplan['DcrDate'])
                    ->filterByStatus('pending')
                    ->findOne();
                if ($dailycal != null && $dailycal != '') {
                    $dailycal->setStatus('completed');
                    $dailycal->save();
                }
            }

            $fw = 0;
            $nca = 0;

            $dailyCalls = \entities\DailycallsQuery::create()
                ->leftJoinWithOutletOrgData() //discussion with chintan sir
                ->leftJoin('OutletOrgData.Outlets') //discussion with chintan sir
                ->filterByDcrDate($punchoutdate)
                ->filterByEmployeeId($emp_id)
                // ->where('Outlets.OutlettypeId = ?', 194)//new update - TSPC-989
                // ->_or()
                // ->where('Outlets.OutlettypeId = ?', 195)//new update - TSPC-989
                ->filterByDcrStatus('completed')
                ->_or()
                ->filterByDcrStatus('Reported')
                ->find()->toArray();

            if (count($dailyCalls) == 0) {
                $dailyCalls = \entities\DailycallsQuery::create()
                    ->filterByDcrDate($punchoutdate)
                    ->filterByEmployeeId($emp_id)
                    ->filterByAgendacontroltype('NCA')
                    ->filterByDcrStatus('completed')
                    ->_or()
                    ->filterByDcrStatus('Reported')
                    ->find()->toArray();
            }

            foreach ($dailyCalls as $dailyCall) {
                if ($dailyCall["Agendacontroltype"] == 'FW') {
                    $fw += 1;
                } else {
                    $nca += 1;
                }
            }

            if ($fw >= 1 || $nca >= 1) { ///jira ticket 517 changes
                $currentTime = date_create($punchouttime);
                $endTime = strtotime(date_format($currentTime, "H:i"));
                $shiftTime = round(abs($endTime - $startTime) / 60, 2);

                if ($shiftTime > 120) {
                    $attendence->setStartTime($startTime);
                    $attendence->setEndTime($punchouttime);
                    $attendence->setEndLatlng($location_pin);
                    $attendence->setEndAddress($location_name);
                    $attendence->setRemark($remark);
                    $attendence->setStatus(1);
                    $attendence->setShiftMins($shiftTime);
                    $attendence->setEndItownid($endItownId);
                    if ($attendence->save()) {
                        $this->userSessionActivityLog("PunchOut", $apptoken);
                        $tomorrow = date('Y-m-d', strtotime('+1 day', strtotime($punchoutdate)));
                        $attendenceNextDay = \entities\AttendanceQuery::create()
                            ->filterByEmployeeId($emp_id)
                            ->filterByCompanyId($this->app->Auth()->CompanyId())
                            ->filterByAttendanceDate($tomorrow)
                            ->filterByEndItownid(null, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                            ->findOne();
                        if ($attendenceNextDay) {
                            $attendenceNextDay->setStartItownid($endItownId);
                            $attendenceNextDay->save();
                        }
                    }
                    try {
                        $manager = new DailyCallsManager();
                        $manager->processDailyCalls($attendence);
                    } catch (Exception $e) {
                        if ($_ENV['environment'] == 'development') {
                            throw $e->getPrevious();
                        } else {
                            throw new \ErrorException("Error While Processing DCR, Punch out done", -1);
                        }
                    }
                    return $attendence->toArray();
                } else {
                    throw new \ErrorException("Sorry, You are not able to punch out becaus of 2 Hours required for punch out.!", -1);
                }
            } else {
                //throw new \ErrorException("Please make sure to have at least 1 DCR Calls or 1 NCA!", -1);
                throw new \ErrorException("Minimum 1 call or NCA to be planned.", -1);
            }
        } else {
            throw new \ErrorException("Sorry Attendance not found", -1);
        }
    }

    public function CheckStatusForToday($emp_id, $date): AttendanceResponse
    {
        $response = new AttendanceResponse();
        $response->AttendenceStatus = "Not Punched In";
        $response->AttendenceCode = 0;

        $attendence = \entities\AttendanceQuery::create()
            ->filterByEmployeeId($emp_id)
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->filterByAttendanceDate($date)
            ->filterByStatus(1, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
            ->orderBy("Status", \Propel\Runtime\ActiveQuery\Criteria::ASC)
            ->findOne();

        if ($attendence) {
            if ($attendence->getStatus() == 0) {
                $response->AttendenceStatus = "Punched in";
                $response->AttendenceCode = 1;
            } else {
                $response->AttendenceStatus = "Punched Out";
                $response->AttendenceCode = 2;
            }

            $response->AttendenceRec = $attendence;
            return $response;
        } else {
            $response->AttendenceRec = new \entities\Attendance();
            return $response;
        }
    }

    public function getPunchInOrLockedAttendanceRecord($emp_id, $date)
    {
        $attendence = \entities\AttendanceQuery::create()
            ->filterByEmployeeId($emp_id)
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->filterByAttendanceDate($date)
            ->filterByStatus(1, \Propel\Runtime\ActiveQuery\Criteria::LESS_THAN)
            ->findOne();

        return $attendence;
    }

    function compareByTimeStamp($time1, $time2)
    {
        if (strtotime($time1) < strtotime($time2)) {
            return 1;
        } elseif (strtotime($time1) > strtotime($time2)) {
            return -1;
        } else {
            return 0;
        }
    }

    public function getFreeDates($emp_id, $dayTypes)
    {

        $emp = $this->app->Auth()->getUser()->getEmployee();
        $stateId = $emp->getBranch()->getIstateid();

        // Created At
        $empStartingDate = $emp->getCreatedAt();

        // Joining Date
        $hrDate = HrUserDatesQuery::create()->filterByEmployeeId($emp->getEmployeeId())->findOne();
        if ($hrDate != null) {
            $empStartingDate = $hrDate->getJoinDate();
        }

        $orgUnit = \entities\OrgUnitQuery::create()
            ->filterByOrgunitid($emp->getOrgUnitId())
            ->findOne();

        $configs = \entities\SystemConfigsQuery::create()
            ->filterByConfigKey(['attendance_weekoff', 'attendance_holiday'])
            ->find()->toArray();

        $weekoff =  $configs[0];
        $holidayoff =  $configs[1];

        $weekoffDays = isset($weekoff["ConfigValue"]) ? $weekoff["ConfigValue"] : 30;
        $holidayoffDays = isset($holidayoff["ConfigValue"]) ? $holidayoff["ConfigValue"] : 30;

        // if($weekoffDays == null || $weekoffDays == '00' || $weekoffDays == 00 || $weekoffDays = ''){
        //     $weekoffDays = 30;
        // }
        // if($holidayoffDays == null || $holidayoffDays == '00' || $holidayoffDays == 00 || $holidayoffDays = ''){
        //     $holidayoffDays = 30;
        // }

        $currentDate = date('Y-m-d');
        $weekoffPreviousDate = date('Y-m-d', strtotime('-' . $weekoffDays . 'days'));
        $holidayPreviousDate = date('Y-m-d', strtotime('-' . $holidayoffDays . 'days'));

        $holidaysDates = [];
            $holidaysDates = \entities\HolidaysQuery::create()
                ->select(['HolidayDate'])
                ->filterByIstateid($this->app->Auth()->getUser()->getEmployee()->getBranch()->getIstateid())
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->filterByHolidayDate($currentDate, Criteria::LESS_EQUAL)
                ->filterByHolidayDate($holidayPreviousDate, Criteria::GREATER_EQUAL)
                ->find()->toArray();

        if(count($holidaysDates) == 0){
            $holidaysDates = \entities\HolidaysQuery::create()
                ->select(['HolidayDate'])
                ->filterByIstateid($this->app->Auth()->getUser()->getEmployee()->getBranch()->getIstateid())
                ->filterByCompanyId($this->app->Auth()->CompanyId())
                ->find()->toArray();
        }

        $weekoffDates = [];
            $weekoffDates = $this->getWeekoff($currentDate, $weekoffPreviousDate);
        

        $company = CompanyQuery::create()
            ->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())
            ->findOne();
        //$reprtingDays = 45;
        if ($company->getReportingDays() == null) {
            $reprtingDays = 45;
        } else {
            $reprtingDays = $company->getReportingDays();
        }

        $date = [];
        switch ($dayTypes) {
            case "R":
                for ($i = $reprtingDays; $i >= 0; $i--) {
                    $day = date("Y-m-d", strtotime("-$i days"));
                    $currentDate = DateTime::createFromFormat("Y-m-d", $day);
                    
                    if ($currentDate < $empStartingDate) // DATES BEFORE EMP CREATED DATE
                    {
                        continue;
                    }
                    if ($currentDate->format("N") == 7) // Sunday
                    {
                        continue;
                    }
                    if (in_array($currentDate->format("Y-m-d"), $holidaysDates)) {
                        continue;
                    }
                    
                    $date[] = $day;
                }
                break;
            case "W":
                    if($orgUnit->getPunchinOnWeekoff()){
                        sort($weekoffDates);
                        $date[] = $weekoffDates;
                    }
                break;
            case "H":
                    if($orgUnit->getPunchinOnHoliday()){
                        sort($holidaysDates);
                        $date[] = $holidaysDates;
                    }
                break;
            case "W,H":
                    if($orgUnit->getPunchinOnWeekoff() && $orgUnit->getPunchinOnHoliday()){
                        $data = array_merge($weekoffDates, $holidaysDates);
                        sort($data);
                        $date[] = $data;
                    }
                break;
            default:
                for ($i = $reprtingDays; $i >= 0; $i--) {
                    $day = date("Y-m-d", strtotime("-$i days"));
                    $currentDate = DateTime::createFromFormat("Y-m-d", $day);

                    if ($currentDate < $empStartingDate) // DATES BEFORE EMP CREATED DATE
                    {
                        continue;
                    }
                    if ($currentDate->format("N") == 7) // Sunday
                    {
                        continue;
                    }
                    if (in_array($currentDate->format("Y-m-d"), $holidaysDates)) {
                        continue;
                    }
                    $date[] = $day;
                }
        }

        $len = count($date) - 1;

        switch ($dayTypes) {
            case "R":
                $attendenceRec = \entities\AttendanceQuery::create()
                    ->filterByEmployeeId($emp_id)
                    ->filterByAttendanceDate($date[0], Criteria::GREATER_EQUAL)
                    ->filterByAttendanceDate($date[$len], Criteria::LESS_EQUAL)
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->find();
                break;
            case "W":
                $attendenceRec = \entities\AttendanceQuery::create()
                    ->filterByEmployeeId($emp_id)
                    ->filterByAttendanceDate($weekoffDates)
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->find();
                break;
            case "H":
                $attendenceRec = \entities\AttendanceQuery::create()
                    ->filterByEmployeeId($emp_id)
                    ->filterByAttendanceDate($holidaysDates)
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->find();
                break;
            case "W,H":
                $data = array_merge($weekoffDates, $holidaysDates);
                $attendenceRec = \entities\AttendanceQuery::create()
                    ->filterByEmployeeId($emp_id)
                    ->filterByAttendanceDate($data)
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->find();
                break;
            default:
                $attendenceRec = \entities\AttendanceQuery::create()
                    ->filterByEmployeeId($emp_id)
                    ->filterByAttendanceDate($date[0], Criteria::GREATER_EQUAL)
                    ->filterByAttendanceDate($date[$len], Criteria::LESS_EQUAL)
                    ->filterByCompanyId($this->app->Auth()->CompanyId())
                    ->find();
        }


        //var_dump($date);exit;
        // $attendenceRec = \entities\AttendanceQuery::create()
        //     ->filterByEmployeeId($emp_id)
        //     ->filterByAttendanceDate($date[0], Criteria::GREATER_EQUAL)
        //     ->filterByAttendanceDate($date[$len], Criteria::LESS_EQUAL)
        //     ->filterByCompanyId($this->app->Auth()->CompanyId())
        //     ->find();

        $attendence = [];
        foreach ($attendenceRec as $rec) {
            $attendence[$rec->getAttendanceDate()->format("Y-m-d")] = $rec;
        }

        $leaveDates = [];
        if ($dayTypes == "R" || $dayTypes == null || $dayTypes == '') {
            $leaveDates = LeaveManager::getLeaveDates($emp_id, $date[0], $date[$len], [1, 2]);
        }

        $responseArray = [];
        if ($dayTypes == "R" || $dayTypes == null || $dayTypes == '') {
            foreach ($date as $d) {
                if (in_array($d, $leaveDates) && $orgUnit->getPunchinOnLeave() == false) // Employee had approved leave
                {
                    continue;
                }

                $rec = [

                    "date"         => $d,
                    "punchStatus"  => -2,
                    "punchinTime"  => "",
                    "punchoutTime" => "",
                    "Note"         => "No Attendance"
                ];


                if (isset($attendence[$d])) //  ATTENDANCE
                {
                    if ($attendence[$d]->getStatus() == 0) {
                        $rec["Note"] = "Punched in - Out is pending";
                    } elseif ($attendence[$d]->getStatus() == 1) {
                        $rec["Note"] = "Punched Out";
                        continue;
                    } elseif ($attendence[$d]->getStatus() == 4) {
                        $att = AttendanceQuery::create()->filterByAttendanceId($attendence[$d]->getAttendanceId())->findOne();
                        if ($att) {
                            $att->setStartTime(null);
                            $att->setEndTime(null);
                            $att->save();
                        }
                        $rec["punchStatus"] = -2;
                        $rec["Note"] = "No Attendance";
                    } elseif ($attendence[$d]->getStatus() == 3) {
                        $rec["Note"] = "Locked";
                    }

                    $rec["punchStatus"] = $attendence[$d]->getStatus();
                    if ($attendence[$d]->getStatus() == 4) {
                        $rec["punchStatus"] = -2;
                    }
                    if ($attendence[$d]->getStartTime() != "" || $attendence[$d]->getStartTime() != null) {
                        $rec["punchinTime"] = $attendence[$d]->getStartTime()->format("H:i");
                    } else {
                        $rec["punchinTime"] = "";
                    }

                    if ($attendence[$d]->getEndTime() != null) {
                        $rec["punchoutTime"] = $attendence[$d]->getEndTime();
                    }
                }

                array_push($responseArray, $rec);
            }
        } else {
            foreach ($date as $d) {
                if (in_array($d, $leaveDates)) // Employee had approved leave
                {
                    continue;
                }
                foreach ($d as $data) {
                    $rec = [

                        "date"         => $data,
                        "punchStatus"  => -2,
                        "punchinTime"  => "",
                        "punchoutTime" => "",
                        "Note"         => "No Attendance"
                    ];


                    if (isset($attendence[$data])) //  ATTENDANCE
                    {
                        if ($attendence[$data]->getStatus() == 0) {
                            $rec["Note"] = "Punched in - Out is pending";
                        } elseif ($attendence[$data]->getStatus() == 1) {
                            $rec["Note"] = "Punched Out";
                            continue;
                        } elseif ($attendence[$data]->getStatus() == 4) {
                            $att = AttendanceQuery::create()->filterByAttendanceId($attendence[$data]->getAttendanceId())->findOne();
                            if ($att) {
                                $att->setStartTime(null);
                                $att->setEndTime(null);
                                $att->save();
                            }
                            $rec["punchStatus"] = -2;
                            $rec["Note"] = "No Attendance";
                        } elseif ($attendence[$data]->getStatus() == 3) {
                            $rec["Note"] = "Locked";
                        }

                        $rec["punchStatus"] = $attendence[$data]->getStatus();
                        if ($attendence[$data]->getStatus() == 4) {
                            $rec["punchStatus"] = -2;
                        }
                        if ($attendence[$data]->getStartTime() != "" || $attendence[$data]->getStartTime() != null) {
                            $rec["punchinTime"] = $attendence[$data]->getStartTime()->format("H:i");
                        } else {
                            $rec["punchinTime"] = "";
                        }

                        if ($attendence[$data]->getEndTime() != null) {
                            $rec["punchoutTime"] = $attendence[$data]->getEndTime();
                        }
                    }
                    array_push($responseArray, $rec);
                }
            }
        }


        return $responseArray;
    }

    public function getWeekoff($currentDate, $weekoffPreviousDate)
    {
        $startDate = strtotime($currentDate);
        $endDate = strtotime($weekoffPreviousDate);
        $dates = [];
        for ($currentDate = $endDate; $currentDate <= $startDate; $currentDate += (86400)) {
            $date = date('Y-m-d', $currentDate);
            if (date("N", $currentDate) == 7) {
                array_push($dates, $date);
            }
        }
        return $dates;
    }

    public function getFreeDatesOld($emp_id, $dayTypes)
    {


        $date = [];

        $holidays = \entities\HolidaysQuery::create()
            ->filterByIstateid($this->app->Auth()->getUser()->getEmployee()->getBranch()->getIstateid())
            ->findByCompanyId($this->app->Auth()->CompanyId());
        $holidaydate = [];

        $emp = $this->app->Auth()->getUser()->getEmployee();
        $stateId = $emp->getBranch()->getIstateid();

        $orgUnit = \entities\OrgUnitQuery::create()->filterByOrgunitid($emp->getOrgUnitId())->findOne();

        // Created At
        $empStartingDate = $emp->getCreatedAt();

        // Joining Date
        $hrDate = HrUserDatesQuery::create()->filterByEmployeeId($emp->getEmployeeId())->findOne();
        if ($hrDate != null) {
            $empStartingDate = $hrDate->getJoinDate();
        }


        foreach ($holidays as $holiday) {
            $holidaydate[] = $holiday->getHolidayDate()->format('Y-m-d');
        }

        $company = CompanyQuery::create()->filterByCompanyId($this->app->Auth()->getUser()->getCompanyId())->findOne();
        if ($company->getReportingDays() == null) {
            $reprtingDays = 45;
        } else {
            $reprtingDays = $company->getReportingDays();
        }

        for ($i = $reprtingDays; $i >= 0; $i--) {
            $day = date("Y-m-d", strtotime("-$i days"));
            $currentDate = DateTime::createFromFormat("Y-m-d", $day);

            if ($currentDate < $empStartingDate) // DATES BEFORE EMP CREATED DATE
            {
                continue;
            }
            if ($currentDate->format("N") == 7 && $orgUnit->getPunchinOnWeekoff() == false) // Sunday
            {
                continue;
            }

            if (in_array($currentDate->format("Y-m-d"), $holidaydate) && $orgUnit->getPunchinOnHoliday() == false) {

                continue;
            }
            /*$leaveDates = LeaveManager::getApprovedLeavesArray($emp_id, $currentDate->format("Y-m-d"), $currentDate->format("Y-m-d"));
            var_dump($leaveDates);*/

            $date[] = $day;
        }
        //$date[] = date("Y-m-d");

        $len = count($date) - 1;

        $attendenceRec = \entities\AttendanceQuery::create()
            ->filterByEmployeeId($emp_id)
            ->filterByAttendanceDate($date[0], Criteria::GREATER_EQUAL)
            ->filterByAttendanceDate($date[$len], Criteria::LESS_EQUAL)
            ->filterByCompanyId($this->app->Auth()->CompanyId())
            ->find();

        $attendence = [];
        foreach ($attendenceRec as $rec) {
            $attendence[$rec->getAttendanceDate()->format("Y-m-d")] = $rec;
        }
        // $leaveDates = LeaveManager::getApprovedLeavesArray($emp_id, $date[0], $date[$len]);

        $leaveDates = LeaveManager::getLeaveDates($emp_id, $date[0], $date[$len], [1, 2]);


        $responseArray = [];
        //        var_dump($leaveDates);exit;
        foreach ($date as $d) {

            if (in_array($d, $leaveDates) && $orgUnit->getPunchinOnLeave() == false) // Employee had approved leave
            {
                continue;
            }


            $rec = [

                "date"         => $d,
                "punchStatus"  => -2,
                "punchinTime"  => "",
                "punchoutTime" => "",
                "Note"         => "No Attendance"
            ];


            if (isset($attendence[$d])) //  ATTENDANCE
            {
                if ($attendence[$d]->getStatus() == 0) {
                    $rec["Note"] = "Punched in - Out is pending";
                } elseif ($attendence[$d]->getStatus() == 1) {
                    $rec["Note"] = "Punched Out";
                    continue;
                } elseif ($attendence[$d]->getStatus() == 4) {
                    $att = AttendanceQuery::create()->filterByAttendanceId($attendence[$d]->getAttendanceId())->findOne();
                    if ($att) {
                        $att->setStartTime(null);
                        $att->setEndTime(null);
                        $att->save();
                    }
                    $rec["punchStatus"] = -2;
                    $rec["Note"] = "No Attendance";
                } elseif ($attendence[$d]->getStatus() == 3) {
                    $rec["Note"] = "Locked";
                }

                $rec["punchStatus"] = $attendence[$d]->getStatus();
                if ($attendence[$d]->getStatus() == 4) {
                    $rec["punchStatus"] = -2;
                }
                if ($attendence[$d]->getStartTime() != "" || $attendence[$d]->getStartTime() != null) {
                    $rec["punchinTime"] = $attendence[$d]->getStartTime()->format("H:i");
                } else {
                    $rec["punchinTime"] = "";
                }

                if ($attendence[$d]->getEndTime() != null) {
                    $rec["punchoutTime"] = $attendence[$d]->getEndTime();
                }
            }

            array_push($responseArray, $rec);
        }

        return $responseArray;
    }


    public function userSessionActivityLog($action, $apptoken)
    {
        $userId = $this->app->Auth()->getUser()->getUserId();
        $userSession = \entities\UserSessionsQuery::create()
            ->filterByUserId($userId)
            ->filterBySessionToken($apptoken)
            ->findOne();
        if (@$userSession->getAppVersion()) {
            if ($userSession->getAppVersion() == null) {
                $userSession->setAppVersion('4.1.15');
            }
        }

        $userSession->setAction($action);
        $userSession->setActivityTime(date('Y-m-d H:i:s'));
        $userSession->save();
    }

}
