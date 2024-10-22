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
use entities\ExpenseTemplateMaster;
use entities\ExpenseTemplateMasterQuery;


/**
 * This class defines the structure of the 'expense_template_master' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ExpenseTemplateMasterTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.ExpenseTemplateMasterTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'expense_template_master';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'ExpenseTemplateMaster';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\ExpenseTemplateMaster';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.ExpenseTemplateMaster';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 21;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 21;

    /**
     * the column name for the expense_tmpl_id field
     */
    public const COL_EXPENSE_TMPL_ID = 'expense_template_master.expense_tmpl_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'expense_template_master.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'expense_template_master.updated_at';

    /**
     * the column name for the expense_template_name field
     */
    public const COL_EXPENSE_TEMPLATE_NAME = 'expense_template_master.expense_template_name';

    /**
     * the column name for the expense_name field
     */
    public const COL_EXPENSE_NAME = 'expense_template_master.expense_name';

    /**
     * the column name for the default_policykey field
     */
    public const COL_DEFAULT_POLICYKEY = 'expense_template_master.default_policykey';

    /**
     * the column name for the checkcity field
     */
    public const COL_CHECKCITY = 'expense_template_master.checkcity';

    /**
     * the column name for the policykeya field
     */
    public const COL_POLICYKEYA = 'expense_template_master.policykeya';

    /**
     * the column name for the policykeyb field
     */
    public const COL_POLICYKEYB = 'expense_template_master.policykeyb';

    /**
     * the column name for the policykeyc field
     */
    public const COL_POLICYKEYC = 'expense_template_master.policykeyc';

    /**
     * the column name for the trips field
     */
    public const COL_TRIPS = 'expense_template_master.trips';

    /**
     * the column name for the permonth field
     */
    public const COL_PERMONTH = 'expense_template_master.permonth';

    /**
     * the column name for the nonreimbursable field
     */
    public const COL_NONREIMBURSABLE = 'expense_template_master.nonreimbursable';

    /**
     * the column name for the isdaily field
     */
    public const COL_ISDAILY = 'expense_template_master.isdaily';

    /**
     * the column name for the israteapplied field
     */
    public const COL_ISRATEAPPLIED = 'expense_template_master.israteapplied';

    /**
     * the column name for the rate field
     */
    public const COL_RATE = 'expense_template_master.rate';

    /**
     * the column name for the mode field
     */
    public const COL_MODE = 'expense_template_master.mode';

    /**
     * the column name for the commentreq field
     */
    public const COL_COMMENTREQ = 'expense_template_master.commentreq';

    /**
     * the column name for the additional_text field
     */
    public const COL_ADDITIONAL_TEXT = 'expense_template_master.additional_text';

    /**
     * the column name for the is_prefilled field
     */
    public const COL_IS_PREFILLED = 'expense_template_master.is_prefilled';

    /**
     * the column name for the is_mandatory field
     */
    public const COL_IS_MANDATORY = 'expense_template_master.is_mandatory';

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
        self::TYPE_PHPNAME       => ['ExpenseTmplId', 'CreatedAt', 'UpdatedAt', 'ExpenseTemplateName', 'ExpenseName', 'DefaultPolicykey', 'Checkcity', 'Policykeya', 'Policykeyb', 'Policykeyc', 'Trips', 'Permonth', 'Nonreimbursable', 'Isdaily', 'Israteapplied', 'Rate', 'Mode', 'Commentreq', 'AdditionalText', 'IsPrefilled', 'IsMandatory', ],
        self::TYPE_CAMELNAME     => ['expenseTmplId', 'createdAt', 'updatedAt', 'expenseTemplateName', 'expenseName', 'defaultPolicykey', 'checkcity', 'policykeya', 'policykeyb', 'policykeyc', 'trips', 'permonth', 'nonreimbursable', 'isdaily', 'israteapplied', 'rate', 'mode', 'commentreq', 'additionalText', 'isPrefilled', 'isMandatory', ],
        self::TYPE_COLNAME       => [ExpenseTemplateMasterTableMap::COL_EXPENSE_TMPL_ID, ExpenseTemplateMasterTableMap::COL_CREATED_AT, ExpenseTemplateMasterTableMap::COL_UPDATED_AT, ExpenseTemplateMasterTableMap::COL_EXPENSE_TEMPLATE_NAME, ExpenseTemplateMasterTableMap::COL_EXPENSE_NAME, ExpenseTemplateMasterTableMap::COL_DEFAULT_POLICYKEY, ExpenseTemplateMasterTableMap::COL_CHECKCITY, ExpenseTemplateMasterTableMap::COL_POLICYKEYA, ExpenseTemplateMasterTableMap::COL_POLICYKEYB, ExpenseTemplateMasterTableMap::COL_POLICYKEYC, ExpenseTemplateMasterTableMap::COL_TRIPS, ExpenseTemplateMasterTableMap::COL_PERMONTH, ExpenseTemplateMasterTableMap::COL_NONREIMBURSABLE, ExpenseTemplateMasterTableMap::COL_ISDAILY, ExpenseTemplateMasterTableMap::COL_ISRATEAPPLIED, ExpenseTemplateMasterTableMap::COL_RATE, ExpenseTemplateMasterTableMap::COL_MODE, ExpenseTemplateMasterTableMap::COL_COMMENTREQ, ExpenseTemplateMasterTableMap::COL_ADDITIONAL_TEXT, ExpenseTemplateMasterTableMap::COL_IS_PREFILLED, ExpenseTemplateMasterTableMap::COL_IS_MANDATORY, ],
        self::TYPE_FIELDNAME     => ['expense_tmpl_id', 'created_at', 'updated_at', 'expense_template_name', 'expense_name', 'default_policykey', 'checkcity', 'policykeya', 'policykeyb', 'policykeyc', 'trips', 'permonth', 'nonreimbursable', 'isdaily', 'israteapplied', 'rate', 'mode', 'commentreq', 'additional_text', 'is_prefilled', 'is_mandatory', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, ]
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
        self::TYPE_PHPNAME       => ['ExpenseTmplId' => 0, 'CreatedAt' => 1, 'UpdatedAt' => 2, 'ExpenseTemplateName' => 3, 'ExpenseName' => 4, 'DefaultPolicykey' => 5, 'Checkcity' => 6, 'Policykeya' => 7, 'Policykeyb' => 8, 'Policykeyc' => 9, 'Trips' => 10, 'Permonth' => 11, 'Nonreimbursable' => 12, 'Isdaily' => 13, 'Israteapplied' => 14, 'Rate' => 15, 'Mode' => 16, 'Commentreq' => 17, 'AdditionalText' => 18, 'IsPrefilled' => 19, 'IsMandatory' => 20, ],
        self::TYPE_CAMELNAME     => ['expenseTmplId' => 0, 'createdAt' => 1, 'updatedAt' => 2, 'expenseTemplateName' => 3, 'expenseName' => 4, 'defaultPolicykey' => 5, 'checkcity' => 6, 'policykeya' => 7, 'policykeyb' => 8, 'policykeyc' => 9, 'trips' => 10, 'permonth' => 11, 'nonreimbursable' => 12, 'isdaily' => 13, 'israteapplied' => 14, 'rate' => 15, 'mode' => 16, 'commentreq' => 17, 'additionalText' => 18, 'isPrefilled' => 19, 'isMandatory' => 20, ],
        self::TYPE_COLNAME       => [ExpenseTemplateMasterTableMap::COL_EXPENSE_TMPL_ID => 0, ExpenseTemplateMasterTableMap::COL_CREATED_AT => 1, ExpenseTemplateMasterTableMap::COL_UPDATED_AT => 2, ExpenseTemplateMasterTableMap::COL_EXPENSE_TEMPLATE_NAME => 3, ExpenseTemplateMasterTableMap::COL_EXPENSE_NAME => 4, ExpenseTemplateMasterTableMap::COL_DEFAULT_POLICYKEY => 5, ExpenseTemplateMasterTableMap::COL_CHECKCITY => 6, ExpenseTemplateMasterTableMap::COL_POLICYKEYA => 7, ExpenseTemplateMasterTableMap::COL_POLICYKEYB => 8, ExpenseTemplateMasterTableMap::COL_POLICYKEYC => 9, ExpenseTemplateMasterTableMap::COL_TRIPS => 10, ExpenseTemplateMasterTableMap::COL_PERMONTH => 11, ExpenseTemplateMasterTableMap::COL_NONREIMBURSABLE => 12, ExpenseTemplateMasterTableMap::COL_ISDAILY => 13, ExpenseTemplateMasterTableMap::COL_ISRATEAPPLIED => 14, ExpenseTemplateMasterTableMap::COL_RATE => 15, ExpenseTemplateMasterTableMap::COL_MODE => 16, ExpenseTemplateMasterTableMap::COL_COMMENTREQ => 17, ExpenseTemplateMasterTableMap::COL_ADDITIONAL_TEXT => 18, ExpenseTemplateMasterTableMap::COL_IS_PREFILLED => 19, ExpenseTemplateMasterTableMap::COL_IS_MANDATORY => 20, ],
        self::TYPE_FIELDNAME     => ['expense_tmpl_id' => 0, 'created_at' => 1, 'updated_at' => 2, 'expense_template_name' => 3, 'expense_name' => 4, 'default_policykey' => 5, 'checkcity' => 6, 'policykeya' => 7, 'policykeyb' => 8, 'policykeyc' => 9, 'trips' => 10, 'permonth' => 11, 'nonreimbursable' => 12, 'isdaily' => 13, 'israteapplied' => 14, 'rate' => 15, 'mode' => 16, 'commentreq' => 17, 'additional_text' => 18, 'is_prefilled' => 19, 'is_mandatory' => 20, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'ExpenseTmplId' => 'EXPENSE_TMPL_ID',
        'ExpenseTemplateMaster.ExpenseTmplId' => 'EXPENSE_TMPL_ID',
        'expenseTmplId' => 'EXPENSE_TMPL_ID',
        'expenseTemplateMaster.expenseTmplId' => 'EXPENSE_TMPL_ID',
        'ExpenseTemplateMasterTableMap::COL_EXPENSE_TMPL_ID' => 'EXPENSE_TMPL_ID',
        'COL_EXPENSE_TMPL_ID' => 'EXPENSE_TMPL_ID',
        'expense_tmpl_id' => 'EXPENSE_TMPL_ID',
        'expense_template_master.expense_tmpl_id' => 'EXPENSE_TMPL_ID',
        'CreatedAt' => 'CREATED_AT',
        'ExpenseTemplateMaster.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'expenseTemplateMaster.createdAt' => 'CREATED_AT',
        'ExpenseTemplateMasterTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'expense_template_master.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'ExpenseTemplateMaster.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'expenseTemplateMaster.updatedAt' => 'UPDATED_AT',
        'ExpenseTemplateMasterTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'expense_template_master.updated_at' => 'UPDATED_AT',
        'ExpenseTemplateName' => 'EXPENSE_TEMPLATE_NAME',
        'ExpenseTemplateMaster.ExpenseTemplateName' => 'EXPENSE_TEMPLATE_NAME',
        'expenseTemplateName' => 'EXPENSE_TEMPLATE_NAME',
        'expenseTemplateMaster.expenseTemplateName' => 'EXPENSE_TEMPLATE_NAME',
        'ExpenseTemplateMasterTableMap::COL_EXPENSE_TEMPLATE_NAME' => 'EXPENSE_TEMPLATE_NAME',
        'COL_EXPENSE_TEMPLATE_NAME' => 'EXPENSE_TEMPLATE_NAME',
        'expense_template_name' => 'EXPENSE_TEMPLATE_NAME',
        'expense_template_master.expense_template_name' => 'EXPENSE_TEMPLATE_NAME',
        'ExpenseName' => 'EXPENSE_NAME',
        'ExpenseTemplateMaster.ExpenseName' => 'EXPENSE_NAME',
        'expenseName' => 'EXPENSE_NAME',
        'expenseTemplateMaster.expenseName' => 'EXPENSE_NAME',
        'ExpenseTemplateMasterTableMap::COL_EXPENSE_NAME' => 'EXPENSE_NAME',
        'COL_EXPENSE_NAME' => 'EXPENSE_NAME',
        'expense_name' => 'EXPENSE_NAME',
        'expense_template_master.expense_name' => 'EXPENSE_NAME',
        'DefaultPolicykey' => 'DEFAULT_POLICYKEY',
        'ExpenseTemplateMaster.DefaultPolicykey' => 'DEFAULT_POLICYKEY',
        'defaultPolicykey' => 'DEFAULT_POLICYKEY',
        'expenseTemplateMaster.defaultPolicykey' => 'DEFAULT_POLICYKEY',
        'ExpenseTemplateMasterTableMap::COL_DEFAULT_POLICYKEY' => 'DEFAULT_POLICYKEY',
        'COL_DEFAULT_POLICYKEY' => 'DEFAULT_POLICYKEY',
        'default_policykey' => 'DEFAULT_POLICYKEY',
        'expense_template_master.default_policykey' => 'DEFAULT_POLICYKEY',
        'Checkcity' => 'CHECKCITY',
        'ExpenseTemplateMaster.Checkcity' => 'CHECKCITY',
        'checkcity' => 'CHECKCITY',
        'expenseTemplateMaster.checkcity' => 'CHECKCITY',
        'ExpenseTemplateMasterTableMap::COL_CHECKCITY' => 'CHECKCITY',
        'COL_CHECKCITY' => 'CHECKCITY',
        'expense_template_master.checkcity' => 'CHECKCITY',
        'Policykeya' => 'POLICYKEYA',
        'ExpenseTemplateMaster.Policykeya' => 'POLICYKEYA',
        'policykeya' => 'POLICYKEYA',
        'expenseTemplateMaster.policykeya' => 'POLICYKEYA',
        'ExpenseTemplateMasterTableMap::COL_POLICYKEYA' => 'POLICYKEYA',
        'COL_POLICYKEYA' => 'POLICYKEYA',
        'expense_template_master.policykeya' => 'POLICYKEYA',
        'Policykeyb' => 'POLICYKEYB',
        'ExpenseTemplateMaster.Policykeyb' => 'POLICYKEYB',
        'policykeyb' => 'POLICYKEYB',
        'expenseTemplateMaster.policykeyb' => 'POLICYKEYB',
        'ExpenseTemplateMasterTableMap::COL_POLICYKEYB' => 'POLICYKEYB',
        'COL_POLICYKEYB' => 'POLICYKEYB',
        'expense_template_master.policykeyb' => 'POLICYKEYB',
        'Policykeyc' => 'POLICYKEYC',
        'ExpenseTemplateMaster.Policykeyc' => 'POLICYKEYC',
        'policykeyc' => 'POLICYKEYC',
        'expenseTemplateMaster.policykeyc' => 'POLICYKEYC',
        'ExpenseTemplateMasterTableMap::COL_POLICYKEYC' => 'POLICYKEYC',
        'COL_POLICYKEYC' => 'POLICYKEYC',
        'expense_template_master.policykeyc' => 'POLICYKEYC',
        'Trips' => 'TRIPS',
        'ExpenseTemplateMaster.Trips' => 'TRIPS',
        'trips' => 'TRIPS',
        'expenseTemplateMaster.trips' => 'TRIPS',
        'ExpenseTemplateMasterTableMap::COL_TRIPS' => 'TRIPS',
        'COL_TRIPS' => 'TRIPS',
        'expense_template_master.trips' => 'TRIPS',
        'Permonth' => 'PERMONTH',
        'ExpenseTemplateMaster.Permonth' => 'PERMONTH',
        'permonth' => 'PERMONTH',
        'expenseTemplateMaster.permonth' => 'PERMONTH',
        'ExpenseTemplateMasterTableMap::COL_PERMONTH' => 'PERMONTH',
        'COL_PERMONTH' => 'PERMONTH',
        'expense_template_master.permonth' => 'PERMONTH',
        'Nonreimbursable' => 'NONREIMBURSABLE',
        'ExpenseTemplateMaster.Nonreimbursable' => 'NONREIMBURSABLE',
        'nonreimbursable' => 'NONREIMBURSABLE',
        'expenseTemplateMaster.nonreimbursable' => 'NONREIMBURSABLE',
        'ExpenseTemplateMasterTableMap::COL_NONREIMBURSABLE' => 'NONREIMBURSABLE',
        'COL_NONREIMBURSABLE' => 'NONREIMBURSABLE',
        'expense_template_master.nonreimbursable' => 'NONREIMBURSABLE',
        'Isdaily' => 'ISDAILY',
        'ExpenseTemplateMaster.Isdaily' => 'ISDAILY',
        'isdaily' => 'ISDAILY',
        'expenseTemplateMaster.isdaily' => 'ISDAILY',
        'ExpenseTemplateMasterTableMap::COL_ISDAILY' => 'ISDAILY',
        'COL_ISDAILY' => 'ISDAILY',
        'expense_template_master.isdaily' => 'ISDAILY',
        'Israteapplied' => 'ISRATEAPPLIED',
        'ExpenseTemplateMaster.Israteapplied' => 'ISRATEAPPLIED',
        'israteapplied' => 'ISRATEAPPLIED',
        'expenseTemplateMaster.israteapplied' => 'ISRATEAPPLIED',
        'ExpenseTemplateMasterTableMap::COL_ISRATEAPPLIED' => 'ISRATEAPPLIED',
        'COL_ISRATEAPPLIED' => 'ISRATEAPPLIED',
        'expense_template_master.israteapplied' => 'ISRATEAPPLIED',
        'Rate' => 'RATE',
        'ExpenseTemplateMaster.Rate' => 'RATE',
        'rate' => 'RATE',
        'expenseTemplateMaster.rate' => 'RATE',
        'ExpenseTemplateMasterTableMap::COL_RATE' => 'RATE',
        'COL_RATE' => 'RATE',
        'expense_template_master.rate' => 'RATE',
        'Mode' => 'MODE',
        'ExpenseTemplateMaster.Mode' => 'MODE',
        'mode' => 'MODE',
        'expenseTemplateMaster.mode' => 'MODE',
        'ExpenseTemplateMasterTableMap::COL_MODE' => 'MODE',
        'COL_MODE' => 'MODE',
        'expense_template_master.mode' => 'MODE',
        'Commentreq' => 'COMMENTREQ',
        'ExpenseTemplateMaster.Commentreq' => 'COMMENTREQ',
        'commentreq' => 'COMMENTREQ',
        'expenseTemplateMaster.commentreq' => 'COMMENTREQ',
        'ExpenseTemplateMasterTableMap::COL_COMMENTREQ' => 'COMMENTREQ',
        'COL_COMMENTREQ' => 'COMMENTREQ',
        'expense_template_master.commentreq' => 'COMMENTREQ',
        'AdditionalText' => 'ADDITIONAL_TEXT',
        'ExpenseTemplateMaster.AdditionalText' => 'ADDITIONAL_TEXT',
        'additionalText' => 'ADDITIONAL_TEXT',
        'expenseTemplateMaster.additionalText' => 'ADDITIONAL_TEXT',
        'ExpenseTemplateMasterTableMap::COL_ADDITIONAL_TEXT' => 'ADDITIONAL_TEXT',
        'COL_ADDITIONAL_TEXT' => 'ADDITIONAL_TEXT',
        'additional_text' => 'ADDITIONAL_TEXT',
        'expense_template_master.additional_text' => 'ADDITIONAL_TEXT',
        'IsPrefilled' => 'IS_PREFILLED',
        'ExpenseTemplateMaster.IsPrefilled' => 'IS_PREFILLED',
        'isPrefilled' => 'IS_PREFILLED',
        'expenseTemplateMaster.isPrefilled' => 'IS_PREFILLED',
        'ExpenseTemplateMasterTableMap::COL_IS_PREFILLED' => 'IS_PREFILLED',
        'COL_IS_PREFILLED' => 'IS_PREFILLED',
        'is_prefilled' => 'IS_PREFILLED',
        'expense_template_master.is_prefilled' => 'IS_PREFILLED',
        'IsMandatory' => 'IS_MANDATORY',
        'ExpenseTemplateMaster.IsMandatory' => 'IS_MANDATORY',
        'isMandatory' => 'IS_MANDATORY',
        'expenseTemplateMaster.isMandatory' => 'IS_MANDATORY',
        'ExpenseTemplateMasterTableMap::COL_IS_MANDATORY' => 'IS_MANDATORY',
        'COL_IS_MANDATORY' => 'IS_MANDATORY',
        'is_mandatory' => 'IS_MANDATORY',
        'expense_template_master.is_mandatory' => 'IS_MANDATORY',
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
        $this->setName('expense_template_master');
        $this->setPhpName('ExpenseTemplateMaster');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\ExpenseTemplateMaster');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('expense_template_master_expense_tmpl_id_seq');
        // columns
        $this->addPrimaryKey('expense_tmpl_id', 'ExpenseTmplId', 'INTEGER', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('expense_template_name', 'ExpenseTemplateName', 'VARCHAR', true, null, '0');
        $this->addColumn('expense_name', 'ExpenseName', 'VARCHAR', true, null, null);
        $this->addColumn('default_policykey', 'DefaultPolicykey', 'VARCHAR', true, null, null);
        $this->addColumn('checkcity', 'Checkcity', 'BOOLEAN', false, 1, null);
        $this->addColumn('policykeya', 'Policykeya', 'VARCHAR', false, null, null);
        $this->addColumn('policykeyb', 'Policykeyb', 'VARCHAR', false, null, null);
        $this->addColumn('policykeyc', 'Policykeyc', 'VARCHAR', false, null, null);
        $this->addColumn('trips', 'Trips', 'SMALLINT', false, null, null);
        $this->addColumn('permonth', 'Permonth', 'BOOLEAN', false, 1, null);
        $this->addColumn('nonreimbursable', 'Nonreimbursable', 'BOOLEAN', false, 1, null);
        $this->addColumn('isdaily', 'Isdaily', 'BOOLEAN', false, 1, null);
        $this->addColumn('israteapplied', 'Israteapplied', 'BOOLEAN', false, 1, null);
        $this->addColumn('rate', 'Rate', 'VARCHAR', false, null, null);
        $this->addColumn('mode', 'Mode', 'VARCHAR', false, null, null);
        $this->addColumn('commentreq', 'Commentreq', 'BOOLEAN', false, 1, null);
        $this->addColumn('additional_text', 'AdditionalText', 'BOOLEAN', false, 1, null);
        $this->addColumn('is_prefilled', 'IsPrefilled', 'BOOLEAN', false, 1, null);
        $this->addColumn('is_mandatory', 'IsMandatory', 'BOOLEAN', false, 1, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpenseTmplId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpenseTmplId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpenseTmplId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpenseTmplId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpenseTmplId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpenseTmplId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('ExpenseTmplId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ExpenseTemplateMasterTableMap::CLASS_DEFAULT : ExpenseTemplateMasterTableMap::OM_CLASS;
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
     * @return array (ExpenseTemplateMaster object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ExpenseTemplateMasterTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ExpenseTemplateMasterTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ExpenseTemplateMasterTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ExpenseTemplateMasterTableMap::OM_CLASS;
            /** @var ExpenseTemplateMaster $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ExpenseTemplateMasterTableMap::addInstanceToPool($obj, $key);
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
            $key = ExpenseTemplateMasterTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ExpenseTemplateMasterTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ExpenseTemplateMaster $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ExpenseTemplateMasterTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ExpenseTemplateMasterTableMap::COL_EXPENSE_TMPL_ID);
            $criteria->addSelectColumn(ExpenseTemplateMasterTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(ExpenseTemplateMasterTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(ExpenseTemplateMasterTableMap::COL_EXPENSE_TEMPLATE_NAME);
            $criteria->addSelectColumn(ExpenseTemplateMasterTableMap::COL_EXPENSE_NAME);
            $criteria->addSelectColumn(ExpenseTemplateMasterTableMap::COL_DEFAULT_POLICYKEY);
            $criteria->addSelectColumn(ExpenseTemplateMasterTableMap::COL_CHECKCITY);
            $criteria->addSelectColumn(ExpenseTemplateMasterTableMap::COL_POLICYKEYA);
            $criteria->addSelectColumn(ExpenseTemplateMasterTableMap::COL_POLICYKEYB);
            $criteria->addSelectColumn(ExpenseTemplateMasterTableMap::COL_POLICYKEYC);
            $criteria->addSelectColumn(ExpenseTemplateMasterTableMap::COL_TRIPS);
            $criteria->addSelectColumn(ExpenseTemplateMasterTableMap::COL_PERMONTH);
            $criteria->addSelectColumn(ExpenseTemplateMasterTableMap::COL_NONREIMBURSABLE);
            $criteria->addSelectColumn(ExpenseTemplateMasterTableMap::COL_ISDAILY);
            $criteria->addSelectColumn(ExpenseTemplateMasterTableMap::COL_ISRATEAPPLIED);
            $criteria->addSelectColumn(ExpenseTemplateMasterTableMap::COL_RATE);
            $criteria->addSelectColumn(ExpenseTemplateMasterTableMap::COL_MODE);
            $criteria->addSelectColumn(ExpenseTemplateMasterTableMap::COL_COMMENTREQ);
            $criteria->addSelectColumn(ExpenseTemplateMasterTableMap::COL_ADDITIONAL_TEXT);
            $criteria->addSelectColumn(ExpenseTemplateMasterTableMap::COL_IS_PREFILLED);
            $criteria->addSelectColumn(ExpenseTemplateMasterTableMap::COL_IS_MANDATORY);
        } else {
            $criteria->addSelectColumn($alias . '.expense_tmpl_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.expense_template_name');
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
            $criteria->removeSelectColumn(ExpenseTemplateMasterTableMap::COL_EXPENSE_TMPL_ID);
            $criteria->removeSelectColumn(ExpenseTemplateMasterTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(ExpenseTemplateMasterTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(ExpenseTemplateMasterTableMap::COL_EXPENSE_TEMPLATE_NAME);
            $criteria->removeSelectColumn(ExpenseTemplateMasterTableMap::COL_EXPENSE_NAME);
            $criteria->removeSelectColumn(ExpenseTemplateMasterTableMap::COL_DEFAULT_POLICYKEY);
            $criteria->removeSelectColumn(ExpenseTemplateMasterTableMap::COL_CHECKCITY);
            $criteria->removeSelectColumn(ExpenseTemplateMasterTableMap::COL_POLICYKEYA);
            $criteria->removeSelectColumn(ExpenseTemplateMasterTableMap::COL_POLICYKEYB);
            $criteria->removeSelectColumn(ExpenseTemplateMasterTableMap::COL_POLICYKEYC);
            $criteria->removeSelectColumn(ExpenseTemplateMasterTableMap::COL_TRIPS);
            $criteria->removeSelectColumn(ExpenseTemplateMasterTableMap::COL_PERMONTH);
            $criteria->removeSelectColumn(ExpenseTemplateMasterTableMap::COL_NONREIMBURSABLE);
            $criteria->removeSelectColumn(ExpenseTemplateMasterTableMap::COL_ISDAILY);
            $criteria->removeSelectColumn(ExpenseTemplateMasterTableMap::COL_ISRATEAPPLIED);
            $criteria->removeSelectColumn(ExpenseTemplateMasterTableMap::COL_RATE);
            $criteria->removeSelectColumn(ExpenseTemplateMasterTableMap::COL_MODE);
            $criteria->removeSelectColumn(ExpenseTemplateMasterTableMap::COL_COMMENTREQ);
            $criteria->removeSelectColumn(ExpenseTemplateMasterTableMap::COL_ADDITIONAL_TEXT);
            $criteria->removeSelectColumn(ExpenseTemplateMasterTableMap::COL_IS_PREFILLED);
            $criteria->removeSelectColumn(ExpenseTemplateMasterTableMap::COL_IS_MANDATORY);
        } else {
            $criteria->removeSelectColumn($alias . '.expense_tmpl_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.expense_template_name');
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
        return Propel::getServiceContainer()->getDatabaseMap(ExpenseTemplateMasterTableMap::DATABASE_NAME)->getTable(ExpenseTemplateMasterTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a ExpenseTemplateMaster or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or ExpenseTemplateMaster object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseTemplateMasterTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\ExpenseTemplateMaster) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ExpenseTemplateMasterTableMap::DATABASE_NAME);
            $criteria->add(ExpenseTemplateMasterTableMap::COL_EXPENSE_TMPL_ID, (array) $values, Criteria::IN);
        }

        $query = ExpenseTemplateMasterQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ExpenseTemplateMasterTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ExpenseTemplateMasterTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the expense_template_master table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ExpenseTemplateMasterQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ExpenseTemplateMaster or Criteria object.
     *
     * @param mixed $criteria Criteria or ExpenseTemplateMaster object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseTemplateMasterTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ExpenseTemplateMaster object
        }

        if ($criteria->containsKey(ExpenseTemplateMasterTableMap::COL_EXPENSE_TMPL_ID) && $criteria->keyContainsValue(ExpenseTemplateMasterTableMap::COL_EXPENSE_TMPL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ExpenseTemplateMasterTableMap::COL_EXPENSE_TMPL_ID.')');
        }


        // Set the correct dbName
        $query = ExpenseTemplateMasterQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
