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
use entities\Agendatypes as ChildAgendatypes;
use entities\AgendatypesQuery as ChildAgendatypesQuery;
use entities\Beats as ChildBeats;
use entities\BeatsQuery as ChildBeatsQuery;
use entities\BrandCampiagnVisitPlan as ChildBrandCampiagnVisitPlan;
use entities\BrandCampiagnVisitPlanQuery as ChildBrandCampiagnVisitPlanQuery;
use entities\DayplanQuery as ChildDayplanQuery;
use entities\GeoTowns as ChildGeoTowns;
use entities\GeoTownsQuery as ChildGeoTownsQuery;
use entities\OutletOrgData as ChildOutletOrgData;
use entities\OutletOrgDataQuery as ChildOutletOrgDataQuery;
use entities\Map\DayplanTableMap;

/**
 * Base class that represents a row from the 'dayplan' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class Dayplan implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\DayplanTableMap';


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
     * The value for the dayplan_id field.
     *
     * @var        int
     */
    protected $dayplan_id;

    /**
     * The value for the tp_date field.
     *
     * @var        DateTime|null
     */
    protected $tp_date;

    /**
     * The value for the tp_id field.
     *
     * @var        int|null
     */
    protected $tp_id;

    /**
     * The value for the company_id field.
     *
     * @var        int|null
     */
    protected $company_id;

    /**
     * The value for the position_id field.
     *
     * @var        int|null
     */
    protected $position_id;

    /**
     * The value for the agendacontroltype field.
     *
     * @var        string|null
     */
    protected $agendacontroltype;

    /**
     * The value for the beat_id field.
     *
     * @var        int|null
     */
    protected $beat_id;

    /**
     * The value for the itownid field.
     *
     * @var        string|null
     */
    protected $itownid;

    /**
     * The value for the agenda_id field.
     *
     * @var        int|null
     */
    protected $agenda_id;

    /**
     * The value for the isjw field.
     *
     * @var        boolean
     */
    protected $isjw;

    /**
     * The value for the outlet_org_data_id field.
     *
     * @var        int|null
     */
    protected $outlet_org_data_id;

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
     * The value for the mtp_day_id field.
     *
     * @var        int|null
     */
    protected $mtp_day_id;

    /**
     * The value for the status field.
     *
     * @var        string|null
     */
    protected $status;

    /**
     * The value for the is_planned field.
     *
     * @var        boolean|null
     */
    protected $is_planned;

    /**
     * The value for the start_time field.
     *
     * @var        string|null
     */
    protected $start_time;

    /**
     * The value for the end_time field.
     *
     * @var        string|null
     */
    protected $end_time;

    /**
     * The value for the remark field.
     *
     * @var        string|null
     */
    protected $remark;

    /**
     * The value for the isfixed field.
     *
     * @var        int|null
     */
    protected $isfixed;

    /**
     * The value for the reason field.
     *
     * @var        string|null
     */
    protected $reason;

    /**
     * The value for the campaign_visit_plan_id field.
     *
     * @var        string|null
     */
    protected $campaign_visit_plan_id;

    /**
     * @var        ChildOutletOrgData
     */
    protected $aOutletOrgData;

    /**
     * @var        ChildBeats
     */
    protected $aBeats;

    /**
     * @var        ChildAgendatypes
     */
    protected $aAgendatypes;

    /**
     * @var        ChildGeoTowns
     */
    protected $aGeoTowns;

    /**
     * @var        ChildBrandCampiagnVisitPlan
     */
    protected $aBrandCampiagnVisitPlan;

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
     * Initializes internal state of entities\Base\Dayplan object.
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
     * Compares this with another <code>Dayplan</code> instance.  If
     * <code>obj</code> is an instance of <code>Dayplan</code>, delegates to
     * <code>equals(Dayplan)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [dayplan_id] column value.
     *
     * @return int
     */
    public function getDayplanId()
    {
        return $this->dayplan_id;
    }

    /**
     * Get the [optionally formatted] temporal [tp_date] column value.
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
    public function getTpDate($format = null)
    {
        if ($format === null) {
            return $this->tp_date;
        } else {
            return $this->tp_date instanceof \DateTimeInterface ? $this->tp_date->format($format) : null;
        }
    }

    /**
     * Get the [tp_id] column value.
     *
     * @return int|null
     */
    public function getTpId()
    {
        return $this->tp_id;
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
     * Get the [position_id] column value.
     *
     * @return int|null
     */
    public function getPositionId()
    {
        return $this->position_id;
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
     * Get the [beat_id] column value.
     *
     * @return int|null
     */
    public function getBeatId()
    {
        return $this->beat_id;
    }

    /**
     * Get the [itownid] column value.
     *
     * @return string|null
     */
    public function getItownid()
    {
        return $this->itownid;
    }

    /**
     * Get the [agenda_id] column value.
     *
     * @return int|null
     */
    public function getAgendaId()
    {
        return $this->agenda_id;
    }

    /**
     * Get the [isjw] column value.
     *
     * @return boolean
     */
    public function getIsjw()
    {
        return $this->isjw;
    }

    /**
     * Get the [isjw] column value.
     *
     * @return boolean
     */
    public function isIsjw()
    {
        return $this->getIsjw();
    }

    /**
     * Get the [outlet_org_data_id] column value.
     *
     * @return int|null
     */
    public function getOutletOrgDataId()
    {
        return $this->outlet_org_data_id;
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
     * Get the [mtp_day_id] column value.
     *
     * @return int|null
     */
    public function getMtpDayId()
    {
        return $this->mtp_day_id;
    }

    /**
     * Get the [status] column value.
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [is_planned] column value.
     *
     * @return boolean|null
     */
    public function getIsPlanned()
    {
        return $this->is_planned;
    }

    /**
     * Get the [is_planned] column value.
     *
     * @return boolean|null
     */
    public function isPlanned()
    {
        return $this->getIsPlanned();
    }

    /**
     * Get the [start_time] column value.
     *
     * @return string|null
     */
    public function getStartTime()
    {
        return $this->start_time;
    }

    /**
     * Get the [end_time] column value.
     *
     * @return string|null
     */
    public function getEndTime()
    {
        return $this->end_time;
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
     * Get the [isfixed] column value.
     *
     * @return int|null
     */
    public function getIsfixed()
    {
        return $this->isfixed;
    }

    /**
     * Get the [reason] column value.
     *
     * @return string|null
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Get the [campaign_visit_plan_id] column value.
     *
     * @return string|null
     */
    public function getCampaignVisitPlanId()
    {
        return $this->campaign_visit_plan_id;
    }

    /**
     * Set the value of [dayplan_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDayplanId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->dayplan_id !== $v) {
            $this->dayplan_id = $v;
            $this->modifiedColumns[DayplanTableMap::COL_DAYPLAN_ID] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [tp_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setTpDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->tp_date !== null || $dt !== null) {
            if ($this->tp_date === null || $dt === null || $dt->format("Y-m-d") !== $this->tp_date->format("Y-m-d")) {
                $this->tp_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DayplanTableMap::COL_TP_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [tp_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTpId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->tp_id !== $v) {
            $this->tp_id = $v;
            $this->modifiedColumns[DayplanTableMap::COL_TP_ID] = true;
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
            $this->modifiedColumns[DayplanTableMap::COL_COMPANY_ID] = true;
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
            $this->modifiedColumns[DayplanTableMap::COL_POSITION_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [agendacontroltype] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAgendacontroltype($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->agendacontroltype !== $v) {
            $this->agendacontroltype = $v;
            $this->modifiedColumns[DayplanTableMap::COL_AGENDACONTROLTYPE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [beat_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBeatId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->beat_id !== $v) {
            $this->beat_id = $v;
            $this->modifiedColumns[DayplanTableMap::COL_BEAT_ID] = true;
        }

        if ($this->aBeats !== null && $this->aBeats->getBeatId() !== $v) {
            $this->aBeats = null;
        }

        return $this;
    }

    /**
     * Set the value of [itownid] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setItownid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->itownid !== $v) {
            $this->itownid = $v;
            $this->modifiedColumns[DayplanTableMap::COL_ITOWNID] = true;
        }

        if ($this->aGeoTowns !== null && $this->aGeoTowns->getItownid() !== $v) {
            $this->aGeoTowns = null;
        }

        return $this;
    }

    /**
     * Set the value of [agenda_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAgendaId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->agenda_id !== $v) {
            $this->agenda_id = $v;
            $this->modifiedColumns[DayplanTableMap::COL_AGENDA_ID] = true;
        }

        if ($this->aAgendatypes !== null && $this->aAgendatypes->getAgendaid() !== $v) {
            $this->aAgendatypes = null;
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
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsjw($v)
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
            $this->modifiedColumns[DayplanTableMap::COL_ISJW] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_org_data_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletOrgDataId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->outlet_org_data_id !== $v) {
            $this->outlet_org_data_id = $v;
            $this->modifiedColumns[DayplanTableMap::COL_OUTLET_ORG_DATA_ID] = true;
        }

        if ($this->aOutletOrgData !== null && $this->aOutletOrgData->getOutletOrgId() !== $v) {
            $this->aOutletOrgData = null;
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
                $this->modifiedColumns[DayplanTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[DayplanTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [mtp_day_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMtpDayId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->mtp_day_id !== $v) {
            $this->mtp_day_id = $v;
            $this->modifiedColumns[DayplanTableMap::COL_MTP_DAY_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [status] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[DayplanTableMap::COL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_planned] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsPlanned($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_planned !== $v) {
            $this->is_planned = $v;
            $this->modifiedColumns[DayplanTableMap::COL_IS_PLANNED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [start_time] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStartTime($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->start_time !== $v) {
            $this->start_time = $v;
            $this->modifiedColumns[DayplanTableMap::COL_START_TIME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [end_time] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEndTime($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->end_time !== $v) {
            $this->end_time = $v;
            $this->modifiedColumns[DayplanTableMap::COL_END_TIME] = true;
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
            $this->modifiedColumns[DayplanTableMap::COL_REMARK] = true;
        }

        return $this;
    }

    /**
     * Set the value of [isfixed] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIsfixed($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->isfixed !== $v) {
            $this->isfixed = $v;
            $this->modifiedColumns[DayplanTableMap::COL_ISFIXED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [reason] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setReason($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->reason !== $v) {
            $this->reason = $v;
            $this->modifiedColumns[DayplanTableMap::COL_REASON] = true;
        }

        return $this;
    }

    /**
     * Set the value of [campaign_visit_plan_id] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCampaignVisitPlanId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->campaign_visit_plan_id !== $v) {
            $this->campaign_visit_plan_id = $v;
            $this->modifiedColumns[DayplanTableMap::COL_CAMPAIGN_VISIT_PLAN_ID] = true;
        }

        if ($this->aBrandCampiagnVisitPlan !== null && $this->aBrandCampiagnVisitPlan->getBrandCampiagnVisitPlanId() !== $v) {
            $this->aBrandCampiagnVisitPlan = null;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : DayplanTableMap::translateFieldName('DayplanId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dayplan_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : DayplanTableMap::translateFieldName('TpDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tp_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : DayplanTableMap::translateFieldName('TpId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tp_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : DayplanTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : DayplanTableMap::translateFieldName('PositionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : DayplanTableMap::translateFieldName('Agendacontroltype', TableMap::TYPE_PHPNAME, $indexType)];
            $this->agendacontroltype = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : DayplanTableMap::translateFieldName('BeatId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->beat_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : DayplanTableMap::translateFieldName('Itownid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->itownid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : DayplanTableMap::translateFieldName('AgendaId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->agenda_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : DayplanTableMap::translateFieldName('Isjw', TableMap::TYPE_PHPNAME, $indexType)];
            $this->isjw = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : DayplanTableMap::translateFieldName('OutletOrgDataId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_org_data_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : DayplanTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : DayplanTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : DayplanTableMap::translateFieldName('MtpDayId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mtp_day_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : DayplanTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : DayplanTableMap::translateFieldName('IsPlanned', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_planned = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : DayplanTableMap::translateFieldName('StartTime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->start_time = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : DayplanTableMap::translateFieldName('EndTime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->end_time = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : DayplanTableMap::translateFieldName('Remark', TableMap::TYPE_PHPNAME, $indexType)];
            $this->remark = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : DayplanTableMap::translateFieldName('Isfixed', TableMap::TYPE_PHPNAME, $indexType)];
            $this->isfixed = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : DayplanTableMap::translateFieldName('Reason', TableMap::TYPE_PHPNAME, $indexType)];
            $this->reason = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : DayplanTableMap::translateFieldName('CampaignVisitPlanId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->campaign_visit_plan_id = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 22; // 22 = DayplanTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\Dayplan'), 0, $e);
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
        if ($this->aBeats !== null && $this->beat_id !== $this->aBeats->getBeatId()) {
            $this->aBeats = null;
        }
        if ($this->aGeoTowns !== null && $this->itownid !== $this->aGeoTowns->getItownid()) {
            $this->aGeoTowns = null;
        }
        if ($this->aAgendatypes !== null && $this->agenda_id !== $this->aAgendatypes->getAgendaid()) {
            $this->aAgendatypes = null;
        }
        if ($this->aOutletOrgData !== null && $this->outlet_org_data_id !== $this->aOutletOrgData->getOutletOrgId()) {
            $this->aOutletOrgData = null;
        }
        if ($this->aBrandCampiagnVisitPlan !== null && $this->campaign_visit_plan_id !== $this->aBrandCampiagnVisitPlan->getBrandCampiagnVisitPlanId()) {
            $this->aBrandCampiagnVisitPlan = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(DayplanTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildDayplanQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aOutletOrgData = null;
            $this->aBeats = null;
            $this->aAgendatypes = null;
            $this->aGeoTowns = null;
            $this->aBrandCampiagnVisitPlan = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Dayplan::setDeleted()
     * @see Dayplan::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(DayplanTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildDayplanQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(DayplanTableMap::DATABASE_NAME);
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
                DayplanTableMap::addInstanceToPool($this);
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

            if ($this->aOutletOrgData !== null) {
                if ($this->aOutletOrgData->isModified() || $this->aOutletOrgData->isNew()) {
                    $affectedRows += $this->aOutletOrgData->save($con);
                }
                $this->setOutletOrgData($this->aOutletOrgData);
            }

            if ($this->aBeats !== null) {
                if ($this->aBeats->isModified() || $this->aBeats->isNew()) {
                    $affectedRows += $this->aBeats->save($con);
                }
                $this->setBeats($this->aBeats);
            }

            if ($this->aAgendatypes !== null) {
                if ($this->aAgendatypes->isModified() || $this->aAgendatypes->isNew()) {
                    $affectedRows += $this->aAgendatypes->save($con);
                }
                $this->setAgendatypes($this->aAgendatypes);
            }

            if ($this->aGeoTowns !== null) {
                if ($this->aGeoTowns->isModified() || $this->aGeoTowns->isNew()) {
                    $affectedRows += $this->aGeoTowns->save($con);
                }
                $this->setGeoTowns($this->aGeoTowns);
            }

            if ($this->aBrandCampiagnVisitPlan !== null) {
                if ($this->aBrandCampiagnVisitPlan->isModified() || $this->aBrandCampiagnVisitPlan->isNew()) {
                    $affectedRows += $this->aBrandCampiagnVisitPlan->save($con);
                }
                $this->setBrandCampiagnVisitPlan($this->aBrandCampiagnVisitPlan);
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

        $this->modifiedColumns[DayplanTableMap::COL_DAYPLAN_ID] = true;
        if (null !== $this->dayplan_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . DayplanTableMap::COL_DAYPLAN_ID . ')');
        }
        if (null === $this->dayplan_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('dayplan_dayplan_id_seq')");
                $this->dayplan_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(DayplanTableMap::COL_DAYPLAN_ID)) {
            $modifiedColumns[':p' . $index++]  = 'dayplan_id';
        }
        if ($this->isColumnModified(DayplanTableMap::COL_TP_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'tp_date';
        }
        if ($this->isColumnModified(DayplanTableMap::COL_TP_ID)) {
            $modifiedColumns[':p' . $index++]  = 'tp_id';
        }
        if ($this->isColumnModified(DayplanTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(DayplanTableMap::COL_POSITION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'position_id';
        }
        if ($this->isColumnModified(DayplanTableMap::COL_AGENDACONTROLTYPE)) {
            $modifiedColumns[':p' . $index++]  = 'agendacontroltype';
        }
        if ($this->isColumnModified(DayplanTableMap::COL_BEAT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'beat_id';
        }
        if ($this->isColumnModified(DayplanTableMap::COL_ITOWNID)) {
            $modifiedColumns[':p' . $index++]  = 'itownid';
        }
        if ($this->isColumnModified(DayplanTableMap::COL_AGENDA_ID)) {
            $modifiedColumns[':p' . $index++]  = 'agenda_id';
        }
        if ($this->isColumnModified(DayplanTableMap::COL_ISJW)) {
            $modifiedColumns[':p' . $index++]  = 'isjw';
        }
        if ($this->isColumnModified(DayplanTableMap::COL_OUTLET_ORG_DATA_ID)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_org_data_id';
        }
        if ($this->isColumnModified(DayplanTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(DayplanTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(DayplanTableMap::COL_MTP_DAY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'mtp_day_id';
        }
        if ($this->isColumnModified(DayplanTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(DayplanTableMap::COL_IS_PLANNED)) {
            $modifiedColumns[':p' . $index++]  = 'is_planned';
        }
        if ($this->isColumnModified(DayplanTableMap::COL_START_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'start_time';
        }
        if ($this->isColumnModified(DayplanTableMap::COL_END_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'end_time';
        }
        if ($this->isColumnModified(DayplanTableMap::COL_REMARK)) {
            $modifiedColumns[':p' . $index++]  = 'remark';
        }
        if ($this->isColumnModified(DayplanTableMap::COL_ISFIXED)) {
            $modifiedColumns[':p' . $index++]  = 'isfixed';
        }
        if ($this->isColumnModified(DayplanTableMap::COL_REASON)) {
            $modifiedColumns[':p' . $index++]  = 'reason';
        }
        if ($this->isColumnModified(DayplanTableMap::COL_CAMPAIGN_VISIT_PLAN_ID)) {
            $modifiedColumns[':p' . $index++]  = 'campaign_visit_plan_id';
        }

        $sql = sprintf(
            'INSERT INTO dayplan (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'dayplan_id':
                        $stmt->bindValue($identifier, $this->dayplan_id, PDO::PARAM_INT);

                        break;
                    case 'tp_date':
                        $stmt->bindValue($identifier, $this->tp_date ? $this->tp_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'tp_id':
                        $stmt->bindValue($identifier, $this->tp_id, PDO::PARAM_INT);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'position_id':
                        $stmt->bindValue($identifier, $this->position_id, PDO::PARAM_INT);

                        break;
                    case 'agendacontroltype':
                        $stmt->bindValue($identifier, $this->agendacontroltype, PDO::PARAM_STR);

                        break;
                    case 'beat_id':
                        $stmt->bindValue($identifier, $this->beat_id, PDO::PARAM_INT);

                        break;
                    case 'itownid':
                        $stmt->bindValue($identifier, $this->itownid, PDO::PARAM_INT);

                        break;
                    case 'agenda_id':
                        $stmt->bindValue($identifier, $this->agenda_id, PDO::PARAM_INT);

                        break;
                    case 'isjw':
                        $stmt->bindValue($identifier, $this->isjw, PDO::PARAM_BOOL);

                        break;
                    case 'outlet_org_data_id':
                        $stmt->bindValue($identifier, $this->outlet_org_data_id, PDO::PARAM_INT);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'mtp_day_id':
                        $stmt->bindValue($identifier, $this->mtp_day_id, PDO::PARAM_INT);

                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);

                        break;
                    case 'is_planned':
                        $stmt->bindValue($identifier, $this->is_planned, PDO::PARAM_BOOL);

                        break;
                    case 'start_time':
                        $stmt->bindValue($identifier, $this->start_time, PDO::PARAM_STR);

                        break;
                    case 'end_time':
                        $stmt->bindValue($identifier, $this->end_time, PDO::PARAM_STR);

                        break;
                    case 'remark':
                        $stmt->bindValue($identifier, $this->remark, PDO::PARAM_STR);

                        break;
                    case 'isfixed':
                        $stmt->bindValue($identifier, $this->isfixed, PDO::PARAM_INT);

                        break;
                    case 'reason':
                        $stmt->bindValue($identifier, $this->reason, PDO::PARAM_STR);

                        break;
                    case 'campaign_visit_plan_id':
                        $stmt->bindValue($identifier, $this->campaign_visit_plan_id, PDO::PARAM_STR);

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
        $pos = DayplanTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getDayplanId();

            case 1:
                return $this->getTpDate();

            case 2:
                return $this->getTpId();

            case 3:
                return $this->getCompanyId();

            case 4:
                return $this->getPositionId();

            case 5:
                return $this->getAgendacontroltype();

            case 6:
                return $this->getBeatId();

            case 7:
                return $this->getItownid();

            case 8:
                return $this->getAgendaId();

            case 9:
                return $this->getIsjw();

            case 10:
                return $this->getOutletOrgDataId();

            case 11:
                return $this->getCreatedAt();

            case 12:
                return $this->getUpdatedAt();

            case 13:
                return $this->getMtpDayId();

            case 14:
                return $this->getStatus();

            case 15:
                return $this->getIsPlanned();

            case 16:
                return $this->getStartTime();

            case 17:
                return $this->getEndTime();

            case 18:
                return $this->getRemark();

            case 19:
                return $this->getIsfixed();

            case 20:
                return $this->getReason();

            case 21:
                return $this->getCampaignVisitPlanId();

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
        if (isset($alreadyDumpedObjects['Dayplan'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Dayplan'][$this->hashCode()] = true;
        $keys = DayplanTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getDayplanId(),
            $keys[1] => $this->getTpDate(),
            $keys[2] => $this->getTpId(),
            $keys[3] => $this->getCompanyId(),
            $keys[4] => $this->getPositionId(),
            $keys[5] => $this->getAgendacontroltype(),
            $keys[6] => $this->getBeatId(),
            $keys[7] => $this->getItownid(),
            $keys[8] => $this->getAgendaId(),
            $keys[9] => $this->getIsjw(),
            $keys[10] => $this->getOutletOrgDataId(),
            $keys[11] => $this->getCreatedAt(),
            $keys[12] => $this->getUpdatedAt(),
            $keys[13] => $this->getMtpDayId(),
            $keys[14] => $this->getStatus(),
            $keys[15] => $this->getIsPlanned(),
            $keys[16] => $this->getStartTime(),
            $keys[17] => $this->getEndTime(),
            $keys[18] => $this->getRemark(),
            $keys[19] => $this->getIsfixed(),
            $keys[20] => $this->getReason(),
            $keys[21] => $this->getCampaignVisitPlanId(),
        ];
        if ($result[$keys[1]] instanceof \DateTimeInterface) {
            $result[$keys[1]] = $result[$keys[1]]->format('Y-m-d');
        }

        if ($result[$keys[11]] instanceof \DateTimeInterface) {
            $result[$keys[11]] = $result[$keys[11]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[12]] instanceof \DateTimeInterface) {
            $result[$keys[12]] = $result[$keys[12]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
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
            if (null !== $this->aBeats) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'beats';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'beats';
                        break;
                    default:
                        $key = 'Beats';
                }

                $result[$key] = $this->aBeats->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aAgendatypes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'agendatypes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'agendatypes';
                        break;
                    default:
                        $key = 'Agendatypes';
                }

                $result[$key] = $this->aAgendatypes->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aGeoTowns) {

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

                $result[$key] = $this->aGeoTowns->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aBrandCampiagnVisitPlan) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'brandCampiagnVisitPlan';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'brand_campiagn_visit_plan';
                        break;
                    default:
                        $key = 'BrandCampiagnVisitPlan';
                }

                $result[$key] = $this->aBrandCampiagnVisitPlan->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = DayplanTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setDayplanId($value);
                break;
            case 1:
                $this->setTpDate($value);
                break;
            case 2:
                $this->setTpId($value);
                break;
            case 3:
                $this->setCompanyId($value);
                break;
            case 4:
                $this->setPositionId($value);
                break;
            case 5:
                $this->setAgendacontroltype($value);
                break;
            case 6:
                $this->setBeatId($value);
                break;
            case 7:
                $this->setItownid($value);
                break;
            case 8:
                $this->setAgendaId($value);
                break;
            case 9:
                $this->setIsjw($value);
                break;
            case 10:
                $this->setOutletOrgDataId($value);
                break;
            case 11:
                $this->setCreatedAt($value);
                break;
            case 12:
                $this->setUpdatedAt($value);
                break;
            case 13:
                $this->setMtpDayId($value);
                break;
            case 14:
                $this->setStatus($value);
                break;
            case 15:
                $this->setIsPlanned($value);
                break;
            case 16:
                $this->setStartTime($value);
                break;
            case 17:
                $this->setEndTime($value);
                break;
            case 18:
                $this->setRemark($value);
                break;
            case 19:
                $this->setIsfixed($value);
                break;
            case 20:
                $this->setReason($value);
                break;
            case 21:
                $this->setCampaignVisitPlanId($value);
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
        $keys = DayplanTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setDayplanId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setTpDate($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setTpId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setCompanyId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPositionId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setAgendacontroltype($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setBeatId($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setItownid($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setAgendaId($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setIsjw($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setOutletOrgDataId($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setCreatedAt($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setUpdatedAt($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setMtpDayId($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setStatus($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setIsPlanned($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setStartTime($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setEndTime($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setRemark($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setIsfixed($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setReason($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setCampaignVisitPlanId($arr[$keys[21]]);
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
        $criteria = new Criteria(DayplanTableMap::DATABASE_NAME);

        if ($this->isColumnModified(DayplanTableMap::COL_DAYPLAN_ID)) {
            $criteria->add(DayplanTableMap::COL_DAYPLAN_ID, $this->dayplan_id);
        }
        if ($this->isColumnModified(DayplanTableMap::COL_TP_DATE)) {
            $criteria->add(DayplanTableMap::COL_TP_DATE, $this->tp_date);
        }
        if ($this->isColumnModified(DayplanTableMap::COL_TP_ID)) {
            $criteria->add(DayplanTableMap::COL_TP_ID, $this->tp_id);
        }
        if ($this->isColumnModified(DayplanTableMap::COL_COMPANY_ID)) {
            $criteria->add(DayplanTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(DayplanTableMap::COL_POSITION_ID)) {
            $criteria->add(DayplanTableMap::COL_POSITION_ID, $this->position_id);
        }
        if ($this->isColumnModified(DayplanTableMap::COL_AGENDACONTROLTYPE)) {
            $criteria->add(DayplanTableMap::COL_AGENDACONTROLTYPE, $this->agendacontroltype);
        }
        if ($this->isColumnModified(DayplanTableMap::COL_BEAT_ID)) {
            $criteria->add(DayplanTableMap::COL_BEAT_ID, $this->beat_id);
        }
        if ($this->isColumnModified(DayplanTableMap::COL_ITOWNID)) {
            $criteria->add(DayplanTableMap::COL_ITOWNID, $this->itownid);
        }
        if ($this->isColumnModified(DayplanTableMap::COL_AGENDA_ID)) {
            $criteria->add(DayplanTableMap::COL_AGENDA_ID, $this->agenda_id);
        }
        if ($this->isColumnModified(DayplanTableMap::COL_ISJW)) {
            $criteria->add(DayplanTableMap::COL_ISJW, $this->isjw);
        }
        if ($this->isColumnModified(DayplanTableMap::COL_OUTLET_ORG_DATA_ID)) {
            $criteria->add(DayplanTableMap::COL_OUTLET_ORG_DATA_ID, $this->outlet_org_data_id);
        }
        if ($this->isColumnModified(DayplanTableMap::COL_CREATED_AT)) {
            $criteria->add(DayplanTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(DayplanTableMap::COL_UPDATED_AT)) {
            $criteria->add(DayplanTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(DayplanTableMap::COL_MTP_DAY_ID)) {
            $criteria->add(DayplanTableMap::COL_MTP_DAY_ID, $this->mtp_day_id);
        }
        if ($this->isColumnModified(DayplanTableMap::COL_STATUS)) {
            $criteria->add(DayplanTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(DayplanTableMap::COL_IS_PLANNED)) {
            $criteria->add(DayplanTableMap::COL_IS_PLANNED, $this->is_planned);
        }
        if ($this->isColumnModified(DayplanTableMap::COL_START_TIME)) {
            $criteria->add(DayplanTableMap::COL_START_TIME, $this->start_time);
        }
        if ($this->isColumnModified(DayplanTableMap::COL_END_TIME)) {
            $criteria->add(DayplanTableMap::COL_END_TIME, $this->end_time);
        }
        if ($this->isColumnModified(DayplanTableMap::COL_REMARK)) {
            $criteria->add(DayplanTableMap::COL_REMARK, $this->remark);
        }
        if ($this->isColumnModified(DayplanTableMap::COL_ISFIXED)) {
            $criteria->add(DayplanTableMap::COL_ISFIXED, $this->isfixed);
        }
        if ($this->isColumnModified(DayplanTableMap::COL_REASON)) {
            $criteria->add(DayplanTableMap::COL_REASON, $this->reason);
        }
        if ($this->isColumnModified(DayplanTableMap::COL_CAMPAIGN_VISIT_PLAN_ID)) {
            $criteria->add(DayplanTableMap::COL_CAMPAIGN_VISIT_PLAN_ID, $this->campaign_visit_plan_id);
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
        $criteria = ChildDayplanQuery::create();
        $criteria->add(DayplanTableMap::COL_DAYPLAN_ID, $this->dayplan_id);

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
        $validPk = null !== $this->getDayplanId();

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
        return $this->getDayplanId();
    }

    /**
     * Generic method to set the primary key (dayplan_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setDayplanId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getDayplanId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\Dayplan (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setTpDate($this->getTpDate());
        $copyObj->setTpId($this->getTpId());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setPositionId($this->getPositionId());
        $copyObj->setAgendacontroltype($this->getAgendacontroltype());
        $copyObj->setBeatId($this->getBeatId());
        $copyObj->setItownid($this->getItownid());
        $copyObj->setAgendaId($this->getAgendaId());
        $copyObj->setIsjw($this->getIsjw());
        $copyObj->setOutletOrgDataId($this->getOutletOrgDataId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setMtpDayId($this->getMtpDayId());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setIsPlanned($this->getIsPlanned());
        $copyObj->setStartTime($this->getStartTime());
        $copyObj->setEndTime($this->getEndTime());
        $copyObj->setRemark($this->getRemark());
        $copyObj->setIsfixed($this->getIsfixed());
        $copyObj->setReason($this->getReason());
        $copyObj->setCampaignVisitPlanId($this->getCampaignVisitPlanId());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setDayplanId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\Dayplan Clone of current object.
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
     * Declares an association between this object and a ChildOutletOrgData object.
     *
     * @param ChildOutletOrgData|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setOutletOrgData(ChildOutletOrgData $v = null)
    {
        if ($v === null) {
            $this->setOutletOrgDataId(NULL);
        } else {
            $this->setOutletOrgDataId($v->getOutletOrgId());
        }

        $this->aOutletOrgData = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOutletOrgData object, it will not be re-added.
        if ($v !== null) {
            $v->addDayplan($this);
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
        if ($this->aOutletOrgData === null && ($this->outlet_org_data_id != 0)) {
            $this->aOutletOrgData = ChildOutletOrgDataQuery::create()->findPk($this->outlet_org_data_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOutletOrgData->addDayplans($this);
             */
        }

        return $this->aOutletOrgData;
    }

    /**
     * Declares an association between this object and a ChildBeats object.
     *
     * @param ChildBeats|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setBeats(ChildBeats $v = null)
    {
        if ($v === null) {
            $this->setBeatId(NULL);
        } else {
            $this->setBeatId($v->getBeatId());
        }

        $this->aBeats = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildBeats object, it will not be re-added.
        if ($v !== null) {
            $v->addDayplan($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildBeats object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildBeats|null The associated ChildBeats object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBeats(?ConnectionInterface $con = null)
    {
        if ($this->aBeats === null && ($this->beat_id != 0)) {
            $this->aBeats = ChildBeatsQuery::create()->findPk($this->beat_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBeats->addDayplans($this);
             */
        }

        return $this->aBeats;
    }

    /**
     * Declares an association between this object and a ChildAgendatypes object.
     *
     * @param ChildAgendatypes|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setAgendatypes(ChildAgendatypes $v = null)
    {
        if ($v === null) {
            $this->setAgendaId(NULL);
        } else {
            $this->setAgendaId($v->getAgendaid());
        }

        $this->aAgendatypes = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildAgendatypes object, it will not be re-added.
        if ($v !== null) {
            $v->addDayplan($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildAgendatypes object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildAgendatypes|null The associated ChildAgendatypes object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getAgendatypes(?ConnectionInterface $con = null)
    {
        if ($this->aAgendatypes === null && ($this->agenda_id != 0)) {
            $this->aAgendatypes = ChildAgendatypesQuery::create()->findPk($this->agenda_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aAgendatypes->addDayplans($this);
             */
        }

        return $this->aAgendatypes;
    }

    /**
     * Declares an association between this object and a ChildGeoTowns object.
     *
     * @param ChildGeoTowns|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setGeoTowns(ChildGeoTowns $v = null)
    {
        if ($v === null) {
            $this->setItownid(NULL);
        } else {
            $this->setItownid($v->getItownid());
        }

        $this->aGeoTowns = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildGeoTowns object, it will not be re-added.
        if ($v !== null) {
            $v->addDayplan($this);
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
    public function getGeoTowns(?ConnectionInterface $con = null)
    {
        if ($this->aGeoTowns === null && (($this->itownid !== "" && $this->itownid !== null))) {
            $this->aGeoTowns = ChildGeoTownsQuery::create()->findPk($this->itownid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aGeoTowns->addDayplans($this);
             */
        }

        return $this->aGeoTowns;
    }

    /**
     * Declares an association between this object and a ChildBrandCampiagnVisitPlan object.
     *
     * @param ChildBrandCampiagnVisitPlan|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setBrandCampiagnVisitPlan(ChildBrandCampiagnVisitPlan $v = null)
    {
        if ($v === null) {
            $this->setCampaignVisitPlanId(NULL);
        } else {
            $this->setCampaignVisitPlanId($v->getBrandCampiagnVisitPlanId());
        }

        $this->aBrandCampiagnVisitPlan = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildBrandCampiagnVisitPlan object, it will not be re-added.
        if ($v !== null) {
            $v->addDayplan($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildBrandCampiagnVisitPlan object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildBrandCampiagnVisitPlan|null The associated ChildBrandCampiagnVisitPlan object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBrandCampiagnVisitPlan(?ConnectionInterface $con = null)
    {
        if ($this->aBrandCampiagnVisitPlan === null && (($this->campaign_visit_plan_id !== "" && $this->campaign_visit_plan_id !== null))) {
            $this->aBrandCampiagnVisitPlan = ChildBrandCampiagnVisitPlanQuery::create()->findPk($this->campaign_visit_plan_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBrandCampiagnVisitPlan->addDayplans($this);
             */
        }

        return $this->aBrandCampiagnVisitPlan;
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
        if (null !== $this->aOutletOrgData) {
            $this->aOutletOrgData->removeDayplan($this);
        }
        if (null !== $this->aBeats) {
            $this->aBeats->removeDayplan($this);
        }
        if (null !== $this->aAgendatypes) {
            $this->aAgendatypes->removeDayplan($this);
        }
        if (null !== $this->aGeoTowns) {
            $this->aGeoTowns->removeDayplan($this);
        }
        if (null !== $this->aBrandCampiagnVisitPlan) {
            $this->aBrandCampiagnVisitPlan->removeDayplan($this);
        }
        $this->dayplan_id = null;
        $this->tp_date = null;
        $this->tp_id = null;
        $this->company_id = null;
        $this->position_id = null;
        $this->agendacontroltype = null;
        $this->beat_id = null;
        $this->itownid = null;
        $this->agenda_id = null;
        $this->isjw = null;
        $this->outlet_org_data_id = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->mtp_day_id = null;
        $this->status = null;
        $this->is_planned = null;
        $this->start_time = null;
        $this->end_time = null;
        $this->remark = null;
        $this->isfixed = null;
        $this->reason = null;
        $this->campaign_visit_plan_id = null;
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

        $this->aOutletOrgData = null;
        $this->aBeats = null;
        $this->aAgendatypes = null;
        $this->aGeoTowns = null;
        $this->aBrandCampiagnVisitPlan = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(DayplanTableMap::DEFAULT_STRING_FORMAT);
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
