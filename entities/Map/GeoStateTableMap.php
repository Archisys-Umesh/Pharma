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
use entities\GeoState;
use entities\GeoStateQuery;


/**
 * This class defines the structure of the 'geo_state' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class GeoStateTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.GeoStateTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'geo_state';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'GeoState';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\GeoState';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.GeoState';

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
     * the column name for the istateid field
     */
    public const COL_ISTATEID = 'geo_state.istateid';

    /**
     * the column name for the sstatename field
     */
    public const COL_SSTATENAME = 'geo_state.sstatename';

    /**
     * the column name for the sstatecode field
     */
    public const COL_SSTATECODE = 'geo_state.sstatecode';

    /**
     * the column name for the dcreateddate field
     */
    public const COL_DCREATEDDATE = 'geo_state.dcreateddate';

    /**
     * the column name for the dmodifydate field
     */
    public const COL_DMODIFYDATE = 'geo_state.dmodifydate';

    /**
     * the column name for the country_id field
     */
    public const COL_COUNTRY_ID = 'geo_state.country_id';

    /**
     * the column name for the sstatus field
     */
    public const COL_SSTATUS = 'geo_state.sstatus';

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
        self::TYPE_PHPNAME       => ['Istateid', 'Sstatename', 'Sstatecode', 'Dcreateddate', 'Dmodifydate', 'CountryId', 'Sstatus', ],
        self::TYPE_CAMELNAME     => ['istateid', 'sstatename', 'sstatecode', 'dcreateddate', 'dmodifydate', 'countryId', 'sstatus', ],
        self::TYPE_COLNAME       => [GeoStateTableMap::COL_ISTATEID, GeoStateTableMap::COL_SSTATENAME, GeoStateTableMap::COL_SSTATECODE, GeoStateTableMap::COL_DCREATEDDATE, GeoStateTableMap::COL_DMODIFYDATE, GeoStateTableMap::COL_COUNTRY_ID, GeoStateTableMap::COL_SSTATUS, ],
        self::TYPE_FIELDNAME     => ['istateid', 'sstatename', 'sstatecode', 'dcreateddate', 'dmodifydate', 'country_id', 'sstatus', ],
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
        self::TYPE_PHPNAME       => ['Istateid' => 0, 'Sstatename' => 1, 'Sstatecode' => 2, 'Dcreateddate' => 3, 'Dmodifydate' => 4, 'CountryId' => 5, 'Sstatus' => 6, ],
        self::TYPE_CAMELNAME     => ['istateid' => 0, 'sstatename' => 1, 'sstatecode' => 2, 'dcreateddate' => 3, 'dmodifydate' => 4, 'countryId' => 5, 'sstatus' => 6, ],
        self::TYPE_COLNAME       => [GeoStateTableMap::COL_ISTATEID => 0, GeoStateTableMap::COL_SSTATENAME => 1, GeoStateTableMap::COL_SSTATECODE => 2, GeoStateTableMap::COL_DCREATEDDATE => 3, GeoStateTableMap::COL_DMODIFYDATE => 4, GeoStateTableMap::COL_COUNTRY_ID => 5, GeoStateTableMap::COL_SSTATUS => 6, ],
        self::TYPE_FIELDNAME     => ['istateid' => 0, 'sstatename' => 1, 'sstatecode' => 2, 'dcreateddate' => 3, 'dmodifydate' => 4, 'country_id' => 5, 'sstatus' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Istateid' => 'ISTATEID',
        'GeoState.Istateid' => 'ISTATEID',
        'istateid' => 'ISTATEID',
        'geoState.istateid' => 'ISTATEID',
        'GeoStateTableMap::COL_ISTATEID' => 'ISTATEID',
        'COL_ISTATEID' => 'ISTATEID',
        'geo_state.istateid' => 'ISTATEID',
        'Sstatename' => 'SSTATENAME',
        'GeoState.Sstatename' => 'SSTATENAME',
        'sstatename' => 'SSTATENAME',
        'geoState.sstatename' => 'SSTATENAME',
        'GeoStateTableMap::COL_SSTATENAME' => 'SSTATENAME',
        'COL_SSTATENAME' => 'SSTATENAME',
        'geo_state.sstatename' => 'SSTATENAME',
        'Sstatecode' => 'SSTATECODE',
        'GeoState.Sstatecode' => 'SSTATECODE',
        'sstatecode' => 'SSTATECODE',
        'geoState.sstatecode' => 'SSTATECODE',
        'GeoStateTableMap::COL_SSTATECODE' => 'SSTATECODE',
        'COL_SSTATECODE' => 'SSTATECODE',
        'geo_state.sstatecode' => 'SSTATECODE',
        'Dcreateddate' => 'DCREATEDDATE',
        'GeoState.Dcreateddate' => 'DCREATEDDATE',
        'dcreateddate' => 'DCREATEDDATE',
        'geoState.dcreateddate' => 'DCREATEDDATE',
        'GeoStateTableMap::COL_DCREATEDDATE' => 'DCREATEDDATE',
        'COL_DCREATEDDATE' => 'DCREATEDDATE',
        'geo_state.dcreateddate' => 'DCREATEDDATE',
        'Dmodifydate' => 'DMODIFYDATE',
        'GeoState.Dmodifydate' => 'DMODIFYDATE',
        'dmodifydate' => 'DMODIFYDATE',
        'geoState.dmodifydate' => 'DMODIFYDATE',
        'GeoStateTableMap::COL_DMODIFYDATE' => 'DMODIFYDATE',
        'COL_DMODIFYDATE' => 'DMODIFYDATE',
        'geo_state.dmodifydate' => 'DMODIFYDATE',
        'CountryId' => 'COUNTRY_ID',
        'GeoState.CountryId' => 'COUNTRY_ID',
        'countryId' => 'COUNTRY_ID',
        'geoState.countryId' => 'COUNTRY_ID',
        'GeoStateTableMap::COL_COUNTRY_ID' => 'COUNTRY_ID',
        'COL_COUNTRY_ID' => 'COUNTRY_ID',
        'country_id' => 'COUNTRY_ID',
        'geo_state.country_id' => 'COUNTRY_ID',
        'Sstatus' => 'SSTATUS',
        'GeoState.Sstatus' => 'SSTATUS',
        'sstatus' => 'SSTATUS',
        'geoState.sstatus' => 'SSTATUS',
        'GeoStateTableMap::COL_SSTATUS' => 'SSTATUS',
        'COL_SSTATUS' => 'SSTATUS',
        'geo_state.sstatus' => 'SSTATUS',
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
        $this->setName('geo_state');
        $this->setPhpName('GeoState');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\GeoState');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('geo_state_istateid_seq');
        // columns
        $this->addPrimaryKey('istateid', 'Istateid', 'INTEGER', true, null, null);
        $this->addColumn('sstatename', 'Sstatename', 'CHAR', true, 100, null);
        $this->addColumn('sstatecode', 'Sstatecode', 'CHAR', true, 250, null);
        $this->addColumn('dcreateddate', 'Dcreateddate', 'TIMESTAMP', false, null, null);
        $this->addColumn('dmodifydate', 'Dmodifydate', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('country_id', 'CountryId', 'INTEGER', 'geo_country', 'icountryid', false, null, null);
        $this->addColumn('sstatus', 'Sstatus', 'CHAR', true, 10, '1');
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('GeoCountry', '\\entities\\GeoCountry', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':country_id',
    1 => ':icountryid',
  ),
), null, null, null, false);
        $this->addRelation('Branch', '\\entities\\Branch', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':istateid',
    1 => ':istateid',
  ),
), null, null, 'Branches', false);
        $this->addRelation('GeoCity', '\\entities\\GeoCity', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':istateid',
    1 => ':istateid',
  ),
), null, null, 'GeoCities', false);
        $this->addRelation('GeoDistanceRelatedByFromStateId', '\\entities\\GeoDistance', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':from_state_id',
    1 => ':istateid',
  ),
), null, null, 'GeoDistancesRelatedByFromStateId', false);
        $this->addRelation('GeoDistanceRelatedByToStateId', '\\entities\\GeoDistance', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':to_state_id',
    1 => ':istateid',
  ),
), null, null, 'GeoDistancesRelatedByToStateId', false);
        $this->addRelation('Holidays', '\\entities\\Holidays', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':istateid',
    1 => ':istateid',
  ),
), null, null, 'Holidayss', false);
        $this->addRelation('OnBoardRequestAddress', '\\entities\\OnBoardRequestAddress', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':istateid',
    1 => ':istateid',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Istateid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Istateid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Istateid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Istateid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Istateid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Istateid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Istateid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? GeoStateTableMap::CLASS_DEFAULT : GeoStateTableMap::OM_CLASS;
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
     * @return array (GeoState object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = GeoStateTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = GeoStateTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + GeoStateTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = GeoStateTableMap::OM_CLASS;
            /** @var GeoState $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            GeoStateTableMap::addInstanceToPool($obj, $key);
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
            $key = GeoStateTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = GeoStateTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var GeoState $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                GeoStateTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(GeoStateTableMap::COL_ISTATEID);
            $criteria->addSelectColumn(GeoStateTableMap::COL_SSTATENAME);
            $criteria->addSelectColumn(GeoStateTableMap::COL_SSTATECODE);
            $criteria->addSelectColumn(GeoStateTableMap::COL_DCREATEDDATE);
            $criteria->addSelectColumn(GeoStateTableMap::COL_DMODIFYDATE);
            $criteria->addSelectColumn(GeoStateTableMap::COL_COUNTRY_ID);
            $criteria->addSelectColumn(GeoStateTableMap::COL_SSTATUS);
        } else {
            $criteria->addSelectColumn($alias . '.istateid');
            $criteria->addSelectColumn($alias . '.sstatename');
            $criteria->addSelectColumn($alias . '.sstatecode');
            $criteria->addSelectColumn($alias . '.dcreateddate');
            $criteria->addSelectColumn($alias . '.dmodifydate');
            $criteria->addSelectColumn($alias . '.country_id');
            $criteria->addSelectColumn($alias . '.sstatus');
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
            $criteria->removeSelectColumn(GeoStateTableMap::COL_ISTATEID);
            $criteria->removeSelectColumn(GeoStateTableMap::COL_SSTATENAME);
            $criteria->removeSelectColumn(GeoStateTableMap::COL_SSTATECODE);
            $criteria->removeSelectColumn(GeoStateTableMap::COL_DCREATEDDATE);
            $criteria->removeSelectColumn(GeoStateTableMap::COL_DMODIFYDATE);
            $criteria->removeSelectColumn(GeoStateTableMap::COL_COUNTRY_ID);
            $criteria->removeSelectColumn(GeoStateTableMap::COL_SSTATUS);
        } else {
            $criteria->removeSelectColumn($alias . '.istateid');
            $criteria->removeSelectColumn($alias . '.sstatename');
            $criteria->removeSelectColumn($alias . '.sstatecode');
            $criteria->removeSelectColumn($alias . '.dcreateddate');
            $criteria->removeSelectColumn($alias . '.dmodifydate');
            $criteria->removeSelectColumn($alias . '.country_id');
            $criteria->removeSelectColumn($alias . '.sstatus');
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
        return Propel::getServiceContainer()->getDatabaseMap(GeoStateTableMap::DATABASE_NAME)->getTable(GeoStateTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a GeoState or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or GeoState object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(GeoStateTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\GeoState) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(GeoStateTableMap::DATABASE_NAME);
            $criteria->add(GeoStateTableMap::COL_ISTATEID, (array) $values, Criteria::IN);
        }

        $query = GeoStateQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            GeoStateTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                GeoStateTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the geo_state table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return GeoStateQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a GeoState or Criteria object.
     *
     * @param mixed $criteria Criteria or GeoState object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GeoStateTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from GeoState object
        }

        if ($criteria->containsKey(GeoStateTableMap::COL_ISTATEID) && $criteria->keyContainsValue(GeoStateTableMap::COL_ISTATEID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.GeoStateTableMap::COL_ISTATEID.')');
        }


        // Set the correct dbName
        $query = GeoStateQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
