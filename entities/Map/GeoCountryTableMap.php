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
use entities\GeoCountry;
use entities\GeoCountryQuery;


/**
 * This class defines the structure of the 'geo_country' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class GeoCountryTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.GeoCountryTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'geo_country';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'GeoCountry';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\GeoCountry';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.GeoCountry';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the icountryid field
     */
    public const COL_ICOUNTRYID = 'geo_country.icountryid';

    /**
     * the column name for the scountry field
     */
    public const COL_SCOUNTRY = 'geo_country.scountry';

    /**
     * the column name for the scurrency field
     */
    public const COL_SCURRENCY = 'geo_country.scurrency';

    /**
     * the column name for the drate field
     */
    public const COL_DRATE = 'geo_country.drate';

    /**
     * the column name for the code field
     */
    public const COL_CODE = 'geo_country.code';

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
        self::TYPE_PHPNAME       => ['Icountryid', 'Scountry', 'Scurrency', 'Drate', 'Code', ],
        self::TYPE_CAMELNAME     => ['icountryid', 'scountry', 'scurrency', 'drate', 'code', ],
        self::TYPE_COLNAME       => [GeoCountryTableMap::COL_ICOUNTRYID, GeoCountryTableMap::COL_SCOUNTRY, GeoCountryTableMap::COL_SCURRENCY, GeoCountryTableMap::COL_DRATE, GeoCountryTableMap::COL_CODE, ],
        self::TYPE_FIELDNAME     => ['icountryid', 'scountry', 'scurrency', 'drate', 'code', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
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
        self::TYPE_PHPNAME       => ['Icountryid' => 0, 'Scountry' => 1, 'Scurrency' => 2, 'Drate' => 3, 'Code' => 4, ],
        self::TYPE_CAMELNAME     => ['icountryid' => 0, 'scountry' => 1, 'scurrency' => 2, 'drate' => 3, 'code' => 4, ],
        self::TYPE_COLNAME       => [GeoCountryTableMap::COL_ICOUNTRYID => 0, GeoCountryTableMap::COL_SCOUNTRY => 1, GeoCountryTableMap::COL_SCURRENCY => 2, GeoCountryTableMap::COL_DRATE => 3, GeoCountryTableMap::COL_CODE => 4, ],
        self::TYPE_FIELDNAME     => ['icountryid' => 0, 'scountry' => 1, 'scurrency' => 2, 'drate' => 3, 'code' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Icountryid' => 'ICOUNTRYID',
        'GeoCountry.Icountryid' => 'ICOUNTRYID',
        'icountryid' => 'ICOUNTRYID',
        'geoCountry.icountryid' => 'ICOUNTRYID',
        'GeoCountryTableMap::COL_ICOUNTRYID' => 'ICOUNTRYID',
        'COL_ICOUNTRYID' => 'ICOUNTRYID',
        'geo_country.icountryid' => 'ICOUNTRYID',
        'Scountry' => 'SCOUNTRY',
        'GeoCountry.Scountry' => 'SCOUNTRY',
        'scountry' => 'SCOUNTRY',
        'geoCountry.scountry' => 'SCOUNTRY',
        'GeoCountryTableMap::COL_SCOUNTRY' => 'SCOUNTRY',
        'COL_SCOUNTRY' => 'SCOUNTRY',
        'geo_country.scountry' => 'SCOUNTRY',
        'Scurrency' => 'SCURRENCY',
        'GeoCountry.Scurrency' => 'SCURRENCY',
        'scurrency' => 'SCURRENCY',
        'geoCountry.scurrency' => 'SCURRENCY',
        'GeoCountryTableMap::COL_SCURRENCY' => 'SCURRENCY',
        'COL_SCURRENCY' => 'SCURRENCY',
        'geo_country.scurrency' => 'SCURRENCY',
        'Drate' => 'DRATE',
        'GeoCountry.Drate' => 'DRATE',
        'drate' => 'DRATE',
        'geoCountry.drate' => 'DRATE',
        'GeoCountryTableMap::COL_DRATE' => 'DRATE',
        'COL_DRATE' => 'DRATE',
        'geo_country.drate' => 'DRATE',
        'Code' => 'CODE',
        'GeoCountry.Code' => 'CODE',
        'code' => 'CODE',
        'geoCountry.code' => 'CODE',
        'GeoCountryTableMap::COL_CODE' => 'CODE',
        'COL_CODE' => 'CODE',
        'geo_country.code' => 'CODE',
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
        $this->setName('geo_country');
        $this->setPhpName('GeoCountry');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\GeoCountry');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('geo_country_icountryid_seq');
        // columns
        $this->addPrimaryKey('icountryid', 'Icountryid', 'INTEGER', true, null, null);
        $this->addColumn('scountry', 'Scountry', 'VARCHAR', true, 100, null);
        $this->addForeignKey('scurrency', 'Scurrency', 'INTEGER', 'currencies', 'currency_id', false, null, null);
        $this->addColumn('drate', 'Drate', 'DECIMAL', false, 10, 0.00);
        $this->addColumn('code', 'Code', 'VARCHAR', false, 50, '0.00');
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Currencies', '\\entities\\Currencies', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':scurrency',
    1 => ':currency_id',
  ),
), null, null, null, false);
        $this->addRelation('GeoCity', '\\entities\\GeoCity', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':icountryid',
    1 => ':icountryid',
  ),
), null, null, 'GeoCities', false);
        $this->addRelation('GeoState', '\\entities\\GeoState', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':country_id',
    1 => ':icountryid',
  ),
), null, null, 'GeoStates', false);
        $this->addRelation('OrgUnit', '\\entities\\OrgUnit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':country_id',
    1 => ':icountryid',
  ),
), 'CASCADE', null, 'OrgUnits', false);
    }

    /**
     * Method to invalidate the instance pool of all tables related to geo_country     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        OrgUnitTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Icountryid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Icountryid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Icountryid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Icountryid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Icountryid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Icountryid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Icountryid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? GeoCountryTableMap::CLASS_DEFAULT : GeoCountryTableMap::OM_CLASS;
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
     * @return array (GeoCountry object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = GeoCountryTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = GeoCountryTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + GeoCountryTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = GeoCountryTableMap::OM_CLASS;
            /** @var GeoCountry $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            GeoCountryTableMap::addInstanceToPool($obj, $key);
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
            $key = GeoCountryTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = GeoCountryTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var GeoCountry $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                GeoCountryTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(GeoCountryTableMap::COL_ICOUNTRYID);
            $criteria->addSelectColumn(GeoCountryTableMap::COL_SCOUNTRY);
            $criteria->addSelectColumn(GeoCountryTableMap::COL_SCURRENCY);
            $criteria->addSelectColumn(GeoCountryTableMap::COL_DRATE);
            $criteria->addSelectColumn(GeoCountryTableMap::COL_CODE);
        } else {
            $criteria->addSelectColumn($alias . '.icountryid');
            $criteria->addSelectColumn($alias . '.scountry');
            $criteria->addSelectColumn($alias . '.scurrency');
            $criteria->addSelectColumn($alias . '.drate');
            $criteria->addSelectColumn($alias . '.code');
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
            $criteria->removeSelectColumn(GeoCountryTableMap::COL_ICOUNTRYID);
            $criteria->removeSelectColumn(GeoCountryTableMap::COL_SCOUNTRY);
            $criteria->removeSelectColumn(GeoCountryTableMap::COL_SCURRENCY);
            $criteria->removeSelectColumn(GeoCountryTableMap::COL_DRATE);
            $criteria->removeSelectColumn(GeoCountryTableMap::COL_CODE);
        } else {
            $criteria->removeSelectColumn($alias . '.icountryid');
            $criteria->removeSelectColumn($alias . '.scountry');
            $criteria->removeSelectColumn($alias . '.scurrency');
            $criteria->removeSelectColumn($alias . '.drate');
            $criteria->removeSelectColumn($alias . '.code');
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
        return Propel::getServiceContainer()->getDatabaseMap(GeoCountryTableMap::DATABASE_NAME)->getTable(GeoCountryTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a GeoCountry or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or GeoCountry object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(GeoCountryTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\GeoCountry) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(GeoCountryTableMap::DATABASE_NAME);
            $criteria->add(GeoCountryTableMap::COL_ICOUNTRYID, (array) $values, Criteria::IN);
        }

        $query = GeoCountryQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            GeoCountryTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                GeoCountryTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the geo_country table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return GeoCountryQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a GeoCountry or Criteria object.
     *
     * @param mixed $criteria Criteria or GeoCountry object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GeoCountryTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from GeoCountry object
        }

        if ($criteria->containsKey(GeoCountryTableMap::COL_ICOUNTRYID) && $criteria->keyContainsValue(GeoCountryTableMap::COL_ICOUNTRYID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.GeoCountryTableMap::COL_ICOUNTRYID.')');
        }


        // Set the correct dbName
        $query = GeoCountryQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
