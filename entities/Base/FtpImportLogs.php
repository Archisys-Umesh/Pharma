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
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\FtpImportBatches as ChildFtpImportBatches;
use entities\FtpImportBatchesQuery as ChildFtpImportBatchesQuery;
use entities\FtpImportLogsQuery as ChildFtpImportLogsQuery;
use entities\Map\FtpImportLogsTableMap;

/**
 * Base class that represents a row from the 'ftp_import_logs' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class FtpImportLogs implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\FtpImportLogsTableMap';


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
     * The value for the ftp_import_log_id field.
     *
     * @var        string
     */
    protected $ftp_import_log_id;

    /**
     * The value for the ftp_import_batch_id field.
     *
     * @var        int|null
     */
    protected $ftp_import_batch_id;

    /**
     * The value for the company_id field.
     *
     * @var        int|null
     */
    protected $company_id;

    /**
     * The value for the file_path field.
     *
     * @var        string|null
     */
    protected $file_path;

    /**
     * The value for the no_total_records field.
     *
     * Note: this column has a database default value of: 0
     * @var        int|null
     */
    protected $no_total_records;

    /**
     * The value for the no_successful_records field.
     *
     * Note: this column has a database default value of: 0
     * @var        int|null
     */
    protected $no_successful_records;

    /**
     * The value for the no_failed_records field.
     *
     * Note: this column has a database default value of: 0
     * @var        int|null
     */
    protected $no_failed_records;

    /**
     * The value for the created_at field.
     *
     * @var        DateTime|null
     */
    protected $created_at;

    /**
     * The value for the is_file_processed field.
     *
     * Note: this column has a database default value of: 1
     * @var        int|null
     */
    protected $is_file_processed;

    /**
     * The value for the error_message field.
     *
     * @var        string|null
     */
    protected $error_message;

    /**
     * The value for the is_file_processing field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $is_file_processing;

    /**
     * The value for the no_processed_records field.
     *
     * @var        int|null
     */
    protected $no_processed_records;

    /**
     * The value for the updated_at field.
     *
     * @var        DateTime|null
     */
    protected $updated_at;

    /**
     * The value for the start_time field.
     *
     * @var        DateTime|null
     */
    protected $start_time;

    /**
     * The value for the end_time field.
     *
     * @var        DateTime|null
     */
    protected $end_time;

    /**
     * @var        ChildFtpImportBatches
     */
    protected $aFtpImportBatches;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

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
        $this->no_total_records = 0;
        $this->no_successful_records = 0;
        $this->no_failed_records = 0;
        $this->is_file_processed = 1;
        $this->is_file_processing = false;
    }

    /**
     * Initializes internal state of entities\Base\FtpImportLogs object.
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
     * Compares this with another <code>FtpImportLogs</code> instance.  If
     * <code>obj</code> is an instance of <code>FtpImportLogs</code>, delegates to
     * <code>equals(FtpImportLogs)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [ftp_import_log_id] column value.
     *
     * @return string
     */
    public function getFtpImportLogId()
    {
        return $this->ftp_import_log_id;
    }

    /**
     * Get the [ftp_import_batch_id] column value.
     *
     * @return int|null
     */
    public function getFtpImportBatchId()
    {
        return $this->ftp_import_batch_id;
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
     * Get the [file_path] column value.
     *
     * @return string|null
     */
    public function getFilePath()
    {
        return $this->file_path;
    }

    /**
     * Get the [no_total_records] column value.
     *
     * @return int|null
     */
    public function getNoTotalRecords()
    {
        return $this->no_total_records;
    }

    /**
     * Get the [no_successful_records] column value.
     *
     * @return int|null
     */
    public function getNoSuccessfulRecords()
    {
        return $this->no_successful_records;
    }

    /**
     * Get the [no_failed_records] column value.
     *
     * @return int|null
     */
    public function getNoFailedRecords()
    {
        return $this->no_failed_records;
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
     * Get the [is_file_processed] column value.
     *
     * @return int|null
     */
    public function getIsFileProcessed()
    {
        return $this->is_file_processed;
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
     * Get the [is_file_processing] column value.
     *
     * @return boolean|null
     */
    public function getIsFileProcessing()
    {
        return $this->is_file_processing;
    }

    /**
     * Get the [is_file_processing] column value.
     *
     * @return boolean|null
     */
    public function isFileProcessing()
    {
        return $this->getIsFileProcessing();
    }

    /**
     * Get the [no_processed_records] column value.
     *
     * @return int|null
     */
    public function getNoProcessedRecords()
    {
        return $this->no_processed_records;
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
     * Get the [optionally formatted] temporal [start_time] column value.
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
    public function getStartTime($format = null)
    {
        if ($format === null) {
            return $this->start_time;
        } else {
            return $this->start_time instanceof \DateTimeInterface ? $this->start_time->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [end_time] column value.
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
    public function getEndTime($format = null)
    {
        if ($format === null) {
            return $this->end_time;
        } else {
            return $this->end_time instanceof \DateTimeInterface ? $this->end_time->format($format) : null;
        }
    }

    /**
     * Set the value of [ftp_import_log_id] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFtpImportLogId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ftp_import_log_id !== $v) {
            $this->ftp_import_log_id = $v;
            $this->modifiedColumns[FtpImportLogsTableMap::COL_FTP_IMPORT_LOG_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [ftp_import_batch_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFtpImportBatchId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->ftp_import_batch_id !== $v) {
            $this->ftp_import_batch_id = $v;
            $this->modifiedColumns[FtpImportLogsTableMap::COL_FTP_IMPORT_BATCH_ID] = true;
        }

        if ($this->aFtpImportBatches !== null && $this->aFtpImportBatches->getFtpImportBatchId() !== $v) {
            $this->aFtpImportBatches = null;
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
            $this->modifiedColumns[FtpImportLogsTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [file_path] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFilePath($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->file_path !== $v) {
            $this->file_path = $v;
            $this->modifiedColumns[FtpImportLogsTableMap::COL_FILE_PATH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [no_total_records] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNoTotalRecords($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->no_total_records !== $v) {
            $this->no_total_records = $v;
            $this->modifiedColumns[FtpImportLogsTableMap::COL_NO_TOTAL_RECORDS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [no_successful_records] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNoSuccessfulRecords($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->no_successful_records !== $v) {
            $this->no_successful_records = $v;
            $this->modifiedColumns[FtpImportLogsTableMap::COL_NO_SUCCESSFUL_RECORDS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [no_failed_records] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNoFailedRecords($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->no_failed_records !== $v) {
            $this->no_failed_records = $v;
            $this->modifiedColumns[FtpImportLogsTableMap::COL_NO_FAILED_RECORDS] = true;
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
                $this->modifiedColumns[FtpImportLogsTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [is_file_processed] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIsFileProcessed($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->is_file_processed !== $v) {
            $this->is_file_processed = $v;
            $this->modifiedColumns[FtpImportLogsTableMap::COL_IS_FILE_PROCESSED] = true;
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
            $this->modifiedColumns[FtpImportLogsTableMap::COL_ERROR_MESSAGE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_file_processing] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsFileProcessing($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_file_processing !== $v) {
            $this->is_file_processing = $v;
            $this->modifiedColumns[FtpImportLogsTableMap::COL_IS_FILE_PROCESSING] = true;
        }

        return $this;
    }

    /**
     * Set the value of [no_processed_records] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNoProcessedRecords($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->no_processed_records !== $v) {
            $this->no_processed_records = $v;
            $this->modifiedColumns[FtpImportLogsTableMap::COL_NO_PROCESSED_RECORDS] = true;
        }

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
                $this->modifiedColumns[FtpImportLogsTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [start_time] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setStartTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->start_time !== null || $dt !== null) {
            if ($this->start_time === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->start_time->format("Y-m-d H:i:s.u")) {
                $this->start_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[FtpImportLogsTableMap::COL_START_TIME] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [end_time] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setEndTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->end_time !== null || $dt !== null) {
            if ($this->end_time === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->end_time->format("Y-m-d H:i:s.u")) {
                $this->end_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[FtpImportLogsTableMap::COL_END_TIME] = true;
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
            if ($this->no_total_records !== 0) {
                return false;
            }

            if ($this->no_successful_records !== 0) {
                return false;
            }

            if ($this->no_failed_records !== 0) {
                return false;
            }

            if ($this->is_file_processed !== 1) {
                return false;
            }

            if ($this->is_file_processing !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : FtpImportLogsTableMap::translateFieldName('FtpImportLogId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ftp_import_log_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : FtpImportLogsTableMap::translateFieldName('FtpImportBatchId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ftp_import_batch_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : FtpImportLogsTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : FtpImportLogsTableMap::translateFieldName('FilePath', TableMap::TYPE_PHPNAME, $indexType)];
            $this->file_path = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : FtpImportLogsTableMap::translateFieldName('NoTotalRecords', TableMap::TYPE_PHPNAME, $indexType)];
            $this->no_total_records = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : FtpImportLogsTableMap::translateFieldName('NoSuccessfulRecords', TableMap::TYPE_PHPNAME, $indexType)];
            $this->no_successful_records = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : FtpImportLogsTableMap::translateFieldName('NoFailedRecords', TableMap::TYPE_PHPNAME, $indexType)];
            $this->no_failed_records = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : FtpImportLogsTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : FtpImportLogsTableMap::translateFieldName('IsFileProcessed', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_file_processed = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : FtpImportLogsTableMap::translateFieldName('ErrorMessage', TableMap::TYPE_PHPNAME, $indexType)];
            $this->error_message = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : FtpImportLogsTableMap::translateFieldName('IsFileProcessing', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_file_processing = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : FtpImportLogsTableMap::translateFieldName('NoProcessedRecords', TableMap::TYPE_PHPNAME, $indexType)];
            $this->no_processed_records = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : FtpImportLogsTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : FtpImportLogsTableMap::translateFieldName('StartTime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->start_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : FtpImportLogsTableMap::translateFieldName('EndTime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->end_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 15; // 15 = FtpImportLogsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\FtpImportLogs'), 0, $e);
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
        if ($this->aFtpImportBatches !== null && $this->ftp_import_batch_id !== $this->aFtpImportBatches->getFtpImportBatchId()) {
            $this->aFtpImportBatches = null;
        }
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(FtpImportLogsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildFtpImportLogsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aFtpImportBatches = null;
            $this->aCompany = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see FtpImportLogs::setDeleted()
     * @see FtpImportLogs::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(FtpImportLogsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildFtpImportLogsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(FtpImportLogsTableMap::DATABASE_NAME);
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
                FtpImportLogsTableMap::addInstanceToPool($this);
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

            if ($this->aFtpImportBatches !== null) {
                if ($this->aFtpImportBatches->isModified() || $this->aFtpImportBatches->isNew()) {
                    $affectedRows += $this->aFtpImportBatches->save($con);
                }
                $this->setFtpImportBatches($this->aFtpImportBatches);
            }

            if ($this->aCompany !== null) {
                if ($this->aCompany->isModified() || $this->aCompany->isNew()) {
                    $affectedRows += $this->aCompany->save($con);
                }
                $this->setCompany($this->aCompany);
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

        $this->modifiedColumns[FtpImportLogsTableMap::COL_FTP_IMPORT_LOG_ID] = true;
        if (null !== $this->ftp_import_log_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . FtpImportLogsTableMap::COL_FTP_IMPORT_LOG_ID . ')');
        }
        if (null === $this->ftp_import_log_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('ftp_import_logs_ftp_import_log_id_seq')");
                $this->ftp_import_log_id = (string) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_FTP_IMPORT_LOG_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ftp_import_log_id';
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_FTP_IMPORT_BATCH_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ftp_import_batch_id';
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_FILE_PATH)) {
            $modifiedColumns[':p' . $index++]  = 'file_path';
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_NO_TOTAL_RECORDS)) {
            $modifiedColumns[':p' . $index++]  = 'no_total_records';
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_NO_SUCCESSFUL_RECORDS)) {
            $modifiedColumns[':p' . $index++]  = 'no_successful_records';
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_NO_FAILED_RECORDS)) {
            $modifiedColumns[':p' . $index++]  = 'no_failed_records';
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_IS_FILE_PROCESSED)) {
            $modifiedColumns[':p' . $index++]  = 'is_file_processed';
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_ERROR_MESSAGE)) {
            $modifiedColumns[':p' . $index++]  = 'error_message';
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_IS_FILE_PROCESSING)) {
            $modifiedColumns[':p' . $index++]  = 'is_file_processing';
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_NO_PROCESSED_RECORDS)) {
            $modifiedColumns[':p' . $index++]  = 'no_processed_records';
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_START_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'start_time';
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_END_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'end_time';
        }

        $sql = sprintf(
            'INSERT INTO ftp_import_logs (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'ftp_import_log_id':
                        $stmt->bindValue($identifier, $this->ftp_import_log_id, PDO::PARAM_INT);

                        break;
                    case 'ftp_import_batch_id':
                        $stmt->bindValue($identifier, $this->ftp_import_batch_id, PDO::PARAM_INT);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'file_path':
                        $stmt->bindValue($identifier, $this->file_path, PDO::PARAM_STR);

                        break;
                    case 'no_total_records':
                        $stmt->bindValue($identifier, $this->no_total_records, PDO::PARAM_INT);

                        break;
                    case 'no_successful_records':
                        $stmt->bindValue($identifier, $this->no_successful_records, PDO::PARAM_INT);

                        break;
                    case 'no_failed_records':
                        $stmt->bindValue($identifier, $this->no_failed_records, PDO::PARAM_INT);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'is_file_processed':
                        $stmt->bindValue($identifier, $this->is_file_processed, PDO::PARAM_INT);

                        break;
                    case 'error_message':
                        $stmt->bindValue($identifier, $this->error_message, PDO::PARAM_STR);

                        break;
                    case 'is_file_processing':
                        $stmt->bindValue($identifier, $this->is_file_processing, PDO::PARAM_BOOL);

                        break;
                    case 'no_processed_records':
                        $stmt->bindValue($identifier, $this->no_processed_records, PDO::PARAM_INT);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'start_time':
                        $stmt->bindValue($identifier, $this->start_time ? $this->start_time->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'end_time':
                        $stmt->bindValue($identifier, $this->end_time ? $this->end_time->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

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
        $pos = FtpImportLogsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getFtpImportLogId();

            case 1:
                return $this->getFtpImportBatchId();

            case 2:
                return $this->getCompanyId();

            case 3:
                return $this->getFilePath();

            case 4:
                return $this->getNoTotalRecords();

            case 5:
                return $this->getNoSuccessfulRecords();

            case 6:
                return $this->getNoFailedRecords();

            case 7:
                return $this->getCreatedAt();

            case 8:
                return $this->getIsFileProcessed();

            case 9:
                return $this->getErrorMessage();

            case 10:
                return $this->getIsFileProcessing();

            case 11:
                return $this->getNoProcessedRecords();

            case 12:
                return $this->getUpdatedAt();

            case 13:
                return $this->getStartTime();

            case 14:
                return $this->getEndTime();

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
        if (isset($alreadyDumpedObjects['FtpImportLogs'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['FtpImportLogs'][$this->hashCode()] = true;
        $keys = FtpImportLogsTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getFtpImportLogId(),
            $keys[1] => $this->getFtpImportBatchId(),
            $keys[2] => $this->getCompanyId(),
            $keys[3] => $this->getFilePath(),
            $keys[4] => $this->getNoTotalRecords(),
            $keys[5] => $this->getNoSuccessfulRecords(),
            $keys[6] => $this->getNoFailedRecords(),
            $keys[7] => $this->getCreatedAt(),
            $keys[8] => $this->getIsFileProcessed(),
            $keys[9] => $this->getErrorMessage(),
            $keys[10] => $this->getIsFileProcessing(),
            $keys[11] => $this->getNoProcessedRecords(),
            $keys[12] => $this->getUpdatedAt(),
            $keys[13] => $this->getStartTime(),
            $keys[14] => $this->getEndTime(),
        ];
        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[12]] instanceof \DateTimeInterface) {
            $result[$keys[12]] = $result[$keys[12]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[13]] instanceof \DateTimeInterface) {
            $result[$keys[13]] = $result[$keys[13]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[14]] instanceof \DateTimeInterface) {
            $result[$keys[14]] = $result[$keys[14]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aFtpImportBatches) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'ftpImportBatches';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ftp_import_batches';
                        break;
                    default:
                        $key = 'FtpImportBatches';
                }

                $result[$key] = $this->aFtpImportBatches->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
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
        $pos = FtpImportLogsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setFtpImportLogId($value);
                break;
            case 1:
                $this->setFtpImportBatchId($value);
                break;
            case 2:
                $this->setCompanyId($value);
                break;
            case 3:
                $this->setFilePath($value);
                break;
            case 4:
                $this->setNoTotalRecords($value);
                break;
            case 5:
                $this->setNoSuccessfulRecords($value);
                break;
            case 6:
                $this->setNoFailedRecords($value);
                break;
            case 7:
                $this->setCreatedAt($value);
                break;
            case 8:
                $this->setIsFileProcessed($value);
                break;
            case 9:
                $this->setErrorMessage($value);
                break;
            case 10:
                $this->setIsFileProcessing($value);
                break;
            case 11:
                $this->setNoProcessedRecords($value);
                break;
            case 12:
                $this->setUpdatedAt($value);
                break;
            case 13:
                $this->setStartTime($value);
                break;
            case 14:
                $this->setEndTime($value);
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
        $keys = FtpImportLogsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setFtpImportLogId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFtpImportBatchId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setCompanyId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFilePath($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setNoTotalRecords($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setNoSuccessfulRecords($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setNoFailedRecords($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCreatedAt($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setIsFileProcessed($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setErrorMessage($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setIsFileProcessing($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setNoProcessedRecords($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setUpdatedAt($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setStartTime($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setEndTime($arr[$keys[14]]);
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
        $criteria = new Criteria(FtpImportLogsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(FtpImportLogsTableMap::COL_FTP_IMPORT_LOG_ID)) {
            $criteria->add(FtpImportLogsTableMap::COL_FTP_IMPORT_LOG_ID, $this->ftp_import_log_id);
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_FTP_IMPORT_BATCH_ID)) {
            $criteria->add(FtpImportLogsTableMap::COL_FTP_IMPORT_BATCH_ID, $this->ftp_import_batch_id);
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_COMPANY_ID)) {
            $criteria->add(FtpImportLogsTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_FILE_PATH)) {
            $criteria->add(FtpImportLogsTableMap::COL_FILE_PATH, $this->file_path);
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_NO_TOTAL_RECORDS)) {
            $criteria->add(FtpImportLogsTableMap::COL_NO_TOTAL_RECORDS, $this->no_total_records);
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_NO_SUCCESSFUL_RECORDS)) {
            $criteria->add(FtpImportLogsTableMap::COL_NO_SUCCESSFUL_RECORDS, $this->no_successful_records);
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_NO_FAILED_RECORDS)) {
            $criteria->add(FtpImportLogsTableMap::COL_NO_FAILED_RECORDS, $this->no_failed_records);
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_CREATED_AT)) {
            $criteria->add(FtpImportLogsTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_IS_FILE_PROCESSED)) {
            $criteria->add(FtpImportLogsTableMap::COL_IS_FILE_PROCESSED, $this->is_file_processed);
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_ERROR_MESSAGE)) {
            $criteria->add(FtpImportLogsTableMap::COL_ERROR_MESSAGE, $this->error_message);
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_IS_FILE_PROCESSING)) {
            $criteria->add(FtpImportLogsTableMap::COL_IS_FILE_PROCESSING, $this->is_file_processing);
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_NO_PROCESSED_RECORDS)) {
            $criteria->add(FtpImportLogsTableMap::COL_NO_PROCESSED_RECORDS, $this->no_processed_records);
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_UPDATED_AT)) {
            $criteria->add(FtpImportLogsTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_START_TIME)) {
            $criteria->add(FtpImportLogsTableMap::COL_START_TIME, $this->start_time);
        }
        if ($this->isColumnModified(FtpImportLogsTableMap::COL_END_TIME)) {
            $criteria->add(FtpImportLogsTableMap::COL_END_TIME, $this->end_time);
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
        $criteria = ChildFtpImportLogsQuery::create();
        $criteria->add(FtpImportLogsTableMap::COL_FTP_IMPORT_LOG_ID, $this->ftp_import_log_id);

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
        $validPk = null !== $this->getFtpImportLogId();

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
        return $this->getFtpImportLogId();
    }

    /**
     * Generic method to set the primary key (ftp_import_log_id column).
     *
     * @param string|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?string $key = null): void
    {
        $this->setFtpImportLogId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getFtpImportLogId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\FtpImportLogs (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFtpImportBatchId($this->getFtpImportBatchId());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setFilePath($this->getFilePath());
        $copyObj->setNoTotalRecords($this->getNoTotalRecords());
        $copyObj->setNoSuccessfulRecords($this->getNoSuccessfulRecords());
        $copyObj->setNoFailedRecords($this->getNoFailedRecords());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setIsFileProcessed($this->getIsFileProcessed());
        $copyObj->setErrorMessage($this->getErrorMessage());
        $copyObj->setIsFileProcessing($this->getIsFileProcessing());
        $copyObj->setNoProcessedRecords($this->getNoProcessedRecords());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setStartTime($this->getStartTime());
        $copyObj->setEndTime($this->getEndTime());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setFtpImportLogId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\FtpImportLogs Clone of current object.
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
     * Declares an association between this object and a ChildFtpImportBatches object.
     *
     * @param ChildFtpImportBatches|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setFtpImportBatches(ChildFtpImportBatches $v = null)
    {
        if ($v === null) {
            $this->setFtpImportBatchId(NULL);
        } else {
            $this->setFtpImportBatchId($v->getFtpImportBatchId());
        }

        $this->aFtpImportBatches = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildFtpImportBatches object, it will not be re-added.
        if ($v !== null) {
            $v->addFtpImportLogs($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildFtpImportBatches object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildFtpImportBatches|null The associated ChildFtpImportBatches object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getFtpImportBatches(?ConnectionInterface $con = null)
    {
        if ($this->aFtpImportBatches === null && ($this->ftp_import_batch_id != 0)) {
            $this->aFtpImportBatches = ChildFtpImportBatchesQuery::create()->findPk($this->ftp_import_batch_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aFtpImportBatches->addFtpImportLogss($this);
             */
        }

        return $this->aFtpImportBatches;
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
            $v->addFtpImportLogs($this);
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
                $this->aCompany->addFtpImportLogss($this);
             */
        }

        return $this->aCompany;
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
        if (null !== $this->aFtpImportBatches) {
            $this->aFtpImportBatches->removeFtpImportLogs($this);
        }
        if (null !== $this->aCompany) {
            $this->aCompany->removeFtpImportLogs($this);
        }
        $this->ftp_import_log_id = null;
        $this->ftp_import_batch_id = null;
        $this->company_id = null;
        $this->file_path = null;
        $this->no_total_records = null;
        $this->no_successful_records = null;
        $this->no_failed_records = null;
        $this->created_at = null;
        $this->is_file_processed = null;
        $this->error_message = null;
        $this->is_file_processing = null;
        $this->no_processed_records = null;
        $this->updated_at = null;
        $this->start_time = null;
        $this->end_time = null;
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

        $this->aFtpImportBatches = null;
        $this->aCompany = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(FtpImportLogsTableMap::DEFAULT_STRING_FORMAT);
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
