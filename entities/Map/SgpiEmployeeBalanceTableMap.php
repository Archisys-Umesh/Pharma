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
use entities\SgpiEmployeeBalance;
use entities\SgpiEmployeeBalanceQuery;


/**
 * This class defines the structure of the 'sgpi_employee_balance' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SgpiEmployeeBalanceTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.SgpiEmployeeBalanceTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'sgpi_employee_balance';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SgpiEmployeeBalance';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\SgpiEmployeeBalance';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.SgpiEmployeeBalance';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 17;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 17;

    /**
     * the column name for the uniquecode field
     */
    public const COL_UNIQUECODE = 'sgpi_employee_balance.uniquecode';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'sgpi_employee_balance.employee_id';

    /**
     * the column name for the sgpi_account_id field
     */
    public const COL_SGPI_ACCOUNT_ID = 'sgpi_employee_balance.sgpi_account_id';

    /**
     * the column name for the sgpi_id field
     */
    public const COL_SGPI_ID = 'sgpi_employee_balance.sgpi_id';

    /**
     * the column name for the sgpi_media field
     */
    public const COL_SGPI_MEDIA = 'sgpi_employee_balance.sgpi_media';

    /**
     * the column name for the sgpi_name field
     */
    public const COL_SGPI_NAME = 'sgpi_employee_balance.sgpi_name';

    /**
     * the column name for the sgpi_type field
     */
    public const COL_SGPI_TYPE = 'sgpi_employee_balance.sgpi_type';

    /**
     * the column name for the use_start_date field
     */
    public const COL_USE_START_DATE = 'sgpi_employee_balance.use_start_date';

    /**
     * the column name for the use_end_date field
     */
    public const COL_USE_END_DATE = 'sgpi_employee_balance.use_end_date';

    /**
     * the column name for the max_qty field
     */
    public const COL_MAX_QTY = 'sgpi_employee_balance.max_qty';

    /**
     * the column name for the balance field
     */
    public const COL_BALANCE = 'sgpi_employee_balance.balance';

    /**
     * the column name for the credits field
     */
    public const COL_CREDITS = 'sgpi_employee_balance.credits';

    /**
     * the column name for the debits field
     */
    public const COL_DEBITS = 'sgpi_employee_balance.debits';

    /**
     * the column name for the moye field
     */
    public const COL_MOYE = 'sgpi_employee_balance.moye';

    /**
     * the column name for the brand_id field
     */
    public const COL_BRAND_ID = 'sgpi_employee_balance.brand_id';

    /**
     * the column name for the outlettype_id field
     */
    public const COL_OUTLETTYPE_ID = 'sgpi_employee_balance.outlettype_id';

    /**
     * the column name for the is_strategic field
     */
    public const COL_IS_STRATEGIC = 'sgpi_employee_balance.is_strategic';

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
        self::TYPE_PHPNAME       => ['Uniquecode', 'EmployeeId', 'SgpiAccountId', 'SgpiId', 'SgpiMedia', 'SgpiName', 'SgpiType', 'UseStartDate', 'UseEndDate', 'MaxQty', 'Balance', 'Credits', 'Debits', 'Moye', 'BrandId', 'OutlettypeId', 'IsStrategic', ],
        self::TYPE_CAMELNAME     => ['uniquecode', 'employeeId', 'sgpiAccountId', 'sgpiId', 'sgpiMedia', 'sgpiName', 'sgpiType', 'useStartDate', 'useEndDate', 'maxQty', 'balance', 'credits', 'debits', 'moye', 'brandId', 'outlettypeId', 'isStrategic', ],
        self::TYPE_COLNAME       => [SgpiEmployeeBalanceTableMap::COL_UNIQUECODE, SgpiEmployeeBalanceTableMap::COL_EMPLOYEE_ID, SgpiEmployeeBalanceTableMap::COL_SGPI_ACCOUNT_ID, SgpiEmployeeBalanceTableMap::COL_SGPI_ID, SgpiEmployeeBalanceTableMap::COL_SGPI_MEDIA, SgpiEmployeeBalanceTableMap::COL_SGPI_NAME, SgpiEmployeeBalanceTableMap::COL_SGPI_TYPE, SgpiEmployeeBalanceTableMap::COL_USE_START_DATE, SgpiEmployeeBalanceTableMap::COL_USE_END_DATE, SgpiEmployeeBalanceTableMap::COL_MAX_QTY, SgpiEmployeeBalanceTableMap::COL_BALANCE, SgpiEmployeeBalanceTableMap::COL_CREDITS, SgpiEmployeeBalanceTableMap::COL_DEBITS, SgpiEmployeeBalanceTableMap::COL_MOYE, SgpiEmployeeBalanceTableMap::COL_BRAND_ID, SgpiEmployeeBalanceTableMap::COL_OUTLETTYPE_ID, SgpiEmployeeBalanceTableMap::COL_IS_STRATEGIC, ],
        self::TYPE_FIELDNAME     => ['uniquecode', 'employee_id', 'sgpi_account_id', 'sgpi_id', 'sgpi_media', 'sgpi_name', 'sgpi_type', 'use_start_date', 'use_end_date', 'max_qty', 'balance', 'credits', 'debits', 'moye', 'brand_id', 'outlettype_id', 'is_strategic', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, ]
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
        self::TYPE_PHPNAME       => ['Uniquecode' => 0, 'EmployeeId' => 1, 'SgpiAccountId' => 2, 'SgpiId' => 3, 'SgpiMedia' => 4, 'SgpiName' => 5, 'SgpiType' => 6, 'UseStartDate' => 7, 'UseEndDate' => 8, 'MaxQty' => 9, 'Balance' => 10, 'Credits' => 11, 'Debits' => 12, 'Moye' => 13, 'BrandId' => 14, 'OutlettypeId' => 15, 'IsStrategic' => 16, ],
        self::TYPE_CAMELNAME     => ['uniquecode' => 0, 'employeeId' => 1, 'sgpiAccountId' => 2, 'sgpiId' => 3, 'sgpiMedia' => 4, 'sgpiName' => 5, 'sgpiType' => 6, 'useStartDate' => 7, 'useEndDate' => 8, 'maxQty' => 9, 'balance' => 10, 'credits' => 11, 'debits' => 12, 'moye' => 13, 'brandId' => 14, 'outlettypeId' => 15, 'isStrategic' => 16, ],
        self::TYPE_COLNAME       => [SgpiEmployeeBalanceTableMap::COL_UNIQUECODE => 0, SgpiEmployeeBalanceTableMap::COL_EMPLOYEE_ID => 1, SgpiEmployeeBalanceTableMap::COL_SGPI_ACCOUNT_ID => 2, SgpiEmployeeBalanceTableMap::COL_SGPI_ID => 3, SgpiEmployeeBalanceTableMap::COL_SGPI_MEDIA => 4, SgpiEmployeeBalanceTableMap::COL_SGPI_NAME => 5, SgpiEmployeeBalanceTableMap::COL_SGPI_TYPE => 6, SgpiEmployeeBalanceTableMap::COL_USE_START_DATE => 7, SgpiEmployeeBalanceTableMap::COL_USE_END_DATE => 8, SgpiEmployeeBalanceTableMap::COL_MAX_QTY => 9, SgpiEmployeeBalanceTableMap::COL_BALANCE => 10, SgpiEmployeeBalanceTableMap::COL_CREDITS => 11, SgpiEmployeeBalanceTableMap::COL_DEBITS => 12, SgpiEmployeeBalanceTableMap::COL_MOYE => 13, SgpiEmployeeBalanceTableMap::COL_BRAND_ID => 14, SgpiEmployeeBalanceTableMap::COL_OUTLETTYPE_ID => 15, SgpiEmployeeBalanceTableMap::COL_IS_STRATEGIC => 16, ],
        self::TYPE_FIELDNAME     => ['uniquecode' => 0, 'employee_id' => 1, 'sgpi_account_id' => 2, 'sgpi_id' => 3, 'sgpi_media' => 4, 'sgpi_name' => 5, 'sgpi_type' => 6, 'use_start_date' => 7, 'use_end_date' => 8, 'max_qty' => 9, 'balance' => 10, 'credits' => 11, 'debits' => 12, 'moye' => 13, 'brand_id' => 14, 'outlettype_id' => 15, 'is_strategic' => 16, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Uniquecode' => 'UNIQUECODE',
        'SgpiEmployeeBalance.Uniquecode' => 'UNIQUECODE',
        'uniquecode' => 'UNIQUECODE',
        'sgpiEmployeeBalance.uniquecode' => 'UNIQUECODE',
        'SgpiEmployeeBalanceTableMap::COL_UNIQUECODE' => 'UNIQUECODE',
        'COL_UNIQUECODE' => 'UNIQUECODE',
        'sgpi_employee_balance.uniquecode' => 'UNIQUECODE',
        'EmployeeId' => 'EMPLOYEE_ID',
        'SgpiEmployeeBalance.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'sgpiEmployeeBalance.employeeId' => 'EMPLOYEE_ID',
        'SgpiEmployeeBalanceTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'sgpi_employee_balance.employee_id' => 'EMPLOYEE_ID',
        'SgpiAccountId' => 'SGPI_ACCOUNT_ID',
        'SgpiEmployeeBalance.SgpiAccountId' => 'SGPI_ACCOUNT_ID',
        'sgpiAccountId' => 'SGPI_ACCOUNT_ID',
        'sgpiEmployeeBalance.sgpiAccountId' => 'SGPI_ACCOUNT_ID',
        'SgpiEmployeeBalanceTableMap::COL_SGPI_ACCOUNT_ID' => 'SGPI_ACCOUNT_ID',
        'COL_SGPI_ACCOUNT_ID' => 'SGPI_ACCOUNT_ID',
        'sgpi_account_id' => 'SGPI_ACCOUNT_ID',
        'sgpi_employee_balance.sgpi_account_id' => 'SGPI_ACCOUNT_ID',
        'SgpiId' => 'SGPI_ID',
        'SgpiEmployeeBalance.SgpiId' => 'SGPI_ID',
        'sgpiId' => 'SGPI_ID',
        'sgpiEmployeeBalance.sgpiId' => 'SGPI_ID',
        'SgpiEmployeeBalanceTableMap::COL_SGPI_ID' => 'SGPI_ID',
        'COL_SGPI_ID' => 'SGPI_ID',
        'sgpi_id' => 'SGPI_ID',
        'sgpi_employee_balance.sgpi_id' => 'SGPI_ID',
        'SgpiMedia' => 'SGPI_MEDIA',
        'SgpiEmployeeBalance.SgpiMedia' => 'SGPI_MEDIA',
        'sgpiMedia' => 'SGPI_MEDIA',
        'sgpiEmployeeBalance.sgpiMedia' => 'SGPI_MEDIA',
        'SgpiEmployeeBalanceTableMap::COL_SGPI_MEDIA' => 'SGPI_MEDIA',
        'COL_SGPI_MEDIA' => 'SGPI_MEDIA',
        'sgpi_media' => 'SGPI_MEDIA',
        'sgpi_employee_balance.sgpi_media' => 'SGPI_MEDIA',
        'SgpiName' => 'SGPI_NAME',
        'SgpiEmployeeBalance.SgpiName' => 'SGPI_NAME',
        'sgpiName' => 'SGPI_NAME',
        'sgpiEmployeeBalance.sgpiName' => 'SGPI_NAME',
        'SgpiEmployeeBalanceTableMap::COL_SGPI_NAME' => 'SGPI_NAME',
        'COL_SGPI_NAME' => 'SGPI_NAME',
        'sgpi_name' => 'SGPI_NAME',
        'sgpi_employee_balance.sgpi_name' => 'SGPI_NAME',
        'SgpiType' => 'SGPI_TYPE',
        'SgpiEmployeeBalance.SgpiType' => 'SGPI_TYPE',
        'sgpiType' => 'SGPI_TYPE',
        'sgpiEmployeeBalance.sgpiType' => 'SGPI_TYPE',
        'SgpiEmployeeBalanceTableMap::COL_SGPI_TYPE' => 'SGPI_TYPE',
        'COL_SGPI_TYPE' => 'SGPI_TYPE',
        'sgpi_type' => 'SGPI_TYPE',
        'sgpi_employee_balance.sgpi_type' => 'SGPI_TYPE',
        'UseStartDate' => 'USE_START_DATE',
        'SgpiEmployeeBalance.UseStartDate' => 'USE_START_DATE',
        'useStartDate' => 'USE_START_DATE',
        'sgpiEmployeeBalance.useStartDate' => 'USE_START_DATE',
        'SgpiEmployeeBalanceTableMap::COL_USE_START_DATE' => 'USE_START_DATE',
        'COL_USE_START_DATE' => 'USE_START_DATE',
        'use_start_date' => 'USE_START_DATE',
        'sgpi_employee_balance.use_start_date' => 'USE_START_DATE',
        'UseEndDate' => 'USE_END_DATE',
        'SgpiEmployeeBalance.UseEndDate' => 'USE_END_DATE',
        'useEndDate' => 'USE_END_DATE',
        'sgpiEmployeeBalance.useEndDate' => 'USE_END_DATE',
        'SgpiEmployeeBalanceTableMap::COL_USE_END_DATE' => 'USE_END_DATE',
        'COL_USE_END_DATE' => 'USE_END_DATE',
        'use_end_date' => 'USE_END_DATE',
        'sgpi_employee_balance.use_end_date' => 'USE_END_DATE',
        'MaxQty' => 'MAX_QTY',
        'SgpiEmployeeBalance.MaxQty' => 'MAX_QTY',
        'maxQty' => 'MAX_QTY',
        'sgpiEmployeeBalance.maxQty' => 'MAX_QTY',
        'SgpiEmployeeBalanceTableMap::COL_MAX_QTY' => 'MAX_QTY',
        'COL_MAX_QTY' => 'MAX_QTY',
        'max_qty' => 'MAX_QTY',
        'sgpi_employee_balance.max_qty' => 'MAX_QTY',
        'Balance' => 'BALANCE',
        'SgpiEmployeeBalance.Balance' => 'BALANCE',
        'balance' => 'BALANCE',
        'sgpiEmployeeBalance.balance' => 'BALANCE',
        'SgpiEmployeeBalanceTableMap::COL_BALANCE' => 'BALANCE',
        'COL_BALANCE' => 'BALANCE',
        'sgpi_employee_balance.balance' => 'BALANCE',
        'Credits' => 'CREDITS',
        'SgpiEmployeeBalance.Credits' => 'CREDITS',
        'credits' => 'CREDITS',
        'sgpiEmployeeBalance.credits' => 'CREDITS',
        'SgpiEmployeeBalanceTableMap::COL_CREDITS' => 'CREDITS',
        'COL_CREDITS' => 'CREDITS',
        'sgpi_employee_balance.credits' => 'CREDITS',
        'Debits' => 'DEBITS',
        'SgpiEmployeeBalance.Debits' => 'DEBITS',
        'debits' => 'DEBITS',
        'sgpiEmployeeBalance.debits' => 'DEBITS',
        'SgpiEmployeeBalanceTableMap::COL_DEBITS' => 'DEBITS',
        'COL_DEBITS' => 'DEBITS',
        'sgpi_employee_balance.debits' => 'DEBITS',
        'Moye' => 'MOYE',
        'SgpiEmployeeBalance.Moye' => 'MOYE',
        'moye' => 'MOYE',
        'sgpiEmployeeBalance.moye' => 'MOYE',
        'SgpiEmployeeBalanceTableMap::COL_MOYE' => 'MOYE',
        'COL_MOYE' => 'MOYE',
        'sgpi_employee_balance.moye' => 'MOYE',
        'BrandId' => 'BRAND_ID',
        'SgpiEmployeeBalance.BrandId' => 'BRAND_ID',
        'brandId' => 'BRAND_ID',
        'sgpiEmployeeBalance.brandId' => 'BRAND_ID',
        'SgpiEmployeeBalanceTableMap::COL_BRAND_ID' => 'BRAND_ID',
        'COL_BRAND_ID' => 'BRAND_ID',
        'brand_id' => 'BRAND_ID',
        'sgpi_employee_balance.brand_id' => 'BRAND_ID',
        'OutlettypeId' => 'OUTLETTYPE_ID',
        'SgpiEmployeeBalance.OutlettypeId' => 'OUTLETTYPE_ID',
        'outlettypeId' => 'OUTLETTYPE_ID',
        'sgpiEmployeeBalance.outlettypeId' => 'OUTLETTYPE_ID',
        'SgpiEmployeeBalanceTableMap::COL_OUTLETTYPE_ID' => 'OUTLETTYPE_ID',
        'COL_OUTLETTYPE_ID' => 'OUTLETTYPE_ID',
        'outlettype_id' => 'OUTLETTYPE_ID',
        'sgpi_employee_balance.outlettype_id' => 'OUTLETTYPE_ID',
        'IsStrategic' => 'IS_STRATEGIC',
        'SgpiEmployeeBalance.IsStrategic' => 'IS_STRATEGIC',
        'isStrategic' => 'IS_STRATEGIC',
        'sgpiEmployeeBalance.isStrategic' => 'IS_STRATEGIC',
        'SgpiEmployeeBalanceTableMap::COL_IS_STRATEGIC' => 'IS_STRATEGIC',
        'COL_IS_STRATEGIC' => 'IS_STRATEGIC',
        'is_strategic' => 'IS_STRATEGIC',
        'sgpi_employee_balance.is_strategic' => 'IS_STRATEGIC',
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
        $this->setName('sgpi_employee_balance');
        $this->setPhpName('SgpiEmployeeBalance');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\SgpiEmployeeBalance');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('uniquecode', 'Uniquecode', 'VARCHAR', true, 50, null);
        $this->addColumn('employee_id', 'EmployeeId', 'INTEGER', false, null, null);
        $this->addColumn('sgpi_account_id', 'SgpiAccountId', 'INTEGER', false, null, null);
        $this->addColumn('sgpi_id', 'SgpiId', 'INTEGER', false, null, null);
        $this->addColumn('sgpi_media', 'SgpiMedia', 'INTEGER', false, null, null);
        $this->addColumn('sgpi_name', 'SgpiName', 'VARCHAR', false, 50, null);
        $this->addColumn('sgpi_type', 'SgpiType', 'VARCHAR', false, 50, null);
        $this->addColumn('use_start_date', 'UseStartDate', 'TIMESTAMP', false, null, null);
        $this->addColumn('use_end_date', 'UseEndDate', 'TIMESTAMP', false, null, null);
        $this->addColumn('max_qty', 'MaxQty', 'INTEGER', false, null, null);
        $this->addColumn('balance', 'Balance', 'INTEGER', false, null, null);
        $this->addColumn('credits', 'Credits', 'INTEGER', false, null, null);
        $this->addColumn('debits', 'Debits', 'INTEGER', false, null, null);
        $this->addColumn('moye', 'Moye', 'VARCHAR', false, 50, null);
        $this->addColumn('brand_id', 'BrandId', 'INTEGER', false, null, null);
        $this->addColumn('outlettype_id', 'OutlettypeId', 'INTEGER', false, null, null);
        $this->addColumn('is_strategic', 'IsStrategic', 'BOOLEAN', false, 1, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniquecode', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniquecode', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniquecode', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniquecode', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniquecode', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniquecode', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Uniquecode', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SgpiEmployeeBalanceTableMap::CLASS_DEFAULT : SgpiEmployeeBalanceTableMap::OM_CLASS;
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
     * @return array (SgpiEmployeeBalance object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SgpiEmployeeBalanceTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SgpiEmployeeBalanceTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SgpiEmployeeBalanceTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SgpiEmployeeBalanceTableMap::OM_CLASS;
            /** @var SgpiEmployeeBalance $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SgpiEmployeeBalanceTableMap::addInstanceToPool($obj, $key);
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
            $key = SgpiEmployeeBalanceTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SgpiEmployeeBalanceTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SgpiEmployeeBalance $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SgpiEmployeeBalanceTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SgpiEmployeeBalanceTableMap::COL_UNIQUECODE);
            $criteria->addSelectColumn(SgpiEmployeeBalanceTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(SgpiEmployeeBalanceTableMap::COL_SGPI_ACCOUNT_ID);
            $criteria->addSelectColumn(SgpiEmployeeBalanceTableMap::COL_SGPI_ID);
            $criteria->addSelectColumn(SgpiEmployeeBalanceTableMap::COL_SGPI_MEDIA);
            $criteria->addSelectColumn(SgpiEmployeeBalanceTableMap::COL_SGPI_NAME);
            $criteria->addSelectColumn(SgpiEmployeeBalanceTableMap::COL_SGPI_TYPE);
            $criteria->addSelectColumn(SgpiEmployeeBalanceTableMap::COL_USE_START_DATE);
            $criteria->addSelectColumn(SgpiEmployeeBalanceTableMap::COL_USE_END_DATE);
            $criteria->addSelectColumn(SgpiEmployeeBalanceTableMap::COL_MAX_QTY);
            $criteria->addSelectColumn(SgpiEmployeeBalanceTableMap::COL_BALANCE);
            $criteria->addSelectColumn(SgpiEmployeeBalanceTableMap::COL_CREDITS);
            $criteria->addSelectColumn(SgpiEmployeeBalanceTableMap::COL_DEBITS);
            $criteria->addSelectColumn(SgpiEmployeeBalanceTableMap::COL_MOYE);
            $criteria->addSelectColumn(SgpiEmployeeBalanceTableMap::COL_BRAND_ID);
            $criteria->addSelectColumn(SgpiEmployeeBalanceTableMap::COL_OUTLETTYPE_ID);
            $criteria->addSelectColumn(SgpiEmployeeBalanceTableMap::COL_IS_STRATEGIC);
        } else {
            $criteria->addSelectColumn($alias . '.uniquecode');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.sgpi_account_id');
            $criteria->addSelectColumn($alias . '.sgpi_id');
            $criteria->addSelectColumn($alias . '.sgpi_media');
            $criteria->addSelectColumn($alias . '.sgpi_name');
            $criteria->addSelectColumn($alias . '.sgpi_type');
            $criteria->addSelectColumn($alias . '.use_start_date');
            $criteria->addSelectColumn($alias . '.use_end_date');
            $criteria->addSelectColumn($alias . '.max_qty');
            $criteria->addSelectColumn($alias . '.balance');
            $criteria->addSelectColumn($alias . '.credits');
            $criteria->addSelectColumn($alias . '.debits');
            $criteria->addSelectColumn($alias . '.moye');
            $criteria->addSelectColumn($alias . '.brand_id');
            $criteria->addSelectColumn($alias . '.outlettype_id');
            $criteria->addSelectColumn($alias . '.is_strategic');
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
            $criteria->removeSelectColumn(SgpiEmployeeBalanceTableMap::COL_UNIQUECODE);
            $criteria->removeSelectColumn(SgpiEmployeeBalanceTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(SgpiEmployeeBalanceTableMap::COL_SGPI_ACCOUNT_ID);
            $criteria->removeSelectColumn(SgpiEmployeeBalanceTableMap::COL_SGPI_ID);
            $criteria->removeSelectColumn(SgpiEmployeeBalanceTableMap::COL_SGPI_MEDIA);
            $criteria->removeSelectColumn(SgpiEmployeeBalanceTableMap::COL_SGPI_NAME);
            $criteria->removeSelectColumn(SgpiEmployeeBalanceTableMap::COL_SGPI_TYPE);
            $criteria->removeSelectColumn(SgpiEmployeeBalanceTableMap::COL_USE_START_DATE);
            $criteria->removeSelectColumn(SgpiEmployeeBalanceTableMap::COL_USE_END_DATE);
            $criteria->removeSelectColumn(SgpiEmployeeBalanceTableMap::COL_MAX_QTY);
            $criteria->removeSelectColumn(SgpiEmployeeBalanceTableMap::COL_BALANCE);
            $criteria->removeSelectColumn(SgpiEmployeeBalanceTableMap::COL_CREDITS);
            $criteria->removeSelectColumn(SgpiEmployeeBalanceTableMap::COL_DEBITS);
            $criteria->removeSelectColumn(SgpiEmployeeBalanceTableMap::COL_MOYE);
            $criteria->removeSelectColumn(SgpiEmployeeBalanceTableMap::COL_BRAND_ID);
            $criteria->removeSelectColumn(SgpiEmployeeBalanceTableMap::COL_OUTLETTYPE_ID);
            $criteria->removeSelectColumn(SgpiEmployeeBalanceTableMap::COL_IS_STRATEGIC);
        } else {
            $criteria->removeSelectColumn($alias . '.uniquecode');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.sgpi_account_id');
            $criteria->removeSelectColumn($alias . '.sgpi_id');
            $criteria->removeSelectColumn($alias . '.sgpi_media');
            $criteria->removeSelectColumn($alias . '.sgpi_name');
            $criteria->removeSelectColumn($alias . '.sgpi_type');
            $criteria->removeSelectColumn($alias . '.use_start_date');
            $criteria->removeSelectColumn($alias . '.use_end_date');
            $criteria->removeSelectColumn($alias . '.max_qty');
            $criteria->removeSelectColumn($alias . '.balance');
            $criteria->removeSelectColumn($alias . '.credits');
            $criteria->removeSelectColumn($alias . '.debits');
            $criteria->removeSelectColumn($alias . '.moye');
            $criteria->removeSelectColumn($alias . '.brand_id');
            $criteria->removeSelectColumn($alias . '.outlettype_id');
            $criteria->removeSelectColumn($alias . '.is_strategic');
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
        return Propel::getServiceContainer()->getDatabaseMap(SgpiEmployeeBalanceTableMap::DATABASE_NAME)->getTable(SgpiEmployeeBalanceTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SgpiEmployeeBalance or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SgpiEmployeeBalance object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SgpiEmployeeBalanceTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\SgpiEmployeeBalance) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SgpiEmployeeBalanceTableMap::DATABASE_NAME);
            $criteria->add(SgpiEmployeeBalanceTableMap::COL_UNIQUECODE, (array) $values, Criteria::IN);
        }

        $query = SgpiEmployeeBalanceQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SgpiEmployeeBalanceTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SgpiEmployeeBalanceTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sgpi_employee_balance table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SgpiEmployeeBalanceQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SgpiEmployeeBalance or Criteria object.
     *
     * @param mixed $criteria Criteria or SgpiEmployeeBalance object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SgpiEmployeeBalanceTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SgpiEmployeeBalance object
        }


        // Set the correct dbName
        $query = SgpiEmployeeBalanceQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
