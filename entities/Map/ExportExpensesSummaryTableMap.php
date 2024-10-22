<?php

namespace entities\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use entities\ExportExpensesSummary;
use entities\ExportExpensesSummaryQuery;


/**
 * This class defines the structure of the 'export_expenses_summary' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ExportExpensesSummaryTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.ExportExpensesSummaryTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'export_expenses_summary';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'ExportExpensesSummary';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\ExportExpensesSummary';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.ExportExpensesSummary';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 78;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 78;

    /**
     * the column name for the uniqueid field
     */
    public const COL_UNIQUEID = 'export_expenses_summary.uniqueid';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'export_expenses_summary.employee_id';

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'export_expenses_summary.position_id';

    /**
     * the column name for the orgunitid field
     */
    public const COL_ORGUNITID = 'export_expenses_summary.orgunitid';

    /**
     * the column name for the bu_name field
     */
    public const COL_BU_NAME = 'export_expenses_summary.bu_name';

    /**
     * the column name for the emp_position_code field
     */
    public const COL_EMP_POSITION_CODE = 'export_expenses_summary.emp_position_code';

    /**
     * the column name for the emp_position_name field
     */
    public const COL_EMP_POSITION_NAME = 'export_expenses_summary.emp_position_name';

    /**
     * the column name for the emp_level field
     */
    public const COL_EMP_LEVEL = 'export_expenses_summary.emp_level';

    /**
     * the column name for the employee_code field
     */
    public const COL_EMPLOYEE_CODE = 'export_expenses_summary.employee_code';

    /**
     * the column name for the employee_name field
     */
    public const COL_EMPLOYEE_NAME = 'export_expenses_summary.employee_name';

    /**
     * the column name for the reporting_to_employee_name field
     */
    public const COL_REPORTING_TO_EMPLOYEE_NAME = 'export_expenses_summary.reporting_to_employee_name';

    /**
     * the column name for the reporting_to_employee_code field
     */
    public const COL_REPORTING_TO_EMPLOYEE_CODE = 'export_expenses_summary.reporting_to_employee_code';

    /**
     * the column name for the emp_town field
     */
    public const COL_EMP_TOWN = 'export_expenses_summary.emp_town';

    /**
     * the column name for the emp_branch field
     */
    public const COL_EMP_BRANCH = 'export_expenses_summary.emp_branch';

    /**
     * the column name for the designation field
     */
    public const COL_DESIGNATION = 'export_expenses_summary.designation';

    /**
     * the column name for the grade field
     */
    public const COL_GRADE = 'export_expenses_summary.grade';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'export_expenses_summary.status';

    /**
     * the column name for the month field
     */
    public const COL_MONTH = 'export_expenses_summary.month';

    /**
     * the column name for the requested_amount field
     */
    public const COL_REQUESTED_AMOUNT = 'export_expenses_summary.requested_amount';

    /**
     * the column name for the approved_amount field
     */
    public const COL_APPROVED_AMOUNT = 'export_expenses_summary.approved_amount';

    /**
     * the column name for the final_amount field
     */
    public const COL_FINAL_AMOUNT = 'export_expenses_summary.final_amount';

    /**
     * the column name for the expense_status field
     */
    public const COL_EXPENSE_STATUS = 'export_expenses_summary.expense_status';

    /**
     * the column name for the total_expenses field
     */
    public const COL_TOTAL_EXPENSES = 'export_expenses_summary.total_expenses';

    /**
     * the column name for the expense_dates field
     */
    public const COL_EXPENSE_DATES = 'export_expenses_summary.expense_dates';

    /**
     * the column name for the requested_da_hq_amount field
     */
    public const COL_REQUESTED_DA_HQ_AMOUNT = 'export_expenses_summary.requested_da_hq_amount';

    /**
     * the column name for the requested_da_ex_hq_amount field
     */
    public const COL_REQUESTED_DA_EX_HQ_AMOUNT = 'export_expenses_summary.requested_da_ex_hq_amount';

    /**
     * the column name for the requested_da_os_amount field
     */
    public const COL_REQUESTED_DA_OS_AMOUNT = 'export_expenses_summary.requested_da_os_amount';

    /**
     * the column name for the requested_da_transit_amount field
     */
    public const COL_REQUESTED_DA_TRANSIT_AMOUNT = 'export_expenses_summary.requested_da_transit_amount';

    /**
     * the column name for the requested_da_last_day_os_amount field
     */
    public const COL_REQUESTED_DA_LAST_DAY_OS_AMOUNT = 'export_expenses_summary.requested_da_last_day_os_amount';

    /**
     * the column name for the requested_ta_amount field
     */
    public const COL_REQUESTED_TA_AMOUNT = 'export_expenses_summary.requested_ta_amount';

    /**
     * the column name for the requested_internet_bill_amount field
     */
    public const COL_REQUESTED_INTERNET_BILL_AMOUNT = 'export_expenses_summary.requested_internet_bill_amount';

    /**
     * the column name for the requested_os_petrol_allowance_amount field
     */
    public const COL_REQUESTED_OS_PETROL_ALLOWANCE_AMOUNT = 'export_expenses_summary.requested_os_petrol_allowance_amount';

    /**
     * the column name for the requested_isbt_amount field
     */
    public const COL_REQUESTED_ISBT_AMOUNT = 'export_expenses_summary.requested_isbt_amount';

    /**
     * the column name for the requested_hill_allowance_amount field
     */
    public const COL_REQUESTED_HILL_ALLOWANCE_AMOUNT = 'export_expenses_summary.requested_hill_allowance_amount';

    /**
     * the column name for the requested_ilp_amount field
     */
    public const COL_REQUESTED_ILP_AMOUNT = 'export_expenses_summary.requested_ilp_amount';

    /**
     * the column name for the requested_mr_conveyance_amount field
     */
    public const COL_REQUESTED_MR_CONVEYANCE_AMOUNT = 'export_expenses_summary.requested_mr_conveyance_amount';

    /**
     * the column name for the requested_am_conveyance_amount field
     */
    public const COL_REQUESTED_AM_CONVEYANCE_AMOUNT = 'export_expenses_summary.requested_am_conveyance_amount';

    /**
     * the column name for the requested_rm_lodging_and_food_amount field
     */
    public const COL_REQUESTED_RM_LODGING_AND_FOOD_AMOUNT = 'export_expenses_summary.requested_rm_lodging_and_food_amount';

    /**
     * the column name for the requested_handset_amount field
     */
    public const COL_REQUESTED_HANDSET_AMOUNT = 'export_expenses_summary.requested_handset_amount';

    /**
     * the column name for the requested_hq_petrol_allowance_amount field
     */
    public const COL_REQUESTED_HQ_PETROL_ALLOWANCE_AMOUNT = 'export_expenses_summary.requested_hq_petrol_allowance_amount';

    /**
     * the column name for the requested_zm_lodging_and_food_amount field
     */
    public const COL_REQUESTED_ZM_LODGING_AND_FOOD_AMOUNT = 'export_expenses_summary.requested_zm_lodging_and_food_amount';

    /**
     * the column name for the requested_rm_mobile_bill_amount field
     */
    public const COL_REQUESTED_RM_MOBILE_BILL_AMOUNT = 'export_expenses_summary.requested_rm_mobile_bill_amount';

    /**
     * the column name for the requested_zm_local_conveyance_amount field
     */
    public const COL_REQUESTED_ZM_LOCAL_CONVEYANCE_AMOUNT = 'export_expenses_summary.requested_zm_local_conveyance_amount';

    /**
     * the column name for the requested_rm_local_conveyance_amount field
     */
    public const COL_REQUESTED_RM_LOCAL_CONVEYANCE_AMOUNT = 'export_expenses_summary.requested_rm_local_conveyance_amount';

    /**
     * the column name for the requested_zm_mobile_bill_amount field
     */
    public const COL_REQUESTED_ZM_MOBILE_BILL_AMOUNT = 'export_expenses_summary.requested_zm_mobile_bill_amount';

    /**
     * the column name for the requested_stationery_amount field
     */
    public const COL_REQUESTED_STATIONERY_AMOUNT = 'export_expenses_summary.requested_stationery_amount';

    /**
     * the column name for the requested_event_amount field
     */
    public const COL_REQUESTED_EVENT_AMOUNT = 'export_expenses_summary.requested_event_amount';

    /**
     * the column name for the requested_own_stay_amount field
     */
    public const COL_REQUESTED_OWN_STAY_AMOUNT = 'export_expenses_summary.requested_own_stay_amount';

    /**
     * the column name for the requested_other_zm_local_conveyance_amount field
     */
    public const COL_REQUESTED_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT = 'export_expenses_summary.requested_other_zm_local_conveyance_amount';

    /**
     * the column name for the requested_other_os_petrol_allowance_amount field
     */
    public const COL_REQUESTED_OTHER_OS_PETROL_ALLOWANCE_AMOUNT = 'export_expenses_summary.requested_other_os_petrol_allowance_amount';

    /**
     * the column name for the requested_other_rm_local_conveyance_amount field
     */
    public const COL_REQUESTED_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT = 'export_expenses_summary.requested_other_rm_local_conveyance_amount';

    /**
     * the column name for the final_da_hq_amount field
     */
    public const COL_FINAL_DA_HQ_AMOUNT = 'export_expenses_summary.final_da_hq_amount';

    /**
     * the column name for the final_da_ex_hq_amount field
     */
    public const COL_FINAL_DA_EX_HQ_AMOUNT = 'export_expenses_summary.final_da_ex_hq_amount';

    /**
     * the column name for the final_da_os_amount field
     */
    public const COL_FINAL_DA_OS_AMOUNT = 'export_expenses_summary.final_da_os_amount';

    /**
     * the column name for the final_da_transit_amount field
     */
    public const COL_FINAL_DA_TRANSIT_AMOUNT = 'export_expenses_summary.final_da_transit_amount';

    /**
     * the column name for the final_da_last_day_os_amount field
     */
    public const COL_FINAL_DA_LAST_DAY_OS_AMOUNT = 'export_expenses_summary.final_da_last_day_os_amount';

    /**
     * the column name for the final_ta_amount field
     */
    public const COL_FINAL_TA_AMOUNT = 'export_expenses_summary.final_ta_amount';

    /**
     * the column name for the final_internet_bill_amount field
     */
    public const COL_FINAL_INTERNET_BILL_AMOUNT = 'export_expenses_summary.final_internet_bill_amount';

    /**
     * the column name for the final_os_petrol_allowance_amount field
     */
    public const COL_FINAL_OS_PETROL_ALLOWANCE_AMOUNT = 'export_expenses_summary.final_os_petrol_allowance_amount';

    /**
     * the column name for the final_isbt_amount field
     */
    public const COL_FINAL_ISBT_AMOUNT = 'export_expenses_summary.final_isbt_amount';

    /**
     * the column name for the final_hill_allowance_amount field
     */
    public const COL_FINAL_HILL_ALLOWANCE_AMOUNT = 'export_expenses_summary.final_hill_allowance_amount';

    /**
     * the column name for the final_ilp_amount field
     */
    public const COL_FINAL_ILP_AMOUNT = 'export_expenses_summary.final_ilp_amount';

    /**
     * the column name for the final_mr_conveyance_amount field
     */
    public const COL_FINAL_MR_CONVEYANCE_AMOUNT = 'export_expenses_summary.final_mr_conveyance_amount';

    /**
     * the column name for the final_am_conveyance_amount field
     */
    public const COL_FINAL_AM_CONVEYANCE_AMOUNT = 'export_expenses_summary.final_am_conveyance_amount';

    /**
     * the column name for the final_rm_lodging_and_food_amount field
     */
    public const COL_FINAL_RM_LODGING_AND_FOOD_AMOUNT = 'export_expenses_summary.final_rm_lodging_and_food_amount';

    /**
     * the column name for the final_handset_amount field
     */
    public const COL_FINAL_HANDSET_AMOUNT = 'export_expenses_summary.final_handset_amount';

    /**
     * the column name for the final_hq_petrol_allowance_amount field
     */
    public const COL_FINAL_HQ_PETROL_ALLOWANCE_AMOUNT = 'export_expenses_summary.final_hq_petrol_allowance_amount';

    /**
     * the column name for the final_zm_lodging_and_food_amount field
     */
    public const COL_FINAL_ZM_LODGING_AND_FOOD_AMOUNT = 'export_expenses_summary.final_zm_lodging_and_food_amount';

    /**
     * the column name for the final_rm_mobile_bill_amount field
     */
    public const COL_FINAL_RM_MOBILE_BILL_AMOUNT = 'export_expenses_summary.final_rm_mobile_bill_amount';

    /**
     * the column name for the final_zm_local_conveyance_amount field
     */
    public const COL_FINAL_ZM_LOCAL_CONVEYANCE_AMOUNT = 'export_expenses_summary.final_zm_local_conveyance_amount';

    /**
     * the column name for the final_rm_local_conveyance_amount field
     */
    public const COL_FINAL_RM_LOCAL_CONVEYANCE_AMOUNT = 'export_expenses_summary.final_rm_local_conveyance_amount';

    /**
     * the column name for the final_zm_mobile_bill_amount field
     */
    public const COL_FINAL_ZM_MOBILE_BILL_AMOUNT = 'export_expenses_summary.final_zm_mobile_bill_amount';

    /**
     * the column name for the final_stationery_amount field
     */
    public const COL_FINAL_STATIONERY_AMOUNT = 'export_expenses_summary.final_stationery_amount';

    /**
     * the column name for the final_event_amount field
     */
    public const COL_FINAL_EVENT_AMOUNT = 'export_expenses_summary.final_event_amount';

    /**
     * the column name for the final_own_stay_amount field
     */
    public const COL_FINAL_OWN_STAY_AMOUNT = 'export_expenses_summary.final_own_stay_amount';

    /**
     * the column name for the final_other_zm_local_conveyance_amount field
     */
    public const COL_FINAL_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT = 'export_expenses_summary.final_other_zm_local_conveyance_amount';

    /**
     * the column name for the final_other_os_petrol_allowance_amount field
     */
    public const COL_FINAL_OTHER_OS_PETROL_ALLOWANCE_AMOUNT = 'export_expenses_summary.final_other_os_petrol_allowance_amount';

    /**
     * the column name for the final_other_rm_local_conveyance_amount field
     */
    public const COL_FINAL_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT = 'export_expenses_summary.final_other_rm_local_conveyance_amount';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['Uniqueid', 'EmployeeId', 'PositionId', 'Orgunitid', 'BuName', 'EmpPositionCode', 'EmpPositionName', 'EmpLevel', 'EmployeeCode', 'EmployeeName', 'ReportingToEmployeeName', 'ReportingToEmployeeCode', 'EmpTown', 'EmpBranch', 'Designation', 'Grade', 'Status', 'Month', 'RequestedAmount', 'ApprovedAmount', 'FinalAmount', 'ExpenseStatus', 'TotalExpenses', 'ExpenseDates', 'RequestedDaHqAmount', 'RequestedDaExHqAmount', 'RequestedDaOsAmount', 'RequestedAaTransitAmount', 'RequestedDaLastDayOsAmount', 'RequestedTaAmount', 'RequestedInternetBillAmount', 'RequestedOsPetrolAllowanceAmount', 'RequestedIsbtAmount', 'RequestedHillAllowanceAmount', 'RequestedIlpAmount', 'RequestedMrConveyanceAmount', 'RequestedAmConveyanceAmount', 'RequestedRmLodgingAndFoodAmount', 'RequestedHandsetAmount', 'RequestedHqPetrolAllowanceAmount', 'RequestedZmLodgingAndFoodAmount', 'RequestedRmMobileBillAmount', 'RequestedZmLocalConveyanceAmount', 'RequestedRmLocalConveyanceAmount', 'RequestedZmMobileBillAmount', 'RequestedStationeryAmount', 'RequestedEventAmount', 'RequestedOwnStayAmount', 'RequestedOtherZmLocalConveyanceAmount', 'RequestedOtherOsPetrolAllowanceAmount', 'RequestedOtherRmLocalConveyanceAmount', 'FinalDaHqAmount', 'FinalDaExHqAmount', 'FinalDaOsAmount', 'FinalDaTransitAmount', 'FinalDaLastDayOsAmount', 'FinalTaAmount', 'FinalInternetBillAmount', 'FinalOsPetrolAllowanceAmount', 'FinalIsbtAmount', 'FinalHillAllowanceAmount', 'FinalIlpAmount', 'FinalMrConveyanceAmount', 'FinalAmConveyanceAmount', 'FinalRmLodgingAndFoodAmount', 'FinalHandsetAmount', 'FinalHqPetrolAllowanceAmount', 'FinalZmLodgingAndFoodAmount', 'FinalRmMobileBillAmount', 'FinalZmLocalConveyanceAmount', 'FinalRmLocalConveyanceAmount', 'FinalZmMobileBillAmount', 'FinalStationeryAmount', 'FinalEventAmount', 'Final_own_stay_amount', 'FinalOtherZmLocalConveyanceAmount', 'FinalOtherOsPetrolAllowanceAmount', 'FinalOtherRmLocalConveyanceAmount', ],
        self::TYPE_CAMELNAME     => ['uniqueid', 'employeeId', 'positionId', 'orgunitid', 'buName', 'empPositionCode', 'empPositionName', 'empLevel', 'employeeCode', 'employeeName', 'reportingToEmployeeName', 'reportingToEmployeeCode', 'empTown', 'empBranch', 'designation', 'grade', 'status', 'month', 'requestedAmount', 'approvedAmount', 'finalAmount', 'expenseStatus', 'totalExpenses', 'expenseDates', 'requestedDaHqAmount', 'requestedDaExHqAmount', 'requestedDaOsAmount', 'requestedAaTransitAmount', 'requestedDaLastDayOsAmount', 'requestedTaAmount', 'requestedInternetBillAmount', 'requestedOsPetrolAllowanceAmount', 'requestedIsbtAmount', 'requestedHillAllowanceAmount', 'requestedIlpAmount', 'requestedMrConveyanceAmount', 'requestedAmConveyanceAmount', 'requestedRmLodgingAndFoodAmount', 'requestedHandsetAmount', 'requestedHqPetrolAllowanceAmount', 'requestedZmLodgingAndFoodAmount', 'requestedRmMobileBillAmount', 'requestedZmLocalConveyanceAmount', 'requestedRmLocalConveyanceAmount', 'requestedZmMobileBillAmount', 'requestedStationeryAmount', 'requestedEventAmount', 'requestedOwnStayAmount', 'requestedOtherZmLocalConveyanceAmount', 'requestedOtherOsPetrolAllowanceAmount', 'requestedOtherRmLocalConveyanceAmount', 'finalDaHqAmount', 'finalDaExHqAmount', 'finalDaOsAmount', 'finalDaTransitAmount', 'finalDaLastDayOsAmount', 'finalTaAmount', 'finalInternetBillAmount', 'finalOsPetrolAllowanceAmount', 'finalIsbtAmount', 'finalHillAllowanceAmount', 'finalIlpAmount', 'finalMrConveyanceAmount', 'finalAmConveyanceAmount', 'finalRmLodgingAndFoodAmount', 'finalHandsetAmount', 'finalHqPetrolAllowanceAmount', 'finalZmLodgingAndFoodAmount', 'finalRmMobileBillAmount', 'finalZmLocalConveyanceAmount', 'finalRmLocalConveyanceAmount', 'finalZmMobileBillAmount', 'finalStationeryAmount', 'finalEventAmount', 'final_own_stay_amount', 'finalOtherZmLocalConveyanceAmount', 'finalOtherOsPetrolAllowanceAmount', 'finalOtherRmLocalConveyanceAmount', ],
        self::TYPE_COLNAME       => [ExportExpensesSummaryTableMap::COL_UNIQUEID, ExportExpensesSummaryTableMap::COL_EMPLOYEE_ID, ExportExpensesSummaryTableMap::COL_POSITION_ID, ExportExpensesSummaryTableMap::COL_ORGUNITID, ExportExpensesSummaryTableMap::COL_BU_NAME, ExportExpensesSummaryTableMap::COL_EMP_POSITION_CODE, ExportExpensesSummaryTableMap::COL_EMP_POSITION_NAME, ExportExpensesSummaryTableMap::COL_EMP_LEVEL, ExportExpensesSummaryTableMap::COL_EMPLOYEE_CODE, ExportExpensesSummaryTableMap::COL_EMPLOYEE_NAME, ExportExpensesSummaryTableMap::COL_REPORTING_TO_EMPLOYEE_NAME, ExportExpensesSummaryTableMap::COL_REPORTING_TO_EMPLOYEE_CODE, ExportExpensesSummaryTableMap::COL_EMP_TOWN, ExportExpensesSummaryTableMap::COL_EMP_BRANCH, ExportExpensesSummaryTableMap::COL_DESIGNATION, ExportExpensesSummaryTableMap::COL_GRADE, ExportExpensesSummaryTableMap::COL_STATUS, ExportExpensesSummaryTableMap::COL_MONTH, ExportExpensesSummaryTableMap::COL_REQUESTED_AMOUNT, ExportExpensesSummaryTableMap::COL_APPROVED_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_AMOUNT, ExportExpensesSummaryTableMap::COL_EXPENSE_STATUS, ExportExpensesSummaryTableMap::COL_TOTAL_EXPENSES, ExportExpensesSummaryTableMap::COL_EXPENSE_DATES, ExportExpensesSummaryTableMap::COL_REQUESTED_DA_HQ_AMOUNT, ExportExpensesSummaryTableMap::COL_REQUESTED_DA_EX_HQ_AMOUNT, ExportExpensesSummaryTableMap::COL_REQUESTED_DA_OS_AMOUNT, ExportExpensesSummaryTableMap::COL_REQUESTED_DA_TRANSIT_AMOUNT, ExportExpensesSummaryTableMap::COL_REQUESTED_DA_LAST_DAY_OS_AMOUNT, ExportExpensesSummaryTableMap::COL_REQUESTED_TA_AMOUNT, ExportExpensesSummaryTableMap::COL_REQUESTED_INTERNET_BILL_AMOUNT, ExportExpensesSummaryTableMap::COL_REQUESTED_OS_PETROL_ALLOWANCE_AMOUNT, ExportExpensesSummaryTableMap::COL_REQUESTED_ISBT_AMOUNT, ExportExpensesSummaryTableMap::COL_REQUESTED_HILL_ALLOWANCE_AMOUNT, ExportExpensesSummaryTableMap::COL_REQUESTED_ILP_AMOUNT, ExportExpensesSummaryTableMap::COL_REQUESTED_MR_CONVEYANCE_AMOUNT, ExportExpensesSummaryTableMap::COL_REQUESTED_AM_CONVEYANCE_AMOUNT, ExportExpensesSummaryTableMap::COL_REQUESTED_RM_LODGING_AND_FOOD_AMOUNT, ExportExpensesSummaryTableMap::COL_REQUESTED_HANDSET_AMOUNT, ExportExpensesSummaryTableMap::COL_REQUESTED_HQ_PETROL_ALLOWANCE_AMOUNT, ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_LODGING_AND_FOOD_AMOUNT, ExportExpensesSummaryTableMap::COL_REQUESTED_RM_MOBILE_BILL_AMOUNT, ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_LOCAL_CONVEYANCE_AMOUNT, ExportExpensesSummaryTableMap::COL_REQUESTED_RM_LOCAL_CONVEYANCE_AMOUNT, ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_MOBILE_BILL_AMOUNT, ExportExpensesSummaryTableMap::COL_REQUESTED_STATIONERY_AMOUNT, ExportExpensesSummaryTableMap::COL_REQUESTED_EVENT_AMOUNT, ExportExpensesSummaryTableMap::COL_REQUESTED_OWN_STAY_AMOUNT, ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT, ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_OS_PETROL_ALLOWANCE_AMOUNT, ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_DA_HQ_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_DA_EX_HQ_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_DA_OS_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_DA_TRANSIT_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_DA_LAST_DAY_OS_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_TA_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_INTERNET_BILL_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_OS_PETROL_ALLOWANCE_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_ISBT_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_HILL_ALLOWANCE_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_ILP_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_MR_CONVEYANCE_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_AM_CONVEYANCE_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_RM_LODGING_AND_FOOD_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_HANDSET_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_HQ_PETROL_ALLOWANCE_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_ZM_LODGING_AND_FOOD_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_RM_MOBILE_BILL_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_ZM_LOCAL_CONVEYANCE_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_RM_LOCAL_CONVEYANCE_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_ZM_MOBILE_BILL_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_STATIONERY_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_EVENT_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_OWN_STAY_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_OTHER_OS_PETROL_ALLOWANCE_AMOUNT, ExportExpensesSummaryTableMap::COL_FINAL_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT, ],
        self::TYPE_FIELDNAME     => ['uniqueid', 'employee_id', 'position_id', 'orgunitid', 'bu_name', 'emp_position_code', 'emp_position_name', 'emp_level', 'employee_code', 'employee_name', 'reporting_to_employee_name', 'reporting_to_employee_code', 'emp_town', 'emp_branch', 'designation', 'grade', 'status', 'month', 'requested_amount', 'approved_amount', 'final_amount', 'expense_status', 'total_expenses', 'expense_dates', 'requested_da_hq_amount', 'requested_da_ex_hq_amount', 'requested_da_os_amount', 'requested_da_transit_amount', 'requested_da_last_day_os_amount', 'requested_ta_amount', 'requested_internet_bill_amount', 'requested_os_petrol_allowance_amount', 'requested_isbt_amount', 'requested_hill_allowance_amount', 'requested_ilp_amount', 'requested_mr_conveyance_amount', 'requested_am_conveyance_amount', 'requested_rm_lodging_and_food_amount', 'requested_handset_amount', 'requested_hq_petrol_allowance_amount', 'requested_zm_lodging_and_food_amount', 'requested_rm_mobile_bill_amount', 'requested_zm_local_conveyance_amount', 'requested_rm_local_conveyance_amount', 'requested_zm_mobile_bill_amount', 'requested_stationery_amount', 'requested_event_amount', 'requested_own_stay_amount', 'requested_other_zm_local_conveyance_amount', 'requested_other_os_petrol_allowance_amount', 'requested_other_rm_local_conveyance_amount', 'final_da_hq_amount', 'final_da_ex_hq_amount', 'final_da_os_amount', 'final_da_transit_amount', 'final_da_last_day_os_amount', 'final_ta_amount', 'final_internet_bill_amount', 'final_os_petrol_allowance_amount', 'final_isbt_amount', 'final_hill_allowance_amount', 'final_ilp_amount', 'final_mr_conveyance_amount', 'final_am_conveyance_amount', 'final_rm_lodging_and_food_amount', 'final_handset_amount', 'final_hq_petrol_allowance_amount', 'final_zm_lodging_and_food_amount', 'final_rm_mobile_bill_amount', 'final_zm_local_conveyance_amount', 'final_rm_local_conveyance_amount', 'final_zm_mobile_bill_amount', 'final_stationery_amount', 'final_event_amount', 'final_own_stay_amount', 'final_other_zm_local_conveyance_amount', 'final_other_os_petrol_allowance_amount', 'final_other_rm_local_conveyance_amount', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['Uniqueid' => 0, 'EmployeeId' => 1, 'PositionId' => 2, 'Orgunitid' => 3, 'BuName' => 4, 'EmpPositionCode' => 5, 'EmpPositionName' => 6, 'EmpLevel' => 7, 'EmployeeCode' => 8, 'EmployeeName' => 9, 'ReportingToEmployeeName' => 10, 'ReportingToEmployeeCode' => 11, 'EmpTown' => 12, 'EmpBranch' => 13, 'Designation' => 14, 'Grade' => 15, 'Status' => 16, 'Month' => 17, 'RequestedAmount' => 18, 'ApprovedAmount' => 19, 'FinalAmount' => 20, 'ExpenseStatus' => 21, 'TotalExpenses' => 22, 'ExpenseDates' => 23, 'RequestedDaHqAmount' => 24, 'RequestedDaExHqAmount' => 25, 'RequestedDaOsAmount' => 26, 'RequestedAaTransitAmount' => 27, 'RequestedDaLastDayOsAmount' => 28, 'RequestedTaAmount' => 29, 'RequestedInternetBillAmount' => 30, 'RequestedOsPetrolAllowanceAmount' => 31, 'RequestedIsbtAmount' => 32, 'RequestedHillAllowanceAmount' => 33, 'RequestedIlpAmount' => 34, 'RequestedMrConveyanceAmount' => 35, 'RequestedAmConveyanceAmount' => 36, 'RequestedRmLodgingAndFoodAmount' => 37, 'RequestedHandsetAmount' => 38, 'RequestedHqPetrolAllowanceAmount' => 39, 'RequestedZmLodgingAndFoodAmount' => 40, 'RequestedRmMobileBillAmount' => 41, 'RequestedZmLocalConveyanceAmount' => 42, 'RequestedRmLocalConveyanceAmount' => 43, 'RequestedZmMobileBillAmount' => 44, 'RequestedStationeryAmount' => 45, 'RequestedEventAmount' => 46, 'RequestedOwnStayAmount' => 47, 'RequestedOtherZmLocalConveyanceAmount' => 48, 'RequestedOtherOsPetrolAllowanceAmount' => 49, 'RequestedOtherRmLocalConveyanceAmount' => 50, 'FinalDaHqAmount' => 51, 'FinalDaExHqAmount' => 52, 'FinalDaOsAmount' => 53, 'FinalDaTransitAmount' => 54, 'FinalDaLastDayOsAmount' => 55, 'FinalTaAmount' => 56, 'FinalInternetBillAmount' => 57, 'FinalOsPetrolAllowanceAmount' => 58, 'FinalIsbtAmount' => 59, 'FinalHillAllowanceAmount' => 60, 'FinalIlpAmount' => 61, 'FinalMrConveyanceAmount' => 62, 'FinalAmConveyanceAmount' => 63, 'FinalRmLodgingAndFoodAmount' => 64, 'FinalHandsetAmount' => 65, 'FinalHqPetrolAllowanceAmount' => 66, 'FinalZmLodgingAndFoodAmount' => 67, 'FinalRmMobileBillAmount' => 68, 'FinalZmLocalConveyanceAmount' => 69, 'FinalRmLocalConveyanceAmount' => 70, 'FinalZmMobileBillAmount' => 71, 'FinalStationeryAmount' => 72, 'FinalEventAmount' => 73, 'Final_own_stay_amount' => 74, 'FinalOtherZmLocalConveyanceAmount' => 75, 'FinalOtherOsPetrolAllowanceAmount' => 76, 'FinalOtherRmLocalConveyanceAmount' => 77, ],
        self::TYPE_CAMELNAME     => ['uniqueid' => 0, 'employeeId' => 1, 'positionId' => 2, 'orgunitid' => 3, 'buName' => 4, 'empPositionCode' => 5, 'empPositionName' => 6, 'empLevel' => 7, 'employeeCode' => 8, 'employeeName' => 9, 'reportingToEmployeeName' => 10, 'reportingToEmployeeCode' => 11, 'empTown' => 12, 'empBranch' => 13, 'designation' => 14, 'grade' => 15, 'status' => 16, 'month' => 17, 'requestedAmount' => 18, 'approvedAmount' => 19, 'finalAmount' => 20, 'expenseStatus' => 21, 'totalExpenses' => 22, 'expenseDates' => 23, 'requestedDaHqAmount' => 24, 'requestedDaExHqAmount' => 25, 'requestedDaOsAmount' => 26, 'requestedAaTransitAmount' => 27, 'requestedDaLastDayOsAmount' => 28, 'requestedTaAmount' => 29, 'requestedInternetBillAmount' => 30, 'requestedOsPetrolAllowanceAmount' => 31, 'requestedIsbtAmount' => 32, 'requestedHillAllowanceAmount' => 33, 'requestedIlpAmount' => 34, 'requestedMrConveyanceAmount' => 35, 'requestedAmConveyanceAmount' => 36, 'requestedRmLodgingAndFoodAmount' => 37, 'requestedHandsetAmount' => 38, 'requestedHqPetrolAllowanceAmount' => 39, 'requestedZmLodgingAndFoodAmount' => 40, 'requestedRmMobileBillAmount' => 41, 'requestedZmLocalConveyanceAmount' => 42, 'requestedRmLocalConveyanceAmount' => 43, 'requestedZmMobileBillAmount' => 44, 'requestedStationeryAmount' => 45, 'requestedEventAmount' => 46, 'requestedOwnStayAmount' => 47, 'requestedOtherZmLocalConveyanceAmount' => 48, 'requestedOtherOsPetrolAllowanceAmount' => 49, 'requestedOtherRmLocalConveyanceAmount' => 50, 'finalDaHqAmount' => 51, 'finalDaExHqAmount' => 52, 'finalDaOsAmount' => 53, 'finalDaTransitAmount' => 54, 'finalDaLastDayOsAmount' => 55, 'finalTaAmount' => 56, 'finalInternetBillAmount' => 57, 'finalOsPetrolAllowanceAmount' => 58, 'finalIsbtAmount' => 59, 'finalHillAllowanceAmount' => 60, 'finalIlpAmount' => 61, 'finalMrConveyanceAmount' => 62, 'finalAmConveyanceAmount' => 63, 'finalRmLodgingAndFoodAmount' => 64, 'finalHandsetAmount' => 65, 'finalHqPetrolAllowanceAmount' => 66, 'finalZmLodgingAndFoodAmount' => 67, 'finalRmMobileBillAmount' => 68, 'finalZmLocalConveyanceAmount' => 69, 'finalRmLocalConveyanceAmount' => 70, 'finalZmMobileBillAmount' => 71, 'finalStationeryAmount' => 72, 'finalEventAmount' => 73, 'final_own_stay_amount' => 74, 'finalOtherZmLocalConveyanceAmount' => 75, 'finalOtherOsPetrolAllowanceAmount' => 76, 'finalOtherRmLocalConveyanceAmount' => 77, ],
        self::TYPE_COLNAME       => [ExportExpensesSummaryTableMap::COL_UNIQUEID => 0, ExportExpensesSummaryTableMap::COL_EMPLOYEE_ID => 1, ExportExpensesSummaryTableMap::COL_POSITION_ID => 2, ExportExpensesSummaryTableMap::COL_ORGUNITID => 3, ExportExpensesSummaryTableMap::COL_BU_NAME => 4, ExportExpensesSummaryTableMap::COL_EMP_POSITION_CODE => 5, ExportExpensesSummaryTableMap::COL_EMP_POSITION_NAME => 6, ExportExpensesSummaryTableMap::COL_EMP_LEVEL => 7, ExportExpensesSummaryTableMap::COL_EMPLOYEE_CODE => 8, ExportExpensesSummaryTableMap::COL_EMPLOYEE_NAME => 9, ExportExpensesSummaryTableMap::COL_REPORTING_TO_EMPLOYEE_NAME => 10, ExportExpensesSummaryTableMap::COL_REPORTING_TO_EMPLOYEE_CODE => 11, ExportExpensesSummaryTableMap::COL_EMP_TOWN => 12, ExportExpensesSummaryTableMap::COL_EMP_BRANCH => 13, ExportExpensesSummaryTableMap::COL_DESIGNATION => 14, ExportExpensesSummaryTableMap::COL_GRADE => 15, ExportExpensesSummaryTableMap::COL_STATUS => 16, ExportExpensesSummaryTableMap::COL_MONTH => 17, ExportExpensesSummaryTableMap::COL_REQUESTED_AMOUNT => 18, ExportExpensesSummaryTableMap::COL_APPROVED_AMOUNT => 19, ExportExpensesSummaryTableMap::COL_FINAL_AMOUNT => 20, ExportExpensesSummaryTableMap::COL_EXPENSE_STATUS => 21, ExportExpensesSummaryTableMap::COL_TOTAL_EXPENSES => 22, ExportExpensesSummaryTableMap::COL_EXPENSE_DATES => 23, ExportExpensesSummaryTableMap::COL_REQUESTED_DA_HQ_AMOUNT => 24, ExportExpensesSummaryTableMap::COL_REQUESTED_DA_EX_HQ_AMOUNT => 25, ExportExpensesSummaryTableMap::COL_REQUESTED_DA_OS_AMOUNT => 26, ExportExpensesSummaryTableMap::COL_REQUESTED_DA_TRANSIT_AMOUNT => 27, ExportExpensesSummaryTableMap::COL_REQUESTED_DA_LAST_DAY_OS_AMOUNT => 28, ExportExpensesSummaryTableMap::COL_REQUESTED_TA_AMOUNT => 29, ExportExpensesSummaryTableMap::COL_REQUESTED_INTERNET_BILL_AMOUNT => 30, ExportExpensesSummaryTableMap::COL_REQUESTED_OS_PETROL_ALLOWANCE_AMOUNT => 31, ExportExpensesSummaryTableMap::COL_REQUESTED_ISBT_AMOUNT => 32, ExportExpensesSummaryTableMap::COL_REQUESTED_HILL_ALLOWANCE_AMOUNT => 33, ExportExpensesSummaryTableMap::COL_REQUESTED_ILP_AMOUNT => 34, ExportExpensesSummaryTableMap::COL_REQUESTED_MR_CONVEYANCE_AMOUNT => 35, ExportExpensesSummaryTableMap::COL_REQUESTED_AM_CONVEYANCE_AMOUNT => 36, ExportExpensesSummaryTableMap::COL_REQUESTED_RM_LODGING_AND_FOOD_AMOUNT => 37, ExportExpensesSummaryTableMap::COL_REQUESTED_HANDSET_AMOUNT => 38, ExportExpensesSummaryTableMap::COL_REQUESTED_HQ_PETROL_ALLOWANCE_AMOUNT => 39, ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_LODGING_AND_FOOD_AMOUNT => 40, ExportExpensesSummaryTableMap::COL_REQUESTED_RM_MOBILE_BILL_AMOUNT => 41, ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_LOCAL_CONVEYANCE_AMOUNT => 42, ExportExpensesSummaryTableMap::COL_REQUESTED_RM_LOCAL_CONVEYANCE_AMOUNT => 43, ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_MOBILE_BILL_AMOUNT => 44, ExportExpensesSummaryTableMap::COL_REQUESTED_STATIONERY_AMOUNT => 45, ExportExpensesSummaryTableMap::COL_REQUESTED_EVENT_AMOUNT => 46, ExportExpensesSummaryTableMap::COL_REQUESTED_OWN_STAY_AMOUNT => 47, ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT => 48, ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_OS_PETROL_ALLOWANCE_AMOUNT => 49, ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT => 50, ExportExpensesSummaryTableMap::COL_FINAL_DA_HQ_AMOUNT => 51, ExportExpensesSummaryTableMap::COL_FINAL_DA_EX_HQ_AMOUNT => 52, ExportExpensesSummaryTableMap::COL_FINAL_DA_OS_AMOUNT => 53, ExportExpensesSummaryTableMap::COL_FINAL_DA_TRANSIT_AMOUNT => 54, ExportExpensesSummaryTableMap::COL_FINAL_DA_LAST_DAY_OS_AMOUNT => 55, ExportExpensesSummaryTableMap::COL_FINAL_TA_AMOUNT => 56, ExportExpensesSummaryTableMap::COL_FINAL_INTERNET_BILL_AMOUNT => 57, ExportExpensesSummaryTableMap::COL_FINAL_OS_PETROL_ALLOWANCE_AMOUNT => 58, ExportExpensesSummaryTableMap::COL_FINAL_ISBT_AMOUNT => 59, ExportExpensesSummaryTableMap::COL_FINAL_HILL_ALLOWANCE_AMOUNT => 60, ExportExpensesSummaryTableMap::COL_FINAL_ILP_AMOUNT => 61, ExportExpensesSummaryTableMap::COL_FINAL_MR_CONVEYANCE_AMOUNT => 62, ExportExpensesSummaryTableMap::COL_FINAL_AM_CONVEYANCE_AMOUNT => 63, ExportExpensesSummaryTableMap::COL_FINAL_RM_LODGING_AND_FOOD_AMOUNT => 64, ExportExpensesSummaryTableMap::COL_FINAL_HANDSET_AMOUNT => 65, ExportExpensesSummaryTableMap::COL_FINAL_HQ_PETROL_ALLOWANCE_AMOUNT => 66, ExportExpensesSummaryTableMap::COL_FINAL_ZM_LODGING_AND_FOOD_AMOUNT => 67, ExportExpensesSummaryTableMap::COL_FINAL_RM_MOBILE_BILL_AMOUNT => 68, ExportExpensesSummaryTableMap::COL_FINAL_ZM_LOCAL_CONVEYANCE_AMOUNT => 69, ExportExpensesSummaryTableMap::COL_FINAL_RM_LOCAL_CONVEYANCE_AMOUNT => 70, ExportExpensesSummaryTableMap::COL_FINAL_ZM_MOBILE_BILL_AMOUNT => 71, ExportExpensesSummaryTableMap::COL_FINAL_STATIONERY_AMOUNT => 72, ExportExpensesSummaryTableMap::COL_FINAL_EVENT_AMOUNT => 73, ExportExpensesSummaryTableMap::COL_FINAL_OWN_STAY_AMOUNT => 74, ExportExpensesSummaryTableMap::COL_FINAL_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT => 75, ExportExpensesSummaryTableMap::COL_FINAL_OTHER_OS_PETROL_ALLOWANCE_AMOUNT => 76, ExportExpensesSummaryTableMap::COL_FINAL_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT => 77, ],
        self::TYPE_FIELDNAME     => ['uniqueid' => 0, 'employee_id' => 1, 'position_id' => 2, 'orgunitid' => 3, 'bu_name' => 4, 'emp_position_code' => 5, 'emp_position_name' => 6, 'emp_level' => 7, 'employee_code' => 8, 'employee_name' => 9, 'reporting_to_employee_name' => 10, 'reporting_to_employee_code' => 11, 'emp_town' => 12, 'emp_branch' => 13, 'designation' => 14, 'grade' => 15, 'status' => 16, 'month' => 17, 'requested_amount' => 18, 'approved_amount' => 19, 'final_amount' => 20, 'expense_status' => 21, 'total_expenses' => 22, 'expense_dates' => 23, 'requested_da_hq_amount' => 24, 'requested_da_ex_hq_amount' => 25, 'requested_da_os_amount' => 26, 'requested_da_transit_amount' => 27, 'requested_da_last_day_os_amount' => 28, 'requested_ta_amount' => 29, 'requested_internet_bill_amount' => 30, 'requested_os_petrol_allowance_amount' => 31, 'requested_isbt_amount' => 32, 'requested_hill_allowance_amount' => 33, 'requested_ilp_amount' => 34, 'requested_mr_conveyance_amount' => 35, 'requested_am_conveyance_amount' => 36, 'requested_rm_lodging_and_food_amount' => 37, 'requested_handset_amount' => 38, 'requested_hq_petrol_allowance_amount' => 39, 'requested_zm_lodging_and_food_amount' => 40, 'requested_rm_mobile_bill_amount' => 41, 'requested_zm_local_conveyance_amount' => 42, 'requested_rm_local_conveyance_amount' => 43, 'requested_zm_mobile_bill_amount' => 44, 'requested_stationery_amount' => 45, 'requested_event_amount' => 46, 'requested_own_stay_amount' => 47, 'requested_other_zm_local_conveyance_amount' => 48, 'requested_other_os_petrol_allowance_amount' => 49, 'requested_other_rm_local_conveyance_amount' => 50, 'final_da_hq_amount' => 51, 'final_da_ex_hq_amount' => 52, 'final_da_os_amount' => 53, 'final_da_transit_amount' => 54, 'final_da_last_day_os_amount' => 55, 'final_ta_amount' => 56, 'final_internet_bill_amount' => 57, 'final_os_petrol_allowance_amount' => 58, 'final_isbt_amount' => 59, 'final_hill_allowance_amount' => 60, 'final_ilp_amount' => 61, 'final_mr_conveyance_amount' => 62, 'final_am_conveyance_amount' => 63, 'final_rm_lodging_and_food_amount' => 64, 'final_handset_amount' => 65, 'final_hq_petrol_allowance_amount' => 66, 'final_zm_lodging_and_food_amount' => 67, 'final_rm_mobile_bill_amount' => 68, 'final_zm_local_conveyance_amount' => 69, 'final_rm_local_conveyance_amount' => 70, 'final_zm_mobile_bill_amount' => 71, 'final_stationery_amount' => 72, 'final_event_amount' => 73, 'final_own_stay_amount' => 74, 'final_other_zm_local_conveyance_amount' => 75, 'final_other_os_petrol_allowance_amount' => 76, 'final_other_rm_local_conveyance_amount' => 77, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Uniqueid' => 'UNIQUEID',
        'ExportExpensesSummary.Uniqueid' => 'UNIQUEID',
        'uniqueid' => 'UNIQUEID',
        'exportExpensesSummary.uniqueid' => 'UNIQUEID',
        'ExportExpensesSummaryTableMap::COL_UNIQUEID' => 'UNIQUEID',
        'COL_UNIQUEID' => 'UNIQUEID',
        'export_expenses_summary.uniqueid' => 'UNIQUEID',
        'EmployeeId' => 'EMPLOYEE_ID',
        'ExportExpensesSummary.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'exportExpensesSummary.employeeId' => 'EMPLOYEE_ID',
        'ExportExpensesSummaryTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'export_expenses_summary.employee_id' => 'EMPLOYEE_ID',
        'PositionId' => 'POSITION_ID',
        'ExportExpensesSummary.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'exportExpensesSummary.positionId' => 'POSITION_ID',
        'ExportExpensesSummaryTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'export_expenses_summary.position_id' => 'POSITION_ID',
        'Orgunitid' => 'ORGUNITID',
        'ExportExpensesSummary.Orgunitid' => 'ORGUNITID',
        'orgunitid' => 'ORGUNITID',
        'exportExpensesSummary.orgunitid' => 'ORGUNITID',
        'ExportExpensesSummaryTableMap::COL_ORGUNITID' => 'ORGUNITID',
        'COL_ORGUNITID' => 'ORGUNITID',
        'export_expenses_summary.orgunitid' => 'ORGUNITID',
        'BuName' => 'BU_NAME',
        'ExportExpensesSummary.BuName' => 'BU_NAME',
        'buName' => 'BU_NAME',
        'exportExpensesSummary.buName' => 'BU_NAME',
        'ExportExpensesSummaryTableMap::COL_BU_NAME' => 'BU_NAME',
        'COL_BU_NAME' => 'BU_NAME',
        'bu_name' => 'BU_NAME',
        'export_expenses_summary.bu_name' => 'BU_NAME',
        'EmpPositionCode' => 'EMP_POSITION_CODE',
        'ExportExpensesSummary.EmpPositionCode' => 'EMP_POSITION_CODE',
        'empPositionCode' => 'EMP_POSITION_CODE',
        'exportExpensesSummary.empPositionCode' => 'EMP_POSITION_CODE',
        'ExportExpensesSummaryTableMap::COL_EMP_POSITION_CODE' => 'EMP_POSITION_CODE',
        'COL_EMP_POSITION_CODE' => 'EMP_POSITION_CODE',
        'emp_position_code' => 'EMP_POSITION_CODE',
        'export_expenses_summary.emp_position_code' => 'EMP_POSITION_CODE',
        'EmpPositionName' => 'EMP_POSITION_NAME',
        'ExportExpensesSummary.EmpPositionName' => 'EMP_POSITION_NAME',
        'empPositionName' => 'EMP_POSITION_NAME',
        'exportExpensesSummary.empPositionName' => 'EMP_POSITION_NAME',
        'ExportExpensesSummaryTableMap::COL_EMP_POSITION_NAME' => 'EMP_POSITION_NAME',
        'COL_EMP_POSITION_NAME' => 'EMP_POSITION_NAME',
        'emp_position_name' => 'EMP_POSITION_NAME',
        'export_expenses_summary.emp_position_name' => 'EMP_POSITION_NAME',
        'EmpLevel' => 'EMP_LEVEL',
        'ExportExpensesSummary.EmpLevel' => 'EMP_LEVEL',
        'empLevel' => 'EMP_LEVEL',
        'exportExpensesSummary.empLevel' => 'EMP_LEVEL',
        'ExportExpensesSummaryTableMap::COL_EMP_LEVEL' => 'EMP_LEVEL',
        'COL_EMP_LEVEL' => 'EMP_LEVEL',
        'emp_level' => 'EMP_LEVEL',
        'export_expenses_summary.emp_level' => 'EMP_LEVEL',
        'EmployeeCode' => 'EMPLOYEE_CODE',
        'ExportExpensesSummary.EmployeeCode' => 'EMPLOYEE_CODE',
        'employeeCode' => 'EMPLOYEE_CODE',
        'exportExpensesSummary.employeeCode' => 'EMPLOYEE_CODE',
        'ExportExpensesSummaryTableMap::COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'employee_code' => 'EMPLOYEE_CODE',
        'export_expenses_summary.employee_code' => 'EMPLOYEE_CODE',
        'EmployeeName' => 'EMPLOYEE_NAME',
        'ExportExpensesSummary.EmployeeName' => 'EMPLOYEE_NAME',
        'employeeName' => 'EMPLOYEE_NAME',
        'exportExpensesSummary.employeeName' => 'EMPLOYEE_NAME',
        'ExportExpensesSummaryTableMap::COL_EMPLOYEE_NAME' => 'EMPLOYEE_NAME',
        'COL_EMPLOYEE_NAME' => 'EMPLOYEE_NAME',
        'employee_name' => 'EMPLOYEE_NAME',
        'export_expenses_summary.employee_name' => 'EMPLOYEE_NAME',
        'ReportingToEmployeeName' => 'REPORTING_TO_EMPLOYEE_NAME',
        'ExportExpensesSummary.ReportingToEmployeeName' => 'REPORTING_TO_EMPLOYEE_NAME',
        'reportingToEmployeeName' => 'REPORTING_TO_EMPLOYEE_NAME',
        'exportExpensesSummary.reportingToEmployeeName' => 'REPORTING_TO_EMPLOYEE_NAME',
        'ExportExpensesSummaryTableMap::COL_REPORTING_TO_EMPLOYEE_NAME' => 'REPORTING_TO_EMPLOYEE_NAME',
        'COL_REPORTING_TO_EMPLOYEE_NAME' => 'REPORTING_TO_EMPLOYEE_NAME',
        'reporting_to_employee_name' => 'REPORTING_TO_EMPLOYEE_NAME',
        'export_expenses_summary.reporting_to_employee_name' => 'REPORTING_TO_EMPLOYEE_NAME',
        'ReportingToEmployeeCode' => 'REPORTING_TO_EMPLOYEE_CODE',
        'ExportExpensesSummary.ReportingToEmployeeCode' => 'REPORTING_TO_EMPLOYEE_CODE',
        'reportingToEmployeeCode' => 'REPORTING_TO_EMPLOYEE_CODE',
        'exportExpensesSummary.reportingToEmployeeCode' => 'REPORTING_TO_EMPLOYEE_CODE',
        'ExportExpensesSummaryTableMap::COL_REPORTING_TO_EMPLOYEE_CODE' => 'REPORTING_TO_EMPLOYEE_CODE',
        'COL_REPORTING_TO_EMPLOYEE_CODE' => 'REPORTING_TO_EMPLOYEE_CODE',
        'reporting_to_employee_code' => 'REPORTING_TO_EMPLOYEE_CODE',
        'export_expenses_summary.reporting_to_employee_code' => 'REPORTING_TO_EMPLOYEE_CODE',
        'EmpTown' => 'EMP_TOWN',
        'ExportExpensesSummary.EmpTown' => 'EMP_TOWN',
        'empTown' => 'EMP_TOWN',
        'exportExpensesSummary.empTown' => 'EMP_TOWN',
        'ExportExpensesSummaryTableMap::COL_EMP_TOWN' => 'EMP_TOWN',
        'COL_EMP_TOWN' => 'EMP_TOWN',
        'emp_town' => 'EMP_TOWN',
        'export_expenses_summary.emp_town' => 'EMP_TOWN',
        'EmpBranch' => 'EMP_BRANCH',
        'ExportExpensesSummary.EmpBranch' => 'EMP_BRANCH',
        'empBranch' => 'EMP_BRANCH',
        'exportExpensesSummary.empBranch' => 'EMP_BRANCH',
        'ExportExpensesSummaryTableMap::COL_EMP_BRANCH' => 'EMP_BRANCH',
        'COL_EMP_BRANCH' => 'EMP_BRANCH',
        'emp_branch' => 'EMP_BRANCH',
        'export_expenses_summary.emp_branch' => 'EMP_BRANCH',
        'Designation' => 'DESIGNATION',
        'ExportExpensesSummary.Designation' => 'DESIGNATION',
        'designation' => 'DESIGNATION',
        'exportExpensesSummary.designation' => 'DESIGNATION',
        'ExportExpensesSummaryTableMap::COL_DESIGNATION' => 'DESIGNATION',
        'COL_DESIGNATION' => 'DESIGNATION',
        'export_expenses_summary.designation' => 'DESIGNATION',
        'Grade' => 'GRADE',
        'ExportExpensesSummary.Grade' => 'GRADE',
        'grade' => 'GRADE',
        'exportExpensesSummary.grade' => 'GRADE',
        'ExportExpensesSummaryTableMap::COL_GRADE' => 'GRADE',
        'COL_GRADE' => 'GRADE',
        'export_expenses_summary.grade' => 'GRADE',
        'Status' => 'STATUS',
        'ExportExpensesSummary.Status' => 'STATUS',
        'status' => 'STATUS',
        'exportExpensesSummary.status' => 'STATUS',
        'ExportExpensesSummaryTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'export_expenses_summary.status' => 'STATUS',
        'Month' => 'MONTH',
        'ExportExpensesSummary.Month' => 'MONTH',
        'month' => 'MONTH',
        'exportExpensesSummary.month' => 'MONTH',
        'ExportExpensesSummaryTableMap::COL_MONTH' => 'MONTH',
        'COL_MONTH' => 'MONTH',
        'export_expenses_summary.month' => 'MONTH',
        'RequestedAmount' => 'REQUESTED_AMOUNT',
        'ExportExpensesSummary.RequestedAmount' => 'REQUESTED_AMOUNT',
        'requestedAmount' => 'REQUESTED_AMOUNT',
        'exportExpensesSummary.requestedAmount' => 'REQUESTED_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_AMOUNT' => 'REQUESTED_AMOUNT',
        'COL_REQUESTED_AMOUNT' => 'REQUESTED_AMOUNT',
        'requested_amount' => 'REQUESTED_AMOUNT',
        'export_expenses_summary.requested_amount' => 'REQUESTED_AMOUNT',
        'ApprovedAmount' => 'APPROVED_AMOUNT',
        'ExportExpensesSummary.ApprovedAmount' => 'APPROVED_AMOUNT',
        'approvedAmount' => 'APPROVED_AMOUNT',
        'exportExpensesSummary.approvedAmount' => 'APPROVED_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_APPROVED_AMOUNT' => 'APPROVED_AMOUNT',
        'COL_APPROVED_AMOUNT' => 'APPROVED_AMOUNT',
        'approved_amount' => 'APPROVED_AMOUNT',
        'export_expenses_summary.approved_amount' => 'APPROVED_AMOUNT',
        'FinalAmount' => 'FINAL_AMOUNT',
        'ExportExpensesSummary.FinalAmount' => 'FINAL_AMOUNT',
        'finalAmount' => 'FINAL_AMOUNT',
        'exportExpensesSummary.finalAmount' => 'FINAL_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_AMOUNT' => 'FINAL_AMOUNT',
        'COL_FINAL_AMOUNT' => 'FINAL_AMOUNT',
        'final_amount' => 'FINAL_AMOUNT',
        'export_expenses_summary.final_amount' => 'FINAL_AMOUNT',
        'ExpenseStatus' => 'EXPENSE_STATUS',
        'ExportExpensesSummary.ExpenseStatus' => 'EXPENSE_STATUS',
        'expenseStatus' => 'EXPENSE_STATUS',
        'exportExpensesSummary.expenseStatus' => 'EXPENSE_STATUS',
        'ExportExpensesSummaryTableMap::COL_EXPENSE_STATUS' => 'EXPENSE_STATUS',
        'COL_EXPENSE_STATUS' => 'EXPENSE_STATUS',
        'expense_status' => 'EXPENSE_STATUS',
        'export_expenses_summary.expense_status' => 'EXPENSE_STATUS',
        'TotalExpenses' => 'TOTAL_EXPENSES',
        'ExportExpensesSummary.TotalExpenses' => 'TOTAL_EXPENSES',
        'totalExpenses' => 'TOTAL_EXPENSES',
        'exportExpensesSummary.totalExpenses' => 'TOTAL_EXPENSES',
        'ExportExpensesSummaryTableMap::COL_TOTAL_EXPENSES' => 'TOTAL_EXPENSES',
        'COL_TOTAL_EXPENSES' => 'TOTAL_EXPENSES',
        'total_expenses' => 'TOTAL_EXPENSES',
        'export_expenses_summary.total_expenses' => 'TOTAL_EXPENSES',
        'ExpenseDates' => 'EXPENSE_DATES',
        'ExportExpensesSummary.ExpenseDates' => 'EXPENSE_DATES',
        'expenseDates' => 'EXPENSE_DATES',
        'exportExpensesSummary.expenseDates' => 'EXPENSE_DATES',
        'ExportExpensesSummaryTableMap::COL_EXPENSE_DATES' => 'EXPENSE_DATES',
        'COL_EXPENSE_DATES' => 'EXPENSE_DATES',
        'expense_dates' => 'EXPENSE_DATES',
        'export_expenses_summary.expense_dates' => 'EXPENSE_DATES',
        'RequestedDaHqAmount' => 'REQUESTED_DA_HQ_AMOUNT',
        'ExportExpensesSummary.RequestedDaHqAmount' => 'REQUESTED_DA_HQ_AMOUNT',
        'requestedDaHqAmount' => 'REQUESTED_DA_HQ_AMOUNT',
        'exportExpensesSummary.requestedDaHqAmount' => 'REQUESTED_DA_HQ_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_DA_HQ_AMOUNT' => 'REQUESTED_DA_HQ_AMOUNT',
        'COL_REQUESTED_DA_HQ_AMOUNT' => 'REQUESTED_DA_HQ_AMOUNT',
        'requested_da_hq_amount' => 'REQUESTED_DA_HQ_AMOUNT',
        'export_expenses_summary.requested_da_hq_amount' => 'REQUESTED_DA_HQ_AMOUNT',
        'RequestedDaExHqAmount' => 'REQUESTED_DA_EX_HQ_AMOUNT',
        'ExportExpensesSummary.RequestedDaExHqAmount' => 'REQUESTED_DA_EX_HQ_AMOUNT',
        'requestedDaExHqAmount' => 'REQUESTED_DA_EX_HQ_AMOUNT',
        'exportExpensesSummary.requestedDaExHqAmount' => 'REQUESTED_DA_EX_HQ_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_DA_EX_HQ_AMOUNT' => 'REQUESTED_DA_EX_HQ_AMOUNT',
        'COL_REQUESTED_DA_EX_HQ_AMOUNT' => 'REQUESTED_DA_EX_HQ_AMOUNT',
        'requested_da_ex_hq_amount' => 'REQUESTED_DA_EX_HQ_AMOUNT',
        'export_expenses_summary.requested_da_ex_hq_amount' => 'REQUESTED_DA_EX_HQ_AMOUNT',
        'RequestedDaOsAmount' => 'REQUESTED_DA_OS_AMOUNT',
        'ExportExpensesSummary.RequestedDaOsAmount' => 'REQUESTED_DA_OS_AMOUNT',
        'requestedDaOsAmount' => 'REQUESTED_DA_OS_AMOUNT',
        'exportExpensesSummary.requestedDaOsAmount' => 'REQUESTED_DA_OS_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_DA_OS_AMOUNT' => 'REQUESTED_DA_OS_AMOUNT',
        'COL_REQUESTED_DA_OS_AMOUNT' => 'REQUESTED_DA_OS_AMOUNT',
        'requested_da_os_amount' => 'REQUESTED_DA_OS_AMOUNT',
        'export_expenses_summary.requested_da_os_amount' => 'REQUESTED_DA_OS_AMOUNT',
        'RequestedAaTransitAmount' => 'REQUESTED_DA_TRANSIT_AMOUNT',
        'ExportExpensesSummary.RequestedAaTransitAmount' => 'REQUESTED_DA_TRANSIT_AMOUNT',
        'requestedAaTransitAmount' => 'REQUESTED_DA_TRANSIT_AMOUNT',
        'exportExpensesSummary.requestedAaTransitAmount' => 'REQUESTED_DA_TRANSIT_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_DA_TRANSIT_AMOUNT' => 'REQUESTED_DA_TRANSIT_AMOUNT',
        'COL_REQUESTED_DA_TRANSIT_AMOUNT' => 'REQUESTED_DA_TRANSIT_AMOUNT',
        'requested_da_transit_amount' => 'REQUESTED_DA_TRANSIT_AMOUNT',
        'export_expenses_summary.requested_da_transit_amount' => 'REQUESTED_DA_TRANSIT_AMOUNT',
        'RequestedDaLastDayOsAmount' => 'REQUESTED_DA_LAST_DAY_OS_AMOUNT',
        'ExportExpensesSummary.RequestedDaLastDayOsAmount' => 'REQUESTED_DA_LAST_DAY_OS_AMOUNT',
        'requestedDaLastDayOsAmount' => 'REQUESTED_DA_LAST_DAY_OS_AMOUNT',
        'exportExpensesSummary.requestedDaLastDayOsAmount' => 'REQUESTED_DA_LAST_DAY_OS_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_DA_LAST_DAY_OS_AMOUNT' => 'REQUESTED_DA_LAST_DAY_OS_AMOUNT',
        'COL_REQUESTED_DA_LAST_DAY_OS_AMOUNT' => 'REQUESTED_DA_LAST_DAY_OS_AMOUNT',
        'requested_da_last_day_os_amount' => 'REQUESTED_DA_LAST_DAY_OS_AMOUNT',
        'export_expenses_summary.requested_da_last_day_os_amount' => 'REQUESTED_DA_LAST_DAY_OS_AMOUNT',
        'RequestedTaAmount' => 'REQUESTED_TA_AMOUNT',
        'ExportExpensesSummary.RequestedTaAmount' => 'REQUESTED_TA_AMOUNT',
        'requestedTaAmount' => 'REQUESTED_TA_AMOUNT',
        'exportExpensesSummary.requestedTaAmount' => 'REQUESTED_TA_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_TA_AMOUNT' => 'REQUESTED_TA_AMOUNT',
        'COL_REQUESTED_TA_AMOUNT' => 'REQUESTED_TA_AMOUNT',
        'requested_ta_amount' => 'REQUESTED_TA_AMOUNT',
        'export_expenses_summary.requested_ta_amount' => 'REQUESTED_TA_AMOUNT',
        'RequestedInternetBillAmount' => 'REQUESTED_INTERNET_BILL_AMOUNT',
        'ExportExpensesSummary.RequestedInternetBillAmount' => 'REQUESTED_INTERNET_BILL_AMOUNT',
        'requestedInternetBillAmount' => 'REQUESTED_INTERNET_BILL_AMOUNT',
        'exportExpensesSummary.requestedInternetBillAmount' => 'REQUESTED_INTERNET_BILL_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_INTERNET_BILL_AMOUNT' => 'REQUESTED_INTERNET_BILL_AMOUNT',
        'COL_REQUESTED_INTERNET_BILL_AMOUNT' => 'REQUESTED_INTERNET_BILL_AMOUNT',
        'requested_internet_bill_amount' => 'REQUESTED_INTERNET_BILL_AMOUNT',
        'export_expenses_summary.requested_internet_bill_amount' => 'REQUESTED_INTERNET_BILL_AMOUNT',
        'RequestedOsPetrolAllowanceAmount' => 'REQUESTED_OS_PETROL_ALLOWANCE_AMOUNT',
        'ExportExpensesSummary.RequestedOsPetrolAllowanceAmount' => 'REQUESTED_OS_PETROL_ALLOWANCE_AMOUNT',
        'requestedOsPetrolAllowanceAmount' => 'REQUESTED_OS_PETROL_ALLOWANCE_AMOUNT',
        'exportExpensesSummary.requestedOsPetrolAllowanceAmount' => 'REQUESTED_OS_PETROL_ALLOWANCE_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_OS_PETROL_ALLOWANCE_AMOUNT' => 'REQUESTED_OS_PETROL_ALLOWANCE_AMOUNT',
        'COL_REQUESTED_OS_PETROL_ALLOWANCE_AMOUNT' => 'REQUESTED_OS_PETROL_ALLOWANCE_AMOUNT',
        'requested_os_petrol_allowance_amount' => 'REQUESTED_OS_PETROL_ALLOWANCE_AMOUNT',
        'export_expenses_summary.requested_os_petrol_allowance_amount' => 'REQUESTED_OS_PETROL_ALLOWANCE_AMOUNT',
        'RequestedIsbtAmount' => 'REQUESTED_ISBT_AMOUNT',
        'ExportExpensesSummary.RequestedIsbtAmount' => 'REQUESTED_ISBT_AMOUNT',
        'requestedIsbtAmount' => 'REQUESTED_ISBT_AMOUNT',
        'exportExpensesSummary.requestedIsbtAmount' => 'REQUESTED_ISBT_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_ISBT_AMOUNT' => 'REQUESTED_ISBT_AMOUNT',
        'COL_REQUESTED_ISBT_AMOUNT' => 'REQUESTED_ISBT_AMOUNT',
        'requested_isbt_amount' => 'REQUESTED_ISBT_AMOUNT',
        'export_expenses_summary.requested_isbt_amount' => 'REQUESTED_ISBT_AMOUNT',
        'RequestedHillAllowanceAmount' => 'REQUESTED_HILL_ALLOWANCE_AMOUNT',
        'ExportExpensesSummary.RequestedHillAllowanceAmount' => 'REQUESTED_HILL_ALLOWANCE_AMOUNT',
        'requestedHillAllowanceAmount' => 'REQUESTED_HILL_ALLOWANCE_AMOUNT',
        'exportExpensesSummary.requestedHillAllowanceAmount' => 'REQUESTED_HILL_ALLOWANCE_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_HILL_ALLOWANCE_AMOUNT' => 'REQUESTED_HILL_ALLOWANCE_AMOUNT',
        'COL_REQUESTED_HILL_ALLOWANCE_AMOUNT' => 'REQUESTED_HILL_ALLOWANCE_AMOUNT',
        'requested_hill_allowance_amount' => 'REQUESTED_HILL_ALLOWANCE_AMOUNT',
        'export_expenses_summary.requested_hill_allowance_amount' => 'REQUESTED_HILL_ALLOWANCE_AMOUNT',
        'RequestedIlpAmount' => 'REQUESTED_ILP_AMOUNT',
        'ExportExpensesSummary.RequestedIlpAmount' => 'REQUESTED_ILP_AMOUNT',
        'requestedIlpAmount' => 'REQUESTED_ILP_AMOUNT',
        'exportExpensesSummary.requestedIlpAmount' => 'REQUESTED_ILP_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_ILP_AMOUNT' => 'REQUESTED_ILP_AMOUNT',
        'COL_REQUESTED_ILP_AMOUNT' => 'REQUESTED_ILP_AMOUNT',
        'requested_ilp_amount' => 'REQUESTED_ILP_AMOUNT',
        'export_expenses_summary.requested_ilp_amount' => 'REQUESTED_ILP_AMOUNT',
        'RequestedMrConveyanceAmount' => 'REQUESTED_MR_CONVEYANCE_AMOUNT',
        'ExportExpensesSummary.RequestedMrConveyanceAmount' => 'REQUESTED_MR_CONVEYANCE_AMOUNT',
        'requestedMrConveyanceAmount' => 'REQUESTED_MR_CONVEYANCE_AMOUNT',
        'exportExpensesSummary.requestedMrConveyanceAmount' => 'REQUESTED_MR_CONVEYANCE_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_MR_CONVEYANCE_AMOUNT' => 'REQUESTED_MR_CONVEYANCE_AMOUNT',
        'COL_REQUESTED_MR_CONVEYANCE_AMOUNT' => 'REQUESTED_MR_CONVEYANCE_AMOUNT',
        'requested_mr_conveyance_amount' => 'REQUESTED_MR_CONVEYANCE_AMOUNT',
        'export_expenses_summary.requested_mr_conveyance_amount' => 'REQUESTED_MR_CONVEYANCE_AMOUNT',
        'RequestedAmConveyanceAmount' => 'REQUESTED_AM_CONVEYANCE_AMOUNT',
        'ExportExpensesSummary.RequestedAmConveyanceAmount' => 'REQUESTED_AM_CONVEYANCE_AMOUNT',
        'requestedAmConveyanceAmount' => 'REQUESTED_AM_CONVEYANCE_AMOUNT',
        'exportExpensesSummary.requestedAmConveyanceAmount' => 'REQUESTED_AM_CONVEYANCE_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_AM_CONVEYANCE_AMOUNT' => 'REQUESTED_AM_CONVEYANCE_AMOUNT',
        'COL_REQUESTED_AM_CONVEYANCE_AMOUNT' => 'REQUESTED_AM_CONVEYANCE_AMOUNT',
        'requested_am_conveyance_amount' => 'REQUESTED_AM_CONVEYANCE_AMOUNT',
        'export_expenses_summary.requested_am_conveyance_amount' => 'REQUESTED_AM_CONVEYANCE_AMOUNT',
        'RequestedRmLodgingAndFoodAmount' => 'REQUESTED_RM_LODGING_AND_FOOD_AMOUNT',
        'ExportExpensesSummary.RequestedRmLodgingAndFoodAmount' => 'REQUESTED_RM_LODGING_AND_FOOD_AMOUNT',
        'requestedRmLodgingAndFoodAmount' => 'REQUESTED_RM_LODGING_AND_FOOD_AMOUNT',
        'exportExpensesSummary.requestedRmLodgingAndFoodAmount' => 'REQUESTED_RM_LODGING_AND_FOOD_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_RM_LODGING_AND_FOOD_AMOUNT' => 'REQUESTED_RM_LODGING_AND_FOOD_AMOUNT',
        'COL_REQUESTED_RM_LODGING_AND_FOOD_AMOUNT' => 'REQUESTED_RM_LODGING_AND_FOOD_AMOUNT',
        'requested_rm_lodging_and_food_amount' => 'REQUESTED_RM_LODGING_AND_FOOD_AMOUNT',
        'export_expenses_summary.requested_rm_lodging_and_food_amount' => 'REQUESTED_RM_LODGING_AND_FOOD_AMOUNT',
        'RequestedHandsetAmount' => 'REQUESTED_HANDSET_AMOUNT',
        'ExportExpensesSummary.RequestedHandsetAmount' => 'REQUESTED_HANDSET_AMOUNT',
        'requestedHandsetAmount' => 'REQUESTED_HANDSET_AMOUNT',
        'exportExpensesSummary.requestedHandsetAmount' => 'REQUESTED_HANDSET_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_HANDSET_AMOUNT' => 'REQUESTED_HANDSET_AMOUNT',
        'COL_REQUESTED_HANDSET_AMOUNT' => 'REQUESTED_HANDSET_AMOUNT',
        'requested_handset_amount' => 'REQUESTED_HANDSET_AMOUNT',
        'export_expenses_summary.requested_handset_amount' => 'REQUESTED_HANDSET_AMOUNT',
        'RequestedHqPetrolAllowanceAmount' => 'REQUESTED_HQ_PETROL_ALLOWANCE_AMOUNT',
        'ExportExpensesSummary.RequestedHqPetrolAllowanceAmount' => 'REQUESTED_HQ_PETROL_ALLOWANCE_AMOUNT',
        'requestedHqPetrolAllowanceAmount' => 'REQUESTED_HQ_PETROL_ALLOWANCE_AMOUNT',
        'exportExpensesSummary.requestedHqPetrolAllowanceAmount' => 'REQUESTED_HQ_PETROL_ALLOWANCE_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_HQ_PETROL_ALLOWANCE_AMOUNT' => 'REQUESTED_HQ_PETROL_ALLOWANCE_AMOUNT',
        'COL_REQUESTED_HQ_PETROL_ALLOWANCE_AMOUNT' => 'REQUESTED_HQ_PETROL_ALLOWANCE_AMOUNT',
        'requested_hq_petrol_allowance_amount' => 'REQUESTED_HQ_PETROL_ALLOWANCE_AMOUNT',
        'export_expenses_summary.requested_hq_petrol_allowance_amount' => 'REQUESTED_HQ_PETROL_ALLOWANCE_AMOUNT',
        'RequestedZmLodgingAndFoodAmount' => 'REQUESTED_ZM_LODGING_AND_FOOD_AMOUNT',
        'ExportExpensesSummary.RequestedZmLodgingAndFoodAmount' => 'REQUESTED_ZM_LODGING_AND_FOOD_AMOUNT',
        'requestedZmLodgingAndFoodAmount' => 'REQUESTED_ZM_LODGING_AND_FOOD_AMOUNT',
        'exportExpensesSummary.requestedZmLodgingAndFoodAmount' => 'REQUESTED_ZM_LODGING_AND_FOOD_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_LODGING_AND_FOOD_AMOUNT' => 'REQUESTED_ZM_LODGING_AND_FOOD_AMOUNT',
        'COL_REQUESTED_ZM_LODGING_AND_FOOD_AMOUNT' => 'REQUESTED_ZM_LODGING_AND_FOOD_AMOUNT',
        'requested_zm_lodging_and_food_amount' => 'REQUESTED_ZM_LODGING_AND_FOOD_AMOUNT',
        'export_expenses_summary.requested_zm_lodging_and_food_amount' => 'REQUESTED_ZM_LODGING_AND_FOOD_AMOUNT',
        'RequestedRmMobileBillAmount' => 'REQUESTED_RM_MOBILE_BILL_AMOUNT',
        'ExportExpensesSummary.RequestedRmMobileBillAmount' => 'REQUESTED_RM_MOBILE_BILL_AMOUNT',
        'requestedRmMobileBillAmount' => 'REQUESTED_RM_MOBILE_BILL_AMOUNT',
        'exportExpensesSummary.requestedRmMobileBillAmount' => 'REQUESTED_RM_MOBILE_BILL_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_RM_MOBILE_BILL_AMOUNT' => 'REQUESTED_RM_MOBILE_BILL_AMOUNT',
        'COL_REQUESTED_RM_MOBILE_BILL_AMOUNT' => 'REQUESTED_RM_MOBILE_BILL_AMOUNT',
        'requested_rm_mobile_bill_amount' => 'REQUESTED_RM_MOBILE_BILL_AMOUNT',
        'export_expenses_summary.requested_rm_mobile_bill_amount' => 'REQUESTED_RM_MOBILE_BILL_AMOUNT',
        'RequestedZmLocalConveyanceAmount' => 'REQUESTED_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'ExportExpensesSummary.RequestedZmLocalConveyanceAmount' => 'REQUESTED_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'requestedZmLocalConveyanceAmount' => 'REQUESTED_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'exportExpensesSummary.requestedZmLocalConveyanceAmount' => 'REQUESTED_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_LOCAL_CONVEYANCE_AMOUNT' => 'REQUESTED_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'COL_REQUESTED_ZM_LOCAL_CONVEYANCE_AMOUNT' => 'REQUESTED_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'requested_zm_local_conveyance_amount' => 'REQUESTED_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'export_expenses_summary.requested_zm_local_conveyance_amount' => 'REQUESTED_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'RequestedRmLocalConveyanceAmount' => 'REQUESTED_RM_LOCAL_CONVEYANCE_AMOUNT',
        'ExportExpensesSummary.RequestedRmLocalConveyanceAmount' => 'REQUESTED_RM_LOCAL_CONVEYANCE_AMOUNT',
        'requestedRmLocalConveyanceAmount' => 'REQUESTED_RM_LOCAL_CONVEYANCE_AMOUNT',
        'exportExpensesSummary.requestedRmLocalConveyanceAmount' => 'REQUESTED_RM_LOCAL_CONVEYANCE_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_RM_LOCAL_CONVEYANCE_AMOUNT' => 'REQUESTED_RM_LOCAL_CONVEYANCE_AMOUNT',
        'COL_REQUESTED_RM_LOCAL_CONVEYANCE_AMOUNT' => 'REQUESTED_RM_LOCAL_CONVEYANCE_AMOUNT',
        'requested_rm_local_conveyance_amount' => 'REQUESTED_RM_LOCAL_CONVEYANCE_AMOUNT',
        'export_expenses_summary.requested_rm_local_conveyance_amount' => 'REQUESTED_RM_LOCAL_CONVEYANCE_AMOUNT',
        'RequestedZmMobileBillAmount' => 'REQUESTED_ZM_MOBILE_BILL_AMOUNT',
        'ExportExpensesSummary.RequestedZmMobileBillAmount' => 'REQUESTED_ZM_MOBILE_BILL_AMOUNT',
        'requestedZmMobileBillAmount' => 'REQUESTED_ZM_MOBILE_BILL_AMOUNT',
        'exportExpensesSummary.requestedZmMobileBillAmount' => 'REQUESTED_ZM_MOBILE_BILL_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_MOBILE_BILL_AMOUNT' => 'REQUESTED_ZM_MOBILE_BILL_AMOUNT',
        'COL_REQUESTED_ZM_MOBILE_BILL_AMOUNT' => 'REQUESTED_ZM_MOBILE_BILL_AMOUNT',
        'requested_zm_mobile_bill_amount' => 'REQUESTED_ZM_MOBILE_BILL_AMOUNT',
        'export_expenses_summary.requested_zm_mobile_bill_amount' => 'REQUESTED_ZM_MOBILE_BILL_AMOUNT',
        'RequestedStationeryAmount' => 'REQUESTED_STATIONERY_AMOUNT',
        'ExportExpensesSummary.RequestedStationeryAmount' => 'REQUESTED_STATIONERY_AMOUNT',
        'requestedStationeryAmount' => 'REQUESTED_STATIONERY_AMOUNT',
        'exportExpensesSummary.requestedStationeryAmount' => 'REQUESTED_STATIONERY_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_STATIONERY_AMOUNT' => 'REQUESTED_STATIONERY_AMOUNT',
        'COL_REQUESTED_STATIONERY_AMOUNT' => 'REQUESTED_STATIONERY_AMOUNT',
        'requested_stationery_amount' => 'REQUESTED_STATIONERY_AMOUNT',
        'export_expenses_summary.requested_stationery_amount' => 'REQUESTED_STATIONERY_AMOUNT',
        'RequestedEventAmount' => 'REQUESTED_EVENT_AMOUNT',
        'ExportExpensesSummary.RequestedEventAmount' => 'REQUESTED_EVENT_AMOUNT',
        'requestedEventAmount' => 'REQUESTED_EVENT_AMOUNT',
        'exportExpensesSummary.requestedEventAmount' => 'REQUESTED_EVENT_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_EVENT_AMOUNT' => 'REQUESTED_EVENT_AMOUNT',
        'COL_REQUESTED_EVENT_AMOUNT' => 'REQUESTED_EVENT_AMOUNT',
        'requested_event_amount' => 'REQUESTED_EVENT_AMOUNT',
        'export_expenses_summary.requested_event_amount' => 'REQUESTED_EVENT_AMOUNT',
        'RequestedOwnStayAmount' => 'REQUESTED_OWN_STAY_AMOUNT',
        'ExportExpensesSummary.RequestedOwnStayAmount' => 'REQUESTED_OWN_STAY_AMOUNT',
        'requestedOwnStayAmount' => 'REQUESTED_OWN_STAY_AMOUNT',
        'exportExpensesSummary.requestedOwnStayAmount' => 'REQUESTED_OWN_STAY_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_OWN_STAY_AMOUNT' => 'REQUESTED_OWN_STAY_AMOUNT',
        'COL_REQUESTED_OWN_STAY_AMOUNT' => 'REQUESTED_OWN_STAY_AMOUNT',
        'requested_own_stay_amount' => 'REQUESTED_OWN_STAY_AMOUNT',
        'export_expenses_summary.requested_own_stay_amount' => 'REQUESTED_OWN_STAY_AMOUNT',
        'RequestedOtherZmLocalConveyanceAmount' => 'REQUESTED_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'ExportExpensesSummary.RequestedOtherZmLocalConveyanceAmount' => 'REQUESTED_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'requestedOtherZmLocalConveyanceAmount' => 'REQUESTED_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'exportExpensesSummary.requestedOtherZmLocalConveyanceAmount' => 'REQUESTED_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT' => 'REQUESTED_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'COL_REQUESTED_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT' => 'REQUESTED_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'requested_other_zm_local_conveyance_amount' => 'REQUESTED_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'export_expenses_summary.requested_other_zm_local_conveyance_amount' => 'REQUESTED_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'RequestedOtherOsPetrolAllowanceAmount' => 'REQUESTED_OTHER_OS_PETROL_ALLOWANCE_AMOUNT',
        'ExportExpensesSummary.RequestedOtherOsPetrolAllowanceAmount' => 'REQUESTED_OTHER_OS_PETROL_ALLOWANCE_AMOUNT',
        'requestedOtherOsPetrolAllowanceAmount' => 'REQUESTED_OTHER_OS_PETROL_ALLOWANCE_AMOUNT',
        'exportExpensesSummary.requestedOtherOsPetrolAllowanceAmount' => 'REQUESTED_OTHER_OS_PETROL_ALLOWANCE_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_OS_PETROL_ALLOWANCE_AMOUNT' => 'REQUESTED_OTHER_OS_PETROL_ALLOWANCE_AMOUNT',
        'COL_REQUESTED_OTHER_OS_PETROL_ALLOWANCE_AMOUNT' => 'REQUESTED_OTHER_OS_PETROL_ALLOWANCE_AMOUNT',
        'requested_other_os_petrol_allowance_amount' => 'REQUESTED_OTHER_OS_PETROL_ALLOWANCE_AMOUNT',
        'export_expenses_summary.requested_other_os_petrol_allowance_amount' => 'REQUESTED_OTHER_OS_PETROL_ALLOWANCE_AMOUNT',
        'RequestedOtherRmLocalConveyanceAmount' => 'REQUESTED_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT',
        'ExportExpensesSummary.RequestedOtherRmLocalConveyanceAmount' => 'REQUESTED_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT',
        'requestedOtherRmLocalConveyanceAmount' => 'REQUESTED_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT',
        'exportExpensesSummary.requestedOtherRmLocalConveyanceAmount' => 'REQUESTED_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT' => 'REQUESTED_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT',
        'COL_REQUESTED_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT' => 'REQUESTED_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT',
        'requested_other_rm_local_conveyance_amount' => 'REQUESTED_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT',
        'export_expenses_summary.requested_other_rm_local_conveyance_amount' => 'REQUESTED_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT',
        'FinalDaHqAmount' => 'FINAL_DA_HQ_AMOUNT',
        'ExportExpensesSummary.FinalDaHqAmount' => 'FINAL_DA_HQ_AMOUNT',
        'finalDaHqAmount' => 'FINAL_DA_HQ_AMOUNT',
        'exportExpensesSummary.finalDaHqAmount' => 'FINAL_DA_HQ_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_DA_HQ_AMOUNT' => 'FINAL_DA_HQ_AMOUNT',
        'COL_FINAL_DA_HQ_AMOUNT' => 'FINAL_DA_HQ_AMOUNT',
        'final_da_hq_amount' => 'FINAL_DA_HQ_AMOUNT',
        'export_expenses_summary.final_da_hq_amount' => 'FINAL_DA_HQ_AMOUNT',
        'FinalDaExHqAmount' => 'FINAL_DA_EX_HQ_AMOUNT',
        'ExportExpensesSummary.FinalDaExHqAmount' => 'FINAL_DA_EX_HQ_AMOUNT',
        'finalDaExHqAmount' => 'FINAL_DA_EX_HQ_AMOUNT',
        'exportExpensesSummary.finalDaExHqAmount' => 'FINAL_DA_EX_HQ_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_DA_EX_HQ_AMOUNT' => 'FINAL_DA_EX_HQ_AMOUNT',
        'COL_FINAL_DA_EX_HQ_AMOUNT' => 'FINAL_DA_EX_HQ_AMOUNT',
        'final_da_ex_hq_amount' => 'FINAL_DA_EX_HQ_AMOUNT',
        'export_expenses_summary.final_da_ex_hq_amount' => 'FINAL_DA_EX_HQ_AMOUNT',
        'FinalDaOsAmount' => 'FINAL_DA_OS_AMOUNT',
        'ExportExpensesSummary.FinalDaOsAmount' => 'FINAL_DA_OS_AMOUNT',
        'finalDaOsAmount' => 'FINAL_DA_OS_AMOUNT',
        'exportExpensesSummary.finalDaOsAmount' => 'FINAL_DA_OS_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_DA_OS_AMOUNT' => 'FINAL_DA_OS_AMOUNT',
        'COL_FINAL_DA_OS_AMOUNT' => 'FINAL_DA_OS_AMOUNT',
        'final_da_os_amount' => 'FINAL_DA_OS_AMOUNT',
        'export_expenses_summary.final_da_os_amount' => 'FINAL_DA_OS_AMOUNT',
        'FinalDaTransitAmount' => 'FINAL_DA_TRANSIT_AMOUNT',
        'ExportExpensesSummary.FinalDaTransitAmount' => 'FINAL_DA_TRANSIT_AMOUNT',
        'finalDaTransitAmount' => 'FINAL_DA_TRANSIT_AMOUNT',
        'exportExpensesSummary.finalDaTransitAmount' => 'FINAL_DA_TRANSIT_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_DA_TRANSIT_AMOUNT' => 'FINAL_DA_TRANSIT_AMOUNT',
        'COL_FINAL_DA_TRANSIT_AMOUNT' => 'FINAL_DA_TRANSIT_AMOUNT',
        'final_da_transit_amount' => 'FINAL_DA_TRANSIT_AMOUNT',
        'export_expenses_summary.final_da_transit_amount' => 'FINAL_DA_TRANSIT_AMOUNT',
        'FinalDaLastDayOsAmount' => 'FINAL_DA_LAST_DAY_OS_AMOUNT',
        'ExportExpensesSummary.FinalDaLastDayOsAmount' => 'FINAL_DA_LAST_DAY_OS_AMOUNT',
        'finalDaLastDayOsAmount' => 'FINAL_DA_LAST_DAY_OS_AMOUNT',
        'exportExpensesSummary.finalDaLastDayOsAmount' => 'FINAL_DA_LAST_DAY_OS_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_DA_LAST_DAY_OS_AMOUNT' => 'FINAL_DA_LAST_DAY_OS_AMOUNT',
        'COL_FINAL_DA_LAST_DAY_OS_AMOUNT' => 'FINAL_DA_LAST_DAY_OS_AMOUNT',
        'final_da_last_day_os_amount' => 'FINAL_DA_LAST_DAY_OS_AMOUNT',
        'export_expenses_summary.final_da_last_day_os_amount' => 'FINAL_DA_LAST_DAY_OS_AMOUNT',
        'FinalTaAmount' => 'FINAL_TA_AMOUNT',
        'ExportExpensesSummary.FinalTaAmount' => 'FINAL_TA_AMOUNT',
        'finalTaAmount' => 'FINAL_TA_AMOUNT',
        'exportExpensesSummary.finalTaAmount' => 'FINAL_TA_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_TA_AMOUNT' => 'FINAL_TA_AMOUNT',
        'COL_FINAL_TA_AMOUNT' => 'FINAL_TA_AMOUNT',
        'final_ta_amount' => 'FINAL_TA_AMOUNT',
        'export_expenses_summary.final_ta_amount' => 'FINAL_TA_AMOUNT',
        'FinalInternetBillAmount' => 'FINAL_INTERNET_BILL_AMOUNT',
        'ExportExpensesSummary.FinalInternetBillAmount' => 'FINAL_INTERNET_BILL_AMOUNT',
        'finalInternetBillAmount' => 'FINAL_INTERNET_BILL_AMOUNT',
        'exportExpensesSummary.finalInternetBillAmount' => 'FINAL_INTERNET_BILL_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_INTERNET_BILL_AMOUNT' => 'FINAL_INTERNET_BILL_AMOUNT',
        'COL_FINAL_INTERNET_BILL_AMOUNT' => 'FINAL_INTERNET_BILL_AMOUNT',
        'final_internet_bill_amount' => 'FINAL_INTERNET_BILL_AMOUNT',
        'export_expenses_summary.final_internet_bill_amount' => 'FINAL_INTERNET_BILL_AMOUNT',
        'FinalOsPetrolAllowanceAmount' => 'FINAL_OS_PETROL_ALLOWANCE_AMOUNT',
        'ExportExpensesSummary.FinalOsPetrolAllowanceAmount' => 'FINAL_OS_PETROL_ALLOWANCE_AMOUNT',
        'finalOsPetrolAllowanceAmount' => 'FINAL_OS_PETROL_ALLOWANCE_AMOUNT',
        'exportExpensesSummary.finalOsPetrolAllowanceAmount' => 'FINAL_OS_PETROL_ALLOWANCE_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_OS_PETROL_ALLOWANCE_AMOUNT' => 'FINAL_OS_PETROL_ALLOWANCE_AMOUNT',
        'COL_FINAL_OS_PETROL_ALLOWANCE_AMOUNT' => 'FINAL_OS_PETROL_ALLOWANCE_AMOUNT',
        'final_os_petrol_allowance_amount' => 'FINAL_OS_PETROL_ALLOWANCE_AMOUNT',
        'export_expenses_summary.final_os_petrol_allowance_amount' => 'FINAL_OS_PETROL_ALLOWANCE_AMOUNT',
        'FinalIsbtAmount' => 'FINAL_ISBT_AMOUNT',
        'ExportExpensesSummary.FinalIsbtAmount' => 'FINAL_ISBT_AMOUNT',
        'finalIsbtAmount' => 'FINAL_ISBT_AMOUNT',
        'exportExpensesSummary.finalIsbtAmount' => 'FINAL_ISBT_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_ISBT_AMOUNT' => 'FINAL_ISBT_AMOUNT',
        'COL_FINAL_ISBT_AMOUNT' => 'FINAL_ISBT_AMOUNT',
        'final_isbt_amount' => 'FINAL_ISBT_AMOUNT',
        'export_expenses_summary.final_isbt_amount' => 'FINAL_ISBT_AMOUNT',
        'FinalHillAllowanceAmount' => 'FINAL_HILL_ALLOWANCE_AMOUNT',
        'ExportExpensesSummary.FinalHillAllowanceAmount' => 'FINAL_HILL_ALLOWANCE_AMOUNT',
        'finalHillAllowanceAmount' => 'FINAL_HILL_ALLOWANCE_AMOUNT',
        'exportExpensesSummary.finalHillAllowanceAmount' => 'FINAL_HILL_ALLOWANCE_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_HILL_ALLOWANCE_AMOUNT' => 'FINAL_HILL_ALLOWANCE_AMOUNT',
        'COL_FINAL_HILL_ALLOWANCE_AMOUNT' => 'FINAL_HILL_ALLOWANCE_AMOUNT',
        'final_hill_allowance_amount' => 'FINAL_HILL_ALLOWANCE_AMOUNT',
        'export_expenses_summary.final_hill_allowance_amount' => 'FINAL_HILL_ALLOWANCE_AMOUNT',
        'FinalIlpAmount' => 'FINAL_ILP_AMOUNT',
        'ExportExpensesSummary.FinalIlpAmount' => 'FINAL_ILP_AMOUNT',
        'finalIlpAmount' => 'FINAL_ILP_AMOUNT',
        'exportExpensesSummary.finalIlpAmount' => 'FINAL_ILP_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_ILP_AMOUNT' => 'FINAL_ILP_AMOUNT',
        'COL_FINAL_ILP_AMOUNT' => 'FINAL_ILP_AMOUNT',
        'final_ilp_amount' => 'FINAL_ILP_AMOUNT',
        'export_expenses_summary.final_ilp_amount' => 'FINAL_ILP_AMOUNT',
        'FinalMrConveyanceAmount' => 'FINAL_MR_CONVEYANCE_AMOUNT',
        'ExportExpensesSummary.FinalMrConveyanceAmount' => 'FINAL_MR_CONVEYANCE_AMOUNT',
        'finalMrConveyanceAmount' => 'FINAL_MR_CONVEYANCE_AMOUNT',
        'exportExpensesSummary.finalMrConveyanceAmount' => 'FINAL_MR_CONVEYANCE_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_MR_CONVEYANCE_AMOUNT' => 'FINAL_MR_CONVEYANCE_AMOUNT',
        'COL_FINAL_MR_CONVEYANCE_AMOUNT' => 'FINAL_MR_CONVEYANCE_AMOUNT',
        'final_mr_conveyance_amount' => 'FINAL_MR_CONVEYANCE_AMOUNT',
        'export_expenses_summary.final_mr_conveyance_amount' => 'FINAL_MR_CONVEYANCE_AMOUNT',
        'FinalAmConveyanceAmount' => 'FINAL_AM_CONVEYANCE_AMOUNT',
        'ExportExpensesSummary.FinalAmConveyanceAmount' => 'FINAL_AM_CONVEYANCE_AMOUNT',
        'finalAmConveyanceAmount' => 'FINAL_AM_CONVEYANCE_AMOUNT',
        'exportExpensesSummary.finalAmConveyanceAmount' => 'FINAL_AM_CONVEYANCE_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_AM_CONVEYANCE_AMOUNT' => 'FINAL_AM_CONVEYANCE_AMOUNT',
        'COL_FINAL_AM_CONVEYANCE_AMOUNT' => 'FINAL_AM_CONVEYANCE_AMOUNT',
        'final_am_conveyance_amount' => 'FINAL_AM_CONVEYANCE_AMOUNT',
        'export_expenses_summary.final_am_conveyance_amount' => 'FINAL_AM_CONVEYANCE_AMOUNT',
        'FinalRmLodgingAndFoodAmount' => 'FINAL_RM_LODGING_AND_FOOD_AMOUNT',
        'ExportExpensesSummary.FinalRmLodgingAndFoodAmount' => 'FINAL_RM_LODGING_AND_FOOD_AMOUNT',
        'finalRmLodgingAndFoodAmount' => 'FINAL_RM_LODGING_AND_FOOD_AMOUNT',
        'exportExpensesSummary.finalRmLodgingAndFoodAmount' => 'FINAL_RM_LODGING_AND_FOOD_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_RM_LODGING_AND_FOOD_AMOUNT' => 'FINAL_RM_LODGING_AND_FOOD_AMOUNT',
        'COL_FINAL_RM_LODGING_AND_FOOD_AMOUNT' => 'FINAL_RM_LODGING_AND_FOOD_AMOUNT',
        'final_rm_lodging_and_food_amount' => 'FINAL_RM_LODGING_AND_FOOD_AMOUNT',
        'export_expenses_summary.final_rm_lodging_and_food_amount' => 'FINAL_RM_LODGING_AND_FOOD_AMOUNT',
        'FinalHandsetAmount' => 'FINAL_HANDSET_AMOUNT',
        'ExportExpensesSummary.FinalHandsetAmount' => 'FINAL_HANDSET_AMOUNT',
        'finalHandsetAmount' => 'FINAL_HANDSET_AMOUNT',
        'exportExpensesSummary.finalHandsetAmount' => 'FINAL_HANDSET_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_HANDSET_AMOUNT' => 'FINAL_HANDSET_AMOUNT',
        'COL_FINAL_HANDSET_AMOUNT' => 'FINAL_HANDSET_AMOUNT',
        'final_handset_amount' => 'FINAL_HANDSET_AMOUNT',
        'export_expenses_summary.final_handset_amount' => 'FINAL_HANDSET_AMOUNT',
        'FinalHqPetrolAllowanceAmount' => 'FINAL_HQ_PETROL_ALLOWANCE_AMOUNT',
        'ExportExpensesSummary.FinalHqPetrolAllowanceAmount' => 'FINAL_HQ_PETROL_ALLOWANCE_AMOUNT',
        'finalHqPetrolAllowanceAmount' => 'FINAL_HQ_PETROL_ALLOWANCE_AMOUNT',
        'exportExpensesSummary.finalHqPetrolAllowanceAmount' => 'FINAL_HQ_PETROL_ALLOWANCE_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_HQ_PETROL_ALLOWANCE_AMOUNT' => 'FINAL_HQ_PETROL_ALLOWANCE_AMOUNT',
        'COL_FINAL_HQ_PETROL_ALLOWANCE_AMOUNT' => 'FINAL_HQ_PETROL_ALLOWANCE_AMOUNT',
        'final_hq_petrol_allowance_amount' => 'FINAL_HQ_PETROL_ALLOWANCE_AMOUNT',
        'export_expenses_summary.final_hq_petrol_allowance_amount' => 'FINAL_HQ_PETROL_ALLOWANCE_AMOUNT',
        'FinalZmLodgingAndFoodAmount' => 'FINAL_ZM_LODGING_AND_FOOD_AMOUNT',
        'ExportExpensesSummary.FinalZmLodgingAndFoodAmount' => 'FINAL_ZM_LODGING_AND_FOOD_AMOUNT',
        'finalZmLodgingAndFoodAmount' => 'FINAL_ZM_LODGING_AND_FOOD_AMOUNT',
        'exportExpensesSummary.finalZmLodgingAndFoodAmount' => 'FINAL_ZM_LODGING_AND_FOOD_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_ZM_LODGING_AND_FOOD_AMOUNT' => 'FINAL_ZM_LODGING_AND_FOOD_AMOUNT',
        'COL_FINAL_ZM_LODGING_AND_FOOD_AMOUNT' => 'FINAL_ZM_LODGING_AND_FOOD_AMOUNT',
        'final_zm_lodging_and_food_amount' => 'FINAL_ZM_LODGING_AND_FOOD_AMOUNT',
        'export_expenses_summary.final_zm_lodging_and_food_amount' => 'FINAL_ZM_LODGING_AND_FOOD_AMOUNT',
        'FinalRmMobileBillAmount' => 'FINAL_RM_MOBILE_BILL_AMOUNT',
        'ExportExpensesSummary.FinalRmMobileBillAmount' => 'FINAL_RM_MOBILE_BILL_AMOUNT',
        'finalRmMobileBillAmount' => 'FINAL_RM_MOBILE_BILL_AMOUNT',
        'exportExpensesSummary.finalRmMobileBillAmount' => 'FINAL_RM_MOBILE_BILL_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_RM_MOBILE_BILL_AMOUNT' => 'FINAL_RM_MOBILE_BILL_AMOUNT',
        'COL_FINAL_RM_MOBILE_BILL_AMOUNT' => 'FINAL_RM_MOBILE_BILL_AMOUNT',
        'final_rm_mobile_bill_amount' => 'FINAL_RM_MOBILE_BILL_AMOUNT',
        'export_expenses_summary.final_rm_mobile_bill_amount' => 'FINAL_RM_MOBILE_BILL_AMOUNT',
        'FinalZmLocalConveyanceAmount' => 'FINAL_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'ExportExpensesSummary.FinalZmLocalConveyanceAmount' => 'FINAL_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'finalZmLocalConveyanceAmount' => 'FINAL_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'exportExpensesSummary.finalZmLocalConveyanceAmount' => 'FINAL_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_ZM_LOCAL_CONVEYANCE_AMOUNT' => 'FINAL_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'COL_FINAL_ZM_LOCAL_CONVEYANCE_AMOUNT' => 'FINAL_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'final_zm_local_conveyance_amount' => 'FINAL_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'export_expenses_summary.final_zm_local_conveyance_amount' => 'FINAL_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'FinalRmLocalConveyanceAmount' => 'FINAL_RM_LOCAL_CONVEYANCE_AMOUNT',
        'ExportExpensesSummary.FinalRmLocalConveyanceAmount' => 'FINAL_RM_LOCAL_CONVEYANCE_AMOUNT',
        'finalRmLocalConveyanceAmount' => 'FINAL_RM_LOCAL_CONVEYANCE_AMOUNT',
        'exportExpensesSummary.finalRmLocalConveyanceAmount' => 'FINAL_RM_LOCAL_CONVEYANCE_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_RM_LOCAL_CONVEYANCE_AMOUNT' => 'FINAL_RM_LOCAL_CONVEYANCE_AMOUNT',
        'COL_FINAL_RM_LOCAL_CONVEYANCE_AMOUNT' => 'FINAL_RM_LOCAL_CONVEYANCE_AMOUNT',
        'final_rm_local_conveyance_amount' => 'FINAL_RM_LOCAL_CONVEYANCE_AMOUNT',
        'export_expenses_summary.final_rm_local_conveyance_amount' => 'FINAL_RM_LOCAL_CONVEYANCE_AMOUNT',
        'FinalZmMobileBillAmount' => 'FINAL_ZM_MOBILE_BILL_AMOUNT',
        'ExportExpensesSummary.FinalZmMobileBillAmount' => 'FINAL_ZM_MOBILE_BILL_AMOUNT',
        'finalZmMobileBillAmount' => 'FINAL_ZM_MOBILE_BILL_AMOUNT',
        'exportExpensesSummary.finalZmMobileBillAmount' => 'FINAL_ZM_MOBILE_BILL_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_ZM_MOBILE_BILL_AMOUNT' => 'FINAL_ZM_MOBILE_BILL_AMOUNT',
        'COL_FINAL_ZM_MOBILE_BILL_AMOUNT' => 'FINAL_ZM_MOBILE_BILL_AMOUNT',
        'final_zm_mobile_bill_amount' => 'FINAL_ZM_MOBILE_BILL_AMOUNT',
        'export_expenses_summary.final_zm_mobile_bill_amount' => 'FINAL_ZM_MOBILE_BILL_AMOUNT',
        'FinalStationeryAmount' => 'FINAL_STATIONERY_AMOUNT',
        'ExportExpensesSummary.FinalStationeryAmount' => 'FINAL_STATIONERY_AMOUNT',
        'finalStationeryAmount' => 'FINAL_STATIONERY_AMOUNT',
        'exportExpensesSummary.finalStationeryAmount' => 'FINAL_STATIONERY_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_STATIONERY_AMOUNT' => 'FINAL_STATIONERY_AMOUNT',
        'COL_FINAL_STATIONERY_AMOUNT' => 'FINAL_STATIONERY_AMOUNT',
        'final_stationery_amount' => 'FINAL_STATIONERY_AMOUNT',
        'export_expenses_summary.final_stationery_amount' => 'FINAL_STATIONERY_AMOUNT',
        'FinalEventAmount' => 'FINAL_EVENT_AMOUNT',
        'ExportExpensesSummary.FinalEventAmount' => 'FINAL_EVENT_AMOUNT',
        'finalEventAmount' => 'FINAL_EVENT_AMOUNT',
        'exportExpensesSummary.finalEventAmount' => 'FINAL_EVENT_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_EVENT_AMOUNT' => 'FINAL_EVENT_AMOUNT',
        'COL_FINAL_EVENT_AMOUNT' => 'FINAL_EVENT_AMOUNT',
        'final_event_amount' => 'FINAL_EVENT_AMOUNT',
        'export_expenses_summary.final_event_amount' => 'FINAL_EVENT_AMOUNT',
        'Final_own_stay_amount' => 'FINAL_OWN_STAY_AMOUNT',
        'ExportExpensesSummary.Final_own_stay_amount' => 'FINAL_OWN_STAY_AMOUNT',
        'final_own_stay_amount' => 'FINAL_OWN_STAY_AMOUNT',
        'exportExpensesSummary.final_own_stay_amount' => 'FINAL_OWN_STAY_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_OWN_STAY_AMOUNT' => 'FINAL_OWN_STAY_AMOUNT',
        'COL_FINAL_OWN_STAY_AMOUNT' => 'FINAL_OWN_STAY_AMOUNT',
        'export_expenses_summary.final_own_stay_amount' => 'FINAL_OWN_STAY_AMOUNT',
        'FinalOtherZmLocalConveyanceAmount' => 'FINAL_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'ExportExpensesSummary.FinalOtherZmLocalConveyanceAmount' => 'FINAL_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'finalOtherZmLocalConveyanceAmount' => 'FINAL_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'exportExpensesSummary.finalOtherZmLocalConveyanceAmount' => 'FINAL_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT' => 'FINAL_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'COL_FINAL_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT' => 'FINAL_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'final_other_zm_local_conveyance_amount' => 'FINAL_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'export_expenses_summary.final_other_zm_local_conveyance_amount' => 'FINAL_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT',
        'FinalOtherOsPetrolAllowanceAmount' => 'FINAL_OTHER_OS_PETROL_ALLOWANCE_AMOUNT',
        'ExportExpensesSummary.FinalOtherOsPetrolAllowanceAmount' => 'FINAL_OTHER_OS_PETROL_ALLOWANCE_AMOUNT',
        'finalOtherOsPetrolAllowanceAmount' => 'FINAL_OTHER_OS_PETROL_ALLOWANCE_AMOUNT',
        'exportExpensesSummary.finalOtherOsPetrolAllowanceAmount' => 'FINAL_OTHER_OS_PETROL_ALLOWANCE_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_OTHER_OS_PETROL_ALLOWANCE_AMOUNT' => 'FINAL_OTHER_OS_PETROL_ALLOWANCE_AMOUNT',
        'COL_FINAL_OTHER_OS_PETROL_ALLOWANCE_AMOUNT' => 'FINAL_OTHER_OS_PETROL_ALLOWANCE_AMOUNT',
        'final_other_os_petrol_allowance_amount' => 'FINAL_OTHER_OS_PETROL_ALLOWANCE_AMOUNT',
        'export_expenses_summary.final_other_os_petrol_allowance_amount' => 'FINAL_OTHER_OS_PETROL_ALLOWANCE_AMOUNT',
        'FinalOtherRmLocalConveyanceAmount' => 'FINAL_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT',
        'ExportExpensesSummary.FinalOtherRmLocalConveyanceAmount' => 'FINAL_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT',
        'finalOtherRmLocalConveyanceAmount' => 'FINAL_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT',
        'exportExpensesSummary.finalOtherRmLocalConveyanceAmount' => 'FINAL_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT',
        'ExportExpensesSummaryTableMap::COL_FINAL_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT' => 'FINAL_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT',
        'COL_FINAL_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT' => 'FINAL_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT',
        'final_other_rm_local_conveyance_amount' => 'FINAL_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT',
        'export_expenses_summary.final_other_rm_local_conveyance_amount' => 'FINAL_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('export_expenses_summary');
        $this->setPhpName('ExportExpensesSummary');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\ExportExpensesSummary');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('uniqueid', 'Uniqueid', 'INTEGER', true, null, null);
        $this->addColumn('employee_id', 'EmployeeId', 'INTEGER', false, null, null);
        $this->addColumn('position_id', 'PositionId', 'INTEGER', false, null, null);
        $this->addColumn('orgunitid', 'Orgunitid', 'INTEGER', false, null, null);
        $this->addColumn('bu_name', 'BuName', 'VARCHAR', false, 255, null);
        $this->addColumn('emp_position_code', 'EmpPositionCode', 'VARCHAR', false, 255, null);
        $this->addColumn('emp_position_name', 'EmpPositionName', 'VARCHAR', false, 255, null);
        $this->addColumn('emp_level', 'EmpLevel', 'VARCHAR', false, 255, null);
        $this->addColumn('employee_code', 'EmployeeCode', 'VARCHAR', false, 255, null);
        $this->addColumn('employee_name', 'EmployeeName', 'VARCHAR', false, null, null);
        $this->addColumn('reporting_to_employee_name', 'ReportingToEmployeeName', 'VARCHAR', false, null, null);
        $this->addColumn('reporting_to_employee_code', 'ReportingToEmployeeCode', 'VARCHAR', false, 255, null);
        $this->addColumn('emp_town', 'EmpTown', 'VARCHAR', false, null, null);
        $this->addColumn('emp_branch', 'EmpBranch', 'VARCHAR', false, null, null);
        $this->addColumn('designation', 'Designation', 'VARCHAR', false, null, null);
        $this->addColumn('grade', 'Grade', 'VARCHAR', false, null, null);
        $this->addColumn('status', 'Status', 'VARCHAR', false, null, null);
        $this->addColumn('month', 'Month', 'VARCHAR', false, null, null);
        $this->addColumn('requested_amount', 'RequestedAmount', 'DECIMAL', false, null, null);
        $this->addColumn('approved_amount', 'ApprovedAmount', 'DECIMAL', false, null, null);
        $this->addColumn('final_amount', 'FinalAmount', 'DECIMAL', false, null, null);
        $this->addColumn('expense_status', 'ExpenseStatus', 'VARCHAR', false, 255, null);
        $this->addColumn('total_expenses', 'TotalExpenses', 'INTEGER', false, null, null);
        $this->addColumn('expense_dates', 'ExpenseDates', 'VARCHAR', false, null, null);
        $this->addColumn('requested_da_hq_amount', 'RequestedDaHqAmount', 'DECIMAL', false, null, null);
        $this->addColumn('requested_da_ex_hq_amount', 'RequestedDaExHqAmount', 'DECIMAL', false, null, null);
        $this->addColumn('requested_da_os_amount', 'RequestedDaOsAmount', 'DECIMAL', false, null, null);
        $this->addColumn('requested_da_transit_amount', 'RequestedAaTransitAmount', 'DECIMAL', false, null, null);
        $this->addColumn('requested_da_last_day_os_amount', 'RequestedDaLastDayOsAmount', 'DECIMAL', false, null, null);
        $this->addColumn('requested_ta_amount', 'RequestedTaAmount', 'DECIMAL', false, null, null);
        $this->addColumn('requested_internet_bill_amount', 'RequestedInternetBillAmount', 'DECIMAL', false, null, null);
        $this->addColumn('requested_os_petrol_allowance_amount', 'RequestedOsPetrolAllowanceAmount', 'DECIMAL', false, null, null);
        $this->addColumn('requested_isbt_amount', 'RequestedIsbtAmount', 'DECIMAL', false, null, null);
        $this->addColumn('requested_hill_allowance_amount', 'RequestedHillAllowanceAmount', 'DECIMAL', false, null, null);
        $this->addColumn('requested_ilp_amount', 'RequestedIlpAmount', 'DECIMAL', false, null, null);
        $this->addColumn('requested_mr_conveyance_amount', 'RequestedMrConveyanceAmount', 'DECIMAL', false, null, null);
        $this->addColumn('requested_am_conveyance_amount', 'RequestedAmConveyanceAmount', 'DECIMAL', false, null, null);
        $this->addColumn('requested_rm_lodging_and_food_amount', 'RequestedRmLodgingAndFoodAmount', 'DECIMAL', false, null, null);
        $this->addColumn('requested_handset_amount', 'RequestedHandsetAmount', 'DECIMAL', false, null, null);
        $this->addColumn('requested_hq_petrol_allowance_amount', 'RequestedHqPetrolAllowanceAmount', 'DECIMAL', false, null, null);
        $this->addColumn('requested_zm_lodging_and_food_amount', 'RequestedZmLodgingAndFoodAmount', 'DECIMAL', false, null, null);
        $this->addColumn('requested_rm_mobile_bill_amount', 'RequestedRmMobileBillAmount', 'DECIMAL', false, null, null);
        $this->addColumn('requested_zm_local_conveyance_amount', 'RequestedZmLocalConveyanceAmount', 'DECIMAL', false, null, null);
        $this->addColumn('requested_rm_local_conveyance_amount', 'RequestedRmLocalConveyanceAmount', 'DECIMAL', false, null, null);
        $this->addColumn('requested_zm_mobile_bill_amount', 'RequestedZmMobileBillAmount', 'DECIMAL', false, null, null);
        $this->addColumn('requested_stationery_amount', 'RequestedStationeryAmount', 'DECIMAL', false, null, null);
        $this->addColumn('requested_event_amount', 'RequestedEventAmount', 'DECIMAL', false, null, null);
        $this->addColumn('requested_own_stay_amount', 'RequestedOwnStayAmount', 'DECIMAL', false, null, null);
        $this->addColumn('requested_other_zm_local_conveyance_amount', 'RequestedOtherZmLocalConveyanceAmount', 'DECIMAL', false, null, null);
        $this->addColumn('requested_other_os_petrol_allowance_amount', 'RequestedOtherOsPetrolAllowanceAmount', 'DECIMAL', false, null, null);
        $this->addColumn('requested_other_rm_local_conveyance_amount', 'RequestedOtherRmLocalConveyanceAmount', 'DECIMAL', false, null, null);
        $this->addColumn('final_da_hq_amount', 'FinalDaHqAmount', 'DECIMAL', false, null, null);
        $this->addColumn('final_da_ex_hq_amount', 'FinalDaExHqAmount', 'DECIMAL', false, null, null);
        $this->addColumn('final_da_os_amount', 'FinalDaOsAmount', 'DECIMAL', false, null, null);
        $this->addColumn('final_da_transit_amount', 'FinalDaTransitAmount', 'DECIMAL', false, null, null);
        $this->addColumn('final_da_last_day_os_amount', 'FinalDaLastDayOsAmount', 'DECIMAL', false, null, null);
        $this->addColumn('final_ta_amount', 'FinalTaAmount', 'DECIMAL', false, null, null);
        $this->addColumn('final_internet_bill_amount', 'FinalInternetBillAmount', 'DECIMAL', false, null, null);
        $this->addColumn('final_os_petrol_allowance_amount', 'FinalOsPetrolAllowanceAmount', 'DECIMAL', false, null, null);
        $this->addColumn('final_isbt_amount', 'FinalIsbtAmount', 'DECIMAL', false, null, null);
        $this->addColumn('final_hill_allowance_amount', 'FinalHillAllowanceAmount', 'DECIMAL', false, null, null);
        $this->addColumn('final_ilp_amount', 'FinalIlpAmount', 'DECIMAL', false, null, null);
        $this->addColumn('final_mr_conveyance_amount', 'FinalMrConveyanceAmount', 'DECIMAL', false, null, null);
        $this->addColumn('final_am_conveyance_amount', 'FinalAmConveyanceAmount', 'DECIMAL', false, null, null);
        $this->addColumn('final_rm_lodging_and_food_amount', 'FinalRmLodgingAndFoodAmount', 'DECIMAL', false, null, null);
        $this->addColumn('final_handset_amount', 'FinalHandsetAmount', 'DECIMAL', false, null, null);
        $this->addColumn('final_hq_petrol_allowance_amount', 'FinalHqPetrolAllowanceAmount', 'DECIMAL', false, null, null);
        $this->addColumn('final_zm_lodging_and_food_amount', 'FinalZmLodgingAndFoodAmount', 'DECIMAL', false, null, null);
        $this->addColumn('final_rm_mobile_bill_amount', 'FinalRmMobileBillAmount', 'DECIMAL', false, null, null);
        $this->addColumn('final_zm_local_conveyance_amount', 'FinalZmLocalConveyanceAmount', 'DECIMAL', false, null, null);
        $this->addColumn('final_rm_local_conveyance_amount', 'FinalRmLocalConveyanceAmount', 'DECIMAL', false, null, null);
        $this->addColumn('final_zm_mobile_bill_amount', 'FinalZmMobileBillAmount', 'DECIMAL', false, null, null);
        $this->addColumn('final_stationery_amount', 'FinalStationeryAmount', 'DECIMAL', false, null, null);
        $this->addColumn('final_event_amount', 'FinalEventAmount', 'DECIMAL', false, null, null);
        $this->addColumn('final_own_stay_amount', 'Final_own_stay_amount', 'DECIMAL', false, null, null);
        $this->addColumn('final_other_zm_local_conveyance_amount', 'FinalOtherZmLocalConveyanceAmount', 'DECIMAL', false, null, null);
        $this->addColumn('final_other_os_petrol_allowance_amount', 'FinalOtherOsPetrolAllowanceAmount', 'DECIMAL', false, null, null);
        $this->addColumn('final_other_rm_local_conveyance_amount', 'FinalOtherRmLocalConveyanceAmount', 'DECIMAL', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Uniqueid', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? ExportExpensesSummaryTableMap::CLASS_DEFAULT : ExportExpensesSummaryTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array (ExportExpensesSummary object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ExportExpensesSummaryTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ExportExpensesSummaryTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ExportExpensesSummaryTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ExportExpensesSummaryTableMap::OM_CLASS;
            /** @var ExportExpensesSummary $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ExportExpensesSummaryTableMap::addInstanceToPool($obj, $key);
        }

        return [$obj, $col];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = ExportExpensesSummaryTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ExportExpensesSummaryTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ExportExpensesSummary $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ExportExpensesSummaryTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_UNIQUEID);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_ORGUNITID);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_BU_NAME);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_EMP_POSITION_CODE);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_EMP_POSITION_NAME);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_EMP_LEVEL);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_EMPLOYEE_CODE);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_EMPLOYEE_NAME);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REPORTING_TO_EMPLOYEE_NAME);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REPORTING_TO_EMPLOYEE_CODE);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_EMP_TOWN);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_EMP_BRANCH);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_DESIGNATION);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_GRADE);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_STATUS);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_MONTH);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_APPROVED_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_EXPENSE_STATUS);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_TOTAL_EXPENSES);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_EXPENSE_DATES);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_HQ_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_EX_HQ_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_OS_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_TRANSIT_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_LAST_DAY_OS_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_TA_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_INTERNET_BILL_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_OS_PETROL_ALLOWANCE_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_ISBT_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_HILL_ALLOWANCE_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_ILP_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_MR_CONVEYANCE_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_AM_CONVEYANCE_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_RM_LODGING_AND_FOOD_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_HANDSET_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_HQ_PETROL_ALLOWANCE_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_LODGING_AND_FOOD_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_RM_MOBILE_BILL_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_LOCAL_CONVEYANCE_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_RM_LOCAL_CONVEYANCE_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_MOBILE_BILL_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_STATIONERY_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_EVENT_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_OWN_STAY_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_OS_PETROL_ALLOWANCE_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_DA_HQ_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_DA_EX_HQ_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_DA_OS_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_DA_TRANSIT_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_DA_LAST_DAY_OS_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_TA_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_INTERNET_BILL_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_OS_PETROL_ALLOWANCE_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_ISBT_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_HILL_ALLOWANCE_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_ILP_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_MR_CONVEYANCE_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_AM_CONVEYANCE_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_RM_LODGING_AND_FOOD_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_HANDSET_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_HQ_PETROL_ALLOWANCE_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_ZM_LODGING_AND_FOOD_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_RM_MOBILE_BILL_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_ZM_LOCAL_CONVEYANCE_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_RM_LOCAL_CONVEYANCE_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_ZM_MOBILE_BILL_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_STATIONERY_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_EVENT_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_OWN_STAY_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_OTHER_OS_PETROL_ALLOWANCE_AMOUNT);
            $criteria->addSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT);
        } else {
            $criteria->addSelectColumn($alias . '.uniqueid');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.position_id');
            $criteria->addSelectColumn($alias . '.orgunitid');
            $criteria->addSelectColumn($alias . '.bu_name');
            $criteria->addSelectColumn($alias . '.emp_position_code');
            $criteria->addSelectColumn($alias . '.emp_position_name');
            $criteria->addSelectColumn($alias . '.emp_level');
            $criteria->addSelectColumn($alias . '.employee_code');
            $criteria->addSelectColumn($alias . '.employee_name');
            $criteria->addSelectColumn($alias . '.reporting_to_employee_name');
            $criteria->addSelectColumn($alias . '.reporting_to_employee_code');
            $criteria->addSelectColumn($alias . '.emp_town');
            $criteria->addSelectColumn($alias . '.emp_branch');
            $criteria->addSelectColumn($alias . '.designation');
            $criteria->addSelectColumn($alias . '.grade');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.month');
            $criteria->addSelectColumn($alias . '.requested_amount');
            $criteria->addSelectColumn($alias . '.approved_amount');
            $criteria->addSelectColumn($alias . '.final_amount');
            $criteria->addSelectColumn($alias . '.expense_status');
            $criteria->addSelectColumn($alias . '.total_expenses');
            $criteria->addSelectColumn($alias . '.expense_dates');
            $criteria->addSelectColumn($alias . '.requested_da_hq_amount');
            $criteria->addSelectColumn($alias . '.requested_da_ex_hq_amount');
            $criteria->addSelectColumn($alias . '.requested_da_os_amount');
            $criteria->addSelectColumn($alias . '.requested_da_transit_amount');
            $criteria->addSelectColumn($alias . '.requested_da_last_day_os_amount');
            $criteria->addSelectColumn($alias . '.requested_ta_amount');
            $criteria->addSelectColumn($alias . '.requested_internet_bill_amount');
            $criteria->addSelectColumn($alias . '.requested_os_petrol_allowance_amount');
            $criteria->addSelectColumn($alias . '.requested_isbt_amount');
            $criteria->addSelectColumn($alias . '.requested_hill_allowance_amount');
            $criteria->addSelectColumn($alias . '.requested_ilp_amount');
            $criteria->addSelectColumn($alias . '.requested_mr_conveyance_amount');
            $criteria->addSelectColumn($alias . '.requested_am_conveyance_amount');
            $criteria->addSelectColumn($alias . '.requested_rm_lodging_and_food_amount');
            $criteria->addSelectColumn($alias . '.requested_handset_amount');
            $criteria->addSelectColumn($alias . '.requested_hq_petrol_allowance_amount');
            $criteria->addSelectColumn($alias . '.requested_zm_lodging_and_food_amount');
            $criteria->addSelectColumn($alias . '.requested_rm_mobile_bill_amount');
            $criteria->addSelectColumn($alias . '.requested_zm_local_conveyance_amount');
            $criteria->addSelectColumn($alias . '.requested_rm_local_conveyance_amount');
            $criteria->addSelectColumn($alias . '.requested_zm_mobile_bill_amount');
            $criteria->addSelectColumn($alias . '.requested_stationery_amount');
            $criteria->addSelectColumn($alias . '.requested_event_amount');
            $criteria->addSelectColumn($alias . '.requested_own_stay_amount');
            $criteria->addSelectColumn($alias . '.requested_other_zm_local_conveyance_amount');
            $criteria->addSelectColumn($alias . '.requested_other_os_petrol_allowance_amount');
            $criteria->addSelectColumn($alias . '.requested_other_rm_local_conveyance_amount');
            $criteria->addSelectColumn($alias . '.final_da_hq_amount');
            $criteria->addSelectColumn($alias . '.final_da_ex_hq_amount');
            $criteria->addSelectColumn($alias . '.final_da_os_amount');
            $criteria->addSelectColumn($alias . '.final_da_transit_amount');
            $criteria->addSelectColumn($alias . '.final_da_last_day_os_amount');
            $criteria->addSelectColumn($alias . '.final_ta_amount');
            $criteria->addSelectColumn($alias . '.final_internet_bill_amount');
            $criteria->addSelectColumn($alias . '.final_os_petrol_allowance_amount');
            $criteria->addSelectColumn($alias . '.final_isbt_amount');
            $criteria->addSelectColumn($alias . '.final_hill_allowance_amount');
            $criteria->addSelectColumn($alias . '.final_ilp_amount');
            $criteria->addSelectColumn($alias . '.final_mr_conveyance_amount');
            $criteria->addSelectColumn($alias . '.final_am_conveyance_amount');
            $criteria->addSelectColumn($alias . '.final_rm_lodging_and_food_amount');
            $criteria->addSelectColumn($alias . '.final_handset_amount');
            $criteria->addSelectColumn($alias . '.final_hq_petrol_allowance_amount');
            $criteria->addSelectColumn($alias . '.final_zm_lodging_and_food_amount');
            $criteria->addSelectColumn($alias . '.final_rm_mobile_bill_amount');
            $criteria->addSelectColumn($alias . '.final_zm_local_conveyance_amount');
            $criteria->addSelectColumn($alias . '.final_rm_local_conveyance_amount');
            $criteria->addSelectColumn($alias . '.final_zm_mobile_bill_amount');
            $criteria->addSelectColumn($alias . '.final_stationery_amount');
            $criteria->addSelectColumn($alias . '.final_event_amount');
            $criteria->addSelectColumn($alias . '.final_own_stay_amount');
            $criteria->addSelectColumn($alias . '.final_other_zm_local_conveyance_amount');
            $criteria->addSelectColumn($alias . '.final_other_os_petrol_allowance_amount');
            $criteria->addSelectColumn($alias . '.final_other_rm_local_conveyance_amount');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_UNIQUEID);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_ORGUNITID);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_BU_NAME);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_EMP_POSITION_CODE);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_EMP_POSITION_NAME);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_EMP_LEVEL);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_EMPLOYEE_CODE);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_EMPLOYEE_NAME);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REPORTING_TO_EMPLOYEE_NAME);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REPORTING_TO_EMPLOYEE_CODE);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_EMP_TOWN);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_EMP_BRANCH);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_DESIGNATION);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_GRADE);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_STATUS);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_MONTH);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_APPROVED_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_EXPENSE_STATUS);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_TOTAL_EXPENSES);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_EXPENSE_DATES);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_HQ_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_EX_HQ_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_OS_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_TRANSIT_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_DA_LAST_DAY_OS_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_TA_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_INTERNET_BILL_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_OS_PETROL_ALLOWANCE_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_ISBT_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_HILL_ALLOWANCE_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_ILP_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_MR_CONVEYANCE_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_AM_CONVEYANCE_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_RM_LODGING_AND_FOOD_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_HANDSET_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_HQ_PETROL_ALLOWANCE_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_LODGING_AND_FOOD_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_RM_MOBILE_BILL_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_LOCAL_CONVEYANCE_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_RM_LOCAL_CONVEYANCE_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_ZM_MOBILE_BILL_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_STATIONERY_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_EVENT_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_OWN_STAY_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_OS_PETROL_ALLOWANCE_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_REQUESTED_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_DA_HQ_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_DA_EX_HQ_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_DA_OS_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_DA_TRANSIT_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_DA_LAST_DAY_OS_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_TA_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_INTERNET_BILL_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_OS_PETROL_ALLOWANCE_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_ISBT_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_HILL_ALLOWANCE_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_ILP_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_MR_CONVEYANCE_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_AM_CONVEYANCE_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_RM_LODGING_AND_FOOD_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_HANDSET_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_HQ_PETROL_ALLOWANCE_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_ZM_LODGING_AND_FOOD_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_RM_MOBILE_BILL_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_ZM_LOCAL_CONVEYANCE_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_RM_LOCAL_CONVEYANCE_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_ZM_MOBILE_BILL_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_STATIONERY_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_EVENT_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_OWN_STAY_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_OTHER_ZM_LOCAL_CONVEYANCE_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_OTHER_OS_PETROL_ALLOWANCE_AMOUNT);
            $criteria->removeSelectColumn(ExportExpensesSummaryTableMap::COL_FINAL_OTHER_RM_LOCAL_CONVEYANCE_AMOUNT);
        } else {
            $criteria->removeSelectColumn($alias . '.uniqueid');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.position_id');
            $criteria->removeSelectColumn($alias . '.orgunitid');
            $criteria->removeSelectColumn($alias . '.bu_name');
            $criteria->removeSelectColumn($alias . '.emp_position_code');
            $criteria->removeSelectColumn($alias . '.emp_position_name');
            $criteria->removeSelectColumn($alias . '.emp_level');
            $criteria->removeSelectColumn($alias . '.employee_code');
            $criteria->removeSelectColumn($alias . '.employee_name');
            $criteria->removeSelectColumn($alias . '.reporting_to_employee_name');
            $criteria->removeSelectColumn($alias . '.reporting_to_employee_code');
            $criteria->removeSelectColumn($alias . '.emp_town');
            $criteria->removeSelectColumn($alias . '.emp_branch');
            $criteria->removeSelectColumn($alias . '.designation');
            $criteria->removeSelectColumn($alias . '.grade');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.month');
            $criteria->removeSelectColumn($alias . '.requested_amount');
            $criteria->removeSelectColumn($alias . '.approved_amount');
            $criteria->removeSelectColumn($alias . '.final_amount');
            $criteria->removeSelectColumn($alias . '.expense_status');
            $criteria->removeSelectColumn($alias . '.total_expenses');
            $criteria->removeSelectColumn($alias . '.expense_dates');
            $criteria->removeSelectColumn($alias . '.requested_da_hq_amount');
            $criteria->removeSelectColumn($alias . '.requested_da_ex_hq_amount');
            $criteria->removeSelectColumn($alias . '.requested_da_os_amount');
            $criteria->removeSelectColumn($alias . '.requested_da_transit_amount');
            $criteria->removeSelectColumn($alias . '.requested_da_last_day_os_amount');
            $criteria->removeSelectColumn($alias . '.requested_ta_amount');
            $criteria->removeSelectColumn($alias . '.requested_internet_bill_amount');
            $criteria->removeSelectColumn($alias . '.requested_os_petrol_allowance_amount');
            $criteria->removeSelectColumn($alias . '.requested_isbt_amount');
            $criteria->removeSelectColumn($alias . '.requested_hill_allowance_amount');
            $criteria->removeSelectColumn($alias . '.requested_ilp_amount');
            $criteria->removeSelectColumn($alias . '.requested_mr_conveyance_amount');
            $criteria->removeSelectColumn($alias . '.requested_am_conveyance_amount');
            $criteria->removeSelectColumn($alias . '.requested_rm_lodging_and_food_amount');
            $criteria->removeSelectColumn($alias . '.requested_handset_amount');
            $criteria->removeSelectColumn($alias . '.requested_hq_petrol_allowance_amount');
            $criteria->removeSelectColumn($alias . '.requested_zm_lodging_and_food_amount');
            $criteria->removeSelectColumn($alias . '.requested_rm_mobile_bill_amount');
            $criteria->removeSelectColumn($alias . '.requested_zm_local_conveyance_amount');
            $criteria->removeSelectColumn($alias . '.requested_rm_local_conveyance_amount');
            $criteria->removeSelectColumn($alias . '.requested_zm_mobile_bill_amount');
            $criteria->removeSelectColumn($alias . '.requested_stationery_amount');
            $criteria->removeSelectColumn($alias . '.requested_event_amount');
            $criteria->removeSelectColumn($alias . '.requested_own_stay_amount');
            $criteria->removeSelectColumn($alias . '.requested_other_zm_local_conveyance_amount');
            $criteria->removeSelectColumn($alias . '.requested_other_os_petrol_allowance_amount');
            $criteria->removeSelectColumn($alias . '.requested_other_rm_local_conveyance_amount');
            $criteria->removeSelectColumn($alias . '.final_da_hq_amount');
            $criteria->removeSelectColumn($alias . '.final_da_ex_hq_amount');
            $criteria->removeSelectColumn($alias . '.final_da_os_amount');
            $criteria->removeSelectColumn($alias . '.final_da_transit_amount');
            $criteria->removeSelectColumn($alias . '.final_da_last_day_os_amount');
            $criteria->removeSelectColumn($alias . '.final_ta_amount');
            $criteria->removeSelectColumn($alias . '.final_internet_bill_amount');
            $criteria->removeSelectColumn($alias . '.final_os_petrol_allowance_amount');
            $criteria->removeSelectColumn($alias . '.final_isbt_amount');
            $criteria->removeSelectColumn($alias . '.final_hill_allowance_amount');
            $criteria->removeSelectColumn($alias . '.final_ilp_amount');
            $criteria->removeSelectColumn($alias . '.final_mr_conveyance_amount');
            $criteria->removeSelectColumn($alias . '.final_am_conveyance_amount');
            $criteria->removeSelectColumn($alias . '.final_rm_lodging_and_food_amount');
            $criteria->removeSelectColumn($alias . '.final_handset_amount');
            $criteria->removeSelectColumn($alias . '.final_hq_petrol_allowance_amount');
            $criteria->removeSelectColumn($alias . '.final_zm_lodging_and_food_amount');
            $criteria->removeSelectColumn($alias . '.final_rm_mobile_bill_amount');
            $criteria->removeSelectColumn($alias . '.final_zm_local_conveyance_amount');
            $criteria->removeSelectColumn($alias . '.final_rm_local_conveyance_amount');
            $criteria->removeSelectColumn($alias . '.final_zm_mobile_bill_amount');
            $criteria->removeSelectColumn($alias . '.final_stationery_amount');
            $criteria->removeSelectColumn($alias . '.final_event_amount');
            $criteria->removeSelectColumn($alias . '.final_own_stay_amount');
            $criteria->removeSelectColumn($alias . '.final_other_zm_local_conveyance_amount');
            $criteria->removeSelectColumn($alias . '.final_other_os_petrol_allowance_amount');
            $criteria->removeSelectColumn($alias . '.final_other_rm_local_conveyance_amount');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(ExportExpensesSummaryTableMap::DATABASE_NAME)->getTable(ExportExpensesSummaryTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a ExportExpensesSummary or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or ExportExpensesSummary object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExportExpensesSummaryTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\ExportExpensesSummary) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ExportExpensesSummaryTableMap::DATABASE_NAME);
            $criteria->add(ExportExpensesSummaryTableMap::COL_UNIQUEID, (array) $values, Criteria::IN);
        }

        $query = ExportExpensesSummaryQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ExportExpensesSummaryTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ExportExpensesSummaryTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the export_expenses_summary table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ExportExpensesSummaryQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ExportExpensesSummary or Criteria object.
     *
     * @param mixed $criteria Criteria or ExportExpensesSummary object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExportExpensesSummaryTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ExportExpensesSummary object
        }


        // Set the correct dbName
        $query = ExportExpensesSummaryQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
