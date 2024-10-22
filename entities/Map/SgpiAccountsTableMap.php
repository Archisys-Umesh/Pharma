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
use entities\SgpiAccounts;
use entities\SgpiAccountsQuery;


/**
 * This class defines the structure of the 'sgpi_accounts' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SgpiAccountsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.SgpiAccountsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'sgpi_accounts';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SgpiAccounts';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\SgpiAccounts';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.SgpiAccounts';

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
     * the column name for the sgpi_account_id field
     */
    public const COL_SGPI_ACCOUNT_ID = 'sgpi_accounts.sgpi_account_id';

    /**
     * the column name for the account_name field
     */
    public const COL_ACCOUNT_NAME = 'sgpi_accounts.account_name';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'sgpi_accounts.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'sgpi_accounts.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'sgpi_accounts.updated_at';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'sgpi_accounts.employee_id';

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
        self::TYPE_PHPNAME       => ['SgpiAccountId', 'AccountName', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'EmployeeId', ],
        self::TYPE_CAMELNAME     => ['sgpiAccountId', 'accountName', 'companyId', 'createdAt', 'updatedAt', 'employeeId', ],
        self::TYPE_COLNAME       => [SgpiAccountsTableMap::COL_SGPI_ACCOUNT_ID, SgpiAccountsTableMap::COL_ACCOUNT_NAME, SgpiAccountsTableMap::COL_COMPANY_ID, SgpiAccountsTableMap::COL_CREATED_AT, SgpiAccountsTableMap::COL_UPDATED_AT, SgpiAccountsTableMap::COL_EMPLOYEE_ID, ],
        self::TYPE_FIELDNAME     => ['sgpi_account_id', 'account_name', 'company_id', 'created_at', 'updated_at', 'employee_id', ],
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
        self::TYPE_PHPNAME       => ['SgpiAccountId' => 0, 'AccountName' => 1, 'CompanyId' => 2, 'CreatedAt' => 3, 'UpdatedAt' => 4, 'EmployeeId' => 5, ],
        self::TYPE_CAMELNAME     => ['sgpiAccountId' => 0, 'accountName' => 1, 'companyId' => 2, 'createdAt' => 3, 'updatedAt' => 4, 'employeeId' => 5, ],
        self::TYPE_COLNAME       => [SgpiAccountsTableMap::COL_SGPI_ACCOUNT_ID => 0, SgpiAccountsTableMap::COL_ACCOUNT_NAME => 1, SgpiAccountsTableMap::COL_COMPANY_ID => 2, SgpiAccountsTableMap::COL_CREATED_AT => 3, SgpiAccountsTableMap::COL_UPDATED_AT => 4, SgpiAccountsTableMap::COL_EMPLOYEE_ID => 5, ],
        self::TYPE_FIELDNAME     => ['sgpi_account_id' => 0, 'account_name' => 1, 'company_id' => 2, 'created_at' => 3, 'updated_at' => 4, 'employee_id' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'SgpiAccountId' => 'SGPI_ACCOUNT_ID',
        'SgpiAccounts.SgpiAccountId' => 'SGPI_ACCOUNT_ID',
        'sgpiAccountId' => 'SGPI_ACCOUNT_ID',
        'sgpiAccounts.sgpiAccountId' => 'SGPI_ACCOUNT_ID',
        'SgpiAccountsTableMap::COL_SGPI_ACCOUNT_ID' => 'SGPI_ACCOUNT_ID',
        'COL_SGPI_ACCOUNT_ID' => 'SGPI_ACCOUNT_ID',
        'sgpi_account_id' => 'SGPI_ACCOUNT_ID',
        'sgpi_accounts.sgpi_account_id' => 'SGPI_ACCOUNT_ID',
        'AccountName' => 'ACCOUNT_NAME',
        'SgpiAccounts.AccountName' => 'ACCOUNT_NAME',
        'accountName' => 'ACCOUNT_NAME',
        'sgpiAccounts.accountName' => 'ACCOUNT_NAME',
        'SgpiAccountsTableMap::COL_ACCOUNT_NAME' => 'ACCOUNT_NAME',
        'COL_ACCOUNT_NAME' => 'ACCOUNT_NAME',
        'account_name' => 'ACCOUNT_NAME',
        'sgpi_accounts.account_name' => 'ACCOUNT_NAME',
        'CompanyId' => 'COMPANY_ID',
        'SgpiAccounts.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'sgpiAccounts.companyId' => 'COMPANY_ID',
        'SgpiAccountsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'sgpi_accounts.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'SgpiAccounts.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'sgpiAccounts.createdAt' => 'CREATED_AT',
        'SgpiAccountsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'sgpi_accounts.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SgpiAccounts.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'sgpiAccounts.updatedAt' => 'UPDATED_AT',
        'SgpiAccountsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'sgpi_accounts.updated_at' => 'UPDATED_AT',
        'EmployeeId' => 'EMPLOYEE_ID',
        'SgpiAccounts.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'sgpiAccounts.employeeId' => 'EMPLOYEE_ID',
        'SgpiAccountsTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'sgpi_accounts.employee_id' => 'EMPLOYEE_ID',
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
        $this->setName('sgpi_accounts');
        $this->setPhpName('SgpiAccounts');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\SgpiAccounts');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('sgpi_accounts_sgpi_account_id_seq');
        // columns
        $this->addPrimaryKey('sgpi_account_id', 'SgpiAccountId', 'INTEGER', true, null, null);
        $this->addColumn('account_name', 'AccountName', 'VARCHAR', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, 0);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('employee_id', 'EmployeeId', 'INTEGER', false, null, null);
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
), null, null, null, false);
        $this->addRelation('SgpiTrans', '\\entities\\SgpiTrans', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':sgpi_account_id',
    1 => ':sgpi_account_id',
  ),
), null, null, 'SgpiTranss', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiAccountId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiAccountId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiAccountId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiAccountId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiAccountId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiAccountId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('SgpiAccountId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SgpiAccountsTableMap::CLASS_DEFAULT : SgpiAccountsTableMap::OM_CLASS;
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
     * @return array (SgpiAccounts object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SgpiAccountsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SgpiAccountsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SgpiAccountsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SgpiAccountsTableMap::OM_CLASS;
            /** @var SgpiAccounts $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SgpiAccountsTableMap::addInstanceToPool($obj, $key);
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
            $key = SgpiAccountsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SgpiAccountsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SgpiAccounts $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SgpiAccountsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SgpiAccountsTableMap::COL_SGPI_ACCOUNT_ID);
            $criteria->addSelectColumn(SgpiAccountsTableMap::COL_ACCOUNT_NAME);
            $criteria->addSelectColumn(SgpiAccountsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(SgpiAccountsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SgpiAccountsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(SgpiAccountsTableMap::COL_EMPLOYEE_ID);
        } else {
            $criteria->addSelectColumn($alias . '.sgpi_account_id');
            $criteria->addSelectColumn($alias . '.account_name');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.employee_id');
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
            $criteria->removeSelectColumn(SgpiAccountsTableMap::COL_SGPI_ACCOUNT_ID);
            $criteria->removeSelectColumn(SgpiAccountsTableMap::COL_ACCOUNT_NAME);
            $criteria->removeSelectColumn(SgpiAccountsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(SgpiAccountsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SgpiAccountsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(SgpiAccountsTableMap::COL_EMPLOYEE_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.sgpi_account_id');
            $criteria->removeSelectColumn($alias . '.account_name');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.employee_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(SgpiAccountsTableMap::DATABASE_NAME)->getTable(SgpiAccountsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SgpiAccounts or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SgpiAccounts object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SgpiAccountsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\SgpiAccounts) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SgpiAccountsTableMap::DATABASE_NAME);
            $criteria->add(SgpiAccountsTableMap::COL_SGPI_ACCOUNT_ID, (array) $values, Criteria::IN);
        }

        $query = SgpiAccountsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SgpiAccountsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SgpiAccountsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sgpi_accounts table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SgpiAccountsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SgpiAccounts or Criteria object.
     *
     * @param mixed $criteria Criteria or SgpiAccounts object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SgpiAccountsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SgpiAccounts object
        }

        if ($criteria->containsKey(SgpiAccountsTableMap::COL_SGPI_ACCOUNT_ID) && $criteria->keyContainsValue(SgpiAccountsTableMap::COL_SGPI_ACCOUNT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SgpiAccountsTableMap::COL_SGPI_ACCOUNT_ID.')');
        }


        // Set the correct dbName
        $query = SgpiAccountsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
