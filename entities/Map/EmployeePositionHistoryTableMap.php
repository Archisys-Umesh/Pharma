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
use entities\EmployeePositionHistory;
use entities\EmployeePositionHistoryQuery;


/**
 * This class defines the structure of the 'employee_position_history' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class EmployeePositionHistoryTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.EmployeePositionHistoryTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'employee_position_history';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'EmployeePositionHistory';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\EmployeePositionHistory';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.EmployeePositionHistory';

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
     * the column name for the employee_position_history_id field
     */
    public const COL_EMPLOYEE_POSITION_HISTORY_ID = 'employee_position_history.employee_position_history_id';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'employee_position_history.employee_id';

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'employee_position_history.position_id';

    /**
     * the column name for the from_date field
     */
    public const COL_FROM_DATE = 'employee_position_history.from_date';

    /**
     * the column name for the to_date field
     */
    public const COL_TO_DATE = 'employee_position_history.to_date';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'employee_position_history.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'employee_position_history.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'employee_position_history.updated_at';

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
        self::TYPE_PHPNAME       => ['EmployeePositionHistoryId', 'EmployeeId', 'PositionId', 'FromDate', 'ToDate', 'CompanyId', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['employeePositionHistoryId', 'employeeId', 'positionId', 'fromDate', 'toDate', 'companyId', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [EmployeePositionHistoryTableMap::COL_EMPLOYEE_POSITION_HISTORY_ID, EmployeePositionHistoryTableMap::COL_EMPLOYEE_ID, EmployeePositionHistoryTableMap::COL_POSITION_ID, EmployeePositionHistoryTableMap::COL_FROM_DATE, EmployeePositionHistoryTableMap::COL_TO_DATE, EmployeePositionHistoryTableMap::COL_COMPANY_ID, EmployeePositionHistoryTableMap::COL_CREATED_AT, EmployeePositionHistoryTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['employee_position_history_id', 'employee_id', 'position_id', 'from_date', 'to_date', 'company_id', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['EmployeePositionHistoryId' => 0, 'EmployeeId' => 1, 'PositionId' => 2, 'FromDate' => 3, 'ToDate' => 4, 'CompanyId' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['employeePositionHistoryId' => 0, 'employeeId' => 1, 'positionId' => 2, 'fromDate' => 3, 'toDate' => 4, 'companyId' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [EmployeePositionHistoryTableMap::COL_EMPLOYEE_POSITION_HISTORY_ID => 0, EmployeePositionHistoryTableMap::COL_EMPLOYEE_ID => 1, EmployeePositionHistoryTableMap::COL_POSITION_ID => 2, EmployeePositionHistoryTableMap::COL_FROM_DATE => 3, EmployeePositionHistoryTableMap::COL_TO_DATE => 4, EmployeePositionHistoryTableMap::COL_COMPANY_ID => 5, EmployeePositionHistoryTableMap::COL_CREATED_AT => 6, EmployeePositionHistoryTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['employee_position_history_id' => 0, 'employee_id' => 1, 'position_id' => 2, 'from_date' => 3, 'to_date' => 4, 'company_id' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'EmployeePositionHistoryId' => 'EMPLOYEE_POSITION_HISTORY_ID',
        'EmployeePositionHistory.EmployeePositionHistoryId' => 'EMPLOYEE_POSITION_HISTORY_ID',
        'employeePositionHistoryId' => 'EMPLOYEE_POSITION_HISTORY_ID',
        'employeePositionHistory.employeePositionHistoryId' => 'EMPLOYEE_POSITION_HISTORY_ID',
        'EmployeePositionHistoryTableMap::COL_EMPLOYEE_POSITION_HISTORY_ID' => 'EMPLOYEE_POSITION_HISTORY_ID',
        'COL_EMPLOYEE_POSITION_HISTORY_ID' => 'EMPLOYEE_POSITION_HISTORY_ID',
        'employee_position_history_id' => 'EMPLOYEE_POSITION_HISTORY_ID',
        'employee_position_history.employee_position_history_id' => 'EMPLOYEE_POSITION_HISTORY_ID',
        'EmployeeId' => 'EMPLOYEE_ID',
        'EmployeePositionHistory.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'employeePositionHistory.employeeId' => 'EMPLOYEE_ID',
        'EmployeePositionHistoryTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'employee_position_history.employee_id' => 'EMPLOYEE_ID',
        'PositionId' => 'POSITION_ID',
        'EmployeePositionHistory.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'employeePositionHistory.positionId' => 'POSITION_ID',
        'EmployeePositionHistoryTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'employee_position_history.position_id' => 'POSITION_ID',
        'FromDate' => 'FROM_DATE',
        'EmployeePositionHistory.FromDate' => 'FROM_DATE',
        'fromDate' => 'FROM_DATE',
        'employeePositionHistory.fromDate' => 'FROM_DATE',
        'EmployeePositionHistoryTableMap::COL_FROM_DATE' => 'FROM_DATE',
        'COL_FROM_DATE' => 'FROM_DATE',
        'from_date' => 'FROM_DATE',
        'employee_position_history.from_date' => 'FROM_DATE',
        'ToDate' => 'TO_DATE',
        'EmployeePositionHistory.ToDate' => 'TO_DATE',
        'toDate' => 'TO_DATE',
        'employeePositionHistory.toDate' => 'TO_DATE',
        'EmployeePositionHistoryTableMap::COL_TO_DATE' => 'TO_DATE',
        'COL_TO_DATE' => 'TO_DATE',
        'to_date' => 'TO_DATE',
        'employee_position_history.to_date' => 'TO_DATE',
        'CompanyId' => 'COMPANY_ID',
        'EmployeePositionHistory.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'employeePositionHistory.companyId' => 'COMPANY_ID',
        'EmployeePositionHistoryTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'employee_position_history.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'EmployeePositionHistory.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'employeePositionHistory.createdAt' => 'CREATED_AT',
        'EmployeePositionHistoryTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'employee_position_history.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'EmployeePositionHistory.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'employeePositionHistory.updatedAt' => 'UPDATED_AT',
        'EmployeePositionHistoryTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'employee_position_history.updated_at' => 'UPDATED_AT',
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
        $this->setName('employee_position_history');
        $this->setPhpName('EmployeePositionHistory');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\EmployeePositionHistory');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('employee_position_history_employee_position_history_id_seq');
        // columns
        $this->addPrimaryKey('employee_position_history_id', 'EmployeePositionHistoryId', 'INTEGER', true, null, null);
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', true, null, null);
        $this->addForeignKey('position_id', 'PositionId', 'INTEGER', 'positions', 'position_id', true, null, null);
        $this->addColumn('from_date', 'FromDate', 'DATE', true, null, null);
        $this->addColumn('to_date', 'ToDate', 'DATE', false, null, null);
        $this->addColumn('company_id', 'CompanyId', 'INTEGER', true, null, null);
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
    0 => ':position_id',
    1 => ':position_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmployeePositionHistoryId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmployeePositionHistoryId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmployeePositionHistoryId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmployeePositionHistoryId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmployeePositionHistoryId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmployeePositionHistoryId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('EmployeePositionHistoryId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? EmployeePositionHistoryTableMap::CLASS_DEFAULT : EmployeePositionHistoryTableMap::OM_CLASS;
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
     * @return array (EmployeePositionHistory object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = EmployeePositionHistoryTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EmployeePositionHistoryTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EmployeePositionHistoryTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EmployeePositionHistoryTableMap::OM_CLASS;
            /** @var EmployeePositionHistory $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EmployeePositionHistoryTableMap::addInstanceToPool($obj, $key);
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
            $key = EmployeePositionHistoryTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EmployeePositionHistoryTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var EmployeePositionHistory $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EmployeePositionHistoryTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EmployeePositionHistoryTableMap::COL_EMPLOYEE_POSITION_HISTORY_ID);
            $criteria->addSelectColumn(EmployeePositionHistoryTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(EmployeePositionHistoryTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(EmployeePositionHistoryTableMap::COL_FROM_DATE);
            $criteria->addSelectColumn(EmployeePositionHistoryTableMap::COL_TO_DATE);
            $criteria->addSelectColumn(EmployeePositionHistoryTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(EmployeePositionHistoryTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(EmployeePositionHistoryTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.employee_position_history_id');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.position_id');
            $criteria->addSelectColumn($alias . '.from_date');
            $criteria->addSelectColumn($alias . '.to_date');
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
            $criteria->removeSelectColumn(EmployeePositionHistoryTableMap::COL_EMPLOYEE_POSITION_HISTORY_ID);
            $criteria->removeSelectColumn(EmployeePositionHistoryTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(EmployeePositionHistoryTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(EmployeePositionHistoryTableMap::COL_FROM_DATE);
            $criteria->removeSelectColumn(EmployeePositionHistoryTableMap::COL_TO_DATE);
            $criteria->removeSelectColumn(EmployeePositionHistoryTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(EmployeePositionHistoryTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(EmployeePositionHistoryTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.employee_position_history_id');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.position_id');
            $criteria->removeSelectColumn($alias . '.from_date');
            $criteria->removeSelectColumn($alias . '.to_date');
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
        return Propel::getServiceContainer()->getDatabaseMap(EmployeePositionHistoryTableMap::DATABASE_NAME)->getTable(EmployeePositionHistoryTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a EmployeePositionHistory or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or EmployeePositionHistory object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeePositionHistoryTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\EmployeePositionHistory) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EmployeePositionHistoryTableMap::DATABASE_NAME);
            $criteria->add(EmployeePositionHistoryTableMap::COL_EMPLOYEE_POSITION_HISTORY_ID, (array) $values, Criteria::IN);
        }

        $query = EmployeePositionHistoryQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EmployeePositionHistoryTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EmployeePositionHistoryTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the employee_position_history table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return EmployeePositionHistoryQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a EmployeePositionHistory or Criteria object.
     *
     * @param mixed $criteria Criteria or EmployeePositionHistory object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeePositionHistoryTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from EmployeePositionHistory object
        }

        if ($criteria->containsKey(EmployeePositionHistoryTableMap::COL_EMPLOYEE_POSITION_HISTORY_ID) && $criteria->keyContainsValue(EmployeePositionHistoryTableMap::COL_EMPLOYEE_POSITION_HISTORY_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EmployeePositionHistoryTableMap::COL_EMPLOYEE_POSITION_HISTORY_ID.')');
        }


        // Set the correct dbName
        $query = EmployeePositionHistoryQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
