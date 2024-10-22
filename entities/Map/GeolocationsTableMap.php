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
use entities\Geolocations;
use entities\GeolocationsQuery;


/**
 * This class defines the structure of the 'geolocations' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class GeolocationsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.GeolocationsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'geolocations';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Geolocations';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Geolocations';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Geolocations';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the geonameid field
     */
    public const COL_GEONAMEID = 'geolocations.geonameid';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'geolocations.name';

    /**
     * the column name for the asciiname field
     */
    public const COL_ASCIINAME = 'geolocations.asciiname';

    /**
     * the column name for the alternatenames field
     */
    public const COL_ALTERNATENAMES = 'geolocations.alternatenames';

    /**
     * the column name for the latitude field
     */
    public const COL_LATITUDE = 'geolocations.latitude';

    /**
     * the column name for the longitude field
     */
    public const COL_LONGITUDE = 'geolocations.longitude';

    /**
     * the column name for the country_code field
     */
    public const COL_COUNTRY_CODE = 'geolocations.country_code';

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
        self::TYPE_PHPNAME       => ['Geonameid', 'Name', 'Asciiname', 'Alternatenames', 'Latitude', 'Longitude', 'CountryCode', ],
        self::TYPE_CAMELNAME     => ['geonameid', 'name', 'asciiname', 'alternatenames', 'latitude', 'longitude', 'countryCode', ],
        self::TYPE_COLNAME       => [GeolocationsTableMap::COL_GEONAMEID, GeolocationsTableMap::COL_NAME, GeolocationsTableMap::COL_ASCIINAME, GeolocationsTableMap::COL_ALTERNATENAMES, GeolocationsTableMap::COL_LATITUDE, GeolocationsTableMap::COL_LONGITUDE, GeolocationsTableMap::COL_COUNTRY_CODE, ],
        self::TYPE_FIELDNAME     => ['geonameid', 'name', 'asciiname', 'alternatenames', 'latitude', 'longitude', 'country_code', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
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
        self::TYPE_PHPNAME       => ['Geonameid' => 0, 'Name' => 1, 'Asciiname' => 2, 'Alternatenames' => 3, 'Latitude' => 4, 'Longitude' => 5, 'CountryCode' => 6, ],
        self::TYPE_CAMELNAME     => ['geonameid' => 0, 'name' => 1, 'asciiname' => 2, 'alternatenames' => 3, 'latitude' => 4, 'longitude' => 5, 'countryCode' => 6, ],
        self::TYPE_COLNAME       => [GeolocationsTableMap::COL_GEONAMEID => 0, GeolocationsTableMap::COL_NAME => 1, GeolocationsTableMap::COL_ASCIINAME => 2, GeolocationsTableMap::COL_ALTERNATENAMES => 3, GeolocationsTableMap::COL_LATITUDE => 4, GeolocationsTableMap::COL_LONGITUDE => 5, GeolocationsTableMap::COL_COUNTRY_CODE => 6, ],
        self::TYPE_FIELDNAME     => ['geonameid' => 0, 'name' => 1, 'asciiname' => 2, 'alternatenames' => 3, 'latitude' => 4, 'longitude' => 5, 'country_code' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Geonameid' => 'GEONAMEID',
        'Geolocations.Geonameid' => 'GEONAMEID',
        'geonameid' => 'GEONAMEID',
        'geolocations.geonameid' => 'GEONAMEID',
        'GeolocationsTableMap::COL_GEONAMEID' => 'GEONAMEID',
        'COL_GEONAMEID' => 'GEONAMEID',
        'Name' => 'NAME',
        'Geolocations.Name' => 'NAME',
        'name' => 'NAME',
        'geolocations.name' => 'NAME',
        'GeolocationsTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'Asciiname' => 'ASCIINAME',
        'Geolocations.Asciiname' => 'ASCIINAME',
        'asciiname' => 'ASCIINAME',
        'geolocations.asciiname' => 'ASCIINAME',
        'GeolocationsTableMap::COL_ASCIINAME' => 'ASCIINAME',
        'COL_ASCIINAME' => 'ASCIINAME',
        'Alternatenames' => 'ALTERNATENAMES',
        'Geolocations.Alternatenames' => 'ALTERNATENAMES',
        'alternatenames' => 'ALTERNATENAMES',
        'geolocations.alternatenames' => 'ALTERNATENAMES',
        'GeolocationsTableMap::COL_ALTERNATENAMES' => 'ALTERNATENAMES',
        'COL_ALTERNATENAMES' => 'ALTERNATENAMES',
        'Latitude' => 'LATITUDE',
        'Geolocations.Latitude' => 'LATITUDE',
        'latitude' => 'LATITUDE',
        'geolocations.latitude' => 'LATITUDE',
        'GeolocationsTableMap::COL_LATITUDE' => 'LATITUDE',
        'COL_LATITUDE' => 'LATITUDE',
        'Longitude' => 'LONGITUDE',
        'Geolocations.Longitude' => 'LONGITUDE',
        'longitude' => 'LONGITUDE',
        'geolocations.longitude' => 'LONGITUDE',
        'GeolocationsTableMap::COL_LONGITUDE' => 'LONGITUDE',
        'COL_LONGITUDE' => 'LONGITUDE',
        'CountryCode' => 'COUNTRY_CODE',
        'Geolocations.CountryCode' => 'COUNTRY_CODE',
        'countryCode' => 'COUNTRY_CODE',
        'geolocations.countryCode' => 'COUNTRY_CODE',
        'GeolocationsTableMap::COL_COUNTRY_CODE' => 'COUNTRY_CODE',
        'COL_COUNTRY_CODE' => 'COUNTRY_CODE',
        'country_code' => 'COUNTRY_CODE',
        'geolocations.country_code' => 'COUNTRY_CODE',
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
        $this->setName('geolocations');
        $this->setPhpName('Geolocations');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Geolocations');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('geonameid', 'Geonameid', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 100, null);
        $this->addColumn('asciiname', 'Asciiname', 'VARCHAR', true, 100, null);
        $this->addColumn('alternatenames', 'Alternatenames', 'VARCHAR', true, 100, null);
        $this->addColumn('latitude', 'Latitude', 'DOUBLE', true, 53, null);
        $this->addColumn('longitude', 'Longitude', 'DOUBLE', true, 53, null);
        $this->addColumn('country_code', 'CountryCode', 'VARCHAR', true, 100, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Geonameid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Geonameid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Geonameid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Geonameid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Geonameid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Geonameid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Geonameid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? GeolocationsTableMap::CLASS_DEFAULT : GeolocationsTableMap::OM_CLASS;
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
     * @return array (Geolocations object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = GeolocationsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = GeolocationsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + GeolocationsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = GeolocationsTableMap::OM_CLASS;
            /** @var Geolocations $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            GeolocationsTableMap::addInstanceToPool($obj, $key);
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
            $key = GeolocationsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = GeolocationsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Geolocations $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                GeolocationsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(GeolocationsTableMap::COL_GEONAMEID);
            $criteria->addSelectColumn(GeolocationsTableMap::COL_NAME);
            $criteria->addSelectColumn(GeolocationsTableMap::COL_ASCIINAME);
            $criteria->addSelectColumn(GeolocationsTableMap::COL_ALTERNATENAMES);
            $criteria->addSelectColumn(GeolocationsTableMap::COL_LATITUDE);
            $criteria->addSelectColumn(GeolocationsTableMap::COL_LONGITUDE);
            $criteria->addSelectColumn(GeolocationsTableMap::COL_COUNTRY_CODE);
        } else {
            $criteria->addSelectColumn($alias . '.geonameid');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.asciiname');
            $criteria->addSelectColumn($alias . '.alternatenames');
            $criteria->addSelectColumn($alias . '.latitude');
            $criteria->addSelectColumn($alias . '.longitude');
            $criteria->addSelectColumn($alias . '.country_code');
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
            $criteria->removeSelectColumn(GeolocationsTableMap::COL_GEONAMEID);
            $criteria->removeSelectColumn(GeolocationsTableMap::COL_NAME);
            $criteria->removeSelectColumn(GeolocationsTableMap::COL_ASCIINAME);
            $criteria->removeSelectColumn(GeolocationsTableMap::COL_ALTERNATENAMES);
            $criteria->removeSelectColumn(GeolocationsTableMap::COL_LATITUDE);
            $criteria->removeSelectColumn(GeolocationsTableMap::COL_LONGITUDE);
            $criteria->removeSelectColumn(GeolocationsTableMap::COL_COUNTRY_CODE);
        } else {
            $criteria->removeSelectColumn($alias . '.geonameid');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.asciiname');
            $criteria->removeSelectColumn($alias . '.alternatenames');
            $criteria->removeSelectColumn($alias . '.latitude');
            $criteria->removeSelectColumn($alias . '.longitude');
            $criteria->removeSelectColumn($alias . '.country_code');
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
        return Propel::getServiceContainer()->getDatabaseMap(GeolocationsTableMap::DATABASE_NAME)->getTable(GeolocationsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Geolocations or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Geolocations object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(GeolocationsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Geolocations) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(GeolocationsTableMap::DATABASE_NAME);
            $criteria->add(GeolocationsTableMap::COL_GEONAMEID, (array) $values, Criteria::IN);
        }

        $query = GeolocationsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            GeolocationsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                GeolocationsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the geolocations table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return GeolocationsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Geolocations or Criteria object.
     *
     * @param mixed $criteria Criteria or Geolocations object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GeolocationsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Geolocations object
        }


        // Set the correct dbName
        $query = GeolocationsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
