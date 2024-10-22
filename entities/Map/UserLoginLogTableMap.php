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
use entities\UserLoginLog;
use entities\UserLoginLogQuery;


/**
 * This class defines the structure of the 'user_login_log' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class UserLoginLogTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.UserLoginLogTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'user_login_log';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'UserLoginLog';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\UserLoginLog';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.UserLoginLog';

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
    public const COL_LOG_ID = 'user_login_log.log_id';

    /**
     * the column name for the timestamp field
     */
    public const COL_TIMESTAMP = 'user_login_log.timestamp';

    /**
     * the column name for the user_name field
     */
    public const COL_USER_NAME = 'user_login_log.user_name';

    /**
     * the column name for the ip field
     */
    public const COL_IP = 'user_login_log.ip';

    /**
     * the column name for the browser field
     */
    public const COL_BROWSER = 'user_login_log.browser';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'user_login_log.status';

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
        self::TYPE_PHPNAME       => ['LogId', 'Timestamp', 'UserName', 'Ip', 'Browser', 'Status', ],
        self::TYPE_CAMELNAME     => ['logId', 'timestamp', 'userName', 'ip', 'browser', 'status', ],
        self::TYPE_COLNAME       => [UserLoginLogTableMap::COL_LOG_ID, UserLoginLogTableMap::COL_TIMESTAMP, UserLoginLogTableMap::COL_USER_NAME, UserLoginLogTableMap::COL_IP, UserLoginLogTableMap::COL_BROWSER, UserLoginLogTableMap::COL_STATUS, ],
        self::TYPE_FIELDNAME     => ['log_id', 'timestamp', 'user_name', 'ip', 'browser', 'status', ],
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
        self::TYPE_PHPNAME       => ['LogId' => 0, 'Timestamp' => 1, 'UserName' => 2, 'Ip' => 3, 'Browser' => 4, 'Status' => 5, ],
        self::TYPE_CAMELNAME     => ['logId' => 0, 'timestamp' => 1, 'userName' => 2, 'ip' => 3, 'browser' => 4, 'status' => 5, ],
        self::TYPE_COLNAME       => [UserLoginLogTableMap::COL_LOG_ID => 0, UserLoginLogTableMap::COL_TIMESTAMP => 1, UserLoginLogTableMap::COL_USER_NAME => 2, UserLoginLogTableMap::COL_IP => 3, UserLoginLogTableMap::COL_BROWSER => 4, UserLoginLogTableMap::COL_STATUS => 5, ],
        self::TYPE_FIELDNAME     => ['log_id' => 0, 'timestamp' => 1, 'user_name' => 2, 'ip' => 3, 'browser' => 4, 'status' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'LogId' => 'LOG_ID',
        'UserLoginLog.LogId' => 'LOG_ID',
        'logId' => 'LOG_ID',
        'userLoginLog.logId' => 'LOG_ID',
        'UserLoginLogTableMap::COL_LOG_ID' => 'LOG_ID',
        'COL_LOG_ID' => 'LOG_ID',
        'log_id' => 'LOG_ID',
        'user_login_log.log_id' => 'LOG_ID',
        'Timestamp' => 'TIMESTAMP',
        'UserLoginLog.Timestamp' => 'TIMESTAMP',
        'timestamp' => 'TIMESTAMP',
        'userLoginLog.timestamp' => 'TIMESTAMP',
        'UserLoginLogTableMap::COL_TIMESTAMP' => 'TIMESTAMP',
        'COL_TIMESTAMP' => 'TIMESTAMP',
        'user_login_log.timestamp' => 'TIMESTAMP',
        'UserName' => 'USER_NAME',
        'UserLoginLog.UserName' => 'USER_NAME',
        'userName' => 'USER_NAME',
        'userLoginLog.userName' => 'USER_NAME',
        'UserLoginLogTableMap::COL_USER_NAME' => 'USER_NAME',
        'COL_USER_NAME' => 'USER_NAME',
        'user_name' => 'USER_NAME',
        'user_login_log.user_name' => 'USER_NAME',
        'Ip' => 'IP',
        'UserLoginLog.Ip' => 'IP',
        'ip' => 'IP',
        'userLoginLog.ip' => 'IP',
        'UserLoginLogTableMap::COL_IP' => 'IP',
        'COL_IP' => 'IP',
        'user_login_log.ip' => 'IP',
        'Browser' => 'BROWSER',
        'UserLoginLog.Browser' => 'BROWSER',
        'browser' => 'BROWSER',
        'userLoginLog.browser' => 'BROWSER',
        'UserLoginLogTableMap::COL_BROWSER' => 'BROWSER',
        'COL_BROWSER' => 'BROWSER',
        'user_login_log.browser' => 'BROWSER',
        'Status' => 'STATUS',
        'UserLoginLog.Status' => 'STATUS',
        'status' => 'STATUS',
        'userLoginLog.status' => 'STATUS',
        'UserLoginLogTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'user_login_log.status' => 'STATUS',
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
        $this->setName('user_login_log');
        $this->setPhpName('UserLoginLog');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\UserLoginLog');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('user_login_log_log_id_seq');
        // columns
        $this->addPrimaryKey('log_id', 'LogId', 'INTEGER', true, null, null);
        $this->addColumn('timestamp', 'Timestamp', 'BIGINT', true, null, null);
        $this->addColumn('user_name', 'UserName', 'VARCHAR', true, 50, null);
        $this->addColumn('ip', 'Ip', 'VARCHAR', true, 100, null);
        $this->addColumn('browser', 'Browser', 'VARCHAR', true, 500, null);
        $this->addColumn('status', 'Status', 'VARCHAR', true, 100, null);
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
        return $withPrefix ? UserLoginLogTableMap::CLASS_DEFAULT : UserLoginLogTableMap::OM_CLASS;
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
     * @return array (UserLoginLog object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = UserLoginLogTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UserLoginLogTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UserLoginLogTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UserLoginLogTableMap::OM_CLASS;
            /** @var UserLoginLog $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UserLoginLogTableMap::addInstanceToPool($obj, $key);
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
            $key = UserLoginLogTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UserLoginLogTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var UserLoginLog $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UserLoginLogTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(UserLoginLogTableMap::COL_LOG_ID);
            $criteria->addSelectColumn(UserLoginLogTableMap::COL_TIMESTAMP);
            $criteria->addSelectColumn(UserLoginLogTableMap::COL_USER_NAME);
            $criteria->addSelectColumn(UserLoginLogTableMap::COL_IP);
            $criteria->addSelectColumn(UserLoginLogTableMap::COL_BROWSER);
            $criteria->addSelectColumn(UserLoginLogTableMap::COL_STATUS);
        } else {
            $criteria->addSelectColumn($alias . '.log_id');
            $criteria->addSelectColumn($alias . '.timestamp');
            $criteria->addSelectColumn($alias . '.user_name');
            $criteria->addSelectColumn($alias . '.ip');
            $criteria->addSelectColumn($alias . '.browser');
            $criteria->addSelectColumn($alias . '.status');
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
            $criteria->removeSelectColumn(UserLoginLogTableMap::COL_LOG_ID);
            $criteria->removeSelectColumn(UserLoginLogTableMap::COL_TIMESTAMP);
            $criteria->removeSelectColumn(UserLoginLogTableMap::COL_USER_NAME);
            $criteria->removeSelectColumn(UserLoginLogTableMap::COL_IP);
            $criteria->removeSelectColumn(UserLoginLogTableMap::COL_BROWSER);
            $criteria->removeSelectColumn(UserLoginLogTableMap::COL_STATUS);
        } else {
            $criteria->removeSelectColumn($alias . '.log_id');
            $criteria->removeSelectColumn($alias . '.timestamp');
            $criteria->removeSelectColumn($alias . '.user_name');
            $criteria->removeSelectColumn($alias . '.ip');
            $criteria->removeSelectColumn($alias . '.browser');
            $criteria->removeSelectColumn($alias . '.status');
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
        return Propel::getServiceContainer()->getDatabaseMap(UserLoginLogTableMap::DATABASE_NAME)->getTable(UserLoginLogTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a UserLoginLog or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or UserLoginLog object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(UserLoginLogTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\UserLoginLog) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UserLoginLogTableMap::DATABASE_NAME);
            $criteria->add(UserLoginLogTableMap::COL_LOG_ID, (array) $values, Criteria::IN);
        }

        $query = UserLoginLogQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UserLoginLogTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UserLoginLogTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the user_login_log table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return UserLoginLogQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a UserLoginLog or Criteria object.
     *
     * @param mixed $criteria Criteria or UserLoginLog object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserLoginLogTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from UserLoginLog object
        }

        if ($criteria->containsKey(UserLoginLogTableMap::COL_LOG_ID) && $criteria->keyContainsValue(UserLoginLogTableMap::COL_LOG_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UserLoginLogTableMap::COL_LOG_ID.')');
        }


        // Set the correct dbName
        $query = UserLoginLogQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
