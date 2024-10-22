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
use entities\Branch;
use entities\BranchQuery;


/**
 * This class defines the structure of the 'branch' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class BranchTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.BranchTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'branch';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Branch';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Branch';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Branch';

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
     * the column name for the branch_id field
     */
    public const COL_BRANCH_ID = 'branch.branch_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'branch.company_id';

    /**
     * the column name for the branchcode field
     */
    public const COL_BRANCHCODE = 'branch.branchcode';

    /**
     * the column name for the branchname field
     */
    public const COL_BRANCHNAME = 'branch.branchname';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'branch.status';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'branch.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'branch.updated_at';

    /**
     * the column name for the istateid field
     */
    public const COL_ISTATEID = 'branch.istateid';

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
        self::TYPE_PHPNAME       => ['BranchId', 'CompanyId', 'Branchcode', 'Branchname', 'Status', 'CreatedAt', 'UpdatedAt', 'Istateid', ],
        self::TYPE_CAMELNAME     => ['branchId', 'companyId', 'branchcode', 'branchname', 'status', 'createdAt', 'updatedAt', 'istateid', ],
        self::TYPE_COLNAME       => [BranchTableMap::COL_BRANCH_ID, BranchTableMap::COL_COMPANY_ID, BranchTableMap::COL_BRANCHCODE, BranchTableMap::COL_BRANCHNAME, BranchTableMap::COL_STATUS, BranchTableMap::COL_CREATED_AT, BranchTableMap::COL_UPDATED_AT, BranchTableMap::COL_ISTATEID, ],
        self::TYPE_FIELDNAME     => ['branch_id', 'company_id', 'branchcode', 'branchname', 'status', 'created_at', 'updated_at', 'istateid', ],
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
        self::TYPE_PHPNAME       => ['BranchId' => 0, 'CompanyId' => 1, 'Branchcode' => 2, 'Branchname' => 3, 'Status' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, 'Istateid' => 7, ],
        self::TYPE_CAMELNAME     => ['branchId' => 0, 'companyId' => 1, 'branchcode' => 2, 'branchname' => 3, 'status' => 4, 'createdAt' => 5, 'updatedAt' => 6, 'istateid' => 7, ],
        self::TYPE_COLNAME       => [BranchTableMap::COL_BRANCH_ID => 0, BranchTableMap::COL_COMPANY_ID => 1, BranchTableMap::COL_BRANCHCODE => 2, BranchTableMap::COL_BRANCHNAME => 3, BranchTableMap::COL_STATUS => 4, BranchTableMap::COL_CREATED_AT => 5, BranchTableMap::COL_UPDATED_AT => 6, BranchTableMap::COL_ISTATEID => 7, ],
        self::TYPE_FIELDNAME     => ['branch_id' => 0, 'company_id' => 1, 'branchcode' => 2, 'branchname' => 3, 'status' => 4, 'created_at' => 5, 'updated_at' => 6, 'istateid' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'BranchId' => 'BRANCH_ID',
        'Branch.BranchId' => 'BRANCH_ID',
        'branchId' => 'BRANCH_ID',
        'branch.branchId' => 'BRANCH_ID',
        'BranchTableMap::COL_BRANCH_ID' => 'BRANCH_ID',
        'COL_BRANCH_ID' => 'BRANCH_ID',
        'branch_id' => 'BRANCH_ID',
        'branch.branch_id' => 'BRANCH_ID',
        'CompanyId' => 'COMPANY_ID',
        'Branch.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'branch.companyId' => 'COMPANY_ID',
        'BranchTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'branch.company_id' => 'COMPANY_ID',
        'Branchcode' => 'BRANCHCODE',
        'Branch.Branchcode' => 'BRANCHCODE',
        'branchcode' => 'BRANCHCODE',
        'branch.branchcode' => 'BRANCHCODE',
        'BranchTableMap::COL_BRANCHCODE' => 'BRANCHCODE',
        'COL_BRANCHCODE' => 'BRANCHCODE',
        'Branchname' => 'BRANCHNAME',
        'Branch.Branchname' => 'BRANCHNAME',
        'branchname' => 'BRANCHNAME',
        'branch.branchname' => 'BRANCHNAME',
        'BranchTableMap::COL_BRANCHNAME' => 'BRANCHNAME',
        'COL_BRANCHNAME' => 'BRANCHNAME',
        'Status' => 'STATUS',
        'Branch.Status' => 'STATUS',
        'status' => 'STATUS',
        'branch.status' => 'STATUS',
        'BranchTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'CreatedAt' => 'CREATED_AT',
        'Branch.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'branch.createdAt' => 'CREATED_AT',
        'BranchTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'branch.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Branch.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'branch.updatedAt' => 'UPDATED_AT',
        'BranchTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'branch.updated_at' => 'UPDATED_AT',
        'Istateid' => 'ISTATEID',
        'Branch.Istateid' => 'ISTATEID',
        'istateid' => 'ISTATEID',
        'branch.istateid' => 'ISTATEID',
        'BranchTableMap::COL_ISTATEID' => 'ISTATEID',
        'COL_ISTATEID' => 'ISTATEID',
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
        $this->setName('branch');
        $this->setPhpName('Branch');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Branch');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('branch_branch_id_seq');
        // columns
        $this->addPrimaryKey('branch_id', 'BranchId', 'INTEGER', true, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addColumn('branchcode', 'Branchcode', 'VARCHAR', true, 255, null);
        $this->addColumn('branchname', 'Branchname', 'VARCHAR', false, 255, null);
        $this->addColumn('status', 'Status', 'SMALLINT', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('istateid', 'Istateid', 'INTEGER', 'geo_state', 'istateid', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('GeoState', '\\entities\\GeoState', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':istateid',
    1 => ':istateid',
  ),
), null, null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('Employee', '\\entities\\Employee', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':branch_id',
    1 => ':branch_id',
  ),
), null, null, 'Employees', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BranchId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BranchId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BranchId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BranchId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BranchId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BranchId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('BranchId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? BranchTableMap::CLASS_DEFAULT : BranchTableMap::OM_CLASS;
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
     * @return array (Branch object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = BranchTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = BranchTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + BranchTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BranchTableMap::OM_CLASS;
            /** @var Branch $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            BranchTableMap::addInstanceToPool($obj, $key);
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
            $key = BranchTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = BranchTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Branch $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BranchTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(BranchTableMap::COL_BRANCH_ID);
            $criteria->addSelectColumn(BranchTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(BranchTableMap::COL_BRANCHCODE);
            $criteria->addSelectColumn(BranchTableMap::COL_BRANCHNAME);
            $criteria->addSelectColumn(BranchTableMap::COL_STATUS);
            $criteria->addSelectColumn(BranchTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(BranchTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(BranchTableMap::COL_ISTATEID);
        } else {
            $criteria->addSelectColumn($alias . '.branch_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.branchcode');
            $criteria->addSelectColumn($alias . '.branchname');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.istateid');
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
            $criteria->removeSelectColumn(BranchTableMap::COL_BRANCH_ID);
            $criteria->removeSelectColumn(BranchTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(BranchTableMap::COL_BRANCHCODE);
            $criteria->removeSelectColumn(BranchTableMap::COL_BRANCHNAME);
            $criteria->removeSelectColumn(BranchTableMap::COL_STATUS);
            $criteria->removeSelectColumn(BranchTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(BranchTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(BranchTableMap::COL_ISTATEID);
        } else {
            $criteria->removeSelectColumn($alias . '.branch_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.branchcode');
            $criteria->removeSelectColumn($alias . '.branchname');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.istateid');
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
        return Propel::getServiceContainer()->getDatabaseMap(BranchTableMap::DATABASE_NAME)->getTable(BranchTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Branch or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Branch object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(BranchTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Branch) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BranchTableMap::DATABASE_NAME);
            $criteria->add(BranchTableMap::COL_BRANCH_ID, (array) $values, Criteria::IN);
        }

        $query = BranchQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            BranchTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                BranchTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the branch table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return BranchQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Branch or Criteria object.
     *
     * @param mixed $criteria Criteria or Branch object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BranchTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Branch object
        }

        if ($criteria->containsKey(BranchTableMap::COL_BRANCH_ID) && $criteria->keyContainsValue(BranchTableMap::COL_BRANCH_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BranchTableMap::COL_BRANCH_ID.')');
        }


        // Set the correct dbName
        $query = BranchQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
