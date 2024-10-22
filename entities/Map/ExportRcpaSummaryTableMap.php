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
use entities\ExportRcpaSummary;
use entities\ExportRcpaSummaryQuery;


/**
 * This class defines the structure of the 'export_rcpa_summary' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ExportRcpaSummaryTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.ExportRcpaSummaryTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'export_rcpa_summary';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'ExportRcpaSummary';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\ExportRcpaSummary';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.ExportRcpaSummary';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 39;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 39;

    /**
     * the column name for the uniqueid field
     */
    public const COL_UNIQUEID = 'export_rcpa_summary.uniqueid';

    /**
     * the column name for the orgunitid field
     */
    public const COL_ORGUNITID = 'export_rcpa_summary.orgunitid';

    /**
     * the column name for the zm_manager_branch field
     */
    public const COL_ZM_MANAGER_BRANCH = 'export_rcpa_summary.zm_manager_branch';

    /**
     * the column name for the zm_manager_town field
     */
    public const COL_ZM_MANAGER_TOWN = 'export_rcpa_summary.zm_manager_town';

    /**
     * the column name for the rm_manager_branch field
     */
    public const COL_RM_MANAGER_BRANCH = 'export_rcpa_summary.rm_manager_branch';

    /**
     * the column name for the rm_manager_town field
     */
    public const COL_RM_MANAGER_TOWN = 'export_rcpa_summary.rm_manager_town';

    /**
     * the column name for the am_manager_branch field
     */
    public const COL_AM_MANAGER_BRANCH = 'export_rcpa_summary.am_manager_branch';

    /**
     * the column name for the am_manager_town field
     */
    public const COL_AM_MANAGER_TOWN = 'export_rcpa_summary.am_manager_town';

    /**
     * the column name for the zm_position_code field
     */
    public const COL_ZM_POSITION_CODE = 'export_rcpa_summary.zm_position_code';

    /**
     * the column name for the rm_position_code field
     */
    public const COL_RM_POSITION_CODE = 'export_rcpa_summary.rm_position_code';

    /**
     * the column name for the am_position_code field
     */
    public const COL_AM_POSITION_CODE = 'export_rcpa_summary.am_position_code';

    /**
     * the column name for the emp_position_code field
     */
    public const COL_EMP_POSITION_CODE = 'export_rcpa_summary.emp_position_code';

    /**
     * the column name for the emp_position_name field
     */
    public const COL_EMP_POSITION_NAME = 'export_rcpa_summary.emp_position_name';

    /**
     * the column name for the emp_level field
     */
    public const COL_EMP_LEVEL = 'export_rcpa_summary.emp_level';

    /**
     * the column name for the employee_code field
     */
    public const COL_EMPLOYEE_CODE = 'export_rcpa_summary.employee_code';

    /**
     * the column name for the emp_name field
     */
    public const COL_EMP_NAME = 'export_rcpa_summary.emp_name';

    /**
     * the column name for the drcode field
     */
    public const COL_DRCODE = 'export_rcpa_summary.drcode';

    /**
     * the column name for the drname field
     */
    public const COL_DRNAME = 'export_rcpa_summary.drname';

    /**
     * the column name for the retailercode field
     */
    public const COL_RETAILERCODE = 'export_rcpa_summary.retailercode';

    /**
     * the column name for the retailername field
     */
    public const COL_RETAILERNAME = 'export_rcpa_summary.retailername';

    /**
     * the column name for the outlet_classification field
     */
    public const COL_OUTLET_CLASSIFICATION = 'export_rcpa_summary.outlet_classification';

    /**
     * the column name for the visit_fq field
     */
    public const COL_VISIT_FQ = 'export_rcpa_summary.visit_fq';

    /**
     * the column name for the territory field
     */
    public const COL_TERRITORY = 'export_rcpa_summary.territory';

    /**
     * the column name for the tags field
     */
    public const COL_TAGS = 'export_rcpa_summary.tags';

    /**
     * the column name for the rcpa_moye field
     */
    public const COL_RCPA_MOYE = 'export_rcpa_summary.rcpa_moye';

    /**
     * the column name for the brand_name field
     */
    public const COL_BRAND_NAME = 'export_rcpa_summary.brand_name';

    /**
     * the column name for the competitor_name field
     */
    public const COL_COMPETITOR_NAME = 'export_rcpa_summary.competitor_name';

    /**
     * the column name for the rcpa_qty field
     */
    public const COL_RCPA_QTY = 'export_rcpa_summary.rcpa_qty';

    /**
     * the column name for the own_rate field
     */
    public const COL_OWN_RATE = 'export_rcpa_summary.own_rate';

    /**
     * the column name for the competitor_rate field
     */
    public const COL_COMPETITOR_RATE = 'export_rcpa_summary.competitor_rate';

    /**
     * the column name for the potential field
     */
    public const COL_POTENTIAL = 'export_rcpa_summary.potential';

    /**
     * the column name for the own field
     */
    public const COL_OWN = 'export_rcpa_summary.own';

    /**
     * the column name for the competition field
     */
    public const COL_COMPETITION = 'export_rcpa_summary.competition';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'export_rcpa_summary.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'export_rcpa_summary.updated_at';

    /**
     * the column name for the min_value field
     */
    public const COL_MIN_VALUE = 'export_rcpa_summary.min_value';

    /**
     * the column name for the emp_territory field
     */
    public const COL_EMP_TERRITORY = 'export_rcpa_summary.emp_territory';

    /**
     * the column name for the emp_branch field
     */
    public const COL_EMP_BRANCH = 'export_rcpa_summary.emp_branch';

    /**
     * the column name for the emp_town field
     */
    public const COL_EMP_TOWN = 'export_rcpa_summary.emp_town';

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
        self::TYPE_PHPNAME       => ['Uniqueid', 'Orgunitid', 'ZmManagerBranch', 'ZmManagerTown', 'RmManagerBranch', 'RmManagerTown', 'AmManagerBranch', 'AmManagerTown', 'ZmPositionCode', 'RmPositionCode', 'AmPositionCode', 'EmpPositionCode', 'EmpPositionName', 'EmpLevel', 'EmployeeCode', 'EmpName', 'Drcode', 'Drname', 'Retailercode', 'Retailername', 'OutletClassification', 'VisitFq', 'Territory', 'Tags', 'RcpaMoye', 'BrandName', 'CompetitorName', 'RcpaQty', 'OwnRate', 'CompetitorRate', 'Potential', 'Own', 'Competition', 'CreatedAt', 'UpdatedAt', 'MinValue', 'EmpTerritory', 'EmpBranch', 'EmpTown', ],
        self::TYPE_CAMELNAME     => ['uniqueid', 'orgunitid', 'zmManagerBranch', 'zmManagerTown', 'rmManagerBranch', 'rmManagerTown', 'amManagerBranch', 'amManagerTown', 'zmPositionCode', 'rmPositionCode', 'amPositionCode', 'empPositionCode', 'empPositionName', 'empLevel', 'employeeCode', 'empName', 'drcode', 'drname', 'retailercode', 'retailername', 'outletClassification', 'visitFq', 'territory', 'tags', 'rcpaMoye', 'brandName', 'competitorName', 'rcpaQty', 'ownRate', 'competitorRate', 'potential', 'own', 'competition', 'createdAt', 'updatedAt', 'minValue', 'empTerritory', 'empBranch', 'empTown', ],
        self::TYPE_COLNAME       => [ExportRcpaSummaryTableMap::COL_UNIQUEID, ExportRcpaSummaryTableMap::COL_ORGUNITID, ExportRcpaSummaryTableMap::COL_ZM_MANAGER_BRANCH, ExportRcpaSummaryTableMap::COL_ZM_MANAGER_TOWN, ExportRcpaSummaryTableMap::COL_RM_MANAGER_BRANCH, ExportRcpaSummaryTableMap::COL_RM_MANAGER_TOWN, ExportRcpaSummaryTableMap::COL_AM_MANAGER_BRANCH, ExportRcpaSummaryTableMap::COL_AM_MANAGER_TOWN, ExportRcpaSummaryTableMap::COL_ZM_POSITION_CODE, ExportRcpaSummaryTableMap::COL_RM_POSITION_CODE, ExportRcpaSummaryTableMap::COL_AM_POSITION_CODE, ExportRcpaSummaryTableMap::COL_EMP_POSITION_CODE, ExportRcpaSummaryTableMap::COL_EMP_POSITION_NAME, ExportRcpaSummaryTableMap::COL_EMP_LEVEL, ExportRcpaSummaryTableMap::COL_EMPLOYEE_CODE, ExportRcpaSummaryTableMap::COL_EMP_NAME, ExportRcpaSummaryTableMap::COL_DRCODE, ExportRcpaSummaryTableMap::COL_DRNAME, ExportRcpaSummaryTableMap::COL_RETAILERCODE, ExportRcpaSummaryTableMap::COL_RETAILERNAME, ExportRcpaSummaryTableMap::COL_OUTLET_CLASSIFICATION, ExportRcpaSummaryTableMap::COL_VISIT_FQ, ExportRcpaSummaryTableMap::COL_TERRITORY, ExportRcpaSummaryTableMap::COL_TAGS, ExportRcpaSummaryTableMap::COL_RCPA_MOYE, ExportRcpaSummaryTableMap::COL_BRAND_NAME, ExportRcpaSummaryTableMap::COL_COMPETITOR_NAME, ExportRcpaSummaryTableMap::COL_RCPA_QTY, ExportRcpaSummaryTableMap::COL_OWN_RATE, ExportRcpaSummaryTableMap::COL_COMPETITOR_RATE, ExportRcpaSummaryTableMap::COL_POTENTIAL, ExportRcpaSummaryTableMap::COL_OWN, ExportRcpaSummaryTableMap::COL_COMPETITION, ExportRcpaSummaryTableMap::COL_CREATED_AT, ExportRcpaSummaryTableMap::COL_UPDATED_AT, ExportRcpaSummaryTableMap::COL_MIN_VALUE, ExportRcpaSummaryTableMap::COL_EMP_TERRITORY, ExportRcpaSummaryTableMap::COL_EMP_BRANCH, ExportRcpaSummaryTableMap::COL_EMP_TOWN, ],
        self::TYPE_FIELDNAME     => ['uniqueid', 'orgunitid', 'zm_manager_branch', 'zm_manager_town', 'rm_manager_branch', 'rm_manager_town', 'am_manager_branch', 'am_manager_town', 'zm_position_code', 'rm_position_code', 'am_position_code', 'emp_position_code', 'emp_position_name', 'emp_level', 'employee_code', 'emp_name', 'drcode', 'drname', 'retailercode', 'retailername', 'outlet_classification', 'visit_fq', 'territory', 'tags', 'rcpa_moye', 'brand_name', 'competitor_name', 'rcpa_qty', 'own_rate', 'competitor_rate', 'potential', 'own', 'competition', 'created_at', 'updated_at', 'min_value', 'emp_territory', 'emp_branch', 'emp_town', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, ]
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
        self::TYPE_PHPNAME       => ['Uniqueid' => 0, 'Orgunitid' => 1, 'ZmManagerBranch' => 2, 'ZmManagerTown' => 3, 'RmManagerBranch' => 4, 'RmManagerTown' => 5, 'AmManagerBranch' => 6, 'AmManagerTown' => 7, 'ZmPositionCode' => 8, 'RmPositionCode' => 9, 'AmPositionCode' => 10, 'EmpPositionCode' => 11, 'EmpPositionName' => 12, 'EmpLevel' => 13, 'EmployeeCode' => 14, 'EmpName' => 15, 'Drcode' => 16, 'Drname' => 17, 'Retailercode' => 18, 'Retailername' => 19, 'OutletClassification' => 20, 'VisitFq' => 21, 'Territory' => 22, 'Tags' => 23, 'RcpaMoye' => 24, 'BrandName' => 25, 'CompetitorName' => 26, 'RcpaQty' => 27, 'OwnRate' => 28, 'CompetitorRate' => 29, 'Potential' => 30, 'Own' => 31, 'Competition' => 32, 'CreatedAt' => 33, 'UpdatedAt' => 34, 'MinValue' => 35, 'EmpTerritory' => 36, 'EmpBranch' => 37, 'EmpTown' => 38, ],
        self::TYPE_CAMELNAME     => ['uniqueid' => 0, 'orgunitid' => 1, 'zmManagerBranch' => 2, 'zmManagerTown' => 3, 'rmManagerBranch' => 4, 'rmManagerTown' => 5, 'amManagerBranch' => 6, 'amManagerTown' => 7, 'zmPositionCode' => 8, 'rmPositionCode' => 9, 'amPositionCode' => 10, 'empPositionCode' => 11, 'empPositionName' => 12, 'empLevel' => 13, 'employeeCode' => 14, 'empName' => 15, 'drcode' => 16, 'drname' => 17, 'retailercode' => 18, 'retailername' => 19, 'outletClassification' => 20, 'visitFq' => 21, 'territory' => 22, 'tags' => 23, 'rcpaMoye' => 24, 'brandName' => 25, 'competitorName' => 26, 'rcpaQty' => 27, 'ownRate' => 28, 'competitorRate' => 29, 'potential' => 30, 'own' => 31, 'competition' => 32, 'createdAt' => 33, 'updatedAt' => 34, 'minValue' => 35, 'empTerritory' => 36, 'empBranch' => 37, 'empTown' => 38, ],
        self::TYPE_COLNAME       => [ExportRcpaSummaryTableMap::COL_UNIQUEID => 0, ExportRcpaSummaryTableMap::COL_ORGUNITID => 1, ExportRcpaSummaryTableMap::COL_ZM_MANAGER_BRANCH => 2, ExportRcpaSummaryTableMap::COL_ZM_MANAGER_TOWN => 3, ExportRcpaSummaryTableMap::COL_RM_MANAGER_BRANCH => 4, ExportRcpaSummaryTableMap::COL_RM_MANAGER_TOWN => 5, ExportRcpaSummaryTableMap::COL_AM_MANAGER_BRANCH => 6, ExportRcpaSummaryTableMap::COL_AM_MANAGER_TOWN => 7, ExportRcpaSummaryTableMap::COL_ZM_POSITION_CODE => 8, ExportRcpaSummaryTableMap::COL_RM_POSITION_CODE => 9, ExportRcpaSummaryTableMap::COL_AM_POSITION_CODE => 10, ExportRcpaSummaryTableMap::COL_EMP_POSITION_CODE => 11, ExportRcpaSummaryTableMap::COL_EMP_POSITION_NAME => 12, ExportRcpaSummaryTableMap::COL_EMP_LEVEL => 13, ExportRcpaSummaryTableMap::COL_EMPLOYEE_CODE => 14, ExportRcpaSummaryTableMap::COL_EMP_NAME => 15, ExportRcpaSummaryTableMap::COL_DRCODE => 16, ExportRcpaSummaryTableMap::COL_DRNAME => 17, ExportRcpaSummaryTableMap::COL_RETAILERCODE => 18, ExportRcpaSummaryTableMap::COL_RETAILERNAME => 19, ExportRcpaSummaryTableMap::COL_OUTLET_CLASSIFICATION => 20, ExportRcpaSummaryTableMap::COL_VISIT_FQ => 21, ExportRcpaSummaryTableMap::COL_TERRITORY => 22, ExportRcpaSummaryTableMap::COL_TAGS => 23, ExportRcpaSummaryTableMap::COL_RCPA_MOYE => 24, ExportRcpaSummaryTableMap::COL_BRAND_NAME => 25, ExportRcpaSummaryTableMap::COL_COMPETITOR_NAME => 26, ExportRcpaSummaryTableMap::COL_RCPA_QTY => 27, ExportRcpaSummaryTableMap::COL_OWN_RATE => 28, ExportRcpaSummaryTableMap::COL_COMPETITOR_RATE => 29, ExportRcpaSummaryTableMap::COL_POTENTIAL => 30, ExportRcpaSummaryTableMap::COL_OWN => 31, ExportRcpaSummaryTableMap::COL_COMPETITION => 32, ExportRcpaSummaryTableMap::COL_CREATED_AT => 33, ExportRcpaSummaryTableMap::COL_UPDATED_AT => 34, ExportRcpaSummaryTableMap::COL_MIN_VALUE => 35, ExportRcpaSummaryTableMap::COL_EMP_TERRITORY => 36, ExportRcpaSummaryTableMap::COL_EMP_BRANCH => 37, ExportRcpaSummaryTableMap::COL_EMP_TOWN => 38, ],
        self::TYPE_FIELDNAME     => ['uniqueid' => 0, 'orgunitid' => 1, 'zm_manager_branch' => 2, 'zm_manager_town' => 3, 'rm_manager_branch' => 4, 'rm_manager_town' => 5, 'am_manager_branch' => 6, 'am_manager_town' => 7, 'zm_position_code' => 8, 'rm_position_code' => 9, 'am_position_code' => 10, 'emp_position_code' => 11, 'emp_position_name' => 12, 'emp_level' => 13, 'employee_code' => 14, 'emp_name' => 15, 'drcode' => 16, 'drname' => 17, 'retailercode' => 18, 'retailername' => 19, 'outlet_classification' => 20, 'visit_fq' => 21, 'territory' => 22, 'tags' => 23, 'rcpa_moye' => 24, 'brand_name' => 25, 'competitor_name' => 26, 'rcpa_qty' => 27, 'own_rate' => 28, 'competitor_rate' => 29, 'potential' => 30, 'own' => 31, 'competition' => 32, 'created_at' => 33, 'updated_at' => 34, 'min_value' => 35, 'emp_territory' => 36, 'emp_branch' => 37, 'emp_town' => 38, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Uniqueid' => 'UNIQUEID',
        'ExportRcpaSummary.Uniqueid' => 'UNIQUEID',
        'uniqueid' => 'UNIQUEID',
        'exportRcpaSummary.uniqueid' => 'UNIQUEID',
        'ExportRcpaSummaryTableMap::COL_UNIQUEID' => 'UNIQUEID',
        'COL_UNIQUEID' => 'UNIQUEID',
        'export_rcpa_summary.uniqueid' => 'UNIQUEID',
        'Orgunitid' => 'ORGUNITID',
        'ExportRcpaSummary.Orgunitid' => 'ORGUNITID',
        'orgunitid' => 'ORGUNITID',
        'exportRcpaSummary.orgunitid' => 'ORGUNITID',
        'ExportRcpaSummaryTableMap::COL_ORGUNITID' => 'ORGUNITID',
        'COL_ORGUNITID' => 'ORGUNITID',
        'export_rcpa_summary.orgunitid' => 'ORGUNITID',
        'ZmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'ExportRcpaSummary.ZmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'zmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'exportRcpaSummary.zmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'ExportRcpaSummaryTableMap::COL_ZM_MANAGER_BRANCH' => 'ZM_MANAGER_BRANCH',
        'COL_ZM_MANAGER_BRANCH' => 'ZM_MANAGER_BRANCH',
        'zm_manager_branch' => 'ZM_MANAGER_BRANCH',
        'export_rcpa_summary.zm_manager_branch' => 'ZM_MANAGER_BRANCH',
        'ZmManagerTown' => 'ZM_MANAGER_TOWN',
        'ExportRcpaSummary.ZmManagerTown' => 'ZM_MANAGER_TOWN',
        'zmManagerTown' => 'ZM_MANAGER_TOWN',
        'exportRcpaSummary.zmManagerTown' => 'ZM_MANAGER_TOWN',
        'ExportRcpaSummaryTableMap::COL_ZM_MANAGER_TOWN' => 'ZM_MANAGER_TOWN',
        'COL_ZM_MANAGER_TOWN' => 'ZM_MANAGER_TOWN',
        'zm_manager_town' => 'ZM_MANAGER_TOWN',
        'export_rcpa_summary.zm_manager_town' => 'ZM_MANAGER_TOWN',
        'RmManagerBranch' => 'RM_MANAGER_BRANCH',
        'ExportRcpaSummary.RmManagerBranch' => 'RM_MANAGER_BRANCH',
        'rmManagerBranch' => 'RM_MANAGER_BRANCH',
        'exportRcpaSummary.rmManagerBranch' => 'RM_MANAGER_BRANCH',
        'ExportRcpaSummaryTableMap::COL_RM_MANAGER_BRANCH' => 'RM_MANAGER_BRANCH',
        'COL_RM_MANAGER_BRANCH' => 'RM_MANAGER_BRANCH',
        'rm_manager_branch' => 'RM_MANAGER_BRANCH',
        'export_rcpa_summary.rm_manager_branch' => 'RM_MANAGER_BRANCH',
        'RmManagerTown' => 'RM_MANAGER_TOWN',
        'ExportRcpaSummary.RmManagerTown' => 'RM_MANAGER_TOWN',
        'rmManagerTown' => 'RM_MANAGER_TOWN',
        'exportRcpaSummary.rmManagerTown' => 'RM_MANAGER_TOWN',
        'ExportRcpaSummaryTableMap::COL_RM_MANAGER_TOWN' => 'RM_MANAGER_TOWN',
        'COL_RM_MANAGER_TOWN' => 'RM_MANAGER_TOWN',
        'rm_manager_town' => 'RM_MANAGER_TOWN',
        'export_rcpa_summary.rm_manager_town' => 'RM_MANAGER_TOWN',
        'AmManagerBranch' => 'AM_MANAGER_BRANCH',
        'ExportRcpaSummary.AmManagerBranch' => 'AM_MANAGER_BRANCH',
        'amManagerBranch' => 'AM_MANAGER_BRANCH',
        'exportRcpaSummary.amManagerBranch' => 'AM_MANAGER_BRANCH',
        'ExportRcpaSummaryTableMap::COL_AM_MANAGER_BRANCH' => 'AM_MANAGER_BRANCH',
        'COL_AM_MANAGER_BRANCH' => 'AM_MANAGER_BRANCH',
        'am_manager_branch' => 'AM_MANAGER_BRANCH',
        'export_rcpa_summary.am_manager_branch' => 'AM_MANAGER_BRANCH',
        'AmManagerTown' => 'AM_MANAGER_TOWN',
        'ExportRcpaSummary.AmManagerTown' => 'AM_MANAGER_TOWN',
        'amManagerTown' => 'AM_MANAGER_TOWN',
        'exportRcpaSummary.amManagerTown' => 'AM_MANAGER_TOWN',
        'ExportRcpaSummaryTableMap::COL_AM_MANAGER_TOWN' => 'AM_MANAGER_TOWN',
        'COL_AM_MANAGER_TOWN' => 'AM_MANAGER_TOWN',
        'am_manager_town' => 'AM_MANAGER_TOWN',
        'export_rcpa_summary.am_manager_town' => 'AM_MANAGER_TOWN',
        'ZmPositionCode' => 'ZM_POSITION_CODE',
        'ExportRcpaSummary.ZmPositionCode' => 'ZM_POSITION_CODE',
        'zmPositionCode' => 'ZM_POSITION_CODE',
        'exportRcpaSummary.zmPositionCode' => 'ZM_POSITION_CODE',
        'ExportRcpaSummaryTableMap::COL_ZM_POSITION_CODE' => 'ZM_POSITION_CODE',
        'COL_ZM_POSITION_CODE' => 'ZM_POSITION_CODE',
        'zm_position_code' => 'ZM_POSITION_CODE',
        'export_rcpa_summary.zm_position_code' => 'ZM_POSITION_CODE',
        'RmPositionCode' => 'RM_POSITION_CODE',
        'ExportRcpaSummary.RmPositionCode' => 'RM_POSITION_CODE',
        'rmPositionCode' => 'RM_POSITION_CODE',
        'exportRcpaSummary.rmPositionCode' => 'RM_POSITION_CODE',
        'ExportRcpaSummaryTableMap::COL_RM_POSITION_CODE' => 'RM_POSITION_CODE',
        'COL_RM_POSITION_CODE' => 'RM_POSITION_CODE',
        'rm_position_code' => 'RM_POSITION_CODE',
        'export_rcpa_summary.rm_position_code' => 'RM_POSITION_CODE',
        'AmPositionCode' => 'AM_POSITION_CODE',
        'ExportRcpaSummary.AmPositionCode' => 'AM_POSITION_CODE',
        'amPositionCode' => 'AM_POSITION_CODE',
        'exportRcpaSummary.amPositionCode' => 'AM_POSITION_CODE',
        'ExportRcpaSummaryTableMap::COL_AM_POSITION_CODE' => 'AM_POSITION_CODE',
        'COL_AM_POSITION_CODE' => 'AM_POSITION_CODE',
        'am_position_code' => 'AM_POSITION_CODE',
        'export_rcpa_summary.am_position_code' => 'AM_POSITION_CODE',
        'EmpPositionCode' => 'EMP_POSITION_CODE',
        'ExportRcpaSummary.EmpPositionCode' => 'EMP_POSITION_CODE',
        'empPositionCode' => 'EMP_POSITION_CODE',
        'exportRcpaSummary.empPositionCode' => 'EMP_POSITION_CODE',
        'ExportRcpaSummaryTableMap::COL_EMP_POSITION_CODE' => 'EMP_POSITION_CODE',
        'COL_EMP_POSITION_CODE' => 'EMP_POSITION_CODE',
        'emp_position_code' => 'EMP_POSITION_CODE',
        'export_rcpa_summary.emp_position_code' => 'EMP_POSITION_CODE',
        'EmpPositionName' => 'EMP_POSITION_NAME',
        'ExportRcpaSummary.EmpPositionName' => 'EMP_POSITION_NAME',
        'empPositionName' => 'EMP_POSITION_NAME',
        'exportRcpaSummary.empPositionName' => 'EMP_POSITION_NAME',
        'ExportRcpaSummaryTableMap::COL_EMP_POSITION_NAME' => 'EMP_POSITION_NAME',
        'COL_EMP_POSITION_NAME' => 'EMP_POSITION_NAME',
        'emp_position_name' => 'EMP_POSITION_NAME',
        'export_rcpa_summary.emp_position_name' => 'EMP_POSITION_NAME',
        'EmpLevel' => 'EMP_LEVEL',
        'ExportRcpaSummary.EmpLevel' => 'EMP_LEVEL',
        'empLevel' => 'EMP_LEVEL',
        'exportRcpaSummary.empLevel' => 'EMP_LEVEL',
        'ExportRcpaSummaryTableMap::COL_EMP_LEVEL' => 'EMP_LEVEL',
        'COL_EMP_LEVEL' => 'EMP_LEVEL',
        'emp_level' => 'EMP_LEVEL',
        'export_rcpa_summary.emp_level' => 'EMP_LEVEL',
        'EmployeeCode' => 'EMPLOYEE_CODE',
        'ExportRcpaSummary.EmployeeCode' => 'EMPLOYEE_CODE',
        'employeeCode' => 'EMPLOYEE_CODE',
        'exportRcpaSummary.employeeCode' => 'EMPLOYEE_CODE',
        'ExportRcpaSummaryTableMap::COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'employee_code' => 'EMPLOYEE_CODE',
        'export_rcpa_summary.employee_code' => 'EMPLOYEE_CODE',
        'EmpName' => 'EMP_NAME',
        'ExportRcpaSummary.EmpName' => 'EMP_NAME',
        'empName' => 'EMP_NAME',
        'exportRcpaSummary.empName' => 'EMP_NAME',
        'ExportRcpaSummaryTableMap::COL_EMP_NAME' => 'EMP_NAME',
        'COL_EMP_NAME' => 'EMP_NAME',
        'emp_name' => 'EMP_NAME',
        'export_rcpa_summary.emp_name' => 'EMP_NAME',
        'Drcode' => 'DRCODE',
        'ExportRcpaSummary.Drcode' => 'DRCODE',
        'drcode' => 'DRCODE',
        'exportRcpaSummary.drcode' => 'DRCODE',
        'ExportRcpaSummaryTableMap::COL_DRCODE' => 'DRCODE',
        'COL_DRCODE' => 'DRCODE',
        'export_rcpa_summary.drcode' => 'DRCODE',
        'Drname' => 'DRNAME',
        'ExportRcpaSummary.Drname' => 'DRNAME',
        'drname' => 'DRNAME',
        'exportRcpaSummary.drname' => 'DRNAME',
        'ExportRcpaSummaryTableMap::COL_DRNAME' => 'DRNAME',
        'COL_DRNAME' => 'DRNAME',
        'export_rcpa_summary.drname' => 'DRNAME',
        'Retailercode' => 'RETAILERCODE',
        'ExportRcpaSummary.Retailercode' => 'RETAILERCODE',
        'retailercode' => 'RETAILERCODE',
        'exportRcpaSummary.retailercode' => 'RETAILERCODE',
        'ExportRcpaSummaryTableMap::COL_RETAILERCODE' => 'RETAILERCODE',
        'COL_RETAILERCODE' => 'RETAILERCODE',
        'export_rcpa_summary.retailercode' => 'RETAILERCODE',
        'Retailername' => 'RETAILERNAME',
        'ExportRcpaSummary.Retailername' => 'RETAILERNAME',
        'retailername' => 'RETAILERNAME',
        'exportRcpaSummary.retailername' => 'RETAILERNAME',
        'ExportRcpaSummaryTableMap::COL_RETAILERNAME' => 'RETAILERNAME',
        'COL_RETAILERNAME' => 'RETAILERNAME',
        'export_rcpa_summary.retailername' => 'RETAILERNAME',
        'OutletClassification' => 'OUTLET_CLASSIFICATION',
        'ExportRcpaSummary.OutletClassification' => 'OUTLET_CLASSIFICATION',
        'outletClassification' => 'OUTLET_CLASSIFICATION',
        'exportRcpaSummary.outletClassification' => 'OUTLET_CLASSIFICATION',
        'ExportRcpaSummaryTableMap::COL_OUTLET_CLASSIFICATION' => 'OUTLET_CLASSIFICATION',
        'COL_OUTLET_CLASSIFICATION' => 'OUTLET_CLASSIFICATION',
        'outlet_classification' => 'OUTLET_CLASSIFICATION',
        'export_rcpa_summary.outlet_classification' => 'OUTLET_CLASSIFICATION',
        'VisitFq' => 'VISIT_FQ',
        'ExportRcpaSummary.VisitFq' => 'VISIT_FQ',
        'visitFq' => 'VISIT_FQ',
        'exportRcpaSummary.visitFq' => 'VISIT_FQ',
        'ExportRcpaSummaryTableMap::COL_VISIT_FQ' => 'VISIT_FQ',
        'COL_VISIT_FQ' => 'VISIT_FQ',
        'visit_fq' => 'VISIT_FQ',
        'export_rcpa_summary.visit_fq' => 'VISIT_FQ',
        'Territory' => 'TERRITORY',
        'ExportRcpaSummary.Territory' => 'TERRITORY',
        'territory' => 'TERRITORY',
        'exportRcpaSummary.territory' => 'TERRITORY',
        'ExportRcpaSummaryTableMap::COL_TERRITORY' => 'TERRITORY',
        'COL_TERRITORY' => 'TERRITORY',
        'export_rcpa_summary.territory' => 'TERRITORY',
        'Tags' => 'TAGS',
        'ExportRcpaSummary.Tags' => 'TAGS',
        'tags' => 'TAGS',
        'exportRcpaSummary.tags' => 'TAGS',
        'ExportRcpaSummaryTableMap::COL_TAGS' => 'TAGS',
        'COL_TAGS' => 'TAGS',
        'export_rcpa_summary.tags' => 'TAGS',
        'RcpaMoye' => 'RCPA_MOYE',
        'ExportRcpaSummary.RcpaMoye' => 'RCPA_MOYE',
        'rcpaMoye' => 'RCPA_MOYE',
        'exportRcpaSummary.rcpaMoye' => 'RCPA_MOYE',
        'ExportRcpaSummaryTableMap::COL_RCPA_MOYE' => 'RCPA_MOYE',
        'COL_RCPA_MOYE' => 'RCPA_MOYE',
        'rcpa_moye' => 'RCPA_MOYE',
        'export_rcpa_summary.rcpa_moye' => 'RCPA_MOYE',
        'BrandName' => 'BRAND_NAME',
        'ExportRcpaSummary.BrandName' => 'BRAND_NAME',
        'brandName' => 'BRAND_NAME',
        'exportRcpaSummary.brandName' => 'BRAND_NAME',
        'ExportRcpaSummaryTableMap::COL_BRAND_NAME' => 'BRAND_NAME',
        'COL_BRAND_NAME' => 'BRAND_NAME',
        'brand_name' => 'BRAND_NAME',
        'export_rcpa_summary.brand_name' => 'BRAND_NAME',
        'CompetitorName' => 'COMPETITOR_NAME',
        'ExportRcpaSummary.CompetitorName' => 'COMPETITOR_NAME',
        'competitorName' => 'COMPETITOR_NAME',
        'exportRcpaSummary.competitorName' => 'COMPETITOR_NAME',
        'ExportRcpaSummaryTableMap::COL_COMPETITOR_NAME' => 'COMPETITOR_NAME',
        'COL_COMPETITOR_NAME' => 'COMPETITOR_NAME',
        'competitor_name' => 'COMPETITOR_NAME',
        'export_rcpa_summary.competitor_name' => 'COMPETITOR_NAME',
        'RcpaQty' => 'RCPA_QTY',
        'ExportRcpaSummary.RcpaQty' => 'RCPA_QTY',
        'rcpaQty' => 'RCPA_QTY',
        'exportRcpaSummary.rcpaQty' => 'RCPA_QTY',
        'ExportRcpaSummaryTableMap::COL_RCPA_QTY' => 'RCPA_QTY',
        'COL_RCPA_QTY' => 'RCPA_QTY',
        'rcpa_qty' => 'RCPA_QTY',
        'export_rcpa_summary.rcpa_qty' => 'RCPA_QTY',
        'OwnRate' => 'OWN_RATE',
        'ExportRcpaSummary.OwnRate' => 'OWN_RATE',
        'ownRate' => 'OWN_RATE',
        'exportRcpaSummary.ownRate' => 'OWN_RATE',
        'ExportRcpaSummaryTableMap::COL_OWN_RATE' => 'OWN_RATE',
        'COL_OWN_RATE' => 'OWN_RATE',
        'own_rate' => 'OWN_RATE',
        'export_rcpa_summary.own_rate' => 'OWN_RATE',
        'CompetitorRate' => 'COMPETITOR_RATE',
        'ExportRcpaSummary.CompetitorRate' => 'COMPETITOR_RATE',
        'competitorRate' => 'COMPETITOR_RATE',
        'exportRcpaSummary.competitorRate' => 'COMPETITOR_RATE',
        'ExportRcpaSummaryTableMap::COL_COMPETITOR_RATE' => 'COMPETITOR_RATE',
        'COL_COMPETITOR_RATE' => 'COMPETITOR_RATE',
        'competitor_rate' => 'COMPETITOR_RATE',
        'export_rcpa_summary.competitor_rate' => 'COMPETITOR_RATE',
        'Potential' => 'POTENTIAL',
        'ExportRcpaSummary.Potential' => 'POTENTIAL',
        'potential' => 'POTENTIAL',
        'exportRcpaSummary.potential' => 'POTENTIAL',
        'ExportRcpaSummaryTableMap::COL_POTENTIAL' => 'POTENTIAL',
        'COL_POTENTIAL' => 'POTENTIAL',
        'export_rcpa_summary.potential' => 'POTENTIAL',
        'Own' => 'OWN',
        'ExportRcpaSummary.Own' => 'OWN',
        'own' => 'OWN',
        'exportRcpaSummary.own' => 'OWN',
        'ExportRcpaSummaryTableMap::COL_OWN' => 'OWN',
        'COL_OWN' => 'OWN',
        'export_rcpa_summary.own' => 'OWN',
        'Competition' => 'COMPETITION',
        'ExportRcpaSummary.Competition' => 'COMPETITION',
        'competition' => 'COMPETITION',
        'exportRcpaSummary.competition' => 'COMPETITION',
        'ExportRcpaSummaryTableMap::COL_COMPETITION' => 'COMPETITION',
        'COL_COMPETITION' => 'COMPETITION',
        'export_rcpa_summary.competition' => 'COMPETITION',
        'CreatedAt' => 'CREATED_AT',
        'ExportRcpaSummary.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'exportRcpaSummary.createdAt' => 'CREATED_AT',
        'ExportRcpaSummaryTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'export_rcpa_summary.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'ExportRcpaSummary.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'exportRcpaSummary.updatedAt' => 'UPDATED_AT',
        'ExportRcpaSummaryTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'export_rcpa_summary.updated_at' => 'UPDATED_AT',
        'MinValue' => 'MIN_VALUE',
        'ExportRcpaSummary.MinValue' => 'MIN_VALUE',
        'minValue' => 'MIN_VALUE',
        'exportRcpaSummary.minValue' => 'MIN_VALUE',
        'ExportRcpaSummaryTableMap::COL_MIN_VALUE' => 'MIN_VALUE',
        'COL_MIN_VALUE' => 'MIN_VALUE',
        'min_value' => 'MIN_VALUE',
        'export_rcpa_summary.min_value' => 'MIN_VALUE',
        'EmpTerritory' => 'EMP_TERRITORY',
        'ExportRcpaSummary.EmpTerritory' => 'EMP_TERRITORY',
        'empTerritory' => 'EMP_TERRITORY',
        'exportRcpaSummary.empTerritory' => 'EMP_TERRITORY',
        'ExportRcpaSummaryTableMap::COL_EMP_TERRITORY' => 'EMP_TERRITORY',
        'COL_EMP_TERRITORY' => 'EMP_TERRITORY',
        'emp_territory' => 'EMP_TERRITORY',
        'export_rcpa_summary.emp_territory' => 'EMP_TERRITORY',
        'EmpBranch' => 'EMP_BRANCH',
        'ExportRcpaSummary.EmpBranch' => 'EMP_BRANCH',
        'empBranch' => 'EMP_BRANCH',
        'exportRcpaSummary.empBranch' => 'EMP_BRANCH',
        'ExportRcpaSummaryTableMap::COL_EMP_BRANCH' => 'EMP_BRANCH',
        'COL_EMP_BRANCH' => 'EMP_BRANCH',
        'emp_branch' => 'EMP_BRANCH',
        'export_rcpa_summary.emp_branch' => 'EMP_BRANCH',
        'EmpTown' => 'EMP_TOWN',
        'ExportRcpaSummary.EmpTown' => 'EMP_TOWN',
        'empTown' => 'EMP_TOWN',
        'exportRcpaSummary.empTown' => 'EMP_TOWN',
        'ExportRcpaSummaryTableMap::COL_EMP_TOWN' => 'EMP_TOWN',
        'COL_EMP_TOWN' => 'EMP_TOWN',
        'emp_town' => 'EMP_TOWN',
        'export_rcpa_summary.emp_town' => 'EMP_TOWN',
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
        $this->setName('export_rcpa_summary');
        $this->setPhpName('ExportRcpaSummary');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\ExportRcpaSummary');
        $this->setPackage('entities');
        $this->setUseIdGenerator(false);
        // columns
        $this->addColumn('uniqueid', 'Uniqueid', 'VARCHAR', false, null, null);
        $this->addColumn('orgunitid', 'Orgunitid', 'VARCHAR', false, null, null);
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
        $this->addColumn('emp_name', 'EmpName', 'VARCHAR', false, null, null);
        $this->addColumn('drcode', 'Drcode', 'VARCHAR', false, null, null);
        $this->addColumn('drname', 'Drname', 'VARCHAR', false, null, null);
        $this->addColumn('retailercode', 'Retailercode', 'VARCHAR', false, null, null);
        $this->addColumn('retailername', 'Retailername', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_classification', 'OutletClassification', 'VARCHAR', false, null, null);
        $this->addColumn('visit_fq', 'VisitFq', 'INTEGER', false, null, null);
        $this->addColumn('territory', 'Territory', 'VARCHAR', false, null, null);
        $this->addColumn('tags', 'Tags', 'VARCHAR', false, null, null);
        $this->addColumn('rcpa_moye', 'RcpaMoye', 'VARCHAR', false, null, null);
        $this->addColumn('brand_name', 'BrandName', 'VARCHAR', false, null, null);
        $this->addColumn('competitor_name', 'CompetitorName', 'VARCHAR', false, null, null);
        $this->addColumn('rcpa_qty', 'RcpaQty', 'DECIMAL', false, null, null);
        $this->addColumn('own_rate', 'OwnRate', 'DECIMAL', false, null, null);
        $this->addColumn('competitor_rate', 'CompetitorRate', 'DECIMAL', false, null, null);
        $this->addColumn('potential', 'Potential', 'DECIMAL', false, null, null);
        $this->addColumn('own', 'Own', 'DECIMAL', false, null, null);
        $this->addColumn('competition', 'Competition', 'DECIMAL', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('min_value', 'MinValue', 'INTEGER', false, null, null);
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
        return $withPrefix ? ExportRcpaSummaryTableMap::CLASS_DEFAULT : ExportRcpaSummaryTableMap::OM_CLASS;
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
     * @return array (ExportRcpaSummary object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ExportRcpaSummaryTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ExportRcpaSummaryTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ExportRcpaSummaryTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ExportRcpaSummaryTableMap::OM_CLASS;
            /** @var ExportRcpaSummary $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ExportRcpaSummaryTableMap::addInstanceToPool($obj, $key);
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
            $key = ExportRcpaSummaryTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ExportRcpaSummaryTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ExportRcpaSummary $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ExportRcpaSummaryTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_UNIQUEID);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_ORGUNITID);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_ZM_MANAGER_BRANCH);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_ZM_MANAGER_TOWN);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_RM_MANAGER_BRANCH);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_RM_MANAGER_TOWN);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_AM_MANAGER_BRANCH);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_AM_MANAGER_TOWN);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_ZM_POSITION_CODE);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_RM_POSITION_CODE);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_AM_POSITION_CODE);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_EMP_POSITION_CODE);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_EMP_POSITION_NAME);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_EMP_LEVEL);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_EMPLOYEE_CODE);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_EMP_NAME);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_DRCODE);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_DRNAME);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_RETAILERCODE);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_RETAILERNAME);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_OUTLET_CLASSIFICATION);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_VISIT_FQ);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_TERRITORY);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_TAGS);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_RCPA_MOYE);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_BRAND_NAME);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_COMPETITOR_NAME);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_RCPA_QTY);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_OWN_RATE);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_COMPETITOR_RATE);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_POTENTIAL);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_OWN);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_COMPETITION);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_MIN_VALUE);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_EMP_TERRITORY);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_EMP_BRANCH);
            $criteria->addSelectColumn(ExportRcpaSummaryTableMap::COL_EMP_TOWN);
        } else {
            $criteria->addSelectColumn($alias . '.uniqueid');
            $criteria->addSelectColumn($alias . '.orgunitid');
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
            $criteria->addSelectColumn($alias . '.emp_name');
            $criteria->addSelectColumn($alias . '.drcode');
            $criteria->addSelectColumn($alias . '.drname');
            $criteria->addSelectColumn($alias . '.retailercode');
            $criteria->addSelectColumn($alias . '.retailername');
            $criteria->addSelectColumn($alias . '.outlet_classification');
            $criteria->addSelectColumn($alias . '.visit_fq');
            $criteria->addSelectColumn($alias . '.territory');
            $criteria->addSelectColumn($alias . '.tags');
            $criteria->addSelectColumn($alias . '.rcpa_moye');
            $criteria->addSelectColumn($alias . '.brand_name');
            $criteria->addSelectColumn($alias . '.competitor_name');
            $criteria->addSelectColumn($alias . '.rcpa_qty');
            $criteria->addSelectColumn($alias . '.own_rate');
            $criteria->addSelectColumn($alias . '.competitor_rate');
            $criteria->addSelectColumn($alias . '.potential');
            $criteria->addSelectColumn($alias . '.own');
            $criteria->addSelectColumn($alias . '.competition');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.min_value');
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
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_UNIQUEID);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_ORGUNITID);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_ZM_MANAGER_BRANCH);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_ZM_MANAGER_TOWN);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_RM_MANAGER_BRANCH);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_RM_MANAGER_TOWN);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_AM_MANAGER_BRANCH);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_AM_MANAGER_TOWN);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_ZM_POSITION_CODE);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_RM_POSITION_CODE);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_AM_POSITION_CODE);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_EMP_POSITION_CODE);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_EMP_POSITION_NAME);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_EMP_LEVEL);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_EMPLOYEE_CODE);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_EMP_NAME);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_DRCODE);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_DRNAME);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_RETAILERCODE);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_RETAILERNAME);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_OUTLET_CLASSIFICATION);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_VISIT_FQ);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_TERRITORY);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_TAGS);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_RCPA_MOYE);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_BRAND_NAME);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_COMPETITOR_NAME);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_RCPA_QTY);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_OWN_RATE);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_COMPETITOR_RATE);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_POTENTIAL);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_OWN);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_COMPETITION);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_MIN_VALUE);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_EMP_TERRITORY);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_EMP_BRANCH);
            $criteria->removeSelectColumn(ExportRcpaSummaryTableMap::COL_EMP_TOWN);
        } else {
            $criteria->removeSelectColumn($alias . '.uniqueid');
            $criteria->removeSelectColumn($alias . '.orgunitid');
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
            $criteria->removeSelectColumn($alias . '.emp_name');
            $criteria->removeSelectColumn($alias . '.drcode');
            $criteria->removeSelectColumn($alias . '.drname');
            $criteria->removeSelectColumn($alias . '.retailercode');
            $criteria->removeSelectColumn($alias . '.retailername');
            $criteria->removeSelectColumn($alias . '.outlet_classification');
            $criteria->removeSelectColumn($alias . '.visit_fq');
            $criteria->removeSelectColumn($alias . '.territory');
            $criteria->removeSelectColumn($alias . '.tags');
            $criteria->removeSelectColumn($alias . '.rcpa_moye');
            $criteria->removeSelectColumn($alias . '.brand_name');
            $criteria->removeSelectColumn($alias . '.competitor_name');
            $criteria->removeSelectColumn($alias . '.rcpa_qty');
            $criteria->removeSelectColumn($alias . '.own_rate');
            $criteria->removeSelectColumn($alias . '.competitor_rate');
            $criteria->removeSelectColumn($alias . '.potential');
            $criteria->removeSelectColumn($alias . '.own');
            $criteria->removeSelectColumn($alias . '.competition');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.min_value');
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
        return Propel::getServiceContainer()->getDatabaseMap(ExportRcpaSummaryTableMap::DATABASE_NAME)->getTable(ExportRcpaSummaryTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a ExportRcpaSummary or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or ExportRcpaSummary object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ExportRcpaSummaryTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\ExportRcpaSummary) { // it's a model object
            // create criteria based on pk value
            $criteria = $values->buildCriteria();
        } else { // it's a primary key, or an array of pks
            throw new LogicException('The ExportRcpaSummary object has no primary key');
        }

        $query = ExportRcpaSummaryQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ExportRcpaSummaryTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ExportRcpaSummaryTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the export_rcpa_summary table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ExportRcpaSummaryQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ExportRcpaSummary or Criteria object.
     *
     * @param mixed $criteria Criteria or ExportRcpaSummary object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExportRcpaSummaryTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ExportRcpaSummary object
        }


        // Set the correct dbName
        $query = ExportRcpaSummaryQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
