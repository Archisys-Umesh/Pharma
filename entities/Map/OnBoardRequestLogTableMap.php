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
use entities\OnBoardRequestLog;
use entities\OnBoardRequestLogQuery;


/**
 * This class defines the structure of the 'on_board_request_log' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OnBoardRequestLogTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OnBoardRequestLogTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'on_board_request_log';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OnBoardRequestLog';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OnBoardRequestLog';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OnBoardRequestLog';

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
     * the column name for the on_board_request_log_id field
     */
    public const COL_ON_BOARD_REQUEST_LOG_ID = 'on_board_request_log.on_board_request_log_id';

    /**
     * the column name for the on_board_request_id field
     */
    public const COL_ON_BOARD_REQUEST_ID = 'on_board_request_log.on_board_request_id';

    /**
     * the column name for the on_board_request_from_status_id field
     */
    public const COL_ON_BOARD_REQUEST_FROM_STATUS_ID = 'on_board_request_log.on_board_request_from_status_id';

    /**
     * the column name for the on_board_request_to_status_id field
     */
    public const COL_ON_BOARD_REQUEST_TO_STATUS_ID = 'on_board_request_log.on_board_request_to_status_id';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'on_board_request_log.employee_id';

    /**
     * the column name for the employee_position_id field
     */
    public const COL_EMPLOYEE_POSITION_ID = 'on_board_request_log.employee_position_id';

    /**
     * the column name for the description field
     */
    public const COL_DESCRIPTION = 'on_board_request_log.description';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'on_board_request_log.created_at';

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
        self::TYPE_PHPNAME       => ['OnBoardRequestLogId', 'OnBoardRequestId', 'OnBoardRequestFromStatusId', 'OnBoardRequestToStatusId', 'EmployeeId', 'EmployeePositionId', 'Description', 'CreatedAt', ],
        self::TYPE_CAMELNAME     => ['onBoardRequestLogId', 'onBoardRequestId', 'onBoardRequestFromStatusId', 'onBoardRequestToStatusId', 'employeeId', 'employeePositionId', 'description', 'createdAt', ],
        self::TYPE_COLNAME       => [OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_LOG_ID, OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_ID, OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_FROM_STATUS_ID, OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_TO_STATUS_ID, OnBoardRequestLogTableMap::COL_EMPLOYEE_ID, OnBoardRequestLogTableMap::COL_EMPLOYEE_POSITION_ID, OnBoardRequestLogTableMap::COL_DESCRIPTION, OnBoardRequestLogTableMap::COL_CREATED_AT, ],
        self::TYPE_FIELDNAME     => ['on_board_request_log_id', 'on_board_request_id', 'on_board_request_from_status_id', 'on_board_request_to_status_id', 'employee_id', 'employee_position_id', 'description', 'created_at', ],
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
        self::TYPE_PHPNAME       => ['OnBoardRequestLogId' => 0, 'OnBoardRequestId' => 1, 'OnBoardRequestFromStatusId' => 2, 'OnBoardRequestToStatusId' => 3, 'EmployeeId' => 4, 'EmployeePositionId' => 5, 'Description' => 6, 'CreatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['onBoardRequestLogId' => 0, 'onBoardRequestId' => 1, 'onBoardRequestFromStatusId' => 2, 'onBoardRequestToStatusId' => 3, 'employeeId' => 4, 'employeePositionId' => 5, 'description' => 6, 'createdAt' => 7, ],
        self::TYPE_COLNAME       => [OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_LOG_ID => 0, OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_ID => 1, OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_FROM_STATUS_ID => 2, OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_TO_STATUS_ID => 3, OnBoardRequestLogTableMap::COL_EMPLOYEE_ID => 4, OnBoardRequestLogTableMap::COL_EMPLOYEE_POSITION_ID => 5, OnBoardRequestLogTableMap::COL_DESCRIPTION => 6, OnBoardRequestLogTableMap::COL_CREATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['on_board_request_log_id' => 0, 'on_board_request_id' => 1, 'on_board_request_from_status_id' => 2, 'on_board_request_to_status_id' => 3, 'employee_id' => 4, 'employee_position_id' => 5, 'description' => 6, 'created_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OnBoardRequestLogId' => 'ON_BOARD_REQUEST_LOG_ID',
        'OnBoardRequestLog.OnBoardRequestLogId' => 'ON_BOARD_REQUEST_LOG_ID',
        'onBoardRequestLogId' => 'ON_BOARD_REQUEST_LOG_ID',
        'onBoardRequestLog.onBoardRequestLogId' => 'ON_BOARD_REQUEST_LOG_ID',
        'OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_LOG_ID' => 'ON_BOARD_REQUEST_LOG_ID',
        'COL_ON_BOARD_REQUEST_LOG_ID' => 'ON_BOARD_REQUEST_LOG_ID',
        'on_board_request_log_id' => 'ON_BOARD_REQUEST_LOG_ID',
        'on_board_request_log.on_board_request_log_id' => 'ON_BOARD_REQUEST_LOG_ID',
        'OnBoardRequestId' => 'ON_BOARD_REQUEST_ID',
        'OnBoardRequestLog.OnBoardRequestId' => 'ON_BOARD_REQUEST_ID',
        'onBoardRequestId' => 'ON_BOARD_REQUEST_ID',
        'onBoardRequestLog.onBoardRequestId' => 'ON_BOARD_REQUEST_ID',
        'OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_ID' => 'ON_BOARD_REQUEST_ID',
        'COL_ON_BOARD_REQUEST_ID' => 'ON_BOARD_REQUEST_ID',
        'on_board_request_id' => 'ON_BOARD_REQUEST_ID',
        'on_board_request_log.on_board_request_id' => 'ON_BOARD_REQUEST_ID',
        'OnBoardRequestFromStatusId' => 'ON_BOARD_REQUEST_FROM_STATUS_ID',
        'OnBoardRequestLog.OnBoardRequestFromStatusId' => 'ON_BOARD_REQUEST_FROM_STATUS_ID',
        'onBoardRequestFromStatusId' => 'ON_BOARD_REQUEST_FROM_STATUS_ID',
        'onBoardRequestLog.onBoardRequestFromStatusId' => 'ON_BOARD_REQUEST_FROM_STATUS_ID',
        'OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_FROM_STATUS_ID' => 'ON_BOARD_REQUEST_FROM_STATUS_ID',
        'COL_ON_BOARD_REQUEST_FROM_STATUS_ID' => 'ON_BOARD_REQUEST_FROM_STATUS_ID',
        'on_board_request_from_status_id' => 'ON_BOARD_REQUEST_FROM_STATUS_ID',
        'on_board_request_log.on_board_request_from_status_id' => 'ON_BOARD_REQUEST_FROM_STATUS_ID',
        'OnBoardRequestToStatusId' => 'ON_BOARD_REQUEST_TO_STATUS_ID',
        'OnBoardRequestLog.OnBoardRequestToStatusId' => 'ON_BOARD_REQUEST_TO_STATUS_ID',
        'onBoardRequestToStatusId' => 'ON_BOARD_REQUEST_TO_STATUS_ID',
        'onBoardRequestLog.onBoardRequestToStatusId' => 'ON_BOARD_REQUEST_TO_STATUS_ID',
        'OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_TO_STATUS_ID' => 'ON_BOARD_REQUEST_TO_STATUS_ID',
        'COL_ON_BOARD_REQUEST_TO_STATUS_ID' => 'ON_BOARD_REQUEST_TO_STATUS_ID',
        'on_board_request_to_status_id' => 'ON_BOARD_REQUEST_TO_STATUS_ID',
        'on_board_request_log.on_board_request_to_status_id' => 'ON_BOARD_REQUEST_TO_STATUS_ID',
        'EmployeeId' => 'EMPLOYEE_ID',
        'OnBoardRequestLog.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'onBoardRequestLog.employeeId' => 'EMPLOYEE_ID',
        'OnBoardRequestLogTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'on_board_request_log.employee_id' => 'EMPLOYEE_ID',
        'EmployeePositionId' => 'EMPLOYEE_POSITION_ID',
        'OnBoardRequestLog.EmployeePositionId' => 'EMPLOYEE_POSITION_ID',
        'employeePositionId' => 'EMPLOYEE_POSITION_ID',
        'onBoardRequestLog.employeePositionId' => 'EMPLOYEE_POSITION_ID',
        'OnBoardRequestLogTableMap::COL_EMPLOYEE_POSITION_ID' => 'EMPLOYEE_POSITION_ID',
        'COL_EMPLOYEE_POSITION_ID' => 'EMPLOYEE_POSITION_ID',
        'employee_position_id' => 'EMPLOYEE_POSITION_ID',
        'on_board_request_log.employee_position_id' => 'EMPLOYEE_POSITION_ID',
        'Description' => 'DESCRIPTION',
        'OnBoardRequestLog.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'onBoardRequestLog.description' => 'DESCRIPTION',
        'OnBoardRequestLogTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'on_board_request_log.description' => 'DESCRIPTION',
        'CreatedAt' => 'CREATED_AT',
        'OnBoardRequestLog.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'onBoardRequestLog.createdAt' => 'CREATED_AT',
        'OnBoardRequestLogTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'on_board_request_log.created_at' => 'CREATED_AT',
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
        $this->setName('on_board_request_log');
        $this->setPhpName('OnBoardRequestLog');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OnBoardRequestLog');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('on_board_request_log_on_board_request_log_id_seq');
        // columns
        $this->addPrimaryKey('on_board_request_log_id', 'OnBoardRequestLogId', 'INTEGER', true, null, null);
        $this->addForeignKey('on_board_request_id', 'OnBoardRequestId', 'INTEGER', 'on_board_request', 'on_board_request_id', false, null, null);
        $this->addColumn('on_board_request_from_status_id', 'OnBoardRequestFromStatusId', 'INTEGER', false, null, null);
        $this->addColumn('on_board_request_to_status_id', 'OnBoardRequestToStatusId', 'INTEGER', false, null, null);
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', false, null, null);
        $this->addForeignKey('employee_position_id', 'EmployeePositionId', 'INTEGER', 'positions', 'position_id', false, null, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Employee', '\\entities\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, null, false);
        $this->addRelation('Positions', '\\entities\\Positions', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':employee_position_id',
    1 => ':position_id',
  ),
), null, null, null, false);
        $this->addRelation('OnBoardRequest', '\\entities\\OnBoardRequest', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':on_board_request_id',
    1 => ':on_board_request_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestLogId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestLogId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestLogId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestLogId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestLogId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestLogId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('OnBoardRequestLogId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OnBoardRequestLogTableMap::CLASS_DEFAULT : OnBoardRequestLogTableMap::OM_CLASS;
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
     * @return array (OnBoardRequestLog object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OnBoardRequestLogTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OnBoardRequestLogTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OnBoardRequestLogTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OnBoardRequestLogTableMap::OM_CLASS;
            /** @var OnBoardRequestLog $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OnBoardRequestLogTableMap::addInstanceToPool($obj, $key);
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
            $key = OnBoardRequestLogTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OnBoardRequestLogTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OnBoardRequestLog $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OnBoardRequestLogTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_LOG_ID);
            $criteria->addSelectColumn(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_ID);
            $criteria->addSelectColumn(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_FROM_STATUS_ID);
            $criteria->addSelectColumn(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_TO_STATUS_ID);
            $criteria->addSelectColumn(OnBoardRequestLogTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(OnBoardRequestLogTableMap::COL_EMPLOYEE_POSITION_ID);
            $criteria->addSelectColumn(OnBoardRequestLogTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(OnBoardRequestLogTableMap::COL_CREATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.on_board_request_log_id');
            $criteria->addSelectColumn($alias . '.on_board_request_id');
            $criteria->addSelectColumn($alias . '.on_board_request_from_status_id');
            $criteria->addSelectColumn($alias . '.on_board_request_to_status_id');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.employee_position_id');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.created_at');
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
            $criteria->removeSelectColumn(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_LOG_ID);
            $criteria->removeSelectColumn(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_ID);
            $criteria->removeSelectColumn(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_FROM_STATUS_ID);
            $criteria->removeSelectColumn(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_TO_STATUS_ID);
            $criteria->removeSelectColumn(OnBoardRequestLogTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(OnBoardRequestLogTableMap::COL_EMPLOYEE_POSITION_ID);
            $criteria->removeSelectColumn(OnBoardRequestLogTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(OnBoardRequestLogTableMap::COL_CREATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.on_board_request_log_id');
            $criteria->removeSelectColumn($alias . '.on_board_request_id');
            $criteria->removeSelectColumn($alias . '.on_board_request_from_status_id');
            $criteria->removeSelectColumn($alias . '.on_board_request_to_status_id');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.employee_position_id');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.created_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(OnBoardRequestLogTableMap::DATABASE_NAME)->getTable(OnBoardRequestLogTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OnBoardRequestLog or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OnBoardRequestLog object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OnBoardRequestLogTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OnBoardRequestLog) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OnBoardRequestLogTableMap::DATABASE_NAME);
            $criteria->add(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_LOG_ID, (array) $values, Criteria::IN);
        }

        $query = OnBoardRequestLogQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OnBoardRequestLogTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OnBoardRequestLogTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the on_board_request_log table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OnBoardRequestLogQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OnBoardRequestLog or Criteria object.
     *
     * @param mixed $criteria Criteria or OnBoardRequestLog object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OnBoardRequestLogTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OnBoardRequestLog object
        }

        if ($criteria->containsKey(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_LOG_ID) && $criteria->keyContainsValue(OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_LOG_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OnBoardRequestLogTableMap::COL_ON_BOARD_REQUEST_LOG_ID.')');
        }


        // Set the correct dbName
        $query = OnBoardRequestLogQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
