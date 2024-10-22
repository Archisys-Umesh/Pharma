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
use entities\Brands as ChildBrands;
use entities\BrandsQuery as ChildBrandsQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\EdStatsQuery as ChildEdStatsQuery;
use entities\OrgUnit as ChildOrgUnit;
use entities\OrgUnitQuery as ChildOrgUnitQuery;
use entities\OutletOrgData as ChildOutletOrgData;
use entities\OutletOrgDataQuery as ChildOutletOrgDataQuery;
use entities\Map\EdStatsTableMap;

/**
 * Base class that represents a row from the 'ed_stats' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class EdStats implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\EdStatsTableMap';


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
     * The value for the ed_stats_id field.
     *
     * @var        int
     */
    protected $ed_stats_id;

    /**
     * The value for the outlet_org_id field.
     *
     * @var        int|null
     */
    protected $outlet_org_id;

    /**
     * The value for the brand_id field.
     *
     * @var        int|null
     */
    protected $brand_id;

    /**
     * The value for the session_id field.
     *
     * @var        string|null
     */
    protected $session_id;

    /**
     * The value for the ed_order field.
     *
     * @var        int|null
     */
    protected $ed_order;

    /**
     * The value for the device_start_time field.
     *
     * @var        DateTime|null
     */
    protected $device_start_time;

    /**
     * The value for the device_end_time field.
     *
     * @var        DateTime|null
     */
    protected $device_end_time;

    /**
     * The value for the duration field.
     *
     * @var        int|null
     */
    protected $duration;

    /**
     * The value for the company_id field.
     *
     * @var        int
     */
    protected $company_id;

    /**
     * The value for the orgunitid field.
     *
     * @var        int|null
     */
    protected $orgunitid;

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
     * The value for the employee_id field.
     *
     * @var        int|null
     */
    protected $employee_id;

    /**
     * The value for the position_id field.
     *
     * @var        int|null
     */
    protected $position_id;

    /**
     * The value for the presentation_id field.
     *
     * @var        int|null
     */
    protected $presentation_id;

    /**
     * The value for the playlist_id field.
     *
     * @var        int|null
     */
    protected $playlist_id;

    /**
     * The value for the ed_date field.
     *
     * @var        DateTime|null
     */
    protected $ed_date;

    /**
     * The value for the presentation_name field.
     *
     * @var        string|null
     */
    protected $presentation_name;

    /**
     * @var        ChildOrgUnit
     */
    protected $aOrgUnit;

    /**
     * @var        ChildOutletOrgData
     */
    protected $aOutletOrgData;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildBrands
     */
    protected $aBrands;

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
     * Initializes internal state of entities\Base\EdStats object.
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
     * Compares this with another <code>EdStats</code> instance.  If
     * <code>obj</code> is an instance of <code>EdStats</code>, delegates to
     * <code>equals(EdStats)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [ed_stats_id] column value.
     *
     * @return int
     */
    public function getEdStatsId()
    {
        return $this->ed_stats_id;
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
     * Get the [brand_id] column value.
     *
     * @return int|null
     */
    public function getBrandId()
    {
        return $this->brand_id;
    }

    /**
     * Get the [session_id] column value.
     *
     * @return string|null
     */
    public function getSessionId()
    {
        return $this->session_id;
    }

    /**
     * Get the [ed_order] column value.
     *
     * @return int|null
     */
    public function getEdOrder()
    {
        return $this->ed_order;
    }

    /**
     * Get the [optionally formatted] temporal [device_start_time] column value.
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
    public function getDeviceStartTime($format = null)
    {
        if ($format === null) {
            return $this->device_start_time;
        } else {
            return $this->device_start_time instanceof \DateTimeInterface ? $this->device_start_time->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [device_end_time] column value.
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
    public function getDeviceEndTime($format = null)
    {
        if ($format === null) {
            return $this->device_end_time;
        } else {
            return $this->device_end_time instanceof \DateTimeInterface ? $this->device_end_time->format($format) : null;
        }
    }

    /**
     * Get the [duration] column value.
     *
     * @return int|null
     */
    public function getDuration()
    {
        return $this->duration;
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
     * Get the [orgunitid] column value.
     *
     * @return int|null
     */
    public function getOrgunitid()
    {
        return $this->orgunitid;
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
     * Get the [employee_id] column value.
     *
     * @return int|null
     */
    public function getEmployeeId()
    {
        return $this->employee_id;
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
     * Get the [presentation_id] column value.
     *
     * @return int|null
     */
    public function getPresentationId()
    {
        return $this->presentation_id;
    }

    /**
     * Get the [playlist_id] column value.
     *
     * @return int|null
     */
    public function getPlaylistId()
    {
        return $this->playlist_id;
    }

    /**
     * Get the [optionally formatted] temporal [ed_date] column value.
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
    public function getEdDate($format = null)
    {
        if ($format === null) {
            return $this->ed_date;
        } else {
            return $this->ed_date instanceof \DateTimeInterface ? $this->ed_date->format($format) : null;
        }
    }

    /**
     * Get the [presentation_name] column value.
     *
     * @return string|null
     */
    public function getPresentationName()
    {
        return $this->presentation_name;
    }

    /**
     * Set the value of [ed_stats_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEdStatsId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->ed_stats_id !== $v) {
            $this->ed_stats_id = $v;
            $this->modifiedColumns[EdStatsTableMap::COL_ED_STATS_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_org_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletOrgId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_org_id !== $v) {
            $this->outlet_org_id = $v;
            $this->modifiedColumns[EdStatsTableMap::COL_OUTLET_ORG_ID] = true;
        }

        if ($this->aOutletOrgData !== null && $this->aOutletOrgData->getOutletOrgId() !== $v) {
            $this->aOutletOrgData = null;
        }

        return $this;
    }

    /**
     * Set the value of [brand_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBrandId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->brand_id !== $v) {
            $this->brand_id = $v;
            $this->modifiedColumns[EdStatsTableMap::COL_BRAND_ID] = true;
        }

        if ($this->aBrands !== null && $this->aBrands->getBrandId() !== $v) {
            $this->aBrands = null;
        }

        return $this;
    }

    /**
     * Set the value of [session_id] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSessionId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->session_id !== $v) {
            $this->session_id = $v;
            $this->modifiedColumns[EdStatsTableMap::COL_SESSION_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [ed_order] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEdOrder($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->ed_order !== $v) {
            $this->ed_order = $v;
            $this->modifiedColumns[EdStatsTableMap::COL_ED_ORDER] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [device_start_time] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setDeviceStartTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->device_start_time !== null || $dt !== null) {
            if ($this->device_start_time === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->device_start_time->format("Y-m-d H:i:s.u")) {
                $this->device_start_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[EdStatsTableMap::COL_DEVICE_START_TIME] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [device_end_time] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setDeviceEndTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->device_end_time !== null || $dt !== null) {
            if ($this->device_end_time === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->device_end_time->format("Y-m-d H:i:s.u")) {
                $this->device_end_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[EdStatsTableMap::COL_DEVICE_END_TIME] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [duration] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDuration($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->duration !== $v) {
            $this->duration = $v;
            $this->modifiedColumns[EdStatsTableMap::COL_DURATION] = true;
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
            $this->modifiedColumns[EdStatsTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [orgunitid] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrgunitid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->orgunitid !== $v) {
            $this->orgunitid = $v;
            $this->modifiedColumns[EdStatsTableMap::COL_ORGUNITID] = true;
        }

        if ($this->aOrgUnit !== null && $this->aOrgUnit->getOrgunitid() !== $v) {
            $this->aOrgUnit = null;
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
                $this->modifiedColumns[EdStatsTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[EdStatsTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

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
            $this->modifiedColumns[EdStatsTableMap::COL_EMPLOYEE_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [position_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPositionId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->position_id !== $v) {
            $this->position_id = $v;
            $this->modifiedColumns[EdStatsTableMap::COL_POSITION_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [presentation_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPresentationId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->presentation_id !== $v) {
            $this->presentation_id = $v;
            $this->modifiedColumns[EdStatsTableMap::COL_PRESENTATION_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [playlist_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPlaylistId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->playlist_id !== $v) {
            $this->playlist_id = $v;
            $this->modifiedColumns[EdStatsTableMap::COL_PLAYLIST_ID] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [ed_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setEdDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->ed_date !== null || $dt !== null) {
            if ($this->ed_date === null || $dt === null || $dt->format("Y-m-d") !== $this->ed_date->format("Y-m-d")) {
                $this->ed_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[EdStatsTableMap::COL_ED_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [presentation_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPresentationName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->presentation_name !== $v) {
            $this->presentation_name = $v;
            $this->modifiedColumns[EdStatsTableMap::COL_PRESENTATION_NAME] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : EdStatsTableMap::translateFieldName('EdStatsId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ed_stats_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : EdStatsTableMap::translateFieldName('OutletOrgId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_org_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : EdStatsTableMap::translateFieldName('BrandId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brand_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : EdStatsTableMap::translateFieldName('SessionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->session_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : EdStatsTableMap::translateFieldName('EdOrder', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ed_order = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : EdStatsTableMap::translateFieldName('DeviceStartTime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->device_start_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : EdStatsTableMap::translateFieldName('DeviceEndTime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->device_end_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : EdStatsTableMap::translateFieldName('Duration', TableMap::TYPE_PHPNAME, $indexType)];
            $this->duration = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : EdStatsTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : EdStatsTableMap::translateFieldName('Orgunitid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->orgunitid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : EdStatsTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : EdStatsTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : EdStatsTableMap::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : EdStatsTableMap::translateFieldName('PositionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : EdStatsTableMap::translateFieldName('PresentationId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->presentation_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : EdStatsTableMap::translateFieldName('PlaylistId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->playlist_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : EdStatsTableMap::translateFieldName('EdDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ed_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : EdStatsTableMap::translateFieldName('PresentationName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->presentation_name = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 18; // 18 = EdStatsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\EdStats'), 0, $e);
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
        if ($this->aOutletOrgData !== null && $this->outlet_org_id !== $this->aOutletOrgData->getOutletOrgId()) {
            $this->aOutletOrgData = null;
        }
        if ($this->aBrands !== null && $this->brand_id !== $this->aBrands->getBrandId()) {
            $this->aBrands = null;
        }
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
        }
        if ($this->aOrgUnit !== null && $this->orgunitid !== $this->aOrgUnit->getOrgunitid()) {
            $this->aOrgUnit = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(EdStatsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildEdStatsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aOrgUnit = null;
            $this->aOutletOrgData = null;
            $this->aCompany = null;
            $this->aBrands = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see EdStats::setDeleted()
     * @see EdStats::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(EdStatsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildEdStatsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(EdStatsTableMap::DATABASE_NAME);
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
                EdStatsTableMap::addInstanceToPool($this);
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

            if ($this->aOrgUnit !== null) {
                if ($this->aOrgUnit->isModified() || $this->aOrgUnit->isNew()) {
                    $affectedRows += $this->aOrgUnit->save($con);
                }
                $this->setOrgUnit($this->aOrgUnit);
            }

            if ($this->aOutletOrgData !== null) {
                if ($this->aOutletOrgData->isModified() || $this->aOutletOrgData->isNew()) {
                    $affectedRows += $this->aOutletOrgData->save($con);
                }
                $this->setOutletOrgData($this->aOutletOrgData);
            }

            if ($this->aCompany !== null) {
                if ($this->aCompany->isModified() || $this->aCompany->isNew()) {
                    $affectedRows += $this->aCompany->save($con);
                }
                $this->setCompany($this->aCompany);
            }

            if ($this->aBrands !== null) {
                if ($this->aBrands->isModified() || $this->aBrands->isNew()) {
                    $affectedRows += $this->aBrands->save($con);
                }
                $this->setBrands($this->aBrands);
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

        $this->modifiedColumns[EdStatsTableMap::COL_ED_STATS_ID] = true;
        if (null !== $this->ed_stats_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . EdStatsTableMap::COL_ED_STATS_ID . ')');
        }
        if (null === $this->ed_stats_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('ed_stats_ed_stats_id_seq')");
                $this->ed_stats_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(EdStatsTableMap::COL_ED_STATS_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ed_stats_id';
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_OUTLET_ORG_ID)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_org_id';
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_BRAND_ID)) {
            $modifiedColumns[':p' . $index++]  = 'brand_id';
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_SESSION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'session_id';
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_ED_ORDER)) {
            $modifiedColumns[':p' . $index++]  = 'ed_order';
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_DEVICE_START_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'device_start_time';
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_DEVICE_END_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'device_end_time';
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_DURATION)) {
            $modifiedColumns[':p' . $index++]  = 'duration';
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_ORGUNITID)) {
            $modifiedColumns[':p' . $index++]  = 'orgunitid';
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_EMPLOYEE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'employee_id';
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_POSITION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'position_id';
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_PRESENTATION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'presentation_id';
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_PLAYLIST_ID)) {
            $modifiedColumns[':p' . $index++]  = 'playlist_id';
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_ED_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'ed_date';
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_PRESENTATION_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'presentation_name';
        }

        $sql = sprintf(
            'INSERT INTO ed_stats (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'ed_stats_id':
                        $stmt->bindValue($identifier, $this->ed_stats_id, PDO::PARAM_INT);

                        break;
                    case 'outlet_org_id':
                        $stmt->bindValue($identifier, $this->outlet_org_id, PDO::PARAM_INT);

                        break;
                    case 'brand_id':
                        $stmt->bindValue($identifier, $this->brand_id, PDO::PARAM_INT);

                        break;
                    case 'session_id':
                        $stmt->bindValue($identifier, $this->session_id, PDO::PARAM_STR);

                        break;
                    case 'ed_order':
                        $stmt->bindValue($identifier, $this->ed_order, PDO::PARAM_INT);

                        break;
                    case 'device_start_time':
                        $stmt->bindValue($identifier, $this->device_start_time ? $this->device_start_time->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'device_end_time':
                        $stmt->bindValue($identifier, $this->device_end_time ? $this->device_end_time->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'duration':
                        $stmt->bindValue($identifier, $this->duration, PDO::PARAM_INT);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'orgunitid':
                        $stmt->bindValue($identifier, $this->orgunitid, PDO::PARAM_INT);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'employee_id':
                        $stmt->bindValue($identifier, $this->employee_id, PDO::PARAM_INT);

                        break;
                    case 'position_id':
                        $stmt->bindValue($identifier, $this->position_id, PDO::PARAM_INT);

                        break;
                    case 'presentation_id':
                        $stmt->bindValue($identifier, $this->presentation_id, PDO::PARAM_INT);

                        break;
                    case 'playlist_id':
                        $stmt->bindValue($identifier, $this->playlist_id, PDO::PARAM_INT);

                        break;
                    case 'ed_date':
                        $stmt->bindValue($identifier, $this->ed_date ? $this->ed_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'presentation_name':
                        $stmt->bindValue($identifier, $this->presentation_name, PDO::PARAM_STR);

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
        $pos = EdStatsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getEdStatsId();

            case 1:
                return $this->getOutletOrgId();

            case 2:
                return $this->getBrandId();

            case 3:
                return $this->getSessionId();

            case 4:
                return $this->getEdOrder();

            case 5:
                return $this->getDeviceStartTime();

            case 6:
                return $this->getDeviceEndTime();

            case 7:
                return $this->getDuration();

            case 8:
                return $this->getCompanyId();

            case 9:
                return $this->getOrgunitid();

            case 10:
                return $this->getCreatedAt();

            case 11:
                return $this->getUpdatedAt();

            case 12:
                return $this->getEmployeeId();

            case 13:
                return $this->getPositionId();

            case 14:
                return $this->getPresentationId();

            case 15:
                return $this->getPlaylistId();

            case 16:
                return $this->getEdDate();

            case 17:
                return $this->getPresentationName();

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
        if (isset($alreadyDumpedObjects['EdStats'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['EdStats'][$this->hashCode()] = true;
        $keys = EdStatsTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getEdStatsId(),
            $keys[1] => $this->getOutletOrgId(),
            $keys[2] => $this->getBrandId(),
            $keys[3] => $this->getSessionId(),
            $keys[4] => $this->getEdOrder(),
            $keys[5] => $this->getDeviceStartTime(),
            $keys[6] => $this->getDeviceEndTime(),
            $keys[7] => $this->getDuration(),
            $keys[8] => $this->getCompanyId(),
            $keys[9] => $this->getOrgunitid(),
            $keys[10] => $this->getCreatedAt(),
            $keys[11] => $this->getUpdatedAt(),
            $keys[12] => $this->getEmployeeId(),
            $keys[13] => $this->getPositionId(),
            $keys[14] => $this->getPresentationId(),
            $keys[15] => $this->getPlaylistId(),
            $keys[16] => $this->getEdDate(),
            $keys[17] => $this->getPresentationName(),
        ];
        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[10]] instanceof \DateTimeInterface) {
            $result[$keys[10]] = $result[$keys[10]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[11]] instanceof \DateTimeInterface) {
            $result[$keys[11]] = $result[$keys[11]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[16]] instanceof \DateTimeInterface) {
            $result[$keys[16]] = $result[$keys[16]]->format('Y-m-d');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aOrgUnit) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orgUnit';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'org_unit';
                        break;
                    default:
                        $key = 'OrgUnit';
                }

                $result[$key] = $this->aOrgUnit->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aOutletOrgData) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'outletOrgData';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'outlet_org_data';
                        break;
                    default:
                        $key = 'OutletOrgData';
                }

                $result[$key] = $this->aOutletOrgData->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->aBrands) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'brands';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'brands';
                        break;
                    default:
                        $key = 'Brands';
                }

                $result[$key] = $this->aBrands->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = EdStatsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setEdStatsId($value);
                break;
            case 1:
                $this->setOutletOrgId($value);
                break;
            case 2:
                $this->setBrandId($value);
                break;
            case 3:
                $this->setSessionId($value);
                break;
            case 4:
                $this->setEdOrder($value);
                break;
            case 5:
                $this->setDeviceStartTime($value);
                break;
            case 6:
                $this->setDeviceEndTime($value);
                break;
            case 7:
                $this->setDuration($value);
                break;
            case 8:
                $this->setCompanyId($value);
                break;
            case 9:
                $this->setOrgunitid($value);
                break;
            case 10:
                $this->setCreatedAt($value);
                break;
            case 11:
                $this->setUpdatedAt($value);
                break;
            case 12:
                $this->setEmployeeId($value);
                break;
            case 13:
                $this->setPositionId($value);
                break;
            case 14:
                $this->setPresentationId($value);
                break;
            case 15:
                $this->setPlaylistId($value);
                break;
            case 16:
                $this->setEdDate($value);
                break;
            case 17:
                $this->setPresentationName($value);
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
        $keys = EdStatsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setEdStatsId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setOutletOrgId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setBrandId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setSessionId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setEdOrder($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setDeviceStartTime($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setDeviceEndTime($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setDuration($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCompanyId($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setOrgunitid($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setCreatedAt($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setUpdatedAt($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setEmployeeId($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setPositionId($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setPresentationId($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setPlaylistId($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setEdDate($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setPresentationName($arr[$keys[17]]);
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
        $criteria = new Criteria(EdStatsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(EdStatsTableMap::COL_ED_STATS_ID)) {
            $criteria->add(EdStatsTableMap::COL_ED_STATS_ID, $this->ed_stats_id);
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_OUTLET_ORG_ID)) {
            $criteria->add(EdStatsTableMap::COL_OUTLET_ORG_ID, $this->outlet_org_id);
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_BRAND_ID)) {
            $criteria->add(EdStatsTableMap::COL_BRAND_ID, $this->brand_id);
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_SESSION_ID)) {
            $criteria->add(EdStatsTableMap::COL_SESSION_ID, $this->session_id);
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_ED_ORDER)) {
            $criteria->add(EdStatsTableMap::COL_ED_ORDER, $this->ed_order);
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_DEVICE_START_TIME)) {
            $criteria->add(EdStatsTableMap::COL_DEVICE_START_TIME, $this->device_start_time);
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_DEVICE_END_TIME)) {
            $criteria->add(EdStatsTableMap::COL_DEVICE_END_TIME, $this->device_end_time);
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_DURATION)) {
            $criteria->add(EdStatsTableMap::COL_DURATION, $this->duration);
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_COMPANY_ID)) {
            $criteria->add(EdStatsTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_ORGUNITID)) {
            $criteria->add(EdStatsTableMap::COL_ORGUNITID, $this->orgunitid);
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_CREATED_AT)) {
            $criteria->add(EdStatsTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_UPDATED_AT)) {
            $criteria->add(EdStatsTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_EMPLOYEE_ID)) {
            $criteria->add(EdStatsTableMap::COL_EMPLOYEE_ID, $this->employee_id);
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_POSITION_ID)) {
            $criteria->add(EdStatsTableMap::COL_POSITION_ID, $this->position_id);
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_PRESENTATION_ID)) {
            $criteria->add(EdStatsTableMap::COL_PRESENTATION_ID, $this->presentation_id);
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_PLAYLIST_ID)) {
            $criteria->add(EdStatsTableMap::COL_PLAYLIST_ID, $this->playlist_id);
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_ED_DATE)) {
            $criteria->add(EdStatsTableMap::COL_ED_DATE, $this->ed_date);
        }
        if ($this->isColumnModified(EdStatsTableMap::COL_PRESENTATION_NAME)) {
            $criteria->add(EdStatsTableMap::COL_PRESENTATION_NAME, $this->presentation_name);
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
        $criteria = ChildEdStatsQuery::create();
        $criteria->add(EdStatsTableMap::COL_ED_STATS_ID, $this->ed_stats_id);

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
        $validPk = null !== $this->getEdStatsId();

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
        return $this->getEdStatsId();
    }

    /**
     * Generic method to set the primary key (ed_stats_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setEdStatsId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getEdStatsId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\EdStats (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setOutletOrgId($this->getOutletOrgId());
        $copyObj->setBrandId($this->getBrandId());
        $copyObj->setSessionId($this->getSessionId());
        $copyObj->setEdOrder($this->getEdOrder());
        $copyObj->setDeviceStartTime($this->getDeviceStartTime());
        $copyObj->setDeviceEndTime($this->getDeviceEndTime());
        $copyObj->setDuration($this->getDuration());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setOrgunitid($this->getOrgunitid());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setEmployeeId($this->getEmployeeId());
        $copyObj->setPositionId($this->getPositionId());
        $copyObj->setPresentationId($this->getPresentationId());
        $copyObj->setPlaylistId($this->getPlaylistId());
        $copyObj->setEdDate($this->getEdDate());
        $copyObj->setPresentationName($this->getPresentationName());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setEdStatsId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\EdStats Clone of current object.
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
     * Declares an association between this object and a ChildOrgUnit object.
     *
     * @param ChildOrgUnit|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOrgUnit(ChildOrgUnit $v = null)
    {
        if ($v === null) {
            $this->setOrgunitid(NULL);
        } else {
            $this->setOrgunitid($v->getOrgunitid());
        }

        $this->aOrgUnit = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOrgUnit object, it will not be re-added.
        if ($v !== null) {
            $v->addEdStats($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOrgUnit object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOrgUnit|null The associated ChildOrgUnit object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOrgUnit(?ConnectionInterface $con = null)
    {
        if ($this->aOrgUnit === null && ($this->orgunitid != 0)) {
            $this->aOrgUnit = ChildOrgUnitQuery::create()->findPk($this->orgunitid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOrgUnit->addEdStatss($this);
             */
        }

        return $this->aOrgUnit;
    }

    /**
     * Declares an association between this object and a ChildOutletOrgData object.
     *
     * @param ChildOutletOrgData|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOutletOrgData(ChildOutletOrgData $v = null)
    {
        if ($v === null) {
            $this->setOutletOrgId(NULL);
        } else {
            $this->setOutletOrgId($v->getOutletOrgId());
        }

        $this->aOutletOrgData = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOutletOrgData object, it will not be re-added.
        if ($v !== null) {
            $v->addEdStats($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOutletOrgData object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildOutletOrgData|null The associated ChildOutletOrgData object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getOutletOrgData(?ConnectionInterface $con = null)
    {
        if ($this->aOutletOrgData === null && ($this->outlet_org_id != 0)) {
            $this->aOutletOrgData = ChildOutletOrgDataQuery::create()->findPk($this->outlet_org_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOutletOrgData->addEdStatss($this);
             */
        }

        return $this->aOutletOrgData;
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
            $v->addEdStats($this);
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
                $this->aCompany->addEdStatss($this);
             */
        }

        return $this->aCompany;
    }

    /**
     * Declares an association between this object and a ChildBrands object.
     *
     * @param ChildBrands|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setBrands(ChildBrands $v = null)
    {
        if ($v === null) {
            $this->setBrandId(NULL);
        } else {
            $this->setBrandId($v->getBrandId());
        }

        $this->aBrands = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildBrands object, it will not be re-added.
        if ($v !== null) {
            $v->addEdStats($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildBrands object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildBrands|null The associated ChildBrands object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBrands(?ConnectionInterface $con = null)
    {
        if ($this->aBrands === null && ($this->brand_id != 0)) {
            $this->aBrands = ChildBrandsQuery::create()->findPk($this->brand_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBrands->addEdStatss($this);
             */
        }

        return $this->aBrands;
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
        if (null !== $this->aOrgUnit) {
            $this->aOrgUnit->removeEdStats($this);
        }
        if (null !== $this->aOutletOrgData) {
            $this->aOutletOrgData->removeEdStats($this);
        }
        if (null !== $this->aCompany) {
            $this->aCompany->removeEdStats($this);
        }
        if (null !== $this->aBrands) {
            $this->aBrands->removeEdStats($this);
        }
        $this->ed_stats_id = null;
        $this->outlet_org_id = null;
        $this->brand_id = null;
        $this->session_id = null;
        $this->ed_order = null;
        $this->device_start_time = null;
        $this->device_end_time = null;
        $this->duration = null;
        $this->company_id = null;
        $this->orgunitid = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->employee_id = null;
        $this->position_id = null;
        $this->presentation_id = null;
        $this->playlist_id = null;
        $this->ed_date = null;
        $this->presentation_name = null;
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

        $this->aOrgUnit = null;
        $this->aOutletOrgData = null;
        $this->aCompany = null;
        $this->aBrands = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(EdStatsTableMap::DEFAULT_STRING_FORMAT);
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
