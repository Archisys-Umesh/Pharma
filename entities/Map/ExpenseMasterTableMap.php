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
use entities\ExpenseMaster;
use entities\ExpenseMasterQuery;


/**
 * This class defines the structure of the 'expense_master' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ExpenseMasterTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.ExpenseMasterTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'expense_master';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'ExpenseMaster';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\ExpenseMaster';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.ExpenseMaster';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 26;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 26;

    /**
     * the column name for the expense_id field
     */
    public const COL_EXPENSE_ID = 'expense_master.expense_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'expense_master.company_id';

    /**
     * the column name for the expense_name field
     */
    public const COL_EXPENSE_NAME = 'expense_master.expense_name';

    /**
     * the column name for the default_policykey field
     */
    public const COL_DEFAULT_POLICYKEY = 'expense_master.default_policykey';

    /**
     * the column name for the checkcity field
     */
    public const COL_CHECKCITY = 'expense_master.checkcity';

    /**
     * the column name for the policykeya field
     */
    public const COL_POLICYKEYA = 'expense_master.policykeya';

    /**
     * the column name for the policykeyb field
     */
    public const COL_POLICYKEYB = 'expense_master.policykeyb';

    /**
     * the column name for the policykeyc field
     */
    public const COL_POLICYKEYC = 'expense_master.policykeyc';

    /**
     * the column name for the trips field
     */
    public const COL_TRIPS = 'expense_master.trips';

    /**
     * the column name for the permonth field
     */
    public const COL_PERMONTH = 'expense_master.permonth';

    /**
     * the column name for the nonreimbursable field
     */
    public const COL_NONREIMBURSABLE = 'expense_master.nonreimbursable';

    /**
     * the column name for the isdaily field
     */
    public const COL_ISDAILY = 'expense_master.isdaily';

    /**
     * the column name for the israteapplied field
     */
    public const COL_ISRATEAPPLIED = 'expense_master.israteapplied';

    /**
     * the column name for the rate field
     */
    public const COL_RATE = 'expense_master.rate';

    /**
     * the column name for the mode field
     */
    public const COL_MODE = 'expense_master.mode';

    /**
     * the column name for the commentreq field
     */
    public const COL_COMMENTREQ = 'expense_master.commentreq';

    /**
     * the column name for the additional_text field
     */
    public const COL_ADDITIONAL_TEXT = 'expense_master.additional_text';

    /**
     * the column name for the is_prefilled field
     */
    public const COL_IS_PREFILLED = 'expense_master.is_prefilled';

    /**
     * the column name for the is_mandatory field
     */
    public const COL_IS_MANDATORY = 'expense_master.is_mandatory';

    /**
     * the column name for the can_repeat field
     */
    public const COL_CAN_REPEAT = 'expense_master.can_repeat';

    /**
     * the column name for the expense_tempate_name field
     */
    public const COL_EXPENSE_TEMPATE_NAME = 'expense_master.expense_tempate_name';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'expense_master.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'expense_master.updated_at';

    /**
     * the column name for the is_editable field
     */
    public const COL_IS_EDITABLE = 'expense_master.is_editable';

    /**
     * the column name for the attachment_required field
     */
    public const COL_ATTACHMENT_REQUIRED = 'expense_master.attachment_required';

    /**
     * the column name for the sort_order field
     */
    public const COL_SORT_ORDER = 'expense_master.sort_order';

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
        self::TYPE_PHPNAME       => ['ExpenseId', 'CompanyId', 'ExpenseName', 'DefaultPolicykey', 'Checkcity', 'Policykeya', 'Policykeyb', 'Policykeyc', 'Trips', 'Permonth', 'Nonreimbursable', 'Isdaily', 'Israteapplied', 'Rate', 'Mode', 'Commentreq', 'AdditionalText', 'IsPrefilled', 'IsMandatory', 'CanRepeat', 'ExpenseTempateName', 'CreatedAt', 'UpdatedAt', 'IsEditable', 'AttachmentRequired', 'SortOrder', ],
        self::TYPE_CAMELNAME     => ['expenseId', 'companyId', 'expenseName', 'defaultPolicykey', 'checkcity', 'policykeya', 'policykeyb', 'policykeyc', 'trips', 'permonth', 'nonreimbursable', 'isdaily', 'israteapplied', 'rate', 'mode', 'commentreq', 'additionalText', 'isPrefilled', 'isMandatory', 'canRepeat', 'expenseTempateName', 'createdAt', 'updatedAt', 'isEditable', 'attachmentRequired', 'sortOrder', ],
        self::TYPE_COLNAME       => [ExpenseMasterTableMap::COL_EXPENSE_ID, ExpenseMasterTableMap::COL_COMPANY_ID, ExpenseMasterTableMap::COL_EXPENSE_NAME, ExpenseMasterTableMap::COL_DEFAULT_POLICYKEY, ExpenseMasterTableMap::COL_CHECKCITY, ExpenseMasterTableMap::COL_POLICYKEYA, ExpenseMasterTableMap::COL_POLICYKEYB, ExpenseMasterTableMap::COL_POLICYKEYC, ExpenseMasterTableMap::COL_TRIPS, ExpenseMasterTableMap::COL_PERMONTH, ExpenseMasterTableMap::COL_NONREIMBURSABLE, ExpenseMasterTableMap::COL_ISDAILY, ExpenseMasterTableMap::COL_ISRATEAPPLIED, ExpenseMasterTableMap::COL_RATE, ExpenseMasterTableMap::COL_MODE, ExpenseMasterTableMap::COL_COMMENTREQ, ExpenseMasterTableMap::COL_ADDITIONAL_TEXT, ExpenseMasterTableMap::COL_IS_PREFILLED, ExpenseMasterTableMap::COL_IS_MANDATORY, ExpenseMasterTableMap::COL_CAN_REPEAT, ExpenseMasterTableMap::COL_EXPENSE_TEMPATE_NAME, ExpenseMasterTableMap::COL_CREATED_AT, ExpenseMasterTableMap::COL_UPDATED_AT, ExpenseMasterTableMap::COL_IS_EDITABLE, ExpenseMasterTableMap::COL_ATTACHMENT_REQUIRED, ExpenseMasterTableMap::COL_SORT_ORDER, ],
        self::TYPE_FIELDNAME     => ['expense_id', 'company_id', 'expense_name', 'default_policykey', 'checkcity', 'policykeya', 'policykeyb', 'policykeyc', 'trips', 'permonth', 'nonreimbursable', 'isdaily', 'israteapplied', 'rate', 'mode', 'commentreq', 'additional_text', 'is_prefilled', 'is_mandatory', 'can_repeat', 'expense_tempate_name', 'created_at', 'updated_at', 'is_editable', 'attachment_required', 'sort_order', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, ]
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
        self::TYPE_PHPNAME       => ['ExpenseId' => 0, 'CompanyId' => 1, 'ExpenseName' => 2, 'DefaultPolicykey' => 3, 'Checkcity' => 4, 'Policykeya' => 5, 'Policykeyb' => 6, 'Policykeyc' => 7, 'Trips' => 8, 'Permonth' => 9, 'Nonreimbursable' => 10, 'Isdaily' => 11, 'Israteapplied' => 12, 'Rate' => 13, 'Mode' => 14, 'Commentreq' => 15, 'AdditionalText' => 16, 'IsPrefilled' => 17, 'IsMandatory' => 18, 'CanRepeat' => 19, 'ExpenseTempateName' => 20, 'CreatedAt' => 21, 'UpdatedAt' => 22, 'IsEditable' => 23, 'AttachmentRequired' => 24, 'SortOrder' => 25, ],
        self::TYPE_CAMELNAME     => ['expenseId' => 0, 'companyId' => 1, 'expenseName' => 2, 'defaultPolicykey' => 3, 'checkcity' => 4, 'policykeya' => 5, 'policykeyb' => 6, 'policykeyc' => 7, 'trips' => 8, 'permonth' => 9, 'nonreimbursable' => 10, 'isdaily' => 11, 'israteapplied' => 12, 'rate' => 13, 'mode' => 14, 'commentreq' => 15, 'additionalText' => 16, 'isPrefilled' => 17, 'isMandatory' => 18, 'canRepeat' => 19, 'expenseTempateName' => 20, 'createdAt' => 21, 'updatedAt' => 22, 'isEditable' => 23, 'attachmentRequired' => 24, 'sortOrder' => 25, ],
        self::TYPE_COLNAME       => [ExpenseMasterTableMap::COL_EXPENSE_ID => 0, ExpenseMasterTableMap::COL_COMPANY_ID => 1, ExpenseMasterTableMap::COL_EXPENSE_NAME => 2, ExpenseMasterTableMap::COL_DEFAULT_POLICYKEY => 3, ExpenseMasterTableMap::COL_CHECKCITY => 4, ExpenseMasterTableMap::COL_POLICYKEYA => 5, ExpenseMasterTableMap::COL_POLICYKEYB => 6, ExpenseMasterTableMap::COL_POLICYKEYC => 7, ExpenseMasterTableMap::COL_TRIPS => 8, ExpenseMasterTableMap::COL_PERMONTH => 9, ExpenseMasterTableMap::COL_NONREIMBURSABLE => 10, ExpenseMasterTableMap::COL_ISDAILY => 11, ExpenseMasterTableMap::COL_ISRATEAPPLIED => 12, ExpenseMasterTableMap::COL_RATE => 13, ExpenseMasterTableMap::COL_MODE => 14, ExpenseMasterTableMap::COL_COMMENTREQ => 15, ExpenseMasterTableMap::COL_ADDITIONAL_TEXT => 16, ExpenseMasterTableMap::COL_IS_PREFILLED => 17, ExpenseMasterTableMap::COL_IS_MANDATORY => 18, ExpenseMasterTableMap::COL_CAN_REPEAT => 19, ExpenseMasterTableMap::COL_EXPENSE_TEMPATE_NAME => 20, ExpenseMasterTableMap::COL_CREATED_AT => 21, ExpenseMasterTableMap::COL_UPDATED_AT => 22, ExpenseMasterTableMap::COL_IS_EDITABLE => 23, ExpenseMasterTableMap::COL_ATTACHMENT_REQUIRED => 24, ExpenseMasterTableMap::COL_SORT_ORDER => 25, ],
        self::TYPE_FIELDNAME     => ['expense_id' => 0, 'company_id' => 1, 'expense_name' => 2, 'default_policykey' => 3, 'checkcity' => 4, 'policykeya' => 5, 'policykeyb' => 6, 'policykeyc' => 7, 'trips' => 8, 'permonth' => 9, 'nonreimbursable' => 10, 'isdaily' => 11, 'israteapplied' => 12, 'rate' => 13, 'mode' => 14, 'commentreq' => 15, 'additional_text' => 16, 'is_prefilled' => 17, 'is_mandatory' => 18, 'can_repeat' => 19, 'expense_tempate_name' => 20, 'created_at' => 21, 'updated_at' => 22, 'is_editable' => 23, 'attachment_required' => 24, 'sort_order' => 25, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'ExpenseId' => 'EXPENSE_ID',
        'ExpenseMaster.ExpenseId' => 'EXPENSE_ID',
        'expenseId' => 'EXPENSE_ID',
        'expenseMaster.expenseId' => 'EXPENSE_ID',
        'ExpenseMasterTableMap::COL_EXPENSE_ID' => 'EXPENSE_ID',
        'COL_EXPENSE_ID' => 'EXPENSE_ID',
        'expense_id' => 'EXPENSE_ID',
        'expense_master.expense_id' => 'EXPENSE_ID',
        'CompanyId' => 'COMPANY_ID',
        'ExpenseMaster.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'expenseMaster.companyId' => 'COMPANY_ID',
        'ExpenseMasterTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'expense_master.company_id' => 'COMPANY_ID',
        'ExpenseName' => 'EXPENSE_NAME',
        'ExpenseMaster.ExpenseName' => 'EXPENSE_NAME',
        'expenseName' => 'EXPENSE_NAME',
        'expenseMaster.expenseName' => 'EXPENSE_NAME',
        'ExpenseMasterTableMap::COL_EXPENSE_NAME' => 'EXPENSE_NAME',
        'COL_EXPENSE_NAME' => 'EXPENSE_NAME',
        'expense_name' => 'EXPENSE_NAME',
        'expense_master.expense_name' => 'EXPENSE_NAME',
        'DefaultPolicykey' => 'DEFAULT_POLICYKEY',
        'ExpenseMaster.DefaultPolicykey' => 'DEFAULT_POLICYKEY',
        'defaultPolicykey' => 'DEFAULT_POLICYKEY',
        'expenseMaster.defaultPolicykey' => 'DEFAULT_POLICYKEY',
        'ExpenseMasterTableMap::COL_DEFAULT_POLICYKEY' => 'DEFAULT_POLICYKEY',
        'COL_DEFAULT_POLICYKEY' => 'DEFAULT_POLICYKEY',
        'default_policykey' => 'DEFAULT_POLICYKEY',
        'expense_master.default_policykey' => 'DEFAULT_POLICYKEY',
        'Checkcity' => 'CHECKCITY',
        'ExpenseMaster.Checkcity' => 'CHECKCITY',
        'checkcity' => 'CHECKCITY',
        'expenseMaster.checkcity' => 'CHECKCITY',
        'ExpenseMasterTableMap::COL_CHECKCITY' => 'CHECKCITY',
        'COL_CHECKCITY' => 'CHECKCITY',
        'expense_master.checkcity' => 'CHECKCITY',
        'Policykeya' => 'POLICYKEYA',
        'ExpenseMaster.Policykeya' => 'POLICYKEYA',
        'policykeya' => 'POLICYKEYA',
        'expenseMaster.policykeya' => 'POLICYKEYA',
        'ExpenseMasterTableMap::COL_POLICYKEYA' => 'POLICYKEYA',
        'COL_POLICYKEYA' => 'POLICYKEYA',
        'expense_master.policykeya' => 'POLICYKEYA',
        'Policykeyb' => 'POLICYKEYB',
        'ExpenseMaster.Policykeyb' => 'POLICYKEYB',
        'policykeyb' => 'POLICYKEYB',
        'expenseMaster.policykeyb' => 'POLICYKEYB',
        'ExpenseMasterTableMap::COL_POLICYKEYB' => 'POLICYKEYB',
        'COL_POLICYKEYB' => 'POLICYKEYB',
        'expense_master.policykeyb' => 'POLICYKEYB',
        'Policykeyc' => 'POLICYKEYC',
        'ExpenseMaster.Policykeyc' => 'POLICYKEYC',
        'policykeyc' => 'POLICYKEYC',
        'expenseMaster.policykeyc' => 'POLICYKEYC',
        'ExpenseMasterTableMap::COL_POLICYKEYC' => 'POLICYKEYC',
        'COL_POLICYKEYC' => 'POLICYKEYC',
        'expense_master.policykeyc' => 'POLICYKEYC',
        'Trips' => 'TRIPS',
        'ExpenseMaster.Trips' => 'TRIPS',
        'trips' => 'TRIPS',
        'expenseMaster.trips' => 'TRIPS',
        'ExpenseMasterTableMap::COL_TRIPS' => 'TRIPS',
        'COL_TRIPS' => 'TRIPS',
        'expense_master.trips' => 'TRIPS',
        'Permonth' => 'PERMONTH',
        'ExpenseMaster.Permonth' => 'PERMONTH',
        'permonth' => 'PERMONTH',
        'expenseMaster.permonth' => 'PERMONTH',
        'ExpenseMasterTableMap::COL_PERMONTH' => 'PERMONTH',
        'COL_PERMONTH' => 'PERMONTH',
        'expense_master.permonth' => 'PERMONTH',
        'Nonreimbursable' => 'NONREIMBURSABLE',
        'ExpenseMaster.Nonreimbursable' => 'NONREIMBURSABLE',
        'nonreimbursable' => 'NONREIMBURSABLE',
        'expenseMaster.nonreimbursable' => 'NONREIMBURSABLE',
        'ExpenseMasterTableMap::COL_NONREIMBURSABLE' => 'NONREIMBURSABLE',
        'COL_NONREIMBURSABLE' => 'NONREIMBURSABLE',
        'expense_master.nonreimbursable' => 'NONREIMBURSABLE',
        'Isdaily' => 'ISDAILY',
        'ExpenseMaster.Isdaily' => 'ISDAILY',
        'isdaily' => 'ISDAILY',
        'expenseMaster.isdaily' => 'ISDAILY',
        'ExpenseMasterTableMap::COL_ISDAILY' => 'ISDAILY',
        'COL_ISDAILY' => 'ISDAILY',
        'expense_master.isdaily' => 'ISDAILY',
        'Israteapplied' => 'ISRATEAPPLIED',
        'ExpenseMaster.Israteapplied' => 'ISRATEAPPLIED',
        'israteapplied' => 'ISRATEAPPLIED',
        'expenseMaster.israteapplied' => 'ISRATEAPPLIED',
        'ExpenseMasterTableMap::COL_ISRATEAPPLIED' => 'ISRATEAPPLIED',
        'COL_ISRATEAPPLIED' => 'ISRATEAPPLIED',
        'expense_master.israteapplied' => 'ISRATEAPPLIED',
        'Rate' => 'RATE',
        'ExpenseMaster.Rate' => 'RATE',
        'rate' => 'RATE',
        'expenseMaster.rate' => 'RATE',
        'ExpenseMasterTableMap::COL_RATE' => 'RATE',
        'COL_RATE' => 'RATE',
        'expense_master.rate' => 'RATE',
        'Mode' => 'MODE',
        'ExpenseMaster.Mode' => 'MODE',
        'mode' => 'MODE',
        'expenseMaster.mode' => 'MODE',
        'ExpenseMasterTableMap::COL_MODE' => 'MODE',
        'COL_MODE' => 'MODE',
        'expense_master.mode' => 'MODE',
        'Commentreq' => 'COMMENTREQ',
        'ExpenseMaster.Commentreq' => 'COMMENTREQ',
        'commentreq' => 'COMMENTREQ',
        'expenseMaster.commentreq' => 'COMMENTREQ',
        'ExpenseMasterTableMap::COL_COMMENTREQ' => 'COMMENTREQ',
        'COL_COMMENTREQ' => 'COMMENTREQ',
        'expense_master.commentreq' => 'COMMENTREQ',
        'AdditionalText' => 'ADDITIONAL_TEXT',
        'ExpenseMaster.AdditionalText' => 'ADDITIONAL_TEXT',
        'additionalText' => 'ADDITIONAL_TEXT',
        'expenseMaster.additionalText' => 'ADDITIONAL_TEXT',
        'ExpenseMasterTableMap::COL_ADDITIONAL_TEXT' => 'ADDITIONAL_TEXT',
        'COL_ADDITIONAL_TEXT' => 'ADDITIONAL_TEXT',
        'additional_text' => 'ADDITIONAL_TEXT',
        'expense_master.additional_text' => 'ADDITIONAL_TEXT',
        'IsPrefilled' => 'IS_PREFILLED',
        'ExpenseMaster.IsPrefilled' => 'IS_PREFILLED',
        'isPrefilled' => 'IS_PREFILLED',
        'expenseMaster.isPrefilled' => 'IS_PREFILLED',
        'ExpenseMasterTableMap::COL_IS_PREFILLED' => 'IS_PREFILLED',
        'COL_IS_PREFILLED' => 'IS_PREFILLED',
        'is_prefilled' => 'IS_PREFILLED',
        'expense_master.is_prefilled' => 'IS_PREFILLED',
        'IsMandatory' => 'IS_MANDATORY',
        'ExpenseMaster.IsMandatory' => 'IS_MANDATORY',
        'isMandatory' => 'IS_MANDATORY',
        'expenseMaster.isMandatory' => 'IS_MANDATORY',
        'ExpenseMasterTableMap::COL_IS_MANDATORY' => 'IS_MANDATORY',
        'COL_IS_MANDATORY' => 'IS_MANDATORY',
        'is_mandatory' => 'IS_MANDATORY',
        'expense_master.is_mandatory' => 'IS_MANDATORY',
        'CanRepeat' => 'CAN_REPEAT',
        'ExpenseMaster.CanRepeat' => 'CAN_REPEAT',
        'canRepeat' => 'CAN_REPEAT',
        'expenseMaster.canRepeat' => 'CAN_REPEAT',
        'ExpenseMasterTableMap::COL_CAN_REPEAT' => 'CAN_REPEAT',
        'COL_CAN_REPEAT' => 'CAN_REPEAT',
        'can_repeat' => 'CAN_REPEAT',
        'expense_master.can_repeat' => 'CAN_REPEAT',
        'ExpenseTempateName' => 'EXPENSE_TEMPATE_NAME',
        'ExpenseMaster.ExpenseTempateName' => 'EXPENSE_TEMPATE_NAME',
        'expenseTempateName' => 'EXPENSE_TEMPATE_NAME',
        'expenseMaster.expenseTempateName' => 'EXPENSE_TEMPATE_NAME',
        'ExpenseMasterTableMap::COL_EXPENSE_TEMPATE_NAME' => 'EXPENSE_TEMPATE_NAME',
        'COL_EXPENSE_TEMPATE_NAME' => 'EXPENSE_TEMPATE_NAME',
        'expense_tempate_name' => 'EXPENSE_TEMPATE_NAME',
        'expense_master.expense_tempate_name' => 'EXPENSE_TEMPATE_NAME',
        'CreatedAt' => 'CREATED_AT',
        'ExpenseMaster.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'expenseMaster.createdAt' => 'CREATED_AT',
        'ExpenseMasterTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'expense_master.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'ExpenseMaster.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'expenseMaster.updatedAt' => 'UPDATED_AT',
        'ExpenseMasterTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'expense_master.updated_at' => 'UPDATED_AT',
        'IsEditable' => 'IS_EDITABLE',
        'ExpenseMaster.IsEditable' => 'IS_EDITABLE',
        'isEditable' => 'IS_EDITABLE',
        'expenseMaster.isEditable' => 'IS_EDITABLE',
        'ExpenseMasterTableMap::COL_IS_EDITABLE' => 'IS_EDITABLE',
        'COL_IS_EDITABLE' => 'IS_EDITABLE',
        'is_editable' => 'IS_EDITABLE',
        'expense_master.is_editable' => 'IS_EDITABLE',
        'AttachmentRequired' => 'ATTACHMENT_REQUIRED',
        'ExpenseMaster.AttachmentRequired' => 'ATTACHMENT_REQUIRED',
        'attachmentRequired' => 'ATTACHMENT_REQUIRED',
        'expenseMaster.attachmentRequired' => 'ATTACHMENT_REQUIRED',
        'ExpenseMasterTableMap::COL_ATTACHMENT_REQUIRED' => 'ATTACHMENT_REQUIRED',
        'COL_ATTACHMENT_REQUIRED' => 'ATTACHMENT_REQUIRED',
        'attachment_required' => 'ATTACHMENT_REQUIRED',
        'expense_master.attachment_required' => 'ATTACHMENT_REQUIRED',
        'SortOrder' => 'SORT_ORDER',
        'ExpenseMaster.SortOrder' => 'SORT_ORDER',
        'sortOrder' => 'SORT_ORDER',
        'expenseMaster.sortOrder' => 'SORT_ORDER',
        'ExpenseMasterTableMap::COL_SORT_ORDER' => 'SORT_ORDER',
        'COL_SORT_ORDER' => 'SORT_ORDER',
        'sort_order' => 'SORT_ORDER',
        'expense_master.sort_order' => 'SORT_ORDER',
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
        $this->setName('expense_master');
        $this->setPhpName('ExpenseMaster');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\ExpenseMaster');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('expense_master_expense_id_seq');
        // columns
        $this->addPrimaryKey('expense_id', 'ExpenseId', 'INTEGER', true, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, 0);
        $this->addColumn('expense_name', 'ExpenseName', 'VARCHAR', true, 250, null);
        $this->addColumn('default_policykey', 'DefaultPolicykey', 'VARCHAR', true, 50, null);
        $this->addColumn('checkcity', 'Checkcity', 'SMALLINT', false, null, null);
        $this->addColumn('policykeya', 'Policykeya', 'VARCHAR', false, 50, null);
        $this->addColumn('policykeyb', 'Policykeyb', 'VARCHAR', false, 50, null);
        $this->addColumn('policykeyc', 'Policykeyc', 'VARCHAR', false, 50, null);
        $this->addColumn('trips', 'Trips', 'SMALLINT', false, null, null);
        $this->addColumn('permonth', 'Permonth', 'SMALLINT', false, null, null);
        $this->addColumn('nonreimbursable', 'Nonreimbursable', 'SMALLINT', false, null, null);
        $this->addColumn('isdaily', 'Isdaily', 'SMALLINT', false, null, null);
        $this->addColumn('israteapplied', 'Israteapplied', 'SMALLINT', false, null, null);
        $this->addColumn('rate', 'Rate', 'VARCHAR', false, 50, null);
        $this->addColumn('mode', 'Mode', 'VARCHAR', false, 250, null);
        $this->addColumn('commentreq', 'Commentreq', 'SMALLINT', false, null, null);
        $this->addColumn('additional_text', 'AdditionalText', 'SMALLINT', false, null, null);
        $this->addColumn('is_prefilled', 'IsPrefilled', 'SMALLINT', false, null, null);
        $this->addColumn('is_mandatory', 'IsMandatory', 'SMALLINT', false, null, null);
        $this->addColumn('can_repeat', 'CanRepeat', 'SMALLINT', false, null, null);
        $this->addColumn('expense_tempate_name', 'ExpenseTempateName', 'VARCHAR', false, 100, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('is_editable', 'IsEditable', 'BOOLEAN', true, 1, false);
        $this->addColumn('attachment_required', 'AttachmentRequired', 'BOOLEAN', true, 1, false);
        $this->addColumn('sort_order', 'SortOrder', 'INTEGER', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('CompanyRelatedByCompanyId', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('BudgetExp', '\\entities\\BudgetExp', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':expense_id',
    1 => ':expense_id',
  ),
), null, null, 'BudgetExps', false);
        $this->addRelation('CompanyRelatedByAutoCalculatedTa', '\\entities\\Company', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':auto_calculated_ta',
    1 => ':expense_id',
  ),
), null, null, 'CompaniesRelatedByAutoCalculatedTa', false);
        $this->addRelation('ExpenseList', '\\entities\\ExpenseList', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':exp_master_id',
    1 => ':expense_id',
  ),
), null, null, 'ExpenseLists', false);
        $this->addRelation('ExpenseRepellent', '\\entities\\ExpenseRepellent', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':expense_id',
    1 => ':expense_id',
  ),
), null, null, 'ExpenseRepellents', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpenseId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpenseId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpenseId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpenseId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpenseId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpenseId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('ExpenseId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ExpenseMasterTableMap::CLASS_DEFAULT : ExpenseMasterTableMap::OM_CLASS;
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
     * @return array (ExpenseMaster object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ExpenseMasterTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ExpenseMasterTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ExpenseMasterTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ExpenseMasterTableMap::OM_CLASS;
            /** @var ExpenseMaster $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ExpenseMasterTableMap::addInstanceToPool($obj, $key);
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
            $key = ExpenseMasterTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ExpenseMasterTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ExpenseMaster $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ExpenseMasterTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ExpenseMasterTableMap::COL_EXPENSE_ID);
            $criteria->addSelectColumn(ExpenseMasterTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(ExpenseMasterTableMap::COL_EXPENSE_NAME);
            $criteria->addSelectColumn(ExpenseMasterTableMap::COL_DEFAULT_POLICYKEY);
            $criteria->addSelectColumn(ExpenseMasterTableMap::COL_CHECKCITY);
            $criteria->addSelectColumn(ExpenseMasterTableMap::COL_POLICYKEYA);
            $criteria->addSelectColumn(ExpenseMasterTableMap::COL_POLICYKEYB);
            $criteria->addSelectColumn(ExpenseMasterTableMap::COL_POLICYKEYC);
            $criteria->addSelectColumn(ExpenseMasterTableMap::COL_TRIPS);
            $criteria->addSelectColumn(ExpenseMasterTableMap::COL_PERMONTH);
            $criteria->addSelectColumn(ExpenseMasterTableMap::COL_NONREIMBURSABLE);
            $criteria->addSelectColumn(ExpenseMasterTableMap::COL_ISDAILY);
            $criteria->addSelectColumn(ExpenseMasterTableMap::COL_ISRATEAPPLIED);
            $criteria->addSelectColumn(ExpenseMasterTableMap::COL_RATE);
            $criteria->addSelectColumn(ExpenseMasterTableMap::COL_MODE);
            $criteria->addSelectColumn(ExpenseMasterTableMap::COL_COMMENTREQ);
            $criteria->addSelectColumn(ExpenseMasterTableMap::COL_ADDITIONAL_TEXT);
            $criteria->addSelectColumn(ExpenseMasterTableMap::COL_IS_PREFILLED);
            $criteria->addSelectColumn(ExpenseMasterTableMap::COL_IS_MANDATORY);
            $criteria->addSelectColumn(ExpenseMasterTableMap::COL_CAN_REPEAT);
            $criteria->addSelectColumn(ExpenseMasterTableMap::COL_EXPENSE_TEMPATE_NAME);
            $criteria->addSelectColumn(ExpenseMasterTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(ExpenseMasterTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(ExpenseMasterTableMap::COL_IS_EDITABLE);
            $criteria->addSelectColumn(ExpenseMasterTableMap::COL_ATTACHMENT_REQUIRED);
            $criteria->addSelectColumn(ExpenseMasterTableMap::COL_SORT_ORDER);
        } else {
            $criteria->addSelectColumn($alias . '.expense_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.expense_name');
            $criteria->addSelectColumn($alias . '.default_policykey');
            $criteria->addSelectColumn($alias . '.checkcity');
            $criteria->addSelectColumn($alias . '.policykeya');
            $criteria->addSelectColumn($alias . '.policykeyb');
            $criteria->addSelectColumn($alias . '.policykeyc');
            $criteria->addSelectColumn($alias . '.trips');
            $criteria->addSelectColumn($alias . '.permonth');
            $criteria->addSelectColumn($alias . '.nonreimbursable');
            $criteria->addSelectColumn($alias . '.isdaily');
            $criteria->addSelectColumn($alias . '.israteapplied');
            $criteria->addSelectColumn($alias . '.rate');
            $criteria->addSelectColumn($alias . '.mode');
            $criteria->addSelectColumn($alias . '.commentreq');
            $criteria->addSelectColumn($alias . '.additional_text');
            $criteria->addSelectColumn($alias . '.is_prefilled');
            $criteria->addSelectColumn($alias . '.is_mandatory');
            $criteria->addSelectColumn($alias . '.can_repeat');
            $criteria->addSelectColumn($alias . '.expense_tempate_name');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.is_editable');
            $criteria->addSelectColumn($alias . '.attachment_required');
            $criteria->addSelectColumn($alias . '.sort_order');
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
            $criteria->removeSelectColumn(ExpenseMasterTableMap::COL_EXPENSE_ID);
            $criteria->removeSelectColumn(ExpenseMasterTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(ExpenseMasterTableMap::COL_EXPENSE_NAME);
            $criteria->removeSelectColumn(ExpenseMasterTableMap::COL_DEFAULT_POLICYKEY);
            $criteria->removeSelectColumn(ExpenseMasterTableMap::COL_CHECKCITY);
            $criteria->removeSelectColumn(ExpenseMasterTableMap::COL_POLICYKEYA);
            $criteria->removeSelectColumn(ExpenseMasterTableMap::COL_POLICYKEYB);
            $criteria->removeSelectColumn(ExpenseMasterTableMap::COL_POLICYKEYC);
            $criteria->removeSelectColumn(ExpenseMasterTableMap::COL_TRIPS);
            $criteria->removeSelectColumn(ExpenseMasterTableMap::COL_PERMONTH);
            $criteria->removeSelectColumn(ExpenseMasterTableMap::COL_NONREIMBURSABLE);
            $criteria->removeSelectColumn(ExpenseMasterTableMap::COL_ISDAILY);
            $criteria->removeSelectColumn(ExpenseMasterTableMap::COL_ISRATEAPPLIED);
            $criteria->removeSelectColumn(ExpenseMasterTableMap::COL_RATE);
            $criteria->removeSelectColumn(ExpenseMasterTableMap::COL_MODE);
            $criteria->removeSelectColumn(ExpenseMasterTableMap::COL_COMMENTREQ);
            $criteria->removeSelectColumn(ExpenseMasterTableMap::COL_ADDITIONAL_TEXT);
            $criteria->removeSelectColumn(ExpenseMasterTableMap::COL_IS_PREFILLED);
            $criteria->removeSelectColumn(ExpenseMasterTableMap::COL_IS_MANDATORY);
            $criteria->removeSelectColumn(ExpenseMasterTableMap::COL_CAN_REPEAT);
            $criteria->removeSelectColumn(ExpenseMasterTableMap::COL_EXPENSE_TEMPATE_NAME);
            $criteria->removeSelectColumn(ExpenseMasterTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(ExpenseMasterTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(ExpenseMasterTableMap::COL_IS_EDITABLE);
            $criteria->removeSelectColumn(ExpenseMasterTableMap::COL_ATTACHMENT_REQUIRED);
            $criteria->removeSelectColumn(ExpenseMasterTableMap::COL_SORT_ORDER);
        } else {
            $criteria->removeSelectColumn($alias . '.expense_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.expense_name');
            $criteria->removeSelectColumn($alias . '.default_policykey');
            $criteria->removeSelectColumn($alias . '.checkcity');
            $criteria->removeSelectColumn($alias . '.policykeya');
            $criteria->removeSelectColumn($alias . '.policykeyb');
            $criteria->removeSelectColumn($alias . '.policykeyc');
            $criteria->removeSelectColumn($alias . '.trips');
            $criteria->removeSelectColumn($alias . '.permonth');
            $criteria->removeSelectColumn($alias . '.nonreimbursable');
            $criteria->removeSelectColumn($alias . '.isdaily');
            $criteria->removeSelectColumn($alias . '.israteapplied');
            $criteria->removeSelectColumn($alias . '.rate');
            $criteria->removeSelectColumn($alias . '.mode');
            $criteria->removeSelectColumn($alias . '.commentreq');
            $criteria->removeSelectColumn($alias . '.additional_text');
            $criteria->removeSelectColumn($alias . '.is_prefilled');
            $criteria->removeSelectColumn($alias . '.is_mandatory');
            $criteria->removeSelectColumn($alias . '.can_repeat');
            $criteria->removeSelectColumn($alias . '.expense_tempate_name');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.is_editable');
            $criteria->removeSelectColumn($alias . '.attachment_required');
            $criteria->removeSelectColumn($alias . '.sort_order');
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
        return Propel::getServiceContainer()->getDatabaseMap(ExpenseMasterTableMap::DATABASE_NAME)->getTable(ExpenseMasterTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a ExpenseMaster or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or ExpenseMaster object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseMasterTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\ExpenseMaster) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ExpenseMasterTableMap::DATABASE_NAME);
            $criteria->add(ExpenseMasterTableMap::COL_EXPENSE_ID, (array) $values, Criteria::IN);
        }

        $query = ExpenseMasterQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ExpenseMasterTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ExpenseMasterTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the expense_master table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ExpenseMasterQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ExpenseMaster or Criteria object.
     *
     * @param mixed $criteria Criteria or ExpenseMaster object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseMasterTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ExpenseMaster object
        }

        if ($criteria->containsKey(ExpenseMasterTableMap::COL_EXPENSE_ID) && $criteria->keyContainsValue(ExpenseMasterTableMap::COL_EXPENSE_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ExpenseMasterTableMap::COL_EXPENSE_ID.')');
        }


        // Set the correct dbName
        $query = ExpenseMasterQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
