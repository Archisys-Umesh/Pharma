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
use entities\Employee;
use entities\EmployeeQuery;


/**
 * This class defines the structure of the 'employee' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class EmployeeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.EmployeeTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'employee';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Employee';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Employee';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Employee';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 34;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 34;

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'employee.employee_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'employee.company_id';

    /**
     * the column name for the position_id field
     */
    public const COL_POSITION_ID = 'employee.position_id';

    /**
     * the column name for the reporting_to field
     */
    public const COL_REPORTING_TO = 'employee.reporting_to';

    /**
     * the column name for the designation_id field
     */
    public const COL_DESIGNATION_ID = 'employee.designation_id';

    /**
     * the column name for the branch_id field
     */
    public const COL_BRANCH_ID = 'employee.branch_id';

    /**
     * the column name for the grade_id field
     */
    public const COL_GRADE_ID = 'employee.grade_id';

    /**
     * the column name for the org_unit_id field
     */
    public const COL_ORG_UNIT_ID = 'employee.org_unit_id';

    /**
     * the column name for the employee_code field
     */
    public const COL_EMPLOYEE_CODE = 'employee.employee_code';

    /**
     * the column name for the first_name field
     */
    public const COL_FIRST_NAME = 'employee.first_name';

    /**
     * the column name for the last_name field
     */
    public const COL_LAST_NAME = 'employee.last_name';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'employee.status';

    /**
     * the column name for the ip_address field
     */
    public const COL_IP_ADDRESS = 'employee.ip_address';

    /**
     * the column name for the profile_picture field
     */
    public const COL_PROFILE_PICTURE = 'employee.profile_picture';

    /**
     * the column name for the email field
     */
    public const COL_EMAIL = 'employee.email';

    /**
     * the column name for the last_login field
     */
    public const COL_LAST_LOGIN = 'employee.last_login';

    /**
     * the column name for the phone field
     */
    public const COL_PHONE = 'employee.phone';

    /**
     * the column name for the address field
     */
    public const COL_ADDRESS = 'employee.address';

    /**
     * the column name for the costnumber field
     */
    public const COL_COSTNUMBER = 'employee.costnumber';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'employee.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'employee.updated_at';

    /**
     * the column name for the base_mtarget field
     */
    public const COL_BASE_MTARGET = 'employee.base_mtarget';

    /**
     * the column name for the integration_id field
     */
    public const COL_INTEGRATION_ID = 'employee.integration_id';

    /**
     * the column name for the itownid field
     */
    public const COL_ITOWNID = 'employee.itownid';

    /**
     * the column name for the islocked field
     */
    public const COL_ISLOCKED = 'employee.islocked';

    /**
     * the column name for the lockedreason field
     */
    public const COL_LOCKEDREASON = 'employee.lockedreason';

    /**
     * the column name for the lockeddate field
     */
    public const COL_LOCKEDDATE = 'employee.lockeddate';

    /**
     * the column name for the iseodcheckenabled field
     */
    public const COL_ISEODCHECKENABLED = 'employee.iseodcheckenabled';

    /**
     * the column name for the employee_media field
     */
    public const COL_EMPLOYEE_MEDIA = 'employee.employee_media';

    /**
     * the column name for the resi_address field
     */
    public const COL_RESI_ADDRESS = 'employee.resi_address';

    /**
     * the column name for the can_full_sync field
     */
    public const COL_CAN_FULL_SYNC = 'employee.can_full_sync';

    /**
     * the column name for the remark field
     */
    public const COL_REMARK = 'employee.remark';

    /**
     * the column name for the employee_spoken_language field
     */
    public const COL_EMPLOYEE_SPOKEN_LANGUAGE = 'employee.employee_spoken_language';

    /**
     * the column name for the last_updated_by_user_id field
     */
    public const COL_LAST_UPDATED_BY_USER_ID = 'employee.last_updated_by_user_id';

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
        self::TYPE_PHPNAME       => ['EmployeeId', 'CompanyId', 'PositionId', 'ReportingTo', 'DesignationId', 'BranchId', 'GradeId', 'OrgUnitId', 'EmployeeCode', 'FirstName', 'LastName', 'Status', 'IpAddress', 'ProfilePicture', 'Email', 'LastLogin', 'Phone', 'Address', 'Costnumber', 'CreatedAt', 'UpdatedAt', 'BaseMtarget', 'IntegrationId', 'Itownid', 'Islocked', 'Lockedreason', 'Lockeddate', 'Iseodcheckenabled', 'EmployeeMedia', 'ResiAddress', 'CanFullSync', 'Remark', 'EmployeeSpokenLanguage', 'LastUpdatedByUserId', ],
        self::TYPE_CAMELNAME     => ['employeeId', 'companyId', 'positionId', 'reportingTo', 'designationId', 'branchId', 'gradeId', 'orgUnitId', 'employeeCode', 'firstName', 'lastName', 'status', 'ipAddress', 'profilePicture', 'email', 'lastLogin', 'phone', 'address', 'costnumber', 'createdAt', 'updatedAt', 'baseMtarget', 'integrationId', 'itownid', 'islocked', 'lockedreason', 'lockeddate', 'iseodcheckenabled', 'employeeMedia', 'resiAddress', 'canFullSync', 'remark', 'employeeSpokenLanguage', 'lastUpdatedByUserId', ],
        self::TYPE_COLNAME       => [EmployeeTableMap::COL_EMPLOYEE_ID, EmployeeTableMap::COL_COMPANY_ID, EmployeeTableMap::COL_POSITION_ID, EmployeeTableMap::COL_REPORTING_TO, EmployeeTableMap::COL_DESIGNATION_ID, EmployeeTableMap::COL_BRANCH_ID, EmployeeTableMap::COL_GRADE_ID, EmployeeTableMap::COL_ORG_UNIT_ID, EmployeeTableMap::COL_EMPLOYEE_CODE, EmployeeTableMap::COL_FIRST_NAME, EmployeeTableMap::COL_LAST_NAME, EmployeeTableMap::COL_STATUS, EmployeeTableMap::COL_IP_ADDRESS, EmployeeTableMap::COL_PROFILE_PICTURE, EmployeeTableMap::COL_EMAIL, EmployeeTableMap::COL_LAST_LOGIN, EmployeeTableMap::COL_PHONE, EmployeeTableMap::COL_ADDRESS, EmployeeTableMap::COL_COSTNUMBER, EmployeeTableMap::COL_CREATED_AT, EmployeeTableMap::COL_UPDATED_AT, EmployeeTableMap::COL_BASE_MTARGET, EmployeeTableMap::COL_INTEGRATION_ID, EmployeeTableMap::COL_ITOWNID, EmployeeTableMap::COL_ISLOCKED, EmployeeTableMap::COL_LOCKEDREASON, EmployeeTableMap::COL_LOCKEDDATE, EmployeeTableMap::COL_ISEODCHECKENABLED, EmployeeTableMap::COL_EMPLOYEE_MEDIA, EmployeeTableMap::COL_RESI_ADDRESS, EmployeeTableMap::COL_CAN_FULL_SYNC, EmployeeTableMap::COL_REMARK, EmployeeTableMap::COL_EMPLOYEE_SPOKEN_LANGUAGE, EmployeeTableMap::COL_LAST_UPDATED_BY_USER_ID, ],
        self::TYPE_FIELDNAME     => ['employee_id', 'company_id', 'position_id', 'reporting_to', 'designation_id', 'branch_id', 'grade_id', 'org_unit_id', 'employee_code', 'first_name', 'last_name', 'status', 'ip_address', 'profile_picture', 'email', 'last_login', 'phone', 'address', 'costnumber', 'created_at', 'updated_at', 'base_mtarget', 'integration_id', 'itownid', 'islocked', 'lockedreason', 'lockeddate', 'iseodcheckenabled', 'employee_media', 'resi_address', 'can_full_sync', 'remark', 'employee_spoken_language', 'last_updated_by_user_id', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, ]
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
        self::TYPE_PHPNAME       => ['EmployeeId' => 0, 'CompanyId' => 1, 'PositionId' => 2, 'ReportingTo' => 3, 'DesignationId' => 4, 'BranchId' => 5, 'GradeId' => 6, 'OrgUnitId' => 7, 'EmployeeCode' => 8, 'FirstName' => 9, 'LastName' => 10, 'Status' => 11, 'IpAddress' => 12, 'ProfilePicture' => 13, 'Email' => 14, 'LastLogin' => 15, 'Phone' => 16, 'Address' => 17, 'Costnumber' => 18, 'CreatedAt' => 19, 'UpdatedAt' => 20, 'BaseMtarget' => 21, 'IntegrationId' => 22, 'Itownid' => 23, 'Islocked' => 24, 'Lockedreason' => 25, 'Lockeddate' => 26, 'Iseodcheckenabled' => 27, 'EmployeeMedia' => 28, 'ResiAddress' => 29, 'CanFullSync' => 30, 'Remark' => 31, 'EmployeeSpokenLanguage' => 32, 'LastUpdatedByUserId' => 33, ],
        self::TYPE_CAMELNAME     => ['employeeId' => 0, 'companyId' => 1, 'positionId' => 2, 'reportingTo' => 3, 'designationId' => 4, 'branchId' => 5, 'gradeId' => 6, 'orgUnitId' => 7, 'employeeCode' => 8, 'firstName' => 9, 'lastName' => 10, 'status' => 11, 'ipAddress' => 12, 'profilePicture' => 13, 'email' => 14, 'lastLogin' => 15, 'phone' => 16, 'address' => 17, 'costnumber' => 18, 'createdAt' => 19, 'updatedAt' => 20, 'baseMtarget' => 21, 'integrationId' => 22, 'itownid' => 23, 'islocked' => 24, 'lockedreason' => 25, 'lockeddate' => 26, 'iseodcheckenabled' => 27, 'employeeMedia' => 28, 'resiAddress' => 29, 'canFullSync' => 30, 'remark' => 31, 'employeeSpokenLanguage' => 32, 'lastUpdatedByUserId' => 33, ],
        self::TYPE_COLNAME       => [EmployeeTableMap::COL_EMPLOYEE_ID => 0, EmployeeTableMap::COL_COMPANY_ID => 1, EmployeeTableMap::COL_POSITION_ID => 2, EmployeeTableMap::COL_REPORTING_TO => 3, EmployeeTableMap::COL_DESIGNATION_ID => 4, EmployeeTableMap::COL_BRANCH_ID => 5, EmployeeTableMap::COL_GRADE_ID => 6, EmployeeTableMap::COL_ORG_UNIT_ID => 7, EmployeeTableMap::COL_EMPLOYEE_CODE => 8, EmployeeTableMap::COL_FIRST_NAME => 9, EmployeeTableMap::COL_LAST_NAME => 10, EmployeeTableMap::COL_STATUS => 11, EmployeeTableMap::COL_IP_ADDRESS => 12, EmployeeTableMap::COL_PROFILE_PICTURE => 13, EmployeeTableMap::COL_EMAIL => 14, EmployeeTableMap::COL_LAST_LOGIN => 15, EmployeeTableMap::COL_PHONE => 16, EmployeeTableMap::COL_ADDRESS => 17, EmployeeTableMap::COL_COSTNUMBER => 18, EmployeeTableMap::COL_CREATED_AT => 19, EmployeeTableMap::COL_UPDATED_AT => 20, EmployeeTableMap::COL_BASE_MTARGET => 21, EmployeeTableMap::COL_INTEGRATION_ID => 22, EmployeeTableMap::COL_ITOWNID => 23, EmployeeTableMap::COL_ISLOCKED => 24, EmployeeTableMap::COL_LOCKEDREASON => 25, EmployeeTableMap::COL_LOCKEDDATE => 26, EmployeeTableMap::COL_ISEODCHECKENABLED => 27, EmployeeTableMap::COL_EMPLOYEE_MEDIA => 28, EmployeeTableMap::COL_RESI_ADDRESS => 29, EmployeeTableMap::COL_CAN_FULL_SYNC => 30, EmployeeTableMap::COL_REMARK => 31, EmployeeTableMap::COL_EMPLOYEE_SPOKEN_LANGUAGE => 32, EmployeeTableMap::COL_LAST_UPDATED_BY_USER_ID => 33, ],
        self::TYPE_FIELDNAME     => ['employee_id' => 0, 'company_id' => 1, 'position_id' => 2, 'reporting_to' => 3, 'designation_id' => 4, 'branch_id' => 5, 'grade_id' => 6, 'org_unit_id' => 7, 'employee_code' => 8, 'first_name' => 9, 'last_name' => 10, 'status' => 11, 'ip_address' => 12, 'profile_picture' => 13, 'email' => 14, 'last_login' => 15, 'phone' => 16, 'address' => 17, 'costnumber' => 18, 'created_at' => 19, 'updated_at' => 20, 'base_mtarget' => 21, 'integration_id' => 22, 'itownid' => 23, 'islocked' => 24, 'lockedreason' => 25, 'lockeddate' => 26, 'iseodcheckenabled' => 27, 'employee_media' => 28, 'resi_address' => 29, 'can_full_sync' => 30, 'remark' => 31, 'employee_spoken_language' => 32, 'last_updated_by_user_id' => 33, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'EmployeeId' => 'EMPLOYEE_ID',
        'Employee.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'employee.employeeId' => 'EMPLOYEE_ID',
        'EmployeeTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'employee.employee_id' => 'EMPLOYEE_ID',
        'CompanyId' => 'COMPANY_ID',
        'Employee.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'employee.companyId' => 'COMPANY_ID',
        'EmployeeTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'employee.company_id' => 'COMPANY_ID',
        'PositionId' => 'POSITION_ID',
        'Employee.PositionId' => 'POSITION_ID',
        'positionId' => 'POSITION_ID',
        'employee.positionId' => 'POSITION_ID',
        'EmployeeTableMap::COL_POSITION_ID' => 'POSITION_ID',
        'COL_POSITION_ID' => 'POSITION_ID',
        'position_id' => 'POSITION_ID',
        'employee.position_id' => 'POSITION_ID',
        'ReportingTo' => 'REPORTING_TO',
        'Employee.ReportingTo' => 'REPORTING_TO',
        'reportingTo' => 'REPORTING_TO',
        'employee.reportingTo' => 'REPORTING_TO',
        'EmployeeTableMap::COL_REPORTING_TO' => 'REPORTING_TO',
        'COL_REPORTING_TO' => 'REPORTING_TO',
        'reporting_to' => 'REPORTING_TO',
        'employee.reporting_to' => 'REPORTING_TO',
        'DesignationId' => 'DESIGNATION_ID',
        'Employee.DesignationId' => 'DESIGNATION_ID',
        'designationId' => 'DESIGNATION_ID',
        'employee.designationId' => 'DESIGNATION_ID',
        'EmployeeTableMap::COL_DESIGNATION_ID' => 'DESIGNATION_ID',
        'COL_DESIGNATION_ID' => 'DESIGNATION_ID',
        'designation_id' => 'DESIGNATION_ID',
        'employee.designation_id' => 'DESIGNATION_ID',
        'BranchId' => 'BRANCH_ID',
        'Employee.BranchId' => 'BRANCH_ID',
        'branchId' => 'BRANCH_ID',
        'employee.branchId' => 'BRANCH_ID',
        'EmployeeTableMap::COL_BRANCH_ID' => 'BRANCH_ID',
        'COL_BRANCH_ID' => 'BRANCH_ID',
        'branch_id' => 'BRANCH_ID',
        'employee.branch_id' => 'BRANCH_ID',
        'GradeId' => 'GRADE_ID',
        'Employee.GradeId' => 'GRADE_ID',
        'gradeId' => 'GRADE_ID',
        'employee.gradeId' => 'GRADE_ID',
        'EmployeeTableMap::COL_GRADE_ID' => 'GRADE_ID',
        'COL_GRADE_ID' => 'GRADE_ID',
        'grade_id' => 'GRADE_ID',
        'employee.grade_id' => 'GRADE_ID',
        'OrgUnitId' => 'ORG_UNIT_ID',
        'Employee.OrgUnitId' => 'ORG_UNIT_ID',
        'orgUnitId' => 'ORG_UNIT_ID',
        'employee.orgUnitId' => 'ORG_UNIT_ID',
        'EmployeeTableMap::COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'COL_ORG_UNIT_ID' => 'ORG_UNIT_ID',
        'org_unit_id' => 'ORG_UNIT_ID',
        'employee.org_unit_id' => 'ORG_UNIT_ID',
        'EmployeeCode' => 'EMPLOYEE_CODE',
        'Employee.EmployeeCode' => 'EMPLOYEE_CODE',
        'employeeCode' => 'EMPLOYEE_CODE',
        'employee.employeeCode' => 'EMPLOYEE_CODE',
        'EmployeeTableMap::COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'COL_EMPLOYEE_CODE' => 'EMPLOYEE_CODE',
        'employee_code' => 'EMPLOYEE_CODE',
        'employee.employee_code' => 'EMPLOYEE_CODE',
        'FirstName' => 'FIRST_NAME',
        'Employee.FirstName' => 'FIRST_NAME',
        'firstName' => 'FIRST_NAME',
        'employee.firstName' => 'FIRST_NAME',
        'EmployeeTableMap::COL_FIRST_NAME' => 'FIRST_NAME',
        'COL_FIRST_NAME' => 'FIRST_NAME',
        'first_name' => 'FIRST_NAME',
        'employee.first_name' => 'FIRST_NAME',
        'LastName' => 'LAST_NAME',
        'Employee.LastName' => 'LAST_NAME',
        'lastName' => 'LAST_NAME',
        'employee.lastName' => 'LAST_NAME',
        'EmployeeTableMap::COL_LAST_NAME' => 'LAST_NAME',
        'COL_LAST_NAME' => 'LAST_NAME',
        'last_name' => 'LAST_NAME',
        'employee.last_name' => 'LAST_NAME',
        'Status' => 'STATUS',
        'Employee.Status' => 'STATUS',
        'status' => 'STATUS',
        'employee.status' => 'STATUS',
        'EmployeeTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'IpAddress' => 'IP_ADDRESS',
        'Employee.IpAddress' => 'IP_ADDRESS',
        'ipAddress' => 'IP_ADDRESS',
        'employee.ipAddress' => 'IP_ADDRESS',
        'EmployeeTableMap::COL_IP_ADDRESS' => 'IP_ADDRESS',
        'COL_IP_ADDRESS' => 'IP_ADDRESS',
        'ip_address' => 'IP_ADDRESS',
        'employee.ip_address' => 'IP_ADDRESS',
        'ProfilePicture' => 'PROFILE_PICTURE',
        'Employee.ProfilePicture' => 'PROFILE_PICTURE',
        'profilePicture' => 'PROFILE_PICTURE',
        'employee.profilePicture' => 'PROFILE_PICTURE',
        'EmployeeTableMap::COL_PROFILE_PICTURE' => 'PROFILE_PICTURE',
        'COL_PROFILE_PICTURE' => 'PROFILE_PICTURE',
        'profile_picture' => 'PROFILE_PICTURE',
        'employee.profile_picture' => 'PROFILE_PICTURE',
        'Email' => 'EMAIL',
        'Employee.Email' => 'EMAIL',
        'email' => 'EMAIL',
        'employee.email' => 'EMAIL',
        'EmployeeTableMap::COL_EMAIL' => 'EMAIL',
        'COL_EMAIL' => 'EMAIL',
        'LastLogin' => 'LAST_LOGIN',
        'Employee.LastLogin' => 'LAST_LOGIN',
        'lastLogin' => 'LAST_LOGIN',
        'employee.lastLogin' => 'LAST_LOGIN',
        'EmployeeTableMap::COL_LAST_LOGIN' => 'LAST_LOGIN',
        'COL_LAST_LOGIN' => 'LAST_LOGIN',
        'last_login' => 'LAST_LOGIN',
        'employee.last_login' => 'LAST_LOGIN',
        'Phone' => 'PHONE',
        'Employee.Phone' => 'PHONE',
        'phone' => 'PHONE',
        'employee.phone' => 'PHONE',
        'EmployeeTableMap::COL_PHONE' => 'PHONE',
        'COL_PHONE' => 'PHONE',
        'Address' => 'ADDRESS',
        'Employee.Address' => 'ADDRESS',
        'address' => 'ADDRESS',
        'employee.address' => 'ADDRESS',
        'EmployeeTableMap::COL_ADDRESS' => 'ADDRESS',
        'COL_ADDRESS' => 'ADDRESS',
        'Costnumber' => 'COSTNUMBER',
        'Employee.Costnumber' => 'COSTNUMBER',
        'costnumber' => 'COSTNUMBER',
        'employee.costnumber' => 'COSTNUMBER',
        'EmployeeTableMap::COL_COSTNUMBER' => 'COSTNUMBER',
        'COL_COSTNUMBER' => 'COSTNUMBER',
        'CreatedAt' => 'CREATED_AT',
        'Employee.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'employee.createdAt' => 'CREATED_AT',
        'EmployeeTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'employee.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Employee.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'employee.updatedAt' => 'UPDATED_AT',
        'EmployeeTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'employee.updated_at' => 'UPDATED_AT',
        'BaseMtarget' => 'BASE_MTARGET',
        'Employee.BaseMtarget' => 'BASE_MTARGET',
        'baseMtarget' => 'BASE_MTARGET',
        'employee.baseMtarget' => 'BASE_MTARGET',
        'EmployeeTableMap::COL_BASE_MTARGET' => 'BASE_MTARGET',
        'COL_BASE_MTARGET' => 'BASE_MTARGET',
        'base_mtarget' => 'BASE_MTARGET',
        'employee.base_mtarget' => 'BASE_MTARGET',
        'IntegrationId' => 'INTEGRATION_ID',
        'Employee.IntegrationId' => 'INTEGRATION_ID',
        'integrationId' => 'INTEGRATION_ID',
        'employee.integrationId' => 'INTEGRATION_ID',
        'EmployeeTableMap::COL_INTEGRATION_ID' => 'INTEGRATION_ID',
        'COL_INTEGRATION_ID' => 'INTEGRATION_ID',
        'integration_id' => 'INTEGRATION_ID',
        'employee.integration_id' => 'INTEGRATION_ID',
        'Itownid' => 'ITOWNID',
        'Employee.Itownid' => 'ITOWNID',
        'itownid' => 'ITOWNID',
        'employee.itownid' => 'ITOWNID',
        'EmployeeTableMap::COL_ITOWNID' => 'ITOWNID',
        'COL_ITOWNID' => 'ITOWNID',
        'Islocked' => 'ISLOCKED',
        'Employee.Islocked' => 'ISLOCKED',
        'islocked' => 'ISLOCKED',
        'employee.islocked' => 'ISLOCKED',
        'EmployeeTableMap::COL_ISLOCKED' => 'ISLOCKED',
        'COL_ISLOCKED' => 'ISLOCKED',
        'Lockedreason' => 'LOCKEDREASON',
        'Employee.Lockedreason' => 'LOCKEDREASON',
        'lockedreason' => 'LOCKEDREASON',
        'employee.lockedreason' => 'LOCKEDREASON',
        'EmployeeTableMap::COL_LOCKEDREASON' => 'LOCKEDREASON',
        'COL_LOCKEDREASON' => 'LOCKEDREASON',
        'Lockeddate' => 'LOCKEDDATE',
        'Employee.Lockeddate' => 'LOCKEDDATE',
        'lockeddate' => 'LOCKEDDATE',
        'employee.lockeddate' => 'LOCKEDDATE',
        'EmployeeTableMap::COL_LOCKEDDATE' => 'LOCKEDDATE',
        'COL_LOCKEDDATE' => 'LOCKEDDATE',
        'Iseodcheckenabled' => 'ISEODCHECKENABLED',
        'Employee.Iseodcheckenabled' => 'ISEODCHECKENABLED',
        'iseodcheckenabled' => 'ISEODCHECKENABLED',
        'employee.iseodcheckenabled' => 'ISEODCHECKENABLED',
        'EmployeeTableMap::COL_ISEODCHECKENABLED' => 'ISEODCHECKENABLED',
        'COL_ISEODCHECKENABLED' => 'ISEODCHECKENABLED',
        'EmployeeMedia' => 'EMPLOYEE_MEDIA',
        'Employee.EmployeeMedia' => 'EMPLOYEE_MEDIA',
        'employeeMedia' => 'EMPLOYEE_MEDIA',
        'employee.employeeMedia' => 'EMPLOYEE_MEDIA',
        'EmployeeTableMap::COL_EMPLOYEE_MEDIA' => 'EMPLOYEE_MEDIA',
        'COL_EMPLOYEE_MEDIA' => 'EMPLOYEE_MEDIA',
        'employee_media' => 'EMPLOYEE_MEDIA',
        'employee.employee_media' => 'EMPLOYEE_MEDIA',
        'ResiAddress' => 'RESI_ADDRESS',
        'Employee.ResiAddress' => 'RESI_ADDRESS',
        'resiAddress' => 'RESI_ADDRESS',
        'employee.resiAddress' => 'RESI_ADDRESS',
        'EmployeeTableMap::COL_RESI_ADDRESS' => 'RESI_ADDRESS',
        'COL_RESI_ADDRESS' => 'RESI_ADDRESS',
        'resi_address' => 'RESI_ADDRESS',
        'employee.resi_address' => 'RESI_ADDRESS',
        'CanFullSync' => 'CAN_FULL_SYNC',
        'Employee.CanFullSync' => 'CAN_FULL_SYNC',
        'canFullSync' => 'CAN_FULL_SYNC',
        'employee.canFullSync' => 'CAN_FULL_SYNC',
        'EmployeeTableMap::COL_CAN_FULL_SYNC' => 'CAN_FULL_SYNC',
        'COL_CAN_FULL_SYNC' => 'CAN_FULL_SYNC',
        'can_full_sync' => 'CAN_FULL_SYNC',
        'employee.can_full_sync' => 'CAN_FULL_SYNC',
        'Remark' => 'REMARK',
        'Employee.Remark' => 'REMARK',
        'remark' => 'REMARK',
        'employee.remark' => 'REMARK',
        'EmployeeTableMap::COL_REMARK' => 'REMARK',
        'COL_REMARK' => 'REMARK',
        'EmployeeSpokenLanguage' => 'EMPLOYEE_SPOKEN_LANGUAGE',
        'Employee.EmployeeSpokenLanguage' => 'EMPLOYEE_SPOKEN_LANGUAGE',
        'employeeSpokenLanguage' => 'EMPLOYEE_SPOKEN_LANGUAGE',
        'employee.employeeSpokenLanguage' => 'EMPLOYEE_SPOKEN_LANGUAGE',
        'EmployeeTableMap::COL_EMPLOYEE_SPOKEN_LANGUAGE' => 'EMPLOYEE_SPOKEN_LANGUAGE',
        'COL_EMPLOYEE_SPOKEN_LANGUAGE' => 'EMPLOYEE_SPOKEN_LANGUAGE',
        'employee_spoken_language' => 'EMPLOYEE_SPOKEN_LANGUAGE',
        'employee.employee_spoken_language' => 'EMPLOYEE_SPOKEN_LANGUAGE',
        'LastUpdatedByUserId' => 'LAST_UPDATED_BY_USER_ID',
        'Employee.LastUpdatedByUserId' => 'LAST_UPDATED_BY_USER_ID',
        'lastUpdatedByUserId' => 'LAST_UPDATED_BY_USER_ID',
        'employee.lastUpdatedByUserId' => 'LAST_UPDATED_BY_USER_ID',
        'EmployeeTableMap::COL_LAST_UPDATED_BY_USER_ID' => 'LAST_UPDATED_BY_USER_ID',
        'COL_LAST_UPDATED_BY_USER_ID' => 'LAST_UPDATED_BY_USER_ID',
        'last_updated_by_user_id' => 'LAST_UPDATED_BY_USER_ID',
        'employee.last_updated_by_user_id' => 'LAST_UPDATED_BY_USER_ID',
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
        $this->setName('employee');
        $this->setPhpName('Employee');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Employee');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('employee_employee_id_seq');
        // columns
        $this->addPrimaryKey('employee_id', 'EmployeeId', 'INTEGER', true, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', true, null, null);
        $this->addForeignKey('position_id', 'PositionId', 'INTEGER', 'positions', 'position_id', false, null, null);
        $this->addForeignKey('reporting_to', 'ReportingTo', 'INTEGER', 'positions', 'position_id', false, null, null);
        $this->addForeignKey('designation_id', 'DesignationId', 'INTEGER', 'designations', 'designation_id', false, null, null);
        $this->addForeignKey('branch_id', 'BranchId', 'INTEGER', 'branch', 'branch_id', true, null, null);
        $this->addForeignKey('grade_id', 'GradeId', 'INTEGER', 'grade_master', 'gradeid', true, null, null);
        $this->addForeignKey('org_unit_id', 'OrgUnitId', 'INTEGER', 'org_unit', 'orgunitid', true, null, null);
        $this->addColumn('employee_code', 'EmployeeCode', 'VARCHAR', false, 50, null);
        $this->addColumn('first_name', 'FirstName', 'VARCHAR', false, 50, null);
        $this->addColumn('last_name', 'LastName', 'VARCHAR', false, 50, null);
        $this->addColumn('status', 'Status', 'SMALLINT', false, null, null);
        $this->addColumn('ip_address', 'IpAddress', 'VARCHAR', false, 45, null);
        $this->addColumn('profile_picture', 'ProfilePicture', 'VARCHAR', false, 250, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 255, null);
        $this->addColumn('last_login', 'LastLogin', 'INTEGER', false, null, null);
        $this->addColumn('phone', 'Phone', 'VARCHAR', false, 50, null);
        $this->addColumn('address', 'Address', 'VARCHAR', false, 250, null);
        $this->addColumn('costnumber', 'Costnumber', 'VARCHAR', false, 250, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('base_mtarget', 'BaseMtarget', 'DECIMAL', false, 20, null);
        $this->addColumn('integration_id', 'IntegrationId', 'VARCHAR', false, 50, null);
        $this->addForeignKey('itownid', 'Itownid', 'INTEGER', 'geo_towns', 'itownid', false, null, null);
        $this->addColumn('islocked', 'Islocked', 'BOOLEAN', false, 1, false);
        $this->addColumn('lockedreason', 'Lockedreason', 'VARCHAR', false, null, null);
        $this->addColumn('lockeddate', 'Lockeddate', 'DATE', false, null, null);
        $this->addColumn('iseodcheckenabled', 'Iseodcheckenabled', 'INTEGER', false, null, 1);
        $this->addColumn('employee_media', 'EmployeeMedia', 'INTEGER', false, null, null);
        $this->addColumn('resi_address', 'ResiAddress', 'VARCHAR', false, 255, null);
        $this->addColumn('can_full_sync', 'CanFullSync', 'BOOLEAN', false, 1, true);
        $this->addColumn('remark', 'Remark', 'LONGVARCHAR', false, null, null);
        $this->addColumn('employee_spoken_language', 'EmployeeSpokenLanguage', 'LONGVARCHAR', false, null, null);
        $this->addColumn('last_updated_by_user_id', 'LastUpdatedByUserId', 'INTEGER', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Branch', '\\entities\\Branch', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':branch_id',
    1 => ':branch_id',
  ),
), null, null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('Designations', '\\entities\\Designations', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':designation_id',
    1 => ':designation_id',
  ),
), null, null, null, false);
        $this->addRelation('GradeMaster', '\\entities\\GradeMaster', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':grade_id',
    1 => ':gradeid',
  ),
), null, null, null, false);
        $this->addRelation('OrgUnit', '\\entities\\OrgUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':org_unit_id',
    1 => ':orgunitid',
  ),
), null, null, null, false);
        $this->addRelation('PositionsRelatedByPositionId', '\\entities\\Positions', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':position_id',
    1 => ':position_id',
  ),
), null, null, null, false);
        $this->addRelation('PositionsRelatedByReportingTo', '\\entities\\Positions', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':reporting_to',
    1 => ':position_id',
  ),
), null, null, null, false);
        $this->addRelation('GeoTowns', '\\entities\\GeoTowns', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':itownid',
    1 => ':itownid',
  ),
), null, null, null, false);
        $this->addRelation('AnnouncementEmployeeMap', '\\entities\\AnnouncementEmployeeMap', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'AnnouncementEmployeeMaps', false);
        $this->addRelation('Attendance', '\\entities\\Attendance', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'Attendances', false);
        $this->addRelation('AuditEmpUnits', '\\entities\\AuditEmpUnits', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), 'CASCADE', null, 'AuditEmpUnitss', false);
        $this->addRelation('BrandRcpa', '\\entities\\BrandRcpa', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'BrandRcpas', false);
        $this->addRelation('CompetitionMapping', '\\entities\\CompetitionMapping', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'CompetitionMappings', false);
        $this->addRelation('DailycallsSgpiout', '\\entities\\DailycallsSgpiout', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'DailycallsSgpiouts', false);
        $this->addRelation('EdSession', '\\entities\\EdSession', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'EdSessions', false);
        $this->addRelation('EmployeeIncentive', '\\entities\\EmployeeIncentive', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), 'CASCADE', null, 'EmployeeIncentives', false);
        $this->addRelation('EmployeePositionHistory', '\\entities\\EmployeePositionHistory', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'EmployeePositionHistories', false);
        $this->addRelation('EventsRelatedByEmployeeId', '\\entities\\Events', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'EventssRelatedByEmployeeId', false);
        $this->addRelation('EventsRelatedByApproverEmpId', '\\entities\\Events', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':approver_emp_id',
    1 => ':employee_id',
  ),
), null, null, 'EventssRelatedByApproverEmpId', false);
        $this->addRelation('ExpensePayments', '\\entities\\ExpensePayments', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'ExpensePaymentss', false);
        $this->addRelation('Expenses', '\\entities\\Expenses', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'Expensess', false);
        $this->addRelation('HrUserAccount', '\\entities\\HrUserAccount', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'HrUserAccounts', false);
        $this->addRelation('HrUserDates', '\\entities\\HrUserDates', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'HrUserDatess', false);
        $this->addRelation('HrUserDocuments', '\\entities\\HrUserDocuments', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'HrUserDocumentss', false);
        $this->addRelation('HrUserExperiences', '\\entities\\HrUserExperiences', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'HrUserExperiencess', false);
        $this->addRelation('HrUserQualification', '\\entities\\HrUserQualification', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'HrUserQualifications', false);
        $this->addRelation('HrUserReferences', '\\entities\\HrUserReferences', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'HrUserReferencess', false);
        $this->addRelation('LeaveRequest', '\\entities\\LeaveRequest', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'LeaveRequests', false);
        $this->addRelation('Leaves', '\\entities\\Leaves', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'Leavess', false);
        $this->addRelation('Mtp', '\\entities\\Mtp', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':mtp_approved_by',
    1 => ':employee_id',
  ),
), null, null, 'Mtps', false);
        $this->addRelation('OnBoardRequestRelatedByApprovedByEmployeeId', '\\entities\\OnBoardRequest', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':approved_by_employee_id',
    1 => ':employee_id',
  ),
), null, null, 'OnBoardRequestsRelatedByApprovedByEmployeeId', false);
        $this->addRelation('OnBoardRequestRelatedByCreatedByEmployeeId', '\\entities\\OnBoardRequest', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':created_by_employee_id',
    1 => ':employee_id',
  ),
), null, null, 'OnBoardRequestsRelatedByCreatedByEmployeeId', false);
        $this->addRelation('OnBoardRequestRelatedByFinalApprovedByEmployeeId', '\\entities\\OnBoardRequest', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':final_approved_by_employee_id',
    1 => ':employee_id',
  ),
), null, null, 'OnBoardRequestsRelatedByFinalApprovedByEmployeeId', false);
        $this->addRelation('OnBoardRequestRelatedByUpdatedByEmployeeId', '\\entities\\OnBoardRequest', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':updated_by_employee_id',
    1 => ':employee_id',
  ),
), null, null, 'OnBoardRequestsRelatedByUpdatedByEmployeeId', false);
        $this->addRelation('OnBoardRequestLog', '\\entities\\OnBoardRequestLog', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'OnBoardRequestLogs', false);
        $this->addRelation('Orders', '\\entities\\Orders', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'Orderss', false);
        $this->addRelation('OtpRequests', '\\entities\\OtpRequests', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':otp_request_employee',
    1 => ':employee_id',
  ),
), null, null, 'OtpRequestss', false);
        $this->addRelation('Outlets', '\\entities\\Outlets', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':outlet_created_by',
    1 => ':employee_id',
  ),
), null, null, 'Outletss', false);
        $this->addRelation('Reminders', '\\entities\\Reminders', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'Reminderss', false);
        $this->addRelation('SalaryAttendanceBackdateTrackLog', '\\entities\\SalaryAttendanceBackdateTrackLog', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'SalaryAttendanceBackdateTrackLogs', false);
        $this->addRelation('SurveySubmited', '\\entities\\SurveySubmited', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'SurveySubmiteds', false);
        $this->addRelation('TicketReplies', '\\entities\\TicketReplies', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'TicketRepliess', false);
        $this->addRelation('TicketType', '\\entities\\TicketType', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'TicketTypes', false);
        $this->addRelation('TicketsRelatedByEmployeeId', '\\entities\\Tickets', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'TicketssRelatedByEmployeeId', false);
        $this->addRelation('TicketsRelatedByAllocatedTo', '\\entities\\Tickets', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':allocated_to',
    1 => ':employee_id',
  ),
), null, null, 'TicketssRelatedByAllocatedTo', false);
        $this->addRelation('TransactionsRelatedByEmployeeId', '\\entities\\Transactions', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'TransactionssRelatedByEmployeeId', false);
        $this->addRelation('TransactionsRelatedByCreatedBy', '\\entities\\Transactions', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':created_by',
    1 => ':employee_id',
  ),
), null, null, 'TransactionssRelatedByCreatedBy', false);
        $this->addRelation('Users', '\\entities\\Users', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, 'Userss', false);
        $this->addRelation('WfLog', '\\entities\\WfLog', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':wf_employee_id',
    1 => ':employee_id',
  ),
), null, null, 'WfLogs', false);
        $this->addRelation('WfRequests', '\\entities\\WfRequests', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':wf_req_employee',
    1 => ':employee_id',
  ),
), null, null, 'WfRequestss', false);
    }

    /**
     * Method to invalidate the instance pool of all tables related to employee     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        AuditEmpUnitsTableMap::clearInstancePool();
        EmployeeIncentiveTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? EmployeeTableMap::CLASS_DEFAULT : EmployeeTableMap::OM_CLASS;
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
     * @return array (Employee object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = EmployeeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EmployeeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EmployeeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EmployeeTableMap::OM_CLASS;
            /** @var Employee $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EmployeeTableMap::addInstanceToPool($obj, $key);
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
            $key = EmployeeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EmployeeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Employee $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EmployeeTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EmployeeTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(EmployeeTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(EmployeeTableMap::COL_POSITION_ID);
            $criteria->addSelectColumn(EmployeeTableMap::COL_REPORTING_TO);
            $criteria->addSelectColumn(EmployeeTableMap::COL_DESIGNATION_ID);
            $criteria->addSelectColumn(EmployeeTableMap::COL_BRANCH_ID);
            $criteria->addSelectColumn(EmployeeTableMap::COL_GRADE_ID);
            $criteria->addSelectColumn(EmployeeTableMap::COL_ORG_UNIT_ID);
            $criteria->addSelectColumn(EmployeeTableMap::COL_EMPLOYEE_CODE);
            $criteria->addSelectColumn(EmployeeTableMap::COL_FIRST_NAME);
            $criteria->addSelectColumn(EmployeeTableMap::COL_LAST_NAME);
            $criteria->addSelectColumn(EmployeeTableMap::COL_STATUS);
            $criteria->addSelectColumn(EmployeeTableMap::COL_IP_ADDRESS);
            $criteria->addSelectColumn(EmployeeTableMap::COL_PROFILE_PICTURE);
            $criteria->addSelectColumn(EmployeeTableMap::COL_EMAIL);
            $criteria->addSelectColumn(EmployeeTableMap::COL_LAST_LOGIN);
            $criteria->addSelectColumn(EmployeeTableMap::COL_PHONE);
            $criteria->addSelectColumn(EmployeeTableMap::COL_ADDRESS);
            $criteria->addSelectColumn(EmployeeTableMap::COL_COSTNUMBER);
            $criteria->addSelectColumn(EmployeeTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(EmployeeTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(EmployeeTableMap::COL_BASE_MTARGET);
            $criteria->addSelectColumn(EmployeeTableMap::COL_INTEGRATION_ID);
            $criteria->addSelectColumn(EmployeeTableMap::COL_ITOWNID);
            $criteria->addSelectColumn(EmployeeTableMap::COL_ISLOCKED);
            $criteria->addSelectColumn(EmployeeTableMap::COL_LOCKEDREASON);
            $criteria->addSelectColumn(EmployeeTableMap::COL_LOCKEDDATE);
            $criteria->addSelectColumn(EmployeeTableMap::COL_ISEODCHECKENABLED);
            $criteria->addSelectColumn(EmployeeTableMap::COL_EMPLOYEE_MEDIA);
            $criteria->addSelectColumn(EmployeeTableMap::COL_RESI_ADDRESS);
            $criteria->addSelectColumn(EmployeeTableMap::COL_CAN_FULL_SYNC);
            $criteria->addSelectColumn(EmployeeTableMap::COL_REMARK);
            $criteria->addSelectColumn(EmployeeTableMap::COL_EMPLOYEE_SPOKEN_LANGUAGE);
            $criteria->addSelectColumn(EmployeeTableMap::COL_LAST_UPDATED_BY_USER_ID);
        } else {
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.position_id');
            $criteria->addSelectColumn($alias . '.reporting_to');
            $criteria->addSelectColumn($alias . '.designation_id');
            $criteria->addSelectColumn($alias . '.branch_id');
            $criteria->addSelectColumn($alias . '.grade_id');
            $criteria->addSelectColumn($alias . '.org_unit_id');
            $criteria->addSelectColumn($alias . '.employee_code');
            $criteria->addSelectColumn($alias . '.first_name');
            $criteria->addSelectColumn($alias . '.last_name');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.ip_address');
            $criteria->addSelectColumn($alias . '.profile_picture');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.last_login');
            $criteria->addSelectColumn($alias . '.phone');
            $criteria->addSelectColumn($alias . '.address');
            $criteria->addSelectColumn($alias . '.costnumber');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.base_mtarget');
            $criteria->addSelectColumn($alias . '.integration_id');
            $criteria->addSelectColumn($alias . '.itownid');
            $criteria->addSelectColumn($alias . '.islocked');
            $criteria->addSelectColumn($alias . '.lockedreason');
            $criteria->addSelectColumn($alias . '.lockeddate');
            $criteria->addSelectColumn($alias . '.iseodcheckenabled');
            $criteria->addSelectColumn($alias . '.employee_media');
            $criteria->addSelectColumn($alias . '.resi_address');
            $criteria->addSelectColumn($alias . '.can_full_sync');
            $criteria->addSelectColumn($alias . '.remark');
            $criteria->addSelectColumn($alias . '.employee_spoken_language');
            $criteria->addSelectColumn($alias . '.last_updated_by_user_id');
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
            $criteria->removeSelectColumn(EmployeeTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_POSITION_ID);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_REPORTING_TO);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_DESIGNATION_ID);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_BRANCH_ID);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_GRADE_ID);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_ORG_UNIT_ID);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_EMPLOYEE_CODE);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_FIRST_NAME);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_LAST_NAME);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_STATUS);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_IP_ADDRESS);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_PROFILE_PICTURE);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_EMAIL);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_LAST_LOGIN);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_PHONE);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_ADDRESS);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_COSTNUMBER);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_BASE_MTARGET);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_INTEGRATION_ID);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_ITOWNID);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_ISLOCKED);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_LOCKEDREASON);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_LOCKEDDATE);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_ISEODCHECKENABLED);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_EMPLOYEE_MEDIA);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_RESI_ADDRESS);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_CAN_FULL_SYNC);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_REMARK);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_EMPLOYEE_SPOKEN_LANGUAGE);
            $criteria->removeSelectColumn(EmployeeTableMap::COL_LAST_UPDATED_BY_USER_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.position_id');
            $criteria->removeSelectColumn($alias . '.reporting_to');
            $criteria->removeSelectColumn($alias . '.designation_id');
            $criteria->removeSelectColumn($alias . '.branch_id');
            $criteria->removeSelectColumn($alias . '.grade_id');
            $criteria->removeSelectColumn($alias . '.org_unit_id');
            $criteria->removeSelectColumn($alias . '.employee_code');
            $criteria->removeSelectColumn($alias . '.first_name');
            $criteria->removeSelectColumn($alias . '.last_name');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.ip_address');
            $criteria->removeSelectColumn($alias . '.profile_picture');
            $criteria->removeSelectColumn($alias . '.email');
            $criteria->removeSelectColumn($alias . '.last_login');
            $criteria->removeSelectColumn($alias . '.phone');
            $criteria->removeSelectColumn($alias . '.address');
            $criteria->removeSelectColumn($alias . '.costnumber');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.base_mtarget');
            $criteria->removeSelectColumn($alias . '.integration_id');
            $criteria->removeSelectColumn($alias . '.itownid');
            $criteria->removeSelectColumn($alias . '.islocked');
            $criteria->removeSelectColumn($alias . '.lockedreason');
            $criteria->removeSelectColumn($alias . '.lockeddate');
            $criteria->removeSelectColumn($alias . '.iseodcheckenabled');
            $criteria->removeSelectColumn($alias . '.employee_media');
            $criteria->removeSelectColumn($alias . '.resi_address');
            $criteria->removeSelectColumn($alias . '.can_full_sync');
            $criteria->removeSelectColumn($alias . '.remark');
            $criteria->removeSelectColumn($alias . '.employee_spoken_language');
            $criteria->removeSelectColumn($alias . '.last_updated_by_user_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(EmployeeTableMap::DATABASE_NAME)->getTable(EmployeeTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Employee or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Employee object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Employee) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EmployeeTableMap::DATABASE_NAME);
            $criteria->add(EmployeeTableMap::COL_EMPLOYEE_ID, (array) $values, Criteria::IN);
        }

        $query = EmployeeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EmployeeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EmployeeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the employee table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return EmployeeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Employee or Criteria object.
     *
     * @param mixed $criteria Criteria or Employee object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmployeeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Employee object
        }

        if ($criteria->containsKey(EmployeeTableMap::COL_EMPLOYEE_ID) && $criteria->keyContainsValue(EmployeeTableMap::COL_EMPLOYEE_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EmployeeTableMap::COL_EMPLOYEE_ID.')');
        }


        // Set the correct dbName
        $query = EmployeeQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
