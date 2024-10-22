<?php

namespace BI\manager;

use Exception;
use entities\Dayplan;
use entities\Dailycalls;
use entities\DayplanQuery;
use entities\EdStatsQuery;
use entities\EmployeeQuery;
use entities\BrandRcpaQuery;
use entities\EdSessionQuery;
use FormManager\Fields\Date;
use entities\AttendanceQuery;
use entities\Base\Attendance;
use entities\DailycallsQuery;
use entities\OutletViewQuery;
use entities\DailycallsSgpiout;
use entities\SgpiAccountsQuery;
use BI\requests\SGPITransferRequest;
use entities\DailycallsSgpioutQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Modules\OfflineSync\Models\BrandRCPA;

/**
 * Description of Daily Calls Manager (DCR)
 *
 * @author Chintan Parikh
 */
class DailyCallsManager 
{
    var $cli = false;
    function processDailyCalls(Attendance $attendance)
    {        
        $dailyCalls = DailycallsQuery::create()
                        ->filterByDcrDate($attendance->getAttendanceDate())
                        ->filterByEmployeeId($attendance->getEmployeeId())                        
                        ->filterByIsprocessed(false)
                        ->find();
        $towns = [];
        foreach($dailyCalls as $dc)
        {
            $this->processSingleDCR($dc);
        }

        //This logic move to auto generate expense

        // $towns = DailycallsQuery::create()
        //                 ->select(['Itownid'])
        //                 ->filterByDcrDate($attendance->getAttendanceDate())
        //                 ->filterByEmployeeId($attendance->getEmployeeId())                                                
        //                 ->find()->toArray();

        // $totalTowns = implode(",",array_unique($towns));

        // $attendance->setOutletCount(count($towns));
        // $attendance->setVisitedItownid($totalTowns);
        // $attendance->save();
    }

    public function recoProcess()
    {
        $this->cli = true;

        $dates = DailycallsQuery::create()
                        ->select(['DcrDate','EmployeeId'])
                        ->filterByIsprocessed(false)
                        ->groupByDcrDate()
                        ->groupByEmployeeId()
                        ->find()->toArray();
        
        foreach($dates as $d)
        {
            echo "-------".$d['DcrDate'].".".$d['EmployeeId'].PHP_EOL;    
            $attendances = AttendanceQuery::create()
                    ->filterByAttendanceDate($d['DcrDate'])
                    ->filterByEmployeeId($d['EmployeeId'])
                    ->filterByStatus(1)
                    ->orderByAttendanceDate(Criteria::DESC)
                    ->find();

            foreach($attendances as $att)
            {
                
                $this->processDailyCalls($att);

            }
        }
        

    }

    function processSingleDCR(DailyCalls $dc)
    {
        $sgpiManager = new SGPIManager();
        $sgpiAccount = SgpiAccountsQuery::create()->findOneByEmployeeId($dc->getEmployeeId());

        if($dc->getAgendacontroltype() == "NCA")
        {
            $dc->setDcrStatus("Reported");
            $dc->setIsprocessed(true);
            $dc->save();    
            
            // Brand Campaign Visit
            if($dc->getVisitPlanId() != null && $dc->getNcaAttendees() != null){
                
                $ncaAttendeesJson = $dc->getNcaAttendees();
                //$data = json_decode($ncaAttendeesJson,true);

                $plannedOutlets = $ncaAttendeesJson['plannedOutlet'];
                $unplannedOutlets = $ncaAttendeesJson['unplannedOutlet'];

                if(!empty($plannedOutlets)){
                    $expPlannedOutlets = explode(',',$plannedOutlets);
                    foreach($expPlannedOutlets as $ncaAttendees){
                        $ncaAttendee = \entities\DailycallsAttendeesQuery::create()
                                            ->filterByBrandCampaignVisitPlanId($dc->getVisitPlanId())
                                            ->filterByOutletOrgDataId($ncaAttendees)
                                            ->filterByDcrId($dc->getDcrId())
                                            ->findOne();
                        if($ncaAttendee == null){
                            $ncaAttendee = new \entities\DailycallsAttendees();
                        }
                        $ncaAttendee->setBrandCampaignVisitPlanId($dc->getVisitPlanId());
                        $ncaAttendee->setOutletOrgDataId($ncaAttendees);
                        $ncaAttendee->setDcrId($dc->getPrimaryKey());
                        $ncaAttendee->setPlannedCall('Yes');
                        $ncaAttendee->save(); 
                    }
                }

                if(!empty($unplannedOutlets)){
                    $expUnplannedOutlets = explode(',',$unplannedOutlets);
                    foreach($expUnplannedOutlets as $ncaAttendees){
                        $ncaAttendee = \entities\DailycallsAttendeesQuery::create()
                                            ->filterByBrandCampaignVisitPlanId($dc->getVisitPlanId())
                                            ->filterByOutletOrgDataId($ncaAttendees)
                                            ->filterByDcrId($dc->getDcrId())
                                            ->findOne();
                        if($ncaAttendee == null){
                            $ncaAttendee = new \entities\DailycallsAttendees();
                        }
                        $ncaAttendee->setBrandCampaignVisitPlanId($dc->getVisitPlanId());
                        $ncaAttendee->setOutletOrgDataId($ncaAttendees);
                        $ncaAttendee->setDcrId($dc->getPrimaryKey());
                        $ncaAttendee->setPlannedCall('No');
                        $ncaAttendee->save(); 
                    }
                }

                $campaignVisitPlan = \entities\BrandCampiagnVisitsQuery::create()
                                            ->filterByBrandCampiagnVisitPlanId($dc->getVisitPlanId())
                                            ->filterByOutletId(null)
                                            ->filterByOutletOrgDataId(null)
                                            ->filterByPositionId($dc->getPositionId())
                                            ->findOne();
                if($campaignVisitPlan != null){
                    $campaignVisitPlan->setIsVisited(true);
                    $campaignVisitPlan->setVisitedDatetime(date('Y-m-d H:i:s'));
                    $campaignVisitPlan->setDcrId($dc->getPrimaryKey());
                    $campaignVisitPlan->save(); 
                }
            }
            return;
        }

            $outletId = $dc->getOutletOrgData()->getOutletId();
            // Record SGPI Outs 
            if($dc->getSgpiOut() != null && $sgpiAccount != null) {
                $sgpiList = json_decode($dc->getSgpiOut());

                foreach($sgpiList as $sgpi)
                {
                    $sgpiOutExists = DailycallsSgpioutQuery::create()->filterByDailycallId($dc->getPrimaryKey())->filterBySgpiId($sgpi->SgpiId)->findOne();
                    if($sgpiOutExists != null)
                    {                                               
                        continue;
                    }

                    $sgpiRequest = new SGPITransferRequest();
                    $sgpiRequest->setFrom_sgpi_account_id($sgpiAccount->getSgpiAccountId());
                    $sgpiRequest->setTo_sgpi_account_id(0);
                    $sgpiRequest->setSgpi_id($sgpi->SgpiId);
                    $sgpiRequest->setQty($sgpi->qty);
                    $sgpiRequest->setRemark("By DCR : ".$dc->getPrimaryKey());
                    $sgpiRequest->setCompany_id($dc->getCompanyId());

                    $sgpiManager->doTransfer($sgpiRequest);

                    $dcSgpiOut = new DailycallsSgpiout();

                    $dcSgpiOut->setDailycallId($dc->getPrimaryKey());
                    $dcSgpiOut->setSgpiId($sgpi->SgpiId);
                    $dcSgpiOut->setSgpiQty($sgpi->qty);
                    $dcSgpiOut->setSgpiVoucherId($sgpiRequest->getVoucherId());
                    $dcSgpiOut->setCompanyId($dc->getCompanyId());
                    $dcSgpiOut->setEmployeeId($dc->getEmployeeId());
                    $dcSgpiOut->setOutletId($outletId);
                    $dcSgpiOut->setOutletOrgdataId($dc->getOutletOrgDataId());

                    $dcSgpiOut->save();
                    if($this->cli)
                    {
                        echo $dc->getDcrId()." ".$dc->getDcrDate()->format("Y-m-d").PHP_EOL;
                    }
                }
                $dc->setSgpiOut(null);
                $dc->setHasSgpi(count($sgpiList));
            }
            else 
            {
                $dc->setHasSgpi(0);
            }

            // Joint Working
            if($dc->getManagers() != null && $dc->getManagers() != "" && $dc->getAgendacontroltype() == "FW")
            {
                $empid = $dc->getEmployeeId();
                $mr_emp = EmployeeQuery::create()->findPk($empid);

                $manager = explode(",",$dc->getManagers());
                foreach($manager as $mgr_emp_id)
                {
                    $employee = EmployeeQuery::create()->findPk($mgr_emp_id);

                    $dayplan = DayplanQuery::create()
                                    ->filterByPositionId($employee->getPositionId())
                                    ->filterByTpDate($dc->getDcrDate())
                                    ->filterByOutletOrgDataId($dc->getOutletOrgDataId())
                                    ->findOne();
                    if($dayplan == null)
                    {
                        $dayplan = new Dayplan();
                        $dayplan->setTpDate($dc->getDcrDate());
                        $dayplan->setCompanyId($dc->getCompanyId());
                        $dayplan->setPositionId($employee->getPositionId());
                        $dayplan->setAgendacontroltype($dc->getAgendacontroltype());
                        $dayplan->setAgendaId($dc->getAgendaId());                        
                        $dayplan->setOutletOrgDataId($dc->getOutletOrgDataId());                        

                        $dayplan->setIsfixed(1);
                        $dayplan->setIsjw(1);
                        $dayplan->setStatus("AwatingFeedback");
                        $dayplan->save();

                    }
                    else 
                    {
                        $dayplan->setIsfixed(1);
                        $dayplan->setIsjw(1);
                        $dayplan->save();
                    }

                    $mgrCall = DailycallsQuery::create()
                                    ->filterByPositionId($employee->getPositionId())
                                    ->filterByEmployeeId($employee->getPrimaryKey())
                                    ->filterByOutletOrgDataId($dc->getOutletOrgDataId())
                                    ->filterByDcrDate($dc->getDcrDate())
                                    ->findOne();

                    if($mgrCall == null)
                    {
                        $mgrCall = new Dailycalls();

                        $vals = $dc->toArray();
                        
                        unset($vals['DcrId']);                    
                        unset($vals['DayPlanId']);
                        unset($vals['PositionId']);
                        unset($vals['CreatedAt']);
                        unset($vals['Managers']);
                        unset($vals['SgpiOut']);
                        unset($vals['OutletFeedback']);
                        unset($vals['EmployeeId']);


                        $mgrCall->fromArray($vals);

                        $mgrCall->setPositionId($employee->getPositionId());
                        $mgrCall->setEmployeeId($employee->getPrimaryKey());
                        $mgrCall->setDayPlanId($dayplan->getPrimaryKey());
                        $mgrCall->setIsjw(1);
                        $mgrCall->setDcrStatus("AwatingFeedBack");
                        $mgrCall->setMrEmp($mr_emp->getEmployeeId());
                        $mgrCall->setMrName($mr_emp->getFirstName()." ".$mr_emp->getLastName());
                        $mgrCall->setMrMediaId($mr_emp->getEmployeeMedia());
                        $mgrCall->save();

                    }
                    else 
                    {
                        $mgrCall->setIsjw(1);                        
                        $mgrCall->setMrEmp($mr_emp->getEmployeeId());
                        $mgrCall->setMrName($mr_emp->getFirstName()." ".$mr_emp->getLastName());
                        $mgrCall->setMrMediaId($mr_emp->getEmployeeMedia());
                        $mgrCall->save();
                    }                    
                    
                }
            }

            // Brand Campaign Visit
            if($dc->getVisitPlanId() != null && $dc->getVisitPlanId() != ""){
                $visitPlanIds = explode(',',$dc->getVisitPlanId());
                foreach($visitPlanIds as $visitPlanId){
                    $campaignVisitPlan = \entities\BrandCampiagnVisitsQuery::create()
                                            ->findPk($visitPlanId);
                    if($campaignVisitPlan != null){
                        $campaignVisitPlan->setIsVisited(true);
                        $campaignVisitPlan->setVisitedDatetime(date('Y-m-d H:i:s'));
                        $campaignVisitPlan->setDcrId($dc->getPrimaryKey());
                        $campaignVisitPlan->save(); 
                    }     
                }
            }

            $moye = $dc->getDcrDate()->format("m-Y");

            $rcpaExists = BrandRcpaQuery::create()
                                ->filterByRcpaMoye($moye)
                                ->filterByOutletId($outletId)
                                ->find()->count();
            $ChemistrcpaExists = BrandRcpaQuery::create()
                                ->filterByRcpaMoye($moye)
                                ->filterByRetailOutletId($outletId)
                                ->find()->count();
                                
            if($rcpaExists > 0 || $ChemistrcpaExists > 0)
            {
                $dc->setRcpaDone(1);
            }
            else 
            {
                $dc->setRcpaDone(0);
            }

            if($dc->getEdSessionId() != null && $dc->getEdSessionId() != "")
            {
                $duration = EdStatsQuery::create()
                            ->withColumn("sum(Duration)","Duration")
                            ->select(["Duration"])
                            ->filterBySessionId($dc->getEdSessionId())
                            ->findOne();
                if($duration != null) {
                    $dc->setEdDuration($duration);
                }
            }

            $dc->setDcrStatus("Reported");
            $dc->setIsprocessed(true);
            $dc->save();                        
            $towns[] = $dc->getItownid();

            $outletData = $dc->getOutletOrgData();
            $outletData->setLastVisitDate($dc->getDcrDate());
            $outletData->setLastVisitEmployee($dc->getEmployeeId());
            $outletData->save();                   
    }

    function addPendingDCRRecord($employee, $date) {
        // Get completed Day plans
        $dayplans = DayplanQuery::create()
                        ->filterByPositionId($employee->getPositionId())
                        ->filterByStatus('completed')
                        ->filterByTpDate($date)
                        ->find();

        // Check if any DCR with Managers
        $managerDCR = DailycallsQuery::create()
                        ->filterByEmployeeId($employee->getEmployeeId())
                        ->filterByPositionId($employee->getPositionId())
                        ->filterByDcrDate($date)
                        ->where("dailycalls.managers is not null AND dailycalls.managers != ''")
                        ->findOne();

        if (!empty($managerDCR)) {
            $managers = $managerDCR->getManagers();
        } else {
            $managers = null;
        }

        // Check for each Day Plan
        foreach ($dayplans as $dayplan) {
            // Check if DCR already exists
            $dcrRecord = DailycallsQuery::create()
                            ->filterByPositionId($dayplan->getPositionId())
                            ->filterByDcrDate($dayplan->getTpDate())
                            ->filterByOutletOrgDataId($dayplan->getOutletOrgDataId())
                            ->findOne();

            if (empty($dcrRecord)) {
                $edSession = null;
                $brandDetailed = null;
                $dayplanTownId = null;

                // Check for ED sessions
                $edeatilingSession = EdSessionQuery::create()
                                        ->filterByEdDate($dayplan->getTpDate())
                                        ->filterByOutletOrgId($dayplan->getOutletOrgDataId())
                                        ->filterByEmployeeId($employee->getEmployeeId())
                                        ->findOne();
                if (!empty($edeatilingSession)) {
                    $edSession = $edeatilingSession->getEdSessionCode();
                    $edSummary = json_decode($edeatilingSession->getEdSummary());
                    $presentationIds = [];
                    foreach ($edSummary as $summary) {
                        $presentationIds[] = $summary->PresentationId;
                    }

                    if (count($presentationIds)) {
                        $brandDetailed = implode(',', $presentationIds);
                    }
                }

                // Check for town
                if (!empty($dayplan->getItownid())) {
                    $dayplanTownId = $dayplan->getItownid();
                } else {
                    $OutletViewRecord = OutletViewQuery::create()
                                    ->filterByOutletOrgId($dayplan->getOutletOrgDataId())
                                    ->findOne();
                    if (!empty($OutletViewRecord)) {
                        $dayplanTownId = $OutletViewRecord->getItownid();
                    }
                }

                $dcrRecord = new Dailycalls;
                $dcrRecord->setDayPlanId($dayplan->getPrimaryKey());
                $dcrRecord->setOutletOrgDataId($dayplan->getOutletOrgDataId());
                $dcrRecord->setPositionId($dayplan->getPositionId());
                $dcrRecord->setAgendacontroltype($dayplan->getAgendacontroltype());
                $dcrRecord->setItownid($dayplanTownId);
                $dcrRecord->setAgendaId($dayplan->getAgendaId());
                $dcrRecord->setIsjw($dayplan->getIsjw());
                $dcrRecord->setDcrDate($dayplan->getTpDate());
                $dcrRecord->setCompanyId($dayplan->getCompanyId());
                $dcrRecord->setBrandsDetailed($brandDetailed);
                $dcrRecord->setEmployeeId($employee->getEmployeeId());
                $dcrRecord->setEdSessionId($edSession);
                $dcrRecord->setManagers($managers);
                $dcrRecord->save();

                $this->processSingleDCR($dcrRecord);
            }
        }
    }
}
