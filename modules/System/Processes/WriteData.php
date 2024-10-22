<?php

declare(strict_types=1);

namespace Modules\System\Processes;


class WriteData extends \App\Core\Process
{

    public function writeSgpi($data)
    {
        $sgpiTruncate = \entities\WriteSgpiQuery::create()
                            ->filterByMonth($data[0]['Month'])
                            ->filterByDivision($data[0]['Division'])
                            ->find()
                            ->delete();

        $collection = new \Propel\Runtime\Collection\ObjectCollection();
        $collection->setModel(\entities\WriteSgpi::class);

        if (!empty($data) && is_array($data)) {
            foreach ($data as $d) {
                $wsgpi = new \entities\WriteSgpi();
                $wsgpi->setDivision($d['Division']);
                $wsgpi->setEmployeeId($d['EmpId']);
                $wsgpi->setEmployeeName($d['EmpName']);
                $wsgpi->setLocation($d['Location']);
                $wsgpi->setLocationCode($d['LocationCode']);
                $wsgpi->setDrCode($d['DrCode']);
                $wsgpi->setDrName($d['DrName']);
                $wsgpi->setDrSpecialty($d['DrSpecialty']);
                $wsgpi->setMonth($d['Month']);
                $wsgpi->setDrtags($d['DRTags']);
                $wsgpi->setBrand($d['Brand']);
                $wsgpi->setSgpiTagged($d['SGPITagged']);
                $wsgpi->setBrandSgpiDistributed($d['BrandSGPIDistributed']);
                $wsgpi->setMrCallDone($d['MRCallDone']);
                $wsgpi->setAmCallDone($d['AMCallDone']);
                $wsgpi->setRmCallDone($d['RMCallDone']);
                $wsgpi->setZmCallDone($d['ZMCallDone']);
                $wsgpi->setZmPosition($d['Level3']);
                $wsgpi->setRmPosition($d['Level2']);
                $wsgpi->setAmPosition($d['Level1']);
                $wsgpi->setZmPositionCode($d['level1PositionCode']);
                $wsgpi->setRmPositionCode($d['level2PositionCode']);
                $wsgpi->setAmPositionCode($d['level3PositionCode']);
                $wsgpi->setEmployeePositionCode($d['EmpPositionCode']);
                $wsgpi->setEmployeePositionName($d['EmpPositionName']);
                $wsgpi->setEmployeeLevel($d['EmpLevel']);

                $collection->append($wsgpi);
                
            }
            $collection->save();
        }
    }

    public function writeDvp($data)
    {
        $dvpTruncate = \entities\WriteDvpQuery::create()
                            ->filterByMonth($data[0]['Month'])
                            ->find()
                            ->delete();

        $collection = new \Propel\Runtime\Collection\ObjectCollection();
        $collection->setModel(\entities\WriteDvp::class);

        if (!empty($data) && is_array($data)) {
            foreach ($data as $d) {
                $wdvp = new \entities\WriteDvp();
                $wdvp->setOrgUnit($d['OrgUnit']);
                $wdvp->setEmployeeCode($d['EmployeeCode']);
                $wdvp->setJoiningDate($d['JoiningDate']);
                $wdvp->setAmPosition($d['Level3']);
                $wdvp->setRmPosition($d['Level2']);
                $wdvp->setZmPosition($d['Level1']);
                $wdvp->setLocation($d['Location']);
                $wdvp->setStatus($d['Status']);
                $wdvp->setEmployeeName($d['EmployeeName']);
                $wdvp->setDoctorName($d['DoctorName']);
                $wdvp->setDoctorCode($d['DoctorCode']);
                $wdvp->setTown($d['Town']);
                $wdvp->setPatch($d['Patch']);
                $wdvp->setSpeciality($d['Speciality']);
                $wdvp->setTags($d['Tags']);
                $wdvp->setVisitFq($d['VisitFq']);
                $wdvp->setPrescriberClassification($d['PrescriberClassification']);
                $wdvp->setTopBrand($d['TopBrand']);
                $wdvp->setVisitDr($d['VisitDr']);
                $wdvp->setAmVisitDr($d['AmVisitDr']);
                $wdvp->setRmVisitDr($d['RmVisitDr']);
                $wdvp->setZmVisitDr($d['ZmVisitDr']);
                $wdvp->setRcpaDone($d['RcpaDone']);
                $wdvp->setRcpaLmOwn($d['RCPA-LM-OWN']);
                $wdvp->setRcpaLmComp($d['RCPA-LM-COMP']);
                $wdvp->setRcpaCmOwn($d['RCPA-CM-OWN']);
                $wdvp->setRcpaCmComp($d['RCPA-CM-COMP']);
                $wdvp->setSamplesSgpi($d['samplesSGPI']);
                $wdvp->setGiftsSgpi($d['giftsSGPI']);
                $wdvp->setPromoSgpi($d['promoSGPI']);
                $wdvp->setZmPositionCode($d['level1PositionCode']);
                $wdvp->setRmPositionCode($d['level2PositionCode']);
                $wdvp->setAmPositionCode($d['level3PositionCode']);
                $wdvp->setEmployeePositionCode($d['EmpPositionCode']);
                $wdvp->setEmployeePosition($d['EmpLevel']);
                $wdvp->setEmployeeLevel($d['EmpPositionName']);
                $wdvp->setMonth($d['Month']);
                $wdvp->setMrDetailing($d['MrEdetailing']);

                $collection->append($wdvp);
                
            }
            $collection->save();
        }
    }

    public function writeMas($data)
    {
        $masTruncate = \entities\WriteMasQuery::create()
                            ->filterByMonthYear($data[0]['MonthYear'])
                            ->find()
                            ->delete();
        
        $collection = new \Propel\Runtime\Collection\ObjectCollection();
        $collection->setModel(\entities\WriteMas::class);

        if (!empty($data) && is_array($data)) {
            foreach ($data as $d) {
                $wmas = new \entities\WriteMas();
                $wmas->setOrgUnitName($d['OrgName']);
                $wmas->setRepCode($d['REPCODE']);
                $wmas->setEmployeeCode($d['EmployeeCode']);
                $wmas->setEmployeeName($d['EmployeeName']);
                $wmas->setAmPosition($d['Level3']);
                $wmas->setRmPosition($d['Level2']);
                $wmas->setZmPosition($d['Level1']);
                $wmas->setLocation($d['Location']);
                $wmas->setMonthYear($d['MonthYear']);
                $wmas->setWorkingDays($d['WorkingDays']);
                $wmas->setFwd($d['FWD']);
                $wmas->setNca($d['NCA']);
                $wmas->setTotalDoctors($d['TotalDoctors']);
                $wmas->setDrMet($d['DrMet']);
                $wmas->setDrVfMet($d['DrVfMet']);
                $wmas->setDrcaL($d['DRCA-L']);
                $wmas->setDrcvrg($d['DRCVRG%']);
                $wmas->setDrvfcvrg($d['DRVFCVRG%']);
                $wmas->setMissedDr($d['MISSEDDR']);
                $wmas->setMissedDrCalls($d['MISSEDDRCALLS']);
                $wmas->setTotalChemist($d['TOTALCHEMIST']);
                $wmas->setPobValue($d['POBValue']);
                $wmas->setRcpaValueForOwnBrand($d['RCPAvalueforownbrand']);
                $wmas->setRcpaValueForCompBrand($d['RCPAvalueforCompbrand']);
                $wmas->setJointWorkTotalCalls($d['JOINTWORKTotalCalls']);
                $wmas->setLeaveDays($d['LEAVEDAYS']);
                $wmas->setJointWorking($d['JoinWorking']);
                $wmas->setNoDrCall($d['NoDrCall']);
                $wmas->setAgenda($d['Agenda']);
                $wmas->setZmPositionCode($d['level1PositionCode']);
                $wmas->setRmPositionCode($d['level2PositionCode']);
                $wmas->setAmPositionCode($d['level3PositionCode']);
                $wmas->setEmployeeStatus($d['EmpStatus']);
                $wmas->setEmployeePositionCode($d['EmpPositionCode']);
                $wmas->setEmployeePositionName($d['EmpPositionName']);
                $wmas->setEmployeeLevel($d['EmpLevel']);
                $wmas->setChemistMet($d['pharmacyUniqueMet']);
                $wmas->setChemistCalls($d['pharmacyMet']);
                $wmas->setChemistCallAvg($d['avgPharmacyCall']);
                $wmas->setTotalStockists($d['totalStockiest']);
                $wmas->setDrAddition($d['addedDrs']);
                $wmas->setDrDeletion($d['removeDrs']);

                $collection->append($wmas);
               
            }
            $collection->save();
        }
    }

    public function writeWDBSyncLog($data) {
        $collection = new \Propel\Runtime\Collection\ObjectCollection();
        $collection->setModel(\entities\WdbSyncLogBkp::class);

        if (!empty($data) && is_array($data)) {
            foreach ($data as $d) {
                unset($d['SysBody']);
                $wDBLog = new \entities\WdbSyncLogBkp();
                $wDBLog->fromArray($d);
                $collection->append($wDBLog);

                if ($collection->count() >= 5000) {
                    $collection->save();
                    $collection->clear();
                }
            }
            $collection->save();
        }
    }
}
