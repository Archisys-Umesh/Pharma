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
use entities\TempEntronRcpaRestore;
use entities\TempEntronRcpaRestoreQuery;


/**
 * This class defines the structure of the 'temp_entron_rcpa_restore' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class TempEntronRcpaRestoreTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.TempEntronRcpaRestoreTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'temp_entron_rcpa_restore';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'TempEntronRcpaRestore';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\TempEntronRcpaRestore';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.TempEntronRcpaRestore';

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
     * the column name for the brcpa_id field
     */
    public const COL_BRCPA_ID = 'temp_entron_rcpa_restore.brcpa_id';

    /**
     * the column name for the outlet_id field
     */
    public const COL_OUTLET_ID = 'temp_entron_rcpa_restore.outlet_id';

    /**
     * the column name for the retail_outlet_id field
     */
    public const COL_RETAIL_OUTLET_ID = 'temp_entron_rcpa_restore.retail_outlet_id';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'temp_entron_rcpa_restore.employee_id';

    /**
     * the column name for the rcpa_value field
     */
    public const COL_RCPA_VALUE = 'temp_entron_rcpa_restore.rcpa_value';

    /**
     * the column name for the brand_id field
     */
    public const COL_BRAND_ID = 'temp_entron_rcpa_restore.brand_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'temp_entron_rcpa_restore.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'temp_entron_rcpa_restore.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'temp_entron_rcpa_restore.updated_at';

    /**
     * the column name for the rcpa_moye field
     */
    public const COL_RCPA_MOYE = 'temp_entron_rcpa_restore.rcpa_moye';

    /**
     * the column name for the competitor_id field
     */
    public const COL_COMPETITOR_ID = 'temp_entron_rcpa_restore.competitor_id';

    /**
     * the column name for the ref_name field
     */
    public const COL_REF_NAME = 'temp_entron_rcpa_restore.ref_name';

    /**
     * the column name for the product_id field
     */
    public const COL_PRODUCT_ID = 'temp_entron_rcpa_restore.product_id';

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
        self::TYPE_PHPNAME       => ['BrcpaId', 'OutletId', 'RetailOutletId', 'EmployeeId', 'RcpaValue', 'BrandId', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'RcpaMoye', 'CompetitorId', 'RefName', 'ProductId', ],
        self::TYPE_CAMELNAME     => ['brcpaId', 'outletId', 'retailOutletId', 'employeeId', 'rcpaValue', 'brandId', 'companyId', 'createdAt', 'updatedAt', 'rcpaMoye', 'competitorId', 'refName', 'productId', ],
        self::TYPE_COLNAME       => [TempEntronRcpaRestoreTableMap::COL_BRCPA_ID, TempEntronRcpaRestoreTableMap::COL_OUTLET_ID, TempEntronRcpaRestoreTableMap::COL_RETAIL_OUTLET_ID, TempEntronRcpaRestoreTableMap::COL_EMPLOYEE_ID, TempEntronRcpaRestoreTableMap::COL_RCPA_VALUE, TempEntronRcpaRestoreTableMap::COL_BRAND_ID, TempEntronRcpaRestoreTableMap::COL_COMPANY_ID, TempEntronRcpaRestoreTableMap::COL_CREATED_AT, TempEntronRcpaRestoreTableMap::COL_UPDATED_AT, TempEntronRcpaRestoreTableMap::COL_RCPA_MOYE, TempEntronRcpaRestoreTableMap::COL_COMPETITOR_ID, TempEntronRcpaRestoreTableMap::COL_REF_NAME, TempEntronRcpaRestoreTableMap::COL_PRODUCT_ID, ],
        self::TYPE_FIELDNAME     => ['brcpa_id', 'outlet_id', 'retail_outlet_id', 'employee_id', 'rcpa_value', 'brand_id', 'company_id', 'created_at', 'updated_at', 'rcpa_moye', 'competitor_id', 'ref_name', 'product_id', ],
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
        self::TYPE_PHPNAME       => ['BrcpaId' => 0, 'OutletId' => 1, 'RetailOutletId' => 2, 'EmployeeId' => 3, 'RcpaValue' => 4, 'BrandId' => 5, 'CompanyId' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, 'RcpaMoye' => 9, 'CompetitorId' => 10, 'RefName' => 11, 'ProductId' => 12, ],
        self::TYPE_CAMELNAME     => ['brcpaId' => 0, 'outletId' => 1, 'retailOutletId' => 2, 'employeeId' => 3, 'rcpaValue' => 4, 'brandId' => 5, 'companyId' => 6, 'createdAt' => 7, 'updatedAt' => 8, 'rcpaMoye' => 9, 'competitorId' => 10, 'refName' => 11, 'productId' => 12, ],
        self::TYPE_COLNAME       => [TempEntronRcpaRestoreTableMap::COL_BRCPA_ID => 0, TempEntronRcpaRestoreTableMap::COL_OUTLET_ID => 1, TempEntronRcpaRestoreTableMap::COL_RETAIL_OUTLET_ID => 2, TempEntronRcpaRestoreTableMap::COL_EMPLOYEE_ID => 3, TempEntronRcpaRestoreTableMap::COL_RCPA_VALUE => 4, TempEntronRcpaRestoreTableMap::COL_BRAND_ID => 5, TempEntronRcpaRestoreTableMap::COL_COMPANY_ID => 6, TempEntronRcpaRestoreTableMap::COL_CREATED_AT => 7, TempEntronRcpaRestoreTableMap::COL_UPDATED_AT => 8, TempEntronRcpaRestoreTableMap::COL_RCPA_MOYE => 9, TempEntronRcpaRestoreTableMap::COL_COMPETITOR_ID => 10, TempEntronRcpaRestoreTableMap::COL_REF_NAME => 11, TempEntronRcpaRestoreTableMap::COL_PRODUCT_ID => 12, ],
        self::TYPE_FIELDNAME     => ['brcpa_id' => 0, 'outlet_id' => 1, 'retail_outlet_id' => 2, 'employee_id' => 3, 'rcpa_value' => 4, 'brand_id' => 5, 'company_id' => 6, 'created_at' => 7, 'updated_at' => 8, 'rcpa_moye' => 9, 'competitor_id' => 10, 'ref_name' => 11, 'product_id' => 12, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'BrcpaId' => 'BRCPA_ID',
        'TempEntronRcpaRestore.BrcpaId' => 'BRCPA_ID',
        'brcpaId' => 'BRCPA_ID',
        'tempEntronRcpaRestore.brcpaId' => 'BRCPA_ID',
        'TempEntronRcpaRestoreTableMap::COL_BRCPA_ID' => 'BRCPA_ID',
        'COL_BRCPA_ID' => 'BRCPA_ID',
        'brcpa_id' => 'BRCPA_ID',
        'temp_entron_rcpa_restore.brcpa_id' => 'BRCPA_ID',
        'OutletId' => 'OUTLET_ID',
        'TempEntronRcpaRestore.OutletId' => 'OUTLET_ID',
        'outletId' => 'OUTLET_ID',
        'tempEntronRcpaRestore.outletId' => 'OUTLET_ID',
        'TempEntronRcpaRestoreTableMap::COL_OUTLET_ID' => 'OUTLET_ID',
        'COL_OUTLET_ID' => 'OUTLET_ID',
        'outlet_id' => 'OUTLET_ID',
        'temp_entron_rcpa_restore.outlet_id' => 'OUTLET_ID',
        'RetailOutletId' => 'RETAIL_OUTLET_ID',
        'TempEntronRcpaRestore.RetailOutletId' => 'RETAIL_OUTLET_ID',
        'retailOutletId' => 'RETAIL_OUTLET_ID',
        'tempEntronRcpaRestore.retailOutletId' => 'RETAIL_OUTLET_ID',
        'TempEntronRcpaRestoreTableMap::COL_RETAIL_OUTLET_ID' => 'RETAIL_OUTLET_ID',
        'COL_RETAIL_OUTLET_ID' => 'RETAIL_OUTLET_ID',
        'retail_outlet_id' => 'RETAIL_OUTLET_ID',
        'temp_entron_rcpa_restore.retail_outlet_id' => 'RETAIL_OUTLET_ID',
        'EmployeeId' => 'EMPLOYEE_ID',
        'TempEntronRcpaRestore.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'tempEntronRcpaRestore.employeeId' => 'EMPLOYEE_ID',
        'TempEntronRcpaRestoreTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'temp_entron_rcpa_restore.employee_id' => 'EMPLOYEE_ID',
        'RcpaValue' => 'RCPA_VALUE',
        'TempEntronRcpaRestore.RcpaValue' => 'RCPA_VALUE',
        'rcpaValue' => 'RCPA_VALUE',
        'tempEntronRcpaRestore.rcpaValue' => 'RCPA_VALUE',
        'TempEntronRcpaRestoreTableMap::COL_RCPA_VALUE' => 'RCPA_VALUE',
        'COL_RCPA_VALUE' => 'RCPA_VALUE',
        'rcpa_value' => 'RCPA_VALUE',
        'temp_entron_rcpa_restore.rcpa_value' => 'RCPA_VALUE',
        'BrandId' => 'BRAND_ID',
        'TempEntronRcpaRestore.BrandId' => 'BRAND_ID',
        'brandId' => 'BRAND_ID',
        'tempEntronRcpaRestore.brandId' => 'BRAND_ID',
        'TempEntronRcpaRestoreTableMap::COL_BRAND_ID' => 'BRAND_ID',
        'COL_BRAND_ID' => 'BRAND_ID',
        'brand_id' => 'BRAND_ID',
        'temp_entron_rcpa_restore.brand_id' => 'BRAND_ID',
        'CompanyId' => 'COMPANY_ID',
        'TempEntronRcpaRestore.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'tempEntronRcpaRestore.companyId' => 'COMPANY_ID',
        'TempEntronRcpaRestoreTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'temp_entron_rcpa_restore.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'TempEntronRcpaRestore.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'tempEntronRcpaRestore.createdAt' => 'CREATED_AT',
        'TempEntronRcpaRestoreTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'temp_entron_rcpa_restore.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'TempEntronRcpaRestore.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'tempEntronRcpaRestore.updatedAt' => 'UPDATED_AT',
        'TempEntronRcpaRestoreTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'temp_entron_rcpa_restore.updated_at' => 'UPDATED_AT',
        'RcpaMoye' => 'RCPA_MOYE',
        'TempEntronRcpaRestore.RcpaMoye' => 'RCPA_MOYE',
        'rcpaMoye' => 'RCPA_MOYE',
        'tempEntronRcpaRestore.rcpaMoye' => 'RCPA_MOYE',
        'TempEntronRcpaRestoreTableMap::COL_RCPA_MOYE' => 'RCPA_MOYE',
        'COL_RCPA_MOYE' => 'RCPA_MOYE',
        'rcpa_moye' => 'RCPA_MOYE',
        'temp_entron_rcpa_restore.rcpa_moye' => 'RCPA_MOYE',
        'CompetitorId' => 'COMPETITOR_ID',
        'TempEntronRcpaRestore.CompetitorId' => 'COMPETITOR_ID',
        'competitorId' => 'COMPETITOR_ID',
        'tempEntronRcpaRestore.competitorId' => 'COMPETITOR_ID',
        'TempEntronRcpaRestoreTableMap::COL_COMPETITOR_ID' => 'COMPETITOR_ID',
        'COL_COMPETITOR_ID' => 'COMPETITOR_ID',
        'competitor_id' => 'COMPETITOR_ID',
        'temp_entron_rcpa_restore.competitor_id' => 'COMPETITOR_ID',
        'RefName' => 'REF_NAME',
        'TempEntronRcpaRestore.RefName' => 'REF_NAME',
        'refName' => 'REF_NAME',
        'tempEntronRcpaRestore.refName' => 'REF_NAME',
        'TempEntronRcpaRestoreTableMap::COL_REF_NAME' => 'REF_NAME',
        'COL_REF_NAME' => 'REF_NAME',
        'ref_name' => 'REF_NAME',
        'temp_entron_rcpa_restore.ref_name' => 'REF_NAME',
        'ProductId' => 'PRODUCT_ID',
        'TempEntronRcpaRestore.ProductId' => 'PRODUCT_ID',
        'productId' => 'PRODUCT_ID',
        'tempEntronRcpaRestore.productId' => 'PRODUCT_ID',
        'TempEntronRcpaRestoreTableMap::COL_PRODUCT_ID' => 'PRODUCT_ID',
        'COL_PRODUCT_ID' => 'PRODUCT_ID',
        'product_id' => 'PRODUCT_ID',
        'temp_entron_rcpa_restore.product_id' => 'PRODUCT_ID',
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
        $this->setName('temp_entron_rcpa_restore');
        $this->setPhpName('TempEntronRcpaRestore');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\TempEntronRcpaRestore');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addColumn('brcpa_id', 'BrcpaId', 'INTEGER', false, null, null);
        $this->addColumn('outlet_id', 'OutletId', 'INTEGER', false, null, null);
        $this->addColumn('retail_outlet_id', 'RetailOutletId', 'INTEGER', false, null, null);
        $this->addColumn('employee_id', 'EmployeeId', 'INTEGER', false, null, null);
        $this->addColumn('rcpa_value', 'RcpaValue', 'DECIMAL', false, null, null);
        $this->addColumn('brand_id', 'BrandId', 'INTEGER', false, null, null);
        $this->addColumn('company_id', 'CompanyId', 'INTEGER', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('rcpa_moye', 'RcpaMoye', 'VARCHAR', false, null, null);
        $this->addColumn('competitor_id', 'CompetitorId', 'INTEGER', false, null, null);
        $this->addColumn('ref_name', 'RefName', 'VARCHAR', false, null, null);
        $this->addColumn('product_id', 'ProductId', 'INTEGER', false, null, null);
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
        return $withPrefix ? TempEntronRcpaRestoreTableMap::CLASS_DEFAULT : TempEntronRcpaRestoreTableMap::OM_CLASS;
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
     * @return array (TempEntronRcpaRestore object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = TempEntronRcpaRestoreTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = TempEntronRcpaRestoreTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + TempEntronRcpaRestoreTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TempEntronRcpaRestoreTableMap::OM_CLASS;
            /** @var TempEntronRcpaRestore $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            TempEntronRcpaRestoreTableMap::addInstanceToPool($obj, $key);
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
            $key = TempEntronRcpaRestoreTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = TempEntronRcpaRestoreTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var TempEntronRcpaRestore $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TempEntronRcpaRestoreTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(TempEntronRcpaRestoreTableMap::COL_BRCPA_ID);
            $criteria->addSelectColumn(TempEntronRcpaRestoreTableMap::COL_OUTLET_ID);
            $criteria->addSelectColumn(TempEntronRcpaRestoreTableMap::COL_RETAIL_OUTLET_ID);
            $criteria->addSelectColumn(TempEntronRcpaRestoreTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(TempEntronRcpaRestoreTableMap::COL_RCPA_VALUE);
            $criteria->addSelectColumn(TempEntronRcpaRestoreTableMap::COL_BRAND_ID);
            $criteria->addSelectColumn(TempEntronRcpaRestoreTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(TempEntronRcpaRestoreTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(TempEntronRcpaRestoreTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(TempEntronRcpaRestoreTableMap::COL_RCPA_MOYE);
            $criteria->addSelectColumn(TempEntronRcpaRestoreTableMap::COL_COMPETITOR_ID);
            $criteria->addSelectColumn(TempEntronRcpaRestoreTableMap::COL_REF_NAME);
            $criteria->addSelectColumn(TempEntronRcpaRestoreTableMap::COL_PRODUCT_ID);
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
            $criteria->removeSelectColumn(TempEntronRcpaRestoreTableMap::COL_BRCPA_ID);
            $criteria->removeSelectColumn(TempEntronRcpaRestoreTableMap::COL_OUTLET_ID);
            $criteria->removeSelectColumn(TempEntronRcpaRestoreTableMap::COL_RETAIL_OUTLET_ID);
            $criteria->removeSelectColumn(TempEntronRcpaRestoreTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(TempEntronRcpaRestoreTableMap::COL_RCPA_VALUE);
            $criteria->removeSelectColumn(TempEntronRcpaRestoreTableMap::COL_BRAND_ID);
            $criteria->removeSelectColumn(TempEntronRcpaRestoreTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(TempEntronRcpaRestoreTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(TempEntronRcpaRestoreTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(TempEntronRcpaRestoreTableMap::COL_RCPA_MOYE);
            $criteria->removeSelectColumn(TempEntronRcpaRestoreTableMap::COL_COMPETITOR_ID);
            $criteria->removeSelectColumn(TempEntronRcpaRestoreTableMap::COL_REF_NAME);
            $criteria->removeSelectColumn(TempEntronRcpaRestoreTableMap::COL_PRODUCT_ID);
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
        return Propel::getServiceContainer()->getDatabaseMap(TempEntronRcpaRestoreTableMap::DATABASE_NAME)->getTable(TempEntronRcpaRestoreTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a TempEntronRcpaRestore or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or TempEntronRcpaRestore object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(TempEntronRcpaRestoreTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\TempEntronRcpaRestore) { // it's a model object
            // create criteria based on pk value
            $criteria = $values->buildCriteria();
        } else { // it's a primary key, or an array of pks
            throw new LogicException('The TempEntronRcpaRestore object has no primary key');
        }

        $query = TempEntronRcpaRestoreQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            TempEntronRcpaRestoreTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                TempEntronRcpaRestoreTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the temp_entron_rcpa_restore table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return TempEntronRcpaRestoreQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a TempEntronRcpaRestore or Criteria object.
     *
     * @param mixed $criteria Criteria or TempEntronRcpaRestore object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TempEntronRcpaRestoreTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from TempEntronRcpaRestore object
        }


        // Set the correct dbName
        $query = TempEntronRcpaRestoreQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
