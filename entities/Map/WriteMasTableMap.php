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
use entities\WriteMas;
use entities\WriteMasQuery;


/**
 * This class defines the structure of the 'write_mas' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class WriteMasTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.WriteMasTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'write_mas';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'WriteMas';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\WriteMas';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.WriteMas';

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
     * the column name for the org_unit_name field
     */
    public const COL_ORG_UNIT_NAME = 'write_mas.org_unit_name';

    /**
     * the column name for the rep_code field
     */
    public const COL_REP_CODE = 'write_mas.rep_code';

    /**
     * the column name for the employee_code field
     */
    public const COL_EMPLOYEE_CODE = 'write_mas.employee_code';

    /**
     * the column name for the employee_name field
     */
    public const COL_EMPLOYEE_NAME = 'write_mas.employee_name';

    /**
     * the column name for the am_position field
     */
    public const COL_AM_POSITION = 'write_mas.am_position';

    /**
     * the column name for the rm_position field
     */
    public const COL_RM_POSITION = 'write_mas.rm_position';

    /**
     * the column name for the zm_position field
     */
    public const COL_ZM_POSITION = 'write_mas.zm_position';

    /**
     * the column name for the location field
     */
    public const COL_LOCATION = 'write_mas.location';

    /**
     * the column name for the month_year field
     */
    public const COL_MONTH_YEAR = 'write_mas.month_year';

    /**
     * the column name for the working_days field
     */
    public const COL_WORKING_DAYS = 'write_mas.working_days';

    /**
     * the column name for the fwd field
     */
    public const COL_FWD = 'write_mas.fwd';

    /**
     * the column name for the nca field
     */
    public const COL_NCA = 'write_mas.nca';

    /**
     * the column name for the total_doctors field
     */
    public const COL_TOTAL_DOCTORS = 'write_mas.total_doctors';

    /**
     * the column name for the dr_met field
     */
    public const COL_DR_MET = 'write_mas.dr_met';

    /**
     * the column name for the dr_vf_met field
     */
    public const COL_DR_VF_MET = 'write_mas.dr_vf_met';

    /**
     * the column name for the drca_l field
     */
    public const COL_DRCA_L = 'write_mas.drca_l';

    /**
     * the column name for the drcvrg field
     */
    public const COL_DRCVRG = 'write_mas.drcvrg';

    /**
     * the column name for the drvfcvrg field
     */
    public const COL_DRVFCVRG = 'write_mas.drvfcvrg';

    /**
     * the column name for the missed_dr field
     */
    public const COL_MISSED_DR = 'write_mas.missed_dr';

    /**
     * the column name for the missed_dr_calls field
     */
    public const COL_MISSED_DR_CALLS = 'write_mas.missed_dr_calls';

    /**
     * the column name for the total_chemist field
     */
    public const COL_TOTAL_CHEMIST = 'write_mas.total_chemist';

    /**
     * the column name for the pob_value field
     */
    public const COL_POB_VALUE = 'write_mas.pob_value';

    /**
     * the column name for the rcpa_value_for_own_brand field
     */
    public const COL_RCPA_VALUE_FOR_OWN_BRAND = 'write_mas.rcpa_value_for_own_brand';

    /**
     * the column name for the rcpa_value_for_comp_brand field
     */
    public const COL_RCPA_VALUE_FOR_COMP_BRAND = 'write_mas.rcpa_value_for_comp_brand';

    /**
     * the column name for the joint_work_total_calls field
     */
    public const COL_JOINT_WORK_TOTAL_CALLS = 'write_mas.joint_work_total_calls';

    /**
     * the column name for the leave_days field
     */
    public const COL_LEAVE_DAYS = 'write_mas.leave_days';

    /**
     * the column name for the joint_working field
     */
    public const COL_JOINT_WORKING = 'write_mas.joint_working';

    /**
     * the column name for the no_dr_call field
     */
    public const COL_NO_DR_CALL = 'write_mas.no_dr_call';

    /**
     * the column name for the agenda field
     */
    public const COL_AGENDA = 'write_mas.agenda';

    /**
     * the column name for the zm_position_code field
     */
    public const COL_ZM_POSITION_CODE = 'write_mas.zm_position_code';

    /**
     * the column name for the rm_position_code field
     */
    public const COL_RM_POSITION_CODE = 'write_mas.rm_position_code';

    /**
     * the column name for the am_position_code field
     */
    public const COL_AM_POSITION_CODE = 'write_mas.am_position_code';

    /**
     * the column name for the employee_status field
     */
    public const COL_EMPLOYEE_STATUS = 'write_mas.employee_status';

    /**
     * the column name for the employee_position_code field
     */
    public const COL_EMPLOYEE_POSITION_CODE = 'write_mas.employee_position_code';

    /**
     * the column name for the employee_position_name field
     */
    public const COL_EMPLOYEE_POSITION_NAME = 'write_mas.employee_position_name';

    /**
     * the column name for the employee_level field
     */
    public const COL_EMPLOYEE_LEVEL = 'write_mas.employee_level';

    /**
     * the column name for the mas_report_id field
     */
    public const COL_MAS_REPORT_ID = 'write_mas.mas_report_id';

    /**
     * the column name for the chemist_met field
     */
    public const COL_CHEMIST_MET = 'write_mas.chemist_met';

    /**
     * the column name for the chemist_calls field
     */
    public const COL_CHEMIST_CALLS = 'write_mas.chemist_calls';

    /**
     * the column name for the chemist_call_avg field
     */
    public const COL_CHEMIST_CALL_AVG = 'write_mas.chemist_call_avg';

    /**
     * the column name for the total_stockists field
     */
    public const COL_TOTAL_STOCKISTS = 'write_mas.total_stockists';

    /**
     * the column name for the dr_addition field
     */
    public const COL_DR_ADDITION = 'write_mas.dr_addition';

    /**
     * the column name for the dr_deletion field
     */
    public const COL_DR_DELETION = 'write_mas.dr_deletion';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'write_mas.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'write_mas.updated_at';

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
        self::TYPE_PHPNAME       => ['OrgUnitName', 'RepCode', 'EmployeeCode', 'EmployeeName', 'AmPosition', 'RmPosition', 'ZmPosition', 'Location', 'MonthYear', 'WorkingDays', 'Fwd', 'Nca', 'TotalDoctors', 'DrMet', 'DrVfMet', 'DrcaL', 'Drcvrg', 'Drvfcvrg', 'MissedDr', 'MissedDrCalls', 'TotalChemist', 'PobValue', 'RcpaValueForOwnBrand', 'RcpaValueForCompBrand', 'JointWorkTotalCalls', 'LeaveDays', 'JointWorking', 'NoDrCall', 'Agenda', 'ZmPositionCode', 'RmPositionCode', 'AmPositionCode', 'EmployeeStatus', 'EmployeePositionCode', 'EmployeePositionName', 'EmployeeLevel', 'MasReportId', 'ChemistMet', 'ChemistCalls', 'ChemistCallAvg', 'TotalStockists', 'DrAddition', 'DrDeletion', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['orgUnitName', 'repCode', 'employeeCode', 'employeeName', 'amPosition', 'rmPosition', 'zmPosition', 'location', 'monthYear', 'workingDays', 'fwd', 'nca', 'totalDoctors', 'drMet', 'drVfMet', 'drcaL', 'drcvrg', 'drvfcvrg', 'missedDr', 'missedDrCalls', 'totalChemist', 'pobValue', 'rcpaValueForOwnBrand', 'rcpaValueForCompBrand', 'jointWorkTotalCalls', 'leaveDays', 'jointWorking', 'noDrCall', 'agenda', 'zmPositionCode', 'rmPositionCode', 'amPositionCode', 'employeeStatus', 'employeePositionCode', 'employeePositionName', 'employeeLevel', 'masReportId', 'chemistMet', 'chemistCalls', 'chemistCallAvg', 'totalStockists', 'drAddition', 'drDeletion', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [WriteMasTableMap::COL_ORG_UNIT_NAME, WriteMasTableMap::COL_REP_CODE, WriteMasTableMap::COL_EMPLOYEE_CODE, WriteMasTableMap::COL_EMPLOYEE_NAME, WriteMasTableMap::COL_AM_POSITION, WriteMasTableMap::COL_RM_POSITION, WriteMasTableMap::COL_ZM_POSITION, WriteMasTableMap::COL_LOCATION, WriteMasTableMap::COL_MONTH_YEAR, WriteMasTableMap::COL_WORKING_DAYS, WriteMasTableMap::COL_FWD, WriteMasTableMap::COL_NCA, WriteMasTableMap::COL_TOTAL_DOCTORS, WriteMasTableMap::COL_DR_MET, WriteMasTableMap::COL_DR_VF_MET, WriteMasTableMap::COL_DRCA_L, WriteMasTableMap::COL_DRCVRG, WriteMasTableMap::COL_DRVFCVRG, WriteMasTableMap::COL_MISSED_DR, WriteMasTableMap::COL_MISSED_DR_CALLS, WriteMasTableMap::COL_TOTAL_CHEMIST, WriteMasTableMap::COL_POB_VALUE, WriteMasTableMap::COL_RCPA_VALUE_FOR_OWN_BRAND, WriteMasTableMap::COL_RCPA_VALUE_FOR_COMP_BRAND, WriteMasTableMap::COL_JOINT_WORK_TOTAL_CALLS, WriteMasTableMap::COL_LEAVE_DAYS, WriteMasTableMap::COL_JOINT_WORKING, WriteMasTableMap::COL_NO_DR_CALL, WriteMasTableMap::COL_AGENDA, WriteMasTableMap::COL_ZM_POSITION_CODE, WriteMasTableMap::COL_RM_POSITION_CODE, WriteMasTableMap::COL_AM_POSITION_CODE, WriteMasTableMap::COL_EMPLOYEE_STATUS, WriteMasTableMap::COL_EMPLOYEE_POSITION_CODE, WriteMasTableMap::COL_EMPLOYEE_POSITION_NAME, WriteMasTableMap::COL_EMPLOYEE_LEVEL, WriteMasTableMap::COL_MAS_REPORT_ID, WriteMasTableMap::COL_CHEMIST_MET, WriteMasTableMap::COL_CHEMIST_CALLS, WriteMasTableMap::COL_CHEMIST_CALL_AVG, WriteMasTableMap::COL_TOTAL_STOCKISTS, WriteMasTableMap::COL_DR_ADDITION, WriteMasTableMap::COL_DR_DELETION, WriteMasTableMap::COL_CREATED_AT, WriteMasTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['org_unit_name', 'rep_code', 'employee_code', 'employee_name', 'am_position', 'rm_position', 'zm_position', 'location', 'month_year', 'working_days', 'fwd', 'nca', 'total_doctors', 'dr_met', 'dr_vf_met', 'drca_l', 'drcvrg', 'drvfcvrg', 'missed_dr', 'missed_dr_calls', 'total_chemist', 'pob_value', 'rcpa_value_for_own_brand', 'rcpa_value_for_comp_brand', 'joint_work_total_calls', 'leave_days', 'joint_working', 'no_dr_call', 'agenda', 'zm_position_code', 'rm_position_code', 'am_position_code', 'employee_status', 'employee_position_code', 'employee_position_name', 'employee_level', 'mas_report_id', 'chemist_met', 'chemist_calls', 'chemist_call_avg', 'total_stockists', 'dr_addition', 'dr_deletion', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['OrgUnitName' => 0, 'RepCode' => 1, 'EmployeeCode' => 2, 'EmployeeName' => 3, 'AmPosition' => 4, 'RmPosition' => 5, 'ZmPosition' => 6, 'Location' => 7, 'MonthYear' => 8, 'WorkingDays' => 9, 'Fwd' => 10, 'Nca' => 11, 'TotalDoctors' => 12, 'DrMet' => 13, 'DrVfMet' => 14, 'DrcaL' => 15, 'Drcvrg' => 16, 'Drvfcvrg' => 17, 'MissedDr' => 18, 'MissedDrCalls' => 19, 'TotalChemist' => 20, 'PobValue' => 21, 'RcpaValueForOwnBrand' => 22, 'RcpaValueForCompBrand' => 23, 'JointWorkTotalCalls' => 24, 'LeaveDays' => 25, 'JointWorking' => 26, 'NoDrCall' => 27, 'Agenda' => 28, 'ZmPositionCode' => 29, 'RmPositionCode' => 30, 'AmPositionCode' => 31, 'EmployeeStatus' => 32, 'EmployeePositionCode' => 33, 'EmployeePositionName' => 34, 'EmployeeLevel' => 35, 'MasReportId' => 36, 'ChemistMet' => 37, 'ChemistCalls' => 38, 'ChemistCallAvg' => 39, 'TotalStockists' => 40, 'DrAddition' => 41, 'DrDeletion' => 42, 'CreatedAt' => 43, 'UpdatedAt' => 44, ],
        self::TYPE_CAMELNAME     => ['orgUnitName' => 0, 'repCode' => 1, 'employeeCode' => 2, 'employeeName' => 3, 'amPosition' => 4, 'rmPosition' => 5, 'zmPosition' => 6, 'location' => 7, 'monthYear' => 8, 'workingDays' => 9, 'fwd' => 10, 'nca' => 11, 'totalDoctors' => 12, 'drMet' => 13, 'drVfMet' => 14, 'drcaL' => 15, 'drcvrg' => 16, 'drvfcvrg' => 17, 'missedDr' => 18, 'missedDrCalls' => 19, 'totalChemist' => 20, 'pobValue' => 21, 'rcpaValueForOwnBrand' => 22, 'rcpaValueForCompBrand' => 23, 'jointWorkTotalCalls' => 24, 'leaveDays' => 25, 'jointWorking' => 26, 'noDrCall' => 27, 'agenda' => 28, 'zmPositionCode' => 29, 'rmPositionCode' => 30, 'amPositionCode' => 31, 'employeeStatus' => 32, 'employeePositionCode' => 33, 'employeePositionName' => 34, 'employeeLevel' => 35, 'masReportId' => 36, 'chemistMet' => 37, 'chemistCalls' => 38, 'chemistCallAvg' => 39, 'totalStockists' => 40, 'drAddition' => 41, 'drDeletion' => 42, 'createdAt' => 43, 'updatedAt' => 44, ],
        self::TYPE_COLNAME       => [WriteMasTableMap::COL_ORG_UNIT_NAME => 0, WriteMasTableMap::COL_REP_CODE => 1, WriteMasTableMap::COL_EMPLOYEE_CODE => 2, WriteMasTableMap::COL_EMPLOYEE_NAME => 3, WriteMasTableMap::COL_AM_POSITION => 4, WriteMasTableMap::COL_RM_POSITION => 5, WriteMasTableMap::COL_ZM_POSITION => 6, WriteMasTableMap::COL_LOCATION => 7, WriteMasTableMap::COL_MONTH_YEAR => 8, WriteMasTableMap::COL_WORKING_DAYS => 9, WriteMasTableMap::COL_FWD => 10, WriteMasTableMap::COL_NCA => 11, WriteMasTableMap::COL_TOTAL_DOCTORS => 12, WriteMasTableMap::COL_DR_MET => 13, WriteMasTableMap::COL_DR_VF_MET => 14, WriteMasTableMap::COL_DRCA_L => 15, WriteMasTableMap::COL_DRCVRG => 16, WriteMasTableMap::COL_DRVFCVRG => 17, WriteMasTableMap::COL_MISSED_DR => 18, WriteMasTableMap::COL_MISSED_DR_CALLS => 19, WriteMasTableMap::COL_TOTAL_CHEMIST => 20, WriteMasTableMap::COL_POB_VALUE => 21, WriteMasTableMap::COL_RCPA_VALUE_FOR_OWN_BRAND => 22, WriteMasTableMap::COL_RCPA_VALUE_FOR_COMP_BRAND => 23, WriteMasTableMap::COL_JOINT_WORK_TOTAL_CALLS => 24, WriteMasTableMap::COL_LEAVE_DAYS => 25, WriteMasTableMap::COL_JOINT_WORKING => 26, WriteMasTableMap::COL_NO_DR_CALL => 27, WriteMasTableMap::COL_AGENDA => 28, WriteMasTableMap::COL_ZM_POSITION_CODE => 29, WriteMasTableMap::COL_RM_POSITION_CODE => 30, WriteMasTableMap::COL_AM_POSITION_CODE => 31, WriteMasTableMap::COL_EMPLOYEE_STATUS => 32, WriteMasTableMap::COL_EMPLOYEE_POSITION_CODE => 33, WriteMasTableMap::COL_EMPLOYEE_POSITION_NAME => 34, WriteMasTableMap::COL_EMPLOYEE_LEVEL => 35, WriteMasTableMap::COL_MAS_REPORT_ID => 36, WriteMasTableMap::COL_CHEMIST_MET => 37, WriteMasTableMap::COL_CHEMIST_CALLS => 38, WriteMasTableMap::COL_CHEMIST_CALL_AVG => 39, WriteMasTableMap::COL_TOTAL_STOCKISTS => 40, WriteMasTableMap::COL_DR_ADDITION => 41, WriteMasTableMap::COL_DR_DELETION => 42, WriteMasTableMap::COL_CREATED_AT => 43, WriteMasTableMap::COL_UPDATED_AT => 44, ],
        self::TYPE_FIELDNAME     => ['org_unit_name' => 0, 'rep_code' => 1, 'employee_code' => 2, 'employee_name' => 3, 'am_position' => 4, 'rm_position' => 5, 'zm_position' => 6, 'location' => 7, 'month_year' => 8, 'working_days' => 9, 'fwd' => 10, 'nca' => 11, 'total_doctors' => 12, 'dr_met' => 13, 'dr_vf_met' => 14, 'drca_l' => 15, 'drcvrg' => 16, 'drvfcvrg' => 17, 'missed_dr' => 18, 'missed_dr_calls' => 19, 'total_chemist' => 20, 'pob_value' => 21, 'rcpa_value_for_own_brand' => 22, 'rcpa_value_for_comp_brand' => 23, 'joint_work_total_calls' => 24, 'leave_days' => 25, 'joint_working' => 26, 'no_dr_call' => 27, 'agenda' => 28, 'zm_position_code' => 29, 'rm_position_code' => 30, 'am_position_code' => 31, 'employee_status' => 32, 'employee_position_code' => 33, 'employee_position_name' => 34, 'employee_level' => 35, 'mas_report_id' => 36, 'chemist_met' => 37, 'chemist_calls' => 38, 'chemist_call_avg' => 39, 'total_stockists' => 40, 'dr_addition' => 41, 'dr_deletion' => 42, 'created_at' => 43, 'updated_at' => 44, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OrgUnitName' => 'ORG_UNIT_NAME',
        'WriteMas.OrgUnitName' => 'ORG_UNIT_NAME',
        'orgUnitName' => 'ORG_UNIT_NAME',
        'writeMas.orgUnitName' => 'ORG_UNIT_NAME',
        'WriteMasTableMap::COL_ORG_UNIT_NAME' => 'ORG_UNIT_NAME',
        'COL_ORG_UNIT_NAME' => 'ORG_UNIT_NAME',
        'org_unit_name' => 'ORG_UNIT_NAME',
        'write_mas.org_unit_name' => 'ORG_UNIT_NAME',
        'RepCode' => 'REP_CODE',
        'WriteMas.RepCode' => 'REP_CODE',
        'repCode' => 'REP_CODE',
        'writeMas.repCode' => 'REP_CODE',
        'WriteMasTableMap::COL_REP_CODE' => 'REP_CODE',
        'COL_REP_CODE' => 'REP_CODE',
        'rep_code' => 'REP_CODE',
        'write_mas.rep_code' => 'REP_CODE',
        'EmployeeCode' => 'EMPLOYEE_CODE',
        'WriteMas.EmployeeCode' => 'EMPLOYEE_CODE',
        'employeeCode' => 'EMPLOYEE_CODE',
        'writeMas.employeeCode' => 'EMPLOYEE_CODE',
        'WriteMasTableMap::COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'employee_code' => 'EMPLOYEE_CODE',
        'write_mas.employee_code' => 'EMPLOYEE_CODE',
        'EmployeeName' => 'EMPLOYEE_NAME',
        'WriteMas.EmployeeName' => 'EMPLOYEE_NAME',
        'employeeName' => 'EMPLOYEE_NAME',
        'writeMas.employeeName' => 'EMPLOYEE_NAME',
        'WriteMasTableMap::COL_EMPLOYEE_NAME' => 'EMPLOYEE_NAME',
        'COL_EMPLOYEE_NAME' => 'EMPLOYEE_NAME',
        'employee_name' => 'EMPLOYEE_NAME',
        'write_mas.employee_name' => 'EMPLOYEE_NAME',
        'AmPosition' => 'AM_POSITION',
        'WriteMas.AmPosition' => 'AM_POSITION',
        'amPosition' => 'AM_POSITION',
        'writeMas.amPosition' => 'AM_POSITION',
        'WriteMasTableMap::COL_AM_POSITION' => 'AM_POSITION',
        'COL_AM_POSITION' => 'AM_POSITION',
        'am_position' => 'AM_POSITION',
        'write_mas.am_position' => 'AM_POSITION',
        'RmPosition' => 'RM_POSITION',
        'WriteMas.RmPosition' => 'RM_POSITION',
        'rmPosition' => 'RM_POSITION',
        'writeMas.rmPosition' => 'RM_POSITION',
        'WriteMasTableMap::COL_RM_POSITION' => 'RM_POSITION',
        'COL_RM_POSITION' => 'RM_POSITION',
        'rm_position' => 'RM_POSITION',
        'write_mas.rm_position' => 'RM_POSITION',
        'ZmPosition' => 'ZM_POSITION',
        'WriteMas.ZmPosition' => 'ZM_POSITION',
        'zmPosition' => 'ZM_POSITION',
        'writeMas.zmPosition' => 'ZM_POSITION',
        'WriteMasTableMap::COL_ZM_POSITION' => 'ZM_POSITION',
        'COL_ZM_POSITION' => 'ZM_POSITION',
        'zm_position' => 'ZM_POSITION',
        'write_mas.zm_position' => 'ZM_POSITION',
        'Location' => 'LOCATION',
        'WriteMas.Location' => 'LOCATION',
        'location' => 'LOCATION',
        'writeMas.location' => 'LOCATION',
        'WriteMasTableMap::COL_LOCATION' => 'LOCATION',
        'COL_LOCATION' => 'LOCATION',
        'write_mas.location' => 'LOCATION',
        'MonthYear' => 'MONTH_YEAR',
        'WriteMas.MonthYear' => 'MONTH_YEAR',
        'monthYear' => 'MONTH_YEAR',
        'writeMas.monthYear' => 'MONTH_YEAR',
        'WriteMasTableMap::COL_MONTH_YEAR' => 'MONTH_YEAR',
        'COL_MONTH_YEAR' => 'MONTH_YEAR',
        'month_year' => 'MONTH_YEAR',
        'write_mas.month_year' => 'MONTH_YEAR',
        'WorkingDays' => 'WORKING_DAYS',
        'WriteMas.WorkingDays' => 'WORKING_DAYS',
        'workingDays' => 'WORKING_DAYS',
        'writeMas.workingDays' => 'WORKING_DAYS',
        'WriteMasTableMap::COL_WORKING_DAYS' => 'WORKING_DAYS',
        'COL_WORKING_DAYS' => 'WORKING_DAYS',
        'working_days' => 'WORKING_DAYS',
        'write_mas.working_days' => 'WORKING_DAYS',
        'Fwd' => 'FWD',
        'WriteMas.Fwd' => 'FWD',
        'fwd' => 'FWD',
        'writeMas.fwd' => 'FWD',
        'WriteMasTableMap::COL_FWD' => 'FWD',
        'COL_FWD' => 'FWD',
        'write_mas.fwd' => 'FWD',
        'Nca' => 'NCA',
        'WriteMas.Nca' => 'NCA',
        'nca' => 'NCA',
        'writeMas.nca' => 'NCA',
        'WriteMasTableMap::COL_NCA' => 'NCA',
        'COL_NCA' => 'NCA',
        'write_mas.nca' => 'NCA',
        'TotalDoctors' => 'TOTAL_DOCTORS',
        'WriteMas.TotalDoctors' => 'TOTAL_DOCTORS',
        'totalDoctors' => 'TOTAL_DOCTORS',
        'writeMas.totalDoctors' => 'TOTAL_DOCTORS',
        'WriteMasTableMap::COL_TOTAL_DOCTORS' => 'TOTAL_DOCTORS',
        'COL_TOTAL_DOCTORS' => 'TOTAL_DOCTORS',
        'total_doctors' => 'TOTAL_DOCTORS',
        'write_mas.total_doctors' => 'TOTAL_DOCTORS',
        'DrMet' => 'DR_MET',
        'WriteMas.DrMet' => 'DR_MET',
        'drMet' => 'DR_MET',
        'writeMas.drMet' => 'DR_MET',
        'WriteMasTableMap::COL_DR_MET' => 'DR_MET',
        'COL_DR_MET' => 'DR_MET',
        'dr_met' => 'DR_MET',
        'write_mas.dr_met' => 'DR_MET',
        'DrVfMet' => 'DR_VF_MET',
        'WriteMas.DrVfMet' => 'DR_VF_MET',
        'drVfMet' => 'DR_VF_MET',
        'writeMas.drVfMet' => 'DR_VF_MET',
        'WriteMasTableMap::COL_DR_VF_MET' => 'DR_VF_MET',
        'COL_DR_VF_MET' => 'DR_VF_MET',
        'dr_vf_met' => 'DR_VF_MET',
        'write_mas.dr_vf_met' => 'DR_VF_MET',
        'DrcaL' => 'DRCA_L',
        'WriteMas.DrcaL' => 'DRCA_L',
        'drcaL' => 'DRCA_L',
        'writeMas.drcaL' => 'DRCA_L',
        'WriteMasTableMap::COL_DRCA_L' => 'DRCA_L',
        'COL_DRCA_L' => 'DRCA_L',
        'drca_l' => 'DRCA_L',
        'write_mas.drca_l' => 'DRCA_L',
        'Drcvrg' => 'DRCVRG',
        'WriteMas.Drcvrg' => 'DRCVRG',
        'drcvrg' => 'DRCVRG',
        'writeMas.drcvrg' => 'DRCVRG',
        'WriteMasTableMap::COL_DRCVRG' => 'DRCVRG',
        'COL_DRCVRG' => 'DRCVRG',
        'write_mas.drcvrg' => 'DRCVRG',
        'Drvfcvrg' => 'DRVFCVRG',
        'WriteMas.Drvfcvrg' => 'DRVFCVRG',
        'drvfcvrg' => 'DRVFCVRG',
        'writeMas.drvfcvrg' => 'DRVFCVRG',
        'WriteMasTableMap::COL_DRVFCVRG' => 'DRVFCVRG',
        'COL_DRVFCVRG' => 'DRVFCVRG',
        'write_mas.drvfcvrg' => 'DRVFCVRG',
        'MissedDr' => 'MISSED_DR',
        'WriteMas.MissedDr' => 'MISSED_DR',
        'missedDr' => 'MISSED_DR',
        'writeMas.missedDr' => 'MISSED_DR',
        'WriteMasTableMap::COL_MISSED_DR' => 'MISSED_DR',
        'COL_MISSED_DR' => 'MISSED_DR',
        'missed_dr' => 'MISSED_DR',
        'write_mas.missed_dr' => 'MISSED_DR',
        'MissedDrCalls' => 'MISSED_DR_CALLS',
        'WriteMas.MissedDrCalls' => 'MISSED_DR_CALLS',
        'missedDrCalls' => 'MISSED_DR_CALLS',
        'writeMas.missedDrCalls' => 'MISSED_DR_CALLS',
        'WriteMasTableMap::COL_MISSED_DR_CALLS' => 'MISSED_DR_CALLS',
        'COL_MISSED_DR_CALLS' => 'MISSED_DR_CALLS',
        'missed_dr_calls' => 'MISSED_DR_CALLS',
        'write_mas.missed_dr_calls' => 'MISSED_DR_CALLS',
        'TotalChemist' => 'TOTAL_CHEMIST',
        'WriteMas.TotalChemist' => 'TOTAL_CHEMIST',
        'totalChemist' => 'TOTAL_CHEMIST',
        'writeMas.totalChemist' => 'TOTAL_CHEMIST',
        'WriteMasTableMap::COL_TOTAL_CHEMIST' => 'TOTAL_CHEMIST',
        'COL_TOTAL_CHEMIST' => 'TOTAL_CHEMIST',
        'total_chemist' => 'TOTAL_CHEMIST',
        'write_mas.total_chemist' => 'TOTAL_CHEMIST',
        'PobValue' => 'POB_VALUE',
        'WriteMas.PobValue' => 'POB_VALUE',
        'pobValue' => 'POB_VALUE',
        'writeMas.pobValue' => 'POB_VALUE',
        'WriteMasTableMap::COL_POB_VALUE' => 'POB_VALUE',
        'COL_POB_VALUE' => 'POB_VALUE',
        'pob_value' => 'POB_VALUE',
        'write_mas.pob_value' => 'POB_VALUE',
        'RcpaValueForOwnBrand' => 'RCPA_VALUE_FOR_OWN_BRAND',
        'WriteMas.RcpaValueForOwnBrand' => 'RCPA_VALUE_FOR_OWN_BRAND',
        'rcpaValueForOwnBrand' => 'RCPA_VALUE_FOR_OWN_BRAND',
        'writeMas.rcpaValueForOwnBrand' => 'RCPA_VALUE_FOR_OWN_BRAND',
        'WriteMasTableMap::COL_RCPA_VALUE_FOR_OWN_BRAND' => 'RCPA_VALUE_FOR_OWN_BRAND',
        'COL_RCPA_VALUE_FOR_OWN_BRAND' => 'RCPA_VALUE_FOR_OWN_BRAND',
        'rcpa_value_for_own_brand' => 'RCPA_VALUE_FOR_OWN_BRAND',
        'write_mas.rcpa_value_for_own_brand' => 'RCPA_VALUE_FOR_OWN_BRAND',
        'RcpaValueForCompBrand' => 'RCPA_VALUE_FOR_COMP_BRAND',
        'WriteMas.RcpaValueForCompBrand' => 'RCPA_VALUE_FOR_COMP_BRAND',
        'rcpaValueForCompBrand' => 'RCPA_VALUE_FOR_COMP_BRAND',
        'writeMas.rcpaValueForCompBrand' => 'RCPA_VALUE_FOR_COMP_BRAND',
        'WriteMasTableMap::COL_RCPA_VALUE_FOR_COMP_BRAND' => 'RCPA_VALUE_FOR_COMP_BRAND',
        'COL_RCPA_VALUE_FOR_COMP_BRAND' => 'RCPA_VALUE_FOR_COMP_BRAND',
        'rcpa_value_for_comp_brand' => 'RCPA_VALUE_FOR_COMP_BRAND',
        'write_mas.rcpa_value_for_comp_brand' => 'RCPA_VALUE_FOR_COMP_BRAND',
        'JointWorkTotalCalls' => 'JOINT_WORK_TOTAL_CALLS',
        'WriteMas.JointWorkTotalCalls' => 'JOINT_WORK_TOTAL_CALLS',
        'jointWorkTotalCalls' => 'JOINT_WORK_TOTAL_CALLS',
        'writeMas.jointWorkTotalCalls' => 'JOINT_WORK_TOTAL_CALLS',
        'WriteMasTableMap::COL_JOINT_WORK_TOTAL_CALLS' => 'JOINT_WORK_TOTAL_CALLS',
        'COL_JOINT_WORK_TOTAL_CALLS' => 'JOINT_WORK_TOTAL_CALLS',
        'joint_work_total_calls' => 'JOINT_WORK_TOTAL_CALLS',
        'write_mas.joint_work_total_calls' => 'JOINT_WORK_TOTAL_CALLS',
        'LeaveDays' => 'LEAVE_DAYS',
        'WriteMas.LeaveDays' => 'LEAVE_DAYS',
        'leaveDays' => 'LEAVE_DAYS',
        'writeMas.leaveDays' => 'LEAVE_DAYS',
        'WriteMasTableMap::COL_LEAVE_DAYS' => 'LEAVE_DAYS',
        'COL_LEAVE_DAYS' => 'LEAVE_DAYS',
        'leave_days' => 'LEAVE_DAYS',
        'write_mas.leave_days' => 'LEAVE_DAYS',
        'JointWorking' => 'JOINT_WORKING',
        'WriteMas.JointWorking' => 'JOINT_WORKING',
        'jointWorking' => 'JOINT_WORKING',
        'writeMas.jointWorking' => 'JOINT_WORKING',
        'WriteMasTableMap::COL_JOINT_WORKING' => 'JOINT_WORKING',
        'COL_JOINT_WORKING' => 'JOINT_WORKING',
        'joint_working' => 'JOINT_WORKING',
        'write_mas.joint_working' => 'JOINT_WORKING',
        'NoDrCall' => 'NO_DR_CALL',
        'WriteMas.NoDrCall' => 'NO_DR_CALL',
        'noDrCall' => 'NO_DR_CALL',
        'writeMas.noDrCall' => 'NO_DR_CALL',
        'WriteMasTableMap::COL_NO_DR_CALL' => 'NO_DR_CALL',
        'COL_NO_DR_CALL' => 'NO_DR_CALL',
        'no_dr_call' => 'NO_DR_CALL',
        'write_mas.no_dr_call' => 'NO_DR_CALL',
        'Agenda' => 'AGENDA',
        'WriteMas.Agenda' => 'AGENDA',
        'agenda' => 'AGENDA',
        'writeMas.agenda' => 'AGENDA',
        'WriteMasTableMap::COL_AGENDA' => 'AGENDA',
        'COL_AGENDA' => 'AGENDA',
        'write_mas.agenda' => 'AGENDA',
        'ZmPositionCode' => 'ZM_POSITION_CODE',
        'WriteMas.ZmPositionCode' => 'ZM_POSITION_CODE',
        'zmPositionCode' => 'ZM_POSITION_CODE',
        'writeMas.zmPositionCode' => 'ZM_POSITION_CODE',
        'WriteMasTableMap::COL_ZM_POSITION_CODE' => 'ZM_POSITION_CODE',
        'COL_ZM_POSITION_CODE' => 'ZM_POSITION_CODE',
        'zm_position_code' => 'ZM_POSITION_CODE',
        'write_mas.zm_position_code' => 'ZM_POSITION_CODE',
        'RmPositionCode' => 'RM_POSITION_CODE',
        'WriteMas.RmPositionCode' => 'RM_POSITION_CODE',
        'rmPositionCode' => 'RM_POSITION_CODE',
        'writeMas.rmPositionCode' => 'RM_POSITION_CODE',
        'WriteMasTableMap::COL_RM_POSITION_CODE' => 'RM_POSITION_CODE',
        'COL_RM_POSITION_CODE' => 'RM_POSITION_CODE',
        'rm_position_code' => 'RM_POSITION_CODE',
        'write_mas.rm_position_code' => 'RM_POSITION_CODE',
        'AmPositionCode' => 'AM_POSITION_CODE',
        'WriteMas.AmPositionCode' => 'AM_POSITION_CODE',
        'amPositionCode' => 'AM_POSITION_CODE',
        'writeMas.amPositionCode' => 'AM_POSITION_CODE',
        'WriteMasTableMap::COL_AM_POSITION_CODE' => 'AM_POSITION_CODE',
        'COL_AM_POSITION_CODE' => 'AM_POSITION_CODE',
        'am_position_code' => 'AM_POSITION_CODE',
        'write_mas.am_position_code' => 'AM_POSITION_CODE',
        'EmployeeStatus' => 'EMPLOYEE_STATUS',
        'WriteMas.EmployeeStatus' => 'EMPLOYEE_STATUS',
        'employeeStatus' => 'EMPLOYEE_STATUS',
        'writeMas.employeeStatus' => 'EMPLOYEE_STATUS',
        'WriteMasTableMap::COL_EMPLOYEE_STATUS' => 'EMPLOYEE_STATUS',
        'COL_EMPLOYEE_STATUS' => 'EMPLOYEE_STATUS',
        'employee_status' => 'EMPLOYEE_STATUS',
        'write_mas.employee_status' => 'EMPLOYEE_STATUS',
        'EmployeePositionCode' => 'EMPLOYEE_POSITION_CODE',
        'WriteMas.EmployeePositionCode' => 'EMPLOYEE_POSITION_CODE',
        'employeePositionCode' => 'EMPLOYEE_POSITION_CODE',
        'writeMas.employeePositionCode' => 'EMPLOYEE_POSITION_CODE',
        'WriteMasTableMap::COL_EMPLOYEE_POSITION_CODE' => 'EMPLOYEE_POSITION_CODE',
        'COL_EMPLOYEE_POSITION_CODE' => 'EMPLOYEE_POSITION_CODE',
        'employee_position_code' => 'EMPLOYEE_POSITION_CODE',
        'write_mas.employee_position_code' => 'EMPLOYEE_POSITION_CODE',
        'EmployeePositionName' => 'EMPLOYEE_POSITION_NAME',
        'WriteMas.EmployeePositionName' => 'EMPLOYEE_POSITION_NAME',
        'employeePositionName' => 'EMPLOYEE_POSITION_NAME',
        'writeMas.employeePositionName' => 'EMPLOYEE_POSITION_NAME',
        'WriteMasTableMap::COL_EMPLOYEE_POSITION_NAME' => 'EMPLOYEE_POSITION_NAME',
        'COL_EMPLOYEE_POSITION_NAME' => 'EMPLOYEE_POSITION_NAME',
        'employee_position_name' => 'EMPLOYEE_POSITION_NAME',
        'write_mas.employee_position_name' => 'EMPLOYEE_POSITION_NAME',
        'EmployeeLevel' => 'EMPLOYEE_LEVEL',
        'WriteMas.EmployeeLevel' => 'EMPLOYEE_LEVEL',
        'employeeLevel' => 'EMPLOYEE_LEVEL',
        'writeMas.employeeLevel' => 'EMPLOYEE_LEVEL',
        'WriteMasTableMap::COL_EMPLOYEE_LEVEL' => 'EMPLOYEE_LEVEL',
        'COL_EMPLOYEE_LEVEL' => 'EMPLOYEE_LEVEL',
        'employee_level' => 'EMPLOYEE_LEVEL',
        'write_mas.employee_level' => 'EMPLOYEE_LEVEL',
        'MasReportId' => 'MAS_REPORT_ID',
        'WriteMas.MasReportId' => 'MAS_REPORT_ID',
        'masReportId' => 'MAS_REPORT_ID',
        'writeMas.masReportId' => 'MAS_REPORT_ID',
        'WriteMasTableMap::COL_MAS_REPORT_ID' => 'MAS_REPORT_ID',
        'COL_MAS_REPORT_ID' => 'MAS_REPORT_ID',
        'mas_report_id' => 'MAS_REPORT_ID',
        'write_mas.mas_report_id' => 'MAS_REPORT_ID',
        'ChemistMet' => 'CHEMIST_MET',
        'WriteMas.ChemistMet' => 'CHEMIST_MET',
        'chemistMet' => 'CHEMIST_MET',
        'writeMas.chemistMet' => 'CHEMIST_MET',
        'WriteMasTableMap::COL_CHEMIST_MET' => 'CHEMIST_MET',
        'COL_CHEMIST_MET' => 'CHEMIST_MET',
        'chemist_met' => 'CHEMIST_MET',
        'write_mas.chemist_met' => 'CHEMIST_MET',
        'ChemistCalls' => 'CHEMIST_CALLS',
        'WriteMas.ChemistCalls' => 'CHEMIST_CALLS',
        'chemistCalls' => 'CHEMIST_CALLS',
        'writeMas.chemistCalls' => 'CHEMIST_CALLS',
        'WriteMasTableMap::COL_CHEMIST_CALLS' => 'CHEMIST_CALLS',
        'COL_CHEMIST_CALLS' => 'CHEMIST_CALLS',
        'chemist_calls' => 'CHEMIST_CALLS',
        'write_mas.chemist_calls' => 'CHEMIST_CALLS',
        'ChemistCallAvg' => 'CHEMIST_CALL_AVG',
        'WriteMas.ChemistCallAvg' => 'CHEMIST_CALL_AVG',
        'chemistCallAvg' => 'CHEMIST_CALL_AVG',
        'writeMas.chemistCallAvg' => 'CHEMIST_CALL_AVG',
        'WriteMasTableMap::COL_CHEMIST_CALL_AVG' => 'CHEMIST_CALL_AVG',
        'COL_CHEMIST_CALL_AVG' => 'CHEMIST_CALL_AVG',
        'chemist_call_avg' => 'CHEMIST_CALL_AVG',
        'write_mas.chemist_call_avg' => 'CHEMIST_CALL_AVG',
        'TotalStockists' => 'TOTAL_STOCKISTS',
        'WriteMas.TotalStockists' => 'TOTAL_STOCKISTS',
        'totalStockists' => 'TOTAL_STOCKISTS',
        'writeMas.totalStockists' => 'TOTAL_STOCKISTS',
        'WriteMasTableMap::COL_TOTAL_STOCKISTS' => 'TOTAL_STOCKISTS',
        'COL_TOTAL_STOCKISTS' => 'TOTAL_STOCKISTS',
        'total_stockists' => 'TOTAL_STOCKISTS',
        'write_mas.total_stockists' => 'TOTAL_STOCKISTS',
        'DrAddition' => 'DR_ADDITION',
        'WriteMas.DrAddition' => 'DR_ADDITION',
        'drAddition' => 'DR_ADDITION',
        'writeMas.drAddition' => 'DR_ADDITION',
        'WriteMasTableMap::COL_DR_ADDITION' => 'DR_ADDITION',
        'COL_DR_ADDITION' => 'DR_ADDITION',
        'dr_addition' => 'DR_ADDITION',
        'write_mas.dr_addition' => 'DR_ADDITION',
        'DrDeletion' => 'DR_DELETION',
        'WriteMas.DrDeletion' => 'DR_DELETION',
        'drDeletion' => 'DR_DELETION',
        'writeMas.drDeletion' => 'DR_DELETION',
        'WriteMasTableMap::COL_DR_DELETION' => 'DR_DELETION',
        'COL_DR_DELETION' => 'DR_DELETION',
        'dr_deletion' => 'DR_DELETION',
        'write_mas.dr_deletion' => 'DR_DELETION',
        'CreatedAt' => 'CREATED_AT',
        'WriteMas.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'writeMas.createdAt' => 'CREATED_AT',
        'WriteMasTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'write_mas.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'WriteMas.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'writeMas.updatedAt' => 'UPDATED_AT',
        'WriteMasTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'write_mas.updated_at' => 'UPDATED_AT',
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
        $this->setName('write_mas');
        $this->setPhpName('WriteMas');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\WriteMas');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('write_mas_mas_report_id_seq');
        // columns
        $this->addColumn('org_unit_name', 'OrgUnitName', 'VARCHAR', false, null, null);
        $this->addColumn('rep_code', 'RepCode', 'VARCHAR', false, null, null);
        $this->addColumn('employee_code', 'EmployeeCode', 'VARCHAR', false, null, null);
        $this->addColumn('employee_name', 'EmployeeName', 'VARCHAR', false, null, null);
        $this->addColumn('am_position', 'AmPosition', 'VARCHAR', false, null, null);
        $this->addColumn('rm_position', 'RmPosition', 'VARCHAR', false, null, null);
        $this->addColumn('zm_position', 'ZmPosition', 'VARCHAR', false, null, null);
        $this->addColumn('location', 'Location', 'VARCHAR', false, null, null);
        $this->addColumn('month_year', 'MonthYear', 'VARCHAR', false, null, null);
        $this->addColumn('working_days', 'WorkingDays', 'VARCHAR', false, null, null);
        $this->addColumn('fwd', 'Fwd', 'VARCHAR', false, null, null);
        $this->addColumn('nca', 'Nca', 'VARCHAR', false, null, null);
        $this->addColumn('total_doctors', 'TotalDoctors', 'VARCHAR', false, null, null);
        $this->addColumn('dr_met', 'DrMet', 'VARCHAR', false, null, null);
        $this->addColumn('dr_vf_met', 'DrVfMet', 'VARCHAR', false, null, null);
        $this->addColumn('drca_l', 'DrcaL', 'VARCHAR', false, null, null);
        $this->addColumn('drcvrg', 'Drcvrg', 'VARCHAR', false, null, null);
        $this->addColumn('drvfcvrg', 'Drvfcvrg', 'VARCHAR', false, null, null);
        $this->addColumn('missed_dr', 'MissedDr', 'VARCHAR', false, null, null);
        $this->addColumn('missed_dr_calls', 'MissedDrCalls', 'VARCHAR', false, null, null);
        $this->addColumn('total_chemist', 'TotalChemist', 'VARCHAR', false, null, null);
        $this->addColumn('pob_value', 'PobValue', 'VARCHAR', false, null, null);
        $this->addColumn('rcpa_value_for_own_brand', 'RcpaValueForOwnBrand', 'VARCHAR', false, null, null);
        $this->addColumn('rcpa_value_for_comp_brand', 'RcpaValueForCompBrand', 'VARCHAR', false, null, null);
        $this->addColumn('joint_work_total_calls', 'JointWorkTotalCalls', 'VARCHAR', false, null, null);
        $this->addColumn('leave_days', 'LeaveDays', 'VARCHAR', false, null, null);
        $this->addColumn('joint_working', 'JointWorking', 'VARCHAR', false, null, null);
        $this->addColumn('no_dr_call', 'NoDrCall', 'VARCHAR', false, null, null);
        $this->addColumn('agenda', 'Agenda', 'VARCHAR', false, null, null);
        $this->addColumn('zm_position_code', 'ZmPositionCode', 'VARCHAR', false, null, null);
        $this->addColumn('rm_position_code', 'RmPositionCode', 'VARCHAR', false, null, null);
        $this->addColumn('am_position_code', 'AmPositionCode', 'VARCHAR', false, null, null);
        $this->addColumn('employee_status', 'EmployeeStatus', 'VARCHAR', false, null, null);
        $this->addColumn('employee_position_code', 'EmployeePositionCode', 'VARCHAR', false, null, null);
        $this->addColumn('employee_position_name', 'EmployeePositionName', 'VARCHAR', false, null, null);
        $this->addColumn('employee_level', 'EmployeeLevel', 'VARCHAR', false, null, null);
        $this->addPrimaryKey('mas_report_id', 'MasReportId', 'INTEGER', true, null, null);
        $this->addColumn('chemist_met', 'ChemistMet', 'VARCHAR', false, null, null);
        $this->addColumn('chemist_calls', 'ChemistCalls', 'VARCHAR', false, null, null);
        $this->addColumn('chemist_call_avg', 'ChemistCallAvg', 'VARCHAR', false, null, null);
        $this->addColumn('total_stockists', 'TotalStockists', 'VARCHAR', false, null, null);
        $this->addColumn('dr_addition', 'DrAddition', 'VARCHAR', false, null, null);
        $this->addColumn('dr_deletion', 'DrDeletion', 'VARCHAR', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 36 + $offset : static::translateFieldName('MasReportId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 36 + $offset : static::translateFieldName('MasReportId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 36 + $offset : static::translateFieldName('MasReportId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 36 + $offset : static::translateFieldName('MasReportId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 36 + $offset : static::translateFieldName('MasReportId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 36 + $offset : static::translateFieldName('MasReportId', TableMap::TYPE_PHPNAME, $indexType)];
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
                ? 36 + $offset
                : self::translateFieldName('MasReportId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? WriteMasTableMap::CLASS_DEFAULT : WriteMasTableMap::OM_CLASS;
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
     * @return array (WriteMas object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = WriteMasTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = WriteMasTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + WriteMasTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = WriteMasTableMap::OM_CLASS;
            /** @var WriteMas $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            WriteMasTableMap::addInstanceToPool($obj, $key);
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
            $key = WriteMasTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = WriteMasTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var WriteMas $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                WriteMasTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(WriteMasTableMap::COL_ORG_UNIT_NAME);
            $criteria->addSelectColumn(WriteMasTableMap::COL_REP_CODE);
            $criteria->addSelectColumn(WriteMasTableMap::COL_EMPLOYEE_CODE);
            $criteria->addSelectColumn(WriteMasTableMap::COL_EMPLOYEE_NAME);
            $criteria->addSelectColumn(WriteMasTableMap::COL_AM_POSITION);
            $criteria->addSelectColumn(WriteMasTableMap::COL_RM_POSITION);
            $criteria->addSelectColumn(WriteMasTableMap::COL_ZM_POSITION);
            $criteria->addSelectColumn(WriteMasTableMap::COL_LOCATION);
            $criteria->addSelectColumn(WriteMasTableMap::COL_MONTH_YEAR);
            $criteria->addSelectColumn(WriteMasTableMap::COL_WORKING_DAYS);
            $criteria->addSelectColumn(WriteMasTableMap::COL_FWD);
            $criteria->addSelectColumn(WriteMasTableMap::COL_NCA);
            $criteria->addSelectColumn(WriteMasTableMap::COL_TOTAL_DOCTORS);
            $criteria->addSelectColumn(WriteMasTableMap::COL_DR_MET);
            $criteria->addSelectColumn(WriteMasTableMap::COL_DR_VF_MET);
            $criteria->addSelectColumn(WriteMasTableMap::COL_DRCA_L);
            $criteria->addSelectColumn(WriteMasTableMap::COL_DRCVRG);
            $criteria->addSelectColumn(WriteMasTableMap::COL_DRVFCVRG);
            $criteria->addSelectColumn(WriteMasTableMap::COL_MISSED_DR);
            $criteria->addSelectColumn(WriteMasTableMap::COL_MISSED_DR_CALLS);
            $criteria->addSelectColumn(WriteMasTableMap::COL_TOTAL_CHEMIST);
            $criteria->addSelectColumn(WriteMasTableMap::COL_POB_VALUE);
            $criteria->addSelectColumn(WriteMasTableMap::COL_RCPA_VALUE_FOR_OWN_BRAND);
            $criteria->addSelectColumn(WriteMasTableMap::COL_RCPA_VALUE_FOR_COMP_BRAND);
            $criteria->addSelectColumn(WriteMasTableMap::COL_JOINT_WORK_TOTAL_CALLS);
            $criteria->addSelectColumn(WriteMasTableMap::COL_LEAVE_DAYS);
            $criteria->addSelectColumn(WriteMasTableMap::COL_JOINT_WORKING);
            $criteria->addSelectColumn(WriteMasTableMap::COL_NO_DR_CALL);
            $criteria->addSelectColumn(WriteMasTableMap::COL_AGENDA);
            $criteria->addSelectColumn(WriteMasTableMap::COL_ZM_POSITION_CODE);
            $criteria->addSelectColumn(WriteMasTableMap::COL_RM_POSITION_CODE);
            $criteria->addSelectColumn(WriteMasTableMap::COL_AM_POSITION_CODE);
            $criteria->addSelectColumn(WriteMasTableMap::COL_EMPLOYEE_STATUS);
            $criteria->addSelectColumn(WriteMasTableMap::COL_EMPLOYEE_POSITION_CODE);
            $criteria->addSelectColumn(WriteMasTableMap::COL_EMPLOYEE_POSITION_NAME);
            $criteria->addSelectColumn(WriteMasTableMap::COL_EMPLOYEE_LEVEL);
            $criteria->addSelectColumn(WriteMasTableMap::COL_MAS_REPORT_ID);
            $criteria->addSelectColumn(WriteMasTableMap::COL_CHEMIST_MET);
            $criteria->addSelectColumn(WriteMasTableMap::COL_CHEMIST_CALLS);
            $criteria->addSelectColumn(WriteMasTableMap::COL_CHEMIST_CALL_AVG);
            $criteria->addSelectColumn(WriteMasTableMap::COL_TOTAL_STOCKISTS);
            $criteria->addSelectColumn(WriteMasTableMap::COL_DR_ADDITION);
            $criteria->addSelectColumn(WriteMasTableMap::COL_DR_DELETION);
            $criteria->addSelectColumn(WriteMasTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(WriteMasTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.org_unit_name');
            $criteria->addSelectColumn($alias . '.rep_code');
            $criteria->addSelectColumn($alias . '.employee_code');
            $criteria->addSelectColumn($alias . '.employee_name');
            $criteria->addSelectColumn($alias . '.am_position');
            $criteria->addSelectColumn($alias . '.rm_position');
            $criteria->addSelectColumn($alias . '.zm_position');
            $criteria->addSelectColumn($alias . '.location');
            $criteria->addSelectColumn($alias . '.month_year');
            $criteria->addSelectColumn($alias . '.working_days');
            $criteria->addSelectColumn($alias . '.fwd');
            $criteria->addSelectColumn($alias . '.nca');
            $criteria->addSelectColumn($alias . '.total_doctors');
            $criteria->addSelectColumn($alias . '.dr_met');
            $criteria->addSelectColumn($alias . '.dr_vf_met');
            $criteria->addSelectColumn($alias . '.drca_l');
            $criteria->addSelectColumn($alias . '.drcvrg');
            $criteria->addSelectColumn($alias . '.drvfcvrg');
            $criteria->addSelectColumn($alias . '.missed_dr');
            $criteria->addSelectColumn($alias . '.missed_dr_calls');
            $criteria->addSelectColumn($alias . '.total_chemist');
            $criteria->addSelectColumn($alias . '.pob_value');
            $criteria->addSelectColumn($alias . '.rcpa_value_for_own_brand');
            $criteria->addSelectColumn($alias . '.rcpa_value_for_comp_brand');
            $criteria->addSelectColumn($alias . '.joint_work_total_calls');
            $criteria->addSelectColumn($alias . '.leave_days');
            $criteria->addSelectColumn($alias . '.joint_working');
            $criteria->addSelectColumn($alias . '.no_dr_call');
            $criteria->addSelectColumn($alias . '.agenda');
            $criteria->addSelectColumn($alias . '.zm_position_code');
            $criteria->addSelectColumn($alias . '.rm_position_code');
            $criteria->addSelectColumn($alias . '.am_position_code');
            $criteria->addSelectColumn($alias . '.employee_status');
            $criteria->addSelectColumn($alias . '.employee_position_code');
            $criteria->addSelectColumn($alias . '.employee_position_name');
            $criteria->addSelectColumn($alias . '.employee_level');
            $criteria->addSelectColumn($alias . '.mas_report_id');
            $criteria->addSelectColumn($alias . '.chemist_met');
            $criteria->addSelectColumn($alias . '.chemist_calls');
            $criteria->addSelectColumn($alias . '.chemist_call_avg');
            $criteria->addSelectColumn($alias . '.total_stockists');
            $criteria->addSelectColumn($alias . '.dr_addition');
            $criteria->addSelectColumn($alias . '.dr_deletion');
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
            $criteria->removeSelectColumn(WriteMasTableMap::COL_ORG_UNIT_NAME);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_REP_CODE);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_EMPLOYEE_CODE);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_EMPLOYEE_NAME);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_AM_POSITION);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_RM_POSITION);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_ZM_POSITION);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_LOCATION);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_MONTH_YEAR);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_WORKING_DAYS);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_FWD);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_NCA);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_TOTAL_DOCTORS);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_DR_MET);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_DR_VF_MET);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_DRCA_L);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_DRCVRG);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_DRVFCVRG);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_MISSED_DR);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_MISSED_DR_CALLS);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_TOTAL_CHEMIST);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_POB_VALUE);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_RCPA_VALUE_FOR_OWN_BRAND);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_RCPA_VALUE_FOR_COMP_BRAND);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_JOINT_WORK_TOTAL_CALLS);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_LEAVE_DAYS);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_JOINT_WORKING);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_NO_DR_CALL);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_AGENDA);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_ZM_POSITION_CODE);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_RM_POSITION_CODE);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_AM_POSITION_CODE);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_EMPLOYEE_STATUS);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_EMPLOYEE_POSITION_CODE);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_EMPLOYEE_POSITION_NAME);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_EMPLOYEE_LEVEL);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_MAS_REPORT_ID);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_CHEMIST_MET);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_CHEMIST_CALLS);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_CHEMIST_CALL_AVG);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_TOTAL_STOCKISTS);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_DR_ADDITION);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_DR_DELETION);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(WriteMasTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.org_unit_name');
            $criteria->removeSelectColumn($alias . '.rep_code');
            $criteria->removeSelectColumn($alias . '.employee_code');
            $criteria->removeSelectColumn($alias . '.employee_name');
            $criteria->removeSelectColumn($alias . '.am_position');
            $criteria->removeSelectColumn($alias . '.rm_position');
            $criteria->removeSelectColumn($alias . '.zm_position');
            $criteria->removeSelectColumn($alias . '.location');
            $criteria->removeSelectColumn($alias . '.month_year');
            $criteria->removeSelectColumn($alias . '.working_days');
            $criteria->removeSelectColumn($alias . '.fwd');
            $criteria->removeSelectColumn($alias . '.nca');
            $criteria->removeSelectColumn($alias . '.total_doctors');
            $criteria->removeSelectColumn($alias . '.dr_met');
            $criteria->removeSelectColumn($alias . '.dr_vf_met');
            $criteria->removeSelectColumn($alias . '.drca_l');
            $criteria->removeSelectColumn($alias . '.drcvrg');
            $criteria->removeSelectColumn($alias . '.drvfcvrg');
            $criteria->removeSelectColumn($alias . '.missed_dr');
            $criteria->removeSelectColumn($alias . '.missed_dr_calls');
            $criteria->removeSelectColumn($alias . '.total_chemist');
            $criteria->removeSelectColumn($alias . '.pob_value');
            $criteria->removeSelectColumn($alias . '.rcpa_value_for_own_brand');
            $criteria->removeSelectColumn($alias . '.rcpa_value_for_comp_brand');
            $criteria->removeSelectColumn($alias . '.joint_work_total_calls');
            $criteria->removeSelectColumn($alias . '.leave_days');
            $criteria->removeSelectColumn($alias . '.joint_working');
            $criteria->removeSelectColumn($alias . '.no_dr_call');
            $criteria->removeSelectColumn($alias . '.agenda');
            $criteria->removeSelectColumn($alias . '.zm_position_code');
            $criteria->removeSelectColumn($alias . '.rm_position_code');
            $criteria->removeSelectColumn($alias . '.am_position_code');
            $criteria->removeSelectColumn($alias . '.employee_status');
            $criteria->removeSelectColumn($alias . '.employee_position_code');
            $criteria->removeSelectColumn($alias . '.employee_position_name');
            $criteria->removeSelectColumn($alias . '.employee_level');
            $criteria->removeSelectColumn($alias . '.mas_report_id');
            $criteria->removeSelectColumn($alias . '.chemist_met');
            $criteria->removeSelectColumn($alias . '.chemist_calls');
            $criteria->removeSelectColumn($alias . '.chemist_call_avg');
            $criteria->removeSelectColumn($alias . '.total_stockists');
            $criteria->removeSelectColumn($alias . '.dr_addition');
            $criteria->removeSelectColumn($alias . '.dr_deletion');
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
        return Propel::getServiceContainer()->getDatabaseMap(WriteMasTableMap::DATABASE_NAME)->getTable(WriteMasTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a WriteMas or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or WriteMas object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(WriteMasTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\WriteMas) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(WriteMasTableMap::DATABASE_NAME);
            $criteria->add(WriteMasTableMap::COL_MAS_REPORT_ID, (array) $values, Criteria::IN);
        }

        $query = WriteMasQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            WriteMasTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                WriteMasTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the write_mas table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return WriteMasQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a WriteMas or Criteria object.
     *
     * @param mixed $criteria Criteria or WriteMas object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WriteMasTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from WriteMas object
        }

        if ($criteria->containsKey(WriteMasTableMap::COL_MAS_REPORT_ID) && $criteria->keyContainsValue(WriteMasTableMap::COL_MAS_REPORT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.WriteMasTableMap::COL_MAS_REPORT_ID.')');
        }


        // Set the correct dbName
        $query = WriteMasQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
