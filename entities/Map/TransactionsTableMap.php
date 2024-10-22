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
use entities\Transactions;
use entities\TransactionsQuery;


/**
 * This class defines the structure of the 'transactions' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class TransactionsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.TransactionsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'transactions';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Transactions';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Transactions';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Transactions';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the transaction_id field
     */
    public const COL_TRANSACTION_ID = 'transactions.transaction_id';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'transactions.employee_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'transactions.company_id';

    /**
     * the column name for the date field
     */
    public const COL_DATE = 'transactions.date';

    /**
     * the column name for the type field
     */
    public const COL_TYPE = 'transactions.type';

    /**
     * the column name for the description field
     */
    public const COL_DESCRIPTION = 'transactions.description';

    /**
     * the column name for the balance field
     */
    public const COL_BALANCE = 'transactions.balance';

    /**
     * the column name for the actual_amount field
     */
    public const COL_ACTUAL_AMOUNT = 'transactions.actual_amount';

    /**
     * the column name for the created_by field
     */
    public const COL_CREATED_BY = 'transactions.created_by';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'transactions.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'transactions.updated_at';

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
        self::TYPE_PHPNAME       => ['TransactionId', 'EmployeeId', 'CompanyId', 'Date', 'Type', 'Description', 'Balance', 'ActualAmount', 'CreatedBy', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['transactionId', 'employeeId', 'companyId', 'date', 'type', 'description', 'balance', 'actualAmount', 'createdBy', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [TransactionsTableMap::COL_TRANSACTION_ID, TransactionsTableMap::COL_EMPLOYEE_ID, TransactionsTableMap::COL_COMPANY_ID, TransactionsTableMap::COL_DATE, TransactionsTableMap::COL_TYPE, TransactionsTableMap::COL_DESCRIPTION, TransactionsTableMap::COL_BALANCE, TransactionsTableMap::COL_ACTUAL_AMOUNT, TransactionsTableMap::COL_CREATED_BY, TransactionsTableMap::COL_CREATED_AT, TransactionsTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['transaction_id', 'employee_id', 'company_id', 'date', 'type', 'description', 'balance', 'actual_amount', 'created_by', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
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
        self::TYPE_PHPNAME       => ['TransactionId' => 0, 'EmployeeId' => 1, 'CompanyId' => 2, 'Date' => 3, 'Type' => 4, 'Description' => 5, 'Balance' => 6, 'ActualAmount' => 7, 'CreatedBy' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, ],
        self::TYPE_CAMELNAME     => ['transactionId' => 0, 'employeeId' => 1, 'companyId' => 2, 'date' => 3, 'type' => 4, 'description' => 5, 'balance' => 6, 'actualAmount' => 7, 'createdBy' => 8, 'createdAt' => 9, 'updatedAt' => 10, ],
        self::TYPE_COLNAME       => [TransactionsTableMap::COL_TRANSACTION_ID => 0, TransactionsTableMap::COL_EMPLOYEE_ID => 1, TransactionsTableMap::COL_COMPANY_ID => 2, TransactionsTableMap::COL_DATE => 3, TransactionsTableMap::COL_TYPE => 4, TransactionsTableMap::COL_DESCRIPTION => 5, TransactionsTableMap::COL_BALANCE => 6, TransactionsTableMap::COL_ACTUAL_AMOUNT => 7, TransactionsTableMap::COL_CREATED_BY => 8, TransactionsTableMap::COL_CREATED_AT => 9, TransactionsTableMap::COL_UPDATED_AT => 10, ],
        self::TYPE_FIELDNAME     => ['transaction_id' => 0, 'employee_id' => 1, 'company_id' => 2, 'date' => 3, 'type' => 4, 'description' => 5, 'balance' => 6, 'actual_amount' => 7, 'created_by' => 8, 'created_at' => 9, 'updated_at' => 10, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'TransactionId' => 'TRANSACTION_ID',
        'Transactions.TransactionId' => 'TRANSACTION_ID',
        'transactionId' => 'TRANSACTION_ID',
        'transactions.transactionId' => 'TRANSACTION_ID',
        'TransactionsTableMap::COL_TRANSACTION_ID' => 'TRANSACTION_ID',
        'COL_TRANSACTION_ID' => 'TRANSACTION_ID',
        'transaction_id' => 'TRANSACTION_ID',
        'transactions.transaction_id' => 'TRANSACTION_ID',
        'EmployeeId' => 'EMPLOYEE_ID',
        'Transactions.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'transactions.employeeId' => 'EMPLOYEE_ID',
        'TransactionsTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'transactions.employee_id' => 'EMPLOYEE_ID',
        'CompanyId' => 'COMPANY_ID',
        'Transactions.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'transactions.companyId' => 'COMPANY_ID',
        'TransactionsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'transactions.company_id' => 'COMPANY_ID',
        'Date' => 'DATE',
        'Transactions.Date' => 'DATE',
        'date' => 'DATE',
        'transactions.date' => 'DATE',
        'TransactionsTableMap::COL_DATE' => 'DATE',
        'COL_DATE' => 'DATE',
        'Type' => 'TYPE',
        'Transactions.Type' => 'TYPE',
        'type' => 'TYPE',
        'transactions.type' => 'TYPE',
        'TransactionsTableMap::COL_TYPE' => 'TYPE',
        'COL_TYPE' => 'TYPE',
        'Description' => 'DESCRIPTION',
        'Transactions.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'transactions.description' => 'DESCRIPTION',
        'TransactionsTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'Balance' => 'BALANCE',
        'Transactions.Balance' => 'BALANCE',
        'balance' => 'BALANCE',
        'transactions.balance' => 'BALANCE',
        'TransactionsTableMap::COL_BALANCE' => 'BALANCE',
        'COL_BALANCE' => 'BALANCE',
        'ActualAmount' => 'ACTUAL_AMOUNT',
        'Transactions.ActualAmount' => 'ACTUAL_AMOUNT',
        'actualAmount' => 'ACTUAL_AMOUNT',
        'transactions.actualAmount' => 'ACTUAL_AMOUNT',
        'TransactionsTableMap::COL_ACTUAL_AMOUNT' => 'ACTUAL_AMOUNT',
        'COL_ACTUAL_AMOUNT' => 'ACTUAL_AMOUNT',
        'actual_amount' => 'ACTUAL_AMOUNT',
        'transactions.actual_amount' => 'ACTUAL_AMOUNT',
        'CreatedBy' => 'CREATED_BY',
        'Transactions.CreatedBy' => 'CREATED_BY',
        'createdBy' => 'CREATED_BY',
        'transactions.createdBy' => 'CREATED_BY',
        'TransactionsTableMap::COL_CREATED_BY' => 'CREATED_BY',
        'COL_CREATED_BY' => 'CREATED_BY',
        'created_by' => 'CREATED_BY',
        'transactions.created_by' => 'CREATED_BY',
        'CreatedAt' => 'CREATED_AT',
        'Transactions.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'transactions.createdAt' => 'CREATED_AT',
        'TransactionsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'transactions.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Transactions.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'transactions.updatedAt' => 'UPDATED_AT',
        'TransactionsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'transactions.updated_at' => 'UPDATED_AT',
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
        $this->setName('transactions');
        $this->setPhpName('Transactions');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Transactions');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('transactions_transaction_id_seq');
        // columns
        $this->addPrimaryKey('transaction_id', 'TransactionId', 'INTEGER', true, null, null);
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', true, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, 0);
        $this->addColumn('date', 'Date', 'DATE', true, null, null);
        $this->addColumn('type', 'Type', 'INTEGER', false, null, 1);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addColumn('balance', 'Balance', 'DECIMAL', true, 10, 0.00);
        $this->addColumn('actual_amount', 'ActualAmount', 'DECIMAL', true, 10, 0.00);
        $this->addForeignKey('created_by', 'CreatedBy', 'INTEGER', 'employee', 'employee_id', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
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
        $this->addRelation('EmployeeRelatedByEmployeeId', '\\entities\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, null, false);
        $this->addRelation('EmployeeRelatedByCreatedBy', '\\entities\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':created_by',
    1 => ':employee_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TransactionId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TransactionId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TransactionId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TransactionId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TransactionId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('TransactionId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('TransactionId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? TransactionsTableMap::CLASS_DEFAULT : TransactionsTableMap::OM_CLASS;
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
     * @return array (Transactions object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = TransactionsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = TransactionsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + TransactionsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TransactionsTableMap::OM_CLASS;
            /** @var Transactions $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            TransactionsTableMap::addInstanceToPool($obj, $key);
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
            $key = TransactionsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = TransactionsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Transactions $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TransactionsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(TransactionsTableMap::COL_TRANSACTION_ID);
            $criteria->addSelectColumn(TransactionsTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(TransactionsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(TransactionsTableMap::COL_DATE);
            $criteria->addSelectColumn(TransactionsTableMap::COL_TYPE);
            $criteria->addSelectColumn(TransactionsTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(TransactionsTableMap::COL_BALANCE);
            $criteria->addSelectColumn(TransactionsTableMap::COL_ACTUAL_AMOUNT);
            $criteria->addSelectColumn(TransactionsTableMap::COL_CREATED_BY);
            $criteria->addSelectColumn(TransactionsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(TransactionsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.transaction_id');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.date');
            $criteria->addSelectColumn($alias . '.type');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.balance');
            $criteria->addSelectColumn($alias . '.actual_amount');
            $criteria->addSelectColumn($alias . '.created_by');
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
            $criteria->removeSelectColumn(TransactionsTableMap::COL_TRANSACTION_ID);
            $criteria->removeSelectColumn(TransactionsTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(TransactionsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(TransactionsTableMap::COL_DATE);
            $criteria->removeSelectColumn(TransactionsTableMap::COL_TYPE);
            $criteria->removeSelectColumn(TransactionsTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(TransactionsTableMap::COL_BALANCE);
            $criteria->removeSelectColumn(TransactionsTableMap::COL_ACTUAL_AMOUNT);
            $criteria->removeSelectColumn(TransactionsTableMap::COL_CREATED_BY);
            $criteria->removeSelectColumn(TransactionsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(TransactionsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.transaction_id');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.date');
            $criteria->removeSelectColumn($alias . '.type');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.balance');
            $criteria->removeSelectColumn($alias . '.actual_amount');
            $criteria->removeSelectColumn($alias . '.created_by');
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
        return Propel::getServiceContainer()->getDatabaseMap(TransactionsTableMap::DATABASE_NAME)->getTable(TransactionsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Transactions or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Transactions object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(TransactionsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Transactions) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(TransactionsTableMap::DATABASE_NAME);
            $criteria->add(TransactionsTableMap::COL_TRANSACTION_ID, (array) $values, Criteria::IN);
        }

        $query = TransactionsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            TransactionsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                TransactionsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the transactions table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return TransactionsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Transactions or Criteria object.
     *
     * @param mixed $criteria Criteria or Transactions object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TransactionsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Transactions object
        }

        if ($criteria->containsKey(TransactionsTableMap::COL_TRANSACTION_ID) && $criteria->keyContainsValue(TransactionsTableMap::COL_TRANSACTION_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.TransactionsTableMap::COL_TRANSACTION_ID.')');
        }


        // Set the correct dbName
        $query = TransactionsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
