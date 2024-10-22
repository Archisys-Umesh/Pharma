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
use entities\Employee as ChildEmployee;
use entities\EmployeeQuery as ChildEmployeeQuery;
use entities\HrUserDatesQuery as ChildHrUserDatesQuery;
use entities\Map\HrUserDatesTableMap;

/**
 * Base class that represents a row from the 'hr_user_dates' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class HrUserDates implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\HrUserDatesTableMap';


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
     * The value for the hrdt_id field.
     *
     * @var        int
     */
    protected $hrdt_id;

    /**
     * The value for the employee_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $employee_id;

    /**
     * The value for the birth_date field.
     *
     * @var        DateTime|null
     */
    protected $birth_date;

    /**
     * The value for the join_date field.
     *
     * @var        DateTime|null
     */
    protected $join_date;

    /**
     * The value for the probation_date field.
     *
     * @var        DateTime|null
     */
    protected $probation_date;

    /**
     * The value for the confirmation_date field.
     *
     * @var        DateTime|null
     */
    protected $confirmation_date;

    /**
     * The value for the training_start_date field.
     *
     * @var        DateTime|null
     */
    protected $training_start_date;

    /**
     * The value for the training_end_date field.
     *
     * @var        DateTime|null
     */
    protected $training_end_date;

    /**
     * The value for the resign_date field.
     *
     * @var        DateTime|null
     */
    protected $resign_date;

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
     * The value for the transfer_date field.
     *
     * @var        DateTime|null
     */
    protected $transfer_date;

    /**
     * The value for the reliving_date field.
     *
     * @var        DateTime|null
     */
    protected $reliving_date;

    /**
     * The value for the nsm_approve_date field.
     *
     * @var        DateTime|null
     */
    protected $nsm_approve_date;

    /**
     * The value for the resignation_rejected_date field.
     *
     * @var        DateTime|null
     */
    protected $resignation_rejected_date;

    /**
     * @var        ChildEmployee
     */
    protected $aEmployee;

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
        $this->employee_id = 0;
    }

    /**
     * Initializes internal state of entities\Base\HrUserDates object.
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
     * Compares this with another <code>HrUserDates</code> instance.  If
     * <code>obj</code> is an instance of <code>HrUserDates</code>, delegates to
     * <code>equals(HrUserDates)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [hrdt_id] column value.
     *
     * @return int
     */
    public function getHrdtId()
    {
        return $this->hrdt_id;
    }

    /**
     * Get the [employee_id] column value.
     *
     * @return int
     */
    public function getEmployeeId()
    {
        return $this->employee_id;
    }

    /**
     * Get the [optionally formatted] temporal [birth_date] column value.
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
    public function getBirthDate($format = null)
    {
        if ($format === null) {
            return $this->birth_date;
        } else {
            return $this->birth_date instanceof \DateTimeInterface ? $this->birth_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [join_date] column value.
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
    public function getJoinDate($format = null)
    {
        if ($format === null) {
            return $this->join_date;
        } else {
            return $this->join_date instanceof \DateTimeInterface ? $this->join_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [probation_date] column value.
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
    public function getProbationDate($format = null)
    {
        if ($format === null) {
            return $this->probation_date;
        } else {
            return $this->probation_date instanceof \DateTimeInterface ? $this->probation_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [confirmation_date] column value.
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
    public function getConfirmationDate($format = null)
    {
        if ($format === null) {
            return $this->confirmation_date;
        } else {
            return $this->confirmation_date instanceof \DateTimeInterface ? $this->confirmation_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [training_start_date] column value.
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
    public function getTrainingStartDate($format = null)
    {
        if ($format === null) {
            return $this->training_start_date;
        } else {
            return $this->training_start_date instanceof \DateTimeInterface ? $this->training_start_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [training_end_date] column value.
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
    public function getTrainingEndDate($format = null)
    {
        if ($format === null) {
            return $this->training_end_date;
        } else {
            return $this->training_end_date instanceof \DateTimeInterface ? $this->training_end_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [resign_date] column value.
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
    public function getResignDate($format = null)
    {
        if ($format === null) {
            return $this->resign_date;
        } else {
            return $this->resign_date instanceof \DateTimeInterface ? $this->resign_date->format($format) : null;
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
     * Get the [optionally formatted] temporal [transfer_date] column value.
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
    public function getTransferDate($format = null)
    {
        if ($format === null) {
            return $this->transfer_date;
        } else {
            return $this->transfer_date instanceof \DateTimeInterface ? $this->transfer_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [reliving_date] column value.
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
    public function getRelivingDate($format = null)
    {
        if ($format === null) {
            return $this->reliving_date;
        } else {
            return $this->reliving_date instanceof \DateTimeInterface ? $this->reliving_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [nsm_approve_date] column value.
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
    public function getNsmApproveDate($format = null)
    {
        if ($format === null) {
            return $this->nsm_approve_date;
        } else {
            return $this->nsm_approve_date instanceof \DateTimeInterface ? $this->nsm_approve_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [resignation_rejected_date] column value.
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
    public function getResignationRejectedDate($format = null)
    {
        if ($format === null) {
            return $this->resignation_rejected_date;
        } else {
            return $this->resignation_rejected_date instanceof \DateTimeInterface ? $this->resignation_rejected_date->format($format) : null;
        }
    }

    /**
     * Set the value of [hrdt_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setHrdtId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->hrdt_id !== $v) {
            $this->hrdt_id = $v;
            $this->modifiedColumns[HrUserDatesTableMap::COL_HRDT_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->employee_id !== $v) {
            $this->employee_id = $v;
            $this->modifiedColumns[HrUserDatesTableMap::COL_EMPLOYEE_ID] = true;
        }

        if ($this->aEmployee !== null && $this->aEmployee->getEmployeeId() !== $v) {
            $this->aEmployee = null;
        }

        return $this;
    }

    /**
     * Sets the value of [birth_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setBirthDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->birth_date !== null || $dt !== null) {
            if ($this->birth_date === null || $dt === null || $dt->format("Y-m-d") !== $this->birth_date->format("Y-m-d")) {
                $this->birth_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[HrUserDatesTableMap::COL_BIRTH_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [join_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setJoinDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->join_date !== null || $dt !== null) {
            if ($this->join_date === null || $dt === null || $dt->format("Y-m-d") !== $this->join_date->format("Y-m-d")) {
                $this->join_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[HrUserDatesTableMap::COL_JOIN_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [probation_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setProbationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->probation_date !== null || $dt !== null) {
            if ($this->probation_date === null || $dt === null || $dt->format("Y-m-d") !== $this->probation_date->format("Y-m-d")) {
                $this->probation_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[HrUserDatesTableMap::COL_PROBATION_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [confirmation_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setConfirmationDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->confirmation_date !== null || $dt !== null) {
            if ($this->confirmation_date === null || $dt === null || $dt->format("Y-m-d") !== $this->confirmation_date->format("Y-m-d")) {
                $this->confirmation_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[HrUserDatesTableMap::COL_CONFIRMATION_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [training_start_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setTrainingStartDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->training_start_date !== null || $dt !== null) {
            if ($this->training_start_date === null || $dt === null || $dt->format("Y-m-d") !== $this->training_start_date->format("Y-m-d")) {
                $this->training_start_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[HrUserDatesTableMap::COL_TRAINING_START_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [training_end_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setTrainingEndDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->training_end_date !== null || $dt !== null) {
            if ($this->training_end_date === null || $dt === null || $dt->format("Y-m-d") !== $this->training_end_date->format("Y-m-d")) {
                $this->training_end_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[HrUserDatesTableMap::COL_TRAINING_END_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [resign_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setResignDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->resign_date !== null || $dt !== null) {
            if ($this->resign_date === null || $dt === null || $dt->format("Y-m-d") !== $this->resign_date->format("Y-m-d")) {
                $this->resign_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[HrUserDatesTableMap::COL_RESIGN_DATE] = true;
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
                $this->modifiedColumns[HrUserDatesTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[HrUserDatesTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [transfer_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setTransferDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->transfer_date !== null || $dt !== null) {
            if ($this->transfer_date === null || $dt === null || $dt->format("Y-m-d") !== $this->transfer_date->format("Y-m-d")) {
                $this->transfer_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[HrUserDatesTableMap::COL_TRANSFER_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [reliving_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setRelivingDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->reliving_date !== null || $dt !== null) {
            if ($this->reliving_date === null || $dt === null || $dt->format("Y-m-d") !== $this->reliving_date->format("Y-m-d")) {
                $this->reliving_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[HrUserDatesTableMap::COL_RELIVING_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [nsm_approve_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setNsmApproveDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->nsm_approve_date !== null || $dt !== null) {
            if ($this->nsm_approve_date === null || $dt === null || $dt->format("Y-m-d") !== $this->nsm_approve_date->format("Y-m-d")) {
                $this->nsm_approve_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[HrUserDatesTableMap::COL_NSM_APPROVE_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [resignation_rejected_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setResignationRejectedDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->resignation_rejected_date !== null || $dt !== null) {
            if ($this->resignation_rejected_date === null || $dt === null || $dt->format("Y-m-d") !== $this->resignation_rejected_date->format("Y-m-d")) {
                $this->resignation_rejected_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[HrUserDatesTableMap::COL_RESIGNATION_REJECTED_DATE] = true;
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
            if ($this->employee_id !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : HrUserDatesTableMap::translateFieldName('HrdtId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->hrdt_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : HrUserDatesTableMap::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : HrUserDatesTableMap::translateFieldName('BirthDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->birth_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : HrUserDatesTableMap::translateFieldName('JoinDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->join_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : HrUserDatesTableMap::translateFieldName('ProbationDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->probation_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : HrUserDatesTableMap::translateFieldName('ConfirmationDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->confirmation_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : HrUserDatesTableMap::translateFieldName('TrainingStartDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->training_start_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : HrUserDatesTableMap::translateFieldName('TrainingEndDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->training_end_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : HrUserDatesTableMap::translateFieldName('ResignDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->resign_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : HrUserDatesTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : HrUserDatesTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : HrUserDatesTableMap::translateFieldName('TransferDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->transfer_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : HrUserDatesTableMap::translateFieldName('RelivingDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->reliving_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : HrUserDatesTableMap::translateFieldName('NsmApproveDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nsm_approve_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : HrUserDatesTableMap::translateFieldName('ResignationRejectedDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->resignation_rejected_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 15; // 15 = HrUserDatesTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\HrUserDates'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(HrUserDatesTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildHrUserDatesQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aEmployee = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see HrUserDates::setDeleted()
     * @see HrUserDates::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(HrUserDatesTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildHrUserDatesQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(HrUserDatesTableMap::DATABASE_NAME);
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
                HrUserDatesTableMap::addInstanceToPool($this);
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

            if ($this->aEmployee !== null) {
                if ($this->aEmployee->isModified() || $this->aEmployee->isNew()) {
                    $affectedRows += $this->aEmployee->save($con);
                }
                $this->setEmployee($this->aEmployee);
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

        $this->modifiedColumns[HrUserDatesTableMap::COL_HRDT_ID] = true;
        if (null !== $this->hrdt_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . HrUserDatesTableMap::COL_HRDT_ID . ')');
        }
        if (null === $this->hrdt_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('hr_user_dates_hrdt_id_seq')");
                $this->hrdt_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(HrUserDatesTableMap::COL_HRDT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'hrdt_id';
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_EMPLOYEE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'employee_id';
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_BIRTH_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'birth_date';
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_JOIN_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'join_date';
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_PROBATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'probation_date';
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_CONFIRMATION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'confirmation_date';
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_TRAINING_START_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'training_start_date';
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_TRAINING_END_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'training_end_date';
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_RESIGN_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'resign_date';
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_TRANSFER_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'transfer_date';
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_RELIVING_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'reliving_date';
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_NSM_APPROVE_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'nsm_approve_date';
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_RESIGNATION_REJECTED_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'resignation_rejected_date';
        }

        $sql = sprintf(
            'INSERT INTO hr_user_dates (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'hrdt_id':
                        $stmt->bindValue($identifier, $this->hrdt_id, PDO::PARAM_INT);

                        break;
                    case 'employee_id':
                        $stmt->bindValue($identifier, $this->employee_id, PDO::PARAM_INT);

                        break;
                    case 'birth_date':
                        $stmt->bindValue($identifier, $this->birth_date ? $this->birth_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'join_date':
                        $stmt->bindValue($identifier, $this->join_date ? $this->join_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'probation_date':
                        $stmt->bindValue($identifier, $this->probation_date ? $this->probation_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'confirmation_date':
                        $stmt->bindValue($identifier, $this->confirmation_date ? $this->confirmation_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'training_start_date':
                        $stmt->bindValue($identifier, $this->training_start_date ? $this->training_start_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'training_end_date':
                        $stmt->bindValue($identifier, $this->training_end_date ? $this->training_end_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'resign_date':
                        $stmt->bindValue($identifier, $this->resign_date ? $this->resign_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'transfer_date':
                        $stmt->bindValue($identifier, $this->transfer_date ? $this->transfer_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'reliving_date':
                        $stmt->bindValue($identifier, $this->reliving_date ? $this->reliving_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'nsm_approve_date':
                        $stmt->bindValue($identifier, $this->nsm_approve_date ? $this->nsm_approve_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'resignation_rejected_date':
                        $stmt->bindValue($identifier, $this->resignation_rejected_date ? $this->resignation_rejected_date->format("Y-m-d") : null, PDO::PARAM_STR);

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
        $pos = HrUserDatesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getHrdtId();

            case 1:
                return $this->getEmployeeId();

            case 2:
                return $this->getBirthDate();

            case 3:
                return $this->getJoinDate();

            case 4:
                return $this->getProbationDate();

            case 5:
                return $this->getConfirmationDate();

            case 6:
                return $this->getTrainingStartDate();

            case 7:
                return $this->getTrainingEndDate();

            case 8:
                return $this->getResignDate();

            case 9:
                return $this->getCreatedAt();

            case 10:
                return $this->getUpdatedAt();

            case 11:
                return $this->getTransferDate();

            case 12:
                return $this->getRelivingDate();

            case 13:
                return $this->getNsmApproveDate();

            case 14:
                return $this->getResignationRejectedDate();

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
        if (isset($alreadyDumpedObjects['HrUserDates'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['HrUserDates'][$this->hashCode()] = true;
        $keys = HrUserDatesTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getHrdtId(),
            $keys[1] => $this->getEmployeeId(),
            $keys[2] => $this->getBirthDate(),
            $keys[3] => $this->getJoinDate(),
            $keys[4] => $this->getProbationDate(),
            $keys[5] => $this->getConfirmationDate(),
            $keys[6] => $this->getTrainingStartDate(),
            $keys[7] => $this->getTrainingEndDate(),
            $keys[8] => $this->getResignDate(),
            $keys[9] => $this->getCreatedAt(),
            $keys[10] => $this->getUpdatedAt(),
            $keys[11] => $this->getTransferDate(),
            $keys[12] => $this->getRelivingDate(),
            $keys[13] => $this->getNsmApproveDate(),
            $keys[14] => $this->getResignationRejectedDate(),
        ];
        if ($result[$keys[2]] instanceof \DateTimeInterface) {
            $result[$keys[2]] = $result[$keys[2]]->format('Y-m-d');
        }

        if ($result[$keys[3]] instanceof \DateTimeInterface) {
            $result[$keys[3]] = $result[$keys[3]]->format('Y-m-d');
        }

        if ($result[$keys[4]] instanceof \DateTimeInterface) {
            $result[$keys[4]] = $result[$keys[4]]->format('Y-m-d');
        }

        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('Y-m-d');
        }

        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('Y-m-d');
        }

        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('Y-m-d');
        }

        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('Y-m-d');
        }

        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[10]] instanceof \DateTimeInterface) {
            $result[$keys[10]] = $result[$keys[10]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[11]] instanceof \DateTimeInterface) {
            $result[$keys[11]] = $result[$keys[11]]->format('Y-m-d');
        }

        if ($result[$keys[12]] instanceof \DateTimeInterface) {
            $result[$keys[12]] = $result[$keys[12]]->format('Y-m-d');
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
        $pos = HrUserDatesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setHrdtId($value);
                break;
            case 1:
                $this->setEmployeeId($value);
                break;
            case 2:
                $this->setBirthDate($value);
                break;
            case 3:
                $this->setJoinDate($value);
                break;
            case 4:
                $this->setProbationDate($value);
                break;
            case 5:
                $this->setConfirmationDate($value);
                break;
            case 6:
                $this->setTrainingStartDate($value);
                break;
            case 7:
                $this->setTrainingEndDate($value);
                break;
            case 8:
                $this->setResignDate($value);
                break;
            case 9:
                $this->setCreatedAt($value);
                break;
            case 10:
                $this->setUpdatedAt($value);
                break;
            case 11:
                $this->setTransferDate($value);
                break;
            case 12:
                $this->setRelivingDate($value);
                break;
            case 13:
                $this->setNsmApproveDate($value);
                break;
            case 14:
                $this->setResignationRejectedDate($value);
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
        $keys = HrUserDatesTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setHrdtId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setEmployeeId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setBirthDate($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setJoinDate($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setProbationDate($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setConfirmationDate($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setTrainingStartDate($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setTrainingEndDate($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setResignDate($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCreatedAt($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setUpdatedAt($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setTransferDate($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setRelivingDate($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setNsmApproveDate($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setResignationRejectedDate($arr[$keys[14]]);
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
        $criteria = new Criteria(HrUserDatesTableMap::DATABASE_NAME);

        if ($this->isColumnModified(HrUserDatesTableMap::COL_HRDT_ID)) {
            $criteria->add(HrUserDatesTableMap::COL_HRDT_ID, $this->hrdt_id);
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_EMPLOYEE_ID)) {
            $criteria->add(HrUserDatesTableMap::COL_EMPLOYEE_ID, $this->employee_id);
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_BIRTH_DATE)) {
            $criteria->add(HrUserDatesTableMap::COL_BIRTH_DATE, $this->birth_date);
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_JOIN_DATE)) {
            $criteria->add(HrUserDatesTableMap::COL_JOIN_DATE, $this->join_date);
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_PROBATION_DATE)) {
            $criteria->add(HrUserDatesTableMap::COL_PROBATION_DATE, $this->probation_date);
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_CONFIRMATION_DATE)) {
            $criteria->add(HrUserDatesTableMap::COL_CONFIRMATION_DATE, $this->confirmation_date);
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_TRAINING_START_DATE)) {
            $criteria->add(HrUserDatesTableMap::COL_TRAINING_START_DATE, $this->training_start_date);
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_TRAINING_END_DATE)) {
            $criteria->add(HrUserDatesTableMap::COL_TRAINING_END_DATE, $this->training_end_date);
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_RESIGN_DATE)) {
            $criteria->add(HrUserDatesTableMap::COL_RESIGN_DATE, $this->resign_date);
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_CREATED_AT)) {
            $criteria->add(HrUserDatesTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_UPDATED_AT)) {
            $criteria->add(HrUserDatesTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_TRANSFER_DATE)) {
            $criteria->add(HrUserDatesTableMap::COL_TRANSFER_DATE, $this->transfer_date);
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_RELIVING_DATE)) {
            $criteria->add(HrUserDatesTableMap::COL_RELIVING_DATE, $this->reliving_date);
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_NSM_APPROVE_DATE)) {
            $criteria->add(HrUserDatesTableMap::COL_NSM_APPROVE_DATE, $this->nsm_approve_date);
        }
        if ($this->isColumnModified(HrUserDatesTableMap::COL_RESIGNATION_REJECTED_DATE)) {
            $criteria->add(HrUserDatesTableMap::COL_RESIGNATION_REJECTED_DATE, $this->resignation_rejected_date);
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
        $criteria = ChildHrUserDatesQuery::create();
        $criteria->add(HrUserDatesTableMap::COL_HRDT_ID, $this->hrdt_id);

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
        $validPk = null !== $this->getHrdtId();

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
        return $this->getHrdtId();
    }

    /**
     * Generic method to set the primary key (hrdt_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setHrdtId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getHrdtId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\HrUserDates (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setEmployeeId($this->getEmployeeId());
        $copyObj->setBirthDate($this->getBirthDate());
        $copyObj->setJoinDate($this->getJoinDate());
        $copyObj->setProbationDate($this->getProbationDate());
        $copyObj->setConfirmationDate($this->getConfirmationDate());
        $copyObj->setTrainingStartDate($this->getTrainingStartDate());
        $copyObj->setTrainingEndDate($this->getTrainingEndDate());
        $copyObj->setResignDate($this->getResignDate());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setTransferDate($this->getTransferDate());
        $copyObj->setRelivingDate($this->getRelivingDate());
        $copyObj->setNsmApproveDate($this->getNsmApproveDate());
        $copyObj->setResignationRejectedDate($this->getResignationRejectedDate());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setHrdtId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\HrUserDates Clone of current object.
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
     * Declares an association between this object and a ChildEmployee object.
     *
     * @param ChildEmployee $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setEmployee(ChildEmployee $v = null)
    {
        if ($v === null) {
            $this->setEmployeeId(0);
        } else {
            $this->setEmployeeId($v->getEmployeeId());
        }

        $this->aEmployee = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildEmployee object, it will not be re-added.
        if ($v !== null) {
            $v->addHrUserDates($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildEmployee object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildEmployee The associated ChildEmployee object.
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
                $this->aEmployee->addHrUserDatess($this);
             */
        }

        return $this->aEmployee;
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
        if (null !== $this->aEmployee) {
            $this->aEmployee->removeHrUserDates($this);
        }
        $this->hrdt_id = null;
        $this->employee_id = null;
        $this->birth_date = null;
        $this->join_date = null;
        $this->probation_date = null;
        $this->confirmation_date = null;
        $this->training_start_date = null;
        $this->training_end_date = null;
        $this->resign_date = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->transfer_date = null;
        $this->reliving_date = null;
        $this->nsm_approve_date = null;
        $this->resignation_rejected_date = null;
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

        $this->aEmployee = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(HrUserDatesTableMap::DEFAULT_STRING_FORMAT);
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