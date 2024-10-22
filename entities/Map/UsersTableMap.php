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
use entities\Users;
use entities\UsersQuery;


/**
 * This class defines the structure of the 'users' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class UsersTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'entities.Map.UsersTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'users';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Users';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\entities\\Users';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'entities.Users';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 20;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 20;

    /**
     * the column name for the user_id field
     */
    public const COL_USER_ID = 'users.user_id';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'users.name';

    /**
     * the column name for the username field
     */
    public const COL_USERNAME = 'users.username';

    /**
     * the column name for the email field
     */
    public const COL_EMAIL = 'users.email';

    /**
     * the column name for the isd_code field
     */
    public const COL_ISD_CODE = 'users.isd_code';

    /**
     * the column name for the phone field
     */
    public const COL_PHONE = 'users.phone';

    /**
     * the column name for the otp field
     */
    public const COL_OTP = 'users.otp';

    /**
     * the column name for the company_id field
     */
    public const COL_COMPANY_ID = 'users.company_id';

    /**
     * the column name for the password field
     */
    public const COL_PASSWORD = 'users.password';

    /**
     * the column name for the role_id field
     */
    public const COL_ROLE_ID = 'users.role_id';

    /**
     * the column name for the employee_id field
     */
    public const COL_EMPLOYEE_ID = 'users.employee_id';

    /**
     * the column name for the last_login field
     */
    public const COL_LAST_LOGIN = 'users.last_login';

    /**
     * the column name for the ip_address field
     */
    public const COL_IP_ADDRESS = 'users.ip_address';

    /**
     * the column name for the ip_location field
     */
    public const COL_IP_LOCATION = 'users.ip_location';

    /**
     * the column name for the session_token field
     */
    public const COL_SESSION_TOKEN = 'users.session_token';

    /**
     * the column name for the app_token field
     */
    public const COL_APP_TOKEN = 'users.app_token';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'users.status';

    /**
     * the column name for the default_user field
     */
    public const COL_DEFAULT_USER = 'users.default_user';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'users.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'users.updated_at';

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
        self::TYPE_PHPNAME       => ['UserId', 'Name', 'Username', 'Email', 'IsdCode', 'Phone', 'Otp', 'CompanyId', 'Password', 'RoleId', 'EmployeeId', 'LastLogin', 'IpAddress', 'IpLocation', 'SessionToken', 'AppToken', 'Status', 'DefaultUser', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['userId', 'name', 'username', 'email', 'isdCode', 'phone', 'otp', 'companyId', 'password', 'roleId', 'employeeId', 'lastLogin', 'ipAddress', 'ipLocation', 'sessionToken', 'appToken', 'status', 'defaultUser', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [UsersTableMap::COL_USER_ID, UsersTableMap::COL_NAME, UsersTableMap::COL_USERNAME, UsersTableMap::COL_EMAIL, UsersTableMap::COL_ISD_CODE, UsersTableMap::COL_PHONE, UsersTableMap::COL_OTP, UsersTableMap::COL_COMPANY_ID, UsersTableMap::COL_PASSWORD, UsersTableMap::COL_ROLE_ID, UsersTableMap::COL_EMPLOYEE_ID, UsersTableMap::COL_LAST_LOGIN, UsersTableMap::COL_IP_ADDRESS, UsersTableMap::COL_IP_LOCATION, UsersTableMap::COL_SESSION_TOKEN, UsersTableMap::COL_APP_TOKEN, UsersTableMap::COL_STATUS, UsersTableMap::COL_DEFAULT_USER, UsersTableMap::COL_CREATED_AT, UsersTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['user_id', 'name', 'username', 'email', 'isd_code', 'phone', 'otp', 'company_id', 'password', 'role_id', 'employee_id', 'last_login', 'ip_address', 'ip_location', 'session_token', 'app_token', 'status', 'default_user', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, ]
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
        self::TYPE_PHPNAME       => ['UserId' => 0, 'Name' => 1, 'Username' => 2, 'Email' => 3, 'IsdCode' => 4, 'Phone' => 5, 'Otp' => 6, 'CompanyId' => 7, 'Password' => 8, 'RoleId' => 9, 'EmployeeId' => 10, 'LastLogin' => 11, 'IpAddress' => 12, 'IpLocation' => 13, 'SessionToken' => 14, 'AppToken' => 15, 'Status' => 16, 'DefaultUser' => 17, 'CreatedAt' => 18, 'UpdatedAt' => 19, ],
        self::TYPE_CAMELNAME     => ['userId' => 0, 'name' => 1, 'username' => 2, 'email' => 3, 'isdCode' => 4, 'phone' => 5, 'otp' => 6, 'companyId' => 7, 'password' => 8, 'roleId' => 9, 'employeeId' => 10, 'lastLogin' => 11, 'ipAddress' => 12, 'ipLocation' => 13, 'sessionToken' => 14, 'appToken' => 15, 'status' => 16, 'defaultUser' => 17, 'createdAt' => 18, 'updatedAt' => 19, ],
        self::TYPE_COLNAME       => [UsersTableMap::COL_USER_ID => 0, UsersTableMap::COL_NAME => 1, UsersTableMap::COL_USERNAME => 2, UsersTableMap::COL_EMAIL => 3, UsersTableMap::COL_ISD_CODE => 4, UsersTableMap::COL_PHONE => 5, UsersTableMap::COL_OTP => 6, UsersTableMap::COL_COMPANY_ID => 7, UsersTableMap::COL_PASSWORD => 8, UsersTableMap::COL_ROLE_ID => 9, UsersTableMap::COL_EMPLOYEE_ID => 10, UsersTableMap::COL_LAST_LOGIN => 11, UsersTableMap::COL_IP_ADDRESS => 12, UsersTableMap::COL_IP_LOCATION => 13, UsersTableMap::COL_SESSION_TOKEN => 14, UsersTableMap::COL_APP_TOKEN => 15, UsersTableMap::COL_STATUS => 16, UsersTableMap::COL_DEFAULT_USER => 17, UsersTableMap::COL_CREATED_AT => 18, UsersTableMap::COL_UPDATED_AT => 19, ],
        self::TYPE_FIELDNAME     => ['user_id' => 0, 'name' => 1, 'username' => 2, 'email' => 3, 'isd_code' => 4, 'phone' => 5, 'otp' => 6, 'company_id' => 7, 'password' => 8, 'role_id' => 9, 'employee_id' => 10, 'last_login' => 11, 'ip_address' => 12, 'ip_location' => 13, 'session_token' => 14, 'app_token' => 15, 'status' => 16, 'default_user' => 17, 'created_at' => 18, 'updated_at' => 19, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'UserId' => 'USER_ID',
        'Users.UserId' => 'USER_ID',
        'userId' => 'USER_ID',
        'users.userId' => 'USER_ID',
        'UsersTableMap::COL_USER_ID' => 'USER_ID',
        'COL_USER_ID' => 'USER_ID',
        'user_id' => 'USER_ID',
        'users.user_id' => 'USER_ID',
        'Name' => 'NAME',
        'Users.Name' => 'NAME',
        'name' => 'NAME',
        'users.name' => 'NAME',
        'UsersTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'Username' => 'USERNAME',
        'Users.Username' => 'USERNAME',
        'username' => 'USERNAME',
        'users.username' => 'USERNAME',
        'UsersTableMap::COL_USERNAME' => 'USERNAME',
        'COL_USERNAME' => 'USERNAME',
        'Email' => 'EMAIL',
        'Users.Email' => 'EMAIL',
        'email' => 'EMAIL',
        'users.email' => 'EMAIL',
        'UsersTableMap::COL_EMAIL' => 'EMAIL',
        'COL_EMAIL' => 'EMAIL',
        'IsdCode' => 'ISD_CODE',
        'Users.IsdCode' => 'ISD_CODE',
        'isdCode' => 'ISD_CODE',
        'users.isdCode' => 'ISD_CODE',
        'UsersTableMap::COL_ISD_CODE' => 'ISD_CODE',
        'COL_ISD_CODE' => 'ISD_CODE',
        'isd_code' => 'ISD_CODE',
        'users.isd_code' => 'ISD_CODE',
        'Phone' => 'PHONE',
        'Users.Phone' => 'PHONE',
        'phone' => 'PHONE',
        'users.phone' => 'PHONE',
        'UsersTableMap::COL_PHONE' => 'PHONE',
        'COL_PHONE' => 'PHONE',
        'Otp' => 'OTP',
        'Users.Otp' => 'OTP',
        'otp' => 'OTP',
        'users.otp' => 'OTP',
        'UsersTableMap::COL_OTP' => 'OTP',
        'COL_OTP' => 'OTP',
        'CompanyId' => 'COMPANY_ID',
        'Users.CompanyId' => 'COMPANY_ID',
        'companyId' => 'COMPANY_ID',
        'users.companyId' => 'COMPANY_ID',
        'UsersTableMap::COL_COMPANY_ID' => 'COMPANY_ID',
        'COL_COMPANY_ID' => 'COMPANY_ID',
        'company_id' => 'COMPANY_ID',
        'users.company_id' => 'COMPANY_ID',
        'Password' => 'PASSWORD',
        'Users.Password' => 'PASSWORD',
        'password' => 'PASSWORD',
        'users.password' => 'PASSWORD',
        'UsersTableMap::COL_PASSWORD' => 'PASSWORD',
        'COL_PASSWORD' => 'PASSWORD',
        'RoleId' => 'ROLE_ID',
        'Users.RoleId' => 'ROLE_ID',
        'roleId' => 'ROLE_ID',
        'users.roleId' => 'ROLE_ID',
        'UsersTableMap::COL_ROLE_ID' => 'ROLE_ID',
        'COL_ROLE_ID' => 'ROLE_ID',
        'role_id' => 'ROLE_ID',
        'users.role_id' => 'ROLE_ID',
        'EmployeeId' => 'EMPLOYEE_ID',
        'Users.EmployeeId' => 'EMPLOYEE_ID',
        'employeeId' => 'EMPLOYEE_ID',
        'users.employeeId' => 'EMPLOYEE_ID',
        'UsersTableMap::COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'COL_EMPLOYEE_ID' => 'EMPLOYEE_ID',
        'employee_id' => 'EMPLOYEE_ID',
        'users.employee_id' => 'EMPLOYEE_ID',
        'LastLogin' => 'LAST_LOGIN',
        'Users.LastLogin' => 'LAST_LOGIN',
        'lastLogin' => 'LAST_LOGIN',
        'users.lastLogin' => 'LAST_LOGIN',
        'UsersTableMap::COL_LAST_LOGIN' => 'LAST_LOGIN',
        'COL_LAST_LOGIN' => 'LAST_LOGIN',
        'last_login' => 'LAST_LOGIN',
        'users.last_login' => 'LAST_LOGIN',
        'IpAddress' => 'IP_ADDRESS',
        'Users.IpAddress' => 'IP_ADDRESS',
        'ipAddress' => 'IP_ADDRESS',
        'users.ipAddress' => 'IP_ADDRESS',
        'UsersTableMap::COL_IP_ADDRESS' => 'IP_ADDRESS',
        'COL_IP_ADDRESS' => 'IP_ADDRESS',
        'ip_address' => 'IP_ADDRESS',
        'users.ip_address' => 'IP_ADDRESS',
        'IpLocation' => 'IP_LOCATION',
        'Users.IpLocation' => 'IP_LOCATION',
        'ipLocation' => 'IP_LOCATION',
        'users.ipLocation' => 'IP_LOCATION',
        'UsersTableMap::COL_IP_LOCATION' => 'IP_LOCATION',
        'COL_IP_LOCATION' => 'IP_LOCATION',
        'ip_location' => 'IP_LOCATION',
        'users.ip_location' => 'IP_LOCATION',
        'SessionToken' => 'SESSION_TOKEN',
        'Users.SessionToken' => 'SESSION_TOKEN',
        'sessionToken' => 'SESSION_TOKEN',
        'users.sessionToken' => 'SESSION_TOKEN',
        'UsersTableMap::COL_SESSION_TOKEN' => 'SESSION_TOKEN',
        'COL_SESSION_TOKEN' => 'SESSION_TOKEN',
        'session_token' => 'SESSION_TOKEN',
        'users.session_token' => 'SESSION_TOKEN',
        'AppToken' => 'APP_TOKEN',
        'Users.AppToken' => 'APP_TOKEN',
        'appToken' => 'APP_TOKEN',
        'users.appToken' => 'APP_TOKEN',
        'UsersTableMap::COL_APP_TOKEN' => 'APP_TOKEN',
        'COL_APP_TOKEN' => 'APP_TOKEN',
        'app_token' => 'APP_TOKEN',
        'users.app_token' => 'APP_TOKEN',
        'Status' => 'STATUS',
        'Users.Status' => 'STATUS',
        'status' => 'STATUS',
        'users.status' => 'STATUS',
        'UsersTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'DefaultUser' => 'DEFAULT_USER',
        'Users.DefaultUser' => 'DEFAULT_USER',
        'defaultUser' => 'DEFAULT_USER',
        'users.defaultUser' => 'DEFAULT_USER',
        'UsersTableMap::COL_DEFAULT_USER' => 'DEFAULT_USER',
        'COL_DEFAULT_USER' => 'DEFAULT_USER',
        'default_user' => 'DEFAULT_USER',
        'users.default_user' => 'DEFAULT_USER',
        'CreatedAt' => 'CREATED_AT',
        'Users.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'users.createdAt' => 'CREATED_AT',
        'UsersTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'users.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Users.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'users.updatedAt' => 'UPDATED_AT',
        'UsersTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'users.updated_at' => 'UPDATED_AT',
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
        $this->setName('users');
        $this->setPhpName('Users');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\entities\\Users');
        $this->setPackage('entities');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('users_user_id_seq');
        // columns
        $this->addPrimaryKey('user_id', 'UserId', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, null, null);
        $this->addColumn('username', 'Username', 'VARCHAR', false, null, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, null, null);
        $this->addColumn('isd_code', 'IsdCode', 'VARCHAR', false, null, '+91');
        $this->addColumn('phone', 'Phone', 'VARCHAR', false, null, null);
        $this->addColumn('otp', 'Otp', 'INTEGER', false, null, null);
        $this->addForeignKey('company_id', 'CompanyId', 'INTEGER', 'company', 'company_id', false, null, null);
        $this->addColumn('password', 'Password', 'VARCHAR', true, null, null);
        $this->addForeignKey('role_id', 'RoleId', 'INTEGER', 'roles', 'role_id', false, null, null);
        $this->addForeignKey('employee_id', 'EmployeeId', 'INTEGER', 'employee', 'employee_id', false, null, null);
        $this->addColumn('last_login', 'LastLogin', 'INTEGER', false, null, null);
        $this->addColumn('ip_address', 'IpAddress', 'VARCHAR', false, null, null);
        $this->addColumn('ip_location', 'IpLocation', 'VARCHAR', false, null, null);
        $this->addColumn('session_token', 'SessionToken', 'VARCHAR', false, null, null);
        $this->addColumn('app_token', 'AppToken', 'VARCHAR', false, null, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, null, null);
        $this->addColumn('default_user', 'DefaultUser', 'INTEGER', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Company', '\\entities\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':company_id',
    1 => ':company_id',
  ),
), null, null, null, false);
        $this->addRelation('Employee', '\\entities\\Employee', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':employee_id',
    1 => ':employee_id',
  ),
), null, null, null, false);
        $this->addRelation('Roles', '\\entities\\Roles', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':role_id',
    1 => ':role_id',
  ),
), null, null, null, false);
        $this->addRelation('AuditTableData', '\\entities\\AuditTableData', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':user_id',
  ),
), null, null, 'AuditTableDatas', false);
        $this->addRelation('EmployeeLog', '\\entities\\EmployeeLog', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':user_id',
  ),
), 'CASCADE', null, 'EmployeeLogs', false);
        $this->addRelation('OrderLog', '\\entities\\OrderLog', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':user_id',
  ),
), null, null, 'OrderLogs', false);
        $this->addRelation('Shippingorder', '\\entities\\Shippingorder', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':user_id',
  ),
), null, null, 'Shippingorders', false);
        $this->addRelation('StockTransaction', '\\entities\\StockTransaction', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':created_user',
    1 => ':user_id',
  ),
), null, null, 'StockTransactions', false);
        $this->addRelation('StockVoucher', '\\entities\\StockVoucher', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':sv_user_id',
    1 => ':user_id',
  ),
), null, null, 'StockVouchers', false);
        $this->addRelation('UserSessions', '\\entities\\UserSessions', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':user_id',
  ),
), null, null, 'UserSessionss', false);
        $this->addRelation('UserTriggers', '\\entities\\UserTriggers', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':user_id',
  ),
), 'CASCADE', null, 'UserTriggerss', false);
        $this->addRelation('WdbSyncLog', '\\entities\\WdbSyncLog', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':user_id',
  ),
), null, null, 'WdbSyncLogs', false);
    }

    /**
     * Method to invalidate the instance pool of all tables related to users     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        EmployeeLogTableMap::clearInstancePool();
        UserTriggersTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? UsersTableMap::CLASS_DEFAULT : UsersTableMap::OM_CLASS;
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
     * @return array (Users object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = UsersTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UsersTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UsersTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UsersTableMap::OM_CLASS;
            /** @var Users $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UsersTableMap::addInstanceToPool($obj, $key);
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
            $key = UsersTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UsersTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Users $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UsersTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(UsersTableMap::COL_USER_ID);
            $criteria->addSelectColumn(UsersTableMap::COL_NAME);
            $criteria->addSelectColumn(UsersTableMap::COL_USERNAME);
            $criteria->addSelectColumn(UsersTableMap::COL_EMAIL);
            $criteria->addSelectColumn(UsersTableMap::COL_ISD_CODE);
            $criteria->addSelectColumn(UsersTableMap::COL_PHONE);
            $criteria->addSelectColumn(UsersTableMap::COL_OTP);
            $criteria->addSelectColumn(UsersTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(UsersTableMap::COL_PASSWORD);
            $criteria->addSelectColumn(UsersTableMap::COL_ROLE_ID);
            $criteria->addSelectColumn(UsersTableMap::COL_EMPLOYEE_ID);
            $criteria->addSelectColumn(UsersTableMap::COL_LAST_LOGIN);
            $criteria->addSelectColumn(UsersTableMap::COL_IP_ADDRESS);
            $criteria->addSelectColumn(UsersTableMap::COL_IP_LOCATION);
            $criteria->addSelectColumn(UsersTableMap::COL_SESSION_TOKEN);
            $criteria->addSelectColumn(UsersTableMap::COL_APP_TOKEN);
            $criteria->addSelectColumn(UsersTableMap::COL_STATUS);
            $criteria->addSelectColumn(UsersTableMap::COL_DEFAULT_USER);
            $criteria->addSelectColumn(UsersTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(UsersTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.user_id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.username');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.isd_code');
            $criteria->addSelectColumn($alias . '.phone');
            $criteria->addSelectColumn($alias . '.otp');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.password');
            $criteria->addSelectColumn($alias . '.role_id');
            $criteria->addSelectColumn($alias . '.employee_id');
            $criteria->addSelectColumn($alias . '.last_login');
            $criteria->addSelectColumn($alias . '.ip_address');
            $criteria->addSelectColumn($alias . '.ip_location');
            $criteria->addSelectColumn($alias . '.session_token');
            $criteria->addSelectColumn($alias . '.app_token');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.default_user');
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
            $criteria->removeSelectColumn(UsersTableMap::COL_USER_ID);
            $criteria->removeSelectColumn(UsersTableMap::COL_NAME);
            $criteria->removeSelectColumn(UsersTableMap::COL_USERNAME);
            $criteria->removeSelectColumn(UsersTableMap::COL_EMAIL);
            $criteria->removeSelectColumn(UsersTableMap::COL_ISD_CODE);
            $criteria->removeSelectColumn(UsersTableMap::COL_PHONE);
            $criteria->removeSelectColumn(UsersTableMap::COL_OTP);
            $criteria->removeSelectColumn(UsersTableMap::COL_COMPANY_ID);
            $criteria->removeSelectColumn(UsersTableMap::COL_PASSWORD);
            $criteria->removeSelectColumn(UsersTableMap::COL_ROLE_ID);
            $criteria->removeSelectColumn(UsersTableMap::COL_EMPLOYEE_ID);
            $criteria->removeSelectColumn(UsersTableMap::COL_LAST_LOGIN);
            $criteria->removeSelectColumn(UsersTableMap::COL_IP_ADDRESS);
            $criteria->removeSelectColumn(UsersTableMap::COL_IP_LOCATION);
            $criteria->removeSelectColumn(UsersTableMap::COL_SESSION_TOKEN);
            $criteria->removeSelectColumn(UsersTableMap::COL_APP_TOKEN);
            $criteria->removeSelectColumn(UsersTableMap::COL_STATUS);
            $criteria->removeSelectColumn(UsersTableMap::COL_DEFAULT_USER);
            $criteria->removeSelectColumn(UsersTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(UsersTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.user_id');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.username');
            $criteria->removeSelectColumn($alias . '.email');
            $criteria->removeSelectColumn($alias . '.isd_code');
            $criteria->removeSelectColumn($alias . '.phone');
            $criteria->removeSelectColumn($alias . '.otp');
            $criteria->removeSelectColumn($alias . '.company_id');
            $criteria->removeSelectColumn($alias . '.password');
            $criteria->removeSelectColumn($alias . '.role_id');
            $criteria->removeSelectColumn($alias . '.employee_id');
            $criteria->removeSelectColumn($alias . '.last_login');
            $criteria->removeSelectColumn($alias . '.ip_address');
            $criteria->removeSelectColumn($alias . '.ip_location');
            $criteria->removeSelectColumn($alias . '.session_token');
            $criteria->removeSelectColumn($alias . '.app_token');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.default_user');
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
        return Propel::getServiceContainer()->getDatabaseMap(UsersTableMap::DATABASE_NAME)->getTable(UsersTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Users or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Users object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \entities\Users) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UsersTableMap::DATABASE_NAME);
            $criteria->add(UsersTableMap::COL_USER_ID, (array) $values, Criteria::IN);
        }

        $query = UsersQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UsersTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UsersTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return UsersQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Users or Criteria object.
     *
     * @param mixed $criteria Criteria or Users object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Users object
        }

        if ($criteria->containsKey(UsersTableMap::COL_USER_ID) && $criteria->keyContainsValue(UsersTableMap::COL_USER_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UsersTableMap::COL_USER_ID.')');
        }


        // Set the correct dbName
        $query = UsersQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
