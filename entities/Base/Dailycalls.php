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
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use entities\Agendatypes as ChildAgendatypes;
use entities\AgendatypesQuery as ChildAgendatypesQuery;
use entities\BrandCampiagnVisits as ChildBrandCampiagnVisits;
use entities\BrandCampiagnVisitsQuery as ChildBrandCampiagnVisitsQuery;
use entities\Company as ChildCompany;
use entities\CompanyQuery as ChildCompanyQuery;
use entities\Dailycalls as ChildDailycalls;
use entities\DailycallsAttendees as ChildDailycallsAttendees;
use entities\DailycallsAttendeesQuery as ChildDailycallsAttendeesQuery;
use entities\DailycallsQuery as ChildDailycallsQuery;
use entities\GeoTowns as ChildGeoTowns;
use entities\GeoTownsQuery as ChildGeoTownsQuery;
use entities\OutletOrgData as ChildOutletOrgData;
use entities\OutletOrgDataQuery as ChildOutletOrgDataQuery;
use entities\Positions as ChildPositions;
use entities\PositionsQuery as ChildPositionsQuery;
use entities\SurveySubmited as ChildSurveySubmited;
use entities\SurveySubmitedQuery as ChildSurveySubmitedQuery;
use entities\Map\BrandCampiagnVisitsTableMap;
use entities\Map\DailycallsAttendeesTableMap;
use entities\Map\DailycallsTableMap;
use entities\Map\SurveySubmitedTableMap;

/**
 * Base class that represents a row from the 'dailycalls' table.
 *
 *
 *
 * @package    propel.generator.entities.Base
 */
abstract class Dailycalls implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\entities\\Map\\DailycallsTableMap';


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
     * The value for the day_plan_id field.
     *
     * @var        int|null
     */
    protected $day_plan_id;

    /**
     * The value for the outlet_org_data_id field.
     *
     * @var        int|null
     */
    protected $outlet_org_data_id;

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
     * The value for the dcr_date field.
     *
     * @var        DateTime|null
     */
    protected $dcr_date;

    /**
     * The value for the company_id field.
     *
     * @var        int|null
     */
    protected $company_id;

    /**
     * The value for the managers field.
     *
     * @var        string|null
     */
    protected $managers;

    /**
     * The value for the sgpi_out field.
     *
     * @var        string|null
     */
    protected $sgpi_out;

    /**
     * The value for the outlet_feedback field.
     *
     * @var        string|null
     */
    protected $outlet_feedback;

    /**
     * The value for the employee_feedback field.
     *
     * @var        string|null
     */
    protected $employee_feedback;

    /**
     * The value for the brands_detailed field.
     *
     * @var        string|null
     */
    protected $brands_detailed;

    /**
     * The value for the nca_comments field.
     *
     * @var        string|null
     */
    protected $nca_comments;

    /**
     * The value for the device_time field.
     *
     * @var        DateTime|null
     */
    protected $device_time;

    /**
     * The value for the isprocessed field.
     *
     * @var        boolean|null
     */
    protected $isprocessed;

    /**
     * The value for the employee_id field.
     *
     * @var        int|null
     */
    protected $employee_id;

    /**
     * The value for the device_make field.
     *
     * @var        string|null
     */
    protected $device_make;

    /**
     * The value for the ed_session_id field.
     *
     * @var        string|null
     */
    protected $ed_session_id;

    /**
     * The value for the dcr_status field.
     *
     * @var        string|null
     */
    protected $dcr_status;

    /**
     * The value for the rcpa_done field.
     *
     * @var        int|null
     */
    protected $rcpa_done;

    /**
     * The value for the has_sgpi field.
     *
     * @var        int|null
     */
    protected $has_sgpi;

    /**
     * The value for the mr_emp field.
     *
     * @var        int|null
     */
    protected $mr_emp;

    /**
     * The value for the mr_name field.
     *
     * @var        string|null
     */
    protected $mr_name;

    /**
     * The value for the mr_media_id field.
     *
     * @var        int|null
     */
    protected $mr_media_id;

    /**
     * The value for the ed_duration field.
     *
     * @var        int|null
     */
    protected $ed_duration;

    /**
     * The value for the campiagn_id field.
     *
     * @var        string|null
     */
    protected $campiagn_id;

    /**
     * The value for the visit_plan_id field.
     *
     * @var        string|null
     */
    protected $visit_plan_id;

    /**
     * The value for the nca_attendees field.
     *
     * @var        string|null
     */
    protected $nca_attendees;

    /**
     * The value for the dcr_lat_long field.
     *
     * @var        string|null
     */
    protected $dcr_lat_long;

    /**
     * The value for the dcr_address field.
     *
     * @var        string|null
     */
    protected $dcr_address;

    /**
     * @var        ChildCompany
     */
    protected $aCompany;

    /**
     * @var        ChildOutletOrgData
     */
    protected $aOutletOrgData;

    /**
     * @var        ChildAgendatypes
     */
    protected $aAgendatypes;

    /**
     * @var        ChildPositions
     */
    protected $aPositions;

    /**
     * @var        ChildGeoTowns
     */
    protected $aGeoTowns;

    /**
     * @var        ObjectCollection|ChildBrandCampiagnVisits[] Collection to store aggregation of ChildBrandCampiagnVisits objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagnVisits> Collection to store aggregation of ChildBrandCampiagnVisits objects.
     */
    protected $collBrandCampiagnVisitss;
    protected $collBrandCampiagnVisitssPartial;

    /**
     * @var        ObjectCollection|ChildDailycallsAttendees[] Collection to store aggregation of ChildDailycallsAttendees objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildDailycallsAttendees> Collection to store aggregation of ChildDailycallsAttendees objects.
     */
    protected $collDailycallsAttendeess;
    protected $collDailycallsAttendeessPartial;

    /**
     * @var        ObjectCollection|ChildSurveySubmited[] Collection to store aggregation of ChildSurveySubmited objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSurveySubmited> Collection to store aggregation of ChildSurveySubmited objects.
     */
    protected $collSurveySubmiteds;
    protected $collSurveySubmitedsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBrandCampiagnVisits[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBrandCampiagnVisits>
     */
    protected $brandCampiagnVisitssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDailycallsAttendees[]
     * @phpstan-var ObjectCollection&\Traversable<ChildDailycallsAttendees>
     */
    protected $dailycallsAttendeessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSurveySubmited[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSurveySubmited>
     */
    protected $surveySubmitedsScheduledForDeletion = null;

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
     * Initializes internal state of entities\Base\Dailycalls object.
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
     * Compares this with another <code>Dailycalls</code> instance.  If
     * <code>obj</code> is an instance of <code>Dailycalls</code>, delegates to
     * <code>equals(Dailycalls)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [day_plan_id] column value.
     *
     * @return int|null
     */
    public function getDayPlanId()
    {
        return $this->day_plan_id;
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
     * Get the [company_id] column value.
     *
     * @return int|null
     */
    public function getCompanyId()
    {
        return $this->company_id;
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
     * Get the [sgpi_out] column value.
     *
     * @return string|null
     */
    public function getSgpiOut()
    {
        return $this->sgpi_out;
    }

    /**
     * Get the [outlet_feedback] column value.
     *
     * @return string|null
     */
    public function getOutletFeedback()
    {
        return $this->outlet_feedback;
    }

    /**
     * Get the [employee_feedback] column value.
     *
     * @return string|null
     */
    public function getEmployeeFeedback()
    {
        return $this->employee_feedback;
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
     * Get the [nca_comments] column value.
     *
     * @return string|null
     */
    public function getNcaComments()
    {
        return $this->nca_comments;
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
     * Get the [isprocessed] column value.
     *
     * @return boolean|null
     */
    public function getIsprocessed()
    {
        return $this->isprocessed;
    }

    /**
     * Get the [isprocessed] column value.
     *
     * @return boolean|null
     */
    public function isIsprocessed()
    {
        return $this->getIsprocessed();
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
     * Get the [device_make] column value.
     *
     * @return string|null
     */
    public function getDeviceMake()
    {
        return $this->device_make;
    }

    /**
     * Get the [ed_session_id] column value.
     *
     * @return string|null
     */
    public function getEdSessionId()
    {
        return $this->ed_session_id;
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
     * Get the [rcpa_done] column value.
     *
     * @return int|null
     */
    public function getRcpaDone()
    {
        return $this->rcpa_done;
    }

    /**
     * Get the [has_sgpi] column value.
     *
     * @return int|null
     */
    public function getHasSgpi()
    {
        return $this->has_sgpi;
    }

    /**
     * Get the [mr_emp] column value.
     *
     * @return int|null
     */
    public function getMrEmp()
    {
        return $this->mr_emp;
    }

    /**
     * Get the [mr_name] column value.
     *
     * @return string|null
     */
    public function getMrName()
    {
        return $this->mr_name;
    }

    /**
     * Get the [mr_media_id] column value.
     *
     * @return int|null
     */
    public function getMrMediaId()
    {
        return $this->mr_media_id;
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
     * Get the [campiagn_id] column value.
     *
     * @return string|null
     */
    public function getCampiagnId()
    {
        return $this->campiagn_id;
    }

    /**
     * Get the [visit_plan_id] column value.
     *
     * @return string|null
     */
    public function getVisitPlanId()
    {
        return $this->visit_plan_id;
    }

    /**
     * Get the [nca_attendees] column value.
     *
     * @param bool $asArray Returns the JSON data as array instead of object

     * @return object|array|null
     */
    public function getNcaAttendees($asArray = true)
    {
        return json_decode($this->nca_attendees, $asArray);
    }

    /**
     * Get the [dcr_lat_long] column value.
     *
     * @return string|null
     */
    public function getDcrLatLong()
    {
        return $this->dcr_lat_long;
    }

    /**
     * Get the [dcr_address] column value.
     *
     * @return string|null
     */
    public function getDcrAddress()
    {
        return $this->dcr_address;
    }

    /**
     * Set the value of [dcr_id] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDcrId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->dcr_id !== $v) {
            $this->dcr_id = $v;
            $this->modifiedColumns[DailycallsTableMap::COL_DCR_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [day_plan_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDayPlanId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->day_plan_id !== $v) {
            $this->day_plan_id = $v;
            $this->modifiedColumns[DailycallsTableMap::COL_DAY_PLAN_ID] = true;
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
            $this->modifiedColumns[DailycallsTableMap::COL_OUTLET_ORG_DATA_ID] = true;
        }

        if ($this->aOutletOrgData !== null && $this->aOutletOrgData->getOutletOrgId() !== $v) {
            $this->aOutletOrgData = null;
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
            $this->modifiedColumns[DailycallsTableMap::COL_POSITION_ID] = true;
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
            $this->modifiedColumns[DailycallsTableMap::COL_AGENDACONTROLTYPE] = true;
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
            $this->modifiedColumns[DailycallsTableMap::COL_ITOWNID] = true;
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
            $this->modifiedColumns[DailycallsTableMap::COL_AGENDA_ID] = true;
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
            $this->modifiedColumns[DailycallsTableMap::COL_ISJW] = true;
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
                $this->modifiedColumns[DailycallsTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[DailycallsTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [dcr_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setDcrDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->dcr_date !== null || $dt !== null) {
            if ($this->dcr_date === null || $dt === null || $dt->format("Y-m-d") !== $this->dcr_date->format("Y-m-d")) {
                $this->dcr_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DailycallsTableMap::COL_DCR_DATE] = true;
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
            $this->modifiedColumns[DailycallsTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getCompanyId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    }

    /**
     * Set the value of [managers] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setManagers($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->managers !== $v) {
            $this->managers = $v;
            $this->modifiedColumns[DailycallsTableMap::COL_MANAGERS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [sgpi_out] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSgpiOut($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sgpi_out !== $v) {
            $this->sgpi_out = $v;
            $this->modifiedColumns[DailycallsTableMap::COL_SGPI_OUT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [outlet_feedback] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOutletFeedback($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->outlet_feedback !== $v) {
            $this->outlet_feedback = $v;
            $this->modifiedColumns[DailycallsTableMap::COL_OUTLET_FEEDBACK] = true;
        }

        return $this;
    }

    /**
     * Set the value of [employee_feedback] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmployeeFeedback($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->employee_feedback !== $v) {
            $this->employee_feedback = $v;
            $this->modifiedColumns[DailycallsTableMap::COL_EMPLOYEE_FEEDBACK] = true;
        }

        return $this;
    }

    /**
     * Set the value of [brands_detailed] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setBrandsDetailed($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->brands_detailed !== $v) {
            $this->brands_detailed = $v;
            $this->modifiedColumns[DailycallsTableMap::COL_BRANDS_DETAILED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [nca_comments] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setNcaComments($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nca_comments !== $v) {
            $this->nca_comments = $v;
            $this->modifiedColumns[DailycallsTableMap::COL_NCA_COMMENTS] = true;
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
    public function setDeviceTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->device_time !== null || $dt !== null) {
            if ($this->device_time === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->device_time->format("Y-m-d H:i:s.u")) {
                $this->device_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DailycallsTableMap::COL_DEVICE_TIME] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of the [isprocessed] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsprocessed($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->isprocessed !== $v) {
            $this->isprocessed = $v;
            $this->modifiedColumns[DailycallsTableMap::COL_ISPROCESSED] = true;
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
            $this->modifiedColumns[DailycallsTableMap::COL_EMPLOYEE_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [device_make] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDeviceMake($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->device_make !== $v) {
            $this->device_make = $v;
            $this->modifiedColumns[DailycallsTableMap::COL_DEVICE_MAKE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [ed_session_id] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEdSessionId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ed_session_id !== $v) {
            $this->ed_session_id = $v;
            $this->modifiedColumns[DailycallsTableMap::COL_ED_SESSION_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [dcr_status] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDcrStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dcr_status !== $v) {
            $this->dcr_status = $v;
            $this->modifiedColumns[DailycallsTableMap::COL_DCR_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rcpa_done] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRcpaDone($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->rcpa_done !== $v) {
            $this->rcpa_done = $v;
            $this->modifiedColumns[DailycallsTableMap::COL_RCPA_DONE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [has_sgpi] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setHasSgpi($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->has_sgpi !== $v) {
            $this->has_sgpi = $v;
            $this->modifiedColumns[DailycallsTableMap::COL_HAS_SGPI] = true;
        }

        return $this;
    }

    /**
     * Set the value of [mr_emp] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMrEmp($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->mr_emp !== $v) {
            $this->mr_emp = $v;
            $this->modifiedColumns[DailycallsTableMap::COL_MR_EMP] = true;
        }

        return $this;
    }

    /**
     * Set the value of [mr_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMrName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mr_name !== $v) {
            $this->mr_name = $v;
            $this->modifiedColumns[DailycallsTableMap::COL_MR_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [mr_media_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMrMediaId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->mr_media_id !== $v) {
            $this->mr_media_id = $v;
            $this->modifiedColumns[DailycallsTableMap::COL_MR_MEDIA_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [ed_duration] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEdDuration($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->ed_duration !== $v) {
            $this->ed_duration = $v;
            $this->modifiedColumns[DailycallsTableMap::COL_ED_DURATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [campiagn_id] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCampiagnId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->campiagn_id !== $v) {
            $this->campiagn_id = $v;
            $this->modifiedColumns[DailycallsTableMap::COL_CAMPIAGN_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [visit_plan_id] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setVisitPlanId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->visit_plan_id !== $v) {
            $this->visit_plan_id = $v;
            $this->modifiedColumns[DailycallsTableMap::COL_VISIT_PLAN_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [nca_attendees] column.
     *
     * @param string|array|object|null $v new value
     * @return $this The current object (for fluent API support)
     */
    public function setNcaAttendees($v)
    {
        if (is_string($v)) {
            // JSON as string needs to be decoded/encoded to get a reliable comparison (spaces, ...)
            $v = json_decode($v);
        }
        $encodedValue = json_encode($v);
        if ($encodedValue !== $this->nca_attendees) {
            $this->nca_attendees = $encodedValue;
            $this->modifiedColumns[DailycallsTableMap::COL_NCA_ATTENDEES] = true;
        }

        return $this;
    }

    /**
     * Set the value of [dcr_lat_long] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDcrLatLong($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dcr_lat_long !== $v) {
            $this->dcr_lat_long = $v;
            $this->modifiedColumns[DailycallsTableMap::COL_DCR_LAT_LONG] = true;
        }

        return $this;
    }

    /**
     * Set the value of [dcr_address] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDcrAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dcr_address !== $v) {
            $this->dcr_address = $v;
            $this->modifiedColumns[DailycallsTableMap::COL_DCR_ADDRESS] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : DailycallsTableMap::translateFieldName('DcrId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dcr_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : DailycallsTableMap::translateFieldName('DayPlanId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->day_plan_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : DailycallsTableMap::translateFieldName('OutletOrgDataId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_org_data_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : DailycallsTableMap::translateFieldName('PositionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->position_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : DailycallsTableMap::translateFieldName('Agendacontroltype', TableMap::TYPE_PHPNAME, $indexType)];
            $this->agendacontroltype = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : DailycallsTableMap::translateFieldName('Itownid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->itownid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : DailycallsTableMap::translateFieldName('AgendaId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->agenda_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : DailycallsTableMap::translateFieldName('Isjw', TableMap::TYPE_PHPNAME, $indexType)];
            $this->isjw = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : DailycallsTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : DailycallsTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : DailycallsTableMap::translateFieldName('DcrDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dcr_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : DailycallsTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : DailycallsTableMap::translateFieldName('Managers', TableMap::TYPE_PHPNAME, $indexType)];
            $this->managers = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : DailycallsTableMap::translateFieldName('SgpiOut', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sgpi_out = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : DailycallsTableMap::translateFieldName('OutletFeedback', TableMap::TYPE_PHPNAME, $indexType)];
            $this->outlet_feedback = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : DailycallsTableMap::translateFieldName('EmployeeFeedback', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_feedback = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : DailycallsTableMap::translateFieldName('BrandsDetailed', TableMap::TYPE_PHPNAME, $indexType)];
            $this->brands_detailed = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : DailycallsTableMap::translateFieldName('NcaComments', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nca_comments = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : DailycallsTableMap::translateFieldName('DeviceTime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->device_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : DailycallsTableMap::translateFieldName('Isprocessed', TableMap::TYPE_PHPNAME, $indexType)];
            $this->isprocessed = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : DailycallsTableMap::translateFieldName('EmployeeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->employee_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : DailycallsTableMap::translateFieldName('DeviceMake', TableMap::TYPE_PHPNAME, $indexType)];
            $this->device_make = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : DailycallsTableMap::translateFieldName('EdSessionId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ed_session_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : DailycallsTableMap::translateFieldName('DcrStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dcr_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : DailycallsTableMap::translateFieldName('RcpaDone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rcpa_done = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : DailycallsTableMap::translateFieldName('HasSgpi', TableMap::TYPE_PHPNAME, $indexType)];
            $this->has_sgpi = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : DailycallsTableMap::translateFieldName('MrEmp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mr_emp = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : DailycallsTableMap::translateFieldName('MrName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mr_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : DailycallsTableMap::translateFieldName('MrMediaId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mr_media_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : DailycallsTableMap::translateFieldName('EdDuration', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ed_duration = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : DailycallsTableMap::translateFieldName('CampiagnId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->campiagn_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : DailycallsTableMap::translateFieldName('VisitPlanId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->visit_plan_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 32 + $startcol : DailycallsTableMap::translateFieldName('NcaAttendees', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nca_attendees = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 33 + $startcol : DailycallsTableMap::translateFieldName('DcrLatLong', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dcr_lat_long = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 34 + $startcol : DailycallsTableMap::translateFieldName('DcrAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dcr_address = (null !== $col) ? (string) $col : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 35; // 35 = DailycallsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\entities\\Dailycalls'), 0, $e);
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
        if ($this->aOutletOrgData !== null && $this->outlet_org_data_id !== $this->aOutletOrgData->getOutletOrgId()) {
            $this->aOutletOrgData = null;
        }
        if ($this->aPositions !== null && $this->position_id !== $this->aPositions->getPositionId()) {
            $this->aPositions = null;
        }
        if ($this->aGeoTowns !== null && $this->itownid !== $this->aGeoTowns->getItownid()) {
            $this->aGeoTowns = null;
        }
        if ($this->aAgendatypes !== null && $this->agenda_id !== $this->aAgendatypes->getAgendaid()) {
            $this->aAgendatypes = null;
        }
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getCompanyId()) {
            $this->aCompany = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(DailycallsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildDailycallsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->aOutletOrgData = null;
            $this->aAgendatypes = null;
            $this->aPositions = null;
            $this->aGeoTowns = null;
            $this->collBrandCampiagnVisitss = null;

            $this->collDailycallsAttendeess = null;

            $this->collSurveySubmiteds = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Dailycalls::setDeleted()
     * @see Dailycalls::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(DailycallsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildDailycallsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(DailycallsTableMap::DATABASE_NAME);
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
                DailycallsTableMap::addInstanceToPool($this);
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

            if ($this->aOutletOrgData !== null) {
                if ($this->aOutletOrgData->isModified() || $this->aOutletOrgData->isNew()) {
                    $affectedRows += $this->aOutletOrgData->save($con);
                }
                $this->setOutletOrgData($this->aOutletOrgData);
            }

            if ($this->aAgendatypes !== null) {
                if ($this->aAgendatypes->isModified() || $this->aAgendatypes->isNew()) {
                    $affectedRows += $this->aAgendatypes->save($con);
                }
                $this->setAgendatypes($this->aAgendatypes);
            }

            if ($this->aPositions !== null) {
                if ($this->aPositions->isModified() || $this->aPositions->isNew()) {
                    $affectedRows += $this->aPositions->save($con);
                }
                $this->setPositions($this->aPositions);
            }

            if ($this->aGeoTowns !== null) {
                if ($this->aGeoTowns->isModified() || $this->aGeoTowns->isNew()) {
                    $affectedRows += $this->aGeoTowns->save($con);
                }
                $this->setGeoTowns($this->aGeoTowns);
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

            if ($this->brandCampiagnVisitssScheduledForDeletion !== null) {
                if (!$this->brandCampiagnVisitssScheduledForDeletion->isEmpty()) {
                    foreach ($this->brandCampiagnVisitssScheduledForDeletion as $brandCampiagnVisits) {
                        // need to save related object because we set the relation to null
                        $brandCampiagnVisits->save($con);
                    }
                    $this->brandCampiagnVisitssScheduledForDeletion = null;
                }
            }

            if ($this->collBrandCampiagnVisitss !== null) {
                foreach ($this->collBrandCampiagnVisitss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->dailycallsAttendeessScheduledForDeletion !== null) {
                if (!$this->dailycallsAttendeessScheduledForDeletion->isEmpty()) {
                    foreach ($this->dailycallsAttendeessScheduledForDeletion as $dailycallsAttendees) {
                        // need to save related object because we set the relation to null
                        $dailycallsAttendees->save($con);
                    }
                    $this->dailycallsAttendeessScheduledForDeletion = null;
                }
            }

            if ($this->collDailycallsAttendeess !== null) {
                foreach ($this->collDailycallsAttendeess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->surveySubmitedsScheduledForDeletion !== null) {
                if (!$this->surveySubmitedsScheduledForDeletion->isEmpty()) {
                    foreach ($this->surveySubmitedsScheduledForDeletion as $surveySubmited) {
                        // need to save related object because we set the relation to null
                        $surveySubmited->save($con);
                    }
                    $this->surveySubmitedsScheduledForDeletion = null;
                }
            }

            if ($this->collSurveySubmiteds !== null) {
                foreach ($this->collSurveySubmiteds as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

        $this->modifiedColumns[DailycallsTableMap::COL_DCR_ID] = true;
        if (null !== $this->dcr_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . DailycallsTableMap::COL_DCR_ID . ')');
        }
        if (null === $this->dcr_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('dailycalls_dcr_id_seq')");
                $this->dcr_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(DailycallsTableMap::COL_DCR_ID)) {
            $modifiedColumns[':p' . $index++]  = 'dcr_id';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_DAY_PLAN_ID)) {
            $modifiedColumns[':p' . $index++]  = 'day_plan_id';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_OUTLET_ORG_DATA_ID)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_org_data_id';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_POSITION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'position_id';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_AGENDACONTROLTYPE)) {
            $modifiedColumns[':p' . $index++]  = 'agendacontroltype';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_ITOWNID)) {
            $modifiedColumns[':p' . $index++]  = 'itownid';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_AGENDA_ID)) {
            $modifiedColumns[':p' . $index++]  = 'agenda_id';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_ISJW)) {
            $modifiedColumns[':p' . $index++]  = 'isjw';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_DCR_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'dcr_date';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_MANAGERS)) {
            $modifiedColumns[':p' . $index++]  = 'managers';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_SGPI_OUT)) {
            $modifiedColumns[':p' . $index++]  = 'sgpi_out';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_OUTLET_FEEDBACK)) {
            $modifiedColumns[':p' . $index++]  = 'outlet_feedback';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_EMPLOYEE_FEEDBACK)) {
            $modifiedColumns[':p' . $index++]  = 'employee_feedback';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_BRANDS_DETAILED)) {
            $modifiedColumns[':p' . $index++]  = 'brands_detailed';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_NCA_COMMENTS)) {
            $modifiedColumns[':p' . $index++]  = 'nca_comments';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_DEVICE_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'device_time';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_ISPROCESSED)) {
            $modifiedColumns[':p' . $index++]  = 'isprocessed';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_EMPLOYEE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'employee_id';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_DEVICE_MAKE)) {
            $modifiedColumns[':p' . $index++]  = 'device_make';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_ED_SESSION_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ed_session_id';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_DCR_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'dcr_status';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_RCPA_DONE)) {
            $modifiedColumns[':p' . $index++]  = 'rcpa_done';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_HAS_SGPI)) {
            $modifiedColumns[':p' . $index++]  = 'has_sgpi';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_MR_EMP)) {
            $modifiedColumns[':p' . $index++]  = 'mr_emp';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_MR_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'mr_name';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_MR_MEDIA_ID)) {
            $modifiedColumns[':p' . $index++]  = 'mr_media_id';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_ED_DURATION)) {
            $modifiedColumns[':p' . $index++]  = 'ed_duration';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_CAMPIAGN_ID)) {
            $modifiedColumns[':p' . $index++]  = 'campiagn_id';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_VISIT_PLAN_ID)) {
            $modifiedColumns[':p' . $index++]  = 'visit_plan_id';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_NCA_ATTENDEES)) {
            $modifiedColumns[':p' . $index++]  = 'nca_attendees';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_DCR_LAT_LONG)) {
            $modifiedColumns[':p' . $index++]  = 'dcr_lat_long';
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_DCR_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'dcr_address';
        }

        $sql = sprintf(
            'INSERT INTO dailycalls (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'dcr_id':
                        $stmt->bindValue($identifier, $this->dcr_id, PDO::PARAM_INT);

                        break;
                    case 'day_plan_id':
                        $stmt->bindValue($identifier, $this->day_plan_id, PDO::PARAM_INT);

                        break;
                    case 'outlet_org_data_id':
                        $stmt->bindValue($identifier, $this->outlet_org_data_id, PDO::PARAM_INT);

                        break;
                    case 'position_id':
                        $stmt->bindValue($identifier, $this->position_id, PDO::PARAM_INT);

                        break;
                    case 'agendacontroltype':
                        $stmt->bindValue($identifier, $this->agendacontroltype, PDO::PARAM_STR);

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
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'dcr_date':
                        $stmt->bindValue($identifier, $this->dcr_date ? $this->dcr_date->format("Y-m-d") : null, PDO::PARAM_STR);

                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);

                        break;
                    case 'managers':
                        $stmt->bindValue($identifier, $this->managers, PDO::PARAM_STR);

                        break;
                    case 'sgpi_out':
                        $stmt->bindValue($identifier, $this->sgpi_out, PDO::PARAM_STR);

                        break;
                    case 'outlet_feedback':
                        $stmt->bindValue($identifier, $this->outlet_feedback, PDO::PARAM_STR);

                        break;
                    case 'employee_feedback':
                        $stmt->bindValue($identifier, $this->employee_feedback, PDO::PARAM_STR);

                        break;
                    case 'brands_detailed':
                        $stmt->bindValue($identifier, $this->brands_detailed, PDO::PARAM_STR);

                        break;
                    case 'nca_comments':
                        $stmt->bindValue($identifier, $this->nca_comments, PDO::PARAM_STR);

                        break;
                    case 'device_time':
                        $stmt->bindValue($identifier, $this->device_time ? $this->device_time->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'isprocessed':
                        $stmt->bindValue($identifier, $this->isprocessed, PDO::PARAM_BOOL);

                        break;
                    case 'employee_id':
                        $stmt->bindValue($identifier, $this->employee_id, PDO::PARAM_INT);

                        break;
                    case 'device_make':
                        $stmt->bindValue($identifier, $this->device_make, PDO::PARAM_STR);

                        break;
                    case 'ed_session_id':
                        $stmt->bindValue($identifier, $this->ed_session_id, PDO::PARAM_STR);

                        break;
                    case 'dcr_status':
                        $stmt->bindValue($identifier, $this->dcr_status, PDO::PARAM_STR);

                        break;
                    case 'rcpa_done':
                        $stmt->bindValue($identifier, $this->rcpa_done, PDO::PARAM_INT);

                        break;
                    case 'has_sgpi':
                        $stmt->bindValue($identifier, $this->has_sgpi, PDO::PARAM_INT);

                        break;
                    case 'mr_emp':
                        $stmt->bindValue($identifier, $this->mr_emp, PDO::PARAM_INT);

                        break;
                    case 'mr_name':
                        $stmt->bindValue($identifier, $this->mr_name, PDO::PARAM_STR);

                        break;
                    case 'mr_media_id':
                        $stmt->bindValue($identifier, $this->mr_media_id, PDO::PARAM_INT);

                        break;
                    case 'ed_duration':
                        $stmt->bindValue($identifier, $this->ed_duration, PDO::PARAM_INT);

                        break;
                    case 'campiagn_id':
                        $stmt->bindValue($identifier, $this->campiagn_id, PDO::PARAM_STR);

                        break;
                    case 'visit_plan_id':
                        $stmt->bindValue($identifier, $this->visit_plan_id, PDO::PARAM_STR);

                        break;
                    case 'nca_attendees':
                        $stmt->bindValue($identifier, $this->nca_attendees, PDO::PARAM_STR);

                        break;
                    case 'dcr_lat_long':
                        $stmt->bindValue($identifier, $this->dcr_lat_long, PDO::PARAM_STR);

                        break;
                    case 'dcr_address':
                        $stmt->bindValue($identifier, $this->dcr_address, PDO::PARAM_STR);

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
        $pos = DailycallsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getDayPlanId();

            case 2:
                return $this->getOutletOrgDataId();

            case 3:
                return $this->getPositionId();

            case 4:
                return $this->getAgendacontroltype();

            case 5:
                return $this->getItownid();

            case 6:
                return $this->getAgendaId();

            case 7:
                return $this->getIsjw();

            case 8:
                return $this->getCreatedAt();

            case 9:
                return $this->getUpdatedAt();

            case 10:
                return $this->getDcrDate();

            case 11:
                return $this->getCompanyId();

            case 12:
                return $this->getManagers();

            case 13:
                return $this->getSgpiOut();

            case 14:
                return $this->getOutletFeedback();

            case 15:
                return $this->getEmployeeFeedback();

            case 16:
                return $this->getBrandsDetailed();

            case 17:
                return $this->getNcaComments();

            case 18:
                return $this->getDeviceTime();

            case 19:
                return $this->getIsprocessed();

            case 20:
                return $this->getEmployeeId();

            case 21:
                return $this->getDeviceMake();

            case 22:
                return $this->getEdSessionId();

            case 23:
                return $this->getDcrStatus();

            case 24:
                return $this->getRcpaDone();

            case 25:
                return $this->getHasSgpi();

            case 26:
                return $this->getMrEmp();

            case 27:
                return $this->getMrName();

            case 28:
                return $this->getMrMediaId();

            case 29:
                return $this->getEdDuration();

            case 30:
                return $this->getCampiagnId();

            case 31:
                return $this->getVisitPlanId();

            case 32:
                return $this->getNcaAttendees();

            case 33:
                return $this->getDcrLatLong();

            case 34:
                return $this->getDcrAddress();

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
        if (isset($alreadyDumpedObjects['Dailycalls'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['Dailycalls'][$this->hashCode()] = true;
        $keys = DailycallsTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getDcrId(),
            $keys[1] => $this->getDayPlanId(),
            $keys[2] => $this->getOutletOrgDataId(),
            $keys[3] => $this->getPositionId(),
            $keys[4] => $this->getAgendacontroltype(),
            $keys[5] => $this->getItownid(),
            $keys[6] => $this->getAgendaId(),
            $keys[7] => $this->getIsjw(),
            $keys[8] => $this->getCreatedAt(),
            $keys[9] => $this->getUpdatedAt(),
            $keys[10] => $this->getDcrDate(),
            $keys[11] => $this->getCompanyId(),
            $keys[12] => $this->getManagers(),
            $keys[13] => $this->getSgpiOut(),
            $keys[14] => $this->getOutletFeedback(),
            $keys[15] => $this->getEmployeeFeedback(),
            $keys[16] => $this->getBrandsDetailed(),
            $keys[17] => $this->getNcaComments(),
            $keys[18] => $this->getDeviceTime(),
            $keys[19] => $this->getIsprocessed(),
            $keys[20] => $this->getEmployeeId(),
            $keys[21] => $this->getDeviceMake(),
            $keys[22] => $this->getEdSessionId(),
            $keys[23] => $this->getDcrStatus(),
            $keys[24] => $this->getRcpaDone(),
            $keys[25] => $this->getHasSgpi(),
            $keys[26] => $this->getMrEmp(),
            $keys[27] => $this->getMrName(),
            $keys[28] => $this->getMrMediaId(),
            $keys[29] => $this->getEdDuration(),
            $keys[30] => $this->getCampiagnId(),
            $keys[31] => $this->getVisitPlanId(),
            $keys[32] => $this->getNcaAttendees(),
            $keys[33] => $this->getDcrLatLong(),
            $keys[34] => $this->getDcrAddress(),
        ];
        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[10]] instanceof \DateTimeInterface) {
            $result[$keys[10]] = $result[$keys[10]]->format('Y-m-d');
        }

        if ($result[$keys[18]] instanceof \DateTimeInterface) {
            $result[$keys[18]] = $result[$keys[18]]->format('Y-m-d H:i:s.u');
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
            if (null !== $this->collBrandCampiagnVisitss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'brandCampiagnVisitss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'brand_campiagn_visitss';
                        break;
                    default:
                        $key = 'BrandCampiagnVisitss';
                }

                $result[$key] = $this->collBrandCampiagnVisitss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collDailycallsAttendeess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'dailycallsAttendeess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'dailycalls_attendeess';
                        break;
                    default:
                        $key = 'DailycallsAttendeess';
                }

                $result[$key] = $this->collDailycallsAttendeess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSurveySubmiteds) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'surveySubmiteds';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'survey_submiteds';
                        break;
                    default:
                        $key = 'SurveySubmiteds';
                }

                $result[$key] = $this->collSurveySubmiteds->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = DailycallsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setDcrId($value);
                break;
            case 1:
                $this->setDayPlanId($value);
                break;
            case 2:
                $this->setOutletOrgDataId($value);
                break;
            case 3:
                $this->setPositionId($value);
                break;
            case 4:
                $this->setAgendacontroltype($value);
                break;
            case 5:
                $this->setItownid($value);
                break;
            case 6:
                $this->setAgendaId($value);
                break;
            case 7:
                $this->setIsjw($value);
                break;
            case 8:
                $this->setCreatedAt($value);
                break;
            case 9:
                $this->setUpdatedAt($value);
                break;
            case 10:
                $this->setDcrDate($value);
                break;
            case 11:
                $this->setCompanyId($value);
                break;
            case 12:
                $this->setManagers($value);
                break;
            case 13:
                $this->setSgpiOut($value);
                break;
            case 14:
                $this->setOutletFeedback($value);
                break;
            case 15:
                $this->setEmployeeFeedback($value);
                break;
            case 16:
                $this->setBrandsDetailed($value);
                break;
            case 17:
                $this->setNcaComments($value);
                break;
            case 18:
                $this->setDeviceTime($value);
                break;
            case 19:
                $this->setIsprocessed($value);
                break;
            case 20:
                $this->setEmployeeId($value);
                break;
            case 21:
                $this->setDeviceMake($value);
                break;
            case 22:
                $this->setEdSessionId($value);
                break;
            case 23:
                $this->setDcrStatus($value);
                break;
            case 24:
                $this->setRcpaDone($value);
                break;
            case 25:
                $this->setHasSgpi($value);
                break;
            case 26:
                $this->setMrEmp($value);
                break;
            case 27:
                $this->setMrName($value);
                break;
            case 28:
                $this->setMrMediaId($value);
                break;
            case 29:
                $this->setEdDuration($value);
                break;
            case 30:
                $this->setCampiagnId($value);
                break;
            case 31:
                $this->setVisitPlanId($value);
                break;
            case 32:
                $this->setNcaAttendees($value);
                break;
            case 33:
                $this->setDcrLatLong($value);
                break;
            case 34:
                $this->setDcrAddress($value);
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
        $keys = DailycallsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setDcrId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setDayPlanId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setOutletOrgDataId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPositionId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setAgendacontroltype($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setItownid($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setAgendaId($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setIsjw($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCreatedAt($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setUpdatedAt($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setDcrDate($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setCompanyId($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setManagers($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setSgpiOut($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setOutletFeedback($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setEmployeeFeedback($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setBrandsDetailed($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setNcaComments($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setDeviceTime($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setIsprocessed($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setEmployeeId($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setDeviceMake($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setEdSessionId($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setDcrStatus($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setRcpaDone($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setHasSgpi($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setMrEmp($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setMrName($arr[$keys[27]]);
        }
        if (array_key_exists($keys[28], $arr)) {
            $this->setMrMediaId($arr[$keys[28]]);
        }
        if (array_key_exists($keys[29], $arr)) {
            $this->setEdDuration($arr[$keys[29]]);
        }
        if (array_key_exists($keys[30], $arr)) {
            $this->setCampiagnId($arr[$keys[30]]);
        }
        if (array_key_exists($keys[31], $arr)) {
            $this->setVisitPlanId($arr[$keys[31]]);
        }
        if (array_key_exists($keys[32], $arr)) {
            $this->setNcaAttendees($arr[$keys[32]]);
        }
        if (array_key_exists($keys[33], $arr)) {
            $this->setDcrLatLong($arr[$keys[33]]);
        }
        if (array_key_exists($keys[34], $arr)) {
            $this->setDcrAddress($arr[$keys[34]]);
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
        $criteria = new Criteria(DailycallsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(DailycallsTableMap::COL_DCR_ID)) {
            $criteria->add(DailycallsTableMap::COL_DCR_ID, $this->dcr_id);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_DAY_PLAN_ID)) {
            $criteria->add(DailycallsTableMap::COL_DAY_PLAN_ID, $this->day_plan_id);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_OUTLET_ORG_DATA_ID)) {
            $criteria->add(DailycallsTableMap::COL_OUTLET_ORG_DATA_ID, $this->outlet_org_data_id);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_POSITION_ID)) {
            $criteria->add(DailycallsTableMap::COL_POSITION_ID, $this->position_id);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_AGENDACONTROLTYPE)) {
            $criteria->add(DailycallsTableMap::COL_AGENDACONTROLTYPE, $this->agendacontroltype);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_ITOWNID)) {
            $criteria->add(DailycallsTableMap::COL_ITOWNID, $this->itownid);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_AGENDA_ID)) {
            $criteria->add(DailycallsTableMap::COL_AGENDA_ID, $this->agenda_id);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_ISJW)) {
            $criteria->add(DailycallsTableMap::COL_ISJW, $this->isjw);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_CREATED_AT)) {
            $criteria->add(DailycallsTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_UPDATED_AT)) {
            $criteria->add(DailycallsTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_DCR_DATE)) {
            $criteria->add(DailycallsTableMap::COL_DCR_DATE, $this->dcr_date);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_COMPANY_ID)) {
            $criteria->add(DailycallsTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_MANAGERS)) {
            $criteria->add(DailycallsTableMap::COL_MANAGERS, $this->managers);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_SGPI_OUT)) {
            $criteria->add(DailycallsTableMap::COL_SGPI_OUT, $this->sgpi_out);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_OUTLET_FEEDBACK)) {
            $criteria->add(DailycallsTableMap::COL_OUTLET_FEEDBACK, $this->outlet_feedback);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_EMPLOYEE_FEEDBACK)) {
            $criteria->add(DailycallsTableMap::COL_EMPLOYEE_FEEDBACK, $this->employee_feedback);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_BRANDS_DETAILED)) {
            $criteria->add(DailycallsTableMap::COL_BRANDS_DETAILED, $this->brands_detailed);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_NCA_COMMENTS)) {
            $criteria->add(DailycallsTableMap::COL_NCA_COMMENTS, $this->nca_comments);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_DEVICE_TIME)) {
            $criteria->add(DailycallsTableMap::COL_DEVICE_TIME, $this->device_time);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_ISPROCESSED)) {
            $criteria->add(DailycallsTableMap::COL_ISPROCESSED, $this->isprocessed);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_EMPLOYEE_ID)) {
            $criteria->add(DailycallsTableMap::COL_EMPLOYEE_ID, $this->employee_id);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_DEVICE_MAKE)) {
            $criteria->add(DailycallsTableMap::COL_DEVICE_MAKE, $this->device_make);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_ED_SESSION_ID)) {
            $criteria->add(DailycallsTableMap::COL_ED_SESSION_ID, $this->ed_session_id);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_DCR_STATUS)) {
            $criteria->add(DailycallsTableMap::COL_DCR_STATUS, $this->dcr_status);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_RCPA_DONE)) {
            $criteria->add(DailycallsTableMap::COL_RCPA_DONE, $this->rcpa_done);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_HAS_SGPI)) {
            $criteria->add(DailycallsTableMap::COL_HAS_SGPI, $this->has_sgpi);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_MR_EMP)) {
            $criteria->add(DailycallsTableMap::COL_MR_EMP, $this->mr_emp);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_MR_NAME)) {
            $criteria->add(DailycallsTableMap::COL_MR_NAME, $this->mr_name);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_MR_MEDIA_ID)) {
            $criteria->add(DailycallsTableMap::COL_MR_MEDIA_ID, $this->mr_media_id);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_ED_DURATION)) {
            $criteria->add(DailycallsTableMap::COL_ED_DURATION, $this->ed_duration);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_CAMPIAGN_ID)) {
            $criteria->add(DailycallsTableMap::COL_CAMPIAGN_ID, $this->campiagn_id);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_VISIT_PLAN_ID)) {
            $criteria->add(DailycallsTableMap::COL_VISIT_PLAN_ID, $this->visit_plan_id);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_NCA_ATTENDEES)) {
            $criteria->add(DailycallsTableMap::COL_NCA_ATTENDEES, $this->nca_attendees);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_DCR_LAT_LONG)) {
            $criteria->add(DailycallsTableMap::COL_DCR_LAT_LONG, $this->dcr_lat_long);
        }
        if ($this->isColumnModified(DailycallsTableMap::COL_DCR_ADDRESS)) {
            $criteria->add(DailycallsTableMap::COL_DCR_ADDRESS, $this->dcr_address);
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
        $criteria = ChildDailycallsQuery::create();
        $criteria->add(DailycallsTableMap::COL_DCR_ID, $this->dcr_id);

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
     * @param object $copyObj An object of \entities\Dailycalls (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setDayPlanId($this->getDayPlanId());
        $copyObj->setOutletOrgDataId($this->getOutletOrgDataId());
        $copyObj->setPositionId($this->getPositionId());
        $copyObj->setAgendacontroltype($this->getAgendacontroltype());
        $copyObj->setItownid($this->getItownid());
        $copyObj->setAgendaId($this->getAgendaId());
        $copyObj->setIsjw($this->getIsjw());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setDcrDate($this->getDcrDate());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setManagers($this->getManagers());
        $copyObj->setSgpiOut($this->getSgpiOut());
        $copyObj->setOutletFeedback($this->getOutletFeedback());
        $copyObj->setEmployeeFeedback($this->getEmployeeFeedback());
        $copyObj->setBrandsDetailed($this->getBrandsDetailed());
        $copyObj->setNcaComments($this->getNcaComments());
        $copyObj->setDeviceTime($this->getDeviceTime());
        $copyObj->setIsprocessed($this->getIsprocessed());
        $copyObj->setEmployeeId($this->getEmployeeId());
        $copyObj->setDeviceMake($this->getDeviceMake());
        $copyObj->setEdSessionId($this->getEdSessionId());
        $copyObj->setDcrStatus($this->getDcrStatus());
        $copyObj->setRcpaDone($this->getRcpaDone());
        $copyObj->setHasSgpi($this->getHasSgpi());
        $copyObj->setMrEmp($this->getMrEmp());
        $copyObj->setMrName($this->getMrName());
        $copyObj->setMrMediaId($this->getMrMediaId());
        $copyObj->setEdDuration($this->getEdDuration());
        $copyObj->setCampiagnId($this->getCampiagnId());
        $copyObj->setVisitPlanId($this->getVisitPlanId());
        $copyObj->setNcaAttendees($this->getNcaAttendees());
        $copyObj->setDcrLatLong($this->getDcrLatLong());
        $copyObj->setDcrAddress($this->getDcrAddress());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBrandCampiagnVisitss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBrandCampiagnVisits($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDailycallsAttendeess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDailycallsAttendees($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSurveySubmiteds() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSurveySubmited($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setDcrId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \entities\Dailycalls Clone of current object.
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
            $v->addDailycalls($this);
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
                $this->aCompany->addDailycallss($this);
             */
        }

        return $this->aCompany;
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
            $v->addDailycalls($this);
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
                $this->aOutletOrgData->addDailycallss($this);
             */
        }

        return $this->aOutletOrgData;
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
            $v->addDailycalls($this);
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
                $this->aAgendatypes->addDailycallss($this);
             */
        }

        return $this->aAgendatypes;
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
            $v->addDailycalls($this);
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
                $this->aPositions->addDailycallss($this);
             */
        }

        return $this->aPositions;
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
            $v->addDailycalls($this);
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
                $this->aGeoTowns->addDailycallss($this);
             */
        }

        return $this->aGeoTowns;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName): void
    {
        if ('BrandCampiagnVisits' === $relationName) {
            $this->initBrandCampiagnVisitss();
            return;
        }
        if ('DailycallsAttendees' === $relationName) {
            $this->initDailycallsAttendeess();
            return;
        }
        if ('SurveySubmited' === $relationName) {
            $this->initSurveySubmiteds();
            return;
        }
    }

    /**
     * Clears out the collBrandCampiagnVisitss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addBrandCampiagnVisitss()
     */
    public function clearBrandCampiagnVisitss()
    {
        $this->collBrandCampiagnVisitss = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collBrandCampiagnVisitss collection loaded partially.
     *
     * @return void
     */
    public function resetPartialBrandCampiagnVisitss($v = true): void
    {
        $this->collBrandCampiagnVisitssPartial = $v;
    }

    /**
     * Initializes the collBrandCampiagnVisitss collection.
     *
     * By default this just sets the collBrandCampiagnVisitss collection to an empty array (like clearcollBrandCampiagnVisitss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBrandCampiagnVisitss(bool $overrideExisting = true): void
    {
        if (null !== $this->collBrandCampiagnVisitss && !$overrideExisting) {
            return;
        }

        $collectionClassName = BrandCampiagnVisitsTableMap::getTableMap()->getCollectionClassName();

        $this->collBrandCampiagnVisitss = new $collectionClassName;
        $this->collBrandCampiagnVisitss->setModel('\entities\BrandCampiagnVisits');
    }

    /**
     * Gets an array of ChildBrandCampiagnVisits objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildDailycalls is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBrandCampiagnVisits[] List of ChildBrandCampiagnVisits objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnVisits> List of ChildBrandCampiagnVisits objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBrandCampiagnVisitss(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collBrandCampiagnVisitssPartial && !$this->isNew();
        if (null === $this->collBrandCampiagnVisitss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collBrandCampiagnVisitss) {
                    $this->initBrandCampiagnVisitss();
                } else {
                    $collectionClassName = BrandCampiagnVisitsTableMap::getTableMap()->getCollectionClassName();

                    $collBrandCampiagnVisitss = new $collectionClassName;
                    $collBrandCampiagnVisitss->setModel('\entities\BrandCampiagnVisits');

                    return $collBrandCampiagnVisitss;
                }
            } else {
                $collBrandCampiagnVisitss = ChildBrandCampiagnVisitsQuery::create(null, $criteria)
                    ->filterByDailycalls($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBrandCampiagnVisitssPartial && count($collBrandCampiagnVisitss)) {
                        $this->initBrandCampiagnVisitss(false);

                        foreach ($collBrandCampiagnVisitss as $obj) {
                            if (false == $this->collBrandCampiagnVisitss->contains($obj)) {
                                $this->collBrandCampiagnVisitss->append($obj);
                            }
                        }

                        $this->collBrandCampiagnVisitssPartial = true;
                    }

                    return $collBrandCampiagnVisitss;
                }

                if ($partial && $this->collBrandCampiagnVisitss) {
                    foreach ($this->collBrandCampiagnVisitss as $obj) {
                        if ($obj->isNew()) {
                            $collBrandCampiagnVisitss[] = $obj;
                        }
                    }
                }

                $this->collBrandCampiagnVisitss = $collBrandCampiagnVisitss;
                $this->collBrandCampiagnVisitssPartial = false;
            }
        }

        return $this->collBrandCampiagnVisitss;
    }

    /**
     * Sets a collection of ChildBrandCampiagnVisits objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $brandCampiagnVisitss A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setBrandCampiagnVisitss(Collection $brandCampiagnVisitss, ?ConnectionInterface $con = null)
    {
        /** @var ChildBrandCampiagnVisits[] $brandCampiagnVisitssToDelete */
        $brandCampiagnVisitssToDelete = $this->getBrandCampiagnVisitss(new Criteria(), $con)->diff($brandCampiagnVisitss);


        $this->brandCampiagnVisitssScheduledForDeletion = $brandCampiagnVisitssToDelete;

        foreach ($brandCampiagnVisitssToDelete as $brandCampiagnVisitsRemoved) {
            $brandCampiagnVisitsRemoved->setDailycalls(null);
        }

        $this->collBrandCampiagnVisitss = null;
        foreach ($brandCampiagnVisitss as $brandCampiagnVisits) {
            $this->addBrandCampiagnVisits($brandCampiagnVisits);
        }

        $this->collBrandCampiagnVisitss = $brandCampiagnVisitss;
        $this->collBrandCampiagnVisitssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BrandCampiagnVisits objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BrandCampiagnVisits objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countBrandCampiagnVisitss(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collBrandCampiagnVisitssPartial && !$this->isNew();
        if (null === $this->collBrandCampiagnVisitss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBrandCampiagnVisitss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBrandCampiagnVisitss());
            }

            $query = ChildBrandCampiagnVisitsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByDailycalls($this)
                ->count($con);
        }

        return count($this->collBrandCampiagnVisitss);
    }

    /**
     * Method called to associate a ChildBrandCampiagnVisits object to this object
     * through the ChildBrandCampiagnVisits foreign key attribute.
     *
     * @param ChildBrandCampiagnVisits $l ChildBrandCampiagnVisits
     * @return $this The current object (for fluent API support)
     */
    public function addBrandCampiagnVisits(ChildBrandCampiagnVisits $l)
    {
        if ($this->collBrandCampiagnVisitss === null) {
            $this->initBrandCampiagnVisitss();
            $this->collBrandCampiagnVisitssPartial = true;
        }

        if (!$this->collBrandCampiagnVisitss->contains($l)) {
            $this->doAddBrandCampiagnVisits($l);

            if ($this->brandCampiagnVisitssScheduledForDeletion and $this->brandCampiagnVisitssScheduledForDeletion->contains($l)) {
                $this->brandCampiagnVisitssScheduledForDeletion->remove($this->brandCampiagnVisitssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBrandCampiagnVisits $brandCampiagnVisits The ChildBrandCampiagnVisits object to add.
     */
    protected function doAddBrandCampiagnVisits(ChildBrandCampiagnVisits $brandCampiagnVisits): void
    {
        $this->collBrandCampiagnVisitss[]= $brandCampiagnVisits;
        $brandCampiagnVisits->setDailycalls($this);
    }

    /**
     * @param ChildBrandCampiagnVisits $brandCampiagnVisits The ChildBrandCampiagnVisits object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeBrandCampiagnVisits(ChildBrandCampiagnVisits $brandCampiagnVisits)
    {
        if ($this->getBrandCampiagnVisitss()->contains($brandCampiagnVisits)) {
            $pos = $this->collBrandCampiagnVisitss->search($brandCampiagnVisits);
            $this->collBrandCampiagnVisitss->remove($pos);
            if (null === $this->brandCampiagnVisitssScheduledForDeletion) {
                $this->brandCampiagnVisitssScheduledForDeletion = clone $this->collBrandCampiagnVisitss;
                $this->brandCampiagnVisitssScheduledForDeletion->clear();
            }
            $this->brandCampiagnVisitssScheduledForDeletion[]= $brandCampiagnVisits;
            $brandCampiagnVisits->setDailycalls(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Dailycalls is new, it will return
     * an empty collection; or if this Dailycalls has previously
     * been saved, it will retrieve related BrandCampiagnVisitss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Dailycalls.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnVisits[] List of ChildBrandCampiagnVisits objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnVisits}> List of ChildBrandCampiagnVisits objects
     */
    public function getBrandCampiagnVisitssJoinBrandCampiagn(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnVisitsQuery::create(null, $criteria);
        $query->joinWith('BrandCampiagn', $joinBehavior);

        return $this->getBrandCampiagnVisitss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Dailycalls is new, it will return
     * an empty collection; or if this Dailycalls has previously
     * been saved, it will retrieve related BrandCampiagnVisitss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Dailycalls.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnVisits[] List of ChildBrandCampiagnVisits objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnVisits}> List of ChildBrandCampiagnVisits objects
     */
    public function getBrandCampiagnVisitssJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnVisitsQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getBrandCampiagnVisitss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Dailycalls is new, it will return
     * an empty collection; or if this Dailycalls has previously
     * been saved, it will retrieve related BrandCampiagnVisitss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Dailycalls.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnVisits[] List of ChildBrandCampiagnVisits objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnVisits}> List of ChildBrandCampiagnVisits objects
     */
    public function getBrandCampiagnVisitssJoinBrandCampiagnVisitPlan(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnVisitsQuery::create(null, $criteria);
        $query->joinWith('BrandCampiagnVisitPlan', $joinBehavior);

        return $this->getBrandCampiagnVisitss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Dailycalls is new, it will return
     * an empty collection; or if this Dailycalls has previously
     * been saved, it will retrieve related BrandCampiagnVisitss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Dailycalls.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBrandCampiagnVisits[] List of ChildBrandCampiagnVisits objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBrandCampiagnVisits}> List of ChildBrandCampiagnVisits objects
     */
    public function getBrandCampiagnVisitssJoinPositions(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBrandCampiagnVisitsQuery::create(null, $criteria);
        $query->joinWith('Positions', $joinBehavior);

        return $this->getBrandCampiagnVisitss($query, $con);
    }

    /**
     * Clears out the collDailycallsAttendeess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addDailycallsAttendeess()
     */
    public function clearDailycallsAttendeess()
    {
        $this->collDailycallsAttendeess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collDailycallsAttendeess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialDailycallsAttendeess($v = true): void
    {
        $this->collDailycallsAttendeessPartial = $v;
    }

    /**
     * Initializes the collDailycallsAttendeess collection.
     *
     * By default this just sets the collDailycallsAttendeess collection to an empty array (like clearcollDailycallsAttendeess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDailycallsAttendeess(bool $overrideExisting = true): void
    {
        if (null !== $this->collDailycallsAttendeess && !$overrideExisting) {
            return;
        }

        $collectionClassName = DailycallsAttendeesTableMap::getTableMap()->getCollectionClassName();

        $this->collDailycallsAttendeess = new $collectionClassName;
        $this->collDailycallsAttendeess->setModel('\entities\DailycallsAttendees');
    }

    /**
     * Gets an array of ChildDailycallsAttendees objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildDailycalls is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDailycallsAttendees[] List of ChildDailycallsAttendees objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycallsAttendees> List of ChildDailycallsAttendees objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getDailycallsAttendeess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collDailycallsAttendeessPartial && !$this->isNew();
        if (null === $this->collDailycallsAttendeess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collDailycallsAttendeess) {
                    $this->initDailycallsAttendeess();
                } else {
                    $collectionClassName = DailycallsAttendeesTableMap::getTableMap()->getCollectionClassName();

                    $collDailycallsAttendeess = new $collectionClassName;
                    $collDailycallsAttendeess->setModel('\entities\DailycallsAttendees');

                    return $collDailycallsAttendeess;
                }
            } else {
                $collDailycallsAttendeess = ChildDailycallsAttendeesQuery::create(null, $criteria)
                    ->filterByDailycalls($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDailycallsAttendeessPartial && count($collDailycallsAttendeess)) {
                        $this->initDailycallsAttendeess(false);

                        foreach ($collDailycallsAttendeess as $obj) {
                            if (false == $this->collDailycallsAttendeess->contains($obj)) {
                                $this->collDailycallsAttendeess->append($obj);
                            }
                        }

                        $this->collDailycallsAttendeessPartial = true;
                    }

                    return $collDailycallsAttendeess;
                }

                if ($partial && $this->collDailycallsAttendeess) {
                    foreach ($this->collDailycallsAttendeess as $obj) {
                        if ($obj->isNew()) {
                            $collDailycallsAttendeess[] = $obj;
                        }
                    }
                }

                $this->collDailycallsAttendeess = $collDailycallsAttendeess;
                $this->collDailycallsAttendeessPartial = false;
            }
        }

        return $this->collDailycallsAttendeess;
    }

    /**
     * Sets a collection of ChildDailycallsAttendees objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $dailycallsAttendeess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setDailycallsAttendeess(Collection $dailycallsAttendeess, ?ConnectionInterface $con = null)
    {
        /** @var ChildDailycallsAttendees[] $dailycallsAttendeessToDelete */
        $dailycallsAttendeessToDelete = $this->getDailycallsAttendeess(new Criteria(), $con)->diff($dailycallsAttendeess);


        $this->dailycallsAttendeessScheduledForDeletion = $dailycallsAttendeessToDelete;

        foreach ($dailycallsAttendeessToDelete as $dailycallsAttendeesRemoved) {
            $dailycallsAttendeesRemoved->setDailycalls(null);
        }

        $this->collDailycallsAttendeess = null;
        foreach ($dailycallsAttendeess as $dailycallsAttendees) {
            $this->addDailycallsAttendees($dailycallsAttendees);
        }

        $this->collDailycallsAttendeess = $dailycallsAttendeess;
        $this->collDailycallsAttendeessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related DailycallsAttendees objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related DailycallsAttendees objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countDailycallsAttendeess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collDailycallsAttendeessPartial && !$this->isNew();
        if (null === $this->collDailycallsAttendeess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDailycallsAttendeess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDailycallsAttendeess());
            }

            $query = ChildDailycallsAttendeesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByDailycalls($this)
                ->count($con);
        }

        return count($this->collDailycallsAttendeess);
    }

    /**
     * Method called to associate a ChildDailycallsAttendees object to this object
     * through the ChildDailycallsAttendees foreign key attribute.
     *
     * @param ChildDailycallsAttendees $l ChildDailycallsAttendees
     * @return $this The current object (for fluent API support)
     */
    public function addDailycallsAttendees(ChildDailycallsAttendees $l)
    {
        if ($this->collDailycallsAttendeess === null) {
            $this->initDailycallsAttendeess();
            $this->collDailycallsAttendeessPartial = true;
        }

        if (!$this->collDailycallsAttendeess->contains($l)) {
            $this->doAddDailycallsAttendees($l);

            if ($this->dailycallsAttendeessScheduledForDeletion and $this->dailycallsAttendeessScheduledForDeletion->contains($l)) {
                $this->dailycallsAttendeessScheduledForDeletion->remove($this->dailycallsAttendeessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildDailycallsAttendees $dailycallsAttendees The ChildDailycallsAttendees object to add.
     */
    protected function doAddDailycallsAttendees(ChildDailycallsAttendees $dailycallsAttendees): void
    {
        $this->collDailycallsAttendeess[]= $dailycallsAttendees;
        $dailycallsAttendees->setDailycalls($this);
    }

    /**
     * @param ChildDailycallsAttendees $dailycallsAttendees The ChildDailycallsAttendees object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeDailycallsAttendees(ChildDailycallsAttendees $dailycallsAttendees)
    {
        if ($this->getDailycallsAttendeess()->contains($dailycallsAttendees)) {
            $pos = $this->collDailycallsAttendeess->search($dailycallsAttendees);
            $this->collDailycallsAttendeess->remove($pos);
            if (null === $this->dailycallsAttendeessScheduledForDeletion) {
                $this->dailycallsAttendeessScheduledForDeletion = clone $this->collDailycallsAttendeess;
                $this->dailycallsAttendeessScheduledForDeletion->clear();
            }
            $this->dailycallsAttendeessScheduledForDeletion[]= $dailycallsAttendees;
            $dailycallsAttendees->setDailycalls(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Dailycalls is new, it will return
     * an empty collection; or if this Dailycalls has previously
     * been saved, it will retrieve related DailycallsAttendeess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Dailycalls.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDailycallsAttendees[] List of ChildDailycallsAttendees objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycallsAttendees}> List of ChildDailycallsAttendees objects
     */
    public function getDailycallsAttendeessJoinBrandCampiagnVisitPlan(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDailycallsAttendeesQuery::create(null, $criteria);
        $query->joinWith('BrandCampiagnVisitPlan', $joinBehavior);

        return $this->getDailycallsAttendeess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Dailycalls is new, it will return
     * an empty collection; or if this Dailycalls has previously
     * been saved, it will retrieve related DailycallsAttendeess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Dailycalls.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDailycallsAttendees[] List of ChildDailycallsAttendees objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDailycallsAttendees}> List of ChildDailycallsAttendees objects
     */
    public function getDailycallsAttendeessJoinOutletOrgData(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDailycallsAttendeesQuery::create(null, $criteria);
        $query->joinWith('OutletOrgData', $joinBehavior);

        return $this->getDailycallsAttendeess($query, $con);
    }

    /**
     * Clears out the collSurveySubmiteds collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSurveySubmiteds()
     */
    public function clearSurveySubmiteds()
    {
        $this->collSurveySubmiteds = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSurveySubmiteds collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSurveySubmiteds($v = true): void
    {
        $this->collSurveySubmitedsPartial = $v;
    }

    /**
     * Initializes the collSurveySubmiteds collection.
     *
     * By default this just sets the collSurveySubmiteds collection to an empty array (like clearcollSurveySubmiteds());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSurveySubmiteds(bool $overrideExisting = true): void
    {
        if (null !== $this->collSurveySubmiteds && !$overrideExisting) {
            return;
        }

        $collectionClassName = SurveySubmitedTableMap::getTableMap()->getCollectionClassName();

        $this->collSurveySubmiteds = new $collectionClassName;
        $this->collSurveySubmiteds->setModel('\entities\SurveySubmited');
    }

    /**
     * Gets an array of ChildSurveySubmited objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildDailycalls is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSurveySubmited[] List of ChildSurveySubmited objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSurveySubmited> List of ChildSurveySubmited objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSurveySubmiteds(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSurveySubmitedsPartial && !$this->isNew();
        if (null === $this->collSurveySubmiteds || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSurveySubmiteds) {
                    $this->initSurveySubmiteds();
                } else {
                    $collectionClassName = SurveySubmitedTableMap::getTableMap()->getCollectionClassName();

                    $collSurveySubmiteds = new $collectionClassName;
                    $collSurveySubmiteds->setModel('\entities\SurveySubmited');

                    return $collSurveySubmiteds;
                }
            } else {
                $collSurveySubmiteds = ChildSurveySubmitedQuery::create(null, $criteria)
                    ->filterByDailycalls($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSurveySubmitedsPartial && count($collSurveySubmiteds)) {
                        $this->initSurveySubmiteds(false);

                        foreach ($collSurveySubmiteds as $obj) {
                            if (false == $this->collSurveySubmiteds->contains($obj)) {
                                $this->collSurveySubmiteds->append($obj);
                            }
                        }

                        $this->collSurveySubmitedsPartial = true;
                    }

                    return $collSurveySubmiteds;
                }

                if ($partial && $this->collSurveySubmiteds) {
                    foreach ($this->collSurveySubmiteds as $obj) {
                        if ($obj->isNew()) {
                            $collSurveySubmiteds[] = $obj;
                        }
                    }
                }

                $this->collSurveySubmiteds = $collSurveySubmiteds;
                $this->collSurveySubmitedsPartial = false;
            }
        }

        return $this->collSurveySubmiteds;
    }

    /**
     * Sets a collection of ChildSurveySubmited objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $surveySubmiteds A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSurveySubmiteds(Collection $surveySubmiteds, ?ConnectionInterface $con = null)
    {
        /** @var ChildSurveySubmited[] $surveySubmitedsToDelete */
        $surveySubmitedsToDelete = $this->getSurveySubmiteds(new Criteria(), $con)->diff($surveySubmiteds);


        $this->surveySubmitedsScheduledForDeletion = $surveySubmitedsToDelete;

        foreach ($surveySubmitedsToDelete as $surveySubmitedRemoved) {
            $surveySubmitedRemoved->setDailycalls(null);
        }

        $this->collSurveySubmiteds = null;
        foreach ($surveySubmiteds as $surveySubmited) {
            $this->addSurveySubmited($surveySubmited);
        }

        $this->collSurveySubmiteds = $surveySubmiteds;
        $this->collSurveySubmitedsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SurveySubmited objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SurveySubmited objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSurveySubmiteds(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSurveySubmitedsPartial && !$this->isNew();
        if (null === $this->collSurveySubmiteds || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSurveySubmiteds) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSurveySubmiteds());
            }

            $query = ChildSurveySubmitedQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByDailycalls($this)
                ->count($con);
        }

        return count($this->collSurveySubmiteds);
    }

    /**
     * Method called to associate a ChildSurveySubmited object to this object
     * through the ChildSurveySubmited foreign key attribute.
     *
     * @param ChildSurveySubmited $l ChildSurveySubmited
     * @return $this The current object (for fluent API support)
     */
    public function addSurveySubmited(ChildSurveySubmited $l)
    {
        if ($this->collSurveySubmiteds === null) {
            $this->initSurveySubmiteds();
            $this->collSurveySubmitedsPartial = true;
        }

        if (!$this->collSurveySubmiteds->contains($l)) {
            $this->doAddSurveySubmited($l);

            if ($this->surveySubmitedsScheduledForDeletion and $this->surveySubmitedsScheduledForDeletion->contains($l)) {
                $this->surveySubmitedsScheduledForDeletion->remove($this->surveySubmitedsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSurveySubmited $surveySubmited The ChildSurveySubmited object to add.
     */
    protected function doAddSurveySubmited(ChildSurveySubmited $surveySubmited): void
    {
        $this->collSurveySubmiteds[]= $surveySubmited;
        $surveySubmited->setDailycalls($this);
    }

    /**
     * @param ChildSurveySubmited $surveySubmited The ChildSurveySubmited object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSurveySubmited(ChildSurveySubmited $surveySubmited)
    {
        if ($this->getSurveySubmiteds()->contains($surveySubmited)) {
            $pos = $this->collSurveySubmiteds->search($surveySubmited);
            $this->collSurveySubmiteds->remove($pos);
            if (null === $this->surveySubmitedsScheduledForDeletion) {
                $this->surveySubmitedsScheduledForDeletion = clone $this->collSurveySubmiteds;
                $this->surveySubmitedsScheduledForDeletion->clear();
            }
            $this->surveySubmitedsScheduledForDeletion[]= $surveySubmited;
            $surveySubmited->setDailycalls(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Dailycalls is new, it will return
     * an empty collection; or if this Dailycalls has previously
     * been saved, it will retrieve related SurveySubmiteds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Dailycalls.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSurveySubmited[] List of ChildSurveySubmited objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSurveySubmited}> List of ChildSurveySubmited objects
     */
    public function getSurveySubmitedsJoinCompany(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSurveySubmitedQuery::create(null, $criteria);
        $query->joinWith('Company', $joinBehavior);

        return $this->getSurveySubmiteds($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Dailycalls is new, it will return
     * an empty collection; or if this Dailycalls has previously
     * been saved, it will retrieve related SurveySubmiteds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Dailycalls.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSurveySubmited[] List of ChildSurveySubmited objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSurveySubmited}> List of ChildSurveySubmited objects
     */
    public function getSurveySubmitedsJoinEmployee(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSurveySubmitedQuery::create(null, $criteria);
        $query->joinWith('Employee', $joinBehavior);

        return $this->getSurveySubmiteds($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Dailycalls is new, it will return
     * an empty collection; or if this Dailycalls has previously
     * been saved, it will retrieve related SurveySubmiteds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Dailycalls.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSurveySubmited[] List of ChildSurveySubmited objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSurveySubmited}> List of ChildSurveySubmited objects
     */
    public function getSurveySubmitedsJoinOutlets(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSurveySubmitedQuery::create(null, $criteria);
        $query->joinWith('Outlets', $joinBehavior);

        return $this->getSurveySubmiteds($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Dailycalls is new, it will return
     * an empty collection; or if this Dailycalls has previously
     * been saved, it will retrieve related SurveySubmiteds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Dailycalls.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSurveySubmited[] List of ChildSurveySubmited objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSurveySubmited}> List of ChildSurveySubmited objects
     */
    public function getSurveySubmitedsJoinBrandCampiagnVisitPlan(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSurveySubmitedQuery::create(null, $criteria);
        $query->joinWith('BrandCampiagnVisitPlan', $joinBehavior);

        return $this->getSurveySubmiteds($query, $con);
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
            $this->aCompany->removeDailycalls($this);
        }
        if (null !== $this->aOutletOrgData) {
            $this->aOutletOrgData->removeDailycalls($this);
        }
        if (null !== $this->aAgendatypes) {
            $this->aAgendatypes->removeDailycalls($this);
        }
        if (null !== $this->aPositions) {
            $this->aPositions->removeDailycalls($this);
        }
        if (null !== $this->aGeoTowns) {
            $this->aGeoTowns->removeDailycalls($this);
        }
        $this->dcr_id = null;
        $this->day_plan_id = null;
        $this->outlet_org_data_id = null;
        $this->position_id = null;
        $this->agendacontroltype = null;
        $this->itownid = null;
        $this->agenda_id = null;
        $this->isjw = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->dcr_date = null;
        $this->company_id = null;
        $this->managers = null;
        $this->sgpi_out = null;
        $this->outlet_feedback = null;
        $this->employee_feedback = null;
        $this->brands_detailed = null;
        $this->nca_comments = null;
        $this->device_time = null;
        $this->isprocessed = null;
        $this->employee_id = null;
        $this->device_make = null;
        $this->ed_session_id = null;
        $this->dcr_status = null;
        $this->rcpa_done = null;
        $this->has_sgpi = null;
        $this->mr_emp = null;
        $this->mr_name = null;
        $this->mr_media_id = null;
        $this->ed_duration = null;
        $this->campiagn_id = null;
        $this->visit_plan_id = null;
        $this->nca_attendees = null;
        $this->dcr_lat_long = null;
        $this->dcr_address = null;
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
            if ($this->collBrandCampiagnVisitss) {
                foreach ($this->collBrandCampiagnVisitss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDailycallsAttendeess) {
                foreach ($this->collDailycallsAttendeess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSurveySubmiteds) {
                foreach ($this->collSurveySubmiteds as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBrandCampiagnVisitss = null;
        $this->collDailycallsAttendeess = null;
        $this->collSurveySubmiteds = null;
        $this->aCompany = null;
        $this->aOutletOrgData = null;
        $this->aAgendatypes = null;
        $this->aPositions = null;
        $this->aGeoTowns = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(DailycallsTableMap::DEFAULT_STRING_FORMAT);
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
