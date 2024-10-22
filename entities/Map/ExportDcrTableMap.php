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
use entities\ExportDcr;
use entities\ExportDcrQuery;


/**
 * This class defines the structure of the 'export_dcr' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ExportDcrTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.ExportDcrTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'export_dcr';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'ExportDcr';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\ExportDcr';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.ExportDcr';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 38;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 38;

    /**
     * the column name for the bu_name field
     */
    public const COL_BU_NAME = 'export_dcr.bu_name';

    /**
     * the column name for the zm_manager_branch field
     */
    public const COL_ZM_MANAGER_BRANCH = 'export_dcr.zm_manager_branch';

    /**
     * the column name for the zm_manager_town field
     */
    public const COL_ZM_MANAGER_TOWN = 'export_dcr.zm_manager_town';

    /**
     * the column name for the rm_manager_branch field
     */
    public const COL_RM_MANAGER_BRANCH = 'export_dcr.rm_manager_branch';

    /**
     * the column name for the rm_manager_town field
     */
    public const COL_RM_MANAGER_TOWN = 'export_dcr.rm_manager_town';

    /**
     * the column name for the am_manager_branch field
     */
    public const COL_AM_MANAGER_BRANCH = 'export_dcr.am_manager_branch';

    /**
     * the column name for the am_manager_town field
     */
    public const COL_AM_MANAGER_TOWN = 'export_dcr.am_manager_town';

    /**
     * the column name for the zm_position_code field
     */
    public const COL_ZM_POSITION_CODE = 'export_dcr.zm_position_code';

    /**
     * the column name for the rm_position_code field
     */
    public const COL_RM_POSITION_CODE = 'export_dcr.rm_position_code';

    /**
     * the column name for the am_position_code field
     */
    public const COL_AM_POSITION_CODE = 'export_dcr.am_position_code';

    /**
     * the column name for the emp_position_code field
     */
    public const COL_EMP_POSITION_CODE = 'export_dcr.emp_position_code';

    /**
     * the column name for the emp_position_name field
     */
    public const COL_EMP_POSITION_NAME = 'export_dcr.emp_position_name';

    /**
     * the column name for the emp_level field
     */
    public const COL_EMP_LEVEL = 'export_dcr.emp_level';

    /**
     * the column name for the employee_code field
     */
    public const COL_EMPLOYEE_CODE = 'export_dcr.employee_code';

    /**
     * the column name for the employee field
     */
    public const COL_EMPLOYEE = 'export_dcr.employee';

    /**
     * the column name for the jw_employee_code field
     */
    public const COL_JW_EMPLOYEE_CODE = 'export_dcr.jw_employee_code';

    /**
     * the column name for the jw_employee field
     */
    public const COL_JW_EMPLOYEE = 'export_dcr.jw_employee';

    /**
     * the column name for the jw_position_name field
     */
    public const COL_JW_POSITION_NAME = 'export_dcr.jw_position_name';

    /**
     * the column name for the outlet_type field
     */
    public const COL_OUTLET_TYPE = 'export_dcr.outlet_type';

    /**
     * the column name for the outlet_code field
     */
    public const COL_OUTLET_CODE = 'export_dcr.outlet_code';

    /**
     * the column name for the outlet_name field
     */
    public const COL_OUTLET_NAME = 'export_dcr.outlet_name';

    /**
     * the column name for the agendacontroltype field
     */
    public const COL_AGENDACONTROLTYPE = 'export_dcr.agendacontroltype';

    /**
     * the column name for the agendname field
     */
    public const COL_AGENDNAME = 'export_dcr.agendname';

    /**
     * the column name for the stownname field
     */
    public const COL_STOWNNAME = 'export_dcr.stownname';

    /**
     * the column name for the dcr_date field
     */
    public const COL_DCR_DATE = 'export_dcr.dcr_date';

    /**
     * the column name for the dcr_status field
     */
    public const COL_DCR_STATUS = 'export_dcr.dcr_status';

    /**
     * the column name for the nca_comments field
     */
    public const COL_NCA_COMMENTS = 'export_dcr.nca_comments';

    /**
     * the column name for the planned field
     */
    public const COL_PLANNED = 'export_dcr.planned';

    /**
     * the column name for the managers_name field
     */
    public const COL_MANAGERS_NAME = 'export_dcr.managers_name';

    /**
     * the column name for the brands_detailed_name field
     */
    public const COL_BRANDS_DETAILED_NAME = 'export_dcr.brands_detailed_name';

    /**
     * the column name for the ed_duration field
     */
    public const COL_ED_DURATION = 'export_dcr.ed_duration';

    /**
     * the column name for the datetime field
     */
    public const COL_DATETIME = 'export_dcr.datetime';

    /**
     * the column name for the emp_territory field
     */
    public const COL_EMP_TERRITORY = 'export_dcr.emp_territory';

    /**
     * the column name for the emp_branch field
     */
    public const COL_EMP_BRANCH = 'export_dcr.emp_branch';

    /**
     * the column name for the emp_town field
     */
    public const COL_EMP_TOWN = 'export_dcr.emp_town';

    /**
     * the column name for the customer_town field
     */
    public const COL_CUSTOMER_TOWN = 'export_dcr.customer_town';

    /**
     * the column name for the customer_patch field
     */
    public const COL_CUSTOMER_PATCH = 'export_dcr.customer_patch';

    /**
     * the column name for the leave_teken field
     */
    public const COL_LEAVE_TEKEN = 'export_dcr.leave_teken';

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
        self::TYPE_PHPNAME       => ['BuName', 'ZmManagerBranch', 'ZmManagerTown', 'RmManagerBranch', 'RmManagerTown', 'AmManagerBranch', 'AmManagerTown', 'ZmPositionCode', 'RmPositionCode', 'AmPositionCode', 'EmpPositionCode', 'EmpPositionName', 'EmpLevel', 'EmployeeCode', 'Employee', 'JwEmployeeCode', 'JwEmployee', 'JwPositionName', 'OutletType', 'OutletCode', 'OutletName', 'Agendacontroltype', 'Agendname', 'Stownname', 'DcrDate', 'DcrStatus', 'NcaComments', 'Planned', 'ManagersName', 'BrandsDetailedName', 'EdDuration', 'DateTime', 'EmpTerritory', 'EmpBranch', 'EmpTown', 'CustomerTown', 'CustomerPatch', 'LeaveTaken', ],
        self::TYPE_CAMELNAME     => ['buName', 'zmManagerBranch', 'zmManagerTown', 'rmManagerBranch', 'rmManagerTown', 'amManagerBranch', 'amManagerTown', 'zmPositionCode', 'rmPositionCode', 'amPositionCode', 'empPositionCode', 'empPositionName', 'empLevel', 'employeeCode', 'employee', 'jwEmployeeCode', 'jwEmployee', 'jwPositionName', 'outletType', 'outletCode', 'outletName', 'agendacontroltype', 'agendname', 'stownname', 'dcrDate', 'dcrStatus', 'ncaComments', 'planned', 'managersName', 'brandsDetailedName', 'edDuration', 'dateTime', 'empTerritory', 'empBranch', 'empTown', 'customerTown', 'customerPatch', 'leaveTaken', ],
        self::TYPE_COLNAME       => [ExportDcrTableMap::COL_BU_NAME, ExportDcrTableMap::COL_ZM_MANAGER_BRANCH, ExportDcrTableMap::COL_ZM_MANAGER_TOWN, ExportDcrTableMap::COL_RM_MANAGER_BRANCH, ExportDcrTableMap::COL_RM_MANAGER_TOWN, ExportDcrTableMap::COL_AM_MANAGER_BRANCH, ExportDcrTableMap::COL_AM_MANAGER_TOWN, ExportDcrTableMap::COL_ZM_POSITION_CODE, ExportDcrTableMap::COL_RM_POSITION_CODE, ExportDcrTableMap::COL_AM_POSITION_CODE, ExportDcrTableMap::COL_EMP_POSITION_CODE, ExportDcrTableMap::COL_EMP_POSITION_NAME, ExportDcrTableMap::COL_EMP_LEVEL, ExportDcrTableMap::COL_EMPLOYEE_CODE, ExportDcrTableMap::COL_EMPLOYEE, ExportDcrTableMap::COL_JW_EMPLOYEE_CODE, ExportDcrTableMap::COL_JW_EMPLOYEE, ExportDcrTableMap::COL_JW_POSITION_NAME, ExportDcrTableMap::COL_OUTLET_TYPE, ExportDcrTableMap::COL_OUTLET_CODE, ExportDcrTableMap::COL_OUTLET_NAME, ExportDcrTableMap::COL_AGENDACONTROLTYPE, ExportDcrTableMap::COL_AGENDNAME, ExportDcrTableMap::COL_STOWNNAME, ExportDcrTableMap::COL_DCR_DATE, ExportDcrTableMap::COL_DCR_STATUS, ExportDcrTableMap::COL_NCA_COMMENTS, ExportDcrTableMap::COL_PLANNED, ExportDcrTableMap::COL_MANAGERS_NAME, ExportDcrTableMap::COL_BRANDS_DETAILED_NAME, ExportDcrTableMap::COL_ED_DURATION, ExportDcrTableMap::COL_DATETIME, ExportDcrTableMap::COL_EMP_TERRITORY, ExportDcrTableMap::COL_EMP_BRANCH, ExportDcrTableMap::COL_EMP_TOWN, ExportDcrTableMap::COL_CUSTOMER_TOWN, ExportDcrTableMap::COL_CUSTOMER_PATCH, ExportDcrTableMap::COL_LEAVE_TEKEN, ],
        self::TYPE_FIELDNAME     => ['bu_name', 'zm_manager_branch', 'zm_manager_town', 'rm_manager_branch', 'rm_manager_town', 'am_manager_branch', 'am_manager_town', 'zm_position_code', 'rm_position_code', 'am_position_code', 'emp_position_code', 'emp_position_name', 'emp_level', 'employee_code', 'employee', 'jw_employee_code', 'jw_employee', 'jw_position_name', 'outlet_type', 'outlet_code', 'outlet_name', 'agendacontroltype', 'agendname', 'stownname', 'dcr_date', 'dcr_status', 'nca_comments', 'planned', 'managers_name', 'brands_detailed_name', 'ed_duration', 'datetime', 'emp_territory', 'emp_branch', 'emp_town', 'customer_town', 'customer_patch', 'leave_teken', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, ]
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
        self::TYPE_PHPNAME       => ['BuName' => 0, 'ZmManagerBranch' => 1, 'ZmManagerTown' => 2, 'RmManagerBranch' => 3, 'RmManagerTown' => 4, 'AmManagerBranch' => 5, 'AmManagerTown' => 6, 'ZmPositionCode' => 7, 'RmPositionCode' => 8, 'AmPositionCode' => 9, 'EmpPositionCode' => 10, 'EmpPositionName' => 11, 'EmpLevel' => 12, 'EmployeeCode' => 13, 'Employee' => 14, 'JwEmployeeCode' => 15, 'JwEmployee' => 16, 'JwPositionName' => 17, 'OutletType' => 18, 'OutletCode' => 19, 'OutletName' => 20, 'Agendacontroltype' => 21, 'Agendname' => 22, 'Stownname' => 23, 'DcrDate' => 24, 'DcrStatus' => 25, 'NcaComments' => 26, 'Planned' => 27, 'ManagersName' => 28, 'BrandsDetailedName' => 29, 'EdDuration' => 30, 'DateTime' => 31, 'EmpTerritory' => 32, 'EmpBranch' => 33, 'EmpTown' => 34, 'CustomerTown' => 35, 'CustomerPatch' => 36, 'LeaveTaken' => 37, ],
        self::TYPE_CAMELNAME     => ['buName' => 0, 'zmManagerBranch' => 1, 'zmManagerTown' => 2, 'rmManagerBranch' => 3, 'rmManagerTown' => 4, 'amManagerBranch' => 5, 'amManagerTown' => 6, 'zmPositionCode' => 7, 'rmPositionCode' => 8, 'amPositionCode' => 9, 'empPositionCode' => 10, 'empPositionName' => 11, 'empLevel' => 12, 'employeeCode' => 13, 'employee' => 14, 'jwEmployeeCode' => 15, 'jwEmployee' => 16, 'jwPositionName' => 17, 'outletType' => 18, 'outletCode' => 19, 'outletName' => 20, 'agendacontroltype' => 21, 'agendname' => 22, 'stownname' => 23, 'dcrDate' => 24, 'dcrStatus' => 25, 'ncaComments' => 26, 'planned' => 27, 'managersName' => 28, 'brandsDetailedName' => 29, 'edDuration' => 30, 'dateTime' => 31, 'empTerritory' => 32, 'empBranch' => 33, 'empTown' => 34, 'customerTown' => 35, 'customerPatch' => 36, 'leaveTaken' => 37, ],
        self::TYPE_COLNAME       => [ExportDcrTableMap::COL_BU_NAME => 0, ExportDcrTableMap::COL_ZM_MANAGER_BRANCH => 1, ExportDcrTableMap::COL_ZM_MANAGER_TOWN => 2, ExportDcrTableMap::COL_RM_MANAGER_BRANCH => 3, ExportDcrTableMap::COL_RM_MANAGER_TOWN => 4, ExportDcrTableMap::COL_AM_MANAGER_BRANCH => 5, ExportDcrTableMap::COL_AM_MANAGER_TOWN => 6, ExportDcrTableMap::COL_ZM_POSITION_CODE => 7, ExportDcrTableMap::COL_RM_POSITION_CODE => 8, ExportDcrTableMap::COL_AM_POSITION_CODE => 9, ExportDcrTableMap::COL_EMP_POSITION_CODE => 10, ExportDcrTableMap::COL_EMP_POSITION_NAME => 11, ExportDcrTableMap::COL_EMP_LEVEL => 12, ExportDcrTableMap::COL_EMPLOYEE_CODE => 13, ExportDcrTableMap::COL_EMPLOYEE => 14, ExportDcrTableMap::COL_JW_EMPLOYEE_CODE => 15, ExportDcrTableMap::COL_JW_EMPLOYEE => 16, ExportDcrTableMap::COL_JW_POSITION_NAME => 17, ExportDcrTableMap::COL_OUTLET_TYPE => 18, ExportDcrTableMap::COL_OUTLET_CODE => 19, ExportDcrTableMap::COL_OUTLET_NAME => 20, ExportDcrTableMap::COL_AGENDACONTROLTYPE => 21, ExportDcrTableMap::COL_AGENDNAME => 22, ExportDcrTableMap::COL_STOWNNAME => 23, ExportDcrTableMap::COL_DCR_DATE => 24, ExportDcrTableMap::COL_DCR_STATUS => 25, ExportDcrTableMap::COL_NCA_COMMENTS => 26, ExportDcrTableMap::COL_PLANNED => 27, ExportDcrTableMap::COL_MANAGERS_NAME => 28, ExportDcrTableMap::COL_BRANDS_DETAILED_NAME => 29, ExportDcrTableMap::COL_ED_DURATION => 30, ExportDcrTableMap::COL_DATETIME => 31, ExportDcrTableMap::COL_EMP_TERRITORY => 32, ExportDcrTableMap::COL_EMP_BRANCH => 33, ExportDcrTableMap::COL_EMP_TOWN => 34, ExportDcrTableMap::COL_CUSTOMER_TOWN => 35, ExportDcrTableMap::COL_CUSTOMER_PATCH => 36, ExportDcrTableMap::COL_LEAVE_TEKEN => 37, ],
        self::TYPE_FIELDNAME     => ['bu_name' => 0, 'zm_manager_branch' => 1, 'zm_manager_town' => 2, 'rm_manager_branch' => 3, 'rm_manager_town' => 4, 'am_manager_branch' => 5, 'am_manager_town' => 6, 'zm_position_code' => 7, 'rm_position_code' => 8, 'am_position_code' => 9, 'emp_position_code' => 10, 'emp_position_name' => 11, 'emp_level' => 12, 'employee_code' => 13, 'employee' => 14, 'jw_employee_code' => 15, 'jw_employee' => 16, 'jw_position_name' => 17, 'outlet_type' => 18, 'outlet_code' => 19, 'outlet_name' => 20, 'agendacontroltype' => 21, 'agendname' => 22, 'stownname' => 23, 'dcr_date' => 24, 'dcr_status' => 25, 'nca_comments' => 26, 'planned' => 27, 'managers_name' => 28, 'brands_detailed_name' => 29, 'ed_duration' => 30, 'datetime' => 31, 'emp_territory' => 32, 'emp_branch' => 33, 'emp_town' => 34, 'customer_town' => 35, 'customer_patch' => 36, 'leave_teken' => 37, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'BuName' => 'BU_NAME',
        'ExportDcr.BuName' => 'BU_NAME',
        'buName' => 'BU_NAME',
        'exportDcr.buName' => 'BU_NAME',
        'ExportDcrTableMap::COL_BU_NAME' => 'BU_NAME',
        'COL_BU_NAME' => 'BU_NAME',
        'bu_name' => 'BU_NAME',
        'export_dcr.bu_name' => 'BU_NAME',
        'ZmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'ExportDcr.ZmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'zmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'exportDcr.zmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'ExportDcrTableMap::COL_ZM_MANAGER_BRANCH' => 'ZM_MANAGER_BRANCH',
        'COL_ZM_MANAGER_BRANCH' => 'ZM_MANAGER_BRANCH',
        'zm_manager_branch' => 'ZM_MANAGER_BRANCH',
        'export_dcr.zm_manager_branch' => 'ZM_MANAGER_BRANCH',
        'ZmManagerTown' => 'ZM_MANAGER_TOWN',
        'ExportDcr.ZmManagerTown' => 'ZM_MANAGER_TOWN',
        'zmManagerTown' => 'ZM_MANAGER_TOWN',
        'exportDcr.zmManagerTown' => 'ZM_MANAGER_TOWN',
        'ExportDcrTableMap::COL_ZM_MANAGER_TOWN' => 'ZM_MANAGER_TOWN',
        'COL_ZM_MANAGER_TOWN' => 'ZM_MANAGER_TOWN',
        'zm_manager_town' => 'ZM_MANAGER_TOWN',
        'export_dcr.zm_manager_town' => 'ZM_MANAGER_TOWN',
        'RmManagerBranch' => 'RM_MANAGER_BRANCH',
        'ExportDcr.RmManagerBranch' => 'RM_MANAGER_BRANCH',
        'rmManagerBranch' => 'RM_MANAGER_BRANCH',
        'exportDcr.rmManagerBranch' => 'RM_MANAGER_BRANCH',
        'ExportDcrTableMap::COL_RM_MANAGER_BRANCH' => 'RM_MANAGER_BRANCH',
        'COL_RM_MANAGER_BRANCH' => 'RM_MANAGER_BRANCH',
        'rm_manager_branch' => 'RM_MANAGER_BRANCH',
        'export_dcr.rm_manager_branch' => 'RM_MANAGER_BRANCH',
        'RmManagerTown' => 'RM_MANAGER_TOWN',
        'ExportDcr.RmManagerTown' => 'RM_MANAGER_TOWN',
        'rmManagerTown' => 'RM_MANAGER_TOWN',
        'exportDcr.rmManagerTown' => 'RM_MANAGER_TOWN',
        'ExportDcrTableMap::COL_RM_MANAGER_TOWN' => 'RM_MANAGER_TOWN',
        'COL_RM_MANAGER_TOWN' => 'RM_MANAGER_TOWN',
        'rm_manager_town' => 'RM_MANAGER_TOWN',
        'export_dcr.rm_manager_town' => 'RM_MANAGER_TOWN',
        'AmManagerBranch' => 'AM_MANAGER_BRANCH',
        'ExportDcr.AmManagerBranch' => 'AM_MANAGER_BRANCH',
        'amManagerBranch' => 'AM_MANAGER_BRANCH',
        'exportDcr.amManagerBranch' => 'AM_MANAGER_BRANCH',
        'ExportDcrTableMap::COL_AM_MANAGER_BRANCH' => 'AM_MANAGER_BRANCH',
        'COL_AM_MANAGER_BRANCH' => 'AM_MANAGER_BRANCH',
        'am_manager_branch' => 'AM_MANAGER_BRANCH',
        'export_dcr.am_manager_branch' => 'AM_MANAGER_BRANCH',
        'AmManagerTown' => 'AM_MANAGER_TOWN',
        'ExportDcr.AmManagerTown' => 'AM_MANAGER_TOWN',
        'amManagerTown' => 'AM_MANAGER_TOWN',
        'exportDcr.amManagerTown' => 'AM_MANAGER_TOWN',
        'ExportDcrTableMap::COL_AM_MANAGER_TOWN' => 'AM_MANAGER_TOWN',
        'COL_AM_MANAGER_TOWN' => 'AM_MANAGER_TOWN',
        'am_manager_town' => 'AM_MANAGER_TOWN',
        'export_dcr.am_manager_town' => 'AM_MANAGER_TOWN',
        'ZmPositionCode' => 'ZM_POSITION_CODE',
        'ExportDcr.ZmPositionCode' => 'ZM_POSITION_CODE',
        'zmPositionCode' => 'ZM_POSITION_CODE',
        'exportDcr.zmPositionCode' => 'ZM_POSITION_CODE',
        'ExportDcrTableMap::COL_ZM_POSITION_CODE' => 'ZM_POSITION_CODE',
        'COL_ZM_POSITION_CODE' => 'ZM_POSITION_CODE',
        'zm_position_code' => 'ZM_POSITION_CODE',
        'export_dcr.zm_position_code' => 'ZM_POSITION_CODE',
        'RmPositionCode' => 'RM_POSITION_CODE',
        'ExportDcr.RmPositionCode' => 'RM_POSITION_CODE',
        'rmPositionCode' => 'RM_POSITION_CODE',
        'exportDcr.rmPositionCode' => 'RM_POSITION_CODE',
        'ExportDcrTableMap::COL_RM_POSITION_CODE' => 'RM_POSITION_CODE',
        'COL_RM_POSITION_CODE' => 'RM_POSITION_CODE',
        'rm_position_code' => 'RM_POSITION_CODE',
        'export_dcr.rm_position_code' => 'RM_POSITION_CODE',
        'AmPositionCode' => 'AM_POSITION_CODE',
        'ExportDcr.AmPositionCode' => 'AM_POSITION_CODE',
        'amPositionCode' => 'AM_POSITION_CODE',
        'exportDcr.amPositionCode' => 'AM_POSITION_CODE',
        'ExportDcrTableMap::COL_AM_POSITION_CODE' => 'AM_POSITION_CODE',
        'COL_AM_POSITION_CODE' => 'AM_POSITION_CODE',
        'am_position_code' => 'AM_POSITION_CODE',
        'export_dcr.am_position_code' => 'AM_POSITION_CODE',
        'EmpPositionCode' => 'EMP_POSITION_CODE',
        'ExportDcr.EmpPositionCode' => 'EMP_POSITION_CODE',
        'empPositionCode' => 'EMP_POSITION_CODE',
        'exportDcr.empPositionCode' => 'EMP_POSITION_CODE',
        'ExportDcrTableMap::COL_EMP_POSITION_CODE' => 'EMP_POSITION_CODE',
        'COL_EMP_POSITION_CODE' => 'EMP_POSITION_CODE',
        'emp_position_code' => 'EMP_POSITION_CODE',
        'export_dcr.emp_position_code' => 'EMP_POSITION_CODE',
        'EmpPositionName' => 'EMP_POSITION_NAME',
        'ExportDcr.EmpPositionName' => 'EMP_POSITION_NAME',
        'empPositionName' => 'EMP_POSITION_NAME',
        'exportDcr.empPositionName' => 'EMP_POSITION_NAME',
        'ExportDcrTableMap::COL_EMP_POSITION_NAME' => 'EMP_POSITION_NAME',
        'COL_EMP_POSITION_NAME' => 'EMP_POSITION_NAME',
        'emp_position_name' => 'EMP_POSITION_NAME',
        'export_dcr.emp_position_name' => 'EMP_POSITION_NAME',
        'EmpLevel' => 'EMP_LEVEL',
        'ExportDcr.EmpLevel' => 'EMP_LEVEL',
        'empLevel' => 'EMP_LEVEL',
        'exportDcr.empLevel' => 'EMP_LEVEL',
        'ExportDcrTableMap::COL_EMP_LEVEL' => 'EMP_LEVEL',
        'COL_EMP_LEVEL' => 'EMP_LEVEL',
        'emp_level' => 'EMP_LEVEL',
        'export_dcr.emp_level' => 'EMP_LEVEL',
        'EmployeeCode' => 'EMPLOYEE_CODE',
        'ExportDcr.EmployeeCode' => 'EMPLOYEE_CODE',
        'employeeCode' => 'EMPLOYEE_CODE',
        'exportDcr.employeeCode' => 'EMPLOYEE_CODE',
        'ExportDcrTableMap::COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'employee_code' => 'EMPLOYEE_CODE',
        'export_dcr.employee_code' => 'EMPLOYEE_CODE',
        'Employee' => 'EMPLOYEE',
        'ExportDcr.Employee' => 'EMPLOYEE',
        'employee' => 'EMPLOYEE',
        'exportDcr.employee' => 'EMPLOYEE',
        'ExportDcrTableMap::COL_EMPLOYEE' => 'EMPLOYEE',
        'COL_EMPLOYEE' => 'EMPLOYEE',
        'export_dcr.employee' => 'EMPLOYEE',
        'JwEmployeeCode' => 'JW_EMPLOYEE_CODE',
        'ExportDcr.JwEmployeeCode' => 'JW_EMPLOYEE_CODE',
        'jwEmployeeCode' => 'JW_EMPLOYEE_CODE',
        'exportDcr.jwEmployeeCode' => 'JW_EMPLOYEE_CODE',
        'ExportDcrTableMap::COL_JW_EMPLOYEE_CODE' => 'JW_EMPLOYEE_CODE',
        'COL_JW_EMPLOYEE_CODE' => 'JW_EMPLOYEE_CODE',
        'jw_employee_code' => 'JW_EMPLOYEE_CODE',
        'export_dcr.jw_employee_code' => 'JW_EMPLOYEE_CODE',
        'JwEmployee' => 'JW_EMPLOYEE',
        'ExportDcr.JwEmployee' => 'JW_EMPLOYEE',
        'jwEmployee' => 'JW_EMPLOYEE',
        'exportDcr.jwEmployee' => 'JW_EMPLOYEE',
        'ExportDcrTableMap::COL_JW_EMPLOYEE' => 'JW_EMPLOYEE',
        'COL_JW_EMPLOYEE' => 'JW_EMPLOYEE',
        'jw_employee' => 'JW_EMPLOYEE',
        'export_dcr.jw_employee' => 'JW_EMPLOYEE',
        'JwPositionName' => 'JW_POSITION_NAME',
        'ExportDcr.JwPositionName' => 'JW_POSITION_NAME',
        'jwPositionName' => 'JW_POSITION_NAME',
        'exportDcr.jwPositionName' => 'JW_POSITION_NAME',
        'ExportDcrTableMap::COL_JW_POSITION_NAME' => 'JW_POSITION_NAME',
        'COL_JW_POSITION_NAME' => 'JW_POSITION_NAME',
        'jw_position_name' => 'JW_POSITION_NAME',
        'export_dcr.jw_position_name' => 'JW_POSITION_NAME',
        'OutletType' => 'OUTLET_TYPE',
        'ExportDcr.OutletType' => 'OUTLET_TYPE',
        'outletType' => 'OUTLET_TYPE',
        'exportDcr.outletType' => 'OUTLET_TYPE',
        'ExportDcrTableMap::COL_OUTLET_TYPE' => 'OUTLET_TYPE',
        'COL_OUTLET_TYPE' => 'OUTLET_TYPE',
        'outlet_type' => 'OUTLET_TYPE',
        'export_dcr.outlet_type' => 'OUTLET_TYPE',
        'OutletCode' => 'OUTLET_CODE',
        'ExportDcr.OutletCode' => 'OUTLET_CODE',
        'outletCode' => 'OUTLET_CODE',
        'exportDcr.outletCode' => 'OUTLET_CODE',
        'ExportDcrTableMap::COL_OUTLET_CODE' => 'OUTLET_CODE',
        'COL_OUTLET_CODE' => 'OUTLET_CODE',
        'outlet_code' => 'OUTLET_CODE',
        'export_dcr.outlet_code' => 'OUTLET_CODE',
        'OutletName' => 'OUTLET_NAME',
        'ExportDcr.OutletName' => 'OUTLET_NAME',
        'outletName' => 'OUTLET_NAME',
        'exportDcr.outletName' => 'OUTLET_NAME',
        'ExportDcrTableMap::COL_OUTLET_NAME' => 'OUTLET_NAME',
        'COL_OUTLET_NAME' => 'OUTLET_NAME',
        'outlet_name' => 'OUTLET_NAME',
        'export_dcr.outlet_name' => 'OUTLET_NAME',
        'Agendacontroltype' => 'AGENDACONTROLTYPE',
        'ExportDcr.Agendacontroltype' => 'AGENDACONTROLTYPE',
        'agendacontroltype' => 'AGENDACONTROLTYPE',
        'exportDcr.agendacontroltype' => 'AGENDACONTROLTYPE',
        'ExportDcrTableMap::COL_AGENDACONTROLTYPE' => 'AGENDACONTROLTYPE',
        'COL_AGENDACONTROLTYPE' => 'AGENDACONTROLTYPE',
        'export_dcr.agendacontroltype' => 'AGENDACONTROLTYPE',
        'Agendname' => 'AGENDNAME',
        'ExportDcr.Agendname' => 'AGENDNAME',
        'agendname' => 'AGENDNAME',
        'exportDcr.agendname' => 'AGENDNAME',
        'ExportDcrTableMap::COL_AGENDNAME' => 'AGENDNAME',
        'COL_AGENDNAME' => 'AGENDNAME',
        'export_dcr.agendname' => 'AGENDNAME',
        'Stownname' => 'STOWNNAME',
        'ExportDcr.Stownname' => 'STOWNNAME',
        'stownname' => 'STOWNNAME',
        'exportDcr.stownname' => 'STOWNNAME',
        'ExportDcrTableMap::COL_STOWNNAME' => 'STOWNNAME',
        'COL_STOWNNAME' => 'STOWNNAME',
        'export_dcr.stownname' => 'STOWNNAME',
        'DcrDate' => 'DCR_DATE',
        'ExportDcr.DcrDate' => 'DCR_DATE',
        'dcrDate' => 'DCR_DATE',
        'exportDcr.dcrDate' => 'DCR_DATE',
        'ExportDcrTableMap::COL_DCR_DATE' => 'DCR_DATE',
        'COL_DCR_DATE' => 'DCR_DATE',
        'dcr_date' => 'DCR_DATE',
        'export_dcr.dcr_date' => 'DCR_DATE',
        'DcrStatus' => 'DCR_STATUS',
        'ExportDcr.DcrStatus' => 'DCR_STATUS',
        'dcrStatus' => 'DCR_STATUS',
        'exportDcr.dcrStatus' => 'DCR_STATUS',
        'ExportDcrTableMap::COL_DCR_STATUS' => 'DCR_STATUS',
        'COL_DCR_STATUS' => 'DCR_STATUS',
        'dcr_status' => 'DCR_STATUS',
        'export_dcr.dcr_status' => 'DCR_STATUS',
        'NcaComments' => 'NCA_COMMENTS',
        'ExportDcr.NcaComments' => 'NCA_COMMENTS',
        'ncaComments' => 'NCA_COMMENTS',
        'exportDcr.ncaComments' => 'NCA_COMMENTS',
        'ExportDcrTableMap::COL_NCA_COMMENTS' => 'NCA_COMMENTS',
        'COL_NCA_COMMENTS' => 'NCA_COMMENTS',
        'nca_comments' => 'NCA_COMMENTS',
        'export_dcr.nca_comments' => 'NCA_COMMENTS',
        'Planned' => 'PLANNED',
        'ExportDcr.Planned' => 'PLANNED',
        'planned' => 'PLANNED',
        'exportDcr.planned' => 'PLANNED',
        'ExportDcrTableMap::COL_PLANNED' => 'PLANNED',
        'COL_PLANNED' => 'PLANNED',
        'export_dcr.planned' => 'PLANNED',
        'ManagersName' => 'MANAGERS_NAME',
        'ExportDcr.ManagersName' => 'MANAGERS_NAME',
        'managersName' => 'MANAGERS_NAME',
        'exportDcr.managersName' => 'MANAGERS_NAME',
        'ExportDcrTableMap::COL_MANAGERS_NAME' => 'MANAGERS_NAME',
        'COL_MANAGERS_NAME' => 'MANAGERS_NAME',
        'managers_name' => 'MANAGERS_NAME',
        'export_dcr.managers_name' => 'MANAGERS_NAME',
        'BrandsDetailedName' => 'BRANDS_DETAILED_NAME',
        'ExportDcr.BrandsDetailedName' => 'BRANDS_DETAILED_NAME',
        'brandsDetailedName' => 'BRANDS_DETAILED_NAME',
        'exportDcr.brandsDetailedName' => 'BRANDS_DETAILED_NAME',
        'ExportDcrTableMap::COL_BRANDS_DETAILED_NAME' => 'BRANDS_DETAILED_NAME',
        'COL_BRANDS_DETAILED_NAME' => 'BRANDS_DETAILED_NAME',
        'brands_detailed_name' => 'BRANDS_DETAILED_NAME',
        'export_dcr.brands_detailed_name' => 'BRANDS_DETAILED_NAME',
        'EdDuration' => 'ED_DURATION',
        'ExportDcr.EdDuration' => 'ED_DURATION',
        'edDuration' => 'ED_DURATION',
        'exportDcr.edDuration' => 'ED_DURATION',
        'ExportDcrTableMap::COL_ED_DURATION' => 'ED_DURATION',
        'COL_ED_DURATION' => 'ED_DURATION',
        'ed_duration' => 'ED_DURATION',
        'export_dcr.ed_duration' => 'ED_DURATION',
        'DateTime' => 'DATETIME',
        'ExportDcr.DateTime' => 'DATETIME',
        'dateTime' => 'DATETIME',
        'exportDcr.dateTime' => 'DATETIME',
        'ExportDcrTableMap::COL_DATETIME' => 'DATETIME',
        'COL_DATETIME' => 'DATETIME',
        'datetime' => 'DATETIME',
        'export_dcr.datetime' => 'DATETIME',
        'EmpTerritory' => 'EMP_TERRITORY',
        'ExportDcr.EmpTerritory' => 'EMP_TERRITORY',
        'empTerritory' => 'EMP_TERRITORY',
        'exportDcr.empTerritory' => 'EMP_TERRITORY',
        'ExportDcrTableMap::COL_EMP_TERRITORY' => 'EMP_TERRITORY',
        'COL_EMP_TERRITORY' => 'EMP_TERRITORY',
        'emp_territory' => 'EMP_TERRITORY',
        'export_dcr.emp_territory' => 'EMP_TERRITORY',
        'EmpBranch' => 'EMP_BRANCH',
        'ExportDcr.EmpBranch' => 'EMP_BRANCH',
        'empBranch' => 'EMP_BRANCH',
        'exportDcr.empBranch' => 'EMP_BRANCH',
        'ExportDcrTableMap::COL_EMP_BRANCH' => 'EMP_BRANCH',
        'COL_EMP_BRANCH' => 'EMP_BRANCH',
        'emp_branch' => 'EMP_BRANCH',
        'export_dcr.emp_branch' => 'EMP_BRANCH',
        'EmpTown' => 'EMP_TOWN',
        'ExportDcr.EmpTown' => 'EMP_TOWN',
        'empTown' => 'EMP_TOWN',
        'exportDcr.empTown' => 'EMP_TOWN',
        'ExportDcrTableMap::COL_EMP_TOWN' => 'EMP_TOWN',
        'COL_EMP_TOWN' => 'EMP_TOWN',
        'emp_town' => 'EMP_TOWN',
        'export_dcr.emp_town' => 'EMP_TOWN',
        'CustomerTown' => 'CUSTOMER_TOWN',
        'ExportDcr.CustomerTown' => 'CUSTOMER_TOWN',
        'customerTown' => 'CUSTOMER_TOWN',
        'exportDcr.customerTown' => 'CUSTOMER_TOWN',
        'ExportDcrTableMap::COL_CUSTOMER_TOWN' => 'CUSTOMER_TOWN',
        'COL_CUSTOMER_TOWN' => 'CUSTOMER_TOWN',
        'customer_town' => 'CUSTOMER_TOWN',
        'export_dcr.customer_town' => 'CUSTOMER_TOWN',
        'CustomerPatch' => 'CUSTOMER_PATCH',
        'ExportDcr.CustomerPatch' => 'CUSTOMER_PATCH',
        'customerPatch' => 'CUSTOMER_PATCH',
        'exportDcr.customerPatch' => 'CUSTOMER_PATCH',
        'ExportDcrTableMap::COL_CUSTOMER_PATCH' => 'CUSTOMER_PATCH',
        'COL_CUSTOMER_PATCH' => 'CUSTOMER_PATCH',
        'customer_patch' => 'CUSTOMER_PATCH',
        'export_dcr.customer_patch' => 'CUSTOMER_PATCH',
        'LeaveTaken' => 'LEAVE_TEKEN',
        'ExportDcr.LeaveTaken' => 'LEAVE_TEKEN',
        'leaveTaken' => 'LEAVE_TEKEN',
        'exportDcr.leaveTaken' => 'LEAVE_TEKEN',
        'ExportDcrTableMap::COL_LEAVE_TEKEN' => 'LEAVE_TEKEN',
        'COL_LEAVE_TEKEN' => 'LEAVE_TEKEN',
        'leave_teken' => 'LEAVE_TEKEN',
        'export_dcr.leave_teken' => 'LEAVE_TEKEN',
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
        $this->setName('export_dcr');
        $this->setPhpName('ExportDcr');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\ExportDcr');
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
        return $withPrefix ? ExportDcrTableMap::CLASS_DEFAULT : ExportDcrTableMap::OM_CLASS;
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
     * @return array (ExportDcr object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ExportDcrTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ExportDcrTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ExportDcrTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ExportDcrTableMap::OM_CLASS;
            /** @var ExportDcr $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ExportDcrTableMap::addInstanceToPool($obj, $key);
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
            $key = ExportDcrTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ExportDcrTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ExportDcr $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ExportDcrTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ExportDcrTableMap::COL_BU_NAME);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_ZM_MANAGER_BRANCH);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_ZM_MANAGER_TOWN);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_RM_MANAGER_BRANCH);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_RM_MANAGER_TOWN);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_AM_MANAGER_BRANCH);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_AM_MANAGER_TOWN);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_ZM_POSITION_CODE);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_RM_POSITION_CODE);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_AM_POSITION_CODE);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_EMP_POSITION_CODE);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_EMP_POSITION_NAME);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_EMP_LEVEL);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_EMPLOYEE_CODE);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_EMPLOYEE);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_JW_EMPLOYEE_CODE);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_JW_EMPLOYEE);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_JW_POSITION_NAME);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_OUTLET_TYPE);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_OUTLET_CODE);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_OUTLET_NAME);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_AGENDACONTROLTYPE);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_AGENDNAME);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_STOWNNAME);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_DCR_DATE);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_DCR_STATUS);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_NCA_COMMENTS);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_PLANNED);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_MANAGERS_NAME);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_BRANDS_DETAILED_NAME);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_ED_DURATION);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_DATETIME);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_EMP_TERRITORY);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_EMP_BRANCH);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_EMP_TOWN);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_CUSTOMER_TOWN);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_CUSTOMER_PATCH);
            $criteria->addSelectColumn(ExportDcrTableMap::COL_LEAVE_TEKEN);
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
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_BU_NAME);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_ZM_MANAGER_BRANCH);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_ZM_MANAGER_TOWN);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_RM_MANAGER_BRANCH);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_RM_MANAGER_TOWN);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_AM_MANAGER_BRANCH);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_AM_MANAGER_TOWN);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_ZM_POSITION_CODE);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_RM_POSITION_CODE);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_AM_POSITION_CODE);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_EMP_POSITION_CODE);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_EMP_POSITION_NAME);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_EMP_LEVEL);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_EMPLOYEE_CODE);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_EMPLOYEE);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_JW_EMPLOYEE_CODE);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_JW_EMPLOYEE);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_JW_POSITION_NAME);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_OUTLET_TYPE);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_OUTLET_CODE);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_OUTLET_NAME);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_AGENDACONTROLTYPE);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_AGENDNAME);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_STOWNNAME);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_DCR_DATE);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_DCR_STATUS);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_NCA_COMMENTS);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_PLANNED);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_MANAGERS_NAME);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_BRANDS_DETAILED_NAME);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_ED_DURATION);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_DATETIME);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_EMP_TERRITORY);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_EMP_BRANCH);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_EMP_TOWN);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_CUSTOMER_TOWN);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_CUSTOMER_PATCH);
            $criteria->removeSelectColumn(ExportDcrTableMap::COL_LEAVE_TEKEN);
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
        return Propel::getServiceContainer()->getDatabaseMap(ExportDcrTableMap::DATABASE_NAME)->getTable(ExportDcrTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a ExportDcr or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or ExportDcr object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ExportDcrTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\ExportDcr) { // it's a model object
            // create criteria based on pk value
            $criteria = $values->buildCriteria();
        } else { // it's a primary key, or an array of pks
            throw new LogicException('The ExportDcr object has no primary key');
        }

        $query = ExportDcrQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ExportDcrTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ExportDcrTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the export_dcr table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ExportDcrQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ExportDcr or Criteria object.
     *
     * @param mixed $criteria Criteria or ExportDcr object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExportDcrTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ExportDcr object
        }


        // Set the correct dbName
        $query = ExportDcrQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
