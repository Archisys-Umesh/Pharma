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
use entities\ExportBrandCampaign;
use entities\ExportBrandCampaignQuery;


/**
 * This class defines the structure of the 'export_brand_campaign' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ExportBrandCampaignTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.ExportBrandCampaignTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'export_brand_campaign';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'ExportBrandCampaign';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\ExportBrandCampaign';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.ExportBrandCampaign';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 37;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 37;

    /**
     * the column name for the brand_campiagn_visit_id field
     */
    public const COL_BRAND_CAMPIAGN_VISIT_ID = 'export_brand_campaign.brand_campiagn_visit_id';

    /**
     * the column name for the brand_campiagn_id field
     */
    public const COL_BRAND_CAMPIAGN_ID = 'export_brand_campaign.brand_campiagn_id';

    /**
     * the column name for the brand_campiagn_visit_plan_id field
     */
    public const COL_BRAND_CAMPIAGN_VISIT_PLAN_ID = 'export_brand_campaign.brand_campiagn_visit_plan_id';

    /**
     * the column name for the outlet_org_data_id field
     */
    public const COL_OUTLET_ORG_DATA_ID = 'export_brand_campaign.outlet_org_data_id';

    /**
     * the column name for the dcr_id field
     */
    public const COL_DCR_ID = 'export_brand_campaign.dcr_id';

    /**
     * the column name for the bu_name field
     */
    public const COL_BU_NAME = 'export_brand_campaign.bu_name';

    /**
     * the column name for the zm_manager_branch field
     */
    public const COL_ZM_MANAGER_BRANCH = 'export_brand_campaign.zm_manager_branch';

    /**
     * the column name for the zm_manager_town field
     */
    public const COL_ZM_MANAGER_TOWN = 'export_brand_campaign.zm_manager_town';

    /**
     * the column name for the rm_manager_branch field
     */
    public const COL_RM_MANAGER_BRANCH = 'export_brand_campaign.rm_manager_branch';

    /**
     * the column name for the rm_manager_town field
     */
    public const COL_RM_MANAGER_TOWN = 'export_brand_campaign.rm_manager_town';

    /**
     * the column name for the am_manager_branch field
     */
    public const COL_AM_MANAGER_BRANCH = 'export_brand_campaign.am_manager_branch';

    /**
     * the column name for the am_manager_town field
     */
    public const COL_AM_MANAGER_TOWN = 'export_brand_campaign.am_manager_town';

    /**
     * the column name for the emp_position_name field
     */
    public const COL_EMP_POSITION_NAME = 'export_brand_campaign.emp_position_name';

    /**
     * the column name for the emp_branch field
     */
    public const COL_EMP_BRANCH = 'export_brand_campaign.emp_branch';

    /**
     * the column name for the emp_level field
     */
    public const COL_EMP_LEVEL = 'export_brand_campaign.emp_level';

    /**
     * the column name for the employee_code field
     */
    public const COL_EMPLOYEE_CODE = 'export_brand_campaign.employee_code';

    /**
     * the column name for the employee_name field
     */
    public const COL_EMPLOYEE_NAME = 'export_brand_campaign.employee_name';

    /**
     * the column name for the ed_duration field
     */
    public const COL_ED_DURATION = 'export_brand_campaign.ed_duration';

    /**
     * the column name for the campiagn_name field
     */
    public const COL_CAMPIAGN_NAME = 'export_brand_campaign.campiagn_name';

    /**
     * the column name for the focus_brands field
     */
    public const COL_FOCUS_BRANDS = 'export_brand_campaign.focus_brands';

    /**
     * the column name for the focus_brand_ids field
     */
    public const COL_FOCUS_BRAND_IDS = 'export_brand_campaign.focus_brand_ids';

    /**
     * the column name for the campaign_start_date field
     */
    public const COL_CAMPAIGN_START_DATE = 'export_brand_campaign.campaign_start_date';

    /**
     * the column name for the campaign_end_date field
     */
    public const COL_CAMPAIGN_END_DATE = 'export_brand_campaign.campaign_end_date';

    /**
     * the column name for the outlet_tags field
     */
    public const COL_OUTLET_TAGS = 'export_brand_campaign.outlet_tags';

    /**
     * the column name for the outlet_name field
     */
    public const COL_OUTLET_NAME = 'export_brand_campaign.outlet_name';

    /**
     * the column name for the outlet_code field
     */
    public const COL_OUTLET_CODE = 'export_brand_campaign.outlet_code';

    /**
     * the column name for the outlet_org_code field
     */
    public const COL_OUTLET_ORG_CODE = 'export_brand_campaign.outlet_org_code';

    /**
     * the column name for the outlet_classification field
     */
    public const COL_OUTLET_CLASSIFICATION = 'export_brand_campaign.outlet_classification';

    /**
     * the column name for the step_number field
     */
    public const COL_STEP_NUMBER = 'export_brand_campaign.step_number';

    /**
     * the column name for the sgpi_to_be_given field
     */
    public const COL_SGPI_TO_BE_GIVEN = 'export_brand_campaign.sgpi_to_be_given';

    /**
     * the column name for the visited_date field
     */
    public const COL_VISITED_DATE = 'export_brand_campaign.visited_date';

    /**
     * the column name for the visited_month field
     */
    public const COL_VISITED_MONTH = 'export_brand_campaign.visited_month';

    /**
     * the column name for the sgpi_given field
     */
    public const COL_SGPI_GIVEN = 'export_brand_campaign.sgpi_given';

    /**
     * the column name for the zm_position_code field
     */
    public const COL_ZM_POSITION_CODE = 'export_brand_campaign.zm_position_code';

    /**
     * the column name for the rm_position_code field
     */
    public const COL_RM_POSITION_CODE = 'export_brand_campaign.rm_position_code';

    /**
     * the column name for the am_position_code field
     */
    public const COL_AM_POSITION_CODE = 'export_brand_campaign.am_position_code';

    /**
     * the column name for the emp_position_code field
     */
    public const COL_EMP_POSITION_CODE = 'export_brand_campaign.emp_position_code';

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
        self::TYPE_PHPNAME       => ['BrandCampiagnVisitId', 'BrandCampiagnId', 'BrandCampiagnVisitPlanId', 'OutletOrgDataId', 'DcrId', 'BuName', 'ZmManagerBranch', 'ZmManagerTown', 'RmManagerBranch', 'RmManagerTown', 'AmManagerBranch', 'AmManagerTown', 'EmpPositionName', 'EmpBranch', 'EmpLevel', 'EmployeeCode', 'EmployeeName', 'EdDuration', 'CampiagnName', 'FocusBrands', 'FocusBrandIds', 'CampaignStartDate', 'CampaignEndDate', 'OutletTags', 'OutletName', 'OutletCode', 'OutletOrgCode', 'OutletClassification', 'StepNumber', 'SgpiToBeGiven', 'VisitedDate', 'VisitedMonth', 'SgpiGiven', 'ZmPositionCode', 'RmPositionCode', 'AmPositionCode', 'EmpPositionCode', ],
        self::TYPE_CAMELNAME     => ['brandCampiagnVisitId', 'brandCampiagnId', 'brandCampiagnVisitPlanId', 'outletOrgDataId', 'dcrId', 'buName', 'zmManagerBranch', 'zmManagerTown', 'rmManagerBranch', 'rmManagerTown', 'amManagerBranch', 'amManagerTown', 'empPositionName', 'empBranch', 'empLevel', 'employeeCode', 'employeeName', 'edDuration', 'campiagnName', 'focusBrands', 'focusBrandIds', 'campaignStartDate', 'campaignEndDate', 'outletTags', 'outletName', 'outletCode', 'outletOrgCode', 'outletClassification', 'stepNumber', 'sgpiToBeGiven', 'visitedDate', 'visitedMonth', 'sgpiGiven', 'zmPositionCode', 'rmPositionCode', 'amPositionCode', 'empPositionCode', ],
        self::TYPE_COLNAME       => [ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_VISIT_ID, ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_ID, ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID, ExportBrandCampaignTableMap::COL_OUTLET_ORG_DATA_ID, ExportBrandCampaignTableMap::COL_DCR_ID, ExportBrandCampaignTableMap::COL_BU_NAME, ExportBrandCampaignTableMap::COL_ZM_MANAGER_BRANCH, ExportBrandCampaignTableMap::COL_ZM_MANAGER_TOWN, ExportBrandCampaignTableMap::COL_RM_MANAGER_BRANCH, ExportBrandCampaignTableMap::COL_RM_MANAGER_TOWN, ExportBrandCampaignTableMap::COL_AM_MANAGER_BRANCH, ExportBrandCampaignTableMap::COL_AM_MANAGER_TOWN, ExportBrandCampaignTableMap::COL_EMP_POSITION_NAME, ExportBrandCampaignTableMap::COL_EMP_BRANCH, ExportBrandCampaignTableMap::COL_EMP_LEVEL, ExportBrandCampaignTableMap::COL_EMPLOYEE_CODE, ExportBrandCampaignTableMap::COL_EMPLOYEE_NAME, ExportBrandCampaignTableMap::COL_ED_DURATION, ExportBrandCampaignTableMap::COL_CAMPIAGN_NAME, ExportBrandCampaignTableMap::COL_FOCUS_BRANDS, ExportBrandCampaignTableMap::COL_FOCUS_BRAND_IDS, ExportBrandCampaignTableMap::COL_CAMPAIGN_START_DATE, ExportBrandCampaignTableMap::COL_CAMPAIGN_END_DATE, ExportBrandCampaignTableMap::COL_OUTLET_TAGS, ExportBrandCampaignTableMap::COL_OUTLET_NAME, ExportBrandCampaignTableMap::COL_OUTLET_CODE, ExportBrandCampaignTableMap::COL_OUTLET_ORG_CODE, ExportBrandCampaignTableMap::COL_OUTLET_CLASSIFICATION, ExportBrandCampaignTableMap::COL_STEP_NUMBER, ExportBrandCampaignTableMap::COL_SGPI_TO_BE_GIVEN, ExportBrandCampaignTableMap::COL_VISITED_DATE, ExportBrandCampaignTableMap::COL_VISITED_MONTH, ExportBrandCampaignTableMap::COL_SGPI_GIVEN, ExportBrandCampaignTableMap::COL_ZM_POSITION_CODE, ExportBrandCampaignTableMap::COL_RM_POSITION_CODE, ExportBrandCampaignTableMap::COL_AM_POSITION_CODE, ExportBrandCampaignTableMap::COL_EMP_POSITION_CODE, ],
        self::TYPE_FIELDNAME     => ['brand_campiagn_visit_id', 'brand_campiagn_id', 'brand_campiagn_visit_plan_id', 'outlet_org_data_id', 'dcr_id', 'bu_name', 'zm_manager_branch', 'zm_manager_town', 'rm_manager_branch', 'rm_manager_town', 'am_manager_branch', 'am_manager_town', 'emp_position_name', 'emp_branch', 'emp_level', 'employee_code', 'employee_name', 'ed_duration', 'campiagn_name', 'focus_brands', 'focus_brand_ids', 'campaign_start_date', 'campaign_end_date', 'outlet_tags', 'outlet_name', 'outlet_code', 'outlet_org_code', 'outlet_classification', 'step_number', 'sgpi_to_be_given', 'visited_date', 'visited_month', 'sgpi_given', 'zm_position_code', 'rm_position_code', 'am_position_code', 'emp_position_code', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, ]
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
        self::TYPE_PHPNAME       => ['BrandCampiagnVisitId' => 0, 'BrandCampiagnId' => 1, 'BrandCampiagnVisitPlanId' => 2, 'OutletOrgDataId' => 3, 'DcrId' => 4, 'BuName' => 5, 'ZmManagerBranch' => 6, 'ZmManagerTown' => 7, 'RmManagerBranch' => 8, 'RmManagerTown' => 9, 'AmManagerBranch' => 10, 'AmManagerTown' => 11, 'EmpPositionName' => 12, 'EmpBranch' => 13, 'EmpLevel' => 14, 'EmployeeCode' => 15, 'EmployeeName' => 16, 'EdDuration' => 17, 'CampiagnName' => 18, 'FocusBrands' => 19, 'FocusBrandIds' => 20, 'CampaignStartDate' => 21, 'CampaignEndDate' => 22, 'OutletTags' => 23, 'OutletName' => 24, 'OutletCode' => 25, 'OutletOrgCode' => 26, 'OutletClassification' => 27, 'StepNumber' => 28, 'SgpiToBeGiven' => 29, 'VisitedDate' => 30, 'VisitedMonth' => 31, 'SgpiGiven' => 32, 'ZmPositionCode' => 33, 'RmPositionCode' => 34, 'AmPositionCode' => 35, 'EmpPositionCode' => 36, ],
        self::TYPE_CAMELNAME     => ['brandCampiagnVisitId' => 0, 'brandCampiagnId' => 1, 'brandCampiagnVisitPlanId' => 2, 'outletOrgDataId' => 3, 'dcrId' => 4, 'buName' => 5, 'zmManagerBranch' => 6, 'zmManagerTown' => 7, 'rmManagerBranch' => 8, 'rmManagerTown' => 9, 'amManagerBranch' => 10, 'amManagerTown' => 11, 'empPositionName' => 12, 'empBranch' => 13, 'empLevel' => 14, 'employeeCode' => 15, 'employeeName' => 16, 'edDuration' => 17, 'campiagnName' => 18, 'focusBrands' => 19, 'focusBrandIds' => 20, 'campaignStartDate' => 21, 'campaignEndDate' => 22, 'outletTags' => 23, 'outletName' => 24, 'outletCode' => 25, 'outletOrgCode' => 26, 'outletClassification' => 27, 'stepNumber' => 28, 'sgpiToBeGiven' => 29, 'visitedDate' => 30, 'visitedMonth' => 31, 'sgpiGiven' => 32, 'zmPositionCode' => 33, 'rmPositionCode' => 34, 'amPositionCode' => 35, 'empPositionCode' => 36, ],
        self::TYPE_COLNAME       => [ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_VISIT_ID => 0, ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_ID => 1, ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID => 2, ExportBrandCampaignTableMap::COL_OUTLET_ORG_DATA_ID => 3, ExportBrandCampaignTableMap::COL_DCR_ID => 4, ExportBrandCampaignTableMap::COL_BU_NAME => 5, ExportBrandCampaignTableMap::COL_ZM_MANAGER_BRANCH => 6, ExportBrandCampaignTableMap::COL_ZM_MANAGER_TOWN => 7, ExportBrandCampaignTableMap::COL_RM_MANAGER_BRANCH => 8, ExportBrandCampaignTableMap::COL_RM_MANAGER_TOWN => 9, ExportBrandCampaignTableMap::COL_AM_MANAGER_BRANCH => 10, ExportBrandCampaignTableMap::COL_AM_MANAGER_TOWN => 11, ExportBrandCampaignTableMap::COL_EMP_POSITION_NAME => 12, ExportBrandCampaignTableMap::COL_EMP_BRANCH => 13, ExportBrandCampaignTableMap::COL_EMP_LEVEL => 14, ExportBrandCampaignTableMap::COL_EMPLOYEE_CODE => 15, ExportBrandCampaignTableMap::COL_EMPLOYEE_NAME => 16, ExportBrandCampaignTableMap::COL_ED_DURATION => 17, ExportBrandCampaignTableMap::COL_CAMPIAGN_NAME => 18, ExportBrandCampaignTableMap::COL_FOCUS_BRANDS => 19, ExportBrandCampaignTableMap::COL_FOCUS_BRAND_IDS => 20, ExportBrandCampaignTableMap::COL_CAMPAIGN_START_DATE => 21, ExportBrandCampaignTableMap::COL_CAMPAIGN_END_DATE => 22, ExportBrandCampaignTableMap::COL_OUTLET_TAGS => 23, ExportBrandCampaignTableMap::COL_OUTLET_NAME => 24, ExportBrandCampaignTableMap::COL_OUTLET_CODE => 25, ExportBrandCampaignTableMap::COL_OUTLET_ORG_CODE => 26, ExportBrandCampaignTableMap::COL_OUTLET_CLASSIFICATION => 27, ExportBrandCampaignTableMap::COL_STEP_NUMBER => 28, ExportBrandCampaignTableMap::COL_SGPI_TO_BE_GIVEN => 29, ExportBrandCampaignTableMap::COL_VISITED_DATE => 30, ExportBrandCampaignTableMap::COL_VISITED_MONTH => 31, ExportBrandCampaignTableMap::COL_SGPI_GIVEN => 32, ExportBrandCampaignTableMap::COL_ZM_POSITION_CODE => 33, ExportBrandCampaignTableMap::COL_RM_POSITION_CODE => 34, ExportBrandCampaignTableMap::COL_AM_POSITION_CODE => 35, ExportBrandCampaignTableMap::COL_EMP_POSITION_CODE => 36, ],
        self::TYPE_FIELDNAME     => ['brand_campiagn_visit_id' => 0, 'brand_campiagn_id' => 1, 'brand_campiagn_visit_plan_id' => 2, 'outlet_org_data_id' => 3, 'dcr_id' => 4, 'bu_name' => 5, 'zm_manager_branch' => 6, 'zm_manager_town' => 7, 'rm_manager_branch' => 8, 'rm_manager_town' => 9, 'am_manager_branch' => 10, 'am_manager_town' => 11, 'emp_position_name' => 12, 'emp_branch' => 13, 'emp_level' => 14, 'employee_code' => 15, 'employee_name' => 16, 'ed_duration' => 17, 'campiagn_name' => 18, 'focus_brands' => 19, 'focus_brand_ids' => 20, 'campaign_start_date' => 21, 'campaign_end_date' => 22, 'outlet_tags' => 23, 'outlet_name' => 24, 'outlet_code' => 25, 'outlet_org_code' => 26, 'outlet_classification' => 27, 'step_number' => 28, 'sgpi_to_be_given' => 29, 'visited_date' => 30, 'visited_month' => 31, 'sgpi_given' => 32, 'zm_position_code' => 33, 'rm_position_code' => 34, 'am_position_code' => 35, 'emp_position_code' => 36, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'BrandCampiagnVisitId' => 'BRAND_CAMPIAGN_VISIT_ID',
        'ExportBrandCampaign.BrandCampiagnVisitId' => 'BRAND_CAMPIAGN_VISIT_ID',
        'brandCampiagnVisitId' => 'BRAND_CAMPIAGN_VISIT_ID',
        'exportBrandCampaign.brandCampiagnVisitId' => 'BRAND_CAMPIAGN_VISIT_ID',
        'ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_VISIT_ID' => 'BRAND_CAMPIAGN_VISIT_ID',
        'COL_BRAND_CAMPIAGN_VISIT_ID' => 'BRAND_CAMPIAGN_VISIT_ID',
        'brand_campiagn_visit_id' => 'BRAND_CAMPIAGN_VISIT_ID',
        'export_brand_campaign.brand_campiagn_visit_id' => 'BRAND_CAMPIAGN_VISIT_ID',
        'BrandCampiagnId' => 'BRAND_CAMPIAGN_ID',
        'ExportBrandCampaign.BrandCampiagnId' => 'BRAND_CAMPIAGN_ID',
        'brandCampiagnId' => 'BRAND_CAMPIAGN_ID',
        'exportBrandCampaign.brandCampiagnId' => 'BRAND_CAMPIAGN_ID',
        'ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_ID' => 'BRAND_CAMPIAGN_ID',
        'COL_BRAND_CAMPIAGN_ID' => 'BRAND_CAMPIAGN_ID',
        'brand_campiagn_id' => 'BRAND_CAMPIAGN_ID',
        'export_brand_campaign.brand_campiagn_id' => 'BRAND_CAMPIAGN_ID',
        'BrandCampiagnVisitPlanId' => 'BRAND_CAMPIAGN_VISIT_PLAN_ID',
        'ExportBrandCampaign.BrandCampiagnVisitPlanId' => 'BRAND_CAMPIAGN_VISIT_PLAN_ID',
        'brandCampiagnVisitPlanId' => 'BRAND_CAMPIAGN_VISIT_PLAN_ID',
        'exportBrandCampaign.brandCampiagnVisitPlanId' => 'BRAND_CAMPIAGN_VISIT_PLAN_ID',
        'ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID' => 'BRAND_CAMPIAGN_VISIT_PLAN_ID',
        'COL_BRAND_CAMPIAGN_VISIT_PLAN_ID' => 'BRAND_CAMPIAGN_VISIT_PLAN_ID',
        'brand_campiagn_visit_plan_id' => 'BRAND_CAMPIAGN_VISIT_PLAN_ID',
        'export_brand_campaign.brand_campiagn_visit_plan_id' => 'BRAND_CAMPIAGN_VISIT_PLAN_ID',
        'OutletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'ExportBrandCampaign.OutletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'outletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'exportBrandCampaign.outletOrgDataId' => 'OUTLET_ORG_DATA_ID',
        'ExportBrandCampaignTableMap::COL_OUTLET_ORG_DATA_ID' => 'OUTLET_ORG_DATA_ID',
        'COL_OUTLET_ORG_DATA_ID' => 'OUTLET_ORG_DATA_ID',
        'outlet_org_data_id' => 'OUTLET_ORG_DATA_ID',
        'export_brand_campaign.outlet_org_data_id' => 'OUTLET_ORG_DATA_ID',
        'DcrId' => 'DCR_ID',
        'ExportBrandCampaign.DcrId' => 'DCR_ID',
        'dcrId' => 'DCR_ID',
        'exportBrandCampaign.dcrId' => 'DCR_ID',
        'ExportBrandCampaignTableMap::COL_DCR_ID' => 'DCR_ID',
        'COL_DCR_ID' => 'DCR_ID',
        'dcr_id' => 'DCR_ID',
        'export_brand_campaign.dcr_id' => 'DCR_ID',
        'BuName' => 'BU_NAME',
        'ExportBrandCampaign.BuName' => 'BU_NAME',
        'buName' => 'BU_NAME',
        'exportBrandCampaign.buName' => 'BU_NAME',
        'ExportBrandCampaignTableMap::COL_BU_NAME' => 'BU_NAME',
        'COL_BU_NAME' => 'BU_NAME',
        'bu_name' => 'BU_NAME',
        'export_brand_campaign.bu_name' => 'BU_NAME',
        'ZmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'ExportBrandCampaign.ZmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'zmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'exportBrandCampaign.zmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'ExportBrandCampaignTableMap::COL_ZM_MANAGER_BRANCH' => 'ZM_MANAGER_BRANCH',
        'COL_ZM_MANAGER_BRANCH' => 'ZM_MANAGER_BRANCH',
        'zm_manager_branch' => 'ZM_MANAGER_BRANCH',
        'export_brand_campaign.zm_manager_branch' => 'ZM_MANAGER_BRANCH',
        'ZmManagerTown' => 'ZM_MANAGER_TOWN',
        'ExportBrandCampaign.ZmManagerTown' => 'ZM_MANAGER_TOWN',
        'zmManagerTown' => 'ZM_MANAGER_TOWN',
        'exportBrandCampaign.zmManagerTown' => 'ZM_MANAGER_TOWN',
        'ExportBrandCampaignTableMap::COL_ZM_MANAGER_TOWN' => 'ZM_MANAGER_TOWN',
        'COL_ZM_MANAGER_TOWN' => 'ZM_MANAGER_TOWN',
        'zm_manager_town' => 'ZM_MANAGER_TOWN',
        'export_brand_campaign.zm_manager_town' => 'ZM_MANAGER_TOWN',
        'RmManagerBranch' => 'RM_MANAGER_BRANCH',
        'ExportBrandCampaign.RmManagerBranch' => 'RM_MANAGER_BRANCH',
        'rmManagerBranch' => 'RM_MANAGER_BRANCH',
        'exportBrandCampaign.rmManagerBranch' => 'RM_MANAGER_BRANCH',
        'ExportBrandCampaignTableMap::COL_RM_MANAGER_BRANCH' => 'RM_MANAGER_BRANCH',
        'COL_RM_MANAGER_BRANCH' => 'RM_MANAGER_BRANCH',
        'rm_manager_branch' => 'RM_MANAGER_BRANCH',
        'export_brand_campaign.rm_manager_branch' => 'RM_MANAGER_BRANCH',
        'RmManagerTown' => 'RM_MANAGER_TOWN',
        'ExportBrandCampaign.RmManagerTown' => 'RM_MANAGER_TOWN',
        'rmManagerTown' => 'RM_MANAGER_TOWN',
        'exportBrandCampaign.rmManagerTown' => 'RM_MANAGER_TOWN',
        'ExportBrandCampaignTableMap::COL_RM_MANAGER_TOWN' => 'RM_MANAGER_TOWN',
        'COL_RM_MANAGER_TOWN' => 'RM_MANAGER_TOWN',
        'rm_manager_town' => 'RM_MANAGER_TOWN',
        'export_brand_campaign.rm_manager_town' => 'RM_MANAGER_TOWN',
        'AmManagerBranch' => 'AM_MANAGER_BRANCH',
        'ExportBrandCampaign.AmManagerBranch' => 'AM_MANAGER_BRANCH',
        'amManagerBranch' => 'AM_MANAGER_BRANCH',
        'exportBrandCampaign.amManagerBranch' => 'AM_MANAGER_BRANCH',
        'ExportBrandCampaignTableMap::COL_AM_MANAGER_BRANCH' => 'AM_MANAGER_BRANCH',
        'COL_AM_MANAGER_BRANCH' => 'AM_MANAGER_BRANCH',
        'am_manager_branch' => 'AM_MANAGER_BRANCH',
        'export_brand_campaign.am_manager_branch' => 'AM_MANAGER_BRANCH',
        'AmManagerTown' => 'AM_MANAGER_TOWN',
        'ExportBrandCampaign.AmManagerTown' => 'AM_MANAGER_TOWN',
        'amManagerTown' => 'AM_MANAGER_TOWN',
        'exportBrandCampaign.amManagerTown' => 'AM_MANAGER_TOWN',
        'ExportBrandCampaignTableMap::COL_AM_MANAGER_TOWN' => 'AM_MANAGER_TOWN',
        'COL_AM_MANAGER_TOWN' => 'AM_MANAGER_TOWN',
        'am_manager_town' => 'AM_MANAGER_TOWN',
        'export_brand_campaign.am_manager_town' => 'AM_MANAGER_TOWN',
        'EmpPositionName' => 'EMP_POSITION_NAME',
        'ExportBrandCampaign.EmpPositionName' => 'EMP_POSITION_NAME',
        'empPositionName' => 'EMP_POSITION_NAME',
        'exportBrandCampaign.empPositionName' => 'EMP_POSITION_NAME',
        'ExportBrandCampaignTableMap::COL_EMP_POSITION_NAME' => 'EMP_POSITION_NAME',
        'COL_EMP_POSITION_NAME' => 'EMP_POSITION_NAME',
        'emp_position_name' => 'EMP_POSITION_NAME',
        'export_brand_campaign.emp_position_name' => 'EMP_POSITION_NAME',
        'EmpBranch' => 'EMP_BRANCH',
        'ExportBrandCampaign.EmpBranch' => 'EMP_BRANCH',
        'empBranch' => 'EMP_BRANCH',
        'exportBrandCampaign.empBranch' => 'EMP_BRANCH',
        'ExportBrandCampaignTableMap::COL_EMP_BRANCH' => 'EMP_BRANCH',
        'COL_EMP_BRANCH' => 'EMP_BRANCH',
        'emp_branch' => 'EMP_BRANCH',
        'export_brand_campaign.emp_branch' => 'EMP_BRANCH',
        'EmpLevel' => 'EMP_LEVEL',
        'ExportBrandCampaign.EmpLevel' => 'EMP_LEVEL',
        'empLevel' => 'EMP_LEVEL',
        'exportBrandCampaign.empLevel' => 'EMP_LEVEL',
        'ExportBrandCampaignTableMap::COL_EMP_LEVEL' => 'EMP_LEVEL',
        'COL_EMP_LEVEL' => 'EMP_LEVEL',
        'emp_level' => 'EMP_LEVEL',
        'export_brand_campaign.emp_level' => 'EMP_LEVEL',
        'EmployeeCode' => 'EMPLOYEE_CODE',
        'ExportBrandCampaign.EmployeeCode' => 'EMPLOYEE_CODE',
        'employeeCode' => 'EMPLOYEE_CODE',
        'exportBrandCampaign.employeeCode' => 'EMPLOYEE_CODE',
        'ExportBrandCampaignTableMap::COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'employee_code' => 'EMPLOYEE_CODE',
        'export_brand_campaign.employee_code' => 'EMPLOYEE_CODE',
        'EmployeeName' => 'EMPLOYEE_NAME',
        'ExportBrandCampaign.EmployeeName' => 'EMPLOYEE_NAME',
        'employeeName' => 'EMPLOYEE_NAME',
        'exportBrandCampaign.employeeName' => 'EMPLOYEE_NAME',
        'ExportBrandCampaignTableMap::COL_EMPLOYEE_NAME' => 'EMPLOYEE_NAME',
        'COL_EMPLOYEE_NAME' => 'EMPLOYEE_NAME',
        'employee_name' => 'EMPLOYEE_NAME',
        'export_brand_campaign.employee_name' => 'EMPLOYEE_NAME',
        'EdDuration' => 'ED_DURATION',
        'ExportBrandCampaign.EdDuration' => 'ED_DURATION',
        'edDuration' => 'ED_DURATION',
        'exportBrandCampaign.edDuration' => 'ED_DURATION',
        'ExportBrandCampaignTableMap::COL_ED_DURATION' => 'ED_DURATION',
        'COL_ED_DURATION' => 'ED_DURATION',
        'ed_duration' => 'ED_DURATION',
        'export_brand_campaign.ed_duration' => 'ED_DURATION',
        'CampiagnName' => 'CAMPIAGN_NAME',
        'ExportBrandCampaign.CampiagnName' => 'CAMPIAGN_NAME',
        'campiagnName' => 'CAMPIAGN_NAME',
        'exportBrandCampaign.campiagnName' => 'CAMPIAGN_NAME',
        'ExportBrandCampaignTableMap::COL_CAMPIAGN_NAME' => 'CAMPIAGN_NAME',
        'COL_CAMPIAGN_NAME' => 'CAMPIAGN_NAME',
        'campiagn_name' => 'CAMPIAGN_NAME',
        'export_brand_campaign.campiagn_name' => 'CAMPIAGN_NAME',
        'FocusBrands' => 'FOCUS_BRANDS',
        'ExportBrandCampaign.FocusBrands' => 'FOCUS_BRANDS',
        'focusBrands' => 'FOCUS_BRANDS',
        'exportBrandCampaign.focusBrands' => 'FOCUS_BRANDS',
        'ExportBrandCampaignTableMap::COL_FOCUS_BRANDS' => 'FOCUS_BRANDS',
        'COL_FOCUS_BRANDS' => 'FOCUS_BRANDS',
        'focus_brands' => 'FOCUS_BRANDS',
        'export_brand_campaign.focus_brands' => 'FOCUS_BRANDS',
        'FocusBrandIds' => 'FOCUS_BRAND_IDS',
        'ExportBrandCampaign.FocusBrandIds' => 'FOCUS_BRAND_IDS',
        'focusBrandIds' => 'FOCUS_BRAND_IDS',
        'exportBrandCampaign.focusBrandIds' => 'FOCUS_BRAND_IDS',
        'ExportBrandCampaignTableMap::COL_FOCUS_BRAND_IDS' => 'FOCUS_BRAND_IDS',
        'COL_FOCUS_BRAND_IDS' => 'FOCUS_BRAND_IDS',
        'focus_brand_ids' => 'FOCUS_BRAND_IDS',
        'export_brand_campaign.focus_brand_ids' => 'FOCUS_BRAND_IDS',
        'CampaignStartDate' => 'CAMPAIGN_START_DATE',
        'ExportBrandCampaign.CampaignStartDate' => 'CAMPAIGN_START_DATE',
        'campaignStartDate' => 'CAMPAIGN_START_DATE',
        'exportBrandCampaign.campaignStartDate' => 'CAMPAIGN_START_DATE',
        'ExportBrandCampaignTableMap::COL_CAMPAIGN_START_DATE' => 'CAMPAIGN_START_DATE',
        'COL_CAMPAIGN_START_DATE' => 'CAMPAIGN_START_DATE',
        'campaign_start_date' => 'CAMPAIGN_START_DATE',
        'export_brand_campaign.campaign_start_date' => 'CAMPAIGN_START_DATE',
        'CampaignEndDate' => 'CAMPAIGN_END_DATE',
        'ExportBrandCampaign.CampaignEndDate' => 'CAMPAIGN_END_DATE',
        'campaignEndDate' => 'CAMPAIGN_END_DATE',
        'exportBrandCampaign.campaignEndDate' => 'CAMPAIGN_END_DATE',
        'ExportBrandCampaignTableMap::COL_CAMPAIGN_END_DATE' => 'CAMPAIGN_END_DATE',
        'COL_CAMPAIGN_END_DATE' => 'CAMPAIGN_END_DATE',
        'campaign_end_date' => 'CAMPAIGN_END_DATE',
        'export_brand_campaign.campaign_end_date' => 'CAMPAIGN_END_DATE',
        'OutletTags' => 'OUTLET_TAGS',
        'ExportBrandCampaign.OutletTags' => 'OUTLET_TAGS',
        'outletTags' => 'OUTLET_TAGS',
        'exportBrandCampaign.outletTags' => 'OUTLET_TAGS',
        'ExportBrandCampaignTableMap::COL_OUTLET_TAGS' => 'OUTLET_TAGS',
        'COL_OUTLET_TAGS' => 'OUTLET_TAGS',
        'outlet_tags' => 'OUTLET_TAGS',
        'export_brand_campaign.outlet_tags' => 'OUTLET_TAGS',
        'OutletName' => 'OUTLET_NAME',
        'ExportBrandCampaign.OutletName' => 'OUTLET_NAME',
        'outletName' => 'OUTLET_NAME',
        'exportBrandCampaign.outletName' => 'OUTLET_NAME',
        'ExportBrandCampaignTableMap::COL_OUTLET_NAME' => 'OUTLET_NAME',
        'COL_OUTLET_NAME' => 'OUTLET_NAME',
        'outlet_name' => 'OUTLET_NAME',
        'export_brand_campaign.outlet_name' => 'OUTLET_NAME',
        'OutletCode' => 'OUTLET_CODE',
        'ExportBrandCampaign.OutletCode' => 'OUTLET_CODE',
        'outletCode' => 'OUTLET_CODE',
        'exportBrandCampaign.outletCode' => 'OUTLET_CODE',
        'ExportBrandCampaignTableMap::COL_OUTLET_CODE' => 'OUTLET_CODE',
        'COL_OUTLET_CODE' => 'OUTLET_CODE',
        'outlet_code' => 'OUTLET_CODE',
        'export_brand_campaign.outlet_code' => 'OUTLET_CODE',
        'OutletOrgCode' => 'OUTLET_ORG_CODE',
        'ExportBrandCampaign.OutletOrgCode' => 'OUTLET_ORG_CODE',
        'outletOrgCode' => 'OUTLET_ORG_CODE',
        'exportBrandCampaign.outletOrgCode' => 'OUTLET_ORG_CODE',
        'ExportBrandCampaignTableMap::COL_OUTLET_ORG_CODE' => 'OUTLET_ORG_CODE',
        'COL_OUTLET_ORG_CODE' => 'OUTLET_ORG_CODE',
        'outlet_org_code' => 'OUTLET_ORG_CODE',
        'export_brand_campaign.outlet_org_code' => 'OUTLET_ORG_CODE',
        'OutletClassification' => 'OUTLET_CLASSIFICATION',
        'ExportBrandCampaign.OutletClassification' => 'OUTLET_CLASSIFICATION',
        'outletClassification' => 'OUTLET_CLASSIFICATION',
        'exportBrandCampaign.outletClassification' => 'OUTLET_CLASSIFICATION',
        'ExportBrandCampaignTableMap::COL_OUTLET_CLASSIFICATION' => 'OUTLET_CLASSIFICATION',
        'COL_OUTLET_CLASSIFICATION' => 'OUTLET_CLASSIFICATION',
        'outlet_classification' => 'OUTLET_CLASSIFICATION',
        'export_brand_campaign.outlet_classification' => 'OUTLET_CLASSIFICATION',
        'StepNumber' => 'STEP_NUMBER',
        'ExportBrandCampaign.StepNumber' => 'STEP_NUMBER',
        'stepNumber' => 'STEP_NUMBER',
        'exportBrandCampaign.stepNumber' => 'STEP_NUMBER',
        'ExportBrandCampaignTableMap::COL_STEP_NUMBER' => 'STEP_NUMBER',
        'COL_STEP_NUMBER' => 'STEP_NUMBER',
        'step_number' => 'STEP_NUMBER',
        'export_brand_campaign.step_number' => 'STEP_NUMBER',
        'SgpiToBeGiven' => 'SGPI_TO_BE_GIVEN',
        'ExportBrandCampaign.SgpiToBeGiven' => 'SGPI_TO_BE_GIVEN',
        'sgpiToBeGiven' => 'SGPI_TO_BE_GIVEN',
        'exportBrandCampaign.sgpiToBeGiven' => 'SGPI_TO_BE_GIVEN',
        'ExportBrandCampaignTableMap::COL_SGPI_TO_BE_GIVEN' => 'SGPI_TO_BE_GIVEN',
        'COL_SGPI_TO_BE_GIVEN' => 'SGPI_TO_BE_GIVEN',
        'sgpi_to_be_given' => 'SGPI_TO_BE_GIVEN',
        'export_brand_campaign.sgpi_to_be_given' => 'SGPI_TO_BE_GIVEN',
        'VisitedDate' => 'VISITED_DATE',
        'ExportBrandCampaign.VisitedDate' => 'VISITED_DATE',
        'visitedDate' => 'VISITED_DATE',
        'exportBrandCampaign.visitedDate' => 'VISITED_DATE',
        'ExportBrandCampaignTableMap::COL_VISITED_DATE' => 'VISITED_DATE',
        'COL_VISITED_DATE' => 'VISITED_DATE',
        'visited_date' => 'VISITED_DATE',
        'export_brand_campaign.visited_date' => 'VISITED_DATE',
        'VisitedMonth' => 'VISITED_MONTH',
        'ExportBrandCampaign.VisitedMonth' => 'VISITED_MONTH',
        'visitedMonth' => 'VISITED_MONTH',
        'exportBrandCampaign.visitedMonth' => 'VISITED_MONTH',
        'ExportBrandCampaignTableMap::COL_VISITED_MONTH' => 'VISITED_MONTH',
        'COL_VISITED_MONTH' => 'VISITED_MONTH',
        'visited_month' => 'VISITED_MONTH',
        'export_brand_campaign.visited_month' => 'VISITED_MONTH',
        'SgpiGiven' => 'SGPI_GIVEN',
        'ExportBrandCampaign.SgpiGiven' => 'SGPI_GIVEN',
        'sgpiGiven' => 'SGPI_GIVEN',
        'exportBrandCampaign.sgpiGiven' => 'SGPI_GIVEN',
        'ExportBrandCampaignTableMap::COL_SGPI_GIVEN' => 'SGPI_GIVEN',
        'COL_SGPI_GIVEN' => 'SGPI_GIVEN',
        'sgpi_given' => 'SGPI_GIVEN',
        'export_brand_campaign.sgpi_given' => 'SGPI_GIVEN',
        'ZmPositionCode' => 'ZM_POSITION_CODE',
        'ExportBrandCampaign.ZmPositionCode' => 'ZM_POSITION_CODE',
        'zmPositionCode' => 'ZM_POSITION_CODE',
        'exportBrandCampaign.zmPositionCode' => 'ZM_POSITION_CODE',
        'ExportBrandCampaignTableMap::COL_ZM_POSITION_CODE' => 'ZM_POSITION_CODE',
        'COL_ZM_POSITION_CODE' => 'ZM_POSITION_CODE',
        'zm_position_code' => 'ZM_POSITION_CODE',
        'export_brand_campaign.zm_position_code' => 'ZM_POSITION_CODE',
        'RmPositionCode' => 'RM_POSITION_CODE',
        'ExportBrandCampaign.RmPositionCode' => 'RM_POSITION_CODE',
        'rmPositionCode' => 'RM_POSITION_CODE',
        'exportBrandCampaign.rmPositionCode' => 'RM_POSITION_CODE',
        'ExportBrandCampaignTableMap::COL_RM_POSITION_CODE' => 'RM_POSITION_CODE',
        'COL_RM_POSITION_CODE' => 'RM_POSITION_CODE',
        'rm_position_code' => 'RM_POSITION_CODE',
        'export_brand_campaign.rm_position_code' => 'RM_POSITION_CODE',
        'AmPositionCode' => 'AM_POSITION_CODE',
        'ExportBrandCampaign.AmPositionCode' => 'AM_POSITION_CODE',
        'amPositionCode' => 'AM_POSITION_CODE',
        'exportBrandCampaign.amPositionCode' => 'AM_POSITION_CODE',
        'ExportBrandCampaignTableMap::COL_AM_POSITION_CODE' => 'AM_POSITION_CODE',
        'COL_AM_POSITION_CODE' => 'AM_POSITION_CODE',
        'am_position_code' => 'AM_POSITION_CODE',
        'export_brand_campaign.am_position_code' => 'AM_POSITION_CODE',
        'EmpPositionCode' => 'EMP_POSITION_CODE',
        'ExportBrandCampaign.EmpPositionCode' => 'EMP_POSITION_CODE',
        'empPositionCode' => 'EMP_POSITION_CODE',
        'exportBrandCampaign.empPositionCode' => 'EMP_POSITION_CODE',
        'ExportBrandCampaignTableMap::COL_EMP_POSITION_CODE' => 'EMP_POSITION_CODE',
        'COL_EMP_POSITION_CODE' => 'EMP_POSITION_CODE',
        'emp_position_code' => 'EMP_POSITION_CODE',
        'export_brand_campaign.emp_position_code' => 'EMP_POSITION_CODE',
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
        $this->setName('export_brand_campaign');
        $this->setPhpName('ExportBrandCampaign');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\ExportBrandCampaign');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('brand_campiagn_visit_id', 'BrandCampiagnVisitId', 'INTEGER', true, null, null);
        $this->addColumn('brand_campiagn_id', 'BrandCampiagnId', 'INTEGER', false, null, null);
        $this->addColumn('brand_campiagn_visit_plan_id', 'BrandCampiagnVisitPlanId', 'INTEGER', false, null, null);
        $this->addColumn('outlet_org_data_id', 'OutletOrgDataId', 'INTEGER', false, null, null);
        $this->addColumn('dcr_id', 'DcrId', 'INTEGER', false, null, null);
        $this->addColumn('bu_name', 'BuName', 'VARCHAR', false, null, null);
        $this->addColumn('zm_manager_branch', 'ZmManagerBranch', 'VARCHAR', false, null, null);
        $this->addColumn('zm_manager_town', 'ZmManagerTown', 'VARCHAR', false, null, null);
        $this->addColumn('rm_manager_branch', 'RmManagerBranch', 'VARCHAR', false, null, null);
        $this->addColumn('rm_manager_town', 'RmManagerTown', 'VARCHAR', false, null, null);
        $this->addColumn('am_manager_branch', 'AmManagerBranch', 'VARCHAR', false, null, null);
        $this->addColumn('am_manager_town', 'AmManagerTown', 'VARCHAR', false, null, null);
        $this->addColumn('emp_position_name', 'EmpPositionName', 'VARCHAR', false, null, null);
        $this->addColumn('emp_branch', 'EmpBranch', 'VARCHAR', false, null, null);
        $this->addColumn('emp_level', 'EmpLevel', 'VARCHAR', false, null, null);
        $this->addColumn('employee_code', 'EmployeeCode', 'VARCHAR', false, null, null);
        $this->addColumn('employee_name', 'EmployeeName', 'VARCHAR', false, null, null);
        $this->addColumn('ed_duration', 'EdDuration', 'INTEGER', false, null, null);
        $this->addColumn('campiagn_name', 'CampiagnName', 'VARCHAR', false, null, null);
        $this->addColumn('focus_brands', 'FocusBrands', 'VARCHAR', false, null, null);
        $this->addColumn('focus_brand_ids', 'FocusBrandIds', 'VARCHAR', false, null, null);
        $this->addColumn('campaign_start_date', 'CampaignStartDate', 'DATE', false, null, null);
        $this->addColumn('campaign_end_date', 'CampaignEndDate', 'DATE', false, null, null);
        $this->addColumn('outlet_tags', 'OutletTags', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_name', 'OutletName', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_code', 'OutletCode', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_org_code', 'OutletOrgCode', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_classification', 'OutletClassification', 'VARCHAR', false, null, null);
        $this->addColumn('step_number', 'StepNumber', 'INTEGER', false, null, null);
        $this->addColumn('sgpi_to_be_given', 'SgpiToBeGiven', 'VARCHAR', false, null, null);
        $this->addColumn('visited_date', 'VisitedDate', 'DATE', false, null, null);
        $this->addColumn('visited_month', 'VisitedMonth', 'VARCHAR', false, null, null);
        $this->addColumn('sgpi_given', 'SgpiGiven', 'VARCHAR', false, null, null);
        $this->addColumn('zm_position_code', 'ZmPositionCode', 'VARCHAR', false, null, null);
        $this->addColumn('rm_position_code', 'RmPositionCode', 'VARCHAR', false, null, null);
        $this->addColumn('am_position_code', 'AmPositionCode', 'VARCHAR', false, null, null);
        $this->addColumn('emp_position_code', 'EmpPositionCode', 'VARCHAR', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnVisitId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnVisitId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnVisitId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnVisitId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnVisitId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BrandCampiagnVisitId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('BrandCampiagnVisitId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ExportBrandCampaignTableMap::CLASS_DEFAULT : ExportBrandCampaignTableMap::OM_CLASS;
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
     * @return array (ExportBrandCampaign object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ExportBrandCampaignTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ExportBrandCampaignTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ExportBrandCampaignTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ExportBrandCampaignTableMap::OM_CLASS;
            /** @var ExportBrandCampaign $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ExportBrandCampaignTableMap::addInstanceToPool($obj, $key);
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
            $key = ExportBrandCampaignTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ExportBrandCampaignTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ExportBrandCampaign $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ExportBrandCampaignTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_VISIT_ID);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_ID);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_OUTLET_ORG_DATA_ID);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_DCR_ID);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_BU_NAME);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_ZM_MANAGER_BRANCH);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_ZM_MANAGER_TOWN);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_RM_MANAGER_BRANCH);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_RM_MANAGER_TOWN);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_AM_MANAGER_BRANCH);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_AM_MANAGER_TOWN);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_EMP_POSITION_NAME);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_EMP_BRANCH);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_EMP_LEVEL);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_EMPLOYEE_CODE);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_EMPLOYEE_NAME);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_ED_DURATION);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_CAMPIAGN_NAME);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_FOCUS_BRANDS);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_FOCUS_BRAND_IDS);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_CAMPAIGN_START_DATE);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_CAMPAIGN_END_DATE);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_OUTLET_TAGS);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_OUTLET_NAME);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_OUTLET_CODE);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_OUTLET_ORG_CODE);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_OUTLET_CLASSIFICATION);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_STEP_NUMBER);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_SGPI_TO_BE_GIVEN);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_VISITED_DATE);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_VISITED_MONTH);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_SGPI_GIVEN);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_ZM_POSITION_CODE);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_RM_POSITION_CODE);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_AM_POSITION_CODE);
            $criteria->addSelectColumn(ExportBrandCampaignTableMap::COL_EMP_POSITION_CODE);
        } else {
            $criteria->addSelectColumn($alias . '.brand_campiagn_visit_id');
            $criteria->addSelectColumn($alias . '.brand_campiagn_id');
            $criteria->addSelectColumn($alias . '.brand_campiagn_visit_plan_id');
            $criteria->addSelectColumn($alias . '.outlet_org_data_id');
            $criteria->addSelectColumn($alias . '.dcr_id');
            $criteria->addSelectColumn($alias . '.bu_name');
            $criteria->addSelectColumn($alias . '.zm_manager_branch');
            $criteria->addSelectColumn($alias . '.zm_manager_town');
            $criteria->addSelectColumn($alias . '.rm_manager_branch');
            $criteria->addSelectColumn($alias . '.rm_manager_town');
            $criteria->addSelectColumn($alias . '.am_manager_branch');
            $criteria->addSelectColumn($alias . '.am_manager_town');
            $criteria->addSelectColumn($alias . '.emp_position_name');
            $criteria->addSelectColumn($alias . '.emp_branch');
            $criteria->addSelectColumn($alias . '.emp_level');
            $criteria->addSelectColumn($alias . '.employee_code');
            $criteria->addSelectColumn($alias . '.employee_name');
            $criteria->addSelectColumn($alias . '.ed_duration');
            $criteria->addSelectColumn($alias . '.campiagn_name');
            $criteria->addSelectColumn($alias . '.focus_brands');
            $criteria->addSelectColumn($alias . '.focus_brand_ids');
            $criteria->addSelectColumn($alias . '.campaign_start_date');
            $criteria->addSelectColumn($alias . '.campaign_end_date');
            $criteria->addSelectColumn($alias . '.outlet_tags');
            $criteria->addSelectColumn($alias . '.outlet_name');
            $criteria->addSelectColumn($alias . '.outlet_code');
            $criteria->addSelectColumn($alias . '.outlet_org_code');
            $criteria->addSelectColumn($alias . '.outlet_classification');
            $criteria->addSelectColumn($alias . '.step_number');
            $criteria->addSelectColumn($alias . '.sgpi_to_be_given');
            $criteria->addSelectColumn($alias . '.visited_date');
            $criteria->addSelectColumn($alias . '.visited_month');
            $criteria->addSelectColumn($alias . '.sgpi_given');
            $criteria->addSelectColumn($alias . '.zm_position_code');
            $criteria->addSelectColumn($alias . '.rm_position_code');
            $criteria->addSelectColumn($alias . '.am_position_code');
            $criteria->addSelectColumn($alias . '.emp_position_code');
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
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_VISIT_ID);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_ID);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_VISIT_PLAN_ID);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_OUTLET_ORG_DATA_ID);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_DCR_ID);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_BU_NAME);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_ZM_MANAGER_BRANCH);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_ZM_MANAGER_TOWN);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_RM_MANAGER_BRANCH);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_RM_MANAGER_TOWN);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_AM_MANAGER_BRANCH);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_AM_MANAGER_TOWN);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_EMP_POSITION_NAME);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_EMP_BRANCH);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_EMP_LEVEL);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_EMPLOYEE_CODE);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_EMPLOYEE_NAME);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_ED_DURATION);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_CAMPIAGN_NAME);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_FOCUS_BRANDS);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_FOCUS_BRAND_IDS);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_CAMPAIGN_START_DATE);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_CAMPAIGN_END_DATE);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_OUTLET_TAGS);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_OUTLET_NAME);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_OUTLET_CODE);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_OUTLET_ORG_CODE);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_OUTLET_CLASSIFICATION);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_STEP_NUMBER);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_SGPI_TO_BE_GIVEN);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_VISITED_DATE);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_VISITED_MONTH);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_SGPI_GIVEN);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_ZM_POSITION_CODE);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_RM_POSITION_CODE);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_AM_POSITION_CODE);
            $criteria->removeSelectColumn(ExportBrandCampaignTableMap::COL_EMP_POSITION_CODE);
        } else {
            $criteria->removeSelectColumn($alias . '.brand_campiagn_visit_id');
            $criteria->removeSelectColumn($alias . '.brand_campiagn_id');
            $criteria->removeSelectColumn($alias . '.brand_campiagn_visit_plan_id');
            $criteria->removeSelectColumn($alias . '.outlet_org_data_id');
            $criteria->removeSelectColumn($alias . '.dcr_id');
            $criteria->removeSelectColumn($alias . '.bu_name');
            $criteria->removeSelectColumn($alias . '.zm_manager_branch');
            $criteria->removeSelectColumn($alias . '.zm_manager_town');
            $criteria->removeSelectColumn($alias . '.rm_manager_branch');
            $criteria->removeSelectColumn($alias . '.rm_manager_town');
            $criteria->removeSelectColumn($alias . '.am_manager_branch');
            $criteria->removeSelectColumn($alias . '.am_manager_town');
            $criteria->removeSelectColumn($alias . '.emp_position_name');
            $criteria->removeSelectColumn($alias . '.emp_branch');
            $criteria->removeSelectColumn($alias . '.emp_level');
            $criteria->removeSelectColumn($alias . '.employee_code');
            $criteria->removeSelectColumn($alias . '.employee_name');
            $criteria->removeSelectColumn($alias . '.ed_duration');
            $criteria->removeSelectColumn($alias . '.campiagn_name');
            $criteria->removeSelectColumn($alias . '.focus_brands');
            $criteria->removeSelectColumn($alias . '.focus_brand_ids');
            $criteria->removeSelectColumn($alias . '.campaign_start_date');
            $criteria->removeSelectColumn($alias . '.campaign_end_date');
            $criteria->removeSelectColumn($alias . '.outlet_tags');
            $criteria->removeSelectColumn($alias . '.outlet_name');
            $criteria->removeSelectColumn($alias . '.outlet_code');
            $criteria->removeSelectColumn($alias . '.outlet_org_code');
            $criteria->removeSelectColumn($alias . '.outlet_classification');
            $criteria->removeSelectColumn($alias . '.step_number');
            $criteria->removeSelectColumn($alias . '.sgpi_to_be_given');
            $criteria->removeSelectColumn($alias . '.visited_date');
            $criteria->removeSelectColumn($alias . '.visited_month');
            $criteria->removeSelectColumn($alias . '.sgpi_given');
            $criteria->removeSelectColumn($alias . '.zm_position_code');
            $criteria->removeSelectColumn($alias . '.rm_position_code');
            $criteria->removeSelectColumn($alias . '.am_position_code');
            $criteria->removeSelectColumn($alias . '.emp_position_code');
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
        return Propel::getServiceContainer()->getDatabaseMap(ExportBrandCampaignTableMap::DATABASE_NAME)->getTable(ExportBrandCampaignTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a ExportBrandCampaign or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or ExportBrandCampaign object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ExportBrandCampaignTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\ExportBrandCampaign) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ExportBrandCampaignTableMap::DATABASE_NAME);
            $criteria->add(ExportBrandCampaignTableMap::COL_BRAND_CAMPIAGN_VISIT_ID, (array) $values, Criteria::IN);
        }

        $query = ExportBrandCampaignQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ExportBrandCampaignTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ExportBrandCampaignTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the export_brand_campaign table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ExportBrandCampaignQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ExportBrandCampaign or Criteria object.
     *
     * @param mixed $criteria Criteria or ExportBrandCampaign object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExportBrandCampaignTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ExportBrandCampaign object
        }


        // Set the correct dbName
        $query = ExportBrandCampaignQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
