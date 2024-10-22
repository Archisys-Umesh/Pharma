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
use entities\ExpensePayments;
use entities\ExpensePaymentsQuery;


/**
 * This class defines the structure of the 'expense_payments' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ExpensePaymentsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.ExpensePaymentsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'expense_payments';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'ExpensePayments';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\ExpensePayments';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.ExpensePayments';

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
     * the column name for the expense_payment_id field
     */
    public const COL_EXPENSE_PAYMENT_ID = 'expense_payments.expense_payment_id';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'expense_payments.employee_id';

    /**
     * the column name for the expense_month field
     */
    public const COL_EXPENSE_MONTH = 'expense_payments.expense_month';

    /**
     * the column name for the paid_status field
     */
    public const COL_PAID_STATUS = 'expense_payments.paid_status';

    /**
     * the column name for the lot_no field
     */
    public const COL_LOT_NO = 'expense_payments.lot_no';

    /**
     * the column name for the transaction_id field
     */
    public const COL_TRANSACTION_ID = 'expense_payments.transaction_id';

    /**
     * the column name for the paid_amount field
     */
    public const COL_PAID_AMOUNT = 'expense_payments.paid_amount';

    /**
     * the column name for the remark field
     */
    public const COL_REMARK = 'expense_payments.remark';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'expense_payments.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'expense_payments.updated_at';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'expense_payments.company_id';

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
        self::TYPE_PHPNAME       => ['ExpensePaymentId', 'EmployeeId', 'ExpenseMonth', 'PaidStatus', 'LotNo', 'TransactionId', 'PaidAmount', 'Remark', 'CreatedAt', 'UpdatedAt', 'CompanyId', ],
        self::TYPE_CAMELNAME     => ['expensePaymentId', 'employeeId', 'expenseMonth', 'paidStatus', 'lotNo', 'transactionId', 'paidAmount', 'remark', 'createdAt', 'updatedAt', 'companyId', ],
        self::TYPE_COLNAME       => [ExpensePaymentsTableMap::COL_EXPENSE_PAYMENT_ID, ExpensePaymentsTableMap::COL_EMPLOYEE_ID, ExpensePaymentsTableMap::COL_EXPENSE_MONTH, ExpensePaymentsTableMap::COL_PAID_STATUS, ExpensePaymentsTableMap::COL_LOT_NO, ExpensePaymentsTableMap::COL_TRANSACTION_ID, ExpensePaymentsTableMap::COL_PAID_AMOUNT, ExpensePaymentsTableMap::COL_REMARK, ExpensePaymentsTableMap::COL_CREATED_AT, ExpensePaymentsTableMap::COL_UPDATED_AT, ExpensePaymentsTableMap::COL_COMPANY_ID, ],
        self::TYPE_FIELDNAME     => ['expense_payment_id', 'employee_id', 'expense_month', 'paid_status', 'lot_no', 'transaction_id', 'paid_amount', 'remark', 'created_at', 'updated_at', 'company_id', ],
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
        self::TYPE_PHPNAME       => ['ExpensePaymentId' => 0, 'EmployeeId' => 1, 'ExpenseMonth' => 2, 'PaidStatus' => 3, 'LotNo' => 4, 'TransactionId' => 5, 'PaidAmount' => 6, 'Remark' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, 'CompanyId' => 10, ],
        self::TYPE_CAMELNAME     => ['expensePaymentId' => 0, 'employeeId' => 1, 'expenseMonth' => 2, 'paidStatus' => 3, 'lotNo' => 4, 'transactionId' => 5, 'paidAmount' => 6, 'remark' => 7, 'createdAt' => 8, 'updatedAt' => 9, 'companyId' => 10, ],
        self::TYPE_COLNAME       => [ExpensePaymentsTableMap::COL_EXPENSE_PAYMENT_ID => 0, ExpensePaymentsTableMap::COL_EMPLOYEE_ID => 1, ExpensePaymentsTableMap::COL_EXPENSE_MONTH => 2, ExpensePaymentsTableMap::COL_PAID_STATUS => 3, ExpensePaymentsTableMap::COL_LOT_NO => 4, ExpensePaymentsTableMap::COL_TRANSACTION_ID => 5, ExpensePaymentsTableMap::COL_PAID_AMOUNT => 6, ExpensePaymentsTableMap::COL_REMARK => 7, ExpensePaymentsTableMap::COL_CREATED_AT => 8, ExpensePaymentsTableMap::COL_UPDATED_AT => 9, ExpensePaymentsTableMap::COL_COMPANY_ID => 10, ],
        self::TYPE_FIELDNAME     => ['expense_payment_id' => 0, 'employee_id' => 1, 'expense_month' => 2, 'paid_status' => 3, 'lot_no' => 4, 'transaction_id' => 5, 'paid_amount' => 6, 'remark' => 7, 'created_at' => 8, 'updated_at' => 9, 'company_id' => 10, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'ExpensePaymentId' => 'EXPENSE_PAYMENT_ID',
        'ExpensePayments.ExpensePaymentId' => 'EXPENSE_PAYMENT_ID',
        'expensePaymentId' => 'EXPENSE_PAYMENT_ID',
        'expensePayments.expensePaymentId' => 'EXPENSE_PAYMENT_ID',
        'ExpensePaymentsTableMap::COL_EXPENSE_PAYMENT_ID' => 'EXPENSE_PAYMENT_ID',
        'COL_EXPENSE_PAYMENT_ID' => 'EXPENSE_PAYMENT_ID',
        'expense_payment_id' => 'EXPENSE_PAYMENT_ID',
        'expense_payments.expense_payment_id' => 'EXPENSE_PAYMENT_ID',
        'EmployeeId' => 'EMPLOYEE_ID',
        'ExpensePayments.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'expensePayments.employeeId' => 'EMPLOYEE_ID',
        'ExpensePaymentsTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'expense_payments.employee_id' => 'EMPLOYEE_ID',
        'ExpenseMonth' => 'EXPENSE_MONTH',
        'ExpensePayments.ExpenseMonth' => 'EXPENSE_MONTH',
        'expenseMonth' => 'EXPENSE_MONTH',
        'expensePayments.expenseMonth' => 'EXPENSE_MONTH',
        'ExpensePaymentsTableMap::COL_EXPENSE_MONTH' => 'EXPENSE_MONTH',
        'COL_EXPENSE_MONTH' => 'EXPENSE_MONTH',
        'expense_month' => 'EXPENSE_MONTH',
        'expense_payments.expense_month' => 'EXPENSE_MONTH',
        'PaidStatus' => 'PAID_STATUS',
        'ExpensePayments.PaidStatus' => 'PAID_STATUS',
        'paidStatus' => 'PAID_STATUS',
        'expensePayments.paidStatus' => 'PAID_STATUS',
        'ExpensePaymentsTableMap::COL_PAID_STATUS' => 'PAID_STATUS',
        'COL_PAID_STATUS' => 'PAID_STATUS',
        'paid_status' => 'PAID_STATUS',
        'expense_payments.paid_status' => 'PAID_STATUS',
        'LotNo' => 'LOT_NO',
        'ExpensePayments.LotNo' => 'LOT_NO',
        'lotNo' => 'LOT_NO',
        'expensePayments.lotNo' => 'LOT_NO',
        'ExpensePaymentsTableMap::COL_LOT_NO' => 'LOT_NO',
        'COL_LOT_NO' => 'LOT_NO',
        'lot_no' => 'LOT_NO',
        'expense_payments.lot_no' => 'LOT_NO',
        'TransactionId' => 'TRANSACTION_ID',
        'ExpensePayments.TransactionId' => 'TRANSACTION_ID',
        'transactionId' => 'TRANSACTION_ID',
        'expensePayments.transactionId' => 'TRANSACTION_ID',
        'ExpensePaymentsTableMap::COL_TRANSACTION_ID' => 'TRANSACTION_ID',
        'COL_TRANSACTION_ID' => 'TRANSACTION_ID',
        'transaction_id' => 'TRANSACTION_ID',
        'expense_payments.transaction_id' => 'TRANSACTION_ID',
        'PaidAmount' => 'PAID_AMOUNT',
        'ExpensePayments.PaidAmount' => 'PAID_AMOUNT',
        'paidAmount' => 'PAID_AMOUNT',
        'expensePayments.paidAmount' => 'PAID_AMOUNT',
        'ExpensePaymentsTableMap::COL_PAID_AMOUNT' => 'PAID_AMOUNT',
        'COL_PAID_AMOUNT' => 'PAID_AMOUNT',
        'paid_amount' => 'PAID_AMOUNT',
        'expense_payments.paid_amount' => 'PAID_AMOUNT',
        'Remark' => 'REMARK',
        'ExpensePayments.Remark' => 'REMARK',
        'remark' => 'REMARK',
        'expensePayments.remark' => 'REMARK',
        'ExpensePaymentsTableMap::COL_REMARK' => 'REMARK',
        'COL_REMARK' => 'REMARK',
        'expense_payments.remark' => 'REMARK',
        'CreatedAt' => 'CREATED_AT',
        'ExpensePayments.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'expensePayments.createdAt' => 'CREATED_AT',
        'ExpensePaymentsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'expense_payments.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'ExpensePayments.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'expensePayments.updatedAt' => 'UPDATED_AT',
        'ExpensePaymentsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'expense_payments.updated_at' => 'UPDATED_AT',
        'CompanyId' => 'COMPANY_ID',
        'ExpensePayments.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'expensePayments.companyId' => 'COMPANY_ID',
        'ExpensePaymentsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'expense_payments.company_id' => 'COMPANY_ID',
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
        $this->setName('expense_payments');
        $this->setPhpName('ExpensePayments');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\ExpensePayments');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('expense_payments_expense_payment_id_seq');
        // columns
        $this->addPrimaryKey('expense_payment_id', 'ExpensePaymentId', 'INTEGER', true, null, null);
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', false, null, null);
        $this->addColumn('expense_month', 'ExpenseMonth', 'VARCHAR', false, null, null);
        $this->addColumn('paid_status', 'PaidStatus', 'VARCHAR', false, null, null);
        $this->addColumn('lot_no', 'LotNo', 'VARCHAR', false, null, null);
        $this->addColumn('transaction_id', 'TransactionId', 'VARCHAR', false, null, null);
        $this->addColumn('paid_amount', 'PaidAmount', 'VARCHAR', false, null, null);
        $this->addColumn('remark', 'Remark', 'LONGVARCHAR', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Employee', '\\entities\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpensePaymentId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpensePaymentId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpensePaymentId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpensePaymentId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpensePaymentId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ExpensePaymentId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('ExpensePaymentId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ExpensePaymentsTableMap::CLASS_DEFAULT : ExpensePaymentsTableMap::OM_CLASS;
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
     * @return array (ExpensePayments object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ExpensePaymentsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ExpensePaymentsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ExpensePaymentsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ExpensePaymentsTableMap::OM_CLASS;
            /** @var ExpensePayments $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ExpensePaymentsTableMap::addInstanceToPool($obj, $key);
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
            $key = ExpensePaymentsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ExpensePaymentsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ExpensePayments $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ExpensePaymentsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ExpensePaymentsTableMap::COL_EXPENSE_PAYMENT_ID);
            $criteria->addSelectColumn(ExpensePaymentsTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(ExpensePaymentsTableMap::COL_EXPENSE_MONTH);
            $criteria->addSelectColumn(ExpensePaymentsTableMap::COL_PAID_STATUS);
            $criteria->addSelectColumn(ExpensePaymentsTableMap::COL_LOT_NO);
            $criteria->addSelectColumn(ExpensePaymentsTableMap::COL_TRANSACTION_ID);
            $criteria->addSelectColumn(ExpensePaymentsTableMap::COL_PAID_AMOUNT);
            $criteria->addSelectColumn(ExpensePaymentsTableMap::COL_REMARK);
            $criteria->addSelectColumn(ExpensePaymentsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(ExpensePaymentsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(ExpensePaymentsTableMap::COL_COMPANY_ID);
        } else {
            $criteria->addSelectColumn($alias . '.expense_payment_id');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.expense_month');
            $criteria->addSelectColumn($alias . '.paid_status');
            $criteria->addSelectColumn($alias . '.lot_no');
            $criteria->addSelectColumn($alias . '.transaction_id');
            $criteria->addSelectColumn($alias . '.paid_amount');
            $criteria->addSelectColumn($alias . '.remark');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.company_id');
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
            $criteria->removeSelectColumn(ExpensePaymentsTableMap::COL_EXPENSE_PAYMENT_ID);
            $criteria->removeSelectColumn(ExpensePaymentsTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(ExpensePaymentsTableMap::COL_EXPENSE_MONTH);
            $criteria->removeSelectColumn(ExpensePaymentsTableMap::COL_PAID_STATUS);
            $criteria->removeSelectColumn(ExpensePaymentsTableMap::COL_LOT_NO);
            $criteria->removeSelectColumn(ExpensePaymentsTableMap::COL_TRANSACTION_ID);
            $criteria->removeSelectColumn(ExpensePaymentsTableMap::COL_PAID_AMOUNT);
            $criteria->removeSelectColumn(ExpensePaymentsTableMap::COL_REMARK);
            $criteria->removeSelectColumn(ExpensePaymentsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(ExpensePaymentsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(ExpensePaymentsTableMap::COL_COMPANY_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.expense_payment_id');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.expense_month');
            $criteria->removeSelectColumn($alias . '.paid_status');
            $criteria->removeSelectColumn($alias . '.lot_no');
            $criteria->removeSelectColumn($alias . '.transaction_id');
            $criteria->removeSelectColumn($alias . '.paid_amount');
            $criteria->removeSelectColumn($alias . '.remark');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.company_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(ExpensePaymentsTableMap::DATABASE_NAME)->getTable(ExpensePaymentsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a ExpensePayments or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or ExpensePayments object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ExpensePaymentsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\ExpensePayments) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ExpensePaymentsTableMap::DATABASE_NAME);
            $criteria->add(ExpensePaymentsTableMap::COL_EXPENSE_PAYMENT_ID, (array) $values, Criteria::IN);
        }

        $query = ExpensePaymentsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ExpensePaymentsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ExpensePaymentsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the expense_payments table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ExpensePaymentsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ExpensePayments or Criteria object.
     *
     * @param mixed $criteria Criteria or ExpensePayments object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpensePaymentsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ExpensePayments object
        }

        if ($criteria->containsKey(ExpensePaymentsTableMap::COL_EXPENSE_PAYMENT_ID) && $criteria->keyContainsValue(ExpensePaymentsTableMap::COL_EXPENSE_PAYMENT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ExpensePaymentsTableMap::COL_EXPENSE_PAYMENT_ID.')');
        }


        // Set the correct dbName
        $query = ExpensePaymentsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
