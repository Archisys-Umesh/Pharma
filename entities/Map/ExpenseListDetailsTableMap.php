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
use entities\ExpenseListDetails;
use entities\ExpenseListDetailsQuery;


/**
 * This class defines the structure of the 'expense_list_details' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ExpenseListDetailsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.ExpenseListDetailsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'expense_list_details';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'ExpenseListDetails';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\ExpenseListDetails';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.ExpenseListDetails';

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
     * the column name for the exp_det_id field
     */
    public const COL_EXP_DET_ID = 'expense_list_details.exp_det_id';

    /**
     * the column name for the exp_list_id field
     */
    public const COL_EXP_LIST_ID = 'expense_list_details.exp_list_id';

    /**
     * the column name for the image field
     */
    public const COL_IMAGE = 'expense_list_details.image';

    /**
     * the column name for the description field
     */
    public const COL_DESCRIPTION = 'expense_list_details.description';

    /**
     * the column name for the amount field
     */
    public const COL_AMOUNT = 'expense_list_details.amount';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'expense_list_details.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'expense_list_details.updated_at';

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
        self::TYPE_PHPNAME       => ['ExpDetId', 'ExpListId', 'Image', 'Description', 'Amount', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['expDetId', 'expListId', 'image', 'description', 'amount', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [ExpenseListDetailsTableMap::COL_EXP_DET_ID, ExpenseListDetailsTableMap::COL_EXP_LIST_ID, ExpenseListDetailsTableMap::COL_IMAGE, ExpenseListDetailsTableMap::COL_DESCRIPTION, ExpenseListDetailsTableMap::COL_AMOUNT, ExpenseListDetailsTableMap::COL_CREATED_AT, ExpenseListDetailsTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['exp_det_id', 'exp_list_id', 'image', 'description', 'amount', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['ExpDetId' => 0, 'ExpListId' => 1, 'Image' => 2, 'Description' => 3, 'Amount' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['expDetId' => 0, 'expListId' => 1, 'image' => 2, 'description' => 3, 'amount' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [ExpenseListDetailsTableMap::COL_EXP_DET_ID => 0, ExpenseListDetailsTableMap::COL_EXP_LIST_ID => 1, ExpenseListDetailsTableMap::COL_IMAGE => 2, ExpenseListDetailsTableMap::COL_DESCRIPTION => 3, ExpenseListDetailsTableMap::COL_AMOUNT => 4, ExpenseListDetailsTableMap::COL_CREATED_AT => 5, ExpenseListDetailsTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['exp_det_id' => 0, 'exp_list_id' => 1, 'image' => 2, 'description' => 3, 'amount' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'ExpDetId' => 'EXP_DET_ID',
        'ExpenseListDetails.ExpDetId' => 'EXP_DET_ID',
        'expDetId' => 'EXP_DET_ID',
        'expenseListDetails.expDetId' => 'EXP_DET_ID',
        'ExpenseListDetailsTableMap::COL_EXP_DET_ID' => 'EXP_DET_ID',
        'COL_EXP_DET_ID' => 'EXP_DET_ID',
        'exp_det_id' => 'EXP_DET_ID',
        'expense_list_details.exp_det_id' => 'EXP_DET_ID',
        'ExpListId' => 'EXP_LIST_ID',
        'ExpenseListDetails.ExpListId' => 'EXP_LIST_ID',
        'expListId' => 'EXP_LIST_ID',
        'expenseListDetails.expListId' => 'EXP_LIST_ID',
        'ExpenseListDetailsTableMap::COL_EXP_LIST_ID' => 'EXP_LIST_ID',
        'COL_EXP_LIST_ID' => 'EXP_LIST_ID',
        'exp_list_id' => 'EXP_LIST_ID',
        'expense_list_details.exp_list_id' => 'EXP_LIST_ID',
        'Image' => 'IMAGE',
        'ExpenseListDetails.Image' => 'IMAGE',
        'image' => 'IMAGE',
        'expenseListDetails.image' => 'IMAGE',
        'ExpenseListDetailsTableMap::COL_IMAGE' => 'IMAGE',
        'COL_IMAGE' => 'IMAGE',
        'expense_list_details.image' => 'IMAGE',
        'Description' => 'DESCRIPTION',
        'ExpenseListDetails.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'expenseListDetails.description' => 'DESCRIPTION',
        'ExpenseListDetailsTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'expense_list_details.description' => 'DESCRIPTION',
        'Amount' => 'AMOUNT',
        'ExpenseListDetails.Amount' => 'AMOUNT',
        'amount' => 'AMOUNT',
        'expenseListDetails.amount' => 'AMOUNT',
        'ExpenseListDetailsTableMap::COL_AMOUNT' => 'AMOUNT',
        'COL_AMOUNT' => 'AMOUNT',
        'expense_list_details.amount' => 'AMOUNT',
        'CreatedAt' => 'CREATED_AT',
        'ExpenseListDetails.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'expenseListDetails.createdAt' => 'CREATED_AT',
        'ExpenseListDetailsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'expense_list_details.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'ExpenseListDetails.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'expenseListDetails.updatedAt' => 'UPDATED_AT',
        'ExpenseListDetailsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'expense_list_details.updated_at' => 'UPDATED_AT',
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
        $this->setName('expense_list_details');
        $this->setPhpName('ExpenseListDetails');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\ExpenseListDetails');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('expense_list_details_exp_det_id_seq');
        // columns
        $this->addPrimaryKey('exp_det_id', 'ExpDetId', 'INTEGER', true, null, null);
        $this->addForeignKey('exp_list_id', 'ExpListId', 'INTEGER', 'expense_list', 'exp_list_id', true, null, 0);
        $this->addColumn('image', 'Image', 'VARCHAR', false, 255, '0');
        $this->addColumn('description', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addColumn('amount', 'Amount', 'DECIMAL', false, 10, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('ExpenseList', '\\entities\\ExpenseList', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':exp_list_id',
    1 => ':exp_list_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpDetId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpDetId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpDetId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpDetId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpDetId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpDetId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('ExpDetId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ExpenseListDetailsTableMap::CLASS_DEFAULT : ExpenseListDetailsTableMap::OM_CLASS;
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
     * @return array (ExpenseListDetails object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ExpenseListDetailsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ExpenseListDetailsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ExpenseListDetailsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ExpenseListDetailsTableMap::OM_CLASS;
            /** @var ExpenseListDetails $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ExpenseListDetailsTableMap::addInstanceToPool($obj, $key);
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
            $key = ExpenseListDetailsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ExpenseListDetailsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ExpenseListDetails $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ExpenseListDetailsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ExpenseListDetailsTableMap::COL_EXP_DET_ID);
            $criteria->addSelectColumn(ExpenseListDetailsTableMap::COL_EXP_LIST_ID);
            $criteria->addSelectColumn(ExpenseListDetailsTableMap::COL_IMAGE);
            $criteria->addSelectColumn(ExpenseListDetailsTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(ExpenseListDetailsTableMap::COL_AMOUNT);
            $criteria->addSelectColumn(ExpenseListDetailsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(ExpenseListDetailsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.exp_det_id');
            $criteria->addSelectColumn($alias . '.exp_list_id');
            $criteria->addSelectColumn($alias . '.image');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.amount');
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
            $criteria->removeSelectColumn(ExpenseListDetailsTableMap::COL_EXP_DET_ID);
            $criteria->removeSelectColumn(ExpenseListDetailsTableMap::COL_EXP_LIST_ID);
            $criteria->removeSelectColumn(ExpenseListDetailsTableMap::COL_IMAGE);
            $criteria->removeSelectColumn(ExpenseListDetailsTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(ExpenseListDetailsTableMap::COL_AMOUNT);
            $criteria->removeSelectColumn(ExpenseListDetailsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(ExpenseListDetailsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.exp_det_id');
            $criteria->removeSelectColumn($alias . '.exp_list_id');
            $criteria->removeSelectColumn($alias . '.image');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.amount');
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
        return Propel::getServiceContainer()->getDatabaseMap(ExpenseListDetailsTableMap::DATABASE_NAME)->getTable(ExpenseListDetailsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a ExpenseListDetails or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or ExpenseListDetails object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseListDetailsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\ExpenseListDetails) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ExpenseListDetailsTableMap::DATABASE_NAME);
            $criteria->add(ExpenseListDetailsTableMap::COL_EXP_DET_ID, (array) $values, Criteria::IN);
        }

        $query = ExpenseListDetailsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ExpenseListDetailsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ExpenseListDetailsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the expense_list_details table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ExpenseListDetailsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ExpenseListDetails or Criteria object.
     *
     * @param mixed $criteria Criteria or ExpenseListDetails object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseListDetailsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ExpenseListDetails object
        }

        if ($criteria->containsKey(ExpenseListDetailsTableMap::COL_EXP_DET_ID) && $criteria->keyContainsValue(ExpenseListDetailsTableMap::COL_EXP_DET_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ExpenseListDetailsTableMap::COL_EXP_DET_ID.')');
        }


        // Set the correct dbName
        $query = ExpenseListDetailsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
