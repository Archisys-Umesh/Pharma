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
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\FtpExportBatches as ChildFtpExportBatches;
use entities\FtpExportBatchesQuery as ChildFtpExportBatchesQuery;
use entities\FtpExportLogs as ChildFtpExportLogs;
use entities\FtpExportLogsQuery as ChildFtpExportLogsQuery;
use entities\Map\FtpExportBatchesTableMap;
use entities\Map\FtpExportLogsTableMap;

/**
 * Base class that represents a row from the 'ftp_export_batches' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class FtpExportBatches implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\FtpExportBatchesTableMap';


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
     * The value for the ftp_export_batch_id field.
     *
     * @var        int
     */
    protected $ftp_export_batch_id;

    /**
     * The value for the label field.
     *
     * @var        string|null
     */
    protected $label;

    /**
     * The value for the attached_function field.
     *
     * @var        string|null
     */
    protected $attached_function;

    /**
     * The value for the next_date field.
     *
     * @var        DateTime|null
     */
    protected $next_date;

    /**
     * The value for the interval_days field.
     *
     * @var        int|null
     */
    protected $interval_days;

    /**
     * The value for the ftp_path field.
     *
     * @var        string|null
     */
    protected $ftp_path;

    /**
     * The value for the isenabled field.
     *
     * Note: this column has a database default value of: 1
     * @var        int|null
     */
    protected $isenabled;

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
     * The value for the file_name_format field.
     *
     * @var        string|null
     */
    protected $file_name_format;

    /**
     * The value for the is_file_processing field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $is_file_processing;

    /**
     * The value for the ftp_order field.
     *
     * @var        int|null
     */
    protected $ftp_order;

    /**
     * The value for the interval_type field.
     *
     * @var        string|null
     */
    protected $interval_type;

    /**
     * The value for the start_date field.
     *
     * @var        DateTime|null
     */
    protected $start_date;

    /**
     * The value for the end_date field.
     *
     * @var        DateTime|null
     */
    protected $end_date;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ObjectCollection|ChildFtpExportLogs[] Collection to store aggregation of ChildFtpExportLogs objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildFtpExportLogs> Collection to store aggregation of ChildFtpExportLogs objects.
     */
    protected $collFtpExportLogss;
    protected $collFtpExportLogssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildFtpExportLogs[]
     * @phpstan-var ObjectCollection&\Traversable<ChildFtpExportLogs>
     */
    protected $ftpExportLogssScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->isenabled = 1;
        $this->is_file_processing = false;
    }

    /**
     * Initializes internal state of entities\Base\FtpExportBatches object.
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
     * Compares this with another <code>FtpExportBatches</code> instance.  If
     * <code>obj</code> is an instance of <code>FtpExportBatches</code>, delegates to
     * <code>equals(FtpExportBatches)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [ftp_export_batch_id] column value.
     *
     * @return int
     */
    public function getFtpExportBatchId()
    {
        return $this->ftp_export_batch_id;
    }

    /**
     * Get the [label] column value.
     *
     * @return string|null
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Get the [attached_function] column value.
     *
     * @return string|null
     */
    public function getAttachedFunction()
    {
        return $this->attached_function;
    }

    /**
     * Get the [optionally formatted] temporal [next_date] column value.
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
    public function getNextDate($format = null)
    {
        if ($format === null) {
            return $this->next_date;
        } else {
            return $this->next_date instanceof \DateTimeInterface ? $this->next_date->format($format) : null;
        }
    }

    /**
     * Get the [interval_days] column value.
     *
     * @return int|null
     */
    public function getIntervalDays()
    {
        return $this->interval_days;
    }

    /**
     * Get the [ftp_path] column value.
     *
     * @return string|null
     */
    public function getFtpPath()
    {
        return $this->ftp_path;
    }

    /**
     * Get the [isenabled] column value.
     *
     * @return int|null
     */
    public function getIsenabled()
    {
        return $this->isenabled;
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
     * Get the [file_name_format] column value.
     *
     * @return string|null
     */
    public function getFileNameFormat()
    {
        return $this->file_name_format;
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
     * Get the [ftp_order] column value.
     *
     * @return int|null
     */
    public function getFtpOrder()
    {
        return $this->ftp_order;
    }

    /**
     * Get the [interval_type] column value.
     *
     * @return string|null
     */
    public function getIntervalType()
    {
        return $this->interval_type;
    }

    /**
     * Get the [optionally formatted] temporal [start_date] column value.
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
    public function getStartDate($format = null)
    {
        if ($format === null) {
            return $this->start_date;
        } else {
            return $this->start_date instanceof \DateTimeInterface ? $this->start_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [end_date] column value.
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
    public function getEndDate($format = null)
    {
        if ($format === null) {
            return $this->end_date;
        } else {
            return $this->end_date instanceof \DateTimeInterface ? $this->end_date->format($format) : null;
        }
    }

    /**
     * Set the value of [ftp_export_batch_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFtpExportBatchId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->ftp_export_batch_id !== $v) {
            $this->ftp_export_batch_id = $v;
            $this->modifiedColumns[FtpExportBatchesTableMap::COL_FTP_EXPORT_BATCH_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [label] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLabel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->label !== $v) {
            $this->label = $v;
            $this->modifiedColumns[FtpExportBatchesTableMap::COL_LABEL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [attached_function] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAttachedFunction($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->attached_function !== $v) {
            $this->attached_function = $v;
            $this->modifiedColumns[FtpExportBatchesTableMap::COL_ATTACHED_FUNCTION] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [next_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setNextDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->next_date !== null || $dt !== null) {
            if ($this->next_date === null || $dt === null || $dt->format("Y-m-d") !== $this->next_date->format("Y-m-d")) {
                $this->next_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[FtpExportBatchesTableMap::COL_NEXT_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [interval_days] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIntervalDays($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->interval_days !== $v) {
            $this->interval_days = $v;
            $this->modifiedColumns[FtpExportBatchesTableMap::COL_INTERVAL_DAYS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [ftp_path] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFtpPath($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ftp_path !== $v) {
            $this->ftp_path = $v;
            $this->modifiedColumns[FtpExportBatchesTableMap::COL_FTP_PATH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [isenabled] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIsenabled($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->isenabled !== $v) {
            $this->isenabled = $v;
            $this->modifiedColumns[FtpExportBatchesTableMap::COL_ISENABLED] = true;
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
            $this->modifiedColumns[FtpExportBatchesTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
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
                $this->modifiedColumns[FtpExportBatchesTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [file_name_format] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFileNameFormat($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->file_name_format !== $v) {
            $this->file_name_format = $v;
            $this->modifiedColumns[FtpExportBatchesTableMap::COL_FILE_NAME_FORMAT] = true;
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
            $this->modifiedColumns[FtpExportBatchesTableMap::COL_IS_FILE_PROCESSING] = true;
        }

        return $this;
    }

    /**
     * Set the value of [ftp_order] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFtpOrder($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->ftp_order !== $v) {
            $this->ftp_order = $v;
            $this->modifiedColumns[FtpExportBatchesTableMap::COL_FTP_ORDER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [interval_type] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIntervalType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->interval_type !== $v) {
            $this->interval_type = $v;
            $this->modifiedColumns[FtpExportBatchesTableMap::COL_INTERVAL_TYPE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [start_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setStartDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->start_date !== null || $dt !== null) {
            if ($this->start_date === null || $dt === null || $dt->format("Y-m-d") !== $this->start_date->format("Y-m-d")) {
                $this->start_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[FtpExportBatchesTableMap::COL_START_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [end_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setEndDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->end_date !== null || $dt !== null) {
            if ($this->end_date === null || $dt === null || $dt->format("Y-m-d") !== $this->end_date->format("Y-m-d")) {
                $this->end_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[FtpExportBatchesTableMap::COL_END_DATE] = true;
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
            if ($this->isenabled !== 1) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : FtpExportBatchesTableMap::translateFieldName('FtpExportBatchId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ftp_export_batch_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : FtpExportBatchesTableMap::translateFieldName('Label', TableMap::TYPE_PHPNAME, $indexType)];
            $this->label = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : FtpExportBatchesTableMap::translateFieldName('AttachedFunction', TableMap::TYPE_PHPNAME, $indexType)];
            $this->attached_function = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : FtpExportBatchesTableMap::translateFieldName('NextDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->next_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : FtpExportBatchesTableMap::translateFieldName('IntervalDays', TableMap::TYPE_PHPNAME, $indexType)];
            $this->interval_days = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : FtpExportBatchesTableMap::translateFieldName('FtpPath', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ftp_path = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : FtpExportBatchesTableMap::translateFieldName('Isenabled', TableMap::TYPE_PHPNAME, $indexType)];
            $this->isenabled = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : FtpExportBatchesTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : FtpExportBatchesTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : FtpExportBatchesTableMap::translateFieldName('FileNameFormat', TableMap::TYPE_PHPNAME, $indexType)];
            $this->file_name_format = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : FtpExportBatchesTableMap::translateFieldName('IsFileProcessing', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_file_processing = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : FtpExportBatchesTableMap::translateFieldName('FtpOrder', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ftp_order = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : FtpExportBatchesTableMap::translateFieldName('IntervalType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->interval_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : FtpExportBatchesTableMap::translateFieldName('StartDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->start_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : FtpExportBatchesTableMap::translateFieldName('EndDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->end_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 15; // 15 = FtpExportBatchesTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\FtpExportBatches'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(FtpExportBatchesTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildFtpExportBatchesQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->collFtpExportLogss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see FtpExportBatches::setDeleted()
     * @see FtpExportBatches::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(FtpExportBatchesTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildFtpExportBatchesQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(FtpExportBatchesTableMap::DATABASE_NAME);
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
                FtpExportBatchesTableMap::addInstanceToPool($this);
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

            if ($this->ftpExportLogssScheduledForDeletion !== null) {
                if (!$this->ftpExportLogssScheduledForDeletion->isEmpty()) {
                    \entities\FtpExportLogsQuery::create()
                        ->filterByPrimaryKeys($this->ftpExportLogssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->ftpExportLogssScheduledForDeletion = null;
                }
            }

            if ($this->collFtpExportLogss !== null) {
                foreach ($this->collFtpExportLogss as $referrerFK) {
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

        $this->modifiedColumns[FtpExportBatchesTableMap::COL_FTP_EXPORT_BATCH_ID] = true;
        if (null !== $this->ftp_export_batch_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . FtpExportBatchesTableMap::COL_FTP_EXPORT_BATCH_ID . ')');
        }
        if (null === $this->ftp_export_batch_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('ftp_export_batches_ftp_export_batch_id_seq')");
                $this->ftp_export_batch_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_FTP_EXPORT_BATCH_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ftp_export_batch_id';
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_LABEL)) {
            $modifiedColumns[':p' . $index++]  = 'label';
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_ATTACHED_FUNCTION)) {
            $modifiedColumns[':p' . $index++]  = 'attached_function';
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_NEXT_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'next_date';
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_INTERVAL_DAYS)) {
            $modifiedColumns[':p' . $index++]  = 'interval_days';
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_FTP_PATH)) {
            $modifiedColumns[':p' . $index++]  = 'ftp_path';
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_ISENABLED)) {
            $modifiedColumns[':p' . $index++]  = 'isenabled';
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_FILE_NAME_FORMAT)) {
            $modifiedColumns[':p' . $index++]  = 'file_name_format';
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_IS_FILE_PROCESSING)) {
            $modifiedColumns[':p' . $index++]  = 'is_file_processing';
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_FTP_ORDER)) {
            $modifiedColumns[':p' . $index++]  = 'ftp_order';
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_INTERVAL_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'interval_type';
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_START_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'start_date';
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_END_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'end_date';
        }

        $sql = sprintf(
            'INSERT INTO ftp_export_batches (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'ftp_export_batch_id':
                        $stmt->bindValue($identifier, $this->ftp_export_batch_id, PDO::PARAM_INT);

                        break;
                    case 'label':
                        $stmt->bindValue($identifier, $this->label, PDO::PARAM_STR);

                        break;
                    case 'attached_function':
                        $stmt->bindValue($identifier, $this->attached_function, PDO::PARAM_STR);

                        break;
                    case 'next_date':
                        $stmt->bindValue($identifier, $this->next_date ? $this->next_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'interval_days':
                        $stmt->bindValue($identifier, $this->interval_days, PDO::PARAM_INT);

                        break;
                    case 'ftp_path':
                        $stmt->bindValue($identifier, $this->ftp_path, PDO::PARAM_STR);

                        break;
                    case 'isenabled':
                        $stmt->bindValue($identifier, $this->isenabled, PDO::PARAM_INT);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'file_name_format':
                        $stmt->bindValue($identifier, $this->file_name_format, PDO::PARAM_STR);

                        break;
                    case 'is_file_processing':
                        $stmt->bindValue($identifier, $this->is_file_processing, PDO::PARAM_BOOL);

                        break;
                    case 'ftp_order':
                        $stmt->bindValue($identifier, $this->ftp_order, PDO::PARAM_INT);

                        break;
                    case 'interval_type':
                        $stmt->bindValue($identifier, $this->interval_type, PDO::PARAM_STR);

                        break;
                    case 'start_date':
                        $stmt->bindValue($identifier, $this->start_date ? $this->start_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'end_date':
                        $stmt->bindValue($identifier, $this->end_date ? $this->end_date->format("Y-m-d") : null, PDO::PARAM_STR);

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
        $pos = FtpExportBatchesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getFtpExportBatchId();

            case 1:
                return $this->getLabel();

            case 2:
                return $this->getAttachedFunction();

            case 3:
                return $this->getNextDate();

            case 4:
                return $this->getIntervalDays();

            case 5:
                return $this->getFtpPath();

            case 6:
                return $this->getIsenabled();

            case 7:
                return $this->getCompanyId();

            case 8:
                return $this->getCreatedAt();

            case 9:
                return $this->getFileNameFormat();

            case 10:
                return $this->getIsFileProcessing();

            case 11:
                return $this->getFtpOrder();

            case 12:
                return $this->getIntervalType();

            case 13:
                return $this->getStartDate();

            case 14:
                return $this->getEndDate();

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
        if (isset($alreadyDumpedObjects['FtpExportBatches'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['FtpExportBatches'][$this->hashCode()] = true;
        $keys = FtpExportBatchesTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getFtpExportBatchId(),
            $keys[1] => $this->getLabel(),
            $keys[2] => $this->getAttachedFunction(),
            $keys[3] => $this->getNextDate(),
            $keys[4] => $this->getIntervalDays(),
            $keys[5] => $this->getFtpPath(),
            $keys[6] => $this->getIsenabled(),
            $keys[7] => $this->getCompanyId(),
            $keys[8] => $this->getCreatedAt(),
            $keys[9] => $this->getFileNameFormat(),
            $keys[10] => $this->getIsFileProcessing(),
            $keys[11] => $this->getFtpOrder(),
            $keys[12] => $this->getIntervalType(),
            $keys[13] => $this->getStartDate(),
            $keys[14] => $this->getEndDate(),
        ];
        if ($result[$keys[3]] instanceof \DateTimeInterface) {
            $result[$keys[3]] = $result[$keys[3]]->format('Y-m-d');
        }

        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[13]] instanceof \DateTimeInterface) {
            $result[$keys[13]] = $result[$keys[13]]->format('Y-m-d');
        }

        if ($result[$keys[14]] instanceof \DateTimeInterface) {
            $result[$keys[14]] = $result[$keys[14]]->format('Y-m-d');
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
            if (null !== $this->collFtpExportLogss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'ftpExportLogss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ftp_export_logss';
                        break;
                    default:
                        $key = 'FtpExportLogss';
                }

                $result[$key] = $this->collFtpExportLogss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = FtpExportBatchesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setFtpExportBatchId($value);
                break;
            case 1:
                $this->setLabel($value);
                break;
            case 2:
                $this->setAttachedFunction($value);
                break;
            case 3:
                $this->setNextDate($value);
                break;
            case 4:
                $this->setIntervalDays($value);
                break;
            case 5:
                $this->setFtpPath($value);
                break;
            case 6:
                $this->setIsenabled($value);
                break;
            case 7:
                $this->setCompanyId($value);
                break;
            case 8:
                $this->setCreatedAt($value);
                break;
            case 9:
                $this->setFileNameFormat($value);
                break;
            case 10:
                $this->setIsFileProcessing($value);
                break;
            case 11:
                $this->setFtpOrder($value);
                break;
            case 12:
                $this->setIntervalType($value);
                break;
            case 13:
                $this->setStartDate($value);
                break;
            case 14:
                $this->setEndDate($value);
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
        $keys = FtpExportBatchesTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setFtpExportBatchId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setLabel($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setAttachedFunction($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setNextDate($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setIntervalDays($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setFtpPath($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setIsenabled($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCompanyId($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCreatedAt($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setFileNameFormat($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setIsFileProcessing($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setFtpOrder($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setIntervalType($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setStartDate($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setEndDate($arr[$keys[14]]);
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
        $criteria = new Criteria(FtpExportBatchesTableMap::DATABASE_NAME);

        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_FTP_EXPORT_BATCH_ID)) {
            $criteria->add(FtpExportBatchesTableMap::COL_FTP_EXPORT_BATCH_ID, $this->ftp_export_batch_id);
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_LABEL)) {
            $criteria->add(FtpExportBatchesTableMap::COL_LABEL, $this->label);
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_ATTACHED_FUNCTION)) {
            $criteria->add(FtpExportBatchesTableMap::COL_ATTACHED_FUNCTION, $this->attached_function);
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_NEXT_DATE)) {
            $criteria->add(FtpExportBatchesTableMap::COL_NEXT_DATE, $this->next_date);
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_INTERVAL_DAYS)) {
            $criteria->add(FtpExportBatchesTableMap::COL_INTERVAL_DAYS, $this->interval_days);
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_FTP_PATH)) {
            $criteria->add(FtpExportBatchesTableMap::COL_FTP_PATH, $this->ftp_path);
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_ISENABLED)) {
            $criteria->add(FtpExportBatchesTableMap::COL_ISENABLED, $this->isenabled);
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_COMPANY_ID)) {
            $criteria->add(FtpExportBatchesTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_CREATED_AT)) {
            $criteria->add(FtpExportBatchesTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_FILE_NAME_FORMAT)) {
            $criteria->add(FtpExportBatchesTableMap::COL_FILE_NAME_FORMAT, $this->file_name_format);
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_IS_FILE_PROCESSING)) {
            $criteria->add(FtpExportBatchesTableMap::COL_IS_FILE_PROCESSING, $this->is_file_processing);
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_FTP_ORDER)) {
            $criteria->add(FtpExportBatchesTableMap::COL_FTP_ORDER, $this->ftp_order);
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_INTERVAL_TYPE)) {
            $criteria->add(FtpExportBatchesTableMap::COL_INTERVAL_TYPE, $this->interval_type);
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_START_DATE)) {
            $criteria->add(FtpExportBatchesTableMap::COL_START_DATE, $this->start_date);
        }
        if ($this->isColumnModified(FtpExportBatchesTableMap::COL_END_DATE)) {
            $criteria->add(FtpExportBatchesTableMap::COL_END_DATE, $this->end_date);
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
        $criteria = ChildFtpExportBatchesQuery::create();
        $criteria->add(FtpExportBatchesTableMap::COL_FTP_EXPORT_BATCH_ID, $this->ftp_export_batch_id);

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
        $validPk = null !== $this->getFtpExportBatchId();

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
        return $this->getFtpExportBatchId();
    }

    /**
     * Generic method to set the primary key (ftp_export_batch_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setFtpExportBatchId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getFtpExportBatchId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\FtpExportBatches (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setLabel($this->getLabel());
        $copyObj->setAttachedFunction($this->getAttachedFunction());
        $copyObj->setNextDate($this->getNextDate());
        $copyObj->setIntervalDays($this->getIntervalDays());
        $copyObj->setFtpPath($this->getFtpPath());
        $copyObj->setIsenabled($this->getIsenabled());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setFileNameFormat($this->getFileNameFormat());
        $copyObj->setIsFileProcessing($this->getIsFileProcessing());
        $copyObj->setFtpOrder($this->getFtpOrder());
        $copyObj->setIntervalType($this->getIntervalType());
        $copyObj->setStartDate($this->getStartDate());
        $copyObj->setEndDate($this->getEndDate());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getFtpExportLogss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addFtpExportLogs($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setFtpExportBatchId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\FtpExportBatches Clone of current object.
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
            $v->addFtpExportBatches($this);
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
                $this->aCompany->addFtpExportBatchess($this);
             */
        }

        return $this->aCompany;
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
        if ('FtpExportLogs' === $relationName) {
            $this->initFtpExportLogss();
            return;
        }
    }

    /**
     * Clears out the collFtpExportLogss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addFtpExportLogss()
     */
    public function clearFtpExportLogss()
    {
        $this->collFtpExportLogss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collFtpExportLogss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialFtpExportLogss($v = true): void
    {
        $this->collFtpExportLogssPartial = $v;
    }

    /**
     * Initializes the collFtpExportLogss collection.
     *
     * By default this just sets the collFtpExportLogss collection to an empty array (like clearcollFtpExportLogss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initFtpExportLogss(bool $overrideExisting = true): void
    {
        if (null !== $this->collFtpExportLogss && !$overrideExisting) {
            return;
        }

        $collectionClassName = FtpExportLogsTableMap::getTableMap()->getCollectionClassName();

        $this->collFtpExportLogss = new $collectionClassName;
        $this->collFtpExportLogss->setModel('\entities\FtpExportLogs');
    }

    /**
     * Gets an array of ChildFtpExportLogs objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildFtpExportBatches is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildFtpExportLogs[] List of ChildFtpExportLogs objects
     * @phpstan-return ObjectCollection&\Traversable<ChildFtpExportLogs> List of ChildFtpExportLogs objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getFtpExportLogss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collFtpExportLogssPartial && !$this->isNew();
        if (null === $this->collFtpExportLogss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collFtpExportLogss) {
                    $this->initFtpExportLogss();
                } else {
                    $collectionClassName = FtpExportLogsTableMap::getTableMap()->getCollectionClassName();

                    $collFtpExportLogss = new $collectionClassName;
                    $collFtpExportLogss->setModel('\entities\FtpExportLogs');

                    return $collFtpExportLogss;
                }
            } else {
                $collFtpExportLogss = ChildFtpExportLogsQuery::create(null, $criteria)
                    ->filterByFtpExportBatches($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collFtpExportLogssPartial && count($collFtpExportLogss)) {
                        $this->initFtpExportLogss(false);

                        foreach ($collFtpExportLogss as $obj) {
                            if (false == $this->collFtpExportLogss->contains($obj)) {
                                $this->collFtpExportLogss->append($obj);
                            }
                        }

                        $this->collFtpExportLogssPartial = true;
                    }

                    return $collFtpExportLogss;
                }

                if ($partial && $this->collFtpExportLogss) {
                    foreach ($this->collFtpExportLogss as $obj) {
                        if ($obj->isNew()) {
                            $collFtpExportLogss[] = $obj;
                        }
                    }
                }

                $this->collFtpExportLogss = $collFtpExportLogss;
                $this->collFtpExportLogssPartial = false;
            }
        }

        return $this->collFtpExportLogss;
    }

    /**
     * Sets a collection of ChildFtpExportLogs objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $ftpExportLogss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setFtpExportLogss(Collection $ftpExportLogss, ?ConnectionInterface $con = null)
    {
        /** @var ChildFtpExportLogs[] $ftpExportLogssToDelete */
        $ftpExportLogssToDelete = $this->getFtpExportLogss(new Criteria(), $con)->diff($ftpExportLogss);


        $this->ftpExportLogssScheduledForDeletion = $ftpExportLogssToDelete;

        foreach ($ftpExportLogssToDelete as $ftpExportLogsRemoved) {
            $ftpExportLogsRemoved->setFtpExportBatches(null);
        }

        $this->collFtpExportLogss = null;
        foreach ($ftpExportLogss as $ftpExportLogs) {
            $this->addFtpExportLogs($ftpExportLogs);
        }

        $this->collFtpExportLogss = $ftpExportLogss;
        $this->collFtpExportLogssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related FtpExportLogs objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related FtpExportLogs objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countFtpExportLogss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collFtpExportLogssPartial && !$this->isNew();
        if (null === $this->collFtpExportLogss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collFtpExportLogss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getFtpExportLogss());
            }

            $query = ChildFtpExportLogsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByFtpExportBatches($this)
                ->count($con);
        }

        return count($this->collFtpExportLogss);
    }

    /**
     * Method called to associate a ChildFtpExportLogs object to this object
     * through the ChildFtpExportLogs foreign key attribute.
     *
     * @param ChildFtpExportLogs $l ChildFtpExportLogs
     * @return $this The current object (for fluent API support)
     */
    public function addFtpExportLogs(ChildFtpExportLogs $l)
    {
        if ($this->collFtpExportLogss === null) {
            $this->initFtpExportLogss();
            $this->collFtpExportLogssPartial = true;
        }

        if (!$this->collFtpExportLogss->contains($l)) {
            $this->doAddFtpExportLogs($l);

            if ($this->ftpExportLogssScheduledForDeletion and $this->ftpExportLogssScheduledForDeletion->contains($l)) {
                $this->ftpExportLogssScheduledForDeletion->remove($this->ftpExportLogssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildFtpExportLogs $ftpExportLogs The ChildFtpExportLogs object to add.
     */
    protected function doAddFtpExportLogs(ChildFtpExportLogs $ftpExportLogs): void
    {
        $this->collFtpExportLogss[]= $ftpExportLogs;
        $ftpExportLogs->setFtpExportBatches($this);
    }

    /**
     * @param ChildFtpExportLogs $ftpExportLogs The ChildFtpExportLogs object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeFtpExportLogs(ChildFtpExportLogs $ftpExportLogs)
    {
        if ($this->getFtpExportLogss()->contains($ftpExportLogs)) {
            $pos = $this->collFtpExportLogss->search($ftpExportLogs);
            $this->collFtpExportLogss->remove($pos);
            if (null === $this->ftpExportLogssScheduledForDeletion) {
                $this->ftpExportLogssScheduledForDeletion = clone $this->collFtpExportLogss;
                $this->ftpExportLogssScheduledForDeletion->clear();
            }
            $this->ftpExportLogssScheduledForDeletion[]= $ftpExportLogs;
            $ftpExportLogs->setFtpExportBatches(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this FtpExportBatches is new, it will return
     * an empty collection; or if this FtpExportBatches has previously
     * been saved, it will retrieve related FtpExportLogss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in FtpExportBatches.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildFtpExportLogs[] List of ChildFtpExportLogs objects
     * @phpstan-return ObjectCollection&\Traversable<ChildFtpExportLogs}> List of ChildFtpExportLogs objects
     */
    public function getFtpExportLogssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildFtpExportLogsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getFtpExportLogss($query, $con);
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
            $this->aCompany->removeFtpExportBatches($this);
        }
        $this->ftp_export_batch_id = null;
        $this->label = null;
        $this->attached_function = null;
        $this->next_date = null;
        $this->interval_days = null;
        $this->ftp_path = null;
        $this->isenabled = null;
        $this->company_id = null;
        $this->created_at = null;
        $this->file_name_format = null;
        $this->is_file_processing = null;
        $this->ftp_order = null;
        $this->interval_type = null;
        $this->start_date = null;
        $this->end_date = null;
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
            if ($this->collFtpExportLogss) {
                foreach ($this->collFtpExportLogss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collFtpExportLogss = null;
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
        return (string) $this->exportTo(FtpExportBatchesTableMap::DEFAULT_STRING_FORMAT);
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
