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
use entities\SgpiOutView;
use entities\SgpiOutViewQuery;


/**
 * This class defines the structure of the 'sgpi_out_view' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SgpiOutViewTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.SgpiOutViewTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'sgpi_out_view';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SgpiOutView';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\SgpiOutView';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.SgpiOutView';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 28;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 28;

    /**
     * the column name for the sgpi_voucher_id field
     */
    public const COL_SGPI_VOUCHER_ID = 'sgpi_out_view.sgpi_voucher_id';

    /**
     * the column name for the outlet_org_id field
     */
    public const COL_OUTLET_ORG_ID = 'sgpi_out_view.outlet_org_id';

    /**
     * the column name for the org_unit_id field
     */
    public const COL_ORG_UNIT_ID = 'sgpi_out_view.org_unit_id';

    /**
     * the column name for the territory_id field
     */
    public const COL_TERRITORY_ID = 'sgpi_out_view.territory_id';

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'sgpi_out_view.position_id';

    /**
     * the column name for the position_name field
     */
    public const COL_POSITION_NAME = 'sgpi_out_view.position_name';

    /**
     * the column name for the territory_name field
     */
    public const COL_TERRITORY_NAME = 'sgpi_out_view.territory_name';

    /**
     * the column name for the beat_id field
     */
    public const COL_BEAT_ID = 'sgpi_out_view.beat_id';

    /**
     * the column name for the beat_name field
     */
    public const COL_BEAT_NAME = 'sgpi_out_view.beat_name';

    /**
     * the column name for the tags field
     */
    public const COL_TAGS = 'sgpi_out_view.tags';

    /**
     * the column name for the visit_fq field
     */
    public const COL_VISIT_FQ = 'sgpi_out_view.visit_fq';

    /**
     * the column name for the outlet_salutation field
     */
    public const COL_OUTLET_SALUTATION = 'sgpi_out_view.outlet_salutation';

    /**
     * the column name for the outlet_name field
     */
    public const COL_OUTLET_NAME = 'sgpi_out_view.outlet_name';

    /**
     * the column name for the classification field
     */
    public const COL_CLASSIFICATION = 'sgpi_out_view.classification';

    /**
     * the column name for the outlettype_name field
     */
    public const COL_OUTLETTYPE_NAME = 'sgpi_out_view.outlettype_name';

    /**
     * the column name for the sgpi_name field
     */
    public const COL_SGPI_NAME = 'sgpi_out_view.sgpi_name';

    /**
     * the column name for the sgpi_code field
     */
    public const COL_SGPI_CODE = 'sgpi_out_view.sgpi_code';

    /**
     * the column name for the material_sku field
     */
    public const COL_MATERIAL_SKU = 'sgpi_out_view.material_sku';

    /**
     * the column name for the sgpi_type field
     */
    public const COL_SGPI_TYPE = 'sgpi_out_view.sgpi_type';

    /**
     * the column name for the sgpi_qty field
     */
    public const COL_SGPI_QTY = 'sgpi_out_view.sgpi_qty';

    /**
     * the column name for the dcr_id field
     */
    public const COL_DCR_ID = 'sgpi_out_view.dcr_id';

    /**
     * the column name for the dcr_date field
     */
    public const COL_DCR_DATE = 'sgpi_out_view.dcr_date';

    /**
     * the column name for the brands_detailed field
     */
    public const COL_BRANDS_DETAILED = 'sgpi_out_view.brands_detailed';

    /**
     * the column name for the device_time field
     */
    public const COL_DEVICE_TIME = 'sgpi_out_view.device_time';

    /**
     * the column name for the managers field
     */
    public const COL_MANAGERS = 'sgpi_out_view.managers';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'sgpi_out_view.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'sgpi_out_view.updated_at';

    /**
     * the column name for the brand_id field
     */
    public const COL_BRAND_ID = 'sgpi_out_view.brand_id';

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
        self::TYPE_PHPNAME       => ['SgpiVoucherId', 'Outlet_orgId', 'OrgUnitId', 'TerritoryId', 'PositionId', 'PositionName', 'TerritoryName', 'BeatId', 'BeatName', 'Tags', 'VisitFq', 'OutletSalutation', 'OutletName', 'Classification', 'OutlettypeName', 'SgpiName', 'SgpiCode', 'MaterialSku', 'SgpiType', 'SgpiQty', 'DcrId', 'DcrDate', 'BrandsDetailed', 'DeviceTime', 'Managers', 'CreatedAt', 'UpdatedAt', 'BrandId', ],
        self::TYPE_CAMELNAME     => ['sgpiVoucherId', 'outlet_orgId', 'orgUnitId', 'territoryId', 'positionId', 'positionName', 'territoryName', 'beatId', 'beatName', 'tags', 'visitFq', 'outletSalutation', 'outletName', 'classification', 'outlettypeName', 'sgpiName', 'sgpiCode', 'materialSku', 'sgpiType', 'sgpiQty', 'dcrId', 'dcrDate', 'brandsDetailed', 'deviceTime', 'managers', 'createdAt', 'updatedAt', 'brandId', ],
        self::TYPE_COLNAME       => [SgpiOutViewTableMap::COL_SGPI_VOUCHER_ID, SgpiOutViewTableMap::COL_OUTLET_ORG_ID, SgpiOutViewTableMap::COL_ORG_UNIT_ID, SgpiOutViewTableMap::COL_TERRITORY_ID, SgpiOutViewTableMap::COL_POSITION_ID, SgpiOutViewTableMap::COL_POSITION_NAME, SgpiOutViewTableMap::COL_TERRITORY_NAME, SgpiOutViewTableMap::COL_BEAT_ID, SgpiOutViewTableMap::COL_BEAT_NAME, SgpiOutViewTableMap::COL_TAGS, SgpiOutViewTableMap::COL_VISIT_FQ, SgpiOutViewTableMap::COL_OUTLET_SALUTATION, SgpiOutViewTableMap::COL_OUTLET_NAME, SgpiOutViewTableMap::COL_CLASSIFICATION, SgpiOutViewTableMap::COL_OUTLETTYPE_NAME, SgpiOutViewTableMap::COL_SGPI_NAME, SgpiOutViewTableMap::COL_SGPI_CODE, SgpiOutViewTableMap::COL_MATERIAL_SKU, SgpiOutViewTableMap::COL_SGPI_TYPE, SgpiOutViewTableMap::COL_SGPI_QTY, SgpiOutViewTableMap::COL_DCR_ID, SgpiOutViewTableMap::COL_DCR_DATE, SgpiOutViewTableMap::COL_BRANDS_DETAILED, SgpiOutViewTableMap::COL_DEVICE_TIME, SgpiOutViewTableMap::COL_MANAGERS, SgpiOutViewTableMap::COL_CREATED_AT, SgpiOutViewTableMap::COL_UPDATED_AT, SgpiOutViewTableMap::COL_BRAND_ID, ],
        self::TYPE_FIELDNAME     => ['sgpi_voucher_id', 'outlet_org_id', 'org_unit_id', 'territory_id', 'position_id', 'position_name', 'territory_name', 'beat_id', 'beat_name', 'tags', 'visit_fq', 'outlet_salutation', 'outlet_name', 'classification', 'outlettype_name', 'sgpi_name', 'sgpi_code', 'material_sku', 'sgpi_type', 'sgpi_qty', 'dcr_id', 'dcr_date', 'brands_detailed', 'device_time', 'managers', 'created_at', 'updated_at', 'brand_id', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, ]
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
        self::TYPE_PHPNAME       => ['SgpiVoucherId' => 0, 'Outlet_orgId' => 1, 'OrgUnitId' => 2, 'TerritoryId' => 3, 'PositionId' => 4, 'PositionName' => 5, 'TerritoryName' => 6, 'BeatId' => 7, 'BeatName' => 8, 'Tags' => 9, 'VisitFq' => 10, 'OutletSalutation' => 11, 'OutletName' => 12, 'Classification' => 13, 'OutlettypeName' => 14, 'SgpiName' => 15, 'SgpiCode' => 16, 'MaterialSku' => 17, 'SgpiType' => 18, 'SgpiQty' => 19, 'DcrId' => 20, 'DcrDate' => 21, 'BrandsDetailed' => 22, 'DeviceTime' => 23, 'Managers' => 24, 'CreatedAt' => 25, 'UpdatedAt' => 26, 'BrandId' => 27, ],
        self::TYPE_CAMELNAME     => ['sgpiVoucherId' => 0, 'outlet_orgId' => 1, 'orgUnitId' => 2, 'territoryId' => 3, 'positionId' => 4, 'positionName' => 5, 'territoryName' => 6, 'beatId' => 7, 'beatName' => 8, 'tags' => 9, 'visitFq' => 10, 'outletSalutation' => 11, 'outletName' => 12, 'classification' => 13, 'outlettypeName' => 14, 'sgpiName' => 15, 'sgpiCode' => 16, 'materialSku' => 17, 'sgpiType' => 18, 'sgpiQty' => 19, 'dcrId' => 20, 'dcrDate' => 21, 'brandsDetailed' => 22, 'deviceTime' => 23, 'managers' => 24, 'createdAt' => 25, 'updatedAt' => 26, 'brandId' => 27, ],
        self::TYPE_COLNAME       => [SgpiOutViewTableMap::COL_SGPI_VOUCHER_ID => 0, SgpiOutViewTableMap::COL_OUTLET_ORG_ID => 1, SgpiOutViewTableMap::COL_ORG_UNIT_ID => 2, SgpiOutViewTableMap::COL_TERRITORY_ID => 3, SgpiOutViewTableMap::COL_POSITION_ID => 4, SgpiOutViewTableMap::COL_POSITION_NAME => 5, SgpiOutViewTableMap::COL_TERRITORY_NAME => 6, SgpiOutViewTableMap::COL_BEAT_ID => 7, SgpiOutViewTableMap::COL_BEAT_NAME => 8, SgpiOutViewTableMap::COL_TAGS => 9, SgpiOutViewTableMap::COL_VISIT_FQ => 10, SgpiOutViewTableMap::COL_OUTLET_SALUTATION => 11, SgpiOutViewTableMap::COL_OUTLET_NAME => 12, SgpiOutViewTableMap::COL_CLASSIFICATION => 13, SgpiOutViewTableMap::COL_OUTLETTYPE_NAME => 14, SgpiOutViewTableMap::COL_SGPI_NAME => 15, SgpiOutViewTableMap::COL_SGPI_CODE => 16, SgpiOutViewTableMap::COL_MATERIAL_SKU => 17, SgpiOutViewTableMap::COL_SGPI_TYPE => 18, SgpiOutViewTableMap::COL_SGPI_QTY => 19, SgpiOutViewTableMap::COL_DCR_ID => 20, SgpiOutViewTableMap::COL_DCR_DATE => 21, SgpiOutViewTableMap::COL_BRANDS_DETAILED => 22, SgpiOutViewTableMap::COL_DEVICE_TIME => 23, SgpiOutViewTableMap::COL_MANAGERS => 24, SgpiOutViewTableMap::COL_CREATED_AT => 25, SgpiOutViewTableMap::COL_UPDATED_AT => 26, SgpiOutViewTableMap::COL_BRAND_ID => 27, ],
        self::TYPE_FIELDNAME     => ['sgpi_voucher_id' => 0, 'outlet_org_id' => 1, 'org_unit_id' => 2, 'territory_id' => 3, 'position_id' => 4, 'position_name' => 5, 'territory_name' => 6, 'beat_id' => 7, 'beat_name' => 8, 'tags' => 9, 'visit_fq' => 10, 'outlet_salutation' => 11, 'outlet_name' => 12, 'classification' => 13, 'outlettype_name' => 14, 'sgpi_name' => 15, 'sgpi_code' => 16, 'material_sku' => 17, 'sgpi_type' => 18, 'sgpi_qty' => 19, 'dcr_id' => 20, 'dcr_date' => 21, 'brands_detailed' => 22, 'device_time' => 23, 'managers' => 24, 'created_at' => 25, 'updated_at' => 26, 'brand_id' => 27, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'SgpiVoucherId' => 'SGPI_VOUCHER_ID',
        'SgpiOutView.SgpiVoucherId' => 'SGPI_VOUCHER_ID',
        'sgpiVoucherId' => 'SGPI_VOUCHER_ID',
        'sgpiOutView.sgpiVoucherId' => 'SGPI_VOUCHER_ID',
        'SgpiOutViewTableMap::COL_SGPI_VOUCHER_ID' => 'SGPI_VOUCHER_ID',
        'COL_SGPI_VOUCHER_ID' => 'SGPI_VOUCHER_ID',
        'sgpi_voucher_id' => 'SGPI_VOUCHER_ID',
        'sgpi_out_view.sgpi_voucher_id' => 'SGPI_VOUCHER_ID',
        'Outlet_orgId' => 'OUTLET_ORG_ID',
        'SgpiOutView.Outlet_orgId' => 'OUTLET_ORG_ID',
        'outlet_orgId' => 'OUTLET_ORG_ID',
        'sgpiOutView.outlet_orgId' => 'OUTLET_ORG_ID',
        'SgpiOutViewTableMap::COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'outlet_org_id' => 'OUTLET_ORG_ID',
        'sgpi_out_view.outlet_org_id' => 'OUTLET_ORG_ID',
        'OrgUnitId' => 'ORG_UNIT_ID',
        'SgpiOutView.OrgUnitId' => 'ORG_UNIT_ID',
        'orgUnitId' => 'ORG_UNIT_ID',
        'sgpiOutView.orgUnitId' => 'ORG_UNIT_ID',
        'SgpiOutViewTableMap::COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'org_unit_id' => 'ORG_UNIT_ID',
        'sgpi_out_view.org_unit_id' => 'ORG_UNIT_ID',
        'TerritoryId' => 'TERRITORY_ID',
        'SgpiOutView.TerritoryId' => 'TERRITORY_ID',
        'territoryId' => 'TERRITORY_ID',
        'sgpiOutView.territoryId' => 'TERRITORY_ID',
        'SgpiOutViewTableMap::COL_TERRITORY_ID' => 'TERRITORY_ID',
        'COL_TERRITORY_ID' => 'TERRITORY_ID',
        'territory_id' => 'TERRITORY_ID',
        'sgpi_out_view.territory_id' => 'TERRITORY_ID',
        'PositionId' => 'POSITION_ID',
        'SgpiOutView.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'sgpiOutView.positionId' => 'POSITION_ID',
        'SgpiOutViewTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'sgpi_out_view.position_id' => 'POSITION_ID',
        'PositionName' => 'POSITION_NAME',
        'SgpiOutView.PositionName' => 'POSITION_NAME',
        'positionName' => 'POSITION_NAME',
        'sgpiOutView.positionName' => 'POSITION_NAME',
        'SgpiOutViewTableMap::COL_POSITION_NAME' => 'POSITION_NAME',
        'COL_POSITION_NAME' => 'POSITION_NAME',
        'position_name' => 'POSITION_NAME',
        'sgpi_out_view.position_name' => 'POSITION_NAME',
        'TerritoryName' => 'TERRITORY_NAME',
        'SgpiOutView.TerritoryName' => 'TERRITORY_NAME',
        'territoryName' => 'TERRITORY_NAME',
        'sgpiOutView.territoryName' => 'TERRITORY_NAME',
        'SgpiOutViewTableMap::COL_TERRITORY_NAME' => 'TERRITORY_NAME',
        'COL_TERRITORY_NAME' => 'TERRITORY_NAME',
        'territory_name' => 'TERRITORY_NAME',
        'sgpi_out_view.territory_name' => 'TERRITORY_NAME',
        'BeatId' => 'BEAT_ID',
        'SgpiOutView.BeatId' => 'BEAT_ID',
        'beatId' => 'BEAT_ID',
        'sgpiOutView.beatId' => 'BEAT_ID',
        'SgpiOutViewTableMap::COL_BEAT_ID' => 'BEAT_ID',
        'COL_BEAT_ID' => 'BEAT_ID',
        'beat_id' => 'BEAT_ID',
        'sgpi_out_view.beat_id' => 'BEAT_ID',
        'BeatName' => 'BEAT_NAME',
        'SgpiOutView.BeatName' => 'BEAT_NAME',
        'beatName' => 'BEAT_NAME',
        'sgpiOutView.beatName' => 'BEAT_NAME',
        'SgpiOutViewTableMap::COL_BEAT_NAME' => 'BEAT_NAME',
        'COL_BEAT_NAME' => 'BEAT_NAME',
        'beat_name' => 'BEAT_NAME',
        'sgpi_out_view.beat_name' => 'BEAT_NAME',
        'Tags' => 'TAGS',
        'SgpiOutView.Tags' => 'TAGS',
        'tags' => 'TAGS',
        'sgpiOutView.tags' => 'TAGS',
        'SgpiOutViewTableMap::COL_TAGS' => 'TAGS',
        'COL_TAGS' => 'TAGS',
        'sgpi_out_view.tags' => 'TAGS',
        'VisitFq' => 'VISIT_FQ',
        'SgpiOutView.VisitFq' => 'VISIT_FQ',
        'visitFq' => 'VISIT_FQ',
        'sgpiOutView.visitFq' => 'VISIT_FQ',
        'SgpiOutViewTableMap::COL_VISIT_FQ' => 'VISIT_FQ',
        'COL_VISIT_FQ' => 'VISIT_FQ',
        'visit_fq' => 'VISIT_FQ',
        'sgpi_out_view.visit_fq' => 'VISIT_FQ',
        'OutletSalutation' => 'OUTLET_SALUTATION',
        'SgpiOutView.OutletSalutation' => 'OUTLET_SALUTATION',
        'outletSalutation' => 'OUTLET_SALUTATION',
        'sgpiOutView.outletSalutation' => 'OUTLET_SALUTATION',
        'SgpiOutViewTableMap::COL_OUTLET_SALUTATION' => 'OUTLET_SALUTATION',
        'COL_OUTLET_SALUTATION' => 'OUTLET_SALUTATION',
        'outlet_salutation' => 'OUTLET_SALUTATION',
        'sgpi_out_view.outlet_salutation' => 'OUTLET_SALUTATION',
        'OutletName' => 'OUTLET_NAME',
        'SgpiOutView.OutletName' => 'OUTLET_NAME',
        'outletName' => 'OUTLET_NAME',
        'sgpiOutView.outletName' => 'OUTLET_NAME',
        'SgpiOutViewTableMap::COL_OUTLET_NAME' => 'OUTLET_NAME',
        'COL_OUTLET_NAME' => 'OUTLET_NAME',
        'outlet_name' => 'OUTLET_NAME',
        'sgpi_out_view.outlet_name' => 'OUTLET_NAME',
        'Classification' => 'CLASSIFICATION',
        'SgpiOutView.Classification' => 'CLASSIFICATION',
        'classification' => 'CLASSIFICATION',
        'sgpiOutView.classification' => 'CLASSIFICATION',
        'SgpiOutViewTableMap::COL_CLASSIFICATION' => 'CLASSIFICATION',
        'COL_CLASSIFICATION' => 'CLASSIFICATION',
        'sgpi_out_view.classification' => 'CLASSIFICATION',
        'OutlettypeName' => 'OUTLETTYPE_NAME',
        'SgpiOutView.OutlettypeName' => 'OUTLETTYPE_NAME',
        'outlettypeName' => 'OUTLETTYPE_NAME',
        'sgpiOutView.outlettypeName' => 'OUTLETTYPE_NAME',
        'SgpiOutViewTableMap::COL_OUTLETTYPE_NAME' => 'OUTLETTYPE_NAME',
        'COL_OUTLETTYPE_NAME' => 'OUTLETTYPE_NAME',
        'outlettype_name' => 'OUTLETTYPE_NAME',
        'sgpi_out_view.outlettype_name' => 'OUTLETTYPE_NAME',
        'SgpiName' => 'SGPI_NAME',
        'SgpiOutView.SgpiName' => 'SGPI_NAME',
        'sgpiName' => 'SGPI_NAME',
        'sgpiOutView.sgpiName' => 'SGPI_NAME',
        'SgpiOutViewTableMap::COL_SGPI_NAME' => 'SGPI_NAME',
        'COL_SGPI_NAME' => 'SGPI_NAME',
        'sgpi_name' => 'SGPI_NAME',
        'sgpi_out_view.sgpi_name' => 'SGPI_NAME',
        'SgpiCode' => 'SGPI_CODE',
        'SgpiOutView.SgpiCode' => 'SGPI_CODE',
        'sgpiCode' => 'SGPI_CODE',
        'sgpiOutView.sgpiCode' => 'SGPI_CODE',
        'SgpiOutViewTableMap::COL_SGPI_CODE' => 'SGPI_CODE',
        'COL_SGPI_CODE' => 'SGPI_CODE',
        'sgpi_code' => 'SGPI_CODE',
        'sgpi_out_view.sgpi_code' => 'SGPI_CODE',
        'MaterialSku' => 'MATERIAL_SKU',
        'SgpiOutView.MaterialSku' => 'MATERIAL_SKU',
        'materialSku' => 'MATERIAL_SKU',
        'sgpiOutView.materialSku' => 'MATERIAL_SKU',
        'SgpiOutViewTableMap::COL_MATERIAL_SKU' => 'MATERIAL_SKU',
        'COL_MATERIAL_SKU' => 'MATERIAL_SKU',
        'material_sku' => 'MATERIAL_SKU',
        'sgpi_out_view.material_sku' => 'MATERIAL_SKU',
        'SgpiType' => 'SGPI_TYPE',
        'SgpiOutView.SgpiType' => 'SGPI_TYPE',
        'sgpiType' => 'SGPI_TYPE',
        'sgpiOutView.sgpiType' => 'SGPI_TYPE',
        'SgpiOutViewTableMap::COL_SGPI_TYPE' => 'SGPI_TYPE',
        'COL_SGPI_TYPE' => 'SGPI_TYPE',
        'sgpi_type' => 'SGPI_TYPE',
        'sgpi_out_view.sgpi_type' => 'SGPI_TYPE',
        'SgpiQty' => 'SGPI_QTY',
        'SgpiOutView.SgpiQty' => 'SGPI_QTY',
        'sgpiQty' => 'SGPI_QTY',
        'sgpiOutView.sgpiQty' => 'SGPI_QTY',
        'SgpiOutViewTableMap::COL_SGPI_QTY' => 'SGPI_QTY',
        'COL_SGPI_QTY' => 'SGPI_QTY',
        'sgpi_qty' => 'SGPI_QTY',
        'sgpi_out_view.sgpi_qty' => 'SGPI_QTY',
        'DcrId' => 'DCR_ID',
        'SgpiOutView.DcrId' => 'DCR_ID',
        'dcrId' => 'DCR_ID',
        'sgpiOutView.dcrId' => 'DCR_ID',
        'SgpiOutViewTableMap::COL_DCR_ID' => 'DCR_ID',
        'COL_DCR_ID' => 'DCR_ID',
        'dcr_id' => 'DCR_ID',
        'sgpi_out_view.dcr_id' => 'DCR_ID',
        'DcrDate' => 'DCR_DATE',
        'SgpiOutView.DcrDate' => 'DCR_DATE',
        'dcrDate' => 'DCR_DATE',
        'sgpiOutView.dcrDate' => 'DCR_DATE',
        'SgpiOutViewTableMap::COL_DCR_DATE' => 'DCR_DATE',
        'COL_DCR_DATE' => 'DCR_DATE',
        'dcr_date' => 'DCR_DATE',
        'sgpi_out_view.dcr_date' => 'DCR_DATE',
        'BrandsDetailed' => 'BRANDS_DETAILED',
        'SgpiOutView.BrandsDetailed' => 'BRANDS_DETAILED',
        'brandsDetailed' => 'BRANDS_DETAILED',
        'sgpiOutView.brandsDetailed' => 'BRANDS_DETAILED',
        'SgpiOutViewTableMap::COL_BRANDS_DETAILED' => 'BRANDS_DETAILED',
        'COL_BRANDS_DETAILED' => 'BRANDS_DETAILED',
        'brands_detailed' => 'BRANDS_DETAILED',
        'sgpi_out_view.brands_detailed' => 'BRANDS_DETAILED',
        'DeviceTime' => 'DEVICE_TIME',
        'SgpiOutView.DeviceTime' => 'DEVICE_TIME',
        'deviceTime' => 'DEVICE_TIME',
        'sgpiOutView.deviceTime' => 'DEVICE_TIME',
        'SgpiOutViewTableMap::COL_DEVICE_TIME' => 'DEVICE_TIME',
        'COL_DEVICE_TIME' => 'DEVICE_TIME',
        'device_time' => 'DEVICE_TIME',
        'sgpi_out_view.device_time' => 'DEVICE_TIME',
        'Managers' => 'MANAGERS',
        'SgpiOutView.Managers' => 'MANAGERS',
        'managers' => 'MANAGERS',
        'sgpiOutView.managers' => 'MANAGERS',
        'SgpiOutViewTableMap::COL_MANAGERS' => 'MANAGERS',
        'COL_MANAGERS' => 'MANAGERS',
        'sgpi_out_view.managers' => 'MANAGERS',
        'CreatedAt' => 'CREATED_AT',
        'SgpiOutView.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'sgpiOutView.createdAt' => 'CREATED_AT',
        'SgpiOutViewTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'sgpi_out_view.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SgpiOutView.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'sgpiOutView.updatedAt' => 'UPDATED_AT',
        'SgpiOutViewTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'sgpi_out_view.updated_at' => 'UPDATED_AT',
        'BrandId' => 'BRAND_ID',
        'SgpiOutView.BrandId' => 'BRAND_ID',
        'brandId' => 'BRAND_ID',
        'sgpiOutView.brandId' => 'BRAND_ID',
        'SgpiOutViewTableMap::COL_BRAND_ID' => 'BRAND_ID',
        'COL_BRAND_ID' => 'BRAND_ID',
        'brand_id' => 'BRAND_ID',
        'sgpi_out_view.brand_id' => 'BRAND_ID',
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
        $this->setName('sgpi_out_view');
        $this->setPhpName('SgpiOutView');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\SgpiOutView');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('sgpi_voucher_id', 'SgpiVoucherId', 'INTEGER', true, null, null);
        $this->addColumn('outlet_org_id', 'Outlet_orgId', 'INTEGER', false, null, null);
        $this->addColumn('org_unit_id', 'OrgUnitId', 'INTEGER', false, null, null);
        $this->addColumn('territory_id', 'TerritoryId', 'INTEGER', false, null, null);
        $this->addColumn('position_id', 'PositionId', 'INTEGER', false, null, null);
        $this->addColumn('position_name', 'PositionName', 'VARCHAR', false, 50, null);
        $this->addColumn('territory_name', 'TerritoryName', 'VARCHAR', false, 50, null);
        $this->addColumn('beat_id', 'BeatId', 'INTEGER', false, null, null);
        $this->addColumn('beat_name', 'BeatName', 'VARCHAR', false, 50, null);
        $this->addColumn('tags', 'Tags', 'VARCHAR', false, 50, null);
        $this->addColumn('visit_fq', 'VisitFq', 'INTEGER', false, null, null);
        $this->addColumn('outlet_salutation', 'OutletSalutation', 'VARCHAR', false, 50, null);
        $this->addColumn('outlet_name', 'OutletName', 'VARCHAR', false, 50, null);
        $this->addColumn('classification', 'Classification', 'VARCHAR', false, 50, null);
        $this->addColumn('outlettype_name', 'OutlettypeName', 'VARCHAR', false, 50, null);
        $this->addColumn('sgpi_name', 'SgpiName', 'VARCHAR', false, 50, null);
        $this->addColumn('sgpi_code', 'SgpiCode', 'VARCHAR', false, 50, null);
        $this->addColumn('material_sku', 'MaterialSku', 'VARCHAR', false, 50, null);
        $this->addColumn('sgpi_type', 'SgpiType', 'VARCHAR', false, 50, null);
        $this->addColumn('sgpi_qty', 'SgpiQty', 'INTEGER', false, null, null);
        $this->addColumn('dcr_id', 'DcrId', 'INTEGER', false, null, null);
        $this->addColumn('dcr_date', 'DcrDate', 'DATE', false, null, null);
        $this->addColumn('brands_detailed', 'BrandsDetailed', 'VARCHAR', false, 50, null);
        $this->addColumn('device_time', 'DeviceTime', 'VARCHAR', false, 50, null);
        $this->addColumn('managers', 'Managers', 'VARCHAR', false, 50, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('brand_id', 'BrandId', 'INTEGER', false, null, null);
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
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiVoucherId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiVoucherId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiVoucherId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiVoucherId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiVoucherId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SgpiVoucherId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('SgpiVoucherId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SgpiOutViewTableMap::CLASS_DEFAULT : SgpiOutViewTableMap::OM_CLASS;
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
     * @return array (SgpiOutView object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SgpiOutViewTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SgpiOutViewTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SgpiOutViewTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SgpiOutViewTableMap::OM_CLASS;
            /** @var SgpiOutView $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SgpiOutViewTableMap::addInstanceToPool($obj, $key);
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
            $key = SgpiOutViewTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SgpiOutViewTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SgpiOutView $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SgpiOutViewTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_SGPI_VOUCHER_ID);
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_OUTLET_ORG_ID);
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_ORG_UNIT_ID);
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_TERRITORY_ID);
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_POSITION_NAME);
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_TERRITORY_NAME);
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_BEAT_ID);
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_BEAT_NAME);
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_TAGS);
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_VISIT_FQ);
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_OUTLET_SALUTATION);
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_OUTLET_NAME);
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_CLASSIFICATION);
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_OUTLETTYPE_NAME);
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_SGPI_NAME);
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_SGPI_CODE);
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_MATERIAL_SKU);
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_SGPI_TYPE);
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_SGPI_QTY);
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_DCR_ID);
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_DCR_DATE);
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_BRANDS_DETAILED);
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_DEVICE_TIME);
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_MANAGERS);
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(SgpiOutViewTableMap::COL_BRAND_ID);
        } else {
            $criteria->addSelectColumn($alias . '.sgpi_voucher_id');
            $criteria->addSelectColumn($alias . '.outlet_org_id');
            $criteria->addSelectColumn($alias . '.org_unit_id');
            $criteria->addSelectColumn($alias . '.territory_id');
            $criteria->addSelectColumn($alias . '.position_id');
            $criteria->addSelectColumn($alias . '.position_name');
            $criteria->addSelectColumn($alias . '.territory_name');
            $criteria->addSelectColumn($alias . '.beat_id');
            $criteria->addSelectColumn($alias . '.beat_name');
            $criteria->addSelectColumn($alias . '.tags');
            $criteria->addSelectColumn($alias . '.visit_fq');
            $criteria->addSelectColumn($alias . '.outlet_salutation');
            $criteria->addSelectColumn($alias . '.outlet_name');
            $criteria->addSelectColumn($alias . '.classification');
            $criteria->addSelectColumn($alias . '.outlettype_name');
            $criteria->addSelectColumn($alias . '.sgpi_name');
            $criteria->addSelectColumn($alias . '.sgpi_code');
            $criteria->addSelectColumn($alias . '.material_sku');
            $criteria->addSelectColumn($alias . '.sgpi_type');
            $criteria->addSelectColumn($alias . '.sgpi_qty');
            $criteria->addSelectColumn($alias . '.dcr_id');
            $criteria->addSelectColumn($alias . '.dcr_date');
            $criteria->addSelectColumn($alias . '.brands_detailed');
            $criteria->addSelectColumn($alias . '.device_time');
            $criteria->addSelectColumn($alias . '.managers');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.brand_id');
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
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_SGPI_VOUCHER_ID);
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_OUTLET_ORG_ID);
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_ORG_UNIT_ID);
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_TERRITORY_ID);
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_POSITION_NAME);
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_TERRITORY_NAME);
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_BEAT_ID);
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_BEAT_NAME);
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_TAGS);
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_VISIT_FQ);
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_OUTLET_SALUTATION);
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_OUTLET_NAME);
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_CLASSIFICATION);
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_OUTLETTYPE_NAME);
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_SGPI_NAME);
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_SGPI_CODE);
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_MATERIAL_SKU);
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_SGPI_TYPE);
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_SGPI_QTY);
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_DCR_ID);
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_DCR_DATE);
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_BRANDS_DETAILED);
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_DEVICE_TIME);
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_MANAGERS);
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(SgpiOutViewTableMap::COL_BRAND_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.sgpi_voucher_id');
            $criteria->removeSelectColumn($alias . '.outlet_org_id');
            $criteria->removeSelectColumn($alias . '.org_unit_id');
            $criteria->removeSelectColumn($alias . '.territory_id');
            $criteria->removeSelectColumn($alias . '.position_id');
            $criteria->removeSelectColumn($alias . '.position_name');
            $criteria->removeSelectColumn($alias . '.territory_name');
            $criteria->removeSelectColumn($alias . '.beat_id');
            $criteria->removeSelectColumn($alias . '.beat_name');
            $criteria->removeSelectColumn($alias . '.tags');
            $criteria->removeSelectColumn($alias . '.visit_fq');
            $criteria->removeSelectColumn($alias . '.outlet_salutation');
            $criteria->removeSelectColumn($alias . '.outlet_name');
            $criteria->removeSelectColumn($alias . '.classification');
            $criteria->removeSelectColumn($alias . '.outlettype_name');
            $criteria->removeSelectColumn($alias . '.sgpi_name');
            $criteria->removeSelectColumn($alias . '.sgpi_code');
            $criteria->removeSelectColumn($alias . '.material_sku');
            $criteria->removeSelectColumn($alias . '.sgpi_type');
            $criteria->removeSelectColumn($alias . '.sgpi_qty');
            $criteria->removeSelectColumn($alias . '.dcr_id');
            $criteria->removeSelectColumn($alias . '.dcr_date');
            $criteria->removeSelectColumn($alias . '.brands_detailed');
            $criteria->removeSelectColumn($alias . '.device_time');
            $criteria->removeSelectColumn($alias . '.managers');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.brand_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(SgpiOutViewTableMap::DATABASE_NAME)->getTable(SgpiOutViewTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SgpiOutView or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SgpiOutView object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SgpiOutViewTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\SgpiOutView) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SgpiOutViewTableMap::DATABASE_NAME);
            $criteria->add(SgpiOutViewTableMap::COL_SGPI_VOUCHER_ID, (array) $values, Criteria::IN);
        }

        $query = SgpiOutViewQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SgpiOutViewTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SgpiOutViewTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sgpi_out_view table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SgpiOutViewQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SgpiOutView or Criteria object.
     *
     * @param mixed $criteria Criteria or SgpiOutView object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SgpiOutViewTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SgpiOutView object
        }


        // Set the correct dbName
        $query = SgpiOutViewQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
