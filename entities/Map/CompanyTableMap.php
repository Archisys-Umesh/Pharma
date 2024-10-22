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
use entities\Company;
use entities\CompanyQuery;


/**
 * This class defines the structure of the 'company' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class CompanyTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.CompanyTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'company';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Company';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Company';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Company';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 28;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 28;

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'company.company_id';

    /**
     * the column name for the company_code field
     */
    public const COL_COMPANY_CODE = 'company.company_code';

    /**
     * the column name for the company_name field
     */
    public const COL_COMPANY_NAME = 'company.company_name';

    /**
     * the column name for the owner_name field
     */
    public const COL_OWNER_NAME = 'company.owner_name';

    /**
     * the column name for the company_phone_number field
     */
    public const COL_COMPANY_PHONE_NUMBER = 'company.company_phone_number';

    /**
     * the column name for the company_contact_number field
     */
    public const COL_COMPANY_CONTACT_NUMBER = 'company.company_contact_number';

    /**
     * the column name for the company_logo field
     */
    public const COL_COMPANY_LOGO = 'company.company_logo';

    /**
     * the column name for the company_address_1 field
     */
    public const COL_COMPANY_ADDRESS_1 = 'company.company_address_1';

    /**
     * the column name for the company_address_2 field
     */
    public const COL_COMPANY_ADDRESS_2 = 'company.company_address_2';

    /**
     * the column name for the company_default_currency field
     */
    public const COL_COMPANY_DEFAULT_CURRENCY = 'company.company_default_currency';

    /**
     * the column name for the timezone field
     */
    public const COL_TIMEZONE = 'company.timezone';

    /**
     * the column name for the company_first_setup field
     */
    public const COL_COMPANY_FIRST_SETUP = 'company.company_first_setup';

    /**
     * the column name for the owner_email field
     */
    public const COL_OWNER_EMAIL = 'company.owner_email';

    /**
     * the column name for the expense_reminder field
     */
    public const COL_EXPENSE_REMINDER = 'company.expense_reminder';

    /**
     * the column name for the currentmonthsubmit field
     */
    public const COL_CURRENTMONTHSUBMIT = 'company.currentmonthsubmit';

    /**
     * the column name for the tripapprovalreq field
     */
    public const COL_TRIPAPPROVALREQ = 'company.tripapprovalreq';

    /**
     * the column name for the expenseonlyontrip field
     */
    public const COL_EXPENSEONLYONTRIP = 'company.expenseonlyontrip';

    /**
     * the column name for the allowbackdatedtrip field
     */
    public const COL_ALLOWBACKDATEDTRIP = 'company.allowbackdatedtrip';

    /**
     * the column name for the paymentsystem field
     */
    public const COL_PAYMENTSYSTEM = 'company.paymentsystem';

    /**
     * the column name for the auto_settle field
     */
    public const COL_AUTO_SETTLE = 'company.auto_settle';

    /**
     * the column name for the allowradius field
     */
    public const COL_ALLOWRADIUS = 'company.allowradius';

    /**
     * the column name for the order_seq field
     */
    public const COL_ORDER_SEQ = 'company.order_seq';

    /**
     * the column name for the shippingorder_seq field
     */
    public const COL_SHIPPINGORDER_SEQ = 'company.shippingorder_seq';

    /**
     * the column name for the googlemapkey field
     */
    public const COL_GOOGLEMAPKEY = 'company.googlemapkey';

    /**
     * the column name for the workingdaysinweek field
     */
    public const COL_WORKINGDAYSINWEEK = 'company.workingdaysinweek';

    /**
     * the column name for the auto_calculated_ta field
     */
    public const COL_AUTO_CALCULATED_TA = 'company.auto_calculated_ta';

    /**
     * the column name for the reporting_days field
     */
    public const COL_REPORTING_DAYS = 'company.reporting_days';

    /**
     * the column name for the expense_months field
     */
    public const COL_EXPENSE_MONTHS = 'company.expense_months';

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
        self::TYPE_PHPNAME       => ['CompanyId', 'CompanyCode', 'CompanyName', 'OwnerName', 'CompanyPhoneNumber', 'CompanyContactNumber', 'CompanyLogo', 'CompanyAddress1', 'CompanyAddress2', 'CompanyDefaultCurrency', 'Timezone', 'CompanyFirstSetup', 'OwnerEmail', 'ExpenseReminder', 'Currentmonthsubmit', 'Tripapprovalreq', 'Expenseonlyontrip', 'Allowbackdatedtrip', 'Paymentsystem', 'AutoSettle', 'Allowradius', 'OrderSeq', 'ShippingorderSeq', 'Googlemapkey', 'Workingdaysinweek', 'AutoCalculatedTa', 'ReportingDays', 'ExpenseMonths', ],
        self::TYPE_CAMELNAME     => ['companyId', 'companyCode', 'companyName', 'ownerName', 'companyPhoneNumber', 'companyContactNumber', 'companyLogo', 'companyAddress1', 'companyAddress2', 'companyDefaultCurrency', 'timezone', 'companyFirstSetup', 'ownerEmail', 'expenseReminder', 'currentmonthsubmit', 'tripapprovalreq', 'expenseonlyontrip', 'allowbackdatedtrip', 'paymentsystem', 'autoSettle', 'allowradius', 'orderSeq', 'shippingorderSeq', 'googlemapkey', 'workingdaysinweek', 'autoCalculatedTa', 'reportingDays', 'expenseMonths', ],
        self::TYPE_COLNAME       => [CompanyTableMap::COL_COMPANY_ID, CompanyTableMap::COL_COMPANY_CODE, CompanyTableMap::COL_COMPANY_NAME, CompanyTableMap::COL_OWNER_NAME, CompanyTableMap::COL_COMPANY_PHONE_NUMBER, CompanyTableMap::COL_COMPANY_CONTACT_NUMBER, CompanyTableMap::COL_COMPANY_LOGO, CompanyTableMap::COL_COMPANY_ADDRESS_1, CompanyTableMap::COL_COMPANY_ADDRESS_2, CompanyTableMap::COL_COMPANY_DEFAULT_CURRENCY, CompanyTableMap::COL_TIMEZONE, CompanyTableMap::COL_COMPANY_FIRST_SETUP, CompanyTableMap::COL_OWNER_EMAIL, CompanyTableMap::COL_EXPENSE_REMINDER, CompanyTableMap::COL_CURRENTMONTHSUBMIT, CompanyTableMap::COL_TRIPAPPROVALREQ, CompanyTableMap::COL_EXPENSEONLYONTRIP, CompanyTableMap::COL_ALLOWBACKDATEDTRIP, CompanyTableMap::COL_PAYMENTSYSTEM, CompanyTableMap::COL_AUTO_SETTLE, CompanyTableMap::COL_ALLOWRADIUS, CompanyTableMap::COL_ORDER_SEQ, CompanyTableMap::COL_SHIPPINGORDER_SEQ, CompanyTableMap::COL_GOOGLEMAPKEY, CompanyTableMap::COL_WORKINGDAYSINWEEK, CompanyTableMap::COL_AUTO_CALCULATED_TA, CompanyTableMap::COL_REPORTING_DAYS, CompanyTableMap::COL_EXPENSE_MONTHS, ],
        self::TYPE_FIELDNAME     => ['company_id', 'company_code', 'company_name', 'owner_name', 'company_phone_number', 'company_contact_number', 'company_logo', 'company_address_1', 'company_address_2', 'company_default_currency', 'timezone', 'company_first_setup', 'owner_email', 'expense_reminder', 'currentmonthsubmit', 'tripapprovalreq', 'expenseonlyontrip', 'allowbackdatedtrip', 'paymentsystem', 'auto_settle', 'allowradius', 'order_seq', 'shippingorder_seq', 'googlemapkey', 'workingdaysinweek', 'auto_calculated_ta', 'reporting_days', 'expense_months', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, ]
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
        self::TYPE_PHPNAME       => ['CompanyId' => 0, 'CompanyCode' => 1, 'CompanyName' => 2, 'OwnerName' => 3, 'CompanyPhoneNumber' => 4, 'CompanyContactNumber' => 5, 'CompanyLogo' => 6, 'CompanyAddress1' => 7, 'CompanyAddress2' => 8, 'CompanyDefaultCurrency' => 9, 'Timezone' => 10, 'CompanyFirstSetup' => 11, 'OwnerEmail' => 12, 'ExpenseReminder' => 13, 'Currentmonthsubmit' => 14, 'Tripapprovalreq' => 15, 'Expenseonlyontrip' => 16, 'Allowbackdatedtrip' => 17, 'Paymentsystem' => 18, 'AutoSettle' => 19, 'Allowradius' => 20, 'OrderSeq' => 21, 'ShippingorderSeq' => 22, 'Googlemapkey' => 23, 'Workingdaysinweek' => 24, 'AutoCalculatedTa' => 25, 'ReportingDays' => 26, 'ExpenseMonths' => 27, ],
        self::TYPE_CAMELNAME     => ['companyId' => 0, 'companyCode' => 1, 'companyName' => 2, 'ownerName' => 3, 'companyPhoneNumber' => 4, 'companyContactNumber' => 5, 'companyLogo' => 6, 'companyAddress1' => 7, 'companyAddress2' => 8, 'companyDefaultCurrency' => 9, 'timezone' => 10, 'companyFirstSetup' => 11, 'ownerEmail' => 12, 'expenseReminder' => 13, 'currentmonthsubmit' => 14, 'tripapprovalreq' => 15, 'expenseonlyontrip' => 16, 'allowbackdatedtrip' => 17, 'paymentsystem' => 18, 'autoSettle' => 19, 'allowradius' => 20, 'orderSeq' => 21, 'shippingorderSeq' => 22, 'googlemapkey' => 23, 'workingdaysinweek' => 24, 'autoCalculatedTa' => 25, 'reportingDays' => 26, 'expenseMonths' => 27, ],
        self::TYPE_COLNAME       => [CompanyTableMap::COL_COMPANY_ID => 0, CompanyTableMap::COL_COMPANY_CODE => 1, CompanyTableMap::COL_COMPANY_NAME => 2, CompanyTableMap::COL_OWNER_NAME => 3, CompanyTableMap::COL_COMPANY_PHONE_NUMBER => 4, CompanyTableMap::COL_COMPANY_CONTACT_NUMBER => 5, CompanyTableMap::COL_COMPANY_LOGO => 6, CompanyTableMap::COL_COMPANY_ADDRESS_1 => 7, CompanyTableMap::COL_COMPANY_ADDRESS_2 => 8, CompanyTableMap::COL_COMPANY_DEFAULT_CURRENCY => 9, CompanyTableMap::COL_TIMEZONE => 10, CompanyTableMap::COL_COMPANY_FIRST_SETUP => 11, CompanyTableMap::COL_OWNER_EMAIL => 12, CompanyTableMap::COL_EXPENSE_REMINDER => 13, CompanyTableMap::COL_CURRENTMONTHSUBMIT => 14, CompanyTableMap::COL_TRIPAPPROVALREQ => 15, CompanyTableMap::COL_EXPENSEONLYONTRIP => 16, CompanyTableMap::COL_ALLOWBACKDATEDTRIP => 17, CompanyTableMap::COL_PAYMENTSYSTEM => 18, CompanyTableMap::COL_AUTO_SETTLE => 19, CompanyTableMap::COL_ALLOWRADIUS => 20, CompanyTableMap::COL_ORDER_SEQ => 21, CompanyTableMap::COL_SHIPPINGORDER_SEQ => 22, CompanyTableMap::COL_GOOGLEMAPKEY => 23, CompanyTableMap::COL_WORKINGDAYSINWEEK => 24, CompanyTableMap::COL_AUTO_CALCULATED_TA => 25, CompanyTableMap::COL_REPORTING_DAYS => 26, CompanyTableMap::COL_EXPENSE_MONTHS => 27, ],
        self::TYPE_FIELDNAME     => ['company_id' => 0, 'company_code' => 1, 'company_name' => 2, 'owner_name' => 3, 'company_phone_number' => 4, 'company_contact_number' => 5, 'company_logo' => 6, 'company_address_1' => 7, 'company_address_2' => 8, 'company_default_currency' => 9, 'timezone' => 10, 'company_first_setup' => 11, 'owner_email' => 12, 'expense_reminder' => 13, 'currentmonthsubmit' => 14, 'tripapprovalreq' => 15, 'expenseonlyontrip' => 16, 'allowbackdatedtrip' => 17, 'paymentsystem' => 18, 'auto_settle' => 19, 'allowradius' => 20, 'order_seq' => 21, 'shippingorder_seq' => 22, 'googlemapkey' => 23, 'workingdaysinweek' => 24, 'auto_calculated_ta' => 25, 'reporting_days' => 26, 'expense_months' => 27, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'CompanyId' => 'COMPANY_ID',
        'Company.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'company.companyId' => 'COMPANY_ID',
        'CompanyTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'company.company_id' => 'COMPANY_ID',
        'CompanyCode' => 'COMPANY_CODE',
        'Company.CompanyCode' => 'COMPANY_CODE',
        'companyCode' => 'COMPANY_CODE',
        'company.companyCode' => 'COMPANY_CODE',
        'CompanyTableMap::COL_COMPANY_CODE' => 'COMPANY_CODE',
        'COL_COMPANY_CODE' => 'COMPANY_CODE',
        'company_code' => 'COMPANY_CODE',
        'company.company_code' => 'COMPANY_CODE',
        'CompanyName' => 'COMPANY_NAME',
        'Company.CompanyName' => 'COMPANY_NAME',
        'companyName' => 'COMPANY_NAME',
        'company.companyName' => 'COMPANY_NAME',
        'CompanyTableMap::COL_COMPANY_NAME' => 'COMPANY_NAME',
        'COL_COMPANY_NAME' => 'COMPANY_NAME',
        'company_name' => 'COMPANY_NAME',
        'company.company_name' => 'COMPANY_NAME',
        'OwnerName' => 'OWNER_NAME',
        'Company.OwnerName' => 'OWNER_NAME',
        'ownerName' => 'OWNER_NAME',
        'company.ownerName' => 'OWNER_NAME',
        'CompanyTableMap::COL_OWNER_NAME' => 'OWNER_NAME',
        'COL_OWNER_NAME' => 'OWNER_NAME',
        'owner_name' => 'OWNER_NAME',
        'company.owner_name' => 'OWNER_NAME',
        'CompanyPhoneNumber' => 'COMPANY_PHONE_NUMBER',
        'Company.CompanyPhoneNumber' => 'COMPANY_PHONE_NUMBER',
        'companyPhoneNumber' => 'COMPANY_PHONE_NUMBER',
        'company.companyPhoneNumber' => 'COMPANY_PHONE_NUMBER',
        'CompanyTableMap::COL_COMPANY_PHONE_NUMBER' => 'COMPANY_PHONE_NUMBER',
        'COL_COMPANY_PHONE_NUMBER' => 'COMPANY_PHONE_NUMBER',
        'company_phone_number' => 'COMPANY_PHONE_NUMBER',
        'company.company_phone_number' => 'COMPANY_PHONE_NUMBER',
        'CompanyContactNumber' => 'COMPANY_CONTACT_NUMBER',
        'Company.CompanyContactNumber' => 'COMPANY_CONTACT_NUMBER',
        'companyContactNumber' => 'COMPANY_CONTACT_NUMBER',
        'company.companyContactNumber' => 'COMPANY_CONTACT_NUMBER',
        'CompanyTableMap::COL_COMPANY_CONTACT_NUMBER' => 'COMPANY_CONTACT_NUMBER',
        'COL_COMPANY_CONTACT_NUMBER' => 'COMPANY_CONTACT_NUMBER',
        'company_contact_number' => 'COMPANY_CONTACT_NUMBER',
        'company.company_contact_number' => 'COMPANY_CONTACT_NUMBER',
        'CompanyLogo' => 'COMPANY_LOGO',
        'Company.CompanyLogo' => 'COMPANY_LOGO',
        'companyLogo' => 'COMPANY_LOGO',
        'company.companyLogo' => 'COMPANY_LOGO',
        'CompanyTableMap::COL_COMPANY_LOGO' => 'COMPANY_LOGO',
        'COL_COMPANY_LOGO' => 'COMPANY_LOGO',
        'company_logo' => 'COMPANY_LOGO',
        'company.company_logo' => 'COMPANY_LOGO',
        'CompanyAddress1' => 'COMPANY_ADDRESS_1',
        'Company.CompanyAddress1' => 'COMPANY_ADDRESS_1',
        'companyAddress1' => 'COMPANY_ADDRESS_1',
        'company.companyAddress1' => 'COMPANY_ADDRESS_1',
        'CompanyTableMap::COL_COMPANY_ADDRESS_1' => 'COMPANY_ADDRESS_1',
        'COL_COMPANY_ADDRESS_1' => 'COMPANY_ADDRESS_1',
        'company_address_1' => 'COMPANY_ADDRESS_1',
        'company.company_address_1' => 'COMPANY_ADDRESS_1',
        'CompanyAddress2' => 'COMPANY_ADDRESS_2',
        'Company.CompanyAddress2' => 'COMPANY_ADDRESS_2',
        'companyAddress2' => 'COMPANY_ADDRESS_2',
        'company.companyAddress2' => 'COMPANY_ADDRESS_2',
        'CompanyTableMap::COL_COMPANY_ADDRESS_2' => 'COMPANY_ADDRESS_2',
        'COL_COMPANY_ADDRESS_2' => 'COMPANY_ADDRESS_2',
        'company_address_2' => 'COMPANY_ADDRESS_2',
        'company.company_address_2' => 'COMPANY_ADDRESS_2',
        'CompanyDefaultCurrency' => 'COMPANY_DEFAULT_CURRENCY',
        'Company.CompanyDefaultCurrency' => 'COMPANY_DEFAULT_CURRENCY',
        'companyDefaultCurrency' => 'COMPANY_DEFAULT_CURRENCY',
        'company.companyDefaultCurrency' => 'COMPANY_DEFAULT_CURRENCY',
        'CompanyTableMap::COL_COMPANY_DEFAULT_CURRENCY' => 'COMPANY_DEFAULT_CURRENCY',
        'COL_COMPANY_DEFAULT_CURRENCY' => 'COMPANY_DEFAULT_CURRENCY',
        'company_default_currency' => 'COMPANY_DEFAULT_CURRENCY',
        'company.company_default_currency' => 'COMPANY_DEFAULT_CURRENCY',
        'Timezone' => 'TIMEZONE',
        'Company.Timezone' => 'TIMEZONE',
        'timezone' => 'TIMEZONE',
        'company.timezone' => 'TIMEZONE',
        'CompanyTableMap::COL_TIMEZONE' => 'TIMEZONE',
        'COL_TIMEZONE' => 'TIMEZONE',
        'CompanyFirstSetup' => 'COMPANY_FIRST_SETUP',
        'Company.CompanyFirstSetup' => 'COMPANY_FIRST_SETUP',
        'companyFirstSetup' => 'COMPANY_FIRST_SETUP',
        'company.companyFirstSetup' => 'COMPANY_FIRST_SETUP',
        'CompanyTableMap::COL_COMPANY_FIRST_SETUP' => 'COMPANY_FIRST_SETUP',
        'COL_COMPANY_FIRST_SETUP' => 'COMPANY_FIRST_SETUP',
        'company_first_setup' => 'COMPANY_FIRST_SETUP',
        'company.company_first_setup' => 'COMPANY_FIRST_SETUP',
        'OwnerEmail' => 'OWNER_EMAIL',
        'Company.OwnerEmail' => 'OWNER_EMAIL',
        'ownerEmail' => 'OWNER_EMAIL',
        'company.ownerEmail' => 'OWNER_EMAIL',
        'CompanyTableMap::COL_OWNER_EMAIL' => 'OWNER_EMAIL',
        'COL_OWNER_EMAIL' => 'OWNER_EMAIL',
        'owner_email' => 'OWNER_EMAIL',
        'company.owner_email' => 'OWNER_EMAIL',
        'ExpenseReminder' => 'EXPENSE_REMINDER',
        'Company.ExpenseReminder' => 'EXPENSE_REMINDER',
        'expenseReminder' => 'EXPENSE_REMINDER',
        'company.expenseReminder' => 'EXPENSE_REMINDER',
        'CompanyTableMap::COL_EXPENSE_REMINDER' => 'EXPENSE_REMINDER',
        'COL_EXPENSE_REMINDER' => 'EXPENSE_REMINDER',
        'expense_reminder' => 'EXPENSE_REMINDER',
        'company.expense_reminder' => 'EXPENSE_REMINDER',
        'Currentmonthsubmit' => 'CURRENTMONTHSUBMIT',
        'Company.Currentmonthsubmit' => 'CURRENTMONTHSUBMIT',
        'currentmonthsubmit' => 'CURRENTMONTHSUBMIT',
        'company.currentmonthsubmit' => 'CURRENTMONTHSUBMIT',
        'CompanyTableMap::COL_CURRENTMONTHSUBMIT' => 'CURRENTMONTHSUBMIT',
        'COL_CURRENTMONTHSUBMIT' => 'CURRENTMONTHSUBMIT',
        'Tripapprovalreq' => 'TRIPAPPROVALREQ',
        'Company.Tripapprovalreq' => 'TRIPAPPROVALREQ',
        'tripapprovalreq' => 'TRIPAPPROVALREQ',
        'company.tripapprovalreq' => 'TRIPAPPROVALREQ',
        'CompanyTableMap::COL_TRIPAPPROVALREQ' => 'TRIPAPPROVALREQ',
        'COL_TRIPAPPROVALREQ' => 'TRIPAPPROVALREQ',
        'Expenseonlyontrip' => 'EXPENSEONLYONTRIP',
        'Company.Expenseonlyontrip' => 'EXPENSEONLYONTRIP',
        'expenseonlyontrip' => 'EXPENSEONLYONTRIP',
        'company.expenseonlyontrip' => 'EXPENSEONLYONTRIP',
        'CompanyTableMap::COL_EXPENSEONLYONTRIP' => 'EXPENSEONLYONTRIP',
        'COL_EXPENSEONLYONTRIP' => 'EXPENSEONLYONTRIP',
        'Allowbackdatedtrip' => 'ALLOWBACKDATEDTRIP',
        'Company.Allowbackdatedtrip' => 'ALLOWBACKDATEDTRIP',
        'allowbackdatedtrip' => 'ALLOWBACKDATEDTRIP',
        'company.allowbackdatedtrip' => 'ALLOWBACKDATEDTRIP',
        'CompanyTableMap::COL_ALLOWBACKDATEDTRIP' => 'ALLOWBACKDATEDTRIP',
        'COL_ALLOWBACKDATEDTRIP' => 'ALLOWBACKDATEDTRIP',
        'Paymentsystem' => 'PAYMENTSYSTEM',
        'Company.Paymentsystem' => 'PAYMENTSYSTEM',
        'paymentsystem' => 'PAYMENTSYSTEM',
        'company.paymentsystem' => 'PAYMENTSYSTEM',
        'CompanyTableMap::COL_PAYMENTSYSTEM' => 'PAYMENTSYSTEM',
        'COL_PAYMENTSYSTEM' => 'PAYMENTSYSTEM',
        'AutoSettle' => 'AUTO_SETTLE',
        'Company.AutoSettle' => 'AUTO_SETTLE',
        'autoSettle' => 'AUTO_SETTLE',
        'company.autoSettle' => 'AUTO_SETTLE',
        'CompanyTableMap::COL_AUTO_SETTLE' => 'AUTO_SETTLE',
        'COL_AUTO_SETTLE' => 'AUTO_SETTLE',
        'auto_settle' => 'AUTO_SETTLE',
        'company.auto_settle' => 'AUTO_SETTLE',
        'Allowradius' => 'ALLOWRADIUS',
        'Company.Allowradius' => 'ALLOWRADIUS',
        'allowradius' => 'ALLOWRADIUS',
        'company.allowradius' => 'ALLOWRADIUS',
        'CompanyTableMap::COL_ALLOWRADIUS' => 'ALLOWRADIUS',
        'COL_ALLOWRADIUS' => 'ALLOWRADIUS',
        'OrderSeq' => 'ORDER_SEQ',
        'Company.OrderSeq' => 'ORDER_SEQ',
        'orderSeq' => 'ORDER_SEQ',
        'company.orderSeq' => 'ORDER_SEQ',
        'CompanyTableMap::COL_ORDER_SEQ' => 'ORDER_SEQ',
        'COL_ORDER_SEQ' => 'ORDER_SEQ',
        'order_seq' => 'ORDER_SEQ',
        'company.order_seq' => 'ORDER_SEQ',
        'ShippingorderSeq' => 'SHIPPINGORDER_SEQ',
        'Company.ShippingorderSeq' => 'SHIPPINGORDER_SEQ',
        'shippingorderSeq' => 'SHIPPINGORDER_SEQ',
        'company.shippingorderSeq' => 'SHIPPINGORDER_SEQ',
        'CompanyTableMap::COL_SHIPPINGORDER_SEQ' => 'SHIPPINGORDER_SEQ',
        'COL_SHIPPINGORDER_SEQ' => 'SHIPPINGORDER_SEQ',
        'shippingorder_seq' => 'SHIPPINGORDER_SEQ',
        'company.shippingorder_seq' => 'SHIPPINGORDER_SEQ',
        'Googlemapkey' => 'GOOGLEMAPKEY',
        'Company.Googlemapkey' => 'GOOGLEMAPKEY',
        'googlemapkey' => 'GOOGLEMAPKEY',
        'company.googlemapkey' => 'GOOGLEMAPKEY',
        'CompanyTableMap::COL_GOOGLEMAPKEY' => 'GOOGLEMAPKEY',
        'COL_GOOGLEMAPKEY' => 'GOOGLEMAPKEY',
        'Workingdaysinweek' => 'WORKINGDAYSINWEEK',
        'Company.Workingdaysinweek' => 'WORKINGDAYSINWEEK',
        'workingdaysinweek' => 'WORKINGDAYSINWEEK',
        'company.workingdaysinweek' => 'WORKINGDAYSINWEEK',
        'CompanyTableMap::COL_WORKINGDAYSINWEEK' => 'WORKINGDAYSINWEEK',
        'COL_WORKINGDAYSINWEEK' => 'WORKINGDAYSINWEEK',
        'AutoCalculatedTa' => 'AUTO_CALCULATED_TA',
        'Company.AutoCalculatedTa' => 'AUTO_CALCULATED_TA',
        'autoCalculatedTa' => 'AUTO_CALCULATED_TA',
        'company.autoCalculatedTa' => 'AUTO_CALCULATED_TA',
        'CompanyTableMap::COL_AUTO_CALCULATED_TA' => 'AUTO_CALCULATED_TA',
        'COL_AUTO_CALCULATED_TA' => 'AUTO_CALCULATED_TA',
        'auto_calculated_ta' => 'AUTO_CALCULATED_TA',
        'company.auto_calculated_ta' => 'AUTO_CALCULATED_TA',
        'ReportingDays' => 'REPORTING_DAYS',
        'Company.ReportingDays' => 'REPORTING_DAYS',
        'reportingDays' => 'REPORTING_DAYS',
        'company.reportingDays' => 'REPORTING_DAYS',
        'CompanyTableMap::COL_REPORTING_DAYS' => 'REPORTING_DAYS',
        'COL_REPORTING_DAYS' => 'REPORTING_DAYS',
        'reporting_days' => 'REPORTING_DAYS',
        'company.reporting_days' => 'REPORTING_DAYS',
        'ExpenseMonths' => 'EXPENSE_MONTHS',
        'Company.ExpenseMonths' => 'EXPENSE_MONTHS',
        'expenseMonths' => 'EXPENSE_MONTHS',
        'company.expenseMonths' => 'EXPENSE_MONTHS',
        'CompanyTableMap::COL_EXPENSE_MONTHS' => 'EXPENSE_MONTHS',
        'COL_EXPENSE_MONTHS' => 'EXPENSE_MONTHS',
        'expense_months' => 'EXPENSE_MONTHS',
        'company.expense_months' => 'EXPENSE_MONTHS',
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
        $this->setName('company');
        $this->setPhpName('Company');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Company');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('company_company_id_seq');
        // columns
        $this->addPrimaryKey('company_id', 'CompanyId', 'INTEGER', true, null, null);
        $this->addColumn('company_code', 'CompanyCode', 'VARCHAR', true, 255, '0');
        $this->addColumn('company_name', 'CompanyName', 'VARCHAR', false, 100, null);
        $this->addColumn('owner_name', 'OwnerName', 'VARCHAR', false, 100, null);
        $this->addColumn('company_phone_number', 'CompanyPhoneNumber', 'VARCHAR', false, 50, null);
        $this->addColumn('company_contact_number', 'CompanyContactNumber', 'VARCHAR', false, 50, null);
        $this->addColumn('company_logo', 'CompanyLogo', 'VARCHAR', false, 100, null);
        $this->addColumn('company_address_1', 'CompanyAddress1', 'VARCHAR', false, 100, null);
        $this->addColumn('company_address_2', 'CompanyAddress2', 'VARCHAR', false, 100, null);
        $this->addForeignKey('company_default_currency', 'CompanyDefaultCurrency', 'INTEGER', 'currencies', 'currency_id', false, null, null);
        $this->addColumn('timezone', 'Timezone', 'VARCHAR', false, 150, null);
        $this->addColumn('company_first_setup', 'CompanyFirstSetup', 'SMALLINT', false, null, 0);
        $this->addColumn('owner_email', 'OwnerEmail', 'VARCHAR', false, 250, '0');
        $this->addColumn('expense_reminder', 'ExpenseReminder', 'INTEGER', false, null, 0);
        $this->addColumn('currentmonthsubmit', 'Currentmonthsubmit', 'INTEGER', false, null, 1);
        $this->addColumn('tripapprovalreq', 'Tripapprovalreq', 'INTEGER', false, null, 1);
        $this->addColumn('expenseonlyontrip', 'Expenseonlyontrip', 'INTEGER', true, null, 0);
        $this->addColumn('allowbackdatedtrip', 'Allowbackdatedtrip', 'INTEGER', true, null, 1);
        $this->addColumn('paymentsystem', 'Paymentsystem', 'INTEGER', true, null, 1);
        $this->addColumn('auto_settle', 'AutoSettle', 'INTEGER', true, null, 1);
        $this->addColumn('allowradius', 'Allowradius', 'INTEGER', false, null, 1);
        $this->addColumn('order_seq', 'OrderSeq', 'BIGINT', true, null, 1);
        $this->addColumn('shippingorder_seq', 'ShippingorderSeq', 'BIGINT', true, null, 1);
        $this->addColumn('googlemapkey', 'Googlemapkey', 'VARCHAR', false, 100, null);
        $this->addColumn('workingdaysinweek', 'Workingdaysinweek', 'INTEGER', false, null, 6);
        $this->addForeignKey('auto_calculated_ta', 'AutoCalculatedTa', 'INTEGER', 'expense_master', 'expense_id', false, null, null);
        $this->addColumn('reporting_days', 'ReportingDays', 'VARCHAR', false, null, null);
        $this->addColumn('expense_months', 'ExpenseMonths', 'INTEGER', true, null, 3);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('ExpenseMasterRelatedByAutoCalculatedTa', '\\entities\\ExpenseMaster', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':auto_calculated_ta',
    1 => ':expense_id',
  ),
), null, null, null, false);
        $this->addRelation('Currencies', '\\entities\\Currencies', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_default_currency',
    1 => ':currency_id',
  ),
), null, null, null, false);
        $this->addRelation('Agendatypes', '\\entities\\Agendatypes', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'Agendatypess', false);
        $this->addRelation('Announcements', '\\entities\\Announcements', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'Announcementss', false);
        $this->addRelation('ApiKeys', '\\entities\\ApiKeys', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'ApiKeyss', false);
        $this->addRelation('Attendance', '\\entities\\Attendance', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'Attendances', false);
        $this->addRelation('BeatOutlets', '\\entities\\BeatOutlets', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'BeatOutletss', false);
        $this->addRelation('Beats', '\\entities\\Beats', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'Beatss', false);
        $this->addRelation('Branch', '\\entities\\Branch', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'Branches', false);
        $this->addRelation('BrandCampiagn', '\\entities\\BrandCampiagn', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'BrandCampiagns', false);
        $this->addRelation('BrandCampiagnDoctors', '\\entities\\BrandCampiagnDoctors', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'BrandCampiagnDoctorss', false);
        $this->addRelation('BrandCampiagnVisitPlan', '\\entities\\BrandCampiagnVisitPlan', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'BrandCampiagnVisitPlans', false);
        $this->addRelation('BrandCompetition', '\\entities\\BrandCompetition', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'BrandCompetitions', false);
        $this->addRelation('BrandRcpa', '\\entities\\BrandRcpa', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'BrandRcpas', false);
        $this->addRelation('Brands', '\\entities\\Brands', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'Brandss', false);
        $this->addRelation('BudgetGroup', '\\entities\\BudgetGroup', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'BudgetGroups', false);
        $this->addRelation('Categories', '\\entities\\Categories', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'Categoriess', false);
        $this->addRelation('CheckinoutOutcomes', '\\entities\\CheckinoutOutcomes', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'CheckinoutOutcomess', false);
        $this->addRelation('Citycategory', '\\entities\\Citycategory', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'Citycategories', false);
        $this->addRelation('Classification', '\\entities\\Classification', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'Classifications', false);
        $this->addRelation('CompetitionMapping', '\\entities\\CompetitionMapping', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'CompetitionMappings', false);
        $this->addRelation('Competitor', '\\entities\\Competitor', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'Competitors', false);
        $this->addRelation('Configuration', '\\entities\\Configuration', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'Configurations', false);
        $this->addRelation('CronCommandLogs', '\\entities\\CronCommandLogs', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'CronCommandLogss', false);
        $this->addRelation('CronCommands', '\\entities\\CronCommands', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'CronCommandss', false);
        $this->addRelation('Dailycalls', '\\entities\\Dailycalls', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'Dailycallss', false);
        $this->addRelation('DailycallsSgpiout', '\\entities\\DailycallsSgpiout', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'DailycallsSgpiouts', false);
        $this->addRelation('DataExceptionLogs', '\\entities\\DataExceptionLogs', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'DataExceptionLogss', false);
        $this->addRelation('DataExceptions', '\\entities\\DataExceptions', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'DataExceptionss', false);
        $this->addRelation('Designations', '\\entities\\Designations', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'Designationss', false);
        $this->addRelation('EdFeedbacks', '\\entities\\EdFeedbacks', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'EdFeedbackss', false);
        $this->addRelation('EdPlaylist', '\\entities\\EdPlaylist', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'EdPlaylists', false);
        $this->addRelation('EdPresentations', '\\entities\\EdPresentations', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'EdPresentationss', false);
        $this->addRelation('EdSession', '\\entities\\EdSession', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'EdSessions', false);
        $this->addRelation('EdStats', '\\entities\\EdStats', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'EdStatss', false);
        $this->addRelation('Employee', '\\entities\\Employee', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'Employees', false);
        $this->addRelation('EmployeeIncentive', '\\entities\\EmployeeIncentive', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'EmployeeIncentives', false);
        $this->addRelation('EventTypes', '\\entities\\EventTypes', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'EventTypess', false);
        $this->addRelation('Events', '\\entities\\Events', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'Eventss', false);
        $this->addRelation('ExpenseList', '\\entities\\ExpenseList', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'ExpenseLists', false);
        $this->addRelation('ExpenseMasterRelatedByCompanyId', '\\entities\\ExpenseMaster', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'ExpenseMastersRelatedByCompanyId', false);
        $this->addRelation('ExpensePayments', '\\entities\\ExpensePayments', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'ExpensePaymentss', false);
        $this->addRelation('Expenses', '\\entities\\Expenses', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'Expensess', false);
        $this->addRelation('FtpConfigs', '\\entities\\FtpConfigs', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'FtpConfigss', false);
        $this->addRelation('FtpExportBatches', '\\entities\\FtpExportBatches', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'FtpExportBatchess', false);
        $this->addRelation('FtpExportLogs', '\\entities\\FtpExportLogs', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'FtpExportLogss', false);
        $this->addRelation('FtpImportBatches', '\\entities\\FtpImportBatches', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'FtpImportBatchess', false);
        $this->addRelation('FtpImportLogs', '\\entities\\FtpImportLogs', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'FtpImportLogss', false);
        $this->addRelation('GradeMaster', '\\entities\\GradeMaster', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'GradeMasters', false);
        $this->addRelation('Holidays', '\\entities\\Holidays', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'Holidayss', false);
        $this->addRelation('IntegrationApiLogs', '\\entities\\IntegrationApiLogs', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'IntegrationApiLogss', false);
        $this->addRelation('LeaveRequest', '\\entities\\LeaveRequest', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'LeaveRequests', false);
        $this->addRelation('Leaves', '\\entities\\Leaves', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'Leavess', false);
        $this->addRelation('MaterialFolders', '\\entities\\MaterialFolders', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'MaterialFolderss', false);
        $this->addRelation('MediaFiles', '\\entities\\MediaFiles', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'MediaFiless', false);
        $this->addRelation('MediaFolders', '\\entities\\MediaFolders', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'MediaFolderss', false);
        $this->addRelation('Mtp', '\\entities\\Mtp', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'Mtps', false);
        $this->addRelation('MtpDay', '\\entities\\MtpDay', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'MtpDays', false);
        $this->addRelation('MtpLogs', '\\entities\\MtpLogs', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'MtpLogss', false);
        $this->addRelation('Offers', '\\entities\\Offers', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'Offerss', false);
        $this->addRelation('OnBoardRequest', '\\entities\\OnBoardRequest', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'OnBoardRequests', false);
        $this->addRelation('OnBoardRequestAddress', '\\entities\\OnBoardRequestAddress', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'OnBoardRequestAddresses', false);
        $this->addRelation('OnBoardRequiredFields', '\\entities\\OnBoardRequiredFields', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'OnBoardRequiredFieldss', false);
        $this->addRelation('OrderLog', '\\entities\\OrderLog', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'OrderLogs', false);
        $this->addRelation('Orderlines', '\\entities\\Orderlines', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'Orderliness', false);
        $this->addRelation('Orders', '\\entities\\Orders', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'Orderss', false);
        $this->addRelation('OrgUnit', '\\entities\\OrgUnit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'OrgUnits', false);
        $this->addRelation('OtpRequests', '\\entities\\OtpRequests', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'OtpRequestss', false);
        $this->addRelation('OutletAddress', '\\entities\\OutletAddress', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'OutletAddresses', false);
        $this->addRelation('OutletOrgData', '\\entities\\OutletOrgData', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'OutletOrgDatas', false);
        $this->addRelation('OutletOrgNotes', '\\entities\\OutletOrgNotes', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'OutletOrgNotess', false);
        $this->addRelation('OutletOutcomes', '\\entities\\OutletOutcomes', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'OutletOutcomess', false);
        $this->addRelation('OutletStock', '\\entities\\OutletStock', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'OutletStocks', false);
        $this->addRelation('OutletStockOtherSummary', '\\entities\\OutletStockOtherSummary', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'OutletStockOtherSummaries', false);
        $this->addRelation('OutletStockSummary', '\\entities\\OutletStockSummary', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'OutletStockSummaries', false);
        $this->addRelation('OutletTags', '\\entities\\OutletTags', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'OutletTagss', false);
        $this->addRelation('OutletType', '\\entities\\OutletType', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'OutletTypes', false);
        $this->addRelation('Outlets', '\\entities\\Outlets', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'Outletss', false);
        $this->addRelation('PolicyMaster', '\\entities\\PolicyMaster', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'PolicyMasters', false);
        $this->addRelation('Policykeys', '\\entities\\Policykeys', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'Policykeyss', false);
        $this->addRelation('Positions', '\\entities\\Positions', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'Positionss', false);
        $this->addRelation('Pricebooklines', '\\entities\\Pricebooklines', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'Pricebookliness', false);
        $this->addRelation('Pricebooks', '\\entities\\Pricebooks', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'Pricebookss', false);
        $this->addRelation('Products', '\\entities\\Products', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'Productss', false);
        $this->addRelation('Reminders', '\\entities\\Reminders', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'Reminderss', false);
        $this->addRelation('SgpiAccounts', '\\entities\\SgpiAccounts', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'SgpiAccountss', false);
        $this->addRelation('SgpiMaster', '\\entities\\SgpiMaster', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'SgpiMasters', false);
        $this->addRelation('SgpiTrans', '\\entities\\SgpiTrans', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'SgpiTranss', false);
        $this->addRelation('ShiftTypes', '\\entities\\ShiftTypes', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'ShiftTypess', false);
        $this->addRelation('Shippinglines', '\\entities\\Shippinglines', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'Shippingliness', false);
        $this->addRelation('Shippingorder', '\\entities\\Shippingorder', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'Shippingorders', false);
        $this->addRelation('StockTransaction', '\\entities\\StockTransaction', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'StockTransactions', false);
        $this->addRelation('StockVoucher', '\\entities\\StockVoucher', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'StockVouchers', false);
        $this->addRelation('Survey', '\\entities\\Survey', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'Surveys', false);
        $this->addRelation('SurveyCategory', '\\entities\\SurveyCategory', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'SurveyCategories', false);
        $this->addRelation('SurveyQuestion', '\\entities\\SurveyQuestion', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'SurveyQuestions', false);
        $this->addRelation('SurveySubmited', '\\entities\\SurveySubmited', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'SurveySubmiteds', false);
        $this->addRelation('TaConfiguration', '\\entities\\TaConfiguration', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'TaConfigurations', false);
        $this->addRelation('Tags', '\\entities\\Tags', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'Tagss', false);
        $this->addRelation('Territories', '\\entities\\Territories', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'Territoriess', false);
        $this->addRelation('TerritoryTowns', '\\entities\\TerritoryTowns', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'TerritoryTownss', false);
        $this->addRelation('TicketReplies', '\\entities\\TicketReplies', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'TicketRepliess', false);
        $this->addRelation('TicketType', '\\entities\\TicketType', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'TicketTypes', false);
        $this->addRelation('Tickets', '\\entities\\Tickets', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'Ticketss', false);
        $this->addRelation('Tourplans', '\\entities\\Tourplans', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'Tourplanss', false);
        $this->addRelation('Transactions', '\\entities\\Transactions', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'Transactionss', false);
        $this->addRelation('Users', '\\entities\\Users', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'Userss', false);
        $this->addRelation('WdbSyncLog', '\\entities\\WdbSyncLog', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'WdbSyncLogs', false);
        $this->addRelation('WfRequests', '\\entities\\WfRequests', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':wf_company_id',
    1 => ':company_id',
  ),
), null, null, 'WfRequestss', false);
        $this->addRelation('Stp', '\\entities\\Stp', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'Stps', false);
        $this->addRelation('StpWeek', '\\entities\\StpWeek', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, 'StpWeeks', false);
        $this->addRelation('OutletOrgDataKeys', '\\entities\\OutletOrgDataKeys', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'OutletOrgDataKeyss', false);
        $this->addRelation('NotificationConfiguration', '\\entities\\NotificationConfiguration', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'NotificationConfigurations', false);
        $this->addRelation('LeaveType', '\\entities\\LeaveType', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, 'LeaveTypes', false);
    }

    /**
     * Method to invalidate the instance pool of all tables related to company     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        AgendatypesTableMap::clearInstancePool();
        AttendanceTableMap::clearInstancePool();
        BeatOutletsTableMap::clearInstancePool();
        BeatsTableMap::clearInstancePool();
        BranchTableMap::clearInstancePool();
        BudgetGroupTableMap::clearInstancePool();
        CategoriesTableMap::clearInstancePool();
        CheckinoutOutcomesTableMap::clearInstancePool();
        CitycategoryTableMap::clearInstancePool();
        CompetitionMappingTableMap::clearInstancePool();
        CompetitorTableMap::clearInstancePool();
        ConfigurationTableMap::clearInstancePool();
        DesignationsTableMap::clearInstancePool();
        EmployeeTableMap::clearInstancePool();
        EmployeeIncentiveTableMap::clearInstancePool();
        EventTypesTableMap::clearInstancePool();
        EventsTableMap::clearInstancePool();
        ExpenseMasterTableMap::clearInstancePool();
        ExpensesTableMap::clearInstancePool();
        FtpConfigsTableMap::clearInstancePool();
        FtpExportBatchesTableMap::clearInstancePool();
        FtpExportLogsTableMap::clearInstancePool();
        FtpImportBatchesTableMap::clearInstancePool();
        FtpImportLogsTableMap::clearInstancePool();
        GradeMasterTableMap::clearInstancePool();
        OrgUnitTableMap::clearInstancePool();
        PolicyMasterTableMap::clearInstancePool();
        PolicykeysTableMap::clearInstancePool();
        PositionsTableMap::clearInstancePool();
        OutletOrgDataKeysTableMap::clearInstancePool();
        NotificationConfigurationTableMap::clearInstancePool();
        LeaveTypeTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? CompanyTableMap::CLASS_DEFAULT : CompanyTableMap::OM_CLASS;
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
     * @return array (Company object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = CompanyTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CompanyTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CompanyTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CompanyTableMap::OM_CLASS;
            /** @var Company $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CompanyTableMap::addInstanceToPool($obj, $key);
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
            $key = CompanyTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CompanyTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Company $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CompanyTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CompanyTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(CompanyTableMap::COL_COMPANY_CODE);
            $criteria->addSelectColumn(CompanyTableMap::COL_COMPANY_NAME);
            $criteria->addSelectColumn(CompanyTableMap::COL_OWNER_NAME);
            $criteria->addSelectColumn(CompanyTableMap::COL_COMPANY_PHONE_NUMBER);
            $criteria->addSelectColumn(CompanyTableMap::COL_COMPANY_CONTACT_NUMBER);
            $criteria->addSelectColumn(CompanyTableMap::COL_COMPANY_LOGO);
            $criteria->addSelectColumn(CompanyTableMap::COL_COMPANY_ADDRESS_1);
            $criteria->addSelectColumn(CompanyTableMap::COL_COMPANY_ADDRESS_2);
            $criteria->addSelectColumn(CompanyTableMap::COL_COMPANY_DEFAULT_CURRENCY);
            $criteria->addSelectColumn(CompanyTableMap::COL_TIMEZONE);
            $criteria->addSelectColumn(CompanyTableMap::COL_COMPANY_FIRST_SETUP);
            $criteria->addSelectColumn(CompanyTableMap::COL_OWNER_EMAIL);
            $criteria->addSelectColumn(CompanyTableMap::COL_EXPENSE_REMINDER);
            $criteria->addSelectColumn(CompanyTableMap::COL_CURRENTMONTHSUBMIT);
            $criteria->addSelectColumn(CompanyTableMap::COL_TRIPAPPROVALREQ);
            $criteria->addSelectColumn(CompanyTableMap::COL_EXPENSEONLYONTRIP);
            $criteria->addSelectColumn(CompanyTableMap::COL_ALLOWBACKDATEDTRIP);
            $criteria->addSelectColumn(CompanyTableMap::COL_PAYMENTSYSTEM);
            $criteria->addSelectColumn(CompanyTableMap::COL_AUTO_SETTLE);
            $criteria->addSelectColumn(CompanyTableMap::COL_ALLOWRADIUS);
            $criteria->addSelectColumn(CompanyTableMap::COL_ORDER_SEQ);
            $criteria->addSelectColumn(CompanyTableMap::COL_SHIPPINGORDER_SEQ);
            $criteria->addSelectColumn(CompanyTableMap::COL_GOOGLEMAPKEY);
            $criteria->addSelectColumn(CompanyTableMap::COL_WORKINGDAYSINWEEK);
            $criteria->addSelectColumn(CompanyTableMap::COL_AUTO_CALCULATED_TA);
            $criteria->addSelectColumn(CompanyTableMap::COL_REPORTING_DAYS);
            $criteria->addSelectColumn(CompanyTableMap::COL_EXPENSE_MONTHS);
        } else {
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.company_code');
            $criteria->addSelectColumn($alias . '.company_name');
            $criteria->addSelectColumn($alias . '.owner_name');
            $criteria->addSelectColumn($alias . '.company_phone_number');
            $criteria->addSelectColumn($alias . '.company_contact_number');
            $criteria->addSelectColumn($alias . '.company_logo');
            $criteria->addSelectColumn($alias . '.company_address_1');
            $criteria->addSelectColumn($alias . '.company_address_2');
            $criteria->addSelectColumn($alias . '.company_default_currency');
            $criteria->addSelectColumn($alias . '.timezone');
            $criteria->addSelectColumn($alias . '.company_first_setup');
            $criteria->addSelectColumn($alias . '.owner_email');
            $criteria->addSelectColumn($alias . '.expense_reminder');
            $criteria->addSelectColumn($alias . '.currentmonthsubmit');
            $criteria->addSelectColumn($alias . '.tripapprovalreq');
            $criteria->addSelectColumn($alias . '.expenseonlyontrip');
            $criteria->addSelectColumn($alias . '.allowbackdatedtrip');
            $criteria->addSelectColumn($alias . '.paymentsystem');
            $criteria->addSelectColumn($alias . '.auto_settle');
            $criteria->addSelectColumn($alias . '.allowradius');
            $criteria->addSelectColumn($alias . '.order_seq');
            $criteria->addSelectColumn($alias . '.shippingorder_seq');
            $criteria->addSelectColumn($alias . '.googlemapkey');
            $criteria->addSelectColumn($alias . '.workingdaysinweek');
            $criteria->addSelectColumn($alias . '.auto_calculated_ta');
            $criteria->addSelectColumn($alias . '.reporting_days');
            $criteria->addSelectColumn($alias . '.expense_months');
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
            $criteria->removeSelectColumn(CompanyTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(CompanyTableMap::COL_COMPANY_CODE);
            $criteria->removeSelectColumn(CompanyTableMap::COL_COMPANY_NAME);
            $criteria->removeSelectColumn(CompanyTableMap::COL_OWNER_NAME);
            $criteria->removeSelectColumn(CompanyTableMap::COL_COMPANY_PHONE_NUMBER);
            $criteria->removeSelectColumn(CompanyTableMap::COL_COMPANY_CONTACT_NUMBER);
            $criteria->removeSelectColumn(CompanyTableMap::COL_COMPANY_LOGO);
            $criteria->removeSelectColumn(CompanyTableMap::COL_COMPANY_ADDRESS_1);
            $criteria->removeSelectColumn(CompanyTableMap::COL_COMPANY_ADDRESS_2);
            $criteria->removeSelectColumn(CompanyTableMap::COL_COMPANY_DEFAULT_CURRENCY);
            $criteria->removeSelectColumn(CompanyTableMap::COL_TIMEZONE);
            $criteria->removeSelectColumn(CompanyTableMap::COL_COMPANY_FIRST_SETUP);
            $criteria->removeSelectColumn(CompanyTableMap::COL_OWNER_EMAIL);
            $criteria->removeSelectColumn(CompanyTableMap::COL_EXPENSE_REMINDER);
            $criteria->removeSelectColumn(CompanyTableMap::COL_CURRENTMONTHSUBMIT);
            $criteria->removeSelectColumn(CompanyTableMap::COL_TRIPAPPROVALREQ);
            $criteria->removeSelectColumn(CompanyTableMap::COL_EXPENSEONLYONTRIP);
            $criteria->removeSelectColumn(CompanyTableMap::COL_ALLOWBACKDATEDTRIP);
            $criteria->removeSelectColumn(CompanyTableMap::COL_PAYMENTSYSTEM);
            $criteria->removeSelectColumn(CompanyTableMap::COL_AUTO_SETTLE);
            $criteria->removeSelectColumn(CompanyTableMap::COL_ALLOWRADIUS);
            $criteria->removeSelectColumn(CompanyTableMap::COL_ORDER_SEQ);
            $criteria->removeSelectColumn(CompanyTableMap::COL_SHIPPINGORDER_SEQ);
            $criteria->removeSelectColumn(CompanyTableMap::COL_GOOGLEMAPKEY);
            $criteria->removeSelectColumn(CompanyTableMap::COL_WORKINGDAYSINWEEK);
            $criteria->removeSelectColumn(CompanyTableMap::COL_AUTO_CALCULATED_TA);
            $criteria->removeSelectColumn(CompanyTableMap::COL_REPORTING_DAYS);
            $criteria->removeSelectColumn(CompanyTableMap::COL_EXPENSE_MONTHS);
        } else {
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.company_code');
            $criteria->removeSelectColumn($alias . '.company_name');
            $criteria->removeSelectColumn($alias . '.owner_name');
            $criteria->removeSelectColumn($alias . '.company_phone_number');
            $criteria->removeSelectColumn($alias . '.company_contact_number');
            $criteria->removeSelectColumn($alias . '.company_logo');
            $criteria->removeSelectColumn($alias . '.company_address_1');
            $criteria->removeSelectColumn($alias . '.company_address_2');
            $criteria->removeSelectColumn($alias . '.company_default_currency');
            $criteria->removeSelectColumn($alias . '.timezone');
            $criteria->removeSelectColumn($alias . '.company_first_setup');
            $criteria->removeSelectColumn($alias . '.owner_email');
            $criteria->removeSelectColumn($alias . '.expense_reminder');
            $criteria->removeSelectColumn($alias . '.currentmonthsubmit');
            $criteria->removeSelectColumn($alias . '.tripapprovalreq');
            $criteria->removeSelectColumn($alias . '.expenseonlyontrip');
            $criteria->removeSelectColumn($alias . '.allowbackdatedtrip');
            $criteria->removeSelectColumn($alias . '.paymentsystem');
            $criteria->removeSelectColumn($alias . '.auto_settle');
            $criteria->removeSelectColumn($alias . '.allowradius');
            $criteria->removeSelectColumn($alias . '.order_seq');
            $criteria->removeSelectColumn($alias . '.shippingorder_seq');
            $criteria->removeSelectColumn($alias . '.googlemapkey');
            $criteria->removeSelectColumn($alias . '.workingdaysinweek');
            $criteria->removeSelectColumn($alias . '.auto_calculated_ta');
            $criteria->removeSelectColumn($alias . '.reporting_days');
            $criteria->removeSelectColumn($alias . '.expense_months');
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
        return Propel::getServiceContainer()->getDatabaseMap(CompanyTableMap::DATABASE_NAME)->getTable(CompanyTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Company or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Company object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CompanyTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Company) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CompanyTableMap::DATABASE_NAME);
            $criteria->add(CompanyTableMap::COL_COMPANY_ID, (array) $values, Criteria::IN);
        }

        $query = CompanyQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CompanyTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CompanyTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the company table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return CompanyQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Company or Criteria object.
     *
     * @param mixed $criteria Criteria or Company object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CompanyTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Company object
        }

        if ($criteria->containsKey(CompanyTableMap::COL_COMPANY_ID) && $criteria->keyContainsValue(CompanyTableMap::COL_COMPANY_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CompanyTableMap::COL_COMPANY_ID.')');
        }


        // Set the correct dbName
        $query = CompanyQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
