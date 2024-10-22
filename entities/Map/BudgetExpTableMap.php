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
use entities\BudgetExp;
use entities\BudgetExpQuery;


/**
 * This class defines the structure of the 'budget_exp' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class BudgetExpTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.BudgetExpTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'budget_exp';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'BudgetExp';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\BudgetExp';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.BudgetExp';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 3;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 3;

    /**
     * the column name for the blid field
     */
    public const COL_BLID = 'budget_exp.blid';

    /**
     * the column name for the bgid field
     */
    public const COL_BGID = 'budget_exp.bgid';

    /**
     * the column name for the expense_id field
     */
    public const COL_EXPENSE_ID = 'budget_exp.expense_id';

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
        self::TYPE_PHPNAME       => ['Blid', 'Bgid', 'ExpenseId', ],
        self::TYPE_CAMELNAME     => ['blid', 'bgid', 'expenseId', ],
        self::TYPE_COLNAME       => [BudgetExpTableMap::COL_BLID, BudgetExpTableMap::COL_BGID, BudgetExpTableMap::COL_EXPENSE_ID, ],
        self::TYPE_FIELDNAME     => ['blid', 'bgid', 'expense_id', ],
        self::TYPE_NUM           => [0, 1, 2, ]
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
        self::TYPE_PHPNAME       => ['Blid' => 0, 'Bgid' => 1, 'ExpenseId' => 2, ],
        self::TYPE_CAMELNAME     => ['blid' => 0, 'bgid' => 1, 'expenseId' => 2, ],
        self::TYPE_COLNAME       => [BudgetExpTableMap::COL_BLID => 0, BudgetExpTableMap::COL_BGID => 1, BudgetExpTableMap::COL_EXPENSE_ID => 2, ],
        self::TYPE_FIELDNAME     => ['blid' => 0, 'bgid' => 1, 'expense_id' => 2, ],
        self::TYPE_NUM           => [0, 1, 2, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Blid' => 'BLID',
        'BudgetExp.Blid' => 'BLID',
        'blid' => 'BLID',
        'budgetExp.blid' => 'BLID',
        'BudgetExpTableMap::COL_BLID' => 'BLID',
        'COL_BLID' => 'BLID',
        'budget_exp.blid' => 'BLID',
        'Bgid' => 'BGID',
        'BudgetExp.Bgid' => 'BGID',
        'bgid' => 'BGID',
        'budgetExp.bgid' => 'BGID',
        'BudgetExpTableMap::COL_BGID' => 'BGID',
        'COL_BGID' => 'BGID',
        'budget_exp.bgid' => 'BGID',
        'ExpenseId' => 'EXPENSE_ID',
        'BudgetExp.ExpenseId' => 'EXPENSE_ID',
        'expenseId' => 'EXPENSE_ID',
        'budgetExp.expenseId' => 'EXPENSE_ID',
        'BudgetExpTableMap::COL_EXPENSE_ID' => 'EXPENSE_ID',
        'COL_EXPENSE_ID' => 'EXPENSE_ID',
        'expense_id' => 'EXPENSE_ID',
        'budget_exp.expense_id' => 'EXPENSE_ID',
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
        $this->setName('budget_exp');
        $this->setPhpName('BudgetExp');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\BudgetExp');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('budget_exp_blid_seq');
        // columns
        $this->addPrimaryKey('blid', 'Blid', 'INTEGER', true, null, null);
        $this->addForeignKey('bgid', 'Bgid', 'INTEGER', 'budget_group', 'bgid', true, null, null);
        $this->addForeignKey('expense_id', 'ExpenseId', 'INTEGER', 'expense_master', 'expense_id', true, null, null);
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
        $this->addRelation('ExpenseMaster', '\\entities\\ExpenseMaster', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':expense_id',
    1 => ':expense_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Blid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Blid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Blid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Blid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Blid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Blid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Blid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? BudgetExpTableMap::CLASS_DEFAULT : BudgetExpTableMap::OM_CLASS;
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
     * @return array (BudgetExp object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = BudgetExpTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = BudgetExpTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + BudgetExpTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BudgetExpTableMap::OM_CLASS;
            /** @var BudgetExp $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            BudgetExpTableMap::addInstanceToPool($obj, $key);
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
            $key = BudgetExpTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = BudgetExpTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var BudgetExp $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BudgetExpTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(BudgetExpTableMap::COL_BLID);
            $criteria->addSelectColumn(BudgetExpTableMap::COL_BGID);
            $criteria->addSelectColumn(BudgetExpTableMap::COL_EXPENSE_ID);
        } else {
            $criteria->addSelectColumn($alias . '.blid');
            $criteria->addSelectColumn($alias . '.bgid');
            $criteria->addSelectColumn($alias . '.expense_id');
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
            $criteria->removeSelectColumn(BudgetExpTableMap::COL_BLID);
            $criteria->removeSelectColumn(BudgetExpTableMap::COL_BGID);
            $criteria->removeSelectColumn(BudgetExpTableMap::COL_EXPENSE_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.blid');
            $criteria->removeSelectColumn($alias . '.bgid');
            $criteria->removeSelectColumn($alias . '.expense_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(BudgetExpTableMap::DATABASE_NAME)->getTable(BudgetExpTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a BudgetExp or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or BudgetExp object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(BudgetExpTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\BudgetExp) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BudgetExpTableMap::DATABASE_NAME);
            $criteria->add(BudgetExpTableMap::COL_BLID, (array) $values, Criteria::IN);
        }

        $query = BudgetExpQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            BudgetExpTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                BudgetExpTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the budget_exp table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return BudgetExpQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a BudgetExp or Criteria object.
     *
     * @param mixed $criteria Criteria or BudgetExp object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BudgetExpTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from BudgetExp object
        }

        if ($criteria->containsKey(BudgetExpTableMap::COL_BLID) && $criteria->keyContainsValue(BudgetExpTableMap::COL_BLID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BudgetExpTableMap::COL_BLID.')');
        }


        // Set the correct dbName
        $query = BudgetExpQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
