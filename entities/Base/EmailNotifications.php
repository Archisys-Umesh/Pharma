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
use entities\EmailNotificationsQuery as ChildEmailNotificationsQuery;
use entities\Map\EmailNotificationsTableMap;

/**
 * Base class that represents a row from the 'email_notifications' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class EmailNotifications implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\EmailNotificationsTableMap';


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
     * The value for the email_notification_id field.
     *
     * @var        int
     */
    protected $email_notification_id;

    /**
     * The value for the to_emails field.
     *
     * @var        string|null
     */
    protected $to_emails;

    /**
     * The value for the cc_emails field.
     *
     * @var        string|null
     */
    protected $cc_emails;

    /**
     * The value for the bcc_emails field.
     *
     * @var        string|null
     */
    protected $bcc_emails;

    /**
     * The value for the email_subject field.
     *
     * @var        string|null
     */
    protected $email_subject;

    /**
     * The value for the email_body field.
     *
     * @var        string|null
     */
    protected $email_body;

    /**
     * The value for the schedule_at field.
     *
     * @var        DateTime|null
     */
    protected $schedule_at;

    /**
     * The value for the email_sent_datetime field.
     *
     * @var        DateTime|null
     */
    protected $email_sent_datetime;

    /**
     * The value for the email_sent_status field.
     *
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
     * The value for the email_sent_attempts field.
     *
     * @var        int|null
     */
    protected $email_sent_attempts;

    /**
     * The value for the company_id field.
     *
     * @var        int|null
     */
    protected $company_id;

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
     * The value for the email_constants field.
     *
     * @var        string|null
     */
    protected $email_constants;

    /**
     * The value for the email_type field.
     *
     * @var        string|null
     */
    protected $email_type;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of entities\Base\EmailNotifications object.
     */
    public function __construct()
    {
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
     * Compares this with another <code>EmailNotifications</code> instance.  If
     * <code>obj</code> is an instance of <code>EmailNotifications</code>, delegates to
     * <code>equals(EmailNotifications)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [email_notification_id] column value.
     *
     * @return int
     */
    public function getEmailNotificationId()
    {
        return $this->email_notification_id;
    }

    /**
     * Get the [to_emails] column value.
     *
     * @return string|null
     */
    public function getToEmails()
    {
        return $this->to_emails;
    }

    /**
     * Get the [cc_emails] column value.
     *
     * @return string|null
     */
    public function getCcEmails()
    {
        return $this->cc_emails;
    }

    /**
     * Get the [bcc_emails] column value.
     *
     * @return string|null
     */
    public function getBccEmails()
    {
        return $this->bcc_emails;
    }

    /**
     * Get the [email_subject] column value.
     *
     * @return string|null
     */
    public function getEmailSubject()
    {
        return $this->email_subject;
    }

    /**
     * Get the [email_body] column value.
     *
     * @return string|null
     */
    public function getEmailBody()
    {
        return $this->email_body;
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
     * Get the [email_sent_attempts] column value.
     *
     * @return int|null
     */
    public function getEmailSentAttempts()
    {
        return $this->email_sent_attempts;
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
     * Get the [email_constants] column value.
     *
     * @return string|null
     */
    public function getEmailConstants()
    {
        return $this->email_constants;
    }

    /**
     * Get the [email_type] column value.
     *
     * @return string|null
     */
    public function getEmailType()
    {
        return $this->email_type;
    }

    /**
     * Set the value of [email_notification_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmailNotificationId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->email_notification_id !== $v) {
            $this->email_notification_id = $v;
            $this->modifiedColumns[EmailNotificationsTableMap::COL_EMAIL_NOTIFICATION_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [to_emails] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setToEmails($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->to_emails !== $v) {
            $this->to_emails = $v;
            $this->modifiedColumns[EmailNotificationsTableMap::COL_TO_EMAILS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [cc_emails] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCcEmails($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cc_emails !== $v) {
            $this->cc_emails = $v;
            $this->modifiedColumns[EmailNotificationsTableMap::COL_CC_EMAILS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [bcc_emails] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBccEmails($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->bcc_emails !== $v) {
            $this->bcc_emails = $v;
            $this->modifiedColumns[EmailNotificationsTableMap::COL_BCC_EMAILS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [email_subject] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmailSubject($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email_subject !== $v) {
            $this->email_subject = $v;
            $this->modifiedColumns[EmailNotificationsTableMap::COL_EMAIL_SUBJECT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [email_body] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmailBody($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email_body !== $v) {
            $this->email_body = $v;
            $this->modifiedColumns[EmailNotificationsTableMap::COL_EMAIL_BODY] = true;
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
                $this->modifiedColumns[EmailNotificationsTableMap::COL_SCHEDULE_AT] = true;
            }
        } // if either are not null

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
                $this->modifiedColumns[EmailNotificationsTableMap::COL_EMAIL_SENT_DATETIME] = true;
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
            $this->modifiedColumns[EmailNotificationsTableMap::COL_EMAIL_SENT_STATUS] = true;
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
            $this->modifiedColumns[EmailNotificationsTableMap::COL_EMAIL_TRANS_ID] = true;
        }

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
            $this->modifiedColumns[EmailNotificationsTableMap::COL_EMAIL_SENT_ATTEMPTS] = true;
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
            $this->modifiedColumns[EmailNotificationsTableMap::COL_COMPANY_ID] = true;
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
                $this->modifiedColumns[EmailNotificationsTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[EmailNotificationsTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [email_constants] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmailConstants($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email_constants !== $v) {
            $this->email_constants = $v;
            $this->modifiedColumns[EmailNotificationsTableMap::COL_EMAIL_CONSTANTS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [email_type] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmailType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email_type !== $v) {
            $this->email_type = $v;
            $this->modifiedColumns[EmailNotificationsTableMap::COL_EMAIL_TYPE] = true;
        }

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : EmailNotificationsTableMap::translateFieldName('EmailNotificationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email_notification_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : EmailNotificationsTableMap::translateFieldName('ToEmails', TableMap::TYPE_PHPNAME, $indexType)];
            $this->to_emails = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : EmailNotificationsTableMap::translateFieldName('CcEmails', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cc_emails = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : EmailNotificationsTableMap::translateFieldName('BccEmails', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bcc_emails = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : EmailNotificationsTableMap::translateFieldName('EmailSubject', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email_subject = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : EmailNotificationsTableMap::translateFieldName('EmailBody', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email_body = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : EmailNotificationsTableMap::translateFieldName('ScheduleAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->schedule_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : EmailNotificationsTableMap::translateFieldName('EmailSentDatetime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email_sent_datetime = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : EmailNotificationsTableMap::translateFieldName('EmailSentStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email_sent_status = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : EmailNotificationsTableMap::translateFieldName('EmailTransId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email_trans_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : EmailNotificationsTableMap::translateFieldName('EmailSentAttempts', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email_sent_attempts = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : EmailNotificationsTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : EmailNotificationsTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : EmailNotificationsTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : EmailNotificationsTableMap::translateFieldName('EmailConstants', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email_constants = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : EmailNotificationsTableMap::translateFieldName('EmailType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email_type = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 16; // 16 = EmailNotificationsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\EmailNotifications'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(EmailNotificationsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildEmailNotificationsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
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
     * @see EmailNotifications::setDeleted()
     * @see EmailNotifications::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmailNotificationsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildEmailNotificationsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(EmailNotificationsTableMap::DATABASE_NAME);
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
                EmailNotificationsTableMap::addInstanceToPool($this);
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

        $this->modifiedColumns[EmailNotificationsTableMap::COL_EMAIL_NOTIFICATION_ID] = true;
        if (null !== $this->email_notification_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . EmailNotificationsTableMap::COL_EMAIL_NOTIFICATION_ID . ')');
        }
        if (null === $this->email_notification_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('email_notifications_email_notification_id_seq')");
                $this->email_notification_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_EMAIL_NOTIFICATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'email_notification_id';
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_TO_EMAILS)) {
            $modifiedColumns[':p' . $index++]  = 'to_emails';
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_CC_EMAILS)) {
            $modifiedColumns[':p' . $index++]  = 'cc_emails';
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_BCC_EMAILS)) {
            $modifiedColumns[':p' . $index++]  = 'bcc_emails';
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_EMAIL_SUBJECT)) {
            $modifiedColumns[':p' . $index++]  = 'email_subject';
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_EMAIL_BODY)) {
            $modifiedColumns[':p' . $index++]  = 'email_body';
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_SCHEDULE_AT)) {
            $modifiedColumns[':p' . $index++]  = 'schedule_at';
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_EMAIL_SENT_DATETIME)) {
            $modifiedColumns[':p' . $index++]  = 'email_sent_datetime';
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_EMAIL_SENT_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'email_sent_status';
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_EMAIL_TRANS_ID)) {
            $modifiedColumns[':p' . $index++]  = 'email_trans_id';
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_EMAIL_SENT_ATTEMPTS)) {
            $modifiedColumns[':p' . $index++]  = 'email_sent_attempts';
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_EMAIL_CONSTANTS)) {
            $modifiedColumns[':p' . $index++]  = 'email_constants';
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_EMAIL_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'email_type';
        }

        $sql = sprintf(
            'INSERT INTO email_notifications (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'email_notification_id':
                        $stmt->bindValue($identifier, $this->email_notification_id, PDO::PARAM_INT);

                        break;
                    case 'to_emails':
                        $stmt->bindValue($identifier, $this->to_emails, PDO::PARAM_STR);

                        break;
                    case 'cc_emails':
                        $stmt->bindValue($identifier, $this->cc_emails, PDO::PARAM_STR);

                        break;
                    case 'bcc_emails':
                        $stmt->bindValue($identifier, $this->bcc_emails, PDO::PARAM_STR);

                        break;
                    case 'email_subject':
                        $stmt->bindValue($identifier, $this->email_subject, PDO::PARAM_STR);

                        break;
                    case 'email_body':
                        $stmt->bindValue($identifier, $this->email_body, PDO::PARAM_STR);

                        break;
                    case 'schedule_at':
                        $stmt->bindValue($identifier, $this->schedule_at ? $this->schedule_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

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
                    case 'email_sent_attempts':
                        $stmt->bindValue($identifier, $this->email_sent_attempts, PDO::PARAM_INT);

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
                    case 'email_constants':
                        $stmt->bindValue($identifier, $this->email_constants, PDO::PARAM_STR);

                        break;
                    case 'email_type':
                        $stmt->bindValue($identifier, $this->email_type, PDO::PARAM_STR);

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
        $pos = EmailNotificationsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getEmailNotificationId();

            case 1:
                return $this->getToEmails();

            case 2:
                return $this->getCcEmails();

            case 3:
                return $this->getBccEmails();

            case 4:
                return $this->getEmailSubject();

            case 5:
                return $this->getEmailBody();

            case 6:
                return $this->getScheduleAt();

            case 7:
                return $this->getEmailSentDatetime();

            case 8:
                return $this->getEmailSentStatus();

            case 9:
                return $this->getEmailTransId();

            case 10:
                return $this->getEmailSentAttempts();

            case 11:
                return $this->getCompanyId();

            case 12:
                return $this->getCreatedAt();

            case 13:
                return $this->getUpdatedAt();

            case 14:
                return $this->getEmailConstants();

            case 15:
                return $this->getEmailType();

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
        if (isset($alreadyDumpedObjects['EmailNotifications'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['EmailNotifications'][$this->hashCode()] = true;
        $keys = EmailNotificationsTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getEmailNotificationId(),
            $keys[1] => $this->getToEmails(),
            $keys[2] => $this->getCcEmails(),
            $keys[3] => $this->getBccEmails(),
            $keys[4] => $this->getEmailSubject(),
            $keys[5] => $this->getEmailBody(),
            $keys[6] => $this->getScheduleAt(),
            $keys[7] => $this->getEmailSentDatetime(),
            $keys[8] => $this->getEmailSentStatus(),
            $keys[9] => $this->getEmailTransId(),
            $keys[10] => $this->getEmailSentAttempts(),
            $keys[11] => $this->getCompanyId(),
            $keys[12] => $this->getCreatedAt(),
            $keys[13] => $this->getUpdatedAt(),
            $keys[14] => $this->getEmailConstants(),
            $keys[15] => $this->getEmailType(),
        ];
        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[12]] instanceof \DateTimeInterface) {
            $result[$keys[12]] = $result[$keys[12]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[13]] instanceof \DateTimeInterface) {
            $result[$keys[13]] = $result[$keys[13]]->format('Y-m-d H:i:s.u');
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
        $pos = EmailNotificationsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setEmailNotificationId($value);
                break;
            case 1:
                $this->setToEmails($value);
                break;
            case 2:
                $this->setCcEmails($value);
                break;
            case 3:
                $this->setBccEmails($value);
                break;
            case 4:
                $this->setEmailSubject($value);
                break;
            case 5:
                $this->setEmailBody($value);
                break;
            case 6:
                $this->setScheduleAt($value);
                break;
            case 7:
                $this->setEmailSentDatetime($value);
                break;
            case 8:
                $this->setEmailSentStatus($value);
                break;
            case 9:
                $this->setEmailTransId($value);
                break;
            case 10:
                $this->setEmailSentAttempts($value);
                break;
            case 11:
                $this->setCompanyId($value);
                break;
            case 12:
                $this->setCreatedAt($value);
                break;
            case 13:
                $this->setUpdatedAt($value);
                break;
            case 14:
                $this->setEmailConstants($value);
                break;
            case 15:
                $this->setEmailType($value);
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
        $keys = EmailNotificationsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setEmailNotificationId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setToEmails($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setCcEmails($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setBccEmails($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setEmailSubject($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setEmailBody($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setScheduleAt($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setEmailSentDatetime($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setEmailSentStatus($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setEmailTransId($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setEmailSentAttempts($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setCompanyId($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setCreatedAt($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setUpdatedAt($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setEmailConstants($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setEmailType($arr[$keys[15]]);
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
        $criteria = new Criteria(EmailNotificationsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(EmailNotificationsTableMap::COL_EMAIL_NOTIFICATION_ID)) {
            $criteria->add(EmailNotificationsTableMap::COL_EMAIL_NOTIFICATION_ID, $this->email_notification_id);
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_TO_EMAILS)) {
            $criteria->add(EmailNotificationsTableMap::COL_TO_EMAILS, $this->to_emails);
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_CC_EMAILS)) {
            $criteria->add(EmailNotificationsTableMap::COL_CC_EMAILS, $this->cc_emails);
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_BCC_EMAILS)) {
            $criteria->add(EmailNotificationsTableMap::COL_BCC_EMAILS, $this->bcc_emails);
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_EMAIL_SUBJECT)) {
            $criteria->add(EmailNotificationsTableMap::COL_EMAIL_SUBJECT, $this->email_subject);
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_EMAIL_BODY)) {
            $criteria->add(EmailNotificationsTableMap::COL_EMAIL_BODY, $this->email_body);
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_SCHEDULE_AT)) {
            $criteria->add(EmailNotificationsTableMap::COL_SCHEDULE_AT, $this->schedule_at);
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_EMAIL_SENT_DATETIME)) {
            $criteria->add(EmailNotificationsTableMap::COL_EMAIL_SENT_DATETIME, $this->email_sent_datetime);
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_EMAIL_SENT_STATUS)) {
            $criteria->add(EmailNotificationsTableMap::COL_EMAIL_SENT_STATUS, $this->email_sent_status);
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_EMAIL_TRANS_ID)) {
            $criteria->add(EmailNotificationsTableMap::COL_EMAIL_TRANS_ID, $this->email_trans_id);
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_EMAIL_SENT_ATTEMPTS)) {
            $criteria->add(EmailNotificationsTableMap::COL_EMAIL_SENT_ATTEMPTS, $this->email_sent_attempts);
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_COMPANY_ID)) {
            $criteria->add(EmailNotificationsTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_CREATED_AT)) {
            $criteria->add(EmailNotificationsTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_UPDATED_AT)) {
            $criteria->add(EmailNotificationsTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_EMAIL_CONSTANTS)) {
            $criteria->add(EmailNotificationsTableMap::COL_EMAIL_CONSTANTS, $this->email_constants);
        }
        if ($this->isColumnModified(EmailNotificationsTableMap::COL_EMAIL_TYPE)) {
            $criteria->add(EmailNotificationsTableMap::COL_EMAIL_TYPE, $this->email_type);
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
        $criteria = ChildEmailNotificationsQuery::create();
        $criteria->add(EmailNotificationsTableMap::COL_EMAIL_NOTIFICATION_ID, $this->email_notification_id);

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
        $validPk = null !== $this->getEmailNotificationId();

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
        return $this->getEmailNotificationId();
    }

    /**
     * Generic method to set the primary key (email_notification_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setEmailNotificationId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getEmailNotificationId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\EmailNotifications (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setToEmails($this->getToEmails());
        $copyObj->setCcEmails($this->getCcEmails());
        $copyObj->setBccEmails($this->getBccEmails());
        $copyObj->setEmailSubject($this->getEmailSubject());
        $copyObj->setEmailBody($this->getEmailBody());
        $copyObj->setScheduleAt($this->getScheduleAt());
        $copyObj->setEmailSentDatetime($this->getEmailSentDatetime());
        $copyObj->setEmailSentStatus($this->getEmailSentStatus());
        $copyObj->setEmailTransId($this->getEmailTransId());
        $copyObj->setEmailSentAttempts($this->getEmailSentAttempts());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setEmailConstants($this->getEmailConstants());
        $copyObj->setEmailType($this->getEmailType());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setEmailNotificationId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\EmailNotifications Clone of current object.
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
        $this->email_notification_id = null;
        $this->to_emails = null;
        $this->cc_emails = null;
        $this->bcc_emails = null;
        $this->email_subject = null;
        $this->email_body = null;
        $this->schedule_at = null;
        $this->email_sent_datetime = null;
        $this->email_sent_status = null;
        $this->email_trans_id = null;
        $this->email_sent_attempts = null;
        $this->company_id = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->email_constants = null;
        $this->email_type = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
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
        return (string) $this->exportTo(EmailNotificationsTableMap::DEFAULT_STRING_FORMAT);
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
