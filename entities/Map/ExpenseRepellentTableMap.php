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
use entities\ExpenseRepellent;
use entities\ExpenseRepellentQuery;


/**
 * This class defines the structure of the 'expense_repellent' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ExpenseRepellentTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.ExpenseRepellentTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'expense_repellent';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'ExpenseRepellent';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\ExpenseRepellent';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.ExpenseRepellent';

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
     * the column name for the exprepid field
     */
    public const COL_EXPREPID = 'expense_repellent.exprepid';

    /**
     * the column name for the expense_id field
     */
    public const COL_EXPENSE_ID = 'expense_repellent.expense_id';

    /**
     * the column name for the expense_rep_id field
     */
    public const COL_EXPENSE_REP_ID = 'expense_repellent.expense_rep_id';

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
        self::TYPE_PHPNAME       => ['Exprepid', 'ExpenseId', 'ExpenseRepId', ],
        self::TYPE_CAMELNAME     => ['exprepid', 'expenseId', 'expenseRepId', ],
        self::TYPE_COLNAME       => [ExpenseRepellentTableMap::COL_EXPREPID, ExpenseRepellentTableMap::COL_EXPENSE_ID, ExpenseRepellentTableMap::COL_EXPENSE_REP_ID, ],
        self::TYPE_FIELDNAME     => ['exprepid', 'expense_id', 'expense_rep_id', ],
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
        self::TYPE_PHPNAME       => ['Exprepid' => 0, 'ExpenseId' => 1, 'ExpenseRepId' => 2, ],
        self::TYPE_CAMELNAME     => ['exprepid' => 0, 'expenseId' => 1, 'expenseRepId' => 2, ],
        self::TYPE_COLNAME       => [ExpenseRepellentTableMap::COL_EXPREPID => 0, ExpenseRepellentTableMap::COL_EXPENSE_ID => 1, ExpenseRepellentTableMap::COL_EXPENSE_REP_ID => 2, ],
        self::TYPE_FIELDNAME     => ['exprepid' => 0, 'expense_id' => 1, 'expense_rep_id' => 2, ],
        self::TYPE_NUM           => [0, 1, 2, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Exprepid' => 'EXPREPID',
        'ExpenseRepellent.Exprepid' => 'EXPREPID',
        'exprepid' => 'EXPREPID',
        'expenseRepellent.exprepid' => 'EXPREPID',
        'ExpenseRepellentTableMap::COL_EXPREPID' => 'EXPREPID',
        'COL_EXPREPID' => 'EXPREPID',
        'expense_repellent.exprepid' => 'EXPREPID',
        'ExpenseId' => 'EXPENSE_ID',
        'ExpenseRepellent.ExpenseId' => 'EXPENSE_ID',
        'expenseId' => 'EXPENSE_ID',
        'expenseRepellent.expenseId' => 'EXPENSE_ID',
        'ExpenseRepellentTableMap::COL_EXPENSE_ID' => 'EXPENSE_ID',
        'COL_EXPENSE_ID' => 'EXPENSE_ID',
        'expense_id' => 'EXPENSE_ID',
        'expense_repellent.expense_id' => 'EXPENSE_ID',
        'ExpenseRepId' => 'EXPENSE_REP_ID',
        'ExpenseRepellent.ExpenseRepId' => 'EXPENSE_REP_ID',
        'expenseRepId' => 'EXPENSE_REP_ID',
        'expenseRepellent.expenseRepId' => 'EXPENSE_REP_ID',
        'ExpenseRepellentTableMap::COL_EXPENSE_REP_ID' => 'EXPENSE_REP_ID',
        'COL_EXPENSE_REP_ID' => 'EXPENSE_REP_ID',
        'expense_rep_id' => 'EXPENSE_REP_ID',
        'expense_repellent.expense_rep_id' => 'EXPENSE_REP_ID',
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
        $this->setName('expense_repellent');
        $this->setPhpName('ExpenseRepellent');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\ExpenseRepellent');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('expense_repellent_exprepid_seq');
        // columns
        $this->addPrimaryKey('exprepid', 'Exprepid', 'INTEGER', true, null, null);
        $this->addForeignKey('expense_id', 'ExpenseId', 'INTEGER', 'expense_master', 'expense_id', false, null, 0);
        $this->addColumn('expense_rep_id', 'ExpenseRepId', 'INTEGER', false, null, 0);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Exprepid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Exprepid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Exprepid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Exprepid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Exprepid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Exprepid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Exprepid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ExpenseRepellentTableMap::CLASS_DEFAULT : ExpenseRepellentTableMap::OM_CLASS;
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
     * @return array (ExpenseRepellent object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ExpenseRepellentTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ExpenseRepellentTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ExpenseRepellentTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ExpenseRepellentTableMap::OM_CLASS;
            /** @var ExpenseRepellent $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ExpenseRepellentTableMap::addInstanceToPool($obj, $key);
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
            $key = ExpenseRepellentTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ExpenseRepellentTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ExpenseRepellent $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ExpenseRepellentTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ExpenseRepellentTableMap::COL_EXPREPID);
            $criteria->addSelectColumn(ExpenseRepellentTableMap::COL_EXPENSE_ID);
            $criteria->addSelectColumn(ExpenseRepellentTableMap::COL_EXPENSE_REP_ID);
        } else {
            $criteria->addSelectColumn($alias . '.exprepid');
            $criteria->addSelectColumn($alias . '.expense_id');
            $criteria->addSelectColumn($alias . '.expense_rep_id');
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
            $criteria->removeSelectColumn(ExpenseRepellentTableMap::COL_EXPREPID);
            $criteria->removeSelectColumn(ExpenseRepellentTableMap::COL_EXPENSE_ID);
            $criteria->removeSelectColumn(ExpenseRepellentTableMap::COL_EXPENSE_REP_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.exprepid');
            $criteria->removeSelectColumn($alias . '.expense_id');
            $criteria->removeSelectColumn($alias . '.expense_rep_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(ExpenseRepellentTableMap::DATABASE_NAME)->getTable(ExpenseRepellentTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a ExpenseRepellent or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or ExpenseRepellent object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseRepellentTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\ExpenseRepellent) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ExpenseRepellentTableMap::DATABASE_NAME);
            $criteria->add(ExpenseRepellentTableMap::COL_EXPREPID, (array) $values, Criteria::IN);
        }

        $query = ExpenseRepellentQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ExpenseRepellentTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ExpenseRepellentTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the expense_repellent table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ExpenseRepellentQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ExpenseRepellent or Criteria object.
     *
     * @param mixed $criteria Criteria or ExpenseRepellent object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseRepellentTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ExpenseRepellent object
        }

        if ($criteria->containsKey(ExpenseRepellentTableMap::COL_EXPREPID) && $criteria->keyContainsValue(ExpenseRepellentTableMap::COL_EXPREPID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ExpenseRepellentTableMap::COL_EXPREPID.')');
        }


        // Set the correct dbName
        $query = ExpenseRepellentQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
