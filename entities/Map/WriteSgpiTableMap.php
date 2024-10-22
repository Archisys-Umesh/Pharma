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
use entities\WriteSgpi;
use entities\WriteSgpiQuery;


/**
 * This class defines the structure of the 'write_sgpi' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class WriteSgpiTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.WriteSgpiTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'write_sgpi';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'WriteSgpi';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\WriteSgpi';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.WriteSgpi';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 29;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 29;

    /**
     * the column name for the division field
     */
    public const COL_DIVISION = 'write_sgpi.division';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'write_sgpi.employee_id';

    /**
     * the column name for the employee_name field
     */
    public const COL_EMPLOYEE_NAME = 'write_sgpi.employee_name';

    /**
     * the column name for the location field
     */
    public const COL_LOCATION = 'write_sgpi.location';

    /**
     * the column name for the location_code field
     */
    public const COL_LOCATION_CODE = 'write_sgpi.location_code';

    /**
     * the column name for the dr_code field
     */
    public const COL_DR_CODE = 'write_sgpi.dr_code';

    /**
     * the column name for the dr_name field
     */
    public const COL_DR_NAME = 'write_sgpi.dr_name';

    /**
     * the column name for the dr_specialty field
     */
    public const COL_DR_SPECIALTY = 'write_sgpi.dr_specialty';

    /**
     * the column name for the month field
     */
    public const COL_MONTH = 'write_sgpi.month';

    /**
     * the column name for the dr_tags field
     */
    public const COL_DR_TAGS = 'write_sgpi.dr_tags';

    /**
     * the column name for the brand field
     */
    public const COL_BRAND = 'write_sgpi.brand';

    /**
     * the column name for the sgpi_tagged field
     */
    public const COL_SGPI_TAGGED = 'write_sgpi.sgpi_tagged';

    /**
     * the column name for the brand_sgpi_distributed field
     */
    public const COL_BRAND_SGPI_DISTRIBUTED = 'write_sgpi.brand_sgpi_distributed';

    /**
     * the column name for the mr_call_done field
     */
    public const COL_MR_CALL_DONE = 'write_sgpi.mr_call_done';

    /**
     * the column name for the am_call_done field
     */
    public const COL_AM_CALL_DONE = 'write_sgpi.am_call_done';

    /**
     * the column name for the rm_call_done field
     */
    public const COL_RM_CALL_DONE = 'write_sgpi.rm_call_done';

    /**
     * the column name for the zm_call_done field
     */
    public const COL_ZM_CALL_DONE = 'write_sgpi.zm_call_done';

    /**
     * the column name for the zm_position field
     */
    public const COL_ZM_POSITION = 'write_sgpi.zm_position';

    /**
     * the column name for the rm_position field
     */
    public const COL_RM_POSITION = 'write_sgpi.rm_position';

    /**
     * the column name for the am_position field
     */
    public const COL_AM_POSITION = 'write_sgpi.am_position';

    /**
     * the column name for the zm_position_code field
     */
    public const COL_ZM_POSITION_CODE = 'write_sgpi.zm_position_code';

    /**
     * the column name for the rm_position_code field
     */
    public const COL_RM_POSITION_CODE = 'write_sgpi.rm_position_code';

    /**
     * the column name for the am_position_code field
     */
    public const COL_AM_POSITION_CODE = 'write_sgpi.am_position_code';

    /**
     * the column name for the employee_position_code field
     */
    public const COL_EMPLOYEE_POSITION_CODE = 'write_sgpi.employee_position_code';

    /**
     * the column name for the employee_position_name field
     */
    public const COL_EMPLOYEE_POSITION_NAME = 'write_sgpi.employee_position_name';

    /**
     * the column name for the employee_level field
     */
    public const COL_EMPLOYEE_LEVEL = 'write_sgpi.employee_level';

    /**
     * the column name for the sgpi_report_id field
     */
    public const COL_SGPI_REPORT_ID = 'write_sgpi.sgpi_report_id';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'write_sgpi.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'write_sgpi.updated_at';

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
        self::TYPE_PHPNAME       => ['Division', 'EmployeeId', 'EmployeeName', 'Location', 'LocationCode', 'DrCode', 'DrName', 'DrSpecialty', 'Month', 'DrTags', 'Brand', 'SgpiTagged', 'BrandSgpiDistributed', 'MrCallDone', 'AmCallDone', 'RmCallDone', 'ZmCallDone', 'ZmPosition', 'RmPosition', 'AmPosition', 'ZmPositionCode', 'RmPositionCode', 'AmPositionCode', 'EmployeePositionCode', 'EmployeePositionName', 'EmployeeLevel', 'SgpiReportId', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['division', 'employeeId', 'employeeName', 'location', 'locationCode', 'drCode', 'drName', 'drSpecialty', 'month', 'drTags', 'brand', 'sgpiTagged', 'brandSgpiDistributed', 'mrCallDone', 'amCallDone', 'rmCallDone', 'zmCallDone', 'zmPosition', 'rmPosition', 'amPosition', 'zmPositionCode', 'rmPositionCode', 'amPositionCode', 'employeePositionCode', 'employeePositionName', 'employeeLevel', 'sgpiReportId', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [WriteSgpiTableMap::COL_DIVISION, WriteSgpiTableMap::COL_EMPLOYEE_ID, WriteSgpiTableMap::COL_EMPLOYEE_NAME, WriteSgpiTableMap::COL_LOCATION, WriteSgpiTableMap::COL_LOCATION_CODE, WriteSgpiTableMap::COL_DR_CODE, WriteSgpiTableMap::COL_DR_NAME, WriteSgpiTableMap::COL_DR_SPECIALTY, WriteSgpiTableMap::COL_MONTH, WriteSgpiTableMap::COL_DR_TAGS, WriteSgpiTableMap::COL_BRAND, WriteSgpiTableMap::COL_SGPI_TAGGED, WriteSgpiTableMap::COL_BRAND_SGPI_DISTRIBUTED, WriteSgpiTableMap::COL_MR_CALL_DONE, WriteSgpiTableMap::COL_AM_CALL_DONE, WriteSgpiTableMap::COL_RM_CALL_DONE, WriteSgpiTableMap::COL_ZM_CALL_DONE, WriteSgpiTableMap::COL_ZM_POSITION, WriteSgpiTableMap::COL_RM_POSITION, WriteSgpiTableMap::COL_AM_POSITION, WriteSgpiTableMap::COL_ZM_POSITION_CODE, WriteSgpiTableMap::COL_RM_POSITION_CODE, WriteSgpiTableMap::COL_AM_POSITION_CODE, WriteSgpiTableMap::COL_EMPLOYEE_POSITION_CODE, WriteSgpiTableMap::COL_EMPLOYEE_POSITION_NAME, WriteSgpiTableMap::COL_EMPLOYEE_LEVEL, WriteSgpiTableMap::COL_SGPI_REPORT_ID, WriteSgpiTableMap::COL_CREATED_AT, WriteSgpiTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['division', 'employee_id', 'employee_name', 'location', 'location_code', 'dr_code', 'dr_name', 'dr_specialty', 'month', 'dr_tags', 'brand', 'sgpi_tagged', 'brand_sgpi_distributed', 'mr_call_done', 'am_call_done', 'rm_call_done', 'zm_call_done', 'zm_position', 'rm_position', 'am_position', 'zm_position_code', 'rm_position_code', 'am_position_code', 'employee_position_code', 'employee_position_name', 'employee_level', 'sgpi_report_id', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, ]
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
        self::TYPE_PHPNAME       => ['Division' => 0, 'EmployeeId' => 1, 'EmployeeName' => 2, 'Location' => 3, 'LocationCode' => 4, 'DrCode' => 5, 'DrName' => 6, 'DrSpecialty' => 7, 'Month' => 8, 'DrTags' => 9, 'Brand' => 10, 'SgpiTagged' => 11, 'BrandSgpiDistributed' => 12, 'MrCallDone' => 13, 'AmCallDone' => 14, 'RmCallDone' => 15, 'ZmCallDone' => 16, 'ZmPosition' => 17, 'RmPosition' => 18, 'AmPosition' => 19, 'ZmPositionCode' => 20, 'RmPositionCode' => 21, 'AmPositionCode' => 22, 'EmployeePositionCode' => 23, 'EmployeePositionName' => 24, 'EmployeeLevel' => 25, 'SgpiReportId' => 26, 'CreatedAt' => 27, 'UpdatedAt' => 28, ],
        self::TYPE_CAMELNAME     => ['division' => 0, 'employeeId' => 1, 'employeeName' => 2, 'location' => 3, 'locationCode' => 4, 'drCode' => 5, 'drName' => 6, 'drSpecialty' => 7, 'month' => 8, 'drTags' => 9, 'brand' => 10, 'sgpiTagged' => 11, 'brandSgpiDistributed' => 12, 'mrCallDone' => 13, 'amCallDone' => 14, 'rmCallDone' => 15, 'zmCallDone' => 16, 'zmPosition' => 17, 'rmPosition' => 18, 'amPosition' => 19, 'zmPositionCode' => 20, 'rmPositionCode' => 21, 'amPositionCode' => 22, 'employeePositionCode' => 23, 'employeePositionName' => 24, 'employeeLevel' => 25, 'sgpiReportId' => 26, 'createdAt' => 27, 'updatedAt' => 28, ],
        self::TYPE_COLNAME       => [WriteSgpiTableMap::COL_DIVISION => 0, WriteSgpiTableMap::COL_EMPLOYEE_ID => 1, WriteSgpiTableMap::COL_EMPLOYEE_NAME => 2, WriteSgpiTableMap::COL_LOCATION => 3, WriteSgpiTableMap::COL_LOCATION_CODE => 4, WriteSgpiTableMap::COL_DR_CODE => 5, WriteSgpiTableMap::COL_DR_NAME => 6, WriteSgpiTableMap::COL_DR_SPECIALTY => 7, WriteSgpiTableMap::COL_MONTH => 8, WriteSgpiTableMap::COL_DR_TAGS => 9, WriteSgpiTableMap::COL_BRAND => 10, WriteSgpiTableMap::COL_SGPI_TAGGED => 11, WriteSgpiTableMap::COL_BRAND_SGPI_DISTRIBUTED => 12, WriteSgpiTableMap::COL_MR_CALL_DONE => 13, WriteSgpiTableMap::COL_AM_CALL_DONE => 14, WriteSgpiTableMap::COL_RM_CALL_DONE => 15, WriteSgpiTableMap::COL_ZM_CALL_DONE => 16, WriteSgpiTableMap::COL_ZM_POSITION => 17, WriteSgpiTableMap::COL_RM_POSITION => 18, WriteSgpiTableMap::COL_AM_POSITION => 19, WriteSgpiTableMap::COL_ZM_POSITION_CODE => 20, WriteSgpiTableMap::COL_RM_POSITION_CODE => 21, WriteSgpiTableMap::COL_AM_POSITION_CODE => 22, WriteSgpiTableMap::COL_EMPLOYEE_POSITION_CODE => 23, WriteSgpiTableMap::COL_EMPLOYEE_POSITION_NAME => 24, WriteSgpiTableMap::COL_EMPLOYEE_LEVEL => 25, WriteSgpiTableMap::COL_SGPI_REPORT_ID => 26, WriteSgpiTableMap::COL_CREATED_AT => 27, WriteSgpiTableMap::COL_UPDATED_AT => 28, ],
        self::TYPE_FIELDNAME     => ['division' => 0, 'employee_id' => 1, 'employee_name' => 2, 'location' => 3, 'location_code' => 4, 'dr_code' => 5, 'dr_name' => 6, 'dr_specialty' => 7, 'month' => 8, 'dr_tags' => 9, 'brand' => 10, 'sgpi_tagged' => 11, 'brand_sgpi_distributed' => 12, 'mr_call_done' => 13, 'am_call_done' => 14, 'rm_call_done' => 15, 'zm_call_done' => 16, 'zm_position' => 17, 'rm_position' => 18, 'am_position' => 19, 'zm_position_code' => 20, 'rm_position_code' => 21, 'am_position_code' => 22, 'employee_position_code' => 23, 'employee_position_name' => 24, 'employee_level' => 25, 'sgpi_report_id' => 26, 'created_at' => 27, 'updated_at' => 28, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Division' => 'DIVISION',
        'WriteSgpi.Division' => 'DIVISION',
        'division' => 'DIVISION',
        'writeSgpi.division' => 'DIVISION',
        'WriteSgpiTableMap::COL_DIVISION' => 'DIVISION',
        'COL_DIVISION' => 'DIVISION',
        'write_sgpi.division' => 'DIVISION',
        'EmployeeId' => 'EMPLOYEE_ID',
        'WriteSgpi.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'writeSgpi.employeeId' => 'EMPLOYEE_ID',
        'WriteSgpiTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'write_sgpi.employee_id' => 'EMPLOYEE_ID',
        'EmployeeName' => 'EMPLOYEE_NAME',
        'WriteSgpi.EmployeeName' => 'EMPLOYEE_NAME',
        'employeeName' => 'EMPLOYEE_NAME',
        'writeSgpi.employeeName' => 'EMPLOYEE_NAME',
        'WriteSgpiTableMap::COL_EMPLOYEE_NAME' => 'EMPLOYEE_NAME',
        'COL_EMPLOYEE_NAME' => 'EMPLOYEE_NAME',
        'employee_name' => 'EMPLOYEE_NAME',
        'write_sgpi.employee_name' => 'EMPLOYEE_NAME',
        'Location' => 'LOCATION',
        'WriteSgpi.Location' => 'LOCATION',
        'location' => 'LOCATION',
        'writeSgpi.location' => 'LOCATION',
        'WriteSgpiTableMap::COL_LOCATION' => 'LOCATION',
        'COL_LOCATION' => 'LOCATION',
        'write_sgpi.location' => 'LOCATION',
        'LocationCode' => 'LOCATION_CODE',
        'WriteSgpi.LocationCode' => 'LOCATION_CODE',
        'locationCode' => 'LOCATION_CODE',
        'writeSgpi.locationCode' => 'LOCATION_CODE',
        'WriteSgpiTableMap::COL_LOCATION_CODE' => 'LOCATION_CODE',
        'COL_LOCATION_CODE' => 'LOCATION_CODE',
        'location_code' => 'LOCATION_CODE',
        'write_sgpi.location_code' => 'LOCATION_CODE',
        'DrCode' => 'DR_CODE',
        'WriteSgpi.DrCode' => 'DR_CODE',
        'drCode' => 'DR_CODE',
        'writeSgpi.drCode' => 'DR_CODE',
        'WriteSgpiTableMap::COL_DR_CODE' => 'DR_CODE',
        'COL_DR_CODE' => 'DR_CODE',
        'dr_code' => 'DR_CODE',
        'write_sgpi.dr_code' => 'DR_CODE',
        'DrName' => 'DR_NAME',
        'WriteSgpi.DrName' => 'DR_NAME',
        'drName' => 'DR_NAME',
        'writeSgpi.drName' => 'DR_NAME',
        'WriteSgpiTableMap::COL_DR_NAME' => 'DR_NAME',
        'COL_DR_NAME' => 'DR_NAME',
        'dr_name' => 'DR_NAME',
        'write_sgpi.dr_name' => 'DR_NAME',
        'DrSpecialty' => 'DR_SPECIALTY',
        'WriteSgpi.DrSpecialty' => 'DR_SPECIALTY',
        'drSpecialty' => 'DR_SPECIALTY',
        'writeSgpi.drSpecialty' => 'DR_SPECIALTY',
        'WriteSgpiTableMap::COL_DR_SPECIALTY' => 'DR_SPECIALTY',
        'COL_DR_SPECIALTY' => 'DR_SPECIALTY',
        'dr_specialty' => 'DR_SPECIALTY',
        'write_sgpi.dr_specialty' => 'DR_SPECIALTY',
        'Month' => 'MONTH',
        'WriteSgpi.Month' => 'MONTH',
        'month' => 'MONTH',
        'writeSgpi.month' => 'MONTH',
        'WriteSgpiTableMap::COL_MONTH' => 'MONTH',
        'COL_MONTH' => 'MONTH',
        'write_sgpi.month' => 'MONTH',
        'DrTags' => 'DR_TAGS',
        'WriteSgpi.DrTags' => 'DR_TAGS',
        'drTags' => 'DR_TAGS',
        'writeSgpi.drTags' => 'DR_TAGS',
        'WriteSgpiTableMap::COL_DR_TAGS' => 'DR_TAGS',
        'COL_DR_TAGS' => 'DR_TAGS',
        'dr_tags' => 'DR_TAGS',
        'write_sgpi.dr_tags' => 'DR_TAGS',
        'Brand' => 'BRAND',
        'WriteSgpi.Brand' => 'BRAND',
        'brand' => 'BRAND',
        'writeSgpi.brand' => 'BRAND',
        'WriteSgpiTableMap::COL_BRAND' => 'BRAND',
        'COL_BRAND' => 'BRAND',
        'write_sgpi.brand' => 'BRAND',
        'SgpiTagged' => 'SGPI_TAGGED',
        'WriteSgpi.SgpiTagged' => 'SGPI_TAGGED',
        'sgpiTagged' => 'SGPI_TAGGED',
        'writeSgpi.sgpiTagged' => 'SGPI_TAGGED',
        'WriteSgpiTableMap::COL_SGPI_TAGGED' => 'SGPI_TAGGED',
        'COL_SGPI_TAGGED' => 'SGPI_TAGGED',
        'sgpi_tagged' => 'SGPI_TAGGED',
        'write_sgpi.sgpi_tagged' => 'SGPI_TAGGED',
        'BrandSgpiDistributed' => 'BRAND_SGPI_DISTRIBUTED',
        'WriteSgpi.BrandSgpiDistributed' => 'BRAND_SGPI_DISTRIBUTED',
        'brandSgpiDistributed' => 'BRAND_SGPI_DISTRIBUTED',
        'writeSgpi.brandSgpiDistributed' => 'BRAND_SGPI_DISTRIBUTED',
        'WriteSgpiTableMap::COL_BRAND_SGPI_DISTRIBUTED' => 'BRAND_SGPI_DISTRIBUTED',
        'COL_BRAND_SGPI_DISTRIBUTED' => 'BRAND_SGPI_DISTRIBUTED',
        'brand_sgpi_distributed' => 'BRAND_SGPI_DISTRIBUTED',
        'write_sgpi.brand_sgpi_distributed' => 'BRAND_SGPI_DISTRIBUTED',
        'MrCallDone' => 'MR_CALL_DONE',
        'WriteSgpi.MrCallDone' => 'MR_CALL_DONE',
        'mrCallDone' => 'MR_CALL_DONE',
        'writeSgpi.mrCallDone' => 'MR_CALL_DONE',
        'WriteSgpiTableMap::COL_MR_CALL_DONE' => 'MR_CALL_DONE',
        'COL_MR_CALL_DONE' => 'MR_CALL_DONE',
        'mr_call_done' => 'MR_CALL_DONE',
        'write_sgpi.mr_call_done' => 'MR_CALL_DONE',
        'AmCallDone' => 'AM_CALL_DONE',
        'WriteSgpi.AmCallDone' => 'AM_CALL_DONE',
        'amCallDone' => 'AM_CALL_DONE',
        'writeSgpi.amCallDone' => 'AM_CALL_DONE',
        'WriteSgpiTableMap::COL_AM_CALL_DONE' => 'AM_CALL_DONE',
        'COL_AM_CALL_DONE' => 'AM_CALL_DONE',
        'am_call_done' => 'AM_CALL_DONE',
        'write_sgpi.am_call_done' => 'AM_CALL_DONE',
        'RmCallDone' => 'RM_CALL_DONE',
        'WriteSgpi.RmCallDone' => 'RM_CALL_DONE',
        'rmCallDone' => 'RM_CALL_DONE',
        'writeSgpi.rmCallDone' => 'RM_CALL_DONE',
        'WriteSgpiTableMap::COL_RM_CALL_DONE' => 'RM_CALL_DONE',
        'COL_RM_CALL_DONE' => 'RM_CALL_DONE',
        'rm_call_done' => 'RM_CALL_DONE',
        'write_sgpi.rm_call_done' => 'RM_CALL_DONE',
        'ZmCallDone' => 'ZM_CALL_DONE',
        'WriteSgpi.ZmCallDone' => 'ZM_CALL_DONE',
        'zmCallDone' => 'ZM_CALL_DONE',
        'writeSgpi.zmCallDone' => 'ZM_CALL_DONE',
        'WriteSgpiTableMap::COL_ZM_CALL_DONE' => 'ZM_CALL_DONE',
        'COL_ZM_CALL_DONE' => 'ZM_CALL_DONE',
        'zm_call_done' => 'ZM_CALL_DONE',
        'write_sgpi.zm_call_done' => 'ZM_CALL_DONE',
        'ZmPosition' => 'ZM_POSITION',
        'WriteSgpi.ZmPosition' => 'ZM_POSITION',
        'zmPosition' => 'ZM_POSITION',
        'writeSgpi.zmPosition' => 'ZM_POSITION',
        'WriteSgpiTableMap::COL_ZM_POSITION' => 'ZM_POSITION',
        'COL_ZM_POSITION' => 'ZM_POSITION',
        'zm_position' => 'ZM_POSITION',
        'write_sgpi.zm_position' => 'ZM_POSITION',
        'RmPosition' => 'RM_POSITION',
        'WriteSgpi.RmPosition' => 'RM_POSITION',
        'rmPosition' => 'RM_POSITION',
        'writeSgpi.rmPosition' => 'RM_POSITION',
        'WriteSgpiTableMap::COL_RM_POSITION' => 'RM_POSITION',
        'COL_RM_POSITION' => 'RM_POSITION',
        'rm_position' => 'RM_POSITION',
        'write_sgpi.rm_position' => 'RM_POSITION',
        'AmPosition' => 'AM_POSITION',
        'WriteSgpi.AmPosition' => 'AM_POSITION',
        'amPosition' => 'AM_POSITION',
        'writeSgpi.amPosition' => 'AM_POSITION',
        'WriteSgpiTableMap::COL_AM_POSITION' => 'AM_POSITION',
        'COL_AM_POSITION' => 'AM_POSITION',
        'am_position' => 'AM_POSITION',
        'write_sgpi.am_position' => 'AM_POSITION',
        'ZmPositionCode' => 'ZM_POSITION_CODE',
        'WriteSgpi.ZmPositionCode' => 'ZM_POSITION_CODE',
        'zmPositionCode' => 'ZM_POSITION_CODE',
        'writeSgpi.zmPositionCode' => 'ZM_POSITION_CODE',
        'WriteSgpiTableMap::COL_ZM_POSITION_CODE' => 'ZM_POSITION_CODE',
        'COL_ZM_POSITION_CODE' => 'ZM_POSITION_CODE',
        'zm_position_code' => 'ZM_POSITION_CODE',
        'write_sgpi.zm_position_code' => 'ZM_POSITION_CODE',
        'RmPositionCode' => 'RM_POSITION_CODE',
        'WriteSgpi.RmPositionCode' => 'RM_POSITION_CODE',
        'rmPositionCode' => 'RM_POSITION_CODE',
        'writeSgpi.rmPositionCode' => 'RM_POSITION_CODE',
        'WriteSgpiTableMap::COL_RM_POSITION_CODE' => 'RM_POSITION_CODE',
        'COL_RM_POSITION_CODE' => 'RM_POSITION_CODE',
        'rm_position_code' => 'RM_POSITION_CODE',
        'write_sgpi.rm_position_code' => 'RM_POSITION_CODE',
        'AmPositionCode' => 'AM_POSITION_CODE',
        'WriteSgpi.AmPositionCode' => 'AM_POSITION_CODE',
        'amPositionCode' => 'AM_POSITION_CODE',
        'writeSgpi.amPositionCode' => 'AM_POSITION_CODE',
        'WriteSgpiTableMap::COL_AM_POSITION_CODE' => 'AM_POSITION_CODE',
        'COL_AM_POSITION_CODE' => 'AM_POSITION_CODE',
        'am_position_code' => 'AM_POSITION_CODE',
        'write_sgpi.am_position_code' => 'AM_POSITION_CODE',
        'EmployeePositionCode' => 'EMPLOYEE_POSITION_CODE',
        'WriteSgpi.EmployeePositionCode' => 'EMPLOYEE_POSITION_CODE',
        'employeePositionCode' => 'EMPLOYEE_POSITION_CODE',
        'writeSgpi.employeePositionCode' => 'EMPLOYEE_POSITION_CODE',
        'WriteSgpiTableMap::COL_EMPLOYEE_POSITION_CODE' => 'EMPLOYEE_POSITION_CODE',
        'COL_EMPLOYEE_POSITION_CODE' => 'EMPLOYEE_POSITION_CODE',
        'employee_position_code' => 'EMPLOYEE_POSITION_CODE',
        'write_sgpi.employee_position_code' => 'EMPLOYEE_POSITION_CODE',
        'EmployeePositionName' => 'EMPLOYEE_POSITION_NAME',
        'WriteSgpi.EmployeePositionName' => 'EMPLOYEE_POSITION_NAME',
        'employeePositionName' => 'EMPLOYEE_POSITION_NAME',
        'writeSgpi.employeePositionName' => 'EMPLOYEE_POSITION_NAME',
        'WriteSgpiTableMap::COL_EMPLOYEE_POSITION_NAME' => 'EMPLOYEE_POSITION_NAME',
        'COL_EMPLOYEE_POSITION_NAME' => 'EMPLOYEE_POSITION_NAME',
        'employee_position_name' => 'EMPLOYEE_POSITION_NAME',
        'write_sgpi.employee_position_name' => 'EMPLOYEE_POSITION_NAME',
        'EmployeeLevel' => 'EMPLOYEE_LEVEL',
        'WriteSgpi.EmployeeLevel' => 'EMPLOYEE_LEVEL',
        'employeeLevel' => 'EMPLOYEE_LEVEL',
        'writeSgpi.employeeLevel' => 'EMPLOYEE_LEVEL',
        'WriteSgpiTableMap::COL_EMPLOYEE_LEVEL' => 'EMPLOYEE_LEVEL',
        'COL_EMPLOYEE_LEVEL' => 'EMPLOYEE_LEVEL',
        'employee_level' => 'EMPLOYEE_LEVEL',
        'write_sgpi.employee_level' => 'EMPLOYEE_LEVEL',
        'SgpiReportId' => 'SGPI_REPORT_ID',
        'WriteSgpi.SgpiReportId' => 'SGPI_REPORT_ID',
        'sgpiReportId' => 'SGPI_REPORT_ID',
        'writeSgpi.sgpiReportId' => 'SGPI_REPORT_ID',
        'WriteSgpiTableMap::COL_SGPI_REPORT_ID' => 'SGPI_REPORT_ID',
        'COL_SGPI_REPORT_ID' => 'SGPI_REPORT_ID',
        'sgpi_report_id' => 'SGPI_REPORT_ID',
        'write_sgpi.sgpi_report_id' => 'SGPI_REPORT_ID',
        'CreatedAt' => 'CREATED_AT',
        'WriteSgpi.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'writeSgpi.createdAt' => 'CREATED_AT',
        'WriteSgpiTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'write_sgpi.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'WriteSgpi.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'writeSgpi.updatedAt' => 'UPDATED_AT',
        'WriteSgpiTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'write_sgpi.updated_at' => 'UPDATED_AT',
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
        $this->setName('write_sgpi');
        $this->setPhpName('WriteSgpi');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\WriteSgpi');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('write_sgpi_sgpi_report_id_seq');
        // columns
        $this->addColumn('division', 'Division', 'VARCHAR', false, null, null);
        $this->addColumn('employee_id', 'EmployeeId', 'INTEGER', false, null, null);
        $this->addColumn('employee_name', 'EmployeeName', 'VARCHAR', false, null, null);
        $this->addColumn('location', 'Location', 'VARCHAR', false, null, null);
        $this->addColumn('location_code', 'LocationCode', 'INTEGER', false, null, null);
        $this->addColumn('dr_code', 'DrCode', 'INTEGER', false, null, null);
        $this->addColumn('dr_name', 'DrName', 'VARCHAR', false, null, null);
        $this->addColumn('dr_specialty', 'DrSpecialty', 'VARCHAR', false, null, null);
        $this->addColumn('month', 'Month', 'VARCHAR', false, null, null);
        $this->addColumn('dr_tags', 'DrTags', 'VARCHAR', false, null, null);
        $this->addColumn('brand', 'Brand', 'VARCHAR', false, null, null);
        $this->addColumn('sgpi_tagged', 'SgpiTagged', 'VARCHAR', false, null, null);
        $this->addColumn('brand_sgpi_distributed', 'BrandSgpiDistributed', 'INTEGER', false, null, null);
        $this->addColumn('mr_call_done', 'MrCallDone', 'INTEGER', false, null, null);
        $this->addColumn('am_call_done', 'AmCallDone', 'INTEGER', false, null, null);
        $this->addColumn('rm_call_done', 'RmCallDone', 'INTEGER', false, null, null);
        $this->addColumn('zm_call_done', 'ZmCallDone', 'INTEGER', false, null, null);
        $this->addColumn('zm_position', 'ZmPosition', 'VARCHAR', false, null, null);
        $this->addColumn('rm_position', 'RmPosition', 'VARCHAR', false, null, null);
        $this->addColumn('am_position', 'AmPosition', 'VARCHAR', false, null, null);
        $this->addColumn('zm_position_code', 'ZmPositionCode', 'INTEGER', false, null, null);
        $this->addColumn('rm_position_code', 'RmPositionCode', 'INTEGER', false, null, null);
        $this->addColumn('am_position_code', 'AmPositionCode', 'INTEGER', false, null, null);
        $this->addColumn('employee_position_code', 'EmployeePositionCode', 'INTEGER', false, null, null);
        $this->addColumn('employee_position_name', 'EmployeePositionName', 'VARCHAR', false, null, null);
        $this->addColumn('employee_level', 'EmployeeLevel', 'VARCHAR', false, null, null);
        $this->addPrimaryKey('sgpi_report_id', 'SgpiReportId', 'INTEGER', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 26 + $offset : static::translateFieldName('SgpiReportId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 26 + $offset : static::translateFieldName('SgpiReportId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 26 + $offset : static::translateFieldName('SgpiReportId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 26 + $offset : static::translateFieldName('SgpiReportId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 26 + $offset : static::translateFieldName('SgpiReportId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 26 + $offset : static::translateFieldName('SgpiReportId', TableMap::TYPE_PHPNAME, $indexType)];
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
                ? 26 + $offset
                : self::translateFieldName('SgpiReportId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? WriteSgpiTableMap::CLASS_DEFAULT : WriteSgpiTableMap::OM_CLASS;
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
     * @return array (WriteSgpi object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = WriteSgpiTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = WriteSgpiTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + WriteSgpiTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = WriteSgpiTableMap::OM_CLASS;
            /** @var WriteSgpi $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            WriteSgpiTableMap::addInstanceToPool($obj, $key);
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
            $key = WriteSgpiTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = WriteSgpiTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var WriteSgpi $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                WriteSgpiTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_DIVISION);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_EMPLOYEE_NAME);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_LOCATION);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_LOCATION_CODE);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_DR_CODE);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_DR_NAME);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_DR_SPECIALTY);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_MONTH);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_DR_TAGS);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_BRAND);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_SGPI_TAGGED);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_BRAND_SGPI_DISTRIBUTED);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_MR_CALL_DONE);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_AM_CALL_DONE);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_RM_CALL_DONE);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_ZM_CALL_DONE);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_ZM_POSITION);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_RM_POSITION);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_AM_POSITION);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_ZM_POSITION_CODE);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_RM_POSITION_CODE);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_AM_POSITION_CODE);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_EMPLOYEE_POSITION_CODE);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_EMPLOYEE_POSITION_NAME);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_EMPLOYEE_LEVEL);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_SGPI_REPORT_ID);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(WriteSgpiTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.division');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.employee_name');
            $criteria->addSelectColumn($alias . '.location');
            $criteria->addSelectColumn($alias . '.location_code');
            $criteria->addSelectColumn($alias . '.dr_code');
            $criteria->addSelectColumn($alias . '.dr_name');
            $criteria->addSelectColumn($alias . '.dr_specialty');
            $criteria->addSelectColumn($alias . '.month');
            $criteria->addSelectColumn($alias . '.dr_tags');
            $criteria->addSelectColumn($alias . '.brand');
            $criteria->addSelectColumn($alias . '.sgpi_tagged');
            $criteria->addSelectColumn($alias . '.brand_sgpi_distributed');
            $criteria->addSelectColumn($alias . '.mr_call_done');
            $criteria->addSelectColumn($alias . '.am_call_done');
            $criteria->addSelectColumn($alias . '.rm_call_done');
            $criteria->addSelectColumn($alias . '.zm_call_done');
            $criteria->addSelectColumn($alias . '.zm_position');
            $criteria->addSelectColumn($alias . '.rm_position');
            $criteria->addSelectColumn($alias . '.am_position');
            $criteria->addSelectColumn($alias . '.zm_position_code');
            $criteria->addSelectColumn($alias . '.rm_position_code');
            $criteria->addSelectColumn($alias . '.am_position_code');
            $criteria->addSelectColumn($alias . '.employee_position_code');
            $criteria->addSelectColumn($alias . '.employee_position_name');
            $criteria->addSelectColumn($alias . '.employee_level');
            $criteria->addSelectColumn($alias . '.sgpi_report_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
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
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_DIVISION);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_EMPLOYEE_NAME);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_LOCATION);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_LOCATION_CODE);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_DR_CODE);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_DR_NAME);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_DR_SPECIALTY);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_MONTH);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_DR_TAGS);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_BRAND);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_SGPI_TAGGED);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_BRAND_SGPI_DISTRIBUTED);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_MR_CALL_DONE);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_AM_CALL_DONE);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_RM_CALL_DONE);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_ZM_CALL_DONE);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_ZM_POSITION);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_RM_POSITION);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_AM_POSITION);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_ZM_POSITION_CODE);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_RM_POSITION_CODE);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_AM_POSITION_CODE);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_EMPLOYEE_POSITION_CODE);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_EMPLOYEE_POSITION_NAME);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_EMPLOYEE_LEVEL);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_SGPI_REPORT_ID);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(WriteSgpiTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.division');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.employee_name');
            $criteria->removeSelectColumn($alias . '.location');
            $criteria->removeSelectColumn($alias . '.location_code');
            $criteria->removeSelectColumn($alias . '.dr_code');
            $criteria->removeSelectColumn($alias . '.dr_name');
            $criteria->removeSelectColumn($alias . '.dr_specialty');
            $criteria->removeSelectColumn($alias . '.month');
            $criteria->removeSelectColumn($alias . '.dr_tags');
            $criteria->removeSelectColumn($alias . '.brand');
            $criteria->removeSelectColumn($alias . '.sgpi_tagged');
            $criteria->removeSelectColumn($alias . '.brand_sgpi_distributed');
            $criteria->removeSelectColumn($alias . '.mr_call_done');
            $criteria->removeSelectColumn($alias . '.am_call_done');
            $criteria->removeSelectColumn($alias . '.rm_call_done');
            $criteria->removeSelectColumn($alias . '.zm_call_done');
            $criteria->removeSelectColumn($alias . '.zm_position');
            $criteria->removeSelectColumn($alias . '.rm_position');
            $criteria->removeSelectColumn($alias . '.am_position');
            $criteria->removeSelectColumn($alias . '.zm_position_code');
            $criteria->removeSelectColumn($alias . '.rm_position_code');
            $criteria->removeSelectColumn($alias . '.am_position_code');
            $criteria->removeSelectColumn($alias . '.employee_position_code');
            $criteria->removeSelectColumn($alias . '.employee_position_name');
            $criteria->removeSelectColumn($alias . '.employee_level');
            $criteria->removeSelectColumn($alias . '.sgpi_report_id');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(WriteSgpiTableMap::DATABASE_NAME)->getTable(WriteSgpiTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a WriteSgpi or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or WriteSgpi object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(WriteSgpiTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\WriteSgpi) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(WriteSgpiTableMap::DATABASE_NAME);
            $criteria->add(WriteSgpiTableMap::COL_SGPI_REPORT_ID, (array) $values, Criteria::IN);
        }

        $query = WriteSgpiQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            WriteSgpiTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                WriteSgpiTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the write_sgpi table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return WriteSgpiQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a WriteSgpi or Criteria object.
     *
     * @param mixed $criteria Criteria or WriteSgpi object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WriteSgpiTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from WriteSgpi object
        }

        if ($criteria->containsKey(WriteSgpiTableMap::COL_SGPI_REPORT_ID) && $criteria->keyContainsValue(WriteSgpiTableMap::COL_SGPI_REPORT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.WriteSgpiTableMap::COL_SGPI_REPORT_ID.')');
        }


        // Set the correct dbName
        $query = WriteSgpiQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
