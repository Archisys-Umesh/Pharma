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
use entities\OnBoardRequest;
use entities\OnBoardRequestQuery;


/**
 * This class defines the structure of the 'on_board_request' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OnBoardRequestTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.OnBoardRequestTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'on_board_request';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'OnBoardRequest';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\OnBoardRequest';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.OnBoardRequest';

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
     * the column name for the on_board_request_id field
     */
    public const COL_ON_BOARD_REQUEST_ID = 'on_board_request.on_board_request_id';

    /**
     * the column name for the outlet_id field
     */
    public const COL_OUTLET_ID = 'on_board_request.outlet_id';

    /**
     * the column name for the salutation field
     */
    public const COL_SALUTATION = 'on_board_request.salutation';

    /**
     * the column name for the first_name field
     */
    public const COL_FIRST_NAME = 'on_board_request.first_name';

    /**
     * the column name for the last_name field
     */
    public const COL_LAST_NAME = 'on_board_request.last_name';

    /**
     * the column name for the email field
     */
    public const COL_EMAIL = 'on_board_request.email';

    /**
     * the column name for the mobile field
     */
    public const COL_MOBILE = 'on_board_request.mobile';

    /**
     * the column name for the gender field
     */
    public const COL_GENDER = 'on_board_request.gender';

    /**
     * the column name for the date_of_birth field
     */
    public const COL_DATE_OF_BIRTH = 'on_board_request.date_of_birth';

    /**
     * the column name for the marital_status field
     */
    public const COL_MARITAL_STATUS = 'on_board_request.marital_status';

    /**
     * the column name for the date_of_anniversary field
     */
    public const COL_DATE_OF_ANNIVERSARY = 'on_board_request.date_of_anniversary';

    /**
     * the column name for the qualification field
     */
    public const COL_QUALIFICATION = 'on_board_request.qualification';

    /**
     * the column name for the registration_no field
     */
    public const COL_REGISTRATION_NO = 'on_board_request.registration_no';

    /**
     * the column name for the profile_pic field
     */
    public const COL_PROFILE_PIC = 'on_board_request.profile_pic';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'on_board_request.status';

    /**
     * the column name for the territory field
     */
    public const COL_TERRITORY = 'on_board_request.territory';

    /**
     * the column name for the position field
     */
    public const COL_POSITION = 'on_board_request.position';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'on_board_request.created_at';

    /**
     * the column name for the created_by_employee_id field
     */
    public const COL_CREATED_BY_EMPLOYEE_ID = 'on_board_request.created_by_employee_id';

    /**
     * the column name for the created_by_position_id field
     */
    public const COL_CREATED_BY_POSITION_ID = 'on_board_request.created_by_position_id';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'on_board_request.updated_at';

    /**
     * the column name for the updated_by_employee_id field
     */
    public const COL_UPDATED_BY_EMPLOYEE_ID = 'on_board_request.updated_by_employee_id';

    /**
     * the column name for the updated_by_position_id field
     */
    public const COL_UPDATED_BY_POSITION_ID = 'on_board_request.updated_by_position_id';

    /**
     * the column name for the approved_at field
     */
    public const COL_APPROVED_AT = 'on_board_request.approved_at';

    /**
     * the column name for the approved_by_employee_id field
     */
    public const COL_APPROVED_BY_EMPLOYEE_ID = 'on_board_request.approved_by_employee_id';

    /**
     * the column name for the approved_by_position_id field
     */
    public const COL_APPROVED_BY_POSITION_ID = 'on_board_request.approved_by_position_id';

    /**
     * the column name for the final_approved_at field
     */
    public const COL_FINAL_APPROVED_AT = 'on_board_request.final_approved_at';

    /**
     * the column name for the final_approved_by_employee_id field
     */
    public const COL_FINAL_APPROVED_BY_EMPLOYEE_ID = 'on_board_request.final_approved_by_employee_id';

    /**
     * the column name for the final_approved_by_position_id field
     */
    public const COL_FINAL_APPROVED_BY_POSITION_ID = 'on_board_request.final_approved_by_position_id';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'on_board_request.company_id';

    /**
     * the column name for the descriptioin field
     */
    public const COL_DESCRIPTIOIN = 'on_board_request.descriptioin';

    /**
     * the column name for the outlet_type_id field
     */
    public const COL_OUTLET_TYPE_ID = 'on_board_request.outlet_type_id';

    /**
     * the column name for the outlet_name field
     */
    public const COL_OUTLET_NAME = 'on_board_request.outlet_name';

    /**
     * the column name for the outlet_code field
     */
    public const COL_OUTLET_CODE = 'on_board_request.outlet_code';

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
        self::TYPE_PHPNAME       => ['OnBoardRequestId', 'OutletId', 'Salutation', 'FirstName', 'LastName', 'Email', 'Mobile', 'Gender', 'DateOfBirth', 'MaritalStatus', 'DateOfAnniversary', 'Qualification', 'RegistrationNo', 'ProfilePic', 'Status', 'Territory', 'Position', 'CreatedAt', 'CreatedByEmployeeId', 'CreatedByPositionId', 'UpdatedAt', 'UpdatedByEmployeeId', 'UpdatedByPositionId', 'ApprovedAt', 'ApprovedByEmployeeId', 'ApprovedByPositionId', 'FinalApprovedAt', 'FinalApprovedByEmployeeId', 'FinalApprovedByPositionId', 'CompanyId', 'Descriptioin', 'OutletTypeId', 'OutletName', 'OutletCode', ],
        self::TYPE_CAMELNAME     => ['onBoardRequestId', 'outletId', 'salutation', 'firstName', 'lastName', 'email', 'mobile', 'gender', 'dateOfBirth', 'maritalStatus', 'dateOfAnniversary', 'qualification', 'registrationNo', 'profilePic', 'status', 'territory', 'position', 'createdAt', 'createdByEmployeeId', 'createdByPositionId', 'updatedAt', 'updatedByEmployeeId', 'updatedByPositionId', 'approvedAt', 'approvedByEmployeeId', 'approvedByPositionId', 'finalApprovedAt', 'finalApprovedByEmployeeId', 'finalApprovedByPositionId', 'companyId', 'descriptioin', 'outletTypeId', 'outletName', 'outletCode', ],
        self::TYPE_COLNAME       => [OnBoardRequestTableMap::COL_ON_BOARD_REQUEST_ID, OnBoardRequestTableMap::COL_OUTLET_ID, OnBoardRequestTableMap::COL_SALUTATION, OnBoardRequestTableMap::COL_FIRST_NAME, OnBoardRequestTableMap::COL_LAST_NAME, OnBoardRequestTableMap::COL_EMAIL, OnBoardRequestTableMap::COL_MOBILE, OnBoardRequestTableMap::COL_GENDER, OnBoardRequestTableMap::COL_DATE_OF_BIRTH, OnBoardRequestTableMap::COL_MARITAL_STATUS, OnBoardRequestTableMap::COL_DATE_OF_ANNIVERSARY, OnBoardRequestTableMap::COL_QUALIFICATION, OnBoardRequestTableMap::COL_REGISTRATION_NO, OnBoardRequestTableMap::COL_PROFILE_PIC, OnBoardRequestTableMap::COL_STATUS, OnBoardRequestTableMap::COL_TERRITORY, OnBoardRequestTableMap::COL_POSITION, OnBoardRequestTableMap::COL_CREATED_AT, OnBoardRequestTableMap::COL_CREATED_BY_EMPLOYEE_ID, OnBoardRequestTableMap::COL_CREATED_BY_POSITION_ID, OnBoardRequestTableMap::COL_UPDATED_AT, OnBoardRequestTableMap::COL_UPDATED_BY_EMPLOYEE_ID, OnBoardRequestTableMap::COL_UPDATED_BY_POSITION_ID, OnBoardRequestTableMap::COL_APPROVED_AT, OnBoardRequestTableMap::COL_APPROVED_BY_EMPLOYEE_ID, OnBoardRequestTableMap::COL_APPROVED_BY_POSITION_ID, OnBoardRequestTableMap::COL_FINAL_APPROVED_AT, OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_EMPLOYEE_ID, OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_POSITION_ID, OnBoardRequestTableMap::COL_COMPANY_ID, OnBoardRequestTableMap::COL_DESCRIPTIOIN, OnBoardRequestTableMap::COL_OUTLET_TYPE_ID, OnBoardRequestTableMap::COL_OUTLET_NAME, OnBoardRequestTableMap::COL_OUTLET_CODE, ],
        self::TYPE_FIELDNAME     => ['on_board_request_id', 'outlet_id', 'salutation', 'first_name', 'last_name', 'email', 'mobile', 'gender', 'date_of_birth', 'marital_status', 'date_of_anniversary', 'qualification', 'registration_no', 'profile_pic', 'status', 'territory', 'position', 'created_at', 'created_by_employee_id', 'created_by_position_id', 'updated_at', 'updated_by_employee_id', 'updated_by_position_id', 'approved_at', 'approved_by_employee_id', 'approved_by_position_id', 'final_approved_at', 'final_approved_by_employee_id', 'final_approved_by_position_id', 'company_id', 'descriptioin', 'outlet_type_id', 'outlet_name', 'outlet_code', ],
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
        self::TYPE_PHPNAME       => ['OnBoardRequestId' => 0, 'OutletId' => 1, 'Salutation' => 2, 'FirstName' => 3, 'LastName' => 4, 'Email' => 5, 'Mobile' => 6, 'Gender' => 7, 'DateOfBirth' => 8, 'MaritalStatus' => 9, 'DateOfAnniversary' => 10, 'Qualification' => 11, 'RegistrationNo' => 12, 'ProfilePic' => 13, 'Status' => 14, 'Territory' => 15, 'Position' => 16, 'CreatedAt' => 17, 'CreatedByEmployeeId' => 18, 'CreatedByPositionId' => 19, 'UpdatedAt' => 20, 'UpdatedByEmployeeId' => 21, 'UpdatedByPositionId' => 22, 'ApprovedAt' => 23, 'ApprovedByEmployeeId' => 24, 'ApprovedByPositionId' => 25, 'FinalApprovedAt' => 26, 'FinalApprovedByEmployeeId' => 27, 'FinalApprovedByPositionId' => 28, 'CompanyId' => 29, 'Descriptioin' => 30, 'OutletTypeId' => 31, 'OutletName' => 32, 'OutletCode' => 33, ],
        self::TYPE_CAMELNAME     => ['onBoardRequestId' => 0, 'outletId' => 1, 'salutation' => 2, 'firstName' => 3, 'lastName' => 4, 'email' => 5, 'mobile' => 6, 'gender' => 7, 'dateOfBirth' => 8, 'maritalStatus' => 9, 'dateOfAnniversary' => 10, 'qualification' => 11, 'registrationNo' => 12, 'profilePic' => 13, 'status' => 14, 'territory' => 15, 'position' => 16, 'createdAt' => 17, 'createdByEmployeeId' => 18, 'createdByPositionId' => 19, 'updatedAt' => 20, 'updatedByEmployeeId' => 21, 'updatedByPositionId' => 22, 'approvedAt' => 23, 'approvedByEmployeeId' => 24, 'approvedByPositionId' => 25, 'finalApprovedAt' => 26, 'finalApprovedByEmployeeId' => 27, 'finalApprovedByPositionId' => 28, 'companyId' => 29, 'descriptioin' => 30, 'outletTypeId' => 31, 'outletName' => 32, 'outletCode' => 33, ],
        self::TYPE_COLNAME       => [OnBoardRequestTableMap::COL_ON_BOARD_REQUEST_ID => 0, OnBoardRequestTableMap::COL_OUTLET_ID => 1, OnBoardRequestTableMap::COL_SALUTATION => 2, OnBoardRequestTableMap::COL_FIRST_NAME => 3, OnBoardRequestTableMap::COL_LAST_NAME => 4, OnBoardRequestTableMap::COL_EMAIL => 5, OnBoardRequestTableMap::COL_MOBILE => 6, OnBoardRequestTableMap::COL_GENDER => 7, OnBoardRequestTableMap::COL_DATE_OF_BIRTH => 8, OnBoardRequestTableMap::COL_MARITAL_STATUS => 9, OnBoardRequestTableMap::COL_DATE_OF_ANNIVERSARY => 10, OnBoardRequestTableMap::COL_QUALIFICATION => 11, OnBoardRequestTableMap::COL_REGISTRATION_NO => 12, OnBoardRequestTableMap::COL_PROFILE_PIC => 13, OnBoardRequestTableMap::COL_STATUS => 14, OnBoardRequestTableMap::COL_TERRITORY => 15, OnBoardRequestTableMap::COL_POSITION => 16, OnBoardRequestTableMap::COL_CREATED_AT => 17, OnBoardRequestTableMap::COL_CREATED_BY_EMPLOYEE_ID => 18, OnBoardRequestTableMap::COL_CREATED_BY_POSITION_ID => 19, OnBoardRequestTableMap::COL_UPDATED_AT => 20, OnBoardRequestTableMap::COL_UPDATED_BY_EMPLOYEE_ID => 21, OnBoardRequestTableMap::COL_UPDATED_BY_POSITION_ID => 22, OnBoardRequestTableMap::COL_APPROVED_AT => 23, OnBoardRequestTableMap::COL_APPROVED_BY_EMPLOYEE_ID => 24, OnBoardRequestTableMap::COL_APPROVED_BY_POSITION_ID => 25, OnBoardRequestTableMap::COL_FINAL_APPROVED_AT => 26, OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_EMPLOYEE_ID => 27, OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_POSITION_ID => 28, OnBoardRequestTableMap::COL_COMPANY_ID => 29, OnBoardRequestTableMap::COL_DESCRIPTIOIN => 30, OnBoardRequestTableMap::COL_OUTLET_TYPE_ID => 31, OnBoardRequestTableMap::COL_OUTLET_NAME => 32, OnBoardRequestTableMap::COL_OUTLET_CODE => 33, ],
        self::TYPE_FIELDNAME     => ['on_board_request_id' => 0, 'outlet_id' => 1, 'salutation' => 2, 'first_name' => 3, 'last_name' => 4, 'email' => 5, 'mobile' => 6, 'gender' => 7, 'date_of_birth' => 8, 'marital_status' => 9, 'date_of_anniversary' => 10, 'qualification' => 11, 'registration_no' => 12, 'profile_pic' => 13, 'status' => 14, 'territory' => 15, 'position' => 16, 'created_at' => 17, 'created_by_employee_id' => 18, 'created_by_position_id' => 19, 'updated_at' => 20, 'updated_by_employee_id' => 21, 'updated_by_position_id' => 22, 'approved_at' => 23, 'approved_by_employee_id' => 24, 'approved_by_position_id' => 25, 'final_approved_at' => 26, 'final_approved_by_employee_id' => 27, 'final_approved_by_position_id' => 28, 'company_id' => 29, 'descriptioin' => 30, 'outlet_type_id' => 31, 'outlet_name' => 32, 'outlet_code' => 33, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'OnBoardRequestId' => 'ON_BOARD_REQUEST_ID',
        'OnBoardRequest.OnBoardRequestId' => 'ON_BOARD_REQUEST_ID',
        'onBoardRequestId' => 'ON_BOARD_REQUEST_ID',
        'onBoardRequest.onBoardRequestId' => 'ON_BOARD_REQUEST_ID',
        'OnBoardRequestTableMap::COL_ON_BOARD_REQUEST_ID' => 'ON_BOARD_REQUEST_ID',
        'COL_ON_BOARD_REQUEST_ID' => 'ON_BOARD_REQUEST_ID',
        'on_board_request_id' => 'ON_BOARD_REQUEST_ID',
        'on_board_request.on_board_request_id' => 'ON_BOARD_REQUEST_ID',
        'OutletId' => 'OUTLET_ID',
        'OnBoardRequest.OutletId' => 'OUTLET_ID',
        'outletId' => 'OUTLET_ID',
        'onBoardRequest.outletId' => 'OUTLET_ID',
        'OnBoardRequestTableMap::COL_OUTLET_ID' => 'OUTLET_ID',
        'COL_OUTLET_ID' => 'OUTLET_ID',
        'outlet_id' => 'OUTLET_ID',
        'on_board_request.outlet_id' => 'OUTLET_ID',
        'Salutation' => 'SALUTATION',
        'OnBoardRequest.Salutation' => 'SALUTATION',
        'salutation' => 'SALUTATION',
        'onBoardRequest.salutation' => 'SALUTATION',
        'OnBoardRequestTableMap::COL_SALUTATION' => 'SALUTATION',
        'COL_SALUTATION' => 'SALUTATION',
        'on_board_request.salutation' => 'SALUTATION',
        'FirstName' => 'FIRST_NAME',
        'OnBoardRequest.FirstName' => 'FIRST_NAME',
        'firstName' => 'FIRST_NAME',
        'onBoardRequest.firstName' => 'FIRST_NAME',
        'OnBoardRequestTableMap::COL_FIRST_NAME' => 'FIRST_NAME',
        'COL_FIRST_NAME' => 'FIRST_NAME',
        'first_name' => 'FIRST_NAME',
        'on_board_request.first_name' => 'FIRST_NAME',
        'LastName' => 'LAST_NAME',
        'OnBoardRequest.LastName' => 'LAST_NAME',
        'lastName' => 'LAST_NAME',
        'onBoardRequest.lastName' => 'LAST_NAME',
        'OnBoardRequestTableMap::COL_LAST_NAME' => 'LAST_NAME',
        'COL_LAST_NAME' => 'LAST_NAME',
        'last_name' => 'LAST_NAME',
        'on_board_request.last_name' => 'LAST_NAME',
        'Email' => 'EMAIL',
        'OnBoardRequest.Email' => 'EMAIL',
        'email' => 'EMAIL',
        'onBoardRequest.email' => 'EMAIL',
        'OnBoardRequestTableMap::COL_EMAIL' => 'EMAIL',
        'COL_EMAIL' => 'EMAIL',
        'on_board_request.email' => 'EMAIL',
        'Mobile' => 'MOBILE',
        'OnBoardRequest.Mobile' => 'MOBILE',
        'mobile' => 'MOBILE',
        'onBoardRequest.mobile' => 'MOBILE',
        'OnBoardRequestTableMap::COL_MOBILE' => 'MOBILE',
        'COL_MOBILE' => 'MOBILE',
        'on_board_request.mobile' => 'MOBILE',
        'Gender' => 'GENDER',
        'OnBoardRequest.Gender' => 'GENDER',
        'gender' => 'GENDER',
        'onBoardRequest.gender' => 'GENDER',
        'OnBoardRequestTableMap::COL_GENDER' => 'GENDER',
        'COL_GENDER' => 'GENDER',
        'on_board_request.gender' => 'GENDER',
        'DateOfBirth' => 'DATE_OF_BIRTH',
        'OnBoardRequest.DateOfBirth' => 'DATE_OF_BIRTH',
        'dateOfBirth' => 'DATE_OF_BIRTH',
        'onBoardRequest.dateOfBirth' => 'DATE_OF_BIRTH',
        'OnBoardRequestTableMap::COL_DATE_OF_BIRTH' => 'DATE_OF_BIRTH',
        'COL_DATE_OF_BIRTH' => 'DATE_OF_BIRTH',
        'date_of_birth' => 'DATE_OF_BIRTH',
        'on_board_request.date_of_birth' => 'DATE_OF_BIRTH',
        'MaritalStatus' => 'MARITAL_STATUS',
        'OnBoardRequest.MaritalStatus' => 'MARITAL_STATUS',
        'maritalStatus' => 'MARITAL_STATUS',
        'onBoardRequest.maritalStatus' => 'MARITAL_STATUS',
        'OnBoardRequestTableMap::COL_MARITAL_STATUS' => 'MARITAL_STATUS',
        'COL_MARITAL_STATUS' => 'MARITAL_STATUS',
        'marital_status' => 'MARITAL_STATUS',
        'on_board_request.marital_status' => 'MARITAL_STATUS',
        'DateOfAnniversary' => 'DATE_OF_ANNIVERSARY',
        'OnBoardRequest.DateOfAnniversary' => 'DATE_OF_ANNIVERSARY',
        'dateOfAnniversary' => 'DATE_OF_ANNIVERSARY',
        'onBoardRequest.dateOfAnniversary' => 'DATE_OF_ANNIVERSARY',
        'OnBoardRequestTableMap::COL_DATE_OF_ANNIVERSARY' => 'DATE_OF_ANNIVERSARY',
        'COL_DATE_OF_ANNIVERSARY' => 'DATE_OF_ANNIVERSARY',
        'date_of_anniversary' => 'DATE_OF_ANNIVERSARY',
        'on_board_request.date_of_anniversary' => 'DATE_OF_ANNIVERSARY',
        'Qualification' => 'QUALIFICATION',
        'OnBoardRequest.Qualification' => 'QUALIFICATION',
        'qualification' => 'QUALIFICATION',
        'onBoardRequest.qualification' => 'QUALIFICATION',
        'OnBoardRequestTableMap::COL_QUALIFICATION' => 'QUALIFICATION',
        'COL_QUALIFICATION' => 'QUALIFICATION',
        'on_board_request.qualification' => 'QUALIFICATION',
        'RegistrationNo' => 'REGISTRATION_NO',
        'OnBoardRequest.RegistrationNo' => 'REGISTRATION_NO',
        'registrationNo' => 'REGISTRATION_NO',
        'onBoardRequest.registrationNo' => 'REGISTRATION_NO',
        'OnBoardRequestTableMap::COL_REGISTRATION_NO' => 'REGISTRATION_NO',
        'COL_REGISTRATION_NO' => 'REGISTRATION_NO',
        'registration_no' => 'REGISTRATION_NO',
        'on_board_request.registration_no' => 'REGISTRATION_NO',
        'ProfilePic' => 'PROFILE_PIC',
        'OnBoardRequest.ProfilePic' => 'PROFILE_PIC',
        'profilePic' => 'PROFILE_PIC',
        'onBoardRequest.profilePic' => 'PROFILE_PIC',
        'OnBoardRequestTableMap::COL_PROFILE_PIC' => 'PROFILE_PIC',
        'COL_PROFILE_PIC' => 'PROFILE_PIC',
        'profile_pic' => 'PROFILE_PIC',
        'on_board_request.profile_pic' => 'PROFILE_PIC',
        'Status' => 'STATUS',
        'OnBoardRequest.Status' => 'STATUS',
        'status' => 'STATUS',
        'onBoardRequest.status' => 'STATUS',
        'OnBoardRequestTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'on_board_request.status' => 'STATUS',
        'Territory' => 'TERRITORY',
        'OnBoardRequest.Territory' => 'TERRITORY',
        'territory' => 'TERRITORY',
        'onBoardRequest.territory' => 'TERRITORY',
        'OnBoardRequestTableMap::COL_TERRITORY' => 'TERRITORY',
        'COL_TERRITORY' => 'TERRITORY',
        'on_board_request.territory' => 'TERRITORY',
        'Position' => 'POSITION',
        'OnBoardRequest.Position' => 'POSITION',
        'position' => 'POSITION',
        'onBoardRequest.position' => 'POSITION',
        'OnBoardRequestTableMap::COL_POSITION' => 'POSITION',
        'COL_POSITION' => 'POSITION',
        'on_board_request.position' => 'POSITION',
        'CreatedAt' => 'CREATED_AT',
        'OnBoardRequest.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'onBoardRequest.createdAt' => 'CREATED_AT',
        'OnBoardRequestTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'on_board_request.created_at' => 'CREATED_AT',
        'CreatedByEmployeeId' => 'CREATED_BY_EMPLOYEE_ID',
        'OnBoardRequest.CreatedByEmployeeId' => 'CREATED_BY_EMPLOYEE_ID',
        'createdByEmployeeId' => 'CREATED_BY_EMPLOYEE_ID',
        'onBoardRequest.createdByEmployeeId' => 'CREATED_BY_EMPLOYEE_ID',
        'OnBoardRequestTableMap::COL_CREATED_BY_EMPLOYEE_ID' => 'CREATED_BY_EMPLOYEE_ID',
        'COL_CREATED_BY_EMPLOYEE_ID' => 'CREATED_BY_EMPLOYEE_ID',
        'created_by_employee_id' => 'CREATED_BY_EMPLOYEE_ID',
        'on_board_request.created_by_employee_id' => 'CREATED_BY_EMPLOYEE_ID',
        'CreatedByPositionId' => 'CREATED_BY_POSITION_ID',
        'OnBoardRequest.CreatedByPositionId' => 'CREATED_BY_POSITION_ID',
        'createdByPositionId' => 'CREATED_BY_POSITION_ID',
        'onBoardRequest.createdByPositionId' => 'CREATED_BY_POSITION_ID',
        'OnBoardRequestTableMap::COL_CREATED_BY_POSITION_ID' => 'CREATED_BY_POSITION_ID',
        'COL_CREATED_BY_POSITION_ID' => 'CREATED_BY_POSITION_ID',
        'created_by_position_id' => 'CREATED_BY_POSITION_ID',
        'on_board_request.created_by_position_id' => 'CREATED_BY_POSITION_ID',
        'UpdatedAt' => 'UPDATED_AT',
        'OnBoardRequest.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'onBoardRequest.updatedAt' => 'UPDATED_AT',
        'OnBoardRequestTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'on_board_request.updated_at' => 'UPDATED_AT',
        'UpdatedByEmployeeId' => 'UPDATED_BY_EMPLOYEE_ID',
        'OnBoardRequest.UpdatedByEmployeeId' => 'UPDATED_BY_EMPLOYEE_ID',
        'updatedByEmployeeId' => 'UPDATED_BY_EMPLOYEE_ID',
        'onBoardRequest.updatedByEmployeeId' => 'UPDATED_BY_EMPLOYEE_ID',
        'OnBoardRequestTableMap::COL_UPDATED_BY_EMPLOYEE_ID' => 'UPDATED_BY_EMPLOYEE_ID',
        'COL_UPDATED_BY_EMPLOYEE_ID' => 'UPDATED_BY_EMPLOYEE_ID',
        'updated_by_employee_id' => 'UPDATED_BY_EMPLOYEE_ID',
        'on_board_request.updated_by_employee_id' => 'UPDATED_BY_EMPLOYEE_ID',
        'UpdatedByPositionId' => 'UPDATED_BY_POSITION_ID',
        'OnBoardRequest.UpdatedByPositionId' => 'UPDATED_BY_POSITION_ID',
        'updatedByPositionId' => 'UPDATED_BY_POSITION_ID',
        'onBoardRequest.updatedByPositionId' => 'UPDATED_BY_POSITION_ID',
        'OnBoardRequestTableMap::COL_UPDATED_BY_POSITION_ID' => 'UPDATED_BY_POSITION_ID',
        'COL_UPDATED_BY_POSITION_ID' => 'UPDATED_BY_POSITION_ID',
        'updated_by_position_id' => 'UPDATED_BY_POSITION_ID',
        'on_board_request.updated_by_position_id' => 'UPDATED_BY_POSITION_ID',
        'ApprovedAt' => 'APPROVED_AT',
        'OnBoardRequest.ApprovedAt' => 'APPROVED_AT',
        'approvedAt' => 'APPROVED_AT',
        'onBoardRequest.approvedAt' => 'APPROVED_AT',
        'OnBoardRequestTableMap::COL_APPROVED_AT' => 'APPROVED_AT',
        'COL_APPROVED_AT' => 'APPROVED_AT',
        'approved_at' => 'APPROVED_AT',
        'on_board_request.approved_at' => 'APPROVED_AT',
        'ApprovedByEmployeeId' => 'APPROVED_BY_EMPLOYEE_ID',
        'OnBoardRequest.ApprovedByEmployeeId' => 'APPROVED_BY_EMPLOYEE_ID',
        'approvedByEmployeeId' => 'APPROVED_BY_EMPLOYEE_ID',
        'onBoardRequest.approvedByEmployeeId' => 'APPROVED_BY_EMPLOYEE_ID',
        'OnBoardRequestTableMap::COL_APPROVED_BY_EMPLOYEE_ID' => 'APPROVED_BY_EMPLOYEE_ID',
        'COL_APPROVED_BY_EMPLOYEE_ID' => 'APPROVED_BY_EMPLOYEE_ID',
        'approved_by_employee_id' => 'APPROVED_BY_EMPLOYEE_ID',
        'on_board_request.approved_by_employee_id' => 'APPROVED_BY_EMPLOYEE_ID',
        'ApprovedByPositionId' => 'APPROVED_BY_POSITION_ID',
        'OnBoardRequest.ApprovedByPositionId' => 'APPROVED_BY_POSITION_ID',
        'approvedByPositionId' => 'APPROVED_BY_POSITION_ID',
        'onBoardRequest.approvedByPositionId' => 'APPROVED_BY_POSITION_ID',
        'OnBoardRequestTableMap::COL_APPROVED_BY_POSITION_ID' => 'APPROVED_BY_POSITION_ID',
        'COL_APPROVED_BY_POSITION_ID' => 'APPROVED_BY_POSITION_ID',
        'approved_by_position_id' => 'APPROVED_BY_POSITION_ID',
        'on_board_request.approved_by_position_id' => 'APPROVED_BY_POSITION_ID',
        'FinalApprovedAt' => 'FINAL_APPROVED_AT',
        'OnBoardRequest.FinalApprovedAt' => 'FINAL_APPROVED_AT',
        'finalApprovedAt' => 'FINAL_APPROVED_AT',
        'onBoardRequest.finalApprovedAt' => 'FINAL_APPROVED_AT',
        'OnBoardRequestTableMap::COL_FINAL_APPROVED_AT' => 'FINAL_APPROVED_AT',
        'COL_FINAL_APPROVED_AT' => 'FINAL_APPROVED_AT',
        'final_approved_at' => 'FINAL_APPROVED_AT',
        'on_board_request.final_approved_at' => 'FINAL_APPROVED_AT',
        'FinalApprovedByEmployeeId' => 'FINAL_APPROVED_BY_EMPLOYEE_ID',
        'OnBoardRequest.FinalApprovedByEmployeeId' => 'FINAL_APPROVED_BY_EMPLOYEE_ID',
        'finalApprovedByEmployeeId' => 'FINAL_APPROVED_BY_EMPLOYEE_ID',
        'onBoardRequest.finalApprovedByEmployeeId' => 'FINAL_APPROVED_BY_EMPLOYEE_ID',
        'OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_EMPLOYEE_ID' => 'FINAL_APPROVED_BY_EMPLOYEE_ID',
        'COL_FINAL_APPROVED_BY_EMPLOYEE_ID' => 'FINAL_APPROVED_BY_EMPLOYEE_ID',
        'final_approved_by_employee_id' => 'FINAL_APPROVED_BY_EMPLOYEE_ID',
        'on_board_request.final_approved_by_employee_id' => 'FINAL_APPROVED_BY_EMPLOYEE_ID',
        'FinalApprovedByPositionId' => 'FINAL_APPROVED_BY_POSITION_ID',
        'OnBoardRequest.FinalApprovedByPositionId' => 'FINAL_APPROVED_BY_POSITION_ID',
        'finalApprovedByPositionId' => 'FINAL_APPROVED_BY_POSITION_ID',
        'onBoardRequest.finalApprovedByPositionId' => 'FINAL_APPROVED_BY_POSITION_ID',
        'OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_POSITION_ID' => 'FINAL_APPROVED_BY_POSITION_ID',
        'COL_FINAL_APPROVED_BY_POSITION_ID' => 'FINAL_APPROVED_BY_POSITION_ID',
        'final_approved_by_position_id' => 'FINAL_APPROVED_BY_POSITION_ID',
        'on_board_request.final_approved_by_position_id' => 'FINAL_APPROVED_BY_POSITION_ID',
        'CompanyId' => 'COMPANY_ID',
        'OnBoardRequest.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'onBoardRequest.companyId' => 'COMPANY_ID',
        'OnBoardRequestTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'on_board_request.company_id' => 'COMPANY_ID',
        'Descriptioin' => 'DESCRIPTIOIN',
        'OnBoardRequest.Descriptioin' => 'DESCRIPTIOIN',
        'descriptioin' => 'DESCRIPTIOIN',
        'onBoardRequest.descriptioin' => 'DESCRIPTIOIN',
        'OnBoardRequestTableMap::COL_DESCRIPTIOIN' => 'DESCRIPTIOIN',
        'COL_DESCRIPTIOIN' => 'DESCRIPTIOIN',
        'on_board_request.descriptioin' => 'DESCRIPTIOIN',
        'OutletTypeId' => 'OUTLET_TYPE_ID',
        'OnBoardRequest.OutletTypeId' => 'OUTLET_TYPE_ID',
        'outletTypeId' => 'OUTLET_TYPE_ID',
        'onBoardRequest.outletTypeId' => 'OUTLET_TYPE_ID',
        'OnBoardRequestTableMap::COL_OUTLET_TYPE_ID' => 'OUTLET_TYPE_ID',
        'COL_OUTLET_TYPE_ID' => 'OUTLET_TYPE_ID',
        'outlet_type_id' => 'OUTLET_TYPE_ID',
        'on_board_request.outlet_type_id' => 'OUTLET_TYPE_ID',
        'OutletName' => 'OUTLET_NAME',
        'OnBoardRequest.OutletName' => 'OUTLET_NAME',
        'outletName' => 'OUTLET_NAME',
        'onBoardRequest.outletName' => 'OUTLET_NAME',
        'OnBoardRequestTableMap::COL_OUTLET_NAME' => 'OUTLET_NAME',
        'COL_OUTLET_NAME' => 'OUTLET_NAME',
        'outlet_name' => 'OUTLET_NAME',
        'on_board_request.outlet_name' => 'OUTLET_NAME',
        'OutletCode' => 'OUTLET_CODE',
        'OnBoardRequest.OutletCode' => 'OUTLET_CODE',
        'outletCode' => 'OUTLET_CODE',
        'onBoardRequest.outletCode' => 'OUTLET_CODE',
        'OnBoardRequestTableMap::COL_OUTLET_CODE' => 'OUTLET_CODE',
        'COL_OUTLET_CODE' => 'OUTLET_CODE',
        'outlet_code' => 'OUTLET_CODE',
        'on_board_request.outlet_code' => 'OUTLET_CODE',
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
        $this->setName('on_board_request');
        $this->setPhpName('OnBoardRequest');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\OnBoardRequest');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('on_board_request_on_board_request_id_seq');
        // columns
        $this->addPrimaryKey('on_board_request_id', 'OnBoardRequestId', 'INTEGER', true, null, null);
        $this->addForeignKey('outlet_id', 'OutletId', 'INTEGER', 'outlets', 'id', false, null, null);
        $this->addColumn('salutation', 'Salutation', 'VARCHAR', false, null, null);
        $this->addColumn('first_name', 'FirstName', 'VARCHAR', false, null, null);
        $this->addColumn('last_name', 'LastName', 'VARCHAR', false, null, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, null, null);
        $this->addColumn('mobile', 'Mobile', 'VARCHAR', false, null, null);
        $this->addColumn('gender', 'Gender', 'VARCHAR', false, null, null);
        $this->addColumn('date_of_birth', 'DateOfBirth', 'DATE', false, null, null);
        $this->addColumn('marital_status', 'MaritalStatus', 'VARCHAR', false, null, null);
        $this->addColumn('date_of_anniversary', 'DateOfAnniversary', 'DATE', false, null, null);
        $this->addColumn('qualification', 'Qualification', 'VARCHAR', false, null, null);
        $this->addColumn('registration_no', 'RegistrationNo', 'VARCHAR', false, null, null);
        $this->addColumn('profile_pic', 'ProfilePic', 'VARCHAR', false, null, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, null, null);
        $this->addForeignKey('territory', 'Territory', 'INTEGER', 'territories', 'territory_id', false, null, null);
        $this->addForeignKey('position', 'Position', 'INTEGER', 'positions', 'position_id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addForeignKey('created_by_employee_id', 'CreatedByEmployeeId', 'INTEGER', 'employee', 'employee_id', false, null, null);
        $this->addForeignKey('created_by_position_id', 'CreatedByPositionId', 'INTEGER', 'positions', 'position_id', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('updated_by_employee_id', 'UpdatedByEmployeeId', 'INTEGER', 'employee', 'employee_id', false, null, null);
        $this->addForeignKey('updated_by_position_id', 'UpdatedByPositionId', 'INTEGER', 'positions', 'position_id', false, null, null);
        $this->addColumn('approved_at', 'ApprovedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('approved_by_employee_id', 'ApprovedByEmployeeId', 'INTEGER', 'employee', 'employee_id', false, null, null);
        $this->addForeignKey('approved_by_position_id', 'ApprovedByPositionId', 'INTEGER', 'positions', 'position_id', false, null, null);
        $this->addColumn('final_approved_at', 'FinalApprovedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('final_approved_by_employee_id', 'FinalApprovedByEmployeeId', 'INTEGER', 'employee', 'employee_id', false, null, null);
        $this->addForeignKey('final_approved_by_position_id', 'FinalApprovedByPositionId', 'INTEGER', 'positions', 'position_id', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('descriptioin', 'Descriptioin', 'LONGVARCHAR', false, null, null);
        $this->addForeignKey('outlet_type_id', 'OutletTypeId', 'INTEGER', 'outlet_type', 'outlettype_id', false, null, null);
        $this->addColumn('outlet_name', 'OutletName', 'VARCHAR', false, null, null);
        $this->addColumn('outlet_code', 'OutletCode', 'VARCHAR', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('EmployeeRelatedByApprovedByEmployeeId', '\\entities\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':approved_by_employee_id',
    1 => ':employee_id',
  ),
), null, null, null, false);
        $this->addRelation('PositionsRelatedByApprovedByPositionId', '\\entities\\Positions', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':approved_by_position_id',
    1 => ':position_id',
  ),
), null, null, null, false);
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, null, false);
        $this->addRelation('EmployeeRelatedByCreatedByEmployeeId', '\\entities\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':created_by_employee_id',
    1 => ':employee_id',
  ),
), null, null, null, false);
        $this->addRelation('PositionsRelatedByCreatedByPositionId', '\\entities\\Positions', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':created_by_position_id',
    1 => ':position_id',
  ),
), null, null, null, false);
        $this->addRelation('EmployeeRelatedByFinalApprovedByEmployeeId', '\\entities\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':final_approved_by_employee_id',
    1 => ':employee_id',
  ),
), null, null, null, false);
        $this->addRelation('PositionsRelatedByFinalApprovedByPositionId', '\\entities\\Positions', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':final_approved_by_position_id',
    1 => ':position_id',
  ),
), null, null, null, false);
        $this->addRelation('Outlets', '\\entities\\Outlets', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('OutletType', '\\entities\\OutletType', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':outlet_type_id',
    1 => ':outlettype_id',
  ),
), null, null, null, false);
        $this->addRelation('PositionsRelatedByPosition', '\\entities\\Positions', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':position',
    1 => ':position_id',
  ),
), null, null, null, false);
        $this->addRelation('Territories', '\\entities\\Territories', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':territory',
    1 => ':territory_id',
  ),
), null, null, null, false);
        $this->addRelation('EmployeeRelatedByUpdatedByEmployeeId', '\\entities\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':updated_by_employee_id',
    1 => ':employee_id',
  ),
), null, null, null, false);
        $this->addRelation('PositionsRelatedByUpdatedByPositionId', '\\entities\\Positions', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':updated_by_position_id',
    1 => ':position_id',
  ),
), null, null, null, false);
        $this->addRelation('OnBoardRequestAddress', '\\entities\\OnBoardRequestAddress', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':on_board_request_id',
    1 => ':on_board_request_id',
  ),
), null, null, 'OnBoardRequestAddresses', false);
        $this->addRelation('OnBoardRequestLog', '\\entities\\OnBoardRequestLog', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':on_board_request_id',
    1 => ':on_board_request_id',
  ),
), null, null, 'OnBoardRequestLogs', false);
        $this->addRelation('OnBoardRequestOutletMapping', '\\entities\\OnBoardRequestOutletMapping', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':on_board_request_id',
    1 => ':on_board_request_id',
  ),
), null, null, 'OnBoardRequestOutletMappings', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('OnBoardRequestId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('OnBoardRequestId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? OnBoardRequestTableMap::CLASS_DEFAULT : OnBoardRequestTableMap::OM_CLASS;
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
     * @return array (OnBoardRequest object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = OnBoardRequestTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OnBoardRequestTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OnBoardRequestTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OnBoardRequestTableMap::OM_CLASS;
            /** @var OnBoardRequest $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OnBoardRequestTableMap::addInstanceToPool($obj, $key);
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
            $key = OnBoardRequestTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OnBoardRequestTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OnBoardRequest $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OnBoardRequestTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_ON_BOARD_REQUEST_ID);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_OUTLET_ID);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_SALUTATION);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_FIRST_NAME);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_LAST_NAME);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_EMAIL);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_MOBILE);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_GENDER);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_DATE_OF_BIRTH);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_MARITAL_STATUS);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_DATE_OF_ANNIVERSARY);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_QUALIFICATION);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_REGISTRATION_NO);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_PROFILE_PIC);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_STATUS);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_TERRITORY);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_POSITION);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_CREATED_BY_EMPLOYEE_ID);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_CREATED_BY_POSITION_ID);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_UPDATED_BY_EMPLOYEE_ID);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_UPDATED_BY_POSITION_ID);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_APPROVED_AT);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_APPROVED_BY_EMPLOYEE_ID);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_APPROVED_BY_POSITION_ID);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_FINAL_APPROVED_AT);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_EMPLOYEE_ID);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_POSITION_ID);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_DESCRIPTIOIN);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_OUTLET_TYPE_ID);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_OUTLET_NAME);
            $criteria->addSelectColumn(OnBoardRequestTableMap::COL_OUTLET_CODE);
        } else {
            $criteria->addSelectColumn($alias . '.on_board_request_id');
            $criteria->addSelectColumn($alias . '.outlet_id');
            $criteria->addSelectColumn($alias . '.salutation');
            $criteria->addSelectColumn($alias . '.first_name');
            $criteria->addSelectColumn($alias . '.last_name');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.mobile');
            $criteria->addSelectColumn($alias . '.gender');
            $criteria->addSelectColumn($alias . '.date_of_birth');
            $criteria->addSelectColumn($alias . '.marital_status');
            $criteria->addSelectColumn($alias . '.date_of_anniversary');
            $criteria->addSelectColumn($alias . '.qualification');
            $criteria->addSelectColumn($alias . '.registration_no');
            $criteria->addSelectColumn($alias . '.profile_pic');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.territory');
            $criteria->addSelectColumn($alias . '.position');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.created_by_employee_id');
            $criteria->addSelectColumn($alias . '.created_by_position_id');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.updated_by_employee_id');
            $criteria->addSelectColumn($alias . '.updated_by_position_id');
            $criteria->addSelectColumn($alias . '.approved_at');
            $criteria->addSelectColumn($alias . '.approved_by_employee_id');
            $criteria->addSelectColumn($alias . '.approved_by_position_id');
            $criteria->addSelectColumn($alias . '.final_approved_at');
            $criteria->addSelectColumn($alias . '.final_approved_by_employee_id');
            $criteria->addSelectColumn($alias . '.final_approved_by_position_id');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.descriptioin');
            $criteria->addSelectColumn($alias . '.outlet_type_id');
            $criteria->addSelectColumn($alias . '.outlet_name');
            $criteria->addSelectColumn($alias . '.outlet_code');
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
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_ON_BOARD_REQUEST_ID);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_OUTLET_ID);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_SALUTATION);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_FIRST_NAME);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_LAST_NAME);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_EMAIL);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_MOBILE);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_GENDER);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_DATE_OF_BIRTH);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_MARITAL_STATUS);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_DATE_OF_ANNIVERSARY);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_QUALIFICATION);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_REGISTRATION_NO);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_PROFILE_PIC);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_STATUS);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_TERRITORY);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_POSITION);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_CREATED_BY_EMPLOYEE_ID);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_CREATED_BY_POSITION_ID);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_UPDATED_BY_EMPLOYEE_ID);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_UPDATED_BY_POSITION_ID);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_APPROVED_AT);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_APPROVED_BY_EMPLOYEE_ID);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_APPROVED_BY_POSITION_ID);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_FINAL_APPROVED_AT);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_EMPLOYEE_ID);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_FINAL_APPROVED_BY_POSITION_ID);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_DESCRIPTIOIN);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_OUTLET_TYPE_ID);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_OUTLET_NAME);
            $criteria->removeSelectColumn(OnBoardRequestTableMap::COL_OUTLET_CODE);
        } else {
            $criteria->removeSelectColumn($alias . '.on_board_request_id');
            $criteria->removeSelectColumn($alias . '.outlet_id');
            $criteria->removeSelectColumn($alias . '.salutation');
            $criteria->removeSelectColumn($alias . '.first_name');
            $criteria->removeSelectColumn($alias . '.last_name');
            $criteria->removeSelectColumn($alias . '.email');
            $criteria->removeSelectColumn($alias . '.mobile');
            $criteria->removeSelectColumn($alias . '.gender');
            $criteria->removeSelectColumn($alias . '.date_of_birth');
            $criteria->removeSelectColumn($alias . '.marital_status');
            $criteria->removeSelectColumn($alias . '.date_of_anniversary');
            $criteria->removeSelectColumn($alias . '.qualification');
            $criteria->removeSelectColumn($alias . '.registration_no');
            $criteria->removeSelectColumn($alias . '.profile_pic');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.territory');
            $criteria->removeSelectColumn($alias . '.position');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.created_by_employee_id');
            $criteria->removeSelectColumn($alias . '.created_by_position_id');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.updated_by_employee_id');
            $criteria->removeSelectColumn($alias . '.updated_by_position_id');
            $criteria->removeSelectColumn($alias . '.approved_at');
            $criteria->removeSelectColumn($alias . '.approved_by_employee_id');
            $criteria->removeSelectColumn($alias . '.approved_by_position_id');
            $criteria->removeSelectColumn($alias . '.final_approved_at');
            $criteria->removeSelectColumn($alias . '.final_approved_by_employee_id');
            $criteria->removeSelectColumn($alias . '.final_approved_by_position_id');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.descriptioin');
            $criteria->removeSelectColumn($alias . '.outlet_type_id');
            $criteria->removeSelectColumn($alias . '.outlet_name');
            $criteria->removeSelectColumn($alias . '.outlet_code');
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
        return Propel::getServiceContainer()->getDatabaseMap(OnBoardRequestTableMap::DATABASE_NAME)->getTable(OnBoardRequestTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OnBoardRequest or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or OnBoardRequest object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OnBoardRequestTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\OnBoardRequest) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OnBoardRequestTableMap::DATABASE_NAME);
            $criteria->add(OnBoardRequestTableMap::COL_ON_BOARD_REQUEST_ID, (array) $values, Criteria::IN);
        }

        $query = OnBoardRequestQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OnBoardRequestTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OnBoardRequestTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the on_board_request table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return OnBoardRequestQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OnBoardRequest or Criteria object.
     *
     * @param mixed $criteria Criteria or OnBoardRequest object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OnBoardRequestTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OnBoardRequest object
        }

        if ($criteria->containsKey(OnBoardRequestTableMap::COL_ON_BOARD_REQUEST_ID) && $criteria->keyContainsValue(OnBoardRequestTableMap::COL_ON_BOARD_REQUEST_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OnBoardRequestTableMap::COL_ON_BOARD_REQUEST_ID.')');
        }


        // Set the correct dbName
        $query = OnBoardRequestQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
