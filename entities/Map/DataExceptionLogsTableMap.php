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
use entities\DataExceptionLogs;
use entities\DataExceptionLogsQuery;


/**
 * This class defines the structure of the 'data_exception_logs' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class DataExceptionLogsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.DataExceptionLogsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'data_exception_logs';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'DataExceptionLogs';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\DataExceptionLogs';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.DataExceptionLogs';

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
     * the column name for the data_exception_log_id field
     */
    public const COL_DATA_EXCEPTION_LOG_ID = 'data_exception_logs.data_exception_log_id';

    /**
     * the column name for the data_exception_id field
     */
    public const COL_DATA_EXCEPTION_ID = 'data_exception_logs.data_exception_id';

    /**
     * the column name for the date field
     */
    public const COL_DATE = 'data_exception_logs.date';

    /**
     * the column name for the has_exception field
     */
    public const COL_HAS_EXCEPTION = 'data_exception_logs.has_exception';

    /**
     * the column name for the exception_data field
     */
    public const COL_EXCEPTION_DATA = 'data_exception_logs.exception_data';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'data_exception_logs.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'data_exception_logs.updated_at';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'data_exception_logs.company_id';

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
        self::TYPE_PHPNAME       => ['DataExceptionLogId', 'DataExceptionId', 'Date', 'HasException', 'ExceptionData', 'CreatedAt', 'UpdatedAt', 'CompanyId', ],
        self::TYPE_CAMELNAME     => ['dataExceptionLogId', 'dataExceptionId', 'date', 'hasException', 'exceptionData', 'createdAt', 'updatedAt', 'companyId', ],
        self::TYPE_COLNAME       => [DataExceptionLogsTableMap::COL_DATA_EXCEPTION_LOG_ID, DataExceptionLogsTableMap::COL_DATA_EXCEPTION_ID, DataExceptionLogsTableMap::COL_DATE, DataExceptionLogsTableMap::COL_HAS_EXCEPTION, DataExceptionLogsTableMap::COL_EXCEPTION_DATA, DataExceptionLogsTableMap::COL_CREATED_AT, DataExceptionLogsTableMap::COL_UPDATED_AT, DataExceptionLogsTableMap::COL_COMPANY_ID, ],
        self::TYPE_FIELDNAME     => ['data_exception_log_id', 'data_exception_id', 'date', 'has_exception', 'exception_data', 'created_at', 'updated_at', 'company_id', ],
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
        self::TYPE_PHPNAME       => ['DataExceptionLogId' => 0, 'DataExceptionId' => 1, 'Date' => 2, 'HasException' => 3, 'ExceptionData' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, 'CompanyId' => 7, ],
        self::TYPE_CAMELNAME     => ['dataExceptionLogId' => 0, 'dataExceptionId' => 1, 'date' => 2, 'hasException' => 3, 'exceptionData' => 4, 'createdAt' => 5, 'updatedAt' => 6, 'companyId' => 7, ],
        self::TYPE_COLNAME       => [DataExceptionLogsTableMap::COL_DATA_EXCEPTION_LOG_ID => 0, DataExceptionLogsTableMap::COL_DATA_EXCEPTION_ID => 1, DataExceptionLogsTableMap::COL_DATE => 2, DataExceptionLogsTableMap::COL_HAS_EXCEPTION => 3, DataExceptionLogsTableMap::COL_EXCEPTION_DATA => 4, DataExceptionLogsTableMap::COL_CREATED_AT => 5, DataExceptionLogsTableMap::COL_UPDATED_AT => 6, DataExceptionLogsTableMap::COL_COMPANY_ID => 7, ],
        self::TYPE_FIELDNAME     => ['data_exception_log_id' => 0, 'data_exception_id' => 1, 'date' => 2, 'has_exception' => 3, 'exception_data' => 4, 'created_at' => 5, 'updated_at' => 6, 'company_id' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'DataExceptionLogId' => 'DATA_EXCEPTION_LOG_ID',
        'DataExceptionLogs.DataExceptionLogId' => 'DATA_EXCEPTION_LOG_ID',
        'dataExceptionLogId' => 'DATA_EXCEPTION_LOG_ID',
        'dataExceptionLogs.dataExceptionLogId' => 'DATA_EXCEPTION_LOG_ID',
        'DataExceptionLogsTableMap::COL_DATA_EXCEPTION_LOG_ID' => 'DATA_EXCEPTION_LOG_ID',
        'COL_DATA_EXCEPTION_LOG_ID' => 'DATA_EXCEPTION_LOG_ID',
        'data_exception_log_id' => 'DATA_EXCEPTION_LOG_ID',
        'data_exception_logs.data_exception_log_id' => 'DATA_EXCEPTION_LOG_ID',
        'DataExceptionId' => 'DATA_EXCEPTION_ID',
        'DataExceptionLogs.DataExceptionId' => 'DATA_EXCEPTION_ID',
        'dataExceptionId' => 'DATA_EXCEPTION_ID',
        'dataExceptionLogs.dataExceptionId' => 'DATA_EXCEPTION_ID',
        'DataExceptionLogsTableMap::COL_DATA_EXCEPTION_ID' => 'DATA_EXCEPTION_ID',
        'COL_DATA_EXCEPTION_ID' => 'DATA_EXCEPTION_ID',
        'data_exception_id' => 'DATA_EXCEPTION_ID',
        'data_exception_logs.data_exception_id' => 'DATA_EXCEPTION_ID',
        'Date' => 'DATE',
        'DataExceptionLogs.Date' => 'DATE',
        'date' => 'DATE',
        'dataExceptionLogs.date' => 'DATE',
        'DataExceptionLogsTableMap::COL_DATE' => 'DATE',
        'COL_DATE' => 'DATE',
        'data_exception_logs.date' => 'DATE',
        'HasException' => 'HAS_EXCEPTION',
        'DataExceptionLogs.HasException' => 'HAS_EXCEPTION',
        'hasException' => 'HAS_EXCEPTION',
        'dataExceptionLogs.hasException' => 'HAS_EXCEPTION',
        'DataExceptionLogsTableMap::COL_HAS_EXCEPTION' => 'HAS_EXCEPTION',
        'COL_HAS_EXCEPTION' => 'HAS_EXCEPTION',
        'has_exception' => 'HAS_EXCEPTION',
        'data_exception_logs.has_exception' => 'HAS_EXCEPTION',
        'ExceptionData' => 'EXCEPTION_DATA',
        'DataExceptionLogs.ExceptionData' => 'EXCEPTION_DATA',
        'exceptionData' => 'EXCEPTION_DATA',
        'dataExceptionLogs.exceptionData' => 'EXCEPTION_DATA',
        'DataExceptionLogsTableMap::COL_EXCEPTION_DATA' => 'EXCEPTION_DATA',
        'COL_EXCEPTION_DATA' => 'EXCEPTION_DATA',
        'exception_data' => 'EXCEPTION_DATA',
        'data_exception_logs.exception_data' => 'EXCEPTION_DATA',
        'CreatedAt' => 'CREATED_AT',
        'DataExceptionLogs.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'dataExceptionLogs.createdAt' => 'CREATED_AT',
        'DataExceptionLogsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'data_exception_logs.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'DataExceptionLogs.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'dataExceptionLogs.updatedAt' => 'UPDATED_AT',
        'DataExceptionLogsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'data_exception_logs.updated_at' => 'UPDATED_AT',
        'CompanyId' => 'COMPANY_ID',
        'DataExceptionLogs.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'dataExceptionLogs.companyId' => 'COMPANY_ID',
        'DataExceptionLogsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'data_exception_logs.company_id' => 'COMPANY_ID',
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
        $this->setName('data_exception_logs');
        $this->setPhpName('DataExceptionLogs');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\DataExceptionLogs');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('data_exception_logs_data_exception_log_id_seq');
        // columns
        $this->addPrimaryKey('data_exception_log_id', 'DataExceptionLogId', 'INTEGER', true, null, null);
        $this->addForeignKey('data_exception_id', 'DataExceptionId', 'INTEGER', 'data_exceptions', 'data_exception_id', true, null, null);
        $this->addColumn('date', 'Date', 'DATE', true, null, null);
        $this->addColumn('has_exception', 'HasException', 'BOOLEAN', false, 1, true);
        $this->addColumn('exception_data', 'ExceptionData', 'LONGVARCHAR', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
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
        $this->addRelation('DataExceptions', '\\entities\\DataExceptions', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':data_exception_id',
    1 => ':data_exception_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DataExceptionLogId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DataExceptionLogId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DataExceptionLogId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DataExceptionLogId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DataExceptionLogId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DataExceptionLogId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('DataExceptionLogId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? DataExceptionLogsTableMap::CLASS_DEFAULT : DataExceptionLogsTableMap::OM_CLASS;
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
     * @return array (DataExceptionLogs object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = DataExceptionLogsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DataExceptionLogsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DataExceptionLogsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DataExceptionLogsTableMap::OM_CLASS;
            /** @var DataExceptionLogs $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DataExceptionLogsTableMap::addInstanceToPool($obj, $key);
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
            $key = DataExceptionLogsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DataExceptionLogsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var DataExceptionLogs $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DataExceptionLogsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(DataExceptionLogsTableMap::COL_DATA_EXCEPTION_LOG_ID);
            $criteria->addSelectColumn(DataExceptionLogsTableMap::COL_DATA_EXCEPTION_ID);
            $criteria->addSelectColumn(DataExceptionLogsTableMap::COL_DATE);
            $criteria->addSelectColumn(DataExceptionLogsTableMap::COL_HAS_EXCEPTION);
            $criteria->addSelectColumn(DataExceptionLogsTableMap::COL_EXCEPTION_DATA);
            $criteria->addSelectColumn(DataExceptionLogsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(DataExceptionLogsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(DataExceptionLogsTableMap::COL_COMPANY_ID);
        } else {
            $criteria->addSelectColumn($alias . '.data_exception_log_id');
            $criteria->addSelectColumn($alias . '.data_exception_id');
            $criteria->addSelectColumn($alias . '.date');
            $criteria->addSelectColumn($alias . '.has_exception');
            $criteria->addSelectColumn($alias . '.exception_data');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.company_id');
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
            $criteria->removeSelectColumn(DataExceptionLogsTableMap::COL_DATA_EXCEPTION_LOG_ID);
            $criteria->removeSelectColumn(DataExceptionLogsTableMap::COL_DATA_EXCEPTION_ID);
            $criteria->removeSelectColumn(DataExceptionLogsTableMap::COL_DATE);
            $criteria->removeSelectColumn(DataExceptionLogsTableMap::COL_HAS_EXCEPTION);
            $criteria->removeSelectColumn(DataExceptionLogsTableMap::COL_EXCEPTION_DATA);
            $criteria->removeSelectColumn(DataExceptionLogsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(DataExceptionLogsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(DataExceptionLogsTableMap::COL_COMPANY_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.data_exception_log_id');
            $criteria->removeSelectColumn($alias . '.data_exception_id');
            $criteria->removeSelectColumn($alias . '.date');
            $criteria->removeSelectColumn($alias . '.has_exception');
            $criteria->removeSelectColumn($alias . '.exception_data');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.company_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(DataExceptionLogsTableMap::DATABASE_NAME)->getTable(DataExceptionLogsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a DataExceptionLogs or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or DataExceptionLogs object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(DataExceptionLogsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\DataExceptionLogs) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DataExceptionLogsTableMap::DATABASE_NAME);
            $criteria->add(DataExceptionLogsTableMap::COL_DATA_EXCEPTION_LOG_ID, (array) $values, Criteria::IN);
        }

        $query = DataExceptionLogsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            DataExceptionLogsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                DataExceptionLogsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the data_exception_logs table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return DataExceptionLogsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a DataExceptionLogs or Criteria object.
     *
     * @param mixed $criteria Criteria or DataExceptionLogs object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DataExceptionLogsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from DataExceptionLogs object
        }

        if ($criteria->containsKey(DataExceptionLogsTableMap::COL_DATA_EXCEPTION_LOG_ID) && $criteria->keyContainsValue(DataExceptionLogsTableMap::COL_DATA_EXCEPTION_LOG_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DataExceptionLogsTableMap::COL_DATA_EXCEPTION_LOG_ID.')');
        }


        // Set the correct dbName
        $query = DataExceptionLogsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
