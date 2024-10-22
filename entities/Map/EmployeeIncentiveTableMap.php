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
use entities\EmployeeIncentive;
use entities\EmployeeIncentiveQuery;


/**
 * This class defines the structure of the 'employee_incentive' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class EmployeeIncentiveTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.EmployeeIncentiveTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'employee_incentive';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'EmployeeIncentive';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\EmployeeIncentive';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.EmployeeIncentive';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'employee_incentive.id';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'employee_incentive.employee_id';

    /**
     * the column name for the incentive field
     */
    public const COL_INCENTIVE = 'employee_incentive.incentive';

    /**
     * the column name for the month field
     */
    public const COL_MONTH = 'employee_incentive.month';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'employee_incentive.company_id';

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
        self::TYPE_PHPNAME       => ['Id', 'EmployeeId', 'Incentive', 'Month', 'CompanyId', ],
        self::TYPE_CAMELNAME     => ['id', 'employeeId', 'incentive', 'month', 'companyId', ],
        self::TYPE_COLNAME       => [EmployeeIncentiveTableMap::COL_ID, EmployeeIncentiveTableMap::COL_EMPLOYEE_ID, EmployeeIncentiveTableMap::COL_INCENTIVE, EmployeeIncentiveTableMap::COL_MONTH, EmployeeIncentiveTableMap::COL_COMPANY_ID, ],
        self::TYPE_FIELDNAME     => ['id', 'employee_id', 'incentive', 'month', 'company_id', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'EmployeeId' => 1, 'Incentive' => 2, 'Month' => 3, 'CompanyId' => 4, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'employeeId' => 1, 'incentive' => 2, 'month' => 3, 'companyId' => 4, ],
        self::TYPE_COLNAME       => [EmployeeIncentiveTableMap::COL_ID => 0, EmployeeIncentiveTableMap::COL_EMPLOYEE_ID => 1, EmployeeIncentiveTableMap::COL_INCENTIVE => 2, EmployeeIncentiveTableMap::COL_MONTH => 3, EmployeeIncentiveTableMap::COL_COMPANY_ID => 4, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'employee_id' => 1, 'incentive' => 2, 'month' => 3, 'company_id' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'EmployeeIncentive.Id' => 'ID',
        'id' => 'ID',
        'employeeIncentive.id' => 'ID',
        'EmployeeIncentiveTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'employee_incentive.id' => 'ID',
        'EmployeeId' => 'EMPLOYEE_ID',
        'EmployeeIncentive.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'employeeIncentive.employeeId' => 'EMPLOYEE_ID',
        'EmployeeIncentiveTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'employee_incentive.employee_id' => 'EMPLOYEE_ID',
        'Incentive' => 'INCENTIVE',
        'EmployeeIncentive.Incentive' => 'INCENTIVE',
        'incentive' => 'INCENTIVE',
        'employeeIncentive.incentive' => 'INCENTIVE',
        'EmployeeIncentiveTableMap::COL_INCENTIVE' => 'INCENTIVE',
        'COL_INCENTIVE' => 'INCENTIVE',
        'employee_incentive.incentive' => 'INCENTIVE',
        'Month' => 'MONTH',
        'EmployeeIncentive.Month' => 'MONTH',
        'month' => 'MONTH',
        'employeeIncentive.month' => 'MONTH',
        'EmployeeIncentiveTableMap::COL_MONTH' => 'MONTH',
        'COL_MONTH' => 'MONTH',
        'employee_incentive.month' => 'MONTH',
        'CompanyId' => 'COMPANY_ID',
        'EmployeeIncentive.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'employeeIncentive.companyId' => 'COMPANY_ID',
        'EmployeeIncentiveTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'employee_incentive.company_id' => 'COMPANY_ID',
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
        $this->setName('employee_incentive');
        $this->setPhpName('EmployeeIncentive');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\EmployeeIncentive');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('employee_incentive_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', true, null, 0);
        $this->addColumn('incentive', 'Incentive', 'DECIMAL', true, 20, 0.00);
        $this->addColumn('month', 'Month', 'VARCHAR', true, 50, '0');
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, 0);
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
        $this->addRelation('Employee', '\\entities\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), 'CASCADE', null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? EmployeeIncentiveTableMap::CLASS_DEFAULT : EmployeeIncentiveTableMap::OM_CLASS;
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
     * @return array (EmployeeIncentive object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = EmployeeIncentiveTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EmployeeIncentiveTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EmployeeIncentiveTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EmployeeIncentiveTableMap::OM_CLASS;
            /** @var EmployeeIncentive $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EmployeeIncentiveTableMap::addInstanceToPool($obj, $key);
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
            $key = EmployeeIncentiveTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EmployeeIncentiveTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var EmployeeIncentive $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EmployeeIncentiveTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EmployeeIncentiveTableMap::COL_ID);
            $criteria->addSelectColumn(EmployeeIncentiveTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(EmployeeIncentiveTableMap::COL_INCENTIVE);
            $criteria->addSelectColumn(EmployeeIncentiveTableMap::COL_MONTH);
            $criteria->addSelectColumn(EmployeeIncentiveTableMap::COL_COMPANY_ID);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.incentive');
            $criteria->addSelectColumn($alias . '.month');
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
            $criteria->removeSelectColumn(EmployeeIncentiveTableMap::COL_ID);
            $criteria->removeSelectColumn(EmployeeIncentiveTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(EmployeeIncentiveTableMap::COL_INCENTIVE);
            $criteria->removeSelectColumn(EmployeeIncentiveTableMap::COL_MONTH);
            $criteria->removeSelectColumn(EmployeeIncentiveTableMap::COL_COMPANY_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.incentive');
            $criteria->removeSelectColumn($alias . '.month');
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
        return Propel::getServiceContainer()->getDatabaseMap(EmployeeIncentiveTableMap::DATABASE_NAME)->getTable(EmployeeIncentiveTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a EmployeeIncentive or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or EmployeeIncentive object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeIncentiveTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\EmployeeIncentive) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EmployeeIncentiveTableMap::DATABASE_NAME);
            $criteria->add(EmployeeIncentiveTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = EmployeeIncentiveQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EmployeeIncentiveTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EmployeeIncentiveTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the employee_incentive table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return EmployeeIncentiveQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a EmployeeIncentive or Criteria object.
     *
     * @param mixed $criteria Criteria or EmployeeIncentive object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeIncentiveTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from EmployeeIncentive object
        }

        if ($criteria->containsKey(EmployeeIncentiveTableMap::COL_ID) && $criteria->keyContainsValue(EmployeeIncentiveTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EmployeeIncentiveTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = EmployeeIncentiveQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
