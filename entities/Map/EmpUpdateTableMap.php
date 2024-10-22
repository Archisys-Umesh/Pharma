<?php

namespace entities\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use entities\EmpUpdate;
use entities\EmpUpdateQuery;


/**
 * This class defines the structure of the 'emp_update' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class EmpUpdateTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.EmpUpdateTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'emp_update';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'EmpUpdate';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\EmpUpdate';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.EmpUpdate';

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
     * the column name for the emp_id field
     */
    public const COL_EMP_ID = 'emp_update.emp_id';

    /**
     * the column name for the column2 field
     */
    public const COL_COLUMN2 = 'emp_update.column2';

    /**
     * the column name for the grade_id field
     */
    public const COL_GRADE_ID = 'emp_update.grade_id';

    /**
     * the column name for the actual field
     */
    public const COL_ACTUAL = 'emp_update.actual';

    /**
     * the column name for the change field
     */
    public const COL_CHANGE = 'emp_update.change';

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
        self::TYPE_PHPNAME       => ['EmpId', 'Column2', 'GradeId', 'Actual', 'Change', ],
        self::TYPE_CAMELNAME     => ['empId', 'column2', 'gradeId', 'actual', 'change', ],
        self::TYPE_COLNAME       => [EmpUpdateTableMap::COL_EMP_ID, EmpUpdateTableMap::COL_COLUMN2, EmpUpdateTableMap::COL_GRADE_ID, EmpUpdateTableMap::COL_ACTUAL, EmpUpdateTableMap::COL_CHANGE, ],
        self::TYPE_FIELDNAME     => ['emp_id', 'column2', 'grade_id', 'actual', 'change', ],
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
        self::TYPE_PHPNAME       => ['EmpId' => 0, 'Column2' => 1, 'GradeId' => 2, 'Actual' => 3, 'Change' => 4, ],
        self::TYPE_CAMELNAME     => ['empId' => 0, 'column2' => 1, 'gradeId' => 2, 'actual' => 3, 'change' => 4, ],
        self::TYPE_COLNAME       => [EmpUpdateTableMap::COL_EMP_ID => 0, EmpUpdateTableMap::COL_COLUMN2 => 1, EmpUpdateTableMap::COL_GRADE_ID => 2, EmpUpdateTableMap::COL_ACTUAL => 3, EmpUpdateTableMap::COL_CHANGE => 4, ],
        self::TYPE_FIELDNAME     => ['emp_id' => 0, 'column2' => 1, 'grade_id' => 2, 'actual' => 3, 'change' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'EmpId' => 'EMP_ID',
        'EmpUpdate.EmpId' => 'EMP_ID',
        'empId' => 'EMP_ID',
        'empUpdate.empId' => 'EMP_ID',
        'EmpUpdateTableMap::COL_EMP_ID' => 'EMP_ID',
        'COL_EMP_ID' => 'EMP_ID',
        'emp_id' => 'EMP_ID',
        'emp_update.emp_id' => 'EMP_ID',
        'Column2' => 'COLUMN2',
        'EmpUpdate.Column2' => 'COLUMN2',
        'column2' => 'COLUMN2',
        'empUpdate.column2' => 'COLUMN2',
        'EmpUpdateTableMap::COL_COLUMN2' => 'COLUMN2',
        'COL_COLUMN2' => 'COLUMN2',
        'emp_update.column2' => 'COLUMN2',
        'GradeId' => 'GRADE_ID',
        'EmpUpdate.GradeId' => 'GRADE_ID',
        'gradeId' => 'GRADE_ID',
        'empUpdate.gradeId' => 'GRADE_ID',
        'EmpUpdateTableMap::COL_GRADE_ID' => 'GRADE_ID',
        'COL_GRADE_ID' => 'GRADE_ID',
        'grade_id' => 'GRADE_ID',
        'emp_update.grade_id' => 'GRADE_ID',
        'Actual' => 'ACTUAL',
        'EmpUpdate.Actual' => 'ACTUAL',
        'actual' => 'ACTUAL',
        'empUpdate.actual' => 'ACTUAL',
        'EmpUpdateTableMap::COL_ACTUAL' => 'ACTUAL',
        'COL_ACTUAL' => 'ACTUAL',
        'emp_update.actual' => 'ACTUAL',
        'Change' => 'CHANGE',
        'EmpUpdate.Change' => 'CHANGE',
        'change' => 'CHANGE',
        'empUpdate.change' => 'CHANGE',
        'EmpUpdateTableMap::COL_CHANGE' => 'CHANGE',
        'COL_CHANGE' => 'CHANGE',
        'emp_update.change' => 'CHANGE',
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
        $this->setName('emp_update');
        $this->setPhpName('EmpUpdate');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\EmpUpdate');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addColumn('emp_id', 'EmpId', 'INTEGER', false, null, null);
        $this->addColumn('column2', 'Column2', 'VARCHAR', false, 50, null);
        $this->addColumn('grade_id', 'GradeId', 'INTEGER', false, null, null);
        $this->addColumn('actual', 'Actual', 'VARCHAR', false, null, null);
        $this->addColumn('change', 'Change', 'VARCHAR', false, null, null);
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
        return null;
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
        return '';
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
        return $withPrefix ? EmpUpdateTableMap::CLASS_DEFAULT : EmpUpdateTableMap::OM_CLASS;
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
     * @return array (EmpUpdate object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = EmpUpdateTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EmpUpdateTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EmpUpdateTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EmpUpdateTableMap::OM_CLASS;
            /** @var EmpUpdate $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EmpUpdateTableMap::addInstanceToPool($obj, $key);
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
            $key = EmpUpdateTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EmpUpdateTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var EmpUpdate $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EmpUpdateTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EmpUpdateTableMap::COL_EMP_ID);
            $criteria->addSelectColumn(EmpUpdateTableMap::COL_COLUMN2);
            $criteria->addSelectColumn(EmpUpdateTableMap::COL_GRADE_ID);
            $criteria->addSelectColumn(EmpUpdateTableMap::COL_ACTUAL);
            $criteria->addSelectColumn(EmpUpdateTableMap::COL_CHANGE);
        } else {
            $criteria->addSelectColumn($alias . '.emp_id');
            $criteria->addSelectColumn($alias . '.column2');
            $criteria->addSelectColumn($alias . '.grade_id');
            $criteria->addSelectColumn($alias . '.actual');
            $criteria->addSelectColumn($alias . '.change');
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
            $criteria->removeSelectColumn(EmpUpdateTableMap::COL_EMP_ID);
            $criteria->removeSelectColumn(EmpUpdateTableMap::COL_COLUMN2);
            $criteria->removeSelectColumn(EmpUpdateTableMap::COL_GRADE_ID);
            $criteria->removeSelectColumn(EmpUpdateTableMap::COL_ACTUAL);
            $criteria->removeSelectColumn(EmpUpdateTableMap::COL_CHANGE);
        } else {
            $criteria->removeSelectColumn($alias . '.emp_id');
            $criteria->removeSelectColumn($alias . '.column2');
            $criteria->removeSelectColumn($alias . '.grade_id');
            $criteria->removeSelectColumn($alias . '.actual');
            $criteria->removeSelectColumn($alias . '.change');
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
        return Propel::getServiceContainer()->getDatabaseMap(EmpUpdateTableMap::DATABASE_NAME)->getTable(EmpUpdateTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a EmpUpdate or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or EmpUpdate object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EmpUpdateTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\EmpUpdate) { // it's a model object
            // create criteria based on pk value
            $criteria = $values->buildCriteria();
        } else { // it's a primary key, or an array of pks
            throw new LogicException('The EmpUpdate object has no primary key');
        }

        $query = EmpUpdateQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EmpUpdateTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EmpUpdateTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the emp_update table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return EmpUpdateQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a EmpUpdate or Criteria object.
     *
     * @param mixed $criteria Criteria or EmpUpdate object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmpUpdateTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from EmpUpdate object
        }


        // Set the correct dbName
        $query = EmpUpdateQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
