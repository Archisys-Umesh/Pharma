<?php

namespace BI\manager;

use BI\requests\TourPlanRequest;
use DateTime;
use entities\BeatsQuery;
use entities\Dayplan;
use entities\DayplanQuery;
use entities\EmployeeQuery;
use entities\GeoTownsQuery;
use entities\HolidaysQuery;
use entities\LeavesQuery;
use entities\Mtp;
use entities\MtpDay;
use entities\MtpDayQuery;
use entities\MtpLogsQuery;
use entities\MtpQuery;
use entities\OutletViewQuery;
use entities\TerritoriesQuery;
use entities\TerritoryTownsQuery;
use entities\Tourplans;
use entities\TourplansQuery;
use Exception;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 * Description of MTP Manager
 *
 * @author Chintan
 */
class MTPManager
{
    public static function getMonths($startMonth, $allowedMonths)
    {
        $monthList = [];

        for ($i = 0; $i < $allowedMonths; $i++) {
            $index = $startMonth + $i;
            $time = strtotime(date('Y-m-01') . "$index month");
            $month_start = date('m-Y', $time);

            $monthList[$month_start] = date('M-Y', $time);
        }

        return $monthList;
    }

    public function createMTP($emp_id, $month, $year)
    {
        if ($month == 13) {
            $month = 01;
            $year += 1;
        }
        $employee = EmployeeQuery::create()->findPk($emp_id);
        $currentMonth = date('m');
        $currentYear = date('Y');
        if ($this->checkMTPExists($employee->getPositionId(), $currentMonth, $currentYear) == false) {
            $mtp = new Mtp();
            $mtp->setPositionId($employee->getPositionId());
            $mtp->setMonth(sprintf("%02d", $currentMonth) . "-" . $currentYear);
            $mtp->setCompanyId($employee->getCompanyId());
            // $mtp->setMtpStatus("draft");
            $mtp->setMtpStatus("processing"); // TSPC-1152
            $mtp->save();
            $this->genrateMTPDays($mtp->getPrimaryKey(), $emp_id);
        }

        if ($this->checkMTPExists($employee->getPositionId(), $month, $year)) {
            throw new \Exception("MTP Exists", 400);
        }
        $mtp = new Mtp();
        $mtp->setPositionId($employee->getPositionId());
        $mtp->setMonth(sprintf("%02d", $month) . "-" . $year);
        $mtp->setCompanyId($employee->getCompanyId());
        // $mtp->setMtpStatus("draft");
        $mtp->setMtpStatus("processing"); // TSPC-1152
        $mtp->save();
        $this->genrateMTPDays($mtp->getPrimaryKey(), $emp_id);
        return $mtp;

    }


    public function resetMTP($mtpId, $emp_id)
    {
        $mtp = MtpQuery::create()->findPk($mtpId);
        if ($mtp->getMtpStatus() == "draft" || $mtp->getMtpStatus() == "rejected") {
            $tourplans = TourplansQuery::create()->filterByMtpId($mtpId)->find()->delete();
            $mtpday = MtpDayQuery::create()->filterByMtpId($mtpId)->find()->delete();

            $mtp->setOutletsCovered(0);
            $mtp->setAgendaDays(null);
            $mtp->setTotalOutlets(null);
            $mtp->setTotalVisits(0);
            $mtp->setVisitsFq(0);
            $mtp->save();

            $this->genrateMTPDays($mtpId, $emp_id);
            return $mtp;
        } else {
            throw new Exception("MTP Status is " . $mtp->getMtpStatus() . " cannot reset", 400);
        }

    }

    public function checkMTPExists($position_id, $month, $year)
    {

        $monthStr = sprintf("%02d", $month) . "-" . $year;
        $mtp = MtpQuery::create()
            ->filterByPositionId($position_id)
            ->filterByMonth($monthStr)
            ->findOne();

        if ($mtp != null) {
            return true;
        } else {
            return false;
        }
    }

    public function getMTPList($emp_id)
    {
        $employee = EmployeeQuery::create()->findPk($emp_id);
        $mtp = MtpQuery::create()
            ->leftJoinWithEmployee()
            ->filterByPositionId($employee->getPositionId())
            ->orderByMtpId('DESC')
            ->limit(12)
            ->find();
        return $mtp;
    }

    public function addTourPlan()
    {

    }

    public function getMTPById($mtp_id): Mtp
    {
        $mtp = MtpQuery::create()
            ->filterByMtpId($mtp_id)->findOne();

        return $mtp;
    }

    public function getMTPLogByMTPId($mtp_id, $last_log_id = 0) {
        $logs = MtpLogsQuery::create()
                    ->select(['MtpLogId', 'MtpId', 'LogFunction', 'LogDescription', 'CompanyId', 'CreatedAt'])
                    ->filterByMtpId($mtp_id)
                    ->filterByMtpLogId($last_log_id, Criteria::GREATER_THAN)
                    ->find();

        return $logs;
    }

    public function getMtpLogById($log_id) {
        $logs = MtpLogsQuery::create()
                    ->select(['MtpLogId', 'MtpId', 'LogFunction', 'LogDescription', 'CompanyId', 'CreatedAt'])
                    ->filterByMtpLogId($log_id)
                    ->findOne();

        return $logs;
    }

    public function getDayBlocks($moye, $position_id)
    {
        $employee = EmployeeQuery::create()
            ->filterByPositionId($position_id)
            ->filterByStatus(1)
            ->findOne();
        if ($employee == null) {
            return [];
        }
        $moye = explode("-", $moye);
        $month = $moye[0];
        $year = $moye[1];

        $startDate = date($year . '-' . $month . '-01'); // Start Date
        $endDate = date($year . '-' . $month . '-t'); // End Date

        $holidays = HolidaysQuery::create()
            ->select(['HolidayDate'])
            ->filterByIstateid($employee->getBranch()->getIstateid())
            ->filterByHolidayDate($startDate, Criteria::GREATER_EQUAL)
            ->filterByHolidayDate($endDate, Criteria::LESS_EQUAL)
            ->find()->toArray();
        $leaves = LeavesQuery::create()
            ->select(['LeaveDate'])
            ->filterByEmployeeId($employee->getPrimaryKey())
            ->filterByLeaveDate($startDate, Criteria::GREATER_EQUAL)
            ->filterByLeaveDate($endDate, Criteria::LESS_EQUAL)
            ->filterByLeavePoints(0, Criteria::LESS_THAN)
            ->find()->toArray();

        $daysBlocked = array_merge($holidays, $leaves);

        return $daysBlocked;
    }

    public function genrateMTPDays($mtp_id, $emp_id)
    {
        $mtp = MtpQuery::create()->findPk($mtp_id);

        $moye = $mtp->getMonth();
        $dates = $this->getMTPDays($moye, $emp_id);

        $blockedDates = $this->getDayBlocks($moye, $mtp->getPositionId());

        $data = [];
        foreach ($dates as $d) {

            if (in_array($d["date"], $blockedDates)) {
                continue;
            }

            $mtpdate = \entities\MtpDayQuery::create()
                            ->filterByMtpId($mtp_id)
                            ->filterByMtpDayDate($d["date"])
                            ->findOne();
            if($mtpdate == null){
                $mtpdate = new MtpDay();
                $mtpdate->setMtpDayDate($d["date"]);
                $mtpdate->setWeekday($d["weekday"]);
                $mtpdate->setWeeknumber($d["weekNumber"]);
                $mtpdate->setMtpdayRemark($d["DayName"]);
                $mtpdate->setMtpId($mtp_id);
                $mtpdate->setCompanyId($mtp->getCompanyId());
                $mtpdate->setIshalfday(0);
                $mtpdate->save();
            }
        }

        $mtp->setMonthDays(count($dates));
        $mtp->setWorkingDays(count($dates) - count($blockedDates));

        $terrID = OrgManager::getMyTerritoriesByPosition($mtp->getPositionId());

        $total_outlets = OutletViewQuery::create()
            ->withColumn('COUNT(*)', 'Count')
            ->select(array('OutlettypeName', 'Count'))
            ->groupByOutlettypeName()
            ->filterByTerritoryId($terrID)
            ->find()->toArray();

        $mtp->setTotalOutlets(json_encode($total_outlets));

        $TotalVisitFq = OutletViewQuery::create()
            ->withColumn('sum(visit_fq)', 'TotalVisitFq')
            ->select(array('TotalVisitFq'))
            ->filterByTerritoryId($terrID)
            ->find()->toArray();

        if ($TotalVisitFq != null) {
            $mtp->setVisitsFq($TotalVisitFq[0]);
        }

        $mtp->save();

    }

    public function getMTPDays($moye, $emp_id)
    {

        $moye = explode("-", $moye);

        $month = $moye[0];
        $year = $moye[1];

        $dates = [];

        $date = date($year . '-' . $month . '-01'); //Current Month Year

        $daysinMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        for ($i = 0; $i < $daysinMonth; $i++) {

            $day = date("Y-m-d", strtotime("+$i day", strtotime($date)));

            $currentDate = DateTime::createFromFormat("Y-m-d", $day);

            if ($currentDate->format("N") == 7) // Sunday
            {
                continue;
            }

            $leaveDates = [];

            $leaves = LeavesQuery::create()
                ->select(["LeaveDate"])
                ->filterByEmployeeId($emp_id)
                ->filterByLeaveDate($currentDate, Criteria::GREATER_EQUAL)
                ->filterByLeaveDate($currentDate, Criteria::LESS_EQUAL)
                ->filterByLeavePoints(0, Criteria::LESS_THAN)
                ->findOne();

            if ($leaves == $currentDate->format('Y-m-d')) {
                continue;
            }

            $weekofMonth = $this->getWeekOfMonth($currentDate);
            $dates[] = [
                "date" => $day,
                "weekday" => $currentDate->format("N"),
                "weekNumber" => $weekofMonth,
                "DayName" => $currentDate->format("D"),
            ];

        }

        return $dates;
    }

    function getWeekOfMonth(DateTime $date)
    {
        $firstDayOfMonth = new DateTime($date->format('Y-m-1'));

        return ceil(($firstDayOfMonth->format('N') + $date->format('j') - 1) / 7);
    }

    function getBeats($territory_id, $agendaControlType)
    {
        $beats = [0 => "JW"];
        if ($agendaControlType != "JW") {
            $beats = BeatsQuery::create()
                ->findByTerritoryId($territory_id)
                ->toKeyValue("BeatId", "BeatName");
        }
        return $beats;
    }

    function getTowns($territory_id)
    {
        $towns = TerritoryTownsQuery::create()
            ->joinWithGeoTowns()
            ->findByTerritoryId($territory_id);
        $townArray = [];
        foreach ($towns as $t) {
            $townArray[$t->getItownid()] = $t->getGeoTowns()->getStownname();
        }
        return $townArray;

    }

    function getCustomersByBeat($beat_id)
    {
        $customerList = OutletViewQuery::create()->findByBeatId($beat_id);

        $Custarray = [];

        foreach ($customerList as $cust) {
            $town = GeoTownsQuery::create()
                ->filterByItownid($cust->getItownid())
                ->findOne();
//            var_dump($cust);exit;

            $Custarray[] = $cust;
//            $Custarray[$cust->getPrimaryKey()] = $cust->getOutletName()." | VFQ: ".$cust->getVisitFq()." | Tags: ".$cust->getTags()." |  BeatName: ".$cust->getBeatName()." |  Town: ".$town->getStownname();
        }

        return $Custarray;

    }

    function getCustomerForJW($date, $terrID)
    {
        $territory = TerritoriesQuery::create()->findPk($terrID);

        $OutletOrgDataId = TourplansQuery::create()
            ->select(["OutletOrgDataId"])
            ->filterByTpDate($date)
            ->filterByPositionId($territory->getPositionId())
            ->filterByAgendacontroltype("FW")
            ->find()->toArray();

        $customerList = OutletViewQuery::create()->findByOutletOrgId($OutletOrgDataId);

        $Custarray = [];

        foreach ($customerList as $cust) {
            $town = GeoTownsQuery::create()
                ->filterByItownid($cust->getItownid())
                ->findOne();

            $Custarray[] = $cust;

//            $Custarray[$cust->getPrimaryKey()] = $cust->getOutletName() . " |  BeatName: " . $cust->getBeatName() . " | VFQ: " . $cust->getVisitFq() . " | Tags: " . $cust->getTags() . " | Beat :" . $cust->getBeatName() . " |  Town: " . $town->getStownname();
        }

        return $Custarray;

    }

    function genrateDayPlan($mtp_id)
    {

        // $dates = MtpDayQuery::create()->findByMtpId($mtp_id);

        // foreach ($dates as $d) {
        //     // Empty Day Plan
        //     DayplanQuery::create()
        //         ->filterByTpId(0, Criteria::GREATER_THAN)
        //         ->filterByMtpDayId($d->getPrimaryKey())->delete();
        // }

        // Chirag Patel - Change one query to remove all day planed instead of loop.
        $dates = MtpDayQuery::create()->select('MtpDayId')->findByMtpId($mtp_id)->toArray();
        DayplanQuery::create()
            ->filterByTpId(0, Criteria::GREATER_THAN)
            ->filterByMtpDayId($dates)->delete();

        $tourplans = TourplansQuery::create()->filterByMtpId($mtp_id)->find();

        foreach ($tourplans as $tp) {
            $dayplan = new Dayplan();

            $dayplan->setTpDate($tp->getTpDate());
            $dayplan->setTpId($tp->getTpId());
            $dayplan->setCompanyId($tp->getCompanyId());
            $dayplan->setPositionId($tp->getPositionId());
            $dayplan->setAgendacontroltype($tp->getAgendacontroltype());
            $dayplan->setBeatId($tp->getBeatId());
            $dayplan->setItownid($tp->getItownid());
            $dayplan->setAgendaId($tp->getAgendaId());
            $dayplan->setIsjw($tp->getIsjw());
            $dayplan->setOutletOrgDataId($tp->getOutletOrgDataId());
            $dayplan->setMtpDayId($tp->getMtpDayId());
            $dayplan->setStatus("pending");
            $dayplan->setCampaignVisitPlanId($tp->getCampaignVisitPlanId());
            $dayplan->save();
        }

    }

    public function updateMTPStats($mtp_id)
    {
        $fw = 0;
        $nca = 0;

        $fieldWorkDates = TourplansQuery::create()
            ->select('tp_date')
            ->distinct()
            ->filterByAgendacontroltype('FW')
            ->filterByMtpId($mtp_id)
            ->find()->toArray();

        $ncaWorkDates = TourplansQuery::create()
            ->select('tp_date')
            ->distinct()
            ->filterByAgendacontroltype('NCA')
            ->filterByMtpId($mtp_id)
            ->find()->toArray();

        $fwNcaDates = array_intersect($fieldWorkDates, $ncaWorkDates);
        $fwDates = array_diff($fieldWorkDates, $fwNcaDates);
        $ncaDates = array_diff($ncaWorkDates, $fwNcaDates);

        $fw = (0.5 * count($fwNcaDates)) + count($fwDates);
        $nca = (0.5 * count($fwNcaDates)) + count($ncaDates);

        // Chirag Patel - Optimized

        // $agend = TourplansQuery::create()
        //     ->select('tp_date')
        //     ->groupByTpDate()
        //     ->filterByMtpId($mtp_id)
        //     ->find()->toArray();

        // foreach ($agend as $a) {
        //     $fieldWork = TourplansQuery::create()
        //         ->filterByAgendacontroltype('FW')
        //         ->filterByTpDate($a)
        //         ->filterByMtpId($mtp_id)
        //         ->find()
        //         ->toArray();

        //     $ncaWork = TourplansQuery::create()
        //         ->filterByAgendacontroltype('NCA')
        //         ->filterByTpDate($a)
        //         ->filterByMtpId($mtp_id)
        //         ->find()
        //         ->toArray();

        //     if (count($fieldWork) > 0 && count($ncaWork) > 0) {
        //         $fw += 0.5;
        //         $nca += 0.5;
        //     } elseif (count($fieldWork) > 0) {
        //         $fw += 1;
        //     } elseif (count($ncaWork) > 0) {
        //         $nca += 1;
        //     }
        // }

        // Chirag Patel - Not being used so commentted
        // $agendaDays = TourplansQuery::create()
        //     ->withColumn('COUNT(*)', 'Count')
        //     ->select(array('Agendacontroltype', 'Count'))
        //     ->groupByAgendacontroltype()
        //     ->filterByMtpId(70)
        //     ->find()->toArray();

        $agendas = [
            [
                'Count' => $nca,
                'Agendacontroltype' => 'NCA',
            ],
            [
                'Count' => $fw,
                'Agendacontroltype' => 'FW',
            ],
        ];

        $tourplans = TourplansQuery::create()
            ->joinWithOutletOrgData()
            ->filterByMtpId($mtp_id)
            ->find();

        $outletsConvered = [];
        $FqDeduction = [];
        $totalVistis = 0;

        foreach ($tourplans as $tp) {
            if (!in_array($tp->getOutletOrgDataId(), $outletsConvered)) {
                $outletsConvered[] = $tp->getOutletOrgDataId();
            }

            if (!isset($FqDeduction[$tp->getOutletOrgDataId()])) {
                $FqDeduction[$tp->getOutletOrgDataId()] = $tp->getOutletOrgData()->getVisitFq();
            }

            $FqDeduction[$tp->getOutletOrgDataId()] = $FqDeduction[$tp->getOutletOrgDataId()] - 1;
            if ($FqDeduction[$tp->getOutletOrgDataId()] == 0) {
                $totalVistis = $totalVistis + 1;
            }
        }

        $mtp = MtpQuery::create()->findPk($mtp_id);
        $mtp->setOutletsCovered(count($outletsConvered));
        $mtp->setTotalVisits($totalVistis);
        $mtp->setAgendaDays(json_encode($agendas));

        $mtp->save();

    }

    public function addDayPlan(TourPlanRequest $tpr): Tourplans
    {
        $tourplan = new Tourplans();

        $mtpDay = MtpDayQuery::create()->findPk($tpr->getMtp_day_id());

        $tourplan->setTpDate($mtpDay->getMtpDayDate());
        $tourplan->setCompanyId($mtpDay->getCompanyId());
        $tourplan->setPositionId($mtpDay->getMtp()->getPositionId());
        $tourplan->setAgendacontroltype($tpr->getAgendacontroltype());
        if ($tpr->getBeat_id() > 0) {
            $tourplan->setBeatId($tpr->getBeat_id());
        }
        if ($tpr->getItownid() > 0) {

            $tourplan->setItownid($tpr->getItownid());
        }
        $tourplan->setWeekday($mtpDay->getWeekday());
        $tourplan->setWeeknumber($mtpDay->getWeeknumber());
        $tourplan->setAgendaId($tpr->getAgenda_id());
        if ($tpr->getOutlet_org_data_id() > 0) {
            $tourplan->setOutletOrgDataId($tpr->getOutlet_org_data_id());
        }

        $tourplan->setMtpDayId($tpr->getMtp_day_id());
        $tourplan->setMtpId($mtpDay->getMtpId());

        if ($tpr->getAgendacontroltype() == "JW") {
            $tourplan->setIsjw(true);
            $tourplan->setAgendacontroltype("FW");
        } else {
            $tourplan->setIsjw(false);
        }

        if ($tpr->getCampaignVisitPlanId() != null && $tpr->getCampaignVisitPlanId() != ''){
            $tourplan->setCampaignVisitPlanId($tpr->getCampaignVisitPlanId());
        }else{
            $tourplan->setCampaignVisitPlanId(null);
        }

        $tourplan->save();

        $this->updateMTPStats($tpr->getMtp_id());

        return $tourplan;

    }

    public function getTerritoriesList($position_id, $showVacant = true)
    {

        $terrIds = OrgManager::getMyTerritoriesByPosition($position_id, true);

        $territoryRec = \entities\TerritoriesQuery::create()->filterByPrimaryKeys($terrIds)->find();
        $currentDate =date('Y-m-d');
        $territory = [];
        foreach ($territoryRec as $rec) {
            $str = $rec->getTerritoryName(); //." | ".$rec->getPositions()->getPositionName();
            $emp = EmployeeQuery::create()
            ->useHrUserDatesQuery()
                    ->filterByJoinDate($currentDate,\Propel\Runtime\ActiveQuery\Criteria::LESS_EQUAL)
                ->endUse()
            ->filterByPositionId($rec->getPositionId())->filterByStatus(1)->findOne();
            if ($emp != null) {
                $str = $str . " | " . $emp->getFirstName() . " " . $emp->getLastName();
            } else if ($showVacant) {
                $str = $str . " | Vacant";
            } else {
                continue;
            }

            $territory[$rec->getPrimaryKey()] = $str;
        }

        return $territory;
    }

    function getLeavesCount($emp_id, $month)
    {
        $moye = explode("-", $month);
        $startDate = date($moye[1] . '-' . $moye[0] . '-01'); // Start Date
        $endDate = date($moye[1] . '-' . $moye[0] . '-t'); // End Date

        return LeavesQuery::create()
            ->select(['LeaveDate'])
            ->filterByEmployeeId($emp_id)
            ->filterByLeaveDate($startDate, Criteria::GREATER_EQUAL)
            ->filterByLeaveDate($endDate, Criteria::LESS_EQUAL)
            ->filterByLeavePoints(0, Criteria::LESS_THAN)
            ->count();
    }

    public function leaveMtpDaysDelete($startDate, $endDate, $month)
    {
        $leaveRequests = \entities\LeaveRequestQuery::create()
            ->filterByLeaveFrom('2024-06-01', Criteria::GREATER_EQUAL)
            ->filterByLeaveTo('2024-06-30', Criteria::LESS_EQUAL)
            ->filterByLeaveStatus(2)
            ->find();
        if ($leaveRequests->count() > 0) {
            foreach ($leaveRequests as $leaveRequest) {
                $leaves = \entities\LeavesQuery::create()
                    ->filterByLeaveRequestId($leaveRequest->getLeaveReqId())
                    ->filterByLeavePoints(-1)
                    ->find();
                if ($leaves->count() > 0) {
                    foreach ($leaves as $leave) {
                        $emp = \entities\EmployeeQuery::create()->findPk($leave->getEmployeeId());
                        $mtp = \entities\MtpQuery::create()
                            ->filterByPositionId($emp->getPositionId())
                            ->filterByMonth('06-2024')
                            ->filterByMtpStatus('approved', Criteria::NOT_EQUAL)
                            ->findOne();
                        if($mtp != null && $mtp != '' && $mtp->getMtpId() != null && $mtp->getMtpId() != ''){

                            $mtpDays = \entities\MtpDayQuery::create()
                                ->filterByMtpDayDate($leave->getLeaveDate()->format('Y-m-d'))
                                ->filterByMtpId($mtp->getMtpId())
                                ->findOne();
                            if($mtpDays != NULL && $mtpDays != '' && $mtpDays != 'NULL' && $mtpDays != null && $mtpDays != 'null'){
                                $tourplan = \entities\TourplansQuery::create()
                                    ->filterByTpDate($mtpDays->getMtpDayDate())
                                    ->filterByMtpDayId($mtpDays->getMtpDayId())
                                    ->filterByMtpId($mtpDays->getMtpId())
                                    ->find();
                                if($tourplan != NULL && $tourplan != '' && $tourplan != 'NULL' && $tourplan != null && $tourplan != 'null'){
                                    $tourplan->delete();
                                }
                                $mtpDays->delete();
                            }
                        }
                    }
                }
                echo $leaveRequest->getLeaveReqId().PHP_EOL;
            }
        }
    }

    public function generateMtpDaysPlan(){
        $mtps = MtpQuery::create()
                ->filterByMtpStatus("approved")
                ->filterByIsProcessed(false)
                ->filterByApprovedDate('2024-08-01',Criteria::GREATER_THAN)
                ->find();
        if($mtps != null && $mtps != ''){
            foreach($mtps as $mtp){
                $this->genrateDayPlan($mtp->getPrimaryKey());
                $mtp->setIsProcessed(true);
                $mtp->save();
            }
        }
    }

    public function generateMTPWithManualType($mtp) {
        $serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
        $serviceContainer->getConnection()->exec("call do_manual_mtp_creation(".$mtp->getMtpId().")");
        $serviceContainer->closeConnections();
    }

    public function generateMTPWithSTPType($mtp) {
        $serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
        $serviceContainer->getConnection()->exec("call do_stp_mtp_creation(".$mtp->getMtpId().")");
        $serviceContainer->closeConnections();
    }

    public function generateMTPWithSmartType($mtp) {
        $serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
        $serviceContainer->getConnection()->exec("call do_smart_mtp_creation(".$mtp->getMtpId().")");
        $serviceContainer->closeConnections();
    }
}
