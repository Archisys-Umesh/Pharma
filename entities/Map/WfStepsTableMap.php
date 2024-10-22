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
use entities\WfSteps;
use entities\WfStepsQuery;


/**
 * This class defines the structure of the 'wf_steps' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class WfStepsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.WfStepsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'wf_steps';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'WfSteps';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\WfSteps';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.WfSteps';

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
     * the column name for the wf_steps_id field
     */
    public const COL_WF_STEPS_ID = 'wf_steps.wf_steps_id';

    /**
     * the column name for the wf_id field
     */
    public const COL_WF_ID = 'wf_steps.wf_id';

    /**
     * the column name for the wf_in_status field
     */
    public const COL_WF_IN_STATUS = 'wf_steps.wf_in_status';

    /**
     * the column name for the request_up field
     */
    public const COL_REQUEST_UP = 'wf_steps.request_up';

    /**
     * the column name for the wf_out_status field
     */
    public const COL_WF_OUT_STATUS = 'wf_steps.wf_out_status';

    /**
     * the column name for the wf_request_desc field
     */
    public const COL_WF_REQUEST_DESC = 'wf_steps.wf_request_desc';

    /**
     * the column name for the wf_step_level field
     */
    public const COL_WF_STEP_LEVEL = 'wf_steps.wf_step_level';

    /**
     * the column name for the wf_btn_desc field
     */
    public const COL_WF_BTN_DESC = 'wf_steps.wf_btn_desc';

    /**
     * the column name for the notification_status field
     */
    public const COL_NOTIFICATION_STATUS = 'wf_steps.notification_status';

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
        self::TYPE_PHPNAME       => ['WfStepsId', 'WfId', 'WfInStatus', 'RequestUp', 'WfOutStatus', 'WfRequestDesc', 'WfStepLevel', 'WfBtnDesc', 'NotificationStatus', ],
        self::TYPE_CAMELNAME     => ['wfStepsId', 'wfId', 'wfInStatus', 'requestUp', 'wfOutStatus', 'wfRequestDesc', 'wfStepLevel', 'wfBtnDesc', 'notificationStatus', ],
        self::TYPE_COLNAME       => [WfStepsTableMap::COL_WF_STEPS_ID, WfStepsTableMap::COL_WF_ID, WfStepsTableMap::COL_WF_IN_STATUS, WfStepsTableMap::COL_REQUEST_UP, WfStepsTableMap::COL_WF_OUT_STATUS, WfStepsTableMap::COL_WF_REQUEST_DESC, WfStepsTableMap::COL_WF_STEP_LEVEL, WfStepsTableMap::COL_WF_BTN_DESC, WfStepsTableMap::COL_NOTIFICATION_STATUS, ],
        self::TYPE_FIELDNAME     => ['wf_steps_id', 'wf_id', 'wf_in_status', 'request_up', 'wf_out_status', 'wf_request_desc', 'wf_step_level', 'wf_btn_desc', 'notification_status', ],
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
        self::TYPE_PHPNAME       => ['WfStepsId' => 0, 'WfId' => 1, 'WfInStatus' => 2, 'RequestUp' => 3, 'WfOutStatus' => 4, 'WfRequestDesc' => 5, 'WfStepLevel' => 6, 'WfBtnDesc' => 7, 'NotificationStatus' => 8, ],
        self::TYPE_CAMELNAME     => ['wfStepsId' => 0, 'wfId' => 1, 'wfInStatus' => 2, 'requestUp' => 3, 'wfOutStatus' => 4, 'wfRequestDesc' => 5, 'wfStepLevel' => 6, 'wfBtnDesc' => 7, 'notificationStatus' => 8, ],
        self::TYPE_COLNAME       => [WfStepsTableMap::COL_WF_STEPS_ID => 0, WfStepsTableMap::COL_WF_ID => 1, WfStepsTableMap::COL_WF_IN_STATUS => 2, WfStepsTableMap::COL_REQUEST_UP => 3, WfStepsTableMap::COL_WF_OUT_STATUS => 4, WfStepsTableMap::COL_WF_REQUEST_DESC => 5, WfStepsTableMap::COL_WF_STEP_LEVEL => 6, WfStepsTableMap::COL_WF_BTN_DESC => 7, WfStepsTableMap::COL_NOTIFICATION_STATUS => 8, ],
        self::TYPE_FIELDNAME     => ['wf_steps_id' => 0, 'wf_id' => 1, 'wf_in_status' => 2, 'request_up' => 3, 'wf_out_status' => 4, 'wf_request_desc' => 5, 'wf_step_level' => 6, 'wf_btn_desc' => 7, 'notification_status' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'WfStepsId' => 'WF_STEPS_ID',
        'WfSteps.WfStepsId' => 'WF_STEPS_ID',
        'wfStepsId' => 'WF_STEPS_ID',
        'wfSteps.wfStepsId' => 'WF_STEPS_ID',
        'WfStepsTableMap::COL_WF_STEPS_ID' => 'WF_STEPS_ID',
        'COL_WF_STEPS_ID' => 'WF_STEPS_ID',
        'wf_steps_id' => 'WF_STEPS_ID',
        'wf_steps.wf_steps_id' => 'WF_STEPS_ID',
        'WfId' => 'WF_ID',
        'WfSteps.WfId' => 'WF_ID',
        'wfId' => 'WF_ID',
        'wfSteps.wfId' => 'WF_ID',
        'WfStepsTableMap::COL_WF_ID' => 'WF_ID',
        'COL_WF_ID' => 'WF_ID',
        'wf_id' => 'WF_ID',
        'wf_steps.wf_id' => 'WF_ID',
        'WfInStatus' => 'WF_IN_STATUS',
        'WfSteps.WfInStatus' => 'WF_IN_STATUS',
        'wfInStatus' => 'WF_IN_STATUS',
        'wfSteps.wfInStatus' => 'WF_IN_STATUS',
        'WfStepsTableMap::COL_WF_IN_STATUS' => 'WF_IN_STATUS',
        'COL_WF_IN_STATUS' => 'WF_IN_STATUS',
        'wf_in_status' => 'WF_IN_STATUS',
        'wf_steps.wf_in_status' => 'WF_IN_STATUS',
        'RequestUp' => 'REQUEST_UP',
        'WfSteps.RequestUp' => 'REQUEST_UP',
        'requestUp' => 'REQUEST_UP',
        'wfSteps.requestUp' => 'REQUEST_UP',
        'WfStepsTableMap::COL_REQUEST_UP' => 'REQUEST_UP',
        'COL_REQUEST_UP' => 'REQUEST_UP',
        'request_up' => 'REQUEST_UP',
        'wf_steps.request_up' => 'REQUEST_UP',
        'WfOutStatus' => 'WF_OUT_STATUS',
        'WfSteps.WfOutStatus' => 'WF_OUT_STATUS',
        'wfOutStatus' => 'WF_OUT_STATUS',
        'wfSteps.wfOutStatus' => 'WF_OUT_STATUS',
        'WfStepsTableMap::COL_WF_OUT_STATUS' => 'WF_OUT_STATUS',
        'COL_WF_OUT_STATUS' => 'WF_OUT_STATUS',
        'wf_out_status' => 'WF_OUT_STATUS',
        'wf_steps.wf_out_status' => 'WF_OUT_STATUS',
        'WfRequestDesc' => 'WF_REQUEST_DESC',
        'WfSteps.WfRequestDesc' => 'WF_REQUEST_DESC',
        'wfRequestDesc' => 'WF_REQUEST_DESC',
        'wfSteps.wfRequestDesc' => 'WF_REQUEST_DESC',
        'WfStepsTableMap::COL_WF_REQUEST_DESC' => 'WF_REQUEST_DESC',
        'COL_WF_REQUEST_DESC' => 'WF_REQUEST_DESC',
        'wf_request_desc' => 'WF_REQUEST_DESC',
        'wf_steps.wf_request_desc' => 'WF_REQUEST_DESC',
        'WfStepLevel' => 'WF_STEP_LEVEL',
        'WfSteps.WfStepLevel' => 'WF_STEP_LEVEL',
        'wfStepLevel' => 'WF_STEP_LEVEL',
        'wfSteps.wfStepLevel' => 'WF_STEP_LEVEL',
        'WfStepsTableMap::COL_WF_STEP_LEVEL' => 'WF_STEP_LEVEL',
        'COL_WF_STEP_LEVEL' => 'WF_STEP_LEVEL',
        'wf_step_level' => 'WF_STEP_LEVEL',
        'wf_steps.wf_step_level' => 'WF_STEP_LEVEL',
        'WfBtnDesc' => 'WF_BTN_DESC',
        'WfSteps.WfBtnDesc' => 'WF_BTN_DESC',
        'wfBtnDesc' => 'WF_BTN_DESC',
        'wfSteps.wfBtnDesc' => 'WF_BTN_DESC',
        'WfStepsTableMap::COL_WF_BTN_DESC' => 'WF_BTN_DESC',
        'COL_WF_BTN_DESC' => 'WF_BTN_DESC',
        'wf_btn_desc' => 'WF_BTN_DESC',
        'wf_steps.wf_btn_desc' => 'WF_BTN_DESC',
        'NotificationStatus' => 'NOTIFICATION_STATUS',
        'WfSteps.NotificationStatus' => 'NOTIFICATION_STATUS',
        'notificationStatus' => 'NOTIFICATION_STATUS',
        'wfSteps.notificationStatus' => 'NOTIFICATION_STATUS',
        'WfStepsTableMap::COL_NOTIFICATION_STATUS' => 'NOTIFICATION_STATUS',
        'COL_NOTIFICATION_STATUS' => 'NOTIFICATION_STATUS',
        'notification_status' => 'NOTIFICATION_STATUS',
        'wf_steps.notification_status' => 'NOTIFICATION_STATUS',
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
        $this->setName('wf_steps');
        $this->setPhpName('WfSteps');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\WfSteps');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('wf_steps_wf_steps_id_seq');
        // columns
        $this->addPrimaryKey('wf_steps_id', 'WfStepsId', 'INTEGER', true, null, null);
        $this->addForeignKey('wf_id', 'WfId', 'INTEGER', 'wf_master', 'wf_id', true, null, 0);
        $this->addColumn('wf_in_status', 'WfInStatus', 'VARCHAR', true, 50, '0');
        $this->addColumn('request_up', 'RequestUp', 'SMALLINT', true, null, 0);
        $this->addColumn('wf_out_status', 'WfOutStatus', 'VARCHAR', true, 50, '0');
        $this->addColumn('wf_request_desc', 'WfRequestDesc', 'VARCHAR', true, 50, '0');
        $this->addColumn('wf_step_level', 'WfStepLevel', 'VARCHAR', true, 50, null);
        $this->addColumn('wf_btn_desc', 'WfBtnDesc', 'VARCHAR', true, 50, null);
        $this->addColumn('notification_status', 'NotificationStatus', 'INTEGER', true, null, 1);
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
        $this->addRelation('WfRequests', '\\entities\\WfRequests', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':wf_step_id',
    1 => ':wf_steps_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WfStepsId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WfStepsId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WfStepsId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WfStepsId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WfStepsId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('WfStepsId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('WfStepsId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? WfStepsTableMap::CLASS_DEFAULT : WfStepsTableMap::OM_CLASS;
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
     * @return array (WfSteps object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = WfStepsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = WfStepsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + WfStepsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = WfStepsTableMap::OM_CLASS;
            /** @var WfSteps $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            WfStepsTableMap::addInstanceToPool($obj, $key);
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
            $key = WfStepsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = WfStepsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var WfSteps $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                WfStepsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(WfStepsTableMap::COL_WF_STEPS_ID);
            $criteria->addSelectColumn(WfStepsTableMap::COL_WF_ID);
            $criteria->addSelectColumn(WfStepsTableMap::COL_WF_IN_STATUS);
            $criteria->addSelectColumn(WfStepsTableMap::COL_REQUEST_UP);
            $criteria->addSelectColumn(WfStepsTableMap::COL_WF_OUT_STATUS);
            $criteria->addSelectColumn(WfStepsTableMap::COL_WF_REQUEST_DESC);
            $criteria->addSelectColumn(WfStepsTableMap::COL_WF_STEP_LEVEL);
            $criteria->addSelectColumn(WfStepsTableMap::COL_WF_BTN_DESC);
            $criteria->addSelectColumn(WfStepsTableMap::COL_NOTIFICATION_STATUS);
        } else {
            $criteria->addSelectColumn($alias . '.wf_steps_id');
            $criteria->addSelectColumn($alias . '.wf_id');
            $criteria->addSelectColumn($alias . '.wf_in_status');
            $criteria->addSelectColumn($alias . '.request_up');
            $criteria->addSelectColumn($alias . '.wf_out_status');
            $criteria->addSelectColumn($alias . '.wf_request_desc');
            $criteria->addSelectColumn($alias . '.wf_step_level');
            $criteria->addSelectColumn($alias . '.wf_btn_desc');
            $criteria->addSelectColumn($alias . '.notification_status');
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
            $criteria->removeSelectColumn(WfStepsTableMap::COL_WF_STEPS_ID);
            $criteria->removeSelectColumn(WfStepsTableMap::COL_WF_ID);
            $criteria->removeSelectColumn(WfStepsTableMap::COL_WF_IN_STATUS);
            $criteria->removeSelectColumn(WfStepsTableMap::COL_REQUEST_UP);
            $criteria->removeSelectColumn(WfStepsTableMap::COL_WF_OUT_STATUS);
            $criteria->removeSelectColumn(WfStepsTableMap::COL_WF_REQUEST_DESC);
            $criteria->removeSelectColumn(WfStepsTableMap::COL_WF_STEP_LEVEL);
            $criteria->removeSelectColumn(WfStepsTableMap::COL_WF_BTN_DESC);
            $criteria->removeSelectColumn(WfStepsTableMap::COL_NOTIFICATION_STATUS);
        } else {
            $criteria->removeSelectColumn($alias . '.wf_steps_id');
            $criteria->removeSelectColumn($alias . '.wf_id');
            $criteria->removeSelectColumn($alias . '.wf_in_status');
            $criteria->removeSelectColumn($alias . '.request_up');
            $criteria->removeSelectColumn($alias . '.wf_out_status');
            $criteria->removeSelectColumn($alias . '.wf_request_desc');
            $criteria->removeSelectColumn($alias . '.wf_step_level');
            $criteria->removeSelectColumn($alias . '.wf_btn_desc');
            $criteria->removeSelectColumn($alias . '.notification_status');
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
        return Propel::getServiceContainer()->getDatabaseMap(WfStepsTableMap::DATABASE_NAME)->getTable(WfStepsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a WfSteps or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or WfSteps object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(WfStepsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\WfSteps) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(WfStepsTableMap::DATABASE_NAME);
            $criteria->add(WfStepsTableMap::COL_WF_STEPS_ID, (array) $values, Criteria::IN);
        }

        $query = WfStepsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            WfStepsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                WfStepsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the wf_steps table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return WfStepsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a WfSteps or Criteria object.
     *
     * @param mixed $criteria Criteria or WfSteps object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WfStepsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from WfSteps object
        }

        if ($criteria->containsKey(WfStepsTableMap::COL_WF_STEPS_ID) && $criteria->keyContainsValue(WfStepsTableMap::COL_WF_STEPS_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.WfStepsTableMap::COL_WF_STEPS_ID.')');
        }


        // Set the correct dbName
        $query = WfStepsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
