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
use entities\OutletStockOtherSummary;
use entities\OutletStockOtherSummaryQuery;


/**
 * This class defines the structure of the 'outlet_stock_other_summary' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OutletStockOtherSummaryTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OutletStockOtherSummaryTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'outlet_stock_other_summary';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OutletStockOtherSummary';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OutletStockOtherSummary';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OutletStockOtherSummary';

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
     * the column name for the outlet_stock_other_summary_id field
     */
    public const COL_OUTLET_STOCK_OTHER_SUMMARY_ID = 'outlet_stock_other_summary.outlet_stock_other_summary_id';

    /**
     * the column name for the outlet_org_id field
     */
    public const COL_OUTLET_ORG_ID = 'outlet_stock_other_summary.outlet_org_id';

    /**
     * the column name for the outlet_id field
     */
    public const COL_OUTLET_ID = 'outlet_stock_other_summary.outlet_id';

    /**
     * the column name for the moye field
     */
    public const COL_MOYE = 'outlet_stock_other_summary.moye';

    /**
     * the column name for the brand_id field
     */
    public const COL_BRAND_ID = 'outlet_stock_other_summary.brand_id';

    /**
     * the column name for the product_id field
     */
    public const COL_PRODUCT_ID = 'outlet_stock_other_summary.product_id';

    /**
     * the column name for the sale_qty field
     */
    public const COL_SALE_QTY = 'outlet_stock_other_summary.sale_qty';

    /**
     * the column name for the sale_value field
     */
    public const COL_SALE_VALUE = 'outlet_stock_other_summary.sale_value';

    /**
     * the column name for the return_qty field
     */
    public const COL_RETURN_QTY = 'outlet_stock_other_summary.return_qty';

    /**
     * the column name for the return_value field
     */
    public const COL_RETURN_VALUE = 'outlet_stock_other_summary.return_value';

    /**
     * the column name for the competitor_id field
     */
    public const COL_COMPETITOR_ID = 'outlet_stock_other_summary.competitor_id';

    /**
     * the column name for the orgunitid field
     */
    public const COL_ORGUNITID = 'outlet_stock_other_summary.orgunitid';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'outlet_stock_other_summary.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'outlet_stock_other_summary.updated_at';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'outlet_stock_other_summary.company_id';

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
        self::TYPE_PHPNAME       => ['OutletStockOtherSummaryId', 'OutletOrgId', 'OutletId', 'Moye', 'BrandId', 'ProductId', 'SaleQty', 'SaleValue', 'ReturnQty', 'ReturnValue', 'CompetitorId', 'Orgunitid', 'CreatedAt', 'UpdatedAt', 'CompanyId', ],
        self::TYPE_CAMELNAME     => ['outletStockOtherSummaryId', 'outletOrgId', 'outletId', 'moye', 'brandId', 'productId', 'saleQty', 'saleValue', 'returnQty', 'returnValue', 'competitorId', 'orgunitid', 'createdAt', 'updatedAt', 'companyId', ],
        self::TYPE_COLNAME       => [OutletStockOtherSummaryTableMap::COL_OUTLET_STOCK_OTHER_SUMMARY_ID, OutletStockOtherSummaryTableMap::COL_OUTLET_ORG_ID, OutletStockOtherSummaryTableMap::COL_OUTLET_ID, OutletStockOtherSummaryTableMap::COL_MOYE, OutletStockOtherSummaryTableMap::COL_BRAND_ID, OutletStockOtherSummaryTableMap::COL_PRODUCT_ID, OutletStockOtherSummaryTableMap::COL_SALE_QTY, OutletStockOtherSummaryTableMap::COL_SALE_VALUE, OutletStockOtherSummaryTableMap::COL_RETURN_QTY, OutletStockOtherSummaryTableMap::COL_RETURN_VALUE, OutletStockOtherSummaryTableMap::COL_COMPETITOR_ID, OutletStockOtherSummaryTableMap::COL_ORGUNITID, OutletStockOtherSummaryTableMap::COL_CREATED_AT, OutletStockOtherSummaryTableMap::COL_UPDATED_AT, OutletStockOtherSummaryTableMap::COL_COMPANY_ID, ],
        self::TYPE_FIELDNAME     => ['outlet_stock_other_summary_id', 'outlet_org_id', 'outlet_id', 'moye', 'brand_id', 'product_id', 'sale_qty', 'sale_value', 'return_qty', 'return_value', 'competitor_id', 'orgunitid', 'created_at', 'updated_at', 'company_id', ],
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
        self::TYPE_PHPNAME       => ['OutletStockOtherSummaryId' => 0, 'OutletOrgId' => 1, 'OutletId' => 2, 'Moye' => 3, 'BrandId' => 4, 'ProductId' => 5, 'SaleQty' => 6, 'SaleValue' => 7, 'ReturnQty' => 8, 'ReturnValue' => 9, 'CompetitorId' => 10, 'Orgunitid' => 11, 'CreatedAt' => 12, 'UpdatedAt' => 13, 'CompanyId' => 14, ],
        self::TYPE_CAMELNAME     => ['outletStockOtherSummaryId' => 0, 'outletOrgId' => 1, 'outletId' => 2, 'moye' => 3, 'brandId' => 4, 'productId' => 5, 'saleQty' => 6, 'saleValue' => 7, 'returnQty' => 8, 'returnValue' => 9, 'competitorId' => 10, 'orgunitid' => 11, 'createdAt' => 12, 'updatedAt' => 13, 'companyId' => 14, ],
        self::TYPE_COLNAME       => [OutletStockOtherSummaryTableMap::COL_OUTLET_STOCK_OTHER_SUMMARY_ID => 0, OutletStockOtherSummaryTableMap::COL_OUTLET_ORG_ID => 1, OutletStockOtherSummaryTableMap::COL_OUTLET_ID => 2, OutletStockOtherSummaryTableMap::COL_MOYE => 3, OutletStockOtherSummaryTableMap::COL_BRAND_ID => 4, OutletStockOtherSummaryTableMap::COL_PRODUCT_ID => 5, OutletStockOtherSummaryTableMap::COL_SALE_QTY => 6, OutletStockOtherSummaryTableMap::COL_SALE_VALUE => 7, OutletStockOtherSummaryTableMap::COL_RETURN_QTY => 8, OutletStockOtherSummaryTableMap::COL_RETURN_VALUE => 9, OutletStockOtherSummaryTableMap::COL_COMPETITOR_ID => 10, OutletStockOtherSummaryTableMap::COL_ORGUNITID => 11, OutletStockOtherSummaryTableMap::COL_CREATED_AT => 12, OutletStockOtherSummaryTableMap::COL_UPDATED_AT => 13, OutletStockOtherSummaryTableMap::COL_COMPANY_ID => 14, ],
        self::TYPE_FIELDNAME     => ['outlet_stock_other_summary_id' => 0, 'outlet_org_id' => 1, 'outlet_id' => 2, 'moye' => 3, 'brand_id' => 4, 'product_id' => 5, 'sale_qty' => 6, 'sale_value' => 7, 'return_qty' => 8, 'return_value' => 9, 'competitor_id' => 10, 'orgunitid' => 11, 'created_at' => 12, 'updated_at' => 13, 'company_id' => 14, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OutletStockOtherSummaryId' => 'OUTLET_STOCK_OTHER_SUMMARY_ID',
        'OutletStockOtherSummary.OutletStockOtherSummaryId' => 'OUTLET_STOCK_OTHER_SUMMARY_ID',
        'outletStockOtherSummaryId' => 'OUTLET_STOCK_OTHER_SUMMARY_ID',
        'outletStockOtherSummary.outletStockOtherSummaryId' => 'OUTLET_STOCK_OTHER_SUMMARY_ID',
        'OutletStockOtherSummaryTableMap::COL_OUTLET_STOCK_OTHER_SUMMARY_ID' => 'OUTLET_STOCK_OTHER_SUMMARY_ID',
        'COL_OUTLET_STOCK_OTHER_SUMMARY_ID' => 'OUTLET_STOCK_OTHER_SUMMARY_ID',
        'outlet_stock_other_summary_id' => 'OUTLET_STOCK_OTHER_SUMMARY_ID',
        'outlet_stock_other_summary.outlet_stock_other_summary_id' => 'OUTLET_STOCK_OTHER_SUMMARY_ID',
        'OutletOrgId' => 'OUTLET_ORG_ID',
        'OutletStockOtherSummary.OutletOrgId' => 'OUTLET_ORG_ID',
        'outletOrgId' => 'OUTLET_ORG_ID',
        'outletStockOtherSummary.outletOrgId' => 'OUTLET_ORG_ID',
        'OutletStockOtherSummaryTableMap::COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'outlet_org_id' => 'OUTLET_ORG_ID',
        'outlet_stock_other_summary.outlet_org_id' => 'OUTLET_ORG_ID',
        'OutletId' => 'OUTLET_ID',
        'OutletStockOtherSummary.OutletId' => 'OUTLET_ID',
        'outletId' => 'OUTLET_ID',
        'outletStockOtherSummary.outletId' => 'OUTLET_ID',
        'OutletStockOtherSummaryTableMap::COL_OUTLET_ID' => 'OUTLET_ID',
        'COL_OUTLET_ID' => 'OUTLET_ID',
        'outlet_id' => 'OUTLET_ID',
        'outlet_stock_other_summary.outlet_id' => 'OUTLET_ID',
        'Moye' => 'MOYE',
        'OutletStockOtherSummary.Moye' => 'MOYE',
        'moye' => 'MOYE',
        'outletStockOtherSummary.moye' => 'MOYE',
        'OutletStockOtherSummaryTableMap::COL_MOYE' => 'MOYE',
        'COL_MOYE' => 'MOYE',
        'outlet_stock_other_summary.moye' => 'MOYE',
        'BrandId' => 'BRAND_ID',
        'OutletStockOtherSummary.BrandId' => 'BRAND_ID',
        'brandId' => 'BRAND_ID',
        'outletStockOtherSummary.brandId' => 'BRAND_ID',
        'OutletStockOtherSummaryTableMap::COL_BRAND_ID' => 'BRAND_ID',
        'COL_BRAND_ID' => 'BRAND_ID',
        'brand_id' => 'BRAND_ID',
        'outlet_stock_other_summary.brand_id' => 'BRAND_ID',
        'ProductId' => 'PRODUCT_ID',
        'OutletStockOtherSummary.ProductId' => 'PRODUCT_ID',
        'productId' => 'PRODUCT_ID',
        'outletStockOtherSummary.productId' => 'PRODUCT_ID',
        'OutletStockOtherSummaryTableMap::COL_PRODUCT_ID' => 'PRODUCT_ID',
        'COL_PRODUCT_ID' => 'PRODUCT_ID',
        'product_id' => 'PRODUCT_ID',
        'outlet_stock_other_summary.product_id' => 'PRODUCT_ID',
        'SaleQty' => 'SALE_QTY',
        'OutletStockOtherSummary.SaleQty' => 'SALE_QTY',
        'saleQty' => 'SALE_QTY',
        'outletStockOtherSummary.saleQty' => 'SALE_QTY',
        'OutletStockOtherSummaryTableMap::COL_SALE_QTY' => 'SALE_QTY',
        'COL_SALE_QTY' => 'SALE_QTY',
        'sale_qty' => 'SALE_QTY',
        'outlet_stock_other_summary.sale_qty' => 'SALE_QTY',
        'SaleValue' => 'SALE_VALUE',
        'OutletStockOtherSummary.SaleValue' => 'SALE_VALUE',
        'saleValue' => 'SALE_VALUE',
        'outletStockOtherSummary.saleValue' => 'SALE_VALUE',
        'OutletStockOtherSummaryTableMap::COL_SALE_VALUE' => 'SALE_VALUE',
        'COL_SALE_VALUE' => 'SALE_VALUE',
        'sale_value' => 'SALE_VALUE',
        'outlet_stock_other_summary.sale_value' => 'SALE_VALUE',
        'ReturnQty' => 'RETURN_QTY',
        'OutletStockOtherSummary.ReturnQty' => 'RETURN_QTY',
        'returnQty' => 'RETURN_QTY',
        'outletStockOtherSummary.returnQty' => 'RETURN_QTY',
        'OutletStockOtherSummaryTableMap::COL_RETURN_QTY' => 'RETURN_QTY',
        'COL_RETURN_QTY' => 'RETURN_QTY',
        'return_qty' => 'RETURN_QTY',
        'outlet_stock_other_summary.return_qty' => 'RETURN_QTY',
        'ReturnValue' => 'RETURN_VALUE',
        'OutletStockOtherSummary.ReturnValue' => 'RETURN_VALUE',
        'returnValue' => 'RETURN_VALUE',
        'outletStockOtherSummary.returnValue' => 'RETURN_VALUE',
        'OutletStockOtherSummaryTableMap::COL_RETURN_VALUE' => 'RETURN_VALUE',
        'COL_RETURN_VALUE' => 'RETURN_VALUE',
        'return_value' => 'RETURN_VALUE',
        'outlet_stock_other_summary.return_value' => 'RETURN_VALUE',
        'CompetitorId' => 'COMPETITOR_ID',
        'OutletStockOtherSummary.CompetitorId' => 'COMPETITOR_ID',
        'competitorId' => 'COMPETITOR_ID',
        'outletStockOtherSummary.competitorId' => 'COMPETITOR_ID',
        'OutletStockOtherSummaryTableMap::COL_COMPETITOR_ID' => 'COMPETITOR_ID',
        'COL_COMPETITOR_ID' => 'COMPETITOR_ID',
        'competitor_id' => 'COMPETITOR_ID',
        'outlet_stock_other_summary.competitor_id' => 'COMPETITOR_ID',
        'Orgunitid' => 'ORGUNITID',
        'OutletStockOtherSummary.Orgunitid' => 'ORGUNITID',
        'orgunitid' => 'ORGUNITID',
        'outletStockOtherSummary.orgunitid' => 'ORGUNITID',
        'OutletStockOtherSummaryTableMap::COL_ORGUNITID' => 'ORGUNITID',
        'COL_ORGUNITID' => 'ORGUNITID',
        'outlet_stock_other_summary.orgunitid' => 'ORGUNITID',
        'CreatedAt' => 'CREATED_AT',
        'OutletStockOtherSummary.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'outletStockOtherSummary.createdAt' => 'CREATED_AT',
        'OutletStockOtherSummaryTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'outlet_stock_other_summary.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'OutletStockOtherSummary.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'outletStockOtherSummary.updatedAt' => 'UPDATED_AT',
        'OutletStockOtherSummaryTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'outlet_stock_other_summary.updated_at' => 'UPDATED_AT',
        'CompanyId' => 'COMPANY_ID',
        'OutletStockOtherSummary.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'outletStockOtherSummary.companyId' => 'COMPANY_ID',
        'OutletStockOtherSummaryTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'outlet_stock_other_summary.company_id' => 'COMPANY_ID',
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
        $this->setName('outlet_stock_other_summary');
        $this->setPhpName('OutletStockOtherSummary');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OutletStockOtherSummary');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('outlet_stock_other_summary_outlet_stock_other_summary_id_seq');
        // columns
        $this->addPrimaryKey('outlet_stock_other_summary_id', 'OutletStockOtherSummaryId', 'INTEGER', true, null, null);
        $this->addForeignKey('outlet_org_id', 'OutletOrgId', 'INTEGER', 'outlet_org_data', 'outlet_org_id', true, null, null);
        $this->addForeignKey('outlet_id', 'OutletId', 'INTEGER', 'outlets', 'id', true, null, null);
        $this->addColumn('moye', 'Moye', 'VARCHAR', true, null, null);
        $this->addForeignKey('brand_id', 'BrandId', 'INTEGER', 'brands', 'brand_id', true, null, null);
        $this->addForeignKey('product_id', 'ProductId', 'INTEGER', 'products', 'id', true, null, null);
        $this->addColumn('sale_qty', 'SaleQty', 'INTEGER', true, null, null);
        $this->addColumn('sale_value', 'SaleValue', 'DECIMAL', true, null, null);
        $this->addColumn('return_qty', 'ReturnQty', 'INTEGER', true, null, null);
        $this->addColumn('return_value', 'ReturnValue', 'DECIMAL', true, null, null);
        $this->addColumn('competitor_id', 'CompetitorId', 'INTEGER', false, null, null);
        $this->addForeignKey('orgunitid', 'Orgunitid', 'INTEGER', 'org_unit', 'orgunitid', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Brands', '\\entities\\Brands', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':brand_id',
    1 => ':brand_id',
  ),
), null, null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, null, false);
        $this->addRelation('OrgUnit', '\\entities\\OrgUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':orgunitid',
    1 => ':orgunitid',
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
    0 => ':outlet_org_id',
    1 => ':outlet_org_id',
  ),
), null, null, null, false);
        $this->addRelation('Products', '\\entities\\Products', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':product_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletStockOtherSummaryId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletStockOtherSummaryId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletStockOtherSummaryId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletStockOtherSummaryId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletStockOtherSummaryId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletStockOtherSummaryId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('OutletStockOtherSummaryId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OutletStockOtherSummaryTableMap::CLASS_DEFAULT : OutletStockOtherSummaryTableMap::OM_CLASS;
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
     * @return array (OutletStockOtherSummary object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OutletStockOtherSummaryTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OutletStockOtherSummaryTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OutletStockOtherSummaryTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OutletStockOtherSummaryTableMap::OM_CLASS;
            /** @var OutletStockOtherSummary $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OutletStockOtherSummaryTableMap::addInstanceToPool($obj, $key);
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
            $key = OutletStockOtherSummaryTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OutletStockOtherSummaryTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OutletStockOtherSummary $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OutletStockOtherSummaryTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OutletStockOtherSummaryTableMap::COL_OUTLET_STOCK_OTHER_SUMMARY_ID);
            $criteria->addSelectColumn(OutletStockOtherSummaryTableMap::COL_OUTLET_ORG_ID);
            $criteria->addSelectColumn(OutletStockOtherSummaryTableMap::COL_OUTLET_ID);
            $criteria->addSelectColumn(OutletStockOtherSummaryTableMap::COL_MOYE);
            $criteria->addSelectColumn(OutletStockOtherSummaryTableMap::COL_BRAND_ID);
            $criteria->addSelectColumn(OutletStockOtherSummaryTableMap::COL_PRODUCT_ID);
            $criteria->addSelectColumn(OutletStockOtherSummaryTableMap::COL_SALE_QTY);
            $criteria->addSelectColumn(OutletStockOtherSummaryTableMap::COL_SALE_VALUE);
            $criteria->addSelectColumn(OutletStockOtherSummaryTableMap::COL_RETURN_QTY);
            $criteria->addSelectColumn(OutletStockOtherSummaryTableMap::COL_RETURN_VALUE);
            $criteria->addSelectColumn(OutletStockOtherSummaryTableMap::COL_COMPETITOR_ID);
            $criteria->addSelectColumn(OutletStockOtherSummaryTableMap::COL_ORGUNITID);
            $criteria->addSelectColumn(OutletStockOtherSummaryTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OutletStockOtherSummaryTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(OutletStockOtherSummaryTableMap::COL_COMPANY_ID);
        } else {
            $criteria->addSelectColumn($alias . '.outlet_stock_other_summary_id');
            $criteria->addSelectColumn($alias . '.outlet_org_id');
            $criteria->addSelectColumn($alias . '.outlet_id');
            $criteria->addSelectColumn($alias . '.moye');
            $criteria->addSelectColumn($alias . '.brand_id');
            $criteria->addSelectColumn($alias . '.product_id');
            $criteria->addSelectColumn($alias . '.sale_qty');
            $criteria->addSelectColumn($alias . '.sale_value');
            $criteria->addSelectColumn($alias . '.return_qty');
            $criteria->addSelectColumn($alias . '.return_value');
            $criteria->addSelectColumn($alias . '.competitor_id');
            $criteria->addSelectColumn($alias . '.orgunitid');
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
            $criteria->removeSelectColumn(OutletStockOtherSummaryTableMap::COL_OUTLET_STOCK_OTHER_SUMMARY_ID);
            $criteria->removeSelectColumn(OutletStockOtherSummaryTableMap::COL_OUTLET_ORG_ID);
            $criteria->removeSelectColumn(OutletStockOtherSummaryTableMap::COL_OUTLET_ID);
            $criteria->removeSelectColumn(OutletStockOtherSummaryTableMap::COL_MOYE);
            $criteria->removeSelectColumn(OutletStockOtherSummaryTableMap::COL_BRAND_ID);
            $criteria->removeSelectColumn(OutletStockOtherSummaryTableMap::COL_PRODUCT_ID);
            $criteria->removeSelectColumn(OutletStockOtherSummaryTableMap::COL_SALE_QTY);
            $criteria->removeSelectColumn(OutletStockOtherSummaryTableMap::COL_SALE_VALUE);
            $criteria->removeSelectColumn(OutletStockOtherSummaryTableMap::COL_RETURN_QTY);
            $criteria->removeSelectColumn(OutletStockOtherSummaryTableMap::COL_RETURN_VALUE);
            $criteria->removeSelectColumn(OutletStockOtherSummaryTableMap::COL_COMPETITOR_ID);
            $criteria->removeSelectColumn(OutletStockOtherSummaryTableMap::COL_ORGUNITID);
            $criteria->removeSelectColumn(OutletStockOtherSummaryTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OutletStockOtherSummaryTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(OutletStockOtherSummaryTableMap::COL_COMPANY_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.outlet_stock_other_summary_id');
            $criteria->removeSelectColumn($alias . '.outlet_org_id');
            $criteria->removeSelectColumn($alias . '.outlet_id');
            $criteria->removeSelectColumn($alias . '.moye');
            $criteria->removeSelectColumn($alias . '.brand_id');
            $criteria->removeSelectColumn($alias . '.product_id');
            $criteria->removeSelectColumn($alias . '.sale_qty');
            $criteria->removeSelectColumn($alias . '.sale_value');
            $criteria->removeSelectColumn($alias . '.return_qty');
            $criteria->removeSelectColumn($alias . '.return_value');
            $criteria->removeSelectColumn($alias . '.competitor_id');
            $criteria->removeSelectColumn($alias . '.orgunitid');
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
        return Propel::getServiceContainer()->getDatabaseMap(OutletStockOtherSummaryTableMap::DATABASE_NAME)->getTable(OutletStockOtherSummaryTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OutletStockOtherSummary or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OutletStockOtherSummary object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletStockOtherSummaryTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OutletStockOtherSummary) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OutletStockOtherSummaryTableMap::DATABASE_NAME);
            $criteria->add(OutletStockOtherSummaryTableMap::COL_OUTLET_STOCK_OTHER_SUMMARY_ID, (array) $values, Criteria::IN);
        }

        $query = OutletStockOtherSummaryQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OutletStockOtherSummaryTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OutletStockOtherSummaryTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the outlet_stock_other_summary table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OutletStockOtherSummaryQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OutletStockOtherSummary or Criteria object.
     *
     * @param mixed $criteria Criteria or OutletStockOtherSummary object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletStockOtherSummaryTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OutletStockOtherSummary object
        }

        if ($criteria->containsKey(OutletStockOtherSummaryTableMap::COL_OUTLET_STOCK_OTHER_SUMMARY_ID) && $criteria->keyContainsValue(OutletStockOtherSummaryTableMap::COL_OUTLET_STOCK_OTHER_SUMMARY_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OutletStockOtherSummaryTableMap::COL_OUTLET_STOCK_OTHER_SUMMARY_ID.')');
        }


        // Set the correct dbName
        $query = OutletStockOtherSummaryQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
