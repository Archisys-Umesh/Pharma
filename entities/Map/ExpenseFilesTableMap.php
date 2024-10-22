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
use entities\ExpenseFiles;
use entities\ExpenseFilesQuery;


/**
 * This class defines the structure of the 'expense_files' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ExpenseFilesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.ExpenseFilesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'expense_files';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'ExpenseFiles';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\ExpenseFiles';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.ExpenseFiles';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the exp_file_id field
     */
    public const COL_EXP_FILE_ID = 'expense_files.exp_file_id';

    /**
     * the column name for the exp_file_name field
     */
    public const COL_EXP_FILE_NAME = 'expense_files.exp_file_name';

    /**
     * the column name for the exp_full_name field
     */
    public const COL_EXP_FULL_NAME = 'expense_files.exp_full_name';

    /**
     * the column name for the exp_mime field
     */
    public const COL_EXP_MIME = 'expense_files.exp_mime';

    /**
     * the column name for the exp_file_size field
     */
    public const COL_EXP_FILE_SIZE = 'expense_files.exp_file_size';

    /**
     * the column name for the exp_id field
     */
    public const COL_EXP_ID = 'expense_files.exp_id';

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
        self::TYPE_PHPNAME       => ['ExpFileId', 'ExpFileName', 'ExpFullName', 'ExpMime', 'ExpFileSize', 'ExpId', ],
        self::TYPE_CAMELNAME     => ['expFileId', 'expFileName', 'expFullName', 'expMime', 'expFileSize', 'expId', ],
        self::TYPE_COLNAME       => [ExpenseFilesTableMap::COL_EXP_FILE_ID, ExpenseFilesTableMap::COL_EXP_FILE_NAME, ExpenseFilesTableMap::COL_EXP_FULL_NAME, ExpenseFilesTableMap::COL_EXP_MIME, ExpenseFilesTableMap::COL_EXP_FILE_SIZE, ExpenseFilesTableMap::COL_EXP_ID, ],
        self::TYPE_FIELDNAME     => ['exp_file_id', 'exp_file_name', 'exp_full_name', 'exp_mime', 'exp_file_size', 'exp_id', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
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
        self::TYPE_PHPNAME       => ['ExpFileId' => 0, 'ExpFileName' => 1, 'ExpFullName' => 2, 'ExpMime' => 3, 'ExpFileSize' => 4, 'ExpId' => 5, ],
        self::TYPE_CAMELNAME     => ['expFileId' => 0, 'expFileName' => 1, 'expFullName' => 2, 'expMime' => 3, 'expFileSize' => 4, 'expId' => 5, ],
        self::TYPE_COLNAME       => [ExpenseFilesTableMap::COL_EXP_FILE_ID => 0, ExpenseFilesTableMap::COL_EXP_FILE_NAME => 1, ExpenseFilesTableMap::COL_EXP_FULL_NAME => 2, ExpenseFilesTableMap::COL_EXP_MIME => 3, ExpenseFilesTableMap::COL_EXP_FILE_SIZE => 4, ExpenseFilesTableMap::COL_EXP_ID => 5, ],
        self::TYPE_FIELDNAME     => ['exp_file_id' => 0, 'exp_file_name' => 1, 'exp_full_name' => 2, 'exp_mime' => 3, 'exp_file_size' => 4, 'exp_id' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'ExpFileId' => 'EXP_FILE_ID',
        'ExpenseFiles.ExpFileId' => 'EXP_FILE_ID',
        'expFileId' => 'EXP_FILE_ID',
        'expenseFiles.expFileId' => 'EXP_FILE_ID',
        'ExpenseFilesTableMap::COL_EXP_FILE_ID' => 'EXP_FILE_ID',
        'COL_EXP_FILE_ID' => 'EXP_FILE_ID',
        'exp_file_id' => 'EXP_FILE_ID',
        'expense_files.exp_file_id' => 'EXP_FILE_ID',
        'ExpFileName' => 'EXP_FILE_NAME',
        'ExpenseFiles.ExpFileName' => 'EXP_FILE_NAME',
        'expFileName' => 'EXP_FILE_NAME',
        'expenseFiles.expFileName' => 'EXP_FILE_NAME',
        'ExpenseFilesTableMap::COL_EXP_FILE_NAME' => 'EXP_FILE_NAME',
        'COL_EXP_FILE_NAME' => 'EXP_FILE_NAME',
        'exp_file_name' => 'EXP_FILE_NAME',
        'expense_files.exp_file_name' => 'EXP_FILE_NAME',
        'ExpFullName' => 'EXP_FULL_NAME',
        'ExpenseFiles.ExpFullName' => 'EXP_FULL_NAME',
        'expFullName' => 'EXP_FULL_NAME',
        'expenseFiles.expFullName' => 'EXP_FULL_NAME',
        'ExpenseFilesTableMap::COL_EXP_FULL_NAME' => 'EXP_FULL_NAME',
        'COL_EXP_FULL_NAME' => 'EXP_FULL_NAME',
        'exp_full_name' => 'EXP_FULL_NAME',
        'expense_files.exp_full_name' => 'EXP_FULL_NAME',
        'ExpMime' => 'EXP_MIME',
        'ExpenseFiles.ExpMime' => 'EXP_MIME',
        'expMime' => 'EXP_MIME',
        'expenseFiles.expMime' => 'EXP_MIME',
        'ExpenseFilesTableMap::COL_EXP_MIME' => 'EXP_MIME',
        'COL_EXP_MIME' => 'EXP_MIME',
        'exp_mime' => 'EXP_MIME',
        'expense_files.exp_mime' => 'EXP_MIME',
        'ExpFileSize' => 'EXP_FILE_SIZE',
        'ExpenseFiles.ExpFileSize' => 'EXP_FILE_SIZE',
        'expFileSize' => 'EXP_FILE_SIZE',
        'expenseFiles.expFileSize' => 'EXP_FILE_SIZE',
        'ExpenseFilesTableMap::COL_EXP_FILE_SIZE' => 'EXP_FILE_SIZE',
        'COL_EXP_FILE_SIZE' => 'EXP_FILE_SIZE',
        'exp_file_size' => 'EXP_FILE_SIZE',
        'expense_files.exp_file_size' => 'EXP_FILE_SIZE',
        'ExpId' => 'EXP_ID',
        'ExpenseFiles.ExpId' => 'EXP_ID',
        'expId' => 'EXP_ID',
        'expenseFiles.expId' => 'EXP_ID',
        'ExpenseFilesTableMap::COL_EXP_ID' => 'EXP_ID',
        'COL_EXP_ID' => 'EXP_ID',
        'exp_id' => 'EXP_ID',
        'expense_files.exp_id' => 'EXP_ID',
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
        $this->setName('expense_files');
        $this->setPhpName('ExpenseFiles');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\ExpenseFiles');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('expense_files_exp_file_id_seq');
        // columns
        $this->addPrimaryKey('exp_file_id', 'ExpFileId', 'INTEGER', true, null, null);
        $this->addColumn('exp_file_name', 'ExpFileName', 'VARCHAR', true, 250, '0');
        $this->addColumn('exp_full_name', 'ExpFullName', 'VARCHAR', true, 250, '0');
        $this->addColumn('exp_mime', 'ExpMime', 'VARCHAR', true, 250, '0');
        $this->addColumn('exp_file_size', 'ExpFileSize', 'VARCHAR', true, 250, '0');
        $this->addForeignKey('exp_id', 'ExpId', 'INTEGER', 'expenses', 'exp_id', true, null, 0);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Expenses', '\\entities\\Expenses', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':exp_id',
    1 => ':exp_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpFileId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpFileId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpFileId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpFileId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpFileId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpFileId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('ExpFileId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ExpenseFilesTableMap::CLASS_DEFAULT : ExpenseFilesTableMap::OM_CLASS;
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
     * @return array (ExpenseFiles object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ExpenseFilesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ExpenseFilesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ExpenseFilesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ExpenseFilesTableMap::OM_CLASS;
            /** @var ExpenseFiles $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ExpenseFilesTableMap::addInstanceToPool($obj, $key);
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
            $key = ExpenseFilesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ExpenseFilesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ExpenseFiles $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ExpenseFilesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ExpenseFilesTableMap::COL_EXP_FILE_ID);
            $criteria->addSelectColumn(ExpenseFilesTableMap::COL_EXP_FILE_NAME);
            $criteria->addSelectColumn(ExpenseFilesTableMap::COL_EXP_FULL_NAME);
            $criteria->addSelectColumn(ExpenseFilesTableMap::COL_EXP_MIME);
            $criteria->addSelectColumn(ExpenseFilesTableMap::COL_EXP_FILE_SIZE);
            $criteria->addSelectColumn(ExpenseFilesTableMap::COL_EXP_ID);
        } else {
            $criteria->addSelectColumn($alias . '.exp_file_id');
            $criteria->addSelectColumn($alias . '.exp_file_name');
            $criteria->addSelectColumn($alias . '.exp_full_name');
            $criteria->addSelectColumn($alias . '.exp_mime');
            $criteria->addSelectColumn($alias . '.exp_file_size');
            $criteria->addSelectColumn($alias . '.exp_id');
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
            $criteria->removeSelectColumn(ExpenseFilesTableMap::COL_EXP_FILE_ID);
            $criteria->removeSelectColumn(ExpenseFilesTableMap::COL_EXP_FILE_NAME);
            $criteria->removeSelectColumn(ExpenseFilesTableMap::COL_EXP_FULL_NAME);
            $criteria->removeSelectColumn(ExpenseFilesTableMap::COL_EXP_MIME);
            $criteria->removeSelectColumn(ExpenseFilesTableMap::COL_EXP_FILE_SIZE);
            $criteria->removeSelectColumn(ExpenseFilesTableMap::COL_EXP_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.exp_file_id');
            $criteria->removeSelectColumn($alias . '.exp_file_name');
            $criteria->removeSelectColumn($alias . '.exp_full_name');
            $criteria->removeSelectColumn($alias . '.exp_mime');
            $criteria->removeSelectColumn($alias . '.exp_file_size');
            $criteria->removeSelectColumn($alias . '.exp_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(ExpenseFilesTableMap::DATABASE_NAME)->getTable(ExpenseFilesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a ExpenseFiles or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or ExpenseFiles object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseFilesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\ExpenseFiles) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ExpenseFilesTableMap::DATABASE_NAME);
            $criteria->add(ExpenseFilesTableMap::COL_EXP_FILE_ID, (array) $values, Criteria::IN);
        }

        $query = ExpenseFilesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ExpenseFilesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ExpenseFilesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the expense_files table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ExpenseFilesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ExpenseFiles or Criteria object.
     *
     * @param mixed $criteria Criteria or ExpenseFiles object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseFilesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ExpenseFiles object
        }

        if ($criteria->containsKey(ExpenseFilesTableMap::COL_EXP_FILE_ID) && $criteria->keyContainsValue(ExpenseFilesTableMap::COL_EXP_FILE_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ExpenseFilesTableMap::COL_EXP_FILE_ID.')');
        }


        // Set the correct dbName
        $query = ExpenseFilesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
