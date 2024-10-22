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
use entities\BudgetGrades;
use entities\BudgetGradesQuery;


/**
 * This class defines the structure of the 'budget_grades' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class BudgetGradesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.BudgetGradesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'budget_grades';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'BudgetGrades';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\BudgetGrades';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.BudgetGrades';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the budgradeid field
     */
    public const COL_BUDGRADEID = 'budget_grades.budgradeid';

    /**
     * the column name for the bgid field
     */
    public const COL_BGID = 'budget_grades.bgid';

    /**
     * the column name for the grade_id field
     */
    public const COL_GRADE_ID = 'budget_grades.grade_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'budget_grades.created_at';

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
        self::TYPE_PHPNAME       => ['Budgradeid', 'Bgid', 'GradeId', 'CreatedAt', ],
        self::TYPE_CAMELNAME     => ['budgradeid', 'bgid', 'gradeId', 'createdAt', ],
        self::TYPE_COLNAME       => [BudgetGradesTableMap::COL_BUDGRADEID, BudgetGradesTableMap::COL_BGID, BudgetGradesTableMap::COL_GRADE_ID, BudgetGradesTableMap::COL_CREATED_AT, ],
        self::TYPE_FIELDNAME     => ['budgradeid', 'bgid', 'grade_id', 'created_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
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
        self::TYPE_PHPNAME       => ['Budgradeid' => 0, 'Bgid' => 1, 'GradeId' => 2, 'CreatedAt' => 3, ],
        self::TYPE_CAMELNAME     => ['budgradeid' => 0, 'bgid' => 1, 'gradeId' => 2, 'createdAt' => 3, ],
        self::TYPE_COLNAME       => [BudgetGradesTableMap::COL_BUDGRADEID => 0, BudgetGradesTableMap::COL_BGID => 1, BudgetGradesTableMap::COL_GRADE_ID => 2, BudgetGradesTableMap::COL_CREATED_AT => 3, ],
        self::TYPE_FIELDNAME     => ['budgradeid' => 0, 'bgid' => 1, 'grade_id' => 2, 'created_at' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Budgradeid' => 'BUDGRADEID',
        'BudgetGrades.Budgradeid' => 'BUDGRADEID',
        'budgradeid' => 'BUDGRADEID',
        'budgetGrades.budgradeid' => 'BUDGRADEID',
        'BudgetGradesTableMap::COL_BUDGRADEID' => 'BUDGRADEID',
        'COL_BUDGRADEID' => 'BUDGRADEID',
        'budget_grades.budgradeid' => 'BUDGRADEID',
        'Bgid' => 'BGID',
        'BudgetGrades.Bgid' => 'BGID',
        'bgid' => 'BGID',
        'budgetGrades.bgid' => 'BGID',
        'BudgetGradesTableMap::COL_BGID' => 'BGID',
        'COL_BGID' => 'BGID',
        'budget_grades.bgid' => 'BGID',
        'GradeId' => 'GRADE_ID',
        'BudgetGrades.GradeId' => 'GRADE_ID',
        'gradeId' => 'GRADE_ID',
        'budgetGrades.gradeId' => 'GRADE_ID',
        'BudgetGradesTableMap::COL_GRADE_ID' => 'GRADE_ID',
        'COL_GRADE_ID' => 'GRADE_ID',
        'grade_id' => 'GRADE_ID',
        'budget_grades.grade_id' => 'GRADE_ID',
        'CreatedAt' => 'CREATED_AT',
        'BudgetGrades.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'budgetGrades.createdAt' => 'CREATED_AT',
        'BudgetGradesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'budget_grades.created_at' => 'CREATED_AT',
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
        $this->setName('budget_grades');
        $this->setPhpName('BudgetGrades');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\BudgetGrades');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('budget_grades_budgradeid_seq');
        // columns
        $this->addPrimaryKey('budgradeid', 'Budgradeid', 'INTEGER', true, null, null);
        $this->addForeignKey('bgid', 'Bgid', 'INTEGER', 'budget_group', 'bgid', false, null, 0);
        $this->addForeignKey('grade_id', 'GradeId', 'INTEGER', 'grade_master', 'gradeid', false, null, 0);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('BudgetGroup', '\\entities\\BudgetGroup', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':bgid',
    1 => ':bgid',
  ),
), null, null, null, false);
        $this->addRelation('GradeMaster', '\\entities\\GradeMaster', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':grade_id',
    1 => ':gradeid',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Budgradeid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Budgradeid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Budgradeid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Budgradeid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Budgradeid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Budgradeid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Budgradeid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? BudgetGradesTableMap::CLASS_DEFAULT : BudgetGradesTableMap::OM_CLASS;
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
     * @return array (BudgetGrades object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = BudgetGradesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = BudgetGradesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + BudgetGradesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BudgetGradesTableMap::OM_CLASS;
            /** @var BudgetGrades $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            BudgetGradesTableMap::addInstanceToPool($obj, $key);
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
            $key = BudgetGradesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = BudgetGradesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var BudgetGrades $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BudgetGradesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(BudgetGradesTableMap::COL_BUDGRADEID);
            $criteria->addSelectColumn(BudgetGradesTableMap::COL_BGID);
            $criteria->addSelectColumn(BudgetGradesTableMap::COL_GRADE_ID);
            $criteria->addSelectColumn(BudgetGradesTableMap::COL_CREATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.budgradeid');
            $criteria->addSelectColumn($alias . '.bgid');
            $criteria->addSelectColumn($alias . '.grade_id');
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
            $criteria->removeSelectColumn(BudgetGradesTableMap::COL_BUDGRADEID);
            $criteria->removeSelectColumn(BudgetGradesTableMap::COL_BGID);
            $criteria->removeSelectColumn(BudgetGradesTableMap::COL_GRADE_ID);
            $criteria->removeSelectColumn(BudgetGradesTableMap::COL_CREATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.budgradeid');
            $criteria->removeSelectColumn($alias . '.bgid');
            $criteria->removeSelectColumn($alias . '.grade_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(BudgetGradesTableMap::DATABASE_NAME)->getTable(BudgetGradesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a BudgetGrades or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or BudgetGrades object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(BudgetGradesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\BudgetGrades) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BudgetGradesTableMap::DATABASE_NAME);
            $criteria->add(BudgetGradesTableMap::COL_BUDGRADEID, (array) $values, Criteria::IN);
        }

        $query = BudgetGradesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            BudgetGradesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                BudgetGradesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the budget_grades table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return BudgetGradesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a BudgetGrades or Criteria object.
     *
     * @param mixed $criteria Criteria or BudgetGrades object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BudgetGradesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from BudgetGrades object
        }

        if ($criteria->containsKey(BudgetGradesTableMap::COL_BUDGRADEID) && $criteria->keyContainsValue(BudgetGradesTableMap::COL_BUDGRADEID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BudgetGradesTableMap::COL_BUDGRADEID.')');
        }


        // Set the correct dbName
        $query = BudgetGradesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
