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
use entities\OutletStock;
use entities\OutletStockQuery;


/**
 * This class defines the structure of the 'outlet_stock' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OutletStockTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OutletStockTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'outlet_stock';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OutletStock';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OutletStock';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OutletStock';

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
     * the column name for the outlet_stock_id field
     */
    public const COL_OUTLET_STOCK_ID = 'outlet_stock.outlet_stock_id';

    /**
     * the column name for the outlet_id field
     */
    public const COL_OUTLET_ID = 'outlet_stock.outlet_id';

    /**
     * the column name for the product_id field
     */
    public const COL_PRODUCT_ID = 'outlet_stock.product_id';

    /**
     * the column name for the free_qty field
     */
    public const COL_FREE_QTY = 'outlet_stock.free_qty';

    /**
     * the column name for the reserved_qty field
     */
    public const COL_RESERVED_QTY = 'outlet_stock.reserved_qty';

    /**
     * the column name for the bsd_qty field
     */
    public const COL_BSD_QTY = 'outlet_stock.bsd_qty';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'outlet_stock.company_id';

    /**
     * the column name for the last_sync field
     */
    public const COL_LAST_SYNC = 'outlet_stock.last_sync';

    /**
     * the column name for the brand_id field
     */
    public const COL_BRAND_ID = 'outlet_stock.brand_id';

    /**
     * the column name for the outlet_org_id field
     */
    public const COL_OUTLET_ORG_ID = 'outlet_stock.outlet_org_id';

    /**
     * the column name for the closing_qty field
     */
    public const COL_CLOSING_QTY = 'outlet_stock.closing_qty';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'outlet_stock.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'outlet_stock.updated_at';

    /**
     * the column name for the competitor_id field
     */
    public const COL_COMPETITOR_ID = 'outlet_stock.competitor_id';

    /**
     * the column name for the orgunitid field
     */
    public const COL_ORGUNITID = 'outlet_stock.orgunitid';

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
        self::TYPE_PHPNAME       => ['OutletStockId', 'OutletId', 'ProductId', 'FreeQty', 'ReservedQty', 'BsdQty', 'CompanyId', 'LastSync', 'BrandId', 'OutletOrgId', 'ClosingQty', 'CreatedAt', 'UpdatedAt', 'CompetitorId', 'Orgunitid', ],
        self::TYPE_CAMELNAME     => ['outletStockId', 'outletId', 'productId', 'freeQty', 'reservedQty', 'bsdQty', 'companyId', 'lastSync', 'brandId', 'outletOrgId', 'closingQty', 'createdAt', 'updatedAt', 'competitorId', 'orgunitid', ],
        self::TYPE_COLNAME       => [OutletStockTableMap::COL_OUTLET_STOCK_ID, OutletStockTableMap::COL_OUTLET_ID, OutletStockTableMap::COL_PRODUCT_ID, OutletStockTableMap::COL_FREE_QTY, OutletStockTableMap::COL_RESERVED_QTY, OutletStockTableMap::COL_BSD_QTY, OutletStockTableMap::COL_COMPANY_ID, OutletStockTableMap::COL_LAST_SYNC, OutletStockTableMap::COL_BRAND_ID, OutletStockTableMap::COL_OUTLET_ORG_ID, OutletStockTableMap::COL_CLOSING_QTY, OutletStockTableMap::COL_CREATED_AT, OutletStockTableMap::COL_UPDATED_AT, OutletStockTableMap::COL_COMPETITOR_ID, OutletStockTableMap::COL_ORGUNITID, ],
        self::TYPE_FIELDNAME     => ['outlet_stock_id', 'outlet_id', 'product_id', 'free_qty', 'reserved_qty', 'bsd_qty', 'company_id', 'last_sync', 'brand_id', 'outlet_org_id', 'closing_qty', 'created_at', 'updated_at', 'competitor_id', 'orgunitid', ],
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
        self::TYPE_PHPNAME       => ['OutletStockId' => 0, 'OutletId' => 1, 'ProductId' => 2, 'FreeQty' => 3, 'ReservedQty' => 4, 'BsdQty' => 5, 'CompanyId' => 6, 'LastSync' => 7, 'BrandId' => 8, 'OutletOrgId' => 9, 'ClosingQty' => 10, 'CreatedAt' => 11, 'UpdatedAt' => 12, 'CompetitorId' => 13, 'Orgunitid' => 14, ],
        self::TYPE_CAMELNAME     => ['outletStockId' => 0, 'outletId' => 1, 'productId' => 2, 'freeQty' => 3, 'reservedQty' => 4, 'bsdQty' => 5, 'companyId' => 6, 'lastSync' => 7, 'brandId' => 8, 'outletOrgId' => 9, 'closingQty' => 10, 'createdAt' => 11, 'updatedAt' => 12, 'competitorId' => 13, 'orgunitid' => 14, ],
        self::TYPE_COLNAME       => [OutletStockTableMap::COL_OUTLET_STOCK_ID => 0, OutletStockTableMap::COL_OUTLET_ID => 1, OutletStockTableMap::COL_PRODUCT_ID => 2, OutletStockTableMap::COL_FREE_QTY => 3, OutletStockTableMap::COL_RESERVED_QTY => 4, OutletStockTableMap::COL_BSD_QTY => 5, OutletStockTableMap::COL_COMPANY_ID => 6, OutletStockTableMap::COL_LAST_SYNC => 7, OutletStockTableMap::COL_BRAND_ID => 8, OutletStockTableMap::COL_OUTLET_ORG_ID => 9, OutletStockTableMap::COL_CLOSING_QTY => 10, OutletStockTableMap::COL_CREATED_AT => 11, OutletStockTableMap::COL_UPDATED_AT => 12, OutletStockTableMap::COL_COMPETITOR_ID => 13, OutletStockTableMap::COL_ORGUNITID => 14, ],
        self::TYPE_FIELDNAME     => ['outlet_stock_id' => 0, 'outlet_id' => 1, 'product_id' => 2, 'free_qty' => 3, 'reserved_qty' => 4, 'bsd_qty' => 5, 'company_id' => 6, 'last_sync' => 7, 'brand_id' => 8, 'outlet_org_id' => 9, 'closing_qty' => 10, 'created_at' => 11, 'updated_at' => 12, 'competitor_id' => 13, 'orgunitid' => 14, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OutletStockId' => 'OUTLET_STOCK_ID',
        'OutletStock.OutletStockId' => 'OUTLET_STOCK_ID',
        'outletStockId' => 'OUTLET_STOCK_ID',
        'outletStock.outletStockId' => 'OUTLET_STOCK_ID',
        'OutletStockTableMap::COL_OUTLET_STOCK_ID' => 'OUTLET_STOCK_ID',
        'COL_OUTLET_STOCK_ID' => 'OUTLET_STOCK_ID',
        'outlet_stock_id' => 'OUTLET_STOCK_ID',
        'outlet_stock.outlet_stock_id' => 'OUTLET_STOCK_ID',
        'OutletId' => 'OUTLET_ID',
        'OutletStock.OutletId' => 'OUTLET_ID',
        'outletId' => 'OUTLET_ID',
        'outletStock.outletId' => 'OUTLET_ID',
        'OutletStockTableMap::COL_OUTLET_ID' => 'OUTLET_ID',
        'COL_OUTLET_ID' => 'OUTLET_ID',
        'outlet_id' => 'OUTLET_ID',
        'outlet_stock.outlet_id' => 'OUTLET_ID',
        'ProductId' => 'PRODUCT_ID',
        'OutletStock.ProductId' => 'PRODUCT_ID',
        'productId' => 'PRODUCT_ID',
        'outletStock.productId' => 'PRODUCT_ID',
        'OutletStockTableMap::COL_PRODUCT_ID' => 'PRODUCT_ID',
        'COL_PRODUCT_ID' => 'PRODUCT_ID',
        'product_id' => 'PRODUCT_ID',
        'outlet_stock.product_id' => 'PRODUCT_ID',
        'FreeQty' => 'FREE_QTY',
        'OutletStock.FreeQty' => 'FREE_QTY',
        'freeQty' => 'FREE_QTY',
        'outletStock.freeQty' => 'FREE_QTY',
        'OutletStockTableMap::COL_FREE_QTY' => 'FREE_QTY',
        'COL_FREE_QTY' => 'FREE_QTY',
        'free_qty' => 'FREE_QTY',
        'outlet_stock.free_qty' => 'FREE_QTY',
        'ReservedQty' => 'RESERVED_QTY',
        'OutletStock.ReservedQty' => 'RESERVED_QTY',
        'reservedQty' => 'RESERVED_QTY',
        'outletStock.reservedQty' => 'RESERVED_QTY',
        'OutletStockTableMap::COL_RESERVED_QTY' => 'RESERVED_QTY',
        'COL_RESERVED_QTY' => 'RESERVED_QTY',
        'reserved_qty' => 'RESERVED_QTY',
        'outlet_stock.reserved_qty' => 'RESERVED_QTY',
        'BsdQty' => 'BSD_QTY',
        'OutletStock.BsdQty' => 'BSD_QTY',
        'bsdQty' => 'BSD_QTY',
        'outletStock.bsdQty' => 'BSD_QTY',
        'OutletStockTableMap::COL_BSD_QTY' => 'BSD_QTY',
        'COL_BSD_QTY' => 'BSD_QTY',
        'bsd_qty' => 'BSD_QTY',
        'outlet_stock.bsd_qty' => 'BSD_QTY',
        'CompanyId' => 'COMPANY_ID',
        'OutletStock.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'outletStock.companyId' => 'COMPANY_ID',
        'OutletStockTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'outlet_stock.company_id' => 'COMPANY_ID',
        'LastSync' => 'LAST_SYNC',
        'OutletStock.LastSync' => 'LAST_SYNC',
        'lastSync' => 'LAST_SYNC',
        'outletStock.lastSync' => 'LAST_SYNC',
        'OutletStockTableMap::COL_LAST_SYNC' => 'LAST_SYNC',
        'COL_LAST_SYNC' => 'LAST_SYNC',
        'last_sync' => 'LAST_SYNC',
        'outlet_stock.last_sync' => 'LAST_SYNC',
        'BrandId' => 'BRAND_ID',
        'OutletStock.BrandId' => 'BRAND_ID',
        'brandId' => 'BRAND_ID',
        'outletStock.brandId' => 'BRAND_ID',
        'OutletStockTableMap::COL_BRAND_ID' => 'BRAND_ID',
        'COL_BRAND_ID' => 'BRAND_ID',
        'brand_id' => 'BRAND_ID',
        'outlet_stock.brand_id' => 'BRAND_ID',
        'OutletOrgId' => 'OUTLET_ORG_ID',
        'OutletStock.OutletOrgId' => 'OUTLET_ORG_ID',
        'outletOrgId' => 'OUTLET_ORG_ID',
        'outletStock.outletOrgId' => 'OUTLET_ORG_ID',
        'OutletStockTableMap::COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'outlet_org_id' => 'OUTLET_ORG_ID',
        'outlet_stock.outlet_org_id' => 'OUTLET_ORG_ID',
        'ClosingQty' => 'CLOSING_QTY',
        'OutletStock.ClosingQty' => 'CLOSING_QTY',
        'closingQty' => 'CLOSING_QTY',
        'outletStock.closingQty' => 'CLOSING_QTY',
        'OutletStockTableMap::COL_CLOSING_QTY' => 'CLOSING_QTY',
        'COL_CLOSING_QTY' => 'CLOSING_QTY',
        'closing_qty' => 'CLOSING_QTY',
        'outlet_stock.closing_qty' => 'CLOSING_QTY',
        'CreatedAt' => 'CREATED_AT',
        'OutletStock.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'outletStock.createdAt' => 'CREATED_AT',
        'OutletStockTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'outlet_stock.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'OutletStock.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'outletStock.updatedAt' => 'UPDATED_AT',
        'OutletStockTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'outlet_stock.updated_at' => 'UPDATED_AT',
        'CompetitorId' => 'COMPETITOR_ID',
        'OutletStock.CompetitorId' => 'COMPETITOR_ID',
        'competitorId' => 'COMPETITOR_ID',
        'outletStock.competitorId' => 'COMPETITOR_ID',
        'OutletStockTableMap::COL_COMPETITOR_ID' => 'COMPETITOR_ID',
        'COL_COMPETITOR_ID' => 'COMPETITOR_ID',
        'competitor_id' => 'COMPETITOR_ID',
        'outlet_stock.competitor_id' => 'COMPETITOR_ID',
        'Orgunitid' => 'ORGUNITID',
        'OutletStock.Orgunitid' => 'ORGUNITID',
        'orgunitid' => 'ORGUNITID',
        'outletStock.orgunitid' => 'ORGUNITID',
        'OutletStockTableMap::COL_ORGUNITID' => 'ORGUNITID',
        'COL_ORGUNITID' => 'ORGUNITID',
        'outlet_stock.orgunitid' => 'ORGUNITID',
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
        $this->setName('outlet_stock');
        $this->setPhpName('OutletStock');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OutletStock');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('outlet_stock_outlet_stock_id_seq');
        // columns
        $this->addPrimaryKey('outlet_stock_id', 'OutletStockId', 'BIGINT', true, null, null);
        $this->addForeignKey('outlet_id', 'OutletId', 'INTEGER', 'outlets', 'id', true, null, null);
        $this->addForeignKey('product_id', 'ProductId', 'INTEGER', 'products', 'id', true, null, null);
        $this->addColumn('free_qty', 'FreeQty', 'INTEGER', false, null, null);
        $this->addColumn('reserved_qty', 'ReservedQty', 'INTEGER', false, null, null);
        $this->addColumn('bsd_qty', 'BsdQty', 'INTEGER', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addColumn('last_sync', 'LastSync', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('brand_id', 'BrandId', 'INTEGER', 'brands', 'brand_id', true, null, null);
        $this->addForeignKey('outlet_org_id', 'OutletOrgId', 'INTEGER', 'outlet_org_data', 'outlet_org_id', true, null, null);
        $this->addColumn('closing_qty', 'ClosingQty', 'INTEGER', true, null, 0);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('competitor_id', 'CompetitorId', 'INTEGER', false, null, null);
        $this->addForeignKey('orgunitid', 'Orgunitid', 'INTEGER', 'org_unit', 'orgunitid', false, null, null);
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
        $this->addRelation('Outlets', '\\entities\\Outlets', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Products', '\\entities\\Products', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Brands', '\\entities\\Brands', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':brand_id',
    1 => ':brand_id',
  ),
), null, null, null, false);
        $this->addRelation('OrgUnit', '\\entities\\OrgUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':orgunitid',
    1 => ':orgunitid',
  ),
), null, null, null, false);
        $this->addRelation('OutletOrgData', '\\entities\\OutletOrgData', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_org_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletStockId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletStockId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletStockId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletStockId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletStockId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletStockId', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('OutletStockId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OutletStockTableMap::CLASS_DEFAULT : OutletStockTableMap::OM_CLASS;
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
     * @return array (OutletStock object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OutletStockTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OutletStockTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OutletStockTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OutletStockTableMap::OM_CLASS;
            /** @var OutletStock $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OutletStockTableMap::addInstanceToPool($obj, $key);
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
            $key = OutletStockTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OutletStockTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OutletStock $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OutletStockTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OutletStockTableMap::COL_OUTLET_STOCK_ID);
            $criteria->addSelectColumn(OutletStockTableMap::COL_OUTLET_ID);
            $criteria->addSelectColumn(OutletStockTableMap::COL_PRODUCT_ID);
            $criteria->addSelectColumn(OutletStockTableMap::COL_FREE_QTY);
            $criteria->addSelectColumn(OutletStockTableMap::COL_RESERVED_QTY);
            $criteria->addSelectColumn(OutletStockTableMap::COL_BSD_QTY);
            $criteria->addSelectColumn(OutletStockTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(OutletStockTableMap::COL_LAST_SYNC);
            $criteria->addSelectColumn(OutletStockTableMap::COL_BRAND_ID);
            $criteria->addSelectColumn(OutletStockTableMap::COL_OUTLET_ORG_ID);
            $criteria->addSelectColumn(OutletStockTableMap::COL_CLOSING_QTY);
            $criteria->addSelectColumn(OutletStockTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OutletStockTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(OutletStockTableMap::COL_COMPETITOR_ID);
            $criteria->addSelectColumn(OutletStockTableMap::COL_ORGUNITID);
        } else {
            $criteria->addSelectColumn($alias . '.outlet_stock_id');
            $criteria->addSelectColumn($alias . '.outlet_id');
            $criteria->addSelectColumn($alias . '.product_id');
            $criteria->addSelectColumn($alias . '.free_qty');
            $criteria->addSelectColumn($alias . '.reserved_qty');
            $criteria->addSelectColumn($alias . '.bsd_qty');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.last_sync');
            $criteria->addSelectColumn($alias . '.brand_id');
            $criteria->addSelectColumn($alias . '.outlet_org_id');
            $criteria->addSelectColumn($alias . '.closing_qty');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.competitor_id');
            $criteria->addSelectColumn($alias . '.orgunitid');
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
            $criteria->removeSelectColumn(OutletStockTableMap::COL_OUTLET_STOCK_ID);
            $criteria->removeSelectColumn(OutletStockTableMap::COL_OUTLET_ID);
            $criteria->removeSelectColumn(OutletStockTableMap::COL_PRODUCT_ID);
            $criteria->removeSelectColumn(OutletStockTableMap::COL_FREE_QTY);
            $criteria->removeSelectColumn(OutletStockTableMap::COL_RESERVED_QTY);
            $criteria->removeSelectColumn(OutletStockTableMap::COL_BSD_QTY);
            $criteria->removeSelectColumn(OutletStockTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(OutletStockTableMap::COL_LAST_SYNC);
            $criteria->removeSelectColumn(OutletStockTableMap::COL_BRAND_ID);
            $criteria->removeSelectColumn(OutletStockTableMap::COL_OUTLET_ORG_ID);
            $criteria->removeSelectColumn(OutletStockTableMap::COL_CLOSING_QTY);
            $criteria->removeSelectColumn(OutletStockTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OutletStockTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(OutletStockTableMap::COL_COMPETITOR_ID);
            $criteria->removeSelectColumn(OutletStockTableMap::COL_ORGUNITID);
        } else {
            $criteria->removeSelectColumn($alias . '.outlet_stock_id');
            $criteria->removeSelectColumn($alias . '.outlet_id');
            $criteria->removeSelectColumn($alias . '.product_id');
            $criteria->removeSelectColumn($alias . '.free_qty');
            $criteria->removeSelectColumn($alias . '.reserved_qty');
            $criteria->removeSelectColumn($alias . '.bsd_qty');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.last_sync');
            $criteria->removeSelectColumn($alias . '.brand_id');
            $criteria->removeSelectColumn($alias . '.outlet_org_id');
            $criteria->removeSelectColumn($alias . '.closing_qty');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.competitor_id');
            $criteria->removeSelectColumn($alias . '.orgunitid');
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
        return Propel::getServiceContainer()->getDatabaseMap(OutletStockTableMap::DATABASE_NAME)->getTable(OutletStockTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OutletStock or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OutletStock object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletStockTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OutletStock) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OutletStockTableMap::DATABASE_NAME);
            $criteria->add(OutletStockTableMap::COL_OUTLET_STOCK_ID, (array) $values, Criteria::IN);
        }

        $query = OutletStockQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OutletStockTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OutletStockTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the outlet_stock table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OutletStockQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OutletStock or Criteria object.
     *
     * @param mixed $criteria Criteria or OutletStock object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletStockTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OutletStock object
        }

        if ($criteria->containsKey(OutletStockTableMap::COL_OUTLET_STOCK_ID) && $criteria->keyContainsValue(OutletStockTableMap::COL_OUTLET_STOCK_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OutletStockTableMap::COL_OUTLET_STOCK_ID.')');
        }


        // Set the correct dbName
        $query = OutletStockQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
