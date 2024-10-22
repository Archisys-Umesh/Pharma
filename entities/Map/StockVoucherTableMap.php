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
use entities\StockVoucher;
use entities\StockVoucherQuery;


/**
 * This class defines the structure of the 'stock_voucher' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class StockVoucherTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.StockVoucherTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'stock_voucher';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'StockVoucher';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\StockVoucher';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.StockVoucher';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the svid field
     */
    public const COL_SVID = 'stock_voucher.svid';

    /**
     * the column name for the sv_user_id field
     */
    public const COL_SV_USER_ID = 'stock_voucher.sv_user_id';

    /**
     * the column name for the sv_date field
     */
    public const COL_SV_DATE = 'stock_voucher.sv_date';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'stock_voucher.company_id';

    /**
     * the column name for the sv_remark field
     */
    public const COL_SV_REMARK = 'stock_voucher.sv_remark';

    /**
     * the column name for the sv_desc field
     */
    public const COL_SV_DESC = 'stock_voucher.sv_desc';

    /**
     * the column name for the sv_type field
     */
    public const COL_SV_TYPE = 'stock_voucher.sv_type';

    /**
     * the column name for the total_qty field
     */
    public const COL_TOTAL_QTY = 'stock_voucher.total_qty';

    /**
     * the column name for the sv_error field
     */
    public const COL_SV_ERROR = 'stock_voucher.sv_error';

    /**
     * the column name for the sv_status field
     */
    public const COL_SV_STATUS = 'stock_voucher.sv_status';

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
        self::TYPE_PHPNAME       => ['Svid', 'SvUserId', 'SvDate', 'CompanyId', 'SvRemark', 'SvDesc', 'SvType', 'TotalQty', 'SvError', 'SvStatus', ],
        self::TYPE_CAMELNAME     => ['svid', 'svUserId', 'svDate', 'companyId', 'svRemark', 'svDesc', 'svType', 'totalQty', 'svError', 'svStatus', ],
        self::TYPE_COLNAME       => [StockVoucherTableMap::COL_SVID, StockVoucherTableMap::COL_SV_USER_ID, StockVoucherTableMap::COL_SV_DATE, StockVoucherTableMap::COL_COMPANY_ID, StockVoucherTableMap::COL_SV_REMARK, StockVoucherTableMap::COL_SV_DESC, StockVoucherTableMap::COL_SV_TYPE, StockVoucherTableMap::COL_TOTAL_QTY, StockVoucherTableMap::COL_SV_ERROR, StockVoucherTableMap::COL_SV_STATUS, ],
        self::TYPE_FIELDNAME     => ['svid', 'sv_user_id', 'sv_date', 'company_id', 'sv_remark', 'sv_desc', 'sv_type', 'total_qty', 'sv_error', 'sv_status', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
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
        self::TYPE_PHPNAME       => ['Svid' => 0, 'SvUserId' => 1, 'SvDate' => 2, 'CompanyId' => 3, 'SvRemark' => 4, 'SvDesc' => 5, 'SvType' => 6, 'TotalQty' => 7, 'SvError' => 8, 'SvStatus' => 9, ],
        self::TYPE_CAMELNAME     => ['svid' => 0, 'svUserId' => 1, 'svDate' => 2, 'companyId' => 3, 'svRemark' => 4, 'svDesc' => 5, 'svType' => 6, 'totalQty' => 7, 'svError' => 8, 'svStatus' => 9, ],
        self::TYPE_COLNAME       => [StockVoucherTableMap::COL_SVID => 0, StockVoucherTableMap::COL_SV_USER_ID => 1, StockVoucherTableMap::COL_SV_DATE => 2, StockVoucherTableMap::COL_COMPANY_ID => 3, StockVoucherTableMap::COL_SV_REMARK => 4, StockVoucherTableMap::COL_SV_DESC => 5, StockVoucherTableMap::COL_SV_TYPE => 6, StockVoucherTableMap::COL_TOTAL_QTY => 7, StockVoucherTableMap::COL_SV_ERROR => 8, StockVoucherTableMap::COL_SV_STATUS => 9, ],
        self::TYPE_FIELDNAME     => ['svid' => 0, 'sv_user_id' => 1, 'sv_date' => 2, 'company_id' => 3, 'sv_remark' => 4, 'sv_desc' => 5, 'sv_type' => 6, 'total_qty' => 7, 'sv_error' => 8, 'sv_status' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Svid' => 'SVID',
        'StockVoucher.Svid' => 'SVID',
        'svid' => 'SVID',
        'stockVoucher.svid' => 'SVID',
        'StockVoucherTableMap::COL_SVID' => 'SVID',
        'COL_SVID' => 'SVID',
        'stock_voucher.svid' => 'SVID',
        'SvUserId' => 'SV_USER_ID',
        'StockVoucher.SvUserId' => 'SV_USER_ID',
        'svUserId' => 'SV_USER_ID',
        'stockVoucher.svUserId' => 'SV_USER_ID',
        'StockVoucherTableMap::COL_SV_USER_ID' => 'SV_USER_ID',
        'COL_SV_USER_ID' => 'SV_USER_ID',
        'sv_user_id' => 'SV_USER_ID',
        'stock_voucher.sv_user_id' => 'SV_USER_ID',
        'SvDate' => 'SV_DATE',
        'StockVoucher.SvDate' => 'SV_DATE',
        'svDate' => 'SV_DATE',
        'stockVoucher.svDate' => 'SV_DATE',
        'StockVoucherTableMap::COL_SV_DATE' => 'SV_DATE',
        'COL_SV_DATE' => 'SV_DATE',
        'sv_date' => 'SV_DATE',
        'stock_voucher.sv_date' => 'SV_DATE',
        'CompanyId' => 'COMPANY_ID',
        'StockVoucher.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'stockVoucher.companyId' => 'COMPANY_ID',
        'StockVoucherTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'stock_voucher.company_id' => 'COMPANY_ID',
        'SvRemark' => 'SV_REMARK',
        'StockVoucher.SvRemark' => 'SV_REMARK',
        'svRemark' => 'SV_REMARK',
        'stockVoucher.svRemark' => 'SV_REMARK',
        'StockVoucherTableMap::COL_SV_REMARK' => 'SV_REMARK',
        'COL_SV_REMARK' => 'SV_REMARK',
        'sv_remark' => 'SV_REMARK',
        'stock_voucher.sv_remark' => 'SV_REMARK',
        'SvDesc' => 'SV_DESC',
        'StockVoucher.SvDesc' => 'SV_DESC',
        'svDesc' => 'SV_DESC',
        'stockVoucher.svDesc' => 'SV_DESC',
        'StockVoucherTableMap::COL_SV_DESC' => 'SV_DESC',
        'COL_SV_DESC' => 'SV_DESC',
        'sv_desc' => 'SV_DESC',
        'stock_voucher.sv_desc' => 'SV_DESC',
        'SvType' => 'SV_TYPE',
        'StockVoucher.SvType' => 'SV_TYPE',
        'svType' => 'SV_TYPE',
        'stockVoucher.svType' => 'SV_TYPE',
        'StockVoucherTableMap::COL_SV_TYPE' => 'SV_TYPE',
        'COL_SV_TYPE' => 'SV_TYPE',
        'sv_type' => 'SV_TYPE',
        'stock_voucher.sv_type' => 'SV_TYPE',
        'TotalQty' => 'TOTAL_QTY',
        'StockVoucher.TotalQty' => 'TOTAL_QTY',
        'totalQty' => 'TOTAL_QTY',
        'stockVoucher.totalQty' => 'TOTAL_QTY',
        'StockVoucherTableMap::COL_TOTAL_QTY' => 'TOTAL_QTY',
        'COL_TOTAL_QTY' => 'TOTAL_QTY',
        'total_qty' => 'TOTAL_QTY',
        'stock_voucher.total_qty' => 'TOTAL_QTY',
        'SvError' => 'SV_ERROR',
        'StockVoucher.SvError' => 'SV_ERROR',
        'svError' => 'SV_ERROR',
        'stockVoucher.svError' => 'SV_ERROR',
        'StockVoucherTableMap::COL_SV_ERROR' => 'SV_ERROR',
        'COL_SV_ERROR' => 'SV_ERROR',
        'sv_error' => 'SV_ERROR',
        'stock_voucher.sv_error' => 'SV_ERROR',
        'SvStatus' => 'SV_STATUS',
        'StockVoucher.SvStatus' => 'SV_STATUS',
        'svStatus' => 'SV_STATUS',
        'stockVoucher.svStatus' => 'SV_STATUS',
        'StockVoucherTableMap::COL_SV_STATUS' => 'SV_STATUS',
        'COL_SV_STATUS' => 'SV_STATUS',
        'sv_status' => 'SV_STATUS',
        'stock_voucher.sv_status' => 'SV_STATUS',
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
        $this->setName('stock_voucher');
        $this->setPhpName('StockVoucher');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\StockVoucher');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('stock_voucher_svid_seq');
        // columns
        $this->addPrimaryKey('svid', 'Svid', 'BIGINT', true, null, null);
        $this->addForeignKey('sv_user_id', 'SvUserId', 'INTEGER', 'users', 'user_id', true, null, null);
        $this->addColumn('sv_date', 'SvDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addColumn('sv_remark', 'SvRemark', 'VARCHAR', true, 200, '');
        $this->addColumn('sv_desc', 'SvDesc', 'VARCHAR', true, 200, '');
        $this->addColumn('sv_type', 'SvType', 'VARCHAR', true, 200, null);
        $this->addColumn('total_qty', 'TotalQty', 'INTEGER', true, null, 0);
        $this->addColumn('sv_error', 'SvError', 'VARCHAR', false, 50, null);
        $this->addColumn('sv_status', 'SvStatus', 'VARCHAR', true, 50, 'Draft');
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, null, false);
        $this->addRelation('Users', '\\entities\\Users', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':sv_user_id',
    1 => ':user_id',
  ),
), null, null, null, false);
        $this->addRelation('Shippingorder', '\\entities\\Shippingorder', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':sv_id',
    1 => ':svid',
  ),
), null, null, 'Shippingorders', false);
        $this->addRelation('StockTransaction', '\\entities\\StockTransaction', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':sv_id',
    1 => ':svid',
  ),
), null, null, 'StockTransactions', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Svid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Svid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Svid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Svid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Svid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Svid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Svid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? StockVoucherTableMap::CLASS_DEFAULT : StockVoucherTableMap::OM_CLASS;
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
     * @return array (StockVoucher object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = StockVoucherTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = StockVoucherTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + StockVoucherTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = StockVoucherTableMap::OM_CLASS;
            /** @var StockVoucher $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            StockVoucherTableMap::addInstanceToPool($obj, $key);
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
            $key = StockVoucherTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = StockVoucherTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var StockVoucher $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                StockVoucherTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(StockVoucherTableMap::COL_SVID);
            $criteria->addSelectColumn(StockVoucherTableMap::COL_SV_USER_ID);
            $criteria->addSelectColumn(StockVoucherTableMap::COL_SV_DATE);
            $criteria->addSelectColumn(StockVoucherTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(StockVoucherTableMap::COL_SV_REMARK);
            $criteria->addSelectColumn(StockVoucherTableMap::COL_SV_DESC);
            $criteria->addSelectColumn(StockVoucherTableMap::COL_SV_TYPE);
            $criteria->addSelectColumn(StockVoucherTableMap::COL_TOTAL_QTY);
            $criteria->addSelectColumn(StockVoucherTableMap::COL_SV_ERROR);
            $criteria->addSelectColumn(StockVoucherTableMap::COL_SV_STATUS);
        } else {
            $criteria->addSelectColumn($alias . '.svid');
            $criteria->addSelectColumn($alias . '.sv_user_id');
            $criteria->addSelectColumn($alias . '.sv_date');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.sv_remark');
            $criteria->addSelectColumn($alias . '.sv_desc');
            $criteria->addSelectColumn($alias . '.sv_type');
            $criteria->addSelectColumn($alias . '.total_qty');
            $criteria->addSelectColumn($alias . '.sv_error');
            $criteria->addSelectColumn($alias . '.sv_status');
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
            $criteria->removeSelectColumn(StockVoucherTableMap::COL_SVID);
            $criteria->removeSelectColumn(StockVoucherTableMap::COL_SV_USER_ID);
            $criteria->removeSelectColumn(StockVoucherTableMap::COL_SV_DATE);
            $criteria->removeSelectColumn(StockVoucherTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(StockVoucherTableMap::COL_SV_REMARK);
            $criteria->removeSelectColumn(StockVoucherTableMap::COL_SV_DESC);
            $criteria->removeSelectColumn(StockVoucherTableMap::COL_SV_TYPE);
            $criteria->removeSelectColumn(StockVoucherTableMap::COL_TOTAL_QTY);
            $criteria->removeSelectColumn(StockVoucherTableMap::COL_SV_ERROR);
            $criteria->removeSelectColumn(StockVoucherTableMap::COL_SV_STATUS);
        } else {
            $criteria->removeSelectColumn($alias . '.svid');
            $criteria->removeSelectColumn($alias . '.sv_user_id');
            $criteria->removeSelectColumn($alias . '.sv_date');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.sv_remark');
            $criteria->removeSelectColumn($alias . '.sv_desc');
            $criteria->removeSelectColumn($alias . '.sv_type');
            $criteria->removeSelectColumn($alias . '.total_qty');
            $criteria->removeSelectColumn($alias . '.sv_error');
            $criteria->removeSelectColumn($alias . '.sv_status');
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
        return Propel::getServiceContainer()->getDatabaseMap(StockVoucherTableMap::DATABASE_NAME)->getTable(StockVoucherTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a StockVoucher or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or StockVoucher object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(StockVoucherTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\StockVoucher) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(StockVoucherTableMap::DATABASE_NAME);
            $criteria->add(StockVoucherTableMap::COL_SVID, (array) $values, Criteria::IN);
        }

        $query = StockVoucherQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            StockVoucherTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                StockVoucherTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the stock_voucher table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return StockVoucherQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a StockVoucher or Criteria object.
     *
     * @param mixed $criteria Criteria or StockVoucher object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StockVoucherTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from StockVoucher object
        }

        if ($criteria->containsKey(StockVoucherTableMap::COL_SVID) && $criteria->keyContainsValue(StockVoucherTableMap::COL_SVID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.StockVoucherTableMap::COL_SVID.')');
        }


        // Set the correct dbName
        $query = StockVoucherQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
