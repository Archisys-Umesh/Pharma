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
use entities\ExportDar;
use entities\ExportDarQuery;


/**
 * This class defines the structure of the 'export_dar' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ExportDarTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.ExportDarTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'export_dar';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'ExportDar';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\ExportDar';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.ExportDar';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 44;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 44;

    /**
     * the column name for the bu_name field
     */
    public const COL_BU_NAME = 'export_dar.bu_name';

    /**
     * the column name for the zm_manager_branch field
     */
    public const COL_ZM_MANAGER_BRANCH = 'export_dar.zm_manager_branch';

    /**
     * the column name for the zm_manager_town field
     */
    public const COL_ZM_MANAGER_TOWN = 'export_dar.zm_manager_town';

    /**
     * the column name for the rm_manager_branch field
     */
    public const COL_RM_MANAGER_BRANCH = 'export_dar.rm_manager_branch';

    /**
     * the column name for the rm_manager_town field
     */
    public const COL_RM_MANAGER_TOWN = 'export_dar.rm_manager_town';

    /**
     * the column name for the am_manager_branch field
     */
    public const COL_AM_MANAGER_BRANCH = 'export_dar.am_manager_branch';

    /**
     * the column name for the am_manager_town field
     */
    public const COL_AM_MANAGER_TOWN = 'export_dar.am_manager_town';

    /**
     * the column name for the zm_position_code field
     */
    public const COL_ZM_POSITION_CODE = 'export_dar.zm_position_code';

    /**
     * the column name for the rm_position_code field
     */
    public const COL_RM_POSITION_CODE = 'export_dar.rm_position_code';

    /**
     * the column name for the am_position_code field
     */
    public const COL_AM_POSITION_CODE = 'export_dar.am_position_code';

    /**
     * the column name for the emp_position_code field
     */
    public const COL_EMP_POSITION_CODE = 'export_dar.emp_position_code';

    /**
     * the column name for the emp_position_name field
     */
    public const COL_EMP_POSITION_NAME = 'export_dar.emp_position_name';

    /**
     * the column name for the emp_level field
     */
    public const COL_EMP_LEVEL = 'export_dar.emp_level';

    /**
     * the column name for the employee_code field
     */
    public const COL_EMPLOYEE_CODE = 'export_dar.employee_code';

    /**
     * the column name for the employee field
     */
    public const COL_EMPLOYEE = 'export_dar.employee';

    /**
     * the column name for the jw_employee_code field
     */
    public const COL_JW_EMPLOYEE_CODE = 'export_dar.jw_employee_code';

    /**
     * the column name for the jw_employee field
     */
    public const COL_JW_EMPLOYEE = 'export_dar.jw_employee';

    /**
     * the column name for the jw_position_name field
     */
    public const COL_JW_POSITION_NAME = 'export_dar.jw_position_name';

    /**
     * the column name for the outlet_type field
     */
    public const COL_OUTLET_TYPE = 'export_dar.outlet_type';

    /**
     * the column name for the outlet_code field
     */
    public const COL_OUTLET_CODE = 'export_dar.outlet_code';

    /**
     * the column name for the outlet_name field
     */
    public const COL_OUTLET_NAME = 'export_dar.outlet_name';

    /**
     * the column name for the agendacontroltype field
     */
    public const COL_AGENDACONTROLTYPE = 'export_dar.agendacontroltype';

    /**
     * the column name for the agendname field
     */
    public const COL_AGENDNAME = 'export_dar.agendname';

    /**
     * the column name for the stownname field
     */
    public const COL_STOWNNAME = 'export_dar.stownname';

    /**
     * the column name for the dcr_date field
     */
    public const COL_DCR_DATE = 'export_dar.dcr_date';

    /**
     * the column name for the dcr_status field
     */
    public const COL_DCR_STATUS = 'export_dar.dcr_status';

    /**
     * the column name for the nca_comments field
     */
    public const COL_NCA_COMMENTS = 'export_dar.nca_comments';

    /**
     * the column name for the planned field
     */
    public const COL_PLANNED = 'export_dar.planned';

    /**
     * the column name for the managers_name field
     */
    public const COL_MANAGERS_NAME = 'export_dar.managers_name';

    /**
     * the column name for the brands_detailed_name field
     */
    public const COL_BRANDS_DETAILED_NAME = 'export_dar.brands_detailed_name';

    /**
     * the column name for the ed_duration field
     */
    public const COL_ED_DURATION = 'export_dar.ed_duration';

    /**
     * the column name for the datetime field
     */
    public const COL_DATETIME = 'export_dar.datetime';

    /**
     * the column name for the emp_territory field
     */
    public const COL_EMP_TERRITORY = 'export_dar.emp_territory';

    /**
     * the column name for the emp_branch field
     */
    public const COL_EMP_BRANCH = 'export_dar.emp_branch';

    /**
     * the column name for the emp_town field
     */
    public const COL_EMP_TOWN = 'export_dar.emp_town';

    /**
     * the column name for the customer_town field
     */
    public const COL_CUSTOMER_TOWN = 'export_dar.customer_town';

    /**
     * the column name for the customer_patch field
     */
    public const COL_CUSTOMER_PATCH = 'export_dar.customer_patch';

    /**
     * the column name for the leave_teken field
     */
    public const COL_LEAVE_TEKEN = 'export_dar.leave_teken';

    /**
     * the column name for the dcr_id field
     */
    public const COL_DCR_ID = 'export_dar.dcr_id';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'export_dar.updated_at';

    /**
     * the column name for the isjw field
     */
    public const COL_ISJW = 'export_dar.isjw';

    /**
     * the column name for the sgpi_out field
     */
    public const COL_SGPI_OUT = 'export_dar.sgpi_out';

    /**
     * the column name for the pob_total field
     */
    public const COL_POB_TOTAL = 'export_dar.pob_total';

    /**
     * the column name for the outlet_id field
     */
    public const COL_OUTLET_ID = 'export_dar.outlet_id';

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
        self::TYPE_PHPNAME       => ['BuName', 'ZmManagerBranch', 'ZmManagerTown', 'RmManagerBranch', 'RmManagerTown', 'AmManagerBranch', 'AmManagerTown', 'ZmPositionCode', 'RmPositionCode', 'AmPositionCode', 'EmpPositionCode', 'EmpPositionName', 'EmpLevel', 'EmployeeCode', 'Employee', 'JwEmployeeCode', 'JwEmployee', 'JwPositionName', 'OutletType', 'OutletCode', 'OutletName', 'Agendacontroltype', 'Agendname', 'Stownname', 'DcrDate', 'DcrStatus', 'NcaComments', 'Planned', 'ManagersName', 'BrandsDetailedName', 'EdDuration', 'DateTime', 'EmpTerritory', 'EmpBranch', 'EmpTown', 'CustomerTown', 'CustomerPatch', 'LeaveTaken', 'DcrId', 'UpdatedAt', 'IsJw', 'SgpiOut', 'PobTotal', 'OutletId', ],
        self::TYPE_CAMELNAME     => ['buName', 'zmManagerBranch', 'zmManagerTown', 'rmManagerBranch', 'rmManagerTown', 'amManagerBranch', 'amManagerTown', 'zmPositionCode', 'rmPositionCode', 'amPositionCode', 'empPositionCode', 'empPositionName', 'empLevel', 'employeeCode', 'employee', 'jwEmployeeCode', 'jwEmployee', 'jwPositionName', 'outletType', 'outletCode', 'outletName', 'agendacontroltype', 'agendname', 'stownname', 'dcrDate', 'dcrStatus', 'ncaComments', 'planned', 'managersName', 'brandsDetailedName', 'edDuration', 'dateTime', 'empTerritory', 'empBranch', 'empTown', 'customerTown', 'customerPatch', 'leaveTaken', 'dcrId', 'updatedAt', 'isJw', 'sgpiOut', 'pobTotal', 'outletId', ],
        self::TYPE_COLNAME       => [ExportDarTableMap::COL_BU_NAME, ExportDarTableMap::COL_ZM_MANAGER_BRANCH, ExportDarTableMap::COL_ZM_MANAGER_TOWN, ExportDarTableMap::COL_RM_MANAGER_BRANCH, ExportDarTableMap::COL_RM_MANAGER_TOWN, ExportDarTableMap::COL_AM_MANAGER_BRANCH, ExportDarTableMap::COL_AM_MANAGER_TOWN, ExportDarTableMap::COL_ZM_POSITION_CODE, ExportDarTableMap::COL_RM_POSITION_CODE, ExportDarTableMap::COL_AM_POSITION_CODE, ExportDarTableMap::COL_EMP_POSITION_CODE, ExportDarTableMap::COL_EMP_POSITION_NAME, ExportDarTableMap::COL_EMP_LEVEL, ExportDarTableMap::COL_EMPLOYEE_CODE, ExportDarTableMap::COL_EMPLOYEE, ExportDarTableMap::COL_JW_EMPLOYEE_CODE, ExportDarTableMap::COL_JW_EMPLOYEE, ExportDarTableMap::COL_JW_POSITION_NAME, ExportDarTableMap::COL_OUTLET_TYPE, ExportDarTableMap::COL_OUTLET_CODE, ExportDarTableMap::COL_OUTLET_NAME, ExportDarTableMap::COL_AGENDACONTROLTYPE, ExportDarTableMap::COL_AGENDNAME, ExportDarTableMap::COL_STOWNNAME, ExportDarTableMap::COL_DCR_DATE, ExportDarTableMap::COL_DCR_STATUS, ExportDarTableMap::COL_NCA_COMMENTS, ExportDarTableMap::COL_PLANNED, ExportDarTableMap::COL_MANAGERS_NAME, ExportDarTableMap::COL_BRANDS_DETAILED_NAME, ExportDarTableMap::COL_ED_DURATION, ExportDarTableMap::COL_DATETIME, ExportDarTableMap::COL_EMP_TERRITORY, ExportDarTableMap::COL_EMP_BRANCH, ExportDarTableMap::COL_EMP_TOWN, ExportDarTableMap::COL_CUSTOMER_TOWN, ExportDarTableMap::COL_CUSTOMER_PATCH, ExportDarTableMap::COL_LEAVE_TEKEN, ExportDarTableMap::COL_DCR_ID, ExportDarTableMap::COL_UPDATED_AT, ExportDarTableMap::COL_ISJW, ExportDarTableMap::COL_SGPI_OUT, ExportDarTableMap::COL_POB_TOTAL, ExportDarTableMap::COL_OUTLET_ID, ],
        self::TYPE_FIELDNAME     => ['bu_name', 'zm_manager_branch', 'zm_manager_town', 'rm_manager_branch', 'rm_manager_town', 'am_manager_branch', 'am_manager_town', 'zm_position_code', 'rm_position_code', 'am_position_code', 'emp_position_code', 'emp_position_name', 'emp_level', 'employee_code', 'employee', 'jw_employee_code', 'jw_employee', 'jw_position_name', 'outlet_type', 'outlet_code', 'outlet_name', 'agendacontroltype', 'agendname', 'stownname', 'dcr_date', 'dcr_status', 'nca_comments', 'planned', 'managers_name', 'brands_detailed_name', 'ed_duration', 'datetime', 'emp_territory', 'emp_branch', 'emp_town', 'customer_town', 'customer_patch', 'leave_teken', 'dcr_id', 'updated_at', 'isjw', 'sgpi_out', 'pob_total', 'outlet_id', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, ]
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
        self::TYPE_PHPNAME       => ['BuName' => 0, 'ZmManagerBranch' => 1, 'ZmManagerTown' => 2, 'RmManagerBranch' => 3, 'RmManagerTown' => 4, 'AmManagerBranch' => 5, 'AmManagerTown' => 6, 'ZmPositionCode' => 7, 'RmPositionCode' => 8, 'AmPositionCode' => 9, 'EmpPositionCode' => 10, 'EmpPositionName' => 11, 'EmpLevel' => 12, 'EmployeeCode' => 13, 'Employee' => 14, 'JwEmployeeCode' => 15, 'JwEmployee' => 16, 'JwPositionName' => 17, 'OutletType' => 18, 'OutletCode' => 19, 'OutletName' => 20, 'Agendacontroltype' => 21, 'Agendname' => 22, 'Stownname' => 23, 'DcrDate' => 24, 'DcrStatus' => 25, 'NcaComments' => 26, 'Planned' => 27, 'ManagersName' => 28, 'BrandsDetailedName' => 29, 'EdDuration' => 30, 'DateTime' => 31, 'EmpTerritory' => 32, 'EmpBranch' => 33, 'EmpTown' => 34, 'CustomerTown' => 35, 'CustomerPatch' => 36, 'LeaveTaken' => 37, 'DcrId' => 38, 'UpdatedAt' => 39, 'IsJw' => 40, 'SgpiOut' => 41, 'PobTotal' => 42, 'OutletId' => 43, ],
        self::TYPE_CAMELNAME     => ['buName' => 0, 'zmManagerBranch' => 1, 'zmManagerTown' => 2, 'rmManagerBranch' => 3, 'rmManagerTown' => 4, 'amManagerBranch' => 5, 'amManagerTown' => 6, 'zmPositionCode' => 7, 'rmPositionCode' => 8, 'amPositionCode' => 9, 'empPositionCode' => 10, 'empPositionName' => 11, 'empLevel' => 12, 'employeeCode' => 13, 'employee' => 14, 'jwEmployeeCode' => 15, 'jwEmployee' => 16, 'jwPositionName' => 17, 'outletType' => 18, 'outletCode' => 19, 'outletName' => 20, 'agendacontroltype' => 21, 'agendname' => 22, 'stownname' => 23, 'dcrDate' => 24, 'dcrStatus' => 25, 'ncaComments' => 26, 'planned' => 27, 'managersName' => 28, 'brandsDetailedName' => 29, 'edDuration' => 30, 'dateTime' => 31, 'empTerritory' => 32, 'empBranch' => 33, 'empTown' => 34, 'customerTown' => 35, 'customerPatch' => 36, 'leaveTaken' => 37, 'dcrId' => 38, 'updatedAt' => 39, 'isJw' => 40, 'sgpiOut' => 41, 'pobTotal' => 42, 'outletId' => 43, ],
        self::TYPE_COLNAME       => [ExportDarTableMap::COL_BU_NAME => 0, ExportDarTableMap::COL_ZM_MANAGER_BRANCH => 1, ExportDarTableMap::COL_ZM_MANAGER_TOWN => 2, ExportDarTableMap::COL_RM_MANAGER_BRANCH => 3, ExportDarTableMap::COL_RM_MANAGER_TOWN => 4, ExportDarTableMap::COL_AM_MANAGER_BRANCH => 5, ExportDarTableMap::COL_AM_MANAGER_TOWN => 6, ExportDarTableMap::COL_ZM_POSITION_CODE => 7, ExportDarTableMap::COL_RM_POSITION_CODE => 8, ExportDarTableMap::COL_AM_POSITION_CODE => 9, ExportDarTableMap::COL_EMP_POSITION_CODE => 10, ExportDarTableMap::COL_EMP_POSITION_NAME => 11, ExportDarTableMap::COL_EMP_LEVEL => 12, ExportDarTableMap::COL_EMPLOYEE_CODE => 13, ExportDarTableMap::COL_EMPLOYEE => 14, ExportDarTableMap::COL_JW_EMPLOYEE_CODE => 15, ExportDarTableMap::COL_JW_EMPLOYEE => 16, ExportDarTableMap::COL_JW_POSITION_NAME => 17, ExportDarTableMap::COL_OUTLET_TYPE => 18, ExportDarTableMap::COL_OUTLET_CODE => 19, ExportDarTableMap::COL_OUTLET_NAME => 20, ExportDarTableMap::COL_AGENDACONTROLTYPE => 21, ExportDarTableMap::COL_AGENDNAME => 22, ExportDarTableMap::COL_STOWNNAME => 23, ExportDarTableMap::COL_DCR_DATE => 24, ExportDarTableMap::COL_DCR_STATUS => 25, ExportDarTableMap::COL_NCA_COMMENTS => 26, ExportDarTableMap::COL_PLANNED => 27, ExportDarTableMap::COL_MANAGERS_NAME => 28, ExportDarTableMap::COL_BRANDS_DETAILED_NAME => 29, ExportDarTableMap::COL_ED_DURATION => 30, ExportDarTableMap::COL_DATETIME => 31, ExportDarTableMap::COL_EMP_TERRITORY => 32, ExportDarTableMap::COL_EMP_BRANCH => 33, ExportDarTableMap::COL_EMP_TOWN => 34, ExportDarTableMap::COL_CUSTOMER_TOWN => 35, ExportDarTableMap::COL_CUSTOMER_PATCH => 36, ExportDarTableMap::COL_LEAVE_TEKEN => 37, ExportDarTableMap::COL_DCR_ID => 38, ExportDarTableMap::COL_UPDATED_AT => 39, ExportDarTableMap::COL_ISJW => 40, ExportDarTableMap::COL_SGPI_OUT => 41, ExportDarTableMap::COL_POB_TOTAL => 42, ExportDarTableMap::COL_OUTLET_ID => 43, ],
        self::TYPE_FIELDNAME     => ['bu_name' => 0, 'zm_manager_branch' => 1, 'zm_manager_town' => 2, 'rm_manager_branch' => 3, 'rm_manager_town' => 4, 'am_manager_branch' => 5, 'am_manager_town' => 6, 'zm_position_code' => 7, 'rm_position_code' => 8, 'am_position_code' => 9, 'emp_position_code' => 10, 'emp_position_name' => 11, 'emp_level' => 12, 'employee_code' => 13, 'employee' => 14, 'jw_employee_code' => 15, 'jw_employee' => 16, 'jw_position_name' => 17, 'outlet_type' => 18, 'outlet_code' => 19, 'outlet_name' => 20, 'agendacontroltype' => 21, 'agendname' => 22, 'stownname' => 23, 'dcr_date' => 24, 'dcr_status' => 25, 'nca_comments' => 26, 'planned' => 27, 'managers_name' => 28, 'brands_detailed_name' => 29, 'ed_duration' => 30, 'datetime' => 31, 'emp_territory' => 32, 'emp_branch' => 33, 'emp_town' => 34, 'customer_town' => 35, 'customer_patch' => 36, 'leave_teken' => 37, 'dcr_id' => 38, 'updated_at' => 39, 'isjw' => 40, 'sgpi_out' => 41, 'pob_total' => 42, 'outlet_id' => 43, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'BuName' => 'BU_NAME',
        'ExportDar.BuName' => 'BU_NAME',
        'buName' => 'BU_NAME',
        'exportDar.buName' => 'BU_NAME',
        'ExportDarTableMap::COL_BU_NAME' => 'BU_NAME',
        'COL_BU_NAME' => 'BU_NAME',
        'bu_name' => 'BU_NAME',
        'export_dar.bu_name' => 'BU_NAME',
        'ZmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'ExportDar.ZmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'zmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'exportDar.zmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'ExportDarTableMap::COL_ZM_MANAGER_BRANCH' => 'ZM_MANAGER_BRANCH',
        'COL_ZM_MANAGER_BRANCH' => 'ZM_MANAGER_BRANCH',
        'zm_manager_branch' => 'ZM_MANAGER_BRANCH',
        'export_dar.zm_manager_branch' => 'ZM_MANAGER_BRANCH',
        'ZmManagerTown' => 'ZM_MANAGER_TOWN',
        'ExportDar.ZmManagerTown' => 'ZM_MANAGER_TOWN',
        'zmManagerTown' => 'ZM_MANAGER_TOWN',
        'exportDar.zmManagerTown' => 'ZM_MANAGER_TOWN',
        'ExportDarTableMap::COL_ZM_MANAGER_TOWN' => 'ZM_MANAGER_TOWN',
        'COL_ZM_MANAGER_TOWN' => 'ZM_MANAGER_TOWN',
        'zm_manager_town' => 'ZM_MANAGER_TOWN',
        'export_dar.zm_manager_town' => 'ZM_MANAGER_TOWN',
        'RmManagerBranch' => 'RM_MANAGER_BRANCH',
        'ExportDar.RmManagerBranch' => 'RM_MANAGER_BRANCH',
        'rmManagerBranch' => 'RM_MANAGER_BRANCH',
        'exportDar.rmManagerBranch' => 'RM_MANAGER_BRANCH',
        'ExportDarTableMap::COL_RM_MANAGER_BRANCH' => 'RM_MANAGER_BRANCH',
        'COL_RM_MANAGER_BRANCH' => 'RM_MANAGER_BRANCH',
        'rm_manager_branch' => 'RM_MANAGER_BRANCH',
        'export_dar.rm_manager_branch' => 'RM_MANAGER_BRANCH',
        'RmManagerTown' => 'RM_MANAGER_TOWN',
        'ExportDar.RmManagerTown' => 'RM_MANAGER_TOWN',
        'rmManagerTown' => 'RM_MANAGER_TOWN',
        'exportDar.rmManagerTown' => 'RM_MANAGER_TOWN',
        'ExportDarTableMap::COL_RM_MANAGER_TOWN' => 'RM_MANAGER_TOWN',
        'COL_RM_MANAGER_TOWN' => 'RM_MANAGER_TOWN',
        'rm_manager_town' => 'RM_MANAGER_TOWN',
        'export_dar.rm_manager_town' => 'RM_MANAGER_TOWN',
        'AmManagerBranch' => 'AM_MANAGER_BRANCH',
        'ExportDar.AmManagerBranch' => 'AM_MANAGER_BRANCH',
        'amManagerBranch' => 'AM_MANAGER_BRANCH',
        'exportDar.amManagerBranch' => 'AM_MANAGER_BRANCH',
        'ExportDarTableMap::COL_AM_MANAGER_BRANCH' => 'AM_MANAGER_BRANCH',
        'COL_AM_MANAGER_BRANCH' => 'AM_MANAGER_BRANCH',
        'am_manager_branch' => 'AM_MANAGER_BRANCH',
        'export_dar.am_manager_branch' => 'AM_MANAGER_BRANCH',
        'AmManagerTown' => 'AM_MANAGER_TOWN',
        'ExportDar.AmManagerTown' => 'AM_MANAGER_TOWN',
        'amManagerTown' => 'AM_MANAGER_TOWN',
        'exportDar.amManagerTown' => 'AM_MANAGER_TOWN',
        'ExportDarTableMap::COL_AM_MANAGER_TOWN' => 'AM_MANAGER_TOWN',
        'COL_AM_MANAGER_TOWN' => 'AM_MANAGER_TOWN',
        'am_manager_town' => 'AM_MANAGER_TOWN',
        'export_dar.am_manager_town' => 'AM_MANAGER_TOWN',
        'ZmPositionCode' => 'ZM_POSITION_CODE',
        'ExportDar.ZmPositionCode' => 'ZM_POSITION_CODE',
        'zmPositionCode' => 'ZM_POSITION_CODE',
        'exportDar.zmPositionCode' => 'ZM_POSITION_CODE',
        'ExportDarTableMap::COL_ZM_POSITION_CODE' => 'ZM_POSITION_CODE',
        'COL_ZM_POSITION_CODE' => 'ZM_POSITION_CODE',
        'zm_position_code' => 'ZM_POSITION_CODE',
        'export_dar.zm_position_code' => 'ZM_POSITION_CODE',
        'RmPositionCode' => 'RM_POSITION_CODE',
        'ExportDar.RmPositionCode' => 'RM_POSITION_CODE',
        'rmPositionCode' => 'RM_POSITION_CODE',
        'exportDar.rmPositionCode' => 'RM_POSITION_CODE',
        'ExportDarTableMap::COL_RM_POSITION_CODE' => 'RM_POSITION_CODE',
        'COL_RM_POSITION_CODE' => 'RM_POSITION_CODE',
        'rm_position_code' => 'RM_POSITION_CODE',
        'export_dar.rm_position_code' => 'RM_POSITION_CODE',
        'AmPositionCode' => 'AM_POSITION_CODE',
        'ExportDar.AmPositionCode' => 'AM_POSITION_CODE',
        'amPositionCode' => 'AM_POSITION_CODE',
        'exportDar.amPositionCode' => 'AM_POSITION_CODE',
        'ExportDarTableMap::COL_AM_POSITION_CODE' => 'AM_POSITION_CODE',
        'COL_AM_POSITION_CODE' => 'AM_POSITION_CODE',
        'am_position_code' => 'AM_POSITION_CODE',
        'export_dar.am_position_code' => 'AM_POSITION_CODE',
        'EmpPositionCode' => 'EMP_POSITION_CODE',
        'ExportDar.EmpPositionCode' => 'EMP_POSITION_CODE',
        'empPositionCode' => 'EMP_POSITION_CODE',
        'exportDar.empPositionCode' => 'EMP_POSITION_CODE',
        'ExportDarTableMap::COL_EMP_POSITION_CODE' => 'EMP_POSITION_CODE',
        'COL_EMP_POSITION_CODE' => 'EMP_POSITION_CODE',
        'emp_position_code' => 'EMP_POSITION_CODE',
        'export_dar.emp_position_code' => 'EMP_POSITION_CODE',
        'EmpPositionName' => 'EMP_POSITION_NAME',
        'ExportDar.EmpPositionName' => 'EMP_POSITION_NAME',
        'empPositionName' => 'EMP_POSITION_NAME',
        'exportDar.empPositionName' => 'EMP_POSITION_NAME',
        'ExportDarTableMap::COL_EMP_POSITION_NAME' => 'EMP_POSITION_NAME',
        'COL_EMP_POSITION_NAME' => 'EMP_POSITION_NAME',
        'emp_position_name' => 'EMP_POSITION_NAME',
        'export_dar.emp_position_name' => 'EMP_POSITION_NAME',
        'EmpLevel' => 'EMP_LEVEL',
        'ExportDar.EmpLevel' => 'EMP_LEVEL',
        'empLevel' => 'EMP_LEVEL',
        'exportDar.empLevel' => 'EMP_LEVEL',
        'ExportDarTableMap::COL_EMP_LEVEL' => 'EMP_LEVEL',
        'COL_EMP_LEVEL' => 'EMP_LEVEL',
        'emp_level' => 'EMP_LEVEL',
        'export_dar.emp_level' => 'EMP_LEVEL',
        'EmployeeCode' => 'EMPLOYEE_CODE',
        'ExportDar.EmployeeCode' => 'EMPLOYEE_CODE',
        'employeeCode' => 'EMPLOYEE_CODE',
        'exportDar.employeeCode' => 'EMPLOYEE_CODE',
        'ExportDarTableMap::COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'employee_code' => 'EMPLOYEE_CODE',
        'export_dar.employee_code' => 'EMPLOYEE_CODE',
        'Employee' => 'EMPLOYEE',
        'ExportDar.Employee' => 'EMPLOYEE',
        'employee' => 'EMPLOYEE',
        'exportDar.employee' => 'EMPLOYEE',
        'ExportDarTableMap::COL_EMPLOYEE' => 'EMPLOYEE',
        'COL_EMPLOYEE' => 'EMPLOYEE',
        'export_dar.employee' => 'EMPLOYEE',
        'JwEmployeeCode' => 'JW_EMPLOYEE_CODE',
        'ExportDar.JwEmployeeCode' => 'JW_EMPLOYEE_CODE',
        'jwEmployeeCode' => 'JW_EMPLOYEE_CODE',
        'exportDar.jwEmployeeCode' => 'JW_EMPLOYEE_CODE',
        'ExportDarTableMap::COL_JW_EMPLOYEE_CODE' => 'JW_EMPLOYEE_CODE',
        'COL_JW_EMPLOYEE_CODE' => 'JW_EMPLOYEE_CODE',
        'jw_employee_code' => 'JW_EMPLOYEE_CODE',
        'export_dar.jw_employee_code' => 'JW_EMPLOYEE_CODE',
        'JwEmployee' => 'JW_EMPLOYEE',
        'ExportDar.JwEmployee' => 'JW_EMPLOYEE',
        'jwEmployee' => 'JW_EMPLOYEE',
        'exportDar.jwEmployee' => 'JW_EMPLOYEE',
        'ExportDarTableMap::COL_JW_EMPLOYEE' => 'JW_EMPLOYEE',
        'COL_JW_EMPLOYEE' => 'JW_EMPLOYEE',
        'jw_employee' => 'JW_EMPLOYEE',
        'export_dar.jw_employee' => 'JW_EMPLOYEE',
        'JwPositionName' => 'JW_POSITION_NAME',
        'ExportDar.JwPositionName' => 'JW_POSITION_NAME',
        'jwPositionName' => 'JW_POSITION_NAME',
        'exportDar.jwPositionName' => 'JW_POSITION_NAME',
        'ExportDarTableMap::COL_JW_POSITION_NAME' => 'JW_POSITION_NAME',
        'COL_JW_POSITION_NAME' => 'JW_POSITION_NAME',
        'jw_position_name' => 'JW_POSITION_NAME',
        'export_dar.jw_position_name' => 'JW_POSITION_NAME',
        'OutletType' => 'OUTLET_TYPE',
        'ExportDar.OutletType' => 'OUTLET_TYPE',
        'outletType' => 'OUTLET_TYPE',
        'exportDar.outletType' => 'OUTLET_TYPE',
        'ExportDarTableMap::COL_OUTLET_TYPE' => 'OUTLET_TYPE',
        'COL_OUTLET_TYPE' => 'OUTLET_TYPE',
        'outlet_type' => 'OUTLET_TYPE',
        'export_dar.outlet_type' => 'OUTLET_TYPE',
        'OutletCode' => 'OUTLET_CODE',
        'ExportDar.OutletCode' => 'OUTLET_CODE',
        'outletCode' => 'OUTLET_CODE',
        'exportDar.outletCode' => 'OUTLET_CODE',
        'ExportDarTableMap::COL_OUTLET_CODE' => 'OUTLET_CODE',
        'COL_OUTLET_CODE' => 'OUTLET_CODE',
        'outlet_code' => 'OUTLET_CODE',
        'export_dar.outlet_code' => 'OUTLET_CODE',
        'OutletName' => 'OUTLET_NAME',
        'ExportDar.OutletName' => 'OUTLET_NAME',
        'outletName' => 'OUTLET_NAME',
        'exportDar.outletName' => 'OUTLET_NAME',
        'ExportDarTableMap::COL_OUTLET_NAME' => 'OUTLET_NAME',
        'COL_OUTLET_NAME' => 'OUTLET_NAME',
        'outlet_name' => 'OUTLET_NAME',
        'export_dar.outlet_name' => 'OUTLET_NAME',
        'Agendacontroltype' => 'AGENDACONTROLTYPE',
        'ExportDar.Agendacontroltype' => 'AGENDACONTROLTYPE',
        'agendacontroltype' => 'AGENDACONTROLTYPE',
        'exportDar.agendacontroltype' => 'AGENDACONTROLTYPE',
        'ExportDarTableMap::COL_AGENDACONTROLTYPE' => 'AGENDACONTROLTYPE',
        'COL_AGENDACONTROLTYPE' => 'AGENDACONTROLTYPE',
        'export_dar.agendacontroltype' => 'AGENDACONTROLTYPE',
        'Agendname' => 'AGENDNAME',
        'ExportDar.Agendname' => 'AGENDNAME',
        'agendname' => 'AGENDNAME',
        'exportDar.agendname' => 'AGENDNAME',
        'ExportDarTableMap::COL_AGENDNAME' => 'AGENDNAME',
        'COL_AGENDNAME' => 'AGENDNAME',
        'export_dar.agendname' => 'AGENDNAME',
        'Stownname' => 'STOWNNAME',
        'ExportDar.Stownname' => 'STOWNNAME',
        'stownname' => 'STOWNNAME',
        'exportDar.stownname' => 'STOWNNAME',
        'ExportDarTableMap::COL_STOWNNAME' => 'STOWNNAME',
        'COL_STOWNNAME' => 'STOWNNAME',
        'export_dar.stownname' => 'STOWNNAME',
        'DcrDate' => 'DCR_DATE',
        'ExportDar.DcrDate' => 'DCR_DATE',
        'dcrDate' => 'DCR_DATE',
        'exportDar.dcrDate' => 'DCR_DATE',
        'ExportDarTableMap::COL_DCR_DATE' => 'DCR_DATE',
        'COL_DCR_DATE' => 'DCR_DATE',
        'dcr_date' => 'DCR_DATE',
        'export_dar.dcr_date' => 'DCR_DATE',
        'DcrStatus' => 'DCR_STATUS',
        'ExportDar.DcrStatus' => 'DCR_STATUS',
        'dcrStatus' => 'DCR_STATUS',
        'exportDar.dcrStatus' => 'DCR_STATUS',
        'ExportDarTableMap::COL_DCR_STATUS' => 'DCR_STATUS',
        'COL_DCR_STATUS' => 'DCR_STATUS',
        'dcr_status' => 'DCR_STATUS',
        'export_dar.dcr_status' => 'DCR_STATUS',
        'NcaComments' => 'NCA_COMMENTS',
        'ExportDar.NcaComments' => 'NCA_COMMENTS',
        'ncaComments' => 'NCA_COMMENTS',
        'exportDar.ncaComments' => 'NCA_COMMENTS',
        'ExportDarTableMap::COL_NCA_COMMENTS' => 'NCA_COMMENTS',
        'COL_NCA_COMMENTS' => 'NCA_COMMENTS',
        'nca_comments' => 'NCA_COMMENTS',
        'export_dar.nca_comments' => 'NCA_COMMENTS',
        'Planned' => 'PLANNED',
        'ExportDar.Planned' => 'PLANNED',
        'planned' => 'PLANNED',
        'exportDar.planned' => 'PLANNED',
        'ExportDarTableMap::COL_PLANNED' => 'PLANNED',
        'COL_PLANNED' => 'PLANNED',
        'export_dar.planned' => 'PLANNED',
        'ManagersName' => 'MANAGERS_NAME',
        'ExportDar.ManagersName' => 'MANAGERS_NAME',
        'managersName' => 'MANAGERS_NAME',
        'exportDar.managersName' => 'MANAGERS_NAME',
        'ExportDarTableMap::COL_MANAGERS_NAME' => 'MANAGERS_NAME',
        'COL_MANAGERS_NAME' => 'MANAGERS_NAME',
        'managers_name' => 'MANAGERS_NAME',
        'export_dar.managers_name' => 'MANAGERS_NAME',
        'BrandsDetailedName' => 'BRANDS_DETAILED_NAME',
        'ExportDar.BrandsDetailedName' => 'BRANDS_DETAILED_NAME',
        'brandsDetailedName' => 'BRANDS_DETAILED_NAME',
        'exportDar.brandsDetailedName' => 'BRANDS_DETAILED_NAME',
        'ExportDarTableMap::COL_BRANDS_DETAILED_NAME' => 'BRANDS_DETAILED_NAME',
        'COL_BRANDS_DETAILED_NAME' => 'BRANDS_DETAILED_NAME',
        'brands_detailed_name' => 'BRANDS_DETAILED_NAME',
        'export_dar.brands_detailed_name' => 'BRANDS_DETAILED_NAME',
        'EdDuration' => 'ED_DURATION',
        'ExportDar.EdDuration' => 'ED_DURATION',
        'edDuration' => 'ED_DURATION',
        'exportDar.edDuration' => 'ED_DURATION',
        'ExportDarTableMap::COL_ED_DURATION' => 'ED_DURATION',
        'COL_ED_DURATION' => 'ED_DURATION',
        'ed_duration' => 'ED_DURATION',
        'export_dar.ed_duration' => 'ED_DURATION',
        'DateTime' => 'DATETIME',
        'ExportDar.DateTime' => 'DATETIME',
        'dateTime' => 'DATETIME',
        'exportDar.dateTime' => 'DATETIME',
        'ExportDarTableMap::COL_DATETIME' => 'DATETIME',
        'COL_DATETIME' => 'DATETIME',
        'datetime' => 'DATETIME',
        'export_dar.datetime' => 'DATETIME',
        'EmpTerritory' => 'EMP_TERRITORY',
        'ExportDar.EmpTerritory' => 'EMP_TERRITORY',
        'empTerritory' => 'EMP_TERRITORY',
        'exportDar.empTerritory' => 'EMP_TERRITORY',
        'ExportDarTableMap::COL_EMP_TERRITORY' => 'EMP_TERRITORY',
        'COL_EMP_TERRITORY' => 'EMP_TERRITORY',
        'emp_territory' => 'EMP_TERRITORY',
        'export_dar.emp_territory' => 'EMP_TERRITORY',
        'EmpBranch' => 'EMP_BRANCH',
        'ExportDar.EmpBranch' => 'EMP_BRANCH',
        'empBranch' => 'EMP_BRANCH',
        'exportDar.empBranch' => 'EMP_BRANCH',
        'ExportDarTableMap::COL_EMP_BRANCH' => 'EMP_BRANCH',
        'COL_EMP_BRANCH' => 'EMP_BRANCH',
        'emp_branch' => 'EMP_BRANCH',
        'export_dar.emp_branch' => 'EMP_BRANCH',
        'EmpTown' => 'EMP_TOWN',
        'ExportDar.EmpTown' => 'EMP_TOWN',
        'empTown' => 'EMP_TOWN',
        'exportDar.empTown' => 'EMP_TOWN',
        'ExportDarTableMap::COL_EMP_TOWN' => 'EMP_TOWN',
        'COL_EMP_TOWN' => 'EMP_TOWN',
        'emp_town' => 'EMP_TOWN',
        'export_dar.emp_town' => 'EMP_TOWN',
        'CustomerTown' => 'CUSTOMER_TOWN',
        'ExportDar.CustomerTown' => 'CUSTOMER_TOWN',
        'customerTown' => 'CUSTOMER_TOWN',
        'exportDar.customerTown' => 'CUSTOMER_TOWN',
        'ExportDarTableMap::COL_CUSTOMER_TOWN' => 'CUSTOMER_TOWN',
        'COL_CUSTOMER_TOWN' => 'CUSTOMER_TOWN',
        'customer_town' => 'CUSTOMER_TOWN',
        'export_dar.customer_town' => 'CUSTOMER_TOWN',
        'CustomerPatch' => 'CUSTOMER_PATCH',
        'ExportDar.CustomerPatch' => 'CUSTOMER_PATCH',
        'customerPatch' => 'CUSTOMER_PATCH',
        'exportDar.customerPatch' => 'CUSTOMER_PATCH',
        'ExportDarTableMap::COL_CUSTOMER_PATCH' => 'CUSTOMER_PATCH',
        'COL_CUSTOMER_PATCH' => 'CUSTOMER_PATCH',
        'customer_patch' => 'CUSTOMER_PATCH',
        'export_dar.customer_patch' => 'CUSTOMER_PATCH',
        'LeaveTaken' => 'LEAVE_TEKEN',
        'ExportDar.LeaveTaken' => 'LEAVE_TEKEN',
        'leaveTaken' => 'LEAVE_TEKEN',
        'exportDar.leaveTaken' => 'LEAVE_TEKEN',
        'ExportDarTableMap::COL_LEAVE_TEKEN' => 'LEAVE_TEKEN',
        'COL_LEAVE_TEKEN' => 'LEAVE_TEKEN',
        'leave_teken' => 'LEAVE_TEKEN',
        'export_dar.leave_teken' => 'LEAVE_TEKEN',
        'DcrId' => 'DCR_ID',
        'ExportDar.DcrId' => 'DCR_ID',
        'dcrId' => 'DCR_ID',
        'exportDar.dcrId' => 'DCR_ID',
        'ExportDarTableMap::COL_DCR_ID' => 'DCR_ID',
        'COL_DCR_ID' => 'DCR_ID',
        'dcr_id' => 'DCR_ID',
        'export_dar.dcr_id' => 'DCR_ID',
        'UpdatedAt' => 'UPDATED_AT',
        'ExportDar.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'exportDar.updatedAt' => 'UPDATED_AT',
        'ExportDarTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'export_dar.updated_at' => 'UPDATED_AT',
        'IsJw' => 'ISJW',
        'ExportDar.IsJw' => 'ISJW',
        'isJw' => 'ISJW',
        'exportDar.isJw' => 'ISJW',
        'ExportDarTableMap::COL_ISJW' => 'ISJW',
        'COL_ISJW' => 'ISJW',
        'isjw' => 'ISJW',
        'export_dar.isjw' => 'ISJW',
        'SgpiOut' => 'SGPI_OUT',
        'ExportDar.SgpiOut' => 'SGPI_OUT',
        'sgpiOut' => 'SGPI_OUT',
        'exportDar.sgpiOut' => 'SGPI_OUT',
        'ExportDarTableMap::COL_SGPI_OUT' => 'SGPI_OUT',
        'COL_SGPI_OUT' => 'SGPI_OUT',
        'sgpi_out' => 'SGPI_OUT',
        'export_dar.sgpi_out' => 'SGPI_OUT',
        'PobTotal' => 'POB_TOTAL',
        'ExportDar.PobTotal' => 'POB_TOTAL',
        'pobTotal' => 'POB_TOTAL',
        'exportDar.pobTotal' => 'POB_TOTAL',
        'ExportDarTableMap::COL_POB_TOTAL' => 'POB_TOTAL',
        'COL_POB_TOTAL' => 'POB_TOTAL',
        'pob_total' => 'POB_TOTAL',
        'export_dar.pob_total' => 'POB_TOTAL',
        'OutletId' => 'OUTLET_ID',
        'ExportDar.OutletId' => 'OUTLET_ID',
        'outletId' => 'OUTLET_ID',
        'exportDar.outletId' => 'OUTLET_ID',
        'ExportDarTableMap::COL_OUTLET_ID' => 'OUTLET_ID',
        'COL_OUTLET_ID' => 'OUTLET_ID',
        'outlet_id' => 'OUTLET_ID',
        'export_dar.outlet_id' => 'OUTLET_ID',
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
        $this->setName('export_dar');
        $this->setPhpName('ExportDar');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\ExportDar');
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
        $this->addColumn('jw_employee_code', 'JwEmployeeCode', 'VARCHAR', false, 255, null);
        $this->addColumn('jw_employee', 'JwEmployee', 'VARCHAR', false, null, null);
        $this->addColumn('jw_position_name', 'JwPositionName', 'VARCHAR', false, 255, null);
        $this->addColumn('outlet_type', 'OutletType', 'VARCHAR', false, 255, null);
        $this->addColumn('outlet_code', 'OutletCode', 'VARCHAR', false, 255, null);
        $this->addColumn('outlet_name', 'OutletName', 'VARCHAR', false, 255, null);
        $this->addColumn('agendacontroltype', 'Agendacontroltype', 'VARCHAR', false, 255, null);
        $this->addColumn('agendname', 'Agendname', 'VARCHAR', false, 255, null);
        $this->addColumn('stownname', 'Stownname', 'VARCHAR', false, 255, null);
        $this->addColumn('dcr_date', 'DcrDate', 'DATE', false, null, null);
        $this->addColumn('dcr_status', 'DcrStatus', 'VARCHAR', false, 255, null);
        $this->addColumn('nca_comments', 'NcaComments', 'VARCHAR', false, 255, null);
        $this->addColumn('planned', 'Planned', 'VARCHAR', false, null, null);
        $this->addColumn('managers_name', 'ManagersName', 'VARCHAR', false, null, null);
        $this->addColumn('brands_detailed_name', 'BrandsDetailedName', 'VARCHAR', false, null, null);
        $this->addColumn('ed_duration', 'EdDuration', 'INTEGER', false, null, null);
        $this->addColumn('datetime', 'DateTime', 'TIMESTAMP', false, null, null);
        $this->addColumn('emp_territory', 'EmpTerritory', 'VARCHAR', false, null, null);
        $this->addColumn('emp_branch', 'EmpBranch', 'VARCHAR', false, null, null);
        $this->addColumn('emp_town', 'EmpTown', 'VARCHAR', false, null, null);
        $this->addColumn('customer_town', 'CustomerTown', 'VARCHAR', false, null, null);
        $this->addColumn('customer_patch', 'CustomerPatch', 'VARCHAR', false, null, null);
        $this->addColumn('leave_teken', 'LeaveTaken', 'VARCHAR', false, null, null);
        $this->addColumn('dcr_id', 'DcrId', 'INTEGER', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('isjw', 'IsJw', 'VARCHAR', false, null, null);
        $this->addColumn('sgpi_out', 'SgpiOut', 'VARCHAR', false, null, null);
        $this->addColumn('pob_total', 'PobTotal', 'INTEGER', false, null, null);
        $this->addColumn('outlet_id', 'OutletId', 'INTEGER', false, null, null);
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
        return $withPrefix ? ExportDarTableMap::CLASS_DEFAULT : ExportDarTableMap::OM_CLASS;
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
     * @return array (ExportDar object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ExportDarTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ExportDarTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ExportDarTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ExportDarTableMap::OM_CLASS;
            /** @var ExportDar $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ExportDarTableMap::addInstanceToPool($obj, $key);
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
            $key = ExportDarTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ExportDarTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ExportDar $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ExportDarTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ExportDarTableMap::COL_BU_NAME);
            $criteria->addSelectColumn(ExportDarTableMap::COL_ZM_MANAGER_BRANCH);
            $criteria->addSelectColumn(ExportDarTableMap::COL_ZM_MANAGER_TOWN);
            $criteria->addSelectColumn(ExportDarTableMap::COL_RM_MANAGER_BRANCH);
            $criteria->addSelectColumn(ExportDarTableMap::COL_RM_MANAGER_TOWN);
            $criteria->addSelectColumn(ExportDarTableMap::COL_AM_MANAGER_BRANCH);
            $criteria->addSelectColumn(ExportDarTableMap::COL_AM_MANAGER_TOWN);
            $criteria->addSelectColumn(ExportDarTableMap::COL_ZM_POSITION_CODE);
            $criteria->addSelectColumn(ExportDarTableMap::COL_RM_POSITION_CODE);
            $criteria->addSelectColumn(ExportDarTableMap::COL_AM_POSITION_CODE);
            $criteria->addSelectColumn(ExportDarTableMap::COL_EMP_POSITION_CODE);
            $criteria->addSelectColumn(ExportDarTableMap::COL_EMP_POSITION_NAME);
            $criteria->addSelectColumn(ExportDarTableMap::COL_EMP_LEVEL);
            $criteria->addSelectColumn(ExportDarTableMap::COL_EMPLOYEE_CODE);
            $criteria->addSelectColumn(ExportDarTableMap::COL_EMPLOYEE);
            $criteria->addSelectColumn(ExportDarTableMap::COL_JW_EMPLOYEE_CODE);
            $criteria->addSelectColumn(ExportDarTableMap::COL_JW_EMPLOYEE);
            $criteria->addSelectColumn(ExportDarTableMap::COL_JW_POSITION_NAME);
            $criteria->addSelectColumn(ExportDarTableMap::COL_OUTLET_TYPE);
            $criteria->addSelectColumn(ExportDarTableMap::COL_OUTLET_CODE);
            $criteria->addSelectColumn(ExportDarTableMap::COL_OUTLET_NAME);
            $criteria->addSelectColumn(ExportDarTableMap::COL_AGENDACONTROLTYPE);
            $criteria->addSelectColumn(ExportDarTableMap::COL_AGENDNAME);
            $criteria->addSelectColumn(ExportDarTableMap::COL_STOWNNAME);
            $criteria->addSelectColumn(ExportDarTableMap::COL_DCR_DATE);
            $criteria->addSelectColumn(ExportDarTableMap::COL_DCR_STATUS);
            $criteria->addSelectColumn(ExportDarTableMap::COL_NCA_COMMENTS);
            $criteria->addSelectColumn(ExportDarTableMap::COL_PLANNED);
            $criteria->addSelectColumn(ExportDarTableMap::COL_MANAGERS_NAME);
            $criteria->addSelectColumn(ExportDarTableMap::COL_BRANDS_DETAILED_NAME);
            $criteria->addSelectColumn(ExportDarTableMap::COL_ED_DURATION);
            $criteria->addSelectColumn(ExportDarTableMap::COL_DATETIME);
            $criteria->addSelectColumn(ExportDarTableMap::COL_EMP_TERRITORY);
            $criteria->addSelectColumn(ExportDarTableMap::COL_EMP_BRANCH);
            $criteria->addSelectColumn(ExportDarTableMap::COL_EMP_TOWN);
            $criteria->addSelectColumn(ExportDarTableMap::COL_CUSTOMER_TOWN);
            $criteria->addSelectColumn(ExportDarTableMap::COL_CUSTOMER_PATCH);
            $criteria->addSelectColumn(ExportDarTableMap::COL_LEAVE_TEKEN);
            $criteria->addSelectColumn(ExportDarTableMap::COL_DCR_ID);
            $criteria->addSelectColumn(ExportDarTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(ExportDarTableMap::COL_ISJW);
            $criteria->addSelectColumn(ExportDarTableMap::COL_SGPI_OUT);
            $criteria->addSelectColumn(ExportDarTableMap::COL_POB_TOTAL);
            $criteria->addSelectColumn(ExportDarTableMap::COL_OUTLET_ID);
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
            $criteria->addSelectColumn($alias . '.jw_employee_code');
            $criteria->addSelectColumn($alias . '.jw_employee');
            $criteria->addSelectColumn($alias . '.jw_position_name');
            $criteria->addSelectColumn($alias . '.outlet_type');
            $criteria->addSelectColumn($alias . '.outlet_code');
            $criteria->addSelectColumn($alias . '.outlet_name');
            $criteria->addSelectColumn($alias . '.agendacontroltype');
            $criteria->addSelectColumn($alias . '.agendname');
            $criteria->addSelectColumn($alias . '.stownname');
            $criteria->addSelectColumn($alias . '.dcr_date');
            $criteria->addSelectColumn($alias . '.dcr_status');
            $criteria->addSelectColumn($alias . '.nca_comments');
            $criteria->addSelectColumn($alias . '.planned');
            $criteria->addSelectColumn($alias . '.managers_name');
            $criteria->addSelectColumn($alias . '.brands_detailed_name');
            $criteria->addSelectColumn($alias . '.ed_duration');
            $criteria->addSelectColumn($alias . '.datetime');
            $criteria->addSelectColumn($alias . '.emp_territory');
            $criteria->addSelectColumn($alias . '.emp_branch');
            $criteria->addSelectColumn($alias . '.emp_town');
            $criteria->addSelectColumn($alias . '.customer_town');
            $criteria->addSelectColumn($alias . '.customer_patch');
            $criteria->addSelectColumn($alias . '.leave_teken');
            $criteria->addSelectColumn($alias . '.dcr_id');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.isjw');
            $criteria->addSelectColumn($alias . '.sgpi_out');
            $criteria->addSelectColumn($alias . '.pob_total');
            $criteria->addSelectColumn($alias . '.outlet_id');
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
            $criteria->removeSelectColumn(ExportDarTableMap::COL_BU_NAME);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_ZM_MANAGER_BRANCH);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_ZM_MANAGER_TOWN);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_RM_MANAGER_BRANCH);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_RM_MANAGER_TOWN);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_AM_MANAGER_BRANCH);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_AM_MANAGER_TOWN);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_ZM_POSITION_CODE);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_RM_POSITION_CODE);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_AM_POSITION_CODE);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_EMP_POSITION_CODE);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_EMP_POSITION_NAME);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_EMP_LEVEL);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_EMPLOYEE_CODE);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_EMPLOYEE);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_JW_EMPLOYEE_CODE);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_JW_EMPLOYEE);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_JW_POSITION_NAME);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_OUTLET_TYPE);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_OUTLET_CODE);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_OUTLET_NAME);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_AGENDACONTROLTYPE);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_AGENDNAME);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_STOWNNAME);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_DCR_DATE);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_DCR_STATUS);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_NCA_COMMENTS);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_PLANNED);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_MANAGERS_NAME);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_BRANDS_DETAILED_NAME);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_ED_DURATION);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_DATETIME);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_EMP_TERRITORY);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_EMP_BRANCH);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_EMP_TOWN);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_CUSTOMER_TOWN);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_CUSTOMER_PATCH);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_LEAVE_TEKEN);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_DCR_ID);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_ISJW);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_SGPI_OUT);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_POB_TOTAL);
            $criteria->removeSelectColumn(ExportDarTableMap::COL_OUTLET_ID);
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
            $criteria->removeSelectColumn($alias . '.jw_employee_code');
            $criteria->removeSelectColumn($alias . '.jw_employee');
            $criteria->removeSelectColumn($alias . '.jw_position_name');
            $criteria->removeSelectColumn($alias . '.outlet_type');
            $criteria->removeSelectColumn($alias . '.outlet_code');
            $criteria->removeSelectColumn($alias . '.outlet_name');
            $criteria->removeSelectColumn($alias . '.agendacontroltype');
            $criteria->removeSelectColumn($alias . '.agendname');
            $criteria->removeSelectColumn($alias . '.stownname');
            $criteria->removeSelectColumn($alias . '.dcr_date');
            $criteria->removeSelectColumn($alias . '.dcr_status');
            $criteria->removeSelectColumn($alias . '.nca_comments');
            $criteria->removeSelectColumn($alias . '.planned');
            $criteria->removeSelectColumn($alias . '.managers_name');
            $criteria->removeSelectColumn($alias . '.brands_detailed_name');
            $criteria->removeSelectColumn($alias . '.ed_duration');
            $criteria->removeSelectColumn($alias . '.datetime');
            $criteria->removeSelectColumn($alias . '.emp_territory');
            $criteria->removeSelectColumn($alias . '.emp_branch');
            $criteria->removeSelectColumn($alias . '.emp_town');
            $criteria->removeSelectColumn($alias . '.customer_town');
            $criteria->removeSelectColumn($alias . '.customer_patch');
            $criteria->removeSelectColumn($alias . '.leave_teken');
            $criteria->removeSelectColumn($alias . '.dcr_id');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.isjw');
            $criteria->removeSelectColumn($alias . '.sgpi_out');
            $criteria->removeSelectColumn($alias . '.pob_total');
            $criteria->removeSelectColumn($alias . '.outlet_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(ExportDarTableMap::DATABASE_NAME)->getTable(ExportDarTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a ExportDar or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or ExportDar object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ExportDarTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\ExportDar) { // it's a model object
            // create criteria based on pk value
            $criteria = $values->buildCriteria();
        } else { // it's a primary key, or an array of pks
            throw new LogicException('The ExportDar object has no primary key');
        }

        $query = ExportDarQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ExportDarTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ExportDarTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the export_dar table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ExportDarQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ExportDar or Criteria object.
     *
     * @param mixed $criteria Criteria or ExportDar object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExportDarTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ExportDar object
        }


        // Set the correct dbName
        $query = ExportDarQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
