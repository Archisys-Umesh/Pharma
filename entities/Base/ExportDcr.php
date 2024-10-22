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
use entities\Map\ExportDcrTableMap;

/**
 * Base class that represents a row from the 'export_dcr' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class ExportDcr implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\ExportDcrTableMap';


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
     * The value for the bu_name field.
     *
     * @var        string|null
     */
    protected $bu_name;

    /**
     * The value for the zm_manager_branch field.
     *
     * @var        string|null
     */
    protected $zm_manager_branch;

    /**
     * The value for the zm_manager_town field.
     *
     * @var        string|null
     */
    protected $zm_manager_town;

    /**
     * The value for the rm_manager_branch field.
     *
     * @var        string|null
     */
    protected $rm_manager_branch;

    /**
     * The value for the rm_manager_town field.
     *
     * @var        string|null
     */
    protected $rm_manager_town;

    /**
     * The value for the am_manager_branch field.
     *
     * @var        string|null
     */
    protected $am_manager_branch;

    /**
     * The value for the am_manager_town field.
     *
     * @var        string|null
     */
    protected $am_manager_town;

    /**
     * The value for the zm_position_code field.
     *
     * @var        string|null
     */
    protected $zm_position_code;

    /**
     * The value for the rm_position_code field.
     *
     * @var        string|null
     */
    protected $rm_position_code;

    /**
     * The value for the am_position_code field.
     *
     * @var        string|null
     */
    protected $am_position_code;

    /**
     * The value for the emp_position_code field.
     *
     * @var        string|null
     */
    protected $emp_position_code;

    /**
     * The value for the emp_position_name field.
     *
     * @var        string|null
     */
    protected $emp_position_name;

    /**
     * The value for the emp_level field.
     *
     * @var        string|null
     */
    protected $emp_level;

    /**
     * The value for the employee_code field.
     *
     * @var        string|null
     */
    protected $employee_code;

    /**
     * The value for the employee field.
     *
     * @var        string|null
     */
    protected $employee;

    /**
     * The value for the jw_employee_code field.
     *
     * @var        string|null
     */
    protected $jw_employee_code;

    /**
     * The value for the jw_employee field.
     *
     * @var        string|null
     */
    protected $jw_employee;

    /**
     * The value for the jw_position_name field.
     *
     * @var        string|null
     */
    protected $jw_position_name;

    /**
     * The value for the outlet_type field.
     *
     * @var        string|null
     */
    protected $outlet_type;

    /**
     * The value for the outlet_code field.
     *
     * @var        string|null
     */
    protected $outlet_code;

    /**
     * The value for the outlet_name field.
     *
     * @var        string|null
     */
    protected $outlet_name;

    /**
     * The value for the agendacontroltype field.
     *
     * @var        string|null
     */
    protected $agendacontroltype;

    /**
     * The value for the agendname field.
     *
     * @var        string|null
     */
    protected $agendname;

    /**
     * The value for the stownname field.
     *
     * @var        string|null
     */
    protected $stownname;

    /**
     * The value for the dcr_date field.
     *
     * @var        DateTime|null
     */
    protected $dcr_date;

    /**
     * The value for the dcr_status field.
     *
     * @var        string|null
     */
    protected $dcr_status;

    /**
     * The value for the nca_comments field.
     *
     * @var        string|null
     */
    protected $nca_comments;

    /**
     * The value for the planned field.
     *
     * @var        string|null
     */
    protected $planned;

    /**
     * The value for the managers_name field.
     *
     * @var        string|null
     */
    protected $managers_name;

    /**
     * The value for the brands_detailed_name field.
     *
     * @var        string|null
     */
    protected $brands_detailed_name;

    /**
     * The value for the ed_duration field.
     *
     * @var        int|null
     */
    protected $ed_duration;

    /**
     * The value for the datetime field.
     *
     * @var        DateTime|null
     */
    protected $datetime;

    /**
     * The value for the emp_territory field.
     *
     * @var        string|null
     */
    protected $emp_territory;

    /**
     * The value for the emp_branch field.
     *
     * @var        string|null
     */
    protected $emp_branch;

    /**
     * The value for the emp_town field.
     *
     * @var        string|null
     */
    protected $emp_town;

    /**
     * The value for the customer_town field.
     *
     * @var        string|null
     */
    protected $customer_town;

    /**
     * The value for the customer_patch field.
     *
     * @var        string|null
     */
    protected $customer_patch;

    /**
     * The value for the leave_teken field.
     *
     * @var        string|null
     */
    protected $leave_teken;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of entities\Base\ExportDcr object.
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
     * Compares this with another <code>ExportDcr</code> instance.  If
     * <code>obj</code> is an instance of <code>ExportDcr</code>, delegates to
     * <code>equals(ExportDcr)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [bu_name] column value.
     *
     * @return string|null
     */
    public function getBuName()
    {
        return $this->bu_name;
    }

    /**
     * Get the [zm_manager_branch] column value.
     *
     * @return string|null
     */
    public function getZmManagerBranch()
    {
        return $this->zm_manager_branch;
    }

    /**
     * Get the [zm_manager_town] column value.
     *
     * @return string|null
     */
    public function getZmManagerTown()
    {
        return $this->zm_manager_town;
    }

    /**
     * Get the [rm_manager_branch] column value.
     *
     * @return string|null
     */
    public function getRmManagerBranch()
    {
        return $this->rm_manager_branch;
    }

    /**
     * Get the [rm_manager_town] column value.
     *
     * @return string|null
     */
    public function getRmManagerTown()
    {
        return $this->rm_manager_town;
    }

    /**
     * Get the [am_manager_branch] column value.
     *
     * @return string|null
     */
    public function getAmManagerBranch()
    {
        return $this->am_manager_branch;
    }

    /**
     * Get the [am_manager_town] column value.
     *
     * @return string|null
     */
    public function getAmManagerTown()
    {
        return $this->am_manager_town;
    }

    /**
     * Get the [zm_position_code] column value.
     *
     * @return string|null
     */
    public function getZmPositionCode()
    {
        return $this->zm_position_code;
    }

    /**
     * Get the [rm_position_code] column value.
     *
     * @return string|null
     */
    public function getRmPositionCode()
    {
        return $this->rm_position_code;
    }

    /**
     * Get the [am_position_code] column value.
     *
     * @return string|null
     */
    public function getAmPositionCode()
    {
        return $this->am_position_code;
    }

    /**
     * Get the [emp_position_code] column value.
     *
     * @return string|null
     */
    public function getEmpPositionCode()
    {
        return $this->emp_position_code;
    }

    /**
     * Get the [emp_position_name] column value.
     *
     * @return string|null
     */
    public function getEmpPositionName()
    {
        return $this->emp_position_name;
    }

    /**
     * Get the [emp_level] column value.
     *
     * @return string|null
     */
    public function getEmpLevel()
    {
        return $this->emp_level;
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
     * Get the [employee] column value.
     *
     * @return string|null
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * Get the [jw_employee_code] column value.
     *
     * @return string|null
     */
    public function getJwEmployeeCode()
    {
        return $this->jw_employee_code;
    }

    /**
     * Get the [jw_employee] column value.
     *
     * @return string|null
     */
    public function getJwEmployee()
    {
        return $this->jw_employee;
    }

    /**
     * Get the [jw_position_name] column value.
     *
     * @return string|null
     */
    public function getJwPositionName()
    {
        return $this->jw_position_name;
    }

    /**
     * Get the [outlet_type] column value.
     *
     * @return string|null
     */
    public function getOutletType()
    {
        return $this->outlet_type;
    }

    /**
     * Get the [outlet_code] column value.
     *
     * @return string|null
     */
    public function getOutletCode()
    {
        return $this->outlet_code;
    }

    /**
     * Get the [outlet_name] column value.
     *
     * @return string|null
     */
    public function getOutletName()
    {
        return $this->outlet_name;
    }

    /**
     * Get the [agendacontroltype] column value.
     *
     * @return string|null
     */
    public function getAgendacontroltype()
    {
        return $this->agendacontroltype;
    }

    /**
     * Get the [agendname] column value.
     *
     * @return string|null
     */
    public function getAgendname()
    {
        return $this->agendname;
    }

    /**
     * Get the [stownname] column value.
     *
     * @return string|null
     */
    public function getStownname()
    {
        return $this->stownname;
    }

    /**
     * Get the [optionally formatted] temporal [dcr_date] column value.
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
    public function getDcrDate($format = null)
    {
        if ($format === null) {
            return $this->dcr_date;
        } else {
            return $this->dcr_date instanceof \DateTimeInterface ? $this->dcr_date->format($format) : null;
        }
    }

    /**
     * Get the [dcr_status] column value.
     *
     * @return string|null
     */
    public function getDcrStatus()
    {
        return $this->dcr_status;
    }

    /**
     * Get the [nca_comments] column value.
     *
     * @return string|null
     */
    public function getNcaComments()
    {
        return $this->nca_comments;
    }

    /**
     * Get the [planned] column value.
     *
     * @return string|null
     */
    public function getPlanned()
    {
        return $this->planned;
    }

    /**
     * Get the [managers_name] column value.
     *
     * @return string|null
     */
    public function getManagersName()
    {
        return $this->managers_name;
    }

    /**
     * Get the [brands_detailed_name] column value.
     *
     * @return string|null
     */
    public function getBrandsDetailedName()
    {
        return $this->brands_detailed_name;
    }

    /**
     * Get the [ed_duration] column value.
     *
     * @return int|null
     */
    public function getEdDuration()
    {
        return $this->ed_duration;
    }

    /**
     * Get the [optionally formatted] temporal [datetime] column value.
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
    public function getDateTime($format = null)
    {
        if ($format === null) {
            return $this->datetime;
        } else {
            return $this->datetime instanceof \DateTimeInterface ? $this->datetime->format($format) : null;
        }
    }

    /**
     * Get the [emp_territory] column value.
     *
     * @return string|null
     */
    public function getEmpTerritory()
    {
        return $this->emp_territory;
    }

    /**
     * Get the [emp_branch] column value.
     *
     * @return string|null
     */
    public function getEmpBranch()
    {
        return $this->emp_branch;
    }

    /**
     * Get the [emp_town] column value.
     *
     * @return string|null
     */
    public function getEmpTown()
    {
        return $this->emp_town;
    }

    /**
     * Get the [customer_town] column value.
     *
     * @return string|null
     */
    public function getCustomerTown()
    {
        return $this->customer_town;
    }

    /**
     * Get the [customer_patch] column value.
     *
     * @return string|null
     */
    public function getCustomerPatch()
    {
        return $this->customer_patch;
    }

    /**
     * Get the [leave_teken] column value.
     *
     * @return string|null
     */
    public function getLeaveTaken()
    {
        return $this->leave_teken;
    }

    /**
     * Set the value of [bu_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setBuName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->bu_name !== $v) {
            $this->bu_name = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_BU_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [zm_manager_branch] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setZmManagerBranch($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zm_manager_branch !== $v) {
            $this->zm_manager_branch = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_ZM_MANAGER_BRANCH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [zm_manager_town] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setZmManagerTown($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zm_manager_town !== $v) {
            $this->zm_manager_town = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_ZM_MANAGER_TOWN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rm_manager_branch] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRmManagerBranch($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rm_manager_branch !== $v) {
            $this->rm_manager_branch = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_RM_MANAGER_BRANCH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rm_manager_town] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRmManagerTown($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rm_manager_town !== $v) {
            $this->rm_manager_town = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_RM_MANAGER_TOWN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [am_manager_branch] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setAmManagerBranch($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->am_manager_branch !== $v) {
            $this->am_manager_branch = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_AM_MANAGER_BRANCH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [am_manager_town] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setAmManagerTown($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->am_manager_town !== $v) {
            $this->am_manager_town = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_AM_MANAGER_TOWN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [zm_position_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setZmPositionCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zm_position_code !== $v) {
            $this->zm_position_code = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_ZM_POSITION_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rm_position_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setRmPositionCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rm_position_code !== $v) {
            $this->rm_position_code = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_RM_POSITION_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [am_position_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setAmPositionCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->am_position_code !== $v) {
            $this->am_position_code = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_AM_POSITION_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [emp_position_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmpPositionCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->emp_position_code !== $v) {
            $this->emp_position_code = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_EMP_POSITION_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [emp_position_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmpPositionName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->emp_position_name !== $v) {
            $this->emp_position_name = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_EMP_POSITION_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [emp_level] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmpLevel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->emp_level !== $v) {
            $this->emp_level = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_EMP_LEVEL] = true;
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
            $this->modifiedColumns[ExportDcrTableMap::COL_EMPLOYEE_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmployee($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->employee !== $v) {
            $this->employee = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_EMPLOYEE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [jw_employee_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setJwEmployeeCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->jw_employee_code !== $v) {
            $this->jw_employee_code = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_JW_EMPLOYEE_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [jw_employee] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setJwEmployee($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->jw_employee !== $v) {
            $this->jw_employee = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_JW_EMPLOYEE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [jw_position_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setJwPositionName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->jw_position_name !== $v) {
            $this->jw_position_name = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_JW_POSITION_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_type] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_type !== $v) {
            $this->outlet_type = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_OUTLET_TYPE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_code !== $v) {
            $this->outlet_code = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_OUTLET_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_name !== $v) {
            $this->outlet_name = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_OUTLET_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [agendacontroltype] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setAgendacontroltype($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->agendacontroltype !== $v) {
            $this->agendacontroltype = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_AGENDACONTROLTYPE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [agendname] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setAgendname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->agendname !== $v) {
            $this->agendname = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_AGENDNAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [stownname] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setStownname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->stownname !== $v) {
            $this->stownname = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_STOWNNAME] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [dcr_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    protected function setDcrDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->dcr_date !== null || $dt !== null) {
            if ($this->dcr_date === null || $dt === null || $dt->format("Y-m-d") !== $this->dcr_date->format("Y-m-d")) {
                $this->dcr_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ExportDcrTableMap::COL_DCR_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [dcr_status] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setDcrStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dcr_status !== $v) {
            $this->dcr_status = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_DCR_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [nca_comments] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setNcaComments($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nca_comments !== $v) {
            $this->nca_comments = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_NCA_COMMENTS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [planned] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setPlanned($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->planned !== $v) {
            $this->planned = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_PLANNED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [managers_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setManagersName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->managers_name !== $v) {
            $this->managers_name = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_MANAGERS_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [brands_detailed_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setBrandsDetailedName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->brands_detailed_name !== $v) {
            $this->brands_detailed_name = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_BRANDS_DETAILED_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [ed_duration] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEdDuration($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->ed_duration !== $v) {
            $this->ed_duration = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_ED_DURATION] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [datetime] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    protected function setDateTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->datetime !== null || $dt !== null) {
            if ($this->datetime === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->datetime->format("Y-m-d H:i:s.u")) {
                $this->datetime = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ExportDcrTableMap::COL_DATETIME] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [emp_territory] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmpTerritory($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->emp_territory !== $v) {
            $this->emp_territory = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_EMP_TERRITORY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [emp_branch] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmpBranch($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->emp_branch !== $v) {
            $this->emp_branch = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_EMP_BRANCH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [emp_town] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmpTown($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->emp_town !== $v) {
            $this->emp_town = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_EMP_TOWN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [customer_town] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setCustomerTown($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->customer_town !== $v) {
            $this->customer_town = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_CUSTOMER_TOWN] = true;
        }

        return $this;
    }

    /**
     * Set the value of [customer_patch] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setCustomerPatch($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->customer_patch !== $v) {
            $this->customer_patch = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_CUSTOMER_PATCH] = true;
        }

        return $this;
    }

    /**
     * Set the value of [leave_teken] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setLeaveTaken($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->leave_teken !== $v) {
            $this->leave_teken = $v;
            $this->modifiedColumns[ExportDcrTableMap::COL_LEAVE_TEKEN] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ExportDcrTableMap::translateFieldName('BuName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bu_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ExportDcrTableMap::translateFieldName('ZmManagerBranch', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zm_manager_branch = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ExportDcrTableMap::translateFieldName('ZmManagerTown', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zm_manager_town = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ExportDcrTableMap::translateFieldName('RmManagerBranch', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rm_manager_branch = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ExportDcrTableMap::translateFieldName('RmManagerTown', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rm_manager_town = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ExportDcrTableMap::translateFieldName('AmManagerBranch', TableMap::TYPE_PHPNAME, $indexType)];
            $this->am_manager_branch = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ExportDcrTableMap::translateFieldName('AmManagerTown', TableMap::TYPE_PHPNAME, $indexType)];
            $this->am_manager_town = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ExportDcrTableMap::translateFieldName('ZmPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zm_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ExportDcrTableMap::translateFieldName('RmPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rm_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ExportDcrTableMap::translateFieldName('AmPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->am_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ExportDcrTableMap::translateFieldName('EmpPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ExportDcrTableMap::translateFieldName('EmpPositionName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_position_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : ExportDcrTableMap::translateFieldName('EmpLevel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_level = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : ExportDcrTableMap::translateFieldName('EmployeeCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : ExportDcrTableMap::translateFieldName('Employee', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : ExportDcrTableMap::translateFieldName('JwEmployeeCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->jw_employee_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : ExportDcrTableMap::translateFieldName('JwEmployee', TableMap::TYPE_PHPNAME, $indexType)];
            $this->jw_employee = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : ExportDcrTableMap::translateFieldName('JwPositionName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->jw_position_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : ExportDcrTableMap::translateFieldName('OutletType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : ExportDcrTableMap::translateFieldName('OutletCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : ExportDcrTableMap::translateFieldName('OutletName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : ExportDcrTableMap::translateFieldName('Agendacontroltype', TableMap::TYPE_PHPNAME, $indexType)];
            $this->agendacontroltype = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : ExportDcrTableMap::translateFieldName('Agendname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->agendname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : ExportDcrTableMap::translateFieldName('Stownname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stownname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : ExportDcrTableMap::translateFieldName('DcrDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dcr_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : ExportDcrTableMap::translateFieldName('DcrStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dcr_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : ExportDcrTableMap::translateFieldName('NcaComments', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nca_comments = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : ExportDcrTableMap::translateFieldName('Planned', TableMap::TYPE_PHPNAME, $indexType)];
            $this->planned = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : ExportDcrTableMap::translateFieldName('ManagersName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->managers_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : ExportDcrTableMap::translateFieldName('BrandsDetailedName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brands_detailed_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : ExportDcrTableMap::translateFieldName('EdDuration', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ed_duration = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : ExportDcrTableMap::translateFieldName('DateTime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->datetime = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 32 + $startcol : ExportDcrTableMap::translateFieldName('EmpTerritory', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_territory = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 33 + $startcol : ExportDcrTableMap::translateFieldName('EmpBranch', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_branch = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 34 + $startcol : ExportDcrTableMap::translateFieldName('EmpTown', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_town = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 35 + $startcol : ExportDcrTableMap::translateFieldName('CustomerTown', TableMap::TYPE_PHPNAME, $indexType)];
            $this->customer_town = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 36 + $startcol : ExportDcrTableMap::translateFieldName('CustomerPatch', TableMap::TYPE_PHPNAME, $indexType)];
            $this->customer_patch = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 37 + $startcol : ExportDcrTableMap::translateFieldName('LeaveTaken', TableMap::TYPE_PHPNAME, $indexType)];
            $this->leave_teken = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 38; // 38 = ExportDcrTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\ExportDcr'), 0, $e);
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
        $pos = ExportDcrTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getBuName();

            case 1:
                return $this->getZmManagerBranch();

            case 2:
                return $this->getZmManagerTown();

            case 3:
                return $this->getRmManagerBranch();

            case 4:
                return $this->getRmManagerTown();

            case 5:
                return $this->getAmManagerBranch();

            case 6:
                return $this->getAmManagerTown();

            case 7:
                return $this->getZmPositionCode();

            case 8:
                return $this->getRmPositionCode();

            case 9:
                return $this->getAmPositionCode();

            case 10:
                return $this->getEmpPositionCode();

            case 11:
                return $this->getEmpPositionName();

            case 12:
                return $this->getEmpLevel();

            case 13:
                return $this->getEmployeeCode();

            case 14:
                return $this->getEmployee();

            case 15:
                return $this->getJwEmployeeCode();

            case 16:
                return $this->getJwEmployee();

            case 17:
                return $this->getJwPositionName();

            case 18:
                return $this->getOutletType();

            case 19:
                return $this->getOutletCode();

            case 20:
                return $this->getOutletName();

            case 21:
                return $this->getAgendacontroltype();

            case 22:
                return $this->getAgendname();

            case 23:
                return $this->getStownname();

            case 24:
                return $this->getDcrDate();

            case 25:
                return $this->getDcrStatus();

            case 26:
                return $this->getNcaComments();

            case 27:
                return $this->getPlanned();

            case 28:
                return $this->getManagersName();

            case 29:
                return $this->getBrandsDetailedName();

            case 30:
                return $this->getEdDuration();

            case 31:
                return $this->getDateTime();

            case 32:
                return $this->getEmpTerritory();

            case 33:
                return $this->getEmpBranch();

            case 34:
                return $this->getEmpTown();

            case 35:
                return $this->getCustomerTown();

            case 36:
                return $this->getCustomerPatch();

            case 37:
                return $this->getLeaveTaken();

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
        if (isset($alreadyDumpedObjects['ExportDcr'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['ExportDcr'][$this->hashCode()] = true;
        $keys = ExportDcrTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getBuName(),
            $keys[1] => $this->getZmManagerBranch(),
            $keys[2] => $this->getZmManagerTown(),
            $keys[3] => $this->getRmManagerBranch(),
            $keys[4] => $this->getRmManagerTown(),
            $keys[5] => $this->getAmManagerBranch(),
            $keys[6] => $this->getAmManagerTown(),
            $keys[7] => $this->getZmPositionCode(),
            $keys[8] => $this->getRmPositionCode(),
            $keys[9] => $this->getAmPositionCode(),
            $keys[10] => $this->getEmpPositionCode(),
            $keys[11] => $this->getEmpPositionName(),
            $keys[12] => $this->getEmpLevel(),
            $keys[13] => $this->getEmployeeCode(),
            $keys[14] => $this->getEmployee(),
            $keys[15] => $this->getJwEmployeeCode(),
            $keys[16] => $this->getJwEmployee(),
            $keys[17] => $this->getJwPositionName(),
            $keys[18] => $this->getOutletType(),
            $keys[19] => $this->getOutletCode(),
            $keys[20] => $this->getOutletName(),
            $keys[21] => $this->getAgendacontroltype(),
            $keys[22] => $this->getAgendname(),
            $keys[23] => $this->getStownname(),
            $keys[24] => $this->getDcrDate(),
            $keys[25] => $this->getDcrStatus(),
            $keys[26] => $this->getNcaComments(),
            $keys[27] => $this->getPlanned(),
            $keys[28] => $this->getManagersName(),
            $keys[29] => $this->getBrandsDetailedName(),
            $keys[30] => $this->getEdDuration(),
            $keys[31] => $this->getDateTime(),
            $keys[32] => $this->getEmpTerritory(),
            $keys[33] => $this->getEmpBranch(),
            $keys[34] => $this->getEmpTown(),
            $keys[35] => $this->getCustomerTown(),
            $keys[36] => $this->getCustomerPatch(),
            $keys[37] => $this->getLeaveTaken(),
        ];
        if ($result[$keys[24]] instanceof \DateTimeInterface) {
            $result[$keys[24]] = $result[$keys[24]]->format('Y-m-d');
        }

        if ($result[$keys[31]] instanceof \DateTimeInterface) {
            $result[$keys[31]] = $result[$keys[31]]->format('Y-m-d H:i:s.u');
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
        $criteria = new Criteria(ExportDcrTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ExportDcrTableMap::COL_BU_NAME)) {
            $criteria->add(ExportDcrTableMap::COL_BU_NAME, $this->bu_name);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_ZM_MANAGER_BRANCH)) {
            $criteria->add(ExportDcrTableMap::COL_ZM_MANAGER_BRANCH, $this->zm_manager_branch);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_ZM_MANAGER_TOWN)) {
            $criteria->add(ExportDcrTableMap::COL_ZM_MANAGER_TOWN, $this->zm_manager_town);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_RM_MANAGER_BRANCH)) {
            $criteria->add(ExportDcrTableMap::COL_RM_MANAGER_BRANCH, $this->rm_manager_branch);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_RM_MANAGER_TOWN)) {
            $criteria->add(ExportDcrTableMap::COL_RM_MANAGER_TOWN, $this->rm_manager_town);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_AM_MANAGER_BRANCH)) {
            $criteria->add(ExportDcrTableMap::COL_AM_MANAGER_BRANCH, $this->am_manager_branch);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_AM_MANAGER_TOWN)) {
            $criteria->add(ExportDcrTableMap::COL_AM_MANAGER_TOWN, $this->am_manager_town);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_ZM_POSITION_CODE)) {
            $criteria->add(ExportDcrTableMap::COL_ZM_POSITION_CODE, $this->zm_position_code);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_RM_POSITION_CODE)) {
            $criteria->add(ExportDcrTableMap::COL_RM_POSITION_CODE, $this->rm_position_code);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_AM_POSITION_CODE)) {
            $criteria->add(ExportDcrTableMap::COL_AM_POSITION_CODE, $this->am_position_code);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_EMP_POSITION_CODE)) {
            $criteria->add(ExportDcrTableMap::COL_EMP_POSITION_CODE, $this->emp_position_code);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_EMP_POSITION_NAME)) {
            $criteria->add(ExportDcrTableMap::COL_EMP_POSITION_NAME, $this->emp_position_name);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_EMP_LEVEL)) {
            $criteria->add(ExportDcrTableMap::COL_EMP_LEVEL, $this->emp_level);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_EMPLOYEE_CODE)) {
            $criteria->add(ExportDcrTableMap::COL_EMPLOYEE_CODE, $this->employee_code);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_EMPLOYEE)) {
            $criteria->add(ExportDcrTableMap::COL_EMPLOYEE, $this->employee);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_JW_EMPLOYEE_CODE)) {
            $criteria->add(ExportDcrTableMap::COL_JW_EMPLOYEE_CODE, $this->jw_employee_code);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_JW_EMPLOYEE)) {
            $criteria->add(ExportDcrTableMap::COL_JW_EMPLOYEE, $this->jw_employee);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_JW_POSITION_NAME)) {
            $criteria->add(ExportDcrTableMap::COL_JW_POSITION_NAME, $this->jw_position_name);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_OUTLET_TYPE)) {
            $criteria->add(ExportDcrTableMap::COL_OUTLET_TYPE, $this->outlet_type);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_OUTLET_CODE)) {
            $criteria->add(ExportDcrTableMap::COL_OUTLET_CODE, $this->outlet_code);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_OUTLET_NAME)) {
            $criteria->add(ExportDcrTableMap::COL_OUTLET_NAME, $this->outlet_name);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_AGENDACONTROLTYPE)) {
            $criteria->add(ExportDcrTableMap::COL_AGENDACONTROLTYPE, $this->agendacontroltype);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_AGENDNAME)) {
            $criteria->add(ExportDcrTableMap::COL_AGENDNAME, $this->agendname);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_STOWNNAME)) {
            $criteria->add(ExportDcrTableMap::COL_STOWNNAME, $this->stownname);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_DCR_DATE)) {
            $criteria->add(ExportDcrTableMap::COL_DCR_DATE, $this->dcr_date);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_DCR_STATUS)) {
            $criteria->add(ExportDcrTableMap::COL_DCR_STATUS, $this->dcr_status);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_NCA_COMMENTS)) {
            $criteria->add(ExportDcrTableMap::COL_NCA_COMMENTS, $this->nca_comments);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_PLANNED)) {
            $criteria->add(ExportDcrTableMap::COL_PLANNED, $this->planned);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_MANAGERS_NAME)) {
            $criteria->add(ExportDcrTableMap::COL_MANAGERS_NAME, $this->managers_name);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_BRANDS_DETAILED_NAME)) {
            $criteria->add(ExportDcrTableMap::COL_BRANDS_DETAILED_NAME, $this->brands_detailed_name);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_ED_DURATION)) {
            $criteria->add(ExportDcrTableMap::COL_ED_DURATION, $this->ed_duration);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_DATETIME)) {
            $criteria->add(ExportDcrTableMap::COL_DATETIME, $this->datetime);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_EMP_TERRITORY)) {
            $criteria->add(ExportDcrTableMap::COL_EMP_TERRITORY, $this->emp_territory);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_EMP_BRANCH)) {
            $criteria->add(ExportDcrTableMap::COL_EMP_BRANCH, $this->emp_branch);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_EMP_TOWN)) {
            $criteria->add(ExportDcrTableMap::COL_EMP_TOWN, $this->emp_town);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_CUSTOMER_TOWN)) {
            $criteria->add(ExportDcrTableMap::COL_CUSTOMER_TOWN, $this->customer_town);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_CUSTOMER_PATCH)) {
            $criteria->add(ExportDcrTableMap::COL_CUSTOMER_PATCH, $this->customer_patch);
        }
        if ($this->isColumnModified(ExportDcrTableMap::COL_LEAVE_TEKEN)) {
            $criteria->add(ExportDcrTableMap::COL_LEAVE_TEKEN, $this->leave_teken);
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
        throw new LogicException('The ExportDcr object has no primary key');

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
     * @param object $copyObj An object of \entities\ExportDcr (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setBuName($this->getBuName());
        $copyObj->setZmManagerBranch($this->getZmManagerBranch());
        $copyObj->setZmManagerTown($this->getZmManagerTown());
        $copyObj->setRmManagerBranch($this->getRmManagerBranch());
        $copyObj->setRmManagerTown($this->getRmManagerTown());
        $copyObj->setAmManagerBranch($this->getAmManagerBranch());
        $copyObj->setAmManagerTown($this->getAmManagerTown());
        $copyObj->setZmPositionCode($this->getZmPositionCode());
        $copyObj->setRmPositionCode($this->getRmPositionCode());
        $copyObj->setAmPositionCode($this->getAmPositionCode());
        $copyObj->setEmpPositionCode($this->getEmpPositionCode());
        $copyObj->setEmpPositionName($this->getEmpPositionName());
        $copyObj->setEmpLevel($this->getEmpLevel());
        $copyObj->setEmployeeCode($this->getEmployeeCode());
        $copyObj->setEmployee($this->getEmployee());
        $copyObj->setJwEmployeeCode($this->getJwEmployeeCode());
        $copyObj->setJwEmployee($this->getJwEmployee());
        $copyObj->setJwPositionName($this->getJwPositionName());
        $copyObj->setOutletType($this->getOutletType());
        $copyObj->setOutletCode($this->getOutletCode());
        $copyObj->setOutletName($this->getOutletName());
        $copyObj->setAgendacontroltype($this->getAgendacontroltype());
        $copyObj->setAgendname($this->getAgendname());
        $copyObj->setStownname($this->getStownname());
        $copyObj->setDcrDate($this->getDcrDate());
        $copyObj->setDcrStatus($this->getDcrStatus());
        $copyObj->setNcaComments($this->getNcaComments());
        $copyObj->setPlanned($this->getPlanned());
        $copyObj->setManagersName($this->getManagersName());
        $copyObj->setBrandsDetailedName($this->getBrandsDetailedName());
        $copyObj->setEdDuration($this->getEdDuration());
        $copyObj->setDateTime($this->getDateTime());
        $copyObj->setEmpTerritory($this->getEmpTerritory());
        $copyObj->setEmpBranch($this->getEmpBranch());
        $copyObj->setEmpTown($this->getEmpTown());
        $copyObj->setCustomerTown($this->getCustomerTown());
        $copyObj->setCustomerPatch($this->getCustomerPatch());
        $copyObj->setLeaveTaken($this->getLeaveTaken());
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
     * @return \entities\ExportDcr Clone of current object.
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
        $this->bu_name = null;
        $this->zm_manager_branch = null;
        $this->zm_manager_town = null;
        $this->rm_manager_branch = null;
        $this->rm_manager_town = null;
        $this->am_manager_branch = null;
        $this->am_manager_town = null;
        $this->zm_position_code = null;
        $this->rm_position_code = null;
        $this->am_position_code = null;
        $this->emp_position_code = null;
        $this->emp_position_name = null;
        $this->emp_level = null;
        $this->employee_code = null;
        $this->employee = null;
        $this->jw_employee_code = null;
        $this->jw_employee = null;
        $this->jw_position_name = null;
        $this->outlet_type = null;
        $this->outlet_code = null;
        $this->outlet_name = null;
        $this->agendacontroltype = null;
        $this->agendname = null;
        $this->stownname = null;
        $this->dcr_date = null;
        $this->dcr_status = null;
        $this->nca_comments = null;
        $this->planned = null;
        $this->managers_name = null;
        $this->brands_detailed_name = null;
        $this->ed_duration = null;
        $this->datetime = null;
        $this->emp_territory = null;
        $this->emp_branch = null;
        $this->emp_town = null;
        $this->customer_town = null;
        $this->customer_patch = null;
        $this->leave_teken = null;
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
        return (string) $this->exportTo(ExportDcrTableMap::DEFAULT_STRING_FORMAT);
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
