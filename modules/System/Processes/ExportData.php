<?php

declare(strict_types=1);

namespace Modules\System\Processes;

use DateTime;
use DatePeriod;
use DateInterval;
use entities\RolesQuery;
use entities\LeavesQuery;
use entities\EmployeeQuery;
use entities\ExportSgpiOut;
use entities\GeoTownsQuery;
use entities\HolidaysQuery;
use entities\ExportDarQuery;
use entities\ExportDcrQuery;
use entities\ExportPobQuery;
use entities\AttendanceQuery;
use entities\DailycallsQuery;
use entities\WdbSyncLogQuery;
use entities\AgendatypesQuery;
use entities\AuditTableDataQuery;
use entities\ExportEdetailing;
use entities\HrUserDatesQuery;
use entities\TerritoriesQuery;
use entities\LeaveRequestQuery;
use entities\ExportSgpiOutQuery;
use entities\MonthExpensesQuery;
use entities\OnBoardRequestQuery;
use Modules\ESS\Runtime\EssHelper;
use entities\ExportEdetailingQuery;
use entities\ExportRcpaSummaryQuery;
use entities\ExportBrandCampaignQuery;
use entities\EmployeeLeaveBalanceQuery;
use entities\ExportRcpaSkuSummaryQuery;
use Modules\System\Processes\WriteData;
use entities\ExportExpensesSummaryQuery;
use entities\OnBoardRequestAddressQuery;
use Modules\Reports\Controllers\Reports;
use Propel\Runtime\ActiveQuery\Criteria;
use entities\ExportExpenseStatusViewQuery;
use entities\ExpensePaymentsQuery;
use entities\SalaryAttendanceBackdateTrackLogQuery;

class ExportData extends \App\Core\Process
{
    private $company_id, $exportFile, $hasError, $errorMessage, $totalCount;
    private $expensePaymentListArray, $isSetExpensePaymentList;

    public function __construct($company_id)
    {
        $this->company_id = $company_id;
        $this->exportFile = fopen('php://temp', 'r+');
        $this->hasError = false;
        $this->errorMessage = '';
        $this->totalCount = 0;
        $this->isSetExpensePaymentList = false;
        $this->expensePaymentListArray = [];

        try {
            $serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
            $serviceContainer->getConnection()->exec("call do_before_export_data()");
        } catch (\Exception $e) {
            // echo $e->getMessage().PHP_EOL;
        }
    }

    private function getExpensePaymentRecordByEmployeeIdFromArray($employeeId, $month)
    {
        $payments = $this->getExpensePaymentArray($month);
        return isset($payments[$employeeId]) ? $payments[$employeeId] : [];
    }

    private function getExpensePaymentArray($month)
    {
        if (!$this->isSetExpensePaymentList) {
            echo "Start to get expense payments array" . PHP_EOL;
            $payments = ExpensePaymentsQuery::create()
                ->filterByExpenseMonth($month)
                ->filterByCompanyId($this->company_id)
                ->find()->toArray();

            foreach ($payments as $payment) {
                $this->expensePaymentListArray[$payment['EmployeeId']] = $payment;
                unset($payment);
            }

            unset($payments);
            $this->isSetExpensePaymentList = true;
            echo "End to get expense payments array : " . count($this->expensePaymentListArray) . PHP_EOL;
        }

        return $this->expensePaymentListArray;
    }

    private function addDataToFile($data)
    {
        $this->totalCount++;
        fputcsv($this->exportFile, $data);
    }

    private function returnResponse()
    {
        rewind($this->exportFile);
        $exportContent = stream_get_contents($this->exportFile);
        fclose($this->exportFile);

        return [
            'exportContent' => $exportContent,
            'hasError' => $this->hasError,
            'errorMessage' => $this->errorMessage,
            'totalCount' => ($this->totalCount - 1)
        ];
    }

    public function exportCSVContent($exportFunction, $startDate, $endDate)
    {
        if (!empty($exportFunction)) {
            $functionArgumentCheck = explode(',', $exportFunction);
            if (count($functionArgumentCheck) > 1) {
                $exportFunction = $functionArgumentCheck[0];
                if (method_exists($this, $exportFunction)) {
                    $this->$exportFunction($startDate, $endDate, $functionArgumentCheck[1]);
                } else {
                    $this->hasError = true;
                    $this->errorMessage = "Export method not found!";
                }
            } else {
                if (method_exists($this, $exportFunction)) {
                    $this->$exportFunction($startDate, $endDate);
                } else {
                    $this->hasError = true;
                    $this->errorMessage = "Export method not found!";
                }
            }
            //call_user_func($exportFunction,$startDate, $endDate);
        } else {
            $this->hasError = true;
            $this->errorMessage = "Export method not found!";
        }

        return $this->returnResponse();
    }

    private function exportAttendanceData($startDate, $endDate)
    {
        if(date('d', strtotime($startDate)) < 24) {
            $startOfMonth = date('Y-m-24', strtotime($startDate . ' first day of last month'));
            $endOfMonth = date('Y-m-23', strtotime($startDate));
        } else {
            $startOfMonth = date('Y-m-24', strtotime($startDate));
            $endOfMonth = date('Y-m-23', strtotime($startDate . ' first day of next month'));
        }

        $previousMonthStartDate = date('Y-m-d', strtotime('-1 Month', strtotime($startOfMonth)));
        $previousMonthEndDate = date('Y-m-d', strtotime('-1 Month', strtotime($endOfMonth)));

        $previousToPreviousMonthStartDate = date('Y-m-d', strtotime('-2 Month', strtotime($startOfMonth)));
        $previousToPreviousMonthEndDate = date('Y-m-d', strtotime('-2 Month', strtotime($endOfMonth)));

        $dates = $showDates = [];
        $weekOffs = [];

        $periodDate = $startOfMonth;

        while ($periodDate <= $endOfMonth) {
            $dates[] = $periodDate;
            $showDates[] = date('d-m-Y', strtotime($periodDate));

            if (date('N', strtotime($periodDate)) == 7) {
                $weekOffs[] = $periodDate;
            }

            $periodDate = date('Y-m-d', strtotime($periodDate . ' +1 day'));
        }

        $beforecolumns = ['Division', 'Poisition Name', 'Position Code', 'Employee Name', 'Employee Code', 'Employee ID', 'Role', 'Designation', 'Status'];
        $aftercolumns = ['Last DAR', 'DOJ', 'Flag', 'No. Of Field Days Worked', 'Total Month Days', 'Absent Days Of Current Cycle', 'Absent Dates Of Current Cycle', 'LWP Day Of Current Cycle', 'LWP Dates Of Current Cycle', 'Total Leaves Of Current Cycle', 'Total NCA Days Of Current Cycle', 'Backdate Previous Deduction Day', 'Backdate Previous Deduction Date', 'Backdate Previous To Previous day', 'Backdate Previous To Previous Date', 'Current Status Of Backdate Previous Days', 'Current Status Of Backdate Previous Dates', 'Current Status of Backdate Previous To Previous Days', 'Current Status Of Backdate Previous To Previous Dates', 'LWP Day Count Which Approved In Current period (For Previous 2 Months)', 'LWP Date Which Approved In Current Period (For Previous 2 Months)', 'Account Unlock Count'];
        $columnsRow = array_merge($beforecolumns, $showDates, $aftercolumns);
        $this->addDataToFile($columnsRow);

        $employees = EmployeeQuery::create()
            ->joinHrUserDates()
            ->where('HrUserDates.JoinDate <= ?', $endOfMonth)
            ->condition('cond1', 'HrUserDates.ResignDate is null')
            ->condition('cond2', 'HrUserDates.ResignDate >= ? and HrUserDates.ResignDate <= ?', [$startOfMonth, $endOfMonth])
            ->where(array('cond1', 'cond2'), 'or')
            ->filterByCompanyId($this->company_id)
            ->find();

        $count = 0;
        $lastPer = 0;
        echo "Attendance Report : ";

        foreach ($employees as $employee) {

            $holidays = HolidaysQuery::create()
                ->select(["HolidayDate", "HolidayName"])
                ->filterByIstateid($employee->getBranch()->getIstateid())
                ->filterByHolidayDate($startOfMonth, Criteria::GREATER_EQUAL)
                ->filterByHolidayDate($endOfMonth, Criteria::LESS_EQUAL)
                ->filterByCompanyId($this->company_id)
                ->find()
                ->toKeyValue("HolidayDate", "HolidayName");

            $leaves = LeavesQuery::create()
                ->select(["LeaveDate", "LeaveType"])
                ->addjoin('leaves.leave_request_id', 'leave_request.leave_req_id', Criteria::INNER_JOIN)
                ->where('leave_request.leave_status = 2')
                ->filterByEmployeeId($employee->getPrimaryKey())
                ->filterByLeaveDate($startOfMonth, Criteria::GREATER_EQUAL)
                ->filterByLeaveDate($endOfMonth, Criteria::LESS_EQUAL)
                ->filterByLeavePoints(0, Criteria::LESS_THAN)
                ->find()
                ->toKeyValue("LeaveDate", "LeaveType");

            $punchoutAttendances = AttendanceQuery::create()
                ->select(["AttendanceDate"])
                ->filterByEmployeeId($employee->getPrimaryKey())
                ->filterByAttendanceDate($startOfMonth, Criteria::GREATER_EQUAL)
                ->filterByAttendanceDate($endOfMonth, Criteria::LESS_EQUAL)
                ->filterByStatus(1)
                ->find()
                ->toArray();

            $userRole = RolesQuery::create()
                ->select(['RoleName'])
                ->filterByRoleId($employee->getUserss()[0]->getRoleId())
                ->findOne();

            $position = $employee->getPositionsRelatedByPositionId();

            // $lastPunchout = AttendanceQuery::create()
            //                     ->select(["EmployeeId"])
            //                     ->withColumn('MAX(attendance.attendance_date)', 'LastPunchout')
            //                     ->filterByEmployeeId($employee->getEmployeeId())
            //                     ->filterByCompanyId($this->company_id)
            //                     ->filterByStatus(1)
            //                     ->groupByEmployeeId()
            //                     ->findOne();
            $lastDCR = DailycallsQuery::create()
                        ->select(["EmployeeId"])
                        ->withColumn('MAX(dailycalls.dcr_date)', 'LastDCRDate')
                        ->addjoin('dailycalls.employee_id', 'attendance.employee_id', Criteria::INNER_JOIN)
                        ->where('attendance.status = 1')
                        ->where('attendance.attendance_date = dailycalls.dcr_date')
                        ->filterByEmployeeId($employee->getEmployeeId())
                        ->filterByDcrStatus(['completed', 'Reported'])
                        ->filterByCompanyId($this->company_id)
                        ->groupByEmployeeId()
                        ->findOne();
            
            $lastLeave = LeavesQuery::create()
                            ->select(["EmployeeId"])
                            ->withColumn('MAX(leaves.leave_date)', 'LastLeaveDate')
                            ->addjoin('leaves.leave_request_id', 'leave_request.leave_req_id', Criteria::INNER_JOIN)
                            ->where('leave_request.leave_status = 2')
                            ->filterByEmployeeId($employee->getPrimaryKey())
                            ->filterByLeavePoints(0, Criteria::LESS_THAN)
                            ->filterByLeaveDate(date('Y-m-d'), Criteria::LESS_EQUAL)
                            ->groupByEmployeeId()
                            ->findOne();
                            
            $lastDCRDate = (!empty($lastDCR) && isset($lastDCR['LastDCRDate']) ? $lastDCR['LastDCRDate'] : '');
            $lastLeaveDate = (!empty($lastLeave) && isset($lastLeave['LastLeaveDate']) ? $lastLeave['LastLeaveDate'] : '');

            if(!empty($lastDCRDate) && !empty($lastLeaveDate) && strtotime($lastLeaveDate) > strtotime($lastDCRDate)) {
                if(strtotime($lastLeaveDate) > time()) {
                    $lastWorkingDay = date('d-m-Y');
                } else {
                    $lastWorkingDay = date('d-m-Y', strtotime($lastLeaveDate));
                }
            } else {
                $lastWorkingDay = !empty($lastDCRDate) ? date('d-m-Y', strtotime($lastDCRDate)) : '';
            }

            $joiningDate = !empty($employee->getHrUserDatess()) ? $employee->getHrUserDatess()[0]->getJoinDate() : null;
            $resignDate = !empty($employee->getHrUserDatess()) ? $employee->getHrUserDatess()[0]->getResignDate() : null;
            // $isManager = (!empty($position->getPositionCode()) && !str_starts_with($position->getPositionCode(), '1')) ? true : false;

            if(!empty($joiningDate)) {
                $joiningDate = $joiningDate->format('Y-m-d');
            }

            if(!empty($resignDate)) {
                $resignDate = $resignDate->format('Y-m-d');
            }

            $beforeValues = $dateValues = $afterValues = [];
            $abDays = $noOfUnLock = $leaveDays = $ncaDays = $fwDays = $holidayDays = $weekOffDays = $lwpDays = 0;
            $abDates = $lwpDates = [];

            $beforeValues = [
                $employee->getOrgUnit()->getUnitName(),
                $position->getPositionName(),
                $position->getPositionCode(),
                $employee->getFirstName() . ' ' . $employee->getLastName(),
                $employee->getEmployeeCode(),
                $employee->getEmployeeId(),
                $userRole,
                $employee->getDesignations()->getDesignation(),
                $employee->getStatus() ? 'Active' : 'Inactive'
            ];

            foreach ($dates as $date) {
                $currentDate = $date;
                $dateWorking = '';

                if ($currentDate >= date('Y-m-d')) {
                    $dateValues[] = $dateWorking;
                    continue;
                }

                if(isset($leaves[$currentDate]) && in_array($leaves[$currentDate], ['PL', 'LWP'])){
                    $dateWorking = "Leave - " . $leaves[$currentDate];
                    $leaveDays++;
                    if($leaves[$currentDate] == 'LWP') {
                        $lwpDays++;
                        $lwpDates[] = date('d-m-Y', strtotime($currentDate));
                    }
                } elseif (isset($leaves[$currentDate])) {
                    $dateWorking = "Leave - " . $leaves[$currentDate];
                    $leaveDays++;
                    if($leaves[$currentDate] == 'LWP') {
                        $lwpDays++;
                        $lwpDates[] = date('d-m-Y', strtotime($currentDate));
                    }
                } else {
                    // $totalCalls = DailycallsQuery::create()
                    //     ->filterByEmployeeId($employee->getEmployeeId())
                    //     ->filterByDcrStatus(['completed', 'Reported'])
                    //     ->filterByDcrDate($currentDate)
                    //     ->filterByCompanyId($this->company_id)
                    //     ->count();
                    // $dateWorking = $totalCalls;
                    $totalCalls = '';

                    $drCall = DailycallsQuery::create()
                                ->filterByEmployeeId($employee->getEmployeeId())
                                ->useOutletOrgDataExistsQuery()
                                    ->useOutletsQuery()
                                        ->useOutletTypeExistsQuery()
                                            ->filterByOutlettypeName('Doctor')
                                        ->endUse()
                                    ->endUse()
                                ->endUse()
                                ->filterByDcrDate($currentDate)
                                ->filterByAgendacontroltype('FW')
                                ->filterByCompanyId($this->company_id)
                                ->count();

                    // if not punchout wipeup the calls
                    if(!in_array($currentDate, $punchoutAttendances)){
                        $drCall = 0;
                    }

                    $totalCalls .= strval($drCall);
                    
                    $pharmacyCall = DailycallsQuery::create()
                                        ->filterByEmployeeId($employee->getEmployeeId())
                                        ->useOutletOrgDataExistsQuery()
                                            ->useOutletsQuery()
                                                ->useOutletTypeExistsQuery()
                                                    ->filterByOutlettypeName('Pharmacy')
                                                ->endUse()
                                            ->endUse()
                                        ->endUse()
                                        ->filterByDcrDate($currentDate)
                                        ->filterByAgendacontroltype('FW')
                                        ->filterByCompanyId($this->company_id)
                                        ->count();

                    // if not punchout wipeup the calls
                    if(!in_array($currentDate, $punchoutAttendances)){
                        $pharmacyCall = 0;
                    }

                    $totalCalls .= ' | ' . strval($pharmacyCall);
                    
                    $stockiestCall = DailycallsQuery::create()
                                        ->filterByEmployeeId($employee->getEmployeeId())
                                        ->useOutletOrgDataExistsQuery()
                                            ->useOutletsQuery()
                                                ->useOutletTypeExistsQuery()
                                                    ->filterByOutlettypeName('Stockist')
                                                ->endUse()
                                            ->endUse()
                                        ->endUse()
                                        ->filterByDcrDate($currentDate)
                                        ->filterByAgendacontroltype('FW')
                                        ->filterByCompanyId($this->company_id)
                                        ->count();

                    // if not punchout wipeup the calls
                    if(!in_array($currentDate, $punchoutAttendances)){
                        $stockiestCall = 0;
                    }
                    
                    $totalCalls .= ' | ' . strval($stockiestCall);

                    $ncaRecords = DailycallsQuery::create()
                                    ->select('AgendaId')
                                    ->filterByEmployeeId($employee->getEmployeeId())
                                    ->filterByDcrDate($currentDate)
                                    ->filterByAgendacontroltype('NCA')
                                    ->filterByCompanyId($this->company_id)
                                    ->find()
                                    ->toArray();
                    
                    // if not punchout wipeup the calls
                    if(!in_array($currentDate, $punchoutAttendances)){
                        $ncaRecords = [];
                    }

                    if(count($ncaRecords) > 0) {
                        $ncaAgends = AgendatypesQuery::create()
                                    ->select('Agendname')
                                    ->filterByAgendaid($ncaRecords)
                                    ->filterByCompanyId($this->company_id)
                                    ->find()
                                    ->toArray();
                        $ncaAgends = implode(', ', $ncaAgends);

                        $totalCalls .= ' | NCA - ' . strval($ncaAgends);

                        $ncaDays++;
                    }

                    if($drCall < 1 && $pharmacyCall < 1 && $stockiestCall < 1 && count($ncaRecords) < 1) {
                        // Ticket: TSPC-613
                        if (in_array($currentDate, $weekOffs)) {
                            $dateWorking = "W";
                            $weekOffDays++;
                        } elseif (isset($holidays[$currentDate])) {
                            $dateWorking = "Holiday - " . $holidays[$currentDate];
                            $holidayDays++;
                        } elseif (!empty($joiningDate) && $joiningDate > $currentDate) {
                            $dateWorking = 'NJ';
                        } elseif (!empty($resignDate) && $resignDate <= $currentDate) {
                            $dateWorking = 'Resigned';
                        } else {
                            $dateWorking = 'Ab';
                            $abDays++;
                            $abDates[] = date('d-m-Y', strtotime($currentDate));
                        }
                    } else {
                        $dateWorking = $totalCalls;
                        // Ticket: TSPC-613
                        if (!in_array($currentDate, $weekOffs) && !isset($holidays[$currentDate])) {
                            $fwDays++;
                        }

                        if (in_array($currentDate, $weekOffs)) {
                            $weekOffDays++;
                        }
                    }
                } 

                // if (!empty($dateWorking)) {
                //     $dateWorking = $dateWorking . ' | FW(' . $FWCount . ') NCA(' . $NCACount . ')';
                // } else {
                //     $dateWorking = 'FW(' . $FWCount . ') NCA(' . $NCACount . ')';
                // }

                $dateValues[] = $dateWorking;
            }

            $flagValue = '';
            if($abDays > 10) {
                $flagValue = 'Absent';
            } elseif($noOfUnLock > 2) {
                $flagValue = 'Defaulter';
            } elseif($leaveDays > 10) {
                $flagValue = 'Long leave';
            } elseif($ncaDays > 10) {
                $flagValue = 'NCA reported';
            }

            // Get Previous Data
            $backLog = SalaryAttendanceBackdateTrackLogQuery::create()
                        ->filterByEmployeeId($employee->getPrimaryKey())
                        ->filterByPreviousFromDate($previousMonthStartDate)
                        ->filterByPreviousToDate($previousMonthEndDate)
                        ->findOne();

            if(!empty($backLog)) {
                $backDateDeductionDay = $backLog->getBackdatePreviousDeductionDay();
                $backDateDeductionDate = $backLog->getBackdatePreviousDeductionDate();
                $backDatePreviousDay = $backLog->getBackdatePreviousToPreviousDay();
                $backDatePreviousDate = $backLog->getBackdatePreviousToPreviousDate();
            } else {
                $backDateDeductionDay = $backDateDeductionDate = $backDatePreviousDay = $backDatePreviousDate = '';
            }

            $currentStatusBackDatePreviousDay = $currentStatusBackDatePreviousDate = $currentStatusBackDatePreviousToPreviousDay = $currentStatusBackDatePreviousToPreviousDate = '';
            $lwpDayCountApprovedCurrentCycle = 0;
            $lwpDateCountApprovedCurrentCycle = [];
            
            $previousMonthsDCRs = DailycallsQuery::create()
                                ->select(['DcrDate'])
                                ->filterByEmployeeId($employee->getEmployeeId())
                                ->filterByDcrDate($previousToPreviousMonthStartDate, Criteria::GREATER_EQUAL)
                                ->filterByDcrDate($previousMonthEndDate, Criteria::LESS_EQUAL)
                                ->filterByCompanyId($this->company_id)
                                ->groupByDcrDate()
                                ->find()->toArray();
            
            $previousMonthsHolidays = HolidaysQuery::create()
                            ->select(["HolidayDate"])
                            ->filterByIstateid($employee->getBranch()->getIstateid())
                            ->filterByHolidayDate($previousToPreviousMonthStartDate, Criteria::GREATER_EQUAL)
                            ->filterByHolidayDate($previousMonthEndDate, Criteria::LESS_EQUAL)
                            ->filterByCompanyId($this->company_id)
                            ->groupByHolidayDate()
                            ->find()->toArray();
                
            $previousMonthsLeaves = LeavesQuery::create()
                        ->select(["LeaveDate"])
                        ->addjoin('leaves.leave_request_id', 'leave_request.leave_req_id', Criteria::INNER_JOIN)
                        ->where('leave_request.leave_status = 2')
                        ->filterByEmployeeId($employee->getPrimaryKey())
                        ->filterByLeaveDate($previousToPreviousMonthStartDate, Criteria::GREATER_EQUAL)
                        ->filterByLeaveDate($previousMonthEndDate, Criteria::LESS_EQUAL)
                        ->filterByLeavePoints(0, Criteria::LESS_THAN)
                        ->groupByLeaveDate()
                        ->find()->toArray();

            $lwpLeavesOfLastTwoMonths = LeavesQuery::create()
                        ->select(["LeaveDate"])
                        ->addjoin('leaves.leave_request_id', 'leave_request.leave_req_id', Criteria::INNER_JOIN)
                        ->where('leave_request.leave_status = 2')
                        ->filterByEmployeeId($employee->getPrimaryKey())
                        ->filterByLeaveDate($previousToPreviousMonthStartDate, Criteria::GREATER_EQUAL)
                        ->filterByLeaveDate($previousMonthEndDate, Criteria::LESS_EQUAL)
                        ->where("DATE(leave_request.created_at) >= '". $startOfMonth . "'")
                        ->where("DATE(leave_request.created_at) <= '". $endOfMonth . "'")
                        ->where("DATE(leaves.created_at) >= '". $startOfMonth . "'")
                        ->where("DATE(leaves.created_at) <= '". $endOfMonth . "'")
                        // ->filterByCreatedAt($startOfMonth, Criteria::GREATER_EQUAL)
                        // ->filterByCreatedAt($endOfMonth, Criteria::LESS_EQUAL)
                        ->filterByLeavePoints(0, Criteria::LESS_THAN)
                        ->filterByLeaveType('LWP')
                        ->find()->toArray();

            foreach ($lwpLeavesOfLastTwoMonths as $lwpOldMonthDate) {
                $lwpDateCountApprovedCurrentCycle[] = date('d-m-Y', strtotime($lwpOldMonthDate));
                $lwpDayCountApprovedCurrentCycle++;
            }

            $workedDates = array_merge($previousMonthsDCRs, $previousMonthsHolidays, $previousMonthsLeaves);

            $previousToPreviousMonthDates = $previousMonthDates = [];

            $periodDate = $previousToPreviousMonthStartDate;
            while ($periodDate <= $previousToPreviousMonthEndDate) {
                $date = $periodDate;

                if (date('N', strtotime($date)) == 7 || (!empty($joiningDate) && $joiningDate > $date) || (!empty($resignDate) && $resignDate <= $date) || in_array($date, $workedDates) ) {
                    // continue;
                } else {
                    $previousToPreviousMonthDates[] = date('d-m-Y', strtotime($periodDate));
                }

                $periodDate = date('Y-m-d', strtotime($periodDate . ' +1 day'));
            }

            $currentStatusBackDatePreviousToPreviousDay = count($previousToPreviousMonthDates);
            $currentStatusBackDatePreviousToPreviousDate = implode(', ', $previousToPreviousMonthDates);

            $periodDate = $previousMonthStartDate;
            while ($periodDate <= $previousMonthEndDate) {
                $date = $periodDate;

                if (date('N', strtotime($periodDate)) == 7 || (!empty($joiningDate) && $joiningDate > $date) || (!empty($resignDate) && $resignDate <= $date) || in_array($date, $workedDates) ) {
                    // continue;
                } else {
                    $previousMonthDates[] = date('d-m-Y', strtotime($periodDate));
                }

                $periodDate = date('Y-m-d', strtotime($periodDate . ' +1 day'));
            }

            $currentStatusBackDatePreviousDay = count($previousMonthDates);
            $currentStatusBackDatePreviousDate = implode(', ', $previousMonthDates);

            $afterValues = [
                // (!empty($lastDCR) && isset($lastDCR['LastDCRDate']) ? date('d-m-Y', strtotime($lastDCR['LastDCRDate'])) : ''),
                $lastWorkingDay,
                (!empty($joiningDate) ? date('d-m-Y', strtotime($joiningDate)) : ''),
                $flagValue,
                $fwDays,
                ($fwDays + $leaveDays + $holidayDays + $weekOffDays - $lwpDays),
                $abDays,
                implode(', ', $abDates),
                $lwpDays,
                implode(', ', $lwpDates),
                $leaveDays,
                $ncaDays,
                $backDateDeductionDay,
                $backDateDeductionDate,
                $backDatePreviousDay,
                $backDatePreviousDate,
                $currentStatusBackDatePreviousDay,
                $currentStatusBackDatePreviousDate,
                $currentStatusBackDatePreviousToPreviousDay,
                $currentStatusBackDatePreviousToPreviousDate,
                $lwpDayCountApprovedCurrentCycle,
                implode(', ', $lwpDateCountApprovedCurrentCycle),
                $noOfUnLock,
            ];

            $data = array_merge($beforeValues, $dateValues, $afterValues);
            $this->addDataToFile($data);

            $count++;
            $progress = round($count / count($employees) * 100, 0);
            if ($lastPer != $progress) {
                echo " " . $progress . "% " . PHP_EOL;
                $lastPer = $progress;
            }

            unset($data);
            unset($beforeValues);
            unset($dateValues);
            unset($afterValues);
        }

        return true;
    }

    private function exportWDBSyncLogData($startDate, $endDate)
    {
        $lastBkpDate = date("Y-m-d", strtotime('-1 month', strtotime($endDate)));

        $columns = ['wdb_id', 'sys_table', 'sys_operation', 'sys_body', 'user_id', 'token_id', 'device_info', 'company_id', 'created_at', 'updated_at', 'wdb_key', 'newpk', 'res_message', 'device_timestamp'];

        $allBkpLogs = WdbSyncLogQuery::create()
            ->filterByCreatedAt($lastBkpDate, Criteria::LESS_THAN)
            ->limit(1000)
            ->find()
            ->toArray();
        
        $wsgpi = new WriteData();
        $wsgpi->writeWDBSyncLog($allBkpLogs);

        // $columnsRow = array_merge($columns, $allBkpLogs);
        $this->addDataToFile($columns);

        return true;
    }

    private function exportDCRDailyData($startDate, $endDate)
    {
        $columns = ['bu_name', 'zm_manager_branch', 'zm_manager_town', 'rm_manager_branch', 'rm_manager_town', 'am_manager_branch', 'am_manager_town', 'zm_position_code', 'rm_position_code', 'am_position_code', 'emp_position_code', 'emp_position_name', 'emp_level', 'employee_code', 'employee', 'jw_employee_code', 'jw_employee', 'jw_position_name', 'outlet_type', 'outlet_code', 'outlet_name', 'agendacontroltype', 'agendname', 'stownname', 'dcr_date', 'dcr_status', 'nca_comments', 'planned', 'managers_name', 'brands_detailed_name', 'ed_duration', 'submission_date', 'emp_territory', 'emp_branch', 'emp_town', 'customer_town', 'customer_patch', 'leave_taken'];
        $this->addDataToFile($columns);

        $data = ExportDcrQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\OnDemandFormatter')
            ->where('DATE(export_dcr.datetime) >= ? ', $startDate)
            ->where('DATE(export_dcr.datetime) < ? ', $endDate)
            ->find();

        foreach ($data as $key => $row) {
            $row = $row->toArray();
            $this->checkManagersAccordingsToPosition($row);
            $this->addDataToFile(array_values($row));
        }

        return true;
    }

    private function exportPobDailyData($startDate, $endDate)
    {
        $columns = ['bu_name', 'zm_manager_branch', 'zm_manager_town', 'rm_manager_branch', 'rm_manager_town', 'am_manager_branch', 'am_manager_town', 'zm_position_code', 'rm_position_code', 'am_position_code', 'emp_position_code', 'emp_position_name', 'emp_level', 'employee_code', 'employee', 'designation', 'from_outlet_type', 'from_outlet_code', 'from_outlet_name', 'from_outlet_classification', 'to_outlet_type', 'to_outlet_code', 'to_outlet_name', 'to_outlet_classification', 'product_name', 'product_sku', 'rate', 'qty', 'total_amt', 'order_date', 'emp_territory', 'emp_branch', 'emp_town'];
        $this->addDataToFile($columns);

        $data = ExportPobQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\OnDemandFormatter')
            ->where('DATE(export_pob.order_date) >= ? ', $startDate)
            ->where('DATE(export_pob.order_date) < ? ', $endDate)
            ->find();

        foreach ($data as $key => $row) {
            $row = $row->toArray();
            $this->checkManagersAccordingsToPosition($row);
            $this->addDataToFile(array_values($row));
        }

        return true;
    }

    private function exportSgpiOutDailyData($startDate, $endDate)
    {
        $columns = ['sgpi_voucher_id', 'bu_name', 'zm_manager_branch', 'zm_manager_town', 'rm_manager_branch', 'rm_manager_town', 'am_manager_branch', 'am_manager_town', 'zm_position_code', 'rm_position_code', 'am_position_code', 'emp_position_code', 'emp_position_name', 'emp_level', 'employee_code', 'employee_name', 'outlet_code', 'brand_focus', 'outlet_org_id', 'org_unit_id', 'territory_id', 'territory_name', 'beat_id', 'beat_name', 'tags', 'visit_fq', 'outlet_salutation', 'outlet_name', 'classification', 'outlettype_name', 'sgpi_name', 'sgpi_code', 'material_sku', 'sgpi_type', 'sgpi_qty', 'dcr_id', 'dcr_date', 'brand_name', 'device_time', 'managers', 'submission_date', 'updated_at', 'emp_territory', 'emp_branch', 'emp_town'];
        $this->addDataToFile($columns);

        $data = ExportSgpiOutQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\OnDemandFormatter')
            ->where('DATE(export_sgpi_out.created_at) >= ? ', $startDate)
            ->where('DATE(export_sgpi_out.created_at) < ? ', $endDate)
            ->find();

        foreach ($data as $key => $row) {
            $row = $row->toArray();
            $this->checkManagersAccordingsToPosition($row);
            $this->addDataToFile(array_values($row));
        }

        return true;
    }

    private function exportRCPASummaryDailyData($startDate, $endDate)
    {
        $columns = ['uniqueid', 'orgunitid', 'zm_manager_branch', 'zm_manager_town', 'rm_manager_branch', 'rm_manager_town', 'am_manager_branch', 'am_manager_town', 'zm_position_code', 'rm_position_code', 'am_position_code', 'emp_position_code', 'emp_position_name', 'emp_level', 'employee_code', 'emp_name', 'drcode', 'drname', 'retailercode', 'retailername', 'outlet_classification', 'visit_fq', 'territory', 'tags', 'rcpa_moye', 'brand_name', 'competitor_name', 'rcpa_qty', 'own_rate', 'competitor_rate', 'potential', 'own', 'competition', 'submission_date', 'updated_at', 'min_value', 'emp_territory', 'emp_branch', 'emp_town'];
        $this->addDataToFile($columns);

        $data = ExportRcpaSummaryQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\OnDemandFormatter')
            ->where('DATE(export_rcpa_summary.created_at) >= ? ', $startDate)
            ->where('DATE(export_rcpa_summary.created_at) < ? ', $endDate)
            ->find();

        foreach ($data as $key => $row) {
            $row = $row->toArray();
            $this->checkManagersAccordingsToPosition($row);
            $this->addDataToFile(array_values($row));
        }

        return true;
    }

    public function exportRCPASummaryDailyDataSKU($startDate, $endDate)
    {
        $columns = ['uniqueid', 'orgunitid', 'zm_manager_branch', 'zm_manager_town', 'rm_manager_branch', 'rm_manager_town', 'am_manager_branch', 'am_manager_town', 'zm_position_code', 'rm_position_code', 'am_position_code', 'emp_position_code', 'emp_position_name', 'emp_level', 'employee_code', 'emp_name', 'drcode', 'drname', 'retailercode', 'retailername', 'outlet_classification', 'visit_fq', 'territory', 'tags', 'rcpa_moye', 'brand_name', 'ProductSku', 'ProductName', 'competitor_name', 'rcpa_qty', 'base_rate', 'competitor_rate', 'potential', 'own', 'competition', 'submission_date', 'updated_at', 'min_value', 'emp_territory', 'emp_branch', 'emp_town'];
        $this->addDataToFile($columns);

        $data = ExportRcpaSkuSummaryQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\OnDemandFormatter')
            ->where('DATE(export_rcpa_sku_summary.created_at) >= ? ', $startDate)
            ->where('DATE(export_rcpa_sku_summary.created_at) < ? ', $endDate)
            ->find();

        foreach ($data as $key => $row) {
            $row = $row->toArray();
            $this->checkManagersAccordingsToPosition($row);
            $this->addDataToFile(array_values($row));
        }

        return true;
    }

    private function exportEDetailingDailyData($startDate, $endDate)
    {
        $columns = ['bu_name', 'zm_manager_branch', 'zm_manager_town', 'rm_manager_branch', 'rm_manager_town', 'am_manager_branch', 'am_manager_town', 'zm_position_code', 'rm_position_code', 'am_position_code', 'emp_position_code', 'emp_position_name', 'emp_level', 'employee_code', 'employee', 'device_start_time', 'device_end_time', 'outlet_type', 'outlet_code', 'outlet_name', 'outlet_classification', 'brand_name', 'session_id', 'brand_order', 'presentation_order', 'presentation', 'playlist', 'page_count', 'presentation_time', 'page_name', 'smiley', 'ed_date', 'submission_date', 'updated_at', 'emp_territory', 'emp_branch', 'emp_town'];
        $this->addDataToFile($columns);

        $data = ExportEdetailingQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\OnDemandFormatter')
            ->where('DATE(export_edetailing.created_at) >= ? ', $startDate)
            ->where('DATE(export_edetailing.created_at) < ? ', $endDate)
            ->orderByEdDate()
            ->orderByOutletCode()
            ->orderBySessionId()
            ->orderBy("PresentationOrder")
            ->find();

        $outletCode = '';
        $session_id = '';
        $brand_id = '';
        $edDate = '';
        $brand_index = $presentation_index = 0;
        $brandArray = [];
        foreach ($data as $key => $row) {
            $row = $row->toArray();
            $timeDiff = $this->getTimeDiffInSec($row['DeviceStartTime'], $row['DeviceEndTime']);
            $row['PresentationTime'] = $timeDiff;

            if ($outletCode != $row['OutletCode'] || $edDate != $row['EdDate']) {
                // Reset
                $brandArray = [];
                $brand_index = $presentation_index = 1;
                $outletCode = $row['OutletCode'];
                $session_id = $row['SessionId'];
                $brand_id = $row['BrandId'];
                $edDate = $row['EdDate'];

                array_push($brandArray, $brand_id);
                $brand_index = array_search($brand_id, $brandArray) + 1;
            } elseif ($session_id != $row['SessionId']) {

                $presentation_index = 1;
                $brand_id = $row['BrandId'];
                $session_id = $row['SessionId'];
                $brandArray = [];
                array_push($brandArray, $brand_id);
                $brand_index = array_search($brand_id, $brandArray) + 1;
            } elseif ($brand_id != $row['BrandId']) {
                $brand_index++;
                $presentation_index = 1;
                $brand_id = $row['BrandId'];
                if (!in_array($brand_id, $brandArray)) {
                    array_push($brandArray, $brand_id);
                }
                $brand_index = array_search($brand_id, $brandArray) + 1;
            } else {
                $presentation_index++;
            }

            $row['BrandId'] = $brand_index;
            $row['PresentationOrder'] = $presentation_index;

            $this->checkManagersAccordingsToPosition($row);
            $this->addDataToFile(array_values($row));
        }

        return true;
    }

    private function checkManagersAccordingsToPosition(&$row)
    {
        $zmManagerBranch = '';
        $zmManagerTown = '';
        $zmPositionCode = '';
        $rmManagerBranch = '';
        $rmManagerTown = '';
        $rmPositionCode = '';
        $amManagerBranch = '';
        $amManagerTown = '';
        $amPositionCode = '';

        if (!empty($row['AmPositionCode']) && str_starts_with($row['AmPositionCode'], '4')) {
            $zmManagerBranch = $row['AmManagerBranch'];
            $zmManagerTown = $row['AmManagerTown'];
            $zmPositionCode = $row['AmPositionCode'];
        } elseif (!empty($row['AmPositionCode']) && str_starts_with($row['AmPositionCode'], '3')) {
            $rmManagerBranch = $row['AmManagerBranch'];
            $rmManagerTown = $row['AmManagerTown'];
            $rmPositionCode = $row['AmPositionCode'];
        } elseif (!empty($row['AmPositionCode']) && str_starts_with($row['AmPositionCode'], '2')) {
            $amManagerBranch = $row['AmManagerBranch'];
            $amManagerTown = $row['AmManagerTown'];
            $amPositionCode = $row['AmPositionCode'];
        }

        if (!empty($row['RmPositionCode']) && str_starts_with($row['RmPositionCode'], '4')) {
            $zmManagerBranch = $row['RmManagerBranch'];
            $zmManagerTown = $row['RmManagerTown'];
            $zmPositionCode = $row['RmPositionCode'];
        } elseif (!empty($row['RmPositionCode']) && str_starts_with($row['RmPositionCode'], '3')) {
            $rmManagerBranch = $row['RmManagerBranch'];
            $rmManagerTown = $row['RmManagerTown'];
            $rmPositionCode = $row['RmPositionCode'];
        }

        if (!empty($row['ZmPositionCode']) && str_starts_with($row['ZmPositionCode'], '4')) {
            $zmManagerBranch = $row['ZmManagerBranch'];
            $zmManagerTown = $row['ZmManagerTown'];
            $zmPositionCode = $row['ZmPositionCode'];
        }

        /*
        if (!empty($row['EmpPositionCode']) && str_starts_with($row['EmpPositionCode'], '4')) {
            $zmManagerBranch = $row['EmpBranch'];
            $zmManagerTown = $row['EmpTown'];
            $zmPositionCode = $row['EmpPositionCode'];
        } elseif (!empty($row['EmpPositionCode']) && str_starts_with($row['EmpPositionCode'], '3')) {
            $rmManagerBranch = $row['EmpBranch'];
            $rmManagerTown = $row['EmpTown'];
            $rmPositionCode = $row['EmpPositionCode'];
        } elseif (!empty($row['EmpPositionCode']) && str_starts_with($row['EmpPositionCode'], '2')) {
            $amManagerBranch = $row['EmpBranch'];
            $amManagerTown = $row['EmpTown'];
            $amPositionCode = $row['EmpPositionCode'];
        }
        */
        $row['ZmManagerBranch'] = $zmManagerBranch;
        $row['ZmManagerTown'] = $zmManagerTown;
        $row['ZmPositionCode'] = $zmPositionCode;
        $row['RmManagerBranch'] = $rmManagerBranch;
        $row['RmManagerTown'] = $rmManagerTown;
        $row['RmPositionCode'] = $rmPositionCode;
        $row['AmManagerBranch'] = $amManagerBranch;
        $row['AmManagerTown'] = $amManagerTown;
        $row['AmPositionCode'] = $amPositionCode;

        return $row;
    }

    private function getTimeDiffInSec($startTime, $endTime)
    {
        return strtotime($endTime) - strtotime($startTime);
    }

    private function exportDVPReportForWidgetDailyData($startDate, $endDate)
    {
        $columns = ['OrgUnit', 'EmployeeCode', 'JoiningDate', 'AM Position', 'RM Position', 'ZM Position', 'Location', 'Status', 'EmployeeName', 'DoctorName', 'DoctorCode', 'Town', 'Patch', 'Speciality', 'Tags', 'VisitFq', 'PrescriberClassification', 'TopBrand', 'MR Visits', 'AM Visits', 'RM Visits', 'ZM Visits', 'RcpaDone', 'RCPA-LM-OWN', 'RCPA-LM-COMP', 'RCPA-CM-OWN', 'RCPA-CM-COMP', 'Samples SGPI', 'Gifts SGPI', 'Promo SGPI', 'ZM Position Code', 'RM Position Code', 'AM Position Code', 'Emp Position Code', 'Emp Position', 'Emp Level', 'Month', 'MR Detailing'];
        $this->addDataToFile($columns);

        // Get all data
        $moye = date('m-Y', strtotime($startDate));

        $data = $this->dvpReportDump($moye);

        $wdvp = new WriteData();
        $wdvp->writeDvp($data);

        foreach ($data as $key => $row) {
            // convert into an array, please comment if not required
            // $row = $row->toArray();

            $this->addDataToFile(array_values($row));
        }

        return true;
    }

    private function exportDARReportForWidgetDailyData($startDate, $endDate)
    {
        // $columns = ['EmployeeName', 'EmployeeCode', 'OrgUnitName', 'ReportingTo', 'Date', 'Day', 'Town', 'LocationPlanned', 'Stownname', 'OutletName', 'Tags', 'Agenda', 'JointWorking', 'Planned', 'CreatedAt', 'SgpiOut', 'Brands', 'PobTotal', 'Potential', 'Contribution', 'Edetailing', 'Sgpi'];
        $columns = ['bu_name', 'zm_manager_branch', 'zm_manager_town', 'rm_manager_branch', 'rm_manager_town', 'am_manager_branch', 'am_manager_town', 'zm_position_code', 'rm_position_code', 'am_position_code', 'emp_position_code', 'emp_position_name', 'emp_level', 'employee_code', 'employee', 'jw_employee_code', 'jw_employee', 'jw_position_name', 'outlet_type', 'outlet_code', 'outlet_name', 'agendacontroltype', 'agendname', 'stownname', 'dcr_date', 'dcr_status', 'nca_comments', 'planned', 'managers_name', 'brands_detailed_name', 'ed_duration', 'submission_date', 'emp_territory', 'emp_branch', 'emp_town', 'customer_town', 'customer_patch', 'leave_taken', 'is_JW', 'sgpi_out', 'pob_total', 'potential', 'contribution'];
        $this->addDataToFile($columns);

        $data = ExportDarQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\OnDemandFormatter')
            ->where('DATE(export_dar.datetime) >= ? ', $startDate)
            ->where('DATE(export_dar.datetime) < ? ', $endDate)
            ->find();

        foreach ($data as $key => $row) {
            $row = $row->toArray();
            $this->checkManagersAccordingsToPosition($row);

            $outConPo = \entities\OutletContributionPotentialQuery::create()
                ->filterByOutletId($row['OutletId'])
                ->filterByRcpaMoye(date('m-Y', strtotime($startDate)))
                ->findOne();

            if (isset($outConPo) != null && $outConPo->getPotentialValue() != null && $outConPo->getContributionValue() != null) {
                $row['potential'] = $outConPo->getPotentialValue();
                $row['contribution'] = $outConPo->getContributionValue();
            } else {
                $row['potential'] = 0;
                $row['contribution'] = 0;
            }

            unset($row['DcrId']);
            unset($row['UpdatedAt']);
            unset($row['OutletId']);

            $this->addDataToFile(array_values($row));
        }

        // Get all data - pass date
        // $data = $this->darReportDump($startDate);

        return true;
    }

    private function exportSGPIReportForWidgetDailyData($startDate, $endDate, $orgunitId)
    {
        $columns = ['Division', 'EmpId', 'EmpName', 'Location', 'Emp Code', 'DrCode', 'DrName', 'DrSpecialty', 'Month', 'DRTags', 'Brand', 'SGPITagged', 'BrandSGPIDistributed', 'MRCallDone', 'AMCallDone', 'RMCallDone', 'ZMCallDone', 'ZM Position', 'RM Position', 'AM Position', 'ZM PositionCode', 'RM PositionCode', 'AM PositionCode', 'Emp PositionCode', 'Emp PositionName', 'Emp Level'];
        $this->addDataToFile($columns);

        // Get all data
        $moye = date('m-Y', strtotime($startDate));

        $data = $this->sgpiBrandWiseDistributionDump($moye, $orgunitId);

        $wsgpi = new WriteData();
        $wsgpi->writeSgpi($data);

        foreach ($data as $key => $row) {
            // convert into an array, please comment if not required
            // $row = $row->toArray();

            $this->addDataToFile(array_values($row));
        }

        return true;
    }

    private function exportMASReportForWidgetDailyData($startDate, $endDate)
    {
        $columns = ['OrgName', 'REPCODE', 'EmployeeCode', 'EmployeeName', 'AM Position', 'RM Position', 'ZM Position', 'Location', 'MonthYear', 'WorkingDays', 'FWD', 'NCA', 'TotalDoctors', 'DrMet', 'DrVfMet', 'DRCA-L', 'DRCVRG%', 'DRVFCVRG%', 'MISSEDDR', 'MISSEDDRCALLS', 'TOTALCHEMIST', 'POBValue', 'RCPAvalueforownbrand', 'RCPAvalueforCompbrand', 'JOINTWORKTotalCalls', 'LEAVEDAYS', 'JoinWorking', 'NoDrCall', 'Agenda', 'ZM Position Code', 'RM Position Code', 'AM Position Code', 'EmpStatus', 'EmpPositionCode', 'EmpPositionName', 'EmpLevel', 'Chemists Met', 'Chemists Calls', 'Chemist Call Average', 'Total Stockists', 'Dr Addition', 'Dr Deletion'];
        $this->addDataToFile($columns);

        // Get all data
        $moye = date('m-Y', strtotime($startDate));

        $data = $this->masReportDump($moye);

        $wmas = new WriteData();
        $wmas->writeMas($data);

        foreach ($data as $key => $row) {
            // convert into an array, please comment if not required
            // $row = $row->toArray();

            $this->addDataToFile(array_values($row));
        }

        return true;
    }

    private function exportExpenseStatusData($startDate, $endDate)
    {
        $columns = ['bu_name', 'zm_position_code', 'zm_position_name', 'rm_position_code', 'rm_position_name', 'am_position_code', 'am_position_name', 'emp_position_code', 'emp_position_name', 'emp_level', 'employee_id', 'employee_code', 'employee_name', 'reporting_to_employee_name', 'reporting_to_employee_code', 'emp_town', 'emp_branch', 'designation', 'grade', 'status', 'month', 'requested_amount', 'approved_amount', 'final_amount', 'expense_status', 'total_expenses', 'expense_dates', 'expense_not_generated_dates', 'last_submitted_date', 'last_approved_date', 'last_audited_date', 'paid_status', 'lot_no', 'transaction_id', 'paid_amount', 'remark'];
        $this->addDataToFile($columns);

        $moye = date('m-Y', strtotime($startDate));

        $data = ExportExpenseStatusViewQuery::create()
                    ->where('export_expense_status_view.month = ?', date('Y-m-01', strtotime($startDate)))
                    ->orderByEmployeeId()
                    ->find()
                    ->toArray();

        foreach($data as $row) {
            $position = \entities\PositionsQuery::create()->findPk($row['PositionId']);
            $level1PositionName = $level2PositionName = $level3PositionName = "";
            $level1PositionCode = $level2PositionCode = $level3PositionCode = "";
            $lastAuditedDate = $lastApprovedDate = $lastSubmittedDate = "";
            $employeePayment = $this->getExpensePaymentRecordByEmployeeIdFromArray($row['EmployeeId'], $moye);

            if(!empty($position)) {
                $managers = $position->getCavPositionsUp();

                if ($managers != null) {
                    $managerPositionIds = explode(",", $managers);
                } else {
                    $managerPositionIds = null;
                }

                $managerPositions = \entities\PositionsQuery::create()
                                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                                        ->filterByPositionId($managerPositionIds)
                                        ->find()->toArray();

                // set Positions
                foreach ($managerPositions as $managerPosition) {
                    if (str_starts_with($managerPosition['PositionCode'], '4')) {
                        $level1PositionName = $managerPosition["PositionName"];
                        $level1PositionCode = $managerPosition["PositionCode"];
                    } elseif (str_starts_with($managerPosition['PositionCode'], '3')) {
                        $level2PositionName = $managerPosition["PositionName"];
                        $level2PositionCode = $managerPosition["PositionCode"];
                    } elseif (str_starts_with($managerPosition['PositionCode'], '2')) {
                        $level3PositionName = $managerPosition["PositionName"];
                        $level3PositionCode = $managerPosition["PositionCode"];
                    }
                }
            }

            if($row['ExpenseStatus'] == 'Created') {
                $row['ExpenseStatus'] = 'Draft';
            } elseif($row['ExpenseStatus'] == 'Submit') {
                $row['ExpenseStatus'] = 'Submitted';
            } elseif($row['ExpenseStatus'] == 'Approved') {
                $row['ExpenseStatus'] = 'Workflow';
            } elseif($row['ExpenseStatus'] == 'Proceed for Payment') {
                $row['ExpenseStatus'] = 'Proceed for Payment';
            }

            $attendanceDates = '';
            if($row['ExpenseStatus'] == 'Draft') {
                $monthNumber = explode('-', $moye);
                $dt = \DateTime::createFromFormat('Y-m', $monthNumber[1] . '-' . $monthNumber[0]);
                $startDate = $dt->format('Y-m-01');
                $endDate = $dt->format('Y-m-t');

                $attendances = AttendanceQuery::create()
                                ->select(['AttendanceDate'])
                                ->filterByAttendanceDate($startDate, Criteria::GREATER_EQUAL)
                                ->filterByAttendanceDate($endDate, Criteria::LESS_EQUAL)
                                ->filterByEmployeeId($row['EmployeeId'])
                                ->filterByStatus(1)
                                ->filterByExpenseId(null, Criteria::NOT_EQUAL)
                                ->find()
                                ->toArray();
                
                if(!empty($attendances)) {
                    $attendanceDates = implode(', ', $attendances);
                    $row['ExpenseStatus'] = 'Expense not available';
                }
            }

            $startofMonth = date('Y-m-01', strtotime($startDate));
            $endofMonth = date('Y-m-t', strtotime($startDate));
            $lastDates = $this->getExpenseLastDates($row['EmployeeId'], $startofMonth, $endofMonth);
            $lastAuditedDate = $lastDates['LastAuditedDate'];
            $lastApprovedDate = $lastDates['LastApprovedDate'];
            $lastSubmittedDate = $lastDates['LastSubmittedDate'];
            $paidStatus = isset($employeePayment['PaidStatus']) ? $employeePayment['PaidStatus'] : '';
            $lotNo = isset($employeePayment['LotNo']) ? $employeePayment['LotNo'] : '';
            $transactionId = isset($employeePayment['TransactionId']) ? $employeePayment['TransactionId'] : '';
            $paidAmount = isset($employeePayment['PaidAmount']) ? $employeePayment['PaidAmount'] : '';
            $remark = isset($employeePayment['Remark']) ? $employeePayment['Remark'] : '';

            $tempRow = [
                $row['BuName'],
                $level1PositionCode,
                $level1PositionName,
                $level2PositionCode,
                $level2PositionName,
                $level3PositionCode,
                $level3PositionName,
                $row['EmpPositionCode'],
                $row['EmpPositionName'],
                $row['EmpLevel'],
                $row['EmployeeId'],
                $row['EmployeeCode'],
                $row['EmployeeName'],
                $row['ReportingToEmployeeName'],
                $row['ReportingToEmployeeCode'],
                $row['EmpTown'],
                $row['EmpBranch'],
                $row['Designation'],
                $row['Grade'],
                $row['Status'],
                date('m-Y', strtotime($row['Month'])),
                round(floatval($row['RequestedAmount'])),
                round(floatval($row['ApprovedAmount'])),
                round(floatval($row['FinalAmount'])),
                $row['ExpenseStatus'],
                $row['TotalExpenses'],
                $row['ExpenseDates'],
                $attendanceDates,
                $lastSubmittedDate,
                $lastApprovedDate,
                $lastAuditedDate,
                $paidStatus,
                $lotNo,
                $transactionId,
                $paidAmount,
                $remark
            ];

            $this->addDataToFile($tempRow);

            unset($tempRow);
        }
    }

    private function exportExpenseSummaryData($startDate, $endDate)
    {
        $columns = ['bu_name', 'zm_position_code', 'zm_position_name', 'rm_position_code', 'rm_position_name', 'am_position_code', 'am_position_name', 'emp_position_code', 'emp_position_name', 'emp_level', 'employee_id', 'employee_code', 'employee_name', 'reporting_to_employee_name', 'reporting_to_employee_code', 'emp_town', 'emp_branch', 'designation', 'grade', 'status', 'expense_unique_id', 'month', 'requested_da_hq_amount', 'requested_da_ex_hq_amount', 'requested_da_os_amount', 'requested_da_transit_amount', 'requested_da_last_day_os_amount', 'requested_ta_amount', 'requested_internet_bill_amount', 'requested_os_petrol_allowance_amount', 'requested_isbt_amount', 'requested_hill_allowance_amount', 'requested_ilp_amount', 'requested_mr_conveyance_amount', 'requested_am_conveyance_amount', 'requested_rm_lodging_and_food_amount', 'requested_handset_amount', 'requested_hq_petrol_allowance_amount', 'requested_zm_lodging_and_food_amount', 'requested_rm_mobile_bill_amount', 'requested_zm_local_conveyance_amount', 'requested_rm_local_conveyance_amount', 'requested_zm_mobile_bill_amount', 'requested_stationery_amount', 'requested_event_amount', 'requested_own_stay_amount', 'requested_other_zm_local_conveyance_amount', 'requested_other_os_petrol_allowance_amount', 'requested_other_rm_local_conveyance_amount', 'total_requested_amount', 'final_da_hq_amount', 'final_da_ex_hq_amount', 'final_da_os_amount', 'final_da_transit_amount', 'final_da_last_day_os_amount', 'final_ta_amount', 'final_internet_bill_amount', 'final_os_petrol_allowance_amount', 'final_isbt_amount', 'final_hill_allowance_amount', 'final_ilp_amount', 'final_mr_conveyance_amount', 'final_am_conveyance_amount', 'final_rm_lodging_and_food_amount', 'final_handset_amount', 'final_hq_petrol_allowance_amount', 'final_zm_lodging_and_food_amount', 'final_rm_mobile_bill_amount', 'final_zm_local_conveyance_amount', 'final_rm_local_conveyance_amount', 'final_zm_mobile_bill_amount', 'final_stationery_amount', 'final_event_amount', 'final_own_stay_amount', 'final_other_zm_local_conveyance_amount', 'final_other_os_petrol_allowance_amount', 'final_other_rm_local_conveyance_amount', 'total_approved_amount', 'total_final_amount', 'expense_status', 'total_expenses', 'expense_dates', 'expense_not_generated_dates', 'last_submitted_date', 'last_approved_date', 'last_audited_date', 'paid_status', 'lot_no', 'transaction_id', 'paid_amount', 'remark'];
        $this->addDataToFile($columns);

        $moye = date('m-Y', strtotime($startDate));

        $data = ExportExpensesSummaryQuery::create()
                    ->where('export_expenses_summary.month = ?', date('Y-m-01', strtotime($startDate)))
                    ->orderByEmployeeId()
                    ->find()
                    ->toArray();
        
        foreach($data as $row) {
            $position = \entities\PositionsQuery::create()->findPk($row['PositionId']);
            $level1PositionName = $level2PositionName = $level3PositionName = "";
            $level1PositionCode = $level2PositionCode = $level3PositionCode = "";
            $lastAuditedDate = $lastApprovedDate = $lastSubmittedDate = "";
            $employeePayment = $this->getExpensePaymentRecordByEmployeeIdFromArray($row['EmployeeId'], $moye);

            if(!empty($position)) {
                $managers = $position->getCavPositionsUp();

                if ($managers != null) {
                    $managerPositionIds = explode(",", $managers);
                } else {
                    $managerPositionIds = null;
                }

                $managerPositions = \entities\PositionsQuery::create()
                                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                                        ->filterByPositionId($managerPositionIds)
                                        ->find()->toArray();

                // set Positions
                foreach ($managerPositions as $managerPosition) {
                    if (str_starts_with($managerPosition['PositionCode'], '4')) {
                        $level1PositionName = $managerPosition["PositionName"];
                        $level1PositionCode = $managerPosition["PositionCode"];
                    } elseif (str_starts_with($managerPosition['PositionCode'], '3')) {
                        $level2PositionName = $managerPosition["PositionName"];
                        $level2PositionCode = $managerPosition["PositionCode"];
                    } elseif (str_starts_with($managerPosition['PositionCode'], '2')) {
                        $level3PositionName = $managerPosition["PositionName"];
                        $level3PositionCode = $managerPosition["PositionCode"];
                    }
                }
            }

            if($row['ExpenseStatus'] == 'Created') {
                $row['ExpenseStatus'] = 'Draft';
            } elseif($row['ExpenseStatus'] == 'Submit') {
                $row['ExpenseStatus'] = 'Submitted';
            } elseif($row['ExpenseStatus'] == 'Approved') {
                $row['ExpenseStatus'] = 'Workflow';
            } elseif($row['ExpenseStatus'] == 'Proceed for Payment') {
                $row['ExpenseStatus'] = 'Proceed for Payment';
            }

            $attendanceDates = '';
            if($row['ExpenseStatus'] == 'Draft') {
                $monthNumber = explode('-', $moye);
                $dt = \DateTime::createFromFormat('Y-m', $monthNumber[1] . '-' . $monthNumber[0]);
                $startDate = $dt->format('Y-m-01');
                $endDate = $dt->format('Y-m-t');

                $attendances = AttendanceQuery::create()
                                ->select(['AttendanceDate'])
                                ->filterByAttendanceDate($startDate, Criteria::GREATER_EQUAL)
                                ->filterByAttendanceDate($endDate, Criteria::LESS_EQUAL)
                                ->filterByEmployeeId($row['EmployeeId'])
                                ->filterByStatus(1)
                                ->filterByExpenseId(null, Criteria::NOT_EQUAL)
                                ->find()
                                ->toArray();
                
                if(!empty($attendances)) {
                    $attendanceDates = implode(', ', $attendances);
                    $row['ExpenseStatus'] = 'Expense not available';
                }
            }

            $startofMonth = date('Y-m-01', strtotime($startDate));
            $endofMonth = date('Y-m-t', strtotime($startDate));
            $lastDates = $this->getExpenseLastDates($row['EmployeeId'], $startofMonth, $endofMonth);
            $lastAuditedDate = $lastDates['LastAuditedDate'];
            $lastApprovedDate = $lastDates['LastApprovedDate'];
            $lastSubmittedDate = $lastDates['LastSubmittedDate'];
            $paidStatus = isset($employeePayment['PaidStatus']) ? $employeePayment['PaidStatus'] : '';
            $lotNo = isset($employeePayment['LotNo']) ? $employeePayment['LotNo'] : '';
            $transactionId = isset($employeePayment['TransactionId']) ? $employeePayment['TransactionId'] : '';
            $paidAmount = isset($employeePayment['PaidAmount']) ? $employeePayment['PaidAmount'] : '';
            $remark = isset($employeePayment['Remark']) ? $employeePayment['Remark'] : '';

            $tempRow = [
                $row['BuName'],
                $level1PositionCode,
                $level1PositionName,
                $level2PositionCode,
                $level2PositionName,
                $level3PositionCode,
                $level3PositionName,
                $row['EmpPositionCode'],
                $row['EmpPositionName'],
                $row['EmpLevel'],
                $row['EmployeeId'],
                $row['EmployeeCode'],
                $row['EmployeeName'],
                $row['ReportingToEmployeeName'],
                $row['ReportingToEmployeeCode'],
                $row['EmpTown'],
                $row['EmpBranch'],
                $row['Designation'],
                $row['Grade'],
                $row['Status'],
                $row['Uniqueid'],
                date('m-Y', strtotime($row['Month'])),
                round(floatval($row['RequestedDaHqAmount'])),
                round(floatval($row['RequestedDaExHqAmount'])),
                round(floatval($row['RequestedDaOsAmount'])),
                round(floatval($row['RequestedAaTransitAmount'])),
                round(floatval($row['RequestedDaLastDayOsAmount'])),
                round(floatval($row['RequestedTaAmount'])),
                round(floatval($row['RequestedInternetBillAmount'])),
                round(floatval($row['RequestedOsPetrolAllowanceAmount'])),
                round(floatval($row['RequestedIsbtAmount'])),
                round(floatval($row['RequestedHillAllowanceAmount'])),
                round(floatval($row['RequestedIlpAmount'])),
                round(floatval($row['RequestedMrConveyanceAmount'])),
                round(floatval($row['RequestedAmConveyanceAmount'])),
                round(floatval($row['RequestedRmLodgingAndFoodAmount'])),
                round(floatval($row['RequestedHandsetAmount'])),
                round(floatval($row['RequestedHqPetrolAllowanceAmount'])),
                round(floatval($row['RequestedZmLodgingAndFoodAmount'])),
                round(floatval($row['RequestedRmMobileBillAmount'])),
                round(floatval($row['RequestedZmLocalConveyanceAmount'])),
                round(floatval($row['RequestedRmLocalConveyanceAmount'])),
                round(floatval($row['RequestedZmMobileBillAmount'])),
                round(floatval($row['RequestedStationeryAmount'])),
                round(floatval($row['RequestedEventAmount'])),
                round(floatval($row['RequestedOwnStayAmount'])),
                round(floatval($row['RequestedOtherZmLocalConveyanceAmount'])),
                round(floatval($row['RequestedOtherOsPetrolAllowanceAmount'])),
                round(floatval($row['RequestedOtherRmLocalConveyanceAmount'])),
                round(floatval($row['RequestedAmount'])),
                round(floatval($row['FinalDaHqAmount'])),
                round(floatval($row['FinalDaExHqAmount'])),
                round(floatval($row['FinalDaOsAmount'])),
                round(floatval($row['FinalDaTransitAmount'])),
                round(floatval($row['FinalDaLastDayOsAmount'])),
                round(floatval($row['FinalTaAmount'])),
                round(floatval($row['FinalInternetBillAmount'])),
                round(floatval($row['FinalOsPetrolAllowanceAmount'])),
                round(floatval($row['FinalIsbtAmount'])),
                round(floatval($row['FinalHillAllowanceAmount'])),
                round(floatval($row['FinalIlpAmount'])),
                round(floatval($row['FinalMrConveyanceAmount'])),
                round(floatval($row['FinalAmConveyanceAmount'])),
                round(floatval($row['FinalRmLodgingAndFoodAmount'])),
                round(floatval($row['FinalHandsetAmount'])),
                round(floatval($row['FinalHqPetrolAllowanceAmount'])),
                round(floatval($row['FinalZmLodgingAndFoodAmount'])),
                round(floatval($row['FinalRmMobileBillAmount'])),
                round(floatval($row['FinalZmLocalConveyanceAmount'])),
                round(floatval($row['FinalRmLocalConveyanceAmount'])),
                round(floatval($row['FinalZmMobileBillAmount'])),
                round(floatval($row['FinalStationeryAmount'])),
                round(floatval($row['FinalEventAmount'])),
                round(floatval($row['Final_own_stay_amount'])),
                round(floatval($row['FinalOtherZmLocalConveyanceAmount'])),
                round(floatval($row['FinalOtherOsPetrolAllowanceAmount'])),
                round(floatval($row['FinalOtherRmLocalConveyanceAmount'])),
                round(floatval($row['ApprovedAmount'])),
                round(floatval($row['FinalAmount'])),
                $row['ExpenseStatus'],
                $row['TotalExpenses'],
                $row['ExpenseDates'],
                $attendanceDates,
                $lastSubmittedDate,
                $lastApprovedDate,
                $lastAuditedDate,
                $paidStatus,
                $lotNo,
                $transactionId,
                $paidAmount,
                $remark
            ];

            $this->addDataToFile($tempRow);

            unset($tempRow);
        }
    }

    private function exportLeaveEnhancementData($startDate, $endDate) {
        $employees = EmployeeQuery::create()->filterByCompanyId($this->company_id)->filterByStatus(1)->filterByOrgUnitId(60, Criteria::NOT_EQUAL)->orderByOrgUnitId()->find();
        $empLeaves = EmployeeLeaveBalanceQuery::create()->find()->toKeyValue("Uniquecode","Balance");

        // $columns = ['EmployeeId', 'EmployeeCode', 'FirstName', 'LastName', 'Status', 'OrgUnitId', 'UnitName', 'PositionName', 'PositionCode', 'Designation', 'Branch', 'Grade', 'Town', 'currentPL', 'currentSL', 'currentCL', 'nextYearPL', 'nextYearSL', 'nextYearCL', 'totalPL', 'totalSL', 'totalCL'];
        $columns = ['EmployeeId', 'EmployeeCode', 'FirstName', 'LastName', 'Status', 'OrgUnitId', 'UnitName', 'PositionName', 'PositionCode', 'Designation', 'Branch', 'Grade', 'Town', 'Joining Date', 'Confirmation Date', 'PL Closing', 'SL Closing', 'CL Closing', 'PL Lapse', 'PL Entitled', 'SL Entitled', 'CL Entitled', 'total PL', 'total SL', 'total CL', 'basedOnWorkingDays', 'isDataAvailableIntoSheet', 'dishaWorkingDays', 'otherWorkingDays', 'totalWorkingDays'];
        $this->addDataToFile($columns);

        echo "Total Employees : " . $employees->count() . PHP_EOL;

        $workingDays = [];
        // $workingDays = $this->getPLWorkingDays();
        // print_r($workingDays);exit;
        
        foreach ($employees as $key => $employee) {
            $position = $employee->getPositionsRelatedByPositionId();
            $orgUnit = $employee->getOrgUnit();
            $currentPL = isset($empLeaves[$employee->getEmployeeId() . '/PL']) ? $empLeaves[$employee->getEmployeeId() . '/PL'] : 0;
            $currentSL = isset($empLeaves[$employee->getEmployeeId() . '/SL']) ? $empLeaves[$employee->getEmployeeId() . '/SL'] : 0;
            // $currentCL = isset($empLeaves[$employee->getEmployeeId() . '/CL']) ? $empLeaves[$employee->getEmployeeId() . '/CL'] : 0;
            $currentCL = 0;

            $nextYearPL = 0;
            $nextYearSL = 0;
            $nextYearCL = 0;

            $basedOnWorkingDays = 'No';
            $isDataAvailableIntoSheet = $dishaWorkingDays = $otherWorkingDays = $totalWorkingDays = '';
            $hrDate = $employee->getHrUserDatess()->getFirst();
            $joinDate = !empty($hrDate) && $hrDate->getJoinDate() ? $hrDate->getJoinDate() : '';
            $confirmationDate = !empty($hrDate) && $hrDate->getConfirmationDate() ? $hrDate->getConfirmationDate() : '';

            if (str_starts_with($position->getPositionCode(), '4') && !empty($confirmationDate) && !empty($joinDate)) {
                $level = 'ZM';
                if(in_array($employee->getOrgUnitId(), [40,41,44])) {
                    $nextYearPL = 21;
                    $nextYearSL = 7;
                    $nextYearCL = 7;
                } else {
                    $nextYearPL = 21;
                    $nextYearSL = 7;
                    $nextYearCL = 7;
                }
            } elseif (str_starts_with($position->getPositionCode(), '3') && !empty($confirmationDate) && !empty($joinDate)) {
                $level = 'RM';
                if(in_array($employee->getOrgUnitId(), [40,41,44])) {
                    $nextYearPL = 21;
                    $nextYearSL = 7;
                    $nextYearCL = 7;
                } else {
                    $nextYearPL = 21;
                    $nextYearSL = 7;
                    $nextYearCL = 7;
                }
            } elseif (str_starts_with($position->getPositionCode(), '2') && !empty($confirmationDate) && !empty($joinDate)) {
                $level = 'AM';
                if(in_array($employee->getOrgUnitId(), [40,41,44])) {
                    $nextYearPL = 21;
                    $nextYearSL = 7;
                    $nextYearCL = 7;
                } else {
                    $nextYearPL = 21;
                    $nextYearSL = 7;
                    $nextYearCL = 7;
                }
            } elseif (str_starts_with($position->getPositionCode(), '1') && !empty($confirmationDate) && !empty($joinDate)) {
                $level = 'MR';
                if(in_array($employee->getOrgUnitId(), [34,38,35,50,37,59,42,45])) {
                    $basedOnWorkingDays = 'Yes';
                    $isDataAvailableIntoSheet = isset($workingDays[$employee->getEmployeeCode()]) ? 'Yes' : 'No';
                    $empWorkingDays = $isDataAvailableIntoSheet == 'Yes' ? $workingDays[$employee->getEmployeeCode()] : ['disha_working' => 0,  'other_working' => 0,  'total' => 0];
                    $dishaWorkingDays = $empWorkingDays['disha_working'];
                    $otherWorkingDays = $empWorkingDays['other_working'];
                    $totalWorkingDays = $empWorkingDays['total'];
                    $nextYearPL = round($totalWorkingDays / 11);
                    $nextYearSL = 10;
                    $nextYearCL = 15;
                } elseif(in_array($employee->getOrgUnitId(), [36,39,43])) {
                    $nextYearPL = 25;
                    $nextYearSL = 7;
                    $nextYearCL = 15;
                } elseif(in_array($employee->getOrgUnitId(), [40,41,44])) {
                    $nextYearPL = 21;
                    $nextYearSL = 7;
                    $nextYearCL = 7;
                }
            } else {
                if(empty($joinDate)) {
                } else {
                    continue;
                }
            }

            if(!empty($joinDate) && $joinDate >= '2023-01-01') {
                $calMonths = 12 - date('n', strtotime($joinDate->format('Y-m-d')));
                if(date('d', strtotime($joinDate->format('Y-m-d'))) < 15) {
                    $calMonths = $calMonths + 1;
                }
                
                $nextYearPL = round($nextYearPL / 12 * $calMonths);
                $nextYearCL = round($nextYearCL / 12 * $calMonths);
                $nextYearSL = round($nextYearSL / 12 * $calMonths);
            }

            $data = [
                $employee->getEmployeeId(),
                $employee->getEmployeeCode(),
                $employee->getFirstName(),
                $employee->getLastName(),
                $employee->getStatus(),
                $employee->getOrgUnitId(),
                $orgUnit->getUnitName(),
                $position->getPositionName(),
                $position->getPositionCode(),
                $employee->getDesignations()->getDesignation(),
                $employee->getBranch()->getBranchname(),
                $employee->getGradeMaster()->getGradeName(),
                !empty($employee->getGeoTowns()) ? $employee->getGeoTowns()->getStownname() : '',
                !empty($joinDate) ? $joinDate->format('Y-m-d') : '',
                !empty($confirmationDate) ? $confirmationDate->format('Y-m-d') : '',
                $currentPL,
                $currentSL,
                $currentCL,
                '',
                $nextYearPL,
                $nextYearSL,
                $nextYearCL,
                ($currentPL + $nextYearPL),
                ($currentSL + $nextYearSL),
                ($currentCL + $nextYearCL),
                $basedOnWorkingDays,
                $isDataAvailableIntoSheet,
                $dishaWorkingDays,
                $otherWorkingDays,
                $totalWorkingDays
            ];

            $this->addDataToFile($data);

            echo "Record Processed : " . $key . PHP_EOL;
        }

        return true;
    }

    private function exportFNFReport($startDate, $endDate) {
        $columns = ['EMP_DIV', 'EMP_CODE', 'EMP_NAME', 'EMP_DESG', 'EMP_GRADE', 'EMP_HQ', 'HQ_CODE', 'EMP_DOJ', 'EMP_CONFIRMATION_DT', 'EMP_SEPARATION_DT', 'LAST_DCR_DATE', 'PENDING_DAR_PREV_MONTH_COUNT', 'PENDING_DAR_PREV_MONTH_DT', 'PENDING_DAR_CURR_MONTH_COUNT', 'PENDING_DAR_CURR_MONTH_DT', 'PL_LEAVE_BAL', 'LEAVE_PENDING_FOR_APPROVAL_DT', 'LAST_EXPNS_PAID_AMT', 'LAST_EXPNS_PAID_MOYE', 'DISHA_DELETE_DT'];
        $this->addDataToFile($columns);

        $startOfMonth = date('Y-m-01', strtotime($startDate));
        $endOfMonth = date('Y-m-t', strtotime($startDate));

        $previousMonthStartDate = date('Y-m-d', strtotime($startDate . ' first day of last month'));
        $previousMonthEndDate = date('Y-m-t', strtotime($startDate . ' first day of last month'));

        // $employeeIds = HrUserDatesQuery::create()
        //                     ->select('EmployeeId')
        //                     ->filterByResignDate($startDate, Criteria::GREATER_EQUAL)
        //                     ->filterByResignDate($endDate, Criteria::LESS_THAN)
        //                     ->find()
        //                     ->toArray();
        $employeeIds = AuditTableDataQuery::create()
                            ->select('PkValue')
                            ->filterByAuditTableName('employee')
                            ->filterByAuditColumnName('status')
                            ->filterByNewValue('0')
                            ->filterByCreatedAt($startDate, Criteria::GREATER_EQUAL)
                            ->filterByCreatedAt($endDate, Criteria::LESS_THAN)
                            ->find()
                            ->toArray();
        
        $employees = EmployeeQuery::create()
                            ->filterByEmployeeId($employeeIds)
                            ->filterByStatus(0)
                            ->find();
        
        foreach($employees as $employee) {
            $orgUnit = $employee->getOrgUnit();
            $position = $employee->getPositionsRelatedByPositionId();
            $hrDate = $employee->getHrUserDatess()->getFirst();
            $joiningDate = !empty($hrDate) && $hrDate->getJoinDate() ? $hrDate->getJoinDate()->format('Y-m-d') : '';
            $resignDate = !empty($hrDate) && $hrDate->getResignDate() ? $hrDate->getResignDate()->format('Y-m-d') : '';
            $confirmationDate = !empty($hrDate) && $hrDate->getConfirmationDate() ? $hrDate->getConfirmationDate()->format('Y-m-d') : '';
            $currentMonthMissingDays = $previousMonthMissingDays = $leavesToBeApproved = [];
            $lastExpensePaidAmount = 0;
            $lastExpensePaidMonthYear = '';

            $plLeaves = EmployeeLeaveBalanceQuery::create()
                            ->select(['Balance'])
                            ->filterByEmployeeId($employee->getPrimaryKey())
                            ->filterByLeaveType('PL')
                            ->filterByLeaveYear(date('Y', strtotime($resignDate)))
                            ->findOne();
            $plLeaves = !empty($plLeaves) ? $plLeaves : 0;
            
            $lastPaidExpense = ExportExpenseStatusViewQuery::create()
                                    ->filterByEmployeeId($employee->getEmployeeId())
                                    ->filterByExpenseStatus('Proceed for Payment')
                                    ->orderByMonth(Criteria::DESC)
                                    ->findOne();
            
            if(!empty($lastPaidExpense)) {
                $lastExpensePaidAmount = (float) $lastPaidExpense->getFinalAmount();
                $lastExpensePaidMonthYear = date('m-Y', strtotime($lastPaidExpense->getMonth()));
            }

            $pendingLeaves = LeaveRequestQuery::create()
                                ->filterByEmployeeId($employee->getEmployeeId())
                                ->filterByLeaveStatus(1)
                                ->filterByCompanyId($this->company_id)
                                ->find();

            $allHolidayDates = HolidaysQuery::create()
                                ->select(["HolidayDate"])
                                ->filterByIstateid($employee->getBranch()->getIstateid())
                                ->filterByCompanyId($this->company_id)
                                ->groupByHolidayDate()
                                ->find()->toArray();
            
            foreach ($pendingLeaves as $pendingLeave) {
                $dateRangs = EssHelper::date_range($pendingLeave->getLeaveFrom()->format('Y-m-d'), $pendingLeave->getLeaveTo()->format('Y-m-d'));
                
                //Sunday and Holiday Check
                foreach ($dateRangs as $date) {
                    $currentDate = DateTime::createFromFormat("Y-m-d", $date);
                    if ($currentDate->format("N") == 7) { // Sunday
                        continue;
                    }
                    if (in_array($currentDate->format("Y-m-d"), $allHolidayDates)) {
                        continue;
                    }
                    $leavesToBeApproved[] = $currentDate->format('d-m-Y');
                }

                // $leavesToBeApproved[] = $pendingLeave->getLeaveFrom()->format('Y-m-d') . " To " . $pendingLeave->getLeaveTo()->format('Y-m-d');
            }

            $lastDCR = DailycallsQuery::create()
                        ->select(["EmployeeId"])
                        ->withColumn('MAX(dailycalls.dcr_date)', 'LastDCRDate')
                        ->addjoin('dailycalls.employee_id', 'attendance.employee_id', Criteria::INNER_JOIN)
                        ->where('attendance.status = 1')
                        ->where('attendance.attendance_date = dailycalls.dcr_date')
                        ->filterByEmployeeId($employee->getEmployeeId())
                        ->filterByDcrStatus(['completed', 'Reported'])
                        ->filterByCompanyId($this->company_id)
                        ->groupByEmployeeId()
                        ->findOne();

            $lastLeave = LeavesQuery::create()
                        ->select(["EmployeeId"])
                        ->withColumn('MAX(leaves.leave_date)', 'LastLeaveDate')
                        ->addjoin('leaves.leave_request_id', 'leave_request.leave_req_id', Criteria::INNER_JOIN)
                        ->where('leave_request.leave_status = 2')
                        ->filterByEmployeeId($employee->getPrimaryKey())
                        ->filterByLeavePoints(0, Criteria::LESS_THAN)
                        ->filterByLeaveDate(date('Y-m-d'), Criteria::LESS_EQUAL)
                        ->groupByEmployeeId()
                        ->findOne();

            $lastDCRDate = (!empty($lastDCR) && isset($lastDCR['LastDCRDate']) ? $lastDCR['LastDCRDate'] : '');
            $lastLeaveDate = (!empty($lastLeave) && isset($lastLeave['LastLeaveDate']) ? $lastLeave['LastLeaveDate'] : '');

            if(!empty($lastDCRDate) && !empty($lastLeaveDate) && strtotime($lastLeaveDate) > strtotime($lastDCRDate)) {
                if(strtotime($lastLeaveDate) > time()) {
                    $lastWorkingDay = date('d-m-Y');
                } else {
                    $lastWorkingDay = date('d-m-Y', strtotime($lastLeaveDate));
                }
            } else {
                $lastWorkingDay = !empty($lastDCRDate) ? date('d-m-Y', strtotime($lastDCRDate)) : '';
            }

            $currentAndPreviousMonthsDCRs = DailycallsQuery::create()
                                ->select(['DcrDate'])
                                ->filterByEmployeeId($employee->getEmployeeId())
                                ->filterByDcrDate($previousMonthStartDate, Criteria::GREATER_EQUAL)
                                ->filterByDcrDate($endOfMonth, Criteria::LESS_EQUAL)
                                ->filterByCompanyId($this->company_id)
                                ->groupByDcrDate()
                                ->find()->toArray();
            
            $currentAndPreviousMonthsHolidays = HolidaysQuery::create()
                            ->select(["HolidayDate"])
                            ->filterByIstateid($employee->getBranch()->getIstateid())
                            ->filterByHolidayDate($previousMonthStartDate, Criteria::GREATER_EQUAL)
                            ->filterByHolidayDate($endOfMonth, Criteria::LESS_EQUAL)
                            ->filterByCompanyId($this->company_id)
                            ->groupByHolidayDate()
                            ->find()->toArray();
                
            $currentAndPreviousMonthsLeaves = LeavesQuery::create()
                        ->select(["LeaveDate"])
                        ->filterByEmployeeId($employee->getEmployeeId())
                        ->filterByLeaveDate($previousMonthStartDate, Criteria::GREATER_EQUAL)
                        ->filterByLeaveDate($endOfMonth, Criteria::LESS_EQUAL)
                        ->filterByLeavePoints(0, Criteria::LESS_THAN)
                        ->groupByLeaveDate()
                        ->find()->toArray();

            $currentAndPreviousMonthWorkedDates = array_merge($currentAndPreviousMonthsDCRs, $currentAndPreviousMonthsHolidays, $currentAndPreviousMonthsLeaves);

            $periodDate = $startOfMonth;
            while ($periodDate <= $endOfMonth) {
                $date = $periodDate;

                if (date('N', strtotime($date)) == 7 || (!empty($joiningDate) && $joiningDate > $date) || (!empty($resignDate) && $resignDate <= $date) || in_array($date, $currentAndPreviousMonthWorkedDates) ) {
                    // continue;
                } else {
                    $currentMonthMissingDays[] = date('d-m-Y', strtotime($periodDate));
                }

                $periodDate = date('Y-m-d', strtotime($periodDate . ' +1 day'));
            }

            $periodDate = $previousMonthStartDate;
            while ($periodDate <= $previousMonthEndDate) {
                $date = $periodDate;

                if (date('N', strtotime($date)) == 7 || (!empty($joiningDate) && $joiningDate > $date) || (!empty($resignDate) && $resignDate <= $date) || in_array($date, $currentAndPreviousMonthWorkedDates) ) {
                    // continue;
                } else {
                    $previousMonthMissingDays[] = date('d-m-Y', strtotime($periodDate));
                }

                $periodDate = date('Y-m-d', strtotime($periodDate . ' +1 day'));
            }

            $data = [
                $orgUnit->getUnitName(),
                $employee->getEmployeeCode(),
                $employee->getFirstName() . ' ' . $employee->getLastName(),
                $employee->getDesignations()->getDesignation(),
                $employee->getGradeMaster()->getGradeName(),
                $position->getPositionName(),
                $position->getPositionCode(),
                $joiningDate,
                $confirmationDate,
                $resignDate,
                $lastWorkingDay,
                count($previousMonthMissingDays),
                implode(', ', $previousMonthMissingDays),
                count($currentMonthMissingDays),
                implode(', ', $currentMonthMissingDays),
                $plLeaves,
                implode(', ', array_unique($leavesToBeApproved)),
                $lastExpensePaidAmount,
                $lastExpensePaidMonthYear,
                $startDate
            ];

            $this->addDataToFile(array_values($data));
        }

        return true;
    }

    private function darReportDump($da)
    {
        if ($da == null && $da == '') {
            $date = date('Y-m-d');
        } else {
            $date = $da;
        }

        $dateFor = date('d-m-Y', strtotime($date));

        $employees = \entities\EmployeeQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->leftJoinWithHrUserDates()
            ->leftJoinWithGeoTowns()
            ->leftJoinWithOrgUnit()
            ->leftJoinWithPositionsRelatedByReportingTo()
            ->find()->toArray();

        $darData = array();
        if (!empty($employees)) {

            foreach ($employees as $employee) {
                $employeeManager = \entities\EmployeeQuery::create()
                    ->filterByPositionId($employee["PositionsRelatedByReportingTo"]["PositionId"])
                    ->findOne();
                $employeeManagerName = $employeeManager->getFirstName() . ' ' . $employeeManager->getLastName();

                $darview = \entities\DarViewQuery::create()
                    ->filterByDcrDate($date)
                    ->filterByPositionId($employee['PositionId'])
                    ->find()->toArray();

                $dayPlanned = \entities\DayplanQuery::create()
                    ->select(['GeoTowns.Stownname'])
                    ->leftJoinWithGeoTowns()
                    ->filterByPositionId($employee['PositionId'])
                    ->filterByTpDate($date)
                    ->groupByItownid()
                    ->find()->toArray();

                $dayplan = implode(",", $dayPlanned);
                $day = date('l', strtotime($date));

                foreach ($darview as $data) {
                    $brandArray = array();
                    if (isset($data["BrandsDetailed"])) {
                        $brandIds = explode(',', $data["BrandsDetailed"]);
                        foreach ($brandIds as $brandId) {
                            if ($brandId != null && $brandId != '') {
                                $brand = \entities\EdPresentationsQuery::create()
                                    ->filterByPresentationId($brandId)
                                    ->findOne();
                                if ($brand != null && $brand->getPresentationName() != null) {
                                    array_push($brandArray, $brand->getPresentationName());
                                }
                            }
                        }
                    }
                    $outConPo = \entities\OutletContributionPotentialQuery::create()
                        ->filterByOutletId($data['OutletId'])
                        ->filterByRcpaMoye(date('m-Y', strtotime($date)))
                        ->findOne();
                    if ($data['DcrId'] != null) {
                        $dcsgpi = \entities\DailycallsSgpioutQuery::create()
                            ->filterByDailycallId($data['DcrId'])
                            ->findOne();

                        if ($dcsgpi != null) {
                            $beat = \entities\BeatOutletsQuery::create()
                                ->joinWithBeats()
                                ->filterByBeatOrgOutlet($dcsgpi->getOutletOrgdataId())
                                ->findOne();

                            $beatName = $beat->getBeats()->getBeatName();
                        } else {
                            $beatName = '-';
                        }
                    } else {
                        $beatName = '-';
                    }

                    $brandNameArray = implode(',', $brandArray);
                    if (isset($outConPo) != null && $outConPo->getPotential() != null && $outConPo->getContribution() != null) {
                        $outletPotential = $outConPo->getPotential();
                        $outletContribution = $outConPo->getContribution();
                    } else {
                        $outletPotential = 0;
                        $outletContribution = 0;
                    }
                    if (!empty($data['Stownname'])) {
                        $townName = $data['Stownname'];
                    } else {
                        $townName = '-';
                    }
                    if ($data['Managers'] == null || $data['Managers'] == '') {
                        $joint = 'No';
                    } else {
                        $joint = 'Yes';
                    }

                    if ($data["BrandsDetailed"] != null && $data["BrandsDetailed"] != '') {
                        $edetailing = 'Yes';
                    } else {
                        $edetailing = 'No';
                    }
                    if ($data["SgpiOut"] != null && $data["SgpiOut"] != '') {
                        $sgpi = 'Yes';
                    } else {
                        $sgpi = 'No';
                    }


                    $dataArray = array(
                        "EmployeeName" => $employee["FirstName"] . '' . $employee["LastName"],
                        "EmployeeCode" => $employee["EmployeeCode"],
                        "OrgUnitName" => $employee['OrgUnit']['UnitName'],
                        "ReportingTo" => $employeeManagerName,
                        "Date" => $dateFor,
                        "Day" => $day,
                        "Town" => $employee['GeoTowns']['Stownname'],
                        "LocationPlanned" => $dayplan,
                        "Stownname" => $townName . ' / ' . $beatName,
                        "OutletName" => $data['OutletName'],
                        "Tags" => $data['Tags'],
                        "Agenda" => $data['Agendacontroltype'] . ' / ' . $data['Agendname'],
                        "JointWorking" => $joint,
                        "Planned" => $data['Planned'],
                        "CreatedAt" => date('H:i', strtotime($data['CreatedAt'])),
                        "SgpiOut" => $data['SgpiOut'],
                        "Brands" => $brandNameArray,
                        "PobTotal" => $data['PobTotal'],
                        "Potential" => $outletPotential,
                        "Contribution" => $outletContribution,
                        "Edetailing" => $edetailing,
                        "Sgpi" => $sgpi,
                    );
                    array_push($darData, $dataArray);
                }
            }
        }

        return $darData;
    }

    private function sgpiBrandWiseDistributionDump($moye, $orgunitId)
    {
        if ($moye == null && $moye == '') {
            $month = date("m-Y");
        } else {
            $month = $moye;
        }

        $monthFor = explode("-", $month);
        $monthFormat = date($monthFor[0] . '-' . $monthFor[1]);
        $startDate = date($monthFor[1] . '-' . $monthFor[0] . '-' . '01');
        $endDate = date($monthFor[1] . '-' . $monthFor[0] . '-' . 't');

        $territoriesPositions = TerritoriesQuery::create()->select(['PositionId'])->filterByPositionId(null, Criteria::NOT_EQUAL)->filterByOrgunitid($orgunitId)->find()->toArray();

        $positions = \entities\PositionsQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByOrgUnitId($orgunitId)
            ->filterByPositionId($territoriesPositions)
            ->leftJoinWithOrgUnit()
            ->find()->toArray();

        $result = array();
        $count = 0;
        $lastPer = 0;
        echo "SGPI Brand Wise Distribution Report : ";

        if (!empty($positions)) {
            foreach ($positions as $position) {

                if (!str_starts_with($position['PositionCode'], '1')) {
                    continue;
                }

                $employees = \entities\EmployeeQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->filterByOrgUnitId($orgunitId)
                    ->filterByPositionId($position['PositionId'])
                    ->leftJoinWithHrUserDates()
                    ->leftJoinWithGeoTowns()
                    ->leftJoinWithOrgUnit()
                    // ->orderByStatus(Criteria::DESC)
                    ->filterByStatus(1)
                    ->find()->toArray();
                $employee = count($employees) ? $employees[0] : null;

                $joiningDate = isset($employee['HrUserDatess'][0]['JoinDate']) ? $employee['HrUserDatess'][0]['JoinDate'] : '';
                $townName = isset($employee['GeoTowns']['Stownname']) ? $employee['GeoTowns']['Stownname'] : '';
                $orgUnitName = isset($position['OrgUnit']['UnitName']) ? $position['OrgUnit']['UnitName'] : '';
                $empCode = isset($employee['EmployeeCode']) ? $employee['EmployeeCode'] : '';
                $empFirstName = isset($employee['FirstName']) ? $employee['FirstName'] : '';
                $empLastName = isset($employee['LastName']) ? $employee['LastName'] : '';
                $empName = $empFirstName . ' ' . $empLastName;

                $managers = $position['CavPositionsUp'];
                if ($managers != null) {
                    $managerPositionIds = explode(",", $managers);
                } else {
                    $managerPositionIds = null;
                }

                $managerPositions = \entities\PositionsQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->filterByPositionId($managerPositionIds)
                    ->find()->toArray();

                $level1Employee = $level2Employee = $level3Employee = "";
                $level1PositionCode = $level2PositionCode = $level3PositionCode = "";
                foreach ($managerPositions as $managerPosition) {
                    if (str_starts_with($managerPosition['PositionCode'], '4')) {
                        $level1Employee = $managerPosition["PositionName"];
                        $level1PositionCode = $managerPosition["PositionCode"];
                        $level1EmployeePositionId = $managerPosition["PositionId"];
                    } elseif (str_starts_with($managerPosition['PositionCode'], '3')) {
                        $level2Employee = $managerPosition["PositionName"];
                        $level2PositionCode = $managerPosition["PositionCode"];
                        $level2EmployeePositionId = $managerPosition["PositionId"];
                    } elseif (str_starts_with($managerPosition['PositionCode'], '2')) {
                        $level3Employee = $managerPosition["PositionName"];
                        $level3PositionCode = $managerPosition["PositionCode"];
                        $level3EmployeePositionId = $managerPosition["PositionId"];
                    }
                }

                $level3 = isset($level3EmployeePositionId) ? $level3EmployeePositionId : null;
                $level2 = isset($level2EmployeePositionId) ? $level2EmployeePositionId : null;
                $level1 = isset($level1EmployeePositionId) ? $level1EmployeePositionId : null;

                $level3Position = isset($level3EmployeePositionId) ? $level3EmployeePositionId : null;
                $level2Position = isset($level2EmployeePositionId) ? $level2EmployeePositionId : null;
                $level1Position = isset($level1EmployeePositionId) ? $level1EmployeePositionId : null;

                $cavTerritories = $position['CavTerritories'];
                if ($cavTerritories != null) {
                    $terExplode = explode(',', $cavTerritories);
                } else {
                    $terExplode = [];
                }

                $sgpiBrandWiseDistribution = \entities\SgpiBrandWiseDistributionQuery::create()
                    ->filterByTerritoryId($terExplode)
                    ->find()->toArray();

                $sgpiOutView = \entities\SgpiOutViewQuery::create()
                    ->select(['DcrDate', 'Outlet_orgId', 'BrandId', 'SgpiQty'])
                    ->withColumn('sum(sgpi_qty)', 'SgpiQty')
                    ->filterByDcrDate($startDate, Criteria::GREATER_EQUAL)
                    ->filterByDcrDate($endDate, Criteria::LESS_EQUAL)
                    ->filterByTerritoryId($terExplode)
                    ->groupByOutlet_orgId()
                    ->groupByBrandId()
                    ->groupByDcrDate()
                    ->find()->toArray();

                $sgpiOutViewDataArray = array();
                foreach ($sgpiOutView as $sgpiOutData) {
                    $data = [];
                    $CompositeKey = $sgpiOutData['Outlet_orgId'] . '-' . $sgpiOutData['BrandId'];
                    $data[$CompositeKey] = [
                        'Date' => $sgpiOutData['DcrDate'],
                        'OutletOrgUnitId' => $sgpiOutData['Outlet_orgId'],
                        'BrandId' => $sgpiOutData['BrandId'],
                        'SgpiQty' => $sgpiOutData['SgpiQty'],
                    ];
                    array_push($sgpiOutViewDataArray, $data);
                }

                $dailyCalls = \entities\DailycallsQuery::create()
                    ->select(['OutletOrgDataId', 'PositionId', 'DcrDate', 'Managers', 'Count'])
                    ->withColumn('count(outlet_org_data_id)', 'Count')
                    ->filterByDcrDate($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByDcrDate($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->filterByPositionId($position['PositionId'])
                    ->groupByOutletOrgDataId()
                    ->groupByDcrDate()
                    ->find()->toArray();

                $mroutletVisitViewCount = \entities\OutletVisitsViewQuery::create()
                    ->select(['Visit', 'OutletOrgDataId'])
                    ->withColumn('sum(visits)', 'Visit')
                    ->filterByMoye($monthFormat)
                    ->filterByPositionId($position['PositionId'])
                    ->groupByOutletOrgDataId()
                    ->find()->toKeyValue('OutletOrgDataId', 'Visit');

                if ($level3 != null) {
                    $amOutletVisitViewCount = \entities\OutletVisitsViewQuery::create()
                        ->select(['Visit', 'OutletOrgDataId'])
                        ->withColumn('sum(visits)', 'Visit')
                        ->filterByMoye($monthFormat)
                        ->filterByPositionId($level3)
                        ->groupByOutletOrgDataId()
                        ->find()->toKeyValue('OutletOrgDataId', 'Visit');
                }

                if ($level2 != null) {
                    $rmOutletVisitViewCount = \entities\OutletVisitsViewQuery::create()
                        ->select(['Visit', 'OutletOrgDataId'])
                        ->withColumn('sum(visits)', 'Visit')
                        ->filterByMoye($monthFormat)
                        ->filterByPositionId($level2)
                        ->groupByOutletOrgDataId()
                        ->find()->toKeyValue('OutletOrgDataId', 'Visit');
                }

                if ($level1 != null) {
                    $zmOutletVisitViewCount = \entities\OutletVisitsViewQuery::create()
                        ->select(['Visit', 'OutletOrgDataId'])
                        ->withColumn('sum(visits)', 'Visit')
                        ->filterByMoye($monthFormat)
                        ->filterByPositionId($level1)
                        ->groupByOutletOrgDataId()
                        ->find()->toKeyValue('OutletOrgDataId', 'Visit');
                }

                foreach ($dailyCalls as $dailyCall) {
                    if ($dailyCall["Managers"] != null) {
                        $empExpo = explode(',', $dailyCall["Managers"]);
                        $employeePositions = \entities\EmployeeQuery::create()
                            ->select(['PositionId'])
                            ->filterByEmployeeId($empExpo)
                            ->find()->toArray();
                        if (in_array($level1, $employeePositions)) {
                            if (isset($amOutletVisitViewCount[$dailyCall['OutletOrgDataId']])) {
                                $amOutletVisitViewCount[$dailyCall['OutletOrgDataId']] += $dailyCall['Count'];
                            } else {
                                $amOutletVisitViewCount[$dailyCall['OutletOrgDataId']] = $dailyCall['Count'];
                            }
                        }
                        if (in_array($level2, $employeePositions)) {
                            if (isset($rmOutletVisitViewCount[$dailyCall['OutletOrgDataId']])) {
                                $rmOutletVisitViewCount[$dailyCall['OutletOrgDataId']] += $dailyCall['Count'];
                            } else {
                                $rmOutletVisitViewCount[$dailyCall['OutletOrgDataId']] = $dailyCall['Count'];
                            }
                        }
                        if (in_array($level3, $employeePositions)) {
                            if (isset($zmOutletVisitViewCount[$dailyCall['OutletOrgDataId']])) {
                                $zmOutletVisitViewCount[$dailyCall['OutletOrgDataId']] += $dailyCall['Count'];
                            } else {
                                $zmOutletVisitViewCount[$dailyCall['OutletOrgDataId']] = $dailyCall['Count'];
                            }
                        }
                    }
                }

                foreach ($sgpiBrandWiseDistribution as $sgpiOut) {
                    $key = $sgpiOut['OrgDataId'] . '-' . $sgpiOut['BrandId'];

                    $datesArray = array();
                    $qty = 0;
                    foreach ($sgpiOutViewDataArray as $sgpiOutViewData) {
                        if (isset($sgpiOutViewData[$key])) {
                            $qty += $sgpiOutViewData[$key]["SgpiQty"];
                            $da = date('d', strtotime($sgpiOutViewData[$key]["Date"]));
                            array_push($datesArray, $da);
                        }
                    }

                    if (!empty($datesArray)) {
                        $arrayUnique = array_unique($datesArray);
                        $dates = implode(',', $arrayUnique);
                    } else {
                        $dates = '';
                    }

                    if ($dates != null && $dates != '') {
                        $brandSGPIDistributed = $qty . ' (' . $dates . ')';
                    } else {
                        $brandSGPIDistributed = $qty;
                    }

                    if (isset($mroutletVisitViewCount[$sgpiOut['OrgDataId']])) {
                        $mrCallCount = $mroutletVisitViewCount[$sgpiOut['OrgDataId']];
                    } else {
                        $mrCallCount = 0;
                    }
                    if (isset($amOutletVisitViewCount[$sgpiOut['OrgDataId']])) {
                        $amCallCount = $amOutletVisitViewCount[$sgpiOut['OrgDataId']];
                    } else {
                        $amCallCount = 0;
                    }
                    if (isset($rmOutletVisitViewCount[$sgpiOut['OrgDataId']])) {
                        $rmCallCount = $rmOutletVisitViewCount[$sgpiOut['OrgDataId']];
                    } else {
                        $rmCallCount = 0;
                    }
                    if (isset($zmOutletVisitViewCount[$sgpiOut['OrgDataId']])) {
                        $zmCallCount = $zmOutletVisitViewCount[$sgpiOut['OrgDataId']];
                    } else {
                        $zmCallCount = 0;
                    }

                    if ($sgpiOut['SgpiStatus'] == false) {
                        $SGPITagged = 'No';
                    } else {
                        $SGPITagged = 'Yes';
                    }

                    $empPositionCode = $position['PositionCode'];
                    $empPositionLevel = '';
                    if (str_starts_with($empPositionCode, '4')) {
                        $empPositionLevel = 'Zone';
                    } elseif (str_starts_with($empPositionCode, '3')) {
                        $empPositionLevel = 'Region';
                    } elseif (str_starts_with($empPositionCode, '2')) {
                        $empPositionLevel = 'Area';
                    } else {
                        $empPositionLevel = 'Territory';
                    }

                    $data = array(
                        'Division' => $orgUnitName,
                        'EmpId' => isset($employee['EmployeeId']) ? $employee['EmployeeId'] : '',
                        'EmpName' => $empName,
                        // 'Location' => $townName,
                        'Location' => $position['PositionName'],
                        'LocationCode' => $empCode,
                        'DrCode' => $sgpiOut['OutletCode'],
                        'DrName' => $sgpiOut['OutletName'],
                        'DrSpecialty' => $sgpiOut['Classification'],
                        'Month' => $month,
                        'DRTags' => $sgpiOut['Tags'],
                        'Brand' => $sgpiOut['BrandName'],
                        'SGPITagged' => $SGPITagged,
                        'BrandSGPIDistributed' => $brandSGPIDistributed,
                        'MRCallDone' => $mrCallCount,
                        'AMCallDone' => $amCallCount,
                        'RMCallDone' => $rmCallCount,
                        'ZMCallDone' => $zmCallCount,
                        'Level1' => $level1Employee,
                        'Level2' => $level2Employee,
                        'Level3' => $level3Employee,
                        'level1PositionCode' => $level1PositionCode,
                        'level2PositionCode' => $level2PositionCode,
                        'level3PositionCode' => $level3PositionCode,
                        'EmpPositionCode' => $empPositionCode,
                        'EmpPositionName' => $position['PositionName'],
                        'EmpLevel' => $empPositionLevel
                    );
                    array_push($result, $data);
                }

                $count++;
                $progress = round($count / count($positions) * 100, 0);
                if ($lastPer != $progress) {
                    echo " " . $progress . "% " . PHP_EOL;
                    $lastPer = $progress;
                }
            }
        }

        return $result;
    }

    private function masReportDump($moye = "")
    {
        if ($moye == null && $moye == '') {
            $month = date("m-Y");
        } else {
            $month = $moye;
        }

        $monthNumber = explode('-', $month);
        $dt = \DateTime::createFromFormat('Y-m', $monthNumber[1] . '-' . $monthNumber[0]);
        $startDate = $dt->format('Y-m-01');
        $endDate = $dt->format('Y-m-t');

        //$empPositions = EmployeeQuery::create()->find()->toKeyValue('EmployeeId','PositionId');

        // $territoriesPositions = TerritoriesQuery::create()->select(['PositionId'])->filterByPositionId(null,Criteria::NOT_EQUAL)->find()->toArray();        

        $agendatypes = \entities\AgendatypesQuery::create()->filterByCompanyId($this->company_id)->filterByAgendacontroltype('NCA')->find()->toArray();

        $employees = \entities\EmployeeQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->leftJoinWithHrUserDates()
            ->leftJoinWithGeoTowns()
            ->leftJoinWithOrgUnit()
            ->joinWithBranch()
            // ->filterByPositionId($territoriesPositions)
            // ->filterByStatus(1)
            ->find()->toArray();

        $empData = array();

        $count = 0;
        $lastPer = 0;
        echo "MAS Report : ";

        if (!empty($employees)) {
            $date = date((int)$monthNumber[1] . '-' . (int)$monthNumber[0] . '-01'); //Current Month Year
            $daysinMonth = cal_days_in_month(CAL_GREGORIAN, (int)$monthNumber[0], (int)$monthNumber[1]);
            $sunday = 0;
            $weekOffs = [];
            for ($i = 0; $i < $daysinMonth; $i++) {
                $day = date("Y-m-d", strtotime("+$i day", strtotime($date)));
                $currentDate = DateTime::createFromFormat("Y-m-d", $day);
                if ($currentDate->format("N") == 7) // Sunday
                {
                    $sunday += 1;
                    $weekOffs[] = $currentDate->format("Y-m-d");
                }
            }

            foreach ($employees as $emp) {
                // Need to check if no employee with that position id
                if (empty($emp)) {
                    continue;
                }

                $townName = isset($emp['GeoTowns']['Stownname']) ? $emp['GeoTowns']['Stownname'] : '';
                $position = \entities\PositionsQuery::create()->findPk($emp['PositionId']);
                $managers = $position->getCavPositionsUp();

                if ($managers != null) {
                    $managerPositionIds = explode(",", $managers);
                } else {
                    $managerPositionIds = null;
                }

                $managerPositions = \entities\PositionsQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->filterByPositionId($managerPositionIds)
                    ->find()->toArray();

                // set Positions
                $level1Employee = $level2Employee = $level3Employee = "";
                $level1PositionCode = $level2PositionCode = $level3PositionCode = "";
                foreach ($managerPositions as $managerPosition) {
                    if (str_starts_with($managerPosition['PositionCode'], '4')) {
                        $level1Employee = $managerPosition["PositionName"];
                        $level1PositionCode = $managerPosition["PositionCode"];
                    } elseif (str_starts_with($managerPosition['PositionCode'], '3')) {
                        $level2Employee = $managerPosition["PositionName"];
                        $level2PositionCode = $managerPosition["PositionCode"];
                    } elseif (str_starts_with($managerPosition['PositionCode'], '2')) {
                        $level3Employee = $managerPosition["PositionName"];
                        $level3PositionCode = $managerPosition["PositionCode"];
                    }
                }

                $level3 = isset($level3Employee) ? $level3Employee : null;
                $level2 = isset($level2Employee) ? $level2Employee : null;
                $level1 = isset($level1Employee) ? $level1Employee : null;
                $empPositionCode = $position->getPositionCode();
                $empPositionName = $position->getPositionName();

                if (empty($level1PositionCode) && !empty($empPositionCode) && str_starts_with($empPositionCode, '4')) {
                    $level1 = $empPositionName;
                    $level1PositionCode = $empPositionCode;
                } elseif (empty($level2PositionCode) && !empty($empPositionCode) && str_starts_with($empPositionCode, '3')) {
                    $level2 = $empPositionName;
                    $level2PositionCode = $empPositionCode;
                } elseif (empty($level3PositionCode) && !empty($empPositionCode) && str_starts_with($empPositionCode, '2')) {
                    $level3 = $empPositionName;
                    $level3PositionCode = $empPositionCode;
                }

                // $terExplode = \entities\TerritoriesQuery::create()->filterByPositionId($emp['PositionId'])->select(['TerritoryId'])->findOne();

                // if($terExplode == null)
                // {
                //     continue;
                // }
                $cavTerritories = $position->getCavTerritories();
                if ($cavTerritories != null) {
                    $terExplode = explode(',', $cavTerritories);
                } else {
                    continue;
                }

                // position down
                $downEmployees = [$emp['EmployeeId']];
                $cavPositionDowns = $position->getCavPositionsDown();
                if($cavPositionDowns != null) {
                    $downPositions = explode(',', $cavPositionDowns);
                    $downEmployeesData = EmployeeQuery::create()
                                    ->filterByPositionId($downPositions)
                                    ->find()->toArray();
                    foreach($downEmployeesData as $downEmp) {
                        $downEmployees[] = $downEmp['EmployeeId'];
                    } 
                }

                // FWD Calculation
                // $holidays = \entities\HolidaysQuery::create()
                //     ->select(['HolidayDate'])
                //     ->filterByIstateid($emp["Branch"]["Istateid"])
                //     ->filterByHolidayDate($startDate, Criteria::GREATER_EQUAL)
                //     ->filterByHolidayDate($endDate, Criteria::LESS_EQUAL)
                //     ->find()->count();
                $holidayDates = \entities\HolidaysQuery::create()
                    ->select(["HolidayDate"])
                    ->filterByIstateid($emp["Branch"]["Istateid"])
                    ->filterByHolidayDate($startDate, Criteria::GREATER_EQUAL)
                    ->filterByHolidayDate($endDate, Criteria::LESS_EQUAL)
                    ->filterByCompanyId($this->company_id)
                    ->find()
                    ->toArray();
                $holidays = count($holidayDates);
                // $fwd = $daysinMonth - ($sunday + $holidays);

                // NCA Calculation
                $dailyCalls = \entities\DailycallsQuery::create()
                    ->select(['DcrDate'])
                    ->filterByPositionId($emp["PositionId"])
                    ->filterByEmployeeId($emp['EmployeeId'])
                    ->filterByDcrDate($startDate, Criteria::GREATER_EQUAL)
                    ->filterByDcrDate($endDate, Criteria::LESS_EQUAL)
                    ->filterByAgendacontroltype('NCA')
                    ->groupByDcrDate()
                    ->find()->toArray();
                $halfNca = 0;
                $totalnca=0;
                foreach ($dailyCalls as $dailyCall) {
                    $dailycalls = \entities\DailycallsQuery::create()
                        ->select(['DcrDate'])
                        ->filterByPositionId($emp["PositionId"])
                        ->filterByEmployeeId($emp['EmployeeId'])
                        ->filterByDcrDate($dailyCall)
                        ->filterByAgendacontroltype('FW')
                        ->groupByDcrDate()
                        ->find()->count();
                    
                    if ($dailycalls > 0) {
                        if(!in_array($dailyCall, array_merge($weekOffs, $holidayDates))) {
                            $halfNca += 0.5;
                        }
                        $totalnca +=0.5;
                    }else{
                        $totalnca +=1;
                    }
                }

                // Leave Calculation
                // $leaves = \entities\LeaveRequestQuery::create()
                //     ->filterByLeaveFrom($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                //     ->filterByLeaveTo($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                //     ->filterByEmployeeId($emp['EmployeeId'])
                //     ->filterByLeaveStatus(2)
                //     ->find()->count();
                $leaveDates = \entities\LeavesQuery::create()
                            ->select(["LeaveDate"])
                            ->filterByLeaveDate($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByLeaveDate($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                            ->filterByLeavePoints(0, \Propel\Runtime\ActiveQuery\Criteria::LESS_THAN)
                            ->filterByEmployeeId($emp['EmployeeId'])
                            ->find()->toArray();
                $leaves = count($leaveDates);
                            

                $dailyCallsFW = \entities\DailycallsQuery::create()
                    ->select(['DcrDate'])
                    ->filterByEmployeeId($emp['EmployeeId'])
                    ->filterByPositionId($emp["PositionId"])
                    ->filterByDcrDate($startDate, Criteria::GREATER_EQUAL)
                    ->filterByDcrDate($endDate, Criteria::LESS_EQUAL)
                    ->filterByDcrDate(array_merge($weekOffs, $holidayDates, $leaveDates), Criteria::NOT_IN) // TSPC-873
                    ->filterByAgendacontroltype('FW')
                    ->groupByDcrDate()
                    ->find()->count();

                //$workingDays = $fwd - $nca - $leaves;
                $fwd = $dailyCallsFW - $halfNca; //- ($nca + $leaves); // this logic changes by Ayush 23-08-2023
                if($fwd < 0) {
                    $fwd = 0;
                }
                $workingDays = $daysinMonth - ($sunday + $holidays); // this logic changes by Ayush 23-08-2023

                // Total DR
                $totalDr = \entities\OutletViewQuery::create()
                    ->filterByTerritoryId($terExplode)
                    ->filterByOutlettypeName('Doctor')
                    ->find()->count();

                $totalPharmacy = \entities\OutletViewQuery::create()
                    ->filterByTerritoryId($terExplode)
                    ->filterByOutlettypeName('Pharmacy')
                    ->find()->count();

                $totalStockiest = \entities\OutletViewQuery::create()
                    ->filterByTerritoryId($terExplode)
                    ->filterByOutlettypeName('Stockist')
                    ->find()->count();

                $addedDrs = OnBoardRequestQuery::create()
                                ->filterByCreatedByEmployeeId($emp['EmployeeId'])
                                ->filterByCreatedByPositionId($emp['PositionId'])
                                ->filterByFinalApprovedAt($startDate, Criteria::GREATER_EQUAL)
                                ->filterByFinalApprovedAt($endDate, Criteria::LESS_EQUAL)
                                ->filterByStatus(6)
                                ->count();

                $removeDrs = OnBoardRequestAddressQuery::create()
                                ->useOnBoardRequestQuery()
                                    ->filterByCreatedByEmployeeId($emp['EmployeeId'])
                                    ->filterByCreatedByPositionId($emp['PositionId'])
                                ->endUse()
                                ->filterByCreatedAt($startDate, Criteria::GREATER_EQUAL)
                                ->filterByCreatedAt($endDate, Criteria::LESS_EQUAL)
                                ->filterByStatus("Deleted")
                                ->count();

                // Total DR MET
                $drMet = \entities\DailycallsQuery::create()
                    ->select(['OutletOrgDataId'])
                    ->useOutletOrgDataExistsQuery()
                        ->useOutletsQuery()
                            ->useOutletTypeExistsQuery()
                                ->filterByOutlettypeName('Doctor')
                            ->endUse()
                        ->endUse()
                    ->endUse()
                    ->filterByPositionId($emp['PositionId'])
                    ->filterByEmployeeId($emp['EmployeeId'])
                    ->filterByDcrDate($startDate, Criteria::GREATER_EQUAL)
                    ->filterByDcrDate($endDate, Criteria::LESS_EQUAL)
                    ->groupByOutletOrgDataId()
                    ->count();
                
                $pharmacyUniqueMet = \entities\DailycallsQuery::create()
                    ->select(['OutletOrgDataId'])
                    ->useOutletOrgDataExistsQuery()
                        ->useOutletsQuery()
                            ->useOutletTypeExistsQuery()
                                ->filterByOutlettypeName('Pharmacy')
                            ->endUse()
                        ->endUse()
                    ->endUse()
                    ->filterByPositionId($emp['PositionId'])
                    ->filterByEmployeeId($emp['EmployeeId'])
                    ->filterByDcrDate($startDate, Criteria::GREATER_EQUAL)
                    ->filterByDcrDate($endDate, Criteria::LESS_EQUAL)
                    ->groupByOutletOrgDataId()
                    ->count();

                $pharmacyMet = \entities\DailycallsQuery::create()
                    ->select(['OutletOrgDataId'])
                    ->useOutletOrgDataExistsQuery()
                        ->useOutletsQuery()
                            ->useOutletTypeExistsQuery()
                                ->filterByOutlettypeName('Pharmacy')
                            ->endUse()
                        ->endUse()
                    ->endUse()
                    ->filterByPositionId($emp['PositionId'])
                    ->filterByEmployeeId($emp['EmployeeId'])
                    ->filterByDcrDate($startDate, Criteria::GREATER_EQUAL)
                    ->filterByDcrDate($endDate, Criteria::LESS_EQUAL)
                    ->count();

                // Total DR MET As Per VF
                $drMetasperVF = \entities\OutletVisitsViewQuery::create()
                    ->select(['Vfcovered'])
                    ->withColumn('sum(vfcovered)', 'Vfcovered')
                    ->filterByTerritoryId($terExplode)
                    ->filterByPositionId($emp['PositionId'])
                    ->filterByEmployeeId($emp['EmployeeId'])
                    ->filterByMoye($month)
                    ->filterByOutlettypeName('Doctor')
                    ->filterByVfcovered(1)
                    ->find()->toArray();

                $drAsperVF = \entities\OutletVisitsViewQuery::create()
                    ->select(['VisitFq'])
                    ->withColumn('sum(visit_fq)', 'VisitFq')
                    ->filterByTerritoryId($terExplode)
                    ->filterByPositionId($emp['PositionId'])
                    ->filterByEmployeeId($emp['EmployeeId'])
                    ->filterByMoye($month)
                    ->filterByOutlettypeName('Doctor')
                    ->find()->toArray();

                // $drcaL = 0;
                // $DRCALVisit = \entities\OutletVisitsViewQuery::create()
                //     ->filterByPositionId($emp['PositionId'])
                //     ->filterByEmployeeId($emp['EmployeeId'])
                //     ->filterByTerritoryId($terExplode)
                //     ->filterByMoye($month)
                //     ->filterByOutlettypeName('Doctor')
                //     ->find();
                // foreach ($DRCALVisit as $DRCA) {
                //     $drcaL += $DRCA->getVisits();
                // }
                $drcaL = \entities\DailycallsQuery::create()
                    ->useOutletOrgDataExistsQuery()
                        ->useOutletsQuery()
                            ->useOutletTypeExistsQuery()
                                ->filterByOutlettypeName('Doctor')
                            ->endUse()
                        ->endUse()
                    ->endUse()
                    ->filterByPositionId($emp['PositionId'])
                    ->filterByEmployeeId($emp['EmployeeId'])
                    ->filterByDcrDate($startDate, Criteria::GREATER_EQUAL)
                    ->filterByDcrDate($endDate, Criteria::LESS_EQUAL)
                    ->count();

                // Total Chemist
                $totalChemist = \entities\OutletViewQuery::create()
                    ->filterByTerritoryId($terExplode)
                    ->filterByOutlettypeName('Pharmacy')
                    ->find()->count();

                $drChemist = \entities\DailycallsQuery::create()
                    ->select(['OutletOrgDataId'])
                    ->useOutletOrgDataExistsQuery()
                        ->useOutletsQuery()
                            ->useOutletTypeExistsQuery()
                                ->filterByOutlettypeName('Pharmacy')
                            ->endUse()
                        ->endUse()
                    ->endUse()
                    ->filterByPositionId($emp['PositionId'])
                    ->filterByEmployeeId($emp['EmployeeId'])
                    ->filterByDcrDate($startDate, Criteria::GREATER_EQUAL)
                    ->filterByDcrDate($endDate, Criteria::LESS_EQUAL)
                    ->groupByOutletOrgDataId()
                    ->count();
                $pobValue = \entities\OrdersQuery::create()
                    ->select(['PobValue'])
                    ->withColumn('sum(order_total)', 'PobValue')
                    // ->filterByEmployeeId($emp['EmployeeId'])
                    ->filterByEmployeeId($downEmployees)
                    ->filterByOrderDate($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByOrderDate($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->find()->toArray();
                $rcpaSummary = \entities\RcpaSummaryQuery::create()
                    ->select(['RcpaOwn', 'RcpaCompetition'])
                    ->withColumn('sum(own)', 'RcpaOwn')
                    ->withColumn('sum(competition)', 'RcpaCompetition')
                    ->filterByTerritoryId($terExplode)
                    ->filterByRcpaMoye($month)
                    ->find()->toArray();
                $jwDailyCalls = \entities\DailycallsQuery::create()
                    ->useOutletOrgDataExistsQuery()
                        ->useOutletsQuery()
                            ->useOutletTypeExistsQuery()
                                ->filterByOutlettypeName('Doctor')
                            ->endUse()
                        ->endUse()
                    ->endUse()
                    ->filterByEmployeeId($emp['EmployeeId'])
                    ->filterByPositionId($emp['PositionId'])
                    ->filterByDcrDate($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByDcrDate($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->filterByManagers(null, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                    ->filterByManagers('', \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                    ->find()->count();
                $jointWorking = \entities\DailycallsQuery::create()
                    ->select(['Manager'])
                    ->withColumn('count(managers)', 'Manager')
                    ->filterByEmployeeId($emp['EmployeeId'])
                    ->filterByPositionId($emp['PositionId'])
                    ->filterByDcrDate($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByDcrDate($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->filterByDcrDate(array_merge($weekOffs, $holidayDates, $leaveDates), Criteria::NOT_IN) // TSPC-873
                    ->filterByManagers(null, \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                    ->filterByManagers('', \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                    ->groupByDcrDate()
                    ->find()->count();

                $dailyCallsAgenda = \entities\DailycallsQuery::create()
                    ->select(['AgendaId'])
                    ->filterByEmployeeId($emp['EmployeeId'])
                    ->filterByPositionId($emp['PositionId'])
                    ->filterByDcrDate($startDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByDcrDate($endDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->filterByAgendacontroltype('FW', \Propel\Runtime\ActiveQuery\Criteria::NOT_EQUAL)
                    ->find()->toArray();


                $AgendaArray = array();

                foreach ($dailyCallsAgenda as $dailyCallsAge) {
                    if (!isset($AgendaArray[$dailyCallsAge])) {
                        $AgendaArray[$dailyCallsAge] = 0;
                    }
                    $AgendaArray[$dailyCallsAge] += 0.5;
                }

                $agendaRemark = "";
                foreach ($agendatypes as $agendatype) {

                    if (array_key_exists($agendatype["Agendaid"], $AgendaArray)) {

                        $agendaRemark = $agendaRemark . "" . $agendatype["Agendname"] . "(" . $AgendaArray[$agendatype["Agendaid"]] . ") ";
                    }
                }


                $missedDrCall = $drAsperVF[0] - $drcaL;
                if ($missedDrCall < 0) {
                    $missedDrCalls = 0;
                } else {
                    $missedDrCalls = $missedDrCall;
                }

                if ($drcaL > 0 && $fwd > 0) {
                    $drcalPercentage = round($drcaL / $fwd, 2);
                } else {
                    $drcalPercentage = 0;
                }
                if ($drMet > 0 && $totalDr > 0) {
                    $drcvrgPercentage = round($drMet / $totalDr * 100, 2);
                } else {
                    $drcvrgPercentage = 0;
                }
                if ($drMetasperVF[0] > 0 && $totalDr > 0) {
                    $drvfcvrgPercentage = round($drMetasperVF[0] / $totalDr * 100, 2);
                } else {
                    $drvfcvrgPercentage = 0;
                }

                if ($dailyCallsFW < 1 && $emp['Status'] == 0) {
                    continue;
                }

                $empPositionLevel = '';
                if (str_starts_with($empPositionCode, '4')) {
                    $empPositionLevel = 'Zone';
                } elseif (str_starts_with($empPositionCode, '3')) {
                    $empPositionLevel = 'Region';
                } elseif (str_starts_with($empPositionCode, '2')) {
                    $empPositionLevel = 'Area';
                } else {
                    $empPositionLevel = 'Territory';
                }

                $data = [
                    "OrgName" => $emp['OrgUnit']["UnitName"],
                    "REPCODE" => $emp['EmployeeId'],
                    "EmployeeCode" => $emp['EmployeeCode'],
                    "EmployeeName" => $emp['FirstName'] . ' ' . $emp['LastName'],
                    "Level3" => $level3,
                    "Level2" => $level2,
                    "Level1" => $level1,
                    "Location" => str_starts_with($empPositionCode, '1') ? $empPositionName : '',
                    "MonthYear" => $month,
                    "WorkingDays" => $workingDays,
                    "FWD" => $fwd,
                    "NCA" => $totalnca,
                    "TotalDoctors" => $totalDr,
                    "DrMet" => $drMet,
                    "DrVfMet" => $drMetasperVF[0],
                    "DRCA-L" => $drcalPercentage,
                    "DRCVRG%" => $drcvrgPercentage,
                    "DRVFCVRG%" => $drvfcvrgPercentage,
                    "MISSEDDR" => $totalDr - $drMet,
                    "MISSEDDRCALLS" => $missedDrCalls,
                    "TOTALCHEMIST" => $totalChemist,
                    "POBValue" => isset($pobValue[0]) ? $pobValue[0] : 0,
                    "RCPAvalueforownbrand" => isset($rcpaSummary[0]['RcpaOwn']) ? $rcpaSummary[0]['RcpaOwn'] : 0,
                    "RCPAvalueforCompbrand" => isset($rcpaSummary[0]['RcpaCompetition']) ? $rcpaSummary[0]['RcpaCompetition'] : 0,
                    "JOINTWORKTotalCalls" => $jwDailyCalls,
                    "LEAVEDAYS" => $leaves,
                    "JoinWorking" => $jointWorking,
                    "NoDrCall" => $drcaL,
                    "Agenda" => $agendaRemark,
                    "level1PositionCode" => $level1PositionCode,
                    "level2PositionCode" => $level2PositionCode,
                    "level3PositionCode" => $level3PositionCode,
                    "EmpStatus" => $emp['Status'] == 1 ? 'Active' : 'Inactive',
                    'EmpPositionCode' => $empPositionCode,
                    'EmpPositionName' => $empPositionName,
                    'EmpLevel' => $empPositionLevel,
                    'pharmacyUniqueMet' => $pharmacyUniqueMet,
                    'pharmacyMet' => $pharmacyMet,
                    'avgPharmacyCall' => ($fwd > 0 ? ($pharmacyMet / $fwd) : 0),
                    'totalStockiest' => $totalStockiest,
                    'addedDrs' => $addedDrs,
                    'removeDrs' => $removeDrs,
                ];

                array_push($empData, $data);

                $count++;
                $progress = round($count / count($employees) * 100, 0);
                if ($lastPer != $progress) {
                    echo " " . $progress . "% " . PHP_EOL;
                    $lastPer = $progress;
                }
            }
        }

        return $empData;
    }

    private function dvpReportDump($moye = "")
    {
        if ($moye == null && $moye == '') {
            $month = date("m-Y");
        } else {
            $month = $moye;
        }

        $monthExp = explode('-', $month);
        $fromDate = date($monthExp[1] . '-' . $monthExp[0] . '-' . '01');
        // $toDate = date($monthExp[1] . '-' . $monthExp[0] . '-' . 't');
        $toDate = date('Y-m-t', strtotime($fromDate));

        // $lastMonth = date("m-Y", strtotime('-1 month'));
        $lastMonth = date("m-Y", strtotime('-1 month', strtotime($fromDate)));

        $territoriesPositions = TerritoriesQuery::create()->select(['PositionId'])->filterByPositionId(null, Criteria::NOT_EQUAL)->find()->toArray();
        $empPositions = EmployeeQuery::create()->find()->toKeyValue('EmployeeId', 'PositionId');
        $geoTowns = GeoTownsQuery::create()->find()->toKeyValue('Itownid', 'Stownname');

        $sgpiOutSummary = \entities\SgpiOutSummaryQuery::create()->filterByMoye($month)->find()->toArray();

        $sgpiSummary = [];
        foreach ($sgpiOutSummary as $sgpi) {
            if (!isset($sgpiSummary[$sgpi['OutletOrgdataId']])) {
                $sgpiSummary[$sgpi['OutletOrgdataId']] = ['samples' => 0, 'gifts' => 0, 'promo' => 0];
            }
            if (isset($sgpiSummary[$sgpi['OutletOrgdataId']][$sgpi['SgpiType']])) {
                $sgpiSummary[$sgpi['OutletOrgdataId']][$sgpi['SgpiType']] = $sgpi['Qty'];
            }
        }
        unset($sgpiOutSummary);

        // $employees = \entities\EmployeeQuery::create()
        //     ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
        //     ->leftJoinWithHrUserDates()
        //     ->leftJoinWithGeoTowns()
        //     ->leftJoinWithOrgUnit()
        //     ->filterByPositionId($territoriesPositions)
        //     ->find()->toArray();

        $positions = \entities\PositionsQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByPositionId($territoriesPositions)
            ->leftJoinWithOrgUnit()
            ->find()->toArray();

        $result = array();
        $count = 0;
        $lastPer = 0;
        echo "DVP Report : ";
        if (!empty($positions)) {
            foreach ($positions as $position) {

                $employees = \entities\EmployeeQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->leftJoinWithHrUserDates()
                    ->leftJoinWithGeoTowns()
                    ->leftJoinWithOrgUnit()
                    ->filterByPositionId($position['PositionId'])
                    ->orderByStatus(Criteria::DESC)
                    ->find()->toArray();
                $employee = count($employees) ? $employees[0] : null;

                $joiningDate = isset($employee['HrUserDatess'][0]['JoinDate']) ? $employee['HrUserDatess'][0]['JoinDate'] : '';
                $townName = isset($employee['GeoTowns']['Stownname']) ? $employee['GeoTowns']['Stownname'] : '';
                // $orgUnitName = isset($employee['OrgUnit']['UnitName']) ? $employee['OrgUnit']['UnitName'] : '';
                $orgUnitName = isset($position['OrgUnit']['UnitName']) ? $position['OrgUnit']['UnitName'] : '';
                $empCode = isset($employee['EmployeeCode']) ? $employee['EmployeeCode'] : '';

                // $position = \entities\PositionsQuery::create()->findPk($employee['PositionId']);
                // $managers = $position->getCavPositionsUp();
                $managers = $position['CavPositionsUp'];

                if ($managers != null) {
                    $managerPositionIds = explode(",", $managers);
                } else {
                    $managerPositionIds = null;
                }

                $managerPositions = \entities\PositionsQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->filterByPositionId($managerPositionIds)
                    ->find()->toArray();

                $level1Employee = $level2Employee = $level3Employee = "";
                $level1PositionCode = $level2PositionCode = $level3PositionCode = "";
                foreach ($managerPositions as $managerPosition) {
                    if (str_starts_with($managerPosition['PositionCode'], '4')) {
                        $level1Employee = $managerPosition["PositionName"];
                        $level1PositionCode = $managerPosition["PositionCode"];
                        $level1EmployeePositionId = $managerPosition["PositionId"];
                    } elseif (str_starts_with($managerPosition['PositionCode'], '3')) {
                        $level2Employee = $managerPosition["PositionName"];
                        $level2PositionCode = $managerPosition["PositionCode"];
                        $level2EmployeePositionId = $managerPosition["PositionId"];
                    } elseif (str_starts_with($managerPosition['PositionCode'], '2')) {
                        $level3Employee = $managerPosition["PositionName"];
                        $level3PositionCode = $managerPosition["PositionCode"];
                        $level3EmployeePositionId = $managerPosition["PositionId"];
                    }
                }

                $level3 = isset($level3Employee) ? $level3Employee : null;
                $level2 = isset($level2Employee) ? $level2Employee : null;
                $level1 = isset($level1Employee) ? $level1Employee : null;

                $level3Position = isset($level3EmployeePositionId) ? $level3EmployeePositionId : null;
                $level2Position = isset($level2EmployeePositionId) ? $level2EmployeePositionId : null;
                $level1Position = isset($level1EmployeePositionId) ? $level1EmployeePositionId : null;

                if (!empty($employee)) {
                    if ($employee['Status'] != null && $employee['Status'] == 1) {
                        $status = 'Active';
                    } else {
                        // $status = 'In Active';
                        $status = 'Vacant';
                    }
                } else {
                    $status = 'Vacant';
                }

                $terExplode = \entities\TerritoriesQuery::create()->filterByPositionId($position['PositionId'])->select(['TerritoryId'])->findOne();

                if ($terExplode == null) {
                    return;
                }

                $outletsView = \entities\OutletViewQuery::create()
                    ->filterByOutlettypeName('Doctor')
                    ->findByTerritoryId($terExplode);

                $dailyCalls = \entities\DailycallsQuery::create()
                    ->select(['OutletOrgDataId', 'PositionId', 'DcrDate', 'Managers', 'Count'])
                    ->withColumn('count(outlet_org_data_id)', 'Count')
                    ->filterByDcrDate($fromDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByDcrDate($toDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->filterByPositionId($position['PositionId'])
                    // ->filterByEmployeeId($employee['EmployeeId'])
                    ->groupByOutletOrgDataId()
                    ->groupByDcrDate()
                    ->find()->toArray();

                // $mroutletVisitViewCount = \entities\OutletVisitsViewQuery::create()
                //     ->select(['Visit', 'OutletOrgDataId'])
                //     ->withColumn('sum(visits)', 'Visit')
                //     ->filterByMoye($month)
                //     ->filterByTerritoryId($terExplode)
                //     ->filterByPositionId($position['PositionId'])
                //     // ->filterByEmployeeId($employee['EmployeeId'])
                //     ->groupByOutletOrgDataId()
                //     ->find()->toKeyValue('OutletOrgDataId', 'Visit');

                $mroutletVisitViewCount = \entities\DailycallsQuery::create()
                    ->select(['Visit', 'OutletOrgDataId'])
                    ->withColumn('count(outlet_org_data_id)', 'Visit')
                    ->filterByDcrDate($fromDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByDcrDate($toDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->filterByPositionId($position['PositionId'])
                    // ->filterByEmployeeId($employee['EmployeeId'])
                    ->groupByOutletOrgDataId()
                    ->find()->toKeyValue('OutletOrgDataId', 'Visit');

                $mroutletVisitViewDates = \entities\DailycallsQuery::create()
                    ->select(['Dates', 'OutletOrgDataId'])
                    ->withColumn("string_agg(distinct  EXTRACT(DAY FROM dcr_date)::text, ', ')", 'Dates')
                    ->filterByDcrDate($fromDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByDcrDate($toDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->filterByPositionId($position['PositionId'])
                    // ->filterByEmployeeId($employee['EmployeeId'])
                    ->groupByOutletOrgDataId()
                    ->find()->toKeyValue('OutletOrgDataId', 'Dates');
                
                $mrEdetailingCount = \entities\DailycallsQuery::create()
                    ->select(['Visit', 'OutletOrgDataId'])
                    ->withColumn('count(outlet_org_data_id)', 'Visit')
                    ->filterByDcrDate($fromDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByDcrDate($toDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->filterByPositionId($position['PositionId'])
                    ->where("dailycalls.ed_session_id is not null AND dailycalls.ed_session_id != ''")
                    // ->filterByEmployeeId($employee['EmployeeId'])
                    ->groupByOutletOrgDataId()
                    ->find()->toKeyValue('OutletOrgDataId', 'Visit');

                $mrEdetailingDates = \entities\DailycallsQuery::create()
                    ->select(['Dates', 'OutletOrgDataId'])
                    ->withColumn("string_agg(distinct  EXTRACT(DAY FROM dcr_date)::text, ', ')", 'Dates')
                    ->filterByDcrDate($fromDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                    ->filterByDcrDate($toDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                    ->filterByPositionId($position['PositionId'])
                    ->where("dailycalls.ed_session_id is not null AND dailycalls.ed_session_id != ''")
                    // ->filterByEmployeeId($employee['EmployeeId'])
                    ->groupByOutletOrgDataId()
                    ->find()->toKeyValue('OutletOrgDataId', 'Dates');

                if ($level1Position != null) {
                    // $zmOutletVisitViewCount = \entities\OutletVisitsViewQuery::create()
                    //     ->select(['Visit', 'OutletOrgDataId'])
                    //     ->withColumn('sum(visits)', 'Visit')
                    //     ->filterByMoye($month)
                    //     ->filterByTerritoryId($terExplode)
                    //     ->filterByPositionId($level1Position)
                    //     ->groupByOutletOrgDataId()
                    //     ->find()->toKeyValue('OutletOrgDataId', 'Visit');
                    $zmOutletVisitViewCount = \entities\DailycallsQuery::create()
                            ->select(['Visit', 'OutletOrgDataId'])
                            ->withColumn('count(outlet_org_data_id)', 'Visit')
                            ->filterByDcrDate($fromDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByDcrDate($toDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                            ->filterByPositionId($level1Position)
                            ->groupByOutletOrgDataId()
                            ->find()->toKeyValue('OutletOrgDataId', 'Visit');

                    $zmoutletVisitViewDates = \entities\DailycallsQuery::create()
                            ->select(['Dates', 'OutletOrgDataId'])
                            ->withColumn("string_agg(distinct  EXTRACT(DAY FROM dcr_date)::text, ', ')", 'Dates')
                            ->filterByDcrDate($fromDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByDcrDate($toDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                            ->filterByPositionId($level1Position)
                            ->groupByOutletOrgDataId()
                            ->find()->toKeyValue('OutletOrgDataId', 'Dates');
                }

                if ($level2Position != null) {
                    // $rmOutletVisitViewCount = \entities\OutletVisitsViewQuery::create()
                    //     ->select(['Visit', 'OutletOrgDataId'])
                    //     ->withColumn('sum(visits)', 'Visit')
                    //     ->filterByMoye($month)
                    //     ->filterByTerritoryId($terExplode)
                    //     ->filterByPositionId($level2Position)
                    //     ->groupByOutletOrgDataId()
                    //     ->find()->toKeyValue('OutletOrgDataId', 'Visit');
                    $rmOutletVisitViewCount = \entities\DailycallsQuery::create()
                            ->select(['Visit', 'OutletOrgDataId'])
                            ->withColumn('count(outlet_org_data_id)', 'Visit')
                            ->filterByDcrDate($fromDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByDcrDate($toDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                            ->filterByPositionId($level2Position)
                            ->groupByOutletOrgDataId()
                            ->find()->toKeyValue('OutletOrgDataId', 'Visit');
                    
                    $rmoutletVisitViewDates = \entities\DailycallsQuery::create()
                            ->select(['Dates', 'OutletOrgDataId'])
                            ->withColumn("string_agg(distinct  EXTRACT(DAY FROM dcr_date)::text, ', ')", 'Dates')
                            ->filterByDcrDate($fromDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByDcrDate($toDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                            ->filterByPositionId($level2Position)
                            ->groupByOutletOrgDataId()
                            ->find()->toKeyValue('OutletOrgDataId', 'Dates');
                }
                if ($level3Position != null) {
                    // $amOutletVisitViewCount = \entities\OutletVisitsViewQuery::create()
                    //     ->select(['Visit', 'OutletOrgDataId'])
                    //     ->withColumn('sum(visits)', 'Visit')
                    //     ->filterByMoye($month)
                    //     ->filterByTerritoryId($terExplode)
                    //     ->filterByPositionId($level3Position)
                    //     ->groupByOutletOrgDataId()
                    //     ->find()->toKeyValue('OutletOrgDataId', 'Visit');
                    $amOutletVisitViewCount = \entities\DailycallsQuery::create()
                            ->select(['Visit', 'OutletOrgDataId'])
                            ->withColumn('count(outlet_org_data_id)', 'Visit')
                            ->filterByDcrDate($fromDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByDcrDate($toDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                            ->filterByPositionId($level3Position)
                            ->groupByOutletOrgDataId()
                            ->find()->toKeyValue('OutletOrgDataId', 'Visit');

                    $amoutletVisitViewDates = \entities\DailycallsQuery::create()
                            ->select(['Dates', 'OutletOrgDataId'])
                            ->withColumn("string_agg(distinct  EXTRACT(DAY FROM dcr_date)::text, ', ')", 'Dates')
                            ->filterByDcrDate($fromDate, \Propel\Runtime\ActiveQuery\Criteria::GREATER_EQUAL)
                            ->filterByDcrDate($toDate, \Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                            ->filterByPositionId($level3Position)
                            ->groupByOutletOrgDataId()
                            ->find()->toKeyValue('OutletOrgDataId', 'Dates');
                }

                // foreach ($dailyCalls as $dailyCall) {
                //     if ($dailyCall["Managers"] != null) {
                //         $empExpo = explode(',', $dailyCall["Managers"]);
                //         foreach ($empExpo as $mgrs) {

                //             if (!isset($empPositions[$mgrs])) {
                //                 return;
                //             }

                //             $employeePositions = $empPositions[$mgrs];

                //             if ($level3Position == $employeePositions) {
                //                 if (isset($amOutletVisitViewCount[$dailyCall['OutletOrgDataId']])) {
                //                     $amOutletVisitViewCount[$dailyCall['OutletOrgDataId']] += $dailyCall['Count'];
                //                 } else {
                //                     $amOutletVisitViewCount[$dailyCall['OutletOrgDataId']] = $dailyCall['Count'];
                //                 }
                //             }
                //             if ($level2Position == $employeePositions) {
                //                 if (isset($rmOutletVisitViewCount[$dailyCall['OutletOrgDataId']])) {
                //                     $rmOutletVisitViewCount[$dailyCall['OutletOrgDataId']] += $dailyCall['Count'];
                //                 } else {
                //                     $rmOutletVisitViewCount[$dailyCall['OutletOrgDataId']] = $dailyCall['Count'];
                //                 }
                //             }
                //             if ($level1Position == $employeePositions) {
                //                 if (isset($zmOutletVisitViewCount[$dailyCall['OutletOrgDataId']])) {
                //                     $zmOutletVisitViewCount[$dailyCall['OutletOrgDataId']] += $dailyCall['Count'];
                //                 } else {
                //                     $zmOutletVisitViewCount[$dailyCall['OutletOrgDataId']] = $dailyCall['Count'];
                //                 }
                //             }
                //         }
                //     }
                // }

                $topBrandArray = array();
                $topBrands = \entities\RcpaSummaryQuery::create()
                    ->select(['OutletOrgId', 'BrandName'])
                    ->filterBYRcpaMoye($month)
                    ->filterByTerritoryId($terExplode)
                    ->filterByOwn(0, Criteria::GREATER_THAN)
                    ->groupByOutletOrgId()
                    ->groupByBrandName()
                    ->having('sum(rcpa_summary.own) > max(rcpa_summary.min_value)') // TSPC-801
                    ->find()->toArray();

                // foreach ($topBrands as $topBrand) {
                //     if (!array_key_exists($topBrand['OutletOrgId'], $topBrandArray)) {
                //         $topBrandArray[$topBrand['OutletOrgId']] = [];
                //     }
                // }
                foreach ($topBrands as $topBrand) {
                    if (!array_key_exists($topBrand['OutletOrgId'], $topBrandArray)) {
                        $topBrandArray[$topBrand['OutletOrgId']] = [];
                    }
                    if (array_key_exists($topBrand['OutletOrgId'], $topBrandArray)) {
                        array_push($topBrandArray[$topBrand['OutletOrgId']], $topBrand['BrandName']);
                    }
                }
                unset($topBrands);

                // $rcpaDoneArray = array();
                // $rcpaDone = \entities\OutletVisitsViewQuery::create()
                //     ->select(['OutletOrgDataId', 'RcpaDone', 'PositionId'])
                //     ->withColumn('sum(rcpa_done)', 'RcpaDone')
                //     ->filterByMoye($month)
                //     ->groupByOutletOrgDataId()
                //     ->filterByTerritoryId($terExplode)
                //     ->groupByPositionId()
                //     ->find()->toArray();
                // foreach ($rcpaDone as $rcpaDo) {
                //     $rcpaDoneArray[$rcpaDo['OutletOrgDataId'] . '-' . $rcpaDo['PositionId']] = $rcpaDo['RcpaDone'];
                // }
                // unset($rcpaDone);

                $rcpaRetailViewArray = array();
                $rcpaRetailView = \entities\RcpaSummaryQuery::create()
                    ->select(['Own', 'Comp', 'OutletId'])
                    ->withColumn('sum(own)', 'Own')
                    ->withColumn('sum(competition)', 'Comp')
                    ->filterByRcpaMoye($month)
                    ->filterByTerritoryId($terExplode)
                    ->groupByOutletId()
                    ->find()->toArray();
                foreach ($rcpaRetailView as $rcpaRetail) {
                    $rcpaRetailViewArray[$rcpaRetail['OutletId']] = [
                        'Own' => $rcpaRetail['Own'],
                        'Comp' => $rcpaRetail['Comp'],
                    ];
                }
                unset($rcpaRetailView);

                $lastRcpaRetailViewArray = array();
                $lastRcpaRetailView = \entities\RcpaSummaryQuery::create()
                    ->select(['LastOwn', 'LastComp', 'OutletId'])
                    ->withColumn('sum(own)', 'LastOwn')
                    ->withColumn('sum(competition)', 'LastComp')
                    ->filterByRcpaMoye($lastMonth)
                    ->filterByTerritoryId($terExplode)
                    ->groupByOutletId()
                    ->find()->toArray();
                foreach ($lastRcpaRetailView as $lastRcpaRetail) {
                    $lastRcpaRetailViewArray[$lastRcpaRetail['OutletId']] = [
                        'LastOwn' => $lastRcpaRetail['LastOwn'],
                        'LastComp' => $lastRcpaRetail['LastComp'],
                    ];
                }
                unset($lastRcpaRetailView);

                foreach ($outletsView as $outletView) {
                    $rcpaSummary = 0;
                    if (isset($topBrandArray[$outletView->getOutletOrgId()])) {
                        $brandArrayImplode = implode(',', $topBrandArray[$outletView->getOutletOrgId()]);
                        $rcpaSummary = count($topBrandArray[$outletView->getOutletOrgId()]);
                    } else {
                        $brandArrayImplode = null;
                    }

                    if (isset($rcpaRetailViewArray[$outletView->getOutlet_Id()])) {
                        $rcpaRetailCurrent = $rcpaRetailViewArray[$outletView->getOutlet_Id()];
                    } else {
                        $rcpaRetailCurrent = [];
                    }

                    if (isset($lastRcpaRetailViewArray[$outletView->getOutlet_Id()])) {
                        $lastRcpaRetailView = $lastRcpaRetailViewArray[$outletView->getOutlet_Id()];
                    } else {
                        $lastRcpaRetailView = [];
                    }

                    $empTown = $townName;
                    $empFirstName = isset($employee['FirstName']) ? $employee['FirstName'] : '';
                    $empLastName = isset($employee['LastName']) ? $employee['LastName'] : '';

                    $empName = $empFirstName . ' ' . $empLastName;


                    if (isset($geoTowns[$outletView->getItownid()])) {
                        $doctorTown = $geoTowns[$outletView->getItownid()];
                    } else {
                        $doctorTown = "-";
                    }

                    if (isset($mroutletVisitViewCount[$outletView->getOutletOrgId()])) {
                        $mrCallCount = $mroutletVisitViewCount[$outletView->getOutletOrgId()];
                    } else {
                        $mrCallCount = 0;
                    }
                    if (isset($amOutletVisitViewCount[$outletView->getOutletOrgId()])) {
                        $amCallCount = $amOutletVisitViewCount[$outletView->getOutletOrgId()];
                    } else {
                        $amCallCount = 0;
                    }
                    if (isset($rmOutletVisitViewCount[$outletView->getOutletOrgId()])) {
                        $rmCallCount = $rmOutletVisitViewCount[$outletView->getOutletOrgId()];
                    } else {
                        $rmCallCount = 0;
                    }
                    if (isset($zmOutletVisitViewCount[$outletView->getOutletOrgId()])) {
                        $zmCallCount = $zmOutletVisitViewCount[$outletView->getOutletOrgId()];
                    } else {
                        $zmCallCount = 0;
                    }

                    if (isset($mroutletVisitViewDates[$outletView->getOutletOrgId()])) {
                        $mrCallDates = $mroutletVisitViewDates[$outletView->getOutletOrgId()];
                    } else {
                        $mrCallDates = '';
                    }
                    if (isset($amoutletVisitViewDates[$outletView->getOutletOrgId()])) {
                        $amCallDates = $amoutletVisitViewDates[$outletView->getOutletOrgId()];
                    } else {
                        $amCallDates = '';
                    }
                    if (isset($rmoutletVisitViewDates[$outletView->getOutletOrgId()])) {
                        $rmCallDates = $rmoutletVisitViewDates[$outletView->getOutletOrgId()];
                    } else {
                        $rmCallDates = '';
                    }
                    if (isset($zmoutletVisitViewDates[$outletView->getOutletOrgId()])) {
                        $zmCallDates = $zmoutletVisitViewDates[$outletView->getOutletOrgId()];
                    } else {
                        $zmCallDates = '';
                    }
                    if (isset($mrEdetailingDates[$outletView->getOutletOrgId()])) {
                        $mrEdetDates = $mrEdetailingDates[$outletView->getOutletOrgId()];
                    } else {
                        $mrEdetDates = '';
                    }
                    if (isset($mrEdetailingCount[$outletView->getOutletOrgId()])) {
                        $mrEdetCount = $mrEdetailingCount[$outletView->getOutletOrgId()];
                    } else {
                        $mrEdetCount = 0;
                    }

                    $rcpa = 'No';
                    // if (isset($rcpaDoneArray[$outletView->getOutletOrgId() . '-' . $outletView->getPositionId()])) {
                    //     if ($rcpaDoneArray[$outletView->getOutletOrgId() . '-' . $outletView->getPositionId()] > 0) {
                    //         $rcpa = 'Yes';
                    //     }
                    // }
                    if((isset($rcpaRetailCurrent['Own']) && $rcpaRetailCurrent['Own'] > 0) || (isset($rcpaRetailCurrent['Comp']) && $rcpaRetailCurrent['Comp'] > 0)) {
                        $rcpa = 'Yes';
                    }

                    if ($joiningDate != null) {
                        $stToTimeDate = date('d-m-Y', strtotime($joiningDate));
                        $empJoinigDate = $stToTimeDate;
                    } else {
                        $empJoinigDate = null;
                    }
                    if (isset($sgpiSummary[$outletView->getOutletOrgId()])) {
                        // $sgpiRec = [];
                        foreach ($sgpiSummary[$outletView->getOutletOrgId()] as $key => $value) {
                            if ($key == 'samples') {
                                $samplesSGPI = $value;
                            } elseif ($key == 'gifts') {
                                $giftsSGPI = $value;
                            } elseif ($key == 'promo') {
                                $promoSGPI = $value;
                            }
                            // $sgpiRec[] = "$key ($value)";
                        }
                        // $sgpiRec = implode(' ', $sgpiRec);
                    } else {
                        $samplesSGPI = '';
                        $giftsSGPI = '';
                        $promoSGPI = '';
                        // $sgpiRec = "";
                    }

                    $empPositionCode = $position['PositionCode'];
                    $empPositionLevel = '';
                    if (str_starts_with($empPositionCode, '4')) {
                        $empPositionLevel = 'Zone';
                    } elseif (str_starts_with($empPositionCode, '3')) {
                        $empPositionLevel = 'Region';
                    } elseif (str_starts_with($empPositionCode, '2')) {
                        $empPositionLevel = 'Area';
                    } else {
                        $empPositionLevel = 'Territory';
                    }

                    $data = array(
                        'OrgUnit' => isset($orgUnitName) ? $orgUnitName : '',
                        'EmployeeCode' => isset($empCode) && ($status == 'Active') ? $empCode : '',
                        'JoiningDate' => $status == 'Active' ? $empJoinigDate : '',
                        'Level3' => $level3,
                        'Level2' => $level2,
                        'Level1' => $level1,
                        'Location' => $position['PositionName'],
                        'Status' => $status,
                        'EmployeeName' => isset($empName) && ($status == 'Active') ? $empName : '',
                        'DoctorName' => $outletView->getOutletName(),
                        'DoctorCode' => $outletView->getOutletCode(),
                        'Town' => $doctorTown,
                        'Patch' => $outletView->getBeatName(),
                        'Speciality' => $outletView->getClassification(),
                        'Tags' => $outletView->getTags(),
                        'VisitFq' => $outletView->getVisitFq(),
                        'PrescriberClassification' => $rcpaSummary,
                        'TopBrand' => isset($brandArrayImplode) ? $brandArrayImplode : null,
                        'VisitDr' => $mrCallCount . ' (' . $mrCallDates . ')',
                        'AmVisitDr' => $amCallCount . ' (' . $amCallDates . ')',
                        'RmVisitDr' => $rmCallCount . ' (' . $rmCallDates . ')',
                        'ZmVisitDr' => $zmCallCount . ' (' . $zmCallDates . ')',
                        'RcpaDone' => $rcpa,
                        'RCPA-LM-OWN' => isset($lastRcpaRetailView['LastOwn']) ? $lastRcpaRetailView['LastOwn'] : 0,
                        'RCPA-LM-COMP' => isset($lastRcpaRetailView['LastComp']) ? $lastRcpaRetailView['LastComp'] : 0,
                        'RCPA-CM-OWN' => isset($rcpaRetailCurrent['Own']) ? $rcpaRetailCurrent['Own'] : 0,
                        'RCPA-CM-COMP' => isset($rcpaRetailCurrent['Comp']) ? $rcpaRetailCurrent['Comp'] : 0,
                        // 'SGPI' => $sgpiRec,
                        'samplesSGPI' => $samplesSGPI,
                        'giftsSGPI' => $giftsSGPI,
                        'promoSGPI' => $promoSGPI,
                        'level1PositionCode' => $level1PositionCode,
                        'level2PositionCode' => $level2PositionCode,
                        'level3PositionCode' => $level3PositionCode,
                        'EmpPositionCode' => $empPositionCode,
                        'EmpPositionName' => $position['PositionName'],
                        'EmpLevel' => $empPositionLevel,
                        'Month' => $month,
                        'MrEdetailing' => $mrEdetCount . ' (' . $mrEdetDates . ')'
                    );
                    array_push($result, $data);
                }

                $count++;
                $progress = round($count / count($positions) * 100, 0);
                if ($lastPer != $progress) {
                    echo " " . $progress . "% " . PHP_EOL;
                    $lastPer = $progress;
                }
            }
        }

        return $result;
    }

    private function dataExportInsert(){
        $data = $this->dvpReportDump('08-2023');

        $wdvp = new WriteData();
        $wdvp->writeDvp($data);
    }
    
    public function exportEmployeeData()
    {
        $column = ['employee_id','empCode','firstName','LastName','phone','email','designation','position_name','position_code','reporting_to_code','towncode','base_mtarget','branchcode','role_name','org_unit_id','unit_name','grade_name','resi_address','join_date','probation_date','confirmation_date','training_start_date','training_end_date','resign_date','transfer_date','status','last_dcr','territory_code','remark','AM Emp code','AM SAP code','AM position_name','AM HQ','RM Emp code','RM SAP code','RM position_name','RM HQ','ZM Emp code','ZM SAP code','ZM position_name','ZM HQ'];
        $this->addDataToFile($column);
        $employee = \entities\EmployeeQuery::create()
        ->joinWithUsers()
        //->filterByStatus(1)
        ->find()->toArray();
         $data = array();
        
        foreach ($employee as $row) 
        {   
           $this->data['employee_id'] = $row['EmployeeId'];
           $this->data['empCode'] = $row['EmployeeCode'];
           $this->data['firstName'] = $row['FirstName'];
           $this->data['LastName'] = $row['LastName'];
           $this->data['phone'] = $row['Phone'];
           $this->data['email'] = $row['Email'];
           $desg = \entities\DesignationsQuery::create()
                   ->select('Designation')
                   ->filterByDesignationId($row['DesignationId'])->findOne();
                  
           $this->data['designation'] = $desg;
           $pos = \entities\PositionsQuery::create()->filterByPositionId($row['PositionId'])->findOne();
           $this->data['position_name'] = $pos->getPositionName(); 
           $this->data['position_code'] = $pos->getPositionCode();
           if($row['ReportingTo'] != null){
           $pos1 = \entities\PositionsQuery::create()->filterByPositionId($row['ReportingTo'])->findOne();
           $this->data['reporting_to_code'] = $pos1->getPositionCode();
           }
           if($row['Itownid'] != null){
                $geo = \entities\GeoTownsQuery::create()->filterByItownid($row['Itownid'])->findOne()->toArray();
                $this->data['towncode'] = $geo['Stowncode'];
           }else{
            $this->data['towncode']='';
           }
           $this->data['base_mtarget'] = $row['BaseMtarget'];
           $branch = \entities\BranchQuery::create()->filterByBranchId($row['BranchId'])->findOne();
           
           $this->data['branchcode'] = $branch->getBranchcode();
           $role = \entities\RolesQuery::create()->filterByRoleId($row['Userss'][0]['RoleId'])->findOne();
           $this->data['role_name'] = $role->getRoleName();

           $this->data['org_unit_id'] = $row['OrgUnitId'];

           $org = \entities\OrgUnitQuery::create()->filterByOrgunitid($row['OrgUnitId'])->findOne();
           $this->data['unit_name'] = $org->getUnitName();

           $grade = \entities\GradeMasterQuery::create()->filterByGradeid($row['GradeId'])->findOne();
           $this->data['grade_name'] = $grade->getGradeName();

           $this->data['resi_address'] = $row['ResiAddress'];

           $hr_user_dates = \entities\HrUserDatesQuery::create()->filterByEmployeeId($row['EmployeeId'])->findOne()->toArray();
           if(count($hr_user_dates) > 0 )
           {
                $this->data['join_date'] = $hr_user_dates['JoinDate'];
                $this->data['probation_date'] = $hr_user_dates['ProbationDate'];
                $this->data['confirmation_date'] = $hr_user_dates['ConfirmationDate'];
                $this->data['training_start_date'] = $hr_user_dates['TrainingStartDate'];
                $this->data['training_end_date'] = $hr_user_dates['TrainingEndDate'];
                $this->data['resign_date'] = $hr_user_dates['ResignDate'];
                $this->data['transfer_date'] = $hr_user_dates['TransferDate'];
           }
           $this->data['status'] = $row['Status'];

           $lastDCR = DailycallsQuery::create()
           ->select(["EmployeeId"])
           ->withColumn('MAX(dailycalls.dcr_date)', 'LastDCRDate')
           ->addjoin('dailycalls.employee_id', 'attendance.employee_id', Criteria::INNER_JOIN)
           ->where('attendance.status = 1')
           ->where('attendance.attendance_date = dailycalls.dcr_date')
           ->filterByEmployeeId($row['EmployeeId'])
           ->filterByDcrStatus(['completed', 'Reported'])
           ->filterByCompanyId($this->company_id)
           ->groupByEmployeeId()
           ->findOne();

           $lastLeave = LeavesQuery::create()
           ->select(["EmployeeId"])
           ->withColumn('MAX(leaves.leave_date)', 'LastLeaveDate')
           ->addjoin('leaves.leave_request_id', 'leave_request.leave_req_id', Criteria::INNER_JOIN)
           ->where('leave_request.leave_status = 2')
           ->filterByEmployeeId($row['EmployeeId'])
           ->filterByLeavePoints(0, Criteria::LESS_THAN)
           ->filterByLeaveDate(date('Y-m-d'), Criteria::LESS_EQUAL)
           ->groupByEmployeeId()
           ->findOne();
                        
            $lastDCRDate = (!empty($lastDCR) && isset($lastDCR['LastDCRDate']) ? $lastDCR['LastDCRDate'] : '');
            $lastLeaveDate = (!empty($lastLeave) && isset($lastLeave['LastLeaveDate']) ? $lastLeave['LastLeaveDate'] : '');

            if(!empty($lastDCRDate) && !empty($lastLeaveDate) && strtotime($lastLeaveDate) > strtotime($lastDCRDate)) {
            if(strtotime($lastLeaveDate) > time()) {
                $lastWorkingDay = date('d-m-Y');
            } else {
                $lastWorkingDay = date('d-m-Y', strtotime($lastLeaveDate));
            }
            } else {
            $lastWorkingDay = !empty($lastDCRDate) ? date('d-m-Y', strtotime($lastDCRDate)) : '';
            }
       
           $this->data['last_dcr'] = $lastWorkingDay;
         
          $territory = \entities\TerritoriesQuery::create()->select(['TerritoryCode'])->filterByPositionId($row['PositionId'])->findOne();
          $this->data['territory_code'] = $territory;
          $this->data['remark'] = $row['Remark'];
          
          $managers = $pos->getCavPositionsUp();
            if ($managers != null) {
                $managerPositionIds = explode(",", $managers);
            } else {
                $managerPositionIds = null;
            } 
            $managerPositions = \entities\PositionsQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->filterByPositionId($managerPositionIds)
            ->find()->toArray();
            
            $level1employeeCode = $level2employeeCode = $level3employeeCode = "";
            $level3PositionName = $level2PositionName = $level1PositionName = "";
            $level1PositionCode = $level2PositionCode = $level3PositionCode = "";
            $level1Hq = $level2Hq = $level3Hq = "";
            
            foreach ($managerPositions as $managerPosition) 
            {
                if (str_starts_with($managerPosition['PositionCode'], '4')) 
                {//ZM
                    $level1PositionCode = $managerPosition["PositionCode"];
                    $level1PositionName = $managerPosition["PositionName"];
                    $level1EmployeePositionId = $managerPosition["PositionId"];
                    $emp = \entities\EmployeeQuery::create()
                            ->filterByPositionId($level1EmployeePositionId)
                            ->orderByCreatedAt(Criteria::DESC)
                            ->findOne();
                    if($emp != null)
                    {       
                        $level1employeeCode = $emp->getEmployeeCode();
                        if ($emp->getItownid() != null) {
                            $towns = GeoTownsQuery::create()->filterByItownid($emp->getItownid())->findOne();
                            $level1Hq = $towns->getStowncode();
                        }
                    }  
                } 
                elseif (str_starts_with($managerPosition['PositionCode'], '3')) 
                {//RM
                    $level2PositionCode = $managerPosition["PositionCode"];
                    $level2PositionName = $managerPosition["PositionName"];
                    $level2EmployeePositionId = $managerPosition["PositionId"];
                    $emp = \entities\EmployeeQuery::create()
                            ->filterByPositionId($level2EmployeePositionId)
                            ->orderByCreatedAt(Criteria::DESC)
                            ->findOne();
                    if($emp != null){ 
                        $level2employeeCode = $emp->getEmployeeCode();;
                        if ($emp->getItownid() != null) {
                            $towns = GeoTownsQuery::create()->filterByItownid($emp->getItownid())->findOne();
                            $level2Hq = $towns->getStowncode();
                        }
                    }
                } 
                elseif (str_starts_with($managerPosition['PositionCode'], '2')) 
                { //AM
                    $level3PositionCode = $managerPosition["PositionCode"];
                    $level3PositionName = $managerPosition["PositionName"];
                    $level3EmployeePositionId = $managerPosition["PositionId"];
                    $emp = \entities\EmployeeQuery::create()
                            ->filterByPositionId($managerPosition["PositionId"])
                            ->orderByCreatedAt(Criteria::DESC)
                            ->findOne();
                    if($emp != null){ 
                        $level3employeeCode = $emp->getEmployeeCode();;
                        if ($emp->getItownid() != null) {
                            $towns = GeoTownsQuery::create()->filterByItownid($emp->getItownid())->findOne();
                            $level3Hq = $towns->getStowncode();
                        }
                    }
                }
                else{

                }
            }
            $level3employeeCode = isset($level3employeeCode) ? $level3employeeCode : null;
            $level2employeeCode = isset($level2employeeCode) ? $level2employeeCode : null;
            $level1employeeCode = isset($level1employeeCode) ? $level1employeeCode : null;
        
            $level3PositionCode = isset($level3PositionCode) ? $level3PositionCode : null;
            $level2PositionCode = isset($level2PositionCode) ? $level2PositionCode : null;
            $level1PositionCode = isset($level1PositionCode) ? $level1PositionCode : null;

            $level3PositionName = isset($level3PositionName) ? $level3PositionName : null;
            $level2PositionName = isset($level2PositionName) ? $level2PositionName : null;
            $level1PositionName = isset($level1PositionName) ? $level1PositionName : null;

            $level3Hq = isset($level3Hq) ? $level3Hq : null;
            $level2Hq = isset($level2Hq) ? $level2Hq : null;
            $level1Hq = isset($level1Hq) ? $level1Hq : null;

            $this->data['AM Emp code']=$level3employeeCode;
            $this->data['AM SAP code']=$level3PositionCode;
            $this->data['AM position_name']=$level3PositionName;
            $this->data['AM HQ']=$level3Hq;

            $this->data['RM Emp code']=$level2employeeCode;
            $this->data['RM SAP code']=$level2PositionCode;
            $this->data['RM position_name']=$level2PositionName;
            $this->data['RM HQ']=$level2Hq;

            $this->data['ZM Emp code']=$level1employeeCode;
            $this->data['ZM SAP code']=$level1PositionCode;
            $this->data['ZM position_name']=$level1PositionName;
            $this->data['ZM HQ']=$level1Hq;
           
        $this->addDataToFile(array_values($this->data));
        }
        
        return true;

    }

    public function ExportLeaveBalanceData()
    {
        //$columns = ['EmployeeCode','FirstName','LastName','Phone','CreateAt','Position'];
        $columns = ['EmployeeCode','FirstName','LastName','Phone','CreateAt','Position','LeaveYear','LeaveType','Accuration','Opening','Reward','Consumed','Balance','Uniquecode'];
       $this->addDataToFile($columns);

       $data=array();
       $results = \entities\EmployeeLeaveBalanceQuery::create()
       ->find()->toArray();

        foreach ($results as $key => $row) 
        {    $empid = $row['EmployeeId'];
             $emp = \entities\EmployeeQuery::create()
                   // ->leftJoinWithPositionsRelatedByReportingTo()
                    ->filterByEmployeeId($empid)
                    ->find()->toArray();
                foreach($emp as $empldata)
                {    

                    $data['EmployeeCode'] = $empldata['EmployeeCode'];
                    $data['FirstName'] = $empldata['FirstName'];
                    $data['LastName'] = $empldata['LastName'];
                    $data['Phone'] = $empldata['Phone'];
                    $data['CreateAt'] = $empldata['CreatedAt'];
                    $p = \entities\PositionsQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                    ->filterByPositionId($empldata['PositionId'])
                    ->findOne();
                  // print_r($p['PositionName']);die;
                    $data['Position'] = $p['PositionName'];
                    
                } 
                
                $data['LeaveYear'] = $row['LeaveYear'];
                $data['LeaveType'] = $row['LeaveType'];
                $data['Accuration'] = $row['Accuration'];
                $data['Opening'] = $row['Opening'];
                $data['Reward'] = $row['Reward'];
                $data['Consumed'] = $row['Consumed'];
                $data['Balance'] = $row['Balance'];
                $data['Uniquecode'] = $row['Uniquecode'];

                //print_r($data);die;
           $this->addDataToFile(array_values($data));
           //$this->addDataToFile($data);
        }
        return true;
    }

    public function ExportLeaveData($startDate, $endDate, $status)
    {  
       if($status == 1){
        $st = 'Raised_date';
       }
       if($status == 2){
        $st = 'Approved_date';
       }
       if($status == 3){
        $st = 'Reject_date';
       }
       $columns = ['leave_req_id','employee_code','first_name','org_unit_id','unit_name','leave_type','leave_from','leave_to','leave_reason',$st,'leave_status'];
       //print_r($columns);die;
       $this->addDataToFile($columns);

       $data=array();
       $query = \entities\LeaveRequestQuery::create()
        ->joinWithEmployee()
        ->filterByLeaveStatus($status)
        ->find()->toArray();
        foreach($query as $row)
        {  
          $data['leave_req_id'] = $row['LeaveReqId'];
          $data['employee_code'] = $row['Employee']['EmployeeCode'];
          $data['first_name'] = $row['Employee']['FirstName'];
          $data['org_unit_id'] = $row['Employee']['OrgUnitId'];
          $org = \entities\OrgUnitQuery::create()->select(['UnitName'])->filterByOrgunitid( $data['org_unit_id'])->find()->toArray();
          $data['unit_name'] = $org[0];
          $data['leave_type'] = $row['LeaveType'];
          $data['leave_from'] = $row['LeaveFrom'];
          $data['leave_to'] = $row['LeaveTo'];
          $data['leave_reason'] = $row['LeaveReason'];
          if($row['LeaveStatus'] == 1){
            $leaveStatus = 'Applied';
            if($row['CreatedAt'] != null){
            $data['Raised_date']=date('Y-m-d', strtotime($row['CreatedAt']));
            }
          }
          if($row['LeaveStatus'] == 2){
            $leaveStatus = 'Approve';
            if($row['UpdatedAt'] != null){
            $data['Approved_date']=date('Y-m-d',strtotime($row['UpdatedAt']));
            }
          }
          if($row['LeaveStatus'] == 3){
            $leaveStatus = 'Reject';
            if($row['UpdatedAt'] != null){
            $data['Reject_date']=date('Y-m-d',strtotime($row['UpdatedAt']));
            }
          }
          $data['leave_status'] = $leaveStatus;
          
          $this->addDataToFile(array_values($data));
        }
              
           return true;  
    }

    public function ExportCustomerData($startDate, $endDate, $status)
    {  
        $offset=0;
        $columns = ['EmployeeCode','FirstName','LastName','Phone','position_code','ood_itownid','ood_town_code','OutletOrgId' ,'OrgUnitId','Id','OutletCode','OutletOrgCode','TerritoryId','TerritoryName','PositionId','PositionName','BeatId','BeatName','Tags','VisitFq','Comments','OrgPotential','BrandFocus','CustomerFq','OutletName','OutletEmail','OutletSalutation','OutletClassification','Classification','OutletOpening_date','OutletContactName','OutletLandlineno','OutletAltLandlineno','OutletContactBday','OutletContactAnniversary','OutletIsdCode','OutletContactNo','OutletAltContactNo','OutlettypeId','OutlettypeName','OutletPotential','OutletQualification','OutletRegno','OutletMaritalStatus','AddressName','OutletAddress','OutletStreetName','OutletCity','OutletState','OutletCountry','OutletPincode','LastVisitDate','LastVisitEmployee','OutletStatus'];
        $this->addDataToFile($columns);

        $offset = $status*900000;

        $customerdata = \entities\CustomerdataViewQuery::create()
                            ->limit(900000)
                            ->offset($offset)
                            ->find()->toArray();

            
            foreach ($customerdata as $row)
            {
               $this->addDataToFile(array_values($row));  
            }

        return true;
    }

    public function ExportOutletMappingData($startDate, $endDate, $status)
    {
        $offset=0;
        $columns =['MappingId','PricebookId','CategoryType','OutletOrgId','TerritoryId','TerritoryName','OutlettypeName','PrimaryOutletCode','SecondaryOutletCode'];
        $this->addDataToFile($columns);
    
        $offset = $status*900000;
        $outletMapping = \entities\OutletMappingViewQuery::create()
                         ->orderBy('MappingId')->limit(900000)->offset($offset)->find()->toArray();

        foreach($outletMapping  as $view)
        {
             $this->data['MappingId']=$view['MappingId'];
             $this->data['PricebookId']=$view['PricebookId'];
             $this->data['CategoryType']=$view['CategoryType'];
             $this->data['OutletOrgId']=$view['OutletOrgId'];
             $this->data['TerritoryId']=$view['TerritoryId'];
             $this->data['TerritoryName']=$view['TerritoryName'];
             $this->data['OutlettypeName']=$view['OutlettypeName'];
            $primaryOutlet  = \entities\OutletsQuery::create()
                             ->filterById($view['PrimaryOutletId'])->findOne()->toArray();
            $this->data['PrimaryOutletCode'] =   $primaryOutlet['OutletCode'];       
            $secondaryOutlet = \entities\OutletsQuery::create()
                             ->filterById($view['SecondaryOutletId'])->findOne()->toArray(); 
                             
            $this->data['SecondaryOutletCode'] = $secondaryOutlet['OutletCode'];                      
                            
            $this->addDataToFile(array_values($this->data));  
        }

    }

    public function ExportMTPData(){

        $columns = ["mtp_id","month","mtp_status","approved_by","approved_date","created_at","outlets_covered","month_days","working_days",
        "agenda_days","total_outlets","total_visits","visits_fq","position_name","position_code","employee_code","first_name","last_name","org_unit_id","status"];
        $this->addDataToFile($columns);

        $date = date('m-Y');
        $mtp = \entities\MtpQuery::create()
               ->joinWithPositions()
               ->joinWithEmployee()
               ->filterByMonth($date)
               ->find()->toArray();
               
            foreach($mtp as $row)
            {
                $this->data['mtp_id'] = $row['MtpId'];
                $this->data['month'] = $row['Month'];
                $this->data['mtp_status'] = $row['MtpStatus'];
                $this->data['approved_by'] = $row['MtpApprovedBy'];
                $this->data['approved_date'] = $row['ApprovedDate'];
                $this->data['created_at'] = $row['CreatedAt'];
                $this->data['outlets_covered'] = $row['OutletsCovered'];
                $this->data['month_days'] = $row['MonthDays'];
                $this->data['working_days'] = $row['WorkingDays'];
                $this->data['agenda_days'] = json_encode($row['AgendaDays']);
                $this->data['total_outlets'] = json_encode($row['TotalOutlets']);
                $this->data['total_visits'] = $row['TotalVisits'];
                $this->data['visits_fq'] = $row['VisitsFq'];
                
                $this->data['position_name'] = $row['Positions']['PositionName']; 
                $this->data['position_code'] = $row['Positions']['PositionCode'];

                $this->data['EmployeeCode'] = $row['Employee']['EmployeeCode'];
                $this->data['FirstName'] = $row['Employee']['FirstName'];
                $this->data['LastName'] = $row['Employee']['LastName'];
                $this->data['org_unit_id'] = $row['Employee']['OrgUnitId'];
                $this->data['status'] = $row['Employee']['Status'];


                $this->addDataToFile(array_values($this->data)); 
                
            }   
        return true;
    }

    private function exportBrandCampaignData($startDate, $endDate) {
        $columns = ['bu_name', 'zm_manager_branch', 'zm_manager_town', 'rm_manager_branch', 'rm_manager_town', 'am_manager_branch', 'am_manager_town', 'emp_position_name', 'emp_branch', 'employee_code', 'emp_name', 'edetailing_time', 'campiagn_name', 'focus_brands', 'campaign_start_date', 'campaign_end_date', 'outlet_tags', 'outlet_name', 'outlet_code', 'outlet_org_code', 'outlet_classification', 'step_number', 'sgpi_to_be_given', 'visited_date', 'visited_month', 'sgpi_given', 'lm_own_RCPA_for_focus_brands', 'cm_own_RCPA_for_focus_brands', 'zm_position_code', 'rm_position_code', 'am_position_code', 'emp_position_code'];
        $this->addDataToFile($columns);

        $data = ExportBrandCampaignQuery::create()
                    ->setFormatter('Propel\Runtime\Formatter\OnDemandFormatter')
                    // ->where('DATE(export_brand_campaign.campaign_start_date) >= ? ', $startDate)
                    // ->where('DATE(export_brand_campaign.campaign_end_date) < ? ', $endDate)
                    ->find();

        foreach ($data as $key => $row) {
            $row = $row->toArray();
            $this->checkManagersAccordingsToPosition($row);
            $data = $this->getDataForBrandCampaign($row);
            $this->addDataToFile(array_values($data));
        }

        return true;
    }

    private function getDataForBrandCampaign($row) {
        $lmOwnRCPAForFocusBrands = $cmOwnRCPAForFocusBrands = 0;
        $focusBrandIds = explode(',', $row['FocusBrandIds']);
        
        if(!empty($row['VisitedDate']) && count($focusBrandIds) > 0) {
            $lastMonth = date('m-Y', strtotime($row['VisitedDate']));
            $currentMonth = date('m-Y', strtotime($row['VisitedDate']));

            $lastMonthRcpaSummary = \entities\RcpaSummaryQuery::create()
                                        ->select(['Own', 'Comp'])
                                        ->withColumn('sum(own)', 'Own')
                                        ->withColumn('sum(competition)', 'Comp')
                                        ->filterByRcpaMoye($lastMonth)
                                        ->filterByOutletOrgId($row['OutletOrgDataId'])
                                        ->filterByBrandId($focusBrandIds)
                                        ->find()->toArray();

            $currentMonthRcpaSummary = \entities\RcpaSummaryQuery::create()
                                        ->select(['Own', 'Comp'])
                                        ->withColumn('sum(own)', 'Own')
                                        ->withColumn('sum(competition)', 'Comp')
                                        ->filterByRcpaMoye($currentMonth)
                                        ->filterByOutletOrgId($row['OutletOrgDataId'])
                                        ->filterByBrandId($focusBrandIds)
                                        ->find()->toArray();
            
            $lmOwnRCPAForFocusBrands = isset($lastMonthRcpaSummary['Own']) && $lastMonthRcpaSummary['Own'] > 0 ? $lastMonthRcpaSummary['Own'] : 0;
            $cmOwnRCPAForFocusBrands = isset($currentMonthRcpaSummary['Own']) && $currentMonthRcpaSummary['Own'] > 0 ? $currentMonthRcpaSummary['Own'] : 0;
        }
        
        $data = [];
        $data[] = $row['BuName'];
        $data[] = $row['ZmManagerBranch'];
        $data[] = $row['ZmManagerTown'];
        $data[] = $row['RmManagerBranch'];
        $data[] = $row['RmManagerTown'];
        $data[] = $row['AmManagerBranch'];
        $data[] = $row['AmManagerTown'];
        $data[] = $row['EmpPositionName'];
        $data[] = $row['EmpBranch'];
        $data[] = $row['EmployeeCode'];
        $data[] = $row['EmployeeName'];
        $data[] = $row['EdDuration'];
        $data[] = $row['CampiagnName'];
        $data[] = $row['FocusBrands'];
        $data[] = $row['CampaignStartDate'];
        $data[] = $row['CampaignEndDate'];
        $data[] = $row['OutletTags'];
        $data[] = $row['OutletName'];
        $data[] = $row['OutletCode'];
        $data[] = $row['OutletOrgCode'];
        $data[] = $row['OutletClassification'];
        $data[] = $row['StepNumber'];
        $data[] = $row['SgpiToBeGiven'];
        $data[] = $row['VisitedDate'];
        $data[] = $row['VisitedMonth'];
        $data[] = $row['SgpiGiven'];
        $data[] = $lmOwnRCPAForFocusBrands;
        $data[] = $cmOwnRCPAForFocusBrands;
        $data[] = $row['ZmPositionCode'];
        $data[] = $row['RmPositionCode'];
        $data[] = $row['AmPositionCode'];
        $data[] = $row['EmpPositionCode'];

        return $data;
    }

    private function exportExpenseHoCompilationData($startDate, $endDate) {
        $columns = ['bu_name', 'zm_position_code', 'zm_position_name', 'rm_position_code', 'rm_position_name', 'am_position_code', 'am_position_name', 'emp_position_code', 'emp_position_name', 'emp_level', 'employee_id', 'employee_code', 'employee_name', 'emp_town', 'emp_branch', 'designation', 'grade', 'emp_status', 'unique_code', 'month', 'total', 'HQDA1/2190', 'ADM_EXHQDA/2195', 'ADM_TOTAL_OSDA/2200', 'Event Allowance1/2440', 'ADM_Total_Fare/2205', 'CONVEYANCE_ALLOW/2215', 'TOTAL1', 'NCA', 'FDW', 'HQ', 'EX HQ', 'OS', 'LOS', 'expense_status', 'last_submitted_date', 'last_approved_date', 'last_audited_date', 'diff_in_days_of_approval', 'paid_status', 'lot_no', 'transaction_id', 'paid_amount', 'remark'];
        $this->addDataToFile($columns);
        $expMonth = date('m-Y', strtotime($startDate));

        $data = ExportExpensesSummaryQuery::create()
                    ->where('export_expenses_summary.month = ?', date('Y-m-01', strtotime($startDate)))
                    ->orderByEmployeeId()
                    ->find()
                    ->toArray();
        
        foreach($data as $row) {
            $position = \entities\PositionsQuery::create()->findPk($row['PositionId']);
            $level1PositionName = $level2PositionName = $level3PositionName = "";
            $level1PositionCode = $level2PositionCode = $level3PositionCode = "";
            $lastAuditedDate = $lastApprovedDate = $lastSubmittedDate = "";
            $employeePayment = $this->getExpensePaymentRecordByEmployeeIdFromArray($row['EmployeeId'], $expMonth);

            if(!empty($position)) {
                $managers = $position->getCavPositionsUp();

                if ($managers != null) {
                    $managerPositionIds = explode(",", $managers);
                } else {
                    $managerPositionIds = null;
                }

                $managerPositions = \entities\PositionsQuery::create()
                                        ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
                                        ->filterByPositionId($managerPositionIds)
                                        ->find()->toArray();

                // set Positions
                foreach ($managerPositions as $managerPosition) {
                    if (str_starts_with($managerPosition['PositionCode'], '4')) {
                        $level1PositionName = $managerPosition["PositionName"];
                        $level1PositionCode = $managerPosition["PositionCode"];
                    } elseif (str_starts_with($managerPosition['PositionCode'], '3')) {
                        $level2PositionName = $managerPosition["PositionName"];
                        $level2PositionCode = $managerPosition["PositionCode"];
                    } elseif (str_starts_with($managerPosition['PositionCode'], '2')) {
                        $level3PositionName = $managerPosition["PositionName"];
                        $level3PositionCode = $managerPosition["PositionCode"];
                    }
                }
            }

            if($row['ExpenseStatus'] == 'Created') {
                $row['ExpenseStatus'] = 'Draft';
            } elseif($row['ExpenseStatus'] == 'Submit') {
                $row['ExpenseStatus'] = 'Submitted';
            } elseif($row['ExpenseStatus'] == 'Approved') {
                $row['ExpenseStatus'] = 'Workflow';
            } elseif($row['ExpenseStatus'] == 'Proceed for Payment') {
                $row['ExpenseStatus'] = 'Proceed for Payment';
            }

            $startofMonth = date('Y-m-01', strtotime($startDate));
            $endofMonth = date('Y-m-t', strtotime($startDate));
            $ncaCount = $fwCount = $hqCount = $exHQCount = $osCount = $losCount = 0;

            $lastDates = $this->getExpenseLastDates($row['EmployeeId'], $startofMonth, $endofMonth);
            $lastAuditedDate = $lastDates['LastAuditedDate'];
            $lastApprovedDate = $lastDates['LastApprovedDate'];
            $lastSubmittedDate = $lastDates['LastSubmittedDate'];

            $dailyCalls = \entities\DailycallsQuery::create()
                            ->select(['Agendacontroltype', 'DcrDates'])
                            ->withColumn("string_agg(distinct dcr_date::text, ', '::text)", 'DcrDates')
                            ->filterByEmployeeId($row['EmployeeId'])
                            ->filterByDcrDate($startofMonth, Criteria::GREATER_EQUAL)
                            ->filterByDcrDate($endofMonth, Criteria::LESS_EQUAL)
                            ->groupByAgendacontroltype()
                            ->find()
                            ->toKeyValue('Agendacontroltype','DcrDates');

            $expenses = \entities\ExpensesQuery::create()
                            ->select(['TripType', 'count'])
                            ->withColumn("count(distinct expense_date)", 'count')
                            ->filterByEmployeeId($row['EmployeeId'])
                            ->filterByExpenseDate($startofMonth, Criteria::GREATER_EQUAL)
                            ->filterByExpenseDate($endofMonth, Criteria::LESS_EQUAL)
                            ->groupByTripType()
                            ->find()
                            ->toKeyValue('TripType','count');

            $fWArr = isset($dailyCalls['FW']) ? explode(', ', $dailyCalls['FW']) : [];
            $ncaArr = isset($dailyCalls['NCA']) ? explode(', ', $dailyCalls['NCA']) : [];
            $halfNca = array_intersect($ncaArr, $fWArr);
            $halfNca = count($halfNca) * 0.5;
            $fwCount = count($fWArr) - $halfNca;
            $ncaCount = count($ncaArr) - $halfNca;
            $hqCount = isset($expenses['HQ']) ? $expenses['HQ'] : 0;
            $exHQCount = isset($expenses['EX-HQ']) ? $expenses['EX-HQ'] : 0;
            $osCount = isset($expenses['OS']) ? $expenses['OS'] : 0;
            $losCount = isset($expenses['LOS']) ? $expenses['LOS'] : 0;
            $paidStatus = isset($employeePayment['PaidStatus']) ? $employeePayment['PaidStatus'] : '';
            $lotNo = isset($employeePayment['LotNo']) ? $employeePayment['LotNo'] : '';
            $transactionId = isset($employeePayment['TransactionId']) ? $employeePayment['TransactionId'] : '';
            $paidAmount = isset($employeePayment['PaidAmount']) ? $employeePayment['PaidAmount'] : '';
            $remark = isset($employeePayment['Remark']) ? $employeePayment['Remark'] : '';

            $tempRow = [
                $row['BuName'],
                $level1PositionCode,
                $level1PositionName,
                $level2PositionCode,
                $level2PositionName,
                $level3PositionCode,
                $level3PositionName,
                $row['EmpPositionCode'],    
                $row['EmpPositionName'],
                $row['EmpLevel'],
                $row['EmployeeId'],
                $row['EmployeeCode'],
                $row['EmployeeName'],
                $row['EmpTown'],
                $row['EmpBranch'],
                $row['Designation'],
                $row['Grade'],
                $row['Status'] ? 'Active' : 'Terminated',
                $row['Uniqueid'],
                date('m-Y', strtotime($row['Month'])),
                round(floatval($row['ApprovedAmount'])),
                round(floatval($row['FinalDaHqAmount'])),
                round(floatval($row['FinalDaExHqAmount'])),
                (round(floatval($row['FinalDaTransitAmount'])) + round(floatval($row['FinalDaOsAmount'])) + round(floatval($row['FinalDaLastDayOsAmount'])) + round(floatval($row['FinalHillAllowanceAmount'])) + round(floatval($row['FinalRmLodgingAndFoodAmount'])) + round(floatval($row['FinalZmLodgingAndFoodAmount'])) + round(floatval($row['Final_own_stay_amount']))),
                round(floatval($row['FinalEventAmount'])),
                (round(floatval($row['FinalTaAmount'])) + round(floatval($row['FinalOsPetrolAllowanceAmount'])) + round(floatval($row['FinalIsbtAmount'])) + round(floatval($row['FinalIlpAmount'])) + round(floatval($row['FinalHqPetrolAllowanceAmount'])) + round(floatval($row['FinalZmLocalConveyanceAmount'])) + round(floatval($row['FinalRmLocalConveyanceAmount'])) + round(floatval($row['FinalOtherZmLocalConveyanceAmount'])) + round(floatval($row['FinalOtherOsPetrolAllowanceAmount'])) + round(floatval($row['FinalOtherRmLocalConveyanceAmount']))),
                (round(floatval($row['FinalInternetBillAmount'])) + round(floatval($row['FinalMrConveyanceAmount'])) + round(floatval($row['FinalAmConveyanceAmount'])) + round(floatval($row['FinalHandsetAmount'])) + round(floatval($row['FinalRmMobileBillAmount'])) + round(floatval($row['FinalZmMobileBillAmount'])) + round(floatval($row['FinalStationeryAmount']))),
                round(floatval($row['FinalAmount'])),
                $ncaCount,
                $fwCount,
                $hqCount,
                $exHQCount,
                $osCount,
                $losCount,
                $row['ExpenseStatus'],
                $lastSubmittedDate,
                $lastApprovedDate,
                $lastAuditedDate,
                round((strtotime($lastAuditedDate) - strtotime($lastApprovedDate)) / (60 * 60 * 24)),
                $paidStatus,
                $lotNo,
                $transactionId,
                $paidAmount,
                $remark
            ];

            $this->addDataToFile($tempRow);

            unset($tempRow);
        }
    }

    private function getExpenseLastDates($employeeId, $monthStartDate, $monthEndDate) {
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

        return [
            'LastSubmittedDate' => !empty($LastSubmittedDate) ? date('d-m-Y', strtotime($LastSubmittedDate)) : '',
            'LastApprovedDate' => !empty($LastApprovedDate) ? date('d-m-Y', strtotime($LastApprovedDate)) : '',
            'LastAuditedDate' => !empty($LastAuditedDate) ? date('d-m-Y', strtotime($LastAuditedDate)) : '',
        ];
    }
}