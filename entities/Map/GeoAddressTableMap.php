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
use entities\GeoAddress;
use entities\GeoAddressQuery;


/**
 * This class defines the structure of the 'geo_address' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class GeoAddressTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.GeoAddressTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'geo_address';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'GeoAddress';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\GeoAddress';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.GeoAddress';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the geo_address_id field
     */
    public const COL_GEO_ADDRESS_ID = 'geo_address.geo_address_id';

    /**
     * the column name for the lat_long field
     */
    public const COL_LAT_LONG = 'geo_address.lat_long';

    /**
     * the column name for the zipcode field
     */
    public const COL_ZIPCODE = 'geo_address.zipcode';

    /**
     * the column name for the address field
     */
    public const COL_ADDRESS = 'geo_address.address';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'geo_address.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'geo_address.updated_at';

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
        self::TYPE_PHPNAME       => ['GeoAddressId', 'LatLong', 'Zipcode', 'Address', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['geoAddressId', 'latLong', 'zipcode', 'address', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [GeoAddressTableMap::COL_GEO_ADDRESS_ID, GeoAddressTableMap::COL_LAT_LONG, GeoAddressTableMap::COL_ZIPCODE, GeoAddressTableMap::COL_ADDRESS, GeoAddressTableMap::COL_CREATED_AT, GeoAddressTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['geo_address_id', 'lat_long', 'zipcode', 'address', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
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
        self::TYPE_PHPNAME       => ['GeoAddressId' => 0, 'LatLong' => 1, 'Zipcode' => 2, 'Address' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ],
        self::TYPE_CAMELNAME     => ['geoAddressId' => 0, 'latLong' => 1, 'zipcode' => 2, 'address' => 3, 'createdAt' => 4, 'updatedAt' => 5, ],
        self::TYPE_COLNAME       => [GeoAddressTableMap::COL_GEO_ADDRESS_ID => 0, GeoAddressTableMap::COL_LAT_LONG => 1, GeoAddressTableMap::COL_ZIPCODE => 2, GeoAddressTableMap::COL_ADDRESS => 3, GeoAddressTableMap::COL_CREATED_AT => 4, GeoAddressTableMap::COL_UPDATED_AT => 5, ],
        self::TYPE_FIELDNAME     => ['geo_address_id' => 0, 'lat_long' => 1, 'zipcode' => 2, 'address' => 3, 'created_at' => 4, 'updated_at' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'GeoAddressId' => 'GEO_ADDRESS_ID',
        'GeoAddress.GeoAddressId' => 'GEO_ADDRESS_ID',
        'geoAddressId' => 'GEO_ADDRESS_ID',
        'geoAddress.geoAddressId' => 'GEO_ADDRESS_ID',
        'GeoAddressTableMap::COL_GEO_ADDRESS_ID' => 'GEO_ADDRESS_ID',
        'COL_GEO_ADDRESS_ID' => 'GEO_ADDRESS_ID',
        'geo_address_id' => 'GEO_ADDRESS_ID',
        'geo_address.geo_address_id' => 'GEO_ADDRESS_ID',
        'LatLong' => 'LAT_LONG',
        'GeoAddress.LatLong' => 'LAT_LONG',
        'latLong' => 'LAT_LONG',
        'geoAddress.latLong' => 'LAT_LONG',
        'GeoAddressTableMap::COL_LAT_LONG' => 'LAT_LONG',
        'COL_LAT_LONG' => 'LAT_LONG',
        'lat_long' => 'LAT_LONG',
        'geo_address.lat_long' => 'LAT_LONG',
        'Zipcode' => 'ZIPCODE',
        'GeoAddress.Zipcode' => 'ZIPCODE',
        'zipcode' => 'ZIPCODE',
        'geoAddress.zipcode' => 'ZIPCODE',
        'GeoAddressTableMap::COL_ZIPCODE' => 'ZIPCODE',
        'COL_ZIPCODE' => 'ZIPCODE',
        'geo_address.zipcode' => 'ZIPCODE',
        'Address' => 'ADDRESS',
        'GeoAddress.Address' => 'ADDRESS',
        'address' => 'ADDRESS',
        'geoAddress.address' => 'ADDRESS',
        'GeoAddressTableMap::COL_ADDRESS' => 'ADDRESS',
        'COL_ADDRESS' => 'ADDRESS',
        'geo_address.address' => 'ADDRESS',
        'CreatedAt' => 'CREATED_AT',
        'GeoAddress.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'geoAddress.createdAt' => 'CREATED_AT',
        'GeoAddressTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'geo_address.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'GeoAddress.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'geoAddress.updatedAt' => 'UPDATED_AT',
        'GeoAddressTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'geo_address.updated_at' => 'UPDATED_AT',
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
        $this->setName('geo_address');
        $this->setPhpName('GeoAddress');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\GeoAddress');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('geo_address_geo_address_id_seq');
        // columns
        $this->addPrimaryKey('geo_address_id', 'GeoAddressId', 'INTEGER', true, null, null);
        $this->addColumn('lat_long', 'LatLong', 'VARCHAR', true, null, null);
        $this->addColumn('zipcode', 'Zipcode', 'VARCHAR', true, null, null);
        $this->addColumn('address', 'Address', 'VARCHAR', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GeoAddressId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GeoAddressId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GeoAddressId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GeoAddressId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GeoAddressId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GeoAddressId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('GeoAddressId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? GeoAddressTableMap::CLASS_DEFAULT : GeoAddressTableMap::OM_CLASS;
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
     * @return array (GeoAddress object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = GeoAddressTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = GeoAddressTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + GeoAddressTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = GeoAddressTableMap::OM_CLASS;
            /** @var GeoAddress $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            GeoAddressTableMap::addInstanceToPool($obj, $key);
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
            $key = GeoAddressTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = GeoAddressTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var GeoAddress $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                GeoAddressTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(GeoAddressTableMap::COL_GEO_ADDRESS_ID);
            $criteria->addSelectColumn(GeoAddressTableMap::COL_LAT_LONG);
            $criteria->addSelectColumn(GeoAddressTableMap::COL_ZIPCODE);
            $criteria->addSelectColumn(GeoAddressTableMap::COL_ADDRESS);
            $criteria->addSelectColumn(GeoAddressTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(GeoAddressTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.geo_address_id');
            $criteria->addSelectColumn($alias . '.lat_long');
            $criteria->addSelectColumn($alias . '.zipcode');
            $criteria->addSelectColumn($alias . '.address');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
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
            $criteria->removeSelectColumn(GeoAddressTableMap::COL_GEO_ADDRESS_ID);
            $criteria->removeSelectColumn(GeoAddressTableMap::COL_LAT_LONG);
            $criteria->removeSelectColumn(GeoAddressTableMap::COL_ZIPCODE);
            $criteria->removeSelectColumn(GeoAddressTableMap::COL_ADDRESS);
            $criteria->removeSelectColumn(GeoAddressTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(GeoAddressTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.geo_address_id');
            $criteria->removeSelectColumn($alias . '.lat_long');
            $criteria->removeSelectColumn($alias . '.zipcode');
            $criteria->removeSelectColumn($alias . '.address');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(GeoAddressTableMap::DATABASE_NAME)->getTable(GeoAddressTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a GeoAddress or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or GeoAddress object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(GeoAddressTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\GeoAddress) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(GeoAddressTableMap::DATABASE_NAME);
            $criteria->add(GeoAddressTableMap::COL_GEO_ADDRESS_ID, (array) $values, Criteria::IN);
        }

        $query = GeoAddressQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            GeoAddressTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                GeoAddressTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the geo_address table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return GeoAddressQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a GeoAddress or Criteria object.
     *
     * @param mixed $criteria Criteria or GeoAddress object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GeoAddressTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from GeoAddress object
        }

        if ($criteria->containsKey(GeoAddressTableMap::COL_GEO_ADDRESS_ID) && $criteria->keyContainsValue(GeoAddressTableMap::COL_GEO_ADDRESS_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.GeoAddressTableMap::COL_GEO_ADDRESS_ID.')');
        }


        // Set the correct dbName
        $query = GeoAddressQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
