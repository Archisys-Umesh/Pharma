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
use entities\WfDocuments;
use entities\WfDocumentsQuery;


/**
 * This class defines the structure of the 'wf_documents' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class WfDocumentsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.WfDocumentsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'wf_documents';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'WfDocuments';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\WfDocuments';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.WfDocuments';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the wf_doc_id field
     */
    public const COL_WF_DOC_ID = 'wf_documents.wf_doc_id';

    /**
     * the column name for the wf_id field
     */
    public const COL_WF_ID = 'wf_documents.wf_id';

    /**
     * the column name for the wf_doc_name field
     */
    public const COL_WF_DOC_NAME = 'wf_documents.wf_doc_name';

    /**
     * the column name for the wf_entity_name field
     */
    public const COL_WF_ENTITY_NAME = 'wf_documents.wf_entity_name';

    /**
     * the column name for the wf_pk_name field
     */
    public const COL_WF_PK_NAME = 'wf_documents.wf_pk_name';

    /**
     * the column name for the wf_action_route field
     */
    public const COL_WF_ACTION_ROUTE = 'wf_documents.wf_action_route';

    /**
     * the column name for the wf_url_pk field
     */
    public const COL_WF_URL_PK = 'wf_documents.wf_url_pk';

    /**
     * the column name for the wf_steps_route field
     */
    public const COL_WF_STEPS_ROUTE = 'wf_documents.wf_steps_route';

    /**
     * the column name for the wf_status_key field
     */
    public const COL_WF_STATUS_KEY = 'wf_documents.wf_status_key';

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
        self::TYPE_PHPNAME       => ['WfDocId', 'WfId', 'WfDocName', 'WfEntityName', 'WfPkName', 'WfActionRoute', 'WfUrlPk', 'WfStepsRoute', 'WfStatusKey', ],
        self::TYPE_CAMELNAME     => ['wfDocId', 'wfId', 'wfDocName', 'wfEntityName', 'wfPkName', 'wfActionRoute', 'wfUrlPk', 'wfStepsRoute', 'wfStatusKey', ],
        self::TYPE_COLNAME       => [WfDocumentsTableMap::COL_WF_DOC_ID, WfDocumentsTableMap::COL_WF_ID, WfDocumentsTableMap::COL_WF_DOC_NAME, WfDocumentsTableMap::COL_WF_ENTITY_NAME, WfDocumentsTableMap::COL_WF_PK_NAME, WfDocumentsTableMap::COL_WF_ACTION_ROUTE, WfDocumentsTableMap::COL_WF_URL_PK, WfDocumentsTableMap::COL_WF_STEPS_ROUTE, WfDocumentsTableMap::COL_WF_STATUS_KEY, ],
        self::TYPE_FIELDNAME     => ['wf_doc_id', 'wf_id', 'wf_doc_name', 'wf_entity_name', 'wf_pk_name', 'wf_action_route', 'wf_url_pk', 'wf_steps_route', 'wf_status_key', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
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
        self::TYPE_PHPNAME       => ['WfDocId' => 0, 'WfId' => 1, 'WfDocName' => 2, 'WfEntityName' => 3, 'WfPkName' => 4, 'WfActionRoute' => 5, 'WfUrlPk' => 6, 'WfStepsRoute' => 7, 'WfStatusKey' => 8, ],
        self::TYPE_CAMELNAME     => ['wfDocId' => 0, 'wfId' => 1, 'wfDocName' => 2, 'wfEntityName' => 3, 'wfPkName' => 4, 'wfActionRoute' => 5, 'wfUrlPk' => 6, 'wfStepsRoute' => 7, 'wfStatusKey' => 8, ],
        self::TYPE_COLNAME       => [WfDocumentsTableMap::COL_WF_DOC_ID => 0, WfDocumentsTableMap::COL_WF_ID => 1, WfDocumentsTableMap::COL_WF_DOC_NAME => 2, WfDocumentsTableMap::COL_WF_ENTITY_NAME => 3, WfDocumentsTableMap::COL_WF_PK_NAME => 4, WfDocumentsTableMap::COL_WF_ACTION_ROUTE => 5, WfDocumentsTableMap::COL_WF_URL_PK => 6, WfDocumentsTableMap::COL_WF_STEPS_ROUTE => 7, WfDocumentsTableMap::COL_WF_STATUS_KEY => 8, ],
        self::TYPE_FIELDNAME     => ['wf_doc_id' => 0, 'wf_id' => 1, 'wf_doc_name' => 2, 'wf_entity_name' => 3, 'wf_pk_name' => 4, 'wf_action_route' => 5, 'wf_url_pk' => 6, 'wf_steps_route' => 7, 'wf_status_key' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'WfDocId' => 'WF_DOC_ID',
        'WfDocuments.WfDocId' => 'WF_DOC_ID',
        'wfDocId' => 'WF_DOC_ID',
        'wfDocuments.wfDocId' => 'WF_DOC_ID',
        'WfDocumentsTableMap::COL_WF_DOC_ID' => 'WF_DOC_ID',
        'COL_WF_DOC_ID' => 'WF_DOC_ID',
        'wf_doc_id' => 'WF_DOC_ID',
        'wf_documents.wf_doc_id' => 'WF_DOC_ID',
        'WfId' => 'WF_ID',
        'WfDocuments.WfId' => 'WF_ID',
        'wfId' => 'WF_ID',
        'wfDocuments.wfId' => 'WF_ID',
        'WfDocumentsTableMap::COL_WF_ID' => 'WF_ID',
        'COL_WF_ID' => 'WF_ID',
        'wf_id' => 'WF_ID',
        'wf_documents.wf_id' => 'WF_ID',
        'WfDocName' => 'WF_DOC_NAME',
        'WfDocuments.WfDocName' => 'WF_DOC_NAME',
        'wfDocName' => 'WF_DOC_NAME',
        'wfDocuments.wfDocName' => 'WF_DOC_NAME',
        'WfDocumentsTableMap::COL_WF_DOC_NAME' => 'WF_DOC_NAME',
        'COL_WF_DOC_NAME' => 'WF_DOC_NAME',
        'wf_doc_name' => 'WF_DOC_NAME',
        'wf_documents.wf_doc_name' => 'WF_DOC_NAME',
        'WfEntityName' => 'WF_ENTITY_NAME',
        'WfDocuments.WfEntityName' => 'WF_ENTITY_NAME',
        'wfEntityName' => 'WF_ENTITY_NAME',
        'wfDocuments.wfEntityName' => 'WF_ENTITY_NAME',
        'WfDocumentsTableMap::COL_WF_ENTITY_NAME' => 'WF_ENTITY_NAME',
        'COL_WF_ENTITY_NAME' => 'WF_ENTITY_NAME',
        'wf_entity_name' => 'WF_ENTITY_NAME',
        'wf_documents.wf_entity_name' => 'WF_ENTITY_NAME',
        'WfPkName' => 'WF_PK_NAME',
        'WfDocuments.WfPkName' => 'WF_PK_NAME',
        'wfPkName' => 'WF_PK_NAME',
        'wfDocuments.wfPkName' => 'WF_PK_NAME',
        'WfDocumentsTableMap::COL_WF_PK_NAME' => 'WF_PK_NAME',
        'COL_WF_PK_NAME' => 'WF_PK_NAME',
        'wf_pk_name' => 'WF_PK_NAME',
        'wf_documents.wf_pk_name' => 'WF_PK_NAME',
        'WfActionRoute' => 'WF_ACTION_ROUTE',
        'WfDocuments.WfActionRoute' => 'WF_ACTION_ROUTE',
        'wfActionRoute' => 'WF_ACTION_ROUTE',
        'wfDocuments.wfActionRoute' => 'WF_ACTION_ROUTE',
        'WfDocumentsTableMap::COL_WF_ACTION_ROUTE' => 'WF_ACTION_ROUTE',
        'COL_WF_ACTION_ROUTE' => 'WF_ACTION_ROUTE',
        'wf_action_route' => 'WF_ACTION_ROUTE',
        'wf_documents.wf_action_route' => 'WF_ACTION_ROUTE',
        'WfUrlPk' => 'WF_URL_PK',
        'WfDocuments.WfUrlPk' => 'WF_URL_PK',
        'wfUrlPk' => 'WF_URL_PK',
        'wfDocuments.wfUrlPk' => 'WF_URL_PK',
        'WfDocumentsTableMap::COL_WF_URL_PK' => 'WF_URL_PK',
        'COL_WF_URL_PK' => 'WF_URL_PK',
        'wf_url_pk' => 'WF_URL_PK',
        'wf_documents.wf_url_pk' => 'WF_URL_PK',
        'WfStepsRoute' => 'WF_STEPS_ROUTE',
        'WfDocuments.WfStepsRoute' => 'WF_STEPS_ROUTE',
        'wfStepsRoute' => 'WF_STEPS_ROUTE',
        'wfDocuments.wfStepsRoute' => 'WF_STEPS_ROUTE',
        'WfDocumentsTableMap::COL_WF_STEPS_ROUTE' => 'WF_STEPS_ROUTE',
        'COL_WF_STEPS_ROUTE' => 'WF_STEPS_ROUTE',
        'wf_steps_route' => 'WF_STEPS_ROUTE',
        'wf_documents.wf_steps_route' => 'WF_STEPS_ROUTE',
        'WfStatusKey' => 'WF_STATUS_KEY',
        'WfDocuments.WfStatusKey' => 'WF_STATUS_KEY',
        'wfStatusKey' => 'WF_STATUS_KEY',
        'wfDocuments.wfStatusKey' => 'WF_STATUS_KEY',
        'WfDocumentsTableMap::COL_WF_STATUS_KEY' => 'WF_STATUS_KEY',
        'COL_WF_STATUS_KEY' => 'WF_STATUS_KEY',
        'wf_status_key' => 'WF_STATUS_KEY',
        'wf_documents.wf_status_key' => 'WF_STATUS_KEY',
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
        $this->setName('wf_documents');
        $this->setPhpName('WfDocuments');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\WfDocuments');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('wf_documents_wf_doc_id_seq');
        // columns
        $this->addPrimaryKey('wf_doc_id', 'WfDocId', 'INTEGER', true, null, null);
        $this->addForeignKey('wf_id', 'WfId', 'INTEGER', 'wf_master', 'wf_id', true, null, 0);
        $this->addColumn('wf_doc_name', 'WfDocName', 'VARCHAR', true, 50, null);
        $this->addColumn('wf_entity_name', 'WfEntityName', 'VARCHAR', true, 50, null);
        $this->addColumn('wf_pk_name', 'WfPkName', 'VARCHAR', true, 50, null);
        $this->addColumn('wf_action_route', 'WfActionRoute', 'VARCHAR', true, 50, null);
        $this->addColumn('wf_url_pk', 'WfUrlPk', 'SMALLINT', true, null, 0);
        $this->addColumn('wf_steps_route', 'WfStepsRoute', 'VARCHAR', true, 50, null);
        $this->addColumn('wf_status_key', 'WfStatusKey', 'VARCHAR', true, 50, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('WfMaster', '\\entities\\WfMaster', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':wf_id',
    1 => ':wf_id',
  ),
), null, null, null, false);
        $this->addRelation('WfLog', '\\entities\\WfLog', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':wf_doc_id',
    1 => ':wf_doc_id',
  ),
), null, null, 'WfLogs', false);
        $this->addRelation('WfRequests', '\\entities\\WfRequests', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':wf_doc_id',
    1 => ':wf_doc_id',
  ),
), null, null, 'WfRequestss', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WfDocId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WfDocId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WfDocId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WfDocId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WfDocId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WfDocId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('WfDocId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? WfDocumentsTableMap::CLASS_DEFAULT : WfDocumentsTableMap::OM_CLASS;
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
     * @return array (WfDocuments object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = WfDocumentsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = WfDocumentsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + WfDocumentsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = WfDocumentsTableMap::OM_CLASS;
            /** @var WfDocuments $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            WfDocumentsTableMap::addInstanceToPool($obj, $key);
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
            $key = WfDocumentsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = WfDocumentsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var WfDocuments $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                WfDocumentsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(WfDocumentsTableMap::COL_WF_DOC_ID);
            $criteria->addSelectColumn(WfDocumentsTableMap::COL_WF_ID);
            $criteria->addSelectColumn(WfDocumentsTableMap::COL_WF_DOC_NAME);
            $criteria->addSelectColumn(WfDocumentsTableMap::COL_WF_ENTITY_NAME);
            $criteria->addSelectColumn(WfDocumentsTableMap::COL_WF_PK_NAME);
            $criteria->addSelectColumn(WfDocumentsTableMap::COL_WF_ACTION_ROUTE);
            $criteria->addSelectColumn(WfDocumentsTableMap::COL_WF_URL_PK);
            $criteria->addSelectColumn(WfDocumentsTableMap::COL_WF_STEPS_ROUTE);
            $criteria->addSelectColumn(WfDocumentsTableMap::COL_WF_STATUS_KEY);
        } else {
            $criteria->addSelectColumn($alias . '.wf_doc_id');
            $criteria->addSelectColumn($alias . '.wf_id');
            $criteria->addSelectColumn($alias . '.wf_doc_name');
            $criteria->addSelectColumn($alias . '.wf_entity_name');
            $criteria->addSelectColumn($alias . '.wf_pk_name');
            $criteria->addSelectColumn($alias . '.wf_action_route');
            $criteria->addSelectColumn($alias . '.wf_url_pk');
            $criteria->addSelectColumn($alias . '.wf_steps_route');
            $criteria->addSelectColumn($alias . '.wf_status_key');
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
            $criteria->removeSelectColumn(WfDocumentsTableMap::COL_WF_DOC_ID);
            $criteria->removeSelectColumn(WfDocumentsTableMap::COL_WF_ID);
            $criteria->removeSelectColumn(WfDocumentsTableMap::COL_WF_DOC_NAME);
            $criteria->removeSelectColumn(WfDocumentsTableMap::COL_WF_ENTITY_NAME);
            $criteria->removeSelectColumn(WfDocumentsTableMap::COL_WF_PK_NAME);
            $criteria->removeSelectColumn(WfDocumentsTableMap::COL_WF_ACTION_ROUTE);
            $criteria->removeSelectColumn(WfDocumentsTableMap::COL_WF_URL_PK);
            $criteria->removeSelectColumn(WfDocumentsTableMap::COL_WF_STEPS_ROUTE);
            $criteria->removeSelectColumn(WfDocumentsTableMap::COL_WF_STATUS_KEY);
        } else {
            $criteria->removeSelectColumn($alias . '.wf_doc_id');
            $criteria->removeSelectColumn($alias . '.wf_id');
            $criteria->removeSelectColumn($alias . '.wf_doc_name');
            $criteria->removeSelectColumn($alias . '.wf_entity_name');
            $criteria->removeSelectColumn($alias . '.wf_pk_name');
            $criteria->removeSelectColumn($alias . '.wf_action_route');
            $criteria->removeSelectColumn($alias . '.wf_url_pk');
            $criteria->removeSelectColumn($alias . '.wf_steps_route');
            $criteria->removeSelectColumn($alias . '.wf_status_key');
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
        return Propel::getServiceContainer()->getDatabaseMap(WfDocumentsTableMap::DATABASE_NAME)->getTable(WfDocumentsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a WfDocuments or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or WfDocuments object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(WfDocumentsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\WfDocuments) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(WfDocumentsTableMap::DATABASE_NAME);
            $criteria->add(WfDocumentsTableMap::COL_WF_DOC_ID, (array) $values, Criteria::IN);
        }

        $query = WfDocumentsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            WfDocumentsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                WfDocumentsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the wf_documents table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return WfDocumentsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a WfDocuments or Criteria object.
     *
     * @param mixed $criteria Criteria or WfDocuments object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WfDocumentsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from WfDocuments object
        }

        if ($criteria->containsKey(WfDocumentsTableMap::COL_WF_DOC_ID) && $criteria->keyContainsValue(WfDocumentsTableMap::COL_WF_DOC_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.WfDocumentsTableMap::COL_WF_DOC_ID.')');
        }


        // Set the correct dbName
        $query = WfDocumentsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
