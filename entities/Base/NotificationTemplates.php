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
use entities\NotificationTemplatesQuery as ChildNotificationTemplatesQuery;
use entities\Map\NotificationTemplatesTableMap;

/**
 * Base class that represents a row from the 'notification_templates' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class NotificationTemplates implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\NotificationTemplatesTableMap';


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
     * The value for the template_id field.
     *
     * @var        int
     */
    protected $template_id;

    /**
     * The value for the template_key field.
     *
     * @var        string
     */
    protected $template_key;

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
     * The value for the sms_message field.
     *
     * @var        string|null
     */
    protected $sms_message;

    /**
     * The value for the sms_template_id field.
     *
     * @var        string|null
     */
    protected $sms_template_id;

    /**
     * The value for the sms_type field.
     *
     * @var        string|null
     */
    protected $sms_type;

    /**
     * The value for the sms_dlr field.
     *
     * @var        string|null
     */
    protected $sms_dlr;

    /**
     * The value for the push_title field.
     *
     * @var        string|null
     */
    protected $push_title;

    /**
     * The value for the push_message field.
     *
     * @var        string|null
     */
    protected $push_message;

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
    }

    /**
     * Initializes internal state of entities\Base\NotificationTemplates object.
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
     * Compares this with another <code>NotificationTemplates</code> instance.  If
     * <code>obj</code> is an instance of <code>NotificationTemplates</code>, delegates to
     * <code>equals(NotificationTemplates)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [template_id] column value.
     *
     * @return int
     */
    public function getTemplateId()
    {
        return $this->template_id;
    }

    /**
     * Get the [template_key] column value.
     *
     * @return string
     */
    public function getTemplateKey()
    {
        return $this->template_key;
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
     * Get the [sms_message] column value.
     *
     * @return string|null
     */
    public function getSmsMessage()
    {
        return $this->sms_message;
    }

    /**
     * Get the [sms_template_id] column value.
     *
     * @return string|null
     */
    public function getSmsTemplateId()
    {
        return $this->sms_template_id;
    }

    /**
     * Get the [sms_type] column value.
     *
     * @return string|null
     */
    public function getSmsType()
    {
        return $this->sms_type;
    }

    /**
     * Get the [sms_dlr] column value.
     *
     * @return string|null
     */
    public function getSmsDlr()
    {
        return $this->sms_dlr;
    }

    /**
     * Get the [push_title] column value.
     *
     * @return string|null
     */
    public function getPushTitle()
    {
        return $this->push_title;
    }

    /**
     * Get the [push_message] column value.
     *
     * @return string|null
     */
    public function getPushMessage()
    {
        return $this->push_message;
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
     * Set the value of [template_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTemplateId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->template_id !== $v) {
            $this->template_id = $v;
            $this->modifiedColumns[NotificationTemplatesTableMap::COL_TEMPLATE_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [template_key] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTemplateKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->template_key !== $v) {
            $this->template_key = $v;
            $this->modifiedColumns[NotificationTemplatesTableMap::COL_TEMPLATE_KEY] = true;
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
            $this->modifiedColumns[NotificationTemplatesTableMap::COL_EMAIL_SUBJECT] = true;
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
            $this->modifiedColumns[NotificationTemplatesTableMap::COL_EMAIL_BODY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sms_message] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSmsMessage($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sms_message !== $v) {
            $this->sms_message = $v;
            $this->modifiedColumns[NotificationTemplatesTableMap::COL_SMS_MESSAGE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sms_template_id] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSmsTemplateId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sms_template_id !== $v) {
            $this->sms_template_id = $v;
            $this->modifiedColumns[NotificationTemplatesTableMap::COL_SMS_TEMPLATE_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sms_type] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSmsType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sms_type !== $v) {
            $this->sms_type = $v;
            $this->modifiedColumns[NotificationTemplatesTableMap::COL_SMS_TYPE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sms_dlr] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSmsDlr($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sms_dlr !== $v) {
            $this->sms_dlr = $v;
            $this->modifiedColumns[NotificationTemplatesTableMap::COL_SMS_DLR] = true;
        }

        return $this;
    }

    /**
     * Set the value of [push_title] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPushTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->push_title !== $v) {
            $this->push_title = $v;
            $this->modifiedColumns[NotificationTemplatesTableMap::COL_PUSH_TITLE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [push_message] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPushMessage($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->push_message !== $v) {
            $this->push_message = $v;
            $this->modifiedColumns[NotificationTemplatesTableMap::COL_PUSH_MESSAGE] = true;
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
            $this->modifiedColumns[NotificationTemplatesTableMap::COL_COMPANY_ID] = true;
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
                $this->modifiedColumns[NotificationTemplatesTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[NotificationTemplatesTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : NotificationTemplatesTableMap::translateFieldName('TemplateId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->template_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : NotificationTemplatesTableMap::translateFieldName('TemplateKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->template_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : NotificationTemplatesTableMap::translateFieldName('EmailSubject', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email_subject = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : NotificationTemplatesTableMap::translateFieldName('EmailBody', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email_body = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : NotificationTemplatesTableMap::translateFieldName('SmsMessage', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sms_message = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : NotificationTemplatesTableMap::translateFieldName('SmsTemplateId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sms_template_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : NotificationTemplatesTableMap::translateFieldName('SmsType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sms_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : NotificationTemplatesTableMap::translateFieldName('SmsDlr', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sms_dlr = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : NotificationTemplatesTableMap::translateFieldName('PushTitle', TableMap::TYPE_PHPNAME, $indexType)];
            $this->push_title = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : NotificationTemplatesTableMap::translateFieldName('PushMessage', TableMap::TYPE_PHPNAME, $indexType)];
            $this->push_message = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : NotificationTemplatesTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : NotificationTemplatesTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : NotificationTemplatesTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 13; // 13 = NotificationTemplatesTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\NotificationTemplates'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(NotificationTemplatesTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildNotificationTemplatesQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
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
     * @see NotificationTemplates::setDeleted()
     * @see NotificationTemplates::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(NotificationTemplatesTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildNotificationTemplatesQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(NotificationTemplatesTableMap::DATABASE_NAME);
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
                NotificationTemplatesTableMap::addInstanceToPool($this);
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

        $this->modifiedColumns[NotificationTemplatesTableMap::COL_TEMPLATE_ID] = true;
        if (null !== $this->template_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . NotificationTemplatesTableMap::COL_TEMPLATE_ID . ')');
        }
        if (null === $this->template_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('notification_templates_template_id_seq')");
                $this->template_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(NotificationTemplatesTableMap::COL_TEMPLATE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'template_id';
        }
        if ($this->isColumnModified(NotificationTemplatesTableMap::COL_TEMPLATE_KEY)) {
            $modifiedColumns[':p' . $index++]  = 'template_key';
        }
        if ($this->isColumnModified(NotificationTemplatesTableMap::COL_EMAIL_SUBJECT)) {
            $modifiedColumns[':p' . $index++]  = 'email_subject';
        }
        if ($this->isColumnModified(NotificationTemplatesTableMap::COL_EMAIL_BODY)) {
            $modifiedColumns[':p' . $index++]  = 'email_body';
        }
        if ($this->isColumnModified(NotificationTemplatesTableMap::COL_SMS_MESSAGE)) {
            $modifiedColumns[':p' . $index++]  = 'sms_message';
        }
        if ($this->isColumnModified(NotificationTemplatesTableMap::COL_SMS_TEMPLATE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'sms_template_id';
        }
        if ($this->isColumnModified(NotificationTemplatesTableMap::COL_SMS_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'sms_type';
        }
        if ($this->isColumnModified(NotificationTemplatesTableMap::COL_SMS_DLR)) {
            $modifiedColumns[':p' . $index++]  = 'sms_dlr';
        }
        if ($this->isColumnModified(NotificationTemplatesTableMap::COL_PUSH_TITLE)) {
            $modifiedColumns[':p' . $index++]  = 'push_title';
        }
        if ($this->isColumnModified(NotificationTemplatesTableMap::COL_PUSH_MESSAGE)) {
            $modifiedColumns[':p' . $index++]  = 'push_message';
        }
        if ($this->isColumnModified(NotificationTemplatesTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(NotificationTemplatesTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(NotificationTemplatesTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO notification_templates (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'template_id':
                        $stmt->bindValue($identifier, $this->template_id, PDO::PARAM_INT);

                        break;
                    case 'template_key':
                        $stmt->bindValue($identifier, $this->template_key, PDO::PARAM_STR);

                        break;
                    case 'email_subject':
                        $stmt->bindValue($identifier, $this->email_subject, PDO::PARAM_STR);

                        break;
                    case 'email_body':
                        $stmt->bindValue($identifier, $this->email_body, PDO::PARAM_STR);

                        break;
                    case 'sms_message':
                        $stmt->bindValue($identifier, $this->sms_message, PDO::PARAM_STR);

                        break;
                    case 'sms_template_id':
                        $stmt->bindValue($identifier, $this->sms_template_id, PDO::PARAM_STR);

                        break;
                    case 'sms_type':
                        $stmt->bindValue($identifier, $this->sms_type, PDO::PARAM_STR);

                        break;
                    case 'sms_dlr':
                        $stmt->bindValue($identifier, $this->sms_dlr, PDO::PARAM_STR);

                        break;
                    case 'push_title':
                        $stmt->bindValue($identifier, $this->push_title, PDO::PARAM_STR);

                        break;
                    case 'push_message':
                        $stmt->bindValue($identifier, $this->push_message, PDO::PARAM_STR);

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
        $pos = NotificationTemplatesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getTemplateId();

            case 1:
                return $this->getTemplateKey();

            case 2:
                return $this->getEmailSubject();

            case 3:
                return $this->getEmailBody();

            case 4:
                return $this->getSmsMessage();

            case 5:
                return $this->getSmsTemplateId();

            case 6:
                return $this->getSmsType();

            case 7:
                return $this->getSmsDlr();

            case 8:
                return $this->getPushTitle();

            case 9:
                return $this->getPushMessage();

            case 10:
                return $this->getCompanyId();

            case 11:
                return $this->getCreatedAt();

            case 12:
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
        if (isset($alreadyDumpedObjects['NotificationTemplates'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['NotificationTemplates'][$this->hashCode()] = true;
        $keys = NotificationTemplatesTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getTemplateId(),
            $keys[1] => $this->getTemplateKey(),
            $keys[2] => $this->getEmailSubject(),
            $keys[3] => $this->getEmailBody(),
            $keys[4] => $this->getSmsMessage(),
            $keys[5] => $this->getSmsTemplateId(),
            $keys[6] => $this->getSmsType(),
            $keys[7] => $this->getSmsDlr(),
            $keys[8] => $this->getPushTitle(),
            $keys[9] => $this->getPushMessage(),
            $keys[10] => $this->getCompanyId(),
            $keys[11] => $this->getCreatedAt(),
            $keys[12] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[11]] instanceof \DateTimeInterface) {
            $result[$keys[11]] = $result[$keys[11]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[12]] instanceof \DateTimeInterface) {
            $result[$keys[12]] = $result[$keys[12]]->format('Y-m-d H:i:s.u');
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
        $pos = NotificationTemplatesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setTemplateId($value);
                break;
            case 1:
                $this->setTemplateKey($value);
                break;
            case 2:
                $this->setEmailSubject($value);
                break;
            case 3:
                $this->setEmailBody($value);
                break;
            case 4:
                $this->setSmsMessage($value);
                break;
            case 5:
                $this->setSmsTemplateId($value);
                break;
            case 6:
                $this->setSmsType($value);
                break;
            case 7:
                $this->setSmsDlr($value);
                break;
            case 8:
                $this->setPushTitle($value);
                break;
            case 9:
                $this->setPushMessage($value);
                break;
            case 10:
                $this->setCompanyId($value);
                break;
            case 11:
                $this->setCreatedAt($value);
                break;
            case 12:
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
        $keys = NotificationTemplatesTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setTemplateId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setTemplateKey($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setEmailSubject($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setEmailBody($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setSmsMessage($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setSmsTemplateId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setSmsType($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setSmsDlr($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setPushTitle($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setPushMessage($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setCompanyId($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setCreatedAt($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setUpdatedAt($arr[$keys[12]]);
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
        $criteria = new Criteria(NotificationTemplatesTableMap::DATABASE_NAME);

        if ($this->isColumnModified(NotificationTemplatesTableMap::COL_TEMPLATE_ID)) {
            $criteria->add(NotificationTemplatesTableMap::COL_TEMPLATE_ID, $this->template_id);
        }
        if ($this->isColumnModified(NotificationTemplatesTableMap::COL_TEMPLATE_KEY)) {
            $criteria->add(NotificationTemplatesTableMap::COL_TEMPLATE_KEY, $this->template_key);
        }
        if ($this->isColumnModified(NotificationTemplatesTableMap::COL_EMAIL_SUBJECT)) {
            $criteria->add(NotificationTemplatesTableMap::COL_EMAIL_SUBJECT, $this->email_subject);
        }
        if ($this->isColumnModified(NotificationTemplatesTableMap::COL_EMAIL_BODY)) {
            $criteria->add(NotificationTemplatesTableMap::COL_EMAIL_BODY, $this->email_body);
        }
        if ($this->isColumnModified(NotificationTemplatesTableMap::COL_SMS_MESSAGE)) {
            $criteria->add(NotificationTemplatesTableMap::COL_SMS_MESSAGE, $this->sms_message);
        }
        if ($this->isColumnModified(NotificationTemplatesTableMap::COL_SMS_TEMPLATE_ID)) {
            $criteria->add(NotificationTemplatesTableMap::COL_SMS_TEMPLATE_ID, $this->sms_template_id);
        }
        if ($this->isColumnModified(NotificationTemplatesTableMap::COL_SMS_TYPE)) {
            $criteria->add(NotificationTemplatesTableMap::COL_SMS_TYPE, $this->sms_type);
        }
        if ($this->isColumnModified(NotificationTemplatesTableMap::COL_SMS_DLR)) {
            $criteria->add(NotificationTemplatesTableMap::COL_SMS_DLR, $this->sms_dlr);
        }
        if ($this->isColumnModified(NotificationTemplatesTableMap::COL_PUSH_TITLE)) {
            $criteria->add(NotificationTemplatesTableMap::COL_PUSH_TITLE, $this->push_title);
        }
        if ($this->isColumnModified(NotificationTemplatesTableMap::COL_PUSH_MESSAGE)) {
            $criteria->add(NotificationTemplatesTableMap::COL_PUSH_MESSAGE, $this->push_message);
        }
        if ($this->isColumnModified(NotificationTemplatesTableMap::COL_COMPANY_ID)) {
            $criteria->add(NotificationTemplatesTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(NotificationTemplatesTableMap::COL_CREATED_AT)) {
            $criteria->add(NotificationTemplatesTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(NotificationTemplatesTableMap::COL_UPDATED_AT)) {
            $criteria->add(NotificationTemplatesTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildNotificationTemplatesQuery::create();
        $criteria->add(NotificationTemplatesTableMap::COL_TEMPLATE_ID, $this->template_id);

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
        $validPk = null !== $this->getTemplateId();

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
        return $this->getTemplateId();
    }

    /**
     * Generic method to set the primary key (template_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setTemplateId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getTemplateId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\NotificationTemplates (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setTemplateKey($this->getTemplateKey());
        $copyObj->setEmailSubject($this->getEmailSubject());
        $copyObj->setEmailBody($this->getEmailBody());
        $copyObj->setSmsMessage($this->getSmsMessage());
        $copyObj->setSmsTemplateId($this->getSmsTemplateId());
        $copyObj->setSmsType($this->getSmsType());
        $copyObj->setSmsDlr($this->getSmsDlr());
        $copyObj->setPushTitle($this->getPushTitle());
        $copyObj->setPushMessage($this->getPushMessage());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setTemplateId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\NotificationTemplates Clone of current object.
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
        $this->template_id = null;
        $this->template_key = null;
        $this->email_subject = null;
        $this->email_body = null;
        $this->sms_message = null;
        $this->sms_template_id = null;
        $this->sms_type = null;
        $this->sms_dlr = null;
        $this->push_title = null;
        $this->push_message = null;
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
        return (string) $this->exportTo(NotificationTemplatesTableMap::DEFAULT_STRING_FORMAT);
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
