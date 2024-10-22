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
use entities\WfLog;
use entities\WfLogQuery;


/**
 * This class defines the structure of the 'wf_log' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class WfLogTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.WfLogTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'wf_log';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'WfLog';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\WfLog';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.WfLog';

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
     * the column name for the wf_log_id field
     */
    public const COL_WF_LOG_ID = 'wf_log.wf_log_id';

    /**
     * the column name for the wf_doc_id field
     */
    public const COL_WF_DOC_ID = 'wf_log.wf_doc_id';

    /**
     * the column name for the wf_doc_pk field
     */
    public const COL_WF_DOC_PK = 'wf_log.wf_doc_pk';

    /**
     * the column name for the wf_status_id field
     */
    public const COL_WF_STATUS_ID = 'wf_log.wf_status_id';

    /**
     * the column name for the wf_old_status_id field
     */
    public const COL_WF_OLD_STATUS_ID = 'wf_log.wf_old_status_id';

    /**
     * the column name for the wf_level field
     */
    public const COL_WF_LEVEL = 'wf_log.wf_level';

    /**
     * the column name for the wf_employee_id field
     */
    public const COL_WF_EMPLOYEE_ID = 'wf_log.wf_employee_id';

    /**
     * the column name for the wf_title field
     */
    public const COL_WF_TITLE = 'wf_log.wf_title';

    /**
     * the column name for the wf_note field
     */
    public const COL_WF_NOTE = 'wf_log.wf_note';

    /**
     * the column name for the wf_request_id field
     */
    public const COL_WF_REQUEST_ID = 'wf_log.wf_request_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'wf_log.created_at';

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
        self::TYPE_PHPNAME       => ['WfLogId', 'WfDocId', 'WfDocPk', 'WfStatusId', 'WfOldStatusId', 'WfLevel', 'WfEmployeeId', 'WfTitle', 'WfNote', 'WfRequestId', 'CreatedAt', ],
        self::TYPE_CAMELNAME     => ['wfLogId', 'wfDocId', 'wfDocPk', 'wfStatusId', 'wfOldStatusId', 'wfLevel', 'wfEmployeeId', 'wfTitle', 'wfNote', 'wfRequestId', 'createdAt', ],
        self::TYPE_COLNAME       => [WfLogTableMap::COL_WF_LOG_ID, WfLogTableMap::COL_WF_DOC_ID, WfLogTableMap::COL_WF_DOC_PK, WfLogTableMap::COL_WF_STATUS_ID, WfLogTableMap::COL_WF_OLD_STATUS_ID, WfLogTableMap::COL_WF_LEVEL, WfLogTableMap::COL_WF_EMPLOYEE_ID, WfLogTableMap::COL_WF_TITLE, WfLogTableMap::COL_WF_NOTE, WfLogTableMap::COL_WF_REQUEST_ID, WfLogTableMap::COL_CREATED_AT, ],
        self::TYPE_FIELDNAME     => ['wf_log_id', 'wf_doc_id', 'wf_doc_pk', 'wf_status_id', 'wf_old_status_id', 'wf_level', 'wf_employee_id', 'wf_title', 'wf_note', 'wf_request_id', 'created_at', ],
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
        self::TYPE_PHPNAME       => ['WfLogId' => 0, 'WfDocId' => 1, 'WfDocPk' => 2, 'WfStatusId' => 3, 'WfOldStatusId' => 4, 'WfLevel' => 5, 'WfEmployeeId' => 6, 'WfTitle' => 7, 'WfNote' => 8, 'WfRequestId' => 9, 'CreatedAt' => 10, ],
        self::TYPE_CAMELNAME     => ['wfLogId' => 0, 'wfDocId' => 1, 'wfDocPk' => 2, 'wfStatusId' => 3, 'wfOldStatusId' => 4, 'wfLevel' => 5, 'wfEmployeeId' => 6, 'wfTitle' => 7, 'wfNote' => 8, 'wfRequestId' => 9, 'createdAt' => 10, ],
        self::TYPE_COLNAME       => [WfLogTableMap::COL_WF_LOG_ID => 0, WfLogTableMap::COL_WF_DOC_ID => 1, WfLogTableMap::COL_WF_DOC_PK => 2, WfLogTableMap::COL_WF_STATUS_ID => 3, WfLogTableMap::COL_WF_OLD_STATUS_ID => 4, WfLogTableMap::COL_WF_LEVEL => 5, WfLogTableMap::COL_WF_EMPLOYEE_ID => 6, WfLogTableMap::COL_WF_TITLE => 7, WfLogTableMap::COL_WF_NOTE => 8, WfLogTableMap::COL_WF_REQUEST_ID => 9, WfLogTableMap::COL_CREATED_AT => 10, ],
        self::TYPE_FIELDNAME     => ['wf_log_id' => 0, 'wf_doc_id' => 1, 'wf_doc_pk' => 2, 'wf_status_id' => 3, 'wf_old_status_id' => 4, 'wf_level' => 5, 'wf_employee_id' => 6, 'wf_title' => 7, 'wf_note' => 8, 'wf_request_id' => 9, 'created_at' => 10, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'WfLogId' => 'WF_LOG_ID',
        'WfLog.WfLogId' => 'WF_LOG_ID',
        'wfLogId' => 'WF_LOG_ID',
        'wfLog.wfLogId' => 'WF_LOG_ID',
        'WfLogTableMap::COL_WF_LOG_ID' => 'WF_LOG_ID',
        'COL_WF_LOG_ID' => 'WF_LOG_ID',
        'wf_log_id' => 'WF_LOG_ID',
        'wf_log.wf_log_id' => 'WF_LOG_ID',
        'WfDocId' => 'WF_DOC_ID',
        'WfLog.WfDocId' => 'WF_DOC_ID',
        'wfDocId' => 'WF_DOC_ID',
        'wfLog.wfDocId' => 'WF_DOC_ID',
        'WfLogTableMap::COL_WF_DOC_ID' => 'WF_DOC_ID',
        'COL_WF_DOC_ID' => 'WF_DOC_ID',
        'wf_doc_id' => 'WF_DOC_ID',
        'wf_log.wf_doc_id' => 'WF_DOC_ID',
        'WfDocPk' => 'WF_DOC_PK',
        'WfLog.WfDocPk' => 'WF_DOC_PK',
        'wfDocPk' => 'WF_DOC_PK',
        'wfLog.wfDocPk' => 'WF_DOC_PK',
        'WfLogTableMap::COL_WF_DOC_PK' => 'WF_DOC_PK',
        'COL_WF_DOC_PK' => 'WF_DOC_PK',
        'wf_doc_pk' => 'WF_DOC_PK',
        'wf_log.wf_doc_pk' => 'WF_DOC_PK',
        'WfStatusId' => 'WF_STATUS_ID',
        'WfLog.WfStatusId' => 'WF_STATUS_ID',
        'wfStatusId' => 'WF_STATUS_ID',
        'wfLog.wfStatusId' => 'WF_STATUS_ID',
        'WfLogTableMap::COL_WF_STATUS_ID' => 'WF_STATUS_ID',
        'COL_WF_STATUS_ID' => 'WF_STATUS_ID',
        'wf_status_id' => 'WF_STATUS_ID',
        'wf_log.wf_status_id' => 'WF_STATUS_ID',
        'WfOldStatusId' => 'WF_OLD_STATUS_ID',
        'WfLog.WfOldStatusId' => 'WF_OLD_STATUS_ID',
        'wfOldStatusId' => 'WF_OLD_STATUS_ID',
        'wfLog.wfOldStatusId' => 'WF_OLD_STATUS_ID',
        'WfLogTableMap::COL_WF_OLD_STATUS_ID' => 'WF_OLD_STATUS_ID',
        'COL_WF_OLD_STATUS_ID' => 'WF_OLD_STATUS_ID',
        'wf_old_status_id' => 'WF_OLD_STATUS_ID',
        'wf_log.wf_old_status_id' => 'WF_OLD_STATUS_ID',
        'WfLevel' => 'WF_LEVEL',
        'WfLog.WfLevel' => 'WF_LEVEL',
        'wfLevel' => 'WF_LEVEL',
        'wfLog.wfLevel' => 'WF_LEVEL',
        'WfLogTableMap::COL_WF_LEVEL' => 'WF_LEVEL',
        'COL_WF_LEVEL' => 'WF_LEVEL',
        'wf_level' => 'WF_LEVEL',
        'wf_log.wf_level' => 'WF_LEVEL',
        'WfEmployeeId' => 'WF_EMPLOYEE_ID',
        'WfLog.WfEmployeeId' => 'WF_EMPLOYEE_ID',
        'wfEmployeeId' => 'WF_EMPLOYEE_ID',
        'wfLog.wfEmployeeId' => 'WF_EMPLOYEE_ID',
        'WfLogTableMap::COL_WF_EMPLOYEE_ID' => 'WF_EMPLOYEE_ID',
        'COL_WF_EMPLOYEE_ID' => 'WF_EMPLOYEE_ID',
        'wf_employee_id' => 'WF_EMPLOYEE_ID',
        'wf_log.wf_employee_id' => 'WF_EMPLOYEE_ID',
        'WfTitle' => 'WF_TITLE',
        'WfLog.WfTitle' => 'WF_TITLE',
        'wfTitle' => 'WF_TITLE',
        'wfLog.wfTitle' => 'WF_TITLE',
        'WfLogTableMap::COL_WF_TITLE' => 'WF_TITLE',
        'COL_WF_TITLE' => 'WF_TITLE',
        'wf_title' => 'WF_TITLE',
        'wf_log.wf_title' => 'WF_TITLE',
        'WfNote' => 'WF_NOTE',
        'WfLog.WfNote' => 'WF_NOTE',
        'wfNote' => 'WF_NOTE',
        'wfLog.wfNote' => 'WF_NOTE',
        'WfLogTableMap::COL_WF_NOTE' => 'WF_NOTE',
        'COL_WF_NOTE' => 'WF_NOTE',
        'wf_note' => 'WF_NOTE',
        'wf_log.wf_note' => 'WF_NOTE',
        'WfRequestId' => 'WF_REQUEST_ID',
        'WfLog.WfRequestId' => 'WF_REQUEST_ID',
        'wfRequestId' => 'WF_REQUEST_ID',
        'wfLog.wfRequestId' => 'WF_REQUEST_ID',
        'WfLogTableMap::COL_WF_REQUEST_ID' => 'WF_REQUEST_ID',
        'COL_WF_REQUEST_ID' => 'WF_REQUEST_ID',
        'wf_request_id' => 'WF_REQUEST_ID',
        'wf_log.wf_request_id' => 'WF_REQUEST_ID',
        'CreatedAt' => 'CREATED_AT',
        'WfLog.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'wfLog.createdAt' => 'CREATED_AT',
        'WfLogTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'wf_log.created_at' => 'CREATED_AT',
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
        $this->setName('wf_log');
        $this->setPhpName('WfLog');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\WfLog');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('wf_log_wf_log_id_seq');
        // columns
        $this->addPrimaryKey('wf_log_id', 'WfLogId', 'INTEGER', true, null, null);
        $this->addForeignKey('wf_doc_id', 'WfDocId', 'INTEGER', 'wf_documents', 'wf_doc_id', true, null, 0);
        $this->addColumn('wf_doc_pk', 'WfDocPk', 'INTEGER', true, null, 0);
        $this->addColumn('wf_status_id', 'WfStatusId', 'INTEGER', true, null, null);
        $this->addColumn('wf_old_status_id', 'WfOldStatusId', 'INTEGER', true, null, null);
        $this->addColumn('wf_level', 'WfLevel', 'INTEGER', true, null, 0);
        $this->addForeignKey('wf_employee_id', 'WfEmployeeId', 'INTEGER', 'employee', 'employee_id', true, null, 0);
        $this->addColumn('wf_title', 'WfTitle', 'VARCHAR', false, 100, '');
        $this->addColumn('wf_note', 'WfNote', 'LONGVARCHAR', false, null, '');
        $this->addColumn('wf_request_id', 'WfRequestId', 'INTEGER', true, null, 0);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
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
    0 => ':wf_employee_id',
    1 => ':employee_id',
  ),
), null, null, null, false);
        $this->addRelation('WfDocuments', '\\entities\\WfDocuments', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':wf_doc_id',
    1 => ':wf_doc_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WfLogId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WfLogId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WfLogId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WfLogId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WfLogId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WfLogId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('WfLogId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? WfLogTableMap::CLASS_DEFAULT : WfLogTableMap::OM_CLASS;
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
     * @return array (WfLog object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = WfLogTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = WfLogTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + WfLogTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = WfLogTableMap::OM_CLASS;
            /** @var WfLog $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            WfLogTableMap::addInstanceToPool($obj, $key);
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
            $key = WfLogTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = WfLogTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var WfLog $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                WfLogTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(WfLogTableMap::COL_WF_LOG_ID);
            $criteria->addSelectColumn(WfLogTableMap::COL_WF_DOC_ID);
            $criteria->addSelectColumn(WfLogTableMap::COL_WF_DOC_PK);
            $criteria->addSelectColumn(WfLogTableMap::COL_WF_STATUS_ID);
            $criteria->addSelectColumn(WfLogTableMap::COL_WF_OLD_STATUS_ID);
            $criteria->addSelectColumn(WfLogTableMap::COL_WF_LEVEL);
            $criteria->addSelectColumn(WfLogTableMap::COL_WF_EMPLOYEE_ID);
            $criteria->addSelectColumn(WfLogTableMap::COL_WF_TITLE);
            $criteria->addSelectColumn(WfLogTableMap::COL_WF_NOTE);
            $criteria->addSelectColumn(WfLogTableMap::COL_WF_REQUEST_ID);
            $criteria->addSelectColumn(WfLogTableMap::COL_CREATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.wf_log_id');
            $criteria->addSelectColumn($alias . '.wf_doc_id');
            $criteria->addSelectColumn($alias . '.wf_doc_pk');
            $criteria->addSelectColumn($alias . '.wf_status_id');
            $criteria->addSelectColumn($alias . '.wf_old_status_id');
            $criteria->addSelectColumn($alias . '.wf_level');
            $criteria->addSelectColumn($alias . '.wf_employee_id');
            $criteria->addSelectColumn($alias . '.wf_title');
            $criteria->addSelectColumn($alias . '.wf_note');
            $criteria->addSelectColumn($alias . '.wf_request_id');
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
            $criteria->removeSelectColumn(WfLogTableMap::COL_WF_LOG_ID);
            $criteria->removeSelectColumn(WfLogTableMap::COL_WF_DOC_ID);
            $criteria->removeSelectColumn(WfLogTableMap::COL_WF_DOC_PK);
            $criteria->removeSelectColumn(WfLogTableMap::COL_WF_STATUS_ID);
            $criteria->removeSelectColumn(WfLogTableMap::COL_WF_OLD_STATUS_ID);
            $criteria->removeSelectColumn(WfLogTableMap::COL_WF_LEVEL);
            $criteria->removeSelectColumn(WfLogTableMap::COL_WF_EMPLOYEE_ID);
            $criteria->removeSelectColumn(WfLogTableMap::COL_WF_TITLE);
            $criteria->removeSelectColumn(WfLogTableMap::COL_WF_NOTE);
            $criteria->removeSelectColumn(WfLogTableMap::COL_WF_REQUEST_ID);
            $criteria->removeSelectColumn(WfLogTableMap::COL_CREATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.wf_log_id');
            $criteria->removeSelectColumn($alias . '.wf_doc_id');
            $criteria->removeSelectColumn($alias . '.wf_doc_pk');
            $criteria->removeSelectColumn($alias . '.wf_status_id');
            $criteria->removeSelectColumn($alias . '.wf_old_status_id');
            $criteria->removeSelectColumn($alias . '.wf_level');
            $criteria->removeSelectColumn($alias . '.wf_employee_id');
            $criteria->removeSelectColumn($alias . '.wf_title');
            $criteria->removeSelectColumn($alias . '.wf_note');
            $criteria->removeSelectColumn($alias . '.wf_request_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(WfLogTableMap::DATABASE_NAME)->getTable(WfLogTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a WfLog or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or WfLog object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(WfLogTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\WfLog) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(WfLogTableMap::DATABASE_NAME);
            $criteria->add(WfLogTableMap::COL_WF_LOG_ID, (array) $values, Criteria::IN);
        }

        $query = WfLogQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            WfLogTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                WfLogTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the wf_log table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return WfLogQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a WfLog or Criteria object.
     *
     * @param mixed $criteria Criteria or WfLog object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WfLogTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from WfLog object
        }

        if ($criteria->containsKey(WfLogTableMap::COL_WF_LOG_ID) && $criteria->keyContainsValue(WfLogTableMap::COL_WF_LOG_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.WfLogTableMap::COL_WF_LOG_ID.')');
        }


        // Set the correct dbName
        $query = WfLogQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
