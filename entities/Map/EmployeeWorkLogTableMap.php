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
use entities\EmployeeWorkLog;
use entities\EmployeeWorkLogQuery;


/**
 * This class defines the structure of the 'employee_work_log' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class EmployeeWorkLogTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.EmployeeWorkLogTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'employee_work_log';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'EmployeeWorkLog';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\EmployeeWorkLog';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.EmployeeWorkLog';

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
     * the column name for the work_log_id field
     */
    public const COL_WORK_LOG_ID = 'employee_work_log.work_log_id';

    /**
     * the column name for the exp_id field
     */
    public const COL_EXP_ID = 'employee_work_log.exp_id';

    /**
     * the column name for the description field
     */
    public const COL_DESCRIPTION = 'employee_work_log.description';

    /**
     * the column name for the start_time field
     */
    public const COL_START_TIME = 'employee_work_log.start_time';

    /**
     * the column name for the minutes field
     */
    public const COL_MINUTES = 'employee_work_log.minutes';

    /**
     * the column name for the location field
     */
    public const COL_LOCATION = 'employee_work_log.location';

    /**
     * the column name for the pin field
     */
    public const COL_PIN = 'employee_work_log.pin';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'employee_work_log.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'employee_work_log.updated_at';

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
        self::TYPE_PHPNAME       => ['WorkLogId', 'ExpId', 'Description', 'StartTime', 'Minutes', 'Location', 'Pin', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['workLogId', 'expId', 'description', 'startTime', 'minutes', 'location', 'pin', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [EmployeeWorkLogTableMap::COL_WORK_LOG_ID, EmployeeWorkLogTableMap::COL_EXP_ID, EmployeeWorkLogTableMap::COL_DESCRIPTION, EmployeeWorkLogTableMap::COL_START_TIME, EmployeeWorkLogTableMap::COL_MINUTES, EmployeeWorkLogTableMap::COL_LOCATION, EmployeeWorkLogTableMap::COL_PIN, EmployeeWorkLogTableMap::COL_CREATED_AT, EmployeeWorkLogTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['work_log_id', 'exp_id', 'description', 'start_time', 'minutes', 'location', 'pin', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['WorkLogId' => 0, 'ExpId' => 1, 'Description' => 2, 'StartTime' => 3, 'Minutes' => 4, 'Location' => 5, 'Pin' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['workLogId' => 0, 'expId' => 1, 'description' => 2, 'startTime' => 3, 'minutes' => 4, 'location' => 5, 'pin' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [EmployeeWorkLogTableMap::COL_WORK_LOG_ID => 0, EmployeeWorkLogTableMap::COL_EXP_ID => 1, EmployeeWorkLogTableMap::COL_DESCRIPTION => 2, EmployeeWorkLogTableMap::COL_START_TIME => 3, EmployeeWorkLogTableMap::COL_MINUTES => 4, EmployeeWorkLogTableMap::COL_LOCATION => 5, EmployeeWorkLogTableMap::COL_PIN => 6, EmployeeWorkLogTableMap::COL_CREATED_AT => 7, EmployeeWorkLogTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['work_log_id' => 0, 'exp_id' => 1, 'description' => 2, 'start_time' => 3, 'minutes' => 4, 'location' => 5, 'pin' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'WorkLogId' => 'WORK_LOG_ID',
        'EmployeeWorkLog.WorkLogId' => 'WORK_LOG_ID',
        'workLogId' => 'WORK_LOG_ID',
        'employeeWorkLog.workLogId' => 'WORK_LOG_ID',
        'EmployeeWorkLogTableMap::COL_WORK_LOG_ID' => 'WORK_LOG_ID',
        'COL_WORK_LOG_ID' => 'WORK_LOG_ID',
        'work_log_id' => 'WORK_LOG_ID',
        'employee_work_log.work_log_id' => 'WORK_LOG_ID',
        'ExpId' => 'EXP_ID',
        'EmployeeWorkLog.ExpId' => 'EXP_ID',
        'expId' => 'EXP_ID',
        'employeeWorkLog.expId' => 'EXP_ID',
        'EmployeeWorkLogTableMap::COL_EXP_ID' => 'EXP_ID',
        'COL_EXP_ID' => 'EXP_ID',
        'exp_id' => 'EXP_ID',
        'employee_work_log.exp_id' => 'EXP_ID',
        'Description' => 'DESCRIPTION',
        'EmployeeWorkLog.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'employeeWorkLog.description' => 'DESCRIPTION',
        'EmployeeWorkLogTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'employee_work_log.description' => 'DESCRIPTION',
        'StartTime' => 'START_TIME',
        'EmployeeWorkLog.StartTime' => 'START_TIME',
        'startTime' => 'START_TIME',
        'employeeWorkLog.startTime' => 'START_TIME',
        'EmployeeWorkLogTableMap::COL_START_TIME' => 'START_TIME',
        'COL_START_TIME' => 'START_TIME',
        'start_time' => 'START_TIME',
        'employee_work_log.start_time' => 'START_TIME',
        'Minutes' => 'MINUTES',
        'EmployeeWorkLog.Minutes' => 'MINUTES',
        'minutes' => 'MINUTES',
        'employeeWorkLog.minutes' => 'MINUTES',
        'EmployeeWorkLogTableMap::COL_MINUTES' => 'MINUTES',
        'COL_MINUTES' => 'MINUTES',
        'employee_work_log.minutes' => 'MINUTES',
        'Location' => 'LOCATION',
        'EmployeeWorkLog.Location' => 'LOCATION',
        'location' => 'LOCATION',
        'employeeWorkLog.location' => 'LOCATION',
        'EmployeeWorkLogTableMap::COL_LOCATION' => 'LOCATION',
        'COL_LOCATION' => 'LOCATION',
        'employee_work_log.location' => 'LOCATION',
        'Pin' => 'PIN',
        'EmployeeWorkLog.Pin' => 'PIN',
        'pin' => 'PIN',
        'employeeWorkLog.pin' => 'PIN',
        'EmployeeWorkLogTableMap::COL_PIN' => 'PIN',
        'COL_PIN' => 'PIN',
        'employee_work_log.pin' => 'PIN',
        'CreatedAt' => 'CREATED_AT',
        'EmployeeWorkLog.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'employeeWorkLog.createdAt' => 'CREATED_AT',
        'EmployeeWorkLogTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'employee_work_log.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'EmployeeWorkLog.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'employeeWorkLog.updatedAt' => 'UPDATED_AT',
        'EmployeeWorkLogTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'employee_work_log.updated_at' => 'UPDATED_AT',
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
        $this->setName('employee_work_log');
        $this->setPhpName('EmployeeWorkLog');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\EmployeeWorkLog');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('employee_work_log_work_log_id_seq');
        // columns
        $this->addPrimaryKey('work_log_id', 'WorkLogId', 'INTEGER', true, null, null);
        $this->addForeignKey('exp_id', 'ExpId', 'INTEGER', 'expenses', 'exp_id', true, null, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', true, null, null);
        $this->addColumn('start_time', 'StartTime', 'TIME', false, null, null);
        $this->addColumn('minutes', 'Minutes', 'INTEGER', false, null, null);
        $this->addColumn('location', 'Location', 'VARCHAR', false, 255, null);
        $this->addColumn('pin', 'Pin', 'VARCHAR', true, 255, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Expenses', '\\entities\\Expenses', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':exp_id',
    1 => ':exp_id',
  ),
), 'CASCADE', null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WorkLogId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WorkLogId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WorkLogId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WorkLogId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WorkLogId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WorkLogId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('WorkLogId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? EmployeeWorkLogTableMap::CLASS_DEFAULT : EmployeeWorkLogTableMap::OM_CLASS;
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
     * @return array (EmployeeWorkLog object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = EmployeeWorkLogTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EmployeeWorkLogTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EmployeeWorkLogTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EmployeeWorkLogTableMap::OM_CLASS;
            /** @var EmployeeWorkLog $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EmployeeWorkLogTableMap::addInstanceToPool($obj, $key);
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
            $key = EmployeeWorkLogTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EmployeeWorkLogTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var EmployeeWorkLog $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EmployeeWorkLogTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EmployeeWorkLogTableMap::COL_WORK_LOG_ID);
            $criteria->addSelectColumn(EmployeeWorkLogTableMap::COL_EXP_ID);
            $criteria->addSelectColumn(EmployeeWorkLogTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(EmployeeWorkLogTableMap::COL_START_TIME);
            $criteria->addSelectColumn(EmployeeWorkLogTableMap::COL_MINUTES);
            $criteria->addSelectColumn(EmployeeWorkLogTableMap::COL_LOCATION);
            $criteria->addSelectColumn(EmployeeWorkLogTableMap::COL_PIN);
            $criteria->addSelectColumn(EmployeeWorkLogTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(EmployeeWorkLogTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.work_log_id');
            $criteria->addSelectColumn($alias . '.exp_id');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.start_time');
            $criteria->addSelectColumn($alias . '.minutes');
            $criteria->addSelectColumn($alias . '.location');
            $criteria->addSelectColumn($alias . '.pin');
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
            $criteria->removeSelectColumn(EmployeeWorkLogTableMap::COL_WORK_LOG_ID);
            $criteria->removeSelectColumn(EmployeeWorkLogTableMap::COL_EXP_ID);
            $criteria->removeSelectColumn(EmployeeWorkLogTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(EmployeeWorkLogTableMap::COL_START_TIME);
            $criteria->removeSelectColumn(EmployeeWorkLogTableMap::COL_MINUTES);
            $criteria->removeSelectColumn(EmployeeWorkLogTableMap::COL_LOCATION);
            $criteria->removeSelectColumn(EmployeeWorkLogTableMap::COL_PIN);
            $criteria->removeSelectColumn(EmployeeWorkLogTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(EmployeeWorkLogTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.work_log_id');
            $criteria->removeSelectColumn($alias . '.exp_id');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.start_time');
            $criteria->removeSelectColumn($alias . '.minutes');
            $criteria->removeSelectColumn($alias . '.location');
            $criteria->removeSelectColumn($alias . '.pin');
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
        return Propel::getServiceContainer()->getDatabaseMap(EmployeeWorkLogTableMap::DATABASE_NAME)->getTable(EmployeeWorkLogTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a EmployeeWorkLog or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or EmployeeWorkLog object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeWorkLogTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\EmployeeWorkLog) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EmployeeWorkLogTableMap::DATABASE_NAME);
            $criteria->add(EmployeeWorkLogTableMap::COL_WORK_LOG_ID, (array) $values, Criteria::IN);
        }

        $query = EmployeeWorkLogQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EmployeeWorkLogTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EmployeeWorkLogTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the employee_work_log table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return EmployeeWorkLogQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a EmployeeWorkLog or Criteria object.
     *
     * @param mixed $criteria Criteria or EmployeeWorkLog object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeWorkLogTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from EmployeeWorkLog object
        }

        if ($criteria->containsKey(EmployeeWorkLogTableMap::COL_WORK_LOG_ID) && $criteria->keyContainsValue(EmployeeWorkLogTableMap::COL_WORK_LOG_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EmployeeWorkLogTableMap::COL_WORK_LOG_ID.')');
        }


        // Set the correct dbName
        $query = EmployeeWorkLogQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
