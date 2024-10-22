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
use entities\StpWeek;
use entities\StpWeekQuery;


/**
 * This class defines the structure of the 'stp_week' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class StpWeekTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.StpWeekTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'stp_week';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'StpWeek';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\StpWeek';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.StpWeek';

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
     * the column name for the stp_week_id field
     */
    public const COL_STP_WEEK_ID = 'stp_week.stp_week_id';

    /**
     * the column name for the stp_id field
     */
    public const COL_STP_ID = 'stp_week.stp_id';

    /**
     * the column name for the week field
     */
    public const COL_WEEK = 'stp_week.week';

    /**
     * the column name for the day field
     */
    public const COL_DAY = 'stp_week.day';

    /**
     * the column name for the beat_id field
     */
    public const COL_BEAT_ID = 'stp_week.beat_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'stp_week.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'stp_week.updated_at';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'stp_week.company_id';

    /**
     * the column name for the territory_id field
     */
    public const COL_TERRITORY_ID = 'stp_week.territory_id';

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
        self::TYPE_PHPNAME       => ['StpWeekId', 'StpId', 'Week', 'Day', 'BeatId', 'CreatedAt', 'UpdatedAt', 'CompanyId', 'TerritoryId', ],
        self::TYPE_CAMELNAME     => ['stpWeekId', 'stpId', 'week', 'day', 'beatId', 'createdAt', 'updatedAt', 'companyId', 'territoryId', ],
        self::TYPE_COLNAME       => [StpWeekTableMap::COL_STP_WEEK_ID, StpWeekTableMap::COL_STP_ID, StpWeekTableMap::COL_WEEK, StpWeekTableMap::COL_DAY, StpWeekTableMap::COL_BEAT_ID, StpWeekTableMap::COL_CREATED_AT, StpWeekTableMap::COL_UPDATED_AT, StpWeekTableMap::COL_COMPANY_ID, StpWeekTableMap::COL_TERRITORY_ID, ],
        self::TYPE_FIELDNAME     => ['stp_week_id', 'stp_id', 'week', 'day', 'beat_id', 'created_at', 'updated_at', 'company_id', 'territory_id', ],
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
        self::TYPE_PHPNAME       => ['StpWeekId' => 0, 'StpId' => 1, 'Week' => 2, 'Day' => 3, 'BeatId' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, 'CompanyId' => 7, 'TerritoryId' => 8, ],
        self::TYPE_CAMELNAME     => ['stpWeekId' => 0, 'stpId' => 1, 'week' => 2, 'day' => 3, 'beatId' => 4, 'createdAt' => 5, 'updatedAt' => 6, 'companyId' => 7, 'territoryId' => 8, ],
        self::TYPE_COLNAME       => [StpWeekTableMap::COL_STP_WEEK_ID => 0, StpWeekTableMap::COL_STP_ID => 1, StpWeekTableMap::COL_WEEK => 2, StpWeekTableMap::COL_DAY => 3, StpWeekTableMap::COL_BEAT_ID => 4, StpWeekTableMap::COL_CREATED_AT => 5, StpWeekTableMap::COL_UPDATED_AT => 6, StpWeekTableMap::COL_COMPANY_ID => 7, StpWeekTableMap::COL_TERRITORY_ID => 8, ],
        self::TYPE_FIELDNAME     => ['stp_week_id' => 0, 'stp_id' => 1, 'week' => 2, 'day' => 3, 'beat_id' => 4, 'created_at' => 5, 'updated_at' => 6, 'company_id' => 7, 'territory_id' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'StpWeekId' => 'STP_WEEK_ID',
        'StpWeek.StpWeekId' => 'STP_WEEK_ID',
        'stpWeekId' => 'STP_WEEK_ID',
        'stpWeek.stpWeekId' => 'STP_WEEK_ID',
        'StpWeekTableMap::COL_STP_WEEK_ID' => 'STP_WEEK_ID',
        'COL_STP_WEEK_ID' => 'STP_WEEK_ID',
        'stp_week_id' => 'STP_WEEK_ID',
        'stp_week.stp_week_id' => 'STP_WEEK_ID',
        'StpId' => 'STP_ID',
        'StpWeek.StpId' => 'STP_ID',
        'stpId' => 'STP_ID',
        'stpWeek.stpId' => 'STP_ID',
        'StpWeekTableMap::COL_STP_ID' => 'STP_ID',
        'COL_STP_ID' => 'STP_ID',
        'stp_id' => 'STP_ID',
        'stp_week.stp_id' => 'STP_ID',
        'Week' => 'WEEK',
        'StpWeek.Week' => 'WEEK',
        'week' => 'WEEK',
        'stpWeek.week' => 'WEEK',
        'StpWeekTableMap::COL_WEEK' => 'WEEK',
        'COL_WEEK' => 'WEEK',
        'stp_week.week' => 'WEEK',
        'Day' => 'DAY',
        'StpWeek.Day' => 'DAY',
        'day' => 'DAY',
        'stpWeek.day' => 'DAY',
        'StpWeekTableMap::COL_DAY' => 'DAY',
        'COL_DAY' => 'DAY',
        'stp_week.day' => 'DAY',
        'BeatId' => 'BEAT_ID',
        'StpWeek.BeatId' => 'BEAT_ID',
        'beatId' => 'BEAT_ID',
        'stpWeek.beatId' => 'BEAT_ID',
        'StpWeekTableMap::COL_BEAT_ID' => 'BEAT_ID',
        'COL_BEAT_ID' => 'BEAT_ID',
        'beat_id' => 'BEAT_ID',
        'stp_week.beat_id' => 'BEAT_ID',
        'CreatedAt' => 'CREATED_AT',
        'StpWeek.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'stpWeek.createdAt' => 'CREATED_AT',
        'StpWeekTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'stp_week.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'StpWeek.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'stpWeek.updatedAt' => 'UPDATED_AT',
        'StpWeekTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'stp_week.updated_at' => 'UPDATED_AT',
        'CompanyId' => 'COMPANY_ID',
        'StpWeek.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'stpWeek.companyId' => 'COMPANY_ID',
        'StpWeekTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'stp_week.company_id' => 'COMPANY_ID',
        'TerritoryId' => 'TERRITORY_ID',
        'StpWeek.TerritoryId' => 'TERRITORY_ID',
        'territoryId' => 'TERRITORY_ID',
        'stpWeek.territoryId' => 'TERRITORY_ID',
        'StpWeekTableMap::COL_TERRITORY_ID' => 'TERRITORY_ID',
        'COL_TERRITORY_ID' => 'TERRITORY_ID',
        'territory_id' => 'TERRITORY_ID',
        'stp_week.territory_id' => 'TERRITORY_ID',
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
        $this->setName('stp_week');
        $this->setPhpName('StpWeek');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\StpWeek');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('stp_week_stp_week_id_seq');
        // columns
        $this->addPrimaryKey('stp_week_id', 'StpWeekId', 'INTEGER', true, null, null);
        $this->addForeignKey('stp_id', 'StpId', 'INTEGER', 'stp', 'stp_id', true, null, null);
        $this->addColumn('week', 'Week', 'VARCHAR', false, null, null);
        $this->addColumn('day', 'Day', 'VARCHAR', false, null, null);
        $this->addForeignKey('beat_id', 'BeatId', 'INTEGER', 'beats', 'beat_id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addForeignKey('territory_id', 'TerritoryId', 'INTEGER', 'territories', 'territory_id', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Beats', '\\entities\\Beats', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':beat_id',
    1 => ':beat_id',
  ),
), null, null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, null, false);
        $this->addRelation('Territories', '\\entities\\Territories', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':territory_id',
    1 => ':territory_id',
  ),
), null, null, null, false);
        $this->addRelation('Stp', '\\entities\\Stp', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':stp_id',
    1 => ':stp_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('StpWeekId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('StpWeekId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('StpWeekId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('StpWeekId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('StpWeekId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('StpWeekId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('StpWeekId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? StpWeekTableMap::CLASS_DEFAULT : StpWeekTableMap::OM_CLASS;
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
     * @return array (StpWeek object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = StpWeekTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = StpWeekTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + StpWeekTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = StpWeekTableMap::OM_CLASS;
            /** @var StpWeek $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            StpWeekTableMap::addInstanceToPool($obj, $key);
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
            $key = StpWeekTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = StpWeekTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var StpWeek $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                StpWeekTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(StpWeekTableMap::COL_STP_WEEK_ID);
            $criteria->addSelectColumn(StpWeekTableMap::COL_STP_ID);
            $criteria->addSelectColumn(StpWeekTableMap::COL_WEEK);
            $criteria->addSelectColumn(StpWeekTableMap::COL_DAY);
            $criteria->addSelectColumn(StpWeekTableMap::COL_BEAT_ID);
            $criteria->addSelectColumn(StpWeekTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(StpWeekTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(StpWeekTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(StpWeekTableMap::COL_TERRITORY_ID);
        } else {
            $criteria->addSelectColumn($alias . '.stp_week_id');
            $criteria->addSelectColumn($alias . '.stp_id');
            $criteria->addSelectColumn($alias . '.week');
            $criteria->addSelectColumn($alias . '.day');
            $criteria->addSelectColumn($alias . '.beat_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.territory_id');
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
            $criteria->removeSelectColumn(StpWeekTableMap::COL_STP_WEEK_ID);
            $criteria->removeSelectColumn(StpWeekTableMap::COL_STP_ID);
            $criteria->removeSelectColumn(StpWeekTableMap::COL_WEEK);
            $criteria->removeSelectColumn(StpWeekTableMap::COL_DAY);
            $criteria->removeSelectColumn(StpWeekTableMap::COL_BEAT_ID);
            $criteria->removeSelectColumn(StpWeekTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(StpWeekTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(StpWeekTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(StpWeekTableMap::COL_TERRITORY_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.stp_week_id');
            $criteria->removeSelectColumn($alias . '.stp_id');
            $criteria->removeSelectColumn($alias . '.week');
            $criteria->removeSelectColumn($alias . '.day');
            $criteria->removeSelectColumn($alias . '.beat_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.territory_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(StpWeekTableMap::DATABASE_NAME)->getTable(StpWeekTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a StpWeek or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or StpWeek object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(StpWeekTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\StpWeek) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(StpWeekTableMap::DATABASE_NAME);
            $criteria->add(StpWeekTableMap::COL_STP_WEEK_ID, (array) $values, Criteria::IN);
        }

        $query = StpWeekQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            StpWeekTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                StpWeekTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the stp_week table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return StpWeekQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a StpWeek or Criteria object.
     *
     * @param mixed $criteria Criteria or StpWeek object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StpWeekTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from StpWeek object
        }

        if ($criteria->containsKey(StpWeekTableMap::COL_STP_WEEK_ID) && $criteria->keyContainsValue(StpWeekTableMap::COL_STP_WEEK_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.StpWeekTableMap::COL_STP_WEEK_ID.')');
        }


        // Set the correct dbName
        $query = StpWeekQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
