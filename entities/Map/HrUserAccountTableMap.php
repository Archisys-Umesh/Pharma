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
use entities\HrUserAccount;
use entities\HrUserAccountQuery;


/**
 * This class defines the structure of the 'hr_user_account' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class HrUserAccountTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.HrUserAccountTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'hr_user_account';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'HrUserAccount';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\HrUserAccount';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.HrUserAccount';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 14;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 14;

    /**
     * the column name for the hrua_id field
     */
    public const COL_HRUA_ID = 'hr_user_account.hrua_id';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'hr_user_account.employee_id';

    /**
     * the column name for the personal_bank field
     */
    public const COL_PERSONAL_BANK = 'hr_user_account.personal_bank';

    /**
     * the column name for the personal_account_number field
     */
    public const COL_PERSONAL_ACCOUNT_NUMBER = 'hr_user_account.personal_account_number';

    /**
     * the column name for the pf_esic_contribution field
     */
    public const COL_PF_ESIC_CONTRIBUTION = 'hr_user_account.pf_esic_contribution';

    /**
     * the column name for the pf_number field
     */
    public const COL_PF_NUMBER = 'hr_user_account.pf_number';

    /**
     * the column name for the esci_number field
     */
    public const COL_ESCI_NUMBER = 'hr_user_account.esci_number';

    /**
     * the column name for the gross_salary field
     */
    public const COL_GROSS_SALARY = 'hr_user_account.gross_salary';

    /**
     * the column name for the payment_mode field
     */
    public const COL_PAYMENT_MODE = 'hr_user_account.payment_mode';

    /**
     * the column name for the salary_bank field
     */
    public const COL_SALARY_BANK = 'hr_user_account.salary_bank';

    /**
     * the column name for the salary_account_number field
     */
    public const COL_SALARY_ACCOUNT_NUMBER = 'hr_user_account.salary_account_number';

    /**
     * the column name for the tds_status field
     */
    public const COL_TDS_STATUS = 'hr_user_account.tds_status';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'hr_user_account.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'hr_user_account.updated_at';

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
        self::TYPE_PHPNAME       => ['HruaId', 'EmployeeId', 'PersonalBank', 'PersonalAccountNumber', 'PfEsicContribution', 'PfNumber', 'EsciNumber', 'GrossSalary', 'PaymentMode', 'SalaryBank', 'SalaryAccountNumber', 'TdsStatus', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['hruaId', 'employeeId', 'personalBank', 'personalAccountNumber', 'pfEsicContribution', 'pfNumber', 'esciNumber', 'grossSalary', 'paymentMode', 'salaryBank', 'salaryAccountNumber', 'tdsStatus', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [HrUserAccountTableMap::COL_HRUA_ID, HrUserAccountTableMap::COL_EMPLOYEE_ID, HrUserAccountTableMap::COL_PERSONAL_BANK, HrUserAccountTableMap::COL_PERSONAL_ACCOUNT_NUMBER, HrUserAccountTableMap::COL_PF_ESIC_CONTRIBUTION, HrUserAccountTableMap::COL_PF_NUMBER, HrUserAccountTableMap::COL_ESCI_NUMBER, HrUserAccountTableMap::COL_GROSS_SALARY, HrUserAccountTableMap::COL_PAYMENT_MODE, HrUserAccountTableMap::COL_SALARY_BANK, HrUserAccountTableMap::COL_SALARY_ACCOUNT_NUMBER, HrUserAccountTableMap::COL_TDS_STATUS, HrUserAccountTableMap::COL_CREATED_AT, HrUserAccountTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['hrua_id', 'employee_id', 'personal_bank', 'personal_account_number', 'pf_esic_contribution', 'pf_number', 'esci_number', 'gross_salary', 'payment_mode', 'salary_bank', 'salary_account_number', 'tds_status', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
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
        self::TYPE_PHPNAME       => ['HruaId' => 0, 'EmployeeId' => 1, 'PersonalBank' => 2, 'PersonalAccountNumber' => 3, 'PfEsicContribution' => 4, 'PfNumber' => 5, 'EsciNumber' => 6, 'GrossSalary' => 7, 'PaymentMode' => 8, 'SalaryBank' => 9, 'SalaryAccountNumber' => 10, 'TdsStatus' => 11, 'CreatedAt' => 12, 'UpdatedAt' => 13, ],
        self::TYPE_CAMELNAME     => ['hruaId' => 0, 'employeeId' => 1, 'personalBank' => 2, 'personalAccountNumber' => 3, 'pfEsicContribution' => 4, 'pfNumber' => 5, 'esciNumber' => 6, 'grossSalary' => 7, 'paymentMode' => 8, 'salaryBank' => 9, 'salaryAccountNumber' => 10, 'tdsStatus' => 11, 'createdAt' => 12, 'updatedAt' => 13, ],
        self::TYPE_COLNAME       => [HrUserAccountTableMap::COL_HRUA_ID => 0, HrUserAccountTableMap::COL_EMPLOYEE_ID => 1, HrUserAccountTableMap::COL_PERSONAL_BANK => 2, HrUserAccountTableMap::COL_PERSONAL_ACCOUNT_NUMBER => 3, HrUserAccountTableMap::COL_PF_ESIC_CONTRIBUTION => 4, HrUserAccountTableMap::COL_PF_NUMBER => 5, HrUserAccountTableMap::COL_ESCI_NUMBER => 6, HrUserAccountTableMap::COL_GROSS_SALARY => 7, HrUserAccountTableMap::COL_PAYMENT_MODE => 8, HrUserAccountTableMap::COL_SALARY_BANK => 9, HrUserAccountTableMap::COL_SALARY_ACCOUNT_NUMBER => 10, HrUserAccountTableMap::COL_TDS_STATUS => 11, HrUserAccountTableMap::COL_CREATED_AT => 12, HrUserAccountTableMap::COL_UPDATED_AT => 13, ],
        self::TYPE_FIELDNAME     => ['hrua_id' => 0, 'employee_id' => 1, 'personal_bank' => 2, 'personal_account_number' => 3, 'pf_esic_contribution' => 4, 'pf_number' => 5, 'esci_number' => 6, 'gross_salary' => 7, 'payment_mode' => 8, 'salary_bank' => 9, 'salary_account_number' => 10, 'tds_status' => 11, 'created_at' => 12, 'updated_at' => 13, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'HruaId' => 'HRUA_ID',
        'HrUserAccount.HruaId' => 'HRUA_ID',
        'hruaId' => 'HRUA_ID',
        'hrUserAccount.hruaId' => 'HRUA_ID',
        'HrUserAccountTableMap::COL_HRUA_ID' => 'HRUA_ID',
        'COL_HRUA_ID' => 'HRUA_ID',
        'hrua_id' => 'HRUA_ID',
        'hr_user_account.hrua_id' => 'HRUA_ID',
        'EmployeeId' => 'EMPLOYEE_ID',
        'HrUserAccount.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'hrUserAccount.employeeId' => 'EMPLOYEE_ID',
        'HrUserAccountTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'hr_user_account.employee_id' => 'EMPLOYEE_ID',
        'PersonalBank' => 'PERSONAL_BANK',
        'HrUserAccount.PersonalBank' => 'PERSONAL_BANK',
        'personalBank' => 'PERSONAL_BANK',
        'hrUserAccount.personalBank' => 'PERSONAL_BANK',
        'HrUserAccountTableMap::COL_PERSONAL_BANK' => 'PERSONAL_BANK',
        'COL_PERSONAL_BANK' => 'PERSONAL_BANK',
        'personal_bank' => 'PERSONAL_BANK',
        'hr_user_account.personal_bank' => 'PERSONAL_BANK',
        'PersonalAccountNumber' => 'PERSONAL_ACCOUNT_NUMBER',
        'HrUserAccount.PersonalAccountNumber' => 'PERSONAL_ACCOUNT_NUMBER',
        'personalAccountNumber' => 'PERSONAL_ACCOUNT_NUMBER',
        'hrUserAccount.personalAccountNumber' => 'PERSONAL_ACCOUNT_NUMBER',
        'HrUserAccountTableMap::COL_PERSONAL_ACCOUNT_NUMBER' => 'PERSONAL_ACCOUNT_NUMBER',
        'COL_PERSONAL_ACCOUNT_NUMBER' => 'PERSONAL_ACCOUNT_NUMBER',
        'personal_account_number' => 'PERSONAL_ACCOUNT_NUMBER',
        'hr_user_account.personal_account_number' => 'PERSONAL_ACCOUNT_NUMBER',
        'PfEsicContribution' => 'PF_ESIC_CONTRIBUTION',
        'HrUserAccount.PfEsicContribution' => 'PF_ESIC_CONTRIBUTION',
        'pfEsicContribution' => 'PF_ESIC_CONTRIBUTION',
        'hrUserAccount.pfEsicContribution' => 'PF_ESIC_CONTRIBUTION',
        'HrUserAccountTableMap::COL_PF_ESIC_CONTRIBUTION' => 'PF_ESIC_CONTRIBUTION',
        'COL_PF_ESIC_CONTRIBUTION' => 'PF_ESIC_CONTRIBUTION',
        'pf_esic_contribution' => 'PF_ESIC_CONTRIBUTION',
        'hr_user_account.pf_esic_contribution' => 'PF_ESIC_CONTRIBUTION',
        'PfNumber' => 'PF_NUMBER',
        'HrUserAccount.PfNumber' => 'PF_NUMBER',
        'pfNumber' => 'PF_NUMBER',
        'hrUserAccount.pfNumber' => 'PF_NUMBER',
        'HrUserAccountTableMap::COL_PF_NUMBER' => 'PF_NUMBER',
        'COL_PF_NUMBER' => 'PF_NUMBER',
        'pf_number' => 'PF_NUMBER',
        'hr_user_account.pf_number' => 'PF_NUMBER',
        'EsciNumber' => 'ESCI_NUMBER',
        'HrUserAccount.EsciNumber' => 'ESCI_NUMBER',
        'esciNumber' => 'ESCI_NUMBER',
        'hrUserAccount.esciNumber' => 'ESCI_NUMBER',
        'HrUserAccountTableMap::COL_ESCI_NUMBER' => 'ESCI_NUMBER',
        'COL_ESCI_NUMBER' => 'ESCI_NUMBER',
        'esci_number' => 'ESCI_NUMBER',
        'hr_user_account.esci_number' => 'ESCI_NUMBER',
        'GrossSalary' => 'GROSS_SALARY',
        'HrUserAccount.GrossSalary' => 'GROSS_SALARY',
        'grossSalary' => 'GROSS_SALARY',
        'hrUserAccount.grossSalary' => 'GROSS_SALARY',
        'HrUserAccountTableMap::COL_GROSS_SALARY' => 'GROSS_SALARY',
        'COL_GROSS_SALARY' => 'GROSS_SALARY',
        'gross_salary' => 'GROSS_SALARY',
        'hr_user_account.gross_salary' => 'GROSS_SALARY',
        'PaymentMode' => 'PAYMENT_MODE',
        'HrUserAccount.PaymentMode' => 'PAYMENT_MODE',
        'paymentMode' => 'PAYMENT_MODE',
        'hrUserAccount.paymentMode' => 'PAYMENT_MODE',
        'HrUserAccountTableMap::COL_PAYMENT_MODE' => 'PAYMENT_MODE',
        'COL_PAYMENT_MODE' => 'PAYMENT_MODE',
        'payment_mode' => 'PAYMENT_MODE',
        'hr_user_account.payment_mode' => 'PAYMENT_MODE',
        'SalaryBank' => 'SALARY_BANK',
        'HrUserAccount.SalaryBank' => 'SALARY_BANK',
        'salaryBank' => 'SALARY_BANK',
        'hrUserAccount.salaryBank' => 'SALARY_BANK',
        'HrUserAccountTableMap::COL_SALARY_BANK' => 'SALARY_BANK',
        'COL_SALARY_BANK' => 'SALARY_BANK',
        'salary_bank' => 'SALARY_BANK',
        'hr_user_account.salary_bank' => 'SALARY_BANK',
        'SalaryAccountNumber' => 'SALARY_ACCOUNT_NUMBER',
        'HrUserAccount.SalaryAccountNumber' => 'SALARY_ACCOUNT_NUMBER',
        'salaryAccountNumber' => 'SALARY_ACCOUNT_NUMBER',
        'hrUserAccount.salaryAccountNumber' => 'SALARY_ACCOUNT_NUMBER',
        'HrUserAccountTableMap::COL_SALARY_ACCOUNT_NUMBER' => 'SALARY_ACCOUNT_NUMBER',
        'COL_SALARY_ACCOUNT_NUMBER' => 'SALARY_ACCOUNT_NUMBER',
        'salary_account_number' => 'SALARY_ACCOUNT_NUMBER',
        'hr_user_account.salary_account_number' => 'SALARY_ACCOUNT_NUMBER',
        'TdsStatus' => 'TDS_STATUS',
        'HrUserAccount.TdsStatus' => 'TDS_STATUS',
        'tdsStatus' => 'TDS_STATUS',
        'hrUserAccount.tdsStatus' => 'TDS_STATUS',
        'HrUserAccountTableMap::COL_TDS_STATUS' => 'TDS_STATUS',
        'COL_TDS_STATUS' => 'TDS_STATUS',
        'tds_status' => 'TDS_STATUS',
        'hr_user_account.tds_status' => 'TDS_STATUS',
        'CreatedAt' => 'CREATED_AT',
        'HrUserAccount.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'hrUserAccount.createdAt' => 'CREATED_AT',
        'HrUserAccountTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'hr_user_account.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'HrUserAccount.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'hrUserAccount.updatedAt' => 'UPDATED_AT',
        'HrUserAccountTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'hr_user_account.updated_at' => 'UPDATED_AT',
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
        $this->setName('hr_user_account');
        $this->setPhpName('HrUserAccount');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\HrUserAccount');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('hr_user_account_hrua_id_seq');
        // columns
        $this->addPrimaryKey('hrua_id', 'HruaId', 'INTEGER', true, null, null);
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', false, null, null);
        $this->addColumn('personal_bank', 'PersonalBank', 'VARCHAR', false, 255, null);
        $this->addColumn('personal_account_number', 'PersonalAccountNumber', 'VARCHAR', false, 50, null);
        $this->addColumn('pf_esic_contribution', 'PfEsicContribution', 'SMALLINT', false, null, null);
        $this->addColumn('pf_number', 'PfNumber', 'VARCHAR', false, 50, null);
        $this->addColumn('esci_number', 'EsciNumber', 'VARCHAR', false, 50, null);
        $this->addColumn('gross_salary', 'GrossSalary', 'DOUBLE', false, 53, null);
        $this->addColumn('payment_mode', 'PaymentMode', 'VARCHAR', false, 255, null);
        $this->addColumn('salary_bank', 'SalaryBank', 'VARCHAR', false, 255, null);
        $this->addColumn('salary_account_number', 'SalaryAccountNumber', 'VARCHAR', false, 255, null);
        $this->addColumn('tds_status', 'TdsStatus', 'SMALLINT', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HruaId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HruaId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HruaId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HruaId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HruaId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('HruaId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('HruaId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? HrUserAccountTableMap::CLASS_DEFAULT : HrUserAccountTableMap::OM_CLASS;
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
     * @return array (HrUserAccount object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = HrUserAccountTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = HrUserAccountTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + HrUserAccountTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = HrUserAccountTableMap::OM_CLASS;
            /** @var HrUserAccount $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            HrUserAccountTableMap::addInstanceToPool($obj, $key);
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
            $key = HrUserAccountTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = HrUserAccountTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var HrUserAccount $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                HrUserAccountTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(HrUserAccountTableMap::COL_HRUA_ID);
            $criteria->addSelectColumn(HrUserAccountTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(HrUserAccountTableMap::COL_PERSONAL_BANK);
            $criteria->addSelectColumn(HrUserAccountTableMap::COL_PERSONAL_ACCOUNT_NUMBER);
            $criteria->addSelectColumn(HrUserAccountTableMap::COL_PF_ESIC_CONTRIBUTION);
            $criteria->addSelectColumn(HrUserAccountTableMap::COL_PF_NUMBER);
            $criteria->addSelectColumn(HrUserAccountTableMap::COL_ESCI_NUMBER);
            $criteria->addSelectColumn(HrUserAccountTableMap::COL_GROSS_SALARY);
            $criteria->addSelectColumn(HrUserAccountTableMap::COL_PAYMENT_MODE);
            $criteria->addSelectColumn(HrUserAccountTableMap::COL_SALARY_BANK);
            $criteria->addSelectColumn(HrUserAccountTableMap::COL_SALARY_ACCOUNT_NUMBER);
            $criteria->addSelectColumn(HrUserAccountTableMap::COL_TDS_STATUS);
            $criteria->addSelectColumn(HrUserAccountTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(HrUserAccountTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.hrua_id');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.personal_bank');
            $criteria->addSelectColumn($alias . '.personal_account_number');
            $criteria->addSelectColumn($alias . '.pf_esic_contribution');
            $criteria->addSelectColumn($alias . '.pf_number');
            $criteria->addSelectColumn($alias . '.esci_number');
            $criteria->addSelectColumn($alias . '.gross_salary');
            $criteria->addSelectColumn($alias . '.payment_mode');
            $criteria->addSelectColumn($alias . '.salary_bank');
            $criteria->addSelectColumn($alias . '.salary_account_number');
            $criteria->addSelectColumn($alias . '.tds_status');
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
            $criteria->removeSelectColumn(HrUserAccountTableMap::COL_HRUA_ID);
            $criteria->removeSelectColumn(HrUserAccountTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(HrUserAccountTableMap::COL_PERSONAL_BANK);
            $criteria->removeSelectColumn(HrUserAccountTableMap::COL_PERSONAL_ACCOUNT_NUMBER);
            $criteria->removeSelectColumn(HrUserAccountTableMap::COL_PF_ESIC_CONTRIBUTION);
            $criteria->removeSelectColumn(HrUserAccountTableMap::COL_PF_NUMBER);
            $criteria->removeSelectColumn(HrUserAccountTableMap::COL_ESCI_NUMBER);
            $criteria->removeSelectColumn(HrUserAccountTableMap::COL_GROSS_SALARY);
            $criteria->removeSelectColumn(HrUserAccountTableMap::COL_PAYMENT_MODE);
            $criteria->removeSelectColumn(HrUserAccountTableMap::COL_SALARY_BANK);
            $criteria->removeSelectColumn(HrUserAccountTableMap::COL_SALARY_ACCOUNT_NUMBER);
            $criteria->removeSelectColumn(HrUserAccountTableMap::COL_TDS_STATUS);
            $criteria->removeSelectColumn(HrUserAccountTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(HrUserAccountTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.hrua_id');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.personal_bank');
            $criteria->removeSelectColumn($alias . '.personal_account_number');
            $criteria->removeSelectColumn($alias . '.pf_esic_contribution');
            $criteria->removeSelectColumn($alias . '.pf_number');
            $criteria->removeSelectColumn($alias . '.esci_number');
            $criteria->removeSelectColumn($alias . '.gross_salary');
            $criteria->removeSelectColumn($alias . '.payment_mode');
            $criteria->removeSelectColumn($alias . '.salary_bank');
            $criteria->removeSelectColumn($alias . '.salary_account_number');
            $criteria->removeSelectColumn($alias . '.tds_status');
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
        return Propel::getServiceContainer()->getDatabaseMap(HrUserAccountTableMap::DATABASE_NAME)->getTable(HrUserAccountTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a HrUserAccount or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or HrUserAccount object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(HrUserAccountTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\HrUserAccount) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(HrUserAccountTableMap::DATABASE_NAME);
            $criteria->add(HrUserAccountTableMap::COL_HRUA_ID, (array) $values, Criteria::IN);
        }

        $query = HrUserAccountQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            HrUserAccountTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                HrUserAccountTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the hr_user_account table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return HrUserAccountQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a HrUserAccount or Criteria object.
     *
     * @param mixed $criteria Criteria or HrUserAccount object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HrUserAccountTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from HrUserAccount object
        }

        if ($criteria->containsKey(HrUserAccountTableMap::COL_HRUA_ID) && $criteria->keyContainsValue(HrUserAccountTableMap::COL_HRUA_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.HrUserAccountTableMap::COL_HRUA_ID.')');
        }


        // Set the correct dbName
        $query = HrUserAccountQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
