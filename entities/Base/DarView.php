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
use entities\DarViewQuery as ChildDarViewQuery;
use entities\Map\DarViewTableMap;

/**
 * Base class that represents a row from the 'dar_view' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class DarView implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\DarViewTableMap';


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
     * The value for the dcr_id field.
     *
     * @var        int
     */
    protected $dcr_id;

    /**
     * The value for the agendacontroltype field.
     *
     * @var        string|null
     */
    protected $agendacontroltype;

    /**
     * The value for the employee_code field.
     *
     * @var        string|null
     */
    protected $employee_code;

    /**
     * The value for the first_name field.
     *
     * @var        string|null
     */
    protected $first_name;

    /**
     * The value for the outlet_name field.
     *
     * @var        string|null
     */
    protected $outlet_name;

    /**
     * The value for the outlet_id field.
     *
     * @var        int|null
     */
    protected $outlet_id;

    /**
     * The value for the outlet_code field.
     *
     * @var        string|null
     */
    protected $outlet_code;

    /**
     * The value for the agendname field.
     *
     * @var        string|null
     */
    protected $agendname;

    /**
     * The value for the position_id field.
     *
     * @var        int|null
     */
    protected $position_id;

    /**
     * The value for the position_name field.
     *
     * @var        string|null
     */
    protected $position_name;

    /**
     * The value for the stownname field.
     *
     * @var        string|null
     */
    protected $stownname;

    /**
     * The value for the dcr_date field.
     *
     * @var        string|null
     */
    protected $dcr_date;

    /**
     * The value for the dcr_status field.
     *
     * @var        string|null
     */
    protected $dcr_status;

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
     * The value for the planned field.
     *
     * @var        string|null
     */
    protected $planned;

    /**
     * The value for the unit_name field.
     *
     * @var        string|null
     */
    protected $unit_name;

    /**
     * The value for the datetime field.
     *
     * @var        DateTime|null
     */
    protected $datetime;

    /**
     * The value for the managers field.
     *
     * @var        string|null
     */
    protected $managers;

    /**
     * The value for the brands_detailed field.
     *
     * @var        string|null
     */
    protected $brands_detailed;

    /**
     * The value for the sgpi_out field.
     *
     * @var        string|null
     */
    protected $sgpi_out;

    /**
     * The value for the pob_total field.
     *
     * @var        int|null
     */
    protected $pob_total;

    /**
     * The value for the employee_id field.
     *
     * @var        int|null
     */
    protected $employee_id;

    /**
     * The value for the ed_duration field.
     *
     * @var        int|null
     */
    protected $ed_duration;

    /**
     * The value for the territory_id field.
     *
     * @var        int|null
     */
    protected $territory_id;

    /**
     * The value for the outlettype_id field.
     *
     * @var        int|null
     */
    protected $outlettype_id;

    /**
     * The value for the outlettype_name field.
     *
     * @var        string|null
     */
    protected $outlettype_name;

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
     * The value for the isjw field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $isjw;

    /**
     * The value for the brand_campaign_name field.
     *
     * @var        string|null
     */
    protected $brand_campaign_name;

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
        $this->isjw = false;
    }

    /**
     * Initializes internal state of entities\Base\DarView object.
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
     * Compares this with another <code>DarView</code> instance.  If
     * <code>obj</code> is an instance of <code>DarView</code>, delegates to
     * <code>equals(DarView)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [dcr_id] column value.
     *
     * @return int
     */
    public function getDcrId()
    {
        return $this->dcr_id;
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
     * Get the [employee_code] column value.
     *
     * @return string|null
     */
    public function getEmployeeCode()
    {
        return $this->employee_code;
    }

    /**
     * Get the [first_name] column value.
     *
     * @return string|null
     */
    public function getFirstName()
    {
        return $this->first_name;
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
     * Get the [outlet_id] column value.
     *
     * @return int|null
     */
    public function getOutletId()
    {
        return $this->outlet_id;
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
     * Get the [agendname] column value.
     *
     * @return string|null
     */
    public function getAgendname()
    {
        return $this->agendname;
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
     * Get the [position_name] column value.
     *
     * @return string|null
     */
    public function getPositionName()
    {
        return $this->position_name;
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
     * Get the [dcr_date] column value.
     *
     * @return string|null
     */
    public function getDcrDate()
    {
        return $this->dcr_date;
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
     * Get the [planned] column value.
     *
     * @return string|null
     */
    public function getPlanned()
    {
        return $this->planned;
    }

    /**
     * Get the [unit_name] column value.
     *
     * @return string|null
     */
    public function getUnitName()
    {
        return $this->unit_name;
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
     * Get the [managers] column value.
     *
     * @return string|null
     */
    public function getManagers()
    {
        return $this->managers;
    }

    /**
     * Get the [brands_detailed] column value.
     *
     * @return string|null
     */
    public function getBrandsDetailed()
    {
        return $this->brands_detailed;
    }

    /**
     * Get the [sgpi_out] column value.
     *
     * @return string|null
     */
    public function getSgpiOut()
    {
        return $this->sgpi_out;
    }

    /**
     * Get the [pob_total] column value.
     *
     * @return int|null
     */
    public function getPobTotal()
    {
        return $this->pob_total;
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
     * Get the [ed_duration] column value.
     *
     * @return int|null
     */
    public function getEdDuration()
    {
        return $this->ed_duration;
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
     * Get the [outlettype_id] column value.
     *
     * @return int|null
     */
    public function getOutlettypeId()
    {
        return $this->outlettype_id;
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
     * Get the [isjw] column value.
     *
     * @return boolean|null
     */
    public function getIsjw()
    {
        return $this->isjw;
    }

    /**
     * Get the [isjw] column value.
     *
     * @return boolean|null
     */
    public function isIsjw()
    {
        return $this->getIsjw();
    }

    /**
     * Get the [brand_campaign_name] column value.
     *
     * @return string|null
     */
    public function getBrandCampaignName()
    {
        return $this->brand_campaign_name;
    }

    /**
     * Set the value of [dcr_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setDcrId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->dcr_id !== $v) {
            $this->dcr_id = $v;
            $this->modifiedColumns[DarViewTableMap::COL_DCR_ID] = true;
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
            $this->modifiedColumns[DarViewTableMap::COL_AGENDACONTROLTYPE] = true;
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
            $this->modifiedColumns[DarViewTableMap::COL_EMPLOYEE_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [first_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setFirstName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->first_name !== $v) {
            $this->first_name = $v;
            $this->modifiedColumns[DarViewTableMap::COL_FIRST_NAME] = true;
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
            $this->modifiedColumns[DarViewTableMap::COL_OUTLET_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutletId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_id !== $v) {
            $this->outlet_id = $v;
            $this->modifiedColumns[DarViewTableMap::COL_OUTLET_ID] = true;
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
            $this->modifiedColumns[DarViewTableMap::COL_OUTLET_CODE] = true;
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
            $this->modifiedColumns[DarViewTableMap::COL_AGENDNAME] = true;
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
            $this->modifiedColumns[DarViewTableMap::COL_POSITION_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [position_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setPositionName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->position_name !== $v) {
            $this->position_name = $v;
            $this->modifiedColumns[DarViewTableMap::COL_POSITION_NAME] = true;
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
            $this->modifiedColumns[DarViewTableMap::COL_STOWNNAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [dcr_date] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setDcrDate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dcr_date !== $v) {
            $this->dcr_date = $v;
            $this->modifiedColumns[DarViewTableMap::COL_DCR_DATE] = true;
        }

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
            $this->modifiedColumns[DarViewTableMap::COL_DCR_STATUS] = true;
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
                $this->modifiedColumns[DarViewTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[DarViewTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

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
            $this->modifiedColumns[DarViewTableMap::COL_PLANNED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [unit_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setUnitName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->unit_name !== $v) {
            $this->unit_name = $v;
            $this->modifiedColumns[DarViewTableMap::COL_UNIT_NAME] = true;
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
                $this->modifiedColumns[DarViewTableMap::COL_DATETIME] = true;
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
            $this->modifiedColumns[DarViewTableMap::COL_MANAGERS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [brands_detailed] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setBrandsDetailed($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->brands_detailed !== $v) {
            $this->brands_detailed = $v;
            $this->modifiedColumns[DarViewTableMap::COL_BRANDS_DETAILED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sgpi_out] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setSgpiOut($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sgpi_out !== $v) {
            $this->sgpi_out = $v;
            $this->modifiedColumns[DarViewTableMap::COL_SGPI_OUT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [pob_total] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setPobTotal($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->pob_total !== $v) {
            $this->pob_total = $v;
            $this->modifiedColumns[DarViewTableMap::COL_POB_TOTAL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setEmployeeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->employee_id !== $v) {
            $this->employee_id = $v;
            $this->modifiedColumns[DarViewTableMap::COL_EMPLOYEE_ID] = true;
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
            $this->modifiedColumns[DarViewTableMap::COL_ED_DURATION] = true;
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
            $this->modifiedColumns[DarViewTableMap::COL_TERRITORY_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlettype_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setOutlettypeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlettype_id !== $v) {
            $this->outlettype_id = $v;
            $this->modifiedColumns[DarViewTableMap::COL_OUTLETTYPE_ID] = true;
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
            $this->modifiedColumns[DarViewTableMap::COL_OUTLETTYPE_NAME] = true;
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
            $this->modifiedColumns[DarViewTableMap::COL_BEAT_ID] = true;
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
            $this->modifiedColumns[DarViewTableMap::COL_BEAT_NAME] = true;
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
            $this->modifiedColumns[DarViewTableMap::COL_TAGS] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [isjw] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    protected function setIsjw($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->isjw !== $v) {
            $this->isjw = $v;
            $this->modifiedColumns[DarViewTableMap::COL_ISJW] = true;
        }

        return $this;
    }

    /**
     * Set the value of [brand_campaign_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    protected function setBrandCampaignName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->brand_campaign_name !== $v) {
            $this->brand_campaign_name = $v;
            $this->modifiedColumns[DarViewTableMap::COL_BRAND_CAMPAIGN_NAME] = true;
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
            if ($this->isjw !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : DarViewTableMap::translateFieldName('DcrId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dcr_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : DarViewTableMap::translateFieldName('Agendacontroltype', TableMap::TYPE_PHPNAME, $indexType)];
            $this->agendacontroltype = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : DarViewTableMap::translateFieldName('EmployeeCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : DarViewTableMap::translateFieldName('FirstName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->first_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : DarViewTableMap::translateFieldName('OutletName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : DarViewTableMap::translateFieldName('OutletId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : DarViewTableMap::translateFieldName('OutletCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : DarViewTableMap::translateFieldName('Agendname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->agendname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : DarViewTableMap::translateFieldName('PositionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : DarViewTableMap::translateFieldName('PositionName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : DarViewTableMap::translateFieldName('Stownname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stownname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : DarViewTableMap::translateFieldName('DcrDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dcr_date = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : DarViewTableMap::translateFieldName('DcrStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dcr_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : DarViewTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : DarViewTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : DarViewTableMap::translateFieldName('Planned', TableMap::TYPE_PHPNAME, $indexType)];
            $this->planned = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : DarViewTableMap::translateFieldName('UnitName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->unit_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : DarViewTableMap::translateFieldName('DateTime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->datetime = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : DarViewTableMap::translateFieldName('Managers', TableMap::TYPE_PHPNAME, $indexType)];
            $this->managers = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : DarViewTableMap::translateFieldName('BrandsDetailed', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brands_detailed = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : DarViewTableMap::translateFieldName('SgpiOut', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_out = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : DarViewTableMap::translateFieldName('PobTotal', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pob_total = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : DarViewTableMap::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : DarViewTableMap::translateFieldName('EdDuration', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ed_duration = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : DarViewTableMap::translateFieldName('TerritoryId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->territory_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : DarViewTableMap::translateFieldName('OutlettypeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlettype_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : DarViewTableMap::translateFieldName('OutlettypeName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlettype_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : DarViewTableMap::translateFieldName('BeatId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->beat_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : DarViewTableMap::translateFieldName('BeatName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->beat_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : DarViewTableMap::translateFieldName('Tags', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tags = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : DarViewTableMap::translateFieldName('Isjw', TableMap::TYPE_PHPNAME, $indexType)];
            $this->isjw = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : DarViewTableMap::translateFieldName('BrandCampaignName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_campaign_name = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 32; // 32 = DarViewTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\DarView'), 0, $e);
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
        $pos = DarViewTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getDcrId();

            case 1:
                return $this->getAgendacontroltype();

            case 2:
                return $this->getEmployeeCode();

            case 3:
                return $this->getFirstName();

            case 4:
                return $this->getOutletName();

            case 5:
                return $this->getOutletId();

            case 6:
                return $this->getOutletCode();

            case 7:
                return $this->getAgendname();

            case 8:
                return $this->getPositionId();

            case 9:
                return $this->getPositionName();

            case 10:
                return $this->getStownname();

            case 11:
                return $this->getDcrDate();

            case 12:
                return $this->getDcrStatus();

            case 13:
                return $this->getCreatedAt();

            case 14:
                return $this->getUpdatedAt();

            case 15:
                return $this->getPlanned();

            case 16:
                return $this->getUnitName();

            case 17:
                return $this->getDateTime();

            case 18:
                return $this->getManagers();

            case 19:
                return $this->getBrandsDetailed();

            case 20:
                return $this->getSgpiOut();

            case 21:
                return $this->getPobTotal();

            case 22:
                return $this->getEmployeeId();

            case 23:
                return $this->getEdDuration();

            case 24:
                return $this->getTerritoryId();

            case 25:
                return $this->getOutlettypeId();

            case 26:
                return $this->getOutlettypeName();

            case 27:
                return $this->getBeatId();

            case 28:
                return $this->getBeatName();

            case 29:
                return $this->getTags();

            case 30:
                return $this->getIsjw();

            case 31:
                return $this->getBrandCampaignName();

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
        if (isset($alreadyDumpedObjects['DarView'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['DarView'][$this->hashCode()] = true;
        $keys = DarViewTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getDcrId(),
            $keys[1] => $this->getAgendacontroltype(),
            $keys[2] => $this->getEmployeeCode(),
            $keys[3] => $this->getFirstName(),
            $keys[4] => $this->getOutletName(),
            $keys[5] => $this->getOutletId(),
            $keys[6] => $this->getOutletCode(),
            $keys[7] => $this->getAgendname(),
            $keys[8] => $this->getPositionId(),
            $keys[9] => $this->getPositionName(),
            $keys[10] => $this->getStownname(),
            $keys[11] => $this->getDcrDate(),
            $keys[12] => $this->getDcrStatus(),
            $keys[13] => $this->getCreatedAt(),
            $keys[14] => $this->getUpdatedAt(),
            $keys[15] => $this->getPlanned(),
            $keys[16] => $this->getUnitName(),
            $keys[17] => $this->getDateTime(),
            $keys[18] => $this->getManagers(),
            $keys[19] => $this->getBrandsDetailed(),
            $keys[20] => $this->getSgpiOut(),
            $keys[21] => $this->getPobTotal(),
            $keys[22] => $this->getEmployeeId(),
            $keys[23] => $this->getEdDuration(),
            $keys[24] => $this->getTerritoryId(),
            $keys[25] => $this->getOutlettypeId(),
            $keys[26] => $this->getOutlettypeName(),
            $keys[27] => $this->getBeatId(),
            $keys[28] => $this->getBeatName(),
            $keys[29] => $this->getTags(),
            $keys[30] => $this->getIsjw(),
            $keys[31] => $this->getBrandCampaignName(),
        ];
        if ($result[$keys[13]] instanceof \DateTimeInterface) {
            $result[$keys[13]] = $result[$keys[13]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[14]] instanceof \DateTimeInterface) {
            $result[$keys[14]] = $result[$keys[14]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[17]] instanceof \DateTimeInterface) {
            $result[$keys[17]] = $result[$keys[17]]->format('Y-m-d H:i:s.u');
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
        $criteria = new Criteria(DarViewTableMap::DATABASE_NAME);

        if ($this->isColumnModified(DarViewTableMap::COL_DCR_ID)) {
            $criteria->add(DarViewTableMap::COL_DCR_ID, $this->dcr_id);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_AGENDACONTROLTYPE)) {
            $criteria->add(DarViewTableMap::COL_AGENDACONTROLTYPE, $this->agendacontroltype);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_EMPLOYEE_CODE)) {
            $criteria->add(DarViewTableMap::COL_EMPLOYEE_CODE, $this->employee_code);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_FIRST_NAME)) {
            $criteria->add(DarViewTableMap::COL_FIRST_NAME, $this->first_name);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_OUTLET_NAME)) {
            $criteria->add(DarViewTableMap::COL_OUTLET_NAME, $this->outlet_name);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_OUTLET_ID)) {
            $criteria->add(DarViewTableMap::COL_OUTLET_ID, $this->outlet_id);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_OUTLET_CODE)) {
            $criteria->add(DarViewTableMap::COL_OUTLET_CODE, $this->outlet_code);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_AGENDNAME)) {
            $criteria->add(DarViewTableMap::COL_AGENDNAME, $this->agendname);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_POSITION_ID)) {
            $criteria->add(DarViewTableMap::COL_POSITION_ID, $this->position_id);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_POSITION_NAME)) {
            $criteria->add(DarViewTableMap::COL_POSITION_NAME, $this->position_name);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_STOWNNAME)) {
            $criteria->add(DarViewTableMap::COL_STOWNNAME, $this->stownname);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_DCR_DATE)) {
            $criteria->add(DarViewTableMap::COL_DCR_DATE, $this->dcr_date);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_DCR_STATUS)) {
            $criteria->add(DarViewTableMap::COL_DCR_STATUS, $this->dcr_status);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_CREATED_AT)) {
            $criteria->add(DarViewTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_UPDATED_AT)) {
            $criteria->add(DarViewTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_PLANNED)) {
            $criteria->add(DarViewTableMap::COL_PLANNED, $this->planned);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_UNIT_NAME)) {
            $criteria->add(DarViewTableMap::COL_UNIT_NAME, $this->unit_name);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_DATETIME)) {
            $criteria->add(DarViewTableMap::COL_DATETIME, $this->datetime);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_MANAGERS)) {
            $criteria->add(DarViewTableMap::COL_MANAGERS, $this->managers);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_BRANDS_DETAILED)) {
            $criteria->add(DarViewTableMap::COL_BRANDS_DETAILED, $this->brands_detailed);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_SGPI_OUT)) {
            $criteria->add(DarViewTableMap::COL_SGPI_OUT, $this->sgpi_out);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_POB_TOTAL)) {
            $criteria->add(DarViewTableMap::COL_POB_TOTAL, $this->pob_total);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_EMPLOYEE_ID)) {
            $criteria->add(DarViewTableMap::COL_EMPLOYEE_ID, $this->employee_id);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_ED_DURATION)) {
            $criteria->add(DarViewTableMap::COL_ED_DURATION, $this->ed_duration);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_TERRITORY_ID)) {
            $criteria->add(DarViewTableMap::COL_TERRITORY_ID, $this->territory_id);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_OUTLETTYPE_ID)) {
            $criteria->add(DarViewTableMap::COL_OUTLETTYPE_ID, $this->outlettype_id);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_OUTLETTYPE_NAME)) {
            $criteria->add(DarViewTableMap::COL_OUTLETTYPE_NAME, $this->outlettype_name);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_BEAT_ID)) {
            $criteria->add(DarViewTableMap::COL_BEAT_ID, $this->beat_id);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_BEAT_NAME)) {
            $criteria->add(DarViewTableMap::COL_BEAT_NAME, $this->beat_name);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_TAGS)) {
            $criteria->add(DarViewTableMap::COL_TAGS, $this->tags);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_ISJW)) {
            $criteria->add(DarViewTableMap::COL_ISJW, $this->isjw);
        }
        if ($this->isColumnModified(DarViewTableMap::COL_BRAND_CAMPAIGN_NAME)) {
            $criteria->add(DarViewTableMap::COL_BRAND_CAMPAIGN_NAME, $this->brand_campaign_name);
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
        $criteria = ChildDarViewQuery::create();
        $criteria->add(DarViewTableMap::COL_DCR_ID, $this->dcr_id);

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
        $validPk = null !== $this->getDcrId();

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
        return $this->getDcrId();
    }

    /**
     * Generic method to set the primary key (dcr_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setDcrId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getDcrId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\DarView (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setDcrId($this->getDcrId());
        $copyObj->setAgendacontroltype($this->getAgendacontroltype());
        $copyObj->setEmployeeCode($this->getEmployeeCode());
        $copyObj->setFirstName($this->getFirstName());
        $copyObj->setOutletName($this->getOutletName());
        $copyObj->setOutletId($this->getOutletId());
        $copyObj->setOutletCode($this->getOutletCode());
        $copyObj->setAgendname($this->getAgendname());
        $copyObj->setPositionId($this->getPositionId());
        $copyObj->setPositionName($this->getPositionName());
        $copyObj->setStownname($this->getStownname());
        $copyObj->setDcrDate($this->getDcrDate());
        $copyObj->setDcrStatus($this->getDcrStatus());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setPlanned($this->getPlanned());
        $copyObj->setUnitName($this->getUnitName());
        $copyObj->setDateTime($this->getDateTime());
        $copyObj->setManagers($this->getManagers());
        $copyObj->setBrandsDetailed($this->getBrandsDetailed());
        $copyObj->setSgpiOut($this->getSgpiOut());
        $copyObj->setPobTotal($this->getPobTotal());
        $copyObj->setEmployeeId($this->getEmployeeId());
        $copyObj->setEdDuration($this->getEdDuration());
        $copyObj->setTerritoryId($this->getTerritoryId());
        $copyObj->setOutlettypeId($this->getOutlettypeId());
        $copyObj->setOutlettypeName($this->getOutlettypeName());
        $copyObj->setBeatId($this->getBeatId());
        $copyObj->setBeatName($this->getBeatName());
        $copyObj->setTags($this->getTags());
        $copyObj->setIsjw($this->getIsjw());
        $copyObj->setBrandCampaignName($this->getBrandCampaignName());
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
     * @return \entities\DarView Clone of current object.
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
        $this->dcr_id = null;
        $this->agendacontroltype = null;
        $this->employee_code = null;
        $this->first_name = null;
        $this->outlet_name = null;
        $this->outlet_id = null;
        $this->outlet_code = null;
        $this->agendname = null;
        $this->position_id = null;
        $this->position_name = null;
        $this->stownname = null;
        $this->dcr_date = null;
        $this->dcr_status = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->planned = null;
        $this->unit_name = null;
        $this->datetime = null;
        $this->managers = null;
        $this->brands_detailed = null;
        $this->sgpi_out = null;
        $this->pob_total = null;
        $this->employee_id = null;
        $this->ed_duration = null;
        $this->territory_id = null;
        $this->outlettype_id = null;
        $this->outlettype_name = null;
        $this->beat_id = null;
        $this->beat_name = null;
        $this->tags = null;
        $this->isjw = null;
        $this->brand_campaign_name = null;
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
        return (string) $this->exportTo(DarViewTableMap::DEFAULT_STRING_FORMAT);
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
