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
use entities\Products;
use entities\ProductsQuery;


/**
 * This class defines the structure of the 'products' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ProductsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.ProductsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'products';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Products';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Products';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Products';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 21;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 21;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'products.id';

    /**
     * the column name for the product_name field
     */
    public const COL_PRODUCT_NAME = 'products.product_name';

    /**
     * the column name for the product_summary field
     */
    public const COL_PRODUCT_SUMMARY = 'products.product_summary';

    /**
     * the column name for the product_description field
     */
    public const COL_PRODUCT_DESCRIPTION = 'products.product_description';

    /**
     * the column name for the product_sku field
     */
    public const COL_PRODUCT_SKU = 'products.product_sku';

    /**
     * the column name for the additional_data field
     */
    public const COL_ADDITIONAL_DATA = 'products.additional_data';

    /**
     * the column name for the unit_d field
     */
    public const COL_UNIT_D = 'products.unit_d';

    /**
     * the column name for the packing_desc field
     */
    public const COL_PACKING_DESC = 'products.packing_desc';

    /**
     * the column name for the packing_qty field
     */
    public const COL_PACKING_QTY = 'products.packing_qty';

    /**
     * the column name for the category_id field
     */
    public const COL_CATEGORY_ID = 'products.category_id';

    /**
     * the column name for the tag_id field
     */
    public const COL_TAG_ID = 'products.tag_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'products.company_id';

    /**
     * the column name for the product_images field
     */
    public const COL_PRODUCT_IMAGES = 'products.product_images';

    /**
     * the column name for the integration_id field
     */
    public const COL_INTEGRATION_ID = 'products.integration_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'products.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'products.updated_at';

    /**
     * the column name for the orgunit_id field
     */
    public const COL_ORGUNIT_ID = 'products.orgunit_id';

    /**
     * the column name for the brand_id field
     */
    public const COL_BRAND_ID = 'products.brand_id';

    /**
     * the column name for the base_price field
     */
    public const COL_BASE_PRICE = 'products.base_price';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'products.status';

    /**
     * the column name for the can_do_rcpa field
     */
    public const COL_CAN_DO_RCPA = 'products.can_do_rcpa';

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
        self::TYPE_PHPNAME       => ['Id', 'ProductName', 'ProductSummary', 'ProductDescription', 'ProductSku', 'AdditionalData', 'UnitD', 'PackingDesc', 'PackingQty', 'CategoryId', 'TagId', 'CompanyId', 'ProductImages', 'IntegrationId', 'CreatedAt', 'UpdatedAt', 'OrgunitId', 'BrandId', 'BasePrice', 'Status', 'CanDoRcpa', ],
        self::TYPE_CAMELNAME     => ['id', 'productName', 'productSummary', 'productDescription', 'productSku', 'additionalData', 'unitD', 'packingDesc', 'packingQty', 'categoryId', 'tagId', 'companyId', 'productImages', 'integrationId', 'createdAt', 'updatedAt', 'orgunitId', 'brandId', 'basePrice', 'status', 'canDoRcpa', ],
        self::TYPE_COLNAME       => [ProductsTableMap::COL_ID, ProductsTableMap::COL_PRODUCT_NAME, ProductsTableMap::COL_PRODUCT_SUMMARY, ProductsTableMap::COL_PRODUCT_DESCRIPTION, ProductsTableMap::COL_PRODUCT_SKU, ProductsTableMap::COL_ADDITIONAL_DATA, ProductsTableMap::COL_UNIT_D, ProductsTableMap::COL_PACKING_DESC, ProductsTableMap::COL_PACKING_QTY, ProductsTableMap::COL_CATEGORY_ID, ProductsTableMap::COL_TAG_ID, ProductsTableMap::COL_COMPANY_ID, ProductsTableMap::COL_PRODUCT_IMAGES, ProductsTableMap::COL_INTEGRATION_ID, ProductsTableMap::COL_CREATED_AT, ProductsTableMap::COL_UPDATED_AT, ProductsTableMap::COL_ORGUNIT_ID, ProductsTableMap::COL_BRAND_ID, ProductsTableMap::COL_BASE_PRICE, ProductsTableMap::COL_STATUS, ProductsTableMap::COL_CAN_DO_RCPA, ],
        self::TYPE_FIELDNAME     => ['id', 'product_name', 'product_summary', 'product_description', 'product_sku', 'additional_data', 'unit_d', 'packing_desc', 'packing_qty', 'category_id', 'tag_id', 'company_id', 'product_images', 'integration_id', 'created_at', 'updated_at', 'orgunit_id', 'brand_id', 'base_price', 'status', 'can_do_rcpa', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'ProductName' => 1, 'ProductSummary' => 2, 'ProductDescription' => 3, 'ProductSku' => 4, 'AdditionalData' => 5, 'UnitD' => 6, 'PackingDesc' => 7, 'PackingQty' => 8, 'CategoryId' => 9, 'TagId' => 10, 'CompanyId' => 11, 'ProductImages' => 12, 'IntegrationId' => 13, 'CreatedAt' => 14, 'UpdatedAt' => 15, 'OrgunitId' => 16, 'BrandId' => 17, 'BasePrice' => 18, 'Status' => 19, 'CanDoRcpa' => 20, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'productName' => 1, 'productSummary' => 2, 'productDescription' => 3, 'productSku' => 4, 'additionalData' => 5, 'unitD' => 6, 'packingDesc' => 7, 'packingQty' => 8, 'categoryId' => 9, 'tagId' => 10, 'companyId' => 11, 'productImages' => 12, 'integrationId' => 13, 'createdAt' => 14, 'updatedAt' => 15, 'orgunitId' => 16, 'brandId' => 17, 'basePrice' => 18, 'status' => 19, 'canDoRcpa' => 20, ],
        self::TYPE_COLNAME       => [ProductsTableMap::COL_ID => 0, ProductsTableMap::COL_PRODUCT_NAME => 1, ProductsTableMap::COL_PRODUCT_SUMMARY => 2, ProductsTableMap::COL_PRODUCT_DESCRIPTION => 3, ProductsTableMap::COL_PRODUCT_SKU => 4, ProductsTableMap::COL_ADDITIONAL_DATA => 5, ProductsTableMap::COL_UNIT_D => 6, ProductsTableMap::COL_PACKING_DESC => 7, ProductsTableMap::COL_PACKING_QTY => 8, ProductsTableMap::COL_CATEGORY_ID => 9, ProductsTableMap::COL_TAG_ID => 10, ProductsTableMap::COL_COMPANY_ID => 11, ProductsTableMap::COL_PRODUCT_IMAGES => 12, ProductsTableMap::COL_INTEGRATION_ID => 13, ProductsTableMap::COL_CREATED_AT => 14, ProductsTableMap::COL_UPDATED_AT => 15, ProductsTableMap::COL_ORGUNIT_ID => 16, ProductsTableMap::COL_BRAND_ID => 17, ProductsTableMap::COL_BASE_PRICE => 18, ProductsTableMap::COL_STATUS => 19, ProductsTableMap::COL_CAN_DO_RCPA => 20, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'product_name' => 1, 'product_summary' => 2, 'product_description' => 3, 'product_sku' => 4, 'additional_data' => 5, 'unit_d' => 6, 'packing_desc' => 7, 'packing_qty' => 8, 'category_id' => 9, 'tag_id' => 10, 'company_id' => 11, 'product_images' => 12, 'integration_id' => 13, 'created_at' => 14, 'updated_at' => 15, 'orgunit_id' => 16, 'brand_id' => 17, 'base_price' => 18, 'status' => 19, 'can_do_rcpa' => 20, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Products.Id' => 'ID',
        'id' => 'ID',
        'products.id' => 'ID',
        'ProductsTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'ProductName' => 'PRODUCT_NAME',
        'Products.ProductName' => 'PRODUCT_NAME',
        'productName' => 'PRODUCT_NAME',
        'products.productName' => 'PRODUCT_NAME',
        'ProductsTableMap::COL_PRODUCT_NAME' => 'PRODUCT_NAME',
        'COL_PRODUCT_NAME' => 'PRODUCT_NAME',
        'product_name' => 'PRODUCT_NAME',
        'products.product_name' => 'PRODUCT_NAME',
        'ProductSummary' => 'PRODUCT_SUMMARY',
        'Products.ProductSummary' => 'PRODUCT_SUMMARY',
        'productSummary' => 'PRODUCT_SUMMARY',
        'products.productSummary' => 'PRODUCT_SUMMARY',
        'ProductsTableMap::COL_PRODUCT_SUMMARY' => 'PRODUCT_SUMMARY',
        'COL_PRODUCT_SUMMARY' => 'PRODUCT_SUMMARY',
        'product_summary' => 'PRODUCT_SUMMARY',
        'products.product_summary' => 'PRODUCT_SUMMARY',
        'ProductDescription' => 'PRODUCT_DESCRIPTION',
        'Products.ProductDescription' => 'PRODUCT_DESCRIPTION',
        'productDescription' => 'PRODUCT_DESCRIPTION',
        'products.productDescription' => 'PRODUCT_DESCRIPTION',
        'ProductsTableMap::COL_PRODUCT_DESCRIPTION' => 'PRODUCT_DESCRIPTION',
        'COL_PRODUCT_DESCRIPTION' => 'PRODUCT_DESCRIPTION',
        'product_description' => 'PRODUCT_DESCRIPTION',
        'products.product_description' => 'PRODUCT_DESCRIPTION',
        'ProductSku' => 'PRODUCT_SKU',
        'Products.ProductSku' => 'PRODUCT_SKU',
        'productSku' => 'PRODUCT_SKU',
        'products.productSku' => 'PRODUCT_SKU',
        'ProductsTableMap::COL_PRODUCT_SKU' => 'PRODUCT_SKU',
        'COL_PRODUCT_SKU' => 'PRODUCT_SKU',
        'product_sku' => 'PRODUCT_SKU',
        'products.product_sku' => 'PRODUCT_SKU',
        'AdditionalData' => 'ADDITIONAL_DATA',
        'Products.AdditionalData' => 'ADDITIONAL_DATA',
        'additionalData' => 'ADDITIONAL_DATA',
        'products.additionalData' => 'ADDITIONAL_DATA',
        'ProductsTableMap::COL_ADDITIONAL_DATA' => 'ADDITIONAL_DATA',
        'COL_ADDITIONAL_DATA' => 'ADDITIONAL_DATA',
        'additional_data' => 'ADDITIONAL_DATA',
        'products.additional_data' => 'ADDITIONAL_DATA',
        'UnitD' => 'UNIT_D',
        'Products.UnitD' => 'UNIT_D',
        'unitD' => 'UNIT_D',
        'products.unitD' => 'UNIT_D',
        'ProductsTableMap::COL_UNIT_D' => 'UNIT_D',
        'COL_UNIT_D' => 'UNIT_D',
        'unit_d' => 'UNIT_D',
        'products.unit_d' => 'UNIT_D',
        'PackingDesc' => 'PACKING_DESC',
        'Products.PackingDesc' => 'PACKING_DESC',
        'packingDesc' => 'PACKING_DESC',
        'products.packingDesc' => 'PACKING_DESC',
        'ProductsTableMap::COL_PACKING_DESC' => 'PACKING_DESC',
        'COL_PACKING_DESC' => 'PACKING_DESC',
        'packing_desc' => 'PACKING_DESC',
        'products.packing_desc' => 'PACKING_DESC',
        'PackingQty' => 'PACKING_QTY',
        'Products.PackingQty' => 'PACKING_QTY',
        'packingQty' => 'PACKING_QTY',
        'products.packingQty' => 'PACKING_QTY',
        'ProductsTableMap::COL_PACKING_QTY' => 'PACKING_QTY',
        'COL_PACKING_QTY' => 'PACKING_QTY',
        'packing_qty' => 'PACKING_QTY',
        'products.packing_qty' => 'PACKING_QTY',
        'CategoryId' => 'CATEGORY_ID',
        'Products.CategoryId' => 'CATEGORY_ID',
        'categoryId' => 'CATEGORY_ID',
        'products.categoryId' => 'CATEGORY_ID',
        'ProductsTableMap::COL_CATEGORY_ID' => 'CATEGORY_ID',
        'COL_CATEGORY_ID' => 'CATEGORY_ID',
        'category_id' => 'CATEGORY_ID',
        'products.category_id' => 'CATEGORY_ID',
        'TagId' => 'TAG_ID',
        'Products.TagId' => 'TAG_ID',
        'tagId' => 'TAG_ID',
        'products.tagId' => 'TAG_ID',
        'ProductsTableMap::COL_TAG_ID' => 'TAG_ID',
        'COL_TAG_ID' => 'TAG_ID',
        'tag_id' => 'TAG_ID',
        'products.tag_id' => 'TAG_ID',
        'CompanyId' => 'COMPANY_ID',
        'Products.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'products.companyId' => 'COMPANY_ID',
        'ProductsTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'products.company_id' => 'COMPANY_ID',
        'ProductImages' => 'PRODUCT_IMAGES',
        'Products.ProductImages' => 'PRODUCT_IMAGES',
        'productImages' => 'PRODUCT_IMAGES',
        'products.productImages' => 'PRODUCT_IMAGES',
        'ProductsTableMap::COL_PRODUCT_IMAGES' => 'PRODUCT_IMAGES',
        'COL_PRODUCT_IMAGES' => 'PRODUCT_IMAGES',
        'product_images' => 'PRODUCT_IMAGES',
        'products.product_images' => 'PRODUCT_IMAGES',
        'IntegrationId' => 'INTEGRATION_ID',
        'Products.IntegrationId' => 'INTEGRATION_ID',
        'integrationId' => 'INTEGRATION_ID',
        'products.integrationId' => 'INTEGRATION_ID',
        'ProductsTableMap::COL_INTEGRATION_ID' => 'INTEGRATION_ID',
        'COL_INTEGRATION_ID' => 'INTEGRATION_ID',
        'integration_id' => 'INTEGRATION_ID',
        'products.integration_id' => 'INTEGRATION_ID',
        'CreatedAt' => 'CREATED_AT',
        'Products.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'products.createdAt' => 'CREATED_AT',
        'ProductsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'products.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Products.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'products.updatedAt' => 'UPDATED_AT',
        'ProductsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'products.updated_at' => 'UPDATED_AT',
        'OrgunitId' => 'ORGUNIT_ID',
        'Products.OrgunitId' => 'ORGUNIT_ID',
        'orgunitId' => 'ORGUNIT_ID',
        'products.orgunitId' => 'ORGUNIT_ID',
        'ProductsTableMap::COL_ORGUNIT_ID' => 'ORGUNIT_ID',
        'COL_ORGUNIT_ID' => 'ORGUNIT_ID',
        'orgunit_id' => 'ORGUNIT_ID',
        'products.orgunit_id' => 'ORGUNIT_ID',
        'BrandId' => 'BRAND_ID',
        'Products.BrandId' => 'BRAND_ID',
        'brandId' => 'BRAND_ID',
        'products.brandId' => 'BRAND_ID',
        'ProductsTableMap::COL_BRAND_ID' => 'BRAND_ID',
        'COL_BRAND_ID' => 'BRAND_ID',
        'brand_id' => 'BRAND_ID',
        'products.brand_id' => 'BRAND_ID',
        'BasePrice' => 'BASE_PRICE',
        'Products.BasePrice' => 'BASE_PRICE',
        'basePrice' => 'BASE_PRICE',
        'products.basePrice' => 'BASE_PRICE',
        'ProductsTableMap::COL_BASE_PRICE' => 'BASE_PRICE',
        'COL_BASE_PRICE' => 'BASE_PRICE',
        'base_price' => 'BASE_PRICE',
        'products.base_price' => 'BASE_PRICE',
        'Status' => 'STATUS',
        'Products.Status' => 'STATUS',
        'status' => 'STATUS',
        'products.status' => 'STATUS',
        'ProductsTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'CanDoRcpa' => 'CAN_DO_RCPA',
        'Products.CanDoRcpa' => 'CAN_DO_RCPA',
        'canDoRcpa' => 'CAN_DO_RCPA',
        'products.canDoRcpa' => 'CAN_DO_RCPA',
        'ProductsTableMap::COL_CAN_DO_RCPA' => 'CAN_DO_RCPA',
        'COL_CAN_DO_RCPA' => 'CAN_DO_RCPA',
        'can_do_rcpa' => 'CAN_DO_RCPA',
        'products.can_do_rcpa' => 'CAN_DO_RCPA',
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
        $this->setName('products');
        $this->setPhpName('Products');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Products');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('products_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('product_name', 'ProductName', 'VARCHAR', true, 255, null);
        $this->addColumn('product_summary', 'ProductSummary', 'VARCHAR', false, 255, null);
        $this->addColumn('product_description', 'ProductDescription', 'VARCHAR', false, 255, null);
        $this->addColumn('product_sku', 'ProductSku', 'VARCHAR', true, 255, null);
        $this->addColumn('additional_data', 'AdditionalData', 'VARCHAR', false, 100, null);
        $this->addForeignKey('unit_d', 'UnitD', 'INTEGER', 'unitmaster', 'unit_id', false, null, null);
        $this->addColumn('packing_desc', 'PackingDesc', 'VARCHAR', false, 255, null);
        $this->addColumn('packing_qty', 'PackingQty', 'INTEGER', false, null, null);
        $this->addForeignKey('category_id', 'CategoryId', 'INTEGER', 'categories', 'id', false, null, null);
        $this->addForeignKey('tag_id', 'TagId', 'INTEGER', 'tags', 'id', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addColumn('product_images', 'ProductImages', 'VARCHAR', false, 150, null);
        $this->addColumn('integration_id', 'IntegrationId', 'VARCHAR', false, 50, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('orgunit_id', 'OrgunitId', 'INTEGER', false, null, null);
        $this->addForeignKey('brand_id', 'BrandId', 'INTEGER', 'brands', 'brand_id', false, null, null);
        $this->addColumn('base_price', 'BasePrice', 'DECIMAL', false, null, null);
        $this->addColumn('status', 'Status', 'VARCHAR', false, null, 'active');
        $this->addColumn('can_do_rcpa', 'CanDoRcpa', 'VARCHAR', false, null, 'yes');
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Categories', '\\entities\\Categories', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':category_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, null, false);
        $this->addRelation('Tags', '\\entities\\Tags', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':tag_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Unitmaster', '\\entities\\Unitmaster', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':unit_d',
    1 => ':unit_id',
  ),
), null, null, null, false);
        $this->addRelation('Brands', '\\entities\\Brands', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':brand_id',
    1 => ':brand_id',
  ),
), null, null, null, false);
        $this->addRelation('BrandCompetition', '\\entities\\BrandCompetition', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), null, null, 'BrandCompetitions', false);
        $this->addRelation('Orderlines', '\\entities\\Orderlines', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), null, null, 'Orderliness', false);
        $this->addRelation('OutletStock', '\\entities\\OutletStock', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), null, null, 'OutletStocks', false);
        $this->addRelation('OutletStockOtherSummary', '\\entities\\OutletStockOtherSummary', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), null, null, 'OutletStockOtherSummaries', false);
        $this->addRelation('OutletStockSummary', '\\entities\\OutletStockSummary', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), null, null, 'OutletStockSummaries', false);
        $this->addRelation('Pricebooklines', '\\entities\\Pricebooklines', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), null, null, 'Pricebookliness', false);
        $this->addRelation('Productmedia', '\\entities\\Productmedia', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), null, null, 'Productmedias', false);
        $this->addRelation('Shippinglines', '\\entities\\Shippinglines', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), null, null, 'Shippingliness', false);
        $this->addRelation('StockTransaction', '\\entities\\StockTransaction', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), null, null, 'StockTransactions', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ProductsTableMap::CLASS_DEFAULT : ProductsTableMap::OM_CLASS;
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
     * @return array (Products object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ProductsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ProductsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ProductsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ProductsTableMap::OM_CLASS;
            /** @var Products $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ProductsTableMap::addInstanceToPool($obj, $key);
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
            $key = ProductsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ProductsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Products $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ProductsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ProductsTableMap::COL_ID);
            $criteria->addSelectColumn(ProductsTableMap::COL_PRODUCT_NAME);
            $criteria->addSelectColumn(ProductsTableMap::COL_PRODUCT_SUMMARY);
            $criteria->addSelectColumn(ProductsTableMap::COL_PRODUCT_DESCRIPTION);
            $criteria->addSelectColumn(ProductsTableMap::COL_PRODUCT_SKU);
            $criteria->addSelectColumn(ProductsTableMap::COL_ADDITIONAL_DATA);
            $criteria->addSelectColumn(ProductsTableMap::COL_UNIT_D);
            $criteria->addSelectColumn(ProductsTableMap::COL_PACKING_DESC);
            $criteria->addSelectColumn(ProductsTableMap::COL_PACKING_QTY);
            $criteria->addSelectColumn(ProductsTableMap::COL_CATEGORY_ID);
            $criteria->addSelectColumn(ProductsTableMap::COL_TAG_ID);
            $criteria->addSelectColumn(ProductsTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(ProductsTableMap::COL_PRODUCT_IMAGES);
            $criteria->addSelectColumn(ProductsTableMap::COL_INTEGRATION_ID);
            $criteria->addSelectColumn(ProductsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(ProductsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(ProductsTableMap::COL_ORGUNIT_ID);
            $criteria->addSelectColumn(ProductsTableMap::COL_BRAND_ID);
            $criteria->addSelectColumn(ProductsTableMap::COL_BASE_PRICE);
            $criteria->addSelectColumn(ProductsTableMap::COL_STATUS);
            $criteria->addSelectColumn(ProductsTableMap::COL_CAN_DO_RCPA);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.product_name');
            $criteria->addSelectColumn($alias . '.product_summary');
            $criteria->addSelectColumn($alias . '.product_description');
            $criteria->addSelectColumn($alias . '.product_sku');
            $criteria->addSelectColumn($alias . '.additional_data');
            $criteria->addSelectColumn($alias . '.unit_d');
            $criteria->addSelectColumn($alias . '.packing_desc');
            $criteria->addSelectColumn($alias . '.packing_qty');
            $criteria->addSelectColumn($alias . '.category_id');
            $criteria->addSelectColumn($alias . '.tag_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.product_images');
            $criteria->addSelectColumn($alias . '.integration_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.orgunit_id');
            $criteria->addSelectColumn($alias . '.brand_id');
            $criteria->addSelectColumn($alias . '.base_price');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.can_do_rcpa');
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
            $criteria->removeSelectColumn(ProductsTableMap::COL_ID);
            $criteria->removeSelectColumn(ProductsTableMap::COL_PRODUCT_NAME);
            $criteria->removeSelectColumn(ProductsTableMap::COL_PRODUCT_SUMMARY);
            $criteria->removeSelectColumn(ProductsTableMap::COL_PRODUCT_DESCRIPTION);
            $criteria->removeSelectColumn(ProductsTableMap::COL_PRODUCT_SKU);
            $criteria->removeSelectColumn(ProductsTableMap::COL_ADDITIONAL_DATA);
            $criteria->removeSelectColumn(ProductsTableMap::COL_UNIT_D);
            $criteria->removeSelectColumn(ProductsTableMap::COL_PACKING_DESC);
            $criteria->removeSelectColumn(ProductsTableMap::COL_PACKING_QTY);
            $criteria->removeSelectColumn(ProductsTableMap::COL_CATEGORY_ID);
            $criteria->removeSelectColumn(ProductsTableMap::COL_TAG_ID);
            $criteria->removeSelectColumn(ProductsTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(ProductsTableMap::COL_PRODUCT_IMAGES);
            $criteria->removeSelectColumn(ProductsTableMap::COL_INTEGRATION_ID);
            $criteria->removeSelectColumn(ProductsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(ProductsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(ProductsTableMap::COL_ORGUNIT_ID);
            $criteria->removeSelectColumn(ProductsTableMap::COL_BRAND_ID);
            $criteria->removeSelectColumn(ProductsTableMap::COL_BASE_PRICE);
            $criteria->removeSelectColumn(ProductsTableMap::COL_STATUS);
            $criteria->removeSelectColumn(ProductsTableMap::COL_CAN_DO_RCPA);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.product_name');
            $criteria->removeSelectColumn($alias . '.product_summary');
            $criteria->removeSelectColumn($alias . '.product_description');
            $criteria->removeSelectColumn($alias . '.product_sku');
            $criteria->removeSelectColumn($alias . '.additional_data');
            $criteria->removeSelectColumn($alias . '.unit_d');
            $criteria->removeSelectColumn($alias . '.packing_desc');
            $criteria->removeSelectColumn($alias . '.packing_qty');
            $criteria->removeSelectColumn($alias . '.category_id');
            $criteria->removeSelectColumn($alias . '.tag_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.product_images');
            $criteria->removeSelectColumn($alias . '.integration_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.orgunit_id');
            $criteria->removeSelectColumn($alias . '.brand_id');
            $criteria->removeSelectColumn($alias . '.base_price');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.can_do_rcpa');
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
        return Propel::getServiceContainer()->getDatabaseMap(ProductsTableMap::DATABASE_NAME)->getTable(ProductsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Products or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Products object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Products) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ProductsTableMap::DATABASE_NAME);
            $criteria->add(ProductsTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ProductsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ProductsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ProductsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the products table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ProductsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Products or Criteria object.
     *
     * @param mixed $criteria Criteria or Products object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Products object
        }

        if ($criteria->containsKey(ProductsTableMap::COL_ID) && $criteria->keyContainsValue(ProductsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ProductsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ProductsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
