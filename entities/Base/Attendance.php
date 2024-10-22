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
use entities\AttendanceQuery as ChildAttendanceQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\Employee as ChildEmployee;
use entities\EmployeeQuery as ChildEmployeeQuery;
use entities\Expenses as ChildExpenses;
use entities\ExpensesQuery as ChildExpensesQuery;
use entities\GeoTowns as ChildGeoTowns;
use entities\GeoTownsQuery as ChildGeoTownsQuery;
use entities\Map\AttendanceTableMap;

/**
 * Base class that represents a row from the 'attendance' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class Attendance implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\AttendanceTableMap';


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
     * The value for the attendance_id field.
     *
     * @var        int
     */
    protected $attendance_id;

    /**
     * The value for the employee_id field.
     *
     * @var        int
     */
    protected $employee_id;

    /**
     * The value for the company_id field.
     *
     * @var        int
     */
    protected $company_id;

    /**
     * The value for the attendance_date field.
     *
     * @var        DateTime
     */
    protected $attendance_date;

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
     * The value for the start_latlng field.
     *
     * @var        string|null
     */
    protected $start_latlng;

    /**
     * The value for the start_address field.
     *
     * @var        string|null
     */
    protected $start_address;

    /**
     * The value for the end_latlng field.
     *
     * @var        string|null
     */
    protected $end_latlng;

    /**
     * The value for the end_address field.
     *
     * @var        string|null
     */
    protected $end_address;

    /**
     * The value for the shift_mins field.
     *
     * Note: this column has a database default value of: '0.000000'
     * @var        string|null
     */
    protected $shift_mins;

    /**
     * The value for the joint_emp field.
     *
     * @var        int|null
     */
    protected $joint_emp;

    /**
     * The value for the remark field.
     *
     * @var        string|null
     */
    protected $remark;

    /**
     * The value for the status field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $status;

    /**
     * The value for the outlet_count field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $outlet_count;

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
     * The value for the start_itownid field.
     *
     * @var        int|null
     */
    protected $start_itownid;

    /**
     * The value for the end_itownid field.
     *
     * @var        int|null
     */
    protected $end_itownid;

    /**
     * The value for the visited_itownid field.
     *
     * @var        string|null
     */
    protected $visited_itownid;

    /**
     * The value for the expense_id field.
     *
     * @var        int|null
     */
    protected $expense_id;

    /**
     * The value for the is_updated field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $is_updated;

    /**
     * The value for the expense_generated field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $expense_generated;

    /**
     * The value for the expense_remark field.
     *
     * @var        string|null
     */
    protected $expense_remark;

    /**
     * @var        ChildGeoTowns
     */
    protected $aGeoTownsRelatedByEndItownid;

    /**
     * @var        ChildExpenses
     */
    protected $aExpenses;

    /**
     * @var        ChildGeoTowns
     */
    protected $aGeoTownsRelatedByStartItownid;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

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
        $this->shift_mins = '0.000000';
        $this->status = 0;
        $this->outlet_count = 0;
        $this->is_updated = false;
        $this->expense_generated = false;
    }

    /**
     * Initializes internal state of entities\Base\Attendance object.
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
     * Compares this with another <code>Attendance</code> instance.  If
     * <code>obj</code> is an instance of <code>Attendance</code>, delegates to
     * <code>equals(Attendance)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [attendance_id] column value.
     *
     * @return int
     */
    public function getAttendanceId()
    {
        return $this->attendance_id;
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
     * Get the [company_id] column value.
     *
     * @return int
     */
    public function getCompanyId()
    {
        return $this->company_id;
    }

    /**
     * Get the [optionally formatted] temporal [attendance_date] column value.
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
    public function getAttendanceDate($format = null)
    {
        if ($format === null) {
            return $this->attendance_date;
        } else {
            return $this->attendance_date instanceof \DateTimeInterface ? $this->attendance_date->format($format) : null;
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
     * Get the [start_latlng] column value.
     *
     * @return string|null
     */
    public function getStartLatlng()
    {
        return $this->start_latlng;
    }

    /**
     * Get the [start_address] column value.
     *
     * @return string|null
     */
    public function getStartAddress()
    {
        return $this->start_address;
    }

    /**
     * Get the [end_latlng] column value.
     *
     * @return string|null
     */
    public function getEndLatlng()
    {
        return $this->end_latlng;
    }

    /**
     * Get the [end_address] column value.
     *
     * @return string|null
     */
    public function getEndAddress()
    {
        return $this->end_address;
    }

    /**
     * Get the [shift_mins] column value.
     *
     * @return string|null
     */
    public function getShiftMins()
    {
        return $this->shift_mins;
    }

    /**
     * Get the [joint_emp] column value.
     *
     * @return int|null
     */
    public function getJointEmp()
    {
        return $this->joint_emp;
    }

    /**
     * Get the [remark] column value.
     *
     * @return string|null
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * Get the [status] column value.
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [outlet_count] column value.
     *
     * @return int
     */
    public function getOutletCount()
    {
        return $this->outlet_count;
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
     * Get the [start_itownid] column value.
     *
     * @return int|null
     */
    public function getStartItownid()
    {
        return $this->start_itownid;
    }

    /**
     * Get the [end_itownid] column value.
     *
     * @return int|null
     */
    public function getEndItownid()
    {
        return $this->end_itownid;
    }

    /**
     * Get the [visited_itownid] column value.
     *
     * @return string|null
     */
    public function getVisitedItownid()
    {
        return $this->visited_itownid;
    }

    /**
     * Get the [expense_id] column value.
     *
     * @return int|null
     */
    public function getExpenseId()
    {
        return $this->expense_id;
    }

    /**
     * Get the [is_updated] column value.
     *
     * @return boolean|null
     */
    public function getIsUpdated()
    {
        return $this->is_updated;
    }

    /**
     * Get the [is_updated] column value.
     *
     * @return boolean|null
     */
    public function isUpdated()
    {
        return $this->getIsUpdated();
    }

    /**
     * Get the [expense_generated] column value.
     *
     * @return boolean
     */
    public function getExpenseGenerated()
    {
        return $this->expense_generated;
    }

    /**
     * Get the [expense_generated] column value.
     *
     * @return boolean
     */
    public function isExpenseGenerated()
    {
        return $this->getExpenseGenerated();
    }

    /**
     * Get the [expense_remark] column value.
     *
     * @return string|null
     */
    public function getExpenseRemark()
    {
        return $this->expense_remark;
    }

    /**
     * Set the value of [attendance_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAttendanceId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->attendance_id !== $v) {
            $this->attendance_id = $v;
            $this->modifiedColumns[AttendanceTableMap::COL_ATTENDANCE_ID] = true;
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
            $this->modifiedColumns[AttendanceTableMap::COL_EMPLOYEE_ID] = true;
        }

        if ($this->aEmployee !== null && $this->aEmployee->getEmployeeId() !== $v) {
            $this->aEmployee = null;
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
            $this->modifiedColumns[AttendanceTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Sets the value of [attendance_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setAttendanceDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->attendance_date !== null || $dt !== null) {
            if ($this->attendance_date === null || $dt === null || $dt->format("Y-m-d") !== $this->attendance_date->format("Y-m-d")) {
                $this->attendance_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[AttendanceTableMap::COL_ATTENDANCE_DATE] = true;
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
            if ($this->start_time === null || $dt === null || $dt->format("H:i:s.u") !== $this->start_time->format("H:i:s.u")) {
                $this->start_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[AttendanceTableMap::COL_START_TIME] = true;
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
            if ($this->end_time === null || $dt === null || $dt->format("H:i:s.u") !== $this->end_time->format("H:i:s.u")) {
                $this->end_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[AttendanceTableMap::COL_END_TIME] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [start_latlng] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStartLatlng($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->start_latlng !== $v) {
            $this->start_latlng = $v;
            $this->modifiedColumns[AttendanceTableMap::COL_START_LATLNG] = true;
        }

        return $this;
    }

    /**
     * Set the value of [start_address] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStartAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->start_address !== $v) {
            $this->start_address = $v;
            $this->modifiedColumns[AttendanceTableMap::COL_START_ADDRESS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [end_latlng] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEndLatlng($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->end_latlng !== $v) {
            $this->end_latlng = $v;
            $this->modifiedColumns[AttendanceTableMap::COL_END_LATLNG] = true;
        }

        return $this;
    }

    /**
     * Set the value of [end_address] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEndAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->end_address !== $v) {
            $this->end_address = $v;
            $this->modifiedColumns[AttendanceTableMap::COL_END_ADDRESS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [shift_mins] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setShiftMins($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->shift_mins !== $v) {
            $this->shift_mins = $v;
            $this->modifiedColumns[AttendanceTableMap::COL_SHIFT_MINS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [joint_emp] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setJointEmp($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->joint_emp !== $v) {
            $this->joint_emp = $v;
            $this->modifiedColumns[AttendanceTableMap::COL_JOINT_EMP] = true;
        }

        return $this;
    }

    /**
     * Set the value of [remark] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRemark($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->remark !== $v) {
            $this->remark = $v;
            $this->modifiedColumns[AttendanceTableMap::COL_REMARK] = true;
        }

        return $this;
    }

    /**
     * Set the value of [status] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[AttendanceTableMap::COL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_count] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletCount($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_count !== $v) {
            $this->outlet_count = $v;
            $this->modifiedColumns[AttendanceTableMap::COL_OUTLET_COUNT] = true;
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
                $this->modifiedColumns[AttendanceTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[AttendanceTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [start_itownid] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStartItownid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->start_itownid !== $v) {
            $this->start_itownid = $v;
            $this->modifiedColumns[AttendanceTableMap::COL_START_ITOWNID] = true;
        }

        if ($this->aGeoTownsRelatedByStartItownid !== null && $this->aGeoTownsRelatedByStartItownid->getItownid() !== $v) {
            $this->aGeoTownsRelatedByStartItownid = null;
        }

        return $this;
    }

    /**
     * Set the value of [end_itownid] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEndItownid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->end_itownid !== $v) {
            $this->end_itownid = $v;
            $this->modifiedColumns[AttendanceTableMap::COL_END_ITOWNID] = true;
        }

        if ($this->aGeoTownsRelatedByEndItownid !== null && $this->aGeoTownsRelatedByEndItownid->getItownid() !== $v) {
            $this->aGeoTownsRelatedByEndItownid = null;
        }

        return $this;
    }

    /**
     * Set the value of [visited_itownid] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setVisitedItownid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->visited_itownid !== $v) {
            $this->visited_itownid = $v;
            $this->modifiedColumns[AttendanceTableMap::COL_VISITED_ITOWNID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [expense_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpenseId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->expense_id !== $v) {
            $this->expense_id = $v;
            $this->modifiedColumns[AttendanceTableMap::COL_EXPENSE_ID] = true;
        }

        if ($this->aExpenses !== null && $this->aExpenses->getExpId() !== $v) {
            $this->aExpenses = null;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_updated] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsUpdated($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_updated !== $v) {
            $this->is_updated = $v;
            $this->modifiedColumns[AttendanceTableMap::COL_IS_UPDATED] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [expense_generated] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setExpenseGenerated($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->expense_generated !== $v) {
            $this->expense_generated = $v;
            $this->modifiedColumns[AttendanceTableMap::COL_EXPENSE_GENERATED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [expense_remark] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExpenseRemark($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->expense_remark !== $v) {
            $this->expense_remark = $v;
            $this->modifiedColumns[AttendanceTableMap::COL_EXPENSE_REMARK] = true;
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
            if ($this->shift_mins !== '0.000000') {
                return false;
            }

            if ($this->status !== 0) {
                return false;
            }

            if ($this->outlet_count !== 0) {
                return false;
            }

            if ($this->is_updated !== false) {
                return false;
            }

            if ($this->expense_generated !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : AttendanceTableMap::translateFieldName('AttendanceId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->attendance_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : AttendanceTableMap::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : AttendanceTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : AttendanceTableMap::translateFieldName('AttendanceDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->attendance_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : AttendanceTableMap::translateFieldName('StartTime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->start_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : AttendanceTableMap::translateFieldName('EndTime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->end_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : AttendanceTableMap::translateFieldName('StartLatlng', TableMap::TYPE_PHPNAME, $indexType)];
            $this->start_latlng = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : AttendanceTableMap::translateFieldName('StartAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->start_address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : AttendanceTableMap::translateFieldName('EndLatlng', TableMap::TYPE_PHPNAME, $indexType)];
            $this->end_latlng = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : AttendanceTableMap::translateFieldName('EndAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->end_address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : AttendanceTableMap::translateFieldName('ShiftMins', TableMap::TYPE_PHPNAME, $indexType)];
            $this->shift_mins = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : AttendanceTableMap::translateFieldName('JointEmp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->joint_emp = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : AttendanceTableMap::translateFieldName('Remark', TableMap::TYPE_PHPNAME, $indexType)];
            $this->remark = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : AttendanceTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : AttendanceTableMap::translateFieldName('OutletCount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_count = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : AttendanceTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : AttendanceTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : AttendanceTableMap::translateFieldName('StartItownid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->start_itownid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : AttendanceTableMap::translateFieldName('EndItownid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->end_itownid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : AttendanceTableMap::translateFieldName('VisitedItownid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->visited_itownid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : AttendanceTableMap::translateFieldName('ExpenseId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->expense_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : AttendanceTableMap::translateFieldName('IsUpdated', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_updated = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : AttendanceTableMap::translateFieldName('ExpenseGenerated', TableMap::TYPE_PHPNAME, $indexType)];
            $this->expense_generated = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : AttendanceTableMap::translateFieldName('ExpenseRemark', TableMap::TYPE_PHPNAME, $indexType)];
            $this->expense_remark = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 24; // 24 = AttendanceTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\Attendance'), 0, $e);
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
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
        }
        if ($this->aGeoTownsRelatedByStartItownid !== null && $this->start_itownid !== $this->aGeoTownsRelatedByStartItownid->getItownid()) {
            $this->aGeoTownsRelatedByStartItownid = null;
        }
        if ($this->aGeoTownsRelatedByEndItownid !== null && $this->end_itownid !== $this->aGeoTownsRelatedByEndItownid->getItownid()) {
            $this->aGeoTownsRelatedByEndItownid = null;
        }
        if ($this->aExpenses !== null && $this->expense_id !== $this->aExpenses->getExpId()) {
            $this->aExpenses = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(AttendanceTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildAttendanceQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aGeoTownsRelatedByEndItownid = null;
            $this->aExpenses = null;
            $this->aGeoTownsRelatedByStartItownid = null;
            $this->aCompany = null;
            $this->aEmployee = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Attendance::setDeleted()
     * @see Attendance::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(AttendanceTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildAttendanceQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(AttendanceTableMap::DATABASE_NAME);
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
                AttendanceTableMap::addInstanceToPool($this);
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

            if ($this->aGeoTownsRelatedByEndItownid !== null) {
                if ($this->aGeoTownsRelatedByEndItownid->isModified() || $this->aGeoTownsRelatedByEndItownid->isNew()) {
                    $affectedRows += $this->aGeoTownsRelatedByEndItownid->save($con);
                }
                $this->setGeoTownsRelatedByEndItownid($this->aGeoTownsRelatedByEndItownid);
            }

            if ($this->aExpenses !== null) {
                if ($this->aExpenses->isModified() || $this->aExpenses->isNew()) {
                    $affectedRows += $this->aExpenses->save($con);
                }
                $this->setExpenses($this->aExpenses);
            }

            if ($this->aGeoTownsRelatedByStartItownid !== null) {
                if ($this->aGeoTownsRelatedByStartItownid->isModified() || $this->aGeoTownsRelatedByStartItownid->isNew()) {
                    $affectedRows += $this->aGeoTownsRelatedByStartItownid->save($con);
                }
                $this->setGeoTownsRelatedByStartItownid($this->aGeoTownsRelatedByStartItownid);
            }

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

        $this->modifiedColumns[AttendanceTableMap::COL_ATTENDANCE_ID] = true;
        if (null !== $this->attendance_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . AttendanceTableMap::COL_ATTENDANCE_ID . ')');
        }
        if (null === $this->attendance_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('attendance_attendance_id_seq')");
                $this->attendance_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(AttendanceTableMap::COL_ATTENDANCE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'attendance_id';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_EMPLOYEE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'employee_id';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_ATTENDANCE_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'attendance_date';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_START_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'start_time';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_END_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'end_time';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_START_LATLNG)) {
            $modifiedColumns[':p' . $index++]  = 'start_latlng';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_START_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'start_address';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_END_LATLNG)) {
            $modifiedColumns[':p' . $index++]  = 'end_latlng';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_END_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'end_address';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_SHIFT_MINS)) {
            $modifiedColumns[':p' . $index++]  = 'shift_mins';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_JOINT_EMP)) {
            $modifiedColumns[':p' . $index++]  = 'joint_emp';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_REMARK)) {
            $modifiedColumns[':p' . $index++]  = 'remark';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_OUTLET_COUNT)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_count';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_START_ITOWNID)) {
            $modifiedColumns[':p' . $index++]  = 'start_itownid';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_END_ITOWNID)) {
            $modifiedColumns[':p' . $index++]  = 'end_itownid';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_VISITED_ITOWNID)) {
            $modifiedColumns[':p' . $index++]  = 'visited_itownid';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_EXPENSE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'expense_id';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_IS_UPDATED)) {
            $modifiedColumns[':p' . $index++]  = 'is_updated';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_EXPENSE_GENERATED)) {
            $modifiedColumns[':p' . $index++]  = 'expense_generated';
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_EXPENSE_REMARK)) {
            $modifiedColumns[':p' . $index++]  = 'expense_remark';
        }

        $sql = sprintf(
            'INSERT INTO attendance (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'attendance_id':
                        $stmt->bindValue($identifier, $this->attendance_id, PDO::PARAM_INT);

                        break;
                    case 'employee_id':
                        $stmt->bindValue($identifier, $this->employee_id, PDO::PARAM_INT);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'attendance_date':
                        $stmt->bindValue($identifier, $this->attendance_date ? $this->attendance_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'start_time':
                        $stmt->bindValue($identifier, $this->start_time ? $this->start_time->format("H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'end_time':
                        $stmt->bindValue($identifier, $this->end_time ? $this->end_time->format("H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'start_latlng':
                        $stmt->bindValue($identifier, $this->start_latlng, PDO::PARAM_STR);

                        break;
                    case 'start_address':
                        $stmt->bindValue($identifier, $this->start_address, PDO::PARAM_STR);

                        break;
                    case 'end_latlng':
                        $stmt->bindValue($identifier, $this->end_latlng, PDO::PARAM_STR);

                        break;
                    case 'end_address':
                        $stmt->bindValue($identifier, $this->end_address, PDO::PARAM_STR);

                        break;
                    case 'shift_mins':
                        $stmt->bindValue($identifier, $this->shift_mins, PDO::PARAM_STR);

                        break;
                    case 'joint_emp':
                        $stmt->bindValue($identifier, $this->joint_emp, PDO::PARAM_INT);

                        break;
                    case 'remark':
                        $stmt->bindValue($identifier, $this->remark, PDO::PARAM_STR);

                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);

                        break;
                    case 'outlet_count':
                        $stmt->bindValue($identifier, $this->outlet_count, PDO::PARAM_INT);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'start_itownid':
                        $stmt->bindValue($identifier, $this->start_itownid, PDO::PARAM_INT);

                        break;
                    case 'end_itownid':
                        $stmt->bindValue($identifier, $this->end_itownid, PDO::PARAM_INT);

                        break;
                    case 'visited_itownid':
                        $stmt->bindValue($identifier, $this->visited_itownid, PDO::PARAM_STR);

                        break;
                    case 'expense_id':
                        $stmt->bindValue($identifier, $this->expense_id, PDO::PARAM_INT);

                        break;
                    case 'is_updated':
                        $stmt->bindValue($identifier, $this->is_updated, PDO::PARAM_BOOL);

                        break;
                    case 'expense_generated':
                        $stmt->bindValue($identifier, $this->expense_generated, PDO::PARAM_BOOL);

                        break;
                    case 'expense_remark':
                        $stmt->bindValue($identifier, $this->expense_remark, PDO::PARAM_STR);

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
        $pos = AttendanceTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getAttendanceId();

            case 1:
                return $this->getEmployeeId();

            case 2:
                return $this->getCompanyId();

            case 3:
                return $this->getAttendanceDate();

            case 4:
                return $this->getStartTime();

            case 5:
                return $this->getEndTime();

            case 6:
                return $this->getStartLatlng();

            case 7:
                return $this->getStartAddress();

            case 8:
                return $this->getEndLatlng();

            case 9:
                return $this->getEndAddress();

            case 10:
                return $this->getShiftMins();

            case 11:
                return $this->getJointEmp();

            case 12:
                return $this->getRemark();

            case 13:
                return $this->getStatus();

            case 14:
                return $this->getOutletCount();

            case 15:
                return $this->getCreatedAt();

            case 16:
                return $this->getUpdatedAt();

            case 17:
                return $this->getStartItownid();

            case 18:
                return $this->getEndItownid();

            case 19:
                return $this->getVisitedItownid();

            case 20:
                return $this->getExpenseId();

            case 21:
                return $this->getIsUpdated();

            case 22:
                return $this->getExpenseGenerated();

            case 23:
                return $this->getExpenseRemark();

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
        if (isset($alreadyDumpedObjects['Attendance'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Attendance'][$this->hashCode()] = true;
        $keys = AttendanceTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getAttendanceId(),
            $keys[1] => $this->getEmployeeId(),
            $keys[2] => $this->getCompanyId(),
            $keys[3] => $this->getAttendanceDate(),
            $keys[4] => $this->getStartTime(),
            $keys[5] => $this->getEndTime(),
            $keys[6] => $this->getStartLatlng(),
            $keys[7] => $this->getStartAddress(),
            $keys[8] => $this->getEndLatlng(),
            $keys[9] => $this->getEndAddress(),
            $keys[10] => $this->getShiftMins(),
            $keys[11] => $this->getJointEmp(),
            $keys[12] => $this->getRemark(),
            $keys[13] => $this->getStatus(),
            $keys[14] => $this->getOutletCount(),
            $keys[15] => $this->getCreatedAt(),
            $keys[16] => $this->getUpdatedAt(),
            $keys[17] => $this->getStartItownid(),
            $keys[18] => $this->getEndItownid(),
            $keys[19] => $this->getVisitedItownid(),
            $keys[20] => $this->getExpenseId(),
            $keys[21] => $this->getIsUpdated(),
            $keys[22] => $this->getExpenseGenerated(),
            $keys[23] => $this->getExpenseRemark(),
        ];
        if ($result[$keys[3]] instanceof \DateTimeInterface) {
            $result[$keys[3]] = $result[$keys[3]]->format('Y-m-d');
        }

        if ($result[$keys[4]] instanceof \DateTimeInterface) {
            $result[$keys[4]] = $result[$keys[4]]->format('H:i:s.u');
        }

        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('H:i:s.u');
        }

        if ($result[$keys[15]] instanceof \DateTimeInterface) {
            $result[$keys[15]] = $result[$keys[15]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[16]] instanceof \DateTimeInterface) {
            $result[$keys[16]] = $result[$keys[16]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aGeoTownsRelatedByEndItownid) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'geoTowns';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'geo_towns';
                        break;
                    default:
                        $key = 'GeoTowns';
                }

                $result[$key] = $this->aGeoTownsRelatedByEndItownid->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aExpenses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'expenses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'expenses';
                        break;
                    default:
                        $key = 'Expenses';
                }

                $result[$key] = $this->aExpenses->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aGeoTownsRelatedByStartItownid) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'geoTowns';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'geo_towns';
                        break;
                    default:
                        $key = 'GeoTowns';
                }

                $result[$key] = $this->aGeoTownsRelatedByStartItownid->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = AttendanceTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setAttendanceId($value);
                break;
            case 1:
                $this->setEmployeeId($value);
                break;
            case 2:
                $this->setCompanyId($value);
                break;
            case 3:
                $this->setAttendanceDate($value);
                break;
            case 4:
                $this->setStartTime($value);
                break;
            case 5:
                $this->setEndTime($value);
                break;
            case 6:
                $this->setStartLatlng($value);
                break;
            case 7:
                $this->setStartAddress($value);
                break;
            case 8:
                $this->setEndLatlng($value);
                break;
            case 9:
                $this->setEndAddress($value);
                break;
            case 10:
                $this->setShiftMins($value);
                break;
            case 11:
                $this->setJointEmp($value);
                break;
            case 12:
                $this->setRemark($value);
                break;
            case 13:
                $this->setStatus($value);
                break;
            case 14:
                $this->setOutletCount($value);
                break;
            case 15:
                $this->setCreatedAt($value);
                break;
            case 16:
                $this->setUpdatedAt($value);
                break;
            case 17:
                $this->setStartItownid($value);
                break;
            case 18:
                $this->setEndItownid($value);
                break;
            case 19:
                $this->setVisitedItownid($value);
                break;
            case 20:
                $this->setExpenseId($value);
                break;
            case 21:
                $this->setIsUpdated($value);
                break;
            case 22:
                $this->setExpenseGenerated($value);
                break;
            case 23:
                $this->setExpenseRemark($value);
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
        $keys = AttendanceTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setAttendanceId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setEmployeeId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setCompanyId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setAttendanceDate($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setStartTime($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setEndTime($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setStartLatlng($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setStartAddress($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setEndLatlng($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setEndAddress($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setShiftMins($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setJointEmp($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setRemark($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setStatus($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setOutletCount($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setCreatedAt($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setUpdatedAt($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setStartItownid($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setEndItownid($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setVisitedItownid($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setExpenseId($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setIsUpdated($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setExpenseGenerated($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setExpenseRemark($arr[$keys[23]]);
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
        $criteria = new Criteria(AttendanceTableMap::DATABASE_NAME);

        if ($this->isColumnModified(AttendanceTableMap::COL_ATTENDANCE_ID)) {
            $criteria->add(AttendanceTableMap::COL_ATTENDANCE_ID, $this->attendance_id);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_EMPLOYEE_ID)) {
            $criteria->add(AttendanceTableMap::COL_EMPLOYEE_ID, $this->employee_id);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_COMPANY_ID)) {
            $criteria->add(AttendanceTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_ATTENDANCE_DATE)) {
            $criteria->add(AttendanceTableMap::COL_ATTENDANCE_DATE, $this->attendance_date);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_START_TIME)) {
            $criteria->add(AttendanceTableMap::COL_START_TIME, $this->start_time);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_END_TIME)) {
            $criteria->add(AttendanceTableMap::COL_END_TIME, $this->end_time);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_START_LATLNG)) {
            $criteria->add(AttendanceTableMap::COL_START_LATLNG, $this->start_latlng);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_START_ADDRESS)) {
            $criteria->add(AttendanceTableMap::COL_START_ADDRESS, $this->start_address);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_END_LATLNG)) {
            $criteria->add(AttendanceTableMap::COL_END_LATLNG, $this->end_latlng);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_END_ADDRESS)) {
            $criteria->add(AttendanceTableMap::COL_END_ADDRESS, $this->end_address);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_SHIFT_MINS)) {
            $criteria->add(AttendanceTableMap::COL_SHIFT_MINS, $this->shift_mins);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_JOINT_EMP)) {
            $criteria->add(AttendanceTableMap::COL_JOINT_EMP, $this->joint_emp);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_REMARK)) {
            $criteria->add(AttendanceTableMap::COL_REMARK, $this->remark);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_STATUS)) {
            $criteria->add(AttendanceTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_OUTLET_COUNT)) {
            $criteria->add(AttendanceTableMap::COL_OUTLET_COUNT, $this->outlet_count);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_CREATED_AT)) {
            $criteria->add(AttendanceTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_UPDATED_AT)) {
            $criteria->add(AttendanceTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_START_ITOWNID)) {
            $criteria->add(AttendanceTableMap::COL_START_ITOWNID, $this->start_itownid);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_END_ITOWNID)) {
            $criteria->add(AttendanceTableMap::COL_END_ITOWNID, $this->end_itownid);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_VISITED_ITOWNID)) {
            $criteria->add(AttendanceTableMap::COL_VISITED_ITOWNID, $this->visited_itownid);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_EXPENSE_ID)) {
            $criteria->add(AttendanceTableMap::COL_EXPENSE_ID, $this->expense_id);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_IS_UPDATED)) {
            $criteria->add(AttendanceTableMap::COL_IS_UPDATED, $this->is_updated);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_EXPENSE_GENERATED)) {
            $criteria->add(AttendanceTableMap::COL_EXPENSE_GENERATED, $this->expense_generated);
        }
        if ($this->isColumnModified(AttendanceTableMap::COL_EXPENSE_REMARK)) {
            $criteria->add(AttendanceTableMap::COL_EXPENSE_REMARK, $this->expense_remark);
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
        $criteria = ChildAttendanceQuery::create();
        $criteria->add(AttendanceTableMap::COL_ATTENDANCE_ID, $this->attendance_id);

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
        $validPk = null !== $this->getAttendanceId();

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
        return $this->getAttendanceId();
    }

    /**
     * Generic method to set the primary key (attendance_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setAttendanceId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getAttendanceId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\Attendance (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setEmployeeId($this->getEmployeeId());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setAttendanceDate($this->getAttendanceDate());
        $copyObj->setStartTime($this->getStartTime());
        $copyObj->setEndTime($this->getEndTime());
        $copyObj->setStartLatlng($this->getStartLatlng());
        $copyObj->setStartAddress($this->getStartAddress());
        $copyObj->setEndLatlng($this->getEndLatlng());
        $copyObj->setEndAddress($this->getEndAddress());
        $copyObj->setShiftMins($this->getShiftMins());
        $copyObj->setJointEmp($this->getJointEmp());
        $copyObj->setRemark($this->getRemark());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setOutletCount($this->getOutletCount());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setStartItownid($this->getStartItownid());
        $copyObj->setEndItownid($this->getEndItownid());
        $copyObj->setVisitedItownid($this->getVisitedItownid());
        $copyObj->setExpenseId($this->getExpenseId());
        $copyObj->setIsUpdated($this->getIsUpdated());
        $copyObj->setExpenseGenerated($this->getExpenseGenerated());
        $copyObj->setExpenseRemark($this->getExpenseRemark());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setAttendanceId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\Attendance Clone of current object.
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
     * Declares an association between this object and a ChildGeoTowns object.
     *
     * @param ChildGeoTowns|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setGeoTownsRelatedByEndItownid(ChildGeoTowns $v = null)
    {
        if ($v === null) {
            $this->setEndItownid(NULL);
        } else {
            $this->setEndItownid($v->getItownid());
        }

        $this->aGeoTownsRelatedByEndItownid = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildGeoTowns object, it will not be re-added.
        if ($v !== null) {
            $v->addAttendanceRelatedByEndItownid($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildGeoTowns object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildGeoTowns|null The associated ChildGeoTowns object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getGeoTownsRelatedByEndItownid(?ConnectionInterface $con = null)
    {
        if ($this->aGeoTownsRelatedByEndItownid === null && ($this->end_itownid != 0)) {
            $this->aGeoTownsRelatedByEndItownid = ChildGeoTownsQuery::create()->findPk($this->end_itownid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aGeoTownsRelatedByEndItownid->addAttendancesRelatedByEndItownid($this);
             */
        }

        return $this->aGeoTownsRelatedByEndItownid;
    }

    /**
     * Declares an association between this object and a ChildExpenses object.
     *
     * @param ChildExpenses|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setExpenses(ChildExpenses $v = null)
    {
        if ($v === null) {
            $this->setExpenseId(NULL);
        } else {
            $this->setExpenseId($v->getExpId());
        }

        $this->aExpenses = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildExpenses object, it will not be re-added.
        if ($v !== null) {
            $v->addAttendance($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildExpenses object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildExpenses|null The associated ChildExpenses object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getExpenses(?ConnectionInterface $con = null)
    {
        if ($this->aExpenses === null && ($this->expense_id != 0)) {
            $this->aExpenses = ChildExpensesQuery::create()->findPk($this->expense_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aExpenses->addAttendances($this);
             */
        }

        return $this->aExpenses;
    }

    /**
     * Declares an association between this object and a ChildGeoTowns object.
     *
     * @param ChildGeoTowns|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setGeoTownsRelatedByStartItownid(ChildGeoTowns $v = null)
    {
        if ($v === null) {
            $this->setStartItownid(NULL);
        } else {
            $this->setStartItownid($v->getItownid());
        }

        $this->aGeoTownsRelatedByStartItownid = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildGeoTowns object, it will not be re-added.
        if ($v !== null) {
            $v->addAttendanceRelatedByStartItownid($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildGeoTowns object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildGeoTowns|null The associated ChildGeoTowns object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getGeoTownsRelatedByStartItownid(?ConnectionInterface $con = null)
    {
        if ($this->aGeoTownsRelatedByStartItownid === null && ($this->start_itownid != 0)) {
            $this->aGeoTownsRelatedByStartItownid = ChildGeoTownsQuery::create()->findPk($this->start_itownid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aGeoTownsRelatedByStartItownid->addAttendancesRelatedByStartItownid($this);
             */
        }

        return $this->aGeoTownsRelatedByStartItownid;
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
            $v->addAttendance($this);
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
                $this->aCompany->addAttendances($this);
             */
        }

        return $this->aCompany;
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
            $this->setEmployeeId(NULL);
        } else {
            $this->setEmployeeId($v->getEmployeeId());
        }

        $this->aEmployee = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildEmployee object, it will not be re-added.
        if ($v !== null) {
            $v->addAttendance($this);
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
                $this->aEmployee->addAttendances($this);
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
        if (null !== $this->aGeoTownsRelatedByEndItownid) {
            $this->aGeoTownsRelatedByEndItownid->removeAttendanceRelatedByEndItownid($this);
        }
        if (null !== $this->aExpenses) {
            $this->aExpenses->removeAttendance($this);
        }
        if (null !== $this->aGeoTownsRelatedByStartItownid) {
            $this->aGeoTownsRelatedByStartItownid->removeAttendanceRelatedByStartItownid($this);
        }
        if (null !== $this->aCompany) {
            $this->aCompany->removeAttendance($this);
        }
        if (null !== $this->aEmployee) {
            $this->aEmployee->removeAttendance($this);
        }
        $this->attendance_id = null;
        $this->employee_id = null;
        $this->company_id = null;
        $this->attendance_date = null;
        $this->start_time = null;
        $this->end_time = null;
        $this->start_latlng = null;
        $this->start_address = null;
        $this->end_latlng = null;
        $this->end_address = null;
        $this->shift_mins = null;
        $this->joint_emp = null;
        $this->remark = null;
        $this->status = null;
        $this->outlet_count = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->start_itownid = null;
        $this->end_itownid = null;
        $this->visited_itownid = null;
        $this->expense_id = null;
        $this->is_updated = null;
        $this->expense_generated = null;
        $this->expense_remark = null;
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

        $this->aGeoTownsRelatedByEndItownid = null;
        $this->aExpenses = null;
        $this->aGeoTownsRelatedByStartItownid = null;
        $this->aCompany = null;
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
        return (string) $this->exportTo(AttendanceTableMap::DEFAULT_STRING_FORMAT);
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
