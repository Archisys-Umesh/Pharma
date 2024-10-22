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
use entities\StockTransaction;
use entities\StockTransactionQuery;


/**
 * This class defines the structure of the 'stock_transaction' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class StockTransactionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.StockTransactionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'stock_transaction';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'StockTransaction';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\StockTransaction';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.StockTransaction';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 14;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 14;

    /**
     * the column name for the stid field
     */
    public const COL_STID = 'stock_transaction.stid';

    /**
     * the column name for the sv_id field
     */
    public const COL_SV_ID = 'stock_transaction.sv_id';

    /**
     * the column name for the sku field
     */
    public const COL_SKU = 'stock_transaction.sku';

    /**
     * the column name for the serial_no field
     */
    public const COL_SERIAL_NO = 'stock_transaction.serial_no';

    /**
     * the column name for the batch_no field
     */
    public const COL_BATCH_NO = 'stock_transaction.batch_no';

    /**
     * the column name for the qty field
     */
    public const COL_QTY = 'stock_transaction.qty';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'stock_transaction.company_id';

    /**
     * the column name for the product_id field
     */
    public const COL_PRODUCT_ID = 'stock_transaction.product_id';

    /**
     * the column name for the outlet_id field
     */
    public const COL_OUTLET_ID = 'stock_transaction.outlet_id';

    /**
     * the column name for the tran_type field
     */
    public const COL_TRAN_TYPE = 'stock_transaction.tran_type';

    /**
     * the column name for the ref_num field
     */
    public const COL_REF_NUM = 'stock_transaction.ref_num';

    /**
     * the column name for the ref_desc field
     */
    public const COL_REF_DESC = 'stock_transaction.ref_desc';

    /**
     * the column name for the tran_date field
     */
    public const COL_TRAN_DATE = 'stock_transaction.tran_date';

    /**
     * the column name for the created_user field
     */
    public const COL_CREATED_USER = 'stock_transaction.created_user';

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
        self::TYPE_PHPNAME       => ['Stid', 'SvId', 'Sku', 'SerialNo', 'BatchNo', 'Qty', 'CompanyId', 'ProductId', 'OutletId', 'TranType', 'RefNum', 'RefDesc', 'TranDate', 'CreatedUser', ],
        self::TYPE_CAMELNAME     => ['stid', 'svId', 'sku', 'serialNo', 'batchNo', 'qty', 'companyId', 'productId', 'outletId', 'tranType', 'refNum', 'refDesc', 'tranDate', 'createdUser', ],
        self::TYPE_COLNAME       => [StockTransactionTableMap::COL_STID, StockTransactionTableMap::COL_SV_ID, StockTransactionTableMap::COL_SKU, StockTransactionTableMap::COL_SERIAL_NO, StockTransactionTableMap::COL_BATCH_NO, StockTransactionTableMap::COL_QTY, StockTransactionTableMap::COL_COMPANY_ID, StockTransactionTableMap::COL_PRODUCT_ID, StockTransactionTableMap::COL_OUTLET_ID, StockTransactionTableMap::COL_TRAN_TYPE, StockTransactionTableMap::COL_REF_NUM, StockTransactionTableMap::COL_REF_DESC, StockTransactionTableMap::COL_TRAN_DATE, StockTransactionTableMap::COL_CREATED_USER, ],
        self::TYPE_FIELDNAME     => ['stid', 'sv_id', 'sku', 'serial_no', 'batch_no', 'qty', 'company_id', 'product_id', 'outlet_id', 'tran_type', 'ref_num', 'ref_desc', 'tran_date', 'created_user', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
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
        self::TYPE_PHPNAME       => ['Stid' => 0, 'SvId' => 1, 'Sku' => 2, 'SerialNo' => 3, 'BatchNo' => 4, 'Qty' => 5, 'CompanyId' => 6, 'ProductId' => 7, 'OutletId' => 8, 'TranType' => 9, 'RefNum' => 10, 'RefDesc' => 11, 'TranDate' => 12, 'CreatedUser' => 13, ],
        self::TYPE_CAMELNAME     => ['stid' => 0, 'svId' => 1, 'sku' => 2, 'serialNo' => 3, 'batchNo' => 4, 'qty' => 5, 'companyId' => 6, 'productId' => 7, 'outletId' => 8, 'tranType' => 9, 'refNum' => 10, 'refDesc' => 11, 'tranDate' => 12, 'createdUser' => 13, ],
        self::TYPE_COLNAME       => [StockTransactionTableMap::COL_STID => 0, StockTransactionTableMap::COL_SV_ID => 1, StockTransactionTableMap::COL_SKU => 2, StockTransactionTableMap::COL_SERIAL_NO => 3, StockTransactionTableMap::COL_BATCH_NO => 4, StockTransactionTableMap::COL_QTY => 5, StockTransactionTableMap::COL_COMPANY_ID => 6, StockTransactionTableMap::COL_PRODUCT_ID => 7, StockTransactionTableMap::COL_OUTLET_ID => 8, StockTransactionTableMap::COL_TRAN_TYPE => 9, StockTransactionTableMap::COL_REF_NUM => 10, StockTransactionTableMap::COL_REF_DESC => 11, StockTransactionTableMap::COL_TRAN_DATE => 12, StockTransactionTableMap::COL_CREATED_USER => 13, ],
        self::TYPE_FIELDNAME     => ['stid' => 0, 'sv_id' => 1, 'sku' => 2, 'serial_no' => 3, 'batch_no' => 4, 'qty' => 5, 'company_id' => 6, 'product_id' => 7, 'outlet_id' => 8, 'tran_type' => 9, 'ref_num' => 10, 'ref_desc' => 11, 'tran_date' => 12, 'created_user' => 13, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Stid' => 'STID',
        'StockTransaction.Stid' => 'STID',
        'stid' => 'STID',
        'stockTransaction.stid' => 'STID',
        'StockTransactionTableMap::COL_STID' => 'STID',
        'COL_STID' => 'STID',
        'stock_transaction.stid' => 'STID',
        'SvId' => 'SV_ID',
        'StockTransaction.SvId' => 'SV_ID',
        'svId' => 'SV_ID',
        'stockTransaction.svId' => 'SV_ID',
        'StockTransactionTableMap::COL_SV_ID' => 'SV_ID',
        'COL_SV_ID' => 'SV_ID',
        'sv_id' => 'SV_ID',
        'stock_transaction.sv_id' => 'SV_ID',
        'Sku' => 'SKU',
        'StockTransaction.Sku' => 'SKU',
        'sku' => 'SKU',
        'stockTransaction.sku' => 'SKU',
        'StockTransactionTableMap::COL_SKU' => 'SKU',
        'COL_SKU' => 'SKU',
        'stock_transaction.sku' => 'SKU',
        'SerialNo' => 'SERIAL_NO',
        'StockTransaction.SerialNo' => 'SERIAL_NO',
        'serialNo' => 'SERIAL_NO',
        'stockTransaction.serialNo' => 'SERIAL_NO',
        'StockTransactionTableMap::COL_SERIAL_NO' => 'SERIAL_NO',
        'COL_SERIAL_NO' => 'SERIAL_NO',
        'serial_no' => 'SERIAL_NO',
        'stock_transaction.serial_no' => 'SERIAL_NO',
        'BatchNo' => 'BATCH_NO',
        'StockTransaction.BatchNo' => 'BATCH_NO',
        'batchNo' => 'BATCH_NO',
        'stockTransaction.batchNo' => 'BATCH_NO',
        'StockTransactionTableMap::COL_BATCH_NO' => 'BATCH_NO',
        'COL_BATCH_NO' => 'BATCH_NO',
        'batch_no' => 'BATCH_NO',
        'stock_transaction.batch_no' => 'BATCH_NO',
        'Qty' => 'QTY',
        'StockTransaction.Qty' => 'QTY',
        'qty' => 'QTY',
        'stockTransaction.qty' => 'QTY',
        'StockTransactionTableMap::COL_QTY' => 'QTY',
        'COL_QTY' => 'QTY',
        'stock_transaction.qty' => 'QTY',
        'CompanyId' => 'COMPANY_ID',
        'StockTransaction.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'stockTransaction.companyId' => 'COMPANY_ID',
        'StockTransactionTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'stock_transaction.company_id' => 'COMPANY_ID',
        'ProductId' => 'PRODUCT_ID',
        'StockTransaction.ProductId' => 'PRODUCT_ID',
        'productId' => 'PRODUCT_ID',
        'stockTransaction.productId' => 'PRODUCT_ID',
        'StockTransactionTableMap::COL_PRODUCT_ID' => 'PRODUCT_ID',
        'COL_PRODUCT_ID' => 'PRODUCT_ID',
        'product_id' => 'PRODUCT_ID',
        'stock_transaction.product_id' => 'PRODUCT_ID',
        'OutletId' => 'OUTLET_ID',
        'StockTransaction.OutletId' => 'OUTLET_ID',
        'outletId' => 'OUTLET_ID',
        'stockTransaction.outletId' => 'OUTLET_ID',
        'StockTransactionTableMap::COL_OUTLET_ID' => 'OUTLET_ID',
        'COL_OUTLET_ID' => 'OUTLET_ID',
        'outlet_id' => 'OUTLET_ID',
        'stock_transaction.outlet_id' => 'OUTLET_ID',
        'TranType' => 'TRAN_TYPE',
        'StockTransaction.TranType' => 'TRAN_TYPE',
        'tranType' => 'TRAN_TYPE',
        'stockTransaction.tranType' => 'TRAN_TYPE',
        'StockTransactionTableMap::COL_TRAN_TYPE' => 'TRAN_TYPE',
        'COL_TRAN_TYPE' => 'TRAN_TYPE',
        'tran_type' => 'TRAN_TYPE',
        'stock_transaction.tran_type' => 'TRAN_TYPE',
        'RefNum' => 'REF_NUM',
        'StockTransaction.RefNum' => 'REF_NUM',
        'refNum' => 'REF_NUM',
        'stockTransaction.refNum' => 'REF_NUM',
        'StockTransactionTableMap::COL_REF_NUM' => 'REF_NUM',
        'COL_REF_NUM' => 'REF_NUM',
        'ref_num' => 'REF_NUM',
        'stock_transaction.ref_num' => 'REF_NUM',
        'RefDesc' => 'REF_DESC',
        'StockTransaction.RefDesc' => 'REF_DESC',
        'refDesc' => 'REF_DESC',
        'stockTransaction.refDesc' => 'REF_DESC',
        'StockTransactionTableMap::COL_REF_DESC' => 'REF_DESC',
        'COL_REF_DESC' => 'REF_DESC',
        'ref_desc' => 'REF_DESC',
        'stock_transaction.ref_desc' => 'REF_DESC',
        'TranDate' => 'TRAN_DATE',
        'StockTransaction.TranDate' => 'TRAN_DATE',
        'tranDate' => 'TRAN_DATE',
        'stockTransaction.tranDate' => 'TRAN_DATE',
        'StockTransactionTableMap::COL_TRAN_DATE' => 'TRAN_DATE',
        'COL_TRAN_DATE' => 'TRAN_DATE',
        'tran_date' => 'TRAN_DATE',
        'stock_transaction.tran_date' => 'TRAN_DATE',
        'CreatedUser' => 'CREATED_USER',
        'StockTransaction.CreatedUser' => 'CREATED_USER',
        'createdUser' => 'CREATED_USER',
        'stockTransaction.createdUser' => 'CREATED_USER',
        'StockTransactionTableMap::COL_CREATED_USER' => 'CREATED_USER',
        'COL_CREATED_USER' => 'CREATED_USER',
        'created_user' => 'CREATED_USER',
        'stock_transaction.created_user' => 'CREATED_USER',
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
        $this->setName('stock_transaction');
        $this->setPhpName('StockTransaction');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\StockTransaction');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('stock_transaction_stid_seq');
        // columns
        $this->addPrimaryKey('stid', 'Stid', 'BIGINT', true, null, null);
        $this->addForeignKey('sv_id', 'SvId', 'BIGINT', 'stock_voucher', 'svid', true, null, null);
        $this->addColumn('sku', 'Sku', 'VARCHAR', true, 50, null);
        $this->addColumn('serial_no', 'SerialNo', 'VARCHAR', true, 50, '0');
        $this->addColumn('batch_no', 'BatchNo', 'VARCHAR', true, 50, '0');
        $this->addColumn('qty', 'Qty', 'DECIMAL', true, 20, 0.00);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, 0);
        $this->addForeignKey('product_id', 'ProductId', 'INTEGER', 'products', 'id', true, null, 0);
        $this->addForeignKey('outlet_id', 'OutletId', 'INTEGER', 'outlets', 'id', true, null, 0);
        $this->addColumn('tran_type', 'TranType', 'CHAR', true, null, null);
        $this->addColumn('ref_num', 'RefNum', 'VARCHAR', false, 50, null);
        $this->addColumn('ref_desc', 'RefDesc', 'VARCHAR', false, 50, null);
        $this->addColumn('tran_date', 'TranDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addForeignKey('created_user', 'CreatedUser', 'INTEGER', 'users', 'user_id', true, null, null);
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
        $this->addRelation('Outlets', '\\entities\\Outlets', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Products', '\\entities\\Products', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('StockVoucher', '\\entities\\StockVoucher', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':sv_id',
    1 => ':svid',
  ),
), null, null, null, false);
        $this->addRelation('Users', '\\entities\\Users', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':created_user',
    1 => ':user_id',
  ),
), null, null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Stid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Stid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Stid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Stid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Stid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Stid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Stid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? StockTransactionTableMap::CLASS_DEFAULT : StockTransactionTableMap::OM_CLASS;
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
     * @return array (StockTransaction object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = StockTransactionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = StockTransactionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + StockTransactionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = StockTransactionTableMap::OM_CLASS;
            /** @var StockTransaction $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            StockTransactionTableMap::addInstanceToPool($obj, $key);
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
            $key = StockTransactionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = StockTransactionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var StockTransaction $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                StockTransactionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(StockTransactionTableMap::COL_STID);
            $criteria->addSelectColumn(StockTransactionTableMap::COL_SV_ID);
            $criteria->addSelectColumn(StockTransactionTableMap::COL_SKU);
            $criteria->addSelectColumn(StockTransactionTableMap::COL_SERIAL_NO);
            $criteria->addSelectColumn(StockTransactionTableMap::COL_BATCH_NO);
            $criteria->addSelectColumn(StockTransactionTableMap::COL_QTY);
            $criteria->addSelectColumn(StockTransactionTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(StockTransactionTableMap::COL_PRODUCT_ID);
            $criteria->addSelectColumn(StockTransactionTableMap::COL_OUTLET_ID);
            $criteria->addSelectColumn(StockTransactionTableMap::COL_TRAN_TYPE);
            $criteria->addSelectColumn(StockTransactionTableMap::COL_REF_NUM);
            $criteria->addSelectColumn(StockTransactionTableMap::COL_REF_DESC);
            $criteria->addSelectColumn(StockTransactionTableMap::COL_TRAN_DATE);
            $criteria->addSelectColumn(StockTransactionTableMap::COL_CREATED_USER);
        } else {
            $criteria->addSelectColumn($alias . '.stid');
            $criteria->addSelectColumn($alias . '.sv_id');
            $criteria->addSelectColumn($alias . '.sku');
            $criteria->addSelectColumn($alias . '.serial_no');
            $criteria->addSelectColumn($alias . '.batch_no');
            $criteria->addSelectColumn($alias . '.qty');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.product_id');
            $criteria->addSelectColumn($alias . '.outlet_id');
            $criteria->addSelectColumn($alias . '.tran_type');
            $criteria->addSelectColumn($alias . '.ref_num');
            $criteria->addSelectColumn($alias . '.ref_desc');
            $criteria->addSelectColumn($alias . '.tran_date');
            $criteria->addSelectColumn($alias . '.created_user');
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
            $criteria->removeSelectColumn(StockTransactionTableMap::COL_STID);
            $criteria->removeSelectColumn(StockTransactionTableMap::COL_SV_ID);
            $criteria->removeSelectColumn(StockTransactionTableMap::COL_SKU);
            $criteria->removeSelectColumn(StockTransactionTableMap::COL_SERIAL_NO);
            $criteria->removeSelectColumn(StockTransactionTableMap::COL_BATCH_NO);
            $criteria->removeSelectColumn(StockTransactionTableMap::COL_QTY);
            $criteria->removeSelectColumn(StockTransactionTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(StockTransactionTableMap::COL_PRODUCT_ID);
            $criteria->removeSelectColumn(StockTransactionTableMap::COL_OUTLET_ID);
            $criteria->removeSelectColumn(StockTransactionTableMap::COL_TRAN_TYPE);
            $criteria->removeSelectColumn(StockTransactionTableMap::COL_REF_NUM);
            $criteria->removeSelectColumn(StockTransactionTableMap::COL_REF_DESC);
            $criteria->removeSelectColumn(StockTransactionTableMap::COL_TRAN_DATE);
            $criteria->removeSelectColumn(StockTransactionTableMap::COL_CREATED_USER);
        } else {
            $criteria->removeSelectColumn($alias . '.stid');
            $criteria->removeSelectColumn($alias . '.sv_id');
            $criteria->removeSelectColumn($alias . '.sku');
            $criteria->removeSelectColumn($alias . '.serial_no');
            $criteria->removeSelectColumn($alias . '.batch_no');
            $criteria->removeSelectColumn($alias . '.qty');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.product_id');
            $criteria->removeSelectColumn($alias . '.outlet_id');
            $criteria->removeSelectColumn($alias . '.tran_type');
            $criteria->removeSelectColumn($alias . '.ref_num');
            $criteria->removeSelectColumn($alias . '.ref_desc');
            $criteria->removeSelectColumn($alias . '.tran_date');
            $criteria->removeSelectColumn($alias . '.created_user');
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
        return Propel::getServiceContainer()->getDatabaseMap(StockTransactionTableMap::DATABASE_NAME)->getTable(StockTransactionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a StockTransaction or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or StockTransaction object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(StockTransactionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\StockTransaction) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(StockTransactionTableMap::DATABASE_NAME);
            $criteria->add(StockTransactionTableMap::COL_STID, (array) $values, Criteria::IN);
        }

        $query = StockTransactionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            StockTransactionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                StockTransactionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the stock_transaction table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return StockTransactionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a StockTransaction or Criteria object.
     *
     * @param mixed $criteria Criteria or StockTransaction object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StockTransactionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from StockTransaction object
        }

        if ($criteria->containsKey(StockTransactionTableMap::COL_STID) && $criteria->keyContainsValue(StockTransactionTableMap::COL_STID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.StockTransactionTableMap::COL_STID.')');
        }


        // Set the correct dbName
        $query = StockTransactionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
