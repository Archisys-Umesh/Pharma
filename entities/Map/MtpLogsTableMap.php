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
use entities\MtpLogs;
use entities\MtpLogsQuery;


/**
 * This class defines the structure of the 'mtp_logs' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class MtpLogsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.MtpLogsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'mtp_logs';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'MtpLogs';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\MtpLogs';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.MtpLogs';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the mtp_log_id field
     */
    public const COL_MTP_LOG_ID = 'mtp_logs.mtp_log_id';

    /**
     * the column name for the mtp_id field
     */
    public const COL_MTP_ID = 'mtp_logs.mtp_id';

    /**
     * the column name for the log_function field
     */
    public const COL_LOG_FUNCTION = 'mtp_logs.log_function';

    /**
     * the column name for the log_description field
     */
    public const COL_LOG_DESCRIPTION = 'mtp_logs.log_description';

    /**
     * the column name for the debug_data field
     */
    public const COL_DEBUG_DATA = 'mtp_logs.debug_data';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'mtp_logs.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'mtp_logs.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'mtp_logs.updated_at';

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
        self::TYPE_PHPNAME       => ['MtpLogId', 'MtpId', 'LogFunction', 'LogDescription', 'DebugData', 'CompanyId', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['mtpLogId', 'mtpId', 'logFunction', 'logDescription', 'debugData', 'companyId', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [MtpLogsTableMap::COL_MTP_LOG_ID, MtpLogsTableMap::COL_MTP_ID, MtpLogsTableMap::COL_LOG_FUNCTION, MtpLogsTableMap::COL_LOG_DESCRIPTION, MtpLogsTableMap::COL_DEBUG_DATA, MtpLogsTableMap::COL_COMPANY_ID, MtpLogsTableMap::COL_CREATED_AT, MtpLogsTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['mtp_log_id', 'mtp_id', 'log_function', 'log_description', 'debug_data', 'company_id', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
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
        self::TYPE_PHPNAME       => ['MtpLogId' => 0, 'MtpId' => 1, 'LogFunction' => 2, 'LogDescription' => 3, 'DebugData' => 4, 'CompanyId' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['mtpLogId' => 0, 'mtpId' => 1, 'logFunction' => 2, 'logDescription' => 3, 'debugData' => 4, 'companyId' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [MtpLogsTableMap::COL_MTP_LOG_ID => 0, MtpLogsTableMap::COL_MTP_ID => 1, MtpLogsTableMap::COL_LOG_FUNCTION => 2, MtpLogsTableMap::COL_LOG_DESCRIPTION => 3, MtpLogsTableMap::COL_DEBUG_DATA => 4, MtpLogsTableMap::COL_COMPANY_ID => 5, MtpLogsTableMap::COL_CREATED_AT => 6, MtpLogsTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['mtp_log_id' => 0, 'mtp_id' => 1, 'log_function' => 2, 'log_description' => 3, 'debug_data' => 4, 'company_id' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'MtpLogId' => 'MTP_LOG_ID',
        'MtpLogs.MtpLogId' => 'MTP_LOG_ID',
        'mtpLogId' => 'MTP_LOG_ID',
        'mtpLogs.mtpLogId' => 'MTP_LOG_ID',
        'MtpLogsTableMap::COL_MTP_LOG_ID' => 'MTP_LOG_ID',
        'COL_MTP_LOG_ID' => 'MTP_LOG_ID',
        'mtp_log_id' => 'MTP_LOG_ID',
        'mtp_logs.mtp_log_id' => 'MTP_LOG_ID',
        'MtpId' => 'MTP_ID',
        'MtpLogs.MtpId' => 'MTP_ID',
        'mtpId' => 'MTP_ID',
        'mtpLogs.mtpId' => 'MTP_ID',
        'MtpLogsTableMap::COL_MTP_ID' => 'MTP_ID',
        'COL_MTP_ID' => 'MTP_ID',
        'mtp_id' => 'MTP_ID',
        'mtp_logs.mtp_id' => 'MTP_ID',
        'LogFunction' => 'LOG_FUNCTION',
        'MtpLogs.LogFunction' => 'LOG_FUNCTION',
        'logFunction' => 'LOG_FUNCTION',
        'mtpLogs.logFunction' => 'LOG_FUNCTION',
        'MtpLogsTableMap::COL_LOG_FUNCTION' => 'LOG_FUNCTION',
        'COL_LOG_FUNCTION' => 'LOG_FUNCTION',
        'log_function' => 'LOG_FUNCTION',
        'mtp_logs.log_function' => 'LOG_FUNCTION',
        'LogDescription' => 'LOG_DESCRIPTION',
        'MtpLogs.LogDescription' => 'LOG_DESCRIPTION',
        'logDescription' => 'LOG_DESCRIPTION',
        'mtpLogs.logDescription' => 'LOG_DESCRIPTION',
        'MtpLogsTableMap::COL_LOG_DESCRIPTION' => 'LOG_DESCRIPTION',
        'COL_LOG_DESCRIPTION' => 'LOG_DESCRIPTION',
        'log_description' => 'LOG_DESCRIPTION',
        'mtp_logs.log_description' => 'LOG_DESCRIPTION',
        'DebugData' => 'DEBUG_DATA',
        'MtpLogs.DebugData' => 'DEBUG_DATA',
        'debugData' => 'DEBUG_DATA',
        'mtpLogs.debugData' => 'DEBUG_DATA',
        'MtpLogsTableMap::COL_DEBUG_DATA' => 'DEBUG_DATA',
        'COL_DEBUG_DATA' => 'DEBUG_DATA',
        'debug_data' => 'DEBUG_DATA',
        'mtp_logs.debug_data' => 'DEBUG_DATA',
        'CompanyId' => 'COMPANY_ID',
        'MtpLogs.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'mtpLogs.companyId' => 'COMPANY_ID',
        'MtpLogsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'mtp_logs.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'MtpLogs.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'mtpLogs.createdAt' => 'CREATED_AT',
        'MtpLogsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'mtp_logs.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'MtpLogs.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'mtpLogs.updatedAt' => 'UPDATED_AT',
        'MtpLogsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'mtp_logs.updated_at' => 'UPDATED_AT',
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
        $this->setName('mtp_logs');
        $this->setPhpName('MtpLogs');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\MtpLogs');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('mtp_logs_mtp_log_id_seq');
        // columns
        $this->addPrimaryKey('mtp_log_id', 'MtpLogId', 'INTEGER', true, null, null);
        $this->addForeignKey('mtp_id', 'MtpId', 'INTEGER', 'mtp', 'mtp_id', false, null, null);
        $this->addColumn('log_function', 'LogFunction', 'VARCHAR', false, null, null);
        $this->addColumn('log_description', 'LogDescription', 'LONGVARCHAR', false, null, null);
        $this->addColumn('debug_data', 'DebugData', 'LONGVARCHAR', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
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
        $this->addRelation('Mtp', '\\entities\\Mtp', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':mtp_id',
    1 => ':mtp_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MtpLogId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MtpLogId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MtpLogId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MtpLogId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MtpLogId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MtpLogId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('MtpLogId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? MtpLogsTableMap::CLASS_DEFAULT : MtpLogsTableMap::OM_CLASS;
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
     * @return array (MtpLogs object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = MtpLogsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = MtpLogsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + MtpLogsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = MtpLogsTableMap::OM_CLASS;
            /** @var MtpLogs $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            MtpLogsTableMap::addInstanceToPool($obj, $key);
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
            $key = MtpLogsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = MtpLogsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var MtpLogs $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                MtpLogsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(MtpLogsTableMap::COL_MTP_LOG_ID);
            $criteria->addSelectColumn(MtpLogsTableMap::COL_MTP_ID);
            $criteria->addSelectColumn(MtpLogsTableMap::COL_LOG_FUNCTION);
            $criteria->addSelectColumn(MtpLogsTableMap::COL_LOG_DESCRIPTION);
            $criteria->addSelectColumn(MtpLogsTableMap::COL_DEBUG_DATA);
            $criteria->addSelectColumn(MtpLogsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(MtpLogsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(MtpLogsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.mtp_log_id');
            $criteria->addSelectColumn($alias . '.mtp_id');
            $criteria->addSelectColumn($alias . '.log_function');
            $criteria->addSelectColumn($alias . '.log_description');
            $criteria->addSelectColumn($alias . '.debug_data');
            $criteria->addSelectColumn($alias . '.company_id');
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
            $criteria->removeSelectColumn(MtpLogsTableMap::COL_MTP_LOG_ID);
            $criteria->removeSelectColumn(MtpLogsTableMap::COL_MTP_ID);
            $criteria->removeSelectColumn(MtpLogsTableMap::COL_LOG_FUNCTION);
            $criteria->removeSelectColumn(MtpLogsTableMap::COL_LOG_DESCRIPTION);
            $criteria->removeSelectColumn(MtpLogsTableMap::COL_DEBUG_DATA);
            $criteria->removeSelectColumn(MtpLogsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(MtpLogsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(MtpLogsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.mtp_log_id');
            $criteria->removeSelectColumn($alias . '.mtp_id');
            $criteria->removeSelectColumn($alias . '.log_function');
            $criteria->removeSelectColumn($alias . '.log_description');
            $criteria->removeSelectColumn($alias . '.debug_data');
            $criteria->removeSelectColumn($alias . '.company_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(MtpLogsTableMap::DATABASE_NAME)->getTable(MtpLogsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a MtpLogs or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or MtpLogs object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(MtpLogsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\MtpLogs) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(MtpLogsTableMap::DATABASE_NAME);
            $criteria->add(MtpLogsTableMap::COL_MTP_LOG_ID, (array) $values, Criteria::IN);
        }

        $query = MtpLogsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            MtpLogsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                MtpLogsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the mtp_logs table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return MtpLogsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a MtpLogs or Criteria object.
     *
     * @param mixed $criteria Criteria or MtpLogs object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MtpLogsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from MtpLogs object
        }

        if ($criteria->containsKey(MtpLogsTableMap::COL_MTP_LOG_ID) && $criteria->keyContainsValue(MtpLogsTableMap::COL_MTP_LOG_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.MtpLogsTableMap::COL_MTP_LOG_ID.')');
        }


        // Set the correct dbName
        $query = MtpLogsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
