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
use entities\ExportEdetailing;
use entities\ExportEdetailingQuery;


/**
 * This class defines the structure of the 'export_edetailing' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ExportEdetailingTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.ExportEdetailingTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'export_edetailing';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'ExportEdetailing';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\ExportEdetailing';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.ExportEdetailing';

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
     * the column name for the bu_name field
     */
    public const COL_BU_NAME = 'export_edetailing.bu_name';

    /**
     * the column name for the zm_manager_branch field
     */
    public const COL_ZM_MANAGER_BRANCH = 'export_edetailing.zm_manager_branch';

    /**
     * the column name for the zm_manager_town field
     */
    public const COL_ZM_MANAGER_TOWN = 'export_edetailing.zm_manager_town';

    /**
     * the column name for the rm_manager_branch field
     */
    public const COL_RM_MANAGER_BRANCH = 'export_edetailing.rm_manager_branch';

    /**
     * the column name for the rm_manager_town field
     */
    public const COL_RM_MANAGER_TOWN = 'export_edetailing.rm_manager_town';

    /**
     * the column name for the am_manager_branch field
     */
    public const COL_AM_MANAGER_BRANCH = 'export_edetailing.am_manager_branch';

    /**
     * the column name for the am_manager_town field
     */
    public const COL_AM_MANAGER_TOWN = 'export_edetailing.am_manager_town';

    /**
     * the column name for the zm_position_code field
     */
    public const COL_ZM_POSITION_CODE = 'export_edetailing.zm_position_code';

    /**
     * the column name for the rm_position_code field
     */
    public const COL_RM_POSITION_CODE = 'export_edetailing.rm_position_code';

    /**
     * the column name for the am_position_code field
     */
    public const COL_AM_POSITION_CODE = 'export_edetailing.am_position_code';

    /**
     * the column name for the emp_position_code field
     */
    public const COL_EMP_POSITION_CODE = 'export_edetailing.emp_position_code';

    /**
     * the column name for the emp_position_name field
     */
    public const COL_EMP_POSITION_NAME = 'export_edetailing.emp_position_name';

    /**
     * the column name for the emp_level field
     */
    public const COL_EMP_LEVEL = 'export_edetailing.emp_level';

    /**
     * the column name for the employee_code field
     */
    public const COL_EMPLOYEE_CODE = 'export_edetailing.employee_code';

    /**
     * the column name for the employee field
     */
    public const COL_EMPLOYEE = 'export_edetailing.employee';

    /**
     * the column name for the device_start_time field
     */
    public const COL_DEVICE_START_TIME = 'export_edetailing.device_start_time';

    /**
     * the column name for the device_end_time field
     */
    public const COL_DEVICE_END_TIME = 'export_edetailing.device_end_time';

    /**
     * the column name for the outlet_type field
     */
    public const COL_OUTLET_TYPE = 'export_edetailing.outlet_type';

    /**
     * the column name for the outlet_code field
     */
    public const COL_OUTLET_CODE = 'export_edetailing.outlet_code';

    /**
     * the column name for the outlet_name field
     */
    public const COL_OUTLET_NAME = 'export_edetailing.outlet_name';

    /**
     * the column name for the outlet_classification field
     */
    public const COL_OUTLET_CLASSIFICATION = 'export_edetailing.outlet_classification';

    /**
     * the column name for the brand_name field
     */
    public const COL_BRAND_NAME = 'export_edetailing.brand_name';

    /**
     * the column name for the session_id field
     */
    public const COL_SESSION_ID = 'export_edetailing.session_id';

    /**
     * the column name for the brand_id field
     */
    public const COL_BRAND_ID = 'export_edetailing.brand_id';

    /**
     * the column name for the presentation_order field
     */
    public const COL_PRESENTATION_ORDER = 'export_edetailing.presentation_order';

    /**
     * the column name for the presentation field
     */
    public const COL_PRESENTATION = 'export_edetailing.presentation';

    /**
     * the column name for the playlist field
     */
    public const COL_PLAYLIST = 'export_edetailing.playlist';

    /**
     * the column name for the page_count field
     */
    public const COL_PAGE_COUNT = 'export_edetailing.page_count';

    /**
     * the column name for the presentation_time field
     */
    public const COL_PRESENTATION_TIME = 'export_edetailing.presentation_time';

    /**
     * the column name for the page_name field
     */
    public const COL_PAGE_NAME = 'export_edetailing.page_name';

    /**
     * the column name for the smiley field
     */
    public const COL_SMILEY = 'export_edetailing.smiley';

    /**
     * the column name for the ed_date field
     */
    public const COL_ED_DATE = 'export_edetailing.ed_date';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'export_edetailing.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'export_edetailing.updated_at';

    /**
     * the column name for the emp_territory field
     */
    public const COL_EMP_TERRITORY = 'export_edetailing.emp_territory';

    /**
     * the column name for the emp_branch field
     */
    public const COL_EMP_BRANCH = 'export_edetailing.emp_branch';

    /**
     * the column name for the emp_town field
     */
    public const COL_EMP_TOWN = 'export_edetailing.emp_town';

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
        self::TYPE_PHPNAME       => ['BuName', 'ZmManagerBranch', 'ZmManagerTown', 'RmManagerBranch', 'RmManagerTown', 'AmManagerBranch', 'AmManagerTown', 'ZmPositionCode', 'RmPositionCode', 'AmPositionCode', 'EmpPositionCode', 'EmpPositionName', 'EmpLevel', 'EmployeeCode', 'Employee', 'DeviceStartTime', 'DeviceEndTime', 'OutletType', 'OutletCode', 'OutletName', 'OutletClassification', 'BrandName', 'SessionId', 'BrandId', 'PresentationOrder', 'Presentation', 'Playlist', 'PageCount', 'PresentationTime', 'PageName', 'Smiley', 'EdDate', 'CreatedAt', 'UpdatedAt', 'EmpTerritory', 'EmpBranch', 'EmpTown', ],
        self::TYPE_CAMELNAME     => ['buName', 'zmManagerBranch', 'zmManagerTown', 'rmManagerBranch', 'rmManagerTown', 'amManagerBranch', 'amManagerTown', 'zmPositionCode', 'rmPositionCode', 'amPositionCode', 'empPositionCode', 'empPositionName', 'empLevel', 'employeeCode', 'employee', 'deviceStartTime', 'deviceEndTime', 'outletType', 'outletCode', 'outletName', 'outletClassification', 'brandName', 'sessionId', 'brandId', 'presentationOrder', 'presentation', 'playlist', 'pageCount', 'presentationTime', 'pageName', 'smiley', 'edDate', 'createdAt', 'updatedAt', 'empTerritory', 'empBranch', 'empTown', ],
        self::TYPE_COLNAME       => [ExportEdetailingTableMap::COL_BU_NAME, ExportEdetailingTableMap::COL_ZM_MANAGER_BRANCH, ExportEdetailingTableMap::COL_ZM_MANAGER_TOWN, ExportEdetailingTableMap::COL_RM_MANAGER_BRANCH, ExportEdetailingTableMap::COL_RM_MANAGER_TOWN, ExportEdetailingTableMap::COL_AM_MANAGER_BRANCH, ExportEdetailingTableMap::COL_AM_MANAGER_TOWN, ExportEdetailingTableMap::COL_ZM_POSITION_CODE, ExportEdetailingTableMap::COL_RM_POSITION_CODE, ExportEdetailingTableMap::COL_AM_POSITION_CODE, ExportEdetailingTableMap::COL_EMP_POSITION_CODE, ExportEdetailingTableMap::COL_EMP_POSITION_NAME, ExportEdetailingTableMap::COL_EMP_LEVEL, ExportEdetailingTableMap::COL_EMPLOYEE_CODE, ExportEdetailingTableMap::COL_EMPLOYEE, ExportEdetailingTableMap::COL_DEVICE_START_TIME, ExportEdetailingTableMap::COL_DEVICE_END_TIME, ExportEdetailingTableMap::COL_OUTLET_TYPE, ExportEdetailingTableMap::COL_OUTLET_CODE, ExportEdetailingTableMap::COL_OUTLET_NAME, ExportEdetailingTableMap::COL_OUTLET_CLASSIFICATION, ExportEdetailingTableMap::COL_BRAND_NAME, ExportEdetailingTableMap::COL_SESSION_ID, ExportEdetailingTableMap::COL_BRAND_ID, ExportEdetailingTableMap::COL_PRESENTATION_ORDER, ExportEdetailingTableMap::COL_PRESENTATION, ExportEdetailingTableMap::COL_PLAYLIST, ExportEdetailingTableMap::COL_PAGE_COUNT, ExportEdetailingTableMap::COL_PRESENTATION_TIME, ExportEdetailingTableMap::COL_PAGE_NAME, ExportEdetailingTableMap::COL_SMILEY, ExportEdetailingTableMap::COL_ED_DATE, ExportEdetailingTableMap::COL_CREATED_AT, ExportEdetailingTableMap::COL_UPDATED_AT, ExportEdetailingTableMap::COL_EMP_TERRITORY, ExportEdetailingTableMap::COL_EMP_BRANCH, ExportEdetailingTableMap::COL_EMP_TOWN, ],
        self::TYPE_FIELDNAME     => ['bu_name', 'zm_manager_branch', 'zm_manager_town', 'rm_manager_branch', 'rm_manager_town', 'am_manager_branch', 'am_manager_town', 'zm_position_code', 'rm_position_code', 'am_position_code', 'emp_position_code', 'emp_position_name', 'emp_level', 'employee_code', 'employee', 'device_start_time', 'device_end_time', 'outlet_type', 'outlet_code', 'outlet_name', 'outlet_classification', 'brand_name', 'session_id', 'brand_id', 'presentation_order', 'presentation', 'playlist', 'page_count', 'presentation_time', 'page_name', 'smiley', 'ed_date', 'created_at', 'updated_at', 'emp_territory', 'emp_branch', 'emp_town', ],
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
        self::TYPE_PHPNAME       => ['BuName' => 0, 'ZmManagerBranch' => 1, 'ZmManagerTown' => 2, 'RmManagerBranch' => 3, 'RmManagerTown' => 4, 'AmManagerBranch' => 5, 'AmManagerTown' => 6, 'ZmPositionCode' => 7, 'RmPositionCode' => 8, 'AmPositionCode' => 9, 'EmpPositionCode' => 10, 'EmpPositionName' => 11, 'EmpLevel' => 12, 'EmployeeCode' => 13, 'Employee' => 14, 'DeviceStartTime' => 15, 'DeviceEndTime' => 16, 'OutletType' => 17, 'OutletCode' => 18, 'OutletName' => 19, 'OutletClassification' => 20, 'BrandName' => 21, 'SessionId' => 22, 'BrandId' => 23, 'PresentationOrder' => 24, 'Presentation' => 25, 'Playlist' => 26, 'PageCount' => 27, 'PresentationTime' => 28, 'PageName' => 29, 'Smiley' => 30, 'EdDate' => 31, 'CreatedAt' => 32, 'UpdatedAt' => 33, 'EmpTerritory' => 34, 'EmpBranch' => 35, 'EmpTown' => 36, ],
        self::TYPE_CAMELNAME     => ['buName' => 0, 'zmManagerBranch' => 1, 'zmManagerTown' => 2, 'rmManagerBranch' => 3, 'rmManagerTown' => 4, 'amManagerBranch' => 5, 'amManagerTown' => 6, 'zmPositionCode' => 7, 'rmPositionCode' => 8, 'amPositionCode' => 9, 'empPositionCode' => 10, 'empPositionName' => 11, 'empLevel' => 12, 'employeeCode' => 13, 'employee' => 14, 'deviceStartTime' => 15, 'deviceEndTime' => 16, 'outletType' => 17, 'outletCode' => 18, 'outletName' => 19, 'outletClassification' => 20, 'brandName' => 21, 'sessionId' => 22, 'brandId' => 23, 'presentationOrder' => 24, 'presentation' => 25, 'playlist' => 26, 'pageCount' => 27, 'presentationTime' => 28, 'pageName' => 29, 'smiley' => 30, 'edDate' => 31, 'createdAt' => 32, 'updatedAt' => 33, 'empTerritory' => 34, 'empBranch' => 35, 'empTown' => 36, ],
        self::TYPE_COLNAME       => [ExportEdetailingTableMap::COL_BU_NAME => 0, ExportEdetailingTableMap::COL_ZM_MANAGER_BRANCH => 1, ExportEdetailingTableMap::COL_ZM_MANAGER_TOWN => 2, ExportEdetailingTableMap::COL_RM_MANAGER_BRANCH => 3, ExportEdetailingTableMap::COL_RM_MANAGER_TOWN => 4, ExportEdetailingTableMap::COL_AM_MANAGER_BRANCH => 5, ExportEdetailingTableMap::COL_AM_MANAGER_TOWN => 6, ExportEdetailingTableMap::COL_ZM_POSITION_CODE => 7, ExportEdetailingTableMap::COL_RM_POSITION_CODE => 8, ExportEdetailingTableMap::COL_AM_POSITION_CODE => 9, ExportEdetailingTableMap::COL_EMP_POSITION_CODE => 10, ExportEdetailingTableMap::COL_EMP_POSITION_NAME => 11, ExportEdetailingTableMap::COL_EMP_LEVEL => 12, ExportEdetailingTableMap::COL_EMPLOYEE_CODE => 13, ExportEdetailingTableMap::COL_EMPLOYEE => 14, ExportEdetailingTableMap::COL_DEVICE_START_TIME => 15, ExportEdetailingTableMap::COL_DEVICE_END_TIME => 16, ExportEdetailingTableMap::COL_OUTLET_TYPE => 17, ExportEdetailingTableMap::COL_OUTLET_CODE => 18, ExportEdetailingTableMap::COL_OUTLET_NAME => 19, ExportEdetailingTableMap::COL_OUTLET_CLASSIFICATION => 20, ExportEdetailingTableMap::COL_BRAND_NAME => 21, ExportEdetailingTableMap::COL_SESSION_ID => 22, ExportEdetailingTableMap::COL_BRAND_ID => 23, ExportEdetailingTableMap::COL_PRESENTATION_ORDER => 24, ExportEdetailingTableMap::COL_PRESENTATION => 25, ExportEdetailingTableMap::COL_PLAYLIST => 26, ExportEdetailingTableMap::COL_PAGE_COUNT => 27, ExportEdetailingTableMap::COL_PRESENTATION_TIME => 28, ExportEdetailingTableMap::COL_PAGE_NAME => 29, ExportEdetailingTableMap::COL_SMILEY => 30, ExportEdetailingTableMap::COL_ED_DATE => 31, ExportEdetailingTableMap::COL_CREATED_AT => 32, ExportEdetailingTableMap::COL_UPDATED_AT => 33, ExportEdetailingTableMap::COL_EMP_TERRITORY => 34, ExportEdetailingTableMap::COL_EMP_BRANCH => 35, ExportEdetailingTableMap::COL_EMP_TOWN => 36, ],
        self::TYPE_FIELDNAME     => ['bu_name' => 0, 'zm_manager_branch' => 1, 'zm_manager_town' => 2, 'rm_manager_branch' => 3, 'rm_manager_town' => 4, 'am_manager_branch' => 5, 'am_manager_town' => 6, 'zm_position_code' => 7, 'rm_position_code' => 8, 'am_position_code' => 9, 'emp_position_code' => 10, 'emp_position_name' => 11, 'emp_level' => 12, 'employee_code' => 13, 'employee' => 14, 'device_start_time' => 15, 'device_end_time' => 16, 'outlet_type' => 17, 'outlet_code' => 18, 'outlet_name' => 19, 'outlet_classification' => 20, 'brand_name' => 21, 'session_id' => 22, 'brand_id' => 23, 'presentation_order' => 24, 'presentation' => 25, 'playlist' => 26, 'page_count' => 27, 'presentation_time' => 28, 'page_name' => 29, 'smiley' => 30, 'ed_date' => 31, 'created_at' => 32, 'updated_at' => 33, 'emp_territory' => 34, 'emp_branch' => 35, 'emp_town' => 36, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'BuName' => 'BU_NAME',
        'ExportEdetailing.BuName' => 'BU_NAME',
        'buName' => 'BU_NAME',
        'exportEdetailing.buName' => 'BU_NAME',
        'ExportEdetailingTableMap::COL_BU_NAME' => 'BU_NAME',
        'COL_BU_NAME' => 'BU_NAME',
        'bu_name' => 'BU_NAME',
        'export_edetailing.bu_name' => 'BU_NAME',
        'ZmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'ExportEdetailing.ZmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'zmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'exportEdetailing.zmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'ExportEdetailingTableMap::COL_ZM_MANAGER_BRANCH' => 'ZM_MANAGER_BRANCH',
        'COL_ZM_MANAGER_BRANCH' => 'ZM_MANAGER_BRANCH',
        'zm_manager_branch' => 'ZM_MANAGER_BRANCH',
        'export_edetailing.zm_manager_branch' => 'ZM_MANAGER_BRANCH',
        'ZmManagerTown' => 'ZM_MANAGER_TOWN',
        'ExportEdetailing.ZmManagerTown' => 'ZM_MANAGER_TOWN',
        'zmManagerTown' => 'ZM_MANAGER_TOWN',
        'exportEdetailing.zmManagerTown' => 'ZM_MANAGER_TOWN',
        'ExportEdetailingTableMap::COL_ZM_MANAGER_TOWN' => 'ZM_MANAGER_TOWN',
        'COL_ZM_MANAGER_TOWN' => 'ZM_MANAGER_TOWN',
        'zm_manager_town' => 'ZM_MANAGER_TOWN',
        'export_edetailing.zm_manager_town' => 'ZM_MANAGER_TOWN',
        'RmManagerBranch' => 'RM_MANAGER_BRANCH',
        'ExportEdetailing.RmManagerBranch' => 'RM_MANAGER_BRANCH',
        'rmManagerBranch' => 'RM_MANAGER_BRANCH',
        'exportEdetailing.rmManagerBranch' => 'RM_MANAGER_BRANCH',
        'ExportEdetailingTableMap::COL_RM_MANAGER_BRANCH' => 'RM_MANAGER_BRANCH',
        'COL_RM_MANAGER_BRANCH' => 'RM_MANAGER_BRANCH',
        'rm_manager_branch' => 'RM_MANAGER_BRANCH',
        'export_edetailing.rm_manager_branch' => 'RM_MANAGER_BRANCH',
        'RmManagerTown' => 'RM_MANAGER_TOWN',
        'ExportEdetailing.RmManagerTown' => 'RM_MANAGER_TOWN',
        'rmManagerTown' => 'RM_MANAGER_TOWN',
        'exportEdetailing.rmManagerTown' => 'RM_MANAGER_TOWN',
        'ExportEdetailingTableMap::COL_RM_MANAGER_TOWN' => 'RM_MANAGER_TOWN',
        'COL_RM_MANAGER_TOWN' => 'RM_MANAGER_TOWN',
        'rm_manager_town' => 'RM_MANAGER_TOWN',
        'export_edetailing.rm_manager_town' => 'RM_MANAGER_TOWN',
        'AmManagerBranch' => 'AM_MANAGER_BRANCH',
        'ExportEdetailing.AmManagerBranch' => 'AM_MANAGER_BRANCH',
        'amManagerBranch' => 'AM_MANAGER_BRANCH',
        'exportEdetailing.amManagerBranch' => 'AM_MANAGER_BRANCH',
        'ExportEdetailingTableMap::COL_AM_MANAGER_BRANCH' => 'AM_MANAGER_BRANCH',
        'COL_AM_MANAGER_BRANCH' => 'AM_MANAGER_BRANCH',
        'am_manager_branch' => 'AM_MANAGER_BRANCH',
        'export_edetailing.am_manager_branch' => 'AM_MANAGER_BRANCH',
        'AmManagerTown' => 'AM_MANAGER_TOWN',
        'ExportEdetailing.AmManagerTown' => 'AM_MANAGER_TOWN',
        'amManagerTown' => 'AM_MANAGER_TOWN',
        'exportEdetailing.amManagerTown' => 'AM_MANAGER_TOWN',
        'ExportEdetailingTableMap::COL_AM_MANAGER_TOWN' => 'AM_MANAGER_TOWN',
        'COL_AM_MANAGER_TOWN' => 'AM_MANAGER_TOWN',
        'am_manager_town' => 'AM_MANAGER_TOWN',
        'export_edetailing.am_manager_town' => 'AM_MANAGER_TOWN',
        'ZmPositionCode' => 'ZM_POSITION_CODE',
        'ExportEdetailing.ZmPositionCode' => 'ZM_POSITION_CODE',
        'zmPositionCode' => 'ZM_POSITION_CODE',
        'exportEdetailing.zmPositionCode' => 'ZM_POSITION_CODE',
        'ExportEdetailingTableMap::COL_ZM_POSITION_CODE' => 'ZM_POSITION_CODE',
        'COL_ZM_POSITION_CODE' => 'ZM_POSITION_CODE',
        'zm_position_code' => 'ZM_POSITION_CODE',
        'export_edetailing.zm_position_code' => 'ZM_POSITION_CODE',
        'RmPositionCode' => 'RM_POSITION_CODE',
        'ExportEdetailing.RmPositionCode' => 'RM_POSITION_CODE',
        'rmPositionCode' => 'RM_POSITION_CODE',
        'exportEdetailing.rmPositionCode' => 'RM_POSITION_CODE',
        'ExportEdetailingTableMap::COL_RM_POSITION_CODE' => 'RM_POSITION_CODE',
        'COL_RM_POSITION_CODE' => 'RM_POSITION_CODE',
        'rm_position_code' => 'RM_POSITION_CODE',
        'export_edetailing.rm_position_code' => 'RM_POSITION_CODE',
        'AmPositionCode' => 'AM_POSITION_CODE',
        'ExportEdetailing.AmPositionCode' => 'AM_POSITION_CODE',
        'amPositionCode' => 'AM_POSITION_CODE',
        'exportEdetailing.amPositionCode' => 'AM_POSITION_CODE',
        'ExportEdetailingTableMap::COL_AM_POSITION_CODE' => 'AM_POSITION_CODE',
        'COL_AM_POSITION_CODE' => 'AM_POSITION_CODE',
        'am_position_code' => 'AM_POSITION_CODE',
        'export_edetailing.am_position_code' => 'AM_POSITION_CODE',
        'EmpPositionCode' => 'EMP_POSITION_CODE',
        'ExportEdetailing.EmpPositionCode' => 'EMP_POSITION_CODE',
        'empPositionCode' => 'EMP_POSITION_CODE',
        'exportEdetailing.empPositionCode' => 'EMP_POSITION_CODE',
        'ExportEdetailingTableMap::COL_EMP_POSITION_CODE' => 'EMP_POSITION_CODE',
        'COL_EMP_POSITION_CODE' => 'EMP_POSITION_CODE',
        'emp_position_code' => 'EMP_POSITION_CODE',
        'export_edetailing.emp_position_code' => 'EMP_POSITION_CODE',
        'EmpPositionName' => 'EMP_POSITION_NAME',
        'ExportEdetailing.EmpPositionName' => 'EMP_POSITION_NAME',
        'empPositionName' => 'EMP_POSITION_NAME',
        'exportEdetailing.empPositionName' => 'EMP_POSITION_NAME',
        'ExportEdetailingTableMap::COL_EMP_POSITION_NAME' => 'EMP_POSITION_NAME',
        'COL_EMP_POSITION_NAME' => 'EMP_POSITION_NAME',
        'emp_position_name' => 'EMP_POSITION_NAME',
        'export_edetailing.emp_position_name' => 'EMP_POSITION_NAME',
        'EmpLevel' => 'EMP_LEVEL',
        'ExportEdetailing.EmpLevel' => 'EMP_LEVEL',
        'empLevel' => 'EMP_LEVEL',
        'exportEdetailing.empLevel' => 'EMP_LEVEL',
        'ExportEdetailingTableMap::COL_EMP_LEVEL' => 'EMP_LEVEL',
        'COL_EMP_LEVEL' => 'EMP_LEVEL',
        'emp_level' => 'EMP_LEVEL',
        'export_edetailing.emp_level' => 'EMP_LEVEL',
        'EmployeeCode' => 'EMPLOYEE_CODE',
        'ExportEdetailing.EmployeeCode' => 'EMPLOYEE_CODE',
        'employeeCode' => 'EMPLOYEE_CODE',
        'exportEdetailing.employeeCode' => 'EMPLOYEE_CODE',
        'ExportEdetailingTableMap::COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'employee_code' => 'EMPLOYEE_CODE',
        'export_edetailing.employee_code' => 'EMPLOYEE_CODE',
        'Employee' => 'EMPLOYEE',
        'ExportEdetailing.Employee' => 'EMPLOYEE',
        'employee' => 'EMPLOYEE',
        'exportEdetailing.employee' => 'EMPLOYEE',
        'ExportEdetailingTableMap::COL_EMPLOYEE' => 'EMPLOYEE',
        'COL_EMPLOYEE' => 'EMPLOYEE',
        'export_edetailing.employee' => 'EMPLOYEE',
        'DeviceStartTime' => 'DEVICE_START_TIME',
        'ExportEdetailing.DeviceStartTime' => 'DEVICE_START_TIME',
        'deviceStartTime' => 'DEVICE_START_TIME',
        'exportEdetailing.deviceStartTime' => 'DEVICE_START_TIME',
        'ExportEdetailingTableMap::COL_DEVICE_START_TIME' => 'DEVICE_START_TIME',
        'COL_DEVICE_START_TIME' => 'DEVICE_START_TIME',
        'device_start_time' => 'DEVICE_START_TIME',
        'export_edetailing.device_start_time' => 'DEVICE_START_TIME',
        'DeviceEndTime' => 'DEVICE_END_TIME',
        'ExportEdetailing.DeviceEndTime' => 'DEVICE_END_TIME',
        'deviceEndTime' => 'DEVICE_END_TIME',
        'exportEdetailing.deviceEndTime' => 'DEVICE_END_TIME',
        'ExportEdetailingTableMap::COL_DEVICE_END_TIME' => 'DEVICE_END_TIME',
        'COL_DEVICE_END_TIME' => 'DEVICE_END_TIME',
        'device_end_time' => 'DEVICE_END_TIME',
        'export_edetailing.device_end_time' => 'DEVICE_END_TIME',
        'OutletType' => 'OUTLET_TYPE',
        'ExportEdetailing.OutletType' => 'OUTLET_TYPE',
        'outletType' => 'OUTLET_TYPE',
        'exportEdetailing.outletType' => 'OUTLET_TYPE',
        'ExportEdetailingTableMap::COL_OUTLET_TYPE' => 'OUTLET_TYPE',
        'COL_OUTLET_TYPE' => 'OUTLET_TYPE',
        'outlet_type' => 'OUTLET_TYPE',
        'export_edetailing.outlet_type' => 'OUTLET_TYPE',
        'OutletCode' => 'OUTLET_CODE',
        'ExportEdetailing.OutletCode' => 'OUTLET_CODE',
        'outletCode' => 'OUTLET_CODE',
        'exportEdetailing.outletCode' => 'OUTLET_CODE',
        'ExportEdetailingTableMap::COL_OUTLET_CODE' => 'OUTLET_CODE',
        'COL_OUTLET_CODE' => 'OUTLET_CODE',
        'outlet_code' => 'OUTLET_CODE',
        'export_edetailing.outlet_code' => 'OUTLET_CODE',
        'OutletName' => 'OUTLET_NAME',
        'ExportEdetailing.OutletName' => 'OUTLET_NAME',
        'outletName' => 'OUTLET_NAME',
        'exportEdetailing.outletName' => 'OUTLET_NAME',
        'ExportEdetailingTableMap::COL_OUTLET_NAME' => 'OUTLET_NAME',
        'COL_OUTLET_NAME' => 'OUTLET_NAME',
        'outlet_name' => 'OUTLET_NAME',
        'export_edetailing.outlet_name' => 'OUTLET_NAME',
        'OutletClassification' => 'OUTLET_CLASSIFICATION',
        'ExportEdetailing.OutletClassification' => 'OUTLET_CLASSIFICATION',
        'outletClassification' => 'OUTLET_CLASSIFICATION',
        'exportEdetailing.outletClassification' => 'OUTLET_CLASSIFICATION',
        'ExportEdetailingTableMap::COL_OUTLET_CLASSIFICATION' => 'OUTLET_CLASSIFICATION',
        'COL_OUTLET_CLASSIFICATION' => 'OUTLET_CLASSIFICATION',
        'outlet_classification' => 'OUTLET_CLASSIFICATION',
        'export_edetailing.outlet_classification' => 'OUTLET_CLASSIFICATION',
        'BrandName' => 'BRAND_NAME',
        'ExportEdetailing.BrandName' => 'BRAND_NAME',
        'brandName' => 'BRAND_NAME',
        'exportEdetailing.brandName' => 'BRAND_NAME',
        'ExportEdetailingTableMap::COL_BRAND_NAME' => 'BRAND_NAME',
        'COL_BRAND_NAME' => 'BRAND_NAME',
        'brand_name' => 'BRAND_NAME',
        'export_edetailing.brand_name' => 'BRAND_NAME',
        'SessionId' => 'SESSION_ID',
        'ExportEdetailing.SessionId' => 'SESSION_ID',
        'sessionId' => 'SESSION_ID',
        'exportEdetailing.sessionId' => 'SESSION_ID',
        'ExportEdetailingTableMap::COL_SESSION_ID' => 'SESSION_ID',
        'COL_SESSION_ID' => 'SESSION_ID',
        'session_id' => 'SESSION_ID',
        'export_edetailing.session_id' => 'SESSION_ID',
        'BrandId' => 'BRAND_ID',
        'ExportEdetailing.BrandId' => 'BRAND_ID',
        'brandId' => 'BRAND_ID',
        'exportEdetailing.brandId' => 'BRAND_ID',
        'ExportEdetailingTableMap::COL_BRAND_ID' => 'BRAND_ID',
        'COL_BRAND_ID' => 'BRAND_ID',
        'brand_id' => 'BRAND_ID',
        'export_edetailing.brand_id' => 'BRAND_ID',
        'PresentationOrder' => 'PRESENTATION_ORDER',
        'ExportEdetailing.PresentationOrder' => 'PRESENTATION_ORDER',
        'presentationOrder' => 'PRESENTATION_ORDER',
        'exportEdetailing.presentationOrder' => 'PRESENTATION_ORDER',
        'ExportEdetailingTableMap::COL_PRESENTATION_ORDER' => 'PRESENTATION_ORDER',
        'COL_PRESENTATION_ORDER' => 'PRESENTATION_ORDER',
        'presentation_order' => 'PRESENTATION_ORDER',
        'export_edetailing.presentation_order' => 'PRESENTATION_ORDER',
        'Presentation' => 'PRESENTATION',
        'ExportEdetailing.Presentation' => 'PRESENTATION',
        'presentation' => 'PRESENTATION',
        'exportEdetailing.presentation' => 'PRESENTATION',
        'ExportEdetailingTableMap::COL_PRESENTATION' => 'PRESENTATION',
        'COL_PRESENTATION' => 'PRESENTATION',
        'export_edetailing.presentation' => 'PRESENTATION',
        'Playlist' => 'PLAYLIST',
        'ExportEdetailing.Playlist' => 'PLAYLIST',
        'playlist' => 'PLAYLIST',
        'exportEdetailing.playlist' => 'PLAYLIST',
        'ExportEdetailingTableMap::COL_PLAYLIST' => 'PLAYLIST',
        'COL_PLAYLIST' => 'PLAYLIST',
        'export_edetailing.playlist' => 'PLAYLIST',
        'PageCount' => 'PAGE_COUNT',
        'ExportEdetailing.PageCount' => 'PAGE_COUNT',
        'pageCount' => 'PAGE_COUNT',
        'exportEdetailing.pageCount' => 'PAGE_COUNT',
        'ExportEdetailingTableMap::COL_PAGE_COUNT' => 'PAGE_COUNT',
        'COL_PAGE_COUNT' => 'PAGE_COUNT',
        'page_count' => 'PAGE_COUNT',
        'export_edetailing.page_count' => 'PAGE_COUNT',
        'PresentationTime' => 'PRESENTATION_TIME',
        'ExportEdetailing.PresentationTime' => 'PRESENTATION_TIME',
        'presentationTime' => 'PRESENTATION_TIME',
        'exportEdetailing.presentationTime' => 'PRESENTATION_TIME',
        'ExportEdetailingTableMap::COL_PRESENTATION_TIME' => 'PRESENTATION_TIME',
        'COL_PRESENTATION_TIME' => 'PRESENTATION_TIME',
        'presentation_time' => 'PRESENTATION_TIME',
        'export_edetailing.presentation_time' => 'PRESENTATION_TIME',
        'PageName' => 'PAGE_NAME',
        'ExportEdetailing.PageName' => 'PAGE_NAME',
        'pageName' => 'PAGE_NAME',
        'exportEdetailing.pageName' => 'PAGE_NAME',
        'ExportEdetailingTableMap::COL_PAGE_NAME' => 'PAGE_NAME',
        'COL_PAGE_NAME' => 'PAGE_NAME',
        'page_name' => 'PAGE_NAME',
        'export_edetailing.page_name' => 'PAGE_NAME',
        'Smiley' => 'SMILEY',
        'ExportEdetailing.Smiley' => 'SMILEY',
        'smiley' => 'SMILEY',
        'exportEdetailing.smiley' => 'SMILEY',
        'ExportEdetailingTableMap::COL_SMILEY' => 'SMILEY',
        'COL_SMILEY' => 'SMILEY',
        'export_edetailing.smiley' => 'SMILEY',
        'EdDate' => 'ED_DATE',
        'ExportEdetailing.EdDate' => 'ED_DATE',
        'edDate' => 'ED_DATE',
        'exportEdetailing.edDate' => 'ED_DATE',
        'ExportEdetailingTableMap::COL_ED_DATE' => 'ED_DATE',
        'COL_ED_DATE' => 'ED_DATE',
        'ed_date' => 'ED_DATE',
        'export_edetailing.ed_date' => 'ED_DATE',
        'CreatedAt' => 'CREATED_AT',
        'ExportEdetailing.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'exportEdetailing.createdAt' => 'CREATED_AT',
        'ExportEdetailingTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'export_edetailing.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'ExportEdetailing.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'exportEdetailing.updatedAt' => 'UPDATED_AT',
        'ExportEdetailingTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'export_edetailing.updated_at' => 'UPDATED_AT',
        'EmpTerritory' => 'EMP_TERRITORY',
        'ExportEdetailing.EmpTerritory' => 'EMP_TERRITORY',
        'empTerritory' => 'EMP_TERRITORY',
        'exportEdetailing.empTerritory' => 'EMP_TERRITORY',
        'ExportEdetailingTableMap::COL_EMP_TERRITORY' => 'EMP_TERRITORY',
        'COL_EMP_TERRITORY' => 'EMP_TERRITORY',
        'emp_territory' => 'EMP_TERRITORY',
        'export_edetailing.emp_territory' => 'EMP_TERRITORY',
        'EmpBranch' => 'EMP_BRANCH',
        'ExportEdetailing.EmpBranch' => 'EMP_BRANCH',
        'empBranch' => 'EMP_BRANCH',
        'exportEdetailing.empBranch' => 'EMP_BRANCH',
        'ExportEdetailingTableMap::COL_EMP_BRANCH' => 'EMP_BRANCH',
        'COL_EMP_BRANCH' => 'EMP_BRANCH',
        'emp_branch' => 'EMP_BRANCH',
        'export_edetailing.emp_branch' => 'EMP_BRANCH',
        'EmpTown' => 'EMP_TOWN',
        'ExportEdetailing.EmpTown' => 'EMP_TOWN',
        'empTown' => 'EMP_TOWN',
        'exportEdetailing.empTown' => 'EMP_TOWN',
        'ExportEdetailingTableMap::COL_EMP_TOWN' => 'EMP_TOWN',
        'COL_EMP_TOWN' => 'EMP_TOWN',
        'emp_town' => 'EMP_TOWN',
        'export_edetailing.emp_town' => 'EMP_TOWN',
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
        $this->setName('export_edetailing');
        $this->setPhpName('ExportEdetailing');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\ExportEdetailing');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addColumn('bu_name', 'BuName', 'VARCHAR', false, 255, null);
        $this->addColumn('zm_manager_branch', 'ZmManagerBranch', 'VARCHAR', false, 255, null);
        $this->addColumn('zm_manager_town', 'ZmManagerTown', 'VARCHAR', false, 255, null);
        $this->addColumn('rm_manager_branch', 'RmManagerBranch', 'VARCHAR', false, 255, null);
        $this->addColumn('rm_manager_town', 'RmManagerTown', 'VARCHAR', false, 255, null);
        $this->addColumn('am_manager_branch', 'AmManagerBranch', 'VARCHAR', false, 255, null);
        $this->addColumn('am_manager_town', 'AmManagerTown', 'VARCHAR', false, 255, null);
        $this->addColumn('zm_position_code', 'ZmPositionCode', 'VARCHAR', false, 255, null);
        $this->addColumn('rm_position_code', 'RmPositionCode', 'VARCHAR', false, 255, null);
        $this->addColumn('am_position_code', 'AmPositionCode', 'VARCHAR', false, 255, null);
        $this->addColumn('emp_position_code', 'EmpPositionCode', 'VARCHAR', false, 255, null);
        $this->addColumn('emp_position_name', 'EmpPositionName', 'VARCHAR', false, 255, null);
        $this->addColumn('emp_level', 'EmpLevel', 'VARCHAR', false, 255, null);
        $this->addColumn('employee_code', 'EmployeeCode', 'VARCHAR', false, 255, null);
        $this->addColumn('employee', 'Employee', 'VARCHAR', false, null, null);
        $this->addColumn('device_start_time', 'DeviceStartTime', 'TIMESTAMP', false, null, null);
        $this->addColumn('device_end_time', 'DeviceEndTime', 'TIMESTAMP', false, null, null);
        $this->addColumn('outlet_type', 'OutletType', 'VARCHAR', false, 255, null);
        $this->addColumn('outlet_code', 'OutletCode', 'VARCHAR', false, 255, null);
        $this->addColumn('outlet_name', 'OutletName', 'VARCHAR', false, 255, null);
        $this->addColumn('outlet_classification', 'OutletClassification', 'VARCHAR', false, 255, null);
        $this->addColumn('brand_name', 'BrandName', 'VARCHAR', false, 255, null);
        $this->addColumn('session_id', 'SessionId', 'VARCHAR', false, 255, null);
        $this->addColumn('brand_id', 'BrandId', 'INTEGER', false, null, null);
        $this->addColumn('presentation_order', 'PresentationOrder', 'INTEGER', false, null, null);
        $this->addColumn('presentation', 'Presentation', 'VARCHAR', false, 255, null);
        $this->addColumn('playlist', 'Playlist', 'VARCHAR', false, 255, null);
        $this->addColumn('page_count', 'PageCount', 'VARCHAR', false, 255, null);
        $this->addColumn('presentation_time', 'PresentationTime', 'INTEGER', false, null, null);
        $this->addColumn('page_name', 'PageName', 'VARCHAR', false, 255, null);
        $this->addColumn('smiley', 'Smiley', 'VARCHAR', false, null, null);
        $this->addColumn('ed_date', 'EdDate', 'DATE', false, null, null);
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
        return $withPrefix ? ExportEdetailingTableMap::CLASS_DEFAULT : ExportEdetailingTableMap::OM_CLASS;
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
     * @return array (ExportEdetailing object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ExportEdetailingTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ExportEdetailingTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ExportEdetailingTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ExportEdetailingTableMap::OM_CLASS;
            /** @var ExportEdetailing $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ExportEdetailingTableMap::addInstanceToPool($obj, $key);
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
            $key = ExportEdetailingTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ExportEdetailingTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ExportEdetailing $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ExportEdetailingTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_BU_NAME);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_ZM_MANAGER_BRANCH);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_ZM_MANAGER_TOWN);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_RM_MANAGER_BRANCH);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_RM_MANAGER_TOWN);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_AM_MANAGER_BRANCH);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_AM_MANAGER_TOWN);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_ZM_POSITION_CODE);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_RM_POSITION_CODE);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_AM_POSITION_CODE);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_EMP_POSITION_CODE);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_EMP_POSITION_NAME);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_EMP_LEVEL);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_EMPLOYEE_CODE);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_EMPLOYEE);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_DEVICE_START_TIME);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_DEVICE_END_TIME);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_OUTLET_TYPE);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_OUTLET_CODE);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_OUTLET_NAME);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_OUTLET_CLASSIFICATION);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_BRAND_NAME);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_SESSION_ID);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_BRAND_ID);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_PRESENTATION_ORDER);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_PRESENTATION);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_PLAYLIST);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_PAGE_COUNT);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_PRESENTATION_TIME);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_PAGE_NAME);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_SMILEY);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_ED_DATE);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_EMP_TERRITORY);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_EMP_BRANCH);
            $criteria->addSelectColumn(ExportEdetailingTableMap::COL_EMP_TOWN);
        } else {
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
            $criteria->addSelectColumn($alias . '.employee');
            $criteria->addSelectColumn($alias . '.device_start_time');
            $criteria->addSelectColumn($alias . '.device_end_time');
            $criteria->addSelectColumn($alias . '.outlet_type');
            $criteria->addSelectColumn($alias . '.outlet_code');
            $criteria->addSelectColumn($alias . '.outlet_name');
            $criteria->addSelectColumn($alias . '.outlet_classification');
            $criteria->addSelectColumn($alias . '.brand_name');
            $criteria->addSelectColumn($alias . '.session_id');
            $criteria->addSelectColumn($alias . '.brand_id');
            $criteria->addSelectColumn($alias . '.presentation_order');
            $criteria->addSelectColumn($alias . '.presentation');
            $criteria->addSelectColumn($alias . '.playlist');
            $criteria->addSelectColumn($alias . '.page_count');
            $criteria->addSelectColumn($alias . '.presentation_time');
            $criteria->addSelectColumn($alias . '.page_name');
            $criteria->addSelectColumn($alias . '.smiley');
            $criteria->addSelectColumn($alias . '.ed_date');
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
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_BU_NAME);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_ZM_MANAGER_BRANCH);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_ZM_MANAGER_TOWN);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_RM_MANAGER_BRANCH);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_RM_MANAGER_TOWN);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_AM_MANAGER_BRANCH);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_AM_MANAGER_TOWN);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_ZM_POSITION_CODE);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_RM_POSITION_CODE);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_AM_POSITION_CODE);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_EMP_POSITION_CODE);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_EMP_POSITION_NAME);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_EMP_LEVEL);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_EMPLOYEE_CODE);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_EMPLOYEE);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_DEVICE_START_TIME);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_DEVICE_END_TIME);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_OUTLET_TYPE);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_OUTLET_CODE);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_OUTLET_NAME);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_OUTLET_CLASSIFICATION);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_BRAND_NAME);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_SESSION_ID);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_BRAND_ID);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_PRESENTATION_ORDER);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_PRESENTATION);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_PLAYLIST);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_PAGE_COUNT);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_PRESENTATION_TIME);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_PAGE_NAME);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_SMILEY);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_ED_DATE);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_EMP_TERRITORY);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_EMP_BRANCH);
            $criteria->removeSelectColumn(ExportEdetailingTableMap::COL_EMP_TOWN);
        } else {
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
            $criteria->removeSelectColumn($alias . '.employee');
            $criteria->removeSelectColumn($alias . '.device_start_time');
            $criteria->removeSelectColumn($alias . '.device_end_time');
            $criteria->removeSelectColumn($alias . '.outlet_type');
            $criteria->removeSelectColumn($alias . '.outlet_code');
            $criteria->removeSelectColumn($alias . '.outlet_name');
            $criteria->removeSelectColumn($alias . '.outlet_classification');
            $criteria->removeSelectColumn($alias . '.brand_name');
            $criteria->removeSelectColumn($alias . '.session_id');
            $criteria->removeSelectColumn($alias . '.brand_id');
            $criteria->removeSelectColumn($alias . '.presentation_order');
            $criteria->removeSelectColumn($alias . '.presentation');
            $criteria->removeSelectColumn($alias . '.playlist');
            $criteria->removeSelectColumn($alias . '.page_count');
            $criteria->removeSelectColumn($alias . '.presentation_time');
            $criteria->removeSelectColumn($alias . '.page_name');
            $criteria->removeSelectColumn($alias . '.smiley');
            $criteria->removeSelectColumn($alias . '.ed_date');
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
        return Propel::getServiceContainer()->getDatabaseMap(ExportEdetailingTableMap::DATABASE_NAME)->getTable(ExportEdetailingTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a ExportEdetailing or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or ExportEdetailing object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ExportEdetailingTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\ExportEdetailing) { // it's a model object
            // create criteria based on pk value
            $criteria = $values->buildCriteria();
        } else { // it's a primary key, or an array of pks
            throw new LogicException('The ExportEdetailing object has no primary key');
        }

        $query = ExportEdetailingQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ExportEdetailingTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ExportEdetailingTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the export_edetailing table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ExportEdetailingQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ExportEdetailing or Criteria object.
     *
     * @param mixed $criteria Criteria or ExportEdetailing object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExportEdetailingTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ExportEdetailing object
        }


        // Set the correct dbName
        $query = ExportEdetailingQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
