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
use entities\ExportSgpiOut;
use entities\ExportSgpiOutQuery;


/**
 * This class defines the structure of the 'export_sgpi_out' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ExportSgpiOutTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.ExportSgpiOutTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'export_sgpi_out';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'ExportSgpiOut';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\ExportSgpiOut';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.ExportSgpiOut';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 45;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 45;

    /**
     * the column name for the sgpi_voucher_id field
     */
    public const COL_SGPI_VOUCHER_ID = 'export_sgpi_out.sgpi_voucher_id';

    /**
     * the column name for the bu_name field
     */
    public const COL_BU_NAME = 'export_sgpi_out.bu_name';

    /**
     * the column name for the zm_manager_branch field
     */
    public const COL_ZM_MANAGER_BRANCH = 'export_sgpi_out.zm_manager_branch';

    /**
     * the column name for the zm_manager_town field
     */
    public const COL_ZM_MANAGER_TOWN = 'export_sgpi_out.zm_manager_town';

    /**
     * the column name for the rm_manager_branch field
     */
    public const COL_RM_MANAGER_BRANCH = 'export_sgpi_out.rm_manager_branch';

    /**
     * the column name for the rm_manager_town field
     */
    public const COL_RM_MANAGER_TOWN = 'export_sgpi_out.rm_manager_town';

    /**
     * the column name for the am_manager_branch field
     */
    public const COL_AM_MANAGER_BRANCH = 'export_sgpi_out.am_manager_branch';

    /**
     * the column name for the am_manager_town field
     */
    public const COL_AM_MANAGER_TOWN = 'export_sgpi_out.am_manager_town';

    /**
     * the column name for the zm_position_code field
     */
    public const COL_ZM_POSITION_CODE = 'export_sgpi_out.zm_position_code';

    /**
     * the column name for the rm_position_code field
     */
    public const COL_RM_POSITION_CODE = 'export_sgpi_out.rm_position_code';

    /**
     * the column name for the am_position_code field
     */
    public const COL_AM_POSITION_CODE = 'export_sgpi_out.am_position_code';

    /**
     * the column name for the emp_position_code field
     */
    public const COL_EMP_POSITION_CODE = 'export_sgpi_out.emp_position_code';

    /**
     * the column name for the emp_position_name field
     */
    public const COL_EMP_POSITION_NAME = 'export_sgpi_out.emp_position_name';

    /**
     * the column name for the emp_level field
     */
    public const COL_EMP_LEVEL = 'export_sgpi_out.emp_level';

    /**
     * the column name for the employee_code field
     */
    public const COL_EMPLOYEE_CODE = 'export_sgpi_out.employee_code';

    /**
     * the column name for the employee_name field
     */
    public const COL_EMPLOYEE_NAME = 'export_sgpi_out.employee_name';

    /**
     * the column name for the outlet_code field
     */
    public const COL_OUTLET_CODE = 'export_sgpi_out.outlet_code';

    /**
     * the column name for the brand_focus field
     */
    public const COL_BRAND_FOCUS = 'export_sgpi_out.brand_focus';

    /**
     * the column name for the outlet_org_id field
     */
    public const COL_OUTLET_ORG_ID = 'export_sgpi_out.outlet_org_id';

    /**
     * the column name for the org_unit_id field
     */
    public const COL_ORG_UNIT_ID = 'export_sgpi_out.org_unit_id';

    /**
     * the column name for the territory_id field
     */
    public const COL_TERRITORY_ID = 'export_sgpi_out.territory_id';

    /**
     * the column name for the territory_name field
     */
    public const COL_TERRITORY_NAME = 'export_sgpi_out.territory_name';

    /**
     * the column name for the beat_id field
     */
    public const COL_BEAT_ID = 'export_sgpi_out.beat_id';

    /**
     * the column name for the beat_name field
     */
    public const COL_BEAT_NAME = 'export_sgpi_out.beat_name';

    /**
     * the column name for the tags field
     */
    public const COL_TAGS = 'export_sgpi_out.tags';

    /**
     * the column name for the visit_fq field
     */
    public const COL_VISIT_FQ = 'export_sgpi_out.visit_fq';

    /**
     * the column name for the outlet_salutation field
     */
    public const COL_OUTLET_SALUTATION = 'export_sgpi_out.outlet_salutation';

    /**
     * the column name for the outlet_name field
     */
    public const COL_OUTLET_NAME = 'export_sgpi_out.outlet_name';

    /**
     * the column name for the classification field
     */
    public const COL_CLASSIFICATION = 'export_sgpi_out.classification';

    /**
     * the column name for the outlettype_name field
     */
    public const COL_OUTLETTYPE_NAME = 'export_sgpi_out.outlettype_name';

    /**
     * the column name for the sgpi_name field
     */
    public const COL_SGPI_NAME = 'export_sgpi_out.sgpi_name';

    /**
     * the column name for the sgpi_code field
     */
    public const COL_SGPI_CODE = 'export_sgpi_out.sgpi_code';

    /**
     * the column name for the material_sku field
     */
    public const COL_MATERIAL_SKU = 'export_sgpi_out.material_sku';

    /**
     * the column name for the sgpi_type field
     */
    public const COL_SGPI_TYPE = 'export_sgpi_out.sgpi_type';

    /**
     * the column name for the sgpi_qty field
     */
    public const COL_SGPI_QTY = 'export_sgpi_out.sgpi_qty';

    /**
     * the column name for the dcr_id field
     */
    public const COL_DCR_ID = 'export_sgpi_out.dcr_id';

    /**
     * the column name for the dcr_date field
     */
    public const COL_DCR_DATE = 'export_sgpi_out.dcr_date';

    /**
     * the column name for the brand_name field
     */
    public const COL_BRAND_NAME = 'export_sgpi_out.brand_name';

    /**
     * the column name for the device_time field
     */
    public const COL_DEVICE_TIME = 'export_sgpi_out.device_time';

    /**
     * the column name for the managers field
     */
    public const COL_MANAGERS = 'export_sgpi_out.managers';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'export_sgpi_out.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'export_sgpi_out.updated_at';

    /**
     * the column name for the emp_territory field
     */
    public const COL_EMP_TERRITORY = 'export_sgpi_out.emp_territory';

    /**
     * the column name for the emp_branch field
     */
    public const COL_EMP_BRANCH = 'export_sgpi_out.emp_branch';

    /**
     * the column name for the emp_town field
     */
    public const COL_EMP_TOWN = 'export_sgpi_out.emp_town';

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
        self::TYPE_PHPNAME       => ['SgpiVoucherId', 'BuName', 'ZmManagerBranch', 'ZmManagerTown', 'RmManagerBranch', 'RmManagerTown', 'AmManagerBranch', 'AmManagerTown', 'ZmPositionCode', 'RmPositionCode', 'AmPositionCode', 'EmpPositionCode', 'EmpPositionName', 'EmpLevel', 'EmployeeCode', 'EmployeeName', 'OutletCode', 'BrandFocus', 'OutletOrgId', 'OrgUnitId', 'TerritoryId', 'TerritoryName', 'BeatId', 'BeatName', 'Tags', 'VisitFq', 'OutletSalutation', 'OutletName', 'Classification', 'OutlettypeName', 'SgpiName', 'SgpiCode', 'MaterialSku', 'SgpiType', 'SgpiQty', 'DcrId', 'DcrDate', 'BrandName', 'DeviceTime', 'Managers', 'CreatedAt', 'UpdatedAt', 'EmpTerritory', 'EmpBranch', 'EmpTown', ],
        self::TYPE_CAMELNAME     => ['sgpiVoucherId', 'buName', 'zmManagerBranch', 'zmManagerTown', 'rmManagerBranch', 'rmManagerTown', 'amManagerBranch', 'amManagerTown', 'zmPositionCode', 'rmPositionCode', 'amPositionCode', 'empPositionCode', 'empPositionName', 'empLevel', 'employeeCode', 'employeeName', 'outletCode', 'brandFocus', 'outletOrgId', 'orgUnitId', 'territoryId', 'territoryName', 'beatId', 'beatName', 'tags', 'visitFq', 'outletSalutation', 'outletName', 'classification', 'outlettypeName', 'sgpiName', 'sgpiCode', 'materialSku', 'sgpiType', 'sgpiQty', 'dcrId', 'dcrDate', 'brandName', 'deviceTime', 'managers', 'createdAt', 'updatedAt', 'empTerritory', 'empBranch', 'empTown', ],
        self::TYPE_COLNAME       => [ExportSgpiOutTableMap::COL_SGPI_VOUCHER_ID, ExportSgpiOutTableMap::COL_BU_NAME, ExportSgpiOutTableMap::COL_ZM_MANAGER_BRANCH, ExportSgpiOutTableMap::COL_ZM_MANAGER_TOWN, ExportSgpiOutTableMap::COL_RM_MANAGER_BRANCH, ExportSgpiOutTableMap::COL_RM_MANAGER_TOWN, ExportSgpiOutTableMap::COL_AM_MANAGER_BRANCH, ExportSgpiOutTableMap::COL_AM_MANAGER_TOWN, ExportSgpiOutTableMap::COL_ZM_POSITION_CODE, ExportSgpiOutTableMap::COL_RM_POSITION_CODE, ExportSgpiOutTableMap::COL_AM_POSITION_CODE, ExportSgpiOutTableMap::COL_EMP_POSITION_CODE, ExportSgpiOutTableMap::COL_EMP_POSITION_NAME, ExportSgpiOutTableMap::COL_EMP_LEVEL, ExportSgpiOutTableMap::COL_EMPLOYEE_CODE, ExportSgpiOutTableMap::COL_EMPLOYEE_NAME, ExportSgpiOutTableMap::COL_OUTLET_CODE, ExportSgpiOutTableMap::COL_BRAND_FOCUS, ExportSgpiOutTableMap::COL_OUTLET_ORG_ID, ExportSgpiOutTableMap::COL_ORG_UNIT_ID, ExportSgpiOutTableMap::COL_TERRITORY_ID, ExportSgpiOutTableMap::COL_TERRITORY_NAME, ExportSgpiOutTableMap::COL_BEAT_ID, ExportSgpiOutTableMap::COL_BEAT_NAME, ExportSgpiOutTableMap::COL_TAGS, ExportSgpiOutTableMap::COL_VISIT_FQ, ExportSgpiOutTableMap::COL_OUTLET_SALUTATION, ExportSgpiOutTableMap::COL_OUTLET_NAME, ExportSgpiOutTableMap::COL_CLASSIFICATION, ExportSgpiOutTableMap::COL_OUTLETTYPE_NAME, ExportSgpiOutTableMap::COL_SGPI_NAME, ExportSgpiOutTableMap::COL_SGPI_CODE, ExportSgpiOutTableMap::COL_MATERIAL_SKU, ExportSgpiOutTableMap::COL_SGPI_TYPE, ExportSgpiOutTableMap::COL_SGPI_QTY, ExportSgpiOutTableMap::COL_DCR_ID, ExportSgpiOutTableMap::COL_DCR_DATE, ExportSgpiOutTableMap::COL_BRAND_NAME, ExportSgpiOutTableMap::COL_DEVICE_TIME, ExportSgpiOutTableMap::COL_MANAGERS, ExportSgpiOutTableMap::COL_CREATED_AT, ExportSgpiOutTableMap::COL_UPDATED_AT, ExportSgpiOutTableMap::COL_EMP_TERRITORY, ExportSgpiOutTableMap::COL_EMP_BRANCH, ExportSgpiOutTableMap::COL_EMP_TOWN, ],
        self::TYPE_FIELDNAME     => ['sgpi_voucher_id', 'bu_name', 'zm_manager_branch', 'zm_manager_town', 'rm_manager_branch', 'rm_manager_town', 'am_manager_branch', 'am_manager_town', 'zm_position_code', 'rm_position_code', 'am_position_code', 'emp_position_code', 'emp_position_name', 'emp_level', 'employee_code', 'employee_name', 'outlet_code', 'brand_focus', 'outlet_org_id', 'org_unit_id', 'territory_id', 'territory_name', 'beat_id', 'beat_name', 'tags', 'visit_fq', 'outlet_salutation', 'outlet_name', 'classification', 'outlettype_name', 'sgpi_name', 'sgpi_code', 'material_sku', 'sgpi_type', 'sgpi_qty', 'dcr_id', 'dcr_date', 'brand_name', 'device_time', 'managers', 'created_at', 'updated_at', 'emp_territory', 'emp_branch', 'emp_town', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, ]
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
        self::TYPE_PHPNAME       => ['SgpiVoucherId' => 0, 'BuName' => 1, 'ZmManagerBranch' => 2, 'ZmManagerTown' => 3, 'RmManagerBranch' => 4, 'RmManagerTown' => 5, 'AmManagerBranch' => 6, 'AmManagerTown' => 7, 'ZmPositionCode' => 8, 'RmPositionCode' => 9, 'AmPositionCode' => 10, 'EmpPositionCode' => 11, 'EmpPositionName' => 12, 'EmpLevel' => 13, 'EmployeeCode' => 14, 'EmployeeName' => 15, 'OutletCode' => 16, 'BrandFocus' => 17, 'OutletOrgId' => 18, 'OrgUnitId' => 19, 'TerritoryId' => 20, 'TerritoryName' => 21, 'BeatId' => 22, 'BeatName' => 23, 'Tags' => 24, 'VisitFq' => 25, 'OutletSalutation' => 26, 'OutletName' => 27, 'Classification' => 28, 'OutlettypeName' => 29, 'SgpiName' => 30, 'SgpiCode' => 31, 'MaterialSku' => 32, 'SgpiType' => 33, 'SgpiQty' => 34, 'DcrId' => 35, 'DcrDate' => 36, 'BrandName' => 37, 'DeviceTime' => 38, 'Managers' => 39, 'CreatedAt' => 40, 'UpdatedAt' => 41, 'EmpTerritory' => 42, 'EmpBranch' => 43, 'EmpTown' => 44, ],
        self::TYPE_CAMELNAME     => ['sgpiVoucherId' => 0, 'buName' => 1, 'zmManagerBranch' => 2, 'zmManagerTown' => 3, 'rmManagerBranch' => 4, 'rmManagerTown' => 5, 'amManagerBranch' => 6, 'amManagerTown' => 7, 'zmPositionCode' => 8, 'rmPositionCode' => 9, 'amPositionCode' => 10, 'empPositionCode' => 11, 'empPositionName' => 12, 'empLevel' => 13, 'employeeCode' => 14, 'employeeName' => 15, 'outletCode' => 16, 'brandFocus' => 17, 'outletOrgId' => 18, 'orgUnitId' => 19, 'territoryId' => 20, 'territoryName' => 21, 'beatId' => 22, 'beatName' => 23, 'tags' => 24, 'visitFq' => 25, 'outletSalutation' => 26, 'outletName' => 27, 'classification' => 28, 'outlettypeName' => 29, 'sgpiName' => 30, 'sgpiCode' => 31, 'materialSku' => 32, 'sgpiType' => 33, 'sgpiQty' => 34, 'dcrId' => 35, 'dcrDate' => 36, 'brandName' => 37, 'deviceTime' => 38, 'managers' => 39, 'createdAt' => 40, 'updatedAt' => 41, 'empTerritory' => 42, 'empBranch' => 43, 'empTown' => 44, ],
        self::TYPE_COLNAME       => [ExportSgpiOutTableMap::COL_SGPI_VOUCHER_ID => 0, ExportSgpiOutTableMap::COL_BU_NAME => 1, ExportSgpiOutTableMap::COL_ZM_MANAGER_BRANCH => 2, ExportSgpiOutTableMap::COL_ZM_MANAGER_TOWN => 3, ExportSgpiOutTableMap::COL_RM_MANAGER_BRANCH => 4, ExportSgpiOutTableMap::COL_RM_MANAGER_TOWN => 5, ExportSgpiOutTableMap::COL_AM_MANAGER_BRANCH => 6, ExportSgpiOutTableMap::COL_AM_MANAGER_TOWN => 7, ExportSgpiOutTableMap::COL_ZM_POSITION_CODE => 8, ExportSgpiOutTableMap::COL_RM_POSITION_CODE => 9, ExportSgpiOutTableMap::COL_AM_POSITION_CODE => 10, ExportSgpiOutTableMap::COL_EMP_POSITION_CODE => 11, ExportSgpiOutTableMap::COL_EMP_POSITION_NAME => 12, ExportSgpiOutTableMap::COL_EMP_LEVEL => 13, ExportSgpiOutTableMap::COL_EMPLOYEE_CODE => 14, ExportSgpiOutTableMap::COL_EMPLOYEE_NAME => 15, ExportSgpiOutTableMap::COL_OUTLET_CODE => 16, ExportSgpiOutTableMap::COL_BRAND_FOCUS => 17, ExportSgpiOutTableMap::COL_OUTLET_ORG_ID => 18, ExportSgpiOutTableMap::COL_ORG_UNIT_ID => 19, ExportSgpiOutTableMap::COL_TERRITORY_ID => 20, ExportSgpiOutTableMap::COL_TERRITORY_NAME => 21, ExportSgpiOutTableMap::COL_BEAT_ID => 22, ExportSgpiOutTableMap::COL_BEAT_NAME => 23, ExportSgpiOutTableMap::COL_TAGS => 24, ExportSgpiOutTableMap::COL_VISIT_FQ => 25, ExportSgpiOutTableMap::COL_OUTLET_SALUTATION => 26, ExportSgpiOutTableMap::COL_OUTLET_NAME => 27, ExportSgpiOutTableMap::COL_CLASSIFICATION => 28, ExportSgpiOutTableMap::COL_OUTLETTYPE_NAME => 29, ExportSgpiOutTableMap::COL_SGPI_NAME => 30, ExportSgpiOutTableMap::COL_SGPI_CODE => 31, ExportSgpiOutTableMap::COL_MATERIAL_SKU => 32, ExportSgpiOutTableMap::COL_SGPI_TYPE => 33, ExportSgpiOutTableMap::COL_SGPI_QTY => 34, ExportSgpiOutTableMap::COL_DCR_ID => 35, ExportSgpiOutTableMap::COL_DCR_DATE => 36, ExportSgpiOutTableMap::COL_BRAND_NAME => 37, ExportSgpiOutTableMap::COL_DEVICE_TIME => 38, ExportSgpiOutTableMap::COL_MANAGERS => 39, ExportSgpiOutTableMap::COL_CREATED_AT => 40, ExportSgpiOutTableMap::COL_UPDATED_AT => 41, ExportSgpiOutTableMap::COL_EMP_TERRITORY => 42, ExportSgpiOutTableMap::COL_EMP_BRANCH => 43, ExportSgpiOutTableMap::COL_EMP_TOWN => 44, ],
        self::TYPE_FIELDNAME     => ['sgpi_voucher_id' => 0, 'bu_name' => 1, 'zm_manager_branch' => 2, 'zm_manager_town' => 3, 'rm_manager_branch' => 4, 'rm_manager_town' => 5, 'am_manager_branch' => 6, 'am_manager_town' => 7, 'zm_position_code' => 8, 'rm_position_code' => 9, 'am_position_code' => 10, 'emp_position_code' => 11, 'emp_position_name' => 12, 'emp_level' => 13, 'employee_code' => 14, 'employee_name' => 15, 'outlet_code' => 16, 'brand_focus' => 17, 'outlet_org_id' => 18, 'org_unit_id' => 19, 'territory_id' => 20, 'territory_name' => 21, 'beat_id' => 22, 'beat_name' => 23, 'tags' => 24, 'visit_fq' => 25, 'outlet_salutation' => 26, 'outlet_name' => 27, 'classification' => 28, 'outlettype_name' => 29, 'sgpi_name' => 30, 'sgpi_code' => 31, 'material_sku' => 32, 'sgpi_type' => 33, 'sgpi_qty' => 34, 'dcr_id' => 35, 'dcr_date' => 36, 'brand_name' => 37, 'device_time' => 38, 'managers' => 39, 'created_at' => 40, 'updated_at' => 41, 'emp_territory' => 42, 'emp_branch' => 43, 'emp_town' => 44, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'SgpiVoucherId' => 'SGPI_VOUCHER_ID',
        'ExportSgpiOut.SgpiVoucherId' => 'SGPI_VOUCHER_ID',
        'sgpiVoucherId' => 'SGPI_VOUCHER_ID',
        'exportSgpiOut.sgpiVoucherId' => 'SGPI_VOUCHER_ID',
        'ExportSgpiOutTableMap::COL_SGPI_VOUCHER_ID' => 'SGPI_VOUCHER_ID',
        'COL_SGPI_VOUCHER_ID' => 'SGPI_VOUCHER_ID',
        'sgpi_voucher_id' => 'SGPI_VOUCHER_ID',
        'export_sgpi_out.sgpi_voucher_id' => 'SGPI_VOUCHER_ID',
        'BuName' => 'BU_NAME',
        'ExportSgpiOut.BuName' => 'BU_NAME',
        'buName' => 'BU_NAME',
        'exportSgpiOut.buName' => 'BU_NAME',
        'ExportSgpiOutTableMap::COL_BU_NAME' => 'BU_NAME',
        'COL_BU_NAME' => 'BU_NAME',
        'bu_name' => 'BU_NAME',
        'export_sgpi_out.bu_name' => 'BU_NAME',
        'ZmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'ExportSgpiOut.ZmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'zmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'exportSgpiOut.zmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'ExportSgpiOutTableMap::COL_ZM_MANAGER_BRANCH' => 'ZM_MANAGER_BRANCH',
        'COL_ZM_MANAGER_BRANCH' => 'ZM_MANAGER_BRANCH',
        'zm_manager_branch' => 'ZM_MANAGER_BRANCH',
        'export_sgpi_out.zm_manager_branch' => 'ZM_MANAGER_BRANCH',
        'ZmManagerTown' => 'ZM_MANAGER_TOWN',
        'ExportSgpiOut.ZmManagerTown' => 'ZM_MANAGER_TOWN',
        'zmManagerTown' => 'ZM_MANAGER_TOWN',
        'exportSgpiOut.zmManagerTown' => 'ZM_MANAGER_TOWN',
        'ExportSgpiOutTableMap::COL_ZM_MANAGER_TOWN' => 'ZM_MANAGER_TOWN',
        'COL_ZM_MANAGER_TOWN' => 'ZM_MANAGER_TOWN',
        'zm_manager_town' => 'ZM_MANAGER_TOWN',
        'export_sgpi_out.zm_manager_town' => 'ZM_MANAGER_TOWN',
        'RmManagerBranch' => 'RM_MANAGER_BRANCH',
        'ExportSgpiOut.RmManagerBranch' => 'RM_MANAGER_BRANCH',
        'rmManagerBranch' => 'RM_MANAGER_BRANCH',
        'exportSgpiOut.rmManagerBranch' => 'RM_MANAGER_BRANCH',
        'ExportSgpiOutTableMap::COL_RM_MANAGER_BRANCH' => 'RM_MANAGER_BRANCH',
        'COL_RM_MANAGER_BRANCH' => 'RM_MANAGER_BRANCH',
        'rm_manager_branch' => 'RM_MANAGER_BRANCH',
        'export_sgpi_out.rm_manager_branch' => 'RM_MANAGER_BRANCH',
        'RmManagerTown' => 'RM_MANAGER_TOWN',
        'ExportSgpiOut.RmManagerTown' => 'RM_MANAGER_TOWN',
        'rmManagerTown' => 'RM_MANAGER_TOWN',
        'exportSgpiOut.rmManagerTown' => 'RM_MANAGER_TOWN',
        'ExportSgpiOutTableMap::COL_RM_MANAGER_TOWN' => 'RM_MANAGER_TOWN',
        'COL_RM_MANAGER_TOWN' => 'RM_MANAGER_TOWN',
        'rm_manager_town' => 'RM_MANAGER_TOWN',
        'export_sgpi_out.rm_manager_town' => 'RM_MANAGER_TOWN',
        'AmManagerBranch' => 'AM_MANAGER_BRANCH',
        'ExportSgpiOut.AmManagerBranch' => 'AM_MANAGER_BRANCH',
        'amManagerBranch' => 'AM_MANAGER_BRANCH',
        'exportSgpiOut.amManagerBranch' => 'AM_MANAGER_BRANCH',
        'ExportSgpiOutTableMap::COL_AM_MANAGER_BRANCH' => 'AM_MANAGER_BRANCH',
        'COL_AM_MANAGER_BRANCH' => 'AM_MANAGER_BRANCH',
        'am_manager_branch' => 'AM_MANAGER_BRANCH',
        'export_sgpi_out.am_manager_branch' => 'AM_MANAGER_BRANCH',
        'AmManagerTown' => 'AM_MANAGER_TOWN',
        'ExportSgpiOut.AmManagerTown' => 'AM_MANAGER_TOWN',
        'amManagerTown' => 'AM_MANAGER_TOWN',
        'exportSgpiOut.amManagerTown' => 'AM_MANAGER_TOWN',
        'ExportSgpiOutTableMap::COL_AM_MANAGER_TOWN' => 'AM_MANAGER_TOWN',
        'COL_AM_MANAGER_TOWN' => 'AM_MANAGER_TOWN',
        'am_manager_town' => 'AM_MANAGER_TOWN',
        'export_sgpi_out.am_manager_town' => 'AM_MANAGER_TOWN',
        'ZmPositionCode' => 'ZM_POSITION_CODE',
        'ExportSgpiOut.ZmPositionCode' => 'ZM_POSITION_CODE',
        'zmPositionCode' => 'ZM_POSITION_CODE',
        'exportSgpiOut.zmPositionCode' => 'ZM_POSITION_CODE',
        'ExportSgpiOutTableMap::COL_ZM_POSITION_CODE' => 'ZM_POSITION_CODE',
        'COL_ZM_POSITION_CODE' => 'ZM_POSITION_CODE',
        'zm_position_code' => 'ZM_POSITION_CODE',
        'export_sgpi_out.zm_position_code' => 'ZM_POSITION_CODE',
        'RmPositionCode' => 'RM_POSITION_CODE',
        'ExportSgpiOut.RmPositionCode' => 'RM_POSITION_CODE',
        'rmPositionCode' => 'RM_POSITION_CODE',
        'exportSgpiOut.rmPositionCode' => 'RM_POSITION_CODE',
        'ExportSgpiOutTableMap::COL_RM_POSITION_CODE' => 'RM_POSITION_CODE',
        'COL_RM_POSITION_CODE' => 'RM_POSITION_CODE',
        'rm_position_code' => 'RM_POSITION_CODE',
        'export_sgpi_out.rm_position_code' => 'RM_POSITION_CODE',
        'AmPositionCode' => 'AM_POSITION_CODE',
        'ExportSgpiOut.AmPositionCode' => 'AM_POSITION_CODE',
        'amPositionCode' => 'AM_POSITION_CODE',
        'exportSgpiOut.amPositionCode' => 'AM_POSITION_CODE',
        'ExportSgpiOutTableMap::COL_AM_POSITION_CODE' => 'AM_POSITION_CODE',
        'COL_AM_POSITION_CODE' => 'AM_POSITION_CODE',
        'am_position_code' => 'AM_POSITION_CODE',
        'export_sgpi_out.am_position_code' => 'AM_POSITION_CODE',
        'EmpPositionCode' => 'EMP_POSITION_CODE',
        'ExportSgpiOut.EmpPositionCode' => 'EMP_POSITION_CODE',
        'empPositionCode' => 'EMP_POSITION_CODE',
        'exportSgpiOut.empPositionCode' => 'EMP_POSITION_CODE',
        'ExportSgpiOutTableMap::COL_EMP_POSITION_CODE' => 'EMP_POSITION_CODE',
        'COL_EMP_POSITION_CODE' => 'EMP_POSITION_CODE',
        'emp_position_code' => 'EMP_POSITION_CODE',
        'export_sgpi_out.emp_position_code' => 'EMP_POSITION_CODE',
        'EmpPositionName' => 'EMP_POSITION_NAME',
        'ExportSgpiOut.EmpPositionName' => 'EMP_POSITION_NAME',
        'empPositionName' => 'EMP_POSITION_NAME',
        'exportSgpiOut.empPositionName' => 'EMP_POSITION_NAME',
        'ExportSgpiOutTableMap::COL_EMP_POSITION_NAME' => 'EMP_POSITION_NAME',
        'COL_EMP_POSITION_NAME' => 'EMP_POSITION_NAME',
        'emp_position_name' => 'EMP_POSITION_NAME',
        'export_sgpi_out.emp_position_name' => 'EMP_POSITION_NAME',
        'EmpLevel' => 'EMP_LEVEL',
        'ExportSgpiOut.EmpLevel' => 'EMP_LEVEL',
        'empLevel' => 'EMP_LEVEL',
        'exportSgpiOut.empLevel' => 'EMP_LEVEL',
        'ExportSgpiOutTableMap::COL_EMP_LEVEL' => 'EMP_LEVEL',
        'COL_EMP_LEVEL' => 'EMP_LEVEL',
        'emp_level' => 'EMP_LEVEL',
        'export_sgpi_out.emp_level' => 'EMP_LEVEL',
        'EmployeeCode' => 'EMPLOYEE_CODE',
        'ExportSgpiOut.EmployeeCode' => 'EMPLOYEE_CODE',
        'employeeCode' => 'EMPLOYEE_CODE',
        'exportSgpiOut.employeeCode' => 'EMPLOYEE_CODE',
        'ExportSgpiOutTableMap::COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'employee_code' => 'EMPLOYEE_CODE',
        'export_sgpi_out.employee_code' => 'EMPLOYEE_CODE',
        'EmployeeName' => 'EMPLOYEE_NAME',
        'ExportSgpiOut.EmployeeName' => 'EMPLOYEE_NAME',
        'employeeName' => 'EMPLOYEE_NAME',
        'exportSgpiOut.employeeName' => 'EMPLOYEE_NAME',
        'ExportSgpiOutTableMap::COL_EMPLOYEE_NAME' => 'EMPLOYEE_NAME',
        'COL_EMPLOYEE_NAME' => 'EMPLOYEE_NAME',
        'employee_name' => 'EMPLOYEE_NAME',
        'export_sgpi_out.employee_name' => 'EMPLOYEE_NAME',
        'OutletCode' => 'OUTLET_CODE',
        'ExportSgpiOut.OutletCode' => 'OUTLET_CODE',
        'outletCode' => 'OUTLET_CODE',
        'exportSgpiOut.outletCode' => 'OUTLET_CODE',
        'ExportSgpiOutTableMap::COL_OUTLET_CODE' => 'OUTLET_CODE',
        'COL_OUTLET_CODE' => 'OUTLET_CODE',
        'outlet_code' => 'OUTLET_CODE',
        'export_sgpi_out.outlet_code' => 'OUTLET_CODE',
        'BrandFocus' => 'BRAND_FOCUS',
        'ExportSgpiOut.BrandFocus' => 'BRAND_FOCUS',
        'brandFocus' => 'BRAND_FOCUS',
        'exportSgpiOut.brandFocus' => 'BRAND_FOCUS',
        'ExportSgpiOutTableMap::COL_BRAND_FOCUS' => 'BRAND_FOCUS',
        'COL_BRAND_FOCUS' => 'BRAND_FOCUS',
        'brand_focus' => 'BRAND_FOCUS',
        'export_sgpi_out.brand_focus' => 'BRAND_FOCUS',
        'OutletOrgId' => 'OUTLET_ORG_ID',
        'ExportSgpiOut.OutletOrgId' => 'OUTLET_ORG_ID',
        'outletOrgId' => 'OUTLET_ORG_ID',
        'exportSgpiOut.outletOrgId' => 'OUTLET_ORG_ID',
        'ExportSgpiOutTableMap::COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'COL_OUTLET_ORG_ID' => 'OUTLET_ORG_ID',
        'outlet_org_id' => 'OUTLET_ORG_ID',
        'export_sgpi_out.outlet_org_id' => 'OUTLET_ORG_ID',
        'OrgUnitId' => 'ORG_UNIT_ID',
        'ExportSgpiOut.OrgUnitId' => 'ORG_UNIT_ID',
        'orgUnitId' => 'ORG_UNIT_ID',
        'exportSgpiOut.orgUnitId' => 'ORG_UNIT_ID',
        'ExportSgpiOutTableMap::COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'org_unit_id' => 'ORG_UNIT_ID',
        'export_sgpi_out.org_unit_id' => 'ORG_UNIT_ID',
        'TerritoryId' => 'TERRITORY_ID',
        'ExportSgpiOut.TerritoryId' => 'TERRITORY_ID',
        'territoryId' => 'TERRITORY_ID',
        'exportSgpiOut.territoryId' => 'TERRITORY_ID',
        'ExportSgpiOutTableMap::COL_TERRITORY_ID' => 'TERRITORY_ID',
        'COL_TERRITORY_ID' => 'TERRITORY_ID',
        'territory_id' => 'TERRITORY_ID',
        'export_sgpi_out.territory_id' => 'TERRITORY_ID',
        'TerritoryName' => 'TERRITORY_NAME',
        'ExportSgpiOut.TerritoryName' => 'TERRITORY_NAME',
        'territoryName' => 'TERRITORY_NAME',
        'exportSgpiOut.territoryName' => 'TERRITORY_NAME',
        'ExportSgpiOutTableMap::COL_TERRITORY_NAME' => 'TERRITORY_NAME',
        'COL_TERRITORY_NAME' => 'TERRITORY_NAME',
        'territory_name' => 'TERRITORY_NAME',
        'export_sgpi_out.territory_name' => 'TERRITORY_NAME',
        'BeatId' => 'BEAT_ID',
        'ExportSgpiOut.BeatId' => 'BEAT_ID',
        'beatId' => 'BEAT_ID',
        'exportSgpiOut.beatId' => 'BEAT_ID',
        'ExportSgpiOutTableMap::COL_BEAT_ID' => 'BEAT_ID',
        'COL_BEAT_ID' => 'BEAT_ID',
        'beat_id' => 'BEAT_ID',
        'export_sgpi_out.beat_id' => 'BEAT_ID',
        'BeatName' => 'BEAT_NAME',
        'ExportSgpiOut.BeatName' => 'BEAT_NAME',
        'beatName' => 'BEAT_NAME',
        'exportSgpiOut.beatName' => 'BEAT_NAME',
        'ExportSgpiOutTableMap::COL_BEAT_NAME' => 'BEAT_NAME',
        'COL_BEAT_NAME' => 'BEAT_NAME',
        'beat_name' => 'BEAT_NAME',
        'export_sgpi_out.beat_name' => 'BEAT_NAME',
        'Tags' => 'TAGS',
        'ExportSgpiOut.Tags' => 'TAGS',
        'tags' => 'TAGS',
        'exportSgpiOut.tags' => 'TAGS',
        'ExportSgpiOutTableMap::COL_TAGS' => 'TAGS',
        'COL_TAGS' => 'TAGS',
        'export_sgpi_out.tags' => 'TAGS',
        'VisitFq' => 'VISIT_FQ',
        'ExportSgpiOut.VisitFq' => 'VISIT_FQ',
        'visitFq' => 'VISIT_FQ',
        'exportSgpiOut.visitFq' => 'VISIT_FQ',
        'ExportSgpiOutTableMap::COL_VISIT_FQ' => 'VISIT_FQ',
        'COL_VISIT_FQ' => 'VISIT_FQ',
        'visit_fq' => 'VISIT_FQ',
        'export_sgpi_out.visit_fq' => 'VISIT_FQ',
        'OutletSalutation' => 'OUTLET_SALUTATION',
        'ExportSgpiOut.OutletSalutation' => 'OUTLET_SALUTATION',
        'outletSalutation' => 'OUTLET_SALUTATION',
        'exportSgpiOut.outletSalutation' => 'OUTLET_SALUTATION',
        'ExportSgpiOutTableMap::COL_OUTLET_SALUTATION' => 'OUTLET_SALUTATION',
        'COL_OUTLET_SALUTATION' => 'OUTLET_SALUTATION',
        'outlet_salutation' => 'OUTLET_SALUTATION',
        'export_sgpi_out.outlet_salutation' => 'OUTLET_SALUTATION',
        'OutletName' => 'OUTLET_NAME',
        'ExportSgpiOut.OutletName' => 'OUTLET_NAME',
        'outletName' => 'OUTLET_NAME',
        'exportSgpiOut.outletName' => 'OUTLET_NAME',
        'ExportSgpiOutTableMap::COL_OUTLET_NAME' => 'OUTLET_NAME',
        'COL_OUTLET_NAME' => 'OUTLET_NAME',
        'outlet_name' => 'OUTLET_NAME',
        'export_sgpi_out.outlet_name' => 'OUTLET_NAME',
        'Classification' => 'CLASSIFICATION',
        'ExportSgpiOut.Classification' => 'CLASSIFICATION',
        'classification' => 'CLASSIFICATION',
        'exportSgpiOut.classification' => 'CLASSIFICATION',
        'ExportSgpiOutTableMap::COL_CLASSIFICATION' => 'CLASSIFICATION',
        'COL_CLASSIFICATION' => 'CLASSIFICATION',
        'export_sgpi_out.classification' => 'CLASSIFICATION',
        'OutlettypeName' => 'OUTLETTYPE_NAME',
        'ExportSgpiOut.OutlettypeName' => 'OUTLETTYPE_NAME',
        'outlettypeName' => 'OUTLETTYPE_NAME',
        'exportSgpiOut.outlettypeName' => 'OUTLETTYPE_NAME',
        'ExportSgpiOutTableMap::COL_OUTLETTYPE_NAME' => 'OUTLETTYPE_NAME',
        'COL_OUTLETTYPE_NAME' => 'OUTLETTYPE_NAME',
        'outlettype_name' => 'OUTLETTYPE_NAME',
        'export_sgpi_out.outlettype_name' => 'OUTLETTYPE_NAME',
        'SgpiName' => 'SGPI_NAME',
        'ExportSgpiOut.SgpiName' => 'SGPI_NAME',
        'sgpiName' => 'SGPI_NAME',
        'exportSgpiOut.sgpiName' => 'SGPI_NAME',
        'ExportSgpiOutTableMap::COL_SGPI_NAME' => 'SGPI_NAME',
        'COL_SGPI_NAME' => 'SGPI_NAME',
        'sgpi_name' => 'SGPI_NAME',
        'export_sgpi_out.sgpi_name' => 'SGPI_NAME',
        'SgpiCode' => 'SGPI_CODE',
        'ExportSgpiOut.SgpiCode' => 'SGPI_CODE',
        'sgpiCode' => 'SGPI_CODE',
        'exportSgpiOut.sgpiCode' => 'SGPI_CODE',
        'ExportSgpiOutTableMap::COL_SGPI_CODE' => 'SGPI_CODE',
        'COL_SGPI_CODE' => 'SGPI_CODE',
        'sgpi_code' => 'SGPI_CODE',
        'export_sgpi_out.sgpi_code' => 'SGPI_CODE',
        'MaterialSku' => 'MATERIAL_SKU',
        'ExportSgpiOut.MaterialSku' => 'MATERIAL_SKU',
        'materialSku' => 'MATERIAL_SKU',
        'exportSgpiOut.materialSku' => 'MATERIAL_SKU',
        'ExportSgpiOutTableMap::COL_MATERIAL_SKU' => 'MATERIAL_SKU',
        'COL_MATERIAL_SKU' => 'MATERIAL_SKU',
        'material_sku' => 'MATERIAL_SKU',
        'export_sgpi_out.material_sku' => 'MATERIAL_SKU',
        'SgpiType' => 'SGPI_TYPE',
        'ExportSgpiOut.SgpiType' => 'SGPI_TYPE',
        'sgpiType' => 'SGPI_TYPE',
        'exportSgpiOut.sgpiType' => 'SGPI_TYPE',
        'ExportSgpiOutTableMap::COL_SGPI_TYPE' => 'SGPI_TYPE',
        'COL_SGPI_TYPE' => 'SGPI_TYPE',
        'sgpi_type' => 'SGPI_TYPE',
        'export_sgpi_out.sgpi_type' => 'SGPI_TYPE',
        'SgpiQty' => 'SGPI_QTY',
        'ExportSgpiOut.SgpiQty' => 'SGPI_QTY',
        'sgpiQty' => 'SGPI_QTY',
        'exportSgpiOut.sgpiQty' => 'SGPI_QTY',
        'ExportSgpiOutTableMap::COL_SGPI_QTY' => 'SGPI_QTY',
        'COL_SGPI_QTY' => 'SGPI_QTY',
        'sgpi_qty' => 'SGPI_QTY',
        'export_sgpi_out.sgpi_qty' => 'SGPI_QTY',
        'DcrId' => 'DCR_ID',
        'ExportSgpiOut.DcrId' => 'DCR_ID',
        'dcrId' => 'DCR_ID',
        'exportSgpiOut.dcrId' => 'DCR_ID',
        'ExportSgpiOutTableMap::COL_DCR_ID' => 'DCR_ID',
        'COL_DCR_ID' => 'DCR_ID',
        'dcr_id' => 'DCR_ID',
        'export_sgpi_out.dcr_id' => 'DCR_ID',
        'DcrDate' => 'DCR_DATE',
        'ExportSgpiOut.DcrDate' => 'DCR_DATE',
        'dcrDate' => 'DCR_DATE',
        'exportSgpiOut.dcrDate' => 'DCR_DATE',
        'ExportSgpiOutTableMap::COL_DCR_DATE' => 'DCR_DATE',
        'COL_DCR_DATE' => 'DCR_DATE',
        'dcr_date' => 'DCR_DATE',
        'export_sgpi_out.dcr_date' => 'DCR_DATE',
        'BrandName' => 'BRAND_NAME',
        'ExportSgpiOut.BrandName' => 'BRAND_NAME',
        'brandName' => 'BRAND_NAME',
        'exportSgpiOut.brandName' => 'BRAND_NAME',
        'ExportSgpiOutTableMap::COL_BRAND_NAME' => 'BRAND_NAME',
        'COL_BRAND_NAME' => 'BRAND_NAME',
        'brand_name' => 'BRAND_NAME',
        'export_sgpi_out.brand_name' => 'BRAND_NAME',
        'DeviceTime' => 'DEVICE_TIME',
        'ExportSgpiOut.DeviceTime' => 'DEVICE_TIME',
        'deviceTime' => 'DEVICE_TIME',
        'exportSgpiOut.deviceTime' => 'DEVICE_TIME',
        'ExportSgpiOutTableMap::COL_DEVICE_TIME' => 'DEVICE_TIME',
        'COL_DEVICE_TIME' => 'DEVICE_TIME',
        'device_time' => 'DEVICE_TIME',
        'export_sgpi_out.device_time' => 'DEVICE_TIME',
        'Managers' => 'MANAGERS',
        'ExportSgpiOut.Managers' => 'MANAGERS',
        'managers' => 'MANAGERS',
        'exportSgpiOut.managers' => 'MANAGERS',
        'ExportSgpiOutTableMap::COL_MANAGERS' => 'MANAGERS',
        'COL_MANAGERS' => 'MANAGERS',
        'export_sgpi_out.managers' => 'MANAGERS',
        'CreatedAt' => 'CREATED_AT',
        'ExportSgpiOut.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'exportSgpiOut.createdAt' => 'CREATED_AT',
        'ExportSgpiOutTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'export_sgpi_out.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'ExportSgpiOut.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'exportSgpiOut.updatedAt' => 'UPDATED_AT',
        'ExportSgpiOutTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'export_sgpi_out.updated_at' => 'UPDATED_AT',
        'EmpTerritory' => 'EMP_TERRITORY',
        'ExportSgpiOut.EmpTerritory' => 'EMP_TERRITORY',
        'empTerritory' => 'EMP_TERRITORY',
        'exportSgpiOut.empTerritory' => 'EMP_TERRITORY',
        'ExportSgpiOutTableMap::COL_EMP_TERRITORY' => 'EMP_TERRITORY',
        'COL_EMP_TERRITORY' => 'EMP_TERRITORY',
        'emp_territory' => 'EMP_TERRITORY',
        'export_sgpi_out.emp_territory' => 'EMP_TERRITORY',
        'EmpBranch' => 'EMP_BRANCH',
        'ExportSgpiOut.EmpBranch' => 'EMP_BRANCH',
        'empBranch' => 'EMP_BRANCH',
        'exportSgpiOut.empBranch' => 'EMP_BRANCH',
        'ExportSgpiOutTableMap::COL_EMP_BRANCH' => 'EMP_BRANCH',
        'COL_EMP_BRANCH' => 'EMP_BRANCH',
        'emp_branch' => 'EMP_BRANCH',
        'export_sgpi_out.emp_branch' => 'EMP_BRANCH',
        'EmpTown' => 'EMP_TOWN',
        'ExportSgpiOut.EmpTown' => 'EMP_TOWN',
        'empTown' => 'EMP_TOWN',
        'exportSgpiOut.empTown' => 'EMP_TOWN',
        'ExportSgpiOutTableMap::COL_EMP_TOWN' => 'EMP_TOWN',
        'COL_EMP_TOWN' => 'EMP_TOWN',
        'emp_town' => 'EMP_TOWN',
        'export_sgpi_out.emp_town' => 'EMP_TOWN',
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
        $this->setName('export_sgpi_out');
        $this->setPhpName('ExportSgpiOut');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\ExportSgpiOut');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addColumn('sgpi_voucher_id', 'SgpiVoucherId', 'INTEGER', false, null, null);
        $this->addColumn('bu_name', 'BuName', 'VARCHAR', false, null, null);
        $this->addColumn('zm_manager_branch', 'ZmManagerBranch', 'VARCHAR', false, null, null);
        $this->addColumn('zm_manager_town', 'ZmManagerTown', 'VARCHAR', false, null, null);
        $this->addColumn('rm_manager_branch', 'RmManagerBranch', 'VARCHAR', false, null, null);
        $this->addColumn('rm_manager_town', 'RmManagerTown', 'VARCHAR', false, null, null);
        $this->addColumn('am_manager_branch', 'AmManagerBranch', 'VARCHAR', false, null, null);
        $this->addColumn('am_manager_town', 'AmManagerTown', 'VARCHAR', false, null, null);
        $this->addColumn('zm_position_code', 'ZmPositionCode', 'VARCHAR', false, 255, null);
        $this->addColumn('rm_position_code', 'RmPositionCode', 'VARCHAR', false, 255, null);
        $this->addColumn('am_position_code', 'AmPositionCode', 'VARCHAR', false, 255, null);
        $this->addColumn('emp_position_code', 'EmpPositionCode', 'VARCHAR', false, 255, null);
        $this->addColumn('emp_position_name', 'EmpPositionName', 'VARCHAR', false, 255, null);
        $this->addColumn('emp_level', 'EmpLevel', 'VARCHAR', false, 255, null);
        $this->addColumn('employee_code', 'EmployeeCode', 'VARCHAR', false, null, null);
        $this->addColumn('employee_name', 'EmployeeName', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_code', 'OutletCode', 'VARCHAR', false, null, null);
        $this->addColumn('brand_focus', 'BrandFocus', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_org_id', 'OutletOrgId', 'INTEGER', false, null, null);
        $this->addColumn('org_unit_id', 'OrgUnitId', 'INTEGER', false, null, null);
        $this->addColumn('territory_id', 'TerritoryId', 'INTEGER', false, null, null);
        $this->addColumn('territory_name', 'TerritoryName', 'VARCHAR', false, null, null);
        $this->addColumn('beat_id', 'BeatId', 'INTEGER', false, null, null);
        $this->addColumn('beat_name', 'BeatName', 'VARCHAR', false, null, null);
        $this->addColumn('tags', 'Tags', 'VARCHAR', false, null, null);
        $this->addColumn('visit_fq', 'VisitFq', 'INTEGER', false, null, null);
        $this->addColumn('outlet_salutation', 'OutletSalutation', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_name', 'OutletName', 'VARCHAR', false, null, null);
        $this->addColumn('classification', 'Classification', 'VARCHAR', false, null, null);
        $this->addColumn('outlettype_name', 'OutlettypeName', 'VARCHAR', false, null, null);
        $this->addColumn('sgpi_name', 'SgpiName', 'VARCHAR', false, null, null);
        $this->addColumn('sgpi_code', 'SgpiCode', 'VARCHAR', false, null, null);
        $this->addColumn('material_sku', 'MaterialSku', 'VARCHAR', false, null, null);
        $this->addColumn('sgpi_type', 'SgpiType', 'VARCHAR', false, null, null);
        $this->addColumn('sgpi_qty', 'SgpiQty', 'INTEGER', false, null, null);
        $this->addColumn('dcr_id', 'DcrId', 'INTEGER', false, null, null);
        $this->addColumn('dcr_date', 'DcrDate', 'DATE', false, null, null);
        $this->addColumn('brand_name', 'BrandName', 'VARCHAR', false, null, null);
        $this->addColumn('device_time', 'DeviceTime', 'TIMESTAMP', false, null, null);
        $this->addColumn('managers', 'Managers', 'VARCHAR', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('emp_territory', 'EmpTerritory', 'VARCHAR', false, null, null);
        $this->addColumn('emp_branch', 'EmpBranch', 'VARCHAR', false, null, null);
        $this->addColumn('emp_town', 'EmpTown', 'VARCHAR', false, null, null);
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
        return $withPrefix ? ExportSgpiOutTableMap::CLASS_DEFAULT : ExportSgpiOutTableMap::OM_CLASS;
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
     * @return array (ExportSgpiOut object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ExportSgpiOutTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ExportSgpiOutTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ExportSgpiOutTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ExportSgpiOutTableMap::OM_CLASS;
            /** @var ExportSgpiOut $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ExportSgpiOutTableMap::addInstanceToPool($obj, $key);
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
            $key = ExportSgpiOutTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ExportSgpiOutTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ExportSgpiOut $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ExportSgpiOutTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_SGPI_VOUCHER_ID);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_BU_NAME);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_ZM_MANAGER_BRANCH);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_ZM_MANAGER_TOWN);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_RM_MANAGER_BRANCH);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_RM_MANAGER_TOWN);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_AM_MANAGER_BRANCH);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_AM_MANAGER_TOWN);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_ZM_POSITION_CODE);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_RM_POSITION_CODE);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_AM_POSITION_CODE);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_EMP_POSITION_CODE);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_EMP_POSITION_NAME);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_EMP_LEVEL);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_EMPLOYEE_CODE);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_EMPLOYEE_NAME);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_OUTLET_CODE);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_BRAND_FOCUS);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_OUTLET_ORG_ID);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_ORG_UNIT_ID);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_TERRITORY_ID);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_TERRITORY_NAME);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_BEAT_ID);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_BEAT_NAME);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_TAGS);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_VISIT_FQ);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_OUTLET_SALUTATION);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_OUTLET_NAME);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_CLASSIFICATION);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_OUTLETTYPE_NAME);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_SGPI_NAME);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_SGPI_CODE);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_MATERIAL_SKU);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_SGPI_TYPE);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_SGPI_QTY);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_DCR_ID);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_DCR_DATE);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_BRAND_NAME);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_DEVICE_TIME);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_MANAGERS);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_EMP_TERRITORY);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_EMP_BRANCH);
            $criteria->addSelectColumn(ExportSgpiOutTableMap::COL_EMP_TOWN);
        } else {
            $criteria->addSelectColumn($alias . '.sgpi_voucher_id');
            $criteria->addSelectColumn($alias . '.bu_name');
            $criteria->addSelectColumn($alias . '.zm_manager_branch');
            $criteria->addSelectColumn($alias . '.zm_manager_town');
            $criteria->addSelectColumn($alias . '.rm_manager_branch');
            $criteria->addSelectColumn($alias . '.rm_manager_town');
            $criteria->addSelectColumn($alias . '.am_manager_branch');
            $criteria->addSelectColumn($alias . '.am_manager_town');
            $criteria->addSelectColumn($alias . '.zm_position_code');
            $criteria->addSelectColumn($alias . '.rm_position_code');
            $criteria->addSelectColumn($alias . '.am_position_code');
            $criteria->addSelectColumn($alias . '.emp_position_code');
            $criteria->addSelectColumn($alias . '.emp_position_name');
            $criteria->addSelectColumn($alias . '.emp_level');
            $criteria->addSelectColumn($alias . '.employee_code');
            $criteria->addSelectColumn($alias . '.employee_name');
            $criteria->addSelectColumn($alias . '.outlet_code');
            $criteria->addSelectColumn($alias . '.brand_focus');
            $criteria->addSelectColumn($alias . '.outlet_org_id');
            $criteria->addSelectColumn($alias . '.org_unit_id');
            $criteria->addSelectColumn($alias . '.territory_id');
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
            $criteria->addSelectColumn($alias . '.brand_name');
            $criteria->addSelectColumn($alias . '.device_time');
            $criteria->addSelectColumn($alias . '.managers');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.emp_territory');
            $criteria->addSelectColumn($alias . '.emp_branch');
            $criteria->addSelectColumn($alias . '.emp_town');
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
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_SGPI_VOUCHER_ID);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_BU_NAME);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_ZM_MANAGER_BRANCH);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_ZM_MANAGER_TOWN);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_RM_MANAGER_BRANCH);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_RM_MANAGER_TOWN);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_AM_MANAGER_BRANCH);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_AM_MANAGER_TOWN);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_ZM_POSITION_CODE);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_RM_POSITION_CODE);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_AM_POSITION_CODE);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_EMP_POSITION_CODE);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_EMP_POSITION_NAME);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_EMP_LEVEL);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_EMPLOYEE_CODE);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_EMPLOYEE_NAME);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_OUTLET_CODE);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_BRAND_FOCUS);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_OUTLET_ORG_ID);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_ORG_UNIT_ID);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_TERRITORY_ID);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_TERRITORY_NAME);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_BEAT_ID);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_BEAT_NAME);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_TAGS);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_VISIT_FQ);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_OUTLET_SALUTATION);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_OUTLET_NAME);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_CLASSIFICATION);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_OUTLETTYPE_NAME);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_SGPI_NAME);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_SGPI_CODE);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_MATERIAL_SKU);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_SGPI_TYPE);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_SGPI_QTY);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_DCR_ID);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_DCR_DATE);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_BRAND_NAME);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_DEVICE_TIME);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_MANAGERS);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_EMP_TERRITORY);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_EMP_BRANCH);
            $criteria->removeSelectColumn(ExportSgpiOutTableMap::COL_EMP_TOWN);
        } else {
            $criteria->removeSelectColumn($alias . '.sgpi_voucher_id');
            $criteria->removeSelectColumn($alias . '.bu_name');
            $criteria->removeSelectColumn($alias . '.zm_manager_branch');
            $criteria->removeSelectColumn($alias . '.zm_manager_town');
            $criteria->removeSelectColumn($alias . '.rm_manager_branch');
            $criteria->removeSelectColumn($alias . '.rm_manager_town');
            $criteria->removeSelectColumn($alias . '.am_manager_branch');
            $criteria->removeSelectColumn($alias . '.am_manager_town');
            $criteria->removeSelectColumn($alias . '.zm_position_code');
            $criteria->removeSelectColumn($alias . '.rm_position_code');
            $criteria->removeSelectColumn($alias . '.am_position_code');
            $criteria->removeSelectColumn($alias . '.emp_position_code');
            $criteria->removeSelectColumn($alias . '.emp_position_name');
            $criteria->removeSelectColumn($alias . '.emp_level');
            $criteria->removeSelectColumn($alias . '.employee_code');
            $criteria->removeSelectColumn($alias . '.employee_name');
            $criteria->removeSelectColumn($alias . '.outlet_code');
            $criteria->removeSelectColumn($alias . '.brand_focus');
            $criteria->removeSelectColumn($alias . '.outlet_org_id');
            $criteria->removeSelectColumn($alias . '.org_unit_id');
            $criteria->removeSelectColumn($alias . '.territory_id');
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
            $criteria->removeSelectColumn($alias . '.brand_name');
            $criteria->removeSelectColumn($alias . '.device_time');
            $criteria->removeSelectColumn($alias . '.managers');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.emp_territory');
            $criteria->removeSelectColumn($alias . '.emp_branch');
            $criteria->removeSelectColumn($alias . '.emp_town');
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
        return Propel::getServiceContainer()->getDatabaseMap(ExportSgpiOutTableMap::DATABASE_NAME)->getTable(ExportSgpiOutTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a ExportSgpiOut or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or ExportSgpiOut object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ExportSgpiOutTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\ExportSgpiOut) { // it's a model object
            // create criteria based on pk value
            $criteria = $values->buildCriteria();
        } else { // it's a primary key, or an array of pks
            throw new LogicException('The ExportSgpiOut object has no primary key');
        }

        $query = ExportSgpiOutQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ExportSgpiOutTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ExportSgpiOutTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the export_sgpi_out table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ExportSgpiOutQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ExportSgpiOut or Criteria object.
     *
     * @param mixed $criteria Criteria or ExportSgpiOut object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExportSgpiOutTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ExportSgpiOut object
        }


        // Set the correct dbName
        $query = ExportSgpiOutQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
