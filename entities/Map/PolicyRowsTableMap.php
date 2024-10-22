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
use entities\PolicyRows;
use entities\PolicyRowsQuery;


/**
 * This class defines the structure of the 'policy_rows' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class PolicyRowsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.PolicyRowsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'policy_rows';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'PolicyRows';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\PolicyRows';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.PolicyRows';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the pr_id field
     */
    public const COL_PR_ID = 'policy_rows.pr_id';

    /**
     * the column name for the policy_id field
     */
    public const COL_POLICY_ID = 'policy_rows.policy_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'policy_rows.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'policy_rows.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'policy_rows.updated_at';

    /**
     * the column name for the policykey field
     */
    public const COL_POLICYKEY = 'policy_rows.policykey';

    /**
     * the column name for the limit1 field
     */
    public const COL_LIMIT1 = 'policy_rows.limit1';

    /**
     * the column name for the limit2 field
     */
    public const COL_LIMIT2 = 'policy_rows.limit2';

    /**
     * the column name for the nocheck field
     */
    public const COL_NOCHECK = 'policy_rows.nocheck';

    /**
     * the column name for the is_readonly field
     */
    public const COL_IS_READONLY = 'policy_rows.is_readonly';

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
        self::TYPE_PHPNAME       => ['PrId', 'PolicyId', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'Policykey', 'Limit1', 'Limit2', 'Nocheck', 'IsReadonly', ],
        self::TYPE_CAMELNAME     => ['prId', 'policyId', 'companyId', 'createdAt', 'updatedAt', 'policykey', 'limit1', 'limit2', 'nocheck', 'isReadonly', ],
        self::TYPE_COLNAME       => [PolicyRowsTableMap::COL_PR_ID, PolicyRowsTableMap::COL_POLICY_ID, PolicyRowsTableMap::COL_COMPANY_ID, PolicyRowsTableMap::COL_CREATED_AT, PolicyRowsTableMap::COL_UPDATED_AT, PolicyRowsTableMap::COL_POLICYKEY, PolicyRowsTableMap::COL_LIMIT1, PolicyRowsTableMap::COL_LIMIT2, PolicyRowsTableMap::COL_NOCHECK, PolicyRowsTableMap::COL_IS_READONLY, ],
        self::TYPE_FIELDNAME     => ['pr_id', 'policy_id', 'company_id', 'created_at', 'updated_at', 'policykey', 'limit1', 'limit2', 'nocheck', 'is_readonly', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
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
        self::TYPE_PHPNAME       => ['PrId' => 0, 'PolicyId' => 1, 'CompanyId' => 2, 'CreatedAt' => 3, 'UpdatedAt' => 4, 'Policykey' => 5, 'Limit1' => 6, 'Limit2' => 7, 'Nocheck' => 8, 'IsReadonly' => 9, ],
        self::TYPE_CAMELNAME     => ['prId' => 0, 'policyId' => 1, 'companyId' => 2, 'createdAt' => 3, 'updatedAt' => 4, 'policykey' => 5, 'limit1' => 6, 'limit2' => 7, 'nocheck' => 8, 'isReadonly' => 9, ],
        self::TYPE_COLNAME       => [PolicyRowsTableMap::COL_PR_ID => 0, PolicyRowsTableMap::COL_POLICY_ID => 1, PolicyRowsTableMap::COL_COMPANY_ID => 2, PolicyRowsTableMap::COL_CREATED_AT => 3, PolicyRowsTableMap::COL_UPDATED_AT => 4, PolicyRowsTableMap::COL_POLICYKEY => 5, PolicyRowsTableMap::COL_LIMIT1 => 6, PolicyRowsTableMap::COL_LIMIT2 => 7, PolicyRowsTableMap::COL_NOCHECK => 8, PolicyRowsTableMap::COL_IS_READONLY => 9, ],
        self::TYPE_FIELDNAME     => ['pr_id' => 0, 'policy_id' => 1, 'company_id' => 2, 'created_at' => 3, 'updated_at' => 4, 'policykey' => 5, 'limit1' => 6, 'limit2' => 7, 'nocheck' => 8, 'is_readonly' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'PrId' => 'PR_ID',
        'PolicyRows.PrId' => 'PR_ID',
        'prId' => 'PR_ID',
        'policyRows.prId' => 'PR_ID',
        'PolicyRowsTableMap::COL_PR_ID' => 'PR_ID',
        'COL_PR_ID' => 'PR_ID',
        'pr_id' => 'PR_ID',
        'policy_rows.pr_id' => 'PR_ID',
        'PolicyId' => 'POLICY_ID',
        'PolicyRows.PolicyId' => 'POLICY_ID',
        'policyId' => 'POLICY_ID',
        'policyRows.policyId' => 'POLICY_ID',
        'PolicyRowsTableMap::COL_POLICY_ID' => 'POLICY_ID',
        'COL_POLICY_ID' => 'POLICY_ID',
        'policy_id' => 'POLICY_ID',
        'policy_rows.policy_id' => 'POLICY_ID',
        'CompanyId' => 'COMPANY_ID',
        'PolicyRows.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'policyRows.companyId' => 'COMPANY_ID',
        'PolicyRowsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'policy_rows.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'PolicyRows.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'policyRows.createdAt' => 'CREATED_AT',
        'PolicyRowsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'policy_rows.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'PolicyRows.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'policyRows.updatedAt' => 'UPDATED_AT',
        'PolicyRowsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'policy_rows.updated_at' => 'UPDATED_AT',
        'Policykey' => 'POLICYKEY',
        'PolicyRows.Policykey' => 'POLICYKEY',
        'policykey' => 'POLICYKEY',
        'policyRows.policykey' => 'POLICYKEY',
        'PolicyRowsTableMap::COL_POLICYKEY' => 'POLICYKEY',
        'COL_POLICYKEY' => 'POLICYKEY',
        'policy_rows.policykey' => 'POLICYKEY',
        'Limit1' => 'LIMIT1',
        'PolicyRows.Limit1' => 'LIMIT1',
        'limit1' => 'LIMIT1',
        'policyRows.limit1' => 'LIMIT1',
        'PolicyRowsTableMap::COL_LIMIT1' => 'LIMIT1',
        'COL_LIMIT1' => 'LIMIT1',
        'policy_rows.limit1' => 'LIMIT1',
        'Limit2' => 'LIMIT2',
        'PolicyRows.Limit2' => 'LIMIT2',
        'limit2' => 'LIMIT2',
        'policyRows.limit2' => 'LIMIT2',
        'PolicyRowsTableMap::COL_LIMIT2' => 'LIMIT2',
        'COL_LIMIT2' => 'LIMIT2',
        'policy_rows.limit2' => 'LIMIT2',
        'Nocheck' => 'NOCHECK',
        'PolicyRows.Nocheck' => 'NOCHECK',
        'nocheck' => 'NOCHECK',
        'policyRows.nocheck' => 'NOCHECK',
        'PolicyRowsTableMap::COL_NOCHECK' => 'NOCHECK',
        'COL_NOCHECK' => 'NOCHECK',
        'policy_rows.nocheck' => 'NOCHECK',
        'IsReadonly' => 'IS_READONLY',
        'PolicyRows.IsReadonly' => 'IS_READONLY',
        'isReadonly' => 'IS_READONLY',
        'policyRows.isReadonly' => 'IS_READONLY',
        'PolicyRowsTableMap::COL_IS_READONLY' => 'IS_READONLY',
        'COL_IS_READONLY' => 'IS_READONLY',
        'is_readonly' => 'IS_READONLY',
        'policy_rows.is_readonly' => 'IS_READONLY',
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
        $this->setName('policy_rows');
        $this->setPhpName('PolicyRows');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\PolicyRows');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('policy_rows_pr_id_seq');
        // columns
        $this->addPrimaryKey('pr_id', 'PrId', 'INTEGER', true, null, null);
        $this->addForeignKey('policy_id', 'PolicyId', 'INTEGER', 'policy_master', 'policy_id', true, null, 0);
        $this->addColumn('company_id', 'CompanyId', 'INTEGER', true, null, 1);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('policykey', 'Policykey', 'VARCHAR', true, null, '0');
        $this->addColumn('limit1', 'Limit1', 'DECIMAL', true, null, 0.00);
        $this->addColumn('limit2', 'Limit2', 'DECIMAL', true, null, 0.00);
        $this->addColumn('nocheck', 'Nocheck', 'BOOLEAN', true, 1, true);
        $this->addColumn('is_readonly', 'IsReadonly', 'BOOLEAN', true, 1, false);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('PolicyMaster', '\\entities\\PolicyMaster', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':policy_id',
    1 => ':policy_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PrId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PrId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PrId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PrId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PrId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PrId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('PrId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? PolicyRowsTableMap::CLASS_DEFAULT : PolicyRowsTableMap::OM_CLASS;
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
     * @return array (PolicyRows object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = PolicyRowsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PolicyRowsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PolicyRowsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PolicyRowsTableMap::OM_CLASS;
            /** @var PolicyRows $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PolicyRowsTableMap::addInstanceToPool($obj, $key);
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
            $key = PolicyRowsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PolicyRowsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var PolicyRows $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PolicyRowsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PolicyRowsTableMap::COL_PR_ID);
            $criteria->addSelectColumn(PolicyRowsTableMap::COL_POLICY_ID);
            $criteria->addSelectColumn(PolicyRowsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(PolicyRowsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(PolicyRowsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(PolicyRowsTableMap::COL_POLICYKEY);
            $criteria->addSelectColumn(PolicyRowsTableMap::COL_LIMIT1);
            $criteria->addSelectColumn(PolicyRowsTableMap::COL_LIMIT2);
            $criteria->addSelectColumn(PolicyRowsTableMap::COL_NOCHECK);
            $criteria->addSelectColumn(PolicyRowsTableMap::COL_IS_READONLY);
        } else {
            $criteria->addSelectColumn($alias . '.pr_id');
            $criteria->addSelectColumn($alias . '.policy_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.policykey');
            $criteria->addSelectColumn($alias . '.limit1');
            $criteria->addSelectColumn($alias . '.limit2');
            $criteria->addSelectColumn($alias . '.nocheck');
            $criteria->addSelectColumn($alias . '.is_readonly');
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
            $criteria->removeSelectColumn(PolicyRowsTableMap::COL_PR_ID);
            $criteria->removeSelectColumn(PolicyRowsTableMap::COL_POLICY_ID);
            $criteria->removeSelectColumn(PolicyRowsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(PolicyRowsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(PolicyRowsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(PolicyRowsTableMap::COL_POLICYKEY);
            $criteria->removeSelectColumn(PolicyRowsTableMap::COL_LIMIT1);
            $criteria->removeSelectColumn(PolicyRowsTableMap::COL_LIMIT2);
            $criteria->removeSelectColumn(PolicyRowsTableMap::COL_NOCHECK);
            $criteria->removeSelectColumn(PolicyRowsTableMap::COL_IS_READONLY);
        } else {
            $criteria->removeSelectColumn($alias . '.pr_id');
            $criteria->removeSelectColumn($alias . '.policy_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.policykey');
            $criteria->removeSelectColumn($alias . '.limit1');
            $criteria->removeSelectColumn($alias . '.limit2');
            $criteria->removeSelectColumn($alias . '.nocheck');
            $criteria->removeSelectColumn($alias . '.is_readonly');
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
        return Propel::getServiceContainer()->getDatabaseMap(PolicyRowsTableMap::DATABASE_NAME)->getTable(PolicyRowsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a PolicyRows or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or PolicyRows object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PolicyRowsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\PolicyRows) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PolicyRowsTableMap::DATABASE_NAME);
            $criteria->add(PolicyRowsTableMap::COL_PR_ID, (array) $values, Criteria::IN);
        }

        $query = PolicyRowsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PolicyRowsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PolicyRowsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the policy_rows table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return PolicyRowsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a PolicyRows or Criteria object.
     *
     * @param mixed $criteria Criteria or PolicyRows object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PolicyRowsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from PolicyRows object
        }

        if ($criteria->containsKey(PolicyRowsTableMap::COL_PR_ID) && $criteria->keyContainsValue(PolicyRowsTableMap::COL_PR_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PolicyRowsTableMap::COL_PR_ID.')');
        }


        // Set the correct dbName
        $query = PolicyRowsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
