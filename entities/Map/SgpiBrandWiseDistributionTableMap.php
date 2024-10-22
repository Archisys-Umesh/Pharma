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
use entities\SgpiBrandWiseDistribution;
use entities\SgpiBrandWiseDistributionQuery;


/**
 * This class defines the structure of the 'sgpi_brand_wise_distribution' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SgpiBrandWiseDistributionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.SgpiBrandWiseDistributionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'sgpi_brand_wise_distribution';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SgpiBrandWiseDistribution';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\SgpiBrandWiseDistribution';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.SgpiBrandWiseDistribution';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 26;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 26;

    /**
     * the column name for the sgpimap_id field
     */
    public const COL_SGPIMAP_ID = 'sgpi_brand_wise_distribution.sgpimap_id';

    /**
     * the column name for the org_data_id field
     */
    public const COL_ORG_DATA_ID = 'sgpi_brand_wise_distribution.org_data_id';

    /**
     * the column name for the brand_id field
     */
    public const COL_BRAND_ID = 'sgpi_brand_wise_distribution.brand_id';

    /**
     * the column name for the sgpi_status field
     */
    public const COL_SGPI_STATUS = 'sgpi_brand_wise_distribution.sgpi_status';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'sgpi_brand_wise_distribution.company_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'sgpi_brand_wise_distribution.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'sgpi_brand_wise_distribution.updated_at';

    /**
     * the column name for the territory_id field
     */
    public const COL_TERRITORY_ID = 'sgpi_brand_wise_distribution.territory_id';

    /**
     * the column name for the territory_name field
     */
    public const COL_TERRITORY_NAME = 'sgpi_brand_wise_distribution.territory_name';

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'sgpi_brand_wise_distribution.position_id';

    /**
     * the column name for the position_name field
     */
    public const COL_POSITION_NAME = 'sgpi_brand_wise_distribution.position_name';

    /**
     * the column name for the beat_id field
     */
    public const COL_BEAT_ID = 'sgpi_brand_wise_distribution.beat_id';

    /**
     * the column name for the beat_name field
     */
    public const COL_BEAT_NAME = 'sgpi_brand_wise_distribution.beat_name';

    /**
     * the column name for the tags field
     */
    public const COL_TAGS = 'sgpi_brand_wise_distribution.tags';

    /**
     * the column name for the org_potential field
     */
    public const COL_ORG_POTENTIAL = 'sgpi_brand_wise_distribution.org_potential';

    /**
     * the column name for the brand_focus field
     */
    public const COL_BRAND_FOCUS = 'sgpi_brand_wise_distribution.brand_focus';

    /**
     * the column name for the customer_fq field
     */
    public const COL_CUSTOMER_FQ = 'sgpi_brand_wise_distribution.customer_fq';

    /**
     * the column name for the id field
     */
    public const COL_ID = 'sgpi_brand_wise_distribution.id';

    /**
     * the column name for the outlet_name field
     */
    public const COL_OUTLET_NAME = 'sgpi_brand_wise_distribution.outlet_name';

    /**
     * the column name for the outlet_code field
     */
    public const COL_OUTLET_CODE = 'sgpi_brand_wise_distribution.outlet_code';

    /**
     * the column name for the outlettype_id field
     */
    public const COL_OUTLETTYPE_ID = 'sgpi_brand_wise_distribution.outlettype_id';

    /**
     * the column name for the outlettype_name field
     */
    public const COL_OUTLETTYPE_NAME = 'sgpi_brand_wise_distribution.outlettype_name';

    /**
     * the column name for the itownid field
     */
    public const COL_ITOWNID = 'sgpi_brand_wise_distribution.itownid';

    /**
     * the column name for the outlet_city field
     */
    public const COL_OUTLET_CITY = 'sgpi_brand_wise_distribution.outlet_city';

    /**
     * the column name for the classification field
     */
    public const COL_CLASSIFICATION = 'sgpi_brand_wise_distribution.classification';

    /**
     * the column name for the brand_name field
     */
    public const COL_BRAND_NAME = 'sgpi_brand_wise_distribution.brand_name';

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
        self::TYPE_PHPNAME       => ['SgpiVoucherId', 'OrgDataId', 'BrandId', 'SgpiStatus', 'CompanyId', 'CreatedAt', 'UpdatedAt', 'TerritoryId', 'TerritoryName', 'PositionId', 'PositionName', 'BeatId', 'BeatName', 'Tags', 'OrgPotential', 'BrandFocus', 'CustomerFq', 'OutletId', 'OutletName', 'OutletCode', 'OutlettypeId', 'OutlettypeName', 'Itownid', 'OutletCity', 'Classification', 'BrandName', ],
        self::TYPE_CAMELNAME     => ['sgpiVoucherId', 'orgDataId', 'brandId', 'sgpiStatus', 'companyId', 'createdAt', 'updatedAt', 'territoryId', 'territoryName', 'positionId', 'positionName', 'beatId', 'beatName', 'tags', 'orgPotential', 'brandFocus', 'customerFq', 'outletId', 'outletName', 'outletCode', 'outlettypeId', 'outlettypeName', 'itownid', 'outletCity', 'classification', 'brandName', ],
        self::TYPE_COLNAME       => [SgpiBrandWiseDistributionTableMap::COL_SGPIMAP_ID, SgpiBrandWiseDistributionTableMap::COL_ORG_DATA_ID, SgpiBrandWiseDistributionTableMap::COL_BRAND_ID, SgpiBrandWiseDistributionTableMap::COL_SGPI_STATUS, SgpiBrandWiseDistributionTableMap::COL_COMPANY_ID, SgpiBrandWiseDistributionTableMap::COL_CREATED_AT, SgpiBrandWiseDistributionTableMap::COL_UPDATED_AT, SgpiBrandWiseDistributionTableMap::COL_TERRITORY_ID, SgpiBrandWiseDistributionTableMap::COL_TERRITORY_NAME, SgpiBrandWiseDistributionTableMap::COL_POSITION_ID, SgpiBrandWiseDistributionTableMap::COL_POSITION_NAME, SgpiBrandWiseDistributionTableMap::COL_BEAT_ID, SgpiBrandWiseDistributionTableMap::COL_BEAT_NAME, SgpiBrandWiseDistributionTableMap::COL_TAGS, SgpiBrandWiseDistributionTableMap::COL_ORG_POTENTIAL, SgpiBrandWiseDistributionTableMap::COL_BRAND_FOCUS, SgpiBrandWiseDistributionTableMap::COL_CUSTOMER_FQ, SgpiBrandWiseDistributionTableMap::COL_ID, SgpiBrandWiseDistributionTableMap::COL_OUTLET_NAME, SgpiBrandWiseDistributionTableMap::COL_OUTLET_CODE, SgpiBrandWiseDistributionTableMap::COL_OUTLETTYPE_ID, SgpiBrandWiseDistributionTableMap::COL_OUTLETTYPE_NAME, SgpiBrandWiseDistributionTableMap::COL_ITOWNID, SgpiBrandWiseDistributionTableMap::COL_OUTLET_CITY, SgpiBrandWiseDistributionTableMap::COL_CLASSIFICATION, SgpiBrandWiseDistributionTableMap::COL_BRAND_NAME, ],
        self::TYPE_FIELDNAME     => ['sgpimap_id', 'org_data_id', 'brand_id', 'sgpi_status', 'company_id', 'created_at', 'updated_at', 'territory_id', 'territory_name', 'position_id', 'position_name', 'beat_id', 'beat_name', 'tags', 'org_potential', 'brand_focus', 'customer_fq', 'id', 'outlet_name', 'outlet_code', 'outlettype_id', 'outlettype_name', 'itownid', 'outlet_city', 'classification', 'brand_name', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, ]
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
        self::TYPE_PHPNAME       => ['SgpiVoucherId' => 0, 'OrgDataId' => 1, 'BrandId' => 2, 'SgpiStatus' => 3, 'CompanyId' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, 'TerritoryId' => 7, 'TerritoryName' => 8, 'PositionId' => 9, 'PositionName' => 10, 'BeatId' => 11, 'BeatName' => 12, 'Tags' => 13, 'OrgPotential' => 14, 'BrandFocus' => 15, 'CustomerFq' => 16, 'OutletId' => 17, 'OutletName' => 18, 'OutletCode' => 19, 'OutlettypeId' => 20, 'OutlettypeName' => 21, 'Itownid' => 22, 'OutletCity' => 23, 'Classification' => 24, 'BrandName' => 25, ],
        self::TYPE_CAMELNAME     => ['sgpiVoucherId' => 0, 'orgDataId' => 1, 'brandId' => 2, 'sgpiStatus' => 3, 'companyId' => 4, 'createdAt' => 5, 'updatedAt' => 6, 'territoryId' => 7, 'territoryName' => 8, 'positionId' => 9, 'positionName' => 10, 'beatId' => 11, 'beatName' => 12, 'tags' => 13, 'orgPotential' => 14, 'brandFocus' => 15, 'customerFq' => 16, 'outletId' => 17, 'outletName' => 18, 'outletCode' => 19, 'outlettypeId' => 20, 'outlettypeName' => 21, 'itownid' => 22, 'outletCity' => 23, 'classification' => 24, 'brandName' => 25, ],
        self::TYPE_COLNAME       => [SgpiBrandWiseDistributionTableMap::COL_SGPIMAP_ID => 0, SgpiBrandWiseDistributionTableMap::COL_ORG_DATA_ID => 1, SgpiBrandWiseDistributionTableMap::COL_BRAND_ID => 2, SgpiBrandWiseDistributionTableMap::COL_SGPI_STATUS => 3, SgpiBrandWiseDistributionTableMap::COL_COMPANY_ID => 4, SgpiBrandWiseDistributionTableMap::COL_CREATED_AT => 5, SgpiBrandWiseDistributionTableMap::COL_UPDATED_AT => 6, SgpiBrandWiseDistributionTableMap::COL_TERRITORY_ID => 7, SgpiBrandWiseDistributionTableMap::COL_TERRITORY_NAME => 8, SgpiBrandWiseDistributionTableMap::COL_POSITION_ID => 9, SgpiBrandWiseDistributionTableMap::COL_POSITION_NAME => 10, SgpiBrandWiseDistributionTableMap::COL_BEAT_ID => 11, SgpiBrandWiseDistributionTableMap::COL_BEAT_NAME => 12, SgpiBrandWiseDistributionTableMap::COL_TAGS => 13, SgpiBrandWiseDistributionTableMap::COL_ORG_POTENTIAL => 14, SgpiBrandWiseDistributionTableMap::COL_BRAND_FOCUS => 15, SgpiBrandWiseDistributionTableMap::COL_CUSTOMER_FQ => 16, SgpiBrandWiseDistributionTableMap::COL_ID => 17, SgpiBrandWiseDistributionTableMap::COL_OUTLET_NAME => 18, SgpiBrandWiseDistributionTableMap::COL_OUTLET_CODE => 19, SgpiBrandWiseDistributionTableMap::COL_OUTLETTYPE_ID => 20, SgpiBrandWiseDistributionTableMap::COL_OUTLETTYPE_NAME => 21, SgpiBrandWiseDistributionTableMap::COL_ITOWNID => 22, SgpiBrandWiseDistributionTableMap::COL_OUTLET_CITY => 23, SgpiBrandWiseDistributionTableMap::COL_CLASSIFICATION => 24, SgpiBrandWiseDistributionTableMap::COL_BRAND_NAME => 25, ],
        self::TYPE_FIELDNAME     => ['sgpimap_id' => 0, 'org_data_id' => 1, 'brand_id' => 2, 'sgpi_status' => 3, 'company_id' => 4, 'created_at' => 5, 'updated_at' => 6, 'territory_id' => 7, 'territory_name' => 8, 'position_id' => 9, 'position_name' => 10, 'beat_id' => 11, 'beat_name' => 12, 'tags' => 13, 'org_potential' => 14, 'brand_focus' => 15, 'customer_fq' => 16, 'id' => 17, 'outlet_name' => 18, 'outlet_code' => 19, 'outlettype_id' => 20, 'outlettype_name' => 21, 'itownid' => 22, 'outlet_city' => 23, 'classification' => 24, 'brand_name' => 25, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'SgpiVoucherId' => 'SGPIMAP_ID',
        'SgpiBrandWiseDistribution.SgpiVoucherId' => 'SGPIMAP_ID',
        'sgpiVoucherId' => 'SGPIMAP_ID',
        'sgpiBrandWiseDistribution.sgpiVoucherId' => 'SGPIMAP_ID',
        'SgpiBrandWiseDistributionTableMap::COL_SGPIMAP_ID' => 'SGPIMAP_ID',
        'COL_SGPIMAP_ID' => 'SGPIMAP_ID',
        'sgpimap_id' => 'SGPIMAP_ID',
        'sgpi_brand_wise_distribution.sgpimap_id' => 'SGPIMAP_ID',
        'OrgDataId' => 'ORG_DATA_ID',
        'SgpiBrandWiseDistribution.OrgDataId' => 'ORG_DATA_ID',
        'orgDataId' => 'ORG_DATA_ID',
        'sgpiBrandWiseDistribution.orgDataId' => 'ORG_DATA_ID',
        'SgpiBrandWiseDistributionTableMap::COL_ORG_DATA_ID' => 'ORG_DATA_ID',
        'COL_ORG_DATA_ID' => 'ORG_DATA_ID',
        'org_data_id' => 'ORG_DATA_ID',
        'sgpi_brand_wise_distribution.org_data_id' => 'ORG_DATA_ID',
        'BrandId' => 'BRAND_ID',
        'SgpiBrandWiseDistribution.BrandId' => 'BRAND_ID',
        'brandId' => 'BRAND_ID',
        'sgpiBrandWiseDistribution.brandId' => 'BRAND_ID',
        'SgpiBrandWiseDistributionTableMap::COL_BRAND_ID' => 'BRAND_ID',
        'COL_BRAND_ID' => 'BRAND_ID',
        'brand_id' => 'BRAND_ID',
        'sgpi_brand_wise_distribution.brand_id' => 'BRAND_ID',
        'SgpiStatus' => 'SGPI_STATUS',
        'SgpiBrandWiseDistribution.SgpiStatus' => 'SGPI_STATUS',
        'sgpiStatus' => 'SGPI_STATUS',
        'sgpiBrandWiseDistribution.sgpiStatus' => 'SGPI_STATUS',
        'SgpiBrandWiseDistributionTableMap::COL_SGPI_STATUS' => 'SGPI_STATUS',
        'COL_SGPI_STATUS' => 'SGPI_STATUS',
        'sgpi_status' => 'SGPI_STATUS',
        'sgpi_brand_wise_distribution.sgpi_status' => 'SGPI_STATUS',
        'CompanyId' => 'COMPANY_ID',
        'SgpiBrandWiseDistribution.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'sgpiBrandWiseDistribution.companyId' => 'COMPANY_ID',
        'SgpiBrandWiseDistributionTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'sgpi_brand_wise_distribution.company_id' => 'COMPANY_ID',
        'CreatedAt' => 'CREATED_AT',
        'SgpiBrandWiseDistribution.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'sgpiBrandWiseDistribution.createdAt' => 'CREATED_AT',
        'SgpiBrandWiseDistributionTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'sgpi_brand_wise_distribution.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SgpiBrandWiseDistribution.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'sgpiBrandWiseDistribution.updatedAt' => 'UPDATED_AT',
        'SgpiBrandWiseDistributionTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'sgpi_brand_wise_distribution.updated_at' => 'UPDATED_AT',
        'TerritoryId' => 'TERRITORY_ID',
        'SgpiBrandWiseDistribution.TerritoryId' => 'TERRITORY_ID',
        'territoryId' => 'TERRITORY_ID',
        'sgpiBrandWiseDistribution.territoryId' => 'TERRITORY_ID',
        'SgpiBrandWiseDistributionTableMap::COL_TERRITORY_ID' => 'TERRITORY_ID',
        'COL_TERRITORY_ID' => 'TERRITORY_ID',
        'territory_id' => 'TERRITORY_ID',
        'sgpi_brand_wise_distribution.territory_id' => 'TERRITORY_ID',
        'TerritoryName' => 'TERRITORY_NAME',
        'SgpiBrandWiseDistribution.TerritoryName' => 'TERRITORY_NAME',
        'territoryName' => 'TERRITORY_NAME',
        'sgpiBrandWiseDistribution.territoryName' => 'TERRITORY_NAME',
        'SgpiBrandWiseDistributionTableMap::COL_TERRITORY_NAME' => 'TERRITORY_NAME',
        'COL_TERRITORY_NAME' => 'TERRITORY_NAME',
        'territory_name' => 'TERRITORY_NAME',
        'sgpi_brand_wise_distribution.territory_name' => 'TERRITORY_NAME',
        'PositionId' => 'POSITION_ID',
        'SgpiBrandWiseDistribution.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'sgpiBrandWiseDistribution.positionId' => 'POSITION_ID',
        'SgpiBrandWiseDistributionTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'sgpi_brand_wise_distribution.position_id' => 'POSITION_ID',
        'PositionName' => 'POSITION_NAME',
        'SgpiBrandWiseDistribution.PositionName' => 'POSITION_NAME',
        'positionName' => 'POSITION_NAME',
        'sgpiBrandWiseDistribution.positionName' => 'POSITION_NAME',
        'SgpiBrandWiseDistributionTableMap::COL_POSITION_NAME' => 'POSITION_NAME',
        'COL_POSITION_NAME' => 'POSITION_NAME',
        'position_name' => 'POSITION_NAME',
        'sgpi_brand_wise_distribution.position_name' => 'POSITION_NAME',
        'BeatId' => 'BEAT_ID',
        'SgpiBrandWiseDistribution.BeatId' => 'BEAT_ID',
        'beatId' => 'BEAT_ID',
        'sgpiBrandWiseDistribution.beatId' => 'BEAT_ID',
        'SgpiBrandWiseDistributionTableMap::COL_BEAT_ID' => 'BEAT_ID',
        'COL_BEAT_ID' => 'BEAT_ID',
        'beat_id' => 'BEAT_ID',
        'sgpi_brand_wise_distribution.beat_id' => 'BEAT_ID',
        'BeatName' => 'BEAT_NAME',
        'SgpiBrandWiseDistribution.BeatName' => 'BEAT_NAME',
        'beatName' => 'BEAT_NAME',
        'sgpiBrandWiseDistribution.beatName' => 'BEAT_NAME',
        'SgpiBrandWiseDistributionTableMap::COL_BEAT_NAME' => 'BEAT_NAME',
        'COL_BEAT_NAME' => 'BEAT_NAME',
        'beat_name' => 'BEAT_NAME',
        'sgpi_brand_wise_distribution.beat_name' => 'BEAT_NAME',
        'Tags' => 'TAGS',
        'SgpiBrandWiseDistribution.Tags' => 'TAGS',
        'tags' => 'TAGS',
        'sgpiBrandWiseDistribution.tags' => 'TAGS',
        'SgpiBrandWiseDistributionTableMap::COL_TAGS' => 'TAGS',
        'COL_TAGS' => 'TAGS',
        'sgpi_brand_wise_distribution.tags' => 'TAGS',
        'OrgPotential' => 'ORG_POTENTIAL',
        'SgpiBrandWiseDistribution.OrgPotential' => 'ORG_POTENTIAL',
        'orgPotential' => 'ORG_POTENTIAL',
        'sgpiBrandWiseDistribution.orgPotential' => 'ORG_POTENTIAL',
        'SgpiBrandWiseDistributionTableMap::COL_ORG_POTENTIAL' => 'ORG_POTENTIAL',
        'COL_ORG_POTENTIAL' => 'ORG_POTENTIAL',
        'org_potential' => 'ORG_POTENTIAL',
        'sgpi_brand_wise_distribution.org_potential' => 'ORG_POTENTIAL',
        'BrandFocus' => 'BRAND_FOCUS',
        'SgpiBrandWiseDistribution.BrandFocus' => 'BRAND_FOCUS',
        'brandFocus' => 'BRAND_FOCUS',
        'sgpiBrandWiseDistribution.brandFocus' => 'BRAND_FOCUS',
        'SgpiBrandWiseDistributionTableMap::COL_BRAND_FOCUS' => 'BRAND_FOCUS',
        'COL_BRAND_FOCUS' => 'BRAND_FOCUS',
        'brand_focus' => 'BRAND_FOCUS',
        'sgpi_brand_wise_distribution.brand_focus' => 'BRAND_FOCUS',
        'CustomerFq' => 'CUSTOMER_FQ',
        'SgpiBrandWiseDistribution.CustomerFq' => 'CUSTOMER_FQ',
        'customerFq' => 'CUSTOMER_FQ',
        'sgpiBrandWiseDistribution.customerFq' => 'CUSTOMER_FQ',
        'SgpiBrandWiseDistributionTableMap::COL_CUSTOMER_FQ' => 'CUSTOMER_FQ',
        'COL_CUSTOMER_FQ' => 'CUSTOMER_FQ',
        'customer_fq' => 'CUSTOMER_FQ',
        'sgpi_brand_wise_distribution.customer_fq' => 'CUSTOMER_FQ',
        'OutletId' => 'ID',
        'SgpiBrandWiseDistribution.OutletId' => 'ID',
        'outletId' => 'ID',
        'sgpiBrandWiseDistribution.outletId' => 'ID',
        'SgpiBrandWiseDistributionTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'id' => 'ID',
        'sgpi_brand_wise_distribution.id' => 'ID',
        'OutletName' => 'OUTLET_NAME',
        'SgpiBrandWiseDistribution.OutletName' => 'OUTLET_NAME',
        'outletName' => 'OUTLET_NAME',
        'sgpiBrandWiseDistribution.outletName' => 'OUTLET_NAME',
        'SgpiBrandWiseDistributionTableMap::COL_OUTLET_NAME' => 'OUTLET_NAME',
        'COL_OUTLET_NAME' => 'OUTLET_NAME',
        'outlet_name' => 'OUTLET_NAME',
        'sgpi_brand_wise_distribution.outlet_name' => 'OUTLET_NAME',
        'OutletCode' => 'OUTLET_CODE',
        'SgpiBrandWiseDistribution.OutletCode' => 'OUTLET_CODE',
        'outletCode' => 'OUTLET_CODE',
        'sgpiBrandWiseDistribution.outletCode' => 'OUTLET_CODE',
        'SgpiBrandWiseDistributionTableMap::COL_OUTLET_CODE' => 'OUTLET_CODE',
        'COL_OUTLET_CODE' => 'OUTLET_CODE',
        'outlet_code' => 'OUTLET_CODE',
        'sgpi_brand_wise_distribution.outlet_code' => 'OUTLET_CODE',
        'OutlettypeId' => 'OUTLETTYPE_ID',
        'SgpiBrandWiseDistribution.OutlettypeId' => 'OUTLETTYPE_ID',
        'outlettypeId' => 'OUTLETTYPE_ID',
        'sgpiBrandWiseDistribution.outlettypeId' => 'OUTLETTYPE_ID',
        'SgpiBrandWiseDistributionTableMap::COL_OUTLETTYPE_ID' => 'OUTLETTYPE_ID',
        'COL_OUTLETTYPE_ID' => 'OUTLETTYPE_ID',
        'outlettype_id' => 'OUTLETTYPE_ID',
        'sgpi_brand_wise_distribution.outlettype_id' => 'OUTLETTYPE_ID',
        'OutlettypeName' => 'OUTLETTYPE_NAME',
        'SgpiBrandWiseDistribution.OutlettypeName' => 'OUTLETTYPE_NAME',
        'outlettypeName' => 'OUTLETTYPE_NAME',
        'sgpiBrandWiseDistribution.outlettypeName' => 'OUTLETTYPE_NAME',
        'SgpiBrandWiseDistributionTableMap::COL_OUTLETTYPE_NAME' => 'OUTLETTYPE_NAME',
        'COL_OUTLETTYPE_NAME' => 'OUTLETTYPE_NAME',
        'outlettype_name' => 'OUTLETTYPE_NAME',
        'sgpi_brand_wise_distribution.outlettype_name' => 'OUTLETTYPE_NAME',
        'Itownid' => 'ITOWNID',
        'SgpiBrandWiseDistribution.Itownid' => 'ITOWNID',
        'itownid' => 'ITOWNID',
        'sgpiBrandWiseDistribution.itownid' => 'ITOWNID',
        'SgpiBrandWiseDistributionTableMap::COL_ITOWNID' => 'ITOWNID',
        'COL_ITOWNID' => 'ITOWNID',
        'sgpi_brand_wise_distribution.itownid' => 'ITOWNID',
        'OutletCity' => 'OUTLET_CITY',
        'SgpiBrandWiseDistribution.OutletCity' => 'OUTLET_CITY',
        'outletCity' => 'OUTLET_CITY',
        'sgpiBrandWiseDistribution.outletCity' => 'OUTLET_CITY',
        'SgpiBrandWiseDistributionTableMap::COL_OUTLET_CITY' => 'OUTLET_CITY',
        'COL_OUTLET_CITY' => 'OUTLET_CITY',
        'outlet_city' => 'OUTLET_CITY',
        'sgpi_brand_wise_distribution.outlet_city' => 'OUTLET_CITY',
        'Classification' => 'CLASSIFICATION',
        'SgpiBrandWiseDistribution.Classification' => 'CLASSIFICATION',
        'classification' => 'CLASSIFICATION',
        'sgpiBrandWiseDistribution.classification' => 'CLASSIFICATION',
        'SgpiBrandWiseDistributionTableMap::COL_CLASSIFICATION' => 'CLASSIFICATION',
        'COL_CLASSIFICATION' => 'CLASSIFICATION',
        'sgpi_brand_wise_distribution.classification' => 'CLASSIFICATION',
        'BrandName' => 'BRAND_NAME',
        'SgpiBrandWiseDistribution.BrandName' => 'BRAND_NAME',
        'brandName' => 'BRAND_NAME',
        'sgpiBrandWiseDistribution.brandName' => 'BRAND_NAME',
        'SgpiBrandWiseDistributionTableMap::COL_BRAND_NAME' => 'BRAND_NAME',
        'COL_BRAND_NAME' => 'BRAND_NAME',
        'brand_name' => 'BRAND_NAME',
        'sgpi_brand_wise_distribution.brand_name' => 'BRAND_NAME',
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
        $this->setName('sgpi_brand_wise_distribution');
        $this->setPhpName('SgpiBrandWiseDistribution');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\SgpiBrandWiseDistribution');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addColumn('sgpimap_id', 'SgpiVoucherId', 'INTEGER', false, null, null);
        $this->addColumn('org_data_id', 'OrgDataId', 'INTEGER', false, null, null);
        $this->addColumn('brand_id', 'BrandId', 'INTEGER', false, null, null);
        $this->addColumn('sgpi_status', 'SgpiStatus', 'VARCHAR', false, null, null);
        $this->addColumn('company_id', 'CompanyId', 'INTEGER', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'VARCHAR', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'VARCHAR', false, null, null);
        $this->addColumn('territory_id', 'TerritoryId', 'INTEGER', false, null, null);
        $this->addColumn('territory_name', 'TerritoryName', 'VARCHAR', false, null, null);
        $this->addColumn('position_id', 'PositionId', 'INTEGER', false, null, null);
        $this->addColumn('position_name', 'PositionName', 'VARCHAR', false, null, null);
        $this->addColumn('beat_id', 'BeatId', 'INTEGER', false, null, null);
        $this->addColumn('beat_name', 'BeatName', 'VARCHAR', false, null, null);
        $this->addColumn('tags', 'Tags', 'VARCHAR', false, null, null);
        $this->addColumn('org_potential', 'OrgPotential', 'VARCHAR', false, null, null);
        $this->addColumn('brand_focus', 'BrandFocus', 'VARCHAR', false, null, null);
        $this->addColumn('customer_fq', 'CustomerFq', 'VARCHAR', false, null, null);
        $this->addColumn('id', 'OutletId', 'INTEGER', false, null, null);
        $this->addColumn('outlet_name', 'OutletName', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_code', 'OutletCode', 'VARCHAR', false, null, null);
        $this->addColumn('outlettype_id', 'OutlettypeId', 'INTEGER', false, null, null);
        $this->addColumn('outlettype_name', 'OutlettypeName', 'VARCHAR', false, null, null);
        $this->addColumn('itownid', 'Itownid', 'INTEGER', false, null, null);
        $this->addColumn('outlet_city', 'OutletCity', 'VARCHAR', false, null, null);
        $this->addColumn('classification', 'Classification', 'VARCHAR', false, null, null);
        $this->addColumn('brand_name', 'BrandName', 'VARCHAR', false, null, null);
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
        return $withPrefix ? SgpiBrandWiseDistributionTableMap::CLASS_DEFAULT : SgpiBrandWiseDistributionTableMap::OM_CLASS;
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
     * @return array (SgpiBrandWiseDistribution object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SgpiBrandWiseDistributionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SgpiBrandWiseDistributionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SgpiBrandWiseDistributionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SgpiBrandWiseDistributionTableMap::OM_CLASS;
            /** @var SgpiBrandWiseDistribution $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SgpiBrandWiseDistributionTableMap::addInstanceToPool($obj, $key);
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
            $key = SgpiBrandWiseDistributionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SgpiBrandWiseDistributionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SgpiBrandWiseDistribution $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SgpiBrandWiseDistributionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SgpiBrandWiseDistributionTableMap::COL_SGPIMAP_ID);
            $criteria->addSelectColumn(SgpiBrandWiseDistributionTableMap::COL_ORG_DATA_ID);
            $criteria->addSelectColumn(SgpiBrandWiseDistributionTableMap::COL_BRAND_ID);
            $criteria->addSelectColumn(SgpiBrandWiseDistributionTableMap::COL_SGPI_STATUS);
            $criteria->addSelectColumn(SgpiBrandWiseDistributionTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(SgpiBrandWiseDistributionTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SgpiBrandWiseDistributionTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(SgpiBrandWiseDistributionTableMap::COL_TERRITORY_ID);
            $criteria->addSelectColumn(SgpiBrandWiseDistributionTableMap::COL_TERRITORY_NAME);
            $criteria->addSelectColumn(SgpiBrandWiseDistributionTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(SgpiBrandWiseDistributionTableMap::COL_POSITION_NAME);
            $criteria->addSelectColumn(SgpiBrandWiseDistributionTableMap::COL_BEAT_ID);
            $criteria->addSelectColumn(SgpiBrandWiseDistributionTableMap::COL_BEAT_NAME);
            $criteria->addSelectColumn(SgpiBrandWiseDistributionTableMap::COL_TAGS);
            $criteria->addSelectColumn(SgpiBrandWiseDistributionTableMap::COL_ORG_POTENTIAL);
            $criteria->addSelectColumn(SgpiBrandWiseDistributionTableMap::COL_BRAND_FOCUS);
            $criteria->addSelectColumn(SgpiBrandWiseDistributionTableMap::COL_CUSTOMER_FQ);
            $criteria->addSelectColumn(SgpiBrandWiseDistributionTableMap::COL_ID);
            $criteria->addSelectColumn(SgpiBrandWiseDistributionTableMap::COL_OUTLET_NAME);
            $criteria->addSelectColumn(SgpiBrandWiseDistributionTableMap::COL_OUTLET_CODE);
            $criteria->addSelectColumn(SgpiBrandWiseDistributionTableMap::COL_OUTLETTYPE_ID);
            $criteria->addSelectColumn(SgpiBrandWiseDistributionTableMap::COL_OUTLETTYPE_NAME);
            $criteria->addSelectColumn(SgpiBrandWiseDistributionTableMap::COL_ITOWNID);
            $criteria->addSelectColumn(SgpiBrandWiseDistributionTableMap::COL_OUTLET_CITY);
            $criteria->addSelectColumn(SgpiBrandWiseDistributionTableMap::COL_CLASSIFICATION);
            $criteria->addSelectColumn(SgpiBrandWiseDistributionTableMap::COL_BRAND_NAME);
        } else {
            $criteria->addSelectColumn($alias . '.sgpimap_id');
            $criteria->addSelectColumn($alias . '.org_data_id');
            $criteria->addSelectColumn($alias . '.brand_id');
            $criteria->addSelectColumn($alias . '.sgpi_status');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.territory_id');
            $criteria->addSelectColumn($alias . '.territory_name');
            $criteria->addSelectColumn($alias . '.position_id');
            $criteria->addSelectColumn($alias . '.position_name');
            $criteria->addSelectColumn($alias . '.beat_id');
            $criteria->addSelectColumn($alias . '.beat_name');
            $criteria->addSelectColumn($alias . '.tags');
            $criteria->addSelectColumn($alias . '.org_potential');
            $criteria->addSelectColumn($alias . '.brand_focus');
            $criteria->addSelectColumn($alias . '.customer_fq');
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.outlet_name');
            $criteria->addSelectColumn($alias . '.outlet_code');
            $criteria->addSelectColumn($alias . '.outlettype_id');
            $criteria->addSelectColumn($alias . '.outlettype_name');
            $criteria->addSelectColumn($alias . '.itownid');
            $criteria->addSelectColumn($alias . '.outlet_city');
            $criteria->addSelectColumn($alias . '.classification');
            $criteria->addSelectColumn($alias . '.brand_name');
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
            $criteria->removeSelectColumn(SgpiBrandWiseDistributionTableMap::COL_SGPIMAP_ID);
            $criteria->removeSelectColumn(SgpiBrandWiseDistributionTableMap::COL_ORG_DATA_ID);
            $criteria->removeSelectColumn(SgpiBrandWiseDistributionTableMap::COL_BRAND_ID);
            $criteria->removeSelectColumn(SgpiBrandWiseDistributionTableMap::COL_SGPI_STATUS);
            $criteria->removeSelectColumn(SgpiBrandWiseDistributionTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(SgpiBrandWiseDistributionTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SgpiBrandWiseDistributionTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(SgpiBrandWiseDistributionTableMap::COL_TERRITORY_ID);
            $criteria->removeSelectColumn(SgpiBrandWiseDistributionTableMap::COL_TERRITORY_NAME);
            $criteria->removeSelectColumn(SgpiBrandWiseDistributionTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(SgpiBrandWiseDistributionTableMap::COL_POSITION_NAME);
            $criteria->removeSelectColumn(SgpiBrandWiseDistributionTableMap::COL_BEAT_ID);
            $criteria->removeSelectColumn(SgpiBrandWiseDistributionTableMap::COL_BEAT_NAME);
            $criteria->removeSelectColumn(SgpiBrandWiseDistributionTableMap::COL_TAGS);
            $criteria->removeSelectColumn(SgpiBrandWiseDistributionTableMap::COL_ORG_POTENTIAL);
            $criteria->removeSelectColumn(SgpiBrandWiseDistributionTableMap::COL_BRAND_FOCUS);
            $criteria->removeSelectColumn(SgpiBrandWiseDistributionTableMap::COL_CUSTOMER_FQ);
            $criteria->removeSelectColumn(SgpiBrandWiseDistributionTableMap::COL_ID);
            $criteria->removeSelectColumn(SgpiBrandWiseDistributionTableMap::COL_OUTLET_NAME);
            $criteria->removeSelectColumn(SgpiBrandWiseDistributionTableMap::COL_OUTLET_CODE);
            $criteria->removeSelectColumn(SgpiBrandWiseDistributionTableMap::COL_OUTLETTYPE_ID);
            $criteria->removeSelectColumn(SgpiBrandWiseDistributionTableMap::COL_OUTLETTYPE_NAME);
            $criteria->removeSelectColumn(SgpiBrandWiseDistributionTableMap::COL_ITOWNID);
            $criteria->removeSelectColumn(SgpiBrandWiseDistributionTableMap::COL_OUTLET_CITY);
            $criteria->removeSelectColumn(SgpiBrandWiseDistributionTableMap::COL_CLASSIFICATION);
            $criteria->removeSelectColumn(SgpiBrandWiseDistributionTableMap::COL_BRAND_NAME);
        } else {
            $criteria->removeSelectColumn($alias . '.sgpimap_id');
            $criteria->removeSelectColumn($alias . '.org_data_id');
            $criteria->removeSelectColumn($alias . '.brand_id');
            $criteria->removeSelectColumn($alias . '.sgpi_status');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.territory_id');
            $criteria->removeSelectColumn($alias . '.territory_name');
            $criteria->removeSelectColumn($alias . '.position_id');
            $criteria->removeSelectColumn($alias . '.position_name');
            $criteria->removeSelectColumn($alias . '.beat_id');
            $criteria->removeSelectColumn($alias . '.beat_name');
            $criteria->removeSelectColumn($alias . '.tags');
            $criteria->removeSelectColumn($alias . '.org_potential');
            $criteria->removeSelectColumn($alias . '.brand_focus');
            $criteria->removeSelectColumn($alias . '.customer_fq');
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.outlet_name');
            $criteria->removeSelectColumn($alias . '.outlet_code');
            $criteria->removeSelectColumn($alias . '.outlettype_id');
            $criteria->removeSelectColumn($alias . '.outlettype_name');
            $criteria->removeSelectColumn($alias . '.itownid');
            $criteria->removeSelectColumn($alias . '.outlet_city');
            $criteria->removeSelectColumn($alias . '.classification');
            $criteria->removeSelectColumn($alias . '.brand_name');
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
        return Propel::getServiceContainer()->getDatabaseMap(SgpiBrandWiseDistributionTableMap::DATABASE_NAME)->getTable(SgpiBrandWiseDistributionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SgpiBrandWiseDistribution or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SgpiBrandWiseDistribution object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SgpiBrandWiseDistributionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\SgpiBrandWiseDistribution) { // it's a model object
            // create criteria based on pk value
            $criteria = $values->buildCriteria();
        } else { // it's a primary key, or an array of pks
            throw new LogicException('The SgpiBrandWiseDistribution object has no primary key');
        }

        $query = SgpiBrandWiseDistributionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SgpiBrandWiseDistributionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SgpiBrandWiseDistributionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sgpi_brand_wise_distribution table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SgpiBrandWiseDistributionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SgpiBrandWiseDistribution or Criteria object.
     *
     * @param mixed $criteria Criteria or SgpiBrandWiseDistribution object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SgpiBrandWiseDistributionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SgpiBrandWiseDistribution object
        }


        // Set the correct dbName
        $query = SgpiBrandWiseDistributionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
