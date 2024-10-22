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
use entities\WdbSyncLog;
use entities\WdbSyncLogQuery;


/**
 * This class defines the structure of the 'wdb_sync_log' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class WdbSyncLogTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.WdbSyncLogTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'wdb_sync_log';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'WdbSyncLog';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\WdbSyncLog';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.WdbSyncLog';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 14;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 14;

    /**
     * the column name for the wdb_id field
     */
    public const COL_WDB_ID = 'wdb_sync_log.wdb_id';

    /**
     * the column name for the sys_table field
     */
    public const COL_SYS_TABLE = 'wdb_sync_log.sys_table';

    /**
     * the column name for the sys_operation field
     */
    public const COL_SYS_OPERATION = 'wdb_sync_log.sys_operation';

    /**
     * the column name for the sys_body field
     */
    public const COL_SYS_BODY = 'wdb_sync_log.sys_body';

    /**
     * the column name for the user_id field
     */
    public const COL_USER_ID = 'wdb_sync_log.user_id';

    /**
     * the column name for the token_id field
     */
    public const COL_TOKEN_ID = 'wdb_sync_log.token_id';

    /**
     * the column name for the device_info field
     */
    public const COL_DEVICE_INFO = 'wdb_sync_log.device_info';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'wdb_sync_log.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'wdb_sync_log.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'wdb_sync_log.updated_at';

    /**
     * the column name for the wdb_key field
     */
    public const COL_WDB_KEY = 'wdb_sync_log.wdb_key';

    /**
     * the column name for the newpk field
     */
    public const COL_NEWPK = 'wdb_sync_log.newpk';

    /**
     * the column name for the res_message field
     */
    public const COL_RES_MESSAGE = 'wdb_sync_log.res_message';

    /**
     * the column name for the device_timestamp field
     */
    public const COL_DEVICE_TIMESTAMP = 'wdb_sync_log.device_timestamp';

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
        self::TYPE_PHPNAME       => ['WdbId', 'SysTable', 'SysOperation', 'SysBody', 'UserId', 'TokenId', 'DeviceInfo', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'WdbKey', 'Newpk', 'ResMessage', 'DeviceTimestamp', ],
        self::TYPE_CAMELNAME     => ['wdbId', 'sysTable', 'sysOperation', 'sysBody', 'userId', 'tokenId', 'deviceInfo', 'companyId', 'createdAt', 'updatedAt', 'wdbKey', 'newpk', 'resMessage', 'deviceTimestamp', ],
        self::TYPE_COLNAME       => [WdbSyncLogTableMap::COL_WDB_ID, WdbSyncLogTableMap::COL_SYS_TABLE, WdbSyncLogTableMap::COL_SYS_OPERATION, WdbSyncLogTableMap::COL_SYS_BODY, WdbSyncLogTableMap::COL_USER_ID, WdbSyncLogTableMap::COL_TOKEN_ID, WdbSyncLogTableMap::COL_DEVICE_INFO, WdbSyncLogTableMap::COL_COMPANY_ID, WdbSyncLogTableMap::COL_CREATED_AT, WdbSyncLogTableMap::COL_UPDATED_AT, WdbSyncLogTableMap::COL_WDB_KEY, WdbSyncLogTableMap::COL_NEWPK, WdbSyncLogTableMap::COL_RES_MESSAGE, WdbSyncLogTableMap::COL_DEVICE_TIMESTAMP, ],
        self::TYPE_FIELDNAME     => ['wdb_id', 'sys_table', 'sys_operation', 'sys_body', 'user_id', 'token_id', 'device_info', 'company_id', 'created_at', 'updated_at', 'wdb_key', 'newpk', 'res_message', 'device_timestamp', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
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
        self::TYPE_PHPNAME       => ['WdbId' => 0, 'SysTable' => 1, 'SysOperation' => 2, 'SysBody' => 3, 'UserId' => 4, 'TokenId' => 5, 'DeviceInfo' => 6, 'CompanyId' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, 'WdbKey' => 10, 'Newpk' => 11, 'ResMessage' => 12, 'DeviceTimestamp' => 13, ],
        self::TYPE_CAMELNAME     => ['wdbId' => 0, 'sysTable' => 1, 'sysOperation' => 2, 'sysBody' => 3, 'userId' => 4, 'tokenId' => 5, 'deviceInfo' => 6, 'companyId' => 7, 'createdAt' => 8, 'updatedAt' => 9, 'wdbKey' => 10, 'newpk' => 11, 'resMessage' => 12, 'deviceTimestamp' => 13, ],
        self::TYPE_COLNAME       => [WdbSyncLogTableMap::COL_WDB_ID => 0, WdbSyncLogTableMap::COL_SYS_TABLE => 1, WdbSyncLogTableMap::COL_SYS_OPERATION => 2, WdbSyncLogTableMap::COL_SYS_BODY => 3, WdbSyncLogTableMap::COL_USER_ID => 4, WdbSyncLogTableMap::COL_TOKEN_ID => 5, WdbSyncLogTableMap::COL_DEVICE_INFO => 6, WdbSyncLogTableMap::COL_COMPANY_ID => 7, WdbSyncLogTableMap::COL_CREATED_AT => 8, WdbSyncLogTableMap::COL_UPDATED_AT => 9, WdbSyncLogTableMap::COL_WDB_KEY => 10, WdbSyncLogTableMap::COL_NEWPK => 11, WdbSyncLogTableMap::COL_RES_MESSAGE => 12, WdbSyncLogTableMap::COL_DEVICE_TIMESTAMP => 13, ],
        self::TYPE_FIELDNAME     => ['wdb_id' => 0, 'sys_table' => 1, 'sys_operation' => 2, 'sys_body' => 3, 'user_id' => 4, 'token_id' => 5, 'device_info' => 6, 'company_id' => 7, 'created_at' => 8, 'updated_at' => 9, 'wdb_key' => 10, 'newpk' => 11, 'res_message' => 12, 'device_timestamp' => 13, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'WdbId' => 'WDB_ID',
        'WdbSyncLog.WdbId' => 'WDB_ID',
        'wdbId' => 'WDB_ID',
        'wdbSyncLog.wdbId' => 'WDB_ID',
        'WdbSyncLogTableMap::COL_WDB_ID' => 'WDB_ID',
        'COL_WDB_ID' => 'WDB_ID',
        'wdb_id' => 'WDB_ID',
        'wdb_sync_log.wdb_id' => 'WDB_ID',
        'SysTable' => 'SYS_TABLE',
        'WdbSyncLog.SysTable' => 'SYS_TABLE',
        'sysTable' => 'SYS_TABLE',
        'wdbSyncLog.sysTable' => 'SYS_TABLE',
        'WdbSyncLogTableMap::COL_SYS_TABLE' => 'SYS_TABLE',
        'COL_SYS_TABLE' => 'SYS_TABLE',
        'sys_table' => 'SYS_TABLE',
        'wdb_sync_log.sys_table' => 'SYS_TABLE',
        'SysOperation' => 'SYS_OPERATION',
        'WdbSyncLog.SysOperation' => 'SYS_OPERATION',
        'sysOperation' => 'SYS_OPERATION',
        'wdbSyncLog.sysOperation' => 'SYS_OPERATION',
        'WdbSyncLogTableMap::COL_SYS_OPERATION' => 'SYS_OPERATION',
        'COL_SYS_OPERATION' => 'SYS_OPERATION',
        'sys_operation' => 'SYS_OPERATION',
        'wdb_sync_log.sys_operation' => 'SYS_OPERATION',
        'SysBody' => 'SYS_BODY',
        'WdbSyncLog.SysBody' => 'SYS_BODY',
        'sysBody' => 'SYS_BODY',
        'wdbSyncLog.sysBody' => 'SYS_BODY',
        'WdbSyncLogTableMap::COL_SYS_BODY' => 'SYS_BODY',
        'COL_SYS_BODY' => 'SYS_BODY',
        'sys_body' => 'SYS_BODY',
        'wdb_sync_log.sys_body' => 'SYS_BODY',
        'UserId' => 'USER_ID',
        'WdbSyncLog.UserId' => 'USER_ID',
        'userId' => 'USER_ID',
        'wdbSyncLog.userId' => 'USER_ID',
        'WdbSyncLogTableMap::COL_USER_ID' => 'USER_ID',
        'COL_USER_ID' => 'USER_ID',
        'user_id' => 'USER_ID',
        'wdb_sync_log.user_id' => 'USER_ID',
        'TokenId' => 'TOKEN_ID',
        'WdbSyncLog.TokenId' => 'TOKEN_ID',
        'tokenId' => 'TOKEN_ID',
        'wdbSyncLog.tokenId' => 'TOKEN_ID',
        'WdbSyncLogTableMap::COL_TOKEN_ID' => 'TOKEN_ID',
        'COL_TOKEN_ID' => 'TOKEN_ID',
        'token_id' => 'TOKEN_ID',
        'wdb_sync_log.token_id' => 'TOKEN_ID',
        'DeviceInfo' => 'DEVICE_INFO',
        'WdbSyncLog.DeviceInfo' => 'DEVICE_INFO',
        'deviceInfo' => 'DEVICE_INFO',
        'wdbSyncLog.deviceInfo' => 'DEVICE_INFO',
        'WdbSyncLogTableMap::COL_DEVICE_INFO' => 'DEVICE_INFO',
        'COL_DEVICE_INFO' => 'DEVICE_INFO',
        'device_info' => 'DEVICE_INFO',
        'wdb_sync_log.device_info' => 'DEVICE_INFO',
        'CompanyId' => 'COMPANY_ID',
        'WdbSyncLog.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'wdbSyncLog.companyId' => 'COMPANY_ID',
        'WdbSyncLogTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'wdb_sync_log.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'WdbSyncLog.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'wdbSyncLog.createdAt' => 'CREATED_AT',
        'WdbSyncLogTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'wdb_sync_log.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'WdbSyncLog.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'wdbSyncLog.updatedAt' => 'UPDATED_AT',
        'WdbSyncLogTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'wdb_sync_log.updated_at' => 'UPDATED_AT',
        'WdbKey' => 'WDB_KEY',
        'WdbSyncLog.WdbKey' => 'WDB_KEY',
        'wdbKey' => 'WDB_KEY',
        'wdbSyncLog.wdbKey' => 'WDB_KEY',
        'WdbSyncLogTableMap::COL_WDB_KEY' => 'WDB_KEY',
        'COL_WDB_KEY' => 'WDB_KEY',
        'wdb_key' => 'WDB_KEY',
        'wdb_sync_log.wdb_key' => 'WDB_KEY',
        'Newpk' => 'NEWPK',
        'WdbSyncLog.Newpk' => 'NEWPK',
        'newpk' => 'NEWPK',
        'wdbSyncLog.newpk' => 'NEWPK',
        'WdbSyncLogTableMap::COL_NEWPK' => 'NEWPK',
        'COL_NEWPK' => 'NEWPK',
        'wdb_sync_log.newpk' => 'NEWPK',
        'ResMessage' => 'RES_MESSAGE',
        'WdbSyncLog.ResMessage' => 'RES_MESSAGE',
        'resMessage' => 'RES_MESSAGE',
        'wdbSyncLog.resMessage' => 'RES_MESSAGE',
        'WdbSyncLogTableMap::COL_RES_MESSAGE' => 'RES_MESSAGE',
        'COL_RES_MESSAGE' => 'RES_MESSAGE',
        'res_message' => 'RES_MESSAGE',
        'wdb_sync_log.res_message' => 'RES_MESSAGE',
        'DeviceTimestamp' => 'DEVICE_TIMESTAMP',
        'WdbSyncLog.DeviceTimestamp' => 'DEVICE_TIMESTAMP',
        'deviceTimestamp' => 'DEVICE_TIMESTAMP',
        'wdbSyncLog.deviceTimestamp' => 'DEVICE_TIMESTAMP',
        'WdbSyncLogTableMap::COL_DEVICE_TIMESTAMP' => 'DEVICE_TIMESTAMP',
        'COL_DEVICE_TIMESTAMP' => 'DEVICE_TIMESTAMP',
        'device_timestamp' => 'DEVICE_TIMESTAMP',
        'wdb_sync_log.device_timestamp' => 'DEVICE_TIMESTAMP',
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
        $this->setName('wdb_sync_log');
        $this->setPhpName('WdbSyncLog');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\WdbSyncLog');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('wdb_sync_log_wdb_id_seq');
        // columns
        $this->addPrimaryKey('wdb_id', 'WdbId', 'BIGINT', true, null, null);
        $this->addColumn('sys_table', 'SysTable', 'VARCHAR', false, null, null);
        $this->addColumn('sys_operation', 'SysOperation', 'VARCHAR', false, null, null);
        $this->addColumn('sys_body', 'SysBody', 'VARCHAR', false, null, null);
        $this->addForeignKey('user_id', 'UserId', 'INTEGER', 'users', 'user_id', false, null, null);
        $this->addColumn('token_id', 'TokenId', 'VARCHAR', false, null, null);
        $this->addColumn('device_info', 'DeviceInfo', 'VARCHAR', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, 0);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('wdb_key', 'WdbKey', 'VARCHAR', false, null, null);
        $this->addColumn('newpk', 'Newpk', 'INTEGER', false, null, null);
        $this->addColumn('res_message', 'ResMessage', 'VARCHAR', false, null, null);
        $this->addColumn('device_timestamp', 'DeviceTimestamp', 'INTEGER', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WdbId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WdbId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WdbId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WdbId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WdbId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WdbId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('WdbId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? WdbSyncLogTableMap::CLASS_DEFAULT : WdbSyncLogTableMap::OM_CLASS;
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
     * @return array (WdbSyncLog object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = WdbSyncLogTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = WdbSyncLogTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + WdbSyncLogTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = WdbSyncLogTableMap::OM_CLASS;
            /** @var WdbSyncLog $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            WdbSyncLogTableMap::addInstanceToPool($obj, $key);
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
            $key = WdbSyncLogTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = WdbSyncLogTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var WdbSyncLog $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                WdbSyncLogTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(WdbSyncLogTableMap::COL_WDB_ID);
            $criteria->addSelectColumn(WdbSyncLogTableMap::COL_SYS_TABLE);
            $criteria->addSelectColumn(WdbSyncLogTableMap::COL_SYS_OPERATION);
            $criteria->addSelectColumn(WdbSyncLogTableMap::COL_SYS_BODY);
            $criteria->addSelectColumn(WdbSyncLogTableMap::COL_USER_ID);
            $criteria->addSelectColumn(WdbSyncLogTableMap::COL_TOKEN_ID);
            $criteria->addSelectColumn(WdbSyncLogTableMap::COL_DEVICE_INFO);
            $criteria->addSelectColumn(WdbSyncLogTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(WdbSyncLogTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(WdbSyncLogTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(WdbSyncLogTableMap::COL_WDB_KEY);
            $criteria->addSelectColumn(WdbSyncLogTableMap::COL_NEWPK);
            $criteria->addSelectColumn(WdbSyncLogTableMap::COL_RES_MESSAGE);
            $criteria->addSelectColumn(WdbSyncLogTableMap::COL_DEVICE_TIMESTAMP);
        } else {
            $criteria->addSelectColumn($alias . '.wdb_id');
            $criteria->addSelectColumn($alias . '.sys_table');
            $criteria->addSelectColumn($alias . '.sys_operation');
            $criteria->addSelectColumn($alias . '.sys_body');
            $criteria->addSelectColumn($alias . '.user_id');
            $criteria->addSelectColumn($alias . '.token_id');
            $criteria->addSelectColumn($alias . '.device_info');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.wdb_key');
            $criteria->addSelectColumn($alias . '.newpk');
            $criteria->addSelectColumn($alias . '.res_message');
            $criteria->addSelectColumn($alias . '.device_timestamp');
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
            $criteria->removeSelectColumn(WdbSyncLogTableMap::COL_WDB_ID);
            $criteria->removeSelectColumn(WdbSyncLogTableMap::COL_SYS_TABLE);
            $criteria->removeSelectColumn(WdbSyncLogTableMap::COL_SYS_OPERATION);
            $criteria->removeSelectColumn(WdbSyncLogTableMap::COL_SYS_BODY);
            $criteria->removeSelectColumn(WdbSyncLogTableMap::COL_USER_ID);
            $criteria->removeSelectColumn(WdbSyncLogTableMap::COL_TOKEN_ID);
            $criteria->removeSelectColumn(WdbSyncLogTableMap::COL_DEVICE_INFO);
            $criteria->removeSelectColumn(WdbSyncLogTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(WdbSyncLogTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(WdbSyncLogTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(WdbSyncLogTableMap::COL_WDB_KEY);
            $criteria->removeSelectColumn(WdbSyncLogTableMap::COL_NEWPK);
            $criteria->removeSelectColumn(WdbSyncLogTableMap::COL_RES_MESSAGE);
            $criteria->removeSelectColumn(WdbSyncLogTableMap::COL_DEVICE_TIMESTAMP);
        } else {
            $criteria->removeSelectColumn($alias . '.wdb_id');
            $criteria->removeSelectColumn($alias . '.sys_table');
            $criteria->removeSelectColumn($alias . '.sys_operation');
            $criteria->removeSelectColumn($alias . '.sys_body');
            $criteria->removeSelectColumn($alias . '.user_id');
            $criteria->removeSelectColumn($alias . '.token_id');
            $criteria->removeSelectColumn($alias . '.device_info');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.wdb_key');
            $criteria->removeSelectColumn($alias . '.newpk');
            $criteria->removeSelectColumn($alias . '.res_message');
            $criteria->removeSelectColumn($alias . '.device_timestamp');
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
        return Propel::getServiceContainer()->getDatabaseMap(WdbSyncLogTableMap::DATABASE_NAME)->getTable(WdbSyncLogTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a WdbSyncLog or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or WdbSyncLog object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(WdbSyncLogTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\WdbSyncLog) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(WdbSyncLogTableMap::DATABASE_NAME);
            $criteria->add(WdbSyncLogTableMap::COL_WDB_ID, (array) $values, Criteria::IN);
        }

        $query = WdbSyncLogQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            WdbSyncLogTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                WdbSyncLogTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the wdb_sync_log table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return WdbSyncLogQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a WdbSyncLog or Criteria object.
     *
     * @param mixed $criteria Criteria or WdbSyncLog object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WdbSyncLogTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from WdbSyncLog object
        }

        if ($criteria->containsKey(WdbSyncLogTableMap::COL_WDB_ID) && $criteria->keyContainsValue(WdbSyncLogTableMap::COL_WDB_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.WdbSyncLogTableMap::COL_WDB_ID.')');
        }


        // Set the correct dbName
        $query = WdbSyncLogQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
