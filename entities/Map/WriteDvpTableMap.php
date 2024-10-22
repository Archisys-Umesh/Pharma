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
use entities\WriteDvp;
use entities\WriteDvpQuery;


/**
 * This class defines the structure of the 'write_dvp' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class WriteDvpTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.WriteDvpTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'write_dvp';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'WriteDvp';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\WriteDvp';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.WriteDvp';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 41;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 41;

    /**
     * the column name for the org_unit field
     */
    public const COL_ORG_UNIT = 'write_dvp.org_unit';

    /**
     * the column name for the employee_code field
     */
    public const COL_EMPLOYEE_CODE = 'write_dvp.employee_code';

    /**
     * the column name for the joining_date field
     */
    public const COL_JOINING_DATE = 'write_dvp.joining_date';

    /**
     * the column name for the am_position field
     */
    public const COL_AM_POSITION = 'write_dvp.am_position';

    /**
     * the column name for the rm_position field
     */
    public const COL_RM_POSITION = 'write_dvp.rm_position';

    /**
     * the column name for the zm_position field
     */
    public const COL_ZM_POSITION = 'write_dvp.zm_position';

    /**
     * the column name for the location field
     */
    public const COL_LOCATION = 'write_dvp.location';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'write_dvp.status';

    /**
     * the column name for the employee_name field
     */
    public const COL_EMPLOYEE_NAME = 'write_dvp.employee_name';

    /**
     * the column name for the doctor_name field
     */
    public const COL_DOCTOR_NAME = 'write_dvp.doctor_name';

    /**
     * the column name for the doctor_code field
     */
    public const COL_DOCTOR_CODE = 'write_dvp.doctor_code';

    /**
     * the column name for the town field
     */
    public const COL_TOWN = 'write_dvp.town';

    /**
     * the column name for the patch field
     */
    public const COL_PATCH = 'write_dvp.patch';

    /**
     * the column name for the speciality field
     */
    public const COL_SPECIALITY = 'write_dvp.speciality';

    /**
     * the column name for the tags field
     */
    public const COL_TAGS = 'write_dvp.tags';

    /**
     * the column name for the visit_fq field
     */
    public const COL_VISIT_FQ = 'write_dvp.visit_fq';

    /**
     * the column name for the prescriber_classification field
     */
    public const COL_PRESCRIBER_CLASSIFICATION = 'write_dvp.prescriber_classification';

    /**
     * the column name for the top_brand field
     */
    public const COL_TOP_BRAND = 'write_dvp.top_brand';

    /**
     * the column name for the visit_dr field
     */
    public const COL_VISIT_DR = 'write_dvp.visit_dr';

    /**
     * the column name for the am_visit_dr field
     */
    public const COL_AM_VISIT_DR = 'write_dvp.am_visit_dr';

    /**
     * the column name for the rm_visit_dr field
     */
    public const COL_RM_VISIT_DR = 'write_dvp.rm_visit_dr';

    /**
     * the column name for the zm_visit_dr field
     */
    public const COL_ZM_VISIT_DR = 'write_dvp.zm_visit_dr';

    /**
     * the column name for the rcpa_done field
     */
    public const COL_RCPA_DONE = 'write_dvp.rcpa_done';

    /**
     * the column name for the rcpa_lm_own field
     */
    public const COL_RCPA_LM_OWN = 'write_dvp.rcpa_lm_own';

    /**
     * the column name for the rcpa_lm_comp field
     */
    public const COL_RCPA_LM_COMP = 'write_dvp.rcpa_lm_comp';

    /**
     * the column name for the rcpa_cm_own field
     */
    public const COL_RCPA_CM_OWN = 'write_dvp.rcpa_cm_own';

    /**
     * the column name for the rcpa_cm_comp field
     */
    public const COL_RCPA_CM_COMP = 'write_dvp.rcpa_cm_comp';

    /**
     * the column name for the samples_sgpi field
     */
    public const COL_SAMPLES_SGPI = 'write_dvp.samples_sgpi';

    /**
     * the column name for the gifts_sgpi field
     */
    public const COL_GIFTS_SGPI = 'write_dvp.gifts_sgpi';

    /**
     * the column name for the promo_sgpi field
     */
    public const COL_PROMO_SGPI = 'write_dvp.promo_sgpi';

    /**
     * the column name for the zm_position_code field
     */
    public const COL_ZM_POSITION_CODE = 'write_dvp.zm_position_code';

    /**
     * the column name for the rm_position_code field
     */
    public const COL_RM_POSITION_CODE = 'write_dvp.rm_position_code';

    /**
     * the column name for the am_position_code field
     */
    public const COL_AM_POSITION_CODE = 'write_dvp.am_position_code';

    /**
     * the column name for the employee_position_code field
     */
    public const COL_EMPLOYEE_POSITION_CODE = 'write_dvp.employee_position_code';

    /**
     * the column name for the employee_position field
     */
    public const COL_EMPLOYEE_POSITION = 'write_dvp.employee_position';

    /**
     * the column name for the employee_level field
     */
    public const COL_EMPLOYEE_LEVEL = 'write_dvp.employee_level';

    /**
     * the column name for the month field
     */
    public const COL_MONTH = 'write_dvp.month';

    /**
     * the column name for the dvp_report_id field
     */
    public const COL_DVP_REPORT_ID = 'write_dvp.dvp_report_id';

    /**
     * the column name for the mr_detailing field
     */
    public const COL_MR_DETAILING = 'write_dvp.mr_detailing';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'write_dvp.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'write_dvp.updated_at';

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
        self::TYPE_PHPNAME       => ['OrgUnit', 'EmployeeCode', 'JoiningDate', 'AmPosition', 'RmPosition', 'ZmPosition', 'Location', 'Status', 'EmployeeName', 'DoctorName', 'DoctorCode', 'Town', 'Patch', 'Speciality', 'Tags', 'VisitFq', 'PrescriberClassification', 'TopBrand', 'VisitDr', 'AmVisitDr', 'RmVisitDr', 'ZmVisitDr', 'RcpaDone', 'RcpaLmOwn', 'RcpaLmComp', 'RcpaCmOwn', 'RcpaCmComp', 'SamplesSgpi', 'GiftsSgpi', 'PromoSgpi', 'ZmPositionCode', 'RmPositionCode', 'AmPositionCode', 'EmployeePositionCode', 'EmployeePosition', 'EmployeeLevel', 'Month', 'DvpReportId', 'MrDetailing', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['orgUnit', 'employeeCode', 'joiningDate', 'amPosition', 'rmPosition', 'zmPosition', 'location', 'status', 'employeeName', 'doctorName', 'doctorCode', 'town', 'patch', 'speciality', 'tags', 'visitFq', 'prescriberClassification', 'topBrand', 'visitDr', 'amVisitDr', 'rmVisitDr', 'zmVisitDr', 'rcpaDone', 'rcpaLmOwn', 'rcpaLmComp', 'rcpaCmOwn', 'rcpaCmComp', 'samplesSgpi', 'giftsSgpi', 'promoSgpi', 'zmPositionCode', 'rmPositionCode', 'amPositionCode', 'employeePositionCode', 'employeePosition', 'employeeLevel', 'month', 'dvpReportId', 'mrDetailing', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [WriteDvpTableMap::COL_ORG_UNIT, WriteDvpTableMap::COL_EMPLOYEE_CODE, WriteDvpTableMap::COL_JOINING_DATE, WriteDvpTableMap::COL_AM_POSITION, WriteDvpTableMap::COL_RM_POSITION, WriteDvpTableMap::COL_ZM_POSITION, WriteDvpTableMap::COL_LOCATION, WriteDvpTableMap::COL_STATUS, WriteDvpTableMap::COL_EMPLOYEE_NAME, WriteDvpTableMap::COL_DOCTOR_NAME, WriteDvpTableMap::COL_DOCTOR_CODE, WriteDvpTableMap::COL_TOWN, WriteDvpTableMap::COL_PATCH, WriteDvpTableMap::COL_SPECIALITY, WriteDvpTableMap::COL_TAGS, WriteDvpTableMap::COL_VISIT_FQ, WriteDvpTableMap::COL_PRESCRIBER_CLASSIFICATION, WriteDvpTableMap::COL_TOP_BRAND, WriteDvpTableMap::COL_VISIT_DR, WriteDvpTableMap::COL_AM_VISIT_DR, WriteDvpTableMap::COL_RM_VISIT_DR, WriteDvpTableMap::COL_ZM_VISIT_DR, WriteDvpTableMap::COL_RCPA_DONE, WriteDvpTableMap::COL_RCPA_LM_OWN, WriteDvpTableMap::COL_RCPA_LM_COMP, WriteDvpTableMap::COL_RCPA_CM_OWN, WriteDvpTableMap::COL_RCPA_CM_COMP, WriteDvpTableMap::COL_SAMPLES_SGPI, WriteDvpTableMap::COL_GIFTS_SGPI, WriteDvpTableMap::COL_PROMO_SGPI, WriteDvpTableMap::COL_ZM_POSITION_CODE, WriteDvpTableMap::COL_RM_POSITION_CODE, WriteDvpTableMap::COL_AM_POSITION_CODE, WriteDvpTableMap::COL_EMPLOYEE_POSITION_CODE, WriteDvpTableMap::COL_EMPLOYEE_POSITION, WriteDvpTableMap::COL_EMPLOYEE_LEVEL, WriteDvpTableMap::COL_MONTH, WriteDvpTableMap::COL_DVP_REPORT_ID, WriteDvpTableMap::COL_MR_DETAILING, WriteDvpTableMap::COL_CREATED_AT, WriteDvpTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['org_unit', 'employee_code', 'joining_date', 'am_position', 'rm_position', 'zm_position', 'location', 'status', 'employee_name', 'doctor_name', 'doctor_code', 'town', 'patch', 'speciality', 'tags', 'visit_fq', 'prescriber_classification', 'top_brand', 'visit_dr', 'am_visit_dr', 'rm_visit_dr', 'zm_visit_dr', 'rcpa_done', 'rcpa_lm_own', 'rcpa_lm_comp', 'rcpa_cm_own', 'rcpa_cm_comp', 'samples_sgpi', 'gifts_sgpi', 'promo_sgpi', 'zm_position_code', 'rm_position_code', 'am_position_code', 'employee_position_code', 'employee_position', 'employee_level', 'month', 'dvp_report_id', 'mr_detailing', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, ]
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
        self::TYPE_PHPNAME       => ['OrgUnit' => 0, 'EmployeeCode' => 1, 'JoiningDate' => 2, 'AmPosition' => 3, 'RmPosition' => 4, 'ZmPosition' => 5, 'Location' => 6, 'Status' => 7, 'EmployeeName' => 8, 'DoctorName' => 9, 'DoctorCode' => 10, 'Town' => 11, 'Patch' => 12, 'Speciality' => 13, 'Tags' => 14, 'VisitFq' => 15, 'PrescriberClassification' => 16, 'TopBrand' => 17, 'VisitDr' => 18, 'AmVisitDr' => 19, 'RmVisitDr' => 20, 'ZmVisitDr' => 21, 'RcpaDone' => 22, 'RcpaLmOwn' => 23, 'RcpaLmComp' => 24, 'RcpaCmOwn' => 25, 'RcpaCmComp' => 26, 'SamplesSgpi' => 27, 'GiftsSgpi' => 28, 'PromoSgpi' => 29, 'ZmPositionCode' => 30, 'RmPositionCode' => 31, 'AmPositionCode' => 32, 'EmployeePositionCode' => 33, 'EmployeePosition' => 34, 'EmployeeLevel' => 35, 'Month' => 36, 'DvpReportId' => 37, 'MrDetailing' => 38, 'CreatedAt' => 39, 'UpdatedAt' => 40, ],
        self::TYPE_CAMELNAME     => ['orgUnit' => 0, 'employeeCode' => 1, 'joiningDate' => 2, 'amPosition' => 3, 'rmPosition' => 4, 'zmPosition' => 5, 'location' => 6, 'status' => 7, 'employeeName' => 8, 'doctorName' => 9, 'doctorCode' => 10, 'town' => 11, 'patch' => 12, 'speciality' => 13, 'tags' => 14, 'visitFq' => 15, 'prescriberClassification' => 16, 'topBrand' => 17, 'visitDr' => 18, 'amVisitDr' => 19, 'rmVisitDr' => 20, 'zmVisitDr' => 21, 'rcpaDone' => 22, 'rcpaLmOwn' => 23, 'rcpaLmComp' => 24, 'rcpaCmOwn' => 25, 'rcpaCmComp' => 26, 'samplesSgpi' => 27, 'giftsSgpi' => 28, 'promoSgpi' => 29, 'zmPositionCode' => 30, 'rmPositionCode' => 31, 'amPositionCode' => 32, 'employeePositionCode' => 33, 'employeePosition' => 34, 'employeeLevel' => 35, 'month' => 36, 'dvpReportId' => 37, 'mrDetailing' => 38, 'createdAt' => 39, 'updatedAt' => 40, ],
        self::TYPE_COLNAME       => [WriteDvpTableMap::COL_ORG_UNIT => 0, WriteDvpTableMap::COL_EMPLOYEE_CODE => 1, WriteDvpTableMap::COL_JOINING_DATE => 2, WriteDvpTableMap::COL_AM_POSITION => 3, WriteDvpTableMap::COL_RM_POSITION => 4, WriteDvpTableMap::COL_ZM_POSITION => 5, WriteDvpTableMap::COL_LOCATION => 6, WriteDvpTableMap::COL_STATUS => 7, WriteDvpTableMap::COL_EMPLOYEE_NAME => 8, WriteDvpTableMap::COL_DOCTOR_NAME => 9, WriteDvpTableMap::COL_DOCTOR_CODE => 10, WriteDvpTableMap::COL_TOWN => 11, WriteDvpTableMap::COL_PATCH => 12, WriteDvpTableMap::COL_SPECIALITY => 13, WriteDvpTableMap::COL_TAGS => 14, WriteDvpTableMap::COL_VISIT_FQ => 15, WriteDvpTableMap::COL_PRESCRIBER_CLASSIFICATION => 16, WriteDvpTableMap::COL_TOP_BRAND => 17, WriteDvpTableMap::COL_VISIT_DR => 18, WriteDvpTableMap::COL_AM_VISIT_DR => 19, WriteDvpTableMap::COL_RM_VISIT_DR => 20, WriteDvpTableMap::COL_ZM_VISIT_DR => 21, WriteDvpTableMap::COL_RCPA_DONE => 22, WriteDvpTableMap::COL_RCPA_LM_OWN => 23, WriteDvpTableMap::COL_RCPA_LM_COMP => 24, WriteDvpTableMap::COL_RCPA_CM_OWN => 25, WriteDvpTableMap::COL_RCPA_CM_COMP => 26, WriteDvpTableMap::COL_SAMPLES_SGPI => 27, WriteDvpTableMap::COL_GIFTS_SGPI => 28, WriteDvpTableMap::COL_PROMO_SGPI => 29, WriteDvpTableMap::COL_ZM_POSITION_CODE => 30, WriteDvpTableMap::COL_RM_POSITION_CODE => 31, WriteDvpTableMap::COL_AM_POSITION_CODE => 32, WriteDvpTableMap::COL_EMPLOYEE_POSITION_CODE => 33, WriteDvpTableMap::COL_EMPLOYEE_POSITION => 34, WriteDvpTableMap::COL_EMPLOYEE_LEVEL => 35, WriteDvpTableMap::COL_MONTH => 36, WriteDvpTableMap::COL_DVP_REPORT_ID => 37, WriteDvpTableMap::COL_MR_DETAILING => 38, WriteDvpTableMap::COL_CREATED_AT => 39, WriteDvpTableMap::COL_UPDATED_AT => 40, ],
        self::TYPE_FIELDNAME     => ['org_unit' => 0, 'employee_code' => 1, 'joining_date' => 2, 'am_position' => 3, 'rm_position' => 4, 'zm_position' => 5, 'location' => 6, 'status' => 7, 'employee_name' => 8, 'doctor_name' => 9, 'doctor_code' => 10, 'town' => 11, 'patch' => 12, 'speciality' => 13, 'tags' => 14, 'visit_fq' => 15, 'prescriber_classification' => 16, 'top_brand' => 17, 'visit_dr' => 18, 'am_visit_dr' => 19, 'rm_visit_dr' => 20, 'zm_visit_dr' => 21, 'rcpa_done' => 22, 'rcpa_lm_own' => 23, 'rcpa_lm_comp' => 24, 'rcpa_cm_own' => 25, 'rcpa_cm_comp' => 26, 'samples_sgpi' => 27, 'gifts_sgpi' => 28, 'promo_sgpi' => 29, 'zm_position_code' => 30, 'rm_position_code' => 31, 'am_position_code' => 32, 'employee_position_code' => 33, 'employee_position' => 34, 'employee_level' => 35, 'month' => 36, 'dvp_report_id' => 37, 'mr_detailing' => 38, 'created_at' => 39, 'updated_at' => 40, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OrgUnit' => 'ORG_UNIT',
        'WriteDvp.OrgUnit' => 'ORG_UNIT',
        'orgUnit' => 'ORG_UNIT',
        'writeDvp.orgUnit' => 'ORG_UNIT',
        'WriteDvpTableMap::COL_ORG_UNIT' => 'ORG_UNIT',
        'COL_ORG_UNIT' => 'ORG_UNIT',
        'org_unit' => 'ORG_UNIT',
        'write_dvp.org_unit' => 'ORG_UNIT',
        'EmployeeCode' => 'EMPLOYEE_CODE',
        'WriteDvp.EmployeeCode' => 'EMPLOYEE_CODE',
        'employeeCode' => 'EMPLOYEE_CODE',
        'writeDvp.employeeCode' => 'EMPLOYEE_CODE',
        'WriteDvpTableMap::COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'employee_code' => 'EMPLOYEE_CODE',
        'write_dvp.employee_code' => 'EMPLOYEE_CODE',
        'JoiningDate' => 'JOINING_DATE',
        'WriteDvp.JoiningDate' => 'JOINING_DATE',
        'joiningDate' => 'JOINING_DATE',
        'writeDvp.joiningDate' => 'JOINING_DATE',
        'WriteDvpTableMap::COL_JOINING_DATE' => 'JOINING_DATE',
        'COL_JOINING_DATE' => 'JOINING_DATE',
        'joining_date' => 'JOINING_DATE',
        'write_dvp.joining_date' => 'JOINING_DATE',
        'AmPosition' => 'AM_POSITION',
        'WriteDvp.AmPosition' => 'AM_POSITION',
        'amPosition' => 'AM_POSITION',
        'writeDvp.amPosition' => 'AM_POSITION',
        'WriteDvpTableMap::COL_AM_POSITION' => 'AM_POSITION',
        'COL_AM_POSITION' => 'AM_POSITION',
        'am_position' => 'AM_POSITION',
        'write_dvp.am_position' => 'AM_POSITION',
        'RmPosition' => 'RM_POSITION',
        'WriteDvp.RmPosition' => 'RM_POSITION',
        'rmPosition' => 'RM_POSITION',
        'writeDvp.rmPosition' => 'RM_POSITION',
        'WriteDvpTableMap::COL_RM_POSITION' => 'RM_POSITION',
        'COL_RM_POSITION' => 'RM_POSITION',
        'rm_position' => 'RM_POSITION',
        'write_dvp.rm_position' => 'RM_POSITION',
        'ZmPosition' => 'ZM_POSITION',
        'WriteDvp.ZmPosition' => 'ZM_POSITION',
        'zmPosition' => 'ZM_POSITION',
        'writeDvp.zmPosition' => 'ZM_POSITION',
        'WriteDvpTableMap::COL_ZM_POSITION' => 'ZM_POSITION',
        'COL_ZM_POSITION' => 'ZM_POSITION',
        'zm_position' => 'ZM_POSITION',
        'write_dvp.zm_position' => 'ZM_POSITION',
        'Location' => 'LOCATION',
        'WriteDvp.Location' => 'LOCATION',
        'location' => 'LOCATION',
        'writeDvp.location' => 'LOCATION',
        'WriteDvpTableMap::COL_LOCATION' => 'LOCATION',
        'COL_LOCATION' => 'LOCATION',
        'write_dvp.location' => 'LOCATION',
        'Status' => 'STATUS',
        'WriteDvp.Status' => 'STATUS',
        'status' => 'STATUS',
        'writeDvp.status' => 'STATUS',
        'WriteDvpTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'write_dvp.status' => 'STATUS',
        'EmployeeName' => 'EMPLOYEE_NAME',
        'WriteDvp.EmployeeName' => 'EMPLOYEE_NAME',
        'employeeName' => 'EMPLOYEE_NAME',
        'writeDvp.employeeName' => 'EMPLOYEE_NAME',
        'WriteDvpTableMap::COL_EMPLOYEE_NAME' => 'EMPLOYEE_NAME',
        'COL_EMPLOYEE_NAME' => 'EMPLOYEE_NAME',
        'employee_name' => 'EMPLOYEE_NAME',
        'write_dvp.employee_name' => 'EMPLOYEE_NAME',
        'DoctorName' => 'DOCTOR_NAME',
        'WriteDvp.DoctorName' => 'DOCTOR_NAME',
        'doctorName' => 'DOCTOR_NAME',
        'writeDvp.doctorName' => 'DOCTOR_NAME',
        'WriteDvpTableMap::COL_DOCTOR_NAME' => 'DOCTOR_NAME',
        'COL_DOCTOR_NAME' => 'DOCTOR_NAME',
        'doctor_name' => 'DOCTOR_NAME',
        'write_dvp.doctor_name' => 'DOCTOR_NAME',
        'DoctorCode' => 'DOCTOR_CODE',
        'WriteDvp.DoctorCode' => 'DOCTOR_CODE',
        'doctorCode' => 'DOCTOR_CODE',
        'writeDvp.doctorCode' => 'DOCTOR_CODE',
        'WriteDvpTableMap::COL_DOCTOR_CODE' => 'DOCTOR_CODE',
        'COL_DOCTOR_CODE' => 'DOCTOR_CODE',
        'doctor_code' => 'DOCTOR_CODE',
        'write_dvp.doctor_code' => 'DOCTOR_CODE',
        'Town' => 'TOWN',
        'WriteDvp.Town' => 'TOWN',
        'town' => 'TOWN',
        'writeDvp.town' => 'TOWN',
        'WriteDvpTableMap::COL_TOWN' => 'TOWN',
        'COL_TOWN' => 'TOWN',
        'write_dvp.town' => 'TOWN',
        'Patch' => 'PATCH',
        'WriteDvp.Patch' => 'PATCH',
        'patch' => 'PATCH',
        'writeDvp.patch' => 'PATCH',
        'WriteDvpTableMap::COL_PATCH' => 'PATCH',
        'COL_PATCH' => 'PATCH',
        'write_dvp.patch' => 'PATCH',
        'Speciality' => 'SPECIALITY',
        'WriteDvp.Speciality' => 'SPECIALITY',
        'speciality' => 'SPECIALITY',
        'writeDvp.speciality' => 'SPECIALITY',
        'WriteDvpTableMap::COL_SPECIALITY' => 'SPECIALITY',
        'COL_SPECIALITY' => 'SPECIALITY',
        'write_dvp.speciality' => 'SPECIALITY',
        'Tags' => 'TAGS',
        'WriteDvp.Tags' => 'TAGS',
        'tags' => 'TAGS',
        'writeDvp.tags' => 'TAGS',
        'WriteDvpTableMap::COL_TAGS' => 'TAGS',
        'COL_TAGS' => 'TAGS',
        'write_dvp.tags' => 'TAGS',
        'VisitFq' => 'VISIT_FQ',
        'WriteDvp.VisitFq' => 'VISIT_FQ',
        'visitFq' => 'VISIT_FQ',
        'writeDvp.visitFq' => 'VISIT_FQ',
        'WriteDvpTableMap::COL_VISIT_FQ' => 'VISIT_FQ',
        'COL_VISIT_FQ' => 'VISIT_FQ',
        'visit_fq' => 'VISIT_FQ',
        'write_dvp.visit_fq' => 'VISIT_FQ',
        'PrescriberClassification' => 'PRESCRIBER_CLASSIFICATION',
        'WriteDvp.PrescriberClassification' => 'PRESCRIBER_CLASSIFICATION',
        'prescriberClassification' => 'PRESCRIBER_CLASSIFICATION',
        'writeDvp.prescriberClassification' => 'PRESCRIBER_CLASSIFICATION',
        'WriteDvpTableMap::COL_PRESCRIBER_CLASSIFICATION' => 'PRESCRIBER_CLASSIFICATION',
        'COL_PRESCRIBER_CLASSIFICATION' => 'PRESCRIBER_CLASSIFICATION',
        'prescriber_classification' => 'PRESCRIBER_CLASSIFICATION',
        'write_dvp.prescriber_classification' => 'PRESCRIBER_CLASSIFICATION',
        'TopBrand' => 'TOP_BRAND',
        'WriteDvp.TopBrand' => 'TOP_BRAND',
        'topBrand' => 'TOP_BRAND',
        'writeDvp.topBrand' => 'TOP_BRAND',
        'WriteDvpTableMap::COL_TOP_BRAND' => 'TOP_BRAND',
        'COL_TOP_BRAND' => 'TOP_BRAND',
        'top_brand' => 'TOP_BRAND',
        'write_dvp.top_brand' => 'TOP_BRAND',
        'VisitDr' => 'VISIT_DR',
        'WriteDvp.VisitDr' => 'VISIT_DR',
        'visitDr' => 'VISIT_DR',
        'writeDvp.visitDr' => 'VISIT_DR',
        'WriteDvpTableMap::COL_VISIT_DR' => 'VISIT_DR',
        'COL_VISIT_DR' => 'VISIT_DR',
        'visit_dr' => 'VISIT_DR',
        'write_dvp.visit_dr' => 'VISIT_DR',
        'AmVisitDr' => 'AM_VISIT_DR',
        'WriteDvp.AmVisitDr' => 'AM_VISIT_DR',
        'amVisitDr' => 'AM_VISIT_DR',
        'writeDvp.amVisitDr' => 'AM_VISIT_DR',
        'WriteDvpTableMap::COL_AM_VISIT_DR' => 'AM_VISIT_DR',
        'COL_AM_VISIT_DR' => 'AM_VISIT_DR',
        'am_visit_dr' => 'AM_VISIT_DR',
        'write_dvp.am_visit_dr' => 'AM_VISIT_DR',
        'RmVisitDr' => 'RM_VISIT_DR',
        'WriteDvp.RmVisitDr' => 'RM_VISIT_DR',
        'rmVisitDr' => 'RM_VISIT_DR',
        'writeDvp.rmVisitDr' => 'RM_VISIT_DR',
        'WriteDvpTableMap::COL_RM_VISIT_DR' => 'RM_VISIT_DR',
        'COL_RM_VISIT_DR' => 'RM_VISIT_DR',
        'rm_visit_dr' => 'RM_VISIT_DR',
        'write_dvp.rm_visit_dr' => 'RM_VISIT_DR',
        'ZmVisitDr' => 'ZM_VISIT_DR',
        'WriteDvp.ZmVisitDr' => 'ZM_VISIT_DR',
        'zmVisitDr' => 'ZM_VISIT_DR',
        'writeDvp.zmVisitDr' => 'ZM_VISIT_DR',
        'WriteDvpTableMap::COL_ZM_VISIT_DR' => 'ZM_VISIT_DR',
        'COL_ZM_VISIT_DR' => 'ZM_VISIT_DR',
        'zm_visit_dr' => 'ZM_VISIT_DR',
        'write_dvp.zm_visit_dr' => 'ZM_VISIT_DR',
        'RcpaDone' => 'RCPA_DONE',
        'WriteDvp.RcpaDone' => 'RCPA_DONE',
        'rcpaDone' => 'RCPA_DONE',
        'writeDvp.rcpaDone' => 'RCPA_DONE',
        'WriteDvpTableMap::COL_RCPA_DONE' => 'RCPA_DONE',
        'COL_RCPA_DONE' => 'RCPA_DONE',
        'rcpa_done' => 'RCPA_DONE',
        'write_dvp.rcpa_done' => 'RCPA_DONE',
        'RcpaLmOwn' => 'RCPA_LM_OWN',
        'WriteDvp.RcpaLmOwn' => 'RCPA_LM_OWN',
        'rcpaLmOwn' => 'RCPA_LM_OWN',
        'writeDvp.rcpaLmOwn' => 'RCPA_LM_OWN',
        'WriteDvpTableMap::COL_RCPA_LM_OWN' => 'RCPA_LM_OWN',
        'COL_RCPA_LM_OWN' => 'RCPA_LM_OWN',
        'rcpa_lm_own' => 'RCPA_LM_OWN',
        'write_dvp.rcpa_lm_own' => 'RCPA_LM_OWN',
        'RcpaLmComp' => 'RCPA_LM_COMP',
        'WriteDvp.RcpaLmComp' => 'RCPA_LM_COMP',
        'rcpaLmComp' => 'RCPA_LM_COMP',
        'writeDvp.rcpaLmComp' => 'RCPA_LM_COMP',
        'WriteDvpTableMap::COL_RCPA_LM_COMP' => 'RCPA_LM_COMP',
        'COL_RCPA_LM_COMP' => 'RCPA_LM_COMP',
        'rcpa_lm_comp' => 'RCPA_LM_COMP',
        'write_dvp.rcpa_lm_comp' => 'RCPA_LM_COMP',
        'RcpaCmOwn' => 'RCPA_CM_OWN',
        'WriteDvp.RcpaCmOwn' => 'RCPA_CM_OWN',
        'rcpaCmOwn' => 'RCPA_CM_OWN',
        'writeDvp.rcpaCmOwn' => 'RCPA_CM_OWN',
        'WriteDvpTableMap::COL_RCPA_CM_OWN' => 'RCPA_CM_OWN',
        'COL_RCPA_CM_OWN' => 'RCPA_CM_OWN',
        'rcpa_cm_own' => 'RCPA_CM_OWN',
        'write_dvp.rcpa_cm_own' => 'RCPA_CM_OWN',
        'RcpaCmComp' => 'RCPA_CM_COMP',
        'WriteDvp.RcpaCmComp' => 'RCPA_CM_COMP',
        'rcpaCmComp' => 'RCPA_CM_COMP',
        'writeDvp.rcpaCmComp' => 'RCPA_CM_COMP',
        'WriteDvpTableMap::COL_RCPA_CM_COMP' => 'RCPA_CM_COMP',
        'COL_RCPA_CM_COMP' => 'RCPA_CM_COMP',
        'rcpa_cm_comp' => 'RCPA_CM_COMP',
        'write_dvp.rcpa_cm_comp' => 'RCPA_CM_COMP',
        'SamplesSgpi' => 'SAMPLES_SGPI',
        'WriteDvp.SamplesSgpi' => 'SAMPLES_SGPI',
        'samplesSgpi' => 'SAMPLES_SGPI',
        'writeDvp.samplesSgpi' => 'SAMPLES_SGPI',
        'WriteDvpTableMap::COL_SAMPLES_SGPI' => 'SAMPLES_SGPI',
        'COL_SAMPLES_SGPI' => 'SAMPLES_SGPI',
        'samples_sgpi' => 'SAMPLES_SGPI',
        'write_dvp.samples_sgpi' => 'SAMPLES_SGPI',
        'GiftsSgpi' => 'GIFTS_SGPI',
        'WriteDvp.GiftsSgpi' => 'GIFTS_SGPI',
        'giftsSgpi' => 'GIFTS_SGPI',
        'writeDvp.giftsSgpi' => 'GIFTS_SGPI',
        'WriteDvpTableMap::COL_GIFTS_SGPI' => 'GIFTS_SGPI',
        'COL_GIFTS_SGPI' => 'GIFTS_SGPI',
        'gifts_sgpi' => 'GIFTS_SGPI',
        'write_dvp.gifts_sgpi' => 'GIFTS_SGPI',
        'PromoSgpi' => 'PROMO_SGPI',
        'WriteDvp.PromoSgpi' => 'PROMO_SGPI',
        'promoSgpi' => 'PROMO_SGPI',
        'writeDvp.promoSgpi' => 'PROMO_SGPI',
        'WriteDvpTableMap::COL_PROMO_SGPI' => 'PROMO_SGPI',
        'COL_PROMO_SGPI' => 'PROMO_SGPI',
        'promo_sgpi' => 'PROMO_SGPI',
        'write_dvp.promo_sgpi' => 'PROMO_SGPI',
        'ZmPositionCode' => 'ZM_POSITION_CODE',
        'WriteDvp.ZmPositionCode' => 'ZM_POSITION_CODE',
        'zmPositionCode' => 'ZM_POSITION_CODE',
        'writeDvp.zmPositionCode' => 'ZM_POSITION_CODE',
        'WriteDvpTableMap::COL_ZM_POSITION_CODE' => 'ZM_POSITION_CODE',
        'COL_ZM_POSITION_CODE' => 'ZM_POSITION_CODE',
        'zm_position_code' => 'ZM_POSITION_CODE',
        'write_dvp.zm_position_code' => 'ZM_POSITION_CODE',
        'RmPositionCode' => 'RM_POSITION_CODE',
        'WriteDvp.RmPositionCode' => 'RM_POSITION_CODE',
        'rmPositionCode' => 'RM_POSITION_CODE',
        'writeDvp.rmPositionCode' => 'RM_POSITION_CODE',
        'WriteDvpTableMap::COL_RM_POSITION_CODE' => 'RM_POSITION_CODE',
        'COL_RM_POSITION_CODE' => 'RM_POSITION_CODE',
        'rm_position_code' => 'RM_POSITION_CODE',
        'write_dvp.rm_position_code' => 'RM_POSITION_CODE',
        'AmPositionCode' => 'AM_POSITION_CODE',
        'WriteDvp.AmPositionCode' => 'AM_POSITION_CODE',
        'amPositionCode' => 'AM_POSITION_CODE',
        'writeDvp.amPositionCode' => 'AM_POSITION_CODE',
        'WriteDvpTableMap::COL_AM_POSITION_CODE' => 'AM_POSITION_CODE',
        'COL_AM_POSITION_CODE' => 'AM_POSITION_CODE',
        'am_position_code' => 'AM_POSITION_CODE',
        'write_dvp.am_position_code' => 'AM_POSITION_CODE',
        'EmployeePositionCode' => 'EMPLOYEE_POSITION_CODE',
        'WriteDvp.EmployeePositionCode' => 'EMPLOYEE_POSITION_CODE',
        'employeePositionCode' => 'EMPLOYEE_POSITION_CODE',
        'writeDvp.employeePositionCode' => 'EMPLOYEE_POSITION_CODE',
        'WriteDvpTableMap::COL_EMPLOYEE_POSITION_CODE' => 'EMPLOYEE_POSITION_CODE',
        'COL_EMPLOYEE_POSITION_CODE' => 'EMPLOYEE_POSITION_CODE',
        'employee_position_code' => 'EMPLOYEE_POSITION_CODE',
        'write_dvp.employee_position_code' => 'EMPLOYEE_POSITION_CODE',
        'EmployeePosition' => 'EMPLOYEE_POSITION',
        'WriteDvp.EmployeePosition' => 'EMPLOYEE_POSITION',
        'employeePosition' => 'EMPLOYEE_POSITION',
        'writeDvp.employeePosition' => 'EMPLOYEE_POSITION',
        'WriteDvpTableMap::COL_EMPLOYEE_POSITION' => 'EMPLOYEE_POSITION',
        'COL_EMPLOYEE_POSITION' => 'EMPLOYEE_POSITION',
        'employee_position' => 'EMPLOYEE_POSITION',
        'write_dvp.employee_position' => 'EMPLOYEE_POSITION',
        'EmployeeLevel' => 'EMPLOYEE_LEVEL',
        'WriteDvp.EmployeeLevel' => 'EMPLOYEE_LEVEL',
        'employeeLevel' => 'EMPLOYEE_LEVEL',
        'writeDvp.employeeLevel' => 'EMPLOYEE_LEVEL',
        'WriteDvpTableMap::COL_EMPLOYEE_LEVEL' => 'EMPLOYEE_LEVEL',
        'COL_EMPLOYEE_LEVEL' => 'EMPLOYEE_LEVEL',
        'employee_level' => 'EMPLOYEE_LEVEL',
        'write_dvp.employee_level' => 'EMPLOYEE_LEVEL',
        'Month' => 'MONTH',
        'WriteDvp.Month' => 'MONTH',
        'month' => 'MONTH',
        'writeDvp.month' => 'MONTH',
        'WriteDvpTableMap::COL_MONTH' => 'MONTH',
        'COL_MONTH' => 'MONTH',
        'write_dvp.month' => 'MONTH',
        'DvpReportId' => 'DVP_REPORT_ID',
        'WriteDvp.DvpReportId' => 'DVP_REPORT_ID',
        'dvpReportId' => 'DVP_REPORT_ID',
        'writeDvp.dvpReportId' => 'DVP_REPORT_ID',
        'WriteDvpTableMap::COL_DVP_REPORT_ID' => 'DVP_REPORT_ID',
        'COL_DVP_REPORT_ID' => 'DVP_REPORT_ID',
        'dvp_report_id' => 'DVP_REPORT_ID',
        'write_dvp.dvp_report_id' => 'DVP_REPORT_ID',
        'MrDetailing' => 'MR_DETAILING',
        'WriteDvp.MrDetailing' => 'MR_DETAILING',
        'mrDetailing' => 'MR_DETAILING',
        'writeDvp.mrDetailing' => 'MR_DETAILING',
        'WriteDvpTableMap::COL_MR_DETAILING' => 'MR_DETAILING',
        'COL_MR_DETAILING' => 'MR_DETAILING',
        'mr_detailing' => 'MR_DETAILING',
        'write_dvp.mr_detailing' => 'MR_DETAILING',
        'CreatedAt' => 'CREATED_AT',
        'WriteDvp.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'writeDvp.createdAt' => 'CREATED_AT',
        'WriteDvpTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'write_dvp.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'WriteDvp.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'writeDvp.updatedAt' => 'UPDATED_AT',
        'WriteDvpTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'write_dvp.updated_at' => 'UPDATED_AT',
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
        $this->setName('write_dvp');
        $this->setPhpName('WriteDvp');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\WriteDvp');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('write_dvp_dvp_report_id_seq');
        // columns
        $this->addColumn('org_unit', 'OrgUnit', 'VARCHAR', false, null, null);
        $this->addColumn('employee_code', 'EmployeeCode', 'VARCHAR', false, null, null);
        $this->addColumn('joining_date', 'JoiningDate', 'VARCHAR', false, null, null);
        $this->addColumn('am_position', 'AmPosition', 'VARCHAR', false, null, null);
        $this->addColumn('rm_position', 'RmPosition', 'VARCHAR', false, null, null);
        $this->addColumn('zm_position', 'ZmPosition', 'VARCHAR', false, null, null);
        $this->addColumn('location', 'Location', 'VARCHAR', false, null, null);
        $this->addColumn('status', 'Status', 'VARCHAR', false, null, null);
        $this->addColumn('employee_name', 'EmployeeName', 'VARCHAR', false, null, null);
        $this->addColumn('doctor_name', 'DoctorName', 'VARCHAR', false, null, null);
        $this->addColumn('doctor_code', 'DoctorCode', 'VARCHAR', false, null, null);
        $this->addColumn('town', 'Town', 'VARCHAR', false, null, null);
        $this->addColumn('patch', 'Patch', 'VARCHAR', false, null, null);
        $this->addColumn('speciality', 'Speciality', 'VARCHAR', false, null, null);
        $this->addColumn('tags', 'Tags', 'VARCHAR', false, null, null);
        $this->addColumn('visit_fq', 'VisitFq', 'VARCHAR', false, null, null);
        $this->addColumn('prescriber_classification', 'PrescriberClassification', 'VARCHAR', false, null, null);
        $this->addColumn('top_brand', 'TopBrand', 'VARCHAR', false, null, null);
        $this->addColumn('visit_dr', 'VisitDr', 'VARCHAR', false, null, null);
        $this->addColumn('am_visit_dr', 'AmVisitDr', 'VARCHAR', false, null, null);
        $this->addColumn('rm_visit_dr', 'RmVisitDr', 'VARCHAR', false, null, null);
        $this->addColumn('zm_visit_dr', 'ZmVisitDr', 'VARCHAR', false, null, null);
        $this->addColumn('rcpa_done', 'RcpaDone', 'VARCHAR', false, null, null);
        $this->addColumn('rcpa_lm_own', 'RcpaLmOwn', 'VARCHAR', false, null, null);
        $this->addColumn('rcpa_lm_comp', 'RcpaLmComp', 'VARCHAR', false, null, null);
        $this->addColumn('rcpa_cm_own', 'RcpaCmOwn', 'VARCHAR', false, null, null);
        $this->addColumn('rcpa_cm_comp', 'RcpaCmComp', 'VARCHAR', false, null, null);
        $this->addColumn('samples_sgpi', 'SamplesSgpi', 'VARCHAR', false, null, null);
        $this->addColumn('gifts_sgpi', 'GiftsSgpi', 'VARCHAR', false, null, null);
        $this->addColumn('promo_sgpi', 'PromoSgpi', 'VARCHAR', false, null, null);
        $this->addColumn('zm_position_code', 'ZmPositionCode', 'VARCHAR', false, null, null);
        $this->addColumn('rm_position_code', 'RmPositionCode', 'VARCHAR', false, null, null);
        $this->addColumn('am_position_code', 'AmPositionCode', 'VARCHAR', false, null, null);
        $this->addColumn('employee_position_code', 'EmployeePositionCode', 'VARCHAR', false, null, null);
        $this->addColumn('employee_position', 'EmployeePosition', 'VARCHAR', false, null, null);
        $this->addColumn('employee_level', 'EmployeeLevel', 'VARCHAR', false, null, null);
        $this->addColumn('month', 'Month', 'VARCHAR', false, null, null);
        $this->addPrimaryKey('dvp_report_id', 'DvpReportId', 'INTEGER', true, null, null);
        $this->addColumn('mr_detailing', 'MrDetailing', 'VARCHAR', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 37 + $offset : static::translateFieldName('DvpReportId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 37 + $offset : static::translateFieldName('DvpReportId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 37 + $offset : static::translateFieldName('DvpReportId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 37 + $offset : static::translateFieldName('DvpReportId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 37 + $offset : static::translateFieldName('DvpReportId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 37 + $offset : static::translateFieldName('DvpReportId', TableMap::TYPE_PHPNAME, $indexType)];
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
                ? 37 + $offset
                : self::translateFieldName('DvpReportId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? WriteDvpTableMap::CLASS_DEFAULT : WriteDvpTableMap::OM_CLASS;
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
     * @return array (WriteDvp object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = WriteDvpTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = WriteDvpTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + WriteDvpTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = WriteDvpTableMap::OM_CLASS;
            /** @var WriteDvp $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            WriteDvpTableMap::addInstanceToPool($obj, $key);
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
            $key = WriteDvpTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = WriteDvpTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var WriteDvp $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                WriteDvpTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(WriteDvpTableMap::COL_ORG_UNIT);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_EMPLOYEE_CODE);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_JOINING_DATE);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_AM_POSITION);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_RM_POSITION);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_ZM_POSITION);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_LOCATION);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_STATUS);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_EMPLOYEE_NAME);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_DOCTOR_NAME);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_DOCTOR_CODE);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_TOWN);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_PATCH);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_SPECIALITY);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_TAGS);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_VISIT_FQ);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_PRESCRIBER_CLASSIFICATION);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_TOP_BRAND);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_VISIT_DR);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_AM_VISIT_DR);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_RM_VISIT_DR);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_ZM_VISIT_DR);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_RCPA_DONE);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_RCPA_LM_OWN);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_RCPA_LM_COMP);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_RCPA_CM_OWN);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_RCPA_CM_COMP);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_SAMPLES_SGPI);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_GIFTS_SGPI);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_PROMO_SGPI);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_ZM_POSITION_CODE);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_RM_POSITION_CODE);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_AM_POSITION_CODE);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_EMPLOYEE_POSITION_CODE);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_EMPLOYEE_POSITION);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_EMPLOYEE_LEVEL);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_MONTH);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_DVP_REPORT_ID);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_MR_DETAILING);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(WriteDvpTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.org_unit');
            $criteria->addSelectColumn($alias . '.employee_code');
            $criteria->addSelectColumn($alias . '.joining_date');
            $criteria->addSelectColumn($alias . '.am_position');
            $criteria->addSelectColumn($alias . '.rm_position');
            $criteria->addSelectColumn($alias . '.zm_position');
            $criteria->addSelectColumn($alias . '.location');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.employee_name');
            $criteria->addSelectColumn($alias . '.doctor_name');
            $criteria->addSelectColumn($alias . '.doctor_code');
            $criteria->addSelectColumn($alias . '.town');
            $criteria->addSelectColumn($alias . '.patch');
            $criteria->addSelectColumn($alias . '.speciality');
            $criteria->addSelectColumn($alias . '.tags');
            $criteria->addSelectColumn($alias . '.visit_fq');
            $criteria->addSelectColumn($alias . '.prescriber_classification');
            $criteria->addSelectColumn($alias . '.top_brand');
            $criteria->addSelectColumn($alias . '.visit_dr');
            $criteria->addSelectColumn($alias . '.am_visit_dr');
            $criteria->addSelectColumn($alias . '.rm_visit_dr');
            $criteria->addSelectColumn($alias . '.zm_visit_dr');
            $criteria->addSelectColumn($alias . '.rcpa_done');
            $criteria->addSelectColumn($alias . '.rcpa_lm_own');
            $criteria->addSelectColumn($alias . '.rcpa_lm_comp');
            $criteria->addSelectColumn($alias . '.rcpa_cm_own');
            $criteria->addSelectColumn($alias . '.rcpa_cm_comp');
            $criteria->addSelectColumn($alias . '.samples_sgpi');
            $criteria->addSelectColumn($alias . '.gifts_sgpi');
            $criteria->addSelectColumn($alias . '.promo_sgpi');
            $criteria->addSelectColumn($alias . '.zm_position_code');
            $criteria->addSelectColumn($alias . '.rm_position_code');
            $criteria->addSelectColumn($alias . '.am_position_code');
            $criteria->addSelectColumn($alias . '.employee_position_code');
            $criteria->addSelectColumn($alias . '.employee_position');
            $criteria->addSelectColumn($alias . '.employee_level');
            $criteria->addSelectColumn($alias . '.month');
            $criteria->addSelectColumn($alias . '.dvp_report_id');
            $criteria->addSelectColumn($alias . '.mr_detailing');
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
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_ORG_UNIT);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_EMPLOYEE_CODE);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_JOINING_DATE);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_AM_POSITION);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_RM_POSITION);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_ZM_POSITION);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_LOCATION);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_STATUS);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_EMPLOYEE_NAME);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_DOCTOR_NAME);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_DOCTOR_CODE);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_TOWN);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_PATCH);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_SPECIALITY);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_TAGS);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_VISIT_FQ);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_PRESCRIBER_CLASSIFICATION);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_TOP_BRAND);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_VISIT_DR);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_AM_VISIT_DR);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_RM_VISIT_DR);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_ZM_VISIT_DR);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_RCPA_DONE);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_RCPA_LM_OWN);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_RCPA_LM_COMP);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_RCPA_CM_OWN);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_RCPA_CM_COMP);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_SAMPLES_SGPI);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_GIFTS_SGPI);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_PROMO_SGPI);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_ZM_POSITION_CODE);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_RM_POSITION_CODE);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_AM_POSITION_CODE);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_EMPLOYEE_POSITION_CODE);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_EMPLOYEE_POSITION);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_EMPLOYEE_LEVEL);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_MONTH);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_DVP_REPORT_ID);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_MR_DETAILING);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(WriteDvpTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.org_unit');
            $criteria->removeSelectColumn($alias . '.employee_code');
            $criteria->removeSelectColumn($alias . '.joining_date');
            $criteria->removeSelectColumn($alias . '.am_position');
            $criteria->removeSelectColumn($alias . '.rm_position');
            $criteria->removeSelectColumn($alias . '.zm_position');
            $criteria->removeSelectColumn($alias . '.location');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.employee_name');
            $criteria->removeSelectColumn($alias . '.doctor_name');
            $criteria->removeSelectColumn($alias . '.doctor_code');
            $criteria->removeSelectColumn($alias . '.town');
            $criteria->removeSelectColumn($alias . '.patch');
            $criteria->removeSelectColumn($alias . '.speciality');
            $criteria->removeSelectColumn($alias . '.tags');
            $criteria->removeSelectColumn($alias . '.visit_fq');
            $criteria->removeSelectColumn($alias . '.prescriber_classification');
            $criteria->removeSelectColumn($alias . '.top_brand');
            $criteria->removeSelectColumn($alias . '.visit_dr');
            $criteria->removeSelectColumn($alias . '.am_visit_dr');
            $criteria->removeSelectColumn($alias . '.rm_visit_dr');
            $criteria->removeSelectColumn($alias . '.zm_visit_dr');
            $criteria->removeSelectColumn($alias . '.rcpa_done');
            $criteria->removeSelectColumn($alias . '.rcpa_lm_own');
            $criteria->removeSelectColumn($alias . '.rcpa_lm_comp');
            $criteria->removeSelectColumn($alias . '.rcpa_cm_own');
            $criteria->removeSelectColumn($alias . '.rcpa_cm_comp');
            $criteria->removeSelectColumn($alias . '.samples_sgpi');
            $criteria->removeSelectColumn($alias . '.gifts_sgpi');
            $criteria->removeSelectColumn($alias . '.promo_sgpi');
            $criteria->removeSelectColumn($alias . '.zm_position_code');
            $criteria->removeSelectColumn($alias . '.rm_position_code');
            $criteria->removeSelectColumn($alias . '.am_position_code');
            $criteria->removeSelectColumn($alias . '.employee_position_code');
            $criteria->removeSelectColumn($alias . '.employee_position');
            $criteria->removeSelectColumn($alias . '.employee_level');
            $criteria->removeSelectColumn($alias . '.month');
            $criteria->removeSelectColumn($alias . '.dvp_report_id');
            $criteria->removeSelectColumn($alias . '.mr_detailing');
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
        return Propel::getServiceContainer()->getDatabaseMap(WriteDvpTableMap::DATABASE_NAME)->getTable(WriteDvpTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a WriteDvp or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or WriteDvp object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(WriteDvpTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\WriteDvp) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(WriteDvpTableMap::DATABASE_NAME);
            $criteria->add(WriteDvpTableMap::COL_DVP_REPORT_ID, (array) $values, Criteria::IN);
        }

        $query = WriteDvpQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            WriteDvpTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                WriteDvpTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the write_dvp table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return WriteDvpQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a WriteDvp or Criteria object.
     *
     * @param mixed $criteria Criteria or WriteDvp object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WriteDvpTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from WriteDvp object
        }

        if ($criteria->containsKey(WriteDvpTableMap::COL_DVP_REPORT_ID) && $criteria->keyContainsValue(WriteDvpTableMap::COL_DVP_REPORT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.WriteDvpTableMap::COL_DVP_REPORT_ID.')');
        }


        // Set the correct dbName
        $query = WriteDvpQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
