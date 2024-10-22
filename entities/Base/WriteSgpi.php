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
use entities\WriteSgpiQuery as ChildWriteSgpiQuery;
use entities\Map\WriteSgpiTableMap;

/**
 * Base class that represents a row from the 'write_sgpi' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class WriteSgpi implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\WriteSgpiTableMap';


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
     * The value for the division field.
     *
     * @var        string|null
     */
    protected $division;

    /**
     * The value for the employee_id field.
     *
     * @var        int|null
     */
    protected $employee_id;

    /**
     * The value for the employee_name field.
     *
     * @var        string|null
     */
    protected $employee_name;

    /**
     * The value for the location field.
     *
     * @var        string|null
     */
    protected $location;

    /**
     * The value for the location_code field.
     *
     * @var        int|null
     */
    protected $location_code;

    /**
     * The value for the dr_code field.
     *
     * @var        int|null
     */
    protected $dr_code;

    /**
     * The value for the dr_name field.
     *
     * @var        string|null
     */
    protected $dr_name;

    /**
     * The value for the dr_specialty field.
     *
     * @var        string|null
     */
    protected $dr_specialty;

    /**
     * The value for the month field.
     *
     * @var        string|null
     */
    protected $month;

    /**
     * The value for the dr_tags field.
     *
     * @var        string|null
     */
    protected $dr_tags;

    /**
     * The value for the brand field.
     *
     * @var        string|null
     */
    protected $brand;

    /**
     * The value for the sgpi_tagged field.
     *
     * @var        string|null
     */
    protected $sgpi_tagged;

    /**
     * The value for the brand_sgpi_distributed field.
     *
     * @var        int|null
     */
    protected $brand_sgpi_distributed;

    /**
     * The value for the mr_call_done field.
     *
     * @var        int|null
     */
    protected $mr_call_done;

    /**
     * The value for the am_call_done field.
     *
     * @var        int|null
     */
    protected $am_call_done;

    /**
     * The value for the rm_call_done field.
     *
     * @var        int|null
     */
    protected $rm_call_done;

    /**
     * The value for the zm_call_done field.
     *
     * @var        int|null
     */
    protected $zm_call_done;

    /**
     * The value for the zm_position field.
     *
     * @var        string|null
     */
    protected $zm_position;

    /**
     * The value for the rm_position field.
     *
     * @var        string|null
     */
    protected $rm_position;

    /**
     * The value for the am_position field.
     *
     * @var        string|null
     */
    protected $am_position;

    /**
     * The value for the zm_position_code field.
     *
     * @var        int|null
     */
    protected $zm_position_code;

    /**
     * The value for the rm_position_code field.
     *
     * @var        int|null
     */
    protected $rm_position_code;

    /**
     * The value for the am_position_code field.
     *
     * @var        int|null
     */
    protected $am_position_code;

    /**
     * The value for the employee_position_code field.
     *
     * @var        int|null
     */
    protected $employee_position_code;

    /**
     * The value for the employee_position_name field.
     *
     * @var        string|null
     */
    protected $employee_position_name;

    /**
     * The value for the employee_level field.
     *
     * @var        string|null
     */
    protected $employee_level;

    /**
     * The value for the sgpi_report_id field.
     *
     * @var        int
     */
    protected $sgpi_report_id;

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
     * Initializes internal state of entities\Base\WriteSgpi object.
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
     * Compares this with another <code>WriteSgpi</code> instance.  If
     * <code>obj</code> is an instance of <code>WriteSgpi</code>, delegates to
     * <code>equals(WriteSgpi)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [division] column value.
     *
     * @return string|null
     */
    public function getDivision()
    {
        return $this->division;
    }

    /**
     * Get the [employee_id] column value.
     *
     * @return int|null
     */
    public function getEmployeeId()
    {
        return $this->employee_id;
    }

    /**
     * Get the [employee_name] column value.
     *
     * @return string|null
     */
    public function getEmployeeName()
    {
        return $this->employee_name;
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
     * Get the [location_code] column value.
     *
     * @return int|null
     */
    public function getLocationCode()
    {
        return $this->location_code;
    }

    /**
     * Get the [dr_code] column value.
     *
     * @return int|null
     */
    public function getDrCode()
    {
        return $this->dr_code;
    }

    /**
     * Get the [dr_name] column value.
     *
     * @return string|null
     */
    public function getDrName()
    {
        return $this->dr_name;
    }

    /**
     * Get the [dr_specialty] column value.
     *
     * @return string|null
     */
    public function getDrSpecialty()
    {
        return $this->dr_specialty;
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
     * Get the [dr_tags] column value.
     *
     * @return string|null
     */
    public function getDrTags()
    {
        return $this->dr_tags;
    }

    /**
     * Get the [brand] column value.
     *
     * @return string|null
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Get the [sgpi_tagged] column value.
     *
     * @return string|null
     */
    public function getSgpiTagged()
    {
        return $this->sgpi_tagged;
    }

    /**
     * Get the [brand_sgpi_distributed] column value.
     *
     * @return int|null
     */
    public function getBrandSgpiDistributed()
    {
        return $this->brand_sgpi_distributed;
    }

    /**
     * Get the [mr_call_done] column value.
     *
     * @return int|null
     */
    public function getMrCallDone()
    {
        return $this->mr_call_done;
    }

    /**
     * Get the [am_call_done] column value.
     *
     * @return int|null
     */
    public function getAmCallDone()
    {
        return $this->am_call_done;
    }

    /**
     * Get the [rm_call_done] column value.
     *
     * @return int|null
     */
    public function getRmCallDone()
    {
        return $this->rm_call_done;
    }

    /**
     * Get the [zm_call_done] column value.
     *
     * @return int|null
     */
    public function getZmCallDone()
    {
        return $this->zm_call_done;
    }

    /**
     * Get the [zm_position] column value.
     *
     * @return string|null
     */
    public function getZmPosition()
    {
        return $this->zm_position;
    }

    /**
     * Get the [rm_position] column value.
     *
     * @return string|null
     */
    public function getRmPosition()
    {
        return $this->rm_position;
    }

    /**
     * Get the [am_position] column value.
     *
     * @return string|null
     */
    public function getAmPosition()
    {
        return $this->am_position;
    }

    /**
     * Get the [zm_position_code] column value.
     *
     * @return int|null
     */
    public function getZmPositionCode()
    {
        return $this->zm_position_code;
    }

    /**
     * Get the [rm_position_code] column value.
     *
     * @return int|null
     */
    public function getRmPositionCode()
    {
        return $this->rm_position_code;
    }

    /**
     * Get the [am_position_code] column value.
     *
     * @return int|null
     */
    public function getAmPositionCode()
    {
        return $this->am_position_code;
    }

    /**
     * Get the [employee_position_code] column value.
     *
     * @return int|null
     */
    public function getEmployeePositionCode()
    {
        return $this->employee_position_code;
    }

    /**
     * Get the [employee_position_name] column value.
     *
     * @return string|null
     */
    public function getEmployeePositionName()
    {
        return $this->employee_position_name;
    }

    /**
     * Get the [employee_level] column value.
     *
     * @return string|null
     */
    public function getEmployeeLevel()
    {
        return $this->employee_level;
    }

    /**
     * Get the [sgpi_report_id] column value.
     *
     * @return int
     */
    public function getSgpiReportId()
    {
        return $this->sgpi_report_id;
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
     * Set the value of [division] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDivision($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->division !== $v) {
            $this->division = $v;
            $this->modifiedColumns[WriteSgpiTableMap::COL_DIVISION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->employee_id !== $v) {
            $this->employee_id = $v;
            $this->modifiedColumns[WriteSgpiTableMap::COL_EMPLOYEE_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeeName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->employee_name !== $v) {
            $this->employee_name = $v;
            $this->modifiedColumns[WriteSgpiTableMap::COL_EMPLOYEE_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [location] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLocation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->location !== $v) {
            $this->location = $v;
            $this->modifiedColumns[WriteSgpiTableMap::COL_LOCATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [location_code] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLocationCode($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->location_code !== $v) {
            $this->location_code = $v;
            $this->modifiedColumns[WriteSgpiTableMap::COL_LOCATION_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [dr_code] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDrCode($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->dr_code !== $v) {
            $this->dr_code = $v;
            $this->modifiedColumns[WriteSgpiTableMap::COL_DR_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [dr_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDrName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dr_name !== $v) {
            $this->dr_name = $v;
            $this->modifiedColumns[WriteSgpiTableMap::COL_DR_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [dr_specialty] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDrSpecialty($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dr_specialty !== $v) {
            $this->dr_specialty = $v;
            $this->modifiedColumns[WriteSgpiTableMap::COL_DR_SPECIALTY] = true;
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
            $this->modifiedColumns[WriteSgpiTableMap::COL_MONTH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [dr_tags] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDrTags($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dr_tags !== $v) {
            $this->dr_tags = $v;
            $this->modifiedColumns[WriteSgpiTableMap::COL_DR_TAGS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [brand] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBrand($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->brand !== $v) {
            $this->brand = $v;
            $this->modifiedColumns[WriteSgpiTableMap::COL_BRAND] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sgpi_tagged] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSgpiTagged($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sgpi_tagged !== $v) {
            $this->sgpi_tagged = $v;
            $this->modifiedColumns[WriteSgpiTableMap::COL_SGPI_TAGGED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [brand_sgpi_distributed] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBrandSgpiDistributed($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->brand_sgpi_distributed !== $v) {
            $this->brand_sgpi_distributed = $v;
            $this->modifiedColumns[WriteSgpiTableMap::COL_BRAND_SGPI_DISTRIBUTED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [mr_call_done] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMrCallDone($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->mr_call_done !== $v) {
            $this->mr_call_done = $v;
            $this->modifiedColumns[WriteSgpiTableMap::COL_MR_CALL_DONE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [am_call_done] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAmCallDone($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->am_call_done !== $v) {
            $this->am_call_done = $v;
            $this->modifiedColumns[WriteSgpiTableMap::COL_AM_CALL_DONE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rm_call_done] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRmCallDone($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->rm_call_done !== $v) {
            $this->rm_call_done = $v;
            $this->modifiedColumns[WriteSgpiTableMap::COL_RM_CALL_DONE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [zm_call_done] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setZmCallDone($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->zm_call_done !== $v) {
            $this->zm_call_done = $v;
            $this->modifiedColumns[WriteSgpiTableMap::COL_ZM_CALL_DONE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [zm_position] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setZmPosition($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zm_position !== $v) {
            $this->zm_position = $v;
            $this->modifiedColumns[WriteSgpiTableMap::COL_ZM_POSITION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rm_position] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRmPosition($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rm_position !== $v) {
            $this->rm_position = $v;
            $this->modifiedColumns[WriteSgpiTableMap::COL_RM_POSITION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [am_position] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAmPosition($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->am_position !== $v) {
            $this->am_position = $v;
            $this->modifiedColumns[WriteSgpiTableMap::COL_AM_POSITION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [zm_position_code] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setZmPositionCode($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->zm_position_code !== $v) {
            $this->zm_position_code = $v;
            $this->modifiedColumns[WriteSgpiTableMap::COL_ZM_POSITION_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rm_position_code] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRmPositionCode($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->rm_position_code !== $v) {
            $this->rm_position_code = $v;
            $this->modifiedColumns[WriteSgpiTableMap::COL_RM_POSITION_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [am_position_code] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAmPositionCode($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->am_position_code !== $v) {
            $this->am_position_code = $v;
            $this->modifiedColumns[WriteSgpiTableMap::COL_AM_POSITION_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_position_code] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeePositionCode($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->employee_position_code !== $v) {
            $this->employee_position_code = $v;
            $this->modifiedColumns[WriteSgpiTableMap::COL_EMPLOYEE_POSITION_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_position_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeePositionName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->employee_position_name !== $v) {
            $this->employee_position_name = $v;
            $this->modifiedColumns[WriteSgpiTableMap::COL_EMPLOYEE_POSITION_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_level] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeeLevel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->employee_level !== $v) {
            $this->employee_level = $v;
            $this->modifiedColumns[WriteSgpiTableMap::COL_EMPLOYEE_LEVEL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sgpi_report_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSgpiReportId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->sgpi_report_id !== $v) {
            $this->sgpi_report_id = $v;
            $this->modifiedColumns[WriteSgpiTableMap::COL_SGPI_REPORT_ID] = true;
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
                $this->modifiedColumns[WriteSgpiTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[WriteSgpiTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : WriteSgpiTableMap::translateFieldName('Division', TableMap::TYPE_PHPNAME, $indexType)];
            $this->division = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : WriteSgpiTableMap::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : WriteSgpiTableMap::translateFieldName('EmployeeName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : WriteSgpiTableMap::translateFieldName('Location', TableMap::TYPE_PHPNAME, $indexType)];
            $this->location = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : WriteSgpiTableMap::translateFieldName('LocationCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->location_code = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : WriteSgpiTableMap::translateFieldName('DrCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dr_code = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : WriteSgpiTableMap::translateFieldName('DrName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dr_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : WriteSgpiTableMap::translateFieldName('DrSpecialty', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dr_specialty = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : WriteSgpiTableMap::translateFieldName('Month', TableMap::TYPE_PHPNAME, $indexType)];
            $this->month = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : WriteSgpiTableMap::translateFieldName('DrTags', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dr_tags = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : WriteSgpiTableMap::translateFieldName('Brand', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : WriteSgpiTableMap::translateFieldName('SgpiTagged', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_tagged = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : WriteSgpiTableMap::translateFieldName('BrandSgpiDistributed', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_sgpi_distributed = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : WriteSgpiTableMap::translateFieldName('MrCallDone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mr_call_done = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : WriteSgpiTableMap::translateFieldName('AmCallDone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->am_call_done = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : WriteSgpiTableMap::translateFieldName('RmCallDone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rm_call_done = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : WriteSgpiTableMap::translateFieldName('ZmCallDone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zm_call_done = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : WriteSgpiTableMap::translateFieldName('ZmPosition', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zm_position = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : WriteSgpiTableMap::translateFieldName('RmPosition', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rm_position = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : WriteSgpiTableMap::translateFieldName('AmPosition', TableMap::TYPE_PHPNAME, $indexType)];
            $this->am_position = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : WriteSgpiTableMap::translateFieldName('ZmPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zm_position_code = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : WriteSgpiTableMap::translateFieldName('RmPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rm_position_code = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : WriteSgpiTableMap::translateFieldName('AmPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->am_position_code = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : WriteSgpiTableMap::translateFieldName('EmployeePositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_position_code = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : WriteSgpiTableMap::translateFieldName('EmployeePositionName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_position_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : WriteSgpiTableMap::translateFieldName('EmployeeLevel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_level = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : WriteSgpiTableMap::translateFieldName('SgpiReportId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_report_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : WriteSgpiTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : WriteSgpiTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 29; // 29 = WriteSgpiTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\WriteSgpi'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(WriteSgpiTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildWriteSgpiQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
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
     * @see WriteSgpi::setDeleted()
     * @see WriteSgpi::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(WriteSgpiTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildWriteSgpiQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(WriteSgpiTableMap::DATABASE_NAME);
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
                WriteSgpiTableMap::addInstanceToPool($this);
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

        $this->modifiedColumns[WriteSgpiTableMap::COL_SGPI_REPORT_ID] = true;
        if (null !== $this->sgpi_report_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . WriteSgpiTableMap::COL_SGPI_REPORT_ID . ')');
        }
        if (null === $this->sgpi_report_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('write_sgpi_sgpi_report_id_seq')");
                $this->sgpi_report_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(WriteSgpiTableMap::COL_DIVISION)) {
            $modifiedColumns[':p' . $index++]  = 'division';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_EMPLOYEE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'employee_id';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_EMPLOYEE_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'employee_name';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_LOCATION)) {
            $modifiedColumns[':p' . $index++]  = 'location';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_LOCATION_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'location_code';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_DR_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'dr_code';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_DR_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'dr_name';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_DR_SPECIALTY)) {
            $modifiedColumns[':p' . $index++]  = 'dr_specialty';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_MONTH)) {
            $modifiedColumns[':p' . $index++]  = 'month';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_DR_TAGS)) {
            $modifiedColumns[':p' . $index++]  = 'dr_tags';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_BRAND)) {
            $modifiedColumns[':p' . $index++]  = 'brand';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_SGPI_TAGGED)) {
            $modifiedColumns[':p' . $index++]  = 'sgpi_tagged';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_BRAND_SGPI_DISTRIBUTED)) {
            $modifiedColumns[':p' . $index++]  = 'brand_sgpi_distributed';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_MR_CALL_DONE)) {
            $modifiedColumns[':p' . $index++]  = 'mr_call_done';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_AM_CALL_DONE)) {
            $modifiedColumns[':p' . $index++]  = 'am_call_done';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_RM_CALL_DONE)) {
            $modifiedColumns[':p' . $index++]  = 'rm_call_done';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_ZM_CALL_DONE)) {
            $modifiedColumns[':p' . $index++]  = 'zm_call_done';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_ZM_POSITION)) {
            $modifiedColumns[':p' . $index++]  = 'zm_position';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_RM_POSITION)) {
            $modifiedColumns[':p' . $index++]  = 'rm_position';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_AM_POSITION)) {
            $modifiedColumns[':p' . $index++]  = 'am_position';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_ZM_POSITION_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'zm_position_code';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_RM_POSITION_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'rm_position_code';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_AM_POSITION_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'am_position_code';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_EMPLOYEE_POSITION_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'employee_position_code';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_EMPLOYEE_POSITION_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'employee_position_name';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_EMPLOYEE_LEVEL)) {
            $modifiedColumns[':p' . $index++]  = 'employee_level';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_SGPI_REPORT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'sgpi_report_id';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO write_sgpi (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'division':
                        $stmt->bindValue($identifier, $this->division, PDO::PARAM_STR);

                        break;
                    case 'employee_id':
                        $stmt->bindValue($identifier, $this->employee_id, PDO::PARAM_INT);

                        break;
                    case 'employee_name':
                        $stmt->bindValue($identifier, $this->employee_name, PDO::PARAM_STR);

                        break;
                    case 'location':
                        $stmt->bindValue($identifier, $this->location, PDO::PARAM_STR);

                        break;
                    case 'location_code':
                        $stmt->bindValue($identifier, $this->location_code, PDO::PARAM_INT);

                        break;
                    case 'dr_code':
                        $stmt->bindValue($identifier, $this->dr_code, PDO::PARAM_INT);

                        break;
                    case 'dr_name':
                        $stmt->bindValue($identifier, $this->dr_name, PDO::PARAM_STR);

                        break;
                    case 'dr_specialty':
                        $stmt->bindValue($identifier, $this->dr_specialty, PDO::PARAM_STR);

                        break;
                    case 'month':
                        $stmt->bindValue($identifier, $this->month, PDO::PARAM_STR);

                        break;
                    case 'dr_tags':
                        $stmt->bindValue($identifier, $this->dr_tags, PDO::PARAM_STR);

                        break;
                    case 'brand':
                        $stmt->bindValue($identifier, $this->brand, PDO::PARAM_STR);

                        break;
                    case 'sgpi_tagged':
                        $stmt->bindValue($identifier, $this->sgpi_tagged, PDO::PARAM_STR);

                        break;
                    case 'brand_sgpi_distributed':
                        $stmt->bindValue($identifier, $this->brand_sgpi_distributed, PDO::PARAM_INT);

                        break;
                    case 'mr_call_done':
                        $stmt->bindValue($identifier, $this->mr_call_done, PDO::PARAM_INT);

                        break;
                    case 'am_call_done':
                        $stmt->bindValue($identifier, $this->am_call_done, PDO::PARAM_INT);

                        break;
                    case 'rm_call_done':
                        $stmt->bindValue($identifier, $this->rm_call_done, PDO::PARAM_INT);

                        break;
                    case 'zm_call_done':
                        $stmt->bindValue($identifier, $this->zm_call_done, PDO::PARAM_INT);

                        break;
                    case 'zm_position':
                        $stmt->bindValue($identifier, $this->zm_position, PDO::PARAM_STR);

                        break;
                    case 'rm_position':
                        $stmt->bindValue($identifier, $this->rm_position, PDO::PARAM_STR);

                        break;
                    case 'am_position':
                        $stmt->bindValue($identifier, $this->am_position, PDO::PARAM_STR);

                        break;
                    case 'zm_position_code':
                        $stmt->bindValue($identifier, $this->zm_position_code, PDO::PARAM_INT);

                        break;
                    case 'rm_position_code':
                        $stmt->bindValue($identifier, $this->rm_position_code, PDO::PARAM_INT);

                        break;
                    case 'am_position_code':
                        $stmt->bindValue($identifier, $this->am_position_code, PDO::PARAM_INT);

                        break;
                    case 'employee_position_code':
                        $stmt->bindValue($identifier, $this->employee_position_code, PDO::PARAM_INT);

                        break;
                    case 'employee_position_name':
                        $stmt->bindValue($identifier, $this->employee_position_name, PDO::PARAM_STR);

                        break;
                    case 'employee_level':
                        $stmt->bindValue($identifier, $this->employee_level, PDO::PARAM_STR);

                        break;
                    case 'sgpi_report_id':
                        $stmt->bindValue($identifier, $this->sgpi_report_id, PDO::PARAM_INT);

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
        $pos = WriteSgpiTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getDivision();

            case 1:
                return $this->getEmployeeId();

            case 2:
                return $this->getEmployeeName();

            case 3:
                return $this->getLocation();

            case 4:
                return $this->getLocationCode();

            case 5:
                return $this->getDrCode();

            case 6:
                return $this->getDrName();

            case 7:
                return $this->getDrSpecialty();

            case 8:
                return $this->getMonth();

            case 9:
                return $this->getDrTags();

            case 10:
                return $this->getBrand();

            case 11:
                return $this->getSgpiTagged();

            case 12:
                return $this->getBrandSgpiDistributed();

            case 13:
                return $this->getMrCallDone();

            case 14:
                return $this->getAmCallDone();

            case 15:
                return $this->getRmCallDone();

            case 16:
                return $this->getZmCallDone();

            case 17:
                return $this->getZmPosition();

            case 18:
                return $this->getRmPosition();

            case 19:
                return $this->getAmPosition();

            case 20:
                return $this->getZmPositionCode();

            case 21:
                return $this->getRmPositionCode();

            case 22:
                return $this->getAmPositionCode();

            case 23:
                return $this->getEmployeePositionCode();

            case 24:
                return $this->getEmployeePositionName();

            case 25:
                return $this->getEmployeeLevel();

            case 26:
                return $this->getSgpiReportId();

            case 27:
                return $this->getCreatedAt();

            case 28:
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
        if (isset($alreadyDumpedObjects['WriteSgpi'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['WriteSgpi'][$this->hashCode()] = true;
        $keys = WriteSgpiTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getDivision(),
            $keys[1] => $this->getEmployeeId(),
            $keys[2] => $this->getEmployeeName(),
            $keys[3] => $this->getLocation(),
            $keys[4] => $this->getLocationCode(),
            $keys[5] => $this->getDrCode(),
            $keys[6] => $this->getDrName(),
            $keys[7] => $this->getDrSpecialty(),
            $keys[8] => $this->getMonth(),
            $keys[9] => $this->getDrTags(),
            $keys[10] => $this->getBrand(),
            $keys[11] => $this->getSgpiTagged(),
            $keys[12] => $this->getBrandSgpiDistributed(),
            $keys[13] => $this->getMrCallDone(),
            $keys[14] => $this->getAmCallDone(),
            $keys[15] => $this->getRmCallDone(),
            $keys[16] => $this->getZmCallDone(),
            $keys[17] => $this->getZmPosition(),
            $keys[18] => $this->getRmPosition(),
            $keys[19] => $this->getAmPosition(),
            $keys[20] => $this->getZmPositionCode(),
            $keys[21] => $this->getRmPositionCode(),
            $keys[22] => $this->getAmPositionCode(),
            $keys[23] => $this->getEmployeePositionCode(),
            $keys[24] => $this->getEmployeePositionName(),
            $keys[25] => $this->getEmployeeLevel(),
            $keys[26] => $this->getSgpiReportId(),
            $keys[27] => $this->getCreatedAt(),
            $keys[28] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[27]] instanceof \DateTimeInterface) {
            $result[$keys[27]] = $result[$keys[27]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[28]] instanceof \DateTimeInterface) {
            $result[$keys[28]] = $result[$keys[28]]->format('Y-m-d H:i:s.u');
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
        $pos = WriteSgpiTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setDivision($value);
                break;
            case 1:
                $this->setEmployeeId($value);
                break;
            case 2:
                $this->setEmployeeName($value);
                break;
            case 3:
                $this->setLocation($value);
                break;
            case 4:
                $this->setLocationCode($value);
                break;
            case 5:
                $this->setDrCode($value);
                break;
            case 6:
                $this->setDrName($value);
                break;
            case 7:
                $this->setDrSpecialty($value);
                break;
            case 8:
                $this->setMonth($value);
                break;
            case 9:
                $this->setDrTags($value);
                break;
            case 10:
                $this->setBrand($value);
                break;
            case 11:
                $this->setSgpiTagged($value);
                break;
            case 12:
                $this->setBrandSgpiDistributed($value);
                break;
            case 13:
                $this->setMrCallDone($value);
                break;
            case 14:
                $this->setAmCallDone($value);
                break;
            case 15:
                $this->setRmCallDone($value);
                break;
            case 16:
                $this->setZmCallDone($value);
                break;
            case 17:
                $this->setZmPosition($value);
                break;
            case 18:
                $this->setRmPosition($value);
                break;
            case 19:
                $this->setAmPosition($value);
                break;
            case 20:
                $this->setZmPositionCode($value);
                break;
            case 21:
                $this->setRmPositionCode($value);
                break;
            case 22:
                $this->setAmPositionCode($value);
                break;
            case 23:
                $this->setEmployeePositionCode($value);
                break;
            case 24:
                $this->setEmployeePositionName($value);
                break;
            case 25:
                $this->setEmployeeLevel($value);
                break;
            case 26:
                $this->setSgpiReportId($value);
                break;
            case 27:
                $this->setCreatedAt($value);
                break;
            case 28:
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
        $keys = WriteSgpiTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setDivision($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setEmployeeId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setEmployeeName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setLocation($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setLocationCode($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setDrCode($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setDrName($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setDrSpecialty($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setMonth($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setDrTags($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setBrand($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setSgpiTagged($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setBrandSgpiDistributed($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setMrCallDone($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setAmCallDone($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setRmCallDone($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setZmCallDone($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setZmPosition($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setRmPosition($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setAmPosition($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setZmPositionCode($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setRmPositionCode($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setAmPositionCode($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setEmployeePositionCode($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setEmployeePositionName($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setEmployeeLevel($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setSgpiReportId($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setCreatedAt($arr[$keys[27]]);
        }
        if (array_key_exists($keys[28], $arr)) {
            $this->setUpdatedAt($arr[$keys[28]]);
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
        $criteria = new Criteria(WriteSgpiTableMap::DATABASE_NAME);

        if ($this->isColumnModified(WriteSgpiTableMap::COL_DIVISION)) {
            $criteria->add(WriteSgpiTableMap::COL_DIVISION, $this->division);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_EMPLOYEE_ID)) {
            $criteria->add(WriteSgpiTableMap::COL_EMPLOYEE_ID, $this->employee_id);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_EMPLOYEE_NAME)) {
            $criteria->add(WriteSgpiTableMap::COL_EMPLOYEE_NAME, $this->employee_name);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_LOCATION)) {
            $criteria->add(WriteSgpiTableMap::COL_LOCATION, $this->location);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_LOCATION_CODE)) {
            $criteria->add(WriteSgpiTableMap::COL_LOCATION_CODE, $this->location_code);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_DR_CODE)) {
            $criteria->add(WriteSgpiTableMap::COL_DR_CODE, $this->dr_code);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_DR_NAME)) {
            $criteria->add(WriteSgpiTableMap::COL_DR_NAME, $this->dr_name);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_DR_SPECIALTY)) {
            $criteria->add(WriteSgpiTableMap::COL_DR_SPECIALTY, $this->dr_specialty);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_MONTH)) {
            $criteria->add(WriteSgpiTableMap::COL_MONTH, $this->month);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_DR_TAGS)) {
            $criteria->add(WriteSgpiTableMap::COL_DR_TAGS, $this->dr_tags);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_BRAND)) {
            $criteria->add(WriteSgpiTableMap::COL_BRAND, $this->brand);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_SGPI_TAGGED)) {
            $criteria->add(WriteSgpiTableMap::COL_SGPI_TAGGED, $this->sgpi_tagged);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_BRAND_SGPI_DISTRIBUTED)) {
            $criteria->add(WriteSgpiTableMap::COL_BRAND_SGPI_DISTRIBUTED, $this->brand_sgpi_distributed);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_MR_CALL_DONE)) {
            $criteria->add(WriteSgpiTableMap::COL_MR_CALL_DONE, $this->mr_call_done);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_AM_CALL_DONE)) {
            $criteria->add(WriteSgpiTableMap::COL_AM_CALL_DONE, $this->am_call_done);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_RM_CALL_DONE)) {
            $criteria->add(WriteSgpiTableMap::COL_RM_CALL_DONE, $this->rm_call_done);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_ZM_CALL_DONE)) {
            $criteria->add(WriteSgpiTableMap::COL_ZM_CALL_DONE, $this->zm_call_done);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_ZM_POSITION)) {
            $criteria->add(WriteSgpiTableMap::COL_ZM_POSITION, $this->zm_position);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_RM_POSITION)) {
            $criteria->add(WriteSgpiTableMap::COL_RM_POSITION, $this->rm_position);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_AM_POSITION)) {
            $criteria->add(WriteSgpiTableMap::COL_AM_POSITION, $this->am_position);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_ZM_POSITION_CODE)) {
            $criteria->add(WriteSgpiTableMap::COL_ZM_POSITION_CODE, $this->zm_position_code);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_RM_POSITION_CODE)) {
            $criteria->add(WriteSgpiTableMap::COL_RM_POSITION_CODE, $this->rm_position_code);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_AM_POSITION_CODE)) {
            $criteria->add(WriteSgpiTableMap::COL_AM_POSITION_CODE, $this->am_position_code);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_EMPLOYEE_POSITION_CODE)) {
            $criteria->add(WriteSgpiTableMap::COL_EMPLOYEE_POSITION_CODE, $this->employee_position_code);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_EMPLOYEE_POSITION_NAME)) {
            $criteria->add(WriteSgpiTableMap::COL_EMPLOYEE_POSITION_NAME, $this->employee_position_name);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_EMPLOYEE_LEVEL)) {
            $criteria->add(WriteSgpiTableMap::COL_EMPLOYEE_LEVEL, $this->employee_level);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_SGPI_REPORT_ID)) {
            $criteria->add(WriteSgpiTableMap::COL_SGPI_REPORT_ID, $this->sgpi_report_id);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_CREATED_AT)) {
            $criteria->add(WriteSgpiTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(WriteSgpiTableMap::COL_UPDATED_AT)) {
            $criteria->add(WriteSgpiTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildWriteSgpiQuery::create();
        $criteria->add(WriteSgpiTableMap::COL_SGPI_REPORT_ID, $this->sgpi_report_id);

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
        $validPk = null !== $this->getSgpiReportId();

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
        return $this->getSgpiReportId();
    }

    /**
     * Generic method to set the primary key (sgpi_report_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setSgpiReportId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getSgpiReportId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\WriteSgpi (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setDivision($this->getDivision());
        $copyObj->setEmployeeId($this->getEmployeeId());
        $copyObj->setEmployeeName($this->getEmployeeName());
        $copyObj->setLocation($this->getLocation());
        $copyObj->setLocationCode($this->getLocationCode());
        $copyObj->setDrCode($this->getDrCode());
        $copyObj->setDrName($this->getDrName());
        $copyObj->setDrSpecialty($this->getDrSpecialty());
        $copyObj->setMonth($this->getMonth());
        $copyObj->setDrTags($this->getDrTags());
        $copyObj->setBrand($this->getBrand());
        $copyObj->setSgpiTagged($this->getSgpiTagged());
        $copyObj->setBrandSgpiDistributed($this->getBrandSgpiDistributed());
        $copyObj->setMrCallDone($this->getMrCallDone());
        $copyObj->setAmCallDone($this->getAmCallDone());
        $copyObj->setRmCallDone($this->getRmCallDone());
        $copyObj->setZmCallDone($this->getZmCallDone());
        $copyObj->setZmPosition($this->getZmPosition());
        $copyObj->setRmPosition($this->getRmPosition());
        $copyObj->setAmPosition($this->getAmPosition());
        $copyObj->setZmPositionCode($this->getZmPositionCode());
        $copyObj->setRmPositionCode($this->getRmPositionCode());
        $copyObj->setAmPositionCode($this->getAmPositionCode());
        $copyObj->setEmployeePositionCode($this->getEmployeePositionCode());
        $copyObj->setEmployeePositionName($this->getEmployeePositionName());
        $copyObj->setEmployeeLevel($this->getEmployeeLevel());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setSgpiReportId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\WriteSgpi Clone of current object.
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
        $this->division = null;
        $this->employee_id = null;
        $this->employee_name = null;
        $this->location = null;
        $this->location_code = null;
        $this->dr_code = null;
        $this->dr_name = null;
        $this->dr_specialty = null;
        $this->month = null;
        $this->dr_tags = null;
        $this->brand = null;
        $this->sgpi_tagged = null;
        $this->brand_sgpi_distributed = null;
        $this->mr_call_done = null;
        $this->am_call_done = null;
        $this->rm_call_done = null;
        $this->zm_call_done = null;
        $this->zm_position = null;
        $this->rm_position = null;
        $this->am_position = null;
        $this->zm_position_code = null;
        $this->rm_position_code = null;
        $this->am_position_code = null;
        $this->employee_position_code = null;
        $this->employee_position_name = null;
        $this->employee_level = null;
        $this->sgpi_report_id = null;
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
        return (string) $this->exportTo(WriteSgpiTableMap::DEFAULT_STRING_FORMAT);
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
