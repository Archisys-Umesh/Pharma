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
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use entities\NotificationsQuery as ChildNotificationsQuery;
use entities\Map\NotificationsTableMap;

/**
 * Base class that represents a row from the 'notifications' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class Notifications implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\NotificationsTableMap';


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
     * The value for the notification_id field.
     *
     * @var        string
     */
    protected $notification_id;

    /**
     * The value for the to_employee_id field.
     *
     * @var        int|null
     */
    protected $to_employee_id;

    /**
     * The value for the cc_employee_ids field.
     *
     * @var        string|null
     */
    protected $cc_employee_ids;

    /**
     * The value for the template_key field.
     *
     * @var        string|null
     */
    protected $template_key;

    /**
     * The value for the data_dump field.
     *
     * @var        string|null
     */
    protected $data_dump;

    /**
     * The value for the send_email field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $send_email;

    /**
     * The value for the send_sms field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $send_sms;

    /**
     * The value for the send_push field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $send_push;

    /**
     * The value for the email_sent_datetime field.
     *
     * @var        DateTime|null
     */
    protected $email_sent_datetime;

    /**
     * The value for the email_sent_status field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $email_sent_status;

    /**
     * The value for the email_trans_id field.
     *
     * @var        string|null
     */
    protected $email_trans_id;

    /**
     * The value for the sms_sent_datetime field.
     *
     * @var        DateTime|null
     */
    protected $sms_sent_datetime;

    /**
     * The value for the sms_sent_status field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $sms_sent_status;

    /**
     * The value for the sms_trans_id field.
     *
     * @var        string|null
     */
    protected $sms_trans_id;

    /**
     * The value for the push_sent_datetime field.
     *
     * @var        DateTime|null
     */
    protected $push_sent_datetime;

    /**
     * The value for the push_sent_status field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $push_sent_status;

    /**
     * The value for the push_trans_id field.
     *
     * @var        string|null
     */
    protected $push_trans_id;

    /**
     * The value for the schedule_at field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime|null
     */
    protected $schedule_at;

    /**
     * The value for the email_sent_attempts field.
     *
     * @var        int|null
     */
    protected $email_sent_attempts;

    /**
     * The value for the sms_sent_attempts field.
     *
     * @var        int|null
     */
    protected $sms_sent_attempts;

    /**
     * The value for the push_sent_attempts field.
     *
     * @var        int|null
     */
    protected $push_sent_attempts;

    /**
     * The value for the company_id field.
     *
     * @var        int|null
     */
    protected $company_id;

    /**
     * The value for the created_at field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
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
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->send_email = false;
        $this->send_sms = false;
        $this->send_push = false;
        $this->email_sent_status = false;
        $this->sms_sent_status = false;
        $this->push_sent_status = false;
    }

    /**
     * Initializes internal state of entities\Base\Notifications object.
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
     * Compares this with another <code>Notifications</code> instance.  If
     * <code>obj</code> is an instance of <code>Notifications</code>, delegates to
     * <code>equals(Notifications)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [notification_id] column value.
     *
     * @return string
     */
    public function getNotificationId()
    {
        return $this->notification_id;
    }

    /**
     * Get the [to_employee_id] column value.
     *
     * @return int|null
     */
    public function getToEmployeeId()
    {
        return $this->to_employee_id;
    }

    /**
     * Get the [cc_employee_ids] column value.
     *
     * @return string|null
     */
    public function getCcEmployeeIds()
    {
        return $this->cc_employee_ids;
    }

    /**
     * Get the [template_key] column value.
     *
     * @return string|null
     */
    public function getTemplateKey()
    {
        return $this->template_key;
    }

    /**
     * Get the [data_dump] column value.
     *
     * @return string|null
     */
    public function getDataDump()
    {
        return $this->data_dump;
    }

    /**
     * Get the [send_email] column value.
     *
     * @return boolean|null
     */
    public function getSendEmail()
    {
        return $this->send_email;
    }

    /**
     * Get the [send_email] column value.
     *
     * @return boolean|null
     */
    public function isSendEmail()
    {
        return $this->getSendEmail();
    }

    /**
     * Get the [send_sms] column value.
     *
     * @return boolean|null
     */
    public function getSendSms()
    {
        return $this->send_sms;
    }

    /**
     * Get the [send_sms] column value.
     *
     * @return boolean|null
     */
    public function isSendSms()
    {
        return $this->getSendSms();
    }

    /**
     * Get the [send_push] column value.
     *
     * @return boolean|null
     */
    public function getSendPush()
    {
        return $this->send_push;
    }

    /**
     * Get the [send_push] column value.
     *
     * @return boolean|null
     */
    public function isSendPush()
    {
        return $this->getSendPush();
    }

    /**
     * Get the [optionally formatted] temporal [email_sent_datetime] column value.
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
    public function getEmailSentDatetime($format = null)
    {
        if ($format === null) {
            return $this->email_sent_datetime;
        } else {
            return $this->email_sent_datetime instanceof \DateTimeInterface ? $this->email_sent_datetime->format($format) : null;
        }
    }

    /**
     * Get the [email_sent_status] column value.
     *
     * @return boolean|null
     */
    public function getEmailSentStatus()
    {
        return $this->email_sent_status;
    }

    /**
     * Get the [email_sent_status] column value.
     *
     * @return boolean|null
     */
    public function isEmailSentStatus()
    {
        return $this->getEmailSentStatus();
    }

    /**
     * Get the [email_trans_id] column value.
     *
     * @return string|null
     */
    public function getEmailTransId()
    {
        return $this->email_trans_id;
    }

    /**
     * Get the [optionally formatted] temporal [sms_sent_datetime] column value.
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
    public function getSmsSentDatetime($format = null)
    {
        if ($format === null) {
            return $this->sms_sent_datetime;
        } else {
            return $this->sms_sent_datetime instanceof \DateTimeInterface ? $this->sms_sent_datetime->format($format) : null;
        }
    }

    /**
     * Get the [sms_sent_status] column value.
     *
     * @return boolean|null
     */
    public function getSmsSentStatus()
    {
        return $this->sms_sent_status;
    }

    /**
     * Get the [sms_sent_status] column value.
     *
     * @return boolean|null
     */
    public function isSmsSentStatus()
    {
        return $this->getSmsSentStatus();
    }

    /**
     * Get the [sms_trans_id] column value.
     *
     * @return string|null
     */
    public function getSmsTransId()
    {
        return $this->sms_trans_id;
    }

    /**
     * Get the [optionally formatted] temporal [push_sent_datetime] column value.
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
    public function getPushSentDatetime($format = null)
    {
        if ($format === null) {
            return $this->push_sent_datetime;
        } else {
            return $this->push_sent_datetime instanceof \DateTimeInterface ? $this->push_sent_datetime->format($format) : null;
        }
    }

    /**
     * Get the [push_sent_status] column value.
     *
     * @return boolean|null
     */
    public function getPushSentStatus()
    {
        return $this->push_sent_status;
    }

    /**
     * Get the [push_sent_status] column value.
     *
     * @return boolean|null
     */
    public function isPushSentStatus()
    {
        return $this->getPushSentStatus();
    }

    /**
     * Get the [push_trans_id] column value.
     *
     * @return string|null
     */
    public function getPushTransId()
    {
        return $this->push_trans_id;
    }

    /**
     * Get the [optionally formatted] temporal [schedule_at] column value.
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
    public function getScheduleAt($format = null)
    {
        if ($format === null) {
            return $this->schedule_at;
        } else {
            return $this->schedule_at instanceof \DateTimeInterface ? $this->schedule_at->format($format) : null;
        }
    }

    /**
     * Get the [email_sent_attempts] column value.
     *
     * @return int|null
     */
    public function getEmailSentAttempts()
    {
        return $this->email_sent_attempts;
    }

    /**
     * Get the [sms_sent_attempts] column value.
     *
     * @return int|null
     */
    public function getSmsSentAttempts()
    {
        return $this->sms_sent_attempts;
    }

    /**
     * Get the [push_sent_attempts] column value.
     *
     * @return int|null
     */
    public function getPushSentAttempts()
    {
        return $this->push_sent_attempts;
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
     * Set the value of [notification_id] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNotificationId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->notification_id !== $v) {
            $this->notification_id = $v;
            $this->modifiedColumns[NotificationsTableMap::COL_NOTIFICATION_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [to_employee_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setToEmployeeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->to_employee_id !== $v) {
            $this->to_employee_id = $v;
            $this->modifiedColumns[NotificationsTableMap::COL_TO_EMPLOYEE_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [cc_employee_ids] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCcEmployeeIds($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cc_employee_ids !== $v) {
            $this->cc_employee_ids = $v;
            $this->modifiedColumns[NotificationsTableMap::COL_CC_EMPLOYEE_IDS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [template_key] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTemplateKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->template_key !== $v) {
            $this->template_key = $v;
            $this->modifiedColumns[NotificationsTableMap::COL_TEMPLATE_KEY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [data_dump] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDataDump($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->data_dump !== $v) {
            $this->data_dump = $v;
            $this->modifiedColumns[NotificationsTableMap::COL_DATA_DUMP] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [send_email] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setSendEmail($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->send_email !== $v) {
            $this->send_email = $v;
            $this->modifiedColumns[NotificationsTableMap::COL_SEND_EMAIL] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [send_sms] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setSendSms($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->send_sms !== $v) {
            $this->send_sms = $v;
            $this->modifiedColumns[NotificationsTableMap::COL_SEND_SMS] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [send_push] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setSendPush($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->send_push !== $v) {
            $this->send_push = $v;
            $this->modifiedColumns[NotificationsTableMap::COL_SEND_PUSH] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [email_sent_datetime] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setEmailSentDatetime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->email_sent_datetime !== null || $dt !== null) {
            if ($this->email_sent_datetime === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->email_sent_datetime->format("Y-m-d H:i:s.u")) {
                $this->email_sent_datetime = $dt === null ? null : clone $dt;
                $this->modifiedColumns[NotificationsTableMap::COL_EMAIL_SENT_DATETIME] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of the [email_sent_status] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setEmailSentStatus($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->email_sent_status !== $v) {
            $this->email_sent_status = $v;
            $this->modifiedColumns[NotificationsTableMap::COL_EMAIL_SENT_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [email_trans_id] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmailTransId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email_trans_id !== $v) {
            $this->email_trans_id = $v;
            $this->modifiedColumns[NotificationsTableMap::COL_EMAIL_TRANS_ID] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [sms_sent_datetime] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setSmsSentDatetime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->sms_sent_datetime !== null || $dt !== null) {
            if ($this->sms_sent_datetime === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->sms_sent_datetime->format("Y-m-d H:i:s.u")) {
                $this->sms_sent_datetime = $dt === null ? null : clone $dt;
                $this->modifiedColumns[NotificationsTableMap::COL_SMS_SENT_DATETIME] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of the [sms_sent_status] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setSmsSentStatus($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->sms_sent_status !== $v) {
            $this->sms_sent_status = $v;
            $this->modifiedColumns[NotificationsTableMap::COL_SMS_SENT_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sms_trans_id] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSmsTransId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sms_trans_id !== $v) {
            $this->sms_trans_id = $v;
            $this->modifiedColumns[NotificationsTableMap::COL_SMS_TRANS_ID] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [push_sent_datetime] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setPushSentDatetime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->push_sent_datetime !== null || $dt !== null) {
            if ($this->push_sent_datetime === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->push_sent_datetime->format("Y-m-d H:i:s.u")) {
                $this->push_sent_datetime = $dt === null ? null : clone $dt;
                $this->modifiedColumns[NotificationsTableMap::COL_PUSH_SENT_DATETIME] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of the [push_sent_status] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setPushSentStatus($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->push_sent_status !== $v) {
            $this->push_sent_status = $v;
            $this->modifiedColumns[NotificationsTableMap::COL_PUSH_SENT_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [push_trans_id] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPushTransId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->push_trans_id !== $v) {
            $this->push_trans_id = $v;
            $this->modifiedColumns[NotificationsTableMap::COL_PUSH_TRANS_ID] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [schedule_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setScheduleAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->schedule_at !== null || $dt !== null) {
            if ($this->schedule_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->schedule_at->format("Y-m-d H:i:s.u")) {
                $this->schedule_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[NotificationsTableMap::COL_SCHEDULE_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [email_sent_attempts] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmailSentAttempts($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->email_sent_attempts !== $v) {
            $this->email_sent_attempts = $v;
            $this->modifiedColumns[NotificationsTableMap::COL_EMAIL_SENT_ATTEMPTS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sms_sent_attempts] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSmsSentAttempts($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->sms_sent_attempts !== $v) {
            $this->sms_sent_attempts = $v;
            $this->modifiedColumns[NotificationsTableMap::COL_SMS_SENT_ATTEMPTS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [push_sent_attempts] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPushSentAttempts($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->push_sent_attempts !== $v) {
            $this->push_sent_attempts = $v;
            $this->modifiedColumns[NotificationsTableMap::COL_PUSH_SENT_ATTEMPTS] = true;
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
            $this->modifiedColumns[NotificationsTableMap::COL_COMPANY_ID] = true;
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
                $this->modifiedColumns[NotificationsTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[NotificationsTableMap::COL_UPDATED_AT] = true;
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
            if ($this->send_email !== false) {
                return false;
            }

            if ($this->send_sms !== false) {
                return false;
            }

            if ($this->send_push !== false) {
                return false;
            }

            if ($this->email_sent_status !== false) {
                return false;
            }

            if ($this->sms_sent_status !== false) {
                return false;
            }

            if ($this->push_sent_status !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : NotificationsTableMap::translateFieldName('NotificationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->notification_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : NotificationsTableMap::translateFieldName('ToEmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->to_employee_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : NotificationsTableMap::translateFieldName('CcEmployeeIds', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cc_employee_ids = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : NotificationsTableMap::translateFieldName('TemplateKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->template_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : NotificationsTableMap::translateFieldName('DataDump', TableMap::TYPE_PHPNAME, $indexType)];
            $this->data_dump = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : NotificationsTableMap::translateFieldName('SendEmail', TableMap::TYPE_PHPNAME, $indexType)];
            $this->send_email = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : NotificationsTableMap::translateFieldName('SendSms', TableMap::TYPE_PHPNAME, $indexType)];
            $this->send_sms = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : NotificationsTableMap::translateFieldName('SendPush', TableMap::TYPE_PHPNAME, $indexType)];
            $this->send_push = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : NotificationsTableMap::translateFieldName('EmailSentDatetime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email_sent_datetime = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : NotificationsTableMap::translateFieldName('EmailSentStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email_sent_status = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : NotificationsTableMap::translateFieldName('EmailTransId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email_trans_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : NotificationsTableMap::translateFieldName('SmsSentDatetime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sms_sent_datetime = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : NotificationsTableMap::translateFieldName('SmsSentStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sms_sent_status = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : NotificationsTableMap::translateFieldName('SmsTransId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sms_trans_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : NotificationsTableMap::translateFieldName('PushSentDatetime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->push_sent_datetime = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : NotificationsTableMap::translateFieldName('PushSentStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->push_sent_status = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : NotificationsTableMap::translateFieldName('PushTransId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->push_trans_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : NotificationsTableMap::translateFieldName('ScheduleAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->schedule_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : NotificationsTableMap::translateFieldName('EmailSentAttempts', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email_sent_attempts = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : NotificationsTableMap::translateFieldName('SmsSentAttempts', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sms_sent_attempts = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : NotificationsTableMap::translateFieldName('PushSentAttempts', TableMap::TYPE_PHPNAME, $indexType)];
            $this->push_sent_attempts = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : NotificationsTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : NotificationsTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : NotificationsTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 24; // 24 = NotificationsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\Notifications'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(NotificationsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildNotificationsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Notifications::setDeleted()
     * @see Notifications::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(NotificationsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildNotificationsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(NotificationsTableMap::DATABASE_NAME);
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
                NotificationsTableMap::addInstanceToPool($this);
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

        $this->modifiedColumns[NotificationsTableMap::COL_NOTIFICATION_ID] = true;
        if (null !== $this->notification_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . NotificationsTableMap::COL_NOTIFICATION_ID . ')');
        }
        if (null === $this->notification_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('notifications_notification_id_seq')");
                $this->notification_id = (string) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(NotificationsTableMap::COL_NOTIFICATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'notification_id';
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_TO_EMPLOYEE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'to_employee_id';
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_CC_EMPLOYEE_IDS)) {
            $modifiedColumns[':p' . $index++]  = 'cc_employee_ids';
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_TEMPLATE_KEY)) {
            $modifiedColumns[':p' . $index++]  = 'template_key';
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_DATA_DUMP)) {
            $modifiedColumns[':p' . $index++]  = 'data_dump';
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_SEND_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'send_email';
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_SEND_SMS)) {
            $modifiedColumns[':p' . $index++]  = 'send_sms';
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_SEND_PUSH)) {
            $modifiedColumns[':p' . $index++]  = 'send_push';
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_EMAIL_SENT_DATETIME)) {
            $modifiedColumns[':p' . $index++]  = 'email_sent_datetime';
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_EMAIL_SENT_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'email_sent_status';
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_EMAIL_TRANS_ID)) {
            $modifiedColumns[':p' . $index++]  = 'email_trans_id';
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_SMS_SENT_DATETIME)) {
            $modifiedColumns[':p' . $index++]  = 'sms_sent_datetime';
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_SMS_SENT_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'sms_sent_status';
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_SMS_TRANS_ID)) {
            $modifiedColumns[':p' . $index++]  = 'sms_trans_id';
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_PUSH_SENT_DATETIME)) {
            $modifiedColumns[':p' . $index++]  = 'push_sent_datetime';
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_PUSH_SENT_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'push_sent_status';
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_PUSH_TRANS_ID)) {
            $modifiedColumns[':p' . $index++]  = 'push_trans_id';
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_SCHEDULE_AT)) {
            $modifiedColumns[':p' . $index++]  = 'schedule_at';
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_EMAIL_SENT_ATTEMPTS)) {
            $modifiedColumns[':p' . $index++]  = 'email_sent_attempts';
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_SMS_SENT_ATTEMPTS)) {
            $modifiedColumns[':p' . $index++]  = 'sms_sent_attempts';
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_PUSH_SENT_ATTEMPTS)) {
            $modifiedColumns[':p' . $index++]  = 'push_sent_attempts';
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO notifications (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'notification_id':
                        $stmt->bindValue($identifier, $this->notification_id, PDO::PARAM_INT);

                        break;
                    case 'to_employee_id':
                        $stmt->bindValue($identifier, $this->to_employee_id, PDO::PARAM_INT);

                        break;
                    case 'cc_employee_ids':
                        $stmt->bindValue($identifier, $this->cc_employee_ids, PDO::PARAM_STR);

                        break;
                    case 'template_key':
                        $stmt->bindValue($identifier, $this->template_key, PDO::PARAM_STR);

                        break;
                    case 'data_dump':
                        $stmt->bindValue($identifier, $this->data_dump, PDO::PARAM_STR);

                        break;
                    case 'send_email':
                        $stmt->bindValue($identifier, $this->send_email, PDO::PARAM_BOOL);

                        break;
                    case 'send_sms':
                        $stmt->bindValue($identifier, $this->send_sms, PDO::PARAM_BOOL);

                        break;
                    case 'send_push':
                        $stmt->bindValue($identifier, $this->send_push, PDO::PARAM_BOOL);

                        break;
                    case 'email_sent_datetime':
                        $stmt->bindValue($identifier, $this->email_sent_datetime ? $this->email_sent_datetime->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'email_sent_status':
                        $stmt->bindValue($identifier, $this->email_sent_status, PDO::PARAM_BOOL);

                        break;
                    case 'email_trans_id':
                        $stmt->bindValue($identifier, $this->email_trans_id, PDO::PARAM_STR);

                        break;
                    case 'sms_sent_datetime':
                        $stmt->bindValue($identifier, $this->sms_sent_datetime ? $this->sms_sent_datetime->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'sms_sent_status':
                        $stmt->bindValue($identifier, $this->sms_sent_status, PDO::PARAM_BOOL);

                        break;
                    case 'sms_trans_id':
                        $stmt->bindValue($identifier, $this->sms_trans_id, PDO::PARAM_STR);

                        break;
                    case 'push_sent_datetime':
                        $stmt->bindValue($identifier, $this->push_sent_datetime ? $this->push_sent_datetime->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'push_sent_status':
                        $stmt->bindValue($identifier, $this->push_sent_status, PDO::PARAM_BOOL);

                        break;
                    case 'push_trans_id':
                        $stmt->bindValue($identifier, $this->push_trans_id, PDO::PARAM_STR);

                        break;
                    case 'schedule_at':
                        $stmt->bindValue($identifier, $this->schedule_at ? $this->schedule_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'email_sent_attempts':
                        $stmt->bindValue($identifier, $this->email_sent_attempts, PDO::PARAM_INT);

                        break;
                    case 'sms_sent_attempts':
                        $stmt->bindValue($identifier, $this->sms_sent_attempts, PDO::PARAM_INT);

                        break;
                    case 'push_sent_attempts':
                        $stmt->bindValue($identifier, $this->push_sent_attempts, PDO::PARAM_INT);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

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
        $pos = NotificationsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getNotificationId();

            case 1:
                return $this->getToEmployeeId();

            case 2:
                return $this->getCcEmployeeIds();

            case 3:
                return $this->getTemplateKey();

            case 4:
                return $this->getDataDump();

            case 5:
                return $this->getSendEmail();

            case 6:
                return $this->getSendSms();

            case 7:
                return $this->getSendPush();

            case 8:
                return $this->getEmailSentDatetime();

            case 9:
                return $this->getEmailSentStatus();

            case 10:
                return $this->getEmailTransId();

            case 11:
                return $this->getSmsSentDatetime();

            case 12:
                return $this->getSmsSentStatus();

            case 13:
                return $this->getSmsTransId();

            case 14:
                return $this->getPushSentDatetime();

            case 15:
                return $this->getPushSentStatus();

            case 16:
                return $this->getPushTransId();

            case 17:
                return $this->getScheduleAt();

            case 18:
                return $this->getEmailSentAttempts();

            case 19:
                return $this->getSmsSentAttempts();

            case 20:
                return $this->getPushSentAttempts();

            case 21:
                return $this->getCompanyId();

            case 22:
                return $this->getCreatedAt();

            case 23:
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
     *
     * @return array An associative array containing the field names (as keys) and field values
     */
    public function toArray(string $keyType = TableMap::TYPE_PHPNAME, bool $includeLazyLoadColumns = true, array $alreadyDumpedObjects = []): array
    {
        if (isset($alreadyDumpedObjects['Notifications'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Notifications'][$this->hashCode()] = true;
        $keys = NotificationsTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getNotificationId(),
            $keys[1] => $this->getToEmployeeId(),
            $keys[2] => $this->getCcEmployeeIds(),
            $keys[3] => $this->getTemplateKey(),
            $keys[4] => $this->getDataDump(),
            $keys[5] => $this->getSendEmail(),
            $keys[6] => $this->getSendSms(),
            $keys[7] => $this->getSendPush(),
            $keys[8] => $this->getEmailSentDatetime(),
            $keys[9] => $this->getEmailSentStatus(),
            $keys[10] => $this->getEmailTransId(),
            $keys[11] => $this->getSmsSentDatetime(),
            $keys[12] => $this->getSmsSentStatus(),
            $keys[13] => $this->getSmsTransId(),
            $keys[14] => $this->getPushSentDatetime(),
            $keys[15] => $this->getPushSentStatus(),
            $keys[16] => $this->getPushTransId(),
            $keys[17] => $this->getScheduleAt(),
            $keys[18] => $this->getEmailSentAttempts(),
            $keys[19] => $this->getSmsSentAttempts(),
            $keys[20] => $this->getPushSentAttempts(),
            $keys[21] => $this->getCompanyId(),
            $keys[22] => $this->getCreatedAt(),
            $keys[23] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[11]] instanceof \DateTimeInterface) {
            $result[$keys[11]] = $result[$keys[11]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[14]] instanceof \DateTimeInterface) {
            $result[$keys[14]] = $result[$keys[14]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[17]] instanceof \DateTimeInterface) {
            $result[$keys[17]] = $result[$keys[17]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[22]] instanceof \DateTimeInterface) {
            $result[$keys[22]] = $result[$keys[22]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[23]] instanceof \DateTimeInterface) {
            $result[$keys[23]] = $result[$keys[23]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
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
        $pos = NotificationsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setNotificationId($value);
                break;
            case 1:
                $this->setToEmployeeId($value);
                break;
            case 2:
                $this->setCcEmployeeIds($value);
                break;
            case 3:
                $this->setTemplateKey($value);
                break;
            case 4:
                $this->setDataDump($value);
                break;
            case 5:
                $this->setSendEmail($value);
                break;
            case 6:
                $this->setSendSms($value);
                break;
            case 7:
                $this->setSendPush($value);
                break;
            case 8:
                $this->setEmailSentDatetime($value);
                break;
            case 9:
                $this->setEmailSentStatus($value);
                break;
            case 10:
                $this->setEmailTransId($value);
                break;
            case 11:
                $this->setSmsSentDatetime($value);
                break;
            case 12:
                $this->setSmsSentStatus($value);
                break;
            case 13:
                $this->setSmsTransId($value);
                break;
            case 14:
                $this->setPushSentDatetime($value);
                break;
            case 15:
                $this->setPushSentStatus($value);
                break;
            case 16:
                $this->setPushTransId($value);
                break;
            case 17:
                $this->setScheduleAt($value);
                break;
            case 18:
                $this->setEmailSentAttempts($value);
                break;
            case 19:
                $this->setSmsSentAttempts($value);
                break;
            case 20:
                $this->setPushSentAttempts($value);
                break;
            case 21:
                $this->setCompanyId($value);
                break;
            case 22:
                $this->setCreatedAt($value);
                break;
            case 23:
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
        $keys = NotificationsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setNotificationId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setToEmployeeId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setCcEmployeeIds($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setTemplateKey($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setDataDump($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setSendEmail($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setSendSms($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setSendPush($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setEmailSentDatetime($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setEmailSentStatus($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setEmailTransId($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setSmsSentDatetime($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setSmsSentStatus($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setSmsTransId($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setPushSentDatetime($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setPushSentStatus($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setPushTransId($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setScheduleAt($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setEmailSentAttempts($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setSmsSentAttempts($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setPushSentAttempts($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setCompanyId($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setCreatedAt($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setUpdatedAt($arr[$keys[23]]);
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
        $criteria = new Criteria(NotificationsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(NotificationsTableMap::COL_NOTIFICATION_ID)) {
            $criteria->add(NotificationsTableMap::COL_NOTIFICATION_ID, $this->notification_id);
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_TO_EMPLOYEE_ID)) {
            $criteria->add(NotificationsTableMap::COL_TO_EMPLOYEE_ID, $this->to_employee_id);
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_CC_EMPLOYEE_IDS)) {
            $criteria->add(NotificationsTableMap::COL_CC_EMPLOYEE_IDS, $this->cc_employee_ids);
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_TEMPLATE_KEY)) {
            $criteria->add(NotificationsTableMap::COL_TEMPLATE_KEY, $this->template_key);
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_DATA_DUMP)) {
            $criteria->add(NotificationsTableMap::COL_DATA_DUMP, $this->data_dump);
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_SEND_EMAIL)) {
            $criteria->add(NotificationsTableMap::COL_SEND_EMAIL, $this->send_email);
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_SEND_SMS)) {
            $criteria->add(NotificationsTableMap::COL_SEND_SMS, $this->send_sms);
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_SEND_PUSH)) {
            $criteria->add(NotificationsTableMap::COL_SEND_PUSH, $this->send_push);
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_EMAIL_SENT_DATETIME)) {
            $criteria->add(NotificationsTableMap::COL_EMAIL_SENT_DATETIME, $this->email_sent_datetime);
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_EMAIL_SENT_STATUS)) {
            $criteria->add(NotificationsTableMap::COL_EMAIL_SENT_STATUS, $this->email_sent_status);
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_EMAIL_TRANS_ID)) {
            $criteria->add(NotificationsTableMap::COL_EMAIL_TRANS_ID, $this->email_trans_id);
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_SMS_SENT_DATETIME)) {
            $criteria->add(NotificationsTableMap::COL_SMS_SENT_DATETIME, $this->sms_sent_datetime);
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_SMS_SENT_STATUS)) {
            $criteria->add(NotificationsTableMap::COL_SMS_SENT_STATUS, $this->sms_sent_status);
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_SMS_TRANS_ID)) {
            $criteria->add(NotificationsTableMap::COL_SMS_TRANS_ID, $this->sms_trans_id);
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_PUSH_SENT_DATETIME)) {
            $criteria->add(NotificationsTableMap::COL_PUSH_SENT_DATETIME, $this->push_sent_datetime);
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_PUSH_SENT_STATUS)) {
            $criteria->add(NotificationsTableMap::COL_PUSH_SENT_STATUS, $this->push_sent_status);
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_PUSH_TRANS_ID)) {
            $criteria->add(NotificationsTableMap::COL_PUSH_TRANS_ID, $this->push_trans_id);
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_SCHEDULE_AT)) {
            $criteria->add(NotificationsTableMap::COL_SCHEDULE_AT, $this->schedule_at);
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_EMAIL_SENT_ATTEMPTS)) {
            $criteria->add(NotificationsTableMap::COL_EMAIL_SENT_ATTEMPTS, $this->email_sent_attempts);
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_SMS_SENT_ATTEMPTS)) {
            $criteria->add(NotificationsTableMap::COL_SMS_SENT_ATTEMPTS, $this->sms_sent_attempts);
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_PUSH_SENT_ATTEMPTS)) {
            $criteria->add(NotificationsTableMap::COL_PUSH_SENT_ATTEMPTS, $this->push_sent_attempts);
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_COMPANY_ID)) {
            $criteria->add(NotificationsTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_CREATED_AT)) {
            $criteria->add(NotificationsTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(NotificationsTableMap::COL_UPDATED_AT)) {
            $criteria->add(NotificationsTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildNotificationsQuery::create();
        $criteria->add(NotificationsTableMap::COL_NOTIFICATION_ID, $this->notification_id);

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
        $validPk = null !== $this->getNotificationId();

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
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getNotificationId();
    }

    /**
     * Generic method to set the primary key (notification_id column).
     *
     * @param string|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?string $key = null): void
    {
        $this->setNotificationId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getNotificationId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\Notifications (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setToEmployeeId($this->getToEmployeeId());
        $copyObj->setCcEmployeeIds($this->getCcEmployeeIds());
        $copyObj->setTemplateKey($this->getTemplateKey());
        $copyObj->setDataDump($this->getDataDump());
        $copyObj->setSendEmail($this->getSendEmail());
        $copyObj->setSendSms($this->getSendSms());
        $copyObj->setSendPush($this->getSendPush());
        $copyObj->setEmailSentDatetime($this->getEmailSentDatetime());
        $copyObj->setEmailSentStatus($this->getEmailSentStatus());
        $copyObj->setEmailTransId($this->getEmailTransId());
        $copyObj->setSmsSentDatetime($this->getSmsSentDatetime());
        $copyObj->setSmsSentStatus($this->getSmsSentStatus());
        $copyObj->setSmsTransId($this->getSmsTransId());
        $copyObj->setPushSentDatetime($this->getPushSentDatetime());
        $copyObj->setPushSentStatus($this->getPushSentStatus());
        $copyObj->setPushTransId($this->getPushTransId());
        $copyObj->setScheduleAt($this->getScheduleAt());
        $copyObj->setEmailSentAttempts($this->getEmailSentAttempts());
        $copyObj->setSmsSentAttempts($this->getSmsSentAttempts());
        $copyObj->setPushSentAttempts($this->getPushSentAttempts());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setNotificationId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\Notifications Clone of current object.
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
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        $this->notification_id = null;
        $this->to_employee_id = null;
        $this->cc_employee_ids = null;
        $this->template_key = null;
        $this->data_dump = null;
        $this->send_email = null;
        $this->send_sms = null;
        $this->send_push = null;
        $this->email_sent_datetime = null;
        $this->email_sent_status = null;
        $this->email_trans_id = null;
        $this->sms_sent_datetime = null;
        $this->sms_sent_status = null;
        $this->sms_trans_id = null;
        $this->push_sent_datetime = null;
        $this->push_sent_status = null;
        $this->push_trans_id = null;
        $this->schedule_at = null;
        $this->email_sent_attempts = null;
        $this->sms_sent_attempts = null;
        $this->push_sent_attempts = null;
        $this->company_id = null;
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
        } // if ($deep)

        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(NotificationsTableMap::DEFAULT_STRING_FORMAT);
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
