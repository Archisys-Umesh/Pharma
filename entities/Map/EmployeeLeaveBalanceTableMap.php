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
use entities\EmployeeLeaveBalance;
use entities\EmployeeLeaveBalanceQuery;


/**
 * This class defines the structure of the 'employee_leave_balance' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class EmployeeLeaveBalanceTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.EmployeeLeaveBalanceTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'employee_leave_balance';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'EmployeeLeaveBalance';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\EmployeeLeaveBalance';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.EmployeeLeaveBalance';

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
     * the column name for the uniquecode field
     */
    public const COL_UNIQUECODE = 'employee_leave_balance.uniquecode';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'employee_leave_balance.employee_id';

    /**
     * the column name for the leave_year field
     */
    public const COL_LEAVE_YEAR = 'employee_leave_balance.leave_year';

    /**
     * the column name for the leave_type field
     */
    public const COL_LEAVE_TYPE = 'employee_leave_balance.leave_type';

    /**
     * the column name for the accuration field
     */
    public const COL_ACCURATION = 'employee_leave_balance.accuration';

    /**
     * the column name for the opening field
     */
    public const COL_OPENING = 'employee_leave_balance.opening';

    /**
     * the column name for the reward field
     */
    public const COL_REWARD = 'employee_leave_balance.reward';

    /**
     * the column name for the consumed field
     */
    public const COL_CONSUMED = 'employee_leave_balance.consumed';

    /**
     * the column name for the balance field
     */
    public const COL_BALANCE = 'employee_leave_balance.balance';

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
        self::TYPE_PHPNAME       => ['Uniquecode', 'EmployeeId', 'LeaveYear', 'LeaveType', 'Accuration', 'Opening', 'Reward', 'Consumed', 'Balance', ],
        self::TYPE_CAMELNAME     => ['uniquecode', 'employeeId', 'leaveYear', 'leaveType', 'accuration', 'opening', 'reward', 'consumed', 'balance', ],
        self::TYPE_COLNAME       => [EmployeeLeaveBalanceTableMap::COL_UNIQUECODE, EmployeeLeaveBalanceTableMap::COL_EMPLOYEE_ID, EmployeeLeaveBalanceTableMap::COL_LEAVE_YEAR, EmployeeLeaveBalanceTableMap::COL_LEAVE_TYPE, EmployeeLeaveBalanceTableMap::COL_ACCURATION, EmployeeLeaveBalanceTableMap::COL_OPENING, EmployeeLeaveBalanceTableMap::COL_REWARD, EmployeeLeaveBalanceTableMap::COL_CONSUMED, EmployeeLeaveBalanceTableMap::COL_BALANCE, ],
        self::TYPE_FIELDNAME     => ['uniquecode', 'employee_id', 'leave_year', 'leave_type', 'accuration', 'opening', 'reward', 'consumed', 'balance', ],
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
        self::TYPE_PHPNAME       => ['Uniquecode' => 0, 'EmployeeId' => 1, 'LeaveYear' => 2, 'LeaveType' => 3, 'Accuration' => 4, 'Opening' => 5, 'Reward' => 6, 'Consumed' => 7, 'Balance' => 8, ],
        self::TYPE_CAMELNAME     => ['uniquecode' => 0, 'employeeId' => 1, 'leaveYear' => 2, 'leaveType' => 3, 'accuration' => 4, 'opening' => 5, 'reward' => 6, 'consumed' => 7, 'balance' => 8, ],
        self::TYPE_COLNAME       => [EmployeeLeaveBalanceTableMap::COL_UNIQUECODE => 0, EmployeeLeaveBalanceTableMap::COL_EMPLOYEE_ID => 1, EmployeeLeaveBalanceTableMap::COL_LEAVE_YEAR => 2, EmployeeLeaveBalanceTableMap::COL_LEAVE_TYPE => 3, EmployeeLeaveBalanceTableMap::COL_ACCURATION => 4, EmployeeLeaveBalanceTableMap::COL_OPENING => 5, EmployeeLeaveBalanceTableMap::COL_REWARD => 6, EmployeeLeaveBalanceTableMap::COL_CONSUMED => 7, EmployeeLeaveBalanceTableMap::COL_BALANCE => 8, ],
        self::TYPE_FIELDNAME     => ['uniquecode' => 0, 'employee_id' => 1, 'leave_year' => 2, 'leave_type' => 3, 'accuration' => 4, 'opening' => 5, 'reward' => 6, 'consumed' => 7, 'balance' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Uniquecode' => 'UNIQUECODE',
        'EmployeeLeaveBalance.Uniquecode' => 'UNIQUECODE',
        'uniquecode' => 'UNIQUECODE',
        'employeeLeaveBalance.uniquecode' => 'UNIQUECODE',
        'EmployeeLeaveBalanceTableMap::COL_UNIQUECODE' => 'UNIQUECODE',
        'COL_UNIQUECODE' => 'UNIQUECODE',
        'employee_leave_balance.uniquecode' => 'UNIQUECODE',
        'EmployeeId' => 'EMPLOYEE_ID',
        'EmployeeLeaveBalance.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'employeeLeaveBalance.employeeId' => 'EMPLOYEE_ID',
        'EmployeeLeaveBalanceTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'employee_leave_balance.employee_id' => 'EMPLOYEE_ID',
        'LeaveYear' => 'LEAVE_YEAR',
        'EmployeeLeaveBalance.LeaveYear' => 'LEAVE_YEAR',
        'leaveYear' => 'LEAVE_YEAR',
        'employeeLeaveBalance.leaveYear' => 'LEAVE_YEAR',
        'EmployeeLeaveBalanceTableMap::COL_LEAVE_YEAR' => 'LEAVE_YEAR',
        'COL_LEAVE_YEAR' => 'LEAVE_YEAR',
        'leave_year' => 'LEAVE_YEAR',
        'employee_leave_balance.leave_year' => 'LEAVE_YEAR',
        'LeaveType' => 'LEAVE_TYPE',
        'EmployeeLeaveBalance.LeaveType' => 'LEAVE_TYPE',
        'leaveType' => 'LEAVE_TYPE',
        'employeeLeaveBalance.leaveType' => 'LEAVE_TYPE',
        'EmployeeLeaveBalanceTableMap::COL_LEAVE_TYPE' => 'LEAVE_TYPE',
        'COL_LEAVE_TYPE' => 'LEAVE_TYPE',
        'leave_type' => 'LEAVE_TYPE',
        'employee_leave_balance.leave_type' => 'LEAVE_TYPE',
        'Accuration' => 'ACCURATION',
        'EmployeeLeaveBalance.Accuration' => 'ACCURATION',
        'accuration' => 'ACCURATION',
        'employeeLeaveBalance.accuration' => 'ACCURATION',
        'EmployeeLeaveBalanceTableMap::COL_ACCURATION' => 'ACCURATION',
        'COL_ACCURATION' => 'ACCURATION',
        'employee_leave_balance.accuration' => 'ACCURATION',
        'Opening' => 'OPENING',
        'EmployeeLeaveBalance.Opening' => 'OPENING',
        'opening' => 'OPENING',
        'employeeLeaveBalance.opening' => 'OPENING',
        'EmployeeLeaveBalanceTableMap::COL_OPENING' => 'OPENING',
        'COL_OPENING' => 'OPENING',
        'employee_leave_balance.opening' => 'OPENING',
        'Reward' => 'REWARD',
        'EmployeeLeaveBalance.Reward' => 'REWARD',
        'reward' => 'REWARD',
        'employeeLeaveBalance.reward' => 'REWARD',
        'EmployeeLeaveBalanceTableMap::COL_REWARD' => 'REWARD',
        'COL_REWARD' => 'REWARD',
        'employee_leave_balance.reward' => 'REWARD',
        'Consumed' => 'CONSUMED',
        'EmployeeLeaveBalance.Consumed' => 'CONSUMED',
        'consumed' => 'CONSUMED',
        'employeeLeaveBalance.consumed' => 'CONSUMED',
        'EmployeeLeaveBalanceTableMap::COL_CONSUMED' => 'CONSUMED',
        'COL_CONSUMED' => 'CONSUMED',
        'employee_leave_balance.consumed' => 'CONSUMED',
        'Balance' => 'BALANCE',
        'EmployeeLeaveBalance.Balance' => 'BALANCE',
        'balance' => 'BALANCE',
        'employeeLeaveBalance.balance' => 'BALANCE',
        'EmployeeLeaveBalanceTableMap::COL_BALANCE' => 'BALANCE',
        'COL_BALANCE' => 'BALANCE',
        'employee_leave_balance.balance' => 'BALANCE',
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
        $this->setName('employee_leave_balance');
        $this->setPhpName('EmployeeLeaveBalance');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\EmployeeLeaveBalance');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('uniquecode', 'Uniquecode', 'VARCHAR', true, 50, null);
        $this->addColumn('employee_id', 'EmployeeId', 'INTEGER', false, null, null);
        $this->addColumn('leave_year', 'LeaveYear', 'VARCHAR', false, 50, null);
        $this->addColumn('leave_type', 'LeaveType', 'VARCHAR', false, 50, null);
        $this->addColumn('accuration', 'Accuration', 'INTEGER', false, null, null);
        $this->addColumn('opening', 'Opening', 'INTEGER', false, null, null);
        $this->addColumn('reward', 'Reward', 'INTEGER', false, null, null);
        $this->addColumn('consumed', 'Consumed', 'INTEGER', false, null, null);
        $this->addColumn('balance', 'Balance', 'INTEGER', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniquecode', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniquecode', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniquecode', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniquecode', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniquecode', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Uniquecode', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Uniquecode', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? EmployeeLeaveBalanceTableMap::CLASS_DEFAULT : EmployeeLeaveBalanceTableMap::OM_CLASS;
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
     * @return array (EmployeeLeaveBalance object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = EmployeeLeaveBalanceTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EmployeeLeaveBalanceTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EmployeeLeaveBalanceTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EmployeeLeaveBalanceTableMap::OM_CLASS;
            /** @var EmployeeLeaveBalance $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EmployeeLeaveBalanceTableMap::addInstanceToPool($obj, $key);
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
            $key = EmployeeLeaveBalanceTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EmployeeLeaveBalanceTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var EmployeeLeaveBalance $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EmployeeLeaveBalanceTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EmployeeLeaveBalanceTableMap::COL_UNIQUECODE);
            $criteria->addSelectColumn(EmployeeLeaveBalanceTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(EmployeeLeaveBalanceTableMap::COL_LEAVE_YEAR);
            $criteria->addSelectColumn(EmployeeLeaveBalanceTableMap::COL_LEAVE_TYPE);
            $criteria->addSelectColumn(EmployeeLeaveBalanceTableMap::COL_ACCURATION);
            $criteria->addSelectColumn(EmployeeLeaveBalanceTableMap::COL_OPENING);
            $criteria->addSelectColumn(EmployeeLeaveBalanceTableMap::COL_REWARD);
            $criteria->addSelectColumn(EmployeeLeaveBalanceTableMap::COL_CONSUMED);
            $criteria->addSelectColumn(EmployeeLeaveBalanceTableMap::COL_BALANCE);
        } else {
            $criteria->addSelectColumn($alias . '.uniquecode');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.leave_year');
            $criteria->addSelectColumn($alias . '.leave_type');
            $criteria->addSelectColumn($alias . '.accuration');
            $criteria->addSelectColumn($alias . '.opening');
            $criteria->addSelectColumn($alias . '.reward');
            $criteria->addSelectColumn($alias . '.consumed');
            $criteria->addSelectColumn($alias . '.balance');
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
            $criteria->removeSelectColumn(EmployeeLeaveBalanceTableMap::COL_UNIQUECODE);
            $criteria->removeSelectColumn(EmployeeLeaveBalanceTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(EmployeeLeaveBalanceTableMap::COL_LEAVE_YEAR);
            $criteria->removeSelectColumn(EmployeeLeaveBalanceTableMap::COL_LEAVE_TYPE);
            $criteria->removeSelectColumn(EmployeeLeaveBalanceTableMap::COL_ACCURATION);
            $criteria->removeSelectColumn(EmployeeLeaveBalanceTableMap::COL_OPENING);
            $criteria->removeSelectColumn(EmployeeLeaveBalanceTableMap::COL_REWARD);
            $criteria->removeSelectColumn(EmployeeLeaveBalanceTableMap::COL_CONSUMED);
            $criteria->removeSelectColumn(EmployeeLeaveBalanceTableMap::COL_BALANCE);
        } else {
            $criteria->removeSelectColumn($alias . '.uniquecode');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.leave_year');
            $criteria->removeSelectColumn($alias . '.leave_type');
            $criteria->removeSelectColumn($alias . '.accuration');
            $criteria->removeSelectColumn($alias . '.opening');
            $criteria->removeSelectColumn($alias . '.reward');
            $criteria->removeSelectColumn($alias . '.consumed');
            $criteria->removeSelectColumn($alias . '.balance');
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
        return Propel::getServiceContainer()->getDatabaseMap(EmployeeLeaveBalanceTableMap::DATABASE_NAME)->getTable(EmployeeLeaveBalanceTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a EmployeeLeaveBalance or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or EmployeeLeaveBalance object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeLeaveBalanceTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\EmployeeLeaveBalance) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EmployeeLeaveBalanceTableMap::DATABASE_NAME);
            $criteria->add(EmployeeLeaveBalanceTableMap::COL_UNIQUECODE, (array) $values, Criteria::IN);
        }

        $query = EmployeeLeaveBalanceQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EmployeeLeaveBalanceTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EmployeeLeaveBalanceTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the employee_leave_balance table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return EmployeeLeaveBalanceQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a EmployeeLeaveBalance or Criteria object.
     *
     * @param mixed $criteria Criteria or EmployeeLeaveBalance object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeLeaveBalanceTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from EmployeeLeaveBalance object
        }


        // Set the correct dbName
        $query = EmployeeLeaveBalanceQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
