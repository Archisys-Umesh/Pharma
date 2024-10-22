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
use entities\DataChangeRequests;
use entities\DataChangeRequestsQuery;


/**
 * This class defines the structure of the 'data_change_requests' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class DataChangeRequestsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.DataChangeRequestsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'data_change_requests';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'DataChangeRequests';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\DataChangeRequests';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.DataChangeRequests';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 13;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 13;

    /**
     * the column name for the data_change_request_id field
     */
    public const COL_DATA_CHANGE_REQUEST_ID = 'data_change_requests.data_change_request_id';

    /**
     * the column name for the import_template field
     */
    public const COL_IMPORT_TEMPLATE = 'data_change_requests.import_template';

    /**
     * the column name for the import_file_path field
     */
    public const COL_IMPORT_FILE_PATH = 'data_change_requests.import_file_path';

    /**
     * the column name for the requested_data field
     */
    public const COL_REQUESTED_DATA = 'data_change_requests.requested_data';

    /**
     * the column name for the action_type field
     */
    public const COL_ACTION_TYPE = 'data_change_requests.action_type';

    /**
     * the column name for the schedule_date field
     */
    public const COL_SCHEDULE_DATE = 'data_change_requests.schedule_date';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'data_change_requests.status';

    /**
     * the column name for the has_error field
     */
    public const COL_HAS_ERROR = 'data_change_requests.has_error';

    /**
     * the column name for the error_message field
     */
    public const COL_ERROR_MESSAGE = 'data_change_requests.error_message';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'data_change_requests.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'data_change_requests.updated_at';

    /**
     * the column name for the import_file_log_id field
     */
    public const COL_IMPORT_FILE_LOG_ID = 'data_change_requests.import_file_log_id';

    /**
     * the column name for the success_ids field
     */
    public const COL_SUCCESS_IDS = 'data_change_requests.success_ids';

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
        self::TYPE_PHPNAME       => ['DataChangeRequestId', 'ImportTemplate', 'ImportFilePath', 'RequestedData', 'ActionType', 'ScheduleDate', 'Status', 'HasError', 'ErrorMessage', 'CreatedAt', 'UpdatedAt', 'ImportFileLogId', 'SuccessIds', ],
        self::TYPE_CAMELNAME     => ['dataChangeRequestId', 'importTemplate', 'importFilePath', 'requestedData', 'actionType', 'scheduleDate', 'status', 'hasError', 'errorMessage', 'createdAt', 'updatedAt', 'importFileLogId', 'successIds', ],
        self::TYPE_COLNAME       => [DataChangeRequestsTableMap::COL_DATA_CHANGE_REQUEST_ID, DataChangeRequestsTableMap::COL_IMPORT_TEMPLATE, DataChangeRequestsTableMap::COL_IMPORT_FILE_PATH, DataChangeRequestsTableMap::COL_REQUESTED_DATA, DataChangeRequestsTableMap::COL_ACTION_TYPE, DataChangeRequestsTableMap::COL_SCHEDULE_DATE, DataChangeRequestsTableMap::COL_STATUS, DataChangeRequestsTableMap::COL_HAS_ERROR, DataChangeRequestsTableMap::COL_ERROR_MESSAGE, DataChangeRequestsTableMap::COL_CREATED_AT, DataChangeRequestsTableMap::COL_UPDATED_AT, DataChangeRequestsTableMap::COL_IMPORT_FILE_LOG_ID, DataChangeRequestsTableMap::COL_SUCCESS_IDS, ],
        self::TYPE_FIELDNAME     => ['data_change_request_id', 'import_template', 'import_file_path', 'requested_data', 'action_type', 'schedule_date', 'status', 'has_error', 'error_message', 'created_at', 'updated_at', 'import_file_log_id', 'success_ids', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
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
        self::TYPE_PHPNAME       => ['DataChangeRequestId' => 0, 'ImportTemplate' => 1, 'ImportFilePath' => 2, 'RequestedData' => 3, 'ActionType' => 4, 'ScheduleDate' => 5, 'Status' => 6, 'HasError' => 7, 'ErrorMessage' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, 'ImportFileLogId' => 11, 'SuccessIds' => 12, ],
        self::TYPE_CAMELNAME     => ['dataChangeRequestId' => 0, 'importTemplate' => 1, 'importFilePath' => 2, 'requestedData' => 3, 'actionType' => 4, 'scheduleDate' => 5, 'status' => 6, 'hasError' => 7, 'errorMessage' => 8, 'createdAt' => 9, 'updatedAt' => 10, 'importFileLogId' => 11, 'successIds' => 12, ],
        self::TYPE_COLNAME       => [DataChangeRequestsTableMap::COL_DATA_CHANGE_REQUEST_ID => 0, DataChangeRequestsTableMap::COL_IMPORT_TEMPLATE => 1, DataChangeRequestsTableMap::COL_IMPORT_FILE_PATH => 2, DataChangeRequestsTableMap::COL_REQUESTED_DATA => 3, DataChangeRequestsTableMap::COL_ACTION_TYPE => 4, DataChangeRequestsTableMap::COL_SCHEDULE_DATE => 5, DataChangeRequestsTableMap::COL_STATUS => 6, DataChangeRequestsTableMap::COL_HAS_ERROR => 7, DataChangeRequestsTableMap::COL_ERROR_MESSAGE => 8, DataChangeRequestsTableMap::COL_CREATED_AT => 9, DataChangeRequestsTableMap::COL_UPDATED_AT => 10, DataChangeRequestsTableMap::COL_IMPORT_FILE_LOG_ID => 11, DataChangeRequestsTableMap::COL_SUCCESS_IDS => 12, ],
        self::TYPE_FIELDNAME     => ['data_change_request_id' => 0, 'import_template' => 1, 'import_file_path' => 2, 'requested_data' => 3, 'action_type' => 4, 'schedule_date' => 5, 'status' => 6, 'has_error' => 7, 'error_message' => 8, 'created_at' => 9, 'updated_at' => 10, 'import_file_log_id' => 11, 'success_ids' => 12, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'DataChangeRequestId' => 'DATA_CHANGE_REQUEST_ID',
        'DataChangeRequests.DataChangeRequestId' => 'DATA_CHANGE_REQUEST_ID',
        'dataChangeRequestId' => 'DATA_CHANGE_REQUEST_ID',
        'dataChangeRequests.dataChangeRequestId' => 'DATA_CHANGE_REQUEST_ID',
        'DataChangeRequestsTableMap::COL_DATA_CHANGE_REQUEST_ID' => 'DATA_CHANGE_REQUEST_ID',
        'COL_DATA_CHANGE_REQUEST_ID' => 'DATA_CHANGE_REQUEST_ID',
        'data_change_request_id' => 'DATA_CHANGE_REQUEST_ID',
        'data_change_requests.data_change_request_id' => 'DATA_CHANGE_REQUEST_ID',
        'ImportTemplate' => 'IMPORT_TEMPLATE',
        'DataChangeRequests.ImportTemplate' => 'IMPORT_TEMPLATE',
        'importTemplate' => 'IMPORT_TEMPLATE',
        'dataChangeRequests.importTemplate' => 'IMPORT_TEMPLATE',
        'DataChangeRequestsTableMap::COL_IMPORT_TEMPLATE' => 'IMPORT_TEMPLATE',
        'COL_IMPORT_TEMPLATE' => 'IMPORT_TEMPLATE',
        'import_template' => 'IMPORT_TEMPLATE',
        'data_change_requests.import_template' => 'IMPORT_TEMPLATE',
        'ImportFilePath' => 'IMPORT_FILE_PATH',
        'DataChangeRequests.ImportFilePath' => 'IMPORT_FILE_PATH',
        'importFilePath' => 'IMPORT_FILE_PATH',
        'dataChangeRequests.importFilePath' => 'IMPORT_FILE_PATH',
        'DataChangeRequestsTableMap::COL_IMPORT_FILE_PATH' => 'IMPORT_FILE_PATH',
        'COL_IMPORT_FILE_PATH' => 'IMPORT_FILE_PATH',
        'import_file_path' => 'IMPORT_FILE_PATH',
        'data_change_requests.import_file_path' => 'IMPORT_FILE_PATH',
        'RequestedData' => 'REQUESTED_DATA',
        'DataChangeRequests.RequestedData' => 'REQUESTED_DATA',
        'requestedData' => 'REQUESTED_DATA',
        'dataChangeRequests.requestedData' => 'REQUESTED_DATA',
        'DataChangeRequestsTableMap::COL_REQUESTED_DATA' => 'REQUESTED_DATA',
        'COL_REQUESTED_DATA' => 'REQUESTED_DATA',
        'requested_data' => 'REQUESTED_DATA',
        'data_change_requests.requested_data' => 'REQUESTED_DATA',
        'ActionType' => 'ACTION_TYPE',
        'DataChangeRequests.ActionType' => 'ACTION_TYPE',
        'actionType' => 'ACTION_TYPE',
        'dataChangeRequests.actionType' => 'ACTION_TYPE',
        'DataChangeRequestsTableMap::COL_ACTION_TYPE' => 'ACTION_TYPE',
        'COL_ACTION_TYPE' => 'ACTION_TYPE',
        'action_type' => 'ACTION_TYPE',
        'data_change_requests.action_type' => 'ACTION_TYPE',
        'ScheduleDate' => 'SCHEDULE_DATE',
        'DataChangeRequests.ScheduleDate' => 'SCHEDULE_DATE',
        'scheduleDate' => 'SCHEDULE_DATE',
        'dataChangeRequests.scheduleDate' => 'SCHEDULE_DATE',
        'DataChangeRequestsTableMap::COL_SCHEDULE_DATE' => 'SCHEDULE_DATE',
        'COL_SCHEDULE_DATE' => 'SCHEDULE_DATE',
        'schedule_date' => 'SCHEDULE_DATE',
        'data_change_requests.schedule_date' => 'SCHEDULE_DATE',
        'Status' => 'STATUS',
        'DataChangeRequests.Status' => 'STATUS',
        'status' => 'STATUS',
        'dataChangeRequests.status' => 'STATUS',
        'DataChangeRequestsTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'data_change_requests.status' => 'STATUS',
        'HasError' => 'HAS_ERROR',
        'DataChangeRequests.HasError' => 'HAS_ERROR',
        'hasError' => 'HAS_ERROR',
        'dataChangeRequests.hasError' => 'HAS_ERROR',
        'DataChangeRequestsTableMap::COL_HAS_ERROR' => 'HAS_ERROR',
        'COL_HAS_ERROR' => 'HAS_ERROR',
        'has_error' => 'HAS_ERROR',
        'data_change_requests.has_error' => 'HAS_ERROR',
        'ErrorMessage' => 'ERROR_MESSAGE',
        'DataChangeRequests.ErrorMessage' => 'ERROR_MESSAGE',
        'errorMessage' => 'ERROR_MESSAGE',
        'dataChangeRequests.errorMessage' => 'ERROR_MESSAGE',
        'DataChangeRequestsTableMap::COL_ERROR_MESSAGE' => 'ERROR_MESSAGE',
        'COL_ERROR_MESSAGE' => 'ERROR_MESSAGE',
        'error_message' => 'ERROR_MESSAGE',
        'data_change_requests.error_message' => 'ERROR_MESSAGE',
        'CreatedAt' => 'CREATED_AT',
        'DataChangeRequests.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'dataChangeRequests.createdAt' => 'CREATED_AT',
        'DataChangeRequestsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'data_change_requests.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'DataChangeRequests.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'dataChangeRequests.updatedAt' => 'UPDATED_AT',
        'DataChangeRequestsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'data_change_requests.updated_at' => 'UPDATED_AT',
        'ImportFileLogId' => 'IMPORT_FILE_LOG_ID',
        'DataChangeRequests.ImportFileLogId' => 'IMPORT_FILE_LOG_ID',
        'importFileLogId' => 'IMPORT_FILE_LOG_ID',
        'dataChangeRequests.importFileLogId' => 'IMPORT_FILE_LOG_ID',
        'DataChangeRequestsTableMap::COL_IMPORT_FILE_LOG_ID' => 'IMPORT_FILE_LOG_ID',
        'COL_IMPORT_FILE_LOG_ID' => 'IMPORT_FILE_LOG_ID',
        'import_file_log_id' => 'IMPORT_FILE_LOG_ID',
        'data_change_requests.import_file_log_id' => 'IMPORT_FILE_LOG_ID',
        'SuccessIds' => 'SUCCESS_IDS',
        'DataChangeRequests.SuccessIds' => 'SUCCESS_IDS',
        'successIds' => 'SUCCESS_IDS',
        'dataChangeRequests.successIds' => 'SUCCESS_IDS',
        'DataChangeRequestsTableMap::COL_SUCCESS_IDS' => 'SUCCESS_IDS',
        'COL_SUCCESS_IDS' => 'SUCCESS_IDS',
        'success_ids' => 'SUCCESS_IDS',
        'data_change_requests.success_ids' => 'SUCCESS_IDS',
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
        $this->setName('data_change_requests');
        $this->setPhpName('DataChangeRequests');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\DataChangeRequests');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('data_change_requests_data_change_request_id_seq');
        // columns
        $this->addPrimaryKey('data_change_request_id', 'DataChangeRequestId', 'INTEGER', true, null, null);
        $this->addColumn('import_template', 'ImportTemplate', 'VARCHAR', false, 250, null);
        $this->addColumn('import_file_path', 'ImportFilePath', 'VARCHAR', false, 250, null);
        $this->addColumn('requested_data', 'RequestedData', 'JSON', true, null, null);
        $this->addColumn('action_type', 'ActionType', 'VARCHAR', true, 250, null);
        $this->addColumn('schedule_date', 'ScheduleDate', 'DATE', true, null, null);
        $this->addColumn('status', 'Status', 'VARCHAR', false, 250, null);
        $this->addColumn('has_error', 'HasError', 'BOOLEAN', false, 1, null);
        $this->addColumn('error_message', 'ErrorMessage', 'LONGVARCHAR', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('import_file_log_id', 'ImportFileLogId', 'INTEGER', false, null, null);
        $this->addColumn('success_ids', 'SuccessIds', 'JSON', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DataChangeRequestId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DataChangeRequestId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DataChangeRequestId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DataChangeRequestId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DataChangeRequestId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DataChangeRequestId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('DataChangeRequestId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? DataChangeRequestsTableMap::CLASS_DEFAULT : DataChangeRequestsTableMap::OM_CLASS;
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
     * @return array (DataChangeRequests object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = DataChangeRequestsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DataChangeRequestsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DataChangeRequestsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DataChangeRequestsTableMap::OM_CLASS;
            /** @var DataChangeRequests $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DataChangeRequestsTableMap::addInstanceToPool($obj, $key);
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
            $key = DataChangeRequestsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DataChangeRequestsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var DataChangeRequests $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DataChangeRequestsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(DataChangeRequestsTableMap::COL_DATA_CHANGE_REQUEST_ID);
            $criteria->addSelectColumn(DataChangeRequestsTableMap::COL_IMPORT_TEMPLATE);
            $criteria->addSelectColumn(DataChangeRequestsTableMap::COL_IMPORT_FILE_PATH);
            $criteria->addSelectColumn(DataChangeRequestsTableMap::COL_REQUESTED_DATA);
            $criteria->addSelectColumn(DataChangeRequestsTableMap::COL_ACTION_TYPE);
            $criteria->addSelectColumn(DataChangeRequestsTableMap::COL_SCHEDULE_DATE);
            $criteria->addSelectColumn(DataChangeRequestsTableMap::COL_STATUS);
            $criteria->addSelectColumn(DataChangeRequestsTableMap::COL_HAS_ERROR);
            $criteria->addSelectColumn(DataChangeRequestsTableMap::COL_ERROR_MESSAGE);
            $criteria->addSelectColumn(DataChangeRequestsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(DataChangeRequestsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(DataChangeRequestsTableMap::COL_IMPORT_FILE_LOG_ID);
            $criteria->addSelectColumn(DataChangeRequestsTableMap::COL_SUCCESS_IDS);
        } else {
            $criteria->addSelectColumn($alias . '.data_change_request_id');
            $criteria->addSelectColumn($alias . '.import_template');
            $criteria->addSelectColumn($alias . '.import_file_path');
            $criteria->addSelectColumn($alias . '.requested_data');
            $criteria->addSelectColumn($alias . '.action_type');
            $criteria->addSelectColumn($alias . '.schedule_date');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.has_error');
            $criteria->addSelectColumn($alias . '.error_message');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.import_file_log_id');
            $criteria->addSelectColumn($alias . '.success_ids');
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
            $criteria->removeSelectColumn(DataChangeRequestsTableMap::COL_DATA_CHANGE_REQUEST_ID);
            $criteria->removeSelectColumn(DataChangeRequestsTableMap::COL_IMPORT_TEMPLATE);
            $criteria->removeSelectColumn(DataChangeRequestsTableMap::COL_IMPORT_FILE_PATH);
            $criteria->removeSelectColumn(DataChangeRequestsTableMap::COL_REQUESTED_DATA);
            $criteria->removeSelectColumn(DataChangeRequestsTableMap::COL_ACTION_TYPE);
            $criteria->removeSelectColumn(DataChangeRequestsTableMap::COL_SCHEDULE_DATE);
            $criteria->removeSelectColumn(DataChangeRequestsTableMap::COL_STATUS);
            $criteria->removeSelectColumn(DataChangeRequestsTableMap::COL_HAS_ERROR);
            $criteria->removeSelectColumn(DataChangeRequestsTableMap::COL_ERROR_MESSAGE);
            $criteria->removeSelectColumn(DataChangeRequestsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(DataChangeRequestsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(DataChangeRequestsTableMap::COL_IMPORT_FILE_LOG_ID);
            $criteria->removeSelectColumn(DataChangeRequestsTableMap::COL_SUCCESS_IDS);
        } else {
            $criteria->removeSelectColumn($alias . '.data_change_request_id');
            $criteria->removeSelectColumn($alias . '.import_template');
            $criteria->removeSelectColumn($alias . '.import_file_path');
            $criteria->removeSelectColumn($alias . '.requested_data');
            $criteria->removeSelectColumn($alias . '.action_type');
            $criteria->removeSelectColumn($alias . '.schedule_date');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.has_error');
            $criteria->removeSelectColumn($alias . '.error_message');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.import_file_log_id');
            $criteria->removeSelectColumn($alias . '.success_ids');
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
        return Propel::getServiceContainer()->getDatabaseMap(DataChangeRequestsTableMap::DATABASE_NAME)->getTable(DataChangeRequestsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a DataChangeRequests or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or DataChangeRequests object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(DataChangeRequestsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\DataChangeRequests) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DataChangeRequestsTableMap::DATABASE_NAME);
            $criteria->add(DataChangeRequestsTableMap::COL_DATA_CHANGE_REQUEST_ID, (array) $values, Criteria::IN);
        }

        $query = DataChangeRequestsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            DataChangeRequestsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                DataChangeRequestsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the data_change_requests table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return DataChangeRequestsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a DataChangeRequests or Criteria object.
     *
     * @param mixed $criteria Criteria or DataChangeRequests object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DataChangeRequestsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from DataChangeRequests object
        }

        if ($criteria->containsKey(DataChangeRequestsTableMap::COL_DATA_CHANGE_REQUEST_ID) && $criteria->keyContainsValue(DataChangeRequestsTableMap::COL_DATA_CHANGE_REQUEST_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DataChangeRequestsTableMap::COL_DATA_CHANGE_REQUEST_ID.')');
        }


        // Set the correct dbName
        $query = DataChangeRequestsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
