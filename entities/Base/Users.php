<?php

namespace entities\Base;

use \DateTime;
use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use entities\AuditTableData as ChildAuditTableData;
use entities\AuditTableDataQuery as ChildAuditTableDataQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\Employee as ChildEmployee;
use entities\EmployeeLog as ChildEmployeeLog;
use entities\EmployeeLogQuery as ChildEmployeeLogQuery;
use entities\EmployeeQuery as ChildEmployeeQuery;
use entities\OrderLog as ChildOrderLog;
use entities\OrderLogQuery as ChildOrderLogQuery;
use entities\Roles as ChildRoles;
use entities\RolesQuery as ChildRolesQuery;
use entities\Shippingorder as ChildShippingorder;
use entities\ShippingorderQuery as ChildShippingorderQuery;
use entities\StockTransaction as ChildStockTransaction;
use entities\StockTransactionQuery as ChildStockTransactionQuery;
use entities\StockVoucher as ChildStockVoucher;
use entities\StockVoucherQuery as ChildStockVoucherQuery;
use entities\UserSessions as ChildUserSessions;
use entities\UserSessionsQuery as ChildUserSessionsQuery;
use entities\UserTriggers as ChildUserTriggers;
use entities\UserTriggersQuery as ChildUserTriggersQuery;
use entities\Users as ChildUsers;
use entities\UsersQuery as ChildUsersQuery;
use entities\WdbSyncLog as ChildWdbSyncLog;
use entities\WdbSyncLogQuery as ChildWdbSyncLogQuery;
use entities\Map\AuditTableDataTableMap;
use entities\Map\EmployeeLogTableMap;
use entities\Map\OrderLogTableMap;
use entities\Map\ShippingorderTableMap;
use entities\Map\StockTransactionTableMap;
use entities\Map\StockVoucherTableMap;
use entities\Map\UserSessionsTableMap;
use entities\Map\UserTriggersTableMap;
use entities\Map\UsersTableMap;
use entities\Map\WdbSyncLogTableMap;

/**
 * Base class that represents a row from the 'users' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class Users implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\UsersTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var bool
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var bool
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = [];

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = [];

    /**
     * The value for the user_id field.
     *
     * @var        int
     */
    protected $user_id;

    /**
     * The value for the name field.
     *
     * @var        string|null
     */
    protected $name;

    /**
     * The value for the username field.
     *
     * @var        string|null
     */
    protected $username;

    /**
     * The value for the email field.
     *
     * @var        string|null
     */
    protected $email;

    /**
     * The value for the isd_code field.
     *
     * Note: this column has a database default value of: '+91'
     * @var        string|null
     */
    protected $isd_code;

    /**
     * The value for the phone field.
     *
     * @var        string|null
     */
    protected $phone;

    /**
     * The value for the otp field.
     *
     * @var        int|null
     */
    protected $otp;

    /**
     * The value for the company_id field.
     *
     * @var        int|null
     */
    protected $company_id;

    /**
     * The value for the password field.
     *
     * @var        string
     */
    protected $password;

    /**
     * The value for the role_id field.
     *
     * @var        int|null
     */
    protected $role_id;

    /**
     * The value for the employee_id field.
     *
     * @var        int|null
     */
    protected $employee_id;

    /**
     * The value for the last_login field.
     *
     * @var        int|null
     */
    protected $last_login;

    /**
     * The value for the ip_address field.
     *
     * @var        string|null
     */
    protected $ip_address;

    /**
     * The value for the ip_location field.
     *
     * @var        string|null
     */
    protected $ip_location;

    /**
     * The value for the session_token field.
     *
     * @var        string|null
     */
    protected $session_token;

    /**
     * The value for the app_token field.
     *
     * @var        string|null
     */
    protected $app_token;

    /**
     * The value for the status field.
     *
     * @var        int|null
     */
    protected $status;

    /**
     * The value for the default_user field.
     *
     * @var        int|null
     */
    protected $default_user;

    /**
     * The value for the created_at field.
     *
     * @var        DateTime|null
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     *
     * @var        DateTime|null
     */
    protected $updated_at;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildEmployee
     */
    protected $aEmployee;

    /**
     * @var        ChildRoles
     */
    protected $aRoles;

    /**
     * @var        ObjectCollection|ChildAuditTableData[] Collection to store aggregation of ChildAuditTableData objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildAuditTableData> Collection to store aggregation of ChildAuditTableData objects.
     */
    protected $collAuditTableDatas;
    protected $collAuditTableDatasPartial;

    /**
     * @var        ObjectCollection|ChildEmployeeLog[] Collection to store aggregation of ChildEmployeeLog objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildEmployeeLog> Collection to store aggregation of ChildEmployeeLog objects.
     */
    protected $collEmployeeLogs;
    protected $collEmployeeLogsPartial;

    /**
     * @var        ObjectCollection|ChildOrderLog[] Collection to store aggregation of ChildOrderLog objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOrderLog> Collection to store aggregation of ChildOrderLog objects.
     */
    protected $collOrderLogs;
    protected $collOrderLogsPartial;

    /**
     * @var        ObjectCollection|ChildShippingorder[] Collection to store aggregation of ChildShippingorder objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildShippingorder> Collection to store aggregation of ChildShippingorder objects.
     */
    protected $collShippingorders;
    protected $collShippingordersPartial;

    /**
     * @var        ObjectCollection|ChildStockTransaction[] Collection to store aggregation of ChildStockTransaction objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildStockTransaction> Collection to store aggregation of ChildStockTransaction objects.
     */
    protected $collStockTransactions;
    protected $collStockTransactionsPartial;

    /**
     * @var        ObjectCollection|ChildStockVoucher[] Collection to store aggregation of ChildStockVoucher objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildStockVoucher> Collection to store aggregation of ChildStockVoucher objects.
     */
    protected $collStockVouchers;
    protected $collStockVouchersPartial;

    /**
     * @var        ObjectCollection|ChildUserSessions[] Collection to store aggregation of ChildUserSessions objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildUserSessions> Collection to store aggregation of ChildUserSessions objects.
     */
    protected $collUserSessionss;
    protected $collUserSessionssPartial;

    /**
     * @var        ObjectCollection|ChildUserTriggers[] Collection to store aggregation of ChildUserTriggers objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildUserTriggers> Collection to store aggregation of ChildUserTriggers objects.
     */
    protected $collUserTriggerss;
    protected $collUserTriggerssPartial;

    /**
     * @var        ObjectCollection|ChildWdbSyncLog[] Collection to store aggregation of ChildWdbSyncLog objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildWdbSyncLog> Collection to store aggregation of ChildWdbSyncLog objects.
     */
    protected $collWdbSyncLogs;
    protected $collWdbSyncLogsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildAuditTableData[]
     * @phpstan-var ObjectCollection&\Traversable<ChildAuditTableData>
     */
    protected $auditTableDatasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEmployeeLog[]
     * @phpstan-var ObjectCollection&\Traversable<ChildEmployeeLog>
     */
    protected $employeeLogsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrderLog[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOrderLog>
     */
    protected $orderLogsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildShippingorder[]
     * @phpstan-var ObjectCollection&\Traversable<ChildShippingorder>
     */
    protected $shippingordersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildStockTransaction[]
     * @phpstan-var ObjectCollection&\Traversable<ChildStockTransaction>
     */
    protected $stockTransactionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildStockVoucher[]
     * @phpstan-var ObjectCollection&\Traversable<ChildStockVoucher>
     */
    protected $stockVouchersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUserSessions[]
     * @phpstan-var ObjectCollection&\Traversable<ChildUserSessions>
     */
    protected $userSessionssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUserTriggers[]
     * @phpstan-var ObjectCollection&\Traversable<ChildUserTriggers>
     */
    protected $userTriggerssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildWdbSyncLog[]
     * @phpstan-var ObjectCollection&\Traversable<ChildWdbSyncLog>
     */
    protected $wdbSyncLogsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->isd_code = '+91';
    }

    /**
     * Initializes internal state of entities\Base\Users object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return bool True if the object has been modified.
     */
    public function isModified(): bool
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param string $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return bool True if $col has been modified.
     */
    public function isColumnModified(string $col): bool
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns(): array
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return bool True, if the object has never been persisted.
     */
    public function isNew(): bool
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param bool $b the state of the object.
     */
    public function setNew(bool $b): void
    {
        $this->new = $b;
    }

    /**
     * Whether this object has been deleted.
     * @return bool The deleted state of this object.
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param bool $b The deleted state of this object.
     * @return void
     */
    public function setDeleted(bool $b): void
    {
        $this->deleted = $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified(?string $col = null): void
    {
        if (null !== $col) {
            unset($this->modifiedColumns[$col]);
        } else {
            $this->modifiedColumns = [];
        }
    }

    /**
     * Compares this with another <code>Users</code> instance.  If
     * <code>obj</code> is an instance of <code>Users</code>, delegates to
     * <code>equals(Users)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param mixed $obj The object to compare to.
     * @return bool Whether equal to the object specified.
     */
    public function equals($obj): bool
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns(): array
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return bool
     */
    public function hasVirtualColumn(string $name): bool
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return mixed
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getVirtualColumn(string $name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of nonexistent virtual column `%s`.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @param mixed $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn(string $name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param string $msg
     * @param int $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log(string $msg, int $priority = Propel::LOG_INFO): void
    {
        Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param \Propel\Runtime\Parser\AbstractParser|string $parser An AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME, TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM. Defaults to TableMap::TYPE_PHPNAME.
     * @return string The exported data
     */
    public function exportTo($parser, bool $includeLazyLoadColumns = true, string $keyType = TableMap::TYPE_PHPNAME): string
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray($keyType, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     *
     * @return array<string>
     */
    public function __sleep(): array
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [user_id] column value.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Get the [name] column value.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [username] column value.
     *
     * @return string|null
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the [email] column value.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [isd_code] column value.
     *
     * @return string|null
     */
    public function getIsdCode()
    {
        return $this->isd_code;
    }

    /**
     * Get the [phone] column value.
     *
     * @return string|null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Get the [otp] column value.
     *
     * @return int|null
     */
    public function getOtp()
    {
        return $this->otp;
    }

    /**
     * Get the [company_id] column value.
     *
     * @return int|null
     */
    public function getCompanyId()
    {
        return $this->company_id;
    }

    /**
     * Get the [password] column value.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the [role_id] column value.
     *
     * @return int|null
     */
    public function getRoleId()
    {
        return $this->role_id;
    }

    /**
     * Get the [employee_id] column value.
     *
     * @return int|null
     */
    public function getEmployeeId()
    {
        return $this->employee_id;
    }

    /**
     * Get the [last_login] column value.
     *
     * @return int|null
     */
    public function getLastLogin()
    {
        return $this->last_login;
    }

    /**
     * Get the [ip_address] column value.
     *
     * @return string|null
     */
    public function getIpAddress()
    {
        return $this->ip_address;
    }

    /**
     * Get the [ip_location] column value.
     *
     * @return string|null
     */
    public function getIpLocation()
    {
        return $this->ip_location;
    }

    /**
     * Get the [session_token] column value.
     *
     * @return string|null
     */
    public function getSessionToken()
    {
        return $this->session_token;
    }

    /**
     * Get the [app_token] column value.
     *
     * @return string|null
     */
    public function getAppToken()
    {
        return $this->app_token;
    }

    /**
     * Get the [status] column value.
     *
     * @return int|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [default_user] column value.
     *
     * @return int|null
     */
    public function getDefaultUser()
    {
        return $this->default_user;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getCreatedAt($format = null)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTimeInterface ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getUpdatedAt($format = null)
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTimeInterface ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Set the value of [user_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->user_id !== $v) {
            $this->user_id = $v;
            $this->modifiedColumns[UsersTableMap::COL_USER_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[UsersTableMap::COL_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [username] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setUsername($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->username !== $v) {
            $this->username = $v;
            $this->modifiedColumns[UsersTableMap::COL_USERNAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [email] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[UsersTableMap::COL_EMAIL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [isd_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIsdCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->isd_code !== $v) {
            $this->isd_code = $v;
            $this->modifiedColumns[UsersTableMap::COL_ISD_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [phone] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone !== $v) {
            $this->phone = $v;
            $this->modifiedColumns[UsersTableMap::COL_PHONE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [otp] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOtp($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->otp !== $v) {
            $this->otp = $v;
            $this->modifiedColumns[UsersTableMap::COL_OTP] = true;
        }

        return $this;
    }

    /**
     * Set the value of [company_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCompanyId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->company_id !== $v) {
            $this->company_id = $v;
            $this->modifiedColumns[UsersTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [password] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPassword($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->password !== $v) {
            $this->password = $v;
            $this->modifiedColumns[UsersTableMap::COL_PASSWORD] = true;
        }

        return $this;
    }

    /**
     * Set the value of [role_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRoleId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->role_id !== $v) {
            $this->role_id = $v;
            $this->modifiedColumns[UsersTableMap::COL_ROLE_ID] = true;
        }

        if ($this->aRoles !== null && $this->aRoles->getRoleId() !== $v) {
            $this->aRoles = null;
        }

        return $this;
    }

    /**
     * Set the value of [employee_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->employee_id !== $v) {
            $this->employee_id = $v;
            $this->modifiedColumns[UsersTableMap::COL_EMPLOYEE_ID] = true;
        }

        if ($this->aEmployee !== null && $this->aEmployee->getEmployeeId() !== $v) {
            $this->aEmployee = null;
        }

        return $this;
    }

    /**
     * Set the value of [last_login] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLastLogin($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->last_login !== $v) {
            $this->last_login = $v;
            $this->modifiedColumns[UsersTableMap::COL_LAST_LOGIN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [ip_address] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIpAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ip_address !== $v) {
            $this->ip_address = $v;
            $this->modifiedColumns[UsersTableMap::COL_IP_ADDRESS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [ip_location] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIpLocation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ip_location !== $v) {
            $this->ip_location = $v;
            $this->modifiedColumns[UsersTableMap::COL_IP_LOCATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [session_token] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSessionToken($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->session_token !== $v) {
            $this->session_token = $v;
            $this->modifiedColumns[UsersTableMap::COL_SESSION_TOKEN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [app_token] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAppToken($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->app_token !== $v) {
            $this->app_token = $v;
            $this->modifiedColumns[UsersTableMap::COL_APP_TOKEN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [status] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[UsersTableMap::COL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [default_user] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDefaultUser($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->default_user !== $v) {
            $this->default_user = $v;
            $this->modifiedColumns[UsersTableMap::COL_DEFAULT_USER] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UsersTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UsersTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return bool Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues(): bool
    {
            if ($this->isd_code !== '+91') {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    }

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by DataFetcher->fetch().
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param bool $rehydrate Whether this object is being re-hydrated from the database.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int next starting column
     * @throws \Propel\Runtime\Exception\PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate(array $row, int $startcol = 0, bool $rehydrate = false, string $indexType = TableMap::TYPE_NUM): int
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UsersTableMap::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UsersTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UsersTableMap::translateFieldName('Username', TableMap::TYPE_PHPNAME, $indexType)];
            $this->username = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UsersTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UsersTableMap::translateFieldName('IsdCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->isd_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UsersTableMap::translateFieldName('Phone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UsersTableMap::translateFieldName('Otp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->otp = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : UsersTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : UsersTableMap::translateFieldName('Password', TableMap::TYPE_PHPNAME, $indexType)];
            $this->password = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : UsersTableMap::translateFieldName('RoleId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->role_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : UsersTableMap::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : UsersTableMap::translateFieldName('LastLogin', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_login = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : UsersTableMap::translateFieldName('IpAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ip_address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : UsersTableMap::translateFieldName('IpLocation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ip_location = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : UsersTableMap::translateFieldName('SessionToken', TableMap::TYPE_PHPNAME, $indexType)];
            $this->session_token = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : UsersTableMap::translateFieldName('AppToken', TableMap::TYPE_PHPNAME, $indexType)];
            $this->app_token = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : UsersTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : UsersTableMap::translateFieldName('DefaultUser', TableMap::TYPE_PHPNAME, $indexType)];
            $this->default_user = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : UsersTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : UsersTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 20; // 20 = UsersTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\Users'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function ensureConsistency(): void
    {
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
        }
        if ($this->aRoles !== null && $this->role_id !== $this->aRoles->getRoleId()) {
            $this->aRoles = null;
        }
        if ($this->aEmployee !== null && $this->employee_id !== $this->aEmployee->getEmployeeId()) {
            $this->aEmployee = null;
        }
    }

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param bool $deep (optional) Whether to also de-associated any related objects.
     * @param ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload(bool $deep = false, ?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUsersQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->aEmployee = null;
            $this->aRoles = null;
            $this->collAuditTableDatas = null;

            $this->collEmployeeLogs = null;

            $this->collOrderLogs = null;

            $this->collShippingorders = null;

            $this->collStockTransactions = null;

            $this->collStockVouchers = null;

            $this->collUserSessionss = null;

            $this->collUserTriggerss = null;

            $this->collWdbSyncLogs = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Users::setDeleted()
     * @see Users::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUsersQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    public function save(?ConnectionInterface $con = null): int
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                UsersTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con): int
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aCompany !== null) {
                if ($this->aCompany->isModified() || $this->aCompany->isNew()) {
                    $affectedRows += $this->aCompany->save($con);
                }
                $this->setCompany($this->aCompany);
            }

            if ($this->aEmployee !== null) {
                if ($this->aEmployee->isModified() || $this->aEmployee->isNew()) {
                    $affectedRows += $this->aEmployee->save($con);
                }
                $this->setEmployee($this->aEmployee);
            }

            if ($this->aRoles !== null) {
                if ($this->aRoles->isModified() || $this->aRoles->isNew()) {
                    $affectedRows += $this->aRoles->save($con);
                }
                $this->setRoles($this->aRoles);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->auditTableDatasScheduledForDeletion !== null) {
                if (!$this->auditTableDatasScheduledForDeletion->isEmpty()) {
                    foreach ($this->auditTableDatasScheduledForDeletion as $auditTableData) {
                        // need to save related object because we set the relation to null
                        $auditTableData->save($con);
                    }
                    $this->auditTableDatasScheduledForDeletion = null;
                }
            }

            if ($this->collAuditTableDatas !== null) {
                foreach ($this->collAuditTableDatas as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->employeeLogsScheduledForDeletion !== null) {
                if (!$this->employeeLogsScheduledForDeletion->isEmpty()) {
                    \entities\EmployeeLogQuery::create()
                        ->filterByPrimaryKeys($this->employeeLogsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->employeeLogsScheduledForDeletion = null;
                }
            }

            if ($this->collEmployeeLogs !== null) {
                foreach ($this->collEmployeeLogs as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->orderLogsScheduledForDeletion !== null) {
                if (!$this->orderLogsScheduledForDeletion->isEmpty()) {
                    foreach ($this->orderLogsScheduledForDeletion as $orderLog) {
                        // need to save related object because we set the relation to null
                        $orderLog->save($con);
                    }
                    $this->orderLogsScheduledForDeletion = null;
                }
            }

            if ($this->collOrderLogs !== null) {
                foreach ($this->collOrderLogs as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->shippingordersScheduledForDeletion !== null) {
                if (!$this->shippingordersScheduledForDeletion->isEmpty()) {
                    \entities\ShippingorderQuery::create()
                        ->filterByPrimaryKeys($this->shippingordersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->shippingordersScheduledForDeletion = null;
                }
            }

            if ($this->collShippingorders !== null) {
                foreach ($this->collShippingorders as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->stockTransactionsScheduledForDeletion !== null) {
                if (!$this->stockTransactionsScheduledForDeletion->isEmpty()) {
                    \entities\StockTransactionQuery::create()
                        ->filterByPrimaryKeys($this->stockTransactionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->stockTransactionsScheduledForDeletion = null;
                }
            }

            if ($this->collStockTransactions !== null) {
                foreach ($this->collStockTransactions as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->stockVouchersScheduledForDeletion !== null) {
                if (!$this->stockVouchersScheduledForDeletion->isEmpty()) {
                    \entities\StockVoucherQuery::create()
                        ->filterByPrimaryKeys($this->stockVouchersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->stockVouchersScheduledForDeletion = null;
                }
            }

            if ($this->collStockVouchers !== null) {
                foreach ($this->collStockVouchers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->userSessionssScheduledForDeletion !== null) {
                if (!$this->userSessionssScheduledForDeletion->isEmpty()) {
                    foreach ($this->userSessionssScheduledForDeletion as $userSessions) {
                        // need to save related object because we set the relation to null
                        $userSessions->save($con);
                    }
                    $this->userSessionssScheduledForDeletion = null;
                }
            }

            if ($this->collUserSessionss !== null) {
                foreach ($this->collUserSessionss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->userTriggerssScheduledForDeletion !== null) {
                if (!$this->userTriggerssScheduledForDeletion->isEmpty()) {
                    \entities\UserTriggersQuery::create()
                        ->filterByPrimaryKeys($this->userTriggerssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->userTriggerssScheduledForDeletion = null;
                }
            }

            if ($this->collUserTriggerss !== null) {
                foreach ($this->collUserTriggerss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->wdbSyncLogsScheduledForDeletion !== null) {
                if (!$this->wdbSyncLogsScheduledForDeletion->isEmpty()) {
                    foreach ($this->wdbSyncLogsScheduledForDeletion as $wdbSyncLog) {
                        // need to save related object because we set the relation to null
                        $wdbSyncLog->save($con);
                    }
                    $this->wdbSyncLogsScheduledForDeletion = null;
                }
            }

            if ($this->collWdbSyncLogs !== null) {
                foreach ($this->collWdbSyncLogs as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    }

    /**
     * Insert the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con): void
    {
        $modifiedColumns = [];
        $index = 0;

        $this->modifiedColumns[UsersTableMap::COL_USER_ID] = true;
        if (null !== $this->user_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UsersTableMap::COL_USER_ID . ')');
        }
        if (null === $this->user_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('users_user_id_seq')");
                $this->user_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UsersTableMap::COL_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'user_id';
        }
        if ($this->isColumnModified(UsersTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(UsersTableMap::COL_USERNAME)) {
            $modifiedColumns[':p' . $index++]  = 'username';
        }
        if ($this->isColumnModified(UsersTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(UsersTableMap::COL_ISD_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'isd_code';
        }
        if ($this->isColumnModified(UsersTableMap::COL_PHONE)) {
            $modifiedColumns[':p' . $index++]  = 'phone';
        }
        if ($this->isColumnModified(UsersTableMap::COL_OTP)) {
            $modifiedColumns[':p' . $index++]  = 'otp';
        }
        if ($this->isColumnModified(UsersTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(UsersTableMap::COL_PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = 'password';
        }
        if ($this->isColumnModified(UsersTableMap::COL_ROLE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'role_id';
        }
        if ($this->isColumnModified(UsersTableMap::COL_EMPLOYEE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'employee_id';
        }
        if ($this->isColumnModified(UsersTableMap::COL_LAST_LOGIN)) {
            $modifiedColumns[':p' . $index++]  = 'last_login';
        }
        if ($this->isColumnModified(UsersTableMap::COL_IP_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'ip_address';
        }
        if ($this->isColumnModified(UsersTableMap::COL_IP_LOCATION)) {
            $modifiedColumns[':p' . $index++]  = 'ip_location';
        }
        if ($this->isColumnModified(UsersTableMap::COL_SESSION_TOKEN)) {
            $modifiedColumns[':p' . $index++]  = 'session_token';
        }
        if ($this->isColumnModified(UsersTableMap::COL_APP_TOKEN)) {
            $modifiedColumns[':p' . $index++]  = 'app_token';
        }
        if ($this->isColumnModified(UsersTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(UsersTableMap::COL_DEFAULT_USER)) {
            $modifiedColumns[':p' . $index++]  = 'default_user';
        }
        if ($this->isColumnModified(UsersTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(UsersTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO users (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'user_id':
                        $stmt->bindValue($identifier, $this->user_id, PDO::PARAM_INT);

                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);

                        break;
                    case 'username':
                        $stmt->bindValue($identifier, $this->username, PDO::PARAM_STR);

                        break;
                    case 'email':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);

                        break;
                    case 'isd_code':
                        $stmt->bindValue($identifier, $this->isd_code, PDO::PARAM_STR);

                        break;
                    case 'phone':
                        $stmt->bindValue($identifier, $this->phone, PDO::PARAM_STR);

                        break;
                    case 'otp':
                        $stmt->bindValue($identifier, $this->otp, PDO::PARAM_INT);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'password':
                        $stmt->bindValue($identifier, $this->password, PDO::PARAM_STR);

                        break;
                    case 'role_id':
                        $stmt->bindValue($identifier, $this->role_id, PDO::PARAM_INT);

                        break;
                    case 'employee_id':
                        $stmt->bindValue($identifier, $this->employee_id, PDO::PARAM_INT);

                        break;
                    case 'last_login':
                        $stmt->bindValue($identifier, $this->last_login, PDO::PARAM_INT);

                        break;
                    case 'ip_address':
                        $stmt->bindValue($identifier, $this->ip_address, PDO::PARAM_STR);

                        break;
                    case 'ip_location':
                        $stmt->bindValue($identifier, $this->ip_location, PDO::PARAM_STR);

                        break;
                    case 'session_token':
                        $stmt->bindValue($identifier, $this->session_token, PDO::PARAM_STR);

                        break;
                    case 'app_token':
                        $stmt->bindValue($identifier, $this->app_token, PDO::PARAM_STR);

                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);

                        break;
                    case 'default_user':
                        $stmt->bindValue($identifier, $this->default_user, PDO::PARAM_INT);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @return int Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con): int
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName(string $name, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UsersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos Position in XML schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition(int $pos)
    {
        switch ($pos) {
            case 0:
                return $this->getUserId();

            case 1:
                return $this->getName();

            case 2:
                return $this->getUsername();

            case 3:
                return $this->getEmail();

            case 4:
                return $this->getIsdCode();

            case 5:
                return $this->getPhone();

            case 6:
                return $this->getOtp();

            case 7:
                return $this->getCompanyId();

            case 8:
                return $this->getPassword();

            case 9:
                return $this->getRoleId();

            case 10:
                return $this->getEmployeeId();

            case 11:
                return $this->getLastLogin();

            case 12:
                return $this->getIpAddress();

            case 13:
                return $this->getIpLocation();

            case 14:
                return $this->getSessionToken();

            case 15:
                return $this->getAppToken();

            case 16:
                return $this->getStatus();

            case 17:
                return $this->getDefaultUser();

            case 18:
                return $this->getCreatedAt();

            case 19:
                return $this->getUpdatedAt();

            default:
                return null;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param bool $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array An associative array containing the field names (as keys) and field values
     */
    public function toArray(string $keyType = TableMap::TYPE_PHPNAME, bool $includeLazyLoadColumns = true, array $alreadyDumpedObjects = [], bool $includeForeignObjects = false): array
    {
        if (isset($alreadyDumpedObjects['Users'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Users'][$this->hashCode()] = true;
        $keys = UsersTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getUserId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getUsername(),
            $keys[3] => $this->getEmail(),
            $keys[4] => $this->getIsdCode(),
            $keys[5] => $this->getPhone(),
            $keys[6] => $this->getOtp(),
            $keys[7] => $this->getCompanyId(),
            $keys[8] => $this->getPassword(),
            $keys[9] => $this->getRoleId(),
            $keys[10] => $this->getEmployeeId(),
            $keys[11] => $this->getLastLogin(),
            $keys[12] => $this->getIpAddress(),
            $keys[13] => $this->getIpLocation(),
            $keys[14] => $this->getSessionToken(),
            $keys[15] => $this->getAppToken(),
            $keys[16] => $this->getStatus(),
            $keys[17] => $this->getDefaultUser(),
            $keys[18] => $this->getCreatedAt(),
            $keys[19] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[18]] instanceof \DateTimeInterface) {
            $result[$keys[18]] = $result[$keys[18]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[19]] instanceof \DateTimeInterface) {
            $result[$keys[19]] = $result[$keys[19]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCompany) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'company';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'company';
                        break;
                    default:
                        $key = 'Company';
                }

                $result[$key] = $this->aCompany->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aEmployee) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'employee';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'employee';
                        break;
                    default:
                        $key = 'Employee';
                }

                $result[$key] = $this->aEmployee->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aRoles) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'roles';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'roles';
                        break;
                    default:
                        $key = 'Roles';
                }

                $result[$key] = $this->aRoles->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collAuditTableDatas) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'auditTableDatas';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'audit_table_datas';
                        break;
                    default:
                        $key = 'AuditTableDatas';
                }

                $result[$key] = $this->collAuditTableDatas->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collEmployeeLogs) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'employeeLogs';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'employee_logs';
                        break;
                    default:
                        $key = 'EmployeeLogs';
                }

                $result[$key] = $this->collEmployeeLogs->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOrderLogs) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orderLogs';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'order_logs';
                        break;
                    default:
                        $key = 'OrderLogs';
                }

                $result[$key] = $this->collOrderLogs->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collShippingorders) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'shippingorders';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'shippingorders';
                        break;
                    default:
                        $key = 'Shippingorders';
                }

                $result[$key] = $this->collShippingorders->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collStockTransactions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'stockTransactions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'stock_transactions';
                        break;
                    default:
                        $key = 'StockTransactions';
                }

                $result[$key] = $this->collStockTransactions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collStockVouchers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'stockVouchers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'stock_vouchers';
                        break;
                    default:
                        $key = 'StockVouchers';
                }

                $result[$key] = $this->collStockVouchers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUserSessionss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'userSessionss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'user_sessionss';
                        break;
                    default:
                        $key = 'UserSessionss';
                }

                $result[$key] = $this->collUserSessionss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUserTriggerss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'userTriggerss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'user_triggerss';
                        break;
                    default:
                        $key = 'UserTriggerss';
                }

                $result[$key] = $this->collUserTriggerss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collWdbSyncLogs) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'wdbSyncLogs';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'wdb_sync_logs';
                        break;
                    default:
                        $key = 'WdbSyncLogs';
                }

                $result[$key] = $this->collWdbSyncLogs->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this
     */
    public function setByName(string $name, $value, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UsersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        $this->setByPosition($pos, $value);

        return $this;
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return $this
     */
    public function setByPosition(int $pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setUserId($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setUsername($value);
                break;
            case 3:
                $this->setEmail($value);
                break;
            case 4:
                $this->setIsdCode($value);
                break;
            case 5:
                $this->setPhone($value);
                break;
            case 6:
                $this->setOtp($value);
                break;
            case 7:
                $this->setCompanyId($value);
                break;
            case 8:
                $this->setPassword($value);
                break;
            case 9:
                $this->setRoleId($value);
                break;
            case 10:
                $this->setEmployeeId($value);
                break;
            case 11:
                $this->setLastLogin($value);
                break;
            case 12:
                $this->setIpAddress($value);
                break;
            case 13:
                $this->setIpLocation($value);
                break;
            case 14:
                $this->setSessionToken($value);
                break;
            case 15:
                $this->setAppToken($value);
                break;
            case 16:
                $this->setStatus($value);
                break;
            case 17:
                $this->setDefaultUser($value);
                break;
            case 18:
                $this->setCreatedAt($value);
                break;
            case 19:
                $this->setUpdatedAt($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param array $arr An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return $this
     */
    public function fromArray(array $arr, string $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = UsersTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setUserId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setUsername($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setEmail($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setIsdCode($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setPhone($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setOtp($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCompanyId($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setPassword($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setRoleId($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setEmployeeId($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setLastLogin($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setIpAddress($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setIpLocation($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setSessionToken($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setAppToken($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setStatus($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setDefaultUser($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setCreatedAt($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setUpdatedAt($arr[$keys[19]]);
        }

        return $this;
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this The current object, for fluid interface
     */
    public function importFrom($parser, string $data, string $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria(): Criteria
    {
        $criteria = new Criteria(UsersTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UsersTableMap::COL_USER_ID)) {
            $criteria->add(UsersTableMap::COL_USER_ID, $this->user_id);
        }
        if ($this->isColumnModified(UsersTableMap::COL_NAME)) {
            $criteria->add(UsersTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(UsersTableMap::COL_USERNAME)) {
            $criteria->add(UsersTableMap::COL_USERNAME, $this->username);
        }
        if ($this->isColumnModified(UsersTableMap::COL_EMAIL)) {
            $criteria->add(UsersTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(UsersTableMap::COL_ISD_CODE)) {
            $criteria->add(UsersTableMap::COL_ISD_CODE, $this->isd_code);
        }
        if ($this->isColumnModified(UsersTableMap::COL_PHONE)) {
            $criteria->add(UsersTableMap::COL_PHONE, $this->phone);
        }
        if ($this->isColumnModified(UsersTableMap::COL_OTP)) {
            $criteria->add(UsersTableMap::COL_OTP, $this->otp);
        }
        if ($this->isColumnModified(UsersTableMap::COL_COMPANY_ID)) {
            $criteria->add(UsersTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(UsersTableMap::COL_PASSWORD)) {
            $criteria->add(UsersTableMap::COL_PASSWORD, $this->password);
        }
        if ($this->isColumnModified(UsersTableMap::COL_ROLE_ID)) {
            $criteria->add(UsersTableMap::COL_ROLE_ID, $this->role_id);
        }
        if ($this->isColumnModified(UsersTableMap::COL_EMPLOYEE_ID)) {
            $criteria->add(UsersTableMap::COL_EMPLOYEE_ID, $this->employee_id);
        }
        if ($this->isColumnModified(UsersTableMap::COL_LAST_LOGIN)) {
            $criteria->add(UsersTableMap::COL_LAST_LOGIN, $this->last_login);
        }
        if ($this->isColumnModified(UsersTableMap::COL_IP_ADDRESS)) {
            $criteria->add(UsersTableMap::COL_IP_ADDRESS, $this->ip_address);
        }
        if ($this->isColumnModified(UsersTableMap::COL_IP_LOCATION)) {
            $criteria->add(UsersTableMap::COL_IP_LOCATION, $this->ip_location);
        }
        if ($this->isColumnModified(UsersTableMap::COL_SESSION_TOKEN)) {
            $criteria->add(UsersTableMap::COL_SESSION_TOKEN, $this->session_token);
        }
        if ($this->isColumnModified(UsersTableMap::COL_APP_TOKEN)) {
            $criteria->add(UsersTableMap::COL_APP_TOKEN, $this->app_token);
        }
        if ($this->isColumnModified(UsersTableMap::COL_STATUS)) {
            $criteria->add(UsersTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(UsersTableMap::COL_DEFAULT_USER)) {
            $criteria->add(UsersTableMap::COL_DEFAULT_USER, $this->default_user);
        }
        if ($this->isColumnModified(UsersTableMap::COL_CREATED_AT)) {
            $criteria->add(UsersTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(UsersTableMap::COL_UPDATED_AT)) {
            $criteria->add(UsersTableMap::COL_UPDATED_AT, $this->updated_at);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria(): Criteria
    {
        $criteria = ChildUsersQuery::create();
        $criteria->add(UsersTableMap::COL_USER_ID, $this->user_id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int|string Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getUserId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getUserId();
    }

    /**
     * Generic method to set the primary key (user_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setUserId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getUserId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\Users (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setName($this->getName());
        $copyObj->setUsername($this->getUsername());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setIsdCode($this->getIsdCode());
        $copyObj->setPhone($this->getPhone());
        $copyObj->setOtp($this->getOtp());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setPassword($this->getPassword());
        $copyObj->setRoleId($this->getRoleId());
        $copyObj->setEmployeeId($this->getEmployeeId());
        $copyObj->setLastLogin($this->getLastLogin());
        $copyObj->setIpAddress($this->getIpAddress());
        $copyObj->setIpLocation($this->getIpLocation());
        $copyObj->setSessionToken($this->getSessionToken());
        $copyObj->setAppToken($this->getAppToken());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setDefaultUser($this->getDefaultUser());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getAuditTableDatas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAuditTableData($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getEmployeeLogs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEmployeeLog($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrderLogs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrderLog($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getShippingorders() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addShippingorder($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getStockTransactions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStockTransaction($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getStockVouchers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStockVoucher($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUserSessionss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUserSessions($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUserTriggerss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUserTriggers($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getWdbSyncLogs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addWdbSyncLog($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setUserId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \entities\Users Clone of current object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function copy(bool $deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildCompany object.
     *
     * @param ChildCompany|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCompany(ChildCompany $v = null)
    {
        if ($v === null) {
            $this->setCompanyId(NULL);
        } else {
            $this->setCompanyId($v->getCompanyId());
        }

        $this->aCompany = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCompany object, it will not be re-added.
        if ($v !== null) {
            $v->addUsers($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCompany object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildCompany|null The associated ChildCompany object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCompany(?ConnectionInterface $con = null)
    {
        if ($this->aCompany === null && ($this->company_id != 0)) {
            $this->aCompany = ChildCompanyQuery::create()->findPk($this->company_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCompany->addUserss($this);
             */
        }

        return $this->aCompany;
    }

    /**
     * Declares an association between this object and a ChildEmployee object.
     *
     * @param ChildEmployee|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setEmployee(ChildEmployee $v = null)
    {
        if ($v === null) {
            $this->setEmployeeId(NULL);
        } else {
            $this->setEmployeeId($v->getEmployeeId());
        }

        $this->aEmployee = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildEmployee object, it will not be re-added.
        if ($v !== null) {
            $v->addUsers($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildEmployee object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildEmployee|null The associated ChildEmployee object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEmployee(?ConnectionInterface $con = null)
    {
        if ($this->aEmployee === null && ($this->employee_id != 0)) {
            $this->aEmployee = ChildEmployeeQuery::create()->findPk($this->employee_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEmployee->addUserss($this);
             */
        }

        return $this->aEmployee;
    }

    /**
     * Declares an association between this object and a ChildRoles object.
     *
     * @param ChildRoles|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setRoles(ChildRoles $v = null)
    {
        if ($v === null) {
            $this->setRoleId(NULL);
        } else {
            $this->setRoleId($v->getRoleId());
        }

        $this->aRoles = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildRoles object, it will not be re-added.
        if ($v !== null) {
            $v->addUsers($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildRoles object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildRoles|null The associated ChildRoles object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getRoles(?ConnectionInterface $con = null)
    {
        if ($this->aRoles === null && ($this->role_id != 0)) {
            $this->aRoles = ChildRolesQuery::create()->findPk($this->role_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aRoles->addUserss($this);
             */
        }

        return $this->aRoles;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName): void
    {
        if ('AuditTableData' === $relationName) {
            $this->initAuditTableDatas();
            return;
        }
        if ('EmployeeLog' === $relationName) {
            $this->initEmployeeLogs();
            return;
        }
        if ('OrderLog' === $relationName) {
            $this->initOrderLogs();
            return;
        }
        if ('Shippingorder' === $relationName) {
            $this->initShippingorders();
            return;
        }
        if ('StockTransaction' === $relationName) {
            $this->initStockTransactions();
            return;
        }
        if ('StockVoucher' === $relationName) {
            $this->initStockVouchers();
            return;
        }
        if ('UserSessions' === $relationName) {
            $this->initUserSessionss();
            return;
        }
        if ('UserTriggers' === $relationName) {
            $this->initUserTriggerss();
            return;
        }
        if ('WdbSyncLog' === $relationName) {
            $this->initWdbSyncLogs();
            return;
        }
    }

    /**
     * Clears out the collAuditTableDatas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addAuditTableDatas()
     */
    public function clearAuditTableDatas()
    {
        $this->collAuditTableDatas = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collAuditTableDatas collection loaded partially.
     *
     * @return void
     */
    public function resetPartialAuditTableDatas($v = true): void
    {
        $this->collAuditTableDatasPartial = $v;
    }

    /**
     * Initializes the collAuditTableDatas collection.
     *
     * By default this just sets the collAuditTableDatas collection to an empty array (like clearcollAuditTableDatas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAuditTableDatas(bool $overrideExisting = true): void
    {
        if (null !== $this->collAuditTableDatas && !$overrideExisting) {
            return;
        }

        $collectionClassName = AuditTableDataTableMap::getTableMap()->getCollectionClassName();

        $this->collAuditTableDatas = new $collectionClassName;
        $this->collAuditTableDatas->setModel('\entities\AuditTableData');
    }

    /**
     * Gets an array of ChildAuditTableData objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAuditTableData[] List of ChildAuditTableData objects
     * @phpstan-return ObjectCollection&\Traversable<ChildAuditTableData> List of ChildAuditTableData objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getAuditTableDatas(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collAuditTableDatasPartial && !$this->isNew();
        if (null === $this->collAuditTableDatas || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collAuditTableDatas) {
                    $this->initAuditTableDatas();
                } else {
                    $collectionClassName = AuditTableDataTableMap::getTableMap()->getCollectionClassName();

                    $collAuditTableDatas = new $collectionClassName;
                    $collAuditTableDatas->setModel('\entities\AuditTableData');

                    return $collAuditTableDatas;
                }
            } else {
                $collAuditTableDatas = ChildAuditTableDataQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAuditTableDatasPartial && count($collAuditTableDatas)) {
                        $this->initAuditTableDatas(false);

                        foreach ($collAuditTableDatas as $obj) {
                            if (false == $this->collAuditTableDatas->contains($obj)) {
                                $this->collAuditTableDatas->append($obj);
                            }
                        }

                        $this->collAuditTableDatasPartial = true;
                    }

                    return $collAuditTableDatas;
                }

                if ($partial && $this->collAuditTableDatas) {
                    foreach ($this->collAuditTableDatas as $obj) {
                        if ($obj->isNew()) {
                            $collAuditTableDatas[] = $obj;
                        }
                    }
                }

                $this->collAuditTableDatas = $collAuditTableDatas;
                $this->collAuditTableDatasPartial = false;
            }
        }

        return $this->collAuditTableDatas;
    }

    /**
     * Sets a collection of ChildAuditTableData objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $auditTableDatas A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setAuditTableDatas(Collection $auditTableDatas, ?ConnectionInterface $con = null)
    {
        /** @var ChildAuditTableData[] $auditTableDatasToDelete */
        $auditTableDatasToDelete = $this->getAuditTableDatas(new Criteria(), $con)->diff($auditTableDatas);


        $this->auditTableDatasScheduledForDeletion = $auditTableDatasToDelete;

        foreach ($auditTableDatasToDelete as $auditTableDataRemoved) {
            $auditTableDataRemoved->setUsers(null);
        }

        $this->collAuditTableDatas = null;
        foreach ($auditTableDatas as $auditTableData) {
            $this->addAuditTableData($auditTableData);
        }

        $this->collAuditTableDatas = $auditTableDatas;
        $this->collAuditTableDatasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related AuditTableData objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related AuditTableData objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countAuditTableDatas(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collAuditTableDatasPartial && !$this->isNew();
        if (null === $this->collAuditTableDatas || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAuditTableDatas) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAuditTableDatas());
            }

            $query = ChildAuditTableDataQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collAuditTableDatas);
    }

    /**
     * Method called to associate a ChildAuditTableData object to this object
     * through the ChildAuditTableData foreign key attribute.
     *
     * @param ChildAuditTableData $l ChildAuditTableData
     * @return $this The current object (for fluent API support)
     */
    public function addAuditTableData(ChildAuditTableData $l)
    {
        if ($this->collAuditTableDatas === null) {
            $this->initAuditTableDatas();
            $this->collAuditTableDatasPartial = true;
        }

        if (!$this->collAuditTableDatas->contains($l)) {
            $this->doAddAuditTableData($l);

            if ($this->auditTableDatasScheduledForDeletion and $this->auditTableDatasScheduledForDeletion->contains($l)) {
                $this->auditTableDatasScheduledForDeletion->remove($this->auditTableDatasScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildAuditTableData $auditTableData The ChildAuditTableData object to add.
     */
    protected function doAddAuditTableData(ChildAuditTableData $auditTableData): void
    {
        $this->collAuditTableDatas[]= $auditTableData;
        $auditTableData->setUsers($this);
    }

    /**
     * @param ChildAuditTableData $auditTableData The ChildAuditTableData object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeAuditTableData(ChildAuditTableData $auditTableData)
    {
        if ($this->getAuditTableDatas()->contains($auditTableData)) {
            $pos = $this->collAuditTableDatas->search($auditTableData);
            $this->collAuditTableDatas->remove($pos);
            if (null === $this->auditTableDatasScheduledForDeletion) {
                $this->auditTableDatasScheduledForDeletion = clone $this->collAuditTableDatas;
                $this->auditTableDatasScheduledForDeletion->clear();
            }
            $this->auditTableDatasScheduledForDeletion[]= $auditTableData;
            $auditTableData->setUsers(null);
        }

        return $this;
    }

    /**
     * Clears out the collEmployeeLogs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addEmployeeLogs()
     */
    public function clearEmployeeLogs()
    {
        $this->collEmployeeLogs = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collEmployeeLogs collection loaded partially.
     *
     * @return void
     */
    public function resetPartialEmployeeLogs($v = true): void
    {
        $this->collEmployeeLogsPartial = $v;
    }

    /**
     * Initializes the collEmployeeLogs collection.
     *
     * By default this just sets the collEmployeeLogs collection to an empty array (like clearcollEmployeeLogs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEmployeeLogs(bool $overrideExisting = true): void
    {
        if (null !== $this->collEmployeeLogs && !$overrideExisting) {
            return;
        }

        $collectionClassName = EmployeeLogTableMap::getTableMap()->getCollectionClassName();

        $this->collEmployeeLogs = new $collectionClassName;
        $this->collEmployeeLogs->setModel('\entities\EmployeeLog');
    }

    /**
     * Gets an array of ChildEmployeeLog objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEmployeeLog[] List of ChildEmployeeLog objects
     * @phpstan-return ObjectCollection&\Traversable<ChildEmployeeLog> List of ChildEmployeeLog objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getEmployeeLogs(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collEmployeeLogsPartial && !$this->isNew();
        if (null === $this->collEmployeeLogs || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collEmployeeLogs) {
                    $this->initEmployeeLogs();
                } else {
                    $collectionClassName = EmployeeLogTableMap::getTableMap()->getCollectionClassName();

                    $collEmployeeLogs = new $collectionClassName;
                    $collEmployeeLogs->setModel('\entities\EmployeeLog');

                    return $collEmployeeLogs;
                }
            } else {
                $collEmployeeLogs = ChildEmployeeLogQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEmployeeLogsPartial && count($collEmployeeLogs)) {
                        $this->initEmployeeLogs(false);

                        foreach ($collEmployeeLogs as $obj) {
                            if (false == $this->collEmployeeLogs->contains($obj)) {
                                $this->collEmployeeLogs->append($obj);
                            }
                        }

                        $this->collEmployeeLogsPartial = true;
                    }

                    return $collEmployeeLogs;
                }

                if ($partial && $this->collEmployeeLogs) {
                    foreach ($this->collEmployeeLogs as $obj) {
                        if ($obj->isNew()) {
                            $collEmployeeLogs[] = $obj;
                        }
                    }
                }

                $this->collEmployeeLogs = $collEmployeeLogs;
                $this->collEmployeeLogsPartial = false;
            }
        }

        return $this->collEmployeeLogs;
    }

    /**
     * Sets a collection of ChildEmployeeLog objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $employeeLogs A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeeLogs(Collection $employeeLogs, ?ConnectionInterface $con = null)
    {
        /** @var ChildEmployeeLog[] $employeeLogsToDelete */
        $employeeLogsToDelete = $this->getEmployeeLogs(new Criteria(), $con)->diff($employeeLogs);


        $this->employeeLogsScheduledForDeletion = $employeeLogsToDelete;

        foreach ($employeeLogsToDelete as $employeeLogRemoved) {
            $employeeLogRemoved->setUsers(null);
        }

        $this->collEmployeeLogs = null;
        foreach ($employeeLogs as $employeeLog) {
            $this->addEmployeeLog($employeeLog);
        }

        $this->collEmployeeLogs = $employeeLogs;
        $this->collEmployeeLogsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EmployeeLog objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related EmployeeLog objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countEmployeeLogs(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collEmployeeLogsPartial && !$this->isNew();
        if (null === $this->collEmployeeLogs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEmployeeLogs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEmployeeLogs());
            }

            $query = ChildEmployeeLogQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collEmployeeLogs);
    }

    /**
     * Method called to associate a ChildEmployeeLog object to this object
     * through the ChildEmployeeLog foreign key attribute.
     *
     * @param ChildEmployeeLog $l ChildEmployeeLog
     * @return $this The current object (for fluent API support)
     */
    public function addEmployeeLog(ChildEmployeeLog $l)
    {
        if ($this->collEmployeeLogs === null) {
            $this->initEmployeeLogs();
            $this->collEmployeeLogsPartial = true;
        }

        if (!$this->collEmployeeLogs->contains($l)) {
            $this->doAddEmployeeLog($l);

            if ($this->employeeLogsScheduledForDeletion and $this->employeeLogsScheduledForDeletion->contains($l)) {
                $this->employeeLogsScheduledForDeletion->remove($this->employeeLogsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildEmployeeLog $employeeLog The ChildEmployeeLog object to add.
     */
    protected function doAddEmployeeLog(ChildEmployeeLog $employeeLog): void
    {
        $this->collEmployeeLogs[]= $employeeLog;
        $employeeLog->setUsers($this);
    }

    /**
     * @param ChildEmployeeLog $employeeLog The ChildEmployeeLog object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeEmployeeLog(ChildEmployeeLog $employeeLog)
    {
        if ($this->getEmployeeLogs()->contains($employeeLog)) {
            $pos = $this->collEmployeeLogs->search($employeeLog);
            $this->collEmployeeLogs->remove($pos);
            if (null === $this->employeeLogsScheduledForDeletion) {
                $this->employeeLogsScheduledForDeletion = clone $this->collEmployeeLogs;
                $this->employeeLogsScheduledForDeletion->clear();
            }
            $this->employeeLogsScheduledForDeletion[]= clone $employeeLog;
            $employeeLog->setUsers(null);
        }

        return $this;
    }

    /**
     * Clears out the collOrderLogs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addOrderLogs()
     */
    public function clearOrderLogs()
    {
        $this->collOrderLogs = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collOrderLogs collection loaded partially.
     *
     * @return void
     */
    public function resetPartialOrderLogs($v = true): void
    {
        $this->collOrderLogsPartial = $v;
    }

    /**
     * Initializes the collOrderLogs collection.
     *
     * By default this just sets the collOrderLogs collection to an empty array (like clearcollOrderLogs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrderLogs(bool $overrideExisting = true): void
    {
        if (null !== $this->collOrderLogs && !$overrideExisting) {
            return;
        }

        $collectionClassName = OrderLogTableMap::getTableMap()->getCollectionClassName();

        $this->collOrderLogs = new $collectionClassName;
        $this->collOrderLogs->setModel('\entities\OrderLog');
    }

    /**
     * Gets an array of ChildOrderLog objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOrderLog[] List of ChildOrderLog objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderLog> List of ChildOrderLog objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOrderLogs(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collOrderLogsPartial && !$this->isNew();
        if (null === $this->collOrderLogs || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOrderLogs) {
                    $this->initOrderLogs();
                } else {
                    $collectionClassName = OrderLogTableMap::getTableMap()->getCollectionClassName();

                    $collOrderLogs = new $collectionClassName;
                    $collOrderLogs->setModel('\entities\OrderLog');

                    return $collOrderLogs;
                }
            } else {
                $collOrderLogs = ChildOrderLogQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrderLogsPartial && count($collOrderLogs)) {
                        $this->initOrderLogs(false);

                        foreach ($collOrderLogs as $obj) {
                            if (false == $this->collOrderLogs->contains($obj)) {
                                $this->collOrderLogs->append($obj);
                            }
                        }

                        $this->collOrderLogsPartial = true;
                    }

                    return $collOrderLogs;
                }

                if ($partial && $this->collOrderLogs) {
                    foreach ($this->collOrderLogs as $obj) {
                        if ($obj->isNew()) {
                            $collOrderLogs[] = $obj;
                        }
                    }
                }

                $this->collOrderLogs = $collOrderLogs;
                $this->collOrderLogsPartial = false;
            }
        }

        return $this->collOrderLogs;
    }

    /**
     * Sets a collection of ChildOrderLog objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $orderLogs A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setOrderLogs(Collection $orderLogs, ?ConnectionInterface $con = null)
    {
        /** @var ChildOrderLog[] $orderLogsToDelete */
        $orderLogsToDelete = $this->getOrderLogs(new Criteria(), $con)->diff($orderLogs);


        $this->orderLogsScheduledForDeletion = $orderLogsToDelete;

        foreach ($orderLogsToDelete as $orderLogRemoved) {
            $orderLogRemoved->setUsers(null);
        }

        $this->collOrderLogs = null;
        foreach ($orderLogs as $orderLog) {
            $this->addOrderLog($orderLog);
        }

        $this->collOrderLogs = $orderLogs;
        $this->collOrderLogsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OrderLog objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related OrderLog objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countOrderLogs(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collOrderLogsPartial && !$this->isNew();
        if (null === $this->collOrderLogs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrderLogs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrderLogs());
            }

            $query = ChildOrderLogQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collOrderLogs);
    }

    /**
     * Method called to associate a ChildOrderLog object to this object
     * through the ChildOrderLog foreign key attribute.
     *
     * @param ChildOrderLog $l ChildOrderLog
     * @return $this The current object (for fluent API support)
     */
    public function addOrderLog(ChildOrderLog $l)
    {
        if ($this->collOrderLogs === null) {
            $this->initOrderLogs();
            $this->collOrderLogsPartial = true;
        }

        if (!$this->collOrderLogs->contains($l)) {
            $this->doAddOrderLog($l);

            if ($this->orderLogsScheduledForDeletion and $this->orderLogsScheduledForDeletion->contains($l)) {
                $this->orderLogsScheduledForDeletion->remove($this->orderLogsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOrderLog $orderLog The ChildOrderLog object to add.
     */
    protected function doAddOrderLog(ChildOrderLog $orderLog): void
    {
        $this->collOrderLogs[]= $orderLog;
        $orderLog->setUsers($this);
    }

    /**
     * @param ChildOrderLog $orderLog The ChildOrderLog object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeOrderLog(ChildOrderLog $orderLog)
    {
        if ($this->getOrderLogs()->contains($orderLog)) {
            $pos = $this->collOrderLogs->search($orderLog);
            $this->collOrderLogs->remove($pos);
            if (null === $this->orderLogsScheduledForDeletion) {
                $this->orderLogsScheduledForDeletion = clone $this->collOrderLogs;
                $this->orderLogsScheduledForDeletion->clear();
            }
            $this->orderLogsScheduledForDeletion[]= $orderLog;
            $orderLog->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related OrderLogs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderLog[] List of ChildOrderLog objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderLog}> List of ChildOrderLog objects
     */
    public function getOrderLogsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderLogQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getOrderLogs($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related OrderLogs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderLog[] List of ChildOrderLog objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderLog}> List of ChildOrderLog objects
     */
    public function getOrderLogsJoinOrders(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderLogQuery::create(null, $criteria);
        $query->joinWith('Orders', $joinBehavior);

        return $this->getOrderLogs($query, $con);
    }

    /**
     * Clears out the collShippingorders collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addShippingorders()
     */
    public function clearShippingorders()
    {
        $this->collShippingorders = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collShippingorders collection loaded partially.
     *
     * @return void
     */
    public function resetPartialShippingorders($v = true): void
    {
        $this->collShippingordersPartial = $v;
    }

    /**
     * Initializes the collShippingorders collection.
     *
     * By default this just sets the collShippingorders collection to an empty array (like clearcollShippingorders());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initShippingorders(bool $overrideExisting = true): void
    {
        if (null !== $this->collShippingorders && !$overrideExisting) {
            return;
        }

        $collectionClassName = ShippingorderTableMap::getTableMap()->getCollectionClassName();

        $this->collShippingorders = new $collectionClassName;
        $this->collShippingorders->setModel('\entities\Shippingorder');
    }

    /**
     * Gets an array of ChildShippingorder objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildShippingorder[] List of ChildShippingorder objects
     * @phpstan-return ObjectCollection&\Traversable<ChildShippingorder> List of ChildShippingorder objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getShippingorders(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collShippingordersPartial && !$this->isNew();
        if (null === $this->collShippingorders || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collShippingorders) {
                    $this->initShippingorders();
                } else {
                    $collectionClassName = ShippingorderTableMap::getTableMap()->getCollectionClassName();

                    $collShippingorders = new $collectionClassName;
                    $collShippingorders->setModel('\entities\Shippingorder');

                    return $collShippingorders;
                }
            } else {
                $collShippingorders = ChildShippingorderQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collShippingordersPartial && count($collShippingorders)) {
                        $this->initShippingorders(false);

                        foreach ($collShippingorders as $obj) {
                            if (false == $this->collShippingorders->contains($obj)) {
                                $this->collShippingorders->append($obj);
                            }
                        }

                        $this->collShippingordersPartial = true;
                    }

                    return $collShippingorders;
                }

                if ($partial && $this->collShippingorders) {
                    foreach ($this->collShippingorders as $obj) {
                        if ($obj->isNew()) {
                            $collShippingorders[] = $obj;
                        }
                    }
                }

                $this->collShippingorders = $collShippingorders;
                $this->collShippingordersPartial = false;
            }
        }

        return $this->collShippingorders;
    }

    /**
     * Sets a collection of ChildShippingorder objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $shippingorders A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setShippingorders(Collection $shippingorders, ?ConnectionInterface $con = null)
    {
        /** @var ChildShippingorder[] $shippingordersToDelete */
        $shippingordersToDelete = $this->getShippingorders(new Criteria(), $con)->diff($shippingorders);


        $this->shippingordersScheduledForDeletion = $shippingordersToDelete;

        foreach ($shippingordersToDelete as $shippingorderRemoved) {
            $shippingorderRemoved->setUsers(null);
        }

        $this->collShippingorders = null;
        foreach ($shippingorders as $shippingorder) {
            $this->addShippingorder($shippingorder);
        }

        $this->collShippingorders = $shippingorders;
        $this->collShippingordersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Shippingorder objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Shippingorder objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countShippingorders(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collShippingordersPartial && !$this->isNew();
        if (null === $this->collShippingorders || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collShippingorders) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getShippingorders());
            }

            $query = ChildShippingorderQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collShippingorders);
    }

    /**
     * Method called to associate a ChildShippingorder object to this object
     * through the ChildShippingorder foreign key attribute.
     *
     * @param ChildShippingorder $l ChildShippingorder
     * @return $this The current object (for fluent API support)
     */
    public function addShippingorder(ChildShippingorder $l)
    {
        if ($this->collShippingorders === null) {
            $this->initShippingorders();
            $this->collShippingordersPartial = true;
        }

        if (!$this->collShippingorders->contains($l)) {
            $this->doAddShippingorder($l);

            if ($this->shippingordersScheduledForDeletion and $this->shippingordersScheduledForDeletion->contains($l)) {
                $this->shippingordersScheduledForDeletion->remove($this->shippingordersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildShippingorder $shippingorder The ChildShippingorder object to add.
     */
    protected function doAddShippingorder(ChildShippingorder $shippingorder): void
    {
        $this->collShippingorders[]= $shippingorder;
        $shippingorder->setUsers($this);
    }

    /**
     * @param ChildShippingorder $shippingorder The ChildShippingorder object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeShippingorder(ChildShippingorder $shippingorder)
    {
        if ($this->getShippingorders()->contains($shippingorder)) {
            $pos = $this->collShippingorders->search($shippingorder);
            $this->collShippingorders->remove($pos);
            if (null === $this->shippingordersScheduledForDeletion) {
                $this->shippingordersScheduledForDeletion = clone $this->collShippingorders;
                $this->shippingordersScheduledForDeletion->clear();
            }
            $this->shippingordersScheduledForDeletion[]= clone $shippingorder;
            $shippingorder->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related Shippingorders from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildShippingorder[] List of ChildShippingorder objects
     * @phpstan-return ObjectCollection&\Traversable<ChildShippingorder}> List of ChildShippingorder objects
     */
    public function getShippingordersJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildShippingorderQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getShippingorders($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related Shippingorders from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildShippingorder[] List of ChildShippingorder objects
     * @phpstan-return ObjectCollection&\Traversable<ChildShippingorder}> List of ChildShippingorder objects
     */
    public function getShippingordersJoinOrders(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildShippingorderQuery::create(null, $criteria);
        $query->joinWith('Orders', $joinBehavior);

        return $this->getShippingorders($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related Shippingorders from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildShippingorder[] List of ChildShippingorder objects
     * @phpstan-return ObjectCollection&\Traversable<ChildShippingorder}> List of ChildShippingorder objects
     */
    public function getShippingordersJoinStockVoucher(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildShippingorderQuery::create(null, $criteria);
        $query->joinWith('StockVoucher', $joinBehavior);

        return $this->getShippingorders($query, $con);
    }

    /**
     * Clears out the collStockTransactions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addStockTransactions()
     */
    public function clearStockTransactions()
    {
        $this->collStockTransactions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collStockTransactions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialStockTransactions($v = true): void
    {
        $this->collStockTransactionsPartial = $v;
    }

    /**
     * Initializes the collStockTransactions collection.
     *
     * By default this just sets the collStockTransactions collection to an empty array (like clearcollStockTransactions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStockTransactions(bool $overrideExisting = true): void
    {
        if (null !== $this->collStockTransactions && !$overrideExisting) {
            return;
        }

        $collectionClassName = StockTransactionTableMap::getTableMap()->getCollectionClassName();

        $this->collStockTransactions = new $collectionClassName;
        $this->collStockTransactions->setModel('\entities\StockTransaction');
    }

    /**
     * Gets an array of ChildStockTransaction objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildStockTransaction[] List of ChildStockTransaction objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStockTransaction> List of ChildStockTransaction objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStockTransactions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collStockTransactionsPartial && !$this->isNew();
        if (null === $this->collStockTransactions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collStockTransactions) {
                    $this->initStockTransactions();
                } else {
                    $collectionClassName = StockTransactionTableMap::getTableMap()->getCollectionClassName();

                    $collStockTransactions = new $collectionClassName;
                    $collStockTransactions->setModel('\entities\StockTransaction');

                    return $collStockTransactions;
                }
            } else {
                $collStockTransactions = ChildStockTransactionQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStockTransactionsPartial && count($collStockTransactions)) {
                        $this->initStockTransactions(false);

                        foreach ($collStockTransactions as $obj) {
                            if (false == $this->collStockTransactions->contains($obj)) {
                                $this->collStockTransactions->append($obj);
                            }
                        }

                        $this->collStockTransactionsPartial = true;
                    }

                    return $collStockTransactions;
                }

                if ($partial && $this->collStockTransactions) {
                    foreach ($this->collStockTransactions as $obj) {
                        if ($obj->isNew()) {
                            $collStockTransactions[] = $obj;
                        }
                    }
                }

                $this->collStockTransactions = $collStockTransactions;
                $this->collStockTransactionsPartial = false;
            }
        }

        return $this->collStockTransactions;
    }

    /**
     * Sets a collection of ChildStockTransaction objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $stockTransactions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setStockTransactions(Collection $stockTransactions, ?ConnectionInterface $con = null)
    {
        /** @var ChildStockTransaction[] $stockTransactionsToDelete */
        $stockTransactionsToDelete = $this->getStockTransactions(new Criteria(), $con)->diff($stockTransactions);


        $this->stockTransactionsScheduledForDeletion = $stockTransactionsToDelete;

        foreach ($stockTransactionsToDelete as $stockTransactionRemoved) {
            $stockTransactionRemoved->setUsers(null);
        }

        $this->collStockTransactions = null;
        foreach ($stockTransactions as $stockTransaction) {
            $this->addStockTransaction($stockTransaction);
        }

        $this->collStockTransactions = $stockTransactions;
        $this->collStockTransactionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related StockTransaction objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related StockTransaction objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countStockTransactions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collStockTransactionsPartial && !$this->isNew();
        if (null === $this->collStockTransactions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStockTransactions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStockTransactions());
            }

            $query = ChildStockTransactionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collStockTransactions);
    }

    /**
     * Method called to associate a ChildStockTransaction object to this object
     * through the ChildStockTransaction foreign key attribute.
     *
     * @param ChildStockTransaction $l ChildStockTransaction
     * @return $this The current object (for fluent API support)
     */
    public function addStockTransaction(ChildStockTransaction $l)
    {
        if ($this->collStockTransactions === null) {
            $this->initStockTransactions();
            $this->collStockTransactionsPartial = true;
        }

        if (!$this->collStockTransactions->contains($l)) {
            $this->doAddStockTransaction($l);

            if ($this->stockTransactionsScheduledForDeletion and $this->stockTransactionsScheduledForDeletion->contains($l)) {
                $this->stockTransactionsScheduledForDeletion->remove($this->stockTransactionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildStockTransaction $stockTransaction The ChildStockTransaction object to add.
     */
    protected function doAddStockTransaction(ChildStockTransaction $stockTransaction): void
    {
        $this->collStockTransactions[]= $stockTransaction;
        $stockTransaction->setUsers($this);
    }

    /**
     * @param ChildStockTransaction $stockTransaction The ChildStockTransaction object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeStockTransaction(ChildStockTransaction $stockTransaction)
    {
        if ($this->getStockTransactions()->contains($stockTransaction)) {
            $pos = $this->collStockTransactions->search($stockTransaction);
            $this->collStockTransactions->remove($pos);
            if (null === $this->stockTransactionsScheduledForDeletion) {
                $this->stockTransactionsScheduledForDeletion = clone $this->collStockTransactions;
                $this->stockTransactionsScheduledForDeletion->clear();
            }
            $this->stockTransactionsScheduledForDeletion[]= clone $stockTransaction;
            $stockTransaction->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related StockTransactions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStockTransaction[] List of ChildStockTransaction objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStockTransaction}> List of ChildStockTransaction objects
     */
    public function getStockTransactionsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStockTransactionQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getStockTransactions($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related StockTransactions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStockTransaction[] List of ChildStockTransaction objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStockTransaction}> List of ChildStockTransaction objects
     */
    public function getStockTransactionsJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStockTransactionQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getStockTransactions($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related StockTransactions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStockTransaction[] List of ChildStockTransaction objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStockTransaction}> List of ChildStockTransaction objects
     */
    public function getStockTransactionsJoinProducts(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStockTransactionQuery::create(null, $criteria);
        $query->joinWith('Products', $joinBehavior);

        return $this->getStockTransactions($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related StockTransactions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStockTransaction[] List of ChildStockTransaction objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStockTransaction}> List of ChildStockTransaction objects
     */
    public function getStockTransactionsJoinStockVoucher(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStockTransactionQuery::create(null, $criteria);
        $query->joinWith('StockVoucher', $joinBehavior);

        return $this->getStockTransactions($query, $con);
    }

    /**
     * Clears out the collStockVouchers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addStockVouchers()
     */
    public function clearStockVouchers()
    {
        $this->collStockVouchers = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collStockVouchers collection loaded partially.
     *
     * @return void
     */
    public function resetPartialStockVouchers($v = true): void
    {
        $this->collStockVouchersPartial = $v;
    }

    /**
     * Initializes the collStockVouchers collection.
     *
     * By default this just sets the collStockVouchers collection to an empty array (like clearcollStockVouchers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStockVouchers(bool $overrideExisting = true): void
    {
        if (null !== $this->collStockVouchers && !$overrideExisting) {
            return;
        }

        $collectionClassName = StockVoucherTableMap::getTableMap()->getCollectionClassName();

        $this->collStockVouchers = new $collectionClassName;
        $this->collStockVouchers->setModel('\entities\StockVoucher');
    }

    /**
     * Gets an array of ChildStockVoucher objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildStockVoucher[] List of ChildStockVoucher objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStockVoucher> List of ChildStockVoucher objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStockVouchers(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collStockVouchersPartial && !$this->isNew();
        if (null === $this->collStockVouchers || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collStockVouchers) {
                    $this->initStockVouchers();
                } else {
                    $collectionClassName = StockVoucherTableMap::getTableMap()->getCollectionClassName();

                    $collStockVouchers = new $collectionClassName;
                    $collStockVouchers->setModel('\entities\StockVoucher');

                    return $collStockVouchers;
                }
            } else {
                $collStockVouchers = ChildStockVoucherQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStockVouchersPartial && count($collStockVouchers)) {
                        $this->initStockVouchers(false);

                        foreach ($collStockVouchers as $obj) {
                            if (false == $this->collStockVouchers->contains($obj)) {
                                $this->collStockVouchers->append($obj);
                            }
                        }

                        $this->collStockVouchersPartial = true;
                    }

                    return $collStockVouchers;
                }

                if ($partial && $this->collStockVouchers) {
                    foreach ($this->collStockVouchers as $obj) {
                        if ($obj->isNew()) {
                            $collStockVouchers[] = $obj;
                        }
                    }
                }

                $this->collStockVouchers = $collStockVouchers;
                $this->collStockVouchersPartial = false;
            }
        }

        return $this->collStockVouchers;
    }

    /**
     * Sets a collection of ChildStockVoucher objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $stockVouchers A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setStockVouchers(Collection $stockVouchers, ?ConnectionInterface $con = null)
    {
        /** @var ChildStockVoucher[] $stockVouchersToDelete */
        $stockVouchersToDelete = $this->getStockVouchers(new Criteria(), $con)->diff($stockVouchers);


        $this->stockVouchersScheduledForDeletion = $stockVouchersToDelete;

        foreach ($stockVouchersToDelete as $stockVoucherRemoved) {
            $stockVoucherRemoved->setUsers(null);
        }

        $this->collStockVouchers = null;
        foreach ($stockVouchers as $stockVoucher) {
            $this->addStockVoucher($stockVoucher);
        }

        $this->collStockVouchers = $stockVouchers;
        $this->collStockVouchersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related StockVoucher objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related StockVoucher objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countStockVouchers(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collStockVouchersPartial && !$this->isNew();
        if (null === $this->collStockVouchers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStockVouchers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStockVouchers());
            }

            $query = ChildStockVoucherQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collStockVouchers);
    }

    /**
     * Method called to associate a ChildStockVoucher object to this object
     * through the ChildStockVoucher foreign key attribute.
     *
     * @param ChildStockVoucher $l ChildStockVoucher
     * @return $this The current object (for fluent API support)
     */
    public function addStockVoucher(ChildStockVoucher $l)
    {
        if ($this->collStockVouchers === null) {
            $this->initStockVouchers();
            $this->collStockVouchersPartial = true;
        }

        if (!$this->collStockVouchers->contains($l)) {
            $this->doAddStockVoucher($l);

            if ($this->stockVouchersScheduledForDeletion and $this->stockVouchersScheduledForDeletion->contains($l)) {
                $this->stockVouchersScheduledForDeletion->remove($this->stockVouchersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildStockVoucher $stockVoucher The ChildStockVoucher object to add.
     */
    protected function doAddStockVoucher(ChildStockVoucher $stockVoucher): void
    {
        $this->collStockVouchers[]= $stockVoucher;
        $stockVoucher->setUsers($this);
    }

    /**
     * @param ChildStockVoucher $stockVoucher The ChildStockVoucher object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeStockVoucher(ChildStockVoucher $stockVoucher)
    {
        if ($this->getStockVouchers()->contains($stockVoucher)) {
            $pos = $this->collStockVouchers->search($stockVoucher);
            $this->collStockVouchers->remove($pos);
            if (null === $this->stockVouchersScheduledForDeletion) {
                $this->stockVouchersScheduledForDeletion = clone $this->collStockVouchers;
                $this->stockVouchersScheduledForDeletion->clear();
            }
            $this->stockVouchersScheduledForDeletion[]= clone $stockVoucher;
            $stockVoucher->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related StockVouchers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildStockVoucher[] List of ChildStockVoucher objects
     * @phpstan-return ObjectCollection&\Traversable<ChildStockVoucher}> List of ChildStockVoucher objects
     */
    public function getStockVouchersJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildStockVoucherQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getStockVouchers($query, $con);
    }

    /**
     * Clears out the collUserSessionss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addUserSessionss()
     */
    public function clearUserSessionss()
    {
        $this->collUserSessionss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collUserSessionss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialUserSessionss($v = true): void
    {
        $this->collUserSessionssPartial = $v;
    }

    /**
     * Initializes the collUserSessionss collection.
     *
     * By default this just sets the collUserSessionss collection to an empty array (like clearcollUserSessionss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUserSessionss(bool $overrideExisting = true): void
    {
        if (null !== $this->collUserSessionss && !$overrideExisting) {
            return;
        }

        $collectionClassName = UserSessionsTableMap::getTableMap()->getCollectionClassName();

        $this->collUserSessionss = new $collectionClassName;
        $this->collUserSessionss->setModel('\entities\UserSessions');
    }

    /**
     * Gets an array of ChildUserSessions objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUserSessions[] List of ChildUserSessions objects
     * @phpstan-return ObjectCollection&\Traversable<ChildUserSessions> List of ChildUserSessions objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getUserSessionss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collUserSessionssPartial && !$this->isNew();
        if (null === $this->collUserSessionss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collUserSessionss) {
                    $this->initUserSessionss();
                } else {
                    $collectionClassName = UserSessionsTableMap::getTableMap()->getCollectionClassName();

                    $collUserSessionss = new $collectionClassName;
                    $collUserSessionss->setModel('\entities\UserSessions');

                    return $collUserSessionss;
                }
            } else {
                $collUserSessionss = ChildUserSessionsQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUserSessionssPartial && count($collUserSessionss)) {
                        $this->initUserSessionss(false);

                        foreach ($collUserSessionss as $obj) {
                            if (false == $this->collUserSessionss->contains($obj)) {
                                $this->collUserSessionss->append($obj);
                            }
                        }

                        $this->collUserSessionssPartial = true;
                    }

                    return $collUserSessionss;
                }

                if ($partial && $this->collUserSessionss) {
                    foreach ($this->collUserSessionss as $obj) {
                        if ($obj->isNew()) {
                            $collUserSessionss[] = $obj;
                        }
                    }
                }

                $this->collUserSessionss = $collUserSessionss;
                $this->collUserSessionssPartial = false;
            }
        }

        return $this->collUserSessionss;
    }

    /**
     * Sets a collection of ChildUserSessions objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $userSessionss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setUserSessionss(Collection $userSessionss, ?ConnectionInterface $con = null)
    {
        /** @var ChildUserSessions[] $userSessionssToDelete */
        $userSessionssToDelete = $this->getUserSessionss(new Criteria(), $con)->diff($userSessionss);


        $this->userSessionssScheduledForDeletion = $userSessionssToDelete;

        foreach ($userSessionssToDelete as $userSessionsRemoved) {
            $userSessionsRemoved->setUsers(null);
        }

        $this->collUserSessionss = null;
        foreach ($userSessionss as $userSessions) {
            $this->addUserSessions($userSessions);
        }

        $this->collUserSessionss = $userSessionss;
        $this->collUserSessionssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related UserSessions objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related UserSessions objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countUserSessionss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collUserSessionssPartial && !$this->isNew();
        if (null === $this->collUserSessionss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUserSessionss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUserSessionss());
            }

            $query = ChildUserSessionsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collUserSessionss);
    }

    /**
     * Method called to associate a ChildUserSessions object to this object
     * through the ChildUserSessions foreign key attribute.
     *
     * @param ChildUserSessions $l ChildUserSessions
     * @return $this The current object (for fluent API support)
     */
    public function addUserSessions(ChildUserSessions $l)
    {
        if ($this->collUserSessionss === null) {
            $this->initUserSessionss();
            $this->collUserSessionssPartial = true;
        }

        if (!$this->collUserSessionss->contains($l)) {
            $this->doAddUserSessions($l);

            if ($this->userSessionssScheduledForDeletion and $this->userSessionssScheduledForDeletion->contains($l)) {
                $this->userSessionssScheduledForDeletion->remove($this->userSessionssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildUserSessions $userSessions The ChildUserSessions object to add.
     */
    protected function doAddUserSessions(ChildUserSessions $userSessions): void
    {
        $this->collUserSessionss[]= $userSessions;
        $userSessions->setUsers($this);
    }

    /**
     * @param ChildUserSessions $userSessions The ChildUserSessions object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeUserSessions(ChildUserSessions $userSessions)
    {
        if ($this->getUserSessionss()->contains($userSessions)) {
            $pos = $this->collUserSessionss->search($userSessions);
            $this->collUserSessionss->remove($pos);
            if (null === $this->userSessionssScheduledForDeletion) {
                $this->userSessionssScheduledForDeletion = clone $this->collUserSessionss;
                $this->userSessionssScheduledForDeletion->clear();
            }
            $this->userSessionssScheduledForDeletion[]= $userSessions;
            $userSessions->setUsers(null);
        }

        return $this;
    }

    /**
     * Clears out the collUserTriggerss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addUserTriggerss()
     */
    public function clearUserTriggerss()
    {
        $this->collUserTriggerss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collUserTriggerss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialUserTriggerss($v = true): void
    {
        $this->collUserTriggerssPartial = $v;
    }

    /**
     * Initializes the collUserTriggerss collection.
     *
     * By default this just sets the collUserTriggerss collection to an empty array (like clearcollUserTriggerss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUserTriggerss(bool $overrideExisting = true): void
    {
        if (null !== $this->collUserTriggerss && !$overrideExisting) {
            return;
        }

        $collectionClassName = UserTriggersTableMap::getTableMap()->getCollectionClassName();

        $this->collUserTriggerss = new $collectionClassName;
        $this->collUserTriggerss->setModel('\entities\UserTriggers');
    }

    /**
     * Gets an array of ChildUserTriggers objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUserTriggers[] List of ChildUserTriggers objects
     * @phpstan-return ObjectCollection&\Traversable<ChildUserTriggers> List of ChildUserTriggers objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getUserTriggerss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collUserTriggerssPartial && !$this->isNew();
        if (null === $this->collUserTriggerss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collUserTriggerss) {
                    $this->initUserTriggerss();
                } else {
                    $collectionClassName = UserTriggersTableMap::getTableMap()->getCollectionClassName();

                    $collUserTriggerss = new $collectionClassName;
                    $collUserTriggerss->setModel('\entities\UserTriggers');

                    return $collUserTriggerss;
                }
            } else {
                $collUserTriggerss = ChildUserTriggersQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUserTriggerssPartial && count($collUserTriggerss)) {
                        $this->initUserTriggerss(false);

                        foreach ($collUserTriggerss as $obj) {
                            if (false == $this->collUserTriggerss->contains($obj)) {
                                $this->collUserTriggerss->append($obj);
                            }
                        }

                        $this->collUserTriggerssPartial = true;
                    }

                    return $collUserTriggerss;
                }

                if ($partial && $this->collUserTriggerss) {
                    foreach ($this->collUserTriggerss as $obj) {
                        if ($obj->isNew()) {
                            $collUserTriggerss[] = $obj;
                        }
                    }
                }

                $this->collUserTriggerss = $collUserTriggerss;
                $this->collUserTriggerssPartial = false;
            }
        }

        return $this->collUserTriggerss;
    }

    /**
     * Sets a collection of ChildUserTriggers objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $userTriggerss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setUserTriggerss(Collection $userTriggerss, ?ConnectionInterface $con = null)
    {
        /** @var ChildUserTriggers[] $userTriggerssToDelete */
        $userTriggerssToDelete = $this->getUserTriggerss(new Criteria(), $con)->diff($userTriggerss);


        $this->userTriggerssScheduledForDeletion = $userTriggerssToDelete;

        foreach ($userTriggerssToDelete as $userTriggersRemoved) {
            $userTriggersRemoved->setUsers(null);
        }

        $this->collUserTriggerss = null;
        foreach ($userTriggerss as $userTriggers) {
            $this->addUserTriggers($userTriggers);
        }

        $this->collUserTriggerss = $userTriggerss;
        $this->collUserTriggerssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related UserTriggers objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related UserTriggers objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countUserTriggerss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collUserTriggerssPartial && !$this->isNew();
        if (null === $this->collUserTriggerss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUserTriggerss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUserTriggerss());
            }

            $query = ChildUserTriggersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collUserTriggerss);
    }

    /**
     * Method called to associate a ChildUserTriggers object to this object
     * through the ChildUserTriggers foreign key attribute.
     *
     * @param ChildUserTriggers $l ChildUserTriggers
     * @return $this The current object (for fluent API support)
     */
    public function addUserTriggers(ChildUserTriggers $l)
    {
        if ($this->collUserTriggerss === null) {
            $this->initUserTriggerss();
            $this->collUserTriggerssPartial = true;
        }

        if (!$this->collUserTriggerss->contains($l)) {
            $this->doAddUserTriggers($l);

            if ($this->userTriggerssScheduledForDeletion and $this->userTriggerssScheduledForDeletion->contains($l)) {
                $this->userTriggerssScheduledForDeletion->remove($this->userTriggerssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildUserTriggers $userTriggers The ChildUserTriggers object to add.
     */
    protected function doAddUserTriggers(ChildUserTriggers $userTriggers): void
    {
        $this->collUserTriggerss[]= $userTriggers;
        $userTriggers->setUsers($this);
    }

    /**
     * @param ChildUserTriggers $userTriggers The ChildUserTriggers object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeUserTriggers(ChildUserTriggers $userTriggers)
    {
        if ($this->getUserTriggerss()->contains($userTriggers)) {
            $pos = $this->collUserTriggerss->search($userTriggers);
            $this->collUserTriggerss->remove($pos);
            if (null === $this->userTriggerssScheduledForDeletion) {
                $this->userTriggerssScheduledForDeletion = clone $this->collUserTriggerss;
                $this->userTriggerssScheduledForDeletion->clear();
            }
            $this->userTriggerssScheduledForDeletion[]= clone $userTriggers;
            $userTriggers->setUsers(null);
        }

        return $this;
    }

    /**
     * Clears out the collWdbSyncLogs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addWdbSyncLogs()
     */
    public function clearWdbSyncLogs()
    {
        $this->collWdbSyncLogs = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collWdbSyncLogs collection loaded partially.
     *
     * @return void
     */
    public function resetPartialWdbSyncLogs($v = true): void
    {
        $this->collWdbSyncLogsPartial = $v;
    }

    /**
     * Initializes the collWdbSyncLogs collection.
     *
     * By default this just sets the collWdbSyncLogs collection to an empty array (like clearcollWdbSyncLogs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initWdbSyncLogs(bool $overrideExisting = true): void
    {
        if (null !== $this->collWdbSyncLogs && !$overrideExisting) {
            return;
        }

        $collectionClassName = WdbSyncLogTableMap::getTableMap()->getCollectionClassName();

        $this->collWdbSyncLogs = new $collectionClassName;
        $this->collWdbSyncLogs->setModel('\entities\WdbSyncLog');
    }

    /**
     * Gets an array of ChildWdbSyncLog objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildWdbSyncLog[] List of ChildWdbSyncLog objects
     * @phpstan-return ObjectCollection&\Traversable<ChildWdbSyncLog> List of ChildWdbSyncLog objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getWdbSyncLogs(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collWdbSyncLogsPartial && !$this->isNew();
        if (null === $this->collWdbSyncLogs || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collWdbSyncLogs) {
                    $this->initWdbSyncLogs();
                } else {
                    $collectionClassName = WdbSyncLogTableMap::getTableMap()->getCollectionClassName();

                    $collWdbSyncLogs = new $collectionClassName;
                    $collWdbSyncLogs->setModel('\entities\WdbSyncLog');

                    return $collWdbSyncLogs;
                }
            } else {
                $collWdbSyncLogs = ChildWdbSyncLogQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collWdbSyncLogsPartial && count($collWdbSyncLogs)) {
                        $this->initWdbSyncLogs(false);

                        foreach ($collWdbSyncLogs as $obj) {
                            if (false == $this->collWdbSyncLogs->contains($obj)) {
                                $this->collWdbSyncLogs->append($obj);
                            }
                        }

                        $this->collWdbSyncLogsPartial = true;
                    }

                    return $collWdbSyncLogs;
                }

                if ($partial && $this->collWdbSyncLogs) {
                    foreach ($this->collWdbSyncLogs as $obj) {
                        if ($obj->isNew()) {
                            $collWdbSyncLogs[] = $obj;
                        }
                    }
                }

                $this->collWdbSyncLogs = $collWdbSyncLogs;
                $this->collWdbSyncLogsPartial = false;
            }
        }

        return $this->collWdbSyncLogs;
    }

    /**
     * Sets a collection of ChildWdbSyncLog objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $wdbSyncLogs A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setWdbSyncLogs(Collection $wdbSyncLogs, ?ConnectionInterface $con = null)
    {
        /** @var ChildWdbSyncLog[] $wdbSyncLogsToDelete */
        $wdbSyncLogsToDelete = $this->getWdbSyncLogs(new Criteria(), $con)->diff($wdbSyncLogs);


        $this->wdbSyncLogsScheduledForDeletion = $wdbSyncLogsToDelete;

        foreach ($wdbSyncLogsToDelete as $wdbSyncLogRemoved) {
            $wdbSyncLogRemoved->setUsers(null);
        }

        $this->collWdbSyncLogs = null;
        foreach ($wdbSyncLogs as $wdbSyncLog) {
            $this->addWdbSyncLog($wdbSyncLog);
        }

        $this->collWdbSyncLogs = $wdbSyncLogs;
        $this->collWdbSyncLogsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related WdbSyncLog objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related WdbSyncLog objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countWdbSyncLogs(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collWdbSyncLogsPartial && !$this->isNew();
        if (null === $this->collWdbSyncLogs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collWdbSyncLogs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getWdbSyncLogs());
            }

            $query = ChildWdbSyncLogQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collWdbSyncLogs);
    }

    /**
     * Method called to associate a ChildWdbSyncLog object to this object
     * through the ChildWdbSyncLog foreign key attribute.
     *
     * @param ChildWdbSyncLog $l ChildWdbSyncLog
     * @return $this The current object (for fluent API support)
     */
    public function addWdbSyncLog(ChildWdbSyncLog $l)
    {
        if ($this->collWdbSyncLogs === null) {
            $this->initWdbSyncLogs();
            $this->collWdbSyncLogsPartial = true;
        }

        if (!$this->collWdbSyncLogs->contains($l)) {
            $this->doAddWdbSyncLog($l);

            if ($this->wdbSyncLogsScheduledForDeletion and $this->wdbSyncLogsScheduledForDeletion->contains($l)) {
                $this->wdbSyncLogsScheduledForDeletion->remove($this->wdbSyncLogsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildWdbSyncLog $wdbSyncLog The ChildWdbSyncLog object to add.
     */
    protected function doAddWdbSyncLog(ChildWdbSyncLog $wdbSyncLog): void
    {
        $this->collWdbSyncLogs[]= $wdbSyncLog;
        $wdbSyncLog->setUsers($this);
    }

    /**
     * @param ChildWdbSyncLog $wdbSyncLog The ChildWdbSyncLog object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeWdbSyncLog(ChildWdbSyncLog $wdbSyncLog)
    {
        if ($this->getWdbSyncLogs()->contains($wdbSyncLog)) {
            $pos = $this->collWdbSyncLogs->search($wdbSyncLog);
            $this->collWdbSyncLogs->remove($pos);
            if (null === $this->wdbSyncLogsScheduledForDeletion) {
                $this->wdbSyncLogsScheduledForDeletion = clone $this->collWdbSyncLogs;
                $this->wdbSyncLogsScheduledForDeletion->clear();
            }
            $this->wdbSyncLogsScheduledForDeletion[]= $wdbSyncLog;
            $wdbSyncLog->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related WdbSyncLogs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildWdbSyncLog[] List of ChildWdbSyncLog objects
     * @phpstan-return ObjectCollection&\Traversable<ChildWdbSyncLog}> List of ChildWdbSyncLog objects
     */
    public function getWdbSyncLogsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildWdbSyncLogQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getWdbSyncLogs($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        if (null !== $this->aCompany) {
            $this->aCompany->removeUsers($this);
        }
        if (null !== $this->aEmployee) {
            $this->aEmployee->removeUsers($this);
        }
        if (null !== $this->aRoles) {
            $this->aRoles->removeUsers($this);
        }
        $this->user_id = null;
        $this->name = null;
        $this->username = null;
        $this->email = null;
        $this->isd_code = null;
        $this->phone = null;
        $this->otp = null;
        $this->company_id = null;
        $this->password = null;
        $this->role_id = null;
        $this->employee_id = null;
        $this->last_login = null;
        $this->ip_address = null;
        $this->ip_location = null;
        $this->session_token = null;
        $this->app_token = null;
        $this->status = null;
        $this->default_user = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);

        return $this;
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param bool $deep Whether to also clear the references on all referrer objects.
     * @return $this
     */
    public function clearAllReferences(bool $deep = false)
    {
        if ($deep) {
            if ($this->collAuditTableDatas) {
                foreach ($this->collAuditTableDatas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collEmployeeLogs) {
                foreach ($this->collEmployeeLogs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOrderLogs) {
                foreach ($this->collOrderLogs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collShippingorders) {
                foreach ($this->collShippingorders as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collStockTransactions) {
                foreach ($this->collStockTransactions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collStockVouchers) {
                foreach ($this->collStockVouchers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUserSessionss) {
                foreach ($this->collUserSessionss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUserTriggerss) {
                foreach ($this->collUserTriggerss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collWdbSyncLogs) {
                foreach ($this->collWdbSyncLogs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collAuditTableDatas = null;
        $this->collEmployeeLogs = null;
        $this->collOrderLogs = null;
        $this->collShippingorders = null;
        $this->collStockTransactions = null;
        $this->collStockVouchers = null;
        $this->collUserSessionss = null;
        $this->collUserTriggerss = null;
        $this->collWdbSyncLogs = null;
        $this->aCompany = null;
        $this->aEmployee = null;
        $this->aRoles = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UsersTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preSave(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postSave(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before inserting to database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preInsert(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postInsert(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before updating the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preUpdate(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postUpdate(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before deleting the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preDelete(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postDelete(?ConnectionInterface $con = null): void
    {
            }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);
            $inputData = $params[0];
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->importFrom($format, $inputData, $keyType);
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = $params[0] ?? true;
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->exportTo($format, $includeLazyLoadColumns, $keyType);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
