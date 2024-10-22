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
use entities\Expenses;
use entities\ExpensesQuery;


/**
 * This class defines the structure of the 'expenses' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ExpensesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.ExpensesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'expenses';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Expenses';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Expenses';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Expenses';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 29;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 29;

    /**
     * the column name for the exp_id field
     */
    public const COL_EXP_ID = 'expenses.exp_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'expenses.company_id';

    /**
     * the column name for the expense_date field
     */
    public const COL_EXPENSE_DATE = 'expenses.expense_date';

    /**
     * the column name for the budget_id field
     */
    public const COL_BUDGET_ID = 'expenses.budget_id';

    /**
     * the column name for the expense_trip field
     */
    public const COL_EXPENSE_TRIP = 'expenses.expense_trip';

    /**
     * the column name for the expense_placewrk field
     */
    public const COL_EXPENSE_PLACEWRK = 'expenses.expense_placewrk';

    /**
     * the column name for the expense_req_amt field
     */
    public const COL_EXPENSE_REQ_AMT = 'expenses.expense_req_amt';

    /**
     * the column name for the expense_approved_amt field
     */
    public const COL_EXPENSE_APPROVED_AMT = 'expenses.expense_approved_amt';

    /**
     * the column name for the expense_additional_amt field
     */
    public const COL_EXPENSE_ADDITIONAL_AMT = 'expenses.expense_additional_amt';

    /**
     * the column name for the expense_tax_amt field
     */
    public const COL_EXPENSE_TAX_AMT = 'expenses.expense_tax_amt';

    /**
     * the column name for the expense_final_amt field
     */
    public const COL_EXPENSE_FINAL_AMT = 'expenses.expense_final_amt';

    /**
     * the column name for the expense_status field
     */
    public const COL_EXPENSE_STATUS = 'expenses.expense_status';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'expenses.employee_id';

    /**
     * the column name for the expense_mode field
     */
    public const COL_EXPENSE_MODE = 'expenses.expense_mode';

    /**
     * the column name for the expense_note field
     */
    public const COL_EXPENSE_NOTE = 'expenses.expense_note';

    /**
     * the column name for the orgunit_id field
     */
    public const COL_ORGUNIT_ID = 'expenses.orgunit_id';

    /**
     * the column name for the trip_currency field
     */
    public const COL_TRIP_CURRENCY = 'expenses.trip_currency';

    /**
     * the column name for the readflag field
     */
    public const COL_READFLAG = 'expenses.readflag';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'expenses.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'expenses.updated_at';

    /**
     * the column name for the pin field
     */
    public const COL_PIN = 'expenses.pin';

    /**
     * the column name for the device_name field
     */
    public const COL_DEVICE_NAME = 'expenses.device_name';

    /**
     * the column name for the device_battery field
     */
    public const COL_DEVICE_BATTERY = 'expenses.device_battery';

    /**
     * the column name for the device_time field
     */
    public const COL_DEVICE_TIME = 'expenses.device_time';

    /**
     * the column name for the settled_amount field
     */
    public const COL_SETTLED_AMOUNT = 'expenses.settled_amount';

    /**
     * the column name for the settled_date field
     */
    public const COL_SETTLED_DATE = 'expenses.settled_date';

    /**
     * the column name for the settled_desc field
     */
    public const COL_SETTLED_DESC = 'expenses.settled_desc';

    /**
     * the column name for the trip_type field
     */
    public const COL_TRIP_TYPE = 'expenses.trip_type';

    /**
     * the column name for the do_verify field
     */
    public const COL_DO_VERIFY = 'expenses.do_verify';

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
        self::TYPE_PHPNAME       => ['ExpId', 'CompanyId', 'ExpenseDate', 'BudgetId', 'ExpenseTrip', 'ExpensePlacewrk', 'ExpenseReqAmt', 'ExpenseApprovedAmt', 'ExpenseAdditionalAmt', 'ExpenseTaxAmt', 'ExpenseFinalAmt', 'ExpenseStatus', 'EmployeeId', 'ExpenseMode', 'ExpenseNote', 'OrgunitId', 'TripCurrency', 'Readflag', 'CreatedAt', 'UpdatedAt', 'Pin', 'DeviceName', 'DeviceBattery', 'DeviceTime', 'SettledAmount', 'SettledDate', 'SettledDesc', 'TripType', 'DoVerify', ],
        self::TYPE_CAMELNAME     => ['expId', 'companyId', 'expenseDate', 'budgetId', 'expenseTrip', 'expensePlacewrk', 'expenseReqAmt', 'expenseApprovedAmt', 'expenseAdditionalAmt', 'expenseTaxAmt', 'expenseFinalAmt', 'expenseStatus', 'employeeId', 'expenseMode', 'expenseNote', 'orgunitId', 'tripCurrency', 'readflag', 'createdAt', 'updatedAt', 'pin', 'deviceName', 'deviceBattery', 'deviceTime', 'settledAmount', 'settledDate', 'settledDesc', 'tripType', 'doVerify', ],
        self::TYPE_COLNAME       => [ExpensesTableMap::COL_EXP_ID, ExpensesTableMap::COL_COMPANY_ID, ExpensesTableMap::COL_EXPENSE_DATE, ExpensesTableMap::COL_BUDGET_ID, ExpensesTableMap::COL_EXPENSE_TRIP, ExpensesTableMap::COL_EXPENSE_PLACEWRK, ExpensesTableMap::COL_EXPENSE_REQ_AMT, ExpensesTableMap::COL_EXPENSE_APPROVED_AMT, ExpensesTableMap::COL_EXPENSE_ADDITIONAL_AMT, ExpensesTableMap::COL_EXPENSE_TAX_AMT, ExpensesTableMap::COL_EXPENSE_FINAL_AMT, ExpensesTableMap::COL_EXPENSE_STATUS, ExpensesTableMap::COL_EMPLOYEE_ID, ExpensesTableMap::COL_EXPENSE_MODE, ExpensesTableMap::COL_EXPENSE_NOTE, ExpensesTableMap::COL_ORGUNIT_ID, ExpensesTableMap::COL_TRIP_CURRENCY, ExpensesTableMap::COL_READFLAG, ExpensesTableMap::COL_CREATED_AT, ExpensesTableMap::COL_UPDATED_AT, ExpensesTableMap::COL_PIN, ExpensesTableMap::COL_DEVICE_NAME, ExpensesTableMap::COL_DEVICE_BATTERY, ExpensesTableMap::COL_DEVICE_TIME, ExpensesTableMap::COL_SETTLED_AMOUNT, ExpensesTableMap::COL_SETTLED_DATE, ExpensesTableMap::COL_SETTLED_DESC, ExpensesTableMap::COL_TRIP_TYPE, ExpensesTableMap::COL_DO_VERIFY, ],
        self::TYPE_FIELDNAME     => ['exp_id', 'company_id', 'expense_date', 'budget_id', 'expense_trip', 'expense_placewrk', 'expense_req_amt', 'expense_approved_amt', 'expense_additional_amt', 'expense_tax_amt', 'expense_final_amt', 'expense_status', 'employee_id', 'expense_mode', 'expense_note', 'orgunit_id', 'trip_currency', 'readflag', 'created_at', 'updated_at', 'pin', 'device_name', 'device_battery', 'device_time', 'settled_amount', 'settled_date', 'settled_desc', 'trip_type', 'do_verify', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, ]
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
        self::TYPE_PHPNAME       => ['ExpId' => 0, 'CompanyId' => 1, 'ExpenseDate' => 2, 'BudgetId' => 3, 'ExpenseTrip' => 4, 'ExpensePlacewrk' => 5, 'ExpenseReqAmt' => 6, 'ExpenseApprovedAmt' => 7, 'ExpenseAdditionalAmt' => 8, 'ExpenseTaxAmt' => 9, 'ExpenseFinalAmt' => 10, 'ExpenseStatus' => 11, 'EmployeeId' => 12, 'ExpenseMode' => 13, 'ExpenseNote' => 14, 'OrgunitId' => 15, 'TripCurrency' => 16, 'Readflag' => 17, 'CreatedAt' => 18, 'UpdatedAt' => 19, 'Pin' => 20, 'DeviceName' => 21, 'DeviceBattery' => 22, 'DeviceTime' => 23, 'SettledAmount' => 24, 'SettledDate' => 25, 'SettledDesc' => 26, 'TripType' => 27, 'DoVerify' => 28, ],
        self::TYPE_CAMELNAME     => ['expId' => 0, 'companyId' => 1, 'expenseDate' => 2, 'budgetId' => 3, 'expenseTrip' => 4, 'expensePlacewrk' => 5, 'expenseReqAmt' => 6, 'expenseApprovedAmt' => 7, 'expenseAdditionalAmt' => 8, 'expenseTaxAmt' => 9, 'expenseFinalAmt' => 10, 'expenseStatus' => 11, 'employeeId' => 12, 'expenseMode' => 13, 'expenseNote' => 14, 'orgunitId' => 15, 'tripCurrency' => 16, 'readflag' => 17, 'createdAt' => 18, 'updatedAt' => 19, 'pin' => 20, 'deviceName' => 21, 'deviceBattery' => 22, 'deviceTime' => 23, 'settledAmount' => 24, 'settledDate' => 25, 'settledDesc' => 26, 'tripType' => 27, 'doVerify' => 28, ],
        self::TYPE_COLNAME       => [ExpensesTableMap::COL_EXP_ID => 0, ExpensesTableMap::COL_COMPANY_ID => 1, ExpensesTableMap::COL_EXPENSE_DATE => 2, ExpensesTableMap::COL_BUDGET_ID => 3, ExpensesTableMap::COL_EXPENSE_TRIP => 4, ExpensesTableMap::COL_EXPENSE_PLACEWRK => 5, ExpensesTableMap::COL_EXPENSE_REQ_AMT => 6, ExpensesTableMap::COL_EXPENSE_APPROVED_AMT => 7, ExpensesTableMap::COL_EXPENSE_ADDITIONAL_AMT => 8, ExpensesTableMap::COL_EXPENSE_TAX_AMT => 9, ExpensesTableMap::COL_EXPENSE_FINAL_AMT => 10, ExpensesTableMap::COL_EXPENSE_STATUS => 11, ExpensesTableMap::COL_EMPLOYEE_ID => 12, ExpensesTableMap::COL_EXPENSE_MODE => 13, ExpensesTableMap::COL_EXPENSE_NOTE => 14, ExpensesTableMap::COL_ORGUNIT_ID => 15, ExpensesTableMap::COL_TRIP_CURRENCY => 16, ExpensesTableMap::COL_READFLAG => 17, ExpensesTableMap::COL_CREATED_AT => 18, ExpensesTableMap::COL_UPDATED_AT => 19, ExpensesTableMap::COL_PIN => 20, ExpensesTableMap::COL_DEVICE_NAME => 21, ExpensesTableMap::COL_DEVICE_BATTERY => 22, ExpensesTableMap::COL_DEVICE_TIME => 23, ExpensesTableMap::COL_SETTLED_AMOUNT => 24, ExpensesTableMap::COL_SETTLED_DATE => 25, ExpensesTableMap::COL_SETTLED_DESC => 26, ExpensesTableMap::COL_TRIP_TYPE => 27, ExpensesTableMap::COL_DO_VERIFY => 28, ],
        self::TYPE_FIELDNAME     => ['exp_id' => 0, 'company_id' => 1, 'expense_date' => 2, 'budget_id' => 3, 'expense_trip' => 4, 'expense_placewrk' => 5, 'expense_req_amt' => 6, 'expense_approved_amt' => 7, 'expense_additional_amt' => 8, 'expense_tax_amt' => 9, 'expense_final_amt' => 10, 'expense_status' => 11, 'employee_id' => 12, 'expense_mode' => 13, 'expense_note' => 14, 'orgunit_id' => 15, 'trip_currency' => 16, 'readflag' => 17, 'created_at' => 18, 'updated_at' => 19, 'pin' => 20, 'device_name' => 21, 'device_battery' => 22, 'device_time' => 23, 'settled_amount' => 24, 'settled_date' => 25, 'settled_desc' => 26, 'trip_type' => 27, 'do_verify' => 28, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'ExpId' => 'EXP_ID',
        'Expenses.ExpId' => 'EXP_ID',
        'expId' => 'EXP_ID',
        'expenses.expId' => 'EXP_ID',
        'ExpensesTableMap::COL_EXP_ID' => 'EXP_ID',
        'COL_EXP_ID' => 'EXP_ID',
        'exp_id' => 'EXP_ID',
        'expenses.exp_id' => 'EXP_ID',
        'CompanyId' => 'COMPANY_ID',
        'Expenses.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'expenses.companyId' => 'COMPANY_ID',
        'ExpensesTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'expenses.company_id' => 'COMPANY_ID',
        'ExpenseDate' => 'EXPENSE_DATE',
        'Expenses.ExpenseDate' => 'EXPENSE_DATE',
        'expenseDate' => 'EXPENSE_DATE',
        'expenses.expenseDate' => 'EXPENSE_DATE',
        'ExpensesTableMap::COL_EXPENSE_DATE' => 'EXPENSE_DATE',
        'COL_EXPENSE_DATE' => 'EXPENSE_DATE',
        'expense_date' => 'EXPENSE_DATE',
        'expenses.expense_date' => 'EXPENSE_DATE',
        'BudgetId' => 'BUDGET_ID',
        'Expenses.BudgetId' => 'BUDGET_ID',
        'budgetId' => 'BUDGET_ID',
        'expenses.budgetId' => 'BUDGET_ID',
        'ExpensesTableMap::COL_BUDGET_ID' => 'BUDGET_ID',
        'COL_BUDGET_ID' => 'BUDGET_ID',
        'budget_id' => 'BUDGET_ID',
        'expenses.budget_id' => 'BUDGET_ID',
        'ExpenseTrip' => 'EXPENSE_TRIP',
        'Expenses.ExpenseTrip' => 'EXPENSE_TRIP',
        'expenseTrip' => 'EXPENSE_TRIP',
        'expenses.expenseTrip' => 'EXPENSE_TRIP',
        'ExpensesTableMap::COL_EXPENSE_TRIP' => 'EXPENSE_TRIP',
        'COL_EXPENSE_TRIP' => 'EXPENSE_TRIP',
        'expense_trip' => 'EXPENSE_TRIP',
        'expenses.expense_trip' => 'EXPENSE_TRIP',
        'ExpensePlacewrk' => 'EXPENSE_PLACEWRK',
        'Expenses.ExpensePlacewrk' => 'EXPENSE_PLACEWRK',
        'expensePlacewrk' => 'EXPENSE_PLACEWRK',
        'expenses.expensePlacewrk' => 'EXPENSE_PLACEWRK',
        'ExpensesTableMap::COL_EXPENSE_PLACEWRK' => 'EXPENSE_PLACEWRK',
        'COL_EXPENSE_PLACEWRK' => 'EXPENSE_PLACEWRK',
        'expense_placewrk' => 'EXPENSE_PLACEWRK',
        'expenses.expense_placewrk' => 'EXPENSE_PLACEWRK',
        'ExpenseReqAmt' => 'EXPENSE_REQ_AMT',
        'Expenses.ExpenseReqAmt' => 'EXPENSE_REQ_AMT',
        'expenseReqAmt' => 'EXPENSE_REQ_AMT',
        'expenses.expenseReqAmt' => 'EXPENSE_REQ_AMT',
        'ExpensesTableMap::COL_EXPENSE_REQ_AMT' => 'EXPENSE_REQ_AMT',
        'COL_EXPENSE_REQ_AMT' => 'EXPENSE_REQ_AMT',
        'expense_req_amt' => 'EXPENSE_REQ_AMT',
        'expenses.expense_req_amt' => 'EXPENSE_REQ_AMT',
        'ExpenseApprovedAmt' => 'EXPENSE_APPROVED_AMT',
        'Expenses.ExpenseApprovedAmt' => 'EXPENSE_APPROVED_AMT',
        'expenseApprovedAmt' => 'EXPENSE_APPROVED_AMT',
        'expenses.expenseApprovedAmt' => 'EXPENSE_APPROVED_AMT',
        'ExpensesTableMap::COL_EXPENSE_APPROVED_AMT' => 'EXPENSE_APPROVED_AMT',
        'COL_EXPENSE_APPROVED_AMT' => 'EXPENSE_APPROVED_AMT',
        'expense_approved_amt' => 'EXPENSE_APPROVED_AMT',
        'expenses.expense_approved_amt' => 'EXPENSE_APPROVED_AMT',
        'ExpenseAdditionalAmt' => 'EXPENSE_ADDITIONAL_AMT',
        'Expenses.ExpenseAdditionalAmt' => 'EXPENSE_ADDITIONAL_AMT',
        'expenseAdditionalAmt' => 'EXPENSE_ADDITIONAL_AMT',
        'expenses.expenseAdditionalAmt' => 'EXPENSE_ADDITIONAL_AMT',
        'ExpensesTableMap::COL_EXPENSE_ADDITIONAL_AMT' => 'EXPENSE_ADDITIONAL_AMT',
        'COL_EXPENSE_ADDITIONAL_AMT' => 'EXPENSE_ADDITIONAL_AMT',
        'expense_additional_amt' => 'EXPENSE_ADDITIONAL_AMT',
        'expenses.expense_additional_amt' => 'EXPENSE_ADDITIONAL_AMT',
        'ExpenseTaxAmt' => 'EXPENSE_TAX_AMT',
        'Expenses.ExpenseTaxAmt' => 'EXPENSE_TAX_AMT',
        'expenseTaxAmt' => 'EXPENSE_TAX_AMT',
        'expenses.expenseTaxAmt' => 'EXPENSE_TAX_AMT',
        'ExpensesTableMap::COL_EXPENSE_TAX_AMT' => 'EXPENSE_TAX_AMT',
        'COL_EXPENSE_TAX_AMT' => 'EXPENSE_TAX_AMT',
        'expense_tax_amt' => 'EXPENSE_TAX_AMT',
        'expenses.expense_tax_amt' => 'EXPENSE_TAX_AMT',
        'ExpenseFinalAmt' => 'EXPENSE_FINAL_AMT',
        'Expenses.ExpenseFinalAmt' => 'EXPENSE_FINAL_AMT',
        'expenseFinalAmt' => 'EXPENSE_FINAL_AMT',
        'expenses.expenseFinalAmt' => 'EXPENSE_FINAL_AMT',
        'ExpensesTableMap::COL_EXPENSE_FINAL_AMT' => 'EXPENSE_FINAL_AMT',
        'COL_EXPENSE_FINAL_AMT' => 'EXPENSE_FINAL_AMT',
        'expense_final_amt' => 'EXPENSE_FINAL_AMT',
        'expenses.expense_final_amt' => 'EXPENSE_FINAL_AMT',
        'ExpenseStatus' => 'EXPENSE_STATUS',
        'Expenses.ExpenseStatus' => 'EXPENSE_STATUS',
        'expenseStatus' => 'EXPENSE_STATUS',
        'expenses.expenseStatus' => 'EXPENSE_STATUS',
        'ExpensesTableMap::COL_EXPENSE_STATUS' => 'EXPENSE_STATUS',
        'COL_EXPENSE_STATUS' => 'EXPENSE_STATUS',
        'expense_status' => 'EXPENSE_STATUS',
        'expenses.expense_status' => 'EXPENSE_STATUS',
        'EmployeeId' => 'EMPLOYEE_ID',
        'Expenses.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'expenses.employeeId' => 'EMPLOYEE_ID',
        'ExpensesTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'expenses.employee_id' => 'EMPLOYEE_ID',
        'ExpenseMode' => 'EXPENSE_MODE',
        'Expenses.ExpenseMode' => 'EXPENSE_MODE',
        'expenseMode' => 'EXPENSE_MODE',
        'expenses.expenseMode' => 'EXPENSE_MODE',
        'ExpensesTableMap::COL_EXPENSE_MODE' => 'EXPENSE_MODE',
        'COL_EXPENSE_MODE' => 'EXPENSE_MODE',
        'expense_mode' => 'EXPENSE_MODE',
        'expenses.expense_mode' => 'EXPENSE_MODE',
        'ExpenseNote' => 'EXPENSE_NOTE',
        'Expenses.ExpenseNote' => 'EXPENSE_NOTE',
        'expenseNote' => 'EXPENSE_NOTE',
        'expenses.expenseNote' => 'EXPENSE_NOTE',
        'ExpensesTableMap::COL_EXPENSE_NOTE' => 'EXPENSE_NOTE',
        'COL_EXPENSE_NOTE' => 'EXPENSE_NOTE',
        'expense_note' => 'EXPENSE_NOTE',
        'expenses.expense_note' => 'EXPENSE_NOTE',
        'OrgunitId' => 'ORGUNIT_ID',
        'Expenses.OrgunitId' => 'ORGUNIT_ID',
        'orgunitId' => 'ORGUNIT_ID',
        'expenses.orgunitId' => 'ORGUNIT_ID',
        'ExpensesTableMap::COL_ORGUNIT_ID' => 'ORGUNIT_ID',
        'COL_ORGUNIT_ID' => 'ORGUNIT_ID',
        'orgunit_id' => 'ORGUNIT_ID',
        'expenses.orgunit_id' => 'ORGUNIT_ID',
        'TripCurrency' => 'TRIP_CURRENCY',
        'Expenses.TripCurrency' => 'TRIP_CURRENCY',
        'tripCurrency' => 'TRIP_CURRENCY',
        'expenses.tripCurrency' => 'TRIP_CURRENCY',
        'ExpensesTableMap::COL_TRIP_CURRENCY' => 'TRIP_CURRENCY',
        'COL_TRIP_CURRENCY' => 'TRIP_CURRENCY',
        'trip_currency' => 'TRIP_CURRENCY',
        'expenses.trip_currency' => 'TRIP_CURRENCY',
        'Readflag' => 'READFLAG',
        'Expenses.Readflag' => 'READFLAG',
        'readflag' => 'READFLAG',
        'expenses.readflag' => 'READFLAG',
        'ExpensesTableMap::COL_READFLAG' => 'READFLAG',
        'COL_READFLAG' => 'READFLAG',
        'CreatedAt' => 'CREATED_AT',
        'Expenses.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'expenses.createdAt' => 'CREATED_AT',
        'ExpensesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'expenses.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Expenses.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'expenses.updatedAt' => 'UPDATED_AT',
        'ExpensesTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'expenses.updated_at' => 'UPDATED_AT',
        'Pin' => 'PIN',
        'Expenses.Pin' => 'PIN',
        'pin' => 'PIN',
        'expenses.pin' => 'PIN',
        'ExpensesTableMap::COL_PIN' => 'PIN',
        'COL_PIN' => 'PIN',
        'DeviceName' => 'DEVICE_NAME',
        'Expenses.DeviceName' => 'DEVICE_NAME',
        'deviceName' => 'DEVICE_NAME',
        'expenses.deviceName' => 'DEVICE_NAME',
        'ExpensesTableMap::COL_DEVICE_NAME' => 'DEVICE_NAME',
        'COL_DEVICE_NAME' => 'DEVICE_NAME',
        'device_name' => 'DEVICE_NAME',
        'expenses.device_name' => 'DEVICE_NAME',
        'DeviceBattery' => 'DEVICE_BATTERY',
        'Expenses.DeviceBattery' => 'DEVICE_BATTERY',
        'deviceBattery' => 'DEVICE_BATTERY',
        'expenses.deviceBattery' => 'DEVICE_BATTERY',
        'ExpensesTableMap::COL_DEVICE_BATTERY' => 'DEVICE_BATTERY',
        'COL_DEVICE_BATTERY' => 'DEVICE_BATTERY',
        'device_battery' => 'DEVICE_BATTERY',
        'expenses.device_battery' => 'DEVICE_BATTERY',
        'DeviceTime' => 'DEVICE_TIME',
        'Expenses.DeviceTime' => 'DEVICE_TIME',
        'deviceTime' => 'DEVICE_TIME',
        'expenses.deviceTime' => 'DEVICE_TIME',
        'ExpensesTableMap::COL_DEVICE_TIME' => 'DEVICE_TIME',
        'COL_DEVICE_TIME' => 'DEVICE_TIME',
        'device_time' => 'DEVICE_TIME',
        'expenses.device_time' => 'DEVICE_TIME',
        'SettledAmount' => 'SETTLED_AMOUNT',
        'Expenses.SettledAmount' => 'SETTLED_AMOUNT',
        'settledAmount' => 'SETTLED_AMOUNT',
        'expenses.settledAmount' => 'SETTLED_AMOUNT',
        'ExpensesTableMap::COL_SETTLED_AMOUNT' => 'SETTLED_AMOUNT',
        'COL_SETTLED_AMOUNT' => 'SETTLED_AMOUNT',
        'settled_amount' => 'SETTLED_AMOUNT',
        'expenses.settled_amount' => 'SETTLED_AMOUNT',
        'SettledDate' => 'SETTLED_DATE',
        'Expenses.SettledDate' => 'SETTLED_DATE',
        'settledDate' => 'SETTLED_DATE',
        'expenses.settledDate' => 'SETTLED_DATE',
        'ExpensesTableMap::COL_SETTLED_DATE' => 'SETTLED_DATE',
        'COL_SETTLED_DATE' => 'SETTLED_DATE',
        'settled_date' => 'SETTLED_DATE',
        'expenses.settled_date' => 'SETTLED_DATE',
        'SettledDesc' => 'SETTLED_DESC',
        'Expenses.SettledDesc' => 'SETTLED_DESC',
        'settledDesc' => 'SETTLED_DESC',
        'expenses.settledDesc' => 'SETTLED_DESC',
        'ExpensesTableMap::COL_SETTLED_DESC' => 'SETTLED_DESC',
        'COL_SETTLED_DESC' => 'SETTLED_DESC',
        'settled_desc' => 'SETTLED_DESC',
        'expenses.settled_desc' => 'SETTLED_DESC',
        'TripType' => 'TRIP_TYPE',
        'Expenses.TripType' => 'TRIP_TYPE',
        'tripType' => 'TRIP_TYPE',
        'expenses.tripType' => 'TRIP_TYPE',
        'ExpensesTableMap::COL_TRIP_TYPE' => 'TRIP_TYPE',
        'COL_TRIP_TYPE' => 'TRIP_TYPE',
        'trip_type' => 'TRIP_TYPE',
        'expenses.trip_type' => 'TRIP_TYPE',
        'DoVerify' => 'DO_VERIFY',
        'Expenses.DoVerify' => 'DO_VERIFY',
        'doVerify' => 'DO_VERIFY',
        'expenses.doVerify' => 'DO_VERIFY',
        'ExpensesTableMap::COL_DO_VERIFY' => 'DO_VERIFY',
        'COL_DO_VERIFY' => 'DO_VERIFY',
        'do_verify' => 'DO_VERIFY',
        'expenses.do_verify' => 'DO_VERIFY',
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
        $this->setName('expenses');
        $this->setPhpName('Expenses');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Expenses');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('expenses_exp_id_seq');
        // columns
        $this->addPrimaryKey('exp_id', 'ExpId', 'INTEGER', true, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, 0);
        $this->addColumn('expense_date', 'ExpenseDate', 'DATE', true, null, null);
        $this->addForeignKey('budget_id', 'BudgetId', 'INTEGER', 'budget_group', 'bgid', true, null, null);
        $this->addColumn('expense_trip', 'ExpenseTrip', 'INTEGER', true, null, null);
        $this->addColumn('expense_placewrk', 'ExpensePlacewrk', 'LONGVARCHAR', true, null, null);
        $this->addColumn('expense_req_amt', 'ExpenseReqAmt', 'DECIMAL', true, 10, null);
        $this->addColumn('expense_approved_amt', 'ExpenseApprovedAmt', 'DECIMAL', false, 10, null);
        $this->addColumn('expense_additional_amt', 'ExpenseAdditionalAmt', 'DECIMAL', false, 10, null);
        $this->addColumn('expense_tax_amt', 'ExpenseTaxAmt', 'DECIMAL', false, 10, null);
        $this->addColumn('expense_final_amt', 'ExpenseFinalAmt', 'DECIMAL', false, 10, null);
        $this->addColumn('expense_status', 'ExpenseStatus', 'INTEGER', true, null, null);
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', true, null, null);
        $this->addColumn('expense_mode', 'ExpenseMode', 'INTEGER', false, null, null);
        $this->addColumn('expense_note', 'ExpenseNote', 'LONGVARCHAR', false, null, null);
        $this->addForeignKey('orgunit_id', 'OrgunitId', 'INTEGER', 'org_unit', 'orgunitid', true, null, 1);
        $this->addForeignKey('trip_currency', 'TripCurrency', 'INTEGER', 'currencies', 'currency_id', true, null, 1);
        $this->addColumn('readflag', 'Readflag', 'INTEGER', true, null, 0);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('pin', 'Pin', 'VARCHAR', false, 250, null);
        $this->addColumn('device_name', 'DeviceName', 'VARCHAR', false, 250, null);
        $this->addColumn('device_battery', 'DeviceBattery', 'VARCHAR', false, 250, null);
        $this->addColumn('device_time', 'DeviceTime', 'VARCHAR', false, 250, null);
        $this->addColumn('settled_amount', 'SettledAmount', 'DECIMAL', false, 10, null);
        $this->addColumn('settled_date', 'SettledDate', 'TIMESTAMP', false, null, null);
        $this->addColumn('settled_desc', 'SettledDesc', 'LONGVARCHAR', false, null, null);
        $this->addColumn('trip_type', 'TripType', 'VARCHAR', false, null, null);
        $this->addColumn('do_verify', 'DoVerify', 'BOOLEAN', false, 1, false);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('BudgetGroup', '\\entities\\BudgetGroup', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':budget_id',
    1 => ':bgid',
  ),
), null, null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('Currencies', '\\entities\\Currencies', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':trip_currency',
    1 => ':currency_id',
  ),
), null, null, null, false);
        $this->addRelation('Employee', '\\entities\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, null, false);
        $this->addRelation('OrgUnit', '\\entities\\OrgUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':orgunit_id',
    1 => ':orgunitid',
  ),
), null, null, null, false);
        $this->addRelation('Attendance', '\\entities\\Attendance', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':expense_id',
    1 => ':exp_id',
  ),
), null, null, 'Attendances', false);
        $this->addRelation('EmployeeWorkLog', '\\entities\\EmployeeWorkLog', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':exp_id',
    1 => ':exp_id',
  ),
), 'CASCADE', null, 'EmployeeWorkLogs', false);
        $this->addRelation('ExpenseFiles', '\\entities\\ExpenseFiles', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':exp_id',
    1 => ':exp_id',
  ),
), null, null, 'ExpenseFiless', false);
        $this->addRelation('ExpenseList', '\\entities\\ExpenseList', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':exp_id',
    1 => ':exp_id',
  ),
), null, null, 'ExpenseLists', false);
    }

    /**
     * Method to invalidate the instance pool of all tables related to expenses     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        EmployeeWorkLogTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('ExpId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ExpensesTableMap::CLASS_DEFAULT : ExpensesTableMap::OM_CLASS;
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
     * @return array (Expenses object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ExpensesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ExpensesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ExpensesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ExpensesTableMap::OM_CLASS;
            /** @var Expenses $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ExpensesTableMap::addInstanceToPool($obj, $key);
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
            $key = ExpensesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ExpensesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Expenses $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ExpensesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ExpensesTableMap::COL_EXP_ID);
            $criteria->addSelectColumn(ExpensesTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(ExpensesTableMap::COL_EXPENSE_DATE);
            $criteria->addSelectColumn(ExpensesTableMap::COL_BUDGET_ID);
            $criteria->addSelectColumn(ExpensesTableMap::COL_EXPENSE_TRIP);
            $criteria->addSelectColumn(ExpensesTableMap::COL_EXPENSE_PLACEWRK);
            $criteria->addSelectColumn(ExpensesTableMap::COL_EXPENSE_REQ_AMT);
            $criteria->addSelectColumn(ExpensesTableMap::COL_EXPENSE_APPROVED_AMT);
            $criteria->addSelectColumn(ExpensesTableMap::COL_EXPENSE_ADDITIONAL_AMT);
            $criteria->addSelectColumn(ExpensesTableMap::COL_EXPENSE_TAX_AMT);
            $criteria->addSelectColumn(ExpensesTableMap::COL_EXPENSE_FINAL_AMT);
            $criteria->addSelectColumn(ExpensesTableMap::COL_EXPENSE_STATUS);
            $criteria->addSelectColumn(ExpensesTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(ExpensesTableMap::COL_EXPENSE_MODE);
            $criteria->addSelectColumn(ExpensesTableMap::COL_EXPENSE_NOTE);
            $criteria->addSelectColumn(ExpensesTableMap::COL_ORGUNIT_ID);
            $criteria->addSelectColumn(ExpensesTableMap::COL_TRIP_CURRENCY);
            $criteria->addSelectColumn(ExpensesTableMap::COL_READFLAG);
            $criteria->addSelectColumn(ExpensesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(ExpensesTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(ExpensesTableMap::COL_PIN);
            $criteria->addSelectColumn(ExpensesTableMap::COL_DEVICE_NAME);
            $criteria->addSelectColumn(ExpensesTableMap::COL_DEVICE_BATTERY);
            $criteria->addSelectColumn(ExpensesTableMap::COL_DEVICE_TIME);
            $criteria->addSelectColumn(ExpensesTableMap::COL_SETTLED_AMOUNT);
            $criteria->addSelectColumn(ExpensesTableMap::COL_SETTLED_DATE);
            $criteria->addSelectColumn(ExpensesTableMap::COL_SETTLED_DESC);
            $criteria->addSelectColumn(ExpensesTableMap::COL_TRIP_TYPE);
            $criteria->addSelectColumn(ExpensesTableMap::COL_DO_VERIFY);
        } else {
            $criteria->addSelectColumn($alias . '.exp_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.expense_date');
            $criteria->addSelectColumn($alias . '.budget_id');
            $criteria->addSelectColumn($alias . '.expense_trip');
            $criteria->addSelectColumn($alias . '.expense_placewrk');
            $criteria->addSelectColumn($alias . '.expense_req_amt');
            $criteria->addSelectColumn($alias . '.expense_approved_amt');
            $criteria->addSelectColumn($alias . '.expense_additional_amt');
            $criteria->addSelectColumn($alias . '.expense_tax_amt');
            $criteria->addSelectColumn($alias . '.expense_final_amt');
            $criteria->addSelectColumn($alias . '.expense_status');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.expense_mode');
            $criteria->addSelectColumn($alias . '.expense_note');
            $criteria->addSelectColumn($alias . '.orgunit_id');
            $criteria->addSelectColumn($alias . '.trip_currency');
            $criteria->addSelectColumn($alias . '.readflag');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.pin');
            $criteria->addSelectColumn($alias . '.device_name');
            $criteria->addSelectColumn($alias . '.device_battery');
            $criteria->addSelectColumn($alias . '.device_time');
            $criteria->addSelectColumn($alias . '.settled_amount');
            $criteria->addSelectColumn($alias . '.settled_date');
            $criteria->addSelectColumn($alias . '.settled_desc');
            $criteria->addSelectColumn($alias . '.trip_type');
            $criteria->addSelectColumn($alias . '.do_verify');
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
            $criteria->removeSelectColumn(ExpensesTableMap::COL_EXP_ID);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_EXPENSE_DATE);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_BUDGET_ID);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_EXPENSE_TRIP);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_EXPENSE_PLACEWRK);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_EXPENSE_REQ_AMT);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_EXPENSE_APPROVED_AMT);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_EXPENSE_ADDITIONAL_AMT);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_EXPENSE_TAX_AMT);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_EXPENSE_FINAL_AMT);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_EXPENSE_STATUS);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_EXPENSE_MODE);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_EXPENSE_NOTE);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_ORGUNIT_ID);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_TRIP_CURRENCY);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_READFLAG);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_PIN);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_DEVICE_NAME);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_DEVICE_BATTERY);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_DEVICE_TIME);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_SETTLED_AMOUNT);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_SETTLED_DATE);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_SETTLED_DESC);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_TRIP_TYPE);
            $criteria->removeSelectColumn(ExpensesTableMap::COL_DO_VERIFY);
        } else {
            $criteria->removeSelectColumn($alias . '.exp_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.expense_date');
            $criteria->removeSelectColumn($alias . '.budget_id');
            $criteria->removeSelectColumn($alias . '.expense_trip');
            $criteria->removeSelectColumn($alias . '.expense_placewrk');
            $criteria->removeSelectColumn($alias . '.expense_req_amt');
            $criteria->removeSelectColumn($alias . '.expense_approved_amt');
            $criteria->removeSelectColumn($alias . '.expense_additional_amt');
            $criteria->removeSelectColumn($alias . '.expense_tax_amt');
            $criteria->removeSelectColumn($alias . '.expense_final_amt');
            $criteria->removeSelectColumn($alias . '.expense_status');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.expense_mode');
            $criteria->removeSelectColumn($alias . '.expense_note');
            $criteria->removeSelectColumn($alias . '.orgunit_id');
            $criteria->removeSelectColumn($alias . '.trip_currency');
            $criteria->removeSelectColumn($alias . '.readflag');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.pin');
            $criteria->removeSelectColumn($alias . '.device_name');
            $criteria->removeSelectColumn($alias . '.device_battery');
            $criteria->removeSelectColumn($alias . '.device_time');
            $criteria->removeSelectColumn($alias . '.settled_amount');
            $criteria->removeSelectColumn($alias . '.settled_date');
            $criteria->removeSelectColumn($alias . '.settled_desc');
            $criteria->removeSelectColumn($alias . '.trip_type');
            $criteria->removeSelectColumn($alias . '.do_verify');
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
        return Propel::getServiceContainer()->getDatabaseMap(ExpensesTableMap::DATABASE_NAME)->getTable(ExpensesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Expenses or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Expenses object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ExpensesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Expenses) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ExpensesTableMap::DATABASE_NAME);
            $criteria->add(ExpensesTableMap::COL_EXP_ID, (array) $values, Criteria::IN);
        }

        $query = ExpensesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ExpensesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ExpensesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the expenses table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ExpensesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Expenses or Criteria object.
     *
     * @param mixed $criteria Criteria or Expenses object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpensesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Expenses object
        }

        if ($criteria->containsKey(ExpensesTableMap::COL_EXP_ID) && $criteria->keyContainsValue(ExpensesTableMap::COL_EXP_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ExpensesTableMap::COL_EXP_ID.')');
        }


        // Set the correct dbName
        $query = ExpensesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
