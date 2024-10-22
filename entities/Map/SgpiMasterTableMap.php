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
use entities\SgpiMaster;
use entities\SgpiMasterQuery;


/**
 * This class defines the structure of the 'sgpi_master' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SgpiMasterTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.SgpiMasterTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'sgpi_master';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SgpiMaster';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\SgpiMaster';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.SgpiMaster';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 17;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 17;

    /**
     * the column name for the sgpi_id field
     */
    public const COL_SGPI_ID = 'sgpi_master.sgpi_id';

    /**
     * the column name for the sgpi_name field
     */
    public const COL_SGPI_NAME = 'sgpi_master.sgpi_name';

    /**
     * the column name for the sgpi_code field
     */
    public const COL_SGPI_CODE = 'sgpi_master.sgpi_code';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'sgpi_master.company_id';

    /**
     * the column name for the sgpi_status field
     */
    public const COL_SGPI_STATUS = 'sgpi_master.sgpi_status';

    /**
     * the column name for the sgpi_media field
     */
    public const COL_SGPI_MEDIA = 'sgpi_master.sgpi_media';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'sgpi_master.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'sgpi_master.updated_at';

    /**
     * the column name for the material_sku field
     */
    public const COL_MATERIAL_SKU = 'sgpi_master.material_sku';

    /**
     * the column name for the sgpi_type field
     */
    public const COL_SGPI_TYPE = 'sgpi_master.sgpi_type';

    /**
     * the column name for the use_start_date field
     */
    public const COL_USE_START_DATE = 'sgpi_master.use_start_date';

    /**
     * the column name for the use_end_date field
     */
    public const COL_USE_END_DATE = 'sgpi_master.use_end_date';

    /**
     * the column name for the org_unit_id field
     */
    public const COL_ORG_UNIT_ID = 'sgpi_master.org_unit_id';

    /**
     * the column name for the brand_id field
     */
    public const COL_BRAND_ID = 'sgpi_master.brand_id';

    /**
     * the column name for the max_qty field
     */
    public const COL_MAX_QTY = 'sgpi_master.max_qty';

    /**
     * the column name for the outlettype_id field
     */
    public const COL_OUTLETTYPE_ID = 'sgpi_master.outlettype_id';

    /**
     * the column name for the is_strategic field
     */
    public const COL_IS_STRATEGIC = 'sgpi_master.is_strategic';

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
        self::TYPE_PHPNAME       => ['SgpiId', 'SgpiName', 'SgpiCode', 'CompanyId', 'SgpiStatus', 'SgpiMedia', 'CreatedAt', 'UpdatedAt', 'MaterialSku', 'SgpiType', 'UseStartDate', 'UseEndDate', 'OrgUnitId', 'BrandId', 'MaxQty', 'OutlettypeId', 'IsStrategic', ],
        self::TYPE_CAMELNAME     => ['sgpiId', 'sgpiName', 'sgpiCode', 'companyId', 'sgpiStatus', 'sgpiMedia', 'createdAt', 'updatedAt', 'materialSku', 'sgpiType', 'useStartDate', 'useEndDate', 'orgUnitId', 'brandId', 'maxQty', 'outlettypeId', 'isStrategic', ],
        self::TYPE_COLNAME       => [SgpiMasterTableMap::COL_SGPI_ID, SgpiMasterTableMap::COL_SGPI_NAME, SgpiMasterTableMap::COL_SGPI_CODE, SgpiMasterTableMap::COL_COMPANY_ID, SgpiMasterTableMap::COL_SGPI_STATUS, SgpiMasterTableMap::COL_SGPI_MEDIA, SgpiMasterTableMap::COL_CREATED_AT, SgpiMasterTableMap::COL_UPDATED_AT, SgpiMasterTableMap::COL_MATERIAL_SKU, SgpiMasterTableMap::COL_SGPI_TYPE, SgpiMasterTableMap::COL_USE_START_DATE, SgpiMasterTableMap::COL_USE_END_DATE, SgpiMasterTableMap::COL_ORG_UNIT_ID, SgpiMasterTableMap::COL_BRAND_ID, SgpiMasterTableMap::COL_MAX_QTY, SgpiMasterTableMap::COL_OUTLETTYPE_ID, SgpiMasterTableMap::COL_IS_STRATEGIC, ],
        self::TYPE_FIELDNAME     => ['sgpi_id', 'sgpi_name', 'sgpi_code', 'company_id', 'sgpi_status', 'sgpi_media', 'created_at', 'updated_at', 'material_sku', 'sgpi_type', 'use_start_date', 'use_end_date', 'org_unit_id', 'brand_id', 'max_qty', 'outlettype_id', 'is_strategic', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, ]
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
        self::TYPE_PHPNAME       => ['SgpiId' => 0, 'SgpiName' => 1, 'SgpiCode' => 2, 'CompanyId' => 3, 'SgpiStatus' => 4, 'SgpiMedia' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, 'MaterialSku' => 8, 'SgpiType' => 9, 'UseStartDate' => 10, 'UseEndDate' => 11, 'OrgUnitId' => 12, 'BrandId' => 13, 'MaxQty' => 14, 'OutlettypeId' => 15, 'IsStrategic' => 16, ],
        self::TYPE_CAMELNAME     => ['sgpiId' => 0, 'sgpiName' => 1, 'sgpiCode' => 2, 'companyId' => 3, 'sgpiStatus' => 4, 'sgpiMedia' => 5, 'createdAt' => 6, 'updatedAt' => 7, 'materialSku' => 8, 'sgpiType' => 9, 'useStartDate' => 10, 'useEndDate' => 11, 'orgUnitId' => 12, 'brandId' => 13, 'maxQty' => 14, 'outlettypeId' => 15, 'isStrategic' => 16, ],
        self::TYPE_COLNAME       => [SgpiMasterTableMap::COL_SGPI_ID => 0, SgpiMasterTableMap::COL_SGPI_NAME => 1, SgpiMasterTableMap::COL_SGPI_CODE => 2, SgpiMasterTableMap::COL_COMPANY_ID => 3, SgpiMasterTableMap::COL_SGPI_STATUS => 4, SgpiMasterTableMap::COL_SGPI_MEDIA => 5, SgpiMasterTableMap::COL_CREATED_AT => 6, SgpiMasterTableMap::COL_UPDATED_AT => 7, SgpiMasterTableMap::COL_MATERIAL_SKU => 8, SgpiMasterTableMap::COL_SGPI_TYPE => 9, SgpiMasterTableMap::COL_USE_START_DATE => 10, SgpiMasterTableMap::COL_USE_END_DATE => 11, SgpiMasterTableMap::COL_ORG_UNIT_ID => 12, SgpiMasterTableMap::COL_BRAND_ID => 13, SgpiMasterTableMap::COL_MAX_QTY => 14, SgpiMasterTableMap::COL_OUTLETTYPE_ID => 15, SgpiMasterTableMap::COL_IS_STRATEGIC => 16, ],
        self::TYPE_FIELDNAME     => ['sgpi_id' => 0, 'sgpi_name' => 1, 'sgpi_code' => 2, 'company_id' => 3, 'sgpi_status' => 4, 'sgpi_media' => 5, 'created_at' => 6, 'updated_at' => 7, 'material_sku' => 8, 'sgpi_type' => 9, 'use_start_date' => 10, 'use_end_date' => 11, 'org_unit_id' => 12, 'brand_id' => 13, 'max_qty' => 14, 'outlettype_id' => 15, 'is_strategic' => 16, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'SgpiId' => 'SGPI_ID',
        'SgpiMaster.SgpiId' => 'SGPI_ID',
        'sgpiId' => 'SGPI_ID',
        'sgpiMaster.sgpiId' => 'SGPI_ID',
        'SgpiMasterTableMap::COL_SGPI_ID' => 'SGPI_ID',
        'COL_SGPI_ID' => 'SGPI_ID',
        'sgpi_id' => 'SGPI_ID',
        'sgpi_master.sgpi_id' => 'SGPI_ID',
        'SgpiName' => 'SGPI_NAME',
        'SgpiMaster.SgpiName' => 'SGPI_NAME',
        'sgpiName' => 'SGPI_NAME',
        'sgpiMaster.sgpiName' => 'SGPI_NAME',
        'SgpiMasterTableMap::COL_SGPI_NAME' => 'SGPI_NAME',
        'COL_SGPI_NAME' => 'SGPI_NAME',
        'sgpi_name' => 'SGPI_NAME',
        'sgpi_master.sgpi_name' => 'SGPI_NAME',
        'SgpiCode' => 'SGPI_CODE',
        'SgpiMaster.SgpiCode' => 'SGPI_CODE',
        'sgpiCode' => 'SGPI_CODE',
        'sgpiMaster.sgpiCode' => 'SGPI_CODE',
        'SgpiMasterTableMap::COL_SGPI_CODE' => 'SGPI_CODE',
        'COL_SGPI_CODE' => 'SGPI_CODE',
        'sgpi_code' => 'SGPI_CODE',
        'sgpi_master.sgpi_code' => 'SGPI_CODE',
        'CompanyId' => 'COMPANY_ID',
        'SgpiMaster.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'sgpiMaster.companyId' => 'COMPANY_ID',
        'SgpiMasterTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'sgpi_master.company_id' => 'COMPANY_ID',
        'SgpiStatus' => 'SGPI_STATUS',
        'SgpiMaster.SgpiStatus' => 'SGPI_STATUS',
        'sgpiStatus' => 'SGPI_STATUS',
        'sgpiMaster.sgpiStatus' => 'SGPI_STATUS',
        'SgpiMasterTableMap::COL_SGPI_STATUS' => 'SGPI_STATUS',
        'COL_SGPI_STATUS' => 'SGPI_STATUS',
        'sgpi_status' => 'SGPI_STATUS',
        'sgpi_master.sgpi_status' => 'SGPI_STATUS',
        'SgpiMedia' => 'SGPI_MEDIA',
        'SgpiMaster.SgpiMedia' => 'SGPI_MEDIA',
        'sgpiMedia' => 'SGPI_MEDIA',
        'sgpiMaster.sgpiMedia' => 'SGPI_MEDIA',
        'SgpiMasterTableMap::COL_SGPI_MEDIA' => 'SGPI_MEDIA',
        'COL_SGPI_MEDIA' => 'SGPI_MEDIA',
        'sgpi_media' => 'SGPI_MEDIA',
        'sgpi_master.sgpi_media' => 'SGPI_MEDIA',
        'CreatedAt' => 'CREATED_AT',
        'SgpiMaster.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'sgpiMaster.createdAt' => 'CREATED_AT',
        'SgpiMasterTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'sgpi_master.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SgpiMaster.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'sgpiMaster.updatedAt' => 'UPDATED_AT',
        'SgpiMasterTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'sgpi_master.updated_at' => 'UPDATED_AT',
        'MaterialSku' => 'MATERIAL_SKU',
        'SgpiMaster.MaterialSku' => 'MATERIAL_SKU',
        'materialSku' => 'MATERIAL_SKU',
        'sgpiMaster.materialSku' => 'MATERIAL_SKU',
        'SgpiMasterTableMap::COL_MATERIAL_SKU' => 'MATERIAL_SKU',
        'COL_MATERIAL_SKU' => 'MATERIAL_SKU',
        'material_sku' => 'MATERIAL_SKU',
        'sgpi_master.material_sku' => 'MATERIAL_SKU',
        'SgpiType' => 'SGPI_TYPE',
        'SgpiMaster.SgpiType' => 'SGPI_TYPE',
        'sgpiType' => 'SGPI_TYPE',
        'sgpiMaster.sgpiType' => 'SGPI_TYPE',
        'SgpiMasterTableMap::COL_SGPI_TYPE' => 'SGPI_TYPE',
        'COL_SGPI_TYPE' => 'SGPI_TYPE',
        'sgpi_type' => 'SGPI_TYPE',
        'sgpi_master.sgpi_type' => 'SGPI_TYPE',
        'UseStartDate' => 'USE_START_DATE',
        'SgpiMaster.UseStartDate' => 'USE_START_DATE',
        'useStartDate' => 'USE_START_DATE',
        'sgpiMaster.useStartDate' => 'USE_START_DATE',
        'SgpiMasterTableMap::COL_USE_START_DATE' => 'USE_START_DATE',
        'COL_USE_START_DATE' => 'USE_START_DATE',
        'use_start_date' => 'USE_START_DATE',
        'sgpi_master.use_start_date' => 'USE_START_DATE',
        'UseEndDate' => 'USE_END_DATE',
        'SgpiMaster.UseEndDate' => 'USE_END_DATE',
        'useEndDate' => 'USE_END_DATE',
        'sgpiMaster.useEndDate' => 'USE_END_DATE',
        'SgpiMasterTableMap::COL_USE_END_DATE' => 'USE_END_DATE',
        'COL_USE_END_DATE' => 'USE_END_DATE',
        'use_end_date' => 'USE_END_DATE',
        'sgpi_master.use_end_date' => 'USE_END_DATE',
        'OrgUnitId' => 'ORG_UNIT_ID',
        'SgpiMaster.OrgUnitId' => 'ORG_UNIT_ID',
        'orgUnitId' => 'ORG_UNIT_ID',
        'sgpiMaster.orgUnitId' => 'ORG_UNIT_ID',
        'SgpiMasterTableMap::COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'org_unit_id' => 'ORG_UNIT_ID',
        'sgpi_master.org_unit_id' => 'ORG_UNIT_ID',
        'BrandId' => 'BRAND_ID',
        'SgpiMaster.BrandId' => 'BRAND_ID',
        'brandId' => 'BRAND_ID',
        'sgpiMaster.brandId' => 'BRAND_ID',
        'SgpiMasterTableMap::COL_BRAND_ID' => 'BRAND_ID',
        'COL_BRAND_ID' => 'BRAND_ID',
        'brand_id' => 'BRAND_ID',
        'sgpi_master.brand_id' => 'BRAND_ID',
        'MaxQty' => 'MAX_QTY',
        'SgpiMaster.MaxQty' => 'MAX_QTY',
        'maxQty' => 'MAX_QTY',
        'sgpiMaster.maxQty' => 'MAX_QTY',
        'SgpiMasterTableMap::COL_MAX_QTY' => 'MAX_QTY',
        'COL_MAX_QTY' => 'MAX_QTY',
        'max_qty' => 'MAX_QTY',
        'sgpi_master.max_qty' => 'MAX_QTY',
        'OutlettypeId' => 'OUTLETTYPE_ID',
        'SgpiMaster.OutlettypeId' => 'OUTLETTYPE_ID',
        'outlettypeId' => 'OUTLETTYPE_ID',
        'sgpiMaster.outlettypeId' => 'OUTLETTYPE_ID',
        'SgpiMasterTableMap::COL_OUTLETTYPE_ID' => 'OUTLETTYPE_ID',
        'COL_OUTLETTYPE_ID' => 'OUTLETTYPE_ID',
        'outlettype_id' => 'OUTLETTYPE_ID',
        'sgpi_master.outlettype_id' => 'OUTLETTYPE_ID',
        'IsStrategic' => 'IS_STRATEGIC',
        'SgpiMaster.IsStrategic' => 'IS_STRATEGIC',
        'isStrategic' => 'IS_STRATEGIC',
        'sgpiMaster.isStrategic' => 'IS_STRATEGIC',
        'SgpiMasterTableMap::COL_IS_STRATEGIC' => 'IS_STRATEGIC',
        'COL_IS_STRATEGIC' => 'IS_STRATEGIC',
        'is_strategic' => 'IS_STRATEGIC',
        'sgpi_master.is_strategic' => 'IS_STRATEGIC',
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
        $this->setName('sgpi_master');
        $this->setPhpName('SgpiMaster');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\SgpiMaster');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('sgpi_master_sgpi_id_seq');
        // columns
        $this->addPrimaryKey('sgpi_id', 'SgpiId', 'INTEGER', true, null, null);
        $this->addColumn('sgpi_name', 'SgpiName', 'VARCHAR', false, null, null);
        $this->addColumn('sgpi_code', 'SgpiCode', 'VARCHAR', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('sgpi_status', 'SgpiStatus', 'VARCHAR', false, null, null);
        $this->addColumn('sgpi_media', 'SgpiMedia', 'INTEGER', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('material_sku', 'MaterialSku', 'VARCHAR', false, null, null);
        $this->addColumn('sgpi_type', 'SgpiType', 'VARCHAR', false, null, null);
        $this->addColumn('use_start_date', 'UseStartDate', 'DATE', false, null, null);
        $this->addColumn('use_end_date', 'UseEndDate', 'DATE', false, null, null);
        $this->addForeignKey('org_unit_id', 'OrgUnitId', 'INTEGER', 'org_unit', 'orgunitid', false, null, null);
        $this->addForeignKey('brand_id', 'BrandId', 'INTEGER', 'brands', 'brand_id', false, null, null);
        $this->addColumn('max_qty', 'MaxQty', 'INTEGER', false, null, null);
        $this->addForeignKey('outlettype_id', 'OutlettypeId', 'INTEGER', 'outlet_type', 'outlettype_id', false, null, null);
        $this->addColumn('is_strategic', 'IsStrategic', 'BOOLEAN', false, 1, false);
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
        $this->addRelation('OrgUnit', '\\entities\\OrgUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':org_unit_id',
    1 => ':orgunitid',
  ),
), null, null, null, false);
        $this->addRelation('OutletType', '\\entities\\OutletType', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlettype_id',
    1 => ':outlettype_id',
  ),
), null, null, null, false);
        $this->addRelation('DailycallsSgpiout', '\\entities\\DailycallsSgpiout', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':sgpi_id',
    1 => ':sgpi_id',
  ),
), null, null, 'DailycallsSgpiouts', false);
        $this->addRelation('SgpiTrans', '\\entities\\SgpiTrans', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':sgpi_id',
    1 => ':sgpi_id',
  ),
), null, null, 'SgpiTranss', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('SgpiId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SgpiMasterTableMap::CLASS_DEFAULT : SgpiMasterTableMap::OM_CLASS;
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
     * @return array (SgpiMaster object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SgpiMasterTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SgpiMasterTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SgpiMasterTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SgpiMasterTableMap::OM_CLASS;
            /** @var SgpiMaster $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SgpiMasterTableMap::addInstanceToPool($obj, $key);
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
            $key = SgpiMasterTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SgpiMasterTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SgpiMaster $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SgpiMasterTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SgpiMasterTableMap::COL_SGPI_ID);
            $criteria->addSelectColumn(SgpiMasterTableMap::COL_SGPI_NAME);
            $criteria->addSelectColumn(SgpiMasterTableMap::COL_SGPI_CODE);
            $criteria->addSelectColumn(SgpiMasterTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(SgpiMasterTableMap::COL_SGPI_STATUS);
            $criteria->addSelectColumn(SgpiMasterTableMap::COL_SGPI_MEDIA);
            $criteria->addSelectColumn(SgpiMasterTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SgpiMasterTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(SgpiMasterTableMap::COL_MATERIAL_SKU);
            $criteria->addSelectColumn(SgpiMasterTableMap::COL_SGPI_TYPE);
            $criteria->addSelectColumn(SgpiMasterTableMap::COL_USE_START_DATE);
            $criteria->addSelectColumn(SgpiMasterTableMap::COL_USE_END_DATE);
            $criteria->addSelectColumn(SgpiMasterTableMap::COL_ORG_UNIT_ID);
            $criteria->addSelectColumn(SgpiMasterTableMap::COL_BRAND_ID);
            $criteria->addSelectColumn(SgpiMasterTableMap::COL_MAX_QTY);
            $criteria->addSelectColumn(SgpiMasterTableMap::COL_OUTLETTYPE_ID);
            $criteria->addSelectColumn(SgpiMasterTableMap::COL_IS_STRATEGIC);
        } else {
            $criteria->addSelectColumn($alias . '.sgpi_id');
            $criteria->addSelectColumn($alias . '.sgpi_name');
            $criteria->addSelectColumn($alias . '.sgpi_code');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.sgpi_status');
            $criteria->addSelectColumn($alias . '.sgpi_media');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.material_sku');
            $criteria->addSelectColumn($alias . '.sgpi_type');
            $criteria->addSelectColumn($alias . '.use_start_date');
            $criteria->addSelectColumn($alias . '.use_end_date');
            $criteria->addSelectColumn($alias . '.org_unit_id');
            $criteria->addSelectColumn($alias . '.brand_id');
            $criteria->addSelectColumn($alias . '.max_qty');
            $criteria->addSelectColumn($alias . '.outlettype_id');
            $criteria->addSelectColumn($alias . '.is_strategic');
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
            $criteria->removeSelectColumn(SgpiMasterTableMap::COL_SGPI_ID);
            $criteria->removeSelectColumn(SgpiMasterTableMap::COL_SGPI_NAME);
            $criteria->removeSelectColumn(SgpiMasterTableMap::COL_SGPI_CODE);
            $criteria->removeSelectColumn(SgpiMasterTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(SgpiMasterTableMap::COL_SGPI_STATUS);
            $criteria->removeSelectColumn(SgpiMasterTableMap::COL_SGPI_MEDIA);
            $criteria->removeSelectColumn(SgpiMasterTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SgpiMasterTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(SgpiMasterTableMap::COL_MATERIAL_SKU);
            $criteria->removeSelectColumn(SgpiMasterTableMap::COL_SGPI_TYPE);
            $criteria->removeSelectColumn(SgpiMasterTableMap::COL_USE_START_DATE);
            $criteria->removeSelectColumn(SgpiMasterTableMap::COL_USE_END_DATE);
            $criteria->removeSelectColumn(SgpiMasterTableMap::COL_ORG_UNIT_ID);
            $criteria->removeSelectColumn(SgpiMasterTableMap::COL_BRAND_ID);
            $criteria->removeSelectColumn(SgpiMasterTableMap::COL_MAX_QTY);
            $criteria->removeSelectColumn(SgpiMasterTableMap::COL_OUTLETTYPE_ID);
            $criteria->removeSelectColumn(SgpiMasterTableMap::COL_IS_STRATEGIC);
        } else {
            $criteria->removeSelectColumn($alias . '.sgpi_id');
            $criteria->removeSelectColumn($alias . '.sgpi_name');
            $criteria->removeSelectColumn($alias . '.sgpi_code');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.sgpi_status');
            $criteria->removeSelectColumn($alias . '.sgpi_media');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.material_sku');
            $criteria->removeSelectColumn($alias . '.sgpi_type');
            $criteria->removeSelectColumn($alias . '.use_start_date');
            $criteria->removeSelectColumn($alias . '.use_end_date');
            $criteria->removeSelectColumn($alias . '.org_unit_id');
            $criteria->removeSelectColumn($alias . '.brand_id');
            $criteria->removeSelectColumn($alias . '.max_qty');
            $criteria->removeSelectColumn($alias . '.outlettype_id');
            $criteria->removeSelectColumn($alias . '.is_strategic');
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
        return Propel::getServiceContainer()->getDatabaseMap(SgpiMasterTableMap::DATABASE_NAME)->getTable(SgpiMasterTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SgpiMaster or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SgpiMaster object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SgpiMasterTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\SgpiMaster) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SgpiMasterTableMap::DATABASE_NAME);
            $criteria->add(SgpiMasterTableMap::COL_SGPI_ID, (array) $values, Criteria::IN);
        }

        $query = SgpiMasterQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SgpiMasterTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SgpiMasterTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sgpi_master table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SgpiMasterQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SgpiMaster or Criteria object.
     *
     * @param mixed $criteria Criteria or SgpiMaster object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SgpiMasterTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SgpiMaster object
        }

        if ($criteria->containsKey(SgpiMasterTableMap::COL_SGPI_ID) && $criteria->keyContainsValue(SgpiMasterTableMap::COL_SGPI_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SgpiMasterTableMap::COL_SGPI_ID.')');
        }


        // Set the correct dbName
        $query = SgpiMasterQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
