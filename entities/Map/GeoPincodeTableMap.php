<?php

namespace entities\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use entities\GeoPincode;
use entities\GeoPincodeQuery;


/**
 * This class defines the structure of the 'geo_pincode' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class GeoPincodeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.GeoPincodeTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'geo_pincode';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'GeoPincode';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\GeoPincode';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.GeoPincode';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the poname field
     */
    public const COL_PONAME = 'geo_pincode.poname';

    /**
     * the column name for the pincode field
     */
    public const COL_PINCODE = 'geo_pincode.pincode';

    /**
     * the column name for the taluka field
     */
    public const COL_TALUKA = 'geo_pincode.taluka';

    /**
     * the column name for the district field
     */
    public const COL_DISTRICT = 'geo_pincode.district';

    /**
     * the column name for the state field
     */
    public const COL_STATE = 'geo_pincode.state';

    /**
     * the column name for the phone field
     */
    public const COL_PHONE = 'geo_pincode.phone';

    /**
     * the column name for the longitude field
     */
    public const COL_LONGITUDE = 'geo_pincode.longitude';

    /**
     * the column name for the latitude field
     */
    public const COL_LATITUDE = 'geo_pincode.latitude';

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
        self::TYPE_PHPNAME       => ['Poname', 'Pincode', 'Taluka', 'District', 'State', 'Phone', 'Longitude', 'Latitude', ],
        self::TYPE_CAMELNAME     => ['poname', 'pincode', 'taluka', 'district', 'state', 'phone', 'longitude', 'latitude', ],
        self::TYPE_COLNAME       => [GeoPincodeTableMap::COL_PONAME, GeoPincodeTableMap::COL_PINCODE, GeoPincodeTableMap::COL_TALUKA, GeoPincodeTableMap::COL_DISTRICT, GeoPincodeTableMap::COL_STATE, GeoPincodeTableMap::COL_PHONE, GeoPincodeTableMap::COL_LONGITUDE, GeoPincodeTableMap::COL_LATITUDE, ],
        self::TYPE_FIELDNAME     => ['poname', 'pincode', 'taluka', 'district', 'state', 'phone', 'longitude', 'latitude', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
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
        self::TYPE_PHPNAME       => ['Poname' => 0, 'Pincode' => 1, 'Taluka' => 2, 'District' => 3, 'State' => 4, 'Phone' => 5, 'Longitude' => 6, 'Latitude' => 7, ],
        self::TYPE_CAMELNAME     => ['poname' => 0, 'pincode' => 1, 'taluka' => 2, 'district' => 3, 'state' => 4, 'phone' => 5, 'longitude' => 6, 'latitude' => 7, ],
        self::TYPE_COLNAME       => [GeoPincodeTableMap::COL_PONAME => 0, GeoPincodeTableMap::COL_PINCODE => 1, GeoPincodeTableMap::COL_TALUKA => 2, GeoPincodeTableMap::COL_DISTRICT => 3, GeoPincodeTableMap::COL_STATE => 4, GeoPincodeTableMap::COL_PHONE => 5, GeoPincodeTableMap::COL_LONGITUDE => 6, GeoPincodeTableMap::COL_LATITUDE => 7, ],
        self::TYPE_FIELDNAME     => ['poname' => 0, 'pincode' => 1, 'taluka' => 2, 'district' => 3, 'state' => 4, 'phone' => 5, 'longitude' => 6, 'latitude' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Poname' => 'PONAME',
        'GeoPincode.Poname' => 'PONAME',
        'poname' => 'PONAME',
        'geoPincode.poname' => 'PONAME',
        'GeoPincodeTableMap::COL_PONAME' => 'PONAME',
        'COL_PONAME' => 'PONAME',
        'geo_pincode.poname' => 'PONAME',
        'Pincode' => 'PINCODE',
        'GeoPincode.Pincode' => 'PINCODE',
        'pincode' => 'PINCODE',
        'geoPincode.pincode' => 'PINCODE',
        'GeoPincodeTableMap::COL_PINCODE' => 'PINCODE',
        'COL_PINCODE' => 'PINCODE',
        'geo_pincode.pincode' => 'PINCODE',
        'Taluka' => 'TALUKA',
        'GeoPincode.Taluka' => 'TALUKA',
        'taluka' => 'TALUKA',
        'geoPincode.taluka' => 'TALUKA',
        'GeoPincodeTableMap::COL_TALUKA' => 'TALUKA',
        'COL_TALUKA' => 'TALUKA',
        'geo_pincode.taluka' => 'TALUKA',
        'District' => 'DISTRICT',
        'GeoPincode.District' => 'DISTRICT',
        'district' => 'DISTRICT',
        'geoPincode.district' => 'DISTRICT',
        'GeoPincodeTableMap::COL_DISTRICT' => 'DISTRICT',
        'COL_DISTRICT' => 'DISTRICT',
        'geo_pincode.district' => 'DISTRICT',
        'State' => 'STATE',
        'GeoPincode.State' => 'STATE',
        'state' => 'STATE',
        'geoPincode.state' => 'STATE',
        'GeoPincodeTableMap::COL_STATE' => 'STATE',
        'COL_STATE' => 'STATE',
        'geo_pincode.state' => 'STATE',
        'Phone' => 'PHONE',
        'GeoPincode.Phone' => 'PHONE',
        'phone' => 'PHONE',
        'geoPincode.phone' => 'PHONE',
        'GeoPincodeTableMap::COL_PHONE' => 'PHONE',
        'COL_PHONE' => 'PHONE',
        'geo_pincode.phone' => 'PHONE',
        'Longitude' => 'LONGITUDE',
        'GeoPincode.Longitude' => 'LONGITUDE',
        'longitude' => 'LONGITUDE',
        'geoPincode.longitude' => 'LONGITUDE',
        'GeoPincodeTableMap::COL_LONGITUDE' => 'LONGITUDE',
        'COL_LONGITUDE' => 'LONGITUDE',
        'geo_pincode.longitude' => 'LONGITUDE',
        'Latitude' => 'LATITUDE',
        'GeoPincode.Latitude' => 'LATITUDE',
        'latitude' => 'LATITUDE',
        'geoPincode.latitude' => 'LATITUDE',
        'GeoPincodeTableMap::COL_LATITUDE' => 'LATITUDE',
        'COL_LATITUDE' => 'LATITUDE',
        'geo_pincode.latitude' => 'LATITUDE',
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
        $this->setName('geo_pincode');
        $this->setPhpName('GeoPincode');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\GeoPincode');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addColumn('poname', 'Poname', 'VARCHAR', false, 100, null);
        $this->addColumn('pincode', 'Pincode', 'VARCHAR', false, 100, null);
        $this->addColumn('taluka', 'Taluka', 'VARCHAR', false, 100, null);
        $this->addColumn('district', 'District', 'VARCHAR', false, 100, null);
        $this->addColumn('state', 'State', 'VARCHAR', false, 100, null);
        $this->addColumn('phone', 'Phone', 'VARCHAR', false, 100, null);
        $this->addColumn('longitude', 'Longitude', 'VARCHAR', false, 50, null);
        $this->addColumn('latitude', 'Latitude', 'VARCHAR', false, 50, null);
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
        return null;
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
        return '';
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
        return $withPrefix ? GeoPincodeTableMap::CLASS_DEFAULT : GeoPincodeTableMap::OM_CLASS;
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
     * @return array (GeoPincode object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = GeoPincodeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = GeoPincodeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + GeoPincodeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = GeoPincodeTableMap::OM_CLASS;
            /** @var GeoPincode $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            GeoPincodeTableMap::addInstanceToPool($obj, $key);
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
            $key = GeoPincodeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = GeoPincodeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var GeoPincode $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                GeoPincodeTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(GeoPincodeTableMap::COL_PONAME);
            $criteria->addSelectColumn(GeoPincodeTableMap::COL_PINCODE);
            $criteria->addSelectColumn(GeoPincodeTableMap::COL_TALUKA);
            $criteria->addSelectColumn(GeoPincodeTableMap::COL_DISTRICT);
            $criteria->addSelectColumn(GeoPincodeTableMap::COL_STATE);
            $criteria->addSelectColumn(GeoPincodeTableMap::COL_PHONE);
            $criteria->addSelectColumn(GeoPincodeTableMap::COL_LONGITUDE);
            $criteria->addSelectColumn(GeoPincodeTableMap::COL_LATITUDE);
        } else {
            $criteria->addSelectColumn($alias . '.poname');
            $criteria->addSelectColumn($alias . '.pincode');
            $criteria->addSelectColumn($alias . '.taluka');
            $criteria->addSelectColumn($alias . '.district');
            $criteria->addSelectColumn($alias . '.state');
            $criteria->addSelectColumn($alias . '.phone');
            $criteria->addSelectColumn($alias . '.longitude');
            $criteria->addSelectColumn($alias . '.latitude');
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
            $criteria->removeSelectColumn(GeoPincodeTableMap::COL_PONAME);
            $criteria->removeSelectColumn(GeoPincodeTableMap::COL_PINCODE);
            $criteria->removeSelectColumn(GeoPincodeTableMap::COL_TALUKA);
            $criteria->removeSelectColumn(GeoPincodeTableMap::COL_DISTRICT);
            $criteria->removeSelectColumn(GeoPincodeTableMap::COL_STATE);
            $criteria->removeSelectColumn(GeoPincodeTableMap::COL_PHONE);
            $criteria->removeSelectColumn(GeoPincodeTableMap::COL_LONGITUDE);
            $criteria->removeSelectColumn(GeoPincodeTableMap::COL_LATITUDE);
        } else {
            $criteria->removeSelectColumn($alias . '.poname');
            $criteria->removeSelectColumn($alias . '.pincode');
            $criteria->removeSelectColumn($alias . '.taluka');
            $criteria->removeSelectColumn($alias . '.district');
            $criteria->removeSelectColumn($alias . '.state');
            $criteria->removeSelectColumn($alias . '.phone');
            $criteria->removeSelectColumn($alias . '.longitude');
            $criteria->removeSelectColumn($alias . '.latitude');
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
        return Propel::getServiceContainer()->getDatabaseMap(GeoPincodeTableMap::DATABASE_NAME)->getTable(GeoPincodeTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a GeoPincode or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or GeoPincode object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(GeoPincodeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\GeoPincode) { // it's a model object
            // create criteria based on pk value
            $criteria = $values->buildCriteria();
        } else { // it's a primary key, or an array of pks
            throw new LogicException('The GeoPincode object has no primary key');
        }

        $query = GeoPincodeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            GeoPincodeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                GeoPincodeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the geo_pincode table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return GeoPincodeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a GeoPincode or Criteria object.
     *
     * @param mixed $criteria Criteria or GeoPincode object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GeoPincodeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from GeoPincode object
        }


        // Set the correct dbName
        $query = GeoPincodeQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
