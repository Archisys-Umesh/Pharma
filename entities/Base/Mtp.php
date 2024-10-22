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
use entities\Employee as ChildEmployee;
use entities\EmployeeQuery as ChildEmployeeQuery;
use entities\Mtp as ChildMtp;
use entities\MtpDay as ChildMtpDay;
use entities\MtpDayQuery as ChildMtpDayQuery;
use entities\MtpLogs as ChildMtpLogs;
use entities\MtpLogsQuery as ChildMtpLogsQuery;
use entities\MtpQuery as ChildMtpQuery;
use entities\Positions as ChildPositions;
use entities\PositionsQuery as ChildPositionsQuery;
use entities\Tourplans as ChildTourplans;
use entities\TourplansQuery as ChildTourplansQuery;
use entities\Map\MtpDayTableMap;
use entities\Map\MtpLogsTableMap;
use entities\Map\MtpTableMap;
use entities\Map\TourplansTableMap;

/**
 * Base class that represents a row from the 'mtp' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class Mtp implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\MtpTableMap';


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
     * The value for the mtp_id field.
     *
     * @var        int
     */
    protected $mtp_id;

    /**
     * The value for the position_id field.
     *
     * @var        int
     */
    protected $position_id;

    /**
     * The value for the company_id field.
     *
     * @var        int
     */
    protected $company_id;

    /**
     * The value for the month field.
     *
     * @var        string|null
     */
    protected $month;

    /**
     * The value for the mtp_status field.
     *
     * @var        string|null
     */
    protected $mtp_status;

    /**
     * The value for the mtp_approved_by field.
     *
     * @var        int|null
     */
    protected $mtp_approved_by;

    /**
     * The value for the approved_date field.
     *
     * @var        DateTime|null
     */
    protected $approved_date;

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
     * The value for the outlets_covered field.
     *
     * @var        int|null
     */
    protected $outlets_covered;

    /**
     * The value for the month_days field.
     *
     * @var        int|null
     */
    protected $month_days;

    /**
     * The value for the working_days field.
     *
     * @var        int|null
     */
    protected $working_days;

    /**
     * The value for the agenda_days field.
     *
     * @var        string|null
     */
    protected $agenda_days;

    /**
     * The value for the total_outlets field.
     *
     * @var        string|null
     */
    protected $total_outlets;

    /**
     * The value for the total_visits field.
     *
     * @var        int|null
     */
    protected $total_visits;

    /**
     * The value for the visits_fq field.
     *
     * @var        int|null
     */
    protected $visits_fq;

    /**
     * The value for the is_processed field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $is_processed;

    /**
     * The value for the is_mtp_generating field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $is_mtp_generating;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildEmployee
     */
    protected $aEmployee;

    /**
     * @var        ChildPositions
     */
    protected $aPositions;

    /**
     * @var        ObjectCollection|ChildMtpDay[] Collection to store aggregation of ChildMtpDay objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildMtpDay> Collection to store aggregation of ChildMtpDay objects.
     */
    protected $collMtpDays;
    protected $collMtpDaysPartial;

    /**
     * @var        ObjectCollection|ChildMtpLogs[] Collection to store aggregation of ChildMtpLogs objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildMtpLogs> Collection to store aggregation of ChildMtpLogs objects.
     */
    protected $collMtpLogss;
    protected $collMtpLogssPartial;

    /**
     * @var        ObjectCollection|ChildTourplans[] Collection to store aggregation of ChildTourplans objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildTourplans> Collection to store aggregation of ChildTourplans objects.
     */
    protected $collTourplanss;
    protected $collTourplanssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildMtpDay[]
     * @phpstan-var ObjectCollection&\Traversable<ChildMtpDay>
     */
    protected $mtpDaysScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildMtpLogs[]
     * @phpstan-var ObjectCollection&\Traversable<ChildMtpLogs>
     */
    protected $mtpLogssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildTourplans[]
     * @phpstan-var ObjectCollection&\Traversable<ChildTourplans>
     */
    protected $tourplanssScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->is_processed = false;
        $this->is_mtp_generating = false;
    }

    /**
     * Initializes internal state of entities\Base\Mtp object.
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
     * Compares this with another <code>Mtp</code> instance.  If
     * <code>obj</code> is an instance of <code>Mtp</code>, delegates to
     * <code>equals(Mtp)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [mtp_id] column value.
     *
     * @return int
     */
    public function getMtpId()
    {
        return $this->mtp_id;
    }

    /**
     * Get the [position_id] column value.
     *
     * @return int
     */
    public function getPositionId()
    {
        return $this->position_id;
    }

    /**
     * Get the [company_id] column value.
     *
     * @return int
     */
    public function getCompanyId()
    {
        return $this->company_id;
    }

    /**
     * Get the [month] column value.
     *
     * @return string|null
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Get the [mtp_status] column value.
     *
     * @return string|null
     */
    public function getMtpStatus()
    {
        return $this->mtp_status;
    }

    /**
     * Get the [mtp_approved_by] column value.
     *
     * @return int|null
     */
    public function getMtpApprovedBy()
    {
        return $this->mtp_approved_by;
    }

    /**
     * Get the [optionally formatted] temporal [approved_date] column value.
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
    public function getApprovedDate($format = null)
    {
        if ($format === null) {
            return $this->approved_date;
        } else {
            return $this->approved_date instanceof \DateTimeInterface ? $this->approved_date->format($format) : null;
        }
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
     * Get the [outlets_covered] column value.
     *
     * @return int|null
     */
    public function getOutletsCovered()
    {
        return $this->outlets_covered;
    }

    /**
     * Get the [month_days] column value.
     *
     * @return int|null
     */
    public function getMonthDays()
    {
        return $this->month_days;
    }

    /**
     * Get the [working_days] column value.
     *
     * @return int|null
     */
    public function getWorkingDays()
    {
        return $this->working_days;
    }

    /**
     * Get the [agenda_days] column value.
     *
     * @param bool $asArray Returns the JSON data as array instead of object

     * @return object|array|null
     */
    public function getAgendaDays($asArray = true)
    {
        return json_decode($this->agenda_days, $asArray);
    }

    /**
     * Get the [total_outlets] column value.
     *
     * @param bool $asArray Returns the JSON data as array instead of object

     * @return object|array|null
     */
    public function getTotalOutlets($asArray = true)
    {
        return json_decode($this->total_outlets, $asArray);
    }

    /**
     * Get the [total_visits] column value.
     *
     * @return int|null
     */
    public function getTotalVisits()
    {
        return $this->total_visits;
    }

    /**
     * Get the [visits_fq] column value.
     *
     * @return int|null
     */
    public function getVisitsFq()
    {
        return $this->visits_fq;
    }

    /**
     * Get the [is_processed] column value.
     *
     * @return boolean|null
     */
    public function getIsProcessed()
    {
        return $this->is_processed;
    }

    /**
     * Get the [is_processed] column value.
     *
     * @return boolean|null
     */
    public function isProcessed()
    {
        return $this->getIsProcessed();
    }

    /**
     * Get the [is_mtp_generating] column value.
     *
     * @return boolean|null
     */
    public function getIsMtpGenerating()
    {
        return $this->is_mtp_generating;
    }

    /**
     * Get the [is_mtp_generating] column value.
     *
     * @return boolean|null
     */
    public function isMtpGenerating()
    {
        return $this->getIsMtpGenerating();
    }

    /**
     * Set the value of [mtp_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMtpId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->mtp_id !== $v) {
            $this->mtp_id = $v;
            $this->modifiedColumns[MtpTableMap::COL_MTP_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [position_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPositionId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->position_id !== $v) {
            $this->position_id = $v;
            $this->modifiedColumns[MtpTableMap::COL_POSITION_ID] = true;
        }

        if ($this->aPositions !== null && $this->aPositions->getPositionId() !== $v) {
            $this->aPositions = null;
        }

        return $this;
    }

    /**
     * Set the value of [company_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCompanyId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->company_id !== $v) {
            $this->company_id = $v;
            $this->modifiedColumns[MtpTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [month] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMonth($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->month !== $v) {
            $this->month = $v;
            $this->modifiedColumns[MtpTableMap::COL_MONTH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [mtp_status] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMtpStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mtp_status !== $v) {
            $this->mtp_status = $v;
            $this->modifiedColumns[MtpTableMap::COL_MTP_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [mtp_approved_by] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMtpApprovedBy($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->mtp_approved_by !== $v) {
            $this->mtp_approved_by = $v;
            $this->modifiedColumns[MtpTableMap::COL_MTP_APPROVED_BY] = true;
        }

        if ($this->aEmployee !== null && $this->aEmployee->getEmployeeId() !== $v) {
            $this->aEmployee = null;
        }

        return $this;
    }

    /**
     * Sets the value of [approved_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setApprovedDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->approved_date !== null || $dt !== null) {
            if ($this->approved_date === null || $dt === null || $dt->format("Y-m-d") !== $this->approved_date->format("Y-m-d")) {
                $this->approved_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[MtpTableMap::COL_APPROVED_DATE] = true;
            }
        } // if either are not null

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
                $this->modifiedColumns[MtpTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[MtpTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [outlets_covered] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletsCovered($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlets_covered !== $v) {
            $this->outlets_covered = $v;
            $this->modifiedColumns[MtpTableMap::COL_OUTLETS_COVERED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [month_days] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMonthDays($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->month_days !== $v) {
            $this->month_days = $v;
            $this->modifiedColumns[MtpTableMap::COL_MONTH_DAYS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [working_days] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWorkingDays($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->working_days !== $v) {
            $this->working_days = $v;
            $this->modifiedColumns[MtpTableMap::COL_WORKING_DAYS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [agenda_days] column.
     *
     * @param string|array|object|null $v new value
     * @return $this The current object (for fluent API support)
     */
    public function setAgendaDays($v)
    {
        if (is_string($v)) {
            // JSON as string needs to be decoded/encoded to get a reliable comparison (spaces, ...)
            $v = json_decode($v);
        }
        $encodedValue = json_encode($v);
        if ($encodedValue !== $this->agenda_days) {
            $this->agenda_days = $encodedValue;
            $this->modifiedColumns[MtpTableMap::COL_AGENDA_DAYS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [total_outlets] column.
     *
     * @param string|array|object|null $v new value
     * @return $this The current object (for fluent API support)
     */
    public function setTotalOutlets($v)
    {
        if (is_string($v)) {
            // JSON as string needs to be decoded/encoded to get a reliable comparison (spaces, ...)
            $v = json_decode($v);
        }
        $encodedValue = json_encode($v);
        if ($encodedValue !== $this->total_outlets) {
            $this->total_outlets = $encodedValue;
            $this->modifiedColumns[MtpTableMap::COL_TOTAL_OUTLETS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [total_visits] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTotalVisits($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->total_visits !== $v) {
            $this->total_visits = $v;
            $this->modifiedColumns[MtpTableMap::COL_TOTAL_VISITS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [visits_fq] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setVisitsFq($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->visits_fq !== $v) {
            $this->visits_fq = $v;
            $this->modifiedColumns[MtpTableMap::COL_VISITS_FQ] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_processed] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsProcessed($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_processed !== $v) {
            $this->is_processed = $v;
            $this->modifiedColumns[MtpTableMap::COL_IS_PROCESSED] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_mtp_generating] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsMtpGenerating($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_mtp_generating !== $v) {
            $this->is_mtp_generating = $v;
            $this->modifiedColumns[MtpTableMap::COL_IS_MTP_GENERATING] = true;
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
            if ($this->is_processed !== false) {
                return false;
            }

            if ($this->is_mtp_generating !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : MtpTableMap::translateFieldName('MtpId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mtp_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : MtpTableMap::translateFieldName('PositionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : MtpTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : MtpTableMap::translateFieldName('Month', TableMap::TYPE_PHPNAME, $indexType)];
            $this->month = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : MtpTableMap::translateFieldName('MtpStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mtp_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : MtpTableMap::translateFieldName('MtpApprovedBy', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mtp_approved_by = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : MtpTableMap::translateFieldName('ApprovedDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->approved_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : MtpTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : MtpTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : MtpTableMap::translateFieldName('OutletsCovered', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlets_covered = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : MtpTableMap::translateFieldName('MonthDays', TableMap::TYPE_PHPNAME, $indexType)];
            $this->month_days = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : MtpTableMap::translateFieldName('WorkingDays', TableMap::TYPE_PHPNAME, $indexType)];
            $this->working_days = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : MtpTableMap::translateFieldName('AgendaDays', TableMap::TYPE_PHPNAME, $indexType)];
            $this->agenda_days = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : MtpTableMap::translateFieldName('TotalOutlets', TableMap::TYPE_PHPNAME, $indexType)];
            $this->total_outlets = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : MtpTableMap::translateFieldName('TotalVisits', TableMap::TYPE_PHPNAME, $indexType)];
            $this->total_visits = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : MtpTableMap::translateFieldName('VisitsFq', TableMap::TYPE_PHPNAME, $indexType)];
            $this->visits_fq = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : MtpTableMap::translateFieldName('IsProcessed', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_processed = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : MtpTableMap::translateFieldName('IsMtpGenerating', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_mtp_generating = (null !== $col) ? (boolean) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 18; // 18 = MtpTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\Mtp'), 0, $e);
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
        if ($this->aPositions !== null && $this->position_id !== $this->aPositions->getPositionId()) {
            $this->aPositions = null;
        }
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
        }
        if ($this->aEmployee !== null && $this->mtp_approved_by !== $this->aEmployee->getEmployeeId()) {
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
            $con = Propel::getServiceContainer()->getReadConnection(MtpTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildMtpQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->aEmployee = null;
            $this->aPositions = null;
            $this->collMtpDays = null;

            $this->collMtpLogss = null;

            $this->collTourplanss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Mtp::setDeleted()
     * @see Mtp::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(MtpTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildMtpQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(MtpTableMap::DATABASE_NAME);
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
                MtpTableMap::addInstanceToPool($this);
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

            if ($this->aPositions !== null) {
                if ($this->aPositions->isModified() || $this->aPositions->isNew()) {
                    $affectedRows += $this->aPositions->save($con);
                }
                $this->setPositions($this->aPositions);
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

            if ($this->mtpDaysScheduledForDeletion !== null) {
                if (!$this->mtpDaysScheduledForDeletion->isEmpty()) {
                    foreach ($this->mtpDaysScheduledForDeletion as $mtpDay) {
                        // need to save related object because we set the relation to null
                        $mtpDay->save($con);
                    }
                    $this->mtpDaysScheduledForDeletion = null;
                }
            }

            if ($this->collMtpDays !== null) {
                foreach ($this->collMtpDays as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->mtpLogssScheduledForDeletion !== null) {
                if (!$this->mtpLogssScheduledForDeletion->isEmpty()) {
                    foreach ($this->mtpLogssScheduledForDeletion as $mtpLogs) {
                        // need to save related object because we set the relation to null
                        $mtpLogs->save($con);
                    }
                    $this->mtpLogssScheduledForDeletion = null;
                }
            }

            if ($this->collMtpLogss !== null) {
                foreach ($this->collMtpLogss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tourplanssScheduledForDeletion !== null) {
                if (!$this->tourplanssScheduledForDeletion->isEmpty()) {
                    \entities\TourplansQuery::create()
                        ->filterByPrimaryKeys($this->tourplanssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tourplanssScheduledForDeletion = null;
                }
            }

            if ($this->collTourplanss !== null) {
                foreach ($this->collTourplanss as $referrerFK) {
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

        $this->modifiedColumns[MtpTableMap::COL_MTP_ID] = true;
        if (null !== $this->mtp_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . MtpTableMap::COL_MTP_ID . ')');
        }
        if (null === $this->mtp_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('mtp_mtp_id_seq')");
                $this->mtp_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(MtpTableMap::COL_MTP_ID)) {
            $modifiedColumns[':p' . $index++]  = 'mtp_id';
        }
        if ($this->isColumnModified(MtpTableMap::COL_POSITION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'position_id';
        }
        if ($this->isColumnModified(MtpTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(MtpTableMap::COL_MONTH)) {
            $modifiedColumns[':p' . $index++]  = 'month';
        }
        if ($this->isColumnModified(MtpTableMap::COL_MTP_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'mtp_status';
        }
        if ($this->isColumnModified(MtpTableMap::COL_MTP_APPROVED_BY)) {
            $modifiedColumns[':p' . $index++]  = 'mtp_approved_by';
        }
        if ($this->isColumnModified(MtpTableMap::COL_APPROVED_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'approved_date';
        }
        if ($this->isColumnModified(MtpTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(MtpTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(MtpTableMap::COL_OUTLETS_COVERED)) {
            $modifiedColumns[':p' . $index++]  = 'outlets_covered';
        }
        if ($this->isColumnModified(MtpTableMap::COL_MONTH_DAYS)) {
            $modifiedColumns[':p' . $index++]  = 'month_days';
        }
        if ($this->isColumnModified(MtpTableMap::COL_WORKING_DAYS)) {
            $modifiedColumns[':p' . $index++]  = 'working_days';
        }
        if ($this->isColumnModified(MtpTableMap::COL_AGENDA_DAYS)) {
            $modifiedColumns[':p' . $index++]  = 'agenda_days';
        }
        if ($this->isColumnModified(MtpTableMap::COL_TOTAL_OUTLETS)) {
            $modifiedColumns[':p' . $index++]  = 'total_outlets';
        }
        if ($this->isColumnModified(MtpTableMap::COL_TOTAL_VISITS)) {
            $modifiedColumns[':p' . $index++]  = 'total_visits';
        }
        if ($this->isColumnModified(MtpTableMap::COL_VISITS_FQ)) {
            $modifiedColumns[':p' . $index++]  = 'visits_fq';
        }
        if ($this->isColumnModified(MtpTableMap::COL_IS_PROCESSED)) {
            $modifiedColumns[':p' . $index++]  = 'is_processed';
        }
        if ($this->isColumnModified(MtpTableMap::COL_IS_MTP_GENERATING)) {
            $modifiedColumns[':p' . $index++]  = 'is_mtp_generating';
        }

        $sql = sprintf(
            'INSERT INTO mtp (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'mtp_id':
                        $stmt->bindValue($identifier, $this->mtp_id, PDO::PARAM_INT);

                        break;
                    case 'position_id':
                        $stmt->bindValue($identifier, $this->position_id, PDO::PARAM_INT);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'month':
                        $stmt->bindValue($identifier, $this->month, PDO::PARAM_STR);

                        break;
                    case 'mtp_status':
                        $stmt->bindValue($identifier, $this->mtp_status, PDO::PARAM_STR);

                        break;
                    case 'mtp_approved_by':
                        $stmt->bindValue($identifier, $this->mtp_approved_by, PDO::PARAM_INT);

                        break;
                    case 'approved_date':
                        $stmt->bindValue($identifier, $this->approved_date ? $this->approved_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'outlets_covered':
                        $stmt->bindValue($identifier, $this->outlets_covered, PDO::PARAM_INT);

                        break;
                    case 'month_days':
                        $stmt->bindValue($identifier, $this->month_days, PDO::PARAM_INT);

                        break;
                    case 'working_days':
                        $stmt->bindValue($identifier, $this->working_days, PDO::PARAM_INT);

                        break;
                    case 'agenda_days':
                        $stmt->bindValue($identifier, $this->agenda_days, PDO::PARAM_STR);

                        break;
                    case 'total_outlets':
                        $stmt->bindValue($identifier, $this->total_outlets, PDO::PARAM_STR);

                        break;
                    case 'total_visits':
                        $stmt->bindValue($identifier, $this->total_visits, PDO::PARAM_INT);

                        break;
                    case 'visits_fq':
                        $stmt->bindValue($identifier, $this->visits_fq, PDO::PARAM_INT);

                        break;
                    case 'is_processed':
                        $stmt->bindValue($identifier, $this->is_processed, PDO::PARAM_BOOL);

                        break;
                    case 'is_mtp_generating':
                        $stmt->bindValue($identifier, $this->is_mtp_generating, PDO::PARAM_BOOL);

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
        $pos = MtpTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getMtpId();

            case 1:
                return $this->getPositionId();

            case 2:
                return $this->getCompanyId();

            case 3:
                return $this->getMonth();

            case 4:
                return $this->getMtpStatus();

            case 5:
                return $this->getMtpApprovedBy();

            case 6:
                return $this->getApprovedDate();

            case 7:
                return $this->getCreatedAt();

            case 8:
                return $this->getUpdatedAt();

            case 9:
                return $this->getOutletsCovered();

            case 10:
                return $this->getMonthDays();

            case 11:
                return $this->getWorkingDays();

            case 12:
                return $this->getAgendaDays();

            case 13:
                return $this->getTotalOutlets();

            case 14:
                return $this->getTotalVisits();

            case 15:
                return $this->getVisitsFq();

            case 16:
                return $this->getIsProcessed();

            case 17:
                return $this->getIsMtpGenerating();

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
        if (isset($alreadyDumpedObjects['Mtp'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Mtp'][$this->hashCode()] = true;
        $keys = MtpTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getMtpId(),
            $keys[1] => $this->getPositionId(),
            $keys[2] => $this->getCompanyId(),
            $keys[3] => $this->getMonth(),
            $keys[4] => $this->getMtpStatus(),
            $keys[5] => $this->getMtpApprovedBy(),
            $keys[6] => $this->getApprovedDate(),
            $keys[7] => $this->getCreatedAt(),
            $keys[8] => $this->getUpdatedAt(),
            $keys[9] => $this->getOutletsCovered(),
            $keys[10] => $this->getMonthDays(),
            $keys[11] => $this->getWorkingDays(),
            $keys[12] => $this->getAgendaDays(),
            $keys[13] => $this->getTotalOutlets(),
            $keys[14] => $this->getTotalVisits(),
            $keys[15] => $this->getVisitsFq(),
            $keys[16] => $this->getIsProcessed(),
            $keys[17] => $this->getIsMtpGenerating(),
        ];
        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('Y-m-d');
        }

        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('Y-m-d H:i:s.u');
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
            if (null !== $this->aPositions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'positions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'positions';
                        break;
                    default:
                        $key = 'Positions';
                }

                $result[$key] = $this->aPositions->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collMtpDays) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'mtpDays';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'mtp_days';
                        break;
                    default:
                        $key = 'MtpDays';
                }

                $result[$key] = $this->collMtpDays->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collMtpLogss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'mtpLogss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'mtp_logss';
                        break;
                    default:
                        $key = 'MtpLogss';
                }

                $result[$key] = $this->collMtpLogss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTourplanss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'tourplanss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tourplanss';
                        break;
                    default:
                        $key = 'Tourplanss';
                }

                $result[$key] = $this->collTourplanss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = MtpTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setMtpId($value);
                break;
            case 1:
                $this->setPositionId($value);
                break;
            case 2:
                $this->setCompanyId($value);
                break;
            case 3:
                $this->setMonth($value);
                break;
            case 4:
                $this->setMtpStatus($value);
                break;
            case 5:
                $this->setMtpApprovedBy($value);
                break;
            case 6:
                $this->setApprovedDate($value);
                break;
            case 7:
                $this->setCreatedAt($value);
                break;
            case 8:
                $this->setUpdatedAt($value);
                break;
            case 9:
                $this->setOutletsCovered($value);
                break;
            case 10:
                $this->setMonthDays($value);
                break;
            case 11:
                $this->setWorkingDays($value);
                break;
            case 12:
                $this->setAgendaDays($value);
                break;
            case 13:
                $this->setTotalOutlets($value);
                break;
            case 14:
                $this->setTotalVisits($value);
                break;
            case 15:
                $this->setVisitsFq($value);
                break;
            case 16:
                $this->setIsProcessed($value);
                break;
            case 17:
                $this->setIsMtpGenerating($value);
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
        $keys = MtpTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setMtpId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setPositionId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setCompanyId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setMonth($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setMtpStatus($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setMtpApprovedBy($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setApprovedDate($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCreatedAt($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setUpdatedAt($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setOutletsCovered($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setMonthDays($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setWorkingDays($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setAgendaDays($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setTotalOutlets($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setTotalVisits($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setVisitsFq($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setIsProcessed($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setIsMtpGenerating($arr[$keys[17]]);
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
        $criteria = new Criteria(MtpTableMap::DATABASE_NAME);

        if ($this->isColumnModified(MtpTableMap::COL_MTP_ID)) {
            $criteria->add(MtpTableMap::COL_MTP_ID, $this->mtp_id);
        }
        if ($this->isColumnModified(MtpTableMap::COL_POSITION_ID)) {
            $criteria->add(MtpTableMap::COL_POSITION_ID, $this->position_id);
        }
        if ($this->isColumnModified(MtpTableMap::COL_COMPANY_ID)) {
            $criteria->add(MtpTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(MtpTableMap::COL_MONTH)) {
            $criteria->add(MtpTableMap::COL_MONTH, $this->month);
        }
        if ($this->isColumnModified(MtpTableMap::COL_MTP_STATUS)) {
            $criteria->add(MtpTableMap::COL_MTP_STATUS, $this->mtp_status);
        }
        if ($this->isColumnModified(MtpTableMap::COL_MTP_APPROVED_BY)) {
            $criteria->add(MtpTableMap::COL_MTP_APPROVED_BY, $this->mtp_approved_by);
        }
        if ($this->isColumnModified(MtpTableMap::COL_APPROVED_DATE)) {
            $criteria->add(MtpTableMap::COL_APPROVED_DATE, $this->approved_date);
        }
        if ($this->isColumnModified(MtpTableMap::COL_CREATED_AT)) {
            $criteria->add(MtpTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(MtpTableMap::COL_UPDATED_AT)) {
            $criteria->add(MtpTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(MtpTableMap::COL_OUTLETS_COVERED)) {
            $criteria->add(MtpTableMap::COL_OUTLETS_COVERED, $this->outlets_covered);
        }
        if ($this->isColumnModified(MtpTableMap::COL_MONTH_DAYS)) {
            $criteria->add(MtpTableMap::COL_MONTH_DAYS, $this->month_days);
        }
        if ($this->isColumnModified(MtpTableMap::COL_WORKING_DAYS)) {
            $criteria->add(MtpTableMap::COL_WORKING_DAYS, $this->working_days);
        }
        if ($this->isColumnModified(MtpTableMap::COL_AGENDA_DAYS)) {
            $criteria->add(MtpTableMap::COL_AGENDA_DAYS, $this->agenda_days);
        }
        if ($this->isColumnModified(MtpTableMap::COL_TOTAL_OUTLETS)) {
            $criteria->add(MtpTableMap::COL_TOTAL_OUTLETS, $this->total_outlets);
        }
        if ($this->isColumnModified(MtpTableMap::COL_TOTAL_VISITS)) {
            $criteria->add(MtpTableMap::COL_TOTAL_VISITS, $this->total_visits);
        }
        if ($this->isColumnModified(MtpTableMap::COL_VISITS_FQ)) {
            $criteria->add(MtpTableMap::COL_VISITS_FQ, $this->visits_fq);
        }
        if ($this->isColumnModified(MtpTableMap::COL_IS_PROCESSED)) {
            $criteria->add(MtpTableMap::COL_IS_PROCESSED, $this->is_processed);
        }
        if ($this->isColumnModified(MtpTableMap::COL_IS_MTP_GENERATING)) {
            $criteria->add(MtpTableMap::COL_IS_MTP_GENERATING, $this->is_mtp_generating);
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
        $criteria = ChildMtpQuery::create();
        $criteria->add(MtpTableMap::COL_MTP_ID, $this->mtp_id);

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
        $validPk = null !== $this->getMtpId();

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
        return $this->getMtpId();
    }

    /**
     * Generic method to set the primary key (mtp_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setMtpId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getMtpId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\Mtp (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setPositionId($this->getPositionId());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setMonth($this->getMonth());
        $copyObj->setMtpStatus($this->getMtpStatus());
        $copyObj->setMtpApprovedBy($this->getMtpApprovedBy());
        $copyObj->setApprovedDate($this->getApprovedDate());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setOutletsCovered($this->getOutletsCovered());
        $copyObj->setMonthDays($this->getMonthDays());
        $copyObj->setWorkingDays($this->getWorkingDays());
        $copyObj->setAgendaDays($this->getAgendaDays());
        $copyObj->setTotalOutlets($this->getTotalOutlets());
        $copyObj->setTotalVisits($this->getTotalVisits());
        $copyObj->setVisitsFq($this->getVisitsFq());
        $copyObj->setIsProcessed($this->getIsProcessed());
        $copyObj->setIsMtpGenerating($this->getIsMtpGenerating());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getMtpDays() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMtpDay($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getMtpLogss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMtpLogs($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTourplanss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTourplans($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setMtpId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\Mtp Clone of current object.
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
     * @param ChildCompany $v
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
            $v->addMtp($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCompany object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildCompany The associated ChildCompany object.
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
                $this->aCompany->addMtps($this);
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
            $this->setMtpApprovedBy(NULL);
        } else {
            $this->setMtpApprovedBy($v->getEmployeeId());
        }

        $this->aEmployee = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildEmployee object, it will not be re-added.
        if ($v !== null) {
            $v->addMtp($this);
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
        if ($this->aEmployee === null && ($this->mtp_approved_by != 0)) {
            $this->aEmployee = ChildEmployeeQuery::create()->findPk($this->mtp_approved_by, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEmployee->addMtps($this);
             */
        }

        return $this->aEmployee;
    }

    /**
     * Declares an association between this object and a ChildPositions object.
     *
     * @param ChildPositions $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setPositions(ChildPositions $v = null)
    {
        if ($v === null) {
            $this->setPositionId(NULL);
        } else {
            $this->setPositionId($v->getPositionId());
        }

        $this->aPositions = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPositions object, it will not be re-added.
        if ($v !== null) {
            $v->addMtp($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPositions object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildPositions The associated ChildPositions object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPositions(?ConnectionInterface $con = null)
    {
        if ($this->aPositions === null && ($this->position_id != 0)) {
            $this->aPositions = ChildPositionsQuery::create()->findPk($this->position_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPositions->addMtps($this);
             */
        }

        return $this->aPositions;
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
        if ('MtpDay' === $relationName) {
            $this->initMtpDays();
            return;
        }
        if ('MtpLogs' === $relationName) {
            $this->initMtpLogss();
            return;
        }
        if ('Tourplans' === $relationName) {
            $this->initTourplanss();
            return;
        }
    }

    /**
     * Clears out the collMtpDays collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addMtpDays()
     */
    public function clearMtpDays()
    {
        $this->collMtpDays = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collMtpDays collection loaded partially.
     *
     * @return void
     */
    public function resetPartialMtpDays($v = true): void
    {
        $this->collMtpDaysPartial = $v;
    }

    /**
     * Initializes the collMtpDays collection.
     *
     * By default this just sets the collMtpDays collection to an empty array (like clearcollMtpDays());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMtpDays(bool $overrideExisting = true): void
    {
        if (null !== $this->collMtpDays && !$overrideExisting) {
            return;
        }

        $collectionClassName = MtpDayTableMap::getTableMap()->getCollectionClassName();

        $this->collMtpDays = new $collectionClassName;
        $this->collMtpDays->setModel('\entities\MtpDay');
    }

    /**
     * Gets an array of ChildMtpDay objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildMtp is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildMtpDay[] List of ChildMtpDay objects
     * @phpstan-return ObjectCollection&\Traversable<ChildMtpDay> List of ChildMtpDay objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getMtpDays(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collMtpDaysPartial && !$this->isNew();
        if (null === $this->collMtpDays || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collMtpDays) {
                    $this->initMtpDays();
                } else {
                    $collectionClassName = MtpDayTableMap::getTableMap()->getCollectionClassName();

                    $collMtpDays = new $collectionClassName;
                    $collMtpDays->setModel('\entities\MtpDay');

                    return $collMtpDays;
                }
            } else {
                $collMtpDays = ChildMtpDayQuery::create(null, $criteria)
                    ->filterByMtp($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collMtpDaysPartial && count($collMtpDays)) {
                        $this->initMtpDays(false);

                        foreach ($collMtpDays as $obj) {
                            if (false == $this->collMtpDays->contains($obj)) {
                                $this->collMtpDays->append($obj);
                            }
                        }

                        $this->collMtpDaysPartial = true;
                    }

                    return $collMtpDays;
                }

                if ($partial && $this->collMtpDays) {
                    foreach ($this->collMtpDays as $obj) {
                        if ($obj->isNew()) {
                            $collMtpDays[] = $obj;
                        }
                    }
                }

                $this->collMtpDays = $collMtpDays;
                $this->collMtpDaysPartial = false;
            }
        }

        return $this->collMtpDays;
    }

    /**
     * Sets a collection of ChildMtpDay objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $mtpDays A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setMtpDays(Collection $mtpDays, ?ConnectionInterface $con = null)
    {
        /** @var ChildMtpDay[] $mtpDaysToDelete */
        $mtpDaysToDelete = $this->getMtpDays(new Criteria(), $con)->diff($mtpDays);


        $this->mtpDaysScheduledForDeletion = $mtpDaysToDelete;

        foreach ($mtpDaysToDelete as $mtpDayRemoved) {
            $mtpDayRemoved->setMtp(null);
        }

        $this->collMtpDays = null;
        foreach ($mtpDays as $mtpDay) {
            $this->addMtpDay($mtpDay);
        }

        $this->collMtpDays = $mtpDays;
        $this->collMtpDaysPartial = false;

        return $this;
    }

    /**
     * Returns the number of related MtpDay objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related MtpDay objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countMtpDays(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collMtpDaysPartial && !$this->isNew();
        if (null === $this->collMtpDays || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMtpDays) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getMtpDays());
            }

            $query = ChildMtpDayQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByMtp($this)
                ->count($con);
        }

        return count($this->collMtpDays);
    }

    /**
     * Method called to associate a ChildMtpDay object to this object
     * through the ChildMtpDay foreign key attribute.
     *
     * @param ChildMtpDay $l ChildMtpDay
     * @return $this The current object (for fluent API support)
     */
    public function addMtpDay(ChildMtpDay $l)
    {
        if ($this->collMtpDays === null) {
            $this->initMtpDays();
            $this->collMtpDaysPartial = true;
        }

        if (!$this->collMtpDays->contains($l)) {
            $this->doAddMtpDay($l);

            if ($this->mtpDaysScheduledForDeletion and $this->mtpDaysScheduledForDeletion->contains($l)) {
                $this->mtpDaysScheduledForDeletion->remove($this->mtpDaysScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildMtpDay $mtpDay The ChildMtpDay object to add.
     */
    protected function doAddMtpDay(ChildMtpDay $mtpDay): void
    {
        $this->collMtpDays[]= $mtpDay;
        $mtpDay->setMtp($this);
    }

    /**
     * @param ChildMtpDay $mtpDay The ChildMtpDay object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeMtpDay(ChildMtpDay $mtpDay)
    {
        if ($this->getMtpDays()->contains($mtpDay)) {
            $pos = $this->collMtpDays->search($mtpDay);
            $this->collMtpDays->remove($pos);
            if (null === $this->mtpDaysScheduledForDeletion) {
                $this->mtpDaysScheduledForDeletion = clone $this->collMtpDays;
                $this->mtpDaysScheduledForDeletion->clear();
            }
            $this->mtpDaysScheduledForDeletion[]= $mtpDay;
            $mtpDay->setMtp(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Mtp is new, it will return
     * an empty collection; or if this Mtp has previously
     * been saved, it will retrieve related MtpDays from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Mtp.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildMtpDay[] List of ChildMtpDay objects
     * @phpstan-return ObjectCollection&\Traversable<ChildMtpDay}> List of ChildMtpDay objects
     */
    public function getMtpDaysJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildMtpDayQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getMtpDays($query, $con);
    }

    /**
     * Clears out the collMtpLogss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addMtpLogss()
     */
    public function clearMtpLogss()
    {
        $this->collMtpLogss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collMtpLogss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialMtpLogss($v = true): void
    {
        $this->collMtpLogssPartial = $v;
    }

    /**
     * Initializes the collMtpLogss collection.
     *
     * By default this just sets the collMtpLogss collection to an empty array (like clearcollMtpLogss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMtpLogss(bool $overrideExisting = true): void
    {
        if (null !== $this->collMtpLogss && !$overrideExisting) {
            return;
        }

        $collectionClassName = MtpLogsTableMap::getTableMap()->getCollectionClassName();

        $this->collMtpLogss = new $collectionClassName;
        $this->collMtpLogss->setModel('\entities\MtpLogs');
    }

    /**
     * Gets an array of ChildMtpLogs objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildMtp is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildMtpLogs[] List of ChildMtpLogs objects
     * @phpstan-return ObjectCollection&\Traversable<ChildMtpLogs> List of ChildMtpLogs objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getMtpLogss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collMtpLogssPartial && !$this->isNew();
        if (null === $this->collMtpLogss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collMtpLogss) {
                    $this->initMtpLogss();
                } else {
                    $collectionClassName = MtpLogsTableMap::getTableMap()->getCollectionClassName();

                    $collMtpLogss = new $collectionClassName;
                    $collMtpLogss->setModel('\entities\MtpLogs');

                    return $collMtpLogss;
                }
            } else {
                $collMtpLogss = ChildMtpLogsQuery::create(null, $criteria)
                    ->filterByMtp($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collMtpLogssPartial && count($collMtpLogss)) {
                        $this->initMtpLogss(false);

                        foreach ($collMtpLogss as $obj) {
                            if (false == $this->collMtpLogss->contains($obj)) {
                                $this->collMtpLogss->append($obj);
                            }
                        }

                        $this->collMtpLogssPartial = true;
                    }

                    return $collMtpLogss;
                }

                if ($partial && $this->collMtpLogss) {
                    foreach ($this->collMtpLogss as $obj) {
                        if ($obj->isNew()) {
                            $collMtpLogss[] = $obj;
                        }
                    }
                }

                $this->collMtpLogss = $collMtpLogss;
                $this->collMtpLogssPartial = false;
            }
        }

        return $this->collMtpLogss;
    }

    /**
     * Sets a collection of ChildMtpLogs objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $mtpLogss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setMtpLogss(Collection $mtpLogss, ?ConnectionInterface $con = null)
    {
        /** @var ChildMtpLogs[] $mtpLogssToDelete */
        $mtpLogssToDelete = $this->getMtpLogss(new Criteria(), $con)->diff($mtpLogss);


        $this->mtpLogssScheduledForDeletion = $mtpLogssToDelete;

        foreach ($mtpLogssToDelete as $mtpLogsRemoved) {
            $mtpLogsRemoved->setMtp(null);
        }

        $this->collMtpLogss = null;
        foreach ($mtpLogss as $mtpLogs) {
            $this->addMtpLogs($mtpLogs);
        }

        $this->collMtpLogss = $mtpLogss;
        $this->collMtpLogssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related MtpLogs objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related MtpLogs objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countMtpLogss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collMtpLogssPartial && !$this->isNew();
        if (null === $this->collMtpLogss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMtpLogss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getMtpLogss());
            }

            $query = ChildMtpLogsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByMtp($this)
                ->count($con);
        }

        return count($this->collMtpLogss);
    }

    /**
     * Method called to associate a ChildMtpLogs object to this object
     * through the ChildMtpLogs foreign key attribute.
     *
     * @param ChildMtpLogs $l ChildMtpLogs
     * @return $this The current object (for fluent API support)
     */
    public function addMtpLogs(ChildMtpLogs $l)
    {
        if ($this->collMtpLogss === null) {
            $this->initMtpLogss();
            $this->collMtpLogssPartial = true;
        }

        if (!$this->collMtpLogss->contains($l)) {
            $this->doAddMtpLogs($l);

            if ($this->mtpLogssScheduledForDeletion and $this->mtpLogssScheduledForDeletion->contains($l)) {
                $this->mtpLogssScheduledForDeletion->remove($this->mtpLogssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildMtpLogs $mtpLogs The ChildMtpLogs object to add.
     */
    protected function doAddMtpLogs(ChildMtpLogs $mtpLogs): void
    {
        $this->collMtpLogss[]= $mtpLogs;
        $mtpLogs->setMtp($this);
    }

    /**
     * @param ChildMtpLogs $mtpLogs The ChildMtpLogs object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeMtpLogs(ChildMtpLogs $mtpLogs)
    {
        if ($this->getMtpLogss()->contains($mtpLogs)) {
            $pos = $this->collMtpLogss->search($mtpLogs);
            $this->collMtpLogss->remove($pos);
            if (null === $this->mtpLogssScheduledForDeletion) {
                $this->mtpLogssScheduledForDeletion = clone $this->collMtpLogss;
                $this->mtpLogssScheduledForDeletion->clear();
            }
            $this->mtpLogssScheduledForDeletion[]= $mtpLogs;
            $mtpLogs->setMtp(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Mtp is new, it will return
     * an empty collection; or if this Mtp has previously
     * been saved, it will retrieve related MtpLogss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Mtp.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildMtpLogs[] List of ChildMtpLogs objects
     * @phpstan-return ObjectCollection&\Traversable<ChildMtpLogs}> List of ChildMtpLogs objects
     */
    public function getMtpLogssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildMtpLogsQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getMtpLogss($query, $con);
    }

    /**
     * Clears out the collTourplanss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addTourplanss()
     */
    public function clearTourplanss()
    {
        $this->collTourplanss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collTourplanss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialTourplanss($v = true): void
    {
        $this->collTourplanssPartial = $v;
    }

    /**
     * Initializes the collTourplanss collection.
     *
     * By default this just sets the collTourplanss collection to an empty array (like clearcollTourplanss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTourplanss(bool $overrideExisting = true): void
    {
        if (null !== $this->collTourplanss && !$overrideExisting) {
            return;
        }

        $collectionClassName = TourplansTableMap::getTableMap()->getCollectionClassName();

        $this->collTourplanss = new $collectionClassName;
        $this->collTourplanss->setModel('\entities\Tourplans');
    }

    /**
     * Gets an array of ChildTourplans objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildMtp is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans> List of ChildTourplans objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getTourplanss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collTourplanssPartial && !$this->isNew();
        if (null === $this->collTourplanss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collTourplanss) {
                    $this->initTourplanss();
                } else {
                    $collectionClassName = TourplansTableMap::getTableMap()->getCollectionClassName();

                    $collTourplanss = new $collectionClassName;
                    $collTourplanss->setModel('\entities\Tourplans');

                    return $collTourplanss;
                }
            } else {
                $collTourplanss = ChildTourplansQuery::create(null, $criteria)
                    ->filterByMtp($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTourplanssPartial && count($collTourplanss)) {
                        $this->initTourplanss(false);

                        foreach ($collTourplanss as $obj) {
                            if (false == $this->collTourplanss->contains($obj)) {
                                $this->collTourplanss->append($obj);
                            }
                        }

                        $this->collTourplanssPartial = true;
                    }

                    return $collTourplanss;
                }

                if ($partial && $this->collTourplanss) {
                    foreach ($this->collTourplanss as $obj) {
                        if ($obj->isNew()) {
                            $collTourplanss[] = $obj;
                        }
                    }
                }

                $this->collTourplanss = $collTourplanss;
                $this->collTourplanssPartial = false;
            }
        }

        return $this->collTourplanss;
    }

    /**
     * Sets a collection of ChildTourplans objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $tourplanss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setTourplanss(Collection $tourplanss, ?ConnectionInterface $con = null)
    {
        /** @var ChildTourplans[] $tourplanssToDelete */
        $tourplanssToDelete = $this->getTourplanss(new Criteria(), $con)->diff($tourplanss);


        $this->tourplanssScheduledForDeletion = $tourplanssToDelete;

        foreach ($tourplanssToDelete as $tourplansRemoved) {
            $tourplansRemoved->setMtp(null);
        }

        $this->collTourplanss = null;
        foreach ($tourplanss as $tourplans) {
            $this->addTourplans($tourplans);
        }

        $this->collTourplanss = $tourplanss;
        $this->collTourplanssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Tourplans objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related Tourplans objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countTourplanss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collTourplanssPartial && !$this->isNew();
        if (null === $this->collTourplanss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTourplanss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTourplanss());
            }

            $query = ChildTourplansQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByMtp($this)
                ->count($con);
        }

        return count($this->collTourplanss);
    }

    /**
     * Method called to associate a ChildTourplans object to this object
     * through the ChildTourplans foreign key attribute.
     *
     * @param ChildTourplans $l ChildTourplans
     * @return $this The current object (for fluent API support)
     */
    public function addTourplans(ChildTourplans $l)
    {
        if ($this->collTourplanss === null) {
            $this->initTourplanss();
            $this->collTourplanssPartial = true;
        }

        if (!$this->collTourplanss->contains($l)) {
            $this->doAddTourplans($l);

            if ($this->tourplanssScheduledForDeletion and $this->tourplanssScheduledForDeletion->contains($l)) {
                $this->tourplanssScheduledForDeletion->remove($this->tourplanssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildTourplans $tourplans The ChildTourplans object to add.
     */
    protected function doAddTourplans(ChildTourplans $tourplans): void
    {
        $this->collTourplanss[]= $tourplans;
        $tourplans->setMtp($this);
    }

    /**
     * @param ChildTourplans $tourplans The ChildTourplans object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeTourplans(ChildTourplans $tourplans)
    {
        if ($this->getTourplanss()->contains($tourplans)) {
            $pos = $this->collTourplanss->search($tourplans);
            $this->collTourplanss->remove($pos);
            if (null === $this->tourplanssScheduledForDeletion) {
                $this->tourplanssScheduledForDeletion = clone $this->collTourplanss;
                $this->tourplanssScheduledForDeletion->clear();
            }
            $this->tourplanssScheduledForDeletion[]= clone $tourplans;
            $tourplans->setMtp(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Mtp is new, it will return
     * an empty collection; or if this Mtp has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Mtp.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans}> List of ChildTourplans objects
     */
    public function getTourplanssJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTourplansQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getTourplanss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Mtp is new, it will return
     * an empty collection; or if this Mtp has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Mtp.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans}> List of ChildTourplans objects
     */
    public function getTourplanssJoinAgendatypes(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTourplansQuery::create(null, $criteria);
        $query->joinWith('Agendatypes', $joinBehavior);

        return $this->getTourplanss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Mtp is new, it will return
     * an empty collection; or if this Mtp has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Mtp.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans}> List of ChildTourplans objects
     */
    public function getTourplanssJoinBeats(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTourplansQuery::create(null, $criteria);
        $query->joinWith('Beats', $joinBehavior);

        return $this->getTourplanss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Mtp is new, it will return
     * an empty collection; or if this Mtp has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Mtp.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans}> List of ChildTourplans objects
     */
    public function getTourplanssJoinMtpDay(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTourplansQuery::create(null, $criteria);
        $query->joinWith('MtpDay', $joinBehavior);

        return $this->getTourplanss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Mtp is new, it will return
     * an empty collection; or if this Mtp has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Mtp.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans}> List of ChildTourplans objects
     */
    public function getTourplanssJoinGeoTowns(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTourplansQuery::create(null, $criteria);
        $query->joinWith('GeoTowns', $joinBehavior);

        return $this->getTourplanss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Mtp is new, it will return
     * an empty collection; or if this Mtp has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Mtp.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans}> List of ChildTourplans objects
     */
    public function getTourplanssJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTourplansQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getTourplanss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Mtp is new, it will return
     * an empty collection; or if this Mtp has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Mtp.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans}> List of ChildTourplans objects
     */
    public function getTourplanssJoinPositions(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTourplansQuery::create(null, $criteria);
        $query->joinWith('Positions', $joinBehavior);

        return $this->getTourplanss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Mtp is new, it will return
     * an empty collection; or if this Mtp has previously
     * been saved, it will retrieve related Tourplanss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Mtp.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildTourplans[] List of ChildTourplans objects
     * @phpstan-return ObjectCollection&\Traversable<ChildTourplans}> List of ChildTourplans objects
     */
    public function getTourplanssJoinBrandCampiagnVisitPlan(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildTourplansQuery::create(null, $criteria);
        $query->joinWith('BrandCampiagnVisitPlan', $joinBehavior);

        return $this->getTourplanss($query, $con);
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
            $this->aCompany->removeMtp($this);
        }
        if (null !== $this->aEmployee) {
            $this->aEmployee->removeMtp($this);
        }
        if (null !== $this->aPositions) {
            $this->aPositions->removeMtp($this);
        }
        $this->mtp_id = null;
        $this->position_id = null;
        $this->company_id = null;
        $this->month = null;
        $this->mtp_status = null;
        $this->mtp_approved_by = null;
        $this->approved_date = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->outlets_covered = null;
        $this->month_days = null;
        $this->working_days = null;
        $this->agenda_days = null;
        $this->total_outlets = null;
        $this->total_visits = null;
        $this->visits_fq = null;
        $this->is_processed = null;
        $this->is_mtp_generating = null;
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
            if ($this->collMtpDays) {
                foreach ($this->collMtpDays as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collMtpLogss) {
                foreach ($this->collMtpLogss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTourplanss) {
                foreach ($this->collTourplanss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collMtpDays = null;
        $this->collMtpLogss = null;
        $this->collTourplanss = null;
        $this->aCompany = null;
        $this->aEmployee = null;
        $this->aPositions = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(MtpTableMap::DEFAULT_STRING_FORMAT);
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
