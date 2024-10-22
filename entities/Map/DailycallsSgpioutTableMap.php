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
use entities\DailycallsSgpiout;
use entities\DailycallsSgpioutQuery;


/**
 * This class defines the structure of the 'dailycalls_sgpiout' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class DailycallsSgpioutTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.DailycallsSgpioutTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'dailycalls_sgpiout';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'DailycallsSgpiout';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\DailycallsSgpiout';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.DailycallsSgpiout';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 13;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 13;

    /**
     * the column name for the sgpi_out_id field
     */
    public const COL_SGPI_OUT_ID = 'dailycalls_sgpiout.sgpi_out_id';

    /**
     * the column name for the dailycall_id field
     */
    public const COL_DAILYCALL_ID = 'dailycalls_sgpiout.dailycall_id';

    /**
     * the column name for the sgpi_id field
     */
    public const COL_SGPI_ID = 'dailycalls_sgpiout.sgpi_id';

    /**
     * the column name for the sgpi_qty field
     */
    public const COL_SGPI_QTY = 'dailycalls_sgpiout.sgpi_qty';

    /**
     * the column name for the sgpi_voucher_id field
     */
    public const COL_SGPI_VOUCHER_ID = 'dailycalls_sgpiout.sgpi_voucher_id';

    /**
     * the column name for the sgpi_name field
     */
    public const COL_SGPI_NAME = 'dailycalls_sgpiout.sgpi_name';

    /**
     * the column name for the sgpi_sku field
     */
    public const COL_SGPI_SKU = 'dailycalls_sgpiout.sgpi_sku';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'dailycalls_sgpiout.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'dailycalls_sgpiout.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'dailycalls_sgpiout.updated_at';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'dailycalls_sgpiout.employee_id';

    /**
     * the column name for the outlet_id field
     */
    public const COL_OUTLET_ID = 'dailycalls_sgpiout.outlet_id';

    /**
     * the column name for the outlet_orgdata_id field
     */
    public const COL_OUTLET_ORGDATA_ID = 'dailycalls_sgpiout.outlet_orgdata_id';

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
        self::TYPE_PHPNAME       => ['SgpiOutId', 'DailycallId', 'SgpiId', 'SgpiQty', 'SgpiVoucherId', 'SgpiName', 'SgpiSku', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'EmployeeId', 'OutletId', 'OutletOrgdataId', ],
        self::TYPE_CAMELNAME     => ['sgpiOutId', 'dailycallId', 'sgpiId', 'sgpiQty', 'sgpiVoucherId', 'sgpiName', 'sgpiSku', 'companyId', 'createdAt', 'updatedAt', 'employeeId', 'outletId', 'outletOrgdataId', ],
        self::TYPE_COLNAME       => [DailycallsSgpioutTableMap::COL_SGPI_OUT_ID, DailycallsSgpioutTableMap::COL_DAILYCALL_ID, DailycallsSgpioutTableMap::COL_SGPI_ID, DailycallsSgpioutTableMap::COL_SGPI_QTY, DailycallsSgpioutTableMap::COL_SGPI_VOUCHER_ID, DailycallsSgpioutTableMap::COL_SGPI_NAME, DailycallsSgpioutTableMap::COL_SGPI_SKU, DailycallsSgpioutTableMap::COL_COMPANY_ID, DailycallsSgpioutTableMap::COL_CREATED_AT, DailycallsSgpioutTableMap::COL_UPDATED_AT, DailycallsSgpioutTableMap::COL_EMPLOYEE_ID, DailycallsSgpioutTableMap::COL_OUTLET_ID, DailycallsSgpioutTableMap::COL_OUTLET_ORGDATA_ID, ],
        self::TYPE_FIELDNAME     => ['sgpi_out_id', 'dailycall_id', 'sgpi_id', 'sgpi_qty', 'sgpi_voucher_id', 'sgpi_name', 'sgpi_sku', 'company_id', 'created_at', 'updated_at', 'employee_id', 'outlet_id', 'outlet_orgdata_id', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
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
        self::TYPE_PHPNAME       => ['SgpiOutId' => 0, 'DailycallId' => 1, 'SgpiId' => 2, 'SgpiQty' => 3, 'SgpiVoucherId' => 4, 'SgpiName' => 5, 'SgpiSku' => 6, 'CompanyId' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, 'EmployeeId' => 10, 'OutletId' => 11, 'OutletOrgdataId' => 12, ],
        self::TYPE_CAMELNAME     => ['sgpiOutId' => 0, 'dailycallId' => 1, 'sgpiId' => 2, 'sgpiQty' => 3, 'sgpiVoucherId' => 4, 'sgpiName' => 5, 'sgpiSku' => 6, 'companyId' => 7, 'createdAt' => 8, 'updatedAt' => 9, 'employeeId' => 10, 'outletId' => 11, 'outletOrgdataId' => 12, ],
        self::TYPE_COLNAME       => [DailycallsSgpioutTableMap::COL_SGPI_OUT_ID => 0, DailycallsSgpioutTableMap::COL_DAILYCALL_ID => 1, DailycallsSgpioutTableMap::COL_SGPI_ID => 2, DailycallsSgpioutTableMap::COL_SGPI_QTY => 3, DailycallsSgpioutTableMap::COL_SGPI_VOUCHER_ID => 4, DailycallsSgpioutTableMap::COL_SGPI_NAME => 5, DailycallsSgpioutTableMap::COL_SGPI_SKU => 6, DailycallsSgpioutTableMap::COL_COMPANY_ID => 7, DailycallsSgpioutTableMap::COL_CREATED_AT => 8, DailycallsSgpioutTableMap::COL_UPDATED_AT => 9, DailycallsSgpioutTableMap::COL_EMPLOYEE_ID => 10, DailycallsSgpioutTableMap::COL_OUTLET_ID => 11, DailycallsSgpioutTableMap::COL_OUTLET_ORGDATA_ID => 12, ],
        self::TYPE_FIELDNAME     => ['sgpi_out_id' => 0, 'dailycall_id' => 1, 'sgpi_id' => 2, 'sgpi_qty' => 3, 'sgpi_voucher_id' => 4, 'sgpi_name' => 5, 'sgpi_sku' => 6, 'company_id' => 7, 'created_at' => 8, 'updated_at' => 9, 'employee_id' => 10, 'outlet_id' => 11, 'outlet_orgdata_id' => 12, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'SgpiOutId' => 'SGPI_OUT_ID',
        'DailycallsSgpiout.SgpiOutId' => 'SGPI_OUT_ID',
        'sgpiOutId' => 'SGPI_OUT_ID',
        'dailycallsSgpiout.sgpiOutId' => 'SGPI_OUT_ID',
        'DailycallsSgpioutTableMap::COL_SGPI_OUT_ID' => 'SGPI_OUT_ID',
        'COL_SGPI_OUT_ID' => 'SGPI_OUT_ID',
        'sgpi_out_id' => 'SGPI_OUT_ID',
        'dailycalls_sgpiout.sgpi_out_id' => 'SGPI_OUT_ID',
        'DailycallId' => 'DAILYCALL_ID',
        'DailycallsSgpiout.DailycallId' => 'DAILYCALL_ID',
        'dailycallId' => 'DAILYCALL_ID',
        'dailycallsSgpiout.dailycallId' => 'DAILYCALL_ID',
        'DailycallsSgpioutTableMap::COL_DAILYCALL_ID' => 'DAILYCALL_ID',
        'COL_DAILYCALL_ID' => 'DAILYCALL_ID',
        'dailycall_id' => 'DAILYCALL_ID',
        'dailycalls_sgpiout.dailycall_id' => 'DAILYCALL_ID',
        'SgpiId' => 'SGPI_ID',
        'DailycallsSgpiout.SgpiId' => 'SGPI_ID',
        'sgpiId' => 'SGPI_ID',
        'dailycallsSgpiout.sgpiId' => 'SGPI_ID',
        'DailycallsSgpioutTableMap::COL_SGPI_ID' => 'SGPI_ID',
        'COL_SGPI_ID' => 'SGPI_ID',
        'sgpi_id' => 'SGPI_ID',
        'dailycalls_sgpiout.sgpi_id' => 'SGPI_ID',
        'SgpiQty' => 'SGPI_QTY',
        'DailycallsSgpiout.SgpiQty' => 'SGPI_QTY',
        'sgpiQty' => 'SGPI_QTY',
        'dailycallsSgpiout.sgpiQty' => 'SGPI_QTY',
        'DailycallsSgpioutTableMap::COL_SGPI_QTY' => 'SGPI_QTY',
        'COL_SGPI_QTY' => 'SGPI_QTY',
        'sgpi_qty' => 'SGPI_QTY',
        'dailycalls_sgpiout.sgpi_qty' => 'SGPI_QTY',
        'SgpiVoucherId' => 'SGPI_VOUCHER_ID',
        'DailycallsSgpiout.SgpiVoucherId' => 'SGPI_VOUCHER_ID',
        'sgpiVoucherId' => 'SGPI_VOUCHER_ID',
        'dailycallsSgpiout.sgpiVoucherId' => 'SGPI_VOUCHER_ID',
        'DailycallsSgpioutTableMap::COL_SGPI_VOUCHER_ID' => 'SGPI_VOUCHER_ID',
        'COL_SGPI_VOUCHER_ID' => 'SGPI_VOUCHER_ID',
        'sgpi_voucher_id' => 'SGPI_VOUCHER_ID',
        'dailycalls_sgpiout.sgpi_voucher_id' => 'SGPI_VOUCHER_ID',
        'SgpiName' => 'SGPI_NAME',
        'DailycallsSgpiout.SgpiName' => 'SGPI_NAME',
        'sgpiName' => 'SGPI_NAME',
        'dailycallsSgpiout.sgpiName' => 'SGPI_NAME',
        'DailycallsSgpioutTableMap::COL_SGPI_NAME' => 'SGPI_NAME',
        'COL_SGPI_NAME' => 'SGPI_NAME',
        'sgpi_name' => 'SGPI_NAME',
        'dailycalls_sgpiout.sgpi_name' => 'SGPI_NAME',
        'SgpiSku' => 'SGPI_SKU',
        'DailycallsSgpiout.SgpiSku' => 'SGPI_SKU',
        'sgpiSku' => 'SGPI_SKU',
        'dailycallsSgpiout.sgpiSku' => 'SGPI_SKU',
        'DailycallsSgpioutTableMap::COL_SGPI_SKU' => 'SGPI_SKU',
        'COL_SGPI_SKU' => 'SGPI_SKU',
        'sgpi_sku' => 'SGPI_SKU',
        'dailycalls_sgpiout.sgpi_sku' => 'SGPI_SKU',
        'CompanyId' => 'COMPANY_ID',
        'DailycallsSgpiout.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'dailycallsSgpiout.companyId' => 'COMPANY_ID',
        'DailycallsSgpioutTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'dailycalls_sgpiout.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'DailycallsSgpiout.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'dailycallsSgpiout.createdAt' => 'CREATED_AT',
        'DailycallsSgpioutTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'dailycalls_sgpiout.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'DailycallsSgpiout.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'dailycallsSgpiout.updatedAt' => 'UPDATED_AT',
        'DailycallsSgpioutTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'dailycalls_sgpiout.updated_at' => 'UPDATED_AT',
        'EmployeeId' => 'EMPLOYEE_ID',
        'DailycallsSgpiout.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'dailycallsSgpiout.employeeId' => 'EMPLOYEE_ID',
        'DailycallsSgpioutTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'dailycalls_sgpiout.employee_id' => 'EMPLOYEE_ID',
        'OutletId' => 'OUTLET_ID',
        'DailycallsSgpiout.OutletId' => 'OUTLET_ID',
        'outletId' => 'OUTLET_ID',
        'dailycallsSgpiout.outletId' => 'OUTLET_ID',
        'DailycallsSgpioutTableMap::COL_OUTLET_ID' => 'OUTLET_ID',
        'COL_OUTLET_ID' => 'OUTLET_ID',
        'outlet_id' => 'OUTLET_ID',
        'dailycalls_sgpiout.outlet_id' => 'OUTLET_ID',
        'OutletOrgdataId' => 'OUTLET_ORGDATA_ID',
        'DailycallsSgpiout.OutletOrgdataId' => 'OUTLET_ORGDATA_ID',
        'outletOrgdataId' => 'OUTLET_ORGDATA_ID',
        'dailycallsSgpiout.outletOrgdataId' => 'OUTLET_ORGDATA_ID',
        'DailycallsSgpioutTableMap::COL_OUTLET_ORGDATA_ID' => 'OUTLET_ORGDATA_ID',
        'COL_OUTLET_ORGDATA_ID' => 'OUTLET_ORGDATA_ID',
        'outlet_orgdata_id' => 'OUTLET_ORGDATA_ID',
        'dailycalls_sgpiout.outlet_orgdata_id' => 'OUTLET_ORGDATA_ID',
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
        $this->setName('dailycalls_sgpiout');
        $this->setPhpName('DailycallsSgpiout');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\DailycallsSgpiout');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('dailycalls_sgpiout_sgpi_out_id_seq');
        // columns
        $this->addPrimaryKey('sgpi_out_id', 'SgpiOutId', 'INTEGER', true, null, null);
        $this->addColumn('dailycall_id', 'DailycallId', 'INTEGER', false, null, null);
        $this->addForeignKey('sgpi_id', 'SgpiId', 'INTEGER', 'sgpi_master', 'sgpi_id', false, null, null);
        $this->addColumn('sgpi_qty', 'SgpiQty', 'INTEGER', false, null, null);
        $this->addColumn('sgpi_voucher_id', 'SgpiVoucherId', 'BIGINT', false, null, null);
        $this->addColumn('sgpi_name', 'SgpiName', 'VARCHAR', false, null, null);
        $this->addColumn('sgpi_sku', 'SgpiSku', 'VARCHAR', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', false, null, null);
        $this->addForeignKey('outlet_id', 'OutletId', 'INTEGER', 'outlets', 'id', false, null, null);
        $this->addForeignKey('outlet_orgdata_id', 'OutletOrgdataId', 'INTEGER', 'outlet_org_data', 'outlet_org_id', false, null, null);
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
        $this->addRelation('SgpiMaster', '\\entities\\SgpiMaster', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':sgpi_id',
    1 => ':sgpi_id',
  ),
), null, null, null, false);
        $this->addRelation('Employee', '\\entities\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, null, false);
        $this->addRelation('Outlets', '\\entities\\Outlets', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('OutletOrgData', '\\entities\\OutletOrgData', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_orgdata_id',
    1 => ':outlet_org_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiOutId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiOutId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiOutId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiOutId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiOutId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiOutId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('SgpiOutId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? DailycallsSgpioutTableMap::CLASS_DEFAULT : DailycallsSgpioutTableMap::OM_CLASS;
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
     * @return array (DailycallsSgpiout object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = DailycallsSgpioutTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DailycallsSgpioutTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DailycallsSgpioutTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DailycallsSgpioutTableMap::OM_CLASS;
            /** @var DailycallsSgpiout $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DailycallsSgpioutTableMap::addInstanceToPool($obj, $key);
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
            $key = DailycallsSgpioutTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DailycallsSgpioutTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var DailycallsSgpiout $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DailycallsSgpioutTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(DailycallsSgpioutTableMap::COL_SGPI_OUT_ID);
            $criteria->addSelectColumn(DailycallsSgpioutTableMap::COL_DAILYCALL_ID);
            $criteria->addSelectColumn(DailycallsSgpioutTableMap::COL_SGPI_ID);
            $criteria->addSelectColumn(DailycallsSgpioutTableMap::COL_SGPI_QTY);
            $criteria->addSelectColumn(DailycallsSgpioutTableMap::COL_SGPI_VOUCHER_ID);
            $criteria->addSelectColumn(DailycallsSgpioutTableMap::COL_SGPI_NAME);
            $criteria->addSelectColumn(DailycallsSgpioutTableMap::COL_SGPI_SKU);
            $criteria->addSelectColumn(DailycallsSgpioutTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(DailycallsSgpioutTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(DailycallsSgpioutTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(DailycallsSgpioutTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(DailycallsSgpioutTableMap::COL_OUTLET_ID);
            $criteria->addSelectColumn(DailycallsSgpioutTableMap::COL_OUTLET_ORGDATA_ID);
        } else {
            $criteria->addSelectColumn($alias . '.sgpi_out_id');
            $criteria->addSelectColumn($alias . '.dailycall_id');
            $criteria->addSelectColumn($alias . '.sgpi_id');
            $criteria->addSelectColumn($alias . '.sgpi_qty');
            $criteria->addSelectColumn($alias . '.sgpi_voucher_id');
            $criteria->addSelectColumn($alias . '.sgpi_name');
            $criteria->addSelectColumn($alias . '.sgpi_sku');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.outlet_id');
            $criteria->addSelectColumn($alias . '.outlet_orgdata_id');
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
            $criteria->removeSelectColumn(DailycallsSgpioutTableMap::COL_SGPI_OUT_ID);
            $criteria->removeSelectColumn(DailycallsSgpioutTableMap::COL_DAILYCALL_ID);
            $criteria->removeSelectColumn(DailycallsSgpioutTableMap::COL_SGPI_ID);
            $criteria->removeSelectColumn(DailycallsSgpioutTableMap::COL_SGPI_QTY);
            $criteria->removeSelectColumn(DailycallsSgpioutTableMap::COL_SGPI_VOUCHER_ID);
            $criteria->removeSelectColumn(DailycallsSgpioutTableMap::COL_SGPI_NAME);
            $criteria->removeSelectColumn(DailycallsSgpioutTableMap::COL_SGPI_SKU);
            $criteria->removeSelectColumn(DailycallsSgpioutTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(DailycallsSgpioutTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(DailycallsSgpioutTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(DailycallsSgpioutTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(DailycallsSgpioutTableMap::COL_OUTLET_ID);
            $criteria->removeSelectColumn(DailycallsSgpioutTableMap::COL_OUTLET_ORGDATA_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.sgpi_out_id');
            $criteria->removeSelectColumn($alias . '.dailycall_id');
            $criteria->removeSelectColumn($alias . '.sgpi_id');
            $criteria->removeSelectColumn($alias . '.sgpi_qty');
            $criteria->removeSelectColumn($alias . '.sgpi_voucher_id');
            $criteria->removeSelectColumn($alias . '.sgpi_name');
            $criteria->removeSelectColumn($alias . '.sgpi_sku');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.outlet_id');
            $criteria->removeSelectColumn($alias . '.outlet_orgdata_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(DailycallsSgpioutTableMap::DATABASE_NAME)->getTable(DailycallsSgpioutTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a DailycallsSgpiout or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or DailycallsSgpiout object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(DailycallsSgpioutTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\DailycallsSgpiout) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DailycallsSgpioutTableMap::DATABASE_NAME);
            $criteria->add(DailycallsSgpioutTableMap::COL_SGPI_OUT_ID, (array) $values, Criteria::IN);
        }

        $query = DailycallsSgpioutQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            DailycallsSgpioutTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                DailycallsSgpioutTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the dailycalls_sgpiout table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return DailycallsSgpioutQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a DailycallsSgpiout or Criteria object.
     *
     * @param mixed $criteria Criteria or DailycallsSgpiout object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DailycallsSgpioutTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from DailycallsSgpiout object
        }

        if ($criteria->containsKey(DailycallsSgpioutTableMap::COL_SGPI_OUT_ID) && $criteria->keyContainsValue(DailycallsSgpioutTableMap::COL_SGPI_OUT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DailycallsSgpioutTableMap::COL_SGPI_OUT_ID.')');
        }


        // Set the correct dbName
        $query = DailycallsSgpioutQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
