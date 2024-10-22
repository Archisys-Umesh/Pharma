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
use entities\OutletStockSummary;
use entities\OutletStockSummaryQuery;


/**
 * This class defines the structure of the 'outlet_stock_summary' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OutletStockSummaryTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OutletStockSummaryTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'outlet_stock_summary';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OutletStockSummary';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OutletStockSummary';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OutletStockSummary';

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
     * the column name for the outlet_stock_summary_id field
     */
    public const COL_OUTLET_STOCK_SUMMARY_ID = 'outlet_stock_summary.outlet_stock_summary_id';

    /**
     * the column name for the outlet_org_id field
     */
    public const COL_OUTLET_ORG_ID = 'outlet_stock_summary.outlet_org_id';

    /**
     * the column name for the outlet_id field
     */
    public const COL_OUTLET_ID = 'outlet_stock_summary.outlet_id';

    /**
     * the column name for the moye field
     */
    public const COL_MOYE = 'outlet_stock_summary.moye';

    /**
     * the column name for the brand_id field
     */
    public const COL_BRAND_ID = 'outlet_stock_summary.brand_id';

    /**
     * the column name for the product_id field
     */
    public const COL_PRODUCT_ID = 'outlet_stock_summary.product_id';

    /**
     * the column name for the closing_qty field
     */
    public const COL_CLOSING_QTY = 'outlet_stock_summary.closing_qty';

    /**
     * the column name for the computed_closing_qty field
     */
    public const COL_COMPUTED_CLOSING_QTY = 'outlet_stock_summary.computed_closing_qty';

    /**
     * the column name for the competitor_id field
     */
    public const COL_COMPETITOR_ID = 'outlet_stock_summary.competitor_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'outlet_stock_summary.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'outlet_stock_summary.updated_at';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'outlet_stock_summary.company_id';

    /**
     * the column name for the orgunitid field
     */
    public const COL_ORGUNITID = 'outlet_stock_summary.orgunitid';

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
        self::TYPE_PHPNAME       => ['OutletStockSummaryId', 'OutletOrgId', 'OutletId', 'Moye', 'BrandId', 'ProductId', 'ClosingQty', 'ComputedClosingQty', 'CompetitorId', 'CreatedAt', 'UpdatedAt', 'CompanyId', 'Orgunitid', ],
        self::TYPE_CAMELNAME     => ['outletStockSummaryId', 'outletOrgId', 'outletId', 'moye', 'brandId', 'productId', 'closingQty', 'computedClosingQty', 'competitorId', 'createdAt', 'updatedAt', 'companyId', 'orgunitid', ],
        self::TYPE_COLNAME       => [OutletStockSummaryTableMap::COL_OUTLET_STOCK_SUMMARY_ID, OutletStockSummaryTableMap::COL_OUTLET_ORG_ID, OutletStockSummaryTableMap::COL_OUTLET_ID, OutletStockSummaryTableMap::COL_MOYE, OutletStockSummaryTableMap::COL_BRAND_ID, OutletStockSummaryTableMap::COL_PRODUCT_ID, OutletStockSummaryTableMap::COL_CLOSING_QTY, OutletStockSummaryTableMap::COL_COMPUTED_CLOSING_QTY, OutletStockSummaryTableMap::COL_COMPETITOR_ID, OutletStockSummaryTableMap::COL_CREATED_AT, OutletStockSummaryTableMap::COL_UPDATED_AT, OutletStockSummaryTableMap::COL_COMPANY_ID, OutletStockSummaryTableMap::COL_ORGUNITID, ],
        self::TYPE_FIELDNAME     => ['outlet_stock_summary_id', 'outlet_org_id', 'outlet_id', 'moye', 'brand_id', 'product_id', 'closing_qty', 'computed_closing_qty', 'competitor_id', 'created_at', 'updated_at', 'company_id', 'orgunitid', ],
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
        self::TYPE_PHPNAME       => ['OutletStockSummaryId' => 0, 'OutletOrgId' => 1, 'OutletId' => 2, 'Moye' => 3, 'BrandId' => 4, 'ProductId' => 5, 'ClosingQty' => 6, 'ComputedClosingQty' => 7, 'CompetitorId' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, 'CompanyId' => 11, 'Orgunitid' => 12, ],
        self::TYPE_CAMELNAME     => ['outletStockSummaryId' => 0, 'outletOrgId' => 1, 'outletId' => 2, 'moye' => 3, 'brandId' => 4, 'productId' => 5, 'closingQty' => 6, 'computedClosingQty' => 7, 'competitorId' => 8, 'createdAt' => 9, 'updatedAt' => 10, 'companyId' => 11, 'orgunitid' => 12, ],
        self::TYPE_COLNAME       => [OutletStockSummaryTableMap::COL_OUTLET_STOCK_SUMMARY_ID => 0, OutletStockSummaryTableMap::COL_OUTLET_ORG_ID => 1, OutletStockSummaryTableMap::COL_OUTLET_ID => 2, OutletStockSummaryTableMap::COL_MOYE => 3, OutletStockSummaryTableMap::COL_BRAND_ID => 4, OutletStockSummaryTableMap::COL_PRODUCT_ID => 5, OutletStockSummaryTableMap::COL_CLOSING_QTY => 6, OutletStockSummaryTableMap::COL_COMPUTED_CLOSING_QTY => 7, OutletStockSummaryTableMap::COL_COMPETITOR_ID => 8, OutletStockSummaryTableMap::COL_CREATED_AT => 9, OutletStockSummaryTableMap::COL_UPDATED_AT => 10, OutletStockSummaryTableMap::COL_COMPANY_ID => 11, OutletStockSummaryTableMap::COL_ORGUNITID => 12, ],
        self::TYPE_FIELDNAME     => ['outlet_stock_summary_id' => 0, 'outlet_org_id' => 1, 'outlet_id' => 2, 'moye' => 3, 'brand_id' => 4, 'product_id' => 5, 'closing_qty' => 6, 'computed_closing_qty' => 7, 'competitor_id' => 8, 'created_at' => 9, 'updated_at' => 10, 'company_id' => 11, 'orgunitid' => 12, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OutletStockSummaryId' => 'OUTLET_STOCK_SUMMARY_ID',
        'OutletStockSummary.OutletStockSummaryId' => 'OUTLET_STOCK_SUMMARY_ID',
        'outletStockSummaryId' => 'OUTLET_STOCK_SUMMARY_ID',
        'outletStockSummary.outletStockSummaryId' => 'OUTLET_STOCK_SUMMARY_ID',
        'OutletStockSummaryTableMap::COL_OUTLET_STOCK_SUMMARY_ID' => 'OUTLET_STOCK_SUMMARY_ID',
        'COL_OUTLET_STOCK_SUMMARY_ID' => 'OUTLET_STOCK_SUMMARY_ID',
        'outlet_stock_summary_id' => 'OUTLET_STOCK_SUMMARY_ID',
        'outlet_stock_summary.outlet_stock_summary_id' => 'OUTLET_STOCK_SUMMARY_ID',
        'OutletOrgId' => 'OUTLET_ORG_ID',
        'OutletStockSummary.OutletOrgId' => 'OUTLET_ORG_ID',
        'outletOrgId' => 'OUTLET_ORG_ID',
        'outletStockSummary.outletOrgId' => 'OUTLET_ORG_ID',
        'OutletStockSummaryTableMap::COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'outlet_org_id' => 'OUTLET_ORG_ID',
        'outlet_stock_summary.outlet_org_id' => 'OUTLET_ORG_ID',
        'OutletId' => 'OUTLET_ID',
        'OutletStockSummary.OutletId' => 'OUTLET_ID',
        'outletId' => 'OUTLET_ID',
        'outletStockSummary.outletId' => 'OUTLET_ID',
        'OutletStockSummaryTableMap::COL_OUTLET_ID' => 'OUTLET_ID',
        'COL_OUTLET_ID' => 'OUTLET_ID',
        'outlet_id' => 'OUTLET_ID',
        'outlet_stock_summary.outlet_id' => 'OUTLET_ID',
        'Moye' => 'MOYE',
        'OutletStockSummary.Moye' => 'MOYE',
        'moye' => 'MOYE',
        'outletStockSummary.moye' => 'MOYE',
        'OutletStockSummaryTableMap::COL_MOYE' => 'MOYE',
        'COL_MOYE' => 'MOYE',
        'outlet_stock_summary.moye' => 'MOYE',
        'BrandId' => 'BRAND_ID',
        'OutletStockSummary.BrandId' => 'BRAND_ID',
        'brandId' => 'BRAND_ID',
        'outletStockSummary.brandId' => 'BRAND_ID',
        'OutletStockSummaryTableMap::COL_BRAND_ID' => 'BRAND_ID',
        'COL_BRAND_ID' => 'BRAND_ID',
        'brand_id' => 'BRAND_ID',
        'outlet_stock_summary.brand_id' => 'BRAND_ID',
        'ProductId' => 'PRODUCT_ID',
        'OutletStockSummary.ProductId' => 'PRODUCT_ID',
        'productId' => 'PRODUCT_ID',
        'outletStockSummary.productId' => 'PRODUCT_ID',
        'OutletStockSummaryTableMap::COL_PRODUCT_ID' => 'PRODUCT_ID',
        'COL_PRODUCT_ID' => 'PRODUCT_ID',
        'product_id' => 'PRODUCT_ID',
        'outlet_stock_summary.product_id' => 'PRODUCT_ID',
        'ClosingQty' => 'CLOSING_QTY',
        'OutletStockSummary.ClosingQty' => 'CLOSING_QTY',
        'closingQty' => 'CLOSING_QTY',
        'outletStockSummary.closingQty' => 'CLOSING_QTY',
        'OutletStockSummaryTableMap::COL_CLOSING_QTY' => 'CLOSING_QTY',
        'COL_CLOSING_QTY' => 'CLOSING_QTY',
        'closing_qty' => 'CLOSING_QTY',
        'outlet_stock_summary.closing_qty' => 'CLOSING_QTY',
        'ComputedClosingQty' => 'COMPUTED_CLOSING_QTY',
        'OutletStockSummary.ComputedClosingQty' => 'COMPUTED_CLOSING_QTY',
        'computedClosingQty' => 'COMPUTED_CLOSING_QTY',
        'outletStockSummary.computedClosingQty' => 'COMPUTED_CLOSING_QTY',
        'OutletStockSummaryTableMap::COL_COMPUTED_CLOSING_QTY' => 'COMPUTED_CLOSING_QTY',
        'COL_COMPUTED_CLOSING_QTY' => 'COMPUTED_CLOSING_QTY',
        'computed_closing_qty' => 'COMPUTED_CLOSING_QTY',
        'outlet_stock_summary.computed_closing_qty' => 'COMPUTED_CLOSING_QTY',
        'CompetitorId' => 'COMPETITOR_ID',
        'OutletStockSummary.CompetitorId' => 'COMPETITOR_ID',
        'competitorId' => 'COMPETITOR_ID',
        'outletStockSummary.competitorId' => 'COMPETITOR_ID',
        'OutletStockSummaryTableMap::COL_COMPETITOR_ID' => 'COMPETITOR_ID',
        'COL_COMPETITOR_ID' => 'COMPETITOR_ID',
        'competitor_id' => 'COMPETITOR_ID',
        'outlet_stock_summary.competitor_id' => 'COMPETITOR_ID',
        'CreatedAt' => 'CREATED_AT',
        'OutletStockSummary.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'outletStockSummary.createdAt' => 'CREATED_AT',
        'OutletStockSummaryTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'outlet_stock_summary.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'OutletStockSummary.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'outletStockSummary.updatedAt' => 'UPDATED_AT',
        'OutletStockSummaryTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'outlet_stock_summary.updated_at' => 'UPDATED_AT',
        'CompanyId' => 'COMPANY_ID',
        'OutletStockSummary.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'outletStockSummary.companyId' => 'COMPANY_ID',
        'OutletStockSummaryTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'outlet_stock_summary.company_id' => 'COMPANY_ID',
        'Orgunitid' => 'ORGUNITID',
        'OutletStockSummary.Orgunitid' => 'ORGUNITID',
        'orgunitid' => 'ORGUNITID',
        'outletStockSummary.orgunitid' => 'ORGUNITID',
        'OutletStockSummaryTableMap::COL_ORGUNITID' => 'ORGUNITID',
        'COL_ORGUNITID' => 'ORGUNITID',
        'outlet_stock_summary.orgunitid' => 'ORGUNITID',
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
        $this->setName('outlet_stock_summary');
        $this->setPhpName('OutletStockSummary');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OutletStockSummary');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('outlet_stock_summary_outlet_stock_summary_id_seq');
        // columns
        $this->addPrimaryKey('outlet_stock_summary_id', 'OutletStockSummaryId', 'INTEGER', true, null, null);
        $this->addForeignKey('outlet_org_id', 'OutletOrgId', 'INTEGER', 'outlet_org_data', 'outlet_org_id', true, null, null);
        $this->addForeignKey('outlet_id', 'OutletId', 'INTEGER', 'outlets', 'id', true, null, null);
        $this->addColumn('moye', 'Moye', 'VARCHAR', true, null, null);
        $this->addForeignKey('brand_id', 'BrandId', 'INTEGER', 'brands', 'brand_id', true, null, null);
        $this->addForeignKey('product_id', 'ProductId', 'INTEGER', 'products', 'id', true, null, null);
        $this->addColumn('closing_qty', 'ClosingQty', 'INTEGER', true, null, null);
        $this->addColumn('computed_closing_qty', 'ComputedClosingQty', 'INTEGER', true, null, null);
        $this->addColumn('competitor_id', 'CompetitorId', 'INTEGER', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addForeignKey('orgunitid', 'Orgunitid', 'INTEGER', 'org_unit', 'orgunitid', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletStockSummaryId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletStockSummaryId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletStockSummaryId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletStockSummaryId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletStockSummaryId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OutletStockSummaryId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('OutletStockSummaryId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OutletStockSummaryTableMap::CLASS_DEFAULT : OutletStockSummaryTableMap::OM_CLASS;
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
     * @return array (OutletStockSummary object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OutletStockSummaryTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OutletStockSummaryTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OutletStockSummaryTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OutletStockSummaryTableMap::OM_CLASS;
            /** @var OutletStockSummary $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OutletStockSummaryTableMap::addInstanceToPool($obj, $key);
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
            $key = OutletStockSummaryTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OutletStockSummaryTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OutletStockSummary $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OutletStockSummaryTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OutletStockSummaryTableMap::COL_OUTLET_STOCK_SUMMARY_ID);
            $criteria->addSelectColumn(OutletStockSummaryTableMap::COL_OUTLET_ORG_ID);
            $criteria->addSelectColumn(OutletStockSummaryTableMap::COL_OUTLET_ID);
            $criteria->addSelectColumn(OutletStockSummaryTableMap::COL_MOYE);
            $criteria->addSelectColumn(OutletStockSummaryTableMap::COL_BRAND_ID);
            $criteria->addSelectColumn(OutletStockSummaryTableMap::COL_PRODUCT_ID);
            $criteria->addSelectColumn(OutletStockSummaryTableMap::COL_CLOSING_QTY);
            $criteria->addSelectColumn(OutletStockSummaryTableMap::COL_COMPUTED_CLOSING_QTY);
            $criteria->addSelectColumn(OutletStockSummaryTableMap::COL_COMPETITOR_ID);
            $criteria->addSelectColumn(OutletStockSummaryTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OutletStockSummaryTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(OutletStockSummaryTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(OutletStockSummaryTableMap::COL_ORGUNITID);
        } else {
            $criteria->addSelectColumn($alias . '.outlet_stock_summary_id');
            $criteria->addSelectColumn($alias . '.outlet_org_id');
            $criteria->addSelectColumn($alias . '.outlet_id');
            $criteria->addSelectColumn($alias . '.moye');
            $criteria->addSelectColumn($alias . '.brand_id');
            $criteria->addSelectColumn($alias . '.product_id');
            $criteria->addSelectColumn($alias . '.closing_qty');
            $criteria->addSelectColumn($alias . '.computed_closing_qty');
            $criteria->addSelectColumn($alias . '.competitor_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.company_id');
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
            $criteria->removeSelectColumn(OutletStockSummaryTableMap::COL_OUTLET_STOCK_SUMMARY_ID);
            $criteria->removeSelectColumn(OutletStockSummaryTableMap::COL_OUTLET_ORG_ID);
            $criteria->removeSelectColumn(OutletStockSummaryTableMap::COL_OUTLET_ID);
            $criteria->removeSelectColumn(OutletStockSummaryTableMap::COL_MOYE);
            $criteria->removeSelectColumn(OutletStockSummaryTableMap::COL_BRAND_ID);
            $criteria->removeSelectColumn(OutletStockSummaryTableMap::COL_PRODUCT_ID);
            $criteria->removeSelectColumn(OutletStockSummaryTableMap::COL_CLOSING_QTY);
            $criteria->removeSelectColumn(OutletStockSummaryTableMap::COL_COMPUTED_CLOSING_QTY);
            $criteria->removeSelectColumn(OutletStockSummaryTableMap::COL_COMPETITOR_ID);
            $criteria->removeSelectColumn(OutletStockSummaryTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OutletStockSummaryTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(OutletStockSummaryTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(OutletStockSummaryTableMap::COL_ORGUNITID);
        } else {
            $criteria->removeSelectColumn($alias . '.outlet_stock_summary_id');
            $criteria->removeSelectColumn($alias . '.outlet_org_id');
            $criteria->removeSelectColumn($alias . '.outlet_id');
            $criteria->removeSelectColumn($alias . '.moye');
            $criteria->removeSelectColumn($alias . '.brand_id');
            $criteria->removeSelectColumn($alias . '.product_id');
            $criteria->removeSelectColumn($alias . '.closing_qty');
            $criteria->removeSelectColumn($alias . '.computed_closing_qty');
            $criteria->removeSelectColumn($alias . '.competitor_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.company_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(OutletStockSummaryTableMap::DATABASE_NAME)->getTable(OutletStockSummaryTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OutletStockSummary or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OutletStockSummary object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OutletStockSummaryTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OutletStockSummary) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OutletStockSummaryTableMap::DATABASE_NAME);
            $criteria->add(OutletStockSummaryTableMap::COL_OUTLET_STOCK_SUMMARY_ID, (array) $values, Criteria::IN);
        }

        $query = OutletStockSummaryQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OutletStockSummaryTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OutletStockSummaryTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the outlet_stock_summary table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OutletStockSummaryQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OutletStockSummary or Criteria object.
     *
     * @param mixed $criteria Criteria or OutletStockSummary object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OutletStockSummaryTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OutletStockSummary object
        }

        if ($criteria->containsKey(OutletStockSummaryTableMap::COL_OUTLET_STOCK_SUMMARY_ID) && $criteria->keyContainsValue(OutletStockSummaryTableMap::COL_OUTLET_STOCK_SUMMARY_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OutletStockSummaryTableMap::COL_OUTLET_STOCK_SUMMARY_ID.')');
        }


        // Set the correct dbName
        $query = OutletStockSummaryQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
