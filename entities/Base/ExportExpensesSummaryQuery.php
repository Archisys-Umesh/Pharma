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
use entities\ExportExpensesSummary as ChildExportExpensesSummary;
use entities\ExportExpensesSummaryQuery as ChildExportExpensesSummaryQuery;
use entities\Map\ExportExpensesSummaryTableMap;

/**
 * Base class that represents a query for the `export_expenses_summary` table.
 *
 * @method     ChildExportExpensesSummaryQuery orderByUniqueid($order = Criteria::ASC) Order by the uniqueid column
 * @method     ChildExportExpensesSummaryQuery orderByEmployeeId($order = Criteria::ASC) Order by the employee_id column
 * @method     ChildExportExpensesSummaryQuery orderByPositionId($order = Criteria::ASC) Order by the position_id column
 * @method     ChildExportExpensesSummaryQuery orderByOrgunitid($order = Criteria::ASC) Order by the orgunitid column
 * @method     ChildExportExpensesSummaryQuery orderByBuName($order = Criteria::ASC) Order by the bu_name column
 * @method     ChildExportExpensesSummaryQuery orderByEmpPositionCode($order = Criteria::ASC) Order by the emp_position_code column
 * @method     ChildExportExpensesSummaryQuery orderByEmpPositionName($order = Criteria::ASC) Order by the emp_position_name column
 * @method     ChildExportExpensesSummaryQuery orderByEmpLevel($order = Criteria::ASC) Order by the emp_level column
 * @method     ChildExportExpensesSummaryQuery orderByEmployeeCode($order = Criteria::ASC) Order by the employee_code column
 * @method     ChildExportExpensesSummaryQuery orderByEmployeeName($order = Criteria::ASC) Order by the employee_name column
 * @method     ChildExportExpensesSummaryQuery orderByReportingToEmployeeName($order = Criteria::ASC) Order by the reporting_to_employee_name column
 * @method     ChildExportExpensesSummaryQuery orderByReportingToEmployeeCode($order = Criteria::ASC) Order by the reporting_to_employee_code column
 * @method     ChildExportExpensesSummaryQuery orderByEmpTown($order = Criteria::ASC) Order by the emp_town column
 * @method     ChildExportExpensesSummaryQuery orderByEmpBranch($order = Criteria::ASC) Order by the emp_branch column
 * @method     ChildExportExpensesSummaryQuery orderByDesignation($order = Criteria::ASC) Order by the designation column
 * @method     ChildExportExpensesSummaryQuery orderByGrade($order = Criteria::ASC) Order by the grade column
 * @method     ChildExportExpensesSummaryQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildExportExpensesSummaryQuery orderByMonth($order = Criteria::ASC) Order by the month column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedAmount($order = Criteria::ASC) Order by the requested_amount column
 * @method     ChildExportExpensesSummaryQuery orderByApprovedAmount($order = Criteria::ASC) Order by the approved_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinalAmount($order = Criteria::ASC) Order by the final_amount column
 * @method     ChildExportExpensesSummaryQuery orderByExpenseStatus($order = Criteria::ASC) Order by the expense_status column
 * @method     ChildExportExpensesSummaryQuery orderByTotalExpenses($order = Criteria::ASC) Order by the total_expenses column
 * @method     ChildExportExpensesSummaryQuery orderByExpenseDates($order = Criteria::ASC) Order by the expense_dates column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedDaHqAmount($order = Criteria::ASC) Order by the requested_da_hq_amount column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedDaExHqAmount($order = Criteria::ASC) Order by the requested_da_ex_hq_amount column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedDaOsAmount($order = Criteria::ASC) Order by the requested_da_os_amount column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedAaTransitAmount($order = Criteria::ASC) Order by the requested_da_transit_amount column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedDaLastDayOsAmount($order = Criteria::ASC) Order by the requested_da_last_day_os_amount column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedTaAmount($order = Criteria::ASC) Order by the requested_ta_amount column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedInternetBillAmount($order = Criteria::ASC) Order by the requested_internet_bill_amount column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedOsPetrolAllowanceAmount($order = Criteria::ASC) Order by the requested_os_petrol_allowance_amount column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedIsbtAmount($order = Criteria::ASC) Order by the requested_isbt_amount column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedHillAllowanceAmount($order = Criteria::ASC) Order by the requested_hill_allowance_amount column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedIlpAmount($order = Criteria::ASC) Order by the requested_ilp_amount column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedMrConveyanceAmount($order = Criteria::ASC) Order by the requested_mr_conveyance_amount column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedAmConveyanceAmount($order = Criteria::ASC) Order by the requested_am_conveyance_amount column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedRmLodgingAndFoodAmount($order = Criteria::ASC) Order by the requested_rm_lodging_and_food_amount column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedHandsetAmount($order = Criteria::ASC) Order by the requested_handset_amount column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedHqPetrolAllowanceAmount($order = Criteria::ASC) Order by the requested_hq_petrol_allowance_amount column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedZmLodgingAndFoodAmount($order = Criteria::ASC) Order by the requested_zm_lodging_and_food_amount column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedRmMobileBillAmount($order = Criteria::ASC) Order by the requested_rm_mobile_bill_amount column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedZmLocalConveyanceAmount($order = Criteria::ASC) Order by the requested_zm_local_conveyance_amount column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedRmLocalConveyanceAmount($order = Criteria::ASC) Order by the requested_rm_local_conveyance_amount column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedZmMobileBillAmount($order = Criteria::ASC) Order by the requested_zm_mobile_bill_amount column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedStationeryAmount($order = Criteria::ASC) Order by the requested_stationery_amount column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedEventAmount($order = Criteria::ASC) Order by the requested_event_amount column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedOwnStayAmount($order = Criteria::ASC) Order by the requested_own_stay_amount column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedOtherZmLocalConveyanceAmount($order = Criteria::ASC) Order by the requested_other_zm_local_conveyance_amount column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedOtherOsPetrolAllowanceAmount($order = Criteria::ASC) Order by the requested_other_os_petrol_allowance_amount column
 * @method     ChildExportExpensesSummaryQuery orderByRequestedOtherRmLocalConveyanceAmount($order = Criteria::ASC) Order by the requested_other_rm_local_conveyance_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinalDaHqAmount($order = Criteria::ASC) Order by the final_da_hq_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinalDaExHqAmount($order = Criteria::ASC) Order by the final_da_ex_hq_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinalDaOsAmount($order = Criteria::ASC) Order by the final_da_os_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinalDaTransitAmount($order = Criteria::ASC) Order by the final_da_transit_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinalDaLastDayOsAmount($order = Criteria::ASC) Order by the final_da_last_day_os_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinalTaAmount($order = Criteria::ASC) Order by the final_ta_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinalInternetBillAmount($order = Criteria::ASC) Order by the final_internet_bill_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinalOsPetrolAllowanceAmount($order = Criteria::ASC) Order by the final_os_petrol_allowance_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinalIsbtAmount($order = Criteria::ASC) Order by the final_isbt_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinalHillAllowanceAmount($order = Criteria::ASC) Order by the final_hill_allowance_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinalIlpAmount($order = Criteria::ASC) Order by the final_ilp_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinalMrConveyanceAmount($order = Criteria::ASC) Order by the final_mr_conveyance_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinalAmConveyanceAmount($order = Criteria::ASC) Order by the final_am_conveyance_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinalRmLodgingAndFoodAmount($order = Criteria::ASC) Order by the final_rm_lodging_and_food_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinalHandsetAmount($order = Criteria::ASC) Order by the final_handset_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinalHqPetrolAllowanceAmount($order = Criteria::ASC) Order by the final_hq_petrol_allowance_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinalZmLodgingAndFoodAmount($order = Criteria::ASC) Order by the final_zm_lodging_and_food_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinalRmMobileBillAmount($order = Criteria::ASC) Order by the final_rm_mobile_bill_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinalZmLocalConveyanceAmount($order = Criteria::ASC) Order by the final_zm_local_conveyance_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinalRmLocalConveyanceAmount($order = Criteria::ASC) Order by the final_rm_local_conveyance_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinalZmMobileBillAmount($order = Criteria::ASC) Order by the final_zm_mobile_bill_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinalStationeryAmount($order = Criteria::ASC) Order by the final_stationery_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinalEventAmount($order = Criteria::ASC) Order by the final_event_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinal_own_stay_amount($order = Criteria::ASC) Order by the final_own_stay_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinalOtherZmLocalConveyanceAmount($order = Criteria::ASC) Order by the final_other_zm_local_conveyance_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinalOtherOsPetrolAllowanceAmount($order = Criteria::ASC) Order by the final_other_os_petrol_allowance_amount column
 * @method     ChildExportExpensesSummaryQuery orderByFinalOtherRmLocalConveyanceAmount($order = Criteria::ASC) Order by the final_other_rm_local_conveyance_amount column
 *
 * @method     ChildExportExpensesSummaryQuery groupByUniqueid() Group by the uniqueid column
 * @method     ChildExportExpensesSummaryQuery groupByEmployeeId() Group by the employee_id column
 * @method     ChildExportExpensesSummaryQuery groupByPositionId() Group by the position_id column
 * @method     ChildExportExpensesSummaryQuery groupByOrgunitid() Group by the orgunitid column
 * @method     ChildExportExpensesSummaryQuery groupByBuName() Group by the bu_name column
 * @method     ChildExportExpensesSummaryQuery groupByEmpPositionCode() Group by the emp_position_code column
 * @method     ChildExportExpensesSummaryQuery groupByEmpPositionName() Group by the emp_position_name column
 * @method     ChildExportExpensesSummaryQuery groupByEmpLevel() Group by the emp_level column
 * @method     ChildExportExpensesSummaryQuery groupByEmployeeCode() Group by the employee_code column
 * @method     ChildExportExpensesSummaryQuery groupByEmployeeName() Group by the employee_name column
 * @method     ChildExportExpensesSummaryQuery groupByReportingToEmployeeName() Group by the reporting_to_employee_name column
 * @method     ChildExportExpensesSummaryQuery groupByReportingToEmployeeCode() Group by the reporting_to_employee_code column
 * @method     ChildExportExpensesSummaryQuery groupByEmpTown() Group by the emp_town column
 * @method     ChildExportExpensesSummaryQuery groupByEmpBranch() Group by the emp_branch column
 * @method     ChildExportExpensesSummaryQuery groupByDesignation() Group by the designation column
 * @method     ChildExportExpensesSummaryQuery groupByGrade() Group by the grade column
 * @method     ChildExportExpensesSummaryQuery groupByStatus() Group by the status column
 * @method     ChildExportExpensesSummaryQuery groupByMonth() Group by the month column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedAmount() Group by the requested_amount column
 * @method     ChildExportExpensesSummaryQuery groupByApprovedAmount() Group by the approved_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinalAmount() Group by the final_amount column
 * @method     ChildExportExpensesSummaryQuery groupByExpenseStatus() Group by the expense_status column
 * @method     ChildExportExpensesSummaryQuery groupByTotalExpenses() Group by the total_expenses column
 * @method     ChildExportExpensesSummaryQuery groupByExpenseDates() Group by the expense_dates column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedDaHqAmount() Group by the requested_da_hq_amount column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedDaExHqAmount() Group by the requested_da_ex_hq_amount column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedDaOsAmount() Group by the requested_da_os_amount column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedAaTransitAmount() Group by the requested_da_transit_amount column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedDaLastDayOsAmount() Group by the requested_da_last_day_os_amount column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedTaAmount() Group by the requested_ta_amount column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedInternetBillAmount() Group by the requested_internet_bill_amount column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedOsPetrolAllowanceAmount() Group by the requested_os_petrol_allowance_amount column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedIsbtAmount() Group by the requested_isbt_amount column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedHillAllowanceAmount() Group by the requested_hill_allowance_amount column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedIlpAmount() Group by the requested_ilp_amount column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedMrConveyanceAmount() Group by the requested_mr_conveyance_amount column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedAmConveyanceAmount() Group by the requested_am_conveyance_amount column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedRmLodgingAndFoodAmount() Group by the requested_rm_lodging_and_food_amount column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedHandsetAmount() Group by the requested_handset_amount column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedHqPetrolAllowanceAmount() Group by the requested_hq_petrol_allowance_amount column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedZmLodgingAndFoodAmount() Group by the requested_zm_lodging_and_food_amount column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedRmMobileBillAmount() Group by the requested_rm_mobile_bill_amount column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedZmLocalConveyanceAmount() Group by the requested_zm_local_conveyance_amount column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedRmLocalConveyanceAmount() Group by the requested_rm_local_conveyance_amount column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedZmMobileBillAmount() Group by the requested_zm_mobile_bill_amount column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedStationeryAmount() Group by the requested_stationery_amount column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedEventAmount() Group by the requested_event_amount column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedOwnStayAmount() Group by the requested_own_stay_amount column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedOtherZmLocalConveyanceAmount() Group by the requested_other_zm_local_conveyance_amount column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedOtherOsPetrolAllowanceAmount() Group by the requested_other_os_petrol_allowance_amount column
 * @method     ChildExportExpensesSummaryQuery groupByRequestedOtherRmLocalConveyanceAmount() Group by the requested_other_rm_local_conveyance_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinalDaHqAmount() Group by the final_da_hq_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinalDaExHqAmount() Group by the final_da_ex_hq_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinalDaOsAmount() Group by the final_da_os_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinalDaTransitAmount() Group by the final_da_transit_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinalDaLastDayOsAmount() Group by the final_da_last_day_os_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinalTaAmount() Group by the final_ta_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinalInternetBillAmount() Group by the final_internet_bill_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinalOsPetrolAllowanceAmount() Group by the final_os_petrol_allowance_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinalIsbtAmount() Group by the final_isbt_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinalHillAllowanceAmount() Group by the final_hill_allowance_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinalIlpAmount() Group by the final_ilp_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinalMrConveyanceAmount() Group by the final_mr_conveyance_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinalAmConveyanceAmount() Group by the final_am_conveyance_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinalRmLodgingAndFoodAmount() Group by the final_rm_lodging_and_food_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinalHandsetAmount() Group by the final_handset_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinalHqPetrolAllowanceAmount() Group by the final_hq_petrol_allowance_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinalZmLodgingAndFoodAmount() Group by the final_zm_lodging_and_food_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinalRmMobileBillAmount() Group by the final_rm_mobile_bill_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinalZmLocalConveyanceAmount() Group by the final_zm_local_conveyance_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinalRmLocalConveyanceAmount() Group by the final_rm_local_conveyance_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinalZmMobileBillAmount() Group by the final_zm_mobile_bill_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinalStationeryAmount() Group by the final_stationery_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinalEventAmount() Group by the final_event_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinal_own_stay_amount() Group by the final_own_stay_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinalOtherZmLocalConveyanceAmount() Group by the final_other_zm_local_conveyance_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinalOtherOsPetrolAllowanceAmount() Group by the final_other_os_petrol_allowance_amount column
 * @method     ChildExportExpensesSummaryQuery groupByFinalOtherRmLocalConveyanceAmount() Group by the final_other_rm_local_conveyance_amount column
 *
 * @method     ChildExportExpensesSummaryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildExportExpensesSummaryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildExportExpensesSummaryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildExportExpensesSummaryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildExportExpensesSummaryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildExportExpensesSummaryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildExportExpensesSummary|null findOne(?ConnectionInterface $con = null) Return the first ChildExportExpensesSummary matching the query
 * @method     ChildExportExpensesSummary findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildExportExpensesSummary matching the query, or a new ChildExportExpensesSummary object populated from the query conditions when no match is found
 *
 * @method     ChildExportExpensesSummary|null findOneByUniqueid(int $uniqueid) Return the first ChildExportExpensesSummary filtered by the uniqueid column
 * @method     ChildExportExpensesSummary|null findOneByEmployeeId(int $employee_id) Return the first ChildExportExpensesSummary filtered by the employee_id column
 * @method     ChildExportExpensesSummary|null findOneByPositionId(int $position_id) Return the first ChildExportExpensesSummary filtered by the position_id column
 * @method     ChildExportExpensesSummary|null findOneByOrgunitid(int $orgunitid) Return the first ChildExportExpensesSummary filtered by the orgunitid column
 * @method     ChildExportExpensesSummary|null findOneByBuName(string $bu_name) Return the first ChildExportExpensesSummary filtered by the bu_name column
 * @method     ChildExportExpensesSummary|null findOneByEmpPositionCode(string $emp_position_code) Return the first ChildExportExpensesSummary filtered by the emp_position_code column
 * @method     ChildExportExpensesSummary|null findOneByEmpPositionName(string $emp_position_name) Return the first ChildExportExpensesSummary filtered by the emp_position_name column
 * @method     ChildExportExpensesSummary|null findOneByEmpLevel(string $emp_level) Return the first ChildExportExpensesSummary filtered by the emp_level column
 * @method     ChildExportExpensesSummary|null findOneByEmployeeCode(string $employee_code) Return the first ChildExportExpensesSummary filtered by the employee_code column
 * @method     ChildExportExpensesSummary|null findOneByEmployeeName(string $employee_name) Return the first ChildExportExpensesSummary filtered by the employee_name column
 * @method     ChildExportExpensesSummary|null findOneByReportingToEmployeeName(string $reporting_to_employee_name) Return the first ChildExportExpensesSummary filtered by the reporting_to_employee_name column
 * @method     ChildExportExpensesSummary|null findOneByReportingToEmployeeCode(string $reporting_to_employee_code) Return the first ChildExportExpensesSummary filtered by the reporting_to_employee_code column
 * @method     ChildExportExpensesSummary|null findOneByEmpTown(string $emp_town) Return the first ChildExportExpensesSummary filtered by the emp_town column
 * @method     ChildExportExpensesSummary|null findOneByEmpBranch(string $emp_branch) Return the first ChildExportExpensesSummary filtered by the emp_branch column
 * @method     ChildExportExpensesSummary|null findOneByDesignation(string $designation) Return the first ChildExportExpensesSummary filtered by the designation column
 * @method     ChildExportExpensesSummary|null findOneByGrade(string $grade) Return the first ChildExportExpensesSummary filtered by the grade column
 * @method     ChildExportExpensesSummary|null findOneByStatus(string $status) Return the first ChildExportExpensesSummary filtered by the status column
 * @method     ChildExportExpensesSummary|null findOneByMonth(string $month) Return the first ChildExportExpensesSummary filtered by the month column
 * @method     ChildExportExpensesSummary|null findOneByRequestedAmount(string $requested_amount) Return the first ChildExportExpensesSummary filtered by the requested_amount column
 * @method     ChildExportExpensesSummary|null findOneByApprovedAmount(string $approved_amount) Return the first ChildExportExpensesSummary filtered by the approved_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinalAmount(string $final_amount) Return the first ChildExportExpensesSummary filtered by the final_amount column
 * @method     ChildExportExpensesSummary|null findOneByExpenseStatus(string $expense_status) Return the first ChildExportExpensesSummary filtered by the expense_status column
 * @method     ChildExportExpensesSummary|null findOneByTotalExpenses(int $total_expenses) Return the first ChildExportExpensesSummary filtered by the total_expenses column
 * @method     ChildExportExpensesSummary|null findOneByExpenseDates(string $expense_dates) Return the first ChildExportExpensesSummary filtered by the expense_dates column
 * @method     ChildExportExpensesSummary|null findOneByRequestedDaHqAmount(string $requested_da_hq_amount) Return the first ChildExportExpensesSummary filtered by the requested_da_hq_amount column
 * @method     ChildExportExpensesSummary|null findOneByRequestedDaExHqAmount(string $requested_da_ex_hq_amount) Return the first ChildExportExpensesSummary filtered by the requested_da_ex_hq_amount column
 * @method     ChildExportExpensesSummary|null findOneByRequestedDaOsAmount(string $requested_da_os_amount) Return the first ChildExportExpensesSummary filtered by the requested_da_os_amount column
 * @method     ChildExportExpensesSummary|null findOneByRequestedAaTransitAmount(string $requested_da_transit_amount) Return the first ChildExportExpensesSummary filtered by the requested_da_transit_amount column
 * @method     ChildExportExpensesSummary|null findOneByRequestedDaLastDayOsAmount(string $requested_da_last_day_os_amount) Return the first ChildExportExpensesSummary filtered by the requested_da_last_day_os_amount column
 * @method     ChildExportExpensesSummary|null findOneByRequestedTaAmount(string $requested_ta_amount) Return the first ChildExportExpensesSummary filtered by the requested_ta_amount column
 * @method     ChildExportExpensesSummary|null findOneByRequestedInternetBillAmount(string $requested_internet_bill_amount) Return the first ChildExportExpensesSummary filtered by the requested_internet_bill_amount column
 * @method     ChildExportExpensesSummary|null findOneByRequestedOsPetrolAllowanceAmount(string $requested_os_petrol_allowance_amount) Return the first ChildExportExpensesSummary filtered by the requested_os_petrol_allowance_amount column
 * @method     ChildExportExpensesSummary|null findOneByRequestedIsbtAmount(string $requested_isbt_amount) Return the first ChildExportExpensesSummary filtered by the requested_isbt_amount column
 * @method     ChildExportExpensesSummary|null findOneByRequestedHillAllowanceAmount(string $requested_hill_allowance_amount) Return the first ChildExportExpensesSummary filtered by the requested_hill_allowance_amount column
 * @method     ChildExportExpensesSummary|null findOneByRequestedIlpAmount(string $requested_ilp_amount) Return the first ChildExportExpensesSummary filtered by the requested_ilp_amount column
 * @method     ChildExportExpensesSummary|null findOneByRequestedMrConveyanceAmount(string $requested_mr_conveyance_amount) Return the first ChildExportExpensesSummary filtered by the requested_mr_conveyance_amount column
 * @method     ChildExportExpensesSummary|null findOneByRequestedAmConveyanceAmount(string $requested_am_conveyance_amount) Return the first ChildExportExpensesSummary filtered by the requested_am_conveyance_amount column
 * @method     ChildExportExpensesSummary|null findOneByRequestedRmLodgingAndFoodAmount(string $requested_rm_lodging_and_food_amount) Return the first ChildExportExpensesSummary filtered by the requested_rm_lodging_and_food_amount column
 * @method     ChildExportExpensesSummary|null findOneByRequestedHandsetAmount(string $requested_handset_amount) Return the first ChildExportExpensesSummary filtered by the requested_handset_amount column
 * @method     ChildExportExpensesSummary|null findOneByRequestedHqPetrolAllowanceAmount(string $requested_hq_petrol_allowance_amount) Return the first ChildExportExpensesSummary filtered by the requested_hq_petrol_allowance_amount column
 * @method     ChildExportExpensesSummary|null findOneByRequestedZmLodgingAndFoodAmount(string $requested_zm_lodging_and_food_amount) Return the first ChildExportExpensesSummary filtered by the requested_zm_lodging_and_food_amount column
 * @method     ChildExportExpensesSummary|null findOneByRequestedRmMobileBillAmount(string $requested_rm_mobile_bill_amount) Return the first ChildExportExpensesSummary filtered by the requested_rm_mobile_bill_amount column
 * @method     ChildExportExpensesSummary|null findOneByRequestedZmLocalConveyanceAmount(string $requested_zm_local_conveyance_amount) Return the first ChildExportExpensesSummary filtered by the requested_zm_local_conveyance_amount column
 * @method     ChildExportExpensesSummary|null findOneByRequestedRmLocalConveyanceAmount(string $requested_rm_local_conveyance_amount) Return the first ChildExportExpensesSummary filtered by the requested_rm_local_conveyance_amount column
 * @method     ChildExportExpensesSummary|null findOneByRequestedZmMobileBillAmount(string $requested_zm_mobile_bill_amount) Return the first ChildExportExpensesSummary filtered by the requested_zm_mobile_bill_amount column
 * @method     ChildExportExpensesSummary|null findOneByRequestedStationeryAmount(string $requested_stationery_amount) Return the first ChildExportExpensesSummary filtered by the requested_stationery_amount column
 * @method     ChildExportExpensesSummary|null findOneByRequestedEventAmount(string $requested_event_amount) Return the first ChildExportExpensesSummary filtered by the requested_event_amount column
 * @method     ChildExportExpensesSummary|null findOneByRequestedOwnStayAmount(string $requested_own_stay_amount) Return the first ChildExportExpensesSummary filtered by the requested_own_stay_amount column
 * @method     ChildExportExpensesSummary|null findOneByRequestedOtherZmLocalConveyanceAmount(string $requested_other_zm_local_conveyance_amount) Return the first ChildExportExpensesSummary filtered by the requested_other_zm_local_conveyance_amount column
 * @method     ChildExportExpensesSummary|null findOneByRequestedOtherOsPetrolAllowanceAmount(string $requested_other_os_petrol_allowance_amount) Return the first ChildExportExpensesSummary filtered by the requested_other_os_petrol_allowance_amount column
 * @method     ChildExportExpensesSummary|null findOneByRequestedOtherRmLocalConveyanceAmount(string $requested_other_rm_local_conveyance_amount) Return the first ChildExportExpensesSummary filtered by the requested_other_rm_local_conveyance_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinalDaHqAmount(string $final_da_hq_amount) Return the first ChildExportExpensesSummary filtered by the final_da_hq_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinalDaExHqAmount(string $final_da_ex_hq_amount) Return the first ChildExportExpensesSummary filtered by the final_da_ex_hq_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinalDaOsAmount(string $final_da_os_amount) Return the first ChildExportExpensesSummary filtered by the final_da_os_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinalDaTransitAmount(string $final_da_transit_amount) Return the first ChildExportExpensesSummary filtered by the final_da_transit_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinalDaLastDayOsAmount(string $final_da_last_day_os_amount) Return the first ChildExportExpensesSummary filtered by the final_da_last_day_os_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinalTaAmount(string $final_ta_amount) Return the first ChildExportExpensesSummary filtered by the final_ta_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinalInternetBillAmount(string $final_internet_bill_amount) Return the first ChildExportExpensesSummary filtered by the final_internet_bill_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinalOsPetrolAllowanceAmount(string $final_os_petrol_allowance_amount) Return the first ChildExportExpensesSummary filtered by the final_os_petrol_allowance_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinalIsbtAmount(string $final_isbt_amount) Return the first ChildExportExpensesSummary filtered by the final_isbt_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinalHillAllowanceAmount(string $final_hill_allowance_amount) Return the first ChildExportExpensesSummary filtered by the final_hill_allowance_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinalIlpAmount(string $final_ilp_amount) Return the first ChildExportExpensesSummary filtered by the final_ilp_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinalMrConveyanceAmount(string $final_mr_conveyance_amount) Return the first ChildExportExpensesSummary filtered by the final_mr_conveyance_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinalAmConveyanceAmount(string $final_am_conveyance_amount) Return the first ChildExportExpensesSummary filtered by the final_am_conveyance_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinalRmLodgingAndFoodAmount(string $final_rm_lodging_and_food_amount) Return the first ChildExportExpensesSummary filtered by the final_rm_lodging_and_food_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinalHandsetAmount(string $final_handset_amount) Return the first ChildExportExpensesSummary filtered by the final_handset_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinalHqPetrolAllowanceAmount(string $final_hq_petrol_allowance_amount) Return the first ChildExportExpensesSummary filtered by the final_hq_petrol_allowance_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinalZmLodgingAndFoodAmount(string $final_zm_lodging_and_food_amount) Return the first ChildExportExpensesSummary filtered by the final_zm_lodging_and_food_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinalRmMobileBillAmount(string $final_rm_mobile_bill_amount) Return the first ChildExportExpensesSummary filtered by the final_rm_mobile_bill_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinalZmLocalConveyanceAmount(string $final_zm_local_conveyance_amount) Return the first ChildExportExpensesSummary filtered by the final_zm_local_conveyance_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinalRmLocalConveyanceAmount(string $final_rm_local_conveyance_amount) Return the first ChildExportExpensesSummary filtered by the final_rm_local_conveyance_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinalZmMobileBillAmount(string $final_zm_mobile_bill_amount) Return the first ChildExportExpensesSummary filtered by the final_zm_mobile_bill_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinalStationeryAmount(string $final_stationery_amount) Return the first ChildExportExpensesSummary filtered by the final_stationery_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinalEventAmount(string $final_event_amount) Return the first ChildExportExpensesSummary filtered by the final_event_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinal_own_stay_amount(string $final_own_stay_amount) Return the first ChildExportExpensesSummary filtered by the final_own_stay_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinalOtherZmLocalConveyanceAmount(string $final_other_zm_local_conveyance_amount) Return the first ChildExportExpensesSummary filtered by the final_other_zm_local_conveyance_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinalOtherOsPetrolAllowanceAmount(string $final_other_os_petrol_allowance_amount) Return the first ChildExportExpensesSummary filtered by the final_other_os_petrol_allowance_amount column
 * @method     ChildExportExpensesSummary|null findOneByFinalOtherRmLocalConveyanceAmount(string $final_other_rm_local_conveyance_amount) Return the first ChildExportExpensesSummary filtered by the final_other_rm_local_conveyance_amount column
 *
 * @method     ChildExportExpensesSummary requirePk($key, ?ConnectionInterface $con = null) Return the ChildExportExpensesSummary by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOne(?ConnectionInterface $con = null) Return the first ChildExportExpensesSummary matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExportExpensesSummary requireOneByUniqueid(int $uniqueid) Return the first ChildExportExpensesSummary filtered by the uniqueid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByEmployeeId(int $employee_id) Return the first ChildExportExpensesSummary filtered by the employee_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByPositionId(int $position_id) Return the first ChildExportExpensesSummary filtered by the position_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByOrgunitid(int $orgunitid) Return the first ChildExportExpensesSummary filtered by the orgunitid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByBuName(string $bu_name) Return the first ChildExportExpensesSummary filtered by the bu_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByEmpPositionCode(string $emp_position_code) Return the first ChildExportExpensesSummary filtered by the emp_position_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByEmpPositionName(string $emp_position_name) Return the first ChildExportExpensesSummary filtered by the emp_position_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByEmpLevel(string $emp_level) Return the first ChildExportExpensesSummary filtered by the emp_level column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByEmployeeCode(string $employee_code) Return the first ChildExportExpensesSummary filtered by the employee_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByEmployeeName(string $employee_name) Return the first ChildExportExpensesSummary filtered by the employee_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByReportingToEmployeeName(string $reporting_to_employee_name) Return the first ChildExportExpensesSummary filtered by the reporting_to_employee_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByReportingToEmployeeCode(string $reporting_to_employee_code) Return the first ChildExportExpensesSummary filtered by the reporting_to_employee_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByEmpTown(string $emp_town) Return the first ChildExportExpensesSummary filtered by the emp_town column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByEmpBranch(string $emp_branch) Return the first ChildExportExpensesSummary filtered by the emp_branch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByDesignation(string $designation) Return the first ChildExportExpensesSummary filtered by the designation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByGrade(string $grade) Return the first ChildExportExpensesSummary filtered by the grade column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByStatus(string $status) Return the first ChildExportExpensesSummary filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByMonth(string $month) Return the first ChildExportExpensesSummary filtered by the month column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedAmount(string $requested_amount) Return the first ChildExportExpensesSummary filtered by the requested_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByApprovedAmount(string $approved_amount) Return the first ChildExportExpensesSummary filtered by the approved_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinalAmount(string $final_amount) Return the first ChildExportExpensesSummary filtered by the final_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByExpenseStatus(string $expense_status) Return the first ChildExportExpensesSummary filtered by the expense_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByTotalExpenses(int $total_expenses) Return the first ChildExportExpensesSummary filtered by the total_expenses column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByExpenseDates(string $expense_dates) Return the first ChildExportExpensesSummary filtered by the expense_dates column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedDaHqAmount(string $requested_da_hq_amount) Return the first ChildExportExpensesSummary filtered by the requested_da_hq_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedDaExHqAmount(string $requested_da_ex_hq_amount) Return the first ChildExportExpensesSummary filtered by the requested_da_ex_hq_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedDaOsAmount(string $requested_da_os_amount) Return the first ChildExportExpensesSummary filtered by the requested_da_os_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedAaTransitAmount(string $requested_da_transit_amount) Return the first ChildExportExpensesSummary filtered by the requested_da_transit_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedDaLastDayOsAmount(string $requested_da_last_day_os_amount) Return the first ChildExportExpensesSummary filtered by the requested_da_last_day_os_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedTaAmount(string $requested_ta_amount) Return the first ChildExportExpensesSummary filtered by the requested_ta_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedInternetBillAmount(string $requested_internet_bill_amount) Return the first ChildExportExpensesSummary filtered by the requested_internet_bill_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedOsPetrolAllowanceAmount(string $requested_os_petrol_allowance_amount) Return the first ChildExportExpensesSummary filtered by the requested_os_petrol_allowance_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedIsbtAmount(string $requested_isbt_amount) Return the first ChildExportExpensesSummary filtered by the requested_isbt_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedHillAllowanceAmount(string $requested_hill_allowance_amount) Return the first ChildExportExpensesSummary filtered by the requested_hill_allowance_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedIlpAmount(string $requested_ilp_amount) Return the first ChildExportExpensesSummary filtered by the requested_ilp_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedMrConveyanceAmount(string $requested_mr_conveyance_amount) Return the first ChildExportExpensesSummary filtered by the requested_mr_conveyance_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedAmConveyanceAmount(string $requested_am_conveyance_amount) Return the first ChildExportExpensesSummary filtered by the requested_am_conveyance_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedRmLodgingAndFoodAmount(string $requested_rm_lodging_and_food_amount) Return the first ChildExportExpensesSummary filtered by the requested_rm_lodging_and_food_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedHandsetAmount(string $requested_handset_amount) Return the first ChildExportExpensesSummary filtered by the requested_handset_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedHqPetrolAllowanceAmount(string $requested_hq_petrol_allowance_amount) Return the first ChildExportExpensesSummary filtered by the requested_hq_petrol_allowance_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedZmLodgingAndFoodAmount(string $requested_zm_lodging_and_food_amount) Return the first ChildExportExpensesSummary filtered by the requested_zm_lodging_and_food_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedRmMobileBillAmount(string $requested_rm_mobile_bill_amount) Return the first ChildExportExpensesSummary filtered by the requested_rm_mobile_bill_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedZmLocalConveyanceAmount(string $requested_zm_local_conveyance_amount) Return the first ChildExportExpensesSummary filtered by the requested_zm_local_conveyance_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedRmLocalConveyanceAmount(string $requested_rm_local_conveyance_amount) Return the first ChildExportExpensesSummary filtered by the requested_rm_local_conveyance_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedZmMobileBillAmount(string $requested_zm_mobile_bill_amount) Return the first ChildExportExpensesSummary filtered by the requested_zm_mobile_bill_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedStationeryAmount(string $requested_stationery_amount) Return the first ChildExportExpensesSummary filtered by the requested_stationery_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedEventAmount(string $requested_event_amount) Return the first ChildExportExpensesSummary filtered by the requested_event_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedOwnStayAmount(string $requested_own_stay_amount) Return the first ChildExportExpensesSummary filtered by the requested_own_stay_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedOtherZmLocalConveyanceAmount(string $requested_other_zm_local_conveyance_amount) Return the first ChildExportExpensesSummary filtered by the requested_other_zm_local_conveyance_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedOtherOsPetrolAllowanceAmount(string $requested_other_os_petrol_allowance_amount) Return the first ChildExportExpensesSummary filtered by the requested_other_os_petrol_allowance_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByRequestedOtherRmLocalConveyanceAmount(string $requested_other_rm_local_conveyance_amount) Return the first ChildExportExpensesSummary filtered by the requested_other_rm_local_conveyance_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinalDaHqAmount(string $final_da_hq_amount) Return the first ChildExportExpensesSummary filtered by the final_da_hq_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinalDaExHqAmount(string $final_da_ex_hq_amount) Return the first ChildExportExpensesSummary filtered by the final_da_ex_hq_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinalDaOsAmount(string $final_da_os_amount) Return the first ChildExportExpensesSummary filtered by the final_da_os_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinalDaTransitAmount(string $final_da_transit_amount) Return the first ChildExportExpensesSummary filtered by the final_da_transit_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinalDaLastDayOsAmount(string $final_da_last_day_os_amount) Return the first ChildExportExpensesSummary filtered by the final_da_last_day_os_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinalTaAmount(string $final_ta_amount) Return the first ChildExportExpensesSummary filtered by the final_ta_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinalInternetBillAmount(string $final_internet_bill_amount) Return the first ChildExportExpensesSummary filtered by the final_internet_bill_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinalOsPetrolAllowanceAmount(string $final_os_petrol_allowance_amount) Return the first ChildExportExpensesSummary filtered by the final_os_petrol_allowance_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinalIsbtAmount(string $final_isbt_amount) Return the first ChildExportExpensesSummary filtered by the final_isbt_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinalHillAllowanceAmount(string $final_hill_allowance_amount) Return the first ChildExportExpensesSummary filtered by the final_hill_allowance_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinalIlpAmount(string $final_ilp_amount) Return the first ChildExportExpensesSummary filtered by the final_ilp_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinalMrConveyanceAmount(string $final_mr_conveyance_amount) Return the first ChildExportExpensesSummary filtered by the final_mr_conveyance_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinalAmConveyanceAmount(string $final_am_conveyance_amount) Return the first ChildExportExpensesSummary filtered by the final_am_conveyance_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinalRmLodgingAndFoodAmount(string $final_rm_lodging_and_food_amount) Return the first ChildExportExpensesSummary filtered by the final_rm_lodging_and_food_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinalHandsetAmount(string $final_handset_amount) Return the first ChildExportExpensesSummary filtered by the final_handset_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinalHqPetrolAllowanceAmount(string $final_hq_petrol_allowance_amount) Return the first ChildExportExpensesSummary filtered by the final_hq_petrol_allowance_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinalZmLodgingAndFoodAmount(string $final_zm_lodging_and_food_amount) Return the first ChildExportExpensesSummary filtered by the final_zm_lodging_and_food_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinalRmMobileBillAmount(string $final_rm_mobile_bill_amount) Return the first ChildExportExpensesSummary filtered by the final_rm_mobile_bill_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinalZmLocalConveyanceAmount(string $final_zm_local_conveyance_amount) Return the first ChildExportExpensesSummary filtered by the final_zm_local_conveyance_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinalRmLocalConveyanceAmount(string $final_rm_local_conveyance_amount) Return the first ChildExportExpensesSummary filtered by the final_rm_local_conveyance_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinalZmMobileBillAmount(string $final_zm_mobile_bill_amount) Return the first ChildExportExpensesSummary filtered by the final_zm_mobile_bill_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinalStationeryAmount(string $final_stationery_amount) Return the first ChildExportExpensesSummary filtered by the final_stationery_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinalEventAmount(string $final_event_amount) Return the first ChildExportExpensesSummary filtered by the final_event_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinal_own_stay_amount(string $final_own_stay_amount) Return the first ChildExportExpensesSummary filtered by the final_own_stay_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinalOtherZmLocalConveyanceAmount(string $final_other_zm_local_conveyance_amount) Return the first ChildExportExpensesSummary filtered by the final_other_zm_local_conveyance_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinalOtherOsPetrolAllowanceAmount(string $final_other_os_petrol_allowance_amount) Return the first ChildExportExpensesSummary filtered by the final_other_os_petrol_allowance_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExportExpensesSummary requireOneByFinalOtherRmLocalConveyanceAmount(string $final_other_rm_local_conveyance_amount) Return the first ChildExportExpensesSummary filtered by the final_other_rm_local_conveyance_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExportExpensesSummary[]|Collection find(?ConnectionInterface $con = null) Return ChildExportExpensesSummary objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> find(?ConnectionInterface $con = null) Return ChildExportExpensesSummary objects based on current ModelCriteria
 *
 * @method     ChildExportExpensesSummary[]|Collection findByUniqueid(int|array<int> $uniqueid) Return ChildExportExpensesSummary objects filtered by the uniqueid column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByUniqueid(int|array<int> $uniqueid) Return ChildExportExpensesSummary objects filtered by the uniqueid column
 * @method     ChildExportExpensesSummary[]|Collection findByEmployeeId(int|array<int> $employee_id) Return ChildExportExpensesSummary objects filtered by the employee_id column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByEmployeeId(int|array<int> $employee_id) Return ChildExportExpensesSummary objects filtered by the employee_id column
 * @method     ChildExportExpensesSummary[]|Collection findByPositionId(int|array<int> $position_id) Return ChildExportExpensesSummary objects filtered by the position_id column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByPositionId(int|array<int> $position_id) Return ChildExportExpensesSummary objects filtered by the position_id column
 * @method     ChildExportExpensesSummary[]|Collection findByOrgunitid(int|array<int> $orgunitid) Return ChildExportExpensesSummary objects filtered by the orgunitid column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByOrgunitid(int|array<int> $orgunitid) Return ChildExportExpensesSummary objects filtered by the orgunitid column
 * @method     ChildExportExpensesSummary[]|Collection findByBuName(string|array<string> $bu_name) Return ChildExportExpensesSummary objects filtered by the bu_name column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByBuName(string|array<string> $bu_name) Return ChildExportExpensesSummary objects filtered by the bu_name column
 * @method     ChildExportExpensesSummary[]|Collection findByEmpPositionCode(string|array<string> $emp_position_code) Return ChildExportExpensesSummary objects filtered by the emp_position_code column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByEmpPositionCode(string|array<string> $emp_position_code) Return ChildExportExpensesSummary objects filtered by the emp_position_code column
 * @method     ChildExportExpensesSummary[]|Collection findByEmpPositionName(string|array<string> $emp_position_name) Return ChildExportExpensesSummary objects filtered by the emp_position_name column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByEmpPositionName(string|array<string> $emp_position_name) Return ChildExportExpensesSummary objects filtered by the emp_position_name column
 * @method     ChildExportExpensesSummary[]|Collection findByEmpLevel(string|array<string> $emp_level) Return ChildExportExpensesSummary objects filtered by the emp_level column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByEmpLevel(string|array<string> $emp_level) Return ChildExportExpensesSummary objects filtered by the emp_level column
 * @method     ChildExportExpensesSummary[]|Collection findByEmployeeCode(string|array<string> $employee_code) Return ChildExportExpensesSummary objects filtered by the employee_code column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByEmployeeCode(string|array<string> $employee_code) Return ChildExportExpensesSummary objects filtered by the employee_code column
 * @method     ChildExportExpensesSummary[]|Collection findByEmployeeName(string|array<string> $employee_name) Return ChildExportExpensesSummary objects filtered by the employee_name column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByEmployeeName(string|array<string> $employee_name) Return ChildExportExpensesSummary objects filtered by the employee_name column
 * @method     ChildExportExpensesSummary[]|Collection findByReportingToEmployeeName(string|array<string> $reporting_to_employee_name) Return ChildExportExpensesSummary objects filtered by the reporting_to_employee_name column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByReportingToEmployeeName(string|array<string> $reporting_to_employee_name) Return ChildExportExpensesSummary objects filtered by the reporting_to_employee_name column
 * @method     ChildExportExpensesSummary[]|Collection findByReportingToEmployeeCode(string|array<string> $reporting_to_employee_code) Return ChildExportExpensesSummary objects filtered by the reporting_to_employee_code column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByReportingToEmployeeCode(string|array<string> $reporting_to_employee_code) Return ChildExportExpensesSummary objects filtered by the reporting_to_employee_code column
 * @method     ChildExportExpensesSummary[]|Collection findByEmpTown(string|array<string> $emp_town) Return ChildExportExpensesSummary objects filtered by the emp_town column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByEmpTown(string|array<string> $emp_town) Return ChildExportExpensesSummary objects filtered by the emp_town column
 * @method     ChildExportExpensesSummary[]|Collection findByEmpBranch(string|array<string> $emp_branch) Return ChildExportExpensesSummary objects filtered by the emp_branch column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByEmpBranch(string|array<string> $emp_branch) Return ChildExportExpensesSummary objects filtered by the emp_branch column
 * @method     ChildExportExpensesSummary[]|Collection findByDesignation(string|array<string> $designation) Return ChildExportExpensesSummary objects filtered by the designation column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByDesignation(string|array<string> $designation) Return ChildExportExpensesSummary objects filtered by the designation column
 * @method     ChildExportExpensesSummary[]|Collection findByGrade(string|array<string> $grade) Return ChildExportExpensesSummary objects filtered by the grade column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByGrade(string|array<string> $grade) Return ChildExportExpensesSummary objects filtered by the grade column
 * @method     ChildExportExpensesSummary[]|Collection findByStatus(string|array<string> $status) Return ChildExportExpensesSummary objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByStatus(string|array<string> $status) Return ChildExportExpensesSummary objects filtered by the status column
 * @method     ChildExportExpensesSummary[]|Collection findByMonth(string|array<string> $month) Return ChildExportExpensesSummary objects filtered by the month column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByMonth(string|array<string> $month) Return ChildExportExpensesSummary objects filtered by the month column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedAmount(string|array<string> $requested_amount) Return ChildExportExpensesSummary objects filtered by the requested_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedAmount(string|array<string> $requested_amount) Return ChildExportExpensesSummary objects filtered by the requested_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByApprovedAmount(string|array<string> $approved_amount) Return ChildExportExpensesSummary objects filtered by the approved_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByApprovedAmount(string|array<string> $approved_amount) Return ChildExportExpensesSummary objects filtered by the approved_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinalAmount(string|array<string> $final_amount) Return ChildExportExpensesSummary objects filtered by the final_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinalAmount(string|array<string> $final_amount) Return ChildExportExpensesSummary objects filtered by the final_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByExpenseStatus(string|array<string> $expense_status) Return ChildExportExpensesSummary objects filtered by the expense_status column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByExpenseStatus(string|array<string> $expense_status) Return ChildExportExpensesSummary objects filtered by the expense_status column
 * @method     ChildExportExpensesSummary[]|Collection findByTotalExpenses(int|array<int> $total_expenses) Return ChildExportExpensesSummary objects filtered by the total_expenses column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByTotalExpenses(int|array<int> $total_expenses) Return ChildExportExpensesSummary objects filtered by the total_expenses column
 * @method     ChildExportExpensesSummary[]|Collection findByExpenseDates(string|array<string> $expense_dates) Return ChildExportExpensesSummary objects filtered by the expense_dates column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByExpenseDates(string|array<string> $expense_dates) Return ChildExportExpensesSummary objects filtered by the expense_dates column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedDaHqAmount(string|array<string> $requested_da_hq_amount) Return ChildExportExpensesSummary objects filtered by the requested_da_hq_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedDaHqAmount(string|array<string> $requested_da_hq_amount) Return ChildExportExpensesSummary objects filtered by the requested_da_hq_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedDaExHqAmount(string|array<string> $requested_da_ex_hq_amount) Return ChildExportExpensesSummary objects filtered by the requested_da_ex_hq_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedDaExHqAmount(string|array<string> $requested_da_ex_hq_amount) Return ChildExportExpensesSummary objects filtered by the requested_da_ex_hq_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedDaOsAmount(string|array<string> $requested_da_os_amount) Return ChildExportExpensesSummary objects filtered by the requested_da_os_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedDaOsAmount(string|array<string> $requested_da_os_amount) Return ChildExportExpensesSummary objects filtered by the requested_da_os_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedAaTransitAmount(string|array<string> $requested_da_transit_amount) Return ChildExportExpensesSummary objects filtered by the requested_da_transit_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedAaTransitAmount(string|array<string> $requested_da_transit_amount) Return ChildExportExpensesSummary objects filtered by the requested_da_transit_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedDaLastDayOsAmount(string|array<string> $requested_da_last_day_os_amount) Return ChildExportExpensesSummary objects filtered by the requested_da_last_day_os_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedDaLastDayOsAmount(string|array<string> $requested_da_last_day_os_amount) Return ChildExportExpensesSummary objects filtered by the requested_da_last_day_os_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedTaAmount(string|array<string> $requested_ta_amount) Return ChildExportExpensesSummary objects filtered by the requested_ta_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedTaAmount(string|array<string> $requested_ta_amount) Return ChildExportExpensesSummary objects filtered by the requested_ta_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedInternetBillAmount(string|array<string> $requested_internet_bill_amount) Return ChildExportExpensesSummary objects filtered by the requested_internet_bill_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedInternetBillAmount(string|array<string> $requested_internet_bill_amount) Return ChildExportExpensesSummary objects filtered by the requested_internet_bill_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedOsPetrolAllowanceAmount(string|array<string> $requested_os_petrol_allowance_amount) Return ChildExportExpensesSummary objects filtered by the requested_os_petrol_allowance_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedOsPetrolAllowanceAmount(string|array<string> $requested_os_petrol_allowance_amount) Return ChildExportExpensesSummary objects filtered by the requested_os_petrol_allowance_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedIsbtAmount(string|array<string> $requested_isbt_amount) Return ChildExportExpensesSummary objects filtered by the requested_isbt_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedIsbtAmount(string|array<string> $requested_isbt_amount) Return ChildExportExpensesSummary objects filtered by the requested_isbt_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedHillAllowanceAmount(string|array<string> $requested_hill_allowance_amount) Return ChildExportExpensesSummary objects filtered by the requested_hill_allowance_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedHillAllowanceAmount(string|array<string> $requested_hill_allowance_amount) Return ChildExportExpensesSummary objects filtered by the requested_hill_allowance_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedIlpAmount(string|array<string> $requested_ilp_amount) Return ChildExportExpensesSummary objects filtered by the requested_ilp_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedIlpAmount(string|array<string> $requested_ilp_amount) Return ChildExportExpensesSummary objects filtered by the requested_ilp_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedMrConveyanceAmount(string|array<string> $requested_mr_conveyance_amount) Return ChildExportExpensesSummary objects filtered by the requested_mr_conveyance_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedMrConveyanceAmount(string|array<string> $requested_mr_conveyance_amount) Return ChildExportExpensesSummary objects filtered by the requested_mr_conveyance_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedAmConveyanceAmount(string|array<string> $requested_am_conveyance_amount) Return ChildExportExpensesSummary objects filtered by the requested_am_conveyance_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedAmConveyanceAmount(string|array<string> $requested_am_conveyance_amount) Return ChildExportExpensesSummary objects filtered by the requested_am_conveyance_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedRmLodgingAndFoodAmount(string|array<string> $requested_rm_lodging_and_food_amount) Return ChildExportExpensesSummary objects filtered by the requested_rm_lodging_and_food_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedRmLodgingAndFoodAmount(string|array<string> $requested_rm_lodging_and_food_amount) Return ChildExportExpensesSummary objects filtered by the requested_rm_lodging_and_food_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedHandsetAmount(string|array<string> $requested_handset_amount) Return ChildExportExpensesSummary objects filtered by the requested_handset_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedHandsetAmount(string|array<string> $requested_handset_amount) Return ChildExportExpensesSummary objects filtered by the requested_handset_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedHqPetrolAllowanceAmount(string|array<string> $requested_hq_petrol_allowance_amount) Return ChildExportExpensesSummary objects filtered by the requested_hq_petrol_allowance_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedHqPetrolAllowanceAmount(string|array<string> $requested_hq_petrol_allowance_amount) Return ChildExportExpensesSummary objects filtered by the requested_hq_petrol_allowance_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedZmLodgingAndFoodAmount(string|array<string> $requested_zm_lodging_and_food_amount) Return ChildExportExpensesSummary objects filtered by the requested_zm_lodging_and_food_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedZmLodgingAndFoodAmount(string|array<string> $requested_zm_lodging_and_food_amount) Return ChildExportExpensesSummary objects filtered by the requested_zm_lodging_and_food_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedRmMobileBillAmount(string|array<string> $requested_rm_mobile_bill_amount) Return ChildExportExpensesSummary objects filtered by the requested_rm_mobile_bill_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedRmMobileBillAmount(string|array<string> $requested_rm_mobile_bill_amount) Return ChildExportExpensesSummary objects filtered by the requested_rm_mobile_bill_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedZmLocalConveyanceAmount(string|array<string> $requested_zm_local_conveyance_amount) Return ChildExportExpensesSummary objects filtered by the requested_zm_local_conveyance_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedZmLocalConveyanceAmount(string|array<string> $requested_zm_local_conveyance_amount) Return ChildExportExpensesSummary objects filtered by the requested_zm_local_conveyance_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedRmLocalConveyanceAmount(string|array<string> $requested_rm_local_conveyance_amount) Return ChildExportExpensesSummary objects filtered by the requested_rm_local_conveyance_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedRmLocalConveyanceAmount(string|array<string> $requested_rm_local_conveyance_amount) Return ChildExportExpensesSummary objects filtered by the requested_rm_local_conveyance_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedZmMobileBillAmount(string|array<string> $requested_zm_mobile_bill_amount) Return ChildExportExpensesSummary objects filtered by the requested_zm_mobile_bill_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedZmMobileBillAmount(string|array<string> $requested_zm_mobile_bill_amount) Return ChildExportExpensesSummary objects filtered by the requested_zm_mobile_bill_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedStationeryAmount(string|array<string> $requested_stationery_amount) Return ChildExportExpensesSummary objects filtered by the requested_stationery_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedStationeryAmount(string|array<string> $requested_stationery_amount) Return ChildExportExpensesSummary objects filtered by the requested_stationery_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedEventAmount(string|array<string> $requested_event_amount) Return ChildExportExpensesSummary objects filtered by the requested_event_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedEventAmount(string|array<string> $requested_event_amount) Return ChildExportExpensesSummary objects filtered by the requested_event_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedOwnStayAmount(string|array<string> $requested_own_stay_amount) Return ChildExportExpensesSummary objects filtered by the requested_own_stay_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedOwnStayAmount(string|array<string> $requested_own_stay_amount) Return ChildExportExpensesSummary objects filtered by the requested_own_stay_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedOtherZmLocalConveyanceAmount(string|array<string> $requested_other_zm_local_conveyance_amount) Return ChildExportExpensesSummary objects filtered by the requested_other_zm_local_conveyance_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedOtherZmLocalConveyanceAmount(string|array<string> $requested_other_zm_local_conveyance_amount) Return ChildExportExpensesSummary objects filtered by the requested_other_zm_local_conveyance_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedOtherOsPetrolAllowanceAmount(string|array<string> $requested_other_os_petrol_allowance_amount) Return ChildExportExpensesSummary objects filtered by the requested_other_os_petrol_allowance_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedOtherOsPetrolAllowanceAmount(string|array<string> $requested_other_os_petrol_allowance_amount) Return ChildExportExpensesSummary objects filtered by the requested_other_os_petrol_allowance_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByRequestedOtherRmLocalConveyanceAmount(string|array<string> $requested_other_rm_local_conveyance_amount) Return ChildExportExpensesSummary objects filtered by the requested_other_rm_local_conveyance_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByRequestedOtherRmLocalConveyanceAmount(string|array<string> $requested_other_rm_local_conveyance_amount) Return ChildExportExpensesSummary objects filtered by the requested_other_rm_local_conveyance_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinalDaHqAmount(string|array<string> $final_da_hq_amount) Return ChildExportExpensesSummary objects filtered by the final_da_hq_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinalDaHqAmount(string|array<string> $final_da_hq_amount) Return ChildExportExpensesSummary objects filtered by the final_da_hq_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinalDaExHqAmount(string|array<string> $final_da_ex_hq_amount) Return ChildExportExpensesSummary objects filtered by the final_da_ex_hq_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinalDaExHqAmount(string|array<string> $final_da_ex_hq_amount) Return ChildExportExpensesSummary objects filtered by the final_da_ex_hq_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinalDaOsAmount(string|array<string> $final_da_os_amount) Return ChildExportExpensesSummary objects filtered by the final_da_os_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinalDaOsAmount(string|array<string> $final_da_os_amount) Return ChildExportExpensesSummary objects filtered by the final_da_os_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinalDaTransitAmount(string|array<string> $final_da_transit_amount) Return ChildExportExpensesSummary objects filtered by the final_da_transit_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinalDaTransitAmount(string|array<string> $final_da_transit_amount) Return ChildExportExpensesSummary objects filtered by the final_da_transit_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinalDaLastDayOsAmount(string|array<string> $final_da_last_day_os_amount) Return ChildExportExpensesSummary objects filtered by the final_da_last_day_os_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinalDaLastDayOsAmount(string|array<string> $final_da_last_day_os_amount) Return ChildExportExpensesSummary objects filtered by the final_da_last_day_os_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinalTaAmount(string|array<string> $final_ta_amount) Return ChildExportExpensesSummary objects filtered by the final_ta_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinalTaAmount(string|array<string> $final_ta_amount) Return ChildExportExpensesSummary objects filtered by the final_ta_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinalInternetBillAmount(string|array<string> $final_internet_bill_amount) Return ChildExportExpensesSummary objects filtered by the final_internet_bill_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinalInternetBillAmount(string|array<string> $final_internet_bill_amount) Return ChildExportExpensesSummary objects filtered by the final_internet_bill_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinalOsPetrolAllowanceAmount(string|array<string> $final_os_petrol_allowance_amount) Return ChildExportExpensesSummary objects filtered by the final_os_petrol_allowance_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinalOsPetrolAllowanceAmount(string|array<string> $final_os_petrol_allowance_amount) Return ChildExportExpensesSummary objects filtered by the final_os_petrol_allowance_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinalIsbtAmount(string|array<string> $final_isbt_amount) Return ChildExportExpensesSummary objects filtered by the final_isbt_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinalIsbtAmount(string|array<string> $final_isbt_amount) Return ChildExportExpensesSummary objects filtered by the final_isbt_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinalHillAllowanceAmount(string|array<string> $final_hill_allowance_amount) Return ChildExportExpensesSummary objects filtered by the final_hill_allowance_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinalHillAllowanceAmount(string|array<string> $final_hill_allowance_amount) Return ChildExportExpensesSummary objects filtered by the final_hill_allowance_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinalIlpAmount(string|array<string> $final_ilp_amount) Return ChildExportExpensesSummary objects filtered by the final_ilp_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinalIlpAmount(string|array<string> $final_ilp_amount) Return ChildExportExpensesSummary objects filtered by the final_ilp_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinalMrConveyanceAmount(string|array<string> $final_mr_conveyance_amount) Return ChildExportExpensesSummary objects filtered by the final_mr_conveyance_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinalMrConveyanceAmount(string|array<string> $final_mr_conveyance_amount) Return ChildExportExpensesSummary objects filtered by the final_mr_conveyance_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinalAmConveyanceAmount(string|array<string> $final_am_conveyance_amount) Return ChildExportExpensesSummary objects filtered by the final_am_conveyance_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinalAmConveyanceAmount(string|array<string> $final_am_conveyance_amount) Return ChildExportExpensesSummary objects filtered by the final_am_conveyance_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinalRmLodgingAndFoodAmount(string|array<string> $final_rm_lodging_and_food_amount) Return ChildExportExpensesSummary objects filtered by the final_rm_lodging_and_food_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinalRmLodgingAndFoodAmount(string|array<string> $final_rm_lodging_and_food_amount) Return ChildExportExpensesSummary objects filtered by the final_rm_lodging_and_food_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinalHandsetAmount(string|array<string> $final_handset_amount) Return ChildExportExpensesSummary objects filtered by the final_handset_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinalHandsetAmount(string|array<string> $final_handset_amount) Return ChildExportExpensesSummary objects filtered by the final_handset_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinalHqPetrolAllowanceAmount(string|array<string> $final_hq_petrol_allowance_amount) Return ChildExportExpensesSummary objects filtered by the final_hq_petrol_allowance_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinalHqPetrolAllowanceAmount(string|array<string> $final_hq_petrol_allowance_amount) Return ChildExportExpensesSummary objects filtered by the final_hq_petrol_allowance_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinalZmLodgingAndFoodAmount(string|array<string> $final_zm_lodging_and_food_amount) Return ChildExportExpensesSummary objects filtered by the final_zm_lodging_and_food_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinalZmLodgingAndFoodAmount(string|array<string> $final_zm_lodging_and_food_amount) Return ChildExportExpensesSummary objects filtered by the final_zm_lodging_and_food_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinalRmMobileBillAmount(string|array<string> $final_rm_mobile_bill_amount) Return ChildExportExpensesSummary objects filtered by the final_rm_mobile_bill_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinalRmMobileBillAmount(string|array<string> $final_rm_mobile_bill_amount) Return ChildExportExpensesSummary objects filtered by the final_rm_mobile_bill_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinalZmLocalConveyanceAmount(string|array<string> $final_zm_local_conveyance_amount) Return ChildExportExpensesSummary objects filtered by the final_zm_local_conveyance_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinalZmLocalConveyanceAmount(string|array<string> $final_zm_local_conveyance_amount) Return ChildExportExpensesSummary objects filtered by the final_zm_local_conveyance_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinalRmLocalConveyanceAmount(string|array<string> $final_rm_local_conveyance_amount) Return ChildExportExpensesSummary objects filtered by the final_rm_local_conveyance_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinalRmLocalConveyanceAmount(string|array<string> $final_rm_local_conveyance_amount) Return ChildExportExpensesSummary objects filtered by the final_rm_local_conveyance_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinalZmMobileBillAmount(string|array<string> $final_zm_mobile_bill_amount) Return ChildExportExpensesSummary objects filtered by the final_zm_mobile_bill_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinalZmMobileBillAmount(string|array<string> $final_zm_mobile_bill_amount) Return ChildExportExpensesSummary objects filtered by the final_zm_mobile_bill_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinalStationeryAmount(string|array<string> $final_stationery_amount) Return ChildExportExpensesSummary objects filtered by the final_stationery_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinalStationeryAmount(string|array<string> $final_stationery_amount) Return ChildExportExpensesSummary objects filtered by the final_stationery_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinalEventAmount(string|array<string> $final_event_amount) Return ChildExportExpensesSummary objects filtered by the final_event_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinalEventAmount(string|array<string> $final_event_amount) Return ChildExportExpensesSummary objects filtered by the final_event_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinal_own_stay_amount(string|array<string> $final_own_stay_amount) Return ChildExportExpensesSummary objects filtered by the final_own_stay_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinal_own_stay_amount(string|array<string> $final_own_stay_amount) Return ChildExportExpensesSummary objects filtered by the final_own_stay_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinalOtherZmLocalConveyanceAmount(string|array<string> $final_other_zm_local_conveyance_amount) Return ChildExportExpensesSummary objects filtered by the final_other_zm_local_conveyance_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinalOtherZmLocalConveyanceAmount(string|array<string> $final_other_zm_local_conveyance_amount) Return ChildExportExpensesSummary objects filtered by the final_other_zm_local_conveyance_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinalOtherOsPetrolAllowanceAmount(string|array<string> $final_other_os_petrol_allowance_amount) Return ChildExportExpensesSummary objects filtered by the final_other_os_petrol_allowance_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinalOtherOsPetrolAllowanceAmount(string|array<string> $final_other_os_petrol_allowance_amount) Return ChildExportExpensesSummary objects filtered by the final_other_os_petrol_allowance_amount column
 * @method     ChildExportExpensesSummary[]|Collection findByFinalOtherRmLocalConveyanceAmount(string|array<string> $final_other_rm_local_conveyance_amount) Return ChildExportExpensesSummary objects filtered by the final_other_rm_local_conveyance_amount column
 * @psalm-method Collection&\Traversable<ChildExportExpensesSummary> findByFinalOtherRmLocalConveyanceAmount(string|array<string> $final_other_rm_local_conveyance_amount) Return ChildExportExpensesSummary objects filtered by the final_other_rm_local_conveyance_amount column
 *
 * @method     ChildExportExpensesSummary[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildExportExpensesSummary> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ExportExpensesSummaryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \entities\Base\ExportExpensesSummaryQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\entities\\ExportExpensesSummary', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildExportExpensesSummaryQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildExportExpensesSummaryQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildExportExpensesSummaryQuery) {
            return $criteria;
        }
        $query = new ChildExportExpensesSummaryQuery();
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
     * @return ChildExportExpensesSummary|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ExportExpensesSummaryTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ExportExpensesSummaryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildExportExpensesSummary A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT uniqueid, employee_id, position_id, orgunitid, bu_name, emp_position_code, emp_position_name, emp_level, employee_code, employee_name, reporting_to_employee_name, reporting_to_employee_code, emp_town, emp_branch, designation, grade, status, month, requested_amount, approved_amount, final_amount, expense_status, total_expenses, expense_dates, requested_da_hq_amount, requested_da_ex_hq_amount, requested_da_os_amount, requested_da_transit_amount, requested_da_last_day_os_amount, requested_ta_amount, requested_internet_bill_amount, requested_os_petrol_allowance_amount, requested_isbt_amount, requested_hill_allowance_amount, requested_ilp_amount, requested_mr_conveyance_amount, requested_am_conveyance_amount, requested_rm_lodging_and_food_amount, requested_handset_amount, requested_hq_petrol_allowance_amount, requested_zm_lodging_and_food_amount, requested_rm_mobile_bill_amount, requested_zm_local_conveyance_amount, requested_rm_local_conveyance_amount, requested_zm_mobile_bill_amount, requested_stationery_amount, requested_event_amount, requested_own_stay_amount, requested_other_zm_local_conveyance_amount, requested_other_os_petrol_allowance_amount, requested_other_rm_local_conveyance_amount, final_da_hq_amount, final_da_ex_hq_amount, final_da_os_amount, final_da_transit_amount, final_da_last_day_os_amount, final_ta_amount, final_internet_bill_amount, final_os_petrol_allowance_amount, final_isbt_amount, final_hill_allowance_amount, final_ilp_amount, final_mr_conveyance_amount, final_am_conveyance_amount, final_rm_lodging_and_food_amount, final_handset_amount, final_hq_petrol_allowance_amount, final_zm_lodging_and_food_amount, final_rm_mobile_bill_amount, final_zm_local_conveyance_amount, final_rm_local_conveyance_amount, final_zm_mobile_bill_amount, final_stationery_amount, final_event_amount, final_own_stay_amount, final_other_zm_local_conveyance_amount, final_other_os_petrol_allowance_amount, final_other_rm_local_conveyance_amount FROM export_expenses_summary WHERE uniqueid = :p0';
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
            /** @var ChildExportExpensesSummary $obj */
            $obj = new ChildExportExpensesSummary();
            $obj->hydrate($row);
            ExportExpensesSummaryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildExportExpensesSummary|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_UNIQUEID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_UNIQUEID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the uniqueid column
     *
     * Example usage:
     * <code>
     * $query->filterByUniqueid(1234); // WHERE uniqueid = 1234
     * $query->filterByUniqueid(array(12, 34)); // WHERE uniqueid IN (12, 34)
     * $query->filterByUniqueid(array('min' => 12)); // WHERE uniqueid > 12
     * </code>
     *
     * @param mixed $uniqueid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUniqueid($uniqueid = null, ?string $comparison = null)
    {
        if (is_array($uniqueid)) {
            $useMinMax = false;
            if (isset($uniqueid['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_UNIQUEID, $uniqueid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($uniqueid['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_UNIQUEID, $uniqueid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_UNIQUEID, $uniqueid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the employee_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEmployeeId(1234); // WHERE employee_id = 1234
     * $query->filterByEmployeeId(array(12, 34)); // WHERE employee_id IN (12, 34)
     * $query->filterByEmployeeId(array('min' => 12)); // WHERE employee_id > 12
     * </code>
     *
     * @param mixed $employeeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmployeeId($employeeId = null, ?string $comparison = null)
    {
        if (is_array($employeeId)) {
            $useMinMax = false;
            if (isset($employeeId['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_EMPLOYEE_ID, $employeeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($employeeId['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_EMPLOYEE_ID, $employeeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_EMPLOYEE_ID, $employeeId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the position_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPositionId(1234); // WHERE position_id = 1234
     * $query->filterByPositionId(array(12, 34)); // WHERE position_id IN (12, 34)
     * $query->filterByPositionId(array('min' => 12)); // WHERE position_id > 12
     * </code>
     *
     * @param mixed $positionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPositionId($positionId = null, ?string $comparison = null)
    {
        if (is_array($positionId)) {
            $useMinMax = false;
            if (isset($positionId['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_POSITION_ID, $positionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($positionId['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_POSITION_ID, $positionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_POSITION_ID, $positionId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the orgunitid column
     *
     * Example usage:
     * <code>
     * $query->filterByOrgunitid(1234); // WHERE orgunitid = 1234
     * $query->filterByOrgunitid(array(12, 34)); // WHERE orgunitid IN (12, 34)
     * $query->filterByOrgunitid(array('min' => 12)); // WHERE orgunitid > 12
     * </code>
     *
     * @param mixed $orgunitid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrgunitid($orgunitid = null, ?string $comparison = null)
    {
        if (is_array($orgunitid)) {
            $useMinMax = false;
            if (isset($orgunitid['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_ORGUNITID, $orgunitid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orgunitid['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_ORGUNITID, $orgunitid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_ORGUNITID, $orgunitid, $comparison);

        return $this;
    }

    /**
     * Filter the query on the bu_name column
     *
     * Example usage:
     * <code>
     * $query->filterByBuName('fooValue');   // WHERE bu_name = 'fooValue'
     * $query->filterByBuName('%fooValue%', Criteria::LIKE); // WHERE bu_name LIKE '%fooValue%'
     * $query->filterByBuName(['foo', 'bar']); // WHERE bu_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $buName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBuName($buName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($buName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_BU_NAME, $buName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the emp_position_code column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpPositionCode('fooValue');   // WHERE emp_position_code = 'fooValue'
     * $query->filterByEmpPositionCode('%fooValue%', Criteria::LIKE); // WHERE emp_position_code LIKE '%fooValue%'
     * $query->filterByEmpPositionCode(['foo', 'bar']); // WHERE emp_position_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $empPositionCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmpPositionCode($empPositionCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($empPositionCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_EMP_POSITION_CODE, $empPositionCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the emp_position_name column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpPositionName('fooValue');   // WHERE emp_position_name = 'fooValue'
     * $query->filterByEmpPositionName('%fooValue%', Criteria::LIKE); // WHERE emp_position_name LIKE '%fooValue%'
     * $query->filterByEmpPositionName(['foo', 'bar']); // WHERE emp_position_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $empPositionName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmpPositionName($empPositionName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($empPositionName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_EMP_POSITION_NAME, $empPositionName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the emp_level column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpLevel('fooValue');   // WHERE emp_level = 'fooValue'
     * $query->filterByEmpLevel('%fooValue%', Criteria::LIKE); // WHERE emp_level LIKE '%fooValue%'
     * $query->filterByEmpLevel(['foo', 'bar']); // WHERE emp_level IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $empLevel The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmpLevel($empLevel = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($empLevel)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_EMP_LEVEL, $empLevel, $comparison);

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

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_EMPLOYEE_CODE, $employeeCode, $comparison);

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

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_EMPLOYEE_NAME, $employeeName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the reporting_to_employee_name column
     *
     * Example usage:
     * <code>
     * $query->filterByReportingToEmployeeName('fooValue');   // WHERE reporting_to_employee_name = 'fooValue'
     * $query->filterByReportingToEmployeeName('%fooValue%', Criteria::LIKE); // WHERE reporting_to_employee_name LIKE '%fooValue%'
     * $query->filterByReportingToEmployeeName(['foo', 'bar']); // WHERE reporting_to_employee_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $reportingToEmployeeName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReportingToEmployeeName($reportingToEmployeeName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($reportingToEmployeeName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REPORTING_TO_EMPLOYEE_NAME, $reportingToEmployeeName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the reporting_to_employee_code column
     *
     * Example usage:
     * <code>
     * $query->filterByReportingToEmployeeCode('fooValue');   // WHERE reporting_to_employee_code = 'fooValue'
     * $query->filterByReportingToEmployeeCode('%fooValue%', Criteria::LIKE); // WHERE reporting_to_employee_code LIKE '%fooValue%'
     * $query->filterByReportingToEmployeeCode(['foo', 'bar']); // WHERE reporting_to_employee_code IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $reportingToEmployeeCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReportingToEmployeeCode($reportingToEmployeeCode = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($reportingToEmployeeCode)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REPORTING_TO_EMPLOYEE_CODE, $reportingToEmployeeCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the emp_town column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpTown('fooValue');   // WHERE emp_town = 'fooValue'
     * $query->filterByEmpTown('%fooValue%', Criteria::LIKE); // WHERE emp_town LIKE '%fooValue%'
     * $query->filterByEmpTown(['foo', 'bar']); // WHERE emp_town IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $empTown The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmpTown($empTown = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($empTown)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_EMP_TOWN, $empTown, $comparison);

        return $this;
    }

    /**
     * Filter the query on the emp_branch column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpBranch('fooValue');   // WHERE emp_branch = 'fooValue'
     * $query->filterByEmpBranch('%fooValue%', Criteria::LIKE); // WHERE emp_branch LIKE '%fooValue%'
     * $query->filterByEmpBranch(['foo', 'bar']); // WHERE emp_branch IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $empBranch The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmpBranch($empBranch = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($empBranch)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_EMP_BRANCH, $empBranch, $comparison);

        return $this;
    }

    /**
     * Filter the query on the designation column
     *
     * Example usage:
     * <code>
     * $query->filterByDesignation('fooValue');   // WHERE designation = 'fooValue'
     * $query->filterByDesignation('%fooValue%', Criteria::LIKE); // WHERE designation LIKE '%fooValue%'
     * $query->filterByDesignation(['foo', 'bar']); // WHERE designation IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $designation The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDesignation($designation = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($designation)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_DESIGNATION, $designation, $comparison);

        return $this;
    }

    /**
     * Filter the query on the grade column
     *
     * Example usage:
     * <code>
     * $query->filterByGrade('fooValue');   // WHERE grade = 'fooValue'
     * $query->filterByGrade('%fooValue%', Criteria::LIKE); // WHERE grade LIKE '%fooValue%'
     * $query->filterByGrade(['foo', 'bar']); // WHERE grade IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $grade The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGrade($grade = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($grade)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_GRADE, $grade, $comparison);

        return $this;
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE status LIKE '%fooValue%'
     * $query->filterByStatus(['foo', 'bar']); // WHERE status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $status The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStatus($status = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Filter the query on the month column
     *
     * Example usage:
     * <code>
     * $query->filterByMonth('fooValue');   // WHERE month = 'fooValue'
     * $query->filterByMonth('%fooValue%', Criteria::LIKE); // WHERE month LIKE '%fooValue%'
     * $query->filterByMonth(['foo', 'bar']); // WHERE month IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $month The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMonth($month = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($month)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_MONTH, $month, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedAmount(1234); // WHERE requested_amount = 1234
     * $query->filterByRequestedAmount(array(12, 34)); // WHERE requested_amount IN (12, 34)
     * $query->filterByRequestedAmount(array('min' => 12)); // WHERE requested_amount > 12
     * </code>
     *
     * @param mixed $requestedAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedAmount($requestedAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedAmount)) {
            $useMinMax = false;
            if (isset($requestedAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_AMOUNT, $requestedAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_AMOUNT, $requestedAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_AMOUNT, $requestedAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the approved_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByApprovedAmount(1234); // WHERE approved_amount = 1234
     * $query->filterByApprovedAmount(array(12, 34)); // WHERE approved_amount IN (12, 34)
     * $query->filterByApprovedAmount(array('min' => 12)); // WHERE approved_amount > 12
     * </code>
     *
     * @param mixed $approvedAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByApprovedAmount($approvedAmount = null, ?string $comparison = null)
    {
        if (is_array($approvedAmount)) {
            $useMinMax = false;
            if (isset($approvedAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_APPROVED_AMOUNT, $approvedAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($approvedAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_APPROVED_AMOUNT, $approvedAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_APPROVED_AMOUNT, $approvedAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalAmount(1234); // WHERE final_amount = 1234
     * $query->filterByFinalAmount(array(12, 34)); // WHERE final_amount IN (12, 34)
     * $query->filterByFinalAmount(array('min' => 12)); // WHERE final_amount > 12
     * </code>
     *
     * @param mixed $finalAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalAmount($finalAmount = null, ?string $comparison = null)
    {
        if (is_array($finalAmount)) {
            $useMinMax = false;
            if (isset($finalAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_AMOUNT, $finalAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_AMOUNT, $finalAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_AMOUNT, $finalAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expense_status column
     *
     * Example usage:
     * <code>
     * $query->filterByExpenseStatus('fooValue');   // WHERE expense_status = 'fooValue'
     * $query->filterByExpenseStatus('%fooValue%', Criteria::LIKE); // WHERE expense_status LIKE '%fooValue%'
     * $query->filterByExpenseStatus(['foo', 'bar']); // WHERE expense_status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $expenseStatus The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseStatus($expenseStatus = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($expenseStatus)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_EXPENSE_STATUS, $expenseStatus, $comparison);

        return $this;
    }

    /**
     * Filter the query on the total_expenses column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalExpenses(1234); // WHERE total_expenses = 1234
     * $query->filterByTotalExpenses(array(12, 34)); // WHERE total_expenses IN (12, 34)
     * $query->filterByTotalExpenses(array('min' => 12)); // WHERE total_expenses > 12
     * </code>
     *
     * @param mixed $totalExpenses The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTotalExpenses($totalExpenses = null, ?string $comparison = null)
    {
        if (is_array($totalExpenses)) {
            $useMinMax = false;
            if (isset($totalExpenses['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_TOTAL_EXPENSES, $totalExpenses['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalExpenses['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_TOTAL_EXPENSES, $totalExpenses['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_TOTAL_EXPENSES, $totalExpenses, $comparison);

        return $this;
    }

    /**
     * Filter the query on the expense_dates column
     *
     * Example usage:
     * <code>
     * $query->filterByExpenseDates('fooValue');   // WHERE expense_dates = 'fooValue'
     * $query->filterByExpenseDates('%fooValue%', Criteria::LIKE); // WHERE expense_dates LIKE '%fooValue%'
     * $query->filterByExpenseDates(['foo', 'bar']); // WHERE expense_dates IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $expenseDates The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExpenseDates($expenseDates = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($expenseDates)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_EXPENSE_DATES, $expenseDates, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_da_hq_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedDaHqAmount(1234); // WHERE requested_da_hq_amount = 1234
     * $query->filterByRequestedDaHqAmount(array(12, 34)); // WHERE requested_da_hq_amount IN (12, 34)
     * $query->filterByRequestedDaHqAmount(array('min' => 12)); // WHERE requested_da_hq_amount > 12
     * </code>
     *
     * @param mixed $requestedDaHqAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedDaHqAmount($requestedDaHqAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedDaHqAmount)) {
            $useMinMax = false;
            if (isset($requestedDaHqAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_HQ_AMOUNT, $requestedDaHqAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedDaHqAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_HQ_AMOUNT, $requestedDaHqAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_HQ_AMOUNT, $requestedDaHqAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_da_ex_hq_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedDaExHqAmount(1234); // WHERE requested_da_ex_hq_amount = 1234
     * $query->filterByRequestedDaExHqAmount(array(12, 34)); // WHERE requested_da_ex_hq_amount IN (12, 34)
     * $query->filterByRequestedDaExHqAmount(array('min' => 12)); // WHERE requested_da_ex_hq_amount > 12
     * </code>
     *
     * @param mixed $requestedDaExHqAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedDaExHqAmount($requestedDaExHqAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedDaExHqAmount)) {
            $useMinMax = false;
            if (isset($requestedDaExHqAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_EX_HQ_AMOUNT, $requestedDaExHqAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedDaExHqAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_EX_HQ_AMOUNT, $requestedDaExHqAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_EX_HQ_AMOUNT, $requestedDaExHqAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_da_os_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedDaOsAmount(1234); // WHERE requested_da_os_amount = 1234
     * $query->filterByRequestedDaOsAmount(array(12, 34)); // WHERE requested_da_os_amount IN (12, 34)
     * $query->filterByRequestedDaOsAmount(array('min' => 12)); // WHERE requested_da_os_amount > 12
     * </code>
     *
     * @param mixed $requestedDaOsAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedDaOsAmount($requestedDaOsAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedDaOsAmount)) {
            $useMinMax = false;
            if (isset($requestedDaOsAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_OS_AMOUNT, $requestedDaOsAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedDaOsAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_OS_AMOUNT, $requestedDaOsAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_OS_AMOUNT, $requestedDaOsAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_da_transit_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedAaTransitAmount(1234); // WHERE requested_da_transit_amount = 1234
     * $query->filterByRequestedAaTransitAmount(array(12, 34)); // WHERE requested_da_transit_amount IN (12, 34)
     * $query->filterByRequestedAaTransitAmount(array('min' => 12)); // WHERE requested_da_transit_amount > 12
     * </code>
     *
     * @param mixed $requestedAaTransitAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedAaTransitAmount($requestedAaTransitAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedAaTransitAmount)) {
            $useMinMax = false;
            if (isset($requestedAaTransitAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_TRANSIT_AMOUNT, $requestedAaTransitAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedAaTransitAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_TRANSIT_AMOUNT, $requestedAaTransitAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_TRANSIT_AMOUNT, $requestedAaTransitAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_da_last_day_os_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedDaLastDayOsAmount(1234); // WHERE requested_da_last_day_os_amount = 1234
     * $query->filterByRequestedDaLastDayOsAmount(array(12, 34)); // WHERE requested_da_last_day_os_amount IN (12, 34)
     * $query->filterByRequestedDaLastDayOsAmount(array('min' => 12)); // WHERE requested_da_last_day_os_amount > 12
     * </code>
     *
     * @param mixed $requestedDaLastDayOsAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedDaLastDayOsAmount($requestedDaLastDayOsAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedDaLastDayOsAmount)) {
            $useMinMax = false;
            if (isset($requestedDaLastDayOsAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_LAST_DAY_OS_AMOUNT, $requestedDaLastDayOsAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedDaLastDayOsAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_LAST_DAY_OS_AMOUNT, $requestedDaLastDayOsAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_LAST_DAY_OS_AMOUNT, $requestedDaLastDayOsAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_ta_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedTaAmount(1234); // WHERE requested_ta_amount = 1234
     * $query->filterByRequestedTaAmount(array(12, 34)); // WHERE requested_ta_amount IN (12, 34)
     * $query->filterByRequestedTaAmount(array('min' => 12)); // WHERE requested_ta_amount > 12
     * </code>
     *
     * @param mixed $requestedTaAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedTaAmount($requestedTaAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedTaAmount)) {
            $useMinMax = false;
            if (isset($requestedTaAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_TA_AMOUNT, $requestedTaAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedTaAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_TA_AMOUNT, $requestedTaAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_TA_AMOUNT, $requestedTaAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_internet_bill_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedInternetBillAmount(1234); // WHERE requested_internet_bill_amount = 1234
     * $query->filterByRequestedInternetBillAmount(array(12, 34)); // WHERE requested_internet_bill_amount IN (12, 34)
     * $query->filterByRequestedInternetBillAmount(array('min' => 12)); // WHERE requested_internet_bill_amount > 12
     * </code>
     *
     * @param mixed $requestedInternetBillAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedInternetBillAmount($requestedInternetBillAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedInternetBillAmount)) {
            $useMinMax = false;
            if (isset($requestedInternetBillAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_INTERNET_BILL_AMOUNT, $requestedInternetBillAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedInternetBillAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_INTERNET_BILL_AMOUNT, $requestedInternetBillAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_INTERNET_BILL_AMOUNT, $requestedInternetBillAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_os_petrol_allowance_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedOsPetrolAllowanceAmount(1234); // WHERE requested_os_petrol_allowance_amount = 1234
     * $query->filterByRequestedOsPetrolAllowanceAmount(array(12, 34)); // WHERE requested_os_petrol_allowance_amount IN (12, 34)
     * $query->filterByRequestedOsPetrolAllowanceAmount(array('min' => 12)); // WHERE requested_os_petrol_allowance_amount > 12
     * </code>
     *
     * @param mixed $requestedOsPetrolAllowanceAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedOsPetrolAllowanceAmount($requestedOsPetrolAllowanceAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedOsPetrolAllowanceAmount)) {
            $useMinMax = false;
            if (isset($requestedOsPetrolAllowanceAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_OS_PETROL_ALLOWANCE_AMOUNT, $requestedOsPetrolAllowanceAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedOsPetrolAllowanceAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_OS_PETROL_ALLOWANCE_AMOUNT, $requestedOsPetrolAllowanceAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_OS_PETROL_ALLOWANCE_AMOUNT, $requestedOsPetrolAllowanceAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_isbt_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedIsbtAmount(1234); // WHERE requested_isbt_amount = 1234
     * $query->filterByRequestedIsbtAmount(array(12, 34)); // WHERE requested_isbt_amount IN (12, 34)
     * $query->filterByRequestedIsbtAmount(array('min' => 12)); // WHERE requested_isbt_amount > 12
     * </code>
     *
     * @param mixed $requestedIsbtAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedIsbtAmount($requestedIsbtAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedIsbtAmount)) {
            $useMinMax = false;
            if (isset($requestedIsbtAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_ISBT_AMOUNT, $requestedIsbtAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedIsbtAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_ISBT_AMOUNT, $requestedIsbtAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_ISBT_AMOUNT, $requestedIsbtAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_hill_allowance_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedHillAllowanceAmount(1234); // WHERE requested_hill_allowance_amount = 1234
     * $query->filterByRequestedHillAllowanceAmount(array(12, 34)); // WHERE requested_hill_allowance_amount IN (12, 34)
     * $query->filterByRequestedHillAllowanceAmount(array('min' => 12)); // WHERE requested_hill_allowance_amount > 12
     * </code>
     *
     * @param mixed $requestedHillAllowanceAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedHillAllowanceAmount($requestedHillAllowanceAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedHillAllowanceAmount)) {
            $useMinMax = false;
            if (isset($requestedHillAllowanceAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_HILL_ALLOWANCE_AMOUNT, $requestedHillAllowanceAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedHillAllowanceAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_HILL_ALLOWANCE_AMOUNT, $requestedHillAllowanceAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_HILL_ALLOWANCE_AMOUNT, $requestedHillAllowanceAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_ilp_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedIlpAmount(1234); // WHERE requested_ilp_amount = 1234
     * $query->filterByRequestedIlpAmount(array(12, 34)); // WHERE requested_ilp_amount IN (12, 34)
     * $query->filterByRequestedIlpAmount(array('min' => 12)); // WHERE requested_ilp_amount > 12
     * </code>
     *
     * @param mixed $requestedIlpAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedIlpAmount($requestedIlpAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedIlpAmount)) {
            $useMinMax = false;
            if (isset($requestedIlpAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_ILP_AMOUNT, $requestedIlpAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedIlpAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_ILP_AMOUNT, $requestedIlpAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_ILP_AMOUNT, $requestedIlpAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_mr_conveyance_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedMrConveyanceAmount(1234); // WHERE requested_mr_conveyance_amount = 1234
     * $query->filterByRequestedMrConveyanceAmount(array(12, 34)); // WHERE requested_mr_conveyance_amount IN (12, 34)
     * $query->filterByRequestedMrConveyanceAmount(array('min' => 12)); // WHERE requested_mr_conveyance_amount > 12
     * </code>
     *
     * @param mixed $requestedMrConveyanceAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedMrConveyanceAmount($requestedMrConveyanceAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedMrConveyanceAmount)) {
            $useMinMax = false;
            if (isset($requestedMrConveyanceAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_MR_CONVEYANCE_AMOUNT, $requestedMrConveyanceAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedMrConveyanceAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_MR_CONVEYANCE_AMOUNT, $requestedMrConveyanceAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_MR_CONVEYANCE_AMOUNT, $requestedMrConveyanceAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_am_conveyance_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedAmConveyanceAmount(1234); // WHERE requested_am_conveyance_amount = 1234
     * $query->filterByRequestedAmConveyanceAmount(array(12, 34)); // WHERE requested_am_conveyance_amount IN (12, 34)
     * $query->filterByRequestedAmConveyanceAmount(array('min' => 12)); // WHERE requested_am_conveyance_amount > 12
     * </code>
     *
     * @param mixed $requestedAmConveyanceAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedAmConveyanceAmount($requestedAmConveyanceAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedAmConveyanceAmount)) {
            $useMinMax = false;
            if (isset($requestedAmConveyanceAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_AM_CONVEYANCE_AMOUNT, $requestedAmConveyanceAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedAmConveyanceAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_AM_CONVEYANCE_AMOUNT, $requestedAmConveyanceAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_AM_CONVEYANCE_AMOUNT, $requestedAmConveyanceAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_rm_lodging_and_food_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedRmLodgingAndFoodAmount(1234); // WHERE requested_rm_lodging_and_food_amount = 1234
     * $query->filterByRequestedRmLodgingAndFoodAmount(array(12, 34)); // WHERE requested_rm_lodging_and_food_amount IN (12, 34)
     * $query->filterByRequestedRmLodgingAndFoodAmount(array('min' => 12)); // WHERE requested_rm_lodging_and_food_amount > 12
     * </code>
     *
     * @param mixed $requestedRmLodgingAndFoodAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedRmLodgingAndFoodAmount($requestedRmLodgingAndFoodAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedRmLodgingAndFoodAmount)) {
            $useMinMax = false;
            if (isset($requestedRmLodgingAndFoodAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_RM_LODGING_AND_FOOD_AMOUNT, $requestedRmLodgingAndFoodAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedRmLodgingAndFoodAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_RM_LODGING_AND_FOOD_AMOUNT, $requestedRmLodgingAndFoodAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_RM_LODGING_AND_FOOD_AMOUNT, $requestedRmLodgingAndFoodAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_handset_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedHandsetAmount(1234); // WHERE requested_handset_amount = 1234
     * $query->filterByRequestedHandsetAmount(array(12, 34)); // WHERE requested_handset_amount IN (12, 34)
     * $query->filterByRequestedHandsetAmount(array('min' => 12)); // WHERE requested_handset_amount > 12
     * </code>
     *
     * @param mixed $requestedHandsetAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedHandsetAmount($requestedHandsetAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedHandsetAmount)) {
            $useMinMax = false;
            if (isset($requestedHandsetAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_HANDSET_AMOUNT, $requestedHandsetAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedHandsetAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_HANDSET_AMOUNT, $requestedHandsetAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_HANDSET_AMOUNT, $requestedHandsetAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_hq_petrol_allowance_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedHqPetrolAllowanceAmount(1234); // WHERE requested_hq_petrol_allowance_amount = 1234
     * $query->filterByRequestedHqPetrolAllowanceAmount(array(12, 34)); // WHERE requested_hq_petrol_allowance_amount IN (12, 34)
     * $query->filterByRequestedHqPetrolAllowanceAmount(array('min' => 12)); // WHERE requested_hq_petrol_allowance_amount > 12
     * </code>
     *
     * @param mixed $requestedHqPetrolAllowanceAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedHqPetrolAllowanceAmount($requestedHqPetrolAllowanceAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedHqPetrolAllowanceAmount)) {
            $useMinMax = false;
            if (isset($requestedHqPetrolAllowanceAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_HQ_PETROL_ALLOWANCE_AMOUNT, $requestedHqPetrolAllowanceAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedHqPetrolAllowanceAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_HQ_PETROL_ALLOWANCE_AMOUNT, $requestedHqPetrolAllowanceAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_HQ_PETROL_ALLOWANCE_AMOUNT, $requestedHqPetrolAllowanceAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_zm_lodging_and_food_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedZmLodgingAndFoodAmount(1234); // WHERE requested_zm_lodging_and_food_amount = 1234
     * $query->filterByRequestedZmLodgingAndFoodAmount(array(12, 34)); // WHERE requested_zm_lodging_and_food_amount IN (12, 34)
     * $query->filterByRequestedZmLodgingAndFoodAmount(array('min' => 12)); // WHERE requested_zm_lodging_and_food_amount > 12
     * </code>
     *
     * @param mixed $requestedZmLodgingAndFoodAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedZmLodgingAndFoodAmount($requestedZmLodgingAndFoodAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedZmLodgingAndFoodAmount)) {
            $useMinMax = false;
            if (isset($requestedZmLodgingAndFoodAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_LODGING_AND_FOOD_AMOUNT, $requestedZmLodgingAndFoodAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedZmLodgingAndFoodAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_LODGING_AND_FOOD_AMOUNT, $requestedZmLodgingAndFoodAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_LODGING_AND_FOOD_AMOUNT, $requestedZmLodgingAndFoodAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_rm_mobile_bill_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedRmMobileBillAmount(1234); // WHERE requested_rm_mobile_bill_amount = 1234
     * $query->filterByRequestedRmMobileBillAmount(array(12, 34)); // WHERE requested_rm_mobile_bill_amount IN (12, 34)
     * $query->filterByRequestedRmMobileBillAmount(array('min' => 12)); // WHERE requested_rm_mobile_bill_amount > 12
     * </code>
     *
     * @param mixed $requestedRmMobileBillAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedRmMobileBillAmount($requestedRmMobileBillAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedRmMobileBillAmount)) {
            $useMinMax = false;
            if (isset($requestedRmMobileBillAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_RM_MOBILE_BILL_AMOUNT, $requestedRmMobileBillAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedRmMobileBillAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_RM_MOBILE_BILL_AMOUNT, $requestedRmMobileBillAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_RM_MOBILE_BILL_AMOUNT, $requestedRmMobileBillAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_zm_local_conveyance_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedZmLocalConveyanceAmount(1234); // WHERE requested_zm_local_conveyance_amount = 1234
     * $query->filterByRequestedZmLocalConveyanceAmount(array(12, 34)); // WHERE requested_zm_local_conveyance_amount IN (12, 34)
     * $query->filterByRequestedZmLocalConveyanceAmount(array('min' => 12)); // WHERE requested_zm_local_conveyance_amount > 12
     * </code>
     *
     * @param mixed $requestedZmLocalConveyanceAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedZmLocalConveyanceAmount($requestedZmLocalConveyanceAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedZmLocalConveyanceAmount)) {
            $useMinMax = false;
            if (isset($requestedZmLocalConveyanceAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_LOCAL_CONVEYANCE_AMOUNT, $requestedZmLocalConveyanceAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedZmLocalConveyanceAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_LOCAL_CONVEYANCE_AMOUNT, $requestedZmLocalConveyanceAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_LOCAL_CONVEYANCE_AMOUNT, $requestedZmLocalConveyanceAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_rm_local_conveyance_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedRmLocalConveyanceAmount(1234); // WHERE requested_rm_local_conveyance_amount = 1234
     * $query->filterByRequestedRmLocalConveyanceAmount(array(12, 34)); // WHERE requested_rm_local_conveyance_amount IN (12, 34)
     * $query->filterByRequestedRmLocalConveyanceAmount(array('min' => 12)); // WHERE requested_rm_local_conveyance_amount > 12
     * </code>
     *
     * @param mixed $requestedRmLocalConveyanceAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedRmLocalConveyanceAmount($requestedRmLocalConveyanceAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedRmLocalConveyanceAmount)) {
            $useMinMax = false;
            if (isset($requestedRmLocalConveyanceAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_RM_LOCAL_CONVEYANCE_AMOUNT, $requestedRmLocalConveyanceAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedRmLocalConveyanceAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_RM_LOCAL_CONVEYANCE_AMOUNT, $requestedRmLocalConveyanceAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_RM_LOCAL_CONVEYANCE_AMOUNT, $requestedRmLocalConveyanceAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_zm_mobile_bill_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedZmMobileBillAmount(1234); // WHERE requested_zm_mobile_bill_amount = 1234
     * $query->filterByRequestedZmMobileBillAmount(array(12, 34)); // WHERE requested_zm_mobile_bill_amount IN (12, 34)
     * $query->filterByRequestedZmMobileBillAmount(array('min' => 12)); // WHERE requested_zm_mobile_bill_amount > 12
     * </code>
     *
     * @param mixed $requestedZmMobileBillAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedZmMobileBillAmount($requestedZmMobileBillAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedZmMobileBillAmount)) {
            $useMinMax = false;
            if (isset($requestedZmMobileBillAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_MOBILE_BILL_AMOUNT, $requestedZmMobileBillAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedZmMobileBillAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_MOBILE_BILL_AMOUNT, $requestedZmMobileBillAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_MOBILE_BILL_AMOUNT, $requestedZmMobileBillAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_stationery_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedStationeryAmount(1234); // WHERE requested_stationery_amount = 1234
     * $query->filterByRequestedStationeryAmount(array(12, 34)); // WHERE requested_stationery_amount IN (12, 34)
     * $query->filterByRequestedStationeryAmount(array('min' => 12)); // WHERE requested_stationery_amount > 12
     * </code>
     *
     * @param mixed $requestedStationeryAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedStationeryAmount($requestedStationeryAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedStationeryAmount)) {
            $useMinMax = false;
            if (isset($requestedStationeryAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_STATIONERY_AMOUNT, $requestedStationeryAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedStationeryAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_STATIONERY_AMOUNT, $requestedStationeryAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_STATIONERY_AMOUNT, $requestedStationeryAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_event_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedEventAmount(1234); // WHERE requested_event_amount = 1234
     * $query->filterByRequestedEventAmount(array(12, 34)); // WHERE requested_event_amount IN (12, 34)
     * $query->filterByRequestedEventAmount(array('min' => 12)); // WHERE requested_event_amount > 12
     * </code>
     *
     * @param mixed $requestedEventAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedEventAmount($requestedEventAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedEventAmount)) {
            $useMinMax = false;
            if (isset($requestedEventAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_EVENT_AMOUNT, $requestedEventAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedEventAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_EVENT_AMOUNT, $requestedEventAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_EVENT_AMOUNT, $requestedEventAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_own_stay_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedOwnStayAmount(1234); // WHERE requested_own_stay_amount = 1234
     * $query->filterByRequestedOwnStayAmount(array(12, 34)); // WHERE requested_own_stay_amount IN (12, 34)
     * $query->filterByRequestedOwnStayAmount(array('min' => 12)); // WHERE requested_own_stay_amount > 12
     * </code>
     *
     * @param mixed $requestedOwnStayAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedOwnStayAmount($requestedOwnStayAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedOwnStayAmount)) {
            $useMinMax = false;
            if (isset($requestedOwnStayAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_OWN_STAY_AMOUNT, $requestedOwnStayAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedOwnStayAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_OWN_STAY_AMOUNT, $requestedOwnStayAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_OWN_STAY_AMOUNT, $requestedOwnStayAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_other_zm_local_conveyance_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedOtherZmLocalConveyanceAmount(1234); // WHERE requested_other_zm_local_conveyance_amount = 1234
     * $query->filterByRequestedOtherZmLocalConveyanceAmount(array(12, 34)); // WHERE requested_other_zm_local_conveyance_amount IN (12, 34)
     * $query->filterByRequestedOtherZmLocalConveyanceAmount(array('min' => 12)); // WHERE requested_other_zm_local_conveyance_amount > 12
     * </code>
     *
     * @param mixed $requestedOtherZmLocalConveyanceAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedOtherZmLocalConveyanceAmount($requestedOtherZmLocalConveyanceAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedOtherZmLocalConveyanceAmount)) {
            $useMinMax = false;
            if (isset($requestedOtherZmLocalConveyanceAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT, $requestedOtherZmLocalConveyanceAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedOtherZmLocalConveyanceAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT, $requestedOtherZmLocalConveyanceAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT, $requestedOtherZmLocalConveyanceAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_other_os_petrol_allowance_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedOtherOsPetrolAllowanceAmount(1234); // WHERE requested_other_os_petrol_allowance_amount = 1234
     * $query->filterByRequestedOtherOsPetrolAllowanceAmount(array(12, 34)); // WHERE requested_other_os_petrol_allowance_amount IN (12, 34)
     * $query->filterByRequestedOtherOsPetrolAllowanceAmount(array('min' => 12)); // WHERE requested_other_os_petrol_allowance_amount > 12
     * </code>
     *
     * @param mixed $requestedOtherOsPetrolAllowanceAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedOtherOsPetrolAllowanceAmount($requestedOtherOsPetrolAllowanceAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedOtherOsPetrolAllowanceAmount)) {
            $useMinMax = false;
            if (isset($requestedOtherOsPetrolAllowanceAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_OS_PETROL_ALLOWANCE_AMOUNT, $requestedOtherOsPetrolAllowanceAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedOtherOsPetrolAllowanceAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_OS_PETROL_ALLOWANCE_AMOUNT, $requestedOtherOsPetrolAllowanceAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_OS_PETROL_ALLOWANCE_AMOUNT, $requestedOtherOsPetrolAllowanceAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the requested_other_rm_local_conveyance_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestedOtherRmLocalConveyanceAmount(1234); // WHERE requested_other_rm_local_conveyance_amount = 1234
     * $query->filterByRequestedOtherRmLocalConveyanceAmount(array(12, 34)); // WHERE requested_other_rm_local_conveyance_amount IN (12, 34)
     * $query->filterByRequestedOtherRmLocalConveyanceAmount(array('min' => 12)); // WHERE requested_other_rm_local_conveyance_amount > 12
     * </code>
     *
     * @param mixed $requestedOtherRmLocalConveyanceAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestedOtherRmLocalConveyanceAmount($requestedOtherRmLocalConveyanceAmount = null, ?string $comparison = null)
    {
        if (is_array($requestedOtherRmLocalConveyanceAmount)) {
            $useMinMax = false;
            if (isset($requestedOtherRmLocalConveyanceAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT, $requestedOtherRmLocalConveyanceAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($requestedOtherRmLocalConveyanceAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT, $requestedOtherRmLocalConveyanceAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT, $requestedOtherRmLocalConveyanceAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_da_hq_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalDaHqAmount(1234); // WHERE final_da_hq_amount = 1234
     * $query->filterByFinalDaHqAmount(array(12, 34)); // WHERE final_da_hq_amount IN (12, 34)
     * $query->filterByFinalDaHqAmount(array('min' => 12)); // WHERE final_da_hq_amount > 12
     * </code>
     *
     * @param mixed $finalDaHqAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalDaHqAmount($finalDaHqAmount = null, ?string $comparison = null)
    {
        if (is_array($finalDaHqAmount)) {
            $useMinMax = false;
            if (isset($finalDaHqAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_DA_HQ_AMOUNT, $finalDaHqAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalDaHqAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_DA_HQ_AMOUNT, $finalDaHqAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_DA_HQ_AMOUNT, $finalDaHqAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_da_ex_hq_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalDaExHqAmount(1234); // WHERE final_da_ex_hq_amount = 1234
     * $query->filterByFinalDaExHqAmount(array(12, 34)); // WHERE final_da_ex_hq_amount IN (12, 34)
     * $query->filterByFinalDaExHqAmount(array('min' => 12)); // WHERE final_da_ex_hq_amount > 12
     * </code>
     *
     * @param mixed $finalDaExHqAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalDaExHqAmount($finalDaExHqAmount = null, ?string $comparison = null)
    {
        if (is_array($finalDaExHqAmount)) {
            $useMinMax = false;
            if (isset($finalDaExHqAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_DA_EX_HQ_AMOUNT, $finalDaExHqAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalDaExHqAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_DA_EX_HQ_AMOUNT, $finalDaExHqAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_DA_EX_HQ_AMOUNT, $finalDaExHqAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_da_os_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalDaOsAmount(1234); // WHERE final_da_os_amount = 1234
     * $query->filterByFinalDaOsAmount(array(12, 34)); // WHERE final_da_os_amount IN (12, 34)
     * $query->filterByFinalDaOsAmount(array('min' => 12)); // WHERE final_da_os_amount > 12
     * </code>
     *
     * @param mixed $finalDaOsAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalDaOsAmount($finalDaOsAmount = null, ?string $comparison = null)
    {
        if (is_array($finalDaOsAmount)) {
            $useMinMax = false;
            if (isset($finalDaOsAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_DA_OS_AMOUNT, $finalDaOsAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalDaOsAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_DA_OS_AMOUNT, $finalDaOsAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_DA_OS_AMOUNT, $finalDaOsAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_da_transit_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalDaTransitAmount(1234); // WHERE final_da_transit_amount = 1234
     * $query->filterByFinalDaTransitAmount(array(12, 34)); // WHERE final_da_transit_amount IN (12, 34)
     * $query->filterByFinalDaTransitAmount(array('min' => 12)); // WHERE final_da_transit_amount > 12
     * </code>
     *
     * @param mixed $finalDaTransitAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalDaTransitAmount($finalDaTransitAmount = null, ?string $comparison = null)
    {
        if (is_array($finalDaTransitAmount)) {
            $useMinMax = false;
            if (isset($finalDaTransitAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_DA_TRANSIT_AMOUNT, $finalDaTransitAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalDaTransitAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_DA_TRANSIT_AMOUNT, $finalDaTransitAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_DA_TRANSIT_AMOUNT, $finalDaTransitAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_da_last_day_os_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalDaLastDayOsAmount(1234); // WHERE final_da_last_day_os_amount = 1234
     * $query->filterByFinalDaLastDayOsAmount(array(12, 34)); // WHERE final_da_last_day_os_amount IN (12, 34)
     * $query->filterByFinalDaLastDayOsAmount(array('min' => 12)); // WHERE final_da_last_day_os_amount > 12
     * </code>
     *
     * @param mixed $finalDaLastDayOsAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalDaLastDayOsAmount($finalDaLastDayOsAmount = null, ?string $comparison = null)
    {
        if (is_array($finalDaLastDayOsAmount)) {
            $useMinMax = false;
            if (isset($finalDaLastDayOsAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_DA_LAST_DAY_OS_AMOUNT, $finalDaLastDayOsAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalDaLastDayOsAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_DA_LAST_DAY_OS_AMOUNT, $finalDaLastDayOsAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_DA_LAST_DAY_OS_AMOUNT, $finalDaLastDayOsAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_ta_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalTaAmount(1234); // WHERE final_ta_amount = 1234
     * $query->filterByFinalTaAmount(array(12, 34)); // WHERE final_ta_amount IN (12, 34)
     * $query->filterByFinalTaAmount(array('min' => 12)); // WHERE final_ta_amount > 12
     * </code>
     *
     * @param mixed $finalTaAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalTaAmount($finalTaAmount = null, ?string $comparison = null)
    {
        if (is_array($finalTaAmount)) {
            $useMinMax = false;
            if (isset($finalTaAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_TA_AMOUNT, $finalTaAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalTaAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_TA_AMOUNT, $finalTaAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_TA_AMOUNT, $finalTaAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_internet_bill_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalInternetBillAmount(1234); // WHERE final_internet_bill_amount = 1234
     * $query->filterByFinalInternetBillAmount(array(12, 34)); // WHERE final_internet_bill_amount IN (12, 34)
     * $query->filterByFinalInternetBillAmount(array('min' => 12)); // WHERE final_internet_bill_amount > 12
     * </code>
     *
     * @param mixed $finalInternetBillAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalInternetBillAmount($finalInternetBillAmount = null, ?string $comparison = null)
    {
        if (is_array($finalInternetBillAmount)) {
            $useMinMax = false;
            if (isset($finalInternetBillAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_INTERNET_BILL_AMOUNT, $finalInternetBillAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalInternetBillAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_INTERNET_BILL_AMOUNT, $finalInternetBillAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_INTERNET_BILL_AMOUNT, $finalInternetBillAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_os_petrol_allowance_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalOsPetrolAllowanceAmount(1234); // WHERE final_os_petrol_allowance_amount = 1234
     * $query->filterByFinalOsPetrolAllowanceAmount(array(12, 34)); // WHERE final_os_petrol_allowance_amount IN (12, 34)
     * $query->filterByFinalOsPetrolAllowanceAmount(array('min' => 12)); // WHERE final_os_petrol_allowance_amount > 12
     * </code>
     *
     * @param mixed $finalOsPetrolAllowanceAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalOsPetrolAllowanceAmount($finalOsPetrolAllowanceAmount = null, ?string $comparison = null)
    {
        if (is_array($finalOsPetrolAllowanceAmount)) {
            $useMinMax = false;
            if (isset($finalOsPetrolAllowanceAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_OS_PETROL_ALLOWANCE_AMOUNT, $finalOsPetrolAllowanceAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalOsPetrolAllowanceAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_OS_PETROL_ALLOWANCE_AMOUNT, $finalOsPetrolAllowanceAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_OS_PETROL_ALLOWANCE_AMOUNT, $finalOsPetrolAllowanceAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_isbt_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalIsbtAmount(1234); // WHERE final_isbt_amount = 1234
     * $query->filterByFinalIsbtAmount(array(12, 34)); // WHERE final_isbt_amount IN (12, 34)
     * $query->filterByFinalIsbtAmount(array('min' => 12)); // WHERE final_isbt_amount > 12
     * </code>
     *
     * @param mixed $finalIsbtAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalIsbtAmount($finalIsbtAmount = null, ?string $comparison = null)
    {
        if (is_array($finalIsbtAmount)) {
            $useMinMax = false;
            if (isset($finalIsbtAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_ISBT_AMOUNT, $finalIsbtAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalIsbtAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_ISBT_AMOUNT, $finalIsbtAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_ISBT_AMOUNT, $finalIsbtAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_hill_allowance_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalHillAllowanceAmount(1234); // WHERE final_hill_allowance_amount = 1234
     * $query->filterByFinalHillAllowanceAmount(array(12, 34)); // WHERE final_hill_allowance_amount IN (12, 34)
     * $query->filterByFinalHillAllowanceAmount(array('min' => 12)); // WHERE final_hill_allowance_amount > 12
     * </code>
     *
     * @param mixed $finalHillAllowanceAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalHillAllowanceAmount($finalHillAllowanceAmount = null, ?string $comparison = null)
    {
        if (is_array($finalHillAllowanceAmount)) {
            $useMinMax = false;
            if (isset($finalHillAllowanceAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_HILL_ALLOWANCE_AMOUNT, $finalHillAllowanceAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalHillAllowanceAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_HILL_ALLOWANCE_AMOUNT, $finalHillAllowanceAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_HILL_ALLOWANCE_AMOUNT, $finalHillAllowanceAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_ilp_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalIlpAmount(1234); // WHERE final_ilp_amount = 1234
     * $query->filterByFinalIlpAmount(array(12, 34)); // WHERE final_ilp_amount IN (12, 34)
     * $query->filterByFinalIlpAmount(array('min' => 12)); // WHERE final_ilp_amount > 12
     * </code>
     *
     * @param mixed $finalIlpAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalIlpAmount($finalIlpAmount = null, ?string $comparison = null)
    {
        if (is_array($finalIlpAmount)) {
            $useMinMax = false;
            if (isset($finalIlpAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_ILP_AMOUNT, $finalIlpAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalIlpAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_ILP_AMOUNT, $finalIlpAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_ILP_AMOUNT, $finalIlpAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_mr_conveyance_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalMrConveyanceAmount(1234); // WHERE final_mr_conveyance_amount = 1234
     * $query->filterByFinalMrConveyanceAmount(array(12, 34)); // WHERE final_mr_conveyance_amount IN (12, 34)
     * $query->filterByFinalMrConveyanceAmount(array('min' => 12)); // WHERE final_mr_conveyance_amount > 12
     * </code>
     *
     * @param mixed $finalMrConveyanceAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalMrConveyanceAmount($finalMrConveyanceAmount = null, ?string $comparison = null)
    {
        if (is_array($finalMrConveyanceAmount)) {
            $useMinMax = false;
            if (isset($finalMrConveyanceAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_MR_CONVEYANCE_AMOUNT, $finalMrConveyanceAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalMrConveyanceAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_MR_CONVEYANCE_AMOUNT, $finalMrConveyanceAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_MR_CONVEYANCE_AMOUNT, $finalMrConveyanceAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_am_conveyance_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalAmConveyanceAmount(1234); // WHERE final_am_conveyance_amount = 1234
     * $query->filterByFinalAmConveyanceAmount(array(12, 34)); // WHERE final_am_conveyance_amount IN (12, 34)
     * $query->filterByFinalAmConveyanceAmount(array('min' => 12)); // WHERE final_am_conveyance_amount > 12
     * </code>
     *
     * @param mixed $finalAmConveyanceAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalAmConveyanceAmount($finalAmConveyanceAmount = null, ?string $comparison = null)
    {
        if (is_array($finalAmConveyanceAmount)) {
            $useMinMax = false;
            if (isset($finalAmConveyanceAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_AM_CONVEYANCE_AMOUNT, $finalAmConveyanceAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalAmConveyanceAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_AM_CONVEYANCE_AMOUNT, $finalAmConveyanceAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_AM_CONVEYANCE_AMOUNT, $finalAmConveyanceAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_rm_lodging_and_food_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalRmLodgingAndFoodAmount(1234); // WHERE final_rm_lodging_and_food_amount = 1234
     * $query->filterByFinalRmLodgingAndFoodAmount(array(12, 34)); // WHERE final_rm_lodging_and_food_amount IN (12, 34)
     * $query->filterByFinalRmLodgingAndFoodAmount(array('min' => 12)); // WHERE final_rm_lodging_and_food_amount > 12
     * </code>
     *
     * @param mixed $finalRmLodgingAndFoodAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalRmLodgingAndFoodAmount($finalRmLodgingAndFoodAmount = null, ?string $comparison = null)
    {
        if (is_array($finalRmLodgingAndFoodAmount)) {
            $useMinMax = false;
            if (isset($finalRmLodgingAndFoodAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_RM_LODGING_AND_FOOD_AMOUNT, $finalRmLodgingAndFoodAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalRmLodgingAndFoodAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_RM_LODGING_AND_FOOD_AMOUNT, $finalRmLodgingAndFoodAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_RM_LODGING_AND_FOOD_AMOUNT, $finalRmLodgingAndFoodAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_handset_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalHandsetAmount(1234); // WHERE final_handset_amount = 1234
     * $query->filterByFinalHandsetAmount(array(12, 34)); // WHERE final_handset_amount IN (12, 34)
     * $query->filterByFinalHandsetAmount(array('min' => 12)); // WHERE final_handset_amount > 12
     * </code>
     *
     * @param mixed $finalHandsetAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalHandsetAmount($finalHandsetAmount = null, ?string $comparison = null)
    {
        if (is_array($finalHandsetAmount)) {
            $useMinMax = false;
            if (isset($finalHandsetAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_HANDSET_AMOUNT, $finalHandsetAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalHandsetAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_HANDSET_AMOUNT, $finalHandsetAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_HANDSET_AMOUNT, $finalHandsetAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_hq_petrol_allowance_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalHqPetrolAllowanceAmount(1234); // WHERE final_hq_petrol_allowance_amount = 1234
     * $query->filterByFinalHqPetrolAllowanceAmount(array(12, 34)); // WHERE final_hq_petrol_allowance_amount IN (12, 34)
     * $query->filterByFinalHqPetrolAllowanceAmount(array('min' => 12)); // WHERE final_hq_petrol_allowance_amount > 12
     * </code>
     *
     * @param mixed $finalHqPetrolAllowanceAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalHqPetrolAllowanceAmount($finalHqPetrolAllowanceAmount = null, ?string $comparison = null)
    {
        if (is_array($finalHqPetrolAllowanceAmount)) {
            $useMinMax = false;
            if (isset($finalHqPetrolAllowanceAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_HQ_PETROL_ALLOWANCE_AMOUNT, $finalHqPetrolAllowanceAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalHqPetrolAllowanceAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_HQ_PETROL_ALLOWANCE_AMOUNT, $finalHqPetrolAllowanceAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_HQ_PETROL_ALLOWANCE_AMOUNT, $finalHqPetrolAllowanceAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_zm_lodging_and_food_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalZmLodgingAndFoodAmount(1234); // WHERE final_zm_lodging_and_food_amount = 1234
     * $query->filterByFinalZmLodgingAndFoodAmount(array(12, 34)); // WHERE final_zm_lodging_and_food_amount IN (12, 34)
     * $query->filterByFinalZmLodgingAndFoodAmount(array('min' => 12)); // WHERE final_zm_lodging_and_food_amount > 12
     * </code>
     *
     * @param mixed $finalZmLodgingAndFoodAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalZmLodgingAndFoodAmount($finalZmLodgingAndFoodAmount = null, ?string $comparison = null)
    {
        if (is_array($finalZmLodgingAndFoodAmount)) {
            $useMinMax = false;
            if (isset($finalZmLodgingAndFoodAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_ZM_LODGING_AND_FOOD_AMOUNT, $finalZmLodgingAndFoodAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalZmLodgingAndFoodAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_ZM_LODGING_AND_FOOD_AMOUNT, $finalZmLodgingAndFoodAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_ZM_LODGING_AND_FOOD_AMOUNT, $finalZmLodgingAndFoodAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_rm_mobile_bill_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalRmMobileBillAmount(1234); // WHERE final_rm_mobile_bill_amount = 1234
     * $query->filterByFinalRmMobileBillAmount(array(12, 34)); // WHERE final_rm_mobile_bill_amount IN (12, 34)
     * $query->filterByFinalRmMobileBillAmount(array('min' => 12)); // WHERE final_rm_mobile_bill_amount > 12
     * </code>
     *
     * @param mixed $finalRmMobileBillAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalRmMobileBillAmount($finalRmMobileBillAmount = null, ?string $comparison = null)
    {
        if (is_array($finalRmMobileBillAmount)) {
            $useMinMax = false;
            if (isset($finalRmMobileBillAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_RM_MOBILE_BILL_AMOUNT, $finalRmMobileBillAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalRmMobileBillAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_RM_MOBILE_BILL_AMOUNT, $finalRmMobileBillAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_RM_MOBILE_BILL_AMOUNT, $finalRmMobileBillAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_zm_local_conveyance_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalZmLocalConveyanceAmount(1234); // WHERE final_zm_local_conveyance_amount = 1234
     * $query->filterByFinalZmLocalConveyanceAmount(array(12, 34)); // WHERE final_zm_local_conveyance_amount IN (12, 34)
     * $query->filterByFinalZmLocalConveyanceAmount(array('min' => 12)); // WHERE final_zm_local_conveyance_amount > 12
     * </code>
     *
     * @param mixed $finalZmLocalConveyanceAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalZmLocalConveyanceAmount($finalZmLocalConveyanceAmount = null, ?string $comparison = null)
    {
        if (is_array($finalZmLocalConveyanceAmount)) {
            $useMinMax = false;
            if (isset($finalZmLocalConveyanceAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_ZM_LOCAL_CONVEYANCE_AMOUNT, $finalZmLocalConveyanceAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalZmLocalConveyanceAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_ZM_LOCAL_CONVEYANCE_AMOUNT, $finalZmLocalConveyanceAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_ZM_LOCAL_CONVEYANCE_AMOUNT, $finalZmLocalConveyanceAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_rm_local_conveyance_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalRmLocalConveyanceAmount(1234); // WHERE final_rm_local_conveyance_amount = 1234
     * $query->filterByFinalRmLocalConveyanceAmount(array(12, 34)); // WHERE final_rm_local_conveyance_amount IN (12, 34)
     * $query->filterByFinalRmLocalConveyanceAmount(array('min' => 12)); // WHERE final_rm_local_conveyance_amount > 12
     * </code>
     *
     * @param mixed $finalRmLocalConveyanceAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalRmLocalConveyanceAmount($finalRmLocalConveyanceAmount = null, ?string $comparison = null)
    {
        if (is_array($finalRmLocalConveyanceAmount)) {
            $useMinMax = false;
            if (isset($finalRmLocalConveyanceAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_RM_LOCAL_CONVEYANCE_AMOUNT, $finalRmLocalConveyanceAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalRmLocalConveyanceAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_RM_LOCAL_CONVEYANCE_AMOUNT, $finalRmLocalConveyanceAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_RM_LOCAL_CONVEYANCE_AMOUNT, $finalRmLocalConveyanceAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_zm_mobile_bill_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalZmMobileBillAmount(1234); // WHERE final_zm_mobile_bill_amount = 1234
     * $query->filterByFinalZmMobileBillAmount(array(12, 34)); // WHERE final_zm_mobile_bill_amount IN (12, 34)
     * $query->filterByFinalZmMobileBillAmount(array('min' => 12)); // WHERE final_zm_mobile_bill_amount > 12
     * </code>
     *
     * @param mixed $finalZmMobileBillAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalZmMobileBillAmount($finalZmMobileBillAmount = null, ?string $comparison = null)
    {
        if (is_array($finalZmMobileBillAmount)) {
            $useMinMax = false;
            if (isset($finalZmMobileBillAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_ZM_MOBILE_BILL_AMOUNT, $finalZmMobileBillAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalZmMobileBillAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_ZM_MOBILE_BILL_AMOUNT, $finalZmMobileBillAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_ZM_MOBILE_BILL_AMOUNT, $finalZmMobileBillAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_stationery_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalStationeryAmount(1234); // WHERE final_stationery_amount = 1234
     * $query->filterByFinalStationeryAmount(array(12, 34)); // WHERE final_stationery_amount IN (12, 34)
     * $query->filterByFinalStationeryAmount(array('min' => 12)); // WHERE final_stationery_amount > 12
     * </code>
     *
     * @param mixed $finalStationeryAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalStationeryAmount($finalStationeryAmount = null, ?string $comparison = null)
    {
        if (is_array($finalStationeryAmount)) {
            $useMinMax = false;
            if (isset($finalStationeryAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_STATIONERY_AMOUNT, $finalStationeryAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalStationeryAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_STATIONERY_AMOUNT, $finalStationeryAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_STATIONERY_AMOUNT, $finalStationeryAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_event_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalEventAmount(1234); // WHERE final_event_amount = 1234
     * $query->filterByFinalEventAmount(array(12, 34)); // WHERE final_event_amount IN (12, 34)
     * $query->filterByFinalEventAmount(array('min' => 12)); // WHERE final_event_amount > 12
     * </code>
     *
     * @param mixed $finalEventAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalEventAmount($finalEventAmount = null, ?string $comparison = null)
    {
        if (is_array($finalEventAmount)) {
            $useMinMax = false;
            if (isset($finalEventAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_EVENT_AMOUNT, $finalEventAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalEventAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_EVENT_AMOUNT, $finalEventAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_EVENT_AMOUNT, $finalEventAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_own_stay_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinal_own_stay_amount(1234); // WHERE final_own_stay_amount = 1234
     * $query->filterByFinal_own_stay_amount(array(12, 34)); // WHERE final_own_stay_amount IN (12, 34)
     * $query->filterByFinal_own_stay_amount(array('min' => 12)); // WHERE final_own_stay_amount > 12
     * </code>
     *
     * @param mixed $final_own_stay_amount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinal_own_stay_amount($final_own_stay_amount = null, ?string $comparison = null)
    {
        if (is_array($final_own_stay_amount)) {
            $useMinMax = false;
            if (isset($final_own_stay_amount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_OWN_STAY_AMOUNT, $final_own_stay_amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($final_own_stay_amount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_OWN_STAY_AMOUNT, $final_own_stay_amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_OWN_STAY_AMOUNT, $final_own_stay_amount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_other_zm_local_conveyance_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalOtherZmLocalConveyanceAmount(1234); // WHERE final_other_zm_local_conveyance_amount = 1234
     * $query->filterByFinalOtherZmLocalConveyanceAmount(array(12, 34)); // WHERE final_other_zm_local_conveyance_amount IN (12, 34)
     * $query->filterByFinalOtherZmLocalConveyanceAmount(array('min' => 12)); // WHERE final_other_zm_local_conveyance_amount > 12
     * </code>
     *
     * @param mixed $finalOtherZmLocalConveyanceAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalOtherZmLocalConveyanceAmount($finalOtherZmLocalConveyanceAmount = null, ?string $comparison = null)
    {
        if (is_array($finalOtherZmLocalConveyanceAmount)) {
            $useMinMax = false;
            if (isset($finalOtherZmLocalConveyanceAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT, $finalOtherZmLocalConveyanceAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalOtherZmLocalConveyanceAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT, $finalOtherZmLocalConveyanceAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT, $finalOtherZmLocalConveyanceAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_other_os_petrol_allowance_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalOtherOsPetrolAllowanceAmount(1234); // WHERE final_other_os_petrol_allowance_amount = 1234
     * $query->filterByFinalOtherOsPetrolAllowanceAmount(array(12, 34)); // WHERE final_other_os_petrol_allowance_amount IN (12, 34)
     * $query->filterByFinalOtherOsPetrolAllowanceAmount(array('min' => 12)); // WHERE final_other_os_petrol_allowance_amount > 12
     * </code>
     *
     * @param mixed $finalOtherOsPetrolAllowanceAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalOtherOsPetrolAllowanceAmount($finalOtherOsPetrolAllowanceAmount = null, ?string $comparison = null)
    {
        if (is_array($finalOtherOsPetrolAllowanceAmount)) {
            $useMinMax = false;
            if (isset($finalOtherOsPetrolAllowanceAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_OTHER_OS_PETROL_ALLOWANCE_AMOUNT, $finalOtherOsPetrolAllowanceAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalOtherOsPetrolAllowanceAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_OTHER_OS_PETROL_ALLOWANCE_AMOUNT, $finalOtherOsPetrolAllowanceAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_OTHER_OS_PETROL_ALLOWANCE_AMOUNT, $finalOtherOsPetrolAllowanceAmount, $comparison);

        return $this;
    }

    /**
     * Filter the query on the final_other_rm_local_conveyance_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFinalOtherRmLocalConveyanceAmount(1234); // WHERE final_other_rm_local_conveyance_amount = 1234
     * $query->filterByFinalOtherRmLocalConveyanceAmount(array(12, 34)); // WHERE final_other_rm_local_conveyance_amount IN (12, 34)
     * $query->filterByFinalOtherRmLocalConveyanceAmount(array('min' => 12)); // WHERE final_other_rm_local_conveyance_amount > 12
     * </code>
     *
     * @param mixed $finalOtherRmLocalConveyanceAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFinalOtherRmLocalConveyanceAmount($finalOtherRmLocalConveyanceAmount = null, ?string $comparison = null)
    {
        if (is_array($finalOtherRmLocalConveyanceAmount)) {
            $useMinMax = false;
            if (isset($finalOtherRmLocalConveyanceAmount['min'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT, $finalOtherRmLocalConveyanceAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finalOtherRmLocalConveyanceAmount['max'])) {
                $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT, $finalOtherRmLocalConveyanceAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_FINAL_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT, $finalOtherRmLocalConveyanceAmount, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildExportExpensesSummary $exportExpensesSummary Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($exportExpensesSummary = null)
    {
        if ($exportExpensesSummary) {
            $this->addUsingAlias(ExportExpensesSummaryTableMap::COL_UNIQUEID, $exportExpensesSummary->getUniqueid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
