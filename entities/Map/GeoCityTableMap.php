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
use entities\GeoCity;
use entities\GeoCityQuery;


/**
 * This class defines the structure of the 'geo_city' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class GeoCityTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.GeoCityTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'geo_city';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'GeoCity';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\GeoCity';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.GeoCity';

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
     * the column name for the icityid field
     */
    public const COL_ICITYID = 'geo_city.icityid';

    /**
     * the column name for the scityname field
     */
    public const COL_SCITYNAME = 'geo_city.scityname';

    /**
     * the column name for the scitycode field
     */
    public const COL_SCITYCODE = 'geo_city.scitycode';

    /**
     * the column name for the istateid field
     */
    public const COL_ISTATEID = 'geo_city.istateid';

    /**
     * the column name for the icountryid field
     */
    public const COL_ICOUNTRYID = 'geo_city.icountryid';

    /**
     * the column name for the dcreateddate field
     */
    public const COL_DCREATEDDATE = 'geo_city.dcreateddate';

    /**
     * the column name for the dmodifydate field
     */
    public const COL_DMODIFYDATE = 'geo_city.dmodifydate';

    /**
     * the column name for the sstatus field
     */
    public const COL_SSTATUS = 'geo_city.sstatus';

    /**
     * the column name for the longitude field
     */
    public const COL_LONGITUDE = 'geo_city.longitude';

    /**
     * the column name for the latitude field
     */
    public const COL_LATITUDE = 'geo_city.latitude';

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
        self::TYPE_PHPNAME       => ['Icityid', 'Scityname', 'Scitycode', 'Istateid', 'Icountryid', 'Dcreateddate', 'Dmodifydate', 'Sstatus', 'Longitude', 'Latitude', ],
        self::TYPE_CAMELNAME     => ['icityid', 'scityname', 'scitycode', 'istateid', 'icountryid', 'dcreateddate', 'dmodifydate', 'sstatus', 'longitude', 'latitude', ],
        self::TYPE_COLNAME       => [GeoCityTableMap::COL_ICITYID, GeoCityTableMap::COL_SCITYNAME, GeoCityTableMap::COL_SCITYCODE, GeoCityTableMap::COL_ISTATEID, GeoCityTableMap::COL_ICOUNTRYID, GeoCityTableMap::COL_DCREATEDDATE, GeoCityTableMap::COL_DMODIFYDATE, GeoCityTableMap::COL_SSTATUS, GeoCityTableMap::COL_LONGITUDE, GeoCityTableMap::COL_LATITUDE, ],
        self::TYPE_FIELDNAME     => ['icityid', 'scityname', 'scitycode', 'istateid', 'icountryid', 'dcreateddate', 'dmodifydate', 'sstatus', 'longitude', 'latitude', ],
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
        self::TYPE_PHPNAME       => ['Icityid' => 0, 'Scityname' => 1, 'Scitycode' => 2, 'Istateid' => 3, 'Icountryid' => 4, 'Dcreateddate' => 5, 'Dmodifydate' => 6, 'Sstatus' => 7, 'Longitude' => 8, 'Latitude' => 9, ],
        self::TYPE_CAMELNAME     => ['icityid' => 0, 'scityname' => 1, 'scitycode' => 2, 'istateid' => 3, 'icountryid' => 4, 'dcreateddate' => 5, 'dmodifydate' => 6, 'sstatus' => 7, 'longitude' => 8, 'latitude' => 9, ],
        self::TYPE_COLNAME       => [GeoCityTableMap::COL_ICITYID => 0, GeoCityTableMap::COL_SCITYNAME => 1, GeoCityTableMap::COL_SCITYCODE => 2, GeoCityTableMap::COL_ISTATEID => 3, GeoCityTableMap::COL_ICOUNTRYID => 4, GeoCityTableMap::COL_DCREATEDDATE => 5, GeoCityTableMap::COL_DMODIFYDATE => 6, GeoCityTableMap::COL_SSTATUS => 7, GeoCityTableMap::COL_LONGITUDE => 8, GeoCityTableMap::COL_LATITUDE => 9, ],
        self::TYPE_FIELDNAME     => ['icityid' => 0, 'scityname' => 1, 'scitycode' => 2, 'istateid' => 3, 'icountryid' => 4, 'dcreateddate' => 5, 'dmodifydate' => 6, 'sstatus' => 7, 'longitude' => 8, 'latitude' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Icityid' => 'ICITYID',
        'GeoCity.Icityid' => 'ICITYID',
        'icityid' => 'ICITYID',
        'geoCity.icityid' => 'ICITYID',
        'GeoCityTableMap::COL_ICITYID' => 'ICITYID',
        'COL_ICITYID' => 'ICITYID',
        'geo_city.icityid' => 'ICITYID',
        'Scityname' => 'SCITYNAME',
        'GeoCity.Scityname' => 'SCITYNAME',
        'scityname' => 'SCITYNAME',
        'geoCity.scityname' => 'SCITYNAME',
        'GeoCityTableMap::COL_SCITYNAME' => 'SCITYNAME',
        'COL_SCITYNAME' => 'SCITYNAME',
        'geo_city.scityname' => 'SCITYNAME',
        'Scitycode' => 'SCITYCODE',
        'GeoCity.Scitycode' => 'SCITYCODE',
        'scitycode' => 'SCITYCODE',
        'geoCity.scitycode' => 'SCITYCODE',
        'GeoCityTableMap::COL_SCITYCODE' => 'SCITYCODE',
        'COL_SCITYCODE' => 'SCITYCODE',
        'geo_city.scitycode' => 'SCITYCODE',
        'Istateid' => 'ISTATEID',
        'GeoCity.Istateid' => 'ISTATEID',
        'istateid' => 'ISTATEID',
        'geoCity.istateid' => 'ISTATEID',
        'GeoCityTableMap::COL_ISTATEID' => 'ISTATEID',
        'COL_ISTATEID' => 'ISTATEID',
        'geo_city.istateid' => 'ISTATEID',
        'Icountryid' => 'ICOUNTRYID',
        'GeoCity.Icountryid' => 'ICOUNTRYID',
        'icountryid' => 'ICOUNTRYID',
        'geoCity.icountryid' => 'ICOUNTRYID',
        'GeoCityTableMap::COL_ICOUNTRYID' => 'ICOUNTRYID',
        'COL_ICOUNTRYID' => 'ICOUNTRYID',
        'geo_city.icountryid' => 'ICOUNTRYID',
        'Dcreateddate' => 'DCREATEDDATE',
        'GeoCity.Dcreateddate' => 'DCREATEDDATE',
        'dcreateddate' => 'DCREATEDDATE',
        'geoCity.dcreateddate' => 'DCREATEDDATE',
        'GeoCityTableMap::COL_DCREATEDDATE' => 'DCREATEDDATE',
        'COL_DCREATEDDATE' => 'DCREATEDDATE',
        'geo_city.dcreateddate' => 'DCREATEDDATE',
        'Dmodifydate' => 'DMODIFYDATE',
        'GeoCity.Dmodifydate' => 'DMODIFYDATE',
        'dmodifydate' => 'DMODIFYDATE',
        'geoCity.dmodifydate' => 'DMODIFYDATE',
        'GeoCityTableMap::COL_DMODIFYDATE' => 'DMODIFYDATE',
        'COL_DMODIFYDATE' => 'DMODIFYDATE',
        'geo_city.dmodifydate' => 'DMODIFYDATE',
        'Sstatus' => 'SSTATUS',
        'GeoCity.Sstatus' => 'SSTATUS',
        'sstatus' => 'SSTATUS',
        'geoCity.sstatus' => 'SSTATUS',
        'GeoCityTableMap::COL_SSTATUS' => 'SSTATUS',
        'COL_SSTATUS' => 'SSTATUS',
        'geo_city.sstatus' => 'SSTATUS',
        'Longitude' => 'LONGITUDE',
        'GeoCity.Longitude' => 'LONGITUDE',
        'longitude' => 'LONGITUDE',
        'geoCity.longitude' => 'LONGITUDE',
        'GeoCityTableMap::COL_LONGITUDE' => 'LONGITUDE',
        'COL_LONGITUDE' => 'LONGITUDE',
        'geo_city.longitude' => 'LONGITUDE',
        'Latitude' => 'LATITUDE',
        'GeoCity.Latitude' => 'LATITUDE',
        'latitude' => 'LATITUDE',
        'geoCity.latitude' => 'LATITUDE',
        'GeoCityTableMap::COL_LATITUDE' => 'LATITUDE',
        'COL_LATITUDE' => 'LATITUDE',
        'geo_city.latitude' => 'LATITUDE',
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
        $this->setName('geo_city');
        $this->setPhpName('GeoCity');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\GeoCity');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('geo_city_icityid_seq');
        // columns
        $this->addPrimaryKey('icityid', 'Icityid', 'BIGINT', true, null, null);
        $this->addColumn('scityname', 'Scityname', 'VARCHAR', false, 50, null);
        $this->addColumn('scitycode', 'Scitycode', 'VARCHAR', false, 50, null);
        $this->addForeignKey('istateid', 'Istateid', 'INTEGER', 'geo_state', 'istateid', false, null, null);
        $this->addForeignKey('icountryid', 'Icountryid', 'INTEGER', 'geo_country', 'icountryid', false, null, null);
        $this->addColumn('dcreateddate', 'Dcreateddate', 'TIMESTAMP', false, null, null);
        $this->addColumn('dmodifydate', 'Dmodifydate', 'TIMESTAMP', false, null, null);
        $this->addColumn('sstatus', 'Sstatus', 'VARCHAR', false, 50, null);
        $this->addColumn('longitude', 'Longitude', 'DECIMAL', false, 11, null);
        $this->addColumn('latitude', 'Latitude', 'DECIMAL', false, 11, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('GeoState', '\\entities\\GeoState', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':istateid',
    1 => ':istateid',
  ),
), null, null, null, false);
        $this->addRelation('GeoCountry', '\\entities\\GeoCountry', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':icountryid',
    1 => ':icountryid',
  ),
), null, null, null, false);
        $this->addRelation('GeoTowns', '\\entities\\GeoTowns', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':icityid',
    1 => ':icityid',
  ),
), null, null, 'GeoTownss', false);
        $this->addRelation('OnBoardRequestAddress', '\\entities\\OnBoardRequestAddress', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':icityid',
    1 => ':icityid',
  ),
), null, null, 'OnBoardRequestAddresses', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Icityid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Icityid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Icityid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Icityid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Icityid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Icityid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Icityid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? GeoCityTableMap::CLASS_DEFAULT : GeoCityTableMap::OM_CLASS;
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
     * @return array (GeoCity object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = GeoCityTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = GeoCityTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + GeoCityTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = GeoCityTableMap::OM_CLASS;
            /** @var GeoCity $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            GeoCityTableMap::addInstanceToPool($obj, $key);
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
            $key = GeoCityTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = GeoCityTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var GeoCity $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                GeoCityTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(GeoCityTableMap::COL_ICITYID);
            $criteria->addSelectColumn(GeoCityTableMap::COL_SCITYNAME);
            $criteria->addSelectColumn(GeoCityTableMap::COL_SCITYCODE);
            $criteria->addSelectColumn(GeoCityTableMap::COL_ISTATEID);
            $criteria->addSelectColumn(GeoCityTableMap::COL_ICOUNTRYID);
            $criteria->addSelectColumn(GeoCityTableMap::COL_DCREATEDDATE);
            $criteria->addSelectColumn(GeoCityTableMap::COL_DMODIFYDATE);
            $criteria->addSelectColumn(GeoCityTableMap::COL_SSTATUS);
            $criteria->addSelectColumn(GeoCityTableMap::COL_LONGITUDE);
            $criteria->addSelectColumn(GeoCityTableMap::COL_LATITUDE);
        } else {
            $criteria->addSelectColumn($alias . '.icityid');
            $criteria->addSelectColumn($alias . '.scityname');
            $criteria->addSelectColumn($alias . '.scitycode');
            $criteria->addSelectColumn($alias . '.istateid');
            $criteria->addSelectColumn($alias . '.icountryid');
            $criteria->addSelectColumn($alias . '.dcreateddate');
            $criteria->addSelectColumn($alias . '.dmodifydate');
            $criteria->addSelectColumn($alias . '.sstatus');
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
            $criteria->removeSelectColumn(GeoCityTableMap::COL_ICITYID);
            $criteria->removeSelectColumn(GeoCityTableMap::COL_SCITYNAME);
            $criteria->removeSelectColumn(GeoCityTableMap::COL_SCITYCODE);
            $criteria->removeSelectColumn(GeoCityTableMap::COL_ISTATEID);
            $criteria->removeSelectColumn(GeoCityTableMap::COL_ICOUNTRYID);
            $criteria->removeSelectColumn(GeoCityTableMap::COL_DCREATEDDATE);
            $criteria->removeSelectColumn(GeoCityTableMap::COL_DMODIFYDATE);
            $criteria->removeSelectColumn(GeoCityTableMap::COL_SSTATUS);
            $criteria->removeSelectColumn(GeoCityTableMap::COL_LONGITUDE);
            $criteria->removeSelectColumn(GeoCityTableMap::COL_LATITUDE);
        } else {
            $criteria->removeSelectColumn($alias . '.icityid');
            $criteria->removeSelectColumn($alias . '.scityname');
            $criteria->removeSelectColumn($alias . '.scitycode');
            $criteria->removeSelectColumn($alias . '.istateid');
            $criteria->removeSelectColumn($alias . '.icountryid');
            $criteria->removeSelectColumn($alias . '.dcreateddate');
            $criteria->removeSelectColumn($alias . '.dmodifydate');
            $criteria->removeSelectColumn($alias . '.sstatus');
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
        return Propel::getServiceContainer()->getDatabaseMap(GeoCityTableMap::DATABASE_NAME)->getTable(GeoCityTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a GeoCity or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or GeoCity object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(GeoCityTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\GeoCity) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(GeoCityTableMap::DATABASE_NAME);
            $criteria->add(GeoCityTableMap::COL_ICITYID, (array) $values, Criteria::IN);
        }

        $query = GeoCityQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            GeoCityTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                GeoCityTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the geo_city table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return GeoCityQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a GeoCity or Criteria object.
     *
     * @param mixed $criteria Criteria or GeoCity object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GeoCityTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from GeoCity object
        }

        if ($criteria->containsKey(GeoCityTableMap::COL_ICITYID) && $criteria->keyContainsValue(GeoCityTableMap::COL_ICITYID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.GeoCityTableMap::COL_ICITYID.')');
        }


        // Set the correct dbName
        $query = GeoCityQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
