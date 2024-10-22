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
use entities\Reminders;
use entities\RemindersQuery;


/**
 * This class defines the structure of the 'reminders' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class RemindersTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.RemindersTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'reminders';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Reminders';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Reminders';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Reminders';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the reminder_id field
     */
    public const COL_REMINDER_ID = 'reminders.reminder_id';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'reminders.employee_id';

    /**
     * the column name for the outlet_org_id field
     */
    public const COL_OUTLET_ORG_ID = 'reminders.outlet_org_id';

    /**
     * the column name for the reminder_type field
     */
    public const COL_REMINDER_TYPE = 'reminders.reminder_type';

    /**
     * the column name for the reminder_date field
     */
    public const COL_REMINDER_DATE = 'reminders.reminder_date';

    /**
     * the column name for the reminder_note field
     */
    public const COL_REMINDER_NOTE = 'reminders.reminder_note';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'reminders.company_id';

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
        self::TYPE_PHPNAME       => ['ReminderId', 'EmployeeId', 'OutletOrgId', 'ReminderType', 'ReminderDate', 'ReminderNote', 'CompanyId', ],
        self::TYPE_CAMELNAME     => ['reminderId', 'employeeId', 'outletOrgId', 'reminderType', 'reminderDate', 'reminderNote', 'companyId', ],
        self::TYPE_COLNAME       => [RemindersTableMap::COL_REMINDER_ID, RemindersTableMap::COL_EMPLOYEE_ID, RemindersTableMap::COL_OUTLET_ORG_ID, RemindersTableMap::COL_REMINDER_TYPE, RemindersTableMap::COL_REMINDER_DATE, RemindersTableMap::COL_REMINDER_NOTE, RemindersTableMap::COL_COMPANY_ID, ],
        self::TYPE_FIELDNAME     => ['reminder_id', 'employee_id', 'outlet_org_id', 'reminder_type', 'reminder_date', 'reminder_note', 'company_id', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
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
        self::TYPE_PHPNAME       => ['ReminderId' => 0, 'EmployeeId' => 1, 'OutletOrgId' => 2, 'ReminderType' => 3, 'ReminderDate' => 4, 'ReminderNote' => 5, 'CompanyId' => 6, ],
        self::TYPE_CAMELNAME     => ['reminderId' => 0, 'employeeId' => 1, 'outletOrgId' => 2, 'reminderType' => 3, 'reminderDate' => 4, 'reminderNote' => 5, 'companyId' => 6, ],
        self::TYPE_COLNAME       => [RemindersTableMap::COL_REMINDER_ID => 0, RemindersTableMap::COL_EMPLOYEE_ID => 1, RemindersTableMap::COL_OUTLET_ORG_ID => 2, RemindersTableMap::COL_REMINDER_TYPE => 3, RemindersTableMap::COL_REMINDER_DATE => 4, RemindersTableMap::COL_REMINDER_NOTE => 5, RemindersTableMap::COL_COMPANY_ID => 6, ],
        self::TYPE_FIELDNAME     => ['reminder_id' => 0, 'employee_id' => 1, 'outlet_org_id' => 2, 'reminder_type' => 3, 'reminder_date' => 4, 'reminder_note' => 5, 'company_id' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'ReminderId' => 'REMINDER_ID',
        'Reminders.ReminderId' => 'REMINDER_ID',
        'reminderId' => 'REMINDER_ID',
        'reminders.reminderId' => 'REMINDER_ID',
        'RemindersTableMap::COL_REMINDER_ID' => 'REMINDER_ID',
        'COL_REMINDER_ID' => 'REMINDER_ID',
        'reminder_id' => 'REMINDER_ID',
        'reminders.reminder_id' => 'REMINDER_ID',
        'EmployeeId' => 'EMPLOYEE_ID',
        'Reminders.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'reminders.employeeId' => 'EMPLOYEE_ID',
        'RemindersTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'reminders.employee_id' => 'EMPLOYEE_ID',
        'OutletOrgId' => 'OUTLET_ORG_ID',
        'Reminders.OutletOrgId' => 'OUTLET_ORG_ID',
        'outletOrgId' => 'OUTLET_ORG_ID',
        'reminders.outletOrgId' => 'OUTLET_ORG_ID',
        'RemindersTableMap::COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'outlet_org_id' => 'OUTLET_ORG_ID',
        'reminders.outlet_org_id' => 'OUTLET_ORG_ID',
        'ReminderType' => 'REMINDER_TYPE',
        'Reminders.ReminderType' => 'REMINDER_TYPE',
        'reminderType' => 'REMINDER_TYPE',
        'reminders.reminderType' => 'REMINDER_TYPE',
        'RemindersTableMap::COL_REMINDER_TYPE' => 'REMINDER_TYPE',
        'COL_REMINDER_TYPE' => 'REMINDER_TYPE',
        'reminder_type' => 'REMINDER_TYPE',
        'reminders.reminder_type' => 'REMINDER_TYPE',
        'ReminderDate' => 'REMINDER_DATE',
        'Reminders.ReminderDate' => 'REMINDER_DATE',
        'reminderDate' => 'REMINDER_DATE',
        'reminders.reminderDate' => 'REMINDER_DATE',
        'RemindersTableMap::COL_REMINDER_DATE' => 'REMINDER_DATE',
        'COL_REMINDER_DATE' => 'REMINDER_DATE',
        'reminder_date' => 'REMINDER_DATE',
        'reminders.reminder_date' => 'REMINDER_DATE',
        'ReminderNote' => 'REMINDER_NOTE',
        'Reminders.ReminderNote' => 'REMINDER_NOTE',
        'reminderNote' => 'REMINDER_NOTE',
        'reminders.reminderNote' => 'REMINDER_NOTE',
        'RemindersTableMap::COL_REMINDER_NOTE' => 'REMINDER_NOTE',
        'COL_REMINDER_NOTE' => 'REMINDER_NOTE',
        'reminder_note' => 'REMINDER_NOTE',
        'reminders.reminder_note' => 'REMINDER_NOTE',
        'CompanyId' => 'COMPANY_ID',
        'Reminders.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'reminders.companyId' => 'COMPANY_ID',
        'RemindersTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'reminders.company_id' => 'COMPANY_ID',
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
        $this->setName('reminders');
        $this->setPhpName('Reminders');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Reminders');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('reminders_reminder_id_seq');
        // columns
        $this->addPrimaryKey('reminder_id', 'ReminderId', 'INTEGER', true, null, null);
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', true, null, 0);
        $this->addForeignKey('outlet_org_id', 'OutletOrgId', 'INTEGER', 'outlet_org_data', 'outlet_org_id', true, null, 0);
        $this->addColumn('reminder_type', 'ReminderType', 'VARCHAR', true, 50, null);
        $this->addColumn('reminder_date', 'ReminderDate', 'DATE', true, null, null);
        $this->addColumn('reminder_note', 'ReminderNote', 'VARCHAR', true, 300, '');
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
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
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, null, false);
        $this->addRelation('OutletOrgData', '\\entities\\OutletOrgData', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_org_id',
    1 => ':outlet_org_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ReminderId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ReminderId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ReminderId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ReminderId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ReminderId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ReminderId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('ReminderId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? RemindersTableMap::CLASS_DEFAULT : RemindersTableMap::OM_CLASS;
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
     * @return array (Reminders object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = RemindersTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = RemindersTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + RemindersTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = RemindersTableMap::OM_CLASS;
            /** @var Reminders $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            RemindersTableMap::addInstanceToPool($obj, $key);
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
            $key = RemindersTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = RemindersTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Reminders $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                RemindersTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(RemindersTableMap::COL_REMINDER_ID);
            $criteria->addSelectColumn(RemindersTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(RemindersTableMap::COL_OUTLET_ORG_ID);
            $criteria->addSelectColumn(RemindersTableMap::COL_REMINDER_TYPE);
            $criteria->addSelectColumn(RemindersTableMap::COL_REMINDER_DATE);
            $criteria->addSelectColumn(RemindersTableMap::COL_REMINDER_NOTE);
            $criteria->addSelectColumn(RemindersTableMap::COL_COMPANY_ID);
        } else {
            $criteria->addSelectColumn($alias . '.reminder_id');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.outlet_org_id');
            $criteria->addSelectColumn($alias . '.reminder_type');
            $criteria->addSelectColumn($alias . '.reminder_date');
            $criteria->addSelectColumn($alias . '.reminder_note');
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
            $criteria->removeSelectColumn(RemindersTableMap::COL_REMINDER_ID);
            $criteria->removeSelectColumn(RemindersTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(RemindersTableMap::COL_OUTLET_ORG_ID);
            $criteria->removeSelectColumn(RemindersTableMap::COL_REMINDER_TYPE);
            $criteria->removeSelectColumn(RemindersTableMap::COL_REMINDER_DATE);
            $criteria->removeSelectColumn(RemindersTableMap::COL_REMINDER_NOTE);
            $criteria->removeSelectColumn(RemindersTableMap::COL_COMPANY_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.reminder_id');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.outlet_org_id');
            $criteria->removeSelectColumn($alias . '.reminder_type');
            $criteria->removeSelectColumn($alias . '.reminder_date');
            $criteria->removeSelectColumn($alias . '.reminder_note');
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
        return Propel::getServiceContainer()->getDatabaseMap(RemindersTableMap::DATABASE_NAME)->getTable(RemindersTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Reminders or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Reminders object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(RemindersTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Reminders) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(RemindersTableMap::DATABASE_NAME);
            $criteria->add(RemindersTableMap::COL_REMINDER_ID, (array) $values, Criteria::IN);
        }

        $query = RemindersQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            RemindersTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                RemindersTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the reminders table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return RemindersQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Reminders or Criteria object.
     *
     * @param mixed $criteria Criteria or Reminders object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RemindersTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Reminders object
        }

        if ($criteria->containsKey(RemindersTableMap::COL_REMINDER_ID) && $criteria->keyContainsValue(RemindersTableMap::COL_REMINDER_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.RemindersTableMap::COL_REMINDER_ID.')');
        }


        // Set the correct dbName
        $query = RemindersQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
