<?php

namespace entities\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use entities\SgpiTransactionView;
use entities\SgpiTransactionViewQuery;


/**
 * This class defines the structure of the 'sgpi_transaction_view' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SgpiTransactionViewTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.SgpiTransactionViewTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'sgpi_transaction_view';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SgpiTransactionView';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\SgpiTransactionView';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.SgpiTransactionView';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 19;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 19;

    /**
     * the column name for the sgpi_name field
     */
    public const COL_SGPI_NAME = 'sgpi_transaction_view.sgpi_name';

    /**
     * the column name for the cd field
     */
    public const COL_CD = 'sgpi_transaction_view.cd';

    /**
     * the column name for the qty field
     */
    public const COL_QTY = 'sgpi_transaction_view.qty';

    /**
     * the column name for the credits field
     */
    public const COL_CREDITS = 'sgpi_transaction_view.credits';

    /**
     * the column name for the debits field
     */
    public const COL_DEBITS = 'sgpi_transaction_view.debits';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'sgpi_transaction_view.employee_id';

    /**
     * the column name for the voucher_no field
     */
    public const COL_VOUCHER_NO = 'sgpi_transaction_view.voucher_no';

    /**
     * the column name for the remark field
     */
    public const COL_REMARK = 'sgpi_transaction_view.remark';

    /**
     * the column name for the outlet_name field
     */
    public const COL_OUTLET_NAME = 'sgpi_transaction_view.outlet_name';

    /**
     * the column name for the dcr_date field
     */
    public const COL_DCR_DATE = 'sgpi_transaction_view.dcr_date';

    /**
     * the column name for the outlettype_name field
     */
    public const COL_OUTLETTYPE_NAME = 'sgpi_transaction_view.outlettype_name';

    /**
     * the column name for the beat_name field
     */
    public const COL_BEAT_NAME = 'sgpi_transaction_view.beat_name';

    /**
     * the column name for the use_start_date field
     */
    public const COL_USE_START_DATE = 'sgpi_transaction_view.use_start_date';

    /**
     * the column name for the use_end_date field
     */
    public const COL_USE_END_DATE = 'sgpi_transaction_view.use_end_date';

    /**
     * the column name for the sgpi_id field
     */
    public const COL_SGPI_ID = 'sgpi_transaction_view.sgpi_id';

    /**
     * the column name for the employee_code field
     */
    public const COL_EMPLOYEE_CODE = 'sgpi_transaction_view.employee_code';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'sgpi_transaction_view.created_at';

    /**
     * the column name for the brand_name field
     */
    public const COL_BRAND_NAME = 'sgpi_transaction_view.brand_name';

    /**
     * the column name for the outlet_code field
     */
    public const COL_OUTLET_CODE = 'sgpi_transaction_view.outlet_code';

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
        self::TYPE_PHPNAME       => ['SgpiName', 'Cd', 'Qty', 'Credits', 'Debits', 'EmployeeId', 'VoucherNo', 'Remark', 'OutletName', 'DcrDate', 'OutlettypeName', 'BeatName', 'UseStartDate', 'UseEndDate', 'SgpiId', 'EmployeeCode', 'CreatedTa', 'BrandName', 'OutletCode', ],
        self::TYPE_CAMELNAME     => ['sgpiName', 'cd', 'qty', 'credits', 'debits', 'employeeId', 'voucherNo', 'remark', 'outletName', 'dcrDate', 'outlettypeName', 'beatName', 'useStartDate', 'useEndDate', 'sgpiId', 'employeeCode', 'createdTa', 'brandName', 'outletCode', ],
        self::TYPE_COLNAME       => [SgpiTransactionViewTableMap::COL_SGPI_NAME, SgpiTransactionViewTableMap::COL_CD, SgpiTransactionViewTableMap::COL_QTY, SgpiTransactionViewTableMap::COL_CREDITS, SgpiTransactionViewTableMap::COL_DEBITS, SgpiTransactionViewTableMap::COL_EMPLOYEE_ID, SgpiTransactionViewTableMap::COL_VOUCHER_NO, SgpiTransactionViewTableMap::COL_REMARK, SgpiTransactionViewTableMap::COL_OUTLET_NAME, SgpiTransactionViewTableMap::COL_DCR_DATE, SgpiTransactionViewTableMap::COL_OUTLETTYPE_NAME, SgpiTransactionViewTableMap::COL_BEAT_NAME, SgpiTransactionViewTableMap::COL_USE_START_DATE, SgpiTransactionViewTableMap::COL_USE_END_DATE, SgpiTransactionViewTableMap::COL_SGPI_ID, SgpiTransactionViewTableMap::COL_EMPLOYEE_CODE, SgpiTransactionViewTableMap::COL_CREATED_AT, SgpiTransactionViewTableMap::COL_BRAND_NAME, SgpiTransactionViewTableMap::COL_OUTLET_CODE, ],
        self::TYPE_FIELDNAME     => ['sgpi_name', 'cd', 'qty', 'credits', 'debits', 'employee_id', 'voucher_no', 'remark', 'outlet_name', 'dcr_date', 'outlettype_name', 'beat_name', 'use_start_date', 'use_end_date', 'sgpi_id', 'employee_code', 'created_at', 'brand_name', 'outlet_code', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, ]
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
        self::TYPE_PHPNAME       => ['SgpiName' => 0, 'Cd' => 1, 'Qty' => 2, 'Credits' => 3, 'Debits' => 4, 'EmployeeId' => 5, 'VoucherNo' => 6, 'Remark' => 7, 'OutletName' => 8, 'DcrDate' => 9, 'OutlettypeName' => 10, 'BeatName' => 11, 'UseStartDate' => 12, 'UseEndDate' => 13, 'SgpiId' => 14, 'EmployeeCode' => 15, 'CreatedTa' => 16, 'BrandName' => 17, 'OutletCode' => 18, ],
        self::TYPE_CAMELNAME     => ['sgpiName' => 0, 'cd' => 1, 'qty' => 2, 'credits' => 3, 'debits' => 4, 'employeeId' => 5, 'voucherNo' => 6, 'remark' => 7, 'outletName' => 8, 'dcrDate' => 9, 'outlettypeName' => 10, 'beatName' => 11, 'useStartDate' => 12, 'useEndDate' => 13, 'sgpiId' => 14, 'employeeCode' => 15, 'createdTa' => 16, 'brandName' => 17, 'outletCode' => 18, ],
        self::TYPE_COLNAME       => [SgpiTransactionViewTableMap::COL_SGPI_NAME => 0, SgpiTransactionViewTableMap::COL_CD => 1, SgpiTransactionViewTableMap::COL_QTY => 2, SgpiTransactionViewTableMap::COL_CREDITS => 3, SgpiTransactionViewTableMap::COL_DEBITS => 4, SgpiTransactionViewTableMap::COL_EMPLOYEE_ID => 5, SgpiTransactionViewTableMap::COL_VOUCHER_NO => 6, SgpiTransactionViewTableMap::COL_REMARK => 7, SgpiTransactionViewTableMap::COL_OUTLET_NAME => 8, SgpiTransactionViewTableMap::COL_DCR_DATE => 9, SgpiTransactionViewTableMap::COL_OUTLETTYPE_NAME => 10, SgpiTransactionViewTableMap::COL_BEAT_NAME => 11, SgpiTransactionViewTableMap::COL_USE_START_DATE => 12, SgpiTransactionViewTableMap::COL_USE_END_DATE => 13, SgpiTransactionViewTableMap::COL_SGPI_ID => 14, SgpiTransactionViewTableMap::COL_EMPLOYEE_CODE => 15, SgpiTransactionViewTableMap::COL_CREATED_AT => 16, SgpiTransactionViewTableMap::COL_BRAND_NAME => 17, SgpiTransactionViewTableMap::COL_OUTLET_CODE => 18, ],
        self::TYPE_FIELDNAME     => ['sgpi_name' => 0, 'cd' => 1, 'qty' => 2, 'credits' => 3, 'debits' => 4, 'employee_id' => 5, 'voucher_no' => 6, 'remark' => 7, 'outlet_name' => 8, 'dcr_date' => 9, 'outlettype_name' => 10, 'beat_name' => 11, 'use_start_date' => 12, 'use_end_date' => 13, 'sgpi_id' => 14, 'employee_code' => 15, 'created_at' => 16, 'brand_name' => 17, 'outlet_code' => 18, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'SgpiName' => 'SGPI_NAME',
        'SgpiTransactionView.SgpiName' => 'SGPI_NAME',
        'sgpiName' => 'SGPI_NAME',
        'sgpiTransactionView.sgpiName' => 'SGPI_NAME',
        'SgpiTransactionViewTableMap::COL_SGPI_NAME' => 'SGPI_NAME',
        'COL_SGPI_NAME' => 'SGPI_NAME',
        'sgpi_name' => 'SGPI_NAME',
        'sgpi_transaction_view.sgpi_name' => 'SGPI_NAME',
        'Cd' => 'CD',
        'SgpiTransactionView.Cd' => 'CD',
        'cd' => 'CD',
        'sgpiTransactionView.cd' => 'CD',
        'SgpiTransactionViewTableMap::COL_CD' => 'CD',
        'COL_CD' => 'CD',
        'sgpi_transaction_view.cd' => 'CD',
        'Qty' => 'QTY',
        'SgpiTransactionView.Qty' => 'QTY',
        'qty' => 'QTY',
        'sgpiTransactionView.qty' => 'QTY',
        'SgpiTransactionViewTableMap::COL_QTY' => 'QTY',
        'COL_QTY' => 'QTY',
        'sgpi_transaction_view.qty' => 'QTY',
        'Credits' => 'CREDITS',
        'SgpiTransactionView.Credits' => 'CREDITS',
        'credits' => 'CREDITS',
        'sgpiTransactionView.credits' => 'CREDITS',
        'SgpiTransactionViewTableMap::COL_CREDITS' => 'CREDITS',
        'COL_CREDITS' => 'CREDITS',
        'sgpi_transaction_view.credits' => 'CREDITS',
        'Debits' => 'DEBITS',
        'SgpiTransactionView.Debits' => 'DEBITS',
        'debits' => 'DEBITS',
        'sgpiTransactionView.debits' => 'DEBITS',
        'SgpiTransactionViewTableMap::COL_DEBITS' => 'DEBITS',
        'COL_DEBITS' => 'DEBITS',
        'sgpi_transaction_view.debits' => 'DEBITS',
        'EmployeeId' => 'EMPLOYEE_ID',
        'SgpiTransactionView.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'sgpiTransactionView.employeeId' => 'EMPLOYEE_ID',
        'SgpiTransactionViewTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'sgpi_transaction_view.employee_id' => 'EMPLOYEE_ID',
        'VoucherNo' => 'VOUCHER_NO',
        'SgpiTransactionView.VoucherNo' => 'VOUCHER_NO',
        'voucherNo' => 'VOUCHER_NO',
        'sgpiTransactionView.voucherNo' => 'VOUCHER_NO',
        'SgpiTransactionViewTableMap::COL_VOUCHER_NO' => 'VOUCHER_NO',
        'COL_VOUCHER_NO' => 'VOUCHER_NO',
        'voucher_no' => 'VOUCHER_NO',
        'sgpi_transaction_view.voucher_no' => 'VOUCHER_NO',
        'Remark' => 'REMARK',
        'SgpiTransactionView.Remark' => 'REMARK',
        'remark' => 'REMARK',
        'sgpiTransactionView.remark' => 'REMARK',
        'SgpiTransactionViewTableMap::COL_REMARK' => 'REMARK',
        'COL_REMARK' => 'REMARK',
        'sgpi_transaction_view.remark' => 'REMARK',
        'OutletName' => 'OUTLET_NAME',
        'SgpiTransactionView.OutletName' => 'OUTLET_NAME',
        'outletName' => 'OUTLET_NAME',
        'sgpiTransactionView.outletName' => 'OUTLET_NAME',
        'SgpiTransactionViewTableMap::COL_OUTLET_NAME' => 'OUTLET_NAME',
        'COL_OUTLET_NAME' => 'OUTLET_NAME',
        'outlet_name' => 'OUTLET_NAME',
        'sgpi_transaction_view.outlet_name' => 'OUTLET_NAME',
        'DcrDate' => 'DCR_DATE',
        'SgpiTransactionView.DcrDate' => 'DCR_DATE',
        'dcrDate' => 'DCR_DATE',
        'sgpiTransactionView.dcrDate' => 'DCR_DATE',
        'SgpiTransactionViewTableMap::COL_DCR_DATE' => 'DCR_DATE',
        'COL_DCR_DATE' => 'DCR_DATE',
        'dcr_date' => 'DCR_DATE',
        'sgpi_transaction_view.dcr_date' => 'DCR_DATE',
        'OutlettypeName' => 'OUTLETTYPE_NAME',
        'SgpiTransactionView.OutlettypeName' => 'OUTLETTYPE_NAME',
        'outlettypeName' => 'OUTLETTYPE_NAME',
        'sgpiTransactionView.outlettypeName' => 'OUTLETTYPE_NAME',
        'SgpiTransactionViewTableMap::COL_OUTLETTYPE_NAME' => 'OUTLETTYPE_NAME',
        'COL_OUTLETTYPE_NAME' => 'OUTLETTYPE_NAME',
        'outlettype_name' => 'OUTLETTYPE_NAME',
        'sgpi_transaction_view.outlettype_name' => 'OUTLETTYPE_NAME',
        'BeatName' => 'BEAT_NAME',
        'SgpiTransactionView.BeatName' => 'BEAT_NAME',
        'beatName' => 'BEAT_NAME',
        'sgpiTransactionView.beatName' => 'BEAT_NAME',
        'SgpiTransactionViewTableMap::COL_BEAT_NAME' => 'BEAT_NAME',
        'COL_BEAT_NAME' => 'BEAT_NAME',
        'beat_name' => 'BEAT_NAME',
        'sgpi_transaction_view.beat_name' => 'BEAT_NAME',
        'UseStartDate' => 'USE_START_DATE',
        'SgpiTransactionView.UseStartDate' => 'USE_START_DATE',
        'useStartDate' => 'USE_START_DATE',
        'sgpiTransactionView.useStartDate' => 'USE_START_DATE',
        'SgpiTransactionViewTableMap::COL_USE_START_DATE' => 'USE_START_DATE',
        'COL_USE_START_DATE' => 'USE_START_DATE',
        'use_start_date' => 'USE_START_DATE',
        'sgpi_transaction_view.use_start_date' => 'USE_START_DATE',
        'UseEndDate' => 'USE_END_DATE',
        'SgpiTransactionView.UseEndDate' => 'USE_END_DATE',
        'useEndDate' => 'USE_END_DATE',
        'sgpiTransactionView.useEndDate' => 'USE_END_DATE',
        'SgpiTransactionViewTableMap::COL_USE_END_DATE' => 'USE_END_DATE',
        'COL_USE_END_DATE' => 'USE_END_DATE',
        'use_end_date' => 'USE_END_DATE',
        'sgpi_transaction_view.use_end_date' => 'USE_END_DATE',
        'SgpiId' => 'SGPI_ID',
        'SgpiTransactionView.SgpiId' => 'SGPI_ID',
        'sgpiId' => 'SGPI_ID',
        'sgpiTransactionView.sgpiId' => 'SGPI_ID',
        'SgpiTransactionViewTableMap::COL_SGPI_ID' => 'SGPI_ID',
        'COL_SGPI_ID' => 'SGPI_ID',
        'sgpi_id' => 'SGPI_ID',
        'sgpi_transaction_view.sgpi_id' => 'SGPI_ID',
        'EmployeeCode' => 'EMPLOYEE_CODE',
        'SgpiTransactionView.EmployeeCode' => 'EMPLOYEE_CODE',
        'employeeCode' => 'EMPLOYEE_CODE',
        'sgpiTransactionView.employeeCode' => 'EMPLOYEE_CODE',
        'SgpiTransactionViewTableMap::COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'employee_code' => 'EMPLOYEE_CODE',
        'sgpi_transaction_view.employee_code' => 'EMPLOYEE_CODE',
        'CreatedTa' => 'CREATED_AT',
        'SgpiTransactionView.CreatedTa' => 'CREATED_AT',
        'createdTa' => 'CREATED_AT',
        'sgpiTransactionView.createdTa' => 'CREATED_AT',
        'SgpiTransactionViewTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'sgpi_transaction_view.created_at' => 'CREATED_AT',
        'BrandName' => 'BRAND_NAME',
        'SgpiTransactionView.BrandName' => 'BRAND_NAME',
        'brandName' => 'BRAND_NAME',
        'sgpiTransactionView.brandName' => 'BRAND_NAME',
        'SgpiTransactionViewTableMap::COL_BRAND_NAME' => 'BRAND_NAME',
        'COL_BRAND_NAME' => 'BRAND_NAME',
        'brand_name' => 'BRAND_NAME',
        'sgpi_transaction_view.brand_name' => 'BRAND_NAME',
        'OutletCode' => 'OUTLET_CODE',
        'SgpiTransactionView.OutletCode' => 'OUTLET_CODE',
        'outletCode' => 'OUTLET_CODE',
        'sgpiTransactionView.outletCode' => 'OUTLET_CODE',
        'SgpiTransactionViewTableMap::COL_OUTLET_CODE' => 'OUTLET_CODE',
        'COL_OUTLET_CODE' => 'OUTLET_CODE',
        'outlet_code' => 'OUTLET_CODE',
        'sgpi_transaction_view.outlet_code' => 'OUTLET_CODE',
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
        $this->setName('sgpi_transaction_view');
        $this->setPhpName('SgpiTransactionView');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\SgpiTransactionView');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addColumn('sgpi_name', 'SgpiName', 'VARCHAR', false, null, null);
        $this->addColumn('cd', 'Cd', 'VARCHAR', false, null, null);
        $this->addColumn('qty', 'Qty', 'VARCHAR', false, null, null);
        $this->addColumn('credits', 'Credits', 'VARCHAR', false, null, null);
        $this->addColumn('debits', 'Debits', 'VARCHAR', false, null, null);
        $this->addColumn('employee_id', 'EmployeeId', 'VARCHAR', false, null, null);
        $this->addColumn('voucher_no', 'VoucherNo', 'VARCHAR', false, null, null);
        $this->addColumn('remark', 'Remark', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_name', 'OutletName', 'VARCHAR', false, null, null);
        $this->addColumn('dcr_date', 'DcrDate', 'VARCHAR', false, null, null);
        $this->addColumn('outlettype_name', 'OutlettypeName', 'VARCHAR', false, null, null);
        $this->addColumn('beat_name', 'BeatName', 'VARCHAR', false, null, null);
        $this->addColumn('use_start_date', 'UseStartDate', 'VARCHAR', false, null, null);
        $this->addColumn('use_end_date', 'UseEndDate', 'VARCHAR', false, null, null);
        $this->addColumn('sgpi_id', 'SgpiId', 'VARCHAR', false, null, null);
        $this->addColumn('employee_code', 'EmployeeCode', 'VARCHAR', false, null, null);
        $this->addColumn('created_at', 'CreatedTa', 'VARCHAR', false, null, null);
        $this->addColumn('brand_name', 'BrandName', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_code', 'OutletCode', 'VARCHAR', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
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
        return null;
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
        return '';
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
        return $withPrefix ? SgpiTransactionViewTableMap::CLASS_DEFAULT : SgpiTransactionViewTableMap::OM_CLASS;
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
     * @return array (SgpiTransactionView object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SgpiTransactionViewTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SgpiTransactionViewTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SgpiTransactionViewTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SgpiTransactionViewTableMap::OM_CLASS;
            /** @var SgpiTransactionView $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SgpiTransactionViewTableMap::addInstanceToPool($obj, $key);
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
            $key = SgpiTransactionViewTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SgpiTransactionViewTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SgpiTransactionView $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SgpiTransactionViewTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SgpiTransactionViewTableMap::COL_SGPI_NAME);
            $criteria->addSelectColumn(SgpiTransactionViewTableMap::COL_CD);
            $criteria->addSelectColumn(SgpiTransactionViewTableMap::COL_QTY);
            $criteria->addSelectColumn(SgpiTransactionViewTableMap::COL_CREDITS);
            $criteria->addSelectColumn(SgpiTransactionViewTableMap::COL_DEBITS);
            $criteria->addSelectColumn(SgpiTransactionViewTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(SgpiTransactionViewTableMap::COL_VOUCHER_NO);
            $criteria->addSelectColumn(SgpiTransactionViewTableMap::COL_REMARK);
            $criteria->addSelectColumn(SgpiTransactionViewTableMap::COL_OUTLET_NAME);
            $criteria->addSelectColumn(SgpiTransactionViewTableMap::COL_DCR_DATE);
            $criteria->addSelectColumn(SgpiTransactionViewTableMap::COL_OUTLETTYPE_NAME);
            $criteria->addSelectColumn(SgpiTransactionViewTableMap::COL_BEAT_NAME);
            $criteria->addSelectColumn(SgpiTransactionViewTableMap::COL_USE_START_DATE);
            $criteria->addSelectColumn(SgpiTransactionViewTableMap::COL_USE_END_DATE);
            $criteria->addSelectColumn(SgpiTransactionViewTableMap::COL_SGPI_ID);
            $criteria->addSelectColumn(SgpiTransactionViewTableMap::COL_EMPLOYEE_CODE);
            $criteria->addSelectColumn(SgpiTransactionViewTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SgpiTransactionViewTableMap::COL_BRAND_NAME);
            $criteria->addSelectColumn(SgpiTransactionViewTableMap::COL_OUTLET_CODE);
        } else {
            $criteria->addSelectColumn($alias . '.sgpi_name');
            $criteria->addSelectColumn($alias . '.cd');
            $criteria->addSelectColumn($alias . '.qty');
            $criteria->addSelectColumn($alias . '.credits');
            $criteria->addSelectColumn($alias . '.debits');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.voucher_no');
            $criteria->addSelectColumn($alias . '.remark');
            $criteria->addSelectColumn($alias . '.outlet_name');
            $criteria->addSelectColumn($alias . '.dcr_date');
            $criteria->addSelectColumn($alias . '.outlettype_name');
            $criteria->addSelectColumn($alias . '.beat_name');
            $criteria->addSelectColumn($alias . '.use_start_date');
            $criteria->addSelectColumn($alias . '.use_end_date');
            $criteria->addSelectColumn($alias . '.sgpi_id');
            $criteria->addSelectColumn($alias . '.employee_code');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.brand_name');
            $criteria->addSelectColumn($alias . '.outlet_code');
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
            $criteria->removeSelectColumn(SgpiTransactionViewTableMap::COL_SGPI_NAME);
            $criteria->removeSelectColumn(SgpiTransactionViewTableMap::COL_CD);
            $criteria->removeSelectColumn(SgpiTransactionViewTableMap::COL_QTY);
            $criteria->removeSelectColumn(SgpiTransactionViewTableMap::COL_CREDITS);
            $criteria->removeSelectColumn(SgpiTransactionViewTableMap::COL_DEBITS);
            $criteria->removeSelectColumn(SgpiTransactionViewTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(SgpiTransactionViewTableMap::COL_VOUCHER_NO);
            $criteria->removeSelectColumn(SgpiTransactionViewTableMap::COL_REMARK);
            $criteria->removeSelectColumn(SgpiTransactionViewTableMap::COL_OUTLET_NAME);
            $criteria->removeSelectColumn(SgpiTransactionViewTableMap::COL_DCR_DATE);
            $criteria->removeSelectColumn(SgpiTransactionViewTableMap::COL_OUTLETTYPE_NAME);
            $criteria->removeSelectColumn(SgpiTransactionViewTableMap::COL_BEAT_NAME);
            $criteria->removeSelectColumn(SgpiTransactionViewTableMap::COL_USE_START_DATE);
            $criteria->removeSelectColumn(SgpiTransactionViewTableMap::COL_USE_END_DATE);
            $criteria->removeSelectColumn(SgpiTransactionViewTableMap::COL_SGPI_ID);
            $criteria->removeSelectColumn(SgpiTransactionViewTableMap::COL_EMPLOYEE_CODE);
            $criteria->removeSelectColumn(SgpiTransactionViewTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SgpiTransactionViewTableMap::COL_BRAND_NAME);
            $criteria->removeSelectColumn(SgpiTransactionViewTableMap::COL_OUTLET_CODE);
        } else {
            $criteria->removeSelectColumn($alias . '.sgpi_name');
            $criteria->removeSelectColumn($alias . '.cd');
            $criteria->removeSelectColumn($alias . '.qty');
            $criteria->removeSelectColumn($alias . '.credits');
            $criteria->removeSelectColumn($alias . '.debits');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.voucher_no');
            $criteria->removeSelectColumn($alias . '.remark');
            $criteria->removeSelectColumn($alias . '.outlet_name');
            $criteria->removeSelectColumn($alias . '.dcr_date');
            $criteria->removeSelectColumn($alias . '.outlettype_name');
            $criteria->removeSelectColumn($alias . '.beat_name');
            $criteria->removeSelectColumn($alias . '.use_start_date');
            $criteria->removeSelectColumn($alias . '.use_end_date');
            $criteria->removeSelectColumn($alias . '.sgpi_id');
            $criteria->removeSelectColumn($alias . '.employee_code');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.brand_name');
            $criteria->removeSelectColumn($alias . '.outlet_code');
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
        return Propel::getServiceContainer()->getDatabaseMap(SgpiTransactionViewTableMap::DATABASE_NAME)->getTable(SgpiTransactionViewTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SgpiTransactionView or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SgpiTransactionView object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SgpiTransactionViewTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\SgpiTransactionView) { // it's a model object
            // create criteria based on pk value
            $criteria = $values->buildCriteria();
        } else { // it's a primary key, or an array of pks
            throw new LogicException('The SgpiTransactionView object has no primary key');
        }

        $query = SgpiTransactionViewQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SgpiTransactionViewTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SgpiTransactionViewTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sgpi_transaction_view table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SgpiTransactionViewQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SgpiTransactionView or Criteria object.
     *
     * @param mixed $criteria Criteria or SgpiTransactionView object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SgpiTransactionViewTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SgpiTransactionView object
        }


        // Set the correct dbName
        $query = SgpiTransactionViewQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
