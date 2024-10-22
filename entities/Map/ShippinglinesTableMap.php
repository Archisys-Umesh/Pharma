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
use entities\Shippinglines;
use entities\ShippinglinesQuery;


/**
 * This class defines the structure of the 'shippinglines' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ShippinglinesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.ShippinglinesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'shippinglines';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Shippinglines';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Shippinglines';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Shippinglines';

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
     * the column name for the solid field
     */
    public const COL_SOLID = 'shippinglines.solid';

    /**
     * the column name for the soid field
     */
    public const COL_SOID = 'shippinglines.soid';

    /**
     * the column name for the product_id field
     */
    public const COL_PRODUCT_ID = 'shippinglines.product_id';

    /**
     * the column name for the qty field
     */
    public const COL_QTY = 'shippinglines.qty';

    /**
     * the column name for the allocated_qty field
     */
    public const COL_ALLOCATED_QTY = 'shippinglines.allocated_qty';

    /**
     * the column name for the rate field
     */
    public const COL_RATE = 'shippinglines.rate';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'shippinglines.company_id';

    /**
     * the column name for the orderline_id field
     */
    public const COL_ORDERLINE_ID = 'shippinglines.orderline_id';

    /**
     * the column name for the created_date field
     */
    public const COL_CREATED_DATE = 'shippinglines.created_date';

    /**
     * the column name for the integration_id field
     */
    public const COL_INTEGRATION_ID = 'shippinglines.integration_id';

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
        self::TYPE_PHPNAME       => ['Solid', 'Soid', 'ProductId', 'Qty', 'AllocatedQty', 'Rate', 'CompanyId', 'OrderlineId', 'CreatedDate', 'IntegrationId', ],
        self::TYPE_CAMELNAME     => ['solid', 'soid', 'productId', 'qty', 'allocatedQty', 'rate', 'companyId', 'orderlineId', 'createdDate', 'integrationId', ],
        self::TYPE_COLNAME       => [ShippinglinesTableMap::COL_SOLID, ShippinglinesTableMap::COL_SOID, ShippinglinesTableMap::COL_PRODUCT_ID, ShippinglinesTableMap::COL_QTY, ShippinglinesTableMap::COL_ALLOCATED_QTY, ShippinglinesTableMap::COL_RATE, ShippinglinesTableMap::COL_COMPANY_ID, ShippinglinesTableMap::COL_ORDERLINE_ID, ShippinglinesTableMap::COL_CREATED_DATE, ShippinglinesTableMap::COL_INTEGRATION_ID, ],
        self::TYPE_FIELDNAME     => ['solid', 'soid', 'product_id', 'qty', 'allocated_qty', 'rate', 'company_id', 'orderline_id', 'created_date', 'integration_id', ],
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
        self::TYPE_PHPNAME       => ['Solid' => 0, 'Soid' => 1, 'ProductId' => 2, 'Qty' => 3, 'AllocatedQty' => 4, 'Rate' => 5, 'CompanyId' => 6, 'OrderlineId' => 7, 'CreatedDate' => 8, 'IntegrationId' => 9, ],
        self::TYPE_CAMELNAME     => ['solid' => 0, 'soid' => 1, 'productId' => 2, 'qty' => 3, 'allocatedQty' => 4, 'rate' => 5, 'companyId' => 6, 'orderlineId' => 7, 'createdDate' => 8, 'integrationId' => 9, ],
        self::TYPE_COLNAME       => [ShippinglinesTableMap::COL_SOLID => 0, ShippinglinesTableMap::COL_SOID => 1, ShippinglinesTableMap::COL_PRODUCT_ID => 2, ShippinglinesTableMap::COL_QTY => 3, ShippinglinesTableMap::COL_ALLOCATED_QTY => 4, ShippinglinesTableMap::COL_RATE => 5, ShippinglinesTableMap::COL_COMPANY_ID => 6, ShippinglinesTableMap::COL_ORDERLINE_ID => 7, ShippinglinesTableMap::COL_CREATED_DATE => 8, ShippinglinesTableMap::COL_INTEGRATION_ID => 9, ],
        self::TYPE_FIELDNAME     => ['solid' => 0, 'soid' => 1, 'product_id' => 2, 'qty' => 3, 'allocated_qty' => 4, 'rate' => 5, 'company_id' => 6, 'orderline_id' => 7, 'created_date' => 8, 'integration_id' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Solid' => 'SOLID',
        'Shippinglines.Solid' => 'SOLID',
        'solid' => 'SOLID',
        'shippinglines.solid' => 'SOLID',
        'ShippinglinesTableMap::COL_SOLID' => 'SOLID',
        'COL_SOLID' => 'SOLID',
        'Soid' => 'SOID',
        'Shippinglines.Soid' => 'SOID',
        'soid' => 'SOID',
        'shippinglines.soid' => 'SOID',
        'ShippinglinesTableMap::COL_SOID' => 'SOID',
        'COL_SOID' => 'SOID',
        'ProductId' => 'PRODUCT_ID',
        'Shippinglines.ProductId' => 'PRODUCT_ID',
        'productId' => 'PRODUCT_ID',
        'shippinglines.productId' => 'PRODUCT_ID',
        'ShippinglinesTableMap::COL_PRODUCT_ID' => 'PRODUCT_ID',
        'COL_PRODUCT_ID' => 'PRODUCT_ID',
        'product_id' => 'PRODUCT_ID',
        'shippinglines.product_id' => 'PRODUCT_ID',
        'Qty' => 'QTY',
        'Shippinglines.Qty' => 'QTY',
        'qty' => 'QTY',
        'shippinglines.qty' => 'QTY',
        'ShippinglinesTableMap::COL_QTY' => 'QTY',
        'COL_QTY' => 'QTY',
        'AllocatedQty' => 'ALLOCATED_QTY',
        'Shippinglines.AllocatedQty' => 'ALLOCATED_QTY',
        'allocatedQty' => 'ALLOCATED_QTY',
        'shippinglines.allocatedQty' => 'ALLOCATED_QTY',
        'ShippinglinesTableMap::COL_ALLOCATED_QTY' => 'ALLOCATED_QTY',
        'COL_ALLOCATED_QTY' => 'ALLOCATED_QTY',
        'allocated_qty' => 'ALLOCATED_QTY',
        'shippinglines.allocated_qty' => 'ALLOCATED_QTY',
        'Rate' => 'RATE',
        'Shippinglines.Rate' => 'RATE',
        'rate' => 'RATE',
        'shippinglines.rate' => 'RATE',
        'ShippinglinesTableMap::COL_RATE' => 'RATE',
        'COL_RATE' => 'RATE',
        'CompanyId' => 'COMPANY_ID',
        'Shippinglines.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'shippinglines.companyId' => 'COMPANY_ID',
        'ShippinglinesTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'shippinglines.company_id' => 'COMPANY_ID',
        'OrderlineId' => 'ORDERLINE_ID',
        'Shippinglines.OrderlineId' => 'ORDERLINE_ID',
        'orderlineId' => 'ORDERLINE_ID',
        'shippinglines.orderlineId' => 'ORDERLINE_ID',
        'ShippinglinesTableMap::COL_ORDERLINE_ID' => 'ORDERLINE_ID',
        'COL_ORDERLINE_ID' => 'ORDERLINE_ID',
        'orderline_id' => 'ORDERLINE_ID',
        'shippinglines.orderline_id' => 'ORDERLINE_ID',
        'CreatedDate' => 'CREATED_DATE',
        'Shippinglines.CreatedDate' => 'CREATED_DATE',
        'createdDate' => 'CREATED_DATE',
        'shippinglines.createdDate' => 'CREATED_DATE',
        'ShippinglinesTableMap::COL_CREATED_DATE' => 'CREATED_DATE',
        'COL_CREATED_DATE' => 'CREATED_DATE',
        'created_date' => 'CREATED_DATE',
        'shippinglines.created_date' => 'CREATED_DATE',
        'IntegrationId' => 'INTEGRATION_ID',
        'Shippinglines.IntegrationId' => 'INTEGRATION_ID',
        'integrationId' => 'INTEGRATION_ID',
        'shippinglines.integrationId' => 'INTEGRATION_ID',
        'ShippinglinesTableMap::COL_INTEGRATION_ID' => 'INTEGRATION_ID',
        'COL_INTEGRATION_ID' => 'INTEGRATION_ID',
        'integration_id' => 'INTEGRATION_ID',
        'shippinglines.integration_id' => 'INTEGRATION_ID',
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
        $this->setName('shippinglines');
        $this->setPhpName('Shippinglines');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Shippinglines');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('shippinglines_solid_seq');
        // columns
        $this->addPrimaryKey('solid', 'Solid', 'BIGINT', true, null, null);
        $this->addForeignKey('soid', 'Soid', 'BIGINT', 'shippingorder', 'soid', true, null, null);
        $this->addForeignKey('product_id', 'ProductId', 'INTEGER', 'products', 'id', true, null, null);
        $this->addColumn('qty', 'Qty', 'INTEGER', true, null, null);
        $this->addColumn('allocated_qty', 'AllocatedQty', 'INTEGER', false, null, null);
        $this->addColumn('rate', 'Rate', 'DECIMAL', false, 20, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addForeignKey('orderline_id', 'OrderlineId', 'BIGINT', 'orderlines', 'orderline_id', true, null, 0);
        $this->addColumn('created_date', 'CreatedDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('integration_id', 'IntegrationId', 'VARCHAR', false, 50, null);
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
        $this->addRelation('Orderlines', '\\entities\\Orderlines', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':orderline_id',
    1 => ':orderline_id',
  ),
), null, null, null, false);
        $this->addRelation('Products', '\\entities\\Products', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Shippingorder', '\\entities\\Shippingorder', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':soid',
    1 => ':soid',
  ),
), null, null, null, false);
        $this->addRelation('Shippinglineallocation', '\\entities\\Shippinglineallocation', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':solid',
    1 => ':solid',
  ),
), null, null, 'Shippinglineallocations', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Solid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Solid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Solid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Solid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Solid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Solid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Solid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ShippinglinesTableMap::CLASS_DEFAULT : ShippinglinesTableMap::OM_CLASS;
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
     * @return array (Shippinglines object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ShippinglinesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ShippinglinesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ShippinglinesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ShippinglinesTableMap::OM_CLASS;
            /** @var Shippinglines $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ShippinglinesTableMap::addInstanceToPool($obj, $key);
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
            $key = ShippinglinesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ShippinglinesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Shippinglines $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ShippinglinesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ShippinglinesTableMap::COL_SOLID);
            $criteria->addSelectColumn(ShippinglinesTableMap::COL_SOID);
            $criteria->addSelectColumn(ShippinglinesTableMap::COL_PRODUCT_ID);
            $criteria->addSelectColumn(ShippinglinesTableMap::COL_QTY);
            $criteria->addSelectColumn(ShippinglinesTableMap::COL_ALLOCATED_QTY);
            $criteria->addSelectColumn(ShippinglinesTableMap::COL_RATE);
            $criteria->addSelectColumn(ShippinglinesTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(ShippinglinesTableMap::COL_ORDERLINE_ID);
            $criteria->addSelectColumn(ShippinglinesTableMap::COL_CREATED_DATE);
            $criteria->addSelectColumn(ShippinglinesTableMap::COL_INTEGRATION_ID);
        } else {
            $criteria->addSelectColumn($alias . '.solid');
            $criteria->addSelectColumn($alias . '.soid');
            $criteria->addSelectColumn($alias . '.product_id');
            $criteria->addSelectColumn($alias . '.qty');
            $criteria->addSelectColumn($alias . '.allocated_qty');
            $criteria->addSelectColumn($alias . '.rate');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.orderline_id');
            $criteria->addSelectColumn($alias . '.created_date');
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
            $criteria->removeSelectColumn(ShippinglinesTableMap::COL_SOLID);
            $criteria->removeSelectColumn(ShippinglinesTableMap::COL_SOID);
            $criteria->removeSelectColumn(ShippinglinesTableMap::COL_PRODUCT_ID);
            $criteria->removeSelectColumn(ShippinglinesTableMap::COL_QTY);
            $criteria->removeSelectColumn(ShippinglinesTableMap::COL_ALLOCATED_QTY);
            $criteria->removeSelectColumn(ShippinglinesTableMap::COL_RATE);
            $criteria->removeSelectColumn(ShippinglinesTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(ShippinglinesTableMap::COL_ORDERLINE_ID);
            $criteria->removeSelectColumn(ShippinglinesTableMap::COL_CREATED_DATE);
            $criteria->removeSelectColumn(ShippinglinesTableMap::COL_INTEGRATION_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.solid');
            $criteria->removeSelectColumn($alias . '.soid');
            $criteria->removeSelectColumn($alias . '.product_id');
            $criteria->removeSelectColumn($alias . '.qty');
            $criteria->removeSelectColumn($alias . '.allocated_qty');
            $criteria->removeSelectColumn($alias . '.rate');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.orderline_id');
            $criteria->removeSelectColumn($alias . '.created_date');
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
        return Propel::getServiceContainer()->getDatabaseMap(ShippinglinesTableMap::DATABASE_NAME)->getTable(ShippinglinesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Shippinglines or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Shippinglines object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ShippinglinesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Shippinglines) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ShippinglinesTableMap::DATABASE_NAME);
            $criteria->add(ShippinglinesTableMap::COL_SOLID, (array) $values, Criteria::IN);
        }

        $query = ShippinglinesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ShippinglinesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ShippinglinesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the shippinglines table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ShippinglinesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Shippinglines or Criteria object.
     *
     * @param mixed $criteria Criteria or Shippinglines object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShippinglinesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Shippinglines object
        }

        if ($criteria->containsKey(ShippinglinesTableMap::COL_SOLID) && $criteria->keyContainsValue(ShippinglinesTableMap::COL_SOLID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ShippinglinesTableMap::COL_SOLID.')');
        }


        // Set the correct dbName
        $query = ShippinglinesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
