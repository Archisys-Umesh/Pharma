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
use entities\TownCorrection;
use entities\TownCorrectionQuery;


/**
 * This class defines the structure of the 'town_correction' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class TownCorrectionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.TownCorrectionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'town_correction';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'TownCorrection';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\TownCorrection';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.TownCorrection';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'town_correction.id';

    /**
     * the column name for the state_id field
     */
    public const COL_STATE_ID = 'town_correction.state_id';

    /**
     * the column name for the state_name field
     */
    public const COL_STATE_NAME = 'town_correction.state_name';

    /**
     * the column name for the city_id field
     */
    public const COL_CITY_ID = 'town_correction.city_id';

    /**
     * the column name for the city_name field
     */
    public const COL_CITY_NAME = 'town_correction.city_name';

    /**
     * the column name for the town_id field
     */
    public const COL_TOWN_ID = 'town_correction.town_id';

    /**
     * the column name for the town_name field
     */
    public const COL_TOWN_NAME = 'town_correction.town_name';

    /**
     * the column name for the unique_town_code field
     */
    public const COL_UNIQUE_TOWN_CODE = 'town_correction.unique_town_code';

    /**
     * the column name for the to_be_removed field
     */
    public const COL_TO_BE_REMOVED = 'town_correction.to_be_removed';

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
        self::TYPE_PHPNAME       => ['Id', 'StateId', 'StateName', 'CityId', 'CityName', 'TownId', 'TownName', 'UniqueTownCode', 'ToBeRemoved', ],
        self::TYPE_CAMELNAME     => ['id', 'stateId', 'stateName', 'cityId', 'cityName', 'townId', 'townName', 'uniqueTownCode', 'toBeRemoved', ],
        self::TYPE_COLNAME       => [TownCorrectionTableMap::COL_ID, TownCorrectionTableMap::COL_STATE_ID, TownCorrectionTableMap::COL_STATE_NAME, TownCorrectionTableMap::COL_CITY_ID, TownCorrectionTableMap::COL_CITY_NAME, TownCorrectionTableMap::COL_TOWN_ID, TownCorrectionTableMap::COL_TOWN_NAME, TownCorrectionTableMap::COL_UNIQUE_TOWN_CODE, TownCorrectionTableMap::COL_TO_BE_REMOVED, ],
        self::TYPE_FIELDNAME     => ['id', 'state_id', 'state_name', 'city_id', 'city_name', 'town_id', 'town_name', 'unique_town_code', 'to_be_removed', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'StateId' => 1, 'StateName' => 2, 'CityId' => 3, 'CityName' => 4, 'TownId' => 5, 'TownName' => 6, 'UniqueTownCode' => 7, 'ToBeRemoved' => 8, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'stateId' => 1, 'stateName' => 2, 'cityId' => 3, 'cityName' => 4, 'townId' => 5, 'townName' => 6, 'uniqueTownCode' => 7, 'toBeRemoved' => 8, ],
        self::TYPE_COLNAME       => [TownCorrectionTableMap::COL_ID => 0, TownCorrectionTableMap::COL_STATE_ID => 1, TownCorrectionTableMap::COL_STATE_NAME => 2, TownCorrectionTableMap::COL_CITY_ID => 3, TownCorrectionTableMap::COL_CITY_NAME => 4, TownCorrectionTableMap::COL_TOWN_ID => 5, TownCorrectionTableMap::COL_TOWN_NAME => 6, TownCorrectionTableMap::COL_UNIQUE_TOWN_CODE => 7, TownCorrectionTableMap::COL_TO_BE_REMOVED => 8, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'state_id' => 1, 'state_name' => 2, 'city_id' => 3, 'city_name' => 4, 'town_id' => 5, 'town_name' => 6, 'unique_town_code' => 7, 'to_be_removed' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'TownCorrection.Id' => 'ID',
        'id' => 'ID',
        'townCorrection.id' => 'ID',
        'TownCorrectionTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'town_correction.id' => 'ID',
        'StateId' => 'STATE_ID',
        'TownCorrection.StateId' => 'STATE_ID',
        'stateId' => 'STATE_ID',
        'townCorrection.stateId' => 'STATE_ID',
        'TownCorrectionTableMap::COL_STATE_ID' => 'STATE_ID',
        'COL_STATE_ID' => 'STATE_ID',
        'state_id' => 'STATE_ID',
        'town_correction.state_id' => 'STATE_ID',
        'StateName' => 'STATE_NAME',
        'TownCorrection.StateName' => 'STATE_NAME',
        'stateName' => 'STATE_NAME',
        'townCorrection.stateName' => 'STATE_NAME',
        'TownCorrectionTableMap::COL_STATE_NAME' => 'STATE_NAME',
        'COL_STATE_NAME' => 'STATE_NAME',
        'state_name' => 'STATE_NAME',
        'town_correction.state_name' => 'STATE_NAME',
        'CityId' => 'CITY_ID',
        'TownCorrection.CityId' => 'CITY_ID',
        'cityId' => 'CITY_ID',
        'townCorrection.cityId' => 'CITY_ID',
        'TownCorrectionTableMap::COL_CITY_ID' => 'CITY_ID',
        'COL_CITY_ID' => 'CITY_ID',
        'city_id' => 'CITY_ID',
        'town_correction.city_id' => 'CITY_ID',
        'CityName' => 'CITY_NAME',
        'TownCorrection.CityName' => 'CITY_NAME',
        'cityName' => 'CITY_NAME',
        'townCorrection.cityName' => 'CITY_NAME',
        'TownCorrectionTableMap::COL_CITY_NAME' => 'CITY_NAME',
        'COL_CITY_NAME' => 'CITY_NAME',
        'city_name' => 'CITY_NAME',
        'town_correction.city_name' => 'CITY_NAME',
        'TownId' => 'TOWN_ID',
        'TownCorrection.TownId' => 'TOWN_ID',
        'townId' => 'TOWN_ID',
        'townCorrection.townId' => 'TOWN_ID',
        'TownCorrectionTableMap::COL_TOWN_ID' => 'TOWN_ID',
        'COL_TOWN_ID' => 'TOWN_ID',
        'town_id' => 'TOWN_ID',
        'town_correction.town_id' => 'TOWN_ID',
        'TownName' => 'TOWN_NAME',
        'TownCorrection.TownName' => 'TOWN_NAME',
        'townName' => 'TOWN_NAME',
        'townCorrection.townName' => 'TOWN_NAME',
        'TownCorrectionTableMap::COL_TOWN_NAME' => 'TOWN_NAME',
        'COL_TOWN_NAME' => 'TOWN_NAME',
        'town_name' => 'TOWN_NAME',
        'town_correction.town_name' => 'TOWN_NAME',
        'UniqueTownCode' => 'UNIQUE_TOWN_CODE',
        'TownCorrection.UniqueTownCode' => 'UNIQUE_TOWN_CODE',
        'uniqueTownCode' => 'UNIQUE_TOWN_CODE',
        'townCorrection.uniqueTownCode' => 'UNIQUE_TOWN_CODE',
        'TownCorrectionTableMap::COL_UNIQUE_TOWN_CODE' => 'UNIQUE_TOWN_CODE',
        'COL_UNIQUE_TOWN_CODE' => 'UNIQUE_TOWN_CODE',
        'unique_town_code' => 'UNIQUE_TOWN_CODE',
        'town_correction.unique_town_code' => 'UNIQUE_TOWN_CODE',
        'ToBeRemoved' => 'TO_BE_REMOVED',
        'TownCorrection.ToBeRemoved' => 'TO_BE_REMOVED',
        'toBeRemoved' => 'TO_BE_REMOVED',
        'townCorrection.toBeRemoved' => 'TO_BE_REMOVED',
        'TownCorrectionTableMap::COL_TO_BE_REMOVED' => 'TO_BE_REMOVED',
        'COL_TO_BE_REMOVED' => 'TO_BE_REMOVED',
        'to_be_removed' => 'TO_BE_REMOVED',
        'town_correction.to_be_removed' => 'TO_BE_REMOVED',
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
        $this->setName('town_correction');
        $this->setPhpName('TownCorrection');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\TownCorrection');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('town_correction_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('state_id', 'StateId', 'INTEGER', false, null, null);
        $this->addColumn('state_name', 'StateName', 'VARCHAR', false, null, null);
        $this->addColumn('city_id', 'CityId', 'INTEGER', false, null, null);
        $this->addColumn('city_name', 'CityName', 'VARCHAR', false, null, null);
        $this->addColumn('town_id', 'TownId', 'INTEGER', false, null, null);
        $this->addColumn('town_name', 'TownName', 'VARCHAR', false, null, null);
        $this->addColumn('unique_town_code', 'UniqueTownCode', 'INTEGER', false, null, null);
        $this->addColumn('to_be_removed', 'ToBeRemoved', 'BOOLEAN', true, 1, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? TownCorrectionTableMap::CLASS_DEFAULT : TownCorrectionTableMap::OM_CLASS;
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
     * @return array (TownCorrection object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = TownCorrectionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = TownCorrectionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + TownCorrectionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TownCorrectionTableMap::OM_CLASS;
            /** @var TownCorrection $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            TownCorrectionTableMap::addInstanceToPool($obj, $key);
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
            $key = TownCorrectionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = TownCorrectionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var TownCorrection $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TownCorrectionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(TownCorrectionTableMap::COL_ID);
            $criteria->addSelectColumn(TownCorrectionTableMap::COL_STATE_ID);
            $criteria->addSelectColumn(TownCorrectionTableMap::COL_STATE_NAME);
            $criteria->addSelectColumn(TownCorrectionTableMap::COL_CITY_ID);
            $criteria->addSelectColumn(TownCorrectionTableMap::COL_CITY_NAME);
            $criteria->addSelectColumn(TownCorrectionTableMap::COL_TOWN_ID);
            $criteria->addSelectColumn(TownCorrectionTableMap::COL_TOWN_NAME);
            $criteria->addSelectColumn(TownCorrectionTableMap::COL_UNIQUE_TOWN_CODE);
            $criteria->addSelectColumn(TownCorrectionTableMap::COL_TO_BE_REMOVED);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.state_id');
            $criteria->addSelectColumn($alias . '.state_name');
            $criteria->addSelectColumn($alias . '.city_id');
            $criteria->addSelectColumn($alias . '.city_name');
            $criteria->addSelectColumn($alias . '.town_id');
            $criteria->addSelectColumn($alias . '.town_name');
            $criteria->addSelectColumn($alias . '.unique_town_code');
            $criteria->addSelectColumn($alias . '.to_be_removed');
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
            $criteria->removeSelectColumn(TownCorrectionTableMap::COL_ID);
            $criteria->removeSelectColumn(TownCorrectionTableMap::COL_STATE_ID);
            $criteria->removeSelectColumn(TownCorrectionTableMap::COL_STATE_NAME);
            $criteria->removeSelectColumn(TownCorrectionTableMap::COL_CITY_ID);
            $criteria->removeSelectColumn(TownCorrectionTableMap::COL_CITY_NAME);
            $criteria->removeSelectColumn(TownCorrectionTableMap::COL_TOWN_ID);
            $criteria->removeSelectColumn(TownCorrectionTableMap::COL_TOWN_NAME);
            $criteria->removeSelectColumn(TownCorrectionTableMap::COL_UNIQUE_TOWN_CODE);
            $criteria->removeSelectColumn(TownCorrectionTableMap::COL_TO_BE_REMOVED);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.state_id');
            $criteria->removeSelectColumn($alias . '.state_name');
            $criteria->removeSelectColumn($alias . '.city_id');
            $criteria->removeSelectColumn($alias . '.city_name');
            $criteria->removeSelectColumn($alias . '.town_id');
            $criteria->removeSelectColumn($alias . '.town_name');
            $criteria->removeSelectColumn($alias . '.unique_town_code');
            $criteria->removeSelectColumn($alias . '.to_be_removed');
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
        return Propel::getServiceContainer()->getDatabaseMap(TownCorrectionTableMap::DATABASE_NAME)->getTable(TownCorrectionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a TownCorrection or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or TownCorrection object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(TownCorrectionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\TownCorrection) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(TownCorrectionTableMap::DATABASE_NAME);
            $criteria->add(TownCorrectionTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = TownCorrectionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            TownCorrectionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                TownCorrectionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the town_correction table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return TownCorrectionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a TownCorrection or Criteria object.
     *
     * @param mixed $criteria Criteria or TownCorrection object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TownCorrectionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from TownCorrection object
        }

        if ($criteria->containsKey(TownCorrectionTableMap::COL_ID) && $criteria->keyContainsValue(TownCorrectionTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.TownCorrectionTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = TownCorrectionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
