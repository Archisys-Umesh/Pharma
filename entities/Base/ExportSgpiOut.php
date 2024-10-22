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
use entities\Map\ExportSgpiOutTableMap;

/**
 * Base class that represents a row from the 'export_sgpi_out' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class ExportSgpiOut implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\ExportSgpiOutTableMap';


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
     * The value for the sgpi_voucher_id field.
     *
     * @var        int|null
     */
    protected $sgpi_voucher_id;

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
     * The value for the employee_name field.
     *
     * @var        string|null
     */
    protected $employee_name;

    /**
     * The value for the outlet_code field.
     *
     * @var        string|null
     */
    protected $outlet_code;

    /**
     * The value for the brand_focus field.
     *
     * @var        string|null
     */
    protected $brand_focus;

    /**
     * The value for the outlet_org_id field.
     *
     * @var        int|null
     */
    protected $outlet_org_id;

    /**
     * The value for the org_unit_id field.
     *
     * @var        int|null
     */
    protected $org_unit_id;

    /**
     * The value for the territory_id field.
     *
     * @var        int|null
     */
    protected $territory_id;

    /**
     * The value for the territory_name field.
     *
     * @var        string|null
     */
    protected $territory_name;

    /**
     * The value for the beat_id field.
     *
     * @var        int|null
     */
    protected $beat_id;

    /**
     * The value for the beat_name field.
     *
     * @var        string|null
     */
    protected $beat_name;

    /**
     * The value for the tags field.
     *
     * @var        string|null
     */
    protected $tags;

    /**
     * The value for the visit_fq field.
     *
     * @var        int|null
     */
    protected $visit_fq;

    /**
     * The value for the outlet_salutation field.
     *
     * @var        string|null
     */
    protected $outlet_salutation;

    /**
     * The value for the outlet_name field.
     *
     * @var        string|null
     */
    protected $outlet_name;

    /**
     * The value for the classification field.
     *
     * @var        string|null
     */
    protected $classification;

    /**
     * The value for the outlettype_name field.
     *
     * @var        string|null
     */
    protected $outlettype_name;

    /**
     * The value for the sgpi_name field.
     *
     * @var        string|null
     */
    protected $sgpi_name;

    /**
     * The value for the sgpi_code field.
     *
     * @var        string|null
     */
    protected $sgpi_code;

    /**
     * The value for the material_sku field.
     *
     * @var        string|null
     */
    protected $material_sku;

    /**
     * The value for the sgpi_type field.
     *
     * @var        string|null
     */
    protected $sgpi_type;

    /**
     * The value for the sgpi_qty field.
     *
     * @var        int|null
     */
    protected $sgpi_qty;

    /**
     * The value for the dcr_id field.
     *
     * @var        int|null
     */
    protected $dcr_id;

    /**
     * The value for the dcr_date field.
     *
     * @var        DateTime|null
     */
    protected $dcr_date;

    /**
     * The value for the brand_name field.
     *
     * @var        string|null
     */
    protected $brand_name;

    /**
     * The value for the device_time field.
     *
     * @var        DateTime|null
     */
    protected $device_time;

    /**
     * The value for the managers field.
     *
     * @var        string|null
     */
    protected $managers;

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
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of entities\Base\ExportSgpiOut object.
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
     * Compares this with another <code>ExportSgpiOut</code> instance.  If
     * <code>obj</code> is an instance of <code>ExportSgpiOut</code>, delegates to
     * <code>equals(ExportSgpiOut)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [sgpi_voucher_id] column value.
     *
     * @return int|null
     */
    public function getSgpiVoucherId()
    {
        return $this->sgpi_voucher_id;
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
     * Get the [employee_name] column value.
     *
     * @return string|null
     */
    public function getEmployeeName()
    {
        return $this->employee_name;
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
     * Get the [brand_focus] column value.
     *
     * @return string|null
     */
    public function getBrandFocus()
    {
        return $this->brand_focus;
    }

    /**
     * Get the [outlet_org_id] column value.
     *
     * @return int|null
     */
    public function getOutletOrgId()
    {
        return $this->outlet_org_id;
    }

    /**
     * Get the [org_unit_id] column value.
     *
     * @return int|null
     */
    public function getOrgUnitId()
    {
        return $this->org_unit_id;
    }

    /**
     * Get the [territory_id] column value.
     *
     * @return int|null
     */
    public function getTerritoryId()
    {
        return $this->territory_id;
    }

    /**
     * Get the [territory_name] column value.
     *
     * @return string|null
     */
    public function getTerritoryName()
    {
        return $this->territory_name;
    }

    /**
     * Get the [beat_id] column value.
     *
     * @return int|null
     */
    public function getBeatId()
    {
        return $this->beat_id;
    }

    /**
     * Get the [beat_name] column value.
     *
     * @return string|null
     */
    public function getBeatName()
    {
        return $this->beat_name;
    }

    /**
     * Get the [tags] column value.
     *
     * @return string|null
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Get the [visit_fq] column value.
     *
     * @return int|null
     */
    public function getVisitFq()
    {
        return $this->visit_fq;
    }

    /**
     * Get the [outlet_salutation] column value.
     *
     * @return string|null
     */
    public function getOutletSalutation()
    {
        return $this->outlet_salutation;
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
     * Get the [classification] column value.
     *
     * @return string|null
     */
    public function getClassification()
    {
        return $this->classification;
    }

    /**
     * Get the [outlettype_name] column value.
     *
     * @return string|null
     */
    public function getOutlettypeName()
    {
        return $this->outlettype_name;
    }

    /**
     * Get the [sgpi_name] column value.
     *
     * @return string|null
     */
    public function getSgpiName()
    {
        return $this->sgpi_name;
    }

    /**
     * Get the [sgpi_code] column value.
     *
     * @return string|null
     */
    public function getSgpiCode()
    {
        return $this->sgpi_code;
    }

    /**
     * Get the [material_sku] column value.
     *
     * @return string|null
     */
    public function getMaterialSku()
    {
        return $this->material_sku;
    }

    /**
     * Get the [sgpi_type] column value.
     *
     * @return string|null
     */
    public function getSgpiType()
    {
        return $this->sgpi_type;
    }

    /**
     * Get the [sgpi_qty] column value.
     *
     * @return int|null
     */
    public function getSgpiQty()
    {
        return $this->sgpi_qty;
    }

    /**
     * Get the [dcr_id] column value.
     *
     * @return int|null
     */
    public function getDcrId()
    {
        return $this->dcr_id;
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
     * Get the [brand_name] column value.
     *
     * @return string|null
     */
    public function getBrandName()
    {
        return $this->brand_name;
    }

    /**
     * Get the [optionally formatted] temporal [device_time] column value.
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
    public function getDeviceTime($format = null)
    {
        if ($format === null) {
            return $this->device_time;
        } else {
            return $this->device_time instanceof \DateTimeInterface ? $this->device_time->format($format) : null;
        }
    }

    /**
     * Get the [managers] column value.
     *
     * @return string|null
     */
    public function getManagers()
    {
        return $this->managers;
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
     * Set the value of [sgpi_voucher_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setSgpiVoucherId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->sgpi_voucher_id !== $v) {
            $this->sgpi_voucher_id = $v;
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_SGPI_VOUCHER_ID] = true;
        }

        return $this;
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
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_BU_NAME] = true;
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
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_ZM_MANAGER_BRANCH] = true;
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
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_ZM_MANAGER_TOWN] = true;
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
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_RM_MANAGER_BRANCH] = true;
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
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_RM_MANAGER_TOWN] = true;
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
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_AM_MANAGER_BRANCH] = true;
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
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_AM_MANAGER_TOWN] = true;
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
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_ZM_POSITION_CODE] = true;
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
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_RM_POSITION_CODE] = true;
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
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_AM_POSITION_CODE] = true;
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
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_EMP_POSITION_CODE] = true;
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
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_EMP_POSITION_NAME] = true;
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
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_EMP_LEVEL] = true;
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
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_EMPLOYEE_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmployeeName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->employee_name !== $v) {
            $this->employee_name = $v;
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_EMPLOYEE_NAME] = true;
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
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_OUTLET_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [brand_focus] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setBrandFocus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->brand_focus !== $v) {
            $this->brand_focus = $v;
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_BRAND_FOCUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_org_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletOrgId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_org_id !== $v) {
            $this->outlet_org_id = $v;
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_OUTLET_ORG_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [org_unit_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOrgUnitId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->org_unit_id !== $v) {
            $this->org_unit_id = $v;
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_ORG_UNIT_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [territory_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setTerritoryId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->territory_id !== $v) {
            $this->territory_id = $v;
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_TERRITORY_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [territory_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setTerritoryName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->territory_name !== $v) {
            $this->territory_name = $v;
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_TERRITORY_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [beat_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setBeatId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->beat_id !== $v) {
            $this->beat_id = $v;
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_BEAT_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [beat_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setBeatName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->beat_name !== $v) {
            $this->beat_name = $v;
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_BEAT_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [tags] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setTags($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tags !== $v) {
            $this->tags = $v;
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_TAGS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [visit_fq] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setVisitFq($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->visit_fq !== $v) {
            $this->visit_fq = $v;
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_VISIT_FQ] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_salutation] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletSalutation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_salutation !== $v) {
            $this->outlet_salutation = $v;
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_OUTLET_SALUTATION] = true;
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
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_OUTLET_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [classification] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setClassification($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->classification !== $v) {
            $this->classification = $v;
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_CLASSIFICATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlettype_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutlettypeName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlettype_name !== $v) {
            $this->outlettype_name = $v;
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_OUTLETTYPE_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sgpi_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setSgpiName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sgpi_name !== $v) {
            $this->sgpi_name = $v;
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_SGPI_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sgpi_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setSgpiCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sgpi_code !== $v) {
            $this->sgpi_code = $v;
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_SGPI_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [material_sku] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setMaterialSku($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->material_sku !== $v) {
            $this->material_sku = $v;
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_MATERIAL_SKU] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sgpi_type] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setSgpiType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sgpi_type !== $v) {
            $this->sgpi_type = $v;
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_SGPI_TYPE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sgpi_qty] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setSgpiQty($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->sgpi_qty !== $v) {
            $this->sgpi_qty = $v;
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_SGPI_QTY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [dcr_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setDcrId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->dcr_id !== $v) {
            $this->dcr_id = $v;
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_DCR_ID] = true;
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
                $this->modifiedColumns[ExportSgpiOutTableMap::COL_DCR_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [brand_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setBrandName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->brand_name !== $v) {
            $this->brand_name = $v;
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_BRAND_NAME] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [device_time] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    protected function setDeviceTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->device_time !== null || $dt !== null) {
            if ($this->device_time === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->device_time->format("Y-m-d H:i:s.u")) {
                $this->device_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ExportSgpiOutTableMap::COL_DEVICE_TIME] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [managers] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setManagers($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->managers !== $v) {
            $this->managers = $v;
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_MANAGERS] = true;
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
    protected function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ExportSgpiOutTableMap::COL_CREATED_AT] = true;
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
    protected function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ExportSgpiOutTableMap::COL_UPDATED_AT] = true;
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
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_EMP_TERRITORY] = true;
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
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_EMP_BRANCH] = true;
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
            $this->modifiedColumns[ExportSgpiOutTableMap::COL_EMP_TOWN] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ExportSgpiOutTableMap::translateFieldName('SgpiVoucherId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_voucher_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ExportSgpiOutTableMap::translateFieldName('BuName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bu_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ExportSgpiOutTableMap::translateFieldName('ZmManagerBranch', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zm_manager_branch = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ExportSgpiOutTableMap::translateFieldName('ZmManagerTown', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zm_manager_town = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ExportSgpiOutTableMap::translateFieldName('RmManagerBranch', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rm_manager_branch = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ExportSgpiOutTableMap::translateFieldName('RmManagerTown', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rm_manager_town = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ExportSgpiOutTableMap::translateFieldName('AmManagerBranch', TableMap::TYPE_PHPNAME, $indexType)];
            $this->am_manager_branch = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ExportSgpiOutTableMap::translateFieldName('AmManagerTown', TableMap::TYPE_PHPNAME, $indexType)];
            $this->am_manager_town = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ExportSgpiOutTableMap::translateFieldName('ZmPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zm_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ExportSgpiOutTableMap::translateFieldName('RmPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rm_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ExportSgpiOutTableMap::translateFieldName('AmPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->am_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ExportSgpiOutTableMap::translateFieldName('EmpPositionCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_position_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : ExportSgpiOutTableMap::translateFieldName('EmpPositionName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_position_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : ExportSgpiOutTableMap::translateFieldName('EmpLevel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_level = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : ExportSgpiOutTableMap::translateFieldName('EmployeeCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : ExportSgpiOutTableMap::translateFieldName('EmployeeName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : ExportSgpiOutTableMap::translateFieldName('OutletCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : ExportSgpiOutTableMap::translateFieldName('BrandFocus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_focus = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : ExportSgpiOutTableMap::translateFieldName('OutletOrgId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_org_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : ExportSgpiOutTableMap::translateFieldName('OrgUnitId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->org_unit_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : ExportSgpiOutTableMap::translateFieldName('TerritoryId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->territory_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : ExportSgpiOutTableMap::translateFieldName('TerritoryName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->territory_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : ExportSgpiOutTableMap::translateFieldName('BeatId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->beat_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : ExportSgpiOutTableMap::translateFieldName('BeatName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->beat_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : ExportSgpiOutTableMap::translateFieldName('Tags', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tags = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : ExportSgpiOutTableMap::translateFieldName('VisitFq', TableMap::TYPE_PHPNAME, $indexType)];
            $this->visit_fq = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : ExportSgpiOutTableMap::translateFieldName('OutletSalutation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_salutation = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : ExportSgpiOutTableMap::translateFieldName('OutletName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : ExportSgpiOutTableMap::translateFieldName('Classification', TableMap::TYPE_PHPNAME, $indexType)];
            $this->classification = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : ExportSgpiOutTableMap::translateFieldName('OutlettypeName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlettype_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : ExportSgpiOutTableMap::translateFieldName('SgpiName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : ExportSgpiOutTableMap::translateFieldName('SgpiCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 32 + $startcol : ExportSgpiOutTableMap::translateFieldName('MaterialSku', TableMap::TYPE_PHPNAME, $indexType)];
            $this->material_sku = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 33 + $startcol : ExportSgpiOutTableMap::translateFieldName('SgpiType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 34 + $startcol : ExportSgpiOutTableMap::translateFieldName('SgpiQty', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_qty = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 35 + $startcol : ExportSgpiOutTableMap::translateFieldName('DcrId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dcr_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 36 + $startcol : ExportSgpiOutTableMap::translateFieldName('DcrDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dcr_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 37 + $startcol : ExportSgpiOutTableMap::translateFieldName('BrandName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 38 + $startcol : ExportSgpiOutTableMap::translateFieldName('DeviceTime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->device_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 39 + $startcol : ExportSgpiOutTableMap::translateFieldName('Managers', TableMap::TYPE_PHPNAME, $indexType)];
            $this->managers = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 40 + $startcol : ExportSgpiOutTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 41 + $startcol : ExportSgpiOutTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 42 + $startcol : ExportSgpiOutTableMap::translateFieldName('EmpTerritory', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_territory = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 43 + $startcol : ExportSgpiOutTableMap::translateFieldName('EmpBranch', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_branch = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 44 + $startcol : ExportSgpiOutTableMap::translateFieldName('EmpTown', TableMap::TYPE_PHPNAME, $indexType)];
            $this->emp_town = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 45; // 45 = ExportSgpiOutTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\ExportSgpiOut'), 0, $e);
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
        $pos = ExportSgpiOutTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getSgpiVoucherId();

            case 1:
                return $this->getBuName();

            case 2:
                return $this->getZmManagerBranch();

            case 3:
                return $this->getZmManagerTown();

            case 4:
                return $this->getRmManagerBranch();

            case 5:
                return $this->getRmManagerTown();

            case 6:
                return $this->getAmManagerBranch();

            case 7:
                return $this->getAmManagerTown();

            case 8:
                return $this->getZmPositionCode();

            case 9:
                return $this->getRmPositionCode();

            case 10:
                return $this->getAmPositionCode();

            case 11:
                return $this->getEmpPositionCode();

            case 12:
                return $this->getEmpPositionName();

            case 13:
                return $this->getEmpLevel();

            case 14:
                return $this->getEmployeeCode();

            case 15:
                return $this->getEmployeeName();

            case 16:
                return $this->getOutletCode();

            case 17:
                return $this->getBrandFocus();

            case 18:
                return $this->getOutletOrgId();

            case 19:
                return $this->getOrgUnitId();

            case 20:
                return $this->getTerritoryId();

            case 21:
                return $this->getTerritoryName();

            case 22:
                return $this->getBeatId();

            case 23:
                return $this->getBeatName();

            case 24:
                return $this->getTags();

            case 25:
                return $this->getVisitFq();

            case 26:
                return $this->getOutletSalutation();

            case 27:
                return $this->getOutletName();

            case 28:
                return $this->getClassification();

            case 29:
                return $this->getOutlettypeName();

            case 30:
                return $this->getSgpiName();

            case 31:
                return $this->getSgpiCode();

            case 32:
                return $this->getMaterialSku();

            case 33:
                return $this->getSgpiType();

            case 34:
                return $this->getSgpiQty();

            case 35:
                return $this->getDcrId();

            case 36:
                return $this->getDcrDate();

            case 37:
                return $this->getBrandName();

            case 38:
                return $this->getDeviceTime();

            case 39:
                return $this->getManagers();

            case 40:
                return $this->getCreatedAt();

            case 41:
                return $this->getUpdatedAt();

            case 42:
                return $this->getEmpTerritory();

            case 43:
                return $this->getEmpBranch();

            case 44:
                return $this->getEmpTown();

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
        if (isset($alreadyDumpedObjects['ExportSgpiOut'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['ExportSgpiOut'][$this->hashCode()] = true;
        $keys = ExportSgpiOutTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getSgpiVoucherId(),
            $keys[1] => $this->getBuName(),
            $keys[2] => $this->getZmManagerBranch(),
            $keys[3] => $this->getZmManagerTown(),
            $keys[4] => $this->getRmManagerBranch(),
            $keys[5] => $this->getRmManagerTown(),
            $keys[6] => $this->getAmManagerBranch(),
            $keys[7] => $this->getAmManagerTown(),
            $keys[8] => $this->getZmPositionCode(),
            $keys[9] => $this->getRmPositionCode(),
            $keys[10] => $this->getAmPositionCode(),
            $keys[11] => $this->getEmpPositionCode(),
            $keys[12] => $this->getEmpPositionName(),
            $keys[13] => $this->getEmpLevel(),
            $keys[14] => $this->getEmployeeCode(),
            $keys[15] => $this->getEmployeeName(),
            $keys[16] => $this->getOutletCode(),
            $keys[17] => $this->getBrandFocus(),
            $keys[18] => $this->getOutletOrgId(),
            $keys[19] => $this->getOrgUnitId(),
            $keys[20] => $this->getTerritoryId(),
            $keys[21] => $this->getTerritoryName(),
            $keys[22] => $this->getBeatId(),
            $keys[23] => $this->getBeatName(),
            $keys[24] => $this->getTags(),
            $keys[25] => $this->getVisitFq(),
            $keys[26] => $this->getOutletSalutation(),
            $keys[27] => $this->getOutletName(),
            $keys[28] => $this->getClassification(),
            $keys[29] => $this->getOutlettypeName(),
            $keys[30] => $this->getSgpiName(),
            $keys[31] => $this->getSgpiCode(),
            $keys[32] => $this->getMaterialSku(),
            $keys[33] => $this->getSgpiType(),
            $keys[34] => $this->getSgpiQty(),
            $keys[35] => $this->getDcrId(),
            $keys[36] => $this->getDcrDate(),
            $keys[37] => $this->getBrandName(),
            $keys[38] => $this->getDeviceTime(),
            $keys[39] => $this->getManagers(),
            $keys[40] => $this->getCreatedAt(),
            $keys[41] => $this->getUpdatedAt(),
            $keys[42] => $this->getEmpTerritory(),
            $keys[43] => $this->getEmpBranch(),
            $keys[44] => $this->getEmpTown(),
        ];
        if ($result[$keys[36]] instanceof \DateTimeInterface) {
            $result[$keys[36]] = $result[$keys[36]]->format('Y-m-d');
        }

        if ($result[$keys[38]] instanceof \DateTimeInterface) {
            $result[$keys[38]] = $result[$keys[38]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[40]] instanceof \DateTimeInterface) {
            $result[$keys[40]] = $result[$keys[40]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[41]] instanceof \DateTimeInterface) {
            $result[$keys[41]] = $result[$keys[41]]->format('Y-m-d H:i:s.u');
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
        $criteria = new Criteria(ExportSgpiOutTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_SGPI_VOUCHER_ID)) {
            $criteria->add(ExportSgpiOutTableMap::COL_SGPI_VOUCHER_ID, $this->sgpi_voucher_id);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_BU_NAME)) {
            $criteria->add(ExportSgpiOutTableMap::COL_BU_NAME, $this->bu_name);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_ZM_MANAGER_BRANCH)) {
            $criteria->add(ExportSgpiOutTableMap::COL_ZM_MANAGER_BRANCH, $this->zm_manager_branch);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_ZM_MANAGER_TOWN)) {
            $criteria->add(ExportSgpiOutTableMap::COL_ZM_MANAGER_TOWN, $this->zm_manager_town);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_RM_MANAGER_BRANCH)) {
            $criteria->add(ExportSgpiOutTableMap::COL_RM_MANAGER_BRANCH, $this->rm_manager_branch);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_RM_MANAGER_TOWN)) {
            $criteria->add(ExportSgpiOutTableMap::COL_RM_MANAGER_TOWN, $this->rm_manager_town);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_AM_MANAGER_BRANCH)) {
            $criteria->add(ExportSgpiOutTableMap::COL_AM_MANAGER_BRANCH, $this->am_manager_branch);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_AM_MANAGER_TOWN)) {
            $criteria->add(ExportSgpiOutTableMap::COL_AM_MANAGER_TOWN, $this->am_manager_town);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_ZM_POSITION_CODE)) {
            $criteria->add(ExportSgpiOutTableMap::COL_ZM_POSITION_CODE, $this->zm_position_code);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_RM_POSITION_CODE)) {
            $criteria->add(ExportSgpiOutTableMap::COL_RM_POSITION_CODE, $this->rm_position_code);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_AM_POSITION_CODE)) {
            $criteria->add(ExportSgpiOutTableMap::COL_AM_POSITION_CODE, $this->am_position_code);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_EMP_POSITION_CODE)) {
            $criteria->add(ExportSgpiOutTableMap::COL_EMP_POSITION_CODE, $this->emp_position_code);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_EMP_POSITION_NAME)) {
            $criteria->add(ExportSgpiOutTableMap::COL_EMP_POSITION_NAME, $this->emp_position_name);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_EMP_LEVEL)) {
            $criteria->add(ExportSgpiOutTableMap::COL_EMP_LEVEL, $this->emp_level);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_EMPLOYEE_CODE)) {
            $criteria->add(ExportSgpiOutTableMap::COL_EMPLOYEE_CODE, $this->employee_code);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_EMPLOYEE_NAME)) {
            $criteria->add(ExportSgpiOutTableMap::COL_EMPLOYEE_NAME, $this->employee_name);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_OUTLET_CODE)) {
            $criteria->add(ExportSgpiOutTableMap::COL_OUTLET_CODE, $this->outlet_code);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_BRAND_FOCUS)) {
            $criteria->add(ExportSgpiOutTableMap::COL_BRAND_FOCUS, $this->brand_focus);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_OUTLET_ORG_ID)) {
            $criteria->add(ExportSgpiOutTableMap::COL_OUTLET_ORG_ID, $this->outlet_org_id);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_ORG_UNIT_ID)) {
            $criteria->add(ExportSgpiOutTableMap::COL_ORG_UNIT_ID, $this->org_unit_id);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_TERRITORY_ID)) {
            $criteria->add(ExportSgpiOutTableMap::COL_TERRITORY_ID, $this->territory_id);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_TERRITORY_NAME)) {
            $criteria->add(ExportSgpiOutTableMap::COL_TERRITORY_NAME, $this->territory_name);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_BEAT_ID)) {
            $criteria->add(ExportSgpiOutTableMap::COL_BEAT_ID, $this->beat_id);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_BEAT_NAME)) {
            $criteria->add(ExportSgpiOutTableMap::COL_BEAT_NAME, $this->beat_name);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_TAGS)) {
            $criteria->add(ExportSgpiOutTableMap::COL_TAGS, $this->tags);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_VISIT_FQ)) {
            $criteria->add(ExportSgpiOutTableMap::COL_VISIT_FQ, $this->visit_fq);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_OUTLET_SALUTATION)) {
            $criteria->add(ExportSgpiOutTableMap::COL_OUTLET_SALUTATION, $this->outlet_salutation);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_OUTLET_NAME)) {
            $criteria->add(ExportSgpiOutTableMap::COL_OUTLET_NAME, $this->outlet_name);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_CLASSIFICATION)) {
            $criteria->add(ExportSgpiOutTableMap::COL_CLASSIFICATION, $this->classification);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_OUTLETTYPE_NAME)) {
            $criteria->add(ExportSgpiOutTableMap::COL_OUTLETTYPE_NAME, $this->outlettype_name);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_SGPI_NAME)) {
            $criteria->add(ExportSgpiOutTableMap::COL_SGPI_NAME, $this->sgpi_name);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_SGPI_CODE)) {
            $criteria->add(ExportSgpiOutTableMap::COL_SGPI_CODE, $this->sgpi_code);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_MATERIAL_SKU)) {
            $criteria->add(ExportSgpiOutTableMap::COL_MATERIAL_SKU, $this->material_sku);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_SGPI_TYPE)) {
            $criteria->add(ExportSgpiOutTableMap::COL_SGPI_TYPE, $this->sgpi_type);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_SGPI_QTY)) {
            $criteria->add(ExportSgpiOutTableMap::COL_SGPI_QTY, $this->sgpi_qty);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_DCR_ID)) {
            $criteria->add(ExportSgpiOutTableMap::COL_DCR_ID, $this->dcr_id);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_DCR_DATE)) {
            $criteria->add(ExportSgpiOutTableMap::COL_DCR_DATE, $this->dcr_date);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_BRAND_NAME)) {
            $criteria->add(ExportSgpiOutTableMap::COL_BRAND_NAME, $this->brand_name);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_DEVICE_TIME)) {
            $criteria->add(ExportSgpiOutTableMap::COL_DEVICE_TIME, $this->device_time);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_MANAGERS)) {
            $criteria->add(ExportSgpiOutTableMap::COL_MANAGERS, $this->managers);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_CREATED_AT)) {
            $criteria->add(ExportSgpiOutTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_UPDATED_AT)) {
            $criteria->add(ExportSgpiOutTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_EMP_TERRITORY)) {
            $criteria->add(ExportSgpiOutTableMap::COL_EMP_TERRITORY, $this->emp_territory);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_EMP_BRANCH)) {
            $criteria->add(ExportSgpiOutTableMap::COL_EMP_BRANCH, $this->emp_branch);
        }
        if ($this->isColumnModified(ExportSgpiOutTableMap::COL_EMP_TOWN)) {
            $criteria->add(ExportSgpiOutTableMap::COL_EMP_TOWN, $this->emp_town);
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
        throw new LogicException('The ExportSgpiOut object has no primary key');

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
     * @param object $copyObj An object of \entities\ExportSgpiOut (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setSgpiVoucherId($this->getSgpiVoucherId());
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
        $copyObj->setEmployeeName($this->getEmployeeName());
        $copyObj->setOutletCode($this->getOutletCode());
        $copyObj->setBrandFocus($this->getBrandFocus());
        $copyObj->setOutletOrgId($this->getOutletOrgId());
        $copyObj->setOrgUnitId($this->getOrgUnitId());
        $copyObj->setTerritoryId($this->getTerritoryId());
        $copyObj->setTerritoryName($this->getTerritoryName());
        $copyObj->setBeatId($this->getBeatId());
        $copyObj->setBeatName($this->getBeatName());
        $copyObj->setTags($this->getTags());
        $copyObj->setVisitFq($this->getVisitFq());
        $copyObj->setOutletSalutation($this->getOutletSalutation());
        $copyObj->setOutletName($this->getOutletName());
        $copyObj->setClassification($this->getClassification());
        $copyObj->setOutlettypeName($this->getOutlettypeName());
        $copyObj->setSgpiName($this->getSgpiName());
        $copyObj->setSgpiCode($this->getSgpiCode());
        $copyObj->setMaterialSku($this->getMaterialSku());
        $copyObj->setSgpiType($this->getSgpiType());
        $copyObj->setSgpiQty($this->getSgpiQty());
        $copyObj->setDcrId($this->getDcrId());
        $copyObj->setDcrDate($this->getDcrDate());
        $copyObj->setBrandName($this->getBrandName());
        $copyObj->setDeviceTime($this->getDeviceTime());
        $copyObj->setManagers($this->getManagers());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setEmpTerritory($this->getEmpTerritory());
        $copyObj->setEmpBranch($this->getEmpBranch());
        $copyObj->setEmpTown($this->getEmpTown());
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
     * @return \entities\ExportSgpiOut Clone of current object.
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
        $this->sgpi_voucher_id = null;
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
        $this->employee_name = null;
        $this->outlet_code = null;
        $this->brand_focus = null;
        $this->outlet_org_id = null;
        $this->org_unit_id = null;
        $this->territory_id = null;
        $this->territory_name = null;
        $this->beat_id = null;
        $this->beat_name = null;
        $this->tags = null;
        $this->visit_fq = null;
        $this->outlet_salutation = null;
        $this->outlet_name = null;
        $this->classification = null;
        $this->outlettype_name = null;
        $this->sgpi_name = null;
        $this->sgpi_code = null;
        $this->material_sku = null;
        $this->sgpi_type = null;
        $this->sgpi_qty = null;
        $this->dcr_id = null;
        $this->dcr_date = null;
        $this->brand_name = null;
        $this->device_time = null;
        $this->managers = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->emp_territory = null;
        $this->emp_branch = null;
        $this->emp_town = null;
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
        return (string) $this->exportTo(ExportSgpiOutTableMap::DEFAULT_STRING_FORMAT);
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
