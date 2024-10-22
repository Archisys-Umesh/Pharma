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
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\GeoTowns as ChildGeoTowns;
use entities\GeoTownsQuery as ChildGeoTownsQuery;
use entities\Mtp as ChildMtp;
use entities\MtpDay as ChildMtpDay;
use entities\MtpDayQuery as ChildMtpDayQuery;
use entities\MtpQuery as ChildMtpQuery;
use entities\OutletOrgData as ChildOutletOrgData;
use entities\OutletOrgDataQuery as ChildOutletOrgDataQuery;
use entities\Positions as ChildPositions;
use entities\PositionsQuery as ChildPositionsQuery;
use entities\TourplansQuery as ChildTourplansQuery;
use entities\Map\TourplansTableMap;

/**
 * Base class that represents a row from the 'tourplans' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class Tourplans implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\TourplansTableMap';


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
     * The value for the tp_id field.
     *
     * @var        int
     */
    protected $tp_id;

    /**
     * The value for the tp_date field.
     *
     * @var        DateTime|null
     */
    protected $tp_date;

    /**
     * The value for the company_id field.
     *
     * @var        int|null
     */
    protected $company_id;

    /**
     * The value for the tp_remark field.
     *
     * @var        string|null
     */
    protected $tp_remark;

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
     * The value for the weekday field.
     *
     * @var        int|null
     */
    protected $weekday;

    /**
     * The value for the weeknumber field.
     *
     * @var        int|null
     */
    protected $weeknumber;

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
     * @var        string|null
     */
    protected $outlet_org_data_id;

    /**
     * The value for the mtp_id field.
     *
     * @var        int
     */
    protected $mtp_id;

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
     * The value for the campaign_visit_plan_id field.
     *
     * @var        int|null
     */
    protected $campaign_visit_plan_id;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildAgendatypes
     */
    protected $aAgendatypes;

    /**
     * @var        ChildBeats
     */
    protected $aBeats;

    /**
     * @var        ChildMtpDay
     */
    protected $aMtpDay;

    /**
     * @var        ChildGeoTowns
     */
    protected $aGeoTowns;

    /**
     * @var        ChildMtp
     */
    protected $aMtp;

    /**
     * @var        ChildOutletOrgData
     */
    protected $aOutletOrgData;

    /**
     * @var        ChildPositions
     */
    protected $aPositions;

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
     * Initializes internal state of entities\Base\Tourplans object.
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
     * Compares this with another <code>Tourplans</code> instance.  If
     * <code>obj</code> is an instance of <code>Tourplans</code>, delegates to
     * <code>equals(Tourplans)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [tp_id] column value.
     *
     * @return int
     */
    public function getTpId()
    {
        return $this->tp_id;
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
     * Get the [company_id] column value.
     *
     * @return int|null
     */
    public function getCompanyId()
    {
        return $this->company_id;
    }

    /**
     * Get the [tp_remark] column value.
     *
     * @return string|null
     */
    public function getTpRemark()
    {
        return $this->tp_remark;
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
     * Get the [weekday] column value.
     *
     * @return int|null
     */
    public function getWeekday()
    {
        return $this->weekday;
    }

    /**
     * Get the [weeknumber] column value.
     *
     * @return int|null
     */
    public function getWeeknumber()
    {
        return $this->weeknumber;
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
     * @return string|null
     */
    public function getOutletOrgDataId()
    {
        return $this->outlet_org_data_id;
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
     * Get the [campaign_visit_plan_id] column value.
     *
     * @return int|null
     */
    public function getCampaignVisitPlanId()
    {
        return $this->campaign_visit_plan_id;
    }

    /**
     * Set the value of [tp_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTpId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->tp_id !== $v) {
            $this->tp_id = $v;
            $this->modifiedColumns[TourplansTableMap::COL_TP_ID] = true;
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
                $this->modifiedColumns[TourplansTableMap::COL_TP_DATE] = true;
            }
        } // if either are not null

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
            $this->modifiedColumns[TourplansTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [tp_remark] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTpRemark($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tp_remark !== $v) {
            $this->tp_remark = $v;
            $this->modifiedColumns[TourplansTableMap::COL_TP_REMARK] = true;
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
            $this->modifiedColumns[TourplansTableMap::COL_POSITION_ID] = true;
        }

        if ($this->aPositions !== null && $this->aPositions->getPositionId() !== $v) {
            $this->aPositions = null;
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
            $this->modifiedColumns[TourplansTableMap::COL_AGENDACONTROLTYPE] = true;
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
            $this->modifiedColumns[TourplansTableMap::COL_BEAT_ID] = true;
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
            $this->modifiedColumns[TourplansTableMap::COL_ITOWNID] = true;
        }

        if ($this->aGeoTowns !== null && $this->aGeoTowns->getItownid() !== $v) {
            $this->aGeoTowns = null;
        }

        return $this;
    }

    /**
     * Set the value of [weekday] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWeekday($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->weekday !== $v) {
            $this->weekday = $v;
            $this->modifiedColumns[TourplansTableMap::COL_WEEKDAY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [weeknumber] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setWeeknumber($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->weeknumber !== $v) {
            $this->weeknumber = $v;
            $this->modifiedColumns[TourplansTableMap::COL_WEEKNUMBER] = true;
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
            $this->modifiedColumns[TourplansTableMap::COL_AGENDA_ID] = true;
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
            $this->modifiedColumns[TourplansTableMap::COL_ISJW] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_org_data_id] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletOrgDataId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_org_data_id !== $v) {
            $this->outlet_org_data_id = $v;
            $this->modifiedColumns[TourplansTableMap::COL_OUTLET_ORG_DATA_ID] = true;
        }

        if ($this->aOutletOrgData !== null && $this->aOutletOrgData->getOutletOrgId() !== $v) {
            $this->aOutletOrgData = null;
        }

        return $this;
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
            $this->modifiedColumns[TourplansTableMap::COL_MTP_ID] = true;
        }

        if ($this->aMtp !== null && $this->aMtp->getMtpId() !== $v) {
            $this->aMtp = null;
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
                $this->modifiedColumns[TourplansTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[TourplansTableMap::COL_UPDATED_AT] = true;
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
            $this->modifiedColumns[TourplansTableMap::COL_MTP_DAY_ID] = true;
        }

        if ($this->aMtpDay !== null && $this->aMtpDay->getMtpDayId() !== $v) {
            $this->aMtpDay = null;
        }

        return $this;
    }

    /**
     * Set the value of [campaign_visit_plan_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCampaignVisitPlanId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->campaign_visit_plan_id !== $v) {
            $this->campaign_visit_plan_id = $v;
            $this->modifiedColumns[TourplansTableMap::COL_CAMPAIGN_VISIT_PLAN_ID] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : TourplansTableMap::translateFieldName('TpId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tp_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : TourplansTableMap::translateFieldName('TpDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tp_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : TourplansTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : TourplansTableMap::translateFieldName('TpRemark', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tp_remark = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : TourplansTableMap::translateFieldName('PositionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : TourplansTableMap::translateFieldName('Agendacontroltype', TableMap::TYPE_PHPNAME, $indexType)];
            $this->agendacontroltype = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : TourplansTableMap::translateFieldName('BeatId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->beat_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : TourplansTableMap::translateFieldName('Itownid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->itownid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : TourplansTableMap::translateFieldName('Weekday', TableMap::TYPE_PHPNAME, $indexType)];
            $this->weekday = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : TourplansTableMap::translateFieldName('Weeknumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->weeknumber = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : TourplansTableMap::translateFieldName('AgendaId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->agenda_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : TourplansTableMap::translateFieldName('Isjw', TableMap::TYPE_PHPNAME, $indexType)];
            $this->isjw = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : TourplansTableMap::translateFieldName('OutletOrgDataId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_org_data_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : TourplansTableMap::translateFieldName('MtpId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mtp_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : TourplansTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : TourplansTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : TourplansTableMap::translateFieldName('MtpDayId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mtp_day_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : TourplansTableMap::translateFieldName('CampaignVisitPlanId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->campaign_visit_plan_id = (null !== $col) ? (int) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 18; // 18 = TourplansTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\Tourplans'), 0, $e);
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
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
        }
        if ($this->aPositions !== null && $this->position_id !== $this->aPositions->getPositionId()) {
            $this->aPositions = null;
        }
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
        if ($this->aMtp !== null && $this->mtp_id !== $this->aMtp->getMtpId()) {
            $this->aMtp = null;
        }
        if ($this->aMtpDay !== null && $this->mtp_day_id !== $this->aMtpDay->getMtpDayId()) {
            $this->aMtpDay = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(TourplansTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildTourplansQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->aAgendatypes = null;
            $this->aBeats = null;
            $this->aMtpDay = null;
            $this->aGeoTowns = null;
            $this->aMtp = null;
            $this->aOutletOrgData = null;
            $this->aPositions = null;
            $this->aBrandCampiagnVisitPlan = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Tourplans::setDeleted()
     * @see Tourplans::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(TourplansTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildTourplansQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(TourplansTableMap::DATABASE_NAME);
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
                TourplansTableMap::addInstanceToPool($this);
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

            if ($this->aAgendatypes !== null) {
                if ($this->aAgendatypes->isModified() || $this->aAgendatypes->isNew()) {
                    $affectedRows += $this->aAgendatypes->save($con);
                }
                $this->setAgendatypes($this->aAgendatypes);
            }

            if ($this->aBeats !== null) {
                if ($this->aBeats->isModified() || $this->aBeats->isNew()) {
                    $affectedRows += $this->aBeats->save($con);
                }
                $this->setBeats($this->aBeats);
            }

            if ($this->aMtpDay !== null) {
                if ($this->aMtpDay->isModified() || $this->aMtpDay->isNew()) {
                    $affectedRows += $this->aMtpDay->save($con);
                }
                $this->setMtpDay($this->aMtpDay);
            }

            if ($this->aGeoTowns !== null) {
                if ($this->aGeoTowns->isModified() || $this->aGeoTowns->isNew()) {
                    $affectedRows += $this->aGeoTowns->save($con);
                }
                $this->setGeoTowns($this->aGeoTowns);
            }

            if ($this->aMtp !== null) {
                if ($this->aMtp->isModified() || $this->aMtp->isNew()) {
                    $affectedRows += $this->aMtp->save($con);
                }
                $this->setMtp($this->aMtp);
            }

            if ($this->aOutletOrgData !== null) {
                if ($this->aOutletOrgData->isModified() || $this->aOutletOrgData->isNew()) {
                    $affectedRows += $this->aOutletOrgData->save($con);
                }
                $this->setOutletOrgData($this->aOutletOrgData);
            }

            if ($this->aPositions !== null) {
                if ($this->aPositions->isModified() || $this->aPositions->isNew()) {
                    $affectedRows += $this->aPositions->save($con);
                }
                $this->setPositions($this->aPositions);
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

        $this->modifiedColumns[TourplansTableMap::COL_TP_ID] = true;
        if (null !== $this->tp_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . TourplansTableMap::COL_TP_ID . ')');
        }
        if (null === $this->tp_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('tourplans_tp_id_seq')");
                $this->tp_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TourplansTableMap::COL_TP_ID)) {
            $modifiedColumns[':p' . $index++]  = 'tp_id';
        }
        if ($this->isColumnModified(TourplansTableMap::COL_TP_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'tp_date';
        }
        if ($this->isColumnModified(TourplansTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(TourplansTableMap::COL_TP_REMARK)) {
            $modifiedColumns[':p' . $index++]  = 'tp_remark';
        }
        if ($this->isColumnModified(TourplansTableMap::COL_POSITION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'position_id';
        }
        if ($this->isColumnModified(TourplansTableMap::COL_AGENDACONTROLTYPE)) {
            $modifiedColumns[':p' . $index++]  = 'agendacontroltype';
        }
        if ($this->isColumnModified(TourplansTableMap::COL_BEAT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'beat_id';
        }
        if ($this->isColumnModified(TourplansTableMap::COL_ITOWNID)) {
            $modifiedColumns[':p' . $index++]  = 'itownid';
        }
        if ($this->isColumnModified(TourplansTableMap::COL_WEEKDAY)) {
            $modifiedColumns[':p' . $index++]  = 'weekday';
        }
        if ($this->isColumnModified(TourplansTableMap::COL_WEEKNUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'weeknumber';
        }
        if ($this->isColumnModified(TourplansTableMap::COL_AGENDA_ID)) {
            $modifiedColumns[':p' . $index++]  = 'agenda_id';
        }
        if ($this->isColumnModified(TourplansTableMap::COL_ISJW)) {
            $modifiedColumns[':p' . $index++]  = 'isjw';
        }
        if ($this->isColumnModified(TourplansTableMap::COL_OUTLET_ORG_DATA_ID)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_org_data_id';
        }
        if ($this->isColumnModified(TourplansTableMap::COL_MTP_ID)) {
            $modifiedColumns[':p' . $index++]  = 'mtp_id';
        }
        if ($this->isColumnModified(TourplansTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(TourplansTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(TourplansTableMap::COL_MTP_DAY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'mtp_day_id';
        }
        if ($this->isColumnModified(TourplansTableMap::COL_CAMPAIGN_VISIT_PLAN_ID)) {
            $modifiedColumns[':p' . $index++]  = 'campaign_visit_plan_id';
        }

        $sql = sprintf(
            'INSERT INTO tourplans (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'tp_id':
                        $stmt->bindValue($identifier, $this->tp_id, PDO::PARAM_INT);

                        break;
                    case 'tp_date':
                        $stmt->bindValue($identifier, $this->tp_date ? $this->tp_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'tp_remark':
                        $stmt->bindValue($identifier, $this->tp_remark, PDO::PARAM_STR);

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
                    case 'weekday':
                        $stmt->bindValue($identifier, $this->weekday, PDO::PARAM_INT);

                        break;
                    case 'weeknumber':
                        $stmt->bindValue($identifier, $this->weeknumber, PDO::PARAM_INT);

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
                    case 'mtp_id':
                        $stmt->bindValue($identifier, $this->mtp_id, PDO::PARAM_INT);

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
                    case 'campaign_visit_plan_id':
                        $stmt->bindValue($identifier, $this->campaign_visit_plan_id, PDO::PARAM_INT);

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
        $pos = TourplansTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getTpId();

            case 1:
                return $this->getTpDate();

            case 2:
                return $this->getCompanyId();

            case 3:
                return $this->getTpRemark();

            case 4:
                return $this->getPositionId();

            case 5:
                return $this->getAgendacontroltype();

            case 6:
                return $this->getBeatId();

            case 7:
                return $this->getItownid();

            case 8:
                return $this->getWeekday();

            case 9:
                return $this->getWeeknumber();

            case 10:
                return $this->getAgendaId();

            case 11:
                return $this->getIsjw();

            case 12:
                return $this->getOutletOrgDataId();

            case 13:
                return $this->getMtpId();

            case 14:
                return $this->getCreatedAt();

            case 15:
                return $this->getUpdatedAt();

            case 16:
                return $this->getMtpDayId();

            case 17:
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
        if (isset($alreadyDumpedObjects['Tourplans'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Tourplans'][$this->hashCode()] = true;
        $keys = TourplansTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getTpId(),
            $keys[1] => $this->getTpDate(),
            $keys[2] => $this->getCompanyId(),
            $keys[3] => $this->getTpRemark(),
            $keys[4] => $this->getPositionId(),
            $keys[5] => $this->getAgendacontroltype(),
            $keys[6] => $this->getBeatId(),
            $keys[7] => $this->getItownid(),
            $keys[8] => $this->getWeekday(),
            $keys[9] => $this->getWeeknumber(),
            $keys[10] => $this->getAgendaId(),
            $keys[11] => $this->getIsjw(),
            $keys[12] => $this->getOutletOrgDataId(),
            $keys[13] => $this->getMtpId(),
            $keys[14] => $this->getCreatedAt(),
            $keys[15] => $this->getUpdatedAt(),
            $keys[16] => $this->getMtpDayId(),
            $keys[17] => $this->getCampaignVisitPlanId(),
        ];
        if ($result[$keys[1]] instanceof \DateTimeInterface) {
            $result[$keys[1]] = $result[$keys[1]]->format('Y-m-d');
        }

        if ($result[$keys[14]] instanceof \DateTimeInterface) {
            $result[$keys[14]] = $result[$keys[14]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[15]] instanceof \DateTimeInterface) {
            $result[$keys[15]] = $result[$keys[15]]->format('Y-m-d H:i:s.u');
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
            if (null !== $this->aMtpDay) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'mtpDay';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'mtp_day';
                        break;
                    default:
                        $key = 'MtpDay';
                }

                $result[$key] = $this->aMtpDay->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->aMtp) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'mtp';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'mtp';
                        break;
                    default:
                        $key = 'Mtp';
                }

                $result[$key] = $this->aMtp->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = TourplansTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setTpId($value);
                break;
            case 1:
                $this->setTpDate($value);
                break;
            case 2:
                $this->setCompanyId($value);
                break;
            case 3:
                $this->setTpRemark($value);
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
                $this->setWeekday($value);
                break;
            case 9:
                $this->setWeeknumber($value);
                break;
            case 10:
                $this->setAgendaId($value);
                break;
            case 11:
                $this->setIsjw($value);
                break;
            case 12:
                $this->setOutletOrgDataId($value);
                break;
            case 13:
                $this->setMtpId($value);
                break;
            case 14:
                $this->setCreatedAt($value);
                break;
            case 15:
                $this->setUpdatedAt($value);
                break;
            case 16:
                $this->setMtpDayId($value);
                break;
            case 17:
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
        $keys = TourplansTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setTpId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setTpDate($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setCompanyId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setTpRemark($arr[$keys[3]]);
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
            $this->setWeekday($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setWeeknumber($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setAgendaId($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setIsjw($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setOutletOrgDataId($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setMtpId($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setCreatedAt($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setUpdatedAt($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setMtpDayId($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setCampaignVisitPlanId($arr[$keys[17]]);
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
        $criteria = new Criteria(TourplansTableMap::DATABASE_NAME);

        if ($this->isColumnModified(TourplansTableMap::COL_TP_ID)) {
            $criteria->add(TourplansTableMap::COL_TP_ID, $this->tp_id);
        }
        if ($this->isColumnModified(TourplansTableMap::COL_TP_DATE)) {
            $criteria->add(TourplansTableMap::COL_TP_DATE, $this->tp_date);
        }
        if ($this->isColumnModified(TourplansTableMap::COL_COMPANY_ID)) {
            $criteria->add(TourplansTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(TourplansTableMap::COL_TP_REMARK)) {
            $criteria->add(TourplansTableMap::COL_TP_REMARK, $this->tp_remark);
        }
        if ($this->isColumnModified(TourplansTableMap::COL_POSITION_ID)) {
            $criteria->add(TourplansTableMap::COL_POSITION_ID, $this->position_id);
        }
        if ($this->isColumnModified(TourplansTableMap::COL_AGENDACONTROLTYPE)) {
            $criteria->add(TourplansTableMap::COL_AGENDACONTROLTYPE, $this->agendacontroltype);
        }
        if ($this->isColumnModified(TourplansTableMap::COL_BEAT_ID)) {
            $criteria->add(TourplansTableMap::COL_BEAT_ID, $this->beat_id);
        }
        if ($this->isColumnModified(TourplansTableMap::COL_ITOWNID)) {
            $criteria->add(TourplansTableMap::COL_ITOWNID, $this->itownid);
        }
        if ($this->isColumnModified(TourplansTableMap::COL_WEEKDAY)) {
            $criteria->add(TourplansTableMap::COL_WEEKDAY, $this->weekday);
        }
        if ($this->isColumnModified(TourplansTableMap::COL_WEEKNUMBER)) {
            $criteria->add(TourplansTableMap::COL_WEEKNUMBER, $this->weeknumber);
        }
        if ($this->isColumnModified(TourplansTableMap::COL_AGENDA_ID)) {
            $criteria->add(TourplansTableMap::COL_AGENDA_ID, $this->agenda_id);
        }
        if ($this->isColumnModified(TourplansTableMap::COL_ISJW)) {
            $criteria->add(TourplansTableMap::COL_ISJW, $this->isjw);
        }
        if ($this->isColumnModified(TourplansTableMap::COL_OUTLET_ORG_DATA_ID)) {
            $criteria->add(TourplansTableMap::COL_OUTLET_ORG_DATA_ID, $this->outlet_org_data_id);
        }
        if ($this->isColumnModified(TourplansTableMap::COL_MTP_ID)) {
            $criteria->add(TourplansTableMap::COL_MTP_ID, $this->mtp_id);
        }
        if ($this->isColumnModified(TourplansTableMap::COL_CREATED_AT)) {
            $criteria->add(TourplansTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(TourplansTableMap::COL_UPDATED_AT)) {
            $criteria->add(TourplansTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(TourplansTableMap::COL_MTP_DAY_ID)) {
            $criteria->add(TourplansTableMap::COL_MTP_DAY_ID, $this->mtp_day_id);
        }
        if ($this->isColumnModified(TourplansTableMap::COL_CAMPAIGN_VISIT_PLAN_ID)) {
            $criteria->add(TourplansTableMap::COL_CAMPAIGN_VISIT_PLAN_ID, $this->campaign_visit_plan_id);
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
        $criteria = ChildTourplansQuery::create();
        $criteria->add(TourplansTableMap::COL_TP_ID, $this->tp_id);

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
        $validPk = null !== $this->getTpId();

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
        return $this->getTpId();
    }

    /**
     * Generic method to set the primary key (tp_id column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setTpId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getTpId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \entities\Tourplans (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setTpDate($this->getTpDate());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setTpRemark($this->getTpRemark());
        $copyObj->setPositionId($this->getPositionId());
        $copyObj->setAgendacontroltype($this->getAgendacontroltype());
        $copyObj->setBeatId($this->getBeatId());
        $copyObj->setItownid($this->getItownid());
        $copyObj->setWeekday($this->getWeekday());
        $copyObj->setWeeknumber($this->getWeeknumber());
        $copyObj->setAgendaId($this->getAgendaId());
        $copyObj->setIsjw($this->getIsjw());
        $copyObj->setOutletOrgDataId($this->getOutletOrgDataId());
        $copyObj->setMtpId($this->getMtpId());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setMtpDayId($this->getMtpDayId());
        $copyObj->setCampaignVisitPlanId($this->getCampaignVisitPlanId());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setTpId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\Tourplans Clone of current object.
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
     * @param ChildCompany|null $v
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
            $v->addTourplans($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCompany object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildCompany|null The associated ChildCompany object.
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
                $this->aCompany->addTourplanss($this);
             */
        }

        return $this->aCompany;
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
            $v->addTourplans($this);
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
                $this->aAgendatypes->addTourplanss($this);
             */
        }

        return $this->aAgendatypes;
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
            $v->addTourplans($this);
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
                $this->aBeats->addTourplanss($this);
             */
        }

        return $this->aBeats;
    }

    /**
     * Declares an association between this object and a ChildMtpDay object.
     *
     * @param ChildMtpDay|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setMtpDay(ChildMtpDay $v = null)
    {
        if ($v === null) {
            $this->setMtpDayId(NULL);
        } else {
            $this->setMtpDayId($v->getMtpDayId());
        }

        $this->aMtpDay = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildMtpDay object, it will not be re-added.
        if ($v !== null) {
            $v->addTourplans($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildMtpDay object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildMtpDay|null The associated ChildMtpDay object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getMtpDay(?ConnectionInterface $con = null)
    {
        if ($this->aMtpDay === null && ($this->mtp_day_id != 0)) {
            $this->aMtpDay = ChildMtpDayQuery::create()->findPk($this->mtp_day_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aMtpDay->addTourplanss($this);
             */
        }

        return $this->aMtpDay;
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
            $v->addTourplans($this);
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
                $this->aGeoTowns->addTourplanss($this);
             */
        }

        return $this->aGeoTowns;
    }

    /**
     * Declares an association between this object and a ChildMtp object.
     *
     * @param ChildMtp $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setMtp(ChildMtp $v = null)
    {
        if ($v === null) {
            $this->setMtpId(NULL);
        } else {
            $this->setMtpId($v->getMtpId());
        }

        $this->aMtp = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildMtp object, it will not be re-added.
        if ($v !== null) {
            $v->addTourplans($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildMtp object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildMtp The associated ChildMtp object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getMtp(?ConnectionInterface $con = null)
    {
        if ($this->aMtp === null && ($this->mtp_id != 0)) {
            $this->aMtp = ChildMtpQuery::create()->findPk($this->mtp_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aMtp->addTourplanss($this);
             */
        }

        return $this->aMtp;
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
            $v->addTourplans($this);
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
        if ($this->aOutletOrgData === null && (($this->outlet_org_data_id !== "" && $this->outlet_org_data_id !== null))) {
            $this->aOutletOrgData = ChildOutletOrgDataQuery::create()->findPk($this->outlet_org_data_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOutletOrgData->addTourplanss($this);
             */
        }

        return $this->aOutletOrgData;
    }

    /**
     * Declares an association between this object and a ChildPositions object.
     *
     * @param ChildPositions|null $v
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
            $v->addTourplans($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPositions object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildPositions|null The associated ChildPositions object.
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
                $this->aPositions->addTourplanss($this);
             */
        }

        return $this->aPositions;
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
            $v->addTourplans($this);
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
        if ($this->aBrandCampiagnVisitPlan === null && ($this->campaign_visit_plan_id != 0)) {
            $this->aBrandCampiagnVisitPlan = ChildBrandCampiagnVisitPlanQuery::create()->findPk($this->campaign_visit_plan_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBrandCampiagnVisitPlan->addTourplanss($this);
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
        if (null !== $this->aCompany) {
            $this->aCompany->removeTourplans($this);
        }
        if (null !== $this->aAgendatypes) {
            $this->aAgendatypes->removeTourplans($this);
        }
        if (null !== $this->aBeats) {
            $this->aBeats->removeTourplans($this);
        }
        if (null !== $this->aMtpDay) {
            $this->aMtpDay->removeTourplans($this);
        }
        if (null !== $this->aGeoTowns) {
            $this->aGeoTowns->removeTourplans($this);
        }
        if (null !== $this->aMtp) {
            $this->aMtp->removeTourplans($this);
        }
        if (null !== $this->aOutletOrgData) {
            $this->aOutletOrgData->removeTourplans($this);
        }
        if (null !== $this->aPositions) {
            $this->aPositions->removeTourplans($this);
        }
        if (null !== $this->aBrandCampiagnVisitPlan) {
            $this->aBrandCampiagnVisitPlan->removeTourplans($this);
        }
        $this->tp_id = null;
        $this->tp_date = null;
        $this->company_id = null;
        $this->tp_remark = null;
        $this->position_id = null;
        $this->agendacontroltype = null;
        $this->beat_id = null;
        $this->itownid = null;
        $this->weekday = null;
        $this->weeknumber = null;
        $this->agenda_id = null;
        $this->isjw = null;
        $this->outlet_org_data_id = null;
        $this->mtp_id = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->mtp_day_id = null;
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

        $this->aCompany = null;
        $this->aAgendatypes = null;
        $this->aBeats = null;
        $this->aMtpDay = null;
        $this->aGeoTowns = null;
        $this->aMtp = null;
        $this->aOutletOrgData = null;
        $this->aPositions = null;
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
        return (string) $this->exportTo(TourplansTableMap::DEFAULT_STRING_FORMAT);
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
