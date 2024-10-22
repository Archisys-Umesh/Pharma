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
use entities\ExportPob;
use entities\ExportPobQuery;


/**
 * This class defines the structure of the 'export_pob' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ExportPobTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.ExportPobTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'export_pob';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'ExportPob';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\ExportPob';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.ExportPob';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 33;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 33;

    /**
     * the column name for the bu_name field
     */
    public const COL_BU_NAME = 'export_pob.bu_name';

    /**
     * the column name for the zm_manager_branch field
     */
    public const COL_ZM_MANAGER_BRANCH = 'export_pob.zm_manager_branch';

    /**
     * the column name for the zm_manager_town field
     */
    public const COL_ZM_MANAGER_TOWN = 'export_pob.zm_manager_town';

    /**
     * the column name for the rm_manager_branch field
     */
    public const COL_RM_MANAGER_BRANCH = 'export_pob.rm_manager_branch';

    /**
     * the column name for the rm_manager_town field
     */
    public const COL_RM_MANAGER_TOWN = 'export_pob.rm_manager_town';

    /**
     * the column name for the am_manager_branch field
     */
    public const COL_AM_MANAGER_BRANCH = 'export_pob.am_manager_branch';

    /**
     * the column name for the am_manager_town field
     */
    public const COL_AM_MANAGER_TOWN = 'export_pob.am_manager_town';

    /**
     * the column name for the zm_position_code field
     */
    public const COL_ZM_POSITION_CODE = 'export_pob.zm_position_code';

    /**
     * the column name for the rm_position_code field
     */
    public const COL_RM_POSITION_CODE = 'export_pob.rm_position_code';

    /**
     * the column name for the am_position_code field
     */
    public const COL_AM_POSITION_CODE = 'export_pob.am_position_code';

    /**
     * the column name for the emp_position_code field
     */
    public const COL_EMP_POSITION_CODE = 'export_pob.emp_position_code';

    /**
     * the column name for the emp_position_name field
     */
    public const COL_EMP_POSITION_NAME = 'export_pob.emp_position_name';

    /**
     * the column name for the emp_level field
     */
    public const COL_EMP_LEVEL = 'export_pob.emp_level';

    /**
     * the column name for the employee_code field
     */
    public const COL_EMPLOYEE_CODE = 'export_pob.employee_code';

    /**
     * the column name for the employee field
     */
    public const COL_EMPLOYEE = 'export_pob.employee';

    /**
     * the column name for the designation field
     */
    public const COL_DESIGNATION = 'export_pob.designation';

    /**
     * the column name for the from_outlet_type field
     */
    public const COL_FROM_OUTLET_TYPE = 'export_pob.from_outlet_type';

    /**
     * the column name for the from_outlet_code field
     */
    public const COL_FROM_OUTLET_CODE = 'export_pob.from_outlet_code';

    /**
     * the column name for the from_outlet_name field
     */
    public const COL_FROM_OUTLET_NAME = 'export_pob.from_outlet_name';

    /**
     * the column name for the from_outlet_classification field
     */
    public const COL_FROM_OUTLET_CLASSIFICATION = 'export_pob.from_outlet_classification';

    /**
     * the column name for the to_outlet_type field
     */
    public const COL_TO_OUTLET_TYPE = 'export_pob.to_outlet_type';

    /**
     * the column name for the to_outlet_code field
     */
    public const COL_TO_OUTLET_CODE = 'export_pob.to_outlet_code';

    /**
     * the column name for the to_outlet_name field
     */
    public const COL_TO_OUTLET_NAME = 'export_pob.to_outlet_name';

    /**
     * the column name for the to_outlet_classification field
     */
    public const COL_TO_OUTLET_CLASSIFICATION = 'export_pob.to_outlet_classification';

    /**
     * the column name for the product_name field
     */
    public const COL_PRODUCT_NAME = 'export_pob.product_name';

    /**
     * the column name for the product_sku field
     */
    public const COL_PRODUCT_SKU = 'export_pob.product_sku';

    /**
     * the column name for the rate field
     */
    public const COL_RATE = 'export_pob.rate';

    /**
     * the column name for the qty field
     */
    public const COL_QTY = 'export_pob.qty';

    /**
     * the column name for the total_amt field
     */
    public const COL_TOTAL_AMT = 'export_pob.total_amt';

    /**
     * the column name for the order_date field
     */
    public const COL_ORDER_DATE = 'export_pob.order_date';

    /**
     * the column name for the emp_territory field
     */
    public const COL_EMP_TERRITORY = 'export_pob.emp_territory';

    /**
     * the column name for the emp_branch field
     */
    public const COL_EMP_BRANCH = 'export_pob.emp_branch';

    /**
     * the column name for the emp_town field
     */
    public const COL_EMP_TOWN = 'export_pob.emp_town';

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
        self::TYPE_PHPNAME       => ['BuName', 'ZmManagerBranch', 'ZmManagerTown', 'RmManagerBranch', 'RmManagerTown', 'AmManagerBranch', 'AmManagerTown', 'ZmPositionCode', 'RmPositionCode', 'AmPositionCode', 'EmpPositionCode', 'EmpPositionName', 'EmpLevel', 'EmployeeCode', 'Employee', 'Designation', 'FromOutletType', 'FromOutletCode', 'FromOutletName', 'FromOutletClassification', 'ToOutletType', 'ToOutletCode', 'ToOutletName', 'ToOutletClassification', 'ProductName', 'ProductSku', 'Rate', 'Qty', 'TotalAmt', 'OrderDate', 'EmpTerritory', 'EmpBranch', 'EmpTown', ],
        self::TYPE_CAMELNAME     => ['buName', 'zmManagerBranch', 'zmManagerTown', 'rmManagerBranch', 'rmManagerTown', 'amManagerBranch', 'amManagerTown', 'zmPositionCode', 'rmPositionCode', 'amPositionCode', 'empPositionCode', 'empPositionName', 'empLevel', 'employeeCode', 'employee', 'designation', 'fromOutletType', 'fromOutletCode', 'fromOutletName', 'fromOutletClassification', 'toOutletType', 'toOutletCode', 'toOutletName', 'toOutletClassification', 'productName', 'productSku', 'rate', 'qty', 'totalAmt', 'orderDate', 'empTerritory', 'empBranch', 'empTown', ],
        self::TYPE_COLNAME       => [ExportPobTableMap::COL_BU_NAME, ExportPobTableMap::COL_ZM_MANAGER_BRANCH, ExportPobTableMap::COL_ZM_MANAGER_TOWN, ExportPobTableMap::COL_RM_MANAGER_BRANCH, ExportPobTableMap::COL_RM_MANAGER_TOWN, ExportPobTableMap::COL_AM_MANAGER_BRANCH, ExportPobTableMap::COL_AM_MANAGER_TOWN, ExportPobTableMap::COL_ZM_POSITION_CODE, ExportPobTableMap::COL_RM_POSITION_CODE, ExportPobTableMap::COL_AM_POSITION_CODE, ExportPobTableMap::COL_EMP_POSITION_CODE, ExportPobTableMap::COL_EMP_POSITION_NAME, ExportPobTableMap::COL_EMP_LEVEL, ExportPobTableMap::COL_EMPLOYEE_CODE, ExportPobTableMap::COL_EMPLOYEE, ExportPobTableMap::COL_DESIGNATION, ExportPobTableMap::COL_FROM_OUTLET_TYPE, ExportPobTableMap::COL_FROM_OUTLET_CODE, ExportPobTableMap::COL_FROM_OUTLET_NAME, ExportPobTableMap::COL_FROM_OUTLET_CLASSIFICATION, ExportPobTableMap::COL_TO_OUTLET_TYPE, ExportPobTableMap::COL_TO_OUTLET_CODE, ExportPobTableMap::COL_TO_OUTLET_NAME, ExportPobTableMap::COL_TO_OUTLET_CLASSIFICATION, ExportPobTableMap::COL_PRODUCT_NAME, ExportPobTableMap::COL_PRODUCT_SKU, ExportPobTableMap::COL_RATE, ExportPobTableMap::COL_QTY, ExportPobTableMap::COL_TOTAL_AMT, ExportPobTableMap::COL_ORDER_DATE, ExportPobTableMap::COL_EMP_TERRITORY, ExportPobTableMap::COL_EMP_BRANCH, ExportPobTableMap::COL_EMP_TOWN, ],
        self::TYPE_FIELDNAME     => ['bu_name', 'zm_manager_branch', 'zm_manager_town', 'rm_manager_branch', 'rm_manager_town', 'am_manager_branch', 'am_manager_town', 'zm_position_code', 'rm_position_code', 'am_position_code', 'emp_position_code', 'emp_position_name', 'emp_level', 'employee_code', 'employee', 'designation', 'from_outlet_type', 'from_outlet_code', 'from_outlet_name', 'from_outlet_classification', 'to_outlet_type', 'to_outlet_code', 'to_outlet_name', 'to_outlet_classification', 'product_name', 'product_sku', 'rate', 'qty', 'total_amt', 'order_date', 'emp_territory', 'emp_branch', 'emp_town', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, ]
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
        self::TYPE_PHPNAME       => ['BuName' => 0, 'ZmManagerBranch' => 1, 'ZmManagerTown' => 2, 'RmManagerBranch' => 3, 'RmManagerTown' => 4, 'AmManagerBranch' => 5, 'AmManagerTown' => 6, 'ZmPositionCode' => 7, 'RmPositionCode' => 8, 'AmPositionCode' => 9, 'EmpPositionCode' => 10, 'EmpPositionName' => 11, 'EmpLevel' => 12, 'EmployeeCode' => 13, 'Employee' => 14, 'Designation' => 15, 'FromOutletType' => 16, 'FromOutletCode' => 17, 'FromOutletName' => 18, 'FromOutletClassification' => 19, 'ToOutletType' => 20, 'ToOutletCode' => 21, 'ToOutletName' => 22, 'ToOutletClassification' => 23, 'ProductName' => 24, 'ProductSku' => 25, 'Rate' => 26, 'Qty' => 27, 'TotalAmt' => 28, 'OrderDate' => 29, 'EmpTerritory' => 30, 'EmpBranch' => 31, 'EmpTown' => 32, ],
        self::TYPE_CAMELNAME     => ['buName' => 0, 'zmManagerBranch' => 1, 'zmManagerTown' => 2, 'rmManagerBranch' => 3, 'rmManagerTown' => 4, 'amManagerBranch' => 5, 'amManagerTown' => 6, 'zmPositionCode' => 7, 'rmPositionCode' => 8, 'amPositionCode' => 9, 'empPositionCode' => 10, 'empPositionName' => 11, 'empLevel' => 12, 'employeeCode' => 13, 'employee' => 14, 'designation' => 15, 'fromOutletType' => 16, 'fromOutletCode' => 17, 'fromOutletName' => 18, 'fromOutletClassification' => 19, 'toOutletType' => 20, 'toOutletCode' => 21, 'toOutletName' => 22, 'toOutletClassification' => 23, 'productName' => 24, 'productSku' => 25, 'rate' => 26, 'qty' => 27, 'totalAmt' => 28, 'orderDate' => 29, 'empTerritory' => 30, 'empBranch' => 31, 'empTown' => 32, ],
        self::TYPE_COLNAME       => [ExportPobTableMap::COL_BU_NAME => 0, ExportPobTableMap::COL_ZM_MANAGER_BRANCH => 1, ExportPobTableMap::COL_ZM_MANAGER_TOWN => 2, ExportPobTableMap::COL_RM_MANAGER_BRANCH => 3, ExportPobTableMap::COL_RM_MANAGER_TOWN => 4, ExportPobTableMap::COL_AM_MANAGER_BRANCH => 5, ExportPobTableMap::COL_AM_MANAGER_TOWN => 6, ExportPobTableMap::COL_ZM_POSITION_CODE => 7, ExportPobTableMap::COL_RM_POSITION_CODE => 8, ExportPobTableMap::COL_AM_POSITION_CODE => 9, ExportPobTableMap::COL_EMP_POSITION_CODE => 10, ExportPobTableMap::COL_EMP_POSITION_NAME => 11, ExportPobTableMap::COL_EMP_LEVEL => 12, ExportPobTableMap::COL_EMPLOYEE_CODE => 13, ExportPobTableMap::COL_EMPLOYEE => 14, ExportPobTableMap::COL_DESIGNATION => 15, ExportPobTableMap::COL_FROM_OUTLET_TYPE => 16, ExportPobTableMap::COL_FROM_OUTLET_CODE => 17, ExportPobTableMap::COL_FROM_OUTLET_NAME => 18, ExportPobTableMap::COL_FROM_OUTLET_CLASSIFICATION => 19, ExportPobTableMap::COL_TO_OUTLET_TYPE => 20, ExportPobTableMap::COL_TO_OUTLET_CODE => 21, ExportPobTableMap::COL_TO_OUTLET_NAME => 22, ExportPobTableMap::COL_TO_OUTLET_CLASSIFICATION => 23, ExportPobTableMap::COL_PRODUCT_NAME => 24, ExportPobTableMap::COL_PRODUCT_SKU => 25, ExportPobTableMap::COL_RATE => 26, ExportPobTableMap::COL_QTY => 27, ExportPobTableMap::COL_TOTAL_AMT => 28, ExportPobTableMap::COL_ORDER_DATE => 29, ExportPobTableMap::COL_EMP_TERRITORY => 30, ExportPobTableMap::COL_EMP_BRANCH => 31, ExportPobTableMap::COL_EMP_TOWN => 32, ],
        self::TYPE_FIELDNAME     => ['bu_name' => 0, 'zm_manager_branch' => 1, 'zm_manager_town' => 2, 'rm_manager_branch' => 3, 'rm_manager_town' => 4, 'am_manager_branch' => 5, 'am_manager_town' => 6, 'zm_position_code' => 7, 'rm_position_code' => 8, 'am_position_code' => 9, 'emp_position_code' => 10, 'emp_position_name' => 11, 'emp_level' => 12, 'employee_code' => 13, 'employee' => 14, 'designation' => 15, 'from_outlet_type' => 16, 'from_outlet_code' => 17, 'from_outlet_name' => 18, 'from_outlet_classification' => 19, 'to_outlet_type' => 20, 'to_outlet_code' => 21, 'to_outlet_name' => 22, 'to_outlet_classification' => 23, 'product_name' => 24, 'product_sku' => 25, 'rate' => 26, 'qty' => 27, 'total_amt' => 28, 'order_date' => 29, 'emp_territory' => 30, 'emp_branch' => 31, 'emp_town' => 32, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'BuName' => 'BU_NAME',
        'ExportPob.BuName' => 'BU_NAME',
        'buName' => 'BU_NAME',
        'exportPob.buName' => 'BU_NAME',
        'ExportPobTableMap::COL_BU_NAME' => 'BU_NAME',
        'COL_BU_NAME' => 'BU_NAME',
        'bu_name' => 'BU_NAME',
        'export_pob.bu_name' => 'BU_NAME',
        'ZmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'ExportPob.ZmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'zmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'exportPob.zmManagerBranch' => 'ZM_MANAGER_BRANCH',
        'ExportPobTableMap::COL_ZM_MANAGER_BRANCH' => 'ZM_MANAGER_BRANCH',
        'COL_ZM_MANAGER_BRANCH' => 'ZM_MANAGER_BRANCH',
        'zm_manager_branch' => 'ZM_MANAGER_BRANCH',
        'export_pob.zm_manager_branch' => 'ZM_MANAGER_BRANCH',
        'ZmManagerTown' => 'ZM_MANAGER_TOWN',
        'ExportPob.ZmManagerTown' => 'ZM_MANAGER_TOWN',
        'zmManagerTown' => 'ZM_MANAGER_TOWN',
        'exportPob.zmManagerTown' => 'ZM_MANAGER_TOWN',
        'ExportPobTableMap::COL_ZM_MANAGER_TOWN' => 'ZM_MANAGER_TOWN',
        'COL_ZM_MANAGER_TOWN' => 'ZM_MANAGER_TOWN',
        'zm_manager_town' => 'ZM_MANAGER_TOWN',
        'export_pob.zm_manager_town' => 'ZM_MANAGER_TOWN',
        'RmManagerBranch' => 'RM_MANAGER_BRANCH',
        'ExportPob.RmManagerBranch' => 'RM_MANAGER_BRANCH',
        'rmManagerBranch' => 'RM_MANAGER_BRANCH',
        'exportPob.rmManagerBranch' => 'RM_MANAGER_BRANCH',
        'ExportPobTableMap::COL_RM_MANAGER_BRANCH' => 'RM_MANAGER_BRANCH',
        'COL_RM_MANAGER_BRANCH' => 'RM_MANAGER_BRANCH',
        'rm_manager_branch' => 'RM_MANAGER_BRANCH',
        'export_pob.rm_manager_branch' => 'RM_MANAGER_BRANCH',
        'RmManagerTown' => 'RM_MANAGER_TOWN',
        'ExportPob.RmManagerTown' => 'RM_MANAGER_TOWN',
        'rmManagerTown' => 'RM_MANAGER_TOWN',
        'exportPob.rmManagerTown' => 'RM_MANAGER_TOWN',
        'ExportPobTableMap::COL_RM_MANAGER_TOWN' => 'RM_MANAGER_TOWN',
        'COL_RM_MANAGER_TOWN' => 'RM_MANAGER_TOWN',
        'rm_manager_town' => 'RM_MANAGER_TOWN',
        'export_pob.rm_manager_town' => 'RM_MANAGER_TOWN',
        'AmManagerBranch' => 'AM_MANAGER_BRANCH',
        'ExportPob.AmManagerBranch' => 'AM_MANAGER_BRANCH',
        'amManagerBranch' => 'AM_MANAGER_BRANCH',
        'exportPob.amManagerBranch' => 'AM_MANAGER_BRANCH',
        'ExportPobTableMap::COL_AM_MANAGER_BRANCH' => 'AM_MANAGER_BRANCH',
        'COL_AM_MANAGER_BRANCH' => 'AM_MANAGER_BRANCH',
        'am_manager_branch' => 'AM_MANAGER_BRANCH',
        'export_pob.am_manager_branch' => 'AM_MANAGER_BRANCH',
        'AmManagerTown' => 'AM_MANAGER_TOWN',
        'ExportPob.AmManagerTown' => 'AM_MANAGER_TOWN',
        'amManagerTown' => 'AM_MANAGER_TOWN',
        'exportPob.amManagerTown' => 'AM_MANAGER_TOWN',
        'ExportPobTableMap::COL_AM_MANAGER_TOWN' => 'AM_MANAGER_TOWN',
        'COL_AM_MANAGER_TOWN' => 'AM_MANAGER_TOWN',
        'am_manager_town' => 'AM_MANAGER_TOWN',
        'export_pob.am_manager_town' => 'AM_MANAGER_TOWN',
        'ZmPositionCode' => 'ZM_POSITION_CODE',
        'ExportPob.ZmPositionCode' => 'ZM_POSITION_CODE',
        'zmPositionCode' => 'ZM_POSITION_CODE',
        'exportPob.zmPositionCode' => 'ZM_POSITION_CODE',
        'ExportPobTableMap::COL_ZM_POSITION_CODE' => 'ZM_POSITION_CODE',
        'COL_ZM_POSITION_CODE' => 'ZM_POSITION_CODE',
        'zm_position_code' => 'ZM_POSITION_CODE',
        'export_pob.zm_position_code' => 'ZM_POSITION_CODE',
        'RmPositionCode' => 'RM_POSITION_CODE',
        'ExportPob.RmPositionCode' => 'RM_POSITION_CODE',
        'rmPositionCode' => 'RM_POSITION_CODE',
        'exportPob.rmPositionCode' => 'RM_POSITION_CODE',
        'ExportPobTableMap::COL_RM_POSITION_CODE' => 'RM_POSITION_CODE',
        'COL_RM_POSITION_CODE' => 'RM_POSITION_CODE',
        'rm_position_code' => 'RM_POSITION_CODE',
        'export_pob.rm_position_code' => 'RM_POSITION_CODE',
        'AmPositionCode' => 'AM_POSITION_CODE',
        'ExportPob.AmPositionCode' => 'AM_POSITION_CODE',
        'amPositionCode' => 'AM_POSITION_CODE',
        'exportPob.amPositionCode' => 'AM_POSITION_CODE',
        'ExportPobTableMap::COL_AM_POSITION_CODE' => 'AM_POSITION_CODE',
        'COL_AM_POSITION_CODE' => 'AM_POSITION_CODE',
        'am_position_code' => 'AM_POSITION_CODE',
        'export_pob.am_position_code' => 'AM_POSITION_CODE',
        'EmpPositionCode' => 'EMP_POSITION_CODE',
        'ExportPob.EmpPositionCode' => 'EMP_POSITION_CODE',
        'empPositionCode' => 'EMP_POSITION_CODE',
        'exportPob.empPositionCode' => 'EMP_POSITION_CODE',
        'ExportPobTableMap::COL_EMP_POSITION_CODE' => 'EMP_POSITION_CODE',
        'COL_EMP_POSITION_CODE' => 'EMP_POSITION_CODE',
        'emp_position_code' => 'EMP_POSITION_CODE',
        'export_pob.emp_position_code' => 'EMP_POSITION_CODE',
        'EmpPositionName' => 'EMP_POSITION_NAME',
        'ExportPob.EmpPositionName' => 'EMP_POSITION_NAME',
        'empPositionName' => 'EMP_POSITION_NAME',
        'exportPob.empPositionName' => 'EMP_POSITION_NAME',
        'ExportPobTableMap::COL_EMP_POSITION_NAME' => 'EMP_POSITION_NAME',
        'COL_EMP_POSITION_NAME' => 'EMP_POSITION_NAME',
        'emp_position_name' => 'EMP_POSITION_NAME',
        'export_pob.emp_position_name' => 'EMP_POSITION_NAME',
        'EmpLevel' => 'EMP_LEVEL',
        'ExportPob.EmpLevel' => 'EMP_LEVEL',
        'empLevel' => 'EMP_LEVEL',
        'exportPob.empLevel' => 'EMP_LEVEL',
        'ExportPobTableMap::COL_EMP_LEVEL' => 'EMP_LEVEL',
        'COL_EMP_LEVEL' => 'EMP_LEVEL',
        'emp_level' => 'EMP_LEVEL',
        'export_pob.emp_level' => 'EMP_LEVEL',
        'EmployeeCode' => 'EMPLOYEE_CODE',
        'ExportPob.EmployeeCode' => 'EMPLOYEE_CODE',
        'employeeCode' => 'EMPLOYEE_CODE',
        'exportPob.employeeCode' => 'EMPLOYEE_CODE',
        'ExportPobTableMap::COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'employee_code' => 'EMPLOYEE_CODE',
        'export_pob.employee_code' => 'EMPLOYEE_CODE',
        'Employee' => 'EMPLOYEE',
        'ExportPob.Employee' => 'EMPLOYEE',
        'employee' => 'EMPLOYEE',
        'exportPob.employee' => 'EMPLOYEE',
        'ExportPobTableMap::COL_EMPLOYEE' => 'EMPLOYEE',
        'COL_EMPLOYEE' => 'EMPLOYEE',
        'export_pob.employee' => 'EMPLOYEE',
        'Designation' => 'DESIGNATION',
        'ExportPob.Designation' => 'DESIGNATION',
        'designation' => 'DESIGNATION',
        'exportPob.designation' => 'DESIGNATION',
        'ExportPobTableMap::COL_DESIGNATION' => 'DESIGNATION',
        'COL_DESIGNATION' => 'DESIGNATION',
        'export_pob.designation' => 'DESIGNATION',
        'FromOutletType' => 'FROM_OUTLET_TYPE',
        'ExportPob.FromOutletType' => 'FROM_OUTLET_TYPE',
        'fromOutletType' => 'FROM_OUTLET_TYPE',
        'exportPob.fromOutletType' => 'FROM_OUTLET_TYPE',
        'ExportPobTableMap::COL_FROM_OUTLET_TYPE' => 'FROM_OUTLET_TYPE',
        'COL_FROM_OUTLET_TYPE' => 'FROM_OUTLET_TYPE',
        'from_outlet_type' => 'FROM_OUTLET_TYPE',
        'export_pob.from_outlet_type' => 'FROM_OUTLET_TYPE',
        'FromOutletCode' => 'FROM_OUTLET_CODE',
        'ExportPob.FromOutletCode' => 'FROM_OUTLET_CODE',
        'fromOutletCode' => 'FROM_OUTLET_CODE',
        'exportPob.fromOutletCode' => 'FROM_OUTLET_CODE',
        'ExportPobTableMap::COL_FROM_OUTLET_CODE' => 'FROM_OUTLET_CODE',
        'COL_FROM_OUTLET_CODE' => 'FROM_OUTLET_CODE',
        'from_outlet_code' => 'FROM_OUTLET_CODE',
        'export_pob.from_outlet_code' => 'FROM_OUTLET_CODE',
        'FromOutletName' => 'FROM_OUTLET_NAME',
        'ExportPob.FromOutletName' => 'FROM_OUTLET_NAME',
        'fromOutletName' => 'FROM_OUTLET_NAME',
        'exportPob.fromOutletName' => 'FROM_OUTLET_NAME',
        'ExportPobTableMap::COL_FROM_OUTLET_NAME' => 'FROM_OUTLET_NAME',
        'COL_FROM_OUTLET_NAME' => 'FROM_OUTLET_NAME',
        'from_outlet_name' => 'FROM_OUTLET_NAME',
        'export_pob.from_outlet_name' => 'FROM_OUTLET_NAME',
        'FromOutletClassification' => 'FROM_OUTLET_CLASSIFICATION',
        'ExportPob.FromOutletClassification' => 'FROM_OUTLET_CLASSIFICATION',
        'fromOutletClassification' => 'FROM_OUTLET_CLASSIFICATION',
        'exportPob.fromOutletClassification' => 'FROM_OUTLET_CLASSIFICATION',
        'ExportPobTableMap::COL_FROM_OUTLET_CLASSIFICATION' => 'FROM_OUTLET_CLASSIFICATION',
        'COL_FROM_OUTLET_CLASSIFICATION' => 'FROM_OUTLET_CLASSIFICATION',
        'from_outlet_classification' => 'FROM_OUTLET_CLASSIFICATION',
        'export_pob.from_outlet_classification' => 'FROM_OUTLET_CLASSIFICATION',
        'ToOutletType' => 'TO_OUTLET_TYPE',
        'ExportPob.ToOutletType' => 'TO_OUTLET_TYPE',
        'toOutletType' => 'TO_OUTLET_TYPE',
        'exportPob.toOutletType' => 'TO_OUTLET_TYPE',
        'ExportPobTableMap::COL_TO_OUTLET_TYPE' => 'TO_OUTLET_TYPE',
        'COL_TO_OUTLET_TYPE' => 'TO_OUTLET_TYPE',
        'to_outlet_type' => 'TO_OUTLET_TYPE',
        'export_pob.to_outlet_type' => 'TO_OUTLET_TYPE',
        'ToOutletCode' => 'TO_OUTLET_CODE',
        'ExportPob.ToOutletCode' => 'TO_OUTLET_CODE',
        'toOutletCode' => 'TO_OUTLET_CODE',
        'exportPob.toOutletCode' => 'TO_OUTLET_CODE',
        'ExportPobTableMap::COL_TO_OUTLET_CODE' => 'TO_OUTLET_CODE',
        'COL_TO_OUTLET_CODE' => 'TO_OUTLET_CODE',
        'to_outlet_code' => 'TO_OUTLET_CODE',
        'export_pob.to_outlet_code' => 'TO_OUTLET_CODE',
        'ToOutletName' => 'TO_OUTLET_NAME',
        'ExportPob.ToOutletName' => 'TO_OUTLET_NAME',
        'toOutletName' => 'TO_OUTLET_NAME',
        'exportPob.toOutletName' => 'TO_OUTLET_NAME',
        'ExportPobTableMap::COL_TO_OUTLET_NAME' => 'TO_OUTLET_NAME',
        'COL_TO_OUTLET_NAME' => 'TO_OUTLET_NAME',
        'to_outlet_name' => 'TO_OUTLET_NAME',
        'export_pob.to_outlet_name' => 'TO_OUTLET_NAME',
        'ToOutletClassification' => 'TO_OUTLET_CLASSIFICATION',
        'ExportPob.ToOutletClassification' => 'TO_OUTLET_CLASSIFICATION',
        'toOutletClassification' => 'TO_OUTLET_CLASSIFICATION',
        'exportPob.toOutletClassification' => 'TO_OUTLET_CLASSIFICATION',
        'ExportPobTableMap::COL_TO_OUTLET_CLASSIFICATION' => 'TO_OUTLET_CLASSIFICATION',
        'COL_TO_OUTLET_CLASSIFICATION' => 'TO_OUTLET_CLASSIFICATION',
        'to_outlet_classification' => 'TO_OUTLET_CLASSIFICATION',
        'export_pob.to_outlet_classification' => 'TO_OUTLET_CLASSIFICATION',
        'ProductName' => 'PRODUCT_NAME',
        'ExportPob.ProductName' => 'PRODUCT_NAME',
        'productName' => 'PRODUCT_NAME',
        'exportPob.productName' => 'PRODUCT_NAME',
        'ExportPobTableMap::COL_PRODUCT_NAME' => 'PRODUCT_NAME',
        'COL_PRODUCT_NAME' => 'PRODUCT_NAME',
        'product_name' => 'PRODUCT_NAME',
        'export_pob.product_name' => 'PRODUCT_NAME',
        'ProductSku' => 'PRODUCT_SKU',
        'ExportPob.ProductSku' => 'PRODUCT_SKU',
        'productSku' => 'PRODUCT_SKU',
        'exportPob.productSku' => 'PRODUCT_SKU',
        'ExportPobTableMap::COL_PRODUCT_SKU' => 'PRODUCT_SKU',
        'COL_PRODUCT_SKU' => 'PRODUCT_SKU',
        'product_sku' => 'PRODUCT_SKU',
        'export_pob.product_sku' => 'PRODUCT_SKU',
        'Rate' => 'RATE',
        'ExportPob.Rate' => 'RATE',
        'rate' => 'RATE',
        'exportPob.rate' => 'RATE',
        'ExportPobTableMap::COL_RATE' => 'RATE',
        'COL_RATE' => 'RATE',
        'export_pob.rate' => 'RATE',
        'Qty' => 'QTY',
        'ExportPob.Qty' => 'QTY',
        'qty' => 'QTY',
        'exportPob.qty' => 'QTY',
        'ExportPobTableMap::COL_QTY' => 'QTY',
        'COL_QTY' => 'QTY',
        'export_pob.qty' => 'QTY',
        'TotalAmt' => 'TOTAL_AMT',
        'ExportPob.TotalAmt' => 'TOTAL_AMT',
        'totalAmt' => 'TOTAL_AMT',
        'exportPob.totalAmt' => 'TOTAL_AMT',
        'ExportPobTableMap::COL_TOTAL_AMT' => 'TOTAL_AMT',
        'COL_TOTAL_AMT' => 'TOTAL_AMT',
        'total_amt' => 'TOTAL_AMT',
        'export_pob.total_amt' => 'TOTAL_AMT',
        'OrderDate' => 'ORDER_DATE',
        'ExportPob.OrderDate' => 'ORDER_DATE',
        'orderDate' => 'ORDER_DATE',
        'exportPob.orderDate' => 'ORDER_DATE',
        'ExportPobTableMap::COL_ORDER_DATE' => 'ORDER_DATE',
        'COL_ORDER_DATE' => 'ORDER_DATE',
        'order_date' => 'ORDER_DATE',
        'export_pob.order_date' => 'ORDER_DATE',
        'EmpTerritory' => 'EMP_TERRITORY',
        'ExportPob.EmpTerritory' => 'EMP_TERRITORY',
        'empTerritory' => 'EMP_TERRITORY',
        'exportPob.empTerritory' => 'EMP_TERRITORY',
        'ExportPobTableMap::COL_EMP_TERRITORY' => 'EMP_TERRITORY',
        'COL_EMP_TERRITORY' => 'EMP_TERRITORY',
        'emp_territory' => 'EMP_TERRITORY',
        'export_pob.emp_territory' => 'EMP_TERRITORY',
        'EmpBranch' => 'EMP_BRANCH',
        'ExportPob.EmpBranch' => 'EMP_BRANCH',
        'empBranch' => 'EMP_BRANCH',
        'exportPob.empBranch' => 'EMP_BRANCH',
        'ExportPobTableMap::COL_EMP_BRANCH' => 'EMP_BRANCH',
        'COL_EMP_BRANCH' => 'EMP_BRANCH',
        'emp_branch' => 'EMP_BRANCH',
        'export_pob.emp_branch' => 'EMP_BRANCH',
        'EmpTown' => 'EMP_TOWN',
        'ExportPob.EmpTown' => 'EMP_TOWN',
        'empTown' => 'EMP_TOWN',
        'exportPob.empTown' => 'EMP_TOWN',
        'ExportPobTableMap::COL_EMP_TOWN' => 'EMP_TOWN',
        'COL_EMP_TOWN' => 'EMP_TOWN',
        'emp_town' => 'EMP_TOWN',
        'export_pob.emp_town' => 'EMP_TOWN',
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
        $this->setName('export_pob');
        $this->setPhpName('ExportPob');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\ExportPob');
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
        $this->addColumn('designation', 'Designation', 'VARCHAR', false, 255, null);
        $this->addColumn('from_outlet_type', 'FromOutletType', 'VARCHAR', false, 255, null);
        $this->addColumn('from_outlet_code', 'FromOutletCode', 'VARCHAR', false, 255, null);
        $this->addColumn('from_outlet_name', 'FromOutletName', 'VARCHAR', false, 255, null);
        $this->addColumn('from_outlet_classification', 'FromOutletClassification', 'VARCHAR', false, 255, null);
        $this->addColumn('to_outlet_type', 'ToOutletType', 'VARCHAR', false, 255, null);
        $this->addColumn('to_outlet_code', 'ToOutletCode', 'VARCHAR', false, 255, null);
        $this->addColumn('to_outlet_name', 'ToOutletName', 'VARCHAR', false, 255, null);
        $this->addColumn('to_outlet_classification', 'ToOutletClassification', 'VARCHAR', false, 255, null);
        $this->addColumn('product_name', 'ProductName', 'VARCHAR', false, 255, null);
        $this->addColumn('product_sku', 'ProductSku', 'VARCHAR', false, 255, null);
        $this->addColumn('rate', 'Rate', 'DECIMAL', false, null, null);
        $this->addColumn('qty', 'Qty', 'INTEGER', false, null, null);
        $this->addColumn('total_amt', 'TotalAmt', 'DECIMAL', false, null, null);
        $this->addColumn('order_date', 'OrderDate', 'DATE', false, null, null);
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
        return $withPrefix ? ExportPobTableMap::CLASS_DEFAULT : ExportPobTableMap::OM_CLASS;
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
     * @return array (ExportPob object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ExportPobTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ExportPobTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ExportPobTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ExportPobTableMap::OM_CLASS;
            /** @var ExportPob $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ExportPobTableMap::addInstanceToPool($obj, $key);
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
            $key = ExportPobTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ExportPobTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ExportPob $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ExportPobTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ExportPobTableMap::COL_BU_NAME);
            $criteria->addSelectColumn(ExportPobTableMap::COL_ZM_MANAGER_BRANCH);
            $criteria->addSelectColumn(ExportPobTableMap::COL_ZM_MANAGER_TOWN);
            $criteria->addSelectColumn(ExportPobTableMap::COL_RM_MANAGER_BRANCH);
            $criteria->addSelectColumn(ExportPobTableMap::COL_RM_MANAGER_TOWN);
            $criteria->addSelectColumn(ExportPobTableMap::COL_AM_MANAGER_BRANCH);
            $criteria->addSelectColumn(ExportPobTableMap::COL_AM_MANAGER_TOWN);
            $criteria->addSelectColumn(ExportPobTableMap::COL_ZM_POSITION_CODE);
            $criteria->addSelectColumn(ExportPobTableMap::COL_RM_POSITION_CODE);
            $criteria->addSelectColumn(ExportPobTableMap::COL_AM_POSITION_CODE);
            $criteria->addSelectColumn(ExportPobTableMap::COL_EMP_POSITION_CODE);
            $criteria->addSelectColumn(ExportPobTableMap::COL_EMP_POSITION_NAME);
            $criteria->addSelectColumn(ExportPobTableMap::COL_EMP_LEVEL);
            $criteria->addSelectColumn(ExportPobTableMap::COL_EMPLOYEE_CODE);
            $criteria->addSelectColumn(ExportPobTableMap::COL_EMPLOYEE);
            $criteria->addSelectColumn(ExportPobTableMap::COL_DESIGNATION);
            $criteria->addSelectColumn(ExportPobTableMap::COL_FROM_OUTLET_TYPE);
            $criteria->addSelectColumn(ExportPobTableMap::COL_FROM_OUTLET_CODE);
            $criteria->addSelectColumn(ExportPobTableMap::COL_FROM_OUTLET_NAME);
            $criteria->addSelectColumn(ExportPobTableMap::COL_FROM_OUTLET_CLASSIFICATION);
            $criteria->addSelectColumn(ExportPobTableMap::COL_TO_OUTLET_TYPE);
            $criteria->addSelectColumn(ExportPobTableMap::COL_TO_OUTLET_CODE);
            $criteria->addSelectColumn(ExportPobTableMap::COL_TO_OUTLET_NAME);
            $criteria->addSelectColumn(ExportPobTableMap::COL_TO_OUTLET_CLASSIFICATION);
            $criteria->addSelectColumn(ExportPobTableMap::COL_PRODUCT_NAME);
            $criteria->addSelectColumn(ExportPobTableMap::COL_PRODUCT_SKU);
            $criteria->addSelectColumn(ExportPobTableMap::COL_RATE);
            $criteria->addSelectColumn(ExportPobTableMap::COL_QTY);
            $criteria->addSelectColumn(ExportPobTableMap::COL_TOTAL_AMT);
            $criteria->addSelectColumn(ExportPobTableMap::COL_ORDER_DATE);
            $criteria->addSelectColumn(ExportPobTableMap::COL_EMP_TERRITORY);
            $criteria->addSelectColumn(ExportPobTableMap::COL_EMP_BRANCH);
            $criteria->addSelectColumn(ExportPobTableMap::COL_EMP_TOWN);
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
            $criteria->addSelectColumn($alias . '.designation');
            $criteria->addSelectColumn($alias . '.from_outlet_type');
            $criteria->addSelectColumn($alias . '.from_outlet_code');
            $criteria->addSelectColumn($alias . '.from_outlet_name');
            $criteria->addSelectColumn($alias . '.from_outlet_classification');
            $criteria->addSelectColumn($alias . '.to_outlet_type');
            $criteria->addSelectColumn($alias . '.to_outlet_code');
            $criteria->addSelectColumn($alias . '.to_outlet_name');
            $criteria->addSelectColumn($alias . '.to_outlet_classification');
            $criteria->addSelectColumn($alias . '.product_name');
            $criteria->addSelectColumn($alias . '.product_sku');
            $criteria->addSelectColumn($alias . '.rate');
            $criteria->addSelectColumn($alias . '.qty');
            $criteria->addSelectColumn($alias . '.total_amt');
            $criteria->addSelectColumn($alias . '.order_date');
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
            $criteria->removeSelectColumn(ExportPobTableMap::COL_BU_NAME);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_ZM_MANAGER_BRANCH);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_ZM_MANAGER_TOWN);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_RM_MANAGER_BRANCH);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_RM_MANAGER_TOWN);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_AM_MANAGER_BRANCH);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_AM_MANAGER_TOWN);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_ZM_POSITION_CODE);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_RM_POSITION_CODE);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_AM_POSITION_CODE);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_EMP_POSITION_CODE);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_EMP_POSITION_NAME);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_EMP_LEVEL);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_EMPLOYEE_CODE);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_EMPLOYEE);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_DESIGNATION);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_FROM_OUTLET_TYPE);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_FROM_OUTLET_CODE);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_FROM_OUTLET_NAME);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_FROM_OUTLET_CLASSIFICATION);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_TO_OUTLET_TYPE);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_TO_OUTLET_CODE);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_TO_OUTLET_NAME);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_TO_OUTLET_CLASSIFICATION);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_PRODUCT_NAME);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_PRODUCT_SKU);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_RATE);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_QTY);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_TOTAL_AMT);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_ORDER_DATE);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_EMP_TERRITORY);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_EMP_BRANCH);
            $criteria->removeSelectColumn(ExportPobTableMap::COL_EMP_TOWN);
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
            $criteria->removeSelectColumn($alias . '.designation');
            $criteria->removeSelectColumn($alias . '.from_outlet_type');
            $criteria->removeSelectColumn($alias . '.from_outlet_code');
            $criteria->removeSelectColumn($alias . '.from_outlet_name');
            $criteria->removeSelectColumn($alias . '.from_outlet_classification');
            $criteria->removeSelectColumn($alias . '.to_outlet_type');
            $criteria->removeSelectColumn($alias . '.to_outlet_code');
            $criteria->removeSelectColumn($alias . '.to_outlet_name');
            $criteria->removeSelectColumn($alias . '.to_outlet_classification');
            $criteria->removeSelectColumn($alias . '.product_name');
            $criteria->removeSelectColumn($alias . '.product_sku');
            $criteria->removeSelectColumn($alias . '.rate');
            $criteria->removeSelectColumn($alias . '.qty');
            $criteria->removeSelectColumn($alias . '.total_amt');
            $criteria->removeSelectColumn($alias . '.order_date');
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
        return Propel::getServiceContainer()->getDatabaseMap(ExportPobTableMap::DATABASE_NAME)->getTable(ExportPobTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a ExportPob or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or ExportPob object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ExportPobTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\ExportPob) { // it's a model object
            // create criteria based on pk value
            $criteria = $values->buildCriteria();
        } else { // it's a primary key, or an array of pks
            throw new LogicException('The ExportPob object has no primary key');
        }

        $query = ExportPobQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ExportPobTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ExportPobTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the export_pob table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ExportPobQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ExportPob or Criteria object.
     *
     * @param mixed $criteria Criteria or ExportPob object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExportPobTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ExportPob object
        }


        // Set the correct dbName
        $query = ExportPobQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
