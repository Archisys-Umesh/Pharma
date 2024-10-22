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
use entities\ExportExpenseStatusView;
use entities\ExportExpenseStatusViewQuery;


/**
 * This class defines the structure of the 'export_expense_status_view' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ExportExpenseStatusViewTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.ExportExpenseStatusViewTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'export_expense_status_view';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'ExportExpenseStatusView';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\ExportExpenseStatusView';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.ExportExpenseStatusView';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 24;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 24;

    /**
     * the column name for the uniqueid field
     */
    public const COL_UNIQUEID = 'export_expense_status_view.uniqueid';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'export_expense_status_view.employee_id';

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'export_expense_status_view.position_id';

    /**
     * the column name for the orgunitid field
     */
    public const COL_ORGUNITID = 'export_expense_status_view.orgunitid';

    /**
     * the column name for the bu_name field
     */
    public const COL_BU_NAME = 'export_expense_status_view.bu_name';

    /**
     * the column name for the emp_position_code field
     */
    public const COL_EMP_POSITION_CODE = 'export_expense_status_view.emp_position_code';

    /**
     * the column name for the emp_position_name field
     */
    public const COL_EMP_POSITION_NAME = 'export_expense_status_view.emp_position_name';

    /**
     * the column name for the emp_level field
     */
    public const COL_EMP_LEVEL = 'export_expense_status_view.emp_level';

    /**
     * the column name for the employee_code field
     */
    public const COL_EMPLOYEE_CODE = 'export_expense_status_view.employee_code';

    /**
     * the column name for the employee_name field
     */
    public const COL_EMPLOYEE_NAME = 'export_expense_status_view.employee_name';

    /**
     * the column name for the reporting_to_employee_name field
     */
    public const COL_REPORTING_TO_EMPLOYEE_NAME = 'export_expense_status_view.reporting_to_employee_name';

    /**
     * the column name for the reporting_to_employee_code field
     */
    public const COL_REPORTING_TO_EMPLOYEE_CODE = 'export_expense_status_view.reporting_to_employee_code';

    /**
     * the column name for the emp_town field
     */
    public const COL_EMP_TOWN = 'export_expense_status_view.emp_town';

    /**
     * the column name for the emp_branch field
     */
    public const COL_EMP_BRANCH = 'export_expense_status_view.emp_branch';

    /**
     * the column name for the designation field
     */
    public const COL_DESIGNATION = 'export_expense_status_view.designation';

    /**
     * the column name for the grade field
     */
    public const COL_GRADE = 'export_expense_status_view.grade';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'export_expense_status_view.status';

    /**
     * the column name for the month field
     */
    public const COL_MONTH = 'export_expense_status_view.month';

    /**
     * the column name for the requested_amount field
     */
    public const COL_REQUESTED_AMOUNT = 'export_expense_status_view.requested_amount';

    /**
     * the column name for the approved_amount field
     */
    public const COL_APPROVED_AMOUNT = 'export_expense_status_view.approved_amount';

    /**
     * the column name for the final_amount field
     */
    public const COL_FINAL_AMOUNT = 'export_expense_status_view.final_amount';

    /**
     * the column name for the expense_status field
     */
    public const COL_EXPENSE_STATUS = 'export_expense_status_view.expense_status';

    /**
     * the column name for the total_expenses field
     */
    public const COL_TOTAL_EXPENSES = 'export_expense_status_view.total_expenses';

    /**
     * the column name for the expense_dates field
     */
    public const COL_EXPENSE_DATES = 'export_expense_status_view.expense_dates';

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
        self::TYPE_PHPNAME       => ['Uniqueid', 'EmployeeId', 'PositionId', 'Orgunitid', 'BuName', 'EmpPositionCode', 'EmpPositionName', 'EmpLevel', 'EmployeeCode', 'EmployeeName', 'ReportingToEmployeeName', 'ReportingToEmployeeCode', 'EmpTown', 'EmpBranch', 'Designation', 'Grade', 'Status', 'Month', 'RequestedAmount', 'ApprovedAmount', 'FinalAmount', 'ExpenseStatus', 'TotalExpenses', 'ExpenseDates', ],
        self::TYPE_CAMELNAME     => ['uniqueid', 'employeeId', 'positionId', 'orgunitid', 'buName', 'empPositionCode', 'empPositionName', 'empLevel', 'employeeCode', 'employeeName', 'reportingToEmployeeName', 'reportingToEmployeeCode', 'empTown', 'empBranch', 'designation', 'grade', 'status', 'month', 'requestedAmount', 'approvedAmount', 'finalAmount', 'expenseStatus', 'totalExpenses', 'expenseDates', ],
        self::TYPE_COLNAME       => [ExportExpenseStatusViewTableMap::COL_UNIQUEID, ExportExpenseStatusViewTableMap::COL_EMPLOYEE_ID, ExportExpenseStatusViewTableMap::COL_POSITION_ID, ExportExpenseStatusViewTableMap::COL_ORGUNITID, ExportExpenseStatusViewTableMap::COL_BU_NAME, ExportExpenseStatusViewTableMap::COL_EMP_POSITION_CODE, ExportExpenseStatusViewTableMap::COL_EMP_POSITION_NAME, ExportExpenseStatusViewTableMap::COL_EMP_LEVEL, ExportExpenseStatusViewTableMap::COL_EMPLOYEE_CODE, ExportExpenseStatusViewTableMap::COL_EMPLOYEE_NAME, ExportExpenseStatusViewTableMap::COL_REPORTING_TO_EMPLOYEE_NAME, ExportExpenseStatusViewTableMap::COL_REPORTING_TO_EMPLOYEE_CODE, ExportExpenseStatusViewTableMap::COL_EMP_TOWN, ExportExpenseStatusViewTableMap::COL_EMP_BRANCH, ExportExpenseStatusViewTableMap::COL_DESIGNATION, ExportExpenseStatusViewTableMap::COL_GRADE, ExportExpenseStatusViewTableMap::COL_STATUS, ExportExpenseStatusViewTableMap::COL_MONTH, ExportExpenseStatusViewTableMap::COL_REQUESTED_AMOUNT, ExportExpenseStatusViewTableMap::COL_APPROVED_AMOUNT, ExportExpenseStatusViewTableMap::COL_FINAL_AMOUNT, ExportExpenseStatusViewTableMap::COL_EXPENSE_STATUS, ExportExpenseStatusViewTableMap::COL_TOTAL_EXPENSES, ExportExpenseStatusViewTableMap::COL_EXPENSE_DATES, ],
        self::TYPE_FIELDNAME     => ['uniqueid', 'employee_id', 'position_id', 'orgunitid', 'bu_name', 'emp_position_code', 'emp_position_name', 'emp_level', 'employee_code', 'employee_name', 'reporting_to_employee_name', 'reporting_to_employee_code', 'emp_town', 'emp_branch', 'designation', 'grade', 'status', 'month', 'requested_amount', 'approved_amount', 'final_amount', 'expense_status', 'total_expenses', 'expense_dates', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, ]
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
        self::TYPE_PHPNAME       => ['Uniqueid' => 0, 'EmployeeId' => 1, 'PositionId' => 2, 'Orgunitid' => 3, 'BuName' => 4, 'EmpPositionCode' => 5, 'EmpPositionName' => 6, 'EmpLevel' => 7, 'EmployeeCode' => 8, 'EmployeeName' => 9, 'ReportingToEmployeeName' => 10, 'ReportingToEmployeeCode' => 11, 'EmpTown' => 12, 'EmpBranch' => 13, 'Designation' => 14, 'Grade' => 15, 'Status' => 16, 'Month' => 17, 'RequestedAmount' => 18, 'ApprovedAmount' => 19, 'FinalAmount' => 20, 'ExpenseStatus' => 21, 'TotalExpenses' => 22, 'ExpenseDates' => 23, ],
        self::TYPE_CAMELNAME     => ['uniqueid' => 0, 'employeeId' => 1, 'positionId' => 2, 'orgunitid' => 3, 'buName' => 4, 'empPositionCode' => 5, 'empPositionName' => 6, 'empLevel' => 7, 'employeeCode' => 8, 'employeeName' => 9, 'reportingToEmployeeName' => 10, 'reportingToEmployeeCode' => 11, 'empTown' => 12, 'empBranch' => 13, 'designation' => 14, 'grade' => 15, 'status' => 16, 'month' => 17, 'requestedAmount' => 18, 'approvedAmount' => 19, 'finalAmount' => 20, 'expenseStatus' => 21, 'totalExpenses' => 22, 'expenseDates' => 23, ],
        self::TYPE_COLNAME       => [ExportExpenseStatusViewTableMap::COL_UNIQUEID => 0, ExportExpenseStatusViewTableMap::COL_EMPLOYEE_ID => 1, ExportExpenseStatusViewTableMap::COL_POSITION_ID => 2, ExportExpenseStatusViewTableMap::COL_ORGUNITID => 3, ExportExpenseStatusViewTableMap::COL_BU_NAME => 4, ExportExpenseStatusViewTableMap::COL_EMP_POSITION_CODE => 5, ExportExpenseStatusViewTableMap::COL_EMP_POSITION_NAME => 6, ExportExpenseStatusViewTableMap::COL_EMP_LEVEL => 7, ExportExpenseStatusViewTableMap::COL_EMPLOYEE_CODE => 8, ExportExpenseStatusViewTableMap::COL_EMPLOYEE_NAME => 9, ExportExpenseStatusViewTableMap::COL_REPORTING_TO_EMPLOYEE_NAME => 10, ExportExpenseStatusViewTableMap::COL_REPORTING_TO_EMPLOYEE_CODE => 11, ExportExpenseStatusViewTableMap::COL_EMP_TOWN => 12, ExportExpenseStatusViewTableMap::COL_EMP_BRANCH => 13, ExportExpenseStatusViewTableMap::COL_DESIGNATION => 14, ExportExpenseStatusViewTableMap::COL_GRADE => 15, ExportExpenseStatusViewTableMap::COL_STATUS => 16, ExportExpenseStatusViewTableMap::COL_MONTH => 17, ExportExpenseStatusViewTableMap::COL_REQUESTED_AMOUNT => 18, ExportExpenseStatusViewTableMap::COL_APPROVED_AMOUNT => 19, ExportExpenseStatusViewTableMap::COL_FINAL_AMOUNT => 20, ExportExpenseStatusViewTableMap::COL_EXPENSE_STATUS => 21, ExportExpenseStatusViewTableMap::COL_TOTAL_EXPENSES => 22, ExportExpenseStatusViewTableMap::COL_EXPENSE_DATES => 23, ],
        self::TYPE_FIELDNAME     => ['uniqueid' => 0, 'employee_id' => 1, 'position_id' => 2, 'orgunitid' => 3, 'bu_name' => 4, 'emp_position_code' => 5, 'emp_position_name' => 6, 'emp_level' => 7, 'employee_code' => 8, 'employee_name' => 9, 'reporting_to_employee_name' => 10, 'reporting_to_employee_code' => 11, 'emp_town' => 12, 'emp_branch' => 13, 'designation' => 14, 'grade' => 15, 'status' => 16, 'month' => 17, 'requested_amount' => 18, 'approved_amount' => 19, 'final_amount' => 20, 'expense_status' => 21, 'total_expenses' => 22, 'expense_dates' => 23, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Uniqueid' => 'UNIQUEID',
        'ExportExpenseStatusView.Uniqueid' => 'UNIQUEID',
        'uniqueid' => 'UNIQUEID',
        'exportExpenseStatusView.uniqueid' => 'UNIQUEID',
        'ExportExpenseStatusViewTableMap::COL_UNIQUEID' => 'UNIQUEID',
        'COL_UNIQUEID' => 'UNIQUEID',
        'export_expense_status_view.uniqueid' => 'UNIQUEID',
        'EmployeeId' => 'EMPLOYEE_ID',
        'ExportExpenseStatusView.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'exportExpenseStatusView.employeeId' => 'EMPLOYEE_ID',
        'ExportExpenseStatusViewTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'export_expense_status_view.employee_id' => 'EMPLOYEE_ID',
        'PositionId' => 'POSITION_ID',
        'ExportExpenseStatusView.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'exportExpenseStatusView.positionId' => 'POSITION_ID',
        'ExportExpenseStatusViewTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'export_expense_status_view.position_id' => 'POSITION_ID',
        'Orgunitid' => 'ORGUNITID',
        'ExportExpenseStatusView.Orgunitid' => 'ORGUNITID',
        'orgunitid' => 'ORGUNITID',
        'exportExpenseStatusView.orgunitid' => 'ORGUNITID',
        'ExportExpenseStatusViewTableMap::COL_ORGUNITID' => 'ORGUNITID',
        'COL_ORGUNITID' => 'ORGUNITID',
        'export_expense_status_view.orgunitid' => 'ORGUNITID',
        'BuName' => 'BU_NAME',
        'ExportExpenseStatusView.BuName' => 'BU_NAME',
        'buName' => 'BU_NAME',
        'exportExpenseStatusView.buName' => 'BU_NAME',
        'ExportExpenseStatusViewTableMap::COL_BU_NAME' => 'BU_NAME',
        'COL_BU_NAME' => 'BU_NAME',
        'bu_name' => 'BU_NAME',
        'export_expense_status_view.bu_name' => 'BU_NAME',
        'EmpPositionCode' => 'EMP_POSITION_CODE',
        'ExportExpenseStatusView.EmpPositionCode' => 'EMP_POSITION_CODE',
        'empPositionCode' => 'EMP_POSITION_CODE',
        'exportExpenseStatusView.empPositionCode' => 'EMP_POSITION_CODE',
        'ExportExpenseStatusViewTableMap::COL_EMP_POSITION_CODE' => 'EMP_POSITION_CODE',
        'COL_EMP_POSITION_CODE' => 'EMP_POSITION_CODE',
        'emp_position_code' => 'EMP_POSITION_CODE',
        'export_expense_status_view.emp_position_code' => 'EMP_POSITION_CODE',
        'EmpPositionName' => 'EMP_POSITION_NAME',
        'ExportExpenseStatusView.EmpPositionName' => 'EMP_POSITION_NAME',
        'empPositionName' => 'EMP_POSITION_NAME',
        'exportExpenseStatusView.empPositionName' => 'EMP_POSITION_NAME',
        'ExportExpenseStatusViewTableMap::COL_EMP_POSITION_NAME' => 'EMP_POSITION_NAME',
        'COL_EMP_POSITION_NAME' => 'EMP_POSITION_NAME',
        'emp_position_name' => 'EMP_POSITION_NAME',
        'export_expense_status_view.emp_position_name' => 'EMP_POSITION_NAME',
        'EmpLevel' => 'EMP_LEVEL',
        'ExportExpenseStatusView.EmpLevel' => 'EMP_LEVEL',
        'empLevel' => 'EMP_LEVEL',
        'exportExpenseStatusView.empLevel' => 'EMP_LEVEL',
        'ExportExpenseStatusViewTableMap::COL_EMP_LEVEL' => 'EMP_LEVEL',
        'COL_EMP_LEVEL' => 'EMP_LEVEL',
        'emp_level' => 'EMP_LEVEL',
        'export_expense_status_view.emp_level' => 'EMP_LEVEL',
        'EmployeeCode' => 'EMPLOYEE_CODE',
        'ExportExpenseStatusView.EmployeeCode' => 'EMPLOYEE_CODE',
        'employeeCode' => 'EMPLOYEE_CODE',
        'exportExpenseStatusView.employeeCode' => 'EMPLOYEE_CODE',
        'ExportExpenseStatusViewTableMap::COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'employee_code' => 'EMPLOYEE_CODE',
        'export_expense_status_view.employee_code' => 'EMPLOYEE_CODE',
        'EmployeeName' => 'EMPLOYEE_NAME',
        'ExportExpenseStatusView.EmployeeName' => 'EMPLOYEE_NAME',
        'employeeName' => 'EMPLOYEE_NAME',
        'exportExpenseStatusView.employeeName' => 'EMPLOYEE_NAME',
        'ExportExpenseStatusViewTableMap::COL_EMPLOYEE_NAME' => 'EMPLOYEE_NAME',
        'COL_EMPLOYEE_NAME' => 'EMPLOYEE_NAME',
        'employee_name' => 'EMPLOYEE_NAME',
        'export_expense_status_view.employee_name' => 'EMPLOYEE_NAME',
        'ReportingToEmployeeName' => 'REPORTING_TO_EMPLOYEE_NAME',
        'ExportExpenseStatusView.ReportingToEmployeeName' => 'REPORTING_TO_EMPLOYEE_NAME',
        'reportingToEmployeeName' => 'REPORTING_TO_EMPLOYEE_NAME',
        'exportExpenseStatusView.reportingToEmployeeName' => 'REPORTING_TO_EMPLOYEE_NAME',
        'ExportExpenseStatusViewTableMap::COL_REPORTING_TO_EMPLOYEE_NAME' => 'REPORTING_TO_EMPLOYEE_NAME',
        'COL_REPORTING_TO_EMPLOYEE_NAME' => 'REPORTING_TO_EMPLOYEE_NAME',
        'reporting_to_employee_name' => 'REPORTING_TO_EMPLOYEE_NAME',
        'export_expense_status_view.reporting_to_employee_name' => 'REPORTING_TO_EMPLOYEE_NAME',
        'ReportingToEmployeeCode' => 'REPORTING_TO_EMPLOYEE_CODE',
        'ExportExpenseStatusView.ReportingToEmployeeCode' => 'REPORTING_TO_EMPLOYEE_CODE',
        'reportingToEmployeeCode' => 'REPORTING_TO_EMPLOYEE_CODE',
        'exportExpenseStatusView.reportingToEmployeeCode' => 'REPORTING_TO_EMPLOYEE_CODE',
        'ExportExpenseStatusViewTableMap::COL_REPORTING_TO_EMPLOYEE_CODE' => 'REPORTING_TO_EMPLOYEE_CODE',
        'COL_REPORTING_TO_EMPLOYEE_CODE' => 'REPORTING_TO_EMPLOYEE_CODE',
        'reporting_to_employee_code' => 'REPORTING_TO_EMPLOYEE_CODE',
        'export_expense_status_view.reporting_to_employee_code' => 'REPORTING_TO_EMPLOYEE_CODE',
        'EmpTown' => 'EMP_TOWN',
        'ExportExpenseStatusView.EmpTown' => 'EMP_TOWN',
        'empTown' => 'EMP_TOWN',
        'exportExpenseStatusView.empTown' => 'EMP_TOWN',
        'ExportExpenseStatusViewTableMap::COL_EMP_TOWN' => 'EMP_TOWN',
        'COL_EMP_TOWN' => 'EMP_TOWN',
        'emp_town' => 'EMP_TOWN',
        'export_expense_status_view.emp_town' => 'EMP_TOWN',
        'EmpBranch' => 'EMP_BRANCH',
        'ExportExpenseStatusView.EmpBranch' => 'EMP_BRANCH',
        'empBranch' => 'EMP_BRANCH',
        'exportExpenseStatusView.empBranch' => 'EMP_BRANCH',
        'ExportExpenseStatusViewTableMap::COL_EMP_BRANCH' => 'EMP_BRANCH',
        'COL_EMP_BRANCH' => 'EMP_BRANCH',
        'emp_branch' => 'EMP_BRANCH',
        'export_expense_status_view.emp_branch' => 'EMP_BRANCH',
        'Designation' => 'DESIGNATION',
        'ExportExpenseStatusView.Designation' => 'DESIGNATION',
        'designation' => 'DESIGNATION',
        'exportExpenseStatusView.designation' => 'DESIGNATION',
        'ExportExpenseStatusViewTableMap::COL_DESIGNATION' => 'DESIGNATION',
        'COL_DESIGNATION' => 'DESIGNATION',
        'export_expense_status_view.designation' => 'DESIGNATION',
        'Grade' => 'GRADE',
        'ExportExpenseStatusView.Grade' => 'GRADE',
        'grade' => 'GRADE',
        'exportExpenseStatusView.grade' => 'GRADE',
        'ExportExpenseStatusViewTableMap::COL_GRADE' => 'GRADE',
        'COL_GRADE' => 'GRADE',
        'export_expense_status_view.grade' => 'GRADE',
        'Status' => 'STATUS',
        'ExportExpenseStatusView.Status' => 'STATUS',
        'status' => 'STATUS',
        'exportExpenseStatusView.status' => 'STATUS',
        'ExportExpenseStatusViewTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'export_expense_status_view.status' => 'STATUS',
        'Month' => 'MONTH',
        'ExportExpenseStatusView.Month' => 'MONTH',
        'month' => 'MONTH',
        'exportExpenseStatusView.month' => 'MONTH',
        'ExportExpenseStatusViewTableMap::COL_MONTH' => 'MONTH',
        'COL_MONTH' => 'MONTH',
        'export_expense_status_view.month' => 'MONTH',
        'RequestedAmount' => 'REQUESTED_AMOUNT',
        'ExportExpenseStatusView.RequestedAmount' => 'REQUESTED_AMOUNT',
        'requestedAmount' => 'REQUESTED_AMOUNT',
        'exportExpenseStatusView.requestedAmount' => 'REQUESTED_AMOUNT',
        'ExportExpenseStatusViewTableMap::COL_REQUESTED_AMOUNT' => 'REQUESTED_AMOUNT',
        'COL_REQUESTED_AMOUNT' => 'REQUESTED_AMOUNT',
        'requested_amount' => 'REQUESTED_AMOUNT',
        'export_expense_status_view.requested_amount' => 'REQUESTED_AMOUNT',
        'ApprovedAmount' => 'APPROVED_AMOUNT',
        'ExportExpenseStatusView.ApprovedAmount' => 'APPROVED_AMOUNT',
        'approvedAmount' => 'APPROVED_AMOUNT',
        'exportExpenseStatusView.approvedAmount' => 'APPROVED_AMOUNT',
        'ExportExpenseStatusViewTableMap::COL_APPROVED_AMOUNT' => 'APPROVED_AMOUNT',
        'COL_APPROVED_AMOUNT' => 'APPROVED_AMOUNT',
        'approved_amount' => 'APPROVED_AMOUNT',
        'export_expense_status_view.approved_amount' => 'APPROVED_AMOUNT',
        'FinalAmount' => 'FINAL_AMOUNT',
        'ExportExpenseStatusView.FinalAmount' => 'FINAL_AMOUNT',
        'finalAmount' => 'FINAL_AMOUNT',
        'exportExpenseStatusView.finalAmount' => 'FINAL_AMOUNT',
        'ExportExpenseStatusViewTableMap::COL_FINAL_AMOUNT' => 'FINAL_AMOUNT',
        'COL_FINAL_AMOUNT' => 'FINAL_AMOUNT',
        'final_amount' => 'FINAL_AMOUNT',
        'export_expense_status_view.final_amount' => 'FINAL_AMOUNT',
        'ExpenseStatus' => 'EXPENSE_STATUS',
        'ExportExpenseStatusView.ExpenseStatus' => 'EXPENSE_STATUS',
        'expenseStatus' => 'EXPENSE_STATUS',
        'exportExpenseStatusView.expenseStatus' => 'EXPENSE_STATUS',
        'ExportExpenseStatusViewTableMap::COL_EXPENSE_STATUS' => 'EXPENSE_STATUS',
        'COL_EXPENSE_STATUS' => 'EXPENSE_STATUS',
        'expense_status' => 'EXPENSE_STATUS',
        'export_expense_status_view.expense_status' => 'EXPENSE_STATUS',
        'TotalExpenses' => 'TOTAL_EXPENSES',
        'ExportExpenseStatusView.TotalExpenses' => 'TOTAL_EXPENSES',
        'totalExpenses' => 'TOTAL_EXPENSES',
        'exportExpenseStatusView.totalExpenses' => 'TOTAL_EXPENSES',
        'ExportExpenseStatusViewTableMap::COL_TOTAL_EXPENSES' => 'TOTAL_EXPENSES',
        'COL_TOTAL_EXPENSES' => 'TOTAL_EXPENSES',
        'total_expenses' => 'TOTAL_EXPENSES',
        'export_expense_status_view.total_expenses' => 'TOTAL_EXPENSES',
        'ExpenseDates' => 'EXPENSE_DATES',
        'ExportExpenseStatusView.ExpenseDates' => 'EXPENSE_DATES',
        'expenseDates' => 'EXPENSE_DATES',
        'exportExpenseStatusView.expenseDates' => 'EXPENSE_DATES',
        'ExportExpenseStatusViewTableMap::COL_EXPENSE_DATES' => 'EXPENSE_DATES',
        'COL_EXPENSE_DATES' => 'EXPENSE_DATES',
        'expense_dates' => 'EXPENSE_DATES',
        'export_expense_status_view.expense_dates' => 'EXPENSE_DATES',
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
        $this->setName('export_expense_status_view');
        $this->setPhpName('ExportExpenseStatusView');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\ExportExpenseStatusView');
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
        return $withPrefix ? ExportExpenseStatusViewTableMap::CLASS_DEFAULT : ExportExpenseStatusViewTableMap::OM_CLASS;
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
     * @return array (ExportExpenseStatusView object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ExportExpenseStatusViewTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ExportExpenseStatusViewTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ExportExpenseStatusViewTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ExportExpenseStatusViewTableMap::OM_CLASS;
            /** @var ExportExpenseStatusView $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ExportExpenseStatusViewTableMap::addInstanceToPool($obj, $key);
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
            $key = ExportExpenseStatusViewTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ExportExpenseStatusViewTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ExportExpenseStatusView $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ExportExpenseStatusViewTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ExportExpenseStatusViewTableMap::COL_UNIQUEID);
            $criteria->addSelectColumn(ExportExpenseStatusViewTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(ExportExpenseStatusViewTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(ExportExpenseStatusViewTableMap::COL_ORGUNITID);
            $criteria->addSelectColumn(ExportExpenseStatusViewTableMap::COL_BU_NAME);
            $criteria->addSelectColumn(ExportExpenseStatusViewTableMap::COL_EMP_POSITION_CODE);
            $criteria->addSelectColumn(ExportExpenseStatusViewTableMap::COL_EMP_POSITION_NAME);
            $criteria->addSelectColumn(ExportExpenseStatusViewTableMap::COL_EMP_LEVEL);
            $criteria->addSelectColumn(ExportExpenseStatusViewTableMap::COL_EMPLOYEE_CODE);
            $criteria->addSelectColumn(ExportExpenseStatusViewTableMap::COL_EMPLOYEE_NAME);
            $criteria->addSelectColumn(ExportExpenseStatusViewTableMap::COL_REPORTING_TO_EMPLOYEE_NAME);
            $criteria->addSelectColumn(ExportExpenseStatusViewTableMap::COL_REPORTING_TO_EMPLOYEE_CODE);
            $criteria->addSelectColumn(ExportExpenseStatusViewTableMap::COL_EMP_TOWN);
            $criteria->addSelectColumn(ExportExpenseStatusViewTableMap::COL_EMP_BRANCH);
            $criteria->addSelectColumn(ExportExpenseStatusViewTableMap::COL_DESIGNATION);
            $criteria->addSelectColumn(ExportExpenseStatusViewTableMap::COL_GRADE);
            $criteria->addSelectColumn(ExportExpenseStatusViewTableMap::COL_STATUS);
            $criteria->addSelectColumn(ExportExpenseStatusViewTableMap::COL_MONTH);
            $criteria->addSelectColumn(ExportExpenseStatusViewTableMap::COL_REQUESTED_AMOUNT);
            $criteria->addSelectColumn(ExportExpenseStatusViewTableMap::COL_APPROVED_AMOUNT);
            $criteria->addSelectColumn(ExportExpenseStatusViewTableMap::COL_FINAL_AMOUNT);
            $criteria->addSelectColumn(ExportExpenseStatusViewTableMap::COL_EXPENSE_STATUS);
            $criteria->addSelectColumn(ExportExpenseStatusViewTableMap::COL_TOTAL_EXPENSES);
            $criteria->addSelectColumn(ExportExpenseStatusViewTableMap::COL_EXPENSE_DATES);
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
            $criteria->removeSelectColumn(ExportExpenseStatusViewTableMap::COL_UNIQUEID);
            $criteria->removeSelectColumn(ExportExpenseStatusViewTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(ExportExpenseStatusViewTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(ExportExpenseStatusViewTableMap::COL_ORGUNITID);
            $criteria->removeSelectColumn(ExportExpenseStatusViewTableMap::COL_BU_NAME);
            $criteria->removeSelectColumn(ExportExpenseStatusViewTableMap::COL_EMP_POSITION_CODE);
            $criteria->removeSelectColumn(ExportExpenseStatusViewTableMap::COL_EMP_POSITION_NAME);
            $criteria->removeSelectColumn(ExportExpenseStatusViewTableMap::COL_EMP_LEVEL);
            $criteria->removeSelectColumn(ExportExpenseStatusViewTableMap::COL_EMPLOYEE_CODE);
            $criteria->removeSelectColumn(ExportExpenseStatusViewTableMap::COL_EMPLOYEE_NAME);
            $criteria->removeSelectColumn(ExportExpenseStatusViewTableMap::COL_REPORTING_TO_EMPLOYEE_NAME);
            $criteria->removeSelectColumn(ExportExpenseStatusViewTableMap::COL_REPORTING_TO_EMPLOYEE_CODE);
            $criteria->removeSelectColumn(ExportExpenseStatusViewTableMap::COL_EMP_TOWN);
            $criteria->removeSelectColumn(ExportExpenseStatusViewTableMap::COL_EMP_BRANCH);
            $criteria->removeSelectColumn(ExportExpenseStatusViewTableMap::COL_DESIGNATION);
            $criteria->removeSelectColumn(ExportExpenseStatusViewTableMap::COL_GRADE);
            $criteria->removeSelectColumn(ExportExpenseStatusViewTableMap::COL_STATUS);
            $criteria->removeSelectColumn(ExportExpenseStatusViewTableMap::COL_MONTH);
            $criteria->removeSelectColumn(ExportExpenseStatusViewTableMap::COL_REQUESTED_AMOUNT);
            $criteria->removeSelectColumn(ExportExpenseStatusViewTableMap::COL_APPROVED_AMOUNT);
            $criteria->removeSelectColumn(ExportExpenseStatusViewTableMap::COL_FINAL_AMOUNT);
            $criteria->removeSelectColumn(ExportExpenseStatusViewTableMap::COL_EXPENSE_STATUS);
            $criteria->removeSelectColumn(ExportExpenseStatusViewTableMap::COL_TOTAL_EXPENSES);
            $criteria->removeSelectColumn(ExportExpenseStatusViewTableMap::COL_EXPENSE_DATES);
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
        return Propel::getServiceContainer()->getDatabaseMap(ExportExpenseStatusViewTableMap::DATABASE_NAME)->getTable(ExportExpenseStatusViewTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a ExportExpenseStatusView or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or ExportExpenseStatusView object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ExportExpenseStatusViewTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\ExportExpenseStatusView) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ExportExpenseStatusViewTableMap::DATABASE_NAME);
            $criteria->add(ExportExpenseStatusViewTableMap::COL_UNIQUEID, (array) $values, Criteria::IN);
        }

        $query = ExportExpenseStatusViewQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ExportExpenseStatusViewTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ExportExpenseStatusViewTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the export_expense_status_view table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ExportExpenseStatusViewQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ExportExpenseStatusView or Criteria object.
     *
     * @param mixed $criteria Criteria or ExportExpenseStatusView object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExportExpenseStatusViewTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ExportExpenseStatusView object
        }


        // Set the correct dbName
        $query = ExportExpenseStatusViewQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
