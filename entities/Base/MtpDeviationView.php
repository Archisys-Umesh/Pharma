<?php

namespace entities\Base;

use \DateTime;
use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use entities\Map\MtpDeviationViewTableMap;

/**
 * Base class that represents a row from the 'mtp_deviation_view' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class MtpDeviationView implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\MtpDeviationViewTableMap';


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
     * The value for the bu field.
     *
     * @var        string|null
     */
    protected $bu;

    /**
     * The value for the level3 field.
     *
     * @var        string|null
     */
    protected $level3;

    /**
     * The value for the level2 field.
     *
     * @var        string|null
     */
    protected $level2;

    /**
     * The value for the level1 field.
     *
     * @var        string|null
     */
    protected $level1;

    /**
     * The value for the position_id field.
     *
     * @var        int|null
     */
    protected $position_id;

    /**
     * The value for the location field.
     *
     * @var        string|null
     */
    protected $location;

    /**
     * The value for the repname field.
     *
     * @var        string|null
     */
    protected $repname;

    /**
     * The value for the employee_code field.
     *
     * @var        string|null
     */
    protected $employee_code;

    /**
     * The value for the designation field.
     *
     * @var        string|null
     */
    protected $designation;

    /**
     * The value for the date field.
     *
     * @var        DateTime|null
     */
    protected $date;

    /**
     * The value for the planned_activity field.
     *
     * @var        string|null
     */
    protected $planned_activity;

    /**
     * The value for the actual_activity field.
     *
     * @var        string|null
     */
    protected $actual_activity;

    /**
     * The value for the planned_patch field.
     *
     * @var        string|null
     */
    protected $planned_patch;

    /**
     * The value for the covered_patch field.
     *
     * @var        string|null
     */
    protected $covered_patch;

    /**
     * The value for the plannedtown field.
     *
     * @var        string|null
     */
    protected $plannedtown;

    /**
     * The value for the coveredtown field.
     *
     * @var        string|null
     */
    protected $coveredtown;

    /**
     * The value for the totalcalls_made field.
     *
     * @var        int|null
     */
    protected $totalcalls_made;

    /**
     * The value for the doctor_planned field.
     *
     * @var        int|null
     */
    protected $doctor_planned;

    /**
     * The value for the doctor_covered field.
     *
     * @var        int|null
     */
    protected $doctor_covered;

    /**
     * The value for the retailer_planned field.
     *
     * @var        int|null
     */
    protected $retailer_planned;

    /**
     * The value for the retailer_covered field.
     *
     * @var        int|null
     */
    protected $retailer_covered;

    /**
     * The value for the stokiest_planned field.
     *
     * @var        int|null
     */
    protected $stokiest_planned;

    /**
     * The value for the stokiest_covered field.
     *
     * @var        int|null
     */
    protected $stokiest_covered;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of entities\Base\MtpDeviationView object.
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
     * Compares this with another <code>MtpDeviationView</code> instance.  If
     * <code>obj</code> is an instance of <code>MtpDeviationView</code>, delegates to
     * <code>equals(MtpDeviationView)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [bu] column value.
     *
     * @return string|null
     */
    public function getBu()
    {
        return $this->bu;
    }

    /**
     * Get the [level3] column value.
     *
     * @return string|null
     */
    public function getLevel3()
    {
        return $this->level3;
    }

    /**
     * Get the [level2] column value.
     *
     * @return string|null
     */
    public function getLevel2()
    {
        return $this->level2;
    }

    /**
     * Get the [level1] column value.
     *
     * @return string|null
     */
    public function getLevel1()
    {
        return $this->level1;
    }

    /**
     * Get the [position_id] column value.
     *
     * @return int|null
     */
    public function getPositionId()
    {
        return $this->position_id;
    }

    /**
     * Get the [location] column value.
     *
     * @return string|null
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Get the [repname] column value.
     *
     * @return string|null
     */
    public function getRepname()
    {
        return $this->repname;
    }

    /**
     * Get the [employee_code] column value.
     *
     * @return string|null
     */
    public function getEmployeeCode()
    {
        return $this->employee_code;
    }

    /**
     * Get the [designation] column value.
     *
     * @return string|null
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Get the [optionally formatted] temporal [date] column value.
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
    public function getDate($format = null)
    {
        if ($format === null) {
            return $this->date;
        } else {
            return $this->date instanceof \DateTimeInterface ? $this->date->format($format) : null;
        }
    }

    /**
     * Get the [planned_activity] column value.
     *
     * @return string|null
     */
    public function getPlannedActivity()
    {
        return $this->planned_activity;
    }

    /**
     * Get the [actual_activity] column value.
     *
     * @return string|null
     */
    public function getActualActivity()
    {
        return $this->actual_activity;
    }

    /**
     * Get the [planned_patch] column value.
     *
     * @return string|null
     */
    public function getPlannedPatch()
    {
        return $this->planned_patch;
    }

    /**
     * Get the [covered_patch] column value.
     *
     * @return string|null
     */
    public function getCoveredPatch()
    {
        return $this->covered_patch;
    }

    /**
     * Get the [plannedtown] column value.
     *
     * @return string|null
     */
    public function getPlannedtown()
    {
        return $this->plannedtown;
    }

    /**
     * Get the [coveredtown] column value.
     *
     * @return string|null
     */
    public function getCoveredtown()
    {
        return $this->coveredtown;
    }

    /**
     * Get the [totalcalls_made] column value.
     *
     * @return int|null
     */
    public function getTotalcallsMade()
    {
        return $this->totalcalls_made;
    }

    /**
     * Get the [doctor_planned] column value.
     *
     * @return int|null
     */
    public function getDoctorPlanned()
    {
        return $this->doctor_planned;
    }

    /**
     * Get the [doctor_covered] column value.
     *
     * @return int|null
     */
    public function getDoctorCovered()
    {
        return $this->doctor_covered;
    }

    /**
     * Get the [retailer_planned] column value.
     *
     * @return int|null
     */
    public function getRetailerPlanned()
    {
        return $this->retailer_planned;
    }

    /**
     * Get the [retailer_covered] column value.
     *
     * @return int|null
     */
    public function getRetailerCovered()
    {
        return $this->retailer_covered;
    }

    /**
     * Get the [stokiest_planned] column value.
     *
     * @return int|null
     */
    public function getStokiestPlanned()
    {
        return $this->stokiest_planned;
    }

    /**
     * Get the [stokiest_covered] column value.
     *
     * @return int|null
     */
    public function getStokiestCovered()
    {
        return $this->stokiest_covered;
    }

    /**
     * Set the value of [bu] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setBu($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->bu !== $v) {
            $this->bu = $v;
            $this->modifiedColumns[MtpDeviationViewTableMap::COL_BU] = true;
        }

        return $this;
    }

    /**
     * Set the value of [level3] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setLevel3($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->level3 !== $v) {
            $this->level3 = $v;
            $this->modifiedColumns[MtpDeviationViewTableMap::COL_LEVEL3] = true;
        }

        return $this;
    }

    /**
     * Set the value of [level2] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setLevel2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->level2 !== $v) {
            $this->level2 = $v;
            $this->modifiedColumns[MtpDeviationViewTableMap::COL_LEVEL2] = true;
        }

        return $this;
    }

    /**
     * Set the value of [level1] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setLevel1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->level1 !== $v) {
            $this->level1 = $v;
            $this->modifiedColumns[MtpDeviationViewTableMap::COL_LEVEL1] = true;
        }

        return $this;
    }

    /**
     * Set the value of [position_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setPositionId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->position_id !== $v) {
            $this->position_id = $v;
            $this->modifiedColumns[MtpDeviationViewTableMap::COL_POSITION_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [location] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setLocation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->location !== $v) {
            $this->location = $v;
            $this->modifiedColumns[MtpDeviationViewTableMap::COL_LOCATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [repname] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRepname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->repname !== $v) {
            $this->repname = $v;
            $this->modifiedColumns[MtpDeviationViewTableMap::COL_REPNAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmployeeCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->employee_code !== $v) {
            $this->employee_code = $v;
            $this->modifiedColumns[MtpDeviationViewTableMap::COL_EMPLOYEE_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [designation] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setDesignation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->designation !== $v) {
            $this->designation = $v;
            $this->modifiedColumns[MtpDeviationViewTableMap::COL_DESIGNATION] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    protected function setDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date !== null || $dt !== null) {
            if ($this->date === null || $dt === null || $dt->format("Y-m-d") !== $this->date->format("Y-m-d")) {
                $this->date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[MtpDeviationViewTableMap::COL_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [planned_activity] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setPlannedActivity($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->planned_activity !== $v) {
            $this->planned_activity = $v;
            $this->modifiedColumns[MtpDeviationViewTableMap::COL_PLANNED_ACTIVITY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [actual_activity] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setActualActivity($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->actual_activity !== $v) {
            $this->actual_activity = $v;
            $this->modifiedColumns[MtpDeviationViewTableMap::COL_ACTUAL_ACTIVITY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [planned_patch] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setPlannedPatch($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->planned_patch !== $v) {
            $this->planned_patch = $v;
            $this->modifiedColumns[MtpDeviationViewTableMap::COL_PLANNED_PATCH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [covered_patch] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setCoveredPatch($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->covered_patch !== $v) {
            $this->covered_patch = $v;
            $this->modifiedColumns[MtpDeviationViewTableMap::COL_COVERED_PATCH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [plannedtown] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setPlannedtown($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->plannedtown !== $v) {
            $this->plannedtown = $v;
            $this->modifiedColumns[MtpDeviationViewTableMap::COL_PLANNEDTOWN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [coveredtown] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setCoveredtown($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->coveredtown !== $v) {
            $this->coveredtown = $v;
            $this->modifiedColumns[MtpDeviationViewTableMap::COL_COVEREDTOWN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [totalcalls_made] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setTotalcallsMade($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->totalcalls_made !== $v) {
            $this->totalcalls_made = $v;
            $this->modifiedColumns[MtpDeviationViewTableMap::COL_TOTALCALLS_MADE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [doctor_planned] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setDoctorPlanned($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->doctor_planned !== $v) {
            $this->doctor_planned = $v;
            $this->modifiedColumns[MtpDeviationViewTableMap::COL_DOCTOR_PLANNED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [doctor_covered] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setDoctorCovered($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->doctor_covered !== $v) {
            $this->doctor_covered = $v;
            $this->modifiedColumns[MtpDeviationViewTableMap::COL_DOCTOR_COVERED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [retailer_planned] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRetailerPlanned($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->retailer_planned !== $v) {
            $this->retailer_planned = $v;
            $this->modifiedColumns[MtpDeviationViewTableMap::COL_RETAILER_PLANNED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [retailer_covered] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRetailerCovered($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->retailer_covered !== $v) {
            $this->retailer_covered = $v;
            $this->modifiedColumns[MtpDeviationViewTableMap::COL_RETAILER_COVERED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [stokiest_planned] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setStokiestPlanned($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->stokiest_planned !== $v) {
            $this->stokiest_planned = $v;
            $this->modifiedColumns[MtpDeviationViewTableMap::COL_STOKIEST_PLANNED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [stokiest_covered] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setStokiestCovered($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->stokiest_covered !== $v) {
            $this->stokiest_covered = $v;
            $this->modifiedColumns[MtpDeviationViewTableMap::COL_STOKIEST_COVERED] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : MtpDeviationViewTableMap::translateFieldName('Bu', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bu = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : MtpDeviationViewTableMap::translateFieldName('Level3', TableMap::TYPE_PHPNAME, $indexType)];
            $this->level3 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : MtpDeviationViewTableMap::translateFieldName('Level2', TableMap::TYPE_PHPNAME, $indexType)];
            $this->level2 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : MtpDeviationViewTableMap::translateFieldName('Level1', TableMap::TYPE_PHPNAME, $indexType)];
            $this->level1 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : MtpDeviationViewTableMap::translateFieldName('PositionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : MtpDeviationViewTableMap::translateFieldName('Location', TableMap::TYPE_PHPNAME, $indexType)];
            $this->location = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : MtpDeviationViewTableMap::translateFieldName('Repname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->repname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : MtpDeviationViewTableMap::translateFieldName('EmployeeCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : MtpDeviationViewTableMap::translateFieldName('Designation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->designation = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : MtpDeviationViewTableMap::translateFieldName('Date', TableMap::TYPE_PHPNAME, $indexType)];
            $this->date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : MtpDeviationViewTableMap::translateFieldName('PlannedActivity', TableMap::TYPE_PHPNAME, $indexType)];
            $this->planned_activity = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : MtpDeviationViewTableMap::translateFieldName('ActualActivity', TableMap::TYPE_PHPNAME, $indexType)];
            $this->actual_activity = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : MtpDeviationViewTableMap::translateFieldName('PlannedPatch', TableMap::TYPE_PHPNAME, $indexType)];
            $this->planned_patch = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : MtpDeviationViewTableMap::translateFieldName('CoveredPatch', TableMap::TYPE_PHPNAME, $indexType)];
            $this->covered_patch = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : MtpDeviationViewTableMap::translateFieldName('Plannedtown', TableMap::TYPE_PHPNAME, $indexType)];
            $this->plannedtown = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : MtpDeviationViewTableMap::translateFieldName('Coveredtown', TableMap::TYPE_PHPNAME, $indexType)];
            $this->coveredtown = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : MtpDeviationViewTableMap::translateFieldName('TotalcallsMade', TableMap::TYPE_PHPNAME, $indexType)];
            $this->totalcalls_made = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : MtpDeviationViewTableMap::translateFieldName('DoctorPlanned', TableMap::TYPE_PHPNAME, $indexType)];
            $this->doctor_planned = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : MtpDeviationViewTableMap::translateFieldName('DoctorCovered', TableMap::TYPE_PHPNAME, $indexType)];
            $this->doctor_covered = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : MtpDeviationViewTableMap::translateFieldName('RetailerPlanned', TableMap::TYPE_PHPNAME, $indexType)];
            $this->retailer_planned = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : MtpDeviationViewTableMap::translateFieldName('RetailerCovered', TableMap::TYPE_PHPNAME, $indexType)];
            $this->retailer_covered = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : MtpDeviationViewTableMap::translateFieldName('StokiestPlanned', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stokiest_planned = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : MtpDeviationViewTableMap::translateFieldName('StokiestCovered', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stokiest_covered = (null !== $col) ? (int) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 23; // 23 = MtpDeviationViewTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\MtpDeviationView'), 0, $e);
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
        $pos = MtpDeviationViewTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getBu();

            case 1:
                return $this->getLevel3();

            case 2:
                return $this->getLevel2();

            case 3:
                return $this->getLevel1();

            case 4:
                return $this->getPositionId();

            case 5:
                return $this->getLocation();

            case 6:
                return $this->getRepname();

            case 7:
                return $this->getEmployeeCode();

            case 8:
                return $this->getDesignation();

            case 9:
                return $this->getDate();

            case 10:
                return $this->getPlannedActivity();

            case 11:
                return $this->getActualActivity();

            case 12:
                return $this->getPlannedPatch();

            case 13:
                return $this->getCoveredPatch();

            case 14:
                return $this->getPlannedtown();

            case 15:
                return $this->getCoveredtown();

            case 16:
                return $this->getTotalcallsMade();

            case 17:
                return $this->getDoctorPlanned();

            case 18:
                return $this->getDoctorCovered();

            case 19:
                return $this->getRetailerPlanned();

            case 20:
                return $this->getRetailerCovered();

            case 21:
                return $this->getStokiestPlanned();

            case 22:
                return $this->getStokiestCovered();

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
        if (isset($alreadyDumpedObjects['MtpDeviationView'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['MtpDeviationView'][$this->hashCode()] = true;
        $keys = MtpDeviationViewTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getBu(),
            $keys[1] => $this->getLevel3(),
            $keys[2] => $this->getLevel2(),
            $keys[3] => $this->getLevel1(),
            $keys[4] => $this->getPositionId(),
            $keys[5] => $this->getLocation(),
            $keys[6] => $this->getRepname(),
            $keys[7] => $this->getEmployeeCode(),
            $keys[8] => $this->getDesignation(),
            $keys[9] => $this->getDate(),
            $keys[10] => $this->getPlannedActivity(),
            $keys[11] => $this->getActualActivity(),
            $keys[12] => $this->getPlannedPatch(),
            $keys[13] => $this->getCoveredPatch(),
            $keys[14] => $this->getPlannedtown(),
            $keys[15] => $this->getCoveredtown(),
            $keys[16] => $this->getTotalcallsMade(),
            $keys[17] => $this->getDoctorPlanned(),
            $keys[18] => $this->getDoctorCovered(),
            $keys[19] => $this->getRetailerPlanned(),
            $keys[20] => $this->getRetailerCovered(),
            $keys[21] => $this->getStokiestPlanned(),
            $keys[22] => $this->getStokiestCovered(),
        ];
        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('Y-m-d');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }


        return $result;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria(): Criteria
    {
        $criteria = new Criteria(MtpDeviationViewTableMap::DATABASE_NAME);

        if ($this->isColumnModified(MtpDeviationViewTableMap::COL_BU)) {
            $criteria->add(MtpDeviationViewTableMap::COL_BU, $this->bu);
        }
        if ($this->isColumnModified(MtpDeviationViewTableMap::COL_LEVEL3)) {
            $criteria->add(MtpDeviationViewTableMap::COL_LEVEL3, $this->level3);
        }
        if ($this->isColumnModified(MtpDeviationViewTableMap::COL_LEVEL2)) {
            $criteria->add(MtpDeviationViewTableMap::COL_LEVEL2, $this->level2);
        }
        if ($this->isColumnModified(MtpDeviationViewTableMap::COL_LEVEL1)) {
            $criteria->add(MtpDeviationViewTableMap::COL_LEVEL1, $this->level1);
        }
        if ($this->isColumnModified(MtpDeviationViewTableMap::COL_POSITION_ID)) {
            $criteria->add(MtpDeviationViewTableMap::COL_POSITION_ID, $this->position_id);
        }
        if ($this->isColumnModified(MtpDeviationViewTableMap::COL_LOCATION)) {
            $criteria->add(MtpDeviationViewTableMap::COL_LOCATION, $this->location);
        }
        if ($this->isColumnModified(MtpDeviationViewTableMap::COL_REPNAME)) {
            $criteria->add(MtpDeviationViewTableMap::COL_REPNAME, $this->repname);
        }
        if ($this->isColumnModified(MtpDeviationViewTableMap::COL_EMPLOYEE_CODE)) {
            $criteria->add(MtpDeviationViewTableMap::COL_EMPLOYEE_CODE, $this->employee_code);
        }
        if ($this->isColumnModified(MtpDeviationViewTableMap::COL_DESIGNATION)) {
            $criteria->add(MtpDeviationViewTableMap::COL_DESIGNATION, $this->designation);
        }
        if ($this->isColumnModified(MtpDeviationViewTableMap::COL_DATE)) {
            $criteria->add(MtpDeviationViewTableMap::COL_DATE, $this->date);
        }
        if ($this->isColumnModified(MtpDeviationViewTableMap::COL_PLANNED_ACTIVITY)) {
            $criteria->add(MtpDeviationViewTableMap::COL_PLANNED_ACTIVITY, $this->planned_activity);
        }
        if ($this->isColumnModified(MtpDeviationViewTableMap::COL_ACTUAL_ACTIVITY)) {
            $criteria->add(MtpDeviationViewTableMap::COL_ACTUAL_ACTIVITY, $this->actual_activity);
        }
        if ($this->isColumnModified(MtpDeviationViewTableMap::COL_PLANNED_PATCH)) {
            $criteria->add(MtpDeviationViewTableMap::COL_PLANNED_PATCH, $this->planned_patch);
        }
        if ($this->isColumnModified(MtpDeviationViewTableMap::COL_COVERED_PATCH)) {
            $criteria->add(MtpDeviationViewTableMap::COL_COVERED_PATCH, $this->covered_patch);
        }
        if ($this->isColumnModified(MtpDeviationViewTableMap::COL_PLANNEDTOWN)) {
            $criteria->add(MtpDeviationViewTableMap::COL_PLANNEDTOWN, $this->plannedtown);
        }
        if ($this->isColumnModified(MtpDeviationViewTableMap::COL_COVEREDTOWN)) {
            $criteria->add(MtpDeviationViewTableMap::COL_COVEREDTOWN, $this->coveredtown);
        }
        if ($this->isColumnModified(MtpDeviationViewTableMap::COL_TOTALCALLS_MADE)) {
            $criteria->add(MtpDeviationViewTableMap::COL_TOTALCALLS_MADE, $this->totalcalls_made);
        }
        if ($this->isColumnModified(MtpDeviationViewTableMap::COL_DOCTOR_PLANNED)) {
            $criteria->add(MtpDeviationViewTableMap::COL_DOCTOR_PLANNED, $this->doctor_planned);
        }
        if ($this->isColumnModified(MtpDeviationViewTableMap::COL_DOCTOR_COVERED)) {
            $criteria->add(MtpDeviationViewTableMap::COL_DOCTOR_COVERED, $this->doctor_covered);
        }
        if ($this->isColumnModified(MtpDeviationViewTableMap::COL_RETAILER_PLANNED)) {
            $criteria->add(MtpDeviationViewTableMap::COL_RETAILER_PLANNED, $this->retailer_planned);
        }
        if ($this->isColumnModified(MtpDeviationViewTableMap::COL_RETAILER_COVERED)) {
            $criteria->add(MtpDeviationViewTableMap::COL_RETAILER_COVERED, $this->retailer_covered);
        }
        if ($this->isColumnModified(MtpDeviationViewTableMap::COL_STOKIEST_PLANNED)) {
            $criteria->add(MtpDeviationViewTableMap::COL_STOKIEST_PLANNED, $this->stokiest_planned);
        }
        if ($this->isColumnModified(MtpDeviationViewTableMap::COL_STOKIEST_COVERED)) {
            $criteria->add(MtpDeviationViewTableMap::COL_STOKIEST_COVERED, $this->stokiest_covered);
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
        throw new LogicException('The MtpDeviationView object has no primary key');

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
        $validPk = false;

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
     * Returns NULL since this table doesn't have a primary key.
     * This method exists only for BC and is deprecated!
     * @return null
     */
    public function getPrimaryKey()
    {
        return null;
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return false;
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\MtpDeviationView (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setBu($this->getBu());
        $copyObj->setLevel3($this->getLevel3());
        $copyObj->setLevel2($this->getLevel2());
        $copyObj->setLevel1($this->getLevel1());
        $copyObj->setPositionId($this->getPositionId());
        $copyObj->setLocation($this->getLocation());
        $copyObj->setRepname($this->getRepname());
        $copyObj->setEmployeeCode($this->getEmployeeCode());
        $copyObj->setDesignation($this->getDesignation());
        $copyObj->setDate($this->getDate());
        $copyObj->setPlannedActivity($this->getPlannedActivity());
        $copyObj->setActualActivity($this->getActualActivity());
        $copyObj->setPlannedPatch($this->getPlannedPatch());
        $copyObj->setCoveredPatch($this->getCoveredPatch());
        $copyObj->setPlannedtown($this->getPlannedtown());
        $copyObj->setCoveredtown($this->getCoveredtown());
        $copyObj->setTotalcallsMade($this->getTotalcallsMade());
        $copyObj->setDoctorPlanned($this->getDoctorPlanned());
        $copyObj->setDoctorCovered($this->getDoctorCovered());
        $copyObj->setRetailerPlanned($this->getRetailerPlanned());
        $copyObj->setRetailerCovered($this->getRetailerCovered());
        $copyObj->setStokiestPlanned($this->getStokiestPlanned());
        $copyObj->setStokiestCovered($this->getStokiestCovered());
        if ($makeNew) {
            $copyObj->setNew(true);
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
     * @return \entities\MtpDeviationView Clone of current object.
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
        $this->bu = null;
        $this->level3 = null;
        $this->level2 = null;
        $this->level1 = null;
        $this->position_id = null;
        $this->location = null;
        $this->repname = null;
        $this->employee_code = null;
        $this->designation = null;
        $this->date = null;
        $this->planned_activity = null;
        $this->actual_activity = null;
        $this->planned_patch = null;
        $this->covered_patch = null;
        $this->plannedtown = null;
        $this->coveredtown = null;
        $this->totalcalls_made = null;
        $this->doctor_planned = null;
        $this->doctor_covered = null;
        $this->retailer_planned = null;
        $this->retailer_covered = null;
        $this->stokiest_planned = null;
        $this->stokiest_covered = null;
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
        return (string) $this->exportTo(MtpDeviationViewTableMap::DEFAULT_STRING_FORMAT);
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
