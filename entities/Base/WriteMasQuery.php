<?php

namespace entities\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use entities\WriteMas as ChildWriteMas;
use entities\WriteMasQuery as ChildWriteMasQuery;
use entities\Map\WriteMasTableMap;

/**
 * Base class that represents a query for the `write_mas` table.
 *
 * @method     ChildWriteMasQuery orderByOrgUnitName($order = Criteria::ASC) Order by the org_unit_name column
 * @method     ChildWriteMasQuery orderByRepCode($order = Criteria::ASC) Order by the rep_code column
 * @method     ChildWriteMasQuery orderByEmployeeCode($order = Criteria::ASC) Order by the employee_code column
 * @method     ChildWriteMasQuery orderByEmployeeName($order = Criteria::ASC) Order by the employee_name column
 * @method     ChildWriteMasQuery orderByAmPosition($order = Criteria::ASC) Order by the am_position column
 * @method     ChildWriteMasQuery orderByRmPosition($order = Criteria::ASC) Order by the rm_position column
 * @method     ChildWriteMasQuery orderByZmPosition($order = Criteria::ASC) Order by the zm_position column
 * @method     ChildWriteMasQuery orderByLocation($order = Criteria::ASC) Order by the location column
 * @method     ChildWriteMasQuery orderByMonthYear($order = Criteria::ASC) Order by the month_year column
 * @method     ChildWriteMasQuery orderByWorkingDays($order = Criteria::ASC) Order by the working_days column
 * @method     ChildWriteMasQuery orderByFwd($order = Criteria::ASC) Order by the fwd column
 * @method     ChildWriteMasQuery orderByNca($order = Criteria::ASC) Order by the nca column
 * @method     ChildWriteMasQuery orderByTotalDoctors($order = Criteria::ASC) Order by the total_doctors column
 * @method     ChildWriteMasQuery orderByDrMet($order = Criteria::ASC) Order by the dr_met column
 * @method     ChildWriteMasQuery orderByDrVfMet($order = Criteria::ASC) Order by the dr_vf_met column
 * @method     ChildWriteMasQuery orderByDrcaL($order = Criteria::ASC) Order by the drca_l column
 * @method     ChildWriteMasQuery orderByDrcvrg($order = Criteria::ASC) Order by the drcvrg column
 * @method     ChildWriteMasQuery orderByDrvfcvrg($order = Criteria::ASC) Order by the drvfcvrg column
 * @method     ChildWriteMasQuery orderByMissedDr($order = Criteria::ASC) Order by the missed_dr column
 * @method     ChildWriteMasQuery orderByMissedDrCalls($order = Criteria::ASC) Order by the missed_dr_calls column
 * @method     ChildWriteMasQuery orderByTotalChemist($order = Criteria::ASC) Order by the total_chemist column
 * @method     ChildWriteMasQuery orderByPobValue($order = Criteria::ASC) Order by the pob_value column
 * @method     ChildWriteMasQuery orderByRcpaValueForOwnBrand($order = Criteria::ASC) Order by the rcpa_value_for_own_brand column
 * @method     ChildWriteMasQuery orderByRcpaValueForCompBrand($order = Criteria::ASC) Order by the rcpa_value_for_comp_brand column
 * @method     ChildWriteMasQuery orderByJointWorkTotalCalls($order = Criteria::ASC) Order by the joint_work_total_calls column
 * @method     ChildWriteMasQuery orderByLeaveDays($order = Criteria::ASC) Order by the leave_days column
 * @method     ChildWriteMasQuery orderByJointWorking($order = Criteria::ASC) Order by the joint_working column
 * @method     ChildWriteMasQuery orderByNoDrCall($order = Criteria::ASC) Order by the no_dr_call column
 * @method     ChildWriteMasQuery orderByAgenda($order = Criteria::ASC) Order by the agenda column
 * @method     ChildWriteMasQuery orderByZmPositionCode($order = Criteria::ASC) Order by the zm_position_code column
 * @method     ChildWriteMasQuery orderByRmPositionCode($order = Criteria::ASC) Order by the rm_position_code column
 * @method     ChildWriteMasQuery orderByAmPositionCode($order = Criteria::ASC) Order by the am_position_code column
 * @method     ChildWriteMasQuery orderByEmployeeStatus($order = Criteria::ASC) Order by the employee_status column
 * @method     ChildWriteMasQuery orderByEmployeePositionCode($order = Criteria::ASC) Order by the employee_position_code column
 * @method     ChildWriteMasQuery orderByEmployeePositionName($order = Criteria::ASC) Order by the employee_position_name column
 * @method     ChildWriteMasQuery orderByEmployeeLevel($order = Criteria::ASC) Order by the employee_level column
 * @method     ChildWriteMasQuery orderByMasReportId($order = Criteria::ASC) Order by the mas_report_id column
 * @method     ChildWriteMasQuery orderByChemistMet($order = Criteria::ASC) Order by the chemist_met column
 * @method     ChildWriteMasQuery orderByChemistCalls($order = Criteria::ASC) Order by the chemist_calls column
 * @method     ChildWriteMasQuery orderByChemistCallAvg($order = Criteria::ASC) Order by the chemist_call_avg column
 * @method     ChildWriteMasQuery orderByTotalStockists($order = Criteria::ASC) Order by the total_stockists column
 * @method     ChildWriteMasQuery orderByDrAddition($order = Criteria::ASC) Order by the dr_addition column
 * @method     ChildWriteMasQuery orderByDrDeletion($order = Criteria::ASC) Order by the dr_deletion column
 * @method     ChildWriteMasQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildWriteMasQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildWriteMasQuery groupByOrgUnitName() Group by the org_unit_name column
 * @method     ChildWriteMasQuery groupByRepCode() Group by the rep_code column
 * @method     ChildWriteMasQuery groupByEmployeeCode() Group by the employee_code column
 * @method     ChildWriteMasQuery groupByEmployeeName() Group by the employee_name column
 * @method     ChildWriteMasQuery groupByAmPosition() Group by the am_position column
 * @method     ChildWriteMasQuery groupByRmPosition() Group by the rm_position column
 * @method     ChildWriteMasQuery groupByZmPosition() Group by the zm_position column
 * @method     ChildWriteMasQuery groupByLocation() Group by the location column
 * @method     ChildWriteMasQuery groupByMonthYear() Group by the month_year column
 * @method     ChildWriteMasQuery groupByWorkingDays() Group by the working_days column
 * @method     ChildWriteMasQuery groupByFwd() Group by the fwd column
 * @method     ChildWriteMasQuery groupByNca() Group by the nca column
 * @method     ChildWriteMasQuery groupByTotalDoctors() Group by the total_doctors column
 * @method     ChildWriteMasQuery groupByDrMet() Group by the dr_met column
 * @method     ChildWriteMasQuery groupByDrVfMet() Group by the dr_vf_met column
 * @method     ChildWriteMasQuery groupByDrcaL() Group by the drca_l column
 * @method     ChildWriteMasQuery groupByDrcvrg() Group by the drcvrg column
 * @method     ChildWriteMasQuery groupByDrvfcvrg() Group by the drvfcvrg column
 * @method     ChildWriteMasQuery groupByMissedDr() Group by the missed_dr column
 * @method     ChildWriteMasQuery groupByMissedDrCalls() Group by the missed_dr_calls column
 * @method     ChildWriteMasQuery groupByTotalChemist() Group by the total_chemist column
 * @method     ChildWriteMasQuery groupByPobValue() Group by the pob_value column
 * @method     ChildWriteMasQuery groupByRcpaValueForOwnBrand() Group by the rcpa_value_for_own_brand column
 * @method     ChildWriteMasQuery groupByRcpaValueForCompBrand() Group by the rcpa_value_for_comp_brand column
 * @method     ChildWriteMasQuery groupByJointWorkTotalCalls() Group by the joint_work_total_calls column
 * @method     ChildWriteMasQuery groupByLeaveDays() Group by the leave_days column
 * @method     ChildWriteMasQuery groupByJointWorking() Group by the joint_working column
 * @method     ChildWriteMasQuery groupByNoDrCall() Group by the no_dr_call column
 * @method     ChildWriteMasQuery groupByAgenda() Group by the agenda column
 * @method     ChildWriteMasQuery groupByZmPositionCode() Group by the zm_position_code column
 * @method     ChildWriteMasQuery groupByRmPositionCode() Group by the rm_position_code column
 * @method     ChildWriteMasQuery groupByAmPositionCode() Group by the am_position_code column
 * @method     ChildWriteMasQuery groupByEmployeeStatus() Group by the employee_status column
 * @method     ChildWriteMasQuery groupByEmployeePositionCode() Group by the employee_position_code column
 * @method     ChildWriteMasQuery groupByEmployeePositionName() Group by the employee_position_name column
 * @method     ChildWriteMasQuery groupByEmployeeLevel() Group by the employee_level column
 * @method     ChildWriteMasQuery groupByMasReportId() Group by the mas_report_id column
 * @method     ChildWriteMasQuery groupByChemistMet() Group by the chemist_met column
 * @method     ChildWriteMasQuery groupByChemistCalls() Group by the chemist_calls column
 * @method     ChildWriteMasQuery groupByChemistCallAvg() Group by the chemist_call_avg column
 * @method     ChildWriteMasQuery groupByTotalStockists() Group by the total_stockists column
 * @method     ChildWriteMasQuery groupByDrAddition() Group by the dr_addition column
 * @method     ChildWriteMasQuery groupByDrDeletion() Group by the dr_deletion column
 * @method     ChildWriteMasQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildWriteMasQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildWriteMasQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWriteMasQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWriteMasQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWriteMasQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWriteMasQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWriteMasQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWriteMas|null findOne(?ConnectionInterface $con = null) Return the first ChildWriteMas matching the query
 * @method     ChildWriteMas findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildWriteMas matching the query, or a new ChildWriteMas object populated from the query conditions when no match is found
 *
 * @method     ChildWriteMas|null findOneByOrgUnitName(string $org_unit_name) Return the first ChildWriteMas filtered by the org_unit_name column
 * @method     ChildWriteMas|null findOneByRepCode(string $rep_code) Return the first ChildWriteMas filtered by the rep_code column
 * @method     ChildWriteMas|null findOneByEmployeeCode(string $employee_code) Return the first ChildWriteMas filtered by the employee_code column
 * @method     ChildWriteMas|null findOneByEmployeeName(string $employee_name) Return the first ChildWriteMas filtered by the employee_name column
 * @method     ChildWriteMas|null findOneByAmPosition(string $am_position) Return the first ChildWriteMas filtered by the am_position column
 * @method     ChildWriteMas|null findOneByRmPosition(string $rm_position) Return the first ChildWriteMas filtered by the rm_position column
 * @method     ChildWriteMas|null findOneByZmPosition(string $zm_position) Return the first ChildWriteMas filtered by the zm_position column
 * @method     ChildWriteMas|null findOneByLocation(string $location) Return the first ChildWriteMas filtered by the location column
 * @method     ChildWriteMas|null findOneByMonthYear(string $month_year) Return the first ChildWriteMas filtered by the month_year column
 * @method     ChildWriteMas|null findOneByWorkingDays(string $working_days) Return the first ChildWriteMas filtered by the working_days column
 * @method     ChildWriteMas|null findOneByFwd(string $fwd) Return the first ChildWriteMas filtered by the fwd column
 * @method     ChildWriteMas|null findOneByNca(string $nca) Return the first ChildWriteMas filtered by the nca column
 * @method     ChildWriteMas|null findOneByTotalDoctors(string $total_doctors) Return the first ChildWriteMas filtered by the total_doctors column
 * @method     ChildWriteMas|null findOneByDrMet(string $dr_met) Return the first ChildWriteMas filtered by the dr_met column
 * @method     ChildWriteMas|null findOneByDrVfMet(string $dr_vf_met) Return the first ChildWriteMas filtered by the dr_vf_met column
 * @method     ChildWriteMas|null findOneByDrcaL(string $drca_l) Return the first ChildWriteMas filtered by the drca_l column
 * @method     ChildWriteMas|null findOneByDrcvrg(string $drcvrg) Return the first ChildWriteMas filtered by the drcvrg column
 * @method     ChildWriteMas|null findOneByDrvfcvrg(string $drvfcvrg) Return the first ChildWriteMas filtered by the drvfcvrg column
 * @method     ChildWriteMas|null findOneByMissedDr(string $missed_dr) Return the first ChildWriteMas filtered by the missed_dr column
 * @method     ChildWriteMas|null findOneByMissedDrCalls(string $missed_dr_calls) Return the first ChildWriteMas filtered by the missed_dr_calls column
 * @method     ChildWriteMas|null findOneByTotalChemist(string $total_chemist) Return the first ChildWriteMas filtered by the total_chemist column
 * @method     ChildWriteMas|null findOneByPobValue(string $pob_value) Return the first ChildWriteMas filtered by the pob_value column
 * @method     ChildWriteMas|null findOneByRcpaValueForOwnBrand(string $rcpa_value_for_own_brand) Return the first ChildWriteMas filtered by the rcpa_value_for_own_brand column
 * @method     ChildWriteMas|null findOneByRcpaValueForCompBrand(string $rcpa_value_for_comp_brand) Return the first ChildWriteMas filtered by the rcpa_value_for_comp_brand column
 * @method     ChildWriteMas|null findOneByJointWorkTotalCalls(string $joint_work_total_calls) Return the first ChildWriteMas filtered by the joint_work_total_calls column
 * @method     ChildWriteMas|null findOneByLeaveDays(string $leave_days) Return the first ChildWriteMas filtered by the leave_days column
 * @method     ChildWriteMas|null findOneByJointWorking(string $joint_working) Return the first ChildWriteMas filtered by the joint_working column
 * @method     ChildWriteMas|null findOneByNoDrCall(string $no_dr_call) Return the first ChildWriteMas filtered by the no_dr_call column
 * @method     ChildWriteMas|null findOneByAgenda(string $agenda) Return the first ChildWriteMas filtered by the agenda column
 * @method     ChildWriteMas|null findOneByZmPositionCode(string $zm_position_code) Return the first ChildWriteMas filtered by the zm_position_code column
 * @method     ChildWriteMas|null findOneByRmPositionCode(string $rm_position_code) Return the first ChildWriteMas filtered by the rm_position_code column
 * @method     ChildWriteMas|null findOneByAmPositionCode(string $am_position_code) Return the first ChildWriteMas filtered by the am_position_code column
 * @method     ChildWriteMas|null findOneByEmployeeStatus(string $employee_status) Return the first ChildWriteMas filtered by the employee_status column
 * @method     ChildWriteMas|null findOneByEmployeePositionCode(string $employee_position_code) Return the first ChildWriteMas filtered by the employee_position_code column
 * @method     ChildWriteMas|null findOneByEmployeePositionName(string $employee_position_name) Return the first ChildWriteMas filtered by the employee_position_name column
 * @method     ChildWriteMas|null findOneByEmployeeLevel(string $employee_level) Return the first ChildWriteMas filtered by the employee_level column
 * @method     ChildWriteMas|null findOneByMasReportId(int $mas_report_id) Return the first ChildWriteMas filtered by the mas_report_id column
 * @method     ChildWriteMas|null findOneByChemistMet(string $chemist_met) Return the first ChildWriteMas filtered by the chemist_met column
 * @method     ChildWriteMas|null findOneByChemistCalls(string $chemist_calls) Return the first ChildWriteMas filtered by the chemist_calls column
 * @method     ChildWriteMas|null findOneByChemistCallAvg(string $chemist_call_avg) Return the first ChildWriteMas filtered by the chemist_call_avg column
 * @method     ChildWriteMas|null findOneByTotalStockists(string $total_stockists) Return the first ChildWriteMas filtered by the total_stockists column
 * @method     ChildWriteMas|null findOneByDrAddition(string $dr_addition) Return the first ChildWriteMas filtered by the dr_addition column
 * @method     ChildWriteMas|null findOneByDrDeletion(string $dr_deletion) Return the first ChildWriteMas filtered by the dr_deletion column
 * @method     ChildWriteMas|null findOneByCreatedAt(string $created_at) Return the first ChildWriteMas filtered by the created_at column
 * @method     ChildWriteMas|null findOneByUpdatedAt(string $updated_at) Return the first ChildWriteMas filtered by the updated_at column
 *
 * @method     ChildWriteMas requirePk($key, ?ConnectionInterface $con = null) Return the ChildWriteMas by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOne(?ConnectionInterface $con = null) Return the first ChildWriteMas matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWriteMas requireOneByOrgUnitName(string $org_unit_name) Return the first ChildWriteMas filtered by the org_unit_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByRepCode(string $rep_code) Return the first ChildWriteMas filtered by the rep_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByEmployeeCode(string $employee_code) Return the first ChildWriteMas filtered by the employee_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByEmployeeName(string $employee_name) Return the first ChildWriteMas filtered by the employee_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByAmPosition(string $am_position) Return the first ChildWriteMas filtered by the am_position column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByRmPosition(string $rm_position) Return the first ChildWriteMas filtered by the rm_position column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByZmPosition(string $zm_position) Return the first ChildWriteMas filtered by the zm_position column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByLocation(string $location) Return the first ChildWriteMas filtered by the location column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByMonthYear(string $month_year) Return the first ChildWriteMas filtered by the month_year column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByWorkingDays(string $working_days) Return the first ChildWriteMas filtered by the working_days column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByFwd(string $fwd) Return the first ChildWriteMas filtered by the fwd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByNca(string $nca) Return the first ChildWriteMas filtered by the nca column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByTotalDoctors(string $total_doctors) Return the first ChildWriteMas filtered by the total_doctors column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByDrMet(string $dr_met) Return the first ChildWriteMas filtered by the dr_met column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByDrVfMet(string $dr_vf_met) Return the first ChildWriteMas filtered by the dr_vf_met column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByDrcaL(string $drca_l) Return the first ChildWriteMas filtered by the drca_l column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByDrcvrg(string $drcvrg) Return the first ChildWriteMas filtered by the drcvrg column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByDrvfcvrg(string $drvfcvrg) Return the first ChildWriteMas filtered by the drvfcvrg column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByMissedDr(string $missed_dr) Return the first ChildWriteMas filtered by the missed_dr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByMissedDrCalls(string $missed_dr_calls) Return the first ChildWriteMas filtered by the missed_dr_calls column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByTotalChemist(string $total_chemist) Return the first ChildWriteMas filtered by the total_chemist column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByPobValue(string $pob_value) Return the first ChildWriteMas filtered by the pob_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByRcpaValueForOwnBrand(string $rcpa_value_for_own_brand) Return the first ChildWriteMas filtered by the rcpa_value_for_own_brand column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByRcpaValueForCompBrand(string $rcpa_value_for_comp_brand) Return the first ChildWriteMas filtered by the rcpa_value_for_comp_brand column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByJointWorkTotalCalls(string $joint_work_total_calls) Return the first ChildWriteMas filtered by the joint_work_total_calls column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByLeaveDays(string $leave_days) Return the first ChildWriteMas filtered by the leave_days column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByJointWorking(string $joint_working) Return the first ChildWriteMas filtered by the joint_working column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByNoDrCall(string $no_dr_call) Return the first ChildWriteMas filtered by the no_dr_call column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByAgenda(string $agenda) Return the first ChildWriteMas filtered by the agenda column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByZmPositionCode(string $zm_position_code) Return the first ChildWriteMas filtered by the zm_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByRmPositionCode(string $rm_position_code) Return the first ChildWriteMas filtered by the rm_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByAmPositionCode(string $am_position_code) Return the first ChildWriteMas filtered by the am_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByEmployeeStatus(string $employee_status) Return the first ChildWriteMas filtered by the employee_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByEmployeePositionCode(string $employee_position_code) Return the first ChildWriteMas filtered by the employee_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByEmployeePositionName(string $employee_position_name) Return the first ChildWriteMas filtered by the employee_position_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByEmployeeLevel(string $employee_level) Return the first ChildWriteMas filtered by the employee_level column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByMasReportId(int $mas_report_id) Return the first ChildWriteMas filtered by the mas_report_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByChemistMet(string $chemist_met) Return the first ChildWriteMas filtered by the chemist_met column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByChemistCalls(string $chemist_calls) Return the first ChildWriteMas filtered by the chemist_calls column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByChemistCallAvg(string $chemist_call_avg) Return the first ChildWriteMas filtered by the chemist_call_avg column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByTotalStockists(string $total_stockists) Return the first ChildWriteMas filtered by the total_stockists column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByDrAddition(string $dr_addition) Return the first ChildWriteMas filtered by the dr_addition column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByDrDeletion(string $dr_deletion) Return the first ChildWriteMas filtered by the dr_deletion column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByCreatedAt(string $created_at) Return the first ChildWriteMas filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWriteMas requireOneByUpdatedAt(string $updated_at) Return the first ChildWriteMas filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWriteMas[]|Collection find(?ConnectionInterface $con = null) Return ChildWriteMas objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildWriteMas> find(?ConnectionInterface $con = null) Return ChildWriteMas objects based on current ModelCriteria
 *
 * @method     ChildWriteMas[]|Collection findByOrgUnitName(string|array<string> $org_unit_name) Return ChildWriteMas objects filtered by the org_unit_name column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByOrgUnitName(string|array<string> $org_unit_name) Return ChildWriteMas objects filtered by the org_unit_name column
 * @method     ChildWriteMas[]|Collection findByRepCode(string|array<string> $rep_code) Return ChildWriteMas objects filtered by the rep_code column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByRepCode(string|array<string> $rep_code) Return ChildWriteMas objects filtered by the rep_code column
 * @method     ChildWriteMas[]|Collection findByEmployeeCode(string|array<string> $employee_code) Return ChildWriteMas objects filtered by the employee_code column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByEmployeeCode(string|array<string> $employee_code) Return ChildWriteMas objects filtered by the employee_code column
 * @method     ChildWriteMas[]|Collection findByEmployeeName(string|array<string> $employee_name) Return ChildWriteMas objects filtered by the employee_name column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByEmployeeName(string|array<string> $employee_name) Return ChildWriteMas objects filtered by the employee_name column
 * @method     ChildWriteMas[]|Collection findByAmPosition(string|array<string> $am_position) Return ChildWriteMas objects filtered by the am_position column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByAmPosition(string|array<string> $am_position) Return ChildWriteMas objects filtered by the am_position column
 * @method     ChildWriteMas[]|Collection findByRmPosition(string|array<string> $rm_position) Return ChildWriteMas objects filtered by the rm_position column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByRmPosition(string|array<string> $rm_position) Return ChildWriteMas objects filtered by the rm_position column
 * @method     ChildWriteMas[]|Collection findByZmPosition(string|array<string> $zm_position) Return ChildWriteMas objects filtered by the zm_position column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByZmPosition(string|array<string> $zm_position) Return ChildWriteMas objects filtered by the zm_position column
 * @method     ChildWriteMas[]|Collection findByLocation(string|array<string> $location) Return ChildWriteMas objects filtered by the location column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByLocation(string|array<string> $location) Return ChildWriteMas objects filtered by the location column
 * @method     ChildWriteMas[]|Collection findByMonthYear(string|array<string> $month_year) Return ChildWriteMas objects filtered by the month_year column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByMonthYear(string|array<string> $month_year) Return ChildWriteMas objects filtered by the month_year column
 * @method     ChildWriteMas[]|Collection findByWorkingDays(string|array<string> $working_days) Return ChildWriteMas objects filtered by the working_days column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByWorkingDays(string|array<string> $working_days) Return ChildWriteMas objects filtered by the working_days column
 * @method     ChildWriteMas[]|Collection findByFwd(string|array<string> $fwd) Return ChildWriteMas objects filtered by the fwd column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByFwd(string|array<string> $fwd) Return ChildWriteMas objects filtered by the fwd column
 * @method     ChildWriteMas[]|Collection findByNca(string|array<string> $nca) Return ChildWriteMas objects filtered by the nca column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByNca(string|array<string> $nca) Return ChildWriteMas objects filtered by the nca column
 * @method     ChildWriteMas[]|Collection findByTotalDoctors(string|array<string> $total_doctors) Return ChildWriteMas objects filtered by the total_doctors column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByTotalDoctors(string|array<string> $total_doctors) Return ChildWriteMas objects filtered by the total_doctors column
 * @method     ChildWriteMas[]|Collection findByDrMet(string|array<string> $dr_met) Return ChildWriteMas objects filtered by the dr_met column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByDrMet(string|array<string> $dr_met) Return ChildWriteMas objects filtered by the dr_met column
 * @method     ChildWriteMas[]|Collection findByDrVfMet(string|array<string> $dr_vf_met) Return ChildWriteMas objects filtered by the dr_vf_met column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByDrVfMet(string|array<string> $dr_vf_met) Return ChildWriteMas objects filtered by the dr_vf_met column
 * @method     ChildWriteMas[]|Collection findByDrcaL(string|array<string> $drca_l) Return ChildWriteMas objects filtered by the drca_l column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByDrcaL(string|array<string> $drca_l) Return ChildWriteMas objects filtered by the drca_l column
 * @method     ChildWriteMas[]|Collection findByDrcvrg(string|array<string> $drcvrg) Return ChildWriteMas objects filtered by the drcvrg column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByDrcvrg(string|array<string> $drcvrg) Return ChildWriteMas objects filtered by the drcvrg column
 * @method     ChildWriteMas[]|Collection findByDrvfcvrg(string|array<string> $drvfcvrg) Return ChildWriteMas objects filtered by the drvfcvrg column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByDrvfcvrg(string|array<string> $drvfcvrg) Return ChildWriteMas objects filtered by the drvfcvrg column
 * @method     ChildWriteMas[]|Collection findByMissedDr(string|array<string> $missed_dr) Return ChildWriteMas objects filtered by the missed_dr column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByMissedDr(string|array<string> $missed_dr) Return ChildWriteMas objects filtered by the missed_dr column
 * @method     ChildWriteMas[]|Collection findByMissedDrCalls(string|array<string> $missed_dr_calls) Return ChildWriteMas objects filtered by the missed_dr_calls column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByMissedDrCalls(string|array<string> $missed_dr_calls) Return ChildWriteMas objects filtered by the missed_dr_calls column
 * @method     ChildWriteMas[]|Collection findByTotalChemist(string|array<string> $total_chemist) Return ChildWriteMas objects filtered by the total_chemist column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByTotalChemist(string|array<string> $total_chemist) Return ChildWriteMas objects filtered by the total_chemist column
 * @method     ChildWriteMas[]|Collection findByPobValue(string|array<string> $pob_value) Return ChildWriteMas objects filtered by the pob_value column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByPobValue(string|array<string> $pob_value) Return ChildWriteMas objects filtered by the pob_value column
 * @method     ChildWriteMas[]|Collection findByRcpaValueForOwnBrand(string|array<string> $rcpa_value_for_own_brand) Return ChildWriteMas objects filtered by the rcpa_value_for_own_brand column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByRcpaValueForOwnBrand(string|array<string> $rcpa_value_for_own_brand) Return ChildWriteMas objects filtered by the rcpa_value_for_own_brand column
 * @method     ChildWriteMas[]|Collection findByRcpaValueForCompBrand(string|array<string> $rcpa_value_for_comp_brand) Return ChildWriteMas objects filtered by the rcpa_value_for_comp_brand column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByRcpaValueForCompBrand(string|array<string> $rcpa_value_for_comp_brand) Return ChildWriteMas objects filtered by the rcpa_value_for_comp_brand column
 * @method     ChildWriteMas[]|Collection findByJointWorkTotalCalls(string|array<string> $joint_work_total_calls) Return ChildWriteMas objects filtered by the joint_work_total_calls column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByJointWorkTotalCalls(string|array<string> $joint_work_total_calls) Return ChildWriteMas objects filtered by the joint_work_total_calls column
 * @method     ChildWriteMas[]|Collection findByLeaveDays(string|array<string> $leave_days) Return ChildWriteMas objects filtered by the leave_days column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByLeaveDays(string|array<string> $leave_days) Return ChildWriteMas objects filtered by the leave_days column
 * @method     ChildWriteMas[]|Collection findByJointWorking(string|array<string> $joint_working) Return ChildWriteMas objects filtered by the joint_working column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByJointWorking(string|array<string> $joint_working) Return ChildWriteMas objects filtered by the joint_working column
 * @method     ChildWriteMas[]|Collection findByNoDrCall(string|array<string> $no_dr_call) Return ChildWriteMas objects filtered by the no_dr_call column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByNoDrCall(string|array<string> $no_dr_call) Return ChildWriteMas objects filtered by the no_dr_call column
 * @method     ChildWriteMas[]|Collection findByAgenda(string|array<string> $agenda) Return ChildWriteMas objects filtered by the agenda column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByAgenda(string|array<string> $agenda) Return ChildWriteMas objects filtered by the agenda column
 * @method     ChildWriteMas[]|Collection findByZmPositionCode(string|array<string> $zm_position_code) Return ChildWriteMas objects filtered by the zm_position_code column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByZmPositionCode(string|array<string> $zm_position_code) Return ChildWriteMas objects filtered by the zm_position_code column
 * @method     ChildWriteMas[]|Collection findByRmPositionCode(string|array<string> $rm_position_code) Return ChildWriteMas objects filtered by the rm_position_code column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByRmPositionCode(string|array<string> $rm_position_code) Return ChildWriteMas objects filtered by the rm_position_code column
 * @method     ChildWriteMas[]|Collection findByAmPositionCode(string|array<string> $am_position_code) Return ChildWriteMas objects filtered by the am_position_code column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByAmPositionCode(string|array<string> $am_position_code) Return ChildWriteMas objects filtered by the am_position_code column
 * @method     ChildWriteMas[]|Collection findByEmployeeStatus(string|array<string> $employee_status) Return ChildWriteMas objects filtered by the employee_status column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByEmployeeStatus(string|array<string> $employee_status) Return ChildWriteMas objects filtered by the employee_status column
 * @method     ChildWriteMas[]|Collection findByEmployeePositionCode(string|array<string> $employee_position_code) Return ChildWriteMas objects filtered by the employee_position_code column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByEmployeePositionCode(string|array<string> $employee_position_code) Return ChildWriteMas objects filtered by the employee_position_code column
 * @method     ChildWriteMas[]|Collection findByEmployeePositionName(string|array<string> $employee_position_name) Return ChildWriteMas objects filtered by the employee_position_name column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByEmployeePositionName(string|array<string> $employee_position_name) Return ChildWriteMas objects filtered by the employee_position_name column
 * @method     ChildWriteMas[]|Collection findByEmployeeLevel(string|array<string> $employee_level) Return ChildWriteMas objects filtered by the employee_level column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByEmployeeLevel(string|array<string> $employee_level) Return ChildWriteMas objects filtered by the employee_level column
 * @method     ChildWriteMas[]|Collection findByMasReportId(int|array<int> $mas_report_id) Return ChildWriteMas objects filtered by the mas_report_id column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByMasReportId(int|array<int> $mas_report_id) Return ChildWriteMas objects filtered by the mas_report_id column
 * @method     ChildWriteMas[]|Collection findByChemistMet(string|array<string> $chemist_met) Return ChildWriteMas objects filtered by the chemist_met column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByChemistMet(string|array<string> $chemist_met) Return ChildWriteMas objects filtered by the chemist_met column
 * @method     ChildWriteMas[]|Collection findByChemistCalls(string|array<string> $chemist_calls) Return ChildWriteMas objects filtered by the chemist_calls column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByChemistCalls(string|array<string> $chemist_calls) Return ChildWriteMas objects filtered by the chemist_calls column
 * @method     ChildWriteMas[]|Collection findByChemistCallAvg(string|array<string> $chemist_call_avg) Return ChildWriteMas objects filtered by the chemist_call_avg column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByChemistCallAvg(string|array<string> $chemist_call_avg) Return ChildWriteMas objects filtered by the chemist_call_avg column
 * @method     ChildWriteMas[]|Collection findByTotalStockists(string|array<string> $total_stockists) Return ChildWriteMas objects filtered by the total_stockists column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByTotalStockists(string|array<string> $total_stockists) Return ChildWriteMas objects filtered by the total_stockists column
 * @method     ChildWriteMas[]|Collection findByDrAddition(string|array<string> $dr_addition) Return ChildWriteMas objects filtered by the dr_addition column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByDrAddition(string|array<string> $dr_addition) Return ChildWriteMas objects filtered by the dr_addition column
 * @method     ChildWriteMas[]|Collection findByDrDeletion(string|array<string> $dr_deletion) Return ChildWriteMas objects filtered by the dr_deletion column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByDrDeletion(string|array<string> $dr_deletion) Return ChildWriteMas objects filtered by the dr_deletion column
 * @method     ChildWriteMas[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildWriteMas objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByCreatedAt(string|array<string> $created_at) Return ChildWriteMas objects filtered by the created_at column
 * @method     ChildWriteMas[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildWriteMas objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildWriteMas> findByUpdatedAt(string|array<string> $updated_at) Return ChildWriteMas objects filtered by the updated_at column
 *
 * @method     ChildWriteMas[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildWriteMas> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class WriteMasQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\WriteMasQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\WriteMas', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWriteMasQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWriteMasQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildWriteMasQuery) {
            return $criteria;
        }
        $query = new ChildWriteMasQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildWriteMas|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WriteMasTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WriteMasTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildWriteMas A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT org_unit_name, rep_code, employee_code, employee_name, am_position, rm_position, zm_position, location, month_year, working_days, fwd, nca, total_doctors, dr_met, dr_vf_met, drca_l, drcvrg, drvfcvrg, missed_dr, missed_dr_calls, total_chemist, pob_value, rcpa_value_for_own_brand, rcpa_value_for_comp_brand, joint_work_total_calls, leave_days, joint_working, no_dr_call, agenda, zm_position_code, rm_position_code, am_position_code, employee_status, employee_position_code, employee_position_name, employee_level, mas_report_id, chemist_met, chemist_calls, chemist_call_avg, total_stockists, dr_addition, dr_deletion, created_at, updated_at FROM write_mas WHERE mas_report_id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildWriteMas $obj */
            $obj = new ChildWriteMas();
            $obj->hydrate($row);
            WriteMasTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @return ChildWriteMas|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(WriteMasTableMap::COL_MAS_REPORT_ID, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(WriteMasTableMap::COL_MAS_REPORT_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the org_unit_name column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgUnitName('fooValue');   // WHERE org_unit_name = 'fooValue'
     * $query->filterByOrgUnitName('%fooValue%', Criteria::LIKE); // WHERE org_unit_name LIKE '%fooValue%'
     * $query->filterByOrgUnitName(['foo', 'bar']); // WHERE org_unit_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $orgUnitName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgUnitName($orgUnitName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($orgUnitName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_ORG_UNIT_NAME, $orgUnitName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rep_code column
     *
     * Example usage:
     * <code>
     * $query->filterByRepCode('fooValue');   // WHERE rep_code = 'fooValue'
     * $query->filterByRepCode('%fooValue%', Criteria::LIKE); // WHERE rep_code LIKE '%fooValue%'
     * $query->filterByRepCode(['foo', 'bar']); // WHERE rep_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $repCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRepCode($repCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($repCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_REP_CODE, $repCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_code column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeCode('fooValue');   // WHERE employee_code = 'fooValue'
     * $query->filterByEmployeeCode('%fooValue%', Criteria::LIKE); // WHERE employee_code LIKE '%fooValue%'
     * $query->filterByEmployeeCode(['foo', 'bar']); // WHERE employee_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $employeeCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeCode($employeeCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($employeeCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_EMPLOYEE_CODE, $employeeCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_name column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeName('fooValue');   // WHERE employee_name = 'fooValue'
     * $query->filterByEmployeeName('%fooValue%', Criteria::LIKE); // WHERE employee_name LIKE '%fooValue%'
     * $query->filterByEmployeeName(['foo', 'bar']); // WHERE employee_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $employeeName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeName($employeeName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($employeeName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_EMPLOYEE_NAME, $employeeName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the am_position column
     *
     * Example usage:
     * <code>
     * $query->filterByAmPosition('fooValue');   // WHERE am_position = 'fooValue'
     * $query->filterByAmPosition('%fooValue%', Criteria::LIKE); // WHERE am_position LIKE '%fooValue%'
     * $query->filterByAmPosition(['foo', 'bar']); // WHERE am_position IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $amPosition The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmPosition($amPosition = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($amPosition)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_AM_POSITION, $amPosition, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rm_position column
     *
     * Example usage:
     * <code>
     * $query->filterByRmPosition('fooValue');   // WHERE rm_position = 'fooValue'
     * $query->filterByRmPosition('%fooValue%', Criteria::LIKE); // WHERE rm_position LIKE '%fooValue%'
     * $query->filterByRmPosition(['foo', 'bar']); // WHERE rm_position IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $rmPosition The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRmPosition($rmPosition = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rmPosition)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_RM_POSITION, $rmPosition, $comparison);

        return $this;
    }

    /**
     * Filter the query on the zm_position column
     *
     * Example usage:
     * <code>
     * $query->filterByZmPosition('fooValue');   // WHERE zm_position = 'fooValue'
     * $query->filterByZmPosition('%fooValue%', Criteria::LIKE); // WHERE zm_position LIKE '%fooValue%'
     * $query->filterByZmPosition(['foo', 'bar']); // WHERE zm_position IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $zmPosition The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByZmPosition($zmPosition = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zmPosition)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_ZM_POSITION, $zmPosition, $comparison);

        return $this;
    }

    /**
     * Filter the query on the location column
     *
     * Example usage:
     * <code>
     * $query->filterByLocation('fooValue');   // WHERE location = 'fooValue'
     * $query->filterByLocation('%fooValue%', Criteria::LIKE); // WHERE location LIKE '%fooValue%'
     * $query->filterByLocation(['foo', 'bar']); // WHERE location IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $location The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLocation($location = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($location)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_LOCATION, $location, $comparison);

        return $this;
    }

    /**
     * Filter the query on the month_year column
     *
     * Example usage:
     * <code>
     * $query->filterByMonthYear('fooValue');   // WHERE month_year = 'fooValue'
     * $query->filterByMonthYear('%fooValue%', Criteria::LIKE); // WHERE month_year LIKE '%fooValue%'
     * $query->filterByMonthYear(['foo', 'bar']); // WHERE month_year IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $monthYear The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMonthYear($monthYear = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($monthYear)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_MONTH_YEAR, $monthYear, $comparison);

        return $this;
    }

    /**
     * Filter the query on the working_days column
     *
     * Example usage:
     * <code>
     * $query->filterByWorkingDays('fooValue');   // WHERE working_days = 'fooValue'
     * $query->filterByWorkingDays('%fooValue%', Criteria::LIKE); // WHERE working_days LIKE '%fooValue%'
     * $query->filterByWorkingDays(['foo', 'bar']); // WHERE working_days IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $workingDays The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWorkingDays($workingDays = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($workingDays)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_WORKING_DAYS, $workingDays, $comparison);

        return $this;
    }

    /**
     * Filter the query on the fwd column
     *
     * Example usage:
     * <code>
     * $query->filterByFwd('fooValue');   // WHERE fwd = 'fooValue'
     * $query->filterByFwd('%fooValue%', Criteria::LIKE); // WHERE fwd LIKE '%fooValue%'
     * $query->filterByFwd(['foo', 'bar']); // WHERE fwd IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $fwd The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFwd($fwd = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fwd)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_FWD, $fwd, $comparison);

        return $this;
    }

    /**
     * Filter the query on the nca column
     *
     * Example usage:
     * <code>
     * $query->filterByNca('fooValue');   // WHERE nca = 'fooValue'
     * $query->filterByNca('%fooValue%', Criteria::LIKE); // WHERE nca LIKE '%fooValue%'
     * $query->filterByNca(['foo', 'bar']); // WHERE nca IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $nca The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNca($nca = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nca)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_NCA, $nca, $comparison);

        return $this;
    }

    /**
     * Filter the query on the total_doctors column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalDoctors('fooValue');   // WHERE total_doctors = 'fooValue'
     * $query->filterByTotalDoctors('%fooValue%', Criteria::LIKE); // WHERE total_doctors LIKE '%fooValue%'
     * $query->filterByTotalDoctors(['foo', 'bar']); // WHERE total_doctors IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $totalDoctors The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTotalDoctors($totalDoctors = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($totalDoctors)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_TOTAL_DOCTORS, $totalDoctors, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dr_met column
     *
     * Example usage:
     * <code>
     * $query->filterByDrMet('fooValue');   // WHERE dr_met = 'fooValue'
     * $query->filterByDrMet('%fooValue%', Criteria::LIKE); // WHERE dr_met LIKE '%fooValue%'
     * $query->filterByDrMet(['foo', 'bar']); // WHERE dr_met IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $drMet The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDrMet($drMet = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($drMet)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_DR_MET, $drMet, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dr_vf_met column
     *
     * Example usage:
     * <code>
     * $query->filterByDrVfMet('fooValue');   // WHERE dr_vf_met = 'fooValue'
     * $query->filterByDrVfMet('%fooValue%', Criteria::LIKE); // WHERE dr_vf_met LIKE '%fooValue%'
     * $query->filterByDrVfMet(['foo', 'bar']); // WHERE dr_vf_met IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $drVfMet The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDrVfMet($drVfMet = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($drVfMet)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_DR_VF_MET, $drVfMet, $comparison);

        return $this;
    }

    /**
     * Filter the query on the drca_l column
     *
     * Example usage:
     * <code>
     * $query->filterByDrcaL('fooValue');   // WHERE drca_l = 'fooValue'
     * $query->filterByDrcaL('%fooValue%', Criteria::LIKE); // WHERE drca_l LIKE '%fooValue%'
     * $query->filterByDrcaL(['foo', 'bar']); // WHERE drca_l IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $drcaL The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDrcaL($drcaL = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($drcaL)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_DRCA_L, $drcaL, $comparison);

        return $this;
    }

    /**
     * Filter the query on the drcvrg column
     *
     * Example usage:
     * <code>
     * $query->filterByDrcvrg('fooValue');   // WHERE drcvrg = 'fooValue'
     * $query->filterByDrcvrg('%fooValue%', Criteria::LIKE); // WHERE drcvrg LIKE '%fooValue%'
     * $query->filterByDrcvrg(['foo', 'bar']); // WHERE drcvrg IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $drcvrg The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDrcvrg($drcvrg = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($drcvrg)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_DRCVRG, $drcvrg, $comparison);

        return $this;
    }

    /**
     * Filter the query on the drvfcvrg column
     *
     * Example usage:
     * <code>
     * $query->filterByDrvfcvrg('fooValue');   // WHERE drvfcvrg = 'fooValue'
     * $query->filterByDrvfcvrg('%fooValue%', Criteria::LIKE); // WHERE drvfcvrg LIKE '%fooValue%'
     * $query->filterByDrvfcvrg(['foo', 'bar']); // WHERE drvfcvrg IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $drvfcvrg The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDrvfcvrg($drvfcvrg = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($drvfcvrg)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_DRVFCVRG, $drvfcvrg, $comparison);

        return $this;
    }

    /**
     * Filter the query on the missed_dr column
     *
     * Example usage:
     * <code>
     * $query->filterByMissedDr('fooValue');   // WHERE missed_dr = 'fooValue'
     * $query->filterByMissedDr('%fooValue%', Criteria::LIKE); // WHERE missed_dr LIKE '%fooValue%'
     * $query->filterByMissedDr(['foo', 'bar']); // WHERE missed_dr IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $missedDr The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMissedDr($missedDr = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($missedDr)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_MISSED_DR, $missedDr, $comparison);

        return $this;
    }

    /**
     * Filter the query on the missed_dr_calls column
     *
     * Example usage:
     * <code>
     * $query->filterByMissedDrCalls('fooValue');   // WHERE missed_dr_calls = 'fooValue'
     * $query->filterByMissedDrCalls('%fooValue%', Criteria::LIKE); // WHERE missed_dr_calls LIKE '%fooValue%'
     * $query->filterByMissedDrCalls(['foo', 'bar']); // WHERE missed_dr_calls IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $missedDrCalls The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMissedDrCalls($missedDrCalls = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($missedDrCalls)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_MISSED_DR_CALLS, $missedDrCalls, $comparison);

        return $this;
    }

    /**
     * Filter the query on the total_chemist column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalChemist('fooValue');   // WHERE total_chemist = 'fooValue'
     * $query->filterByTotalChemist('%fooValue%', Criteria::LIKE); // WHERE total_chemist LIKE '%fooValue%'
     * $query->filterByTotalChemist(['foo', 'bar']); // WHERE total_chemist IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $totalChemist The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTotalChemist($totalChemist = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($totalChemist)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_TOTAL_CHEMIST, $totalChemist, $comparison);

        return $this;
    }

    /**
     * Filter the query on the pob_value column
     *
     * Example usage:
     * <code>
     * $query->filterByPobValue('fooValue');   // WHERE pob_value = 'fooValue'
     * $query->filterByPobValue('%fooValue%', Criteria::LIKE); // WHERE pob_value LIKE '%fooValue%'
     * $query->filterByPobValue(['foo', 'bar']); // WHERE pob_value IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $pobValue The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPobValue($pobValue = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pobValue)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_POB_VALUE, $pobValue, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rcpa_value_for_own_brand column
     *
     * Example usage:
     * <code>
     * $query->filterByRcpaValueForOwnBrand('fooValue');   // WHERE rcpa_value_for_own_brand = 'fooValue'
     * $query->filterByRcpaValueForOwnBrand('%fooValue%', Criteria::LIKE); // WHERE rcpa_value_for_own_brand LIKE '%fooValue%'
     * $query->filterByRcpaValueForOwnBrand(['foo', 'bar']); // WHERE rcpa_value_for_own_brand IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $rcpaValueForOwnBrand The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRcpaValueForOwnBrand($rcpaValueForOwnBrand = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rcpaValueForOwnBrand)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_RCPA_VALUE_FOR_OWN_BRAND, $rcpaValueForOwnBrand, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rcpa_value_for_comp_brand column
     *
     * Example usage:
     * <code>
     * $query->filterByRcpaValueForCompBrand('fooValue');   // WHERE rcpa_value_for_comp_brand = 'fooValue'
     * $query->filterByRcpaValueForCompBrand('%fooValue%', Criteria::LIKE); // WHERE rcpa_value_for_comp_brand LIKE '%fooValue%'
     * $query->filterByRcpaValueForCompBrand(['foo', 'bar']); // WHERE rcpa_value_for_comp_brand IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $rcpaValueForCompBrand The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRcpaValueForCompBrand($rcpaValueForCompBrand = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rcpaValueForCompBrand)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_RCPA_VALUE_FOR_COMP_BRAND, $rcpaValueForCompBrand, $comparison);

        return $this;
    }

    /**
     * Filter the query on the joint_work_total_calls column
     *
     * Example usage:
     * <code>
     * $query->filterByJointWorkTotalCalls('fooValue');   // WHERE joint_work_total_calls = 'fooValue'
     * $query->filterByJointWorkTotalCalls('%fooValue%', Criteria::LIKE); // WHERE joint_work_total_calls LIKE '%fooValue%'
     * $query->filterByJointWorkTotalCalls(['foo', 'bar']); // WHERE joint_work_total_calls IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $jointWorkTotalCalls The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByJointWorkTotalCalls($jointWorkTotalCalls = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($jointWorkTotalCalls)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_JOINT_WORK_TOTAL_CALLS, $jointWorkTotalCalls, $comparison);

        return $this;
    }

    /**
     * Filter the query on the leave_days column
     *
     * Example usage:
     * <code>
     * $query->filterByLeaveDays('fooValue');   // WHERE leave_days = 'fooValue'
     * $query->filterByLeaveDays('%fooValue%', Criteria::LIKE); // WHERE leave_days LIKE '%fooValue%'
     * $query->filterByLeaveDays(['foo', 'bar']); // WHERE leave_days IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $leaveDays The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLeaveDays($leaveDays = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($leaveDays)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_LEAVE_DAYS, $leaveDays, $comparison);

        return $this;
    }

    /**
     * Filter the query on the joint_working column
     *
     * Example usage:
     * <code>
     * $query->filterByJointWorking('fooValue');   // WHERE joint_working = 'fooValue'
     * $query->filterByJointWorking('%fooValue%', Criteria::LIKE); // WHERE joint_working LIKE '%fooValue%'
     * $query->filterByJointWorking(['foo', 'bar']); // WHERE joint_working IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $jointWorking The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByJointWorking($jointWorking = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($jointWorking)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_JOINT_WORKING, $jointWorking, $comparison);

        return $this;
    }

    /**
     * Filter the query on the no_dr_call column
     *
     * Example usage:
     * <code>
     * $query->filterByNoDrCall('fooValue');   // WHERE no_dr_call = 'fooValue'
     * $query->filterByNoDrCall('%fooValue%', Criteria::LIKE); // WHERE no_dr_call LIKE '%fooValue%'
     * $query->filterByNoDrCall(['foo', 'bar']); // WHERE no_dr_call IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $noDrCall The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNoDrCall($noDrCall = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($noDrCall)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_NO_DR_CALL, $noDrCall, $comparison);

        return $this;
    }

    /**
     * Filter the query on the agenda column
     *
     * Example usage:
     * <code>
     * $query->filterByAgenda('fooValue');   // WHERE agenda = 'fooValue'
     * $query->filterByAgenda('%fooValue%', Criteria::LIKE); // WHERE agenda LIKE '%fooValue%'
     * $query->filterByAgenda(['foo', 'bar']); // WHERE agenda IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $agenda The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAgenda($agenda = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($agenda)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_AGENDA, $agenda, $comparison);

        return $this;
    }

    /**
     * Filter the query on the zm_position_code column
     *
     * Example usage:
     * <code>
     * $query->filterByZmPositionCode('fooValue');   // WHERE zm_position_code = 'fooValue'
     * $query->filterByZmPositionCode('%fooValue%', Criteria::LIKE); // WHERE zm_position_code LIKE '%fooValue%'
     * $query->filterByZmPositionCode(['foo', 'bar']); // WHERE zm_position_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $zmPositionCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByZmPositionCode($zmPositionCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zmPositionCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_ZM_POSITION_CODE, $zmPositionCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rm_position_code column
     *
     * Example usage:
     * <code>
     * $query->filterByRmPositionCode('fooValue');   // WHERE rm_position_code = 'fooValue'
     * $query->filterByRmPositionCode('%fooValue%', Criteria::LIKE); // WHERE rm_position_code LIKE '%fooValue%'
     * $query->filterByRmPositionCode(['foo', 'bar']); // WHERE rm_position_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $rmPositionCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRmPositionCode($rmPositionCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rmPositionCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_RM_POSITION_CODE, $rmPositionCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the am_position_code column
     *
     * Example usage:
     * <code>
     * $query->filterByAmPositionCode('fooValue');   // WHERE am_position_code = 'fooValue'
     * $query->filterByAmPositionCode('%fooValue%', Criteria::LIKE); // WHERE am_position_code LIKE '%fooValue%'
     * $query->filterByAmPositionCode(['foo', 'bar']); // WHERE am_position_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $amPositionCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmPositionCode($amPositionCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($amPositionCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_AM_POSITION_CODE, $amPositionCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_status column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeStatus('fooValue');   // WHERE employee_status = 'fooValue'
     * $query->filterByEmployeeStatus('%fooValue%', Criteria::LIKE); // WHERE employee_status LIKE '%fooValue%'
     * $query->filterByEmployeeStatus(['foo', 'bar']); // WHERE employee_status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $employeeStatus The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeStatus($employeeStatus = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($employeeStatus)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_EMPLOYEE_STATUS, $employeeStatus, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_position_code column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeePositionCode('fooValue');   // WHERE employee_position_code = 'fooValue'
     * $query->filterByEmployeePositionCode('%fooValue%', Criteria::LIKE); // WHERE employee_position_code LIKE '%fooValue%'
     * $query->filterByEmployeePositionCode(['foo', 'bar']); // WHERE employee_position_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $employeePositionCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeePositionCode($employeePositionCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($employeePositionCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_EMPLOYEE_POSITION_CODE, $employeePositionCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_position_name column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeePositionName('fooValue');   // WHERE employee_position_name = 'fooValue'
     * $query->filterByEmployeePositionName('%fooValue%', Criteria::LIKE); // WHERE employee_position_name LIKE '%fooValue%'
     * $query->filterByEmployeePositionName(['foo', 'bar']); // WHERE employee_position_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $employeePositionName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeePositionName($employeePositionName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($employeePositionName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_EMPLOYEE_POSITION_NAME, $employeePositionName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_level column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeLevel('fooValue');   // WHERE employee_level = 'fooValue'
     * $query->filterByEmployeeLevel('%fooValue%', Criteria::LIKE); // WHERE employee_level LIKE '%fooValue%'
     * $query->filterByEmployeeLevel(['foo', 'bar']); // WHERE employee_level IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $employeeLevel The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeLevel($employeeLevel = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($employeeLevel)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_EMPLOYEE_LEVEL, $employeeLevel, $comparison);

        return $this;
    }

    /**
     * Filter the query on the mas_report_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMasReportId(1234); // WHERE mas_report_id = 1234
     * $query->filterByMasReportId(array(12, 34)); // WHERE mas_report_id IN (12, 34)
     * $query->filterByMasReportId(array('min' => 12)); // WHERE mas_report_id > 12
     * </code>
     *
     * @param mixed $masReportId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMasReportId($masReportId = null, ?string $comparison = null)
    {
        if (is_array($masReportId)) {
            $useMinMax = false;
            if (isset($masReportId['min'])) {
                $this->addUsingAlias(WriteMasTableMap::COL_MAS_REPORT_ID, $masReportId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($masReportId['max'])) {
                $this->addUsingAlias(WriteMasTableMap::COL_MAS_REPORT_ID, $masReportId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_MAS_REPORT_ID, $masReportId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the chemist_met column
     *
     * Example usage:
     * <code>
     * $query->filterByChemistMet('fooValue');   // WHERE chemist_met = 'fooValue'
     * $query->filterByChemistMet('%fooValue%', Criteria::LIKE); // WHERE chemist_met LIKE '%fooValue%'
     * $query->filterByChemistMet(['foo', 'bar']); // WHERE chemist_met IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $chemistMet The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByChemistMet($chemistMet = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($chemistMet)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_CHEMIST_MET, $chemistMet, $comparison);

        return $this;
    }

    /**
     * Filter the query on the chemist_calls column
     *
     * Example usage:
     * <code>
     * $query->filterByChemistCalls('fooValue');   // WHERE chemist_calls = 'fooValue'
     * $query->filterByChemistCalls('%fooValue%', Criteria::LIKE); // WHERE chemist_calls LIKE '%fooValue%'
     * $query->filterByChemistCalls(['foo', 'bar']); // WHERE chemist_calls IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $chemistCalls The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByChemistCalls($chemistCalls = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($chemistCalls)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_CHEMIST_CALLS, $chemistCalls, $comparison);

        return $this;
    }

    /**
     * Filter the query on the chemist_call_avg column
     *
     * Example usage:
     * <code>
     * $query->filterByChemistCallAvg('fooValue');   // WHERE chemist_call_avg = 'fooValue'
     * $query->filterByChemistCallAvg('%fooValue%', Criteria::LIKE); // WHERE chemist_call_avg LIKE '%fooValue%'
     * $query->filterByChemistCallAvg(['foo', 'bar']); // WHERE chemist_call_avg IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $chemistCallAvg The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByChemistCallAvg($chemistCallAvg = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($chemistCallAvg)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_CHEMIST_CALL_AVG, $chemistCallAvg, $comparison);

        return $this;
    }

    /**
     * Filter the query on the total_stockists column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalStockists('fooValue');   // WHERE total_stockists = 'fooValue'
     * $query->filterByTotalStockists('%fooValue%', Criteria::LIKE); // WHERE total_stockists LIKE '%fooValue%'
     * $query->filterByTotalStockists(['foo', 'bar']); // WHERE total_stockists IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $totalStockists The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTotalStockists($totalStockists = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($totalStockists)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_TOTAL_STOCKISTS, $totalStockists, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dr_addition column
     *
     * Example usage:
     * <code>
     * $query->filterByDrAddition('fooValue');   // WHERE dr_addition = 'fooValue'
     * $query->filterByDrAddition('%fooValue%', Criteria::LIKE); // WHERE dr_addition LIKE '%fooValue%'
     * $query->filterByDrAddition(['foo', 'bar']); // WHERE dr_addition IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $drAddition The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDrAddition($drAddition = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($drAddition)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_DR_ADDITION, $drAddition, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dr_deletion column
     *
     * Example usage:
     * <code>
     * $query->filterByDrDeletion('fooValue');   // WHERE dr_deletion = 'fooValue'
     * $query->filterByDrDeletion('%fooValue%', Criteria::LIKE); // WHERE dr_deletion LIKE '%fooValue%'
     * $query->filterByDrDeletion(['foo', 'bar']); // WHERE dr_deletion IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $drDeletion The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDrDeletion($drDeletion = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($drDeletion)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_DR_DELETION, $drDeletion, $comparison);

        return $this;
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, ?string $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(WriteMasTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(WriteMasTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_CREATED_AT, $createdAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, ?string $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(WriteMasTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(WriteMasTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(WriteMasTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildWriteMas $writeMas Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($writeMas = null)
    {
        if ($writeMas) {
            $this->addUsingAlias(WriteMasTableMap::COL_MAS_REPORT_ID, $writeMas->getMasReportId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the write_mas table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WriteMasTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WriteMasTableMap::clearInstancePool();
            WriteMasTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WriteMasTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WriteMasTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WriteMasTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WriteMasTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
