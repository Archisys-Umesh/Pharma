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
use entities\Shippinglineallocation;
use entities\ShippinglineallocationQuery;


/**
 * This class defines the structure of the 'shippinglineallocation' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ShippinglineallocationTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.ShippinglineallocationTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'shippinglineallocation';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Shippinglineallocation';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Shippinglineallocation';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Shippinglineallocation';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the solarid field
     */
    public const COL_SOLARID = 'shippinglineallocation.solarid';

    /**
     * the column name for the solid field
     */
    public const COL_SOLID = 'shippinglineallocation.solid';

    /**
     * the column name for the serial_number field
     */
    public const COL_SERIAL_NUMBER = 'shippinglineallocation.serial_number';

    /**
     * the column name for the sku_id field
     */
    public const COL_SKU_ID = 'shippinglineallocation.sku_id';

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
        self::TYPE_PHPNAME       => ['Solarid', 'Solid', 'SerialNumber', 'SkuId', ],
        self::TYPE_CAMELNAME     => ['solarid', 'solid', 'serialNumber', 'skuId', ],
        self::TYPE_COLNAME       => [ShippinglineallocationTableMap::COL_SOLARID, ShippinglineallocationTableMap::COL_SOLID, ShippinglineallocationTableMap::COL_SERIAL_NUMBER, ShippinglineallocationTableMap::COL_SKU_ID, ],
        self::TYPE_FIELDNAME     => ['solarid', 'solid', 'serial_number', 'sku_id', ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
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
        self::TYPE_PHPNAME       => ['Solarid' => 0, 'Solid' => 1, 'SerialNumber' => 2, 'SkuId' => 3, ],
        self::TYPE_CAMELNAME     => ['solarid' => 0, 'solid' => 1, 'serialNumber' => 2, 'skuId' => 3, ],
        self::TYPE_COLNAME       => [ShippinglineallocationTableMap::COL_SOLARID => 0, ShippinglineallocationTableMap::COL_SOLID => 1, ShippinglineallocationTableMap::COL_SERIAL_NUMBER => 2, ShippinglineallocationTableMap::COL_SKU_ID => 3, ],
        self::TYPE_FIELDNAME     => ['solarid' => 0, 'solid' => 1, 'serial_number' => 2, 'sku_id' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Solarid' => 'SOLARID',
        'Shippinglineallocation.Solarid' => 'SOLARID',
        'solarid' => 'SOLARID',
        'shippinglineallocation.solarid' => 'SOLARID',
        'ShippinglineallocationTableMap::COL_SOLARID' => 'SOLARID',
        'COL_SOLARID' => 'SOLARID',
        'Solid' => 'SOLID',
        'Shippinglineallocation.Solid' => 'SOLID',
        'solid' => 'SOLID',
        'shippinglineallocation.solid' => 'SOLID',
        'ShippinglineallocationTableMap::COL_SOLID' => 'SOLID',
        'COL_SOLID' => 'SOLID',
        'SerialNumber' => 'SERIAL_NUMBER',
        'Shippinglineallocation.SerialNumber' => 'SERIAL_NUMBER',
        'serialNumber' => 'SERIAL_NUMBER',
        'shippinglineallocation.serialNumber' => 'SERIAL_NUMBER',
        'ShippinglineallocationTableMap::COL_SERIAL_NUMBER' => 'SERIAL_NUMBER',
        'COL_SERIAL_NUMBER' => 'SERIAL_NUMBER',
        'serial_number' => 'SERIAL_NUMBER',
        'shippinglineallocation.serial_number' => 'SERIAL_NUMBER',
        'SkuId' => 'SKU_ID',
        'Shippinglineallocation.SkuId' => 'SKU_ID',
        'skuId' => 'SKU_ID',
        'shippinglineallocation.skuId' => 'SKU_ID',
        'ShippinglineallocationTableMap::COL_SKU_ID' => 'SKU_ID',
        'COL_SKU_ID' => 'SKU_ID',
        'sku_id' => 'SKU_ID',
        'shippinglineallocation.sku_id' => 'SKU_ID',
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
        $this->setName('shippinglineallocation');
        $this->setPhpName('Shippinglineallocation');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Shippinglineallocation');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('shippinglineallocation_solarid_seq');
        // columns
        $this->addPrimaryKey('solarid', 'Solarid', 'BIGINT', true, null, null);
        $this->addForeignKey('solid', 'Solid', 'BIGINT', 'shippinglines', 'solid', true, null, null);
        $this->addColumn('serial_number', 'SerialNumber', 'VARCHAR', false, 50, null);
        $this->addColumn('sku_id', 'SkuId', 'VARCHAR', false, 50, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Shippinglines', '\\entities\\Shippinglines', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':solid',
    1 => ':solid',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Solarid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Solarid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Solarid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Solarid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Solarid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Solarid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Solarid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ShippinglineallocationTableMap::CLASS_DEFAULT : ShippinglineallocationTableMap::OM_CLASS;
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
     * @return array (Shippinglineallocation object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ShippinglineallocationTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ShippinglineallocationTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ShippinglineallocationTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ShippinglineallocationTableMap::OM_CLASS;
            /** @var Shippinglineallocation $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ShippinglineallocationTableMap::addInstanceToPool($obj, $key);
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
            $key = ShippinglineallocationTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ShippinglineallocationTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Shippinglineallocation $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ShippinglineallocationTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ShippinglineallocationTableMap::COL_SOLARID);
            $criteria->addSelectColumn(ShippinglineallocationTableMap::COL_SOLID);
            $criteria->addSelectColumn(ShippinglineallocationTableMap::COL_SERIAL_NUMBER);
            $criteria->addSelectColumn(ShippinglineallocationTableMap::COL_SKU_ID);
        } else {
            $criteria->addSelectColumn($alias . '.solarid');
            $criteria->addSelectColumn($alias . '.solid');
            $criteria->addSelectColumn($alias . '.serial_number');
            $criteria->addSelectColumn($alias . '.sku_id');
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
            $criteria->removeSelectColumn(ShippinglineallocationTableMap::COL_SOLARID);
            $criteria->removeSelectColumn(ShippinglineallocationTableMap::COL_SOLID);
            $criteria->removeSelectColumn(ShippinglineallocationTableMap::COL_SERIAL_NUMBER);
            $criteria->removeSelectColumn(ShippinglineallocationTableMap::COL_SKU_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.solarid');
            $criteria->removeSelectColumn($alias . '.solid');
            $criteria->removeSelectColumn($alias . '.serial_number');
            $criteria->removeSelectColumn($alias . '.sku_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(ShippinglineallocationTableMap::DATABASE_NAME)->getTable(ShippinglineallocationTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Shippinglineallocation or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Shippinglineallocation object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ShippinglineallocationTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Shippinglineallocation) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ShippinglineallocationTableMap::DATABASE_NAME);
            $criteria->add(ShippinglineallocationTableMap::COL_SOLARID, (array) $values, Criteria::IN);
        }

        $query = ShippinglineallocationQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ShippinglineallocationTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ShippinglineallocationTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the shippinglineallocation table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ShippinglineallocationQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Shippinglineallocation or Criteria object.
     *
     * @param mixed $criteria Criteria or Shippinglineallocation object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShippinglineallocationTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Shippinglineallocation object
        }

        if ($criteria->containsKey(ShippinglineallocationTableMap::COL_SOLARID) && $criteria->keyContainsValue(ShippinglineallocationTableMap::COL_SOLARID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ShippinglineallocationTableMap::COL_SOLARID.')');
        }


        // Set the correct dbName
        $query = ShippinglineallocationQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
