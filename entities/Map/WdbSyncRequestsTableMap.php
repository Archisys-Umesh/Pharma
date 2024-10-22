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
use entities\WdbSyncRequests;
use entities\WdbSyncRequestsQuery;


/**
 * This class defines the structure of the 'wdb_sync_requests' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class WdbSyncRequestsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.WdbSyncRequestsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'wdb_sync_requests';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'WdbSyncRequests';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\WdbSyncRequests';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.WdbSyncRequests';

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
     * the column name for the sync_id field
     */
    public const COL_SYNC_ID = 'wdb_sync_requests.sync_id';

    /**
     * the column name for the user_id field
     */
    public const COL_USER_ID = 'wdb_sync_requests.user_id';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'wdb_sync_requests.status';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'wdb_sync_requests.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'wdb_sync_requests.updated_at';

    /**
     * the column name for the s3_url field
     */
    public const COL_S3_URL = 'wdb_sync_requests.s3_url';

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
        self::TYPE_PHPNAME       => ['SyncId', 'UserId', 'Status', 'CreatedAt', 'UpdatedAt', 'S3Url', ],
        self::TYPE_CAMELNAME     => ['syncId', 'userId', 'status', 'createdAt', 'updatedAt', 's3Url', ],
        self::TYPE_COLNAME       => [WdbSyncRequestsTableMap::COL_SYNC_ID, WdbSyncRequestsTableMap::COL_USER_ID, WdbSyncRequestsTableMap::COL_STATUS, WdbSyncRequestsTableMap::COL_CREATED_AT, WdbSyncRequestsTableMap::COL_UPDATED_AT, WdbSyncRequestsTableMap::COL_S3_URL, ],
        self::TYPE_FIELDNAME     => ['sync_id', 'user_id', 'status', 'created_at', 'updated_at', 's3_url', ],
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
        self::TYPE_PHPNAME       => ['SyncId' => 0, 'UserId' => 1, 'Status' => 2, 'CreatedAt' => 3, 'UpdatedAt' => 4, 'S3Url' => 5, ],
        self::TYPE_CAMELNAME     => ['syncId' => 0, 'userId' => 1, 'status' => 2, 'createdAt' => 3, 'updatedAt' => 4, 's3Url' => 5, ],
        self::TYPE_COLNAME       => [WdbSyncRequestsTableMap::COL_SYNC_ID => 0, WdbSyncRequestsTableMap::COL_USER_ID => 1, WdbSyncRequestsTableMap::COL_STATUS => 2, WdbSyncRequestsTableMap::COL_CREATED_AT => 3, WdbSyncRequestsTableMap::COL_UPDATED_AT => 4, WdbSyncRequestsTableMap::COL_S3_URL => 5, ],
        self::TYPE_FIELDNAME     => ['sync_id' => 0, 'user_id' => 1, 'status' => 2, 'created_at' => 3, 'updated_at' => 4, 's3_url' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'SyncId' => 'SYNC_ID',
        'WdbSyncRequests.SyncId' => 'SYNC_ID',
        'syncId' => 'SYNC_ID',
        'wdbSyncRequests.syncId' => 'SYNC_ID',
        'WdbSyncRequestsTableMap::COL_SYNC_ID' => 'SYNC_ID',
        'COL_SYNC_ID' => 'SYNC_ID',
        'sync_id' => 'SYNC_ID',
        'wdb_sync_requests.sync_id' => 'SYNC_ID',
        'UserId' => 'USER_ID',
        'WdbSyncRequests.UserId' => 'USER_ID',
        'userId' => 'USER_ID',
        'wdbSyncRequests.userId' => 'USER_ID',
        'WdbSyncRequestsTableMap::COL_USER_ID' => 'USER_ID',
        'COL_USER_ID' => 'USER_ID',
        'user_id' => 'USER_ID',
        'wdb_sync_requests.user_id' => 'USER_ID',
        'Status' => 'STATUS',
        'WdbSyncRequests.Status' => 'STATUS',
        'status' => 'STATUS',
        'wdbSyncRequests.status' => 'STATUS',
        'WdbSyncRequestsTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'wdb_sync_requests.status' => 'STATUS',
        'CreatedAt' => 'CREATED_AT',
        'WdbSyncRequests.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'wdbSyncRequests.createdAt' => 'CREATED_AT',
        'WdbSyncRequestsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'wdb_sync_requests.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'WdbSyncRequests.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'wdbSyncRequests.updatedAt' => 'UPDATED_AT',
        'WdbSyncRequestsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'wdb_sync_requests.updated_at' => 'UPDATED_AT',
        'S3Url' => 'S3_URL',
        'WdbSyncRequests.S3Url' => 'S3_URL',
        's3Url' => 'S3_URL',
        'wdbSyncRequests.s3Url' => 'S3_URL',
        'WdbSyncRequestsTableMap::COL_S3_URL' => 'S3_URL',
        'COL_S3_URL' => 'S3_URL',
        's3_url' => 'S3_URL',
        'wdb_sync_requests.s3_url' => 'S3_URL',
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
        $this->setName('wdb_sync_requests');
        $this->setPhpName('WdbSyncRequests');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\WdbSyncRequests');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('wdb_sync_requests_sync_id_seq');
        // columns
        $this->addPrimaryKey('sync_id', 'SyncId', 'INTEGER', true, null, null);
        $this->addColumn('user_id', 'UserId', 'INTEGER', false, null, null);
        $this->addColumn('status', 'Status', 'VARCHAR', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('s3_url', 'S3Url', 'VARCHAR', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SyncId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SyncId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SyncId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SyncId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SyncId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SyncId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('SyncId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? WdbSyncRequestsTableMap::CLASS_DEFAULT : WdbSyncRequestsTableMap::OM_CLASS;
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
     * @return array (WdbSyncRequests object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = WdbSyncRequestsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = WdbSyncRequestsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + WdbSyncRequestsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = WdbSyncRequestsTableMap::OM_CLASS;
            /** @var WdbSyncRequests $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            WdbSyncRequestsTableMap::addInstanceToPool($obj, $key);
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
            $key = WdbSyncRequestsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = WdbSyncRequestsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var WdbSyncRequests $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                WdbSyncRequestsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(WdbSyncRequestsTableMap::COL_SYNC_ID);
            $criteria->addSelectColumn(WdbSyncRequestsTableMap::COL_USER_ID);
            $criteria->addSelectColumn(WdbSyncRequestsTableMap::COL_STATUS);
            $criteria->addSelectColumn(WdbSyncRequestsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(WdbSyncRequestsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(WdbSyncRequestsTableMap::COL_S3_URL);
        } else {
            $criteria->addSelectColumn($alias . '.sync_id');
            $criteria->addSelectColumn($alias . '.user_id');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.s3_url');
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
            $criteria->removeSelectColumn(WdbSyncRequestsTableMap::COL_SYNC_ID);
            $criteria->removeSelectColumn(WdbSyncRequestsTableMap::COL_USER_ID);
            $criteria->removeSelectColumn(WdbSyncRequestsTableMap::COL_STATUS);
            $criteria->removeSelectColumn(WdbSyncRequestsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(WdbSyncRequestsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(WdbSyncRequestsTableMap::COL_S3_URL);
        } else {
            $criteria->removeSelectColumn($alias . '.sync_id');
            $criteria->removeSelectColumn($alias . '.user_id');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.s3_url');
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
        return Propel::getServiceContainer()->getDatabaseMap(WdbSyncRequestsTableMap::DATABASE_NAME)->getTable(WdbSyncRequestsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a WdbSyncRequests or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or WdbSyncRequests object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(WdbSyncRequestsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\WdbSyncRequests) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(WdbSyncRequestsTableMap::DATABASE_NAME);
            $criteria->add(WdbSyncRequestsTableMap::COL_SYNC_ID, (array) $values, Criteria::IN);
        }

        $query = WdbSyncRequestsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            WdbSyncRequestsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                WdbSyncRequestsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the wdb_sync_requests table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return WdbSyncRequestsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a WdbSyncRequests or Criteria object.
     *
     * @param mixed $criteria Criteria or WdbSyncRequests object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WdbSyncRequestsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from WdbSyncRequests object
        }

        if ($criteria->containsKey(WdbSyncRequestsTableMap::COL_SYNC_ID) && $criteria->keyContainsValue(WdbSyncRequestsTableMap::COL_SYNC_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.WdbSyncRequestsTableMap::COL_SYNC_ID.')');
        }


        // Set the correct dbName
        $query = WdbSyncRequestsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
