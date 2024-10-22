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
use entities\Orderlines;
use entities\OrderlinesQuery;


/**
 * This class defines the structure of the 'orderlines' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OrderlinesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OrderlinesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'orderlines';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Orderlines';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Orderlines';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Orderlines';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 13;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 13;

    /**
     * the column name for the orderline_id field
     */
    public const COL_ORDERLINE_ID = 'orderlines.orderline_id';

    /**
     * the column name for the order_id field
     */
    public const COL_ORDER_ID = 'orderlines.order_id';

    /**
     * the column name for the product_id field
     */
    public const COL_PRODUCT_ID = 'orderlines.product_id';

    /**
     * the column name for the mrp field
     */
    public const COL_MRP = 'orderlines.mrp';

    /**
     * the column name for the rate field
     */
    public const COL_RATE = 'orderlines.rate';

    /**
     * the column name for the qty field
     */
    public const COL_QTY = 'orderlines.qty';

    /**
     * the column name for the ship_qty field
     */
    public const COL_SHIP_QTY = 'orderlines.ship_qty';

    /**
     * the column name for the unit_id field
     */
    public const COL_UNIT_ID = 'orderlines.unit_id';

    /**
     * the column name for the total_amt field
     */
    public const COL_TOTAL_AMT = 'orderlines.total_amt';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'orderlines.company_id';

    /**
     * the column name for the remark field
     */
    public const COL_REMARK = 'orderlines.remark';

    /**
     * the column name for the pricebook_line field
     */
    public const COL_PRICEBOOK_LINE = 'orderlines.pricebook_line';

    /**
     * the column name for the integration_id field
     */
    public const COL_INTEGRATION_ID = 'orderlines.integration_id';

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
        self::TYPE_PHPNAME       => ['OrderlineId', 'OrderId', 'ProductId', 'Mrp', 'Rate', 'Qty', 'ShipQty', 'UnitId', 'TotalAmt', 'CompanyId', 'Remark', 'PricebookLine', 'IntegrationId', ],
        self::TYPE_CAMELNAME     => ['orderlineId', 'orderId', 'productId', 'mrp', 'rate', 'qty', 'shipQty', 'unitId', 'totalAmt', 'companyId', 'remark', 'pricebookLine', 'integrationId', ],
        self::TYPE_COLNAME       => [OrderlinesTableMap::COL_ORDERLINE_ID, OrderlinesTableMap::COL_ORDER_ID, OrderlinesTableMap::COL_PRODUCT_ID, OrderlinesTableMap::COL_MRP, OrderlinesTableMap::COL_RATE, OrderlinesTableMap::COL_QTY, OrderlinesTableMap::COL_SHIP_QTY, OrderlinesTableMap::COL_UNIT_ID, OrderlinesTableMap::COL_TOTAL_AMT, OrderlinesTableMap::COL_COMPANY_ID, OrderlinesTableMap::COL_REMARK, OrderlinesTableMap::COL_PRICEBOOK_LINE, OrderlinesTableMap::COL_INTEGRATION_ID, ],
        self::TYPE_FIELDNAME     => ['orderline_id', 'order_id', 'product_id', 'mrp', 'rate', 'qty', 'ship_qty', 'unit_id', 'total_amt', 'company_id', 'remark', 'pricebook_line', 'integration_id', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
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
        self::TYPE_PHPNAME       => ['OrderlineId' => 0, 'OrderId' => 1, 'ProductId' => 2, 'Mrp' => 3, 'Rate' => 4, 'Qty' => 5, 'ShipQty' => 6, 'UnitId' => 7, 'TotalAmt' => 8, 'CompanyId' => 9, 'Remark' => 10, 'PricebookLine' => 11, 'IntegrationId' => 12, ],
        self::TYPE_CAMELNAME     => ['orderlineId' => 0, 'orderId' => 1, 'productId' => 2, 'mrp' => 3, 'rate' => 4, 'qty' => 5, 'shipQty' => 6, 'unitId' => 7, 'totalAmt' => 8, 'companyId' => 9, 'remark' => 10, 'pricebookLine' => 11, 'integrationId' => 12, ],
        self::TYPE_COLNAME       => [OrderlinesTableMap::COL_ORDERLINE_ID => 0, OrderlinesTableMap::COL_ORDER_ID => 1, OrderlinesTableMap::COL_PRODUCT_ID => 2, OrderlinesTableMap::COL_MRP => 3, OrderlinesTableMap::COL_RATE => 4, OrderlinesTableMap::COL_QTY => 5, OrderlinesTableMap::COL_SHIP_QTY => 6, OrderlinesTableMap::COL_UNIT_ID => 7, OrderlinesTableMap::COL_TOTAL_AMT => 8, OrderlinesTableMap::COL_COMPANY_ID => 9, OrderlinesTableMap::COL_REMARK => 10, OrderlinesTableMap::COL_PRICEBOOK_LINE => 11, OrderlinesTableMap::COL_INTEGRATION_ID => 12, ],
        self::TYPE_FIELDNAME     => ['orderline_id' => 0, 'order_id' => 1, 'product_id' => 2, 'mrp' => 3, 'rate' => 4, 'qty' => 5, 'ship_qty' => 6, 'unit_id' => 7, 'total_amt' => 8, 'company_id' => 9, 'remark' => 10, 'pricebook_line' => 11, 'integration_id' => 12, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OrderlineId' => 'ORDERLINE_ID',
        'Orderlines.OrderlineId' => 'ORDERLINE_ID',
        'orderlineId' => 'ORDERLINE_ID',
        'orderlines.orderlineId' => 'ORDERLINE_ID',
        'OrderlinesTableMap::COL_ORDERLINE_ID' => 'ORDERLINE_ID',
        'COL_ORDERLINE_ID' => 'ORDERLINE_ID',
        'orderline_id' => 'ORDERLINE_ID',
        'orderlines.orderline_id' => 'ORDERLINE_ID',
        'OrderId' => 'ORDER_ID',
        'Orderlines.OrderId' => 'ORDER_ID',
        'orderId' => 'ORDER_ID',
        'orderlines.orderId' => 'ORDER_ID',
        'OrderlinesTableMap::COL_ORDER_ID' => 'ORDER_ID',
        'COL_ORDER_ID' => 'ORDER_ID',
        'order_id' => 'ORDER_ID',
        'orderlines.order_id' => 'ORDER_ID',
        'ProductId' => 'PRODUCT_ID',
        'Orderlines.ProductId' => 'PRODUCT_ID',
        'productId' => 'PRODUCT_ID',
        'orderlines.productId' => 'PRODUCT_ID',
        'OrderlinesTableMap::COL_PRODUCT_ID' => 'PRODUCT_ID',
        'COL_PRODUCT_ID' => 'PRODUCT_ID',
        'product_id' => 'PRODUCT_ID',
        'orderlines.product_id' => 'PRODUCT_ID',
        'Mrp' => 'MRP',
        'Orderlines.Mrp' => 'MRP',
        'mrp' => 'MRP',
        'orderlines.mrp' => 'MRP',
        'OrderlinesTableMap::COL_MRP' => 'MRP',
        'COL_MRP' => 'MRP',
        'Rate' => 'RATE',
        'Orderlines.Rate' => 'RATE',
        'rate' => 'RATE',
        'orderlines.rate' => 'RATE',
        'OrderlinesTableMap::COL_RATE' => 'RATE',
        'COL_RATE' => 'RATE',
        'Qty' => 'QTY',
        'Orderlines.Qty' => 'QTY',
        'qty' => 'QTY',
        'orderlines.qty' => 'QTY',
        'OrderlinesTableMap::COL_QTY' => 'QTY',
        'COL_QTY' => 'QTY',
        'ShipQty' => 'SHIP_QTY',
        'Orderlines.ShipQty' => 'SHIP_QTY',
        'shipQty' => 'SHIP_QTY',
        'orderlines.shipQty' => 'SHIP_QTY',
        'OrderlinesTableMap::COL_SHIP_QTY' => 'SHIP_QTY',
        'COL_SHIP_QTY' => 'SHIP_QTY',
        'ship_qty' => 'SHIP_QTY',
        'orderlines.ship_qty' => 'SHIP_QTY',
        'UnitId' => 'UNIT_ID',
        'Orderlines.UnitId' => 'UNIT_ID',
        'unitId' => 'UNIT_ID',
        'orderlines.unitId' => 'UNIT_ID',
        'OrderlinesTableMap::COL_UNIT_ID' => 'UNIT_ID',
        'COL_UNIT_ID' => 'UNIT_ID',
        'unit_id' => 'UNIT_ID',
        'orderlines.unit_id' => 'UNIT_ID',
        'TotalAmt' => 'TOTAL_AMT',
        'Orderlines.TotalAmt' => 'TOTAL_AMT',
        'totalAmt' => 'TOTAL_AMT',
        'orderlines.totalAmt' => 'TOTAL_AMT',
        'OrderlinesTableMap::COL_TOTAL_AMT' => 'TOTAL_AMT',
        'COL_TOTAL_AMT' => 'TOTAL_AMT',
        'total_amt' => 'TOTAL_AMT',
        'orderlines.total_amt' => 'TOTAL_AMT',
        'CompanyId' => 'COMPANY_ID',
        'Orderlines.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'orderlines.companyId' => 'COMPANY_ID',
        'OrderlinesTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'orderlines.company_id' => 'COMPANY_ID',
        'Remark' => 'REMARK',
        'Orderlines.Remark' => 'REMARK',
        'remark' => 'REMARK',
        'orderlines.remark' => 'REMARK',
        'OrderlinesTableMap::COL_REMARK' => 'REMARK',
        'COL_REMARK' => 'REMARK',
        'PricebookLine' => 'PRICEBOOK_LINE',
        'Orderlines.PricebookLine' => 'PRICEBOOK_LINE',
        'pricebookLine' => 'PRICEBOOK_LINE',
        'orderlines.pricebookLine' => 'PRICEBOOK_LINE',
        'OrderlinesTableMap::COL_PRICEBOOK_LINE' => 'PRICEBOOK_LINE',
        'COL_PRICEBOOK_LINE' => 'PRICEBOOK_LINE',
        'pricebook_line' => 'PRICEBOOK_LINE',
        'orderlines.pricebook_line' => 'PRICEBOOK_LINE',
        'IntegrationId' => 'INTEGRATION_ID',
        'Orderlines.IntegrationId' => 'INTEGRATION_ID',
        'integrationId' => 'INTEGRATION_ID',
        'orderlines.integrationId' => 'INTEGRATION_ID',
        'OrderlinesTableMap::COL_INTEGRATION_ID' => 'INTEGRATION_ID',
        'COL_INTEGRATION_ID' => 'INTEGRATION_ID',
        'integration_id' => 'INTEGRATION_ID',
        'orderlines.integration_id' => 'INTEGRATION_ID',
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
        $this->setName('orderlines');
        $this->setPhpName('Orderlines');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Orderlines');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('orderlines_orderline_id_seq');
        // columns
        $this->addPrimaryKey('orderline_id', 'OrderlineId', 'BIGINT', true, null, null);
        $this->addForeignKey('order_id', 'OrderId', 'BIGINT', 'orders', 'order_id', true, null, 0);
        $this->addForeignKey('product_id', 'ProductId', 'INTEGER', 'products', 'id', true, null, 0);
        $this->addColumn('mrp', 'Mrp', 'DECIMAL', true, 20, 0.00);
        $this->addColumn('rate', 'Rate', 'DECIMAL', true, 20, 0.00);
        $this->addColumn('qty', 'Qty', 'INTEGER', true, null, 0);
        $this->addColumn('ship_qty', 'ShipQty', 'INTEGER', true, null, 0);
        $this->addForeignKey('unit_id', 'UnitId', 'INTEGER', 'unitmaster', 'unit_id', true, null, 0);
        $this->addColumn('total_amt', 'TotalAmt', 'DECIMAL', true, 20, 0.00);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, 0);
        $this->addColumn('remark', 'Remark', 'VARCHAR', true, 50, '0');
        $this->addColumn('pricebook_line', 'PricebookLine', 'INTEGER', true, null, 0);
        $this->addColumn('integration_id', 'IntegrationId', 'VARCHAR', true, 50, '0');
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
        $this->addRelation('Orders', '\\entities\\Orders', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':order_id',
    1 => ':order_id',
  ),
), null, null, null, false);
        $this->addRelation('Products', '\\entities\\Products', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Unitmaster', '\\entities\\Unitmaster', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':unit_id',
    1 => ':unit_id',
  ),
), null, null, null, false);
        $this->addRelation('Shippinglines', '\\entities\\Shippinglines', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':orderline_id',
    1 => ':orderline_id',
  ),
), null, null, 'Shippingliness', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OrderlineId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OrderlineId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OrderlineId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OrderlineId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OrderlineId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OrderlineId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('OrderlineId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OrderlinesTableMap::CLASS_DEFAULT : OrderlinesTableMap::OM_CLASS;
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
     * @return array (Orderlines object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OrderlinesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OrderlinesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OrderlinesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OrderlinesTableMap::OM_CLASS;
            /** @var Orderlines $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OrderlinesTableMap::addInstanceToPool($obj, $key);
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
            $key = OrderlinesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OrderlinesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Orderlines $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OrderlinesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OrderlinesTableMap::COL_ORDERLINE_ID);
            $criteria->addSelectColumn(OrderlinesTableMap::COL_ORDER_ID);
            $criteria->addSelectColumn(OrderlinesTableMap::COL_PRODUCT_ID);
            $criteria->addSelectColumn(OrderlinesTableMap::COL_MRP);
            $criteria->addSelectColumn(OrderlinesTableMap::COL_RATE);
            $criteria->addSelectColumn(OrderlinesTableMap::COL_QTY);
            $criteria->addSelectColumn(OrderlinesTableMap::COL_SHIP_QTY);
            $criteria->addSelectColumn(OrderlinesTableMap::COL_UNIT_ID);
            $criteria->addSelectColumn(OrderlinesTableMap::COL_TOTAL_AMT);
            $criteria->addSelectColumn(OrderlinesTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(OrderlinesTableMap::COL_REMARK);
            $criteria->addSelectColumn(OrderlinesTableMap::COL_PRICEBOOK_LINE);
            $criteria->addSelectColumn(OrderlinesTableMap::COL_INTEGRATION_ID);
        } else {
            $criteria->addSelectColumn($alias . '.orderline_id');
            $criteria->addSelectColumn($alias . '.order_id');
            $criteria->addSelectColumn($alias . '.product_id');
            $criteria->addSelectColumn($alias . '.mrp');
            $criteria->addSelectColumn($alias . '.rate');
            $criteria->addSelectColumn($alias . '.qty');
            $criteria->addSelectColumn($alias . '.ship_qty');
            $criteria->addSelectColumn($alias . '.unit_id');
            $criteria->addSelectColumn($alias . '.total_amt');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.remark');
            $criteria->addSelectColumn($alias . '.pricebook_line');
            $criteria->addSelectColumn($alias . '.integration_id');
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
            $criteria->removeSelectColumn(OrderlinesTableMap::COL_ORDERLINE_ID);
            $criteria->removeSelectColumn(OrderlinesTableMap::COL_ORDER_ID);
            $criteria->removeSelectColumn(OrderlinesTableMap::COL_PRODUCT_ID);
            $criteria->removeSelectColumn(OrderlinesTableMap::COL_MRP);
            $criteria->removeSelectColumn(OrderlinesTableMap::COL_RATE);
            $criteria->removeSelectColumn(OrderlinesTableMap::COL_QTY);
            $criteria->removeSelectColumn(OrderlinesTableMap::COL_SHIP_QTY);
            $criteria->removeSelectColumn(OrderlinesTableMap::COL_UNIT_ID);
            $criteria->removeSelectColumn(OrderlinesTableMap::COL_TOTAL_AMT);
            $criteria->removeSelectColumn(OrderlinesTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(OrderlinesTableMap::COL_REMARK);
            $criteria->removeSelectColumn(OrderlinesTableMap::COL_PRICEBOOK_LINE);
            $criteria->removeSelectColumn(OrderlinesTableMap::COL_INTEGRATION_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.orderline_id');
            $criteria->removeSelectColumn($alias . '.order_id');
            $criteria->removeSelectColumn($alias . '.product_id');
            $criteria->removeSelectColumn($alias . '.mrp');
            $criteria->removeSelectColumn($alias . '.rate');
            $criteria->removeSelectColumn($alias . '.qty');
            $criteria->removeSelectColumn($alias . '.ship_qty');
            $criteria->removeSelectColumn($alias . '.unit_id');
            $criteria->removeSelectColumn($alias . '.total_amt');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.remark');
            $criteria->removeSelectColumn($alias . '.pricebook_line');
            $criteria->removeSelectColumn($alias . '.integration_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(OrderlinesTableMap::DATABASE_NAME)->getTable(OrderlinesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Orderlines or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Orderlines object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OrderlinesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Orderlines) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OrderlinesTableMap::DATABASE_NAME);
            $criteria->add(OrderlinesTableMap::COL_ORDERLINE_ID, (array) $values, Criteria::IN);
        }

        $query = OrderlinesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OrderlinesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OrderlinesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the orderlines table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OrderlinesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Orderlines or Criteria object.
     *
     * @param mixed $criteria Criteria or Orderlines object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderlinesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Orderlines object
        }

        if ($criteria->containsKey(OrderlinesTableMap::COL_ORDERLINE_ID) && $criteria->keyContainsValue(OrderlinesTableMap::COL_ORDERLINE_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OrderlinesTableMap::COL_ORDERLINE_ID.')');
        }


        // Set the correct dbName
        $query = OrderlinesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
