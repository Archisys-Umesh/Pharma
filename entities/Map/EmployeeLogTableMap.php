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
use entities\EmployeeLog;
use entities\EmployeeLogQuery;


/**
 * This class defines the structure of the 'employee_log' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class EmployeeLogTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.EmployeeLogTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'employee_log';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'EmployeeLog';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\EmployeeLog';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.EmployeeLog';

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
     * the column name for the log_id field
     */
    public const COL_LOG_ID = 'employee_log.log_id';

    /**
     * the column name for the user_id field
     */
    public const COL_USER_ID = 'employee_log.user_id';

    /**
     * the column name for the pin field
     */
    public const COL_PIN = 'employee_log.pin';

    /**
     * the column name for the device_name field
     */
    public const COL_DEVICE_NAME = 'employee_log.device_name';

    /**
     * the column name for the device_battery field
     */
    public const COL_DEVICE_BATTERY = 'employee_log.device_battery';

    /**
     * the column name for the device_time field
     */
    public const COL_DEVICE_TIME = 'employee_log.device_time';

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
        self::TYPE_PHPNAME       => ['LogId', 'UserId', 'Pin', 'DeviceName', 'DeviceBattery', 'DeviceTime', ],
        self::TYPE_CAMELNAME     => ['logId', 'userId', 'pin', 'deviceName', 'deviceBattery', 'deviceTime', ],
        self::TYPE_COLNAME       => [EmployeeLogTableMap::COL_LOG_ID, EmployeeLogTableMap::COL_USER_ID, EmployeeLogTableMap::COL_PIN, EmployeeLogTableMap::COL_DEVICE_NAME, EmployeeLogTableMap::COL_DEVICE_BATTERY, EmployeeLogTableMap::COL_DEVICE_TIME, ],
        self::TYPE_FIELDNAME     => ['log_id', 'user_id', 'pin', 'device_name', 'device_battery', 'device_time', ],
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
        self::TYPE_PHPNAME       => ['LogId' => 0, 'UserId' => 1, 'Pin' => 2, 'DeviceName' => 3, 'DeviceBattery' => 4, 'DeviceTime' => 5, ],
        self::TYPE_CAMELNAME     => ['logId' => 0, 'userId' => 1, 'pin' => 2, 'deviceName' => 3, 'deviceBattery' => 4, 'deviceTime' => 5, ],
        self::TYPE_COLNAME       => [EmployeeLogTableMap::COL_LOG_ID => 0, EmployeeLogTableMap::COL_USER_ID => 1, EmployeeLogTableMap::COL_PIN => 2, EmployeeLogTableMap::COL_DEVICE_NAME => 3, EmployeeLogTableMap::COL_DEVICE_BATTERY => 4, EmployeeLogTableMap::COL_DEVICE_TIME => 5, ],
        self::TYPE_FIELDNAME     => ['log_id' => 0, 'user_id' => 1, 'pin' => 2, 'device_name' => 3, 'device_battery' => 4, 'device_time' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'LogId' => 'LOG_ID',
        'EmployeeLog.LogId' => 'LOG_ID',
        'logId' => 'LOG_ID',
        'employeeLog.logId' => 'LOG_ID',
        'EmployeeLogTableMap::COL_LOG_ID' => 'LOG_ID',
        'COL_LOG_ID' => 'LOG_ID',
        'log_id' => 'LOG_ID',
        'employee_log.log_id' => 'LOG_ID',
        'UserId' => 'USER_ID',
        'EmployeeLog.UserId' => 'USER_ID',
        'userId' => 'USER_ID',
        'employeeLog.userId' => 'USER_ID',
        'EmployeeLogTableMap::COL_USER_ID' => 'USER_ID',
        'COL_USER_ID' => 'USER_ID',
        'user_id' => 'USER_ID',
        'employee_log.user_id' => 'USER_ID',
        'Pin' => 'PIN',
        'EmployeeLog.Pin' => 'PIN',
        'pin' => 'PIN',
        'employeeLog.pin' => 'PIN',
        'EmployeeLogTableMap::COL_PIN' => 'PIN',
        'COL_PIN' => 'PIN',
        'employee_log.pin' => 'PIN',
        'DeviceName' => 'DEVICE_NAME',
        'EmployeeLog.DeviceName' => 'DEVICE_NAME',
        'deviceName' => 'DEVICE_NAME',
        'employeeLog.deviceName' => 'DEVICE_NAME',
        'EmployeeLogTableMap::COL_DEVICE_NAME' => 'DEVICE_NAME',
        'COL_DEVICE_NAME' => 'DEVICE_NAME',
        'device_name' => 'DEVICE_NAME',
        'employee_log.device_name' => 'DEVICE_NAME',
        'DeviceBattery' => 'DEVICE_BATTERY',
        'EmployeeLog.DeviceBattery' => 'DEVICE_BATTERY',
        'deviceBattery' => 'DEVICE_BATTERY',
        'employeeLog.deviceBattery' => 'DEVICE_BATTERY',
        'EmployeeLogTableMap::COL_DEVICE_BATTERY' => 'DEVICE_BATTERY',
        'COL_DEVICE_BATTERY' => 'DEVICE_BATTERY',
        'device_battery' => 'DEVICE_BATTERY',
        'employee_log.device_battery' => 'DEVICE_BATTERY',
        'DeviceTime' => 'DEVICE_TIME',
        'EmployeeLog.DeviceTime' => 'DEVICE_TIME',
        'deviceTime' => 'DEVICE_TIME',
        'employeeLog.deviceTime' => 'DEVICE_TIME',
        'EmployeeLogTableMap::COL_DEVICE_TIME' => 'DEVICE_TIME',
        'COL_DEVICE_TIME' => 'DEVICE_TIME',
        'device_time' => 'DEVICE_TIME',
        'employee_log.device_time' => 'DEVICE_TIME',
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
        $this->setName('employee_log');
        $this->setPhpName('EmployeeLog');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\EmployeeLog');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('employee_log_log_id_seq');
        // columns
        $this->addPrimaryKey('log_id', 'LogId', 'INTEGER', true, null, null);
        $this->addForeignKey('user_id', 'UserId', 'INTEGER', 'users', 'user_id', true, null, 0);
        $this->addColumn('pin', 'Pin', 'VARCHAR', true, 255, null);
        $this->addColumn('device_name', 'DeviceName', 'VARCHAR', true, 255, null);
        $this->addColumn('device_battery', 'DeviceBattery', 'VARCHAR', true, 255, null);
        $this->addColumn('device_time', 'DeviceTime', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Users', '\\entities\\Users', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':user_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LogId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LogId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LogId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LogId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LogId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('LogId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('LogId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? EmployeeLogTableMap::CLASS_DEFAULT : EmployeeLogTableMap::OM_CLASS;
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
     * @return array (EmployeeLog object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = EmployeeLogTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EmployeeLogTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EmployeeLogTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EmployeeLogTableMap::OM_CLASS;
            /** @var EmployeeLog $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EmployeeLogTableMap::addInstanceToPool($obj, $key);
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
            $key = EmployeeLogTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EmployeeLogTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var EmployeeLog $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EmployeeLogTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EmployeeLogTableMap::COL_LOG_ID);
            $criteria->addSelectColumn(EmployeeLogTableMap::COL_USER_ID);
            $criteria->addSelectColumn(EmployeeLogTableMap::COL_PIN);
            $criteria->addSelectColumn(EmployeeLogTableMap::COL_DEVICE_NAME);
            $criteria->addSelectColumn(EmployeeLogTableMap::COL_DEVICE_BATTERY);
            $criteria->addSelectColumn(EmployeeLogTableMap::COL_DEVICE_TIME);
        } else {
            $criteria->addSelectColumn($alias . '.log_id');
            $criteria->addSelectColumn($alias . '.user_id');
            $criteria->addSelectColumn($alias . '.pin');
            $criteria->addSelectColumn($alias . '.device_name');
            $criteria->addSelectColumn($alias . '.device_battery');
            $criteria->addSelectColumn($alias . '.device_time');
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
            $criteria->removeSelectColumn(EmployeeLogTableMap::COL_LOG_ID);
            $criteria->removeSelectColumn(EmployeeLogTableMap::COL_USER_ID);
            $criteria->removeSelectColumn(EmployeeLogTableMap::COL_PIN);
            $criteria->removeSelectColumn(EmployeeLogTableMap::COL_DEVICE_NAME);
            $criteria->removeSelectColumn(EmployeeLogTableMap::COL_DEVICE_BATTERY);
            $criteria->removeSelectColumn(EmployeeLogTableMap::COL_DEVICE_TIME);
        } else {
            $criteria->removeSelectColumn($alias . '.log_id');
            $criteria->removeSelectColumn($alias . '.user_id');
            $criteria->removeSelectColumn($alias . '.pin');
            $criteria->removeSelectColumn($alias . '.device_name');
            $criteria->removeSelectColumn($alias . '.device_battery');
            $criteria->removeSelectColumn($alias . '.device_time');
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
        return Propel::getServiceContainer()->getDatabaseMap(EmployeeLogTableMap::DATABASE_NAME)->getTable(EmployeeLogTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a EmployeeLog or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or EmployeeLog object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeLogTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\EmployeeLog) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EmployeeLogTableMap::DATABASE_NAME);
            $criteria->add(EmployeeLogTableMap::COL_LOG_ID, (array) $values, Criteria::IN);
        }

        $query = EmployeeLogQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EmployeeLogTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EmployeeLogTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the employee_log table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return EmployeeLogQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a EmployeeLog or Criteria object.
     *
     * @param mixed $criteria Criteria or EmployeeLog object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeLogTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from EmployeeLog object
        }

        if ($criteria->containsKey(EmployeeLogTableMap::COL_LOG_ID) && $criteria->keyContainsValue(EmployeeLogTableMap::COL_LOG_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EmployeeLogTableMap::COL_LOG_ID.')');
        }


        // Set the correct dbName
        $query = EmployeeLogQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
