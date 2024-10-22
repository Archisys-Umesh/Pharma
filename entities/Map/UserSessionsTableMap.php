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
use entities\UserSessions;
use entities\UserSessionsQuery;


/**
 * This class defines the structure of the 'user_sessions' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class UserSessionsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.UserSessionsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'user_sessions';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'UserSessions';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\UserSessions';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.UserSessions';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the session_id field
     */
    public const COL_SESSION_ID = 'user_sessions.session_id';

    /**
     * the column name for the user_id field
     */
    public const COL_USER_ID = 'user_sessions.user_id';

    /**
     * the column name for the session_token field
     */
    public const COL_SESSION_TOKEN = 'user_sessions.session_token';

    /**
     * the column name for the ip_address field
     */
    public const COL_IP_ADDRESS = 'user_sessions.ip_address';

    /**
     * the column name for the device field
     */
    public const COL_DEVICE = 'user_sessions.device';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'user_sessions.created_at';

    /**
     * the column name for the fcm_token field
     */
    public const COL_FCM_TOKEN = 'user_sessions.fcm_token';

    /**
     * the column name for the device_name field
     */
    public const COL_DEVICE_NAME = 'user_sessions.device_name';

    /**
     * the column name for the app_version field
     */
    public const COL_APP_VERSION = 'user_sessions.app_version';

    /**
     * the column name for the action field
     */
    public const COL_ACTION = 'user_sessions.action';

    /**
     * the column name for the activity_time field
     */
    public const COL_ACTIVITY_TIME = 'user_sessions.activity_time';

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
        self::TYPE_PHPNAME       => ['SessionId', 'UserId', 'SessionToken', 'IpAddress', 'Device', 'CreatedAt', 'FcmToken', 'DeviceName', 'AppVersion', 'Action', 'ActivityTime', ],
        self::TYPE_CAMELNAME     => ['sessionId', 'userId', 'sessionToken', 'ipAddress', 'device', 'createdAt', 'fcmToken', 'deviceName', 'appVersion', 'action', 'activityTime', ],
        self::TYPE_COLNAME       => [UserSessionsTableMap::COL_SESSION_ID, UserSessionsTableMap::COL_USER_ID, UserSessionsTableMap::COL_SESSION_TOKEN, UserSessionsTableMap::COL_IP_ADDRESS, UserSessionsTableMap::COL_DEVICE, UserSessionsTableMap::COL_CREATED_AT, UserSessionsTableMap::COL_FCM_TOKEN, UserSessionsTableMap::COL_DEVICE_NAME, UserSessionsTableMap::COL_APP_VERSION, UserSessionsTableMap::COL_ACTION, UserSessionsTableMap::COL_ACTIVITY_TIME, ],
        self::TYPE_FIELDNAME     => ['session_id', 'user_id', 'session_token', 'ip_address', 'device', 'created_at', 'fcm_token', 'device_name', 'app_version', 'action', 'activity_time', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
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
        self::TYPE_PHPNAME       => ['SessionId' => 0, 'UserId' => 1, 'SessionToken' => 2, 'IpAddress' => 3, 'Device' => 4, 'CreatedAt' => 5, 'FcmToken' => 6, 'DeviceName' => 7, 'AppVersion' => 8, 'Action' => 9, 'ActivityTime' => 10, ],
        self::TYPE_CAMELNAME     => ['sessionId' => 0, 'userId' => 1, 'sessionToken' => 2, 'ipAddress' => 3, 'device' => 4, 'createdAt' => 5, 'fcmToken' => 6, 'deviceName' => 7, 'appVersion' => 8, 'action' => 9, 'activityTime' => 10, ],
        self::TYPE_COLNAME       => [UserSessionsTableMap::COL_SESSION_ID => 0, UserSessionsTableMap::COL_USER_ID => 1, UserSessionsTableMap::COL_SESSION_TOKEN => 2, UserSessionsTableMap::COL_IP_ADDRESS => 3, UserSessionsTableMap::COL_DEVICE => 4, UserSessionsTableMap::COL_CREATED_AT => 5, UserSessionsTableMap::COL_FCM_TOKEN => 6, UserSessionsTableMap::COL_DEVICE_NAME => 7, UserSessionsTableMap::COL_APP_VERSION => 8, UserSessionsTableMap::COL_ACTION => 9, UserSessionsTableMap::COL_ACTIVITY_TIME => 10, ],
        self::TYPE_FIELDNAME     => ['session_id' => 0, 'user_id' => 1, 'session_token' => 2, 'ip_address' => 3, 'device' => 4, 'created_at' => 5, 'fcm_token' => 6, 'device_name' => 7, 'app_version' => 8, 'action' => 9, 'activity_time' => 10, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'SessionId' => 'SESSION_ID',
        'UserSessions.SessionId' => 'SESSION_ID',
        'sessionId' => 'SESSION_ID',
        'userSessions.sessionId' => 'SESSION_ID',
        'UserSessionsTableMap::COL_SESSION_ID' => 'SESSION_ID',
        'COL_SESSION_ID' => 'SESSION_ID',
        'session_id' => 'SESSION_ID',
        'user_sessions.session_id' => 'SESSION_ID',
        'UserId' => 'USER_ID',
        'UserSessions.UserId' => 'USER_ID',
        'userId' => 'USER_ID',
        'userSessions.userId' => 'USER_ID',
        'UserSessionsTableMap::COL_USER_ID' => 'USER_ID',
        'COL_USER_ID' => 'USER_ID',
        'user_id' => 'USER_ID',
        'user_sessions.user_id' => 'USER_ID',
        'SessionToken' => 'SESSION_TOKEN',
        'UserSessions.SessionToken' => 'SESSION_TOKEN',
        'sessionToken' => 'SESSION_TOKEN',
        'userSessions.sessionToken' => 'SESSION_TOKEN',
        'UserSessionsTableMap::COL_SESSION_TOKEN' => 'SESSION_TOKEN',
        'COL_SESSION_TOKEN' => 'SESSION_TOKEN',
        'session_token' => 'SESSION_TOKEN',
        'user_sessions.session_token' => 'SESSION_TOKEN',
        'IpAddress' => 'IP_ADDRESS',
        'UserSessions.IpAddress' => 'IP_ADDRESS',
        'ipAddress' => 'IP_ADDRESS',
        'userSessions.ipAddress' => 'IP_ADDRESS',
        'UserSessionsTableMap::COL_IP_ADDRESS' => 'IP_ADDRESS',
        'COL_IP_ADDRESS' => 'IP_ADDRESS',
        'ip_address' => 'IP_ADDRESS',
        'user_sessions.ip_address' => 'IP_ADDRESS',
        'Device' => 'DEVICE',
        'UserSessions.Device' => 'DEVICE',
        'device' => 'DEVICE',
        'userSessions.device' => 'DEVICE',
        'UserSessionsTableMap::COL_DEVICE' => 'DEVICE',
        'COL_DEVICE' => 'DEVICE',
        'user_sessions.device' => 'DEVICE',
        'CreatedAt' => 'CREATED_AT',
        'UserSessions.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'userSessions.createdAt' => 'CREATED_AT',
        'UserSessionsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'user_sessions.created_at' => 'CREATED_AT',
        'FcmToken' => 'FCM_TOKEN',
        'UserSessions.FcmToken' => 'FCM_TOKEN',
        'fcmToken' => 'FCM_TOKEN',
        'userSessions.fcmToken' => 'FCM_TOKEN',
        'UserSessionsTableMap::COL_FCM_TOKEN' => 'FCM_TOKEN',
        'COL_FCM_TOKEN' => 'FCM_TOKEN',
        'fcm_token' => 'FCM_TOKEN',
        'user_sessions.fcm_token' => 'FCM_TOKEN',
        'DeviceName' => 'DEVICE_NAME',
        'UserSessions.DeviceName' => 'DEVICE_NAME',
        'deviceName' => 'DEVICE_NAME',
        'userSessions.deviceName' => 'DEVICE_NAME',
        'UserSessionsTableMap::COL_DEVICE_NAME' => 'DEVICE_NAME',
        'COL_DEVICE_NAME' => 'DEVICE_NAME',
        'device_name' => 'DEVICE_NAME',
        'user_sessions.device_name' => 'DEVICE_NAME',
        'AppVersion' => 'APP_VERSION',
        'UserSessions.AppVersion' => 'APP_VERSION',
        'appVersion' => 'APP_VERSION',
        'userSessions.appVersion' => 'APP_VERSION',
        'UserSessionsTableMap::COL_APP_VERSION' => 'APP_VERSION',
        'COL_APP_VERSION' => 'APP_VERSION',
        'app_version' => 'APP_VERSION',
        'user_sessions.app_version' => 'APP_VERSION',
        'Action' => 'ACTION',
        'UserSessions.Action' => 'ACTION',
        'action' => 'ACTION',
        'userSessions.action' => 'ACTION',
        'UserSessionsTableMap::COL_ACTION' => 'ACTION',
        'COL_ACTION' => 'ACTION',
        'user_sessions.action' => 'ACTION',
        'ActivityTime' => 'ACTIVITY_TIME',
        'UserSessions.ActivityTime' => 'ACTIVITY_TIME',
        'activityTime' => 'ACTIVITY_TIME',
        'userSessions.activityTime' => 'ACTIVITY_TIME',
        'UserSessionsTableMap::COL_ACTIVITY_TIME' => 'ACTIVITY_TIME',
        'COL_ACTIVITY_TIME' => 'ACTIVITY_TIME',
        'activity_time' => 'ACTIVITY_TIME',
        'user_sessions.activity_time' => 'ACTIVITY_TIME',
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
        $this->setName('user_sessions');
        $this->setPhpName('UserSessions');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\UserSessions');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('user_sessions_session_id_seq');
        // columns
        $this->addPrimaryKey('session_id', 'SessionId', 'INTEGER', true, null, null);
        $this->addForeignKey('user_id', 'UserId', 'INTEGER', 'users', 'user_id', false, null, null);
        $this->addColumn('session_token', 'SessionToken', 'VARCHAR', false, null, null);
        $this->addColumn('ip_address', 'IpAddress', 'VARCHAR', false, null, null);
        $this->addColumn('device', 'Device', 'VARCHAR', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('fcm_token', 'FcmToken', 'VARCHAR', false, null, null);
        $this->addColumn('device_name', 'DeviceName', 'VARCHAR', false, null, null);
        $this->addColumn('app_version', 'AppVersion', 'VARCHAR', false, null, null);
        $this->addColumn('action', 'Action', 'VARCHAR', false, null, null);
        $this->addColumn('activity_time', 'ActivityTime', 'TIMESTAMP', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SessionId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SessionId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SessionId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SessionId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SessionId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SessionId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('SessionId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? UserSessionsTableMap::CLASS_DEFAULT : UserSessionsTableMap::OM_CLASS;
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
     * @return array (UserSessions object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = UserSessionsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UserSessionsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UserSessionsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UserSessionsTableMap::OM_CLASS;
            /** @var UserSessions $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UserSessionsTableMap::addInstanceToPool($obj, $key);
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
            $key = UserSessionsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UserSessionsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var UserSessions $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UserSessionsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(UserSessionsTableMap::COL_SESSION_ID);
            $criteria->addSelectColumn(UserSessionsTableMap::COL_USER_ID);
            $criteria->addSelectColumn(UserSessionsTableMap::COL_SESSION_TOKEN);
            $criteria->addSelectColumn(UserSessionsTableMap::COL_IP_ADDRESS);
            $criteria->addSelectColumn(UserSessionsTableMap::COL_DEVICE);
            $criteria->addSelectColumn(UserSessionsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(UserSessionsTableMap::COL_FCM_TOKEN);
            $criteria->addSelectColumn(UserSessionsTableMap::COL_DEVICE_NAME);
            $criteria->addSelectColumn(UserSessionsTableMap::COL_APP_VERSION);
            $criteria->addSelectColumn(UserSessionsTableMap::COL_ACTION);
            $criteria->addSelectColumn(UserSessionsTableMap::COL_ACTIVITY_TIME);
        } else {
            $criteria->addSelectColumn($alias . '.session_id');
            $criteria->addSelectColumn($alias . '.user_id');
            $criteria->addSelectColumn($alias . '.session_token');
            $criteria->addSelectColumn($alias . '.ip_address');
            $criteria->addSelectColumn($alias . '.device');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.fcm_token');
            $criteria->addSelectColumn($alias . '.device_name');
            $criteria->addSelectColumn($alias . '.app_version');
            $criteria->addSelectColumn($alias . '.action');
            $criteria->addSelectColumn($alias . '.activity_time');
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
            $criteria->removeSelectColumn(UserSessionsTableMap::COL_SESSION_ID);
            $criteria->removeSelectColumn(UserSessionsTableMap::COL_USER_ID);
            $criteria->removeSelectColumn(UserSessionsTableMap::COL_SESSION_TOKEN);
            $criteria->removeSelectColumn(UserSessionsTableMap::COL_IP_ADDRESS);
            $criteria->removeSelectColumn(UserSessionsTableMap::COL_DEVICE);
            $criteria->removeSelectColumn(UserSessionsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(UserSessionsTableMap::COL_FCM_TOKEN);
            $criteria->removeSelectColumn(UserSessionsTableMap::COL_DEVICE_NAME);
            $criteria->removeSelectColumn(UserSessionsTableMap::COL_APP_VERSION);
            $criteria->removeSelectColumn(UserSessionsTableMap::COL_ACTION);
            $criteria->removeSelectColumn(UserSessionsTableMap::COL_ACTIVITY_TIME);
        } else {
            $criteria->removeSelectColumn($alias . '.session_id');
            $criteria->removeSelectColumn($alias . '.user_id');
            $criteria->removeSelectColumn($alias . '.session_token');
            $criteria->removeSelectColumn($alias . '.ip_address');
            $criteria->removeSelectColumn($alias . '.device');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.fcm_token');
            $criteria->removeSelectColumn($alias . '.device_name');
            $criteria->removeSelectColumn($alias . '.app_version');
            $criteria->removeSelectColumn($alias . '.action');
            $criteria->removeSelectColumn($alias . '.activity_time');
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
        return Propel::getServiceContainer()->getDatabaseMap(UserSessionsTableMap::DATABASE_NAME)->getTable(UserSessionsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a UserSessions or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or UserSessions object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(UserSessionsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\UserSessions) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UserSessionsTableMap::DATABASE_NAME);
            $criteria->add(UserSessionsTableMap::COL_SESSION_ID, (array) $values, Criteria::IN);
        }

        $query = UserSessionsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UserSessionsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UserSessionsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the user_sessions table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return UserSessionsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a UserSessions or Criteria object.
     *
     * @param mixed $criteria Criteria or UserSessions object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserSessionsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from UserSessions object
        }

        if ($criteria->containsKey(UserSessionsTableMap::COL_SESSION_ID) && $criteria->keyContainsValue(UserSessionsTableMap::COL_SESSION_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UserSessionsTableMap::COL_SESSION_ID.')');
        }


        // Set the correct dbName
        $query = UserSessionsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
