<?php

namespace BI\manager;

use DateTime;
use entities\Leaves;
use entities\LeavesQuery;
use entities\EmployeeQuery;
use entities\AttendanceQuery;
use entities\DailycallsQuery;
use entities\Base\HrUserDates;
use entities\HrUserDatesQuery;
use entities\LeaveRequestQuery;
use Modules\ESS\Runtime\EssHelper;
use BI\manager\BrandCampaignManager;
use entities\LeaveConfigurationsQuery;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 * Description of Leave Manager
 *
 * @author archisys8
 */
class LeaveManager
{
    static function createLeaveRequest($pk, \entities\Employee $employee, $LeaveType, $LeaveReason, $LeaveStartDate, $LeaveEndDate)
    {
        $FromDate = $LeaveStartDate;
        $ToDate = $LeaveEndDate;
        $leaveReqDays = $FromDate->diff($ToDate)->format("%r%a");

        $leaveReqTotalDays = $leaveReqDays + 1;

        $leavesCount = \entities\LeavesQuery::create()
            ->select(['LeavesCount'])
            ->withColumn('SUM(leave_points)', 'LeavesCount')
            ->filterByEmployeeId($employee->getPrimaryKey())
            ->filterByLeaveType($LeaveType)
            ->filterByLeavePoints(-1, Criteria::NOT_EQUAL)
            ->find()->toArray();

        $leaveApproved = \entities\LeavesQuery::create()
            ->filterByEmployeeId($employee->getPrimaryKey())
            ->filterByLeaveType($LeaveType)
            ->filterByLeavePoints(-1, Criteria::EQUAL)
            ->find()->count();

        if (isset($leavesCount[0]) && $leavesCount[0] >= $leaveApproved) {
            $pendingLeaveCount = $leavesCount[0] - $leaveApproved;
        } else {
            $pendingLeaveCount = 0;
        }

        if ($LeaveType == 'LWP') {
            $entity = new \entities\LeaveRequest();
            if ($pk > 0) {
                $entity = \entities\LeaveRequestQuery::create()->findPk($pk);
            }
            if ($pk == 0) {
                $entity->setEmployeeId($employee->getPrimaryKey());
                $entity->setCompanyId($employee->getCompanyId());
            }

            $entity->setLeaveStatus(1);
            $entity->setLeaveFrom($LeaveStartDate->format('Y-m-d'));
            $entity->setLeaveTo($LeaveEndDate->format('Y-m-d'));
            $entity->setLeaveType($LeaveType);
            $entity->setLeaveReason($LeaveReason);
            $entity->save();
            if ($entity->getLeaveReqId() != null) {
                $dates = EssHelper::date_range($LeaveStartDate->format('Y-m-d'), $LeaveEndDate->format('Y-m-d'));
                $clearDates = [];

                // Holidays Check
                $holidays = \entities\HolidaysQuery::create()->findByCompanyId($employee->getCompanyId());
                $holidaydate = [];
                $stateId = $employee->getBranch()->getIstateid();
                foreach ($holidays as $holiday) {
                    if ($holiday->getIstateid() != null) {
                        $holidayState = explode(",", (string)$holiday->getIstateid());
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
                $wfManager = new \Modules\System\Processes\WorkflowManager();
                $wfManager->createLog("LeaveRequest", $entity, $employee, 0, "Leave Request Created", 0);
                $wfManager->process("LeaveRequest", $entity, "");

                return $entity->getPrimaryKey();
            } else {
                return false;
            }
        } else {
            if ($pendingLeaveCount >= $leaveReqTotalDays) {
                $entity = new \entities\LeaveRequest();
                if ($pk > 0) {
                    $entity = \entities\LeaveRequestQuery::create()->findPk($pk);
                }
                if ($pk == 0) {
                    $entity->setEmployeeId($employee->getPrimaryKey());
                    $entity->setCompanyId($employee->getCompanyId());
                }

                $entity->setLeaveStatus(1);
                $entity->setLeaveFrom($LeaveStartDate->format('Y-m-d'));
                $entity->setLeaveTo($LeaveEndDate->format('Y-m-d'));
                $entity->setLeaveType($LeaveType);
                $entity->setLeaveReason($LeaveReason);
                $entity->save();

                if ($entity->getLeaveReqId() != null) {
                    $dates = EssHelper::date_range($LeaveStartDate->format('Y-m-d'), $LeaveEndDate->format('Y-m-d'));
                    $clearDates = [];

                    // Holidays Check
                    $holidays = \entities\HolidaysQuery::create()->findByCompanyId($employee->getCompanyId());
                    $holidaydate = [];
                    $stateId = $employee->getBranch()->getIstateid();
                    foreach ($holidays as $holiday) {
                        if ($holiday->getIstateid() != null) {
                            $holidayState = explode(",", (string)$holiday->getIstateid());
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
                }

                $wfManager = new \Modules\System\Processes\WorkflowManager();
                $wfManager->createLog("LeaveRequest", $entity, $employee, 0, "Leave Request Created", 0);
                $wfManager->process("LeaveRequest", $entity, "");

                return $entity->getPrimaryKey();
            } else {
                return false;
            }
        }
    }

    static function leaveRequestExists(int $empId, $leaveFrom, $leaveTo)
    {
        $LeaveRequest = \entities\LeaveRequestQuery::create()
            ->filterByLeaveFrom($leaveTo, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
            ->filterByLeaveTo($leaveFrom, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
            ->filterByEmployeeId($empId)
            ->filterByLeaveStatus([1, 2])
            ->find();
        if ($LeaveRequest->count() > 0) {
            return true;
        } else {
            return false;
        }
    }


    static function LeaveStartEndDate($status, $reqs = array(), $employeeid = 0)
    {
        $leaveArray = array();
        if ($status == "A") {
            $leaveRecords = \entities\LeaveRequestQuery::create()
                ->filterByEmployeeId($reqs)
                ->orderByLeaveFrom(\Propel\Runtime\ActiveQuery\Criteria::DESC)->find();
            if ($leaveRecords) {
                foreach ($leaveRecords as $td) {
                    if (!isset($leaveArray[$td->getLeaveFrom()->format('Y-m')])) {
                        $leaveArray[$td->getLeaveFrom()->format('Y-m')] = $td->getLeaveFrom()->format('M-Y');
                    }
                }
            }
        } else {
            $leaveRecords = \entities\LeaveRequestQuery::create()
                ->filterByLeaveReqId($reqs)
                ->filterByEmployeeId($employeeid, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                ->orderByLeaveFrom(\Propel\Runtime\ActiveQuery\Criteria::DESC)
                ->find();
            if ($leaveRecords) {
                foreach ($leaveRecords as $td) {
                    if (!isset($leaveArray[$td->getLeaveFrom()->format('Y-m')])) {
                        $leaveArray[$td->getLeaveFrom()->format('Y-m')] = $td->getLeaveFrom()->format('M-Y');
                    }
                }
            }
        }
        return $leaveArray;
    }

    static function getallLeaveListnew($filter, $fDate, $tDate, $filterdate, $reqs, $emp, $pageNo = -1, $perPage = 0, $status = 0)
    {
        $records = [];
        if ($perPage == 0) {
            // $LeaveStartMonth = date("Y-m-01 00:00:01", strtotime($filterdate));
            // $LeaveEndMonth = date('Y-m-t 23:59:59', strtotime($filterdate));

            $LeaveStartMonth = $fDate;
            $LeaveEndMonth = $tDate;
        }
        if ($filter == "A") {
            $records = \entities\LeaveRequestQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->filterByEmployee($emp)
                ->joinWithEmployee()
                ->leftJoinWith('Employee.GeoTowns')
                ->leftJoinWith('Employee.OrgUnit');
            if ($perPage == 0) {
                $records->filterByLeaveFrom($LeaveStartMonth, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByLeaveFrom($LeaveEndMonth, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL);
            } else {
                $records->setOffset($pageNo);
                $records->setLimit($perPage);
                $records->orderByLeaveFrom(\Propel\Runtime\ActiveQuery\Criteria::DESC);
            }
            if ($status > 0) {
                $records->filterByLeaveStatus($status);
            }
            $records = $records->find()->toArray();
        } else {
            $records = \entities\LeaveRequestQuery::create()
                ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                ->filterByEmployee($emp, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                ->filterByPrimaryKeys($reqs);
                if($filter !='P' && $filter !='A'){
                    $records->filterByLeaveStatus($filter);
                }                
                $records->joinWithEmployee()
                ->leftJoinWith('Employee.GeoTowns')
                ->leftJoinWith('Employee.OrgUnit');
            if ($pageNo < 0) {
                $records->filterByLeaveFrom($LeaveStartMonth, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByLeaveFrom($LeaveEndMonth, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL);
            } else {
                $records->setOffset($pageNo);
                $records->setLimit($perPage);
                $records->orderByLeaveReqId(\Propel\Runtime\ActiveQuery\Criteria::DESC);
            }
            if ($status > 0) {
                $records->filterByLeaveStatus($status);
            }
            $records = $records->find()->toArray();
        }
        return $records;
    }

    static function deleteleave($pk, $company_id)
    {
        $leave = \entities\LeaveRequestQuery::create()
            //->filterByCompanyId($company_id)
            ->findPk($pk);
        if ($leave) {


            // delete related records - Like Tourplan becomes unplanned

            $wf = new \Modules\System\Processes\WorkflowManager();
            $wf->deleteEntity('Events', $leave);
            $leave->delete();

            return TRUE;
        } else {
            return false;
        }
    }

    static function getApprovedLeavesArray($empId, $startDate, $endDate)
    {
        $leaves = LeaveRequestQuery::create()
            ->filterByLeaveFrom($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
            ->filterByLeaveTo($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
            ->filterByEmployeeId($empId)
            ->filterByLeaveStatus([5, 4, 2, 1])
            ->find()->toArray();
        /*$leaves = LeavesQuery::create()
            ->select(["LeaveDate"])
            ->filterByEmployeeId($empId)
            ->filterByLeaveDate($startDate, Criteria::GREATER_EQUAL)
            ->filterByLeaveDate($endDate, Criteria::LESS_EQUAL)
            ->filterByLeaveRequestId(null, Criteria::NOT_EQUAL)
            ->find()->toArray();*/
        return $leaves;
    }

    static function getLeaveDates($empId, $startDate, $endDate, $status)
    {
        $leaveRequests = \entities\LeaveRequestQuery::create()
            ->filterByEmployeeId($empId)
            ->filterByLeaveFrom($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
            ->filterByLeaveTo($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
            ->filterByLeaveStatus($status)
            ->find()->toArray();
        $leaveDates = array();
        if (count($leaveRequests) > 0) {
            foreach ($leaveRequests as $leaveRequest) {
                $FromDate = $leaveRequest['LeaveFrom'];
                $ToDate = $leaveRequest['LeaveTo'];
                $leaveRequestDates = \Modules\ESS\Runtime\EssHelper::date_range($FromDate, $ToDate);
                foreach ($leaveRequestDates as $leaveRequestDate) {
                    array_push($leaveDates, $leaveRequestDate);
                }
            }
        }

        return $leaveDates;
    }

    public function autoLeaveCreate()
    {// Get all 
        $leaveRequestApprove = \entities\LeaveRequestQuery::create()
            ->filterByLeaveFrom('2023-08-01', \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
            ->filterByLeaveStatus(2)
            ->find()->toArray();
        if (count($leaveRequestApprove) > 0) {
            foreach ($leaveRequestApprove as $leaveRequestAppro) {
                $leavesDelete = \entities\LeavesQuery::create()
                    ->filterByLeaveRequestId($leaveRequestAppro['LeaveReqId'])
                    ->delete();

                $leaves = \entities\LeavesQuery::create()
                    ->filterByLeaveRequestId($leaveRequestAppro['LeaveReqId'])
                    ->find()->toArray();
                if (count($leaves) == 0) {
                    $FromDate = $leaveRequestAppro['LeaveFrom'];
                    $ToDate = $leaveRequestAppro['LeaveTo'];
                    //$leaveReqDays = $FromDate->diff(strtotime($ToDate))->format("%r%a");

                    $date1 = strtotime($FromDate);
                    $date2 = strtotime($ToDate);
                    $diff = $date2 - $date1;
                    $leaveReqDays = floor($diff / (60 * 60 * 24));

                    $employee = \entities\EmployeeQuery::create()
                        ->filterByEmployeeId($leaveRequestAppro['EmployeeId'])
                        ->findOne();

                    $leaveReqTotalDays = $leaveReqDays + 1;

                    if ($leaveRequestAppro['LeaveReqId'] != null) {
                        $dates = EssHelper::date_range($FromDate, $ToDate);
                        $clearDates = [];

                        // Holidays Check
                        $holidays = \entities\HolidaysQuery::create()->findByCompanyId($employee->getCompanyId());
                        $holidaydate = [];
                        $stateId = $employee->getBranch()->getIstateid();
                        foreach ($holidays as $holiday) {
                            if ($holiday->getIstateid() != null) {
                                $holidayState = explode(",", (string)$holiday->getIstateid());
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
                                $leaveEntity->setEmployeeId($leaveRequestAppro['EmployeeId']);
                                $leaveEntity->setLeaveRequestId($leaveRequestAppro['LeaveReqId']);
                                $leaveEntity->setLeaveDate($clearDates[$i]);
                                $leaveEntity->setLeaveType($leaveRequestAppro['LeaveType']);
                                $leaveEntity->setLeaveRemark($leaveRequestAppro['LeaveReason']);
                                $leaveEntity->setLeavePoints(-1);
                                $leaveEntity->setCompanyId($employee->getCompanyId());
                                $leaveEntity->save();
                                echo $leaveRequestAppro['LeaveReqId'].PHP_EOL;
                            }
                        }
                    }
                } else {
                    continue;
                }
            }
        }
    }

    public function allocateLeavesToEmployee() {
        // set_time_limit(0);
        // while (true) {
            echo "Checking for new leave allocation... : Start" . PHP_EOL;
            $this->allocateLeavesToEmployeeOnJoining();
            $this->allocateLeavesToEmployeeOnConfirmation();
            echo "Checking for new leave allocation... : Done" . PHP_EOL;
        //     sleep(3600);
        // }
    }

    public function allocateLeavesToEmployeeOnJoining() {
        try {
            $employeeIds = HrUserDatesQuery::create()
                            ->select(['EmployeeId', 'JoinDate'])
                            ->filterByJoinDate(date('Y-m-d', strtotime('-30 days')), Criteria::GREATER_EQUAL)
                            ->find()
                            ->toKeyValue("EmployeeId", "JoinDate");
            
            $employees = EmployeeQuery::create()
                            ->filterByEmployeeId(array_keys($employeeIds))
                            ->find();
            
            foreach ($employees as $employee) {
                $joiningDate = $employeeIds[$employee->getEmployeeId()];

                $leaveConfiguration = LeaveConfigurationsQuery::create()
                                        ->filterByGradeId($employee->getGradeId())
                                        ->filterByPolicyYear(date('Y', strtotime($joiningDate)))
                                        ->filterByIsActive(true)
                                        ->filterByApplyDate(date('Y-m-d'), Criteria::LESS_EQUAL)
                                        ->filterByLeaveType('CL')
                                        ->filterByCompanyId($employee->getCompanyId())
                                        ->where("'". $employee->getOrgUnitId() ."' = ANY (string_to_array(orgunitids,','))")
                                        ->orderByApplyDate(Criteria::DESC)
                                        ->findOne();
                
                if (!empty($leaveConfiguration)) {
                    $checkIfLeaveExists = LeavesQuery::create()
                                            ->filterByEmployeeId($employee->getPrimaryKey())
                                            ->filterByLeaveRemark('By System : ' . $leaveConfiguration->getPrimaryKey())
                                            ->filterByLeaveType('CL')
                                            ->filterByCompanyId($employee->getCompanyId())
                                            ->filterByLeaveTranMode('Opening')
                                            ->findOne();

                    if(!empty($checkIfLeaveExists)) {
                        continue;
                    }

                    $leavePoint = $leaveConfiguration->getLeavePoints();

                    $calMonths = 12 - date('n', strtotime($joiningDate));
                    if(date('d', strtotime($joiningDate)) < 15) {
                        $calMonths = $calMonths + 1;
                    }
                    
                    $leavePoint = round($leavePoint / 12 * $calMonths);

                    $record = new Leaves();
                    $record->setEmployeeId($employee->getPrimaryKey());
                    $record->setLeaveDate(date('Y-m-d'));
                    $record->setLeaveType('CL');
                    $record->setLeaveRemark('By System : ' . $leaveConfiguration->getPrimaryKey());
                    $record->setLeavePoints($leavePoint);
                    $record->setCompanyId($employee->getCompanyId());
                    $record->setLeaveTranMode('Opening');
                    $record->save();

                    echo "Add ". $leavePoint ." points to CL Leaves for the employee id " . $employee->getPrimaryKey() . PHP_EOL;
                }
            }
        } catch(\Exception $e) {
            echo "Failed to allocated leaves to employee on joining : " . $e->getMessage() . PHP_EOL;
            return [];
        }
    }

    public function allocateLeavesToEmployeeOnConfirmation() {
        try {
            $confirmationDates = HrUserDatesQuery::create()
                            ->select(['EmployeeId', 'ConfirmationDate'])
                            ->filterByConfirmationDate(date('Y-m-d', strtotime('-30 days')), Criteria::GREATER_EQUAL)
                            ->find()
                            ->toKeyValue("EmployeeId", "ConfirmationDate");

            $employees = EmployeeQuery::create()
                            ->filterByEmployeeId(array_keys($confirmationDates))
                            ->find();
            
            $joiningDates = HrUserDatesQuery::create()
                            ->select(['EmployeeId', 'JoinDate'])
                            ->filterByEmployeeId(array_keys($confirmationDates))
                            ->find()
                            ->toKeyValue("EmployeeId", "JoinDate");
            
            foreach ($employees as $employee) {
                $confirmationDate = $confirmationDates[$employee->getEmployeeId()];
                $joiningDate = $joiningDates[$employee->getEmployeeId()];

                if (empty($joiningDate)) {
                    echo "Joining date not found : " . $employee->getPrimaryKey() . PHP_EOL;
                    continue;
                }

                if (date('Y', strtotime($joiningDate)) == date('Y', strtotime($confirmationDate))) {
                    echo "Joining and Confirmation year both are same : " . $employee->getPrimaryKey() . PHP_EOL;
                    continue;
                }

                // $leaveConfiguration = LeaveConfigurationsQuery::create()
                //                         ->filterByGradeId($employee->getGradeId())
                //                         ->filterByPolicyYear(date('Y', strtotime($confirmationDate)))
                //                         ->filterByIsActive(true)
                //                         ->filterByApplyDate(date('Y-m-d'), Criteria::LESS_EQUAL)
                //                         ->filterByLeaveType('PL')
                //                         ->filterByCompanyId($employee->getCompanyId())
                //                         ->where("'". $employee->getOrgUnitId() ."' = ANY (string_to_array(orgunitids,','))")
                //                         ->orderByApplyDate(Criteria::DESC)
                //                         ->findOne();

                // if (!empty($leaveConfiguration)) {
                    $checkIfLeaveExists = LeavesQuery::create()
                                            ->filterByEmployeeId($employee->getPrimaryKey())
                                            ->filterByLeaveRemark('By System : PL - ' . date('Y'))
                                            ->filterByLeaveType('PL')
                                            ->filterByCompanyId($employee->getCompanyId())
                                            ->filterByLeaveTranMode('Opening')
                                            ->findOne();
                                            
                    if(!empty($checkIfLeaveExists)) {
                        // Already given
                    } else {
                        $leavePoint = $this->getPLLeaveBlance($employee, $joiningDate);

                        // $calMonths = 12 - date('n', strtotime($confirmationDate));
                        // if(date('d', strtotime($confirmationDate)) < 15) {
                        //     $calMonths = $calMonths + 1;
                        // }
                        
                        // $leavePoint = round($leavePoint / 12 * $calMonths);

                        $record = new Leaves();
                        $record->setEmployeeId($employee->getPrimaryKey());
                        $record->setLeaveDate(date('Y-m-d'));
                        $record->setLeaveType('PL');
                        $record->setLeaveRemark('By System : PL - ' . date('Y'));
                        $record->setLeavePoints($leavePoint);
                        $record->setCompanyId($employee->getCompanyId());
                        $record->setLeaveTranMode('Opening');
                        $record->save();

                        echo "Add ". $leavePoint ." points to PL Leaves for the employee id " . $employee->getPrimaryKey() . PHP_EOL;
                    }

                // }

                $leaveConfiguration = LeaveConfigurationsQuery::create()
                                        ->filterByGradeId($employee->getGradeId())
                                        ->filterByPolicyYear(date('Y', strtotime($confirmationDate)))
                                        ->filterByIsActive(true)
                                        ->filterByApplyDate(date('Y-m-d'), Criteria::LESS_EQUAL)
                                        ->filterByLeaveType('SL')
                                        ->filterByCompanyId($employee->getCompanyId())
                                        ->where("'". $employee->getOrgUnitId() ."' = ANY (string_to_array(orgunitids,','))")
                                        ->orderByApplyDate(Criteria::DESC)
                                        ->findOne();
                
                if (!empty($leaveConfiguration)) {
                    $checkIfLeaveExists = LeavesQuery::create()
                                            ->filterByEmployeeId($employee->getPrimaryKey())
                                            ->filterByLeaveRemark('By System : ' . $leaveConfiguration->getPrimaryKey())
                                            ->filterByLeaveType('SL')
                                            ->filterByCompanyId($employee->getCompanyId())
                                            ->filterByLeaveTranMode('Opening')
                                            ->findOne();
                                            
                    if(!empty($checkIfLeaveExists)) {
                        // Already given
                    } else {
                        $leavePoint = $leaveConfiguration->getLeavePoints();

                        // $calMonths = 12 - date('n', strtotime($confirmationDate));
                        $calMonths = 12 - date('n', strtotime($joiningDate));
                        if(date('d', strtotime($joiningDate)) < 15) {
                            $calMonths = $calMonths + 1;
                        }

                        $leavePoint = round($leavePoint / 12 * $calMonths);

                        $record = new Leaves();
                        $record->setEmployeeId($employee->getPrimaryKey());
                        $record->setLeaveDate(date('Y-m-d'));
                        $record->setLeaveType('SL');
                        $record->setLeaveRemark('By System : ' . $leaveConfiguration->getPrimaryKey());
                        $record->setLeavePoints($leavePoint);
                        $record->setCompanyId($employee->getCompanyId());
                        $record->setLeaveTranMode('Opening');
                        $record->save();

                        echo "Add ". $leavePoint ." points to SL Leaves for the employee id " . $employee->getPrimaryKey() . PHP_EOL;
                    }
                } else {
                    echo "Leave configuration not found for the employee id " . $employee->getPrimaryKey() . PHP_EOL;
                }
            }
        } catch(\Exception $e) {
            echo "Failed to allocated leaves to employee on confirmation : " . $e->getMessage() . PHP_EOL;
            return [];
        }
    }

    public function getPLLeaveBlance($employee, $joiningDate) {
        $position = $employee->getPositionsRelatedByPositionId();
        $orgUnitId = $employee->getOrgUnitId();
        $leaveBalance = 0;

        if (empty($orgUnitId) || empty($position)) {
            echo "Position / Orgunit not found : " . $employee->getPrimaryKey() . PHP_EOL;
            return $leaveBalance;
        }

        $positionCode = $position->getPositionCode();
        if (empty($positionCode)) {
            echo "Position code not found : " . $employee->getPrimaryKey() . PHP_EOL;
            return $leaveBalance;
        }
        
        if (str_starts_with($positionCode, '1')) {
            if(in_array($orgUnitId, [34, 38, 60, 55, 35, 50, 37, 59, 51, 49, 42, 45])) {
                // Eyecare / Osteofit / Pharma / Specia / Megacare / Enteron / Maxis / Alcare / Gastron / Corium / Ouron / Nepal
                
                // based on working days
                // $FWDays = DailycallsQuery::create()
                //             ->select(['DcrDate'])
                //             ->filterByEmployeeId($employee->getEmployeeId())
                //             ->filterByDcrDate($joiningDate, Criteria::GREATER_EQUAL)
                //             ->filterByDcrDate(date('Y', strtotime($joiningDate)) .'-12-31', Criteria::LESS_EQUAL)
                //             ->filterByAgendacontroltype('FW')
                //             ->groupByDcrDate()
                //             ->find()->count();
                $FWDays = AttendanceQuery::create()
                            ->select(['AttendanceDate'])
                            ->filterByEmployeeId($employee->getEmployeeId())
                            ->filterByAttendanceDate($joiningDate, Criteria::GREATER_EQUAL)
                            ->filterByAttendanceDate(date('Y', strtotime('Y', strtotime('-1 year'))) .'-12-31', Criteria::LESS_EQUAL)
                            ->filterByStatus(1)
                            ->groupByAttendanceDate()
                            ->find()->count();
                $leaveBalance = $FWDays / 11;

            } elseif (in_array($orgUnitId, [36, 39, 48, 43, 47])) {
                // Summit / Zenovi / Corazon / Elena / Cardigem 
                $leaveBalance = 25;
                $calMonths = 12 - date('n', strtotime($joiningDate));
                if(date('d', strtotime($joiningDate)) < 15) {
                    $calMonths = $calMonths + 1;
                }
                $leaveBalance = round($leaveBalance / 12 * $calMonths);

            } elseif (in_array($orgUnitId, [58, 46, 44, 52, 53, 54, 56, 40])) {
                // Access / Algrow / Farm Cure / Generic Mktg / Pegasus / Poultry / Unicorn / VetMax
                $leaveBalance = 21;
                $calMonths = 12 - date('n', strtotime($joiningDate));
                if(date('d', strtotime($joiningDate)) < 15) {
                    $calMonths = $calMonths + 1;
                }
                $leaveBalance = round($leaveBalance / 12 * $calMonths);
            } else {
                // orgUnitId - 41, 57 : not set yet
                echo "Leave balance not set : " . $employee->getPrimaryKey() . PHP_EOL;
            }
        } else {
            $leaveBalance = 21;
            $calMonths = 12 - date('n', strtotime($joiningDate));
            if(date('d', strtotime($joiningDate)) < 15) {
                $calMonths = $calMonths + 1;
            }
            $leaveBalance = round($leaveBalance / 12 * $calMonths);
        }

        return round($leaveBalance);
    }

    public function attendanceLeave(){
        $attendance = \entities\AttendanceQuery::create()
                        ->filterByStatus([0,1])
                        ->find();
        if($attendance->count() > 0){
            foreach($attendance as $atd){
                $leave = \entities\LeavesQuery::create()
                            ->filterByEmployeeId($atd->getEmployeeId())
                            ->filterByLeaveDate($atd->getAttendanceDate())
                            ->findOne();
                if($leave != null && $leave != '' && $leave->getLeaveRequestId() != null && $leave->getLeaveRequestId() != ''){
                    $leaveRequest = \entities\LeaveRequestQuery::create()
                                    ->filterByLeaveReqId($leave->getLeaveRequestId())
                                    ->filterByLeaveStatus([2])
                                    ->findOne();
                    if($leaveRequest != null && $leaveRequest != ''){
                        $remark = $leaveRequest->getLeaveType().' : '.$leaveRequest->getLeaveReason().
                        $atd->setStatus(4);
                        $atd->setRemark($remark);
                        $atd->save();
                    }
                }
            }
        }
    }
    
}