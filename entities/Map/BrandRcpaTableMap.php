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
use entities\BrandRcpa;
use entities\BrandRcpaQuery;


/**
 * This class defines the structure of the 'brand_rcpa' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class BrandRcpaTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.BrandRcpaTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'brand_rcpa';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'BrandRcpa';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\BrandRcpa';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.BrandRcpa';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 15;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 15;

    /**
     * the column name for the brcpa_id field
     */
    public const COL_BRCPA_ID = 'brand_rcpa.brcpa_id';

    /**
     * the column name for the outlet_id field
     */
    public const COL_OUTLET_ID = 'brand_rcpa.outlet_id';

    /**
     * the column name for the retail_outlet_id field
     */
    public const COL_RETAIL_OUTLET_ID = 'brand_rcpa.retail_outlet_id';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'brand_rcpa.employee_id';

    /**
     * the column name for the rcpa_value field
     */
    public const COL_RCPA_VALUE = 'brand_rcpa.rcpa_value';

    /**
     * the column name for the brand_id field
     */
    public const COL_BRAND_ID = 'brand_rcpa.brand_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'brand_rcpa.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'brand_rcpa.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'brand_rcpa.updated_at';

    /**
     * the column name for the rcpa_moye field
     */
    public const COL_RCPA_MOYE = 'brand_rcpa.rcpa_moye';

    /**
     * the column name for the competitor_id field
     */
    public const COL_COMPETITOR_ID = 'brand_rcpa.competitor_id';

    /**
     * the column name for the ref_name field
     */
    public const COL_REF_NAME = 'brand_rcpa.ref_name';

    /**
     * the column name for the product_id field
     */
    public const COL_PRODUCT_ID = 'brand_rcpa.product_id';

    /**
     * the column name for the brand_rcpa_lat_long field
     */
    public const COL_BRAND_RCPA_LAT_LONG = 'brand_rcpa.brand_rcpa_lat_long';

    /**
     * the column name for the brand_rcpa_address field
     */
    public const COL_BRAND_RCPA_ADDRESS = 'brand_rcpa.brand_rcpa_address';

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
        self::TYPE_PHPNAME       => ['BrcpaId', 'OutletId', 'RetailOutletId', 'EmployeeId', 'RcpaValue', 'BrandId', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'RcpaMoye', 'CompetitorId', 'RefName', 'ProductId', 'BrandRcpaLatLong', 'BrandRcpaAddress', ],
        self::TYPE_CAMELNAME     => ['brcpaId', 'outletId', 'retailOutletId', 'employeeId', 'rcpaValue', 'brandId', 'companyId', 'createdAt', 'updatedAt', 'rcpaMoye', 'competitorId', 'refName', 'productId', 'brandRcpaLatLong', 'brandRcpaAddress', ],
        self::TYPE_COLNAME       => [BrandRcpaTableMap::COL_BRCPA_ID, BrandRcpaTableMap::COL_OUTLET_ID, BrandRcpaTableMap::COL_RETAIL_OUTLET_ID, BrandRcpaTableMap::COL_EMPLOYEE_ID, BrandRcpaTableMap::COL_RCPA_VALUE, BrandRcpaTableMap::COL_BRAND_ID, BrandRcpaTableMap::COL_COMPANY_ID, BrandRcpaTableMap::COL_CREATED_AT, BrandRcpaTableMap::COL_UPDATED_AT, BrandRcpaTableMap::COL_RCPA_MOYE, BrandRcpaTableMap::COL_COMPETITOR_ID, BrandRcpaTableMap::COL_REF_NAME, BrandRcpaTableMap::COL_PRODUCT_ID, BrandRcpaTableMap::COL_BRAND_RCPA_LAT_LONG, BrandRcpaTableMap::COL_BRAND_RCPA_ADDRESS, ],
        self::TYPE_FIELDNAME     => ['brcpa_id', 'outlet_id', 'retail_outlet_id', 'employee_id', 'rcpa_value', 'brand_id', 'company_id', 'created_at', 'updated_at', 'rcpa_moye', 'competitor_id', 'ref_name', 'product_id', 'brand_rcpa_lat_long', 'brand_rcpa_address', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, ]
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
        self::TYPE_PHPNAME       => ['BrcpaId' => 0, 'OutletId' => 1, 'RetailOutletId' => 2, 'EmployeeId' => 3, 'RcpaValue' => 4, 'BrandId' => 5, 'CompanyId' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, 'RcpaMoye' => 9, 'CompetitorId' => 10, 'RefName' => 11, 'ProductId' => 12, 'BrandRcpaLatLong' => 13, 'BrandRcpaAddress' => 14, ],
        self::TYPE_CAMELNAME     => ['brcpaId' => 0, 'outletId' => 1, 'retailOutletId' => 2, 'employeeId' => 3, 'rcpaValue' => 4, 'brandId' => 5, 'companyId' => 6, 'createdAt' => 7, 'updatedAt' => 8, 'rcpaMoye' => 9, 'competitorId' => 10, 'refName' => 11, 'productId' => 12, 'brandRcpaLatLong' => 13, 'brandRcpaAddress' => 14, ],
        self::TYPE_COLNAME       => [BrandRcpaTableMap::COL_BRCPA_ID => 0, BrandRcpaTableMap::COL_OUTLET_ID => 1, BrandRcpaTableMap::COL_RETAIL_OUTLET_ID => 2, BrandRcpaTableMap::COL_EMPLOYEE_ID => 3, BrandRcpaTableMap::COL_RCPA_VALUE => 4, BrandRcpaTableMap::COL_BRAND_ID => 5, BrandRcpaTableMap::COL_COMPANY_ID => 6, BrandRcpaTableMap::COL_CREATED_AT => 7, BrandRcpaTableMap::COL_UPDATED_AT => 8, BrandRcpaTableMap::COL_RCPA_MOYE => 9, BrandRcpaTableMap::COL_COMPETITOR_ID => 10, BrandRcpaTableMap::COL_REF_NAME => 11, BrandRcpaTableMap::COL_PRODUCT_ID => 12, BrandRcpaTableMap::COL_BRAND_RCPA_LAT_LONG => 13, BrandRcpaTableMap::COL_BRAND_RCPA_ADDRESS => 14, ],
        self::TYPE_FIELDNAME     => ['brcpa_id' => 0, 'outlet_id' => 1, 'retail_outlet_id' => 2, 'employee_id' => 3, 'rcpa_value' => 4, 'brand_id' => 5, 'company_id' => 6, 'created_at' => 7, 'updated_at' => 8, 'rcpa_moye' => 9, 'competitor_id' => 10, 'ref_name' => 11, 'product_id' => 12, 'brand_rcpa_lat_long' => 13, 'brand_rcpa_address' => 14, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'BrcpaId' => 'BRCPA_ID',
        'BrandRcpa.BrcpaId' => 'BRCPA_ID',
        'brcpaId' => 'BRCPA_ID',
        'brandRcpa.brcpaId' => 'BRCPA_ID',
        'BrandRcpaTableMap::COL_BRCPA_ID' => 'BRCPA_ID',
        'COL_BRCPA_ID' => 'BRCPA_ID',
        'brcpa_id' => 'BRCPA_ID',
        'brand_rcpa.brcpa_id' => 'BRCPA_ID',
        'OutletId' => 'OUTLET_ID',
        'BrandRcpa.OutletId' => 'OUTLET_ID',
        'outletId' => 'OUTLET_ID',
        'brandRcpa.outletId' => 'OUTLET_ID',
        'BrandRcpaTableMap::COL_OUTLET_ID' => 'OUTLET_ID',
        'COL_OUTLET_ID' => 'OUTLET_ID',
        'outlet_id' => 'OUTLET_ID',
        'brand_rcpa.outlet_id' => 'OUTLET_ID',
        'RetailOutletId' => 'RETAIL_OUTLET_ID',
        'BrandRcpa.RetailOutletId' => 'RETAIL_OUTLET_ID',
        'retailOutletId' => 'RETAIL_OUTLET_ID',
        'brandRcpa.retailOutletId' => 'RETAIL_OUTLET_ID',
        'BrandRcpaTableMap::COL_RETAIL_OUTLET_ID' => 'RETAIL_OUTLET_ID',
        'COL_RETAIL_OUTLET_ID' => 'RETAIL_OUTLET_ID',
        'retail_outlet_id' => 'RETAIL_OUTLET_ID',
        'brand_rcpa.retail_outlet_id' => 'RETAIL_OUTLET_ID',
        'EmployeeId' => 'EMPLOYEE_ID',
        'BrandRcpa.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'brandRcpa.employeeId' => 'EMPLOYEE_ID',
        'BrandRcpaTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'brand_rcpa.employee_id' => 'EMPLOYEE_ID',
        'RcpaValue' => 'RCPA_VALUE',
        'BrandRcpa.RcpaValue' => 'RCPA_VALUE',
        'rcpaValue' => 'RCPA_VALUE',
        'brandRcpa.rcpaValue' => 'RCPA_VALUE',
        'BrandRcpaTableMap::COL_RCPA_VALUE' => 'RCPA_VALUE',
        'COL_RCPA_VALUE' => 'RCPA_VALUE',
        'rcpa_value' => 'RCPA_VALUE',
        'brand_rcpa.rcpa_value' => 'RCPA_VALUE',
        'BrandId' => 'BRAND_ID',
        'BrandRcpa.BrandId' => 'BRAND_ID',
        'brandId' => 'BRAND_ID',
        'brandRcpa.brandId' => 'BRAND_ID',
        'BrandRcpaTableMap::COL_BRAND_ID' => 'BRAND_ID',
        'COL_BRAND_ID' => 'BRAND_ID',
        'brand_id' => 'BRAND_ID',
        'brand_rcpa.brand_id' => 'BRAND_ID',
        'CompanyId' => 'COMPANY_ID',
        'BrandRcpa.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'brandRcpa.companyId' => 'COMPANY_ID',
        'BrandRcpaTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'brand_rcpa.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'BrandRcpa.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'brandRcpa.createdAt' => 'CREATED_AT',
        'BrandRcpaTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'brand_rcpa.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'BrandRcpa.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'brandRcpa.updatedAt' => 'UPDATED_AT',
        'BrandRcpaTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'brand_rcpa.updated_at' => 'UPDATED_AT',
        'RcpaMoye' => 'RCPA_MOYE',
        'BrandRcpa.RcpaMoye' => 'RCPA_MOYE',
        'rcpaMoye' => 'RCPA_MOYE',
        'brandRcpa.rcpaMoye' => 'RCPA_MOYE',
        'BrandRcpaTableMap::COL_RCPA_MOYE' => 'RCPA_MOYE',
        'COL_RCPA_MOYE' => 'RCPA_MOYE',
        'rcpa_moye' => 'RCPA_MOYE',
        'brand_rcpa.rcpa_moye' => 'RCPA_MOYE',
        'CompetitorId' => 'COMPETITOR_ID',
        'BrandRcpa.CompetitorId' => 'COMPETITOR_ID',
        'competitorId' => 'COMPETITOR_ID',
        'brandRcpa.competitorId' => 'COMPETITOR_ID',
        'BrandRcpaTableMap::COL_COMPETITOR_ID' => 'COMPETITOR_ID',
        'COL_COMPETITOR_ID' => 'COMPETITOR_ID',
        'competitor_id' => 'COMPETITOR_ID',
        'brand_rcpa.competitor_id' => 'COMPETITOR_ID',
        'RefName' => 'REF_NAME',
        'BrandRcpa.RefName' => 'REF_NAME',
        'refName' => 'REF_NAME',
        'brandRcpa.refName' => 'REF_NAME',
        'BrandRcpaTableMap::COL_REF_NAME' => 'REF_NAME',
        'COL_REF_NAME' => 'REF_NAME',
        'ref_name' => 'REF_NAME',
        'brand_rcpa.ref_name' => 'REF_NAME',
        'ProductId' => 'PRODUCT_ID',
        'BrandRcpa.ProductId' => 'PRODUCT_ID',
        'productId' => 'PRODUCT_ID',
        'brandRcpa.productId' => 'PRODUCT_ID',
        'BrandRcpaTableMap::COL_PRODUCT_ID' => 'PRODUCT_ID',
        'COL_PRODUCT_ID' => 'PRODUCT_ID',
        'product_id' => 'PRODUCT_ID',
        'brand_rcpa.product_id' => 'PRODUCT_ID',
        'BrandRcpaLatLong' => 'BRAND_RCPA_LAT_LONG',
        'BrandRcpa.BrandRcpaLatLong' => 'BRAND_RCPA_LAT_LONG',
        'brandRcpaLatLong' => 'BRAND_RCPA_LAT_LONG',
        'brandRcpa.brandRcpaLatLong' => 'BRAND_RCPA_LAT_LONG',
        'BrandRcpaTableMap::COL_BRAND_RCPA_LAT_LONG' => 'BRAND_RCPA_LAT_LONG',
        'COL_BRAND_RCPA_LAT_LONG' => 'BRAND_RCPA_LAT_LONG',
        'brand_rcpa_lat_long' => 'BRAND_RCPA_LAT_LONG',
        'brand_rcpa.brand_rcpa_lat_long' => 'BRAND_RCPA_LAT_LONG',
        'BrandRcpaAddress' => 'BRAND_RCPA_ADDRESS',
        'BrandRcpa.BrandRcpaAddress' => 'BRAND_RCPA_ADDRESS',
        'brandRcpaAddress' => 'BRAND_RCPA_ADDRESS',
        'brandRcpa.brandRcpaAddress' => 'BRAND_RCPA_ADDRESS',
        'BrandRcpaTableMap::COL_BRAND_RCPA_ADDRESS' => 'BRAND_RCPA_ADDRESS',
        'COL_BRAND_RCPA_ADDRESS' => 'BRAND_RCPA_ADDRESS',
        'brand_rcpa_address' => 'BRAND_RCPA_ADDRESS',
        'brand_rcpa.brand_rcpa_address' => 'BRAND_RCPA_ADDRESS',
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
        $this->setName('brand_rcpa');
        $this->setPhpName('BrandRcpa');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\BrandRcpa');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('brand_rcpa_brcpa_id_seq');
        // columns
        $this->addPrimaryKey('brcpa_id', 'BrcpaId', 'INTEGER', true, null, null);
        $this->addForeignKey('outlet_id', 'OutletId', 'INTEGER', 'outlets', 'id', false, null, null);
        $this->addColumn('retail_outlet_id', 'RetailOutletId', 'INTEGER', false, null, null);
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', false, null, null);
        $this->addColumn('rcpa_value', 'RcpaValue', 'DECIMAL', false, null, null);
        $this->addForeignKey('brand_id', 'BrandId', 'INTEGER', 'brands', 'brand_id', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('rcpa_moye', 'RcpaMoye', 'VARCHAR', false, null, null);
        $this->addColumn('competitor_id', 'CompetitorId', 'INTEGER', false, null, null);
        $this->addColumn('ref_name', 'RefName', 'VARCHAR', false, null, null);
        $this->addColumn('product_id', 'ProductId', 'INTEGER', false, null, null);
        $this->addColumn('brand_rcpa_lat_long', 'BrandRcpaLatLong', 'VARCHAR', false, null, null);
        $this->addColumn('brand_rcpa_address', 'BrandRcpaAddress', 'VARCHAR', false, null, null);
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
        $this->addRelation('Brands', '\\entities\\Brands', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':brand_id',
    1 => ':brand_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrcpaId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrcpaId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrcpaId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrcpaId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrcpaId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrcpaId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('BrcpaId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? BrandRcpaTableMap::CLASS_DEFAULT : BrandRcpaTableMap::OM_CLASS;
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
     * @return array (BrandRcpa object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = BrandRcpaTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = BrandRcpaTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + BrandRcpaTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BrandRcpaTableMap::OM_CLASS;
            /** @var BrandRcpa $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            BrandRcpaTableMap::addInstanceToPool($obj, $key);
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
            $key = BrandRcpaTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = BrandRcpaTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var BrandRcpa $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BrandRcpaTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(BrandRcpaTableMap::COL_BRCPA_ID);
            $criteria->addSelectColumn(BrandRcpaTableMap::COL_OUTLET_ID);
            $criteria->addSelectColumn(BrandRcpaTableMap::COL_RETAIL_OUTLET_ID);
            $criteria->addSelectColumn(BrandRcpaTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(BrandRcpaTableMap::COL_RCPA_VALUE);
            $criteria->addSelectColumn(BrandRcpaTableMap::COL_BRAND_ID);
            $criteria->addSelectColumn(BrandRcpaTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(BrandRcpaTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(BrandRcpaTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(BrandRcpaTableMap::COL_RCPA_MOYE);
            $criteria->addSelectColumn(BrandRcpaTableMap::COL_COMPETITOR_ID);
            $criteria->addSelectColumn(BrandRcpaTableMap::COL_REF_NAME);
            $criteria->addSelectColumn(BrandRcpaTableMap::COL_PRODUCT_ID);
            $criteria->addSelectColumn(BrandRcpaTableMap::COL_BRAND_RCPA_LAT_LONG);
            $criteria->addSelectColumn(BrandRcpaTableMap::COL_BRAND_RCPA_ADDRESS);
        } else {
            $criteria->addSelectColumn($alias . '.brcpa_id');
            $criteria->addSelectColumn($alias . '.outlet_id');
            $criteria->addSelectColumn($alias . '.retail_outlet_id');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.rcpa_value');
            $criteria->addSelectColumn($alias . '.brand_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.rcpa_moye');
            $criteria->addSelectColumn($alias . '.competitor_id');
            $criteria->addSelectColumn($alias . '.ref_name');
            $criteria->addSelectColumn($alias . '.product_id');
            $criteria->addSelectColumn($alias . '.brand_rcpa_lat_long');
            $criteria->addSelectColumn($alias . '.brand_rcpa_address');
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
            $criteria->removeSelectColumn(BrandRcpaTableMap::COL_BRCPA_ID);
            $criteria->removeSelectColumn(BrandRcpaTableMap::COL_OUTLET_ID);
            $criteria->removeSelectColumn(BrandRcpaTableMap::COL_RETAIL_OUTLET_ID);
            $criteria->removeSelectColumn(BrandRcpaTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(BrandRcpaTableMap::COL_RCPA_VALUE);
            $criteria->removeSelectColumn(BrandRcpaTableMap::COL_BRAND_ID);
            $criteria->removeSelectColumn(BrandRcpaTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(BrandRcpaTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(BrandRcpaTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(BrandRcpaTableMap::COL_RCPA_MOYE);
            $criteria->removeSelectColumn(BrandRcpaTableMap::COL_COMPETITOR_ID);
            $criteria->removeSelectColumn(BrandRcpaTableMap::COL_REF_NAME);
            $criteria->removeSelectColumn(BrandRcpaTableMap::COL_PRODUCT_ID);
            $criteria->removeSelectColumn(BrandRcpaTableMap::COL_BRAND_RCPA_LAT_LONG);
            $criteria->removeSelectColumn(BrandRcpaTableMap::COL_BRAND_RCPA_ADDRESS);
        } else {
            $criteria->removeSelectColumn($alias . '.brcpa_id');
            $criteria->removeSelectColumn($alias . '.outlet_id');
            $criteria->removeSelectColumn($alias . '.retail_outlet_id');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.rcpa_value');
            $criteria->removeSelectColumn($alias . '.brand_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.rcpa_moye');
            $criteria->removeSelectColumn($alias . '.competitor_id');
            $criteria->removeSelectColumn($alias . '.ref_name');
            $criteria->removeSelectColumn($alias . '.product_id');
            $criteria->removeSelectColumn($alias . '.brand_rcpa_lat_long');
            $criteria->removeSelectColumn($alias . '.brand_rcpa_address');
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
        return Propel::getServiceContainer()->getDatabaseMap(BrandRcpaTableMap::DATABASE_NAME)->getTable(BrandRcpaTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a BrandRcpa or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or BrandRcpa object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(BrandRcpaTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\BrandRcpa) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BrandRcpaTableMap::DATABASE_NAME);
            $criteria->add(BrandRcpaTableMap::COL_BRCPA_ID, (array) $values, Criteria::IN);
        }

        $query = BrandRcpaQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            BrandRcpaTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                BrandRcpaTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the brand_rcpa table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return BrandRcpaQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a BrandRcpa or Criteria object.
     *
     * @param mixed $criteria Criteria or BrandRcpa object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BrandRcpaTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from BrandRcpa object
        }

        if ($criteria->containsKey(BrandRcpaTableMap::COL_BRCPA_ID) && $criteria->keyContainsValue(BrandRcpaTableMap::COL_BRCPA_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BrandRcpaTableMap::COL_BRCPA_ID.')');
        }


        // Set the correct dbName
        $query = BrandRcpaQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
