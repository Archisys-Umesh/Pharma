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
use entities\DataChangeRequestsQuery as ChildDataChangeRequestsQuery;
use entities\Map\DataChangeRequestsTableMap;

/**
 * Base class that represents a row from the 'data_change_requests' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class DataChangeRequests implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\DataChangeRequestsTableMap';


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
     * The value for the data_change_request_id field.
     *
     * @var        int
     */
    protected $data_change_request_id;

    /**
     * The value for the import_template field.
     *
     * @var        string|null
     */
    protected $import_template;

    /**
     * The value for the import_file_path field.
     *
     * @var        string|null
     */
    protected $import_file_path;

    /**
     * The value for the requested_data field.
     *
     * @var        string
     */
    protected $requested_data;

    /**
     * The value for the action_type field.
     *
     * @var        string
     */
    protected $action_type;

    /**
     * The value for the schedule_date field.
     *
     * @var        DateTime
     */
    protected $schedule_date;

    /**
     * The value for the status field.
     *
     * @var        string|null
     */
    protected $status;

    /**
     * The value for the has_error field.
     *
     * @var        boolean|null
     */
    protected $has_error;

    /**
     * The value for the error_message field.
     *
     * @var        string|null
     */
    protected $error_message;

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
     * The value for the import_file_log_id field.
     *
     * @var        int|null
     */
    protected $import_file_log_id;

    /**
     * The value for the success_ids field.
     *
     * @var        string|null
     */
    protected $success_ids;

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
     * Initializes internal state of entities\Base\DataChangeRequests object.
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
     * Compares this with another <code>DataChangeRequests</code> instance.  If
     * <code>obj</code> is an instance of <code>DataChangeRequests</code>, delegates to
     * <code>equals(DataChangeRequests)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [data_change_request_id] column value.
     *
     * @return int
     */
    public function getDataChangeRequestId()
    {
        return $this->data_change_request_id;
    }

    /**
     * Get the [import_template] column value.
     *
     * @return string|null
     */
    public function getImportTemplate()
    {
        return $this->import_template;
    }

    /**
     * Get the [import_file_path] column value.
     *
     * @return string|null
     */
    public function getImportFilePath()
    {
        return $this->import_file_path;
    }

    /**
     * Get the [requested_data] column value.
     *
     * @param bool $asArray Returns the JSON data as array instead of object

     * @return object|array
     */
    public function getRequestedData($asArray = true)
    {
        return json_decode($this->requested_data, $asArray);
    }

    /**
     * Get the [action_type] column value.
     *
     * @return string
     */
    public function getActionType()
    {
        return $this->action_type;
    }

    /**
     * Get the [optionally formatted] temporal [schedule_date] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL).
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime : string)
     */
    public function getScheduleDate($format = null)
    {
        if ($format === null) {
            return $this->schedule_date;
        } else {
            return $this->schedule_date instanceof \DateTimeInterface ? $this->schedule_date->format($format) : null;
        }
    }

    /**
     * Get the [status] column value.
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [has_error] column value.
     *
     * @return boolean|null
     */
    public function getHasError()
    {
        return $this->has_error;
    }

    /**
     * Get the [has_error] column value.
     *
     * @return boolean|null
     */
    public function hasError()
    {
        return $this->getHasError();
    }

    /**
     * Get the [error_message] column value.
     *
     * @return string|null
     */
    public function getErrorMessage()
    {
        return $this->error_message;
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
     * Get the [import_file_log_id] column value.
     *
     * @return int|null
     */
    public function getImportFileLogId()
    {
        return $this->import_file_log_id;
    }

    /**
     * Get the [success_ids] column value.
     *
     * @param bool $asArray Returns the JSON data as array instead of object

     * @return object|array|null
     */
    public function getSuccessIds($asArray = true)
    {
        return json_decode($this->success_ids, $asArray);
    }

    /**
     * Set the value of [data_change_request_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDataChangeRequestId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->data_change_request_id !== $v) {
            $this->data_change_request_id = $v;
            $this->modifiedColumns[DataChangeRequestsTableMap::COL_DATA_CHANGE_REQUEST_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [import_template] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setImportTemplate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->import_template !== $v) {
            $this->import_template = $v;
            $this->modifiedColumns[DataChangeRequestsTableMap::COL_IMPORT_TEMPLATE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [import_file_path] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setImportFilePath($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->import_file_path !== $v) {
            $this->import_file_path = $v;
            $this->modifiedColumns[DataChangeRequestsTableMap::COL_IMPORT_FILE_PATH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [requested_data] column.
     *
     * @param string|array|object $v new value
     * @return $this The current object (for fluent API support)
     */
    public function setRequestedData($v)
    {
        if (is_string($v)) {
            // JSON as string needs to be decoded/encoded to get a reliable comparison (spaces, ...)
            $v = json_decode($v);
        }
        $encodedValue = json_encode($v);
        if ($encodedValue !== $this->requested_data) {
            $this->requested_data = $encodedValue;
            $this->modifiedColumns[DataChangeRequestsTableMap::COL_REQUESTED_DATA] = true;
        }

        return $this;
    }

    /**
     * Set the value of [action_type] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setActionType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->action_type !== $v) {
            $this->action_type = $v;
            $this->modifiedColumns[DataChangeRequestsTableMap::COL_ACTION_TYPE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [schedule_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setScheduleDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->schedule_date !== null || $dt !== null) {
            if ($this->schedule_date === null || $dt === null || $dt->format("Y-m-d") !== $this->schedule_date->format("Y-m-d")) {
                $this->schedule_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DataChangeRequestsTableMap::COL_SCHEDULE_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [status] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[DataChangeRequestsTableMap::COL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [has_error] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setHasError($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->has_error !== $v) {
            $this->has_error = $v;
            $this->modifiedColumns[DataChangeRequestsTableMap::COL_HAS_ERROR] = true;
        }

        return $this;
    }

    /**
     * Set the value of [error_message] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setErrorMessage($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->error_message !== $v) {
            $this->error_message = $v;
            $this->modifiedColumns[DataChangeRequestsTableMap::COL_ERROR_MESSAGE] = true;
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
                $this->modifiedColumns[DataChangeRequestsTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[DataChangeRequestsTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [import_file_log_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setImportFileLogId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->import_file_log_id !== $v) {
            $this->import_file_log_id = $v;
            $this->modifiedColumns[DataChangeRequestsTableMap::COL_IMPORT_FILE_LOG_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [success_ids] column.
     *
     * @param string|array|object|null $v new value
     * @return $this The current object (for fluent API support)
     */
    public function setSuccessIds($v)
    {
        if (is_string($v)) {
            // JSON as string needs to be decoded/encoded to get a reliable comparison (spaces, ...)
            $v = json_decode($v);
        }
        $encodedValue = json_encode($v);
        if ($encodedValue !== $this->success_ids) {
            $this->success_ids = $encodedValue;
            $this->modifiedColumns[DataChangeRequestsTableMap::COL_SUCCESS_IDS] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : DataChangeRequestsTableMap::translateFieldName('DataChangeRequestId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->data_change_request_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : DataChangeRequestsTableMap::translateFieldName('ImportTemplate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->import_template = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : DataChangeRequestsTableMap::translateFieldName('ImportFilePath', TableMap::TYPE_PHPNAME, $indexType)];
            $this->import_file_path = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : DataChangeRequestsTableMap::translateFieldName('RequestedData', TableMap::TYPE_PHPNAME, $indexType)];
            $this->requested_data = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : DataChangeRequestsTableMap::translateFieldName('ActionType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->action_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : DataChangeRequestsTableMap::translateFieldName('ScheduleDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->schedule_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : DataChangeRequestsTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : DataChangeRequestsTableMap::translateFieldName('HasError', TableMap::TYPE_PHPNAME, $indexType)];
            $this->has_error = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : DataChangeRequestsTableMap::translateFieldName('ErrorMessage', TableMap::TYPE_PHPNAME, $indexType)];
            $this->error_message = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : DataChangeRequestsTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : DataChangeRequestsTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : DataChangeRequestsTableMap::translateFieldName('ImportFileLogId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->import_file_log_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : DataChangeRequestsTableMap::translateFieldName('SuccessIds', TableMap::TYPE_PHPNAME, $indexType)];
            $this->success_ids = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 13; // 13 = DataChangeRequestsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\DataChangeRequests'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(DataChangeRequestsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildDataChangeRequestsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
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
     * @see DataChangeRequests::setDeleted()
     * @see DataChangeRequests::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(DataChangeRequestsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildDataChangeRequestsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(DataChangeRequestsTableMap::DATABASE_NAME);
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
                DataChangeRequestsTableMap::addInstanceToPool($this);
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

        $this->modifiedColumns[DataChangeRequestsTableMap::COL_DATA_CHANGE_REQUEST_ID] = true;
        if (null !== $this->data_change_request_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . DataChangeRequestsTableMap::COL_DATA_CHANGE_REQUEST_ID . ')');
        }
        if (null === $this->data_change_request_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('data_change_requests_data_change_request_id_seq')");
                $this->data_change_request_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(DataChangeRequestsTableMap::COL_DATA_CHANGE_REQUEST_ID)) {
            $modifiedColumns[':p' . $index++]  = 'data_change_request_id';
        }
        if ($this->isColumnModified(DataChangeRequestsTableMap::COL_IMPORT_TEMPLATE)) {
            $modifiedColumns[':p' . $index++]  = 'import_template';
        }
        if ($this->isColumnModified(DataChangeRequestsTableMap::COL_IMPORT_FILE_PATH)) {
            $modifiedColumns[':p' . $index++]  = 'import_file_path';
        }
        if ($this->isColumnModified(DataChangeRequestsTableMap::COL_REQUESTED_DATA)) {
            $modifiedColumns[':p' . $index++]  = 'requested_data';
        }
        if ($this->isColumnModified(DataChangeRequestsTableMap::COL_ACTION_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'action_type';
        }
        if ($this->isColumnModified(DataChangeRequestsTableMap::COL_SCHEDULE_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'schedule_date';
        }
        if ($this->isColumnModified(DataChangeRequestsTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(DataChangeRequestsTableMap::COL_HAS_ERROR)) {
            $modifiedColumns[':p' . $index++]  = 'has_error';
        }
        if ($this->isColumnModified(DataChangeRequestsTableMap::COL_ERROR_MESSAGE)) {
            $modifiedColumns[':p' . $index++]  = 'error_message';
        }
        if ($this->isColumnModified(DataChangeRequestsTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(DataChangeRequestsTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(DataChangeRequestsTableMap::COL_IMPORT_FILE_LOG_ID)) {
            $modifiedColumns[':p' . $index++]  = 'import_file_log_id';
        }
        if ($this->isColumnModified(DataChangeRequestsTableMap::COL_SUCCESS_IDS)) {
            $modifiedColumns[':p' . $index++]  = 'success_ids';
        }

        $sql = sprintf(
            'INSERT INTO data_change_requests (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'data_change_request_id':
                        $stmt->bindValue($identifier, $this->data_change_request_id, PDO::PARAM_INT);

                        break;
                    case 'import_template':
                        $stmt->bindValue($identifier, $this->import_template, PDO::PARAM_STR);

                        break;
                    case 'import_file_path':
                        $stmt->bindValue($identifier, $this->import_file_path, PDO::PARAM_STR);

                        break;
                    case 'requested_data':
                        $stmt->bindValue($identifier, $this->requested_data, PDO::PARAM_STR);

                        break;
                    case 'action_type':
                        $stmt->bindValue($identifier, $this->action_type, PDO::PARAM_STR);

                        break;
                    case 'schedule_date':
                        $stmt->bindValue($identifier, $this->schedule_date ? $this->schedule_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);

                        break;
                    case 'has_error':
                        $stmt->bindValue($identifier, $this->has_error, PDO::PARAM_BOOL);

                        break;
                    case 'error_message':
                        $stmt->bindValue($identifier, $this->error_message, PDO::PARAM_STR);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'import_file_log_id':
                        $stmt->bindValue($identifier, $this->import_file_log_id, PDO::PARAM_INT);

                        break;
                    case 'success_ids':
                        $stmt->bindValue($identifier, $this->success_ids, PDO::PARAM_STR);

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
        $pos = DataChangeRequestsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getDataChangeRequestId();

            case 1:
                return $this->getImportTemplate();

            case 2:
                return $this->getImportFilePath();

            case 3:
                return $this->getRequestedData();

            case 4:
                return $this->getActionType();

            case 5:
                return $this->getScheduleDate();

            case 6:
                return $this->getStatus();

            case 7:
                return $this->getHasError();

            case 8:
                return $this->getErrorMessage();

            case 9:
                return $this->getCreatedAt();

            case 10:
                return $this->getUpdatedAt();

            case 11:
                return $this->getImportFileLogId();

            case 12:
                return $this->getSuccessIds();

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
        if (isset($alreadyDumpedObjects['DataChangeRequests'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['DataChangeRequests'][$this->hashCode()] = true;
        $keys = DataChangeRequestsTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getDataChangeRequestId(),
            $keys[1] => $this->getImportTemplate(),
            $keys[2] => $this->getImportFilePath(),
            $keys[3] => $this->getRequestedData(),
            $keys[4] => $this->getActionType(),
            $keys[5] => $this->getScheduleDate(),
            $keys[6] => $this->getStatus(),
            $keys[7] => $this->getHasError(),
            $keys[8] => $this->getErrorMessage(),
            $keys[9] => $this->getCreatedAt(),
            $keys[10] => $this->getUpdatedAt(),
            $keys[11] => $this->getImportFileLogId(),
            $keys[12] => $this->getSuccessIds(),
        ];
        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('Y-m-d');
        }

        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[10]] instanceof \DateTimeInterface) {
            $result[$keys[10]] = $result[$keys[10]]->format('Y-m-d H:i:s.u');
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
        $pos = DataChangeRequestsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setDataChangeRequestId($value);
                break;
            case 1:
                $this->setImportTemplate($value);
                break;
            case 2:
                $this->setImportFilePath($value);
                break;
            case 3:
                $this->setRequestedData($value);
                break;
            case 4:
                $this->setActionType($value);
                break;
            case 5:
                $this->setScheduleDate($value);
                break;
            case 6:
                $this->setStatus($value);
                break;
            case 7:
                $this->setHasError($value);
                break;
            case 8:
                $this->setErrorMessage($value);
                break;
            case 9:
                $this->setCreatedAt($value);
                break;
            case 10:
                $this->setUpdatedAt($value);
                break;
            case 11:
                $this->setImportFileLogId($value);
                break;
            case 12:
                $this->setSuccessIds($value);
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
        $keys = DataChangeRequestsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setDataChangeRequestId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setImportTemplate($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setImportFilePath($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setRequestedData($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setActionType($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setScheduleDate($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setStatus($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setHasError($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setErrorMessage($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCreatedAt($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setUpdatedAt($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setImportFileLogId($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setSuccessIds($arr[$keys[12]]);
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
        $criteria = new Criteria(DataChangeRequestsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(DataChangeRequestsTableMap::COL_DATA_CHANGE_REQUEST_ID)) {
            $criteria->add(DataChangeRequestsTableMap::COL_DATA_CHANGE_REQUEST_ID, $this->data_change_request_id);
        }
        if ($this->isColumnModified(DataChangeRequestsTableMap::COL_IMPORT_TEMPLATE)) {
            $criteria->add(DataChangeRequestsTableMap::COL_IMPORT_TEMPLATE, $this->import_template);
        }
        if ($this->isColumnModified(DataChangeRequestsTableMap::COL_IMPORT_FILE_PATH)) {
            $criteria->add(DataChangeRequestsTableMap::COL_IMPORT_FILE_PATH, $this->import_file_path);
        }
        if ($this->isColumnModified(DataChangeRequestsTableMap::COL_REQUESTED_DATA)) {
            $criteria->add(DataChangeRequestsTableMap::COL_REQUESTED_DATA, $this->requested_data);
        }
        if ($this->isColumnModified(DataChangeRequestsTableMap::COL_ACTION_TYPE)) {
            $criteria->add(DataChangeRequestsTableMap::COL_ACTION_TYPE, $this->action_type);
        }
        if ($this->isColumnModified(DataChangeRequestsTableMap::COL_SCHEDULE_DATE)) {
            $criteria->add(DataChangeRequestsTableMap::COL_SCHEDULE_DATE, $this->schedule_date);
        }
        if ($this->isColumnModified(DataChangeRequestsTableMap::COL_STATUS)) {
            $criteria->add(DataChangeRequestsTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(DataChangeRequestsTableMap::COL_HAS_ERROR)) {
            $criteria->add(DataChangeRequestsTableMap::COL_HAS_ERROR, $this->has_error);
        }
        if ($this->isColumnModified(DataChangeRequestsTableMap::COL_ERROR_MESSAGE)) {
            $criteria->add(DataChangeRequestsTableMap::COL_ERROR_MESSAGE, $this->error_message);
        }
        if ($this->isColumnModified(DataChangeRequestsTableMap::COL_CREATED_AT)) {
            $criteria->add(DataChangeRequestsTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(DataChangeRequestsTableMap::COL_UPDATED_AT)) {
            $criteria->add(DataChangeRequestsTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(DataChangeRequestsTableMap::COL_IMPORT_FILE_LOG_ID)) {
            $criteria->add(DataChangeRequestsTableMap::COL_IMPORT_FILE_LOG_ID, $this->import_file_log_id);
        }
        if ($this->isColumnModified(DataChangeRequestsTableMap::COL_SUCCESS_IDS)) {
            $criteria->add(DataChangeRequestsTableMap::COL_SUCCESS_IDS, $this->success_ids);
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
        $criteria = ChildDataChangeRequestsQuery::create();
        $criteria->add(DataChangeRequestsTableMap::COL_DATA_CHANGE_REQUEST_ID, $this->data_change_request_id);

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
        $validPk = null !== $this->getDataChangeRequestId();

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
        return $this->getDataChangeRequestId();
    }

    /**
     * Generic method to set the primary key (data_change_request_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setDataChangeRequestId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getDataChangeRequestId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\DataChangeRequests (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setImportTemplate($this->getImportTemplate());
        $copyObj->setImportFilePath($this->getImportFilePath());
        $copyObj->setRequestedData($this->getRequestedData());
        $copyObj->setActionType($this->getActionType());
        $copyObj->setScheduleDate($this->getScheduleDate());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setHasError($this->getHasError());
        $copyObj->setErrorMessage($this->getErrorMessage());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setImportFileLogId($this->getImportFileLogId());
        $copyObj->setSuccessIds($this->getSuccessIds());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setDataChangeRequestId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\DataChangeRequests Clone of current object.
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
        $this->data_change_request_id = null;
        $this->import_template = null;
        $this->import_file_path = null;
        $this->requested_data = null;
        $this->action_type = null;
        $this->schedule_date = null;
        $this->status = null;
        $this->has_error = null;
        $this->error_message = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->import_file_log_id = null;
        $this->success_ids = null;
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
        return (string) $this->exportTo(DataChangeRequestsTableMap::DEFAULT_STRING_FORMAT);
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
