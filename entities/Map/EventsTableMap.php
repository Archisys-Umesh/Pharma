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
use entities\Events;
use entities\EventsQuery;


/**
 * This class defines the structure of the 'events' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class EventsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.EventsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'events';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Events';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Events';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Events';

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
     * the column name for the event_id field
     */
    public const COL_EVENT_ID = 'events.event_id';

    /**
     * the column name for the event_date field
     */
    public const COL_EVENT_DATE = 'events.event_date';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'events.employee_id';

    /**
     * the column name for the event_type_id field
     */
    public const COL_EVENT_TYPE_ID = 'events.event_type_id';

    /**
     * the column name for the event_remark field
     */
    public const COL_EVENT_REMARK = 'events.event_remark';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'events.company_id';

    /**
     * the column name for the approver_emp_id field
     */
    public const COL_APPROVER_EMP_ID = 'events.approver_emp_id';

    /**
     * the column name for the event_status field
     */
    public const COL_EVENT_STATUS = 'events.event_status';

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
        self::TYPE_PHPNAME       => ['EventId', 'EventDate', 'EmployeeId', 'EventTypeId', 'EventRemark', 'CompanyId', 'ApproverEmpId', 'EventStatus', ],
        self::TYPE_CAMELNAME     => ['eventId', 'eventDate', 'employeeId', 'eventTypeId', 'eventRemark', 'companyId', 'approverEmpId', 'eventStatus', ],
        self::TYPE_COLNAME       => [EventsTableMap::COL_EVENT_ID, EventsTableMap::COL_EVENT_DATE, EventsTableMap::COL_EMPLOYEE_ID, EventsTableMap::COL_EVENT_TYPE_ID, EventsTableMap::COL_EVENT_REMARK, EventsTableMap::COL_COMPANY_ID, EventsTableMap::COL_APPROVER_EMP_ID, EventsTableMap::COL_EVENT_STATUS, ],
        self::TYPE_FIELDNAME     => ['event_id', 'event_date', 'employee_id', 'event_type_id', 'event_remark', 'company_id', 'approver_emp_id', 'event_status', ],
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
        self::TYPE_PHPNAME       => ['EventId' => 0, 'EventDate' => 1, 'EmployeeId' => 2, 'EventTypeId' => 3, 'EventRemark' => 4, 'CompanyId' => 5, 'ApproverEmpId' => 6, 'EventStatus' => 7, ],
        self::TYPE_CAMELNAME     => ['eventId' => 0, 'eventDate' => 1, 'employeeId' => 2, 'eventTypeId' => 3, 'eventRemark' => 4, 'companyId' => 5, 'approverEmpId' => 6, 'eventStatus' => 7, ],
        self::TYPE_COLNAME       => [EventsTableMap::COL_EVENT_ID => 0, EventsTableMap::COL_EVENT_DATE => 1, EventsTableMap::COL_EMPLOYEE_ID => 2, EventsTableMap::COL_EVENT_TYPE_ID => 3, EventsTableMap::COL_EVENT_REMARK => 4, EventsTableMap::COL_COMPANY_ID => 5, EventsTableMap::COL_APPROVER_EMP_ID => 6, EventsTableMap::COL_EVENT_STATUS => 7, ],
        self::TYPE_FIELDNAME     => ['event_id' => 0, 'event_date' => 1, 'employee_id' => 2, 'event_type_id' => 3, 'event_remark' => 4, 'company_id' => 5, 'approver_emp_id' => 6, 'event_status' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'EventId' => 'EVENT_ID',
        'Events.EventId' => 'EVENT_ID',
        'eventId' => 'EVENT_ID',
        'events.eventId' => 'EVENT_ID',
        'EventsTableMap::COL_EVENT_ID' => 'EVENT_ID',
        'COL_EVENT_ID' => 'EVENT_ID',
        'event_id' => 'EVENT_ID',
        'events.event_id' => 'EVENT_ID',
        'EventDate' => 'EVENT_DATE',
        'Events.EventDate' => 'EVENT_DATE',
        'eventDate' => 'EVENT_DATE',
        'events.eventDate' => 'EVENT_DATE',
        'EventsTableMap::COL_EVENT_DATE' => 'EVENT_DATE',
        'COL_EVENT_DATE' => 'EVENT_DATE',
        'event_date' => 'EVENT_DATE',
        'events.event_date' => 'EVENT_DATE',
        'EmployeeId' => 'EMPLOYEE_ID',
        'Events.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'events.employeeId' => 'EMPLOYEE_ID',
        'EventsTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'events.employee_id' => 'EMPLOYEE_ID',
        'EventTypeId' => 'EVENT_TYPE_ID',
        'Events.EventTypeId' => 'EVENT_TYPE_ID',
        'eventTypeId' => 'EVENT_TYPE_ID',
        'events.eventTypeId' => 'EVENT_TYPE_ID',
        'EventsTableMap::COL_EVENT_TYPE_ID' => 'EVENT_TYPE_ID',
        'COL_EVENT_TYPE_ID' => 'EVENT_TYPE_ID',
        'event_type_id' => 'EVENT_TYPE_ID',
        'events.event_type_id' => 'EVENT_TYPE_ID',
        'EventRemark' => 'EVENT_REMARK',
        'Events.EventRemark' => 'EVENT_REMARK',
        'eventRemark' => 'EVENT_REMARK',
        'events.eventRemark' => 'EVENT_REMARK',
        'EventsTableMap::COL_EVENT_REMARK' => 'EVENT_REMARK',
        'COL_EVENT_REMARK' => 'EVENT_REMARK',
        'event_remark' => 'EVENT_REMARK',
        'events.event_remark' => 'EVENT_REMARK',
        'CompanyId' => 'COMPANY_ID',
        'Events.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'events.companyId' => 'COMPANY_ID',
        'EventsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'events.company_id' => 'COMPANY_ID',
        'ApproverEmpId' => 'APPROVER_EMP_ID',
        'Events.ApproverEmpId' => 'APPROVER_EMP_ID',
        'approverEmpId' => 'APPROVER_EMP_ID',
        'events.approverEmpId' => 'APPROVER_EMP_ID',
        'EventsTableMap::COL_APPROVER_EMP_ID' => 'APPROVER_EMP_ID',
        'COL_APPROVER_EMP_ID' => 'APPROVER_EMP_ID',
        'approver_emp_id' => 'APPROVER_EMP_ID',
        'events.approver_emp_id' => 'APPROVER_EMP_ID',
        'EventStatus' => 'EVENT_STATUS',
        'Events.EventStatus' => 'EVENT_STATUS',
        'eventStatus' => 'EVENT_STATUS',
        'events.eventStatus' => 'EVENT_STATUS',
        'EventsTableMap::COL_EVENT_STATUS' => 'EVENT_STATUS',
        'COL_EVENT_STATUS' => 'EVENT_STATUS',
        'event_status' => 'EVENT_STATUS',
        'events.event_status' => 'EVENT_STATUS',
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
        $this->setName('events');
        $this->setPhpName('Events');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Events');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('events_event_id_seq');
        // columns
        $this->addPrimaryKey('event_id', 'EventId', 'INTEGER', true, null, null);
        $this->addColumn('event_date', 'EventDate', 'DATE', false, null, null);
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', false, null, null);
        $this->addForeignKey('event_type_id', 'EventTypeId', 'INTEGER', 'event_types', 'event_type_id', false, null, null);
        $this->addColumn('event_remark', 'EventRemark', 'LONGVARCHAR', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addForeignKey('approver_emp_id', 'ApproverEmpId', 'INTEGER', 'employee', 'employee_id', false, null, null);
        $this->addColumn('event_status', 'EventStatus', 'INTEGER', false, null, null);
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
), 'CASCADE', null, null, false);
        $this->addRelation('EmployeeRelatedByEmployeeId', '\\entities\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, null, false);
        $this->addRelation('EventTypes', '\\entities\\EventTypes', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':event_type_id',
    1 => ':event_type_id',
  ),
), null, null, null, false);
        $this->addRelation('EmployeeRelatedByApproverEmpId', '\\entities\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':approver_emp_id',
    1 => ':employee_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EventId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EventId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EventId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EventId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EventId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EventId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('EventId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? EventsTableMap::CLASS_DEFAULT : EventsTableMap::OM_CLASS;
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
     * @return array (Events object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = EventsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EventsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EventsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EventsTableMap::OM_CLASS;
            /** @var Events $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EventsTableMap::addInstanceToPool($obj, $key);
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
            $key = EventsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EventsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Events $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EventsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EventsTableMap::COL_EVENT_ID);
            $criteria->addSelectColumn(EventsTableMap::COL_EVENT_DATE);
            $criteria->addSelectColumn(EventsTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(EventsTableMap::COL_EVENT_TYPE_ID);
            $criteria->addSelectColumn(EventsTableMap::COL_EVENT_REMARK);
            $criteria->addSelectColumn(EventsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(EventsTableMap::COL_APPROVER_EMP_ID);
            $criteria->addSelectColumn(EventsTableMap::COL_EVENT_STATUS);
        } else {
            $criteria->addSelectColumn($alias . '.event_id');
            $criteria->addSelectColumn($alias . '.event_date');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.event_type_id');
            $criteria->addSelectColumn($alias . '.event_remark');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.approver_emp_id');
            $criteria->addSelectColumn($alias . '.event_status');
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
            $criteria->removeSelectColumn(EventsTableMap::COL_EVENT_ID);
            $criteria->removeSelectColumn(EventsTableMap::COL_EVENT_DATE);
            $criteria->removeSelectColumn(EventsTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(EventsTableMap::COL_EVENT_TYPE_ID);
            $criteria->removeSelectColumn(EventsTableMap::COL_EVENT_REMARK);
            $criteria->removeSelectColumn(EventsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(EventsTableMap::COL_APPROVER_EMP_ID);
            $criteria->removeSelectColumn(EventsTableMap::COL_EVENT_STATUS);
        } else {
            $criteria->removeSelectColumn($alias . '.event_id');
            $criteria->removeSelectColumn($alias . '.event_date');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.event_type_id');
            $criteria->removeSelectColumn($alias . '.event_remark');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.approver_emp_id');
            $criteria->removeSelectColumn($alias . '.event_status');
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
        return Propel::getServiceContainer()->getDatabaseMap(EventsTableMap::DATABASE_NAME)->getTable(EventsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Events or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Events object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EventsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Events) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EventsTableMap::DATABASE_NAME);
            $criteria->add(EventsTableMap::COL_EVENT_ID, (array) $values, Criteria::IN);
        }

        $query = EventsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EventsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EventsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the events table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return EventsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Events or Criteria object.
     *
     * @param mixed $criteria Criteria or Events object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EventsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Events object
        }

        if ($criteria->containsKey(EventsTableMap::COL_EVENT_ID) && $criteria->keyContainsValue(EventsTableMap::COL_EVENT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EventsTableMap::COL_EVENT_ID.')');
        }


        // Set the correct dbName
        $query = EventsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
